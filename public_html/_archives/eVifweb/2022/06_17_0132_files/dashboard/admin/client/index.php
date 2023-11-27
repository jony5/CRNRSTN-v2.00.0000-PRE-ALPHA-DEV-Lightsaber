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
$oUSER->prepLangElem('SITE_TITLE|SITE_TITLE_STYLED|SITE_FOOTER_RIGHTS|SITE_TITLE_WEB_DEV|SITE_TITLE_DIGIT_MARKET|SITE_TITLE_AND|COMBO_SEL_DEVICE_MOBILE|COMBO_SEL_DEVICE_DESKTOP');

//
// RETRIEVE CLIENTS
$adminContent_ARRAY = $oUSER->getClients();

/*
 `clients_CLIENT_ID`, `clients_ISACTIVE`, `clients_COMPANYNAME`, `clients_DATEMODIFIED`, `clients_DATECREATED`
*/

$queryIndex_ARRAY = array('clients_CLIENT_ID' => 0,'clients_ISACTIVE' => 1,
					'clients_COMPANYNAME' => 2,'clients_DATEMODIFIED' => 3, 'clients_DATECREATED' => 4
					);

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

<div data-role="page" id="myPage">
    <?php
	$tmp_formUnique = $oUSER->generateNewKey(4);
	require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/search/search.mobi.inc.php');
	require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/nav/dashboard.mobi.inc.php');
	require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/header/header.mobi.inc.php');
	?>
    
    <!-- 
    //
    // BEGIN MAIN CONTENT -->
	<div role="main" class="ui-content">
		<h3>client administration</h3>
		<p>Manage the client accounts on this extranet.</p>
        <div class="ui-corner-all custom-corners">
            <div class="ui-bar ui-bar-a">
                <h3 style="margin-top:15px;">Client Accounts</h3>
                <div style="float:right;">
                    <a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>dashboard/admin/client/new/" class="ui-shadow ui-btn ui-corner-all ui-btn-inline ui-icon-plus ui-btn-icon-notext ui-btn-b ui-mini" data-ajax="false">New</a>
                </div>
            </div>
            <div class="ui-body ui-body-a">
                <ul data-role="listview" data-inset="true" class="ui-alt-icon">
                	<?php
					$tmp_loop_size = sizeof($adminContent_ARRAY);
					for($i=0;$i<$tmp_loop_size;$i++){
					?>
                    <li data-icon="gear"><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>dashboard/admin/client/settings/?cid=<?php echo $adminContent_ARRAY[$i][$queryIndex_ARRAY['clients_CLIENT_ID']]; ?>" data-ajax="false"><?php echo $adminContent_ARRAY[$i][$queryIndex_ARRAY['clients_COMPANYNAME']]; ?></a></li>
					<?php	
					}
					?>
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
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/nav/dashboard.inc.php');
?>

<main id="content">
<div id="dashboard_content_shell">
	<div id="dashboard_page_title">client administration</div>
    <div class="cb_10"></div>
    <?php  
	//
	// ME ONLY CONTENT
	if($oCRNRSTN_ENV->oSESSION_MGR->getSessionParam('USER_PERMISSIONS_ID')=="420"){
	?>
    <div><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>dashboard/admin/client/new/">New client</a></div>
    <?php
	}
	?>
    <div class="cb_10"></div>
    
    <table cellpadding="0" cellspacing="0" border="0" width="100%">
    <tr>
        <td width="20%"><span class="tbl_title">Business Name</span></td>
        <td width="25%"><span class="tbl_title"></span></td>
        <td width="25%"><span class="tbl_title"></span></td>
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
    if($tmp_rowstyle!='' || $i<1){
        $tmp_rowstyle = '';
        $tmp_tblstyle = '';
    }else{
        $tmp_rowstyle = ' style="background-color:#C7CBF1; line-height:25px;"';
        $tmp_tblstyle = ' style="padding:3px 0 3px 0;"';
    }
    ?>
    <tr <?php echo $tmp_rowstyle; ?>>
        <td><span class="tbl_content" style="padding-left:4px;"><strong><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>dashboard/admin/client/settings/?cid=<?php echo $adminContent_ARRAY[$i][$queryIndex_ARRAY['clients_CLIENT_ID']]; ?>" target="_self"><?php echo $adminContent_ARRAY[$i][$queryIndex_ARRAY['clients_COMPANYNAME']]; ?></a></strong></span></td>
        <td>
            <span class="tbl_content"></span>
        </td>
        <td></td>
        <td><span class="tbl_content"><?php echo date("m.d.Y", strtotime($adminContent_ARRAY[$i][$queryIndex_ARRAY['clients_DATEMODIFIED']])); ?></span></td>
        <td><span class="tbl_content"><?php echo date("m.d.Y", strtotime($adminContent_ARRAY[$i][$queryIndex_ARRAY['clients_DATECREATED']])); ?></span></td>
    </tr>
    <tr><td colspan="4" style="line-height:5px;">&nbsp;</td></tr>
        
    <?php
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
<?php
}
?>
