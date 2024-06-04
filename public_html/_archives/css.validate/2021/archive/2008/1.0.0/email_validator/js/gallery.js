// lowly JavaScript Document


//
// OBJECT CONTROLLER
var objectArrayIndex = 0;
var galleryimageARRAY = new Array();
function oImageProfile(pid, cid, gid, description, width, height, datecreated, datemodified, filename) {
    this.pid = pid;
    this.gid = gid;
    this.description = description;
	this.width = width;
    this.height = height;
	this.datecreated = datecreated;
	this.datemodified = datemodified;
	this.filename = filename;
}

function setImageObject(pid, cid, gid, description, width, height, datecreated, datemodified, filename) {
    galleryimageARRAY[objectArrayIndex++] = new oImageProfile(pid, cid, gid, description, width, height, datecreated, datemodified, filename);
}

//
// WHERE AM I LOADING FROM
function getbase(rooturl){
	var localhost_site = "http://j5.pix2flix.net/xml/";
	var wkshost_site = "http://www.jony5.com/xml/";
	var orig_base=rooturl+"";
	
	orig_base=orig_base.toLowerCase();
	i=orig_base.indexOf("jony5");
	if(i>0){
		return wkshost_site;
	}else{
		return localhost_site;
	}
}


function initgalleryContent(){
	//
	// LOAD XML
	loadgallery();
}



//
// GRUNT FUNCTIONS

//
// LOAD XML
var xml_urlbase = getbase(window.location);

function loadgallery(){
	var datafile = xml_urlbase + 'photos.xml';
	var pars = "";
	var myAjax = new Ajax.Request(
		datafile, 
		{
			method: 'get', 
			parameters: pars, 
			onComplete: parseMyXML
		}); 
}

//
// PARSE XML TO OBJECT
function parseMyXML(originalRequest){
	var oimagedata = originalRequest.responseXML.getElementsByTagName("image");
	loadimages(oimagedata);
}
 

//
// PRIMARY XML LOAD CONTROLLER
function loadimages(oItemNode){
	var i=0;
	for(i; i<oItemNode.length; i++){
		var oImage = oItemNode[i];
		
		var oPid=oImage.getElementsByTagName("pid");
		var oCid= oImage.getElementsByTagName("cid");
		var oGid= oImage.getElementsByTagName("gid");
		var oDescription= oImage.getElementsByTagName("description");		
		var oWidth= oImage.getElementsByTagName("width");
		var oHeight= oImage.getElementsByTagName("height");
		var oDatecreated= oImage.getElementsByTagName("datecreated");
		var oDatemodified= oImage.getElementsByTagName("datemodified");
		var oFilename= oImage.getElementsByTagName("filename");

		var pid=oPid[0].childNodes[0].nodeValue;
		var cid=oCid[0].childNodes[0].nodeValue;
		var gid=oGid[0].childNodes[0].nodeValue;
		var description=oDescription[0].childNodes[0].nodeValue;
		var width=oWidth[0].childNodes[0].nodeValue;
		var height=oHeight[0].childNodes[0].nodeValue;
		var datecreated=oDatecreated[0].childNodes[0].nodeValue;
		var datemodified=oDatemodified[0].childNodes[0].nodeValue;
		var filename=oFilename[0].childNodes[0].nodeValue;
		
		setImageObject(pid, cid, gid, description, width, height, datecreated, datemodified, filename);
	}
	
	//
	// DISPLAY RESULTS
	showimages(0,0,1);
}

function showimages(categoryID, groupID, mypage){
	var HTMLoutput="";
	var page=1;
	mypage=mypage+0;
	categoryID=categoryID+0;
	groupID=groupID+0;
	var starHTML = "";
	var pagecontroller=0;
	var starcontroller=0;
	
	for(var i=0;i<galleryimageARRAY.length; i++){
		if(galleryimageARRAY[i]){
			var imageprofile = galleryimageARRAY[i];
			if((categoryID==0 || imageprofile.cid==categoryID) && (groupID==0 || imageprofile.gid==groupID) && (mypage==imageprofile.pid)){
				starcontroller++;
 				HTMLoutput=HTMLoutput+"<div class='thum_prev' style='float:left;'><img src='imgs/"+imageprofile.filename+"' width='150' height='112' border='0' alt='"+imageprofile.pid+"' title='"+imageprofile.pid+"' /></div>";						 
			}
		}
	}
	
	var page=1;
	var starHTML = "";
	var pagecontroller=galleryimageARRAY.length;
	
	starHTML = "<div class='cb'></div><div style='text-align:center;  width:190px; padding-top:9px; '><table cellpadding='0' cellspacing='0' border='0'><tr><td>";
 
	while(pagecontroller>0){
		pagecontroller=pagecontroller-5;
		page++;
	}
	for(var star_i=1; star_i<page; star_i++){
		if(starcontroller>0){
			if(star_i==mypage){
				starHTML = starHTML +"<div style='padding:3px; width:13px; height:13px; float:left;'><img src='imgs/sm_star.gif' width='13' height='13' alt='' /></div>";
			}else{
				starHTML = starHTML +"<div style='padding:3px; width:13px; height:13px; float:left; cursor:pointer;' onclick='showimages(0, 0, "+star_i+")'><img src='imgs/sm_star_off.gif' width='13' height='13' alt='' /></div>";
			}	
		}
		starcontroller--;
	}	
 
	starHTML = starHTML + "</td></tr></table></div><div class='cb'></div>";
	
	$("gallery_shell").innerHTML=starHTML+HTMLoutput+starHTML;
}

//
// LIVE SEARCH FUNCTIONALITY
function prepsearchFilter(){
	clearTimeout(searchfilterTimerId);
	searchfilterTimerId = setTimeout( "filterbySearch()", 600 );
}

function filterbySearch(){
	var deptID=$("dpt").value;
	var officeID=$("office").value;
	var filterstring =$("s").value;
	var HTMLoutput="";
	
	if(filterstring.length>1){
		for(var i=0;i<galleryimageARRAY.length; i++){
			if(galleryimageARRAY[i]){	
				var employeeprofile = galleryimageARRAY[i];
				if((deptID=="0" || employeeprofile.deptid==$("dpt").value) && (officeID=="0" || employeeprofile.office==$("office").value)){
					if(employeeprofile.alias!="0" && employeeprofile.alias!=""){
						var employeename=employeeprofile.firstname+" '"+employeeprofile.alias+"' "+employeeprofile.lastname;
					}else{
						var employeename=employeeprofile.firstname+" "+employeeprofile.lastname;
					}
					
					filterstring=filterstring.toLowerCase(); 
					var employeename_chk=employeename.toLowerCase();
					var employeeprofile_email_chk=employeeprofile.email.toLowerCase();
					var employeeprofile_position_chk=employeeprofile.position.toLowerCase();
					var employeeprofile_yahooim_chk=employeeprofile.yahooim.toLowerCase();					
					
					if(employeename_chk.indexOf(filterstring)>-1 || employeeprofile_email_chk.indexOf(filterstring)>-1 || employeeprofile_position_chk.indexOf(filterstring)>-1 || employeeprofile.extension.indexOf(filterstring)>-1 || employeeprofile_yahooim_chk.indexOf(filterstring)>-1 ){
									HTMLoutput=HTMLoutput+"<div class='profile_shell'>"+
							"<div class='profile_thumb'><img src='imgs/thumbs/"+employeeprofile.thumbnail+"' width='"+employeeprofile.width+"' height='"+employeeprofile.height+"' alt='"+employeeprofile.firstname+"' /></div>"+
							"<div class='profile_data'>"+
								"<div class='profile_name'>"+employeename+"</div>"+
								"<div class='profile_email'><a href='mailto:'"+employeeprofile.email+" target='_blank'>"+employeeprofile.email+"</a></div>"+
								"<div class='profile_title'>"+employeeprofile.position+"</div>"+
								"<div class='profile_dpt'>"+employeeprofile.department+"</div>"+
								"<div class='profile_ext'>ext - "+employeeprofile.extension+"</div>"+
								"<div class='profile_mobile'>wireless - "+employeeprofile.mobilenumber+"</div>"+
								"<div class='profile_im'>"+
									"<div class='profile_im_icon'><img src='imgs/y_icon.gif' width='36' height='38' alt='IM' /></div>"+
									"<div class='profile_im_id'>"+employeeprofile.yahooim+"</div>"+
								"</div>"+
							"</div>"+
						"</div>";
					}
				}
			}
		}	
		
		$("results").innerHTML=HTMLoutput;
	}else{
		
		showemployees($("office").value,$("dpt").value);
	}
}
