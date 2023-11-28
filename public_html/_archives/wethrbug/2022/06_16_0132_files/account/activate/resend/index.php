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
        ?>
    </head>

    <body>
    <?php
    if(!isset($oUSER->transStatusMessage_ARRAY[0])) {
        error_log('Setting transStatusMessage_ARRAY[] to FALSE...NO STATUS REPORT IS POSSIBLE.');
        $oUSER->transStatusMessage_ARRAY[0] = 'false';
        $oUSER->transStatusMessage_ARRAY[1] = NULL;
    }

    if ($oUSER->transStatusMessage_ARRAY[0] == "user_transaction_success") {
        ?>
        <div data-role="page">
            <?php
            //require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/nav/main.mobi.inc.php');
            require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT') . $oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR') . '/common/inc/contact/contact.mobi.inc.php');
            require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT') . $oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR') . '/common/inc/header/header_unauth.mobi.inc.php');
            ?>

            <!--
            //
            // BEGIN MAIN CONTENT -->
            <div role="main" class="ui-content">
                <div class="cb"></div>

                <h1>Success!</h1>
                <div class="cb_10"></div>
                <div class="ui-body ui-body-a ui-corner-all">
                    <h3>Resending activation email</h3>
                    <p>Your request is being processed.</p>
                </div>

            </div><!-- /content -->

            <?php
            require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT') . $oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR') . '/common/inc/footer/ftr.mobi.inc.php');

            ?>

        </div><!-- /page -->


        <?php
    } else {
        ?>
        <div data-role="page">
            <?php
            //require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/nav/main.mobi.inc.php');
            require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT') . $oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR') . '/common/inc/contact/contact.mobi.inc.php');
            require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT') . $oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR') . '/common/inc/header/header_unauth.mobi.inc.php');
            ?>

            <!--
            //
            // BEGIN MAIN CONTENT -->
            <div role="main" class="ui-content">
                <div class="cb"></div>

                <h1>Resend account activation email</h1>
                <form action="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP') . $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>account/activate/resend/"
                      method="post" name="accnt_activate_resend" id="accnt_activate_resend"
                      enctype="multipart/form-data">

                    <label for="email_activate_mobile"><?php echo $oUSER->getLangElem('TEXT_LOWERCASE_EMAIL'); ?>
                        <span class="req_star">*</span></label>
                    <input type="text" name="email_activate_mobile" id="email_activate_mobile" value="">
                    <?php
                        if ($oUSER->transStatusMessage_ARRAY[0] != "user_transaction_success" && isset($oUSER->transStatusMessage_ARRAY[0])) {
                            echo '<div class="frm_errstatus email_invalid_mobile" style="width:100%;">'.$oUSER->transStatusMessage_ARRAY[1].'</div>';
                        }
                    ?>

                    <div class="frm_errstatus email_req_mobile"
                         style="width:100%; display:none;"><?php echo $oUSER->getLangElem('ERR_REQ_EMAIL'); ?></div>
                    <div class="frm_errstatus email_invalid_mobile"
                         style="width:100%; display:none;"><?php echo $oUSER->getLangElem('ERR_VALID_EMAIL'); ?></div>

                    <div class="frm_errstatus account_locked"
                         style="width:100%; <?php echo $oUSER->errDisplay('ERR_INVALID_LOGIN'); ?>"><?php echo $oUSER->getLangElem('ERR_INVALID_LOGIN'); ?></div>
                    <div class="frm_errstatus account_locked"
                         style="width:100%; <?php echo $oUSER->errDisplay('ERR_ACCNT_LOCKED'); ?>"><?php echo $oUSER->getLangElem('ERR_ACCNT_LOCKED'); ?></div>
                    <div class="frm_errstatus account_admin_deleted"
                         style="width:100%; <?php echo $oUSER->errDisplay('ERR_ACCNT_ADMIN_DELETED'); ?>"><?php echo $oUSER->getLangElem('ERR_ACCNT_ADMIN_DELETED'); ?></div>
                    <div class="frm_errstatus account_user_deleted"
                         style="width:100%; <?php echo $oUSER->errDisplay('ERR_ACCNT_USER_DELETED'); ?>"><?php echo $oUSER->getLangElem('ERR_ACCNT_USER_DELETED'); ?></div>

                    <button class="ui-shadow ui-btn ui-corner-all" type="submit"
                            id="submit">RESEND</button>

                    <input type="hidden" name="postid" id="postid_SIGNIN" value="accnt_activate_resend">
                    <input type="hidden" name="LANGCODE" id="LANGCODE_SIGNIN"
                           value="<?php echo strtoupper($oCRNRSTN_ENV->oSESSION_MGR->getSessionParam("LANGCODE")); ?>">
                </form>
                <div class="cb_10"></div>


            </div><!-- /content -->
            <script type="application/javascript" language="javascript">
                $("#accnt_activate_resend").submit(function (event) {
                    //
                    // VALIDATE FORM
                    return validateForm('accnt_activate_resend');
                });

            </script>

            <?php
            require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT') . $oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR') . '/common/inc/footer/ftr.mobi.inc.php');

            ?>

        </div><!-- /page -->


        <?php
    }
        ?>



    </body>
    </html>



    <?php


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
    require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/nav/main.inc.php');
    ?>

    <main id="content">
        <div id="form_shell" class="signin_shell">
            <div class="cb_30"></div>
            <div id="form_box">
                <div class="evif_logo_form"><img src="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/evifweb_logo_sm.gif" width="42" height="23" alt="eVifweb" title="5"></div>

                <?php
                if($oUSER->transStatusMessage_ARRAY[0]=="user_transaction_success"){
                    ?>
                    <div id="form_title">Your request is being processed.</div>
                    <div class="cb_30"></div>
                    <div class="cb_20"></div>
                    <?php
                }else{
                    ?>


                    <div id="form_title">Resend account activation email</div>
                    <div class="cb_30"></div>
                    <form action="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>account/pwdreset/" method="post" name="accnt_activate_resend" id="accnt_activate_resend"  enctype="multipart/form-data" >
                        <div class="form_input_shell">
                            <div id="email_form_element_label" class="form_element_label">email</div>
                            <div class="form_element_input"><input frm_init="crnrstn_frm_handle" crnrstn_frm_valtype="email" name="email" type="text" id="email" size="20" maxlength="100" value="" style="width:375px;" /></div>
                            <div class="cb"></div>
                            <div class="input_validation_copy_shell"><div id="email_input_validation_copy" class="input_validation_copy">Required</div></div>
                            <div class="cb"></div>
                        </div>
                        <div class="cb_10"></div>
                        <div id="login_main_errStatus" class="frm_errstatus" style="width:395px;"><?php echo $oUSER->errorMessage; ?></div>
                        <div class="cb_5"></div>
                        <table cellpadding="0" cellspacing="0" border="0" style="width:390px;">
                            <tr>
                                <td style="width:220px; padding-left:15px;"></td>
                                <td>
                                    <div id="submit_shell" class="form_submit_shell" style="width:220px;">
                                        <div id="accnt_activate_resend_submit_btn" class="form_submit_btn" onMouseOver="mycrnrstn_fhandler.submitBtnMouseOver(this); return false;" onMouseOut="mycrnrstn_fhandler.submitBtnMouseOut(this); return false;">RESEND EMAIL</div>
                                    </div>
                                </td>
                            </tr>
                        </table>
                        <div class="cb_30"></div>

                        <div class="cb_20"></div>
                        <div class="hidden">
                            <input name="submitin" type="submit" value="submit" onClick="mycrnrstn_fhandler.formSubmit('accnt_activate_resend'); return false;">
                            <div id="login_main_errmsg"></div>
                            <div id="feedback_max_char_cnt">2000</div>
                        </div>

                        <input type="hidden" name="LANGCODE" id="LANGCODE" value="EN">
                    </form>


                    <?php
                }
                ?>

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