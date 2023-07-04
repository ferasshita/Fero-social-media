<?php
include("../config/connect.php");
session_start();
$sid = $_SESSION['id'];
$c_id = htmlentities($_POST['cid'], ENT_QUOTES);
$p_id = htmlentities($_POST['pid'], ENT_QUOTES);
$check = $conn->prepare("SELECT m_to, m_from FROM messages WHERE m_id =:c_id");
$check->bindParam(':c_id',$c_id,PDO::PARAM_INT);
$check->execute();
while ($chR = $check->fetch(PDO::FETCH_ASSOC)) {
	$m_to = $chR['m_to'];
	$m_from = $chR['m_from'];
}
if ($m_to == $sid OR $m_from == $sid) {
        $val = "1";
        $insertVerify_sql = "UPDATE messages SET m_hide=:val WHERE m_id =:c_id";
        $insertVerify = $conn->prepare($insertVerify_sql);
        $insertVerify->bindParam(':c_id',$c_id,PDO::PARAM_INT);
        $insertVerify->bindParam(':val',$val,PDO::PARAM_INT);
        $insertVerify->execute();
	echo "yes";
}else{
	echo "no";
}

?>