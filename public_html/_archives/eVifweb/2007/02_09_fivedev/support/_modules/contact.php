<?
if(isset($destination) and isset($message) and $message!="")
{
/*
	$dateformat = "F j, Y, g:i a";
	# date
	$today = date($dateformat);

	

	$to = $destination;
	$subject = "Cyexx WebForm ($destination) $useremail <".$REMOTE_ADDR.">";
	$mailheaders = "Reply-to: $useremail \n";
	$mailheaders .= "From: $useremail\n\n";
	
	mail($to, $subject, $msg, $mailheaders);
*/

include("Mail.php");

$recipients = "admin@cyexx.com";

$headers["From"]    = "$useremail";
$headers["To"]      = "$destination";
$headers["Subject"] = "Cyexx WebForm ($destination) - $useremail ";



$msg .= "Sender:   $username\n";
$msg .= "message from $REMOTE_ADDR, $useremail on $today\n\n";
$msg .= "$message";

$body = "$msg";

$params["host"] = "localhost";
$params["port"] = "25";
$params["auth"] = true;
$params["username"] = "contact@cyexx.com";
$params["password"] = "j4f8cp3l";

// Create the mail object using the Mail::factory method

$mail_object =& Mail::factory("smtp", $params);
$mail_object->send($destination, $headers, $body);



	//echo "<pre>$recipients</pre>";
	//echo "<pre>".print_r($headers)."</pre>";
	//echo "<pre>$body</pre>";






	echo "<BR><BR>
	<table width=640 border=0 cellspacing=0 cellpadding=0>
	<TR>
		<td width=200 align=right><img src='images/contactus.jpg' border=0 alt='contact CyeXX.com'></td>
		<td width=10></td>
		<td width=1><img src='images/vline.gif' height=400 width=1></td>
		<td width=10></td>
		<td align=left>
			<font size=2>
			Thank you for your interest in CyeXX.<BR><BR>
			<B>Your message has been sent.</B>
			
			</font>
		</td>
	
	</tr>
	
	
	</table>
	<BR><BR>";

} else {

	echo "
	
	

	<table width=90% border=0 cellspacing=0 cellpadding=0>
	<TR>
		<td width=200 align=right><img src='images/contactus.jpg' border=0 alt='contact CyeXX.com'></td>
		<td width=10></td>
		<td width=1><img src='images/vline.gif' height=300 width=1></td>
		<td width=10></td>
		<td align=left>






		<form action='index.php?content=contact' method='post'>
			<font size=2>
			Inquiry: <select name=destination $input_style>
			
			<option value='services@cyexx.com'>Services</option>
			<option value='sales@cyexx.com'>Sales</option>
			<option value='hr@cyexx.com'>Human Resources</option>
			<option value='employment@cyexx.com'>Employment</option>
			<option value='webmaster@cyexx.com'>Webmaster</option>
			<option value='abuse@cyexx.com'>Abuse Department</option>
			<option value='support@cyexx.com'>Support</option>

			</select>
			<BR><BR>
			Your Name:&nbsp;
			<input type=text size=30 name=username $input_style><br>

			Your E-mail:
			<input type=text size=30 name=useremail $input_style><br><BR>
			<textarea name=message rows=10 cols=70 $input_style></textarea>
			<BR><BR>
			
			
			<input type=submit name=submit value='submit' $input_style>
			
			</font>
		</td>
	
	</tr>
	</form>
	
		<table width='70%' bgcolor='#e5e5e5' cellpadding=1 cellspacing=0><tr><td></td></tr><tr><td></td></tr></table>
	<BR>
		<table cellspacing=0 cellpadding=3 border=0 width=500>
		<tr>
		<td width=40>
		
		</td>
		
		<td width=280 valign=top align='center'>
			<font size=2 color=#000000><B>General</B><BR><BR></font>
			
			<table border=0>
			<font size=1><B>CyeXX Solutions</B><BR>
			Gwinnett Office<BR>
			4487B Park Drive<BR>
			Norcross, GA 30093<BR></font>
			</table>
		</td>
		<td width=250 valign=top align='center'>
			<font size=2 color=#000000>
			<B>Technical/Customer Support</B><BR><BR>
			</font>
			
			<table>
			<font size=1>
		        :: <B>Phone Support</B><BR>
                        &nbsp;&nbsp;&nbsp;678-367-4379<BR>
                        &nbsp;&nbsp;&nbsp;&nbsp;<font color='red'>10:00 - 6:00</font> Mon-Fri
                        &nbsp;&nbsp;&nbsp;</font><BR>
                        </font>
                        </table>
		</td>
		</tr>
		</table>
";
}


?>