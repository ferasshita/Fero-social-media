<?php
include("../config/connect.php");
session_start();
$sid = $_SESSION['id'];
$story_id = filter_var(htmlspecialchars($_POST['pid']),FILTER_SANITIZE_NUMBER_INT);
$check = $conn->prepare("SELECT author_id FROM story WHERE story_id =:story_id");
$check->bindParam(':story_id',$story_id,PDO::PARAM_INT);
$check->execute();
while ($chR = $check->fetch(PDO::FETCH_ASSOC)) {
	$chR_aid = $chR['author_id'];
}
if ($chR_aid == $sid) {
	$delete_post_sql = "DELETE FROM story WHERE story_id= :story_id";
	$delete_post = $conn->prepare($delete_post_sql);
	$delete_post->bindParam(':story_id',$story_id,PDO::PARAM_INT);
	$delete_post->execute();
	// Delete notification 'like'
	$notifyType = "like";
	$sendNotification = $conn->prepare("DELETE FROM notifications WHERE notifyType_id=:notifyType_id AND notifyType=:notifyType");
	$sendNotification->bindParam(':notifyType_id',$story_id,PDO::PARAM_INT);
	$sendNotification->bindParam(':notifyType',$notifyType,PDO::PARAM_STR);
	$sendNotification->execute();
	// Delete notification 'comment'
	$notifyType = "comment";
	$sendNotification = $conn->prepare("DELETE FROM notifications WHERE notifyType_id=:notifyType_id AND notifyType=:notifyType");
	$sendNotification->bindParam(':notifyType_id',$story_id,PDO::PARAM_INT);
	$sendNotification->bindParam(':notifyType',$notifyType,PDO::PARAM_STR);
	$sendNotification->execute();
	echo "yes";
}else{
	echo "no";
}
?>