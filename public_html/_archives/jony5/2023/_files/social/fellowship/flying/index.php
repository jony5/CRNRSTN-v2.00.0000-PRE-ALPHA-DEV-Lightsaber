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
// Saturday, June 8, 2024 @ 1440 hrs.
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
    	<div class="subnav_lnk_wrapper"><a href="<?php echo $tmp_http_root; ?>social/networking/facebook/" target="_self">networking</a></div>
        <div class="subnav_lnk_wrapper sel">fellowship</div>
        <div class="cb"></div>
    </div>

    <div class="cb_30"></div>
    <!-- PAGE CONTENT -->
    <div id="content_wrapper">
    	<div id="vert_nav_wrapper">
    		<div class="vert_nav_lnk_wrapper"><a href="<?php echo $tmp_http_root; ?>social/fellowship/podcast/" target="_self">podcast</a></div>
            <div class="vert_nav_lnk_wrapper"><a href="<?php echo $tmp_http_root; ?>social/fellowship/conferences/" target="_self">conferences</a></div>
            <div class="vert_nav_lnk_wrapper"><a href="<?php echo $tmp_http_root; ?>social/fellowship/bibles-for-america/" target="_self">free Bibles</a></div>
    		<div class="vert_nav_lnk_wrapper sel">we can fly!</div>
        </div>
    	<div id="content">
    		<img src="<?php echo $tmp_http_root; ?>common/imgs/flying.jpg" width="700" height="2860" alt="They will mount up with wings like eagles (Isaiah 40:31b)." title="They will mount up with wings like eagles (Isaiah 40:31b).">

    	</div><!-- END PAGE CONTENT -->
    	<div class="hidden">
            <p>They will mount up with wings like eagles (Isaiah 40:31b). 
            The eagles' wings signify the resurrection power of Christ. God's power in life, 
            becoming our grace (cf. 1 Cor. 25:10; 2 Cor. 4:7; 12:9a). Those who stop themselves 
            and wait on Jehovah will experience the power of resurrection, will be transformed, 
            and will soar in the heavens (cf. Phil. 4:13; Col. 1:11). Scripture and notes from 
            Recovery Version (1341-1342). </p>

            <p>The eagles' wings signify the resurrection power of Christ. God's power in life, 
            becoming our grace (cf. 1 Cor. 25:10; 2 Cor. 4:7; 12:9a). Those who stop themselves 
            and wait on Jehovah will experience the power of resurrection, will be transformed, 
            and will soar in the heavens (cf. Phil. 4:13; Col. 1:11). Scripture and notes from 
            Recovery Version (1341-1342).</p>

            <p>The righteousness of the scribes and Pharasees (Matt. 5:20; Matt. 22:11-13) vs. 
            Living Christ to become God's righteousness (Phil. 1:21; 2 Cor. 5:21; 1 Cor. 1:30).

            <p>The appearance of the kingdom of the heavens (Matt. 13:31-32; Rev. 2:12-17) vs. 
            the reality of the kingdom of the heavens (Rom. 14:17).</p>

            <p>Exercise your mind to memorize prayers and supplications for recitation 
            (Mark 12:40; Matt. 23:14) vs. exercising your human spirit in prayer through the 
            Word (Eph. 6:17-18).</p>

            <p>Living an ethical life through the extraction of "godly values" from the Bible 
            for a testimony of possessing eternal life (Matt. 5:20; Matt. 22:11-13) vs. living 
            Christ through the bountiful supply of the Spirit of Jesus Christ that the 
            resurrection life of Christ mar be magnified (Phil. 1:19-21; Phil. 3:9).</p>

            <p>I love others because that is what the Bible says you're supposed to be doing 
            (Rom. 8:6a; Rom. 8:7-8) vs. I just love others...I don't know how to explain it; 
            Praise the Lord saints (Rom. 8:6b; Rom. 8:14)!</p>

            <p>Eagerly awaiting heaven (No Scripture references available) vs. redeeming the 
            time to be sanctified and transformed into precious materials for God's building 
            which ultimately will consummate in the New Jerusalem for eternity (2 Cor. 3:18; 
            Rom. 12:2; 1 Pet. 2:5; Heb. 12:22; Rev. 21:2, 19-21).</p>

            <p>If Jesus were here right now, what would He say or do in this situation (i.e. 
            WWJD)? I will exercise my mind with respect to these fleshly things and thus 
            respond accordingly (Matt. 17:24-25a; Rom. 3:20; Rom. 7:11, 24; Gal. 3:3, 10; 
            Rom. 8:5a, 6a, 7-8, 13a). vs the Lord IS here right now! As the Spirit, He is 
            with me and even in me. By faith, I live, walk and have my being all according 
            to my mingled spirit an in oneness with the Lord (Acts 8:29; Acts 10:13-15, 
            19-20, 28-29, 44; Acts 13:4; Acts 16:6-7; Gal. 5:16, 18, 15; Rom. 8:2, 4, 5b, 
            6b, 13b-14; 1 Cor. 6:17).</p>

        </div>
    </div>

    <div class="cb_30"></div>
    <?php

	require($tmp_root_path . '/common/inc/footer/footer.inc.php');

	?>
    <div class="cb_50"></div>

    </div>
</body>
</html>