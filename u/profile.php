<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();
$myId = $_SESSION['id'];
include("../config/connect.php");
include("../includes/fetch_users_info.php");
include("../includes/time_function.php");
include("../includes/country_name_function.php");
include("../includes/num_k_m_count.php");
if(!isset($_SESSION['Username'])){
    header("location: ../index");
}

$_SESSION['user_photo'] = $row_author_photo;
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
    <title><?php echo $row_username; ?> &bull; Fero</title>
    <meta charset="UTF-8">
    <meta name="description" content="<?php echo $row_bio; ?>">
    <meta name="keywords" content="fero, fero account, <?php echo $row_username; ?>, <?php echo $row_fullname; ?>, fero <?php echo $row_username; ?>, feras">
    <meta name="author" content="feras shita">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awsome.min.css" rel="stylesheet">
<link href="../tex.css" rel="stylesheet">
<link href="../css/img_s.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jguery/2.2.4/jquery.min.js"></script>
    <?php include "../includes/head_imports_main.php";?>
    </script>
    <style type="text/css">
        .user_info{
        text-align:<?php echo lang('user_info_align');?>;
        }
        .comment_field{
        text-align:<?php echo lang('comment_field_align');?>;
        }
        .coveruploadBtn{
        cursor: pointer;
        background: rgba(74, 74, 74, 0.33);
        padding: 10px 20px;
        border-radius: 3px;
        color: #fff;
        text-decoration: none;
        border: none;
        margin: auto;
        box-shadow: 0;
        -webkit-transition: background 0.3s,box-shadow 0.3s;
        -moz-transition: background 0.3s,box-shadow 0.3s;
        -o-transition: background 0.3s,box-shadow 0.3s;
        transition: background 0.3s,box-shadow 0.3s;
        }
        .coveruploadBtn:hover,.coveruploadBtn:focus{
        background: rgba(0, 0, 0, 0.75);
        box-shadow: 0px 0px 3px #4c4a4a;
        color: #fff;
        text-decoration: none;
        }
	.profile_coveri{
    background: #ced1d8;
    margin: 15px;
    padding: 0px;
    width: 98%;
    height: 40%;
    margin-top: 50px;
    margin-bottom: 0;
    border: 1px solid #f9f9f9;
    position:relative; 
}
@media screen and (max-width:600px){
	.profile_coveri{
	width: 95%;
}
.user_info{
    width: 98%;
}
	}
.profile_menui{
    background: white;
    border-radius: 0px 0px 5px 5px;
    margin: 0px 15px;
    width: 98%;
    color: #302F2F;
    position: relative;
}
.profile_cneterCol_2{
    text-align: left;
    width: 100%;
}
@media screen and (max-width:600px){
.profile_menu_details{
	display:none;
}}
.profile_menu_detailso{
	display:none;
}
@media screen and (max-width:600px){
.profile_menu_detailso{
	display:block;
}}
//computer
.mu{
	display:block;
}
@media screen and (max-width:600px){
.mu{
	display:none;
}}
.vyt{
	display:none;
}

//mobile
.nu{
	display:none;
}
@media screen and (max-width:600px){
	.vyt{
	display:block;
}
.nu{
	display:block;
}}
.container {
  position: relative;
  text-align: center;
  color: white;
}
@media screen and (max-width:600px){
.mn{
   display:none; 
}}
.storydiv{
	background: white;
    border-radius: 10px;
    box-shadow: 0px 0px 18px rgba(63, 81, 181, 0.16);
    max-width: 560px;
	width:30%;
	height:45%;
    margin: 6px 5px;
	display:inline-block;
    border: 1px solid transparent;
}
.pst{
	font-size:120px;
}
@media screen and (max-width:600px){
.pst{
font-size:100px;}}
@media screen and (max-width:600px){
.storydiv{
	width:35%;
	height:35%;
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
</head>
    <body onload="fetchPosts_DB('user')">
	<script>
	$(window).load(function(){
	$(".se-pre-con").fadeOut("slow");});		
</script>
<div class="se-pre-con"><img class="iconsa" src="../imgs/logo.ico" alt="logo"></div>
<!--=============================[ NavBar ]========================================-->
<?php include "../includes/navbar_main.php"; ?>

<div class="w3-bottom">
<div class="w3-bar w3-white w3-large">
<a href="../story" class="w3-bar-item w3-button" style='color:orange' target="_self" title="story"><i class="fa fa-star"></i></a>
<a href="../u/<?php echo $_SESSION['Username']; ?>" class="w3-bar-item w3-button" target="_self" title="profile"><i class="fa fa-user"></i></a>
<a href="../search" class="w3-bar-item w3-button" target="_self" title="search"><i class="fa fa-search"></i></a>
<a href="../post" class="w3-bar-item w3-button" target="_self" title="add an image"><i class="fa fa-upload"></i></a>
<a href="../explore" class="w3-bar-item w3-button" target="_self" title="explore"><i class="fa fa-compass"></i></a>
<a href="../home" class="w3-bar-item w3-button" target="_self" title="home"><i class="fa fa-home"></i></a>
</div>
</div>
<?php
if (filter_var(htmlspecialchars($_GET['u']),FILTER_SANITIZE_STRING) == $row_username) {
?>
<!--=============================[ Container ]=====================================-->
        <div class="profile_sec1_sec2" align="center">
        <div class="profile_coveri">
                    <?php
                    include "../includes/uploadcoverphoto.php";
                    ?>
        <div id="coverImg" style="height: 100%; width: 100%; background: url(../imgs/user_covers/<?php echo $row_user_cover_photo; ?>) no-repeat center center; background-size: cover;">
            <?php
            if ($row_username == $_SESSION['Username']) {
            ?>
            <div class="profile_coverActions">
                    <form action="" method="post" enctype="multipart/form-data">
                    <table>
                        <tr>
                            <td>
                            <label class="coveruploadBtn p_c_upload">
                            <span class="fa fa-camera"></span> <?php echo lang('uploadPhoto'); ?>
                            <input type="file" style="display: none;" name="coveruploadfield" accept="image/png, image/jpeg, image/jpeg" onchange="profileCoverPhoto(this)" />
                            </label>
                            </td>
                            <td>
                            <button style="margin: 0px 5px;display: none;" type="submit" name="coveruploadsubmit" id="coverBtnUp" class="green_flat_btn p_c_save"><span class="fa fa-check"></span> <?php echo lang('save'); ?></button>
                            </td>
                            <td>
                            <button style="display: none;" class="red_flat_btn p_c_cancel" id="coverBtnCancel"><span class="fa fa-times"></span> <?php echo lang('cancel'); ?></button>
                            </td>
                        </tr>
                    </table>
                    </form>
            </div>
            <?php
            }
            ?>
        </div>
        </div>
        <div style="min-width: 96.5%" class="profile_menui">
            <div class="profile_menu_details">
                <?php
                $posts_num_sql = "SELECT post_id FROM wpost WHERE author_id=:row_id";
                $posts_num = $conn->prepare($posts_num_sql);
                $posts_num->bindParam(':row_id',$row_id,PDO::PARAM_INT);
                $posts_num->execute();
                $posts_num_int = $posts_num->rowCount();
                //=====================================================================
                $stars_num_sql = "SELECT id FROM r_star WHERE p_id=:row_id";
                $stars_num = $conn->prepare($stars_num_sql);
                $stars_num->bindParam(':row_id',$row_id,PDO::PARAM_INT);
                $stars_num->execute();
                $stars_num_int = $stars_num->rowCount();
                //=====================================================================
                $followers_sql = "SELECT id FROM follow WHERE uf_two=:row_id";
                $followers = $conn->prepare($followers_sql);
                $followers->bindParam(':row_id',$row_id,PDO::PARAM_INT);
                $followers->execute();
                $followers_num = $followers->rowCount();
                //=====================================================================
                $following_sql = "SELECT id FROM follow WHERE uf_one=:row_id";
                $following = $conn->prepare($following_sql);
                $following->bindParam(':row_id',$row_id,PDO::PARAM_INT);
                $following->execute();
                $following_num = $following->rowCount();
				//======================================================================
				$story_sql = "SELECT id FROM story WHERE author_id=:row_id";
                $story = $conn->prepare($story_sql);
                $story->bindParam(':row_id',$row_id,PDO::PARAM_INT);
                $story->execute();
                $story_num = $story->rowCount();
                ?>
                <a href='<?php echo $row_username;?>&ut=posts' id='posts_btn' class='profileMenuItem'>
                <b><?php echo thousandsCurrencyFormat($posts_num_int); ?></b> <?php echo lang('posts_str'); ?></a>
				<a href='<?php echo $row_username;?>&ut=story' id='story_btn' class='profileMenuItem'>
                <b><?php echo thousandsCurrencyFormat($story_num); ?></b> <?php echo lang('storyo'); ?></a>
                <a href='<?php echo $row_username;?>&ut=stars' id='posts_btn' class='profileMenuItem'>
                <b><?php echo thousandsCurrencyFormat($stars_num_int); ?></b> <?php echo lang('stars_str'); ?></a>
                <span id='followersCount' style="display:inline-flex;">
                <a href='<?php echo $row_username;?>&ut=followers' id='followers_btn' class='profileMenuItem'>
                <b><?php echo thousandsCurrencyFormat($followers_num); ?></b> <?php echo lang('followers_str'); ?></a></span>
                <a href='<?php echo $row_username;?>&ut=following' id='following_btn' class='profileMenuItem'>
                <b><?php echo thousandsCurrencyFormat($following_num); ?></b> <?php echo lang('following_str'); ?></a>
            </div>
        </div>
            <div align="center" style="display: inline-flex;margin: 0px 10px;min-width: 97.5%;">
        <div  class="profile_cneterCol">
        <div class="user_info" style="overflow: visible;position: relative;">
            <?
            if ($row_username == $_SESSION['Username']) {
                $userActive = "#4CAF50";
            }else{
                if ($row_online == "1") {
                    $userActive = "#4CAF50";
                }else{
                    $userActive = "#ccc";
                }
            }
            ?>
            <div class="userActive mn" style="background:<? echo $userActive.';'.lang('float2'); ?>:100px;"></div>
			<div class="userActive vyt" style="background:<? echo $userActive.';'.lang('float2'); ?>:120px;"></div>
        <?php
         if ($row_profile_pic_border == "1") {
             $profile_pic_border_var = "border-radius: 5%";
         }else{
             $profile_pic_border_var = "";
         }
        ?>
        <div class="profile_picture_img profile_ppicture" style="<?php echo $profile_pic_border_var;?>">
            <img src="<?php echo "../imgs/user_imgs/$row_user_photo";?>" alt="<?php echo $row_fullname;?>" id="profilePhotoPreview" />
            <?php
            include "../includes/uploadprofilephoto.php";
            if($_SESSION['Username'] == $row_username){
                echo "
                <div class=\"change_user_photo\">

                <form action=\"\" method=\"post\" enctype=\"multipart/form-data\">
                <label style='margin:0;'>
                    <p style='margin:0;color: #fff;text-align: center;'><span class=\"fa fa-camera\"></span> ".lang('uploadPhoto')."</p>
                    <input style=\"display: none;\" type=\"file\" accept=\"image/png, image/jpeg, image/jpeg\" name=\"photo_field\" onchange='profilePhoto(this);' />
                </label>
                <button type=\"submit\" name=\"submit_photo\" id='submitProfilePhoto' style='display:none;' >
                <span class='fa fa-check' style='
                background:rgba(62, 187, 74, 0.88);width: 100%;border-radius: 3px;padding: 2px;color: #fff;'> <span style='font-family: sans-serif;'>".lang('save')."
                <span></span></span></span></button>
                </form>
                </div>
                ";
            }
            ?>
            </div>
            <?php
            $url = '/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\:[0-9]+)?(\/\S*)?/';
            $website_row = preg_replace($url, '<a href="$0" target="_blank" title="$0">$0</a>', $row_website);
            ?>
        <div class="profile_picture">
            <h3 style="margin-top:30px; "><?php echo "<a href='".$row_username."'>$row_fullname</a>"; if ($row_verify == "1"){echo $verifyUser;} ?></h3>
            <p align="center">@<?php echo $row_username;?></p>
            <div style="display: flex;">
            <?php
               if($row_id != $_SESSION['id']){
                $csql = "SELECT id FROM follow WHERE uf_one=:s_id AND uf_two=:row_id";
                $c = $conn->prepare($csql);
                $c->bindParam(':s_id',$s_id,PDO::PARAM_INT);
                $c->bindParam(':row_id',$row_id,PDO::PARAM_INT);
                $c->execute();
                $c_num = $c->rowCount();
                if ($c_num > 0){
                    echo "<span id='followUnfollow_$row_id' style='cursor:pointer;width:100%;display:inline-flex;'><button class=\"unfollow_btn\" onclick=\"followUnfollow('$row_id')\"><span class=\"fa fa-check\"></span> ".lang('followingBtn_str')."</button></span>";
                }else{
                    echo "<span id='followUnfollow_$row_id' style='cursor:pointer;width:100%;display:inline-flex;'><button class=\"follow_btn\" onclick=\"followUnfollow('$row_id')\"><span class=\"fa fa-plus-circle\"></span> ".lang('followBtn_str')."</button></span>";
                }
                $sql = "SELECT id FROM r_star WHERE u_id = :uid AND p_id =:pid";
                $starCheck = $conn->prepare($sql);
                $starCheck->bindParam(':uid',$myId,PDO::PARAM_INT);
                $starCheck->bindParam(':pid',$row_id,PDO::PARAM_INT);
                $starCheck->execute();
                $starCheckExist = $starCheck->rowCount();
                if ($starCheckExist > 0) {
                echo "<span id='rate_star'><button class='follow_btn' onclick='starPage(\"$myId\",\"$row_id\")' style='width:100%;margin:0px 3px;border-color:#ffc107;padding:10px 15px;' title='".lang('unFavoritePage')."'><span class='fa fa-star' style='color:#FFC107;font-size:18px;'></span></button></span>";
                
                }else{
                echo "<span id='rate_star'><button class='follow_btn' onclick='starPage(\"$myId\",\"$row_id\")' style='width:100%;margin:0px 3px;padding:10px 15px;' title='".lang('addToFavoritePages')."'><span class='fa fa-star-o' style='color:#bbbbbb;font-size:18px;'></span></button></span>";
                }
                }
                ?>
                </div>
                <?php
                if($row_id == $_SESSION['id']){
                    echo "<span style='cursor:pointer;width:100%;display:inline-flex;'><a href='../settings?tc=edit_profile' class=\"silver_flat_btn\" style='width:100%;'><span class=\"fa fa-cog\"></span> ".lang('edit_profile')."</a></span>";
                }
                ?>
				
				<div class="vyt" style="text-align:left;margin-top:10px;">
				                <?php
                $posts_num_sql = "SELECT post_id FROM wpost WHERE author_id=:row_id";
                $posts_num = $conn->prepare($posts_num_sql);
                $posts_num->bindParam(':row_id',$row_id,PDO::PARAM_INT);
                $posts_num->execute();
                $posts_num_int = $posts_num->rowCount();
                //=====================================================================
                $stars_num_sql = "SELECT id FROM r_star WHERE p_id=:row_id";
                $stars_num = $conn->prepare($stars_num_sql);
                $stars_num->bindParam(':row_id',$row_id,PDO::PARAM_INT);
                $stars_num->execute();
                $stars_num_int = $stars_num->rowCount();
                //=====================================================================
                $followers_sql = "SELECT id FROM follow WHERE uf_two=:row_id";
                $followers = $conn->prepare($followers_sql);
                $followers->bindParam(':row_id',$row_id,PDO::PARAM_INT);
                $followers->execute();
                $followers_num = $followers->rowCount();
                //=====================================================================
                $following_sql = "SELECT id FROM follow WHERE uf_one=:row_id";
                $following = $conn->prepare($following_sql);
                $following->bindParam(':row_id',$row_id,PDO::PARAM_INT);
                $following->execute();
                $following_num = $following->rowCount();
				//======================================================================
				$story_sql = "SELECT id FROM story WHERE author_id=:row_id";
                $story = $conn->prepare($story_sql);
                $story->bindParam(':row_id',$row_id,PDO::PARAM_INT);
                $story->execute();
                $story_num = $story->rowCount();
                ?>
                <a href='<?php echo $row_username;?>&uto=postsmo' id='posts_btn' class='profileMenuItem'>
                <b><?php echo thousandsCurrencyFormat($posts_num_int); ?></b> <?php echo lang('posts_str'); ?></a>	
				<a href='<?php echo $row_username;?>&uto=storymo' id='story_btn' class='profileMenuItem'>
                <b><?php echo thousandsCurrencyFormat($story_num); ?></b> <?php echo lang('storyo'); ?></a>
                <a href='<?php echo $row_username;?>&uto=starsmo' id='posts_btn' class='profileMenuItem'>
                <b><?php echo thousandsCurrencyFormat($stars_num_int); ?></b> <?php echo lang('stars_str'); ?></a>
                <span id='followersCount' style="display:inline-flex;">
                <a href='<?php echo $row_username;?>&uto=followersmo' id='followers_btn' class='profileMenuItem'>
                <b><?php echo thousandsCurrencyFormat($followers_num); ?></b> <?php echo lang('followers_str'); ?></a></span>
                <a href='<?php echo $row_username;?>&uto=followingmo' id='following_btn' class='profileMenuItem'>
                <b><?php echo thousandsCurrencyFormat($following_num); ?></b> <?php echo lang('following_str'); ?></a>
				</div>
        </div>
      </div>
            <div class="user_info">
            <p style="font-size: 18px;"><?php echo lang('about');?>
            <?php
            $firstname = $row_fullname;
            echo strtok($firstname, " ");
            ?>
            </p><hr style="margin: 0;margin-bottom: 10px;">
            <table>
            <?php
            if(empty($row_school) && empty($row_work0) && empty($row_work) && empty($row_country) && empty($row_birthday) && empty($row_website) && empty($work_detail) && empty($work_free) && empty($work_price) && empty($mob_no1) && empty($mob_no2) && empty($em_pub)){echo "<p>".lang('nothingToShow')."</p>";}
            if (!empty($row_school)){echo "<tr><td class='user_info_tdi'><i class=\"fa fa-graduation-cap\"></i></td><td>".lang('studies')." $row_school<td></tr>";}
            if (!empty($row_work0) || !empty($row_work)){echo "<tr><td class='user_info_tdi'><i class=\"fa fa-briefcase\"></i></td><td>".lang('working')." $row_work0 ".lang('at')." $row_work<td></tr>";}
            if (!empty($work_detail)){echo "<tr><td class='user_info_tdi'><i class=\"fa fa-briefcase\"></i></td><td> $work_detail<td></tr>";}
            if (!empty($work_free)){echo "<tr><td class='user_info_tdi'><i class=\"fa fa-money\"></i></td><td> <i style='color:green'>$work_free</i><td></tr>";}
            if (!empty($mob_no1)){echo "<tr><td class='user_info_tdi'><i class=\"fa fa-mobile\"></i></td><td> <a href='tel:$mob_no1'>$mob_no1</a><td></tr>";}
            if (!empty($mob_no2)){echo "<tr><td class='user_info_tdi'><i class=\"fa fa-mobile\"></i></td><td> <a href='tel:$mob_no2'>$mob_no2</a><td></tr>";}
            if (!empty($em_pub)){echo "<tr><td class='user_info_tdi'><i class=\"fa fa-envelope\"></i></td><td> <a href='mailto:$em_pub'>$em_pub</a><td></tr>";}
            if (!empty($row_country)){echo "<tr><td class='user_info_tdi'><i class=\"fa fa-map-marker\"></i></td><td>".lang('lives_in')." $row_country<td></tr>";}
            if (!empty($row_birthday)){echo "<tr><td class='user_info_tdi'><i class=\"fa fa-calendar\"></i></td><td>".lang('born_on')." $row_birthday<td></tr>";}
            if (!empty($website_row)){echo "<tr><td class='user_info_tdi'><i class=\"fa fa-globe\"></i></td><td>$website_row<td></tr>";}
            ?>
            </table>
        </div>
        <div class="user_info">
            <p style="font-size: 18px;"><?php echo lang('bio');?></p><hr style="margin: 0;margin-bottom: 10px;">
            <?php
            if (!empty($row_bio)){echo "
                <p>$row_bio</p>
            ";}else{
            echo "
            <p>".lang('nothingToShow')."</p>
            ";
            }
            ?>
            </div>
			            <div class="profile_cneterCol_2 nu">
<?php
switch (filter_var($_GET['uto'],FILTER_SANITIZE_STRING)) {
        case 'photos':
            ?>
<!--=============================================myphotos_section==================================================-->

<!--=============================================End myphotos_section==================================================-->
            <?php
            break;

        case 'followersmo':
?>
<!--=============================================followers_section==================================================-->
<div style="min-width: 87.5%;" class="post" id="followers_section">
<?php
if ($_SESSION['id'] == $row_id) {
    $followers_paragraph = lang('uProf_urfollowersTitle');
}else{
    if (lang('uProf_followersTitleCheck') == 'ar') {
    $followers_paragraph = lang('uProf_followersTitle')." $row_fullname";
    }else{
    $followers_paragraph = "$row_fullname ".lang('uProf_followersTitle')."";
    }

}
?>
<p class="small_caps_paragraph" style="text-align:<?php echo lang('uProf_ffTitle_align'); ?>;"><?php echo $followers_paragraph; ?></p>
<?php
$s_id = $_SESSION['id'];
$getfollowers_sql = "SELECT * FROM follow WHERE uf_two=:row_id";
$getfollowers = $conn->prepare($getfollowers_sql);
$getfollowers->bindParam(':row_id',$row_id,PDO::PARAM_INT);
$getfollowers->execute();
$num_followers = $getfollowers->rowCount();
if ($num_followers == 0) {
echo "<p style='color:gray;padding:5px;margin:0;font-size:18px;text-align:center;'>".lang('nothingToShow')."</p>";
}else{
while ($getfollow = $getfollowers->fetch(PDO::FETCH_ASSOC)) {
$getfollow_id = $getfollow['uf_one'];
$ufollowers_sql = "SELECT * FROM signup WHERE id=:getfollow_id";
$ufollowers = $conn->prepare($ufollowers_sql);
$ufollowers->bindParam(':getfollow_id',$getfollow_id,PDO::PARAM_INT);
$ufollowers->execute();
if ($getfollow_id == $_SESSION['id']) {
    if ($_SESSION['verify'] == "1") {
     $verifypage_var = $verifyUser;
    }else{
     $verifypage_var = "";
    }
echo "
<table class='user_follow_box'>
<tr>
<td class='user_info_tdi'><div><img src=\"../imgs/user_imgs/".$_SESSION['Userphoto']."\" alt=\"".$_SESSION['Fullname']."\" /></div></td>
<td style='width: 70%;'><a href=\"".$_SESSION['Username']."\" class='user_follow_box_a'><p>".$_SESSION['Fullname']." ".$verifypage_var."<br><span style='color:gray;'>@".$_SESSION['Username']."</span></a></td>
</tr>
</table>
";
}
while ($fetch_followers = $ufollowers->fetch(PDO::FETCH_ASSOC)) {
$id_followers = $fetch_followers['id'];
$fullname_followers = $fetch_followers['Fullname'];
$username_followers = $fetch_followers['Username'];
$userphoto_followers = $fetch_followers['Userphoto'];
$verify_followers = $fetch_followers['verify'];
$followBtn_sql = "SELECT id FROM follow WHERE uf_one=:s_id AND uf_two=:id_followers";
$followBtn = $conn->prepare($followBtn_sql);
$followBtn->bindParam(':s_id',$s_id,PDO::PARAM_INT);
$followBtn->bindParam(':id_followers',$id_followers,PDO::PARAM_INT);
$followBtn->execute();
$followBtn_num = $followBtn->rowCount();
if ($followBtn_num > 0){
    $follow_btn = "<span id='followUnfollow_$id_followers' style='cursor:pointer'><button class=\"unfollow_btn\" onclick=\"followUnfollow('$id_followers')\"><span class=\"fa fa-check\"></span> ".lang('followingBtn_str')."</button></span>";
}else{
    $follow_btn = "<span id='followUnfollow_$id_followers' style='cursor:pointer'><button class=\"follow_btn\" onclick=\"followUnfollow('$id_followers')\"><span class=\"fa fa-plus-circle\"></span> ".lang('followBtn_str')."</button></span>";
}
if ($verify_followers == "1"){
$verifypage_var = $verifyUser;
}else{
$verifypage_var = "";
}
if($id_followers != $_SESSION['id']){
       echo "
<table class='user_follow_box'>
<tr>
<td class='user_info_tdi'><div><img src=\"../imgs/user_imgs/$userphoto_followers\" alt=\"$fullname_followers\" /></div></td>
<td style='width: 70%;'><a href=\"$username_followers\" class='user_follow_box_a'><p>$fullname_followers $verifypage_var<br><span style='color:gray;'>@$username_followers</span></a></td>
<td style='width: 100%;'><span style='float:".lang('float2').";'>$follow_btn</span></td>
</tr>
</table>
";
}
}
}
}
?>
</div>
<!--=============================================End followers_section==================================================-->
<?php
break;
case 'followingmo':
?>
<!--============================================followeing_section==================================================-->
<div class="post" style="min-width: 87.5%;" id="followeing_section">
<?php
if ($_SESSION['id'] == $row_id) {
    $following_paragraph = lang('uProf_urfollowingTitle');
}else{
    if ($row_gender == "Male") {
        $genser_f = lang('uProf_followingTitleHe');
    }elseif($row_gender == "Female"){
        $genser_f = lang('uProf_followingTitleShe');
    }
    $following_paragraph = lang('uProf_followingTitle1')." $genser_f".lang('uProf_followingTitle2');
}
?>
<p class="small_caps_paragraph" style="text-align:<?php echo lang('uProf_ffTitle_align'); ?>;"><?php echo $following_paragraph; ?></p>
<?php
$s_id = $_SESSION['id'];
$getfolloweing_sql = "SELECT * FROM follow WHERE uf_one=:row_id";
$getfolloweing = $conn->prepare($getfolloweing_sql);
$getfolloweing->bindParam(':row_id',$row_id,PDO::PARAM_INT);
$getfolloweing->execute();
$num_followers = $getfolloweing->rowCount();
if ($num_followers == 0) {
echo "<p style='color:gray;padding:15px;margin:0;font-size:18px;text-align:center;'>".lang('nothingToShow')."</p>";
}else{
while ($getfolloweing_fetch = $getfolloweing->fetch(PDO::FETCH_ASSOC)) {
$getfolloweing_id = $getfolloweing_fetch['uf_two'];
$ufolloweing_sql = "SELECT * FROM signup WHERE id=:getfolloweing_id";
$ufolloweing = $conn->prepare($ufolloweing_sql);
$ufolloweing->bindParam(':getfolloweing_id',$getfolloweing_id,PDO::PARAM_INT);
$ufolloweing->execute();
if ($getfolloweing_id == $_SESSION['id']) {
    if ($_SESSION['verify'] == "1") {
     $verifypage_var = $verifyUser;
    }else{
     $verifypage_var = "";
    }
echo "
<table class='user_follow_box'>
<tr>
<td class='user_info_tdi'><div><img src=\"../imgs/user_imgs/".$_SESSION['Userphoto']."\" alt=\"".$_SESSION['Fullname']."\" /></div></td>
<td style='width: 70%;'><a href=\"".$_SESSION['Username']."\" class='user_follow_box_a'><p>".$_SESSION['Fullname']." ".$verifypage_var."<br><span style='color:gray;'>@".$_SESSION['Username']."</span></a></td>
</tr>
</table>
";
}
while ($fetch_followeing = $ufolloweing->fetch(PDO::FETCH_ASSOC)) {
$id_followeing = $fetch_followeing['id'];
$fullname_followeing = $fetch_followeing['Fullname'];
$username_followeing = $fetch_followeing['Username'];
$userphoto_followeing = $fetch_followeing['Userphoto'];
$verify_followeing = $fetch_followeing['verify'];
$followBtn_sql = "SELECT id FROM follow WHERE uf_one=:s_id AND uf_two=:id_followeing";
$followBtn = $conn->prepare($followBtn_sql);
$followBtn->bindParam(':s_id',$s_id,PDO::PARAM_INT);
$followBtn->bindParam(':id_followeing',$id_followeing,PDO::PARAM_INT);
$followBtn->execute();
$followBtn_num = $followBtn->rowCount();
if ($followBtn_num > 0){
    $follow_btn = "<span id='followUnfollow_$id_followeing' style='cursor:pointer'><button class=\"unfollow_btn\" onclick=\"followUnfollow('$id_followeing')\"><span class=\"fa fa-check\"></span> ".lang('followingBtn_str')."</button></span>";
}else{
    $follow_btn = "<span id='followUnfollow_$id_followeing' style='cursor:pointer'><button class=\"follow_btn\" onclick=\"followUnfollow('$id_followeing')\"><span class=\"fa fa-plus-circle\"></span> ".lang('followBtn_str')."</button></span>";
}
if ($verify_followeing == "1"){
$verifypage_var = $verifyUser;
}else{
$verifypage_var = "";
}
if($id_followeing != $_SESSION['id']){
       echo "
<table class='user_follow_box' id='UserUnfollow_$id_followeing'>
<tr>
<td class='user_info_tdi'><div><img src=\"../imgs/user_imgs/$userphoto_followeing\" alt=\"$fullname_followeing\" /></div></td>
<td style='width: 70%;'><a href=\"$username_followeing\" class='user_follow_box_a'><p>$fullname_followeing $verifypage_var<br><span style='color:gray;'>@$username_followeing</span></a></td>
<td style='width: 100%;'><span style='float:".lang('float2').";'>$follow_btn</span></td>
</tr>
</table>
";
}
}
}
}
?>
</div>
<!--============================================End followeing_section==================================================-->
<?php
break;
//================================================story mobile=======================================================
case 'storymo':
?>
<div class="w3-light-grey vyt" style="border-radius:4px;border:1px solid transparent ; box-shadow: 0px 0px 18px rgba(63, 81, 181, 0.16);margin-top:4px;margin-bottom:-4px;">
<a href="<?php echo $row_username;?>&uto=posto"><button class="w3-light-grey w3-button" style="padding:10px;border:none;color:black;font-size:30px;"><span class="fa fa-table"></span></button></a>
<a href="<?php echo $row_username;?>&uto=postlino"><button class="w3-light-grey w3-button" style="padding:10px;border:none;color:black;font-size:30px;"><span class="fa fa-newspaper-o"></span></button></a>
<a href="<?php echo $row_username;?>&uto=storyo"><button class="w3-light-grey w3-button" style="padding:10px;border:none;color:black;font-size:30px;"><span class="fa fa-star"></span></button></a>
</div>
<div class="post" style="min-width: 87.5%;" id="followeing_section">
<p class="small_caps_paragraph" style="text-align:<?php echo lang('uProf_ffTitle_align'); ?>;"><?php echo lang('Stories'); ?></p>
				<?php
$s_id = $_SESSION['id'];
$check_path = filter_var(htmlspecialchars($_POST['path']),FILTER_SANITIZE_STRING);
$plimit = filter_var(htmlspecialchars($_POST['plimit']),FILTER_SANITIZE_NUMBER_INT);
$p_privacy = "2";
$myid = $_SESSION['id'];
$vpsql = "SELECT * FROM story WHERE author_id=:myid";
$view_posts = $conn->prepare($vpsql);
$view_posts->bindParam(':myid',$myid,PDO::PARAM_INT);
$view_posts->execute();
$view_postsNum = $view_posts->rowCount();

if ($view_postsNum > 0) {
while ($postsfetch = $view_posts->fetch(PDO::FETCH_ASSOC)) {
$story_id = $postsfetch['story_id'];
$author_id = $postsfetch['author_id'];
$get_post_author = $postsfetch['post_author'];
$get_post_author_photo = $postsfetch['post_author_photo'];
$story_time = $postsfetch['story_time'];
$story_time_get = time_ago($story_time);
$story_img = $postsfetch['story_img'];
$story_content = $postsfetch['story_content'];
$location = $postsfetch['location'];
$mention = $postsfetch['mention'];
$time_fu = $postsfetch['time_fu'];
$color = $postsfetch['color'];
$p_write = $postsfetch['p_write'];

$qsql = "SELECT * FROM signup WHERE id=:author_id";
$query = $conn->prepare($qsql);
$query->bindParam(':author_id', $author_id, PDO::PARAM_INT);
$query->execute();

while ($query_fetch = $query->fetch(PDO::FETCH_ASSOC)) {
    $query_fetch_id = $query_fetch['id'];
    $query_fetch_username = $query_fetch['Username'];
    $query_fetch_fullname = $query_fetch['Fullname'];
    $query_fetch_userphoto = $query_fetch['Userphoto'];
    $query_fetch_verify = $query_fetch['verify'];
}
//////////////////////////
if($story_id){
//type cast, current time, difference in timestamps
    $curtim = time();
    $diff = $curtim - $story_time;
    //intervals in seconds
    $intervals      = array (
        'year' => 31556926, 'month' => 2629744, 'week' => 604800, 'day' => 86400, 'hour' => 3600, 'minute'=> 60
    );
    //now we just find the difference
    if ($diff >= 86400 && $diff < 2629744)
    {
	$delete_post_sql = "DELETE FROM story WHERE story_id= :story_id";
	$delete_post = $conn->prepare($delete_post_sql);
	$delete_post->bindParam(':story_id',$story_id,PDO::PARAM_INT);
	$delete_post->execute();
    }else{
//////////////////////////////
	echo"<div class='storydiv' style='";if($story_img){if(preg_match("/.(png|jpeg|jpg)$/i", $story_img/*importent!!!*/)){echo"background: url(../imgs/$story_img) no-repeat center center; background-size: cover;";}}elseif($color){if($color == "cod"){echo"background: linear-gradient(500deg,#8910d6,#b52d94);";}else{echo"background:$color;";}}else{echo"background: linear-gradient(500deg,#8910d6,#b52d94);";}echo"'><img src='../imgs/user_imgs/$query_fetch_userphoto' style='border-radius:50%; width:10%;height:20%;border:solid thin grey;'> <a href='$query_fetch_username'><strong style='color:black;'>$query_fetch_username";if ($query_fetch_verify == "1"){echo $verifyUser;}echo"</strong></a>
	<a href='".$check_path."posts/post?pid=".$get_post_id."' style='float:right' class='username_OF_postTime'><b>$story_time_get</b></a>
	";if($p_write){echo"<br><p align='center' style='font-size:25px;'>$p_write<p>";} echo"
				<p align='center' class='pst'><a href='../posts/storywatch?pid=$story_id' style='color:black;'><span class='fa fa-film'></span></a></p></div>";
}}}}else{
	echo lang('nothingToShow');
}
?>
</div>
<?php
break;
//====================================================end story mobile==============================================
case 'starsmo':
?>
<!--============================================ Stars_section==================================================-->
<div style="min-width: 87.5%;"  class="post">
<?php
$s_id = $_SESSION['id'];
$getS_sql = "SELECT * FROM r_star WHERE p_id =:row_id";
$getS = $conn->prepare($getS_sql);
$getS->bindParam(':row_id',$row_id,PDO::PARAM_INT);
$getS->execute();
$getS_count = $getS->rowCount();
if ($getS_count == 0) {
    echo "<p style='color:gray;padding:15px;margin:0;font-size:18px;text-align:center;'>".lang('nothingToShow')."</p>";
}else{
while ($getS_row = $getS->fetch(PDO::FETCH_ASSOC)) {
    $getuserid = $getS_row['u_id'];
    $getuser_sql = "SELECT * FROM signup WHERE id=:getuserid";
    $getuser = $conn->prepare($getuser_sql);
    $getuser->bindParam(':getuserid',$getuserid,PDO::PARAM_INT);
    $getuser->execute();
    if ($getuserid == $_SESSION['id']) {
    if ($_SESSION['verify'] == "1") {
     $verifypage_var = $verifyUser;
    }else{
     $verifypage_var = "";
    }
    echo "
    <table class='user_follow_box'>
    <tr>
    <td class='user_info_tdi'><div><img src=\"../imgs/user_imgs/".$_SESSION['Userphoto']."\" alt=\"".$_SESSION['Fullname']."\" /></div></td>
    <td style='width: 70%;'><a href=\"".$_SESSION['Username']."\" class='user_follow_box_a'><p>".$_SESSION['Fullname']." ".$verifypage_var."<br><span style='color:gray;'>@".$_SESSION['Username']."</span></a></td>
    </tr>
    </table>
    ";
    }
    while ($getuser_row = $getuser->fetch(PDO::FETCH_ASSOC)) {
        $id_stars = $getuser_row['id'];
        $fullname_stars = $getuser_row['Fullname'];
        $username_stars = $getuser_row['Username'];
        $userphoto_stars = $getuser_row['Userphoto'];
        $verify_stars = $getuser_row['verify'];
        $followBtn_sql = "SELECT id FROM follow WHERE uf_one=:s_id AND uf_two=:id_stars";
        $followBtn = $conn->prepare($followBtn_sql);
        $followBtn->bindParam(':s_id',$s_id,PDO::PARAM_INT);
        $followBtn->bindParam(':id_stars',$id_stars,PDO::PARAM_INT);
        $followBtn->execute();
        $followBtn_num = $followBtn->rowCount();
        if ($followBtn_num > 0){
            $follow_btn = "<span id='followUnfollow_$id_stars' style='cursor:pointer'><button class=\"unfollow_btn\" onclick=\"followUnfollow('$id_stars')\"><span class=\"fa fa-check\"></span> ".lang('followingBtn_str')."</button></span>";
        }else{
            $follow_btn = "<span id='followUnfollow_$id_stars' style='cursor:pointer'><button class=\"follow_btn\" onclick=\"followUnfollow('$id_stars')\"><span class=\"fa fa-plus-circle\"></span> ".lang('followBtn_str')."</button></span>";
        }

        if ($verify_stars == "1"){
        $verifypage_var = $verifyUser;
        }else{
        $verifypage_var = "";
        }

        if($id_stars != $_SESSION['id']){
               echo "
        <table class='user_follow_box' id='UserUnfollow_$id_stars'>
        <tr>
        <td class='user_info_tdi'><div><img src=\"../imgs/user_imgs/$userphoto_stars\" alt=\"$fullname_stars\" /></div></td>
        <td style='width: 70%;'><a href=\"$username_stars\" class='user_follow_box_a'><p>$fullname_stars $verifypage_var<br><span style='color:gray;'>@$username_stars</span></a></td>
        <td style='width: 100%;'><span style='float:".lang('float2').";'>$follow_btn</span></td>
        </tr>
        </table>
        ";
        }
    }
}
}
?>
</div>
<!--============================================End Stars_section==================================================-->
<?php
break;
case 'postlino':?>
<div class="w3-light-grey vyt" style="border-radius:4px;border:1px solid transparent ; box-shadow: 0px 0px 18px rgba(63, 81, 181, 0.16);margin-top:4px;margin-bottom:-4px;">
<a href="<?php echo $row_username;?>&uto=posto"><button class="w3-light-grey w3-button" style="padding:10px;border:none;color:black;font-size:30px;"><span class="fa fa-table"></span></button></a>
<a href="<?php echo $row_username;?>&uto=postlino"><button class="w3-light-grey w3-button" style="padding:10px;border:none;color:black;font-size:30px;"><span class="fa fa-newspaper-o"></span></button></a>
<a href="<?php echo $row_username;?>&uto=storyo"><button class="w3-light-grey w3-button" style="padding:10px;border:none;color:black;font-size:30px;"><span class="fa fa-star"></span></button></a>
</div>
<style>
.posti{
    background: white;
    border-radius: 4px;
    box-shadow: 0px 0px 18px rgba(63, 81, 181, 0.16);
    width: 500px;
    margin: -6px 5px;
    border: 1px solid transparent;
}
	.cod{
	background: linear-gradient(500deg,#8910d6,#b52d94);
}
</style>
<?php
///////////////////////////
$s_id = $_SESSION['id'];
$check_path = filter_var(htmlspecialchars($_POST['path']),FILTER_SANITIZE_STRING);
$plimit = filter_var(htmlspecialchars($_POST['plimit']),FILTER_SANITIZE_NUMBER_INT);
$p_privacy = "2";
$vpsql = "SELECT * FROM wpost WHERE p_privacy = 0 AND author_id=:s_id";
$view_posts = $conn->prepare($vpsql);
$view_posts->bindValue(':s_id', $s_id, PDO::PARAM_INT);
$view_posts->execute();

$view_postsNum = $view_posts->rowCount();
while ($postsfetch = $view_posts->fetch(PDO::FETCH_ASSOC)) {
$get_post_id = $postsfetch['post_id'];
$get_author_id = $postsfetch['author_id'];
$get_post_author = $postsfetch['post_author'];
$get_post_author_photo = $postsfetch['post_author_photo'];
$get_post_img = $postsfetch['post_img'];
$get_post_time = $postsfetch['post_time'];
$get_post_content = $postsfetch['post_content'];
$get_post_head = $postsfetch['hea_wr'];
$img_sty = $postsfetch['img_sty'];
$w_photo_v = $postsfetch['w_photo_v'];
$img_op = $postsfetch['img_opacity'];
$get_post_story = $postsfetch['s_wr'];
$question = $postsfetch['question'];
$op1 = $postsfetch['op1'];
$op2 = $postsfetch['op2'];
$op3 = $postsfetch['op3'];
$ch_co = $postsfetch['ch_co'];
$poll_ques = $postsfetch['poll_ques'];
$ye_poll = $postsfetch['ye_poll'];
$no_poll = $postsfetch['no_poll'];
$ye_poll_nu = $postsfetch['ye_poll_nu'];
$no_poll_nu = $postsfetch['no_poll_nu'];
$get_post_write = $postsfetch['p_write'];
$get_text_image = $postsfetch['imgtext'];
$color = $postsfetch['color'];
$font = $postsfetch['font'];
$link = $postsfetch['link'];
$img_mov = $postsfetch['photomov'];
$movie = $postsfetch['movie'];
$session_userphoto_path = $check_path."imgs/user_imgs/";
$session_userphoto = $session_userphoto_path . $_SESSION['Userphoto'];
$timeago = time_ago($get_post_time);
$get_post_title = $postsfetch['p_title'];
$get_post_privacy = $postsfetch['p_privacy'];
$get_post_shared = $postsfetch['shared'];
switch ($get_post_privacy) {
    case '0':
        $postPrivacy = "<span class='fa fa-globe' data-toggle='tooltip' data-placement='top' title='".lang('wpr_public')."'></span>";
        break;
    case '1':
        $postPrivacy = "<span class='fa fa-users' data-toggle='tooltip' data-placement='top' title='".lang('wpr_followers')."'></span>";
        break;
    case '2':
        $postPrivacy = "<span class='fa fa-lock' data-toggle='tooltip' data-placement='top' title='".lang('wpr_onlyme')."'></span>";
        break;
	case '3':
        $postPrivacy = "<span class='fa fa-map' data-toggle='tooltip' data-placement='top' title='".lang('wpr_ads')."'></span>";
        break;
}
$p_title = $get_post_title;
if (!empty($get_post_shared)) {
    $p_title = lang('shared_a_Post');
}
$qsql = "SELECT * FROM signup WHERE id=:get_author_id";
$query = $conn->prepare($qsql);
$query->bindParam(':get_author_id', $get_author_id, PDO::PARAM_INT);
$query->execute();

while ($query_fetch = $query->fetch(PDO::FETCH_ASSOC)) {
    $query_fetch_id = $query_fetch['id'];
    $query_fetch_username = $query_fetch['Username'];
    $query_fetch_fullname = $query_fetch['Fullname'];
    $query_fetch_userphoto = $query_fetch['Userphoto'];
    $query_fetch_verify = $query_fetch['verify'];
}

$chslq = "SELECT c_id FROM comments WHERE c_post_id=:get_post_id";
$ch = $conn->prepare($chslq);
$ch->bindParam(':get_post_id', $get_post_id, PDO::PARAM_INT);
$ch->execute();
$chtc = $ch->rowCount();
if($chtc == 0){
    $chtcnum = "";
}elseif ($chtc == 1) {
    $chtcnum = "1 ".lang('comment')."";
}else{
    $chtcnum = thousandsCurrencyFormat($chtc)." ".lang('comments')."";
}

$chShare = $conn->prepare("SELECT shared FROM wpost WHERE shared=:get_post_id");
$chShare->bindParam(':get_post_id', $get_post_id, PDO::PARAM_INT);
$chShare->execute();
$chShareCount = $chShare->rowCount();
if($chShareCount == 0){
    $shareCount = "";
}elseif ($chShareCount == 1) {
    $shareCount = "1 ".lang('share')."";
}else{
    $shareCount = thousandsCurrencyFormat($chShareCount)." ".lang('shares')."";
}

$imgs_path = $check_path."imgs/";
$em_img_path = $imgs_path."emoticons/";
if (is_file("config/connect.php")) {
    $includePath = "includes/";
}elseif (is_file("../config/connect.php")) {
    $includePath = "../includes/";
}elseif (is_file("config/connect.php")) {
    $includePath = "../../includes/";
}

include ($includePath."emoticons.php");
$post_body = str_replace($em_char,$em_img,$get_post_content);
$hashtag_path = $check_path."hashtag/";
$hashtags_url = '/(\#)([x00-\xFF]+[a-zA-Z0-9x00-\xFF_\w]+)/';
$url = '/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\:[0-9]+)?(\/\S*)?/';
$body = preg_replace($url, '<a href="$0" target="_blank" title="$0">$0<i class="fa fa-link"></i></a>', $post_body);
if ($isHashTagPage == "yep") {
    $body = preg_replace($hashtags_url, '<b><a href="'.$hashtag_path.'$2" title="#$2" class="hashtagHightlight">#$2</a></b>', $body);
}else{
    $body = preg_replace($hashtags_url, '<b><a href="'.$hashtag_path.'$2" title="#$2">#$2</a></b>', $body);
}
//url////////////////////////////////
    $hashtags_url = '/(\www.)([x00-\xFF]+[a-zA-Z0-9x00-\xFF_\w\.com]+)/';
    $body = preg_replace($hashtags_url, "<a href='../$2' title='www.$2'>www.$2<i class='fa fa-link'></i></a>", $body);
//u////////////////////////////////
    $hashtags_url = '/(\@)([x00-\xFF]+[a-zA-Z0-9x00-\xFF_\w]+)/';
    $body = preg_replace($hashtags_url, "<b><a href='".$check_path."u/$2' title='$2'>@$2</a></b>", $body);
$body = nl2br("$body");
//shared posts///////////////////////////////////////////////////////////////////////////////
    echo "
    <div class='posti' style='min-width: 99%;border-radius:10px;' id='$get_post_id' style='text-align:".lang('post_align').";'>
    <div id='postNotify_$get_post_id'></div>
    <div class='username_OF_post'>
    <table style='width:100%;'>
    <tr>
    <td style='width:50px;'>
    <div class='username_OF_postImg'><img src=\"../imgs/user_imgs/$query_fetch_userphoto\"></div><td>
    <td>
    <a href='".$check_path."u/$query_fetch_username' class='username_OF_postLink'>$query_fetch_fullname</a><br/>
    <a href='".$check_path."posts/post?pid=".$get_post_id."' class='username_OF_postTime'>$timeago</a>
    </td>
    <td>
    <div class='dropdown'>
    <a class='post_options dropdown-toggle' data-toggle='dropdown' style='float:".lang('post_options').";' href='#'><span>&bull;&bull;&bull;</span></a>
        <ul class='dropdown-menu ".lang('postDropdown')."' style='top:10px;color:#999;text-align: ".lang('postDropdownTxtAlign').";'>
    ";
    if ($get_author_id == $_SESSION['id']) {
            echo "
    <li><a href='javascript:void(0)' onclick=\"editPost('$get_post_id')\"><span class='fa fa-pencil'></span> ".lang('EditPost_DDM')."</a></li>
    <li><a href='javascript:void(0)' onclick=\"deletePost('$get_post_id')\"><span class='fa fa-trash-o'></span> ".lang('DeletePost_DDM')."</a></li>
    <li class='divider'></li>";
        }
    echo "
    <li><a href='javascript:void(0)' onclick=\"reportpost('post','$get_post_id')\"><span class='fa fa-bug'></span> ".lang('reportPost_DDM')."</a></li>
    ";

 //print  
   echo" <li><a href='javascript:void(0);' onclick=\"codespeedy('pr_$get_post_id')\" title='print'><span class=\"fa fa-print\"></span> print</a></li>";

//download
if($get_post_img){
	   echo" <li><a href=\"".$imgs_path."$get_post_img\" title='download this image' download><span class='fa fa-download'></span> download</a></li>";
}elseif($shP_img){
		   echo" <li><a href=\"".$imgs_path."$shP_img\" title='download this image' download><span class='fa fa-download'></span> download</a></li>";
}
	echo"
	<li class='divider'></li>
	<li><a href='javascript:void(0)' onclick=\"cop('cop_$get_post_id')\"><span class='fa fa-link'></span> ".lang('link_DDM')."</a></li>
    <li><a href='javascript:void(0)' onclick=\"cope('cope_$get_post_id')\"><span class='fa fa-globe'></span> ".lang('embed_DDM')."</a></li>
	</ul>
    </div>
    </td>
    </tr>
    </table>
	<input style='display:none' type='text' id='cop_$get_post_id' value='fero1.com.ly/posts/post?pid=$get_post_id'>
	<input style='display:none' type='text' id='cope_$get_post_id' value='fero1.com.ly/embed/post?pid=$get_post_id'>
    </div><div id='postTitle_$get_post_id'>";
    if (!empty($p_title)) {
        echo "<p class='postTitle' style='border-".lang('float').": 2px solid rgba(80, 94, 113, 0.19); text-align: ".lang('textAlign').";'>$p_title</p>";
    }
    switch ($get_post_privacy) {
        case '0':
            $pub_privacySelected = "selected=''";
            break;
        case '1':
            $f_privacySelected = "selected=''";
            break;
        case '2':
            $om_privacySelected = "selected=''";
            break;
		 case '3':
            $ad_privacySelected = "selected=''";
            break;
    }
	//edit/////////////////////////////////////////
    echo "</div>
    <div class=\"post_content\" style='text-align:".lang('post_content_align').";'>
    <div id='postEditBox_$get_post_id' class='postEditBox' style='display:none;'>
    <input type='text' dir='auto' class='flat_solid_textfield' id='EditTitleBox_$get_post_id' style='min-height: auto;' placeholder='".lang('w_title_inputText')."' value='$p_title' />
    <textarea dir='auto' class='postContent_EditBox' id='EditBox_$get_post_id'>$get_post_content</textarea>
    <div>
    <a href='javascript:void(0)' onclick=\"editPost_save('$get_post_id','$check_path')\" class='default_flat_btn'>".lang('save')."</a>
    <a href='javascript:void(0)' onclick=\"editPost_cancel('$get_post_id')\" class='silver_flat_btn'>".lang('cancel')."</a>
    <select id='p_privacy_$get_post_id' style='background: white;padding: 8px 10px;'>
        <option $pub_privacySelected>".lang('wpr_public')."</option>
        <option $f_privacySelected>".lang('wpr_followers')."</option>
        <option $om_privacySelected>".lang('wpr_onlyme')."</option>
    </select>
    </div>
    </div>
    <div id='postLoading_$get_post_id'></div>
    "; 
        echo "<p dir=\"auto\" id='postContent_$get_post_id'>";
    include ("../includes/ytframe.php");
    echo "</p>";
    echo""; 
        if (!empty($get_post_story)) {
		echo "<a href='".$check_path."posts/book?pid=".$get_post_id."'><div style='width: 98%;height:550px;max-width: 98%;max-height:80%;background-color:grey;text-align: center;'><br><img align='center' style='width: 70%;height:58%;max-width: 85%;max-height:58%;box-shadow: 0px 0px 18px rgba(63, 81, 181, 0.16);' id='lightboxImg_$get_post_id' src=\"".$imgs_path."$w_photo_v\"  class='$img_sty' alt='$query_fetch_fullname' /></div></a>";
		}elseif (!empty($movie)) {
		echo "<a href='".$check_path."posts/film?pid=".$get_post_id."'><div style='width: 98%;height:550px;max-width: 98%;max-height:80%;background-color:grey;text-align: center;'><br><img align='center' style='width: 70%;height:58%;max-width: 85%;max-height:58%;box-shadow: 0px 0px 18px rgba(63, 81, 181, 0.16);' id='lightboxImg_$get_post_id' src='../imgs/$img_mov' alt='$query_fetch_fullname' /></div></a>";
		}
		elseif (!empty($get_post_write)) {
			if (!empty($get_text_image)) {
			echo nl2br("<div class='$color' style='border-radius:10px;font-family: $font;background: url(\"imgs/$get_text_image\") no-repeat center center; background-size: cover;width: 98%;height:80%;font-size: 27px; text-align:center;max-width: 98%;max-height:80%;'><p dir='auto'><br>$get_post_write</p></div>");
			}else{
			echo nl2br("<div class='$color' style='border-radius:10px;font-family: $font;width: 98%;height:550px;font-size: 27px; text-align:center;max-width: 98%;max-height:80%;'><p dir='auto' style='word-break: break-word;'><br>$get_post_write</p></div>");
			}
		}elseif (!empty($link)) {
			echo "<iframe src='$link' style='border-radius:10px;width: 98%;height:550px;max-width: 98%;max-height:80%;'></iframe>";
		}elseif(!empty($question)){
			echo "<div dir='auto' style='width:30%;height:60%;background:white;box-shadow: 0px 0px 18px rgba(63, 81, 181, 0.16);border: 1px solid transparent;border-radius: 10px;'>
<div class='w3-light-grey' style='height:15%;border-radius:4px;text-align:center;'>
<script>
	function fl_$get_post_id() { 
		document.getElementById('incorr_$get_post_id').style.display = 'inline';
		document.getElementById('corr_$get_post_id').style.display = 'none';
		document.getElementById('nim_op1_$get_post_id').style.display = 'none';
		document.getElementById('nim_op2_$get_post_id').style.display = 'none';
		document.getElementById('nim_op3_$get_post_id').style.display = 'none';
		document.getElementById('opdi1_$get_post_id').style.background = 'green';
		";
		echo"
	}
	function tr_$get_post_id() { 
		document.getElementById('corr_$get_post_id').style.display = 'inline';
		document.getElementById('incorr_$get_post_id').style.display = 'none';
		document.getElementById('nim_op1_$get_post_id').style.display = 'none';
		document.getElementById('nim_op2_$get_post_id').style.display = 'none';
		document.getElementById('nim_op3_$get_post_id').style.display = 'none';
		document.getElementById('opdi1_$get_post_id').style.background = 'green';
		";
		echo"
	}
</script>
<br>
$question
</div>
<br>
<div id='";if($ch_co == "a"){echo"opdi1_$get_post_id";}elseif($ch_co != "a"){echo"opdin1_$get_post_id";}echo"' style='width:100%;height:15%;border-radius:25px;border: thin solid  grey;background:;' onclick='";if($ch_co == "a"){echo"tr_$get_post_id()";}else{echo"fl_$get_post_id()";}echo"'><div style='border-radius:4px;' id='aod'>
<br>&nbsp;&nbsp;&nbsp;<span id='nim_op1_$get_post_id' style='border: solid grey;border-radius:100px;padding:5px 5px;'>A</span>&nbsp;&nbsp;  ";if($ch_co == "a"){echo"<img src=\"".$imgs_path."main_icons/2705.png\" id='corr_$get_post_id' style='display:none;width:20px;height:20px;'>";}echo"
$op1</div>
</div>
<br>
<div id='";if($ch_co == "b"){echo"opdi1_$get_post_id";}elseif($ch_co != "b"){echo"opdin2_$get_post_id";}echo"' style='width:100%;height:15%;border-radius:25px;border: thin solid  grey;background:;' onclick='";if($ch_co == "b"){echo"tr_$get_post_id()";}else{echo"fl_$get_post_id()";}echo"'><div style='border-radius:4px;' id='bod'>
<br>&nbsp;&nbsp;&nbsp;<span id='nim_op2_$get_post_id' style='border: solid grey;border-radius:100px;padding:5px 5px;'>B</span>&nbsp;&nbsp;  ";if($ch_co == "b"){echo"<img src=\"".$imgs_path."main_icons/2705.png\" id='corr_$get_post_id' style='display:none;width:20px;height:20px;'>";}echo"
$op2</div>
</div>
<br>
<div id='";if($ch_co == "c"){echo"opdi1_$get_post_id";}elseif($ch_co != "c"){echo"opdin3_$get_post_id";}echo"' style='width:100%;height:15%;border-radius:25px;border: thin solid  grey;background:;' onclick='";if($ch_co == "c"){echo"tr_$get_post_id()";}else{echo"fl_$get_post_id()";}echo"'><div style='border-radius:4px;' id='zod'>
<br>&nbsp;&nbsp;&nbsp;<span id='nim_op3_$get_post_id' style='border: solid grey;border-radius:100px;padding:5px 5px;'>C</span>&nbsp;&nbsp;  ";if($ch_co == "c"){echo"<img src=\"".$imgs_path."main_icons/2705.png\" id='corr_$get_post_id' style='display:none;width:20px;height:20px;'>";}echo"
$op3<br>
</div></div>
	<div id='incorr_$get_post_id' style='display:none'>not correct</div>
</div>
";
}elseif(!empty($poll_ques)){
			echo"<div class='w3-grey' style='border:thin solid black;height:200px;width:350px;border-radius:10px;box-shadow: 0px 0px 18px rgba(63, 81, 181, 0.16);'>
<br>
<p style='text-align:center;width:100%;font-size:25px;color:purple;'>$poll_ques</p>
<br>
<br>";
//poll_yes
$s_idi = $_SESSION['id'];

$get_post_id_i = $postsfetch['post_id'];
$csql = "SELECT id FROM polls WHERE poller=:s_idi AND post_id=:get_post_id_i";
$c = $conn->prepare($csql);
$c->bindParam(':s_idi',$s_idi,PDO::PARAM_INT);
$c->bindParam(':get_post_id_i',$get_post_id_i,PDO::PARAM_INT);
$c->execute();
$c_num = $c->rowCount();
if ($c_num > 0){
}else{
}
$likes_sql = "SELECT id FROM polls WHERE post_id=:get_post_id_i AND yes=1";
$likes = $conn->prepare($likes_sql);
$likes->bindParam(':get_post_id_i',$get_post_id_i,PDO::PARAM_INT);
$likes->execute();
$likes_numi = $likes->rowCount();

//poll_no
$s_idn = $_SESSION['id'];
$get_post_id_n = $postsfetch['post_id'];
$csql = "SELECT id FROM polls WHERE poller=:s_idn AND post_id=:get_post_id_n";
$c = $conn->prepare($csql);
$c->bindParam(':s_idn',$s_idn,PDO::PARAM_INT);
$c->bindParam(':get_post_id_n',$get_post_id_n,PDO::PARAM_INT);
$c->execute();
$c_num = $c->rowCount();
if ($c_num > 0){
}else{
}
$likes_sql = "SELECT id FROM polls WHERE post_id=:get_post_id_n AND no=1";
$likes = $conn->prepare($likes_sql);
$likes->bindParam(':get_post_id_n',$get_post_id_n,PDO::PARAM_INT);
$likes->execute();
$likes_num = $likes->rowCount();
////////////////////
$likes_sqli = "SELECT id FROM polls WHERE post_id=:get_post_id_n";
$likesi = $conn->prepare($likes_sqli);
$likesi->bindParam(':get_post_id_n',$get_post_id_n,PDO::PARAM_INT);
$likesi->execute();
$likesi = $likesi->rowCount();
//yes
$likes_sqly = "SELECT id FROM polls WHERE post_id=:get_post_id_i";
$likesy = $conn->prepare($likes_sqly);
$likesy->bindParam(':get_post_id_i',$get_post_id_i,PDO::PARAM_INT);
$likesy->execute();
$likesy = $likesy->rowCount();
//yes
if ($likes_numi == 0) {

    $likenumi = "0";
}elseif ($likes_numi == 1){
    $likenumi = 1/$likesy*100;
}else{
    $likenumi = $likes_numi/$likesy*100;
}
//no
if ($likes_num == 0) {
    $likenumn = "0";
}elseif ($likes_num == 1){
    $likenumn = 1/$likesi*100;
}else{
    $likenumn = $likes_num/$likesi*100;
}
echo"
<div class='w3-light-grey' style='border:thin solid black;height:60px;width:350px;border-radius:25px;box-shadow: 0px 0px 18px rgba(63, 81, 181, 0.16);'>
<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<p onclick=\"votey('$get_post_id_i')\" style='display:inline;border:none;text-align:left;'><span id='pollcouy_$get_post_id_n'>$ye_poll</span><span style='";if(!empty($c_num)){echo"display:inline";}else{echo"display:none";} echo"' id='postLikeCounti_$get_post_id_i'>$likenumi%</span></p>
<p onclick=\"voten('$get_post_id_i')\" style='display:inline;border:none;text-align:right;float:right;'><span id='pollcoun_$get_post_id_n'>$no_poll</span><span style='";if(!empty($c_num)){echo"display:inline";}else{echo"display:none";} echo"' id='postLikeCounti_$get_post_id_n'>$likenumn%</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</div>
</div>";
		}
		elseif(!empty($get_post_img)){
		if(preg_match("/.(png|jpeg|jpg)$/i", $get_post_img/*importent!!!*/)){
			if(!empty($img_op)){
        echo "<div id='pr_$get_post_id'><img class='$img_sty' align='center' style='object-fit:cover;object-position:50% 50%;width: 98%;height:550px;border-radius:10px;max-width: 98%;max-height:80%;opacity:$img_op;' onclick='lightbox(\"$get_post_id\")' id='lightboxImg_$get_post_id' src=\"../imgs/$get_post_img\" alt='$query_fetch_fullname' /></div>";
			}else{
				echo"<div id='pr_$get_post_id'><img class='$img_sty' align='center' style='object-fit:cover;object-position:50% 50%;width: 98%;border-radius:10px;height:550px;max-width: 98%;max-height:80%;' onclick='lightbox(\"$get_post_id\")' id='lightboxImg_$get_post_id' src=\"../imgs/$get_post_img\" alt='$query_fetch_fullname' /></div>";
			}
		}elseif(preg_match("/.(mp4|ogg|wmb)$/i", $get_post_img/*importent!!!*/)){
			 echo "<video controls autoplay align='center' class='$img_sty' style='width: 98%;border-radius:10px;height:550px;max-width: 98%;max-height:80%;' id='lightboxImg_$get_post_id' src=\"../imgs/$get_post_img\">Your browser don't support videos!!!</video>";
		}elseif(preg_match("/.(mp3)$/i", $get_post_img/*importent!!!*/)){
				 echo "<audio controls autoplay align='center' style='width: 98%;height:550px;border-radius:10px;max-width: 98%;max-height:80%;' id='lightboxImg_$get_post_id' src=\"../imgs/$get_post_img\">Your browser don't support audios!!!</audio>";
		}elseif(preg_match("/.(pdf)$/i", $get_post_img/*importent!!!*/)){ 
		echo "<embed align='center' id='lightboxImg_$get_post_id' style='width: 98%;border-radius:10px;height:550px;max-width: 98%;max-height:80%;' type='application/pdf' src=\"../imgs/$get_post_img\"></embed>";
		}
		}
// ========= fetch share post ==========
if (!empty(trim($get_post_shared))) {
$fetch_shared = $conn->prepare("SELECT * FROM wpost WHERE post_id=:get_post_shared ");
$fetch_shared->bindParam(':get_post_shared',$get_post_shared,PDO::PARAM_INT);
$fetch_shared->execute();
while ($sharedRow = $fetch_shared->fetch(PDO::FETCH_ASSOC)) {
    $shP_id = $sharedRow['post_id'];
    $shP_aid = $sharedRow['author_id'];
	$get_post_head_sh = $sharedRow['hea_wr'];
$get_post_story_sh = $sharedRow['s_wr'];
    $shP_img = $sharedRow['post_img'];
	$img_mov = $sharedRow['photomov'];
	$w_photo_v = $sharedRow['w_photo_v'];
$movie = $sharedRow['movie'];
	$get_post_write = $sharedRow['p_write'];
	$question = $sharedRow['question'];
$op1 = $sharedRow['op1'];
$op2 = $sharedRow['op2'];
$op3 = $sharedRow['op3'];
$ch_co = $sharedRow['ch_co'];
$poll_ques = $sharedRow['poll_ques'];
$ye_poll = $sharedRow['ye_poll'];
$no_poll = $sharedRow['no_poll'];
$ye_poll_nu = $sharedRow['ye_poll_nu'];
$no_poll_nu = $sharedRow['no_poll_nu'];
	$link = $sharedRow['link'];
		$color = $sharedRow['color'];
		$img_sty = $sharedRow['img_sty'];
$img_op = $sharedRow['img_opacity'];
		$get_text_image = $sharedRow['imgtext'];
$font = $sharedRow['font'];
    $shP_title = $sharedRow['p_title'];
    $shP_content = $sharedRow['post_content'];
    $shP_time = $sharedRow['post_time'];
    $shP_timeago = time_ago($shP_time);

    $who_shareInfo = $conn->prepare("SELECT * FROM signup WHERE id=:shP_aid ");
    $who_shareInfo->bindParam(':shP_aid',$shP_aid,PDO::PARAM_INT);
    $who_shareInfo->execute();
    while ($user_row = $who_shareInfo->fetch(PDO::FETCH_ASSOC)) {
        $shU_un = $user_row['Username'];
        $shU_up = $user_row['Userphoto'];
        $shU_fn = $user_row['Fullname'];
    }

$sh_post_body = str_replace($em_char,$em_img,$shP_content);
$sh_hashtag_path = $check_path."hashtag/";
$sh_hashtags_url = '/(\#)([x00-\xFF]+[a-zA-Z0-9x00-\xFF_\w]+)/';
$sh_url = '/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\:[0-9]+)?(\/\S*)?/';
$sh_body = preg_replace($sh_url, '<a href="$0" target="_blank" title="$0">$0<i class="fa fa-link"></i></a>', $sh_post_body);
if ($isHashTagPage == "yep") {
    $sh_body = preg_replace($sh_hashtags_url, '<b><a href="'.$sh_hashtag_path.'$2" title="#$2" class="hashtagHightlight">#$2</a></b>', $sh_body);
}else{
    $sh_body = preg_replace($sh_hashtags_url, '<b><a href="'.$sh_hashtag_path.'$2" title="#$2">#$2</a></b>', $sh_body);
}
//url////////////////////////////////
    $hashtags_url = '/(\www.)([x00-\xFF]+[a-zA-Z0-9x00-\xFF_\w\.com]+)/';
    $sh_body = preg_replace($hashtags_url, "<a href='../$2' title='www.$2'>www.$2<i class='fa fa-link'></i></a>", $sh_body);
//u////////////////////////////////
    $hashtags_url = '/(\@)([x00-\xFF]+[a-zA-Z0-9x00-\xFF_\w]+)/';
    $sh_body = preg_replace($hashtags_url, "<b><a href='".$check_path."u/$2' title='$2'>@$2</a></b>", $sh_body);
$sh_body = nl2br("$sh_body");
}
//////////////////post///////////
echo "
<div class=\"post\" style='min-width: 98%;border-radius:10px; max-height:650px;' id=\"$shP_id\" style='margin: 0;text-align:".lang('post_align').";'>
<div class=\"username_OF_post\">
<table style=\"width:100%;\">
<tbody><tr>
<td style=\"width:50px;\">
<div class=\"username_OF_postImg\"><img src=\"".$check_path."imgs/user_imgs/$shU_up\"></div></td><td>
</td><td>
<a href=\"".$check_path."u/$shU_un\" class=\"username_OF_postLink\">$shU_fn</a><br>
<a href=\"".$check_path."posts/post?pid=$shP_id\" class=\"username_OF_postTime\">$shP_timeago</a>
</td>
</tr>
</tbody></table>
</div><div id='postTitle_$get_post_id'>";
if (!empty($shP_title)) {
    echo "<p class='postTitle' style='border-".lang('float').": 2px solid rgba(80, 94, 113, 0.19); text-align: ".lang('textAlign').";'>$shP_title</p>";
}
echo "</div><div class=\"post_content\" style=\"text-align:left;\">
<p dir=\"auto\" id=\"postContent_$shP_id\" style='text-align: ".lang('textAlign').";'>$sh_body";
echo "</p>";
if (!empty($get_post_story_sh)) {
			echo "<a href='".$check_path."posts/book?pid=".$get_post_id."'><div style='width: 98%;height:80%;max-width: 98%;max-height:80%;background-color:grey;text-align: center;'><br><img align='center' style='width: 85%;height:460px;max-width: 85%;max-height:460px;box-shadow: 0px 0px 18px rgba(63, 81, 181, 0.16);' id='lightboxImg_$get_post_id'  class='$img_sty' src=\"".$imgs_path."$w_photo_v\" alt='$query_fetch_fullname' /></div></a>";
		}elseif (!empty($movie)) {
		echo "<a href='".$check_path."posts/film?pid=".$get_post_id."'><div style='width: 98%;height:80%;max-width: 98%;max-height:80%;background-color:grey;text-align: center;'><br><img align='center' style='width: 70%;height:90%;max-width: 85%;max-height:90%;box-shadow: 0px 0px 18px rgba(63, 81, 181, 0.16);' id='lightboxImg_$get_post_id' src='imgs/$img_mov' alt='$query_fetch_fullname' /></div></a>";
		}
		elseif (!empty($get_post_write)) {
			if (!empty($get_text_image)) {
			echo nl2br("<div class='$color' style='border-radius:10px;font-family: $font;background: url(\"imgs/$get_text_image\") no-repeat center center; background-size: cover;width: 98%;height:80%;font-size: 27px; text-align:center;max-width: 98%;max-height:80%;'><p dir='auto'><br>$get_post_write</p></div>");
			}else{
			echo nl2br("<div class='$color' style='border-radius:10px;font-family: $font;width: 98%;height:80%;font-size: 27px; text-align:center;max-width: 98%;max-height:80%;'><p dir='auto'><br>$get_post_write</p></div>");
			}
		}elseif (!empty($link)) {
			echo "<iframe src='$link' style='border-radius:10px;width: 98%;height:80%;max-width: 98%;max-height:80%;'></iframe>";
		}elseif(!empty($question)){
			echo "<div dir='auto' style='width:30%;height:60%;background:white;box-shadow: 0px 0px 18px rgba(63, 81, 181, 0.16);border: 1px solid transparent;border-radius: 10px;'>
<div class='w3-light-grey' style='height:15%;border-radius:4px;text-align:center;'>
<script>
	function fl_$get_post_id() { 
		document.getElementById('incorr_$get_post_id').style.display = 'inline';
		document.getElementById('corr_$get_post_id').style.display = 'none';
		document.getElementById('nim_op1_$get_post_id').style.display = 'none';
		document.getElementById('nim_op2_$get_post_id').style.display = 'none';
		document.getElementById('nim_op3_$get_post_id').style.display = 'none';
		document.getElementById('opdi1_$get_post_id').style.background = 'green';
		";
		echo"
	}
	function tr_$get_post_id() { 
		document.getElementById('corr_$get_post_id').style.display = 'inline';
		document.getElementById('incorr_$get_post_id').style.display = 'none';
		document.getElementById('nim_op1_$get_post_id').style.display = 'none';
		document.getElementById('nim_op2_$get_post_id').style.display = 'none';
		document.getElementById('nim_op3_$get_post_id').style.display = 'none';
		document.getElementById('opdi1_$get_post_id').style.background = 'green';
		";
		echo"
	}
</script>
<br>
$question
</div>
<br>
<div id='";if($ch_co == "a"){echo"opdi1_$get_post_id";}elseif($ch_co != "a"){echo"opdin1_$get_post_id";}echo"' style='width:100%;height:15%;border-radius:25px;border: thin solid  grey;background:;' onclick='";if($ch_co == "a"){echo"tr_$get_post_id()";}else{echo"fl_$get_post_id()";}echo"'><div style='border-radius:4px;' id='aod'>
<br>&nbsp;&nbsp;&nbsp;<span id='nim_op1_$get_post_id' style='border: solid grey;border-radius:100px;padding:5px 5px;'>A</span>&nbsp;&nbsp;  ";if($ch_co == "a"){echo"<img src=\"".$imgs_path."main_icons/2705.png\" id='corr_$get_post_id' style='display:none;width:20px;height:20px;'>";}echo"
$op1</div>
</div>
<br>
<div id='";if($ch_co == "b"){echo"opdi1_$get_post_id";}elseif($ch_co != "b"){echo"opdin2_$get_post_id";}echo"' style='width:100%;height:15%;border-radius:25px;border: thin solid  grey;background:;' onclick='";if($ch_co == "b"){echo"tr_$get_post_id()";}else{echo"fl_$get_post_id()";}echo"'><div style='border-radius:4px;' id='bod'>
<br>&nbsp;&nbsp;&nbsp;<span id='nim_op2_$get_post_id' style='border: solid grey;border-radius:100px;padding:5px 5px;'>B</span>&nbsp;&nbsp;  ";if($ch_co == "b"){echo"<img src=\"".$imgs_path."main_icons/2705.png\" id='corr_$get_post_id' style='display:none;width:20px;height:20px;'>";}echo"
$op2</div>
</div>
<br>
<div id='";if($ch_co == "c"){echo"opdi1_$get_post_id";}elseif($ch_co != "c"){echo"opdin3_$get_post_id";}echo"' style='width:100%;height:15%;border-radius:25px;border: thin solid  grey;background:;' onclick='";if($ch_co == "c"){echo"tr_$get_post_id()";}else{echo"fl_$get_post_id()";}echo"'><div style='border-radius:4px;' id='zod'>
<br>&nbsp;&nbsp;&nbsp;<span id='nim_op3_$get_post_id' style='border: solid grey;border-radius:100px;padding:5px 5px;'>C</span>&nbsp;&nbsp;  ";if($ch_co == "c"){echo"<img src=\"".$imgs_path."main_icons/2705.png\" id='corr_$get_post_id' style='display:none;width:20px;height:20px;'>";}echo"
$op3<br>
</div></div>
	<div id='incorr_$get_post_id' style='display:none'>not correct</div>
</div>
";
		}elseif(!empty($poll_ques)){
			echo"<div class='w3-grey' style='border:thin solid black;height:200px;width:350px;border-radius:10px;box-shadow: 0px 0px 18px rgba(63, 81, 181, 0.16);'>
<br>
<p style='text-align:center;width:100%;font-size:25px;color:purple;'>$poll_ques</p>
<br>
<br>";
//poll_yes
$s_idi = $_SESSION['id'];

$get_post_id_i = $postsfetch['post_id'];
$csql = "SELECT id FROM polls WHERE poller=:s_idi AND post_id=:get_post_id_i";
$c = $conn->prepare($csql);
$c->bindParam(':s_idi',$s_idi,PDO::PARAM_INT);
$c->bindParam(':get_post_id_i',$get_post_id_i,PDO::PARAM_INT);
$c->execute();
$c_num = $c->rowCount();
if ($c_num > 0){
}else{
}
$likes_sql = "SELECT id FROM polls WHERE post_id=:get_post_id_i AND yes=1";
$likes = $conn->prepare($likes_sql);
$likes->bindParam(':get_post_id_i',$get_post_id_i,PDO::PARAM_INT);
$likes->execute();
$likes_numi = $likes->rowCount();

//poll_no
$s_idn = $_SESSION['id'];
$get_post_id_n = $postsfetch['post_id'];
$csql = "SELECT id FROM polls WHERE poller=:s_idn AND post_id=:get_post_id_n";
$c = $conn->prepare($csql);
$c->bindParam(':s_idn',$s_idn,PDO::PARAM_INT);
$c->bindParam(':get_post_id_n',$get_post_id_n,PDO::PARAM_INT);
$c->execute();
$c_num = $c->rowCount();
if ($c_num > 0){
}else{
}
$likes_sql = "SELECT id FROM polls WHERE post_id=:get_post_id_n AND no=1";
$likes = $conn->prepare($likes_sql);
$likes->bindParam(':get_post_id_n',$get_post_id_n,PDO::PARAM_INT);
$likes->execute();
$likes_num = $likes->rowCount();
////////////////////
$likes_sqli = "SELECT id FROM polls WHERE post_id=:get_post_id_n";
$likesi = $conn->prepare($likes_sqli);
$likesi->bindParam(':get_post_id_n',$get_post_id_n,PDO::PARAM_INT);
$likesi->execute();
$likesi = $likesi->rowCount();
//yes
$likes_sqly = "SELECT id FROM polls WHERE post_id=:get_post_id_i";
$likesy = $conn->prepare($likes_sqly);
$likesy->bindParam(':get_post_id_i',$get_post_id_i,PDO::PARAM_INT);
$likesy->execute();
$likesy = $likesy->rowCount();
//yes
if ($likes_numi == 0) {

    $likenumi = "0";
}elseif ($likes_numi == 1){
    $likenumi = 1/$likesy*100;
}else{
    $likenumi = $likes_numi/$likesy*100;
}
//no
if ($likes_num == 0) {
    $likenumn = "0";
}elseif ($likes_num == 1){
    $likenumn = 1/$likesi*100;
}else{
    $likenumn = $likes_num/$likesi*100;
}
echo"
<div class='w3-light-grey' style='border:thin solid black;height:60px;width:350px;border-radius:25px;box-shadow: 0px 0px 18px rgba(63, 81, 181, 0.16);'>
<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<p onclick=\"votey('$get_post_id_i')\" style='display:inline;border:none;text-align:left;'><span id='pollcouy_$get_post_id_n'>$ye_poll</span><span style='";if(!empty($c_num)){echo"display:inline";}else{echo"display:none";} echo"' id='postLikeCounti_$get_post_id_i'>$likenumi%</span></p>
<p onclick=\"voten('$get_post_id_i')\" style='display:inline;border:none;text-align:right;float:right;'><span id='pollcoun_$get_post_id_n'>$no_poll</span><span style='";if(!empty($c_num)){echo"display:inline";}else{echo"display:none";} echo"' id='postLikeCounti_$get_post_id_n'>$likenumn%</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</div>
</div>";
		}
		elseif (!empty($shP_img)) {
			if(preg_match("/.(png|jpeg|jpg)$/i", $shP_img/*importent!!!*/)){
			if(!empty($img_op)){
        echo "<div id='pr_$get_post_id'><img class='$img_sty' align='center' style='object-fit:cover;object-position:50% 50%;border-radius:10px;width: 98%;height:400px;max-width: 98%;max-height:400px;opacity:$img_op;' onclick='lightbox(\"$get_post_id\")' id='lightboxImg_$get_post_id' src=\"../imgs/$shP_img\" alt='$query_fetch_fullname' /></div>";
			}else{
				echo"<div id='pr_$get_post_id'><img class='$img_sty' align='center' style='object-fit:cover;object-position:50% 50%;border-radius:10px;width: 98%;height:400px;max-width: 98%;max-height:400px;' onclick='lightbox(\"$get_post_id\")' id='lightboxImg_$get_post_id' src=\"../imgs/$shP_img\" alt='$query_fetch_fullname' /></div>";
			}		}elseif(preg_match("/.(mp4|ogg|wmb)$/i", $shP_img/*importent!!!*/)){
			 echo "<video controls autoplay align='center' style='border-radius:10px;width: 98%;height:400px;max-width: 98%;max-height:400px;' id='lightboxImg_$get_post_id' src=\"../imgs/$shP_img\">Your browser don't support videos!!!</video>";
		}elseif(preg_match("/.(mp3)$/i", $shP_img/*importent!!!*/)){
				 echo "<audio controls autoplay align='center' style='border-radius:10px;width: 98%;height:400px;max-width: 98%;max-height:400px;' id='lightboxImg_$get_post_id' src=\"../imgs/$shP_img\">Your browser don't support audios!!!</audio>";
		}elseif(preg_match("/.(pdf)$/i", $shP_img/*importent!!!*/)){ 
		echo "<embed align='center' id='lightboxImg_$get_post_id' style='border-radius:10px;width: 98%;height:400px;max-width: 98%;max-height:400px;' type='application/pdf' src=\"../imgs/$shP_img\"></embed>";
		}
		}
echo "
</div>
</div>
";
}
// ===================tools==================
echo "
</div>
<div id='postNotify2_$get_post_id'></div>
<div>&nbsp;&nbsp;&nbsp;&nbsp;";
//like
$s_id = $_SESSION['id'];
$csql = "SELECT id FROM likes WHERE liker=:s_id AND post_id=:get_post_id";
$c = $conn->prepare($csql);
$c->bindParam(':s_id',$s_id,PDO::PARAM_INT);
$c->bindParam(':get_post_id',$get_post_id,PDO::PARAM_INT);
$c->execute();
$c_num = $c->rowCount();
if ($c_num > 0){
    echo "<span id='likeUnlike_$get_post_id' style='cursor:pointer'><span onclick=\"likeUnlike('$get_post_id')\" style='color:#ff928a;font-size:30px' data-toggle='tooltip' data-placement='top' title='".lang('u_liked_this')."' id='punlike'><span class=\"fa fa-heart\"></span></span></span>";
}else{
    echo "<span id='likeUnlike_$get_post_id' style='cursor:pointer'><span onclick=\"likeUnlike('$get_post_id')\" style='color:#ff928a;font-size:30px' data-toggle='tooltip' data-placement='top' title='".lang('liked')."' id='plike'><span class=\"fa fa-heart-o\"></span></span></span>";
}
$likes_sql = "SELECT id FROM likes WHERE post_id=:get_post_id";
$likes = $conn->prepare($likes_sql);
$likes->bindParam(':get_post_id',$get_post_id,PDO::PARAM_INT);
$likes->execute();
$likes_num = $likes->rowCount();
if ($likes_num == 0) {
    $likenum = "<span class='fa fa-heart'></span> ".lang('no_likes');
}elseif ($likes_num == 1){
    $likenum = "1 <span class='fa fa-heart' style='color: #ff928a;'></span>";
}else{
    $likenum = thousandsCurrencyFormat($likes_num)." <span class='fa fa-heart' style='color: #ff928a;'></span>";
}

//comment button
   echo" <a href=\"javascript:void(0);\"onclick=\"dis('d_$get_post_id')\" style='font-size:30px' class='post_like_comment_shareA' data-toggle='tooltip' data-placement='top' title='".lang('comment')."'><span onclick=\"fcomment('$get_post_id')\" class=\"fa fa-commenting\"></span></a>";
   if(!$poll_ques || !$question){
   echo" <a href=\"posts/mailsend?pid=$get_post_id\" style='font-size:28px' class='post_like_comment_shareA' data-toggle='tooltip' data-placement='top' title='Send a message'><span class=\"fa fa-envelope\"></span></a>";
   }$lik_cou = $likes_num + $likes_numi;
//share
echo "<a href='javascript:void(0);' style='font-size:30px' onclick=\"sharePost('$get_post_id','$check_path')\"  class='post_like_comment_shareA'data-toggle='tooltip' data-placement='top' title='".lang('share_now')."'><span class=\"fa fa-share\"></span></a>
        ";if(!$poll_ques || !$question){
		$so_id = $_SESSION['id'];
$csql = "SELECT id FROM saved WHERE user_saved_id=:so_id AND post_id=:get_post_id";
$co = $conn->prepare($csql);
$co->bindParam(':so_id',$so_id,PDO::PARAM_INT);
$co->bindParam(':get_post_id',$get_post_id,PDO::PARAM_INT);
$co->execute();
$co_num = $co->rowCount();

while ($query_fetch = $co->fetch(PDO::FETCH_ASSOC)) {
    $saved_id = $query_fetch['id'];
}
if ($co_num > 0){
		echo"<span id='saveud_$get_post_id' style='cursor:pointer'><a href='javascript:void(0)' style='font-size:30px;float:right;margin-right:20px;' class='post_like_comment_shareA' onclick=\"deleteSaved('$saved_id');\"><span class='fa fa-bookmark'></span></a></span>";
}else{
		echo"<span id='saveu_$get_post_id' style='cursor:pointer'><a href='javascript:void(0)' style='font-size:30px;float:right;margin-right:20px;' class='post_like_comment_shareA' onclick=\"savePost('$get_post_id','$check_path')\"><span class='fa fa-bookmark-o'></span></a></span>";
}
	}echo"<p class='comment_details' style='text-align:".lang('textAlign').";'>
    <span id='postLikeCount_$get_post_id'>$likenum</span><span style='margin: 0px 5px;padding: 1px;'></span>
    <span id='postCommCount_$get_post_id'>$chtcnum</span><span style='margin: 0px 5px;padding: 1px;'></span>";
	if($poll_ques){
    echo"<span id='postvotCount_$get_post_id'>$lik_cou votes</span><span style='margin: 0px 5px;padding: 1px;'></span>";
	}
    echo"<span id='postShareCount_$get_post_id'>$shareCount</span>
    <span id='p_privacyView_$get_post_id' style='top: -20px;float:".lang('float2').";font-size: 15px;'>".$postPrivacy."</span>
    </p>
</div>
<div class=\"comment_box\">
<div id='d_$get_post_id' style='display: none;'>
<div class='user_comment' id='postComments_$get_post_id'>";
    include "../includes/fetch_comments.php";
echo"
</div>
</div>
<div id='writeComm_$get_post_id'>
<div style='position:relative;display:flex;background: #fff; box-shadow: 2px 2px rgba(0, 0, 0, 0.04); border-radius: 20px;'>
  <textarea dir=\"auto\" autocomplete='off' class='comment_field' id='inputComm_$get_post_id' type=\"text\" data-cid='$get_post_id' data-path='$check_path' name=\"$get_post_id\" placeholder='".lang('comment_field_ph')."' style='text-align:".lang('comment_field_align').";' ></textarea>
  <span class='emoticonsBtn fa fa-smile-o' onclick=\"cEmojiBtn('$get_post_id')\" id='#embtn_".$get_post_id."'></span>
      <div id='em_$get_post_id' data-emtog='0' style='".lang('float2').":0;' class='emoticonsBox'></div>
	  <span class='emoticonsBtn fa fa-photo' onclick=\"showimg('imgdivcom_$get_post_id')\" id='#embtn_".$get_post_id."'></span>
</div>
<p style='font-size: 10px; padding: 0px 10px; border: none; margin: 0; margin-top: 3px;'>".lang('newLine_Shift_enter')." Shift+Enter</p>
</div>

<div id='CommentLoading_$get_post_id'>
</div>
<div id='imgdivcom_$get_post_id' style='display:none'>";
echo"
</div>
</div></div>
";

}
?>
				<?php
break;

default:
?>
<div class="w3-light-grey vyt" style="border-radius:4px;border:1px solid transparent ; box-shadow: 0px 0px 18px rgba(63, 81, 181, 0.16);margin-top:4px;margin-bottom:-4px;">
<a href="<?php echo $row_username;?>&uto=posto"><button class="w3-light-grey w3-button" style="padding:10px;border:none;color:black;font-size:30px;"><span class="fa fa-table"></span></button></a>
<a href="<?php echo $row_username;?>&uto=postlino"><button class="w3-light-grey w3-button" style="padding:10px;border:none;color:black;font-size:30px;"><span class="fa fa-newspaper-o"></span></button></a>
<a href="<?php echo $row_username;?>&uto=storyo"><button class="w3-light-grey w3-button" style="padding:10px;border:none;color:black;font-size:30px;"><span class="fa fa-star"></span></button></a>
</div>
<!--===============================================posts_section====================================================-->
            <div class="post" id="myphotos_section vyt" style="padding: 5px;text-align:<?php echo lang('textAlign'); ?>;min-width: 87.5%;">
            <?php
            $u_id = $row_id;
            $emptyImg = '';
            $getphotos_sql = "SELECT * FROM wpost WHERE author_id=:u_id AND post_img != :emptyImg ORDER BY post_time DESC";
            $getphotos = $conn->prepare($getphotos_sql);
            $getphotos->bindParam(':u_id',$u_id,PDO::PARAM_INT);
            $getphotos->bindParam(':emptyImg',$emptyImg,PDO::PARAM_STR);
            $getphotos->execute();
            $getphotosCount = $getphotos->rowCount();
            ?>
            <p class="titleUserPhotosProfile"><?php echo lang('totalPhotos'); ?> <span><?php echo $getphotosCount; ?></span></p>
            <?php
            if ($getphotosCount < 1) {
                echo lang('nothingToShow');
            }
            while ($fetchMyPhotos = $getphotos->fetch(PDO::FETCH_ASSOC)) {
                $fetch_post_id = $fetchMyPhotos['post_id'];
                $fetch_author_id = $fetchMyPhotos['author_id'];
                $fetch_post_author = $fetchMyPhotos['post_author'];
                $fetch_post_author_photo = $fetchMyPhotos['post_author_photo'];
                $fetch_post_img = $fetchMyPhotos['post_img'];
                $fetch_post_time = $fetchMyPhotos['post_time'];
                $fetch_post_content = $fetchMyPhotos['post_content'];
                $timeago = time_ago($fetch_post_time);
                $fetch_post_status = $fetchMyPhotos['p_status'];
                
                $quesql = "SELECT * FROM signup WHERE id=:fetch_author_id";
                $query = $conn->prepare($quesql);
                $query->bindParam(':fetch_author_id', $fetch_author_id, PDO::PARAM_INT);
                $query->execute();
                while ($author_fetch = $query->fetch(PDO::FETCH_ASSOC)) {
                    $author_fetch_id = $author_fetch['id'];
                    $author_fetch_username = $author_fetch['Username'];
                    $author_fetch_fullname = $author_fetch['Fullname'];
                    $author_fetch_userphoto = $author_fetch['Userphoto'];
                    $author_fetch_verify = $author_fetch['verify'];
                }
            ?>
            <div class="userPhotosProfile">
				<?php
					if (!empty($fetch_post_img)) {
			if(preg_match("/.(png|jpeg|jpg)$/i", $fetch_post_img/*importent!!!*/)){
        echo "<img src=\"../imgs/$fetch_post_img\" alt='$query_fetch_fullname' />";
		}elseif(preg_match("/.(mp4|ogg|wmb)$/i", $fetch_post_img/*importent!!!*/)){
			 echo "<video style='width: 200px;height:200px;max-width: 200px;max-height:200px;object-fit:cover;' controls src=\"../imgs/$fetch_post_img\">Your browser don't support videos!!!</video>";
		}elseif(preg_match("/.(mp3)$/i", $fetch_post_img/*importent!!!*/)){
				 echo "<audio controls src=\"../imgs/$fetch_post_img\">Your browser don't support audios!!!</audio>";
		}elseif(preg_match("/.(pdf)$/i", $fetch_post_img/*importent!!!*/)){ 
		echo "<embed type='application/pdf' src=\"../imgs/$fetch_post_img\"></embed>";
		}elseif (!empty($get_post_write)) {
			echo "<div class='$color' style='font-family: $font;width: 950px;height:530px;font-size: 20px; text-align:center;max-width: 950px;max-height:530px;'><p><br>$get_post_write</p></div>";
		}
		}
		?>
            </div>
            <?php
            }   
            ?>
            </div>

<!--========================================================================-->
 </div>
<!--============================================End posts_section==================================================-->
<?php
    break;
    }
?>
<!--================================================================================================================-->
 
            <?php
            if ($row_id == $_SESSION['id']) {
            ?>
            <div class="user_info">
            <p><span class="fa fa-lock"></span> <?php echo lang('my_notepad');?><br><label style="font-weight: normal;color: rgba(0, 0, 0, 0.31);font-size: small;"><?php echo lang('onlyUcanCThis');?></label>
            </p>
            <p class="profile_mynotepad_box">
            </p>
                <a href="../mynotepad/new" class="green_flat_btn"><?php echo lang('new_note');?></a>
                <a href="../mynotepad/" class="silver_flat_btn"><?php echo lang('see_all_notes');?></a>
            </div>
            <?php
            }
            ?>
        </div>
		<div class="profile_cneterCol_2 mu">
<?php
switch (filter_var($_GET['ut'],FILTER_SANITIZE_STRING)) {
        case 'photos':
            ?>
<!--=============================================myphotos_section==================================================-->

<!--=============================================End myphotos_section==================================================-->
            <?php
            break;

        case 'followers':
?>
<!--=============================================followers_section==================================================-->
<div style="min-width: 87.5%;" class="post" id="followers_section">
<?php
if ($_SESSION['id'] == $row_id) {
    $followers_paragraph = lang('uProf_urfollowersTitle');
}else{
    if (lang('uProf_followersTitleCheck') == 'ar') {
    $followers_paragraph = lang('uProf_followersTitle')." $row_fullname";
    }else{
    $followers_paragraph = "$row_fullname ".lang('uProf_followersTitle')."";
    }

}
?>
<p class="small_caps_paragraph" style="text-align:<?php echo lang('uProf_ffTitle_align'); ?>;"><?php echo $followers_paragraph; ?></p>
<?php
$s_id = $_SESSION['id'];
$getfollowers_sql = "SELECT * FROM follow WHERE uf_two=:row_id";
$getfollowers = $conn->prepare($getfollowers_sql);
$getfollowers->bindParam(':row_id',$row_id,PDO::PARAM_INT);
$getfollowers->execute();
$num_followers = $getfollowers->rowCount();
if ($num_followers == 0) {
echo "<p style='color:gray;padding:5px;margin:0;font-size:18px;text-align:center;'>".lang('nothingToShow')."</p>";
}else{
while ($getfollow = $getfollowers->fetch(PDO::FETCH_ASSOC)) {
$getfollow_id = $getfollow['uf_one'];
$ufollowers_sql = "SELECT * FROM signup WHERE id=:getfollow_id";
$ufollowers = $conn->prepare($ufollowers_sql);
$ufollowers->bindParam(':getfollow_id',$getfollow_id,PDO::PARAM_INT);
$ufollowers->execute();
if ($getfollow_id == $_SESSION['id']) {
    if ($_SESSION['verify'] == "1") {
     $verifypage_var = $verifyUser;
    }else{
     $verifypage_var = "";
    }
echo "
<table class='user_follow_box'>
<tr>
<td class='user_info_tdi'><div><img src=\"../imgs/user_imgs/".$_SESSION['Userphoto']."\" alt=\"".$_SESSION['Fullname']."\" /></div></td>
<td style='width: 70%;'><a href=\"".$_SESSION['Username']."\" class='user_follow_box_a'><p>".$_SESSION['Fullname']." ".$verifypage_var."<br><span style='color:gray;'>@".$_SESSION['Username']."</span></a></td>
</tr>
</table>
";
}
while ($fetch_followers = $ufollowers->fetch(PDO::FETCH_ASSOC)) {
$id_followers = $fetch_followers['id'];
$fullname_followers = $fetch_followers['Fullname'];
$username_followers = $fetch_followers['Username'];
$userphoto_followers = $fetch_followers['Userphoto'];
$verify_followers = $fetch_followers['verify'];
$followBtn_sql = "SELECT id FROM follow WHERE uf_one=:s_id AND uf_two=:id_followers";
$followBtn = $conn->prepare($followBtn_sql);
$followBtn->bindParam(':s_id',$s_id,PDO::PARAM_INT);
$followBtn->bindParam(':id_followers',$id_followers,PDO::PARAM_INT);
$followBtn->execute();
$followBtn_num = $followBtn->rowCount();
if ($followBtn_num > 0){
    $follow_btn = "<span id='followUnfollow_$id_followers' style='cursor:pointer'><button class=\"unfollow_btn\" onclick=\"followUnfollow('$id_followers')\"><span class=\"fa fa-check\"></span> ".lang('followingBtn_str')."</button></span>";
}else{
    $follow_btn = "<span id='followUnfollow_$id_followers' style='cursor:pointer'><button class=\"follow_btn\" onclick=\"followUnfollow('$id_followers')\"><span class=\"fa fa-plus-circle\"></span> ".lang('followBtn_str')."</button></span>";
}
if ($verify_followers == "1"){
$verifypage_var = $verifyUser;
}else{
$verifypage_var = "";
}
if($id_followers != $_SESSION['id']){
       echo "
<table class='user_follow_box'>
<tr>
<td class='user_info_tdi'><div><img src=\"../imgs/user_imgs/$userphoto_followers\" alt=\"$fullname_followers\" /></div></td>
<td style='width: 70%;'><a href=\"$username_followers\" class='user_follow_box_a'><p>$fullname_followers $verifypage_var<br><span style='color:gray;'>@$username_followers</span></a></td>
<td style='width: 100%;'><span style='float:".lang('float2').";'>$follow_btn</span></td>
</tr>
</table>
";
}
}
}
}
?>
</div>
<!--=============================================End followers_section==================================================-->
<?php
break;
case 'postlin':
?>
<div class="w3-light-grey" style="border-radius:4px;border:1px solid transparent ; box-shadow: 0px 0px 18px rgba(63, 81, 181, 0.16);margin-top:4px;margin-bottom:-4px;">
<a href="<?php echo $row_username;?>&ut=post"><button class="w3-light-grey w3-button" style="padding:10px;border:none;color:black;font-size:30px;"><span class="fa fa-table"></span></button></a>
<a href="<?php echo $row_username;?>&ut=postlin"><button class="w3-light-grey w3-button" style="padding:10px;border:none;color:black;font-size:30px;"><span class="fa fa-newspaper-o"></span></button></a>
<a href="<?php echo $row_username;?>&ut=story"><button class="w3-light-grey w3-button" style="padding:10px;border:none;color:black;font-size:30px;"><span class="fa fa-star"></span></button></a>
</div>
       <?php

		?>
<style>
.posti{
    background: white;
    border-radius: 4px;
    box-shadow: 0px 0px 18px rgba(63, 81, 181, 0.16);
    width: 500px;
    margin: -6px 5px;
    border: 1px solid transparent;
}
	.cod{
	background: linear-gradient(500deg,#8910d6,#b52d94);
}
</style>
<?php
///////////////////////////
$s_id = $_SESSION['id'];
$check_path = filter_var(htmlspecialchars($_POST['path']),FILTER_SANITIZE_STRING);
$plimit = filter_var(htmlspecialchars($_POST['plimit']),FILTER_SANITIZE_NUMBER_INT);
$p_privacy = "2";
$vpsql = "SELECT * FROM wpost WHERE p_privacy = 0 AND author_id=:s_id";
$view_posts = $conn->prepare($vpsql);
$view_posts->bindValue(':s_id', $s_id, PDO::PARAM_INT);
$view_posts->execute();

$view_postsNum = $view_posts->rowCount();
while ($postsfetch = $view_posts->fetch(PDO::FETCH_ASSOC)) {
$get_post_id = $postsfetch['post_id'];
$get_author_id = $postsfetch['author_id'];
$get_post_author = $postsfetch['post_author'];
$get_post_author_photo = $postsfetch['post_author_photo'];
$get_post_img = $postsfetch['post_img'];
$get_post_time = $postsfetch['post_time'];
$get_post_content = $postsfetch['post_content'];
$get_post_head = $postsfetch['hea_wr'];
$img_sty = $postsfetch['img_sty'];
$w_photo_v = $postsfetch['w_photo_v'];
$img_op = $postsfetch['img_opacity'];
$get_post_story = $postsfetch['s_wr'];
$question = $postsfetch['question'];
$op1 = $postsfetch['op1'];
$op2 = $postsfetch['op2'];
$op3 = $postsfetch['op3'];
$ch_co = $postsfetch['ch_co'];
$poll_ques = $postsfetch['poll_ques'];
$ye_poll = $postsfetch['ye_poll'];
$no_poll = $postsfetch['no_poll'];
$ye_poll_nu = $postsfetch['ye_poll_nu'];
$no_poll_nu = $postsfetch['no_poll_nu'];
$get_post_write = $postsfetch['p_write'];
$get_text_image = $postsfetch['imgtext'];
$color = $postsfetch['color'];
$font = $postsfetch['font'];
$link = $postsfetch['link'];
$img_mov = $postsfetch['photomov'];
$movie = $postsfetch['movie'];
$session_userphoto_path = $check_path."imgs/user_imgs/";
$session_userphoto = $session_userphoto_path . $_SESSION['Userphoto'];
$timeago = time_ago($get_post_time);
$get_post_title = $postsfetch['p_title'];
$get_post_privacy = $postsfetch['p_privacy'];
$get_post_shared = $postsfetch['shared'];
switch ($get_post_privacy) {
    case '0':
        $postPrivacy = "<span class='fa fa-globe' data-toggle='tooltip' data-placement='top' title='".lang('wpr_public')."'></span>";
        break;
    case '1':
        $postPrivacy = "<span class='fa fa-users' data-toggle='tooltip' data-placement='top' title='".lang('wpr_followers')."'></span>";
        break;
    case '2':
        $postPrivacy = "<span class='fa fa-lock' data-toggle='tooltip' data-placement='top' title='".lang('wpr_onlyme')."'></span>";
        break;
	case '3':
        $postPrivacy = "<span class='fa fa-map' data-toggle='tooltip' data-placement='top' title='".lang('wpr_ads')."'></span>";
        break;
}
$p_title = $get_post_title;
if (!empty($get_post_shared)) {
    $p_title = lang('shared_a_Post');
}
$qsql = "SELECT * FROM signup WHERE id=:get_author_id";
$query = $conn->prepare($qsql);
$query->bindParam(':get_author_id', $get_author_id, PDO::PARAM_INT);
$query->execute();

while ($query_fetch = $query->fetch(PDO::FETCH_ASSOC)) {
    $query_fetch_id = $query_fetch['id'];
    $query_fetch_username = $query_fetch['Username'];
    $query_fetch_fullname = $query_fetch['Fullname'];
    $query_fetch_userphoto = $query_fetch['Userphoto'];
    $query_fetch_verify = $query_fetch['verify'];
}

$chslq = "SELECT c_id FROM comments WHERE c_post_id=:get_post_id";
$ch = $conn->prepare($chslq);
$ch->bindParam(':get_post_id', $get_post_id, PDO::PARAM_INT);
$ch->execute();
$chtc = $ch->rowCount();
if($chtc == 0){
    $chtcnum = "";
}elseif ($chtc == 1) {
    $chtcnum = "1 ".lang('comment')."";
}else{
    $chtcnum = thousandsCurrencyFormat($chtc)." ".lang('comments')."";
}

$chShare = $conn->prepare("SELECT shared FROM wpost WHERE shared=:get_post_id");
$chShare->bindParam(':get_post_id', $get_post_id, PDO::PARAM_INT);
$chShare->execute();
$chShareCount = $chShare->rowCount();
if($chShareCount == 0){
    $shareCount = "";
}elseif ($chShareCount == 1) {
    $shareCount = "1 ".lang('share')."";
}else{
    $shareCount = thousandsCurrencyFormat($chShareCount)." ".lang('shares')."";
}

$imgs_path = $check_path."imgs/";
$em_img_path = $imgs_path."emoticons/";
if (is_file("config/connect.php")) {
    $includePath = "includes/";
}elseif (is_file("../config/connect.php")) {
    $includePath = "../includes/";
}elseif (is_file("config/connect.php")) {
    $includePath = "../../includes/";
}

include ($includePath."emoticons.php");
$post_body = str_replace($em_char,$em_img,$get_post_content);
$hashtag_path = $check_path."hashtag/";
$hashtags_url = '/(\#)([x00-\xFF]+[a-zA-Z0-9x00-\xFF_\w]+)/';
$url = '/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\:[0-9]+)?(\/\S*)?/';
$body = preg_replace($url, '<a href="$0" target="_blank" title="$0">$0<i class="fa fa-link"></i></a>', $post_body);
if ($isHashTagPage == "yep") {
    $body = preg_replace($hashtags_url, '<b><a href="'.$hashtag_path.'$2" title="#$2" class="hashtagHightlight">#$2</a></b>', $body);
}else{
    $body = preg_replace($hashtags_url, '<b><a href="'.$hashtag_path.'$2" title="#$2">#$2</a></b>', $body);
}
//url////////////////////////////////
    $hashtags_url = '/(\www.)([x00-\xFF]+[a-zA-Z0-9x00-\xFF_\w\.com]+)/';
    $body = preg_replace($hashtags_url, "<a href='../$2' title='www.$2'>www.$2<i class='fa fa-link'></i></a>", $body);
//u////////////////////////////////
    $hashtags_url = '/(\@)([x00-\xFF]+[a-zA-Z0-9x00-\xFF_\w]+)/';
    $body = preg_replace($hashtags_url, "<b><a href='".$check_path."u/$2' title='$2'>@$2</a></b>", $body);
$body = nl2br("$body");
//shared posts///////////////////////////////////////////////////////////////////////////////
    echo "
    <div class='posti' style='min-width: 99%;border-radius:10px;' id='$get_post_id' style='text-align:".lang('post_align').";'>
    <div id='postNotify_$get_post_id'></div>
    <div class='username_OF_post'>
    <table style='width:100%;'>
    <tr>
    <td style='width:50px;'>
    <div class='username_OF_postImg'><img src=\"../imgs/user_imgs/$query_fetch_userphoto\"></div><td>
    <td>
    <a href='".$check_path."u/$query_fetch_username' class='username_OF_postLink'>$query_fetch_fullname</a><br/>
    <a href='".$check_path."posts/post?pid=".$get_post_id."' class='username_OF_postTime'>$timeago</a>
    </td>
    <td>
    <div class='dropdown'>
    <a class='post_options dropdown-toggle' data-toggle='dropdown' style='float:".lang('post_options').";' href='#'><span>&bull;&bull;&bull;</span></a>
        <ul class='dropdown-menu ".lang('postDropdown')."' style='top:10px;color:#999;text-align: ".lang('postDropdownTxtAlign').";'>
    ";
    if ($get_author_id == $_SESSION['id']) {
            echo "
    <li><a href='javascript:void(0)' onclick=\"editPost('$get_post_id')\"><span class='fa fa-pencil'></span> ".lang('EditPost_DDM')."</a></li>
    <li><a href='javascript:void(0)' onclick=\"deletePost('$get_post_id')\"><span class='fa fa-trash-o'></span> ".lang('DeletePost_DDM')."</a></li>
    <li class='divider'></li>";
        }
    echo "
    <li><a href='javascript:void(0)' onclick=\"reportpost('post','$get_post_id')\"><span class='fa fa-bug'></span> ".lang('reportPost_DDM')."</a></li>
    ";

 //print  
   echo" <li><a href='javascript:void(0);' onclick=\"codespeedy('pr_$get_post_id')\" title='print'><span class=\"fa fa-print\"></span> print</a></li>";

//download
if($get_post_img){
	   echo" <li><a href=\"".$imgs_path."$get_post_img\" title='download this image' download><span class='fa fa-download'></span> download</a></li>";
}elseif($shP_img){
		   echo" <li><a href=\"".$imgs_path."$shP_img\" title='download this image' download><span class='fa fa-download'></span> download</a></li>";
}
	echo"
	<li class='divider'></li>
	<li><a href='javascript:void(0)' onclick=\"cop('cop_$get_post_id')\"><span class='fa fa-link'></span> ".lang('link_DDM')."</a></li>
    <li><a href='javascript:void(0)' onclick=\"cope('cope_$get_post_id')\"><span class='fa fa-globe'></span> ".lang('embed_DDM')."</a></li>
	</ul>
    </div>
    </td>
    </tr>
    </table>
	<input style='display:none' type='text' id='cop_$get_post_id' value='fero1.com.ly/posts/post?pid=$get_post_id'>
	<input style='display:none' type='text' id='cope_$get_post_id' value='fero1.com.ly/embed/post?pid=$get_post_id'>
    </div><div id='postTitle_$get_post_id'>";
    if (!empty($p_title)) {
        echo "<p class='postTitle' style='border-".lang('float').": 2px solid rgba(80, 94, 113, 0.19); text-align: ".lang('textAlign').";'>$p_title</p>";
    }
    switch ($get_post_privacy) {
        case '0':
            $pub_privacySelected = "selected=''";
            break;
        case '1':
            $f_privacySelected = "selected=''";
            break;
        case '2':
            $om_privacySelected = "selected=''";
            break;
		 case '3':
            $ad_privacySelected = "selected=''";
            break;
    }
	//edit/////////////////////////////////////////
    echo "</div>
    <div class=\"post_content\" style='text-align:".lang('post_content_align').";'>
    <div id='postEditBox_$get_post_id' class='postEditBox' style='display:none;'>
    <input type='text' dir='auto' class='flat_solid_textfield' id='EditTitleBox_$get_post_id' style='min-height: auto;' placeholder='".lang('w_title_inputText')."' value='$p_title' />
    <textarea dir='auto' class='postContent_EditBox' id='EditBox_$get_post_id'>$get_post_content</textarea>
    <div>
    <a href='javascript:void(0)' onclick=\"editPost_save('$get_post_id','$check_path')\" class='default_flat_btn'>".lang('save')."</a>
    <a href='javascript:void(0)' onclick=\"editPost_cancel('$get_post_id')\" class='silver_flat_btn'>".lang('cancel')."</a>
    <select id='p_privacy_$get_post_id' style='background: white;padding: 8px 10px;'>
        <option $pub_privacySelected>".lang('wpr_public')."</option>
        <option $f_privacySelected>".lang('wpr_followers')."</option>
        <option $om_privacySelected>".lang('wpr_onlyme')."</option>
    </select>
    </div>
    </div>
    <div id='postLoading_$get_post_id'></div>
    "; 
        echo "<p dir=\"auto\" id='postContent_$get_post_id'>";
    include ("../includes/ytframe.php");
    echo "</p>";
    echo""; 
        if (!empty($get_post_story)) {
		echo "<a href='".$check_path."posts/book?pid=".$get_post_id."'><div style='width: 98%;height:550px;max-width: 98%;max-height:80%;background-color:grey;text-align: center;'><br><img align='center' style='width: 70%;height:58%;max-width: 85%;max-height:58%;box-shadow: 0px 0px 18px rgba(63, 81, 181, 0.16);' id='lightboxImg_$get_post_id' src=\"".$imgs_path."$w_photo_v\"  class='$img_sty' alt='$query_fetch_fullname' /></div></a>";
		}elseif (!empty($movie)) {
		echo "<a href='".$check_path."posts/film?pid=".$get_post_id."'><div style='width: 98%;height:550px;max-width: 98%;max-height:80%;background-color:grey;text-align: center;'><br><img align='center' style='width: 70%;height:58%;max-width: 85%;max-height:58%;box-shadow: 0px 0px 18px rgba(63, 81, 181, 0.16);' id='lightboxImg_$get_post_id' src='../imgs/$img_mov' alt='$query_fetch_fullname' /></div></a>";
		}
		elseif (!empty($get_post_write)) {
			if (!empty($get_text_image)) {
			echo nl2br("<div class='$color' style='border-radius:10px;font-family: $font;background: url(\"imgs/$get_text_image\") no-repeat center center; background-size: cover;width: 98%;height:80%;font-size: 27px; text-align:center;max-width: 98%;max-height:80%;'><p dir='auto'><br>$get_post_write</p></div>");
			}else{
			echo nl2br("<div class='$color' style='border-radius:10px;font-family: $font;width: 98%;height:550px;font-size: 27px; text-align:center;max-width: 98%;max-height:80%;'><p dir='auto' style='word-break: break-word;'><br>$get_post_write</p></div>");
			}
		}elseif (!empty($link)) {
			echo "<iframe src='$link' style='border-radius:10px;width: 98%;height:550px;max-width: 98%;max-height:80%;'></iframe>";
		}elseif(!empty($question)){
			echo "<div dir='auto' style='width:30%;height:60%;background:white;box-shadow: 0px 0px 18px rgba(63, 81, 181, 0.16);border: 1px solid transparent;border-radius: 10px;'>
<div class='w3-light-grey' style='height:15%;border-radius:4px;text-align:center;'>
<script>
	function fl_$get_post_id() { 
		document.getElementById('incorr_$get_post_id').style.display = 'inline';
		document.getElementById('corr_$get_post_id').style.display = 'none';
		document.getElementById('nim_op1_$get_post_id').style.display = 'none';
		document.getElementById('nim_op2_$get_post_id').style.display = 'none';
		document.getElementById('nim_op3_$get_post_id').style.display = 'none';
		document.getElementById('opdi1_$get_post_id').style.background = 'green';
		";
		echo"
	}
	function tr_$get_post_id() { 
		document.getElementById('corr_$get_post_id').style.display = 'inline';
		document.getElementById('incorr_$get_post_id').style.display = 'none';
		document.getElementById('nim_op1_$get_post_id').style.display = 'none';
		document.getElementById('nim_op2_$get_post_id').style.display = 'none';
		document.getElementById('nim_op3_$get_post_id').style.display = 'none';
		document.getElementById('opdi1_$get_post_id').style.background = 'green';
		";
		echo"
	}
</script>
<br>
$question
</div>
<br>
<div id='";if($ch_co == "a"){echo"opdi1_$get_post_id";}elseif($ch_co != "a"){echo"opdin1_$get_post_id";}echo"' style='width:100%;height:15%;border-radius:25px;border: thin solid  grey;background:;' onclick='";if($ch_co == "a"){echo"tr_$get_post_id()";}else{echo"fl_$get_post_id()";}echo"'><div style='border-radius:4px;' id='aod'>
<br>&nbsp;&nbsp;&nbsp;<span id='nim_op1_$get_post_id' style='border: solid grey;border-radius:100px;padding:5px 5px;'>A</span>&nbsp;&nbsp;  ";if($ch_co == "a"){echo"<img src=\"".$imgs_path."main_icons/2705.png\" id='corr_$get_post_id' style='display:none;width:20px;height:20px;'>";}echo"
$op1</div>
</div>
<br>
<div id='";if($ch_co == "b"){echo"opdi1_$get_post_id";}elseif($ch_co != "b"){echo"opdin2_$get_post_id";}echo"' style='width:100%;height:15%;border-radius:25px;border: thin solid  grey;background:;' onclick='";if($ch_co == "b"){echo"tr_$get_post_id()";}else{echo"fl_$get_post_id()";}echo"'><div style='border-radius:4px;' id='bod'>
<br>&nbsp;&nbsp;&nbsp;<span id='nim_op2_$get_post_id' style='border: solid grey;border-radius:100px;padding:5px 5px;'>B</span>&nbsp;&nbsp;  ";if($ch_co == "b"){echo"<img src=\"".$imgs_path."main_icons/2705.png\" id='corr_$get_post_id' style='display:none;width:20px;height:20px;'>";}echo"
$op2</div>
</div>
<br>
<div id='";if($ch_co == "c"){echo"opdi1_$get_post_id";}elseif($ch_co != "c"){echo"opdin3_$get_post_id";}echo"' style='width:100%;height:15%;border-radius:25px;border: thin solid  grey;background:;' onclick='";if($ch_co == "c"){echo"tr_$get_post_id()";}else{echo"fl_$get_post_id()";}echo"'><div style='border-radius:4px;' id='zod'>
<br>&nbsp;&nbsp;&nbsp;<span id='nim_op3_$get_post_id' style='border: solid grey;border-radius:100px;padding:5px 5px;'>C</span>&nbsp;&nbsp;  ";if($ch_co == "c"){echo"<img src=\"".$imgs_path."main_icons/2705.png\" id='corr_$get_post_id' style='display:none;width:20px;height:20px;'>";}echo"
$op3<br>
</div></div>
	<div id='incorr_$get_post_id' style='display:none'>not correct</div>
</div>
";
}elseif(!empty($poll_ques)){
			echo"<div class='w3-grey' style='border:thin solid black;height:200px;width:350px;border-radius:10px;box-shadow: 0px 0px 18px rgba(63, 81, 181, 0.16);'>
<br>
<p style='text-align:center;width:100%;font-size:25px;color:purple;'>$poll_ques</p>
<br>
<br>";
//poll_yes
$s_idi = $_SESSION['id'];

$get_post_id_i = $postsfetch['post_id'];
$csql = "SELECT id FROM polls WHERE poller=:s_idi AND post_id=:get_post_id_i";
$c = $conn->prepare($csql);
$c->bindParam(':s_idi',$s_idi,PDO::PARAM_INT);
$c->bindParam(':get_post_id_i',$get_post_id_i,PDO::PARAM_INT);
$c->execute();
$c_num = $c->rowCount();
if ($c_num > 0){
}else{
}
$likes_sql = "SELECT id FROM polls WHERE post_id=:get_post_id_i AND yes=1";
$likes = $conn->prepare($likes_sql);
$likes->bindParam(':get_post_id_i',$get_post_id_i,PDO::PARAM_INT);
$likes->execute();
$likes_numi = $likes->rowCount();

//poll_no
$s_idn = $_SESSION['id'];
$get_post_id_n = $postsfetch['post_id'];
$csql = "SELECT id FROM polls WHERE poller=:s_idn AND post_id=:get_post_id_n";
$c = $conn->prepare($csql);
$c->bindParam(':s_idn',$s_idn,PDO::PARAM_INT);
$c->bindParam(':get_post_id_n',$get_post_id_n,PDO::PARAM_INT);
$c->execute();
$c_num = $c->rowCount();
if ($c_num > 0){
}else{
}
$likes_sql = "SELECT id FROM polls WHERE post_id=:get_post_id_n AND no=1";
$likes = $conn->prepare($likes_sql);
$likes->bindParam(':get_post_id_n',$get_post_id_n,PDO::PARAM_INT);
$likes->execute();
$likes_num = $likes->rowCount();
////////////////////
$likes_sqli = "SELECT id FROM polls WHERE post_id=:get_post_id_n";
$likesi = $conn->prepare($likes_sqli);
$likesi->bindParam(':get_post_id_n',$get_post_id_n,PDO::PARAM_INT);
$likesi->execute();
$likesi = $likesi->rowCount();
//yes
$likes_sqly = "SELECT id FROM polls WHERE post_id=:get_post_id_i";
$likesy = $conn->prepare($likes_sqly);
$likesy->bindParam(':get_post_id_i',$get_post_id_i,PDO::PARAM_INT);
$likesy->execute();
$likesy = $likesy->rowCount();
//yes
if ($likes_numi == 0) {

    $likenumi = "0";
}elseif ($likes_numi == 1){
    $likenumi = 1/$likesy*100;
}else{
    $likenumi = $likes_numi/$likesy*100;
}
//no
if ($likes_num == 0) {
    $likenumn = "0";
}elseif ($likes_num == 1){
    $likenumn = 1/$likesi*100;
}else{
    $likenumn = $likes_num/$likesi*100;
}
echo"
<div class='w3-light-grey' style='border:thin solid black;height:60px;width:350px;border-radius:25px;box-shadow: 0px 0px 18px rgba(63, 81, 181, 0.16);'>
<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<p onclick=\"votey('$get_post_id_i')\" style='display:inline;border:none;text-align:left;'><span id='pollcouy_$get_post_id_n'>$ye_poll</span><span style='";if(!empty($c_num)){echo"display:inline";}else{echo"display:none";} echo"' id='postLikeCounti_$get_post_id_i'>$likenumi%</span></p>
<p onclick=\"voten('$get_post_id_i')\" style='display:inline;border:none;text-align:right;float:right;'><span id='pollcoun_$get_post_id_n'>$no_poll</span><span style='";if(!empty($c_num)){echo"display:inline";}else{echo"display:none";} echo"' id='postLikeCounti_$get_post_id_n'>$likenumn%</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</div>
</div>";
		}
		elseif(!empty($get_post_img)){
		if(preg_match("/.(png|jpeg|jpg)$/i", $get_post_img/*importent!!!*/)){
			if(!empty($img_op)){
        echo "<div id='pr_$get_post_id'><img class='$img_sty' align='center' style='object-fit:cover;object-position:50% 50%;width: 98%;height:550px;border-radius:10px;max-width: 98%;max-height:80%;opacity:$img_op;' onclick='lightbox(\"$get_post_id\")' id='lightboxImg_$get_post_id' src=\"../imgs/$get_post_img\" alt='$query_fetch_fullname' /></div>";
			}else{
				echo"<div id='pr_$get_post_id'><img class='$img_sty' align='center' style='object-fit:cover;object-position:50% 50%;width: 98%;border-radius:10px;height:550px;max-width: 98%;max-height:80%;' onclick='lightbox(\"$get_post_id\")' id='lightboxImg_$get_post_id' src=\"../imgs/$get_post_img\" alt='$query_fetch_fullname' /></div>";
			}
		}elseif(preg_match("/.(mp4|ogg|wmb)$/i", $get_post_img/*importent!!!*/)){
			 echo "<video controls autoplay align='center' class='$img_sty' style='width: 98%;border-radius:10px;height:550px;max-width: 98%;max-height:80%;' id='lightboxImg_$get_post_id' src=\"../imgs/$get_post_img\">Your browser don't support videos!!!</video>";
		}elseif(preg_match("/.(mp3)$/i", $get_post_img/*importent!!!*/)){
				 echo "<audio controls autoplay align='center' style='width: 98%;height:550px;border-radius:10px;max-width: 98%;max-height:80%;' id='lightboxImg_$get_post_id' src=\"../imgs/$get_post_img\">Your browser don't support audios!!!</audio>";
		}elseif(preg_match("/.(pdf)$/i", $get_post_img/*importent!!!*/)){ 
		echo "<embed align='center' id='lightboxImg_$get_post_id' style='width: 98%;border-radius:10px;height:550px;max-width: 98%;max-height:80%;' type='application/pdf' src=\"../imgs/$get_post_img\"></embed>";
		}
		}
// ========= fetch share post ==========
if (!empty(trim($get_post_shared))) {
$fetch_shared = $conn->prepare("SELECT * FROM wpost WHERE post_id=:get_post_shared ");
$fetch_shared->bindParam(':get_post_shared',$get_post_shared,PDO::PARAM_INT);
$fetch_shared->execute();
while ($sharedRow = $fetch_shared->fetch(PDO::FETCH_ASSOC)) {
    $shP_id = $sharedRow['post_id'];
    $shP_aid = $sharedRow['author_id'];
	$get_post_head_sh = $sharedRow['hea_wr'];
$get_post_story_sh = $sharedRow['s_wr'];
    $shP_img = $sharedRow['post_img'];
	$img_mov = $sharedRow['photomov'];
	$w_photo_v = $sharedRow['w_photo_v'];
$movie = $sharedRow['movie'];
	$get_post_write = $sharedRow['p_write'];
	$question = $sharedRow['question'];
$op1 = $sharedRow['op1'];
$op2 = $sharedRow['op2'];
$op3 = $sharedRow['op3'];
$ch_co = $sharedRow['ch_co'];
$poll_ques = $sharedRow['poll_ques'];
$ye_poll = $sharedRow['ye_poll'];
$no_poll = $sharedRow['no_poll'];
$ye_poll_nu = $sharedRow['ye_poll_nu'];
$no_poll_nu = $sharedRow['no_poll_nu'];
	$link = $sharedRow['link'];
		$color = $sharedRow['color'];
		$img_sty = $sharedRow['img_sty'];
$img_op = $sharedRow['img_opacity'];
		$get_text_image = $sharedRow['imgtext'];
$font = $sharedRow['font'];
    $shP_title = $sharedRow['p_title'];
    $shP_content = $sharedRow['post_content'];
    $shP_time = $sharedRow['post_time'];
    $shP_timeago = time_ago($shP_time);

    $who_shareInfo = $conn->prepare("SELECT * FROM signup WHERE id=:shP_aid ");
    $who_shareInfo->bindParam(':shP_aid',$shP_aid,PDO::PARAM_INT);
    $who_shareInfo->execute();
    while ($user_row = $who_shareInfo->fetch(PDO::FETCH_ASSOC)) {
        $shU_un = $user_row['Username'];
        $shU_up = $user_row['Userphoto'];
        $shU_fn = $user_row['Fullname'];
    }

$sh_post_body = str_replace($em_char,$em_img,$shP_content);
$sh_hashtag_path = $check_path."hashtag/";
$sh_hashtags_url = '/(\#)([x00-\xFF]+[a-zA-Z0-9x00-\xFF_\w]+)/';
$sh_url = '/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\:[0-9]+)?(\/\S*)?/';
$sh_body = preg_replace($sh_url, '<a href="$0" target="_blank" title="$0">$0<i class="fa fa-link"></i></a>', $sh_post_body);
if ($isHashTagPage == "yep") {
    $sh_body = preg_replace($sh_hashtags_url, '<b><a href="'.$sh_hashtag_path.'$2" title="#$2" class="hashtagHightlight">#$2</a></b>', $sh_body);
}else{
    $sh_body = preg_replace($sh_hashtags_url, '<b><a href="'.$sh_hashtag_path.'$2" title="#$2">#$2</a></b>', $sh_body);
}
//url////////////////////////////////
    $hashtags_url = '/(\www.)([x00-\xFF]+[a-zA-Z0-9x00-\xFF_\w\.com]+)/';
    $sh_body = preg_replace($hashtags_url, "<a href='../$2' title='www.$2'>www.$2<i class='fa fa-link'></i></a>", $sh_body);
//u////////////////////////////////
    $hashtags_url = '/(\@)([x00-\xFF]+[a-zA-Z0-9x00-\xFF_\w]+)/';
    $sh_body = preg_replace($hashtags_url, "<b><a href='".$check_path."u/$2' title='$2'>@$2</a></b>", $sh_body);
$sh_body = nl2br("$sh_body");
}
//////////////////post///////////
echo "
<div class=\"post\" style='min-width: 98%;border-radius:10px; max-height:650px;' id=\"$shP_id\" style='margin: 0;text-align:".lang('post_align').";'>
<div class=\"username_OF_post\">
<table style=\"width:100%;\">
<tbody><tr>
<td style=\"width:50px;\">
<div class=\"username_OF_postImg\"><img src=\"".$check_path."imgs/user_imgs/$shU_up\"></div></td><td>
</td><td>
<a href=\"".$check_path."u/$shU_un\" class=\"username_OF_postLink\">$shU_fn</a><br>
<a href=\"".$check_path."posts/post?pid=$shP_id\" class=\"username_OF_postTime\">$shP_timeago</a>
</td>
</tr>
</tbody></table>
</div><div id='postTitle_$get_post_id'>";
if (!empty($shP_title)) {
    echo "<p class='postTitle' style='border-".lang('float').": 2px solid rgba(80, 94, 113, 0.19); text-align: ".lang('textAlign').";'>$shP_title</p>";
}
echo "</div><div class=\"post_content\" style=\"text-align:left;\">
<p dir=\"auto\" id=\"postContent_$shP_id\" style='text-align: ".lang('textAlign').";'>$sh_body";
echo "</p>";
if (!empty($get_post_story_sh)) {
			echo "<a href='".$check_path."posts/book?pid=".$get_post_id."'><div style='width: 98%;height:80%;max-width: 98%;max-height:80%;background-color:grey;text-align: center;'><br><img align='center' style='width: 85%;height:460px;max-width: 85%;max-height:460px;box-shadow: 0px 0px 18px rgba(63, 81, 181, 0.16);' id='lightboxImg_$get_post_id'  class='$img_sty' src=\"".$imgs_path."$w_photo_v\" alt='$query_fetch_fullname' /></div></a>";
		}elseif (!empty($movie)) {
		echo "<a href='".$check_path."posts/film?pid=".$get_post_id."'><div style='width: 98%;height:80%;max-width: 98%;max-height:80%;background-color:grey;text-align: center;'><br><img align='center' style='width: 70%;height:90%;max-width: 85%;max-height:90%;box-shadow: 0px 0px 18px rgba(63, 81, 181, 0.16);' id='lightboxImg_$get_post_id' src='imgs/$img_mov' alt='$query_fetch_fullname' /></div></a>";
		}
		elseif (!empty($get_post_write)) {
			if (!empty($get_text_image)) {
			echo nl2br("<div class='$color' style='border-radius:10px;font-family: $font;background: url(\"imgs/$get_text_image\") no-repeat center center; background-size: cover;width: 98%;height:80%;font-size: 27px; text-align:center;max-width: 98%;max-height:80%;'><p dir='auto'><br>$get_post_write</p></div>");
			}else{
			echo nl2br("<div class='$color' style='border-radius:10px;font-family: $font;width: 98%;height:80%;font-size: 27px; text-align:center;max-width: 98%;max-height:80%;'><p dir='auto'><br>$get_post_write</p></div>");
			}
		}elseif (!empty($link)) {
			echo "<iframe src='$link' style='border-radius:10px;width: 98%;height:80%;max-width: 98%;max-height:80%;'></iframe>";
		}elseif(!empty($question)){
			echo "<div dir='auto' style='width:30%;height:60%;background:white;box-shadow: 0px 0px 18px rgba(63, 81, 181, 0.16);border: 1px solid transparent;border-radius: 10px;'>
<div class='w3-light-grey' style='height:15%;border-radius:4px;text-align:center;'>
<script>
	function fl_$get_post_id() { 
		document.getElementById('incorr_$get_post_id').style.display = 'inline';
		document.getElementById('corr_$get_post_id').style.display = 'none';
		document.getElementById('nim_op1_$get_post_id').style.display = 'none';
		document.getElementById('nim_op2_$get_post_id').style.display = 'none';
		document.getElementById('nim_op3_$get_post_id').style.display = 'none';
		document.getElementById('opdi1_$get_post_id').style.background = 'green';
		";
		echo"
	}
	function tr_$get_post_id() { 
		document.getElementById('corr_$get_post_id').style.display = 'inline';
		document.getElementById('incorr_$get_post_id').style.display = 'none';
		document.getElementById('nim_op1_$get_post_id').style.display = 'none';
		document.getElementById('nim_op2_$get_post_id').style.display = 'none';
		document.getElementById('nim_op3_$get_post_id').style.display = 'none';
		document.getElementById('opdi1_$get_post_id').style.background = 'green';
		";
		echo"
	}
</script>
<br>
$question
</div>
<br>
<div id='";if($ch_co == "a"){echo"opdi1_$get_post_id";}elseif($ch_co != "a"){echo"opdin1_$get_post_id";}echo"' style='width:100%;height:15%;border-radius:25px;border: thin solid  grey;background:;' onclick='";if($ch_co == "a"){echo"tr_$get_post_id()";}else{echo"fl_$get_post_id()";}echo"'><div style='border-radius:4px;' id='aod'>
<br>&nbsp;&nbsp;&nbsp;<span id='nim_op1_$get_post_id' style='border: solid grey;border-radius:100px;padding:5px 5px;'>A</span>&nbsp;&nbsp;  ";if($ch_co == "a"){echo"<img src=\"".$imgs_path."main_icons/2705.png\" id='corr_$get_post_id' style='display:none;width:20px;height:20px;'>";}echo"
$op1</div>
</div>
<br>
<div id='";if($ch_co == "b"){echo"opdi1_$get_post_id";}elseif($ch_co != "b"){echo"opdin2_$get_post_id";}echo"' style='width:100%;height:15%;border-radius:25px;border: thin solid  grey;background:;' onclick='";if($ch_co == "b"){echo"tr_$get_post_id()";}else{echo"fl_$get_post_id()";}echo"'><div style='border-radius:4px;' id='bod'>
<br>&nbsp;&nbsp;&nbsp;<span id='nim_op2_$get_post_id' style='border: solid grey;border-radius:100px;padding:5px 5px;'>B</span>&nbsp;&nbsp;  ";if($ch_co == "b"){echo"<img src=\"".$imgs_path."main_icons/2705.png\" id='corr_$get_post_id' style='display:none;width:20px;height:20px;'>";}echo"
$op2</div>
</div>
<br>
<div id='";if($ch_co == "c"){echo"opdi1_$get_post_id";}elseif($ch_co != "c"){echo"opdin3_$get_post_id";}echo"' style='width:100%;height:15%;border-radius:25px;border: thin solid  grey;background:;' onclick='";if($ch_co == "c"){echo"tr_$get_post_id()";}else{echo"fl_$get_post_id()";}echo"'><div style='border-radius:4px;' id='zod'>
<br>&nbsp;&nbsp;&nbsp;<span id='nim_op3_$get_post_id' style='border: solid grey;border-radius:100px;padding:5px 5px;'>C</span>&nbsp;&nbsp;  ";if($ch_co == "c"){echo"<img src=\"".$imgs_path."main_icons/2705.png\" id='corr_$get_post_id' style='display:none;width:20px;height:20px;'>";}echo"
$op3<br>
</div></div>
	<div id='incorr_$get_post_id' style='display:none'>not correct</div>
</div>
";
		}elseif(!empty($poll_ques)){
			echo"<div class='w3-grey' style='border:thin solid black;height:200px;width:350px;border-radius:10px;box-shadow: 0px 0px 18px rgba(63, 81, 181, 0.16);'>
<br>
<p style='text-align:center;width:100%;font-size:25px;color:purple;'>$poll_ques</p>
<br>
<br>";
//poll_yes
$s_idi = $_SESSION['id'];

$get_post_id_i = $postsfetch['post_id'];
$csql = "SELECT id FROM polls WHERE poller=:s_idi AND post_id=:get_post_id_i";
$c = $conn->prepare($csql);
$c->bindParam(':s_idi',$s_idi,PDO::PARAM_INT);
$c->bindParam(':get_post_id_i',$get_post_id_i,PDO::PARAM_INT);
$c->execute();
$c_num = $c->rowCount();
if ($c_num > 0){
}else{
}
$likes_sql = "SELECT id FROM polls WHERE post_id=:get_post_id_i AND yes=1";
$likes = $conn->prepare($likes_sql);
$likes->bindParam(':get_post_id_i',$get_post_id_i,PDO::PARAM_INT);
$likes->execute();
$likes_numi = $likes->rowCount();

//poll_no
$s_idn = $_SESSION['id'];
$get_post_id_n = $postsfetch['post_id'];
$csql = "SELECT id FROM polls WHERE poller=:s_idn AND post_id=:get_post_id_n";
$c = $conn->prepare($csql);
$c->bindParam(':s_idn',$s_idn,PDO::PARAM_INT);
$c->bindParam(':get_post_id_n',$get_post_id_n,PDO::PARAM_INT);
$c->execute();
$c_num = $c->rowCount();
if ($c_num > 0){
}else{
}
$likes_sql = "SELECT id FROM polls WHERE post_id=:get_post_id_n AND no=1";
$likes = $conn->prepare($likes_sql);
$likes->bindParam(':get_post_id_n',$get_post_id_n,PDO::PARAM_INT);
$likes->execute();
$likes_num = $likes->rowCount();
////////////////////
$likes_sqli = "SELECT id FROM polls WHERE post_id=:get_post_id_n";
$likesi = $conn->prepare($likes_sqli);
$likesi->bindParam(':get_post_id_n',$get_post_id_n,PDO::PARAM_INT);
$likesi->execute();
$likesi = $likesi->rowCount();
//yes
$likes_sqly = "SELECT id FROM polls WHERE post_id=:get_post_id_i";
$likesy = $conn->prepare($likes_sqly);
$likesy->bindParam(':get_post_id_i',$get_post_id_i,PDO::PARAM_INT);
$likesy->execute();
$likesy = $likesy->rowCount();
//yes
if ($likes_numi == 0) {

    $likenumi = "0";
}elseif ($likes_numi == 1){
    $likenumi = 1/$likesy*100;
}else{
    $likenumi = $likes_numi/$likesy*100;
}
//no
if ($likes_num == 0) {
    $likenumn = "0";
}elseif ($likes_num == 1){
    $likenumn = 1/$likesi*100;
}else{
    $likenumn = $likes_num/$likesi*100;
}
echo"
<div class='w3-light-grey' style='border:thin solid black;height:60px;width:350px;border-radius:25px;box-shadow: 0px 0px 18px rgba(63, 81, 181, 0.16);'>
<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<p onclick=\"votey('$get_post_id_i')\" style='display:inline;border:none;text-align:left;'><span id='pollcouy_$get_post_id_n'>$ye_poll</span><span style='";if(!empty($c_num)){echo"display:inline";}else{echo"display:none";} echo"' id='postLikeCounti_$get_post_id_i'>$likenumi%</span></p>
<p onclick=\"voten('$get_post_id_i')\" style='display:inline;border:none;text-align:right;float:right;'><span id='pollcoun_$get_post_id_n'>$no_poll</span><span style='";if(!empty($c_num)){echo"display:inline";}else{echo"display:none";} echo"' id='postLikeCounti_$get_post_id_n'>$likenumn%</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</div>
</div>";
		}
		elseif (!empty($shP_img)) {
			if(preg_match("/.(png|jpeg|jpg)$/i", $shP_img/*importent!!!*/)){
			if(!empty($img_op)){
        echo "<div id='pr_$get_post_id'><img class='$img_sty' align='center' style='object-fit:cover;object-position:50% 50%;border-radius:10px;width: 98%;height:400px;max-width: 98%;max-height:400px;opacity:$img_op;' onclick='lightbox(\"$get_post_id\")' id='lightboxImg_$get_post_id' src=\"../imgs/$shP_img\" alt='$query_fetch_fullname' /></div>";
			}else{
				echo"<div id='pr_$get_post_id'><img class='$img_sty' align='center' style='object-fit:cover;object-position:50% 50%;border-radius:10px;width: 98%;height:400px;max-width: 98%;max-height:400px;' onclick='lightbox(\"$get_post_id\")' id='lightboxImg_$get_post_id' src=\"../imgs/$shP_img\" alt='$query_fetch_fullname' /></div>";
			}		}elseif(preg_match("/.(mp4|ogg|wmb)$/i", $shP_img/*importent!!!*/)){
			 echo "<video controls autoplay align='center' style='border-radius:10px;width: 98%;height:400px;max-width: 98%;max-height:400px;' id='lightboxImg_$get_post_id' src=\"../imgs/$shP_img\">Your browser don't support videos!!!</video>";
		}elseif(preg_match("/.(mp3)$/i", $shP_img/*importent!!!*/)){
				 echo "<audio controls autoplay align='center' style='border-radius:10px;width: 98%;height:400px;max-width: 98%;max-height:400px;' id='lightboxImg_$get_post_id' src=\"../imgs/$shP_img\">Your browser don't support audios!!!</audio>";
		}elseif(preg_match("/.(pdf)$/i", $shP_img/*importent!!!*/)){ 
		echo "<embed align='center' id='lightboxImg_$get_post_id' style='border-radius:10px;width: 98%;height:400px;max-width: 98%;max-height:400px;' type='application/pdf' src=\"../imgs/$shP_img\"></embed>";
		}
		}
echo "
</div>
</div>
";
}
// ===================tools==================
echo "
</div>
<div id='postNotify2_$get_post_id'></div>
<div>&nbsp;&nbsp;&nbsp;&nbsp;";
//like
$s_id = $_SESSION['id'];
$csql = "SELECT id FROM likes WHERE liker=:s_id AND post_id=:get_post_id";
$c = $conn->prepare($csql);
$c->bindParam(':s_id',$s_id,PDO::PARAM_INT);
$c->bindParam(':get_post_id',$get_post_id,PDO::PARAM_INT);
$c->execute();
$c_num = $c->rowCount();
if ($c_num > 0){
    echo "<span id='likeUnlike_$get_post_id' style='cursor:pointer'><span onclick=\"likeUnlike('$get_post_id')\" style='color:#ff928a;font-size:30px' data-toggle='tooltip' data-placement='top' title='".lang('u_liked_this')."' id='punlike'><span class=\"fa fa-heart\"></span></span></span>";
}else{
    echo "<span id='likeUnlike_$get_post_id' style='cursor:pointer'><span onclick=\"likeUnlike('$get_post_id')\" style='color:#ff928a;font-size:30px' data-toggle='tooltip' data-placement='top' title='".lang('liked')."' id='plike'><span class=\"fa fa-heart-o\"></span></span></span>";
}
$likes_sql = "SELECT id FROM likes WHERE post_id=:get_post_id";
$likes = $conn->prepare($likes_sql);
$likes->bindParam(':get_post_id',$get_post_id,PDO::PARAM_INT);
$likes->execute();
$likes_num = $likes->rowCount();
if ($likes_num == 0) {
    $likenum = "<span class='fa fa-heart'></span> ".lang('no_likes');
}elseif ($likes_num == 1){
    $likenum = "1 <span class='fa fa-heart' style='color: #ff928a;'></span>";
}else{
    $likenum = thousandsCurrencyFormat($likes_num)." <span class='fa fa-heart' style='color: #ff928a;'></span>";
}

//comment button
   echo" <a href=\"javascript:void(0);\"onclick=\"dis('d_$get_post_id')\" style='font-size:30px' class='post_like_comment_shareA' data-toggle='tooltip' data-placement='top' title='".lang('comment')."'><span onclick=\"fcomment('$get_post_id')\" class=\"fa fa-commenting\"></span></a>";
   if(!$poll_ques || !$question){
   echo" <a href=\"posts/mailsend?pid=$get_post_id\" style='font-size:28px' class='post_like_comment_shareA' data-toggle='tooltip' data-placement='top' title='Send a message'><span class=\"fa fa-envelope\"></span></a>";
   }$lik_cou = $likes_num + $likes_numi;
//share
echo "<a href='javascript:void(0);' style='font-size:30px' onclick=\"sharePost('$get_post_id','$check_path')\"  class='post_like_comment_shareA'data-toggle='tooltip' data-placement='top' title='".lang('share_now')."'><span class=\"fa fa-share\"></span></a>
        ";if(!$poll_ques || !$question){
		$so_id = $_SESSION['id'];
$csql = "SELECT id FROM saved WHERE user_saved_id=:so_id AND post_id=:get_post_id";
$co = $conn->prepare($csql);
$co->bindParam(':so_id',$so_id,PDO::PARAM_INT);
$co->bindParam(':get_post_id',$get_post_id,PDO::PARAM_INT);
$co->execute();
$co_num = $co->rowCount();

while ($query_fetch = $co->fetch(PDO::FETCH_ASSOC)) {
    $saved_id = $query_fetch['id'];
}
if ($co_num > 0){
		echo"<span id='saveud_$get_post_id' style='cursor:pointer'><a href='javascript:void(0)' style='font-size:30px;float:right;margin-right:20px;' class='post_like_comment_shareA' onclick=\"deleteSaved('$saved_id');\"><span class='fa fa-bookmark'></span></a></span>";
}else{
		echo"<span id='saveu_$get_post_id' style='cursor:pointer'><a href='javascript:void(0)' style='font-size:30px;float:right;margin-right:20px;' class='post_like_comment_shareA' onclick=\"savePost('$get_post_id','$check_path')\"><span class='fa fa-bookmark-o'></span></a></span>";
}
	}echo"<p class='comment_details' style='text-align:".lang('textAlign').";'>
    <span id='postLikeCount_$get_post_id'>$likenum</span><span style='margin: 0px 5px;padding: 1px;'></span>
    <span id='postCommCount_$get_post_id'>$chtcnum</span><span style='margin: 0px 5px;padding: 1px;'></span>";
	if($poll_ques){
    echo"<span id='postvotCount_$get_post_id'>$lik_cou votes</span><span style='margin: 0px 5px;padding: 1px;'></span>";
	}
    echo"<span id='postShareCount_$get_post_id'>$shareCount</span>
    <span id='p_privacyView_$get_post_id' style='top: -20px;float:".lang('float2').";font-size: 15px;'>".$postPrivacy."</span>
    </p>
</div>
<div class=\"comment_box\">
<div id='d_$get_post_id' style='display: none;'>
<div class='user_comment' id='postComments_$get_post_id'>";
    include "../includes/fetch_comments.php";
echo"
</div>
</div>
<div id='writeComm_$get_post_id'>
<div style='position:relative;display:flex;background: #fff; box-shadow: 2px 2px rgba(0, 0, 0, 0.04); border-radius: 20px;'>
  <textarea dir=\"auto\" autocomplete='off' class='comment_field' id='inputComm_$get_post_id' type=\"text\" data-cid='$get_post_id' data-path='$check_path' name=\"$get_post_id\" placeholder='".lang('comment_field_ph')."' style='text-align:".lang('comment_field_align').";' ></textarea>
  <span class='emoticonsBtn fa fa-smile-o' onclick=\"cEmojiBtn('$get_post_id')\" id='#embtn_".$get_post_id."'></span>
      <div id='em_$get_post_id' data-emtog='0' style='".lang('float2').":0;' class='emoticonsBox'></div>
	  <span class='emoticonsBtn fa fa-photo' onclick=\"showimg('imgdivcom_$get_post_id')\" id='#embtn_".$get_post_id."'></span>
</div>
<p style='font-size: 10px; padding: 0px 10px; border: none; margin: 0; margin-top: 3px;'>".lang('newLine_Shift_enter')." Shift+Enter</p>
</div>

<div id='CommentLoading_$get_post_id'>
</div>
<div id='imgdivcom_$get_post_id' style='display:none'>";
echo"

</div>
</div></div>
";

}
?>
	<?php
break;
case 'following':
?>
<!--============================================followeing_section==================================================-->
<div class="post" style="min-width: 87.5%;" id="followeing_section">
<?php
if ($_SESSION['id'] == $row_id) {
    $following_paragraph = lang('uProf_urfollowingTitle');
}else{
    if ($row_gender == "Male") {
        $genser_f = lang('uProf_followingTitleHe');
    }elseif($row_gender == "Female"){
        $genser_f = lang('uProf_followingTitleShe');
    }
    $following_paragraph = lang('uProf_followingTitle1')." $genser_f".lang('uProf_followingTitle2');
}
?>
<p class="small_caps_paragraph" style="text-align:<?php echo lang('uProf_ffTitle_align'); ?>;"><?php echo $following_paragraph; ?></p>
<?php
$s_id = $_SESSION['id'];
$getfolloweing_sql = "SELECT * FROM follow WHERE uf_one=:row_id";
$getfolloweing = $conn->prepare($getfolloweing_sql);
$getfolloweing->bindParam(':row_id',$row_id,PDO::PARAM_INT);
$getfolloweing->execute();
$num_followers = $getfolloweing->rowCount();
if ($num_followers == 0) {
echo "<p style='color:gray;padding:15px;margin:0;font-size:18px;text-align:center;'>".lang('nothingToShow')."</p>";
}else{
while ($getfolloweing_fetch = $getfolloweing->fetch(PDO::FETCH_ASSOC)) {
$getfolloweing_id = $getfolloweing_fetch['uf_two'];
$ufolloweing_sql = "SELECT * FROM signup WHERE id=:getfolloweing_id";
$ufolloweing = $conn->prepare($ufolloweing_sql);
$ufolloweing->bindParam(':getfolloweing_id',$getfolloweing_id,PDO::PARAM_INT);
$ufolloweing->execute();
if ($getfolloweing_id == $_SESSION['id']) {
    if ($_SESSION['verify'] == "1") {
     $verifypage_var = $verifyUser;
    }else{
     $verifypage_var = "";
    }
echo "
<table class='user_follow_box'>
<tr>
<td class='user_info_tdi'><div><img src=\"../imgs/user_imgs/".$_SESSION['Userphoto']."\" alt=\"".$_SESSION['Fullname']."\" /></div></td>
<td style='width: 70%;'><a href=\"".$_SESSION['Username']."\" class='user_follow_box_a'><p>".$_SESSION['Fullname']." ".$verifypage_var."<br><span style='color:gray;'>@".$_SESSION['Username']."</span></a></td>
</tr>
</table>
";
}
while ($fetch_followeing = $ufolloweing->fetch(PDO::FETCH_ASSOC)) {
$id_followeing = $fetch_followeing['id'];
$fullname_followeing = $fetch_followeing['Fullname'];
$username_followeing = $fetch_followeing['Username'];
$userphoto_followeing = $fetch_followeing['Userphoto'];
$verify_followeing = $fetch_followeing['verify'];
$followBtn_sql = "SELECT id FROM follow WHERE uf_one=:s_id AND uf_two=:id_followeing";
$followBtn = $conn->prepare($followBtn_sql);
$followBtn->bindParam(':s_id',$s_id,PDO::PARAM_INT);
$followBtn->bindParam(':id_followeing',$id_followeing,PDO::PARAM_INT);
$followBtn->execute();
$followBtn_num = $followBtn->rowCount();
if ($followBtn_num > 0){
    $follow_btn = "<span id='followUnfollow_$id_followeing' style='cursor:pointer'><button class=\"unfollow_btn\" onclick=\"followUnfollow('$id_followeing')\"><span class=\"fa fa-check\"></span> ".lang('followingBtn_str')."</button></span>";
}else{
    $follow_btn = "<span id='followUnfollow_$id_followeing' style='cursor:pointer'><button class=\"follow_btn\" onclick=\"followUnfollow('$id_followeing')\"><span class=\"fa fa-plus-circle\"></span> ".lang('followBtn_str')."</button></span>";
}
if ($verify_followeing == "1"){
$verifypage_var = $verifyUser;
}else{
$verifypage_var = "";
}
if($id_followeing != $_SESSION['id']){
       echo "
<table class='user_follow_box' id='UserUnfollow_$id_followeing'>
<tr>
<td class='user_info_tdi'><div><img src=\"../imgs/user_imgs/$userphoto_followeing\" alt=\"$fullname_followeing\" /></div></td>
<td style='width: 70%;'><a href=\"$username_followeing\" class='user_follow_box_a'><p>$fullname_followeing $verifypage_var<br><span style='color:gray;'>@$username_followeing</span></a></td>
<td style='width: 100%;'><span style='float:".lang('float2').";'>$follow_btn</span></td>
</tr>
</table>
";
}
}
}
}
?>
</div>
<!--============================================End followeing_section==================================================-->
<?php
break;
//================================================story mobile=======================================================
case 'story':
?>
<div class="w3-light-grey" style="border-radius:4px;border:1px solid transparent ; box-shadow: 0px 0px 18px rgba(63, 81, 181, 0.16);margin-top:4px;margin-bottom:-4px;">
<a href="<?php echo $row_username;?>&ut=post"><button class="w3-light-grey w3-button" style="padding:10px;border:none;color:black;font-size:30px;"><span class="fa fa-table"></span></button></a>
<a href="<?php echo $row_username;?>&ut=postlin"><button class="w3-light-grey w3-button" style="padding:10px;border:none;color:black;font-size:30px;"><span class="fa fa-newspaper-o"></span></button></a>
<a href="<?php echo $row_username;?>&ut=story"><button class="w3-light-grey w3-button" style="padding:10px;border:none;color:black;font-size:30px;"><span class="fa fa-star"></span></button></a>
</div>
<div class="post" style="min-width: 87.5%;" id="followeing_section">
<p class="small_caps_paragraph" style="text-align:<?php echo lang('uProf_ffTitle_align'); ?>;"><?php echo lang('Stories'); ?></p>
				<?php
$s_id = $_SESSION['id'];
$check_path = filter_var(htmlspecialchars($_POST['path']),FILTER_SANITIZE_STRING);
$plimit = filter_var(htmlspecialchars($_POST['plimit']),FILTER_SANITIZE_NUMBER_INT);
$p_privacy = "2";
$myid = $_SESSION['id'];
$vpsql = "SELECT * FROM story WHERE author_id=:myid";
$view_posts = $conn->prepare($vpsql);
$view_posts->bindParam(':myid',$myid,PDO::PARAM_INT);
$view_posts->execute();
$view_postsNum = $view_posts->rowCount();

if ($view_postsNum > 0) {
while ($postsfetch = $view_posts->fetch(PDO::FETCH_ASSOC)) {
$story_id = $postsfetch['story_id'];
$author_id = $postsfetch['author_id'];
$get_post_author = $postsfetch['post_author'];
$get_post_author_photo = $postsfetch['post_author_photo'];
$story_time = $postsfetch['story_time'];
$story_time_get = time_ago($story_time);
$story_img = $postsfetch['story_img'];
$story_content = $postsfetch['story_content'];
$location = $postsfetch['location'];
$mention = $postsfetch['mention'];
$time_fu = $postsfetch['time_fu'];
$color = $postsfetch['color'];
$p_write = $postsfetch['p_write'];

$qsql = "SELECT * FROM signup WHERE id=:author_id";
$query = $conn->prepare($qsql);
$query->bindParam(':author_id', $author_id, PDO::PARAM_INT);
$query->execute();

while ($query_fetch = $query->fetch(PDO::FETCH_ASSOC)) {
    $query_fetch_id = $query_fetch['id'];
    $query_fetch_username = $query_fetch['Username'];
    $query_fetch_fullname = $query_fetch['Fullname'];
    $query_fetch_userphoto = $query_fetch['Userphoto'];
    $query_fetch_verify = $query_fetch['verify'];
}
//////////////////////////
//type cast, current time, difference in timestamps
    $curtim = time();
    $diff = $curtim - $story_time;
    //intervals in seconds
    $intervals      = array (
        'year' => 31556926, 'month' => 2629744, 'week' => 604800, 'day' => 86400, 'hour' => 3600, 'minute'=> 60
    );
    //now we just find the difference
    if ($diff >= 86400 && $diff < 2629744)
    {
	$delete_post_sql = "DELETE FROM story WHERE story_id= :story_id";
	$delete_post = $conn->prepare($delete_post_sql);
	$delete_post->bindParam(':story_id',$story_id,PDO::PARAM_INT);
	$delete_post->execute();
    }else{
//////////////////////////////
	echo"<div class='storydiv' style='height:200px;";if($story_img){if(preg_match("/.(png|jpeg|jpg)$/i", $story_img/*importent!!!*/)){echo"background: url(../imgs/$story_img) no-repeat center center; background-size: cover;";}}elseif($color){if($color == "cod"){echo"background: linear-gradient(500deg,#8910d6,#b52d94);";}else{echo"background:$color;";}}else{echo"background: linear-gradient(500deg,#8910d6,#b52d94);";}echo"'><img src='../imgs/user_imgs/$query_fetch_userphoto' style='border-radius:50%; width:10%;height:20%;border:solid thin grey;'> <a href='$query_fetch_username'><strong style='color:black;'>$query_fetch_username";if ($query_fetch_verify == "1"){echo $verifyUser;}echo"</strong></a>
	<a href='".$check_path."posts/post?pid=".$get_post_id."' style='float:right' class='username_OF_postTime'><b>$story_time_get</b></a>
	";if($p_write){echo"<br><p align='center' style='font-size:25px;'>$p_write<p>";} echo"
				<p align='center' class='pst'><a href='../posts/storywatch?pid=$story_id' style='color:black;'><span class='fa fa-film'></span></a></p></div>";
}}}else{
	echo lang('nothingToShow');
}
?>
</div>
<?php
break;
//====================================================end story mobile==============================================
case 'stars':
?>
<!--============================================ Stars_section==================================================-->
<div style="min-width: 87.5%;"  class="post">
<?php
$s_id = $_SESSION['id'];
$getS_sql = "SELECT * FROM r_star WHERE p_id =:row_id";
$getS = $conn->prepare($getS_sql);
$getS->bindParam(':row_id',$row_id,PDO::PARAM_INT);
$getS->execute();
$getS_count = $getS->rowCount();
if ($getS_count == 0) {
    echo "<p style='color:gray;padding:15px;margin:0;font-size:18px;text-align:center;'>".lang('nothingToShow')."</p>";
}else{
while ($getS_row = $getS->fetch(PDO::FETCH_ASSOC)) {
    $getuserid = $getS_row['u_id'];
    $getuser_sql = "SELECT * FROM signup WHERE id=:getuserid";
    $getuser = $conn->prepare($getuser_sql);
    $getuser->bindParam(':getuserid',$getuserid,PDO::PARAM_INT);
    $getuser->execute();
    if ($getuserid == $_SESSION['id']) {
    if ($_SESSION['verify'] == "1") {
     $verifypage_var = $verifyUser;
    }else{
     $verifypage_var = "";
    }
    echo "
    <table class='user_follow_box'>
    <tr>
    <td class='user_info_tdi'><div><img src=\"../imgs/user_imgs/".$_SESSION['Userphoto']."\" alt=\"".$_SESSION['Fullname']."\" /></div></td>
    <td style='width: 70%;'><a href=\"".$_SESSION['Username']."\" class='user_follow_box_a'><p>".$_SESSION['Fullname']." ".$verifypage_var."<br><span style='color:gray;'>@".$_SESSION['Username']."</span></a></td>
    </tr>
    </table>
    ";
    }
    while ($getuser_row = $getuser->fetch(PDO::FETCH_ASSOC)) {
        $id_stars = $getuser_row['id'];
        $fullname_stars = $getuser_row['Fullname'];
        $username_stars = $getuser_row['Username'];
        $userphoto_stars = $getuser_row['Userphoto'];
        $verify_stars = $getuser_row['verify'];
        $followBtn_sql = "SELECT id FROM follow WHERE uf_one=:s_id AND uf_two=:id_stars";
        $followBtn = $conn->prepare($followBtn_sql);
        $followBtn->bindParam(':s_id',$s_id,PDO::PARAM_INT);
        $followBtn->bindParam(':id_stars',$id_stars,PDO::PARAM_INT);
        $followBtn->execute();
        $followBtn_num = $followBtn->rowCount();
        if ($followBtn_num > 0){
            $follow_btn = "<span id='followUnfollow_$id_stars' style='cursor:pointer'><button class=\"unfollow_btn\" onclick=\"followUnfollow('$id_stars')\"><span class=\"fa fa-check\"></span> ".lang('followingBtn_str')."</button></span>";
        }else{
            $follow_btn = "<span id='followUnfollow_$id_stars' style='cursor:pointer'><button class=\"follow_btn\" onclick=\"followUnfollow('$id_stars')\"><span class=\"fa fa-plus-circle\"></span> ".lang('followBtn_str')."</button></span>";
        }

        if ($verify_stars == "1"){
        $verifypage_var = $verifyUser;
        }else{
        $verifypage_var = "";
        }

        if($id_stars != $_SESSION['id']){
               echo "
        <table class='user_follow_box' id='UserUnfollow_$id_stars'>
        <tr>
        <td class='user_info_tdi'><div><img src=\"../imgs/user_imgs/$userphoto_stars\" alt=\"$fullname_stars\" /></div></td>
        <td style='width: 70%;'><a href=\"$username_stars\" class='user_follow_box_a'><p>$fullname_stars $verifypage_var<br><span style='color:gray;'>@$username_stars</span></a></td>
        <td style='width: 100%;'><span style='float:".lang('float2').";'>$follow_btn</span></td>
        </tr>
        </table>
        ";
        }
    }
}
}
?>
</div>
<!--============================================End Stars_section==================================================-->
<?php
break;

default:
?>
<div class="w3-light-grey" style="border-radius:4px;border:1px solid transparent ; box-shadow: 0px 0px 18px rgba(63, 81, 181, 0.16);margin-top:4px;margin-bottom:-4px;">
<a href="<?php echo $row_username;?>&ut=post"><button class="w3-light-grey w3-button" style="padding:10px;border:none;color:black;font-size:30px;"><span class="fa fa-table"></span></button></a>
<a href="<?php echo $row_username;?>&ut=postlin"><button class="w3-light-grey w3-button" style="padding:10px;border:none;color:black;font-size:30px;"><span class="fa fa-newspaper-o"></span></button></a>
<a href="<?php echo $row_username;?>&ut=story"><button class="w3-light-grey w3-button" style="padding:10px;border:none;color:black;font-size:30px;"><span class="fa fa-star"></span></button></a>
</div>
<!--===============================================posts_section====================================================-->
            <div class="post" id="myphotos_section" style="padding: 5px;text-align:<?php echo lang('textAlign'); ?>;min-width: 100%;">
            <?php
            $u_id = $row_id;
            $emptyImg = '';
            $getphotos_sql = "SELECT * FROM wpost WHERE author_id=:u_id AND post_img != :emptyImg ORDER BY post_time DESC";
            $getphotos = $conn->prepare($getphotos_sql);
            $getphotos->bindParam(':u_id',$u_id,PDO::PARAM_INT);
            $getphotos->bindParam(':emptyImg',$emptyImg,PDO::PARAM_STR);
            $getphotos->execute();
            $getphotosCount = $getphotos->rowCount();
            ?>
            <p class="titleUserPhotosProfile"><?php echo lang('totalPhotos'); ?> <span><?php echo $getphotosCount; ?></span></p>
            <?php
            if ($getphotosCount < 1) {
                echo lang('nothingToShow');
            }
            while ($fetchMyPhotos = $getphotos->fetch(PDO::FETCH_ASSOC)) {
                $fetch_post_id = $fetchMyPhotos['post_id'];
                $fetch_author_id = $fetchMyPhotos['author_id'];
                $fetch_post_author = $fetchMyPhotos['post_author'];
                $fetch_post_author_photo = $fetchMyPhotos['post_author_photo'];
                $fetch_post_img = $fetchMyPhotos['post_img'];
                $fetch_post_time = $fetchMyPhotos['post_time'];
                $fetch_post_content = $fetchMyPhotos['post_content'];
                $timeago = time_ago($fetch_post_time);
                $fetch_post_status = $fetchMyPhotos['p_status'];
                
                $quesql = "SELECT * FROM signup WHERE id=:fetch_author_id";
                $query = $conn->prepare($quesql);
                $query->bindParam(':fetch_author_id', $fetch_author_id, PDO::PARAM_INT);
                $query->execute();
                while ($author_fetch = $query->fetch(PDO::FETCH_ASSOC)) {
                    $author_fetch_id = $author_fetch['id'];
                    $author_fetch_username = $author_fetch['Username'];
                    $author_fetch_fullname = $author_fetch['Fullname'];
                    $author_fetch_userphoto = $author_fetch['Userphoto'];
                    $author_fetch_verify = $author_fetch['verify'];
                }
            ?>
            <div class="userPhotosProfile">
				<?php
					if (!empty($fetch_post_img)) {
			if(preg_match("/.(png|jpeg|jpg)$/i", $fetch_post_img/*importent!!!*/)){
        echo "<img src=\"../imgs/$fetch_post_img\" alt='$query_fetch_fullname' />";
		}elseif(preg_match("/.(mp4|ogg|wmb)$/i", $fetch_post_img/*importent!!!*/)){
			 echo "<video style='width: 200px;height:200px;max-width: 200px;max-height:200px;object-fit:cover;' controls src=\"../imgs/$fetch_post_img\">Your browser don't support videos!!!</video>";
		}elseif(preg_match("/.(mp3)$/i", $fetch_post_img/*importent!!!*/)){
				 echo "<audio controls src=\"../imgs/$fetch_post_img\">Your browser don't support audios!!!</audio>";
		}elseif(preg_match("/.(pdf)$/i", $fetch_post_img/*importent!!!*/)){ 
		echo "<embed type='application/pdf' src=\"../imgs/$fetch_post_img\"></embed>";
		}elseif (!empty($get_post_write)) {
			echo "<div class='$color' style='font-family: $font;width: 950px;height:530px;font-size: 20px; text-align:center;max-width: 950px;max-height:530px;'><p><br>$get_post_write</p></div>";
		}
		}
		?>
            </div>
            <?php
            }   
            ?>
            </div>

<!--========================================================================-->
 </div>
<!--============================================End posts_section==================================================-->
<?php
    break;
    }
?>
<!--================================================================================================================-->
 	<script type="text/javascript">
    $('.comment_field').keypress(function (e) {
        var cid = $(this).attr('data-cid');
        var path = $(this).attr('data-path');
        if (e.keyCode == 13) {
            if (e.shiftKey) {
                return true;
            }
            commentodb(cid,path);
            this.style.height = '40px';
            return false;
        }
    });
    $('.comment_field').each(function () {
      this.setAttribute('style', 'height:40px;overflow-y:hidden;text-align:'+"<?php echo lang('textAlign'); ?>"+';');
    }).on('input', function () {
      this.style.height = '40px';
      this.style.height = (this.scrollHeight) + 'px';
    });
</script> 
<script>  
    function codespeedy(id){
      var print_div = document.getElementById(id);
var print_area = window.open();
print_area.document.write(print_div.innerHTML);
print_area.document.close();
print_area.focus();
print_area.print();
print_area.close();
// This is the code print a particular div element
    }
</script>
       </div>
        </div>
<?php
}else{
?>
<style type="text/css">
body{
background: #fff;
}
.error_page_btn{
background: whitesmoke;
padding: 8px;
border-radius: 3px;
color: #6b6b6b;
text-decoration: none;
box-shadow: inset 1px 1px 3px rgba(0, 0, 0, 0.05);
transition: background 0.1s , color 0.1s;
}
.error_page_btn:hover, .error_page_btn:focus{
background: #4a708e;
color: #fff;
text-decoration: none;
}
.error_div{
padding: 15px;
max-width: 800px;
color: #383838;
box-shadow: none;
border: 1px solid rgba(217, 217, 217, 0.36);
}
</style>
<div align="center" style="margin-top: 150px;margin-bottom: 150px;">
<div class="post error_div" align="center">
<h1 style="font-weight: bold;"><img src="../imgs/main_icons/1f915.png" style="width: 80px;height: 80px;" /> <?php echo lang('profilePageNotFound_str1'); ?></h1>
<h3><?php echo lang('profilePageNotFound_str2'); ?></h3><br>
<a href="javascript:history.back()" class="error_page_btn"><?php echo lang('profilePageNotFound_str3'); ?></a>
</div></div>
<?php
}
?>
</div>
<!--=================================================footer==========================================================-->
<?php include("../includes/footer.php"); ?>
    <?php include "../includes/endJScodes.php"; ?>
	<script src="js/side.js"></script>
    </body>
</html>
