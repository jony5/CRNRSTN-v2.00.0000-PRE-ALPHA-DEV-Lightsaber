<?php
echo "<div>";

echo "Saving new mesage...";

$ts=date("Y-m-d H:i:s");
$querymessage2=mysql_query("update moxie_message set message='$message', datecreated='$ts' where userid='$clientid'");

mysql_query($querymessage2);

echo "<META HTTP-EQUIV=Refresh CONTENT=\"0; URL=testing.php\">";

echo "</div>";
echo "<hr><br>";
?>
