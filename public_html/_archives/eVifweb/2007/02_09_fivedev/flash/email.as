class email {
	public var buttoncnt:Number;
	public var emailaddr:String;
	public var emailurl:String;
	public var emaildomain:String;
	public var buttonArray:Array;
	public var emailArray:Array;
	public var domainArray:Array;
	public var loginArray:Array;
	public var button_x_position:Number;

	function getdomain(email:String):Array {
		
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
		return _root.btnemail_mc.duplicateMovieClip("btnemail_mc"+buttoncnt,buttoncnt);
	}
	function onRelease(){
			//trace("hello eworkd-"+this.emailurl)
	}
	
	
}