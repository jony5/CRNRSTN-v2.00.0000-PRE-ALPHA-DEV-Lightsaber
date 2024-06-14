<?php
/* 
// 5 ::
// Code is Poetry */
//
// INITIALIZE WEB PAGE
// HTTP/S AND DIRECTORY
// PATH ROOTS.
//
// Friday, June 7, 2024 @ 2318 hrs.
$tmp_http_dir = $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR');
$tmp_root_path = $oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT') . $oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR');
$tmp_http_root = $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP') . $tmp_http_dir;

?>
    <div id="footer_wrapper">
    	<div id="footer-copyright">&copy; <?php  echo date("Y"); ?> Jonathan '5' Harris :: All Rights Reserved.</div>
        <div id="5_footer"><a href="<?php echo $tmp_http_root; ?>" target="_self"><img src="<?php echo $tmp_http_root; ?>common/imgs/5.png" width="40" height="40" alt="J5" title="J5" /></a></div>
        <div id="bassdrive_standard_for_measurement"></div>
    </div>
    <div id="banner_endpoint" class="hidden"><?php echo $tmp_http_dir; ?>common/inc/lifestyle/banner_auto_rotate.inc.php</div>
    <div id="ROOT_PATH_CLIENT_HTTP_DIR" class="hidden"><?php echo $tmp_http_dir; ?></div>
    <div id="banner_cache" class="hidden"><?php

        include($tmp_root_path . '/common/inc/lifestyle/banner.inc.php');

        ?></div>
    <div id="banner_cache_slower_conn" class="hidden"><?php

        include($tmp_root_path . '/common/inc/lifestyle/banner.inc.php');

        ?></div>
    <div id="cache_bust" class="hidden"></div>
    <div id="cache_bust_banner" class="hidden"></div>
    <div id="the_bassdrive_situation" class="hidden"><?php echo $oUSER->returnBassdriveSituation(); ?></div>
    <div id="wall_time" class="hidden">0:00:00</div>
    <div id="ajax_root" class="hidden"><?php echo $tmp_http_root; ?></div>
    <div id="banner_mode_track" class="hidden">PLAY</div>
    <div id="script_popup_lock" class="hidden">OFF</div>
    <div id="animation_00_delay" class="hidden">J5</div>
    <div id="animation_01_delay" class="hidden">J5</div>
    <div id="animation_02_delay" class="hidden">J5</div>
    <div id="animation_03_delay" class="hidden">J5</div>
    <div id="animation_04_delay" class="hidden">J5</div>
    <div id="animation_05_delay" class="hidden">J5</div>
    <div id="animation_06_delay" class="hidden">J5</div>

    <?php

    if(!isset($tmp_gallery_overlay_BOOL)){

        //if($tmp_gallery_overlay_BOOL){
          echo '<div id="overlay" style="display:none;"></div>';
        //}

    }

    if(isset($_GET['vv'])) {

        $tmp_vv_str = $_GET['vv'];
        if(strlen($tmp_vv_str) > 0){

            echo '<div id="vv_deep_link_active" style="display:none;"></div>';

        }

    }

    if(strlen($tmp_scroll_ID) > 0){

        echo '
    <div id="page_scroll_to" style="display:none;">' . $tmp_scroll_ID . '</div>';

    }

    ?>

    <div class="hidden"><?php echo date("Y-m-d H:i:s", time()); ?></div>
    <script src="<?php echo $tmp_http_root; ?>common/js/_lib/frameworks/lightbox/2.11.1/js/lightbox-plus-jquery.min.js"></script>
<?php

/*
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-2181418-32', 'auto');
  ga('send', 'pageview');

</script>

*/

?>