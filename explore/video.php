<html>
<head>
<title>
Fero &bull; explore
</title>
<style>
.eximg {
 width: 22%;
 height: 35%;
 min-width: 22%;
 min-height: 35%;
padding: 3px;
 border-radius: 10px;
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
@media screen and (max-width:700px){
.eximg {
 width: 32%;
 height: 30%;
 min-width: 32%;
 min-height: 30%;
}}
.leb{
    background: linear-gradient(320deg,#8910d6,#b52d94);
    padding: 8px 32px;
    color: #fff;
    text-decoration: none;
    outline: none;
    border:none;
    border-radius: 3px;
    box-shadow: 0px 0px 16px rgba(0, 0, 0, 0.0);
    transition: box-shadow 0.3s;
}
.leb:hover,.login_signup_btn2:focus{
    color: #fff;
    text-decoration: none;
    box-shadow: 0px 3px 16px rgba(0, 0, 0, 0.53);
@media screen and (max-width:700px){
.leb {
font-size: 10px;
width: 20%;
}}
</style>
    <?php include "../includes/head_imports_main.php"; ?>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link href="../css/img_s.css" rel="stylesheet">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awsome.min.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jguery/2.2.4/jquery.min.js"></script>
<?php session_start(); ?>
</head>
<body>
<script>
	$(window).load(function(){
	$(".se-pre-con").fadeOut("slow");});
</script>
<div class="se-pre-con"><img class="iconsa" src="../imgs/logo.ico" alt="logo"></div>
<?php
include("../config/connect.php");
include ("../includes/time_function.php");
 include "../includes/dievo.php"; ?>
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
<br>
<br>
<div style="overflow-x:scroll;white-space:nowrap;">
<a href="index"><label class="leb"><?php echo lang('images'); ?></label></a>
<a href="shop"><label class="leb"><?php echo lang('shop'); ?></label></a>
<a href="book"><label class="leb"><?php echo lang('Books'); ?></label></a>
<a href="video"><label class="leb"><?php echo lang('videos'); ?></label></a>
<a href="music"><label class="leb"><?php echo lang('musics'); ?></label></a>
<a href="movie"><label class="leb"><?php echo lang('Movies'); ?></label></a>
</div>
<br>
<div id="getSearchResulto">
<?php

include("../includes/fetch_users_info.php");

include ("../includes/num_k_m_count.php");
$s_id = $_SESSION['id'];
$check_path = filter_var(htmlspecialchars($_POST['path']),FILTER_SANITIZE_STRING);
$plimit = filter_var(htmlspecialchars($_POST['plimit']),FILTER_SANITIZE_NUMBER_INT);
$p_privacy = "2";
$vpsql = "SELECT * FROM wpost WHERE p_privacy = 0";
$view_posts = $conn->prepare($vpsql);
$view_posts->bindValue(':s_id', $s_id, PDO::PARAM_INT);
$view_posts->bindValue(':p_privacy', $p_privacy, PDO::PARAM_INT);
$view_posts->bindValue(':plimit', (int)trim($plimit), PDO::PARAM_INT);
$view_posts->execute();

$view_postsNum = $view_posts->rowCount();
if ($view_postsNum > 0) {

while ($postsfetch = $view_posts->fetch(PDO::FETCH_ASSOC)) {
$get_post_id = $postsfetch['post_id'];
$get_author_id = $postsfetch['author_id'];
$get_post_author = $postsfetch['post_author'];
$get_post_author_photo = $postsfetch['post_author_photo'];
$get_post_img = $postsfetch['post_img'];
$get_post_time = $postsfetch['post_time'];
$get_post_content = $postsfetch['post_content'];
$session_userphoto_path = $check_path."imgs/user_imgs/";
$session_userphoto = $session_userphoto_path . $_SESSION['Userphoto'];
$timeago = time_ago($get_post_time);
$get_post_title = $postsfetch['p_title'];
$img_sty = $postsfetch['img_sty'];
$get_post_privacy = $postsfetch['p_privacy'];
$get_post_shared = $postsfetch['shared'];


$imgs_path = $check_path."imgs/";
$em_img_path = $imgs_path."emoticons/";
if (is_file("config/connect.php")) {
    $includePath = "includes/";
}elseif (is_file("../config/connect.php")) {
    $includePath = "../includes/";
}elseif (is_file("config/connect.php")) {
    $includePath = "../../includes/";
}


//shared posts///////////////////////////////////////////////////////////////////////////////
echo "<div style='display: inline;'><a href='../".$check_path."posts/post?pid=".$get_post_id."' class=\"username_OF_postLink\">";
        if (!empty($get_post_img)) {
			if(preg_match("/.(mp4|ogg|webm)$/i", $get_post_img/*importent!!!*/)){
        echo "<video autoplay align='center' style='object-fit:cover;' class='eximg $img_sty' id='lightboxImg_$get_post_id' src=\"../".$imgs_path."$get_post_img\">$query_fetch_fullname</video>";
		}
		}
		echo "</a></div>";
}

}else{
	echo "0";
}

?>
<br><br>
</div>
</body>
</html>
