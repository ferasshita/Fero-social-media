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
$comment_time = time();
$get_post_authorId = $conn->prepare("SELECT author_id FROM story WHERE story_id=:get_post_id");
$get_post_authorId->bindParam(':get_post_id',$get_post_id,PDO::PARAM_INT);
$get_post_authorId->execute();
while ($getAuthor = $get_post_authorId->fetch(PDO::FETCH_ASSOC)) {
	$his_id = $getAuthor['author_id'];
}
if (trim($comment_content) == NULL){
}else{
$ictodbsql = "INSERT INTO answ_ques
(ans_id,author_id,story_id,answer,his_id,time)
VALUES
(:c_id,:s_id,:get_post_id,:comment_content, :his_id,:comment_time)
";
$insert_comment_toDB = $conn->prepare($ictodbsql);
$insert_comment_toDB->bindParam(':s_id',$s_id,PDO::PARAM_INT);
$insert_comment_toDB->bindParam(':c_id',$c_id,PDO::PARAM_INT);
$insert_comment_toDB->bindParam(':his_id',$his_id,PDO::PARAM_INT);
$insert_comment_toDB->bindParam(':get_post_id',$get_post_id,PDO::PARAM_INT);
$insert_comment_toDB->bindParam(':comment_content',$comment_content,PDO::PARAM_STR);
$insert_comment_toDB->bindParam(':comment_time',$comment_time,PDO::PARAM_INT);
$insert_comment_toDB->execute();
}
// send notification to user
$get_post_authorId = $conn->prepare("SELECT author_id FROM story WHERE story_id=:get_post_id");
$get_post_authorId->bindParam(':get_post_id',$get_post_id,PDO::PARAM_INT);
$get_post_authorId->execute();
while ($getAuthor = $get_post_authorId->fetch(PDO::FETCH_ASSOC)) {
$nId = time()+rand(0,999999999);
$s_id = $_SESSION['id'];
$for_id = $getAuthor['author_id'];
$notifyType = "ans";
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