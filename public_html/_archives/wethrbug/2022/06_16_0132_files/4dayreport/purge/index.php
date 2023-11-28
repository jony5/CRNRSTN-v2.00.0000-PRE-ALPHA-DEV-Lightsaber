<?php
session_start();
include("root.inc.php");
include("$ROOT./db/wethrdb.inc.php");
include("$ROOT./5dayforecast/security/sessionmgmt/session.inc.php");
include("$ROOT./common/inc/logs.inc.php");

//
// DEFINE VARIABLES
$MNHASH=$_SESSION['MNHASH'];
$UNHASH=$_SESSION['UNHASH'];
$status=$_SESSION['status'];
  
# posts
# ID INT(11)
# AUTHOR_USERID INT(11)
# TARGET_USERID INT(11)
# POST_COPY varchar(500) ENCODED
# DATECREATED	
# DATERECEIVED	
# ROWSTATUS		varchar(10)

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
	<div class="cb_mini"></div>
    
	<div class="cb_mini"></div>    <div id="tnav_wrapper">
    	<div id="tnav_lnk_new"><a href="<?php echo $ROOT; ?>/">BACK</a></div>
    	<div id="tnav_lnk_purge" style="background-color:#FFF;"><a href="<?php echo $ROOT; ?>./">LOG OUT</a></div>
        <div id="tnav_lnk_purge"><a href="<?php echo $ROOT; ?>/purge/">PURGE</a></div>
        <div id="tnav_lnk_purge" style="background-color:#FFF;"><a href="<?php echo $ROOT; ?>./4dayreport/prefctr/">PREFERENCES</a></div>
    </div>
	<div class="cb_mini"></div>
   	
    
    <div id="content_wrapper">

        <div style="padding:6px;">Are you sure you want to purge all of your messages in the system?</div>
        <div class="cb_small"></div>
        <div>
            <div id="newconn_confirm"><a href="./purgeall.php">PURGE ALL OF MY CONTENT</a></div>
            <div id="newconn_ignore"><a href="<?php echo $ROOT; ?>/">CANCEL</a></div>
        </div>
        </div>
        
        <div class="cb_mini"></div>	    
    </div>
	<div class="cb"></div>
    
    <div id="footer_wrapper"></div>
	<div class="cb"></div>

</div>
</div>
<?php include("$ROOT/common/inc/footer.inc.php");  ?>
</body>
</html>
