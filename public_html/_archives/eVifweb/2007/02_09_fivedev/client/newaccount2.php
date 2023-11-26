<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="icon" href="fiveicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="fiveicon.ico" type="image/x-icon" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta http-equiv="expires" content="-1" />
<meta http-equiv="pragma" content="no-cache" />
<meta name="author" content="" />
<meta name="ROBOTS" content="ALL" />
<meta name="description" content="" />
<meta name="KEYWORDS" content="" />

<link href="../css/fivestyle.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="../script/prototype.js"></script>


<script type="text/javascript" src="../script/moo.fx.js"></script>
<script type="text/javascript" src="../script/moo.ajax.js"></script>
<script type="text/javascript" src="../script/moo.fx.pack.js"></script>
<script type="text/javascript" src="../script/rico.js"></script>
<script type="text/javascript" src="../script/scriptaculous.js"></script>


<script language="JavaScript" type="text/javascript">
var loginvisible=false;
function navigate(navelement){

	if(loginvisible){
		Effect.SlideDown('menuslidetxt',{duration:1.0});
		Effect.SlideUp('loginshell',{duration:.5}); 
		loginvisible=false;
	}
	var hitnavstr=navelement.id+'on';
	document.getElementById(hitnavstr).style.display="block"; 

	document.getElementById('dyncontent').innerHTML = '<img src=../imgs/loading.gif width=32 height=32 alt=loading... title=loading... />';
	//new Ajax.Updater('dyncontent', '../content/' + navelement.name + '.php', {asynchronous:true, evalScripts:true});
	
	//activatenav(navelement);
		var url="http://www.jony5.com";
		location.href = url;
}

function activatenav(mynav){
//================================//turn grey on
var nodes = $A(document.getElementsByClassName("nav"));
		nodes.each(function(node){
			document.getElementById(node.id).style.display="inline"; 
		}); /*end node cycling */
//================================
//================================// turn red off
var nodes = $A(document.getElementsByClassName("nbuttonon"));
		var tempnavstrholder = mynav.id+'on';
		
		nodes.each(function(node){
		if(node.id!=tempnavstrholder){
		
			new Rico.Effect.FadeTo(node.id, 
			.0, // opacity
			500, // 500ms (1/2 second)
			10, // 10 steps
			{complete:function() {/*   */}} );	
		}else{
			new Rico.Effect.FadeTo(node.id, 
			1, // opacity
			500, // 500ms (1/2 second)
			10, // 10 steps
			{complete:function() {/*   */}} );	
		}
					}); /*end node cycling */
//================================
	
	//var hitnavstr=mynav.id+'on';
	new Rico.Effect.FadeTo(mynav.id, 
			0, // opacity
			500, // 500ms (1/2 second)
			10, // 10 steps
	{complete:function() {document.getElementById(mynav.id).style.display="none"; }} );

//=========================
	new Rico.Effect.FadeTo(mynav.id, 
	.6, // opacity
	500, // 500ms (1/2 second)
	2, // 10 steps
	{complete:function() {/* put function here  */}} );
//=========================
}

function turnoff(mydiv){
	
	new Rico.Effect.FadeTo(mydiv.id, 
	.6, // opacity
	750, // 500ms (1/2 second)
	10, // 10 steps
	{complete:function() {}} );
	
 }
 
  function turnon(mydiv){
  
	new Rico.Effect.FadeTo(mydiv.id, 
	.99, // opacity
	250, // 500ms (1/2 second)
	5, // 10 steps
	{complete:function() {}} );
	
 }

function registerpage(){
		

		var nodes = $A(document.getElementsByClassName("nav"));
		var tempnavstrholder = "";
		
		nodes.each(function(node){
			fader = new fx.Opacity(node.id);
			fader.custom(1,.6);
		}); /*end node cycling */

		new Ajax.Updater('counter', '../counter/phpcounter.php', {asynchronous:true, evalScripts:true});	
		document.getElementById('nav00on').style.display="block"; 
		
		new Rico.Effect.FadeTo('nav00', 
			0, // opacity
			500, // 500ms (1/2 second)
			10, // 10 steps
		{complete:function() {document.getElementById('nav00').style.display="none"; }} );	
		

		document.getElementById('nav00').style.display="none"; 
	
		new Rico.Effect.FadeTo('nav00', 
			.6, // opacity
			500, // 500ms (1/2 second)
			10, // 10 steps
		{complete:function() {}} );	
		
		delete nodes;
	}	
	
function showResponse(originalRequest)
{
	//do nothing
}
</script>


<title>Evifweb Development</title>

</head>

<body onload="Javascript:registerpage();">

<div id="header">
			<div style="position:absolute; width:500px; z-index:3;">
			<div id="logo5"><img src="../imgs/logo00.gif" width="173" height="93" border="0" alt="5" title="5" /></div>
			<div id="fivenav">
				<div class="tnav">
					<div class="nbuttonon" id="nav00on" style="display:none;"><img class="navon" src="../imgs/tnav_homesel.gif" width="91" height="70" alt="home" name="home" /></div>
					<div class="nbutton"><img name="home" class="nav" id="nav00" src="../imgs/tnav_home.gif" width="91" height="70" alt="home" onmouseover="turnon(this);" onmouseout="turnoff(this);" onmousedown="navigate(this);" /></div>
				</div>
<!--				<div class="tnav">
					<div class="nbuttonon" id="nav01on" style="display:none;"><img class="navon"  src="../imgs/tnav_aboutsel.gif" width="91" height="70" alt="about" name="about" /></div>
					<div class="nbutton"><img class="nav" id="nav01" src="../imgs/tnav_about.gif" width="91" height="70" alt="about" name="about" onmouseover="turnon(this);" onmouseout="turnoff(this);" onmousedown="navigate(this);" /></div>			
				</div>-->
				<div class="tnav">
					<div class="nbuttonon" id="nav02on" style="display:none;" ><img class="navon" src="../imgs/tnav_lifesel.gif" width="91" height="70" alt="email" name="email" /></div>
					<div class="nbutton"><img class="nav" id="nav02" src="../imgs/tnav_life.gif" width="91" height="70" alt="life" name="life"  onmouseover="turnon(this);" onmouseout="turnoff(this);" onmousedown="navigate(this);" /></div>			
				</div>
				<div class="tnav">
					<div class="nbuttonon" id="nav03on" style="display:none;"><img class="navon" src="../imgs/tnav_worksel.gif" width="91" height="70" alt="portfolio" name="portfolio" /></div>
					<div class="nbutton"><img class="nav" id="nav03" src="../imgs/tnav_work.gif" width="91" height="70" alt="work" name="work"  onmouseover="turnon(this);" onmouseout="turnoff(this);" onmousedown="navigate(this);" /></div>			
				</div>
	<!--			<div class="tnav">
					<div class="nbuttonon" id="nav04on" style="display:none;"><img class="navon" src="../imgs/tnav_servicessel.gif" width="91" height="70" alt="services" name="services" /></div>
					<div class="nbutton"><img class="nav" id="nav04" src="../imgs/tnav_services.gif" width="91" height="70" alt="services" name="services" onmouseover="turnon(this);" onmouseout="turnoff(this);" onmousedown="navigate(this);" /></div>			
				</div>-->
				<div class="tnav">
					<div class="nbuttonon" id="nav05on" style="display:none;"><img class="navon" src="../imgs/tnav_contactsel.gif" width="91" height="70" alt="contact" name="contact" /></div>
					<div class="nbutton"><img class="nav" id="nav05" src="../imgs/tnav_contact.gif" width="91" height="70" alt="contact" name="contact" onmouseover="turnon(this);" onmouseout="turnoff(this);" onmousedown="navigate(this);" /></div>			
				</div>
				<div class="tnav" >
					<div class="nbutton"><img class="nav" id="nav99" src="../imgs/navcap.gif" width="90" height="69" onmouseover="turnon(this);" onmouseout="turnoff(this);" /></div>
				</div>
				
				<div style="clear:both; display:block;">
				
					<div style="clear:both;">
						<div id="loginshell" style="display:none;">
							<div id="login">
						</div>
						</div>
					
						<div id="menuslidetxt"></div>
					</div>
					<div id="contentshell">
						<div id="dyncontent">
<?php
include("database.inc.php");

$button=$_POST['button'];

if($button=="  CANCEL  "){
	echo "<META HTTP-EQUIV=Refresh CONTENT=\"0; URL=http://www.jony5.com\">";
	die();
}


$firstname=$_POST['firstname'];
$lastname=$_POST['lastname'];
$mname=$_POST['mname'];
$username=$_POST['username'];
$password=$_POST['password'];
$passwordcheck=$_POST['passwordcheck'];
$pname=$_POST['pname'];
$address1=$_POST['address1'];
$address2=$_POST['address2'];
$city=$_POST['city'];
$statecode=$_POST['statecode'];
$zip=$_POST['zip'];
$country=$_POST['country'];
$phone1=$_POST['phone1'];
$phone2=$_POST['phone2'];
$phone3=$_POST['phone3'];
$phone1type=$_POST['phone1type'];
$phone2type=$_POST['phone2type'];
$phone3type=$_POST['phone3type'];
$email=$_POST['email'];
$emailcheck=$_POST['emailcheck'];
$email2=$_POST['email2'];
$url1=$_POST['url1'];
$url2=$_POST['url2'];
$url3=$_POST['url3'];
$url4=$_POST['url4'];
$url1type=$_POST['url1type'];
$url2type=$_POST['url2type'];
$url3type=$_POST['url3type'];
$url4type=$_POST['url4type'];
$msgrid=$_POST['msgrid'];
$mymsgrtype=$_POST['mymsgrtype'];
$referralcode=$_POST['referral'];


// Check required information
if(strlen($firstname)<2){$error[]="Your first name is  missing.";}
if(strlen($lastname)<2){$error[]="Your last name missing.";}
if(strlen($address1)<3){$error[]="Your address is missing.";}
if(strlen($city)<3){$error[]="Your city is missing.";}
if(strlen($statecode)<1){$error[]="Your state is missing.";}
if(strlen($zip)<5){$error[]="Your zip code is missing.";}
if(strlen($phone1)<3){$error[]="Your phone number is missing.";}
if(strlen($username)<3){$error[]="You did not specify a username.";}
if(strlen($password)<8){$error[]="You did not specify a password of at least 8 characters.";}
if(strlen($email)<7){$error[]="Your email address is missing.";}
// Password check
if($password!=$passwordcheck){$error[]="The passwords you entered do not match.";}
// Username in use?
$usernamecheck=mysql_query("select id from fiveusers where username='$username';");
if(mysql_num_rows($usernamecheck)>0){$error[]="The username you selected is already in use.";}

//email check
if($email!=$emailcheck){$error[]="The email addresses you entered do not match.";}

if(strtolower(substr($website,0,7))!="http://" and strtolower(substr($website,0,7))!="https://"){
	$website="http://".$website;

}

if(count($error)>0){
	echo 	"<br><span style='font-size:16px;'>Create New Account </span><font color=\"#cc0000\">(* notes a required field)</font><br><br>";
	echo	"<form action=\"newaccount2.php\" method=\"post\">";
	echo "Your application cannot be processed as entered due to the following error(s):<br><br>";
	foreach($error as $problem){
		echo "$problem<br>";
	}
	
	if(count($error)>1){
		echo "<br>Please correct the errors listed above in the form below, and resubmit your application.<p>";
	}else{
		echo "<br>Please correct the error listed above in the form below, and resubmit your application.<p>";
	}

}else{

	$approvedate=date("Y-m-d H:i:s");
	$status='active';

	$querystring="insert into fiveusers(sessionid, prefix, fname, mname, lname, suffix, address1, address2, city, state, zip, country, phone1, phone2, phone3, p1type, p2type, p3type, email1, email2, url1, url2, url3, url4, u1type, u2type, u3type, u4type, msgrid, msgrtype, busname, status, username, password, datecreated, referralcode) values('".$_REQUEST['PHPSESSID']."','$pname', '$firstname', '$mname', '$lastname', '$suffix', '$address1', '$address2', '$city', '$statecode', '$zip', '$country', '$phone1', '$phone2', '$phone3', '$phone1type', '$phone2type', '$phone3type', '$email', '$email2', '$url1', '$url2', '$url3', '$url4', '$url1type', '$url2type', '$url3type', '$url4type', '$msgrid', '$mymsgrtype','$busname', '$status', '$username', '$password', '$approvedate','$referralcode');";
	mysql_query("$querystring") or die (mysql_error()." on ".$querystring);

//	echo "$querystring";

	echo "<br><br><p>Your account has been successfully created.  </p>";
	echo "<a href=\"index.php\">Login</a> to this account for quotes or to get your web project started.";

        mail("accountmanager@fivedev.com","New Client Signup","A new account has been created. \nName: $firstname $lastname \n\nPrimary Email: $email1 \n\nAddress: $address1, \n$city, $statecode, $zip \n\nDate Created: $approvedate","From: server@fivedev.com","-fserver@fivedev.com");



unset($email);

}

if(count($error)>0){
		echo " <div id=\"newaccountsetup\">";
		require_once("includes/clientinfo.inc");
		echo "</div>";
		
}

?>



						</div>
					</div>
				</div>
			</div><!-- close fivenav -->
		</div>
		
		<div style="position:absolute; text-align:right; height:200px;width:100%; border-left:425px; z-index:2;">
				<div style="text-align:right;width:657px; float:right;"><img src="../imgs/j5look.gif" width="232" height="326" alt="web development" title="J5" style="margin-left:425px;" /></div>		
		</div>


	
</div><!-- close header -->



</body>
</html>


