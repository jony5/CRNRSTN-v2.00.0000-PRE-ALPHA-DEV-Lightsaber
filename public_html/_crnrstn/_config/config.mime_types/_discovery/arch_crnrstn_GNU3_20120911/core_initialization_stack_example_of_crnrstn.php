<?php
session_start();

//
// CORE SYSTEM INTEGRTIONS CLASSES
require_once('_config.inc.php');
require_once($ROOT.'/classes/env/env.inc.php');									// ENVIRONMENT
require_once($__ENV->FILEROOT_HTTP().'/classes/security/ip/restrict.inc.php');	// SECURITY - IP RESTRICTIONS
require_once($__ENV->FILEROOT_HTTP().'/classes/log/log.inc.php');				// LOGGING
require_once($__ENV->FILEROOT_HTTP().'/classes/db/mysqli/mysqli.inc.php');		// DATABASE
require_once($__ENV->FILEROOT_HTTP().'/classes/browser/browser.inc.php');		// CLIENT BROWSER
require_once($__ENV->FILEROOT_HTTP().'/classes/forms/forms.inc.php');			// FORMS
require_once($__ENV->FILEROOT_HTTP().'/classes/user/user.inc.php');				// USER

$_SESSION['oUser'] = new User("User::__construct");
$_SESSION['oBrowser'] = new Browser($__ENV);

## ##
# SESSION INITIALIZATION CHECK #
## ##
if(!$_SESSION['oUser']->isLoggedIn()){
	//
	//
	echo "I am not logged in...";

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

        <div class="cb_medium"></div>
        <div id="login-wrapper">
            <div class="mlogo"><img src="<?php echo $__ENV->HTTP(); ?>/common/imgs/theme/<?php echo $_SESSION['oBrowser']->_theme;  ?>/logo_moxie_sm.gif" width="103" height="32" alt="Moxie" title="Moxie" /></div>
            <div class="cb" style="border-bottom:1px solid #ccc; width:100%; text-align:left; padding-top:7px;">&nbsp;</div>
            <div class="cb_small"></div>
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
                    <div class="cb_small"></div>
                </div>
                
                <div style="margin-left:75px;"><input class="btn-submit" name="Submit" type="submit" value="" style="background-image:url(<?php echo $__ENV->HTTP(); ?>/common/imgs/theme/<?php echo $_SESSION['oBrowser']->_theme;  ?>/submit_btn_signin.gif);" /></div>
                <div class="form-text-link"><a href="#">Can't access your account?</a></div>
                </form>
            </div>
            <div class="cb_medium"></div>
            <div class="cb_medium"></div>
            <div id="footer-copyright">&copy; <?php echo date(Y); ?> All rights reserved</div>
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