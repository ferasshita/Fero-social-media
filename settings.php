<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();
include("config/connect.php");
include("includes/fetch_users_info.php");
include ("includes/time_function.php");
include("includes/country_name_function.php");
if(!isset($_SESSION['Username'])){
    header("location: login.php");
}
$tc = filter_var(htmlentities($_GET['tc']),FILTER_SANITIZE_STRING);
// =============================[ prepare input variable's ]=================================
$session_un = $_SESSION['Username'];

$fullname_var = filter_var(htmlentities($_POST['edit_fullname']),FILTER_SANITIZE_STRING);
$username_var = filter_var(htmlentities($_POST['edit_username']),FILTER_SANITIZE_STRING);
$email_var = filter_var(htmlentities($_POST['edit_email']),FILTER_SANITIZE_STRING);
$phone_var = filter_var(htmlentities($_POST['edit_phone']),FILTER_SANITIZE_STRING);
// =========================== password hashinng ==================================
$new_password_var_field = filter_var(htmlentities($_POST['new_pass']),FILTER_SANITIZE_STRING);
$options = array(
    'cost' => 12,
);
$new_password_var = password_hash($new_password_var_field, PASSWORD_BCRYPT, $options);
// ================================================================================
$rewrite_new_password_var = filter_var(htmlentities($_POST['rewrite_new_pass']),FILTER_SANITIZE_STRING);

// filter gender as prefered language
$gender_var = filter_var(htmlentities($_POST['gender']),FILTER_SANITIZE_STRING);
if ($gender_var == lang('male')) {
   $gender_var = "Male";
}elseif ($gender_var == lang('female')) {
    $gender_var = "Female";
}

$school_var = filter_var(htmlentities($_POST['edit_school']),FILTER_SANITIZE_STRING);
$work_var = filter_var(htmlentities($_POST['edit_work']),FILTER_SANITIZE_STRING);
$work0_var = filter_var(htmlentities($_POST['edit_work0']),FILTER_SANITIZE_STRING);
$work_detail = filter_var(htmlentities($_POST['work_detail']),FILTER_SANITIZE_STRING);
$work_free = filter_var(htmlentities($_POST['work_free']),FILTER_SANITIZE_STRING);
$work_price = filter_var(htmlentities($_POST['work_price']),FILTER_SANITIZE_STRING);
$mob_no1 = filter_var(htmlentities($_POST['mob_no1']),FILTER_SANITIZE_STRING);
$mob_no2 = filter_var(htmlentities($_POST['mob_no2']),FILTER_SANITIZE_STRING);
$bussinesstypr = filter_var(htmlentities($_POST['bussinesstypr']),FILTER_SANITIZE_STRING);
$addres1 = filter_var(htmlentities($_POST['bussinessad1']),FILTER_SANITIZE_STRING);
$addres2 = filter_var(htmlentities($_POST['bussinessad2']),FILTER_SANITIZE_STRING);
$em_pub = filter_var(htmlentities($_POST['em_pub']),FILTER_SANITIZE_STRING);
$country_var = filter_var(htmlentities($_POST['edit_country']),FILTER_SANITIZE_STRING);
$birthday_var = filter_var(htmlentities($_POST['bd_year']),FILTER_SANITIZE_NUMBER_INT)."/".filter_var(htmlentities($_POST['bd_month']),FILTER_SANITIZE_NUMBER_INT)."/".filter_var(htmlentities($_POST['bd_day']),FILTER_SANITIZE_NUMBER_INT);
$website_var = filter_var(htmlentities($_POST['edit_website']),FILTER_SANITIZE_STRING);
$bio_var = filter_var(htmlentities($_POST['edit_bio']),FILTER_SANITIZE_STRING);
$bussiness_ty = filter_var(htmlentities($_POST['bussiness_ty']),FILTER_SANITIZE_STRING);
$bussins_des = filter_var(htmlentities($_POST['bussins_des']),FILTER_SANITIZE_STRING);

$language_var = filter_var(htmlspecialchars($_POST['edit_language']),FILTER_SANITIZE_STRING);

$general_current_pass_var = filter_var(htmlentities($_POST['general_current_pass']),FILTER_SANITIZE_STRING);
$EditProfile_current_pass_var = filter_var(htmlentities($_POST['EditProfile_current_pass']),FILTER_SANITIZE_STRING);
$lang_current_pass_var = filter_var(htmlentities($_POST['lang_current_pass']),FILTER_SANITIZE_STRING);
$accouty_current_pass = filter_var(htmlentities($_POST['accouty_current_pass']),FILTER_SANITIZE_STRING);
$accou_typ = filter_var(htmlentities($_POST['accou_typ']),FILTER_SANITIZE_STRING);
$remeveA_current_pass_var = filter_var(htmlentities($_POST['removeA_current_pass']),FILTER_SANITIZE_STRING);

// =============================[ Save General settings ]=================================
if (isset($_POST['general_save_changes'])) {
if (!password_verify($general_current_pass_var,$_SESSION['Password'])) {
    $general_save_result = "<p class='alertRed'>".lang('current_password_is_incorrect')."</p>";
}else{
    if (empty($fullname_var) or empty($username_var) or empty($email_var) or empty($phone_var)) {
        $general_save_result = "<p class='alertRed'>".lang('please_fill_required_fields')."</p>";
    } else {
         if (empty($new_password_var) AND empty($rewrite_new_password_var)) {
            $new_password_var = $_SESSION['Password'];
         }elseif ($new_password_var_field != $rewrite_new_password_var) {
            $general_save_result = "<p class='alertRed'>".lang('new_password_doesnt_match_the_confirm_field')."</p>";
            $stop = "1";
        }
        if(strpos($username_var, ' ') !== false || preg_match('/[\'^£$%&*()}{@#~?><>,.|=+¬-]/', $username_var) || !preg_match('/[A-Za-z0-9]+/', $username_var)) {
            $general_save_result =  "
            <ul class='alertRed' style='list-style:none;'>
                <li><b>".lang('username_not_allowed')." :</b></li>
                <li><span class='fa fa-times'></span> ".lang('signup_username_should_be_1').".</li>
                <li><span class='fa fa-times'></span> ".lang('signup_username_should_be_2').".</li>
                <li><span class='fa fa-times'></span> ".lang('signup_username_should_be_3').".</li>
                <li><span class='fa fa-times'></span> ".lang('signup_username_should_be_4').".</li>
                <li><span class='fa fa-times'></span> ".lang('signup_username_should_be_5').".</li>
            </ul>";
            $stop = "1";
        }
        $unExist = $conn->prepare("SELECT Username FROM signup WHERE Username =:username_var");
        $unExist->bindParam(':username_var',$username_var,PDO::PARAM_STR);
        $unExist->execute();
        $unExistCount = $unExist->rowCount();
        if ($unExistCount > 0) {
           if ($username_var != $_SESSION['Username']) {
           $general_save_result = "<p class='alertRed'>".lang('user_already_exist')."</p>";
           $stop = "1";
           }
        }
        $emExist = $conn->prepare("SELECT Email FROM signup WHERE Email =:email_var");
        $emExist->bindParam(':email_var',$email_var,PDO::PARAM_STR);
        $emExist->execute();
        $emExistCount = $emExist->rowCount();
        if ($emExistCount > 0) {
           if ($email_var != $_SESSION['Email']) {
           $general_save_result = "<p class='alertRed'>".lang('email_already_exist')."</p>";
           $stop = "1";
           }
        }
        $emExist = $conn->prepare("SELECT phone FROM signup WHERE phone =:phone_var");
        $emExist->bindParam(':phone_var',$phone_var,PDO::PARAM_STR);
        $emExist->execute();
        $phExistCount = $emExist->rowCount();
        if ($emExistCount > 0) {
           if ($email_var != $_SESSION['Email']) {
           $general_save_result = "<p class='alertRed'>".lang('email_already_exist')."</p>";
           $stop = "1";
           }
        }
        if ($phExistCount > 0) {
           if ($phone_var != $_SESSION['phone']) {
           $general_save_result = "<p class='alertRed'>".lang('email_already_exist')."</p>";
           $stop = "1";
           }
        }
        if (!filter_var($email_var, FILTER_VALIDATE_EMAIL)) {
            $general_save_result = "<p class='alertRed'>".lang('invalid_email_address')."</p>";
            $stop = "1";
        }
         if ($stop != "1") {
         $update_info_sql = "UPDATE signup SET Fullname= :fullname_var,Username= :username_var,Email= :email_var,Password= :new_password_var,phone =:phone_var,gender= :gender_var WHERE username= :session_un";
         $update_info = $conn->prepare($update_info_sql);
         $update_info->bindParam(':fullname_var',$fullname_var,PDO::PARAM_STR);
         $update_info->bindParam(':username_var',$username_var,PDO::PARAM_STR);
         $update_info->bindParam(':phone_var',$phone_var,PDO::PARAM_STR);
         $update_info->bindParam(':email_var',$email_var,PDO::PARAM_STR);
         $update_info->bindParam(':new_password_var',$new_password_var,PDO::PARAM_STR);
         $update_info->bindParam(':gender_var',$gender_var,PDO::PARAM_STR);
         $update_info->bindParam(':session_un',$session_un,PDO::PARAM_STR);
         $update_info->execute();
        if (isset($update_info)) {
            $_SESSION['Fullname'] = $fullname_var;
            $_SESSION['Username'] = $username_var;
            $_SESSION['Email'] = $email_var;
            $_SESSION['phone'] = $phone_var;
            $_SESSION['Password'] = $new_password_var;
            $_SESSION['gender'] = $gender_var;
            $general_save_result = "<p class='alertGreen'>".lang('changes_saved_seccessfully')."</p>";
        } else {
            $general_save_result = "<p class='alertRed'>".lang('errorSomthingWrong')."</p>";
        }
        }
    }
}
}
// =============================[ Save Edit profile settings ]==============================
if (isset($_POST['EditProfile_save_changes'])) {
if (!password_verify($EditProfile_current_pass_var,$_SESSION['Password'])) {
    $EditProfile_save_result = "<p class='alertRed'>".lang('current_password_is_incorrect')."</p>";
}else{
    $update_info_sql = "UPDATE signup SET school=:school_var,work0= :work0_var,work= :work_var,work_detail= :work_detail,work_free= :work_free,work_price= :work_price,em_pub= :em_pub,country= :country_var,mob_no1= :mob_no1,mob_no2= :mob_no2,birthday= :birthday_var,bussiness_ty= :bussiness_ty, bussins_des= :bussins_des,addres1= :addres1, addres2= :addres2, bussinesstypr= :bussinesstypr,website= :website_var,bio= :bio_var WHERE username= :session_un";
     $update_info = $conn->prepare($update_info_sql);
     $update_info->bindParam(':school_var',$school_var,PDO::PARAM_STR);
     $update_info->bindParam(':work0_var',$work0_var,PDO::PARAM_STR);
     $update_info->bindParam(':work_var',$work_var,PDO::PARAM_STR);
     $update_info->bindParam(':bussiness_ty',$bussiness_ty,PDO::PARAM_STR);
     $update_info->bindParam(':bussins_des',$bussins_des,PDO::PARAM_STR);
     $update_info->bindParam(':addres1',$addres1,PDO::PARAM_STR);
     $update_info->bindParam(':addres2',$addres2,PDO::PARAM_STR);
     $update_info->bindParam(':bussinesstypr',$bussinesstypr,PDO::PARAM_STR);
     $update_info->bindParam(':work_detail',$work_detail,PDO::PARAM_STR);
     $update_info->bindParam(':work_free',$work_free,PDO::PARAM_STR);
     $update_info->bindParam(':work_price',$work_price,PDO::PARAM_STR);
     $update_info->bindParam(':mob_no1',$mob_no1,PDO::PARAM_STR);
     $update_info->bindParam(':mob_no2',$mob_no2,PDO::PARAM_STR);
     $update_info->bindParam(':em_pub',$em_pub,PDO::PARAM_STR);
     $update_info->bindParam(':country_var',$country_var,PDO::PARAM_STR);
     $update_info->bindParam(':birthday_var',$birthday_var,PDO::PARAM_STR);
     $update_info->bindParam(':website_var',$website_var,PDO::PARAM_STR);
     $update_info->bindParam(':bio_var',$bio_var,PDO::PARAM_STR);
     $update_info->bindParam(':session_un',$session_un,PDO::PARAM_STR);
     $update_info->execute();

    if (isset($update_info)) {
        $_SESSION['school'] = $school_var;
        $_SESSION['work0'] = $work0_var;
        $_SESSION['work'] = $work_var;
        $_SESSION['work_detail'] = $work_detail;
        $_SESSION['work_free'] = $work_free;
        $_SESSION['work_price'] = $work_price;
        $_SESSION['mob_no1'] = $mob_no1;
        $_SESSION['mob_no2'] = $mob_no2;
        $_SESSION['em_pub'] = $em_pub;
		$_SESSION['bussinesstypr'] = $bussinesstypr;
$_SESSION['bussins_des'] = $bussins_des;
$_SESSION['address1'] = $address1;
$_SESSION['address2'] = $address2;
        $_SESSION['country'] = $country_var;
        $_SESSION['birthday'] = $birthday_var;
        $_SESSION['website'] = $website_var;
        $_SESSION['bio'] = $bio_var;
        $EditProfile_save_result = "<p class='alertGreen'>".lang('changes_saved_seccessfully')."</p>";
    } else {
        $EditProfile_save_result = "<p class='alertRed'>".lang('errorSomthingWrong')."</p>";
    }

}
}
// =============================[ Save Languages settings ]=================================
if (isset($_POST['lang_save_changes'])) {
if (!password_verify($lang_current_pass_var,$_SESSION['Password'])) {
    $lang_save_result = "<p class='alertRed'>".lang('current_password_is_incorrect')."</p>";
}else{
     $update_info_sql = "UPDATE signup SET language= :language_var WHERE username= :session_un";
     $update_info = $conn->prepare($update_info_sql);
     $update_info->bindParam(':language_var',$language_var,PDO::PARAM_STR);
     $update_info->bindParam(':session_un',$session_un,PDO::PARAM_STR);
     $update_info->execute();
    if (isset($update_info)) {
        $_SESSION['language'] = $language_var;
        $lang_save_result = "<p class='alertGreen'>".lang('changes_saved_seccessfully')."</p>";
    } else {
        $lang_save_result = "<p class='alertRed'>".lang('errorSomthingWrong')."</p>";
    }
}
}
// =============================[ account type settings ]=================================
if (isset($_POST['accoun_ty_save_changes'])) {
if (!password_verify($accouty_current_pass,$_SESSION['Password'])) {
    $lang_save_result = "<p class='alertRed'>".lang('current_password_is_incorrect')."</p>";
}else{
     $update_info_sql = "UPDATE signup SET accou_typ= :accou_typ WHERE username= :session_un";
     $update_info = $conn->prepare($update_info_sql);
     $update_info->bindParam(':accou_typ',$accou_typ,PDO::PARAM_STR);
     $update_info->bindParam(':session_un',$session_un,PDO::PARAM_STR);
     $update_info->execute();
    if (isset($update_info)) {
        $_SESSION['accou_typ'] = $accou_typ;
        $lang_save_result = "<p class='alertGreen'>".lang('changes_saved_seccessfully')."</p>";
    } else {
        $lang_save_result = "<p class='alertRed'>".lang('errorSomthingWrong')."</p>";
    }
}
}
// =============================[ Remove account ]=================================
$myid = $_SESSION['id'];
if (isset($_POST['removeA_save_changes'])) {
if (!password_verify($remeveA_current_pass_var,$_SESSION['Password'])) {
    $removeA_save_result = "<p class='alertRed'>".lang('current_password_is_incorrect')."</p>";
}else{
     $remeveAccount_sql = "DELETE FROM signup WHERE Username= :session_un";
     $remeveAccount = $conn->prepare($remeveAccount_sql);
     $remeveAccount->bindParam(':session_un',$session_un,PDO::PARAM_STR);
     $remeveAccount->execute();
     $remeveAccount_sql = "DELETE FROM comments WHERE c_author_id= :myid";
     $remeveAccount = $conn->prepare($remeveAccount_sql);
     $remeveAccount->bindParam(':myid',$myid,PDO::PARAM_STR);
     $remeveAccount->execute();
     $remeveAccount_sql = "DELETE FROM follow WHERE uf_one= :myid";
     $remeveAccount = $conn->prepare($remeveAccount_sql);
     $remeveAccount->bindParam(':myid',$myid,PDO::PARAM_STR);
     $remeveAccount->execute();
     $remeveAccount_sql = "DELETE FROM follow WHERE uf_two= :myid";
     $remeveAccount = $conn->prepare($remeveAccount_sql);
     $remeveAccount->bindParam(':myid',$myid,PDO::PARAM_STR);
     $remeveAccount->execute();
     $remeveAccount_sql = "DELETE FROM likes WHERE liker= :myid";
     $remeveAccount = $conn->prepare($remeveAccount_sql);
     $remeveAccount->bindParam(':myid',$myid,PDO::PARAM_STR);
     $remeveAccount->execute();
     $remeveAccount_sql = "DELETE FROM mynotepad WHERE author_id= :myid";
     $remeveAccount = $conn->prepare($remeveAccount_sql);
     $remeveAccount->bindParam(':myid',$myid,PDO::PARAM_STR);
     $remeveAccount->execute();
     $remeveAccount_sql = "DELETE FROM r_star WHERE u_id= :myid";
     $remeveAccount = $conn->prepare($remeveAccount_sql);
     $remeveAccount->bindParam(':myid',$myid,PDO::PARAM_STR);
     $remeveAccount->execute();
     $remeveAccount_sql = "DELETE FROM r_star WHERE p_id= :myid";
     $remeveAccount = $conn->prepare($remeveAccount_sql);
     $remeveAccount->bindParam(':myid',$myid,PDO::PARAM_STR);
     $remeveAccount->execute();
     $remeveAccount_sql = "DELETE FROM wpost WHERE author_id= :myid";
     $remeveAccount = $conn->prepare($remeveAccount_sql);
     $remeveAccount->bindParam(':myid',$myid,PDO::PARAM_STR);
     $remeveAccount->execute();
     $remeveAccount_sql = "DELETE FROM notifications WHERE from_id= :myid";
     $remeveAccount = $conn->prepare($remeveAccount_sql);
     $remeveAccount->bindParam(':myid',$myid,PDO::PARAM_STR);
     $remeveAccount->execute();
     $remeveAccount_sql = "DELETE FROM saved WHERE user_saved_id= :myid";
     $remeveAccount = $conn->prepare($remeveAccount_sql);
     $remeveAccount->bindParam(':myid',$myid,PDO::PARAM_STR);
     $remeveAccount->execute();
     $remeveAccount_sql = "DELETE FROM supportbox WHERE from_id= :myid";
     $remeveAccount = $conn->prepare($remeveAccount_sql);
     $remeveAccount->bindParam(':myid',$myid,PDO::PARAM_STR);
     $remeveAccount->execute();
     header("location: login");
}
}
// =============================[ add auto reply ]=================================
if (isset($_POST['btn_out_in'])) {
	$sid = $_SESSION['id'];
	$out_w = filter_var(htmlentities($_POST['out_w']),FILTER_SANITIZE_STRING);
	$in_w = filter_var(htmlentities($_POST['in_w']),FILTER_SANITIZE_STRING);
	$iptdbsql = "INSERT INTO out_in_words
(in_word,out_word,for_au)
VALUES
( :in_word, :out_word, :sid)
";
$insert_post_toDB = $conn->prepare($iptdbsql);
$insert_post_toDB->bindParam(':in_word', $in_w,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':out_word', $out_w,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':sid', $sid,PDO::PARAM_STR);
$insert_post_toDB->execute();
}
// =============================[ Remove auto reply ]=================================
if (isset($_POST['btndloutin'])) {
	$id = filter_var(htmlentities($_POST['delin_out']),FILTER_SANITIZE_STRING);
     $remeveAccount_sql = "DELETE FROM out_in_words WHERE id= :id";
     $remeveAccount = $conn->prepare($remeveAccount_sql);
     $remeveAccount->bindParam(':id',$id,PDO::PARAM_STR);
     $remeveAccount->execute();
}
?>
<html dir="<?php echo lang('html_dir'); ?>">
<head>
    <title>Account settings &bull; Fero</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
     <?php include "includes/head_imports_main.php";?>
	 	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"><style>.no-js #loader {display:none;}
.js #loader{
	display:block;
}
.se-pre-con{
	position:fixed;
	left:0px;
	top:0px;
	width:100%;
	height:100%;
	z-index:9999;
	background:white;
	text-align:center;
}
.iconsa{
	margin-top:35px;
	width:35%;
}
@media screen and (max-width:600px){
	.iconsa{
		margin-top:200px;
		width:50%;
	}
}
.accou_tyu{
	display:none;
}
</style>
</head>
<body style="overflow-y: scroll"><script>
	$(window).load(function(){
	$(".se-pre-con").fadeOut("slow");});
</script>
<div class="se-pre-con"><img class="iconsa" src="imgs/logo.ico" alt="logo"></div>
<!--=============================[ NavBar ]========================================-->
<!--=============================[ Div_Container ]========================================-->

<div class="w3-bar w3-top w3-black w3-large" style="z-index:4">
  <button class="w3-bar-item w3-<?php echo lang('w_post_align'); ?> w3-button w3-hide-large w3-hover-none w3-hover-text-light-grey" onClick="w3_open();"><i class="fa fa-bars"></i> <?php echo lang('Menu'); ?></button>
  <span class="w3-bar-item w3-<?php echo lang('w_post_li2'); ?>">fero<!-- i can add any thing here --></span>
</div>
<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-collapse w3-overflow-x w3-white w3-animate-<?php echo lang('w_post_align'); ?>" style="z-index:3;width:300px;" id="mySidebar"><br>
  <div class="w3-container w3-row">
    <div class="w3-col s<?php echo lang('arrs'); ?>">
      <a href='u/<?php echo $_SESSION['Username']; ?>' target="_self"><img src="<?php echo 'imgs/user_imgs/'.$_SESSION['Userphoto']; ?>" class="w3-circle w3-margin-right" style="width:46px"></a>
    </div>
    <div class="w3-col s<?php echo lang('arr'); ?> w3-bar">
      <span><?php echo lang('welcomes'); ?>, <strong><?php echo "<a href='u/".$_SESSION['Username']."' style='color: #000000'>".$_SESSION['Fullname']."</a>"; if ($_SESSION['verify'] == "1"){echo $verifyUser;} ?></strong></span><br>
      <a href="<?php echo $dircheckPath; ?>conactor" class="w3-button" title="Contactor"><i class="fa fa-envelope"></i><span id="messagesCount"></span></a>
      <a href="settings?tc=edit_profile" class="w3-button" title="Profile settings"><i class="fa fa-user"></i></a>
      <a class="w3-button" id="myBtn" href="javascript:void(0)"><i class="fa fa-cog"></i></a>
    </div>
  </div>
  <hr>
  <div class="w3-container">
    <h5><? echo lang('dashboard'); ?></h5>
  </div>
  <div class="w3-bar-block">
    <p><a href="#" class="w3-bar-item w3-button w3-padding-16 w3-hide-large w3-dark-grey w3-hover-black" onClick="w3_close()" title="close menu"><i class="fa fa-remove fa-fw"></i> <?php echo lang('Close_Menu'); ?></a></p>
<ul class="tab" id="settings_ultab">
    <li>
        <a href="?tc=general" id="a_general">
            <p class="w3-bar-item w3-button <?php if($tc == 'general'){echo 'tablinksActive';} ?>" id="ma"><span class="fa fa-cogs"></span> <?php echo lang('general'); ?></p>
        </a>
    </li>

    <li>
            <a href="?tc=edit_profile" id="a_edit_profile"><p class="w3-bar-item w3-button <?php if($tc == 'edit_profile'){echo 'tablinksActive';} ?>" id="ma"><span class="fa fa-user-o"></span> <?php echo lang('edit_profile'); ?></p></a>
    </li>
    <li>
            <a href="?tc=account_type" id="a_edit_profile"><p class="w3-bar-item w3-button <?php if($tc == 'account_type'){echo 'tablinksActive';} ?>" id="ma"><span class="fa fa-user-o"></span> <?php echo lang('accu_ty'); ?></p></a>
    </li>
    <li>
        <a href="?tc=language" id="a_language">
            <p class="w3-bar-item w3-button <?php if($tc == 'language'){echo 'tablinksActive';} ?>" id="ma"><span class="fa fa-language"></span> <?php echo lang('language'); ?></p>
        </a>
    </li>

	    <li>
        <a href="?tc=contac_asses" id="a_contac_asses">
            <p class="w3-bar-item w3-button <?php if($tc == 'contac_asses'){echo 'tablinksActive';} ?>" id="ma"><span class="fa fa-language"></span> <?php echo lang('auto_ans'); ?></p>
        </a>
    </li>

    <li>
        <a href="?tc=remove_account" id="a_removeA">
            <p class="w3-bar-item w3-button <?php if($tc == 'remove_account'){echo 'tablinksActive';} ?>" id="ma"><span class="fa fa-trash"></span> <?php echo lang('remove_account'); ?></p>
        </a>
    </li>
</ul>
</div>
</nav>


<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onClick="w3_close()" style="cursor: pointer" title="close side menu" id="myOverlay"></div>
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->


	<!-- navbar end -->
<div class="w3-main" align="<?php echo lang('w_post_align'); ?>" style="margin-<?php echo lang('w_post_align'); ?>:300px;margin-top:43px;text-align:<?php echo lang('w_post_align'); ?>;direction: <?php echo lang('w_post_dir'); ?>">
<div class="w3-bottom">
<div class="w3-bar w3-white"><a href="story" class="w3-bar-item w3-button" style='color:orange' target="_self" title="story"><i class="fa fa-star"></i></a>
<a href="u/<?php echo $_SESSION['Username']; ?>" class="w3-bar-item w3-button" target="_self" title="profile"><i class="fa fa-user"></i></a>
<a href="search" class="w3-bar-item w3-button" target="_self" title="search"><i class="fa fa-search"></i></a>
<a href="post" class="w3-bar-item w3-button" target="_self" title="add an image"><i class="fa fa-upload"></i></a>
<a href="explore" class="w3-bar-item w3-button" target="_self" title="explore"><i class="fa fa-compass"></i></a>
<a href="home" class="w3-bar-item w3-button" target="_self" title="home"><i class="fa fa-home"></i></a>
</div>
</div>
<div class="main_container">
<div class="settings" style="text-align:<?php echo lang('textAlign'); ?>;">
<!--====================[ Edit profile section ]======================-->
<?php switch ($tc) { ?>
<?php case 'edit_profile': ?>
<div style="min-width:100%" id="Edit_profile" class="tabcontent" style="height: auto;">
    <p align="center" id="about_save_result"><?php echo $EditProfile_save_result; ?></p>
    <form action="" method="post">
	<div id="personal" class="accou_tyu" style="<?php if (!empty($_SESSION['accou_typ'] == "personal")) {echo "display:block";}?>">
    <p>
    <p class="settings_fieldTitle"><?php echo lang('education'); ?></p>
    <input dir="auto" class="settings_textfield" type="text" name="edit_school" value="<?php echo $_SESSION['school']; ?>" style="width:40%" /></p>
    <p>
    <p class="settings_fieldTitle"><?php echo lang('work'); ?></p>
    <input dir="auto" class="settings_textfield" type="text" name="edit_work0" placeholder="<?php echo lang('work_title'); ?>" style="width: 18%;" value="<?php echo $_SESSION['work0']; ?>" /><span class="settings_tf_mergeSpan"><?php echo lang('at'); ?></span><input dir="auto" class="settings_textfield" type="text" name="edit_work" placeholder="<?php echo lang('work_place'); ?>" style="width: 18%;" value="<?php echo $_SESSION['work']; ?>" /></p>
    <p>
	<p class="settings_fieldTitle"><?php echo lang('Work_detailes'); ?></p>
    <input dir="auto" class="settings_textfield" type="text" name="work_detail" style="width: 40%;" value="<?php echo $_SESSION['work_detail']; ?>" /></p>
    <p class="settings_fieldTitle"><?php echo lang('Work_free'); ?>
<p><?php echo lang('work_free_hint'); ?>	 <br><input type="radio" name="work_free" value="1" <?php if($_SESSION['work_free']== "1"){echo"checked";} ?>></p></p>
<p class="settings_fieldTitle"><?php echo lang('Get_work'); ?>
<p><?php echo lang('Get_work_hint'); ?> <br><input type="radio" name="work_free" value="2" <?php if($_SESSION['work_free']== "2"){echo"checked";} ?>> <input class="settings_textfield" style="color:green;width:40%;" placeholder="<?php echo lang('Price'); ?>" value="<?php echo $_SESSION['work_price']; ?>" name="work_price" type="number"></p></p>

	<p>
    <p class="settings_fieldTitle"><?php echo lang('country'); ?></p>
    <select style="width:40%;" class="settings_textfield" name="edit_country">
        <option selected disabled hidden><?php
        if (!empty($_SESSION['country'])) {echo $_SESSION['country'];}else{echo "Select your country";}?></option>
        <?php foreach($countries as $key => $value) { ?>
        <option <?php if($_SESSION['country'] == "$value"){ echo "selected";} ?> value="<?= htmlspecialchars($value) ?>" title="<?= $key ?>"><?= htmlspecialchars($value) ?></option>
        <?php } ?>
    </select></p>
        <p>
        <p class="settings_fieldTitle"><?php echo lang('birthday'); ?></p>
        <?php
        $exBthD = explode("/", $_SESSION['birthday']);
        echo '<select name="bd_year" class="settings_textfield"  style="width:15%;">';
            for($i = date('Y'); $i >= date('Y', strtotime('-100 years')); $i--){
              if ($exBthD[0] == $i) {
                 echo "<option selected='selected' value='$i'>$i</option>";
              }else{
                echo "<option value='$i'>$i</option>";
              }
            }
        echo '</select> ';
        echo '<select name="bd_month" class="settings_textfield" style="width:15%;">';
            for($i = 1; $i <= 12; $i++){
              $i = str_pad($i, 2, 0, STR_PAD_LEFT);
              if ($exBthD[1] == $i) {
                 echo "<option selected='selected' value='$i'>$i</option>";
              }else{
                echo "<option value='$i'>$i</option>";
              }
            }
        echo '</select> ';
        echo '<select name="bd_day" class="settings_textfield" style="width:15%;">';
            for($i = 1; $i <= 31; $i++){
              $i = str_pad($i, 2, 0, STR_PAD_LEFT);
              if ($exBthD[2] == $i) {
                 echo "<option selected='selected' value='$i'>$i</option>";
              }else{
                echo "<option value='$i'>$i</option>";
              }
            }
        echo '</select> ';
        ?>
        </p>
		</div>
		<div id="bussiness" class="accou_tyu" style="<?php if (!empty($_SESSION['accou_typ'] == "bussiness")) {echo "display:block";}?>">
		    <p><p class="settings_fieldTitle"><?php echo lang('Bussiness_type'); ?></p>
    <select style="width:40%;" name="bussiness_ty" class="settings_textfield">
<optgroup label="Retailer">
  <option>E-tailer</option>
  <option>Independent/COOP/Natural Product</option>
  <option>Chain Natural Products Store</option>
  <option>Gourmet/Specialty Products</option>
  <option>Personal Care</option>
  <option>Independent Grocer</option>
  <option>Conventional Supermarket</option>
  <option>Discount/Mass Merchandiser</option>
  <option>Chain Drug Store/Pharmacy</option>
  <option>Gift/Bookstore</option>
  <option>Independent Drug Store/Pharmacy</option>
  <option>Mail Order Catalog</option>
  <option>Home and Textile</option>
  <option>Convenience Store</option>
  <option>Pet Supply Store/Grooming</option>
</optgroup>
<optgroup label="Health Practitioner">
  <option>Alternative Health Clinic/Practitioner</option>
  <option>Medical Professional</option>
  <option>Health Club/Gym</option>
  <option>Spas/Salons</option>
</optgroup>
<optgroup label="Distributor (Finished Goods)">
    <option>Wholesaler of Finished Products</option>
  <option>Importer/Exporter of Finished Products</option>
  <option>Broker of Finished Products</option>
  <option>Third Party Distributor of Finished Products/Ingredient Distributor</option>
</optgroup>
<optgroup label="Food Service">
  <option>Full Service Restaurant</option>
  <option>School/University</option>
  <option>Tea Room/Coffee House</option>
  <option>Hotel/Resort/Airline</option>
  <option>Quick Serve Restaurant</option>
  <option>Caterer/Private Chef</option>
  <option>Corporate Dining</option>
  <option>Clubs; Country/Membership/Health</option>
</optgroup>
<optgroup label="Supplier/Raw Ingredient Distributor">
    <option>Raw Ingredient Producer/Supplier</option>
  <option>Ingredient Importer/Exporter</option>
  <option>Equipment Supplier</option>
  <option>Farm/Grower</option>
</optgroup>
<optgroup label="Manufacturer">
  <option>  Food
  <option>Cosmetic/Personal Care</option>
  <option>Natural Living/Home/Textile</option>
  <option>Pet Products/Animal Nutrition</option>
  <option>Vitamin/Mineral/Herb/Supplements</option>
  <option>Pharmaceuticals</option>
  <option>Nutraceuticals</option>
  <option>Contract Manufacturer</option>
  </optgroup>
<optgroup label="Business Services">
  <option>  Consultant</option>
  <option>Advertising/Branding/PR
  <option>Government Agency</option>
  <option>Financial Institution/Investment Bank</option>
  <option>Not for Profit</option>
  <option>Association</option>
  <option>Packaging/Design</option>
  <option>Publisher</option>
  <option>Laboratory/Testing</option>
  <option>School/University Research</option>
  <option>Legal/Regulatory</option>
  <option>Other Within the Industry (must specify)</option>
  </optgroup>
<optgroup label="Investor">
    <option>Private Equity Fund</option>
  <option>Corporate Investor</option>
  <option>Angel/Individual Investor</option>
  <option>Hedge Fund</option>
  <option>Peer-to-Peer/Crowdfunding</option>
  </optgroup>
  <option></option>
    </select></p>
		<p class="settings_fieldTitle"><?php echo lang('Bussiness_discribtion'); ?></p>
		<input dir="auto" class="settings_textfield" name="bussins_des" type="text" style="width: 40%;" value="<?php echo $_SESSION['bussins_des']; ?>" /></p>
		<p class="settings_fieldTitle">Adress</p>
		    <input dir="auto" placeholder="<?php echo lang('address'); ?> 1" class="settings_textfield" type="text" name="bussinessad1" style="width: 40%;" value="<?php echo $_SESSION['address1']; ?>" /></p>
		    <input dir="auto" placeholder="<?php echo lang('address'); ?> 2" class="settings_textfield" type="text" name="bussinessad2" style="width: 40%;" value="<?php echo $_SESSION['address2']; ?>" /></p>
		<p class="settings_fieldTitle"><?php echo lang('Telephone/mobile_number'); ?></p>
    <input dir="auto" placeholder="<?php echo lang('Telephone/mobile_number'); ?> 1" class="settings_textfield" type="tel" name="mob_no1" style="width: 40%;" value="<?php echo $_SESSION['mob_no1']; ?>" /></p>
    <input dir="auto" placeholder="<?php echo lang('Telephone/mobile_number'); ?> 2" class="settings_textfield" type="tel" name="mob_no2" style="width: 40%;" value="<?php echo $_SESSION['mob_no2']; ?>" /></p>
</div>
		<div id="deliver" class="accou_tyu" style="<?php if (!empty($_SESSION['accou_typ'] == "deliver")) {echo "display:block";}?>">
		<p class="settings_fieldTitle"><?php echo lang('Vehical_type'); ?></p>
   <select style="width:40%;" class="settings_textfield" name="bussinesstypr">
<option>Car</option>
<option>scooter</option>
<option>bike</option>
<option>on feet</option>
    </select>
	</div>
        <p class="settings_fieldTitle"><?php echo lang('pb_em'); ?></p>
    <input type="checkbox" name="em_pub" value="1" <?php if($_SESSION['em_pub']== "1"){echo"checked";} ?>>
	</p>
		<p>
        <p class="settings_fieldTitle"><?php echo lang('website'); ?></p>
        <input dir="auto" class="settings_textfield" type="text" style="width:40%;" name="edit_website" value="<?php echo $_SESSION['website']; ?>" /></p>
        <p>
        <p class="settings_fieldTitle"><?php echo lang('bio'); ?></p>
        <textarea style="resize:none;height: 100px" dir="auto" class="settings_textfield" placeholder="150" maxlength="150" type="text" name="edit_bio"><?php echo $_SESSION['bio']; ?></textarea></p>
        <p>
        <div style="background: #e9ebee; border-radius: 3px; padding: 15px;">
         <p><input class="settings_textfield" type="password" name="EditProfile_current_pass" placeholder="<?php echo lang('current_password'); ?>" style="background: #fff;" /></p>
         <p style="margin: 0;"><input class="btn_blue" name="EditProfile_save_changes" type="submit" value="<?php echo lang('save_changes'); ?>" /></p>
		 </div>
    </form>
</div>
<?php break; ?>
<!--====================[ Languages section ]======================-->
<?php case 'language': ?>
<div id="Language" class="tabcontent" style="height: auto;">
         <p align="center" id="lang_save_result"><?php echo $lang_save_result; ?></p>
    <form action="" method="post">
        <p>
        <select class="settings_textfield" name="edit_language">
            <option <?php if($_SESSION['language'] == "English"){ echo "selected";} ?> >English</option>
        <option <?php if($_SESSION['language'] == "العربية"){ echo "selected";} ?> >العربية</option>
        </select>
        </p>
        <div style="background: #e9ebee; border-radius: 3px; padding: 15px;">
         <p><input class="settings_textfield" type="password" name="lang_current_pass" placeholder="<?php echo lang('current_password'); ?>" style="background: #fff;" /></p>
         <p style="margin: 0;"><input class="btn_blue" name="lang_save_changes" type="submit" value="<?php echo lang('save_changes'); ?>" /></p>
         </div>
    </form>
</div>
<?php break; ?>
<?php case 'account_type': ?>
<div id="Language" class="tabcontent" style="height: auto;">
         <p align="center" id="lang_save_result"><?php echo $lang_save_result; ?></p>
    <form action="" method="post">
	        <p>
        <select class="settings_textfield" name="accou_typ">
            <option <?php if($_SESSION['accou_typ'] == "personal"){ echo "selected";} ?> >personal</option>
        <option <?php if($_SESSION['accou_typ'] == "bussiness"){ echo "selected";} ?> >bussiness</option>
        <option <?php if($_SESSION['accou_typ'] == "cartor"){ echo "selected";} ?> >cartor</option>
        <option <?php if($_SESSION['accou_typ'] == "deliver"){ echo "selected";} ?> >deliver</option>
        </select>
        </p>
		        <div style="background: #e9ebee; border-radius: 3px; padding: 15px;">
         <p><input class="settings_textfield" type="password" name="accouty_current_pass" placeholder="<?php echo lang('current_password'); ?>" style="background: #fff;" /></p>
         <p style="margin: 0;"><input class="btn_blue" name="accoun_ty_save_changes" type="submit" value="<?php echo lang('save_changes'); ?>" /></p>
         </div>
</form>
</div>
<?php break; ?>
<!--====================[ Remove account section ]======================-->
<?php case 'remove_account': ?>
<div id="remove_account" class="tabcontent" style="height: auto;">
<form action="" method="post">
    <div style="background: #e9ebee; border-radius: 3px; padding: 15px;">
    <p style="background: rgba(247, 81, 81, 0.14); color: #f75151; padding: 15px; border: 1px solid #f75151; border-radius: 3px;"><?php echo lang('remove_account_note'); ?></p>
    <p><input class="settings_textfield" type="password" name="removeA_current_pass" placeholder="<?php echo lang('current_password'); ?>" style="background: #fff;" /></p>
    <p style="margin: 0;"><input class="red_flat_btn" name="removeA_save_changes" type="submit" value="<?php echo lang('remove_account'); ?>" /></p>
    </div>
    <p align="center" id="removeA_save_result"><?php echo $removeA_save_result; ?></p>
</form>
</div>
<?php break; ?>
<?php case 'language': ?>
<div id="Language" class="tabcontent" style="height: auto;">
         <p align="center" id="lang_save_result"><?php echo $lang_save_result; ?></p>
    <form action="" method="post">
        <p>
        <select class="settings_textfield" name="edit_language">
            <option <?php if($_SESSION['language'] == "English"){ echo "selected";} ?> >English</option>
        <option <?php if($_SESSION['language'] == "العربية"){ echo "selected";} ?> >العربية</option>
        </select>
        </p>
        <div style="background: #e9ebee; border-radius: 3px; padding: 15px;">
         <p><input class="settings_textfield" type="password" name="lang_current_pass" placeholder="<?php echo lang('current_password'); ?>" style="background: #fff;" /></p>
         <p style="margin: 0;"><input class="btn_blue" name="lang_save_changes" type="submit" value="<?php echo lang('save_changes'); ?>" /></p>
         </div>
    </form>
</div>
<?php break; ?>
<!--====================[ assesst my contactor ]======================-->
<?php case 'contac_asses': ?>
<div id="remove_account" class="tabcontent" style="height: auto;">
<form action="" method="post">
    <div style="background: #e9ebee; border-radius: 3px; padding: 15px;">
    <p style="background: rgba(247, 81, 81, 0.14); color: #f75151; padding: 15px; border: 1px solid #f75151; border-radius: 3px;">You can can add auto replying in contactor.</p>
    <p><input class="settings_textfield" type="text" name="in_w" placeholder="<?php echo lang('input_word'); ?>" style="background: #fff;" required /></p>
    <p><input class="settings_textfield" type="text" name="out_w" placeholder="<?php echo lang('output_word'); ?>" style="background: #fff;" required /></p>
    <p style="margin: 0;"><input class="blue_flat_btn" name="btn_out_in" type="submit" value="Add this function" /></p>

    </div>
	</form>
	<form action="" method="post">
		<div class="main_container" align="center">
    <div style="min-width:100%;" align="center">
        <div align="left">
        <table class="postSavedTablei" style="border-radius:10px;min-width:100%;">
            <tr style="font-weight: bold; text-transform: uppercase; color: rgba(0, 0, 0, 0.59); font-size: 13px; background: rgb(241, 241, 241); border-bottom: 2px solid #46a0ec;">
                <td align="left"><?php echo lang('input_word'); ?></td>
                <td align="left"><?php echo lang('output_word'); ?></td>
                <td align="center"><span class="fa fa-cog"></span></td>
            </tr>
	<?php
	$for_au = $_SESSION['id'];
$vpsql = "SELECT * FROM out_in_words WHERE for_au = :for_au";
$view_posts = $conn->prepare($vpsql);
$view_posts->bindValue(':for_au', $for_au, PDO::PARAM_INT);
$view_posts->execute();
$view_postsNum = $view_posts->rowCount();

if ($view_postsNum > 0) {
while ($postsfetch = $view_posts->fetch(PDO::FETCH_ASSOC)) {
	$id = $postsfetch['id'];
	$out_word = $postsfetch['out_word'];
	$in_word = $postsfetch['in_word'];
	echo "<tr>
<td>$in_word</td>
<td>$out_word</td>
</div><td align='center'><a href='u' style='color: gray;font-size: 14px;'><input type='radio' name='delin_out' value='$id'></a></td>
</tr>";

}}
	?>


						<!--code here-->
        </table>
		</div>
		</div>
		<br><br><button type='submit' style="float:left" class="blue_flat_btn" name='btndloutin'><?php echo lang('delete'); ?></button>
</form>
</div>
<?php break; ?>
<!--====================[ General section ]======================-->
<?php default: ?>
    <div id="General" class="tabcontent" style="height: auto;">
         <p align="center" id="general_save_result"><?php echo $general_save_result; ?></p>
        <form action="" method="post">
            <p>
            <p class="settings_fieldTitle"><?php echo lang('fullname'); ?> <span><?php echo lang('required'); ?></span></p>
            <input dir="auto" class="settings_textfield" type="text" name="edit_fullname" value="<?php echo $_SESSION['Fullname']; ?>" /></p>
            <p>
            <p class="settings_fieldTitle"><?php echo lang('username'); ?> <span><?php echo lang('required'); ?></span></p>
            <input dir="auto" class="settings_textfield" type="text" name="edit_username" value="<?php echo $_SESSION['Username']; ?>" /></p>
            <p>
            <p class="settings_fieldTitle"><?php echo lang('email'); ?> <span><?php echo lang('required'); ?></span></p>
            <input dir="auto" class="settings_textfield" type="text" name="edit_email" value="<?php echo $_SESSION['Email']; ?>" /></p>
            <p>
            <p class="settings_fieldTitle"><?php echo lang('phone'); ?> <span><?php echo lang('required'); ?></span></p>
            <input dir="auto" class="settings_textfield" type="text" name="edit_phone" value="<?php echo $_SESSION['phone']; ?>" /></p>
            <p>
            <p class="settings_fieldTitle"><?php echo lang('new_password'); ?></p>
            <input class="settings_textfield" type="password" name="new_pass" /></p>
            <p>
            <p class="settings_fieldTitle"><?php echo lang('confirm_new_password'); ?></p>
            <input class="settings_textfield" type="password" name="rewrite_new_pass" /></p>
             <p>
            <p class="settings_fieldTitle"><?php echo lang('gender'); ?> <span><?php echo lang('required'); ?></span></p>
             <select class="settings_textfield" name="gender">
             <option <?php if($_SESSION['gender'] == "Male"){ echo "selected";} ?> ><?php echo lang('male'); ?></option>
             <option <?php if($_SESSION['gender'] == "Female"){ echo "selected";} ?> ><?php echo lang('female'); ?></option>
             </select>
             </p>
             <div style="background: #e9ebee; border-radius: 3px; padding: 15px;">
                 <p><input class="settings_textfield" type="password" name="general_current_pass" placeholder="<?php echo lang('current_password'); ?>" style="background: #fff;" /></p>
                <p style="margin: 0;"><input class="btn_blue" name="general_save_changes" type="submit" value="<?php echo lang('save_changes'); ?>" /></p>
             </div>
            </form>
    </div>
<?php /*//////////////////////////////////////////////////////*/ break; } ?>
</div>
    </div>
    <!--===============================[ End ]==========================================-->
    <?php include("includes/footer.php");?>
	<script src="js/side.js"></script>
</body>
</html>
