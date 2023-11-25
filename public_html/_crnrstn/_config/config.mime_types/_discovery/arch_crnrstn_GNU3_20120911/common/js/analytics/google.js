
//
// INITIALIZE GOOGLE ANALYTICS
function initAnalytics(){
  if(googleAnalytics){
	  // var _gaq = _gaq || [];  // DEFINED GLOBALLY
	  _gaq.push(['_setAccount', mmgiaccnt]);
	  _gaq.push(['_trackPageview']);
	
	  (function() {
		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	  })();	
  }
}

//
// GOOGLE ANALYTICS EVENT TRACKING
function trackThis(_et_category, _et_action, optional_label, optional_value){
	if(eventTracking){
		_gaq.push(['_trackEvent', _et_action, optional_label, optional_value]);
	}
	return true;
}

//
// 	GOOGLE ANALYTICS EVENT TRACKING - MISC
function miscEventTracking(element){
	var tmp=element.id;
	tmp=tmp.toUpperCase();
	if(eventTracking){
		switch(tmp){
			case "DECISIONMAKING":
				var tmpVal=$(tmp).selectedIndex;
				tmpVal=parseInt(tmpVal)-0-1;
				var tmpVal=trackThis(_et_category, _et_action, '17-'+_et_seed+'-decision-making', ""+tmpVal+"");
			break;
			case "INDUSTRY":
				var tmpVal=$(tmp).selectedIndex;
				tmpVal=parseInt(tmpVal)-0-1;
				tmpVal=trackThis(_et_category, _et_action, '18-'+_et_seed+'-industry', ""+tmpVal+"");		
			break;
			case "SERVICELINES":
				var tmpVal=$(tmp).selectedIndex;
				tmpVal=parseInt(tmpVal)-0-1;
				tmpVal=trackThis(_et_category, _et_action, '19-'+_et_seed+'-servicelines', ""+tmpVal+"");
			break;
			case "SMARTPHONETYPE":
				tmpVal=trackThis(_et_category, _et_action, '16-'+_et_seed+'-smartphonetype-'+$(tmp).value);
			break;
			case "DEVICEOWNER_4G":
			case "SMARTPHONEOWNER":
				if(booleanConversion($(tmp).value)){
					var tmpVal=trackThis(_et_category, _et_action, '15-'+_et_seed+'-smartphone-owner', '1');
				}else{
					var tmpVal=trackThis(_et_category, _et_action, '15-'+_et_seed+'-smartphone-owner', '0');
				}
			break;
			case "CUSTOMERSTATUS":
				var tmpVal=trackThis(_et_category, _et_action, '10-'+_et_seed+'-customerstatus-'+$(tmp).value, '');
			break;
			case "PURCHASETYPE":
				var tmpVal=trackThis(_et_category, _et_action, '11-'+_et_seed+'-purchasetype-'+$(tmp).value, '');
			break;
			case "MOBILEALERTOPTIN":
				if(booleanConversion($(tmp).value)){
					var tmpVal=trackThis(_et_category, _et_action, '12-'+_et_seed+'-mobile-optin', '1');
				}else{
					var tmpVal=trackThis(_et_category, _et_action, '12-'+_et_seed+'-mobile-optin', '0');
				}
			break;
			case "EMAILALERTOPTIN":
				if(booleanConversion($(tmp).value)){
					var tmpVal=trackThis(_et_category, _et_action, '13-'+_et_seed+'-email-optin', '1');
				}else{
					var tmpVal=trackThis(_et_category, _et_action, '13-'+_et_seed+'-email-optin', '0');
				}
			break;
		}
	}
}

//
// 	FIRE DEFAULT TRACKING ON CHANGE FOR NONREQUIRED/NONVALIDATED VARIABLES
function fireDefaultTracking(elementid){
	switch(elementid){
		case "SERVICELINES":
			var tmpVal=$(elementid).selectedIndex;
			tmpVal=parseInt(tmpVal)-0-1;
			var tmp=trackThis(_et_category, _et_action, '19-'+_et_seed+'-servicelines', ""+tmpVal+"");
		break;
		case "INDUSTRY":
			var tmpVal=$(elementid).selectedIndex;
			tmpVal=parseInt(tmpVal)-0-1;
			var tmp=trackThis(_et_category, _et_action, '18-'+_et_seed+'-industry', ""+tmpVal+"");
		break;
		case "DECISIONMAKING":
			var tmpVal=$(elementid).selectedIndex;
			tmpVal=parseInt(tmpVal)-0-1;
			var tmpVal=trackThis(_et_category, _et_action, '17-'+_et_seed+'-decision-making', ""+tmpVal+"");
		break;
		case "STATE":
			var tmpVal=$(elementid).selectedIndex;
			tmpVal=parseInt(tmpVal)-0-1;
			var tmp=trackThis(_et_category, _et_action, '08-'+_et_seed+'-state-'+$(elementid).value, ""+tmpVal+"");
		break;
		case "ADDRESS1":
			var tmp=trackThis(_et_category, _et_action, '06-'+_et_seed+'-address1', '');
		break;
		case "CITY":
			var tmp=trackThis(_et_category, _et_action, '07-'+_et_seed+'-city', '');
		break;
		case "COMPANYNAME":
			var tmp=trackThis(_et_category, _et_action, '14-'+_et_seed+'-company-name', '');
		break;
	}
	
	//
	// 	ALWAYS RETURN ZERO. THESE GUYS ARE NEITHER REQUIRED NOR VERIFIED.
	return 0;
}

//
//  TRACK AND MANAGE FORM EXIT REQUESTS
function exitForm(pagelabel){
	//
	// 	GOOGLE ANALYTICS REPORTING
	var tmp=trackThis(_et_category, _et_seed+'-form-exit', pagelabel, '');	
	
	switch(pagelabel){
		case "vzw-logo":
		case "back-to-vzw":
			setTimeout("loadPage()", 1000);
		break;
		case "privacy":
			setTimeout("loadPrivacy()", 1000);
		break;
	}
}

function loadPage(){
	window.location="http://www.verizonwireless.com/b2c/index.html";
}

function loadPrivacy(){
	window.location="http://www.verizonwireless.com/b2c/footer/privacy.jsp";
}
