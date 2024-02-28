// JavaScript Document
 
function checklen(myid ,messagecopy, upperlength){
	upperlength=parseInt(upperlength);
	if(messagecopy.length>upperlength){
		alert("Please limit your message to "+upperlength+" characters.");
		document.getElementById([myid]).value=mymessage;
	}else{
		mymessage=messagecopy;
	}
}
 
/*

	Function: validReqField
		Tests field as valid required field.
		
	Parameters:
		str - string to validate.
		
	Returns:
		Boolean.
		
*/
function validReqField(str) {
	if (!str.length) {
		return false;
	}
	return true;
}
/*

	Function: validEmail
		Tests field as valid email address.
		
	Parameters:
		str - string to validate.
		
	Returns:
		Boolean.
		
*/
function validEmail(str) {
	var emailFilter=/^.+@.+\..{2,5}$/;
	var illegalChars= /[\(\)\<\>\,\;\:\\\/\"\[\]]/
	if ((!(emailFilter.test(str))) || (str.match(illegalChars))) {
		return false;
	}
	return true;
}
 

/*

	Function: validZip
		Tests field as valid 5 digit zipcode.
		
	Parameters:
		str - string to validate.
		
	Returns:
		Boolean.
		
*/
function validZip(str) {
	var zipFormat = /\d\d\d\d\d/; //Entered All Numbers?
	var temp = str + "";
	var test = temp.search(zipFormat)
	if (test == -1) {
		return false;
	}
	return true;
}

function validZip_nullok(str) {
	if(str==""){
		return true;
	}else{
		var zipFormat = /\d\d\d\d\d/; //Entered All Numbers?
		var temp = str + "";
		var test = temp.search(zipFormat)
		if (test == -1) {
			return false;
		}
		return true;
		}
}



/*
	Function: validPhone
		Tests field as valid 10 digit phone number.
		
	Parameters:
		str - string to validate.
		
	Returns:
		Boolean.
*/
function validPhone(str) {
	var temp = str.replace(/[\(\)\.\-\ ]/g, '');
	if (isNaN(parseInt(temp)) || (temp.length != 10)) {
		return false;
	}
	return true;
}

function validPhone_nullok(str) {
	if(str==""){
		return true;
	}else{
	
		var temp = str.replace(/[\(\)\.\-\ ]/g, '');
		if (isNaN(parseInt(temp)) || (temp.length != 10)) {
			return false;
		}
		return true;
		
	}
}

 