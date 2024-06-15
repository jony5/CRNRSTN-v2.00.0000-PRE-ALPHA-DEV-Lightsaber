<?
# Includes 
	$sitepath = "/usr/home/fivedevc/public_html/support";
	include($sitepath . "support/_core/prefs.php");
	#include($sitepath . "support/_core/dbconnect.php");
	#include($sitepath . "support/_core/security.php");
	include($sitepath . "support/_core/generate_html_pieces.php");


// Adjust for https	
/*
if($content=="secure")
{
	$common_header = str_replace("src=http://","src=https://",$common_header);
	$common_footer = str_replace("src=http://","src=https://",$common_footer);	
	$common_header = str_replace("SRC=http://","SRC=https://",$common_header);
	$common_footer = str_replace("SRC=http://","SRC=https://",$common_footer);	
}
*/


// top 
/////////////////////////////////////////////////////////////////////////////
echo $site_header;
/////////////////////////////////////////////////////////////////////////////





// middle
/////////////////////////////////////////////////////////////////////////////
if(!isset($content) or $content=="")
{
	$content = "services";
}
$include_path = $sitepath . "_modules/" . $content . ".php";
include($include_path);
/////////////////////////////////////////////////////////////////////////////





// bottom
/////////////////////////////////////////////////////////////////////////////
echo $site_footer;
/////////////////////////////////////////////////////////////////////////////
?>