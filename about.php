<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();
include("config/connect.php");
if(isset($_SESSION['Username'])){
    header("location: home");
}
$getLang = trim(filter_var(htmlentities($_GET['lang']),FILTER_SANITIZE_STRING));
if (!empty($getLang)) {
$_SESSION['language'] = $getLang;
}
// ========================= config the languages ================================
error_reporting(E_NOTICE ^ E_ALL);
if (is_file('home.php')){
    $path = "";
}elseif (is_file('../home.php')){
    $path =  "../";
}elseif (is_file('../../home.php')){
    $path =  "../../";
}
include_once $path."langs/set_lang.php";
?>
<html dir="<? echo lang('html_dir'); ?>">
<head>
    <title>about &bull; Fero</title>
    <meta charset="UTF-8">
    <meta name="description" content="-you can login or create an account on fero- edit, share, comment & like on images, videos, musics, topics & stories.">
    <meta name="keywords" content="fero, fero account,فيرو, fero.com,feras,social media,feras shita,feras rida,f,fero sh, fero home,feroe">
	<meta name="author" content="feras shita">
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta charset="UTF-8">
<meta http-equiv="refresh" content="10000">
<meta name="theme-color" content="#000000">
<meta name="msapplication-navbutton-color" content="#000000">
<meta name="apple-mobile-web-app-status-bar-style" content="#000000">
<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awsome.min.css" rel="stylesheet">
    <?php include "includes/head_imports_main.php";?>
<style>
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
    <body class="login_signup_body">
<script>
	$(window).load(function(){
	$(".se-pre-con").fadeOut("slow");});		
</script>
<div class="se-pre-con"><img class="iconsa" src="imgs/logo.ico" alt="logo"></div>
<h1 align="center">Welcome to fero</h1>
<p style="margin:50px;font-size:25px;">You can <a href="login">login</a> or <a href="signup">create an account</a> on fero, you can share ,edit comment & like on images, videos, musics, topics, novels, movies, books, jornals, pdfs etc... </p>
<p style="margin:50px;font-size:25px;">Fero is a social media website, where the users can share there information and ideas with there friends.</p>
<p style="margin:50px;font-size:25px;">On fero you can get a job, make a job or find a job.</p>
<p style="margin:50px;font-size:25px;">On fero you can find the lastest information about Corona virus.</p>
<h1 align="center">Our next update</h1>
<p style="margin:50px;font-size:25px;">
<?php
$newsab_sql = "SELECT newsab_fi FROM news_ab";
$newsab_q = $conn->prepare($newsab_sql);
$newsab_q->execute();
while ($postsfetch = $newsab_q->fetch(PDO::FETCH_ASSOC)) {
	$newsab_fi_di = $postsfetch['newsab_fi'];
}
echo "$newsab_fi_di";
 ?></p>
</body>
</html>
