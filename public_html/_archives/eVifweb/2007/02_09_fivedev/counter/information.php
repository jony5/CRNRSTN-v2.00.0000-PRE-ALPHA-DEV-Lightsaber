<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
      <html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head><title>PHPCounter 7 Information Page</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<link href="phpcounter.css" rel="stylesheet" /></head>
<body>
<!--START Heading Table-->
	<table width="100%" cellpadding="0" cellspacing="0" border="0">
		<tr>
			<td class="HeadLeftTD">
				<!--eKstreme.com logo here?-->&nbsp;
			</td>

			<td class="HeadRightTD" colspan="2">
				<span class="BeforeCOM">eKstreme</span><span class="COM">.com</span> 
                                PHPCounter VII
			</td>
		</tr>
	</table>
	<!--END Heading Table-->
<h1>PHPCounter Information Page</h1>
<p>Welcome to the PHPCounter Information Page. This page is designed to help in troubleshooting your 
installation of PHPCounter. I will probably ask you for the URL of this page if you ask for help.</p>
<p><a href="index.php">Back to index page</a>.</p>
<h2>Using PHPCounter</h2>
<p>To use PHPCounter, put the following code inside your PHP pages where you want the count to appear:</p>
<p class="code"><?php echo "require \"" . str_replace("\\", "/", dirname(__FILE__)) . "/phpcounter.php\";"; ?></p>
<h2>Dawn and Epoch</h2>
<?php
require dirname(__FILE__) . "/functions.php";
$Settings = array();
$Settings = parse_ini_file(dirname(__FILE__) . "/settings.ini"); // load the settings
require dirname(__FILE__) . "/prelims.php";

echo "<p>Dawn of current epoch was: " . date("d-M-y", $GLOBALS["Dawn"]) . "</p>";
echo "<p>Current epoch will end: " . date("d-M-y", $GLOBALS["EndOfEpoch"]) . "</p>";

?>
<h2>Settings</h2>
<p class="code"><?php
show_source("settings.ini");
?></p>
<h2>Permissions</h2>
<p>For PHPCounter to work, some files and directories need to have the correct permissions. On most servers, 
the correct permissions are 777, but on some servers, PHPCounter may work with 666. Below are the current settings.
If PHPCounter is not working and the permissions are not 777, try changing them to 777 using CHMOD. For more information
about permissions, see the <a href="http://ekstreme.com/phplabs/phpcounter.faq.php">PHPCounter FAQ page</a>.</p>

<?php
echo "<p>Permissions of dawn.txt: " . substr(sprintf('%o', fileperms("dawn.txt")), -4) . "</p>";
echo "<p>Permissions of /locks: " . substr(sprintf('%o', fileperms("locks")), -4) . "</p>";
echo "<p>Permissions of /globals: " . substr(sprintf('%o', fileperms("globals")), -4) . "</p>";
echo "<p>Permissions of /counts: " . substr(sprintf('%o', fileperms("counts")), -4) . "</p>";

?>
<hr/>
<p>End of PHPCounter information.</p>

</body></html>

