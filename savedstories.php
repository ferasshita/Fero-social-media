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
    <title>Saved stories &bull; Fero</title>
    <meta charset="UTF-8">
    <meta name="author" content="feras shita">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="css/img_s.css" rel="stylesheet">
    <?php include "includes/head_imports_main.php";?>
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
<div class="se-pre-con"><img class="iconsa" src="imgs/logo.ico" alt="logo"></div>
<!--=============================[ NavBar ]========================================-->
<?php include "includes/navbar_main.php"; ?>
<div class="w3-bottom">
<div class="w3-bar w3-white w3-large">
<a href="u/<?php echo $_SESSION['Username']; ?>" class="w3-bar-item w3-button" target="_self" title="profile"><i class="fa fa-user"></i></a>
<a href="search" class="w3-bar-item w3-button" target="_self" title="search"><i class="fa fa-search"></i></a>
<a href="post" class="w3-bar-item w3-button" target="_self" title="add an image"><i class="fa fa-upload"></i></a>
<a href="explore" class="w3-bar-item w3-button" target="_self" title="explore"><i class="fa fa-compass"></i></a>
<a href="home" class="w3-bar-item w3-button" target="_self" title="home"><i class="fa fa-home"></i></a>
</div>
</div>
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
        echo "<img src=\"imgs/$img_id\" alt='$query_fetch_fullname' />";
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
<div id="deletestoryMsg_<?php echo $saved_id; ?>"></div>
</td>
<td align="center"><a href="javascript:void(0);" onclick="deletestoryMsg('<?php echo $saved_id; ?>');"><span class="fa fa-times" style="color: #c1c1c1; font-size: 18px;"></span></a></td>
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
<?php include "includes/endJScodes.php"; ?>
</body>
</html>
