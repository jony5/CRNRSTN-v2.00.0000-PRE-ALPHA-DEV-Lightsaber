<?php
session_start();
include("root.inc.php");
include("$ROOT/db/wethrdb.inc.php");
include("$ROOT/common/inc/logs.inc.php");

$mobilenumber=$_SESSION['mobilenumber'];
$username=$_SESSION['zipcode'];
$status=$_SESSION['status'];
$password=addslashes(trim($_POST['password']));

$failedloginattempts=$_POST['failedloginattempts'];
$failedloginattempts++;

$_SESSION['failedloginattempts']=$failedloginattempts;

$MNHASH = md5($mobilenumber); 
$UNHASH = md5($username); 
$PWDHASH = md5($password); 
$IPLASTLOGIN=addslashes($_SERVER['REMOTE_ADDR']);
$USERAGENT=addslashes($_SERVER['HTTP_USER_AGENT']);

//
// PERFORM SYSTEM LOOKUP FOR LOGIN VERIFICATION
$query=mysql_query("select ID, USERNAME, MOBILENUMBER, STATUS, NACL, UNHASH, MNHASH, PWDHASH, DATECREATED, DATELASTLOGIN, IPLASTLOGIN, LOGINCOUNT from users where UNHASH='".$UNHASH."' AND MNHASH='".$MNHASH."' AND PWDHASH='".$PWDHASH."' AND ROWSTATUS='active' LIMIT 1");
if(mysql_num_rows($query)<1){
	//
	// THIS USER EXISTS IN THE DATABASE
	logActivity('login access denied',crc32('login access denied'), $UNHASH, $MNHASH, $PWDHASH, $IPLASTLOGIN, $USERAGENT);
	header("Location: $ROOT/errorLogin.php");
	exit();
	
}else{
	list($ID, $USERNAME, $MOBILENUMBER, $STATUS, $NACL, $UNHASH, $MNHASH, $PWDHASH, $DATECREATED, $DATELASTLOGIN, $IPLASTLOGIN, $LOGINCOUNT)=mysql_fetch_row($query);
	
	//
	// LOGIN
	loginSuccessful($ID, $USERNAME, $MOBILENUMBER, $STATUS, $NACL, $UNHASH, $MNHASH, $PWDHASH, $DATECREATED, $DATELASTLOGIN, $IPLASTLOGIN, $LOGINCOUNT);
	logActivity('login access granted',crc32('login access granted'), $UNHASH, $MNHASH, $PWDHASH, $IPLASTLOGIN, $USERAGENT);	
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
	function loadPage(){
		window.location="<?php echo $ROOT; ?>/4dayreport/";	
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
Welcome to wethrbug. <br /><br />This site was created to provide certain guarantees on the protection of your privacy.<br /><br />

Conversations expire after a period of time and everything in the database is encrypted.<br /><br />

You can send feedback to the site administrator by adding &quot;webmaster&quot; to your friend list.<br /><br />

Thanks for using wethrbug! 
</div>

<div class="cb_small"></div>

<div>Mobilenumber: <strong style="color:#CF3"><?php echo $_SESSION['mobilenumber']; ?></strong></div>
<div>Zipcode: <strong style="color:#CF3"><?php echo $_SESSION['zipcode']; ?></strong></div>

<div class="cb_small"></div>
<?php
$queryUser=mysql_query("select ID from preferences where USERID='".$_SESSION['USERID']."' LIMIT 1");
if(mysql_num_rows($queryUser)<1){
?>
    <div style="background-color:#993300; border:1px solid #FF0;">
        <div style="padding:10px; text-align:center;"><a href="<?php echo $ROOT; ?>/4dayreport/prefctr/">Enter Wethrbug</a></div>
        <div class="cb_mini"></div>
    </div>
<?php
}else{
?>
    <div style="background-color:#993300; border:1px solid #FF0;">
        <div style="padding:10px; text-align:center;"><a href="<?php echo $ROOT; ?>/4dayreport/">Enter Wethrbug</a></div>
        <div class="cb_mini"></div>
    </div>
<?php 
}
?>


    </form>

  <div> </div>
</div>
</div>
<?php include("$ROOT/common/inc/footer.inc.php");  ?>
</body>
</html>
