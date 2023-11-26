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
	// PAGE LOAD SCROLL
	scrollTo_PageLoad();
	
	//
	// INITIALIZE DOCUMENT NAVIGATION STATE
	if($("nav_mode")){
		if($("nav_mode").innerHTML!='XML'){
			if($("nav_lnk_wrapper")){
				initNav();
			}
		}
	}
	
	//if($('comment')){
	//	new Effect.ScrollTo('content_results_body',{offset: 10}); 
	//}

	var lnum_html = '';
	if($('lnum_test')){
		//alert('perform line number test...');
		for(i=1;i<29;i++){
			lnum_html = lnum_html+i+'<br>';
		}
		//alert(lnum_html);
		$('lnum_test').innerHTML = lnum_html+'<br><br>';
	}
	
	//
	// TRANSACTION STATUS MESSAGE CONTROLLER
	if($('user_transaction_status_msg').innerHTML!=''){
		usr_transTimer = setTimeout(toggleTransactionWrapperOpen, 1200);
	}
}

function toggleTransactionWrapperOpen(){
	new Effect.Appear('user_transaction_wrapper', { duration: 0.1, from: 0.0, to: 1.0 });
	new Effect.toggle('user_transaction_wrapper', 'slide');
	usr_transTimer = setTimeout(toggleTransactionWrapperClose, 15000);
}

function toggleTransactionWrapperClose(){
	new Effect.Appear('user_transaction_wrapper', { duration: 2.0, from: 1.0, to: 0.0, afterFinish: function(){
																 new Effect.toggle('user_transaction_wrapper', 'blind');
															   }  });
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
		if($('ns').innerHTML!=''){
			//
			// REMAIN STILL WHILE YOUR LIFE IS EXTRACTED
			ns.split('|').each(
				function(navItem) { 
					updateClientNavState(navItem);
				}
			
			);
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
	//alert(navElem);
	Effect.toggle(navElem+'_subnav', actionType); 
	return false;
}

function toggleCommentForm(frmElem, actionType){
	Effect.toggle(frmElem, actionType); 

	if($(frmElem).style.display!='none'){
		$('frm_comment_toggle_lnk').innerHTML = 'expand section';
	}else{
		prepCommentSubmission();
		$('frm_comment_toggle_lnk').innerHTML = 'collapse section';
	}
	
	return false;
}

var comment_ajax_lock=0;
var insertstatus_ElemId = 'isunique';
function prepCommentSubmission(){
	//
	// INITIALIZE INPUT PARAM FOR USER COMMENT SUBMISSION
	if(comment_ajax_lock==0){
		comment_ajax_lock = 1;
		var query = window.location.href; 
		var vars = query.split("/"); 
		var HTTP_ROOT = vars[0]+'//'+vars[2]+'/';
		var params = 'c=' + $('c').value + '&m='+$('m').value + '&u='+$('u').value;
		var uri = HTTP_ROOT + 'crnrstn/account/comment/insertstatus/';
		
		if($(insertstatus_ElemId).value==''){
					
			//
			// FIRE AJAX COMMENT INSERTION STATUS :: WEB SERVICES REQUEST
			var myAjax = new Ajax.Request(
			uri, 
			{
				method: 'get', 
				parameters: params, 
				onComplete: parseCommentStatusResp
			});

		}
	}
}

function parseCommentStatusResp(formRequest){
	var resp = formRequest.responseText;
	if(resp=='unique=false'){
		//
		// CLEAR ERROR_STATE_PARTIAL
		$("isunique").value = '0';

	}else{
		//
		// THROW ERROR_STATE_FULL
		$("isunique").value = '1';
	}
}
	
function toggleSoapDebug(frmElem, actionType){
	Effect.toggle(frmElem, actionType); 

	if($(frmElem).style.display!='none'){
		$('soap_toggle_lnk').innerHTML = 'expand section';
	}else{
		$('soap_toggle_lnk').innerHTML = 'collapse section';
	}
	
	return false;
}

function toggleFeedbackForm(frmElem){
	//
	//
	if($("form_fb_shell").positionedOffset()[0]<-1){
		$("form_fb_shell").morph('left:0px', {duration: 1.0, afterFinish: function(){
																				   frmElem.innerHTML = 'X'; 
																				   frmElem.morph('height:25px; font-size:18px', {duration: 0.5});
																				   }  });
		
	}else{
		$("form_fb_shell").morph('left:-354px', {duration: 0.5, afterFinish: function(){
																				   frmElem.morph('height:130px; font-size:14px', {duration: 0.5, afterFinish: function(){
																				   frmElem.innerHTML = 'F<br>E<br>E<br>D<br>B<br>A<br>C<br>K';
																				   }});								   
																				   }  });

	}
	
	return false;
}

function crnrstn_chkbxSel(elem,inputName){

	//alert(elem.id);

	if($('crnrstn_'+elem.id).className=='crnrstn_chkbx_on'){
		//
		// UNCHECK THIS CHECKBOX
		$('crnrstn_'+elem.id).removeClassName('crnrstn_chkbx_on');
		$('crnrstn_'+elem.id).addClassName('crnrstn_chkbx');
		$(inputName).value = '0';
	}else{
		//
		// CHECK THIS CHECKBOX
		$('crnrstn_'+elem.id).removeClassName('crnrstn_chkbx');
		$('crnrstn_'+elem.id).addClassName('crnrstn_chkbx_on');
		$(inputName).value = '1';
	}
}

function crnrstn_radioSel(elem, elem_IDSeed, radio_qty, inputName, inputValue){
	for(var i=0; i<(radio_qty*1); i++){
		if(elem.id=='crnrstn_'+elem_IDSeed+'_'+i){
			$(elem_IDSeed+'_'+i).removeClassName('crnrstn_radio');
			$(elem_IDSeed+'_'+i).addClassName('crnrstn_radio_on');
			$(inputName).value = inputValue;
		}else{
			$(elem_IDSeed+'_'+i).removeClassName('crnrstn_radio_on');
			$(elem_IDSeed+'_'+i).addClassName('crnrstn_radio');
		}
	}
}

function loadPage(requestCaller, pageUri){

	var ns = '';
	var classes = $('ns_opt').innerHTML;
	
	//
	// REMAIN STILL WHILE YOUR LIFE IS EXTRACTED
	classes.split('|').each(
		function(navElemName) { 
			//
			// APPEND NAMES OF ANY OPEN CLASS SUBNAVS
			if($(navElemName+'_subnav')){
				if($(navElemName+'_subnav').visible()){
					ns=ns+navElemName+'|';
				}
			}
	});
	
	
	//
	// 	IF pageUri HAS ?, &ns. ELSE ?ns
	if(pageUri.split("?").length>1){
		//
		// REQUEST NEW PAGE APPENDING TO EXISTING GET PARAMS
		if(ns.length>0){
			ns = ns.replace(/^\||\|+$/g, '');		// TRIM LEADING AND TRAILING PIPE
			window.location = pageUri+'&ns='+ns;
		}else{
			window.location = pageUri;
		}
	}else{
		//
		// REQUEST NEW PAGE. INITIALIZING GET PARAMS WITH ?
		if(ns.length>0){
			ns = ns.replace(/^\||\|+$/g, '');		// TRIM LEADING AND TRAILING PIPE
			window.location = pageUri+'?ns='+ns;
		}else{
			window.location = pageUri;
		}
	}
}

function loadPageFromIndex(pageUri){
	window.location = pageUri;	
}

function scrollTo_PageLoad(){
	if($("page_scrl")){
		var brwsr_offset = 0;
		var scrlPos = $("page_scrl").innerHTML;
		var src_brwsr = $("brwsr").innerHTML;
		var tgt_brwsr = '';

		if(Prototype.Browser.WebKit){
			tgt_brwsr = 'webkit';
		}
		
		if(Prototype.Browser.IE){
			tgt_brwsr = 'ie';
		}
		
		if(Prototype.Browser.Opera){
			tgt_brwsr = 'opera';
		}
		
		if(Prototype.Browser.Gecko){
			tgt_brwsr = 'gecko';
		}
		
		if(Prototype.Browser.MobileSafari){
			tgt_brwsr = 'mobilesafari';
		}
		
		if(scrlPos!=''){
			new Effect.ScrollTo("content_wrapper", {offset: (scrlPos*1)+(brwsr_offset*1)}); 
		}
	}
}

function initScrollTo_lnk(elem,uri){
	var pos = elem.positionedOffset()[1];
	var brwsr = '';

	if(Prototype.Browser.WebKit){
		brwsr = 'webkit';
	}
	
	if(Prototype.Browser.IE){
		brwsr = 'ie';
	}
	
	if(Prototype.Browser.Opera){
		brwsr = 'opera';
	}
	
	if(Prototype.Browser.Gecko){
		brwsr = 'gecko';
	}
	
	if(Prototype.Browser.MobileSafari){
		brwsr = 'mobilesafari';
	}
	
	//alert('cumulativeOffset :: ' + elem.cumulativeOffset()[1]);
	//alert('positionedOffset :: ' + elem.positionedOffset()[1]);
	window.location = uri+'&scrl='+pos+'&brwsr='+brwsr;
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

function loadUGCSearch(commentID,elementID, targetID){
	var query = window.location.href; 
	var vars = query.split("/"); 
	var HTTP_ROOT = vars[0]+'//'+vars[2]+'/';

	var params = 'c=' + commentID + '&e=' + elementID;
	var uri = HTTP_ROOT + 'crnrstn/search/ugc/';

	//
	// FIRE AJAX TOOL TIP :: WEB SERVICES REQUEST
	var ajax = new Ajax.Updater(
	{success: targetID},
	uri,
	{method: 'get', parameters: params});
	
}

function crnrstn_search_radioSel(elem, elem_IDSeed, radio_qty){
	for(var i=0; i<(radio_qty*1); i++){
		if(elem.id==elem_IDSeed+'_'+i){
			$('s_results_filter_radio_'+i).removeClassName('s_results_filter_radio');
			$('s_results_filter_radio_'+i).addClassName('s_results_filter_radio_on');
		}else{
			$('s_results_filter_radio_'+i).removeClassName('s_results_filter_radio_on');
			$('s_results_filter_radio_'+i).addClassName('s_results_filter_radio');
		}
	}
}

function initFilterRadio(){
	var tmp_pointer = '0';
	var query = window.location.href; 
	var vars_Filter = query.split("&"); 
	for(var i=0;i<vars_Filter.length;i++){
		switch(vars_Filter[i]){
			case 'filter=all':
				var tmp_pointer = '0';
			break;
			case 'filter=code':
				var tmp_pointer = '2';
			break;
			case 'filter=desc':
				var tmp_pointer = '3';
			break;
			case 'filter=ugc':
				var tmp_pointer = '1';
			break;
		}
	}
	
	for(var i=0; i<4; i++){
		if('s_results_filter_radio_'+tmp_pointer=='s_results_filter_radio_'+i){
			$('s_results_filter_radio_'+i).removeClassName('s_results_filter_radio');
			$('s_results_filter_radio_'+i).addClassName('s_results_filter_radio_on');
		}else{
			$('s_results_filter_radio_'+i).removeClassName('s_results_filter_radio_on');
			$('s_results_filter_radio_'+i).addClassName('s_results_filter_radio');
		}
	}
}

function crnrstn_search_filter(filterType){
	var query = window.location.href;
	var query_clean = query.split("#");
	var query_Filter = query_clean[0].split("&filter=");
	//alert(query_clean[0]+'&filter=' + filterType);
	window.location = query_Filter[0] + '&filter='+filterType;
}

var hoverCount = 0;
var tt_timer;
var tt_locktimer;
var tt_currElemId = '';
var tt_lock = 0;

function ttMsOvr(element){
	tt_currElemId = element.id;
	tt_timer = setTimeout(loadToolTip, 500);
}

function clear_tt_lock(){
	tt_lock=0;
	clearInterval(tt_locktimer);
	tt_locktimer = null;
}

function loadToolTip(){
	if(tt_lock==0){
		tt_lock = 1;
		var query = window.location.href; 
		var vars = query.split("/"); 
		var HTTP_ROOT = vars[0]+'//'+vars[2]+'/';
		var tmp_id = tt_currElemId
		var tmp_id_delim = tmp_id.split("_");
		var params = 'e=' + tmp_id_delim[0] + '&rnd='+tmp_id_delim[1];
		//var url = HTTP_ROOT + 'crnrstn/search/tt/';
		var url = HTTP_ROOT + 'search/tt/';
		
		if(!$('tt_'+tt_currElemId)){
			var ttContent = document.createElement("div");
			//ttContent.setAttribute('id','tt_'+element.id);
			ttContent.setAttribute('id','tt_'+tt_currElemId);
			ttContent.setAttribute('class','tooltip_wrapper');
			$(tt_currElemId).appendChild(ttContent);
			
			ttContent.innerHTML = '<div class="tt_logo" style="margin-top:5px;"><img src="'+HTTP_ROOT+'common/imgs/the_R.gif"></div><div class="tt_loader"><img src="'+HTTP_ROOT+'common/imgs/long_loader.gif"></div>';
			
			//
			// FIRE AJAX TOOL TIP :: WEB SERVICES REQUEST
			var ajax = new Ajax.Updater(
			{success: 'tt_'+tt_currElemId},
			url,
			{method: 'get', parameters: params});
			
			clearInterval(tt_timer);
			tt_timer = null;
		}
	}
}

function ttMsOut(element){
	clearInterval(tt_timer);
	tt_timer = null;
}

function toolTipClose(elementid){
	$(elementid).removeChild($('tt_'+elementid));
	tt_locktimer = setTimeout(clear_tt_lock, 500);
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

function numberMe(){
	
}