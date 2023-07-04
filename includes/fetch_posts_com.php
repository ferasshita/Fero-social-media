<style>
	.postc{
    background: white;
    border-radius: 10px;
    box-shadow: 0px 0px 18px rgba(63, 81, 181, 0.16);
    max-width: 100%;
	min-height:90%;
	min-width: 1300px;
    margin: -6px 5px;
    border: 1px solid transparent;
}
.icfr{
	width:5%;
}
@media screen and (max-width:600px){
	.posti{
		min-width: 100%;
	}
.icfr{
	width:10%;
}
}

	</style>
        <?php
session_start();
       $newsab_sql = "SELECT * FROM postcom";
$newsab_q = $conn->prepare($newsab_sql);
$newsab_q->execute(); 
/////content/////////////
while ($postsfetch = $newsab_q->fetch(PDO::FETCH_ASSOC)) {
$get_post_id = $postsfetch['post_id'];
$id = $postsfetch['id'];
$content = $postsfetch['p_content'];
$link = $postsfetch['link'];
$linktext = $postsfetch['linktext'];
$time = $postsfetch['time'];
$imgu = $postsfetch['uimage'];
echo "<div class='postc' style='min-width: 99%;' id='$get_post_id' style='text-align:".lang('post_align').";'>
";
echo"<div style='width:100%;height:80%;border-radius:10px;background: url(imgs/com/$imgu) no-repeat center center; background-size: cover;'><img src='imgs/logo.ico' alt='fero logo' class='icfr' style='border-radius:50px;'></div>";
echo"<div style='margin:10px;'>";
echo nl2br("<p dir='auto'>$content</p>");
if($link){
	echo"<a href='$link'><div style='background: linear-gradient(320deg,#8910d6,#b52d94, orange);border-radius: 4px;width:100%;padding:5px;color:black;font-size:20px;'>$linktext</div></a>";
}
    $curtim = time();
    $diff = $curtim - $time;
    //intervals in seconds
    $intervals      = array (
        'year' => 31556926, 'month' => 2629744, 'week' => 604800, 'day' => 86400, 'hour' => 3600, 'minute'=> 60
    );
    //now we just find the difference
    if ($diff >= $intervals['day'] && $diff < $intervals['week'])
    {
	$delete_post_sql = "DELETE FROM postcom WHERE post_id= :get_post_id";
	$delete_post = $conn->prepare($delete_post_sql);
	$delete_post->bindParam(':get_post_id',$get_post_id,PDO::PARAM_INT);
	$delete_post->execute();
    }
echo"
</div>
</div>";
}
?>

