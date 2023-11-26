//
// Code is Poerty

//
// INITIALIZE GOOGLE ANALYTICS VARS
var enableGoogle=false;

function initGoogle(){
	var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
	document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
	
	try {
		var pageTracker = _gat._getTracker("UA-2181418-7");
		pageTracker._trackPageview();
	} catch(err) {}
}