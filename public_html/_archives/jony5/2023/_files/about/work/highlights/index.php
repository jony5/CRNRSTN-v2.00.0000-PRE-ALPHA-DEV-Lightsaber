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
    		<div class="vert_nav_lnk_wrapper sel">highlights</div>
            <div class="vert_nav_lnk_wrapper"><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>about/work/experience/" target="_self">experience</a></div>
            <div class="vert_nav_lnk_wrapper"><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>about/work/skills/" target="_self">skills</a></div>
    		<div class="vert_nav_lnk_wrapper"><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>about/work/resume/?v=420" target="_self">resume</a></div>
    	</div>
    
    	<div id="content">
            <div class="content_title">Eagle Scout & Vigil Honor</div>
            <div class="content_copy">
            	<div class="col">
           			<p>I was privileged to have an opportunity to participate in both the Cub Scout and Boy Scout programs as a youth. I still remember the fear and nervousness I experienced while walking up the Norcross Elementary school bus zone to the cafeteria where Mr. Ebert was standing at the door welcoming inquisitive parents and youth. I would be starting out as a first year Webelos.</p>
                </div>
                <div class="col">
                	<p>About 7 years later, my Troop 26 scout master,...Mr. Means...was awarding me with the Eagle Scout Badge. About 1.5 years later I would receive the Vigil Honor from my fellow brothers in scouting. The experiences and relationships formed while serving with those guys will stay with me for the rest of my life.</p>
                	<p>Eagle Scout Award :: 1/11/1998<br>
               		Vigil Honor - Order of the Arrow :: 6/10/1999 </p>
                </div>
                <div class="col">
                	
                    <p><a href="http://www.scouting.org/" target="_blank"><img src="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/eagle_scout_badge.jpg" width="287" height="337" alt="National Eagle Scout Association" title="National Eagle Scout Association"></a></p>
               </div>
            </div>
            
            <div class="cb"></div>
            <div class="content_hr"></div>
            <div class="content_title">Launch of the iPhone for Verizon Wireless</div>
            <div class="content_copy">
            	<div class="col">
           			<p>The first week of the first quarter of 2010, was legendary in the south for several reasons. First it was the snow storm and freeze over that shut the city of Atlanta down. Then it was a small team at Moxie putting all of the finishing touches on the largest device launch in the history of Verizon Wireless...the iPhone.</p>
                	<p><a href="http://www.verizonwireless.com/" target="_blank"><img src="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/verizon_logo.jpg" width="295" height="184" alt="Verizon" title="Verizon"></a></p>
                </div>
                <div class="col">
                    <p>In the days leading up to the Jan. 7th launch, I found my dog and myself alone on the roads and alone in the office working 14hr days. It was like something out of the post-apocalypse <a href="https://www.youtube.com/watch?v=deEkChxiL2w" target="_blank">I Am Legend</a> movie with Will Smith and his dog. </p>
                	<p>We were the only 2 life forms (excluding rodents) at the entire business complex for 2 days (M/T). A couple of people came in on the 3rd day(W), and a few more on (TH). The office was basically shut down for the entire week. The iPhone dropped that Thursday, I was still wiring up the analytics integration piece a day prior...and Apple did not provide us with the actual creative until last minute...something like midnight of the night prior to the launch (about 10 hours before launch) I think.</p>
                </div>
                <div class="col">
                	<p>I had my own coffee pot that I dragged into my office with my dog, and pretty much was answering the phone and coding non-stop the entire time. We did something like 1MM impressions in the first 24hrs. My indexing on the secondary (backup) data capture table was turned off...so it took some time to debug that and wait for the buffers to get caught back up (imagine traffic/data capture #'s that were way low and not aligning to the analytics for about half a day...annoying to say the least).</p>
					<p>It was a great experience.</p>
               </div>
            </div>
            
            
            <div class="cb"></div>
            <div class="content_hr"></div>
            <div class="content_title">Rogue applications put food on the table</div>
            <div class="content_copy">
            	<div class="col">
           			<p>&quot;Rogue application&quot; (when talking corporate talk) is the term used by the technological majority when speaking to non-techie people to cast a less than positive light on what is perceived to be a technology subculture.</p>
                	<p><a href="http://www.ubuntu.com/" target="_blank"><img src="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/linux_icon.jpg" width="292" height="343" alt="Linux" title="Linux"></a></p>
                    <p><strong>Barriers to entry ::</strong><br>Rogue applications are riskier to build because there is no (allocated) funding; you do it on your own time (and personally eat the costs) or you don't do it at all. And just in case you think that it's all development...and you're easy sailing, check out a few of the following risks:</p>
               		
               </div>
                <div class="col">
                <p>Yes some of these have happened to me ::</p>
               		<p>
                    <ul>
                    <li>Security policies can be changed...making your project explicitly illegal or worse...functionally broken...before the services hit production. It can be risky to openly stir up interest in your dark project while still in alpha or especially concepting. I'd hate to have to re-architect a critical piece of some application (in my spare time) due to some networking firewalls that just seemed to appear out of nowhere.</li>
                    </ul>
                    </p>
                    <p>
                    <ul>
                    <li>Upper mgmt could get ideas and decide to reallocate your project to another internal team (that could shelf the project indefinitely) or send it to an outside 3rd party. Either way, you just failed.</li>
                    <li>You lose the client, project or business for which you were building that kitchen sink.</li>
                    <li>You get fired before launch.</li>
                    <li>And if you're successful and THEN application turns out to have significant design flaws...or whatever...that shit is on your shoulders. Don't expect to get bailed out by corp. resources...which would have never been allocated for your unapproved project to begin with. Now you and your client may be worse off than before...well, definitely you... ^_^</li>
                    </ul>
                    </p>
                    
                </div>
                <div class="col">
               		<p><strong>General rule of thumb</strong><br>
                    This isn't about alienating folks, being unsportsmanlike or engaging mean spirited competition;</p>
					<p>it's about getting the best tools for the job into the hands of the people that need it the most. But even still..rogue applications can make people who are following the rules (read as the de-facto status quo) look/feel like they are being less productive, and this may cause unnecessary concern & aggression. Extreme care must be exercised at every stage...especially when introducing such tools to the general population.</p>
                
                	<p>Typically, I recommend starting with the most important stakeholders (the client...or...your boss) and then working your way down. Depending on the sensitivity of the project, one may not want to risk telling more savvy individuals who would perhaps understand the implications; let your the stakeholders boast in the tool for you...after it is safely in production.</p>
               </div>
            </div>
            
            <div class="cb"></div>
            <div class="content_hr"></div>
            <div class="content_title">An engine for my Jeep</div>
            <div class="content_copy">
            	<div class="col">
               		<p>One of my Eagle Scout/Vigil brothers, Tim.S and I decided to go Jeeping in Buford, GA. The result of that July 4th escapade left me stuck up to my door in mud water and Tim was late for work. His dad, Joe.S, had the guts to drive another Jeep into the marsh to come save my ass.</p>
                    
                    <p>We drove all the trucks out, and Joe.S even pulled another stranded Jeeper out on the way back. My Jeep felt like the motor was about to fall apart..as the oil viscosity was ruined by river water that had soaked up my intake air filter and no doubt has made its way into the bowels of my motor.</p>
                    
                    <p>The Jeep needed a new engine, and I didn't have $2K to drop.</p>
                    <p><div class="embedded_image" style="width:298px;"><img src="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/jeep_norcross.jpg" width="298" height="204" alt="Jeep" title="Jeep in Norcross"></div></p>
                </div>
                <div class="col">
                    <p>Subsequently, my first major credit card purchase was a $1600 straight-six motor from Advanced Auto Parts ($300 core charge). During this time, I was in the middle of taking courses at DeKalb Community College; my boss at Digitrax got a call from the credit card company immediately on the next day. ^_^</p>
               		<p>I learned the value of a good lab book from my Chemistry Lab class at DeKalb College. And so I picked up a fresh notebook and a Haynes Auto manual for the ZJ chassis and I began to write out the steps for an upcoming lab experiment.</p>

                    <p>The removal and re-installation of a straight-six ::</p>
                    <p><ul>
                    	<li>I wrote out the steps...starting with..unplug the battery.</li>
                        <li>Looking at the entire job on paper...I purchased all parts and tools that would be needed. An Eagle Scout Vigil brother of mine (Mike.Z) still has my engine stand.</li>
                        <li>In weekend #1, I removed the motor.</li>
                        </ul>
                    </p>
                </div>
                <div class="col">
                	<p>
                    <ul>
                    	<li>I had a full week to rebuild the new motor...prepping it for insertion. There's no better feeling like being able to walk around a motor (full access) after you've spent hours working on it within the cramped vehicle engine bay.</li>
                        <li>In weekend #2, I reinstalled a freshly rebuilt block.</li>
                        
                    </ul>
                    </p>
               		<p>I was quoted at $2000 for the entire job by a local shop. I think I saved about $500 doing the gig myself.</p>
                    <p>Interestingly enough...I had no parts left over, but the Jeep wouldn't start the first time I tried cranking it. I towed it to the local Pepboys in Norcross and asked one of my mechanic friends if they had a second to listen to me turn the motor over.</p>
                    <p>They suggested I turn my distributor 180 degrees as it seemed none of the sparks were lining up. He even went and pulled out one of his own wrenches for me to perform the 3min task.</p>
                    <p>After rotating the distributor 180 degrees, it started up immediately and the motor and straight exhaust dump at the Borla header sounded like something fierce. Just at that moment, the mechanics' eyes got big and he quickly asked me if I had put oil in the new motor. ^_^ </p>
                </div>
            </div>
            
            
            <div class="cb"></div>
            <div class="content_hr"></div>
            <div class="content_title">Going dark to fight for my team</div>
            <div class="content_copy">
            	<div class="col">
           			<p>Throughout the normal and lengthy course of my career in agency, I watched many clients, projects and people come and go as the seasons and business quarters rolled on. 
                When things started to get a little rough (indicated by higher than usual employee churn), I kept my ear to the ground looking for any potential opportunities that may arise to 
                try to create some stability for the team that I was working with. It is worth noting that I had been working with the people on that business team for as long as I had been with Moxie.</p>
                
                <p>That opportunity came towards the front side of 2011 with the prospect of a new real-time messaging service that would tie into the data warehouse of one of our largest clients. 
                The project was correctly rejected according to standard operating procedures by the in-house services development team due to the crazy timeline (something like 2 weeks for delivery). 
                I was asked to stand up a temporary stop-gap until we had solid resources and such so they could properly task the project with a senior developer.</p>
                
                <p>As the solutions engineer at Moxie, I was more than happy to provide a solution for the situation at hand. Through the course of casual conversation, it had became apparent to 
                myself (and at least one more person) that this one project could very easily turn into a functional monopoly on ALL transactional messaging (maybe around +400MM a month). A casual 
                solution was NOT what we needed. We needed something that was more top shelf, and I was up for the challenge.</p>
                
                </div>
                <div class="col">
           			<p>I agreed to stand up the "stop-gap" web service, and didn't make a big deal about it. It was my goal to build the project tight enough to keep the train on the tracks. There 
                would be plenty of eyeballs looking to fault this hot little open source ROI driver for the slightest defect.</p>
                <p><div class="embedded_image" style="width:300px;"><img src="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/anonymous_mask.jpg" width="300" height="199" alt="Anonymous" title="Anonymous"></div></p>
                <p>There were several layers to the plan. Knowing that at any moment the project could have been axed or taken away from me...I had to go dark (need to know basis only) on the following ::
                <ul>
                <li>Establishment of a bullet-proof and enterprise grade PHP class library that the small group of PHP developers could begin to leverage (and contribute to) for their PHP 
                projects. Call it an open source community kick-off...or something. Due to the fact that the agency was a traditional .NET shop, there were fewer internal resources devoted 
                to my technology. Before PHP could play with the big boys...we needed bigger guns!</li>
                <li>The class library would also serve as the jump point for a much needed redesign of my teams portal/creative extranet...which was bursting at the architectural seams from 
                the years of duct tape + changes in business process. That portal was a very successful rogue application from 2008 that was in it's 4th year of production; long overdue for 
                an architectural revamp.</li>
                </ul>
                </p>
                </div>
                <div class="col">
           			<p><ul><li>Development of a custom web service that would both meet the current client's needs as well as scale with the growth of the business. This included planning for 
                functionality that was not requested by the client (such as the mobile alerts real-time messaging). The service would need to be built according the following standards 
                (that I made up on the fly) ::
                <ul>
                <li>full transparency enabled by advanced error notifications/bubbling, logging at the component level and intelligent integrations with the 3rd party email messaging tool (Responsys)</li>
                <li>100% OOP (and super super tight) coded with comments and according to best practices (don't be lazy...or evil)</li>
                <li>data architecture - optimized for batch processing (this app needs to be screaming)</li>
                <li>A business plan for implementation and roll out of the service. I didn't put this plan together until after I made my "This_Is_What_We_Are_Aiming_To_-<br>Do_Any_Questions?" 
                presentation to the expanded tech team. It included...among other things...a request for a marginalized 25% raise for everyone that supported my teams business.</li>
                </ul>
                </li>
                </ul>
                </p>
                
                <p>By the end of the project, I would no doubt have been able to to carve out some new business as well as permanently solidify the production worthiness of open 
                source community supported technologies at the company.</p>
                
                <p>I got the boot prior to being able to execute on the business plan, but the service and PHP class libraries were successfully completed.</p>
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