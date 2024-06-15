<?php

if($_GET["print"] == 1){
	$print = 1;
	}

$MODE = ""; //Can be either "LIVE" or "TESTING"

if(stristr(dirname(__FILE__), "/home/vhosts/ekstreme.com")){
	$MODE = "LIVE";
	}
elseif(stristr(dirname(__FILE__), "webroot")){
	$MODE = "TESTING";
	}
else{
	$MODE = "UNKNOWN";
	}

if($MODE == "LIVE"){
	$BASE_DIR = "/usr/local/psa/home/vhosts/ekstreme.com/httpdocs/content/"; //KEEP TRAILING SLASH!
	}
elseif($MODE == "TESTING"){
	$BASE_DIR = "C:/webroot/content/";
	}
else{
	echo "<p>Unknown MODE!</p>";
	exit;
	}

if($print==1){?>
		<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
	      <html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
	<head><title><?php include $BASE_DIR . $PAGE . ".title.txt"; ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
	<link rel="shorcut icon" href="/favicon.ico" /> 
	<link href="/global/print.css" rel="stylesheet" type="text/css" />
	</head>
	<?php
	}
else{
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
      <html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
	<?php
	}
if($MODE == "LIVE" && !$print){	
	?>
	<title><?php include $BASE_DIR . $PAGE . ".title.txt"; ?></title>
<?php
	}
elseif($MODE == "TESTING"){
	?>
	<title>[LOCAL] <?php include $BASE_DIR . $PAGE . ".title.txt"; ?></title>
<?php
	}

if($print==1){
	?>
	<body>

<div>This page was printed from:</div>
<div><?php echo "<a href=\"" . $_SERVER["SCRIPT_NAME"] . "\">http://ekstreme.com" . $_SERVER["SCRIPT_NAME"] . "</a>"; ?></div>
	<?php
	}
else{
	?>
	<meta name="keywords" content="<?php include $BASE_DIR . $PAGE . ".keywords.txt"; ?>" />
	<meta name="description" content="<?php include $BASE_DIR . $PAGE . ".description.txt"; ?>" />
	<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
	<link rel="shorcut icon" href="/favicon.ico" /> 	
	<link href="/global/summer.css" rel="stylesheet" type="text/css" />
	<link href="/eksforum/eksforum.css" rel="stylesheet" type="text/css" />
	<link href="/guestbook/egbook.css" rel="stylesheet" type="text/css" />
	<link href="/egbook3/egbook.css" rel="stylesheet" type="text/css" />
</head>

<body>

	<!--START Heading Table-->
	<table width="100%" cellpadding="0" cellspacing="0" border="0">
		<tr>
			<td class="HeadLeftTD">
				<!--eKstreme.com logo here?-->&nbsp;
			</td>
			
			<td class="HeadRightTD" colspan="2">
				<span class="BeforeCOM">eKstreme</span><span class="COM">.com</span>
			</td>
		</tr>
		<tr>
			<td class="LikeHeadLeftTD">
				&nbsp;
			</td>
			
			<td class="HeadRightNav">
				<!--START Sections Navigation Table-->
				<table cellpadding="0" cellspacing="2" border="0" class="SectionNavTable">
					<tr>
						<td class="HMNav"><a href="/index.php" class="TopSectionLink">Home</a></td>
						<td class="PLNav"><a href="/phplabs/index.php" class="TopSectionLink">PHPLabs</a></td> <!-- Personal Section Navigation-->
						<td class="WMNav"><a href="/webmaster/index.php" class="TopSectionLink">Webmaster</a></td> <!--Webmaster Webmaster-->
						<td class="DSNav"><a href="/digitalsmoke/index.php" class="TopSectionLink">DigitalSmoke</a></td> <!--DS Webmaster-->
						<td class="PSNav"><a href="/personal/index.php" class="TopSectionLink">Personal</a></td> <!-- Personal Section Navigation-->
						<td class="WLNav"><a href="/weblog/index.php" class="TopSectionLink">pLog</a></td> <!--Web Log Navigation-->
					</tr>
					<tr>
						<td colspan="5">
						<!--START Sub nav table-->
						
						<table cellpadding="0" cellspacing="0" border="0" class="SiteNavTable">
					<tr>
						<td class="SiteNavLinkTD"><a href="/contact.php" class="TopSiteNavLink">Contact Me</a></td>
						<td class="SiteNavLinkTD"><a href="/guestbook/" class="TopSiteNavLink">Guestbook</a></td>
						<td class="SiteNavLinkTD"><a href="/search.php" class="TopSiteNavLink">Search</a></td>
						<td class="SiteNavLinkTD"><a href="/linkback.php" class="TopSiteNavLink">Link Back</a></td>
						<td class="SiteNavLinkTD"><a href="/awards.php" class="TopSiteNavLink">Awards</a></td>
						<td class="SiteNavLinkTD"><a href="/privacypolicy.php" class="TopSiteNavLink">Privacy Policy</a></td>
						<td class="SiteNavLinkTD"><a href="/credits.php" class="TopSiteNavLink">Credits</a></td>
					</tr>
				</table>
						<!--END Sub nav table--></td>
					</tr>				
				</table>
				<!--END Section Navigation Table-->
			</td>
			<td class="HeadRightNav2">
				&nbsp;
			</td>
		</tr>
	</table>
	<!--END Heading Table-->
	

	
	<!--START Main Content Area Table; MCA = Main Content Area-->
	<table width="100%" cellpadding="0" cellspacing="0" border="0">
		<!--START empty row
		<tr>
			<td class="LikeHeadLeftTD">&nbsp;</td>
			<td class="LikeMCAMainContent">&nbsp;</td>
			<td class="MCATopRightSpacer">&nbsp;</td>
		</tr>
		END empty row-->
		<tr>
			<td class="MCANavLeftTD">&nbsp;<!--START AdSense--><script type="text/javascript"><!--
google_ad_client = "pub-3067059563042255";
google_ad_width = 120;
google_ad_height = 600;
google_ad_format = "120x600_as";
google_color_border = "FF4500";
google_color_bg = "FFEBCD";
google_color_link = "DE7008";
google_color_url = "E0AD12";
google_color_text = "8B4513";
//--></script>
<script type="text/javascript"
  src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script><!--END AdSense--></td>
			<td class="MCAMainContent">
			<!--START MAIN CONTENT-->
	
	<?php
	include $BASE_DIR . $PAGE . ".trail.php";
	}

include $BASE_DIR . $PAGE . ".content.php";	
	
	
if($print==1){
	?>
	<div>eKstreme.com &copy;2003 Pierre Far. All rights reserved.</div>
	</body>
	</html>
	<?php
	}
else{
	?>
					<!--END MAIN CONTENT-->
			
			</td>
			<td class="MCAEmptyRightSpacer">
				<table cellspacing="0" cellpadding="0" border="0" class="TranslationTable">
				<tr><td colspan="4" class="TranslationTD"><h2>Tranlsations&nbsp;&raquo;</h2></td></tr>
				<tr>
					<td class="TranslationTD"><a href="http://ekstreme.com/breaktranslation.php?url=<?php echo $_SERVER["SCRIPT_NAME"]; ?>"><img src="/global/eng.gif" alt="English version" width="17" height="10" /></a></td>
					<td class="TranslationTD"><!--BEGIN Dutch Systrans translation-->
						<form action="http://www.systranbox.com/systran/box" method="post" >
						<div>
						<input name="systran_id" type="hidden" value="SystranSoft-en" />
						<input name="systran_charset" type="hidden" value="utf-8" />
						<input type="hidden" value="url" name="ttype" checked="checked"/>
						<input type="hidden" value="http://ekstreme.com<?php echo $_SERVER["SCRIPT_NAME"]; ?>" name="systran_url" />
						<input name="systran_lp" value="en_nl" type="hidden" />
						<input type="image" src="/global/dutch.gif" alt="Translate to Dutch" value="Translate to Dutch" class="TranslationFlag"/>
						</div>
						</form>
						<!--END Dutch Systrans translation-->
						</td>
					<td class="TranslationTD"><!--BEGIN German Systrans translation-->
						<form action="http://www.systranbox.com/systran/box" method="post" >
						<div>
						<input name="systran_id" type="hidden" value="SystranSoft-en" />
						<input name="systran_charset" type="hidden" value="utf-8" />
						<input type="hidden" value="url" name="ttype" checked="checked"/>
						<input type="hidden" value="http://ekstreme.com<?php echo $_SERVER["SCRIPT_NAME"]; ?>" name="systran_url" />
						<input name="systran_lp" value="en_de" type="hidden" />
						<input type="image" src="/global/german.gif" alt="Translate to German" value="Translate to German" class="TranslationFlag"/>
						</div>
						</form>
						<!--END German Systrans translation-->
						</td>
					<td class="TranslationTD"><!--BEGIN French Systrans translation-->
						<form action="http://www.systranbox.com/systran/box" method="post" >
						<div>
						<input name="systran_id" type="hidden" value="SystranSoft-en" />
						<input name="systran_charset" type="hidden" value="utf-8" />
						<input type="hidden" value="url" name="ttype" checked="checked"/>
						<input type="hidden" value="http://ekstreme.com<?php echo $_SERVER["SCRIPT_NAME"]; ?>" name="systran_url" />
						<input name="systran_lp" value="en_fr" type="hidden" />
						<input type="image" src="/global/french.gif" alt="Translate to French" value="Translate to French" class="TranslationFlag"/>
						</div>
						</form>
						<!--END French Systrans translation-->
						</td>
					
				</tr>
				<tr><td colspan="4" class="TranslationTD"><div><a href="http://ekstreme.com/breakframes.php?url=<?php echo $_SERVER["SCRIPT_NAME"]; ?>">Break from frames</a></div></td></tr>
				</table>
				<h2>Print Version</h2>
				<div><?php echo "<a href=\"" . $_SERVER["SCRIPT_NAME"] . "?print=1\">Print</a>"; ?></div>
				<h2>Search</h2>
				<!-- Atomz.com Search HTML for eKstreme.com -->
				<form method="get" action="http://search.atomz.com/search/"><p>
				<input size="15" name="sp-q" />&nbsp;<input type="submit" value="Search" />
				<input type="hidden" name="sp-a" value="00040595-sp00000001" /></p>
				</form>
				<!--END SEARCH-->
			<?php require dirname(__FILE__) . "/site-news.txt"; ?></td>
		</tr>
		<tr>
			<td class="MCANavLeftTD">&nbsp;</td>
			<td>
			
				<div class="Footer">
<div>eKstreme.com &copy;2003 Pierre Far. All rights reserved.</div>
<div><?php 

if($MODE == "LIVE"){	
	//require "/usr/local/psa/home/vhosts/ekstreme.com/httpdocs/phpc6/phpc6.php";
	require "/usr/local/psa/home/vhosts/ekstreme.com/httpdocs/PHPC7.1-RC21Apr/phpcounter.php"; 
	}
elseif($MODE == "TESTING"){
	require "C:/webroot/phpc7.1-RC21Apr/phpcounter.php";
	}
else{
	echo "<p>Unknown mode! Exiting.</p>";
	exit;
	}

?></div>
<div>: <a href="/contact.php">Contact</a> : <a href="/guestbook/">Guestbook</a> : <a href="/search.php">Search</a> :  <a href="/linkback.php">Link back</a> : <a href="/awards.php">Awards</a> : <a href="/privacypolicy.php">Privacy Policy</a> : <a href="/credits.php">Credits</a> :</div>
</div>
			
			</td>
			<td class="MCAEmptyRightSpacer">&nbsp;</td>
		</tr>
	</table>	
	<!--END Main Content Area Table-->
	

	
	<p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>
<?php
if($MODE == "LIVE"){?>
<p class="BottomBitRight">
<a href="/phplabs/egbook.php"><img src="/global/egbook.jpg" alt="Guestbook powered by egbook" /></a>
<a href="/phplabs/phpcounter.php"><img src="/global/phpc7.gif" alt="Powered by PHPCounter"/></a>
<a href="http://www.anybrowser.org/campaign/"><img src="/global/bestviewed.gif" alt="Best viewed with any browser" /></a>
<a href="http://validator.w3.org/check/referer"><img
          src="http://www.w3.org/Icons/valid-xhtml10"
          alt="Valid XHTML 1.0!" height="31" width="88" /></a>
<a href="http://jigsaw.w3.org/css-validator/check/referer"><img width="88px" height="31px" src="http://jigsaw.w3.org/css-validator/images/vcss" alt="Valid CSS!" /></a>
<a href="http://www.plos.org/"><img src="http://www.plos.org/images/support_plos_100x157.jpg" alt="I Support the Public Library of Science" width="50" height="77" /></a>

</p><?php
	}
elseif($MODE == "TESTING"){
	//
	}
else{
	echo "<p>Unknown mode! Exiting.</p>";
	exit;
	}
?>	

	
</body>
</html>
	<?php
	}
?>
