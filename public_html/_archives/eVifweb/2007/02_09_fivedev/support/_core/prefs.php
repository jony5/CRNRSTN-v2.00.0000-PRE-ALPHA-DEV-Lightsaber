<?
if (!isset($in_prefs)){ 
	$in_prefs = 1;			# prefs document has been included?
	$debug = 0;			# are we debugging the site? [0 or 1]
	
	# database information --------------#
	#$dbhostname="localhost"; 
	##$dbusername="cyexx";
	#$dbpassword="";
	#$dbName="cyexx_cyexx";

	# paths -----------------------------#
	$path_to_files="/usr/home/cyexx/public_html/";
	$rootpath="$path_to_files";
	$htmlrootpath="$path_to_files";
	$modules_dir = "$rootpath/_modules";
	$site_url = "www.cyexx.com";
	$index_file = "index.php";
	
	#------------------------------------#
	$dateformat = "F j, Y, g:i a";
	$meta_keywords = "javascript, html, programming, contracting, css, web application, internet, help, online, system";
	$meta_description = "EvifWeb Development - Web Site Development";
}
?>
