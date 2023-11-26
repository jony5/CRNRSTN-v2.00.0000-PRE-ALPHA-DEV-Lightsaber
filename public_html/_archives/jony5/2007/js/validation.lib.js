/* CORE VALIDATION FUNCTION LIBRARY   */
 
function validPhoneNumber(str){
    var no = str;
	var standardNo = no.replace(/[^\d]/g,'');
	if(standardNo.length<10 || isNaN(parseInt(standardNo))){
		return false;
	}
	return true;
}

function validEmail(str) {
	var emailFilter=/^.+@.+\..{2,3}$/;
	var illegalChars= /[\(\)\<\>\,\;\:\\\/\"\[\]]/
	if ((!(emailFilter.test(str))) || (str.match(illegalChars))) {
		return false;
	}
	return true;
}

function validURL(str) {
	var regexp = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/
	 if(!(regexp.test(str)) && !(str=="")){
		 return false;
	 }
	 return true;
}


function validPlainText(str) {
	var illegalChars= /[\%\^\&\;\\\/\"\[\]]/

	if (str.match(illegalChars)) {
		return false;
	}
	return true;
}

function validPassword(str){
	if (str.length<6) {
		return false;
	}
	return true;
}
 
function validReqField(str) {
	if (!str.length) {
		return false;
	}
	return true;
}

function validFile(str){
	str=str.toUpperCase();
	var extbad = new Array();
	var extbad=[".EXE",".BAT",".DLL",".VBS",".DL",".SCR",".SYS"];
	for(var i=0;i<extbad.length;i++){
		var rx=new RegExp("[^\.]\."+extbad[i]+"\s*$", "i");
		str=str.replace(/^\s+/,'').replace(/\s+$/,''); 
		if( rx.test(str) ){
			return false;
		}
	}
	
	var extgood = new Array();
	var extgood=[".PDF"];
	for(var i=0;i<extgood.length;i++){
		var rx=new RegExp("[^\.]\."+extgood[i]+"\s*$", "i");
		str=str.replace(/^\s+/,'').replace(/\s+$/,''); 
		if( rx.test(str) || (str=="") ){
			return true;
		}
	}
	return false;
}

function validAudioFile(str){
	str=str.toUpperCase();
	var ext = new Array();
	var ext=[".MP3"];
	for(var i=0;i<ext.length;i++){
		var rx=new RegExp("[^\.]\."+ext[i]+"\s*$", "i");
		str=str.replace(/^\s+/,'').replace(/\s+$/,''); 
		if( rx.test(str) || str==""){
			return true;
		}else{
			return false;
		}
	}
}

function validateAsset(asseType,assetLocation, photoformID){
	var assetValid=false;
	switch(asseType){
		case "image":
			var ext = new Array();
			var ext=[".jpg",".jpeg",".jpg2",".JPG",".JPEG",".JPG2"];
			for(var i=0;i<ext.length;i++){
				var rx=new RegExp("[^\.]\."+ext[i]+"\s*$", "i");
				assetLocation=assetLocation.replace(/^\s+/,'').replace(/\s+$/,''); 
				if( rx.test(assetLocation) ){
					assetValid = true;
				}
			}
 
			if(!assetValid){
				return false;
			}else{
 
			}
			
		break;
		case "audio":
			var ext = new Array();
			var ext=[".mp3",".MP3",".Mp3",".mP3"];
			for(var i=0;i<ext.length;i++){
				var rx=new RegExp("[^\.]\."+ext[i]+"\s*$", "i");
				assetLocation=assetLocation.replace(/^\s+/,'').replace(/\s+$/,''); 
				if( rx.test(assetLocation) ){
					assetValid = true;
				}
			}
			
			if(assetValid){

			}

			if(!assetValid){
				return false;
			}else{
 
			}
		break;		
		case "pdfdoc":
			var ext = new Array();
			var ext=[".pdf",".PDF"];
			for(var i=0;i<ext.length;i++){
				var rx=new RegExp("[^\.]\."+ext[i]+"\s*$", "i");
				assetLocation=assetLocation.replace(/^\s+/,'').replace(/\s+$/,''); 
				if( rx.test(assetLocation) ){
					assetValid = true;
				}
			}
			if(!assetValid){
				return false;
			}else{
				return true;
			}
		break;
	}

	return assetValid;
}


