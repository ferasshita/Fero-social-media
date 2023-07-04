<?php
session_start();
include "../config/connect.php";
$post_id = rand(0,9999999)+time();
$p_author_id = $_SESSION['id'];
$p_author = $_SESSION['Fullname'];
$p_author_photo = $_SESSION['Userphoto'];
$p_time = time();
$p_img = $_FILES["w_photo"]["name"];
$p_content = filter_var(htmlspecialchars($_POST['post_textbox']),FILTER_SANITIZE_STRING);
$p_write = filter_var(htmlspecialchars($_POST['p_write']),FILTER_SANITIZE_STRING);
$p_title = filter_var(htmlspecialchars($_POST['w_title']), FILTER_SANITIZE_STRING);
$check_path = filter_var(htmlspecialchars($_POST['check_path']), FILTER_SANITIZE_STRING);
switch (filter_var(htmlspecialchars($_POST['w_privacy']),FILTER_SANITIZE_STRING)) {
case lang('wpr_public'):
    $p_privacy = "0";
    break;
case lang('wpr_followers'):
    $p_privacy = "1";
    break;
case lang('wpr_onlyme'):
    $p_privacy = "2";
    break;
case lang('wpr_ads'):
    $p_privacy = "3";
    break;
}

$s_bt = filter_var(htmlspecialchars($_POST['s_bt']), FILTER_SANITIZE_STRING);
$s_op = filter_var(htmlspecialchars($_POST['s_op']), FILTER_SANITIZE_STRING);
$font = filter_var(htmlspecialchars($_POST['font']), FILTER_SANITIZE_STRING);
$question = filter_var(htmlspecialchars($_POST['question']), FILTER_SANITIZE_STRING);
$pr_buss = filter_var(htmlspecialchars($_POST['pr_buss']), FILTER_SANITIZE_STRING);
$op1 = filter_var(htmlspecialchars($_POST['op1']), FILTER_SANITIZE_STRING);
$op2 = filter_var(htmlspecialchars($_POST['op2']), FILTER_SANITIZE_STRING);
$op3 = filter_var(htmlspecialchars($_POST['op3']), FILTER_SANITIZE_STRING);
$pol_ques = filter_var(htmlspecialchars($_POST['pol_ques']), FILTER_SANITIZE_STRING);
$poll_ye = filter_var(htmlspecialchars($_POST['poll_ye']), FILTER_SANITIZE_STRING);
$poll_no = filter_var(htmlspecialchars($_POST['poll_no']), FILTER_SANITIZE_STRING);
$ch_co = filter_var(htmlspecialchars($_POST['num_cor']), FILTER_SANITIZE_STRING);
$color = filter_var(htmlspecialchars($_POST['color']), FILTER_SANITIZE_STRING);
$img_styv = filter_var(htmlspecialchars($_POST['img_stylev']), FILTER_SANITIZE_STRING);
$img_sty = filter_var(htmlspecialchars($_POST['img_style']), FILTER_SANITIZE_STRING);
$img_opacity = filter_var(htmlspecialchars($_POST['opa_img']), FILTER_SANITIZE_STRING);
$long = filter_var(htmlspecialchars($_POST['long']), FILTER_SANITIZE_STRING);
$lat = filter_var(htmlspecialchars($_POST['lat']), FILTER_SANITIZE_STRING);
$location = filter_var(htmlspecialchars($_POST['location']), FILTER_SANITIZE_STRING);
$hea_wr = filter_var(htmlspecialchars($_POST['hea_wr']), FILTER_SANITIZE_STRING);
$hea_wrm = filter_var(htmlspecialchars($_POST['hea_wrm']), FILTER_SANITIZE_STRING);
$s_wr = filter_var(htmlspecialchars($_POST['s_wr']), FILTER_SANITIZE_STRING);
$link = filter_var(htmlspecialchars($_POST['link']), FILTER_SANITIZE_STRING);
$imgtext = $_FILES["textimg"]["name"];
$w_photo_v = $_FILES["w_photo_v"]["name"];
$mov = $_FILES["w_movie"]["name"];
$img_mov = $_FILES["w_photom"]["name"];

    //================[ if image not empty ]================
if (!empty($s_wr)) {
		$post_fileName = $_FILES["w_photo_v"]["name"];
$post_fileTmpLoc = $_FILES["w_photo_v"]["tmp_name"];
$post_fileType = $_FILES["w_photo_v"]["type"];
$post_fileSize = $_FILES["w_photo_v"]["size"]; 
$post_fileErrorMsg = $_FILES["w_photo_v"]["error"];
$post_fileName = preg_replace('#[^a-z.0-9]#i', '', $post_fileName); 
$post_kaboom = explode(".", $post_fileName);
$post_fileExt = end($post_kaboom);
$post_fileName = time().rand().".".$post_fileExt;
    //================[ if not selected an image ]================
if (!$post_fileTmpLoc) {
echo "
<p id='error_msg' onclick='hideMsg()'>
".lang('errorPost_n2')."
</p>
";
}else{
    //================[ if image size more than 8Mb ]================
     if($post_fileSize > 8242880) {
    echo "
<p id='error_msg' onclick='hideMsg()'>
".lang('errorPost_n3')."
</p>
";
unlink($post_fileTmpLoc); 
} else {
    //================[ if image format not supported ]================
if (!preg_match("/.(jpeg|jpg|png)$/i", $post_fileName) ) { 
echo "
<p id='error_msg' onclick='hideMsg()'>
".lang('errorPost_n4')."
</p>
"; 
     unlink($post_fileTmpLoc);
} else {
    //================[ if an error was found ]================
if ($post_fileErrorMsg == 1) {
    echo "
<p id='error_msg' onclick='hideMsg()'>
".lang('errorPost_n5')."
</p>
";
}else{
    //================[ check image path ]================
if (is_dir("../imgs/user_post_imgstor/")) {
    $imgsPath = "../imgs/user_post_imgstor/";
}else{
    $imgsPath = "imgs/user_post_imgstor/";
}
$post_moveResult = move_uploaded_file($post_fileTmpLoc, $imgsPath."$post_fileName");
    //================[ if image uploaded successfuly ]================
if ($post_moveResult != true) {
    echo "
<p id='error_msg' onclick='hideMsg()'>
".lang('errorPost_n6')."
</p>
";
}else{
    $p_imgi = "user_post_imgstor/".$post_fileName;
}
$post_fileName = $_FILES["w_photo_v"]["name"];
$iptdbsql = "INSERT INTO wpost
(post_id,author_id,post_time,post_content,p_title,p_privacy,hea_wr,s_bt,s_op,s_wr,img_sty,w_photo_v,location)
VALUES
( :post_id, :p_author_id, :p_time, :p_content, :p_title, :p_privacy, :hea_wr, :s_bt, :s_op, :s_wr, :img_styv, :p_imgi, :location)
";
$insert_post_toDB = $conn->prepare($iptdbsql);
$insert_post_toDB->bindParam(':post_id', $post_id,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':p_author_id', $p_author_id,PDO::PARAM_INT);
$insert_post_toDB->bindParam(':p_time', $p_time,PDO::PARAM_INT);
$insert_post_toDB->bindParam(':p_content', $p_content,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':p_title', $p_title,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':p_privacy', $p_privacy,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':s_bt', $s_bt,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':location', $location,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':s_op', $s_op,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':img_styv', $img_styv,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':hea_wr', $hea_wr,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':s_wr', $s_wr,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':p_imgi', $p_imgi,PDO::PARAM_STR);
$insert_post_toDB->execute();
}
}}}}
elseif(!empty($mov)){
			$post_fileName = $_FILES["w_photom"]["name"];
$post_fileTmpLoc = $_FILES["w_photom"]["tmp_name"];
$post_fileType = $_FILES["w_photom"]["type"];
$post_fileSize = $_FILES["w_photom"]["size"]; 
$post_fileErrorMsg = $_FILES["w_photom"]["error"];
$post_fileName = preg_replace('#[^a-z.0-9]#i', '', $post_fileName); 
$post_kaboom = explode(".", $post_fileName);
$post_fileExt = end($post_kaboom);
$post_fileName = time().rand().".".$post_fileExt;
    //================[ if not selected an image ]================
if (!$post_fileTmpLoc) {
echo "
<p id='error_msg' onclick='hideMsg()'>
".lang('errorPost_n2')."
</p>
";
}else{
    //================[ if image size more than 8Mb ]================
     if($post_fileSize > 8242880) {
    echo "
<p id='error_msg' onclick='hideMsg()'>
".lang('errorPost_n3')."
</p>
";
unlink($post_fileTmpLoc); 
} else {
    //================[ if image format not supported ]================
if (!preg_match("/.(jpeg|jpg|png|mp4|ogg|wbm)$/i", $post_fileName) ) { 
echo "
<p id='error_msg' onclick='hideMsg()'>
".lang('errorPost_n4')."
</p>
"; 
     unlink($post_fileTmpLoc);
} else {
    //================[ if an error was found ]================
if ($post_fileErrorMsg == 1) {
    echo "
<p id='error_msg' onclick='hideMsg()'>
".lang('errorPost_n5')."
</p>
";
}else{
    //================[ check image path ]================
if (is_dir("../imgs/photomov/")) {
    $imgsPath = "../imgs/photomov/";
}else{
    $imgsPath = "imgs/photomov/";
}
$post_moveResult = move_uploaded_file($post_fileTmpLoc, $imgsPath."$post_fileName");
    //================[ if image uploaded successfuly ]================
if ($post_moveResult != true) {
    echo "
<p id='error_msg' onclick='hideMsg()'>
".lang('errorPost_n6')."
</p>
";
}else{
    $img_mov = "photomov/".$post_fileName;
}
			$post_fileName = $_FILES["w_movie"]["name"];
$post_fileTmpLoc = $_FILES["w_movie"]["tmp_name"];
$post_fileType = $_FILES["w_movie"]["type"];
$post_fileSize = $_FILES["w_movie"]["size"]; 
$post_fileErrorMsg = $_FILES["w_movie"]["error"];
$post_fileName = preg_replace('#[^a-z.0-9]#i', '', $post_fileName); 
$post_kaboom = explode(".", $post_fileName);
$post_fileExt = end($post_kaboom);
$post_fileName = time().rand().".".$post_fileExt;
    //================[ if not selected an image ]================
if (!$post_fileTmpLoc) {
echo "
<p id='error_msg' onclick='hideMsg()'>
".lang('errorPost_n2')."
</p>
";
}else{
    //================[ if image size more than 8Mb ]================
     if($post_fileSize > 17179869184) {
    echo "
<p id='error_msg' onclick='hideMsg()'>
".lang('errorPost_n3')."
</p>
";
unlink($post_fileTmpLoc); 
} else {
    //================[ if image format not supported ]================
if (!preg_match("/.(mp4|ogg|wbm|mp3|wav|pdf)$/i", $post_fileName) ) { 
echo "
<p id='error_msg' onclick='hideMsg()'>
".lang('errorPost_n4')."
</p>
"; 
     unlink($post_fileTmpLoc);
} else {
    //================[ if an error was found ]================
if ($post_fileErrorMsg == 1) {
    echo "
<p id='error_msg' onclick='hideMsg()'>
".lang('errorPost_n5')."
</p>
";
}else{
    //================[ check image path ]================
if (is_dir("../imgs/movie/")) {
    $imgsPath = "../imgs/movie/";
}else{
    $imgsPath = "imgs/movie/";
}
$post_moveResult = move_uploaded_file($post_fileTmpLoc, $imgsPath."$post_fileName");
    //================[ if image uploaded successfuly ]================
if ($post_moveResult != true) {
    echo "
<p id='error_msg' onclick='hideMsg()'>
".lang('errorPost_n6')."
</p>
";
}else{
    $mov = "movie/".$post_fileName;
}
$iptdbsql = "INSERT INTO wpost
(post_id,author_id,post_img,post_time,post_content,p_title,p_privacy,hea_wrm,s_bt,s_op,movie,photomov,location)
VALUES
( :post_id, :p_author_id, :p_img, :p_time, :p_content, :p_title, :p_privacy, :hea_wrm, :s_bt, :s_op, :mov, :img_mov, :location)
";
$insert_post_toDB = $conn->prepare($iptdbsql);
$insert_post_toDB->bindParam(':post_id', $post_id,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':p_author_id', $p_author_id,PDO::PARAM_INT);
$insert_post_toDB->bindParam(':p_img', $p_img,PDO::PARAM_INT);
$insert_post_toDB->bindParam(':p_time', $p_time,PDO::PARAM_INT);
$insert_post_toDB->bindParam(':p_content', $p_content,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':p_title', $p_title,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':p_privacy', $p_privacy,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':location', $location,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':s_bt', $s_bt,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':s_op', $s_op,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':hea_wrm', $hea_wrm,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':mov', $mov,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':img_mov', $img_mov,PDO::PARAM_STR);
$insert_post_toDB->execute();
}}}}}}}}}elseif(!empty($question)){
	$iptdbsql = "INSERT INTO wpost
(post_id,author_id,post_time,post_content,p_title,p_privacy,s_bt,s_op,question,op1,op2,op3,ch_co,location)
VALUES
( :post_id, :p_author_id, :p_time, :p_content, :p_title, :p_privacy, :s_bt, :s_op, :question, :op1, :op2, :op3, :ch_co, :location)
";
$insert_post_toDB = $conn->prepare($iptdbsql);
$insert_post_toDB->bindParam(':post_id', $post_id,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':p_author_id', $p_author_id,PDO::PARAM_INT);
$insert_post_toDB->bindParam(':p_time', $p_time,PDO::PARAM_INT);
$insert_post_toDB->bindParam(':p_content', $p_content,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':p_title', $p_title,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':p_privacy', $p_privacy,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':location', $location,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':s_bt', $s_bt,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':s_op', $s_op,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':question', $question,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':op1', $op1,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':op2', $op2,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':op3', $op3,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':ch_co', $ch_co,PDO::PARAM_STR);
$insert_post_toDB->execute();
}
elseif (!empty($p_write)){
	if (!empty($imgtext)){
$post_fileName = $_FILES["textimg"]["name"];
$post_fileTmpLoc = $_FILES["textimg"]["tmp_name"];
$post_fileType = $_FILES["textimg"]["type"];
$post_fileSize = $_FILES["textimg"]["size"]; 
$post_fileErrorMsg = $_FILES["textimg"]["error"];
$post_fileName = preg_replace('#[^a-z.0-9]#i', '', $post_fileName); 
$post_kaboom = explode(".", $post_fileName);
$post_fileExt = end($post_kaboom);
$post_fileName = time().rand().".".$post_fileExt;
    //================[ if not selected an image ]================
if (!$post_fileTmpLoc) {
echo "
<p id='error_msg' onclick='hideMsg()'>
".lang('errorPost_n2')."
</p>
";
}else{
    //================[ if image size more than 8Mb ]================
     if($post_fileSize > 8242880) {
    echo "
<p id='error_msg' onclick='hideMsg()'>
".lang('errorPost_n3')."
</p>
";
unlink($post_fileTmpLoc); 
} else {
    //================[ if image format not supported ]================
if (!preg_match("/.(jpeg|jpg|png)$/i", $post_fileName) ) { 
echo "
<p id='error_msg' onclick='hideMsg()'>
".lang('errorPost_n4')."
</p>
"; 
     unlink($post_fileTmpLoc);
} else {
    //================[ if an error was found ]================
if ($post_fileErrorMsg == 1) {
    echo "
<p id='error_msg' onclick='hideMsg()'>
".lang('errorPost_n5')."
</p>
";
}else{
    //================[ check image path ]================
if (is_dir("../imgs/img_text_post/")) {
    $imgsPath = "../imgs/img_text_post/";
}else{
    $imgsPath = "imgs/img_text_post/";
}
$post_moveResult = move_uploaded_file($post_fileTmpLoc, $imgsPath."$post_fileName");
    //================[ if image uploaded successfuly ]================
if ($post_moveResult != true) {
    echo "
<p id='error_msg' onclick='hideMsg()'>
".lang('errorPost_n6')."
</p>
";
}else{
    $imgtext = "img_text_post/".$post_fileName;
}
$iptdbsql = "INSERT INTO wpost
(post_id,author_id,post_time,post_content,p_title,p_privacy,p_write,s_bt,s_op,color,font,imgtext,location)
VALUES
( :post_id, :p_author_id, :p_time, :p_content, :p_title, :p_privacy, :p_write, :s_bt, :s_op, :color, :font, :imgtext, :location)
";
$insert_post_toDB = $conn->prepare($iptdbsql);
$insert_post_toDB->bindParam(':post_id', $post_id,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':p_author_id', $p_author_id,PDO::PARAM_INT);
$insert_post_toDB->bindParam(':p_time', $p_time,PDO::PARAM_INT);
$insert_post_toDB->bindParam(':p_content', $p_content,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':p_title', $p_title,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':p_privacy', $p_privacy,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':p_write', $p_write,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':s_bt', $s_bt,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':location', $location,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':s_op', $s_op,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':color', $color,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':font', $font,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':imgtext', $imgtext,PDO::PARAM_STR);
$insert_post_toDB->execute();
	}}}}}else{
		$iptdbsql = "INSERT INTO wpost
(post_id,author_id,post_time,post_content,p_title,p_privacy,p_write,s_bt,s_op,color,font,location)
VALUES
( :post_id, :p_author_id, :p_time, :p_content, :p_title, :p_privacy, :p_write, :s_bt, :s_op, :color, :font, :location)
";
$insert_post_toDB = $conn->prepare($iptdbsql);
$insert_post_toDB->bindParam(':post_id', $post_id,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':p_author_id', $p_author_id,PDO::PARAM_INT);
$insert_post_toDB->bindParam(':p_time', $p_time,PDO::PARAM_INT);
$insert_post_toDB->bindParam(':p_content', $p_content,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':p_title', $p_title,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':p_privacy', $p_privacy,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':p_write', $p_write,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':location', $location,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':s_bt', $s_bt,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':s_op', $s_op,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':color', $color,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':font', $font,PDO::PARAM_STR);
$insert_post_toDB->execute();
	}
	}
elseif (!empty($link)){
$iptdbsql = "INSERT INTO wpost
(post_id,author_id,post_time,post_content,p_title,p_privacy,s_bt,s_op,link,location)
VALUES
( :post_id, :p_author_id, :p_time, :p_content, :p_title, :p_privacy, :s_bt, :s_op, :link, :location)
";
$insert_post_toDB = $conn->prepare($iptdbsql);
$insert_post_toDB->bindParam(':post_id', $post_id,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':p_author_id', $p_author_id,PDO::PARAM_INT);
$insert_post_toDB->bindParam(':p_time', $p_time,PDO::PARAM_INT);
$insert_post_toDB->bindParam(':p_content', $p_content,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':location', $location,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':p_title', $p_title,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':p_privacy', $p_privacy,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':s_bt', $s_bt,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':s_op', $s_op,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':link', $link,PDO::PARAM_STR);
$insert_post_toDB->execute();
}elseif (!empty($pol_ques)){
	$iptdbsql = "INSERT INTO wpost
(post_id,author_id,post_time,post_content,p_title,p_privacy,s_bt,s_op,poll_ques,ye_poll,no_poll,location)
VALUES
( :post_id, :p_author_id, :p_time, :p_content, :p_title, :p_privacy, :s_bt, :s_op, :pol_ques, :poll_ye, :poll_no, :location)
";
$insert_post_toDB = $conn->prepare($iptdbsql);
$insert_post_toDB->bindParam(':post_id', $post_id,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':p_author_id', $p_author_id,PDO::PARAM_INT);
$insert_post_toDB->bindParam(':p_time', $p_time,PDO::PARAM_INT);
$insert_post_toDB->bindParam(':p_content', $p_content,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':p_title', $p_title,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':location', $location,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':p_privacy', $p_privacy,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':s_bt', $s_bt,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':s_op', $s_op,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':pol_ques', $pol_ques,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':poll_ye', $poll_ye,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':poll_no', $poll_no,PDO::PARAM_STR);
$insert_post_toDB->execute();
}

elseif (!empty($p_img)){
	$post_fileName = $_FILES["w_photo"]["name"];
$post_fileTmpLoc = $_FILES["w_photo"]["tmp_name"];
$post_fileType = $_FILES["w_photo"]["type"];
$post_fileSize = $_FILES["w_photo"]["size"]; 
$post_fileErrorMsg = $_FILES["w_photo"]["error"];
$post_fileName = preg_replace('#[^a-z.0-9]#i', '', $post_fileName); 
$post_kaboom = explode(".", $post_fileName);
$post_fileExt = end($post_kaboom);
$post_fileName = time().rand().".".$post_fileExt;
    //================[ if not selected an image ]================
if (!$post_fileTmpLoc) {
echo "
<p id='error_msg' onclick='hideMsg()'>
".lang('errorPost_n2')."
</p>
";
}else{
    //================[ if image size more than 8Mb ]================
     if($post_fileSize > 8242880) {
    echo "
<p id='error_msg' onclick='hideMsg()'>
".lang('errorPost_n3')."
</p>
";
unlink($post_fileTmpLoc); 
} else {
    //================[ if image format not supported ]================
if (!preg_match("/.(jpeg|jpg|png|mp4|ogg|wbm|mp3|pdf)$/i", $post_fileName) ) { 
echo "
<p id='error_msg' onclick='hideMsg()'>
".lang('errorPost_n4')."
</p>
"; 
     unlink($post_fileTmpLoc);
} else {
    //================[ if an error was found ]================
if ($post_fileErrorMsg == 1) {
    echo "
<p id='error_msg' onclick='hideMsg()'>
".lang('errorPost_n5')."
</p>
";
}else{
    //================[ check image path ]================
if (is_dir("../imgs/user_post_img/")) {
    $imgsPath = "../imgs/user_post_img/";
}else{
    $imgsPath = "imgs/user_post_img/";
}
$post_moveResult = move_uploaded_file($post_fileTmpLoc, $imgsPath."$post_fileName");
    //================[ if image uploaded successfuly ]================
if ($post_moveResult != true) {
    echo "
<p id='error_msg' onclick='hideMsg()'>
".lang('errorPost_n6')."
</p>
";
}else{
    $p_img = "user_post_img/".$post_fileName;
}

$iptdbsql = "INSERT INTO wpost
(post_id,author_id,post_img,post_time,post_content,p_title,p_privacy,s_bt,s_op,img_sty,img_opacity,location,pr_buss)
VALUES
( :post_id, :p_author_id, :p_img, :p_time, :p_content, :p_title, :p_privacy, :s_bt, :s_op, :img_sty, :img_opacity, :location, :pr_buss)
";
$insert_post_toDB = $conn->prepare($iptdbsql);
$insert_post_toDB->bindParam(':post_id', $post_id,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':p_author_id', $p_author_id,PDO::PARAM_INT);
$insert_post_toDB->bindParam(':pr_buss', $pr_buss,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':p_img', $p_img,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':p_time', $p_time,PDO::PARAM_INT);
$insert_post_toDB->bindParam(':location', $location,PDO::PARAM_INT);
$insert_post_toDB->bindParam(':p_content', $p_content,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':p_title', $p_title,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':p_privacy', $p_privacy,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':s_bt', $s_bt,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':s_op', $s_op,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':img_sty', $img_sty,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':img_opacity', $img_opacity,PDO::PARAM_STR);
$insert_post_toDB->execute();
}
}
}
}
}

else {
$iptdbsql = "INSERT INTO wpost
(post_id,author_id,post_time,post_content,p_title,p_privacy,s_bt,s_op,location)
VALUES
( :post_id, :p_author_id, :p_time, :p_content, :p_title, :p_privacy, :s_bt, :s_op, :location)
";
$insert_post_toDB = $conn->prepare($iptdbsql);
$insert_post_toDB->bindParam(':post_id', $post_id,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':p_author_id', $p_author_id,PDO::PARAM_INT);
$insert_post_toDB->bindParam(':p_time', $p_time,PDO::PARAM_INT);
$insert_post_toDB->bindParam(':p_content', $p_content,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':location', $location,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':p_title', $p_title,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':p_privacy', $p_privacy,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':s_bt', $s_bt,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':s_op', $s_op,PDO::PARAM_STR);
$insert_post_toDB->execute();
}
include("fetch_users_info.php");
include ("time_function.php");
include ("num_k_m_count.php");
$vpsql = "SELECT * FROM wpost WHERE post_id = :post_id";
$view_posts = $conn->prepare($vpsql);
$view_posts->bindParam(':post_id', $post_id, PDO::PARAM_INT);
$view_posts->execute();
include "fetch_posts.php";
?>