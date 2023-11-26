<?php //include("header.inc.php"); ?>
<form action="getpassword.php" method="post">
<?php echo "<b>$message</b>";?>
<h2>Forget your username or password?</h2>
<table width="469" height="135" border="0" cellpadding="1" cellspacing="0">
  <tr> 
    <td height="63" colspan="2" align="right"> <div align="left">Don't worry. 
        Enter the email address you used when contacting us.  We will send you your Username and Password to you in minutes. </div></td>
  </tr>

  <tr>
    <td width="63" height="35" align="right">Email:</td>
    <td height="35" align="center"> 
      <div align="left">
        <input name="email" type="text" size="60">
      </div></td>
  </tr>
<br>

  <tr> 
    <td align="center" colspan="2"> <div align="center">
        <input name="submit" type="submit" value=" Request User ID and Password Now! ">
        <br>
      </div> 
  <tr> 
    <td align="right" colspan="2">&nbsp;</td>
  </tr></td></tr>
</table>
</form>
<?php include("footer.inc.php"); ?>

