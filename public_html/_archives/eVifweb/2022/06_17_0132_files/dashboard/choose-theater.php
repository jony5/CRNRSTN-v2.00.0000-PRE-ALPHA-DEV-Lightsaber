<?php
/* 
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
include_once($CRNRSTN_ROOT . '_crnrstn.config.inc.php');
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/security/secure.inc.php');
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/session/session.inc.php');
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/classes/devicedetect/Mobile_Detect.php');

$tmp_mobileMode = "SERVER DETECTED DESKTOP!";
$detect = new Mobile_Detect;
 
//
// MOBILE DEVICE DETECT
if( $detect->isMobile() && !$detect->isTablet() ){
	$tmp_mobileMode = "SERVER DETECTED MOBILE!";
	
?>	
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title>Single-page template</title>
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>favico.ico" />
    <link rel="icon" type="image/x-icon" href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>favicon.ico" />
    <link rel="stylesheet" href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR') ?>common/jquery_mobi/jquery.mobile-1.4.5.min.css">
    <link rel="stylesheet" href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR') ?>common/jquery_mobi/jqm-demos.css">
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700">
    <script src="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR') ?>common/jquery_mobi/jquery.js"></script>
	<script src="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR') ?>common/jquery_mobi/index.js"></script>
    <script src="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR') ?>common/jquery_mobi/jquery.mobile-1.4.5.min.js"></script>
    	    <style>
	        #demo-borders .ui-collapsible .ui-collapsible-heading .ui-btn { border-top-width: 1px !important; }
	    </style>
	    <style id="textinput-controlgroup">
			.controlgroup-textinput{
				padding-top:.22em;
				padding-bottom:.22em;
			}
	    </style>
</head>

<body>

<div data-role="page">

	<div data-role="panel" id="leftpanel_nav">
    <a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR') ?>dashboard/choose-theater.php" class="ui-shadow ui-btn ui-corner-all ui-btn-inline ui-btn-icon-left ui-icon-star">Sign Out</a>
    <a href="#close_lnk" data-rel="close" class="ui-btn ui-shadow ui-corner-all ui-btn-a ui-icon-delete ui-btn-icon-left ui-btn-inline">Close panel</a>
</div><!-- /panel -->

	<div data-role="header" data-position="fixed">
    <div style="float:right; padding:5px; padding-bottom:0px; background-color:#FFF; margin:5px; border:2px solid #BDB2B3;"><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR') ?>dashboard/"><img src="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/evifweb_logo_sm.gif" width="42" height="23" alt="Evifweb" title="5"></a></div>
		<h1>Evifweb</h1>
        <a href="#leftpanel_nav" class="ui-alt-icon ui-btn ui-shadow ui-corner-all ui-icon-bars ui-btn-icon-notext">Menu</a>
        
	</div><!-- /header -->
    
	<div role="main" class="ui-content">
<form>
    <fieldset data-role="controlgroup" data-type="horizontal" data-mini="true">
        <button data-icon="home">Home</button>
        <button data-icon="search" data-iconpos="notext">Search</button>
        <label for="select-more-2a" class="ui-hidden-accessible">More</label>
        <select name="select-more-2a" id="select-more-2a">
            <option value="">Select…</option>
            <option value="#">One</option>
            <option value="#">Two</option>
            <option value="#">Three</option>
        </select>
    </fieldset>
</form>

	<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas id eros enim. Praesent rutrum aliquam laoreet. Etiam dapibus nec ipsum et vehicula. Donec laoreet purus ante. Nulla accumsan nulla eu enim tincidunt, vitae condimentum turpis dapibus. Nulla pulvinar vestibulum aliquet. Pellentesque ornare vestibulum tempor. Mauris nulla libero, vehicula non ante sed, cursus consectetur dolor. Vivamus imperdiet blandit finibus. Fusce eros ante, auctor at enim in, congue laoreet orci. Fusce convallis lobortis nisl eu convallis. Nam libero magna, laoreet vitae urna a, aliquam pellentesque sem. Maecenas mattis ante sit amet faucibus rutrum.</p>
	
    <a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR') ?>dashboard/" class="ui-shadow ui-btn ui-corner-all ui-btn-inline ui-btn-icon-left ui-icon-star">Inline + icon</a>
    <a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR') ?>dashboard/" class="ui-shadow ui-btn ui-corner-all ui-btn-inline ui-btn-b ui-mini">Mini + theme</a>
    <a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR') ?>dashboard/" class="ui-shadow ui-btn ui-corner-all ui-btn-inline ui-icon-plus ui-btn-icon-notext ui-btn-b ui-mini">icon only button</a>

    <a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR') ?>dashboard/" data-transition="slide" class="ui-btn ui-corner-all ui-shadow ui-btn-inline">SLIDE LINK</a>
<form>
    <label for="flip-checkbox-1">Flip toggle switch checkbox:</label>
    <input type="checkbox" data-role="flipswitch" name="flip-checkbox-1" id="flip-checkbox-1">
</form>
    </div><!-- /content -->

	<div data-role="footer">
		<h4>Footer content</h4>
	</div><!-- /footer -->

</div><!-- /page -->

</body>
</html>


	
<?php 

}else{
?>

<!doctype html>
<html lang="en">
<head>
<?php
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/head/head.inc.php');
?>
</head>

<body onLoad="mobile_detect()">

<?php
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/header/header.inc.php');
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/nav/dashboard.inc.php');
?>



<main id="content">

</main>
<div style="font-size:20px; font-weight:bold; color:#F00;"><?php echo $tmp_mobileMode; ?></div>
<br><br>
<iframe class="github-btn" src="http://ghbtns.com/github-btn.html?user=jony5&repo=CRNRSTN&type=watch&count=true" width="100" height="20"></iframe>
<?php
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/footer/ftr.inc.php');

}
?>
</body>
</html>
