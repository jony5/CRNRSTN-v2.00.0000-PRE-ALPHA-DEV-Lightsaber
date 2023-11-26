class email {
	public var emailArray:Array;
	public var domainArray:Array;
	public var loginArray:Array;

	function getdomainArray(emails:Array):Array {
		return domainArray;
	}
	function builddomainArray(emailaddress:String):Array {
		emailArray.push(emailaddress);
		return emailArray;
	}
	function validateemail(email:String):Boolean {
		//validate email address
		return true;
	}
	function getEmailArray(exportedArray:Array){
		//trace(emailaddress);
		//trace(emailArray.length);
		//emailArray.push(emailaddress);
		
		//return emailArray;
	}
	function getLoginArray(exportedArray:Array){
		//trace(emaillogin);
		//trace(emailobject);
		//emailobject.loginArray.push(emaillogin);
		//trace(emailobject.loginArray.length)
		//return emailobject;
	}
	function constructnewbutton(myaddress, myurl){
		//make call to javascript to get email addresses
		btnemail_mc.emaildomain.text="Hello";
		
	}
	
	
}
