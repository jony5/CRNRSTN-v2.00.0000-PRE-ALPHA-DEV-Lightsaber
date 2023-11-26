// JavaScript Document

function h_init(){
	var mytextarea = $("H");	
	mytextarea.focus();
	mytextarea.select();
}

function processHTML(){
	var htmlsubmit_value=$("H").value;
	if(htmlsubmit_value.length>25){
		return true;
	}else{
		return false;	
	}		
}