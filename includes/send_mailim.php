<?php
session_start();
include "../config/connect.php";
$m_id = rand(0,9999999)+time();
$p_author_id = $_SESSION['id'];
$p_author = $_SESSION['Fullname'];
$p_author_photo = $_SESSION['Userphoto'];
$p_time = time();
$m_to = filter_var(htmlspecialchars($_POST['his']), FILTER_SANITIZE_STRING);
$post_id = filter_var(htmlspecialchars($_POST['pid']), FILTER_SANITIZE_STRING);

    //================[ if image not empty ]================
if($post_id){

$iptdbsql = "INSERT INTO messages
(m_id,m_from,m_to,m_time,post_id)
VALUES
( :m_id, :p_author_id, :m_to, :p_time, :post_id)
";
$insert_post_toDB = $conn->prepare($iptdbsql);
$insert_post_toDB->bindParam(':m_id', $m_id,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':p_author_id', $p_author_id,PDO::PARAM_INT);
$insert_post_toDB->bindParam(':p_time', $p_time,PDO::PARAM_INT);
$insert_post_toDB->bindParam(':m_to', $m_to,PDO::PARAM_INT);
$insert_post_toDB->bindParam(':post_id', $post_id,PDO::PARAM_INT);
$insert_post_toDB->execute();
}

else {
echo"Please choose an image.";
}
?>