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
    <title>Story &bull; Fero</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awsome.min.css" rel="stylesheet">
<link href="tex.css" rel="stylesheet">
<link href="css/img_s.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jguery/2.2.4/jquery.min.js"></script>
<script src="https://kit.fontawesome.com/a076d05399.js">
</script>
<style>
html {
scoll-behave: smooth;
}
.container {
  position: relative;
  text-align: center;
  color: white;
}
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
</style>
    <?php include "includes/head_imports_main.php"; ?>
</head>
<body onLoad="fetchPosts_DB('home');" class="w3-light-grey">
<script>
	$(window).load(function(){
	$(".se-pre-con").fadeOut("slow");});		
</script>
<div class="se-pre-con"><img class="iconsa" src="imgs/logo.ico" alt="logo"></div>
<!--=============================[ NavBar ]========================================-->
		<!-- Top container -->
<div class="w3-bar w3-top w3-black w3-large" style="z-index:4">
  <button class="w3-bar-item w3-<?php echo lang('w_post_align'); ?> w3-button w3-hide-large w3-hover-none w3-hover-text-light-grey" onClick="w3_open();"><i class="fa fa-bars"></i> <?php echo lang('Menu'); ?></button>
  <span class="w3-bar-item w3-<?php echo lang('w_post_li2'); ?>">fero<!-- i can add any thing here --></span>
</div>
<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-collapse w3-overflow-x w3-white w3-animate-<?php echo lang('w_post_align'); ?>" style="z-index:3;width:300px;" id="mySidebar"><br>
  <div class="w3-container w3-row"><br>
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
    <p><a href="#" class="<? echo lang('sid'); ?> w3-button w3-padding-16 w3-hide-large w3-dark-grey w3-hover-black" onClick="w3_close()" title="close menu"><i class="fa fa-remove fa-fw"></i> <?php echo lang('Close_Menu'); ?></a></p>
	<p><a href="storyupload" target="_self" id="ma" class="<? echo lang('sid'); ?> w3-button" title="Upload posts"><b style="font-size:15px">+</b> <?php echo lang('Upload_some_stories'); ?></a></p>
	<p><a href="answer" target="_self" id="ma" class="<? echo lang('sid'); ?> w3-button" title="Upload posts"><b style="font-size:15px">?</b> <?php echo lang('Answer_questions'); ?></a></p>
	<p><a href="savedstories" target="_self" id="ma" class="<? echo lang('sid'); ?> w3-button" title="saved stories"><span class='fas fa-compact-disc'></span> <?php echo lang('Saved_stories'); ?></p>
	
  </div>
</nav>


<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onClick="w3_close()" style="cursor: pointer" title="close side menu" id="myOverlay"></div>
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->


	<!-- navbar end -->
<div class="w3-main" align="<?php echo lang('w_post_align'); ?>" style="margin-<?php echo lang('w_post_align'); ?>:300px;margin-top:43px;text-align:<?php echo lang('w_post_align'); ?>;direction: <?php echo lang('w_post_dir'); ?>">
<div class="w3-bottom">
<div style="text-align: left;" class="w3-bar w3-white w3-large">
<a href="search" class="w3-bar-item w3-button" style='color:orange' target="_self" title="search"><i class="fa fa-star"></i></a>
<a href="u/<?php echo $_SESSION['Username']; ?>" class="w3-bar-item w3-button" target="_self" title="profile"><i class="fa fa-user"></i></a>
<a href="story" class="w3-bar-item w3-button" target="_self" title="search"><i class="fa fa-search"></i></a>
<a href="post" class="w3-bar-item w3-button" target="_self" title="add an image"><i class="fa fa-upload"></i></a>
<a href="explore" class="w3-bar-item w3-button" target="_self" title="explore"><i class="fa fa-compass"></i></a>
<a href="home" class="w3-bar-item w3-button" target="_self" title="home"><i class="fa fa-home"></i></a>
        
</div>
</div>
<br>
				<a href='storyupload' class="username_OF_postLink"><div class='storydiv' style='background: url(imgs/user_covers/<?php echo $_SESSION['uCoverPhoto']; ?>) no-repeat center center; background-size: cover;'><img src="<?php echo 'imgs/user_imgs/'.$_SESSION['Userphoto']; ?>" style='border-radius:50%; width:10%;height:10%;border:solid thin grey;'> <strong><?php echo "<a style='color: #000000'>".$_SESSION['Fullname']."</a>"; if ($_SESSION['verify'] == "1"){echo $verifyUser;} ?></strong>
				<p align='center' style='font-size:100px;'><a href='storyupload' style='color:black;'>+</a></p></div></a>
				<?php
$s_id = $_SESSION['id'];
$check_path = filter_var(htmlspecialchars($_POST['path']),FILTER_SANITIZE_STRING);
$plimit = filter_var(htmlspecialchars($_POST['plimit']),FILTER_SANITIZE_NUMBER_INT);
$p_privacy = "2";
$vpsql = "SELECT * FROM story WHERE author_id IN 
(SELECT uf_two FROM follow WHERE uf_one=:s_id) OR author_id=:s_id ORDER BY story_time";
$view_posts = $conn->prepare($vpsql);
$view_posts->bindValue(':s_id', $s_id, PDO::PARAM_INT);
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
$img_sty = $postsfetch['img_sty'];

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
	$delete_post_sql = "DELETE FROM comments WHERE c_post_id= :story_id";
	$delete_post = $conn->prepare($delete_post_sql);
	$delete_post->bindParam(':story_id',$story_id,PDO::PARAM_INT);
	$delete_post->execute();
	$delete_post_sql = "DELETE FROM likes WHERE post_id= :story_id";
	$delete_post = $conn->prepare($delete_post_sql);
	$delete_post->bindParam(':story_id',$story_id,PDO::PARAM_INT);
	$delete_post->execute();
	$delete_post_sql = "DELETE FROM answ_ques WHERE story_id= :story_id";
	$delete_post = $conn->prepare($delete_post_sql);
	$delete_post->bindParam(':story_id',$story_id,PDO::PARAM_INT);
	$delete_post->execute();
    }else{
//////////////////////////////
	echo"<div class='storydiv $color $img_sty' style='";if($story_img){if(preg_match("/.(png|jpeg|jpg)$/i", $story_img/*importent!!!*/)){echo"background: url(imgs/$story_img) no-repeat center center; background-size: cover;";}}elseif($color){if($color == "cod"){echo"background: linear-gradient(500deg,#8910d6,#b52d94);";}else{echo"";}}else{echo"background: linear-gradient(500deg,#8910d6,#b52d94);";}echo"'><img src=' imgs/user_imgs/$query_fetch_userphoto' style='border-radius:50%; width:10%;height:10%;border:solid thin grey;'> <a href='u/$query_fetch_username'><strong style='color:black;'>$query_fetch_username";if ($query_fetch_verify == "1"){echo $verifyUser;}echo"</strong></a>
	<a href='".$check_path."posts/post?pid=".$get_post_id."' style='float:right' class='username_OF_postTime'><b>$story_time_get</b></a>
				<p align='center' class='pst'><a href='posts/storywatch?pid=$story_id' style='color:black;'>";if($p_write){echo"<p align='center' style='font-size:30px;'>$p_write<p>";}else{echo"<span class='fa fa-film'></span>";}echo"</a></p></div>";
}}}
?>
		</div>
<!--====================================[ end Center col2 ]============================================-->
<?php include "includes/endJScodes.php"; ?>
<script src="js/side.js"></script>
</body>
</html>
