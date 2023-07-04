<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();
include("config/connect.php");
include("includes/fetch_users_info.php");
include ("includes/time_function.php");
if(!isset($_SESSION['Username'])){
    header("location: index");
}
?>
<html dir="<?php echo lang('html_dir'); ?>">
<head>
    <title>Search &bull; Fero</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <?php include "includes/head_imports_main.php";?>
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
</head>
<body onload="hide_notify()">
<script>
	$(window).load(function(){
	$(".se-pre-con").fadeOut("slow");});		
</script>
<div class="se-pre-con"><img class="iconsa" src="imgs/logo.ico" alt="logo"></div>
<style>
body{
	font-family: Raleway;
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
<!--=============================[ NavBar ]========================================-->
<div class="w3-bar w3-top w3-white w3-large" style="z-index:4">
  <span class="w3-bar-item w3-left"><a href="home"><? echo lang('Skip'); ?></a></span>
  <span class="w3-bar-item w3-right"><a href="home"><? echo lang('Next'); ?></a></span>
</div>
<!--=============================[ Div_Container ]========================================--><div class="w3-bottom">
<div style="text-align: left;" class="w3-bar w3-white w3-large">
<a href="story" class="w3-bar-item w3-button" style='color:orange' target="_self" title="story"><i class="fa fa-star"></i></a><a href="u/<?php echo $_SESSION['Username']; ?>" class="w3-bar-item w3-button" target="_self" title="profile"><i class="fa fa-user"></i></a>
<a href="search" class="w3-bar-item w3-button" target="_self" title="search"><i class="fa fa-search"></i></a>
<a href="post" class="w3-bar-item w3-button" target="_self" title="add an image"><i class="fa fa-upload"></i></a>
<a href="explore" class="w3-bar-item w3-button" target="_self" title="explore"><i class="fa fa-heart"></i></a>
<a href="home" class="w3-bar-item w3-button" target="_self" title="home"><i class="fa fa-home"></i></a>
</div>
</div>
<div class="main_container" align="center"><h2><? echo lang('Follow_any_one'); ?></h2>
    <div style="display: inline-flex" align="center">
        <div align="left">
        <?php password_hash ?>
           <div class="post" id="getSearchResult" style="min-width: 560px">
<?php
$s_id = $_SESSION['id'];
$q = trim(filter_var(htmlentities($_GET['q']),FILTER_SANITIZE_STRING));
if(isset($q) AND !empty($q)){
$search_sql = "SELECT * FROM signup WHERE (Fullname LIKE ? OR country LIKE ?) OR (CONCAT(work,?,work0) LIKE ?) ORDER BY country LIMIT 8";
$params = array("%$q%", "%$q%", " ", "%$q%");
$search = $conn->prepare($search_sql);
$search->execute($params);
$search_num = $search->rowCount();
if ($search_num == 0) {
echo "
<table class='user_follow_box'>
<tr>
<td><div><img src='imgs/main_icons/2139.png' style='border-radius: 100%;width:52px;height:52px;' /></div></td>
<td style='width: 100%;'>
<p>".lang('not_found')."<br><span style='font-size: small;color:gray;'>".lang('no_users_like_the_name_you_entered')."</span></p>
</td>
</tr>
</table>
";
}elseif ($search_num >= 1) {
while($row = $search->fetch(PDO::FETCH_ASSOC)){
$fullname = $row['Fullname'];
$username = $row['Username'];
$id = $row['id'];
$userphoto = $row['Userphoto'];
$verify = $row['verify'];
$country = $row['country'];
$work = $row['work'];
$work0 = $row['work0'];

$csql = "SELECT id FROM follow WHERE uf_one=:s_id AND uf_two=:id";
$c = $conn->prepare($csql);
$c->bindParam(':s_id',$s_id,PDO::PARAM_INT);
$c->bindParam(':id',$id,PDO::PARAM_INT);
$c->execute();
$c_num = $c->rowCount();
if ($c_num > 0){
    $follow_btn = "<span id='followUnfollow_$id' style='cursor:pointer'><button class=\"unfollow_btn\" onclick=\"followUnfollow('$id')\"><span class=\"fa fa-check\"></span> ".lang('followingBtn_str')."</button></span>";
}else{
    $follow_btn = "<span id='followUnfollow_$id' style='cursor:pointer'><button class=\"follow_btn\" onclick=\"followUnfollow('$id')\"><span class=\"fa fa-plus-circle\"></span> ".lang('followBtn_str')."</button></span>";
}
if ($verify == "1") {
    $verify_s = $verifyUser;
}else {
    $verify_s = "";
}

if ($country == "") {
    $under_fullname = "@".$username;
}else{
if($work == "" && $work0 == ""){
     $under_fullname = $country;
}else{
    $under_fullname = $work0." at ".$work." . ".$country;
}
}
if($id != $_SESSION['id']){
    $fbtn = $follow_btn;
}else{
    $fbtn = '';
}

echo "
<table class='user_follow_box'>
<tr>
<td><div><img src=\"imgs/user_imgs/$userphoto\" alt=\"$fullname\" /></div></td>
<td style='width: 70%;'><a href=\"u/$username\" class='user_follow_box_a'><p>$fullname $verify_s<br><span style='color:gray;'>$under_fullname</span></a></td>
<td style='width: 100%;'><span style='float:".lang('float2').";'>$fbtn</span></td>
</tr>
</table>
";
}
}
}else{
$all_users_sql = "SELECT * FROM signup ORDER BY id DESC";
$all_users = $conn->prepare($all_users_sql);
$all_users->execute();
while ($fetch_users = $all_users->fetch(PDO::FETCH_ASSOC)) {
$id_4User = $fetch_users['id'];
$fullname_4User = $fetch_users['Fullname'];
$username_4User = $fetch_users['Username'];
$userphoto_4User = $fetch_users['Userphoto'];
$verify_4User = $fetch_users['verify'];
$csql = "SELECT id FROM follow WHERE uf_one=:s_id AND uf_two=:id_4User";
$c = $conn->prepare($csql);
$c->bindParam(':s_id',$s_id,PDO::PARAM_INT);
$c->bindParam(':id_4User',$id_4User,PDO::PARAM_INT);
$c->execute();
$c_num = $c->rowCount();
if ($c_num == 1){
    $follow_btn = "<span id='followUnfollow_$id_4User' style='cursor:pointer'><span class=\"unfollow_btn\" onclick=\"followUnfollow('$id_4User')\"><span class=\"fa fa-check\"></span> Following</span></span>";
}else{
    $follow_btn = "<span id='followUnfollow_$id_4User' style='cursor:pointer'><span class=\"follow_btn\" onclick=\"followUnfollow('$id_4User')\"><span class=\"fa fa-plus-circle\"></span> Follow</span></span>";
}
if ($verify_4User == "1"){
$verifypage_var = $verifyUser;
}else{
$verifypage_var = "";
}
if($id_4User != $_SESSION['id']){
    $fbtn = $follow_btn;
}else{
    $fbtn = '';
}
echo "
<table class='user_follow_box' style='min-width:100%;'>
<tr>
<td><div><img src=\"imgs/user_imgs/$userphoto_4User\" alt=\"$fullname_4User\" /></div></td>
<td style='width: 70%;'><a href=\"u/$username_4User\" class='user_follow_box_a'><p>$fullname_4User $verifypage_var<br><span style='color:gray;'>@$username_4User</span></a></td>
<td style='width: 100%;'><span style='float:right;'>$fbtn</span></td>
</tr>
</table>
";

}
}
?>
           </div>
        </div>
    </div>

</div>
<!--===============================[ End ]==========================================-->
<?php include("includes/footer.php");?>
<?php include "includes/endJScodes.php"; ?>
</body>
</html>