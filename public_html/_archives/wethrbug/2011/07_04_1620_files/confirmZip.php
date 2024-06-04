<?php
session_start();
include("root.inc.php");
include("$ROOT/db/wethrdb.inc.php");
include("$ROOT/common/inc/logs.inc.php");//
// DEFINE VARIABLES
$mobilenumber=$_SESSION['mobilenumber'];
$username=$_SESSION['zipcode'];
$_SESSION['username']=$username;
$status=$_SESSION['status'];
  
$MNHASH = md5($mobilenumber); 
$UNHASH = md5($username); 

$IPLASTLOGIN=addslashes($_SERVER['REMOTE_ADDR']);
$USERAGENT=addslashes($_SERVER['HTTP_USER_AGENT']);

$LOGINCOUNT=0;


//
// PERFORM SYSTEM LOOKUP FOR UNIQUE USERNAME
$query=mysql_query("select ID from users where UNHASH='".$UNHASH."' AND MNHASH='".$MNHASH."' AND ROWSTATUS='active'  LIMIT 1");
if(mysql_num_rows($query)>0){
	//
	// THIS USER EXISTS IN THE DATABASE
	logActivity('existing user identified',crc32('existing user identified'), $UNHASH, $MNHASH, $PWDHASH, $IPLASTLOGIN, $USERAGENT);
	header("Location: $ROOT/wLogin.php");
	exit();
	
}else{
	//
	// NO USERNAME / MOBILENUMBER MATCH
	# IS THERE AN USERNAME COLLISION?
	$query=mysql_query("select ID from users where UNHASH='".$UNHASH."' AND ROWSTATUS='active'  LIMIT 1");
	if(mysql_num_rows($query)>0){
		//
		// WE HAVE A USERNAME COLLISION
		logActivity('username collision', crc32('username collision'), $UNHASH, $MNHASH, $PWDHASH, $IPLASTLOGIN, $USERAGENT);
		header("Location: $ROOT/collisionZip.php");
		exit();
		
	}else{
		logActivity('user not found', crc32('user not found'), $UNHASH, $MNHASH, $PWDHASH, $IPLASTLOGIN, $USERAGENT);
	}
}


echo '<?xml version="1.0" encoding="UTF-8"?>';

?>

<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="application/xhtml+xml; charset=UTF-8"/>
<title>Wethrbug</title>
<?php include("$ROOT/common/inc/style.inc.php");  ?>
<script language="javascript" type="text/javascript">
function cleanUpPassword(){
	// FORMAT MOBILE NUMBER
	var password=document.getElementById("password").value;
	var passwordconfirm=document.getElementById("passwordconfirm").value;
		
	if(!validReqField(password)){
		document.getElementById("formStatus_pwd").innerHTML="<span style='font-weight:bold; color:#E10000;'>Invalid Password</span>";
		return false;	
	}else{
		document.getElementById("formStatus_pwd").innerHTML="";
		if(password!=passwordconfirm){
			document.getElementById("formStatus_confirm").innerHTML="<span style='font-weight:bold; color:#E10000;'>Invalid Password Confirmation</span>";
			return false;	
		}else{
			document.getElementById("formStatus_confirm").innerHTML="";
			return true;
		}
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
 <form id="getWethr_form" action="./saveZip.php" method="post" onsubmit="if(!cleanUpPassword()){ return false; }">
      <div>
 
        <input type="hidden" name="zipcode" id="zipcode" value="<?php echo $_SESSION['zipcode']; ?>" style="background-color:#999;" />
        <input type="hidden" name="mobilenumber" id="mobilenumber" value="<?php echo $_SESSION['mobilenumber']; ?>" />
        <input type="hidden" name="status" id="status" value="<?php echo $_SESSION['status']; ?>" />
        
        <div class="cb_small"></div>
		<table cellpadding="0" cellspacing="0" border="0">
        <tr>
        <td align="right">
        	<div class="fieldtitle">Password: </div>
        </td>
        <td style="padding-left:10px;">
        <input type="password" name="password" id="password" />
        <div id="formStatus_pwd"></div>
        </td>
        </tr>
        <tr>
        <td align="right">
        	<div class="fieldtitle">Confirm Password: </div>
        </td>
        <td style="padding-left:10px;">
        <input type="password" name="passwordconfirm" id="passwordconfirm" />
        <div id="formStatus_confirm"></div>
        </td>
        </tr>
        </table>
        <div class="cb_small"></div>
        <table cellpadding="0" cellspacing="0" border="0">
        <tr>
        <td>
        <input type="submit" value="Save new ZIPCODE + Password" />
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
