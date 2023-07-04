<?php
session_start();
include("../config/connect.php");
$s_id = $_SESSION['id'];
$user_id = filter_var(htmlentities($_POST['id']), FILTER_SANITIZE_NUMBER_INT);
$long = filter_var(htmlentities($_POST['cvay']), FILTER_SANITIZE_NUMBER_INT);
$lat = filter_var(htmlentities($_POST['vfg']), FILTER_SANITIZE_NUMBER_INT);
$fid = 0;
$checkfollow_sql = "SELECT * FROM buy WHERE author_id=:s_id AND post_id=:user_id";
    $checkfollow = $conn->prepare($checkfollow_sql);
    $checkfollow->bindParam(':s_id',$s_id,PDO::PARAM_INT);
    $checkfollow->bindParam(':user_id',$user_id,PDO::PARAM_INT);
    $checkfollow->execute();
    $fchecknum = $checkfollow->rowCount();
if ($fchecknum > 0) {
    // unfollow user [AQL Query]
    $unfollow_sql = "DELETE FROM buy WHERE author_id=:s_id AND post_id=:user_id";
    $unfollow = $conn->prepare($unfollow_sql);
    $unfollow->bindParam(':s_id',$s_id,PDO::PARAM_INT);
    $unfollow->bindParam(':user_id',$user_id,PDO::PARAM_INT);
    $unfollow->execute();
    $followbtn = "<button class=\"follow_btn\" style='min-width:100%' onclick=\"buy('$user_id')\"><span class=\"fa fa-plus-circle\"></span> Wait...</button>";

    // Delete notification to user
    $s_id = $_SESSION['id'];
    $notifyType = "buy";
    $sendNotification = $conn->prepare("DELETE FROM notifications WHERE from_id =:from_id AND for_id=:for_id AND notifyType_id=:ntId AND notifyType=:notifyType");
    $sendNotification->bindParam(':from_id',$s_id,PDO::PARAM_INT);
    $sendNotification->bindParam(':for_id',$user_id,PDO::PARAM_INT);
    $sendNotification->bindParam(':ntId',$s_id,PDO::PARAM_INT);
    $sendNotification->bindParam(':notifyType',$notifyType,PDO::PARAM_STR);
    $sendNotification->execute();
    // ==================================
}else{
	    $time = time();
    // follow user [AQL Query]
    $follow_sql = "INSERT INTO buy (author_id,post_id,longi,lat,time) VALUES (:s_id,:user_id,:lat,:long,:time)";
    $follow = $conn->prepare($follow_sql);
    $follow->bindParam(':s_id',$s_id,PDO::PARAM_INT);
    $follow->bindParam(':user_id',$user_id,PDO::PARAM_STR);
    $follow->bindParam(':long',$long,PDO::PARAM_STR);
    $follow->bindParam(':lat',$lat,PDO::PARAM_STR);
    $follow->bindParam(':time',$time,PDO::PARAM_STR);
    $follow->execute();
    $followbtn = "<button class=\"unfollow_btn\" style='min-width:100%' onclick=\"buy('$user_id')\"><span class=\"fa fa-check\"></span> Buy</button>";
    // send notification to user
    $nId = rand(0,999999999)+time();
    $s_id = $_SESSION['id'];
    $notifyType = "buy";
    $nSeen = "0";
    $nTime = time();
    if ($user_id != $s_id) {
    $sendNotification = $conn->prepare("INSERT INTO notifications (n_id, from_id, for_id, notifyType_id, notifyType, seen, time) VALUES (:nId, :fromId, :forId, :notifyTypeId, :notifyType, :seen, :nTime)");
    $sendNotification->bindParam(':nId',$nId,PDO::PARAM_INT);
    $sendNotification->bindParam(':fromId',$s_id,PDO::PARAM_INT);
    $sendNotification->bindParam(':forId',$user_id,PDO::PARAM_INT);
    $sendNotification->bindParam(':notifyTypeId',$s_id,PDO::PARAM_INT);
    $sendNotification->bindParam(':notifyType',$notifyType,PDO::PARAM_STR);
    $sendNotification->bindParam(':seen',$nSeen,PDO::PARAM_INT);
    $sendNotification->bindParam(':nTime',$nTime,PDO::PARAM_INT);
    $sendNotification->execute();
    }
    // ==================================
}

echo $followbtn;

?>
