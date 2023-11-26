// a lowly JS file

var myAjax = "";
var requestedmodule = "";
var mod_urlbase = getbase(window.location)+"content/modules/";

//
// INITIALIZE
Event.observe(window, 'load', initLightbox, false);
Event.observe(window, 'load', initPageContent, false);

function getbase(rooturl){
 
	var live_site = "http://www.jony5.com/";
	var stage_site = "http://j5.pix2flix.net/";
	var orig_base=rooturl+"";
	
	orig_base=orig_base.toLowerCase();
	i=orig_base.indexOf("jony5");
	ii=orig_base.indexOf("evif");
	i=i-0;
	ii=ii-0;

	if(i>0 || ii>0){
		if(i<9){
			window.location="http://www.jony5.com";
		}		
		return live_site;
	}else{
		return stage_site;
	} 
}

function initPageContent(){
	//
	// LETS PULL THIS FROM A COOKIE AT SOME POINT
	var requestedmodule="welcome";
	
	//
	// IF ANY REQUESTED PAGE, THEN OVERWRITE
	var loadQuery = window.location.search.substring(1); 
	var loadvar = loadQuery.split("&"); 
	var loadid="";
	for (var i=0;i<3;i++) { 
		if(loadvar[i]){
			var pair = loadvar[i].split("="); 
			switch(pair[0]){
				case "page":
					requestedmodule = pair[1];
				break;
			}
		}
	} 	
	
	if($("dynform_overlay").style.opacity){
		end_lightbxform()
	}	
	//
	// SHOW PRELOADER
	init_lightbxloading();
	//
	// LOAD CONTENT
 
	content_module = "_mod_"+requestedmodule+".php";
	content_title = "_mod_"+requestedmodule+"_title.php";
	content_nav = "_mod_"+requestedmodule+"_nav.php";
 
	//
	// LOADS MAIN CONTENT
	var contentmodule_url = mod_urlbase + content_module;
	var pars = "";
	var div_ID="dyncontent";
	var ajax = new Ajax.Updater(
	{success: div_ID},
	contentmodule_url,
	{method: 'get', parameters: pars, onFailure: reportError_CONTENT, onComplete:initContent_load });
  
}
 
function update_content_minor(requestedmodule){
	if($("dynform_overlay").style.opacity){
		end_lightbxform()
	}
	//
	// SHOW PRELOADER
	init_lightbxloading();
	//
	// LOAD CONTENT
	minor_moduleload(requestedmodule);
}

function update_content_primary(requestedmodule){
	if($("dynform_overlay").style.opacity){
		end_lightbxform()
	}	
	//
	// SHOW PRELOADER
	init_lightbxloading();
	//
	// LOAD CONTENT
	primary_moduleload(requestedmodule);
}

//
// LIGHTBOX FUNCTIONS
function init_lightbxlongloading(){
	// stretch overlay to fill page and fade in
	var arrayContentSize = getDynContentSize();
	Element.setHeight('dyncontent_overlay', arrayContentSize[1]);
	$("dyncontent_overlay").visibility= "visible";
	$("content_preload").visibility= "visible";
	new Effect.Appear('dyncontent_overlay', { duration: 0.2, from: 0.0, to: 0.3 });
	new Effect.Appear('content_preload', { duration: 0.2, from: 0.0, to: 1 });
	
}

function init_lightbxloading(){
	$("content_preload").visibility= "visible";
	new Effect.Appear('content_preload', { duration: 0.2, from: 0.0, to: 1 });
}

function init_lightbxform(){
	// stretch overlay to fill page and fade in
	var arrayContentSize = getDynContentSize();
	Element.setHeight('dynform_overlay', arrayContentSize[1]);
	$("dynform_overlay").visibility= "visible";
	//$("content_preloadform").visibility= "visible";
	new Effect.Appear('dynform_overlay', { duration: 0.2, from: 0.0, to: 0.3 });
	//new Effect.Appear('content_preloadform', { duration: 0.2, from: 0.0, to: 1 });
}

function end_lightbxform(){
	new Effect.Fade('dyncontent_form', { duration: 0.2});
	new Effect.Fade('content_preloadform', { duration: 0.2});	
	new Effect.Fade('dynform_overlay', { duration: 0.2});
}

//
// REQUEST PRIMARY MODULE UPDATE
function primary_moduleload(pagename){
 
	content_module = "_mod_"+pagename+".php";
	content_title = "_mod_"+pagename+"_title.php";
	content_nav = "_mod_"+pagename+"_nav.php";
 
	//
	// LOADS MAIN CONTENT
	var contentmodule_url = mod_urlbase + content_module;
	var pars = "";
	var div_ID="dyncontent";
	var ajax = new Ajax.Updater(
	{success: div_ID},
	contentmodule_url,
	{method: 'get', parameters: pars, onFailure: reportError_CONTENT, onComplete:initContent_load });
	
	pageTracker._trackPageview('/content/modules/'+pagename);
	//
	// LOADS LEFT NAVIGATION TITLE	
// 	var contentmodule_url = mod_urlbase + content_title;
//	var pars = "";
//	var div_ID="lnav_title";
//	var ajax = new Ajax.Updater(
//	{success: div_ID},
//	contentmodule_url,
//	{method: 'get', parameters: pars, onFailure: reportError_TITLE  });
	
	//
	// LOADS LEFT NAVIGATION NAVIGATION
// 	var contentmodule_url = mod_urlbase + content_nav;
//	var pars = "";
//	var div_ID="lnav_links";
//	var ajax = new Ajax.Updater(
//	{success: div_ID},
//	contentmodule_url,
//	{method: 'get', parameters: pars, onFailure: reportError_NAV });	
}

//
// REQUEST MINOR MODULE UPDATE
function minor_moduleload(pagename){

	content_module = "minor/ecrm101/_mod_"+pagename+".php";

	//
	// LOADS MAIN CONTENT
	var contentmodule_url = mod_urlbase + content_module;
	var pars = "";
	var div_ID="dyncontent";
	var ajax = new Ajax.Updater(
	{success: div_ID},
	contentmodule_url,
	{method: 'get', parameters: pars, onFailure: reportError_CONTENT, onComplete:initContent_load });
}

//
// REQUEST MINOR MODULE UPDATE FOR ADMIN
function minor_ADMINmoduleload(pagename,clientid, campaignid){
	//
	// SHOW PRELOADER
	init_lightbxloading();
	
	content_module = "minor/admin/_mod_"+pagename+".php";
	content_nav = "minor/admin/_mod_"+pagename+"_nav.php";
	
	//
	// LOADS MAIN CONTENT
	var contentmodule_url = mod_urlbase + content_module;
	var pars = "&clientid="+clientid+"&campaignid="+campaignid;
	var div_ID="dyncontent";
	var ajax = new Ajax.Updater(
	{success: div_ID},
	contentmodule_url,
	{method: 'get', parameters: pars, onFailure: reportError_CONTENT, onComplete:initContent_load });
	
	
	//
	// LOADS LEFT NAVIGATION NAVIGATION
 	var contentmodule_url = mod_urlbase + content_nav;
	var pars = "";
	var div_ID="lnav_links";
	var ajax = new Ajax.Updater(
	{success: div_ID},
	contentmodule_url,
	{method: 'get', parameters: pars, onFailure: reportError_NAV });	
}
 

function initContent_load(originalRequest){
	//new Effect.Fade('dyncontent_overlay', { duration: 0.2});
	new Effect.Fade('content_preload', { duration: 0.2});
	
	//
	// CHECK FOR GALLERY LOAD
	if($('gallery_shell')){
		initgalleryContent();
	}
	
	if($("un")){
		document.loginform.un.focus();
		document.loginform.un.select();
	}
}

function gallery_shell(){
	$("gallery_shell").innerHTML="Hello World.";	
}

function loginsubmit(){
	//
	// SHOW PRELOADER
	init_lightbxloading();

	//
	// POST LOGIN DATA
	var postURL = "content/modules/actions/login.php";
	var pars = "&un="+document.loginform.un.value+"&pwd="+document.loginform.pwd.value;
	var div_ID="dyncontent";
	var ajax = new Ajax.Updater(
	{success: div_ID},
	postURL,
	{method: 'post', parameters: pars, onFailure: reportError_CONTENT, onComplete:initContent_load });	
}

function deliverability_submit(){
	var email = document.htmldelivery_form.e.value;
	var myhtml = document.htmldelivery_form.htmlcode.value;
 
	if(validEmail(email) && validReqField(myhtml)){
		var iFrameTrigger = document.getElementById("RSIFrame_trigger").contentWindow.document.getElementById("htmldelivery_form");	
		iFrameTrigger.e.value=document.htmldelivery_form.e.value;
		iFrameTrigger.htmlcode.value=document.htmldelivery_form.htmlcode.value;
		 
		iFrameTrigger.submit();
	
		//
		// SHOW PROCSSING
		$("dynform_response").innerHTML="<div><div class='cb'></div><img src='imgs/long_loader.gif' width='220' height='19' alt='Loading...' /></div>";	
	
		//
		// AFTER A FEW SECONDS, HIDE FORM
		setTimeout("deliverability_confirm();", 2000);
	}else{
		if(!validEmail(email)){
			$("dynform_response").innerHTML="<span style='color:#CC0000;'>Email is missing or invalid.</span>";
		}
		if(!validReqField(myhtml)){
			$("dynform_response").innerHTML=$("dynform_response").innerHTML+"<br><span style='color:#CC0000;'>You must enter HTML code for an email.</span>";	
		}
	}


}

function deliverability_confirm(){
	$("dynform_response").innerHTML="The email request has been delivered.";
}

function htmlqa_submit(){

	var postURL = "content/modules/actions/checkhtml.php";
	var myhtml = document.htmlQA_form.htmlcode.value;

	var iFrameTrigger = document.getElementById("RSIFrame_htmlqa").contentWindow.document.getElementById("htmlQA_form");	
	iFrameTrigger.htmlcode.value=document.htmlQA_form.htmlcode.value;
 
	iFrameTrigger.submit();

	//
	// SHOW PROCSSING
	$("dynform_response").innerHTML="<div><div class='cb'></div><img src='imgs/long_loader.gif' width='220' height='19' alt='Loading...' /></div>";	

	//
	// AFTER A FEW SECONDS, HIDE FORM
	setTimeout("htmlQA_confirm();", 3000);
 
}
 
function htmlQA_confirm(){
	var iFrameTrigger = document.getElementById("RSIFrame_htmlqa").contentWindow.document.getElementById("htmlqa_response");
	$("dynform_response").innerHTML=iFrameTrigger.innerHTML;
}

function resetpassword(){
	//
	// POST LOGIN DATA
	var postURL = "content/modules/actions/pwdsave.php";
	var password=document.passwordreset_form.password.value;
	var passwordconfirm=document.passwordreset_form.passwordconfirm.value;
  	
	if(validPassword(password) && password==passwordconfirm){
	var pars = "&pwd="+password+"&pwdc="+passwordconfirm;
	var div_ID="dyncontent";
 
	//
	// SHOW PRELOADER
	init_lightbxloading();
	
	var ajax = new Ajax.Updater(
	{success: div_ID},
	postURL,
	{method: 'post', parameters: pars, onFailure: reportError_CONTENT, onComplete:initContent_load });	
	}else{
		if(!validPassword(password)){
			alert("Please enter a password thats at least 6 characters long.");
			document.passwordreset_form.passwordconfirm.value="";
		}else{
			if(!(password==passwordconfirm)){
				alert("Your password and confirmation do not match.");
				document.passwordreset_form.passwordconfirm.value="";
			}
		}
	}

}

function passwordreset_submit(){

	//
	// POST LOGIN DATA
	var postURL = "content/modules/actions/pwdreset.php";
	var pars = "&e="+document.reset_password.e.value;
	var div_ID="dynform_response";
	
	//
	// SHOW PROCSSING
	$("dynform_response").innerHTML="<div><div class='cb'></div><img src='imgs/long_loader.gif' width='220' height='19' alt='Loading...' /></div>";	
 
	var ajax = new Ajax.Updater(
	{success: div_ID},
	postURL,
	{method: 'post', parameters: pars, onFailure: reportError_CONTENT});	
	

}

function launch_ltbx_form(formname){
	init_lightbxform();
	display_form(formname);
}
 
function returntop(){
	new Effect.ScrollTo("shell");
}

function display_form(formname){
	var content_module=content_module +"forms/";
	
	switch(formname){
		case "pwdreset":
			content_module="forms/_form_pwdreset.php";
		break;
		case "htmlqa":
			content_module="forms/_form_htmlcheck.php";
		break;
		case "deliveryqa":
			content_module="forms/_form_deliverability.php";
		break;
		case "newcampaign":
			content_module="forms/admin/_form_newcampaign.php";
		break;
	}

	//
	// DISPLAY SELECTED FORM
	var contentmodule_url = mod_urlbase + content_module;
	var pars = "";
	var div_ID="dyncontent_form";
	var ajax = new Ajax.Updater(
	{success: div_ID},
	contentmodule_url,
	{method: 'get', parameters: pars, onFailure: reportError_CONTENT, onComplete:show_dynform});
	
}
function show_dynform(){
	new Effect.Appear('dyncontent_form', { duration: 0.2, from: 0.0, to: 1 });	
}
 
function reportError_CONTENT(){
	//$("dyncontent").innerHTML = "This feature is under development. Please check back later.";
	//
	// LOADS WELCOME CONTENT
	var contentmodule_url = "http://j5.pix2flix.net/content/modules/_mod_contentload_err.php";
	var pars = "";
	var div_ID="dyncontent";
	var ajax = new Ajax.Updater(
	{success: div_ID},
	contentmodule_url,
	{method: 'get', parameters: pars, onFailure: reportError_CONTENT, onComplete:initContent_load });	
}
function reportError_NAV(){
	 
}
function reportError_TITLE(){
	 
}

function openpopup(url, width, height){
	window.open(url, 'ecrm_pop','width='+width+',height='+height); 
}


 