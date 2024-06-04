<?php
session_start();
include("root.inc.php");
include("$ROOT/db/wethrdb.inc.php");
include("$ROOT/common/inc/logs.inc.php");//
// DEFINE VARIABLES
$MNHASH=$_SESSION['MNHASH'];
$UNHASH=$_SESSION['UNHASH'];
$status=$_SESSION['status'];
  

$IPLASTLOGIN=addslashes($_SERVER['REMOTE_ADDR']);
$USERAGENT=addslashes($_SERVER['HTTP_USER_AGENT']);


echo '<?xml version="1.0" encoding="UTF-8"?>';

?>

<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="application/xhtml+xml; charset=UTF-8"/>
<title>Wethrbug</title>
<?php include("$ROOT/common/inc/style.inc.php");  ?>
<script language="javascript" type="text/javascript">
function cleanUpData(){
	// FORMAT MOBILE NUMBER
	var pin=document.getElementById("pin").value;
		
	if(!validPIN(pin)){
		document.getElementById("formStatus").innerHTML="<span style='font-weight:bold; color:#E10000;'>Invalid Mobile Number or ZIPCODE</span>";
		return false;	
	}else{
		return true;
	}
}

function validPIN(val) {
        var stripped = val.replace(/[\(\)\.\-\ ]/g, '');
        //strip out acceptable non-numeric characters
        if ((isNaN(stripped) && stripped.length != 0) || (stripped.length != 4) { //if not a number or not 4 digits, return false
            return false;
        } else {
            return true;
        }
	}

</script>
</head>
<body><div>
<div id="body_wrapper">
<div class="hometitle">Wethrbug</div>
<div class="hometinysubtitle">Pulling real-time weather lookups through
Google’s web systems. That makes it fast.</div>
<div class="cb_mini"></div>
<div>
ALERT: Could not get Wethr Forecast.
<strong>Did you want to add a new 
zipcode to the wethr database?</strong>
</div>

 <div class="cb_small"></div>

<div>Mobilenumber: <strong style="color:#CF3"><?php echo $_SESSION['mobilenumber']; ?></strong></div>
<div>Zipcode: <strong style="color:#CF3"><?php echo $_SESSION['zipcode']; ?></strong></div>

<div class="cb_mini"></div>
<form id="getWethr_form" action="./getWethr.php" method="post" onsubmit="if(!cleanUpData()){ return false; }">
      <div>
      	<table cellpadding="0" cellspacing="0" border="0">
        <tr>
        <td align="right">
        	<div class="fieldtitle">Mobile Number: </div>
        </td>
        <td style="padding-left:10px;">
        <input type="text" name="mobilenumber" id="mobilenumber" size="20" value="<?php echo $_SESSION['mobilenumber']; ?>" />
        </td>
        </tr>
        <tr>
        	<td colspan="2"><div class="cb_small"></div></td>
        </tr>
        <tr>
        <td align="right" valign="top">
        	<div class="fieldtitle">Zip Code :</div>
        </td>
        <td style="padding-left:10px;">
        <input type="text" name="zipcode" id="zipcode" size="20" value="<?php echo $_SESSION['zipcode']; ?>" />
        <div class="cb"></div>
        <span style="color:#C30; font-size:x-small;">** This has been taken already. **<br />** Please choose another name **</span>
        <div class="cb"></div>
        <div class="hometinysubtitle">Enter ZIPCODE. Get for wethr forecast.</div>
        </td>
        </tr>
        <tr>
        <td align="right">
        	<div></div>
        </td>
        <td style="padding-left:10px;">
        <div id="formStatus"></div>
        <div class="cb_small"></div>
        <input type="submit" value="Submit for Wethr"/>
        <input type="hidden" name="status" id="status" value="Available" />
        </td>
        </tr>
        </table>
        <div class="cb_mini"></div>
        
      </div>
    </form>

  <div> </div>
</div>
</div>
<?php include("$ROOT/common/inc/footer.inc.php");  ?>
</body>
</html>
