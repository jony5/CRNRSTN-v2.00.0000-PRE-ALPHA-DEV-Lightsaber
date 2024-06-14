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
// Saturday, June 8, 2024 @ 1405 hrs.
$tmp_root_path = $oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT') . $oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR');
$tmp_http_root = $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP') . $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR');
require($tmp_root_path . '/common/inc/session/session.inc.php');

# POLAR BEAR GALLERY CLASS & INSTANTIATION
require($tmp_root_path . '/common/classes/polar_bear_meta.inc.php');
require($tmp_root_path . '/common/inc/polarbear/polarbear.inc.php');

$tmp_gallery_overlay_BOOL = true;

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
            <div id="user_transaction_status_msg" class="<?php if(isset($oUSER->transStatusMessage_ARRAY[0])){ echo $oUSER->transStatusMessage_ARRAY[0]; } ?>"><?php if(isset($oUSER->transStatusMessage_ARRAY[0])){ echo $oUSER->transStatusMessage_ARRAY[1]; } ?></div>
        </div>
    </div>

    <!-- SUB NAV -->
    <div id="subnav_wrapper">
    	<div class="subnav_lnk_wrapper"><a href="<?php echo $tmp_http_root; ?>projects/crnrstn/philosophy/" target="_self">C<span style="color:#F00;">R</span>NRSTN Suite ::</a></div>
        <div class="subnav_lnk_wrapper"><a href="<?php echo $tmp_http_root; ?>projects/cannabis/atmospheric/" target="_self">cannabis grow op telemetry</a></div>
        <div class="subnav_lnk_wrapper sel">polar bear</div>
        <div class="cb"></div>
    </div>

    <div class="cb_30"></div>
    <!-- PAGE CONTENT -->
    <div id="content_wrapper">
    	<div id="vert_nav_wrapper">
            <div class="vert_nav_lnk_wrapper"><a href="<?php echo $tmp_http_root; ?>projects/polarbear/90daybuildout/factory/" target="_self">factory</a></div>
            <div class="vert_nav_lnk_wrapper"><a href="<?php echo $tmp_http_root; ?>projects/polarbear/90daybuildout/tint/" target="_self">tint</a></div>
    		<div class="vert_nav_lnk_wrapper"><a href="<?php echo $tmp_http_root; ?>projects/polarbear/90daybuildout/audio/" target="_self">audio</a></div>
    		<div class="vert_nav_lnk_wrapper"><a href="<?php echo $tmp_http_root; ?>projects/polarbear/90daybuildout/performance/" target="_self">performance</a></div>
            <div class="vert_nav_lnk_wrapper"><a href="<?php echo $tmp_http_root; ?>projects/polarbear/90daybuildout/exhaust/" target="_self">exhaust</a></div>
            <div class="vert_nav_lnk_wrapper sel">wrap</div>
            <div class="vert_nav_lnk_wrapper"><a href="<?php echo $tmp_http_root; ?>projects/polarbear/90daybuildout/hoonigan/" target="_self">hoonigan</a></div>
            <div class="vert_nav_lnk_wrapper"><a href="<?php echo $tmp_http_root; ?>projects/polarbear/90daybuildout/transparency/" target="_self">perspicuum</a></div>
        </div>
    	<div id="content">
    		<div class="content_title">2014 Dodge Dart SXT - 2.4L</div>
            <div class="content_copy">
            	<div style="width:700px;">

                    <?php
                    $dir_path = "common/imgs/dart/wrap/";
                    $thum_path = "common/imgs/dart/_thumb/";

                    $tmp_dir = $tmp_root_path . '/' . $dir_path;
                    $dart_filename_array = scandir($tmp_dir, 1);

                    $dart_filename_array = array_reverse($dart_filename_array);

                    $dart_array_size = sizeof($dart_filename_array);

                    for($i = 0; $i < $dart_array_size; $i++){

                        if(strlen($dart_filename_array[$i]) > 6){

                            echo '<div style="padding:5px 10px 5px 0; float:left;"><a class="dart_thumb" href=' .
                            $tmp_http_root . $dir_path . $dart_filename_array[$i] . ' rel="lightbox[dodge_dart]" title="' .
                            $oPolarBearMeta->returnCopy($dir_path, $dart_filename_array[$i], "caption") . '"><img class="polarbear_thumb" src="' .
                            $tmp_http_root . $thum_path . $dart_filename_array[$i] . '" alt="' .
                            $oPolarBearMeta->returnCopy($dir_path, $dart_filename_array[$i], "alt") . '" style="padding:0px; margin:0px;" /></a></div>';

                        }

                    }

                    ?>

                </div>
            </div>

    	</div><!-- END PAGE CONTENT -->

    </div>

    <div id="script_popup"></div>

    <div class="cb_30"></div>
    <?php

	require($tmp_root_path . '/common/inc/footer/footer.inc.php');

	?>
    <div class="cb_50"></div>

    </div>
</body>
</html>