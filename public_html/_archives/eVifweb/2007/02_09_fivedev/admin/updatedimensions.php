<?php
	session_start();
	include("security.inc.php");
	include("database.inc.php");
	

	$photoID=$_GET['myphotoID'];
	$newcategory=$_GET['categoryselection'];
	if($photoID!=""){

		$querystring="select thumbwidth, thumbheight from photos where status='active' and id='$photoID' and transformed='1'";
		$query=mysql_query("$querystring") or die("Terminal Error - Contact <a href='mailto:support@evifwebdev.com' target='blank'>Support</a> -$querystring returned ".mysql_error());

		list($thumbwidth, $thumbheight)=mysql_fetch_row($query);
		
		$heightnew=$thumbwidth;
		$widthnew=$thumbheight;
		
		$ts=date("Y-m-d H:i:s");
		$querymessage2=mysql_query("update photos set thumbwidth='$widthnew',thumbheight='$heightnew',datemodified='$ts' where id='$photoID'");
		mysql_query($querymessage2);	
		
	}
?>
