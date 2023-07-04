<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();
include("config/connect.php");
include("includes/fetch_users_info.php");
include ("includes/time_function.php");
include ("includes/num_k_m_count.php");
if(!isset($_SESSION['Username'])){
    header("location: index");
}
if (is_dir("imgs/")) {
        $check_path = "";
    }elseif (is_dir("../imgs/")) {
        $check_path = "../";
    }elseif (is_dir("../../imgs/")) {
        $check_path = "../../";
    }
?>
<html dir="<?php echo lang('html_dir'); ?>">
<head>
    <title>Home &bull; Fero</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awsome.min.css" rel="stylesheet">
<link href="css/tex.css" rel="stylesheet">
<link href="css/img_s.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jguery/2.2.4/jquery.min.js"></script>
<style>
html {
scoll-behave: smooth;
}
.container {
  position: relative;
  text-align: center;
  color: white;
}
audio {
  left: 10px;
  bottom: 10px;
  width: calc(100% - 20px);
}
.not{
    display: none;
    position: fixed;
    top: 53px;
    background: #ffffff;
    margin: 0px 8px;
    width: 435px;
    height: auto;
    max-height: 600px;
    max-width: 435px;
    border-radius: 2px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.37);
}
.ad-bt{
background-color: blue;
color: #FFFFFF;
width: 99%;
height: 25px;
}
.ad-bt:hover{
	background-color: purple;
}
.ad-bt:active{
	background-color: aqua;
}
.posto{
    background: white;
    border-radius: 4px;
    box-shadow: 0px 0px 18px rgba(63, 81, 181, 0.16);
    max-width: 560px;
    margin: -5px 5px;
    border: 1px solid transparent;
}
@media screen and (max-width:600px){
.mn{
   display:none;
}}
.no-js #loader {display:none;}
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
</style>
    <?php include "includes/head_imports_main.php"; ?>
</head>
<body onLoad="fetchPosts_DB('home');" class="w3-light-grey">
	<script>
	$(window).load(function(){
	$(".se-pre-con").fadeOut("slow");});
</script>
<div class="se-pre-con"><img class="iconsa" src="imgs/logo.ico" alt="logo"></div>
<div id="div" class="<?php echo $_SESSION['night']; ?>">
<!--=============================[ NavBar ]========================================-->
		<!-- Top container -->
<div class="w3-bar w3-top w3-black w3-large" style="z-index:4">
  <button class="w3-bar-item w3-<?php echo lang('w_post_align'); ?> w3-button w3-hide-large w3-hover-none w3-hover-text-light-grey" onClick="w3_open();"><i class="fa fa-bars"></i> <?php echo lang('Menu'); ?></button>
  <span class="w3-bar-item w3-<?php echo lang('w_post_li2'); ?>">fero<!-- i can add any thing here --></span>
</div>
<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-collapse w3-overflow-x w3-white w3-animate-<?php echo lang('w_post_align'); ?>" style="z-index:3;width:300px;" id="mySidebar"><br>
  <div class="w3-container w3-row">
    <div class="w3-col s<?php echo lang('arrs'); ?>">
      <a href='u/<?php echo $_SESSION['Username']; ?>' target="_self"><div class="w3-circle w3-margin-right" style="width:46px;height:46px;"><img src="<?php echo 'imgs/user_imgs/'.$_SESSION['Userphoto']; ?>" style="width:100%;height:100%;"></div></a>
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
    <p><a href="#" class="<? echo lang('sid'); ?> w3-button w3-padding-16 w3-hide-large w3-dark-grey w3-hover-black" onClick="w3_close()" title="close menu"><i class="fa fa-remove fa-fw"></i> <?php echo lang('Close_Menu'); ?></a></p>
	<?php if($_SESSION['accou_typ'] == "deliver"){echo"<p><a href='deliver' target='_self' id='ma' class='".lang('sid')." w3-button' title='Upload posts'><i class='fa fa-briefcase'></i> ".lang('deliver')."</a></p>";}else{ echo"<p><a href='post' target='_self' id='ma' class='" .lang('sid')." w3-button' title='Upload posts'><i class='fa fa-camera'></i> " .lang('Upload_some_Posts')."</a></p>";
	}?><p><a href="posts/saved" target="_self" id="ma" class="<? echo lang('sid'); ?> w3-button" title="Now you can save a bookmark for any post"><i class="fa fa-bookmark"></i> <?php echo lang('saved_posts'); ?></a></p>
	<p><a href="corona" target="_self" id="ma" class="<? echo lang('sid'); ?> w3-button" title="corona virus news"><i class="fa fa-home"></i> <?php echo lang('Corona_virus_news'); ?></a></p>
	<!-- settings -->
<p><a id="myBtn" href="settings" class="<? echo lang('sid'); ?> w3-button" title="Account settings"><i class="fa fa-cog fa-fw fa-spin"></i> <?php echo lang('settings'); ?></a></p>
<p><a href="<?php echo $dircheckPath; ?>logout" target="_self" id="ma" class="<? echo lang('sid'); ?> w3-button" title="Sign out from your account">&bull; <?php echo lang('sign_out'); ?></a></p>
<div style="display:inline;padding:0;margin:0;" class="collapse navbar-collapse" id="myNavbar">

            <ul class="<?php echo lang('ul_navbar_nav1'); ?>">
                <?php
                if (is_file("home.php")) {
                    $homePath = "home";
                }elseif (is_file("../home.php")) {
                    $homePath = "../home";
                }elseif (is_file("../../home.php")) {
                    $homePath = "../../home";
                }
                ?>
<p><a href="javascript:void(0);" class="<? echo lang('sid'); ?> w3-button" title="notification" id="nav_Noti_Btn"><span class="fa fa-bell"></span> <?php echo lang('notifications'); ?><span id="notificationsCount"></span></a></p>
                <div class="not" id="notifications_box">
                <div style="position:relative;padding: 5px 10px;border-bottom: 1px solid #ccc;text-align: <?php echo lang('textAlign'); ?>"><?php echo lang('notifications'); ?>
                    <span class="toTopArrow" span class='toTopArrow' style="position: absolute; top: -10px;<?php echo lang('float'); ?>:8px;"></span>
                </div>
                <div id="notifications_rP" class="scrollbar" style="max-height: 450px; overflow-y: scroll;">
                    <div id="notifications_r" data-load="0">
                        <div id="notifications_data"></div>
                        <p style='width: 100%;border:none;display: none' id="notifications_loading" align='center'><img src='<?php echo $dircheckPath; ?>imgs/loading_video.gif' style='width:20px;box-shadow: none;height: 20px;'></p>
                        <p id="notifications_noMore" style='display:none;color:#9a9a9a;font-size:14px;text-align:center;'><?php echo lang('no_notifications'); ?></p>
                        <input type="hidden" id="notifications_load" value="0">
                    </div>
                </div>
                <div id='sqresultItem' align='center' style='background: #efefef; border: 1px solid #e0e0e0;'>
                <a href='<?php echo $dircheckPath; ?>notifications'>
                <div style='display: inline-flex;width: 100%;'>
                <p style='font-size:13px;'><?php echo lang('see_all'); ?>
                </p>
                </div>
                </a>
                </div>
                </div>
                <div style="display:inline;" id="nav_newNotify" data-show='0'></div>
                </li>
            </ul>

        </div>
<div style="" id='nSound'></div>
<?php include ($dircheckPath."js/navbar_nottifi_js.php"); ?>
<p><a href="./settings?tc=language" id="ma" class="<? echo lang('sid'); ?> w3-button"title="Change the current language"><i class="fa fa-language"></i> <?php echo lang('language'); ?></p></a></p>
<p><a id="ma" class="<? echo lang('sid'); ?> w3-button" href="page/report" title="Tell us any problem you faced in the website"><i class="fa fa-bug"></i> <?php echo lang('Report_A_Problem'); ?></a></p>
<p><a href="settings?tc=remove_account" target="_self" id="ma" class="<? echo lang('sid'); ?> w3-button" title="If you don't want your account just delete it"><i class="fa fa-trash"></i> <?php echo lang('Delete_account'); ?></a></p>
  </div>
</nav>


<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onClick="w3_close()" style="cursor: pointer" title="close side menu" id="myOverlay"></div>
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->


	<!-- navbar end -->
<div class="w3-main" align="<?php echo lang('w_post_align'); ?>" style="margin-<?php echo lang('w_post_align'); ?>:300px;margin-top:43px;text-align:<?php echo lang('w_post_align'); ?>;direction: <?php echo lang('w_post_dir'); ?>">
<div class="w3-bottom">
<div style="text-align: left;" class="w3-bar w3-white w3-large">
<a href="story" class="w3-bar-item w3-button" style='color:orange' target="_self" title="story"><i class="fa fa-star"></i></a>
<a href="u/<?php echo $_SESSION['Username']; ?>" class="w3-bar-item w3-button" target="_self" title="profile"><i class="fa fa-user"></i></a>
<a href="search" class="w3-bar-item w3-button" target="_self" title="search"><i class="fa fa-search"></i></a>
<a href="post" class="w3-bar-item w3-button" target="_self" title="add an image"><i class="fa fa-upload"></i></a>
<a href="explore" class="w3-bar-item w3-button" target="_self" title="explore"><i class="fa fa-compass"></i></a>
<a href="home" class="w3-bar-item w3-button" target="_self" title="home"><i class="fa fa-home"></i></a>

</div>
</div>

		   <?php
            $uid = $_SESSION['id'];
            $sqlQ = "SELECT aSetup FROM signup WHERE id=:uid";
            $sqlQ_check = $conn->prepare($sqlQ);
            $sqlQ_check->bindParam(':uid',$uid,PDO::PARAM_INT);
            $sqlQ_check->execute();
            while ($aSetupDB = $sqlQ_check->fetch(PDO::FETCH_ASSOC)) {
                $aSetupFromDb = $aSetupDB['aSetup'];
            }
            if ($aSetupFromDb != 100) {
            ?>
            <div id="AccountSetup" >
            <div class="posto" style="min-width: 99%;">
                <p style="padding: 8px; color: #03A9F4; font-size: 16px; border-bottom: 1px solid #ececec; margin: 10 15;text-align:<?php echo lang('textAlign') ?>;"><?php echo lang('accountSetup') ?></p>
                <!--==========[ Account Setup ]=========-->
                <div class="aSetup"  align="center">
                    <div class="aSetup_item">
                        <?php
                        $aSetupVal = array();
                        if(empty($_SESSION['Userphoto']) or $_SESSION['Userphoto'] == "user-male.png" or $_SESSION['Userphoto'] == "user-female.png"){
                            $cUphotoClass = "aSetup_item_empty";
                            $cUphotoColor = "color: #c3c3c3;";
                        }else{
                            $cUphotoClass = "aSetup_item_done";
                            $cUphotoColor = "color: #4bd37b;";
                            if (!in_array('Userphoto', $aSetupVal)) {
                                array_push($aSetupVal,'Userphoto');
                            }
                        } ?>
                        <div class="<?php echo $cUphotoClass; ?>"></div>
                        <p style="<?php echo $cUphotoColor; ?>"><?php echo lang('as_userPhoto') ?></p>
                        <?php if(!in_array('Userphoto', $aSetupVal)){ ?><a href="u/<?php echo $_SESSION['Username'] ?>"><?php echo lang('complete') ?></a><?php } ?>
                    </div>
                    <div class="aSetup_item">
                        <?php if(empty($_SESSION['uCoverPhoto'])){
                            $cCphotoClass = "aSetup_item_empty";
                            $cCphotoColor = "color: #c3c3c3;";
                        }else{
                            $cCphotoClass = "aSetup_item_done";
                            $cCphotoColor = "color: #4bd37b;";
                            if (!in_array('uCoverPhoto', $aSetupVal)) {
                                array_push($aSetupVal,'uCoverPhoto');
                            }
                        } ?>
                        <div class="<?php echo $cCphotoClass; ?>"></div>
                        <p style="<?php echo $cCphotoColor; ?>"><?php echo lang('as_coverPhoto') ?></p>
                        <?php if(!in_array('uCoverPhoto', $aSetupVal)){ ?><a href="u/<?php echo $_SESSION['Username'] ?>"><?php echo lang('complete') ?></a><?php } ?>
                    </div>
                    <div class="aSetup_item">
                        <?php if(empty($_SESSION['school']) or empty($_SESSION['work0']) or empty($_SESSION['work']) or empty($_SESSION['country']) or empty($_SESSION['website']) or empty($_SESSION['bio']) or empty($_SESSION['birthday'])){
                            $cInfoClass = "aSetup_item_empty";
                            $cInfoColor = "color: #c3c3c3;";
                        }else{
                            $cInfoClass = "aSetup_item_done";
                            $cInfoColor = "color: #4bd37b;";
                            if (!in_array('CompleteInfo', $aSetupVal)) {
                                array_push($aSetupVal,'CompleteInfo');
                            }
                        } ?>
                        <div class="<?php echo $cInfoClass; ?>"></div>
                        <p style="<?php echo $cInfoColor; ?>"><?php echo lang('as_profileInfo') ?></p>
                        <?php if(!in_array('CompleteInfo', $aSetupVal)){ ?><a href="settings?tc=edit_profile"><?php echo lang('complete') ?></a><?php } ?>
                    </div>
                    <div class="aSetup_item">
                        <?php
                        $uid = $_SESSION['id'];
                        $sqlQ = "SELECT * FROM follow WHERE uf_one = :uid";
                        $sqlQ_check = $conn->prepare($sqlQ);
                        $sqlQ_check->bindParam(':uid',$uid,PDO::PARAM_INT);
                        $sqlQ_check->execute();
                        $sqlQ_checkCount = $sqlQ_check->rowCount();
                        if ($sqlQ_checkCount > 0) {
                            $cFollowClass = "aSetup_item_done";
                            $cFollowColor = "color: #4bd37b;";
                            if (!in_array('followPeople', $aSetupVal)) {
                                array_push($aSetupVal,'followPeople');
                            }
                        }else{
                            $cFollowClass = "aSetup_item_empty";
                            $cFollowColor = "color: #c3c3c3;";
                        }
                        ?>
                        <div class="<?php echo $cFollowClass; ?>"></div>
                        <p style="<?php echo $cFollowColor; ?>"><?php echo lang('as_followPeople') ?></p>
                        <?php if(!in_array('followPeople', $aSetupVal)){ ?><a href="search"><?php echo lang('complete') ?></a><?php } ?>
                    </div>
                </div>
                <div class="aSetup_progrDiv" style="text-align: <?php echo lang('textAlign'); ?>">
                <?php
                $aSetupVal = count($aSetupVal);
                switch ($aSetupVal) {
                    case '1':
                        $aSetupProg = "25";
                    break;
                    case '2':
                        $aSetupProg = "50";
                    break;
                    case '3':
                        $aSetupProg = "75";
                    break;
                    case '4':
                        $aSetupProg = "100";
                    break;
                    default:
                        $aSetupProg = "0";
                    break;
                }
                ?>
                    <p style="width: <?php echo $aSetupProg; ?>%;"><?php if($aSetupProg > 0){echo $aSetupProg.'%';} ?></p>
                </div>

                </div>
            </div>
            <?php
            if ($aSetupProg == 100 ) {
                $uid = $_SESSION['id'];
                $sqlQ = "UPDATE signup SET aSetup = :aSetupProg WHERE id = :uid";
                $sqlQ_check = $conn->prepare($sqlQ);
                $sqlQ_check->bindParam(':aSetupProg',$aSetupProg,PDO::PARAM_INT);
                $sqlQ_check->bindParam(':uid',$uid,PDO::PARAM_INT);
                $sqlQ_check->execute();
                echo "<script>$('#AccountSetup').html('');</script>";
            }
            }
            ?>

            <!--==========[ End Account Setup ]=========-->
			<!-- story -->
				<!-- end story -->
				<!-- post -->
				<?php include "includes/fetch_posts_com.php"; ?>
                   <div id="FetchingPostsDiv">
                </div>
				<!-- post end -->
                <div class="post loading-info" id="LoadingPostsDiv" style="min-width: 99%;padding: 8px;padding-bottom: 100px;">
                    <div class="animated-background">
                        <div class="background-masker header-top"></div>
                        <div class="background-masker header-left"></div>
                        <div class="background-masker header-right"></div>
                        <div class="background-masker header-bottom"></div>
                        <div class="background-masker subheader-left"></div>
                        <div class="background-masker subheader-right"></div>
                        <div class="background-masker subheader-bottom"></div>
                        <div class="background-masker content-top"></div>
                        <div class="background-masker content-first-end"></div>
                        <div class="background-masker content-second-line"></div>
                        <div class="background-masker content-second-end"></div>
                        <div class="background-masker content-third-line"></div>
                        <div class="background-masker content-third-end"></div>
                    </div>
                </div>
				<!-- post load -->
                <div class="post  loading-info" id="NoMorePostsDiv" style="display: none;min-width: 99%;">
                  <p style="color: #b1b1b1;text-align: center;padding: 15px;margin: 0px;font-size: 18px;"><?php echo lang('noMoreStories'); ?></p>
                </div>
                <div class="post  loading-info" id="LoadMorePostsBtn" style="display: none;min-width: 99%;">
                  <button class="blue_flat_btn" style="width: 100%" onClick="fetchPosts_DB('home')"><?php echo lang('load_more'); ?></button>
                </div>
                <input type="hidden" id="GetLimitOfPosts" value="0">

				<!-- post load end -->
				<br>

		</div>
		</div>
<!--====================================[ end Center col2 ]============================================-->
<?php include "includes/endJScodes.php"; ?>
<script src="js/side.js"></script>
</body>
</html>
