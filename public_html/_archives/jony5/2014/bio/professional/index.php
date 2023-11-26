<?php
	session_start();
	include_once("./root.inc.php");
	include_once("$ROOT/config.inc.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<?php
include_once("$ROOT/common/includes/meta/meta.inc.php");
?>

<title>J5 :: PROFESSIONAL BIO</title>
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
            <div id="tab_pane_1" class="<?php if($TAB_TARGET=='1'){echo $TAB_LNK_CLASS['active'];}else{echo $TAB_LNK_CLASS['inactive'];} ?>"><a href="<?php echo $ROOT; ?>/bio/personal/" target="_self" onClick="tabVisibility('1','3')">Personal</a></div>
            <div id="tab_pane_2" class="<?php if($TAB_TARGET=='2'){echo $TAB_LNK_CLASS['active'];}else{echo $TAB_LNK_CLASS['inactive'];} ?>"><a href="<?php echo $ROOT; ?>/bio/heavenly/" target="_self" onClick="tabVisibility('2','3')">Heavenly</a></div>
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