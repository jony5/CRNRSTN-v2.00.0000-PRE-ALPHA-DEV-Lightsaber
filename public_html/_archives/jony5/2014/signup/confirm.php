<?php
	session_start();
	include_once("./root.inc.php");
	include_once("$ROOT/config.inc.php");
	$IPADDRESS=$_SERVER['REMOTE_ADDR'];
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head> 
<?php
include_once("$ROOT/common/includes/meta/meta.inc.php");
?>

<title>J5 :: SIGNUP</title>
<link rel="stylesheet" href="<?php echo $ROOT; ?>/common/css/theme/dark/main.css" type="text/css" />
<script type="text/javascript" language="javascript" src="<?php echo $ROOT; ?>/common/js/lib/frameworks/prototype/1.7/prototype.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo $ROOT; ?>/common/js/analytics/google/google.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo $ROOT; ?>/common/js/main.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo $ROOT; ?>/common/js/lib/forms/validation.js"></script>
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
    	<div id="main_content_title">:: MAILING LIST SIGNUP</div>
        <div class="cb"></div>
        
        <div id="primary_tab_wrapper">
        	<div class="cb_10"></div>
        	<div id="tab_pane_0" class="<?php if($TAB_TARGET==''){echo $TAB_LNK_CLASS['active'];}else{echo $TAB_LNK_CLASS['inactive'];} ?>" onClick="tabVisibility('0','1')"><a href="#" target="_self">Mailing List Signup</a></div>
           <!-- <div id="tab_pane_1" class="<?php if($TAB_TARGET=='1'){echo $TAB_LNK_CLASS['active'];}else{echo $TAB_LNK_CLASS['inactive'];} ?>"><a href="#" target="_self" onClick="tabVisibility('1','7')">SMS</a></div>
            <div id="tab_pane_2" class="<?php if($TAB_TARGET=='2'){echo $TAB_LNK_CLASS['active'];}else{echo $TAB_LNK_CLASS['inactive'];} ?>"><a href="#" target="_self" onClick="tabVisibility('2','7')">Post</a></div>
            <div id="tab_pane_3" class="<?php if($TAB_TARGET=='3'){echo $TAB_LNK_CLASS['active'];}else{echo $TAB_LNK_CLASS['inactive'];} ?>"><a href="#" target="_self" onClick="tabVisibility('3','7')">LinkedIn</a></div>
            <div id="tab_pane_4" class="<?php if($TAB_TARGET=='4'){echo $TAB_LNK_CLASS['active'];}else{echo $TAB_LNK_CLASS['inactive'];} ?>"><a href="#" target="_self" onClick="tabVisibility('4','7')">Facebook</a></div>
            <div id="tab_pane_5" class="<?php if($TAB_TARGET=='5'){echo $TAB_LNK_CLASS['active'];}else{echo $TAB_LNK_CLASS['inactive'];} ?>"><a href="#" target="_self" onClick="tabVisibility('5','7')">Google +</a></div>
            <div id="tab_pane_6" class="<?php if($TAB_TARGET=='6'){echo $TAB_LNK_CLASS['active'];}else{echo $TAB_LNK_CLASS['inactive'];} ?>"><a href="#" target="_self" onClick="tabVisibility('6','7')">Twitter</a></div>-->
        </div>
        
        <div id="primary_content">
         	 <ul class="tab_area_wrapper">
             	<li id="tab_pane_wrapper_0" class="<?php if($TAB_TARGET==''){echo $TAB_PANE_CLASS['active'];}else{echo $TAB_PANE_CLASS['inactive'];} ?>">
                <div style="width:400px;">
                <form action="<?php echo $ROOT; ?>/signup/action/signupsubmit.php" method="post" name="signupform" id="signupform" onsubmit="if(!validData('contactform')){return false;}else{$('contactform').submit();}">
                	
                	<table cellpadding="0" cellspacing="0" border="0" width="800">
					<tr>
					<td>
					
			
					<div class="confirmation_message" style="border-bottom:1px dotted #999999;"><div class="copy" style="padding:10px 20px 0 10px; font-size:25px;"><strong>Thanks for signing up! Your information has been received.</strong></div>
					<div class="cb_15"></div>
					</div>
		
					</td>
					</tr>
                    
                    </table>
                    <div class="cb_20"></div>
                    <div class="cb_medium"></div>
                    <div class="hidden">
                    <input name="Submit" type="submit" value="submit" />
                	</div>
            	
                </form>
                </div>
                
                <div class="cb_20"></div><div class="mailing_form_ip"><?php echo $IPADDRESS; ?></div><div class="cb"></div></li>
             	<!--<li id="tab_pane_wrapper_1" class="<?php if($TAB_TARGET=='1'){echo $TAB_PANE_CLASS['active'];}else{echo $TAB_PANE_CLASS['inactive'];} ?>">PANE2<div class="cb_300"></div></li>
                <li id="tab_pane_wrapper_2" class="<?php if($TAB_TARGET=='2'){echo $TAB_PANE_CLASS['active'];}else{echo $TAB_PANE_CLASS['inactive'];} ?>">PANE3<div class="cb_100"></div></li>
                <li id="tab_pane_wrapper_3" class="<?php if($TAB_TARGET=='3'){echo $TAB_PANE_CLASS['active'];}else{echo $TAB_PANE_CLASS['inactive'];} ?>">PANE4<div class="cb_100"></div></li>
                <li id="tab_pane_wrapper_4" class="<?php if($TAB_TARGET=='4'){echo $TAB_PANE_CLASS['active'];}else{echo $TAB_PANE_CLASS['inactive'];} ?>">PANE5<div class="cb_100"></div></li>
                <li id="tab_pane_wrapper_5" class="<?php if($TAB_TARGET=='5'){echo $TAB_PANE_CLASS['active'];}else{echo $TAB_PANE_CLASS['inactive'];} ?>">PANE6<div class="cb_100"></div></li>
                <li id="tab_pane_wrapper_6" class="<?php if($TAB_TARGET=='6'){echo $TAB_PANE_CLASS['active'];}else{echo $TAB_PANE_CLASS['inactive'];} ?>">PANE7<div class="cb_100"></div></li>-->
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