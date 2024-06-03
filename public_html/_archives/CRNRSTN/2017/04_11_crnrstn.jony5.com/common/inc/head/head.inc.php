<?php
/* 
// J5
// Code is Poetry */

if(!isset($htmlTitle)){
	$htmlTitle='CRNRSTN :: An Open Source PHP Class Library';
}
?>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="shortcut icon" type="image/x-icon" href="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR');  ?>favicon.ico" />
<link rel="icon" type="image/x-icon" href="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR');  ?>favicon.ico" />
<meta http-equiv="Content-Language" content="en-us" />
<meta name="distribution" content="Global" />
<meta name="ROBOTS" content="index" />
<meta name="ROBOTS" CONTENT="follow" />
<meta property="og:site_name" content="CRNRSTN Suite :: An open source PHP class library"/>
<meta property="og:title" content="CRNRSTN Suite :: An open source PHP class library to support the migration of an application across multiple hosting environments."/>
<meta property="og:image" content="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR');  ?>common/imgs/logo_04_wht.jpg"/>
<meta property="og:type" content="website"/>
<meta name="twitter:card" content="summary"/>
<meta name="twitter:title" content="CRNRSTN Suite :: An open source PHP class library to support the migration of an application across multiple hosting environments."/>
<meta name="twitter:image" content="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR');  ?>common/imgs/logo_04_wht.jpg"/>

<meta name="description" content="An open source PHP class library to support the operation of an application across multiple hosting environments." />
<meta name="keywords" content="cornerstone, jesus, christ, j5, jonathan, harris, johnny 5,  jony5, atlanta, moxie, interactive, web, christian, web services, email, web programming, marketing, CSS, XHTML, php, javascript" />

<title><?php echo $htmlTitle; ?></title>
<link rel="stylesheet" href="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR');  ?>common/css/themes/ba/main.css" type="text/css" />

<script type="text/javascript" language="javascript" src="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR');  ?>common/js/lib/frameworks/prototype/1.7.1/prototype.js" ></script>
<script type="text/javascript" language="javascript" src="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR');  ?>common/js/lib/frameworks/scriptaculous/1.9.0/scriptaculous.js" ></script>
<?php
$tmp_dataMode = explode('|',$oUSER->getEnvParam('DATA_MODE'));
if($tmp_dataMode[1]!='SOAP'){ $preload_prep = 'style="display:none;"' ?>
<script type="text/javascript" language="javascript" src="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR');  ?>common/js/xml/crnrstn_xml.js" ></script>
<?php  } ?>
<script type="text/javascript" language="javascript" src="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR');  ?>common/js/form/form.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR');  ?>common/js/analytics/google/google.js" ></script>
<script type="text/javascript" language="javascript" src="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR');  ?>common/js/main.js"></script>
<link rel="stylesheet" href="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR');  ?>common/js/lib/frameworks/lightbox/2.02/css/lightbox.css" type="text/css" />
<script type="text/javascript" language="javascript" src="<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR');  ?>common/js/lib/frameworks/lightbox/2.02/js/lightbox.js"></script>