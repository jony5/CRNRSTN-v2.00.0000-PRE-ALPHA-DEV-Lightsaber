<?php
// ***************************************
// UTILITY FUNCTIONS
// ***************************************

//
// USE THIS TO CONSTRUCT ANONYMOUS OBJECTS
class Object {
	function __construct( ) {
		$n = func_num_args( ) ;
		for ( $i = 0 ; $i < $n ; $i += 2 ) {
			$this->{func_get_arg($i)} = func_get_arg($i + 1) ;
		}
	}
}

$mailClientProfile = new Object(
	'clientname',array("Yahoo (old)","Yahoo (new)","Gmail (old)","Gmail (new)","Live Mail","Hotmail","AOL Web",".Mac Web","Outlook 2003","Outlook 2007","Windows Mail","Mac Mail","Entourage 2004","Entourage 2008","Thunderbird 1.5","Thunderbird 2","AOL 9","AOL 10","AOL Desktop for Mac","Notes 6","Eudora"),
	'Outlook2003', array("y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","n","y","y","y","y","y","y","y","y","y","y","y","y","n","y","n","y","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","y","y"),
	'Outlook2007', array("y","y","y","y","y","y","y","y","y","y","n","y","y","y","y","y","y","y","y","y","n","n","n","n","n","n","n","n","n","n","y","n","n","n","n","n","n","y","y","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","y","y"),
	'WindowsMail', array("y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","n","y","y","y","y","y","y","y","y","y","y","y","y","n","y","n","y","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","y","y"),
	'MacMail', array("y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","n","y","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","y","y"),
	'Entourage2004', array("y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","n","y","n","y","y","y","y","y","y","n","y","y","y","y","y","n","y","y","y","y","y","y","y","y","n","y","n","y","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","y","y"),
	'Entourage2008', array("y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","n","y","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","y","y"),
	'Thunderbird15', array("y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","y","y"),
	'Thunderbird2', array("y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","y","y"),
	'AOL9', array("y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","n","y","y","y","y","y","y","n","y","y","y","y","y","y","n","n","y","n","y","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","y","y"),
	'AOL10', array("y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","n","y","y","y","y","y","y","y","y","y","y","y","y","n","y","n","y","n","y","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","y","y"),
	'AOLDesktopforMac', array("n","n","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","n","y","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n"),
	'Notes6', array("n","n","y","y","y","y","y","y","n","n","y","y","n","n","n","n","n","n","n","n","n","y","y","n","n","n","n","y","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","y","y"),
	'Eudora', array("n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n"),
	'OldYahoo', array("y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","n","y","y","y","y","y","n","y","y","y","n","y","y","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n"),
	'NewYahoo', array("y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","n","y","y","y","y","n","n","n","n","y","y","n","y","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","y","y"),
	'OldGmail', array("n","n","y","y","y","y","y","y","y","y","y","n","y","y","y","y","y","y","y","y","y","y","n","y","y","y","n","y","y","n","y","n","n","y","n","n","y","y","n","n","n","n","n","y","n","y","n","y","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n"),
	'NewGmail', array("n","n","y","y","y","y","y","y","y","y","y","n","y","y","y","y","y","y","y","y","y","n","y","y","y","y","y","y","y","n","y","n","n","n","n","n","y","y","n","n","n","n","n","y","n","y","n","y","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n"),
	'LiveMail', array("y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","n","n","n","y","n","y","n","n","n","n","n","n","n","n","y","n","y","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","y","y"),
	'Hotmail', array("n","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","n","y","y","y","y","y","y","y","y","n","n","y","y","y","y","n","n","y","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n"),
	'AOLWeb', array("y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","n","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","y","y"),
	'MacWeb', array("y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","n","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","y","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","n","y","y")
	) ;
 //
 //	style(0) and link(1) are for instances in header
 //	style(81) and link(82) are for instances in body
$targetPatterns = new Object(
	'pattern', array("<style","<style", "color:", "font-size:", "font-style:", "font-weight:", "text-align:", "text-decoration:", "background-color:", "border:", "display:", "font-family:", "font-variant:", "letter-spacing:", "line-height:", "padding:", "table-layout:", "text-indent:", "text-transform:", "border-collapse:", "clear:", "direction:", "float:", "vertical-align:", "width:", "word-spacing:", "height:",  "list-style-type:","overflow:","visibility:",  "white-space:",  "background-image:","background-repeat:",  "clip:", "cursor:", "list-style-image:", "list-style-position:", "margin:", "z-index:", "left:", "right:", "top:", "background-position:", "border-spacing:", "bottom:", "empty-cells:", "position:", "caption-side:", "opacity:","<ul", "<li", "<p", "<big", "<center", "<dd", "<dl", "<dt", "<em>", "<embed>",  "<form", "<h1", "<h2", "<h3",  "<h4", "<h5", "<h6", "<input>", "<ol>", "<option", "<select", "<button", "<label", "<fieldset",  "<script",  "<noscript", "<small>", "<th", "<tt", "<textarea","<object","<param","<tbody","<link","<link")) ;	

$EMAIL_SCORE = new Object('s_count', 0) ;	

// FUNCTIONS TO RETURN SPECIFIC VALUES
function strstrbi($haystack, $needle, $before_needle, $include_needle, $case_sensitive) {
//Find the position of $needle
	if((strlen($haystack)>0)&& (strlen($needle)>0)){
		if($case_sensitive) {
			$pos=strpos($haystack,$needle);
		} else {
			$pos=strpos(strtolower($haystack),strtolower($needle));
		}
	}
	//If $needle not found, abort
	if($pos===FALSE) return FALSE;
	
	//Adjust $pos to include/exclude the needle
	if($before_needle==$include_needle) $pos+=strlen($needle);
	
	//get everything from 0 to $pos?
	if($before_needle) return substr($haystack,0,$pos);
	
	//otherwise, go from $pos to end
	return substr($haystack,$pos);
}

function getdot_HTML($errcount){	
	$count=0;
	$dot_HTML="";
	if($errcount>0){
		$count++;
		$dot_HTML = "<td><div class='dot'><img src='../../imgs/dot_off.gif' width='12' height='17' alt='' /></div></td>";
	}
	if($errcount>2){
		$count++;
		$dot_HTML=$dot_HTML."<td><div class='dot'><img src='../../imgs/dot_off.gif' width='12' height='17' alt='' /></div></td>";
	}
	if($errcount>5){
		$count++;
		$dot_HTML=$dot_HTML."<td><div class='dot'><img src='../../imgs/dot_off.gif' width='12' height='17' alt='' /></div></td>";
	}
	if($errcount>7){
		$count++;
		$dot_HTML=$dot_HTML."<td><div class='dot'><img src='../../imgs/dot_off.gif' width='12' height='17' alt='' /></div></td>";
	}
	if($errcount>10){
		$count++;
		$dot_HTML= "<td><div class='dot'><img src='../../imgs/dot_red.gif' width='12' height='17' alt='' /></div></td>".$dot_HTML;
	}
	while($count<5){
		$dot_HTML= "<td><div class='dot'><img src='../../imgs/dot_grn.gif' width='12' height='17' alt='' /></div></td>".$dot_HTML;
		$count++;
	}

	return $dot_HTML;
}

function return_score($test_results){
	if($test_results>1735){
		$score_HTML= "<img src='../../imgs/overall_5.jpg' width='425' height='233' alt='' title=''/>";
		return $score_HTML;
	}
	if($test_results<1500){
		$score_HTML= "<img src='../../imgs/overall_1.jpg' width='425' height='233' alt='' title=''/>";
		return $score_HTML;
	}	
	if($test_results<1600){
		$score_HTML= "<img src='../../imgs/overall_2.jpg' width='425' height='233' alt='' title=''/>";
		return $score_HTML;
	}
	if($test_results<1700){
		$score_HTML= "<img src='../../imgs/overall_3.jpg' width='425' height='233' alt='' title=''/>";
		return $score_HTML;
	}
	if($test_results<1736){
		$score_HTML= "<img src='../../imgs/overall_4.jpg' width='425' height='233' alt='' title=''/>";
		return $score_HTML;
	}

}


/*

Yahoo (old)
Yahoo (new)
Gmail (old)
Gmail (new)
Live Mail
Hotmail
AOL Web
.Mac Web
Outlook 2003
Outlook2 007
Windows Mail
Mac Mail
Entourage 2004
Entourage 2008
Thunderbird 1.5
Thunderbird 2
AOL 9
AOL 10
AOL Desktop for Mac
Notes 6
Eudora

<style> element In <head>
<style> element In <body>
<link> element in <head>
<link> element in <body>

CSS Selectors
e 
* 
e.className 
e#id 
e:link 
e:active, e:hover 
e:first-line 
e:first-letter 
e > f 
e:focus 
e+f 
e[foo] 

CSS Properties
color 
font-size 
font-style 
font-weight 
text-align 
text-decoration 
background-color 
border 
display 
font-family 
font-variant 
letter-spacing 
line-height 
padding 
table-layout 
text-indent 
text-transform 
border-collapse 
clear 
direction 
float 
vertical-align 
width 
word-spacing 
height 
list-style-type 
overflow 
visibility 
white-space 
background-image 
background-repeat 
clip 
cursor 
list-style-image 
list-style-position 
margin 
z-index 
left 
right 
top 
background-position 
border-spacing 
bottom 
empty-cells 
position 
caption-side 
opacity

*/         

function patternCheck($htmlcode,$targetPatterns){
	$tempArray=$targetPatterns->pattern;
	$numcheck=sizeof($tempArray);
	//echo "Number of patterns to check for: $numcheck<br>";
	$haystack=strtolower($htmlcode);
	
	
	for($i=2; $i<$numcheck; $i++){
		$mypattern=$targetPatterns->pattern[$i];
		$css_pos[$i]=strpos($haystack,$targetPatterns->pattern[$i]);
	}
	//
	// CHECK HEAD FOR STUFF
	$upperbound=strstrbi($haystack, "<body",TRUE,FALSE,FALSE);  // this trims BODY out of the equation. upperbound==head
	//$position_head=strpos($haystack,"</head>");
	$i=0;	//<style in head
	$css_pos[$i]=strpos($upperbound,$targetPatterns->pattern[$i]);
	$i=82;	//<link in head
	$css_pos[$i]=strpos($upperbound,$targetPatterns->pattern[$i]);

	//
	// CHECK BODY FOR STUFF
	$upperbound=strstrbi($haystack, "</head>",FALSE,FALSE,FALSE); // this trims HEAD out of the equation. upperbound==body
	$i=1;	//<style in body
	$css_pos[$i]=strpos($upperbound,$targetPatterns->pattern[$i]);
	$i=83;	//<link in body
	$css_pos[$i]=strpos($upperbound,$targetPatterns->pattern[$i]);
	
 	return $css_pos;
}

function check_head($currentpage,$TARGETCHARS){
	//
	// TARGET CHARS
	$UPPERBOUND="</head>";
	//
	// GET INDEXOF ACTIVITY STAMP
	$upperbound=strstrbi($currentpage, $TARGETCHARS,FALSE,FALSE,FALSE);
	$indexof_TARGETCHARS=strlen($upperbound);
	$upperbound=strstrbi($upperbound, $UPPERBOUND,TRUE,FALSE,FALSE);

	return $upperbound;
}

function cleanupCode($htmlcode){
	$htmlcode=str_replace("padding-left:", "padding:", $htmlcode);
	$htmlcode=str_replace("padding-right:", "padding:", $htmlcode);
	$htmlcode=str_replace("padding-bottom:", "padding:", $htmlcode);
	$htmlcode=str_replace("padding-top:", "padding:", $htmlcode);
	$htmlcode=str_replace("margin-left:", "margin:", $htmlcode);
	$htmlcode=str_replace("margin-right:", "margin:", $htmlcode);
	$htmlcode=str_replace("margin-bottom:", "margin:", $htmlcode);
	$htmlcode=str_replace("margin-top:", "margin:", $htmlcode);
 
	return $htmlcode;
}

//
// GET CODE
$htmlcode= $_POST['H'];
$htmlcode=cleanupCode($htmlcode);
//
// GET ARRAY WITH -1 OR NN SET FOR MATCHES AGAINST POSTED HTML
$test_results = patternCheck($htmlcode,$targetPatterns); 
$results_count=sizeof($test_results);

//
// Outlook2003 
for($i=0; $i<$results_count; $i++){
	if($test_results[$i]>0 && $mailClientProfile->Outlook2003[$i]=="n"){
		$flag_match_Outlook2003[$i]=1;
	}else{
		$flag_match_Outlook2003[$i]=0;
		$EMAIL_SCORE->s_count=$EMAIL_SCORE->s_count+1;
	}
}
 
//
//  Outlook2007 
for($i=0; $i<$results_count; $i++){
	if($test_results[$i]>0 && $mailClientProfile->Outlook2007[$i]=="n"){
		$flag_match_Outlook2007[$i]=1;
	}else{
		$flag_match_Outlook2007[$i]=0;
		$EMAIL_SCORE->s_count=$EMAIL_SCORE->s_count+1;
	}
}
 

//
//  WindowsMail 
for($i=0; $i<$results_count; $i++){
	if($test_results[$i]>0 && $mailClientProfile->WindowsMail[$i]=="n"){
		$flag_match_WindowsMail[$i]=1;
	}else{
		$flag_match_WindowsMail[$i]=0;
		$EMAIL_SCORE->s_count=$EMAIL_SCORE->s_count+1;
	}
} 
//
//  MacMail 
for($i=0; $i<$results_count; $i++){
	if($test_results[$i]>0 && $mailClientProfile->MacMail[$i]=="n"){
		$flag_match_MacMail[$i]=1;
	}else{
		$flag_match_MacMail[$i]=0;
		$EMAIL_SCORE->s_count=$EMAIL_SCORE->s_count+1;
	}
}
 
//
//  Entourage2004 
for($i=0; $i<$results_count; $i++){
	if($test_results[$i]>0 && $mailClientProfile->Entourage2004[$i]=="n"){
		$flag_match_Entourage2004[$i]=1;
	}else{
		$flag_match_Entourage2004[$i]=0;
		$EMAIL_SCORE->s_count=$EMAIL_SCORE->s_count+1;
	}
}
 
//  Entourage2008 
for($i=0; $i<$results_count; $i++){
	if($test_results[$i]>0 && $mailClientProfile->Entourage2008[$i]=="n"){
		$flag_match_Entourage2008[$i]=1;
	}else{
		$flag_match_Entourage2008[$i]=0;
		$EMAIL_SCORE->s_count=$EMAIL_SCORE->s_count+1;
	}
}
 

//
//  Thunderbird15 
for($i=0; $i<$results_count; $i++){
	if($test_results[$i]>0 && $mailClientProfile->Thunderbird15[$i]=="n"){
		$flag_match_Thunderbird15[$i]=1;
	}else{
		$flag_match_Thunderbird15[$i]=0;
		$EMAIL_SCORE->s_count=$EMAIL_SCORE->s_count+1;
	}
}

 

//
//  Thunderbird2 
for($i=0; $i<$results_count; $i++){
	if($test_results[$i]>0 && $mailClientProfile->Thunderbird2[$i]=="n"){
		$flag_match_Thunderbird2[$i]=1;
	}else{
		$flag_match_Thunderbird2[$i]=0;
		$EMAIL_SCORE->s_count=$EMAIL_SCORE->s_count+1;
	}
}
 

//
//  AOL9  
for($i=0; $i<$results_count; $i++){
	if($test_results[$i]>0 && $mailClientProfile->AOL9[$i]=="n"){
		$flag_match_AOL9[$i]=1;
	}else{
		$flag_match_AOL9[$i]=0;
		$EMAIL_SCORE->s_count=$EMAIL_SCORE->s_count+1;
	}
}
 

//
//  AOL10 
for($i=0; $i<$results_count; $i++){
	if($test_results[$i]>0 && $mailClientProfile->AOL10[$i]=="n"){
		$flag_match_AOL10[$i]=1;
	}else{
		$flag_match_AOL10[$i]=0;
		$EMAIL_SCORE->s_count=$EMAIL_SCORE->s_count+1;
	}
}
 
//
//  AOLDesktopforMac 
for($i=0; $i<$results_count; $i++){
	if($test_results[$i]>0 && $mailClientProfile->AOLDesktopforMac[$i]=="n"){
		$flag_match_AOLDesktopforMac[$i]=1;
	}else{
		$flag_match_AOLDesktopforMac[$i]=0;
		$EMAIL_SCORE->s_count=$EMAIL_SCORE->s_count+1;
	}
}
 

//
//  Notes6 
for($i=0; $i<$results_count; $i++){
	if($test_results[$i]>0 && $mailClientProfile->Notes6[$i]=="n"){
		$flag_match_Notes6[$i]=1;
	}else{
		$flag_match_Notes6[$i]=0;
		$EMAIL_SCORE->s_count=$EMAIL_SCORE->s_count+1;
	}
}
 

//
//  Eudora 
for($i=0; $i<$results_count; $i++){
	if($test_results[$i]>0 && $mailClientProfile->Eudora[$i]=="n"){
		$flag_match_Eudora[$i]=1;
	}else{
		$flag_match_Eudora[$i]=0;
		$EMAIL_SCORE->s_count=$EMAIL_SCORE->s_count+1;
	}
} 

//
//  OldYahoo 
for($i=0; $i<$results_count; $i++){
	if($test_results[$i]>0 && $mailClientProfile->OldYahoo[$i]=="n"){
		$flag_match_OldYahoo[$i]=1;
	}else{
		$flag_match_OldYahoo[$i]=0;
		$EMAIL_SCORE->s_count=$EMAIL_SCORE->s_count+1;
	}
}
 

//
//  NewYahoo 
for($i=0; $i<$results_count; $i++){
	if($test_results[$i]>0 && $mailClientProfile->NewYahoo[$i]=="n"){
		$flag_match_NewYahoo[$i]=1;
	}else{
		$flag_match_NewYahoo[$i]=0;
		$EMAIL_SCORE->s_count=$EMAIL_SCORE->s_count+1;
	}
}
 
//
//  OldGmail  
for($i=0; $i<$results_count; $i++){
	if($test_results[$i]>0 && $mailClientProfile->OldGmail[$i]=="n"){
		$flag_match_OldGmail[$i]=1;
	}else{
		$flag_match_OldGmail[$i]=0;
		$EMAIL_SCORE->s_count=$EMAIL_SCORE->s_count+1;
	}
}
 

//
//  NewGmail 
for($i=0; $i<$results_count; $i++){
	if($test_results[$i]>0 && $mailClientProfile->NewGmail[$i]=="n"){
		$flag_match_NewGmail[$i]=1;
	}else{
		$flag_match_NewGmail[$i]=0;
		$EMAIL_SCORE->s_count=$EMAIL_SCORE->s_count+1;
	}
}
 

//
//  LiveMail 
for($i=0; $i<$results_count; $i++){
	if($test_results[$i]>0 && $mailClientProfile->LiveMail[$i]=="n"){
		$flag_match_LiveMail[$i]=1;
	}else{
		$flag_match_LiveMail[$i]=0;
		$EMAIL_SCORE->s_count=$EMAIL_SCORE->s_count+1;
	}
}
 

//
//  Hotmail 
for($i=0; $i<$results_count; $i++){
	if($test_results[$i]>0 && $mailClientProfile->Hotmail[$i]=="n"){
		$flag_match_Hotmail[$i]=1;
	}else{
		$flag_match_Hotmail[$i]=0;
		$EMAIL_SCORE->s_count=$EMAIL_SCORE->s_count+1;
	}
}
 
//
//  AOLWeb 
for($i=0; $i<$results_count; $i++){
	if($test_results[$i]>0 && $mailClientProfile->AOLWeb[$i]=="n"){
		$flag_match_AOLWeb[$i]=1;
	}else{
		$flag_match_AOLWeb[$i]=0;
		$EMAIL_SCORE->s_count=$EMAIL_SCORE->s_count+1;
	}
}
 
//
//  .MacWeb 
for($i=0; $i<$results_count; $i++){
	if($test_results[$i]>0 && $mailClientProfile->MacWeb[$i]=="n"){
		$flag_match_MacWeb[$i]=1;
	}else{
		$flag_match_MacWeb[$i]=0;
		$EMAIL_SCORE->s_count=$EMAIL_SCORE->s_count+1;
	}
}

//
// FLAGGED ALL OCCURENCES. NOW MATCH AGAINST MAIL CLIENT
$my_grade_img=return_score($EMAIL_SCORE->s_count);
//
// 48 items to QA...to do a straight association to a 5 point system...9.6 items per point


/*
$flag_match_Outlook2007
$flag_match_WindowsMail
$flag_match_MacMail
$flag_match_Entourage2004
$flag_match_Entourage2008
$flag_match_Thunderbird15
$flag_match_Thunderbird2
$flag_match_AOL9
$flag_match_AOL10
$flag_match_AOLDesktopforMac
$flag_match_Notes6
$flag_match_Eudora
$flag_match_OldYahoo
$flag_match_NewYahoo
$flag_match_OldGmail
$flag_match_NewYahoo
$flag_match_LiveMail
$flag_match_Hotmail
$flag_match_AOLWeb
$flag_match_MacWeb
*/

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="description" content="Professional web development and email marketing by J5." />
<meta name="keywords" content="j5, jonathan harris, jonathan, web standards, email, marketing, CSS, XHTML, email validator, validator, freelance, web design, web development, php, php development, moxie interactive, atlanta, moxie" />
<link rel="stylesheet" href="../../css/common.css" type="text/css" media="all" />
<script language="javascript" src="../../js/prototype.js" type="text/javascript"></script>
<script language="javascript" src="../../js/common.js" type="text/javascript"></script>
<title>J5 | Web Developer &amp; Email Marketer</title> 
</head>

<body>
<div id="shell">
	<div id="header">
		<div class="hdrtop"><a href="http://www.jony5.com" target="_self"><img src="../../imgs/j5_logo.gif" width="32" height="40" border="0" alt="| J5" title="| J5" /></a></div>
		<div class="hdrbtm"></div>
	</div>
	<div id="content_wrapper">
		<div class="module">
			<table width="790">
			<tr>
				<td>
				 <div class="results_wrapper">
					<div><img src="../../imgs/title_resuts.gif" width="122" height="53" alt="results" title="results" /></div>
					<p><?php echo $my_grade_img;  ?></p>
			 	</div>
				</td>
				<td valign="top">
				<div><img src="../../imgs/email_icon.jpg" width="201" height="185" alt="email" /></div>
 				</td>
			</tr>			
			</table>
		</div>
		<div class="module">
			<table width="790">
			<tr>
				<td>
			 	<div class="results_wrapper">
					<div class="subtitle">Performance Comparison</div>
					<h2>Web Clients</h2>
					<div class="pcomp_yin">
					<table>
					<tr>
						<td><div class="client_title">&nbsp;</div></td>
						<td colspan="2" style="padding-left:5px;">poor</td>
						<td><div class="dot"><img src="../../imgs/dot_off.gif" width="12" height="17" alt="" /></div></td>
						<td><div class="dot"><img src="../../imgs/dot_off.gif" width="12" height="17" alt="" /></div></td>
						<td colspan="2">excellent</td>
					</tr>					
					<tr>
						<td><div class="client_title">Yahoo (old)</div></td>
						<?
							$errcount=0;
							for($i=0; $i<$results_count; $i++){
								if($flag_match_OldYahoo[$i]==1){
									$errcount++;
								}
							}
							echo getdot_HTML($errcount);
						?>
						<td><div class="v_details" onclick="$('client_0').scrollTo();"><table><tr><td><img src="../../imgs/details_icon.gif" width="18" height="17" alt="O" /></td><td width="85"><?php if($errcount>0){echo "<div class='issues_fnd_err'>$errcount issues found</div>";}else{ echo "No issues found.";} ?></td></tr></table></div></td>
					</tr>
					</table>
					</div>
					<div class="pcomp_yang">
					<table>
					<tr>
						<td><div class="client_title">Yahoo (new)</div></td>
						<? 
							$errcount=0;
							for($i=0; $i<$results_count; $i++){
									if($flag_match_NewYahoo[$i]==1){
										$errcount++;
									}
							}
							echo getdot_HTML($errcount);
						?>
						<td><div class="v_details" onclick="$('client_1').scrollTo();"><table><tr><td><img src="../../imgs/details_icon.gif" width="18" height="17" alt="O" /></td><td width="85"><?php if($errcount>0){echo "<div class='issues_fnd_err'>$errcount issues found</div>";}else{ echo "No issues found.";} ?></td></tr></table></div></td>
					</tr>
					</table>
					</div>				
					<div class="pcomp_yin">
					<table>
					<tr>
						<td><div class="client_title">Gmail	(old)</div></td>
						<?
							$errcount=0;
							for($i=0; $i<$results_count; $i++){
									if($flag_match_OldGmail[$i]==1){
										$errcount++;
									}
							}
							echo getdot_HTML($errcount);
						?>
						<td><div class="v_details" onclick="$('client_2').scrollTo();"><table><tr><td><img src="../../imgs/details_icon.gif" width="18" height="17" alt="O" /></td><td width="85"><?php if($errcount>0){echo "<div class='issues_fnd_err'>$errcount issues found</div>";}else{ echo "No issues found.";} ?></td></tr></table></div></td>
					</tr>
					</table>
					</div>
					<div class="pcomp_yang">
					<table>
					<tr>
						<td><div class="client_title">Gmail (new)</div></td>
						<?
							$errcount=0;
							for($i=0; $i<$results_count; $i++){
									if($flag_match_NewGmail[$i]==1){
										$errcount++;
									}
							}
							echo getdot_HTML($errcount);
						?>
						<td><div class="v_details" onclick="$('client_3').scrollTo();"><table><tr><td><img src="../../imgs/details_icon.gif" width="18" height="17" alt="O" /></td><td width="85"><?php if($errcount>0){echo "<div class='issues_fnd_err'>$errcount issues found</div>";}else{ echo "No issues found.";} ?></td></tr></table></div></td>
					</tr>
					</table>
					</div>	
					<div class="pcomp_yin">
					<table>
					<tr>
						<td><div class="client_title">Live Mail</div></td>
						<?
							$errcount=0;
							for($i=0; $i<$results_count; $i++){
									if($flag_match_LiveMail[$i]==1){
										$errcount++;
									}
							}
							echo getdot_HTML($errcount);
						?>
						<td><div class="v_details" onclick="$('client_4').scrollTo();"><table><tr><td><img src="../../imgs/details_icon.gif" width="18" height="17" alt="O" /></td><td width="85"><?php if($errcount>0){echo "<div class='issues_fnd_err'>$errcount issues found</div>";}else{ echo "No issues found.";} ?></td></tr></table></div></td>
					</tr>
					</table>
					</div>
					<div class="pcomp_yang">
					<table>
					<tr>
						<td><div class="client_title">Hotmail</div></td>
						<?
							$errcount=0;
							for($i=0; $i<$results_count; $i++){
									if($flag_match_Hotmail[$i]==1){
										$errcount++;
									}
							}
							echo getdot_HTML($errcount);
						?>
						<td><div class="v_details" onclick="$('client_5').scrollTo();"><table><tr><td><img src="../../imgs/details_icon.gif" width="18" height="17" alt="O" /></td><td width="85"><?php if($errcount>0){echo "<div class='issues_fnd_err'>$errcount issues found</div>";}else{ echo "No issues found.";} ?></td></tr></table></div></td>
					</tr>
					</table>
					</div>	
					<div class="pcomp_yin">
					<table>
					<tr>
						<td><div class="client_title">AOL Web</div></td>
						<?
							$errcount=0;
							for($i=0; $i<$results_count; $i++){
									if($flag_match_AOLWeb[$i]==1){
										$errcount++;
									}
							}
							echo getdot_HTML($errcount);
						?>
						<td><div class="v_details" onclick="$('client_6').scrollTo();"><table><tr><td><img src="../../imgs/details_icon.gif" width="18" height="17" alt="O" /></td><td width="85"><?php if($errcount>0){echo "<div class='issues_fnd_err'>$errcount issues found</div>";}else{ echo "No issues found."; } ?></td></tr></table></div></td>
					</tr>
					</table>
					</div>
					<div class="pcomp_yang">
					<table>
					<tr>
						<td><div class="client_title">.Mac Web</div></td>
						<?
							$errcount=0;
							for($i=0; $i<$results_count; $i++){
									if($flag_match_MacWeb[$i]==1){
										$errcount++;
									}
							}
							echo getdot_HTML($errcount);
						?>
						<td><div class="v_details" onclick="$('client_7').scrollTo();"><table><tr><td><img src="../../imgs/details_icon.gif" width="18" height="17" alt="O" /></td><td width="85"><?php if($errcount>0){echo "<div class='issues_fnd_err'>$errcount issues found</div>";}else{ echo "No issues found.";} ?></td></tr></table></div></td>
					</tr>
					</table>
					</div>		
					<br />															
					<h2>Desktop Clients</h2>
					<div class="pcomp_yin">
					<table>
					<tr>
						<td><div class="client_title">&nbsp;</div></td>
						<td colspan="2" style="padding-left:5px;">poor</td>
						<td><div class="dot"><img src="../../imgs/dot_off.gif" width="12" height="17" alt="" /></div></td>
						<td><div class="dot"><img src="../../imgs/dot_off.gif" width="12" height="17" alt="" /></div></td>
						<td colspan="2">excellent</td>
					</tr>					
					<tr>
						<td><div class="client_title">Outlook 2003</div></td>
						<?
							$errcount=0;
							for($i=0; $i<$results_count; $i++){
									if($flag_match_Outlook2003[$i]==1){
										$errcount++;
									}
							}
							echo getdot_HTML($errcount);
						?>
						<td><div class="v_details" onclick="$('client_8').scrollTo();"><table><tr><td><img src="../../imgs/details_icon.gif" width="18" height="17" alt="O" /></td><td width="85"><?php if($errcount>0){echo "<div class='issues_fnd_err'>$errcount issues found</div>";}else{ echo "No issues found.";} ?></td></tr></table></div></td>
					</tr>
					</table>
					</div>
					<div class="pcomp_yang">
					<table>
					<tr>
						<td><div class="client_title">Outlook 2007</div></td>
						<?
							$errcount=0;
							for($i=0; $i<$results_count; $i++){
									if($flag_match_Outlook2007[$i]==1){
										$errcount++;
									}
							}
							echo getdot_HTML($errcount);
						?>
						<td><div class="v_details" onclick="$('client_9').scrollTo();"><table><tr><td><img src="../../imgs/details_icon.gif" width="18" height="17" alt="O" /></td><td width="85"><?php if($errcount>0){echo "<div class='issues_fnd_err'>$errcount issues found</div>";}else{ echo "No issues found.";} ?></td></tr></table></div></td>
					</tr>
					</table>
					</div>				
					<div class="pcomp_yin">
					<table>
					<tr>
						<td><div class="client_title">Windows Mail</div></td>
						<?
							$errcount=0;
							for($i=0; $i<$results_count; $i++){
									if($flag_match_WindowsMail[$i]==1){
										$errcount++;
									}
							}
							echo getdot_HTML($errcount);
						?>
						<td><div class="v_details" onclick="$('client_10').scrollTo();"><table><tr><td><img src="../../imgs/details_icon.gif" width="18" height="17" alt="O" /></td><td width="85"><?php if($errcount>0){echo "<div class='issues_fnd_err'>$errcount issues found</div>";}else{ echo "No issues found.";} ?></td></tr></table></div></td>
					</tr>
					</table>
					</div>
					<div class="pcomp_yang">
					<table>
					<tr>
						<td><div class="client_title">Mac Mail</div></td>
						<?
							$errcount=0;
							for($i=0; $i<$results_count; $i++){
									if($flag_match_MacMail[$i]==1){
										$errcount++;
									}
							}
							echo getdot_HTML($errcount);
						?>
						<td><div class="v_details" onclick="$('client_11').scrollTo();"><table><tr><td><img src="../../imgs/details_icon.gif" width="18" height="17" alt="O" /></td><td width="85"><?php if($errcount>0){echo "<div class='issues_fnd_err'>$errcount issues found</div>";}else{ echo "No issues found.";} ?></td></tr></table></div></td>
					</tr>
					</table>
					</div>	
					<div class="pcomp_yin">
					<table>
					<tr>
						<td><div class="client_title">Entourage 2004</div></td>
						<?
							$errcount=0;
							for($i=0; $i<$results_count; $i++){
									if($flag_match_Entourage2004[$i]==1){
										$errcount++;
									}
							}
							echo getdot_HTML($errcount);
						?>
						<td><div class="v_details" onclick="$('client_12').scrollTo();"><table><tr><td><img src="../../imgs/details_icon.gif" width="18" height="17" alt="O" /></td><td width="85"><?php if($errcount>0){echo "<div class='issues_fnd_err'>$errcount issues found</div>";}else{ echo "No issues found.";} ?></td></tr></table></div></td>
					</tr>
					</table>
					</div>
					<div class="pcomp_yang">
					<table>
					<tr>
						<td><div class="client_title">Entourage 2008</div></td>
						<?
							$errcount=0;
							for($i=0; $i<$results_count; $i++){
									if($flag_match_Entourage2008[$i]==1){
										$errcount++;
									}
							}
							echo getdot_HTML($errcount);
						?>
						<td><div class="v_details" onclick="$('client_13').scrollTo();"><table><tr><td><img src="../../imgs/details_icon.gif" width="18" height="17" alt="O" /></td><td width="85"><?php if($errcount>0){echo "<div class='issues_fnd_err'>$errcount issues found</div>";}else{ echo "No issues found.";} ?></td></tr></table></div></td>
					</tr>
					</table>
					</div>	
					<div class="pcomp_yin">
					<table>
					<tr>
						<td><div class="client_title">Thunderbird 1.5</div></td>
						<?
							$errcount=0;
							for($i=0; $i<$results_count; $i++){
									if($flag_match_Thunderbird15[$i]==1){
										$errcount++;
									}
							}
							echo getdot_HTML($errcount);
						?>
						<td><div class="v_details" onclick="$('client_14').scrollTo();"><table><tr><td><img src="../../imgs/details_icon.gif" width="18" height="17" alt="O" /></td><td width="85"><?php if($errcount>0){echo "<div class='issues_fnd_err'>$errcount issues found</div>";}else{ echo "No issues found.";} ?></td></tr></table></div></td>
					</tr>
					</table>
					</div>
					<div class="pcomp_yang">
					<table>
					<tr>
						<td><div class="client_title">Thunderbird 2</div></td>
						<?
							$errcount=0;
							for($i=0; $i<$results_count; $i++){
									if($flag_match_Thunderbird2[$i]==1){
										$errcount++;
									}
							}
							echo getdot_HTML($errcount);
						?>
						<td><div class="v_details" onclick="$('client_15').scrollTo();"><table><tr><td><img src="../../imgs/details_icon.gif" width="18" height="17" alt="O" /></td><td width="85"><?php if($errcount>0){echo "<div class='issues_fnd_err'>$errcount issues found</div>";}else{ echo "No issues found.";} ?></td></tr></table></div></td>
					</tr>
					</table>
					</div>																	
					<div class="pcomp_yin">
					<table>			
					<tr>
						<td><div class="client_title">AOL 9</div></td>
						<?
							$errcount=0;
							for($i=0; $i<$results_count; $i++){
									if($flag_match_AOL9[$i]==1){
										$errcount++;
									}
							}
							echo getdot_HTML($errcount);
						?>
						<td><div class="v_details" onclick="$('client_16').scrollTo();"><table><tr><td><img src="../../imgs/details_icon.gif" width="18" height="17" alt="O" /></td><td width="85"><?php if($errcount>0){echo "<div class='issues_fnd_err'>$errcount issues found</div>";}else{ echo "No issues found.";} ?></td></tr></table></div></td>
					</tr>
					</table>
					</div>
					<div class="pcomp_yang">
					<table>
					<tr>
						<td><div class="client_title">AOL 10</div></td>
						<?
							$errcount=0;
							for($i=0; $i<$results_count; $i++){
									if($flag_match_AOL10[$i]==1){
										$errcount++;
									}
							}
							echo getdot_HTML($errcount);
						?>
						<td><div class="v_details" onclick="$('client_17').scrollTo();"><table><tr><td><img src="../../imgs/details_icon.gif" width="18" height="17" alt="O" /></td><td width="85"><?php if($errcount>0){echo "<div class='issues_fnd_err'>$errcount issues found</div>";}else{ echo "No issues found.";} ?></td></tr></table></div></td>
					</tr>
					</table>
					</div>				
					<div class="pcomp_yin">
					<table>
					<tr>
						<td><div class="client_title">AOL Desktop for Mac</div></td>
						<?
							$errcount=0;
							for($i=0; $i<$results_count; $i++){
									if($flag_match_AOLDesktopforMac[$i]==1){
										$errcount++;
									}
							}
							echo getdot_HTML($errcount);
						?>
						<td><div class="v_details" onclick="$('client_18').scrollTo();"><table><tr><td><img src="../../imgs/details_icon.gif" width="18" height="17" alt="O" /></td><td width="85"><?php if($errcount>0){echo "<div class='issues_fnd_err'>$errcount issues found</div>";}else{ echo "No issues found.";} ?></td></tr></table></div></td>
					</tr>
					</table>
					</div>
					<div class="pcomp_yang">
					<table>
					<tr>
						<td><div class="client_title">Notes 6</div></td>
						<?
							$errcount=0;
							for($i=0; $i<$results_count; $i++){
									if($flag_match_Notes6[$i]==1){
										$errcount++;
									}
							}
							echo getdot_HTML($errcount);
						?>
						<td><div class="v_details" onclick="$('client_19').scrollTo();"><table><tr><td><img src="../../imgs/details_icon.gif" width="18" height="17" alt="O" /></td><td width="85"><?php if($errcount>0){echo "<div class='issues_fnd_err'>$errcount issues found</div>";}else{ echo "No issues found.";} ?></td></tr></table></div></td>
					</tr>
					</table>
					</div>	
					<div class="pcomp_yin">
					<table>
					<tr>
						<td><div class="client_title">Eudora</div></td>
						<?
							$errcount=0;
							for($i=0; $i<$results_count; $i++){
									if($flag_match_Eudora[$i]==1){
										$errcount++;
									}
							}
							echo getdot_HTML($errcount);
						?>
						<td><div class="v_details" onclick="$('client_20').scrollTo();"><table><tr><td><img src="../../imgs/details_icon.gif" width="18" height="17" alt="O" /></td><td width="85"><?php if($errcount>0){echo "<div class='issues_fnd_err'>$errcount issues found</div>";}else{ echo "No issues found.";} ?></td></tr></table></div></td>
					</tr>
					</table>
					</div>																	
			 	</div>
				</td>
				<td valign="top" style="padding-top:20px; padding-left:30px;">
				<div id="h_note"><p><strong>Note:</strong> Special thanks to the folks at <a href="http://webstandards.org/" target="_blank">WaSP</a> and <a href="http://www.campaignmonitor.com/" target="_blank">Campaign Monitor</a> for their <a href="http://www.campaignmonitor.com/css/" target="_blank">Guide to CSS Support</a> in email clients and for their creation of the <a href="http://www.email-standards.org/" target="_blank">Email Standards Project</a>. Part of the algoritm in this test was based of the results of their work.</p></div>
				</td>
			</tr>			
			</table>
		</div>
		<?php 
		for($clientcount=0; $clientcount<21; $clientcount++){
			$cur_client_name=$mailClientProfile->clientname[$clientcount];
			
			switch($clientcount){
				case 0: // yahoo old
					$cur_client_match=$flag_match_OldYahoo;
					$cur_client_profile=$mailClientProfile->OldYahoo;
				break;
				case 1: // yahoo new
					$cur_client_match=$flag_match_NewYahoo;
					$cur_client_profile=$mailClientProfile->NewYahoo;
				break;
				case 2:	// gmail old
					$cur_client_match=$flag_match_OldGmail;
					$cur_client_profile=$mailClientProfile->OldGmail;
				break;
				case 3:	// gmail new
					$cur_client_match=$flag_match_NewGmail;
					$cur_client_profile=$mailClientProfile->NewGmail;
				break;
				case 4: // livemail
					$cur_client_match=$flag_match_LiveMail;
					$cur_client_profile=$mailClientProfile->LiveMail;
				break;
				case 5: // hotmail
					$cur_client_match=$flag_match_Hotmail;
					$cur_client_profile=$mailClientProfile->Hotmail;
				break;
				case 6:	// aolweb
					$cur_client_match=$flag_match_AOLWeb;
					$cur_client_profile=$mailClientProfile->AOLWeb;
				break;
				case 7:	// macweb
					$cur_client_match=$flag_match_MacWeb;
					$cur_client_profile=$mailClientProfile->MacWeb;
				break;
				case 8:	// outlook2003
					$cur_client_match=$flag_match_Outlook2003;
					$cur_client_profile=$mailClientProfile->Outlook2003;
				break;
				case 9: // outlook2007
					$cur_client_match=$flag_match_Outlook2007;
					$cur_client_profile=$mailClientProfile->Outlook2007;
				break;
				case 10: // windowsmail
					$cur_client_match=$flag_match_WindowsMail;
					$cur_client_profile=$mailClientProfile->WindowsMail;
				break;
				case 11: // macmail
					$cur_client_match=$flag_match_MacMail;
					$cur_client_profile=$mailClientProfile->MacMail;
				break;
				case 12: // entoruagre2004
					$cur_client_match=$flag_match_Entourage2004;
					$cur_client_profile=$mailClientProfile->Entourage2004;
				break;
				case 13: // entourage2008
					$cur_client_match=$flag_match_Entourage2008;
					$cur_client_profile=$mailClientProfile->Entourage2008;
				break;
				case 14: // thunderbird15
					$cur_client_match=$flag_match_Thunderbird15;
					$cur_client_profile=$mailClientProfile->Thunderbird15;
				break;
				case 15: // thunderbird2
					$cur_client_match=$flag_match_Thunderbird2;
					$cur_client_profile=$mailClientProfile->Thunderbird2;
				break;
				case 16: // aol9
					$cur_client_match=$flag_match_AOL9;
					$cur_client_profile=$mailClientProfile->AOL9;
				break;
				case 17: // aol10
					$cur_client_match=$flag_match_AOL10;
					$cur_client_profile=$mailClientProfile->AOL10;
				break; 
				case 18: // aildesktopmac
					$cur_client_match=$flag_match_AOLDesktopforMac;
					$cur_client_profile=$mailClientProfile->AOLDesktopforMac;
				break;
				case 19: // notes6
					$cur_client_match=$flag_match_Notes6;
					$cur_client_profile=$mailClientProfile->Notes6;
				break;
				case 20: // eudora
					$cur_client_match=$flag_match_Eudora;
					$cur_client_profile=$mailClientProfile->Eudora;
				break;
			}
?>
		<div class="module" id="client_<?php echo $clientcount;  ?>">
			<table width="790">
			<tr>
				<td>
			 	<div class="results_wrapper">
				<div onclick="$('content_wrapper').scrollTo();" style="float:right; cursor:pointer;">top</div>
				<div class="subtitle"><?php echo $cur_client_name; ?> Performance Details</div>
				
			<table cellspacing="0" cellpadding="0">
            <thead>
               <tr class="header">
                  <td class="element-header">Style Element</td>
				  <td class="element-header">Supported</td>
				  <td class="element-header">Test Result</td>
				  <td class="element-header">Failure Reason</td>
               </tr>
            </thead>
            <tbody>
               <tr>
				<td colspan="4">
				<?php
					$i=0;
					if($cur_client_match[$i]==1){
						echo "<div class='flag_err'>";
					}else{
						echo "<div class='flag_success'>";
					}
					?>
				<table>
				<tr>
                  <td class="element-style">&lt;style&gt; in &lt;head&gt;</td>
				<?php
					if($cur_client_match[$i]==1){
						echo "<td class='element-support'>No</td><td class='element-status'>Failed</td><td class='element-code'>Not Supported</td>";
					}else{
						if($cur_client_profile[$i]=="y"){
							echo "<td class='element-support'>Yes</td><td class='element-status'>Passed</td><td></td>";
						}else{
							echo "<td class='element-support'>No</td><td class='element-status'>Passed</td><td></td>";
						}
					}
				?>				  
				</tr></table></div>
				
				</td>
               </tr>
               <tr>
				<td colspan="4">
				<?php
					$i=1;
					if($cur_client_match[$i]==1){
						echo "<div class='flag_err'>";
					}else{
						echo "<div class='flag_success'>";
					}
					?>
				<table>
				<tr>			   
                  <td class="element-style">&lt;style&gt; in &lt;body&gt;</td>
				<?php
					if($cur_client_match[$i]==1){
						echo "<td class='element-support'>No</td><td class='element-status'>Failed</td><td class='element-code'>Not Supported</td>";
					}else{
						if($cur_client_profile[$i]=="y"){
							echo "<td class='element-support'>Yes</td><td class='element-status'>Passed</td><td class='element-code'></td>";
						}else{
							echo "<td class='element-support'>No</td><td class='element-status'>Passed</td><td class='element-code'></td>";
						}
					}
				?></tr></table></div></td>
               </tr>
               <tr class="short">
                  <td class="element-header">Link Element</td>
				   <td class="element-header">Supported</td>
				  <td class="element-header">Test Result</td>
				  <td class="element-header">Failure Reason</td>				  
               </tr>
               <tr>
				<td colspan="4">
				<?php
					$i=82;
					if($cur_client_match[$i]==1){
						echo "<div class='flag_err'>";
					}else{
						echo "<div class='flag_success'>";
					}
					?>
				<table>
				<tr>			   
                  <td class="element-style">&lt;link&gt; in &lt;head&gt;</td>
				<?php
					if($cur_client_match[$i]==1){
						echo "<td class='element-support'>No</td><td class='element-status'>Failed</td><td class='element-code'>Not Supported</td>";
					}else{
						if($cur_client_profile[$i]=="y"){
							echo "<td class='element-support'>Yes</td><td class='element-status'>Passed</td><td class='element-code'></td>";
						}else{
							echo "<td class='element-support'>No</td><td class='element-status'>Passed</td><td class='element-code'></td>";
						}
					}
				?></tr></table></div></td>
               </tr>
               <tr>
				<td colspan="4">
				<?php
					$i=83;
					if($cur_client_match[$i]==1){
						echo "<div class='flag_err'>";
					}else{
						echo "<div class='flag_success'>";
					}
					?>
				<table>
				<tr>			   
                  <td class="element-style">&lt;link&gt; in &lt;body&gt;</td>
				<?php
					
					if($cur_client_match[$i]==1){
						echo "<td class='element-support'>No</td><td class='element-status'>Failed</td><td class='element-code'>Not Supported</td>";
					}else{
						if($cur_client_profile[$i]=="y"){
							echo "<td class='element-support'>Yes</td><td class='element-status'>Passed</td><td class='element-code'></td>";
						}else{
							echo "<td class='element-support'>No</td><td class='element-status'>Passed</td><td class='element-code'></td>";
						}
					}
				?></tr></table></div></td>
               </tr>
               <tr class="header">
                  <td class="element-header">CSS Properties</td>
				   <td class="element-header">Supported</td>
				  <td class="element-header">Test Result</td>
				  <td class="element-header">Failure Reason</td>				  
               </tr>
               <tr>
				<td colspan="4">
				<?php
					$i=8;
					if($cur_client_match[$i]==1){
						echo "<div class='flag_err'>";
					}else{
						echo "<div class='flag_success'>";
					}
					?>
				<table>
				<tr>			   
                 <td class="element-style">background-color</td>
				<?php
					
					if($cur_client_match[$i]==1){
						echo "<td class='element-support'>No</td><td class='element-status'>Failed</td><td class='element-code'>Not Supported</td>";
					}else{
						if($cur_client_profile[$i]=="y"){
							echo "<td class='element-support'>Yes</td><td class='element-status'>Passed</td><td class='element-code'></td>";
						}else{
							echo "<td class='element-support'>No</td><td class='element-status'>Passed</td><td class='element-code'></td>";
						}
					}
				?></tr></table></div></td>
            </tr>
               <tr>
				<td colspan="4">
				<?php
					$i=31;
					if($cur_client_match[$i]==1){
						echo "<div class='flag_err'>";
					}else{
						echo "<div class='flag_success'>";
					}
					?>
				<table>
				<tr>			   
                 <td class="element-style">background-image</td>
				<?php
					
					if($cur_client_match[$i]==1){
						echo "<td class='element-support'>No</td><td class='element-status'>Failed</td><td class='element-code'>Not Supported</td>";
					}else{
						if($cur_client_profile[$i]=="y"){
							echo "<td class='element-support'>Yes</td><td class='element-status'>Passed</td><td class='element-code'></td>";
						}else{
							echo "<td class='element-support'>No</td><td class='element-status'>Passed</td><td class='element-code'></td>";
						}
					}
				?></tr></table></div></td>
            </tr>
               <tr>
				<td colspan="4">
				<?php
					$i=42;
					if($cur_client_match[$i]==1){
						echo "<div class='flag_err'>";
					}else{
						echo "<div class='flag_success'>";
					}
					?>
				<table>
				<tr>			   
                 <td class="element-style">background-position</td>
				<?php
					
					if($cur_client_match[$i]==1){
						echo "<td class='element-support'>No</td><td class='element-status'>Failed</td><td class='element-code'>Not Supported</td>";
					}else{
						if($cur_client_profile[$i]=="y"){
							echo "<td class='element-support'>Yes</td><td class='element-status'>Passed</td><td class='element-code'></td>";
						}else{
							echo "<td class='element-support'>No</td><td class='element-status'>Passed</td><td class='element-code'></td>";
						}
					}
				?></tr></table></div></td>
            </tr>
               <tr>
				<td colspan="4">
				<?php
					$i=32;
					if($cur_client_match[$i]==1){
						echo "<div class='flag_err'>";
					}else{
						echo "<div class='flag_success'>";
					}
					?>
				<table>
				<tr>			   
                 <td class="element-style">background-repeat</td>
				<?php
					
					if($cur_client_match[$i]==1){
						echo "<td class='element-support'>No</td><td class='element-status'>Failed</td><td class='element-code'>Not Supported</td>";
					}else{
						if($cur_client_profile[$i]=="y"){
							echo "<td class='element-support'>Yes</td><td class='element-status'>Passed</td><td class='element-code'></td>";
						}else{
							echo "<td class='element-support'>No</td><td class='element-status'>Passed</td><td class='element-code'></td>";
						}
					}
				?></tr></table></div></td>
            </tr>
               <tr>
				<td colspan="4">
				<?php
					$i=9;
					if($cur_client_match[$i]==1){
						echo "<div class='flag_err'>";
					}else{
						echo "<div class='flag_success'>";
					}
					?>
				<table>
				<tr>			   
                 <td class="element-style">border</td>
				<?php
					
					if($cur_client_match[$i]==1){
						echo "<td class='element-support'>No</td><td class='element-status'>Failed</td><td class='element-code'>Not Supported</td>";
					}else{
						if($cur_client_profile[$i]=="y"){
							echo "<td class='element-support'>Yes</td><td class='element-status'>Passed</td><td class='element-code'></td>";
						}else{
							echo "<td class='element-support'>No</td><td class='element-status'>Passed</td><td class='element-code'></td>";
						}
					}
				?></tr></table></div></td>
            </tr>
               <tr>
				<td colspan="4">
				<?php
					$i=19;
					if($cur_client_match[$i]==1){
						echo "<div class='flag_err'>";
					}else{
						echo "<div class='flag_success'>";
					}
					?>
				<table>
				<tr>			   
                 <td class="element-style">border-collapse</td>
				<?php
					
					if($cur_client_match[$i]==1){
						echo "<td class='element-support'>No</td><td class='element-status'>Failed</td><td class='element-code'>Not Supported</td>";
					}else{
						if($cur_client_profile[$i]=="y"){
							echo "<td class='element-support'>Yes</td><td class='element-status'>Passed</td><td class='element-code'></td>";
						}else{
							echo "<td class='element-support'>No</td><td class='element-status'>Passed</td><td class='element-code'></td>";
						}
					}
				?></tr></table></div></td>
            </tr>
               <tr>
				<td colspan="4">
				<?php
					$i=43;
					if($cur_client_match[$i]==1){
						echo "<div class='flag_err'>";
					}else{
						echo "<div class='flag_success'>";
					}
					?>
				<table>
				<tr>			   
                 <td class="element-style">border-spacing</td>
 				<?php
					
					if($cur_client_match[$i]==1){
						echo "<td class='element-support'>No</td><td class='element-status'>Failed</td><td class='element-code'>Not Supported</td>";
					}else{
						if($cur_client_profile[$i]=="y"){
							echo "<td class='element-support'>Yes</td><td class='element-status'>Passed</td><td class='element-code'></td>";
						}else{
							echo "<td class='element-support'>No</td><td class='element-status'>Passed</td><td class='element-code'></td>";
						}
					}
				?></tr></table></div></td>			
            </tr>
               <tr>
				<td colspan="4">
				<?php
					$i=44;
					if($cur_client_match[$i]==1){
						echo "<div class='flag_err'>";
					}else{
						echo "<div class='flag_success'>";
					}
					?>
				<table>
				<tr>			   
                 <td class="element-style">bottom</td>
				<?php
					
					if($cur_client_match[$i]==1){
						echo "<td class='element-support'>No</td><td class='element-status'>Failed</td><td class='element-code'>Not Supported</td>";
					}else{
						if($cur_client_profile[$i]=="y"){
							echo "<td class='element-support'>Yes</td><td class='element-status'>Passed</td><td class='element-code'></td>";
						}else{
							echo "<td class='element-support'>No</td><td class='element-status'>Passed</td><td class='element-code'></td>";
						}
					}
				?></tr></table></div></td>
            </tr>
               <tr>
				<td colspan="4">
				<?php
					$i=47;
					if($cur_client_match[$i]==1){
						echo "<div class='flag_err'>";
					}else{
						echo "<div class='flag_success'>";
					}
					?>
				<table>
				<tr>			   
                 <td class="element-style">caption-side</td>
				<?php
					
					if($cur_client_match[$i]==1){
						echo "<td class='element-support'>No</td><td class='element-status'>Failed</td><td class='element-code'>Not Supported</td>";
					}else{
						if($cur_client_profile[$i]=="y"){
							echo "<td class='element-support'>Yes</td><td class='element-status'>Passed</td><td class='element-code'></td>";
						}else{
							echo "<td class='element-support'>No</td><td class='element-status'>Passed</td><td class='element-code'></td>";
						}
					}
				?></tr></table></div></td>	
            </tr>
               <tr>
				<td colspan="4">
				<?php
					$i=20;
					if($cur_client_match[$i]==1){
						echo "<div class='flag_err'>";
					}else{
						echo "<div class='flag_success'>";
					}
					?>
				<table>
				<tr>			   
                 <td class="element-style">clear</td>
 				<?php
					
					if($cur_client_match[$i]==1){
						echo "<td class='element-support'>No</td><td class='element-status'>Failed</td><td class='element-code'>Not Supported</td>";
					}else{
						if($cur_client_profile[$i]=="y"){
							echo "<td class='element-support'>Yes</td><td class='element-status'>Passed</td><td class='element-code'></td>";
						}else{
							echo "<td class='element-support'>No</td><td class='element-status'>Passed</td><td class='element-code'></td>";
						}
					}
				?></tr></table></div></td>
            </tr>
               <tr>
				<td colspan="4">
				<?php
					$i=33;
					if($cur_client_match[$i]==1){
						echo "<div class='flag_err'>";
					}else{
						echo "<div class='flag_success'>";
					}
					?>
				<table>
				<tr>			   
                 <td class="element-style">clip</td>
				<?php
					
					if($cur_client_match[$i]==1){
						echo "<td class='element-support'>No</td><td class='element-status'>Failed</td><td class='element-code'>Not Supported</td>";
					}else{
						if($cur_client_profile[$i]=="y"){
							echo "<td class='element-support'>Yes</td><td class='element-status'>Passed</td><td class='element-code'></td>";
						}else{
							echo "<td class='element-support'>No</td><td class='element-status'>Passed</td><td class='element-code'></td>";
						}
					}
				?></tr></table></div></td>
            </tr>
            <tr>
				<td colspan="4">
				<?php
					$i=2;
					if($cur_client_match[$i]==1){
						echo "<div class='flag_err'>";
					}else{
						echo "<div class='flag_success'>";
					}
					?>
				<table>
				<tr>			
               <td class="element-style">color</td>
				<?php
					
					if($cur_client_match[$i]==1){
						echo "<td class='element-support'>No</td><td class='element-status'>Failed</td><td class='element-code'>Not Supported</td>";
					}else{
						if($cur_client_profile[$i]=="y"){
							echo "<td class='element-support'>Yes</td><td class='element-status'>Passed</td><td class='element-code'></td>";
						}else{
							echo "<td class='element-support'>No</td><td class='element-status'>Passed</td><td class='element-code'></td>";
						}
					}
				?>	</tr></table></div></td>
            </tr>
               <tr>
				<td colspan="4">
				<?php
					$i=34;
					if($cur_client_match[$i]==1){
						echo "<div class='flag_err'>";
					}else{
						echo "<div class='flag_success'>";
					}
					?>
				<table>
				<tr>			   
                 <td class="element-style">cursor</td>
				<?php
					
					if($cur_client_match[$i]==1){
						echo "<td class='element-support'>No</td><td class='element-status'>Failed</td><td class='element-code'>Not Supported</td>";
					}else{
						if($cur_client_profile[$i]=="y"){
							echo "<td class='element-support'>Yes</td><td class='element-status'>Passed</td><td class='element-code'></td>";
						}else{
							echo "<td class='element-support'>No</td><td class='element-status'>Passed</td><td class='element-code'></td>";
						}
					}
				?></tr></table></div></td>
            </tr>
               <tr>
				<td colspan="4">
				<?php
					$i=21;
					if($cur_client_match[$i]==1){
						echo "<div class='flag_err'>";
					}else{
						echo "<div class='flag_success'>";
					}
					?>
				<table>
				<tr>			   
                 <td class="element-style">direction</td>
				<?php
					
					if($cur_client_match[$i]==1){
						echo "<td class='element-support'>No</td><td class='element-status'>Failed</td><td class='element-code'>Not Supported</td>";
					}else{
						if($cur_client_profile[$i]=="y"){
							echo "<td class='element-support'>Yes</td><td class='element-status'>Passed</td><td class='element-code'></td>";
						}else{
							echo "<td class='element-support'>No</td><td class='element-status'>Passed</td><td class='element-code'></td>";
						}
					}
				?></tr></table></div></td>
            </tr>
               <tr>
				<td colspan="4">
				<?php
					$i=10;
					if($cur_client_match[$i]==1){
						echo "<div class='flag_err'>";
					}else{
						echo "<div class='flag_success'>";
					}
					?>
				<table>
				<tr>			   
                 <td class="element-style">display</td>
				<?php
					
					if($cur_client_match[$i]==1){
						echo "<td class='element-support'>No</td><td class='element-status'>Failed</td><td class='element-code'>Not Supported</td>";
					}else{
						if($cur_client_profile[$i]=="y"){
							echo "<td class='element-support'>Yes</td><td class='element-status'>Passed</td><td class='element-code'></td>";
						}else{
							echo "<td class='element-support'>No</td><td class='element-status'>Passed</td><td class='element-code'></td>";
						}
					}
				?></tr></table></div></td>
            </tr>
               <tr>
				<td colspan="4">
				<?php
					$i=45;
					if($cur_client_match[$i]==1){
						echo "<div class='flag_err'>";
					}else{
						echo "<div class='flag_success'>";
					}
					?>
				<table>
				<tr>			   
                 <td class="element-style">empty-cells</td>
				<?php
					
					if($cur_client_match[$i]==1){
						echo "<td class='element-support'>No</td><td class='element-status'>Failed</td><td class='element-code'>Not Supported</td>";
					}else{
						if($cur_client_profile[$i]=="y"){
							echo "<td class='element-support'>Yes</td><td class='element-status'>Passed</td><td class='element-code'></td>";
						}else{
							echo "<td class='element-support'>No</td><td class='element-status'>Passed</td><td class='element-code'></td>";
						}
					}
				?></tr></table></div></td>
            </tr>
               <tr>
				<td colspan="4">
				<?php
					$i=22;
					if($cur_client_match[$i]==1){
						echo "<div class='flag_err'>";
					}else{
						echo "<div class='flag_success'>";
					}
					?>
				<table>
				<tr>			   
                 <td class="element-style">float</td>
				<?php
					
					if($cur_client_match[$i]==1){
						echo "<td class='element-support'>No</td><td class='element-status'>Failed</td><td class='element-code'>Not Supported</td>";
					}else{
						if($cur_client_profile[$i]=="y"){
							echo "<td class='element-support'>Yes</td><td class='element-status'>Passed</td><td class='element-code'></td>";
						}else{
							echo "<td class='element-support'>No</td><td class='element-status'>Passed</td><td class='element-code'></td>";
						}
					}
				?></tr></table></div></td>
            </tr>
               <tr>
				<td colspan="4">
				<?php
					$i=11;
					if($cur_client_match[$i]==1){
						echo "<div class='flag_err'>";
					}else{
						echo "<div class='flag_success'>";
					}
					?>
				<table>
				<tr>			   
                 <td class="element-style">font-family</td>
				<?php
					
					if($cur_client_match[$i]==1){
						echo "<td class='element-support'>No</td><td class='element-status'>Failed</td><td class='element-code'>Not Supported</td>";
					}else{
						if($cur_client_profile[$i]=="y"){
							echo "<td class='element-support'>Yes</td><td class='element-status'>Passed</td><td class='element-code'></td>";
						}else{
							echo "<td class='element-support'>No</td><td class='element-status'>Passed</td><td class='element-code'></td>";
						}
					}
				?></tr></table></div></td>
            </tr>
               <tr>
				<td colspan="4">
				<?php
					$i=3;
					if($cur_client_match[$i]==1){
						echo "<div class='flag_err'>";
					}else{
						echo "<div class='flag_success'>";
					}
					?>
				<table>
				<tr>			   
                 <td class="element-style">font-size</td>
				<?php
					
					if($cur_client_match[$i]==1){
						echo "<td class='element-support'>No</td><td class='element-status'>Failed</td><td class='element-code'>Not Supported</td>";
					}else{
						if($cur_client_profile[$i]=="y"){
							echo "<td class='element-support'>Yes</td><td class='element-status'>Passed</td><td class='element-code'></td>";
						}else{
							echo "<td class='element-support'>No</td><td class='element-status'>Passed</td><td class='element-code'></td>";
						}
					}
				?></tr></table></div></td>
            </tr>
               <tr>
				<td colspan="4">
				<?php
					$i=4;
					if($cur_client_match[$i]==1){
						echo "<div class='flag_err'>";
					}else{
						echo "<div class='flag_success'>";
					}
					?>
				<table>
				<tr>			   
                 <td class="element-style">font-style</td>
 				<?php
					
					if($cur_client_match[$i]==1){
						echo "<td class='element-support'>No</td><td class='element-status'>Failed</td><td class='element-code'>Not Supported</td>";
					}else{
						if($cur_client_profile[$i]=="y"){
							echo "<td class='element-support'>Yes</td><td class='element-status'>Passed</td><td class='element-code'></td>";
						}else{
							echo "<td class='element-support'>No</td><td class='element-status'>Passed</td><td class='element-code'></td>";
						}
					}
				?></tr></table></div></td>
            </tr>
               <tr>
				<td colspan="4">
				<?php
					$i=12;
					if($cur_client_match[$i]==1){
						echo "<div class='flag_err'>";
					}else{
						echo "<div class='flag_success'>";
					}
					?>
				<table>
				<tr>			   
                 <td class="element-style">font-variant</td>
				<?php
					
					if($cur_client_match[$i]==1){
						echo "<td class='element-support'>No</td><td class='element-status'>Failed</td><td class='element-code'>Not Supported</td>";
					}else{
						if($cur_client_profile[$i]=="y"){
							echo "<td class='element-support'>Yes</td><td class='element-status'>Passed</td><td class='element-code'></td>";
						}else{
							echo "<td class='element-support'>No</td><td class='element-status'>Passed</td><td class='element-code'></td>";
						}
					}
				?></tr></table></div></td>
            </tr>
               <tr>
				<td colspan="4">
				<?php
					$i=5;
					if($cur_client_match[$i]==1){
						echo "<div class='flag_err'>";
					}else{
						echo "<div class='flag_success'>";
					}
					?>
				<table>
				<tr>			   
                 <td class="element-style">font-weight</td>
 				<?php
					
					if($cur_client_match[$i]==1){
						echo "<td class='element-support'>No</td><td class='element-status'>Failed</td><td class='element-code'>Not Supported</td>";
					}else{
						if($cur_client_profile[$i]=="y"){
							echo "<td class='element-support'>Yes</td><td class='element-status'>Passed</td><td class='element-code'></td>";
						}else{
							echo "<td class='element-support'>No</td><td class='element-status'>Passed</td><td class='element-code'></td>";
						}
					}
				?></tr></table></div></td>
            </tr>
               <tr>
				<td colspan="4">
				<?php
					$i=26;
					if($cur_client_match[$i]==1){
						echo "<div class='flag_err'>";
					}else{
						echo "<div class='flag_success'>";
					}
					?>
				<table>
				<tr>			   
                 <td class="element-style">height</td>
				<?php
					
					if($cur_client_match[$i]==1){
						echo "<td class='element-support'>No</td><td class='element-status'>Failed</td><td class='element-code'>Not Supported</td>";
					}else{
						if($cur_client_profile[$i]=="y"){
							echo "<td class='element-support'>Yes</td><td class='element-status'>Passed</td><td class='element-code'></td>";
						}else{
							echo "<td class='element-support'>No</td><td class='element-status'>Passed</td><td class='element-code'></td>";
						}
					}
				?></tr></table></div></td>
            </tr>
               <tr>
				<td colspan="4">
				<?php
					$i=39;
					if($cur_client_match[$i]==1){
						echo "<div class='flag_err'>";
					}else{
						echo "<div class='flag_success'>";
					}
					?>
				<table>
				<tr>			   
                 <td class="element-style">left</td>
 				<?php
					
					if($cur_client_match[$i]==1){
						echo "<td class='element-support'>No</td><td class='element-status'>Failed</td><td class='element-code'>Not Supported</td>";
					}else{
						if($cur_client_profile[$i]=="y"){
							echo "<td class='element-support'>Yes</td><td class='element-status'>Passed</td><td class='element-code'></td>";
						}else{
							echo "<td class='element-support'>No</td><td class='element-status'>Passed</td><td class='element-code'></td>";
						}
					}
				?></tr></table></div></td>
            </tr>
               <tr>
				<td colspan="4">
				<?php
					$i=13;
					if($cur_client_match[$i]==1){
						echo "<div class='flag_err'>";
					}else{
						echo "<div class='flag_success'>";
					}
					?>
				<table>
				<tr>			   
                 <td class="element-style">letter-spacing</td>
				<?php
					
					if($cur_client_match[$i]==1){
						echo "<td class='element-support'>No</td><td class='element-status'>Failed</td><td class='element-code'>Not Supported</td>";
					}else{
						if($cur_client_profile[$i]=="y"){
							echo "<td class='element-support'>Yes</td><td class='element-status'>Passed</td><td class='element-code'></td>";
						}else{
							echo "<td class='element-support'>No</td><td class='element-status'>Passed</td><td class='element-code'></td>";
						}
					}
				?></tr></table></div></td>
            </tr>
               <tr>
				<td colspan="4">
				<?php
					$i=14;
					if($cur_client_match[$i]==1){
						echo "<div class='flag_err'>";
					}else{
						echo "<div class='flag_success'>";
					}
					?>
				<table>
				<tr>			   
                 <td class="element-style">line-height</td>
 				<?php
					
					if($cur_client_match[$i]==1){
						echo "<td class='element-support'>No</td><td class='element-status'>Failed</td><td class='element-code'>Not Supported</td>";
					}else{
						if($cur_client_profile[$i]=="y"){
							echo "<td class='element-support'>Yes</td><td class='element-status'>Passed</td><td class='element-code'></td>";
						}else{
							echo "<td class='element-support'>No</td><td class='element-status'>Passed</td><td class='element-code'></td>";
						}
					}
				?></tr></table></div></td>
            </tr>
               <tr>
				<td colspan="4">
				<?php
					$i=35;
					if($cur_client_match[$i]==1){
						echo "<div class='flag_err'>";
					}else{
						echo "<div class='flag_success'>";
					}
					?>
				<table>
				<tr>			   
                 <td class="element-style">list-style-image</td>
				<?php
					
					if($cur_client_match[$i]==1){
						echo "<td class='element-support'>No</td><td class='element-status'>Failed</td><td class='element-code'>Not Supported</td>";
					}else{
						if($cur_client_profile[$i]=="y"){
							echo "<td class='element-support'>Yes</td><td class='element-status'>Passed</td><td class='element-code'></td>";
						}else{
							echo "<td class='element-support'>No</td><td class='element-status'>Passed</td><td class='element-code'></td>";
						}
					}
				?>	</tr></table></div></td>
            </tr>
               <tr>
				<td colspan="4">
				<?php
					$i=36;
					if($cur_client_match[$i]==1){
						echo "<div class='flag_err'>";
					}else{
						echo "<div class='flag_success'>";
					}
					?>
				<table>
				<tr>			   
                 <td class="element-style">list-style-position</td>
				<?php
					
					if($cur_client_match[$i]==1){
						echo "<td class='element-support'>No</td><td class='element-status'>Failed</td><td class='element-code'>Not Supported</td>";
					}else{
						if($cur_client_profile[$i]=="y"){
							echo "<td class='element-support'>Yes</td><td class='element-status'>Passed</td><td class='element-code'></td>";
						}else{
							echo "<td class='element-support'>No</td><td class='element-status'>Passed</td><td class='element-code'></td>";
						}
					}
				?></tr></table></div></td>
            </tr>
               <tr>
				<td colspan="4">
				<?php
					$i=27;
					if($cur_client_match[$i]==1){
						echo "<div class='flag_err'>";
					}else{
						echo "<div class='flag_success'>";
					}
					?>
				<table>
				<tr>			   
                 <td class="element-style">list-style-type</td>
 				<?php
					
					if($cur_client_match[$i]==1){
						echo "<td class='element-support'>No</td><td class='element-status'>Failed</td><td class='element-code'>Not Supported</td>";
					}else{
						if($cur_client_profile[$i]=="y"){
							echo "<td class='element-support'>Yes</td><td class='element-status'>Passed</td><td class='element-code'></td>";
						}else{
							echo "<td class='element-support'>No</td><td class='element-status'>Passed</td><td class='element-code'></td>";
						}
					}
				?></tr></table></div></td>
            </tr>
               <tr>
				<td colspan="4">
				<?php
					$i=37;
					if($cur_client_match[$i]==1){
						echo "<div class='flag_err'>";
					}else{
						echo "<div class='flag_success'>";
					}
					?>
				<table>
				<tr>			   
                 <td class="element-style">margin</td>
				<?php
					
					if($cur_client_match[$i]==1){
						echo "<td class='element-support'>No</td><td class='element-status'>Failed</td><td class='element-code'>Not Supported</td>";
					}else{
						if($cur_client_profile[$i]=="y"){
							echo "<td class='element-support'>Yes</td><td class='element-status'>Passed</td><td class='element-code'></td>";
						}else{
							echo "<td class='element-support'>No</td><td class='element-status'>Passed</td><td class='element-code'></td>";
						}
					}
				?>	</tr></table></div></td>
            </tr>
               <tr>
				<td colspan="4">
				<?php
					$i=48;
					if($cur_client_match[$i]==1){
						echo "<div class='flag_err'>";
					}else{
						echo "<div class='flag_success'>";
					}
					?>
				<table>
				<tr>			   
                 <td class="element-style">opacity</td>
				<?php
					
					if($cur_client_match[$i]==1){
						echo "<td class='element-support'>No</td><td class='element-status'>Failed</td><td class='element-code'>Not Supported</td>";
					}else{
						if($cur_client_profile[$i]=="y"){
							echo "<td class='element-support'>Yes</td><td class='element-status'>Passed</td><td class='element-code'></td>";
						}else{
							echo "<td class='element-support'>No</td><td class='element-status'>Passed</td><td class='element-code'></td>";
						}
					}
				?></tr></table></div></td>
            </tr>
               <tr>
				<td colspan="4">
				<?php
					$i=28;
					if($cur_client_match[$i]==1){
						echo "<div class='flag_err'>";
					}else{
						echo "<div class='flag_success'>";
					}
					?>
				<table>
				<tr>			   
                 <td class="element-style">overflow</td>
				<?php
					
					if($cur_client_match[$i]==1){
						echo "<td class='element-support'>No</td><td class='element-status'>Failed</td><td class='element-code'>Not Supported</td>";
					}else{
						if($cur_client_profile[$i]=="y"){
							echo "<td class='element-support'>Yes</td><td class='element-status'>Passed</td><td class='element-code'></td>";
						}else{
							echo "<td class='element-support'>No</td><td class='element-status'>Passed</td><td class='element-code'></td>";
						}
					}
				?></tr></table></div></td>			
            </tr>
                <tr>
				<td colspan="4">
				<?php
					$i=15;
					if($cur_client_match[$i]==1){
						echo "<div class='flag_err'>";
					}else{
						echo "<div class='flag_success'>";
					}
					?>
				<table>
				<tr>				
                  <td class="element-style">padding</td>
 				<?php
					
					if($cur_client_match[$i]==1){
						echo "<td class='element-support'>No</td><td class='element-status'>Failed</td><td class='element-code'>Not Supported</td>";
					}else{
						if($cur_client_profile[$i]=="y"){
							echo "<td class='element-support'>Yes</td><td class='element-status'>Passed</td><td class='element-code'></td>";
						}else{
							echo "<td class='element-support'>No</td><td class='element-status'>Passed</td><td class='element-code'></td>";
						}
					}
				?></tr></table></div></td>
            </tr>
                <tr>
				<td colspan="4">
				<?php
					$i=46;
					if($cur_client_match[$i]==1){
						echo "<div class='flag_err'>";
					}else{
						echo "<div class='flag_success'>";
					}
					?>
				<table>
				<tr>				
                  <td class="element-style">position</td>
 				<?php
					
					if($cur_client_match[$i]==1){
						echo "<td class='element-support'>No</td><td class='element-status'>Failed</td><td class='element-code'>Not Supported</td>";
					}else{
						if($cur_client_profile[$i]=="y"){
							echo "<td class='element-support'>Yes</td><td class='element-status'>Passed</td><td class='element-code'></td>";
						}else{
							echo "<td class='element-support'>No</td><td class='element-status'>Passed</td><td class='element-code'></td>";
						}
					}
				?></tr></table></div></td>
            </tr>
               <tr>
				<td colspan="4">
				<?php
					$i=40;
					if($cur_client_match[$i]==1){
						echo "<div class='flag_err'>";
					}else{
						echo "<div class='flag_success'>";
					}
					?>
				<table>
				<tr>			   
                 <td class="element-style">right</td>
				<?php
					
					if($cur_client_match[$i]==1){
						echo "<td class='element-support'>No</td><td class='element-status'>Failed</td><td class='element-code'>Not Supported</td>";
					}else{
						if($cur_client_profile[$i]=="y"){
							echo "<td class='element-support'>Yes</td><td class='element-status'>Passed</td><td class='element-code'></td>";
						}else{
							echo "<td class='element-support'>No</td><td class='element-status'>Passed</td><td class='element-code'></td>";
						}
					}
				?>	</tr></table></div></td>
            </tr>
               <tr>
				<td colspan="4">
				<?php
					$i=16;
					if($cur_client_match[$i]==1){
						echo "<div class='flag_err'>";
					}else{
						echo "<div class='flag_success'>";
					}
					?>
				<table>
				<tr>			   
                 <td class="element-style">table-layout</td>
 				<?php
					
					if($cur_client_match[$i]==1){
						echo "<td class='element-support'>No</td><td class='element-status'>Failed</td><td class='element-code'>Not Supported</td>";
					}else{
						if($cur_client_profile[$i]=="y"){
							echo "<td class='element-support'>Yes</td><td class='element-status'>Passed</td><td class='element-code'></td>";
						}else{
							echo "<td class='element-support'>No</td><td class='element-status'>Passed</td><td class='element-code'></td>";
						}
					}
				?>	</tr></table></div></td>
            </tr>
                <tr>
				<td colspan="4">
				<?php
					$i=6;
					if($cur_client_match[$i]==1){
						echo "<div class='flag_err'>";
					}else{
						echo "<div class='flag_success'>";
					}
					?>
				<table>
				<tr>				
                  <td class="element-style">text-align</td>
 				<?php
					
					if($cur_client_match[$i]==1){
						echo "<td class='element-support'>No</td><td class='element-status'>Failed</td><td class='element-code'>Not Supported</td>";
					}else{
						if($cur_client_profile[$i]=="y"){
							echo "<td class='element-support'>Yes</td><td class='element-status'>Passed</td><td class='element-code'></td>";
						}else{
							echo "<td class='element-support'>No</td><td class='element-status'>Passed</td><td class='element-code'></td>";
						}
					}
				?>	</tr></table></div></td>
            </tr>
               <tr>
				<td colspan="4">
				<?php
					$i=7;
					if($cur_client_match[$i]==1){
						echo "<div class='flag_err'>";
					}else{
						echo "<div class='flag_success'>";
					}
					?>
				<table>
				<tr>			   
                 <td class="element-style">text-decoration</td>
 				<?php
					
					if($cur_client_match[$i]==1){
						echo "<td class='element-support'>No</td><td class='element-status'>Failed</td><td class='element-code'>Not Supported</td>";
					}else{
						if($cur_client_profile[$i]=="y"){
							echo "<td class='element-support'>Yes</td><td class='element-status'>Passed</td><td class='element-code'></td>";
						}else{
							echo "<td class='element-support'>No</td><td class='element-status'>Passed</td><td class='element-code'></td>";
						}
					}
				?></tr></table></div></td>
            </tr>
               <tr>
				<td colspan="4">
				<?php
					$i=17;
					if($cur_client_match[$i]==1){
						echo "<div class='flag_err'>";
					}else{
						echo "<div class='flag_success'>";
					}
					?>
				<table>
				<tr>			   
                 <td class="element-style">text-indent</td>
				<?php
					
					if($cur_client_match[$i]==1){
						echo "<td class='element-support'>No</td><td class='element-status'>Failed</td><td class='element-code'>Not Supported</td>";
					}else{
						if($cur_client_profile[$i]=="y"){
							echo "<td class='element-support'>Yes</td><td class='element-status'>Passed</td><td class='element-code'></td>";
						}else{
							echo "<td class='element-support'>No</td><td class='element-status'>Passed</td><td class='element-code'></td>";
						}
					}
				?></tr></table></div></td>
            </tr>
               <tr>
				<td colspan="4">
				<?php
					$i=18;
					if($cur_client_match[$i]==1){
						echo "<div class='flag_err'>";
					}else{
						echo "<div class='flag_success'>";
					}
					?>
				<table>
				<tr>			   
                 <td class="element-style">text-transform</td>
				<?php
					
					if($cur_client_match[$i]==1){
						echo "<td class='element-support'>No</td><td class='element-status'>Failed</td><td class='element-code'>Not Supported</td>";
					}else{
						if($cur_client_profile[$i]=="y"){
							echo "<td class='element-support'>Yes</td><td class='element-status'>Passed</td><td class='element-code'></td>";
						}else{
							echo "<td class='element-support'>No</td><td class='element-status'>Passed</td><td class='element-code'></td>";
						}
					}
				?></tr></table></div></td>
            </tr>
               <tr>
				<td colspan="4">
				<?php
					$i=41;
					if($cur_client_match[$i]==1){
						echo "<div class='flag_err'>";
					}else{
						echo "<div class='flag_success'>";
					}
					?>
				<table>
				<tr>			   
                 <td class="element-style">top</td>
				<?php
					
					if($cur_client_match[$i]==1){
						echo "<td class='element-support'>No</td><td class='element-status'>Failed</td><td class='element-code'>Not Supported</td>";
					}else{
						if($cur_client_profile[$i]=="y"){
							echo "<td class='element-support'>Yes</td><td class='element-status'>Passed</td><td class='element-code'></td>";
						}else{
							echo "<td class='element-support'>No</td><td class='element-status'>Passed</td><td class='element-code'></td>";
						}
					}
				?></tr></table></div></td>
            </tr>
               <tr>
				<td colspan="4">
				<?php
					$i=23;
					if($cur_client_match[$i]==1){
						echo "<div class='flag_err'>";
					}else{
						echo "<div class='flag_success'>";
					}
					?>
				<table>
				<tr>			   
                 <td class="element-style">vertical-align</td>
				<?php
					
					if($cur_client_match[$i]==1){
						echo "<td class='element-support'>No</td><td class='element-status'>Failed</td><td class='element-code'>Not Supported</td>";
					}else{
						if($cur_client_profile[$i]=="y"){
							echo "<td class='element-support'>Yes</td><td class='element-status'>Passed</td><td class='element-code'></td>";
						}else{
							echo "<td class='element-support'>No</td><td class='element-status'>Passed</td><td class='element-code'></td>";
						}
					}
				?>	</tr></table></div></td>
            </tr>
               <tr>
				<td colspan="4">
				<?php
					$i=29;
					if($cur_client_match[$i]==1){
						echo "<div class='flag_err'>";
					}else{
						echo "<div class='flag_success'>";
					}
					?>
				<table>
				<tr>			   
                 <td class="element-style">visibility</td>
				<?php
					
					if($cur_client_match[$i]==1){
						echo "<td class='element-support'>No</td><td class='element-status'>Failed</td><td class='element-code'>Not Supported</td>";
					}else{
						if($cur_client_profile[$i]=="y"){
							echo "<td class='element-support'>Yes</td><td class='element-status'>Passed</td><td class='element-code'></td>";
						}else{
							echo "<td class='element-support'>No</td><td class='element-status'>Passed</td><td class='element-code'></td>";
						}
					}
				?>	</tr></table></div></td>
            </tr>
               <tr>
				<td colspan="4">
				<?php
					$i=30;
					if($cur_client_match[$i]==1){
						echo "<div class='flag_err'>";
					}else{
						echo "<div class='flag_success'>";
					}
					?>
				<table>
				<tr>			   
                 <td class="element-style">white-space</td>
				<?php
					
					if($cur_client_match[$i]==1){
						echo "<td class='element-support'>No</td><td class='element-status'>Failed</td><td class='element-code'>Not Supported</td>";
					}else{
						if($cur_client_profile[$i]=="y"){
							echo "<td class='element-support'>Yes</td><td class='element-status'>Passed</td><td class='element-code'></td>";
						}else{
							echo "<td class='element-support'>No</td><td class='element-status'>Passed</td><td class='element-code'></td>";
						}
					}
				?>	</tr></table></div></td>
            </tr>
               <tr>
				<td colspan="4">
				<?php
					$i=24;
					if($cur_client_match[$i]==1){
						echo "<div class='flag_err'>";
					}else{
						echo "<div class='flag_success'>";
					}
					?>
				<table>
				<tr>			   
                 <td class="element-style">width</td>
 				<?php
					
					if($cur_client_match[$i]==1){
						echo "<td class='element-support'>No</td><td class='element-status'>Failed</td><td class='element-code'>Not Supported</td>";
					}else{
						if($cur_client_profile[$i]=="y"){
							echo "<td class='element-support'>Yes</td><td class='element-status'>Passed</td><td class='element-code'></td>";
						}else{
							echo "<td class='element-support'>No</td><td class='element-status'>Passed</td><td class='element-code'></td>";
						}
					}
				?>	</tr></table></div></td>
            </tr>
               <tr>
				<td colspan="4">
				<?php
					$i=25;
					if($cur_client_match[$i]==1){
						echo "<div class='flag_err'>";
					}else{
						echo "<div class='flag_success'>";
					}
					?>
				<table>
				<tr>			   
                 <td class="element-style">word-spacing</td>
				<?php
					
					if($cur_client_match[$i]==1){
						echo "<td class='element-support'>No</td><td class='element-status'>Failed</td><td class='element-code'>Not Supported</td>";
					}else{
						if($cur_client_profile[$i]=="y"){
							echo "<td class='element-support'>Yes</td><td class='element-status'>Passed</td><td class='element-code'></td>";
						}else{
							echo "<td class='element-support'>No</td><td class='element-status'>Passed</td><td class='element-code'></td>";
						}
					}
				?>	</tr></table></div></td>
            </tr>
               <tr>
				<td colspan="4">
				<?php
					$i=38;
					if($cur_client_match[$i]==1){
						echo "<div class='flag_err'>";
					}else{
						echo "<div class='flag_success'>";
					}
					?>
				<table>
				<tr>			   
                 <td class="element-style">z-index</td>
				<?php
					
					if($cur_client_match[$i]==1){
						echo "<td class='element-support'>No</td><td class='element-status'>Failed</td><td class='element-code'>Not Supported</td>";
					}else{
						if($cur_client_profile[$i]=="y"){
							echo "<td class='element-support'>Yes</td><td class='element-status'>Passed</td><td class='element-code'></td>";
						}else{
							echo "<td class='element-support'>No</td><td class='element-status'>Passed</td><td class='element-code'></td>";
						}
					}
				?>	</tr></table></div></td>		
            </tr>   
			<tr class="short">
                  <td class="element-header">HTML Elements</td>
				   <td class="element-header">Recommended</td>
				  <td class="element-header">Test Result</td>
				  <td class="element-header">Failure Reason</td>				  
               </tr>
               <tr>
				<td colspan="4">
				<?php
					$i=49;
					if($cur_client_match[$i]==1){
						echo "<div class='flag_err'>";
					}else{
						echo "<div class='flag_success'>";
					}
					?>
				<table>
				<tr>			   
                  <td class="element-style">&lt;ul&gt;</td>
				<?php
					
					if($cur_client_match[$i]==1){
						echo "<td class='element-support'>No</td><td class='element-status'>Failed</td><td class='element-code'>Not Recommended</td>";
					}else{
						echo "<td class='element-support'>No</td><td class='element-status'>Passed</td><td class='element-code'></td>";
					}
				?></tr></table></div></td>
               </tr>
               <tr>
				<td colspan="4">
				<?php
					$i=50;
					if($cur_client_match[$i]==1){
						echo "<div class='flag_err'>";
					}else{
						echo "<div class='flag_success'>";
					}
					?>
				<table>
				<tr>			   
                  <td class="element-style">&lt;li&gt;</td>
				<?php
					
					if($cur_client_match[$i]==1){
						echo "<td class='element-support'>No</td><td class='element-status'>Failed</td><td class='element-code'>Not Recommended</td>";
					}else{
						echo "<td class='element-support'>No</td><td class='element-status'>Passed</td><td class='element-code'></td>";
					}
				?>	</tr></table></div></td>
				 </tr>	     
               <tr>
				<td colspan="4">
				<?php
					$i=51;
					if($cur_client_match[$i]==1){
						echo "<div class='flag_err'>";
					}else{
						echo "<div class='flag_success'>";
					}
					?>
				<table>
				<tr>			   
                  <td class="element-style">&lt;p&gt;</td>
				<?php
					
					if($cur_client_match[$i]==1){
						echo "<td class='element-support'>No</td><td class='element-status'>Failed</td><td class='element-code'>Not Recommended</td>";
					}else{
						echo "<td class='element-support'>No</td><td class='element-status'>Passed</td><td class='element-code'></td>";
					}
				?>		</tr></table></div></td>
				 </tr>	
               <tr>
				<td colspan="4">
				<?php
					$i=52;
					if($cur_client_match[$i]==1){
						echo "<div class='flag_err'>";
					}else{
						echo "<div class='flag_success'>";
					}
					?>
				<table>
				<tr>			   
                  <td class="element-style">&lt;big&gt;</td>
				<?php
 
					if($cur_client_match[$i]==1){
						echo "<td class='element-support'>No</td><td class='element-status'>Failed</td><td class='element-code'>Not Recommended</td>";
					}else{
						echo "<td class='element-support'>No</td><td class='element-status'>Passed</td><td class='element-code'></td>";
					}
				?>	</tr></table></div></td>
				 </tr>	 
               <tr>
				<td colspan="4">
				<?php
					$i=53;
					if($cur_client_match[$i]==1){
						echo "<div class='flag_err'>";
					}else{
						echo "<div class='flag_success'>";
					}
					?>
				<table>
				<tr>			   
                  <td class="element-style">&lt;center&gt;</td>
				<?php
					
					if($cur_client_match[$i]==1){
						echo "<td class='element-support'>No</td><td class='element-status'>Failed</td><td class='element-code'>Not Recommended</td>";
					}else{
						echo "<td class='element-support'>No</td><td class='element-status'>Passed</td><td class='element-code'></td>";
					}
				?>	</tr></table></div></td>
				 </tr>	
               <tr>
				<td colspan="4">
				<?php
					$i=54;
					if($cur_client_match[$i]==1){
						echo "<div class='flag_err'>";
					}else{
						echo "<div class='flag_success'>";
					}
					?>
				<table>
				<tr>			   
                  <td class="element-style">&lt;dd&gt;</td>
				<?php
					
					if($cur_client_match[$i]==1){
						echo "<td class='element-support'>No</td><td class='element-status'>Failed</td><td class='element-code'>Not Recommended</td>";
					}else{
						echo "<td class='element-support'>No</td><td class='element-status'>Passed</td><td class='element-code'></td>";
					}
				?>	</tr></table></div></td>
				 </tr>	 
               <tr>
				<td colspan="4">
				<?php
					$i=55;
					if($cur_client_match[$i]==1){
						echo "<div class='flag_err'>";
					}else{
						echo "<div class='flag_success'>";
					}
					?>
				<table>
				<tr>			   
                  <td class="element-style">&lt;dl&gt;</td>
				<?php
					
					if($cur_client_match[$i]==1){
						echo "<td class='element-support'>No</td><td class='element-status'>Failed</td><td class='element-code'>Not Recommended</td>";
					}else{
						echo "<td class='element-support'>No</td><td class='element-status'>Passed</td><td class='element-code'></td>";
					}
				?>	</tr></table></div></td>
				 </tr>	
               <tr>
				<td colspan="4">
				<?php
					$i=56;
					if($cur_client_match[$i]==1){
						echo "<div class='flag_err'>";
					}else{
						echo "<div class='flag_success'>";
					}
					?>
				<table>
				<tr>			   
                  <td class="element-style">&lt;dt&gt;</td>
				<?php
					
					if($cur_client_match[$i]==1){
						echo "<td class='element-support'>No</td><td class='element-status'>Failed</td><td class='element-code'>Not Recommended</td>";
					}else{
						echo "<td class='element-support'>No</td><td class='element-status'>Passed</td><td class='element-code'></td>";
					}
				?>	</tr></table></div></td>
				 </tr>	
               <tr>
				<td colspan="4">
				<?php
					$i=57;
					if($cur_client_match[$i]==1){
						echo "<div class='flag_err'>";
					}else{
						echo "<div class='flag_success'>";
					}
					?>
				<table>
				<tr>			   
                  <td class="element-style">&lt;em&gt;</td>
				<?php
					
					if($cur_client_match[$i]==1){
						echo "<td class='element-support'>No</td><td class='element-status'>Failed</td><td class='element-code'>Not Recommended</td>";
					}else{
						echo "<td class='element-support'>No</td><td class='element-status'>Passed</td><td class='element-code'></td>";
					}
				?>	</tr></table></div></td>
				 </tr>	
               <tr>
				<td colspan="4">
				<?php
					$i=58;
					if($cur_client_match[$i]==1){
						echo "<div class='flag_err'>";
					}else{
						echo "<div class='flag_success'>";
					}
					?>
				<table>
				<tr>			   
                  <td class="element-style">&lt;embed&gt;</td>
				<?php
					
					if($cur_client_match[$i]==1){
						echo "<td class='element-support'>No</td><td class='element-status'>Failed</td><td class='element-code'>Not Recommended</td>";
					}else{
						echo "<td class='element-support'>No</td><td class='element-status'>Passed</td><td class='element-code'></td>";
					}
				?></tr></table></div></td>
				 </tr>	
               <tr>
				<td colspan="4">
				<?php
					$i=59;
					if($cur_client_match[$i]==1){
						echo "<div class='flag_err'>";
					}else{
						echo "<div class='flag_success'>";
					}
					?>
				<table>
				<tr>			   
                  <td class="element-style">&lt;form&gt;</td>
				<?php
					
					if($cur_client_match[$i]==1){
						echo "<td class='element-support'>No</td><td class='element-status'>Failed</td><td class='element-code'>Not Recommended</td>";
					}else{
						echo "<td class='element-support'>No</td><td class='element-status'>Passed</td><td class='element-code'></td>";
					}
				?></tr></table></div></td>
				 </tr>	
               <tr>
				<td colspan="4">
				<?php
					$i=60;
					if($cur_client_match[$i]==1){
						echo "<div class='flag_err'>";
					}else{
						echo "<div class='flag_success'>";
					}
					?>
				<table>
				<tr>			   
                  <td class="element-style">&lt;h1&gt;</td>
				<?php
					
					if($cur_client_match[$i]==1){
						echo "<td class='element-support'>No</td><td class='element-status'>Failed</td><td class='element-code'>Not Recommended</td>";
					}else{
						echo "<td class='element-support'>No</td><td class='element-status'>Passed</td><td class='element-code'></td>";
					}
				?>	</tr></table></div></td>
				 </tr>	
               <tr>
				<td colspan="4">
				<?php
					$i=61;
					if($cur_client_match[$i]==1){
						echo "<div class='flag_err'>";
					}else{
						echo "<div class='flag_success'>";
					}
					?>
				<table>
				<tr>			   
                  <td class="element-style">&lt;h2&gt;</td>
				<?php
					
					if($cur_client_match[$i]==1){
						echo "<td class='element-support'>No</td><td class='element-status'>Failed</td><td class='element-code'>Not Recommended</td>";
					}else{
						echo "<td class='element-support'>No</td><td class='element-status'>Passed</td><td class='element-code'></td>";
					}
				?>	</tr></table></div></td>
				 </tr>	
               <tr>
				<td colspan="4">
				<?php
					$i=62;
					if($cur_client_match[$i]==1){
						echo "<div class='flag_err'>";
					}else{
						echo "<div class='flag_success'>";
					}
					?>
				<table>
				<tr>			   
                  <td class="element-style">&lt;h3&gt;</td>
				<?php
					
					if($cur_client_match[$i]==1){
						echo "<td class='element-support'>No</td><td class='element-status'>Failed</td><td class='element-code'>Not Recommended</td>";
					}else{
						echo "<td class='element-support'>No</td><td class='element-status'>Passed</td><td class='element-code'></td>";
					}
				?>		</tr></table></div></td>
				 </tr>	
               <tr>
				<td colspan="4">
				<?php
					$i=63;
					if($cur_client_match[$i]==1){
						echo "<div class='flag_err'>";
					}else{
						echo "<div class='flag_success'>";
					}
					?>
				<table>
				<tr>			   
                  <td class="element-style">&lt;h4&gt;</td>
				<?php
					
					if($cur_client_match[$i]==1){
						echo "<td class='element-support'>No</td><td class='element-status'>Failed</td><td class='element-code'>Not Recommended</td>";
					}else{
						echo "<td class='element-support'>No</td><td class='element-status'>Passed</td><td class='element-code'></td>";
					}
				?></tr></table></div></td>
				 </tr>	
               <tr>
				<td colspan="4">
				<?php
					$i=64;
					if($cur_client_match[$i]==1){
						echo "<div class='flag_err'>";
					}else{
						echo "<div class='flag_success'>";
					}
					?>
				<table>
				<tr>			   
                  <td class="element-style">&lt;h5&gt;</td>
				<?php
					
					if($cur_client_match[$i]==1){
						echo "<td class='element-support'>No</td><td class='element-status'>Failed</td><td class='element-code'>Not Recommended</td>";
					}else{
						echo "<td class='element-support'>No</td><td class='element-status'>Passed</td><td class='element-code'></td>";
					}
				?>	</tr></table></div></td>
				 </tr>	
               <tr>
				<td colspan="4">
				<?php
					$i=65;
					if($cur_client_match[$i]==1){
						echo "<div class='flag_err'>";
					}else{
						echo "<div class='flag_success'>";
					}
					?>
				<table>
				<tr>			   
                  <td class="element-style">&lt;h6&gt;</td>
				<?php
					
					if($cur_client_match[$i]==1){
						echo "<td class='element-support'>No</td><td class='element-status'>Failed</td><td class='element-code'>Not Recommended</td>";
					}else{
						echo "<td class='element-support'>No</td><td class='element-status'>Passed</td><td class='element-code'></td>";
					}
				?></tr></table></div></td>
				 </tr>	
               <tr>
				<td colspan="4">
				<?php
					$i=66;
					if($cur_client_match[$i]==1){
						echo "<div class='flag_err'>";
					}else{
						echo "<div class='flag_success'>";
					}
					?>
				<table>
				<tr>			   
                  <td class="element-style">&lt;input&gt;</td>
				<?php
					
					if($cur_client_match[$i]==1){
						echo "<td class='element-support'>No</td><td class='element-status'>Failed</td><td class='element-code'>Not Recommended</td>";
					}else{
						echo "<td class='element-support'>No</td><td class='element-status'>Passed</td><td class='element-code'></td>";
					}
				?></tr></table></div></td>
				 </tr>	
               <tr>
				<td colspan="4">
				<?php
					$i=67;
					if($cur_client_match[$i]==1){
						echo "<div class='flag_err'>";
					}else{
						echo "<div class='flag_success'>";
					}
					?>
				<table>
				<tr>			   
                  <td class="element-style">&lt;ol&gt;</td>
				<?php
					
					if($cur_client_match[$i]==1){
						echo "<td class='element-support'>No</td><td class='element-status'>Failed</td><td class='element-code'>Not Recommended</td>";
					}else{
						echo "<td class='element-support'>No</td><td class='element-status'>Passed</td><td class='element-code'></td>";
					}
				?>	</tr></table></div></td>
				 </tr>	
               <tr>
				<td colspan="4">
				<?php
					$i=68;
					if($cur_client_match[$i]==1){
						echo "<div class='flag_err'>";
					}else{
						echo "<div class='flag_success'>";
					}
					?>
				<table>
				<tr>			   
                  <td class="element-style">&lt;option&gt;</td>
				<?php
					
					if($cur_client_match[$i]==1){
						echo "<td class='element-support'>No</td><td class='element-status'>Failed</td><td class='element-code'>Not Recommended</td>";
					}else{
						echo "<td class='element-support'>No</td><td class='element-status'>Passed</td><td class='element-code'></td>";
					}
				?>	</tr></table></div></td>
				 </tr>	
               <tr>
				<td colspan="4">
				<?php
					$i=69;
					if($cur_client_match[$i]==1){
						echo "<div class='flag_err'>";
					}else{
						echo "<div class='flag_success'>";
					}
					?>
				<table>
				<tr>			   
                  <td class="element-style">&lt;select&gt;</td>
				<?php
					
					if($cur_client_match[$i]==1){
						echo "<td class='element-support'>No</td><td class='element-status'>Failed</td><td class='element-code'>Not Recommended</td>";
					}else{
						echo "<td class='element-support'>No</td><td class='element-status'>Passed</td><td class='element-code'></td>";
					}
				?>	</tr></table></div></td>
				 </tr>	
               <tr>
				<td colspan="4">
				<?php
					$i=70;
					if($cur_client_match[$i]==1){
						echo "<div class='flag_err'>";
					}else{
						echo "<div class='flag_success'>";
					}
					?>
				<table>
				<tr>			   
                  <td class="element-style">&lt;button&gt;</td>
				<?php
					
					if($cur_client_match[$i]==1){
						echo "<td class='element-support'>No</td><td class='element-status'>Failed</td><td class='element-code'>Not Recommended</td>";
					}else{
						echo "<td class='element-support'>No</td><td class='element-status'>Passed</td><td class='element-code'></td>";
					}
				?>	</tr></table></div></td>
				 </tr>	
               <tr>
				<td colspan="4">
				<?php
					$i=71;
					if($cur_client_match[$i]==1){
						echo "<div class='flag_err'>";
					}else{
						echo "<div class='flag_success'>";
					}
					?>
				<table>
				<tr>			   
                  <td class="element-style">&lt;label&gt;</td>
				<?php
					
					if($cur_client_match[$i]==1){
						echo "<td class='element-support'>No</td><td class='element-status'>Failed</td><td class='element-code'>Not Recommended</td>";
					}else{
						echo "<td class='element-support'>No</td><td class='element-status'>Passed</td><td class='element-code'></td>";
					}
				?></tr></table></div></td>	
				 </tr>	
               <tr>
				<td colspan="4">
				<?php
					$i=72;
					if($cur_client_match[$i]==1){
						echo "<div class='flag_err'>";
					}else{
						echo "<div class='flag_success'>";
					}
					?>
				<table>
				<tr>			   
                  <td class="element-style">&lt;fieldset&gt;</td>
				<?php
					
					if($cur_client_match[$i]==1){
						echo "<td class='element-support'>No</td><td class='element-status'>Failed</td><td class='element-code'>Not Recommended</td>";
					}else{
						echo "<td class='element-support'>No</td><td class='element-status'>Passed</td><td class='element-code'></td>";
					}
				?>	</tr></table></div></td>
				 </tr>	
               <tr>
				<td colspan="4">
				<?php
					$i=73;
					if($cur_client_match[$i]==1){
						echo "<div class='flag_err'>";
					}else{
						echo "<div class='flag_success'>";
					}
					?>
				<table>
				<tr>			   
                  <td class="element-style">&lt;script&gt;</td>
				<?php
					
					if($cur_client_match[$i]==1){
						echo "<td class='element-support'>No</td><td class='element-status'>Failed</td><td class='element-code'>Not Recommended</td>";
					}else{
						echo "<td class='element-support'>No</td><td class='element-status'>Passed</td><td class='element-code'></td>";
					}
				?>	</tr></table></div></td>
				 </tr>	
               <tr>
				<td colspan="4">
				<?php
					$i=74;
					if($cur_client_match[$i]==1){
						echo "<div class='flag_err'>";
					}else{
						echo "<div class='flag_success'>";
					}
					?>
				<table>
				<tr>			   
                  <td class="element-style">&lt;noscript&gt;</td>
				<?php
					
					if($cur_client_match[$i]==1){
						echo "<td class='element-support'>No</td><td class='element-status'>Failed</td><td class='element-code'>Not Recommended</td>";
					}else{
						echo "<td class='element-support'>No</td><td class='element-status'>Passed</td><td class='element-code'></td>";
					}
				?>	</tr></table></div></td>
				 </tr>	
               <tr>
				<td colspan="4">
				<?php
					$i=75;
					if($cur_client_match[$i]==1){
						echo "<div class='flag_err'>";
					}else{
						echo "<div class='flag_success'>";
					}
					?>
				<table>
				<tr>			   
                  <td class="element-style">&lt;small&gt;</td>
				<?php
					
					if($cur_client_match[$i]==1){
						echo "<td class='element-support'>No</td><td class='element-status'>Failed</td><td class='element-code'>Not Recommended</td>";
					}else{
						echo "<td class='element-support'>No</td><td class='element-status'>Passed</td><td class='element-code'></td>";
					}
				?>	</tr></table></div></td>
				 </tr>	
               <tr>
				<td colspan="4">
				<?php
					$i=76;
					if($cur_client_match[$i]==1){
						echo "<div class='flag_err'>";
					}else{
						echo "<div class='flag_success'>";
					}
					?>
				<table>
				<tr>			   
                  <td class="element-style">&lt;th&gt;</td>
				<?php
					
					if($cur_client_match[$i]==1){
						echo "<td class='element-support'>No</td><td class='element-status'>Failed</td><td class='element-code'>Not Recommended</td>";
					}else{
						echo "<td class='element-support'>No</td><td class='element-status'>Passed</td><td class='element-code'></td>";
					}
				?>	</tr></table></div></td>
				 </tr>	
               <tr>
				<td colspan="4">
				<?php
					$i=77;
					if($cur_client_match[$i]==1){
						echo "<div class='flag_err'>";
					}else{
						echo "<div class='flag_success'>";
					}
					?>
				<table>
				<tr>			   
                  <td class="element-style">&lt;tt&gt;</td>
				<?php
					
					if($cur_client_match[$i]==1){
						echo "<td class='element-support'>No</td><td class='element-status'>Failed</td><td class='element-code'>Not Recommended</td>";
					}else{
						echo "<td class='element-support'>No</td><td class='element-status'>Passed</td><td class='element-code'></td>";
					}
				?>	</tr></table></div></td>
				 </tr>	
               <tr>
				<td colspan="4">
				<?php
					$i=78;
					if($cur_client_match[$i]==1){
						echo "<div class='flag_err'>";
					}else{
						echo "<div class='flag_success'>";
					}
					?>
				<table>
				<tr>			   
                  <td class="element-style">&lt;textarea&gt;</td>
				<?php
					
					if($cur_client_match[$i]==1){
						echo "<td class='element-support'>No</td><td class='element-status'>Failed</td><td class='element-code'>Not Recommended</td>";
					}else{
						echo "<td class='element-support'>No</td><td class='element-status'>Passed</td><td class='element-code'></td>";
					}
				?>	</tr></table></div></td>
				 </tr>	
               <tr>
				<td colspan="4">
				<?php
					$i=79;
					if($cur_client_match[$i]==1){
						echo "<div class='flag_err'>";
					}else{
						echo "<div class='flag_success'>";
					}
					?>
				<table>
				<tr>			   
                  <td class="element-style">&lt;object&gt;</td>
				<?php
					
					if($cur_client_match[$i]==1){
						echo "<td class='element-support'>No</td><td class='element-status'>Failed</td><td class='element-code'>Not Recommended</td>";
					}else{
						echo "<td class='element-support'>No</td><td class='element-status'>Passed</td><td class='element-code'></td>";
					}
				?>	</tr></table></div></td>
				 </tr>	
               <tr>
				<td colspan="4">
				<?php
					$i=80;
					if($cur_client_match[$i]==1){
						echo "<div class='flag_err'>";
					}else{
						echo "<div class='flag_success'>";
					}
					?>
				<table>
				<tr>			   
                  <td class="element-style">&lt;param&gt;</td>
				<?php
					
					if($cur_client_match[$i]==1){
						echo "<td class='element-support'>No</td><td class='element-status'>Failed</td><td class='element-code'>Not Recommended</td>";
					}else{
						echo "<td class='element-support'>No</td><td class='element-status'>Passed</td><td class='element-code'></td>";
					}
				?>	</tr></table></div></td>
				 </tr>	
               <tr>
				<td colspan="4">
				<?php
					$i=81;
					if($cur_client_match[$i]==1){
						echo "<div class='flag_err'>";
					}else{
						echo "<div class='flag_success'>";
					}
					?>
				<table>
				<tr>			   
                  <td class="element-style">&lt;tbody&gt;</td>
				<?php
					
					if($cur_client_match[$i]==1){
						echo "<td class='element-support'>No</td><td class='element-status'>Failed</td><td class='element-code'>Not Recommended</td>";
					}else{
						echo "<td class='element-support'>No</td><td class='element-status'>Passed</td><td class='element-code'></td>";
					}
				?>	</tr></table></div></td>
				 </tr>					 				 				 				 				 				 				 				 				 				 				 				 				 				 				 				 				 				 				 				 				 				 				 				 				 	 				 				 				 
           </tbody>
         </table>
			 	</div>
				</td>
			</tr>			
			</table>
		</div>		
		
<?php
			
		}	// END RENDER MODULE
		?> 				
		<div id="footer">
			<div class="copyright">
				Copyright &copy; 2008 <a href="mailto:j5@jony5.com">Jonathan Harris</a>. All Rights Reserved.<br />
				<!--<div class="ok"><a href="http://validator.w3.org/check?uri=referer" target="_blank">XHTML</a></div>-->
				<div class="ok"><a href="http://jigsaw.w3.org/css-validator/check/referer" target="_blank">CSS</a></div>
				Hosted by <a href="http://www.bluehost.com/" target="_blank">BlueHost</a>.</div>
		</div>
	</div>

</div>
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
var pageTracker = _gat._getTracker("UA-2181418-7");
pageTracker._initData();
pageTracker._trackPageview();
</script>
</body>
</html>
