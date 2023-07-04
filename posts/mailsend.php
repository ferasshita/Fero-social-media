
<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();
include("../config/connect.php");
include("../includes/fetch_users_info.php");
include ("../includes/time_function.php");
include ("../includes/num_k_m_count.php");
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
    <title>Contactor &bull; Fero</title>
    <meta charset="UTF-8">
    <meta name="author" content="feras shita">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="css/img_s.css" rel="stylesheet">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <?php include "../includes/head_imports_main.php";?>
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
@media screen and (max-width:600px){
.mobdi{
display:none;	
}}
.btom{color:white;background:blue;border-radius:4px;border:none;float:right;width:54px;height:25px;}
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
<!--=============================[ NavBar ]========================================-->
<div class='w3-bar w3-top w3-black w3-large' style='z-index:4'>
	<a href='javascript:history.back()'><button class='w3-bar-item fa fa-arrow-left w3-black'></button></a>
  <span class='w3-bar-item w3-right'>fero</span>
</div>
<div class="w3-bottom">
<div class="w3-bar w3-white w3-large">
<a href="../story" class="w3-bar-item w3-button" style='color:orange' target="_self" title="story"><i class="fa fa-star"></i></a>
<a href="u/<?php echo $_SESSION['Username']; ?>" class="w3-bar-item w3-button" target="_self" title="profile"><i class="fa fa-user"></i></a>
<a href="search" class="w3-bar-item w3-button" target="_self" title="search"><i class="fa fa-search"></i></a>
<a href="post" class="w3-bar-item w3-button" target="_self" title="add an image"><i class="fa fa-upload"></i></a>
<a href="explore" class="w3-bar-item w3-button" target="_self" title="explore"><i class="fa fa-compass"></i></a>
<a href="home" class="w3-bar-item w3-button" target="_self" title="home"><i class="fa fa-home"></i></a>
</div>
</div>
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
		<?php
///////////////////////////
while ($postsfetch = $view_posts->fetch(PDO::FETCH_ASSOC)) {
$get_post_id = $postsfetch['post_id'];
}
?>
<div class="main_container" align="center">
    <div style="min-width:100%;" align="center">
        <div align="left">
        <table class="postSavedTablei" style="border-radius:10px;min-width:100%;">
            <tr style="font-weight: bold; text-transform: uppercase; color: rgba(0, 0, 0, 0.59); font-size: 13px; background: rgb(241, 241, 241); border-bottom: 2px solid #46a0ec;">
                <td><?php echo lang('Your_contacts'); ?></td>
                
            </tr>
            <?php
$uid = $_SESSION['id'];
$getSaved_sql = "SELECT * FROM follow WHERE uf_one= :uid";
$getSaved=$conn->prepare($getSaved_sql);
$getSaved->bindParam(':uid',$uid,PDO::PARAM_INT);
$getSaved->execute();
$countSaved = $getSaved->rowCount();
while ($fetchSaved = $getSaved->fetch(PDO::FETCH_ASSOC)) {
	$id = $fetchSaved['id'];
	//me
	$me = $fetchSaved['uf_one'];
	//you
	$you = $fetchSaved['uf_two'];
	$getUserData_sql = "SELECT * FROM signup WHERE id= :you";
	$getUserData=$conn->prepare($getUserData_sql);
	$getUserData->bindParam(':you',$you,PDO::PARAM_INT);
	$getUserData->execute();
	while ($fetchUserData = $getUserData->fetch(PDO::FETCH_ASSOC)) {
    $his_username = $fetchUserData['Username'];
    $his_fullname = $fetchUserData['Fullname'];
    $his_userphoto = $fetchUserData['Userphoto'];
    $his_act = $fetchUserData['online'];
	}
	if ($his_act == "1") {
                $userActive = "#4CAF50";
            }else{
                if ($row_online == "1") {
                    $userActive = "#4CAF50";
                }else{
                    $userActive = "#ccc";
                }
            }
?>
<tr id="saved_<?php echo $saved_id; ?>">
<td style="max-width: 600px">
<div style="display: inline-flex;">
<?php
echo "<div>";   
echo "<img src='../imgs/user_imgs/$his_userphoto' alt='$his_username' style='border-radius:50%; width:80px;height:80px;border:solid thin grey;'>
<div class='userActive' style='background:$userActive;left:80px;margin-top:-17px;'></div>";
echo "</div>";
?>
<div style="padding: 5px">
<a href="../u/<?php echo $his_username; ?>" style='color: gray;font-size: 14px;'><?php echo "<b>$his_fullname</b>"; ?></a><br>
<a href="../u/<?php echo $his_username; ?>" style='color: gray;font-size: 14px;'><?php echo "@$his_username"; ?></a><br>

<a href='<?php echo "../posts/message?pid=$you"; ?>'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b class="mobdi">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></a>
<?php    
echo"<button onclick=\"mailo('$get_post_id','$you')\" class='btom' id='but_set_$you'><b style='margin:5px;'>Send</b></button>";
		?><br><br>
</div></div>
<div id="deleteSavedMsg_<?php echo $saved_id; ?>"></div>
</td>
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
            <span class="fa fa-envelope-o" style="font-size: 62px;"></span><br>
            <?php echo lang('No_followers_yet'); ?></p>
        </div>
        <?php
        }}
        ?>
        </div>
    </div>
		</div>
<br>
<?php include "../includes/endJScodes.php"; ?>
</body>
</html>
