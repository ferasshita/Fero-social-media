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
    <title>Upload &bull; Fero</title>
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

	</style>
</head>
<body onload="fetchPosts_DB('home');" class="w3-light-grey">
<div class="w3-bar w3-top w3-black w3-large" style="z-index:4">
  <button id="men" style="display:none" class="w3-bar-item w3-<?php echo lang('w_post_align'); ?> w3-button w3-hide-large w3-hover-none w3-hover-text-light-grey" onClick="w3_open();"><i class="fa fa-bars"></i> Menu</button>
  <span class="w3-bar-item w3-<?php echo lang('w_post_li2'); ?>">fero</span>
</div>
<form id="postingToDB" action="<?php echo $check_path; ?>includes/wpost.php" method="post" enctype="multipart/form-data" style="margin: 0;">
<!-- Sidebar/menu -->
<div style="display: none;" id="w_nav_text">
<nav class="w3-sidebar w3-collapse w3-white w3-animate-<?php echo lang('w_post_align'); ?>" style="z-index:3;width:300px;" id="mySidebar"><br>
  <div class="w3-container">
    <h5><?php echo lang('dashboard'); ?></h5>
  </div>
  <div class="w3-bar-block">
				<a id="myBtn" onClick="myFunc('Demo3')" href="javascript:void(0)" class="<? echo lang('sid'); ?> w3-button"><i class="fa fa-image"></i> <?php echo lang('Chose_the_background_color'); ?></a><br>
	<div id="Demo3" class="w3-hide w3-animate-left w3-light-grey w3-show">
<p><label for="wh"><a id="1" onClick="whf()" class="w3-bar-item w3-button"><input style="width:23px" type="color" id="co" class="co" value="#FFFFFF" disabled>white</a></p><input type="radio" name="color" style="display:none" value="w3-white" id="wh" checked></label>
<p><label for="bl"><a id="2" onClick="blf()" class="w3-bar-item w3-button"><input style="width:23px" type="color" id="co" class="co" value="#000000" disabled>black</a></p><input type="radio" name="color" style="display:none" value="w3-black" id="bl"></label>
<p><label for="gr"><a id="3" onClick="grf()" class="w3-bar-item w3-button"><input style="width:23px" type="color" id="co" class="co" value="#CCCCCC" disabled>grey</a></p><input type="radio" name="color" style="display:none" value="w3-grey" id="gr"></label>
<p><label for="re"><a id="4" onClick="ref()" class="w3-bar-item w3-button"><input style="width:23px" type="color" id="co" class="co" value="#FF0000" disabled>red</a></p><input type="radio" name="color" style="display:none" value="w3-red" id="re"></label>
<p><label for="blu"><a id="5" onClick="bluf()" class="w3-bar-item w3-button"><input style="width:23px" type="color" id="co" class="co" value="#0000FF" disabled>blue</a></p><input type="radio" name="color" style="display:none" value="w3-blue" id="blu"></label>
<p><label for="gr"><a id="6" onClick="gref()" class="w3-bar-item w3-button"><input style="width:23px" type="color" id="co" class="co" value="#00FF00" disabled>green</a></p><input type="radio" name="color" style="display:none" value="w3-green" id="gr"></label>
<p><label for="vi"><a id="7" onClick="vif()" class="w3-bar-item w3-button"><input style="width:23px" type="color" id="co" class="co" value="#9900FF" disabled>purple</a></p><input type="radio" name="color" style="display:none" value="w3-purple" id="vi"></label>
<p><label for="lb"><a id="8" onClick="lbf()" class="w3-bar-item w3-button"><input style="width:23px" type="color" id="co" class="co" value="#00FFFF" disabled>light blue</a></p><input type="radio" name="color" style="display:none" value="w3-light-blue" id="lb"></label>
<p><label for="pi"><a id="9" onClick="pif()" class="w3-bar-item w3-button"><input style="width:23px" type="color" id="co" class="co" value="#CC33CC" disabled>pink</a></p><input type="radio" name="color" style="display:none" value="w3-pink" id="pi"></label>
<p><label for="ya"><a id="10" onClick="yaf()" class="w3-bar-item w3-button"><input style="width:23px" type="color" id="co" class="co" value="#FFFF00" disabled>yellow</a></p><input type="radio" name="color" style="display:none" value="w3-yellow" id="ya"></label>
<p><label for="or"><a id="11" onClick="orf()" class="w3-bar-item w3-button"><input style="width:23px" type="color" id="co" class="co" value="#FFCC33" disabled>orange</a></p><input type="radio" name="color" style="display:none" value="w3-orange" id="or"></label>
<p><label for="col"><a id="12" onClick="cof()" class="w3-bar-item w3-button"><button style="width:15px;height:15px;background: linear-gradient(500deg,#8910d6,#b52d94);" id="co" class="co"></button> modern</a></p><input type="radio" name="color" style="display:none" value="cod" id="col"></label>
</div>
		<a id="myBtn" onClick="myFunc('Demo1')" href="javascript:void(0)" class="<? echo lang('sid'); ?> w3-button"><i class="fa fa-font"></i> <?php echo lang('Chose_the_font_type'); ?></a>
	<div id="Demo1" class="w3-hide w3-animate-left w3-light-grey w3-hide">
	<p><label for="df"><a id="0" onClick="dff()" class="w3-bar-item w3-button">defult</a></p><input type="radio" name="font" id="df" value="" style="display:none" checked></label>
<p><label for="ar"><a id="1" onClick="arf()" class="w3-bar-item w3-button" style="font-family:  Arial">Arial</a></p><input type="radio" name="font" style="display:none" id="ar" value="Arial"></label>
<p><label for="nr"><a id="2" onClick="nrf()" class="w3-bar-item w3-button" style="font-family: Times New Roman;">Times New Roman</a></p><input type="radio" style="display:none" name="font" id="nr" value=""></label>
<p><label for="cn"><a id="3" onClick="cnf()" class="w3-bar-item w3-button" style="font-family: Courier New;">Courier New</a></p><input type="radio" name="font" style="display:none" id="cn" value="Times New Roman"></label>
<p><label for="gf"><a id="4" onClick="gf()" class="w3-bar-item w3-button" style="font-family: Georgia;">Georgia</a></p><input type="radio" name="font" id="gf" style="display:none" value="Georgia"></label>
<p><label for="ve"><a id="5" onClick="vf()" class="w3-bar-item w3-button" style="font-family: Verdana;">Verdana</a></p><input type="radio" name="font" id="ve" style="display:none" value="Verdana"></label>
<p><label for="ss"><a id="6" onClick="ssf()" class="w3-bar-item w3-button" style="font-family: sans-serif;">sans-serif</a></p><input type="radio" name="font" style="display:none" id="ss" value="sans-serif"></label>
<p><label for="pe"><a id="7" onClick="brf()" class="w3-bar-item w3-button" style="font-family: Perpetua;">Perpetua</a></p><input type="radio" name="font" id="pe" style="display:none" value="Perpetua"></label>
<p><label for="sh"><a id="8" onClick="shf()" class="w3-bar-item w3-button" style="font-family: Showcard Gothic;">Showcard Gothic</a></p><input type="radio" id="sh" style="display:none" name="font" value="Showcard Gothic"></label>
<p><label for="br"><a id="9" onClick="bsf()" class="w3-bar-item w3-button" style="font-family: Brush Script MT;">Brush Script MT</a></p><input type="radio" id="br" style="display:none" name="font" value="Brush Script MT"></label>
<p><label for="mo"><a id="10" onClick="monf()" class="w3-bar-item w3-button" style="font-family: monospace;">monospace</a></p><input type="radio" name="font" id="mo" style="display:none" value="monospace"></label>
<p><label for="oe"><a id="11" onClick="oef()" class="w3-bar-item w3-button" style="font-family: old english text mt;">old english text mt</a></p><input type="radio" id="oe" style="display:none" name="font" value="old english text mt"></label>
</div>
		<label for="textimgi"><a id="myBtn" class="<? echo lang('sid'); ?> w3-button"><i class="fa fa-camera"></i> <?php echo lang('Chose_background_image'); ?></a></label><input accept="image/png, image/jpeg," style="display: none;" name="textimg" type="file" onchange="textimage(this)" id="textimgi">
	<div id="Demo1" class="w3-hide w3-animate-left w3-light-grey w3-hide">
	</div>
	<br>
	<br>
	<!-- settings -->
  </div>
</nav>

<div class="w3-overlay w3-hide-large w3-animate-opacity" onClick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>
</div>
<!-- !PAGE CONTENT! -->
<div class="w3-main" id="content" align="<?php echo lang('w_post_align'); ?>" style="margin-top:43px;text-align:<?php echo lang('w_post_align'); ?>;direction: <?php echo lang('w_post_dir'); ?>"> 

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

				<div class="write_post">
                <?php echo $err_success_Msg; ?>
                    <?php include("includes/w_post_form.php"); ?>
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
// Get the Sidebar
var mySidebar = document.getElementById("mySidebar");

// Get the DIV with overlay effect
var overlayBg = document.getElementById("myOverlay");

// Toggle between showing and hiding the sidebar, and add overlay effect
function w3_open() {
  if (mySidebar.style.display === 'block') {
    mySidebar.style.display = 'none';
    overlayBg.style.display = "none";
  } else {
    mySidebar.style.display = 'block';
    overlayBg.style.display = "block";
  }
}

// Close the sidebar with the close button
function w3_close() {
  mySidebar.style.display = "none";
  overlayBg.style.display = "none";
}

</script>

</body>
</html>