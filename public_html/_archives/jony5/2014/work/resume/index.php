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

<title>J5 :: WORK RESUME</title>
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
            <div id="tab_pane_2" class="<?php if($TAB_TARGET=='2'){echo $TAB_LNK_CLASS['active'];}else{echo $TAB_LNK_CLASS['inactive'];} ?>"><a href="<?php echo $ROOT; ?>/work/skills/" target="_self" onClick="tabVisibility('2','4')">Skills</a></div>
            <div id="tab_pane_3" class="<?php if($TAB_TARGET==''){echo $TAB_LNK_CLASS['active'];}else{echo $TAB_LNK_CLASS['inactive'];} ?>" onClick="tabVisibility('3','4')"><a href="#" target="_self">Resume</a></div>
        </div>

        <div id="primary_content">
         	 <ul class="tab_area_wrapper">
                <li id="tab_pane_wrapper_3" class="<?php if($TAB_TARGET==''){echo $TAB_PANE_CLASS['active'];}else{echo $TAB_PANE_CLASS['inactive'];} ?>">
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
                                <span class="copy_citydate_title">Norcross, GA [Oct 2004-Aug 2005]</span></div>
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