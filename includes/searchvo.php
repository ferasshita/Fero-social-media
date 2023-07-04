
<?php
session_start();
include('../config/connect.php');
include ("../includes/time_function.php");
if($_POST){
$q = htmlentities($_POST['search_user'], ENT_QUOTES);
$dircheckPath = htmlentities($_POST['dircheckPath'], ENT_QUOTES);
// ============================ get posts from search request =====================================
$search_sql = "SELECT * FROM wpost WHERE p_privacy = 0 AND (post_content LIKE ? OR p_title LIKE ? OR location LIKE ?) OR (CONCAT(post_content,?,p_title) LIKE ?) OR author_id LIKE ? LIMIT 8";
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
while($row = $search->fetch(PDO::FETCH_ASSOC)){
$get_post_id = $row['post_id'];
$get_author_id = $row['author_id'];
$get_post_author = $row['post_author'];
$get_post_author_photo = $row['post_author_photo'];
$get_post_img = $row['post_img'];
$get_post_time = $row['post_time'];
$img_sty = $row['img_sty'];
$img_op = $row['img_opacity'];
$get_post_content = $row['post_content'];
$session_userphoto_path = $check_path."imgs/user_imgs/";
$session_userphoto = $session_userphoto_path . $_SESSION['Userphoto'];
$timeago = time_ago($get_post_time);
$get_post_title = $row['p_title'];
$get_post_privacy = $row['p_privacy'];
$get_post_shared = $row['shared'];


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
echo "<div style='display: inline;'><a href='../".$check_path."posts/post?pid=".$get_post_id."' class=\"username_OF_postLink\">";
        if (!empty($get_post_img)) {
			if(preg_match("/.(mp4|ogg|webm)$/i", $get_post_img/*importent!!!*/)){
        echo "<video autoplay align='center' class='eximg $img_sty' id='lightboxImg_$get_post_id' src=\"../".$imgs_path."$get_post_img\">$query_fetch_fullname</video>";
		}
		}
		echo "</a></div>";
}

}}
?>