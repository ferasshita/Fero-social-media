<?php
session_start();
include("../config/connect.php");
include ("time_function.php");
include ("num_k_m_count.php");
session_start();
$s_id=$_SESSION['id'];
$c_id = rand(0,9999999)+time();
$comment_content = filter_var(htmlentities($_POST['cContent']),FILTER_SANITIZE_STRING);
$get_post_id = filter_var(htmlentities($_POST['pid']),FILTER_SANITIZE_NUMBER_INT);
$check_path_var = filter_var(htmlentities($_POST['cp']),FILTER_SANITIZE_STRING);
$tylike = filter_var(htmlentities($_POST['tylike']),FILTER_SANITIZE_STRING);
$comment_time = time();
if($tylike){
	$ictodbsql = "INSERT INTO messages
(m_id,m_from,m_to,m_time,m_like)
VALUES
(:c_id,:s_id,:get_post_id,:comment_time,:tylike)
";
$insert_comment_toDB = $conn->prepare($ictodbsql);
$insert_comment_toDB->bindParam(':s_id',$s_id,PDO::PARAM_INT);
$insert_comment_toDB->bindParam(':c_id',$c_id,PDO::PARAM_INT);
$insert_comment_toDB->bindParam(':get_post_id',$get_post_id,PDO::PARAM_INT);
$insert_comment_toDB->bindParam(':comment_time',$comment_time,PDO::PARAM_INT);
$insert_comment_toDB->bindParam(':tylike',$tylike,PDO::PARAM_INT);
$insert_comment_toDB->execute();
}
if (trim($comment_content) == NULL){
}else{
$ictodbsql = "INSERT INTO messages
(m_id,message,m_from,m_to,m_time)
VALUES
(:c_id,:comment_content,:s_id,:get_post_id,:comment_time)
";
$insert_comment_toDB = $conn->prepare($ictodbsql);
$insert_comment_toDB->bindParam(':s_id',$s_id,PDO::PARAM_INT);
$insert_comment_toDB->bindParam(':c_id',$c_id,PDO::PARAM_INT);
$insert_comment_toDB->bindParam(':get_post_id',$get_post_id,PDO::PARAM_INT);
$insert_comment_toDB->bindParam(':comment_content',$comment_content,PDO::PARAM_STR);
$insert_comment_toDB->bindParam(':comment_time',$comment_time,PDO::PARAM_INT);
$insert_comment_toDB->execute();
}
$seen_from = "1";
$seen_to = "1";
$ictodbsql = "INSERT INTO meesage_inser (m_id, mi_from, mi_to, seen_from) VALUES (:c_id, :fromId, :forId, :seen_from)";
$refl = $conn->prepare($ictodbsql);
$refl->bindParam(':c_id',$c_id,PDO::PARAM_INT);
$refl->bindParam(':fromId',$s_id,PDO::PARAM_INT);
$refl->bindParam(':forId',$get_post_id,PDO::PARAM_INT);
$refl->bindParam(':seen_from',$seen_from,PDO::PARAM_INT);
$refl->execute();
$ictodbsql = "INSERT INTO meesage_inser (m_id, mi_from, mi_to, seen_to) VALUES (:c_id, :fromId, :forId, :seen_from)";
$refl = $conn->prepare($ictodbsql);
$refl->bindParam(':c_id',$c_id,PDO::PARAM_INT);
$refl->bindParam(':fromId',$s_id,PDO::PARAM_INT);
$refl->bindParam(':forId',$get_post_id,PDO::PARAM_INT);
$refl->bindParam(':seen_from',$seen_from,PDO::PARAM_INT);
$refl->execute();
    $query2_sql = "SELECT * FROM signup WHERE id=:s_id";
    $query2 = $conn->prepare($query2_sql);
    $query2->bindParam(':s_id',$s_id,PDO::PARAM_INT);
    $query2->execute();
    while ($query_fetch2 = $query2->fetch(PDO::FETCH_ASSOC)) {
    $my_id = $query_fetch2['id'];
    $my_un = $query_fetch2['Username'];
    $my_fu = $query_fetch2['Fullname'];
    $my_up = $query_fetch2['Userphoto'];
    $my_ver = $query_fetch2['verify'];


    }
    if ($query_fetch_verify2 == "1"){
        $verifypage_var = $verifyUser;
        }else{
        $verifypage_var = "";
    }
	echo" <table style='width:100%;' id='comment_$m_id' class='uComment'>
    <tr><td style='width:50px;position:relative;'>
    <div class='user_comment_img'>
     <img src='../imgs/user_imgs/$my_up'/>
    </div>
    </td><td><a class='userLinkComment' href='$uProfileUrl'>$my_fu</a><span>$my_ver</span>
    <p style='word-break: break-word;' id='commentContent_$m_id'>";
    if($gif_img){
		echo"<img src='".$check_path."$gif_img' style='width:15%;height:25%;border-radius:10px;'>";
	}else{
	echo"<span class='w3-light-blue spanComment'>$message</span><br/>";}
    echo"<p style='margin: 0; padding: 0;'>
    <span class='comment_time'>$ago_time</span>";
     if ($edited_4comm == "1") {
        $editedComment = " <sub style='font-size: 15px; margin: 0px 3px;'>&bull;</sub> ".lang('comm_edited')." ($timeEdited_4commAgo)";
     }else{
        $editedComment="";
     }
     echo"<span id='editedComment_$m_id' style='font-size:11px;color:#808080;'> $editedComment</span>
    </p>
    </p>
    <div id='CommentLoading_$m_id'>
    </div>
    <div id='commentEditBox_$m_id' style='display:none;'>
    <textarea dir='auto' class='commentContent_EditBox' id='commEditBox_$m_id'>$message</textarea>
    <div style='margin-bottom: 15px;margin-top: 5px;'>
    <a href='javascript:void(0)' onclick=\"editComment_save('$m_id','$check_path')\" class='default_flat_btn'>".lang('save')."</a>
    <a href='javascript:void(0)' onclick=\"editComment_cancel('$m_id')\" class='silver_flat_btn'>".lang('cancel')."</a>
    </div>
    </td>
    <td>
    <div class='dropdown'>
    <a class='post_options dropdown-toggle' data-toggle='dropdown' style='float:".lang('float2').";' href='#'><span>&bull;&bull;&bull;</span></a>
    <ul class='dropdown-menu ".lang('postDropdown')."' style='top:10px;color:#999;text-align: ".lang('textAlign').";'>
    ";

// send notification to user
$get_post_authorId = $conn->prepare("SELECT author_id FROM wpost WHERE post_id=:get_post_id");
$get_post_authorId->bindParam(':get_post_id',$get_post_id,PDO::PARAM_INT);
$get_post_authorId->execute();
while ($getAuthor = $get_post_authorId->fetch(PDO::FETCH_ASSOC)) {
$nId = time()+rand(0,999999999);
$s_id = $_SESSION['id'];
$for_id = $getAuthor['author_id'];
$notifyType = "comment";
$nSeen = "0";
$nTime = time();
if ($for_id != $s_id) {
$sendNotification = $conn->prepare("INSERT INTO notifications (n_id, from_id, for_id, notifyType_id, notifyType, seen, time) VALUES (:nId, :fromId, :forId, :notifyTypeId, :notifyType, :seen, :nTime)");
$sendNotification->bindParam(':nId',$nId,PDO::PARAM_INT);
$sendNotification->bindParam(':fromId',$s_id,PDO::PARAM_INT);
$sendNotification->bindParam(':forId',$for_id,PDO::PARAM_INT);
$sendNotification->bindParam(':notifyTypeId',$get_post_id,PDO::PARAM_INT);
$sendNotification->bindParam(':notifyType',$notifyType,PDO::PARAM_STR);
$sendNotification->bindParam(':seen',$nSeen,PDO::PARAM_INT);
$sendNotification->bindParam(':nTime',$nTime,PDO::PARAM_INT);
$sendNotification->execute();	
}
}

// ==================================
exit();
?>