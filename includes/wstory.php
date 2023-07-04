<?php
session_start();
include "../config/connect.php";
$story_id = rand(0,9899999)+time();
$p_author_id = $_SESSION['id'];
$p_author = $_SESSION['Fullname'];
$p_author_photo = $_SESSION['Userphoto'];
$p_time = time();
$p_privacy = "2";
$p_img = $_FILES["w_photo"]["name"];
$p_write = filter_var(htmlspecialchars($_POST['p_write']),FILTER_SANITIZE_STRING);
$fonting = filter_var(htmlspecialchars($_POST['fonting']), FILTER_SANITIZE_STRING);
$aligf = filter_var(htmlspecialchars($_POST['aligf']), FILTER_SANITIZE_STRING);
$p_content = filter_var(htmlspecialchars($_POST['post_textbox']),FILTER_SANITIZE_STRING);
$location = filter_var(htmlspecialchars($_POST['location']), FILTER_SANITIZE_STRING);
$check_path = filter_var(htmlspecialchars($_POST['check_path']), FILTER_SANITIZE_STRING);
$font = filter_var(htmlspecialchars($_POST['font']), FILTER_SANITIZE_STRING);
$question = filter_var(htmlspecialchars($_POST['question']), FILTER_SANITIZE_STRING);
$title = filter_var(htmlspecialchars($_POST['title']), FILTER_SANITIZE_STRING);
$op1 = filter_var(htmlspecialchars($_POST['op1']), FILTER_SANITIZE_STRING);
$op2 = filter_var(htmlspecialchars($_POST['op2']), FILTER_SANITIZE_STRING);
$op3 = filter_var(htmlspecialchars($_POST['op3']), FILTER_SANITIZE_STRING);
$pol_ques = filter_var(htmlspecialchars($_POST['pol_ques']), FILTER_SANITIZE_STRING);
$poll_ye = filter_var(htmlspecialchars($_POST['poll_ye']), FILTER_SANITIZE_STRING);
$poll_no = filter_var(htmlspecialchars($_POST['poll_no']), FILTER_SANITIZE_STRING);
$sharesave = filter_var(htmlspecialchars($_POST['sharesave']), FILTER_SANITIZE_STRING);
$ch_co = filter_var(htmlspecialchars($_POST['num_cor']), FILTER_SANITIZE_STRING);
$color = filter_var(htmlspecialchars($_POST['color']), FILTER_SANITIZE_STRING);
$img_sty = filter_var(htmlspecialchars($_POST['img_style']), FILTER_SANITIZE_STRING);
$img_opacity = filter_var(htmlspecialchars($_POST['opa_img']), FILTER_SANITIZE_STRING);
$mention = filter_var(htmlspecialchars($_POST['mention']), FILTER_SANITIZE_STRING);
$time_fu = filter_var(htmlspecialchars($_POST['time_fu']), FILTER_SANITIZE_STRING);
$time_ch = filter_var(htmlspecialchars($_POST['time_ch']), FILTER_SANITIZE_STRING);
$quesoe = filter_var(htmlspecialchars($_POST['quesoe']), FILTER_SANITIZE_STRING);

$imgtext = $_FILES["textimg"]["name"];

$uid = $_SESSION['id'];
$getSaved_sql = "SELECT author_id FROM saved_story WHERE img_id= :sharesave ORDER BY time DESC";
$getSaved=$conn->prepare($getSaved_sql);
$getSaved->bindParam(':sharesave',$sharesave,PDO::PARAM_INT);
$getSaved->execute();
$countSaved = $getSaved->rowCount();
while ($fetchSaved = $getSaved->fetch(PDO::FETCH_ASSOC)) {
	$shareauthor = $fetchSaved['author_id'];
}

    //================[ if image not empty ]================
if (!empty($p_write)){
		$iptdbsql = "INSERT INTO story
(story_id,author_id,story_time,story_content,location,mention,time_fu,time_ch,p_privacy,p_write,color,title,fonting,aligf)
VALUES
( :story_id, :p_author_id, :p_time, :p_content, :location, :mention, :time_fu, :time_ch, :p_privacy, :p_write, :color, :title, :fonting, :aligf)
";
$insert_post_toDB = $conn->prepare($iptdbsql);
$insert_post_toDB->bindParam(':story_id', $story_id,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':p_author_id', $p_author_id,PDO::PARAM_INT);
$insert_post_toDB->bindParam(':p_time', $p_time,PDO::PARAM_INT);
$insert_post_toDB->bindParam(':p_content', $p_content,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':location', $location,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':mention', $mention,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':title', $title,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':time_fu', $time_fu,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':time_ch', $time_ch,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':p_privacy', $p_privacy,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':p_write', $p_write,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':color', $color,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':fonting', $fonting,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':aligf', $aligf,PDO::PARAM_STR);
$insert_post_toDB->execute();
	}
elseif(!empty($question)){
	$iptdbsql = "INSERT INTO story
(story_id,author_id,story_time,story_content,location,mention,time_fu,time_ch,p_privacy,question,op1,op2,op3,ch_co,title)
VALUES
( :story_id, :p_author_id, :p_time, :p_content, :location, :mention, :time_fu, :time_ch, :p_privacy, :question, :op1, :op2, :op3, :ch_co, :title)
";
$insert_post_toDB = $conn->prepare($iptdbsql);
$insert_post_toDB->bindParam(':story_id', $story_id,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':p_author_id', $p_author_id,PDO::PARAM_INT);
$insert_post_toDB->bindParam(':p_time', $p_time,PDO::PARAM_INT);
$insert_post_toDB->bindParam(':p_content', $p_content,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':location', $location,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':title', $title,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':question', $question,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':mention', $mention,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':time_fu', $time_fu,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':time_ch', $time_ch,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':p_privacy', $p_privacy,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':op1', $op1,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':op2', $op2,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':op3', $op3,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':ch_co', $ch_co,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':fonting', $fonting,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':aligf', $aligf,PDO::PARAM_STR);
$insert_post_toDB->execute();
}
elseif (!empty($quesoe)){
$iptdbsql = "INSERT INTO story
(story_id,author_id,story_time,story_content,location,mention,time_fu,time_ch,p_privacy,quesoe,title,fonting,aligf)
VALUES
( :story_id, :p_author_id, :p_time, :p_content, :location, :mention, :time_fu, :time_ch, :p_privacy, :quesoe, :title, :fonting, :aligf)
";
$insert_post_toDB = $conn->prepare($iptdbsql);
$insert_post_toDB->bindParam(':story_id', $story_id,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':p_author_id', $p_author_id,PDO::PARAM_INT);
$insert_post_toDB->bindParam(':p_time', $p_time,PDO::PARAM_INT);
$insert_post_toDB->bindParam(':p_content', $p_content,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':location', $location,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':mention', $mention,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':time_fu', $time_fu,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':title', $title,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':time_ch', $time_ch,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':p_privacy', $p_privacy,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':quesoe', $quesoe,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':fonting', $fonting,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':aligf', $aligf,PDO::PARAM_STR);
$insert_post_toDB->execute();
}
elseif (!empty($link)){
$iptdbsql = "INSERT INTO story
(story_id,author_id,story_time,story_content,location,mention,time_fu,time_ch,p_privacy,link,title,fonting,aligf)
VALUES
( :story_id, :p_author_id, :p_time, :p_content, :location, :mention, :time_fu, :time_ch, :p_privacy, :link, :title, :fonting, :aligf)
";
$insert_post_toDB = $conn->prepare($iptdbsql);
$insert_post_toDB->bindParam(':story_id', $story_id,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':p_author_id', $p_author_id,PDO::PARAM_INT);
$insert_post_toDB->bindParam(':p_time', $p_time,PDO::PARAM_INT);
$insert_post_toDB->bindParam(':p_content', $p_content,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':location', $location,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':mention', $mention,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':time_fu', $time_fu,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':title', $title,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':time_ch', $time_ch,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':p_privacy', $p_privacy,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':link', $link,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':fonting', $fonting,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':aligf', $aligf,PDO::PARAM_STR);
$insert_post_toDB->execute();
}elseif (!empty($pol_ques)){
	$iptdbsql = "INSERT INTO story
(story_id,author_id,story_time,story_content,location,mention,time_fu,time_ch,p_privacy,poll_ques,ye_poll,no_poll,title,fonting,aligf)
VALUES
( :story_id, :p_author_id, :p_time, :p_content, :location, :mention, :time_fu, :time_ch, :p_privacy, :pol_ques, :poll_ye, :poll_no, :title, :fonting, :aligf)
";
$insert_post_toDB = $conn->prepare($iptdbsql);
$insert_post_toDB->bindParam(':story_id', $story_id,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':p_author_id', $p_author_id,PDO::PARAM_INT);
$insert_post_toDB->bindParam(':p_time', $p_time,PDO::PARAM_INT);
$insert_post_toDB->bindParam(':p_content', $p_content,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':location', $location,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':mention', $mention,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':time_fu', $time_fu,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':title', $title,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':time_ch', $time_ch,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':p_privacy', $p_privacy,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':pol_ques', $pol_ques,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':poll_ye', $poll_ye,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':poll_no', $poll_no,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':fonting', $fonting,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':aligf', $aligf,PDO::PARAM_STR);
$insert_post_toDB->execute();
}
elseif (!empty($sharesave)){
	$iptdbsql = "INSERT INTO story
(story_id,author_id,story_time,story_content,location,mention,time_fu,time_ch,p_privacy,sharesave,shareauthor,title,fonting,aligf)
VALUES
( :story_id, :p_author_id, :p_time, :p_content, :location, :mention, :time_fu, :time_ch, :p_privacy, :sharesave, :shareauthor, :title, :fonting, :aligf)
";
$insert_post_toDB = $conn->prepare($iptdbsql);
$insert_post_toDB->bindParam(':story_id', $story_id,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':p_author_id', $p_author_id,PDO::PARAM_INT);
$insert_post_toDB->bindParam(':p_time', $p_time,PDO::PARAM_INT);
$insert_post_toDB->bindParam(':p_content', $p_content,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':location', $location,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':mention', $mention,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':title', $title,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':time_fu', $time_fu,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':time_ch', $time_ch,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':p_privacy', $p_privacy,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':sharesave', $sharesave,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':shareauthor', $shareauthor,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':fonting', $fonting,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':aligf', $aligf,PDO::PARAM_STR);
$insert_post_toDB->execute();
}

elseif (!empty($p_img)){
	$post_fileName = $_FILES["w_photo"]["name"];
$post_fileTmpLoc = $_FILES["w_photo"]["tmp_name"];
$post_fileType = $_FILES["w_photo"]["type"];
$post_fileSize = $_FILES["w_photo"]["size"]; 
$post_fileErrorMsg = $_FILES["w_photo"]["error"];
$post_fileName = preg_replace('#[^a-z.0-9]#i', '', $post_fileName); 
$post_kaboom = explode(".", $post_fileName);
$post_fileExt = end($post_kaboom);
$post_fileName = time().rand().".".$post_fileExt;
    //================[ if not selected an image ]================
if (!$post_fileTmpLoc) {
echo "
<p id='error_msg' onclick='hideMsg()'>
".lang('errorPost_n2')."
</p>
";
}else{
    //================[ if image size more than 8Mb ]================
     if($post_fileSize > 8242880) {
    echo "
<p id='error_msg' onclick='hideMsg()'>
".lang('errorPost_n3')."
</p>
";
unlink($post_fileTmpLoc); 
} else {
    //================[ if image format not supported ]================
if (!preg_match("/.(jpeg|jpg|png|mp4|ogg|wbm|mp3)$/i", $post_fileName) ) { 
echo "
<p id='error_msg' onclick='hideMsg()'>
".lang('errorPost_n4')."
</p>
"; 
     unlink($post_fileTmpLoc);
} else {
    //================[ if an error was found ]================
if ($post_fileErrorMsg == 1) {
    echo "
<p id='error_msg' onclick='hideMsg()'>
".lang('errorPost_n5')."
</p>
";
}else{
    //================[ check image path ]================
if (is_dir("../imgs/user_post_story/")) {
    $imgsPath = "../imgs/user_post_story/";
}else{
    $imgsPath = "imgs/user_post_story/";
}
$post_moveResult = move_uploaded_file($post_fileTmpLoc, $imgsPath."$post_fileName");
    //================[ if image uploaded successfuly ]================
if ($post_moveResult != true) {
    echo "
<p id='error_msg' onclick='hideMsg()'>
".lang('errorPost_n6')."
</p>
";
}else{
    $p_img = "user_post_story/".$post_fileName;
}

$iptdbsql = "INSERT INTO story
(story_id,author_id,story_img,story_time,story_content,location,mention,time_fu,time_ch,p_privacy,img_sty,img_opacity,title,fonting,aligf)
VALUES
( :story_id, :p_author_id, :p_img, :p_time, :p_content, :location, :mention, :time_fu, :time_ch, :p_privacy, :img_sty, :img_opacity, :title, :fonting, :aligf)
";
$insert_post_toDB = $conn->prepare($iptdbsql);
$insert_post_toDB->bindParam(':story_id', $story_id,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':p_author_id', $p_author_id,PDO::PARAM_INT);
$insert_post_toDB->bindParam(':p_img', $p_img,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':p_time', $p_time,PDO::PARAM_INT);
$insert_post_toDB->bindParam(':p_content', $p_content,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':location', $location,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':title', $title,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':p_privacy', $p_privacy,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':mention', $mention,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':time_fu', $time_fu,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':time_ch', $time_ch,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':img_sty', $img_sty,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':img_opacity', $img_opacity,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':fonting', $fonting,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':aligf', $aligf,PDO::PARAM_STR);
$insert_post_toDB->execute();
}
}
}
}
}
else {
$iptdbsql = "INSERT INTO story
(story_id,author_id,story_time,story_content,location,mention,time_fu,time_ch,p_privacy,title,fonting,aligf)
VALUES
( :story_id, :p_author_id, :p_time, :p_content, :location, :mention, :time_fu, :time_ch, :p_privacy, :title, :fonting, :aligf)
";
$insert_post_toDB = $conn->prepare($iptdbsql);
$insert_post_toDB->bindParam(':story_id', $story_id,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':p_author_id', $p_author_id,PDO::PARAM_INT);
$insert_post_toDB->bindParam(':p_time', $p_time,PDO::PARAM_INT);
$insert_post_toDB->bindParam(':p_content', $p_content,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':title', $title,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':location', $location,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':mention', $mention,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':time_fu', $time_fu,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':time_ch', $time_ch,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':p_privacy', $p_privacy,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':fonting', $fonting,PDO::PARAM_STR);
$insert_post_toDB->bindParam(':aligf', $aligf,PDO::PARAM_STR);
$insert_post_toDB->execute();
}
?>