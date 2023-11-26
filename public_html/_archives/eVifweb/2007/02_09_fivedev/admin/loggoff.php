<?php
session_start();
include("database.inc.php");

$sessionid=session_id();
$querystring="delete from sessions where phpsession='$sessionid' and usertype='admin'";
mysql_query("$querystring") or die(mysql_error());

session_destroy();

echo "You are logged out. If you are not redirected in 5 seconds, <a href='http://www.jony5.com' target='_self'>click here</a>.";
echo "<META HTTP-EQUIV=Refresh CONTENT=\"0; URL=http://www.jony5.com\">";
?>

