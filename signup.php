<?php
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
if(isset($_POST['post'])){
	print_r($_POST);
	$url = " https://www.google.com/recaptcha/api/siteverify";
	$data = [
	    //secret
	'secret' => "6LdPL-QUAAAAAKTj3nEJ1QTyy7nA5drQb1tD4UC4",
	'response' => $_POST['token'],
	//'remoteip' => $_SERVER['REMOTE_ADDR'],
	];
	$options = array(
	'http' => array(
	'header' => "content-type: application/x-www-form-urlencoded\r\n",
	'method' => 'POST',
	'content' => http_build_query($data)
	));

	$context = stream_context_create($options);
	$response = file_get_contents($url, false, $context);

	$res = json_decode($response, true);
	if($res['success'] == true){
		echo 'success.';
	}else{
		echo'try again';
	}
}
?>
<html dir="<? echo lang('html_dir'); ?>">
<head>
    <title><? echo lang('create_new_account'); ?> &bull; Fero</title>
    <meta charset="UTF-8">
    <meta name="description" content="-you can login or create an account on fero - edit, share, comment & like on images, videos, musics, topics & stories.">
    <meta name="keywords" content="fero, fero signup, fero signin, signup, fero account, فيرو, fero.com, feras, social media, feras shita, feras rida, f, fero sh, fero home, feroe">
    <meta name="author" content="feras shita">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <?php include "includes/head_imports_main.php";?>
	<script src="https://www.google.com/recaptcha/api.js?render=6LdPL-QUAAAAACi7OexD1_zqGg5jjojejCr08-kt"></script>
<style>
input {
  padding: 10px;
  width: 100%;
  font-size: 17px;
  font-family: Raleway;
  border: 1px solid #aaaaaa;
  border-radius: 4px;
}
select {
  padding: 10px;
  width: 100%;
  font-size: 17px;
  font-family: Raleway;
  border: 1px solid #aaaaaa;
  border-radius: 4px;
}
.next{
  background-color: #4CAF50;
  color: #ffffff;
  border: none;
  padding: 10px 20px;
  font-size: 17px;
  font-family: Raleway;
  cursor: pointer;
  border-radius:4px;
}
.nx{
	background-color: #4CAF50;
	float:right;
}
.pr{
	background-color: #bbbbbb;
	float:left;
}
.cr{
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbbbbb;
  border: none;
  border-radius: 50%;
  display: inline-block;
  opacity: 0.5;
}
.cro{
  height: 15px;
  width: 100px;
  margin: 0 2px;
  background-color: #bbbbbb;
  border: none;
  border-radius: 10px;
  display: inline-block;
  opacity: 0.5;
}
.ac{
	background-color: #4CAF50;
}
button:hover {
  opacity: 0.8;
}
.regForm {
  background-color: #ffffff;
  margin: 100px auto;
  font-family: Raleway;
  padding: 100px;
  width: 70%;
  min-width: 50%;
}
.arhi{
	background: #fff;
	border-radius: 3px;
	width: 70%;
	padding: 15px;
	margin: 15px;
	color: #7b7b7b;
}
@media screen and (max-width:600px){
  .regForm {
  padding: 70px;
  width: 100%;
  min-width: 100%;
  margin-top:1px;
}
.arhi{
	margin: 0;
	width: 100%;
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
    <body>
	<script>
	$(window).load(function(){
	$(".se-pre-con").fadeOut("slow");});
</script>
<div class="se-pre-con"><img class="iconsa" src="imgs/logo.ico" alt="logo"></div>
    <!--============[ Nav bar ]============-->

    <!--============[ main contains ]============-->
    <div align="center">
        <div class="regForm" style="text-align:<? echo lang('textAlign'); ?>">
        <!--============[ sign up sec ]============-->
            <h3 align="center"><? echo lang('create_new_account'); ?></h3>
			<div id="name">
            <p><input type="text" name="signup_fullname" class="lign" id="fn" placeholder="<? echo lang('fullname'); ?>..."/></p>
            <p><input type="text" name="signup_username" class="lign" id="un" placeholder="<? echo lang('username'); ?>..."/></p>
			  <div style="text-align:center;margin-top:40px;">
    <span class="cr ac"></span>
    <span class="cr"></span>
    <span class="cr"></span>
    <span class="cr"></span>
	<span class="cr"></span>
  </div>
    <button class="next nx" onclick="tabb()"><? echo lang('Next'); ?></button>
            </div>
			<div id="email" style="display:none">
			<p id="empr" style="display:none;"><input type="email" name="signup_email" style="max-width:80%;border-radius:4px 0 0 4px;" class="lign" id="em" placeholder="<? echo lang('email'); ?> (e.g: examble@email.com)"/><button onclick="myFunctionph()" style="max-width:20%;height:7.5%;border-radius:0 4px 4px 0;">phone</button></p>
			<p id="phpr"><input type="number" name="signup_phone" style="max-width:80%;border-radius:4px 0 0 4px;" class="lign" id="ph" placeholder="phone"/><button onclick="myFunctionem()" style="max-width:20%;height:7.5%;border-radius:0 4px 4px 0;">email</button></p>
			<p><? echo lang('email_policy'); ?></p>
						  <div style="text-align:center;margin-top:40px;">
    <span class="cr ac"></span>
    <span class="cr ac"></span>
    <span class="cr"></span>
    <span class="cr"></span>
	<span class="cr"></span>
  </div>
			    <button class="next pr" onclick="taba()"><? echo lang('Previous'); ?></button>
			    <button class="next nx" onclick="tabc()"><? echo lang('Next'); ?></button>
            </div>
			<div id="password" style="display:none">
			<p><input type="password" name="signup_password" class="lign" id="pd" placeholder="<? echo lang('password'); ?>..."/></p>
			<p><span id="passa" class="cro"></span><span id="passb" class="cro"></span><span id="passc" class="cro"></span></p>
            <p><input type="password" name="signup_cpassword" class="lign" id="cpd" placeholder="<? echo lang('confirm_password'); ?>..."/></p>
             			  <div style="text-align:center;margin-top:40px;">
    <span class="cr ac"></span>
    <span class="cr ac"></span>
    <span class="cr ac"></span>
    <span class="cr"></span>
	<span class="cr"></span>
  </div>
			 <button class="next pr" onclick="tabb()"><? echo lang('Previous'); ?></button>
             <button class="next nx" onclick="tabd()"><? echo lang('Next'); ?></button>
			</div>
			<div id="gender" style="display:none">
			<p>
            <select class="lign" name="gender" id="gr">
              <option selected><? echo lang('male'); ?></option>
              <option><? echo lang('female'); ?></option>
            </select>
            </p><p id="login_wait" style="margin: 0px;"></p>
						  <div style="text-align:center;margin-top:40px;">
    <span class="cr ac"></span>
    <span class="cr ac"></span>
    <span class="cr ac"></span>
    <span class="cr ac"></span>
	<span class="cr"></span>
  </div>
            <p style="font-size: 11px;color: #5d5d5d;margin: 8px 0px; ">
                <? echo lang('by_clicking_signup_str'); ?> <a href="policy.html"><? echo lang('terms'); ?></a>, <a href="policy.html"><? echo lang('privacyPolicy'); ?></a> <? echo lang('and'); ?> <a href="policy.html#cookies"><? echo lang('cookie_use'); ?></a>.</p>
            <button class="next pr" onclick="tabc()"><? echo lang('Previous'); ?></button>
			<button type="submit" class="Next nx" name="post" id="signupFunCode"><? echo lang('Send'); ?></button>
			</div>

        </div>
		<input type="hidden" id="token" name="token">
        <!--============[ login sec ]============-->
        <div class="arhi" align="center">
            <? echo lang('already_have_an_account'); ?> <a href="login"><? echo lang('login_now'); ?></a>.<hr style="margin: 8px;">
                <a href="?lang=english">English</a> &bull; <a href="?lang=العربية">العربية</a>
        </div>
    </div>

<script type="text/javascript">
function signupUser(){
var fullname = document.getElementById("fn").value;
var username = document.getElementById("un").value;
var emailAdd = document.getElementById("em").value;
var phone = document.getElementById("ph").value;
var password = document.getElementById("pd").value;
var cpassword = document.getElementById("cpd").value;
var gender = document.getElementById("gr").value;
$.ajax({
type:'POST',
url:'includes/login_signup_codes.php',
data:{'req':'signup_code','fn':fullname,'un':username,'ph':phone,'em':emailAdd,'pd':password,'cpd':cpassword,'gr':gender},
beforeSend:function(){
$('.login_signup_btn2').hide();
$('#login_wait').html("<b><? echo lang('creating_your_account'); ?></b>");
},
success:function(data){
$('#login_wait').html(data);
if (data == "Done..") {
    $('#login_wait').html("<p class='alertGreen'><? echo lang('done'); ?>..</p>");
    setTimeout(' window.location.href = "freindsresearch"; ',2000);
}else{
    $('.login_signup_btn2').show();
}
},
error:function(err){
alert(err);
}
});
}
$('#signupFunCode').click(function(){
signupUser();
});

$(".lign").keypress( function (e) {
    if (e.keyCode == 13) {
        signupUser();
    }
});
</script>
<script>
function myFunctionem() {
	$('#phpr').hide();
	$('#empr').show();
}
function myFunctionph() {
	$('#empr').hide();
	$('#phpr').show();
}
</script>
<script>
function taba(){
	//name
	    $('#name').show();
        $('#password').hide();
		$('#email').hide();
        $('#gender').hide();
}
function tabb(){
	//email
	var una = $('#un').val();
if($('#un').val() == '' && $('#fn').val() == ''){
	    $('#name').show();
        $('#password').hide();
		$('#email').hide();
        $('#gender').hide();
		$('#fn').css({'background-color':'#fddddd'});
		$('#un').css({'background-color':'#fddddd'});
	}else if($('#un').val() == ''){
		$('#name').show();
        $('#password').hide();
		$('#email').hide();
        $('#gender').hide();
		$('#un').css({'background-color':'#fddddd'});
		}else if($('#fn').val() == ''){
	    $('#name').show();
        $('#password').hide();
		$('#email').hide();
        $('#gender').hide();
		$('#fn').css({'background-color':'#fddddd'});
	}else if(validun(una)){
	    $('#name').show();
        $('#password').hide();
		$('#email').hide();
        $('#gender').hide();
		$('#un').css({'background-color':'#fddddd'});
	}else{
	    $('#name').hide();
        $('#password').hide();
        $('#email').show();
        $('#gender').hide();
}
}
function tabc(){
	var email = $('#em').val();
if(!validema(email) && $('#ph').val() == ''){
		$('#name').hide();
        $('#password').hide();
		$('#email').show();
        $('#gender').hide();
		$('#em').css({'background-color':'#fddddd'});
	}
	else{
	//password
	    $('#name').hide();
        $('#password').show();
		$('#email').hide();
        $('#gender').hide();
}}
function tabd(){
	var pass = $('#pd').val();
	if($('#pd').val() == ''){
	    $('#name').hide();
        $('#password').show();
		$('#email').hide();
        $('#gender').hide();
		$('#pd').css({'background-color':'#fddddd'});
		$('#cpd').css({'background-color':'#fddddd'});
	}else if(!validpass(pass)){
	$('#passa').css({'background-color':'#4CAF50'});
	$('#name').hide();
    $('#password').hide();
	$('#email').hide();
    $('#gender').show();
	}else if(!validpassb(pass)){
	$('#passb').css({'background-color':'#4CAF50'});
	$('#name').hide();
    $('#password').hide();
	$('#email').hide();
    $('#gender').show();
	}else if(!validpassc(pass)){
	$('#passc').css({'background-color':'#4CAF50'});
	$('#name').hide();
    $('#password').hide();
	$('#email').hide();
    $('#gender').show();
	}else if($('#pd').val() == $('#cpd').val()){
	$('#name').hide();
    $('#password').hide();
	$('#email').hide();
    $('#gender').show();
	}
}
function validema(email){
	var emailreh = /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i;
	return emailreh.test(email);
}
function validpass(pass){
	var passreh = /[a-zA-Z0-9]/;
	return passreh.test(pass);
}
function validpassb(pass){
	var passreh = /[\'^£$%&*()}{@#~?><>,.|=+¬-]/;
	return passreh.test(pass);
}
function validpassc(pass){
	var passreh = /{8-20}/;
	return passreh.test(pass);
}
function validun(una){
	var unreh = /[\'^£$%&*()}{@#~?><>,.|=+¬-]/;
	return unreh.test(una);
}

</script>
    </body>
	<script>
grecaptcha.ready(function() {
    grecaptcha.execute('6LdPL-QUAAAAACi7OexD1_zqGg5jjojejCr08-kt', {action: 'homepage'}).then(function(token) {
       console.log(token);
	   document.getElementById("token").value = token;
    });
});
</script>
</html>
