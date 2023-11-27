<?php
/* 
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
include_once($CRNRSTN_ROOT . '_crnrstn.config.inc.php');

$utype="auth=admin";
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/security/secure.inc.php');
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/session/session.inc.php');

$adminContent_ARRAY = $oUSER->getLangElement();
$tmp_LangData = array();
$tmp_ENG_LangData = array();
$tmp_FOREIGN_LangData = array();

$queryIndex_ARRAY = array('sys_lang_elements_ELEMENT_ID' => 0,'sys_lang_elements_COUNTRY_ISO_CODE' => 1,
					'sys_lang_elements_ELEMENT_REF_KEY' => 2,'sys_lang_elements_ELEMENT_CONTENT' => 3, 'sys_lang_elements_ELEMENT_NAME' => 4,
					'sys_lang_elements_ELEMENT_DESCRIPTION' => 5,'sys_lang_elements_DATEMODIFIED' => 6,'sys_lang_elements_DATECREATED' => 7,
					
					'sys_lang_FOREIGN_elements_ELEMENT_ID' => 0,'sys_lang_FOREIGN_elements_COUNTRY_ISO_CODE' => 1,
					'sys_lang_FOREIGN_elements_ISO_CODE_CRC32' => 2,'sys_lang_FOREIGN_elements_ELEMENT_REF_KEY' => 3, 'sys_lang_FOREIGN_elements_ELEMENT_CONTENT' => 4,
					'sys_lang_FOREIGN_elements_ELEMENT_NAME' => 5,'sys_lang_FOREIGN_elements_ELEMENT_DESCRIPTION' => 6,'sys_lang_FOREIGN_elements_DATEMODIFIED' => 7,
					'sys_lang_FOREIGN_elements_DATECREATED' => 8
					);

$tmp_cnt_eng = 0;
$tmp_cnt_foreign = 0;
$tmp_loop_size = sizeof($adminContent_ARRAY);

for($i=0;$i<$tmp_loop_size;$i++){
	if(is_array($adminContent_ARRAY[$i])){
		
		//
		// STORE CURRENT LANG ELEMENTS
		if(sizeof($adminContent_ARRAY[$i])==9){
			$tmp_FOREIGN_LangData[$tmp_cnt_foreign]['ELEMENT_ID'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['sys_lang_FOREIGN_elements_ELEMENT_ID']];
			$tmp_FOREIGN_LangData[$tmp_cnt_foreign]['COUNTRY_ISO_CODE'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['sys_lang_FOREIGN_elements_COUNTRY_ISO_CODE']];
			$tmp_FOREIGN_LangData[$tmp_cnt_foreign]['ELEMENT_REF_KEY'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['sys_lang_FOREIGN_elements_ELEMENT_REF_KEY']];
			$tmp_FOREIGN_LangData[$tmp_cnt_foreign]['ELEMENT_CONTENT'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['sys_lang_FOREIGN_elements_ELEMENT_CONTENT']];
			$tmp_FOREIGN_LangData[$tmp_cnt_foreign]['ELEMENT_NAME'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['sys_lang_FOREIGN_elements_ELEMENT_NAME']];
			$tmp_FOREIGN_LangData[$tmp_cnt_foreign]['ELEMENT_DESCRIPTION'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['sys_lang_FOREIGN_elements_ELEMENT_DESCRIPTION']];
			$tmp_FOREIGN_LangData[$tmp_cnt_foreign]['DATEMODIFIED'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['sys_lang_FOREIGN_elements_DATEMODIFIED']];
			$tmp_FOREIGN_LangData[$tmp_cnt_foreign]['DATECREATED'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['sys_lang_FOREIGN_elements_DATECREATED']];
			
			$tmp_cnt_foreign++;
		}
		
		//
		// CURRENT LANG IMPORTANT DATA
		if(sizeof($adminContent_ARRAY[$i])==7){
			$tmp_LangData['COUNTRY_ISO_NAME'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['sys_lang_type_COUNTRY_ISO_NAME']];
			$tmp_LangData['COUNTRY_NATIVE_NAME'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['sys_lang_type_NATIVE_NAME']];
		}
		
		//
		// RIP ALL ENG ELEMENT KEYS
		if(sizeof($adminContent_ARRAY[$i])==8){
			$tmp_ENG_LangData[$tmp_cnt_eng]['ELEMENT_ID'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['sys_lang_EN_elements_ELEMENT_ID']];
			$tmp_ENG_LangData[$tmp_cnt_eng]['COUNTRY_ISO_CODE'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['sys_lang_EN_elements_COUNTRY_ISO_CODE']];
			$tmp_ENG_LangData[$tmp_cnt_eng]['ELEMENT_REF_KEY'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['sys_lang_EN_elements_ELEMENT_REF_KEY']];
		
			$tmp_ENG_LangData[$tmp_cnt_eng]['DATEMODIFIED'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['sys_lang_EN_elements_ELEMENT_REF_KEY']];
			$tmp_ENG_LangData[$tmp_cnt_eng]['DATECREATED'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['sys_lang_EN_elements_ELEMENT_REF_KEY']];
			
			$tmp_cnt_eng++;
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
		<?php
		if($oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, 'isocode')=='en'){
		?>
        <form action="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>dashboard/admin/lang/manage/?isocode=<?php echo $adminContent_ARRAY[0][$queryIndex_ARRAY['sys_lang_elements_COUNTRY_ISO_CODE']]; ?>" method="post" name="edit_langelement" id="edit_langelement"  enctype="multipart/form-data" >
        	<div class="form_input_shell">
                <div id="elementname_form_element_label" class="form_element_label">element name</div>
                <div class="form_element_input"><input frm_init="crnrstn_frm_handle" crnrstn_frm_valtype="none" name="elementname" type="text" id="elementname" size="20" maxlength="100" value="<?php echo $adminContent_ARRAY[0][$queryIndex_ARRAY['sys_lang_elements_ELEMENT_NAME']]; ?>" style="width:375px;" /></div>
                <div class="cb"></div>
                <div class="input_validation_copy_shell"><div id="elementname_input_validation_copy" class="input_validation_copy">Required</div></div>
                <div class="cb"></div>
            </div>
            <div class="cb_5"></div>
            
            <div class="form_input_shell">
                <div id="elementdescript_form_element_label" class="form_element_label">element description</div>
                <div class="form_element_input"><textarea frm_init="crnrstn_frm_handle" crnrstn_frm_valtype="none" name="elementdescript" type="text" id="elementdescript" rows="4" wrap="off" style="width:375px;"><?php echo $adminContent_ARRAY[0][$queryIndex_ARRAY['sys_lang_elements_ELEMENT_DESCRIPTION']]; ?></textarea></div>
                <div class="cb"></div>
                <div class="input_validation_copy_shell"><div id="elementdescript_input_validation_copy" class="input_validation_copy">Required</div></div>
                <div class="cb"></div>
            </div>
            <div class="cb_5"></div>
            
            <div class="form_input_shell">
                <div id="refkey_form_element_label" class="form_element_label">element reference key <span class="req_star">*</span></div>
                <div class="form_element_input"><input frm_init="crnrstn_frm_handle" crnrstn_frm_valtype="required" name="refkey" type="text" id="refkey" size="20" maxlength="100" value="<?php echo $adminContent_ARRAY[0][$queryIndex_ARRAY['sys_lang_elements_ELEMENT_REF_KEY']]; ?>" style="width:375px;" /></div>
                <div class="cb"></div>
                <div class="input_validation_copy_shell"><div id="refkey_input_validation_copy" class="input_validation_copy">Required</div></div>
                <div class="cb"></div>
            </div>
            <div class="cb_5"></div>
            
           <div class="form_input_shell">
                <div id="elementcontent_form_element_label" class="form_element_label">element content <span class="req_star">*</span></div>
                <div class="form_element_input"><textarea frm_init="crnrstn_frm_handle" crnrstn_frm_valtype="required" name="elementcontent" type="text" id="elementcontent" rows="4" wrap="off"  style="width:375px;"><?php echo $adminContent_ARRAY[0][$queryIndex_ARRAY['sys_lang_elements_ELEMENT_CONTENT']]; ?></textarea></div>
                <div class="cb"></div>
                <div class="input_validation_copy_shell"><div id="elementcontent_input_validation_copy" class="input_validation_copy">Required</div></div>
                <div class="cb"></div>
            </div>
            <div class="cb_5"></div>

			<div class="cb_10"></div>
            <table cellpadding="0" cellspacing="0" border="0" style="width:390px;">
            <tr>
            	<td style="width:270px; padding-left:15px;"></td>
                <td>
                    <div id="submit_shell" class="form_submit_shell" style="width:150px;">
                        <div id="edit_langelement_submit_btn" class="form_submit_btn" onMouseOver="mycrnrstn_fhandler.submitBtnMouseOver(this); return false;" onMouseOut="mycrnrstn_fhandler.submitBtnMouseOut(this); return false;">SAVE</div>
                    </div>
            	</td>
            </tr>
            </table>

            <div class="cb_20"></div>
            <div class="hidden">
            	<input type="hidden" name="elemid" id="elemid" value="<?php echo $oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, 'elemid'); ?>">
                <input type="hidden" name="isocode" id="isocode" value="<?php echo $adminContent_ARRAY[0][$queryIndex_ARRAY['sys_lang_elements_COUNTRY_ISO_CODE']]; ?>">
                <input name="submitin" type="submit" value="submit" onClick="mycrnrstn_fhandler.formSubmit('edit_langelement'); return false;">
                <div id="login_main_errmsg"></div>
                <div id="feedback_max_char_cnt">2000</div>
            </div>
        </form>
        
        <?php
		}else{
		?>
		Here is the english content that needs to be translated ::<br><br><span class="original_content"><?php echo $adminContent_ARRAY[0][$queryIndex_ARRAY['sys_lang_elements_ELEMENT_CONTENT']]; ?></span><br><br>
<form action="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>dashboard/admin/lang/manage/?isocode=<?php echo $oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, 'isocode'); ?>" method="post" name="edit_langelement" id="edit_langelement"  enctype="multipart/form-data" >

           <div class="form_input_shell">
                <div id="elementcontent_form_element_label" class="form_element_label">translated content <span class="req_star">*</span></div>
                <div class="form_element_input"><textarea frm_init="crnrstn_frm_handle" crnrstn_frm_valtype="required" name="elementcontent" type="text" id="elementcontent" rows="4" wrap="off"  style="width:400px; font-size:16px;"><?php echo $tmp_FOREIGN_LangData[0]['ELEMENT_CONTENT']; ?></textarea></div>
                <div class="cb"></div>
                <div class="input_validation_copy_shell"><div id="elementcontent_input_validation_copy" class="input_validation_copy">Required</div></div>
                <div class="cb"></div>
            </div>
            <div class="cb_5"></div>
			<div class="form_element_label">Description of content (<?php echo $adminContent_ARRAY[0][$queryIndex_ARRAY['sys_lang_elements_ELEMENT_NAME']]; ?>) being translated above ::</div>
            <em><?php echo $adminContent_ARRAY[0][$queryIndex_ARRAY['sys_lang_elements_ELEMENT_DESCRIPTION']]; ?></em>
			<div class="cb_10"></div>
            <div class="cb_10"></div>
            <table cellpadding="0" cellspacing="0" border="0" style="width:390px;">
            <tr>
            	<td style="width:270px;">
               		<div id="cancel_btn_shell" class="form_cancel_shell">
                    	<div id="edit_langelement_cancel_btn" class="form_cancel_btn" onClick="mycrnrstn_fhandler.cancelBtnClick('<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>dashboard/admin/lang/manage/?isocode=<?php echo $oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, 'isocode'); ?>');">CANCEL</div>
                	</div>
                
                </td>
                <td>
                    <div id="submit_shell" class="form_submit_shell" style="width:150px;">
                        <div id="edit_langelement_submit_btn" class="form_submit_btn" onMouseOver="mycrnrstn_fhandler.submitBtnMouseOver(this); return false;" onMouseOut="mycrnrstn_fhandler.submitBtnMouseOut(this); return false;">SAVE</div>
                    </div>
            	</td>
            </tr>
            </table>

            <div class="cb_20"></div>
            <div class="hidden">
            	<input type="hidden" name="refkey" id="refkey" value="<?php echo $adminContent_ARRAY[0][$queryIndex_ARRAY['sys_lang_elements_ELEMENT_REF_KEY']]; ?>">
                <input type="hidden" name="isocode" id="isocode" value="<?php echo $oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, 'isocode'); ?>">
            	<input type="hidden" name="elemid" id="elemid" value="<?php echo $tmp_FOREIGN_LangData[0]['ELEMENT_ID']; ?>">
                <input name="submitin" type="submit" value="submit" onClick="mycrnrstn_fhandler.formSubmit('edit_langelement'); return false;">
                <div id="login_main_errmsg"></div>
                <div id="feedback_max_char_cnt">2000</div>
            </div>
        </form>
			
			
			
			
			
		<?php	
		}
		?>
    </div>
</div>
</main>

<?php
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/footer/ftr.inc.php');
?>
</body>
</html>
