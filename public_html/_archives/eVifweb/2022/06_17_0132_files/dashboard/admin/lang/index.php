<?php
/* 
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
include_once($CRNRSTN_ROOT.'_crnrstn.config.inc.php');

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
// RETRIEVE SYS MESSAGES
$adminContent_ARRAY = $oUSER->getSystemLanguages();
$tmp_loop_size = sizeof($adminContent_ARRAY);

for($i=0;$i<$tmp_loop_size;$i++){
	if(is_array($adminContent_ARRAY[$i])){
	if(sizeof($adminContent_ARRAY[$i])==2){
		#error_log("lang (19) i[".$i."] item0[".$adminContent_ARRAY[$i][0]."] item1[".$adminContent_ARRAY[$i][1]."]");
		$tmp_LangElemCnt[$adminContent_ARRAY[$i][0]] = $adminContent_ARRAY[$i][1];
	}
	}
}


//
// BUILD DATA KEY ARRAY
/*
`sys_messages_MSG_KEYID`,`sys_messages_ISACTIVE`,`sys_messages_LANGCODE`,`sys_messages_MSG_NAME`,`sys_messages_MSG_SUBJECT`,`sys_messages_MSG_HTML`,`sys_messages_MSG_TEXT`,`sys_messages_MSG_DESCRIPTION`,`sys_messages_DATEMODIFIED`,`sys_messages_DATECREATED`
*/
$queryIndex_ARRAY = array('sys_lang_type_LANG_ID' => 0,'sys_lang_type_COUNTRY_ISO_CODE' => 1,
					'sys_lang_type_COUNTRY_ISO_NAME' => 2,'sys_lang_type_NATIVE_NAME' => 3, 'sys_lang_type_RTL_FLAG' => 4,
					'sys_lang_type_DATEMODIFIED' => 5,'sys_lang_type_DATECREATED' => 6, 'sys_lang_elements_COUNTRY_ISO_CODE' => 0,
					'sys_lang_elements_ELEMENTS' => 1
					);
					
					
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
	<div id="dashboard_page_title">system languages</div>
    <div class="cb_10"></div>
    <?php  
	//
	// ME ONLY CONTENT
	if($oCRNRSTN_ENV->oSESSION_MGR->getSessionParam('USER_PERMISSIONS_ID')=="420"){
	?>
    <div><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>dashboard/admin/lang/new/">New language</a></div>
    <?php
	}
	?>
    <div class="cb_10"></div>
    
    <table cellpadding="0" cellspacing="0" border="0" width="100%">
    <tr>
        <td width="20%"><span class="tbl_title">ISO Language Name</span></td>
        <td width="25%"><span class="tbl_title">Native Name (endonym)</span></td>
        <td width="25%"><span class="tbl_title">Site Elements</span></td>
        <td width="15%"><span class="tbl_title">Date Modified</span></td>
        <td width="15%"><span class="tbl_title">Date Created</span></td>
    </tr>
    <tr>
        <td width="20%" style="line-height:8px;"><span class="tbl_title">&nbsp;</span></td>
        <td width="25%" style="line-height:8px;"><span class="tbl_title">&nbsp;</span></td>
        <td width="25%" style="line-height:8px;"><span class="tbl_title">&nbsp;</span></td>
        <td width="15%" style="line-height:8px;"><span class="tbl_title">&nbsp;</span></td>
        <td width="15%" style="line-height:8px;"><span class="tbl_title">&nbsp;</span></td>
    </tr>
    <?php
	$tmp_loop_size = sizeof($adminContent_ARRAY);
	
    for($i=0;$i<$tmp_loop_size;$i++){
	if(sizeof($adminContent_ARRAY[$i])>2){
		
	if(!isset($tmp_rowstyle)){
		$tmp_rowstyle = NULL;	
	}
	
    if($tmp_rowstyle!='' || $i<1){
        $tmp_rowstyle = '';
        $tmp_tblstyle = '';
    }else{
        $tmp_rowstyle = ' style="background-color:#C7CBF1; line-height:25px;"';
        $tmp_tblstyle = ' style="padding:3px 0 3px 0;"';
    }
    ?>
    <tr <?php echo $tmp_rowstyle; ?>>
        <td><span class="tbl_content" style="padding-left:4px;"><strong><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'dashboard/admin/lang/manage/?isocode='.$adminContent_ARRAY[$i][$queryIndex_ARRAY['sys_lang_type_COUNTRY_ISO_CODE']]; ?>" target="_self"><?php echo $adminContent_ARRAY[$i][$queryIndex_ARRAY['sys_lang_type_COUNTRY_ISO_NAME']]; ?></a></strong></span></td>
        <td>
            <span class="tbl_content"><?php echo $adminContent_ARRAY[$i][$queryIndex_ARRAY['sys_lang_type_NATIVE_NAME']]; ?></span>
        </td>
        <td><?php 
		if(isset($tmp_LangElemCnt[$adminContent_ARRAY[$i][$queryIndex_ARRAY['sys_lang_type_COUNTRY_ISO_CODE']]])){
		
			echo $tmp_LangElemCnt[$adminContent_ARRAY[$i][$queryIndex_ARRAY['sys_lang_type_COUNTRY_ISO_CODE']]];
		
		}else{
			echo "0";	
		}
		
		?> translated elements</td>
        <td><span class="tbl_content"><?php echo date("m.d.Y", strtotime($adminContent_ARRAY[$i][$queryIndex_ARRAY['sys_lang_type_DATEMODIFIED']])); ?></span></td>
        <td><span class="tbl_content"><?php echo date("m.d.Y", strtotime($adminContent_ARRAY[$i][$queryIndex_ARRAY['sys_lang_type_DATECREATED']])); ?></span></td>
    </tr>
    <tr><td colspan="4" style="line-height:5px;">&nbsp;</td></tr>
        
    <?php
    }
	}
    ?>
    
    </table>
</div>
</main>

<?php
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/footer/ftr.inc.php');
?>
</body>
</html>
