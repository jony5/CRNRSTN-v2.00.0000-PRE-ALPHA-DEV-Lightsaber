<?php
session_start();
include("$DOCUMENT_ROOT/database.inc.php");
//include("header.inc.php");
//include("security.inc.php");

$sessionid=session_id();
$querystring="delete from sessions where phpsession='$sessionid' and usertype='agent'";
//echo $querystring;
mysql_query("$querystring") or die(mysql_error());

session_destroy();


echo "You are logged out<p>";


echo "<form action=\"index.php\" method=\"\">";
echo "<input type=\"submit\" value=\"Return to Login Screen\">";

echo "</form>";
?>
