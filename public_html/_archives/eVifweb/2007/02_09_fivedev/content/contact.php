<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>EvifWeb Development</title>
</head>
<?php
	$message="contact 5";
?>
<body>
<span  style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:17px;"><?php echo $message; ?></span><br /><br /><br />
<a href="mailto:support@evifwebdev.com" target="_blank">Click here</a> to send me an email. 
<!-- Grey bar at bottom -->
<div id="bottomGrey">
	<div id="footer">&copy; EvifWeb Development</div>
	<div id="counter" style="color:#FFFFFF;"></div>
</div>
<script language="javascript" type="text/javascript">
	document.getElementById('footer').innerHTML = '&copy; EvifWeb Development';	
	new Ajax.Updater('footer', 'content/footer.php', {asynchronous:true, evalScripts:true});
</script>
</body>
</html>