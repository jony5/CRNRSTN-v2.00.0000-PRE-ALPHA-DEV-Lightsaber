<?php
#  CRNRSTN :: An Advanced PHP Class Library for Enterprise
#  Copyright (C) 2012 Jonathan 'J5' Harris.
#  VERSION :: 3.0.0
#  AUTHOR :: J5
#  URI :: http://jony5.com/crnrstn/
#  OVERVIEW :: All configuration parameters for initialization of environmentally specific variables for the application in all environments. Currently, there is 
#               support for 12 variables across up to 7 environemnts. I have also wired in support for up to 4 unique databases (each DB...potentially...having it's own unique 
#               handle for USER,PORT,HOST and PWD).
#  LICENSE :: This program is free software: you can redistribute it and/or modify
#  it under the terms of the GNU General Public License as published by
#  the Free Software Foundation, either version 3 of the License, or
#  (at your option) any later version.

#  This program is distributed in the hope that it will be useful,
#  but WITHOUT ANY WARRANTY; without even the implied warranty of
#  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
#  GNU General Public License for more details.

#  You should have received a copy of the GNU General Public License
#  along with this program. This license can also be downloaded from
#  my web site at (http://www.jony5.com/crnrstn/license.txt).  
#  If not, see <http://www.gnu.org/licenses/>

session_start();

//
// CORE SYSTEM INTEGRTIONS CLASSES
require_once('_config.inc.php');
require_once($ROOT.'/classes/env/crnrstn.env.inc.php');											// ENVIRONMENT
require_once($__ENV->FILEROOT_HTTP().'/classes/security/ip/crnrstn.restrict.inc.php');			// SECURITY - IP RESTRICTIONS
require_once($__ENV->FILEROOT_HTTP().'/classes/log/crnrstn.log.inc.php');						// LOGGING
require_once($__ENV->FILEROOT_HTTP().'/classes/db/drivers/mysqli/crnrstn.mysqli.inc.php');		// DATABASE
require_once($__ENV->FILEROOT_HTTP().'/classes/browser/crnrstn.browser.inc.php');				// CLIENT BROWSER
require_once($__ENV->FILEROOT_HTTP().'/classes/form/crnrstn.form.inc.php');						// FORMS
require_once($__ENV->FILEROOT_HTTP().'/classes/user/crnrstn.user.inc.php');						// USER

$_SESSION['oUser'] = new User("User::__construct");
$_SESSION['oBrowser'] = new Browser($__ENV);

## ##
# SESSION INITIALIZATION CHECK #
## ##
 
if(!$_SESSION['oUser']->isLoggedIn()){
	//
	// USER LOGIN OBJECT PREPERATION
	// # INITIALIZE USER SESSION FROM COOKIE :: NEW USERS (NULL COOKIE) GET A DIFFERENT INITIALIZATION EXPERIENCE :: (PREPOPULATE LOGIN USERNAME IF EXISTING COOKIE LAST MODIFIED DATE NEWER THAN N DAYS)
	
	$HTTP_RAW_POST_DATA = isset($_POST) ? $_POST : '';
	
	if (!empty($_POST)){
		// 
		// I HAVE POST DATA
		//$_SESSION['oForm']->_form_id=strtolower(addslashes(trim($_POST['un'])));
		
		//$password=addslashes(trim($_POST['pwd']));
		//$passwordHash = md5($password); 	
		
		echo "<br>".$_SESSION['oForm']->_form_id;
	
	}else{
		echo $_SESSION['oBrowser']->_clientHeader;
		?>

        <div class="cb_100"></div>
        <div id="login-wrapper">
            <div class="title"><span class="crnrstn-title">CRNRSTN</span> :: An Advanced PHP Class Library</div>
            <div class="cb" style="border-bottom:1px solid #ccc; width:100%; text-align:left; padding-top:7px;">&nbsp;</div>
            <div class="cb_10"></div>
            <div class="input-wrapper">
                <form id="login" name="login" method="post" action="#">
                <div id="un_shell" >
                    <div class="field-name">username</div>
                    <div class="inputbx">
                        <input class="login-field" name="un" id="un" type="text" size="20" maxlength="50" value="" />
                        <div class="cb"></div>
                        <div class="err_msg" id="un_req">Required</div>
                    </div>
                    <div class="cb"></div>
                </div>
                
                <div id="pwd_shell" >
                    <div class="field-name">password</div>
                    <div class="inputbx">
                        <input class="login-field" name="pwd" id="pwd" type="password" size="20" maxlength="50" value="" />
                        <div class="cb"></div>
                        <div class="err_msg" id="pwd_req">Required</div>
                    </div>
                    <div class="cb_10"></div>
                </div>
                
                <div class="form-text-link"><a href="#">Forget something?</a></div>
                
                <div class="btn-wrapper" onclick="if(!validData('contactform')){return false;}else{$('contactform').submit();}">
                	<div class="btn-text">SUBMIT</div>
                </div>
                
                </form>
            </div>
            <div class="cb_medium"></div>
            <div class="cb_medium"></div>
            <div id="footer-copyright">&copy; <?php echo date('Y'); ?> All rights reserved</div>
        </div>

<?php
		
	}

}else{
	
	echo "I am logged in...";
	//
	// GOOD JOB FOR THIS MORNING.
		
}
	
	//
	// FORM MANAGEMENT OBJECT - I REFUSE TO CODE ANYTHING MORE THAN ONCE.
	// DEFINE THE NUMBER OF FORMS ON THE PAGE AS WELL AS THE FIELDS FOR EACH AND THE VALIDATION REQUIREMENTS
	// WITH REGARDS TO HTML / VALIDATION / FUNCTIONALITY...IT SHOULD BE CUT AND PASTE + NAMING CONVENTIONS
	// START THIS AT THE OBJECT LEVEL, AND MANAGE BOTH THE SENDING AND RECEIVING FROM ONE SOURCE.
	$_SESSION['oForm'] = new Form('login', 'post', "_frm_login.php");
	
	//
	// INITIALIZE FIELDS
	//$_SESSION['oForm']->addField('login', 'FIELDNAME', required, visible, type, validationtype, defaultvalue);
	$_SESSION['oForm']->addField('login', 'un', true, true, 'input', 'required', '');
	$_SESSION['oForm']->addField('login', 'pwd', true, true, 'input', 'required', '');
	
//
// SEND CLIENT HEADER

 
?>

</body>
</html>