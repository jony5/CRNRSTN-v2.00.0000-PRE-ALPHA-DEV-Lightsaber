<?php
	//session_start();
	include("../security.inc.php");
	include("../database.inc.php");
	
	$page=$_GET['page'];
	$category=$_GET['category'];
	if($page==""){
		$page=1;
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="../../../css/fivestyle.css" type="text/css" rel="stylesheet" />
<script src="../../script/prototype.js" type="text/javascript"></script>
<script src="../../script/scriptaculous.js" type="text/javascript"></script>
<script type="text/javascript" language="javascript">
 
 
 	var placecount;
 	var mypage=0;
	var filenameArray = new Array();
	var myplaceIDArray = new Array();
	var descriptionArray = new Array();
	var thumbwidthArray = new Array();
	var thumbheightArray = new Array();
	var alttextArray = new Array();
	var pagenationArray = new Array();
	var photoIDArray = new Array();
	var viewcountArray = new Array();

function saveCatagory(myphotoID, categoryselection){
	//alert(myphotoID);
	//alert(categoryselection);

		var url = '../updatecategory.php';
		var pars = 'myphotoID=' + myphotoID + '&categoryselection=' + categoryselection;
		
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
		//put returned XML in the textarea
		//$('imageupdate').value = originalRequest.responseText;
		//alert(originalRequest.responseText);
	}

function returnpage(pagenumber){
	//alert(pagenumber);
	newimages="";
	newrowcount=0;
	
	if(mypage==pagenumber){
		return false;
	}else{
		//=============== vv1
		var url="photoscontent.php?page="+pagenumber;
		location.href = url;
		return false;
	}
}


 function initializepage(pagenumber, thegoldencount){
	newrowcount=0;
	newimages="";
	var mypage = pagenumber;
	var categorycombo = "";
	mypage=pagenumber;
	document.getElementById('gallerycontent').innerHTML = '<img src=../../imgs/loading.gif width=32 height=32 alt=loading... title=loading... />';

	newimages = newimages +'<div style=\"margin:auto; text-align:center; width:600px;\"><table cellpadding=0 cellspacing=0 border=0 width=600><tr>';
	for(galleryphotocount=0;eval(galleryphotocount)<eval(thegoldencount);galleryphotocount++ ){
		if(pagenationArray[galleryphotocount]==mypage){
			newimages=newimages + "<td width=\"160\" align=\"center\" style=\"margin:auto; text-align:center;\"><div style='text-align:center; display:inline;'><div style='padding-bottom:5px;'>";
			newimages=newimages + "<span style='font-size:10px; color:666666; font-family:verdana;'>"+filenameArray[galleryphotocount]+" - "+viewcountArray[galleryphotocount]+" views</span></div>";
			newimages=newimages + "<div><img src='../../imgs/mylife/thumbs/";
			newimages=newimages + filenameArray[galleryphotocount];
			newimages=newimages + "' width='"+thumbwidthArray[galleryphotocount]+"' height='"+thumbheightArray[galleryphotocount]+"' border='0' alt='"+alttextArray[galleryphotocount]+"' /></div>";
			newimages=newimages + "<div style='padding-top:5px;font-size:10px; font-family:verdana;color:#FFFFFF;'><select style='font-size:10px; font-family:verdana;' name='myplace"+photoIDArray[galleryphotocount]+"' onChange='saveCatagory("+photoIDArray[galleryphotocount]+",this.value)'>";
			
			for(i=0; i<placecount; i++){
				if(myplaceIDArray[galleryphotocount]== placeIDArray[i]){
					categorycombo=categorycombo + "<option value='" + placeIDArray[i] + "' selected>" + placenameArray[i] + "</option>";
				}else{
					categorycombo=categorycombo + "<option value='" + placeIDArray[i] + "'>" + placenameArray[i] + "</option>";
				}
			}		
			
			newimages=newimages+categorycombo;
			categorycombo="";
			newimages=newimages + "</select></div>";
			newimages=newimages + "</td>";
			if(eval(newrowcount)>1){
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
 </script>
<title>Evifweb Development</title>

</head>

<body>
<?php

	$placecount=0;
	$myplaces="select id, name from myplace";
	$query=mysql_query("$myplaces") or die($myplaces." returns ".mysql_error());
	echo "<script type='text/javascript' language='javascript'>";
		echo "var placeIDArray = new Array();";
		echo "var placenameArray = new Array();";	
		
		while(list($id,$name)=mysql_fetch_row($query)){
			echo "placeIDArray[$placecount]='$id';";
			echo "placenameArray[$placecount]='$name';";
			$placecount++;
		}
		echo " var placecount=$placecount;";
	echo "</script>";
	
	$querystring="select id, filename, myplaceID, description, transformed, thumbwidth, thumbheight, displaywidth, displayheight, alttext, viewcount from photos where status='active' and transformed='1'";
	$query=mysql_query("$querystring") or die("Terminal Error - Contact <a href='mailto:support@evifwebdev.com' target='blank'>Support</a> -$querystring returned ".mysql_error());

	// get images here and build arrays
	$i = 0;
	$totalpages = 0;

	$cyclecount = 0;	
	$mypage = 1;
	$imagesperpage = 12;
	
	echo " <script type='text/javascript' language='javascript'>";

	while(list($id, $filename, $myplaceID, $description, $transformed, $thumbwidth, $thumbheight, $displaywidth, $displayheight, $alttext, $viewcount)=mysql_fetch_row($query)){

		if($cyclecount==$imagesperpage){$mypage++; $cyclecount = 0; }

		echo "photoIDArray[$i]='$id';";
		echo "filenameArray[$i]='$filename';";
		echo "myplaceIDArray[$i]='$myplaceID';";
		echo "descriptionArray[$i]='$description';";
		echo "thumbwidthArray[$i]='$thumbwidth';";
		echo "thumbheightArray[$i]='$thumbheight';";
		echo "alttextArray[$i]='$alttext';";
		echo "pagenationArray[$i]='$mypage';";
		echo "viewcountArray[$i]='$viewcount';";
		
		$i++;	
		$cyclecount++;
	}
	echo "var thegoldencount=$i;";

	echo "</script>";
	$thegoldencount=$i;
	$navrowcontrol=1;
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
		echo "<a href='#' target='_self' onclick=\"returnpage('$gallerypages'); return false;\" style='text-decoration:none; font-family:verdana; font-weight:bold; font-size:9px; color:#$txtcolor; padding:2px;'> ";
		echo "$gallerypages";
		echo "</a>";
		echo "</div><div class='photonavtop' style='width:5px;display:inline; padding-right:2px;'>&nbsp;</div>";

		if($navrowcontrol>25){
			echo "<span style=\"line-height:8px;\"><br /><br /></span>";
			$navrowcontrol=0;
		}
		$navrowcontrol++;
	}

	echo "</div>";
	$photocount=0;
	$rowcount=0;    // 4 rows of 3 thumbs
	echo "<div id='imageupdate'>";
	echo "</div>";
	echo "<div id='gallerycontent' style='width:700px; height:750px; '>";
	echo 	"<img src=../../imgs/loading.gif width=32 height=32 alt=loading... title=loading... />";
	echo "</div>";
	
	$navrowcontrol=1;
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
		echo "<a href='#' target='_self' onclick=\"returnpage('$gallerypages'); return false;\" style='text-decoration:none; font-family:verdana; font-weight:bold; font-size:9px; color:#$txtcolor; padding:2px;'> ";
		echo "$gallerypages";
		echo "</a>";
		echo "</div><div class='photonavtop' style='width:5px;display:inline; padding-right:2px;'>&nbsp;</div>";

		if($navrowcontrol>25){
			echo "<span style=\"line-height:8px;\"><br /><br /></span>";
			$navrowcontrol=0;
		}
		$navrowcontrol++;
		
		
	}
	echo "</div>";	
	echo "<script type='text/javascript' language='javascript'> initializepage(\"$page\",\"$thegoldencount\"); </script>";


echo "<div id='bottomGrey'>";
echo "<div id='footer'>&copy; EvifWeb Development</div>";
echo "<div id='counter' style='color:#FFFFFF;'></div>";
echo "</div>";
?>

</body>
</html>
