<?php
session_start();

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<?php

if($rmpheader<>""){
	echo	"<title>$rmpheader</title>";
}else{
	echo	"<title>Client Administration System - 5 Web Development</title>";
}

?>
  
    <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
    <meta http-equiv="expires" content="-1" />
    <meta http-equiv="pragma" content="no-cache" />
    <meta name="author" content="CommercialNet" />
    <meta name="ROBOTS" content="ALL" />
    <meta name="description" content="Ev" />
    <meta name="KEYWORDS" content="" />
	
<style type="text/css">

@import url("http://www.fivedev.com/client/extstyle.css");

</style>

<link rel="shortcut icon" href="favicon.ico" />

<script language="javascript" type="text/javascript">
<!-- hide from javascript disabled browsers.

//-->
</script>
</head>

<body>


<div id="nav">
	<div id="topGrey"></div>
	<div id="links">
		<div class="mainNav"><a href="../index.html">Home</a></div>
		<div class="mainNav"><a href="../about.shtml">About Us</a></div>
		<div class="mainNav"><a href="../portfolio.shtml">Portfolio</a></div>
		<div class="mainNav"><a href="../resources.shtml">Resources</a></div>
		<div class="mainNav"><a href="../technology.shtml">Technology</a></div>
		<div class="mainNav"><a href="../services.shtml">Services</a></div>
		<div class="mainNav"><a href="../contact.shtml">Contact Us</a></div>
	</div>
</div>


<div id="headerLogo">
	<div id="logo">
	</div>
</div>


<div id="r6bodyCopy">

	<?php
		echo "<table width=\"100%\" align=\"center\">";

		// Determine page name
		$backwards=strrev($SCRIPT_NAME);
		list($template)=explode("/",$backwards);
		$template=strrev($template);

	echo "<td align=\"right\">";

	echo "</td></tr>";
	echo "</table>";
	?>
            <!-- CONTENT AREA START -->