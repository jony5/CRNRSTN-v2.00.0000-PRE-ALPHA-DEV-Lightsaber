<?php
/*
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
include_once(CRNRSTN_ROOT . '/_crnrstn.config.inc.php');

//
//$tmp_form_serial = $oCRNRSTN->generate_new_key(5);
//$tmp_http_root = $oCRNRSTN->current_location();

$oCRNRSTN->init_form_handling('CRNRSTN:: A DEMO_FORM_EXAMPLE');
$tmp_http_root = $oCRNRSTN->get_resource('ROOT_PATH_CLIENT_HTTP') . $oCRNRSTN->get_resource('ROOT_PATH_CLIENT_HTTP_DIR');

//
// REDIRECTS
$oCRNRSTN->add_form_submit_redirects('CRNRSTN:: A DEMO_FORM_EXAMPLE', 'crnrstn_demo_firstname', $tmp_http_root . '?crnrstn_demo_firstname_success=true', $tmp_http_root . '?crnrstn_demo_firstname_err=true');
$oCRNRSTN->add_form_submit_redirects('CRNRSTN:: A DEMO_FORM_EXAMPLE', NULL, $tmp_http_root . '?success=true', $tmp_http_root . '?err=true');

//
// VALIDATION ERROR MESSAGES
//function add_form_validation_messages($crnrstn_form_handle, $field_input_name, $html_form_input_id = NULL, $message_key = NULL, $err_msg = NULL, $success_msg = NULL, $info_msg = NULL){
$oCRNRSTN->add_form_validation_messages('CRNRSTN:: A DEMO_FORM_EXAMPLE', 'crnrstn_demo_firstname','crnrstn_demo_firstname', '', 'Firstname is required.', 'Firstname approved.', 'Fistname can have numbers.');
$oCRNRSTN->add_form_validation_messages('CRNRSTN:: A DEMO_FORM_EXAMPLE', 'crnrstn_demo_city','crnrstn_demo_city', '', 'City is required.', 'City approved.', 'City can be abbreviated.');
$oCRNRSTN->add_form_validation_messages('CRNRSTN:: A DEMO_FORM_EXAMPLE', 'crnrstn_demo_email', 'crnrstn_demo_email', 'MISSING_DATA-EMAIL');

//
// THESE ARE THE INPUT FIELDS TO WHICH WE WILL LOOK
# THESE FIELDS ARE NOT HIDDEN. THEY WILL NOT/CANNOT BE
# ENCRYPTED INITIALLY.
//    public function init_input_listener($crnrstn_form_handle = NULL, $html_form_input_name = NULL, $html_form_input_id = NULL, $default_value = NULL, $validation_constant_profile = CRNRSTN_INPUT_OPTIONAL, $table_field_name = NULL){
$oCRNRSTN->init_input_listener('CRNRSTN:: A DEMO_FORM_EXAMPLE', 'crnrstn_demo_firstname', 'crnrstn_demo_firstname', 'DEFAULT-FNAME-DATA, HERE', CRNRSTN_INPUT_REQUIRED, 'CUST_TABLE_MEOW_FNAME');
$oCRNRSTN->init_input_listener('CRNRSTN:: A DEMO_FORM_EXAMPLE', 'crnrstn_demo_city', 'crnrstn_demo_city', 'Atlanta', CRNRSTN_INPUT_REQUIRED);
$oCRNRSTN->init_input_listener('CRNRSTN:: A DEMO_FORM_EXAMPLE', 'crnrstn_demo_state', 'crnrstn_demo_state');
$oCRNRSTN->init_input_listener('CRNRSTN:: A DEMO_FORM_EXAMPLE', 'crnrstn_demo_zipcode', 'crnrstn_demo_zipcode');
$oCRNRSTN->init_input_listener('CRNRSTN:: A DEMO_FORM_EXAMPLE', 'crnrstn_demo_email', 'crnrstn_demo_email', NULL, CRNRSTN_INPUT_IS_EMAIL);

//$oCRNRSTN->init_hidden_input_listener($crnrstn_form_handle, $html_form_input_name, $html_form_input_id, $default_value, $validation_constant_profile, $table_field_name);
$oCRNRSTN->init_hidden_input_listener('CRNRSTN:: A DEMO_FORM_EXAMPLE', 'crnrstn_hidden_demo_account_number', 'crnrstn_hidden_demo_account_number', $oCRNRSTN->data_encrypt('1234567890.0987654321'), CRNRSTN_INPUT_REQUIRED);
$oCRNRSTN->init_hidden_input_listener('CRNRSTN:: A DEMO_FORM_EXAMPLE', 'crnrstn_hidden_demo_account_access', 'crnrstn_hidden_demo_account_access', $oCRNRSTN->data_encrypt('ANONYMOUS'), CRNRSTN_INPUT_REQUIRED);

?>
<!DOCTYPE html>
<html lang="<?php echo $oCRNRSTN->country_iso_code(); ?>">
<head>
<title>CRNRSTN :: <?php echo $oCRNRSTN->version_crnrstn(); ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<?php echo $oCRNRSTN->return_creative('CRNRSTN_FAVICON'); ?>
<?php echo $oCRNRSTN->ui_content_module_out(CRNRSTN_UI_JS_JQUERY) .
    $oCRNRSTN->ui_content_module_out(CRNRSTN_UI_JS_JQUERY_UI).
    $oCRNRSTN->ui_content_module_out(CRNRSTN_UI_CSS_MAIN_DESKTOP & CRNRSTN_UI_JS_MAIN_DESKTOP); ?>
<style type="text/css">

    .the_R_in_crnrstn                           { color:#F90000; }
    .crnrstn_activity_log                       { opacity: 0; }
    .crnrstn_log_output_wrapper                 { background-color:#04050A; border:3px solid #9F9393; padding:10px; margin:10px 10px 0 0; width:96%; height:190px; overflow:scroll;}
    .crnrstn_log_output                         { width:2000px; }
    .crnrstn_log_entry                          { display:block; clear:both; text-align: left; color:#7AF94F; font-size:12px; font-family: "Courier New", Courier, monospace; }
    .crnrstn_j5_wolf_pup_outter_wrap            { float:right; padding:420px 0 0 0; margin:0; width:100%;}
    .crnrstn_j5_wolf_pup_inner_wrap             { position: absolute; width:98%; z-index: 2; text-align: right; padding-top: 20px;}
    .crnrstn_signin_copyright_shell             { font-family:Arial, Helvetica, sans-serif; width:578px; text-align: center; margin:0 auto; font-size: 12px; line-height: 18px; color: #666;}
    .crnrstn_signin_copyright_shell a           { text-decoration:none; color: #0066CC; text-decoration:underline;}

    /*PAGE*/
    .crnrstn_page_subtitle                      { font-weight: bold; font-size: 20px; padding: 10px 0 10px 0; }

    /*DGF*/
    .crnrstn_field_input_title                  { font-size:16px; }
    .crnrstn_input_title_lnk_expand_wrapper     { float: right; }
    .crnrstn_input_title_lnk_expand             {color: #0066CC; cursor: pointer; font-weight: bold; font-size: 12px; padding:3px 0 0 20px;}
    .crnrstn_field_input_wrapper input          { font-size:13px; height:25px; /*width:500px;*/ margin: 3px 0 0 0; padding:3px 5px 3px 5px; }
    .crnrstn_field_input_wrapper select         { font-size:13px; height:25px; margin: 3px 0 0 0; }
    .crnrstn_field_input_wrapper textarea       { font-size:13px; height:75px; width:500px; margin: 3px 0 0 0; padding:3px 5px 3px 5px; }

    /*UTILITY*/
    .crnrstn_hidden                             { width:0; height:0; position:absolute; left:-2000px; overflow:hidden;}
    .crnrstn_cb                             { display:block; clear:both; height:0; line-height:0; overflow:hidden; width:100%; font-size:1px;}
    .crnrstn_cb_3                               { display:block; clear:both; height:3px;  line-height:1px; overflow:hidden; border:0; padding:0; margin:0; font-size:1px;}
    .crnrstn_cb_5	                      	{ display:block; clear:both; height:5px;  line-height:1px; overflow:hidden; border:0; padding:0; margin:0; font-size:1px;}
    .crnrstn_cb_10	                      	{ display:block; clear:both; height:10px;  line-height:1px; overflow:hidden; border:0; padding:0; margin:0; font-size:1px;}
    .crnrstn_cb_15	 							{ display:block; clear:both; height:15px;  line-height:1px; overflow:hidden; border:0; padding:0; margin:0; font-size:1px;}
    .crnrstn_cb_20								{ display:block; clear:both; height:20px;  line-height:1px; overflow:hidden; border:0; padding:0; margin:0; font-size:1px;}
    .crnrstn_cb_30								{ display:block; clear:both; height:30px;  line-height:1px; overflow:hidden; border:0; padding:0; margin:0; font-size:1px;}
    .crnrstn_cb_40								{ display:block; clear:both; height:40px;  line-height:1px; overflow:hidden; border:0; padding:0; margin:0; font-size:1px;}
    .crnrstn_cb_50	 							{ display:block; clear:both; height:50px;  line-height:1px; overflow:hidden; border:0; padding:0; margin:0; font-size:1px;}
    .crnrstn_cb_75								{ display:block; clear:both; height:75px;  line-height:1px; overflow:hidden; border:0; padding:0; margin:0; font-size:1px;}
    .crnrstn_cb_100 							{ display:block; clear:both; height:100px; line-height:1px; overflow:hidden; border:0; padding:0; margin:0; font-size:1px;}
    .crnrstn_cb_200				                { display:block; clear:both; height:200px; line-height:1px; overflow:hidden; border:0; padding:0; margin:0; font-size:1px;}

</style>
</head>
<body>

    <div style="padding: 0 0 0 20px;">

        <div style="font-family:Arial, Helvetica, sans-serif; font-weight: bold; font-size: 25px; padding: 10px 0 0 0;">C<span class="the_R_in_crnrstn">R</span>NRSTN :: Form Integrations Testing</div>
        <div class="crnrstn_cb"></div>
        <div style="font-family:Arial, Helvetica, sans-serif; font-size: 11px; font-weight: normal; padding: 5px 0 0 0; color: #9a9292;">
            <?php
            echo $oCRNRSTN->proper_version('LINUX') .
                ', ' . $oCRNRSTN->proper_version('APACHE') .
                ', ' . $oCRNRSTN->proper_version('MYSQLI') .
                ', ' . $oCRNRSTN->proper_version('PHP') .
                ', ' . $oCRNRSTN->proper_version('OPENSSL') .
                ', ' . $oCRNRSTN->proper_version('SOAP') .
                ', C<span class="the_R_in_crnrstn">R</span>NRSTN :: v' . $oCRNRSTN->version_crnrstn(); ?>
        </div>
        <div class="crnrstn_cb_15"></div>

        <form action="<?php echo $oCRNRSTN->return_http_form_action_url('./action/'); ?>" method="post" name="a_demo_form" id="a_demo_form"  enctype="multipart/form-data">

            <div style="width:100%; font-family:Arial, Helvetica, sans-serif; ">
                <div class="crnrstn_field_input_wrapper">
                    <div style="width:100%;">
                        <div class="crnrstn_field_input_title">Firstname:</div>
                        <div class="crnrstn_cb"></div>
                        <div><input type="text" name="crnrstn_demo_firstname" style="width:500px;" value="" placeholder="enter firstname"></div>
                        <div class="crnrstn_cb"></div>
                    </div>
                    <div class="crnrstn_cb_20"></div>
                </div>

                <div class="crnrstn_field_input_wrapper">
                    <div style="width:100%;">
                        <div class="crnrstn_field_input_title">City:</div>
                        <div class="crnrstn_cb"></div>
                        <div><input type="text" name="crnrstn_demo_city" style="width:500px;" value="" placeholder="enter city"></div>
                        <div class="crnrstn_cb"></div>
                    </div>
                    <div class="crnrstn_cb_20"></div>
                </div>

                <div class="crnrstn_field_input_wrapper">
                    <div style="width:100%;">
                        <div class="crnrstn_field_input_title">State:</div>
                        <div class="crnrstn_cb"></div>
                        <div><input type="text" name="crnrstn_demo_state" style="width:500px;" value="" placeholder="enter state"></div>
                        <div class="crnrstn_cb"></div>
                    </div>
                    <div class="crnrstn_cb_20"></div>
                </div>

                <div class="crnrstn_field_input_wrapper">
                    <div style="width:100%;">
                        <div class="crnrstn_field_input_title">Zipcode:</div>
                        <div class="crnrstn_cb"></div>
                        <div><input type="text" name="crnrstn_demo_zipcode" style="width:500px;" value="" placeholder="enter zipcode"></div>
                        <div class="crnrstn_cb"></div>
                    </div>
                    <div class="crnrstn_cb_20"></div>
                </div>

                <div class="crnrstn_field_input_wrapper">
                    <div style="width:100%;">
                        <div class="crnrstn_field_input_title">Email:</div>
                        <div class="crnrstn_cb"></div>
                        <div><input type="text" name="crnrstn_demo_email" style="width:500px;" value="" placeholder="enter email"></div>
                        <div class="crnrstn_cb"></div>
                    </div>
                    <div class="crnrstn_cb_20"></div>
                </div>

                <div class="crnrstn_cb_20"></div>

                <div class="crnrstn_field_input_wrapper">

                    <div style="width:100%;">

                        <div style="float: left; padding-top: 10px;">

                            <input style="width:100px;" type="submit" value="<?php echo $oCRNRSTN->get_lang_copy('BUTTON_TEXT_SUBMIT'); ?>">

                        </div>

                    </div>

                </div>

                <div class="crnrstn_cb_15"></div>

            </div>
            <?php

            echo $oCRNRSTN->ui_content_module_out(CRNRSTN_UI_FORM_INTEGRATION_PACKET, 'CRNRSTN:: A DEMO_FORM_EXAMPLE');

            ?>
        </form>

        <div class="crnrstn_cb_20"></div>

        <div class="crnrstn_signin_copyright_shell">&copy; 2012-<?php echo date('Y'); ?> Jonathan 'J5' Harris :: <?php echo $oCRNRSTN->get_lang_copy('COPY_ALL_RIGHTS_PART1') . '<br>' . $oCRNRSTN->get_lang_copy('COPY_ALL_RIGHTS_PART2'); ?> <a href="./&crnrstn_mit=true" target="_self"><?php echo $oCRNRSTN->get_lang_copy('COPY_ALL_RIGHTS_PART_MIT'); ?></a>.</div>

    </div>

    <div style="width:700px;">

        <div class="crnrstn_j5_wolf_pup_outter_wrap">

            <div class="crnrstn_j5_wolf_pup_inner_wrap">
                <?php
                echo $oCRNRSTN->return_creative('J5_WOLF_PUP_RAND', CRNRSTN_UI_IMG_BASE64_PNG_HTML_WRAPPED);

                ?>
            </div>

        </div>

    </div>

<?php

echo $oCRNRSTN->framework_integrations_client_packet(CRNRSTN_RESOURCE_DOCUMENTATION);

?>
</body>
</html>