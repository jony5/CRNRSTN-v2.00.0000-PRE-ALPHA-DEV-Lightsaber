<?php
	session_start();
	include_once("./root.inc.php");
	include_once("$ROOT/config.inc.php");
	include("$ROOT/common/includes/db/jony5mailingdb.inc.php");
	$IPADDRESS=$_SERVER['REMOTE_ADDR'];
	$cs=$_GET['cs'];
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
                	
                	<table cellpadding="0" cellspacing="0" border="0">
					<tr>
					<td colspan="3">
					
					<?php
					if($cs=="true"){
					?>
						<div class="confirmation_message" style="border-bottom:1px dotted #999999;"><div class="copy" style="padding:10px 20px 0 10px; font-size:25px;"><strong>Thanks for signing up! Your information has been received.</strong></div>
						<div class="cb_15"></div>
						</div>
					<?php
					}
					?>
					</td>
					</tr>
                    <tr>
                    <td style="padding:10px 20px 0 25px; text-align:left;" valign="top">
                    <div class="mailing_input_title">Email <font color="#ff0000">*</font></div>
                    <div class="contact_input_text_wrapper" id="email_err"><input name="email" type="text" id="email" size="20" maxlength="255" /></div>
                    <div class="cb_5"></div>
                    <div class="mailing_err_msg" id="email_req">Invalid email</div>
                    <div class="cb_15"></div>
                    </td>
                    <td style="padding:10px 20px 0 30px; text-align:left;" valign="top">
                    <div class="mailing_input_title">Firstname <font color="#ff0000">*</font></div>
                    <div class="contact_input_text_wrapper" id="fname_err"><input name="fname" type="text" id="fname" size="20" maxlength="30"  value="" /></div>
                    <div class="cb_5"></div>
                    <div class="mailing_err_msg" id="fname_req">Required</div>
                    <div class="cb_15"></div>
                    </td>
                    <td style="padding:10px 20px 0 30px; text-align:left;" valign="top">
                    <div class="mailing_input_title">Lastname <font color="#ff0000">*</font></div>
                    <div class="contact_input_text_wrapper" id="lname_err"><input name="lname" type="text" id="lname" size="20" maxlength="30"  value="" 	/></div>
                    <div class="cb_5"></div>
                    <div class="mailing_err_msg" id="lname_req">Required</div>
                    <div class="cb_15"></div>
                    </td>
                    </tr>
                    <tr>
                    <td style="padding:10px 0 0 25px; text-align:left;" valign="top">
                    <div class="mailing_input_title">Mobile Number</div>
                    <div class="mailing_input_text_wrapper"  id="phone_err" style="width:220px;"><input name="phone" type="text" maxlength="20" size="15" id="phone" value="" /></div>
                    <div class="cb_5"></div>
                    <div class="mailing_err_msg" id="phone_req">Invalid mobile number</div>
                    <div class="mailing_option_chk_wrapper">
                    	<div class="mailing_option_chk"><input type="checkbox" name="MOBILEALERTSOK" id="MOBILEALERTSOK" checked></div>
                        <div class="mailing_option_chk_text">I'm OK with receiving occasional SMS alerts.</div>
                    </div>
                    <div class="cb_15"></div>
                    </td>
                    <td style="padding:10px 0 0 30px; text-align:left;" valign="top">
                    <div class="mailing_input_title">Mobile Service Provider</div>
                    <div class="mailing_input_text_wrapper">
					<select id="CARRIER" name="CARRIER">
						<option value=""> - Please Select One</option>
						<?php
						$queryCarriers=mysql_query("select ID, NAME, VALUE from carriers where ROWSTATUS='active'");
						while(list($CID, $NAME, $VALUE)=mysql_fetch_row($queryCarriers)){
							if($CID==$CARRIERID){
								echo "<option value=\"".$CID."\" selected=\"selected\">".$NAME."</option>";
							}else{
								echo "<option value=\"".$CID."\">".$NAME."</option>";	
							}
						}
						?>
					</select>
					</div>
					<div class="cb_15"></div>
        			</td>
                    </tr>
                    <tr>
                    <td align="left" style="padding:10px 0 0 25px; text-align:left;">
                    <div class="mailing_input_title">Country (optional)</div>
                    <div class="mailing_input_text_wrapper">
					<select id="COUNTRY" name="COUNTRY">
						<option value="">- Please Select One</option>
						<option value="AF">Afghanistan</option>
						<option value="AX">Åland Islands</option>
						<option value="AL">Albania</option>
						<option value="DZ">Algeria</option>
						<option value="AS">American Samoa</option>
						<option value="AD">Andorra</option>
						<option value="AO">Angola</option>
						<option value="AI">Anguilla</option>
						<option value="AQ">Antarctica</option>
						<option value="AG">Antigua and Barbuda</option>
						<option value="AR">Argentina</option>
						<option value="AM">Armenia</option>
						<option value="AW">Aruba</option>
						<option value="AU">Australia</option>
						<option value="AT">Austria</option>
						<option value="AZ">Azerbaijan</option>
						<option value="BS">Bahamas</option>
						<option value="BH">Bahrain</option>
						<option value="BD">Bangladesh</option>
						<option value="BB">Barbados</option>
						<option value="BY">Belarus</option>
						<option value="BE">Belgium</option>
						<option value="BZ">Belize</option>
						<option value="BJ">Benin</option>
						<option value="BM">Bermuda</option>
						<option value="BT">Bhutan</option>
						<option value="BO">Bolivia</option>
						<option value="BA">Bosnia and Herzegovina</option>
						<option value="BW">Botswana</option>
						<option value="BV">Bouvet Island</option>
						<option value="BR">Brazil</option>
						<option value="IO">British Indian Ocean Territory</option>
						<option value="BN">Brunei Darussalam</option>
						<option value="BG">Bulgaria</option>
						<option value="BF">Burkina Faso</option>
						<option value="BI">Burundi</option>
						<option value="KH">Cambodia</option>
						<option value="CM">Cameroon</option>
						<option value="CA">Canada</option>
						<option value="CV">Cape Verde</option>
						<option value="KY">Cayman Islands</option>
						<option value="CF">Central African Republic</option>
						<option value="TD">Chad</option>
						<option value="CL">Chile</option>
						<option value="CN">China</option>
						<option value="CX">Christmas Island</option>
						<option value="CC">Cocos (Keeling) Islands</option>
						<option value="CO">Colombia</option>
						<option value="KM">Comoros</option>
						<option value="CG">Congo</option>
						<option value="CD">Congo, The Democratic Republic of The</option>
						<option value="CK">Cook Islands</option>
						<option value="CR">Costa Rica</option>
						<option value="CI">Cote D'ivoire</option>
						<option value="HR">Croatia</option>
						<option value="CU">Cuba</option>
						<option value="CY">Cyprus</option>
						<option value="CZ">Czech Republic</option>
						<option value="DK">Denmark</option>
						<option value="DJ">Djibouti</option>
						<option value="DM">Dominica</option>
						<option value="DO">Dominican Republic</option>
						<option value="EC">Ecuador</option>
						<option value="EG">Egypt</option>
						<option value="SV">El Salvador</option>
						<option value="GQ">Equatorial Guinea</option>
						<option value="ER">Eritrea</option>
						<option value="EE">Estonia</option>
						<option value="ET">Ethiopia</option>
						<option value="FK">Falkland Islands (Malvinas)</option>
						<option value="FO">Faroe Islands</option>
						<option value="FJ">Fiji</option>
						<option value="FI">Finland</option>
						<option value="FR">France</option>
						<option value="GF">French Guiana</option>
						<option value="PF">French Polynesia</option>
						<option value="TF">French Southern Territories</option>
						<option value="GA">Gabon</option>
						<option value="GM">Gambia</option>
						<option value="GE">Georgia</option>
						<option value="DE">Germany</option>
						<option value="GH">Ghana</option>
						<option value="GI">Gibraltar</option>
						<option value="GR">Greece</option>
						<option value="GL">Greenland</option>
						<option value="GD">Grenada</option>
						<option value="GP">Guadeloupe</option>
						<option value="GU">Guam</option>
						<option value="GT">Guatemala</option>
						<option value="GG">Guernsey</option>
						<option value="GN">Guinea</option>
						<option value="GW">Guinea-bissau</option>
						<option value="GY">Guyana</option>
						<option value="HT">Haiti</option>
						<option value="HM">Heard Island and Mcdonald Islands</option>
						<option value="VA">Holy See (Vatican City State)</option>
						<option value="HN">Honduras</option>
						<option value="HK">Hong Kong</option>
						<option value="HU">Hungary</option>
						<option value="IS">Iceland</option>
						<option value="IN">India</option>
						<option value="ID">Indonesia</option>
						<option value="IR">Iran, Islamic Republic of</option>
						<option value="IQ">Iraq</option>
						<option value="IE">Ireland</option>
						<option value="IM">Isle of Man</option>
						<option value="IL">Israel</option>
						<option value="IT">Italy</option>
						<option value="JM">Jamaica</option>
						<option value="JP">Japan</option>
						<option value="JE">Jersey</option>
						<option value="JO">Jordan</option>
						<option value="KZ">Kazakhstan</option>
						<option value="KE">Kenya</option>
						<option value="KI">Kiribati</option>
						<option value="KP">Korea, Democratic People's Republic of</option>
						<option value="KR">Korea, Republic of</option>
						<option value="KW">Kuwait</option>
						<option value="KG">Kyrgyzstan</option>
						<option value="LA">Lao People's Democratic Republic</option>
						<option value="LV">Latvia</option>
						<option value="LB">Lebanon</option>
						<option value="LS">Lesotho</option>
						<option value="LR">Liberia</option>
						<option value="LY">Libyan Arab Jamahiriya</option>
						<option value="LI">Liechtenstein</option>
						<option value="LT">Lithuania</option>
						<option value="LU">Luxembourg</option>
						<option value="MO">Macao</option>
						<option value="MK">Macedonia, The Former Yugoslav Republic of</option>
						<option value="MG">Madagascar</option>
						<option value="MW">Malawi</option>
						<option value="MY">Malaysia</option>
						<option value="MV">Maldives</option>
						<option value="ML">Mali</option>
						<option value="MT">Malta</option>
						<option value="MH">Marshall Islands</option>
						<option value="MQ">Martinique</option>
						<option value="MR">Mauritania</option>
						<option value="MU">Mauritius</option>
						<option value="YT">Mayotte</option>
						<option value="MX">Mexico</option>
						<option value="FM">Micronesia, Federated States of</option>
						<option value="MD">Moldova, Republic of</option>
						<option value="MC">Monaco</option>
						<option value="MN">Mongolia</option>
						<option value="ME">Montenegro</option>
						<option value="MS">Montserrat</option>
						<option value="MA">Morocco</option>
						<option value="MZ">Mozambique</option>
						<option value="MM">Myanmar</option>
						<option value="NA">Namibia</option>
						<option value="NR">Nauru</option>
						<option value="NP">Nepal</option>
						<option value="NL">Netherlands</option>
						<option value="AN">Netherlands Antilles</option>
						<option value="NC">New Caledonia</option>
						<option value="NZ">New Zealand</option>
						<option value="NI">Nicaragua</option>
						<option value="NE">Niger</option>
						<option value="NG">Nigeria</option>
						<option value="NU">Niue</option>
						<option value="NF">Norfolk Island</option>
						<option value="MP">Northern Mariana Islands</option>
						<option value="NO">Norway</option>
						<option value="OM">Oman</option>
						<option value="PK">Pakistan</option>
						<option value="PW">Palau</option>
						<option value="PS">Palestinian Territory, Occupied</option>
						<option value="PA">Panama</option>
						<option value="PG">Papua New Guinea</option>
						<option value="PY">Paraguay</option>
						<option value="PE">Peru</option>
						<option value="PH">Philippines</option>
						<option value="PN">Pitcairn</option>
						<option value="PL">Poland</option>
						<option value="PT">Portugal</option>
						<option value="PR">Puerto Rico</option>
						<option value="QA">Qatar</option>
						<option value="RE">Reunion</option>
						<option value="RO">Romania</option>
						<option value="RU">Russian Federation</option>
						<option value="RW">Rwanda</option>
						<option value="SH">Saint Helena</option>
						<option value="KN">Saint Kitts and Nevis</option>
						<option value="LC">Saint Lucia</option>
						<option value="PM">Saint Pierre and Miquelon</option>
						<option value="VC">Saint Vincent and The Grenadines</option>
						<option value="WS">Samoa</option>
						<option value="SM">San Marino</option>
						<option value="ST">Sao Tome and Principe</option>
						<option value="SA">Saudi Arabia</option>
						<option value="SN">Senegal</option>
						<option value="RS">Serbia</option>
						<option value="SC">Seychelles</option>
						<option value="SL">Sierra Leone</option>
						<option value="SG">Singapore</option>
						<option value="SK">Slovakia</option>
						<option value="SI">Slovenia</option>
						<option value="SB">Solomon Islands</option>
						<option value="SO">Somalia</option>
						<option value="ZA">South Africa</option>
						<option value="GS">South Georgia and The South Sandwich Islands</option>
						<option value="ES">Spain</option>
						<option value="LK">Sri Lanka</option>
						<option value="SD">Sudan</option>
						<option value="SR">Suriname</option>
						<option value="SJ">Svalbard and Jan Mayen</option>
						<option value="SZ">Swaziland</option>
						<option value="SE">Sweden</option>
						<option value="CH">Switzerland</option>
						<option value="SY">Syrian Arab Republic</option>
						<option value="TW">Taiwan, Province of China</option>
						<option value="TJ">Tajikistan</option>
						<option value="TZ">Tanzania, United Republic of</option>
						<option value="TH">Thailand</option>
						<option value="TL">Timor-leste</option>
						<option value="TG">Togo</option>
						<option value="TK">Tokelau</option>
						<option value="TO">Tonga</option>
						<option value="TT">Trinidad and Tobago</option>
						<option value="TN">Tunisia</option>
						<option value="TR">Turkey</option>
						<option value="TM">Turkmenistan</option>
						<option value="TC">Turks and Caicos Islands</option>
						<option value="TV">Tuvalu</option>
						<option value="UG">Uganda</option>
						<option value="UA">Ukraine</option>
						<option value="AE">United Arab Emirates</option>
						<option value="GB">United Kingdom</option>
						<option value="US">United States</option>
						<option value="UM">United States Minor Outlying Islands</option>
						<option value="UY">Uruguay</option>
						<option value="UZ">Uzbekistan</option>
						<option value="VU">Vanuatu</option>
						<option value="VE">Venezuela</option>
						<option value="VN">Viet Nam</option>
						<option value="VG">Virgin Islands, British</option>
						<option value="VI">Virgin Islands, U.S.</option>
						<option value="WF">Wallis and Futuna</option>
						<option value="EH">Western Sahara</option>
						<option value="YE">Yemen</option>
						<option value="ZM">Zambia</option>
						<option value="ZW">Zimbabwe</option>
					</select>
					
					</div>
                    <div class="cb_15"></div>
                    </td>
					<td colspan="2" align="left" style="padding:10px 0 0 25px; text-align:left;">
                    <div class="mailing_input_title">Zipcode / Postal code</div>
                    <div class="mailing_input_text_wrapper" id="zip_err" style="width:120px;"><input name="zip"  type="text" maxlength="15" id="zip" style="width:80px;"  value="" /></div>
                    <div class="cb_5"></div>
                    <div class="mailing_err_msg" id="zip_req" >Invalid zipcode</div>
                    <div class="cb_15"></div>
        			</td>
                    </tr>
					<tr>
					<td colspan="3" style="padding:10px 0 0 25px;">
					<div class="mailing_input_title">Message Format Preference</div>
					<div class="mailing_option_radio_wrapper">
						<div class="mailing_option_radio"><input type="radio" name="MESSAGEFORMAT" checked="checked" value="H"></div>
						<div class="mailing_option_radio_text">HTML</div>
					</div>
					<div class="cb_5"></div>
					<div class="mailing_option_radio_wrapper">
						<div class="mailing_option_radio"><input type="radio" name="MESSAGEFORMAT" value="T"></div>
						<div class="mailing_option_radio_text">Text</div>
					</div>
					<div class="cb_15"></div>
					
					</td>
					</tr>
					<tr>
					<td colspan="3" style="padding:10px 0 0 25px;">
					<div class="mailing_input_title">I'm interested in receiving information concerning the following ::</div>
					<div class="mailing_option_chk_wrapper">
                    	<div class="mailing_option_chk"><input type="checkbox" name="PREF_FAITH" id="PREF_FAITH" checked></div>
                        <div class="mailing_option_chk_text">Updates &amp; news concerning the basic Christian Faith</div>
                    </div>
					<div class="cb_5"></div>
					<div class="mailing_option_chk_wrapper">
                    	<div class="mailing_option_chk"><input type="checkbox" name="PREF_WEB" id="PREF_WEB" checked></div>
                        <div class="mailing_option_chk_text">Open source web application development</div>
                    </div>
					<div class="cb_5"></div>
					<div class="mailing_option_chk_wrapper">
                    	<div class="mailing_option_chk"><input type="checkbox" name="PREF_JONY5" id="PREF_JONY5" checked></div>
                        <div class="mailing_option_chk_text">News relating to the person and work of Jonathan 'J5' Harris</div>
                    </div>
					<div class="cb_15"></div>
					</td>
					</tr>
                    <tr>
                    <td colspan="3" style="padding:10px 0 0 25px;">
                    
                    
                    <table cellpadding="0" cellspacing="0" border="0">
                    <tr>
                    <td>
                    <div class="mailing_btn_wrapper" onclick="if(!validData('signupform')){return false;}else{$('signupform').submit();}">
                        <div class="mailing_btn_text">SUBMIT</div>
                    </div>
                    </td>
                    <td>
                    <?php
					if($cs=="true"){
					?>
						<div id="confirmation_message"><div class="copy"><strong>Thanks for signing up! Your information has been received.</strong></div></div>
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