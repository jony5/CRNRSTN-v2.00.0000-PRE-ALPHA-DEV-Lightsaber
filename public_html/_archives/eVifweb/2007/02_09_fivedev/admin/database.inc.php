<?php

if($SCRIPT_NAME=="/database.inc.php"){
	echo "Access Denied!<br>You shouldn't be here and your presence has been classified as an unauthorized access attempt.  
Your IP address ($REMOTE_ADDR) has been recorded and an incident report is has been made to the security officer on 
duty.  You have 30 seconds to leave.";}else{

 # connect to database
$link=mysql_connect("localhost","fivedevc_5stdusr","ni50cu37") or die ("Database Server Connection Failed");

mysql_select_db('fivedevc_5admin') or die ("Database select failed");

$ts=date("Y-m-d H:i:s",time());
}
?>
