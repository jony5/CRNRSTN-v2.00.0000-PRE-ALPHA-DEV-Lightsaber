<?php
/* 
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
include_once($CRNRSTN_ROOT . '_crnrstn.config.inc.php');
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
// EXTRACT KIVOTOS DATA
//$adminContent_ARRAY = $oUSER->getKivotos();


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
	
	//
	// KIVOTOS MENU [NEW/BACK - FILTER RESULTS - ACTIIVITY LOG]
	require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/classes/mininav.inc.php');								// CUSTOM NAV CLASS
	$oMiniNav = new miniNav('search-results');
	#$oMiniNav->configureLink('filter', $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'dashboard/kivotos/filter/');
	#$oMiniNav->configureLink('logs', $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'dashboard/logs/');
	#$oMiniNav->configureLink('refresh', $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'dashboard/');
	
	
	#$xxxFILTERHASBEENAPPLIEDTORESULTSxxx = true;
	if($xxxFILTERHASBEENAPPLIEDTORESULTSxxx){
		$oMiniNav->configureLink('editFilter', $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'dashboard/kivotos/filter/');
		
	}
	
	$tmp_formUnique = $oUSER->generateNewKey(4);
	require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/search/search.mobi.inc.php');
	require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/nav/dashboard.mobi.inc.php');
	require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/header/header.mobi.inc.php');
	
	?>
    
    <!-- 
    //
    // BEGIN MAIN CONTENT -->
	<div role="main" class="ui-content">
        <ul data-role="listview">
        	<?php
			foreach($_POST as $key=>$value){
				echo '<li><a href="#" class="ui-alt-icon">'.$key.' = '.$value.'</a></li>';
				
				
			}
			?>
        	<li><a href="#" class="ui-alt-icon">Create FTP account for vendor</a></li>
            <li><a href="#" class="ui-alt-icon">Design welcome message for customer signup</a></li>
            <li><a href="#" class="ui-alt-icon">Implement tracking on web site</a></li>
            <li><a href="#" class="ui-alt-icon">Process email optin data list for duplicates</a></li>
            <li><a href="#" class="ui-alt-icon">Convert web site to HTML5</a></li>
            <li><a href="#" class="ui-alt-icon">Create FTP account for vendor</a></li>
            <li><a href="#" class="ui-alt-icon">Design welcome message for customer signup</a></li>
            <li><a href="#" class="ui-alt-icon">Implement tracking on web site</a></li>
            <li><a href="#" class="ui-alt-icon">Process email optin data list for duplicates</a></li>
            <li><a href="#" class="ui-alt-icon">Convert web site to HTML5</a></li>
            <li><a href="#" class="ui-alt-icon">Create FTP account for vendor</a></li>
            <li><a href="#" class="ui-alt-icon">Design welcome message for customer signup</a></li>
            <li><a href="#" class="ui-alt-icon">Implement tracking on web site</a></li>
            <li><a href="#" class="ui-alt-icon">Process email optin data list for duplicates</a></li>
            <li><a href="#" class="ui-alt-icon">Convert web site to HTML5</a></li>
            <li><a href="#" class="ui-alt-icon">Create FTP account for vendor</a></li>
            <li><a href="#" class="ui-alt-icon">Design welcome message for customer signup</a></li>
            <li><a href="#" class="ui-alt-icon">Implement tracking on web site</a></li>
            <li><a href="#" class="ui-alt-icon">Process email optin data list for duplicates</a></li>
            <li><a href="#" class="ui-alt-icon">Convert web site to HTML5</a></li>
        </ul>    
        <div class="cb_30"></div>
        <div data-role="navbar" data-iconpos="bottom">
            <ul>
                <li><a href="#" data-icon="arrow-l" class="ui-alt-icon">Previous</a></li>
                <li><a href="#" data-icon="arrow-r" class="ui-alt-icon">Next</a></li>
            </ul>
        </div><!-- /navbar -->
        <div class="cb_20"></div>
        
        
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
<html lang="<?php echo strtolower($oCRNRSTN_ENV->oSESSION_MGR->getSessionParam("LANGCODE")); ?>">
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

</main>


<?php
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/footer/ftr.inc.php');

?>
</body>
</html>

<?php
}
?>