<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>EvifWeb Development</title>
</head>
<?php
	$message="work";
?>
<body style="text-align:center; vertical-align:middle;">

<a href="http://www.moxieinteractive.com" target="_blank"><img src="imgs/glogo_moxie.gif" width="163" height="97" border="0" alt="Moxie Interactive" /></a>
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