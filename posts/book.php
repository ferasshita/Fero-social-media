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
    <title>Novel &bull; Fero</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="../css/img_s.css" rel="stylesheet">
    <?php include "../includes/head_imports_main.php";?>
	<style>
	.posti{
    background: white;
    border-radius: 10px;
    box-shadow: 0px 0px 18px rgba(63, 81, 181, 0.16);
    max-width: 100%;
	height:40%;
	min-width: 1300px;
    margin: -6px 5px;
    border: 1px solid transparent;
}
@media screen and (max-width:600px){
	.posti{
		min-width: 100%;
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
<body onload="fetchPosts_DB('home')">
	<script>
	$(window).load(function(){
	$(".se-pre-con").fadeOut("slow");});		
</script>
<div class="se-pre-con"><img class="iconsa" src="../imgs/logo.ico" alt="logo"></div>
<div style="background: white;">
<!--=============================[ NavBar ]========================================-->
<?php include "../includes/navbar_main.php"; ?>
<div class="w3-bottom">
<div class="w3-bar w3-white w3-large">
<a href="../story" class="w3-bar-item w3-button" style='color:orange' target="_self" title="story"><i class="fa fa-star"></i></a>
<a href="u/<?php echo $_SESSION['Username']; ?>" class="w3-bar-item w3-button" target="_self" title="profile"><i class="fa fa-user"></i></a>
<a href="../search" class="w3-bar-item w3-button" target="_self" title="search"><i class="fa fa-search"></i></a>
<a href="../post" class="w3-bar-item w3-button" target="_self" title="add an image"><i class="fa fa-upload"></i></a>
<a href="../explore" class="w3-bar-item w3-button" target="_self" title="explore"><i class="fa fa-compass"></i></a>
<a href="../home" class="w3-bar-item w3-button" target="_self" title="home"><i class="fa fa-home"></i></a>
</div>
</div>
<div class="main_container" align="center">
    <div style="display: inline-flex" align="center">
        <div align="left">
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
/////content/////////////
while ($postsfetch = $view_posts->fetch(PDO::FETCH_ASSOC)) {
$get_post_id = $postsfetch['post_id'];
$get_author_id = $postsfetch['author_id'];
$get_post_author = $postsfetch['post_author'];
$get_post_author_photo = $postsfetch['post_author_photo'];
$get_post_img = $postsfetch['post_img'];
$get_post_time = $postsfetch['post_time'];
$get_post_content = $postsfetch['post_content'];
$get_post_head = $postsfetch['hea_wr'];
$get_post_story = $postsfetch['s_wr'];
$get_post_write = $postsfetch['p_write'];
$img_sty = $postsfetch['img_sty'];
$w_photo_v = $postsfetch['w_photo_v'];
$img_op = $postsfetch['img_opacity'];
$color = $postsfetch['color'];
$font = $postsfetch['font'];
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
$qsql = "SELECT * FROM signup WHERE id=:get_author_id";
$query = $conn->prepare($qsql);
$query->bindParam(':get_author_id', $get_author_id, PDO::PARAM_INT);
$query->execute();

while ($query_fetch = $query->fetch(PDO::FETCH_ASSOC)) {
    $query_fetch_id = $query_fetch['id'];
    $query_fetch_username = $query_fetch['Username'];
    $query_fetch_fullname = $query_fetch['Fullname'];
    $query_fetch_userphoto = $query_fetch['Userphoto'];
	$img_cover = $query_fetch['user_cover_photo'];
    $query_fetch_verify = $query_fetch['verify'];
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
    <div class='posti' style='' id='$get_post_id' style='text-align:".lang('post_align').";'>";
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
    <input type='text' dir='auto' class='flat_solid_textfield' id='EditTitleBox_$get_post_id' style='min-height: auto;' placeholder='Write a header to your story...' value='$get_post_head' />
    <textarea dir='auto' class='postContent_EditBox' id='EditBox_$get_post_id'>$get_post_story</textarea>
    <div>
    <a href='javascript:void(0)' onclick=\"editPost_save('$get_post_id','$check_path')\" class='default_flat_btn'>".lang('save')."</a>
    <a href='javascript:void(0)' onclick=\"editPost_cancel('$get_post_id')\" class='silver_flat_btn'>".lang('cancel')."</a>

    </div>
    </div>
    <div id='postLoading_$get_post_id'></div>
    "; 
	echo"<div style='max-width:100%;'><h1 align='center'>$get_post_head</h1>";
	echo"
	<table style='width:100%;'>
    <tr>
    <td style='width:50px;'>
    <div class='username_OF_postImg'><img src=\"".$imgs_path."user_imgs/$query_fetch_userphoto\"></div><td>
    <td>
    <a href='".$check_path."u/$query_fetch_username' class='username_OF_postLink'>$query_fetch_fullname</a><br/>
    ";if($location){echo"<a class='username_OF_postTime'><span class='fa fa-map-marker'></span> $location &bull; </a>";}echo"<a href='".$check_path."posts/post?pid=".$get_post_id."' class='username_OF_postTime'>$timeago</a>
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
    </table><br>";
	if(!empty($w_photo_v)){
echo "
<img align='center' class='$img_sty' loading='lazy' style='width: 100%;height:600px;max-width: 100%;max-height:600px;opacity: $img_op;' id='lightboxImg_$get_post_id' src=\"../imgs/$w_photo_v\" alt='$query_fetch_fullname' />";
}

echo nl2br("<p dir='auto' style='font-size: 20px;'>
$get_post_story</p>");
echo"</div>";
// ========= fetch share post ==========
if (!empty(trim($get_post_shared))) {
$fetch_shared = $conn->prepare("SELECT * FROM wpost WHERE post_id=:get_post_shared ");
$fetch_shared->bindParam(':get_post_shared',$get_post_shared,PDO::PARAM_INT);
$fetch_shared->execute();
while ($sharedRow = $fetch_shared->fetch(PDO::FETCH_ASSOC)) {
    $shP_id = $sharedRow['post_id'];
    $shP_aid = $sharedRow['author_id'];
    $shP_img = $sharedRow['post_img'];
	$img_sty = $sharedRow['img_sty'];
$img_op = $sharedRow['img_opacity'];
$w_photo_v = $sharedRow['w_photo_v'];
	$get_post_head = $sharedRow['hea_wr'];
$get_post_story = $sharedRow['s_wr'];
	$get_post_write = $sharedRow['p_write'];
		$color = $sharedRow['color'];
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
	echo"<h1 align='center'>$get_post_head</h1>";
	if(!empty($w_photo_v)){
echo "<img align='center' loading='lazy' class='$img_sty' style='width: 100%;height:600px;max-width: 100%;max-height:600px;opacity: $img_op;' id='lightboxImg_$get_post_id' src=\"../imgs/$w_photo_v\" alt='$query_fetch_fullname' />";
	}

echo nl2br("<p dir='auto' style='font-size: 20px;'>
$get_post_story</p>");
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
//share
echo "<a href='javascript:void(0);' style='font-size:30px' onclick=\"sharePost('$get_post_id','$check_path')\" class='post_like_comment_shareA' data-toggle='tooltip' data-placement='top' title='".lang('share_now')."'><span class=\"fa fa-share\"></span></a>
   ";
     echo " <div class='dropdown'>
    <a class='post_options dropdown-toggle' data-toggle='dropdown' href='#'><span class='fa fa-pencil'></span></a>
    <ul class='dropdown-menu ".lang('postropdown')."' style='top:10px;color:#999;text-align: ".lang('postropdownTxtAlign').";'>
    ";
    if ($get_author_id == $_SESSION['id']) {
            echo "
    <li><a href='javascript:void(0)' onclick=\"editPost('$get_post_id')\"><span class='fa fa-pencil'></span> ".lang('EditPost_DDM')."</a></li>
    <li><a href='javascript:void(0)' onclick=\"deletePost('$get_post_id')\"><span class='fa fa-trash-o'></span> ".lang('DeletePost_DDM')."</a></li>";
        }
    echo "
    </ul>
    </div>
    </td>
    </tr>
    </table>
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
    <select id='p_privacy_$get_post_id' style='padding: 8px 10px;'>
        <option $pub_privacySelected>".lang('wpr_public')."</option>
        <option $f_privacySelected>".lang('wpr_followers')."</option>
        <option $om_privacySelected>".lang('wpr_onlyme')."</option>
    </select>
    </div>
    </div>
    <div id='postLoading_$get_post_id'></div>
    ";
   echo"<p class='comment_details' style='text-align:".lang('textAlign').";'>
    <span id='postLikeCount_$get_post_id'>$likenum</span><span style='margin: 0px 5px;padding: 1px;'></span>
    <span id='postCommCount_$get_post_id'>$chtcnum</span><span style='margin: 0px 5px;padding: 1px;'></span>
    <span id='postShareCount_$get_post_id'>$shareCount</span>
    <span id='p_privacyView_$get_post_id' style='top: -20px;float:".lang('float2').";font-size: 15px;'>".$postPrivacy."</span>
    </p>
</div>
<div class=\"comment_box\">
<div id='d_$get_post_id' style='display: none;'>
<div class='user_comment' id='postComments_$get_post_id'>";
echo"
</div>
</div>
";
}
        }else{
			/////////////////////////////////////////////error///////
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
        <div class="post error_div" align="center">
        <h1 style="font-weight: bold;"><img src="../imgs/main_icons/1f915.png" style="width: 80px;height: 80px;" /> <?php echo lang('profilePageNotFound_str1'); ?></h1>
        <h3><?php echo lang('profilePageNotFound_str2'); ?></h3><br>
        <a href="javascript:history.back()" class="error_page_btn"><?php echo lang('profilePageNotFound_str3'); ?></a>
        </div></div>
        <?php
        }
        ?>
        </div>
    </div>
</div>
          
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
<?php include "../includes/endJScodes.php"; ?>
</div>
</body>
</html>
