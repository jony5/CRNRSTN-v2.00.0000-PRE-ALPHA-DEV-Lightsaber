var newwindow;

function sendblast()
{
	var windowuid = new Date().getTime(); 
	var blasturl="sendblast.php";
	window.open(blasturl,'blastwindow'+windowuid,'height=300,width=400');
}

function editmessages()
{
	var editmessageurl="emailtest.php?mode=editmessage";
	messageedit=window.open(editmessageurl,'_self');
}

function editrecipients()
{
	var editmessageurl="emailtest.php?mode=editrecipient";
	messageedit=window.open(editmessageurl,'_self');
}

function sendemail(emailaddress){
	//alert("-->"+emailaddress);
	var blasturl="sendblast.php?theemail="+emailaddress;
//	alert("-->>"+blasturl);
	soloemail(blasturl);	
}
function soloemail(myurl)
{
	var windowuid = new Date().getTime(); 
	var blasturl=myurl;
	window.open(blasturl,'blastwindow'+windowuid,'height=300,width=400');
}
