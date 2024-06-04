<?php
session_start();
session_destroy();
session_start();
include("root.inc.php");
include("$ROOT/db/wethrdb.inc.php");
include("$ROOT/common/inc/logs.inc.php");
$mobilenumber=$_SESSION['mobilenumber'];
$username=$_SESSION['zipcode'];
$_SESSION['username']=$username;
$status=$_SESSION['status'];
$IPLASTLOGIN=addslashes($_SERVER['REMOTE_ADDR']);
$USERAGENT=addslashes($_SERVER['HTTP_USER_AGENT']);

logActivity('500 error',crc32('500 error'), $UNHASH, $MNHASH, $PWDHASH, $IPLASTLOGIN, $USERAGENT);

echo '<?xml version="1.0" encoding="UTF-8"?>';

?>
<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="application/xhtml+xml; charset=UTF-8"/>
<title>Wethrbug</title>
<style type="text/css">
	*				{ font-family:Arial, Helvetica, sans-serif; font-size:small; color:#FFF;}
	body  			{padding:0px; margin:0px; background-color:#000;}
	input								{ color:#000;}
	/*    
	font-size:118%;
	line-height:105%
	
	font-size:medium
	font-size:small
	font-size:x-small
	*/
	#body_wrapper						{ margin:10px;}
	.hometitle							{ font-size:medium; }
	.hometinysubtitle					{ font-size:x-small; }
	.subtitle							{ font-size:small; font-weight:bold; color:#090}
	.fieldtitle							{ font-size:11px;}
	.weatherIcon						{ float:left; padding:10px;}
	.legal								{ font-size:x-small; text-align:center; margin:0px auto;}
	#formStatus							{ font-size:11px; color:#F00;}
	
	.err								{ color:#F30;}
	.cb 								{ display:block; clear:both; height:0px; line-height:0px; overflow:hidden; width:100%; font-size:1px;}
	.cb_mini							{ display:block; clear:both; height:1px; line-height:1px; overflow:hidden; width:100%; padding-bottom:4px;  font-size:1px;}
	.cb_small 							{ display:block; clear:both; height:10px;  line-height:1px; overflow:hidden; border:0px; padding:0px; margin:0px; font-size:1px;}
	.cb_small20							{ display:block; clear:both; height:20px;  line-height:1px; overflow:hidden; border:0px; padding:0px; margin:0px; font-size:1px;}	
	
</style>
</head>
<body><div>
<div id="body_wrapper">
<div class="hometitle">Wethrbug</div>
<div class="hometinysubtitle">Pulling real-time weather lookups through
Google’s web systems. That makes it fast.</div>

<div class="cb_small"></div>

<div class="hometitle">We're sorry. There was an 500 Server Error. A misconfiguration on the server caused a hiccup.
Check the server logs, fix the problem, then try again.<br><br>Or..please <a href="../">click here</a> to return for more wethr.</div>
<div class="cb_small"></div>

 <div class="cb_small"></div>

  <div> </div>

</div>
</div>
<div class="legal">&copy; 2011 All Rights Reserved.</div>
</body>
</html>