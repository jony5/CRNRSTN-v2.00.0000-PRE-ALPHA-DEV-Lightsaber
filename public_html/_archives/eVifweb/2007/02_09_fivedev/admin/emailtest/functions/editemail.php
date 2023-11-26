<?php
echo "<div>";
echo "<div id=\"emailheader\">";

	echo "<div id=\"emailbutton\">";
		echo "<form action=\"testing.php\" method=\"post\" ENCTYPE=\"multipart/form-data\">";
		echo "<input type=\"hidden\" name=\"email_mod\" value=\"saveemail\">";
		echo " <input type=\"submit\" name=\"Submit\" value=\"Save Changes\">";
	echo "</div>";

	echo "<h1>Current Test Email</h1>";

echo "</div>";

$queryemail=mysql_query("select id, email, login, count from moxie_email where status='active' and userid='$clientid'");

$cc=0;
while(list($id,$email, $login, $count)=mysql_fetch_row($queryemail)){
	echo "<h2>Email: </h2><input type=\"text\" name=\"email$cc\" size=\"50\" value=\"$email\">";
	echo "<h2>Login: <font color=\"#cccccc\" size=\"-3\">(Enter a URL below to change your static email text into a hyperlink.)</font></h2><input type=\"text\" name=\"login$cc\" size=\"75\" value=\"$login\">";

	echo "<input type=\"hidden\" name=\"emailid$cc\" value=\"$id\">";
	echo "<hr><br>";
	$cc++;
}


echo "</form></div>";
echo "<hr><br>";
echo "<form action=\"testing.php\" method=\"post\" ENCTYPE=\"multipart/form-data\">";
echo "<input type=\"hidden\" name=\"email_mod\" value=\"\">";
echo " <input type=\"submit\" name=\"Submit\" value=\"Cancel\">";
?>
