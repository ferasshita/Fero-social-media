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
</script>

<div class="post" style="min-width: 99.5%" style="text-align:<?php echo lang('w_post_align'); ?>;direction: <?php echo lang('w_post_dir'); ?>">
<table class="WritePostUserI">
<tr>
<td style='width:50px;'>
<div class='username_OF_postImg'><img src="<?php echo $imagePath; ?>user_imgs/<?php echo $_SESSION['Userphoto']; ?>"></div>
</td>
<td style="padding: 10px 0px">
<a href="<?php echo $check_path; ?>u/<?php echo $_SESSION['Username']; ?>"><?php echo $_SESSION['Fullname']; ?></a><br/>
<button onclick="wpost_tabs(event, 'w_location')" style="width:70px;height:17px;font-size:10px;"><span class="fa fa-map-marker"> <?php echo lang('location'); ?></span></button><span class='username_OF_postTime'> &bull; @<?php echo $_SESSION['Username']; ?></span>
</td>
</table>
<div id="w_location" style="display:none;">
<span style="font-size:50px;" onclick="wpost_tabs(event, 'w_location')" class="fa fa-times"></span>
<input type="text" name="location" placeholder="Post's location..." maxlength="100" style="width:80%;padding:10px;font-size:25px;border:solid thin black;border-radius:4px;">
</div>
<div id="w_text" class="wpost_tabcontent" style="display:block;padding: 0px">
    <textarea dir="auto" id="lang_rtl_ltr" class="post_textbox" placeholder="<?php echo lang('post_textbox_placeholder'); ?>" name="post_textbox"></textarea>
</div>
<div id="w_photo" class="wpost_tabcontent">
<?php if($_SESSION['accou_typ'] == "bussiness" || $_SESSION['accou_typ'] == "cartor"){echo"<input type='number' placeholder='Price' name='pr_buss' class='flat_solid_textfield' style='color:green'>"; }?>
       <div id='photo_preview' style="margin-top: 10px;order: 1px solid rgba(0, 0, 0, 0.1);overflow: hidden;width: 100%;height: 80%;display:none;position: relative;">
       <label style="color: white">
        <button type="reset" name="reset" id="cancel_photo_preview" style="display: none"><span class="fa fa-times"></span></button>
        
       </label>
	   <div id="voty">
			</div>
       </div>

    <label>
        <input type="file" id="w_img_m" name="w_photo" accept="image/png, image/jpeg, video/mp4, video/wmp, video/ogg, audio/mp3, application/pdf" onchange="photoPreview(this);" style="display: none" />
      
    <div id='photo_preview_box' style='cursor: pointer;display:block;width:100%;height:300px;border:2px dashed rgba(78, 178, 255, 0.8);text-align:center;'>
        <span class='fa fa-image' style=' margin: 35%;font-size: 35px;color: rgba(78, 178, 255, 0.8);'><br>8Mb</span>
	</label>	
         </div>
		 <br>
<div id="fycx" style="overflow-x:scroll;white-space:nowrap;">
<label for="a"><img src="imgs/main_icons/1f3d5.png" class="img-bri" onclick="ax()"><input type="radio" style="display:none" value="e" name="img_style" id="a" checked></label>
<label for="b"><img src="imgs/main_icons/1f3d5.png"class="blur img-bri" onclick="bx()"><input type="radio" style="display:none" value="blur" name="img_style" id="b"></label>
<label for="c"><img src="imgs/main_icons/1f3d5.png"class="bright img-bri" onclick="cx()"><input type="radio" style="display:none" value="IMG_FILTER_BRIGHTNESS" name="img_style" id="c"></label>
<label for="d"><img src="imgs/main_icons/1f3d5.png"class="grey img-bri" onclick="dx()"><input type="radio" style="display:none" value="IMG_FILTER_GRAYSCALE" name="img_style" id="d"></label>
<label for="e"><img src="imgs/main_icons/1f3d5.png"class="hru img-bri" onclick="ex()"><input type="radio" style="display:none" value="hru" name="img_style" id="e"></label>
<label for="f"><img src="imgs/main_icons/1f3d5.png"class="inv img-bri" onclick="fx()"><input type="radio" style="display:none" value="IMG_FILTER_NEGATE" name="img_style" id="f"></label>
<label for="g"><img src="imgs/main_icons/1f3d5.png"class="opac img-bri" onclick="gx()"><input type="radio" style="display:none" value="opac" name="img_style" id="g"></label>
<label for="h"><img src="imgs/main_icons/1f3d5.png"class="satu img-bri" onclick="hx()"><input type="radio" style="display:none" value="satu" name="img_style" id="h"></label>
<label for="i"><img src="imgs/main_icons/1f3d5.png"class="sepia img-bri" onclick="ix()"><input type="radio" style="display:none" value="sepia" name="img_style" id="i"></label>
</div>
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
transform:rotate(270deg);
</style>
		 <div id="him">
		 <input type="range" value="0" step="0.1" class="slider" id="myRange" name="opa_img">
		 </div>
<script>
var slider = document.getElementById("myRange");
var output = document.getElementById("photo_preview_src");
output.innerHTML = slider.value;

slider.oninput = function() {
  output.style.opacity = this.value;
}
function ax() {
  var body = document.getElementById("photo_preview_src");
  var currentClass = body.className;
  body.className = currentClass == "e" ? "e" : "e";
}
function bx() {
  var body = document.getElementById("photo_preview_src");
  var currentClass = body.className;
  body.className = currentClass == "blur" ? "blur" : "blur";
}
function cx() {
  var body = document.getElementById("photo_preview_src");
  var currentClass = body.className;
  body.className = currentClass == "bright" ? "bright" : "bright";
}
function dx() {
  var body = document.getElementById("photo_preview_src");
  var currentClass = body.className;
  body.className = currentClass == "grey" ? "grey" : "grey";
}
function ex() {
  var body = document.getElementById("photo_preview_src");
  var currentClass = body.className;
  body.className = currentClass == "hru" ? "hru" : "hru";
}
function fx() {
  var body = document.getElementById("photo_preview_src");
  var currentClass = body.className;
  body.className = currentClass == "inv" ? "inv" : "inv";
}
function gx() {
  var body = document.getElementById("photo_preview_src");
  var currentClass = body.className;
  body.className = currentClass == "opac" ? "opac" : "opac";
}
function hx() {
  var body = document.getElementById("photo_preview_src");
  var currentClass = body.className;
  body.className = currentClass == "satu" ? "satu" : "satu";
}
function ix() {
  var body = document.getElementById("photo_preview_src");
  var currentClass = body.className;
  body.className = currentClass == "sepia" ? "sepia" : "sepia";
}
</script>
</div>
<div id="w_write" class="wpost_tabcontent">
<textarea placeholder="<?php echo lang('Write_a_topic'); ?>..." id="text" name="p_write"></textarea>
</div>
<div id="w_map" class="wpost_tabcontent">
<div style="width:50%;height:50%;background:white;box-shadow: 0px 0px 18px rgba(63, 81, 181, 0.16);border: 1px solid transparent;border-radius: 10px;">
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
<div id="w_story" class="wpost_tabcontent">
       <div id='photo_previewv' style="margin-top: 10px;order: 1px solid rgba(0, 0, 0, 0.1);overflow: hidden;width: 100%;height: 80%;display:none;position: relative;">
       <label style="color: white">
        <button type="reset" name="reset" id="cancel_photo_preview" style="display: none"><span class="fa fa-times"></span></button>
        
       </label>
            <img id='photo_preview_srcv' src='#' alt='your image' style='height:100%;width:100%;cursor: pointer;' />
       </div>

    <label>
        <input type="file" id="w_img_mv" name="w_photo_v" accept="image/png, image/jpeg" onchange="photoPreviewv(this);" style="display: none" />
      
    <div id='photo_preview_boxv' style='cursor: pointer;display:block;width:100%;height:300px;border:2px dashed rgba(78, 178, 255, 0.8);text-align:center;'>
        <span class='fa fa-image' style=' margin: 35%;font-size: 30px;color: rgba(78, 178, 255, 0.8);'><br>8Mb</span>
	</label>	
         </div>
		 <br>
		 <div style="overflow-x:scroll;white-space:nowrap;">
<label for="av"><img src="imgs/main_icons/1f3d5.png" class="img-bri" onclick="axv()"><input type="radio" style="display:none" value="e" name="img_stylev" id="av" checked></label>
<label for="bv"><img src="imgs/main_icons/1f3d5.png"class="blur img-bri" onclick="bxv()"><input type="radio" style="display:none" value="blur" name="img_stylev" id="bv"></label>
<label for="cv"><img src="imgs/main_icons/1f3d5.png"class="bright img-bri" onclick="cxv()"><input type="radio" style="display:none" value="bright" name="img_stylev" id="cv"></label>
<label for="dv"><img src="imgs/main_icons/1f3d5.png"class="grey img-bri" onclick="dxv()"><input type="radio" style="display:none" value="grey" name="img_stylev" id="dv"></label>
<label for="ev"><img src="imgs/main_icons/1f3d5.png"class="hru img-bri" onclick="exv()"><input type="radio" style="display:none" value="hru" name="img_stylev" id="ev"></label>
<label for="fv"><img src="imgs/main_icons/1f3d5.png"class="inv img-bri" onclick="fxv()"><input type="radio" style="display:none" value="inv" name="img_stylev" id="fv"></label>
<label for="gv"><img src="imgs/main_icons/1f3d5.png"class="opac img-bri" onclick="gxv()"><input type="radio" style="display:none" value="opac" name="img_stylev" id="gv"></label>
<label for="hv"><img src="imgs/main_icons/1f3d5.png"class="satu img-bri" onclick="hxv()"><input type="radio" style="display:none" value="satu" name="img_stylev" id="hv"></label>
<label for="iv"><img src="imgs/main_icons/1f3d5.png"class="sepia img-bri" onclick="ixv()"><input type="radio" style="display:none" value="sepia" name="img_stylev" id="iv"></label>
</div>
		 <div>
		 <input type="range" value="0" step="0.1" class="slider" id="myRangev" name="opa_img">
		 </div>
		 </label>
<script>
var slider = document.getElementById("myRangev");
var output = document.getElementById("photo_preview_srcv");
output.innerHTML = slider.value;

slider.oninput = function() {
  output.style.opacity = this.value;
}
function axv() {
  var body = document.getElementById("photo_preview_srcv");
  var currentClass = body.className;
  body.className = currentClass == "e" ? "e" : "e";
}
function bxv() {
  var body = document.getElementById("photo_preview_srcv");
  var currentClass = body.className;
  body.className = currentClass == "blur" ? "blur" : "blur";
}
function cxv() {
  var body = document.getElementById("photo_preview_srcv");
  var currentClass = body.className;
  body.className = currentClass == "bright" ? "bright" : "bright";
}
function dxv() {
  var body = document.getElementById("photo_preview_srcv");
  var currentClass = body.className;
  body.className = currentClass == "grey" ? "grey" : "grey";
}
function exv() {
  var body = document.getElementById("photo_preview_srcv");
  var currentClass = body.className;
  body.className = currentClass == "hru" ? "hru" : "hru";
}
function fxv() {
  var body = document.getElementById("photo_preview_srcv");
  var currentClass = body.className;
  body.className = currentClass == "inv" ? "inv" : "inv";
}
function gxv() {
  var body = document.getElementById("photo_preview_srcv");
  var currentClass = body.className;
  body.className = currentClass == "opac" ? "opac" : "opac";
}
function hxv() {
  var body = document.getElementById("photo_preview_srcv");
  var currentClass = body.className;
  body.className = currentClass == "satu" ? "satu" : "satu";
}
function ixv() {
  var body = document.getElementById("photo_preview_srcv");
  var currentClass = body.className;
  body.className = currentClass == "sepia" ? "sepia" : "sepia";
}
</script>
<input type="text" id="hr_sto" name="hea_wr" maxlength="100" placeholder="<?php echo lang('write_a_header_to_your_story'); ?>..." class="flat_solid_textfield">
<textarea id="stor" name="s_wr" dir="auto" class="editable high" placeholder="<?php echo lang('Write_the_story'); ?>..."></textarea>

</div>
<div id="w_link" class="wpost_tabcontent">
<input class="flat_solid_textfield" type="text" placeholder="<?php echo lang('Write_the_link_for_that_website'); ?>..." name="link">
<p><?php echo lang('hint_youtube'); ?></p>
</div>
<div id="w_movie" class="wpost_tabcontent">
       <div id='photo_previewm' style="margin-top: 10px;order: 1px solid rgba(0, 0, 0, 0.1);overflow: hidden;width: 100px;height: 100px;display:none;position: relative;">
       <label style="color: white">
        <button type="reset" name="reset" id="cancel_photo_previewm" style="display: none"><span class="fa fa-times"></span></button>
        
       </label>
            <img id='photo_preview_srcm' src='#' alt='your image' style='height:100%;cursor: pointer;' />
       </div>

    <label>
        <input type="file" name="w_photom" accept="image/png, image/jpeg" onchange="photoPreviewm(this);" style="display: none" />
      
    <div id='photo_preview_boxm' style='cursor: pointer;display:block;width:100px;height:100px;border:2px dashed rgba(78, 178, 255, 0.8);text-align:center;'>
        <span class='fa fa-image' style=' margin: 35%;font-size: 30px;color: rgba(78, 178, 255, 0.8);'><br>8Mb</span>
	</label>	
         </div>

		 </div>
		 <div align="center" id="w_moviep" class="wpost_tabcontent">
		 <input type="text"  name="hea_wrm" id="hr_mov" maxlength="100" placeholder="<?php echo lang('write_a_header_to_your_story'); ?>..." class="flat_solid_textfield">
      <div id='photo_previewi' style="margin-top: 10px;order: 1px solid rgba(0, 0, 0, 0.1);overflow: hidden;width: 30%;height: 30%;display:none;position: relative;">
       <label style="color: white">
        <button type="reset" name="reset" id="cancel_photo_previewi" style="display: none"><span class="fa fa-times"></span></button>
        
       </label>
	   <div id="dyeft">
	   </div>
       </div>

    <label>
        <input type="file" name="w_movie" accept="video/mp4, video/wmp, video/ogg, audio/wav, audio/mp3, application/pdf" onchange="photoPreviewi(this);" style="display: none" />
      
    <div id='photo_preview_boxi' style='cursor: pointer;display:block;width:200px;height:30%;border:2px dashed rgba(78, 178, 255, 0.8);text-align:center;'>
        <span class='fa fa-film' style=' margin: 35%;font-size: 30px;color: rgba(78, 178, 255, 0.8);'><br>2Gb</span>
	</label>	
         </div>
</div>
<div id="w_smartbt" class="wpost_tabcontent">
<input class="flat_solid_textfield" id="s_li" type="text" placeholder="<?php echo lang('smart_link'); ?>..." name="s_bt">
<input class="flat_solid_textfield" id="s_mi" type="text" placeholder="<?php echo lang('smart_text'); ?>..." class="flat_solid_textfield" name="s_op">
</div>
<div id="w_title" class="wpost_tabcontent">
<input type="text" name="w_title" maxlength="100" id="your_title" placeholder="<?php echo lang('w_title_inputText'); ?>" class="flat_solid_textfield"></input>
<input type="hidden" name="check_path" value="<?php echo $check_path; ?>" />
/ 100
</div>
<div id="w_poll" class="wpost_tabcontent">
<input align="center" name="pol_ques" id="poll_qu" type="text" placeholder="Question" class="flat_solid_textfield">
<input name="poll_ye" type="text" value="Yes" class="flat_solid_textfield"><input name="poll_no" type="text" value="No" class="flat_solid_textfield">
</div>
<div id="ic" style="display:none;" class="wpost_tabcontent">

<p><?php echo lang('Payment_methods'); ?></p>
<div id="paypal-button-container"></div>
<script src="https://www.paypal.com/sdk/js?client-id=sb&currency=USD" data-sdk-integration-source="button-factory"></script>
<script>
  paypal.Buttons({
      style: {
          shape: 'pill',
          color: 'blue',
          layout: 'vertical',
          label: 'pay',
          
      },
      createOrder: function(data, actions) {
          return actions.order.create({
              purchase_units: [{
                  amount: {
                      value: '1'
                  }
              }]
          });
      },
      onApprove: function(data, actions) {
          return actions.order.capture().then(function(details) {
              alert('Transaction completed by ' + details.payer.name.given_name + '!');
          });
      }
  }).render('#paypal-button-container');
</script>

<img src="imgs/payment/paypal.jpg" class="paym" alt="paypal">
<img src="imgs/payment/visa.png" class="paym" alt="visa">
<img src="imgs/payment/matercard.png" class="paym" alt="mastercard">
<img src="imgs/payment/discover.jpg" class="paym" alt="discover">
</div>
<div>
<ul class="wpost_tab">
    <li id="wt_text" style="float:<?php echo lang('w_post_li'); ?>;">
    <button class="wpost_tablinks" onclick="wpost_tabs(event, 'w_text')"><span style="color: cornflowerblue;margin: 0px 5px;" class="fa fa-pencil"></span> <?php echo lang('wpost_write'); ?></button>
    </li>
    <li id="wt_photo" style="float:<?php echo lang('w_post_li'); ?>;">
    <button class="wpost_tablinks" onclick="wpost_tabs(event, 'w_photo')"><span style="color: #4CAF50;margin: 0px 5px;" class="fa fa-camera"></span> <?php echo lang('wpost_photo_pdf'); ?></button>
    </li>
	   <li id="wt_write" style="float:<?php echo lang('w_post_li'); ?>;">
    <button class="wpost_tablinks" onclick="wpost_tabs(event, 'w_write')"><span style="color: brown;margin: 0px 5px;" class="fa fa-map"></span> <?php echo lang('wpost_text'); ?></button>
    </li>
	<li id="wt_story" style="float:<?php echo lang('w_post_li'); ?>;">
    <button class="wpost_tablinks" onclick="wpost_tabs(event, 'w_story')"><span style="color: red;margin: 0px 5px;" class="fa fa-book"></span> <?php echo lang('story'); ?></button>
    </li>
    <li id="wt_location" style="float:<?php echo lang('w_post_li'); ?>;">
    <button class="wpost_tablinks" onclick="wpost_tabs(event, 'w_title')"><span style="color: #ffb300;margin: 0px 5px;" class="fa fa-quote-right"></span> <?php echo lang('wpost_title'); ?></button>
    </li>
	<li id="wt_link" style="float:<?php echo lang('w_post_li'); ?>;">
    <button class="wpost_tablinks" onclick="wpost_tabs(event, 'w_link')"><span style="color: black;margin: 0px 5px;" class="fa fa-link"></span> <?php echo lang('link'); ?></button>
    </li>
	<li id="wt_movie" style="float:<?php echo lang('w_post_li'); ?>;">
    <button class="wpost_tablinks" onclick="wpost_tabs(event, 'w_movie')"><span style="color: blue;margin: 0px 5px;" class="fa fa-film"></span> <?php echo lang('movie'); ?></button>
    </li>
		<li id="wt_map" style="float:<?php echo lang('w_post_li'); ?>;">
    <button class="wpost_tablinks" onclick="wpost_tabs(event, 'w_map')"><span style="color: pink;margin: 0px 5px;"><b>?</b></span> <?php echo lang('quiz'); ?></button>
    </li>
	<li id="wt_poll" style="float:<?php echo lang('w_post_li'); ?>;">
    <button class="wpost_tablinks" onclick="wpost_tabs(event, 'w_poll')"><span style="color: green;margin: 0px 5px;">&#xf682;</span> <?php echo lang('poll'); ?></button>
    </li>
		<?php if($_SESSION['accou_typ'] == "bussiness" || $_SESSION['accou_typ'] == "cartor"){echo"<li id='wt_smartbt' style='float:"; echo lang('w_post_li') ;echo"'>
    <button class='wpost_tablinks' onclick=\"wpost_tabs(event, 'w_smartbt')\"><span class='fa fa-user' style='color: orange;margin: 0px 5px;'></span>"; echo lang('stmrbt'); echo"</button>
    </li>";} ?>
    <li style="float:<?php echo lang('w_post_li2'); ?>;">
    <input class="default_flat_btn" type="submit" name="post_now" value="<?php echo lang('post_now'); ?>" style="margin: 5px;padding: 8px 10px;" />
    </li>
    <li style="float:<?php echo lang('w_post_li2'); ?>;">
        <select id="p_privacy" style="background:white;margin: 5px; padding: 0px 10px; max-width: 110px; height: 35px;" name="w_privacy">
            <option selected=""><?php echo lang('wpr_public'); ?></option>
            <option><?php echo lang('wpr_followers'); ?></option>
            <option><?php echo lang('wpr_onlyme'); ?></option>
            <option value="<?php echo lang('wpr_ads'); ?>"><?php echo lang('wpr_ads'); ?></option>
        </select>
    </li>
</ul>
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
        $('#w_text').show();
        $('.post_textbox').focus();
        $('#w_photo').slideUp();
        $('#w_write').slideUp();
        $('#w_story').slideUp();
		$('#photo_preview_srci').val('');
		$('#photo_preview_srcm').val('');
		$('#hr_sto').val('');
		$('#text').val('');
		$('#ques').val('');
		$('#ques1').val('');
		$('#ques2').val('');
		$('#poll_qu').val('');
		$('#ques3').val('');
		$('#stor').val('');
		$('#hr_mov').val('');
		$('#w_nav_text').slideUp(300);
		$('#w_movie').slideUp(300);
		$('#w_moviep').slideUp(300);
		$('#w_map').slideUp(300);
		$('#w_poll').slideUp(300);
		$('#men').slideUp(300);
		$('#w_link').slideUp(300);
		$('#content').css({'margin-<?php echo lang('w_post_align'); ?>':'0px'});
    break;
    case "w_location":
        $('#w_text').slideUp(300);
        $('#w_location').slideToggle(300);
        $('.post_textbox').focus();
        $('#w_photo').slideUp();
        $('#w_write').slideUp();
        $('#w_story').slideUp();
		$('#w_nav_text').slideUp(300);
		$('#w_movie').slideUp(300);
		$('#w_moviep').slideUp(300);
		$('#w_map').slideUp(300);
		$('#w_poll').slideUp(300);
		$('#men').slideUp(300);
		$('#w_link').slideUp(300);
		$('#content').css({'margin-<?php echo lang('w_post_align'); ?>':'0px'});
    break;
    case "w_photo":
        $('#w_photo').slideToggle(300);
        $('#w_write').slideUp();
        $('#w_story').slideUp();
		$('#w_map').slideUp(300);
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
		$('#w_nav_text').slideUp(300);
		$('#w_poll').slideUp(300);
		$('#w_link').slideUp(300);
		$('#men').slideUp(300);
		$('#content').css({'margin-<?php echo lang('w_post_align'); ?>':'0px'});
    break;
    case "w_title":
        $('#w_title').slideToggle(300);
    break;
    case "w_smartbt":
        $('#w_smartbt').slideToggle(300);
    break;
	case "w_write":
		$('#w_write').slideToggle(300);
        $('.text').focus();
        $('#w_photo').slideUp();
        $('#w_story').slideUp();
		$('#w_movie').slideUp(300);
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
		$('#w_map').slideUp(300);
		$('#w_link').slideUp(300);
        $('#w_nav_text').slideToggle(300);
        $('#content').css({'margin-<?php echo lang('w_post_align'); ?>':'300px'});
    break;
	case "w_story":
		$('#w_story').slideToggle(300);
        $('#w_photo').slideUp(300);
		$('#w_write').slideUp();
		$('#men').slideUp(300);
		$('#w_link').slideUp(300);
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
		$('#w_map').slideUp(300);
		$('#w_nav_text').slideUp(300);
		$('#content').css({'margin-<?php echo lang('w_post_align'); ?>':'0px'});
        ;
    break;
	case "w_link":
		$('#w_story').slideUp();
        $('#w_photo').slideUp();
		$('#w_write').slideUp();
		$('#men').slideUp(300);
		//////////////////////
		$('#photo_preview_srci').val('');
		$('#photo_preview_srcm').val('');
		$('#hr_sto').val('');
		$('#text').val('');
		$('#stor').val('');
		$('#w_img_m').val('');
		$('#ques').val('');
		$('#poll_qu').val('');
		$('#ques1').val('');
		$('#ques2').val('');
		$('#ques3').val('');
		$('#hr_mov').val('');
		//////////////////////
		$('#w_link').slideToggle(300);
		$('#w_movie').slideUp(300);
		$('#w_moviep').slideUp(300);
		$('#w_poll').slideUp(300);
		$('#w_map').slideUp(300);
		$('#w_nav_text').slideUp(300);
		$('#content').css({'margin-<?php echo lang('w_post_align'); ?>':'0px'});
        ;
    break;
		case "w_poll":
		$('#w_story').slideUp();
        $('#w_photo').slideUp();
		$('#w_write').slideUp();
		$('#men').slideUp(300);
		//////////////////////
		$('#photo_preview_srci').val('');
		$('#photo_preview_srcm').val('');
		$('#hr_sto').val('');
		$('#text').val('');
		$('#stor').val('');
		$('#w_img_m').val('');
		$('#poll_qu').val('');
		$('#ques').val('');
		$('#ques1').val('');
		$('#ques2').val('');
		$('#ques3').val('');
		$('#hr_mov').val('');
		//////////////////////
		$('#w_link').slideUp(300);
		$('#w_poll').slideToggle(300);
		$('#w_movie').slideUp(300);
		$('#w_moviep').slideUp(300);
		$('#w_map').slideUp(300);
		$('#w_nav_text').slideUp(300);
		$('#content').css({'margin-<?php echo lang('w_post_align'); ?>':'0px'});
        ;
    break;
	case "w_movie":
		$('#w_story').slideUp();
        $('#w_photo').slideUp();
		$('#w_write').slideUp();
		$('#men').slideUp(300);
        $('#w_title').slideUp();
		$('#w_link').slideUp(300);
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
		$('#w_link').slideUp(300);
		$('#w_map').slideToggle(300);
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
		$('#w_poll').slideUp(300);
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
function photoPreview(input) {
if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
    $('#photo_preview_box').css({"display":"none"});
    $('#photo_preview').css({"display":"block"});
    $('#cancel_photo_preview').css({"display":"block"});
	//check type
	
        // get the file name, possibly with path (depends on browser)
        var filename = $("#w_img_m").val();

        // Use a regular expression to trim everything before final dot
        var extension = filename.replace(/^.*\./, '');

        // Iff there is no dot anywhere in filename, we would have extension == filename,
        // so we account for this possibility now
        if (extension == filename) {
            extension = '';
        } else {
            // if there is an extension, we convert to lower case
            // (N.B. this conversion will not effect the value of the extension
            // on the file upload.)
            extension = extension.toLowerCase();
        }

        switch (extension) {
            case 'jpg':
            case 'jpeg':
            case 'png':
    $('#voty').html("<img id='photo_preview_src' src='"+e.target.result+"' alt='your image' style='height:100%;width:100%;cursor: pointer;object-fit:cover;object-position:50% 50%;' />");
    $('#fycx').show();
    $('#him').show();
            // uncomment the next line to allow the form to submitted in this case:
       break;
	        case 'mp4':
            case 'ogg':
            case 'wmp':
	    $('#voty').html("<video id='photo_preview_srcvo' src='"+e.target.result+"' style='height:100%;cursor: pointer;object-fit:cover;'></video>");
         $('#fycx').hide();   
         $('#him').hide();   
			// uncomment the next line to allow the form to submitted in this case:
       break;
	   	    case 'mp3':
            case 'wav':
	    $('#voty').html("<audio id='photo_preview_srcvo' controls autoplay loop src='"+e.target.result+"' style='height:100%;cursor: pointer;object-fit:cover;width:100%'></audio>");
         $('#fycx').hide();
$('#him').hide();		 
			// uncomment the next line to allow the form to submitted in this case:
       break;
	   	    case 'pdf':
	    $('#voty').html("<embed id='photo_preview_srcvo' type='application/pdf' src='"+e.target.result+"' style='height:100%;cursor: pointer;width:100%'></embed>");
          $('#fycx').hide();
$('#him').hide();		  
			// uncomment the next line to allow the form to submitted in this case:
       break;

            default:
                // Cancel the form submission
                submitEvent.preventDefault();
        }
	//check type end
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
////////////////////////////////////////
function photoPreviewi(input) {
if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
    $('#photo_preview_boxi').css({"display":"none"});
    $('#photo_previewi').css({"display":"block"});
    $('#cancel_photo_previewi').css({"display":"block"});
		//check type
	
        // get the file name, possibly with path (depends on browser)
        var filename = $("#w_movie").val();

        // Use a regular expression to trim everything before final dot
        var extension = filename.replace(/^.*\./, '');

        // Iff there is no dot anywhere in filename, we would have extension == filename,
        // so we account for this possibility now
        if (extension == filename) {
            extension = '';
        } else {
            // if there is an extension, we convert to lower case
            // (N.B. this conversion will not effect the value of the extension
            // on the file upload.)
            extension = extension.toLowerCase();
        }

        switch (extension) {
	        case 'mp4':
            case 'ogg':
            case 'wmp':
	    $('#dyeft').html("<video id='photo_preview_srcvi' src='"+e.target.result+"' style='height:100%;cursor: pointer;object-fit:cover;'></video>"); 
			// uncomment the next line to allow the form to submitted in this case:
       break;
	   	    case 'mp3':
            case 'wav':
	    $('#dyeft').html("<audio id='photo_preview_srcvi' controls autoplay loop src='"+e.target.result+"' style='height:100%;cursor: pointer;object-fit:cover;width:100%'></audio>");	 
			// uncomment the next line to allow the form to submitted in this case:
       break;
	   	    case 'pdf':
	    $('#dyeft').html("<embed id='photo_preview_srcvi' type='application/pdf' src='"+e.target.result+"' style='height:100%;cursor: pointer;width:100%'></embed>");	  
			// uncomment the next line to allow the form to submitted in this case:
       break;
        }
	//check type end
    }

    reader.readAsDataURL(input.files[0]);
}else{
    $('#photo_preview_boxi').css({"display":"block"});
    $('#photo_previewi').css({"display":"none"});
    $('#cancel_photo_previewi').css({"display":"none"});
}
}
$(document).ready(function(){
    $('#cancel_photo_previewi').hide();
    $('#cancel_photo_previewi').click(function(){
    $('#photo_previewi').hide();
    $('#cancel_photo_previewi').hide();
    $('#photo_preview_boxi').show();
    });
});
////////////////////////////////////
function photoPreviewm(input) {
if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
    $('#photo_preview_srcm').attr('src', e.target.result);
    $('#photo_preview_boxm').css({"display":"none"});
    $('#photo_previewm').css({"display":"block"});
    $('#cancel_photo_previewm').css({"display":"block"});
    }

    reader.readAsDataURL(input.files[0]);
}else{
    $('#photo_preview_boxm').css({"display":"block"});
    $('#photo_previewm').css({"display":"none"});
    $('#cancel_photo_previewm').css({"display":"none"});
}
}
$(document).ready(function(){
    $('#cancel_photo_previewm').hide();
    $('#cancel_photo_previewm').click(function(){
    $('#photo_previewm').hide();
    $('#cancel_photo_previewm').hide();
    $('#photo_preview_boxm').show();
    });
});
///////////////////////////////////
////////////////////////////////////
function photoPreviewv(input) {
if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
    $('#photo_preview_srcv').attr('src', e.target.result);
    $('#photo_preview_boxv').css({"display":"none"});
    $('#photo_previewv').css({"display":"block"});
    $('#cancel_photo_previewv').css({"display":"block"});
    }

    reader.readAsDataURL(input.files[0]);
}else{
    $('#photo_preview_boxv').css({"display":"block"});
    $('#photo_previewv').css({"display":"none"});
    $('#cancel_photo_previewv').css({"display":"none"});
}
}
$(document).ready(function(){
    $('#cancel_photo_previewv').hide();
    $('#cancel_photo_previewv').click(function(){
    $('#photo_previewv').hide();
    $('#cancel_photo_previewv').hide();
    $('#photo_preview_boxv').show();
    });
});
///////////////////////////////////
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
<script>
function textimage(input) {
if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
    $('#text').css({"background-image":"url('"+e.target.result+"')"});
    }

    reader.readAsDataURL(input.files[0]);
}
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