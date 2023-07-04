<?php
session_start();
include("../config/connect.php");
$s_id = $_SESSION['id'];
$plike = filter_var(htmlentities($_POST['pl']),FILTER_SANITIZE_NUMBER_INT);
$lid = "";
$no = "1";
    $checklike_sql = "SELECT * FROM polls WHERE poller=:s_id AND post_id=:plike";
    $checklike = $conn->prepare($checklike_sql);
    $checklike->bindParam(':s_id',$s_id,PDO::PARAM_INT);
    $checklike->bindParam(':plike',$plike,PDO::PARAM_INT);
    $checklike->execute();
    $checknum = $checklike->rowCount();
    if ($checknum > 0) {
		echo"<span style='cursor: default;color:#ff928a;font-size:30px' data-toggle='tooltip' data-placement='top' title='<?php echo lang('please_wait'); ?>' id='plike'><span class=\"fa fa-heart\"></span></span>";
    // ==================================
    }else{
    $like_sql = "INSERT INTO polls (id,poller,post_id,no) VALUES (:lid,:s_id,:plike,:no)";
    $like = $conn->prepare($like_sql);
    $like->bindParam(':lid',$lid,PDO::PARAM_INT);
    $like->bindParam(':s_id',$s_id,PDO::PARAM_INT);
    $like->bindParam(':plike',$plike,PDO::PARAM_INT);
    $like->bindParam(':no',$no,PDO::PARAM_INT);
    $like->execute();
    $likebtn = "<span onclick=\"votey('$plike')\" style='color:#ff928a;font-size:30px' data-toggle='tooltip' data-placement='top' title='".lang('u_liked_this')."' id='punlike'><span class=\"fa fa-heart\"></span></span>";

        // update likes number
        $likes_sql = "SELECT id FROM polls WHERE post_id=:plike";
        $likes = $conn->prepare($likes_sql);
        $likes->bindParam(':plike',$plike,PDO::PARAM_INT);
        $likes->execute();
        $likes_num = $likes->rowCount();
        $makeChangeSql = "UPDATE wpost SET p_likes=:likes_num WHERE post_id=:plike";
        $makeChange = $conn->prepare($makeChangeSql);
        $makeChange->bindParam(':likes_num',$likes_num,PDO::PARAM_INT);
        $makeChange->bindParam(':plike',$plike,PDO::PARAM_INT);
        $makeChange->execute();
        if ($likes_num == 0) {
        $likenum = "<span class='fa fa-heart'></span> ".lang('no_likes');
        }elseif ($likes_num == 1){
            $likenum = "1 <span class='fa fa-heart' style='color: #ff928a;'></span>";
        }else{
            $likenum = $likes_num." <span class='fa fa-heart' style='color: #ff928a;'></span>";
        }
        // send notification to user
        $get_post_authorId = $conn->prepare("SELECT author_id FROM wpost WHERE post_id=:plike");
        $get_post_authorId->bindParam(':plike',$plike,PDO::PARAM_INT);
        $get_post_authorId->execute();
        while ($getAuthor = $get_post_authorId->fetch(PDO::FETCH_ASSOC)) {
        $nId = rand(0,999999999)+time();
        $s_id = $_SESSION['id'];
        $for_id = $getAuthor['author_id'];
        $notifyType = "like";
        $nSeen = "0";
        $nTime = time();
        if ($for_id != $s_id) {
        $sendNotification = $conn->prepare("INSERT INTO notifications (n_id, from_id, for_id, notifyType_id, notifyType, seen, time) VALUES (:nId, :fromId, :forId, :notifyTypeId, :notifyType, :seen, :nTime)");
        $sendNotification->bindParam(':nId',$nId,PDO::PARAM_INT);
        $sendNotification->bindParam(':fromId',$s_id,PDO::PARAM_INT);
        $sendNotification->bindParam(':forId',$for_id,PDO::PARAM_INT);
        $sendNotification->bindParam(':notifyTypeId',$plike,PDO::PARAM_INT);
        $sendNotification->bindParam(':notifyType',$notifyType,PDO::PARAM_STR);
        $sendNotification->bindParam(':seen',$nSeen,PDO::PARAM_INT);
        $sendNotification->bindParam(':nTime',$nTime,PDO::PARAM_INT);
        $sendNotification->execute();
        }
        }
        // ==================================
}

$arr = array();
$arr[0] = $likebtn;
$arr[1] = $likenum;
echo json_encode($arr);
exit;
?>
