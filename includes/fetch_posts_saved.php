<?php
session_start();
include("../config/connect.php");
include("../includes/fetch_users_info.php");
$uid = $_SESSION['id'];
$getSaved_sql = "SELECT * FROM saved WHERE user_saved_id= :uid ORDER BY saved_time DESC";
$getSaved=$conn->prepare($getSaved_sql);
$getSaved->bindParam(':uid',$uid,PDO::PARAM_INT);
$getSaved->execute();
$countSaved = $getSaved->rowCount();
while ($fetchSaved = $getSaved->fetch(PDO::FETCH_ASSOC)) {
	$saved_id = $fetchSaved['id'];
	$saved_post_id = $fetchSaved['post_id'];
	$saved_time = $fetchSaved['saved_time'];
	$saved_timeAgo = time_ago($saved_time);
	$getPost_id_sql = "SELECT * FROM wpost WHERE post_id= :saved_post_id";
	$getPost_id=$conn->prepare($getPost_id_sql);
	$getPost_id->bindParam(':saved_post_id',$saved_post_id,PDO::PARAM_INT);
	$getPost_id->execute();
	while ($fetchPost_id = $getPost_id->fetch(PDO::FETCH_ASSOC)) {
    $wpostpost_id = $fetchPost_id['post_id'];
	$post_author_id = $fetchPost_id['author_id'];
	$get_post_write = $fetchPost_id['p_write'];
	$get_post_head = $fetchPost_id['hea_wr'];
$img_sty = $fetchPost_id['img_sty'];
$img_op = $fetchPost_id['img_opacity'];
$get_post_story = $fetchPost_id['s_wr'];
$get_text_image = $fetchPost_id['imgtext'];
$color = $fetchPost_id['color'];
$w_photo_v = $fetchPost_id['w_photo_v'];
$font = $fetchPost_id['font'];
$link = $fetchPost_id['link'];
$img_mov = $fetchPost_id['photomov'];
$movie = $fetchPost_id['movie'];
	$post_img = $fetchPost_id['post_img'];
	$post_content = $fetchPost_id['post_content'];
	}
	$getUserData_sql = "SELECT * FROM signup WHERE id= :post_author_id";
	$getUserData=$conn->prepare($getUserData_sql);
	$getUserData->bindParam(':post_author_id',$post_author_id,PDO::PARAM_INT);
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
if (!empty($get_post_story)) {
		echo "<a href='".$check_path."posts/book?pid=".$get_post_id."'><img align='center' style='min-width: 100px;max-width: 100px;min-height: 80px;max-height: 80px;' id='lightboxImg_$get_post_id' src=\"../imgs/$w_photo_v\"  class='$img_sty' alt='$query_fetch_fullname' /></a>";
		}elseif (!empty($movie)) {
		echo "<a href='".$check_path."posts/film?pid=".$get_post_id."'><img align='center' style='min-width: 70px;max-width: 70px;min-height: 70px;max-height: 70px;box-shadow: 0px 0px 18px rgba(63, 81, 181, 0.16);' id='lightboxImg_$get_post_id' src='../imgs/$img_mov' alt='$query_fetch_fullname' /></a>";
		}
		elseif (!empty($get_post_write)) {
			if (!empty($get_text_image)) {
			echo nl2br("<div class='$color' style='font-family: $font;background: url(\"imgs/$get_text_image\") no-repeat center center; background-size: cover;width: 98%;height:80%;font-size: 27px; text-align:center;max-width: 98%;max-height:80%;'><p dir='auto'><br>$get_post_write</p></div>");
			}else{
			echo nl2br("<div class='$color' style='font-family: $font;width: 98%;height:80%;font-size: 27px; text-align:center;max-width: 98%;max-height:80%;'><p dir='auto' style='word-break: break-word;'><br>$get_post_write</p></div>");
		}}
   elseif (!empty($post_img)) {
			if(preg_match("/.(png|jpeg|jpg)$/i", $post_img/*importent!!!*/)){
        echo "<img src=\"../imgs/$post_img\" class='$img_sty' alt='$query_fetch_fullname' />";
		}elseif(preg_match("/.(mp4|ogg|wmb)$/i", $post_img/*importent!!!*/)){
			 echo "<video src=\"../imgs/$post_img\" class='$img_sty' alt='$query_fetch_fullname' style='min-width: 100px;max-width: 100px;min-height: 100px;max-height: 100px;'></video>";
		}elseif(preg_match("/.(mp3)$/i", $post_img/*importent!!!*/)){
				 echo "<img src=\"../imgs/main_icons/1f4e2.png\" alt='$query_fetch_fullname' />";
		}elseif(preg_match("/.(pdf)$/i", $post_img/*importent!!!*/)){ 
		echo "<embed style='min-width: 100px;max-width: 100px;min-height: 80px;max-height: 80px;' type='application/pdf' src=\"../imgs/$post_img\"></embed>";
		}
		}echo "</div>";
?>
<div style="padding: 5px">
<a href="../u/<?php echo $userData_username; ?>" style='color: gray;font-size: 14px;'><?php echo "<b>".$userData_fullname."</b>"." - @".$userData_username; ?></a><br>
<span class="fa fa-clock-o" style='color: gray;font-size: 11px;'> <b style="font-family: sans-serif;"><?php echo $saved_timeAgo; ?></b></span>
<br><br>
<?php
if (strlen($post_content) > 150) {
	echo substr($post_content, 0,150)."...";
}else{
	if (!empty($get_post_story)) {
		echo "Novel &bull; $post_content";
		}elseif (!empty($movie)) {
		echo "Movie/music/book &bull; $post_content";
		}
		elseif (!empty($get_post_write)) {
			if (!empty($get_text_image)) {
			echo "Topic &bull; $post_content";
			}else{
			echo "Topic &bull; $post_content";
		}}
   elseif (!empty($post_img)) {
			if(preg_match("/.(png|jpeg|jpg)$/i", $post_img/*importent!!!*/)){
        echo "Picture &bull; $post_content";
		}elseif(preg_match("/.(mp4|ogg|wmb)$/i", $post_img/*importent!!!*/)){
			 echo "Video &bull; $post_content";
		}elseif(preg_match("/.(mp3)$/i", $post_img/*importent!!!*/)){
				 echo "Music &bull; $post_content";
		}elseif(preg_match("/.(pdf)$/i", $post_img/*importent!!!*/)){ 
		echo "Pdf &bull; $post_content";
		}
		}
}
?> <br/><a href="<?php echo './post?pid='.$saved_post_id; ?>" style="color: #46a0ec;">Continue reading</a>
</div></div>
<div id="deleteSavedMsg_<?php echo $saved_id; ?>"></div>
</td>
<td align="center"><a href="javascript:void(0);" onclick="deleteSavedMsg('<?php echo $saved_id; ?>');"><span class="fa fa-times" style="color: #c1c1c1; font-size: 18px;"></span></a></td>
</tr>
<?php
}
?>