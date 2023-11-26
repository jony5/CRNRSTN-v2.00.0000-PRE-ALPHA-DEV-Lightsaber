<?php
	session_start();
	include_once("./root.inc.php");
	include_once("$ROOT/config.inc.php");
	
	header("Location: $ROOT/work/highlights/");
	exit();

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<?php
include_once("$ROOT/common/includes/meta/meta.inc.php");
?>

<title>J5 :: WORK</title>
<link rel="stylesheet" href="<?php echo $ROOT; ?>/common/css/theme/dark/main.css" type="text/css" />
<script type="text/javascript" language="javascript" src="<?php echo $ROOT; ?>/common/js/lib/frameworks/prototype/1.7/prototype.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo $ROOT; ?>/common/js/analytics/google/google.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo $ROOT; ?>/common/js/main.js"></script>
</head>

<body>
<div class="cb_5"></div>
<div id="page_wrapper">
	<!-- HEADER -->
    <?php
	include_once("$ROOT/common/includes/header/header.inc.php");
	?>
    
    <!-- MAIN CONTENT -->
    <div id="main_content_wrapper">
        <div class="cb"></div>
    	<div id="main_content_title">:: WORK</div>
        <div class="cb"></div>
        
        <div id="primary_tab_wrapper">
        	<div class="cb_10"></div>
        	<div id="tab_pane_0" class="<?php if($TAB_TARGET==''){echo $TAB_LNK_CLASS['active'];}else{echo $TAB_LNK_CLASS['inactive'];} ?>" onClick="tabVisibility('0','4')"><a href="#" target="_self">Highlights</a></div>
            <div id="tab_pane_1" class="<?php if($TAB_TARGET=='1'){echo $TAB_LNK_CLASS['active'];}else{echo $TAB_LNK_CLASS['inactive'];} ?>"><a href="#" target="_self" onClick="tabVisibility('1','4')">Experience</a></div>
            <div id="tab_pane_2" class="<?php if($TAB_TARGET=='2'){echo $TAB_LNK_CLASS['active'];}else{echo $TAB_LNK_CLASS['inactive'];} ?>"><a href="#" target="_self" onClick="tabVisibility('2','4')">Skills</a></div>
            <div id="tab_pane_3" class="<?php if($TAB_TARGET=='3'){echo $TAB_LNK_CLASS['active'];}else{echo $TAB_LNK_CLASS['inactive'];} ?>"><a href="#" target="_self" onClick="tabVisibility('3','4')">Resume</a></div>
        </div>

        <div id="primary_content">
         	 <ul class="tab_area_wrapper">
             	<li id="tab_pane_wrapper_0" class="<?php if($TAB_TARGET==''){echo $TAB_PANE_CLASS['active'];}else{echo $TAB_PANE_CLASS['inactive'];} ?>">
                    <div class="tab_pane_col_wrapper">
                    	<div class="col_wrapper">
                            <div class="tab_pane_l_col_wrapper">
                                <div class="copy_sub_title">Eagle Scout &amp; Vigil Honor</div>
                                <div class="copy">
                                I was privileged to have an opportunity to participate in both the Cub Scout and Boy Scout programs as a youth. I still remember the fear and 
                                nervousness I experienced while walking up the Norcross Elementary school bus zone to the cafeteria where Mr. Ebert was standing at the door 
                                welcoming inquisitive parents and youth. I would be starting out as a first year Webelos.
                                
                                <br /><br />About 7 years later, Mr. Means was awarding me with the Eagle Scout Badge. About 1.5 years later I would receive the Vigil Honor 
                                from my fellow brothers in scouting. The experiences and relationships formed while serving with those guys will stay with me for the rest of my life.
                                
                                <br /><br />Eagle Scout Award :: 1/11/1998
                                <br />Vigil Honor - Order of the Arrow :: 6/10/1999
                                
                                </div>
                                
                                
                                <div class="copy_sub_title">Launch of the iPhone for Verizon Wireless</div>
                                <div class="copy">
                                The first week of the first quarter of 2010, was legendary in the south for several reasons. First it was the snow storm and freeze over that shut the city of Atlanta down. Then it was a small team at Moxie putting all of the finishing touches on the largest device launch in the history of Verizon Wireless...the iPhone.
								
                                <br /><br />In the days leading up to the Jan. 7th launch, I found my dog and myself alone on the roads and alone in the office for 14hr days. It was like something out of I Am Legend with Will Smith and his dog. We were the only 2 life forms (excluding rodents) at the entire business complex for 2 days (M/T). A couple of people came in on the 3rd day(W), and a few more on (TH). The office was basically shut down for the entire week. The iPhone dropped that Thursday, I was still wiring up the analytics integration piece a day prior...and Apple did not provide us with the actual creative until last minute...something like midnight of the night prior to the launch (about 10 hours before launch) I think.
                                
                                <br /><br />I had my own coffee pot that I dragged into my office with my dog, and pretty much was answering the phone and coding non-stop the entire time. We did something like 1MM impressions in the first 24hrs. My indexing on the secondary (backup) data capture table was turned off...so it took some time to debug that and wait for the buffers to get caught back up (imagine traffic/data capture #'s that were way low and not aligning to the analytics for about half a day...annoying to say the least).
                                
                                <br /><br />It was a great experience. 
                                
                                </div>
                                
                                
                                <div class="copy_sub_title">Rogue applications put food on the table</div>
                                <div class="copy">
                                &quot;Rogue application&quot; (when talking corporate talk) is the term used by the technological majority when speaking to non-techie people to cast a less than 
                                positive light on what is perceived to be a technology subculture. 
                                
                                <div class="copy_section_title">Barriers to entry</div>
                                Rogue applications are riskier to build because there is no (allocated) funding; you do it on your own time (and personally eat the 
                                costs) or you don't do it at all. And just in case you think that it's all development...and you're easy sailing check the risks out below. 
                                
                                <br /><br />Yes some of these have happened to me ::
                                <br />
                                <ul>
                                	<li>Security policies can be changed...making your project explicitly illegal or worse...functionally broken...before the services hit production. It can be risky to 
                                    openly stir up interest in your dark project while still in alpha or especially concepting. I'd hate to have to re-architect a critical piece of some application 
                                    (in my spare time) due to some networking firewalls that just seemed to appear out of nowhere.</li>
                                	<li>Upper mgmt could get ideas and decide to reallocate your project to another internal team (that could shelf the project indefinitely) or send it to an outside 3rd party. 
                                    Either way, you just failed.</li>
                                	<li>You lose the client, project or business for which you were building that kitchen sink.</li>
                                	<li>You get fired before launch.</li>
                                	<li>And if you're successful and THEN application turns out to have significant design flaws...or whatever...<strong>that shit is on your shoulders</strong>. Don't expect to 
                                    get bailed out by corp. resources...which would have never been allocated for your unapproved project to begin with. Now you and your client may be worse off than before...well, 
                                    definitely you...  ^_^</li>
                                </ul>
                                
                                <div class="copy_section_title">General rule of thumb</div>
                                This isn't about alienating folks, being unsportsmanlike or engaging mean spirited competition; it's about getting the best tools for the job into the hands of the people that need 
                                it the most. But even still..rogue applications can make people who are following the rules (read as the de-facto status quo) look/feel like they are being less productive, 
                                and this may cause unnecessary concern & aggression. Extreme care must be exercised at every stage...especially when introducing such tools to the general population. 
                                
                                <br /><br />Typically, I recommend starting with the most important stakeholders (the client...or...your boss) and then working your way down. 
                                Depending on the sensitivity of the project, one may not want to risk telling more savvy individuals
                                who would perhaps understand the implications; let your the stakeholders boast in the tool for you...after it is safely in production.
                                
                                </div>
                                
                                <div class="cb_20"></div>
                            </div>
                        </div>
                        <div class="col_wrapper">
                            <div class="tab_pane_r_col_wrapper">
                                <div class="copy_sub_title">An engine for my Jeep</div>
                                <div class="copy">
                                One of my Eagle Scout/Vigil brothers, Tim.S and I decided to go Jeeping in Buford, GA. The result of that July 4th escapade left me stuck up to my door in mud water and Tim was late for work. His dad, Joe.S, had the guts to drive another Jeep into the marsh to come save my ass. 
								
                                <br /><br />We drove all the trucks out, and Joe.S even pulled another stranded Jeeper out on the way back. My Jeep felt like the motor was about to fall apart..as the oil viscosity was ruined by river water that had soaked up my intake air filter and no doubt has made its way into the bowels of my motor. 
                                <br /><br />The Jeep needed a new engine, and I didn't have $2K to drop. 
                                <br /><br />Subsequently, my first major credit card purchase was a $1600 straight-six motor from Advanced Auto Parts ($300 core charge). During this time, I was in the middle of taking courses at DeKalb Community College; my boss at Digitrax got a call from the credit card company immediately on the next day.  ^_^
                                
                                <br /><br />I learned the value of a good lab book from my Chemistry Lab class at DeKalb College. And so I  picked up a fresh notebook and a Haynes Auto manual for the ZJ chassis and I began to write out the steps for an upcoming lab experiment.<br /><br />The removal and re-installation of a straight-six ::
                                <blockquote>
                                <ul>
                                    <li>I wrote out the steps...starting with..unplug the battery.</li>
                                    <li>Looking at the entire job on paper...I purchased all parts and tools that would be needed. An Eagle Scout Vigil brother of mine (Mike.Z) still has my engine stand.</li>
                                    <li>In weekend #1, I removed the motor. </li>
                                    <li>I had a full week to rebuild the new motor...prepping it for insertion. There's no better feeling like being able to walk around a motor (full access) after you've spent hours working on it within the vehicle.</li>
                                    <li>In weekend #2, I reinstalled a freshly rebuilt block.</li>
                                </ul>
                                </blockquote>
                                <br />I was quoted at $2000 for the entire job by a local shop. I think I saved about $500 doing the gig myself.
                                <br /><br />Interestingly enough...I had no parts left over, but the Jeep wouldn't start the first time I tried cranking it. I towed it to the local Pepboys in Norcross and asked one of my mechanic friends if they had a second to listen to me turn the motor over.
                                <br /><br />They suggested I turn my distributor 180 degrees as it seemed none of the sparks were lining up. He even went and pulled out one of his own wrenches for me to perform the 3min task.
                                <br /><br />It started up immediately and the motor and straight exhaust dump at the Borla header sounded like something fierce. The mechanic eyes got big and he quickly asked me if I had put oil in the new motor.  ^_^
                                
                                </div>
                                
                                <div class="copy_sub_title">Going dark to fight for my team</div>
                                <div class="copy">
                                Throughout the normal and lengthy course of my career in agency, I watched many clients, projects and people come and go as the seasons and business quarters rolled on. When things 
                                started to get a little rough (indicated by higher than usual employee churn), I kept my ear to the ground looking for any potential opportunities that may arise to try to create 
                                some stability for the team that I was working with. It is worth noting that I had been working with the people on that business team for as long as I had been with Moxie.
								
                                <br /><br />That opportunity came towards the front side of 2011 with the prospect of a new real-time messaging service that would tie into the data warehouse of one of our 
                                largest clients. The project was correctly rejected according to standard operating procedures by the in-house services development team due to the crazy timeline (something like 2 weeks for delivery). 
                                I was asked to stand up a temporary stop-gap until we had solid resources and such so they could properly task the project with a senior developer. 
                                
                                <br /><br />As the solutions engineer at Moxie, I was more than happy to provide a solution for the situation at hand. Through the course of casual conversation, it had became apparent to 
                                myself (and at least one more person) that this one project could very easily turn into a functional monopoly on ALL transactional messaging (maybe around +400MM a month). 
                                A casual solution was NOT what we needed. We needed something that was more top shelf, and I was up for the challenge.
                                
                                <br /><br />I agreed to stand up the &quot;stop-gap&quot; web service, and didn't make a big deal about it. 
                                It was my goal to build the project tight enough to keep the train on the tracks. There would be plenty of eyeballs looking to fault this hot little open source ROI driver for the slightest defect.
                                
                                <br /><br />There were several layers to the plan. Knowing that at any moment the project could have been axed or taken away from me...I had to go dark (need to know basis only) on the following ::
                                
                                <ul>
                                <li>Establishment of a bullet-proof and enterprise grade PHP class library that the small group of PHP developers could begin to leverage (and contribute to) for their PHP projects. Call it an 
                                open source community kick-off...or something. Due to the fact that the agency was a traditional .NET shop, there were fewer internal resources devoted to my technology. Before PHP could play with the 
                                big boys...we needed bigger guns!</li>
                                
                                <li>The class library would also serve as the jump point for a much needed redesign of my teams portal/creative extranet...which was bursting at the 
                                architectural seams from the years of duct tape + changes in business process. That portal was a very successful rogue application from 2008 that was in it's 4th year of production; long overdue for an architectural revamp.</li>
                                
                                <li>Development of a custom web service that would both meet the current client's needs as well as  scale with the growth of the business. This included planning for functionality 
                                that was not requested by the client (such as the mobile alerts real-time messaging). The service would need to be built according the following standards (that I made up on the fly) ::
                                <blockquote>
                                <ul>
                                	<li>full transparency enabled by advanced error notifications/bubbling, logging at the component level and intelligent integrations with the 3rd party email messaging tool (Responsys)</li>
                                	<li>100% OOP (and super super tight) coded with comments and according to best practices (don't be lazy...or evil)</li>
                                	<li>data architecture - optimized for batch processing (this app needs to be screaming)</li>
                                </ul>
                                </blockquote></li>
                                <li>A business plan for implementation and roll out of the service. I didn't put this plan together until after I made my &quot;This_Is_What_We_Are_Aiming_To_Do_Any_Questions?&quot; presentation to the expanded tech team. It included...among other things...a request for a marginalized 25% raise for everyone that supported my teams business.</li>
                                </ul>
                                
                                <br />By the end of the project, I would no doubt have been able to to carve out some new business as well as permanently solidify the production worthiness of open source community supported technologies at the company.
                                
                                <br /><br />I got the boot prior to being able to execute on the business plan, but the service and PHP class libraries were successfully completed.
                                
                                </div>
                                
                                
                                <div class="cb_20"></div>
                            </div>
                        </div>
                    </div>
                
                
                <div class="cb"></div>
                </li>
                
                
                
             	<li id="tab_pane_wrapper_1" class="<?php if($TAB_TARGET=='1'){echo $TAB_PANE_CLASS['active'];}else{echo $TAB_PANE_CLASS['inactive'];} ?>">
                	<div class="tab_pane_col_wrapper">
                    	<div class="col_wrapper">
                            <div class="tab_pane_l_col_wrapper">
                                
                                <div class="copy_sub_title">Agency</div>
                                <div class="copy_job_title">Solutions Engineer, Moxie
                                <span class="copy_citydate_title">Atlanta, GA [May 2006-Feb 2012]</span></div>
                                <div class="copy">As our team expanded from 4 people to +25, I applied technology in creative ways to streamline team process, 
                                improve the quality of our agency services and remove bottlenecks. I also supported various internal agency 
                                projects, and these allowed me to test the suitability of technical concepts and theories for use in the public space.</div>
                                
                                <div class="copy_sub_title">Contracting</div>
                                <div class="copy_job_title">Technical Contractor, Technisource
                                <span class="copy_citydate_title">Atlanta, GA [Jan 2006-May 2006]</span></div>
                                <div class="copy">As the primary technical resource for the growing email marketing services team, I developed web based 
                                tools (LAMP) to improve quality control and streamline QA processes. As a result, the higher quality deliverables, 
                                I was fixing fewer bugs; this gave me more time to focus on other technical projects (for other clients) within the agency.</div>
                                
                                <div class="cb_20"></div>
                            </div>
                        </div>
                        <div class="col_wrapper">
                            <div class="tab_pane_r_col_wrapper">
                            	<div class="copy_sub_title">Infrastructure and Tech Support</div>
                                <div class="copy_job_title">IT, First Discount Mortgage
                                <span class="copy_citydate_title">Atlanta, GA [Aug 2005-Dec 2005]</span></div>
                                <div class="copy">Replacing an IT team of 2 people, I was primarily responsible for end user tech support and service. I also managed updates to their hosted web services.</div>
                                
                                <div class="copy_sub_title">Startup</div>
                                <div class="copy_job_title">Lead Developer, CommercialNet, Inc.
                                <span class="copy_citydate_title">Norcross, GA [Oct 2004-Aug 2005]</div>
                                <div class="copy">A coffee shop startup...I was the lead developer for the account management, payment authorization and product delivery web services.</div>
                                
                                <div class="cb_20"></div>
                            </div>
                        </div>
                    </div>
                    <div class="cb"></div>
                </li>
                
                
                <li id="tab_pane_wrapper_2" class="<?php if($TAB_TARGET=='2'){echo $TAB_PANE_CLASS['active'];}else{echo $TAB_PANE_CLASS['inactive'];} ?>">
                    <div class="tab_pane_col_wrapper">
                    	<div class="col_wrapper">
                            <div class="tab_pane_l_col_wrapper">
                            	<div class="copy_sub_title">Business</div>
                                <div class="copy">
                                <ul style="margin-top:0px;">
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
                                    <li>front end development</li>
                                    <li>rapid prototyping</li>
                                    <li>user administration</li>
                                    <li>content distribution network administration</li>
                                    <li>MySQL database administration</li>
                                    <li>Computer (Mac/PC) diagnostics and repair</li>
                                    <li>Logistics/planning for activities with large groups of people</li>
                                    <li>brewing coffee</li>
                                </ul>
                                </div>
                                
                                <div class="cb_20"></div>
                            </div>
                        </div>
                        <div class="col_wrapper">
                            <div class="tab_pane_r_col_wrapper">
                                <div class="copy_sub_title">Computers &amp; Electronics</div>
                                <div class="copy">No, I will not fix your computer  :)</div>
                                <div class="copy_sub_title">People</div>
                                <div class="copy">I have people skills!</div>
                                
                                <div class="copy_sub_title">Animals &amp; the Outdoors</div>
                                <div class="copy">I enjoy animals an the outdoors. If I can mix them both with work...e.g. putting a presentation together from the comfort of a 
                                sunny patio or coding in a courtyard...all the better! As an Eagle Scout and Vigil honor brother in the Order of the Arrow, the connection that I 
                                have to the outdoors is respected, but I don't over do it. I've spent more than my fare share of time in the woods on official BSA organizational business.  ^_^</div>
                                
                                <div class="copy_sub_title">Mechanized Systems</div>
                                <div class="copy">Does the contraption you're holding there have it's own mechanical system of operation? Can I see that when you get a sec?</div>
                                
                               
                                
                                <div class="cb_20"></div>
                            </div>
                        </div>
                    </div>
                
                
                <div class="cb"></div>
                </li>
                
                <li id="tab_pane_wrapper_3" class="<?php if($TAB_TARGET=='3'){echo $TAB_PANE_CLASS['active'];}else{echo $TAB_PANE_CLASS['inactive'];} ?>">
                	<div class="tab_pane_col_wrapper">
                    	<div class="col_wrapper">
                            <div class="tab_pane_l_col_wrapper">
                                <div class="copy_sub_title">Profile</div>
                                <div class="copy">With 6 years of solid agency experience (+8 years of programming experience) behind me, I am looking for a fresh 
                                opportunity to join an active, growing and digitally fueled company to strengthen and broaden the technical aspects of their service 
                                offerings. For my previous employer, I worked with corporate clients to formulate and execute (with my own bare hands when necessary) 
                                multi-channel business marketing initiatives. Strategy and execution are my core competencies.</div>
                                
                                <div class="copy_sub_title">Experience</div>
                                <div class="copy_job_title">Solutions Engineer, Moxie
                                <span class="copy_citydate_title">Atlanta, GA [May 2006-Feb 2012]</span></div>
                                <div class="copy">As our team expanded from 4 people to +25, I applied technology in creative ways to streamline team process, 
                                improve the quality of our agency services and remove bottlenecks. I also supported various internal agency 
                                projects, and these allowed me to test the suitability of technical concepts and theories for use in the public space.</div>
                                
                                <div class="copy_job_title">Technical Contractor, Technisource
                                <span class="copy_citydate_title">Atlanta, GA [Jan 2006-May 2006]</span></div>
                                <div class="copy">As the primary technical resource for the growing email marketing services team, I developed web based 
                                tools (LAMP) to improve quality control and streamline QA processes. As a result, the higher quality deliverables, 
                                I was fixing fewer bugs; this gave me more time to focus on other technical projects (for other clients) within the agency.</div>
                                
                                <div class="cb_20"></div>
                            </div>
                        </div>
                        <div class="col_wrapper">
                            <div class="tab_pane_r_col_wrapper">
                            	<div class="cb_35"></div>
                                <div class="copy_job_title">IT, First Discount Mortgage
                                <span class="copy_citydate_title">Atlanta, GA [Aug 2005-Dec 2005]</span></div>
                                <div class="copy">Replacing an IT team of 2 people, I was primarily responsible for end user tech support and service. I also managed updates to their hosted web services.</div>
                                
                                <div class="copy_job_title">Lead Developer, CommercialNet, Inc.
                                <span class="copy_citydate_title">Norcross, GA [Oct 2004-Aug 2005]</div>
                                <div class="copy">A coffee shop startup...I was the lead developer for the account management, payment authorization and product delivery web services.</div>
                                
                                <div class="copy_sub_title">Education</div>
                                <div class="copy">Georgia State University, Atlanta GA &ndash; Computer Information Systems, 2004</div>
                                
                                <div class="copy_sub_title">Skills/Consulting</div>
                                <div class="copy">frontend/backend web/services development, web application architecture, email marketing &amp; data mining, database 
                                (MySQL) administration, reporting &amp; analytics integrations, integrations with social networking</div>
                                
                                <div class="copy_sub_title">Languages, Technologies, Formats and Platforms</div>
                                <div class="copy">LAMP stack, HTML, CSS, JavaScript, AJAX, XML, JSON, CS5, MS Office Suite, Mac, Windows</div>
                                
                                <div class="cb_20"></div>
                                <div class="copy"><a href="http://www.jony5.com/downloads/resume/jharris_resume.pdf" target="_blank">Click here</a> to download.</div>
                                <div class="cb_20"></div>
                            </div>
                        </div>
                    </div>
                    <div class="cb"></div>
                </li>
                
             </ul>
             <div class="cb"></div>
        </div>
        
        <div class="cb_20"></div>
    </div>
    <!-- FOOTER -->
    <?php
	include_once("$ROOT/common/includes/footer/footer.inc.php");
	include_once("$ROOT/tracking/UA-2181418-7.php");
	
	?>
    
</div>
</body>
</html>