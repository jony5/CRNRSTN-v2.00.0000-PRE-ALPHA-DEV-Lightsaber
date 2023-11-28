/* 
// J5
// Code is Poetry */

function validateForm(form_id){
	var validForm = true;
	
	switch(form_id){
		case 'wethrbug_forecastRequest':
			//cityState

			var cityState = $('input#autocomplete-input').val();
			var zipcode = $('input#zipcode').val();

			if(cityState.length<1 && zipcode.length<1){
				$("div.one_required_invalid").show();
				$('#zipcode_star').show();
				$('#cityState_star').show();
				$( "div.zipcode_invalid" ).hide();

				validForm = false;

			}else{

				if(zipcode.length>0 && !validZip(zipcode)){

					$( "div.zipcode_invalid" ).show();
					$("div.one_required_invalid").hide();
					$('#zipcode_star').hide();
					$('#cityState_star').hide();
					validForm = false;

				}else{

					if(!(zipcode.length>0) && cityState.length<1){

						$("div.one_required_invalid").show();
						$('#zipcode_star').show();
						$('#cityState_star').show();
						$( "div.zipcode_invalid" ).hide();

						validForm = false;

					}
				}

			}

		break;
		case 'content_publish_proxy':
			//
			// DO WE NEED TO PERFORM ANY CHECKS ON THE HIDDEN FORM DATA?
			// NO UGC HERE.

		break;
		case 'language_translation_user_submit_capture':
			if($("textarea#translation_copy").val()==""){
				$( "div.translation_copy_req" ).show();
				$( "div.translation_copy_invalid" ).hide();
				validForm = false;
			}else{
				$( "div.translation_copy_req" ).hide();

			}

		break;
		case 'insert_subtitle_element':

			$('input#component_type_key').val('SUB_TITLE');
			tmp_action_type = $('input#action_type').val();

			switch(tmp_action_type) {
				case 'edit_subtitle':
				case 'new_subtitle':

					if ($("textarea#subtitle_copy").val() == "") {

						$("#oops_processComponentMod_saveSubtitle").html('I do not see your subtitle text.');
						$("div.oops_processComponentMod_saveSubtitle_req").show();
						$("div.oops_processComponentMod_saveSubtitle_invalid").hide();
						validForm = false;
					}

					if (validForm) {
						$("div.oops_processComponentMod_saveSubtitle_req").hide();

					}

				break;
			}


		break;
		case 'insert_paragraph_element':

			$('input#component_type_key').val('PARAGRAPH');
			tmp_action_type = $('input#action_type').val();

			switch(tmp_action_type) {
				case 'edit_paragraph':
				case 'new_paragraph':

					if ($("textarea#paragraph_copy").val() == "") {

						$("#oops_processComponentMod_savePara").html('I do not see your paragraph text.');
						$("div.oops_processComponentMod_savePara_req").show();
						$("div.oops_processComponentMod_savePara_invalid").hide();
						validForm = false;
					}

					if (validForm) {
						$("div.oops_processComponentMod_savePara_req").hide();

					}

					break;
			}


		break;
		case 'sys_add_new_user_type':

			if($("input#user_permissions_id").val()==""){
				$( "div.user_permissions_id_req" ).show();
				$( "div.user_permissions_id_invalid" ).hide();
				validForm = false;
			}else{
				$( "div.user_permissions_id_req" ).hide();

				if($.isNumeric($("input#user_permissions_id").val())){
					$( "div.user_permissions_id_invalid" ).hide();
				}else{
					$( "div.user_permissions_id_invalid" ).show();
					validForm = false;
				}
			}

			if($("input#type_name").val()==""){
				$( "div.type_name_req" ).show();
				$( "div.type_name_invalid" ).hide();
				validForm = false;
			}else{
				$( "div.type_name_req" ).hide();

				if(validElemName($("input#type_name").val())){
					$( "div.type_name_invalid" ).hide();
				}else{
					$( "div.type_name_invalid" ).show();
					validForm = false;
				}
			}

			if($("textarea#description").val()==""){
				$( "div.description_req" ).show();
				$( "div.description_invalid" ).hide();
				validForm = false;
			}else{
				$( "div.description_req" ).hide();

			}


		break;
		case 'sys_add_new_component':
			if($("input#component_name").val()==""){
				$( "div.component_name_req" ).show();
				$( "div.component_name_invalid" ).hide();
				validForm = false;
			}else{
				$( "div.component_name_req" ).hide();

				if(validElemName($("input#component_name").val())){
					$( "div.component_name_invalid" ).hide();
				}else{
					$( "div.component_name_invalid" ).show();
					validForm = false;
				}
			}

			if($("textarea#component_description").val()==""){
				$( "div.component_description_req" ).show();
				$( "div.component_description_invalid" ).hide();
				validForm = false;
			}else{
				$( "div.component_description_req" ).hide();

			}

			if($("input#component_key").val()==""){
				$( "div.component_key_req" ).show();
				$( "div.component_key_invalid" ).hide();
				validForm = false;
			}else{
				$( "div.component_key_req" ).hide();

				if(validElemName($("input#component_key").val())){
					$( "div.component_key_invalid" ).hide();
				}else{
					$( "div.component_key_invalid" ).show();
					validForm = false;
				}
			}

			if($("input#component_uri_new").val()==""){
				$( "div.component_uri_new_req" ).show();
				$( "div.component_uri_new_invalid" ).hide();
				validForm = false;
			}else{
				$( "div.component_uri_new_req" ).hide();
			}

		break;
		case 'insert_bullet_element':

			$('input#component_type_key').val('BULLET_LIST');
			tmp_action_type = $('input#action_type').val();

			switch(tmp_action_type) {
				case 'new_bullet_point':

					if ($("textarea#bullet_description").val() == "") {

						$("#oops_processComponentMod_saveBullet").html('I do not see your bullet point text.');
						$("div.oops_processComponentMod_saveBullet_req").show();
						$("div.oops_processComponentMod_saveBullet_invalid").hide();
						validForm = false;
					}

					if (validForm) {
						$("div.oops_processComponentMod_saveBullet_req").hide();

					}

				break;
			}


		break;
		case 'insert_schedule_element':

			tmp_action_type = $('input#action_type').val();
			$('input#component_type_key').val('SCHEDULE');

			switch(tmp_action_type){
				case 'update_schedule_time_format':
					if($("select#select_choice_time_format").val()==""){
						$("#oops_processComponentMod_timeform").html('I cannot find time format data.');
						$( "div.oops_processComponentMod_timeform_req" ).show();
						$( "div.oops_processComponentMod_timeform_invalid" ).hide();
						validForm = false;
					}
				break;
				case 'update_schedule_date_format':

					if($("select#select_choice_date_format").val()==""){
						$("#oops_processComponentMod_dateform").html('I cannot find date format data.');
						$( "div.oops_processComponentMod_dateform_req" ).show();
						$( "div.oops_processComponentMod_dateform_invalid" ).hide();
						validForm = false;
					}

				break;
				case 'edit_schedule_day':
					if($("input#schedule_date_day").val()==""){
						$("#oops_processComponentMod").html('I cannot find day data.');
						$( "div.oops_processComponentMod_req" ).show();
						$( "div.oops_processComponentMod_invalid" ).hide();
						validForm = false;
					}else{
						//$( "div.oops_processComponentMod_req" ).hide();
						//$("#oops_processComponentMod").empty();

						//if(validColorHex($("input#color_hex").val())){
						//	$( "div.oops_processComponentMod_invalid" ).hide();
						//}else{
						//	$( "div.oops_processComponentMod_invalid" ).show();
						//	validForm = false;
						//}
					}

					if($("input#schedule_date_month").val()==""){
						$("#oops_processComponentMod").html('I cannot find month data.');
						$( "div.oops_processComponentMod_req" ).show();
						$( "div.oops_processComponentMod_invalid" ).hide();
						validForm = false;
					}else{
						//$( "div.oops_processComponentMod_req" ).hide();
						//$("#oops_processComponentMod").empty();

						//if(validColorHex($("input#color_hex").val())){
						//	$( "div.oops_processComponentMod_invalid" ).hide();
						//}else{
						//	$( "div.oops_processComponentMod_invalid" ).show();
						//	validForm = false;
						//}
					}


					if($("input#schedule_date_year").val()==""){
						$("#oops_processComponentMod").html('I cannot find year data.');
						$( "div.oops_processComponentMod_req" ).show();
						$( "div.oops_processComponentMod_invalid" ).hide();
						validForm = false;
					}else{
						//$( "div.oops_processComponentMod_req" ).hide();
						//$("#oops_processComponentMod").empty();

						//if(validColorHex($("input#color_hex").val())){
						//	$( "div.oops_processComponentMod_invalid" ).hide();
						//}else{
						//	$( "div.oops_processComponentMod_invalid" ).show();
						//	validForm = false;
						//}
					}


					if($("input#overlay_fullscrn_schedule_day_id").val()==""){
						$("#oops_processComponentMod").html('I cannot find the primary key data for this day. Please refresh the page and try again.');
						$( "div.oops_processComponentMod_req" ).show();
						$( "div.oops_processComponentMod_invalid" ).hide();
						validForm = false;
					}else{
						//$( "div.oops_processComponentMod_req" ).hide();
						//$("#oops_processComponentMod").empty();

						//if(validColorHex($("input#color_hex").val())){
						//	$( "div.oops_processComponentMod_invalid" ).hide();
						//}else{
						//	$( "div.oops_processComponentMod_invalid" ).show();
						//	validForm = false;
						//}
					}

					if(validForm){
						$( "div.oops_processComponentMod_req" ).hide();
						$("#oops_processComponentMod").empty();

					}

					break;
				case 'new_schedule_day':
					if($("input#schedule_date_day").val()==""){
						$("#oops_processComponentMod").html('I cannot find day data.');
						$( "div.oops_processComponentMod_req" ).show();
						$( "div.oops_processComponentMod_invalid" ).hide();
						validForm = false;
					}else{
						//$( "div.oops_processComponentMod_req" ).hide();
						//$("#oops_processComponentMod").empty();

						//if(validColorHex($("input#color_hex").val())){
						//	$( "div.oops_processComponentMod_invalid" ).hide();
						//}else{
						//	$( "div.oops_processComponentMod_invalid" ).show();
						//	validForm = false;
						//}
					}

					if($("input#schedule_date_month").val()==""){
						$("#oops_processComponentMod").html('I cannot find month data.');
						$( "div.oops_processComponentMod_req" ).show();
						$( "div.oops_processComponentMod_invalid" ).hide();
						validForm = false;
					}else{
						//$( "div.oops_processComponentMod_req" ).hide();
						//$("#oops_processComponentMod").empty();

						//if(validColorHex($("input#color_hex").val())){
						//	$( "div.oops_processComponentMod_invalid" ).hide();
						//}else{
						//	$( "div.oops_processComponentMod_invalid" ).show();
						//	validForm = false;
						//}
					}


					if($("input#schedule_date_year").val()==""){
						$("#oops_processComponentMod").html('I cannot find year data.');
						$( "div.oops_processComponentMod_req" ).show();
						$( "div.oops_processComponentMod_invalid" ).hide();
						validForm = false;
					}else{
						//$( "div.oops_processComponentMod_req" ).hide();
						//$("#oops_processComponentMod").empty();

						//if(validColorHex($("input#color_hex").val())){
						//	$( "div.oops_processComponentMod_invalid" ).hide();
						//}else{
						//	$( "div.oops_processComponentMod_invalid" ).show();
						//	validForm = false;
						//}
					}


					if(validForm){
						$( "div.oops_processComponentMod_req" ).hide();
						$("#oops_processComponentMod").empty();

					}

				break;
				case 'new_schedule_event':

					if($("input#slider_hour").val()==""){
						$("#oops_processComponentMod_saveEvent").html('I cannot find hour data.');
						$( "div.oops_processComponentMod_saveEvent_req" ).show();
						$( "div.oops_processComponentMod_saveEvent_invalid" ).hide();
						validForm = false;
					}else{
						//$( "div.oops_processComponentMod_saveEvent_req" ).hide();
						//$("#oops_processComponentMod_saveEvent").empty();

						//if(validColorHex($("input#color_hex").val())){
						//	$( "div.oops_processComponentMod_invalid" ).hide();
						//}else{
						//	$( "div.oops_processComponentMod_invalid" ).show();
						//	validForm = false;
						//}
					}

					if($("input#slider_minute").val()==""){

						$("#oops_processComponentMod_saveEvent").html('I cannot find minute data.');
						$( "div.oops_processComponentMod_saveEvent_req" ).show();
						$( "div.oops_processComponentMod_saveEvent_invalid" ).hide();
						validForm = false;
					}else{
						//$( "div.oops_processComponentMod_saveEvent_req" ).hide();
						//$("#oops_processComponentMod_saveEvent").empty();

					}

					if($("textarea#event_description").val()==""){

						$("#oops_processComponentMod_saveEvent").html('I cannot find event description data.');
						$( "div.oops_processComponentMod_saveEvent_req" ).show();
						$( "div.oops_processComponentMod_saveEvent_invalid" ).hide();
						validForm = false;
					}else{

						//$("#oops_processComponentMod_saveEvent").empty();

					}

					if(validForm){
						$( "div.oops_processComponentMod_saveEvent_req" ).hide();

					}

				break;

			}


		break;
		case 'sys_add_new_color':
			if($("input#color_hex").val()==""){
				$( "div.color_hex_req" ).show();
				$( "div.color_hex_invalid" ).hide();
				validForm = false;
			}else{
				$( "div.color_hex_req" ).hide();

				if(validColorHex($("input#color_hex").val())){
					$( "div.color_hex_invalid" ).hide();
				}else{
					$( "div.color_hex_invalid" ).show();
					validForm = false;
				}
			}

			if($("input#color_name").val()==""){
				$( "div.color_name_req" ).show();
				$( "div.color_name_invalid" ).hide();
				validForm = false;
			}else{
				$( "div.color_name_req" ).hide();

				if(validElemName($("input#color_name").val())){
					$( "div.color_name_invalid" ).hide();
				}else{
					$( "div.color_name_invalid" ).show();
					validForm = false;
				}
			}

		break;
		case 'new_page_title':
			if($("textarea#title_copy").val()==""){
				$( "div.title_copy_req" ).show();
				$( "div.title_copy_invalid" ).hide();
				validForm = false;
			}else{
				$( "div.title_copy_req" ).hide();

			}

		break;
		case 'new_page_header':
			if($("textarea#header_copy").val()==""){
				$( "div.header_copy_req" ).show();
				$( "div.header_copy_invalid" ).hide();
				validForm = false;
			}else{
				$( "div.header_copy_req" ).hide();

			}

		break;
		case 'create_fullscrn_overlay_page':
			if($("input#page_name").val()==""){
				$( "div.page_name_req" ).show();
				$( "div.page_name_invalid" ).hide();
				validForm = false;
			}else{
				$( "div.page_name_req" ).hide();

				if(validElemName($("input#page_name").val())){
					$( "div.page_name_invalid" ).hide();
				}else{
					$( "div.page_name_invalid" ).show();
					validForm = false;
				}
			}
		break;
		case 'create_fullscrn_overlay':
			if($("input#fullscrn_name").val()==""){
				$( "div.fullscrn_name_req" ).show();
				$( "div.fullscrn_name_invalid" ).hide();
				validForm = false;
			}else{
				$( "div.fullscrn_name_req" ).hide();

				if(validElemName($("input#fullscrn_name").val())){
					$( "div.fullscrn_name_invalid" ).hide();
				}else{
					$( "div.fullscrn_name_invalid" ).show();
					validForm = false;
				}
			}

		break;
		case 'accnt_activate_resend':
			if($("input#email_activate_mobile").val()==""){
				$( "div.email_req_mobile" ).show();
				$( "div.email_invalid_mobile" ).hide();
				validForm = false;
			}else{
				$( "div.email_req_mobile" ).hide();

				if(validEmail($("input#email_activate_mobile").val())){
					$( "div.email_invalid_mobile" ).hide();
				}else{
					$( "div.email_invalid_mobile" ).show();
					validForm = false;
				}
			}
		break;
		case 'create_stream':
            if($("textarea#stream").val()==""){
                $( "div.stream" ).show();
                validForm = false;
            }else{
                $( "div.stream" ).hide();
            }

			if($('#stream_file_attach:visible').length > 0){

                if($("input#assetname").val()==""){
                    $( "div.assetname" ).show();
                    validForm = false;
                }else{
                    $( "div.assetname" ).hide();
                }

                if($("input#assetfile").val()==""){
                    $( "div.assetfile" ).show();
                    validForm = false;
                }else{
                    $( "div.assetfile" ).hide();
                }

			}
		break;
		case 'update_asset':
			if($("input#assetname").val()==""){
				$( "div.assetname" ).show();
				validForm = false;
			}else{
				$( "div.assetname" ).hide();
			}			
			
			if($("input#assetfile").val()==""){
				$( "div.assetfile" ).show();
				validForm = false;
			}else{
				$( "div.assetfile" ).hide();
			}				
			
		break;
		case 'new_asset':
			if($("input#assetname").val()==""){
				$( "div.assetname" ).show();
				validForm = false;
			}else{
				$( "div.assetname" ).hide();
			}			
			
			if($("input#assetfile").val()==""){
				$( "div.assetfile" ).show();
				validForm = false;
			}else{
				$( "div.assetfile" ).hide();
			}				
		
		break;
		case 'select_duedate':
			if($("input#duedate").val()==""){
				$( "div.duedate" ).show();
				validForm = false;
			}else{
				$( "div.duedate" ).hide();
			}	
		break;
		case 'create_kivotos':
			
			if($("input#kivotosname").val()==""){
				$( "div.kivotosname" ).show();
				validForm = false;
			}else{
				$( "div.kivotosname" ).hide();
			}			
			
			if($("textarea#description").val()==""){
				
				$( "div.description" ).show();
				validForm = false;
			}else{
				
				$( "div.description" ).hide();
			}			
			
		break;
		case 'edit_user_profile_data':
		
			if($("input#fname_signup_mobile").val()==""){
				$( "div.fname_signup_mobile" ).show();
				validForm = false;
			}else{
				$( "div.fname_signup_mobile" ).hide();
			}
			
			if($("input#lname_signup_mobile").val()==""){
				$( "div.lname_signup_mobile" ).show();
				validForm = false;
			}else{
				$( "div.lname_signup_mobile" ).hide();
			}
					
			if($("input#email_signup_mobile").val()==""){
				$( "div.email_req_mobile" ).show();
				$( "div.email_invalid_mobile" ).hide();
				validForm = false;
			}else{
				$( "div.email_req_mobile" ).hide();
				
				if(validEmail($("input#email_signup_mobile").val())){
					$( "div.email_invalid_mobile" ).hide();
				}else{
					$( "div.email_invalid_mobile" ).show();
					validForm = false;
				}
			}	
			
		break;
		case 'signup_main':
		
			if($("input#fname_signup_mobile").val()==""){
				$( "div.fname_signup_mobile" ).show();
				validForm = false;
			}else{
				$( "div.fname_signup_mobile" ).hide();
			}
			
			if($("input#lname_signup_mobile").val()==""){
				$( "div.lname_signup_mobile" ).show();
				validForm = false;
			}else{
				$( "div.lname_signup_mobile" ).hide();
			}

			if($("select#select_service_type").val()==""){
				$( "div.select_service_type" ).show();
				validForm = false;
			}else{
				$( "div.select_service_type" ).hide();
			}
					
			if($("input#email_signup_mobile").val()==""){
				$( "div.email_req_mobile" ).show();
				$( "div.email_invalid_mobile" ).hide();
				validForm = false;
			}else{
				$( "div.email_req_mobile" ).hide();
				
				if(validEmail($("input#email_signup_mobile").val())){
					$( "div.email_invalid_mobile" ).hide();
				}else{
					$( "div.email_invalid_mobile" ).show();
					validForm = false;
				}
			}	
			
			if($("input#pwd").val()==""){
				$( "div.pwd" ).show();
				validForm = false;
			}else{
				$( "div.pwd" ).hide();
			}

			if($("input#pwd_cnfrm").val()==""){
				$( "div.pwd_cnfrm" ).show();
				validForm = false;
			}else{
				$( "div.pwd_cnfrm" ).hide();
			}

			if($("input#pwd_cnfrm").val()!=$("input#pwd").val()){
				$( "div.pwd_cnfrm_match" ).show();
				validForm = false;
			}else{
				$( "div.pwd_cnfrm_match" ).hide();
			}


		break;
		case 'new_client':
			if($("input#companyname").val()==""){
				$( "div.companyname" ).show();
				validForm = false;
			}
		break;
		case 'signin_main':
			if($("input#email_signin_mobile").val()==""){
				$( "div.email_req_mobile" ).show();
				$( "div.email_invalid_mobile" ).hide();
				validForm = false;
			}else{
				$( "div.email_req_mobile" ).hide();
				
				if(validEmail($("input#email_signin_mobile").val())){
					$( "div.email_invalid_mobile" ).hide();
				}else{
					$( "div.email_invalid_mobile" ).show();
					validForm = false;
				}
			}	
			
			if($("input#pwd").val()==""){
				$( "div.pwd_req_mobile" ).show();
				validForm = false;
			}
		
		break;
		case 'email_unsub':
			if($("input#email_unsub_mobi").val()==""){
				$( "div.email_req_mobile" ).show();
				$( "div.email_invalid_mobile" ).hide();
				validForm = false;
			}else{
				$( "div.email_req_mobile" ).hide();
				
				if(validEmail($("input#email_unsub_mobi").val())){
					$( "div.email_invalid_mobile" ).hide();
				}else{
					$( "div.email_invalid_mobile" ).show();
					validForm = false;
				}
			}	
	
			if(!validForm){
				$(window).scrollTop(0);	
				
			}
		
		break;
		case 'contact_home':

			if($("input#fname").val()==""){
				$( "div.fname" ).show();
				validForm = false;
			}else{
				$( "div.fname" ).hide();	
			}
			
			if($("input#lname").val()==""){
				$( "div.lname" ).show();
				validForm = false;
			}else{
				$( "div.lname" ).hide();	
			}
			
			if($("input#email").val()==""){
				$( "div.emailcontact_req_mobile").show();
				$( "div.emailcontact_invalid_mobile" ).hide();
				validForm = false;
			}else{
				
				if(validEmail($("input#email").val())){
					$( "div.emailcontact_invalid_mobile" ).hide();
				}else{
					$( "div.emailcontact_invalid_mobile" ).show();
					$( "div.emailcontact_req_mobile").hide();
					validForm = false;
				}
			}
			
			if(!validForm){
				$(window).scrollTop(0);	
				
			}
			
		break;
		default:
			alert("...missing valid form_id, bro.");
			validForm = false;
		break;
		
		
	}
	
	
	return validForm;	
	
}

function togglePopup(popup_to_close,popup_to_open){

	$("#"+popup_to_close).popup('close');

	setTimeout(function () {
		$("#"+popup_to_open).popup('open')
	}, 100);


}

function editCopy_forPublish(){

	$('input#action_type').val('edit');
	$('form#content_publish_proxy').submit();

}

function skipCopy_forPublish(){

	$('input#action_type').val('skip');
	$('form#content_publish_proxy').submit();

}

function publishCopy_forPublish(){

	$('input#action_type').val('publish');

	$('form#content_publish_proxy').submit();

}

function saveCurrentProgress(elemtype, elemid) {

	tmp_xhr_lock = $('input#xcp_lock').val();
	tmp_xhr_state_track_elem = $('input#xhr_input_state_monitor_' + elemid);
	tmp_copy_element_val = $(elemtype + '#' + elemid).val();

	if(tmp_xhr_lock==''){

		if (tmp_xhr_state_track_elem.val() != tmp_copy_element_val && tmp_copy_element_val!='') {

			$('#xhr_activity_state').html('Saving draft...');
			$('input#xcp_lock').val('1');

			//
			// SYNC INPUT DELTA
			syncServerToInput(elemtype, elemid);

		} else {

			//
			// SYNC SERVER RETURNED DELTA
			tmp_xhr_state_track_elem = $('input#xhr_server_state_monitor_' + elemid);

			if (tmp_xhr_state_track_elem.val() != tmp_copy_element_val && tmp_copy_element_val!='') {

				$('#xhr_activity_state').html('Saving draft...');
				$('input#xcp_lock').val('1');

				//
				// SYNC SERVER DELTA
				syncServerToInput(elemtype, elemid);

			}else{
				if(tmp_copy_element_val==''){
					$('#xhr_activity_state').html('');

				}else{

					$('#xhr_activity_state').html('Content Saved.');
				}


			}

		}

	}

}

function syncServerToInput(elemtype, elemid){

	switch(elemid){
		case 'translation_copy':
			// IDs of GLOBALLY CONSISTENT CONTAINERS TO HOLD RETURNED ID FOR NEW CONTENT
			// ALL RELEVANT CONTAINER ID TO ACQUIRE RETURNED & STORED FOREIGN KEY DATA + RELEVANT META
			$('input#xcp_input_dom_element_type').val(elemtype);
			$('input#xcp_input_dom_element_id').val(elemid);
			$('input#xcp_element_id').val($('input#element_id').val());
			$('input#xcp_element_id_translation').val($('input#element_id_translation').val());
			$('input#xcp_copy_id').val($('input#copy_id').val());
			$('input#xcp_component_id').val($('input#component_id').val());
			$('input#xcp_page_id').val($('input#page_id').val());
			$('input#xcp_profile_id').val($('input#profile_id').val());
			$('input#xcp_lang_id').val($('input#lang_id').val());
			$('input#xcp_lang_id_translator').val($('input#lang_id_translator').val());
			$('input#xcp_date_translation_published').val($('input#date_translation_published').val());
			$('input#xcp_date_translation_drafted').val($('input#date_translation_drafted').val());

			$('input#xcp_isactive').val($('input#isactive').val());
			$('input#xcp_profile_type').val($('input#profile_type').val());
			$('input#xcp_component_type').val($('input#component_type').val());
			$('input#xcp_draft_owner').val($('input#draft_owner').val());
			$('input#xcp_element_copy').val($(elemtype+'#'+elemid).val());
			$('input#xcp_completion_state').val($('input#completion_state').val());

			$('input#xcp_copy_hash').val($('input#copy_hash').val());

			$('input#xcp_json_object_type').val('LANG_ELEM_DRAFT_SYNC');

			var json_serial = 0;
			$('input#xcp_json_serial_js_handle').val(json_serial);

			/*
			//
			// RETRIEVE VALUES FOR XHR CONTAINER COMPONENTS
			// HARVEST ALL PARAMS, AND SEND IT
			tmp_element_id = $('input#xcp_element_id').val();
			tmp_element_id_translation = $('input#xcp_element_id_translation').val();
			tmp_copy_id = $('input#xcp_copy_id').val();
			tmp_component_id = $('input#xcp_component_id').val();
			tmp_page_id = $('input#xcp_page_id').val();
			tmp_profile_id = $('input#xcp_profile_id').val();
			tmp_lang_id = $('input#xcp_lang_id').val();
			tmp_lang_id_translator = $('input#xcp_lang_id_translator').val();
			tmp_draft_state = $('input#xcp_draft_state').val();
			tmp_isactive = $('input#xcp_isactive').val();
			tmp_profile_type = $('input#xcp_profile_type').val();
			tmp_component_type = $('input#xcp_component_type').val();
			tmp_element_copy = $('input#xcp_element_copy').val();

			// DYNAMIC JSON OBJECT CONSTRUCTION - WITH ARRAY SUPPORT
			// oJson_construct(METHOD, SERIAL, KEY, VALUE);
			var json_serial = 0;
			oJson_init(json_serial);
			oJson_construct('ADD_ELEM_ATTRIBUTE', json_serial, 'JSON_SERIAL_JS_HANDLE', json_serial);
			oJson_construct('ADD_ELEM_ATTRIBUTE', json_serial, 'JSON_OBJECT_TYPE', 'LANG_ELEM_DRAFT_SYNC');
			oJson_construct('ADD_ELEM_ATTRIBUTE', json_serial, 'INPUT_DOM_ELEMENT_TYPE', elemtype);
			oJson_construct('ADD_ELEM_ATTRIBUTE', json_serial, 'INPUT_DOM_ELEMENT_ID', elemid);
			oJson_construct('ADD_ELEM_ATTRIBUTE', json_serial, 'ELEMENT_ID', tmp_element_id);
			oJson_construct('ADD_ELEM_ATTRIBUTE', json_serial, 'ELEMENT_ID_TRANSLATION', tmp_element_id_translation);
			oJson_construct('ADD_ELEM_ATTRIBUTE', json_serial, 'COPY_ID', tmp_copy_id);
			oJson_construct('ADD_ELEM_ATTRIBUTE', json_serial, 'COMPONENT_ID', tmp_component_id);
			oJson_construct('ADD_ELEM_ATTRIBUTE', json_serial, 'PAGE_ID', tmp_page_id);
			oJson_construct('ADD_ELEM_ATTRIBUTE', json_serial, 'PROFILE_ID', tmp_profile_id);
			oJson_construct('ADD_ELEM_ATTRIBUTE', json_serial, 'LANG_ID', tmp_lang_id);
			oJson_construct('ADD_ELEM_ATTRIBUTE', json_serial, 'LANG_ID_TRANSLATOR', tmp_lang_id_translator);
			oJson_construct('ADD_ELEM_ATTRIBUTE', json_serial, 'DRAFT_STATE', tmp_draft_state);
			oJson_construct('ADD_ELEM_ATTRIBUTE', json_serial, 'ISACTIVE', tmp_isactive);
			oJson_construct('ADD_ELEM_ATTRIBUTE', json_serial, 'PROFILE_TYPE', tmp_profile_type);
			oJson_construct('ADD_ELEM_ATTRIBUTE', json_serial, 'COMPONENT_TYPE', tmp_component_type);
			oJson_construct('ADD_ELEM_ATTRIBUTE', json_serial, 'ELEMENT_COPY', tmp_element_copy);
			oJson_construct('ADD_ELEM_ATTRIBUTE', json_serial, 'COMPLETION_STATE', 'AUTO_DRAFT');
			oJson_construct('ADD_ELEM_ATTRIBUTE', json_serial, 'DRAFT_OWNER', 'AUTO');

			//oJson_complete(json_serial);

			var json_cummulative_serial = null;
			//var json_cummulative_serial = json_serial;
			oJson_complete(json_cummulative_serial);

			//
			// BUILD JSON REQUEST
			// SINGLE JSON OBJECT
			// var content_state_json_string = JSON.stringify({ "INPUT_DOM_ELEMENT_TYPE": elemtype , "INPUT_DOM_ELEMENT_ID": elemid, "ELEMENT_COPY": tmp_element_copy , "COPY_ID":"420" , "COMPONENT_ID":"420" , "PAGE_ID":"8", "PROFILE_ID":"7" , "LANG_ID":"1" , "ISACTIVE":"6" , "PROFILE_TYPE":"5" , "COMPONENT_TYPE":"4" });

			//
			// JSON OBJECT ARRAY - THE BELOW IS MANUAL, AND BOTH WORK
			//var content_state_json_string = JSON.stringify({ "json_packet" : [{ "JSON_OBJECT_TYPE":"LANG_ELEM_DRAFT_SYNC", "INPUT_DOM_ELEMENT_TYPE": elemtype , "INPUT_DOM_ELEMENT_ID": elemid, "ELEMENT_ID": tmp_element_id, "ELEMENT_COPY": tmp_element_copy, "COPY_ID":"420" , "COMPONENT_ID":"420" , "PAGE_ID":"8", "PROFILE_ID":"7" , "LANG_ID":"1" , "ISACTIVE":"6" , "PROFILE_TYPE":"5" , "COMPONENT_TYPE":"4" },{ "JSON_OBJECT_TYPE":"LANG_ELEM_DRAFT_SYNC", "INPUT_DOM_ELEMENT_TYPE": elemtype , "INPUT_DOM_ELEMENT_ID": elemid, "ELEMENT_COPY": tmp_element_copy + '[ARRAY CONFIRMED]' , "COPY_ID":"420 - [ARRAY CONFIRMED]" , "COMPONENT_ID":"420 - [ARRAY CONFIRMED]" , "PAGE_ID":"8 - [ARRAY CONFIRMED]", "PROFILE_ID":"7 - [ARRAY CONFIRMED]" , "LANG_ID":"1 - [ARRAY CONFIRMED]" , "ISACTIVE":"6 - [ARRAY CONFIRMED]" , "PROFILE_TYPE":"5 - [ARRAY CONFIRMED]" , "COMPONENT_TYPE":"4 - [ARRAY CONFIRMED]" }]});
			//var content_state_json_string = JSON.stringify({ "json_packet" : [{ "JSON_OBJECT_TYPE":"LANG_ELEM_DRAFT_SYNC", "INPUT_DOM_ELEMENT_TYPE": elemtype , "INPUT_DOM_ELEMENT_ID": elemid, "ELEMENT_ID": tmp_element_id, "ELEMENT_COPY": tmp_element_copy, "COPY_ID":"420" , "COMPONENT_ID":"420" , "PAGE_ID":"8", "PROFILE_ID":"7" , "LANG_ID":"1" , "ISACTIVE":"6" , "PROFILE_TYPE":"5" , "COMPONENT_TYPE":"4" }]});

			if(json_cummulative_serial==null){
				var json_data_out = ojson_stringify_ARRAY['json_cummulative_FINAL'];

			}else{

				var json_data_out = ojson_stringify_ARRAY[json_serial];

			}
			*/

			//
			// BUILD AJAX REQUEST
			generate_cachebust();
			var site_root = $('#ajax_root').html();
			var endpoint = site_root + 'xhr/';
			var pars = "rt=xhr_sync&cache_b=" + $('#cache_bust').html();
			var uri = endpoint+'?'+ pars;;
			var data = $("#xhr_sync_proxy").serializeArray();

			//$("#xhr_sync_proxy").ajaxSubmit({url: uri, type: 'post'});

			console.log('Sending AJAX POST...Number of elements ->' + data.length);

			$.ajax({
				type: "POST",
				url: uri,
				data: data,
				beforeSend: function(x) {
					if (x && x.overrideMimeType) {
						x.overrideMimeType("multipart/form-data;charset=UTF-8");
					}
				},
				success: parseXHRCP_JSON,
				dataType: "html"
			});

			/*
			//
			// SEND JSON REQUEST AND PROCESS RESPONSE
			$.ajax({
				type: "POST",
				url: uri,
				data: data,
				beforeSend: function(x) {
					if (x && x.overrideMimeType) {
						x.overrideMimeType("application/json;charset=UTF-8");
					}
				},
				success: parseXHRCP_JSON,
				dataType: "json"
			});
			*/


		break;

	}

}

function oJson_init(json_serial=null){

	//
	// ENHANCE WITH NULL INDEX CLEAR ALL INDEX.
	if(json_serial==null){

		ojson_packet_output_ARRAY['json_cummulative'] = '';

	}else{

		ojson_packet_ARRAY[json_serial] = null;
		ojson_packet_ARRAY[json_serial] = undefined;

		var tmp_ARRAY = [];
		ojson_elem_flag_HANDLE_ARRAY[json_serial] = tmp_ARRAY;

	}

}

// oJson_construct(METHOD, SERIAL, KEY, VALUE);
function oJson_construct(json_method, json_serial, key, value){

	if (typeof value == 'undefined'){
		value = '';

	}

	switch(json_method) {
		case 'ADD_ELEM_ATTRIBUTE':

			// DEFINED IN MAIN.JS
			// ojson_packet_ARRAY
			// { "json_packet" : [{ "JSON_OBJECT_TYPE":"LANG_ELEM_DRAFT_SYNC", "INPUT_DOM_ELEMENT_TYPE": elemtype , "INPUT_DOM_ELEMENT_ID": elemid, "ELEMENT_ID": tmp_element_id, "ELEMENT_COPY": tmp_element_copy, "COPY_ID":"420" , "COMPONENT_ID":"420" , "PAGE_ID":"8", "PROFILE_ID":"7" , "LANG_ID":"1" , "ISACTIVE":"6" , "PROFILE_TYPE":"5" , "COMPONENT_TYPE":"4" }]});

			// SOURCE :: https://stackoverflow.com/questions/3390396/how-to-check-for-undefined-in-javascript
			// AUTHOR :: https://stackoverflow.com/users/165737/anurag
			ojson_elem_flag_ARRAY = ojson_elem_flag_HANDLE_ARRAY[json_serial];

			if (typeof ojson_packet_ARRAY[json_serial] == 'undefined'){

				ojson_packet_ARRAY[json_serial] = '"' + key + '" : ' + '"' + value + '"';
				ojson_elem_flag_ARRAY[json_serial+'_'+key] = 1;

				console.log('Add JSON elem #0 ->'+key+':'+value);

			} else {

				if(ojson_elem_flag_ARRAY[json_serial+'_'+key]===1 || ojson_elem_flag_ARRAY[json_serial+'_'+key]==='1'){

					console.log('// HOOOSTON...VE HAF PROBLEM! JSON elem ->'+key+' here, having value of ['+value+']...is already defined.');
				}else{

					ojson_packet_ARRAY[json_serial] = ojson_packet_ARRAY[json_serial] + ', "' + key + '" : ' + '"' + value + '"';
					ojson_elem_flag_ARRAY[json_serial+'_'+key] = 1;

					console.log('Add JSON elem ->'+key+':'+value);

				}

			}

			ojson_elem_flag_HANDLE_ARRAY[json_serial] = ojson_elem_flag_ARRAY;

		break;
		default:
			alert('My bro...is this ['+json_method+'] a new ojson method? We don\'t have a handle on it, yet.');

		break;

	}

}

function oJsonPacketCompile(tmp_json_txt, index){

	if(ojson_packet_output_ARRAY['json_cummulative'] === ''){

		ojson_packet_output_ARRAY['json_cummulative'] = '{' + tmp_json_txt + '}';

	}else{

		ojson_packet_output_ARRAY['json_cummulative'] = ojson_packet_output_ARRAY['json_cummulative'] + ', {' + tmp_json_txt + '}';

	}

}

function oJson_complete(json_serial=null){


	if(json_serial==null){

		ojson_packet_output_ARRAY['json_cummulative'] = '';

		//
		// COMPILE ALL JSON OBJECTS INTO SINGLE JSON_PACKET
		ojson_packet_ARRAY.forEach(oJsonPacketCompile);

		ojson_packet_output_ARRAY['json_cummulative_FINAL'] = '{ "json_packet" : [' + ojson_packet_output_ARRAY['json_cummulative'] + ']}';

	}else{

		ojson_packet_output_ARRAY[json_serial] = '{ "json_packet" : [{' + ojson_packet_ARRAY[json_serial] + '}]}';
		//ojson_packet_txt = '';
		//ojson_packet_txt = '{ "json_packet" : [{' + ojson_packet_ARRAY[json_serial] + '}]}';

	}


	//
	// GET OJSON_ARRAY TO SEND THROUGH AJAX.POST()
	oJson_Stringify(json_serial);

}

function oJson_Stringify(json_serial=null){

	//ojson_stringify_ARRAY[json_serial] = '';

	// var content_state_json_string = JSON.stringify({ "json_packet" : [{ "JSON_OBJECT_TYPE":"LANG_ELEM_DRAFT_SYNC", "INPUT_DOM_ELEMENT_TYPE": elemtype , "INPUT_DOM_ELEMENT_ID": elemid, "ELEMENT_ID": tmp_element_id, "ELEMENT_COPY": tmp_element_copy, "COPY_ID":"420" , "COMPONENT_ID":"420" , "PAGE_ID":"8", "PROFILE_ID":"7" , "LANG_ID":"1" , "ISACTIVE":"6" , "PROFILE_TYPE":"5" , "COMPONENT_TYPE":"4" }]});
	// = = = =

	// var obj = { name: "John", age: 30, city: "New York" };
	// var myJSON = JSON.stringify(obj);
	// = = = =

	//var fruits = ["apple", "orange", "cherry"];
	//fruits.forEach(myFunction);

	//function myFunction(item, index) {
	//	document.getElementById("demo").innerHTML += index + ":" + item + "<br>";
	//}

	// = = = =

	if(json_serial==null){

		var tmp_json_txt = ojson_packet_output_ARRAY['json_cummulative_FINAL'];

		console.log('[json_cummulative] Parsing this ->' + tmp_json_txt);

		ojson = JSON.parse(tmp_json_txt);

		console.log('[json_cummulative] Stringify-ing this ->' + ojson);

		ojson_stringify_ARRAY['json_cummulative_FINAL'] = JSON.stringify(ojson);

	}else{

		var tmp_json_txt = ojson_packet_output_ARRAY[json_serial];

		console.log('Parsing this ->' + tmp_json_txt);

		ojson = JSON.parse(tmp_json_txt);

		console.log('Stringify-ing this ->' + ojson);

		ojson_stringify_ARRAY[json_serial] = JSON.stringify(ojson);

	}

}

function parseXHRCP_JSON_OLD(oElemJSON){

	oElemJSON = JSON.parse(oElemJSON);

	//tmp_html = $('#test_xhr').html();
	//$('#test_xhr').html(tmp_html + oElemJSON.COMPONENT_ID + '-->' + oElemJSON.ELEMENT_COPY);

	$('input#xhr_input_state_monitor_' + oElemJSON.INPUT_DOM_ELEMENT_ID).val($(oElemJSON.INPUT_DOM_ELEMENT_TYPE + '#' + oElemJSON.INPUT_DOM_ELEMENT_ID).val());
	$('input#xhr_server_state_monitor_' + oElemJSON.INPUT_DOM_ELEMENT_ID).val(oElemJSON.ELEMENT_COPY);

	$('input#element_id').val(oElemJSON.ELEMENT_ID);
	$('input#element_id_translation').val(oElemJSON.ELEMENT_ID_TRANSLATION);
	$('#xhr_activity_state').html('Content Saved.');
	$('input#xcp_lock').val('');

	$('input#copy_id').val(oElemJSON.COPY_ID);
	$('input#component_id').val(oElemJSON.COMPONENT_ID);
	$('input#page_id').val(oElemJSON.PAGE_ID);
	$('input#profile_id').val(oElemJSON.PROFILE_ID);
	$('input#lang_id').val(oElemJSON.LANG_ID);
	$('input#lang_id_translator').val(oElemJSON.LANG_ID_TRANSLATOR);
	$('input#isactive').val(oElemJSON.ISACTIVE);
	$('input#profile_type').val(oElemJSON.PROFILE_TYPE);
	$('input#component_type').val(oElemJSON.COMPONENT_TYPE);
	$('input#completion_state').val(oElemJSON.COMPLETION_STATE);
	$('input#draft_owner').val(oElemJSON.DRAFT_OWNER);
	$('input#copy_hash').val(oElemJSON.COPY_HASH);

}

function apply_OBSClientUpdate_Confirm(queryType, obsClientID, elementID){

	ajax_root = $('#ajax_root').html();

	// '', 'button_event_delete',
	// BUILD CONFIRMATION EXPERIENCE
	switch(queryType){
		case 'delete_subtitle_authorize':
			$('input#action_type').val('delete_subtitle');

			$('#popupConfirmAction_title').html('Delete subtitle?');
			$('#confirm_title').html('Are you sure that you want to delete this subtitle?');

			tmp_anchors = '<a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b" data-rel="back">Cancel</a>' +
				'<a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b" data-ajax="false" onclick="processComponentMod(\'insert_subtitle_element\', this);">DELETE</a>';

			$('#confirm_anchors').html(tmp_anchors);

			$( "#post_proxy_form" ).submit(function( event ) {


			});

			$( "#popupConfirmAction" ).popup('open');


		break;
		case 'delete_paragraph_authorize':
			$('input#action_type').val('delete_paragraph');

			$('#popupConfirmAction_title').html('Delete paragraph?');
			$('#confirm_title').html('Are you sure that you want to delete this paragraph?');

			tmp_anchors = '<a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b" data-rel="back">Cancel</a>' +
				'<a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b" data-ajax="false" onclick="processComponentMod(\'insert_paragraph_element\', this);">DELETE</a>';

			$('#confirm_anchors').html(tmp_anchors);

			$( "#post_proxy_form" ).submit(function( event ) {


			});

			$( "#popupConfirmAction" ).popup('open');


		break;
		case 'chkbx_delete_schedule_event':

			if(($('input#checkbox_event_delete').prop('checked'))){

				$("#popupMenuAddAnEvent").popup("close");
				$('#popupConfirmAction_title').html('Delete event?');
				$('#confirm_title').html('Are you sure that you want to delete this event?');
				$('#confirm_apply_copy').html('This action will be applied after the SAVE button is clicked.');

				tmp_anchors = '<a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b"  onclick="clearElemVal(\'CHECKBOX\',\'checkbox_event_delete\', false); togglePopup(\'popupConfirmAction\',\'popupMenuAddAnEvent\');">Cancel</a>' +
					'<a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b" data-ajax="false" onclick="togglePopup(\'popupConfirmAction\',\'popupMenuAddAnEvent\');">DELETE AFTER SAVE</a>';

				$('#confirm_anchors').html(tmp_anchors);

				$( "#post_proxy_form" ).submit(function( event ) {


				});

				setTimeout(function () {
					$("#popupConfirmAction").popup('open')
				}, 100);

			}

		break;
		case 'delete_bulletlist_authorize':
			$('input#action_type').val('delete_bulletlist');

			$('#popupConfirmAction_title').html('Delete bullet list?');
			$('#confirm_title').html('Are you sure that you want to delete this list?');

			tmp_anchors = '<a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b" data-rel="back">Cancel</a>' +
				'<a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b" data-ajax="false" onclick="processComponentMod(\'insert_bullet_element\', this);">DELETE</a>';

			$('#confirm_anchors').html(tmp_anchors);

			$( "#post_proxy_form" ).submit(function( event ) {


			});

			$( "#popupConfirmAction" ).popup('open');

		break;
		case 'chkbx_delete_bulletlist_bullet':

			if(($('input#checkbox_bullet_delete').prop('checked'))){

				$("#popupMenuAddABullet").popup("close");
				$('#popupConfirmAction_title').html('Delete bullet?');
				$('#confirm_title').html('Are you sure that you want to delete this bullet point?');
				$('#confirm_apply_copy').html('This action will be applied after the UPDATE button is clicked.');

				tmp_anchors = '<a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b"  onclick="clearElemVal(\'CHECKBOX\',\'checkbox_bullet_delete\', false); togglePopup(\'popupConfirmAction\',\'popupMenuAddABullet\');">Cancel</a>' +
					'<a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b" data-ajax="false" onclick="togglePopup(\'popupConfirmAction\',\'popupMenuAddABullet\');">DELETE AFTER SAVE</a>';

				$('#confirm_anchors').html(tmp_anchors);

				$( "#post_proxy_form" ).submit(function( event ) {


				});

				setTimeout(function () {
					$("#popupConfirmAction").popup('open')
				}, 100);

			}

		break;
		case 'delete_schedule_authorize':
			$('input#action_type').val('delete_schedule');

			$('#popupConfirmAction_title').html('Delete schedule?');
			$('#confirm_title').html('Are you sure that you want to delete this schedule?');

			tmp_anchors = '<a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b" data-rel="back">Cancel</a>' +
				'<a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b" data-ajax="false" onclick="processComponentMod(\'insert_schedule_element\', this);">DELETE</a>';

			$('#confirm_anchors').html(tmp_anchors);

			$( "#post_proxy_form" ).submit(function( event ) {


			});

			$( "#popupConfirmAction" ).popup('open');

		break;
		case 'chkbx_delete_schedule_day':

			if(($('input#checkbox_day_delete').prop('checked'))){

				$("#popupMenuAddADay").popup("close");
				$('#popupConfirmAction_title').html('Delete day?');
				$('#confirm_title').html('Are you sure that you want to delete this day?');
				$('#confirm_apply_copy').html('This action will be applied when you save the form.');

				tmp_anchors = '<a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b" onclick="clearElemVal(\'CHECKBOX\',\'checkbox_day_delete\', false); togglePopup(\'popupConfirmAction\',\'popupMenuAddADay\');">Cancel</a>' +
					'<a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b" data-transition="flow" data-ajax="false" onclick=" togglePopup(\'popupConfirmAction\',\'popupMenuAddADay\');">DELETE AFTER SAVE</a>';

				$('#confirm_anchors').html(tmp_anchors);

				$( "#post_proxy_form" ).submit(function( event ) {


				});

				setTimeout(function () {
					$("#popupConfirmAction").popup('open')
				}, 100);

			}

		break;
		case 'chkbx_delete_schedule_event':
			$('#popupConfirmAction_title').html('Delete event?');
			$('#confirm_title').html('Are you sure that you want to delete this event?');

			tmp_anchors = '<a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b" data-rel="back" onclick="clearElemVal(\'CHECKBOX\',\'checkbox_event_delete\', false);">Cancel</a>' +
				'<a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b" data-transition="flow" data-ajax="false" data-rel="back">DELETE AFTER SAVE</a>';

			$('#confirm_anchors').html(tmp_anchors);

			$( "#post_proxy_form" ).submit(function( event ) {


			});

			$( "#popupConfirmAction" ).popup('open');

		break;
		case 'radio_select_mini_display_mode':

			$('input#obsclient_id').val(obsClientID);
			$('#mini_display_mode').val(elementID);
			$('#postid').val(queryType);

			switch(elementID){
				case 'SCROLL':
				
					$('#confirm_title').html('Are you sure that you want to change the mini overlay display mode to:<div class="cb_10"></div><i>Horizontal Scroll</i>');
				
				break;
				case 'FULL':
				
					$('#confirm_title').html('Are you sure that you want to change the mini overlay display mode to:<div class="cb_10"></div><i>Full Copy Display</i>');
				
				break;
				case 'SLEEP':
				
					$('#confirm_title').html('Are you sure that you want to change the mini overlay display mode to:<div class="cb_10"></div><i>Sleep</i>');
				
				break;
				case 'SLEEP_ALT':
				
					$('#confirm_title').html('Are you sure that you want to change the mini overlay display mode to:<div class="cb_10"></div><i>Sleep / Alternate</i>');
				
				break;
				case 'SLEEP_SCROLL':
				
					$('#confirm_title').html('Are you sure that you want to change the mini overlay display mode to:<div class="cb_10"></div><i>Sleep / Horizontal Scroll</i>');
				
				break;
				case 'SLEEP_FULL':
				
					$('#confirm_title').html('Are you sure that you want to change the mini overlay display mode to:<div class="cb_10"></div><i>Sleep / Full Copy Display</i>');
				
				break;
				case 'HIDDEN':
				
					$('#confirm_title').html('Are you sure that you want to change the mini overlay display mode to:<div class="cb_10"></div><i>Hidden</i>');
				
				break;

			}

			tmp_anchors = '<a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b" data-rel="back">Cancel</a>' +
				'<a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b" data-transition="flow" data-ajax="false" onclick="submitPostProxy();">Apply</a>';

			//$('#confirm_anchors').html(tmp_anchors);

			$( "#post_proxy_form" ).submit(function( event ) {
				//
				// VALIDATE FORM
				//return validateForm('post_proxy_form');

			});

			$( "#popupConfirmAction" ).popup('open');
		break;
		case 'btn_hide_fullscrn_overlay':

			$('input#obsclient_id').val(obsClientID);
			$('#fullscrn_isvisible').val('0');
			$('#postid').val(queryType);

			$('#confirm_title').html('Are you sure that you want to hide the full screen overlay?');

			$( "#post_proxy_form" ).submit(function( event ) {
				//
				// VALIDATE FORM
				//return validateForm('post_proxy_form');

			});

			$( "#popupConfirmAction" ).popup('open');

		break;
		case 'btn_show_fullscrn_overlay':
			
			$('input#obsclient_id').val(obsClientID);
			$('#fullscrn_isvisible').val('1');
			$('#postid').val(queryType);

			$('#confirm_title').html('Are you sure that you want to show the full screen overlay?');

			tmp_anchors = '<a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b" data-rel="back">Cancel</a>' +
				'<a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b" data-transition="flow" data-ajax="false" onclick="submitPostProxy();">Apply</a>';

			$( "#post_proxy_form" ).submit(function( event ) {
				//
				// VALIDATE FORM
				//return validateForm('post_proxy_form');

			});

			$( "#popupConfirmAction" ).popup('open');

		break;
		case 'btn_hide_mini_overlay':

			$('input#obsclient_id').val(obsClientID);
			$('#mini_isvisible').val('0');
			$('#postid').val(queryType);

			$('#confirm_title').html('Are you sure that you want to hide the mini overlay?');

			tmp_anchors = '<a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b" data-rel="back">Cancel</a>' +
				'<a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b" data-transition="flow" data-ajax="false" onclick="submitPostProxy();">Apply</a>';

			$( "#post_proxy_form" ).submit(function( event ) {
				//
				// VALIDATE FORM
				//return validateForm('post_proxy_form');

			});

			$( "#popupConfirmAction" ).popup('open');

		break;
		case 'btn_show_mini_overlay':

			$('input#obsclient_id').val(obsClientID);
			$('#mini_isvisible').val('1');
			$('#postid').val(queryType);

			$('#confirm_title').html('Are you sure that you want to show the mini overlay?');

			tmp_anchors = '<a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b" data-rel="back">Cancel</a>' +
				'<a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b" data-transition="flow" data-ajax="false" onclick="submitPostProxy();">Apply</a>';

			$( "#post_proxy_form" ).submit(function( event ) {
				//
				// VALIDATE FORM
				//return validateForm('post_proxy_form');

			});

			$( "#popupConfirmAction" ).popup('open');

		break;
		case 'radio_select_fullscrn_overlay_profile':

			//var obs_client_params = 'obs_id='+obsClientID+'&fullscrn_profile_id='+elementID;

			$('input#action_type').val(queryType);

			$('#obs_id').val(obsClientID);
			$('input#fullscrn_profile_id').val(elementID);
			//alert(elementID);
			$('#postid').val(queryType);

			tmp_profile_name = $('#elem_name_' + elementID).html();
			$('#confirm_title').html('Are you sure that you want to change the full screen overlay to the following?<div class="cb_10"></div><i>'+tmp_profile_name+'</i>');

			$( "#post_proxy_form" ).submit(function( event ) {
				//
				// VALIDATE FORM
				//return validateForm('post_proxy_form');

			});

			$( "#popupConfirmAction" ).popup('open');

		break;
		case 'radio_select_mini_overlay_profile':

			//var obs_client_params = 'obs_id='+obsClientID+'&mini_profile_id='+elementID;

			$('#obs_id').val(obsClientID);
			$('#mini_profile_id').val(elementID);
			$('#postid').val(queryType);

			tmp_profile_name = $('#elem_name_' + elementID).html();
			$('#confirm_title').html('Are you sure that you want to change the full screen overlay to the following?<div class="cb_10"></div><i>'+tmp_profile_name+'</i>');

			tmp_anchors = '<a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b" data-rel="back">Cancel</a>' +
				'<a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b" data-transition="flow" data-ajax="false" onclick="submitPostProxy();">Apply</a>';

			//$('#confirm_anchors').html(tmp_anchors);

			$( "#post_proxy_form" ).submit(function( event ) {
				//
				// VALIDATE FORM
				//return validateForm('post_proxy_form');

			});

			$( "#popupConfirmAction" ).popup('open');


		break;

	}

}

function resetClientDashboardUIState(ui_component, checked_maybe_use_json_for_all_radio){

	//full_screen_profile_selection
	$('#fullscrn_profile_id').val('');

	setTimeout(function () {
		$('.'+ui_component).prop('checked', false).checkboxradio('refresh');
		$("input#"+checked_maybe_use_json_for_all_radio).prop('checked', true).checkboxradio('refresh');
	}, 50);

}

function resetSignupTranslate(){

	//
	// CANCEL BUTTOM ON LANG PACK POPUP
	$('select#select_service_type').val('');
	$('select#select_service_type').selectmenu('refresh', true);

	$( "#popupMenuLangToTranslate" ).popup('close');
}

function processSignupTranslate(){

	//
	// SUBMIT BUTTON ON LANG PACK POPUP
	// FOR EACH CHECKBOX CHECKED...MOVE DATA TO PROPER FORM
	tmp_checked_lang = '';
	tmp_lang_cnt = $('input#defaut_lang_cnt').val();

	for(i=0;i<tmp_lang_cnt;i++){

		//
		// IF BOX CHECKED, RECORD TO MAIN FORM
		if($('input#checkbox_lang_sel_'+i).prop('checked')){
			if(tmp_checked_lang==''){

				tmp_checked_lang = $('input#checkbox_lang_sel_'+i).val();

			}else{

				tmp_checked_lang = tmp_checked_lang + '|' + $('input#checkbox_lang_sel_'+i).val();

			}

		}

	}

	$('#translation_lang_select').val(tmp_checked_lang);

	$( "#popupMenuLangToTranslate" ).popup('close');
}

function processDesiredLangRequest(lang_cnt){

	tmp_lang_select_send = '';

	for(i=0;i<lang_cnt;i++){

		if($('input#checkbox_desired_lang_'+i).prop('checked')) {
			tmp_lang = $('input#checkbox_desired_lang_handle_' + i).val();

			if (tmp_lang_select_send != '') {

				tmp_lang_select_send = tmp_lang_select_send + '|' + tmp_lang;

			} else {

				tmp_lang_select_send = tmp_lang;

			}
		}
	}

	$('input#lang_translation_profile').val(tmp_lang_select_send);

	$( "#popupMenuSelectDesiredLang" ).popup('close');

	setTimeout(function () {
		$('#update_desired_languages').submit();
	}, 1000);

}

function checkTranslateData(){

	if($("select#select_service_type option:selected").text()=="Translator"){
		$( "#popupMenuLangToTranslate" ).popup('open');
	}

}

function processComponentMod(proxy_form_id, i_send_it){
	proxy_method = $('input#action_type').val();

	switch(proxy_method){
		case 'delete_subtitle':
		case 'delete_paragraph':
		case 'delete_bulletlist':

			$('#'+proxy_form_id).submit();

		break;
		case 'delete_schedule':

			$('#'+proxy_form_id).submit();

		break;
		case 'edit_schedule_day':

			if(($('input#checkbox_day_delete').prop('checked'))){

				$('input#schedule_day_delete').val('1');

			}else{

				$('input#schedule_day_delete').val('0');
			}

		// NO BREAK...DUDE.
		case 'new_schedule_day':


			$('#'+proxy_form_id).submit();

		break;

		default:
			$('#oops_processComponentMod').html('hello, friend.');
		break;

	}

}

function updateInputValue(elem, val){

	$(elem).val(val);

}

function resetPopupState(popup_id, tgt_radio_id){

	$('#'+popup_id).popup('close');

	switch(popup_id){
		case 'popupMenuBulletOrder':
			$('#bulletlist_isordered_RESTORE').val(tgt_radio_id);

			setTimeout(function () {
				$('.radio_bullet_order').prop('checked', false).checkboxradio('refresh');
				$("input#"+tgt_radio_id).prop('checked', true).checkboxradio('refresh');
			}, 500);

		break;
		case 'popupMenuBulletStyle':
			$('#bulletlist_bullet_style_RESTORE').val(tgt_radio_id);

			setTimeout(function () {
				$('.radio_bullet_style').prop('checked', false).checkboxradio('refresh');
				$("input#"+tgt_radio_id).prop('checked', true).checkboxradio('refresh');
			}, 1000);
		break;

	}

}

function setScheduleDayFocus(focus_type, obj_id){

	$('input#action_type').val(focus_type);
	$('input#overlay_fullscrn_schedule_day_id').val(obj_id);

	switch(focus_type){
		case 'edit_schedule_day':


			$('#schedule_day_delete_wrapper').show();

		break;
		case 'new_schedule_day':

			$('#schedule_day_delete_wrapper').hide();

		break;
		case 'edit_schedule_event':

			$('#schedule_event_delete_wrapper').show();

		break;
		case 'new_schedule_event':

			$('#schedule_event_delete_wrapper').hide();
			$('#popupMenuAddAnEvent').popup('open');

		break;


	}

}

function updatePageBGOpacity(elem_id, elemtype, dom_input_id){

	switch(elemtype){
		case 'FULLSCRN_PAGE':

			$('#demo_out').html($('input#'+dom_input_id).val());

			$('input#overlay_fullscrn_page_opacity').val($('input#'+dom_input_id).val());

			$('input#overlay_fullscrn_page_id').val(elem_id);

			$('input#postid').val('update_page_bg_opacity');
			$('#popupMenuBGOpacity').popup('close');

			$('#update_page_meta_simple').submit();

		break;

	}

}

function editSubtitle(){

	$('input#action_type').val('edit_subtitle');

	$('#add_subtitle_title_label').html('Edit Subtitle:');
	$('#new_subtitle_submit').html('UPDATE');

	tmp_subtitle_content = $('input#subtitle_content').val();

	// SOURCE :: https://stackoverflow.com/squestions/24816/escaping-html-strings-with-jquery
	// AUTHOR :: https://stackoverflow.com/users/1414/travis
	var escaped_tmp_paragraph_content = $("<div>").text(tmp_subtitle_content).html();
	// ^^^ //

	$('textarea#subtitle_copy').val(escaped_tmp_paragraph_content);

	$('#popupMenuAddASubtitle').popup('open');

}

function editParagraph(){

	$('input#action_type').val('edit_paragraph');

	$('#add_paragraph_title_label').html('Edit Paragraph:');
	$('#new_paragraph_submit').html('UPDATE');

	tmp_paragraph_content = $('input#paragraph_content').val();
	tmp_paragraph_is_bold = $('input#paragraph_content_is_bold').val();

	// SOURCE :: https://stackoverflow.com/questions/24816/escaping-html-strings-with-jquery
	// AUTHOR :: https://stackoverflow.com/users/1414/travis
	var escaped_tmp_paragraph_content = $("<div>").text(tmp_paragraph_content).html();
	// ^^^ //

	$('textarea#paragraph_copy').val(escaped_tmp_paragraph_content);

	if(tmp_paragraph_is_bold==1 || tmp_paragraph_is_bold=='1'){
		$('#checkbox_copy_bold').prop("checked", true).checkboxradio('refresh');

	}else{
		$('#checkbox_copy_bold').prop("checked", false).checkboxradio('refresh');
	}

	$('#popupMenuAddAParagraph').popup('open');

}

function editScheduleDay(component_id, day_id, day_id_encrypt){

	setScheduleDayFocus('edit_schedule_day', day_id);

	$('input#overlay_fullscrn_schedule_day_id').val(day_id_encrypt);

	$('#add_day_title_label').html('Update this Day:');
	$('#add_schedule_day_ui_btn').html('UPDATE');
	$('#add_schedule_day_ui_btn').removeClass( "ui-state-disabled" );
	$('#checkbox_day_delete').prop("checked", false).checkboxradio('refresh');

	$('#popupMenuAddADay').popup('open');

	tmp_select_year = $('input#silent_event_select_year_'+day_id).val();
	tmp_select_month = $('input#silent_event_select_month_'+day_id).val();
	tmp_select_day = $('input#silent_event_select_day_'+day_id).val();

	$('select#select-choice-year').val(tmp_select_year);
	$('select#select-choice-month').val(tmp_select_month);
	$('select#select-choice-day').val(tmp_select_day);

	$('input#schedule_date_year').val(tmp_select_year);
	$('input#schedule_date_month').val(tmp_select_month);
	$('input#schedule_date_day').val(tmp_select_day);

	$('select#select-choice-year').selectmenu('refresh', true);
	$('select#select-choice-month').selectmenu('refresh', true);
	$('select#select-choice-day').selectmenu('refresh', true);

	$("#checkbox_day_delete").on("click", function(){
		//$('#popupMenuAddADay').popup('close');
		//$("#popupConfirmAction").popup("open");
		apply_OBSClientUpdate_Confirm('chkbx_delete_schedule_day', 'checkbox_day_delete', 'nothing');
	});

}

// SOURCE :: https://stackoverflow.com/questions/1147359/how-to-decode-html-entities-using-jquery/1395954#1395954
// AUTHOR :: https://stackoverflow.com/users/428486/lucascaro
function decodeEntities(encodedString) {
	var textArea = document.createElement('textarea');
	textArea.innerHTML = encodedString;
	return textArea.value;
}

function editBulletPoint(component_id, bullet_id ,bullet_id_encrypt){

	setBulletListBulletFocus('edit_bulletlist_bullet', bullet_id_encrypt);

	$('#add_bullet_title_label').html('Update this bullet:');
	$('#new_bullet_submit').html('UPDATE');

	$('#popupMenuAddABullet').popup('open');

	tmp_bullet_bullet_id = $('input#silent_bullet_bullet_id_' + bullet_id).val();
	tmp_bullet_copy = $('input#silent_bullet_copy_' + bullet_id).val();
	tmp_bullet_bold = $('input#silent_bullet_bold_' + bullet_id).val();
	tmp_bullet_element_id = $('input#silent_bullet_element_id_' + bullet_id).val();

	tmp_bullet_copy = decodeEntities(tmp_bullet_copy);

	$('textarea#bullet_description').val(tmp_bullet_copy);

	if(tmp_bullet_bold==1 || tmp_bullet_bold=='1'){
		$('#checkbox_copy_bold').prop("checked", true).checkboxradio('refresh');

	}else{
		$('#checkbox_copy_bold').prop("checked", false).checkboxradio('refresh');
	}

	$('input#overlay_fullscrn_bulletlist_bullet_id').val(tmp_bullet_bullet_id);
	$('input#bulletlist_bullet_copy').val(tmp_bullet_copy);
	$('input#bulletlist_bullet_text_bold').val(tmp_bullet_bold);
	$('input#bulletlist_bullet_element_id').val(tmp_bullet_element_id);

	$("#checkbox_bullet_delete").on("click", function(){

		apply_OBSClientUpdate_Confirm('chkbx_delete_bulletlist_bullet', 'checkbox_bullet_delete', 'nothing');
	});

}

function setBulletListBulletFocus(focus_type, obj_id){

	$('input#action_type').val(focus_type);
	$('input#overlay_fullscrn_bulletlist_bullet_id').val(obj_id);

	switch(focus_type){
		case 'edit_bulletlist_bullet':

			$('#checkbox_bullet_delete').prop("checked", false).checkboxradio('refresh');
			$('#bullet_point_delete_wrapper').show();

		break;
		case 'new_schedule_day':

			$('#bulletlist_bullet_delete_wrapper').hide();

		break;

	}

}

function newSubtitle(){

	$('input#action_type').val('new_subtitle');

	$("div.oops_processComponentMod_saveSubtitle_req").hide();
	$("div.oops_processComponentMod_saveSubtitle_invalid").hide();
	$("#oops_processComponentMod_saveSubtitle").html('');

	$('textarea#subtitle_copy').val('');

	$('#new_subtitle_submit').html('SAVE');

	$('#popupMenuAddASubtitle').popup('open');

}

function newParagraph(){

	$('#paragraph_delete_wrapper').hide();

	$('input#action_type').val('new_paragraph');

	$("div.oops_processComponentMod_savePara_req").hide();
	$("div.oops_processComponentMod_savePara_invalid").hide();
	$("#oops_processComponentMod_savePara").html('');

	$('textarea#paragraph_copy').val('');
	$('#checkbox_copy_bold').prop("checked", false).checkboxradio('refresh');

	$('#new_paragraph_submit').html('SAVE');

	$('#popupMenuAddAParagraph').popup('open');

}

function newBulletPoint(){
	$('#bullet_point_delete_wrapper').hide();

	$('input#action_type').val('new_bullet_point');

	$("div.oops_processComponentMod_saveBullet_req").hide();
	$("div.oops_processComponentMod_saveBullet_invalid").hide();
	$("#oops_processComponentMod_saveBullet").html('');

	$('textarea#bullet_description').val('');
	$('#checkbox_copy_bold').prop("checked", false).checkboxradio('refresh');

	$('#new_bullet_submit').html('SAVE');

	$('#popupMenuAddABullet').popup('open');
}

function newScheduleDay(){
	day_id = '';
	setScheduleDayFocus('new_schedule_day', day_id);

	$('#add_day_title_label').html('Add a Day:');
	$('#add_schedule_day_ui_btn').html('ADD');
	$('#add_schedule_day_ui_btn').addClass( "ui-state-disabled" );

	$('#popupMenuAddADay').popup('open');

}

function editScheduleEvent(component_id, event_id){

	$('input#overlay_fullscrn_schedule_event_id').val(event_id);
	$('#popupMenuAddAnEvent').popup('open');

	$('input#slider_hour').val($('#event_hour_'+event_id).html());
	$('input#slider_minute').val($('#event_minute_'+event_id).html());
	$('textarea#event_description').val($('input#silent_event_description_'+event_id).val());
	$('input#schedule_event_element_id').val($('input#silent_event_element_id_'+event_id).val());
	tmp_ampm = $('input#silent_event_ampm_'+event_id).val();
	tmp_bold = $('input#silent_event_bold_'+event_id).val();

	if(tmp_bold=='1' || tmp_bold==1){
		//console.log('checkbox_copy_bold should be checked...'+tmp_bold);
		$('#checkbox_copy_bold').prop("checked", true).checkboxradio('refresh');

	}else{
		$('#checkbox_copy_bold').prop("checked", false).checkboxradio('refresh');

	}

	$('input#schedule_event_ampm').val(tmp_ampm);

	if(tmp_ampm=='PM'){

		$('#sliderAMPM').val(tmp_ampm);
		$('#sliderAMPM').slider('refresh');

	}else{
		$('#sliderAMPM').val(tmp_ampm);
		$('#sliderAMPM').slider('refresh');
	}

	$("#checkbox_event_delete").on("click", function(){

		apply_OBSClientUpdate_Confirm('chkbx_delete_schedule_event', 'checkbox_event_delete', 'nothing');
	});

}

function processTranslationSave(){

	$('#language_translation_user_submit_capture').submit();

}

function processSubtitleData(){

	$('input#subtitle_content').val($('textarea#subtitle_copy').val());

	$('#insert_subtitle_element').submit();

}

function processParagraphData(){

	$('input#paragraph_content').val($('textarea#paragraph_copy').val());

	if(($('input#checkbox_copy_bold').prop('checked'))){

		$('input#paragraph_content_is_bold').val('1');

	}else{

		$('input#paragraph_content_is_bold').val('0');
	}

	$('#insert_paragraph_element').submit();

}

function processNewBullet(){

	$('input#bulletlist_bullet_copy').val($('textarea#bullet_description').val());

	if(($('input#checkbox_copy_bold').prop('checked'))){

		$('input#bulletlist_bullet_text_bold').val('1');

	}else{

		$('input#bulletlist_bullet_text_bold').val('0');
	}

	if(($('input#checkbox_bullet_delete').prop('checked'))){

		$('input#bulletlist_bullet_point_delete').val('1');

	}else{

		$('input#bulletlist_bullet_point_delete').val('0');
	}

	$('#insert_bullet_element').submit();

}

function processNewEvent(){

	$('input#schedule_event_hour').val($('input#slider_hour').val());
	$('input#schedule_event_minute').val($('input#slider_minute').val());
	$('input#schedule_event_ampm').val($('select#sliderAMPM').val());
	$('input#schedule_event_description').val($("textarea#event_description").val());

	$('input#schedule_event_element_id').val();

	if(($('input#checkbox_copy_bold').prop('checked'))){

		$('input#schedule_event_description_bold').val('1');

	}else{

		$('input#schedule_event_description_bold').val('0');
	}

	if(($('input#checkbox_event_delete').prop('checked'))){

		$('input#schedule_event_delete').val('1');

	}else{

		$('input#schedule_event_delete').val('0');
	}

	$('#insert_schedule_element').submit();

}

function scheduleSelectDateElem(date_elem_type, input_elem){

	/*
	<form id="insert_schedule_element">
	<input type="hidden" name="schedule_date_day" id="schedule_date_day" value="">
	<input type="hidden" name="schedule_date_month" id="schedule_date_month" value="">
	<input type="hidden" name="schedule_date_year" id="schedule_date_year" value="">
	* */

	switch(date_elem_type){
		case 'YEAR':
			$('input#schedule_date_year').val(input_elem.value);

		break;
		case 'MONTH':
			$('input#schedule_date_month').val(input_elem.value);

		break;
		case 'DAY':
			$('input#schedule_date_day').val(input_elem.value);

		break;

	}

	tmp_year = $('input#schedule_date_year').val();
	tmp_month = $('input#schedule_date_month').val();
	tmp_day = $('input#schedule_date_day').val();


	if(tmp_year!='' && tmp_month!='' && tmp_day!=''){

		$('#add_schedule_day_ui_btn').removeClass( "ui-state-disabled" );

	}else{

		$('#add_schedule_day_ui_btn').addClass( "ui-state-disabled" );
	}

}

function updateScheduleTimeFormat(elem){
	$('input#schedule_time_format').val(elem.value);
	$('input#schedule_time_format_en').val(elem.options[elem.selectedIndex].text);

	$('input#postid').val('update_schedule_time_format');
	$('input#action_type').val('update_schedule_time_format');

	$('#insert_schedule_element').submit();


}

function updateScheduleDateFormat(elem){

	//$('input#overlay_fullscrn_profile_id').val(profile_id);
	//$('input#overlay_fullscrn_page_id').val(page_id);
	//$('input#overlay_fullscrn_schedule_id').val(schedule_id);

	$('input#schedule_date_format').val(elem.value);
	$('input#schedule_date_format_en').val(elem.options[elem.selectedIndex].text);

	$('input#postid').val('update_schedule_date_format');
	$('input#action_type').val('update_schedule_date_format');

	$('#insert_schedule_element').submit();



}

function updatePageBGColor(elem_id, val){

	$('input#overlay_fullscrn_page_id').val(elem_id);
	$('input#overlay_fullscrn_page_bg_color').val(val);

	$('input#postid').val('update_page_bg_color');

	$('#update_page_meta_simple').submit();

}

function clearElemVal(elem_type, elem_id, new_val){

	switch(elem_type){
		case 'CHECKBOX':

			$('#'+elem_id).prop("checked", new_val).checkboxradio('refresh');

		break;


	}

}

function updateLangInputValue(elem, val, langname_proper='rebuild', langname_en='rebuild'){

	$(elem).val(val);

	if(langname_proper == 'rebuild'){

		//$('#lang_input_to_copy_value').html('Ready to inject...');

		langname_proper = $('#langname_proper_static_'+val+'').html();
		langname_en = $('#langname_en_static_'+val+'').html();

		if($('#lang_input_to_copy_value').length){

			$('#lang_input_to_copy_value').html('<strong>' + langname_proper + '</strong> (' + langname_en + ')');

		}


	}else{

		if($('#lang_input_to_copy_value').length){

			$('#lang_input_to_copy_value').html('<strong>' + langname_proper + '</strong> (' + langname_en + ')');

		}

		$('#popupMenuLangSelect').popup('close');

	}


}

function submitPostProxy_popupConfirm(){

	$( "#popupConfirmAction" ).popup('close');

	setTimeout(function () {
		$('#post_proxy_form').submit();
	}, 700);
}

function submitPostProxy(){

	$('#post_proxy_form').submit();
}

function evifweb_langSelect(isocode){
	var tmp_lnk = window.location.href;
	
	//
	// DO I HAVE A ? MARK ALREADY?
	var quest_loc = tmp_lnk.indexOf("?");
	var iso_loc = tmp_lnk.indexOf("isocode");
	
	if(iso_loc>3){
		
		//
		// JUST UPDATE ISOCODE
		//alert('position of isocode in ['+tmp_lnk+'] = '+ iso_loc);
		var iso_loc = tmp_lnk.indexOf("?isocode");
		
		if(iso_loc<3){
			var uri_split = tmp_lnk.split("&isocode=");
			uri_split[1] = uri_split[1].slice(2);
			
			//alert(uri_split[0]+uri_split[1]+"&isocode="+isocode);
			tmp_lnk = uri_split[0]+uri_split[1]+"&isocode="+isocode;
		}else{
			
			//
			// WE HAVE ?isoloc
			var uri_split = tmp_lnk.split("?isocode=");
			uri_split[1] = uri_split[1].slice(2);
			
			//alert(uri_split[0]+uri_split[1]+"&isocode="+isocode);
			tmp_lnk = uri_split[0] + "?isocode=" + isocode + uri_split[1];
			
		}
		
	}else{
		if(quest_loc>3){
			tmp_lnk = tmp_lnk + "&isocode="+isocode;
			
		}else{
			tmp_lnk = tmp_lnk + "?isocode="+isocode;
			
		}
			
	}

	var myWindow = window.open(tmp_lnk, "_self");

}

function evifweb_deviceSelect(dcode){
	var tmp_lnk = window.location.href;
	
	//
	// DO I HAVE A ? MARK ALREADY?
	var quest_loc = tmp_lnk.indexOf("?");
	var iso_loc = tmp_lnk.indexOf("dtype");
	
	if(iso_loc>3){
		
		//
		// JUST UPDATE DTYPE
		var iso_loc = tmp_lnk.indexOf("?dtype");
		
		if(iso_loc<3){
			var uri_split = tmp_lnk.split("&dtype=");
			uri_split[1] = uri_split[1].slice(1);
			
			tmp_lnk = uri_split[0]+uri_split[1]+"&dtype="+dcode;
		}else{
			
			//
			// WE HAVE ?isoloc
			var uri_split = tmp_lnk.split("?dtype=");
			uri_split[1] = uri_split[1].slice(1);
			
			//alert(uri_split[0]+uri_split[1]+"&isocode="+isocode);
			tmp_lnk = uri_split[0] + "?dtype=" + dcode + uri_split[1];
			
		}
		
	}else{
		if(quest_loc>3){
			tmp_lnk = tmp_lnk + "&dtype="+dcode;
			
		}else{
			tmp_lnk = tmp_lnk + "?dtype="+dcode;
			
		}
			
	}
	
	var myWindow = window.open(tmp_lnk, "_self");

}

function evifweb_form_component_content_append(popupid,type,id,log_id,appendvalue,eid){

    //
    // CLOSE POPUP WINDOW
    $( "#"+popupid ).popup( "close" );

    $("#"+id).focus();

    current_content = $(type+"#"+id).val();
    if(current_content==""){

        current_content = appendvalue + " ";

	}else{
		// I FEEL AN APPENDED SPACE IS SAFER TO BETTER PROTECT THE @MENTION INTEGRITY. BUT I DON'T LIKE DOUBLE SPACES. MAYBE I CAN CLEAR THEM.
    	current_content = current_content + " " + appendvalue + " ";
        current_content = current_content.replace("  ", " ");
    }

    //
	// TRY THIS. I'M NOT USED TO JQUERY..
    $(type+"#"+id).val(current_content);

    current_eid = $('input#'+log_id).val();
    if(current_eid==""){

        current_eid = eid;

	}else{
    	current_eid = current_eid + "|" + eid;
    }

    //alert(current_eid);

    $('input#'+log_id).val(current_eid);

    //
	// PUT FOCUS BACK ON TARGET
	$("#"+id).focus();
    //document.getElementById(id).focus();
    //document.getElementById("myAnchor").focus();

}

function evifweb_setFocus(id){
    $("#"+id).focus();

}

function evifweb_accountTypeSelect(){	
	$( "#edit_permissionType" ).submit();	
}

function evifweb_clientAccess_ADD(){
	$( "#add_clientAccess" ).submit();	
}

function evifweb_clientSelect(){
	$( "#select_client" ).submit();	
}

function evifweb_filterReset(){
	//var text = $( this ).text();
  	//$( "input" ).val( text );
	//alert(elem.val());
	
	//$("input#filterByTime").val("ALL"); 
	$( "input#filterByTime" ).prop( "checked", true ).checkboxradio( "refresh" );
	$( "input#filterByStatus" ).prop( "checked", true ).checkboxradio( "refresh" );
	$( "input[type='checkbox']" ).prop( "checked", false ).checkboxradio( "refresh" );

	
	$( "#filter_kivotos_results" ).submit();	
}


function evifweb_grantUserAccess(elem){
	$( "#"+elem).submit();
}

function evifweb_set_stream_content_style_height(){

    var image_chunk_size = 38;		// HEIGHT OF REPEATING BACKGROUND IMAGE
    var stream_dom_vert_flow_handles = $('#stream_dom_handles').html();		// PIPE DELIM OF HANDLES??

    // WHERE DO WE WANT TO GET i FROM? INNERHTML DATA?
    // HOW DO WE CONVERT i TO "n" IN stream_order_n_wrapper && stream_vert_flow_n_repeat
	//alert("handles HTML-> "+stream_dom_vert_flow_handles);
    if(stream_dom_vert_flow_handles!=undefined) {
        $.each(stream_dom_vert_flow_handles.split(/\|/), function (i, val) {

            //alert("value-->" + val);
            if (val != undefined) {
                var height = $("#stream_order_" + val + "_wrapper").height();

                var min_chunk_cnt = Math.floor(height / image_chunk_size);

                var newheight = (min_chunk_cnt) * image_chunk_size;

                $("#stream_vert_flow_" + val + "_repeat").height(newheight);

            }
        });

    }
    // var height = $( "#stream_order_02_wrapper" ).height();
	//
    // var min_chunk_cnt = Math.floor(height / image_chunk_size);
	//
    // var newheight = (min_chunk_cnt) * image_chunk_size;
	//
    // $( "#stream_vert_flow_02_repeat" ).height(newheight);
	//
	//
    // var height = $( "#stream_order_01_wrapper" ).height();
	//
    // var min_chunk_cnt = Math.floor(height / image_chunk_size);
	//
    // var newheight = (min_chunk_cnt) * image_chunk_size;
	//
    // $( "#stream_vert_flow_01_repeat" ).height(newheight);
	//
	//
    // var height = $( "#stream_order_00_wrapper" ).height();
	//
    // var min_chunk_cnt = Math.floor(height / image_chunk_size);
	//
    // var newheight = (min_chunk_cnt) * image_chunk_size;
	//
    // //alert("height="+height+"|chunk="+image_chunk_size+"|min_chunk_cnt="+min_chunk_cnt+"|newheight="+newheight);
    // $( "#stream_vert_flow_00_repeat" ).height(newheight);

}

function evifweb_process_reply_submit_redirect(){

	if($('#reply_redirect').length){
		var link = $('#reply_redirect').html();

		if(link!="" && link!=undefined){
			window.top.location.href = link;
			//alert(link);
		}else{
			$('#reply_redirect').html('error redirecting link')

		}
    }
}

function evifweb_display_new_stream(){
	$("#new_stream_lnk").slideUp( "slow", function() {
        // Animation complete.
    });
	$( "#new_stream_input" ).slideDown( "slow", function() {
		// Animation complete.
	});

}

function evifweb_display_stream_toggle_fileAttach(){

    if($('#stream_file_attach:visible').length > 0) {


        $("input#assetname").val("");
        $("input#assetfile").val("");


        $( "#stream_file_attach" ).slideUp( "slow", function() {
             // Animation complete.
        });

        var action = "#";
        $("#create_stream").attr("action", action);

        //
		// WE HAVE TO PULL COPY FOR LINK FROM PHP GENERATED HTML TO TIE THIS INTO EXISTING MULTI-LANGUAGE DISPLAY FUNCTIONALITY.
		$("#stream_file_attach_lnk").html($("#stream_file_attach_copy").html());

    }else{

        $("#stream_file_attach").slideDown("slow", function () {
            // Animation complete.
        });

        //
        // NEED TO SET FORM ENDPOINT FOR FILE PROCESSING
        var action = $("#ASSET_POST_ENDPOINT").html();
        $("#create_stream").attr("action", action);

        //
        // WE HAVE TO PULL COPY FOR LINK FROM PHP GENERATED HTML TO TIE THIS INTO EXISTING MULTI-LANGUAGE DISPLAY FUNCTIONALITY.
        $("#stream_file_attach_lnk").html($("#stream_file_cancel_copy").html());

    }
}

function evifweb_followLink(uri, target='_self'){

    var myWindow = window.open(uri, target);
}

function evifweb_highlight_stream(){

	if($("#target_stream_comm").length){
		$([document.documentElement, document.body]).animate({
			scrollTop: $("#target_stream_comm").offset().top - 130
		}, 1000, function() {
			   // Animation complete.
			$( "#target_stream_comm" ).css( "color", "#9C0039" );
			$( "#target_stream_comm" ).css( "backgroundColor", "#FAFBAD" );
			});
    }
}

function validEmail(str){
	
	var emailFilter=/^.+@.+\..{2,5}$/;
	var illegalChars= /[\(\)\<\>\,\;\:\\\/\"\[\]]/
	if ((!(emailFilter.test(str))) || (str.match(illegalChars))) {
		return false;
	}
	return true;
		
}

function validColorHex(str){
	var illegalChars= /[\(\)\<\>\,\;\:\\\/\"\[\]]/
	if (str.match(illegalChars)) {
		return false;
	}

	if(str.length!=4 && str.length!=7){
		return false;

	}

	return true;

}


function validElemName(str){
	var illegalChars= /[\(\)\<\>\,\;\\\/\"\[\]]/
	if (str.match(illegalChars)) {
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

function evifweb_stream_toggle_assets(form_id){

	$( "#"+form_id ).submit();
}

function evifweb_stream_reply_iframe_populate(osi, iframe_id){

    //$('#frameID').load(function(){
	$('#'+ iframe_id).contents().find('input#osi').val(osi);

	//alert("osi->"+osi+"|iframe_id->"+iframe_id);
    //});
}

$( document ).ready(function() {
	//evifweb_hide_stream_input();		# LETS START OUT HIDDEN.

	/*
	evifweb_set_stream_content_style_height();
    evifweb_process_reply_submit_redirect();
    evifweb_highlight_stream();
    */

});