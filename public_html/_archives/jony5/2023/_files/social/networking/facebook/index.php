<?php
/*
// 5 ::
// Code is Poetry */
require('_crnrstn.root.inc.php');
include_once($CRNRSTN_ROOT . '_crnrstn.config.inc.php');

//
// INITIALIZE WEB PAGE
// HTTP/S AND DIRECTORY
// PATH ROOTS.
//
// Saturday, June 8, 2024 @ 1503 hrs.
$tmp_root_path = $oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT') . $oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR');
$tmp_http_root = $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP') . $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR');
require($tmp_root_path . '/common/inc/session/session.inc.php');

?>
<!doctype html>
<html lang="en">
<head>
<?php require($tmp_root_path . '/common/inc/head/head.inc.php'); ?>
</head>
<body>
    <?php

	require($tmp_root_path . '/common/inc/contact/contact.inc.php');

	?>
    <div id="body_wrapper">
	<!-- HEAD CONTENT -->
	<?php

	require($tmp_root_path . '/common/inc/nav/topnav.inc.php');

	?>
	<div class="cb"></div>
    <!-- LIFESTYLE BANNER -->
    <?php

    require($tmp_root_path . '/common/inc/lifestyle/banner_component.inc.php');

    ?>
    <div id="banner_lifestyle_dropshadow" style="background-image:url(<?php echo $tmp_http_root; ?>common/imgs/dropshadow.gif);">
    	<div id="banner_lifestyle_dropshadow_corner"><img src="<?php echo $tmp_http_root; ?>common/imgs/dropshadow_corner.gif" width="6" height="6" alt=""></div>
    </div>

    <div id="user_transaction_wrapper" class="user_transaction_wrapper" style="display:none;">
        <div class="user_transaction_content">
            <div id="user_transaction_status_msg" class="<?php echo $oUSER->transStatusMessage_ARRAY[0]; ?>"><?php echo $oUSER->transStatusMessage_ARRAY[1]; ?></div>
        </div>
    </div>

    <!-- SUB NAV -->
    <div id="subnav_wrapper">
    	<div class="subnav_lnk_wrapper sel">networking</div>
        <div class="subnav_lnk_wrapper"><a href="<?php echo $tmp_http_root; ?>social/fellowship/podcast/" target="_self">fellowship</a></div>
        <div class="cb"></div>
    </div>

    <div class="cb_30"></div>
    <!-- PAGE CONTENT -->
    <div id="content_wrapper">
    	<div id="vert_nav_wrapper">
    		<div class="vert_nav_lnk_wrapper sel">facebook</div>
            <div class="vert_nav_lnk_wrapper"><a href="<?php echo $tmp_http_root; ?>social/networking/googleplus/" target="_self">google+</a></div>
    		<div class="vert_nav_lnk_wrapper"><a href="<?php echo $tmp_http_root; ?>social/networking/instagram/" target="_self">instagram</a></div>
    		<div class="vert_nav_lnk_wrapper"><a href="<?php echo $tmp_http_root; ?>social/networking/linkedin/" target="_self">linkedin</a></div>
            <div class="vert_nav_lnk_wrapper"><a href="<?php echo $tmp_http_root; ?>social/networking/pandora/" target="_self">pandora</a></div>
            <div class="vert_nav_lnk_wrapper"><a href="<?php echo $tmp_http_root; ?>social/networking/twitter/" target="_self">twitter</a></div>
        </div>
    	<div id="content">
    		<div class="content_title">Connect with me on Facebook<sup style="font-size:60%;">&reg;</sup></div>
            <div class="content_copy">
            	<div class="col" style="width:900px;">
           			<p>You can find me on Facebook<sup style="font-size:60%;">&reg;</sup> here <a href="https://www.facebook.com/j00000101" target="_blank">facebook.com/j00000101</a>. 
                    I typically only add people as friends whom I 
                    have met in real life, but if you can connect with 
                    me perhaps you'll get the add :).</p>

                    <div class="cb_200"></div>
                    <div class="cb_50"></div>
            	</div>
            </div>

    	</div><!-- END PAGE CONTENT -->

    </div>

    <div class="cb_30"></div>
    <?php

	require($tmp_root_path . '/common/inc/footer/footer.inc.php');

	?>
    <div class="cb_50"></div>

    </div>
</body>
</html>