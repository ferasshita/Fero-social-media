<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();
$page="post";
include("../config/connect.php");
include("../includes/fetch_users_info.php");
include ("../includes/time_function.php");
include ("../includes/num_k_m_count.php");
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
    <?php include "../includes/head_imports_main.php";?>
<link href="css/img_s.css" rel="stylesheet">
<style>
	.cod{
	background: linear-gradient(500deg,#8910d6,#b52d94);
}
</style>
</head>
<body onload="fetchPosts_DB('home')">
<!--=============================[ NavBar ]========================================-->
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
                    $fPosts_sql = "SELECT * FROM wpost WHERE post_id = ?";
                    $params = array($post_id, "1", "2");
                }else{
                    $fPosts_sql = "SELECT * FROM wpost WHERE post_id = ?";
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
$color = $postsfetch['color'];
$font = $postsfetch['font'];
$session_userphoto_path = $check_path."imgs/user_imgs/";
$session_userphoto = $session_userphoto_path . $_SESSION['Userphoto'];
$get_post_shared = $postsfetch['shared'];
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

$chShare = $conn->prepare("SELECT shared FROM wpost WHERE shared=:get_post_id");
$chShare->bindParam(':get_post_id', $get_post_id, PDO::PARAM_INT);
$chShare->execute();
$chShareCount = $chShare->rowCount();
$imgs_path = $check_path."imgs/";
$em_img_path = $imgs_path."emoticons/";
if (is_file("config/connect.php")) {
    $includePath = "includes/";
}elseif (is_file("../config/connect.php")) {
    $includePath = "../includes/";
}elseif (is_file("config/connect.php")) {
    $includePath = "../../includes/";
}
echo "<div style='background: linear-gradient(320deg,#8910d6,#b52d94);padding: 8px 32px;color: #fff;text-decoration: none;outline: none;border:none;border-radius: 10px;box-shadow: 0px 0px 16px rgba(0, 0, 0, 0.0);transition: box-shadow 0.3s;'><br>";
	if(!empty($get_post_img)){
        if (!empty($get_post_story)) {
			echo "<a href='".$check_path."posts/book?pid=".$get_post_id."'><div style='width: 1000px;height:100%;max-width: 1000px;max-height:100%;background-color:grey;text-align: center;'><br><img align='center' style='width: 498px;height:500px;max-width: 500px;max-height:498px;box-shadow: 0px 0px 18px rgba(63, 81, 181, 0.16);' id='lightboxImg_$get_post_id' src=\"".$imgs_path."$get_post_img\" alt='$query_fetch_fullname' /></div></a>";
		}elseif (!empty($get_post_write)) {
			echo "<div class='$color' style='font-family: $font;width: 100%;height:100%;font-size: 27px; text-align:center;max-width: 100%;max-height:100%;'><p dir='auto'><br>$get_post_write</p></div>";
		}elseif (!empty($link)) {
			echo "<iframe src='$link' style='width: 100%;height:100%;max-width: 100%;max-height:100%;'></iframe>";
		}elseif(!empty($get_post_img)){
		if(preg_match("/.(png|jpeg|jpg)$/i", $get_post_img/*importent!!!*/)){
        echo "<img align='center' style='width: 100%;height:100%;max-width: 100%;max-height:100%;' onclick='lightbox(\"$get_post_id\")' id='lightboxImg_$get_post_id' src=\"".$imgs_path."$get_post_img\" alt='$query_fetch_fullname' />";
		}elseif(preg_match("/.(mp4|ogg|wmb)$/i", $get_post_img/*importent!!!*/)){
			 echo "<video controls autoplay align='center' style='width: 100%;height:100%;max-width: 100%;max-height:100%;' id='lightboxImg_$get_post_id' src=\"".$imgs_path."$get_post_img\">Your browser don't support videos!!!</video>";
		}elseif(preg_match("/.(mp3)$/i", $get_post_img/*importent!!!*/)){
				 echo "<audio controls autoplay align='center' style='width: 100%;height:100%;max-width: 100%;max-height:100%;' id='lightboxImg_$get_post_id' src=\"".$imgs_path."$get_post_img\">Your browser don't support audios!!!</audio>";
		}elseif(preg_match("/.(pdf)$/i", $get_post_img/*importent!!!*/)){ 
		echo "<embed align='center' id='lightboxImg_$get_post_id' style='width: 100%;height:100%;max-width: 100%;max-height:100%;' type='application/pdf' src=\"".$imgs_path."$get_post_img\"></embed>";
		}
		}}
		echo"<p>embed &bull; <a href='../index'>fero</a></p></div>";
if (is_dir("../imgs/")) {
    $pathCheck = "../";
}elseif (is_dir("imgs/")) {
    $pathCheck = "";
}
// ========= fetch share post ==========
if (!empty(trim($get_post_shared))) {
$fetch_shared = $conn->prepare("SELECT * FROM wpost WHERE post_id=:get_post_shared ");
$fetch_shared->bindParam(':get_post_shared',$get_post_shared,PDO::PARAM_INT);
$fetch_shared->execute();
while ($sharedRow = $fetch_shared->fetch(PDO::FETCH_ASSOC)) {
    $shP_id = $sharedRow['post_id'];
    $shP_aid = $sharedRow['author_id'];
    $shP_img = $sharedRow['post_img'];
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
}
//////////////////post///////////
echo "<div style='background: linear-gradient(320deg,#8910d6,#b52d94);padding: 8px 32px;color: #fff;text-decoration: none;outline: none;border:none;border-radius: 10px;box-shadow: 0px 0px 16px rgba(0, 0, 0, 0.0);transition: box-shadow 0.3s;'><br>";
	if(!empty($shP_img)){
if (!empty($get_post_story_sh)) {
			echo "<a href='".$check_path."posts/book?pid=".$get_post_id."'><div style='width: 1000px;height:100%;max-width: 1000px;max-height:100%;background-color:grey;text-align: center;'><br><img align='center' style='width: 498px;height:500px;max-width: 500px;max-height:498px;box-shadow: 0px 0px 18px rgba(63, 81, 181, 0.16);' id='lightboxImg_$get_post_id' src=\"".$imgs_path."$shP_img\" alt='$query_fetch_fullname' /></div></a>";
		}elseif (!empty($get_post_write)) {
			echo "<div class='$color' style='font-family: $font;width: 100%;height:100%;font-size: 27px; text-align:center;max-width: 100%;max-height:100%;'><p><br>$get_post_write</p></div>";
		}elseif (!empty($link)) {
			echo "<iframe src='$link' style='width: 100%;height:100%;max-width: 100%;max-height:100%;'></iframe>";
		}
		elseif (!empty($shP_img)) {
			if(preg_match("/.(png|jpeg|jpg)$/i", $shP_img/*importent!!!*/)){
        echo "<div id='pr_$get_post_id'><img align='center' style='width: 100%;height:100%;max-width: 100%;max-height:100%;' onclick='lightbox(\"$get_post_id\")' id='lightboxImg_$get_post_id' src=\"".$check_path."imgs/$shP_img\" alt='$query_fetch_fullname' /></div>";
		}elseif(preg_match("/.(mp4|ogg|wmb)$/i", $shP_img/*importent!!!*/)){
			 echo "<video controls autoplay align='center' style='width: 100%;height:100%;max-width: 100%;max-height:100%;' id='lightboxImg_$get_post_id' src=\"".$check_path."imgs/$shP_img\">Your browser don't support videos!!!</video>";
		}elseif(preg_match("/.(mp3)$/i", $shP_img/*importent!!!*/)){
				 echo "<audio controls autoplay align='center' style='width: 100%;height:100%;max-width: 100%;max-height:100%;' id='lightboxImg_$get_post_id' src=\"".$check_path."imgs/$shP_img\">Your browser don't support audios!!!</audio>";
		}elseif(preg_match("/.(pdf)$/i", $shP_img/*importent!!!*/)){ 
		echo "<embed align='center' id='lightboxImg_$get_post_id' style='width: 100%;height:100%;max-width: 100%;max-height:100%;' type='application/pdf' src=\"".$check_path."imgs/$shP_img\"></embed>";
		}
		}	}
		echo"<p>embed &bull; <a href='../index'>fero</a></p></div>";
}
// ===================tools==================
echo"
</div>
</div>
";
}
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
</body>
</html>
