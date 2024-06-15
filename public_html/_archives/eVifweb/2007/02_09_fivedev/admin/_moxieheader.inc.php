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

@import url("http://www.fivedev.com/admin/style.css");

</style>

<link rel="shortcut icon" href="favicon.ico" />

<script language="javascript" type="text/javascript">
<!-- hide from javascript disabled browsers.

//-->
</script>
</head>

<a name="top"></a>

<div id="adminheader">
	<div id="r6greyHead"></div>
	<div id="r6greyBarBttm"></div>
	<div id="r6greyBar"></div>
	<div id="CLIENTlogo"></div>
	<div id="adminlinks"><?php include("includes/moxie_adminnav.inc");?></div>
</div>
<body>

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
<br><br>
            <!-- CONTENT AREA START -->

