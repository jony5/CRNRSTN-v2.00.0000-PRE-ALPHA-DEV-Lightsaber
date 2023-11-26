<?php
	session_start();
	include("security.inc.php");
?>
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
function signout(){

			new Rico.Effect.FadeTo('menuslidetxt', 
			.0, // opacity
			1200, // 500ms (1/2 second)
			10, // 10 steps
			{complete:function() { window.location='loggoff.php';}} );	

}
function navigate(navelement){

	if(loginvisible){
		Effect.SlideDown('menuslidetxt',{duration:1.0});
		Effect.SlideUp('loginshell',{duration:.5}); 
		loginvisible=false;
	}
	var hitnavstr=navelement.id+'on';
	document.getElementById(hitnavstr).style.display="block"; 

	document.getElementById('dyncontent').innerHTML = '<img src=../imgs/loading.gif width=32 height=32 alt=loading... title=loading... />';
	new Ajax.Updater('dyncontent', 'content/' + navelement.name + '.php', {asynchronous:true, evalScripts:true});
	
	activatenav(navelement);
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
		document.getElementById('dyncontent').innerHTML = '<img src=../imgs/loading.gif width=32 height=32 alt=loading... title=loading... />';
		new Ajax.Updater('dyncontent', 'content/photos.php', {asynchronous:true, evalScripts:true});	
		new Ajax.Updater('counter', 'counter/phpcounter.php', {asynchronous:true, evalScripts:true});	
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
		{complete:function() { document.getElementById('footer').innerHTML = '&copy; EvifWeb Development';	new Ajax.Updater('footer', 'content/footer.php', {asynchronous:true, evalScripts:true});}} );	
		
		delete nodes;
		
	// write footer	
	
	}	
	

function submitform(){
	document.getElementById("myform").submit();
}

    </script>	
	
</script>


<title>Evifweb Development</title>

</head>

<body onload="Javascript:registerpage();">

<div id="header"  style="padding-bottom:200px;">
			<div style="position:absolute; width:550px; z-index:3;">
			<div id="logo5"><img src="../imgs/logo00.gif" width="173" height="93" border="0" alt="5" title="5" /></div>
			<div id="fivenav">
				<div class="tnav">
					<div class="nbuttonon" id="nav01on" style="display:none;"><img class="navon" src="../imgs/tnav_homesel.gif" width="91" height="70" alt="home" name="home" /></div>
					<div class="nbutton"><img name="home" class="nav" id="nav01" src="../imgs/tnav_home.gif" width="91" height="70" alt="home" onmouseover="turnon(this);" onmouseout="turnoff(this);" onmousedown="navigate(this);" /></div>
				</div>
				<div class="tnav">
					<div class="nbuttonon" id="nav00on" style="display:none;"><img class="navon"  src="../imgs/tnav_photosel.gif" width="91" height="70" alt="Photo Manager" name="photos" /></div>
					<div class="nbutton"><img class="nav" id="nav00" src="../imgs/tnav_photo.gif" width="91" height="70" alt="Photo Manager" name="photos" onmouseover="turnon(this);" onmouseout="turnoff(this);" onmousedown="navigate(this);" /></div>			
				</div>
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
						
					
						<div id="menuslidetxt"><a href="#" onclick="effect_2 = Effect.SlideUp('dyncontent',{duration:1.0});signout(); ">sign off</a></div>
					</div>
					<div id="contentshell">
						<div id="dyncontent"><!-- AJAX your content here --></div>
					</div>
				</div>
			</div><!-- close fivenav -->
		</div>
		
		<div style="position:absolute; text-align:right; height:200px;width:100%; border-left:425px; z-index:2;">
				<div style="text-align:right;width:657px; float:right;"><img src="../imgs/j5look.gif" width="232" height="326" alt="web development" title="J5" style="margin-left:425px;" /></div>		
		</div>
</div><!-- close header -->




<!-- Grey bar at bottom -->
<div id="bottomGrey">
	<div id="footer">&copy; EvifWeb Development</div>
	<div id="counter" style="color:#FFFFFF;"></div>
</div>

</body>
</html>
