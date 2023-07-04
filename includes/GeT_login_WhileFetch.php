<?php
while($row_fetch = $query->fetch(PDO::FETCH_ASSOC)){
$row_id = $row_fetch['id'];
$row_fullname = $row_fetch['Fullname'];
$row_username = $row_fetch['Username'];
$row_email = $row_fetch['Email'];
$row_password = $row_fetch['Password'];
$row_user_photo = $row_fetch['Userphoto'];
$row_user_cover_photo = $row_fetch['user_cover_photo'];
$row_school = $row_fetch['school'];
$row_work = $row_fetch['work'];
$row_work0 = $row_fetch['work0'];
$row_country = $row_fetch['country'];
$address2 = $row_fetch['address2'];
$address1 = $row_fetch['address1'];
$bussinesstypr = $row_fetch['bussinesstypr'];
$phone = $row_fetch['phone'];
$bussins_des = $row_fetch['bussins_des'];
$row_verify = $row_fetch['verify'];
$row_website = $row_fetch['website'];
$row_bio = $row_fetch['bio'];
$row_admin = $row_fetch['admin'];
$row_gender = $row_fetch['gender'];
$accou_typ = $row_fetch['accou_typ'];
$row_profile_pic_border = $row_fetch['profile_pic_border'];
$row_language = $row_fetch['language'];
$em_pub = $row_fetch['em_pub'];
$work_price = $row_fetch['work_price'];
$mob_no2 = $row_fetch['mob_no2'];
$mob_no1 = $row_fetch['mob_no1'];
$work_details = $row_fetch['work_details'];
}
$_SESSION['id'] = $row_id;
$_SESSION['Fullname'] = $row_fullname;
$_SESSION['Username'] = $row_username;
$_SESSION['Email'] = $row_email;
$_SESSION['phone'] = $phone;
$_SESSION['Password'] = $row_password;
$_SESSION['Userphoto'] = $row_user_photo;
$_SESSION['uCoverPhoto'] = $row_user_cover_photo;
$_SESSION['school'] = $row_school;
$_SESSION['work'] = $row_work;
$_SESSION['accou_typ'] = $accou_typ;
$_SESSION['bussinesstypr'] = $bussinesstypr;
$_SESSION['bussins_des'] = $bussins_des;
$_SESSION['address1'] = $address1;
$_SESSION['address2'] = $address2;
$_SESSION['mob_no1'] = $mob_no1;
$_SESSION['mob_no2'] = $mob_no2;
$_SESSION['work_price'] = $work_price;
$_SESSION['work_details'] = $work_details;
$_SESSION['em_pub'] = $em_pub;
$_SESSION['work0'] = $row_work0;
$_SESSION['country'] = $row_country;
$_SESSION['birthday'] = $row_birthday;
$_SESSION['verify'] = $row_verify;
$_SESSION['website'] = $row_website;
$_SESSION['bio'] = $row_bio;
$_SESSION['admin'] = $row_admin;
if ($row_gender == "0" or $row_gender == "Male") {
$_SESSION['gender'] = "Male";
}elseif ($row_gender == "1" or $row_gender == "Female") {
$_SESSION['gender'] = "Female";
}
$_SESSION['profile_pic_border'] = $row_profile_pic_border;
$_SESSION['language'] = $row_language;
$_SESSION['online'] = $row_online;
?>
