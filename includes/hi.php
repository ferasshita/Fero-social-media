	<?php
	// set user online >>> I wrote this code here cuz 'head imports' can access any page
if (isset($_SESSION['Username'])) {
$myid = $_SESSION['id'];
$long = filter_var(htmlentities($_POST['long']),FILTER_SANITIZE_STRING);
$lat = filter_var(htmlentities($_POST['lat']),FILTER_SANITIZE_STRING);
$setStatus = $conn->prepare("UPDATE signup SET longa = :long AND lata = :lat WHERE id = :myid");
$setStatus->bindParam(':long',$long,PDO::PARAM_INT);
$setStatus->bindParam(':lat',$lat,PDO::PARAM_INT);
$setStatus->bindParam(':myid',$myid,PDO::PARAM_INT);
$setStatus->execute();
}
?>