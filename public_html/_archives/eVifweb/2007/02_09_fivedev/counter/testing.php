<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
      <html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head><title>PHPCounter 7 Testing Page</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<link href="phpcounter.css" rel="stylesheet" /></head>
<body>
<!--START Heading Table-->
	<table width="100%" cellpadding="0" cellspacing="0" border="0" class="HeadingTable">
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
	<h1>PHPCounter Testing Page</h1>
	
	<p>This page is configured to work in all cases if you have correctly set up PHPCounter. If the counter on this 
	page is not working, then you did not set up PHPCounter correctly.</p>
	
	<p>Back to the <a href="index.php">index page</a>.</p>
	
	<h2>Count</h2>
	<p>If you configured PHPCounter to output the count (either as text or as images), then it should be visible 
	below.</p>
	<p>The count should be below...</p>
		<?php require "phpcounter.php"; ?>
	<p>The count should be above.</p>
	
	<h2>Currently Online</h2>
	<p>The number of users currently online is <?php echo $GLOBALS["CurrentlyOnline"]; ?>.</p>
	
	<h2>Total Visitors</h2>
	<p>The total number of visitors in the current epoch is <?php echo $GLOBALS["TotalVisitors"]; ?>.</p>
			
	<h2>Troubleshooting</h2>
	<p>This page should work if you have correctly configured PHPCounter. If the counter on this page is working,
	but you cannot get it to work on your other pages, then you need to check how you are calling PHPCounter. This
	is detailed in the <a href="help.php">help file</a>.</p>
	
</body></html>

	