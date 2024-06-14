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
            <div id="user_transaction_status_msg" class="<?php echo $oUSER->transStatusMessage_ARRAY[0]; ?>"><?php echo $oUSER->transStatusMessage_ARRAY[1]; ?></div>
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
    		<div class="vert_nav_lnk_wrapper"><a href="<?php echo $tmp_http_root; ?>projects/cannabis/atmospheric/" target="_self">atmospheric</a></div>
            <div class="vert_nav_lnk_wrapper sel">automation</div>
    		<div class="vert_nav_lnk_wrapper"><a href="<?php echo $tmp_http_root; ?>projects/cannabis/lifesupport/" target="_self">life support</a></div>
    		<div class="vert_nav_lnk_wrapper"><a href="<?php echo $tmp_http_root; ?>projects/cannabis/diagram/" target="_self">diagram</a></div>

        </div>
    	<div id="content">
    		<div class="content_title">Overview of Sensors &amp; Automation</div>
            <div class="content_copy">
            	<div class="col">
                	<p><strong>sensor :: audio</strong></p>
           			<p>While it may not be necessary or beneficial to monitor and respond to 
                    changes in the actual decibel output of the overall grow room or one of it's subsystems, strategically collected and monitored microphone recordings can actually be used as an inexpensive alternative to air flow meters.</p>

            	</div>
                <div class="col">
                	<p>Placing mic sensors within close proximity to the grow-light-cooling 
                    inline fan(s) will allow you to monitor (at least to some degree) the operation of that airflow subsystem. From a binary perspective and at the very least, you will know whether these systems are running or not, and you can create triggered actions (such as the immediate deactivation of </p>
                </div>
				<div class="col">
                	<p>lamps) if the grow light cooling subsystem(s) is not performing as 
                    intended. Even if your lighting systems are programmed to trip off in the event of an over-heating, this preemptively firing dependency will help you to maximize the life of your bulbs as well as ward off unnecessary spikes in the grow rooms temperature.</p>
                </div>

            </div>

            <div class="cb"></div>
            <div class="content_hr"></div>
            <div class="content_title">Overview of Sensors &amp; Automation</div>
            <div class="content_copy">
            	<div class="col">
                	<p><strong>sensor :: video</strong></p>
					
                    <p>A properly constructed indoor grow room is...more-or-less...a 
                    self-contained environment. As lovely as the grow show is to look at on 
                    lonely winter nights, anytime you don't have to break the seal of your 
                    closed environment to check to see that things are in going well (or 
                    just to sneak a lustful peek) is literally money in the &quot;smoke 
                    bank.&quot; This is because the leaking of light during a photo-period 
                    night or unnecessarily venting CO2, warmth, and even humidity can 
                    affect the productivity of your grow on a level that would be 
                    measurable over time...or at least from crop to crop.</p>
            	
                </div>
                <div class="col">
					<p>With this in mind, one to many video feeds of all the key visual 
                    angles can bump up the productivity of the grow, provide valuable 
                    insightinto the performance of your grow room subsystems, and in 
                    general provide you with a custom tailored, 24/7, all access grow 
                    show that you could access from potentially anywhere on your 
                    mobile phone.</p>

                    <p>With respect to getting all the right angles...(1) recording a 
                    video log of the sunrise and sunset photo-period event horizons 
                    (pun intended), (2) the triggering of an atmospheric evacuation 
                    (planned and unplanned) and (3) the activation and operation of 
                    the nutrient delivery subsystem at its outer edges can provide 
                    valuable and near real-time insight into the quality and 
                    consistency of these important but oftenly 
                    automated-out-of-sight operations.</p>

                </div>
				<div class="col">
                	<p>For example, establishing a video feed against the nutrient delivery 
                    systems feeder tubing at the base of an outlier plant may expose 
                    sub par performance/pressurization of the nutrient solution water 
                    pump(s). A single blown bulb in a corner grow light may not be 
                    noticed by the photo-diode of the CO2 regulator, but a LIVE video 
                    feed (or snapshot recording) of a sunrise will both expose faulty 
                    lighting and may even provide you with the warning indicators of an 
                    immanent failure. Such pending failure may be indicated by 
                    super-extended bulb warm up periods before achieving 100% brightness; 
                    of course...you would normally never know that one of your lamps was 
                    taking an extra 15min to warm up unless you were physically present 
                    during one of the automated photo-period sunrises.</p>

                </div>

            </div>

            <div class="cb"></div>
            <div class="content_hr"></div>
            <div class="content_title">Overview of Sensors &amp; Automation</div>
            <div class="content_copy">
            	<div class="col">
                	<p><strong>sensor :: pH</strong></p>

                    <p>Due to the dynamic and complex nature of the environment within which 
                    this metric will be recorded, telemetric results need to be monitored 
                    closely, and independent analysis conducted on an ongoing basis. 
                    Any deltas need to be documented, as well as the procedures taken to 
                    ensure proper sensor performance. Be aware of the constant nature of 
                    the telemetric logging processes...e.g. removing a sensor for 10 min 
                    to clean it will affect your log data!</p>
					
                    <p>Also, as I have no plans to design and incorporate subsystems to 
                    automate the regulation of the pH metric within the grow (mainly due 
                    to costs and the experimental / hobby nature of this project), it 
                    would be beneficial to architect...into the telemetric processes of 
                    this subsystem...an automated escalation plan for the upper and lower 
                    bounds of this metric. Adjustments to pH levels can be done manually; 
                    for my purposes...I'm planning on it.</p>

                </div>
                <div class="col">
                	<p>If you don't automate the pH level management for your grow room, the 
                    escalation path should be above and beyond any other standard or 
                    regular notifications.</p>

                    <p>You need to notice at a glance, and so don't want the pH anomalies to 
                    get lost amid a sea of real-time biometric vitals.</p>

                    <p>When taking corrective action in response to such pH level alerts, a 
                    process for logging the action taken...e.g. timestamp as well as the 
                    volume and type of corrective chemical added should be taken into 
                    consideration. Eventually, and from an empirical perspective, you should 
                    be able to understand exactly what actions should be taken and when. 
                    After sufficient trial and error, all guess work can go out the window.</p>

                </div>
				<div class="col">

                	<p><div class="embedded_image" style="width:301px;"><img src="<?php echo $tmp_http_root; ?>common/imgs/hanna_ph_turtle.jpg" width="301" height="301" alt="Hanna pH Turtle" title="Hanna pH Turtle"></div></p>

                    <p>Science Lab Chemicals and Lab equipment stocks a kit that allows you to 
                    record pH measurements right on your windows computer for just over $100. 
                    It's called the <a href="http://www.sciencelab.com/page/S/PVAR/21769/50-HI9815" target="_blank">pH Turtle</a>.</p>

                </div>

            </div>


            <div class="cb"></div>
            <div class="content_hr"></div>
            <div class="content_title">Overview of Sensors &amp; Automation</div>
            <div class="content_copy">
            	<div class="col">
                	<p><strong>sensor :: lux</strong></p>
					
                    <p>According to the architecture of my grow room and due to the planned 
                    lux dependencies of the atmospheric subsystems (i.e. CO2, TEMP, and 
                    HUMIDITY controllers are directly regulated by the existence of light or 
                    lack thereof) one telemetric lux sensor needs to be placed within close 
                    proximity to the photocells that are used to control these 
                    light-dependent subsystems.</p>

                </div>
                <div class="col">
					<p>That being said, the monitoring of these subsystems can be simplified 
                    by grouping the controllers for these light sensitive systems into close 
                    physical proximity. This also helps to ensure that all light dependent 
                    subsystems behave similarly to the light levels that are present.</p>
					
                    <p>The remainder of available light sensors can be used to log the more 
                    biometrically indicative vitals of the grow rooms luminosity; these 
                    sensors can be incorporated into the grow to record light levels from 
                    the perspective of the plants.</p>

                </div>
				<div class="col">
                	<p><a href="http://www.yoctopuce.com/EN/products/usb-environmental-sensors/yocto-light-v3" target="_blank"><img src="<?php echo $tmp_http_root; ?>common/imgs/yacto_light_sensor.jpg" width="200" height="136" alt="Yacto Light Sensor" title="Yacto Light Sensor"></a></p>

                    <p>The <a href="http://www.yoctopuce.com/EN/products/usb-environmental-sensors/yocto-light-v3">Yocto-Light-V3</a> 
                    device is an USB ambiant light sensor (lux meter) which will allow you 
                    to you measure ambient light up to 100'000 lux. Measurements can be 
                    directly read via USB or stored on the device internal flash for later 
                    retrieval when connected again by USB. Click <a href="http://www.yoctopuce.com/EN/products/usb-environmental-sensors/yocto-light-v3">here</a> 
                    to<br>learn more.</p>

                </div>
            </div>

            <div class="cb"></div>
            <div class="content_hr"></div>
            <div class="content_title">Overview of Sensors &amp; Automation</div>
            <div class="content_copy">
            	<div class="col">
                	<p><strong>sensor :: temp</strong></p>

                    <p>At the time of this writing, the temp and humidity sensors have been 
                    scoped to be one and the same. Depending on the size of the grow, one 
                    to many sensors may be placed throughout the environment.</p>

                    <p>Sensor output should be monitored individually and it would be wise 
                    to create a report aggregator with the ability to average each of these 
                    metrics into a single result...respective of humidity and temp in 
                    real-time.</p>

                </div>
                <div class="col">
                	<p><a href=" http://www.omega.com/pptst/OM-EL-USB-RT.html" target="_blank"><img src="<?php echo $tmp_http_root; ?>common/imgs/omega_temp_sense.jpg" width="300" height="200" alt="Omega Temp/Humidity Sensor" title="Omega Temp/Humidity Sensor"></a></p>

                    <p>Omega.com stocks a real-time temperature and humidity monitor that 
                    is USB compatible for about $75. Some of the listed features include :</p>

                    <p><ul><li>displays real-time temperature and humidity readings on your 
                    PC using the Windows Control Software</li></ul></p>

                </div>
				<div class="col">
                	<p><ul>
 	                   <li>Plugs directly into USB</li>
                        <li>User-programmable alarm thresholds for temperature and 
                        relative humidity</li>
                        <li>dew point indication via windows control software</li>
                    </ul></p>

                    <p>Click <a href=" http://www.omega.com/pptst/OM-EL-USB-RT.html" target="_blank">here</a> 
                    to find out more about this Omega sensor.</p>

                    <p>Don't forget to consider any subsystems that may be regulated by temp 
                    and/or humidity; you should plan to build in oversight for any subsystems 
                    that are dependent on these metrics to function properly. I.e. watch what 
                    the watchers are watching in order to make sure that they are doing 
                    it right!</p>

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