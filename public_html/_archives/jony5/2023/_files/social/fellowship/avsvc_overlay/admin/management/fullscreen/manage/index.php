<?php

/* 
// J5
// Code is Poetry */

require('_crnrstn.root.inc.php');
include_once($CRNRSTN_ROOT . '_crnrstn.config.inc.php');
require($oUSER->getEnvParam('DOCUMENT_ROOT').$oUSER->getEnvParam('DOCUMENT_ROOT_DIR').'/social/fellowship/seblend_popup/admin/inc/session/session.inc.php');

$tmp_seblend_overlay_mini_width = 620;
$tmp_seblend_overlay_mini_height = 150;
$tmp_seblend_overlay_mini_content_width = 500;
$tmp_seblend_overlay_mini_margin_left = 90;
$tmp_seblend_overlay_mini_margin_right = 0;
$tmp_mini_overlay_top = 550;
$tmp_mini_overlay_left = '-80';

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
                <div>
                    <div id="msgnum_form_element_label" class="form_element_label">Message Number</div>
                    <div class="form_element_input"><input frm_init="crnrstn_frm_handle" crnrstn_frm_valtype="required" name="msgnum" type="text" id="msgnum" size="10" maxlength="100" value="" placeholder="01" onBlur="mycrnrstn_fhandler.leavingListenerAdmin(this);" /></div>
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
                    <div id="msgspkr_form_element_label" class="form_element_label">Message Speaker (initials)</div>
                    <div class="form_element_input"><input frm_init="crnrstn_frm_handle" crnrstn_frm_valtype="required" name="msgspkr" type="text" id="msgspkr" size="10" maxlength="100" value="" placeholder="" onBlur="mycrnrstn_fhandler.leavingListenerAdmin(this);" /></div>
                    <div class="cb"></div>
                    <div class="input_validation_copy_shell"><div id="msgspkr_input_validation_copy" class="input_validation_copy" style="display:none;">Required</div></div>
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
                    <div class="form_element_input"><input frm_init="crnrstn_frm_handle" crnrstn_frm_valtype="required" name="overlayheight" type="text" id="overlayheight" size="10" maxlength="100" value="<?php echo $tmp_seblend_overlay_mini_height; ?>" placeholder="" onBlur="mycrnrstn_fhandler.leavingListenerAdmin(this);" /></div>
                    <div class="cb"></div>
                    <div class="input_validation_copy_shell"><div id="overlayheight_input_validation_copy" class="input_validation_copy" style="display:none;">Required</div></div>
                    <div class="cb"></div>
                </div>
            </div>
            <div class="cb_15"></div>

            <div class="form_input_shell">
                <div>
                    <div id="overlaywidth_form_element_label" class="form_element_label">Overlay Width (pixels)</div>
                    <div class="form_element_input"><input frm_init="crnrstn_frm_handle" crnrstn_frm_valtype="required" name="overlaywidth" type="text" id="overlaywidth" size="10" maxlength="100" value="<?php echo $tmp_seblend_overlay_mini_width; ?>" placeholder="" onBlur="mycrnrstn_fhandler.leavingListenerAdmin(this);" /></div>
                    <div class="cb"></div>
                    <div class="input_validation_copy_shell"><div id="overlaywidth_input_validation_copy" class="input_validation_copy" style="display:none;">Required</div></div>
                    <div class="cb"></div>
                </div>
            </div>
            <div class="cb_15"></div>

            <div class="form_input_shell">
                <div>
                    <div id="innercontentwidth_form_element_label" class="form_element_label">Inner Content Width (pixels)</div>
                    <div class="form_element_input"><input frm_init="crnrstn_frm_handle" crnrstn_frm_valtype="required" name="innercontentwidth" type="text" id="innercontentwidth" size="10" maxlength="100" value="<?php echo $tmp_seblend_overlay_mini_content_width; ?>" placeholder="" onBlur="mycrnrstn_fhandler.leavingListenerAdmin(this);" /></div>
                    <div class="cb"></div>
                    <div class="input_validation_copy_shell"><div id="innercontentwidth_input_validation_copy" class="input_validation_copy" style="display:none;">Required</div></div>
                    <div class="cb"></div>
                </div>
            </div>
            <div class="cb_15"></div>

            <div class="form_input_shell">
                <div>
                    <div id="marginleft_form_element_label" class="form_element_label">Margin Left (pixels)</div>
                    <div class="form_element_input"><input frm_init="crnrstn_frm_handle" crnrstn_frm_valtype="required" name="marginleft" type="text" id="marginleft" size="10" maxlength="100" value="<?php echo $tmp_seblend_overlay_mini_margin_left; ?>" placeholder="" onBlur="mycrnrstn_fhandler.leavingListenerAdmin(this);" /></div>
                    <div class="cb"></div>
                    <div class="input_validation_copy_shell"><div id="marginleft_input_validation_copy" class="input_validation_copy" style="display:none;">Required</div></div>
                    <div class="cb"></div>
                </div>
            </div>
            <div class="cb_15"></div>

            <div class="form_input_shell">
                <div>
                    <div id="marginright_form_element_label" class="form_element_label">Margin Right (pixels)</div>
                    <div class="form_element_input"><input frm_init="crnrstn_frm_handle" crnrstn_frm_valtype="required" name="marginright" type="text" id="marginright" size="10" maxlength="100" value="<?php echo $tmp_seblend_overlay_mini_margin_right; ?>" placeholder="" onBlur="mycrnrstn_fhandler.leavingListenerAdmin(this);" /></div>
                    <div class="cb"></div>
                    <div class="input_validation_copy_shell"><div id="marginright_input_validation_copy" class="input_validation_copy" style="display:none;">Required</div></div>
                    <div class="cb"></div>
                </div>
            </div>
            <div class="cb_15"></div>

            <div class="form_input_shell">
                <div>
                    <div id="absfromtop_form_element_label" class="form_element_label">Absolute Pixels from Top</div>
                    <div class="form_element_input"><input frm_init="crnrstn_frm_handle" crnrstn_frm_valtype="required" name="absfromtop" type="text" id="absfromtop" size="10" maxlength="100" value="<?php echo $tmp_mini_overlay_top; ?>" placeholder="" onBlur="mycrnrstn_fhandler.leavingListenerAdmin(this);" /></div>
                    <div class="cb"></div>
                    <div class="input_validation_copy_shell"><div id="absfromtop_input_validation_copy" class="input_validation_copy" style="display:none;">Required</div></div>
                    <div class="cb"></div>
                </div>
            </div>
            <div class="cb_15"></div>

            <div class="form_input_shell">
                <div>
                    <div id="absfromleft_form_element_label" class="form_element_label">Absolute Pixels from Left</div>
                    <div class="form_element_input"><input frm_init="crnrstn_frm_handle" crnrstn_frm_valtype="required" name="absfromleft" type="text" id="absfromleft" size="10" maxlength="100" value="<?php echo $tmp_mini_overlay_left; ?>" placeholder="" onBlur="mycrnrstn_fhandler.leavingListenerAdmin(this);" /></div>
                    <div class="cb"></div>
                    <div class="input_validation_copy_shell"><div id="absfromleft_input_validation_copy" class="input_validation_copy" style="display:none;">Required</div></div>
                    <div class="cb"></div>
                </div>
            </div>
            <div class="cb_15"></div>

            <div id="submit_shell" class="admin_submit_shell">

                <div class="form_input_shell">

                    <div class="form_submit_btn" style="float:right;" onMouseOver="submitBtnMouseOver(this); return false;" onMouseOut="submitBtnMouseOut(this); return false;" onClick="if(mycrnrstn_fhandler.validateForm('new_mini_profile')){ $('new_mini_profile').submit()}">Save</div>
                    <div class="form_cancel_btn" style="float:right; margin-right:25px;" onclick="loadPageFromIndex('<?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>social/fellowship/seblend_popup/admin/overlay_mgmt.php');" >Cancel</div>
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