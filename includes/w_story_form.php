<br>
<style type="text/css">
    #cancel_photo_preview{
    display: block;
    background: transparent;
    border: none;
    color: #ffffff;
    font-size: 21px;
    transition: color 0.3s;
    text-shadow: 1px 1px 8px rgb(0, 0, 0);
    }
    #photo_preview label{
    position: absolute;
    margin: 0;
    padding: 0;
    background: rgba(0, 0, 0, 0.46);
    left: 0;
    right: 0;
    top: 0;
    bottom: 0;
    }
	.fubut{
		width:30%;
		height:30%;
		border:none;
		border-radius:10px;
		font-size:20px;
		display:inline-block;
	}
.post{
    background: white;
    border-radius: 4px;
    box-shadow: 0px 0px 18px rgba(63, 81, 181, 0.16);
    margin: 10px 5px;
    border: 1px solid transparent;
	width: 99.5%;
	min-height: 100%;
}
.ta {
border: none;
width: 70%;
height: 99px;
}
.fi {
display: none;
}
.po {
background-color: #0066FF;
width: 100%;
border: none;
border-radius: 100px;
}

.po:hover {
opacity: 0.9;
}
.le {
display: block;
width: 100%;
text-align: center;
border: #000000 solid;
}
.le:hover {
background-color: #CCCCCC;
}
.high {
border: none;
width: 100%;
min-height: 300px;
resize: none;
font-size: 20px;
}
.co{
	background-color: light-grey;
	border: none;
	width:10%;
}
.co:hover{
	background-color: #CCCCCC;
}

#text {
	font-size: 20px;
	text-align:center;
	border: none;
	width: 70%;
	height: 300px;
	resize: none;
}
@media screen and (max-width:600px){
    #text{
        width:100%;
    }
}
.paym{
	width:5%;
	height:5%;
}
@media screen and (max-width:600px){
	.paym{
	width:15%;
	height:8%;
}
}
#w_icadd{
	position: fixed;
	left: 0px;
	top: 0px;
	width: 100%;
	background-color: #000000;
	height: 100%;
	z-index: 9999;
	overflow: scroll;
	opacity: .8;
	color: white;
}
#drag-1, #drag-2 {
  width: 25%;
  min-height: 6.5em;
  margin: 10%;
  background-color: #29e;
  color: white;
  border-radius: 0.75em;
  padding: 4%;
  touch-action: none;
  user-select: none;
  -webkit-transform: translate(0px, 0px);
          transform: translate(0px, 0px);
}
</style>
<?php
if (is_dir("imgs/")) {
    $imagePath = "imgs/";
}elseif (is_dir("../imgs/")) {
    $imagePath = "../imgs/";
}elseif (is_dir("../../imgs/")) {
    $imagePath = "../../imgs/";
}
?>

<div class="post" style="min-width: 99.5%" style="text-align:<?php echo lang('w_post_align'); ?>;direction: <?php echo lang('w_post_dir'); ?>">
<div id="w_options" style="display:block;" class="wpost_tabcontent">


    <button class="fubut" style="background:purple;" onclick="wpost_tabs(event, 'w_photo')"><span style="color: #4CAF50;margin: 0px 5px;" class="fa fa-camera"></span><br> <?php echo lang('story_image_video'); ?></button>

    <button class="fubut" style="background:#4CAF50;" onclick="wpost_tabs(event, 'w_write')"><span style="color: brown;margin: 0px 5px;" class="fa fa-map"></span><br> <?php echo lang('wpost_text'); ?></button>
    <button class="fubut" style="background:orange;" onclick="wpost_tabs(event, 'w_ques')"><span style="color: pink;margin: 0px 5px;">?</span><br> <?php echo lang('question'); ?></button>

    <button class="fubut" onclick="wpost_tabs(event, 'w_save')"><span style="color: blue;margin: 0px 5px;" class="fa fa-share"></span><br> <?php echo lang('Share_the_saved_stories'); ?></button>

</div>
<div id="w_photo" class="wpost_tabcontent">
       <div id='photo_preview' style="margin-top: 10px;order: 1px solid rgba(0, 0, 0, 0.1);overflow: hidden;width: 100%;height: 100%;display:none;position: relative;">
       <label style="color: white">
        <button type="reset" name="reset" id="cancel_photo_preview" style="display: none"><span class="fa fa-times"></span></button>
        
       </label>
            <img id='photo_preview_src' src='#' alt='your image' style='height:100%;width:100%;cursor: pointer;' />
			<video id='photo_preview_src' src='#' alt='your image' style='height:100%;cursor: pointer;'></video>
       </div>

    <label>
        <input type="file" id="w_img_m" name="w_photo" accept="image/png, image/jpeg, video/mp4, video/wmp, video/ogg, audio/mp3" onchange="photoPreview(this);" style="display: none" />
      
    <div id='photo_preview_box' style='cursor: pointer;display:block;width:100%;height:50%;border:2px dashed rgba(78, 178, 255, 0.8);text-align:center;'>
        <span class='fa fa-image' style=' margin: 35%;font-size: 30px;color: rgba(78, 178, 255, 0.8);'><br>8Mb</span>
	</label>	
         </div>
		 <div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
		 <style>
.slider {
  -webkit-appearance: none;
  width: 100%;
  height: 15px;
  border-radius: 5px;
  background: #d3d3d3;
  outline: none;
  opacity: 0.7;
  -webkit-transition: .2s;
  transition: opacity .2s;
}

.slider:hover {
  opacity: 1;
}

.slider::-webkit-slider-thumb {
  -webkit-appearance: none;
  appearance: none;
  width: 25px;
  height: 25px;
  border-radius: 50%;
  background: #4CAF50;
  cursor: pointer;
}
.slider::-moz-range-thumb {
  width: 25px;
  height: 25px;
  border-radius: 50%;
  background: #4CAF50;
  cursor: pointer;
}

.op_in{
	width:80%;
	text-align:center;
	border:none;
}
.op_in:focus{
	border:none;
}
.qyes{
border-radius:4px;font-size:20px;width:20%;padding:10px;box-shadow: 0px 0px 18px rgba(63, 81, 181, 0.16);height:20%;
}
@media screen and (max-width:600px){
	.qyes{
	width:80%;
	}
}

</style>
<script>
var slider = document.getElementById("myRange");
var output = document.getElementById("finishimg");
output.innerHTML = slider.value;

slider.oninput = function() {
  output.style.opacity = this.value;
}
function ax() {
  var body = document.getElementById("finishimg");
  var currentClass = body.className;
  body.className = currentClass == "e" ? "e" : "e";
}
function bx() {
  var body = document.getElementById("finishimg");
  var currentClass = body.className;
  body.className = currentClass == "blur" ? "blur" : "blur";
}
function cx() {
  var body = document.getElementById("finishimg");
  var currentClass = body.className;
  body.className = currentClass == "bright" ? "bright" : "bright";
}
function dx() {
  var body = document.getElementById("finishimg");
  var currentClass = body.className;
  body.className = currentClass == "grey" ? "grey" : "grey";
}
function ex() {
  var body = document.getElementById("finishimg");
  var currentClass = body.className;
  body.className = currentClass == "hru" ? "hru" : "hru";
}
function fx() {
  var body = document.getElementById("finishimg");
  var currentClass = body.className;
  body.className = currentClass == "inv" ? "inv" : "inv";
}
function gx() {
  var body = document.getElementById("finishimg");
  var currentClass = body.className;
  body.className = currentClass == "opac" ? "opac" : "opac";
}
function hx() {
  var body = document.getElementById("finishimg");
  var currentClass = body.className;
  body.className = currentClass == "satu" ? "satu" : "satu";
}
function ix() {
  var body = document.getElementById("finishimg");
  var currentClass = body.className;
  body.className = currentClass == "sepia" ? "sepia" : "sepia";
}
</script>
</div>
<div id="finishtxt" style="display:none;">
<a href="storyupload" style="background:transparent;border:none;font-size:40px;color:black;"><i class="fa fa-times"></i></a>
<span onclick="wpost_tabs(event, 'w_icadd')" class="fa fa-image" style="font-size:40px;float:right;"></span>
</div>
<div id="w_write" class="wpost_tabcontent">
<br>
<button onClick="aligwr()" id="alijx"style="border:none;background:transparent;"><i class="fa fa-bars" style="font-size:20px;"></i></button>
<button onClick="fontc()" id="fontjx" style="border:solid thin black;background:transparent;margin-left:100px;width:100px;height:40px;border-radius:50px;"><span id="fontdis" style="font-size:20px;"> Font</span></button>
<br>
</div>
<textarea placeholder="<?php echo lang('Write_a_topic'); ?>..." style="border-radius:10px;background:transparent;display:none" id="text" name="p_write"></textarea>
<div id="w_writeb" class="wpost_tabcontent">
<input type="hidden" id="fonting" name="fonting" value="Arial">
<input type="hidden" id="aligf" name="aligf" value="center">
	<div style="overflow-x:scroll;white-space:nowrap;">	
		<a id="12" onClick="yoruy('Demo3')" style="display:inline-block;" class="w3-button"><button style="width:20px;height:20px;background: linear-gradient(500deg,#8910d6,#b52d94);" id="co" class="co"></button></a><input type="radio" name="color" style="display:none" value="cod" id="col">
<div id="Demo3" style="display:none;" class="w3-animate-left">
<label for="wh"><a id="1" onClick="whf()" class="w3-button"><input style="width:30px;height:30px;" type="color" id="co" class="co" value="#FFFFFF" disabled></a><input type="radio" name="color" style="display:none" value="w3-white" id="wh" checked></label>
<label for="bl"><a id="2" onClick="blf()" class="w3-button"><input style="width:30px;height:30px;" type="color" id="co" class="co" value="#000000" disabled></a><input type="radio" name="color" style="display:none" value="w3-black" id="bl"></label>
<label for="gr"><a id="3" onClick="grf()" class="w3-button"><input style="width:30px;height:30px;" type="color" id="co" class="co" value="#CCCCCC" disabled></a><input type="radio" name="color" style="display:none" value="w3-grey" id="gr"></label>
<label for="re"><a id="4" onClick="ref()" class="w3-button"><input style="width:30px;height:30px;" type="color" id="co" class="co" value="#FF0000" disabled></a><input type="radio" name="color" style="display:none" value="w3-red" id="re"></label>
<label for="blu"><a id="5" onClick="bluf()" class="w3-button"><input style="width:30px;height:30px;" type="color" id="co" class="co" value="#0000FF" disabled></a><input type="radio" name="color" style="display:none" value="w3-blue" id="blu"></label>
<label for="gr"><a id="6" onClick="gref()" class="w3-button"><input style="width:30px;height:30px;" type="color" id="co" class="co" value="#00FF00" disabled></a><input type="radio" name="color" style="display:none" value="w3-green" id="gr"></label>
<label for="vi"><a id="7" onClick="vif()" class="w3-button"><input style="width:30px;height:30px;" type="color" id="co" class="co" value="#9900FF" disabled></a><input type="radio" name="color" style="display:none" value="w3-purple" id="vi"></label>
<label for="lb"><a id="8" onClick="lbf()" class="w3-button"><input style="width:30px;height:30px;" type="color" id="co" class="co" value="#00FFFF" disabled></a><input type="radio" name="color" style="display:none" value="w3-light-blue" id="lb"></label>
<label for="pi"><a id="9" onClick="pif()" class="w3-button"><input style="width:30px;height:30px;" type="color" id="co" class="co" value="#CC33CC" disabled></a><input type="radio" name="color" style="display:none" value="w3-pink" id="pi"></label>
<label for="ya"><a id="10" onClick="yaf()" class="w3-button"><input style="width:30px;height:30px;" type="color" id="co" class="co" value="#FFFF00" disabled></a><input type="radio" name="color" style="display:none" value="w3-yellow" id="ya"></label>
<label for="or"><a id="11" onClick="orf()" class="w3-button"><input style="width:30px;height:30px;" type="color" id="co" class="co" value="#FFCC33" disabled></a><input type="radio" name="color" style="display:none" value="w3-orange" id="or"></label>
<label for="col"><a id="12" onClick="cof()" class="w3-button"><button style="width:20px;height:20px;background: linear-gradient(500deg,#8910d6,#b52d94);" id="co" class="co"></button></a><input type="radio" name="color" style="display:none" value="cod" id="col"></label>
</div>
<p style="text-align:center;display:inline-block;float:right;"><button onclick="wpost_tabs(event, 'finishtxt')" align="center" style="border-radius:50px;width:35px;height:35px;"><span class="fa fa-arrow-right"></span></button></p>
</div>
</div>
<div id="w_map" class="wpost_tabcontent">
<div style="width:30%;height:40%;background:white;box-shadow: 0px 0px 18px rgba(63, 81, 181, 0.16);border: 1px solid transparent;border-radius: 10px;">
<div class="w3-light-grey" style="height:25%;border-radius:4px;">
<br>
<input type="text" class="w3-light-grey op_in" placeholder="Your question" name="question" id="ques">
</div>
<br>
<label for="ao" style="width:100%" onclick="fop()"><div style="border-radius:4px;" id="aod">
<input type="text" class="op_in" placeholder="Option 1" name="op1" id="ques1"> <input type="radio" name="num_cor" value="a" id="ao" checked>
</div>
</label>
<hr>
<label for="bo" style="width:100%" onclick="fop()"><div style="border-radius:4px;" id="bod">
<input type="text" class="op_in" placeholder="Option 2" name="op2" id="ques2"> <input type="radio" name="num_cor" id="bo" value="b">
</div>
</label>
<label for="zo" style="width:100%" onclick="fop()"><div class="custom-control custom-radio" style="border-radius:4px;" id="zod">
<hr>
<input type="text" class="op_in" placeholder="Option 3" name="op3" id="ques3"> <input class="custom-control-input" type="radio" name="num_cor" value="c" id="zo">
<br>
</div></label>
</div>
</div>
<div id="w_finish" class="wpost_tabcontent">

<div id="finishim" style="display:none">
<img src="#" id="finishimg" alt="img" style='height:70%;width:100%;cursor: pointer;'>
<br>
<div style="overflow-x:scroll;white-space:nowrap;">
<label for="a"><img src="imgs/main_icons/1f3d5.png" class="img-bri" onclick="ax()"><input type="radio" style="display:none" value="e" name="img_style" id="a" checked></label>
<label for="b"><img src="imgs/main_icons/1f3d5.png"class="blur img-bri" onclick="bx()"><input type="radio" style="display:none" value="blur" name="img_style" id="b"></label>
<label for="c"><img src="imgs/main_icons/1f3d5.png"class="bright img-bri" onclick="cx()"><input type="radio" style="display:none" value="bright" name="img_style" id="c"></label>
<label for="d"><img src="imgs/main_icons/1f3d5.png"class="grey img-bri" onclick="dx()"><input type="radio" style="display:none" value="grey" name="img_style" id="d"></label>
<label for="e"><img src="imgs/main_icons/1f3d5.png"class="hru img-bri" onclick="ex()"><input type="radio" style="display:none" value="hru" name="img_style" id="e"></label>
<label for="f"><img src="imgs/main_icons/1f3d5.png"class="inv img-bri" onclick="fx()"><input type="radio" style="display:none" value="inv" name="img_style" id="f"></label>
<label for="g"><img src="imgs/main_icons/1f3d5.png"class="opac img-bri" onclick="gx()"><input type="radio" style="display:none" value="opac" name="img_style" id="g"></label>
<label for="h"><img src="imgs/main_icons/1f3d5.png"class="satu img-bri" onclick="hx()"><input type="radio" style="display:none" value="satu" name="img_style" id="h"></label>
<label for="i"><img src="imgs/main_icons/1f3d5.png"class="sepia img-bri" onclick="ix()"><input type="radio" style="display:none" value="sepia" name="img_style" id="i"></label>
</div>
</div>
		 <div style="">
		 <input type="range" value="0" step="0.1" class="slider" id="myRange" name="opa_img">
		 </div>
</div>
<script>
/////////////////////////////////
function fop(){
var ao = document.getElementById("ao");
var bo = document.getElementById("bo");
var zo = document.getElementById("zo");
if(ao == checked){
	var aod = document.getElementById("aod");
	aod.style.background = "green";
}elseif(bo == checked){
	var bod = document.getElementById("bod");
	bod.style.background = "green";
}elseif(zo == checked){
	var zod = document.getElementById("zod");
	zod.style.background = "green";
}}
</script>
<div>
<div id="w_title" class="wpost_tabcontent">
<div style="border-radius:4px;font-size:20px;width:100%;padding:10px;box-shadow: 0px 0px 18px rgba(63, 81, 181, 0.16);">
<input type="text" name="location" maxlength="100" id="location_tex" class='w3-light-grey' style='padding:10px;border:none;' placeholder="<?php echo lang('Loction'); ?>" class="flat_solid_textfield"></input>
<input type="hidden" name="check_path" value="<?php echo $check_path; ?>" />
/ 100
</div>
</div>
<div id="w_talt" class="wpost_tabcontent">
<input type="text" name="title" maxlength="100" id="title_tex" class='w3-light-grey' style='padding:10px;border:none;' placeholder="<?php echo lang('wpost_text'); ?>" class="flat_solid_textfield"></input>
</div>
</div>
<div id="w_ques" class="wpost_tabcontent">
<div class="qyes">
<input type="text" name="quesoe" maxlength="100" id="ques_tex" class='w3-light-grey' style='padding:10px;border:none;' placeholder="Your question..." class="flat_solid_textfield"></input>
</div>
</div>
<div id="w_time" class="wpost_tabcontent">
<?php
    date_default_timezone_set('YOUR TIMEZONE');
     $timestamp = date('h:i a');
	?>
	<input type="hidden" name="time_fu" value="<?php echo $timestamp; ?>">
<label for="time_ch" style="border-radius:4px;font-size:20px;width:500px;padding:10px;box-shadow: 0px 0px 18px rgba(63, 81, 181, 0.16);"><div id="timestamp" class="w3-light-grey" style="border-radius:4px;font-size:20px;width:100%;padding:10px;"><?php echo"$timestamp"; ?></div>
Click to add the the time.<input type="checkbox" name="time_ch" id="time_ch" value="1"></label>
</div>
<div id="w_save" class="wpost_tabcontent">
	<style>
	.postSavedTablei{
    width: 100%;
    background: #fff;
    border: 1px solid #D9D9D9;
}
.postSavedTablei tr{
    box-shadow: 0px 0px 0px #d0d0d0;
    transition: box-shadow 0.3s;
}
.postSavedTablei tr:hover,.postSavedTablei tr:focus{
    box-shadow: 0px 0px 20px #d0d0d0;
}
.postSavedTablei tr td{
    padding: 10px;
    font-size: 14px;
    border: 1px solid rgb(228, 228, 228);
}
.postSavedTablei tr td img{
    width: auto;
    height: 50px;
    max-width: 150px
}
.postSavedTablei tr td a{
    color: #000;
    text-decoration: none;
    word-break: break-word;
}
.postSavedTablei tr td a:hover,.postSavedTablei tr td a:focus{
    color: #000;
    text-decoration: none;
}
	</style>
<div class="main_container" align="center">
    <div style="min-width:100%;" align="center">
        <div align="left">
        <table class="postSavedTablei" style="border-radius:10px;min-width:100%;">
            <tr style="font-weight: bold; text-transform: uppercase; color: rgba(0, 0, 0, 0.59); font-size: 13px; background: rgb(241, 241, 241); border-bottom: 2px solid #46a0ec;">
                <td><?php echo lang('all_posts_that_you_saved'); ?></td>
                <td align="center"><span class="fa fa-cog"></span></td>
            </tr>
            <?php
session_start();
include("config/connect.php");
include("includes/fetch_users_info.php");
$uid = $_SESSION['id'];
$getSaved_sql = "SELECT * FROM saved_story WHERE user_id= :uid ORDER BY time DESC";
$getSaved=$conn->prepare($getSaved_sql);
$getSaved->bindParam(':uid',$uid,PDO::PARAM_INT);
$getSaved->execute();
$countSaved = $getSaved->rowCount();
while ($fetchSaved = $getSaved->fetch(PDO::FETCH_ASSOC)) {
	$saved_id = $fetchSaved['id'];
	$saved_post_id = $fetchSaved['saved_id'];
	$author_id = $fetchSaved['author_id'];
	$img_id = $fetchSaved['img_id'];
	$img_sty = $fetchSaved['img_sty'];
	$img_opacity = $fetchSaved['img_opacity'];
	$saved_time = $fetchSaved['time'];
	$saved_timeAgo = time_ago($saved_time);
	$getUserData_sql = "SELECT * FROM signup WHERE id= :author_id";
	$getUserData=$conn->prepare($getUserData_sql);
	$getUserData->bindParam(':author_id',$author_id,PDO::PARAM_INT);
	$getUserData->execute();
	while ($fetchUserData = $getUserData->fetch(PDO::FETCH_ASSOC)) {
    $userData_username = $fetchUserData['Username'];
    $userData_fullname = $fetchUserData['Fullname'];
	}
?>
<tr id="saved_<?php echo $saved_id; ?>">
<td style="max-width: 600px">
<div style="display: inline-flex;">
<?php
echo "<div>";   
   if (!empty($img_id)) {
			if(preg_match("/.(png|jpeg|jpg)$/i", $img_id/*importent!!!*/)){
        echo "<img src=\"imgs/$img_id\" alt='$query_fetch_fullname' style='min-width: 100px;max-width: 100px;min-height: 100px;max-height: 100px;' />";
		}elseif(preg_match("/.(mp4|ogg|wmb)$/i", $img_id/*importent!!!*/)){
			 echo "<video src=\"imgs/$img_id\" alt='$query_fetch_fullname' style='min-width: 100px;max-width: 100px;min-height: 100px;max-height: 100px;'></video>";
		}elseif(preg_match("/.(mp3)$/i", $img_id/*importent!!!*/)){
				 echo "<img src=\"imgs/main_icons/1f4e2.png\" alt='$query_fetch_fullname' />";
		}elseif(preg_match("/.(pdf)$/i", $img_id/*importent!!!*/)){ 
		echo "<embed style='min-width: 100px;max-width: 100px;min-height: 80px;max-height: 80px;' type='application/pdf' src=\"imgs/$img_id\"></embed>";
		}
		}echo "</div>";
?>
<div style="padding: 5px">
<a href="u/<?php echo $userData_username; ?>" style='color: gray;font-size: 14px;'><?php echo "<b>".$userData_fullname."</b>"." - @".$userData_username; ?></a><br>
<span class="fa fa-clock-o" style='color: gray;font-size: 11px;'> <b style="font-family: sans-serif;"><?php echo $saved_timeAgo; ?></b></span>
<br><br>
<?php
if (strlen($post_content) > 150) {
	echo substr($post_content, 0,150)."...";
}else{
   if (!empty($img_id)) {
			if(preg_match("/.(png|jpeg|jpg)$/i", $img_id/*importent!!!*/)){
        echo "Picture";
		}elseif(preg_match("/.(mp4|ogg|wmb)$/i", $img_id/*importent!!!*/)){
			 echo "Video";
		}elseif(preg_match("/.(mp3)$/i", $img_id/*importent!!!*/)){
				 echo "Music";
		}elseif(preg_match("/.(pdf)$/i", $img_id/*importent!!!*/)){ 
		echo "Pdf";
		}
		}else{
			echo"Nothing";
		}
}
?> <br/><a onclick="dis('imgnow_<?php echo"$saved_id"; ?>')" style="color: #46a0ec;">Continue reading</a>
</div></div>
<div id="imgnow_<?php echo"$saved_id"; ?>" style="display:none;">
<?php
   if (!empty($img_id)) {
			if(preg_match("/.(png|jpeg|jpg)$/i", $img_id/*importent!!!*/)){
        echo "<img src=\"imgs/$img_id\" alt='$query_fetch_fullname' style='min-width: 100%;max-width: 100%;min-height: 600px;max-height: 600px;' />";
		}elseif(preg_match("/.(mp4|ogg|wmb)$/i", $img_id/*importent!!!*/)){
			 echo "<video src=\"imgs/$img_id\" alt='$query_fetch_fullname' style='min-width: 100%;max-width: 100%;min-height: 600px;max-height: 600px;''></video>";
		}elseif(preg_match("/.(mp3)$/i", $img_id/*importent!!!*/)){
				 echo "<img src=\"imgs/main_icons/1f4e2.png\" alt='$query_fetch_fullname' />";
		}elseif(preg_match("/.(pdf)$/i", $img_id/*importent!!!*/)){ 
		echo "<embed style='min-width: 100%;max-width: 100%;min-height: 600px;max-height: 600px;' type='application/pdf' src=\"imgs/$img_id\"></embed>";
		}
		}else{
			echo"Nothing";
		}
	?>
</div>
<div id="deleteSavedMsg_<?php echo $saved_id; ?>"></div>
</td>
<td align="center"><input type="radio" name="sharesave" value="<?php echo "$img_id"; ?>"></td>
</tr>
<?php
}
?>
        </table>
        <?php
        if ($countSaved < 1) {
        ?>
        <div class="saved_nothingToShow">
            <p>
            <span class="fa fa-newspaper-o" style="font-size: 62px;"></span><br>
            <?php echo lang('nothing_saved_yet'); ?>.</p>
			<?php echo $_SESSION['id']; ?>
        </div>
        <?php
        }
        ?>
        </div>
    </div>
</div>
<br>
<script>
	function dis(id) {
  var x = document.getElementById(id);
  if (x.style.display === 'none') {
    x.style.display = 'block';
  } else {
    x.style.display = 'none';
  }
}
</script>
</div>
<div id="w_link" class="wpost_tabcontent">
<div style="border-radius:4px;font-size:20px;width:500px;;padding:10px;box-shadow: 0px 0px 18px rgba(63, 81, 181, 0.16);">
<input class='w3-light-grey' style='padding:10px;border:none;' id="mention_tex" type="text" placeholder="Mention" name="mention">
</div>
</div>

<div id="w_text" class="wpost_tabcontent" style="padding: 0px">
    <textarea dir="auto" id="lang_rtl_ltr" class="post_textbox" placeholder="<?php echo lang('post_textbox_placeholder'); ?>" name="post_textbox"></textarea>
</div>		
 <input class="default_flat_btn" id="subtit" type="submit" name="post_now" value="<?php echo lang('post_now'); ?>" style="margin: 5px;padding: 8px 10px;border-radius:20px;display:none;" />
<div id="myop" style="overflow-x:scroll;white-space:nowrap;display:none;">
    <button class="wpost_tablinks" onclick="wpost_tabs(event, 'w_photo')"><span style="color: #4CAF50;margin: 0px 5px;" class="fa fa-camera"></span> <?php echo lang('wpost_photo_pdf'); ?></button>

    <button class="wpost_tablinks" onclick="wpost_tabs(event, 'w_write')"><span style="color: brown;margin: 0px 5px;" class="fa fa-map"></span> <?php echo lang('wpost_text'); ?></button>
    <button class="wpost_tablinks" onclick="wpost_tabs(event, 'w_ques')"><span style="color: pink;margin: 0px 5px;">?</span> <?php echo lang('question'); ?></button>
    <button class="wpost_tablinks" onclick="wpost_tabs(event, 'w_save')"><span style="color: blue;margin: 0px 5px;" class="fa fa-share"></span> <?php echo lang('Share_the_saved_stories'); ?></button>

</div> 
   <div id="w_icadd" style="display:none">
   <span style="background:transparent;border:none;font-size:40px;color:white;" onclick="wpost_tabs(event, 'w_icadd')" class="fa fa-times"></span>
   <div style="margin:20px;color:black">
   <div style="display:inline-block;"><button onclick="wpost_tabs(event, 'w_title')" style="padding:15px;font-size:25px;"><span style="color:red;" class="fa fa-map-marker"></span> Locaton</button></div>
   <div style="display:inline-block;"><button onclick="wpost_tabs(event, 'w_talt')" style="padding:15px;font-size:25px;"><span style="color:#ffb300;" class="fa fa-quote-right"></span> Title</button></div>
   <div style="display:inline-block;"><button onclick="wpost_tabs(event, 'w_map')" style="padding:15px;font-size:25px;"><span style="color:green;">?</span> Quiz</button></div>
   <div style="display:inline-block;"><button onclick="wpost_tabs(event, 'w_time')" style="padding:15px;font-size:25px;"><span style="color:blue;" class="fa fa-globe"></span> Time</button></div>
   <div style="display:inline-block;"><button onclick="wpost_tabs(event, 'w_link')" style="padding:15px;font-size:25px;"><span style="color:orange;">@</span> Mention</button></div>
   </div>
   </div>
</div>
   </form>
<div class="loadingPosting"><p class="loadingPostingP">0</p></div>
</div>
<div id="getingNP"></div>
<br>
<script>
$(document).ready(function(){
$('.loadingPosting').hide();
var i = 1;
$("#postingToDB").on('submit',function(e){
if ($.trim($('.post_textbox').val()) != "") {
var plus = i++;
$("#getingNP").prepend("<div id='FetchingNewPostsDiv"+plus+"' style='display:none;'></div>");
e.preventDefault();   
$(this).ajaxSubmit({
beforeSend:function(){
$("#postingToDB").slideUp();
$('.loadingPosting').show();
$(".loadingPostingP").css({'width' : '0%'});
$(".loadingPostingP").html('0');
},
uploadProgress:function(event,position,total,percentCompelete){
$(".loadingPostingP").css({'width' : percentCompelete + '%'});
$(".loadingPostingP").html(percentCompelete);
},
success:function(data){
$("#postingToDB").slideDown(function(){
    $('.loadingPosting').slideUp(function(){
        $("#FetchingNewPostsDiv"+plus).html(data);
        $("#FetchingNewPostsDiv"+plus).fadeIn();
    });
    $('.post_textbox').css({'height':'95px'});
    $("#postingToDB").clearForm();
    $('#w_photo').hide();
    $('#w_write').hide();
    $('#w_story').hide();
    $('#w_title').hide();
    $('#p_privacy').val("<?php echo lang('wpr_public'); ?>");
    $('#photo_preview').hide();
    $('#cancel_photo_preview').hide();
    $('#photo_preview_box').show();
});
}
});
}else{
    return false;
}
});
});
</script>
<script type="text/javascript">
function wpost_tabs(e,tabName){
    e.preventDefault();
switch(tabName){
    case "w_text":
        $('#w_text').slideToggle(300);
        $('.post_textbox').focus();
		$('#w_options').slideUp(300);
		 $('#myop').show(300);
    break;
    case "w_photo":
        $('#w_photo').slideToggle(300);
		$('#w_text').slideUp(300);
        $('#myop').show(300);
        $('#w_write').slideUp();
        $('#text').slideUp();
        $('#w_ques').slideUp();
		$('#subtit').hide(300);
        $('#w_story').slideUp();
		$('#w_map').slideUp(300);
		$('#w_options').slideUp(300);
		//////////////////////
		$('#photo_preview_srci').val('');
		$('#photo_preview_srcm').val('');
		$('#hr_sto').val('');
		$('#text').val('');
		$('#stor').val('');
		$('#poll_qu').val('');
		$('#ques').val('');
		$('#ques1').val('');
		$('#ques2').val('');
		$('#ques3').val('');
		$('#hr_mov').val('');
		//////////////////////
		$('#w_movie').slideUp(300);
		$('#w_moviep').slideUp(300);
		$('#w_moviep').slideUp(300);
		$('#w_nav_text').slideUp(300);
		$('#w_save').slideUp(300);
		$('#w_writeb').slideUp(300);
		$('#w_poll').slideUp(300);
		$('#men').slideUp(300);
		$('#content').css({'margin-<?php echo lang('w_post_align'); ?>':'0px'});
    break;
	case "w_ques":
        $('#w_ques').slideToggle(300);
       $('#w_photo').slideUp(300);
		$('#w_text').slideToggle(300);
        $('#myop').show(300);
        $('#w_write').slideUp();
        $('#text').slideUp();
        $('#w_story').slideUp();
		$('#w_map').slideUp(300);
		$('#w_options').slideUp(300);
		//////////////////////
		$('#photo_preview_srci').val('');
		$('#photo_preview_srcm').val('');
		$('#hr_sto').val('');
		$('#text').val('');
		$('#stor').val('');
		$('#poll_qu').val('');
		$('#ques').val('');
		$('#ques1').val('');
		$('#ques2').val('');
		$('#ques3').val('');
		$('#hr_mov').val('');
		//////////////////////
		$('#w_movie').slideUp(300);
		$('#subtit').show(300);
		$('#w_moviep').slideUp(300);
		$('#w_moviep').slideUp(300);
		$('#w_nav_text').slideUp(300);
		$('#w_save').slideUp(300);
		$('#w_writeb').slideUp(300);
		$('#w_poll').slideUp(300);
		$('#men').slideUp(300);
		$('#content').css({'margin-<?php echo lang('w_post_align'); ?>':'0px'});
    break;
    case "w_title":
        $('#w_title').slideToggle(300);
		$('#w_options').slideUp(300);
		$('#w_icadd').slideUp(300);
		$('#location_tex').focus();
		 $('#myop').show(300);
    break;
	case "w_talt":
        $('#w_talt').slideToggle(300);
		$('#w_options').slideUp(300);
		$('#title_tex').focus();
		$('#w_icadd').slideUp(300);
		 $('#myop').show(300);
    break;
    case "w_time":
        $('#w_time').slideToggle(300);
		$('#w_options').slideUp(300);
		$('#w_icadd').slideUp(300);
		 $('#myop').show(300);
		$('#time_ch').attr("checked","true");
    break; 
	case "w_write":
		$('#w_write').slideToggle(300);
		$('#w_writeb').slideToggle(300);
		$('#text').slideToggle(300);
		$('#myop').show(300);
		$('#w_text').slideUp(300);
        $('.text').focus();
        $('#w_photo').slideUp();
		$('#subtit').hide(300);
        $('#w_story').slideUp();
        $('#w_ques').slideUp();
		$('#w_movie').slideUp(300);
		$('#w_options').slideUp(300);
		//////////////////////
		$('#photo_preview_srci').val('');
		$('#photo_preview_srcm').val('');
		$('#hr_sto').val('');
		$('#text').val('');
		$('#stor').val('');
		$('#ques').val('');
		$('#ques1').val('');
		$('#poll_qu').val('');
		$('#ques2').val('');
		$('#ques3').val('');
		$('#w_img_m').val('');
		$('#hr_mov').val('');
		//////////////////////
		$('#w_moviep').slideUp(300);
		$('#men').slideToggle(300);
		$('#w_poll').slideUp(300);
		$('#w_save').slideUp(300);
		$('#w_map').slideUp(300);
        $('#w_nav_text').slideToggle(300);
        $('#content').css({'margin-<?php echo lang('w_post_align'); ?>':'300px'});
    break;
		case "w_save":
		$('#w_save').slideToggle(300);
		$('#w_text').slideToggle(300);
		$('#w_writeb').slideUp(300);
		$('#w_ques').slideUp(300);
		$('#myop').show(300);
		$('#subtit').show(300);
        $('.text').focus();
        $('#w_photo').slideUp();
        $('#text').slideUp();
        $('#w_story').slideUp();
		$('#w_movie').slideUp(300);
		$('#w_options').slideUp(300);
		//////////////////////
		$('#photo_preview_srci').val('');
		$('#photo_preview_srcm').val('');
		$('#hr_sto').val('');
		$('#text').val('');
		$('#stor').val('');
		$('#ques').val('');
		$('#ques1').val('');
		$('#poll_qu').val('');
		$('#ques2').val('');
		$('#ques3').val('');
		$('#w_img_m').val('');
		$('#hr_mov').val('');
		//////////////////////
		$('#w_moviep').slideUp(300);
		$('#men').slideUp(300);
		$('#w_poll').slideUp(300);
		$('#w_write').slideUp(300);
		$('#w_map').slideUp(300);
        $('#w_nav_text').slideUp(300);
        $('#content').css({'margin-<?php echo lang('w_post_align'); ?>':'0px'});
    break;
	case "w_story":
		$('#w_story').slideToggle(300);
		$('#myop').show(300);
        $('#w_photo').slideUp(300);
        $('#w_writeb').slideUp(300);
		$('#w_write').slideUp();
		$('#w_text').slideUp(300);
		$('#men').slideUp(300);
		$('#w_options').slideUp(300);
		//////////////////////
		$('#photo_preview_srci').val('');
		$('#photo_preview_srcm').val('');
		$('#w_img_m').val('');
		$('#text').val('');
		$('#w_img_m').val('');
		$('#hr_mov').val('');
		$('#ques').val('');
		$('#ques1').val('');
		$('#ques2').val('');
		$('#poll_qu').val('');
		$('#ques3').val('');
		//////////////////////
		$('#w_movie').slideUp(300);
		$('#w_moviep').slideUp(300);
		$('#w_poll').slideUp(300);
		$('#w_save').slideUp(300);
		$('#w_map').slideUp(300);
		$('#w_nav_text').slideUp(300);
		$('#content').css({'margin-<?php echo lang('w_post_align'); ?>':'0px'});
        ;
    break;
	case "w_link":
	$('#w_link').slideToggle(300);
	$('#w_options').slideUp(300);
	$('#w_icadd').slideUp(300);
	 $('#myop').show(300);
	 $('#mention_tex').focus();
        ;
    break;
	case "w_movie":
		$('#w_story').slideUp();
        $('#w_photo').slideUp();
		$('#w_write').slideUp();
		$('#men').slideUp(300);
        $('#w_title').slideUp();
		$('#w_text').slideUp(300);
		$('#w_writeb').slideUp(300);
		$('#w_link').slideUp(300);
		$('#w_save').slideUp(300);
		$('#w_options').slideUp(300);
		//////////////////////
		$('#hr_sto').val('');
		$('#text').val('');
		$('#stor').val('');
		$('#w_img_m').val('');
		$('#poll_qu').val('');
		$('#ques').val('');
		$('#ques1').val('');
		$('#ques2').val('');
		$('#ques3').val('');
		//////////////////////
		$('#w_movie').slideToggle(300);
		$('#myop').slideToggle(300);
		$('#w_moviep').slideToggle(300);
		$('#w_poll').slideUp(300);
		$('#w_map').slideUp(300);
		$('#w_nav_text').slideUp(300);
		$('#content').css({'margin-<?php echo lang('w_post_align'); ?>':'0px'});
        ;
    break;
	case "w_map":
		$('#w_story').slideUp();
        $('#w_photo').slideUp();
		$('#w_write').slideUp();
		$('#men').slideUp(300);
        $('#w_title').slideUp();
        $('#w_options').slideUp();
        $('#w_save').slideUp();
		$('#w_link').slideUp(300);
		$('#w_writeb').slideUp(300);
		$('#w_text').slideUp(300);
		$('#w_map').slideToggle(300);
		$('#myop').slideToggle(300);
		$('#w_nav_text').slideUp(300);
		$('#content').css({'margin-<?php echo lang('w_post_align'); ?>':'0px'});
		//////////////////////
		$('#photo_preview_srci').val('');
		$('#photo_preview_srcm').val('');
		$('#hr_sto').val('');
		$('#text').val('');
		$('#stor').val('');
		$('#poll_qu').val('');
		$('#hr_mov').val('');
		//////////////////////
		$('#w_movie').slideUp(300);
		$('#w_moviep').slideUp(300);
		$('#w_icadd').slideUp(300);
		$('#w_poll').slideUp(300);
        ;
    break;
		case "finishtxt":
		$('#w_story').slideUp();
        $('#w_photo').slideUp();
		$('#w_write').slideUp();
		$('#w_writeb').slideUp();
		$('#men').slideUp(300);
        $('#w_title').slideUp();
        $('#w_options').hide();
        $('#w_save').slideUp();
        $('#finishtxt').show();
		$('#w_link').slideUp(300);
		$('#w_text').show(300);
		$('#w_map').slideUp(300);
		$('#myop').slideUp(300);
		$('#w_nav_text').slideUp(300);
		$('#content').css({'margin-<?php echo lang('w_post_align'); ?>':'0px'});
		//////////////////////
		$('#photo_preview_srci').val('');
		$('#photo_preview_srcm').val('');
		$('#hr_sto').val('');
		$('#stor').val('');
		$('#poll_qu').val('');
		$('#hr_mov').val('');
		//////////////////////
		$('#w_movie').slideUp(300);
		$('#w_moviep').slideUp(300);
		$('#w_poll').slideUp(300);
		$('#subtit').show();
        ;
    break;
		case "w_icadd":
	$('#w_icadd').slideToggle(300);
        ;
    break;
}
}
$('#p_privacy').on('change', function() {
	if(this.value == "<?php echo lang('wpr_ads'); ?>") {
		$('#ic').slideToggle(300);
		$('#wt_story').hide(300);
		$('#w_story').hide(300);
		$('#w_movie').hide(300);
		$('#w_moviep').hide(300);
		$('#wt_movie').hide(300);
	}else{
		$('#ic').hide(300);
		$('#wt_story').show(300);
		$('#s_li').val('');
		$('#s_mi').val('');

		$('#wt_movie').show(300);
	}
});
$('#your_title').maxlength();

function aligwr() {
	$('#text').css({"text-align":"left"});
	$('#alijx').attr('onclick', 'aligri()');
	$('#aligf').val("left");
}
function aligri() {
	$('#text').css({"text-align":"right"});
	$('#alijx').attr('onclick', 'aligor()');
	$('#aligf').val("right");
}
function aligor() {
	$('#text').css({"text-align":"center"});
	$('#alijx').attr('onclick', 'aligwr()');
	$('#aligf').val("center");
}
///////////////////////
function fontc() {
	$('#text').css({"font-family":"Arial"});
	$('#fontjx').attr('onclick', 'fonta()');
	$('#fontdis').html("Arial");
	$('#fontdis').css({"font-size":"20px"});
	$('#fonting').val("Arial");
}
function fonta() {
	$('#text').css({"font-family":"Times New Roman"});
	$('#fontjx').attr('onclick', 'fontb()');
	$('#fontdis').html("Times New Roman");
	$('#fontdis').css({"font-size":"10px"});
	$('#fonting').val("Times New Roman");
}
function fontb() {
	$('#text').css({"font-family":"raleway"});
	$('#fontjx').attr('onclick', 'fontc()');
	$('#fontdis').html("modern");
	$('#fontdis').css({"font-size":"20px"});
	$('#fonting').val("raleway");
}
function photoPreview(input) {
if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
    $('#photo_preview_src').attr('src', e.target.result);
    $('#finishimg').attr('src', e.target.result);
    $('#photo_preview_box').css({"display":"none"});
    $('#subtit').show();
    $('#w_photo').hide(300);
    $('#w_finish').show(300);
    $('#finishim').show(300);
    $('#w_text').show(300);
    $('#finishtxt').show(300);
    $('#myop').hide(300);
    $('#photo_preview').css({"display":"block"});
    $('#cancel_photo_preview').css({"display":"block"});
    }

    reader.readAsDataURL(input.files[0]);
}else{
    $('#photo_preview_box').css({"display":"block"});
    $('#photo_preview').css({"display":"none"});
    $('#cancel_photo_preview').css({"display":"none"});
}
}

$(document).ready(function(){
    $('#cancel_photo_preview').hide();
    $('#cancel_photo_preview').click(function(){
    $('#photo_preview').hide();
    $('#cancel_photo_preview').hide();
    $('#photo_preview_box').show();
    });
});
$('.post_textbox').each(function () {
  this.setAttribute('style', 'height:' + (this.scrollHeight) + 'px;overflow-y:hidden;text-align:' + "<?php echo lang('post_textbox_align'); ?>;");
}).on('input', function () {
  this.style.height = 'auto';
  this.style.height = (this.scrollHeight) + 'px';
});
$('.high').each(function () {
  this.setAttribute('style', 'height:' + (this.scrollHeight) + 'px;overflow-y:hidden;text-align:' + "<?php echo lang('post_textbox_align'); ?>;");
}).on('input', function () {
  this.style.height = 'auto';
  this.style.height = (this.scrollHeight) + 'px';
});
</script>
<script type="text/javascript">
function textimage(){
    var url = document.getElementById('textimgi').value;
    document.getElementsById('text')[0].style.backgroundImage = "url('" + url + "')";
}
</script>

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
	function yoruy(id) {
  var x = document.getElementById(id);
  if (x.style.display === 'none') {
    x.style.display = 'inline-block';
  } else {
    x.style.display = 'none';
  }
}
</script>
