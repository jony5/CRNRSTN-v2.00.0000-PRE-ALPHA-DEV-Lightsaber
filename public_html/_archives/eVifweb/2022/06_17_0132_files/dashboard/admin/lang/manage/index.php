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
$oUSER->prepLangElem('SITE_TITLE|SITE_TITLE_STYLED|SITE_FOOTER_RIGHTS|SITE_TITLE_WEB_DEV|SITE_TITLE_DIGIT_MARKET|SITE_TITLE_AND|COMBO_SEL_DEVICE_MOBILE|COMBO_SEL_DEVICE_DESKTOP');


//
// LOAD DEVICE DETECT AFTER LANGUAGE PACK PREPPED FOR POPULATION OF COMBO COPY WITH LANG DATA
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/device/detect.inc.php');

//
// RETRIEVE LANGUAGE ELEMENTS
$adminContent_ARRAY = $oUSER->getLangElements();
$tmp_LangData = array();
$tmp_ENG_LangData = array();
$tmp_FOREIGN_LangData = array();
/*
`sys_lang_elements_ELEMENT_ID`,`sys_lang_elements_COUNTRY_ISO_CODE`,`sys_lang_elements_ELEMENT_REF_KEY`,`sys_lang_elements_ELEMENT_CONTENT`,
					`sys_lang_elements_ELEMENT_NAME`,`sys_lang_elements_ELEMENT_DESCRIPTION`,`sys_lang_elements_DATEMODIFIED`,
					`sys_lang_elements_DATECREATED`
					
					
`sys_lang_type_LANG_ID`, `sys_lang_type_COUNTRY_ISO_CODE`, `sys_lang_type_COUNTRY_ISO_NAME`,
					`sys_lang_type_NATIVE_NAME`, `sys_lang_type_RTL_FLAG`, `sys_lang_type_DATEMODIFIED`, `sys_lang_type_DATECREATED`
					
					
`sys_lang_elements_ELEMENT_ID`,`sys_lang_elements_COUNTRY_ISO_CODE`,`sys_lang_elements_ISO_CODE_CRC32`, `sys_lang_elements_ELEMENT_REF_KEY`,`sys_lang_elements_ELEMENT_CONTENT`,
					`sys_lang_elements_ELEMENT_NAME`,`sys_lang_elements_ELEMENT_DESCRIPTION`,`sys_lang_elements_DATEMODIFIED`,
					`sys_lang_elements_DATECREATED`
*/

$queryIndex_ARRAY = array('sys_lang_elements_ELEMENT_ID' => 0,'sys_lang_elements_COUNTRY_ISO_CODE' => 1,
					'sys_lang_elements_ELEMENT_REF_KEY' => 2,'sys_lang_elements_ELEMENT_CONTENT' => 3, 'sys_lang_elements_ELEMENT_NAME' => 4,
					'sys_lang_elements_ELEMENT_DESCRIPTION' => 5,'sys_lang_elements_DATEMODIFIED' => 6,'sys_lang_elements_DATECREATED' => 7,
					
					'sys_lang_type_LANG_ID' => 0,'sys_lang_type_COUNTRY_ISO_CODE' => 1,
					'sys_lang_type_COUNTRY_ISO_NAME' => 2,'sys_lang_type_NATIVE_NAME' => 3, 'sys_lang_type_RTL_FLAG' => 4,
					'sys_lang_type_DATEMODIFIED' => 5,'sys_lang_type_DATECREATED' => 6,
					
					'sys_lang_EN_elements_ELEMENT_ID' => 0,'sys_lang_EN_elements_COUNTRY_ISO_CODE' => 1,
					'sys_lang_EN_elements_ISO_CODE_CRC32' => 2,'sys_lang_EN_elements_ELEMENT_REF_KEY' => 3, 'sys_lang_EN_elements_ELEMENT_CONTENT' => 4,
					'sys_lang_EN_elements_ELEMENT_NAME' => 5,'sys_lang_EN_elements_ELEMENT_DESCRIPTION' => 6,'sys_lang_EN_elements_DATEMODIFIED' => 7,
					'sys_lang_EN_elements_DATECREATED' => 8
					);


$tmp_cnt_eng = 0;
$tmp_cnt_foreign = 0;
$tmp_loop_size = sizeof($adminContent_ARRAY);

for($i=0;$i<$tmp_loop_size;$i++){
	if(is_array($adminContent_ARRAY[$i])){
		
		//
		// STORE CURRENT LANG ELEMENTS
		if(sizeof($adminContent_ARRAY[$i])==8){
			$tmp_FOREIGN_LangData[$tmp_cnt_foreign]['ELEMENT_ID'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['sys_lang_elements_ELEMENT_ID']];
			$tmp_FOREIGN_LangData[$tmp_cnt_foreign]['COUNTRY_ISO_CODE'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['sys_lang_elements_COUNTRY_ISO_CODE']];
			$tmp_FOREIGN_LangData[$tmp_cnt_foreign]['ELEMENT_REF_KEY'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['sys_lang_elements_ELEMENT_REF_KEY']];
			$tmp_FOREIGN_LangData[$tmp_cnt_foreign]['ELEMENT_CONTENT'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['sys_lang_elements_ELEMENT_CONTENT']];
			$tmp_FOREIGN_LangData[$tmp_cnt_foreign]['ELEMENT_NAME'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['sys_lang_elements_ELEMENT_NAME']];
			$tmp_FOREIGN_LangData[$tmp_cnt_foreign]['ELEMENT_DESCRIPTION'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['sys_lang_elements_ELEMENT_DESCRIPTION']];
			$tmp_FOREIGN_LangData[$tmp_cnt_foreign]['DATEMODIFIED'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['sys_lang_elements_DATEMODIFIED']];
			$tmp_FOREIGN_LangData[$tmp_cnt_foreign]['DATECREATED'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['sys_lang_elements_DATECREATED']];
			
			$tmp_cnt_foreign++;
		}
		
		
		//
		// CURRENT LANG IMPORTANT DATA
		if(sizeof($adminContent_ARRAY[$i])==7){
			$tmp_LangData['COUNTRY_ISO_NAME'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['sys_lang_type_COUNTRY_ISO_NAME']];
			$tmp_LangData['COUNTRY_NATIVE_NAME'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['sys_lang_type_NATIVE_NAME']];
			$tmp_LangData['COUNTRY_ISO_CODE'] = $adminContent_ARRAY[$i][$queryIndex_ARRAY['sys_lang_type_COUNTRY_ISO_CODE']];
		}
		
		//
		// RIP ALL ENG ELEMENT KEYS
		if(sizeof($adminContent_ARRAY[$i])==9){
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
<div id="dashboard_page_title">Language Administration :: <?php echo $tmp_LangData['COUNTRY_NATIVE_NAME']; ?>
<?php
	if($oCRNRSTN_ENV->oSESSION_MGR->getSessionParam('USER_PERMISSIONS_ID')=="420"){
		
		echo '<span style="font-size:12px;"><a href="'.$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'dashboard/admin/lang/manage/editlang/?isocode='.$tmp_LangData['COUNTRY_ISO_CODE'].'" target="_self">(edit)</a></span>';
	}

?>
</div>
<div class="cb_20"></div>
<?php 
if($oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, 'isocode')!='en'){
?>	
<div>Language Elements</div>
	
<?php	
}else{
?>
<div>Language Elements (<a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>dashboard/admin/lang/manage/new/?langid=<?php echo $oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, 'langid'); ?>&isocode=<?php echo $oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, 'isocode'); ?>" target="_self">New</a>)</div>

<?php
}
?>
<div class="cb_10"></div>
<div class="hr"></div>
<div class="cb_10"></div>
<table cellpadding="0" cellspacing="0" border="0" width="100%">
<tr>
	<td width="20%">Key</td>
    <td width="40%">Content</td>
    <td width="20%">Last Modified</td>
    <td width="20%">Created</td>
</tr>
<?php
$tmp_loop_size = sizeof($tmp_ENG_LangData);
for($i=0;$i<$tmp_loop_size;$i++){
	
	$tmp_matchFound = NULL;
	
	//
	// FOR EACH ENGLISH ELEMENT, CHECK ALL FOREIGN ELEMENTS. WHERE FOREIGN ELEMENTS MATCH ENGLISH...USE FOREIGN CONTENT.
	$tmp_queue_size = sizeof($tmp_FOREIGN_LangData);
	for($ii=0;$ii<$tmp_queue_size;$ii++){
		
		//
		// DO I HAVE COMPLETED LANG TRANSLATION?
		if($tmp_FOREIGN_LangData[$ii]['ELEMENT_REF_KEY'] == $tmp_ENG_LangData[$i]['ELEMENT_REF_KEY']){
			
			//
			// DISPLAY FOREIGN CONTENT
			#$tmp_ENG_LangData[$i]['ELEMENT_ID'] = $tmp_FOREIGN_LangData[$ii]['ELEMENT_ID'];
			$tmp_ENG_LangData[$i]['ELEMENT_CONTENT'] = $tmp_FOREIGN_LangData[$ii]['ELEMENT_CONTENT'];
			
			$tmp_ENG_LangData[$i]['DATEMODIFIED'] = $tmp_FOREIGN_LangData[$ii]['DATEMODIFIED'];
			$tmp_ENG_LangData[$i]['DATECREATED'] = $tmp_FOREIGN_LangData[$ii]['DATECREATED'];
			
			$tmp_matchFound = 1;
			
		}
		
	}
	
	if(!isset($tmp_matchFound)){
		$tmp_ENG_LangData[$i]['ELEMENT_CONTENT'] = "";
		$tmp_ENG_LangData[$i]['DATEMODIFIED'] = "";
		$tmp_ENG_LangData[$i]['DATECREATED'] = "";
		
	}
	
	echo '
<tr>
	<td><div class="txt_lang_data"><a href="'.$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'dashboard/admin/lang/manage/edit?elemid='.$tmp_ENG_LangData[$i]['ELEMENT_ID'].'&refkey='.$tmp_ENG_LangData[$i]['ELEMENT_REF_KEY'].'&isocode='.$oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, 'isocode').'" target="_self">'.$oUSER->maxCharOutput($tmp_ENG_LangData[$i]['ELEMENT_REF_KEY'], 50).'</a></div></td>
	<td><div class="txt_lang_data">'.$oUSER->maxCharOutput($tmp_ENG_LangData[$i]['ELEMENT_CONTENT'], 50).'</div></td>
	<td>'.$tmp_ENG_LangData[$i]['DATEMODIFIED'].'</td>
	<td>'.$tmp_ENG_LangData[$i]['DATECREATED'].'</td>
</tr>
';
	
	
	
//	if(sizeof($adminContent_ARRAY[$i])==9){
//	echo '
//<tr>
//	<td><a href="'.$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'dashboard/admin/lang/manage/edit?elemid='.$adminContent_ARRAY[$i][$queryIndex_ARRAY['sys_lang_elements_ELEMENT_ID']].'&refkey='.$adminContent_ARRAY[$i][$queryIndex_ARRAY['sys_lang_elements_ELEMENT_REF_KEY']].'" target="_self">'.$adminContent_ARRAY[$i][$queryIndex_ARRAY['sys_lang_elements_ELEMENT_REF_KEY']].'</a></td>
//	<td>'.$adminContent_ARRAY[$i][$queryIndex_ARRAY['sys_lang_elements_ELEMENT_CONTENT']].'</td>
//	<td>'.$adminContent_ARRAY[$i][$queryIndex_ARRAY['sys_lang_elements_DATEMODIFIED']].'</td>
//	<td>'.$adminContent_ARRAY[$i][$queryIndex_ARRAY['sys_lang_elements_DATECREATED']].'</td>
//</tr>
//';
//	}
}
?>
</table>




</main>

<?php
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/footer/ftr.inc.php');
?>
</body>
</html>
