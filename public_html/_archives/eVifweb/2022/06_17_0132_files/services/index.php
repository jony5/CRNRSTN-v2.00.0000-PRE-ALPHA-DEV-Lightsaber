<?php
/* 
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
include_once($CRNRSTN_ROOT . '_crnrstn.config.inc.php');
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/session/session.inc.php');
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/language/lang.inc.php');

//
// LANGUAGE SUPPORT
$tmp_lang_elem = 'SITE_TITLE|SITE_FOOTER_RIGHTS|SITE_TITLE_WEB_DEV|SITE_TITLE_DIGIT_MARKET|SITE_TITLE_AND|ERR_REQ_EMAIL|ERR_VALID_EMAIL|ERR_REQ_FNAME|ERR_REQ_LNAME|TITLE_WEBSITE_DEVELOPMENT|TITLE_CONTACT|TITLE_DIGITAL_MARKETING|LIST_COPY_WRITING|LIST_WP_INTEGRATE';
$tmp_lang_elem .= '|LIST_APPLICATION_DEV|LIST_BROWSER_TEST|LIST_REPORTING|LIST_MOBILE|LIST_SOAP|LIST_REDESIGN|LIST_MIGRATE|LIST_BACKUP|LIST_SEO|LIST_OPTIN|LIST_GATEWAY|LIST_SOCIAL|LIST_SHOPPING_ABANDON|LIST_CMS|LIST_CREATIVE|LIST_EXTRANET';
$tmp_lang_elem .= '|LIST_MSG_COPY|LIST_DATA_CAPTURE|LIST_EMAIL_DESIGN|LIST_DISTRIBUTION|LIST_CODING|LIST_TRIGGERS|LIST_CAMPAIGN_MGMT|LIST_LANDING_PAGE|LIST_PERF_ANALYSIS|LIST_IP_REP|LIST_FTAF|LIST_SEGMENTATION|TEXT_LOWERCASE_EMAIL|BUTTON_MOBI_CLOSE';
$tmp_lang_elem .= '|TEXT_CHARACTERS_REMAINING|INPUT_TITLE_FIRST_NAME|INPUT_TITLE_LAST_NAME|INPUT_TITLE_MOBILE_NUMBER|TEXT_STRENGTHEN_WEB|TEXT_MARKETING_SERVICES|INPUT_TITLE_OPT_MESSAGE|BUTTON_CONTACT_US|TITLE_CONTACT_US|BUTTON_MOBI_CANCEL|COMBO_SEL_DEVICE_MOBILE|COMBO_SEL_DEVICE_DESKTOP';

$oUSER->prepLangElem($tmp_lang_elem);

//
// LOAD DEVICE DETECT AFTER LANGUAGE PACK PREPPED FOR POPULATION OF COMBO COPY WITH LANG DATA
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/device/detect.inc.php');

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
	require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/nav/main.mobi.inc.php');
	require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/contact/contact.mobi.inc.php');
	require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/header/header_unauth.mobi.inc.php');
	?>
    
    <!-- 
    //
    // BEGIN MAIN CONTENT -->
	<div role="main" class="ui-content">
		<h1><?php echo $oUSER->getLangElem('TITLE_SERVICES'); ?></h1>
        <p><?php echo $oUSER->getLangElem('TEXT_SERVICES_SOME'); ?></p>
      	<div class="cb_10"></div>
        
        <div class="ui-corner-all custom-corners">
            <div class="ui-bar ui-bar-b">
                <h3><?php echo $oUSER->getLangElem('TITLE_WEBSITE_DEVELOPMENT'); ?></h3>
                
            </div>
            <div class="ui-body ui-body-a">
                <ul data-role="listview" data-filter="true" data-filter-placeholder="Search website development services..." data-inset="true">
                    <li><?php echo $oUSER->getLangElem('LIST_COPY_WRITING'); ?></li>
                    <li><?php echo $oUSER->getLangElem('LIST_WP_INTEGRATE'); ?></li>
                    <li><?php echo $oUSER->getLangElem('LIST_APPLICATION_DEV'); ?></li>
                    <li><?php echo $oUSER->getLangElem('LIST_BROWSER_TEST'); ?></li>
                    <li><?php echo $oUSER->getLangElem('LIST_REPORTING'); ?></li>
                    <li><?php echo $oUSER->getLangElem('LIST_MOBILE'); ?></li>
                    <li><?php echo $oUSER->getLangElem('LIST_SOAP'); ?></li>
                    <li><?php echo $oUSER->getLangElem('LIST_REDESIGN'); ?></li>
                    <li><?php echo $oUSER->getLangElem('LIST_MIGRATE'); ?></li>
                    <li><?php echo $oUSER->getLangElem('LIST_BACKUP'); ?></li>
                    <li><?php echo $oUSER->getLangElem('LIST_SEO'); ?></li>
                    <li><?php echo $oUSER->getLangElem('LIST_OPTIN'); ?></li>
                    <li><?php echo $oUSER->getLangElem('LIST_GATEWAY'); ?></li>
                    <li><?php echo $oUSER->getLangElem('LIST_SOCIAL'); ?></li>
                    <li><?php echo $oUSER->getLangElem('LIST_SHOPPING_ABANDON'); ?></li>
                    <li><?php echo $oUSER->getLangElem('LIST_CMS'); ?></li>
                    <li><?php echo $oUSER->getLangElem('LIST_CREATIVE'); ?></li>
                    <li><?php echo $oUSER->getLangElem('LIST_EXTRANET'); ?></li>
                </ul>
            </div>
        </div>
        
        <div class="ui-corner-all custom-corners">
            <div class="ui-bar ui-bar-b">
                <h3><?php echo $oUSER->getLangElem('TITLE_DIGITAL_MARKETING'); ?></h3>
            </div>
            <div class="ui-body ui-body-a">
                <ul data-role="listview" data-filter="true" data-filter-placeholder="Search digital marketing services..." data-inset="true">
                    <li><?php echo $oUSER->getLangElem('LIST_MSG_COPY'); ?></li>
                    <li><?php echo $oUSER->getLangElem('LIST_DATA_CAPTURE'); ?></li>
                    <li><?php echo $oUSER->getLangElem('LIST_EMAIL_DESIGN'); ?></li>
                    <li><?php echo $oUSER->getLangElem('LIST_DISTRIBUTION'); ?></li>
                    <li><?php echo $oUSER->getLangElem('LIST_CODING'); ?></li>
                    <li><?php echo $oUSER->getLangElem('LIST_TRIGGERS'); ?></li>
                    <li><?php echo $oUSER->getLangElem('LIST_CAMPAIGN_MGMT'); ?></li>
                    <li><?php echo $oUSER->getLangElem('LIST_LANDING_PAGE'); ?></li>
                    <li><?php echo $oUSER->getLangElem('LIST_PERF_ANALYSIS'); ?></li>
                    <li><?php echo $oUSER->getLangElem('LIST_SOCIAL'); ?></li>
                    <li><?php echo $oUSER->getLangElem('LIST_IP_REP'); ?></li>
                    <li><?php echo $oUSER->getLangElem('LIST_FTAF'); ?></li>
                    <li><?php echo $oUSER->getLangElem('LIST_SEGMENTATION'); ?></li>
                </ul>
            </div>
        </div>
        
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
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/nav/main.inc.php');
?>


<main id="content">
<div class="bold_block_quote"><?php echo $oUSER->getLangElem('TITLE_WEBSITE_DEVELOPMENT'); ?></div>
<table cellpadding="0" cellspacing="0" border="0" style="width:100%;">
<tr>
	<td style="width:50%;">
        <div id="chkbx_CHK_COPYWRITING" class="crnrstn_chkbx_wrapper" onClick="mycrnrstn_fhandler.crnrstn_chkbxSel(this,'CHK_COPYWRITING'); return false;">
            <div id="crnrstn_chkbx_CHK_COPYWRITING" class="crnrstn_chkbx"><img src="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/icon_sprite.gif" width="20" height="40" alt="CRNRSTN ::" title="CRNRSTN ::"></div>
            <div class="crnrstn_chkbx_copy"><?php echo $oUSER->getLangElem('LIST_COPY_WRITING'); ?></div>
        </div>
    </td>
    <td>
        <div id="chkbx_CHK_WP_INTEGRATIONS" class="crnrstn_chkbx_wrapper" onClick="mycrnrstn_fhandler.crnrstn_chkbxSel(this,'CHK_WP_INTEGRATIONS'); return false;">
            <div id="crnrstn_chkbx_CHK_WP_INTEGRATIONS" class="crnrstn_chkbx"><img src="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/icon_sprite.gif" width="20" height="40" alt="CRNRSTN ::" title="CRNRSTN ::"></div>
            <div class="crnrstn_chkbx_copy"><?php echo $oUSER->getLangElem('LIST_WP_INTEGRATE'); ?></div>
        </div>
    </td>
</tr>
<tr>
	<td>
        <div id="chkbx_CHK_APP_DEV" class="crnrstn_chkbx_wrapper" onClick="mycrnrstn_fhandler.crnrstn_chkbxSel(this,'CHK_APP_DEV'); return false;">
            <div id="crnrstn_chkbx_CHK_APP_DEV" class="crnrstn_chkbx"><img src="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/icon_sprite.gif" width="20" height="40" alt="CRNRSTN ::" title="CRNRSTN ::"></div>
            <div class="crnrstn_chkbx_copy"><?php echo $oUSER->getLangElem('LIST_APPLICATION_DEV'); ?></div>
        </div>
    </td>
    <td>
        <div id="chkbx_CHK_BROWSER_TESTING" class="crnrstn_chkbx_wrapper" onClick="mycrnrstn_fhandler.crnrstn_chkbxSel(this,'CHK_BROWSER_TESTING'); return false;">
            <div id="crnrstn_chkbx_CHK_BROWSER_TESTING" class="crnrstn_chkbx"><img src="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/icon_sprite.gif" width="20" height="40" alt="CRNRSTN ::" title="CRNRSTN ::"></div>
            <div class="crnrstn_chkbx_copy"><?php echo $oUSER->getLangElem('LIST_BROWSER_TEST'); ?></div>
        </div>
    </td>
</tr>
<tr>
	<td>
        <div id="chkbx_CHK_REPORTING_ANALYTICS" class="crnrstn_chkbx_wrapper" onClick="mycrnrstn_fhandler.crnrstn_chkbxSel(this,'CHK_REPORTING_ANALYTICS'); return false;">
            <div id="crnrstn_chkbx_CHK_REPORTING_ANALYTICS" class="crnrstn_chkbx"><img src="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/icon_sprite.gif" width="20" height="40" alt="CRNRSTN ::" title="CRNRSTN ::"></div>
            <div class="crnrstn_chkbx_copy"><?php echo $oUSER->getLangElem('LIST_REPORTING'); ?></div>
        </div>
    </td>
    <td>
        <div id="chkbx_CHK_MOBILE" class="crnrstn_chkbx_wrapper" onClick="mycrnrstn_fhandler.crnrstn_chkbxSel(this,'CHK_MOBILE'); return false;">
            <div id="crnrstn_chkbx_CHK_MOBILE" class="crnrstn_chkbx"><img src="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/icon_sprite.gif" width="20" height="40" alt="CRNRSTN ::" title="CRNRSTN ::"></div>
            <div class="crnrstn_chkbx_copy"><?php echo $oUSER->getLangElem('LIST_MOBILE'); ?></div>
        </div>
    </td>
</tr>
<tr>
	<td>
        <div id="chkbx_CHK_SOAP" class="crnrstn_chkbx_wrapper" onClick="mycrnrstn_fhandler.crnrstn_chkbxSel(this,'CHK_SOAP'); return false;">
            <div id="crnrstn_chkbx_CHK_SOAP" class="crnrstn_chkbx"><img src="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/icon_sprite.gif" width="20" height="40" alt="CRNRSTN ::" title="CRNRSTN ::"></div>
            <div class="crnrstn_chkbx_copy"><?php echo $oUSER->getLangElem('LIST_SOAP'); ?></div>
        </div>
    </td>
    <td>
        <div id="chkbx_CHK_REDESIGN" class="crnrstn_chkbx_wrapper" onClick="mycrnrstn_fhandler.crnrstn_chkbxSel(this,'CHK_REDESIGN'); return false;">
            <div id="crnrstn_chkbx_CHK_REDESIGN" class="crnrstn_chkbx"><img src="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/icon_sprite.gif" width="20" height="40" alt="CRNRSTN ::" title="CRNRSTN ::"></div>
            <div class="crnrstn_chkbx_copy"><?php echo $oUSER->getLangElem('LIST_REDESIGN'); ?></div>
        </div>
    </td>
</tr>
<tr>
	<td>
        <div id="chkbx_CHK_MIGRATION" class="crnrstn_chkbx_wrapper" onClick="mycrnrstn_fhandler.crnrstn_chkbxSel(this,'CHK_MIGRATION'); return false;">
            <div id="crnrstn_chkbx_CHK_MIGRATION" class="crnrstn_chkbx"><img src="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/icon_sprite.gif" width="20" height="40" alt="CRNRSTN ::" title="CRNRSTN ::"></div>
            <div class="crnrstn_chkbx_copy"><?php echo $oUSER->getLangElem('LIST_MIGRATE'); ?></div>
        </div>
    </td>
    <td>
        <div id="chkbx_CHK_BACKUP" class="crnrstn_chkbx_wrapper" onClick="mycrnrstn_fhandler.crnrstn_chkbxSel(this,'CHK_BACKUP'); return false;">
            <div id="crnrstn_chkbx_CHK_BACKUP" class="crnrstn_chkbx"><img src="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/icon_sprite.gif" width="20" height="40" alt="CRNRSTN ::" title="CRNRSTN ::"></div>
            <div class="crnrstn_chkbx_copy"><?php echo $oUSER->getLangElem('LIST_BACKUP'); ?></div>
        </div>
    </td>
</tr>
	<td>
        <div id="chkbx_CHK_SEO" class="crnrstn_chkbx_wrapper" onClick="mycrnrstn_fhandler.crnrstn_chkbxSel(this,'CHK_SEO'); return false;">
            <div id="crnrstn_chkbx_CHK_SEO" class="crnrstn_chkbx"><img src="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/icon_sprite.gif" width="20" height="40" alt="CRNRSTN ::" title="CRNRSTN ::"></div>
            <div class="crnrstn_chkbx_copy"><?php echo $oUSER->getLangElem('LIST_SEO'); ?></div>
        </div>
    </td>
    <td>
        <div id="chkbx_CHK_OPTIN" class="crnrstn_chkbx_wrapper" onClick="mycrnrstn_fhandler.crnrstn_chkbxSel(this,'CHK_OPTIN'); return false;">
            <div id="crnrstn_chkbx_CHK_OPTIN" class="crnrstn_chkbx"><img src="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/icon_sprite.gif" width="20" height="40" alt="CRNRSTN ::" title="CRNRSTN ::"></div>
            <div class="crnrstn_chkbx_copy"><?php echo $oUSER->getLangElem('LIST_OPTIN'); ?></div>
        </div>
    </td>
</tr>
	<td>
        <div id="chkbx_CHK_GATEWAY" class="crnrstn_chkbx_wrapper" onClick="mycrnrstn_fhandler.crnrstn_chkbxSel(this,'CHK_GATEWAY'); return false;">
            <div id="crnrstn_chkbx_CHK_GATEWAY" class="crnrstn_chkbx"><img src="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/icon_sprite.gif" width="20" height="40" alt="CRNRSTN ::" title="CRNRSTN ::"></div>
            <div class="crnrstn_chkbx_copy"><?php echo $oUSER->getLangElem('LIST_GATEWAY'); ?></div>
        </div>
    </td>
    <td>
        <div id="chkbx_CHK_SOCIAL" class="crnrstn_chkbx_wrapper" onClick="mycrnrstn_fhandler.crnrstn_chkbxSel(this,'CHK_SOCIAL'); return false;">
            <div id="crnrstn_chkbx_CHK_SOCIAL" class="crnrstn_chkbx"><img src="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/icon_sprite.gif" width="20" height="40" alt="CRNRSTN ::" title="CRNRSTN ::"></div>
            <div class="crnrstn_chkbx_copy"><?php echo $oUSER->getLangElem('LIST_SOCIAL'); ?></div>
        </div>
    </td>
</tr>
	<td>
        <div id="chkbx_CHK_SCA" class="crnrstn_chkbx_wrapper" onClick="mycrnrstn_fhandler.crnrstn_chkbxSel(this,'CHK_SCA'); return false;">
            <div id="crnrstn_chkbx_CHK_SCA" class="crnrstn_chkbx"><img src="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/icon_sprite.gif" width="20" height="40" alt="CRNRSTN ::" title="CRNRSTN ::"></div>
            <div class="crnrstn_chkbx_copy"><?php echo $oUSER->getLangElem('LIST_SHOPPING_ABANDON'); ?></div>
        </div>
    </td>
    <td>
        <div id="chkbx_CHK_CMS" class="crnrstn_chkbx_wrapper" onClick="mycrnrstn_fhandler.crnrstn_chkbxSel(this,'CHK_CMS'); return false;">
            <div id="crnrstn_chkbx_CHK_CMS" class="crnrstn_chkbx"><img src="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/icon_sprite.gif" width="20" height="40" alt="CRNRSTN ::" title="CRNRSTN ::"></div>
            <div class="crnrstn_chkbx_copy"><?php echo $oUSER->getLangElem('LIST_CMS'); ?></div>
        </div>
    </td>
</tr>
	<td>
        <div id="chkbx_CHK_DESIGN" class="crnrstn_chkbx_wrapper" onClick="mycrnrstn_fhandler.crnrstn_chkbxSel(this,'CHK_DESIGN'); return false;">
            <div id="crnrstn_chkbx_CHK_DESIGN" class="crnrstn_chkbx"><img src="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/icon_sprite.gif" width="20" height="40" alt="CRNRSTN ::" title="CRNRSTN ::"></div>
            <div class="crnrstn_chkbx_copy"><?php echo $oUSER->getLangElem('LIST_CREATIVE'); ?></div>
        </div>
    </td>
    <td>
        <div id="chkbx_CHK_EXTRANET" class="crnrstn_chkbx_wrapper" onClick="mycrnrstn_fhandler.crnrstn_chkbxSel(this,'CHK_EXTRANET'); return false;">
            <div id="crnrstn_chkbx_CHK_EXTRANET" class="crnrstn_chkbx"><img src="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/icon_sprite.gif" width="20" height="40" alt="CRNRSTN ::" title="CRNRSTN ::"></div>
            <div class="crnrstn_chkbx_copy"><?php echo $oUSER->getLangElem('LIST_EXTRANET'); ?></div>
        </div>
    </td>
</tr>
</table>

<div class="bold_block_quote"><?php echo $oUSER->getLangElem('TITLE_DIGITAL_MARKETING'); ?></div>
<table cellpadding="0" cellspacing="0" border="0" style="width:100%;">
<tr>
	<td style="width:50%;">
        <div id="chkbx_CHK_EMAIL_COPYWRITING" class="crnrstn_chkbx_wrapper" onClick="mycrnrstn_fhandler.crnrstn_chkbxSel(this,'CHK_EMAIL_COPYWRITING'); return false;">
            <div id="crnrstn_chkbx_CHK_EMAIL_COPYWRITING" class="crnrstn_chkbx"><img src="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/icon_sprite.gif" width="20" height="40" alt="CRNRSTN ::" title="CRNRSTN ::"></div>
            <div class="crnrstn_chkbx_copy"><?php echo $oUSER->getLangElem('LIST_MSG_COPY'); ?></div>
        </div>
    </td>
    <td>
        <div id="chkbx_CHK_DATA_CAPTURE" class="crnrstn_chkbx_wrapper" onClick="mycrnrstn_fhandler.crnrstn_chkbxSel(this,'CHK_DATA_CAPTURE'); return false;">
            <div id="crnrstn_chkbx_CHK_DATA_CAPTURE" class="crnrstn_chkbx"><img src="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/icon_sprite.gif" width="20" height="40" alt="CRNRSTN ::" title="CRNRSTN ::"></div>
            <div class="crnrstn_chkbx_copy"><?php echo $oUSER->getLangElem('LIST_DATA_CAPTURE'); ?></div>
        </div>
    </td>
</tr>
<tr>
	<td style="width:50%;">
        <div id="chkbx_CHK_HTML_EMAIL_DES" class="crnrstn_chkbx_wrapper" onClick="mycrnrstn_fhandler.crnrstn_chkbxSel(this,'CHK_HTML_EMAIL_DES'); return false;">
            <div id="crnrstn_chkbx_CHK_HTML_EMAIL_DES" class="crnrstn_chkbx"><img src="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/icon_sprite.gif" width="20" height="40" alt="CRNRSTN ::" title="CRNRSTN ::"></div>
            <div class="crnrstn_chkbx_copy"><?php echo $oUSER->getLangElem('LIST_EMAIL_DESIGN'); ?></div>
        </div>
    </td>
    <td>
        <div id="chkbx_CHK_HYGENE" class="crnrstn_chkbx_wrapper" onClick="mycrnrstn_fhandler.crnrstn_chkbxSel(this,'CHK_HYGENE'); return false;">
            <div id="crnrstn_chkbx_CHK_HYGENE" class="crnrstn_chkbx"><img src="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/icon_sprite.gif" width="20" height="40" alt="CRNRSTN ::" title="CRNRSTN ::"></div>
            <div class="crnrstn_chkbx_copy"><?php echo $oUSER->getLangElem('LIST_DISTRIBUTION'); ?></div>
        </div>
    </td>
</tr>
<tr>
	<td style="width:50%;">
        <div id="chkbx_CHK_EMAIL_CODING" class="crnrstn_chkbx_wrapper" onClick="mycrnrstn_fhandler.crnrstn_chkbxSel(this,'CHK_EMAIL_CODING'); return false;">
            <div id="crnrstn_chkbx_CHK_EMAIL_CODING" class="crnrstn_chkbx"><img src="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/icon_sprite.gif" width="20" height="40" alt="CRNRSTN ::" title="CRNRSTN ::"></div>
            <div class="crnrstn_chkbx_copy"><?php echo $oUSER->getLangElem('LIST_CODING'); ?></div>
        </div>
    </td>
    <td>
        <div id="chkbx_CHK_AUTOMATION" class="crnrstn_chkbx_wrapper" onClick="mycrnrstn_fhandler.crnrstn_chkbxSel(this,'CHK_AUTOMATION'); return false;">
            <div id="crnrstn_chkbx_CHK_AUTOMATION" class="crnrstn_chkbx"><img src="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/icon_sprite.gif" width="20" height="40" alt="CRNRSTN ::" title="CRNRSTN ::"></div>
            <div class="crnrstn_chkbx_copy"><?php echo $oUSER->getLangElem('LIST_TRIGGERS'); ?></div>
        </div>
    </td>
</tr>
<tr>
	<td style="width:50%;">
        <div id="chkbx_CHK_CAMP_MGMT" class="crnrstn_chkbx_wrapper" onClick="mycrnrstn_fhandler.crnrstn_chkbxSel(this,'CHK_CAMP_MGMT'); return false;">
            <div id="crnrstn_chkbx_CHK_CAMP_MGMT" class="crnrstn_chkbx"><img src="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/icon_sprite.gif" width="20" height="40" alt="CRNRSTN ::" title="CRNRSTN ::"></div>
            <div class="crnrstn_chkbx_copy"><?php echo $oUSER->getLangElem('LIST_CAMPAIGN_MGMT'); ?></div>
        </div>
    </td>
    <td>
        <div id="chkbx_CHK_LP" class="crnrstn_chkbx_wrapper" onClick="mycrnrstn_fhandler.crnrstn_chkbxSel(this,'CHK_LP'); return false;">
            <div id="crnrstn_chkbx_CHK_LP" class="crnrstn_chkbx"><img src="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/icon_sprite.gif" width="20" height="40" alt="CRNRSTN ::" title="CRNRSTN ::"></div>
            <div class="crnrstn_chkbx_copy"><?php echo $oUSER->getLangElem('LIST_LANDING_PAGE'); ?></div>
        </div>
    </td>
</tr>
<tr>
	<td style="width:50%;">
        <div id="chkbx_CHK_CAMP_REPORTING" class="crnrstn_chkbx_wrapper" onClick="mycrnrstn_fhandler.crnrstn_chkbxSel(this,'CHK_CAMP_REPORTING'); return false;">
            <div id="crnrstn_chkbx_CHK_CAMP_REPORTING" class="crnrstn_chkbx"><img src="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/icon_sprite.gif" width="20" height="40" alt="CRNRSTN ::" title="CRNRSTN ::"></div>
            <div class="crnrstn_chkbx_copy"><?php echo $oUSER->getLangElem('LIST_PERF_ANALYSIS'); ?></div>
        </div>
    </td>
    <td>
        <div id="chkbx_CHK_EMAIL_SOCIAL" class="crnrstn_chkbx_wrapper" onClick="mycrnrstn_fhandler.crnrstn_chkbxSel(this,'CHK_EMAIL_SOCIAL'); return false;">
            <div id="crnrstn_chkbx_CHK_EMAIL_SOCIAL" class="crnrstn_chkbx"><img src="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/icon_sprite.gif" width="20" height="40" alt="CRNRSTN ::" title="CRNRSTN ::"></div>
            <div class="crnrstn_chkbx_copy"><?php echo $oUSER->getLangElem('LIST_SOCIAL'); ?></div>
        </div>
    </td>
</tr>
<tr>
	<td style="width:50%;">
        <div id="chkbx_CHK_IP_REP" class="crnrstn_chkbx_wrapper" onClick="mycrnrstn_fhandler.crnrstn_chkbxSel(this,'CHK_IP_REP'); return false;">
            <div id="crnrstn_chkbx_CHK_IP_REP" class="crnrstn_chkbx"><img src="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/icon_sprite.gif" width="20" height="40" alt="CRNRSTN ::" title="CRNRSTN ::"></div>
            <div class="crnrstn_chkbx_copy"><?php echo $oUSER->getLangElem('LIST_IP_REP'); ?></div>
        </div>
    </td>
    <td>
        <div id="chkbx_CHK_FTAF" class="crnrstn_chkbx_wrapper" onClick="mycrnrstn_fhandler.crnrstn_chkbxSel(this,'CHK_FTAF'); return false;">
            <div id="crnrstn_chkbx_CHK_FTAF" class="crnrstn_chkbx"><img src="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/icon_sprite.gif" width="20" height="40" alt="CRNRSTN ::" title="CRNRSTN ::"></div>
            <div class="crnrstn_chkbx_copy"><?php echo $oUSER->getLangElem('LIST_FTAF'); ?></div>
        </div>
    </td>
</tr>
<tr>
	<td style="width:50%;">
        <div id="chkbx_CHK_SEGMENTATION" class="crnrstn_chkbx_wrapper" onClick="mycrnrstn_fhandler.crnrstn_chkbxSel(this,'CHK_SEGMENTATION'); return false;">
            <div id="crnrstn_chkbx_CHK_SEGMENTATION" class="crnrstn_chkbx"><img src="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/icon_sprite.gif" width="20" height="40" alt="CRNRSTN ::" title="CRNRSTN ::"></div>
            <div class="crnrstn_chkbx_copy"><?php echo $oUSER->getLangElem('LIST_SEGMENTATION'); ?></div>
        </div>
    </td>
    <td>
    </td>
</tr>
</table>
<div class="cb_15"></div>
<div id="form_shell">
	<div id="form_box">
    	<div class="cb_10"></div>
        <div class="evif_logo_form"><img src="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/evifweb_logo_sm.gif" width="42" height="23" alt="eVifweb" title="5"></div>
    	<div id="form_title"><?php echo $oUSER->getLangElem('TITLE_CONTACT'); ?> <?php echo $oUSER->getLangElem('SITE_TITLE'); ?></div>
    	<div class="cb_30"></div>
    
        <form action="#" method="post" name="contact_home" id="contact_home"  enctype="multipart/form-data" >
            <div class="form_input_shell">
                <div id="fname_form_element_label" class="form_element_label"><?php echo $oUSER->getLangElem('INPUT_TITLE_FIRST_NAME'); ?> <span class="req_star">*</span></div>
                <div class="form_element_input"><input frm_init="crnrstn_frm_handle" crnrstn_frm_valtype="required" name="fname" type="text" id="fname" size="20" maxlength="100" value="" style="width:375px;" /></div>
                <div class="cb"></div>
                <div class="input_validation_copy_shell"><div id="fname_input_validation_copy" class="input_validation_copy">Required</div></div>
                <div class="cb"></div>
            </div>
            <div class="cb_5"></div>
            
            <div class="form_input_shell">
                <div id="lname_form_element_label" class="form_element_label"><?php echo $oUSER->getLangElem('INPUT_TITLE_LAST_NAME'); ?> <span class="req_star">*</span></div>
                <div class="form_element_input"><input frm_init="crnrstn_frm_handle" crnrstn_frm_valtype="required" name="lname" type="text" id="lname" size="20" maxlength="100" value="" style="width:375px;" /></div>
                <div class="cb"></div>
                <div class="input_validation_copy_shell"><div id="lname_input_validation_copy" class="input_validation_copy">Required</div></div>
                <div class="cb"></div>
            </div>
            <div class="cb_5"></div>
            
            <div class="form_input_shell">
                <div id="email_form_element_label" class="form_element_label"><?php echo ucfirst($oUSER->getLangElem('TEXT_LOWERCASE_EMAIL')); ?> <span class="req_star">*</span></div>
                <div class="form_element_input"><input frm_init="crnrstn_frm_handle" crnrstn_frm_valtype="email" name="email" type="text" id="email" size="20" maxlength="100" value="" style="width:375px;" /></div>
                <div class="cb"></div>
                <div class="input_validation_copy_shell"><div id="email_input_validation_copy" class="input_validation_copy">Required</div></div>
                <div class="cb"></div>
            </div>
            <div class="cb_5"></div>
    
            <div class="form_input_shell">
                <div id="mobilenumber_form_element_label" class="form_element_label"><?php echo $oUSER->getLangElem('INPUT_TITLE_MOBILE_NUMBER'); ?></div>
                <div class="form_element_input"><input frm_init="crnrstn_frm_handle" crnrstn_frm_valtype="none" name="mobilenumber" type="text" id="mobilenumber" size="20" maxlength="100" value="" style="width:375px;" /></div>
                <div class="cb"></div>
                <div class="input_validation_copy_shell"><div id="mobilenumber_input_validation_copy" class="input_validation_copy"></div></div>
                <div class="cb"></div>
            </div>
            <div class="cb_5"></div>
    
    		<table>
            <tr>
                <td>
                <div id="chkbx_INTEREST_WEB" class="crnrstn_chkbx_wrapper" onClick="mycrnrstn_fhandler.crnrstn_chkbxSel(this,'INTEREST_WEB'); return false;">
                    <div id="crnrstn_chkbx_INTEREST_WEB" class="crnrstn_chkbx"><img src="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/icon_sprite.gif" width="20" height="40" alt="CRNRSTN ::" title="CRNRSTN ::"></div>
                    <div class="crnrstn_chkbx_copy"><?php echo $oUSER->getLangElem('TEXT_STRENGTHEN_WEB'); ?></div>
                </div>
                </td>
            </tr>
            <tr>
                <td>
                <div id="chkbx_INTEREST_EMAIL" class="crnrstn_chkbx_wrapper" onClick="mycrnrstn_fhandler.crnrstn_chkbxSel(this,'INTEREST_EMAIL'); return false;">
                    <div id="crnrstn_chkbx_INTEREST_EMAIL" class="crnrstn_chkbx"><img src="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/icon_sprite.gif" width="20" height="40" alt="CRNRSTN ::" title="CRNRSTN ::"></div>
                    <div class="crnrstn_chkbx_copy"><?php echo $oUSER->getLangElem('TEXT_MARKETING_SERVICES'); ?></div>
                </div>
                </td>
            </tr>
            </table>
            <div class="cb_20"></div>
            <div id="feedback_form_element_label" class="form_element_label"><?php echo $oUSER->getLangElem('INPUT_TITLE_OPT_MESSAGE'); ?></div>
            <textarea frm_init="crnrstn_frm_handle" crnrstn_frm_valtype="ugc_feedback" name="feedback" id="feedback" rows="4" wrap="on" onKeyUp="mycrnrstn_fhandler.checklen(this, '2000', 'feedback_charCnt'); " style="width:375px; height:150px;"></textarea>
            
            <div id="feedback_charCnt" class="charCnt">2000 <?php echo $oUSER->getLangElem('TEXT_CHARACTERS_REMAINING'); ?></div>
            <div id="feedback_charCnt_copy" class="hidden"><?php echo $oUSER->getLangElem('TEXT_CHARACTERS_REMAINING'); ?></div>
            <div id="feedback_input_validation_copy"></div>
            <div class="cb_20"></div>
            <div id="submit_shell" class="form_submit_shell" style="width:160px;">
            <div id="contact_home_submit_btn" class="form_submit_btn" onMouseOver="mycrnrstn_fhandler.submitBtnMouseOver(this); return false;" onMouseOut="mycrnrstn_fhandler.submitBtnMouseOut(this); return false;"><?php echo $oUSER->getLangElem('BUTTON_CONTACT_US'); ?></div>
            </div>
            <div class="cb_40"></div>
            <div class="hidden">
                <input name="submitin" type="submit" value="submit" onClick="mycrnrstn_fhandler.formSubmit('contact_home'); return false;">
                <div id="login_main_errmsg"></div>
                <div id="feedback_max_char_cnt">2000</div>
            </div>
            
            <input type="hidden" name="INTEREST_WEB" id="INTEREST_WEB" value="0">
            <input type="hidden" name="INTEREST_EMAIL" id="INTEREST_EMAIL" value="0">
            <input type="hidden" name="CHK_COPYWRITING" id="CHK_COPYWRITING" value="0">
			<input type="hidden" name="CHK_WP_INTEGRATIONS" id="CHK_WP_INTEGRATIONS" value="0">
            <input type="hidden" name="CHK_APP_DEV" id="CHK_APP_DEV" value="0">
            <input type="hidden" name="CHK_BROWSER_TESTING" id="CHK_BROWSER_TESTING" value="0">
            <input type="hidden" name="CHK_REPORTING_ANALYTICS" id="CHK_REPORTING_ANALYTICS" value="0">
            <input type="hidden" name="CHK_MOBILE" id="CHK_MOBILE" value="0">
            <input type="hidden" name="CHK_SEO" id="CHK_SEO" value="0">
            <input type="hidden" name="CHK_SOAP" id="CHK_SOAP" value="0">
            <input type="hidden" name="CHK_REDESIGN" id="CHK_REDESIGN" value="0">
            <input type="hidden" name="CHK_MIGRATION" id="CHK_MIGRATION" value="0">
            <input type="hidden" name="CHK_BACKUP" id="CHK_BACKUP" value="0">
            <input type="hidden" name="CHK_OPTIN" id="CHK_OPTIN" value="0">
            <input type="hidden" name="CHK_GATEWAY" id="CHK_GATEWAY" value="0">
            <input type="hidden" name="CHK_SOCIAL" id="CHK_SOCIAL" value="0">
            <input type="hidden" name="CHK_SCA" id="CHK_SCA" value="0">
            <input type="hidden" name="CHK_CMS" id="CHK_CMS" value="0">
            <input type="hidden" name="CHK_DESIGN" id="CHK_DESIGN" value="0">
            <input type="hidden" name="CHK_EXTRANET" id="CHK_EXTRANET" value="0">
            
            <input type="hidden" name="CHK_EMAIL_COPYWRITING" id="CHK_EMAIL_COPYWRITING" value="0">
            <input type="hidden" name="CHK_DATA_CAPTURE" id="CHK_DATA_CAPTURE" value="0">
            <input type="hidden" name="CHK_HTML_EMAIL_DES" id="CHK_HTML_EMAIL_DES" value="0">
            <input type="hidden" name="CHK_HYGENE" id="CHK_HYGENE" value="0">
            <input type="hidden" name="CHK_EMAIL_CODING" id="CHK_EMAIL_CODING" value="0">
            <input type="hidden" name="CHK_AUTOMATION" id="CHK_AUTOMATION" value="0">
            <input type="hidden" name="CHK_CAMP_MGMT" id="CHK_CAMP_MGMT" value="0">
            <input type="hidden" name="CHK_LP" id="CHK_LP" value="0">
            <input type="hidden" name="CHK_CAMP_REPORTING" id="CHK_CAMP_REPORTING" value="0">
            <input type="hidden" name="CHK_EMAIL_SOCIAL" id="CHK_EMAIL_SOCIAL" value="0">
            <input type="hidden" name="CHK_IP_REP" id="CHK_IP_REP" value="0">
            <input type="hidden" name="CHK_FTAF" id="CHK_FTAF" value="0">
            <input type="hidden" name="CHK_SEGMENTATION" id="CHK_SEGMENTATION" value="0">           
            
            <input type="hidden" name="LANGCODE" id="LANGCODE" value="<?php echo strtoupper($oCRNRSTN_ENV->oSESSION_MGR->getSessionParam("LANGCODE")); ?>">
        </form>
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