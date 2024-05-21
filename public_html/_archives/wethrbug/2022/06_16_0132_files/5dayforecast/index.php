<?php
/*
// J5
// Code is Poetry */
header('Access-Control-Allow-Origin: *');

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

if($oCRNRSTN_ENV->oSESSION_MGR->getSessionParam("DEVICETYPE") == "m" || $oCRNRSTN_ENV->getEnvParam('MOBILE_ONLY') == true){

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
    <div data-role="page">
        <?php
        //require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/nav/main.mobi.inc.php');
        require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/contact/contact.mobi.inc.php');
        require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/header/header_unauth.mobi.inc.php');
        ?>

        <!--
        //
        // BEGIN MAIN CONTENT -->
        <div role="main" class="ui-content">
            <div class="cb"></div>

            <h1 style="color: #090; padding-bottom:0; margin-bottom:0;">Get Wethr Forecast:<div class="wthrbg_title_sub_title">Pulling real-time weather forecasts through a National Weather Services Web API for fast and accurate results.</div></h1>
            <div id="forecast_locale"></div>
            <div>
                <div id="toggle_daynight"><a id="toggle_daynight_anchor" href="#" target="_self" onclick="toggleDayNight(this);" style="color:#0066CC; font-weight:normal;" data-ajax="false">View Evening Forecast</a></div>
                <div id="toggleUnit_wrapper" class="toggleUnit_wrapper">
                    <div class="toggleUnit_rel">
                        <div id="toggleUnit_btn" class="toggleUnit_btn" onmouseover="unitConversionHover(this, 'ON'); return false;" onmouseout="unitConversionHover(this); return false;" onmousedown="unitConversionHover(this, 'MOUSE_DOWN'); return false;" onmouseup="unitConversionHover(this, 'MOUSE_UP'); return false;" onclick="toggleUnit();">
                            <div class="toggleUnit_content">
                                <div id="toggleUnit_deg" class="toggleUnit_deg">&deg;</div>
                                <div id="toggleUnit_copy" class="toggleUnit_copy">C</div>
                                <div class="cb"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="forecast_day" class="hidden"></div>
            <div id="forecast_night" class="hidden"></div>
            <div id="forecast_day_celsius" class="hidden"></div>
            <div id="forecast_night_celsius" class="hidden"></div>

            <div id="wethrbug_geozip_zipcode" class="hidden"><?php

                if($oUSER->wthrbg_curr_zipcode!=''){

                    echo $oUSER->wthrbg_curr_zipcode;

                }else{

                    echo $oCRNRSTN_ENV->oSESSION_MGR->getSessionParam("XYGRID_ZIPCODE");

                }

                ?></div>
            <div id="wethrbug_geozip_city" class="hidden"><?php

                if($oUSER->wthrbg_curr_city!=''){

                    echo $oUSER->wthrbg_curr_city;

                }else{

                    echo $oCRNRSTN_ENV->oSESSION_MGR->getSessionParam("XYGRID_CITY");

                }

                ?></div>
            <div id="wethrbug_geozip_state" class="hidden"><?php

                if($oUSER->wthrbg_curr_state!=''){

                    echo $oUSER->wthrbg_curr_state;

                }else{

                    echo $oCRNRSTN_ENV->oSESSION_MGR->getSessionParam("XYGRID_STATE");

                }

                ?></div>
            <div id="wethrbug_geozip_wikipedia" class="hidden"><?php

                if($oUSER->wthrbg_xygrid_wikipedia!=''){

                    echo $oUSER->wthrbg_xygrid_wikipedia;

                }else{

                    echo $oCRNRSTN_ENV->oSESSION_MGR->getSessionParam("XYGRID_WIKIPEDIA");

                }

                ?></div>
            <div id="xygrid_geozip_uri" class="hidden"><?php

                if($oUSER->wthrbg_xygrid_uri != ""){

                    echo $oUSER->wthrbg_xygrid_uri;

                }else{

                    $tmp_xygrid_uri = $oCRNRSTN_ENV->oSESSION_MGR->getSessionParam("XYGRID_URI");
                    if($tmp_xygrid_uri!=""){

                        echo $tmp_xygrid_uri;

                    }

                }
                ?></div>
            <div id="xygrid_forecast_output"><?php

                if($oUSER->wthrbg_xygrid_uri!=""){
                    ?>
                    <img src="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/long_loader.gif" title="Loading icon." alt="Loading..." width="220" height="19">
                    <?php
                }else{

                    echo '<a href="'.$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'" target="_self" data-ajax="false" style="font-weight:normal; color:#0066CC;">Click here</a> for wethr lookup.';
                }

                ?></div>
            <div class="cb_10"></div>
            <div>
                <div id="toggle_daynight_btm"><a href="#" target="_self" onclick="toggleDayNight(this);"  style="color:#0066CC; font-weight:normal;" data-ajax="false">View Evening Forecast</a></div>
                <div id="toggleUnit_wrapper_btm" class="toggleUnit_wrapper">
                    <div class="toggleUnit_rel">
                        <div id="toggleUnit_btn_btm" class="toggleUnit_btn_btm" onmouseover="unitConversionHover(this, 'ON'); return false;" onmouseout="unitConversionHover(this); return false;" onmousedown="unitConversionHover(this, 'MOUSE_DOWN'); return false;" onmouseup="unitConversionHover(this, 'MOUSE_UP'); return false;" onclick="toggleUnit();">
                            <div class="toggleUnit_content">
                                <div id="toggleUnit_deg_btm" class="toggleUnit_deg">&deg;</div>
                                <div id="toggleUnit_copy_btm" class="toggleUnit_copy">C</div>
                                <div class="cb"></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="cb_20"></div>

        </div><!-- /content -->

        <div data-role="popup" id="popupViewJSON" class="ui-content" data-theme="b" data-arrow="false">
            <a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn-a ui-icon-delete ui-btn-icon-notext ui-btn-right">Close</a>
            <div id="nws_jason_header"></div>
            <div class="cb_5" style="border-bottom: 2px solid #ccc;"></div>
            <div class="cb_5"></div>
            <div style="width:100%; font-family:Courier, monospace;">
                <div style="height:350px; overflow: scroll;">
                    <div id="nws_json_raw"></div>
                </div>
            </div>
        </div>

        <?php

        for($i = 0; $i < 20; $i++){
            ?>
            <div data-role="popup" id="popupViewMORE_<?php echo $i; ?>" class="ui-content" data-theme="b" data-arrow="false">
                <a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn-a ui-icon-delete ui-btn-icon-notext ui-btn-right">Close</a>
                <div id="nws_json_headerMORE_<?php echo $i; ?>"></div>
                <div class="cb_5" style="border-bottom: 2px solid #ccc;"></div>
                <div class="cb_5"></div>
                <div style="width:100%; font-family:Courier, monospace;">
                    <div style="height:350px; width:288px; overflow: scroll;">
                        <div style="position:absolute; padding:330px 0 0 270px;"><img src="http://wethrbug.jony5.com/_crnrstn/creative/5.gif" width="17" height="16" alt="5" title="5" border="0"></div>
                        <div id="nws_json_rawMORE_<?php echo $i; ?>"></div>
                    </div>
                </div>
            </div>

            <script>
                $.mobile.document.on( "click", "#open-popupViewMORE_<?php echo $i; ?>", function( evt ) {
                    $( "#popupViewMORE_<?php echo $i; ?>" ).popup( "open", { x: evt.pageX, y: evt.pageY } );

                    $( "#popupViewMORE_<?php echo $i; ?>" ).popup({
                        afterclose: function( event, ui ) {
                            //$('#stream').focus();
                        }
                    });

                    evt.preventDefault();
                });

            </script>

            <?php
        }

        for($i = 0; $i < 20; $i++){
            ?>
            <div data-role="popup" id="popupViewMORE_celsius_<?php echo $i; ?>" class="ui-content" data-theme="b" data-arrow="false">
                <a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn-a ui-icon-delete ui-btn-icon-notext ui-btn-right">Close</a>
                <div id="nws_json_headerMORE_celsius_<?php echo $i; ?>"></div>
                <div class="cb_5" style="border-bottom: 2px solid #ccc;"></div>
                <div class="cb_5"></div>
                <div style="width:100%; font-family:Courier, monospace;">
                    <div style="height:350px; width:288px; overflow: scroll;">
                        <div style="position:absolute; padding:330px 0 0 270px;"><img src="http://wethrbug.jony5.com/_crnrstn/creative/5.gif" width="17" height="16" alt="5" title="5" border="0"></div>
                        <div id="nws_json_rawMORE_celsius_<?php echo $i; ?>"></div>
                    </div>
                </div>
            </div>

            <script>
                $.mobile.document.on( "click", "#open-popupViewMORE_celsius_<?php echo $i; ?>", function( evt ) {
                    $( "#popupViewMORE_celsius_<?php echo $i; ?>" ).popup( "open", { x: evt.pageX, y: evt.pageY } );

                    $( "#popupViewMORE_celsius_<?php echo $i; ?>" ).popup({
                        afterclose: function( event, ui ) {
                            //$('#stream').focus();
                        }
                    });

                    evt.preventDefault();
                });

            </script>

            <?php
        }

        ?>

        <script>
            $.mobile.document.on( "click", "#open-popupViewJSON", function( evt ) {
                $( "#popupViewJSON" ).popup( "open", { x: evt.pageX, y: evt.pageY } );

                $( "#popupViewJSON" ).popup({
                    afterclose: function( event, ui ) {
                        //$('#stream').focus();
                    }
                });

                evt.preventDefault();
            });

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