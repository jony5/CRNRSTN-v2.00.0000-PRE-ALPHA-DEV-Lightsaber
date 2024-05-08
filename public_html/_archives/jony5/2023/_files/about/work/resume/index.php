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
            <div class="vert_nav_lnk_wrapper"><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>about/work/skills/" target="_self">skills</a></div>
    		<div class="vert_nav_lnk_wrapper sel">resume</div>
    	</div>

    	<div id="content">
        	<div class="content_copy">
            	<div class="col" style="width:900px;">
                    <p><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP') . $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>downloads/resume/jharris_resume.php?v=420" download>Click here</a> to download my resume.</p>
                </div>
            </div>

            <div class="cb_20"></div>
            <div class="content_title">Profile</div>
            <div class="content_copy">
            	<div class="col" style="width:900px;">
           			<p>With 6 years of solid agency experience behind me at Moxie...where I 
                    helped to fuel the growth and development of various aspects of my previous employer's email marketing (ECRM) services..., I
                    am looking for a fresh opportunity to join an active, growing and digitally fueled company to strengthen and broaden key aspects of their service
                    offerings. For my previous employer, I worked with corporate clients to formulate and execute (with my own bare
                    hands when necessary) multi-channel business marketing initiatives...of which email was a core component. In
                    support of my clients, I managed hundreds of email automations, email triggers and data capture mechanisms
                    embedded within flash/rich media landing pages, banner ads, static landing pages, pages for mobile, etc. I was
                    also responsible for ensuring that all of the data that was captured had the necessary tags to facilitate the pulling
                    of relevant and meaningful lists on the backend (proper segmentation). Although I worked with dedicated data
                    base people, I would regularly receive requests for the pulling of lists based off the client's segmentation criteria;
                    I would write the SQL, run it against the database and produce the desired list for our campaign managers to process for a campaign launch.</p>

                    <p>I've been in the trenches and mastered the coding and QA-ing of HTML email messages. I've also taken on high
                    level data architect responsibilities with the design and development of custom creative assets and campaign management client extranets where business processes were integrated into the web portal's functionality. I am a full stack PHP developer.
                    Strategy and execution are my core competencies.</p>

                </div>
            </div>

            <div class="cb"></div>
            <div class="content_hr"></div>
            <div class="content_title">Experience</div>
            <div class="content_copy">
            	<div class="col" style="width:900px;">
           			<p><strong>Solutions Engineer, Moxie</strong> Atlanta, GA <em>[May 2006-Feb 2012]</em><br>
                    As our team expanded from 4 people to +25, I applied technology in creative ways to streamline team process, improve the quality of our agency services and remove bottlenecks. I also supported various internal agency projects, and these allowed me to test the suitability of technical concepts and theories for use in the public space. I had daily responsibilities which included managing list segmentation, email automation, email triggers, multi-channel data capture integrations, reporting and analytics testing and implementation and sending out the company holiday party invitation HTML email.</p>

                    <div class="cb_10"></div>
                    <p><strong>Technical Contractor, Technisource</strong> Atlanta, GA <em>[Jan 2006-May 2006]</em><br>
                    As the primary technical resource for the growing email marketing services team, I developed web based tools (LAMP) to improve quality control and streamline QA processes. As a result, the higher quality deliverables, I was fixing fewer bugs; this gave me more time to focus on other technical projects (for other clients) within the agency.</p>

                    <div class="cb_10"></div>
                    <p><strong>IT, First Discount Mortgage</strong> Atlanta, GA <em>[Aug 2005-Dec 2005]</em><br>
                    Replacing an IT team of 2 people, I was primarily responsible for end user tech support and service. I also managed updates to their hosted web services.</p>

                    <div class="cb_10"></div>
                    <p><strong>Lead Developer, CommercialNet, Inc.</strong> Norcross, GA <em>[Oct 2004-Aug 2005]</em><br>
                    A coffee shop startup...I was the lead developer for the account management, payment authorization and product delivery web services.</p>
                </div>
            </div>

            <div class="cb"></div>
            <div class="content_hr"></div>
            <div class="content_title">Education</div>
            <div class="content_copy">
            	<div class="col" style="width:900px;">
           			<p>Georgia State University, Atlanta GA - BA in Computer Information Systems, 2004</p>
                </div>
            </div>

            <div class="cb"></div>
            <div class="content_hr"></div>
            <div class="content_title">Skills/Consulting</div>
            <div class="content_copy">
            	<div class="col" style="width:900px;">
           			<p>frontend web development (HTML4,CSS,AJAX), backend web services (SOA) development (LAMP stack), web application architecture, email marketing, data capture, database (MySQL) administration, reporting & analytics integrations, integrations with social networking sites</p>
                </div>
            </div>

            <div class="cb"></div>
            <div class="content_hr"></div>
            <div class="content_title">Languages, Technologies, Formats and Platforms</div>
            <div class="content_copy">
            	<div class="col" style="width:900px;">
           			<p>LAMP stack, HTML, CSS, JavaScript, AJAX, XML, JSON, Adobe CS5, MS Office Suite, Mac, Windows</p>
                </div>
            </div>

            <div class="cb"></div>
            <div class="content_hr"></div>
            <div class="content_title">Resume Download</div>
            <div class="content_copy">
                <div class="col" style="width:900px;">
                    <p><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP') . $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>downloads/resume/jharris_resume.php?v=420" download>Click here</a> to download my resume.</p>
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