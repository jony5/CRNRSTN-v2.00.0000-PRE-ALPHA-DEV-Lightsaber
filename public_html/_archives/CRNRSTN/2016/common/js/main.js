/* 
// J5
// Code is Poetry */

//
// INITIALIZE
Event.observe(window, 'load', initGlobal, false);

function initGlobal(){
	
	//
	// TRACKING
	//if(enableGoogle){
	//	initGoogle();
	//}
	
	//
	// FOOTER COPY
	if($("footer-copyright")){
		form_sysdate = new Date();
		var dy = fullYear(form_sysdate);
		$("footer-copyright").innerHTML="&copy; "+dy+" Jonathan 'J5' Harris :: All Rights Reserved.";	
	}
	
	//
	// INITIALIZE DOCUMENT NAVIGATION STATE
	if($("nav_lnk_wrapper")){
	//	initNav();
	}
	
	//
	// RICO ROUNDED CORNERS ON BTNS...FIGURE THIS OUT LATER...
	//if($('login_main_submit_btn')){
	//	$('login_main_submit_btn')
	//}
}



/*NAVIGATION CONTROLS :: INITIALIZATION*/
function initNav(){
	var currNav = "";
	var ns;
	
	if($("ns")){
		var ns = $("ns").innerHTML;
	}
	
	//
	// EXTRACT INITIALIZATION DATA FROM NS AND PROCESS
	if($('ns')){
	if($('ns').innerHTML!=0){
		//
		// REMAIN STILL WHILE YOUR LIFE IS EXTRACTED
		ns.split(',').each(
			function(navItem) { 
				switch(navItem){
					case "crnrstn":
					case "logging":
					case "environmentals":
					case "cookie_manager":
					case "http_manager":
					case "ip_auth_manager":
					case "cipher_manager":
					case "mysqli_connection_manager":
					case "mysqli_conn":
					case "session_manager":
						updateClientNavState(navItem);
					break;
					default:
						//alert("I FOUND NOTHING FOR :: "+navItem);
					break;
				}
		
		});
	}
	}
}

function updateClientNavState(navElemName){
	//
	// UPDATE NAV STATE IN CLIENT BROWSER
	if(navElemName.length>0){
		Effect.toggle(navElemName+'_subnav','slide');
	}
}


//
// ONCLICK FUNCTION
function toggleNavState(navElem, actionType){

	switch(navElem){
		case "crnrstn":
		case "logging":
		case "environmentals":
		case "cookie_manager":
		case "http_manager":
		case "ip_auth_manager":
		case "cipher_manager":
		case "mysqli_connection_manager":
		case "mysqli_conn":
		case "session_manager":
			Effect.toggle(navElem+'_subnav', actionType); 
		
			//
			// UPDATE SERVER NAV STATE IN $_COOKIE
			syncNavStateDiv(navElem, $(navElem+'_subnav').visible() ? 1 : 0 );
		break;
		default:
//			alert("no match found for"+navElem+"!");
			Effect.toggle(navElem+'_subnav', actionType); 
			syncNavStateDiv(navElem, $(navElem+'_subnav').visible() ? 1 : 0 );
		break;
	}
	
	return false;
}

function syncNavStateDiv(navToUpdate, navState){

	var ns_updated='';
	
	//
	// ITERATE THROUGH CLASSES AND COMPILE NAV STATE
	$('ns').innerHTML ="";
	var classes = $("classes").innerHTML;
	classes.split(',').each(
		function(navElemName) { 
			
			if($(navElemName+'_subnav').visible() && navElemName!=navToUpdate){
				//alert('adding to ns_updated '+ns_updated+','+navElemName);
				if(ns_updated!=""){
					ns_updated=ns_updated+','+navElemName;
				}else{
					ns_updated=','+navElemName;
				}
			}
	});
		 
	//
	// UPDATE DIV CONTENT...AS IF THE SERVER HAD INDICATED IT FROM THE BEGINNING
	$('ns').innerHTML = ns_updated;
}

function loadPage(requestCaller, pageUri){

	var ns_ARRAY = [];
	var ns = '';
	var classes = $('classes').innerHTML;
	var pageUri_WORKSHOP = pageUri;
	
	//
	// REMAIN STILL WHILE YOUR LIFE IS EXTRACTED
	classes.split(',').each(
		function(navElemName) { 
			
			//
			// APPEND NAMES OF ANY OPEN CLASS SUBNAVS
			if($(navElemName+'_subnav').visible() && !(requestCaller.id.indexOf(navElemName)>-1)){
				ns=ns+','+navElemName;
				ns_ARRAY[navElemName]=1;
			}
	});

	//
	// REQUEST NEW PAGE
	window.location = pageUri+ns;

}

function fullYear(theDate){
	
	x = theDate.getYear();
	var y = x % 100;
	y += (y < 38) ? 2000 : 1900;
	return y;
}


/*MISC FORM CONTROLS :: CHECKBOX BEHAVIOR*/
function checkMe(elemID){
	if($(elemID).checked){
		$(elemID).checked=false;
	}else{
		$(elemID).checked=true;
	}
}

/*SEARCH CONTROLS*/
function s_ovr(element){
	element.morph('background-color:#ff0000; color:#FFF;', {duration: 0.1});	
}

function s_out(element){
	element.morph('background-color:#E1E2E5; color:#6F6F6F;', {duration: 0.3});
}

function searchBtnMouseOver(element){
	element.morph('background-color:#FF6A6A; color:#FFF;', {duration: 0.1});	
}

function searchBtnMouseOut(element){
	element.morph('background-color:#FF0000; color:#E7E7E7;', {duration: 0.3});
}

/*NAVIGATION CONTROLS :: MOUSEOVER OVERLAY*/
var currOverlayLnkNm="";

function lnkMouseOver(lnkName){
	if(lnkName!=currOverlayLnkNm){
		new Effect.Appear(lnkName+'_lnk_activity_overlay', { duration: 0.2, from: 0.0, to: 0.4 });
	}
	currOverlayLnkNm=lnkName;
}

function lnkMouseOut(lnkName){
	if(lnkName==currOverlayLnkNm){
		new Effect.Appear(lnkName+'_lnk_activity_overlay', { duration: 0.2, from: 0.4, to: 0.0 });
		currOverlayLnkNm="";
	}
}

function sublnkMouseOver(element){
	$(element.id).removeClassName('subnav_lnk_clear');
	$(element.id).removeClassName('subnav_lnk_highlighted');
	$(element.id).addClassName('subnav_lnk_highlighted');
}

function sublnkMouseOut(element){
	$(element.id).removeClassName('subnav_lnk_highlighted');
	$(element.id).addClassName('subnav_lnk_clear');
}

function submitBtnMouseOver(element){
	element.removeClassName('submit_btn_clear');
	element.removeClassName('submit_btn_highlighted');
	element.addClassName('submit_btn_highlighted');
}

function submitBtnMouseOut(element){
	element.removeClassName('submit_btn_highlighted');
	element.addClassName('submit_btn_clear');
}

/* AJAX VALIDATION OF USERNAME */
/*
function usernameUnique(username){
	
//	/*THIS HARD CODED CODE SUCKS! MAYBE FIX LATER.
	var uri = "http://127.0.0.1/crnrstn.jony5.com/account/create/action/unchk.php";

	var pars='un='+username;
	var myAjax = new Ajax.Request(
	uri, 
	{
		method: 'get', 
		parameters: pars, 
		onComplete: parseUsernameChkResp
	});
}



function parseUsernameChkResp(formRequest){
	if(formRequest.responseText=='SUCCESS'){
		showerror(true, 'username');
		return true;
	}else{
		return false;
	}
}
*/

/*
I LIKE THIS ::
this.timer = setInterval(this.onTimerEvent.bind(this), this.frequency * 1000);
-
if (!this.timer) return;
clearInterval(this.timer);
this.timer = null;
-
Prototype JavaScript framework, version 1.7.1
(c) 2005-2010 Sam Stephenson
*/
