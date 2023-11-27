<?php
/* 
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
include_once($CRNRSTN_ROOT.'_crnrstn.config.inc.php');

require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/security/secure.inc.php');
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/session/session.inc.php');

require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/language/lang.inc.php');

//
// LANGUAGE SUPPORT
$oUSER->prepLangElem('SITE_TITLE|SITE_TITLE_STYLED|SITE_FOOTER_RIGHTS|SITE_TITLE_WEB_DEV|SITE_TITLE_DIGIT_MARKET|SITE_TITLE_AND|COMBO_SEL_DEVICE_MOBILE|COMBO_SEL_DEVICE_DESKTOP');

//
// LOAD DEVICE DETECT AFTER LANGUAGE PACK PREPPED FOR POPULATION OF COMBO COPY WITH LANG DATA
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/device/detect.inc.php');

//
// RETRIEVE USERS
$adminContent_ARRAY = $oUSER->loadClientSettings();


$queryIndex_ARRAY = array('clients_CLIENT_ID' => 0,'clients_ISACTIVE' => 1,
				'clients_COMPANYNAME_BLOB' => 2,'clients_DATEMODIFIED' => 3, 'clients_DATECREATED' => 4
				);


if($oCRNRSTN_ENV->oSESSION_MGR->getSessionParam("DEVICETYPE")=="m"){
?>

<!DOCTYPE html>
<html lang="<?php echo strtolower($oCRNRSTN_ENV->oSESSION_MGR->getSessionParam("LANGCODE")); ?>">
<head>
<?php
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/head/head.mobi.inc.php');
?>
</head>

<body>

<div data-role="page" id="myPage">
    <?php
	$tmp_formUnique = $oUSER->generateNewKey(4);
	require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/search/search.mobi.inc.php');
	require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/nav/dashboard.mobi.inc.php');
	require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/header/header.mobi.inc.php');
	?>
    
    
    
    <?php 
	if($oUSER->responseString=="admin_client_delete=success"){
	?>	
	<!-- 
    //
    // BEGIN MAIN CONTENT -->
	<div role="main" class="ui-content">
		<h3>Success</h3>
		<p>The client has been deleted from the system.</p>
		<div class="cb_10"></div>
      	<a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."dashboard/admin/client/"; ?>" class="ui-btn ui-icon-back ui-btn-icon-left ui-corner-all" data-ajax="false">Back to Clients</a>


	</div><!-- /content -->
		
	<?php	
	}else{
		if($oUSER->responseString!=""){
			
			//
			// 	WE HAVE AN ERROR
		?>
        <!-- 
        //
        // BEGIN MAIN CONTENT -->
        <div role="main" class="ui-content">
            <h3>Error</h3>
            <p>An error was experienced when the system attempted to delete the client from the site.</p>
            <div class="cb_10"></div>
            <a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."dashboard/admin/client/settings/?cid=".$adminContent_ARRAY[0][$queryIndex_ARRAY['clients_CLIENT_ID']];  ?>" class="ui-btn ui-icon-back ui-btn-icon-left ui-corner-all">Back to Client</a>
    
        </div><!-- /content -->
        
        
        <?php
			
		}else{
		
	?>
    <!-- 
    //
    // BEGIN MAIN CONTENT -->
	<div role="main" class="ui-content">
		<h3>delete client <?php echo $adminContent_ARRAY[0][$queryIndex_ARRAY['clients_COMPANYNAME_BLOB']]; ?></h3>
		<p>Do you wish to permanently delete this client?</p>
		<div class="cb_10"></div>
      	<form action="#" method="post" name="admin_client_delete" id="admin_client_delete"  enctype="multipart/form-data" data-ajax="false">				
            
            <button class="ui-shadow ui-btn ui-btn-inline ui-corner-all" type="submit" id="submit-3" style="background-color:#F00; color:#FFF;">DELETE CLIENT</button>
			<div class="cb_10"></div>
            <a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."dashboard/admin/client/settings/?cid=".$adminContent_ARRAY[0][$queryIndex_ARRAY['clients_CLIENT_ID']];  ?>" class="ui-btn ui-icon-back ui-btn-icon-left ui-corner-all">Back to Client</a>
                
            <input type="hidden" name="postid" id="postid" value="admin_client_delete">
            <input type="hidden" name="CLIENT_ID" value="<?php echo $adminContent_ARRAY[0][$queryIndex_ARRAY['clients_CLIENT_ID']]; ?>">
        </form>

	</div><!-- /content -->

	<?php
    require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/footer/ftr.mobi.inc.php');
    
    ?>

</div><!-- /page -->

</body>
</html>



	
<?php
		}
	}
}else{
?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/head/head.inc.php');
?>
</head>

<body>

<?php
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/header/header.inc.php');
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/nav/dashboard.inc.php');
?>

<main id="content">
<div id="dashboard_content_shell">
    <div class="cb_10"></div>

    <div id="form_shell" class="signin_shell">
        <div id="form_box">
            <div class="cb_10"></div>
            <div class="evif_logo_form"><img src="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/evifweb_logo_sm.gif" width="42" height="23" alt="eVifweb" title="5"></div>
            <div id="form_title">delete client <?php echo $adminContent_ARRAY[0][$queryIndex_ARRAY['clients_COMPANYNAME_BLOB']]; ?></div>
            <div class="cb_5"></div>
            <div class="form_element_label">Do you wish to permanently delete this client?</div>
            <div class="cb_30"></div>
        
           	<form action="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."dashboard/admin/client/";  ?>" method="post" name="admin_client_delete" id="admin_client_delete"  enctype="multipart/form-data" >
               
                <div class="cb_20"></div>
                <div id="submit_shell" class="form_submit_shell" style="width:230px;">
                <div id="admin_client_delete_submit_btn" class="form_submit_btn" onMouseOver="mycrnrstn_fhandler.submitBtnMouseOver(this); return false;" onMouseOut="mycrnrstn_fhandler.submitBtnMouseOut(this); return false;">DELETE CLIENT</div>
                </div>
                <div class="cb_40"></div>
                <div class="copy"><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."dashboard/admin/client/settings/?cid=".$adminContent_ARRAY[0][$queryIndex_ARRAY['clients_CLIENT_ID']];  ?>">Back to Client</a></div>
                <div class="hidden">
                	<input type="hidden" name="postid" id="postid" value="admin_client_delete">
                    <input type="hidden" name="CLIENT_ID" value="<?php echo $adminContent_ARRAY[0][$queryIndex_ARRAY['clients_CLIENT_ID']]; ?>">
                    <input name="submitin" type="submit" value="submit" onClick="mycrnrstn_fhandler.formSubmit('admin_client_delete'); return false;">
                    <div id="login_main_errmsg"></div>
                </div>
                  
            </form>
        </div>
    </div>


</div>
</main>

<?php
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/footer/ftr.inc.php');
?>
</body>
</html>
<?php
}
?>
