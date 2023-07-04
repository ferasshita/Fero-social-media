<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();
$getLang = trim(filter_var(htmlentities($_GET['lang']),FILTER_SANITIZE_STRING));
if (!empty($getLang)) {
$_SESSION['language'] = $getLang;
}
if(!isset($_SESSION['Username'])){
    header("location: login.php");
}
// ========================= config the languages ================================
error_reporting(E_NOTICE ^ E_ALL);
if (is_file('home.php')){
    $path = "";
}elseif (is_file('../home.php')){
    $path =  "../";
}elseif (is_file('../../home.php')){
    $path =  "../../";
}
include_once $path."langs/set_lang.php";
?>
<html dir="<? echo lang('html_dir'); ?>">
<head>
    <title>Pandimic &bull; Fero</title>
    <meta charset="UTF-8">
    <meta name="description" content="-you can login or create an account on fero- edit, share, comment & like on images, videos, musics, topics & stories.">
    <meta name="keywords" content="fero, fero account,فيرو, fero.com,feras,social media,feras shita,feras rida,f,fero sh, fero home,feroe">
	<meta name="author" content="feras shita">
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta charset="UTF-8">
<meta http-equiv="refresh" content="10000">
<meta name="theme-color" content="#000000">
<meta name="msapplication-navbutton-color" content="#000000">
<meta name="apple-mobile-web-app-status-bar-style" content="#000000">
<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awsome.min.css" rel="stylesheet">
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
</head>
    <body class="login_signup_body">
	<div class="w3-bar w3-top w3-black w3-large" style="z-index:4">
  <button class="w3-bar-item w3-<?php echo lang('w_post_align'); ?> w3-button w3-hide-large w3-hover-none w3-hover-text-light-grey" onClick="w3_open();"><i class="fa fa-bars"></i> <?php echo lang('Menu'); ?></button>
  <span class="w3-bar-item w3-<?php echo lang('w_post_li2'); ?>">fero<!-- i can add any thing here --></span>
</div>
<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-collapse w3-overflow-x w3-white w3-animate-<?php echo lang('w_post_align'); ?>" style="z-index:3;width:300px;" id="mySidebar"><br>
  <div class="w3-container w3-row">
    <div class="w3-col s<?php echo lang('arrs'); ?>">
      <a href='u/<?php echo $_SESSION['Username']; ?>' target="_self"><img src="<?php echo 'imgs/user_imgs/'.$_SESSION['Userphoto']; ?>" class="w3-circle w3-margin-right" style="width:46px"></a>
    </div>
    <div class="w3-col s<?php echo lang('arr'); ?> w3-bar">
      <span><?php echo lang('welcomes'); ?>, <strong><?php echo "<a href='u/".$_SESSION['Username']."' style='color: #000000'>".$_SESSION['Fullname']."</a>"; if ($_SESSION['verify'] == "1"){echo $verifyUser;} ?></strong></span><br>
      <a href="<?php echo $dircheckPath; ?>messages/" class="w3-button" title="Contactor"><i class="fa fa-envelope"></i><span id="messagesCount"></span></a>
      <a href="settings?tc=edit_profile" class="w3-button" title="Profile settings"><i class="fa fa-user"></i></a>
      <a class="w3-button" id="myBtn" href="javascript:void(0)"><i class="fa fa-cog"></i></a>
    </div>
  </div>
  <hr>
  <div class="w3-container">
    <h5><? echo lang('dashboard'); ?></h5>
  </div>
  <div class="w3-bar-block">
    <p><a href="#" class="<? echo lang('sid'); ?> w3-button w3-padding-16 w3-hide-large w3-dark-grey w3-hover-black" onClick="w3_close()" title="close menu"><i class="fa fa-remove fa-fw"></i> <?php echo lang('Close_Menu'); ?></a></p>
	<p><a href="clibya" target="_self" id="ma" class="<? echo lang('sid'); ?> w3-button" title="Upload posts"><i class="fa fa-flag"></i> libya regions</a></p>
	<p><a href="corona" target="_self" id="ma" class="<? echo lang('sid'); ?> w3-button" title="Upload posts"><i class="fa fa-flag"></i> Corona news</a></p>
	</div>
</nav>


<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onClick="w3_close()" style="cursor: pointer" title="close side menu" id="myOverlay"></div>
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->


	<!-- navbar end -->
<div class="w3-main" align="<?php echo lang('w_post_align'); ?>" style="margin-<?php echo lang('w_post_align'); ?>:300px;margin-top:43px;text-align:<?php echo lang('w_post_align'); ?>;direction: <?php echo lang('w_post_dir'); ?>">
<h1 align="center">Corona virus cases in libya</h1>
<table>
  <tr>
    <th>Region</th>
    <th><span style="color:red">&bull;</span> cases</th>
    <th><span style="color:black">&bull;</span> deaths</th>
    <th><span style="color:green">&bull;</span> recover</th>
  </tr>
<?php include("config/connect.php");
include("includes/fetch_users_info.php");
include ("includes/time_function.php");
include ("includes/num_k_m_count.php");
$s_id = $_SESSION['id'];
$check_path = filter_var(htmlspecialchars($_POST['path']),FILTER_SANITIZE_STRING);
$plimit = filter_var(htmlspecialchars($_POST['plimit']),FILTER_SANITIZE_NUMBER_INT);
$vpsql = "SELECT * FROM corona";
$view_posts = $conn->prepare($vpsql);
$view_posts->execute();
$view_postsNum = $view_posts->rowCount();
if ($view_postsNum > 0) {

while ($postsfetch = $view_posts->fetch(PDO::FETCH_ASSOC)) {
	$reg = $postsfetch['region'];
$num_co = $postsfetch['number'];  
$ty_cas = $postsfetch['ty_cas'];
$ty_hea = $postsfetch['ty_hea'];
$ty_dea = $postsfetch['ty_dea'];
if($reg == "tripoli"){
echo"
<tr>
    <td>$reg</td>
    <td>$ty_cas</td>
    <td>$ty_dea</td>
    <td>$ty_hea</td>
  </tr>";
}
if($reg == "banigazi"){
echo"<tr>
    <td>$reg</td>
    <td>$ty_cas</td>
    <td>$ty_dea</td>
    <td>$ty_hea</td>
  </tr>";
}
if($reg == "misrata"){
echo"<tr>
    <td>$reg</td>
    <td>$ty_cas</td>
    <td>$ty_dea</td>
    <td>$ty_hea</td>
  </tr>";
}
if($reg == "sabha"){
echo"<tr>
    <td>$reg</td>
    <td>$ty_cas</td>
    <td>$ty_dea</td>
    <td>$ty_hea</td>
  </tr>";
}
if($reg == "sirt"){
echo"<tr>
    <td>$reg</td>
    <td>$ty_cas</td>
    <td>$ty_dea</td>
    <td>$ty_hea</td>
  </tr>";
}
if($reg == "alkofra"){
echo"<tr>
    <td>$reg</td>
    <td>$ty_cas</td>
    <td>$ty_dea</td>
    <td>$ty_hea</td>
  </tr>";
}
if($reg == "zletin"){
echo"<tr>
    <td>$reg</td>
    <td>$ty_cas</td>
    <td>$ty_dea</td>
    <td>$ty_hea</td>
  </tr>";
}
if($reg == "alzawia"){
echo"<tr>
    <td>$reg</td>
    <td>$ty_cas</td>
    <td>$ty_dea</td>
    <td>$ty_hea</td>
  </tr>";
}
if($reg == "albada"){
echo"<tr>
    <td>$reg</td>
    <td>$ty_cas</td>
    <td>$ty_dea</td>
    <td>$ty_hea</td>
  </tr>";
}
if($reg == "zwara"){
echo"<tr>
    <td>$reg</td>
    <td>$ty_cas</td>
    <td>$ty_dea</td>
    <td>$ty_hea</td>
  </tr>";
}
if($reg == "tobroq"){
echo"<tr>
    <td>$reg</td>
    <td>$ty_cas</td>
    <td>$ty_dea</td>
    <td>$ty_hea</td>
  </tr>";
}
if($reg == "giryan"){
echo"<tr>
    <td>$reg</td>
    <td>$ty_cas</td>
    <td>$ty_dea</td>
    <td>$ty_hea</td>
  </tr>";
}
}} ?>
</table>
<script src="js/side.js"></script>
</body>
</html>
