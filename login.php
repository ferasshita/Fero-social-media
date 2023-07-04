﻿<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();
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
    <title>Fero</title>
    <meta charset="UTF-8">
    <meta name="description" content="-you can login or create an account on fero- edit, share, comment & like on images, videos, musics, topics, books, movies & stories. You can also find an information about coronaviruse.">
    <meta name="keywords" content="fero, fero account,فيرو, fero.com, coronaviruse, covid-19, feras,social media,feras shita,feras rida,f,fero sh, fero home,feroe">
	<meta name="author" content="feras shita">
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta charset="UTF-8">
<meta http-equiv="refresh" content="10000">
<meta name="theme-color" content="#000000">
<meta name="msapplication-navbutton-color" content="#000000">
<meta name="apple-mobile-web-app-status-bar-style" content="#000000">
<link href="face.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <?php include "includes/head_imports_main.php";?>
<style>
	#pc{
	background-color:#00CCFF;
	text-align: center;
	width: 50%;
	color: #FFFFFF;
    padding: 12px 20px;
    margin: 8px 0;
	font-size: 17px;
	font-family: Raleway;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
	}
@media screen and (max-width:600px){
    #pc{
width: 80%;
}}
@media screen and (max-width:600px){
    .bt{
width: 80%;
}}
@media screen and (max-width:600px){
    .pt{
width: 80%;
}}
.logbox {
	background: #FFFFFF;
	width: 1300px;
	height: 500px;
}
@media screen and (max-width:600px){
.dim{
display:none;	
}}
.pv{
    padding: 12px 20px;
	font-size: 17px;
	font-family: Raleway;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
	width:46.5%;
	margin-left:40px;
}
@media screen and (max-width:600px){
.pv{
	width:65%;
	margin-left:25px;
}}
@media screen and (max-width:600px){
    .te{
        display:none;
    }
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
</style>
</head>
    <body class="login_signup_body">
	<script>
	$(window).load(function(){
	$(".se-pre-con").fadeOut("slow");});		
</script>
<div class="se-pre-con"><img class="iconsa" src="imgs/logo.ico" alt="logo"></div>
<a href="about"><div class="w3-top w3-bar w3-large" title="swipe..." style="background: linear-gradient(320deg,red,#b52d94);border:purple;color:white;text-align:center;">swipe to know more about fero<i class="fa fa-arrow-down"></i></div></a><br>
		   <div align="center">
        <div style="text-align:<? echo lang('textAlign'); ?>">
<h1 class="fac" title="Fero">Fero</h1>
        <!--============[ main contains ]============-->
            <div style="text-align:<? echo lang('textAlign'); ?>">
                <p align="center"><input type="text" name="login_username" id="un" class="pt" title="email or username" placeholder="<? echo lang('email_or_username'); ?>..."/></p>
                <p align="center"><input type="password" name="login_password" id="pd" style="display:inline;border-right:none;" title="password" class="pv" placeholder="<? echo lang('password'); ?>..."/><button onclick="myFunction()" id="bp" style="display:inline;background:white;height:50px;border-radius:4px;margin-<? echo lang('w_post_li2'); ?>:40px;border:solid thin grey;border-left:none;"><? echo lang('show'); ?></button></p>
                <div style="text-align:center;"><a href=""><? echo lang('forgot_password'); ?></a> &bull; <label for="spl" title="Click to show password"><? echo lang('show_password'); ?> </label>
				<input type="checkbox" id="spl" onclick="myFunction()" style="display: none;">
				</div>
                 <p align="center"><button type="submit" name="ct" class="bt" id="loginFunCode"><p class="btt"><? echo lang('login'); ?></p><p align="center" id="login_waiti" style="margin: 0px;"></p></button></p>

            </div>

<h3 class="te">Or</h3>
<p align="center">
<a href="signup" target="_self" title="if you don't have an account"><button id="pc" class="btn"><? echo lang('create_new_account'); ?></button></a>
</p>
</div>
</div>
<br>
<br>

            <div class="w3-bottom" style="background: #fff; border-radius: 3px;  padding: 15px; margin:auto;margin-top: 15px;color: #7b7b7b; width: 100%;" align="center">
               <? echo lang('dont_have_an_account'); ?> <a href="signup"><? echo lang('signup'); ?></a> <? echo lang('for_free'); ?>.<hr style="margin: 8px;">
                <a href="?lang=english">English</a> &bull; <a href="?lang=العربية">العربية</a><br>
            </div>

<script>
function myFunction() {
  var x = document.getElementById("pd");
  var y = document.getElementById("bp");
  if (x.type === "password") {
    x.type = "text";
    y.innerHTML = "<? echo lang('hide'); ?>";
  } else {
    x.type = "password";
	y.innerHTML = "<? echo lang('show'); ?>";
  }
}
</script>
<script type="text/javascript">
function loginUser(){
var username = document.getElementById("un").value;
var password = document.getElementById("pd").value;
$.ajax({
type:'POST',
url:'includes/login_signup_codes.php',
data:{'req':'login_code','un':username,'pd':password},
beforeSend:function(){
$('.btt').hide();
$('#login_waiti').html("<span class='fa fa-spinner fa-pulse fa-fw'></span>");
},
success:function(data){
$('#login_waiti').html(data);
if (data == "Welcome...") {
    $('#login_wait').html("<span class='fa fa-refresh fa-fw fa-spin'></span>");
    setTimeout(' window.location.href = "home"; ',2000);
}
},
error:function(err){
alert(err);
}
});
}
$('#loginFunCode').click(function(){
loginUser();
});
$(".pt").keypress( function (e) {
    if (e.keyCode == 13) {
        ('#pd').focus();
    }
});
$(".pv").keypress( function (e) {
    if (e.keyCode == 13) {
        loginUser();
    }
});
</script>
</body>
</html>
