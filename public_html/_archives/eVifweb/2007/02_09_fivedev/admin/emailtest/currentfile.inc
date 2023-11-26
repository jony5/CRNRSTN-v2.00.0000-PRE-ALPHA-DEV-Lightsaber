<?php
echo "<div>";
echo "<div id=\"emailheader\">";

	echo "<div id=\"emailbutton\">";
	echo "<form action=\"testing.php\" method=\"post\" ENCTYPE=\"multipart/form-data\">";
	echo "<input type=\"hidden\" name=\"email_mod\" value=\"editmessage\">";
	echo " <input type=\"submit\" name=\"Submit\" value=\"Update File\"></form>";
	echo "</div>";
echo "<span style=\"padding-left:0px;padding-top:0px; font-family:verdana; font-size:12px; color:#666666\">File Preview</span>";

echo "</div>";

$querymessage=mysql_query("select message from moxie_message where status='active' and userid='$clientid'");

list($message)=mysql_fetch_row($querymessage);
echo "$message";



echo "</div>";
?>