<?php
session_start();
include("root.inc.php");
include("$ROOT/db/wethrdb.inc.php");
include("$ROOT/common/inc/logs.inc.php");//

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
 	var password=document.getElementById("password").value;
		
	if(!validReqField(password)){
		document.getElementById("formStatus").innerHTML="<span style='font-weight:bold; color:#E10000;'>Please enter your password.</span>";
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
</script>
</head>
<body><div>
<div id="body_wrapper">
<div class="hometitle">Wethrbug</div>
<div class="hometinysubtitle">Pulling real-time weather lookups through
Google’s web systems. That makes it fast.</div>
<div class="cb_small"></div>
<div>
Please enter your password:
</div>

 <div class="cb_mini"></div>
 

<div class="cb_mini"></div>
 <form id="getWethr_form" action="./completeLogin.php" method="post" onsubmit="if(!cleanUpData()){ return false; }">
      <div>
        <div class="cb_small"></div>
		<table cellpadding="0" cellspacing="0" border="0">
        <tr>
        <td align="right">
        	<div class="fieldtitle">Password: </div>
        </td>
        <td style="padding-left:10px;">
        <input type="password" name="password" id="password" />
        </td>
        </tr>
        </table>
        <div class="cb_small"></div>
        <table cellpadding="0" cellspacing="0" border="0">
        <tr>
        <td colspan="2"><div id="formStatus"></div></td>
        </tr>
        <tr>
        <td>
        
        <input type="submit" value="Login" />
        </td>
        <td style="padding-left:20px;"><a href="<?php echo $ROOT; ?>">Cancel</a></td>
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
