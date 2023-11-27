<?php
/* 
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
include_once($CRNRSTN_ROOT.'_crnrstn.config.inc.php');

require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/security/secure.inc.php');
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/session/session.inc.php');

require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/language/lang.inc.php');

//
// LANGUAGE SUPPORT
$oUSER->prepLangElem('SITE_TITLE|SITE_FOOTER_RIGHTS|SITE_TITLE_WEB_DEV|SITE_TITLE_DIGIT_MARKET|SITE_TITLE_AND|COMBO_SEL_DEVICE_MOBILE|COMBO_SEL_DEVICE_DESKTOP|TEXT_REQUIRED');

//
// LOAD DEVICE DETECT AFTER LANGUAGE PACK PREPPED FOR POPULATION OF COMBO COPY WITH LANG DATA
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/device/detect.inc.php');


if(strlen($oCRNRSTN_ENV->oHTTP_MGR->extractData($_POST, 'cid'))!=50){
	//
	// RETRIEVE CLIENTS AND LIST OF USER-CLIENT RELATIONS. IF USER NOT LISTED (AND CLIENT NOT SELECTED)...THEN GIVE THEM DROP DOWN OF ALL CLIENTS TO 
	// SELECT CLIENT.
	$adminContent_ARRAY = $oUSER->getUserClientAccess();
	
	/*
	SELECT `users_client_assoc_CLIENT_ID`, `users_client_assoc_USER_ID`
	`clients_CLIENT_ID`, `clients_ISACTIVE`, `clients_COMPANYNAME_BLOB`, `clients_DATEMODIFIED`, `clients_DATECREATED`
	*/
	
	$queryIndex_ARRAY = array('clients_CLIENT_ID' => 0,'clients_ISACTIVE' => 1,
					'clients_COMPANYNAME_BLOB' => 2,'clients_DATEMODIFIED' => 3, 'clients_DATECREATED' => 4,
					
					'users_client_assoc_CLIENT_ID' => 0,'users_client_assoc_USER_ID' => 1
					);
	
	
	
	$tmp_userClient = array();
	$tmp_clientData = array();
	
	$clientCnt = 0;
	$relateCnt = 0;
	
	//
	// PARSE DB OUTPUT INTO USABLE FORMAT
	for($i=0;$i<sizeof($adminContent_ARRAY);$i++){
		
		switch(sizeof($adminContent_ARRAY[$i])){
			case 2:
				
				//
				// USER CLIENT ASSOCIATION
				$tmp_userClient[$adminContent_ARRAY[$i][$queryIndex_ARRAY['users_client_assoc_CLIENT_ID']]]  = 1;
				
			break;
			default:
				//
				// CLIENT DATA
				$tmp_clientData[$clientCnt]['CLIENT_ID'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['clients_CLIENT_ID']];
				$tmp_clientData[$clientCnt]['ISACTIVE'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['clients_ISACTIVE']];
				$tmp_clientData[$clientCnt]['COMPANYNAME_BLOB'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['clients_COMPANYNAME_BLOB']];
				$tmp_clientData[$clientCnt]['DATEMODIFIED'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['clients_DATEMODIFIED']];
				$tmp_clientData[$clientCnt]['DATECREATED'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['clients_DATECREATED']];
				
				
				$clientCnt++;	
				
			break;
		}
		
	}


}else{
	//
	// WE HAVE CLIENT. PULL LIST OF USERS APPROVED TO RECEIVE INITIAL ASSIGBNMENT UPON KIBOTOS CREATION
	$adminContent_ARRAY = $oUSER->getUsersForClient();
	/*
	`users`.`USERID`,`users`.`EMAIL` ,`users`.`ISACTIVE`, `users`.`USER_PERMISSIONS_ID`, `users`.`FIRSTNAME_BLOB`, 
	`users`.`LASTNAME_BLOB`, `users`.`JOBTITLE_BLOB`, `users`.`LANGCODE`,`users`.`LASTLOGIN`,`users`.`LASTLOGIN_IP`,
	`users`.`IMAGE_NAME`,`users`.`IMAGE_WIDTH`,`users`.`IMAGE_HEIGHT`,`users`.`ABOUT_BLOB`,`users`.`DATEMODIFIED`,
	`users`.`DATECREATED`
	*/
	
	$queryIndex_ARRAY = array('clients_CLIENT_ID' => 0,'clients_ISACTIVE' => 1,
					'clients_COMPANYNAME_BLOB' => 2,'clients_DATEMODIFIED' => 3, 'clients_DATECREATED' => 4,
					
					'users_client_assoc_CLIENT_ID' => 0,'users_client_assoc_USER_ID' => 1,
					
					'users_USERID' => 0,'users_EMAIL' => 1,'users_ISACTIVE' => 2,
					'users_USER_PERMISSIONS_ID' => 3,'users_FIRSTNAME_BLOB' => 4, 'users_LASTNAME_BLOB' => 5,
					'users_JOBTITLE_BLOB' => 6,'users_LANGCODE' => 7, 'users_LASTLOGIN' => 8,
					'users_LASTLOGIN_IP' => 9,'users_IMAGE_NAME' => 10,'users_IMAGE_WIDTH' => 11,
					'users_IMAGE_HEIGHT' => 12,'users_ABOUT_BLOB' => 13,'users_DATEMODIFIED' => 14,'users_DATECREATED' => 15
					);
	
	$tmp_userClient = array();
	$tmp_userData = array();
	$tmp_clientData = array();
	
	$clientCnt = 0;
	$userCnt = 0;
	
	//
	// PARSE DB OUTPUT INTO USABLE FORMAT
	for($i=0;$i<sizeof($adminContent_ARRAY);$i++){
		
		switch(sizeof($adminContent_ARRAY[$i])){
			case 2:
				
				//
				// USER CLIENT ASSOCIATION
				$tmp_userClient[$adminContent_ARRAY[$i][$queryIndex_ARRAY['users_client_assoc_USER_ID']]][$adminContent_ARRAY[$i][$queryIndex_ARRAY['users_client_assoc_CLIENT_ID']]]  = 1;
				
			break;
			case 5:
				
				//
				// CLIENT DATA
				$tmp_clientData[$clientCnt]['CLIENT_ID'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['clients_CLIENT_ID']];
				$tmp_clientData[$clientCnt]['ISACTIVE'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['clients_ISACTIVE']];
				$tmp_clientData[$clientCnt]['COMPANYNAME_BLOB'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['clients_COMPANYNAME_BLOB']];
				$tmp_clientData[$clientCnt]['DATEMODIFIED'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['clients_DATEMODIFIED']];
				$tmp_clientData[$clientCnt]['DATECREATED'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['clients_DATECREATED']];
				
				$clientCnt++;
				
			break;
			default:
				//
				// USER DATA
				$tmp_userData[$userCnt]['USERID'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['users_USERID']];
				$tmp_userData[$userCnt]['EMAIL'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['users_EMAIL']];
				$tmp_userData[$userCnt]['ISACTIVE'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['users_ISACTIVE']];
				$tmp_userData[$userCnt]['USER_PERMISSIONS_ID'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['users_USER_PERMISSIONS_ID']];
				$tmp_userData[$userCnt]['FIRSTNAME_BLOB'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['users_FIRSTNAME_BLOB']];
				$tmp_userData[$userCnt]['LASTNAME_BLOB'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['users_LASTNAME_BLOB']];
				$tmp_userData[$userCnt]['JOBTITLE_BLOB'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['users_JOBTITLE_BLOB']];
				$tmp_userData[$userCnt]['LANGCODE'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['users_LANGCODE']];
				$tmp_userData[$userCnt]['LASTLOGIN'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['users_LASTLOGIN']];
				$tmp_userData[$userCnt]['LASTLOGIN_IP'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['users_LASTLOGIN_IP']];
				$tmp_userData[$userCnt]['IMAGE_NAME'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['users_IMAGE_NAME']];
				$tmp_userData[$userCnt]['IMAGE_WIDTH'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['users_IMAGE_WIDTH']];
				$tmp_userData[$userCnt]['IMAGE_HEIGHT'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['users_IMAGE_HEIGHT']];
				$tmp_userData[$userCnt]['ABOUT_BLOB'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['users_ABOUT_BLOB']];
				$tmp_userData[$userCnt]['DATEMODIFIED'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['users_DATEMODIFIED']];
				$tmp_userData[$userCnt]['DATECREATED'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['users_DATECREATED']];			
				
				$userCnt++;
			break;
		}
		
	}	
	
}

if($oCRNRSTN_ENV->oSESSION_MGR->getSessionParam("DEVICETYPE")=="m"){
?>

<!DOCTYPE html>
<html lang="<?php echo strtolower($oCRNRSTN_ENV->oSESSION_MGR->getSessionParam("LANGCODE")); ?>">
<head>
<?php
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/head/head.mobi.inc.php');
?>
</head>

<body>

<div data-role="page">
    <?php
	require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/search/search.mobi.inc.php');
	require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/nav/dashboard.mobi.inc.php');
	require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/header/header.mobi.inc.php');
	?>
    
    <!-- 
    //
    // BEGIN MAIN CONTENT -->
	<div role="main" class="ui-content">
		<h3>new</h3>
		<p>Add a new kib&oacute;tos (a wooden chest, box) to the extranet.</p>
		<div class="cb_10"></div>
        <?php
		
		//
		// WE NEED TO HAVE CLIENT BEFORE WE CAN CREATE A KIBOTOS (WOODEN BOX). AND EVEN BE ABLE TO ASSIGN NEW KIBOTOS TO A USER. IF NO CLIENT, NEED TO FORCE SELECT. 
		// ARE THERE ANY CLIENTS THIS USER HAS EXPLICIT ACCESS TO? THEN ONLY THOSE CLIENTS SHOULD LOAD IN THIS LIST.
		// WE NEED LIST OF CLIENTS. LIST OF USER-CLIENT RELATIONS TO ESTABLISH ANY CLIENT ACCESS PERMISSIONS.
		if(strlen($oCRNRSTN_ENV->oHTTP_MGR->extractData($_POST, 'cid'))==50){
		?>	
      	<form action="#" method="post" name="create_kibotos" id="create_kibotos"  enctype="multipart/form-data" >				
            
            <label for="kibotosname">task / objective name <span class="req_star">*</span></label>
            <input type="text" name="kibotosname" id="kibotosname" value="">
            <div class="frm_errstatus kibotosname" style="width:100%; display:none;"><?php echo $oUSER->getLangElem('TEXT_REQUIRED'); ?></div>
            
            <label for="textarea">description <span class="req_star">*</span></label>
            <textarea cols="40" rows="8" name="description" id="description"></textarea>
            <div class="frm_errstatus description" style="width:100%; display:none;"><?php echo $oUSER->getLangElem('TEXT_REQUIRED'); ?></div>
            
            <label for="user_assign">assign to user for <?php echo $tmp_clientData[0]['COMPANYNAME_BLOB']; ?>:</label>
            <select name="user_assign" id="user_assign">
            	<?php
				$tmpOutputHTML = "";
				
				//
				// FOR EACH USER
				for($i=0; $i<sizeof($tmp_userData); $i++){
					
					//
					// IF CLIENT/USER ACCESS SPECIFIED, LIMIT DISPLAY USER TO ONLY EXPLICIT ALLOW.
					if(sizeof($tmp_userClient[$tmp_userData[$i]['USERID']])>0){
						for($ii=0;$ii<sizeof($tmp_userClient[$tmp_userData[$i]['USERID']]);$ii++){
							if(isset($tmp_userClient[$tmp_userData[$i]['USERID']][$oCRNRSTN_ENV->oHTTP_MGR->extractData($_POST, 'cid')]) && !isset($userDisplay[$tmp_userData[$i]['USERID']])){
								if($tmp_userData[$i]['USERID']==$oCRNRSTN_ENV->oSESSION_MGR->getSessionParam("USERID")){
									$tmpOutputHTML .= '<option value="'.$tmp_userData[$i]['USERID'].'" selected="selected">'.$tmp_userData[$i]['FIRSTNAME_BLOB']." ".$tmp_userData[$i]['LASTNAME_BLOB'].'</option>'; 
								}else{
									$tmpOutputHTML .= '<option value="'.$tmp_userData[$i]['USERID'].'">'.$tmp_userData[$i]['FIRSTNAME_BLOB']." ".$tmp_userData[$i]['LASTNAME_BLOB'].'</option>'; 
								}
								
								$userDisplay[$tmp_userData[$i]['USERID']] = 1;
							}
						}
							
					}else{
						
						//
						// USER CLIENT RELATION NOT SPECIFIED. ONLY DISPLAY USER IF APPROVED EVIFWEB USER PERMISSIONS ID.
						if($tmp_userData[$i]['USER_PERMISSIONS_ID']>160 && !($tmp_userData[$i]['USER_PERMISSIONS_ID']==405)){
							if($tmp_userData[$i]['USERID']==$oCRNRSTN_ENV->oSESSION_MGR->getSessionParam("USERID")){
								$tmpOutputHTML .= '<option value="'.$tmp_userData[$i]['USERID'].'" selected="selected">'.$tmp_userData[$i]['FIRSTNAME_BLOB']." ".$tmp_userData[$i]['LASTNAME_BLOB'].'</option>'; 
							}else{
								$tmpOutputHTML .= '<option value="'.$tmp_userData[$i]['USERID'].'">'.$tmp_userData[$i]['FIRSTNAME_BLOB']." ".$tmp_userData[$i]['LASTNAME_BLOB'].'</option>'; 
							}
						}
						
					}
				}
				
				echo $tmpOutputHTML;
				?>
            </select> 
            <div class="cb_20"></div>
            <select name="isprivate" id="isprivate" data-role="slider">
				<option value="0">Public</option>
                <option value="1">Private</option>
            </select>
            <div class="cb_20"></div>
            <button class="ui-shadow ui-btn ui-corner-all" type="submit" id="submit">CREATE KIB&Oacute;TOS</button>
            
            <input type="hidden" name="cid" value="<?php echo $oCRNRSTN_ENV->oHTTP_MGR->extractData($_POST, 'cid'); ?>">
            <input type="hidden" name="postid" value="create_kibotos">
        </form>
        
        
	<script type="application/javascript" language="javascript">
	$( "#create_kibotos" ).submit(function( event ) {
		//
		// VALIDATE FORM
		return validateForm('create_kibotos');
	});
	
	</script>        
			
		<?php 	
		}else{
		?>
        
      	<form action="#" method="post" name="select_client" id="select_client"  enctype="multipart/form-data" >				
            <select name="cid" id="cid" onChange="evifweb_clientSelect();">
            	<option value="" selected="selected">Select Client...</option>
            	<?php
				$tmpOutputHTML = "";
				for($i=0; $i<sizeof($tmp_clientData); $i++){
					if(sizeof($tmp_userClient)>0){
						if(isset($tmp_userClient[$tmp_clientData[$i]['CLIENT_ID']])){
							$tmpOutputHTML .= '<option value="'.$tmp_clientData[$i]['CLIENT_ID'].'">'.$tmp_clientData[$i]['COMPANYNAME_BLOB'].'</option>'; 
						}
					}else{
						$tmpOutputHTML .= '<option value="'.$tmp_clientData[$i]['CLIENT_ID'].'">'.$tmp_clientData[$i]['COMPANYNAME_BLOB'].'</option>'; 
						
					}
				}
				
				echo $tmpOutputHTML;
				?>
            </select>          
        </form>
		<?php
		}
		?>
		
	</div><!-- /content -->
 

	<?php
    require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/footer/ftr.mobi.inc.php');
    
    ?>

</div><!-- /page -->

</body>
</html>



	
<?php
}else{
?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/head/head.inc.php');
?>
</head>

<body>

<?php
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/header/header.inc.php');
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/nav/dashboard.inc.php');
?>

<main id="content">
<div id="dashboard_content_shell">
	<div id="dashboard_page_title">new user</div>
    <div class="cb_10"></div>

    <div id="form_shell" class="signin_shell">
        <div id="form_box">
            <div class="cb_10"></div>
            <div class="evif_logo_form"><img src="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/evifweb_logo_sm.gif" width="42" height="23" alt="Evifweb" title="5"></div>
            <div id="form_title">new client</div>
            <div class="cb_5"></div>
            <div class="form_element_label">Add a new user to the extranet.</div>
            <div class="cb_30"></div>
        
            <form action="#" method="post" name="new_client" id="new_client"  enctype="multipart/form-data" >
                <div class="form_input_shell">
                    <div id="companyname_form_element_label" class="form_element_label">company name / business group <span class="req_star">*</span></div>
                    <div class="form_element_input"><input frm_init="crnrstn_frm_handle" crnrstn_frm_valtype="required" name="companyname" type="text" id="companyname" size="20" maxlength="100" value="" style="width:375px;" /></div>
                    <div class="cb"></div>
                    <div class="input_validation_copy_shell"><div id="companyname_input_validation_copy" class="input_validation_copy">Required</div></div>
                    <div class="cb"></div>
                </div>
                <div class="cb_20"></div>
                <div id="submit_shell" class="form_submit_shell" style="width:180px;">
                <div id="new_client_submit_btn" class="form_submit_btn" onMouseOver="mycrnrstn_fhandler.submitBtnMouseOver(this); return false;" onMouseOut="mycrnrstn_fhandler.submitBtnMouseOut(this); return false;">CREATE CLIENT</div>
                </div>
                <div class="cb_40"></div>
                <div class="hidden">
                    <input name="submitin" type="submit" value="submit" onClick="mycrnrstn_fhandler.formSubmit('new_client'); return false;">
                    <div id="login_main_errmsg"></div>
                    <div id="feedback_max_char_cnt">2000</div>
                </div>
                  
            </form>
        </div>
    </div>


</div>
</main>

<?php
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/footer/ftr.inc.php');
?>
</body>
</html>
<?php
}
?>
