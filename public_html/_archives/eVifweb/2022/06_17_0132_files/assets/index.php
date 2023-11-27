<?php
/* 
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
include_once($CRNRSTN_ROOT . '_crnrstn.config.inc.php');

//
// RETRIEVE ASSET
$adminContent_ARRAY = $oUSER->retrieveAsset();
$tmp_clientUser = array();
$tmp_asset = array();


/*
`assets_ASSET_ID`, `assets_CLIENT_ID`, `assets_USER_ID`, `assets_TASK_ID`, `assets_ISACTIVE`, `assets_ASSET_TYPE_KEY`, 
`assets_FILE_NAME`,`assets_FILE_EXT`,`assets_FILE_SIZE`,`assets_FILE_PATH`,`assets_AUTHORIZED_IP`,`assets_AUTHORIZED_USERS`,`assets_LANGCODE`,`assets_DATEMODIFIED`,
`assets_DATECREATED`

`assets_ASSET_ID`,
    `assets_CLIENT_ID`,
    `assets_KIVOTOS_ID`,
    `assets_USER_ID`,
    `assets_ISACTIVE`,
    `assets_ASSET_TYPE_KEY`,
    `assets_FILE_NAME`,
    `assets_FILE_EXT`,
    `assets_FILE_SIZE`,
    `assets_FILE_PATH`,
    `assets_AUTHORIZED_IP`,
    `assets_AUTHORIZED_USERS`,
    `assets_LANGCODE`,
    `assets_DATEMODIFIED`,
    `assets_DATECREATED`



*/

$queryIndex_ARRAY = array(
				'users_client_assoc_CLIENT_ID' => 0,
				
				'assets_ASSET_ID' => 0,'assets_CLIENT_ID' => 1,
				'assets_KIVOTOS_ID' => 2,'assets_USER_ID' => 3, 'assets_ISACTIVE' => 4,
				'assets_ASSET_TYPE_KEY' => 5,'assets_FILE_NAME' => 6, 'assets_FILE_EXT' => 7,
				'assets_FILE_SIZE' => 8,'assets_FILE_PATH' => 9,'assets_AUTHORIZED_IP' => 10,
				'assets_AUTHORIZED_USERS' => 11,'assets_LANGCODE' => 12,'assets_DATEMODIFIED' => 13,'assets_DATECREATED' => 14
				);

//
// PROCESS DB OUTPUT INTO USABLE FORMAT
$tmp_loop_size17 = sizeof($adminContent_ARRAY);
for($i=0;$i<$tmp_loop_size17;$i++){
	
	//
	// CLIENT-USER RELATION
	if(sizeof($adminContent_ARRAY[$i])==1){
		//
		// WE HAVE USER-CLIENT RELATION TO FLAG
		$tmp_clientUser[$USERID] = 1;
		
	}else{
		
		//
		// ASSET DATA
		$tmp_asset['ASSET_ID']=$adminContent_ARRAY[$i][$queryIndex_ARRAY['assets_ASSET_ID']];
		$tmp_asset['CLIENT_ID']=$adminContent_ARRAY[$i][$queryIndex_ARRAY['assets_CLIENT_ID']];
		$tmp_asset['USER_ID']=$adminContent_ARRAY[$i][$queryIndex_ARRAY['assets_USER_ID']];
		$tmp_asset['KIVOTOS_ID']=$adminContent_ARRAY[$i][$queryIndex_ARRAY['assets_KIVOTOS_ID']];
		$tmp_asset['ISACTIVE']=$adminContent_ARRAY[$i][$queryIndex_ARRAY['assets_ISACTIVE']];
		$tmp_asset['ASSET_TYPE_KEY']=$adminContent_ARRAY[$i][$queryIndex_ARRAY['assets_ASSET_TYPE_KEY']];
		$tmp_asset['FILE_NAME']=$adminContent_ARRAY[$i][$queryIndex_ARRAY['assets_FILE_NAME']];
		$tmp_asset['FILE_EXT']=$adminContent_ARRAY[$i][$queryIndex_ARRAY['assets_FILE_EXT']];
		$tmp_asset['FILE_SIZE']=$adminContent_ARRAY[$i][$queryIndex_ARRAY['assets_FILE_SIZE']];
		$tmp_asset['FILE_PATH']=$adminContent_ARRAY[$i][$queryIndex_ARRAY['assets_FILE_PATH']];
		$tmp_asset['AUTHORIZED_IP']=$adminContent_ARRAY[$i][$queryIndex_ARRAY['assets_AUTHORIZED_IP']];
		$tmp_asset['AUTHORIZED_USERS']=$adminContent_ARRAY[$i][$queryIndex_ARRAY['assets_AUTHORIZED_USERS']];
		$tmp_asset['LANGCODE']=$adminContent_ARRAY[$i][$queryIndex_ARRAY['assets_LANGCODE']];
		$tmp_asset['DATEMODIFIED']=$adminContent_ARRAY[$i][$queryIndex_ARRAY['assets_DATEMODIFIED']];
		$tmp_asset['DATECREATED']=$adminContent_ARRAY[$i][$queryIndex_ARRAY['assets_DATECREATED']];
		
	}
	
}

if(sizeof($tmp_asset)<1){
	
	//
	// NO ASSET RETURNED. REDIRECT TO RESOURCE 404 PAGE.
	
	
}

//
// IP ADDRESS APPROVALS FOR RESOURCE
if(!$oCRNRSTN_ENV->oCRNRSTN_IPSECURITY_MGR->exclusiveAccess($AUTHORIZED_IP)){
	
	//
	// IP NOT AUTHORIZED. REDIRECT TO RESOURCE 403 PAGE.

}


//
// ACCESS FROM APPROVED USER PERSPECTIVE
if($AUTHORIZED_USERS=="PUBLIC"){
	
}else{
	
	//
	// CHECK FOR AUTHENTICATED USER WITH VALID SESSION. OTHERWISE KICK TO SIGNIN.
	require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/security/secure.inc.php');
	
	//
	// DOES ASSET HAVE LIMITED VIEWERSHIP? EVIF USERS WOULD NEED TO BE SPECIFIED TOO OR THEY LOOSE ACCESS.
	if($AUTHORIZED_USERS!=""){
		
		// $AUTHORIZED_USERS = "USERID|USERID|USERID|USERID"
		// WE HAVE LIMITED SELECTION OF USERS WITH ACCESS TO THIS RESOURCE.
		$pos = strpos($AUTHORIZED_USERS, $oCRNRSTN_ENV->oSESSION_MGR->getSessionParam('USERID'));
		if ($pos === false) {
			
			//
			// REDIRTECT TO RESOURCE 403 PAGE. USER NOT APPROVED FOR RESOURCE ACCESS.
			
			
			
		}
		
	}
	
	//
	// IS THIS USER APPROVED TO VIEW CLIENT MATERIAL
	switch($oCRNRSTN_ENV->oSESSION_MGR->getSessionParam('USER_PERMISSIONS_ID')){
		
		//
		// USERS WITH DEFAULT ACCESS TO ALL RESOURCES. 
		case 420:
		case 410:
		case 380:
		case 350:
		case 320:
		case 300:
		case 200:
		case 150:
		
		
		break;
		
		//
		// USERS WITH ACCESS TO ONLY RESOURCES OF THEIR ASSIGNED CLIENT(S)
		case 145:
		case 100:
		case 50:
		case 40:
			
			//
			// IS MY USERID APPROVED FOR THIS CLIENT?
			if($tmp_clientUser[$USERID]!=1){
				//
				// USER NOT APPROVED FOR RESOURCE ACCESS. REDIRECT TO RESOURCE 403 PAGE.
			
			}
		
		break;
		default:
			//
			// USER PERMISSIONS NOT DEFINED. NOT APPROVED FOR RESOURCE ACCESS. REDIRECT TO RESOURCE 403 PAGE.		
		
		break;
	
	
	}
	
}

require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/session/session.inc.php');
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/language/lang.inc.php');

//
// LANGUAGE SUPPORT
$oUSER->prepLangElem('SITE_TITLE|SITE_FOOTER_RIGHTS|SITE_TITLE_WEB_DEV|SITE_TITLE_DIGIT_MARKET|SITE_TITLE_AND|COMBO_SEL_DEVICE_MOBILE|COMBO_SEL_DEVICE_DESKTOP');

//
// LOAD DEVICE DETECT AFTER LANGUAGE PACK PREPPED FOR POPULATION OF COMBO COPY WITH LANG DATA
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/device/detect.inc.php');


//
// BEGIN ASSET TYPE SPECIFIC HANDLING
switch($tmp_asset['ASSET_TYPE_KEY']){
	case 'BRIEF':	
	
	break;
	case '':
	
	break;
	
	default:
		//
		// WHAT SHOULD WE DO FOR UNDEFINED ASSET TYPES?
	
	break;
	
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
		<h4>Welcome to the e<span class="the_V">V</span>ifweb Development dashboard.</h4>
        <p><input type="text" data-role="date"></p>
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