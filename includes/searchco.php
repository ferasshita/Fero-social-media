<?php
session_start();
include('../config/connect.php');
include ("../includes/time_function.php");
if($_POST){
$q = htmlentities($_POST['search_user'], ENT_QUOTES);
$dircheckPath = htmlentities($_POST['dircheckPath'], ENT_QUOTES);
$uid = $_SESSION['id'];
// ============================ get posts from search request =====================================
$search_sql = "SELECT * FROM signup WHERE (Fullname LIKE ? OR work_detail LIKE ? OR country LIKE ?) OR (CONCAT(work,?,work0) LIKE ?) OR Username LIKE ? LIMIT 8";
$params = array("$q%", "$q%", " ", "$q%", "$q%", "$q%");
$search = $conn->prepare($search_sql);
$search->bindValue(':uid', $uid, PDO::PARAM_INT);
$search->execute($params);
$search_num = $search->rowCount();
if ($search_num == 0) {
echo "
<div style='text-align:center'>
<span align='center' class='fa fa-user' style='font-size:250px;color:grey;'></span>
<br>
<span align='center' style='font-size:100px;color:grey;'>Not found</span>
</div>
";
}elseif ($search_num >= 1) { ?>
<table class="postSavedTablei" style="border-radius:10px;min-width:100%;">
            <tr style="font-weight: bold; text-transform: uppercase; color: rgba(0, 0, 0, 0.59); font-size: 13px; background: rgb(241, 241, 241); border-bottom: 2px solid #46a0ec;">
                <td><?php echo lang('Your_contacts'); ?></td>
                
            </tr>
			
            <?php
	while ($fetchUserData = $search->fetch(PDO::FETCH_ASSOC)) {
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
echo "<img src='imgs/user_imgs/$his_userphoto' alt='$his_username' style='border-radius:50%; width:80px;height:80px;border:solid thin grey;'>
<div class='userActive' style='background:$userActive;left:80px;margin-top:-17px;'></div>";
echo "</div>";
?>
<div style="padding: 5px">
<a href="u/<?php echo $his_username; ?>" style='color: gray;font-size: 14px;'><?php echo "<b>$his_fullname</b>"; ?></a><br>
<a href="u/<?php echo $his_username; ?>" style='color: gray;font-size: 14px;'><?php echo "@$his_username"; ?></a><br>
<a href='<?php echo "posts/message?pid=$uid"; ?>'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b class="mobdi">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></a>
<?php    
        $fPosts_sql_sql = "SELECT * FROM messages WHERE (m_from=:uid AND m_to=:me) AND m_seen=0";
        $view_posts = $conn->prepare($fPosts_sql_sql);
		$view_posts->bindParam(':me',$me,PDO::PARAM_INT);
		$view_posts->bindParam(':uid',$uid,PDO::PARAM_INT);
        $view_posts->execute();
		$countSavedo = $view_posts->rowCount();
		if($countSavedo > 1){ 
echo"<span style='color:white;background:orange;border-radius:50px;border:none;float:right;'><b style='margin:5px;'>$countSavedo</b></span>";
		}
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

}
?>