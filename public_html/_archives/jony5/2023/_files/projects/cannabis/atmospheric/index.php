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
// Saturday, June 8, 2024 @ 1320 hrs.
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
            <div id="user_transaction_status_msg" class="<?php if(isset($oUSER->transStatusMessage_ARRAY[0])){ echo $oUSER->transStatusMessage_ARRAY[0]; } ?>"><?php if(isset($oUSER->transStatusMessage_ARRAY[0])){ echo $oUSER->transStatusMessage_ARRAY[1]; } ?></div>
        </div>
    </div>

    <!-- SUB NAV -->
    <div id="subnav_wrapper">
    	<div class="subnav_lnk_wrapper"><a href="<?php echo $tmp_http_root; ?>projects/crnrstn/philosophy/" target="_self">C<span style="color:#F00;">R</span>NRSTN Suite ::</a></div>
        <div class="subnav_lnk_wrapper sel">cannabis grow op telemetry</div>
        <div class="subnav_lnk_wrapper"><a href="<?php echo $tmp_http_root; ?>projects/polarbear/90daybuildout/factory/" target="_self">polar bear</a></div>
        <div class="cb"></div>
    </div>

    <div class="cb_30"></div>
    <!-- PAGE CONTENT -->
    <div id="content_wrapper">
    	<div id="vert_nav_wrapper">
    		<div class="vert_nav_lnk_wrapper sel">atmospheric</div>
            <div class="vert_nav_lnk_wrapper"><a href="<?php echo $tmp_http_root; ?>projects/cannabis/automation/" target="_self">automation</a></div>
    		<div class="vert_nav_lnk_wrapper"><a href="<?php echo $tmp_http_root; ?>projects/cannabis/lifesupport/" target="_self">life support</a></div>
    		<div class="vert_nav_lnk_wrapper"><a href="<?php echo $tmp_http_root; ?>projects/cannabis/diagram/" target="_self">diagram</a></div>

        </div>
    	<div id="content">
    		<div class="content_title">Using technology to optimize the performance of 
                the grow operation</div>
            <div class="content_copy">
            	<div class="col">
           			<p>The grow is a self contained environment...more-or-less. While you 
                    don't need to spend every waking hour in the same room as your plants, 
                    it is important to understand what they are experiencing so that issues 
                    can be spotted and corrected as soon as possible. In an ideal scenario, 
                    real-time performance specs for the grow environment would be available 
                    to you anywhere and anytime...24/7. So while your lovely ladies may be 
                    in the dark, you never will.</p>
            		
                    <p>Some environmental inputs, such as the plants' photo-period, can 
                    wreak havoc on your grow-show pretty quickly if the parameters fall too 
                    far out of alignment from the desired schedule.</p>
                	
                    <p>So, for example, by logging and graphing the lux output of your 
                    various grow rooms, a simple glance is all that would be needed in 
                    order to ensure that the expected photo-period protocols are being 
                    followed in all the right places.</p>

                </div>
                <div class="col">
                	<p><img src="<?php echo $tmp_http_root; ?>common/imgs/telemetry_icon.jpg" width="299" height="232" alt="Telemetry" title="Telemetry"></p>

                    <p>If you're looking to achieve maximum output from the legally-limited 
                    number of plants in your garden, you may also be taking advantage of 
                    advanced environmental control subsystems such as CO2 regulation.</p>
                	
                    <p>With these more advanced grow environments, anytime you DON'T have to 
                    manually &quot;break the seal&quot; to check to see that things are in 
                    order...that is literally</p>

                </div>
				<div class="col">
                	<p>money in the &quot;smoke bank&quot; that's being saved. This is because 
                    the leaking of light during a photo-period night or unnecessarily venting 
                    CO2, warmth, and even humidity will affect the productivity of your grow 
                    on a level that would be measurable over time...or at least from crop to 
                    crop.  Installing telemetric equipment to facilitate the remote monitoring 
                    of atmospheric variables is a great way to ensure that all the important 
                    numbers are dialed into the appropriate operating tolerances...all of 
                    the time.</p>

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