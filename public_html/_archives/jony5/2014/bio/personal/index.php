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

<title>J5 :: PERSONAL BIO</title>
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
        	<div id="tab_pane_0" class="<?php if($TAB_TARGET=='1'){echo $TAB_LNK_CLASS['active'];}else{echo $TAB_LNK_CLASS['inactive'];} ?>" ><a href="<?php echo $ROOT; ?>/bio/professional/" target="_self" onClick="tabVisibility('0','3')">Professional</a></div>
            <div id="tab_pane_1" class="<?php if($TAB_TARGET==''){echo $TAB_LNK_CLASS['active'];}else{echo $TAB_LNK_CLASS['inactive'];} ?>" onClick="tabVisibility('1','3')"><a href="#" target="_self" >Personal</a></div>
            <div id="tab_pane_2" class="<?php if($TAB_TARGET=='2'){echo $TAB_LNK_CLASS['active'];}else{echo $TAB_LNK_CLASS['inactive'];} ?>"><a href="<?php echo $ROOT; ?>/bio/heavenly/" target="_self" onClick="tabVisibility('2','3')">Heavenly</a></div>
        </div>

        <div id="primary_content">
         	 <ul class="tab_area_wrapper">
             	<li id="tab_pane_wrapper_1" class="<?php if($TAB_TARGET==''){echo $TAB_PANE_CLASS['active'];}else{echo $TAB_PANE_CLASS['inactive'];} ?>">
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