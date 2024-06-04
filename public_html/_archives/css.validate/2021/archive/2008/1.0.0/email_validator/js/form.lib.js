/* CORE FORM FUNCTION LIBRARY   */

// GLOBALS
var mymessage="";

function valid_c(){
	/* 
	subject = msgsub	
	name = n		
	email = e	
	message = m	
	*/

	// check email
	var email_stat=(validEmail($("e").value))? valid_e(true) : valid_e(false);
	
	// check name
	var name_stat=(validReqField($("n").value))? valid_n(true) : valid_n(false);
	
	// check subject
	var subject_stat=(validSubject($("msgsub").value))? valid_msgsub(true) : valid_msgsub(false);
	
	if(email_stat && name_stat && subject_stat){
		 return true;
	}else{ 
		return false;
	}

}

function valid_e(v_status){
	if(v_status){
		$("errtext_e").style.visibility="hidden";
		return true;
	}else{
		$("errtext_e").style.visibility="visible";
		return false;
	}
	
}

function valid_n(v_status){
	if(v_status){
		$("errtext_n").style.visibility="hidden";
		return true;
	}else{
		$("errtext_n").style.visibility="visible";
		return false;
	}
}

function valid_msgsub(v_status){
	if(v_status){
		$("errtext_msgsub").style.visibility="hidden";
		return true;
	}else{
		$("errtext_msgsub").style.visibility="visible";
		return false;
	}
}

function checklength(messagecopy, upperlength){
 
	upperlength=parseInt(upperlength);
	if(messagecopy.length>upperlength){
		alert("Please limit your message to "+upperlength+" characters.");
		document.getElementById("m").value=mymessage;
	}else{
		mymessage=messagecopy;
	}

}


