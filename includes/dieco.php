<?php
if (is_dir("imgs/")) {
    $dircheckPath = "";
}elseif (is_dir("../imgs/")) {
    $dircheckPath = "../";
}elseif (is_dir("<?php echo $dircheckPath; ?>imgs/")) {
    $dircheckPath = "<?php echo $dircheckPath; ?>";
}
// ================================ check user exist ===================================
session_start();
?>
<style type="text/css">
    .navbar-nav>li{
        float: <?php echo lang('float'); ?>;
    }
</style>
    <div class="container-fluid" style="width: 100%;">
        <div class="navbar-collapse" id="myNavbar">
            <ul class="<?php echo lang('ul_navbar_nav1'); ?>">
                <?php
                if (is_file("home.php")) {
                    $homePath = "home";
                }elseif (is_file("../home.php")) {
                    $homePath = "../home";
                }elseif (is_file("../../home.php")) {
                    $homePath = "../../home";
                }
                ?>
            </ul>
            <ul style="float:<?php echo lang('sponsored_align'); ?>">
                <input id="searchco" dir="auto" class="navbar-inverseco" type="search" name="navbar_search" placeholder="<?php echo lang('navbar_serchBox_ph'); ?>" style="text-align: <?php echo lang('textAlign'); ?>; min-width: 100%; color: black;background:white;border:solid thin #000000;border-radius:4px;margin-top:10px black;min-height:4%;" />
                 <div class="navbar_fetchBox" id="search_ro">
                 <div class="scrollbar" style="overflow: auto;max-height: 450px;width: 1000px;"></div>
                 <p  id="LoadingSearchResult" style="background: url(imgs/loading_video.gif) center center no-repeat;width: 100%;height: 80px;margin: 0px;display: none;"></p>
                </div>
            </ul>
        </div>
    </div>
<?php include ($dircheckPath."js/navbar_nottifi_js.php"); ?>