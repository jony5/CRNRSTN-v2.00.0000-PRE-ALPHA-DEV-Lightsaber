<?php 
session_start();
$page=$_GET['page'];
$category=$_GET['category'];
if($page==""){
	$page=1;
}
if($category==""){
	$category=6;
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<link href="css/fivestyle.css" type="text/css" rel="stylesheet" />
<link rel="stylesheet" href="css/lightbox.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/lightbox2.css" type="text/css" media="screen" />

<script src="script/prototype.js" type="text/javascript"></script>
<script src="script/scriptaculous.js" type="text/javascript"></script>
<script src="script/lightbox.js" type="text/javascript"></script>

<script language="javascript">
<!--
var mypage=0;
var category=6;
var rowcount = 0;
var newrowcount=0;
var newimages="";
newimages="<div id='itemcontent'><div id='photogallery'><ul><li>";

function closewindow(){
	window.close();
}

function returnpage(pagenumber, mycategory){
	//alert (mypage);
	//alert(pagenumber);
	newimages="";
	newrowcount=0;
	
	if(mypage==pagenumber){
	}else{
		//=============== vv1
		var url="gallery.php?page="+pagenumber+"&category="+mycategory;
		location.href = url;
		//mypage=pagenumber;
	}
}

function returnclick(imagetouched){
//	alert(imageclicked);

var url = 'admin/imagetouch.php';
var pars = 'image=' + imagetouched;

var myAjax = new Ajax.Request(
	url, 
	{
		method: 'get', 
		parameters: pars, 
		onComplete: showResponse
	});
}
function showResponse(originalRequest)
{
//do nothing
}
function  initializepage(pagenumber){
		newrowcount=0;
		newimages="";
		mypage=pagenumber;
		document.getElementById('gallerycontent').innerHTML = '<img src=imgs/loading.gif width=32 height=32 alt=loading... title=loading... />';
		
		newimages = newimages +'<div style=\"margin:auto; text-align:center; width:600px;\"><table cellpadding=0 cellspacing=0 border=0 width=600><tr>';
		for(galleryphotocount=0;galleryphotocount<thegoldencount;galleryphotocount++ ){
			if(pagenationArray[galleryphotocount]==mypage){
				newimages=newimages+"<td align='center' style='margin:auto; text-align:center;'><div style='width:160px; text-align:center; display:inline;'><div style='padding-bottom:5px;padding-right:5px;'><a href='imgs/mylife/display/";
				newimages=newimages+filenameArray[galleryphotocount];
				newimages=newimages+"' onmousedown='returnclick(\"" + filenameArray[galleryphotocount] +"\")' rel='lightbox[gallery]'><img src='imgs/mylife/thumbs/"
				newimages=newimages+filenameArray[galleryphotocount];
				newimages=newimages+"' width='"+thumbwidthArray[galleryphotocount]+"' height='"+thumbheightArray[galleryphotocount]+"' border='0' alt='"+alttextArray[galleryphotocount]+"' /></a><br>";
				newimages=newimages+"<div style='display:inline; text-align:left; width:160px; height:20px; line-height:10px;font-size:10px; font-family:verdana;color:#FFFFFF;'>count</div>";
				newimages=newimages+"</div></div></td>";
				if(newrowcount>1){
					newimage = newimages=newimages+"</tr></table></div><span class='clr' style=\"height:30px;\"></span><div style=\"margin:auto; text-align:center; width:600px;\"><table cellpadding=0 cellspacing=0 border=0 width=600><tr>";
					newrowcount = 0;
				}else{
					newrowcount++;
				}
			}
			if(eval(pagenationArray[galleryphotocount])>eval(mypage)){
				galleryphotocount=999999;
			}
		}
		newimages = newimages +'</tr></table></div></li></ul></div></div>';
		document.getElementById('gallerycontent').innerHTML = newimages;
		newimages="";
}

//-->
</script>
<script language="JavaScript" type="text/javascript">
function popupSizedWindow(url, name, width, height) {
	window.open(url, name, "status=yes,scrollbars=yes,resizable=yes,width=" + width + ",height=" + height);
}
	var filenameArray = new Array();
	var myplaceIDArray = new Array();
	var descriptionArray = new Array();
	var transformedArray = new Array();
	var thumbwidthArray = new Array();
	var thumbheightArray = new Array();
	var displaywidthArray = new Array();
	var displayheightArray = new Array();
	var alttextArray = new Array();
	var pagenationArray = new Array();
	var photoIDArray = new Array();

</script>

<title>J5 - MyLife Unfiltered</title>
</head>
<body style="text-align:center;">

<?php
	echo "<script type='text/javascript' language='javascript'>";
	echo "var mypage=$page;";
	echo "var category=$category;";

	include("admin/database.inc.php");			
																												// pagenation=[$page]
	$querystring="select id, filename, myplaceID, description, transformed, thumbwidth, thumbheight, displaywidth, displayheight, alttext from photos where status='active' and myplaceID='$category' and transformed='1' ORDER BY filename ASC ";
	$query=mysql_query("$querystring") or die("Terminal Error - Contact <a href='mailto:support@evifwebdev.com' target='blank'>Support</a> -$querystring returned ".mysql_error());

	// get images here and build arrays
	$i = 0;
	$totalpages = 0;

	$cyclecount = 0;	
	$mypage = 1;
	$imagesperpage = 12;
	
	while(list($id, $filename, $myplaceID, $description, $transformed, $thumbwidth, $thumbheight, $displaywidth, $displayheight, $alttext)=mysql_fetch_row($query)){
		// store gallery in javascript array
		if($cyclecount==$imagesperpage){$mypage++; $cyclecount = 0; }
		
		echo "photoIDArray[$i]=\"$id\";";
		echo "filenameArray[$i]=\"$filename\";";
		echo "myplaceIDArray[$i]=\"$myplaceID\";";
		echo "descriptionArray[$i]=\"$description\";";
		echo "transformedArray[$i]=\"$transformed\";";
		echo "thumbwidthArray[$i]=\"$thumbwidth\";";
		echo "thumbheightArray[$i]=\"$thumbheight\";";
		echo "displaywidthArray[$i]=\"$displaywidth\";";
		echo "displayheightArray[$i]=\"$displayheight\";";
		echo "alttextArray[$i]=\"$alttext\";";
		echo "pagenationArray[$i]=\"$mypage\";";		
				
		$i++;	
		$cyclecount++;
		
	}
	echo "var thegoldencount=$i;";
	echo "</script>";
?>

<!-- START gallery -->				
<?php
	$totalpages = 0; // reset to 0 for reuse


	echo "<div id='gnav'>";
		echo "<div class='gnav'><a href='#' target='_self' onclick=\"returnpage('$gallerypages', '6'); return false;\"><img src='imgs/gnav_general.gif' width='85' height='20' border='0' /></a></div>";
		echo "<div class='gnav'><a href='#' target='_self' onclick=\"returnpage('$gallerypages', '2'); return false;\"><img src='imgs/gnav_indy.gif' width='164' height='20' border='0' /></a></div>";
		echo "<div class='gnav'><a href='#' target='_self' onclick=\"returnpage('$gallerypages', '3'); return false;\"><img src='imgs/gnav_auto.gif' width='51' height='20' border='0' /></a></div>";
		echo "<div class='gnav'><a href='#' target='_self' onclick=\"returnpage('$gallerypages', '5'); return false;\"><img src='imgs/gnav_moxie.gif' width='165' height='20' border='0' /></a></div>";
		echo "<div class='gnav'><a href='#' target='_self' onclick=\"returnpage('$gallerypages', '1'); return false;\"><img src='imgs/gnav_starbucks.gif' width='97' height='20' border='0' /></a></div>";
		echo "<div class='gnav'><a href='#' target='_self' onclick=\"returnpage('$gallerypages', '4'); return false;\"><img src='imgs/gnav_j5.gif' width='29' height='20' border='0' /></a></div>";
	echo "</div>";

	echo "<div style='text-align:center; padding-bottom:10px; padding-top:5px; width:750px;'>";
	
	for($gallerypages=1; $gallerypages<$mypage+1; $gallerypages++){ 
	
		if($page==$gallerypages){
			$mycolor="CC0000";
			$txtcolor="FFFFFF";
		}else{
			$mycolor="FFFFFF";
			$txtcolor="999999";
		}
		
		echo "<div class='photonavtop' style='background-color:#$mycolor; width:5px; height:5px; border:1px solid #cccccc; display:inline; text-align:center; margin:auto; '>";
		echo "<a href='#' target='_self' onclick=\"returnpage('$gallerypages', '$category');return false;\" style='text-decoration:none; font-family:verdana; font-weight:bold; font-size:9px; color:#$txtcolor; padding:2px;'> ";
		echo "$gallerypages";
		echo "</a>";
		echo "</div><div class='photonavtop' style='width:5px;display:inline; padding-right:2px;'>&nbsp;</div>";
	}

	echo "</div>";
	$photocount=0;
	$rowcount=0;    // 4 rows of 3 thumbs

	echo "<div id='gallerycontent' style='width:700px; height:600px;'>";
	echo 	"<img src=imgs/loading.gif width=32 height=32 alt=loading... title=loading... />";
	echo "</div>";
	
	
	echo "<div style='text-align:center; padding-bottom:10px; padding-top:5px;'>";	
	for($gallerypages=1; $gallerypages<$mypage+1; $gallerypages++){ 
	
		if($page==$gallerypages){
			$mycolor="CC0000";
			$txtcolor="FFFFFF";
		}else{
			$mycolor="FFFFFF";
			$txtcolor="999999";
		}
		
		echo "<div class='photonavtop' style='background-color:#$mycolor; width:5px; height:5px; border:1px solid #cccccc; display:inline; text-align:center; margin:auto; '>";
		echo "<a href='#' target='_self' onclick=\"returnpage('$gallerypages', '$category');return false;\" style='text-decoration:none; font-family:verdana; font-weight:bold; font-size:9px; color:#$txtcolor; padding:2px;'> ";
		echo "$gallerypages";
		echo "</a>";
		echo "</div><div class='photonavtop' style='width:5px;display:inline; padding-right:2px;'>&nbsp;</div>";
	}
	echo "</div>";	
	//run function to fill gallery DIV
	echo "<script type='text/javascript' language='javascript'> initializepage(\"$page\"); </script>";
?>
<!-- END gallery -->	

</body>
</html>
