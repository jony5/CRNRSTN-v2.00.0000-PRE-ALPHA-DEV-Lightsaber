<?php
session_start();
include("root.inc.php");
include("$ROOT/db/wethrdb.inc.php");
include("$ROOT/common/inc/logs.inc.php");

echo '<?xml version="1.0" encoding="UTF-8"?>';
?>

<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="application/xhtml+xml; charset=UTF-8"/>
<title>Wethrbug</title>
<?php include("$ROOT/common/inc/style.inc.php");  ?>
</head>
<body><div>
<div id="body_wrapper">
<div class="hometitle">Wethrbug</div>
<div class="hometinysubtitle">Pulling real-time weather lookups through
Google’s web systems. That makes it fast.</div>
<div class="cb_mini"></div>
<div class="err">
<strong><?php echo $_SESSION['zipcode']; ?></strong> does
not appear to be a legitimate 
zip code for the united states, and
will not return useful wethr 
informattion.
</div>

<div class="cb_mini"></div>
<div class="subtitle">Get Wethr Forecast:</div>
<div class="cb_small"></div>
<form id="getWethr_form" action="./confirmZip.php" method="post">
      <div>
      	<table cellpadding="0" cellspacing="0" border="0">
        <tr>
        <td align="right">
        	<div class="fieldtitle">Mobile Number: </div>
        </td>
        <td style="padding-left:10px;">
        <strong><?php echo $_SESSION['mobilenumber']; ?></strong>
        </td>
        </tr>
        <tr>
        	<td colspan="2"><div class="cb_small"></div></td>
        </tr>
        <tr>
        <td align="right">
        	<div class="fieldtitle">Zip Code:</div>
        </td>
        <td style="padding-left:10px;">
        <strong><?php echo $_SESSION['zipcode']; ?></strong>
        <input type="hidden" name="zipcode" id="zipcode" value="<?php echo $_SESSION['zipcode']; ?>" />
        <input type="hidden" name="mobilenumber" id="mobilenumber" value="<?php echo $_SESSION['mobilenumber']; ?>" />
        <input type="hidden" name="status" id="status" value="<?php echo $_SESSION['status']; ?>" />
        </td>
        </tr>
        <tr>
        <td align="right">
        	<div></div>
        </td>
        <td style="padding-left:10px;">
        <div class="cb_small"></div>
        <table cellpadding="0" cellspacing="0" border="0">
        <tr>
        <td>
        <input type="submit" value="Submit for Wethr"/>
        </td>
        <td style="padding-left:20px;"><a href="<?php echo $ROOT; ?>">Cancel</a></td>
        </tr>
        </table>
        </td>
        </tr>
        </table>
        <div class="cb_mini"></div>
        
      </div>
    </form>
 <div class="cb_small"></div>

  <div> </div>
</div>
</div>
<?php include("$ROOT/common/inc/footer.inc.php");  ?>
</body>
</html>
