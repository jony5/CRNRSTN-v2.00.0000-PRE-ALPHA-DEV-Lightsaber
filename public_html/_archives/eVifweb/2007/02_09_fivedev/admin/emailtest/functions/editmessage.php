<?php
echo "<div>";
echo "<div id=\"emailheader\">";

	echo "<div id=\"emailbutton\">";
		echo "<form action=\"testing.php\" method=\"post\" ENCTYPE=\"multipart/form-data\">";
		echo "<input type=\"hidden\" name=\"email_mod\" value=\"savemessage\">";
		echo " <input type=\"submit\" name=\"Submit\" value=\"Save Changes\">";
	echo "</div>";

	echo "<h1>Current Test Email</h1>";

echo "</div>";

$querymessage=mysql_query("select message from moxie_message where status='active' and userid='$clientid'");

while(list($message)=mysql_fetch_row($querymessage)){
	echo "<h2>Message: </h2><textarea name=\"message\" cols=\"75\" rows=\"15\" id=\"message\">$message</textarea>";

}


echo "</form></div>";
echo "<hr><br>";


echo "<form action=\"testing.php\" method=\"post\" ENCTYPE=\"multipart/form-data\">";
echo "<input type=\"hidden\" name=\"email_mod\" value=\"\">";
echo " <input type=\"submit\" name=\"Submit\" value=\"Cancel\">";
?>
