<?php
	//session_start();
	include("../security.inc.php");
	include("../database.inc.php");
	
	$page=$_GET['page'];
	$category=$_GET['category'];
	if($page==""){
		$page=1;
	}
	if($category==""){
		$category=6;
	}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="../css/fivestyle.css" type="text/css" rel="stylesheet" />
<script src="../script/prototype.js" type="text/javascript"></script>
<script src="../script/scriptaculous.js" type="text/javascript"></script>
 
<title>Evifweb Development</title>

</head>

<body>

<div style="padding:20px;">
	Click the Syncronize Database button if you have FTP'd new images to the <br />
	public_html\photodump directory and would like to add them to the database.<br /><br />
	<a href="content/sync.php" target="_blank"><img src="../../imgs/sync_btn.gif" width="197" height="26" border="0" alt="synchronize database" /></a><br />
	(Please note that all images will be categorized as general until you process them.)<br /><br />	
</div>
<div id="dbsync">

</div>

	<div id="gallerycontent" style="width:700px; height:1200px;">
	<iframe title="life" name="life" id="galleryframe" src="content/photoscontent.php?page=1" style="border-width:0" width="800" frameborder="0" height="1200"></iframe>
	</div>


</body>
</html>
