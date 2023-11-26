<?php
session_start();
include_once("database.inc.php");
include_once("security.inc.php");

$clientid=$_SESSION['client_userid'];
$emailmode=$_GET['mode'];
$message=$_POST['message'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<link href="moxstyle.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="../flash/flashobject.js"></script>
<script type="text/javascript" src="../flash/JavaScriptFlashGateway.js"></script>
<script type="text/javascript" src="functions.js"></script>
<title>5 Web Development - Email Quality Managment</title>

</head>
<body>
<div id="header">
	<div id="logo5"><img src="../images/logo2.jpg" width="171" height="92" border="0" alt="5" title="5" /></div>
</div>
<div id="shell">
	<div id="navframe"></div>
	<div id="navshell">
		<div id="flashnav">
			<p><font style=" font-family:Verdana; font-size:14px; color:#FF0000;"><b>****** Stop Playin! Turn your Flash back on.******</b><br /><br /></font></p>
		</div>
	</div>
	<script type="text/javascript" language="javascript">
    var uid = new Date().getTime(); 
		var fo = new FlashObject("../flash/moxnav.swf", "movie", "130", "500", "6", "#ffffff");
		fo.addParam("quality", "high");
		fo.addParam("wmode", "opaque");
		<?php
		include_once("emailtest/loademail.inc");
		?>
		fo.addVariable("lcId",uid);
		fo.addParam("movie", "../flash/moxnav.swf");
		fo.write("flashnav");
	</script>
	<div id="bodycontent">