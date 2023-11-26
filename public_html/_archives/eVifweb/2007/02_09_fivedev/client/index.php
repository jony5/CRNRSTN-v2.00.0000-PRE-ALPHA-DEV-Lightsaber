<?php include_once("extheader.inc.php"); ?>
<form action="../admin/login.php" method="post">
<?php 

$status=$_GET['status'];
if($status=="error1"){
	//Access Denied
	$message="The username and password you entered are not valid.  Please try again.";
}
if($status=="error2"){
	//Access Denied
	$message="We appologize, but this account is no longer active.";
}


echo "<b>$message</b>";?>
<table border="0" cellspacing="0" cellpadding="3">
	<tr>	
		<td align="right">Username:</td>
		<td>
			<?php echo "<input type=\"text\" name=\"username\"  value=\"$username\">";?>
		</td>
	</tr>
	<tr>	
		<td align="right">Password:</td>
		<td>
			<input type="password" name="password">
		</td>
	</tr>
	<tr>	
		<td align="center" colspan="2">
			<input type="submit" value=" Login "> <p align="right">
		</td>
	</tr>
	<tr>	
		<td align="center" colspan="2">
			Don't have an account?  <a href="newaccount.php">Create one here!</a>
		<br><tr><td align="right" colspan="2">
  			  <a href="forgotpassword.php"> Forget your username or password?</a> </p></td></tr>
		</td>
	</tr>
</table>
</form>
<?php include("footer.inc.php"); ?>

