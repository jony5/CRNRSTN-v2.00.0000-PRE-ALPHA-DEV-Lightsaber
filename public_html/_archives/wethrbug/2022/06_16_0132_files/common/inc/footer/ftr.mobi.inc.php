	<div data-role="footer" data-theme="a" data-content-theme="a">
		<h4>&copy; <?php  echo date("Y"); ?> All Rights Reserved.</h4>

	</div><!-- /footer -->
    <div class="cb_20"></div>
    <div class="hidden">
        <!-- GLOBAL XHR SUPPORT CONTAINERS -->
        <div id="timer_copy_persist">0:00:00</div>
        <div id="timer_lck">OFF</div>

        <div id="date_generated"><?php

            date_default_timezone_set('America/New_York');
            $date_m = date('M');

            if($date_m != 'May' && $date_m != 'June' && $date_m != 'July'){

                $date_m .= '.';

            }

            echo date('l,') . ' ' . $date_m . ' ' . date('j \a\t Hi \h\r\s s \s\e\c\s  T');

            ?></div>
        <?php
        //if($xcp==true){
            ?>

        <form action="#" method="post" name="xhr_sync_proxy" id="xhr_sync_proxy"  enctype="multipart/form-data"">
            <input type="hidden" name="postid" value="xhr_sync_proxy">
            <input type="hidden" id="xcp_json_serial_js_handle" name="xcp_json_serial_js_handle" value="">
            <input type="hidden" id="xcp_json_object_type" name="xcp_json_object_type" value="">
            <input type="hidden" id="xcp_input_dom_element_type" name="xcp_input_dom_element_type" value="">
            <input type="hidden" id="xcp_input_dom_element_id" name="xcp_input_dom_element_id" value="">
            <input type="hidden" id="xcp_element_id" name="xcp_element_id" value="">
            <input type="hidden" id="xcp_element_id_translation" name="xcp_element_id_translation" value="">
            <input type="hidden" id="xcp_copy_id" name="xcp_copy_id" value="">
            <input type="hidden" id="xcp_component_id" name="xcp_component_id" value="">
            <input type="hidden" id="xcp_page_id" name="xcp_page_id" value="">
            <input type="hidden" id="xcp_profile_id" name="xcp_profile_id" value="">
            <input type="hidden" id="xcp_copy_hash" name="xcp_copy_hash" value="">
            <input type="hidden" id="xcp_lang_id" name="xcp_lang_id" value="">
            <input type="hidden" id="xcp_lang_id_translator" name="xcp_lang_id_translator" value="">
            <input type="hidden" id="xcp_profile_type" name="xcp_profile_type" value="">
            <input type="hidden" id="xcp_component_type" name="xcp_component_type" value="">
            <input type="hidden" id="xcp_element_copy" name="xcp_element_copy" value="">
            <input type="hidden" id="xcp_completion_state" name="xcp_completion_state" value="">
            <input type="hidden" id="xcp_draft_owner" name="xcp_draft_owner" value="">
            <input type="hidden" id="xcp_date_translation_drafted" name="xcp_date_translation_drafted" value="">
            <input type="hidden" id="xcp_lock" name="xcp_lock" value="">
            <input type="hidden" id="xcp_isactive" name="xcp_isactive" value="">
            <input type="hidden" id="xcp_date_translation_published" name="xcp_date_translation_published" value="">
        </form>
            <?php
        //}
        ?>

        <div id="ajax_root" class="hidden"><?php echo $oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oUSER->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?></div>

        <!--
        langname_proper = $('#langname_proper_static_'+val+'').html();
        langname_en = $('#langname_en_static_'+val+'').html();
        -->

        <?php

        if(isset($oDB_RESP)){

            if($oDB_RESP->ping_profile_existence($tmp_serial_handle, 'LANG_PACKS')){

                $tmp_lang_data_exists = $oDB_RESP->return_sizeof($oDB_RESP->return_serial($tmp_serial_handle), 'LANG_PACKS');

                if($tmp_lang_data_exists>0){

                    for($iii=0; $iii<$tmp_lang_data_exists; $iii++){
                        $tmp_langid = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'LANG_PACKS', 'LANG_ID', $iii);
                        $tmp_langname = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'LANG_PACKS', 'NATIVE_NAME_BLOB', $iii);
                        $tmp_langname_en = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'LANG_PACKS', 'NAME', $iii);

                        echo '<div id="langname_proper_static_'.$tmp_langid.'">'.$tmp_langname.'</div>';
                        echo '<div id="langname_en_static_'.$tmp_langid.'">'.$tmp_langname_en.'</div>';

                    }

                }

            }

        }

        ?>

    </div>


    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-NLFBZV0MEV"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'G-NLFBZV0MEV');
    </script>
