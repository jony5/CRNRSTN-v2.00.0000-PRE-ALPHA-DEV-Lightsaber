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
// Saturday, June 8, 2024 @ 1211 hrs.
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
    	<div class="subnav_lnk_wrapper sel">bio</div>
        <div class="subnav_lnk_wrapper"><a href="<?php echo $tmp_http_root; ?>about/work/highlights/" target="_self">work</a></div>
        <div class="cb"></div>
    </div>

    <div class="cb_30"></div>
    <!-- PAGE CONTENT -->
    <div id="content_wrapper">
    	<div id="vert_nav_wrapper">
    		<div class="vert_nav_lnk_wrapper"><a href="<?php echo $tmp_http_root; ?>about/bio/professional/" target="_self">professional</a></div>
            <div class="vert_nav_lnk_wrapper sel">personal</div>
    		<div class="vert_nav_lnk_wrapper"><a href="<?php echo $tmp_http_root; ?>about/bio/heavenly/" target="_self">heavenly</a></div>
    	</div>
    	<div id="content">
    		<div class="content_title">Legalize It</div>
            <div class="content_copy">
            	<div class="col">
           			<p>If I was going to share a few things with you on a personal level 
                    with respect to how I live my life on a daily basis,...e.g. a list 
                    of the top three facts to know about me...one of the things that I 
                    would talk about would inevitably have something to do with 
                    marijuana. My appreciation of cannabis began to blossom in the 
                    spring of 2010, and by summer of 2011 it was as if I was living in
                    Amsterdam. The critical turning point came after being found drunk 
                    and passed out at on the grounds of my apartment complex; I then 
                    came to the conclusion (in the interest of my own health and well 
                    being) that I needed a change from my primary recreational substance 
                    (alcohol). I had had some positive casual encounters with marijuana 
                    up until that time (Q1 of 2010), and I considered putting resources 
                    behind this relatively new (to me) substance. And just like that I 
                    began budgeting myself for marijuana as my primary recreational 
                    narcotic; alcohol took a spot on the back burner.</p>

                	<p>When I began smoking marijuana in the spring of 2010, my craft 
                    was really quite crude. I would simply break off nugs of cannabis 
                    and put them in my glass for smoking.</p>

                	<p>The burn was inconsistent...depending on the density of the 
                    nugs...and it was challenging to thoroughly burn through to the 
                    center of the marijuana nugget. I was also challenged in that I 
                    wanted to take my marijuana out to public spaces for the smoking, 
                    and that meant juggling various smoking paraphernalia along with 
                    my dog, backpack and oftentimes a tasty beverage to boot...so 
                    much bagage!</p>

                </div>
                <div class="col">
                    <p>Plus if I got busted smoking in public, each peace of equipment 
                    used for smoking marijuana could garner its own citation. The more 
                    equipment you get busted with...glass, one-hit-it, on top of the 
                    actual cannabis...the more expensive that experience is going to 
                    be. I needed to optimize my smoking experience to have a smaller 
                    legal footprint and be more flexible.</p>

                    <p><a href="http://norml.org/" target="_blank"><img src="<?php echo $tmp_http_root; ?>common/imgs/Blog_Marijuana_Leaf_LEGALIZE.jpg" width="300" height="315" alt="Legalize" title="Legalize"></a></p>

                    <p>I purchased a pack of loose tobacco in Q1 of 2011 and began 
                    practicing rolling my own smoking medium. I also purchased a grinder, 
                    and by early spring of 2011, I had begun rolling joints on the fly. 
                    Note that the grinder also allowed me to pack my glass bowls more 
                    efficiently for an even and consistent burn; waay better than the 
                    cave man bust-off-a-nug-and-burn-it-method that I was 
                    previously employing.</p>

                </div>
                <div class="col">
                	<p>Now, I would simply keep rolling papers and a few grams of ground 
                    cannabis in my pocket, and whenever I felt like burning one down, 
                    I would pull out my product and roll one up. This could happen 
                    anywhere...at coffee shops, walking my dog at the park, or simply 
                    driving my car across town for some after-work relaxation. And I 
                    did a lot of driving across town as I got kicked out of my local 
                    and favorite coffee shop watering hole for smoking marijuana 
                    inside. Bummer!</p>

                    <p>I've been in the internet technology business now for 12 years 
                    (6 of  those years at Moxie, a leading digital advertising agency). 
                    If someone were to ask me what my dream job (a job done for the 
                    satisfaction and not necessarily for the money) would be, I honestly 
                    would probably lean towards getting into agriculture in the 
                    marijuana industry. There are not too many opportunities for that 
                    in Norcross, Georgia...where I live...but the legal landscape in 
                    the United States of America is changing all the time!</p>

                    <p>Oh, and if the above was one out of three things to know about 
                    me,...real quick...the second and third would be that 1) I'm an 
                    Eagle Scout in the Boy Scouts of America who has received Vigil 
                    Honors and 2) my dog is way cooler than me!</p>

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