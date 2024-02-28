<?php

/* 
// J5
// Code is Poetry */

require('_crnrstn.root.inc.php');
include_once($CRNRSTN_ROOT . '_crnrstn.config.inc.php');
require($oUSER->getEnvParam('DOCUMENT_ROOT').$oUSER->getEnvParam('DOCUMENT_ROOT_DIR').'/social/fellowship/avsvc_overlay/admin/inc/session/session.inc.php');

//
// RETRIEVE OVERLAY STATE FROM DB
// DATABASE REQUEST/RESPONSE PROCESSING
$tmp_serial_handle = 'OVERLAY_DATUM';
$oDB_RESP = $oUSER->getOverlayStateDatum($tmp_serial_handle);

# STAGE DYNAMIC VARS FOR HTML/CSS INSERTION
// MINI
$tmp_mini_profile_id = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'OVERLAY_MGMT', 'MINI_PROFILE_ID');
$tmp_mini_OPACITY = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'MINI_CONFIG', 'OPACITY');
$tmp_mini_HEXCOLOR = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'MINI_CONFIG', 'HEXCOLOR');
$tmp_mini_DEFAULT_ABS_PX_FROM_TOP = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'MINI_CONFIG', 'DEFAULT_ABS_PX_FROM_TOP');
$tmp_mini_DEFAULT_MARGIN_LEFT = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'MINI_CONFIG', 'DEFAULT_MARGIN_LEFT');
$tmp_mini_DEFAULT_ABS_PX_FROM_LEFT = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'MINI_CONFIG', 'DEFAULT_ABS_PX_FROM_LEFT');
$tmp_mini_DEFAULT_MARGIN_RIGHT = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'MINI_CONFIG', 'DEFAULT_MARGIN_RIGHT');
$tmp_mini_DEFAULT_ABS_PX_FROM_RIGHT = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'MINI_CONFIG', 'DEFAULT_ABS_PX_FROM_RIGHT');
$tmp_mini_DEFAULT_WIDTH = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'MINI_CONFIG', 'DEFAULT_WIDTH');
$tmp_mini_DEFAULT_HEIGHT = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'MINI_CONFIG', 'DEFAULT_HEIGHT');
$tmp_mini_DEFAULT_CONTENT_WIDTH = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'MINI_CONFIG', 'DEFAULT_CONTENT_WIDTH');

?>
<!doctype html>
<html lang="en">
<head>
    <?php
    require($oUSER->getEnvParam('DOCUMENT_ROOT').$oUSER->getEnvParam('DOCUMENT_ROOT_DIR').'/social/fellowship/avsvc_overlay/admin/inc/head/head.inc.php');
    ?>
</head>
<body>
    <div class="main_content_wrapper">
        <?php
        require($oUSER->getEnvParam('DOCUMENT_ROOT').$oUSER->getEnvParam('DOCUMENT_ROOT_DIR').'/social/fellowship/avsvc_overlay/admin/inc/nav_global_hdr/nav.inc.php');
        ?>
        <div class="overlay_mgmt_title">OBS :: Dynamic Overlay State Management</div>

        <div class="admin_section_title">New Profile - Mini Overlay</div>

        <form action="#" method="post" name="new_mini_profile" id="new_mini_profile"  enctype="multipart/form-data" >

            <div class="form_input_shell">
                <div>
                    <div id="profilename_form_element_label" class="form_element_label">Profile Name</div>
                    <div class="form_element_input"><input frm_init="crnrstn_frm_handle" crnrstn_frm_valtype="required" name="profilename" type="text" id="profilename" size="30" maxlength="100" value="" placeholder="" onBlur="mycrnrstn_fhandler.leavingListenerAdmin(this);" /></div>
                    <div class="cb"></div>
                    <div class="input_validation_copy_shell"><div id="profilename_input_validation_copy" class="input_validation_copy" style="display:none;">Required</div></div>
                    <div class="cb"></div>
                </div>
            </div>
            <div class="cb_15"></div>

            <div class="form_input_shell">
                <div id="pagehdr_form_element_label" class="form_element_label">Language</div>
                <div class="form_element_input">
                    <select name="lang_code">
                        <?php

                        $tmp_loop_size = $oDB_RESP->return_sizeof($oDB_RESP->return_serial($tmp_serial_handle), 'LANG_IDS');

                        for($i=0; $i<$tmp_loop_size; $i++){

                            $tmp_LANG_ID = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'LANG_IDS', 'LANG_ID', $i);
                            $tmp_NAME = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'LANG_IDS', 'NAME', $i);
                            $tmp_NATIVE_NAME = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'LANG_IDS', 'NATIVE_NAME', $i);

                            ?>
                            <option value="<?php echo $oCRNRSTN_ENV->paramTunnelEncrypt($tmp_LANG_ID); ?>"><?php echo $tmp_NAME.' ('.$tmp_NATIVE_NAME.')'; ?></option>

                            <?php
                        }
                        ?>

                    </select>
                </div>

                <div class="cb"></div>
                <div class="input_validation_copy_shell"><div id="pagehdr_input_validation_copy" class="input_validation_copy" style="display:none;">Required</div></div>
                <div class="cb"></div>
            </div>
            <div class="cb_15"></div>

            <div class="form_input_shell">
                <div>
                    <div id="msgnum_form_element_label" class="form_element_label">Message Number</div>
                    <div class="form_element_input"><input frm_init="crnrstn_frm_handle" crnrstn_frm_valtype="required" name="msgnum" type="text" id="msgnum" size="30" maxlength="100" value="" placeholder="Message 1 - RK" onBlur="mycrnrstn_fhandler.leavingListenerAdmin(this);" /></div>
                    <div class="cb"></div>
                    <div class="input_validation_copy_shell"><div id="msgnum_input_validation_copy" class="input_validation_copy" style="display:none;">Required</div></div>
                    <div class="cb"></div>
                </div>
            </div>
            <div class="cb_15"></div>

            <div class="form_input_shell">
                <div id="msgtitle_form_element_label" class="form_element_label">Message Title</div>
                <div class="form_element_input">
                    <textarea frm_init="crnrstn_frm_handle" crnrstn_frm_valtype="required" name="msgtitle" id="msgtitle" cols="80" rows="8" wrap="hard" style="height:80px; width:400px;"></textarea>
                </div>
                <div class="cb"></div>
                <div class="input_validation_copy_shell"><div id="msgtitle_input_validation_copy" class="input_validation_copy" style="display:none;">Required</div></div>
                <div class="cb"></div>
            </div>
            <div class="cb_15"></div>

            <div class="form_input_shell">
                <div>
                    <div id="msgdate_form_element_label" class="form_element_label">Message Date</div>
                    <div class="form_element_input"><input frm_init="crnrstn_frm_handle" crnrstn_frm_valtype="required" name="msgdate" type="text" id="msgdate" size="30" maxlength="100" value="" placeholder="Friday Evening, September 3, 2019" onBlur="mycrnrstn_fhandler.leavingListenerAdmin(this);" /></div>
                    <div class="cb"></div>
                    <div class="input_validation_copy_shell"><div id="msgdate_input_validation_copy" class="input_validation_copy" style="display:none;">Required</div></div>
                    <div class="cb"></div>
                </div>
            </div>
            <div class="cb_15"></div>

            <div class="form_input_shell">
                <div>
                    <div id="msgconf_form_element_label" class="form_element_label">Conference Title</div>
                    <div class="form_element_input"><input frm_init="crnrstn_frm_handle" crnrstn_frm_valtype="required" name="msgconf" type="text" id="msgconf" size="50" maxlength="255" value="" placeholder="" onBlur="mycrnrstn_fhandler.leavingListenerAdmin(this);" /></div>
                    <div class="cb"></div>
                    <div class="input_validation_copy_shell"><div id="msgconf_input_validation_copy" class="input_validation_copy" style="display:none;">Required</div></div>
                    <div class="cb"></div>
                </div>
            </div>
            <div class="cb_15"></div>

            <div class="form_input_shell">
                <div>
                    <div id="overlayheight_form_element_label" class="form_element_label">Overlay Height (pixels)</div>
                    <div class="form_element_input"><input frm_init="crnrstn_frm_handle" crnrstn_frm_valtype="required" name="overlayheight" type="text" id="overlayheight" size="10" maxlength="100" value="<?php echo $tmp_mini_DEFAULT_HEIGHT; ?>" placeholder="" onBlur="mycrnrstn_fhandler.leavingListenerAdmin(this);" /></div>
                    <div class="cb"></div>
                    <div class="input_validation_copy_shell"><div id="overlayheight_input_validation_copy" class="input_validation_copy" style="display:none;">Required</div></div>
                    <div class="cb"></div>
                </div>
            </div>
            <div class="cb_15"></div>

            <div class="form_input_shell">
                <div>
                    <div id="overlaywidth_form_element_label" class="form_element_label">Overlay Width (pixels)</div>
                    <div class="form_element_input"><input frm_init="crnrstn_frm_handle" crnrstn_frm_valtype="required" name="overlaywidth" type="text" id="overlaywidth" size="10" maxlength="100" value="<?php echo $tmp_mini_DEFAULT_WIDTH; ?>" placeholder="" onBlur="mycrnrstn_fhandler.leavingListenerAdmin(this);" /></div>
                    <div class="cb"></div>
                    <div class="input_validation_copy_shell"><div id="overlaywidth_input_validation_copy" class="input_validation_copy" style="display:none;">Required</div></div>
                    <div class="cb"></div>
                </div>
            </div>
            <div class="cb_15"></div>

            <div class="form_input_shell">
                <div>
                    <div id="innercontentwidth_form_element_label" class="form_element_label">Inner Content Width (pixels)</div>
                    <div class="form_element_input"><input frm_init="crnrstn_frm_handle" crnrstn_frm_valtype="required" name="innercontentwidth" type="text" id="innercontentwidth" size="10" maxlength="100" value="<?php echo $tmp_mini_DEFAULT_CONTENT_WIDTH; ?>" placeholder="" onBlur="mycrnrstn_fhandler.leavingListenerAdmin(this);" /></div>
                    <div class="cb"></div>
                    <div class="input_validation_copy_shell"><div id="innercontentwidth_input_validation_copy" class="input_validation_copy" style="display:none;">Required</div></div>
                    <div class="cb"></div>
                </div>
            </div>
            <div class="cb_15"></div>

            <div class="form_input_shell">
                <div>
                    <div id="marginleft_form_element_label" class="form_element_label">Margin Left (pixels)</div>
                    <div class="form_element_input"><input frm_init="crnrstn_frm_handle" crnrstn_frm_valtype="required" name="marginleft" type="text" id="marginleft" size="10" maxlength="100" value="<?php echo $tmp_mini_DEFAULT_MARGIN_LEFT; ?>" placeholder="" onBlur="mycrnrstn_fhandler.leavingListenerAdmin(this);" /></div>
                    <div class="cb"></div>
                    <div class="input_validation_copy_shell"><div id="marginleft_input_validation_copy" class="input_validation_copy" style="display:none;">Required</div></div>
                    <div class="cb"></div>
                </div>
            </div>
            <div class="cb_15"></div>

            <div class="form_input_shell">
                <div>
                    <div id="marginright_form_element_label" class="form_element_label">Margin Right (pixels)</div>
                    <div class="form_element_input"><input frm_init="crnrstn_frm_handle" crnrstn_frm_valtype="required" name="marginright" type="text" id="marginright" size="10" maxlength="100" value="<?php echo $tmp_mini_DEFAULT_MARGIN_RIGHT; ?>" placeholder="" onBlur="mycrnrstn_fhandler.leavingListenerAdmin(this);" /></div>
                    <div class="cb"></div>
                    <div class="input_validation_copy_shell"><div id="marginright_input_validation_copy" class="input_validation_copy" style="display:none;">Required</div></div>
                    <div class="cb"></div>
                </div>
            </div>
            <div class="cb_15"></div>

            <div class="form_input_shell">
                <div>
                    <div id="absfromtop_form_element_label" class="form_element_label">Absolute Pixels from Top</div>
                    <div class="form_element_input"><input frm_init="crnrstn_frm_handle" crnrstn_frm_valtype="required" name="absfromtop" type="text" id="absfromtop" size="10" maxlength="100" value="<?php echo $tmp_mini_DEFAULT_ABS_PX_FROM_TOP; ?>" placeholder="" onBlur="mycrnrstn_fhandler.leavingListenerAdmin(this);" /></div>
                    <div class="cb"></div>
                    <div class="input_validation_copy_shell"><div id="absfromtop_input_validation_copy" class="input_validation_copy" style="display:none;">Required</div></div>
                    <div class="cb"></div>
                </div>
            </div>
            <div class="cb_15"></div>

            <div class="form_input_shell">
                <div>
                    <div id="absfromleft_form_element_label" class="form_element_label">Absolute Pixels from Left</div>
                    <div class="form_element_input"><input frm_init="crnrstn_frm_handle" crnrstn_frm_valtype="required" name="absfromleft" type="text" id="absfromleft" size="10" maxlength="100" value="<?php echo $tmp_mini_DEFAULT_ABS_PX_FROM_LEFT; ?>" placeholder="" onBlur="mycrnrstn_fhandler.leavingListenerAdmin(this);" /></div>
                    <div class="cb"></div>
                    <div class="input_validation_copy_shell"><div id="absfromleft_input_validation_copy" class="input_validation_copy" style="display:none;">Required</div></div>
                    <div class="cb"></div>
                </div>
            </div>
            <div class="cb_15"></div>

            <div id="submit_shell" class="admin_submit_shell">

                <div class="form_input_shell">

                    <div class="form_submit_btn" style="float:right;" onMouseOver="submitBtnMouseOver(this); return false;" onMouseOut="submitBtnMouseOut(this); return false;" onClick="if(mycrnrstn_fhandler.validateForm('new_mini_profile')){ $('new_mini_profile').submit()}">Save</div>
                    <div class="form_cancel_btn" style="float:right; margin-right:25px;" onclick="loadPageFromIndex('<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>social/fellowship/avsvc_overlay/admin/');" >Cancel</div>
                </div>
            </div>

            <div class="hidden">
                <input name="submitin" type="submit" value="submit">
                <input type="hidden" name="sid" id="sid" value="">
                <div id="create_class_errmsg"></div>
                <div id="create_class_errfields"></div>
            </div>

        </form>
        <div class="cb_30"></div>
    </div>
</body>
</html>