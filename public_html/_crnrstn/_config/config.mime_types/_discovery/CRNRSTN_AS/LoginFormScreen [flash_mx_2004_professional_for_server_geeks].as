// Import the Messages class, which declares constant properties
// such as CUST_BAD_CREDENTIALS and CUST_DUPLICATE_UNAME
import venue.constants.Msgs;

dynamic class LoginFormScreen extends mx.screens.Form {

  // Declare constants
  static var NO_RECORD_FOUND:Number = -1;

  // Uncomment one of these lines to use the desired server
  // ColdFusion Version
  var ServiceWSDLURL = "http://localhost/venue/chapter11/UserCheck.cfc?WSDL";
  // ASP.NET Version
  //var ServiceWSDLURL = "http://localhost/venue/chapter11/UserCheck.asmx?WSDL";
  // Java Version
  //var ServiceWSDLURL = "http://localhost/venue/chapter11/UserCheck.jws?WSDL";
    
    
  // This function fires when this screen first loads
  function onLoad() {

    // Turn on data logging to monitor web service calls
    // (you can comment this out when no longer needed)
    //_global.__dataLogger = new mx.data.binding.Log();

    // Force the "_root" keyword to always refer to this SWF
    // (never another SWF that loaded this one externally)
    this._lockroot = true;
    
    // Make the other form invisible
    rootForm.RegisterForm.visible = false;

    // Create an instance of the BubbleMovieClip, named mcBubble
    _root.attachMovie("BubbleMovieClip", "mcBubble", 1000);
    
    // Set the WSDLURL of the WebServiceConnector components
    this.wsGetCustomerID.WSDLURL = ServiceWSDLURL;
    this.wsIsUsernameAvailable.WSDLURL = ServiceWSDLURL;
    this.wsCreateNewCustomer.WSDLURL = ServiceWSDLURL;

    // Hook up event listeners to web service connectors
    this.wsGetCustomerID.addEventListener("result", getCustomerID_Result);
    this.wsIsUsernameAvailable.addEventListener("result", isUsernameAvailable_Result);
    this.wsCreateNewCustomer.addEventListener("result", createNewCustomer_Result);
    
    // Hook up validation event listeners to form input fields
    this.parentForm.RegisterForm.tiFirstName.addEventListener("invalid", this.firstName_Invalid);
    this.parentForm.RegisterForm.tiLastName.addEventListener("invalid", lastName_Invalid);
    this.parentForm.RegisterForm.tiTelephone.addEventListener("invalid", telephone_Invalid);
    this.parentForm.RegisterForm.tiEmail.addEventListener("invalid", email_Invalid);
  }

  // Executes when the user clicks continue and is existing user
  function continueExisting() {
    if (validateUsernameAndPassword()) {
      this.wsGetCustomerID.trigger();
    }
  }
  
  // Executes when the user clicks continue and is existing user
  function continueNew() {
    if (validateUsernameAndPassword()) {
      this.wsIsUsernameAvailable.trigger();
    }
  }

  
  // Executes when server responds to a login attempt
  function getCustomerID_Result() {
    if (this.results == NO_RECORD_FOUND) {
      _root.mcBubble.showMessage(Msgs.CUST_BAD_CREDENTIALS, _parent.tiUsername);
    } else {
      _parent.returnCustomerID(this.results);
      return;
    }
  }

  // Executes when server responds to a "is username unique" request
  function isUsernameAvailable_Result() {
    // If server reports that the username is already taken
    if (this.results == false) { 
      _root.mcBubble.showMessage(Msgs.CUST_DUPLICATE_UNAME, _parent.tiUsername);
      return;
      
    // If the server reports that the username is available  
    } else {  
      // Send user to new-account-entry form
      _parent.visible = false;
      _parent.rootForm.RegisterForm.visible = true;
    }
  }

  
  // Executes when server responds to a create-new-user request
  function createNewCustomer_Result() {
    trace("got it " + this.results);
    _parent.returnCustomerID(this.results);
  }
  
  
  // Returns a customer ID to the root form
  // The root form can do whever it wants with the ID
  function returnCustomerID(id) {
    trace("Returning customer ID: " + id);
    this.rootForm.visible = false;
    _root.setCustomerID(id);
  }


  // Validates user entries on the first (login) form
  function validateUsernameAndPassword():Boolean {
    // Validate text field
    if (this.tiUsername.text == '') {
      _root.mcBubble.showMessage(Msgs.CUST_MISSING_UNAME, this.tiUsername);
      return false;
    };
    
    // Validate text field
    if (this.tiUsername.text.length < 5) {
      _root.mcBubble.showMessage(Msgs.CUST_INVALID_UNAME, this.tiUsername);
      return false;
    };
    
    // Validate text field
    if (this.tiPassword.text == '') {
      _root.mcBubble.showMessage(Msgs.CUST_MISSING_PSSWD, this.tiPassword);
      return false;
    };
    
    // Validate text field
    if (this.tiPassword.text.length < 5) {
      _root.mcBubble.showMessage(Msgs.CUST_INVALID_PSSWD, this.tiPassword);
      return false;
    };
    
    // If "new username" (as opposed to existing user) form is showing
    if (this.NewLoginOverlay.visible) {
      if (this.tiPassword.text != this.NewLoginOverlay.tiPassword.text) {
        _root.mcBubble.showMessage(Msgs.CUST_CONFIRM_PSSWD, this.NewLoginOverlay.tiPassword);
        return false;
      }
    };
    
    // Return true if all entries are valid
    return true;
  }
  
  
  // Validation event handlers for the form input fields
  function firstName_Invalid() {
    _root.mcBubble.showMessage(Msgs.CUST_MISSING_FNAME, this);
  }
  function lastName_Invalid() {
    _root.mcBubble.showMessage(Msgs.CUST_MISSING_LNAME, this);
  }
  function telephone_Invalid() {
    _root.mcBubble.showMessage(Msgs.CUST_INVALID_PHONE, this);
  }
  function email_Invalid() {
    _root.mcBubble.showMessage(Msgs.CUST_INVALID_EMAIL, this);
  }

}