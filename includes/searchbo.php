<?php
session_start();
include('../config/connect.php');
include ("../includes/time_function.php");
if($_POST){
$q = htmlentities($_POST['search_user'], ENT_QUOTES);
$dircheckPath = htmlentities($_POST['dircheckPath'], ENT_QUOTES);
// ============================ get posts from search request =====================================
$search_sql = "SELECT * FROM wpost WHERE p_privacy = 0 AND (post_content LIKE ? OR p_title LIKE ? OR location LIKE ?) OR (CONCAT(post_content,?,p_title) LIKE ?) OR hea_wr LIKE ? LIMIT 8";
$params = array("$q%", "$q%", " ", "$q%", "$q%", "$q%");
$search = $conn->prepare($search_sql);
$search->execute($params);
$search_num = $search->rowCount();
if ($search_num == 0) {
echo "
<div style='text-align:center'>
<span align='center' class='fa fa-image' style='font-size:250px;color:grey;'></span>
<br>
<span align='center' style='font-size:100px;color:grey;'>Not found</span>
</div>
";
}elseif ($search_num >= 1) {
while ($postsfetch = $search->fetch(PDO::FETCH_ASSOC)) {
$get_post_id = $postsfetch['post_id'];
$get_author_id = $postsfetch['author_id'];
$get_post_author = $postsfetch['post_author'];
$get_post_author_photo = $postsfetch['post_author_photo'];
$w_photo_v = $postsfetch['w_photo_v'];
$get_post_time = $postsfetch['post_time'];
$get_post_story = $postsfetch['s_wr'];
$img_sty = $postsfetch['img_sty'];
$get_post_head = $postsfetch['hea_wr'];
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
echo "<div style='display: inline;'><a href='../".$check_path."posts/book?pid=".$get_post_id."' class=\"username_OF_postLink\">";
        if (!empty($get_post_story)) {
        echo "<div class='emi'><img src=\"../".$imgs_path."$w_photo_v\" class='eximg $img_sty'><br><p style='margin-left:5px;margin-right'>$get_post_head</p></div>";
		}
		echo "</a></div>";
}

}}
?>