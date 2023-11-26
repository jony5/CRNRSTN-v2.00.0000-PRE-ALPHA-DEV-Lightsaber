<?php
	session_start();
	include_once("./root.inc.php");
	include_once("$ROOT/config.inc.php");
	$IPADDRESS=$_SERVER['REMOTE_ADDR'];
	$cs=$_GET['cs'];
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<?php
include_once("$ROOT/common/includes/meta/meta.inc.php");
?>

<title>J5 :: CONTACT</title>
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
    	<div id="main_content_title">:: CONTACT</div>
        <div class="cb"></div>
        
        <div id="primary_tab_wrapper">
        	<div class="cb_10"></div>
        	<div id="tab_pane_0" class="<?php if($TAB_TARGET==''){echo $TAB_LNK_CLASS['active'];}else{echo $TAB_LNK_CLASS['inactive'];} ?>" onClick="tabVisibility('0','1')"><a href="#" target="_self">Email</a></div>
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
                <form action="<?php echo $ROOT; ?>/contact/action/contactsubmit.php" method="post" name="contactform" id="contactform" onsubmit="if(!validData('contactform')){return false;}else{$('contactform').submit();}">
                
                	<table cellpadding="0" cellspacing="0" border="0">
                    <tr>
                    <td style="padding:10px 20px 0 25px; text-align:left;" valign="top">
                    <div class="contact_input_title">Email <font color="#ff0000">*</font></div>
                    <div class="contact_input_text_wrapper" id="email_err"><input name="email" type="text" id="email" size="20" maxlength="255" /></div>
                    <div class="cb_5"></div>
                    <div class="contact_err_msg" id="email_req">Invalid email</div>
                    <div class="cb_15"></div>
                    </td>
                    <td style="padding:10px 20px 0 30px; text-align:left;" valign="top">
                    <div class="contact_input_title">Firstname <font color="#ff0000">*</font></div>
                    <div class="contact_input_text_wrapper" id="fname_err"><input name="fname" type="text" id="fname" size="20" maxlength="30"  value="" /></div>
                    <div class="cb_5"></div>
                    <div class="contact_err_msg" id="fname_req">Required</div>
                    <div class="cb_15"></div>
                    </td>
                    <td style="padding:10px 20px 0 30px; text-align:left;" valign="top">
                    <div class="contact_input_title">Lastname <font color="#ff0000">*</font></div>
                    <div class="contact_input_text_wrapper" id="lname_err"><input name="lname" type="text" id="lname" size="20" maxlength="30"  value="" 	/></div>
                    <div class="cb_5"></div>
                    <div class="contact_err_msg" id="lname_req">Required</div>
                    <div class="cb_15"></div>
                    </td>
                    </tr>
                    <tr>
                    <td style="padding:10px 0 0 25px; text-align:left;" valign="top">
                    <div class="contact_input_title">Mobile Number</div>
                    <div class="contact_input_text_wrapper"  id="phone_err" style="width:220px;"><input name="phone" type="text" maxlength="20" size="15" id="phone" value="" /></div>
                    <div class="cb_5"></div>
                    <div class="contact_err_msg" id="phone_req">Invalid mobile number</div>
                    <div class="cb_15"></div>
                    </td>
                    <td style="padding:10px 0 0 30px; text-align:left;" valign="top">
                    <div class="contact_input_title">Zipcode / Postal code</div>
                    <div class="contact_input_text_wrapper" id="zip_err" style="width:90px;"><input name="zip"  type="text" maxlength="5" id="zip" style="width:80px;"  value="" /></div>
                    <div class="cb_5"></div>
                    <div class="contact_err_msg" id="zip_req" >Invalid zipcode</div>
                    <div class="cb_15"></div>
        			</td>
                    </tr>
                    <tr>
                    <td align="left" colspan="3" style="padding:10px 0 0 25px; text-align:left;">
                    <div class="contact_input_title">Subject</div>
                    <div class="contact_input_text_wrapper"><input name="subject" type="text" id="subject" size="20" maxlength="255" /></div>
                    <div class="cb_15"></div>
                    
                    <div class="contact_input_title">Message</div>
                    <div class="contact_input_text_wrapper" style="width:350px; height:100px;"><textarea name="message" cols="18" rows="5" id="message" style="width:340px; height:90px;"></textarea></div>
                    <div class="cb_15"></div>
        			</td>
                    </tr>
                    <tr>
                    <td colspan="3" style="padding:10px 0 0 25px;">
                    
                    
                    <table cellpadding="0" cellspacing="0" border="0">
                    <tr>
                    <td>
                    <div class="contact_btn_wrapper" onclick="if(!validData('contactform')){return false;}else{$('contactform').submit();}">
                        <div class="contact_btn_text">SUBMIT</div>
                    </div>
                    </td>
                    <td>
                    <?php
					if($cs=="true"){
					?>
						<div id="confirmation_message"><div class="copy">Thanks for contacting me! Your message has been received.</div></div>
					<?php
					}
					?>
                    </td>
                    </tr>
                    </table>
                    
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
                
                <div class="cb_20"></div><div class="contact_form_ip"><?php echo $IPADDRESS; ?></div><div class="cb"></div></li>
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