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
// Saturday, June 8, 2024 @ 1350 hrs.
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
    	<div class="subnav_lnk_wrapper sel">C<span style="color:#F00;">R</span>NRSTN Suite ::</div>
        <div class="subnav_lnk_wrapper"><a href="<?php echo $tmp_http_root; ?>projects/cannabis/atmospheric/" target="_self">cannabis grow op telemetry</a></div>
        <div class="subnav_lnk_wrapper"><a href="<?php echo $tmp_http_root; ?>projects/polarbear/90daybuildout/factory/" target="_self">polar bear</a></div>
        <div class="cb"></div>
    </div>

    <div class="cb_30"></div>
    <!-- PAGE CONTENT -->
    <div id="content_wrapper">
    	<div id="vert_nav_wrapper">
    		<div class="vert_nav_lnk_wrapper sel">status</div>
            <!--<div class="vert_nav_lnk_wrapper"><a href="<?php echo $tmp_http_root; ?>social/networking/googleplus/" target="_self">google+</a></div>
    		<div class="vert_nav_lnk_wrapper"><a href="<?php echo $tmp_http_root; ?>social/networking/instagram/" target="_self">instagram</a></div>
    		<div class="vert_nav_lnk_wrapper"><a href="<?php echo $tmp_http_root; ?>social/networking/linkedin/" target="_self">linkedin</a></div>
            <div class="vert_nav_lnk_wrapper"><a href="<?php echo $tmp_http_root; ?>social/networking/pandora/" target="_self">pandora</a></div>
            <div class="vert_nav_lnk_wrapper"><a href="<?php echo $tmp_http_root; ?>social/networking/twitter/" target="_self">twitter</a></div>-->
        </div>
    	<div id="content">
    		<div class="content_title"><strike>Almost done!</strike> <span style="font-size:14px; font-weight:normal;"><a href="https://github.com/jony5/CRNRSTN" target="_blank">This project is now LIVE!</a></span></div>
            <div class="content_copy">
            	<div class="col">
           			<p>I'm putting together an open source PHP class library primarily 
                    in order to facilitate the mapping of n+1 environmentally specific 
                    parameters to an application. So when the codebase is released from 
                    one hosting environment to the next (e.g. going from stage to 
                    preproduction or localhost to stage), the application will &quot;know&quot; 
                    which environment it is running in, and it will use the 
                    appropriate parameters.</p>

                    <p><a href="<?php echo $tmp_http_root; ?>dgf/crnrstn/" target="_blank"><img src="<?php echo $tmp_http_root; ?>common/imgs/crnrstn_logo.gif" width="198" height="103" alt="CRNRSTN ::" title="CRNRSTN ::"></a></p>

                    <p><a href="<?php echo $tmp_http_root; ?>dgf/crnrstn/" target="_blank">Click here</a> 
                    to sign up to receive an email alert when the class library becomes 
                    available. You'll only receive that one email from me.</p>

            	</div>
                <div class="col">
                	<p>The C<span style="color:#F00;">R</span>NRSTN Suite :: will also 
                    provide the ability to apply a layer of encryption to both session 
                    and/or cookie data as well as apply IPv4 and/or IPv6 address 
                    access restrictions.</p>
                	
                    <p>When I entered the workforce as an HTML developer (after the 
                    start up companies), I used PHP on the side to put together 
                    various portals and tools for quality control...heck...even web 
                    services. Sadly, I never had the time to carve out for myself a 
                    PHP class library for the gaining of efficiencies in product 
                    maintenance, development and deployment. While working at Moxie, 
                    I really could have used an out-of-the-box/plug-n-play class 
                    library with the capability of facilitating an application's 
                    compliance with a mature development shops' RTM processes.</p>

                    <p>I needed a class library that would support and standardize 
                    fundamental architectural and operational requirements.</p>

                </div>
				<div class="col">
                	<p>It also needed to be capable of performing flawlessly (read 
                    as fast and light) in some of the most brutal hosting/traffic 
                    environments known to man.</p>
                	
                    <p>Since transitioning out of the agency job, I have had the 
                    opportunity (and the time!) to roll up my sleeves and jump 
                    knee deep into the code. I put this project together so that I 
                    could have a mature development framework...a proper starting 
                    place...for all of my web development (LAMP stack) projects. 
                    The C<span style="color:#F00;">R</span>NRSTN Suite :: will be 
                    the culmination of years of contemplative thought, many hours 
                    spent in application testing &amp; development, countless cups 
                    of coffee, and more than a hint of cannabis.</p>

                </div>
            </div>

            <div class="cb"></div>
            <div class="content_hr"></div>
            <div class="content_title">Philosophy</div>
            <div class="content_copy">
            	<div class="col">
           			<p>In ancient times, a home could be constructed using large 
                    stone pieces to provide key support to the structure at the 
                    foundation, corners and top. A cornerstone, therefore, is the 
                    joining piece that connects together two walls of a house. 
                    Also, the foundation stone and roof (topstone) would be 
                    connected at the corners.</p>
                	
                    <p><strong>Pro Tip (Christian)</strong> :: When Jesus came, 
                    He came as the reality of the cornerstone (the real cornerstone) 
                    joining the "wall" of the Jewish believers to the "wall" of 
                    the gentile believers together in the building of the church.</p>

                </div>
                <div class="col">
                	<p>Jesus is the Cornerstone (Eph. 2:20, 1 Peter 2:6) in the 
                    building of the Father's house...the church...joining all of 
                    God's people together in Himself.</p>
					
                    <p>According to the footnote 3 on Eph. 2:20 in my <a href="http://biblesforamerica.org/free-bible/" target="_blank">Recovery Version</a> 
                    study Bible, when the Jewish builders rejected Christ, they 
                    rejected Him as the cornerstone (Acts 4:11; 1 Pet. 2:7), the 
                    One who would join the Gentiles to them for the building of 
                    God's house.</p>

                </div>
                <div class="col">
					<p>Well, to liken the act of building a house to the process 
                    of coding a web application...or I should say rather...in 
                    elegantly correlating web application requirements for 
                    portability under rigid release to manufacturing (RTM) 
                    processes to the simple illustration of a cornerstone 
                    joining the "wall of server" to the "wall of application", 
                    I have taken a modern technology staple and cast it under 
                    the warm analogue glow of the ancient world of 
                    house building.</p>

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