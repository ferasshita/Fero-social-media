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
    <title>Chat &bull; Fero</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="../css/img_s.css" rel="stylesheet">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
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
<body>
	<script>
	$(window).load(function(){
	$(".se-pre-con").fadeOut("slow");});		
</script>
<div class="se-pre-con"><img class="iconsa" src="../imgs/logo.ico" alt="logo"></div>
<?php 

 ?>
<!--=============================[ NavBar ]========================================-->
                <?php
        $story_id = filter_var(htmlentities($_GET['pid']), FILTER_SANITIZE_NUMBER_INT);
        $sid = $_SESSION['id'];
        $fPosts_sql_sql = "SELECT * FROM messages WHERE m_to = :story_id AND m_from = :sid OR m_to = :sid AND m_from = :story_id";
        $view_posts = $conn->prepare($fPosts_sql_sql);
		$view_posts->bindParam(':sid',$sid,PDO::PARAM_INT);
		$view_posts->bindParam(':story_id',$story_id,PDO::PARAM_INT);
        $view_posts->execute();
		$countSaved = $view_posts->rowCount();
		if($countSaved > 1){
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
.storydiv{
height:100%;
width:100%;
}
.mn{
	display:inline;
}
@media screen and (max-width:600px){
.mn{
	display:none;
}}
.ca{
	display:none;
	
}
@media screen and (max-width:600px){
.ca{
	display:block;
	float:right;
}}
.feil{
	width:50%;
	resize:none;
	border:solid thin black;
	border-radius:20px;
	background: transparent;
}
@media screen and (max-width:600px){
	.feil{
	width:100%;
}}
.img-user{
	border-radius:50%;
	width:5%;
	height:10%;
	border:solid thin grey;
}
@media screen and (max-width:600px){
	.img-user{
	border-radius:50%;
	width:10%;
	height:5%;
	border:solid thin grey;
}
}
.vno{
	width:20%;
	height:10%;
	font-size:20px;
	border-radius:4px;
	padding:10px;
}
@media screen and (max-width:600px){
	.vno{
	min-width:40%;
	max-width:50%;
	height:10%;
}
}
	.cod{
	background: linear-gradient(500deg,#8910d6,#b52d94);
}
	.loader {
	position: fixed;
	left: 0px;
	top: 0px;
	width: 100%;
	background-color: #000000;
	height: 100%;
	z-index: 9999;
	overflow: scroll;
	color: white;
}
.messaged-field{
	border-radius:4px;
	width:50%;
	height:60px;
	resize:none;
	border:solid thin grey;
	text-align:left;
}
.img_mes{
	width:30%;height:50%;border-radius:10px;
}
@media screen and (max-width:600px){
	.img_mes{
		width:45%;height:35%;
	}
	}
.vi_mes{
	width:15%;height:100%;border-radius:10px;
	
}
@media screen and (max-width:600px){.vi_mes{width:30%;height:100%;}}
</style>
	<script type="text/javascript">
$(widow).load(function() {
$(".loader").fadeOut("slow");
});
</script>
<br><br><br>
<div id="refldiv">
				<?php
while ($postsfetch = $view_posts->fetch(PDO::FETCH_ASSOC)) {
$m_id = $postsfetch['m_id'];
$message = $postsfetch['message'];
$img_mess = $postsfetch['img'];
$m_from = $postsfetch['m_from'];
$m_to = $postsfetch['m_to'];
$m_time = $postsfetch['m_time'];
$ago_time = time_ago($m_time);
$m_seen = $postsfetch['m_seen'];
$m_like = $postsfetch['m_like'];
$m_hide = $postsfetch['m_hide'];
$post_ido = $postsfetch['post_id'];

$vpsqlo = "SELECT * FROM wpost WHERE post_id=:post_ido";
$view_postso = $conn->prepare($vpsqlo);
$view_postso->bindValue(':post_ido', $post_ido, PDO::PARAM_INT);
$view_postso->execute();

while ($postsfetcho = $view_postso->fetch(PDO::FETCH_ASSOC)) {
$get_post_id = $postsfetcho['post_id'];
$get_author_id = $postsfetcho['author_id'];
$get_post_author = $postsfetcho['post_author'];
$get_post_author_photo = $postsfetcho['post_author_photo'];
$get_post_img = $postsfetcho['post_img'];
$get_post_time = $postsfetcho['post_time'];
$img_sty = $postsfetcho['img_sty'];
$img_op = $postsfetcho['img_opacity'];
$get_post_content = $postsfetcho['post_content'];
$session_userphoto_path = $check_path."imgs/user_imgs/";
$session_userphoto = $session_userphoto_path . $_SESSION['Userphoto'];
$timeago = time_ago($get_post_time);
$get_post_title = $postsfetcho['p_title'];
$share = $postsfetcho['shared'];
if($share){
	$vpsqlo = "SELECT * FROM wpost WHERE post_id=:share";
$view_postsp = $conn->prepare($vpsqlo);
$view_postsp->bindValue(':share', $share, PDO::PARAM_INT);
$view_postsp->execute();
while ($postsfetchp = $view_postsp->fetch(PDO::FETCH_ASSOC)) {
	$get_post_id = $postsfetchp['post_id'];
$get_author_id = $postsfetchp['author_id'];
$get_post_author = $postsfetchp['post_author'];
$get_post_author_photo = $postsfetchp['post_author_photo'];
$get_post_img = $postsfetchp['post_img'];
$get_post_time = $postsfetchp['post_time'];
$img_sty = $postsfetchp['img_sty'];
$img_op = $postsfetchp['img_opacity'];
$get_post_content = $postsfetchp['post_content'];
$session_userphoto_path = $check_path."imgs/user_imgs/";
$session_userphoto = $session_userphoto_path . $_SESSION['Userphoto'];
$timeago = time_ago($get_post_time);
$get_post_title = $postsfetchp['p_title'];
$share = $postsfetchp['shared'];
}
}

$qsql = "SELECT * FROM signup WHERE id=:get_author_id";
$query = $conn->prepare($qsql);
$query->bindParam(':get_author_id', $get_author_id, PDO::PARAM_INT);
$query->execute();

while ($query_fetch = $query->fetch(PDO::FETCH_ASSOC)) {
    $po_id = $query_fetch['id'];
    $po_un = $query_fetch['Username'];
    $po_fu = $query_fetch['Fullname'];
    $po_up = $query_fetch['Userphoto'];
    $po_ver = $query_fetch['verify'];
}
}


$qsql = "SELECT * FROM signup WHERE id=:m_from";
$query = $conn->prepare($qsql);
$query->bindParam(':m_from', $m_from, PDO::PARAM_INT);
$query->execute();

while ($query_fetch = $query->fetch(PDO::FETCH_ASSOC)) {
    $my_id = $query_fetch['id'];
    $my_un = $query_fetch['Username'];
    $my_fu = $query_fetch['Fullname'];
    $my_up = $query_fetch['Userphoto'];
    $my_ver = $query_fetch['verify'];
}
    if ($my_ver == "1"){
        $my_ver = $verifyUser;
        }else{
        $my_ver = "";
    }

$qsql = "SELECT * FROM signup WHERE id=:m_to";
$query = $conn->prepare($qsql);
$query->bindParam(':m_to', $m_to, PDO::PARAM_INT);
$query->execute();

while ($query_fetch = $query->fetch(PDO::FETCH_ASSOC)) {
    $his_id = $query_fetch['id'];
    $his_un = $query_fetch['Username'];
    $his_fu = $query_fetch['Fullname'];
    $his_up = $query_fetch['Userphoto'];
    $his_ver = $query_fetch['verify'];
}
    if ($his_ver == "1"){
        $his_ver = $verifyUser;
        }else{
        $his_ver = "";
    }
$qsql = "SELECT * FROM signup WHERE id=:story_id";
$query = $conn->prepare($qsql);
$query->bindParam(':story_id', $story_id, PDO::PARAM_INT);
$query->execute();

while ($query_fetch = $query->fetch(PDO::FETCH_ASSOC)) {
    $hi_id = $query_fetch['id'];
    $hi_un = $query_fetch['Username'];
    $hi_fu = $query_fetch['Fullname'];
    $hi_up = $query_fetch['Userphoto'];
    $hi_ver = $query_fetch['verify'];
}
$qsql = "SELECT * FROM block_m WHERE my_id=:story_id AND blocken_id=:sid";
$query = $conn->prepare($qsql);
$query->bindParam(':story_id', $story_id, PDO::PARAM_INT);
$query->bindParam(':sid', $sid, PDO::PARAM_INT);
$query->execute();
$b_num = $query->rowCount();
	    $message_m = str_replace($em_char,$em_img,$message);
	//hastag////////////////////////////////
    $hashtags_url = '/(\#)([x00-\xFF]+[a-zA-Z0-9x00-\xFF_\w]+)/';
    $message_m = preg_replace($hashtags_url, "<b><a href='".$check_path."hashtag/$2' title='#$2'>#$2</a></b>", $message_m);
//url/////////////////////////
//url https/////////////////////////
$url = '/(http|https|ftp|ftps|www.)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\:[0-9]+)?(\/\S*)?/';
$message_m = preg_replace($url, '<a href="$0" target="_blank" title="$0">$0<i class="fa fa-link"></i></a>', $message_m);
//u////////////////////////////////
    $hashtags_url = '/(\@)([x00-\xFF]+[a-zA-Z0-9x00-\xFF_\w]+)/';
    $message_m = preg_replace($hashtags_url, "<b><a href='".$check_path."u/$2' title='$2'>@$2</a></b>", $message_m);
	//comment body/////////////////////////////////////
    $message_m = nl2br($message_m);
	echo"<div class='w3-bar w3-top w3-black w3-large' style='z-index:4'>
	<a href='javascript:history.back()'><button class='w3-bar-item fa fa-arrow-left w3-black'></button></a>
	<div class='w3-bar-item'style='width:70px;height:50px;'><img src='../imgs/user_imgs/$hi_up' style='border-radius:50px;width:100%;height:100%;'></div>
	<a href='../u/$hi_un'><span class='w3-bar-item' style='color:white'>$hi_fu</span></a>
 <div class='dropdown'>
    <a class='w3-bar-item dropdown-toggle' data-toggle='dropdown' style='float:".lang('float2').";color:white;' href='#'><span>&bull;&bull;&bull;</span></a>
    <ul class='dropdown-menu ".lang('postDropdown')."' style='top:10px;color:#999;text-align: ".lang('textAlign').";'>
    ";
    
    echo "
    <li><a href='javascript:void(0)' onclick=\"himo('$story_id','$sid','1')\"><span class='fa fa-times'></span> Block the contact</a></li>";
    echo"
    </ul>
    </div>
</div>";
if($m_from == $_SESSION['id']){
	if(!$m_hide){
	echo" <table style='width:100%;' id='comment_$m_id' class='uComment'>
    <tr><td style='width:50px;position:relative;'>
    <div class='user_comment_img'>
     <img src='../imgs/user_imgs/$my_up'/>
    </div>
    </td><td><a class='userLinkComment' href='$uProfileUrl'>$my_fu</a><span>$my_ver</span>
    <p style='word-break: break-word;' id='commentContent_$m_id'>";
    if($m_like){
		echo"<span class='fa fa-heart' style='color:red;font-size:50px;'></span>";
	}elseif($post_ido){
		echo"<div style='border-radius:10px;width:80%;height:80%;background:white;'>";
	echo"<div class='img-user' style='display:inline-block;width:40px;height:40px;'><img src=\"../imgs/user_imgs/$po_up\" style='width:100%;height:100%;'></div> <a href='../u/$po_un'><strong style='color:black;'>$po_fu</strong></a><span style='color:grey;float:right;margin-right:10px;'>$timeago</span>";
	echo"<p style='margin:10px;'>$get_post_content</p><div style='text-align:center;'>";
	if(preg_match("/.(jpg|png|jpeg)$/i", $get_post_img/*importent!!!*/)){
		echo"<a href='post?pid=$get_post_id'><img style='width:98%;height:90%;border-radius:4px;' class='$img_sty' src=\"../imgs/$get_post_img\" alt='story from $query_fetch_fullname'></a>";
	}
	elseif(preg_match("/.(ogg|wmb|mp4)$/i", $get_post_img/*importent!!!*/)){
		echo"<video controls autoplay src=\"../imgs/$get_post_img\" style='width:100%;height:100%;'>A video from $query_fetch_fullname</video>";
}elseif(preg_match("/.(ogg|wav|mp3)$/i", $get_post_img/*importent!!!*/)){
		echo"<a href='post?pid=$get_post_id'><img style='width:98%;height:90%;border-radius:4px;' src=\"../imgs/main_icons/1f4e2.png\" alt='$query_fetch_fullname'></a>";
}elseif(preg_match("/.(pdf)$/i", $get_post_img/*importent!!!*/)){
			echo"<a href='post?pid=$get_post_id'><img style='width:98%;height:90%;border-radius:4px;' src=\"../imgs/main_icons/1f4d1.png\" alt='$query_fetch_fullname'></a>";
}
echo"</div></div>";
	}elseif($img_mess){
		if(preg_match("/.(png|jpeg|jpg)$/i", $img_mess/*importent!!!*/)){
			
        echo "<img src='../imgs/$img_mess' alt='$my_un' class='img_mes'>";
				}
		
	}else{
	echo"<span class='w3-light-blue spanComment'>$message_m</span><br/>";}
    echo"<p style='margin: 0; padding: 0;'>
    <span class='comment_time'>$ago_time</span>
	";
	if($m_seen == "1"){
    echo"<span class='comment_time fa fa-check'></span>
	";}
     if ($edited_4comm == "1") {
        $editedComment = " <sub style='font-size: 15px; margin: 0px 3px;'>&bull;</sub> ".lang('comm_edited')." ($timeEdited_4commAgo)";
     }else{
        $editedComment="";
     }
     echo"<span id='editedComment_$m_id' style='font-size:11px;color:#808080;'> $editedComment</span>
    </p>
    </p>
    <div id='CommentLoading_$m_id'>
    </div>
    <div id='commentEditBox_$m_id' style='display:none;'>
    <textarea dir='auto' class='commentContent_EditBox' id='commEditBox_$m_id'>$message</textarea>
    <div style='margin-bottom: 15px;margin-top: 5px;'>
    <a href='javascript:void(0)' onclick=\"editComment_save('$m_id','$check_path')\" class='default_flat_btn'>".lang('save')."</a>
    <a href='javascript:void(0)' onclick=\"editComment_cancel('$m_id')\" class='silver_flat_btn'>".lang('cancel')."</a>
    </div>
    </td>
    <td>
    <div class='dropdown'>
    <a class='post_options dropdown-toggle' data-toggle='dropdown' style='float:".lang('float2').";' href='#'><span>&bull;&bull;&bull;</span></a>
    <ul class='dropdown-menu ".lang('postDropdown')."' style='top:10px;color:#999;text-align: ".lang('textAlign').";'>
    ";
    
    echo "
    <li><a href='javascript:void(0)' onclick=\"deletemsg('$m_id')\"><span class='fa fa-times'></span> ".lang('msg_delete')."</a></li>
    <li><a href='javascript:void(0)' onclick=\"hidemsg('$m_id')\"><span class='fa fa-trash-o'></span> ".lang('delete_me')."</a></li>";
    
    echo"
    </ul>
    </div>
    </td>
    </tr>
</table>";
	}
	//auto messages
$vare = "SELECT * FROM out_in_words WHERE for_au = :story_id";
$aured = $conn->prepare($vare);
$aured->bindValue(':story_id', $story_id, PDO::PARAM_INT);
$aured->execute();
while ($aure = $aured->fetch(PDO::FETCH_ASSOC)) {
	$out_word = $aure['out_word'];
	$in_word = $aure['in_word'];
	if($message_m == "$in_word"){
		echo" <table style='float:right;display:block;' id='comment_$m_id' class='uComment'>
    <tr><td><a class='userLinkComment' href='$uProfileUrl'>$my_fu</a><span>$my_ver</span>
    <p style='word-break: break-word;' id='commentContent_$m_id'>";
	echo"<span class='spanComment'>$out_word</span><br/>";
    echo"<p style='margin: 0; padding: 0;'>
    <span class='comment_time'>$ago_time</span>";
	echo"<td style='width:50px;position:relative;float:right;'>
    <div style='float:right;'class='user_comment_img'>
     <img  src='../imgs/user_imgs/$my_up'/>
    </div>
    </td>";
     if ($edited_4comm == "1") {
        $editedComment = " <sub style='font-size: 15px; margin: 0px 3px;'>&bull;</sub> ".lang('comm_edited')." ($timeEdited_4commAgo)";
     }else{
        $editedComment="";
     }
     echo"<span id='editedComment_$m_id' style='font-size:11px;color:#808080;'> $editedComment</span>
    </p>
    </p>
    <div id='CommentLoading_$m_id'>
    </div>
    <div id='commentEditBox_$m_id' style='display:none;'>
    <textarea dir='auto' class='commentContent_EditBox' id='commEditBox_$m_id'>$message</textarea>
    <div style='margin-bottom: 15px;margin-top: 5px;'>
    <a href='javascript:void(0)' onclick=\"editComment_save('$m_id','$check_path')\" class='default_flat_btn'>".lang('save')."</a>
    <a href='javascript:void(0)' onclick=\"editComment_cancel('$m_id')\" class='silver_flat_btn'>".lang('cancel')."</a>
    </div>
	</div>
    </td>
    <td>
    <div class='dropdown'>
    <a class='post_options dropdown-toggle' data-toggle='dropdown' style='float:".lang('float2').";' href='#'><span>&bull;&bull;&bull;</span></a>
    <ul class='dropdown-menu ".lang('postDropdown')."' style='top:10px;color:#999;text-align: ".lang('textAlign').";'>
    ";
    if ($author_m_id == $_SESSION['id']) {
    echo " 
    <li><a href='javascript:void(0)' onclick=\"editComment('$m_id')\"><span class='fa fa-pencil-square-o'></span> ".lang('comm_edit')."</a></li>
    <li><a href='javascript:void(0)' onclick=\"deleteComment('$m_id')\"><span class='fa fa-trash-o'></span> ".lang('comm_delete')."</a></li>";
    }else{
    echo "
    <li><a href='javascript:void(0)' onclick=\"return false;\"><span class='fa fa-bug'></span> ".lang('comm_report')."</a></li>";
    }
    echo"
    </ul>
    </div>
	</div>
    </td>
    </tr>
	<br>
	<br>
	<br>
	<br>
	";
	if($img_mess){
		echo"	
		<br>
	<br>
	";
	}
	echo"
</table>";
	}
}
	//end of auto messages
}else{
		echo" <table style='float:right;display:block;' id='comment_$m_id' class='uComment'>
    <tr><td><a class='userLinkComment' href='$uProfileUrl'>$my_fu</a><span>$my_ver</span>
    <p style='word-break: break-word;' id='commentContent_$m_id'>";
    if($m_like){
		echo"<span class='fa fa-heart' style='color:red;font-size:50px;'></span>";
	}elseif($img_mess){
		if(preg_match("/.(png|jpeg|jpg)$/i", $img_mess/*importent!!!*/)){
			
        echo "<img src='../imgs/$img_mess' alt='$my_un' class='img_mes'>";
				}
		
	}else{
	echo"<span class='spanComment'>$message_m</span><br/>";}
    echo"<p style='margin: 0; padding: 0;'>
    <span class='comment_time'>$ago_time</span>";
	echo"<td style='width:50px;position:relative;float:right;'>
    <div style='float:right;'class='user_comment_img'>
     <img  src='../imgs/user_imgs/$my_up'/>
    </div>
    </td>";
     if ($edited_4comm == "1") {
        $editedComment = " <sub style='font-size: 15px; margin: 0px 3px;'>&bull;</sub> ".lang('comm_edited')." ($timeEdited_4commAgo)";
     }else{
        $editedComment="";
     }
     echo"<span id='editedComment_$m_id' style='font-size:11px;color:#808080;'> $editedComment</span>
    </p>
    </p>
    <div id='CommentLoading_$m_id'>
    </div>
    <div id='commentEditBox_$m_id' style='display:none;'>
    <textarea dir='auto' class='commentContent_EditBox' id='commEditBox_$m_id'>$message</textarea>
    <div style='margin-bottom: 15px;margin-top: 5px;'>
    <a href='javascript:void(0)' onclick=\"editComment_save('$m_id','$check_path')\" class='default_flat_btn'>".lang('save')."</a>
    <a href='javascript:void(0)' onclick=\"editComment_cancel('$m_id')\" class='silver_flat_btn'>".lang('cancel')."</a>
    </div>
	</div>
    </td>
    <td>
    <div class='dropdown'>
    <a class='post_options dropdown-toggle' data-toggle='dropdown' style='float:".lang('float2').";' href='#'><span>&bull;&bull;&bull;</span></a>
    <ul class='dropdown-menu ".lang('postDropdown')."' style='top:10px;color:#999;text-align: ".lang('textAlign').";'>
    ";
    if ($author_m_id == $_SESSION['id']) {
    echo " 
    <li><a href='javascript:void(0)' onclick=\"editComment('$m_id')\"><span class='fa fa-pencil-square-o'></span> ".lang('comm_edit')."</a></li>
    <li><a href='javascript:void(0)' onclick=\"deleteComment('$m_id')\"><span class='fa fa-trash-o'></span> ".lang('comm_delete')."</a></li>";
    }else{
    echo "
    <li><a href='javascript:void(0)' onclick=\"return false;\"><span class='fa fa-bug'></span> ".lang('comm_report')."</a></li>";
    }
    echo"
    </ul>
    </div>
	</div>
    </td>
    </tr>
	<br>
	<br>
	<br>
	<br>
	";
	if($img_mess){
		echo"	
		<br>
	<br>
	";
	}
	echo"
</table>";
$go = "1";
$soo = $conn->prepare("UPDATE messages SET m_seen = :go WHERE m_id = :m_id");
$soo->bindParam(':go',$go,PDO::PARAM_INT);
$soo->bindParam(':m_id',$m_id,PDO::PARAM_INT);
$soo->execute();
}}
		}else{
			$qsql = "SELECT * FROM signup WHERE id=:story_id";
$query = $conn->prepare($qsql);
$query->bindParam(':story_id', $story_id, PDO::PARAM_INT);
$query->execute();

while ($query_fetch = $query->fetch(PDO::FETCH_ASSOC)) {
    $hio_id = $query_fetch['id'];
    $hio_un = $query_fetch['Username'];
    $hio_fu = $query_fetch['Fullname'];
    $hio_up = $query_fetch['Userphoto'];
    $hio_ver = $query_fetch['verify'];
		echo"<div class='w3-bar w3-top w3-black w3-large' style='z-index:4'>
	<a href='javascript:history.back()'><button class='w3-bar-item fa fa-arrow-left w3-black'></button></a>
	<img src='../imgs/user_imgs/$hio_up' class='w3-bar-item w3-circle' style='width:70px;'>
	<a href='../u/$hio_un'><span class='w3-bar-item' style='color:white'>$hio_fu</span></a>
  <span class='w3-bar-item w3-right'>fero</span>
</div>";
}
		}
?>
</div>
<br>
<br>
<br>

<?php if($b_num == 1){ echo"<div class='w3-bottom' style='color:white;background:linear-gradient(320deg,#8910d6,#b52d94);'>You can't send any message to $his_fu</div>"; }else{?>
<h2 style="color:transparent;" id="kfk">kfk</h2>
<div id="msgci" class="loader" style="display:none;">
<button onclick="commsgshow()" style="font-size:30px;background:transparent;border:solid thin black;border-radius:50px;height:50px;width:50px;">
<span class="fa fa-times">
</span>
</button>
<form action="<?php echo $check_path; ?>includes/wmessages.php" method="post" enctype="multipart/form-data">
<input type="hidden" name="m_to" value="<?php echo $story_id; ?>">
<div id='photo_preview' style="margin-top: 10px;order: 1px solid rgba(0, 0, 0, 0.1);overflow: hidden;width: 100%;height: 80%;display:none;position: relative;">
       <label style="color: white">
        <button type="reset" name="reset" id="cancel_photo_preview" style="display: none"><span class="fa fa-times"></span></button>
        
       </label>
            <img id='photo_preview_src' src='#' alt='your image' style='height:100%;width:100%;cursor: pointer;' />
			<video id='photo_preview_src' src='#' alt='your image' style='height:100%;cursor: pointer;'></video>
       </div>

    <label>
        <input type="file" id="w_img_m" name="w_photo" accept="image/png, image/jpeg, image/jpg" onchange="photoPreview(this);" style="display: none" />
      
    <div id='photo_preview_box' style='cursor: pointer;display:block;min-width:350px;height:80%;border:2px dashed rgba(78, 178, 255, 0.8);text-align:center;'>
        <span class='fa fa-image' style=' margin: 35%;font-size: 30px;color: rgba(78, 178, 255, 0.8);'><br>8Mb</span>
	</label>	
         </div>
<input type="submit" name="post_now" value="<?php echo lang('post_now'); ?>" style="margin: 5px;padding: 8px 10px;float:right;border-radius:10px;border:none;color:black;" />
</form>
</div>
<div class="w3-bottom" id="gehea">
<a href="#kfk"><button class="w3-right w3-circle" style="border:none;background-color:white;color:black;"><span class="fa fa-arrow-down"></span></button></a>
<button onclick="commsg()" style="font-size:30px;background:transparent;border:solid thin black;border-radius:50px;height:50px;width:50px;">
<span class="fa fa-camera">
</span>
</button>

<textarea class="w3-bar-item messaged-field" maxlength="1538" dir="auto" data-cid="<?php echo "$story_id"; ?>" data-path="<?php echo"$sid"; ?>"  name="<?php echo $story_id; ?>" id="messinp" style="border-radius:4px;width:50%;height:60px;resize:none;border:solid thin grey;text-align:left;" placeholder="<?php echo lang('Write_your_message'); ?>..."></textarea>
<button  class="fa fa-heart" onclick="limesg('<?php echo $story_id ; ?>','<?php echo $sid ; ?>','1')" style="font-size:50px;background:transparent;color:red;border:none;"></button>
</div>
<?php } ?>
<script type="text/javascript">
    $('.messaged-field').keypress(function (e) {
        var cid = $(this).attr('data-cid');
        var path = $(this).attr('data-path');
        if (e.keyCode == 13) {
            if (e.shiftKey) {
                return true;
            }
            meutodb(cid,path);
            this.style.height = '40px';	
      $("#refldiv").load(location.href + " #refldiv"); //this will send request again and again;
            return false;
        }
    });
    $('.messaged-field').each(function () {
      this.setAttribute('style', 'height:40px;overflow-y:hidden;text-align:'+"<?php echo lang('textAlign'); ?>"+';');
    }).on('input', function () {
      this.style.height = '40px';
      this.style.height = (this.scrollHeight) + 'px';
    });
	setInterval(function(){
      $("#refldiv").load(location.href + " #refldiv"); //this will send request again and again;
 },3000);
 function commsg(){
		$('#msgci').show();
		$('#gehea').hide();
 }	function commsgshow(){
	$('#msgci').hide();
	$('#gehea').show();
 }
 function photoPreview(input) {
if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
    $('#photo_preview_src').attr('src', e.target.result);
    $('#photo_preview_box').css({"display":"none"});
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
</script>
<?php include "../includes/endJScodes.php"; ?>
</body>
</html>
