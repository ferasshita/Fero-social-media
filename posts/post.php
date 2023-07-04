<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();
$page="post";
include("../config/connect.php");
include("../includes/fetch_users_info.php");
include ("../includes/time_function.php");
include ("../includes/num_k_m_count.php");
if(!isset($_SESSION['Username'])){
    header("location: ../index");
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
    <title>Post &bull; Fero</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="../css/img_s.css" rel="stylesheet">
<?php
if (isset($_POST['com_btn'])) {
$s_id=$_SESSION['id'];
$c_id = rand(0,9999999)+time();
$check_path_var = filter_var(htmlentities($_POST['cp']),FILTER_SANITIZE_STRING);
$get_post_id = filter_var(htmlentities($_POST['post_id']),FILTER_SANITIZE_STRING);
$comment_time = time();
$img_gif = filter_var(htmlentities($_POST['img_gif']),FILTER_SANITIZE_STRING);
$iptdbsql = "INSERT INTO comments
(c_id,c_author_id,c_post_id,c_time,w_photo_v)
VALUES
( :c_id,:s_id,:get_post_id, :comment_time, :img_gif)
";
$insert_post_toDB = $conn->prepare($iptdbsql);
$insert_post_toDB->bindParam(':s_id',$s_id,PDO::PARAM_INT);
$insert_post_toDB->bindParam(':c_id',$c_id,PDO::PARAM_INT);
$insert_post_toDB->bindParam(':get_post_id',$get_post_id,PDO::PARAM_INT);
$insert_post_toDB->bindParam(':comment_time',$comment_time,PDO::PARAM_INT);
$insert_post_toDB->bindParam(':img_gif',$img_gif,PDO::PARAM_INT);
$insert_post_toDB->execute();
}

?>
    <?php include "../includes/head_imports_main.php";?>
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
<body onload="fetchPosts_DB('home')">
	<script>
	$(window).load(function(){
	$(".se-pre-con").fadeOut("slow");});		
</script>
<div class="se-pre-con"><img class="iconsa" src="../imgs/logo.ico" alt="logo"></div>
<!--=============================[ NavBar ]========================================-->
<?php include "../includes/navbar_main.php"; ?>
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
<div class="main_container" align="center">
    <div style="display: inline-flex;width:100%;" align="center">
        <div align="left" style="width:100%">
        <?php
        $post_id = filter_var(htmlentities($_GET['pid']), FILTER_SANITIZE_NUMBER_INT);
        $sid = $_SESSION['id'];
        $checkAuthOfPost_sql = "SELECT author_id FROM wpost WHERE post_id = ?";
        $checkAuthOfPost_params = array($post_id);
        $checkAuthOfPost = $conn->prepare($checkAuthOfPost_sql);
        $checkAuthOfPost->execute($checkAuthOfPost_params);
        $checkAuthOfPostCount = $checkAuthOfPost->rowCount();
        if ($checkAuthOfPostCount > 0) {
        while ($fetch_cop = $checkAuthOfPost->fetch(PDO::FETCH_ASSOC)) {
            $fetched_AuthorId = $fetch_cop['author_id'];
        }
            if ($fetched_AuthorId == $sid) {
                $fPosts_sql = "SELECT * FROM wpost WHERE post_id = ?";
                $params = array($post_id);
            }else{
                $checkFromPost_sql = "SELECT author_id FROM wpost WHERE post_id = ? AND author_id IN (SELECT uf_two FROM follow WHERE uf_one= ?)";
                $checkFromPost_params = array($post_id, $sid);
                $checkFromPost = $conn->prepare($checkFromPost_sql);
                $checkFromPost->execute($checkFromPost_params);
                $checkFromPostCount = $checkFromPost->rowCount();
                if ($checkFromPostCount < 1) {
                    $fPosts_sql = "SELECT * FROM wpost WHERE post_id = ? AND p_privacy != ? AND p_privacy != ?";
                    $params = array($post_id, "1", "2");
                }else{
                    $fPosts_sql = "SELECT * FROM wpost WHERE post_id = ? AND p_privacy != ?";
                    $params = array($post_id, "2");
                }
            }
        
        $view_posts = $conn->prepare($fPosts_sql);
        $view_posts->execute($params);
		?>
<style>
.posti{
    background: white;
    border-radius: 4px;
    box-shadow: 0px 0px 18px rgba(63, 81, 181, 0.16);
    width: 500px;
    margin: -6px 5px;
    border: 1px solid transparent;
}
	.cod{
	background: linear-gradient(500deg,#8910d6,#b52d94);
}
</style>
<?php
///////////////////////////
while ($postsfetch = $view_posts->fetch(PDO::FETCH_ASSOC)) {
$get_post_id = $postsfetch['post_id'];
$get_author_id = $postsfetch['author_id'];
$get_post_author = $postsfetch['post_author'];
$get_post_author_photo = $postsfetch['post_author_photo'];
$get_post_img = $postsfetch['post_img'];
$get_post_time = $postsfetch['post_time'];
$get_post_content = $postsfetch['post_content'];
$get_post_head = $postsfetch['hea_wr'];
$img_sty = $postsfetch['img_sty'];
$w_photo_v = $postsfetch['w_photo_v'];
$img_op = $postsfetch['img_opacity'];
$get_post_story = $postsfetch['s_wr'];
$question = $postsfetch['question'];
$op1 = $postsfetch['op1'];
$op2 = $postsfetch['op2'];
$op3 = $postsfetch['op3'];
$ch_co = $postsfetch['ch_co'];
$poll_ques = $postsfetch['poll_ques'];
$ye_poll = $postsfetch['ye_poll'];
$no_poll = $postsfetch['no_poll'];
$ye_poll_nu = $postsfetch['ye_poll_nu'];
$no_poll_nu = $postsfetch['no_poll_nu'];
$get_post_write = $postsfetch['p_write'];
$get_text_image = $postsfetch['imgtext'];
$color = $postsfetch['color'];
$font = $postsfetch['font'];
$link = $postsfetch['link'];
$img_mov = $postsfetch['photomov'];
$movie = $postsfetch['movie'];
$session_userphoto_path = $check_path."imgs/user_imgs/";
$session_userphoto = $session_userphoto_path . $_SESSION['Userphoto'];
$timeago = time_ago($get_post_time);
$get_post_title = $postsfetch['p_title'];
$get_post_privacy = $postsfetch['p_privacy'];
$get_post_shared = $postsfetch['shared'];
switch ($get_post_privacy) {
    case '0':
        $postPrivacy = "<span class='fa fa-globe' data-toggle='tooltip' data-placement='top' title='".lang('wpr_public')."'></span>";
        break;
    case '1':
        $postPrivacy = "<span class='fa fa-users' data-toggle='tooltip' data-placement='top' title='".lang('wpr_followers')."'></span>";
        break;
    case '2':
        $postPrivacy = "<span class='fa fa-lock' data-toggle='tooltip' data-placement='top' title='".lang('wpr_onlyme')."'></span>";
        break;
	case '3':
        $postPrivacy = "<span class='fa fa-map' data-toggle='tooltip' data-placement='top' title='".lang('wpr_ads')."'></span>";
        break;
}
$p_title = $get_post_title;
if (!empty($get_post_shared)) {
    $p_title = lang('shared_a_Post');
}
$qsql = "SELECT * FROM signup WHERE id=:get_author_id";
$query = $conn->prepare($qsql);
$query->bindParam(':get_author_id', $get_author_id, PDO::PARAM_INT);
$query->execute();

while ($query_fetch = $query->fetch(PDO::FETCH_ASSOC)) {
    $query_fetch_id = $query_fetch['id'];
    $query_fetch_username = $query_fetch['Username'];
    $query_fetch_fullname = $query_fetch['Fullname'];
    $query_fetch_userphoto = $query_fetch['Userphoto'];
    $query_fetch_verify = $query_fetch['verify'];
}

$chslq = "SELECT c_id FROM comments WHERE c_post_id=:get_post_id";
$ch = $conn->prepare($chslq);
$ch->bindParam(':get_post_id', $get_post_id, PDO::PARAM_INT);
$ch->execute();
$chtc = $ch->rowCount();
if($chtc == 0){
    $chtcnum = "";
}elseif ($chtc == 1) {
    $chtcnum = "1 ".lang('comment')."";
}else{
    $chtcnum = thousandsCurrencyFormat($chtc)." ".lang('comments')."";
}

$chShare = $conn->prepare("SELECT shared FROM wpost WHERE shared=:get_post_id");
$chShare->bindParam(':get_post_id', $get_post_id, PDO::PARAM_INT);
$chShare->execute();
$chShareCount = $chShare->rowCount();
if($chShareCount == 0){
    $shareCount = "";
}elseif ($chShareCount == 1) {
    $shareCount = "1 ".lang('share')."";
}else{
    $shareCount = thousandsCurrencyFormat($chShareCount)." ".lang('shares')."";
}

$imgs_path = $check_path."imgs/";
$em_img_path = $imgs_path."emoticons/";
if (is_file("config/connect.php")) {
    $includePath = "includes/";
}elseif (is_file("../config/connect.php")) {
    $includePath = "../includes/";
}elseif (is_file("config/connect.php")) {
    $includePath = "../../includes/";
}

include ($includePath."emoticons.php");
$post_body = str_replace($em_char,$em_img,$get_post_content);
$hashtag_path = $check_path."hashtag/";
$hashtags_url = '/(\#)([x00-\xFF]+[a-zA-Z0-9x00-\xFF_\w]+)/';
$url = '/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\:[0-9]+)?(\/\S*)?/';
$body = preg_replace($url, '<a href="$0" target="_blank" title="$0">$0<i class="fa fa-link"></i></a>', $post_body);
if ($isHashTagPage == "yep") {
    $body = preg_replace($hashtags_url, '<b><a href="'.$hashtag_path.'$2" title="#$2" class="hashtagHightlight">#$2</a></b>', $body);
}else{
    $body = preg_replace($hashtags_url, '<b><a href="'.$hashtag_path.'$2" title="#$2">#$2</a></b>', $body);
}
//url////////////////////////////////
    $hashtags_url = '/(\www.)([x00-\xFF]+[a-zA-Z0-9x00-\xFF_\w\.com]+)/';
    $body = preg_replace($hashtags_url, "<a href='../$2' title='www.$2'>www.$2<i class='fa fa-link'></i></a>", $body);
//u////////////////////////////////
    $hashtags_url = '/(\@)([x00-\xFF]+[a-zA-Z0-9x00-\xFF_\w]+)/';
    $body = preg_replace($hashtags_url, "<b><a href='".$check_path."u/$2' title='$2'>@$2</a></b>", $body);
$body = nl2br("$body");
//shared posts///////////////////////////////////////////////////////////////////////////////
    echo "
    <div class='posti' style='min-width: 99%;border-radius:10px;' id='$get_post_id' style='text-align:".lang('post_align').";'>
    <div id='postNotify_$get_post_id'></div>
    <div class='username_OF_post'>
    <table style='width:100%;'>
    <tr>
    <td style='width:50px;'>
    <div class='username_OF_postImg'><img src=\"".$imgs_path."user_imgs/$query_fetch_userphoto\"></div><td>
    <td>
    <a href='".$check_path."u/$query_fetch_username' class='username_OF_postLink'>$query_fetch_fullname</a><br/>
    <a href='".$check_path."posts/post?pid=".$get_post_id."' class='username_OF_postTime'>$timeago</a>
    </td>
    <td>
    <div class='dropdown'>
    <a class='post_options dropdown-toggle' data-toggle='dropdown' style='float:".lang('post_options').";' href='#'><span>&bull;&bull;&bull;</span></a>
        <ul class='dropdown-menu ".lang('postDropdown')."' style='top:10px;color:#999;text-align: ".lang('postDropdownTxtAlign').";'>
    ";
    if ($get_author_id == $_SESSION['id']) {
            echo "
    <li><a href='javascript:void(0)' onclick=\"editPost('$get_post_id')\"><span class='fa fa-pencil'></span> ".lang('EditPost_DDM')."</a></li>
    <li><a href='javascript:void(0)' onclick=\"deletePost('$get_post_id')\"><span class='fa fa-trash-o'></span> ".lang('DeletePost_DDM')."</a></li>
    <li class='divider'></li>";
        }
    echo "
    <li><a href='javascript:void(0)' onclick=\"reportpost('post','$get_post_id')\"><span class='fa fa-bug'></span> ".lang('reportPost_DDM')."</a></li>
    ";

 //print  
   echo" <li><a href='javascript:void(0);' onclick=\"codespeedy('pr_$get_post_id')\" title='print'><span class=\"fa fa-print\"></span> print</a></li>";

//download
if($get_post_img){
	   echo" <li><a href=\"".$imgs_path."$get_post_img\" title='download this image' download><span class='fa fa-download'></span> download</a></li>";
}elseif($shP_img){
		   echo" <li><a href=\"".$imgs_path."$shP_img\" title='download this image' download><span class='fa fa-download'></span> download</a></li>";
}
	echo"
	<li class='divider'></li>
	<li><a href='javascript:void(0)' onclick=\"cop('cop_$get_post_id')\"><span class='fa fa-link'></span> ".lang('link_DDM')."</a></li>
    <li><a href='javascript:void(0)' onclick=\"cope('cope_$get_post_id')\"><span class='fa fa-globe'></span> ".lang('embed_DDM')."</a></li>
	</ul>
    </div>
    </td>
    </tr>
    </table>
	<input style='display:none' type='text' id='cop_$get_post_id' value='fero1.com.ly/posts/post?pid=$get_post_id'>
	<input style='display:none' type='text' id='cope_$get_post_id' value='fero1.com.ly/embed/post?pid=$get_post_id'>
    </div><div id='postTitle_$get_post_id'>";
    if (!empty($p_title)) {
        echo "<p class='postTitle' style='border-".lang('float').": 2px solid rgba(80, 94, 113, 0.19); text-align: ".lang('textAlign').";'>$p_title</p>";
    }
    switch ($get_post_privacy) {
        case '0':
            $pub_privacySelected = "selected=''";
            break;
        case '1':
            $f_privacySelected = "selected=''";
            break;
        case '2':
            $om_privacySelected = "selected=''";
            break;
		 case '3':
            $ad_privacySelected = "selected=''";
            break;
    }
	//edit/////////////////////////////////////////
    echo "</div>
    <div class=\"post_content\" style='text-align:".lang('post_content_align').";'>
    <div id='postEditBox_$get_post_id' class='postEditBox' style='display:none;'>
    <input type='text' dir='auto' class='flat_solid_textfield' id='EditTitleBox_$get_post_id' style='min-height: auto;' placeholder='".lang('w_title_inputText')."' value='$p_title' />
    <textarea dir='auto' class='postContent_EditBox' id='EditBox_$get_post_id'>$get_post_content</textarea>
    <div>
    <a href='javascript:void(0)' onclick=\"editPost_save('$get_post_id','$check_path')\" class='default_flat_btn'>".lang('save')."</a>
    <a href='javascript:void(0)' onclick=\"editPost_cancel('$get_post_id')\" class='silver_flat_btn'>".lang('cancel')."</a>
    <select id='p_privacy_$get_post_id' style='background: white;padding: 8px 10px;'>
        <option $pub_privacySelected>".lang('wpr_public')."</option>
        <option $f_privacySelected>".lang('wpr_followers')."</option>
        <option $om_privacySelected>".lang('wpr_onlyme')."</option>
    </select>
    </div>
    </div>
    <div id='postLoading_$get_post_id'></div>
    "; 
        echo "<p dir=\"auto\" id='postContent_$get_post_id'>";
    include ("../includes/ytframe.php");
    echo "</p>";
    echo""; 
        if (!empty($get_post_story)) {
		echo "<a href='".$check_path."posts/book?pid=".$get_post_id."'><div style='width: 98%;height:550px;max-width: 98%;max-height:80%;background-color:grey;text-align: center;'><br><img align='center' style='width: 70%;height:58%;max-width: 85%;max-height:58%;box-shadow: 0px 0px 18px rgba(63, 81, 181, 0.16);' id='lightboxImg_$get_post_id' src=\"".$imgs_path."$w_photo_v\"  class='$img_sty' alt='$query_fetch_fullname' /></div></a>";
		}elseif (!empty($movie)) {
		echo "<a href='".$check_path."posts/film?pid=".$get_post_id."'><div style='width: 98%;height:550px;max-width: 98%;max-height:80%;background-color:grey;text-align: center;'><br><img align='center' style='width: 70%;height:58%;max-width: 85%;max-height:58%;box-shadow: 0px 0px 18px rgba(63, 81, 181, 0.16);' id='lightboxImg_$get_post_id' src='../imgs/$img_mov' alt='$query_fetch_fullname' /></div></a>";
		}
		elseif (!empty($get_post_write)) {
			if (!empty($get_text_image)) {
			echo nl2br("<div class='$color' style='border-radius:10px;font-family: $font;background: url(\"imgs/$get_text_image\") no-repeat center center; background-size: cover;width: 98%;height:80%;font-size: 27px; text-align:center;max-width: 98%;max-height:80%;'><p dir='auto'><br>$get_post_write</p></div>");
			}else{
			echo nl2br("<div class='$color' style='border-radius:10px;font-family: $font;width: 98%;height:550px;font-size: 27px; text-align:center;max-width: 98%;max-height:80%;'><p dir='auto' style='word-break: break-word;'><br>$get_post_write</p></div>");
			}
		}elseif (!empty($link)) {
			echo "<iframe src='$link' style='border-radius:10px;width: 98%;height:550px;max-width: 98%;max-height:80%;'></iframe>";
		}elseif(!empty($question)){
			echo "<div dir='auto' style='width:30%;height:60%;background:white;box-shadow: 0px 0px 18px rgba(63, 81, 181, 0.16);border: 1px solid transparent;border-radius: 10px;'>
<div class='w3-light-grey' style='height:15%;border-radius:4px;text-align:center;'>
<script>
	function fl_$get_post_id() { 
		document.getElementById('incorr_$get_post_id').style.display = 'inline';
		document.getElementById('corr_$get_post_id').style.display = 'none';
		document.getElementById('nim_op1_$get_post_id').style.display = 'none';
		document.getElementById('nim_op2_$get_post_id').style.display = 'none';
		document.getElementById('nim_op3_$get_post_id').style.display = 'none';
		document.getElementById('opdi1_$get_post_id').style.background = 'green';
		";
		echo"
	}
	function tr_$get_post_id() { 
		document.getElementById('corr_$get_post_id').style.display = 'inline';
		document.getElementById('incorr_$get_post_id').style.display = 'none';
		document.getElementById('nim_op1_$get_post_id').style.display = 'none';
		document.getElementById('nim_op2_$get_post_id').style.display = 'none';
		document.getElementById('nim_op3_$get_post_id').style.display = 'none';
		document.getElementById('opdi1_$get_post_id').style.background = 'green';
		";
		echo"
	}
</script>
<br>
$question
</div>
<br>
<div id='";if($ch_co == "a"){echo"opdi1_$get_post_id";}elseif($ch_co != "a"){echo"opdin1_$get_post_id";}echo"' style='width:100%;height:15%;border-radius:25px;border: thin solid  grey;background:;' onclick='";if($ch_co == "a"){echo"tr_$get_post_id()";}else{echo"fl_$get_post_id()";}echo"'><div style='border-radius:4px;' id='aod'>
<br>&nbsp;&nbsp;&nbsp;<span id='nim_op1_$get_post_id' style='border: solid grey;border-radius:100px;padding:5px 5px;'>A</span>&nbsp;&nbsp;  ";if($ch_co == "a"){echo"<img src=\"".$imgs_path."main_icons/2705.png\" id='corr_$get_post_id' style='display:none;width:20px;height:20px;'>";}echo"
$op1</div>
</div>
<br>
<div id='";if($ch_co == "b"){echo"opdi1_$get_post_id";}elseif($ch_co != "b"){echo"opdin2_$get_post_id";}echo"' style='width:100%;height:15%;border-radius:25px;border: thin solid  grey;background:;' onclick='";if($ch_co == "b"){echo"tr_$get_post_id()";}else{echo"fl_$get_post_id()";}echo"'><div style='border-radius:4px;' id='bod'>
<br>&nbsp;&nbsp;&nbsp;<span id='nim_op2_$get_post_id' style='border: solid grey;border-radius:100px;padding:5px 5px;'>B</span>&nbsp;&nbsp;  ";if($ch_co == "b"){echo"<img src=\"".$imgs_path."main_icons/2705.png\" id='corr_$get_post_id' style='display:none;width:20px;height:20px;'>";}echo"
$op2</div>
</div>
<br>
<div id='";if($ch_co == "c"){echo"opdi1_$get_post_id";}elseif($ch_co != "c"){echo"opdin3_$get_post_id";}echo"' style='width:100%;height:15%;border-radius:25px;border: thin solid  grey;background:;' onclick='";if($ch_co == "c"){echo"tr_$get_post_id()";}else{echo"fl_$get_post_id()";}echo"'><div style='border-radius:4px;' id='zod'>
<br>&nbsp;&nbsp;&nbsp;<span id='nim_op3_$get_post_id' style='border: solid grey;border-radius:100px;padding:5px 5px;'>C</span>&nbsp;&nbsp;  ";if($ch_co == "c"){echo"<img src=\"".$imgs_path."main_icons/2705.png\" id='corr_$get_post_id' style='display:none;width:20px;height:20px;'>";}echo"
$op3<br>
</div></div>
	<div id='incorr_$get_post_id' style='display:none'>not correct</div>
</div>
";
}elseif(!empty($poll_ques)){
			echo"<div class='w3-grey' style='border:thin solid black;height:200px;width:350px;border-radius:10px;box-shadow: 0px 0px 18px rgba(63, 81, 181, 0.16);'>
<br>
<p style='text-align:center;width:100%;font-size:25px;color:purple;'>$poll_ques</p>
<br>
<br>";
//poll_yes
$s_idi = $_SESSION['id'];

$get_post_id_i = $postsfetch['post_id'];
$csql = "SELECT id FROM polls WHERE poller=:s_idi AND post_id=:get_post_id_i";
$c = $conn->prepare($csql);
$c->bindParam(':s_idi',$s_idi,PDO::PARAM_INT);
$c->bindParam(':get_post_id_i',$get_post_id_i,PDO::PARAM_INT);
$c->execute();
$c_num = $c->rowCount();
if ($c_num > 0){
}else{
}
$likes_sql = "SELECT id FROM polls WHERE post_id=:get_post_id_i AND yes=1";
$likes = $conn->prepare($likes_sql);
$likes->bindParam(':get_post_id_i',$get_post_id_i,PDO::PARAM_INT);
$likes->execute();
$likes_numi = $likes->rowCount();

//poll_no
$s_idn = $_SESSION['id'];
$get_post_id_n = $postsfetch['post_id'];
$csql = "SELECT id FROM polls WHERE poller=:s_idn AND post_id=:get_post_id_n";
$c = $conn->prepare($csql);
$c->bindParam(':s_idn',$s_idn,PDO::PARAM_INT);
$c->bindParam(':get_post_id_n',$get_post_id_n,PDO::PARAM_INT);
$c->execute();
$c_num = $c->rowCount();
if ($c_num > 0){
}else{
}
$likes_sql = "SELECT id FROM polls WHERE post_id=:get_post_id_n AND no=1";
$likes = $conn->prepare($likes_sql);
$likes->bindParam(':get_post_id_n',$get_post_id_n,PDO::PARAM_INT);
$likes->execute();
$likes_num = $likes->rowCount();
////////////////////
$likes_sqli = "SELECT id FROM polls WHERE post_id=:get_post_id_n";
$likesi = $conn->prepare($likes_sqli);
$likesi->bindParam(':get_post_id_n',$get_post_id_n,PDO::PARAM_INT);
$likesi->execute();
$likesi = $likesi->rowCount();
//yes
$likes_sqly = "SELECT id FROM polls WHERE post_id=:get_post_id_i";
$likesy = $conn->prepare($likes_sqly);
$likesy->bindParam(':get_post_id_i',$get_post_id_i,PDO::PARAM_INT);
$likesy->execute();
$likesy = $likesy->rowCount();
//yes
if ($likes_numi == 0) {

    $likenumi = "0";
}elseif ($likes_numi == 1){
    $likenumi = 1/$likesy*100;
}else{
    $likenumi = $likes_numi/$likesy*100;
}
//no
if ($likes_num == 0) {
    $likenumn = "0";
}elseif ($likes_num == 1){
    $likenumn = 1/$likesi*100;
}else{
    $likenumn = $likes_num/$likesi*100;
}
echo"
<div class='w3-light-grey' style='border:thin solid black;height:60px;width:350px;border-radius:25px;box-shadow: 0px 0px 18px rgba(63, 81, 181, 0.16);'>
<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<p onclick=\"votey('$get_post_id_i')\" style='display:inline;border:none;text-align:left;'><span id='pollcouy_$get_post_id_n'>$ye_poll</span><span style='";if(!empty($c_num)){echo"display:inline";}else{echo"display:none";} echo"' id='postLikeCounti_$get_post_id_i'>$likenumi%</span></p>
<p onclick=\"voten('$get_post_id_i')\" style='display:inline;border:none;text-align:right;float:right;'><span id='pollcoun_$get_post_id_n'>$no_poll</span><span style='";if(!empty($c_num)){echo"display:inline";}else{echo"display:none";} echo"' id='postLikeCounti_$get_post_id_n'>$likenumn%</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</div>
</div>";
		}
		elseif(!empty($get_post_img)){
		if(preg_match("/.(png|jpeg|jpg)$/i", $get_post_img/*importent!!!*/)){
			if(!empty($img_op)){
        echo "<div id='pr_$get_post_id'><img class='$img_sty' align='center' style='object-fit:cover;object-position:50% 50%;width: 98%;height:550px;border-radius:10px;max-width: 98%;max-height:80%;opacity:$img_op;' onclick='lightbox(\"$get_post_id\")' id='lightboxImg_$get_post_id' src=\"../imgs/$get_post_img\" alt='$query_fetch_fullname' /></div>";
			}else{
				echo"<div id='pr_$get_post_id'><img class='$img_sty' align='center' style='object-fit:cover;object-position:50% 50%;width: 98%;border-radius:10px;height:550px;max-width: 98%;max-height:80%;' onclick='lightbox(\"$get_post_id\")' id='lightboxImg_$get_post_id' src=\"../imgs/$get_post_img\" alt='$query_fetch_fullname' /></div>";
			}
		}elseif(preg_match("/.(mp4|ogg|wmb)$/i", $get_post_img/*importent!!!*/)){
			 echo "<video controls autoplay align='center' class='$img_sty' style='width: 98%;border-radius:10px;height:550px;max-width: 98%;max-height:80%;' id='lightboxImg_$get_post_id' src=\"../imgs/$get_post_img\">Your browser don't support videos!!!</video>";
		}elseif(preg_match("/.(mp3)$/i", $get_post_img/*importent!!!*/)){
				 echo "<audio controls autoplay align='center' style='width: 98%;height:550px;border-radius:10px;max-width: 98%;max-height:80%;' id='lightboxImg_$get_post_id' src=\"../imgs/$get_post_img\">Your browser don't support audios!!!</audio>";
		}elseif(preg_match("/.(pdf)$/i", $get_post_img/*importent!!!*/)){ 
		echo "<embed align='center' id='lightboxImg_$get_post_id' style='width: 98%;border-radius:10px;height:550px;max-width: 98%;max-height:80%;' type='application/pdf' src=\"../imgs/$get_post_img\"></embed>";
		}
		}
// ========= fetch share post ==========
if (!empty(trim($get_post_shared))) {
$fetch_shared = $conn->prepare("SELECT * FROM wpost WHERE post_id=:get_post_shared ");
$fetch_shared->bindParam(':get_post_shared',$get_post_shared,PDO::PARAM_INT);
$fetch_shared->execute();
while ($sharedRow = $fetch_shared->fetch(PDO::FETCH_ASSOC)) {
    $shP_id = $sharedRow['post_id'];
    $shP_aid = $sharedRow['author_id'];
	$get_post_head_sh = $sharedRow['hea_wr'];
$get_post_story_sh = $sharedRow['s_wr'];
    $shP_img = $sharedRow['post_img'];
	$img_mov = $sharedRow['photomov'];
	$w_photo_v = $sharedRow['w_photo_v'];
$movie = $sharedRow['movie'];
	$get_post_write = $sharedRow['p_write'];
	$question = $sharedRow['question'];
$op1 = $sharedRow['op1'];
$op2 = $sharedRow['op2'];
$op3 = $sharedRow['op3'];
$ch_co = $sharedRow['ch_co'];
$poll_ques = $sharedRow['poll_ques'];
$ye_poll = $sharedRow['ye_poll'];
$no_poll = $sharedRow['no_poll'];
$ye_poll_nu = $sharedRow['ye_poll_nu'];
$no_poll_nu = $sharedRow['no_poll_nu'];
	$link = $sharedRow['link'];
		$color = $sharedRow['color'];
		$img_sty = $sharedRow['img_sty'];
$img_op = $sharedRow['img_opacity'];
		$get_text_image = $sharedRow['imgtext'];
$font = $sharedRow['font'];
    $shP_title = $sharedRow['p_title'];
    $shP_content = $sharedRow['post_content'];
    $shP_time = $sharedRow['post_time'];
    $shP_timeago = time_ago($shP_time);

    $who_shareInfo = $conn->prepare("SELECT * FROM signup WHERE id=:shP_aid ");
    $who_shareInfo->bindParam(':shP_aid',$shP_aid,PDO::PARAM_INT);
    $who_shareInfo->execute();
    while ($user_row = $who_shareInfo->fetch(PDO::FETCH_ASSOC)) {
        $shU_un = $user_row['Username'];
        $shU_up = $user_row['Userphoto'];
        $shU_fn = $user_row['Fullname'];
    }

$sh_post_body = str_replace($em_char,$em_img,$shP_content);
$sh_hashtag_path = $check_path."hashtag/";
$sh_hashtags_url = '/(\#)([x00-\xFF]+[a-zA-Z0-9x00-\xFF_\w]+)/';
$sh_url = '/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\:[0-9]+)?(\/\S*)?/';
$sh_body = preg_replace($sh_url, '<a href="$0" target="_blank" title="$0">$0<i class="fa fa-link"></i></a>', $sh_post_body);
if ($isHashTagPage == "yep") {
    $sh_body = preg_replace($sh_hashtags_url, '<b><a href="'.$sh_hashtag_path.'$2" title="#$2" class="hashtagHightlight">#$2</a></b>', $sh_body);
}else{
    $sh_body = preg_replace($sh_hashtags_url, '<b><a href="'.$sh_hashtag_path.'$2" title="#$2">#$2</a></b>', $sh_body);
}
//url////////////////////////////////
    $hashtags_url = '/(\www.)([x00-\xFF]+[a-zA-Z0-9x00-\xFF_\w\.com]+)/';
    $sh_body = preg_replace($hashtags_url, "<a href='../$2' title='www.$2'>www.$2<i class='fa fa-link'></i></a>", $sh_body);
//u////////////////////////////////
    $hashtags_url = '/(\@)([x00-\xFF]+[a-zA-Z0-9x00-\xFF_\w]+)/';
    $sh_body = preg_replace($hashtags_url, "<b><a href='".$check_path."u/$2' title='$2'>@$2</a></b>", $sh_body);
$sh_body = nl2br("$sh_body");
}
//////////////////post///////////
echo "
<div class=\"post\" style='min-width: 98%;border-radius:10px; max-height:650px;' id=\"$shP_id\" style='margin: 0;text-align:".lang('post_align').";'>
<div class=\"username_OF_post\">
<table style=\"width:100%;\">
<tbody><tr>
<td style=\"width:50px;\">
<div class=\"username_OF_postImg\"><img src=\"".$check_path."imgs/user_imgs/$shU_up\"></div></td><td>
</td><td>
<a href=\"".$check_path."u/$shU_un\" class=\"username_OF_postLink\">$shU_fn</a><br>
<a href=\"".$check_path."posts/post?pid=$shP_id\" class=\"username_OF_postTime\">$shP_timeago</a>
</td>
</tr>
</tbody></table>
</div><div id='postTitle_$get_post_id'>";
if (!empty($shP_title)) {
    echo "<p class='postTitle' style='border-".lang('float').": 2px solid rgba(80, 94, 113, 0.19); text-align: ".lang('textAlign').";'>$shP_title</p>";
}
echo "</div><div class=\"post_content\" style=\"text-align:left;\">
<p dir=\"auto\" id=\"postContent_$shP_id\" style='text-align: ".lang('textAlign').";'>$sh_body";
echo "</p>";
if (!empty($get_post_story_sh)) {
			echo "<a href='".$check_path."posts/book?pid=".$get_post_id."'><div style='width: 98%;height:80%;max-width: 98%;max-height:80%;background-color:grey;text-align: center;'><br><img align='center' style='width: 85%;height:460px;max-width: 85%;max-height:460px;box-shadow: 0px 0px 18px rgba(63, 81, 181, 0.16);' id='lightboxImg_$get_post_id'  class='$img_sty' src=\"".$imgs_path."$w_photo_v\" alt='$query_fetch_fullname' /></div></a>";
		}elseif (!empty($movie)) {
		echo "<a href='".$check_path."posts/film?pid=".$get_post_id."'><div style='width: 98%;height:80%;max-width: 98%;max-height:80%;background-color:grey;text-align: center;'><br><img align='center' style='width: 70%;height:90%;max-width: 85%;max-height:90%;box-shadow: 0px 0px 18px rgba(63, 81, 181, 0.16);' id='lightboxImg_$get_post_id' src='imgs/$img_mov' alt='$query_fetch_fullname' /></div></a>";
		}
		elseif (!empty($get_post_write)) {
			if (!empty($get_text_image)) {
			echo nl2br("<div class='$color' style='border-radius:10px;font-family: $font;background: url(\"imgs/$get_text_image\") no-repeat center center; background-size: cover;width: 98%;height:80%;font-size: 27px; text-align:center;max-width: 98%;max-height:80%;'><p dir='auto'><br>$get_post_write</p></div>");
			}else{
			echo nl2br("<div class='$color' style='border-radius:10px;font-family: $font;width: 98%;height:80%;font-size: 27px; text-align:center;max-width: 98%;max-height:80%;'><p dir='auto'><br>$get_post_write</p></div>");
			}
		}elseif (!empty($link)) {
			echo "<iframe src='$link' style='border-radius:10px;width: 98%;height:80%;max-width: 98%;max-height:80%;'></iframe>";
		}elseif(!empty($question)){
			echo "<div dir='auto' style='width:30%;height:60%;background:white;box-shadow: 0px 0px 18px rgba(63, 81, 181, 0.16);border: 1px solid transparent;border-radius: 10px;'>
<div class='w3-light-grey' style='height:15%;border-radius:4px;text-align:center;'>
<script>
	function fl_$get_post_id() { 
		document.getElementById('incorr_$get_post_id').style.display = 'inline';
		document.getElementById('corr_$get_post_id').style.display = 'none';
		document.getElementById('nim_op1_$get_post_id').style.display = 'none';
		document.getElementById('nim_op2_$get_post_id').style.display = 'none';
		document.getElementById('nim_op3_$get_post_id').style.display = 'none';
		document.getElementById('opdi1_$get_post_id').style.background = 'green';
		";
		echo"
	}
	function tr_$get_post_id() { 
		document.getElementById('corr_$get_post_id').style.display = 'inline';
		document.getElementById('incorr_$get_post_id').style.display = 'none';
		document.getElementById('nim_op1_$get_post_id').style.display = 'none';
		document.getElementById('nim_op2_$get_post_id').style.display = 'none';
		document.getElementById('nim_op3_$get_post_id').style.display = 'none';
		document.getElementById('opdi1_$get_post_id').style.background = 'green';
		";
		echo"
	}
</script>
<br>
$question
</div>
<br>
<div id='";if($ch_co == "a"){echo"opdi1_$get_post_id";}elseif($ch_co != "a"){echo"opdin1_$get_post_id";}echo"' style='width:100%;height:15%;border-radius:25px;border: thin solid  grey;background:;' onclick='";if($ch_co == "a"){echo"tr_$get_post_id()";}else{echo"fl_$get_post_id()";}echo"'><div style='border-radius:4px;' id='aod'>
<br>&nbsp;&nbsp;&nbsp;<span id='nim_op1_$get_post_id' style='border: solid grey;border-radius:100px;padding:5px 5px;'>A</span>&nbsp;&nbsp;  ";if($ch_co == "a"){echo"<img src=\"".$imgs_path."main_icons/2705.png\" id='corr_$get_post_id' style='display:none;width:20px;height:20px;'>";}echo"
$op1</div>
</div>
<br>
<div id='";if($ch_co == "b"){echo"opdi1_$get_post_id";}elseif($ch_co != "b"){echo"opdin2_$get_post_id";}echo"' style='width:100%;height:15%;border-radius:25px;border: thin solid  grey;background:;' onclick='";if($ch_co == "b"){echo"tr_$get_post_id()";}else{echo"fl_$get_post_id()";}echo"'><div style='border-radius:4px;' id='bod'>
<br>&nbsp;&nbsp;&nbsp;<span id='nim_op2_$get_post_id' style='border: solid grey;border-radius:100px;padding:5px 5px;'>B</span>&nbsp;&nbsp;  ";if($ch_co == "b"){echo"<img src=\"".$imgs_path."main_icons/2705.png\" id='corr_$get_post_id' style='display:none;width:20px;height:20px;'>";}echo"
$op2</div>
</div>
<br>
<div id='";if($ch_co == "c"){echo"opdi1_$get_post_id";}elseif($ch_co != "c"){echo"opdin3_$get_post_id";}echo"' style='width:100%;height:15%;border-radius:25px;border: thin solid  grey;background:;' onclick='";if($ch_co == "c"){echo"tr_$get_post_id()";}else{echo"fl_$get_post_id()";}echo"'><div style='border-radius:4px;' id='zod'>
<br>&nbsp;&nbsp;&nbsp;<span id='nim_op3_$get_post_id' style='border: solid grey;border-radius:100px;padding:5px 5px;'>C</span>&nbsp;&nbsp;  ";if($ch_co == "c"){echo"<img src=\"".$imgs_path."main_icons/2705.png\" id='corr_$get_post_id' style='display:none;width:20px;height:20px;'>";}echo"
$op3<br>
</div></div>
	<div id='incorr_$get_post_id' style='display:none'>not correct</div>
</div>
";
		}elseif(!empty($poll_ques)){
			echo"<div class='w3-grey' style='border:thin solid black;height:200px;width:350px;border-radius:10px;box-shadow: 0px 0px 18px rgba(63, 81, 181, 0.16);'>
<br>
<p style='text-align:center;width:100%;font-size:25px;color:purple;'>$poll_ques</p>
<br>
<br>";
//poll_yes
$s_idi = $_SESSION['id'];

$get_post_id_i = $postsfetch['post_id'];
$csql = "SELECT id FROM polls WHERE poller=:s_idi AND post_id=:get_post_id_i";
$c = $conn->prepare($csql);
$c->bindParam(':s_idi',$s_idi,PDO::PARAM_INT);
$c->bindParam(':get_post_id_i',$get_post_id_i,PDO::PARAM_INT);
$c->execute();
$c_num = $c->rowCount();
if ($c_num > 0){
}else{
}
$likes_sql = "SELECT id FROM polls WHERE post_id=:get_post_id_i AND yes=1";
$likes = $conn->prepare($likes_sql);
$likes->bindParam(':get_post_id_i',$get_post_id_i,PDO::PARAM_INT);
$likes->execute();
$likes_numi = $likes->rowCount();

//poll_no
$s_idn = $_SESSION['id'];
$get_post_id_n = $postsfetch['post_id'];
$csql = "SELECT id FROM polls WHERE poller=:s_idn AND post_id=:get_post_id_n";
$c = $conn->prepare($csql);
$c->bindParam(':s_idn',$s_idn,PDO::PARAM_INT);
$c->bindParam(':get_post_id_n',$get_post_id_n,PDO::PARAM_INT);
$c->execute();
$c_num = $c->rowCount();
if ($c_num > 0){
}else{
}
$likes_sql = "SELECT id FROM polls WHERE post_id=:get_post_id_n AND no=1";
$likes = $conn->prepare($likes_sql);
$likes->bindParam(':get_post_id_n',$get_post_id_n,PDO::PARAM_INT);
$likes->execute();
$likes_num = $likes->rowCount();
////////////////////
$likes_sqli = "SELECT id FROM polls WHERE post_id=:get_post_id_n";
$likesi = $conn->prepare($likes_sqli);
$likesi->bindParam(':get_post_id_n',$get_post_id_n,PDO::PARAM_INT);
$likesi->execute();
$likesi = $likesi->rowCount();
//yes
$likes_sqly = "SELECT id FROM polls WHERE post_id=:get_post_id_i";
$likesy = $conn->prepare($likes_sqly);
$likesy->bindParam(':get_post_id_i',$get_post_id_i,PDO::PARAM_INT);
$likesy->execute();
$likesy = $likesy->rowCount();
//yes
if ($likes_numi == 0) {

    $likenumi = "0";
}elseif ($likes_numi == 1){
    $likenumi = 1/$likesy*100;
}else{
    $likenumi = $likes_numi/$likesy*100;
}
//no
if ($likes_num == 0) {
    $likenumn = "0";
}elseif ($likes_num == 1){
    $likenumn = 1/$likesi*100;
}else{
    $likenumn = $likes_num/$likesi*100;
}
echo"
<div class='w3-light-grey' style='border:thin solid black;height:60px;width:350px;border-radius:25px;box-shadow: 0px 0px 18px rgba(63, 81, 181, 0.16);'>
<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<p onclick=\"votey('$get_post_id_i')\" style='display:inline;border:none;text-align:left;'><span id='pollcouy_$get_post_id_n'>$ye_poll</span><span style='";if(!empty($c_num)){echo"display:inline";}else{echo"display:none";} echo"' id='postLikeCounti_$get_post_id_i'>$likenumi%</span></p>
<p onclick=\"voten('$get_post_id_i')\" style='display:inline;border:none;text-align:right;float:right;'><span id='pollcoun_$get_post_id_n'>$no_poll</span><span style='";if(!empty($c_num)){echo"display:inline";}else{echo"display:none";} echo"' id='postLikeCounti_$get_post_id_n'>$likenumn%</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</div>
</div>";
		}
		elseif (!empty($shP_img)) {
			if(preg_match("/.(png|jpeg|jpg)$/i", $shP_img/*importent!!!*/)){
			if(!empty($img_op)){
        echo "<div id='pr_$get_post_id'><img class='$img_sty' align='center' style='object-fit:cover;object-position:50% 50%;border-radius:10px;width: 98%;height:400px;max-width: 98%;max-height:400px;opacity:$img_op;' onclick='lightbox(\"$get_post_id\")' id='lightboxImg_$get_post_id' src=\"../imgs/$shP_img\" alt='$query_fetch_fullname' /></div>";
			}else{
				echo"<div id='pr_$get_post_id'><img class='$img_sty' align='center' style='object-fit:cover;object-position:50% 50%;border-radius:10px;width: 98%;height:400px;max-width: 98%;max-height:400px;' onclick='lightbox(\"$get_post_id\")' id='lightboxImg_$get_post_id' src=\"../imgs/$shP_img\" alt='$query_fetch_fullname' /></div>";
			}		}elseif(preg_match("/.(mp4|ogg|wmb)$/i", $shP_img/*importent!!!*/)){
			 echo "<video controls autoplay align='center' style='border-radius:10px;width: 98%;height:400px;max-width: 98%;max-height:400px;object-fit:cover;' id='lightboxImg_$get_post_id' src=\"../imgs/$shP_img\">Your browser don't support videos!!!</video>";
		}elseif(preg_match("/.(mp3)$/i", $shP_img/*importent!!!*/)){
				 echo "<audio controls autoplay align='center' style='border-radius:10px;width: 98%;height:400px;max-width: 98%;max-height:400px;' id='lightboxImg_$get_post_id' src=\"../imgs/$shP_img\">Your browser don't support audios!!!</audio>";
		}elseif(preg_match("/.(pdf)$/i", $shP_img/*importent!!!*/)){ 
		echo "<embed align='center' id='lightboxImg_$get_post_id' style='border-radius:10px;width: 98%;height:400px;max-width: 98%;max-height:400px;' type='application/pdf' src=\"../imgs/$shP_img\"></embed>";
		}
		}
echo "
</div>
</div>
";
}
// ===================tools==================
echo "
</div>
<div id='postNotify2_$get_post_id'></div>
<div>&nbsp;&nbsp;&nbsp;&nbsp;";
//like
$s_id = $_SESSION['id'];
$csql = "SELECT id FROM likes WHERE liker=:s_id AND post_id=:get_post_id";
$c = $conn->prepare($csql);
$c->bindParam(':s_id',$s_id,PDO::PARAM_INT);
$c->bindParam(':get_post_id',$get_post_id,PDO::PARAM_INT);
$c->execute();
$c_num = $c->rowCount();
if ($c_num > 0){
    echo "<span id='likeUnlike_$get_post_id' style='cursor:pointer'><span onclick=\"likeUnlike('$get_post_id')\" style='color:#ff928a;font-size:30px' data-toggle='tooltip' data-placement='top' title='".lang('u_liked_this')."' id='punlike'><span class=\"fa fa-heart\"></span></span></span>";
}else{
    echo "<span id='likeUnlike_$get_post_id' style='cursor:pointer'><span onclick=\"likeUnlike('$get_post_id')\" style='color:#ff928a;font-size:30px' data-toggle='tooltip' data-placement='top' title='".lang('liked')."' id='plike'><span class=\"fa fa-heart-o\"></span></span></span>";
}
$likes_sql = "SELECT id FROM likes WHERE post_id=:get_post_id";
$likes = $conn->prepare($likes_sql);
$likes->bindParam(':get_post_id',$get_post_id,PDO::PARAM_INT);
$likes->execute();
$likes_num = $likes->rowCount();
if ($likes_num == 0) {
    $likenum = "<span class='fa fa-heart'></span> ".lang('no_likes');
}elseif ($likes_num == 1){
    $likenum = "1 <span class='fa fa-heart' style='color: #ff928a;'></span>";
}else{
    $likenum = thousandsCurrencyFormat($likes_num)." <span class='fa fa-heart' style='color: #ff928a;'></span>";
}

//comment button
   echo" <a href=\"javascript:void(0);\"onclick=\"dis('d_$get_post_id')\" style='font-size:30px' class='post_like_comment_shareA' data-toggle='tooltip' data-placement='top' title='".lang('comment')."'><span onclick=\"fcomment('$get_post_id')\" class=\"fa fa-commenting\"></span></a>";
   if(!$poll_ques || !$question){
   echo" <a href=\"posts/mailsend?pid=$get_post_id\" style='font-size:28px' class='post_like_comment_shareA' data-toggle='tooltip' data-placement='top' title='Send a message'><span class=\"fa fa-envelope\"></span></a>";
   }$lik_cou = $likes_num + $likes_numi;
//share
echo "<a href='javascript:void(0);' style='font-size:30px' onclick=\"sharePost('$get_post_id','$check_path')\"  class='post_like_comment_shareA'data-toggle='tooltip' data-placement='top' title='".lang('share_now')."'><span class=\"fa fa-share\"></span></a>
        ";if(!$poll_ques || !$question){
		$so_id = $_SESSION['id'];
$csql = "SELECT id FROM saved WHERE user_saved_id=:so_id AND post_id=:get_post_id";
$co = $conn->prepare($csql);
$co->bindParam(':so_id',$so_id,PDO::PARAM_INT);
$co->bindParam(':get_post_id',$get_post_id,PDO::PARAM_INT);
$co->execute();
$co_num = $co->rowCount();

while ($query_fetch = $co->fetch(PDO::FETCH_ASSOC)) {
    $saved_id = $query_fetch['id'];
}
if ($co_num > 0){
		echo"<span id='saveud_$get_post_id' style='cursor:pointer'><a href='javascript:void(0)' style='font-size:30px;float:right;margin-right:20px;' class='post_like_comment_shareA' onclick=\"deleteSaved('$saved_id');\"><span class='fa fa-bookmark'></span></a></span>";
}else{
		echo"<span id='saveu_$get_post_id' style='cursor:pointer'><a href='javascript:void(0)' style='font-size:30px;float:right;margin-right:20px;' class='post_like_comment_shareA' onclick=\"savePost('$get_post_id','$check_path')\"><span class='fa fa-bookmark-o'></span></a></span>";
}
	}echo"<p class='comment_details' style='text-align:".lang('textAlign').";'>
    <span id='postLikeCount_$get_post_id'>$likenum</span><span style='margin: 0px 5px;padding: 1px;'></span>
    <span id='postCommCount_$get_post_id'>$chtcnum</span><span style='margin: 0px 5px;padding: 1px;'></span>";
	if($poll_ques){
    echo"<span id='postvotCount_$get_post_id'>$lik_cou votes</span><span style='margin: 0px 5px;padding: 1px;'></span>";
	}
    echo"<span id='postShareCount_$get_post_id'>$shareCount</span>
    <span id='p_privacyView_$get_post_id' style='top: -20px;float:".lang('float2').";font-size: 15px;'>".$postPrivacy."</span>
    </p>
</div>
<div class=\"comment_box\">
<div id='d_$get_post_id' style='display: none;'>
<div class='user_comment' id='postComments_$get_post_id'>";
    include "../includes/fetch_comments.php";
echo"
</div>
</div>
<div id='writeComm_$get_post_id'>
<div style='position:relative;display:flex;background: #fff; box-shadow: 2px 2px rgba(0, 0, 0, 0.04); border-radius: 20px;'>
  <textarea dir=\"auto\" autocomplete='off' class='comment_field' id='inputComm_$get_post_id' type=\"text\" data-cid='$get_post_id' data-path='$check_path' name=\"$get_post_id\" placeholder='".lang('comment_field_ph')."' style='text-align:".lang('comment_field_align').";' ></textarea>
  <span class='emoticonsBtn fa fa-smile-o' onclick=\"cEmojiBtn('$get_post_id')\" id='#embtn_".$get_post_id."'></span>
      <div id='em_$get_post_id' data-emtog='0' style='".lang('float2').":0;' class='emoticonsBox'></div>
	  <span class='emoticonsBtn fa fa-photo' onclick=\"showimg('imgdivcom_$get_post_id')\" id='#embtn_".$get_post_id."'></span>
</div>
<p style='font-size: 10px; padding: 0px 10px; border: none; margin: 0; margin-top: 3px;'>".lang('newLine_Shift_enter')." Shift+Enter</p>
</div>

<div id='CommentLoading_$get_post_id'>
</div>
<div id='imgdivcom_$get_post_id' style='display:none'>";
echo lang('Click_on_emoji_icon_to_display_the_pictures'); echo".<span class='fa fa-smile-o'></span>";
echo"<form action='' method='post'>";
 
$vpsql = "SELECT * FROM wpost WHERE p_privacy = 0";
$view_posts = $conn->prepare($vpsql);
$view_posts->bindValue(':s_id', $s_id, PDO::PARAM_INT);
$view_posts->bindValue(':p_privacy', $p_privacy, PDO::PARAM_INT);
$view_posts->bindValue(':plimit', (int)trim($plimit), PDO::PARAM_INT);
$view_posts->execute();

$view_postsNum = $view_posts->rowCount();
if ($view_postsNum > 0) {

while ($postsfetch = $view_posts->fetch(PDO::FETCH_ASSOC)) {
$get_author_id = $postsfetch['author_id'];
$get_post_author = $postsfetch['post_author'];
$get_post_author_photo = $postsfetch['post_author_photo'];
$get_post_img = $postsfetch['post_img'];
$get_post_time = $postsfetch['post_time'];
$img_sty = $postsfetch['img_sty'];
$img_op = $postsfetch['img_opacity'];
$get_post_content = $postsfetch['post_content'];
$session_userphoto_path = $check_path."imgs/user_imgs/";
$session_userphoto = $session_userphoto_path . $_SESSION['Userphoto'];
$timeago = time_ago($get_post_time);
$get_post_title = $postsfetch['p_title'];
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
echo "<div style=''>";
        if (!empty($get_post_img)) {
			if(preg_match("/.(png|jpeg|jpg)$/i", $get_post_img/*importent!!!*/)){
				if(!empty($img_op)){
        echo "
		<label for='$get_post_img'><input style='display:none;' value='imgs/$get_post_img' type='radio' id='$get_post_img' name='img_gif'><img src='../imgs/$get_post_img' style='height:10%;width:20%;' alt='gif'></label>";
			}else{
		echo "<label for='$get_post_img'><input style='display:none;' value='imgs/$get_post_img' type='radio' id='$get_post_img' name='img_gif'><img src='../imgs/$get_post_img' style='height:10%;width:20%;' alt='gif'></label>";

			}}
}
		echo "</div>";
}

}else{
	echo "0";
}
echo"
<input type='hidden' name='post_id' value='$get_post_id'>
		 <button name='com_btn' class='default_flat_btn' style='background:blue;'>send</button>
		 </form>
</div>
</div></div>
";

}
?>

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
		<?php
        }else{
        ?>
        <style type="text/css">
        body{
        background: #fff;
        }
            .error_page_btn{
        background: whitesmoke;
        padding: 8px;
        border-radius: 3px;
        color: #6b6b6b;
        text-decoration: none;
        box-shadow: inset 1px 1px 3px rgba(0, 0, 0, 0.05);
        transition: background 0.1s , color 0.1s;
            }
            .error_page_btn:hover, .error_page_btn:focus{
        background: #4a708e;
        color: #fff;
        text-decoration: none;
            }
            .error_div{
        padding: 15px;
        max-width: 800px;
        color: #383838;
        box-shadow: none;
        border: 1px solid rgba(217, 217, 217, 0.36);
        }
        </style>
        <div align="center" style="margin-top: 150px;margin-bottom: 150px;">
        <div class="post error_div" style="border-radius:10px;" align="center">
        <h1 style="font-weight: bold;"><img src="../imgs/main_icons/1f915.png" style="width: 80px;height: 80px;" /> <?php echo lang('profilePageNotFound_str1'); ?></h1>
        <h3><?php echo lang('profilePageNotFound_str2'); ?></h3><br>
        <a href="javascript:history.back()" style="border-radius:4px;" class="error_page_btn"><?php echo lang('profilePageNotFound_str3'); ?></a>
        </div></div>
        <?php
        }
        ?>
        </div>
    </div>
</div>
<br>

<?php include "../includes/endJScodes.php"; ?>
</body>
</html>
