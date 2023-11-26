// JavaScript Document


//
// INITIALIZE
Event.observe(window, 'load', initGlobal, false);

function initGlobal(){
	
	//
	// TRACKING
	if(enableGoogle){
		initGoogle();
	}
	
	if($("footer-copyright")){
		form_sysdate = new Date();
		var dy = fullYear(form_sysdate);
		$("footer-copyright").innerHTML="&copy; "+dy+" All Rights Reserved.";	
	}
	
	if($("confirmation_message")){
		$("confirmation_message").fade({ duration: 2, from: 1, to: 0 });
	}
}

function fullYear(theDate)
{
	x = theDate.getYear();
	var y = x % 100;
	y += (y < 38) ? 2000 : 1900;
	return y;
}


function tabVisibility(tabID,tabCount){
	for(i=0;i<tabCount;i++){
		$("tab_pane_wrapper_"+i).addClassName('tab_pane_wrapper_hidden');
		$("tab_pane_"+i).addClassName('primary_tab_lnk_sub_inactive');
		$("tab_pane_"+i).removeClassName('primary_tab_lnk_sub_active');
	}
	
	$("tab_pane_wrapper_"+tabID).removeClassName('tab_pane_wrapper_hidden');
	$("tab_pane_wrapper_"+tabID).addClassName('tab_pane_wrapper');
	
	$("tab_pane_"+tabID).addClassName('primary_tab_lnk_sub_active');
}


//
// FORM VALIDATION REQUIREMENTS
function validData(formID){
	var formHandle=$(formID);
	
	switch(formID){
		case "contactform":
			//
			// REQUIRED FIELDS INCLUDE
			var email=$("email").value.toUpperCase();
			//var emailconfim=$("emailconfirm").value.toUpperCase();
			var fnamevalue=$("fname").value;				// NOT NULL
			var lnamevalue=$("lname").value;				// NOT NULL	
			
			//
			// NOT REQUIRED...BUT IF ENTERED...NEED TO BE CORRECT
			var phone=$("phone").value;				// IF REQUIRED, STRIP TO DIGITS ONLY?
 			var zip=$("zip").value;						// 5 DIGITS
			
			if(validReqField(fnamevalue) && validReqField(lnamevalue) && validEmail(email) && (validPhone_nullok(phone) || phone=="") && (validZip(zip) || zip=="")){
				return true;
			}else{
				showerror(validReqField(fnamevalue),'fname');
				showerror(validReqField(lnamevalue),'lname');
				showerror(validEmail(email),'email');
				//showerror(validPhone_nullok(phone, 'phone'),'phone');
				//showerror(validZip_nullok(zip, 'zip'),'zip');
				//showerror(validEmailConfirm(email,emailconfim),'emailconfirm');
				return false;	
			}
			
		break;	
		case "signupform":
			//
			// REQUIRED FIELDS INCLUDE
			var email=$("email").value.toUpperCase();
			//var emailconfim=$("emailconfirm").value.toUpperCase();
			var fnamevalue=$("fname").value;				// NOT NULL
			var lnamevalue=$("lname").value;				// NOT NULL	
			
			//
			// NOT REQUIRED...BUT IF ENTERED...NEED TO BE CORRECT
			var phone=$("phone").value;						// IF REQUIRED, STRIP TO DIGITS ONLY?
			var zip=$("zip").value;							// 5 DIGITS
			
			if(validReqField(fnamevalue) && validReqField(lnamevalue) && validEmail(email) && (validPhone_nullok(phone) || phone=="") && (validZip(zip) || zip=="")){
				return true;
			}else{
				showerror(validReqField(fnamevalue),'fname');
				showerror(validReqField(lnamevalue),'lname');
				showerror(validEmail(email),'email');
				//showerror(validPhone_nullok(phone, 'phone'),'phone');
				//showerror(validZip_nullok(zip, 'zip'),'zip');
				//showerror(validEmailConfirm(email,emailconfim),'emailconfirm');
				return false;	
			}
		
		break;
	}
}


//
// FORM VALIDATION USER FEEDBACK
function showerror(input_status, input_type){
	if(!input_status){
		$(input_type + "_err").addClassName("input_text_wrapper_err");
		$(input_type + "_req").style.display = 'inline';
	}else{
		$(input_type + "_err").removeClassName("input_text_wrapper_err");
		$(input_type + "_req").style.display = 'none';
	}
}