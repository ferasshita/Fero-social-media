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
    <meta name="viewport" content="width=device-width, initial-scale=1">
<link href="../css/img_s.css" rel="stylesheet">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<script src="https://kit.fontawesome.com/a076d05399.js">
</script>
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
	<?php
$author_id = filter_var(htmlspecialchars($_POST['author']),FILTER_SANITIZE_NUMBER_INT);
$pid = filter_var(htmlspecialchars($_POST['pid']),FILTER_SANITIZE_STRING);
$myid = $_SESSION['id'];
$st = time();
$path = filter_var(htmlspecialchars($_POST['path']),FILTER_SANITIZE_STRING);
$imgsty = filter_var(htmlspecialchars($_POST['imgsty']),FILTER_SANITIZE_STRING);
$imgopa = filter_var(htmlspecialchars($_POST['imgopa']),FILTER_SANITIZE_STRING);
$saved_id = rand(0,9999999)+time();
$checkExist_sql = "SELECT * FROM saved_story WHERE saved_id= :pid AND user_id= :myid";
$checkExist = $conn->prepare($checkExist_sql);
$checkExist->bindParam(':pid',$pid,PDO::PARAM_INT);
$checkExist->bindParam(':myid',$myid,PDO::PARAM_INT);
$checkExist->execute();
$checkExist_count = $checkExist->rowCount();
if ($checkExist_count < 1) {
	$save_post_sql = "INSERT INTO saved_story (id, user_id, author_id, saved_id, img_id, img_sty, img_opacity, time) VALUES (:id, :myid, :author_id, :pid, :path, :imgsty, :imgopa, :st)";
	$save_post = $conn->prepare($save_post_sql);
	$save_post->bindParam(':id',$id,PDO::PARAM_INT);
	$save_post->bindParam(':author_id',$author_id,PDO::PARAM_INT);
	$save_post->bindParam(':path',$path,PDO::PARAM_INT);
	$save_post->bindParam(':imgsty',$imgsty,PDO::PARAM_STR);
	$save_post->bindParam(':imgopa',$imgopa,PDO::PARAM_STR);
	$save_post->bindParam(':pid',$pid,PDO::PARAM_INT);
	$save_post->bindParam(':myid',$myid,PDO::PARAM_INT);
	$save_post->bindParam(':st',$st,PDO::PARAM_STR);
	$save_post->execute();
}
?>
</head>
<body>
	<script>
	$(window).load(function(){
	$(".se-pre-con").fadeOut("slow");});		
</script>
<div class="se-pre-con"><img class="iconsa" src="../imgs/logo.ico" alt="logo"></div>
<!--=============================[ NavBar ]========================================-->
                <?php
        $story_id = filter_var(htmlentities($_GET['pid']), FILTER_SANITIZE_NUMBER_INT);
        $sid = $_SESSION['id'];
        $checkAuthOfPost_sql = "SELECT author_id FROM story WHERE story_id = ?";
        $checkAuthOfPost_params = array($story_id);
        $checkAuthOfPost = $conn->prepare($checkAuthOfPost_sql);
        $checkAuthOfPost->execute($checkAuthOfPost_params);
        $checkAuthOfPostCount = $checkAuthOfPost->rowCount();
        if ($checkAuthOfPostCount > 0) {
        while ($fetch_cop = $checkAuthOfPost->fetch(PDO::FETCH_ASSOC)) {
            $fetched_AuthorId = $fetch_cop['author_id'];
        }
            if ($fetched_AuthorId == $sid) {
                $fPosts_sql = "SELECT * FROM story WHERE story_id = ?";
                $params = array($story_id);
            }else{
                $checkFromPost_sql = "SELECT author_id FROM story WHERE story_id = ? AND author_id IN (SELECT uf_two FROM follow WHERE uf_one= ?)";
                $checkFromPost_params = array($story_id, $sid);
                $checkFromPost = $conn->prepare($checkFromPost_sql);
                $checkFromPost->execute($checkFromPost_params);
                $checkFromPostCount = $checkFromPost->rowCount();
                if ($checkFromPostCount < 1) {
                    $fPosts_sql = "SELECT * FROM story WHERE story_id = ? AND p_privacy != ? AND p_privacy != ?";
                    $params = array($story_id, "1", "2");
                }else{
                    $fPosts_sql = "SELECT * FROM story WHERE story_id = ?";
                    $params = array($story_id);
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
	opacity: .8;
	color: white;
}
</style>
	<script type="text/javascript">
$(widow).load(function() {
$(".loader").fadeOut("slow");
});
</script>
				<?php
while ($postsfetch = $view_posts->fetch(PDO::FETCH_ASSOC)) {
$story_id = $postsfetch['story_id'];
$author_id = $postsfetch['author_id'];
$get_post_author = $postsfetch['post_author'];
$get_post_author_photo = $postsfetch['post_author_photo'];
$story_time = $postsfetch['story_time'];
$story_time_get = time_ago($story_time);
$story_img = $postsfetch['story_img'];
$story_content = $postsfetch['story_content'];
$location = $postsfetch['location'];
$mention = $postsfetch['mention'];
$title = $postsfetch['title'];
$p_write = $postsfetch['p_write'];
$poll_ques = $postsfetch['poll_ques'];
$question = $postsfetch['question'];
$op1 = $postsfetch['op1'];
$op2 = $postsfetch['op2'];
$op3 = $postsfetch['op3'];
$ch_co = $postsfetch['ch_co'];
$fonting = $postsfetch['fonting'];
$aligf = $postsfetch['aligf'];
$ye_poll = $postsfetch['ye_poll'];
$no_poll = $postsfetch['no_poll'];
$ye_poll_nu = $postsfetch['ye_poll_nu'];
$no_poll_nu = $postsfetch['no_poll_nu'];
$color = $postsfetch['color'];
$quesoe = $postsfetch['quesoe'];
$sharesave = $postsfetch['sharesave'];
$img_sty = $postsfetch['img_sty'];
$img_opacity = $postsfetch['img_opacity'];
$time_fu = $postsfetch['time_fu'];
$time_ch = $postsfetch['time_ch'];
$shareauthor = $postsfetch['shareauthor'];

$qsql = "SELECT * FROM signup WHERE id=:author_id";
$query = $conn->prepare($qsql);
$query->bindParam(':author_id', $author_id, PDO::PARAM_INT);
$query->execute();

while ($query_fetch = $query->fetch(PDO::FETCH_ASSOC)) {
    $query_fetch_id = $query_fetch['id'];
    $query_fetch_username = $query_fetch['Username'];
    $query_fetch_fullname = $query_fetch['Fullname'];
    $query_fetch_userphoto = $query_fetch['Userphoto'];
    $query_fetch_verify = $query_fetch['verify'];
}
$qsql = "SELECT * FROM signup WHERE id=:shareauthor";
$query = $conn->prepare($qsql);
$query->bindParam(':shareauthor', $shareauthor, PDO::PARAM_INT);
$query->execute();

while ($query_fetch = $query->fetch(PDO::FETCH_ASSOC)) {
    $share_id = $query_fetch['id'];
    $share_username = $query_fetch['Username'];
    $share_fullname = $query_fetch['Fullname'];
    $share_userphoto = $query_fetch['Userphoto'];
    $share_verify = $query_fetch['verify'];
}
$chslq = "SELECT c_id FROM comments WHERE c_post_id=:story_id";
$ch = $conn->prepare($chslq);
$ch->bindParam(':story_id', $story_id, PDO::PARAM_INT);
$ch->execute();
$chtc = $ch->rowCount();
if($chtc == 0){
    $chtcnum = "0";
}elseif ($chtc == 1) {
    $chtcnum = "1";
}else{
    $chtcnum = thousandsCurrencyFormat($chtc);
}
$savgo = "SELECT saved_id FROM saved_story WHERE saved_id=:story_id";
$sa = $conn->prepare($savgo);
$sa->bindParam(':story_id', $story_id, PDO::PARAM_INT);
$sa->execute();
$savfo = $sa->rowCount();
if($savfo == 0){
    $savnum = "0";
}elseif ($savfo == 1) {
    $savnum = "1";
}else{
    $savnum = thousandsCurrencyFormat($savfo);
}
$wato = "SELECT watcher_id FROM story_watch WHERE story_id=:story_id";
$wa = $conn->prepare($wato);
$wa->bindParam(':story_id', $story_id, PDO::PARAM_INT);
$wa->execute();
$watch = $wa->rowCount();
while ($wta = $wa->fetch(PDO::FETCH_ASSOC)) {
	$watcher_id = $wta['watcher_id'];
}
	echo"<div class='storydiv $color $img_sty' style='";if($story_img){if(preg_match("/.(png|jpeg|jpg)$/i", $story_img/*importent!!!*/)){echo"background: url(../imgs/$story_img) no-repeat center center; background-size: cover;";}else{echo"background:white;";}}elseif($color){if($color == "cod"){echo"background: linear-gradient(500deg,#8910d6,#b52d94);";}else{echo"";}}else{echo"background: linear-gradient(500deg,#8910d6,#b52d94);";}echo"'> <img src='../imgs/user_imgs/$query_fetch_userphoto' class='img-user'> <a href='../u/$query_fetch_username'><strong style='color:black;'>$query_fetch_username";if ($query_fetch_verify == "1"){echo $verifyUser;}echo"</strong></a>
	<a style='";if ($author_id != $_SESSION['id']) {echo"float:right;";}echo"margin-right:10px;font-size:20px;' class='username_OF_postTime'><b>$story_time_get <span class='fa fa-eye'></span>$watch</b></a>
	 ";if ($author_id == $_SESSION['id']) {
		 echo"<div class='dropdown'>
    <a class='post_options dropdown-toggle' data-toggle='dropdown' style='float:".lang('post_options').";' href='#'><span>&bull;&bull;&bull;</span></a>
    <ul class='dropdown-menu ".lang('postDropdown')."' style='top:10px;color:#999;text-align: ".lang('postDropdownTxtAlign').";'>
    <li><a href='javascript:void(0)' onclick=\"deletestorys('$story_id')\"><span class='fa fa-trash-o'></span> ".lang('DeletePost_DDM')."</a></li>
	</ul>
    </div>";}
	echo"<br>
	<div>";
	
	if($p_write){echo nl2br("<p style='font-size:45px;font-family:$fonting;' align='$aligf'>$p_write</p>");}elseif(!empty($question)){
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
<br>&nbsp;&nbsp;&nbsp;<span id='nim_op1_$get_post_id' style='border: solid grey;border-radius:100px;padding:5px 5px;'>A</span>&nbsp;&nbsp;  ";if($ch_co == "a"){echo"<img src=\"../imgs/main_icons/2705.png\" id='corr_$get_post_id' style='display:none;width:20px;height:20px;'>";}echo"
$op1</div>
</div>
<br>
<div id='";if($ch_co == "b"){echo"opdi1_$get_post_id";}elseif($ch_co != "b"){echo"opdin2_$get_post_id";}echo"' style='width:100%;height:15%;border-radius:25px;border: thin solid  grey;background:;' onclick='";if($ch_co == "b"){echo"tr_$get_post_id()";}else{echo"fl_$get_post_id()";}echo"'><div style='border-radius:4px;' id='bod'>
<br>&nbsp;&nbsp;&nbsp;<span id='nim_op2_$get_post_id' style='border: solid grey;border-radius:100px;padding:5px 5px;'>B</span>&nbsp;&nbsp;  ";if($ch_co == "b"){echo"<img src=\"../imgs/main_icons/2705.png\" id='corr_$get_post_id' style='display:none;width:20px;height:20px;'>";}echo"
$op2</div>
</div>
<br>
<div id='";if($ch_co == "c"){echo"opdi1_$get_post_id";}elseif($ch_co != "c"){echo"opdin3_$get_post_id";}echo"' style='width:100%;height:15%;border-radius:25px;border: thin solid  grey;background:;' onclick='";if($ch_co == "c"){echo"tr_$get_post_id()";}else{echo"fl_$get_post_id()";}echo"'><div style='border-radius:4px;' id='zod'>
<br>&nbsp;&nbsp;&nbsp;<span id='nim_op3_$get_post_id' style='border: solid grey;border-radius:100px;padding:5px 5px;'>C</span>&nbsp;&nbsp;  ";if($ch_co == "c"){echo"<img src=\"../imgs/main_icons/2705.png\" id='corr_$get_post_id' style='display:none;width:20px;height:20px;'>";}echo"
$op3<br>
</div></div>
	<div id='incorr_$get_post_id' style='display:none'>not correct</div>
</div>
";
}
	elseif($story_img){if(preg_match("/.(ogg|wmb|mp4)$/i", $story_img/*importent!!!*/)){
		echo"<video controls autoplay src=\"../imgs/$story_img\" style='width:100%;height:100%;'>A video from $query_fetch_fullname</video>";
}elseif(preg_match("/.(ogg|wav|mp3)$/i", $story_img/*importent!!!*/)){
		echo"<audio controls autoplay src=\"../imgs/$story_img\" style='width:100%;height:70%;'>A sound from $query_fetch_fullname</audio>";
}}if($sharesave){
	echo"<div style='border-radius:10px;width:80%;height:80%;background:white;'>";
	echo"<img src=\"../imgs/user_imgs/$share_userphoto\" class='img-user'> <a href='../u/$share_username'><strong style='color:black;'>$share_fullname</strong></a><div style='text-align:center;'>";
	if(preg_match("/.(jpg|png|jpeg)$/i", $sharesave/*importent!!!*/)){
		echo"<img style='width:98%;height:90%;' src=\"../imgs/$sharesave\" alt='story from $query_fetch_fullname'>";
	}
	elseif(preg_match("/.(ogg|wmb|mp4)$/i", $sharesave/*importent!!!*/)){
		echo"<video controls autoplay src=\"../imgs/$sharesave\" style='width:100%;height:100%;'>A video from $query_fetch_fullname</video>";
}elseif(preg_match("/.(ogg|wav|mp3)$/i", $sharesave/*importent!!!*/)){
		echo"<audio controls autoplay src=\"../imgs/$sharesave\" style='width:100%;height:70%;'>A sound from $query_fetch_fullname</audio>";
}
echo"</div></div>";
}if($quesoe){echo"<div style='background:white;border-radius:4px;font-size:20px;width:40%;box-shadow: 0px 0px 18px rgba(63, 81, 181, 0.16);height:20%;'>
<div class='w3-light-grey' style='text-align:center;border-radius:4px;'>$quesoe</div>
<textarea placeholder='Answer here...' id='stquesan' style='width:100%;resize:none'></textarea>
<button style='background:blue;border:none;width:100%;height:30%;border-radius:4px;' id='btsu' onclick=\"fusubques('$story_id','$sid')\">Send</button>
</div>";}echo"</div>
<div class='w3-bottom'>";if($location){echo"<div class='w3-light-grey vno' style='box-shadow: 0px 0px 18px rgba(63, 81, 181, 0.16);'><b><span style='color:red;' class='fa fa-map-marker'></span> $location</b></div>";}if($mention){echo"<div class='w3-light-grey vno' style='box-shadow: 0px 0px 18px rgba(63, 81, 181, 0.16);'><b><span style='color:orange;'>@</span> $mention</b></div>";}if($time_fu){if($time_ch == 1){echo "<div class='w3-light-grey vno' style='box-shadow: 0px 0px 18px rgba(63, 81, 181, 0.16);'><b>$time_fu</b></div>";}}if($title){echo"<div style='width:30%'><marquee behavior='scroll' direction='right'>$title</marquee></div>";}echo nl2br("<p>$story_content</p>");
	echo"<br><br><br class='mn'></div><div class='w3-bottom'>
	";
	echo"<div id='d_$story_id' class='loader' style='display:none'>";
		$pid = $story_id;
$show_comments_sql = "SELECT * FROM comments WHERE c_post_id=:pid ORDER BY c_time";
$show_comments = $conn->prepare($show_comments_sql);
$show_comments->bindParam(':pid',$pid,PDO::PARAM_INT);
$show_comments->execute();

while ($comments_fetch = $show_comments->fetch(PDO::FETCH_ASSOC)) {
$id_4comm = $comments_fetch['c_id'];
    $author_id_4comm = $comments_fetch['c_author_id'];
    $post_id_4comm = $comments_fetch['c_post_id'];
    $content_4comm = $comments_fetch['c_content'];
    $edited_4comm = $comments_fetch['c_edited'];
    $gif_img = $comments_fetch['w_photo_v'];
    $timeEdited_4comm = $comments_fetch['c_time_edited'];
    $timeEdited_4commAgo = time_ago($timeEdited_4comm);
    $time_4comm = $comments_fetch['c_time'];
    $comment_time = time_ago($time_4comm);

    $query2_sql = "SELECT * FROM signup WHERE id=:author_id_4comm";
    $query2 = $conn->prepare($query2_sql);
    $query2->bindParam(':author_id_4comm',$author_id_4comm,PDO::PARAM_INT);
    $query2->execute();
    while ($query_fetch2 = $query2->fetch(PDO::FETCH_ASSOC)) {
        $query_fetch_id2 = $query_fetch2['id'];
        $query_fetch_username2 = $query_fetch2['Username'];
        $query_fetch_fullname2 = $query_fetch2['Fullname'];
        $query_fetch_userphoto2 = $query_fetch2['Userphoto'];
        $query_fetch_verify2 = $query_fetch2['verify'];
    }
    if ($query_fetch_verify2 == "1"){
        $verifypage_var = $verifyUser;
        }else{
        $verifypage_var = "";
    }
    $uProfilePic_path = $check_path."imgs/user_imgs/$query_fetch_userphoto2";
    $uProfileUrl = $check_path."u/$query_fetch_username2";
    $em_img_path = $check_path."imgs/emoticons/";
    $comm_body = str_replace($em_char,$em_img,$content_4comm);
	//hastag////////////////////////////////
    $hashtags_url = '/(\#)([x00-\xFF]+[a-zA-Z0-9x00-\xFF_\w]+)/';
    $comm_body = preg_replace($hashtags_url, "<b><a href='".$check_path."hashtag/$2' title='#$2'>#$2</a></b>", $comm_body);
//url/////////////////////////
$url = '/(www.)[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\:[0-9]+)?(\/\S*)?/';
$comm_body = preg_replace($url, '<a href="../../$0" target="_blank" title="$0">$0<i class="fa fa-link"></i></a>', $comm_body);
//url https/////////////////////////
$url = '/(http|https|ftp|ftps|www.)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\:[0-9]+)?(\/\S*)?/';
$comm_body = preg_replace($url, '<a href="$0" target="_blank" title="$0">$0<i class="fa fa-link"></i></a>', $comm_body);
//u////////////////////////////////
    $hashtags_url = '/(\@)([x00-\xFF]+[a-zA-Z0-9x00-\xFF_\w]+)/';
    $comm_body = preg_replace($hashtags_url, "<b><a href='".$check_path."u/$2' title='$2'>@$2</a></b>", $comm_body);
	//comment body/////////////////////////////////////
    $comm_body = nl2br($comm_body);
    echo "
    <table style='width:100%;' id='comment_$id_4comm' class='uComment'>
    <tr><td style='width:50px;position:relative'>
    <div class='user_comment_img'>
     <img src='$uProfilePic_path'/>
    </div>
    </td><td><a class='userLinkComment' href='$uProfileUrl'>$query_fetch_fullname2</a><span>$verifypage_var </span>
    <p style='word-break: break-word;' id='commentContent_$id_4comm'>";
    if($gif_img){
		echo"<img src='../$gif_img' style='width:15%;height:25%;border-radius:10px;'>";
	}else{
	echo"<span class='spanComment'>$comm_body</span><br/>";}
    echo"<p style='margin: 0; padding: 0;'>
    <span class='comment_time'>$comment_time</span>";
     if ($edited_4comm == "1") {
        $editedComment = " <sub style='font-size: 15px; margin: 0px 3px;'>&bull;</sub> ".lang('comm_edited')." ($timeEdited_4commAgo)";
     }else{
        $editedComment="";
     }
     echo"<span id='editedComment_$id_4comm' style='font-size:11px;color:#808080;'> $editedComment</span>
    </p>
    </p>
    <div id='CommentLoading_$id_4comm'>
    </div>
    <div id='commentEditBox_$id_4comm' style='display:none;'>
    <textarea dir='auto' class='commentContent_EditBox' id='commEditBox_$id_4comm'>$content_4comm</textarea>
    <div style='margin-bottom: 15px;margin-top: 5px;'>
    <a href='javascript:void(0)' onclick=\"editComment_save('$id_4comm','$check_path')\" class='default_flat_btn'>".lang('save')."</a>
    <a href='javascript:void(0)' onclick=\"editComment_cancel('$id_4comm')\" class='silver_flat_btn'>".lang('cancel')."</a>
    </div>
    </td>
    <td>
    <div class='dropdown'>
    <a class='post_options dropdown-toggle' data-toggle='dropdown' style='float:".lang('float2').";' href='#'><span>&bull;&bull;&bull;</span></a>
    <ul class='dropdown-menu ".lang('postDropdown')."' style='top:10px;color:#999;text-align: ".lang('textAlign').";'>
    ";
    if ($author_id_4comm == $_SESSION['id']) {
    echo " 
    <li><a href='javascript:void(0)' onclick=\"editComment('$id_4comm')\"><span class='fa fa-pencil-square-o'></span> ".lang('comm_edit')."</a></li>
    <li><a href='javascript:void(0)' onclick=\"deleteComment('$id_4comm')\"><span class='fa fa-trash-o'></span> ".lang('comm_delete')."</a></li>";
    }else{
    echo "
    <li><a href='javascript:void(0)' onclick=\"return false;\"><span class='fa fa-bug'></span> ".lang('comm_report')."</a></li>";
    }
    echo"
    </ul>
    </div>
    </td>
    </tr>
</table>
";

}
echo"</div>";

				$s_id = $_SESSION['id'];
$csql = "SELECT id FROM likes WHERE liker=:s_id AND post_id=:story_id";
$c = $conn->prepare($csql);
$c->bindParam(':s_id',$s_id,PDO::PARAM_INT);
$c->bindParam(':story_id',$story_id,PDO::PARAM_INT);
$c->execute();
$c_num = $c->rowCount();
if ($c_num > 0){
    echo "<span id='likeUnlikem_$story_id' class='ca' style='cursor:pointer'><span onclick=\"likeUnlikestom('$story_id')\" style='color:#ff928a;font-size:40px;' data-toggle='tooltip' data-placement='top' title='".lang('u_liked_this')."' id='punlike'><span class=\"fa fa-heart\"></span></span></span><br><br><br>";
}else{
    echo "<span id='likeUnlikem_$story_id' class='ca' style='cursor:pointer'><span onclick=\"likeUnlikestom('$story_id')\" style='color:#ff928a;font-size:40px;' data-toggle='tooltip' data-placement='top' title='".lang('liked')."' id='plike'><span class=\"fa fa-heart-o\"></span></span></span><br><br><br>";
}
$likes_sql = "SELECT id FROM likes WHERE post_id=:story_id";
$likes = $conn->prepare($likes_sql);
$likes->bindParam(':story_id',$story_id,PDO::PARAM_INT);
$likes->execute();
$likes_num = $likes->rowCount();
if ($likes_num == 0) {
    $likenum = "0";
}elseif ($likes_num == 1){
    $likenum = "1";
}else{
    $likenum = thousandsCurrencyFormat($likes_num);
}
	echo"
	<span id='postLikeCountm_$story_id' style='float:right;font-size:20px;' class='ca'>$likenum&nbsp;&nbsp;</span><span style='margin: 0px 5px;padding: 1px;'></span><br><br>
	<a href=\"javascript:void(0);\"onclick=\"dis('d_$story_id')\" style='font-size:40px;color:black;' class='ca post_like_comment_shareA' data-toggle='tooltip' data-placement='top' title='".lang('comment')."'><span onclick=\"fcomment('$story_id')\" class=\"fa fa-commenting\"></span></a><br><br>
					<span id='postLikeCount_$story_id' style='float:right;font-size:20px;' class='ca'>$chtcnum&nbsp;&nbsp;</span><span style='margin: 0px 5px;padding: 1px;'></span><br>
									<form action='' method='post' style='display:block;'>
				<label for='subdisk'><a href=\"javascript:void(0);\"onclick=\"storysave('$author_id','$story_id','$story_img','$img_sty','$img_opacity')\" style='font-size:55px;color:black;' class='mn post_like_comment_shareA' data-toggle='tooltip' data-placement='top' title='".lang('comment')."'></a></label>
				<input type='hidden' value='$author_id' name='author'>
				<input type='hidden' value='$story_id' name='pid'> 
				<input type='hidden' value='$story_img' name='path'>
				<input type='hidden' value='$img_sty' name='imgsty'>
				<input type='hidden' value='$img_opacity' name='imgopa'>
				<button type='submit' style='background:transparent;border:none;font-size:55px;color:black;float:right;' class='ca' id='subdisk'><i class='fa fa-fw fa-spin'><span class=\"fas fa-compact-disc \"></span></i></button><br><br><br>
				</form>
				<span id='postLikeCount_$story_id' style='float:right;font-size:20px;' class='ca'>$savnum&nbsp;&nbsp;</span><span style='margin: 0px 5px;padding: 1px;'></span><br><br><br>
				<span style='font-size:55px;color:transparent;float:right;' class='fa fa-commenting'></span>
								
</div>
				";
	echo"
				<div class='w3-bottom'> <div><textarea dir=\"auto\"  autocomplete='off' class='comment_field feil' id='inputComm_$story_id' type=\"text\" data-cid='$story_id' data-path='$check_path' name=\"$story_id\" placeholder='".lang('comment_field_ph')."' style='text-align:".lang('comment_field_align').";'></textarea>
				<form action='' method='post' style='display:inline;'>
				<label for='subdisk'><a href=\"javascript:void(0);\"onclick=\"storysave('$author_id','$story_id','$story_img','$img_sty','$img_opacity')\" style='font-size:55px;color:black;' class='mn post_like_comment_shareA' data-toggle='tooltip' data-placement='top' title='".lang('comment')."'></a></label>
				<input type='hidden' value='$author_id' name='author'>
				<input type='hidden' value='$story_id' name='pid'> 
				<input type='hidden' value='$story_img' name='path'>
				<input type='hidden' value='$img_sty' name='imgsty'>
				<input type='hidden' value='$img_opacity' name='imgopa'>
				<button type='submit' style='background:transparent;border:none;font-size:55px;color:black;' class='mn' id='subdisk'><i class='fa fa-fw fa-spin'><span class=\"fas fa-compact-disc \"></span></i></button>
				</form>
				<span id='postLikeCount_$story_id' style='font-size:20px;' class='mn'>$savnum&nbsp;&nbsp;</span><span style='margin: 0px 5px;padding: 1px;'></span>
				<a href=\"javascript:void(0);\"onclick=\"dis('d_$story_id')\" style='font-size:55px;color:black;' class='mn post_like_comment_shareA' data-toggle='tooltip' data-placement='top' title='".lang('comment')."'><span onclick=\"fcomment('$story_id')\" class=\"fa fa-commenting\"></span></a><span id='postCommCount_$story_id' class='mn'>$chtcnum</span><span style='margin: 0px 5px;padding: 1px;'></span>
				";
				$s_id = $_SESSION['id'];
$csql = "SELECT id FROM likes WHERE liker=:s_id AND post_id=:story_id";
$c = $conn->prepare($csql);
$c->bindParam(':s_id',$s_id,PDO::PARAM_INT);
$c->bindParam(':story_id',$story_id,PDO::PARAM_INT);
$c->execute();
$c_num = $c->rowCount();
if ($c_num > 0){
    echo "<span id='likeUnlike_$story_id' class='mn' style='cursor:pointer'><span onclick=\"likeUnlikestob('$story_id')\" style='color:#ff928a;font-size:55px;' data-toggle='tooltip' data-placement='top' title='".lang('u_liked_this')."' id='punlike'><span class=\"fa fa-heart\"></span></span></span>";
}else{
    echo "<span id='likeUnlike_$story_id' class='mn' style='cursor:pointer'><span onclick=\"likeUnlikestob('$story_id')\" style='color:#ff928a;font-size:55px;' data-toggle='tooltip' data-placement='top' title='".lang('liked')."' id='plike'><span class=\"fa fa-heart-o\"></span></span></span>";
}
$likes_sql = "SELECT id FROM likes WHERE post_id=:story_id";
$likes = $conn->prepare($likes_sql);
$likes->bindParam(':story_id',$story_id,PDO::PARAM_INT);
$likes->execute();
$likes_num = $likes->rowCount();
if ($likes_num == 0) {
    $likenum = "0";
}elseif ($likes_num == 1){
    $likenum = "1";
}else{
    $likenum = thousandsCurrencyFormat($likes_num);
}
				echo"
    <span id='postLikeCount_$story_id' class='mn'>$likenum</span><span style='margin: 0px 5px;padding: 1px;'></span>
	";

echo"
				</div></div></div>";
				if($sid != $watcher_id){
				$iptdbsql = "INSERT INTO story_watch
(story_id,watcher_id)
VALUES
( :story_id, :sid)
";
$insert_post_toDB = $conn->prepare($iptdbsql);
$insert_post_toDB->bindParam(':story_id', $story_id,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':sid', $sid,PDO::PARAM_INT);
$insert_post_toDB->execute();
				}
}
?>
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
<?php include "../includes/endJScodes.php"; ?>
</body>
</html>
