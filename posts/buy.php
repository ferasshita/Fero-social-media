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
if($_SESSION['phone'] == null){
header("location:../settings.php");
}else{
?>
<html>
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
<link href="https://www.w3schools.com/w3css/4/w3.css" rel="stylesheet">
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
    echo"
	<script>

        if(navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var positionInfo =  position.coords.latitude;
				var positionlog = position.coords.longitude;
                document.getElementById(\"lat$post_id\").value = positionInfo;
                document.getElementById(\"long$post_id\").value = positionlog;
            });
        } else {
            alert(\"Sorry, your browser does not support HTML5 geolocation.\");
        }

</script>
	<input type='hidden' id='lat$post_id' name='lat'>
    <input type='hidden' id='long$post_id' name='long'>";
$all_users_sql = "SELECT * FROM buy WHERE post_id=:post_id AND author_id=:sid";
$all_users = $conn->prepare($all_users_sql);
$all_users->bindParam(':post_id',$post_id,PDO::PARAM_STR);
$all_users->bindParam(':sid',$sid,PDO::PARAM_STR);
$all_users->execute();
$view_postsNum = $all_users->rowCount();
if($view_postsNum < 1){
	echo"<span id='buy_$post_id' class='w3-bottom' style='cursor:pointer;min-width:100%'><span class=\"unfollow_btn\" style='min-width:100%' onclick=\"buy('$post_id')\"><span class=\"fa fa-check\"></span> ".lang('Buy')."</span></span>";
}else{
while ($fetch_users = $all_users->fetch(PDO::FETCH_ASSOC)) {
$post_ido = $fetch_users['post_id'];
$author_ido = $fetch_users['author_id'];
$cql = "SELECT * FROM buy WHERE post_id=:post_id AND author_id=:sid";
$c = $conn->prepare($cql);
$c->bindParam(':post_id',$post_id,PDO::PARAM_STR);
$c->bindParam(':sid',$sid,PDO::PARAM_STR);
$c->execute();
$c_num = $c->rowCount();
if ($c_num == 1){
    $follow_btn = "<span id='buy_$post_ido' class=\"w3-bottom\" style=\"cursor:pointer;min-width:100%\"><span class=\"unfollow_btn\" style=\"min-width:100%\" onclick=\"buy('$post_ido')\"><span class=\"fa fa-check\"></span> ".lang('Buy')."</span></span>";
}else{
    $follow_btn = "<span id='buy_$post_ido' class='w3-bottom' style='cursor:pointer;min-width:100%'><span class=\"follow_btn\" style='min-width:100%' onclick=\"buy('$post_ido')\"><span class=\"fa fa-plus-circle\"></span> ".lang('wait')."</span></span>";
}
if($author_id != $_SESSION['id']){
    $fbtn = $follow_btn;
}else{
    $fbtn = '';
}
echo "
<span style='min-width:100%'>$fbtn</span>
";
}
}
//shared posts///////////////////////////////////////////////////////////////////////////////
   echo"<div style='right:1;' class='w3-top'><div class='w3-white w3-large w3-bar'>    <table style='width:100%;'>
    <tr>
    <td style='width:50px;'>
    <div class='username_OF_postImg'><img src=\"".$imgs_path."user_imgs/$query_fetch_userphoto\"></div><td>
    <td>
    <a href='".$check_path."u/$query_fetch_username' class='username_OF_postLink'>$query_fetch_fullname</a><br/>
    <a href='".$check_path."posts/post?pid=".$get_post_id."' class='username_OF_postTime'>$timeago</a>
    </td>

    </tr>
    </table></div></div>";
   echo "
    <div class='posti' style='min-width: 99%;border-radius:10px;' id='$get_post_id' style='text-align:".lang('post_align').";'>
    <div id='postNotify_$get_post_id'></div>
    <div class='username_OF_post'>
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
	if(!empty($get_post_img)){
		if(preg_match("/.(png|jpeg|jpg)$/i", $get_post_img/*importent!!!*/)){
			if(!empty($img_op)){
        echo "<div id='pr_$get_post_id'><img class='$img_sty' align='center' style='object-fit:cover;object-position:50% 50%;width: 98%;height:450px;border-radius:10px;max-width: 98%;max-height:80%;opacity:$img_op;' onclick='lightbox(\"$get_post_id\")' id='lightboxImg_$get_post_id' src=\"../imgs/$get_post_img\" alt='$query_fetch_fullname' /></div>";
			}else{
				echo"<div id='pr_$get_post_id'><img class='$img_sty' align='center' style='object-fit:cover;object-position:50% 50%;width: 98%;border-radius:10px;height:450px;max-width: 98%;max-height:80%;' onclick='lightbox(\"$get_post_id\")' id='lightboxImg_$get_post_id' src=\"../imgs/$get_post_img\" alt='$query_fetch_fullname' /></div>";
			}
		}elseif(preg_match("/.(mp4|ogg|wmb)$/i", $get_post_img/*importent!!!*/)){
			 echo "<video controls autoplay align='center' class='$img_sty' style='width: 98%;border-radius:10px;height:450px;max-width: 98%;max-height:80%;' id='lightboxImg_$get_post_id' src=\"../imgs/$get_post_img\">Your browser don't support videos!!!</video>";
		}elseif(preg_match("/.(mp3)$/i", $get_post_img/*importent!!!*/)){
				 echo "<audio controls autoplay align='center' style='width: 98%;height:450px;border-radius:10px;max-width: 98%;max-height:80%;' id='lightboxImg_$get_post_id' src=\"../imgs/$get_post_img\">Your browser don't support audios!!!</audio>";
		}elseif(preg_match("/.(pdf)$/i", $get_post_img/*importent!!!*/)){
		echo "<embed align='center' id='lightboxImg_$get_post_id' style='width: 98%;border-radius:10px;height:450px;max-width: 98%;max-height:80%;' type='application/pdf' src=\"../imgs/$get_post_img\"></embed>";
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
echo"<div style='right:1;' class='w3-bottom'><div class='w3-white w3-large w3-bar'><button class='w3-bar-item w3-button'>cdkhjdskaj</button></div></div>";
echo"<div style='right:1;' class='w3-top'><div class='w3-white w3-large w3-bar'><div class='username_OF_postImg w3-bar-item w3-button'><img src=\"".$imgs_path."user_imgs/$query_fetch_userphoto\"></div></div>";
echo "
<div class=\"post\" style='min-width: 98%;border-radius:10px; max-height:650px;' id=\"$shP_id\" style='margin: 0;text-align:".lang('post_align').";'>
<div class=\"username_OF_post\">
</div><div id='postTitle_$get_post_id'>";
if (!empty($shP_title)) {
    echo "<p class='postTitle' style='border-".lang('float').": 2px solid rgba(80, 94, 113, 0.19); text-align: ".lang('textAlign').";'>$shP_title</p>";
}

	if (!empty($shP_img)) {
			if(preg_match("/.(png|jpeg|jpg)$/i", $shP_img/*importent!!!*/)){
			if(!empty($img_op)){
        echo "<div id='pr_$get_post_id'><img class='$img_sty' align='center' style='object-fit:cover;object-position:50% 50%;border-radius:10px;width: 98%;height:450px;max-width: 98%;max-height:400px;opacity:$img_op;' onclick='lightbox(\"$get_post_id\")' id='lightboxImg_$get_post_id' src=\"../imgs/$shP_img\" alt='$query_fetch_fullname' /></div>";
			}else{
				echo"<div id='pr_$get_post_id'><img class='$img_sty' align='center' style='object-fit:cover;object-position:50% 50%;border-radius:10px;width: 98%;height:450px;max-width: 98%;max-height:400px;' onclick='lightbox(\"$get_post_id\")' id='lightboxImg_$get_post_id' src=\"../imgs/$shP_img\" alt='$query_fetch_fullname' /></div>";
			}		}elseif(preg_match("/.(mp4|ogg|wmb)$/i", $shP_img/*importent!!!*/)){
			 echo "<video controls autoplay align='center' style='border-radius:10px;width: 98%;height:450px;max-width: 98%;max-height:400px;object-fit:cover;' id='lightboxImg_$get_post_id' src=\"../imgs/$shP_img\">Your browser don't support videos!!!</video>";
		}elseif(preg_match("/.(mp3)$/i", $shP_img/*importent!!!*/)){
				 echo "<audio controls autoplay align='center' style='border-radius:10px;width: 98%;height:450px;max-width: 98%;max-height:400px;' id='lightboxImg_$get_post_id' src=\"../imgs/$shP_img\">Your browser don't support audios!!!</audio>";
		}elseif(preg_match("/.(pdf)$/i", $shP_img/*importent!!!*/)){
		echo "<embed align='center' id='lightboxImg_$get_post_id' style='border-radius:10px;width: 98%;height:450px;max-width: 98%;max-height:400px;' type='application/pdf' src=\"../imgs/$shP_img\"></embed>";
		}
		}
		echo"<button id='buy_$post_id' class='unfollow_btn' onclick='buy($post_id)' class='w3-bottom'>Buy now </button>";
echo "
</div>
</div>
";
$all_users_sql = "SELECT * FROM buy WHERE post_id=:post_id AND author_id=:sid";
$all_users = $conn->prepare($all_users_sql);
$all_users->bindParam(':post_id',$post_id,PDO::PARAM_STR);
$all_users->bindParam(':sid',$sid,PDO::PARAM_STR);
$all_users->execute();
$view_postsNum = $all_users->rowCount();
if($view_postsNum < 1){
	echo"<span id='buy_$post_id' class='w3-bottom' style='cursor:pointer;min-width:100%'><span class=\"unfollow_btn\" style='min-width:100%' onclick=\"buy('$post_id')\"><span class=\"fa fa-check\"></span> Buy</span></span>";
}else{
while ($fetch_users = $all_users->fetch(PDO::FETCH_ASSOC)) {
$post_ido = $fetch_users['post_id'];
$author_ido = $fetch_users['author_id'];
$cql = "SELECT * FROM buy WHERE post_id=:post_id AND author_id=:sid";
$c = $conn->prepare($cql);
$c->bindParam(':post_id',$post_id,PDO::PARAM_STR);
$c->bindParam(':sid',$sid,PDO::PARAM_STR);
$c->execute();
$c_num = $c->rowCount();
if ($c_num == 1){
    $follow_btn = "<span id='buy_$post_ido' class='w3-bottom' style='cursor:pointer;min-width:100%'><span class=\"unfollow_btn\" style='min-width:100%' onclick=\"buy('$post_ido')\"><span class=\"fa fa-check\"></span> Buy</span></span>";
}else{
    $follow_btn = "<span id='buy_$post_ido' class='w3-bottom' style='cursor:pointer;min-width:100%'><span class=\"follow_btn\" style='min-width:100%' onclick=\"buy('$post_ido')\"><span class=\"fa fa-plus-circle\"></span> Wait</span></span>";
}
if($author_id != $_SESSION['id']){
    $fbtn = $follow_btn;
}else{
    $fbtn = '';
}
echo "
<span style='min-width:100%'>$fbtn</span>
";
}
}
// ===================tools==================
echo "
</div>
<div id='postNotify2_$get_post_id'></div>
";

//shared posts///////////////////////////////////////////////////////////////////////////////

echo"
</div>
</div></div>
";

}
?>
<br>
<br>

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
}}
</script>
		<?php
  } } }?>
        </div>
    </div>
</div>
<br>

<?php include "../includes/endJScodes.php"; ?>
</body>
</html>
