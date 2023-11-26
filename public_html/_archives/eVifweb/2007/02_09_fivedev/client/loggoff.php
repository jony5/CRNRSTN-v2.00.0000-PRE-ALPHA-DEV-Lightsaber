<?php
session_start();
include("database.inc.php");
include("extheader.inc.php");


$sessionid=session_id();
$querystring="delete from sessions where phpsession='$sessionid' and usertype='client'";
mysql_query("$querystring") or die(mysql_error());

session_destroy();


echo "<br><br><p>You are logged out</p>";


//echo "<form action=\"../index.html\" method=\"\">";
//echo "<input type=\"submit\" value=\"Return to Home\">";

echo "</form>";
echo "<br><br><br><br><br><br>";
include("footer.inc.php");
?>
