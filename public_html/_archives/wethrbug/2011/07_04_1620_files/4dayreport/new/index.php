<?php
session_start();
include("root.inc.php");
include("$ROOT./db/wethrdb.inc.php");
include("$ROOT./4dayreport/security/sessionmgmt/session.inc.php");
include("$ROOT./common/inc/logs.inc.php");

//
// DEFINE VARIABLES
$MNHASH=$_SESSION['MNHASH'];
$UNHASH=$_SESSION['UNHASH'];
$status=$_SESSION['status'];

echo '<?xml version="1.0" encoding="UTF-8"?>';

?>

<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="application/xhtml+xml; charset=UTF-8"/>
<title>Wethrbug</title>
<?php include("$ROOT/common/inc/style.inc.php");  ?>
<?php include("$ROOT/common/inc/script.inc.php");  ?>
</head>
<body>
<div id="body_wrapper">
	<div id="header_wrapper">
    	<div id="top_title">WETHRBUG</div>
        <div id="top_status"><!-- LAST LOGIN: <?php echo cleanupdate($_SESSION['DATELASTLOGIN'], $FORMAT="timestamp2");  ?> --></div>
   	</div>
	<div class="cb_mini"></div>    <div id="tnav_wrapper">
    	<div id="tnav_lnk_new"><a href="<?php echo $ROOT; ?>/new/">NEW</a></div>
    	<div id="tnav_lnk_purge" style="background-color:#FFF;"><a href="<?php echo $ROOT; ?>./">LOG OUT</a></div>
        <div id="tnav_lnk_purge"><a href="<?php echo $ROOT; ?>/purge/">PURGE</a></div>
        <div id="tnav_lnk_purge" style="background-color:#FFF;"><a href="<?php echo $ROOT; ?>./4dayreport/prefctr/">PREFERENCES</a></div>
    </div>
	<div class="cb_mini" style="padding-bottom:20px;"></div>
    <div id="lnk_newconnection"><a href="<?php  ?>/4dayreport/newconnection/">New Connection</a></div>
    <div class="cb_small"></div>
    <!--<div id="lnk_newmessage"><a href="<?php  ?>/4dayreport/newmessage/">New Message</a></div>-->
    
    <div id="content_wrapper"></div>
	<div class="cb"></div>
    
    <div id="footer_wrapper"></div>
	<div class="cb"></div>


  <div> </div>
</div>
</div>
<?php include("$ROOT/common/inc/footer.inc.php");  ?>
</body>
</html>
