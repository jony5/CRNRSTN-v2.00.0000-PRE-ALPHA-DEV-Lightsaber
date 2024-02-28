<?php
/* 
// J5
// Code is Poetry */

?>
    <div id="footer_wrapper">
    	<div id="footer-copyright"></div>
        <div id="5_footer"><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>" target="_self"><img src="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/5.gif" width="16" height="16" alt="J5" title="J5" /></a></div>
    </div>
    <div id="banner_endpoint" class="hidden">
		<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/inc/lifestyle/banner_auto_rotate.inc.php
    </div>
    <div id="ROOT_PATH_CLIENT_HTTP_DIR" class="hidden"><?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?></div>
    <div id="banner_cache" class="hidden">
    <?php
	require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/lifestyle/banner.inc.php');
	?>
    </div>
    <div id="banner_mode_track" class="hidden">PLAY</div>
    <div id="script_popup_lock" class="hidden">OFF</div>

    <?php

    if(!isset($tmp_gallery_overlay_BOOL)){

        //if($tmp_gallery_overlay_BOOL){
          echo '<div id="overlay" style="display:none;"></div>';
        //}
    }

    ?>

    <div class="hidden"><?php echo date("Y-m-d H:i:s", time()); ?></div>

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