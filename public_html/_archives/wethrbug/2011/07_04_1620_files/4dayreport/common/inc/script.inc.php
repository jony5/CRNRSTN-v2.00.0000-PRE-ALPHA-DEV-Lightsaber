<script language="javascript" type="text/javascript">
function loadConnection(connURL){
	var dest=connURL;
	window.location="<?php echo $ROOT;  ?>"+connURL;
	
}


function cleanUpData(){
	// FORMAT MOBILE NUMBER
	var pin=document.getElementById("pin").value;
		
	if(!validPIN(pin)){
		document.getElementById("formStatus").innerHTML="<span style='font-weight:bold; color:#E10000;'>Invalid Mobile Number or ZIPCODE</span>";
		return false;	
	}else{
		return true;
	}
}

function cleanUpPost(){
	// FORMAT MOBILE NUMBER
	var post=trim(document.getElementById("message").value);
	document.getElementById("message").value=post;	
	if(!validReqField(post)){
		document.getElementById("formStatus").innerHTML="<span style='font-weight:bold; color:#E10000;'>Invalid Post</span>";
		return false;	
	}else{
		return true;
	}
}

function trim(stringToTrim) {
	return stringToTrim.replace(/^\s+|\s+$/g,"");
}
function ltrim(stringToTrim) {
	return stringToTrim.replace(/^\s+/,"");
}
function rtrim(stringToTrim) {
	return stringToTrim.replace(/\s+$/,"");
}

function validPIN(val) {
        var stripped = val.replace(/[\(\)\.\-\ ]/g, '');
        //strip out acceptable non-numeric characters
        if ((isNaN(stripped) && stripped.length != 0) || (stripped.length != 4)) { //if not a number or not 4 digits, return false
            return false;
        } else {
            return true;
        }
	}

function validUsername(){
	var username=document.getElementById("username").value;
		
	if(!validReqField(username)){
		document.getElementById("formStatus").innerHTML="<span style='font-weight:bold; color:#E10000;'>Invalid Username</span>";
		return false;	
	}else{
		return true;
	}
	
}

function validReqField(str) {
	if (!str.length) {
		return false;
	}
	return true;
}

function cleanUpPrefs(){
	var carrier=document.getElementById("carrier").value;
	var smsnotice=document.getElementById("smsnotice").checked;
	
	if(smsnotice && carrier==""){
		document.getElementById("formStatus_carrier").innerHTML="<span style='font-weight:bold; color:#E10000;'>Please select your wireless provider.</span>";
		return false;
	}
	return true;
}



</script>