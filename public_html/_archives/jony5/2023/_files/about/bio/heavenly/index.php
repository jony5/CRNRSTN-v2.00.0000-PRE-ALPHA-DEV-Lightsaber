<?php

/* 
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
include_once($CRNRSTN_ROOT . '_crnrstn.config.inc.php');
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/session/session.inc.php');

//
// Therefore thus says Jehovah,
//   If you return, I will restore you;
// You will stand before Me;
//   And if you bring out the precious from the worthless,
// You will be as My mouth;
//   They will turn to you,
//   But you will not turn to them.
// And I will make you to this people
//   A fortified wall of bronze;
// And they will fight against you,
//   But they will not prevail against you;
// For I am with you
//   To save you and deliver you,
//   Declares Jehovah.
// And I will deliver you from the hand of the wicked
//   And redeem you from the hand of those who terrorize.
//
// - Jeremiah 15:19-21
//
// INSTANTIATE A bringer_of_the_precious_things()
$oBringer = new bringer_of_the_precious_things($oCRNRSTN_ENV);
$pfw = $precious_from_the_worthless = $oBringer->return_to_me_the_precious();

?>
<!doctype html>
<html lang="en">
<head>
<?php
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/head/head.inc.php');
?>
</head>

<body>
<!--
//
// Therefore thus says Jehovah,
//   If you return, I will restore you;
// You will stand before Me;
//   And if you bring out the precious from the worthless,
// You will be as My mouth;
//   They will turn to you,
//   But you will not turn to them.
// And I will make you to this people
//   A fortified wall of bronze;
// And they will fight against you,
//   But they will not prevail against you;
// For I am with you
//   To save you and deliver you,
//   Declares Jehovah.
// And I will deliver you from the hand of the wicked
//   And redeem you from the hand of those who terrorize.
//
// - Jeremiah 15:19-21
//
// INSTANTIATE A NEW bringer_of_the_precious_things()
-->
<div id="script_shell0">
    <div id="script_shell1">
        <div id="script_popup_wrapper">
            <div id="script_popup"  onclick="lockPopup(); return false;"></div>
            <div class="cb"></div>
        </div>
    </div>
</div>
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
    		<div class="vert_nav_lnk_wrapper"><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>about/bio/professional/" target="_self">professional</a></div>
            <div class="vert_nav_lnk_wrapper"><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>about/bio/personal/" target="_self">personal</a></div>
    		<div class="vert_nav_lnk_wrapper sel">heavenly</div>
    	</div>
    
    	<div id="content">
    		<div class="content_title">Be burning in spirit, serving the Lord (<a vvid="rom12_11" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">Rom. 12:11</a><?php echo $oBringer->seo_out('rom12_11'); ?>)</div>
            <div class="content_copy">
            	<div class="col">
           			<p>I don't think that I've taken time to talk (somewhat definitively) about why I ended up at the hospital in Q1 of 2012. That ambulance ride was not caused by the weed I habitually smoked on my lunch break (although a sample of the marijuana that I smoked was taken and I assume tested), and I was having so much fun...I can completely vouch for the complete absence of any stresses that many would probably have assumed to have been &quot;only natural&quot; with one being subjected to environmental atmospheres and stimuli the likes of which I myself have never even heard of or seen in my life.</p>
					<p>As a Christian, I was (and have been) living daily and walking moment to moment by and through the exercise of my regenerated human spirit. In the early days of the church...and under the exact same circumstances (where ones spirit is being exercised thoroughly in oneness with the Lord Spirit) the apostles were the first Christians to identify and label some tangible or tactile sensations which oftentimes accompanied that spiritual experience.</p>
            		<p>These intense sensations were new to me, and as a result of the direct leading of the Lord, I decided to make the call to go to the hospital...not knowing what I was to expect upon arriving there. </p>
                </div>
                <div class="col">
                	<p>In the back of my mind I was thinking that maybe there would be some equipment there which would shed light (in the form of data) on what was happening inside my body. When we got to the hospital, the burning sensation had become so intense, I actually considered that I was about to be raptured to be with the Lord!</p>
                	<p><img src="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/being_diagram.jpg" width="300" height="173" alt="Human Being" title="Being Diagram"></p>
                    <p>In the Holy Scriptures, these sensations are referred to as having a &quot;burning spirit&quot; (<a vvid="rom12_11" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">Rom. 12:11</a><?php echo $oBringer->seo_out('rom12_11'); ?>) or fanning your spirit &quot;into flame&quot; (<a vvid="2tim1_6" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">2 Tim. 1:6</a><?php echo $oBringer->seo_out('2tim1_6'); ?>). In these verses...and contrary to what may be held as popular belief among todays Christians...the apostles were not encouraging or describing the act of working oneself up into a state of vigorous excitement or energetic/burning zeal; they were simply, innocently and honestly expressing (from first person experience) that a strong exercise of the human spirit in oneness with the Lord Spirit is both desirable for the Lord's work and can be accompanied by a </p>
                </div>
                <div class="col">
                	<p>sensation that one could easily identify as an intense warmth...as if originating from a fire that was burning from within your inner being.</p>
                	<p>Therefore, from my experience as a believer in Christ, it is very clear that in the Bible phrases such as &quot;be burning in spirit&quot; or &quot;fan into flame the gift of God&quot; are simply transliterations of a tangible physiological phenomenon realized via bodily sensory receptors and which is a substantiation of the spiritually heighten state of ones inner being when one is in direct real-time fellowship/oneness with the Lord Jesus Christ Himself (He is the Spirit today).</p>
                	<p>Such a sensation is a DIRECT INDICATION of the real-time presence, speaking and leading of the Lord Jesus Christ as the Spirit in ones' regenerated human spirit (<a vvid="2tim1_6-8" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">2 Tim. 1:6-8</a><?php echo $oBringer->seo_out('2tim1_6-8'); ?>; <a vvid="rom12_11-12" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">Rom. 12:11-12</a><?php echo $oBringer->seo_out('rom12_11-12'); ?>; <a vvid="luke24_31-32" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">Luke 24:31-32</a><?php echo $oBringer->seo_out('luke24_31-32'); ?>; <a vvid="prov20_27" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">Proverbs 20:27</a><?php echo $oBringer->seo_out('prov20_27'); ?>, <a vvid="luke12_35" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">Luke 12:35</a><?php echo $oBringer->seo_out('luke12_35'); ?>).</p>
               		<p>All scripture is God breathed; the Lord lives! May we all be burning in spirit, saints!</p>
					<p>Amen!</p>
               </div>
            </div>
            
            <div class="cb"></div>
            <div class="content_hr"></div>
            <div class="content_title">Born into sin; freedom through Christ to serve</div>
            <div class="content_copy">
            	<div class="col">
           			<p>While the Bible tells me that I am a sinner...born into this world wholly in sin...and destined to die according to God's righteousness because of the sin that dwells in me, I equally believe the good news also spoken by God through His Word that He sent His own Son in the likeness of the flesh of sin to die in my place.</p>
                </div>
                <div class="col">
                	<p>Thus the Lord Jesus...having taken my place on the tree...has henceforth satisfied God's righteous requirement under the law; through faith (not works), <strong>I am freed in Christ Jesus from the law of sin and of death</strong>. Amen!</p>
                    <p>It was this law of sin and of death that was preventing me from coming forward to God. </p>
                </div>
                <div class="col">
                	<p>Now that sin and death have been abolished in Jesus Christ, I have access to God through my spirit. It is my very faith in the power and effectiveness of the Lord's death that has freed me; there is nothing I can physically do to gain redemption through Christ to God...to believe...faith is the only way.</p>
                	<p>The way is through faith. The Christian life is a life lived through faith in Christ and unto God. </p>
               </div>
            </div>
            
            <div class="cb"></div>
            <div class="content_hr"></div>
            <div class="content_title">Saved through faith in Christ; not saved by works</div>
            <div class="content_copy">
            	<div class="col">
           			<p>An unbeliever need do absolutely nothing except 1) believe that they are a sinner destined to perish based on the righteous requirement of God's law and 2) having a little faith (faith even as small as a mustard seed) that Jesus Christ has fulfilled this requirement by dying an all inclusive death (once for all), and instantly God will apply His Son's death to that individual's account;</p>
                </div>
                <div class="col">
                	<p>God will infuse Himself as life through His Spirit into their human spirit (regeneration). This is what it means to be born anew, born again or to receive Salvation, and this is a divine fact. It can even be said that Salvation is a person...the very Jesus Himself. Whoever calls upon the name of the Lord shall be saved!</p>
                </div>
                <div class="col">
                	<p>Then through baptism, that brother or sister would be making a declaration to the entire universe that they are dead to the world (being buried under the water)...and henceforth and forevermore are alive to Christ (being raised up out of the death waters in ressurection)! Amen! </p>
               </div>
            </div>
            
            <div class="cb"></div>
            <div class="content_hr"></div>
            <div class="content_title">The Christian dress code is...well, don't ask me; YOU ask the Lord about<br>those shoes you're tying on</div>
            <div class="content_copy">
            	<div class="col">
           			<p>It may be necessary for man to create dress codes and codes of conduct so that persons may occupy and execute the responsibilities of specific offices properly.</p>
                	<p>But before God (and according to the New Testament ministry of the apostles)...it is not so with His children. For example, a child of God wearing a crew-cut hair style would be just as likely to receive an instant Word from the Lord as if they were wearing a mo-hawk, pig-tails, pony-tail, mullet, bald(ing) or dread-locks...so long as they were walking in oneness with the Lord. </p>
                    <p><strong>Each believer should look to the Lord for His leading on what to wear, where to go, what and when to eat...trusting that the Lord will cover their decision under His precious blood.</strong></p>
                </div>
                <div class="col">
                	<p>The Lord will let them know if He is not comfortable...as they themselves won't be comfortable. And that interaction needs to happen between each individual believer and the Lord Himself. I have no business trying to mediate for that brother or sister when the Lord is right there and so readily accessible. <strong>Why should I rob them of that faith & relationship building experience with the Lord?</strong> And likewise, I also must take all matters (small and large) to the Lord in prayerful consideration. May the Lord gain what He is after in each of us.</p>
                	<p>God has no dress code, no behavior code and no relationships-with-people code that one can apply systematically to improve their chances (or their kids chances) at gaining salvation through Christ and growing in life unto maturity.</p>
                </div>
                <div class="col">
                	<p>Religion has dress codes, religion has behavior codes and religion defines for us the social pariahs. These man made laws promise to help the Children of God attain to some higher level of holiness or Christian expression, but in reality they end up preventing believers from cultivating a meaningful relationship with the dear Lord Jesus Christ...<strong>and this stunts their growth and maturity in the divine life.</strong></p>
               		<p>Such a relationship with the Lord Jesus should be personal, intimate and fresh all the time. The Lord wants to be active in every decision that His children make at every moment of every day. Isn't this awesome!?! </p>
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