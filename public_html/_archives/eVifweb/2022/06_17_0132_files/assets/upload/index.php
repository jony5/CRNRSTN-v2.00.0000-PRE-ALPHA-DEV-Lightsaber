<?php
/* 
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
include_once($CRNRSTN_ROOT.'_crnrstn.config.inc.php');

//
// PROCESS ASSET UPLOAD
$adminContent_ARRAY = $oUSER->processAssetUpload();

//
// CHECK FOR SAME SESSION ID. IF SO...PERFORM HEADER REDIRECT...OTHERWISE...PERFORM HTML META REDIRECT.
if(session_id()==$oCRNRSTN_ENV->paramTunnelDecrypt($oCRNRSTN_ENV->oHTTP_MGR->extractData($_POST,'sid'))){

	header("Location: ".$adminContent_ARRAY[0]);
	exit();
	
}else{	
	?>
<!DOCTYPE html>
<html lang="en">
<meta http-equiv="refresh" content="0; url=<?php echo $adminContent_ARRAY[0]; ?>" />
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<title>Evifweb Development</title>
<link rel="shortcut icon" type="image/x-icon" href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>favicon.ico" />
<link rel="icon" type="image/x-icon" href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>favicon.ico" />
</head>
<body>
<p style="font-family:Arial, Helvetica, sans-serif; font-size:13px;"><a href="<?php echo $adminContent_ARRAY[0]; ?>" target="_self" style="text-decoration:none; color:#06C; text-decoration:underline;">Click here</a> if you are not redirected in a few seconds.</p>
</body>
</html>    
    
    <?php
	
}