<?php
session_start();
session_destroy();
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
<?php //include("$ROOT/common/inc/script.inc.php");  ?>
<script language="javascript" type="text/javascript">
function cleanUpData(){
	// FORMAT MOBILE NUMBER
	mobilenumber=document.getElementById("mobilenumber").value;
	mobilenumber = mobilenumber.replace(/[^\d]/g,'');
	document.getElementById("mobilenumber").value=mobilenumber;
	
	zipcode=document.getElementById("zipcode").value;
	zipcode=zipcode.toLowerCase();
	document.getElementById("zipcode").value=zipcode;
	
	if(!validPhone(mobilenumber) || !validReqField(zipcode)){
		document.getElementById("formStatus").innerHTML="<span style='font-weight:bold; color:#E10000;'>Invalid Mobile Number or ZIPCODE</span>";
		return false;	
	}else{
		return true;
	}
}


function validReqField(str) {
	if (!str.length) {
		return false;
	}
	return true;
}


function validPhone(val) {
        var stripped = val.replace(/[\(\)\.\-\ ]/g, '');
        //strip out acceptable non-numeric characters
        if ((isNaN(stripped) && stripped.length != 0) || stripped.length != 10) { 
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
<div class="cb_small"></div>

<div class="subtitle">Get Wethr Forecast:</div>
<div class="cb_small"></div>

<form id="getWethr_form" action="./getWethr.php" method="post" onsubmit="if(!cleanUpData()){ return false; }">
      <div>
      	<table cellpadding="0" cellspacing="0" border="0">
        <tr>
        <td align="right">
        	<div class="fieldtitle">Mobile Number: </div>
        </td>
        <td style="padding-left:10px;">
        <input type="text" name="mobilenumber" id="mobilenumber" size="20" />
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
        <input type="text" name="zipcode" id="zipcode" size="20"/>
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
        <br /><br />
        <div class="hometinysubtitle"><a href="mailto:support@wethrbug.com" target="_blank" style="font-size:x-small;">support@wethrbug.com</a></div>
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
<div class="legal">&copy; <?php echo date('Y'); ?> All Rights Reserved.</div>
</body>
</html>
