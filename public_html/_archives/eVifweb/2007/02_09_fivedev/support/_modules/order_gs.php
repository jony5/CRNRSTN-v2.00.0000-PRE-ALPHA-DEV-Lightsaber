<?
if($_POST['name']!="" AND $_POST['email']!="" AND $_POST['name']!="phone")
{
	$price = 0;
	
	//Get price
	if($_POST['maxplayers']=="10" AND $_POST['game']=="cspublic")
		$price = "49.99";
	
	if($_POST['maxplayers']=="16" AND $_POST['game']=="cspublic")
		$price = "69.99";
	
	if($_POST['maxplayers']=="20" AND $_POST['game']=="cspublic")
		$price = "99.99";
	
	if($_POST['maxplayers']=="10" AND $_POST['game']=="csprivate")
		$price = "35.99";
	
	if($_POST['maxplayers']=="16" AND $_POST['game']=="csprivate")
		$price = "55.99";
	
	if($_POST['maxplayers']=="20" AND $_POST['game']=="csprivate")
		$price = "75.99";

	if($_POST['psycostats'])
		$price = $price + 4.99;

//echo "++".$_POST['maxplayers']." ".$_POST['game']."++";




	include("Mail.php");
	
	$recipients = "sales@cyexx.com";
	
	$headers["From"]    = "WebMailer@cyexx.com";
	$headers["To"]      = "sales@cyexx.com";
	$headers["Subject"] = "Game Server Order - ".$_POST['email'];
	
	

	$msg .= "game server purchase from website\n\n";
	$msg .= "Name: ".$_POST['name']."\n";
	$msg .= "Email: ".$_POST['email']."\n";
	$msg .= "Phone: ".$_POST['phone']."\n\n";

	$msg .= "Price: ".$price."\n\n";

	$msg .= "Type: ".$_POST['game']."\n";
	$msg .= "Size: ".$_POST['maxplayers']." Players\n";
	$msg .= "Location: ".$_POST['location']."\n";
	$msg .= "Admin: ".$_POST['admin']."\n";
	
	if($_POST['statsme'])
		$msg .= "Statsme: Yes\n";
	if($_POST['psycostats'])
		$msg .= "PsycoStats: Yes\n";
		
	$msg .= "\nComments: ".$_POST['comments'];
	
	$body = "$msg";
	
	$params["host"] = "localhost";
	$params["port"] = "25";
	$params["auth"] = true;
	$params["username"] = "contact@cyexx.com";
	$params["password"] = "j4f8cp3l";
	
	// Create the mail object using the Mail::factory method
	
	$mail_object =& Mail::factory("smtp", $params);
	$mail_object->send($recipients, $headers, $body);
	
	//echo "<pre>$recipients</pre>";
	//echo "<pre>".print_r($headers)."</pre>";
	//echo "<pre>$body</pre>";
	









	echo "<BR><BR>
	<table width=640 border=0 cellspacing=0 cellpadding=0>
	<TR>
		<td width=200 align=right><img src='images/order_now.jpg' border=0></td>
		<td width=10></td>
		<td width=1><table border='0' cellspacing=0 cellpadding=0><tr><td bgcolor='#e3e3e3'><img src='images/blank.gif' height='250' width='1'></td></tr></table></td>
		<td width=10></td>
		<td align=left>
			<font size=2>
				Your order has been recived. Please click the button below to make your payment.<BR><BR>
				<form action='https://www.paypal.com/cgi-bin/webscr' method='post'>
				<input type='hidden' name='cmd' value='_xclick'>
				<input type='hidden' name='business' value='paypal@cyexx.com'>
				<input type='hidden' name='item_name' value='Game Server Payment'>
				<input type='hidden' name='amount' value='$price'>
				<input type='hidden' name='no_note' value='1'>
				<input type='hidden' name='currency_code' value='USD'>
				<p align='center'>
				<input type='image' src='https://www.paypal.com/en_US/i/btn/x-click-butcc.gif' border='0' name='I2' alt='Make payments with PayPal - it's fast, free and secure!' width='73' height='44'>
				</p>
				</form>
			</font>
		</td>
	</tr>
	</table>
	<BR><BR>";
} else {

	echo "<BR><BR>
	<table width=640 border=0 cellspacing=0 cellpadding=0>
	<TR>
		<td width=200 align=right><img src='images/order_now.jpg' border=0 alt='contact CyeXX.com'></td>
		<td width=10></td>
		<td width=1>
		  <table border='0' cellspacing=0 cellpadding=0><tr><td bgcolor='#e3e3e3'><img src='images/blank.gif' height='250' width='1'></td></tr></table>
		</td>
		<td width=10></td>
		<td align=left>
		<form action='index.php?content=order_gs' method='post'>
			<font size=1>
			Thank you for your interest in CyeXX Game Servers. Please fill out this form and a CyeXX Representative will contact you about your server.
			<BR><BR><BR>
			
			<table width='90%' border=0 cellspacing=0 cellpadding=2>
			  <tr>
			    <td align='right'><font size='-1'>Game:</td>
			    <td align='left'>
				<select name='game' $input_style>
				<option value='cspublic'>Counter-Strike: Public</option>
				<option value='csprivate'>Counter-Strike: Private</option>
				</select>			    
			    </td>
			  </tr>
			  <tr>
			    <td align='right'><font size='-1'>Size:</td>
			    <td align='left'>
				<select name='maxplayers' $input_style>
				<option value='10'>10 Players</option>
				<option value='16'>16 Players</option>
				<option value='20'>20 Players</option>
				</select>			    
			    </td>
			  </tr>
			  <tr>
			    <td align='right'><font size='-1'>Location:</td>
			    <td align='left'>
				<select name='location' $input_style>
				<option value='Atlanta'>Atlanta, GA</option>
				<option value='Dallas'>Dallas, TX</option>
				<option value='New York'>New York, NY</option>
				<option value='Seattle'>Seattle, WA</option>
				</select>			    
			    </td>
			  </tr>			  
			  <tr>
			    <td align='right'><font size='-1'>Admin Plugin:</td>
			    <td align='left'>
				<select name='admin' $input_style>
				<option value='none'>(none)</option>
				<option value='Admin Mod'>Admin Mod +(0.00)</option>
				<option value='AMX Mod'>AMX Mod  +(0.00)</option>
				</select>			    
			    </td>
			  </tr>
			  <tr>
			    <td align='right'><font size='-1'>Stats:</td>
			    <td align='left'><input type='checkbox' name='statsme' value='1'><font STYLE='FONT: 7PT VERDANA;COLOR: BLACK;'>Stats Me +(0.00)</font><BR></td>
			  </tr>
			  <tr>
			    <td align='right'><font size='-1'>&nbsp;</td>
			    <td align='left'><input type='checkbox' name='psycostats' value='1'><font STYLE='FONT: 7PT VERDANA;COLOR: BLACK;'>Daily PsychoStats 2.2 +(4.99/mo)</font><BR></td>
			  </tr>
			  <tr>
			    <td align='right'><font size='-1'>&nbsp;</td>
			    <td align='left'><font size='-1'>&nbsp;</td>
			  </tr>
			  <tr>
			    <td align='right'><font size='-1'>Full Name:</td>
			    <td align='left'><font size='-1'><input type='text' name='name' value='' $input_style><font color='#8d1c1c' size='-2'> (required)</td>
			  </tr>			  
			  <tr>
			    <td align='right'><font size='-1'>Phone:</td>
			    <td align='left'><font size='-1'><input type='text' name='phone' value='' $input_style><font color='#8d1c1c' size='-2'> (required)</td>
			  </tr>
			  <tr>
			    <td align='right'><font size='-1'>E-Mail:</td>
			    <td align='left'><font size='-1'><input type='text' name='email' value='' $input_style><font color='#8d1c1c' size='-2'> (required)</td>
			  </tr>
			  <tr>
			    <td valign='top' align='right'><font size='-1'>Comments:</td>
			    <td align='left'><font size='-1'><textarea name=comments rows=10 cols=52 $input_style></textarea></td>
			  </tr>
			  <tr>
			    <td align='right' colspan='2'><img src='images/blank.gif' height='4'></td>
			  </tr>
			  <tr>
			    <td align='right' colspan='2'><input type=submit name=submit value='submit' $input_style></td>
			  </tr>
			</table>
			<BR><BR>
			</font>
		</td>
	</tr>
	</form>
	</table>
	<BR><BR>";
}
?>