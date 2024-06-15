<?php

$email0=$_POST['email0'];
$login0=$_POST['login0'];
$emailid0=$_POST['emailid0'];
$email1=$_POST['email1'];
$login1=$_POST['login1'];
$emailid1=$_POST['emailid1'];
$email2=$_POST['email2'];
$login2=$_POST['login2'];
$emailid2=$_POST['emailid2'];
$email3=$_POST['email3'];
$login3=$_POST['login3'];
$emailid3=$_POST['emailid3'];
$email4=$_POST['email4'];
$login4=$_POST['login4'];
$emailid4=$_POST['emailid4'];
$email5=$_POST['email5'];
$login5=$_POST['login5'];
$emailid5=$_POST['emailid5'];
echo "<div>";

echo "Saving changes to email addresses...<br><br>";

if(strlen($email0)>6){
	echo "Saving changes to $email0... <br><br>";
	$ts=date("Y-m-d H:i:s");
	$queryemail2=mysql_query("update moxie_email set email='$email0', login='$login0', datemodified='$ts' where userid='$clientid' and id='$emailid0'");
	mysql_query($queryemail2);
}else{

	$ts=date("Y-m-d H:i:s");
	$queryemail2=mysql_query("update moxie_email set email='$email0', login='$login0', datemodified='$ts' where userid='$clientid' and id='$emailid0'");
	mysql_query($queryemail2);
	}


if(strlen($email1)>6){
	echo "Saving changes to $email1... <br><br>";
	$ts=date("Y-m-d H:i:s");
	$queryemail3=mysql_query("update moxie_email set email='$email1', login='$login1', datemodified='$ts' where userid='$clientid' and id='$emailid1'");
	mysql_query($queryemail3);
}else{

	$ts=date("Y-m-d H:i:s");
	$queryemail2=mysql_query("update moxie_email set email='$email0', login='$login0', datemodified='$ts' where userid='$clientid' and id='$emailid0'");
	mysql_query($queryemail2);
	}


if(strlen($email2)>6){
	echo "Saving changes to $email2... <br><br>";
	$ts=date("Y-m-d H:i:s");
	$queryemail4=mysql_query("update moxie_email set email='$email2', login='$login2', datemodified='$ts' where userid='$clientid' and id='$emailid2'");
	mysql_query($queryemail4);
}else{

	$ts=date("Y-m-d H:i:s");
	$queryemail2=mysql_query("update moxie_email set email='$email0', login='$login0', datemodified='$ts' where userid='$clientid' and id='$emailid0'");
	mysql_query($queryemail2);
	}


if(strlen($email3)>6){
	echo "Saving changes to $email3... <br><br>";
	$ts=date("Y-m-d H:i:s");
	$queryemail5=mysql_query("update moxie_email set email='$email3', login='$login3', datemodified='$ts' where userid='$clientid' and id='$emailid3'");
	mysql_query($queryemail5);
}else{

	$ts=date("Y-m-d H:i:s");
	$queryemail2=mysql_query("update moxie_email set email='$email0', login='$login0', datemodified='$ts' where userid='$clientid' and id='$emailid0'");
	mysql_query($queryemail2);
	}


if(strlen($email4)>6){
	echo "Saving changes to $email4... <br><br>";
	$ts=date("Y-m-d H:i:s");
	$queryemail6=mysql_query("update moxie_email set email='$email4', login='$login4', datemodified='$ts' where userid='$clientid' and id='$emailid4'");
	mysql_query($queryemail6);
}else{
	$ts=date("Y-m-d H:i:s");
	$queryemail2=mysql_query("update moxie_email set email='$email0', login='$login0', datemodified='$ts' where userid='$clientid' and id='$emailid0'");
	mysql_query($queryemail2);
	}


echo "<META HTTP-EQUIV=Refresh CONTENT=\"0; URL=testing.php\">";

echo "</div>";
echo "<hr><br>";
?>
