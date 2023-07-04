<?php
$s_id = $_SESSION['id'];
$s_fullname = $_SESSION['Fullname'];
$s_username = $_SESSION['Username'];
$s_userphoto = $_SESSION['Userphoto'];

$un = filter_var(htmlspecialchars($_GET['u']),FILTER_SANITIZE_STRING);
$uisql = "SELECT * FROM signup WHERE Username=:un";
$que = $conn->prepare($uisql);
$que->bindParam(':un', $un, PDO::PARAM_STR);
$que->execute();
while($row = $que->fetch(PDO::FETCH_ASSOC)){
    $row_id = $row['id'];
    $row_fullname = $row['Fullname'];
    $row_username = $row['Username'];
    $row_email = $row['Email'];
    $row_password = $row['Password'];
    $row_user_photo = $row['Userphoto'];
    $row_user_cover_photo = $row['user_cover_photo'];
    $row_school = $row['school'];
    $row_work = $row['work'];
    $row_work0 = $row['work0'];
    $work_detail = $row['work_detail'];
    $work_free_m = $row['work_free'];
    $work_price = $row['work_price'];
    $mob_no1 = $row['mob_no1'];
    $mob_no2 = $row['mob_no2'];
    $em_pub_m = $row['em_pub'];
    $row_country = $row['country'];
    $row_birthday = $row['birthday'];
    $row_verify = $row['verify'];
    $row_website = $row['website'];
    $row_bio = $row['bio'];
    $row_admin = $row['admin'];
    $row_gender = $row['gender'];
    $row_profile_pic_border = $row['profile_pic_border'];
    $row_language = $row['language'];
    $row_online = $row['online'];
	if($work_free_m == "1"){
		$work_free = "Free";
	}elseif($work_free_m == "2"){
		$work_free = $work_price;
	}
	if($em_pub_m == "1"){
		$em_pub = $row_email;
	}
}
?>