<?php
/* 
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
include_once($CRNRSTN_ROOT . '_crnrstn.config.inc.php');

$utype="auth=admin";
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/security/secure.inc.php');
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/session/session.inc.php');
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/language/lang.inc.php');

//
// LANGUAGE SUPPORT
$oUSER->prepLangElem('ERR_REQ_FNAME|SITE_TITLE|SITE_TITLE_STYLED|SITE_FOOTER_RIGHTS|SITE_TITLE_WEB_DEV|SITE_TITLE_DIGIT_MARKET|SITE_TITLE_AND|COMBO_SEL_DEVICE_MOBILE|COMBO_SEL_DEVICE_DESKTOP');

//
// LOAD DEVICE DETECT AFTER LANGUAGE PACK PREPPED FOR POPULATION OF COMBO COPY WITH LANG DATA
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/device/detect.inc.php');


$adminContent_ARRAY = $oUSER->getLangData();
$tmp_LangData = array();

$queryIndex_ARRAY = array('sys_lang_type_LANG_ID' => 0,'sys_lang_type_COUNTRY_ISO_CODE' => 1,
					'sys_lang_type_COUNTRY_ISO_NAME' => 2,'sys_lang_type_NATIVE_NAME' => 3, 'sys_lang_type_NATIVE_NAME_BLOB' => 4,
					'sys_lang_type_RTL_FLAG' => 5,'sys_lang_type_DATEMODIFIED' => 6,'sys_lang_type_DATECREATED' => 7
					);

$tmp_cnt_eng = 0;
$tmp_cnt_foreign = 0;
$tmp_loop_size = sizeof($adminContent_ARRAY);

for($i=0;$i<$tmp_loop_size;$i++){
	if(is_array($adminContent_ARRAY[$i])){

		//
		// CURRENT LANG IMPORTANT DATA
		if(sizeof($adminContent_ARRAY[$i])==8){
			$tmp_LangData['LANG_ID'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['sys_lang_type_LANG_ID']];
			$tmp_LangData['COUNTRY_ISO_CODE'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['sys_lang_type_COUNTRY_ISO_CODE']];
			$tmp_LangData['COUNTRY_ISO_NAME'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['sys_lang_type_COUNTRY_ISO_NAME']];
			$tmp_LangData['COUNTRY_NATIVE_NAME'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['sys_lang_type_NATIVE_NAME']];
			$tmp_LangData['NATIVE_NAME_BLOB'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['sys_lang_type_NATIVE_NAME_BLOB']];
			$tmp_LangData['RTL_FLAG'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['sys_lang_type_RTL_FLAG']];
		}

	}
}



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
<div id="form_shell" class="signin_shell">
	<div class="cb_30"></div>
	<div id="form_box">
    	<div class="evif_logo_form"><img src="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/evifweb_logo_sm.gif" width="42" height="23" alt="eVifweb" title="5"></div>
    	<div id="form_title">Translate Language Element</div>
    	<div class="cb_30"></div>
		<form action="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>dashboard/admin/lang/" method="post" name="edit_syslang" id="edit_syslang"  enctype="multipart/form-data" >
        	<div class="form_input_shell">
                <div id="isocode_form_element_label" class="form_element_label">country iso code <span class="req_star">*</span></div>
                <div class="form_element_input"><input frm_init="crnrstn_frm_handle" crnrstn_frm_valtype="required" name="isocode" type="text" id="isocode" size="20" maxlength="100" value="<?php echo $tmp_LangData['COUNTRY_ISO_CODE']; ?>" style="width:375px;" /></div>
                <div class="cb"></div>
                <div class="input_validation_copy_shell"><div id="isocode_input_validation_copy" class="input_validation_copy">Required</div></div>
                <div class="cb"></div>
            </div>
            <div class="cb_5"></div>
            
            <div class="form_input_shell">
                <div id="isoname_form_element_label" class="form_element_label">country iso name <span class="req_star">*</span></div>
                <div class="form_element_input"><input frm_init="crnrstn_frm_handle" crnrstn_frm_valtype="required" name="isoname" type="text" id="isoname" size="20" maxlength="100" value="<?php echo $tmp_LangData['COUNTRY_ISO_NAME']; ?>" style="width:375px;" /></div>
                <div class="cb"></div>
                <div class="input_validation_copy_shell"><div id="isoname_input_validation_copy" class="input_validation_copy">Required</div></div>
                <div class="cb"></div>
            </div>
            <div class="cb_5"></div>
            
            <div class="form_input_shell">
                <div id="nativename_form_element_label" class="form_element_label">native name <span class="req_star">*</span></div>
                <div class="form_element_input"><input frm_init="crnrstn_frm_handle" crnrstn_frm_valtype="required" name="nativename" type="text" id="nativename" size="20" maxlength="100" value="<?php echo $tmp_LangData['COUNTRY_NATIVE_NAME']; ?>" style="width:375px;" /></div>
                <div class="cb"></div>
                <div class="input_validation_copy_shell"><div id="nativename_input_validation_copy" class="input_validation_copy">Required</div></div>
                <div class="cb"></div>
            </div>
            <div class="cb_5"></div>
            
        	<div id="chkbx_CHK_RTL" class="crnrstn_chkbx_wrapper" onClick="mycrnrstn_fhandler.crnrstn_chkbxSel(this,'CHK_RTL'); return false;">
                <div id="crnrstn_chkbx_CHK_RTL" class="crnrstn_chkbx"><img src="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/icon_sprite.gif" width="20" height="40" alt="CRNRSTN ::" title="CRNRSTN ::"></div>
                <div class="crnrstn_chkbx_copy">right to left</div>
            </div>

			<div class="cb_10"></div>
            <table cellpadding="0" cellspacing="0" border="0" style="width:390px;">
            <tr>
            	<td style="width:270px; padding-left:15px;"></td>
                <td>
                    <div id="submit_shell" class="form_submit_shell" style="width:150px;">
                        <div id="edit_syslang_submit_btn" class="form_submit_btn" onMouseOver="mycrnrstn_fhandler.submitBtnMouseOver(this); return false;" onMouseOut="mycrnrstn_fhandler.submitBtnMouseOut(this); return false;">SAVE</div>
                    </div>
            	</td>
            </tr>
            </table>

            <div class="cb_20"></div>
            <div class="hidden">
            	<input type="hidden" name="CHK_RTL" id="CHK_RTL" value="<?php echo $tmp_LangData['RTL_FLAG']; ?>">
                <input type="hidden" name="langid" id="langid" value="<?php echo $tmp_LangData['LANG_ID']; ?>">
                <input name="submitin" type="submit" value="submit" onClick="mycrnrstn_fhandler.formSubmit('edit_syslang'); return false;">
                <div id="login_main_errmsg"></div>
                <div id="feedback_max_char_cnt">2000</div>
            </div>
     
        </form>
    </div>
</div>
</main>

<?php
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/footer/ftr.inc.php');
?>
</body>
</html>
