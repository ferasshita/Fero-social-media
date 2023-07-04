<?php
include("../config/connect.php");
session_start();
$sid = $_SESSION['id'];
$m_id = htmlentities($_POST['id'], ENT_QUOTES);
$p_id = htmlentities($_POST['pid'], ENT_QUOTES);
$check = $conn->prepare("SELECT m_from FROM messages WHERE m_id =:m_id");
$check->bindParam(':m_id',$m_id,PDO::PARAM_INT);
$check->execute();
while ($chR = $check->fetch(PDO::FETCH_ASSOC)) {
	$chR_aid = $chR['m_from'];
}
if ($chR_aid == $sid) {
	$delete_comm_sql = "DELETE FROM messages WHERE m_id= :m_id";
	$delete_comm = $conn->prepare($delete_comm_sql);
	$delete_comm->bindParam(':m_id',$m_id,PDO::PARAM_INT);
	$delete_comm->execute();
	echo "yes";
}else{
	echo "no";
}

?>