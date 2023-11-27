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
$oUSER->prepLangElem('SITE_TITLE|SITE_TITLE_STYLED|SITE_FOOTER_RIGHTS|SITE_TITLE_WEB_DEV|SITE_TITLE_DIGIT_MARKET|SITE_TITLE_AND|COMBO_SEL_DEVICE_MOBILE|COMBO_SEL_DEVICE_DESKTOP|TEXT_REQUIRED|COPY_KIVOTOS_DESCRIPTION_TT|TEXT_REQUIRED|BUTTON_MOBI_CANCEL');

//
// LOAD DEVICE DETECT AFTER LANGUAGE PACK PREPPED FOR POPULATION OF COMBO COPY WITH LANG DATA
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/device/detect.inc.php');

if($oCRNRSTN_ENV->oHTTP_MGR->issetHTTP($_GET)){
	$tmp_kid = $oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, 'kid');
}else{
	$tmp_kid = NULL;
}

if(strlen($tmp_kid)!=70){	
	header("Location: ".$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'dashboard/');
	exit();
}

//
// RETRIEVE USER DATA
$adminContent_ARRAY = $oUSER->getKivotosData_Simple();

/*
`kivotos_KIVOTOS_ID`,`kivotos_ISACTIVE` ,`kivotos_ISPRIVATE`, `kivotos_CLIENT_ID`, `kivotos_CREATOR_ID`, 
`kivotos_ASSIGNED_ID`, `kivotos_SEARCH_ID`, `kivotos_NAME`,`kivotos_DESCRIPTION`,`kivotos_DATEMODIFIED`,`kivotos_DATECREATED`	

`clients`.`CLIENT_ID`, `clients`.`COMPANYNAME_BLOB`, `clients`.`LANGCODE`, `clients`.`DATECREATED`
					
*/
$queryIndex_ARRAY = array('kivotos_KIVOTOS_ID' => 0,'kivotos_ISACTIVE' => 1,
					'kivotos_ISPRIVATE' => 2,'kivotos_CLIENT_ID' => 3, 'kivotos_CREATOR_ID' => 4,
					'kivotos_ASSIGNED_ID' => 5,'kivotos_SEARCH_ID' => 6, 'kivotos_NAME' => 7,
					'kivotos_DESCRIPTION' => 8, 'kivotos_DUE_DATE' => 9, 'kivotos_STATE'=>10, 'kivotos_DATEMODIFIED' => 11, 'kivotos_DATECREATED' => 12
					
					);

$tmp_kivotosData = array();

//
// PARSE DB OUTPUT INTO USABLE FORMAT
$tmp_loop_size24 = sizeof($adminContent_ARRAY);
for($i=0;$i<$tmp_loop_size24;$i++){
	
	switch(sizeof($adminContent_ARRAY[$i])){
		case 4:
		break;
		default:
			//
			// USER DATA
			$tmp_kivotosData['KIVOTOS_ID'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['kivotos_KIVOTOS_ID']];
			$tmp_kivotosData['ISACTIVE'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['kivotos_ISACTIVE']];
			$tmp_kivotosData['ISPRIVATE'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['kivotos_ISPRIVATE']];
			$tmp_kivotosData['CLIENT_ID'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['kivotos_CLIENT_ID']];
			$tmp_kivotosData['CREATOR_ID'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['kivotos_CREATOR_ID']];
			$tmp_kivotosData['ASSIGNED_ID'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['kivotos_ASSIGNED_ID']];
			$tmp_kivotosData['SEARCH_ID'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['kivotos_SEARCH_ID']];
			$tmp_kivotosData['NAME'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['kivotos_NAME']];
			$tmp_kivotosData['DESCRIPTION'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['kivotos_DESCRIPTION']];
			$tmp_kivotosData['DUE_DATE'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['kivotos_DUE_DATE']];
			$tmp_kivotosData['STATE'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['kivotos_STATE']];
			$tmp_kivotosData['DATEMODIFIED'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['kivotos_DATEMODIFIED']];
			$tmp_kivotosData['DATECREATED'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['kivotos_DATECREATED']];
			
		break;
	}
	
}

if($oCRNRSTN_ENV->oSESSION_MGR->getSessionParam("DEVICETYPE")=="m"){
?>

<!DOCTYPE html>
<html lang="<?php echo strtolower($oCRNRSTN_ENV->oSESSION_MGR->getSessionParam("LANGCODE")); ?>">
<head>
<?php
$loadDatePickerLib = 1;
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/head/head.mobi.inc.php');
?>
</head>

<body>

<div data-role="page" id="myPage">
    <?php
	$tmp_formUnique = $oUSER->generateNewKey(4);
	require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/search/search.mobi.inc.php');
	require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/nav/dashboard.mobi.inc.php');
	require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/header/header.mobi.inc.php');
	
	$tmp_duedate = date("m/d/Y", strtotime($tmp_kivotosData['DUE_DATE']));
	$tmp_testYear = date("Y", strtotime($tmp_kivotosData['DUE_DATE']));
	if($tmp_testYear<1970){
		$tmp_duedate = "";
	}
	?>
    
    <!-- 
    //
    // BEGIN MAIN CONTENT -->
	<div role="main" class="ui-content">
		
        <div style="padding:5px;">Due Date for <?php echo $tmp_kivotosData['NAME']; ?>:</div>
      	<form action="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."dashboard/kivotos/?kid=".$tmp_kid; ?>" method="post" name="select_duedate" id="select_duedate"  enctype="multipart/form-data" data-ajax="false">				
            <input type="text" name="duedate" id="duedate" data-role="date" value="<?php echo $tmp_duedate; ?>">
            <div class="frm_errstatus duedate" style="width:100%; display:none;"><?php echo $oUSER->getLangElem('TEXT_REQUIRED'); ?></div>
            <div class="cb_10"></div>
            <button class="ui-shadow ui-btn ui-corner-all" type="submit" id="submit">UPDATE DUE DATE</button>
            <div class="cb_10"></div>
            <a class="ui-btn ui-shadow ui-corner-all" href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>dashboard/kivotos/?kid=<?php echo $tmp_kivotosData['KIVOTOS_ID']; ?>" data-ajax="false"><?php echo $oUSER->getLangElem('BUTTON_MOBI_CANCEL'); ?></a>
		
            <input type="hidden" name="postid" value="select_duedate">
            <input type="hidden" name="kivotosname" value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt($tmp_kivotosData['NAME']); ?>">
            <input type="hidden" name="kid" value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt($tmp_kivotosData['KIVOTOS_ID']); ?>">
            <input type="hidden" name="cid" value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt($tmp_kivotosData['CLIENT_ID']); ?>">
            
        </form>
		
    </div><!-- /content -->
 
	<script type="application/javascript" language="javascript">
	$( "#select_duedate" ).submit(function( event ) {
		//
		// VALIDATE FORM
		return validateForm('select_duedate');
	});
	
	</script>
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
            <div class="evif_logo_form"><img src="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/evifweb_logo_sm.gif" width="42" height="23" alt="eVifweb" title="5"></div>
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
