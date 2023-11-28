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

$USERNAME=$_GET['username'];

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
    
    <div id="content_wrapper">
    <div>Create a new connection:</div>
     <form id="getWethr_form" action="./savenewconnection.php" method="post" onsubmit="if(!validUsername()){ return false; }">
      <div>
  
        <div class="cb_small"></div>
		<table cellpadding="0" cellspacing="0" border="0">
        <tr>
        <td align="right">
        	<div class="fieldtitle">Who do you want to connect with? Enter their username: </div>
        </td>
        <td style="padding-left:10px;">
        <input type="text" name="username" id="username" value="<?php echo $USERNAME; ?>" />
        <div id="formStatus">There was an error connecting to that user.</div>
        </td>
        </tr>
        <tr>
        <td align="right">
        	<div class="fieldtitle">Send them a custom message:</div>
        </td>
        <td style="padding-left:10px;">
        <input type="text" name="message" id="message" />
        
        </td>
        </tr>
        </table>
        <div class="cb_small"></div>
        <table cellpadding="0" cellspacing="0" border="0">
        <tr>
        <td>
        <input type="submit" value="Add new connection" />
        </td>
        <td style="padding-left:20px;"><a href="<?php echo $ROOT; ?>">Cancel</a></td>
        </tr>
        </table>
         
        <div class="cb_mini"></div>
        
      </div>
    </form>
    
    </div>
	<div class="cb"></div>
    
    <div id="footer_wrapper"></div>
	<div class="cb"></div>


  <div> </div>
</div>
</div>
<?php include("$ROOT/common/inc/footer.inc.php");  ?>
</body>
</html>
