<?php
/* 
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
include_once($CRNRSTN_ROOT . '_crnrstn.config.inc.php');
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/session/session.inc.php');
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/language/lang.inc.php');

//
// LANGUAGE SUPPORT
$tmp_lang_elem = 'SITE_TITLE|SITE_TITLE_STYLED|SITE_FOOTER_RIGHTS|SITE_TITLE_WEB_DEV|SITE_TITLE_DIGIT_MARKET|SITE_TITLE_AND|ERR_ACCNT_LOCKED|ERR_ACCNT_ADMIN_DELETED|ERR_ACCNT_USER_DELETED|ERR_ACCNT_ACTIVATED_A|ERR_ACCNT_ACTIVATED_B|TEXT_CLICK_HERE|ERR_INVALID_LOGIN|ERR_REQ_EMAIL|ERR_VALID_EMAIL|ERR_REQ_PWD|ERR_REQ_FNAME|ERR_REQ_LNAME|TITLE_FORGOT_PWD';
$tmp_lang_elem .= '|TITLE_NO_ACCOUNT|TEXT_TO_SIGN_UP|TEXT_TO_RESET_YOUR_PASSWORD|BUTTON_SIGN_IN|TITLE_SIGN_IN|TEXT_LOWERCASE_EMAIL|TEXT_LOWERCASE_PWD|INPUT_TITLE_FIRST_NAME|INPUT_TITLE_LAST_NAME|INPUT_TITLE_MOBILE_NUMBER|BUTTON_MOBI_CLOSE';
$tmp_lang_elem .= '|TEXT_STRENGTHEN_WEB|TEXT_MARKETING_SERVICES|BUTTON_CONTACT_US|TEXT_LOWERCASE_EMAIL|BUTTON_CONTACT_US|INPUT_TITLE_OPT_MESSAGE|TITLE_CONTACT_US|BUTTON_MOBI_CANCEL|COMBO_SEL_DEVICE_MOBILE|COMBO_SEL_DEVICE_DESKTOP';

$oUSER->prepLangElem($tmp_lang_elem);

if($oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, 'reset')=='true'){
	$oUSER->transactionStatusUpdate('success','pwd_update');	
}

//
// LOAD DEVICE DETECT AFTER LANGUAGE PACK PREPPED FOR POPULATION OF COMBO COPY WITH LANG DATA
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/device/detect.inc.php');

if($oCRNRSTN_ENV->oSESSION_MGR->getSessionParam("DEVICETYPE") == "m" ||  $oCRNRSTN_ENV->getEnvParam('MOBILE_ONLY') == true){
	
?>	
<!DOCTYPE html>
<html lang="<?php echo strtolower($oCRNRSTN_ENV->oSESSION_MGR->getSessionParam("LANGCODE")); ?>">
<head>
<?php
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/head/head.mobi.inc.php');
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/style.inc.php');
?>
</head>

<body>
<div data-role="page" id="wethrReqInput">
    <?php
	//require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/nav/main.mobi.inc.php');
	//require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/contact/contact.mobi.inc.php');
	require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/header/header_unauth.mobi.inc.php');
	?>
    
    <!-- 
    //
    // BEGIN MAIN CONTENT -->
	<div role="main" class="ui-content">
        <div id="activity_log_output"></div>
        <div class="cb"></div>

		<h1 style="color: #090;">Get Wethr Forecast:<div class="wthrbg_title_sub_title">Pulling real-time weather forecasts through a National Weather Services Web API for fast and accurate results.</div></h1>
        <form action="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>5dayforecast/" method="post" name="wethrbug_forecastRequest" id="wethrbug_forecastRequest"  class="ui-filterable" enctype="multipart/form-data"  data-ajax="false">

            <!--<label for="mobilenum">mobile number</label>
            <input type="text" name="mobilenum" id="mobilenum" value="" style="text-shadow:none;">
            <div class="wthrbg_small_sub_title">Standard text and data rates may apply.</div>
            <div class="cb_10"></div>
            <div class="frm_errstatus mobilenum_req" style="width:100%; display:none;"><?php echo $oUSER->getLangElem('ERR_REQ_EMAIL'); ?></div>
            <div class="frm_errstatus mobilenum_invalid" style="width:100%; display:none;"><?php echo $oUSER->getLangElem('ERR_VALID_EMAIL'); ?></div>
            -->
            <label for="autocomplete-input">city, state<span class="req_star">&nbsp;</span><span id="cityState_star" class="req_star">*</span></label>
            <input id="autocomplete-input" class="ui-shadow ui-corner-all ui-btn-b ui-btn-icon-right ui-icon-search" name="cityState" value="" placeholder="City, State" autocomplete="new-password" style="text-shadow:none;">
            <div class="wthrbg_small_sub_title">Powered by <a href="https://public.opendatasoft.com/" target="_blank" data-ajax="false">opendatasoft</a>.</div>
            <ul id="autocomplete" data-role="listview" data-inset="true" data-filter="true" data-input="#autocomplete-input"></ul>
            <input type="hidden" id="locale_geoid" name="locale_geoid">
            <input type="hidden" id="locale_geopoint" name="locale_geopoint">
            <input type="hidden" id="locale_city" name="locale_city">
            <input type="hidden" id="locale_state" name="locale_state">
            <input type="hidden" id="locale_zipcode" name="locale_zipcode">
            <input type="hidden" id="locale_wikipedia" name="locale_wikipedia">

            <label for="zipcode">zipcode<span class="req_star">&nbsp;</span><span id="zipcode_star" class="req_star">*</span></label>
            <input type="text" name="zipcode" id="zipcode" value="" placeholder="12345" style="text-shadow:none;">


            <div class="wthrbg_small_sub_title">Enter ZIPCODE. Get for wethr forecast.</div>
            <div class="frm_errstatus zipcode_req" style="width:100%; display:none;">Zipcode is required.</div>
            <div class="frm_errstatus zipcode_invalid" style="width:100%; display:none;">Invalid zipcode.</div>
            <div class="frm_errstatus one_required_invalid" style="width:100%; display:none;">At least one required (*) field must be completed above.</div>

            <div class="frm_errstatus account_locked" style="width:100%; <?php echo $oUSER->errDisplay('ERR_INVALID_LOGIN'); ?>"><?php echo $oUSER->getLangElem('ERR_INVALID_LOGIN'); ?></div>
            <div class="frm_errstatus account_locked" style="width:100%; <?php echo $oUSER->errDisplay('ERR_ACCNT_LOCKED'); ?>"><?php echo $oUSER->getLangElem('ERR_ACCNT_LOCKED'); ?></div>
            <div class="frm_errstatus account_admin_deleted" style="width:100%; <?php echo $oUSER->errDisplay('ERR_ACCNT_ADMIN_DELETED'); ?>"><?php echo $oUSER->getLangElem('ERR_ACCNT_ADMIN_DELETED'); ?></div>
            <div class="frm_errstatus account_user_deleted" style="width:100%; <?php echo $oUSER->errDisplay('ERR_ACCNT_USER_DELETED'); ?>"><?php echo $oUSER->getLangElem('ERR_ACCNT_USER_DELETED'); ?></div>
            <div class="frm_errstatus account_activate" style="width:100%; <?php echo $oUSER->errDisplay('ERR_ACCNT_ACTIVATED_A'); ?>"><?php echo $oUSER->getLangElem('ERR_ACCNT_ACTIVATED_A').' <a href="'.$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'account/activate/resend/" target="_self" style="text-decoration:none; color:#06C;text-decoration:underline;">'.$oUSER->getLangElem('TEXT_CLICK_HERE')."</a> ".$oUSER->getLangElem('ERR_ACCNT_ACTIVATED_B'); ?></div>

            <div class="cb_15"></div>
            <button class="ui-shadow ui-btn ui-corner-all" type="submit" id="submit">Submit for Wethr</button>
            
            <input type="hidden" name="postid" id="postid_SIGNIN" value="wthr_req_submit">
            <input type="hidden" name="action_type" id="action_type" value="zipcode_submit">

            <input type="hidden" name="LANG_ID" id="LANG_ID" value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt(strtoupper($oCRNRSTN_ENV->oSESSION_MGR->getSessionParam("LANGCODE"))); ?>">
        </form>
        <div class="cb_10"></div>
      	<!--<div class="ui-body ui-body-a ui-corner-all">
      		<h3><?php echo $oUSER->getLangElem('TITLE_FORGOT_PWD'); ?></h3>
            <p><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>" data-ajax="false"><?php echo $oUSER->getLangElem('TEXT_CLICK_HERE'); ?></a> <?php echo $oUSER->getLangElem('TEXT_TO_RESET_YOUR_PASSWORD'); ?></p>
        </div>
        <div class="cb_20"></div>
		<div class="ui-body ui-body-a ui-corner-all">
			<h3><?php echo $oUSER->getLangElem('TITLE_NO_ACCOUNT'); ?></h3>
			<p><a href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>" data-ajax="false"><?php echo $oUSER->getLangElem('TEXT_CLICK_HERE'); ?></a> <?php echo $oUSER->getLangElem('TEXT_TO_SIGN_UP'); ?></p>
		</div>-->
        
	</div><!-- /content -->
	<script type="application/javascript" language="javascript">
	$( "#wethrbug_forecastRequest" ).submit(function( event ) {
		//
		// VALIDATE FORM
		return validateForm('wethrbug_forecastRequest');
	});

	<?php
	if(1==1){
	    ?>

    $( document ).on( "pagecreate", "#wethrReqInput", function() {
        $( "#autocomplete" ).on( "filterablebeforefilter", function ( e, data ) {
            var $ul = $( this ),
                $input = $( data.input ),
                value = $input.val(),
                html = "";
            $ul.html( "" );
            if ( value && value.length > 2 ) {
                $ul.html( "<li><div class='ui-loader'><span class='ui-icon ui-icon-loading'></span></div></li>" );
                $ul.listview( "refresh" );
                $.ajax({
                    url: "<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>/locale_search/",
                    dataType: "jsonp",
                    crossDomain: true,
                    data: {
                        q: $input.val()
                    }
                })
                    .then( function ( response ) {
                        $.each( response, function ( i, val ) {
                            //            $tmp_js_content .= '{"locale_name":"'.$tmp_ZG_CITY.', '.$tmp_SPROV_NAME.'","locale_wikipedia":"'.$tmp_SPROV_WIKIPEDIA.'","locale_filtertext":"'.$tmp_filter.'"}';
                            //locale_name, locale_geoid,locale_geopoint,locale_city,locale_state,locale_zipcode
                            html += "<li data-filtertext='"+ val['locale_filtertext'] +"'><a href='#' onclick='wthrbg_ugc_load(\"" + val['locale_name'] + "\",\"" + val['locale_geoid'] + "\",\"" + val['locale_geopoint'] + "\",\"" + val['locale_city'] + "\",\"" + val['locale_state'] + "\",\"" + val['locale_zipcode'] + "\",\"" + val['locale_wikipedia'] + "\");' data-ajax='false'>" + val['locale_name'] + "</a></li>";
                            //html += "<li>" + val['kivotosname'] + "</li>";
                            //html += "<li><a>" + val['kivotosname'] + "</a></li>";

                        });
                        $ul.html( html );
                        $ul.listview( "refresh" );
                        $ul.trigger( "updatelayout");
                    });
            }
        });
    });
        <?php

    }
    ?>

	
	</script>

	<?php
    require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/footer/ftr.mobi.inc.php');
    
    ?>

</div><!-- /page -->

</body>
</html>


	
<?php 

	
}
?>