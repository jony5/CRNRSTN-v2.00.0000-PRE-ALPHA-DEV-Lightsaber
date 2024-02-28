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
    	<div class="subnav_lnk_wrapper sel">bio</div>
        <div class="subnav_lnk_wrapper"><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>about/work/highlights/" target="_self">work</a></div>
        <div class="cb"></div>
    </div>
    
    <div class="cb_30"></div>
    <!-- PAGE CONTENT -->
    <div id="content_wrapper">
    	<div id="vert_nav_wrapper">
    		<div class="vert_nav_lnk_wrapper sel">professional</div>
            <div class="vert_nav_lnk_wrapper"><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>about/bio/personal/" target="_self">personal</a></div>
    		<div class="vert_nav_lnk_wrapper"><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>about/bio/heavenly/" target="_self">heavenly</a></div>
    	</div>
    
    	<div id="content">
    		<div class="content_title">Reflection</div>
            <div class="content_copy">
            	<div class="col">
					<p>As I take time to briefly consider...in retrospect...the succession of 'career influencing' decisions that have been made within the course of about 20 years and that have been deemed to be a dominant influence in creating the strength and character of the bearer...me..., the dynamically interwoven nature of the stream of circumstances surrounding each decision almost prove to be more important than the very decisions that I had to make. What I'm saying is, for what it's worth, I cannot take full credit for being where I am today. In many ways, environmental factors...over which I had very little control...had their own part to play in bringing me to the next &quot;destination&quot;.</p>
                    
                </div>
                <div class="col">
					<p>To put it another way, sometimes seemingly insignificant decisions made on a day-to-day basis ultimately have had broader implications as it relates to making me who I am today.</p>
                    <p>For example, I spent a fair amount of time working on web projects at various coffee shops. Making the necessary and perhaps somewhat insignificant decision about what coffee shop(s) I would frequent has, on more than one occasion, been a determining factor playing into the people that I would meet in my travels. A number of career influencing business connections have been made at these local watering holes, and I</p>

                 </div>
                <div class="col">
                	<p>sometimes wonder where I would be today if I had developed the practice of doing all my work in the private space of my own home.</p>
					<p>The life style of most of my professional career which has...I guess...a strong emphasis placed on mobility (spending time in the community) has been a defining characteristic in making me who I am today. From a number of perspectives, I have come to appreciate the work habits that have been developed over time. </p>
               </div>
            </div>
            
            <div class="cb"></div>
            <div class="content_hr"></div>
            <div class="content_title">Believe in your own ideas...as much as you do others'</div>
            <div class="content_copy">
            	<div class="col">
           			<p>About a year after college, I began work on an idea for a new virtual tour web service for real estate agents. This idea later materialized into a startup company called CommercialNet, Inc. If you're reading this, I'm probably still paying bills from this endeavor, but the lessons learned have been invaluable.</p>
                </div>
                <div class="col">
                	<p><strong>Pro Tip:</strong> I use the word invaluable...because it helps me to feel better about measuring the ROI of the experience gained against the credit cards that were maxed out towards the end of my work with our bootstrapped operation.</p>
                </div>
                <div class="col">
                	<p>Well, to be honest (as I said the above tongue-in-cheek), I can't ignore the fact that my start up company expenditures were a fraction of the cost of a semester at Emory, and I walked away with experience, ideas, some coding skillz and some good ole entrepreneurial elbow grease know-how...all of which are empowering.</p>
               </div>
            </div>
            
            <div class="cb"></div>
            <div class="content_hr"></div>
            <div class="content_title">Cheerfully serve others</div>
            <div class="content_copy">
            	<div class="col">
           			<p>Speaking of serving others, after a brief IT assignment with a local Atlanta mortgage company,...I'd like to make this statement for anyone who is thinking about entering the tech support world for the first time :: </p>
                	<p><blockquote>Even though one may be able to keep his/her own tech gear in good working order...one does not really KNOW tech support until required to provide corporate IT support to at least 30 other people...in different cities...with nothing but 1) your personal laptop, 2) personal cellphone, 3) bluetooth ear piece found under a chair at the food court of <a href="http://www.simon.com/mall/lenox-square" target="_blank">Lenox Mall</a> and a 4) team of yourself...and...GO!</blockquote></p>
                </div>
                <div class="col">
                	<p>The  bluetooth earpiece I found on the ground turned out to be invaluable; try doing tech support for 10hrs a day with your mobile + laptop without one. My neck was thanking me by the end of the next day. ^_^ </p>
                	<p>Ultimately, things didn't work out as well as I wanted at First Discount Mortgage, but I gave it my best shot.</p>
                </div>
                <div class="col">
                	<p>And then again, it actually worked out really well, in hindsight, due to the many and varied experiences gained supporting financial contractors (the end users) for several intense months. This level of support would become a cornerstone in my agency experience.</p>
               </div>
            </div>
            
            
            <div class="cb"></div>
            <div class="content_hr"></div>
            <div class="content_title">Never stop learning</div>
            <div class="content_copy">
            	<div class="col">
           			<p>By the time I arrived at the front door of agency, I had worked on several initiatives with several businesses and individuals covering core areas of what one would consider &quot;technical business competence&quot;. Through all of these experiences, I learned how to put food on the companies table...please read as &quot;everyone's table&quot;...via making smart tactical moves towards multiple business objectives. </p>
                </div>
                <div class="col">
                	<p>In my first week at agency, the top 3 most shocking things to me...from least to most shocking :: </p>
                    <p>
                    <blockquote>
                    - There was a refrigerator that had been stocked with free juice and beer...both free as in F.R.E.E.
					<br>- For the first time in my technical career, I had the refreshing opportunity to work with a heavily expanded technical team that included men and women from all walks of life. The Moxie team was much larger than the team of one or two at First Discount Mortgage...or the product services team of about (5) at CommercialNet. This was a very welcome change of scenery, as there was room for me to network and grow professionally within the organization.
                    </blockquote>
                    </p>
                </div>
                <div class="col">
                	<p>
                    <blockquote>
                    - And the most shocking thing to me in my first week of agency was that all the people started leaving at five or six o'clock. I had been used to working until 10PM or 11PM in the startup company. And check this out...they took 1hr lunch breaks too! In the words of a good friend of mine...now that's crazy talk.
                    </blockquote>
                    </p>
                    <p>After 6 short years, I came to love and appreciate all of the above. </p>
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