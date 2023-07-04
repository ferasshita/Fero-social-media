<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();

include("../config/connect.php");
include("..//includes/fetch_users_info.php");
include("../includes/time_function.php");
include("../includes/country_name_function.php");
include("../includes/num_k_m_count.php");
if(!isset($_SESSION['Username'])){
    header("location: ../index");
}

if (isset($_POST['note_submit'])) {
    $note_title = htmlentities($_POST['note_title'], ENT_QUOTES);
    $note_content = htmlentities($_POST['note_content'], ENT_QUOTES);
    $note_time = time();
    $note_id = rand(0,9999999)+time();
    $author_id = $_SESSION['id'];
    if (trim($note_title) == null) {
        $error_success_msg = "
<p id='error_msg' onclick='hideMsg()'>
Please write note title and try again.
</p>
";
    }elseif (trim($note_content) == null) {
        $error_success_msg = "
<p id='error_msg' onclick='hideMsg()'>
Please write note content and try again.
</p>
";
    }else{
    $newNote_sql = "INSERT INTO mynotepad 
(id,author_id,note_title,note_content,note_time)
VALUES
( :note_id, :author_id, :note_title, :note_content, :note_time)
    ";
    $newNote = $conn->prepare($newNote_sql);
    $newNote->bindParam(':note_id',$note_id,PDO::PARAM_INT);
    $newNote->bindParam(':author_id',$author_id,PDO::PARAM_INT);
    $newNote->bindParam(':note_title',$note_title,PDO::PARAM_STR);
    $newNote->bindParam(':note_content',$note_content,PDO::PARAM_STR);
    $newNote->bindParam(':note_time',$note_time,PDO::PARAM_INT);
    $newNote->execute();
    if ($newNote) {
        header("Location: main");
    }else{
        $error_success_msg = "
<p id='error_msg' onclick='hideMsg()'>
Error there was somthing wrong, Please try again.
</p>
";
        }
    }
}
?>

<html dir="<?php echo lang('html_dir'); ?>">
<head>
    <title>Create new note &bull; Fero</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include "../includes/head_imports_main.php";?>
    <style type="text/css">
        .noteContent{
            min-height: 196px;
            overflow-y: hidden;
            resize: none;
        }
    </style>
</head>
    <body onload="hide_notify()">
<!--=============================[ NavBar ]========================================-->
<?php include "../includes/navbar_main.php"; ?>
<!--=============================[ Container ]=====================================--><div class="w3-bottom">
<div class="w3-bar w3-white w3-large">
<a href="../story" class="w3-bar-item w3-button" style='color:orange' target="_self" title="story"><i class="fa fa-star"></i></a>
<a href="../u/<?php echo $_SESSION['Username']; ?>" class="w3-bar-item w3-button" target="_self" title="profile"><i class="fa fa-user"></i></a>
<a href="../search" class="w3-bar-item w3-button" target="_self" title="search"><i class="fa fa-search"></i></a>
<a href="../post" class="w3-bar-item w3-button" target="_self" title="add an image"><i class="fa fa-upload"></i></a>
<a href="../explore" class="w3-bar-item w3-button" target="_self" title="explore"><i class="fa fa-compass"></i></a>
<a href="../home" class="w3-bar-item w3-button" target="_self" title="home"><i class="fa fa-home"></i></a>
</div>
</div>    <div align="center" style="margin-top: 65px;">
            <div class="white_div" style="text-align: <?php echo lang('textAlign'); ?>;">
            <h3 style="margin-top: 0;margin-bottom: 0;"><?php echo lang('new_note'); ?></h3>
             <p><?php echo lang('newNote_p'); ?>.</p>
             <?php echo $error_success_msg; ?>
             <form action="" method="POST">
                     <input  maxlength="60" autocomplete="off" id="noteTitle" dir="auto" type="text" name="note_title" class="flat_solid_textfield" placeholder="<?php echo lang('newNote_title'); ?>" style="text-align: <?php echo lang('textAlign'); ?>;">
                     / 60
                     <textarea name="note_content" autocomplete="off" class="flat_solid_textfield noteContent" placeholder="<?php echo lang('newNote_content'); ?>" style="resize: vertical;height:auto;min-height:200px;" 
                      dir="auto"></textarea>
                     <input type="submit" name="note_submit" class="green_flat_btn" value="<?php echo lang('create'); ?>">
                     <a href="main" class="silver_flat_btn"><?php echo lang('cancel'); ?></a>
             </form>
            </div>
        </div>
<!--=============================[ Footer ]========================================-->
<?php include("../includes/footer.php"); ?>
<script>
$('#noteTitle').maxlength();
    var acc = document.getElementsByClassName("dropdown_div_accordion");
    var i;

    for (i = 0; i < acc.length; i++) {
        acc[i].onclick = function(){
            this.classList.toggle("active");
            this.nextElementSibling.classList.toggle("show");
        }
    }
$('.noteContent').each(function () {
  this.setAttribute('style', 'height:' + (this.scrollHeight) + 'px;overflow-y:hidden;text-align: <?php echo lang('textAlign'); ?>;');
}).on('input', function () {
  this.style.height = 'auto';
  this.style.height = (this.scrollHeight) + 'px';
})
function hideMsg(){
    $('#error_msg').fadeOut('slow');
    $('#success_msg').fadeOut('slow');
}
</script>
    </body>
</html>