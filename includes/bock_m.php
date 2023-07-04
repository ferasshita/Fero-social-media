<?php
include("../config/connect.php");
session_start();
$sid = $_SESSION['id'];
$pid = filter_var(htmlspecialchars($_POST['pid']), FILTER_SANITIZE_STRING);
$csql = "SELECT id FROM block_m WHERE blocken_id=:pid AND my_id=:sid";
$c = $conn->prepare($csql);
$c->bindParam(':sid',$sid,PDO::PARAM_INT);
$c->bindParam(':pid',$pid,PDO::PARAM_INT);
$c->execute();
$c_num = $c->rowCount();
if($c_num < 1){
        $val = "1";
$insertM = $conn->prepare("INSERT INTO block_m (blocken_id,my_id,ty) VALUES (:pid,:sid,:val)");
$insertM->bindParam(':pid',$pid,PDO::PARAM_INT);
$insertM->bindParam(':sid',$sid,PDO::PARAM_STR);
$insertM->bindParam(':val',$val,PDO::PARAM_INT);
$insertM->execute();
	echo "yes";
}else{
	$delete_comm_sql = "DELETE FROM block_m WHERE blocken_id=:pid AND my_id=:sid";
	$delete_comm = $conn->prepare($delete_comm_sql);
	$delete_comm->bindParam(':pid',$pid,PDO::PARAM_INT);
	$delete_comm->bindParam(':sid',$sid,PDO::PARAM_STR);
	$delete_comm->execute();
	echo "yes";
}

?>