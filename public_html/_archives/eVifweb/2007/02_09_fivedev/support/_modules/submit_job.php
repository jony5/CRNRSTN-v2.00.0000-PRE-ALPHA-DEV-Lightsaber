<?
if($_POST['name']!="" AND $_POST['email']!="" AND $_POST['name']!="phone")
{


	include("Mail.php");
	
	$recipients = "sales@cyexx.com";
	
	$headers["From"]    = "WebMailer@cyexx.com";
	$headers["To"]      = "sales@cyexx.com";
	$headers["Subject"] = "Project Submitted for Rewiew - ".$_POST['email'];
	
	

	$msg = "";
	$msg .= "Name: ".$_POST['name']."\n";
	$msg .= "Email: ".$_POST['email']."\n";
	$msg .= "Phone: ".$_POST['phone']."\n\n";
	
	
	$msg .= "Category: ".$_POST['category']."\n";
	$msg .= "Budget: ".$_POST['budget']."\n";
	$msg .= "Description: ".$_POST['description']."\n";	

	
	$params["host"] = "localhost";
	$params["port"] = "25";
	$params["auth"] = true;
	$params["username"] = "contact@cyexx.com";
	$params["password"] = "j4f8cp3l";
	
	
	$mail_object =& Mail::factory("smtp", $params);
	$mail_object->send($recipients, $headers, $msg);
	//echo "<PRE>".$msg."</PRE>";
	


	echo "<BR><BR>
	<table width=640 border=0 cellspacing=0 cellpadding=0>
	<TR>
		<td width=200 align=right><img src='images/contactus.jpg' border=0 alt='contact CyeXX.com'></td>
		<td width=10></td>
		<td width=1><table border='0' cellspacing=0 cellpadding=0><tr><td bgcolor='#e3e3e3'><img src='images/blank.gif' height='250' width='1'></td></tr></table></td>
		<td width=10></td>
		<td align=left>
			<font size=2>
				Thank you for your submission. One of our representatives will contact you shortly.<BR><BR>
			</font>
		</td>
	</tr>
	</table>
	<BR><BR>";
} else {



	echo "<BR><BR>
	<table width=640 border=0 cellspacing=0 cellpadding=0>
	<TR>
		<td width=200 align=right><img src='images/contactus.jpg' border=0 alt='contact CyeXX.com'></td>
		<td width=10></td>
		<td width=1>
		  <table border='0' cellspacing=0 cellpadding=0><tr><td bgcolor='#e3e3e3'><img src='images/blank.gif' height='250' width='1'></td></tr></table>
		</td>
		<td width=10></td>
		<td align=left>
		<form action='index.php?content=submit_job' method='post'>
			<font size=1>
			Thank you for your interest in CyeXX. Please fill out this form and a CyeXX Representative will contact you about your project shortly.
			<BR><BR><BR>
			
			<table width='90%' border=0 cellspacing=0 cellpadding=2>
			  <tr>
			    <td align='right'><font size='-1'>Category:</td>
			    <td align='left'>
				<select name='category' $input_style>
				<option value='WebSite Design'>Web Site Design</option>
				<option value='Graphic Design'>Graphic Design</option>
				<option value='Networking'>Networking</option>
				<option value='Programming'>Programming</option>
				</select>			    
			    </td>
			  </tr>
			  <tr>
			    <td align='right'><font size='-1'>Budget Range:</td>
			    <td align='left'>
				<select name='budget' $input_style>
				<option value='\0'>(select range)</option>
				<option value='\$100-\$500'>\$100-\$500</option>
				<option value='\$500-\$1,000'>\$500-\$1,000</option>
				<option value='\$1,000-\$5,000'>\$1,000-\$5,000</option>
				<option value='\$5,000-\$25,000'>\$5,000-\$25,000</option>
				<option value='\$5,000-\$25,000'>\$25,000-\$50,000</option>
				<option value='\$50,000'>\$50,000+</option>
				
				</select>			    
			    </td>
			  </tr>


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
			    <td valign='top' align='right'><font size='-1'>Description:</td>
			    <td align='left'><font size='-1'><textarea name=description rows=15 cols=52 $input_style></textarea></td>
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