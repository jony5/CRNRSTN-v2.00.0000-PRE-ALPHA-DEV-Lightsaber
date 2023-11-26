<?php
	session_start();
	include_once("./root.inc.php");
	include_once("$ROOT/config.inc.php");
	
	header("Location: $ROOT/bio/professional/");
	exit();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<?php
include_once("$ROOT/common/includes/meta/meta.inc.php");
?>

<title>J5 :: BIO</title>
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
    	<div id="main_content_title">:: BIO</div>
        <div class="cb"></div>
        
        <div id="primary_tab_wrapper">
        	<div class="cb_10"></div>
        	<div id="tab_pane_0" class="<?php if($TAB_TARGET==''){echo $TAB_LNK_CLASS['active'];}else{echo $TAB_LNK_CLASS['inactive'];} ?>" onClick="tabVisibility('0','3')"><a href="#" target="_self">Professional</a></div>
            <div id="tab_pane_1" class="<?php if($TAB_TARGET=='1'){echo $TAB_LNK_CLASS['active'];}else{echo $TAB_LNK_CLASS['inactive'];} ?>"><a href="#" target="_self" onClick="tabVisibility('1','3')">Personal</a></div>
            <div id="tab_pane_2" class="<?php if($TAB_TARGET=='2'){echo $TAB_LNK_CLASS['active'];}else{echo $TAB_LNK_CLASS['inactive'];} ?>"><a href="#" target="_self" onClick="tabVisibility('2','3')">Heavenly</a></div>
        </div>

        <div id="primary_content">
         	 <ul class="tab_area_wrapper">
             	<li id="tab_pane_wrapper_0" class="<?php if($TAB_TARGET==''){echo $TAB_PANE_CLASS['active'];}else{echo $TAB_PANE_CLASS['inactive'];} ?>">
                    <div class="tab_pane_col_wrapper">
                    	<div class="col_wrapper">
                        	<!--<div>
                        		<div class="mini_col">
                                    <img src="<?php echo $ROOT; ?>/common/imgs/j5_00.jpg" width="240" height="180" alt="J5 - 9 weeks" title="J5" /> 
                                </div>
                                <div class="mini_col">
                                    <img src="<?php echo $ROOT; ?>/common/imgs/j5_01.jpg" width="240" height="180" alt="J5 - 1 year" title="J5" /> 
                                </div>
                                <div class="mini_col">
                                    <img src="<?php echo $ROOT; ?>/common/imgs/j5_02.jpg" width="240" height="180" alt="J5 - 2.5 years" title="J5" /> 
                                </div>  
                        
                        	</div>-->
                        	<div class="cb_5"></div>
                            <div class="tab_pane_l_col_wrapper">
                                <div class="copy">
                                <div class="copy_sub_title">Professional reflection</div>
                                While taking time to consider...in retrospect...the succession of 'career influencing' decisions that 1) have been made within the course of a span of time and 2) have been deemed as a dominant gene in creating the character of the bearer, the dynamically interwoven nature of the stream of circumstances surrounding each decision almost prove to be more important than the string of decisions that connected the sometimes disjointed circumstances. In retrospect, seemingly insignificant decisions made on a day-to-day basis ultimately have broader implications as it relates to making us who we are today. 
                                
                                <br /><br />In so far as I would like to consider myself a business professional, here are a few of the decisions and circumstances that have helped to make me who I am...professionally. 
                                
                                <br /><br /><div class="copy_sub_title">Invest in yourself...first</div>
                                I went into debt early in life. First a motor; then a laptop. The laptop has put more food on the table than the motor. That was the first lesson I came to appreciate; cars don't feed people.
                                
                                <br /><br />Another lesson to be had...don't get into car$ unless you have a laptop. 
                                
                                <br /><br /><div class="copy_sub_title">Believe in your own ideas...as much as you do others'</div>
                                A few years after college, I began work on an idea for a new web service for real estate agents. This idea would later materialize as a startup company called CommercialNet, Inc. If you're reading this, I'm probably still paying bills from this endeavor, but the lessons learned have been invaluable. 
                                
                                <br /><br />I use the word invaluable...because it helps me to feel better about the credit cards that were maxed out towards the end of my work with the bootstrap. I say this tongue-in-cheek because I can't ignore the fact that it was a fraction of the cost of a semester at Emory, and I walked away with ideas, some coding skillz and wall-street smarts...all of which were empowering.
                                
                                <br /><br /><div class="copy_sub_title">Cheerfully serve others</div>
                                After a brief IT assignment with a local Atlanta mortgage company,...I'd like to make this statement for anyone who is thinking about entering the tech support world for the first time ::
								
                                <blockquote>Even though one may be able to keep his/her own tech gear in good working order...one does not really know tech support until required (as a side job) to provide corporate IT support at least 30 other people...in different cities...with nothing but 1) your personal laptop, 2) personal cellphone, 3) bluetooth ear piece found under a chair at the food court of Lenox Mall and a 4) team of yourself...and...GO!</blockquote>
                                
                                <br />The earpiece turned out to be invaluable; try doing tech support for 10hrs a day with your mobile + laptop without one. ^_^ 
                                
                                
                				</div>
                                
                                <div class="cb_20"></div>
                            </div>
                        </div>
                        <div class="col_wrapper">
                            <div class="tab_pane_r_col_wrapper">
                            	<div class="cb_30"></div>
                                <div class="copy">
                                Ultimately, things didn't work out as well as I wanted at First Discount (mortgage company), but I gave it my best shot. And then again, it actually worked out really well, in hindsight, due to the many and varied experiences gained supporting financial contractors (the end users) for several intense months. This would become a cornerstone in agency.
                				
                                <br /><br /><div class="copy_sub_title">Never stop learning</div>
                                By the time I arrived at the front door of agency, I had worked on several initiatives with several corps and individuals with &quot;varying degrees of reliability&quot; in core areas of what one would consider &quot;business competence&quot;. Through all of these experiences, I learned how to put food on the companies table...please read as &quot;everyone's table&quot;...via making smart tactical moves towards multiple business objectives.
                                
                                
                                <br /><br />The top 3 most shocking things to me at agency in my first week...from least to most shocking :: 
                                <ul>
                                <li>There was a free juice and beer fridge...both free as in F.R.E.E.</li>
                                
                                <li>I had the refreshing opportunity to work with a heavily expanded technical team that included men and women from all walks of life. The Moxie team was much larger than the team of one or two at First Discount Mortgage...or the product services team of about (5) at CommercialNet. This was a very refreshing change of scenery, and there was room for me to setup shop.</li>
                                
                                <li>All the people were leaving at five or six o'clock regardless of whether or not the project was completed. I mean, they were effectively putting off for tomorrow that which could probably have been completed by 11PM...or even 2AM...in that very same night...right?!? And check this out...they took lunch breaks too! In the words of a good friend of mine...now that's crazy talk.</li>
                                </ul>
                                <br />After 6 short years, I came to love and appreciate all of the above.
                                </div>
                                
                                <div class="cb_20"></div>
                            </div>
                        </div>
                    </div>
                
                <div class="cb_20"></div>
                
                </li>
             	<li id="tab_pane_wrapper_1" class="<?php if($TAB_TARGET=='1'){echo $TAB_PANE_CLASS['active'];}else{echo $TAB_PANE_CLASS['inactive'];} ?>">
                <div class="tab_pane_col_wrapper">
                    	<div class="col_wrapper">
                            <div class="tab_pane_l_col_wrapper">
                                <div class="copy">
                                <div class="copy_sub_title">Personal reflection</div>
                                It is often said that going into business is akin to going into a relationship. And that these relationships are made (and broken) on a semi-regular bases by the average adult as they go through the normal course of their professional life. That being the case, certain professional qualities can be enhanced or rounded out via the application of a softer and more personal lens.

                                <br /><br /><div class="copy_sub_title">Loyalty to others through service</div>
                                For example, knowing that I am a Vigil Honor Eagle in the Order of the Arrow and that, together with my fellow brothers, we served the local troops, chapters, lodges, and councils in order to make scouting what it is for so many other boys. This knowledge alone carries some powerful perspective when juxtaposed against my renewed support for the boys via participation in a mentoring program collaboration between agency and community. In the latter program, I was perfectly happy to join an existing effort that was both started and lead by others. The boys would receive benefit either way.
                                
                                <br /><br />In fact, most of my personal and business values relating to service, loyalty and other aspects of my relationships with others can be prescribed summarily to the Oath and Law that all Boy Scouts memorize as part of their earliest requirements ::
                                <blockquote>
                                The Scout Oath<br />
                                On my honor, I will do my best to do my duty to God and my county.<br />
                                To obey The Scout Law. To help other people at all times. To keep myself physically strong, mentally awake and morally straight.
                                <br /><br />
                                The Scout Law (for which The Scout Oath was taken)<br />
                                A scout is trustworthy, loyal, helpful, friendly, courteous, kind, obedient, cheerful, thrifty, brave, clean and reverent.
                                </blockquote>
                                
                				</div>
                                
                                <div class="cb_20"></div>
                            </div>
                        </div>
                        <div class="col_wrapper">
                            <div class="tab_pane_r_col_wrapper">
                                <div class="copy">
                                <div class="copy_sub_title">Spare the rod; spoil the child</div>
                                Lessons are easier, cheaper and safer to learn while still a child at home. A child that is forced to reply upon society at large for some of the earliest and most basic of lessons 
                                may not thoroughly and intrinsically know them...if at all. Taking remedial courses as an adult can be costly...but rest assured that society will have expected that you have a solid grasp by adulthood.
                                
                                <br /><br />I grew up in a household of seven; my parents are still together to this day. My dad's deep military, manufacturing and farming background made for ample opportunities for me to receive a variety lessons from him throughout almost every stage of my life. 
                                
                                <br /><br />Early in my life, these lessons were disproportionately skewed towards punitive (respect my authority :: don't kick your brother) when compared to other more practical lessons (this is how you tie your shoe). The ratio would eventually flip until...by the time of high school...lessons from my parents were mostly practical in nature. My folks are still giving me lessons to this day...usually via my application of hindsight...but always practical.
                                
                                <br /><br /><div class="copy_sub_title">Respect people; do not be a respecter of persons</div>
                                I cannot begin to express how this one principle has simplified and streamlined the decision making process in my professional career.
                                In business, bias can skew your decision making abilities. A business decision should be weighed on a scale that consistently applies a similar (and relevant) set of metrics to the other options. 
                                
                                </div>
                                
                                <div class="cb_20"></div>
                            </div>
                        </div>
                    </div>
                    <div class="cb_20"></div></li>
                <li id="tab_pane_wrapper_2" class="<?php if($TAB_TARGET=='2'){echo $TAB_PANE_CLASS['active'];}else{echo $TAB_PANE_CLASS['inactive'];} ?>">
                
                <div class="tab_pane_col_wrapper">
                    	<div class="col_wrapper">
                            <div class="tab_pane_l_col_wrapper">
                                <div class="copy">
                                <div class="copy_sub_title">Born into sin; freed through Christ to serve</div>
								While the Bible tells me that I am a sinner...born into this world wholly in sin...and destined to die according to God's righteousness because of the 
                                sin that dwells in me, I equally believe the good news also spoken by God through His Word that He sent His own Son in the likeness of the flesh of sin 
                                to die in my place. Thus the Lord Jesus...having taken my place on the tree...has henceforth satisfied God's righteous requirement under the law; through 
                                faith (not works), <strong>I am freed in Christ Jesus from the law of sin and of death. Amen!</strong>
                                
                                <br /><br />It was this law of sin and of death that was preventing me from coming forward to God. Now that sin and death have been abolished in Jesus Christ, 
                                I have access to God through my spirit. It is my very faith in the power and effectiveness of the Lord's death that has freed me; there is nothing I can physically 
                                do (apart from this faith) to gain redemption through Christ to God.
                                
                                
                                <br /><br />The way is through faith. The Christian life is a life lived through faith in Christ and unto God.
                                
                                <br /><br /><div class="copy_sub_title">Saved through faith in Christ; not saved by works</div>
                                An unbeliever need do absolutely nothing except 1) believe that they are a sinner destined to die based on the righteous requirement of God's law and 2) 
                                having a little faith (faith even as small as a mustard seed) that Jesus Christ has fulfilled this requirement by dying an all inclusive death (once for all), and 
                                instantly God will apply His Son's death to that individual's account; God will infuse Himself as life through His Spirit into their human spirit (regeneration). 
                                This is what it means to be born anew, born again or to receive Salvation, and this is a divine fact. Salvation is a person...the very Jesus Himself. Whoever calls 
                                upon the name of the Lord shall be saved! 
                                
                                
                                <br /><br />Then through baptism, that brother or sister would be making a declaration to the entire universe that they are dead to the world (being buried under the water)...and henceforth and forevermore are alive to Christ (being raised up out of the death waters)! Amen!
                                
                				</div>
                                
                                <div class="cb_20"></div>
                            </div>
                        </div>
                        <div class="col_wrapper">
                            <div class="tab_pane_r_col_wrapper">
                                <div class="copy">
                                <div class="copy_sub_title">The Christian dress code is...don't ask me; YOU ask the Lord about tying on those shoes</div>
                                It may be necessary for man to create dress codes and codes of conduct so that persons may occupy and execute the responsibilities of specific offices properly. 
                                
                                <br /><br />But before God (and according to the New Testament ministry of the apostles)...it is not so with His children. For example, a child of God wearing a crew-cut hair style 
                                would be just as likely to receive an instant Word from the Lord as if they were wearing a mo-hawk, pig-tails, pony-tail, mullet, bald(ing) or dread-locks...so long as 
                                they were walking in oneness with the Lord. <strong>Each believer should look to the Lord for His leading on what to wear, where to go, what and when to eat...trusting that the 
                                Lord will cover their decision under His precious blood.</strong>
                                
                                <br /><br />The Lord will let them know if He is not comfortable...as they themselves won't be comfortable. And that 
                                interaction needs to happen between each individual believer and the Lord Himself. I have no business trying to mediate for that brother or sister to their face. 
                                <strong>Why should I rob them of that faith & relationship building experience with the Lord?</strong> And likewise, I also must take all matters to the Lord in private. May the Lord 
                                gain what He is after in each of us.
                                
                                <br /><br />God has no dress code, no behavior code and no relationships-with-people code that one can apply systematically to improve their chances (or their kids chances) 
                                at gaining salvation through Christ and growing in life unto maturity. Religion has dress codes, religion has behavior codes and religion defines for us the social pariahs. 
                                These man made laws promise to help the Children of God attain to some higher level of holiness or Christian expression, but in reality they end up preventing Believers from 
                                cultivating a meaningful relationship with the dear Lord Jesus...<strong>and this stunts their growth and maturity in the divine life.</strong>
                                
                                <br /><br />Such a relationship should be personal, intimate and fresh all the time. The Lord wants to be active in every decision that His children make at every moment of 
                                every day. Isn't this awesome!?!
                                	
                                </div>
                                
                                <div class="cb_20"></div>
                            </div>
                        </div>
                    </div>
                    <div class="cb_20"></div>
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