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

<title>J5 :: WORK SKILLS</title>
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
        	<div id="tab_pane_0" class="<?php if($TAB_TARGET=='0'){echo $TAB_LNK_CLASS['active'];}else{echo $TAB_LNK_CLASS['inactive'];} ?>"><a href="<?php echo $ROOT; ?>/work/highlights/" target="_self" onClick="tabVisibility('0','4')">Highlights</a></div>
            <div id="tab_pane_1" class="<?php if($TAB_TARGET=='1'){echo $TAB_LNK_CLASS['active'];}else{echo $TAB_LNK_CLASS['inactive'];} ?>"><a href="<?php echo $ROOT; ?>/work/experience/" target="_self" onClick="tabVisibility('1','4')">Experience</a></div>
            <div id="tab_pane_2" class="<?php if($TAB_TARGET==''){echo $TAB_LNK_CLASS['active'];}else{echo $TAB_LNK_CLASS['inactive'];} ?>" onClick="tabVisibility('2','4')"><a href="#" target="_self">Skills</a></div>
            <div id="tab_pane_3" class="<?php if($TAB_TARGET=='3'){echo $TAB_LNK_CLASS['active'];}else{echo $TAB_LNK_CLASS['inactive'];} ?>"><a href="<?php echo $ROOT; ?>/work/resume/" target="_self" onClick="tabVisibility('3','4')">Resume</a></div>
        </div>

        <div id="primary_content">
         	 <ul class="tab_area_wrapper">
                <li id="tab_pane_wrapper_2" class="<?php if($TAB_TARGET==''){echo $TAB_PANE_CLASS['active'];}else{echo $TAB_PANE_CLASS['inactive'];} ?>">
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