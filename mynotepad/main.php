<?php
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
session_start();

include("../config/connect.php");
include("..//includes/fetch_users_info.php");
include("../includes/time_function.php");
include("../includes/country_name_function.php");
include("../includes/num_k_m_count.php");
if(!isset($_SESSION['Username'])){
    header("location: ../index");
}
?>

<html dir="<?php echo lang('html_dir'); ?>">
<head>
    <title><?php echo lang('my_notepad');?> &bull; Fero</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include "../includes/head_imports_main.php";?>
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
                <p><span class="fa fa-lock"></span> <?php echo lang('my_notepad');?><a href="new" class="green_flat_btn" style="float: <?php echo lang('float2'); ?>;"><?php echo lang('new_note');?></a>
                <br><label style="font-weight: normal;color: rgba(0, 0, 0, 0.31);font-size: small;"><?php echo lang('onlyUcanCThis');?></label>
            </p>
        <?php
$s_id = $_SESSION['id'];
$v_notes_sql = "SELECT * FROM mynotepad WHERE author_id= :s_id ORDER BY note_time DESC";
$v_notes = $conn->prepare($v_notes_sql);
$v_notes->bindParam(':s_id', $s_id, PDO::PARAM_INT);
$v_notes->execute();

if ($v_notes->rowCount() == 0) {
echo "<p align='center'>".lang('mynotepad_main_title').".</p>";
}else{
while ($v_notes_row = $v_notes->fetch(PDO::FETCH_ASSOC)) {
    $note_id = $v_notes_row['id'];
    $note_title_str = $v_notes_row['note_title'];
    $note_content_str = $v_notes_row['note_content'];
    $note_time_int = time_ago($v_notes_row['note_time']);
    $delete_note = htmlentities($_GET['delete'], ENT_QUOTES);

    if ($delete_note == $note_id) {
        $delete_s_note_sql = "DELETE FROM mynotepad WHERE id= :note_id";
        $delete_s_note = $conn->prepare($delete_s_note_sql);
        $delete_s_note->bindParam(':note_id',$note_id,PDO::PARAM_INT);
        $delete_s_note->execute();
        }else{

        }

    $url = '/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\:[0-9]+)?(\/\S*)?/';
    $note_content = preg_replace($url, '<a href="$0" target="_blank" title="$0">$0</a>', $note_content_str);
    $note_content = nl2br($note_content);

        echo "
        <button class='dropdown_div_accordion'>$note_title_str<i>$note_time_int</i></button>
        <div class='dropdown_div_panel'>
           <p style='margin-bottom: 20px;border-bottom: 1px solid rgba(0, 0, 0, 0.11);padding-bottom: 10px;'>
           $note_content
           </p>
           <a href='?delete=$note_id' id='dnUrl' class='red_flat_btn'><span class='fa fa-trash-o'></span> ".lang('delete')."</a>
        </div>
        ";
    }
}
        ?>
            </div>
        </div>
<!--=============================[ Footer ]========================================-->
<?php include("../includes/footer.php"); ?>
<script>
    var acc = document.getElementsByClassName("dropdown_div_accordion");
    var i;

    for (i = 0; i < acc.length; i++) {
        acc[i].onclick = function(){
            this.classList.toggle("active");
            this.nextElementSibling.classList.toggle("show");
        }
    }
$(document).ready(function () {
                $("#dnUrl").click(function (event) {
                    var $this = $(this),
                        url = $this.attr('href');
                    
                    $(document.body).load(url);
                    event.preventDefault();
                });
            });
</script>
    </body>
</html>