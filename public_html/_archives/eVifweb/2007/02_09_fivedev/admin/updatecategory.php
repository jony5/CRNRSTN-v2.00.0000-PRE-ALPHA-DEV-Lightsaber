<?php
	session_start();
	include("security.inc.php");
	include("database.inc.php");
	

	$photoID=$_GET['myphotoID'];
	$newcategory=$_GET['categoryselection'];
	if($photoID!="" && $newcategory!=""){

	$ts=date("Y-m-d H:i:s");
	$querymessage2=mysql_query("update photos set myplaceID='$newcategory',datemodified='$ts' where id='$photoID'");
	
	mysql_query($querymessage2);	
		
	}
?>
