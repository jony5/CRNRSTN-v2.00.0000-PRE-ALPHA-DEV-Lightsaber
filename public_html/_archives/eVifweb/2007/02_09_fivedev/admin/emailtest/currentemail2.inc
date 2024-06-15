<?php
echo "<div>";
echo "<div id=\"emailheader\">";
	echo "<div id=\"emailbutton\">";
		echo "<form action=\"testing.php\" method=\"post\" ENCTYPE=\"multipart/form-data\">";
		echo "<input type=\"hidden\" name=\"email_mod\" value=\"editemail\">";
		echo " <input type=\"submit\" name=\"Submit\" value=\"Update Addresses\"></form>";
	echo "</div>";

	echo "<h1>Current Test Email</h1>";

echo "</div>";

$queryemail=mysql_query("select email, login, count from moxie_email where status='active' and userid='$clientid'");
$emailcount=0;

while(list($email, $login, $count)=mysql_fetch_row($queryemail)){
	if(strlen($email)>6){
		if($login==""){
			echo "<table><tr><td width=\"200\">";
			echo "$email</td><td width=\"100\">";
			echo "<form name=\"form$emailcount\" action=\"testing.php\" method=\"post\" ENCTYPE=\"multipart/form-data\">";
			echo "<input type=\"hidden\" name=\"theemail\" value=\"$email\">";
			echo "<input type=\"hidden\" name=\"email_mod\" value=\"send\">";
			echo " <input type=\"submit\" name=\"Submit\" value=\"SEND\"></form>";
			echo "</td><td>";

			echo "<form name=\"form$emailcount\" action=\"testing.php\" method=\"post\" ENCTYPE=\"multipart/form-data\">";
			echo "<input type=\"hidden\" name=\"theemail\" value=\"$email\">";
			echo "<input type=\"hidden\" name=\"email_mod\" value=\"send\">";
			echo " <input type=\"submit\" name=\"Submit\" value=\"DELETE\"></form>";


			echo "</td></tr></table>";
			
			echo "</table></form>";
		}else{
			echo "<table><tr><td width=\"200\">";
			echo "<a href=\"$login\" target=\"_blank\">$email</a></td><td width=\"300\">";
			echo "<form name=\"form$emailcount\" action=\"testing.php\" method=\"post\" ENCTYPE=\"multipart/form-data\">";
			echo "<input type=\"hidden\" name=\"theemail\" value=\"$email\">";
			echo "<input type=\"hidden\" name=\"email_mod\" value=\"send\">";
			echo " <input type=\"submit\" name=\"Submit\" value=\"SEND\">";
			echo "</table></form>";

			$emailcount++;
		}
	}else{
		$emailcount++;
	}
}

echo "</div>";
echo "<hr><br>";
?>