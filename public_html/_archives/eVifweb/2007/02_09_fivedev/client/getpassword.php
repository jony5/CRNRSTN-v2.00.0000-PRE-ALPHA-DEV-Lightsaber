<?php
//include("security.inc.php");
include("header.inc.php");
echo "<h1>Password Recovery</h1>";



if(strlen($email)>2){
	include("database.inc.php");
	$email=trim($email);
	$query=mysql_query("select username, password from clients where email1='$email'") or die(mysql_error());

	while(list($username,$password)=mysql_fetch_row($query)){
		mail("$email","Your password","Thank you for requesting your username and password.  Your username is \"$username\" and your password is \"$password\" (without the quotation marks).\n\nIf there is anything else we can do for you, please let us know.","From: staff@commercialnet.biz","-fstaff@commercialnet.biz");
	}
	if(mysql_num_rows($query)>0){
		echo "Your username and password have been sent to your email.<p><a href=\"index.php\">Click here to login.</a>";
	}else{
		echo "We could not locate an account with that email address.  Please contact technical support for assistance.";
	}

}else{

	echo "Please enter your email address below.  We will automatically send your username and password";
	echo "<p>";
	echo "<form action=\"$PHP_SELF\" method=\"post\">";
	echo "Email: <input type=\"text\" name=\"email\"><input type=\"submit\" value=\"Continue\">";

	echo "</form>";

}





include("footer.inc.php");
?>
