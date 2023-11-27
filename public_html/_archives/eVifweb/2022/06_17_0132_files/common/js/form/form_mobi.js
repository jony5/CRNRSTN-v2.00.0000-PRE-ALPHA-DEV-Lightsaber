/* 
// J5
// Code is Poetry */

function validateForm(form_id){
	var validForm = true;
	
	switch(form_id){
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
		case 'new_child_kivotos':
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
			alert("missing valid form_id");
			validForm = false;
		break;
		
		
	}
	
	
	return validForm;	
	
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

function evifweb_kivotosStatusUpdate(elem){
	$( "#"+elem ).submit();	
	
}

function evifweb_kivotosVisibilityUpdate(elem){
	$( "#"+elem).submit();
}

function evifweb_kivotosAssignedUpdate(elem){
	$( "#"+elem).submit();
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
    evifweb_set_stream_content_style_height();
    evifweb_process_reply_submit_redirect();
    evifweb_highlight_stream();
});