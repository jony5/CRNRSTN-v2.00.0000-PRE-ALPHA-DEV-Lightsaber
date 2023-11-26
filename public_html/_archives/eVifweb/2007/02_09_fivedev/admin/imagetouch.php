<?php
	session_start();
	include("database.inc.php");
	//$domain = GetHostByName($REMOTE_ADDR);

	$filename=$_GET['image'];

	if($filename!=""){

	$querystring="select id, viewcount from photos where status='active' and filename='$filename'";
	$query=mysql_query("$querystring");
	
	list($id,$viewcount)=mysql_fetch_row($query);

//	$viewcount = eval($viewcount);
	$viewcount++;

	$ts=date("Y-m-d H:i:s");
	$querymessage2=mysql_query("update photos set viewcount='$viewcount',datelastclicked='$ts' where id='$id'");
	mysql_query($querymessage2);	
		
	$insertphotoclick="insert into photoclicklog(filename, dateclicked, ipaddress) values ('".$filename."','".$ts."','".$_SERVER['REMOTE_ADDR']."');";
	mysql_query("$insertphotoclick");		
		
	}
?>
