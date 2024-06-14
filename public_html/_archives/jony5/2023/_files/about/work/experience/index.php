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
// Saturday, June 8, 2024 @ 1219 hrs.
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
    <div id="banner_lifestyle_dropshadow" style="background-image:url(<?php echo $tmp_root_path; ?>common/imgs/dropshadow.gif);">
    	<div id="banner_lifestyle_dropshadow_corner"><img src="<?php echo $tmp_root_path; ?>common/imgs/dropshadow_corner.gif" width="6" height="6" alt=""></div>
    </div>

    <div id="user_transaction_wrapper" class="user_transaction_wrapper" style="display:none;">
        <div class="user_transaction_content">
            <div id="user_transaction_status_msg" class="<?php echo $oUSER->transStatusMessage_ARRAY[0]; ?>"><?php echo $oUSER->transStatusMessage_ARRAY[1]; ?></div>
        </div>
    </div>

    <!-- SUB NAV -->
    <div id="subnav_wrapper">
    	<div class="subnav_lnk_wrapper"><a href="<?php echo $tmp_http_root; ?>about/bio/professional/" target="_self">bio</a></div>
        <div class="subnav_lnk_wrapper sel">work</div>
        <div class="cb"></div>
    </div>

    <div class="cb_30"></div>
    <!-- PAGE CONTENT -->
    <div id="content_wrapper">
    	<div id="vert_nav_wrapper">
    		<div class="vert_nav_lnk_wrapper"><a href="<?php echo $tmp_http_root; ?>about/work/highlights/" target="_self">highlights</a></div>
            <div class="vert_nav_lnk_wrapper sel">experience</div>
            <div class="vert_nav_lnk_wrapper"><a href="<?php echo $tmp_http_root; ?>about/work/skills/" target="_self">skills</a></div>
    		<div class="vert_nav_lnk_wrapper"><a href="<?php echo $tmp_http_root; ?>about/work/resume/?v=420" target="_self">resume</a></div>
    	</div>
    	<div id="content">
            <div class="content_title">Agency</div>
            <div class="content_copy">
            	<div class="col" style="width:900px;">
           			<p><strong>Solutions Engineer, <a href="http://moxieusa.com/" target="_blank">Moxie</a></strong> 
                    Atlanta, GA <em>[May 2006-Feb 2012]</em><br>
                    As our team expanded from 4 people to +25, I applied technology in 
                    creative ways to streamline team process, improve the quality of 
                    our agency services and remove bottlenecks. I also supported various 
                    internal agency projects, and these allowed me to test the suitability 
                    of technical concepts and theories for use in the public space.</p>

                </div>
            </div>

            <div class="cb"></div>
            <div class="content_hr"></div>
            <div class="content_title">Contracting</div>
            <div class="content_copy">
            	<div class="col" style="width:900px;">
           			<p><strong>Technical Contractor, <a href="https://www.randstadusa.com/technologies/" target="_blank">Technisource</a></strong> 
                    Atlanta, GA <em>[Jan 2006-May 2006]</em><br>
                    As the primary technical resource for the growing email marketing 
                    services team, I developed web based tools (LAMP) to improve quality 
                    control and streamline QA processes. As a result, the higher quality 
                    deliverables, I was fixing fewer bugs; this gave me more time to focus 
                    on other technical projects (for other clients) within the agency.</p>

                </div>
            </div>

            <div class="cb"></div>
            <div class="content_hr"></div>
            <div class="content_title">Infrastructure and Tech Support</div>
            <div class="content_copy">
            	<div class="col" style="width:900px;">
           			<p><strong>IT, First Discount Mortgage</strong> 
                    Atlanta, GA <em>[Aug 2005-Dec 2005]</em><br>
                    Replacing an IT team of 2 people, I was primarily responsible for end 
                    user tech support and service. I also managed updates to their hosted 
                    web services.</p>

                </div>
            </div>

            <div class="cb"></div>
            <div class="content_hr"></div>
            <div class="content_title">Startup</div>
            <div class="content_copy">
            	<div class="col" style="width:900px;">
           			<p><strong>Lead Developer, CommercialNet, Inc.</strong> 
                    Norcross, GA <em>[Oct 2004-Aug 2005]</em><br>
                    A coffee shop startup...I served briefly as CEO before dropping back 
                    behind the scenes to be the lead developer for the account management, 
                    payment authorization and product delivery web services.</p>

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