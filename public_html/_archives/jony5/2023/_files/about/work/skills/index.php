<?php

/* 
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
include_once($CRNRSTN_ROOT . '_crnrstn.config.inc.php');
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/session/session.inc.php');

?>
<!doctype html>
<html lang="en">
<head>
<?php
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/head/head.inc.php');
?>
</head>

<body>
<?php
	require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/contact/contact.inc.php');
	?>
<div id="body_wrapper">
	<!-- HEAD CONTENT -->
	<?php
	require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/nav/topnav.inc.php');
	?>
	<div class="cb"></div>
    
    <!-- LIFESTYLE BANNER -->
    <?php
    require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/lifestyle/banner_component.inc.php');
    ?>

    <div id="banner_lifestyle_dropshadow" style="background-image:url(<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/dropshadow.gif);">
    	<div id="banner_lifestyle_dropshadow_corner"><img src="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/dropshadow_corner.gif" width="6" height="6" alt=""></div>
    </div>
    
    <div id="user_transaction_wrapper" class="user_transaction_wrapper" style="display:none;">
        <div class="user_transaction_content">
            <div id="user_transaction_status_msg" class="<?php echo $oUSER->transStatusMessage_ARRAY[0]; ?>"><?php echo $oUSER->transStatusMessage_ARRAY[1]; ?></div>
        </div>
    </div>
    
    <!-- SUB NAV -->
    <div id="subnav_wrapper">
    	<div class="subnav_lnk_wrapper"><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>about/bio/professional/" target="_self">bio</a></div>
        <div class="subnav_lnk_wrapper sel">work</div>
        <div class="cb"></div>
    </div>
    
    <div class="cb_30"></div>
    <!-- PAGE CONTENT -->
    <div id="content_wrapper">
    	<div id="vert_nav_wrapper">
    		<div class="vert_nav_lnk_wrapper"><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>about/work/highlights/" target="_self">highlights</a></div>
            <div class="vert_nav_lnk_wrapper"><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>about/work/experience/" target="_self">experience</a></div>
            <div class="vert_nav_lnk_wrapper sel">skills</a></div>
    		<div class="vert_nav_lnk_wrapper"><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>about/work/resume/" target="_self">resume</a></div>
    	</div>
    
    	<div id="content">
            <div class="content_title">Business &amp; Technology</div>
            <div class="content_copy">
            	<div class="col" style="width:900px;">
           			<p>
                    <ul>
                    <li>SMS Promotions :: strategy and execution</li>
                    <li>banner ad promotions :: strategy and execution</li>
                    <li>landing page promotions :: strategy and execution</li>
                    <li>email marketing/newsletters :: strategy and execution</li>
                    <li>translations of business integrations to web application architectures</li>
                    <li>business integrations with 3rd party social networking sites</li>
                    <li>business integrations with 3rd party enterprise reporting and analytics suites</li>
                    <li>business integrations with 3rd party enterprise email marketing platforms</li>
                    <li>LAMP stack hosting and development</li>
                    <li>web services development (SOA)</li>
                    <li>front end development (HTML,CSS,JavaScript/AJAX)</li>
                    <li>rapid prototyping</li>
                    <li>user administration</li>
                    <li>content distribution network administration</li>
                    <li>MySQL database administration</li>
                    <li>Computer (Mac/PC) diagnostics and repair</li>
                    <li>Logistics/planning for activities with large groups of people</li>
                    <li>brewing coffee (certified barista for the Starbucks Corporation)</li>
    				</ul>
                    </p>
                </div>
            </div>
            
            <div class="cb"></div>
            <div class="content_hr"></div>
            <div class="content_title">Computers & Electronics</div>
            <div class="content_copy">
            	<div class="col">
           			<p>No, I will not fix your computer :)</p>
                </div>
            </div>
            
            
            <div class="cb"></div>
            <div class="content_hr"></div>
            <div class="content_title">People</div>
            <div class="content_copy">
            	<div class="col">
           			<p>I have people skills!</p>
                </div>
            </div>
            
            <div class="cb"></div>
            <div class="content_hr"></div>
            <div class="content_title">Animals & the Outdoors</div>
            <div class="content_copy">
            	<div class="col" style="width:900px;">
           			<p>I enjoy animals and the outdoors. If I can mix both of these items with work...e.g. putting a presentation together from the comfort of a sunny patio or coding in a courtyard with my dog...all the better! As an Eagle Scout and Vigil honor brother in the Order of the Arrow, the connection that I have to the outdoors is respected, but I don't over do it. I've spent more than my fare share of time in the woods on official BSA organizational business. ^_^</p>
                </div>
            </div>
            
            <div class="cb"></div>
            <div class="content_hr"></div>
            <div class="content_title">Mechanized Systems</div>
            <div class="content_copy">
            	<div class="col" style="width:900px;">
					<p>Does the contraption you're holding there have it's own mechanical system of operation? Can I see that when you get a sec?</p>
                </div>
            </div>
            
    	</div><!-- END PAGE CONTENT -->
    
    </div>
    
    <div class="cb_30"></div>
    <?php
	require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/footer/footer.inc.php');
	?>
    <div class="cb_50"></div>
    

</div>
</body>
</html>