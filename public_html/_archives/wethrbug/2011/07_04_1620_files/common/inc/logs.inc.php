<?php 
function logActivity($CODE, $CODE_CRC32, $UNHASH, $MNHASH, $PWDHASH, $IPLASTLOGIN, $USERAGENT){
	//
	// LOG APPLICATION ACTIVITY
	$logActivity="insert into activitylogs (CODE,CODE_CRC32, UNHASH, MNHASH, PWDHASH, IPADDRESS, USERAGENT) 
	values('".$CODE."', '".$CODE_CRC32."', '".$UNHASH."', '".$MNHASH."', '".$PWDHASH."', '".$IPLASTLOGIN."', '".$USERAGENT."');";
	mysql_query("$logActivity") or die (mysql_error()." on ".$logActivity);	
	
}


?>
