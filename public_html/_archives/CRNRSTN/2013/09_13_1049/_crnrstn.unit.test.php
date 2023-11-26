<?php
	include_once('./_crnrstn.root.inc.php');
	include_once($ROOT.'/_crnrstn/_crnrstn.config.inc.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>CRNRSTN PHP Class Library :: Server Integration Unit Test</title>
<style type="text/css">
*		{ font-family:Arial, Helvetica, sans-serif;}

</style>
</head>

<body>
<h2>CRNRSTN PHP Class Library :: Server Integration Unit Test</h2>
<?php
	#$oCRNRSTN->unitTest_Include_All_Parameters_Even_DB_Passwords();
	$oCRNRSTN->unitTest_Expose_Server_Config_Only();
?>
</body>
</html>