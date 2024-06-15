<?
if(!isset($already_connected_to_db)){
	$already_connected_to_db=1;
	//$hostname="localhost";
	mysql_connect($dbhostname, $dbusername, $dbpassword) OR Header("Location:$htmlrootpath/db_error.htm");
	@mysql_select_db("$dbName") or die( "Unable to select database");
}
?>
