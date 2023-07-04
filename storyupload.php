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
    <title>Story upload &bull; Fero</title>
    <meta charset="UTF-8">
    <meta name="author" content="feras shita">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel='shortcut icon' type='image/x-icon' href='imgs/logo.ico' />
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awsome.min.css" rel="stylesheet">
<link href="css/tex.css" rel="stylesheet">
<link href="css/img_s.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jguery/2.2.4/jquery.min.js"></script>
    <?php include "includes/head_imports_main.php"; ?>
	<style>
	.img-bri:hover{
		    color: #fff;
    text-decoration: none;
    box-shadow: 0px 3px 16px rgba(0, 0, 0, 0.53);
	}
	.cod{
	background: linear-gradient(500deg,#8910d6,#b52d94);
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
<body onload="fetchPosts_DB('home');" class="w3-light-grey">
<script>
	$(window).load(function(){
	$(".se-pre-con").fadeOut("slow");});		
</script>
<div class="se-pre-con"><img class="iconsa" src="imgs/logo.ico" alt="logo"></div>
<div class="w3-bar w3-top w3-black w3-large" style="z-index:4">
  <button id="men" style="display:none" class="w3-bar-item w3-<?php echo lang('w_post_align'); ?> w3-button w3-hide-large w3-hover-none w3-hover-text-light-grey" onClick="w3_open();"><i class="fa fa-bars"></i> Menu</button>
  <span class="w3-bar-item w3-<?php echo lang('w_post_li2'); ?>">fero</span>
</div>
<form id="postingToDB" action="<?php echo $check_path; ?>includes/wstory.php" method="post" enctype="multipart/form-data" style="margin: 0;">
<!-- Sidebar/menu -->
<div class="w3-bottom">
<div style="text-align: left;" class="w3-bar w3-white w3-large">
<a href="u/<?php echo $_SESSION['Username']; ?>" class="w3-bar-item w3-button" target="_self" title="profile"><i class="fa fa-user"></i></a>
<a href="search" class="w3-bar-item w3-button" target="_self" title="search"><i class="fa fa-search"></i></a>
<a href="post" class="w3-bar-item w3-button" target="_self" title="add an image"><i class="fa fa-upload"></i></a>
<a href="explore" class="w3-bar-item w3-button" target="_self" title="explore"><i class="fa fa-compass"></i></a>
<a href="home" class="w3-bar-item w3-button" target="_self" title="home"><i class="fa fa-home"></i></a>
</div>
</div>

				<div class="write_post">
                <?php echo $err_success_Msg; ?>
                    <?php include("includes/w_story_form.php"); ?>
                </div>
				</div>
				<script>
	 var q = document.getElementById("text");
function oef() {
  var body = document.getElementById("text");
  var currentClass = body.className;
  body.className = currentClass == "oe" ? "oe" : "oe";
}
function dff() {
  var body = document.getElementById("text");
  var currentClass = body.className;
  body.className = currentClass == "gjh" ? "ghg" : "ghg";
}
function arf() {
  var body = document.getElementById("text");
  var currentClass = body.className;
  body.className = currentClass == "ar" ? "ar" : "ar";
}
function bsf() {
  var body = document.getElementById("text");
  var currentClass = body.className;
  body.className = currentClass == "bs" ? "bs" : "bs";
}
function shf() {
  var body = document.getElementById("text");
  var currentClass = body.className;
  body.className = currentClass == "sh" ? "sh" : "sh";
}
function brf() {
  var body = document.getElementById("text");
  var currentClass = body.className;
  body.className = currentClass == "per" ? "per" : "per";
}
function monf() {
  var body = document.getElementById("text");
  var currentClass = body.className;
  body.className = currentClass == "mon" ? "mon" : "mon";
}
function nrf() {
  var body = document.getElementById("text");
  var currentClass = body.className;
  body.className = currentClass == "nr" ? "nr" : "nr";
}
function gf() {
  var body = document.getElementById("text");
  var currentClass = body.className;
  body.className = currentClass == "g" ? "g" : "g";
}
function vf() {
  var body = document.getElementById("text");
  var currentClass = body.className;
  body.className = currentClass == "v" ? "v" : "v";
}
function ssf() {
  var body = document.getElementById("text");
  var currentClass = body.className;
  body.className = currentClass == "ss" ? "ss" : "ss";
}
function ncf() {
  var body = document.getElementById("text");
  var currentClass = body.className;
  body.className = currentClass == "nc" ? "nc" : "nc";
}
function cnf() {
  var body = document.getElementById("text");
  var currentClass = body.className;
  body.className = currentClass == "cn" ? "cn" : "cn";
}
function tbtf() {
  var body = document.getElementById("text");
  var currentClass = body.className;
  body.className = currentClass == "nr w3-light-gery" ? "nr" : "nr w3-light-grey";
}
//color
function whf() {
  var body = document.getElementById("text");
  var currentClass = body.className;
  body.className = currentClass == "w3-white" ? "w3-white" : "w3-white";
}
function blf() {
  var body = document.getElementById("text");
  var currentClass = body.className;
  body.className = currentClass == "w3-black" ? "w3-black" : "w3-black";
}
function grf() {
  var body = document.getElementById("text");
  var currentClass = body.className;
  body.className = currentClass == "w3-gray" ? "w3-grey" : "w3-gray";
}
function ref() {
  var body = document.getElementById("text");
  var currentClass = body.className;
  body.className = currentClass == "w3-red" ? "w3-red" : "w3-red";
}
function bluf() {
  var body = document.getElementById("text");
  var currentClass = body.className;
  body.className = currentClass == "w3-blue" ? "w3-blue" : "w3-blue";
}
function lbf() {
  var body = document.getElementById("text");
  var currentClass = body.className;
  body.className = currentClass == "w3-light-blue" ? "w3-light-blue" : "w3-light-blue";
}
function gref() {
  var body = document.getElementById("text");
  var currentClass = body.className;
  body.className = currentClass == "w3-green" ? "w3-green" : "w3-green";
}
function yaf() {
  var body = document.getElementById("text");
  var currentClass = body.className;
  body.className = currentClass == "w3-yellow" ? "w3-yellow" : "w3-yellow";
}
function orf() {
  var body = document.getElementById("text");
  var currentClass = body.className;
  body.className = currentClass == "w3-orange" ? "w3-orange" : "w3-orange";
}
function vif() {
  var body = document.getElementById("text");
  var currentClass = body.className;
  body.className = currentClass == "w3-purple" ? "w3-purple" : "w3-purple";
}
function pif() {
  var body = document.getElementById("text");
  var currentClass = body.className;
  body.className = currentClass == "w3-pink" ? "w3-pink" : "w3-pink";
}
function cof() {
  var body = document.getElementById("text");
  var currentClass = body.className;
  body.className = currentClass == "cod" ? "cod" : "cod";
}
</script>
<script>
var openInbox = document.getElementById("myBtn");
openInbox.click()

function myFunc(id) {
  var x = document.getElementById(id);
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show"; 
    x.previousElementSibling.className += " w3-red";
  } else { 
    x.className = x.className.replace(" w3-show", "");
	x.previousElementSibling.className = 
    x.previousElementSibling.className.replace(" w3-red", "");
  }
}
</script>
<script>
$(document).ready(function() {
    setInterval(timestamp, 1000);
});

function timestamp() {
    $.ajax({
        url: 'http://localhost/timestamp.php',
        success: function(data) {
            $('#timestamp').html(data);
        },
    });
}
</script>

</body>
</html>