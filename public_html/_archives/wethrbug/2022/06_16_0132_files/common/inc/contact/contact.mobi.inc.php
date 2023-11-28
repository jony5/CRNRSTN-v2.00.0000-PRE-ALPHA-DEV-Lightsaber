	<div data-role="panel" id="rightpanel_contact" data-position="right">
        
         <div class="ui-panel-inner">
         	<h3 style="float:left; margin-top:10px;"><?php echo $oUSER->getLangElem('TITLE_CONTACT_US'); ?></h3>
         	<div style="float:right;"><a href="#close_lnk" data-rel="close" data-icon="delete" class="ui-btn ui-shadow ui-corner-all ui-icon-delete ui-nodisc-icon ui-btn-b ui-btn-inline ui-mini ui-btn-icon-right"><?php echo $oUSER->getLangElem('BUTTON_MOBI_CLOSE'); ?></a></div>
            <div class="cb_5"></div>
 	        <form action="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>contact/confirm/" method="post" name="contact_home" id="contact_home"  enctype="multipart/form-data" data-ajax="false">				
            	<label for="text-basic"><?php echo strtolower($oUSER->getLangElem('INPUT_TITLE_FIRST_NAME')); ?> <span class="req_star">*</span></label>
            	<input type="text" name="fname" id="fname" value="">
                <div class="frm_errstatus fname" style="width:100%; display:none;"><?php echo $oUSER->getLangElem('ERR_REQ_FNAME'); ?></div>
                
                <label for="text-basic"><?php echo strtolower($oUSER->getLangElem('INPUT_TITLE_LAST_NAME')); ?> <span class="req_star">*</span></label>
            	<input type="text" name="lname" id="lname" value="">
                <div class="frm_errstatus lname" style="width:100%; display:none;"><?php echo $oUSER->getLangElem('ERR_REQ_LNAME'); ?></div>
                
                <label for="text-basic"><?php echo $oUSER->getLangElem('TEXT_LOWERCASE_EMAIL'); ?> <span class="req_star">*</span></label>
            	<input type="text" name="email" id="email" value="">
                <div class="frm_errstatus email" style="width:100%; display:none;"><?php echo $oUSER->returnAvailErrMsg('email'); ?></div>
                <div class="frm_errstatus emailcontact_req_mobile" style="width:100%; display:none;"><?php echo $oUSER->getLangElem('ERR_REQ_EMAIL'); ?></div>
           	 	<div class="frm_errstatus emailcontact_invalid_mobile" style="width:100%; display:none;"><?php echo $oUSER->getLangElem('ERR_VALID_EMAIL'); ?></div>
            
                <label for="text-basic"><?php echo strtolower($oUSER->getLangElem('INPUT_TITLE_MOBILE_NUMBER')); ?></label>
            	<input type="text" name="mobilenumber" id="mobilenumber" value="">
                
                <fieldset data-role="controlgroup">
                    <input type="checkbox" name="ASSIST_ACCNT_CREATION" id="ASSIST_ACCNT_CREATION">
                    <label for="ASSIST_ACCNT_CREATION">I need help to create and/or to sign into my account.</label>
                    <input type="checkbox" name="ASSIST_OBS_INTEGRATE" id="ASSIST_OBS_INTEGRATE">
                    <label for="ASSIST_OBS_INTEGRATE">I am having trouble setting up OBS with this overlay system.</label>
                </fieldset>
                
                <label for="textarea"><?php echo strtolower($oUSER->getLangElem('INPUT_TITLE_OPT_MESSAGE')); ?></label>
                <textarea cols="40" rows="8" name="feedback" id="feedback"></textarea>
                
                
				<button class="ui-shadow ui-btn ui-corner-all" type="submit" id="submit-2"><?php echo $oUSER->getLangElem('BUTTON_CONTACT_US'); ?></button>
                <input type="hidden" name="postid" id="postid" value="contact_home">
                <input type="hidden" name="LANGCODE" id="LANGCODE" value="<?php echo strtoupper($oCRNRSTN_ENV->oSESSION_MGR->getSessionParam("LANGCODE")); ?>">
            </form>
            <a href="#close_lnk" data-rel="close" data-icon="delete" class="ui-btn ui-shadow ui-corner-all ui-icon-delete ui-nodisc-icon ui-btn-b ui-btn-inline ui-mini ui-btn-icon-right"><?php echo $oUSER->getLangElem('BUTTON_MOBI_CANCEL'); ?></a>
        </div>
    </div><!-- /panel -->
    
    <script type="application/javascript" language="javascript">
	$( "#contact_home" ).submit(function( event ) {
		//
		// VALIDATE FORM
		return validateForm('contact_home');
	});
	
	</script>