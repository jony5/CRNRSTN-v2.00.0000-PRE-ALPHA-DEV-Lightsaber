<?php

/* 
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
include_once($CRNRSTN_ROOT . '_crnrstn.config.inc.php');
require($oUSER->getEnvParam('DOCUMENT_ROOT').$oUSER->getEnvParam('DOCUMENT_ROOT_DIR').'/social/fellowship/avsvc_overlay/admin/inc/session/session.inc.php');

$tmp_serial_handle = 'OVERLAY_DATUM';
$oDB_RESP = $oUSER->getOverlayStateDatum($tmp_serial_handle);

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

        <div class="admin_section_title">New Profile - Fullscreen Overlay</div>

        <form action="#" method="post" name="new_fullscreen_profile" id="new_fullscreen_profile"  enctype="multipart/form-data" >

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
                    <div id="fontsize_form_element_label" class="form_element_label">Font Size Percentage</div>
                    <div class="form_element_input"><input frm_init="crnrstn_frm_handle" crnrstn_frm_valtype="required" name="fontsize" type="text" id="fontsize" size="10" maxlength="10" value="" placeholder="140" onBlur="mycrnrstn_fhandler.leavingListenerAdmin(this);" /></div>
                    <div class="cb"></div>
                    <div class="input_validation_copy_shell"><div id="fontsize_input_validation_copy" class="input_validation_copy" style="display:none;">Required</div></div>
                    <div class="cb"></div>
                </div>
            </div>
            <div class="cb_15"></div>

            <div class="form_input_shell">
                <div id="pagehdr_form_element_label" class="form_element_label">Page Header</div>
                <div class="form_element_input">
                    <textarea frm_init="crnrstn_frm_handle" crnrstn_frm_valtype="none" name="pagehdr" id="pagehdr" cols="80" rows="8" wrap="hard" style="height:80px; width:400px;"></textarea>
                </div>
                <div class="cb"></div>
                <div class="input_validation_copy_shell"><div id="pagehdr_input_validation_copy" class="input_validation_copy" style="display:none;">Required</div></div>
                <div class="cb"></div>
            </div>
            <div class="cb_15"></div>

            <div class="form_input_shell">
                <div id="pagetitle_form_element_label" class="form_element_label">Page Title</div>
                <div class="form_element_input">
                    <textarea frm_init="crnrstn_frm_handle" crnrstn_frm_valtype="none" name="pagetitle" id="pagetitle" cols="80" rows="8" wrap="hard" style="height:80px; width:400px;"></textarea>
                </div>
                <div class="cb"></div>
                <div class="input_validation_copy_shell"><div id="pagetitle_input_validation_copy" class="input_validation_copy" style="display:none;">Required</div></div>
                <div class="cb"></div>
            </div>
            <div class="cb_15"></div>


            <div class="form_input_shell">
                <div id="pagecode_form_element_label" class="form_element_label">Page Code</div>
                <div class="form_element_input">
                    <textarea frm_init="crnrstn_frm_handle" crnrstn_frm_valtype="none" name="pagecode" id="pagecode" cols="80" rows="8" wrap="hard" style="height:200px; width:400px;"></textarea>
                </div>
                <div class="cb"></div>
                <div class="input_validation_copy_shell"><div id="pagecode_input_validation_copy" class="input_validation_copy" style="display:none;">Required</div></div>
                <div class="cb"></div>
            </div>
            <div class="cb_15"></div>


            <div id="submit_shell" class="admin_submit_shell">

                <div class="form_input_shell">

                    <div class="form_submit_btn" style="float:right;" onMouseOver="submitBtnMouseOver(this); return false;" onMouseOut="submitBtnMouseOut(this); return false;" onClick="if(mycrnrstn_fhandler.validateForm('new_fullscreen_profile')){ $('new_fullscreen_profile').submit()}">Save</div>
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