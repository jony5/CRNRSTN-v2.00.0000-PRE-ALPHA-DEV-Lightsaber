<?php

include_once("database.inc.php");
$name=$_POST['name'];
$phone1=$_POST['phone1'];
$phone1type=$_POST['phone1type'];
$phone2=$_POST['phone2'];
$phone2type=$_POST['phone2type'];
$email=$_POST['email'];
$company=$_POST['company'];
$subject=$_POST['subject'];
$message=$_POST['message'];

/*

echo "Name: $name<br>";
echo "Phone 1: $phone1<br>";
echo "Ph 1 Type: $phone1type<br>";
echo "Phone 2: $phone2<br>";
echo "Ph 2 Type: $phone2type<br>";
echo "Email: $email<br>";
echo "Company: $company<br>";
echo "Subject: $subject<br>";
echo "Message: $message<br>";
*/

$ts=date("Y-m-d H:i:s");

if(strlen($name)<2){
	$errors[]="You must supply your name.";
}
if(strlen($email)<5 and strlen($phone1)<10 and strlen($phone2)<10){
	$errors[]="You must supply either your email address or a phone number.";
}

if(sizeof($errors)<1){
	$message="The following message was submitted by $name on $ts.\n\n
------------------------------------------------------------ \n
Subject:		$subject\n\n
Company: 	$company\n
Email Address:	$email\n
Primary Phone:	$phone1type - $phone1\n
Secondary Phone:	$phone2type - $phone2\n\n
Message:\n
$message \n
------------------------------------------------------------ \n";

	$querystring="insert into contactrequest(name, email, company, phone1, phone2, phone1type, phone2type, message, datetime) 
values('$name','$email','$company','$phone1','$phone2','$phone1type','$phone2type','$message','$ts')";
	mysql_query("$querystring");

	mail("support@fivedev.com","Request for Contact - 5 Web Development","$message","From: $email","-f$email");

	echo "<p>Thank you for your interest in our services!  Your message has been received.</p>";
	echo "<br><a href=\"../index.html\">Return Home</a>";

}else{
	echo "<h1>Contact Us</h1><br>";
	echo "We cannot send your message for the following reason(s):<p><ul>";

	foreach($errors as $reason){
		echo "$reason<br>";
	}
	echo "</ul><br>";
    

	echo "<form action=\"sendcontact.php\" method=\"post\" class=\"td\" ENCTYPE=\"multipart/form-data\">";

	echo "<h2><u>Your Contact Information</u></h2>";
	echo "<blockquote>";

	echo "Name:<br><input type=\"text\" size=\"50\" name=\"name\" value=\"$name\"> <p>";

	echo "		Primary Contact Number:";
	echo "		<br><input type=\"text\" size=\"13\" name=\"phone1\" value=\"$phone1\">";
	echo "		<select name=\"phone1type\">";

		$phonetypes=mysql_query("select phonetype from phonetype");
		echo "<option value=\"\">-- Select Type --</option>";
		while(list($phonetype)=mysql_fetch_row($phonetypes)){
			echo "<option value=\"$phonetype\" ";
			if($phone1type==$phonetype){echo "selected";}
			echo ">$phonetype</option>";
		}
		mysql_data_seek($phonetypes,0);

	echo "		</select><br>";

	echo "		Secondary Phone:";
	echo "		<br><input type=\"text\" size=\"13\" name=\"phone2\" value=\"$phone2\">";
	echo "		<select name=\"phone2type\">";

			$phonetypes=mysql_query("select phonetype from phonetype");
			echo "<option value=\"\">-- Select Type --</option>";
			while(list($phonetype)=mysql_fetch_row($phonetypes)){
				echo "<option value=\"$phonetype\" ";
				if($phone2type==$phonetype){echo "selected";}
				echo ">$phonetype</option>";
			}
			mysql_data_seek($phonetypes,0);
	echo "		</select><br><br>";

	echo "Email:<br><input type=\"text\" size=\"50\" name=\"email\" value=\"$email\"><p>";
	echo "Company:<br><input type=\"text\" size=\"50\" name=\"company\" value=\"$company\"><p>";
	echo "<h2>Your Message:</h2>";
	echo "<blockquote>";
	echo "Message Subject:<br><input type=\"text\" size=\"50\" name=\"subject\" value=\"$subject\"><p>";

	echo "Message:<br>";
	echo "<textarea name=\"message\" cols=\"38\" rows=\"5\">$message</textarea>";

	echo "</blockquote>";
	echo "</span>";
	echo "<br><br><input type=\"submit\" value=\" Submit \"></form>";
	echo "</blockquote>";

include("footer.inc.php");
}
?>