/* 
// J5
// Code is Poetry */

//	Structuring of code inspired by Lightbox v2.01
//	by Lokesh Dhakar - http://www.huddletogether.com
//	09.25.14
//	Structuring of code inspired by Scott Upton (http://www.uptonic.com/)

/*
	- ON PAGE LOAD, INITIALIZE FUNCTIONALITY OF FORM ELEMENTS PRESENT
	- CONSIDER PLACING INITIALIZATION DETAILS IN "REL" OR CUSTOM "F_INIT" TAG OF EACH ELEMENT THAT NEEDS TO BE INITIALIZED
		- LOOP THROUGH ALL <INPUT> TO SCRAPE INITIALIZATION DETAILS AND EXECUTE
		- LOOP THROUGH ALL <CHECKBOX>
		- LOOP THROUGH ALL <TEXTAREA>
		- LOOP THROUGH ALL <SUBMIT BUTTONS>
		- LOOP THROUGH ALL <RADIOBUTTON>
		- LOOP THROUGH ALL <HIDDEN FIELDS>
		
		<input frm_init="crnrstn_frm_handle" crnrstn_frm_valtype="required" name="un" type="text" id="un" size="20" maxlength="100" value="" frm_init="hello_init" />
		crnrstn_frm_valtype = "username"
		crnrstn_frm_valtype = "password"
		crnrstn_frm_valtype = "required"
		crnrstn_frm_valtype = "email"
		crnrstn_frm_valtype = "username_unique"
*/

var crnrstn_fhandler = Class.create();

crnrstn_fhandler.prototype = {
	
	initialize: function() {

		//
		// DOM CHECK
		if (!document.getElementsByTagName){ return; }
		
		//
		// STORE INPUT VALIDATION STATE []
		inputStateArray = [];					// [ERROR_STATE_FULL, ERROR_STATE_PARTIAL, ERROR_STATE_CLEAR]
		crnrstn_inputIDArray = [];
		errorsFound = '';
		var inputs = document.getElementsByTagName('input');
		var formX='';
		var formY='';
		var formLock = '0';
		var elementid;
		
		//
		// LOOP THROUGH ALL INPUT TAGS
		for (var i=0; i<inputs.length; i++){
			var input = inputs[i];

			if($(input.id+'_input_validation_copy')){
				//
				// MANAGE BEHAVIOR VIA EFFECTS
				$(input.id+'_input_validation_copy').hide();	
			}
			
			if(i==0 && $(input.id)){
				$(input.id).focus();
			}
			
			var frm_initAttribute = String(input.getAttribute('frm_init'));
			
			//
			// USE THE string.match() METHOD TO CATCH 'crnrstn_frm_handle' REFERENCES IN THE frm_init ATTRIBUTE
			if (input.getAttribute('crnrstn_frm_valtype') && (frm_initAttribute.toLowerCase().match('crnrstn_frm_handle'))){
				crnrstn_inputIDArray[i] = input;
				input.onclick = function () {mycrnrstn_fhandler.clickListener(this);}
				input.onkeydown = function () {mycrnrstn_fhandler.keyboardListener(this); }
				input.onblur = function () {mycrnrstn_fhandler.leavingListener(this);}
			}
			
			//
			// CRNRSTN SEARCH
			if(input.getAttribute('crnrstn_search')){					
				input.onkeydown = function(event){
					var query = window.location.href; 
					var vars = query.split("/"); 
					var HTTP_ROOT = vars[0]+'//'+vars[2]+'/';
	
					var url = HTTP_ROOT + 'crnrstn/search/suggest/';
					var params = 's='+this.value;
					
					if(this.value.length>1){
						//
						// AJAX SEARCH REQUEST
						var ajax = new Ajax.Updater(
						{success: 's_results'},
						url,
						{method: 'get', parameters: params});
					}
				}
				
				window.onclick = function(event){	
					$('s_results').innerHTML='';
				}
			}
		}
		
		//
		// LOOP THROUGH ALL FORM TAGS AND INITIALIZE FORM SUBMIT
		var err_is_showing=0;
		var forms = document.getElementsByTagName('form');	
		formSubmitBtnArray = [];
		
		//
		// LOOP THROUGH ALL FORM TAGS
		for (var i=0; i<forms.length; i++){
			var form = forms[i];

			if($('primary')){

			}else{

				if($(form.id+'_errStatus')){
					new Effect.Appear(form.id+'_errStatus', { duration: 0.1, from: 0.0, to: 0.0, afterFinish: function(){$(form.id+'_errStatus').style.display='none;'; }  });
				}

				if($(form.id+'_submit_btn')){

					//
					// PRESENT ANY ERROR MESSAGES
					if($(form.id+'_errmsg')){
					if($(form.id+'_errmsg').innerHTML!='' && err_is_showing!='1'){

						$(form.id+'_errStatus').innerHTML=$(form.id+'_errmsg').innerHTML;
						new Effect.Appear(form.id+'_errStatus', { duration: 1.0, from: 0.0, to: 1.0, afterFinish: function(){$(form.id+'_errStatus').style.display='inline;'; }  });
						err_is_showing='1';
					}
					}

					//
					// ADD FORM SUBMISSION BEHAVIOR TO BUTTON
					formSubmitBtnArray[form.id] = $(form.id+'_submit_btn');
					formSubmitBtnArray[form.id].onclick = function() { mycrnrstn_fhandler.formSubmit(form.id); }
				}
			}
		}

		if($('primary')){

		}else{
			
			//
			// SPECIAL HANDLING FOR ADMIN MGMT
			if($('admin_overlay')){
				$('admin_overlay').onclick = function() { mycrnrstn_fhandler.abandonForm(); }
				new Effect.Appear('admin_overlay', { duration: 0.0, from: 0.0, to: 0.0, afterFinish: function(){$('admin_overlay').style.display='none;'; }  });

				if($('admin_frm_loading')){
					new Effect.Appear('admin_frm_loading', { duration: 0.0, from: 0.0, to: 1.0, afterFinish: function(){ /* NEED TO DO ANYTHING?*/  }  });
				}
			}
		}
	},
	
	//
	// EVENT LISTENER :: MOUSE CLICK
	clickListener: function(formElem) {		
		//
		// REWARD USER ATTENTION WITH DOWNGRADED ERROR STATUS
		if(inputStateArray[formElem.id]=='ERROR_STATE_FULL'){
			//
			// DOWNGRADE ERROR STATE TO PARTIAL
			mycrnrstn_fhandler.hideErrorPartially(formElem);
			
		}
	},
	
	//
	// EVENT LISTENER :: KEY PRESS
	keyboardListener: function(formElem) {

		//
		// REWARD USER ATTENTION WITH DOWNGRADED ERROR STATUS
		if(inputStateArray[formElem.id]=='ERROR_STATE_FULL'){
			//
			// DOWNGRADE ERROR STATE TO PARTIAL
			mycrnrstn_fhandler.hideErrorPartially(formElem);
		}
		
		//
		// REAL-TIME VALIDATION WITH POTENTIAL FOR FURTHER DOWNGRADE OF ERROR STATE TO ERROR_STATE_CLEAR
		mycrnrstn_fhandler.validateMe(formElem,'KEYPRESS');
	},
	
	//
	// EVENT LISTENER :: ON BLUR
	leavingListener: function(formElem) {
		//
		// RUN VALIDATION CHECK ON formElem. GOTO ERROR_STATE_FULL UPON FAILURE.
		mycrnrstn_fhandler.validateMe(formElem,'ONBLUR');	
	},
	
	leavingListenerAdmin: function(formElem) {
		//
		// RUN VALIDATION CHECK ON formElem. GOTO ERROR_STATE_FULL UPON FAILURE.
		mycrnrstn_fhandler.validateMeAdmin(formElem,'ONBLUR');	
	},
	
	//
	// VALIDATION SWITCH
	validateMe: function(formElem, listenerEventType) {

		//
		// WHERE listenerEventType = [ONBLUR,KEYPRESS,MOUSECLICK]
		if(listenerEventType!='MOUSECLICK'){
			switch(formElem.getAttribute('crnrstn_frm_valtype')){
				case "username":
					// STATE OF ERROR VALIDATION WILL BE EITHER ERROR_STATE_PARTIAL OR ERROR_STATE_CLEAR
					// KEYPRESS []
					// NOTHING TO DO UNTIL ONBLUR (OR SUBMIT)
					
					//
					// ONBLUR
					if(listenerEventType=='ONBLUR'){
						//
						// PERFORM FULL VALIDATION AND EITHER CLEAR THE ERROR_STATE_PARTIAL OR THROW TO ERROR_STATE_FULL
						if(mycrnrstn_fhandler.validateUsername(formElem)){
							mycrnrstn_fhandler.validateUsername_AJAX(formElem);
						}
					}
					
					if(listenerEventType=='ONSUBMIT'){
						mycrnrstn_fhandler.validateUsername(formElem);
					}
					
				break;
				case "password":
					// STATE OF ERROR VALIDATION WILL BE EITHER ERROR_STATE_PARTIAL OR ERROR_STATE_CLEAR
					// KEYPRESS []
					// NOTHING TO DO UNTIL ONBLUR (OR SUBMIT)
					
					//
					// ONBLUR
					if(listenerEventType=='ONBLUR' || listenerEventType=='ONSUBMIT'){
						//
						// PERFORM FULL VALIDATION AND EITHER CLEAR THE ERROR_STATE_PARTIAL OR THROW TO ERROR_STATE_FULL
						mycrnrstn_fhandler.validatePassword(formElem);
					}
					
				break;
				case "pwdconfirm":
				
					//
					// ONBLUR
					if(listenerEventType=='ONBLUR' || listenerEventType=='ONSUBMIT'){
						//
						// PERFORM FULL VALIDATION AND EITHER CLEAR THE ERROR_STATE_PARTIAL OR THROW TO ERROR_STATE_FULL
						mycrnrstn_fhandler.validatePasswordConfirm(formElem);
					}
				
				break;
				case "password_update":
					if((listenerEventType=='ONBLUR' || listenerEventType=='ONSUBMIT') && formElem.value!=''){
						//
						// PERFORM FULL VALIDATION AND EITHER CLEAR THE ERROR_STATE_PARTIAL OR THROW TO ERROR_STATE_FULL
						mycrnrstn_fhandler.validatePassword(formElem);
					}				
				break;
				case "thumbnail":
					if((listenerEventType=='ONBLUR' || listenerEventType=='ONSUBMIT') && formElem.value!=''){
						//
						// PERFORM FULL VALIDATION AND EITHER CLEAR THE ERROR_STATE_PARTIAL OR THROW TO ERROR_STATE_FULL
						if(mycrnrstn_fhandler.validateAsset('image', formElem.value)){
							mycrnrstn_fhandler.hideErrorInFull(formElem);
						}else{
							//
							// THROW ERROR_STATE_FULL
							mycrnrstn_fhandler.errorsFound='ERR_FOUND';
							mycrnrstn_fhandler.throwFullError(formElem);	
						}
					}
				break;
				case "ugc_feedback":
				case "ugc_comment":
					if(listenerEventType=='ONBLUR' || inputStateArray[formElem.id]=='ERROR_STATE_PARTIAL' || listenerEventType=='ONSUBMIT'){
						//
						// PERFORM FULL VALIDATION AND EITHER CLEAR THE ERROR_STATE_PARTIAL OR (FOR ONBLUR) THROW TO ERROR_STATE_FULL
						mycrnrstn_fhandler.validateComment(formElem,listenerEventType);
					}
				break;
				case "required":
					// STATE OF ERROR VALIDATION WILL BE EITHER ERROR_STATE_PARTIAL OR ERROR_STATE_CLEAR
					// KEYPRESS []
					// RUN REAL-TIME VALIDATION IF ERROR_STATE_PARTIAL
					
					//alert('validating for required...-->'+formElem.id);
					//
					// ONBLUR
					if(listenerEventType=='ONBLUR' || inputStateArray[formElem.id]=='ERROR_STATE_PARTIAL' || listenerEventType=='ONSUBMIT'){
						//
						// PERFORM FULL VALIDATION AND EITHER CLEAR THE ERROR_STATE_PARTIAL OR (FOR ONBLUR) THROW TO ERROR_STATE_FULL
						mycrnrstn_fhandler.validateRequired(formElem,listenerEventType);
					}
				break;
				case "email":
					// STATE OF ERROR VALIDATION WILL BE EITHER ERROR_STATE_PARTIAL OR ERROR_STATE_CLEAR
					// KEYPRESS []
					// RUN REAL-TIME VALIDATION IF ERROR_STATE_PARTIAL
					
					//
					// ONBLUR
					if(listenerEventType=='ONBLUR' || inputStateArray[formElem.id]=='ERROR_STATE_PARTIAL' || listenerEventType=='ONSUBMIT'){
						//
						// PERFORM FULL VALIDATION AND EITHER CLEAR THE ERROR_STATE_PARTIAL OR (FOR ONBLUR) THROW TO ERROR_STATE_FULL
						mycrnrstn_fhandler.validateEmail(formElem ,listenerEventType);
					}
				break;
				case "email_nonrequired":
					
					if(formElem.value!=''){
						if(listenerEventType=='ONBLUR' || inputStateArray[formElem.id]=='ERROR_STATE_PARTIAL' || listenerEventType=='ONSUBMIT'){
							//
							// PERFORM FULL VALIDATION AND EITHER CLEAR THE ERROR_STATE_PARTIAL OR (FOR ONBLUR) THROW TO ERROR_STATE_FULL
							mycrnrstn_fhandler.validateEmail(formElem ,listenerEventType);
						}
					}
				break;
				case "none":
				break;
				default:
					alert("Unknown validation type. Choose from [username,password,required,email,username_unique]");
				break;
			}
		}
	},
	
	//
	// VALIDATION SWITCH
	validateMeAdmin: function(formElem, listenerEventType) {
	
		//
		// WHERE listenerEventType = [ONBLUR,KEYPRESS,MOUSECLICK]
		if(listenerEventType!='MOUSECLICK'){
			switch(formElem.getAttribute('crnrstn_frm_valtype')){
				case "required":
					// STATE OF ERROR VALIDATION WILL BE EITHER ERROR_STATE_PARTIAL OR ERROR_STATE_CLEAR
					// KEYPRESS []
					// RUN REAL-TIME VALIDATION IF ERROR_STATE_PARTIAL
					
					//alert('validating for admin required...-->'+formElem.id);
					//
					// ONBLUR
					if(listenerEventType=='ONBLUR' || inputStateArray[formElem.id]=='ERROR_STATE_PARTIAL'){
						//
						// PERFORM FULL VALIDATION AND EITHER CLEAR THE ERROR_STATE_PARTIAL OR (FOR ONBLUR) THROW TO ERROR_STATE_FULL
						mycrnrstn_fhandler.validateRequiredAdmin(formElem,listenerEventType);
					}
				break;
				case "none":
				break;
				default:
					alert("Unknown validation type. Choose from [username,password,required,email,username_unique]");
				break;
			}
		}
	},
	
	//
	// FORM VALIDATION :: VALIDATE USERNAME INPUT
	validateUsername: function(formElem){
		if(mycrnrstn_fhandler.validUsername(formElem)){
			//
			// CLEAR ERROR_STATE_PARTIAL
			mycrnrstn_fhandler.hideErrorInFull(formElem);
			return true;
		}else{
			//
			// THROW ERROR_STATE_FULL
			mycrnrstn_fhandler.errorsFound='ERR_FOUND';
			mycrnrstn_fhandler.throwFullError(formElem);
			return false;
		}
	},
	
	validateUsername_AJAX: function(formElem){
		if(mycrnrstn_fhandler.validUsername_AJAX(formElem)){
			//
			// CLEAR ERROR_STATE_PARTIAL
			//mycrnrstn_fhandler.hideErrorInFull(formElem);

		}else{
			//
			// THROW ERROR_STATE_FULL
			//mycrnrstn_fhandler.errorsFound='ERR_FOUND';
			//mycrnrstn_fhandler.throwFullError(formElem);
			
		}
	},
	
	//
	// FORM VALIDATION :: VALIDATE PASSWORD
	validatePassword: function(formElem){
		if(mycrnrstn_fhandler.validPwdField(formElem)){
			//
			// CLEAR ERROR_STATE_PARTIAL
			mycrnrstn_fhandler.hideErrorInFull(formElem);
		}else{
			//
			// THROW ERROR_STATE_FULL
			mycrnrstn_fhandler.errorsFound='ERR_FOUND';
			mycrnrstn_fhandler.throwFullError(formElem);
		}
	},
	
	validatePasswordConfirm: function(formElem){
		if(mycrnrstn_fhandler.validPwdField(formElem) && ($("pwd").value==$("pwdconfirm").value)){
			//
			// CLEAR ERROR_STATE_PARTIAL
			mycrnrstn_fhandler.hideErrorInFull(formElem);
			mycrnrstn_fhandler.hideErrorInFull($("pwdconfirm"));
		}else{
			//
			// THROW ERROR_STATE_FULL
			mycrnrstn_fhandler.errorsFound='ERR_FOUND';
			mycrnrstn_fhandler.throwFullError(formElem);
		}
	},
	
	//
	// FORM VALIDATION :: VALIDATE EMAIL
	validateEmail: function(formElem,listenerEventType){
		if(mycrnrstn_fhandler.validEmail(formElem)){
			//
			// CLEAR ERROR_STATE_PARTIAL
			mycrnrstn_fhandler.hideErrorInFull(formElem);
		}else{
			if(listenerEventType!='KEYPRESS'){
				//
				// THROW ERROR_STATE_FULL
				mycrnrstn_fhandler.errorsFound='ERR_FOUND';
				mycrnrstn_fhandler.throwFullError(formElem);
			}
		}
	},
	
	validateThumbnail: function(formElem, listenerEventType){
		if(mycrnrstn_fhandler.validImage(formElem)){
			//
			// CLEAR ERROR_STATE_PARTIAL
			mycrnrstn_fhandler.hideErrorInFull(formElem);
		}else{
			if(listenerEventType!='KEYPRESS'){
				//
				// THROW ERROR_STATE_FULL
				mycrnrstn_fhandler.errorsFound='ERR_FOUND';
				mycrnrstn_fhandler.throwFullError(formElem);
			}
		}
	},
	
	//
	// FORM VALIDATION :: VALIDATE UGC COMMENT
	validateComment: function(formElem, listenerEventType){
		if(mycrnrstn_fhandler.validComment(formElem)){
			//
			// CLEAR ERROR_STATE_PARTIAL
			mycrnrstn_fhandler.hideErrorInFull(formElem);
		}else{
			if(listenerEventType!='KEYPRESS'){
				//
				// THROW ERROR_STATE_FULL
				mycrnrstn_fhandler.errorsFound='ERR_FOUND';
				mycrnrstn_fhandler.throwFullError(formElem);
			}
		}
	},
	
	//
	// FORM VALIDATION :: VALIDATE REQUIRED
	validateRequired: function(formElem,listenerEventType){
		if(mycrnrstn_fhandler.validReqField(formElem)){
			//alert('hiding error in full...->formElem::'+formElem+'formElem ID->'+formElem);
			//
			// CLEAR ERROR_STATE_PARTIAL
			mycrnrstn_fhandler.hideErrorInFull(formElem);
		}else{
			if(listenerEventType!='KEYPRESS'){
				//
				// THROW ERROR_STATE_FULL
				mycrnrstn_fhandler.errorsFound='ERR_FOUND';
				mycrnrstn_fhandler.throwFullError(formElem);
				
			}
			//alert('doing nothing...->formElem::'+formElem+'formElem ID->'+formElem);
		}
	},
	
	//
	// FORM VALIDATION :: VALIDATE REQUIRED
	validateRequiredAdmin: function(formElem,listenerEventType){
		if(mycrnrstn_fhandler.validReqField(formElem)){
			//alert('hiding error in full...->formElem::'+formElem+'formElem ID->'+formElem.id);
			//
			// CLEAR ERROR_STATE_PARTIAL
			mycrnrstn_fhandler.hideErrorInFullAdmin(formElem);
		}else{
			if(listenerEventType!='KEYPRESS'){
				//
				// THROW ERROR_STATE_FULL
				mycrnrstn_fhandler.errorsFound='ERR_FOUND';
				mycrnrstn_fhandler.throwFullError(formElem);
				
			}
			//alert('doing nothing...->formElem::'+formElem+'formElem ID->'+formElem);
		}
	},	
	
	//
	// FORM BEHAVIOR :: THROW FULL ERROR
	throwFullError: function(formElem){
		//
		// UPDATE FORM ELEMENT UI TO REFLECT FULL ERROR
		if($(formElem.id+'_input_validation_copy').style.display!='inline'){ // IF NOT VISIBLE...
			new Effect.Appear(formElem.id+'_input_validation_copy', { duration: 1.0, from: 0.0, to: 1.0, afterFinish: function(){$(formElem.id+'_input_validation_copy').style.display='inline;'; }  });
		}
		//$(formElem.id+'_input_validation_copy').innerHTML='Required';
		$(formElem.id+'_form_element_label').morph('color:#F90000;', {duration: 0.5});
		$(formElem.id).morph('background-color:#CCC; border:2px solid #F90000; color:#F90000;', {duration: 0.5});
		
		inputStateArray[formElem.id]='ERROR_STATE_FULL';
		
	},
	
	//
	// FORM BEHAVIOR :: THROW PARTIAL ERROR
	throwPartialError: function(formElem){
		//
		// UPDATE FORM ELEMENT UI TO REFLECT PARTIAL ERROR
		if($(formElem.id+'_input_validation_copy').style.display=='inline'){
			new Effect.Appear(formElem.id+'_input_validation_copy', { duration: 1.0, from: 1.0, to: 0.0, afterFinish: function(){$(formElem.id+'_input_validation_copy').style.display='none;'; }  });
		}
		
		$(formElem.id+'_form_element_label').morph('color:#666;', {duration: 0.5});
		$(formElem.id).morph('background-color:#CCC; border:2px solid #F90000; color:#F90000;', {duration: 0.5});		
		
		inputStateArray[formElem.id]='ERROR_STATE_PARTIAL';
	},
	
	//
	// FORM BEHAVIOR :: HIDE ERROR STATUS IN FULL (CLEAN RESET)
	hideErrorInFull: function(formElem){
		//
		// UPDATE FORM ELEMENT UI TO REFLECT NO ERRORS
		if($(formElem.id+'_input_validation_copy')){
		//alert('updating Required copy if style display=inline');
		//if($(formElem.id+'_input_validation_copy').style.display=='inline'){
		//	new Effect.Appear(formElem.id+'_input_validation_copy', { duration: 1.0, from: 1.0, to: 0.0, afterFinish: function(){$(formElem.id+'_input_validation_copy').style.display='none;'; }  });
		//}
		$(formElem.id+'_input_validation_copy').morph('display:none;', {duration: 0.5});
		$(formElem.id+'_form_element_label').morph('color:#666;', {duration: 0.5});
		$(formElem.id).morph('background-color:#464646; border:2px solid #CCC; color:#EBEBEB;', {duration: 0.5});		
		}
		inputStateArray[formElem.id]='ERROR_STATE_CLEAR';
		
	},
	
	//
	// FORM BEHAVIOR :: HIDE ERROR STATUS IN FULL (CLEAN RESET)
	hideErrorInFullAdmin: function(formElem){
		//
		// UPDATE FORM ELEMENT UI TO REFLECT NO ERRORS
		if($(formElem.id+'_input_validation_copy')){
		//alert('updating Required copy if style display=inline');
		//if($(formElem.id+'_input_validation_copy').style.display=='inline'){
		//	new Effect.Appear(formElem.id+'_input_validation_copy', { duration: 1.0, from: 1.0, to: 0.0, afterFinish: function(){$(formElem.id+'_input_validation_copy').style.display='none;'; }  });
		//}
		$(formElem.id+'_input_validation_copy').innerHTML='';
		$(formElem.id+'_form_element_label').morph('color:#666;', {duration: 0.5});
		$(formElem.id).morph('background-color:#464646; border:2px solid #CCC; color:#EBEBEB;', {duration: 0.5});		
		}
		inputStateArray[formElem.id]='ERROR_STATE_CLEAR';
		
	},
	
	//
	// FORM BEHAVIOR :: HIDE ERROR STATUS PARTIALLY
	hideErrorPartially: function(formElem){
		//
		// UPDATE FORM ELEMENT UI TO REFLECT PARTIAL ERROR
		if($(formElem.id+'_input_validation_copy').style.display!='none;'){
			new Effect.Appear(formElem.id+'_input_validation_copy', { duration: 1.0, from: 1.0, to: 0.0, afterFinish: function(){$(formElem.id+'_input_validation_copy').style.display='none;'; }  });
		}
		$(formElem.id+'_form_element_label').morph('color:#666;', {duration: 0.5});
		$(formElem.id).morph('background-color:#CCC; border:2px solid #F90000; color:#F90000;', {duration: 0.5});
		
		inputStateArray[formElem.id]='ERROR_STATE_PARTIAL';
	},
	
	//
	// FORM BEHAVIOR :: FULL VALIDATION
	validateForm: function(formID){
		if(formID=='search'){
		return true;	
		}
		new Effect.Appear('submit_shell', { duration: 0.2, from: 1.0, to: 0.2});
		if($('note_submit_shell')){
			new Effect.Appear('note_submit_shell', { duration: 0.2, from: 1.0, to: 0.2});
		}
		if(mycrnrstn_fhandler.formLock<1 || mycrnrstn_fhandler.formLock==undefined || mycrnrstn_fhandler.formLock=='0'){
			
			mycrnrstn_fhandler.formLock=1;
			mycrnrstn_fhandler.errorsFound='';
			var element_textareas = $(formID).getElementsByTagName('textarea');
			var elements = $(formID).getElementsByTagName('input');
			
			//
			// CHECK <INPUT>
			for (var i = 0; element = elements[i]; i++) {
				
				if($(element.id)){
				if($(element.id).getAttribute('crnrstn_frm_valtype')!='' && $(element.id).getAttribute('crnrstn_frm_valtype') != undefined){
					//alert('found element and validating...->'+element.id);
					mycrnrstn_fhandler.validateMe($(element.id),'ONSUBMIT');
				}
				}
			}
			
			//
			// CHECK <TEXTAREA>
			for (var i = 0; element_textarea = element_textareas[i]; i++) {
				if($(element_textarea.id)){
				if($(element_textarea.id).getAttribute('crnrstn_frm_valtype')!='' && $(element_textarea.id).getAttribute('crnrstn_frm_valtype') != undefined){
					//alert('found element and validating...->'+element_textarea.id);
					mycrnrstn_fhandler.validateMe($(element_textarea.id),'ONBLUR');
				}
				}
				
			}
		
			//
			// SEND FORM ID TO SERVER FOR SERVER-SIDE DESIGNATIONS OF SUBMITTED DATA.
			if(!$('postid')){
				var formIdDesignator = document.createElement("input");
				formIdDesignator.setAttribute('id','postid');
				formIdDesignator.setAttribute('name','postid');
				formIdDesignator.setAttribute('type','hidden');
				formIdDesignator.setAttribute('value', formID);
				$(formID).appendChild(formIdDesignator);
			}
			
			if($('fname')){
			if($('fname').value!=''){
				var tmpmsg = $('fname').value+', are you sure you want to deactivate this account?';
			}else{
				var tmpmsg = 'Are you sure you want to deactivate this account?';
			}
			}
		
			if($('account_deactivate_chk')){
				if($('account_deactivate_chk').checked){
					var confirmDeactivate = confirm (tmpmsg);
					//
					// ABORT IF NOT CONFIRMED
					if (!(confirmDeactivate)){
						return false;	
					}
				}
			}
			
			//
			// IF SUCCESS, SUBMIT FORM.
			if (mycrnrstn_fhandler.errorsFound==''){
				return true;		// OK TO SUBMIT FORM
			}else{
				mycrnrstn_fhandler.errorsFound='';
				mycrnrstn_fhandler.formLock=0;
				new Effect.Appear('submit_shell', { duration: 0.2, from: 0.2, to: 1.0});
				if($('note_submit_shell')){
				new Effect.Appear('note_submit_shell', { duration: 0.2, from: 0.2, to: 1.0});
				}
				return false;		// FORM HAS ERRORS. DO NOT SUBMIT.
			}
		}
	},
	
	//
	// FORM BEHAVIOR :: SUBMIT FORM
	formSubmit: function(formID){
		if(mycrnrstn_fhandler.validateForm(formID)){
			$(formID).submit();
		}
	},
	
	deleteComment: function(subject, formURI, elemID){
		$('admin_overlay').style.zIndex = 10;
		$('admin_form_shell').style.zIndex = 11;
		$('admin_overlay').style.backgroundColor = '#FFF';
		new Effect.Appear('admin_overlay', { duration: 0.5, from: 0.0, to: 0.7, afterFinish: function(){
		
			var confirmCommentdelete = confirm ("Are you sure you want to DELETE the note with subject of '"+subject+"'?" );
			if (confirmCommentdelete){
				new Effect.Appear('admin_form_shell', { duration: 0.5, from: 1.0, to: 0.0, afterFinish: function(){ 
																									$('admin_form_shell').innerHTML=''; 
																									$('admin_form_shell').style.zIndex = -1; 
																								}});
				new Effect.Appear('admin_overlay', { duration: 0.5, from: 0.5, to: 0.0, afterFinish: function(){ $('admin_overlay').style.zIndex = -1;  }  });

				mycrnrstn_fhandler.elementid = elemID;
				var params = '';
				var myAjax = new Ajax.Request(
				formURI, 
				{
					method: 'get', 
					parameters: params, 
					onComplete: mycrnrstn_fhandler.parseDelCommentResp
				});				
				
			}else{
				new Effect.Appear('admin_form_shell', { duration: 0.5, from: 1.0, to: 0.0, afterFinish: function(){ 
																									$('admin_form_shell').innerHTML=''; 
																									$('admin_form_shell').style.zIndex = -1; 
																								}});
				new Effect.Appear('admin_overlay', { duration: 0.5, from: 0.5, to: 0.0, afterFinish: function(){ $('admin_overlay').style.zIndex = -1;  }  });
				
				
			}									  
		}});
		
	},
	
	parseDelCommentResp: function(formRequest){
		var resp = formRequest.responseText;
		//alert(resp);
		switch(resp){
			case 'usercommentdelete=false_login':
				//
				// SCROLL TO TOP
				new Effect.ScrollTo('admin_form_shell',{offset: 0, afterFinish: function(){ 
																					
				//
				// DISPLAY STATUS MESSAGE
				$("user_transaction_wrapper").innerHTML = '<div class="user_transaction_content"><div id="user_transaction_status_msg" class="user_transaction_error">Error :: Oops...you must be logged in to make updates to your notes.<br>Please log in and try again.</div></div>';
				toggleTransactionWrapperOpen();	
					 }  });
				
			break;
			case 'usercommentdelete=true':
				//
				// SCROLL TO TOP
				new Effect.ScrollTo('admin_form_shell',{offset: 0, afterFinish: function(){ 
																					
				//
				// HIDE ELEMENT IF NO ERR
				new Effect.toggle(mycrnrstn_fhandler.elementid, 'slide', {afterFinish: function(){
																							   
				//
				// DISPLAY STATUS MESSAGE
				$("user_transaction_wrapper").innerHTML = '<div class="user_transaction_content"><div id="user_transaction_status_msg" class="user_transaction_success">Success :: Your note on the selected <span class="user_transaction_bg_xmas_clear">C<span class="the_R">R</span>NRSTN</span> content<br>has been deleted.</div></div>';
				toggleTransactionWrapperOpen();	
								}  });
					 }  });
			break;
			case 'usercommentdelete=false':
				//
				// SCROLL TO TOP
				new Effect.ScrollTo('admin_form_shell',{offset: 0, afterFinish: function(){ 
																					
				//
				// DISPLAY STATUS MESSAGE
				$("user_transaction_wrapper").innerHTML = '<div class="user_transaction_content"><div id="user_transaction_status_msg" class="user_transaction_error">Error :: Oops...there was an error processing the update to your note.<br>Please try again later.</div></div>';
				toggleTransactionWrapperOpen();	
				
					 }  });
			break;
			case 'usercommentdelete=falseall':
				//
				// SCROLL TO TOP
				new Effect.ScrollTo('admin_form_shell',{offset: 0, afterFinish: function(){ 
																					
				//
				// DISPLAY STATUS MESSAGE
				$("user_transaction_wrapper").innerHTML = '<div class="user_transaction_content"><div id="user_transaction_status_msg" class="user_transaction_error">Error :: Oops...there was an error processing the update to your note.<br>Please try again later.<br>No changes were able to be made.</div></div>';
				toggleTransactionWrapperOpen();	
					 }  });				
			break;
			
		}
	},
	
	//
	// ADMIN :: LOAD CONTENT MGMT FORM
	initAdminForm: function(formID, linkName, formUri){
		
		//
		// LIGHTBOX ON
		mycrnrstn_fhandler.initLightbox(formID,linkName,formUri);

		mycrnrstn_fhandler.formX=375;
		mycrnrstn_fhandler.formY='';
		//
		// SCROLL TO POSITION ON FORM OVERLAY
		switch(linkName){
			case "edit_description":
				mycrnrstn_fhandler.formY=330;
				new Effect.Move($('admin_form_shell'), { x: mycrnrstn_fhandler.formX, y: mycrnrstn_fhandler.formY, duration: 0.0, afterFinish: function(){$('admin_form_shell').innerHTML = $('admin_frm_loading_shell').innerHTML;}});
 			break;
			case 'method_paramdefs':
			case "new_function":
			case "edit_example":
			case "edit_techspec":
				mycrnrstn_fhandler.formY=160;
				new Effect.Move($('admin_form_shell'), { x: mycrnrstn_fhandler.formX, y: mycrnrstn_fhandler.formY, duration: 0.0, afterFinish: function(){$('admin_form_shell').innerHTML = $('admin_frm_loading_shell').innerHTML;}});
			break;
			case "edit_profile":
				mycrnrstn_fhandler.formY=190;
				new Effect.Move($('admin_form_shell'), { x: mycrnrstn_fhandler.formX, y: mycrnrstn_fhandler.formY, duration: 0.0, afterFinish: function(){$('admin_form_shell').innerHTML = $('admin_frm_loading_shell').innerHTML;}});
			break;
			case "edit_currversion":
				mycrnrstn_fhandler.formY=630;
				new Effect.Move($('admin_form_shell'), { x: mycrnrstn_fhandler.formX, y: mycrnrstn_fhandler.formY, duration: 0.0, afterFinish: function(){$('admin_form_shell').innerHTML = $('admin_frm_loading_shell').innerHTML;}});
			break;
			case "delete_method":
			case "order_method":
			case "new_method":
				mycrnrstn_fhandler.formY=800;
				new Effect.Move($('admin_form_shell'), { x: mycrnrstn_fhandler.formX, y: mycrnrstn_fhandler.formY, duration: 0.0, afterFinish: function(){$('admin_form_shell').innerHTML = $('admin_frm_loading_shell').innerHTML;}});
			break;
			case "new_class":
				mycrnrstn_fhandler.formY=250;
				new Effect.Move($('admin_form_shell'), { x: mycrnrstn_fhandler.formX, y: mycrnrstn_fhandler.formY, duration: 0.0, afterFinish: function(){$('admin_form_shell').innerHTML = $('admin_frm_loading_shell').innerHTML;}});
			break;
			case "edit_settings":
				mycrnrstn_fhandler.formY=160;
				mycrnrstn_fhandler.formX = 420;
				new Effect.Move($('admin_form_shell'), { x: mycrnrstn_fhandler.formX, y: mycrnrstn_fhandler.formY, duration: 0.0, afterFinish: function(){
																																						}});
			break;
			case "view_feedback":
				mycrnrstn_fhandler.formY=190;
				mycrnrstn_fhandler.formX = 100;
				new Effect.Move($('admin_form_shell'), { x: mycrnrstn_fhandler.formX, y: mycrnrstn_fhandler.formY, duration: 0.0, afterFinish: function(){$('admin_form_shell').innerHTML = $('admin_frm_loading_shell').innerHTML;}});
				
			break;
			case "view_comment":
			case "edit_comment":
				mycrnrstn_fhandler.formY=190;
				mycrnrstn_fhandler.formX = 250;
				new Effect.Move($('admin_form_shell'), { x: mycrnrstn_fhandler.formX, y: mycrnrstn_fhandler.formY, duration: 0.0, afterFinish: function(){$('admin_form_shell').innerHTML = $('admin_frm_loading_shell').innerHTML;}});
				
			break;
			
		}
	},
	
	toggleLike: function(NOTEID_SOURCE,USERNAME,CLASSID,METHODID,STATE){
		if($("note_"+NOTEID_SOURCE+"_like").innerHTML=="like"){
			//
			// MAKE USER LIKE CONTENT
			//alert("Make "+USERNAME+" like this: "+NOTEID_SOURCE);
			
			var query = window.location.href; 
			var vars = query.split("/"); 
			var HTTP_ROOT = vars[0]+'//'+vars[2]+'/';
			var params = 'nid=' + NOTEID_SOURCE + '&un='+USERNAME + '&cid='+CLASSID+ '&mid='+METHODID+ '&state='+STATE;
			var uri = HTTP_ROOT + 'crnrstn/account/comment/like/';
			
			if($(insertstatus_ElemId).value==''){
						
				//
				// FIRE AJAX COMMENT INSERTION STATUS :: WEB SERVICES REQUEST
				var myAjax = new Ajax.Request(
				uri, 
				{
					method: 'get', 
					parameters: params, 
					onComplete: this.toggleDone
				});
	
			}
			
			$("note_"+NOTEID_SOURCE+"_like").innerHTML="unlike";
		}else{
			//
			// MAKE USER UNLIKE CONTENT
			//alert("Make "+USERNAME+" UNlike this: "+NOTEID_SOURCE);
			var query = window.location.href; 
			var vars = query.split("/"); 
			var HTTP_ROOT = vars[0]+'//'+vars[2]+'/';
			var params = 'nid=' + NOTEID_SOURCE + '&un='+USERNAME + '&cid='+CLASSID+ '&mid='+METHODID+ '&state='+STATE;
			var uri = HTTP_ROOT + 'crnrstn/account/comment/like/';
			
			if($(insertstatus_ElemId).value==''){
						
				//
				// FIRE AJAX COMMENT INSERTION STATUS :: WEB SERVICES REQUEST
				var myAjax = new Ajax.Request(
				uri, 
				{
					method: 'get', 
					parameters: params, 
					onComplete: this.toggleDone
				});
	
			}
			
			$("note_"+NOTEID_SOURCE+"_like").innerHTML="like";
		}
	
	},
	
	toggleDone: function(){
		
		
		//alert("done!");	
	},
		
	//
	// FORM LIGHTBOX
	initLightbox: function(formID, linkName, formUri){
		var query = window.location.href; 
		var vars = query.split("/"); 
		var HTTP_ROOT = vars[0]+'//'+vars[2]+'/';
		$('admin_overlay').style.zIndex = 10;
		$('admin_form_shell').style.zIndex = 11;
		
		$('admin_overlay').style.backgroundColor = '#FFF';
		$('frm_loading_wrapper').style.left = '120px';
		$('frm_loading_wrapper').style.top = '120px';
		$('frm_loading_wrapper').innerHTML = '<div id="admin_frm_loading_logo"><img src="'+HTTP_ROOT+'crnrstn/common/imgs/logo_tiny_128.gif" width="85" height="47" alt="CRNRSTN ::" title="CRNRSTN ::"></div><div id="admin_frm_loading"><img src="'+HTTP_ROOT+'crnrstn/common/imgs/long_loader.gif" width="220" height="19" alt="CRNRSTN :: LOADING..." title="CRNRSTN :: LOADING..."></div><div class="cb"></div>';
		
		new Effect.Appear('admin_overlay', { duration: 0.5, from: 0.0, to: 0.7, afterFinish: function(){ 
										new Effect.ScrollTo('admin_form_shell',{offset: -40}); 
										
										//
										// LOAD FORM
										mycrnrstn_fhandler.loadForm('admin_form_shell', formID, linkName, formUri);
										
										}  });
		
	},
	
	loadForm: function(formShellID, formID, formName, formUri){
		new Effect.Appear('admin_form_shell', { duration: 1.0, from: 0.0, to: 1.0, afterFinish: function(){ /* NEED TO DO ANYTHING?*/  }  });
		var div_ID = 'content_'+formID+'_page';
		var div_CLASS = 'adminForm';
		var ni = $('admin_form_shell');

//		if(formName=='view_comment'){
//			var newdiv = document.createElement('iframe');
//			newdiv.setAttribute('id',div_ID);
//			newdiv.setAttribute('class',div_CLASS);
//			newdiv.setAttribute('src', formUri);
//			newdiv.setAttribute('width', '670');
//			newdiv.setAttribute('height', '540');
//			newdiv.setAttribute('frameborder', '0');
//			
//			ni.appendChild(newdiv);
//		}else{
			
			var newdiv = document.createElement('div');
			newdiv.setAttribute('id',div_ID);
			newdiv.setAttribute('class',div_CLASS);
			newdiv.innerHTML = "";
		
			ni.appendChild(newdiv);
			var url = formUri;
			var params = '';
			var ajax = new Ajax.Updater( 
			{success: div_ID},
			url,
			{method: 'get', parameters: params, onFailure: mycrnrstn_fhandler.reportError, onSuccess: mycrnrstn_fhandler.clearLoader});
		//}
	
	},
	
	clearLoader: function(formID){
		//$('admin_frm_loading').
		new Effect.Appear('frm_loading_wrapper', { duration: 2.0, from: 1.0, to: 0.0, afterFinish: function(){ $('frm_loading_wrapper').style.zIndex = -1;  }  });
		//alert('clearing loader and initializing form...->'+formID);
		//initformHandler();
		
	},
	
	abandonForm: function(){
		new Effect.Appear('admin_form_shell', { duration: 0.5, from: 1.0, to: 0.0, afterFinish: function(){  
																									$('admin_form_shell').innerHTML=''; 
																									$('admin_form_shell').style.zIndex = -1; 
																									new Effect.Move($('admin_form_shell'), { x: (mycrnrstn_fhandler.formX*-1), y: (mycrnrstn_fhandler.formY*-1), duration: 0.0});
																									}});
		new Effect.Appear('admin_overlay', { duration: 0.5, from: 0.5, to: 0.0, afterFinish: function(){ $('admin_overlay').style.zIndex = -1;  }  });

	},
	
	reportError: function(request){
		alert('Error loading form.');
	},
	
	resetPwdCofirmed: function(){
		tmp_pwd = $('pwd').value;
		tmp_pwdconfirm = $('pwdconfirm').value;
		if(tmp_pwd==tmp_pwdconfirm && tmp_pwd!=""){
			//alert('I match!');
			mycrnrstn_fhandler.hideErrorInFull($("pwdconfirm"));
		}else{
			//alert('I don\'t match!');
			$('pwdconfirm_input_validation_copy').innerHTML = "Passwords do not match.";
			mycrnrstn_fhandler.throwFullError($("pwdconfirm"));
		}
		
		
		
	},
	
	

	//
	// UTILITY :: MONITOR CONTENT LENGTH
	checklen: function(formElem, upperlength, statusElement){
		upperlength=parseInt(upperlength);
		if(formElem.value.length>upperlength){
			alert("Please limit your message to "+upperlength+" characters.");
			if(mymessage!='' || mymessage!=undefined){
				formElem.value=mymessage;
			}
		}else{
			mymessage=formElem.value;
		}
		remaining = parseInt(upperlength) - parseInt(formElem.value.length);
		if(remaining>30){
			$(statusElement).innerHTML = remaining + ' characters remaining.';
		}else{
			$(statusElement).innerHTML = '<span class="the_R" style="font-weight:bold;">'+ remaining + '</span> characters remaining.';
		}
	},
	
	validateAsset: function (asseType,assetLocation){
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
					return true;
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
					document.getElementById('validPDFfilenotice').innerHTML="<div style='font-size:12px; font-weight:bold; color:#CC0000;'>Documents can only be uploaded if they<br />are of the PDF document type: <b>[.pdf]</b>.</div>";			
				}else{
					document.getElementById('validPDFfilenotice').innerHTML="Documents can only be uploaded if they<br />are of the PDF document type: <b>[.pdf]</b>.";
					return true;
				}
			break;
		}
	
		return assetValid;
	},
	
	//
	// UTILITY :: REQUIRED (NO MINIMUM)
	validReqField: function(formElem) {
		if (!formElem.value.length) {
			return false;
		}
		return true;
	},
	
	//
	// UTILITY :: VALID PASSWORD
	validPwdField: function(formElem){
		if (!formElem.value.length || formElem.value.length<7) {
			return false;
		}
		return true;
	},
		
	//
	// UTILITY :: VALID USERNAME
	validUsername: function(formElem) {
		var illegalChars= /[\(\)\<\>\?\#\%\^\&\}\{\!\|\*\~\`\'\ \@\-\.\$\+\=\,\[\]\;\:\\\/\"\[\]]/
		if (formElem.value.match(illegalChars) || formElem.value.length<5) {
			if(formElem.value.length<5){
				$('un_input_validation_copy').innerHTML = 'Invalid username. 5 char min.';
			}else{
				$('un_input_validation_copy').innerHTML = 'Invalid character(s) in username.';
			}
			return false;
		}
		
		return true;
	},
	
	validUsername_AJAX: function(formElem) {
		var illegalChars= /[\(\)\<\>\?\#\%\^\&\}\{\!\|\*\~\`\'\ \@\-\.\$\+\=\,\[\]\;\:\\\/\"\[\]]/
		if (formElem.value.match(illegalChars) || formElem.value.length<5) {
			if(formElem.value.length<5){
				$('un_input_validation_copy').innerHTML = 'Invalid username. 5 char min.';
			}else{
				$('un_input_validation_copy').innerHTML = 'Invalid character(s) in username.';
			}
			return false;
		}else{
			mycrnrstn_fhandler.validUsernameUnique(formElem);
		}
		
		return true;
	},
	
	//
	// UTILITY :: VALID USERNAME UNIQUE
	validUsernameUnique: function(formElem) {
		//
		// PERFORM AJAX REQUEST TO VALIDATE UNIQUENESS OF USERNAME
		var params='un=' + formElem.value;
		var query = window.location.href; 
		var vars = query.split("/"); 
		var HTTP_ROOT = vars[0]+'//'+vars[2]+'/';
		var uri = HTTP_ROOT + 'crnrstn/account/create/ununique/';
		
		var myAjax = new Ajax.Request(
		uri, 
		{
			method: 'get', 
			parameters: params, 
			onComplete: mycrnrstn_fhandler.parseUsernameChkResp
		});
	},
	
	parseUsernameChkResp: function(formRequest){
		var resp = formRequest.responseText;
		if(resp=='SUCCESS'){
			//
			// CLEAR ERROR_STATE_PARTIAL
			mycrnrstn_fhandler.hideErrorInFull($('un'));

		}else{
			//
			// THROW ERROR_STATE_FULL
			var resp_var = resp.split("ERROR");
			$('un_input_validation_copy').innerHTML = resp_var[1];
			
			mycrnrstn_fhandler.errorsFound='ERR_FOUND';
			mycrnrstn_fhandler.throwFullError($('un'));
			
		}
	},
	
	
	//
	// UTILITY :: VALID EMAIL
	validEmail: function(formElem) {
		var emailFilter=/^.+@.+\..{2,5}$/;
		var illegalChars= /[\(\)\<\>\,\;\:\\\/\"\[\]]/
		if ((!(emailFilter.test(formElem.value))) || (formElem.value.match(illegalChars))) {
			return false;
		}
		return true;
	},
	
	//
	// UTILITY :: VALID URL
	validURL: function(formElem) {
		var regexp = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/
		return regexp.test(formElem.value);
	},
	
	//
	// UTILITY :: VALID PLAIN TEXT
	validPlainText: function(formElem) {
		var illegalChars= /[\(\)\<\>\?\#\%\^\&\*\~\`\,\[\]\;\:\\\/\"\[\]]/
		if (formElem.value.match(illegalChars)) {
			return false;
		}
		return true;
	},
	
	//
	// UTILITY :: VALID UGC COMMENT
	validComment: function(formElem) {
		if(formElem.value.length<1){
			$(formElem.id+"_input_validation_copy").innerHTML = "Required";
			
			return false;	
		}
		
		if(formElem.value.length>(1*($(formElem.id+"_max_char_cnt").innerHTML))){
			$(formElem.id+"_input_validation_copy").innerHTML = "Please limit your note to "+$(formElem.id+"_max_char_cnt").innerHTML+" characters.";
			return false;	
		}
		
		return true;
	}
}

//
// EXAMPLE PREVIEW LOADER
function previewExample(currTitle,currDescription,currExample){
	if($('example_preview_content')){
		//
		// COPY CURRENT EXAMPLE CODE TO PREVIEW FORM AND SEND TO PREVIEW
		$('example_preview_title').value = $(currTitle).value;
		$('example_preview_description').value = $(currDescription).value;
		$('example_preview_content').value = $(currExample).value;
		$('preview_example').submit();
	}
}


function initformHandler() { mycrnrstn_fhandler = new crnrstn_fhandler(); }
Event.observe(window, 'load', initformHandler, false);

