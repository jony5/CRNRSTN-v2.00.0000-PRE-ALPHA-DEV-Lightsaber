<?php
/*
// J5
// Code is Poetry */

class html_generator {

    private static $oLogger;
    private static $oEnv;
    private static $oUser;

    private static $element_array;

    public function __construct($oENV, $oUser)
    {
            //
            // INSTANTIATE LOGGER
            self::$oLogger = new crnrstn_logging();
            self::$oEnv = $oENV;
            self::$oUser = $oUser;

    }

    public function returnAdminHTML($oDB_RESP, $serial_handle, $display_location, $lang_id){

        $tmp_output_HTML = '';

        switch($display_location){
            case 'PAGE_HEADER':

                /*
                tmp_innerHTML = '<div class="cb_20"></div><div class="main_copy_header"><h3>' + tmp_copy_fullscrn_header + '</h3></div>' +
                '<div class="cb_30"></div>' +
                '<div class="main_document_title"><h1>' + tmp_copy_fullscrn_title + '</h1></div>' +
                '<div class="cb_15"></div>' +
                '<div class="main_document_body">' + tmp_copy00_fullscrn_body + '</div>';
                 * */

                //
                // RETRIEVE CONTENT
                $tmp_loop_size = $oDB_RESP->return_sizeof($oDB_RESP->return_serial($serial_handle), 'LANG_ELEM');

                for ($iii = 0; $iii < $tmp_loop_size; $iii++) {
                    $tmp_elem_component_type = $oDB_RESP->return_data_element($oDB_RESP->return_serial($serial_handle), 'LANG_ELEM', 'COMPONENT_TYPE', $iii);
                    $tmp_elem_content = $oDB_RESP->return_data_element($oDB_RESP->return_serial($serial_handle), 'LANG_ELEM', 'ELEMENT_CONTENT', $iii);
                    $tmp_elem_lang_id = $oDB_RESP->return_data_element($oDB_RESP->return_serial($serial_handle), 'LANG_ELEM', 'LANG_ID', $iii);

                    if (($tmp_elem_lang_id == $lang_id) && ($tmp_elem_component_type==$display_location)) {
                        $tmp_output_HTML = '<div class="main_copy_header"><h3>'.$tmp_elem_content.'</h3></div>';
                    }

                }

            break;
            case 'PAGE_TITLE':

                //
                // RETRIEVE CONTENT
                $tmp_loop_size = $oDB_RESP->return_sizeof($oDB_RESP->return_serial($serial_handle), 'LANG_ELEM');

                for ($iii = 0; $iii < $tmp_loop_size; $iii++) {
                    $tmp_elem_component_type = $oDB_RESP->return_data_element($oDB_RESP->return_serial($serial_handle), 'LANG_ELEM', 'COMPONENT_TYPE', $iii);
                    $tmp_elem_content = $oDB_RESP->return_data_element($oDB_RESP->return_serial($serial_handle), 'LANG_ELEM', 'ELEMENT_CONTENT', $iii);
                    $tmp_elem_lang_id = $oDB_RESP->return_data_element($oDB_RESP->return_serial($serial_handle), 'LANG_ELEM', 'LANG_ID', $iii);

                    if (($tmp_elem_lang_id == $lang_id) && ($tmp_elem_component_type==$display_location)) {
                        $tmp_output_HTML = '<div class="main_document_title"><h1>'.$tmp_elem_content.'</h1></div>';
                    }

                }


            break;
            case 'DYNAMIC_CONTENT':
                # $db_resp_target_profiles = 'COMPONENT_TYPES|LANG_PACKS|DE_COLORES
                #                           |FULLSCRN_PAGE|LANG_ELEM|PAGE_COMPONENTS
                #                           |PAGE_SCHEDULES|PAGE_DAYS|PAGE_EVENTS
                #                           |BULLET_LIST|BULLET_BULLETS';

                $tmp_loop_size_PAGE_COMPONENTS = $oDB_RESP->return_sizeof($oDB_RESP->return_serial($serial_handle), 'PAGE_COMPONENTS');

                //error_log('html cnt->'.$tmp_loop_size_PAGE_COMPONENTS);

                for($i=0; $i<$tmp_loop_size_PAGE_COMPONENTS; $i++){
                    $tmp_componentid = $oDB_RESP->return_data_element($oDB_RESP->return_serial($serial_handle), 'PAGE_COMPONENTS', 'COMPONENT_ID', $i);
                    $tmp_pageid = $oDB_RESP->return_data_element($oDB_RESP->return_serial($serial_handle), 'PAGE_COMPONENTS', 'PAGE_ID', $i);
                    $tmp_profileid = $oDB_RESP->return_data_element($oDB_RESP->return_serial($serial_handle), 'PAGE_COMPONENTS', 'PROFILE_ID', $i);
                    $tmp_key = $oDB_RESP->return_data_element($oDB_RESP->return_serial($serial_handle), 'PAGE_COMPONENTS', 'COMPONENT_TYPE_KEY', $i);
                    $tmp_name = $oDB_RESP->retrieveDataByID($oDB_RESP->return_serial($serial_handle), 'COMPONENT_TYPES', $tmp_key, 'NAME');

                    //
                    // COMPONENTS SHOULD BE ORDERED ACCORDING TO PAGE SEQUENCE FROM THE DB. DITTO FOR XML GENERATION.
                    // ALLOW PAGE_COMPONENTS.PAGE_SEQUENCE TO DRIVE...PERHAPS?
                    //error_log('html key->'.$tmp_key);
                    switch($tmp_key){
                        case 'SUB_TITLE':
                            $tmp_loop_size_SUBTITLE = $oDB_RESP->return_sizeof($oDB_RESP->return_serial($serial_handle), 'SUB_TITLE');
                            $tmp_output_HTML .= '<div style="height:20px; overflow:hidden;"><a href="'.self::$oEnv->getEnvParam('ROOT_PATH_CLIENT_HTTP').self::$oEnv->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'dashboard/obs/edit/page/subtitle/?pid='.$tmp_pageid.'&oid='.$tmp_profileid.'&cid='.$tmp_componentid.'" data-ajax="false">edit '.strtolower($tmp_name).'</a></div>';

                            for($iii=0; $iii<$tmp_loop_size_SUBTITLE; $iii++){
                                //$tmp_subtitle_component_id = $oDB_RESP->return_data_element($oDB_RESP->return_serial($serial_handle), 'SUB_TITLE', 'COMPONENT_ID', $iii);
                                $tmp_subtitle_element_id = $oDB_RESP->return_data_element($oDB_RESP->return_serial($serial_handle), 'SUB_TITLE', 'ELEMENT_ID', $iii);
                                $tmp_subtitle_alignment = $oDB_RESP->return_data_element($oDB_RESP->return_serial($serial_handle), 'SUB_TITLE', 'COPY_ALIGNMENT', $iii);

                                $tmp_subtitle_copy = html_entity_decode($oDB_RESP->retrieveDataByID($oDB_RESP->return_serial($serial_handle), 'LANG_ELEM', $tmp_subtitle_element_id, 'ELEMENT_CONTENT_BLOB'));


                                $tmp_output_HTML .= '<h3 style="padding-top:0; margin-top:0; align:'.$tmp_subtitle_alignment.';">';
                                $tmp_output_HTML_ELEM_CLOSE = '</h3>';

                                $tmp_output_HTML .= $tmp_subtitle_copy;

                                $tmp_output_HTML .= $tmp_output_HTML_ELEM_CLOSE;

                            }

                        break;
                        case 'PARAGRAPH':
                            $tmp_loop_size_PARAGRAPH = $oDB_RESP->return_sizeof($oDB_RESP->return_serial($serial_handle), 'PARAGRAPH');
                            $tmp_output_HTML .= '<div style="height:20px; overflow:hidden;"><a href="'.self::$oEnv->getEnvParam('ROOT_PATH_CLIENT_HTTP').self::$oEnv->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'dashboard/obs/edit/page/paragraph/?pid='.$tmp_pageid.'&oid='.$tmp_profileid.'&cid='.$tmp_componentid.'" data-ajax="false">edit '.strtolower($tmp_name).'</a></div>';

                            for($iii=0; $iii<$tmp_loop_size_PARAGRAPH; $iii++){
                                //$tmp_paragraph_component_id = $oDB_RESP->return_data_element($oDB_RESP->return_serial($serial_handle), 'PARAGRAPH', 'COMPONENT_ID', $iii);
                                $tmp_paragraph_element_id = $oDB_RESP->return_data_element($oDB_RESP->return_serial($serial_handle), 'PARAGRAPH', 'ELEMENT_ID', $iii);
                                $tmp_paragraph_is_bold = $oDB_RESP->return_data_element($oDB_RESP->return_serial($serial_handle), 'PARAGRAPH', 'IS_BOLD', $iii);
                                $tmp_paragraph_is_blockquote = $oDB_RESP->return_data_element($oDB_RESP->return_serial($serial_handle), 'PARAGRAPH', 'IS_BLOCKQUOTE', $iii);
                                $tmp_paragraph_alignment = $oDB_RESP->return_data_element($oDB_RESP->return_serial($serial_handle), 'PARAGRAPH', 'COPY_ALIGNMENT', $iii);

                                $tmp_paragraph_copy = html_entity_decode($oDB_RESP->retrieveDataByID($oDB_RESP->return_serial($serial_handle), 'LANG_ELEM', $tmp_paragraph_element_id, 'ELEMENT_CONTENT_BLOB'));

                                if($tmp_paragraph_is_blockquote == 1 || $tmp_paragraph_is_blockquote == '1'){
                                    $tmp_output_HTML .= '<blockquote>';
                                    $tmp_output_HTML_ELEM_CLOSE = '</blockquote>';

                                }else{
                                    $tmp_output_HTML .= '<p style="padding-top:0; margin-top:0; align:'.$tmp_paragraph_alignment.';">';
                                    $tmp_output_HTML_ELEM_CLOSE = '</p>';

                                }

                                if($tmp_paragraph_is_bold=='1'){
                                    $tmp_output_HTML .= '<strong>'.$tmp_paragraph_copy.'</strong>';
                                    //echo '<li><div style="float:right; height:20px;"><a href="#" onclick="editBulletPoint(\''.$tmp_bullet_component_id.'\',\''.$tmp_bullet_bullet_id.'\', \''.$oCRNRSTN_ENV->paramTunnelEncrypt($tmp_bullet_bullet_id).'\');">edit</a></div><div style="width:220px;"><strong>'.$tmp_bullet_description.'</strong></div><div class="hidden"><input type="hidden" name="silent_bullet_bullet_id_'.$tmp_bullet_bullet_id.'" id="silent_bullet_bullet_id_'.$tmp_bullet_bullet_id.'" value="'.$oCRNRSTN_ENV->paramTunnelEncrypt($tmp_bullet_bullet_id).'"><input type="hidden" name="silent_bullet_bold_'.$tmp_bullet_bullet_id.'" id="silent_bullet_bold_'.$tmp_bullet_bullet_id.'" value="'.$tmp_bullet_desc_is_bold.'"><input type="hidden" name="silent_bullet_copy_'.$tmp_bullet_bullet_id.'" id="silent_bullet_copy_'.$tmp_bullet_bullet_id.'" value="'.$tmp_bullet_description.'"><input type="hidden" name="silent_bullet_element_id_'.$tmp_bullet_bullet_id.'" id="silent_bullet_element_id_'.$tmp_bullet_bullet_id.'" value="'.$oCRNRSTN_ENV->paramTunnelEncrypt($tmp_bullet_element_id).'"></div></li>';
                                }else{
                                    $tmp_output_HTML .= $tmp_paragraph_copy;
                                    //echo '<li><div style="float:right; height:20px;"><a href="#" onclick="editBulletPoint(\''.$tmp_bullet_component_id.'\',\''.$tmp_bullet_bullet_id.'\', \''.$oCRNRSTN_ENV->paramTunnelEncrypt($tmp_bullet_bullet_id).'\');">edit</a></div><div style="width:220px;">'.$tmp_bullet_description.'</div><div class="hidden"><input type="hidden" name="silent_bullet_bullet_id_'.$tmp_bullet_bullet_id.'" id="silent_bullet_bullet_id_'.$tmp_bullet_bullet_id.'" value="'.$oCRNRSTN_ENV->paramTunnelEncrypt($tmp_bullet_bullet_id).'"><input type="hidden" name="silent_bullet_bold_'.$tmp_bullet_bullet_id.'" id="silent_bullet_bold_'.$tmp_bullet_bullet_id.'" value="'.$tmp_bullet_desc_is_bold.'"><input type="hidden" name="silent_bullet_copy_'.$tmp_bullet_bullet_id.'" id="silent_bullet_copy_'.$tmp_bullet_bullet_id.'" value="'.$tmp_bullet_description.'"><input type="hidden" name="silent_bullet_element_id_'.$tmp_bullet_bullet_id.'" id="silent_bullet_element_id_'.$tmp_bullet_bullet_id.'" value="'.$oCRNRSTN_ENV->paramTunnelEncrypt($tmp_bullet_element_id).'"></div></li>';
                                }

                                $tmp_output_HTML .= $tmp_output_HTML_ELEM_CLOSE;

                            }

                        break;
                        case 'BULLET_LIST':
                            $tmp_loop_size_BULLET_LIST = $oDB_RESP->return_sizeof($oDB_RESP->return_serial($serial_handle), 'BULLET_LIST');
                            $tmp_loop_size_BULLET_BULLETS = $oDB_RESP->return_sizeof($oDB_RESP->return_serial($serial_handle), 'BULLET_BULLETS');
                            $tmp_output_HTML .= '<div style="height:20px; overflow:hidden;"><a href="'.self::$oEnv->getEnvParam('ROOT_PATH_CLIENT_HTTP').self::$oEnv->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'dashboard/obs/edit/page/bulletlist/?pid='.$tmp_pageid.'&oid='.$tmp_profileid.'&cid='.$tmp_componentid.'" data-ajax="false">edit '.strtolower($tmp_name).'</a></div>';

                            for($iii=0; $iii<$tmp_loop_size_BULLET_LIST; $iii++){
                                $tmp_bulletlist_component_id = $oDB_RESP->return_data_element($oDB_RESP->return_serial($serial_handle), 'BULLET_LIST', 'COMPONENT_ID', $iii);
                                $tmp_bulletlist_bullet_style_ordered = $oDB_RESP->return_data_element($oDB_RESP->return_serial($serial_handle), 'BULLET_LIST', 'BULLET_STYLE_ORDERED', $iii);
                                $tmp_bulletlist_bullet_style_unordered = $oDB_RESP->return_data_element($oDB_RESP->return_serial($serial_handle), 'BULLET_LIST', 'BULLET_STYLE_NOT_ORDERED', $iii);
                                $tmp_bulletlist_is_ordered = $oDB_RESP->return_data_element($oDB_RESP->return_serial($serial_handle), 'BULLET_LIST', 'ISORDERED', $iii);

                                if($tmp_bulletlist_is_ordered == 1 || $tmp_bulletlist_is_ordered == '1'){
                                    $tmp_output_HTML .= '<ol type="'.$tmp_bulletlist_bullet_style_ordered.'" style="padding-top:0;margin-top:0;">';
                                    $tmp_output_HTML_ELEM_CLOSE = '</ol>';

                                }else{
                                    $tmp_output_HTML .= '<ul  style="list-style-type:'.$tmp_bulletlist_bullet_style_unordered.'; padding-top:0;margin-top:0;">';
                                    $tmp_output_HTML_ELEM_CLOSE = '</ul>';

                                }

                                //
                                // OUTPUT ALL BULLETS FOR THIS LIST
                                for($ii=0;$ii<$tmp_loop_size_BULLET_BULLETS;$ii++){
                                    $tmp_bullet_component_id = $oDB_RESP->return_data_element($oDB_RESP->return_serial($serial_handle), 'BULLET_BULLETS', 'COMPONENT_ID', $ii);
                                    $tmp_bullet_element_id = $oDB_RESP->return_data_element($oDB_RESP->return_serial($serial_handle), 'BULLET_BULLETS', 'ELEMENT_ID', $ii);
                                    $tmp_bullet_desc_is_bold = $oDB_RESP->return_data_element($oDB_RESP->return_serial($serial_handle), 'BULLET_BULLETS', 'DESCRIPTION_IS_BOLD', $ii);

                                    $tmp_bullet_description = $oDB_RESP->retrieveDataByID($oDB_RESP->return_serial($serial_handle), 'LANG_ELEM', $tmp_bullet_element_id, 'ELEMENT_CONTENT_BLOB');

                                    if($tmp_bullet_component_id == $tmp_bulletlist_component_id){
                                        if($tmp_bullet_desc_is_bold=='1'){

                                            $tmp_output_HTML .= '<li><div style="width:220px;"><strong>'.$tmp_bullet_description.'</strong></div></li>';
                                        }else{

                                            $tmp_output_HTML .= '<li><div style="width:220px;">'.$tmp_bullet_description.'</div></li>';
                                        }
                                    }

                                }
                                $tmp_output_HTML .= $tmp_output_HTML_ELEM_CLOSE;

                            }

                        break;
                        case 'SCHEDULE':
                            $tmp_loop_size_PAGE_DAYS = $oDB_RESP->return_sizeof($oDB_RESP->return_serial($serial_handle), 'PAGE_DAYS');
                            $tmp_loop_size_PAGE_EVENTS = $oDB_RESP->return_sizeof($oDB_RESP->return_serial($serial_handle), 'PAGE_EVENTS');

                            $tmp_schedule_day_pos = 0;
                            $event_date_format = $oDB_RESP->retrieveDataByID($oDB_RESP->return_serial($serial_handle), 'PAGE_SCHEDULES', $tmp_componentid, 'DATE_FORMAT');
                            $event_time_format = $oDB_RESP->retrieveDataByID($oDB_RESP->return_serial($serial_handle), 'PAGE_SCHEDULES', $tmp_componentid, 'TIME_FORMAT');

                            $tmp_output_HTML .= '<div style="height:20px; overflow:hidden;"><a href="'.self::$oEnv->getEnvParam('ROOT_PATH_CLIENT_HTTP').self::$oEnv->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'dashboard/obs/edit/page/schedule/?pid='.$tmp_pageid.'&oid='.$tmp_profileid.'&cid='.$tmp_componentid.'" data-ajax="false">edit '.strtolower($tmp_name).'</a></div>';

                            //
                            // FROM COMPONENT_ID...BUILD SCHEDULE OUTPUT
                            # GET DAYS...
                                # FOR EACH DAY...

                            //
                            // FOR EACH DAY
                            for($ii=0;$ii<$tmp_loop_size_PAGE_DAYS;$ii++){

                                $tmp_schedule_day_pos++;

                                $tmp_day_id = $oDB_RESP->return_data_element($oDB_RESP->return_serial($serial_handle), 'PAGE_DAYS', 'DAY_ID', $ii);
                                $tmp_day_component_id = $oDB_RESP->return_data_element($oDB_RESP->return_serial($serial_handle), 'PAGE_DAYS', 'COMPONENT_ID', $ii);

                                if($tmp_day_component_id==$tmp_componentid){

                                    $tmp_date = $oDB_RESP->return_data_element($oDB_RESP->return_serial($serial_handle), 'PAGE_DAYS', 'DATE', $ii);

                                    $tmp_output_HTML .= '<h4 style="padding-top:0;margin-top:0;padding-bottom:0;margin-bottom:0;">'.date($event_date_format, strtotime($tmp_date)).'</h4>';

                                    //
                                    // EVENTS OF DAY [HAS ALL EVENTS FOR ALL DAYS ON PAGE]
                                    for($iii=0;$iii<$tmp_loop_size_PAGE_EVENTS;$iii++){

                                        $tmp_event_component_id = $oDB_RESP->return_data_element($oDB_RESP->return_serial($serial_handle), 'PAGE_EVENTS', 'COMPONENT_ID', $iii);
                                        $tmp_event_day_id = $oDB_RESP->return_data_element($oDB_RESP->return_serial($serial_handle), 'PAGE_EVENTS', 'DAY_ID', $iii);

                                        if($tmp_event_component_id==$tmp_componentid && $tmp_event_day_id==$tmp_day_id){
                                            //$tmp_event_event_id = $oDB_RESP->return_data_element($oDB_RESP->return_serial($serial_handle), 'PAGE_EVENTS', 'EVENT_ID', $iii);

                                            $tmp_event_element_id = $oDB_RESP->return_data_element($oDB_RESP->return_serial($serial_handle), 'PAGE_EVENTS', 'ELEMENT_ID', $iii);
                                            $tmp_event_desc_is_bold = $oDB_RESP->return_data_element($oDB_RESP->return_serial($serial_handle), 'PAGE_EVENTS', 'DESCRIPTION_IS_BOLD', $iii);
                                            $tmp_event_date = $oDB_RESP->return_data_element($oDB_RESP->return_serial($serial_handle), 'PAGE_EVENTS', 'DATE', $iii);
                                            $tmp_event_description = $oDB_RESP->retrieveDataByID($oDB_RESP->return_serial($serial_handle), 'LANG_ELEM', $tmp_event_element_id, 'ELEMENT_CONTENT_BLOB');

                                            /*
                                            $tmp_ampm = date('A', strtotime($tmp_event_date));

                                            if($tmp_time_format=='12'){
                                                $tmp_hour = date('g', strtotime($tmp_event_date));

                                            }else{
                                                $tmp_hour = date('G', strtotime($tmp_event_date));

                                            }

                                            $tmp_minute = date('i', strtotime($tmp_event_date));
                                            */

                                            if($tmp_event_desc_is_bold=='1'){

                                                $tmp_output_HTML .= '<div style="float:left; padding-left: 5px; padding-right: 10px; min-width:70px;"><strong>'.self::$oUser->returnFormattedTimeCopy($event_time_format, $tmp_event_date).'</strong></div><div style="float:left; padding-right:10px; width:200px;"><strong>'.$tmp_event_description.'</strong></div><div class="cb"></div>';
                                            }else{

                                                $tmp_output_HTML .= '<div style="float:left; padding-left: 5px; padding-right: 10px; min-width:70px;"><strong>'.self::$oUser->returnFormattedTimeCopy($event_time_format, $tmp_event_date).'</strong></div><div style="float:left; padding-right:10px; width:200px;">'.$tmp_event_description.'</div><div class="cb"></div>';
                                            }


                                        }

                                    }

                                }


                            }

                            
                        break;
                        default:
                            $tmp_output_HTML = '<h3>Unrecognized key ['.$tmp_key.'] for html_generator -> returnAdminHTML() method, my bro.</h3>';

                        break;


                    }

                    $tmp_output_HTML .= '<div class="cb_10"></div>';


                }

                //$tmp_elem_content = '';
                //$tmp_output_HTML = '';

                //$tmp_output_HTML = 'DYNAMIC_CONTENT';

            break;
        }

        return $tmp_output_HTML;
    }

    public function returnMiniXML($oDB_RESP, $serial_handle){


        return 'hello';
    }

    public function returnFullScrnXML($oDB_RESP, $serial_handle, $xml_output_ARRAY){

        //
        // TARGET OUTPUT ::
        // ARRAY['INDEX']['DIR_FILE'] = INDEX FILE DIR PATH; ARRAY['PROFILE']['DIR_FILE'] = PROFILE FILE DIR PATH
        // ARRAY['INDEX']['XML'] = INDEX XML; ARRAY['PROFILE']['XML'] = PROFILE XML
        // ARRAY['PROFILE']['PROFILE_ID']; ARRAY['PROFILE']['CONFIG_HASH']; ARRAY['PROFILE']['HTTP_FILE_ENDPOINT'];
        // ARRAY['INDEX']['CONFIG_HASH']; ARRAY['INDEX']['FILE_ENDPOINT'];
        $tmp_xml_output_ARRAY = $xml_output_ARRAY;
        $tmp_xml_construct_ARRAY = $xml_output_ARRAY;

        $tmp_xml_construct_ARRAY['PROFILE']['XML_OPEN'] = '<?xml version="1.0" encoding="UTF-8"?><obs_overlay_profile><profile>';
        $tmp_xml_construct_ARRAY['PROFILE']['XML_CLOSE'] = '</profile></obs_overlay_profile>';
        $tmp_xml_construct_ARRAY['INDEX']['XML_OPEN'] = '<?xml version="1.0" encoding="iso-8859-1"?><obs_overlay_profile_index><profile_index>';
        $tmp_xml_construct_ARRAY['INDEX']['XML_CLOSE'] = '</profile_index></obs_overlay_profile_index>';
        $tmp_xml_construct_ARRAY['LANG_PACK_SECTION']['XML_OPEN'] = '<lang_pack_translations>';
        $tmp_xml_construct_ARRAY['LANG_PACK_SECTION']['XML_CLOSE'] = '</lang_pack_translations>';

        //
        // DATA AGGREGATION

        # LANG_PACKS
        # FULLSCRN_PAGES
        # FULLSCRN_PROFILES
        # SYS_COLORS_HEX
        # COMPONENT_BULLETLIST
        # COMPONENT_BLIST_BULLETS
        # COMPONENT_PARAGRAPH
        # COMPONENT_SCHEDULE
        # COMPONENT_SCHED_DAY
        # COMPONENT_SCHED_EVENT
        # COMPONENT_SUBTITLE
        # PAGE_COMPONENTS
        # LANG_ELEM_COMPONENTS
        # OBS_CLIENTS
        # FULLSCRN_CONFIG
        # OVERLAY_STATE
        # LANG_REQUESTS

        /*

        $tmp_pid = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'OVERLAY_MGMT', 'FULLSCREEN_PROFILE_ID');
        $tmp_lastmodified_FULL = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'OBS_CLIENTS', 'FULLSCREEN_LASTMODIFIED');
        $tmp_lastmodified_MINI = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'OBS_CLIENTS', 'MINI_LASTMODIFIED');
        $tmp_master_overlay_display_area_width_in_px = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'FULLSCRN_CONFIG', 'DEFAULT_WIDTH');
        $tmp_master_overlay_display_area_height_in_px = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'FULLSCRN_CONFIG', 'DEFAULT_HEIGHT');
        $tmp_copy_display_area_width_in_px = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'FULLSCRN_CONFIG', 'DEFAULT_CONTENT_WIDTH');
        $tmp_copy_display_area_height_in_px = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'FULLSCRN_CONFIG', 'DEFAULT_CONTENT_HEIGHT');
        $tmp_master_overlay_bgcolor = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'FULLSCRN_CONFIG', 'HEXCOLOR');
        $tmp_master_overlay_bgopacity = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'FULLSCRN_CONFIG', 'OPACITY');
        $tmp_overlay_copy_color = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'FULLSCRN_CONFIG', 'COPY_HEXCOLOR');
        $tmp_lang_pack_rotation_interval_secs = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'FULLSCRN_CONFIG', 'LANG_PACK_ROTATION_SECS');

        $tmp_name = $oDB_RESP->retrieveDataByID($oDB_RESP->return_serial($tmp_serial_handle), 'FULLSCRN_PROFILE', $tmp_pid, 'PROFILE_NAME');

        */

        //
        // BUILD SECTION 00
        $tmp_xml_construct_ARRAY['PROFILE']['SECT_00'] = '<pid>'.$oDB_RESP->return_data_element($oDB_RESP->return_serial($serial_handle), 'FULLSCRN_PROFILES', 'PROFILE_ID').'</pid>
        <lastmodified>'.$oDB_RESP->return_data_element($oDB_RESP->return_serial($serial_handle), 'OVERLAY_STATE', 'FULLSCREEN_LASTMODIFIED').'</lastmodified>
        <type>full</type>
        <master_overlay_visible_BOOL>'.$this->int_to_string_BOOL_conversion($oDB_RESP->return_data_element($oDB_RESP->return_serial($serial_handle), 'OBS_CLIENTS', 'ISVISIBLE_FULLSCRN')).'</master_overlay_visible_BOOL>
        <copy_overlay_visible_BOOL>true</copy_overlay_visible_BOOL>
        <height_mgmt_mode>DYNAMIC</height_mgmt_mode>

        <master_overlay_display_area_width_in_px>'.$oDB_RESP->return_data_element($oDB_RESP->return_serial($serial_handle), 'FULLSCRN_CONFIG', 'DEFAULT_WIDTH').'</master_overlay_display_area_width_in_px>
        <master_overlay_display_area_height_in_px>'.$oDB_RESP->return_data_element($oDB_RESP->return_serial($serial_handle), 'FULLSCRN_CONFIG', 'DEFAULT_HEIGHT').'</master_overlay_display_area_height_in_px>
        <copy_display_area_width_in_px>'.$oDB_RESP->return_data_element($oDB_RESP->return_serial($serial_handle), 'FULLSCRN_CONFIG', 'DEFAULT_CONTENT_WIDTH').'</copy_display_area_width_in_px>
        <copy_display_area_height_in_px>'.$oDB_RESP->return_data_element($oDB_RESP->return_serial($serial_handle), 'FULLSCRN_CONFIG', 'DEFAULT_CONTENT_HEIGHT').'</copy_display_area_height_in_px>

        <lang_pack_rotation_interval_secs>'.$oDB_RESP->return_data_element($oDB_RESP->return_serial($serial_handle), 'FULLSCRN_CONFIG', 'LANG_PACK_ROTATION_SECS').'</lang_pack_rotation_interval_secs>
        <page_rotation_interval_secs>'.$oDB_RESP->return_data_element($oDB_RESP->return_serial($serial_handle), 'FULLSCRN_CONFIG', 'PAGE_ROTATION_SECS').'</page_rotation_interval_secs>
        
        <name>'.$oDB_RESP->return_data_element($oDB_RESP->return_serial($serial_handle), 'FULLSCRN_PROFILES', 'PROFILE_NAME').'</name>';

        //
        // BUILD LANGUAGE PACK SECTION
        $tmp_loop_size_LANG_REQUESTS = $oDB_RESP->return_sizeof($oDB_RESP->return_serial($serial_handle), 'LANG_REQUESTS');

        //
        // ## PAGE CONSTRUCTION
        // FOR EACH LANGUAGE REQUESTED FOR OVERLAY PROFILE
        for($i=0;$i<$tmp_loop_size_LANG_REQUESTS;$i++){
            $tmp_LANG_REQUESTS_LANG_ID = $oDB_RESP->return_data_element($oDB_RESP->return_serial($serial_handle), 'LANG_REQUESTS', 'LANG_ID', $i);
            
            $tmp_page_content_ARRAY = $this->returnPageDataByLang($oDB_RESP, $serial_handle, $tmp_LANG_REQUESTS_LANG_ID);

            for($ii=0; $ii<$tmp_page_content_ARRAY['cnt']; $ii++){

                if(!array_key_exists('PAGES', $tmp_xml_construct_ARRAY)){
                    $tmp_xml_construct_ARRAY['PAGES'][$tmp_LANG_REQUESTS_LANG_ID] = '';
                }else{
                    if(!array_key_exists($tmp_LANG_REQUESTS_LANG_ID, $tmp_xml_construct_ARRAY['PAGES'])){
                        $tmp_xml_construct_ARRAY['PAGES'][$tmp_LANG_REQUESTS_LANG_ID] = '';
                    }

                }

                $tmp_xml_construct_ARRAY['PAGES'][$tmp_LANG_REQUESTS_LANG_ID] .= '<page>
                        <header><![CDATA['.$tmp_page_content_ARRAY[$ii]['header'].']]></header>
                        <title><![CDATA['.$tmp_page_content_ARRAY[$ii]['title'].']]></title>
                        <content_body><![CDATA['.$tmp_page_content_ARRAY[$ii]['content_body'].']]></content_body>
                        <font_size_percentage>'.$tmp_page_content_ARRAY[$ii]['font_size_percentage'].'</font_size_percentage>
                        <bgcolor>'.$tmp_page_content_ARRAY[$ii]['bgcolor'].'</bgcolor>
                        <bgopacity>'.$tmp_page_content_ARRAY[$ii]['bgopacity'].'</bgopacity>
                        <copycolor>'.$tmp_page_content_ARRAY[$ii]['copycolor'].'</copycolor>
                        <page_sequence>'.$tmp_page_content_ARRAY[$ii]['page_sequence'].'</page_sequence>
                        <cleartext_endpoint>'.$tmp_page_content_ARRAY[$ii]['cleartext_endpoint'].'</cleartext_endpoint>
                        <content_hash>'.$tmp_page_content_ARRAY[$ii]['content_hash'].'</content_hash>
                    </page>';

            }

        }

        //
        //  ## LANG_PACK_SECTION CONSTRUCTION
        for($i=0;$i<$tmp_loop_size_LANG_REQUESTS;$i++){
            $tmp_LANG_REQUESTS_LANG_ID = $oDB_RESP->return_data_element($oDB_RESP->return_serial($serial_handle), 'LANG_REQUESTS', 'LANG_ID', $i);
            // ARRAY[en] = <XML></XML>

            //
            // PASS THIS ARRAY PARAM TO returnProfileXML()
            $tmp_xml_construct_ARRAY['LANG_PACK_SECTION'][] = '<lang_pack>
                <lang_id>'.strtolower($tmp_LANG_REQUESTS_LANG_ID).'</lang_id>
                <overlay_pages>
                    '.$tmp_xml_construct_ARRAY['PAGES'][$tmp_LANG_REQUESTS_LANG_ID].'
                </overlay_pages>
            </lang_pack>';

        }

        $tmp_xml_output_ARRAY['PROFILE']['PROFILE_ID'] = $oDB_RESP->return_data_element($oDB_RESP->return_serial($serial_handle), 'FULLSCRN_PROFILES', 'PROFILE_ID');
        $tmp_xml_output_ARRAY['PROFILE']['XML'] = $this->returnProfileXML($tmp_xml_construct_ARRAY);
        //$tmp_xml_output_ARRAY['PROFILE']['DIR_FILE'] = $oDB_RESP->return_data_element($oDB_RESP->return_serial($serial_handle), 'FULLSCRN_PROFILES', 'DIR_XML_ENDPOINT');
        //$tmp_xml_output_ARRAY['PROFILE']['HTTP_FILE_ENDPOINT'] = $oDB_RESP->return_data_element($oDB_RESP->return_serial($serial_handle), 'FULLSCRN_PROFILES', 'HTTP_XML_ENDPOINT');

        $tmp_hash_algo = self::$oEnv->getEnvParam('COPY_HASH_ALGO');
        $tmp_content_hash = hash($tmp_hash_algo, $tmp_xml_output_ARRAY['PROFILE']['XML']);
        $tmp_xml_output_ARRAY['PROFILE']['CONFIG_HASH'] = $tmp_content_hash;

        $tmp_xml_output_ARRAY['INDEX']['XML'] = $this->returnIndexXML($oDB_RESP, $serial_handle, $tmp_xml_construct_ARRAY, $tmp_xml_output_ARRAY, 'full');
        //$tmp_xml_output_ARRAY['INDEX']['DIR_FILE'] = $oDB_RESP->return_data_element($oDB_RESP->return_serial($serial_handle), 'OBS_CLIENTS', 'XML_INDEX_DIR_FILE_PATH');

        //
        // CONFIRM FILE ENDPOINT INTEGRITY
        //$xml_output_ARRAY['PROFILE']['DIR_FILE_ENDPOINT'] = $this->xmlFileEndpointPrep($oDB_RESP, $serial_handle, $oUser, $type, $xml_output_ARRAY['PROFILE']['DIR_FILE'],'PROFILE_DIR_FILE');
        //$xml_output_ARRAY['PROFILE']['HTTP_FILE_ENDPOINT'] = $this->xmlFileEndpointPrep($oDB_RESP, $serial_handle, $oUser, $type, $xml_output_ARRAY['PROFILE']['HTTP_FILE_ENDPOINT'],'PROFILE_HTTP_FILE_ENDPOINT');
        //$xml_output_ARRAY['INDEX']['DIR_FILE_ENDPOINT'] = $this->xmlFileEndpointPrep($oDB_RESP, $serial_handle, $oUser, $type, $xml_output_ARRAY['INDEX']['DIR_FILE'],'INDEX_DIR_FILE');

        return $tmp_xml_output_ARRAY;
/*
<?xml version="1.0" encoding="UTF-8"?>
<obs_overlay_profile>
    <profile>
        <pid>xuTLgaatXgJk4C5WuVwJOqvzaazwswaQRznxOwlDvFsP8PU8KAAYuKDMWWjF8wLMUG1HXu</pid>
        <lastmodified>10/02/2019 00:00:00</lastmodified>
        <type>full</type>
        <master_overlay_visible_BOOL>true</master_overlay_visible_BOOL>
        <copy_overlay_visible_BOOL>true</copy_overlay_visible_BOOL>
        <height_mgmt_mode>DYNAMIC</height_mgmt_mode>

        <master_overlay_display_area_width_in_px>4000</master_overlay_display_area_width_in_px>
        <master_overlay_display_area_height_in_px>2000</master_overlay_display_area_height_in_px>
        <copy_display_area_width_in_px>700</copy_display_area_width_in_px>
        <copy_display_area_height_in_px>600</copy_display_area_height_in_px>

        <lang_pack_rotation_interval_secs>25</lang_pack_rotation_interval_secs>
        <subcopy_rotation_interval_secs>12</subcopy_rotation_interval_secs>

        <name>SE Blend Conf - Schedule</name>
        <lang_pack_translations>

            <lang_pack>
                <lang_id>en</lang_id>
                <overlay_pages>
                    <page>
                        <header><![CDATA[]]></header>
                        <title><![CDATA[]]></title>
                        <content_body><![CDATA[]]></content_body>
                        <font_size_percentage></font_size_percentage>
                        <bgcolor>#FFF</bgcolor>
                        <bgopacity>0.6</bgopacity>
                        <copycolor>#1A182D</copycolor>
                        <page_sequence></page_sequence>
                        <cleartext_endpoint>NULL</cleartext_endpoint>
                        <content_hash></content_hash>
                    </page>
                    <page></page>
                    <page></page>
                    <page></page>
                </overlay_pages>
            </lang_pack>

            <lang_pack>
                <lang_id>ko</lang_id>
                <overlay_pages>
                    <page>
                        <header><![CDATA[]]></header>
                        <title><![CDATA[]]></title>
                        <content_body><![CDATA[]]></content_body>
                        <font_size_percentage></font_size_percentage>
                        <bgcolor>#FFF</bgcolor>
                        <bgopacity>0.6</bgopacity>
                        <copycolor>#1A182D</copycolor>
                        <page_sequence></page_sequence>
                        <cleartext_endpoint>NULL</cleartext_endpoint>
                        <content_hash></content_hash>
                    </page>
                    <page></page>
                    <page></page>
                    <page></page>
                </overlay_pages>
            </lang_pack>
        </lang_pack_translations>

        <config_hash>aazwswaQRznjkjjwlDvFsP</config_hash>

    </profile>

</obs_overlay_profile>

<?xml version="1.0" encoding="iso-8859-1"?>
<obs_overlay_profile_index>
    <profile_index>
        <profile>
            <requestor_id>jville</requestor_id>
            <pid>bfDTUpCEp3pzGg6OjiL2Lj8gkCmyfMWLdkUm89is7N56ZMRCf7sb41EzJ1OIitnjTywF7H</pid>
            <config_hash>a1185ffjjkhhe1</config_hash>
            <profile_endpoint>http://172.16.225.128/avoverlay/common/xml/_profiles/2019seblendjville_mini4674863872f.xml</profile_endpoint>
            <profile_endpoint_prod>http://avoverlay.jony5.com/common/xml/_profiles/2019seblendjville_mini4674863872f.xml</profile_endpoint_prod>
            <lastmodified>2019-08-27 22:33:50</lastmodified>
        </profile>
        <profile>
            <requestor_id>jville</requestor_id>
            <pid>2hDCI8O5ysC0V261r0DcPiSspbjMUnUzqccekKGbZR8CihaQJ8cd3UWfpwQ1qRYm2gPKhP</pid>
            <config_hash>6abacd887b653047f39f0bf832b69f9040</config_hash>
            <profile_endpoint>http://172.16.225.128/avoverlay/common/xml/_profiles/2019seblendjville_fullscrn4674863872.xml</profile_endpoint>
            <profile_endpoint_prod>http://avoverlay.jony5.com/common/xml/_profiles/2019seblendjville_fullscrn4674863872.xml</profile_endpoint_prod>
            <lastmodified>2019-08-27 22:20:28</lastmodified>
        </profile>
    </profile_index>
</obs_overlay_profile_index>

*/


    }

    private function returnProfileXML($tmp_xml_construct_ARRAY){
        $tmp_output_XML = '';
        $tmp_lang_pack_XML = '';

        foreach($tmp_xml_construct_ARRAY['LANG_PACK_SECTION'] as $key => $val){

            $tmp_lang_pack_XML .= $val;

        }

        $tmp_output_XML = $tmp_xml_construct_ARRAY['PROFILE']['XML_OPEN'].$tmp_xml_construct_ARRAY['PROFILE']['SECT_00'].$tmp_xml_construct_ARRAY['LANG_PACK_SECTION']['XML_OPEN'].$tmp_lang_pack_XML.$tmp_xml_construct_ARRAY['LANG_PACK_SECTION']['XML_CLOSE'].$tmp_xml_construct_ARRAY['PROFILE']['XML_CLOSE'];

        return $tmp_output_XML;
    }

    private function returnIndexXML($oDB_RESP, $serial_handle, $xml_construct_ARRAY, $xml_output_ARRAY, $type='full'){

        /*
        <?xml version="1.0" encoding="iso-8859-1"?>
        <obs_overlay_profile_index>
            <profile_index>
                <profile>
                    <requestor_id>jville</requestor_id>
                    <pid>bfDTUpCEp3pzGg6OjiL2Lj8gkCmyfMWLdkUm89is7N56ZMRCf7sb41EzJ1OIitnjTywF7H</pid>
                    <config_hash>a1185ffjjkhhe1</config_hash>
                    <profile_endpoint>http://172.16.225.128/avoverlay/common/xml/_profiles/2019seblendjville_mini4674863872f.xml</profile_endpoint>
                    <profile_endpoint_prod>http://avoverlay.jony5.com/common/xml/_profiles/2019seblendjville_mini4674863872f.xml</profile_endpoint_prod>
                    <lastmodified>2019-08-27 22:33:50</lastmodified>
                </profile>
                <profile>
                    <requestor_id>jville</requestor_id>
                    <pid>2hDCI8O5ysC0V261r0DcPiSspbjMUnUzqccekKGbZR8CihaQJ8cd3UWfpwQ1qRYm2gPKhP</pid>
                    <config_hash>6abacd887b653047f39f0bf832b69f9040</config_hash>
                    <profile_endpoint>http://172.16.225.128/avoverlay/common/xml/_profiles/2019seblendjville_fullscrn4674863872.xml</profile_endpoint>
                    <profile_endpoint_prod>http://avoverlay.jony5.com/common/xml/_profiles/2019seblendjville_fullscrn4674863872.xml</profile_endpoint_prod>
                    <lastmodified>2019-08-27 22:20:28</lastmodified>
                </profile>
            </profile_index>
        </obs_overlay_profile_index>

        DIR_XML_ENDPOINT`,
         * */

        $tmp_output_XML = '';
        $tmp_lang_pack_XML = '';

        switch($type){
            case 'full':
                //
                //
                $xml_construct_ARRAY['INDEX']['SECT_00'] = '<profile>
                    <requestor_id>'.$oDB_RESP->return_data_element($oDB_RESP->return_serial($serial_handle), 'OVERLAY_STATE', 'OBS_ID').'</requestor_id>
                    <pid>'.$oDB_RESP->return_data_element($oDB_RESP->return_serial($serial_handle), 'FULLSCRN_PROFILES', 'PROFILE_ID').'</pid>
                    <config_hash>'.$xml_output_ARRAY['PROFILE']['CONFIG_HASH'].'</config_hash>
                    <profile_endpoint>'.self::$oEnv->getEnvParam('ROOT_PATH_CLIENT_HTTP').self::$oEnv->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').$xml_output_ARRAY['PROFILE']['HTTP_FILE_ENDPOINT'].'</profile_endpoint>
                    <profile_endpoint_prod>'.self::$oEnv->getEnvParam('ROOT_PATH_CLIENT_HTTP_PROD').$xml_output_ARRAY['PROFILE']['HTTP_FILE_ENDPOINT'].'</profile_endpoint_prod>
                    <lastmodified>'.$oDB_RESP->return_data_element($oDB_RESP->return_serial($serial_handle), 'FULLSCRN_PROFILES', 'DATEMODIFIED').'</lastmodified>
                </profile>';

                $xml_construct_ARRAY['INDEX']['SECT_00'] .= '<profile>
                    <requestor_id>'.$oDB_RESP->return_data_element($oDB_RESP->return_serial($serial_handle), 'OVERLAY_STATE', 'OBS_ID').'</requestor_id>
                    <pid>'.$oDB_RESP->retrieveDataByID($oDB_RESP->return_serial($serial_handle), 'MINI_PROFILES', $oDB_RESP->return_data_element($oDB_RESP->return_serial($serial_handle), 'OBS_CLIENTS', 'MINI_PROFILE_ID'), 'PROFILE_ID').'</pid>
                    <config_hash>'.$oDB_RESP->return_data_element($oDB_RESP->return_serial($serial_handle), 'OVERLAY_STATE', 'MINI_PROFILE_HASH').'</config_hash>
                    <profile_endpoint>'.self::$oEnv->getEnvParam('ROOT_PATH_CLIENT_HTTP').self::$oEnv->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').$xml_output_ARRAY['INDEX']['DIR_FILE_ENDPOINT'].'</profile_endpoint>
                    <profile_endpoint_prod>'.self::$oEnv->getEnvParam('ROOT_PATH_CLIENT_HTTP_PROD').$xml_output_ARRAY['INDEX']['DIR_FILE_ENDPOINT'].'</profile_endpoint_prod>
                    <lastmodified>'.$oDB_RESP->retrieveDataByID($oDB_RESP->return_serial($serial_handle), 'MINI_PROFILES', $oDB_RESP->return_data_element($oDB_RESP->return_serial($serial_handle), 'OBS_CLIENTS', 'MINI_PROFILE_ID'), 'DATEMODIFIED').'</lastmodified>
                </profile>';

                /*
                 $xml_output_ARRAY['PROFILE']['DIR_FILE_ENDPOINT'] = $this->xmlFileEndpointPrep($oDB_RESP, $serial_handle, $oUser, $type, $oDB_RESP->return_data_element($oDB_RESP->return_serial($serial_handle), 'FULLSCRN_PROFILES', 'DIR_XML_ENDPOINT'),'PROFILE_DIR_FILE');
            $xml_output_ARRAY['PROFILE']['HTTP_FILE_ENDPOINT'] = $this->xmlFileEndpointPrep($oDB_RESP, $serial_handle, $oUser, $type, $oDB_RESP->return_data_element($oDB_RESP->return_serial($serial_handle), 'FULLSCRN_PROFILES', 'HTTP_XML_ENDPOINT'),'PROFILE_HTTP_FILE_ENDPOINT');
            $xml_output_ARRAY['INDEX']['DIR_FILE_ENDPOINT']
                 * */

            break;
            case 'mini':

            break;

        }

        $tmp_output_XML = $xml_construct_ARRAY['INDEX']['XML_OPEN'].$xml_construct_ARRAY['INDEX']['SECT_00'].$xml_construct_ARRAY['INDEX']['XML_CLOSE'];

        return $tmp_output_XML;
    }

    private function returnPageDataByLang($oDB_RESP, $serial_handle, $tmp_LANG_REQUESTS_LANG_ID){

        /*

        # LANG_PACKS
        # FULLSCRN_PAGES
        # FULLSCRN_PROFILES
        # SYS_COLORS_HEX

        # COMPONENT_BULLETLIST
        # COMPONENT_BLIST_BULLETS
        # COMPONENT_PARAGRAPH
        # COMPONENT_SCHEDULE
        # COMPONENT_SCHED_DAY
        # COMPONENT_SCHED_EVENT
        # COMPONENT_SUBTITLE
        # PAGE_COMPONENTS

        # LANG_ELEM_COMPONENTS
        # OBS_CLIENTS
        # FULLSCRN_CONFIG
        # OVERLAY_STATE
        # LANG_REQUESTS

         <page>
            <header><![CDATA['.$tmp_page_content_ARRAY[$ii]['header'].']]></header>
            <title><![CDATA['.$tmp_page_content_ARRAY[$ii]['title'].']]></title>
            <content_body><![CDATA['.$tmp_page_content_ARRAY[$ii]['content_body'].']]></content_body>


        <font_size_percentage>'.$tmp_page_content_ARRAY[$ii]['font_size_percentage'].'</font_size_percentage>
            <bgcolor>'.$tmp_page_content_ARRAY[$ii]['bgcolor'].'</bgcolor>
            <bgopacity>'.$tmp_page_content_ARRAY[$ii]['bgopacity'].'</bgopacity>
            <copycolor>'.$tmp_page_content_ARRAY[$ii]['copycolor'].'</copycolor>
            <page_sequence>'.$tmp_page_content_ARRAY[$ii]['page_sequence'].'</page_sequence>
            <cleartext_endpoint>'.$tmp_page_content_ARRAY[$ii]['cleartext_endpoint'].'</cleartext_endpoint>
            <content_hash>'.$tmp_page_content_ARRAY[$ii]['content_hash'].'</content_hash>
        </page>';
        */

        try{

            $tmp_page_data_ARRAY = array();
            $tmp_placed_lang_elements_ARRAY = array();
            //$tmp_loop_size_LANG_REQUESTS = $oDB_RESP->return_sizeof($oDB_RESP->return_serial($serial_handle), 'LANG_REQUESTS');

            //
            // ## PAGE CONSTRUCTION
            // FOR EACH LANGUAGE REQUESTED FOR OVERLAY PROFILE
            $tmp_content_for_page_hash = '';

            $tmp_loop_size_FULLSCRN_PAGES = $oDB_RESP->return_sizeof($oDB_RESP->return_serial($serial_handle), 'FULLSCRN_PAGES');
            for($ss=0;$ss<$tmp_loop_size_FULLSCRN_PAGES;$ss++){
                //
                // FOR EACH PAGE
                $tmp_page_id = $oDB_RESP->return_data_element($oDB_RESP->return_serial($serial_handle), 'FULLSCRN_PAGES', 'PAGE_ID', $ss);
                $tmp_page_data_ARRAY[$ss]['header'] = '';
                $tmp_page_data_ARRAY[$ss]['title'] = '';
                $tmp_page_data_ARRAY[$ss]['content_body'] = '';
                $tmp_page_data_ARRAY[$ss]['font_size_percentage'] = $oDB_RESP->retrieveDataByID($oDB_RESP->return_serial($serial_handle), 'LANG_PACKS', $tmp_LANG_REQUESTS_LANG_ID, 'FONT_SIZE_PERCENTAGE');
                $tmp_page_data_ARRAY[$ss]['bgcolor'] = $oDB_RESP->return_data_element($oDB_RESP->return_serial($serial_handle), 'FULLSCRN_PAGES', 'BGCOLOR_HEX', $ss);
                $tmp_page_data_ARRAY[$ss]['bgopacity'] = $oDB_RESP->return_data_element($oDB_RESP->return_serial($serial_handle), 'FULLSCRN_PAGES', 'OPACITY', $ss);
                $tmp_page_data_ARRAY[$ss]['copycolor'] = $oDB_RESP->return_data_element($oDB_RESP->return_serial($serial_handle), 'FULLSCRN_PAGES', 'COPYCOLOR_HEX', $ss);
                $tmp_page_data_ARRAY[$ss]['page_sequence'] = $oDB_RESP->return_data_element($oDB_RESP->return_serial($serial_handle), 'FULLSCRN_PAGES', 'SEQUENCE', $ss);

                $tmp_content_for_page_hash .= $tmp_page_data_ARRAY[$ss]['font_size_percentage'];
                $tmp_content_for_page_hash .= $tmp_page_data_ARRAY[$ss]['bgcolor'];
                $tmp_content_for_page_hash .= $tmp_page_data_ARRAY[$ss]['bgopacity'];
                $tmp_content_for_page_hash .= $tmp_page_data_ARRAY[$ss]['copycolor'];
                $tmp_content_for_page_hash .= $tmp_page_data_ARRAY[$ss]['page_sequence'];

                //
                // RETRIEVE CONTENT [PAGE_HEADER, PAGE_TITLE]
                $tmp_loop_size_LANG_ELEM_COMPONENTS = $oDB_RESP->return_sizeof($oDB_RESP->return_serial($serial_handle), 'LANG_ELEM_COMPONENTS');

                for ($ii = 0; $ii < $tmp_loop_size_LANG_ELEM_COMPONENTS; $ii++) {
                    $tmp_elem_component_type = $oDB_RESP->return_data_element($oDB_RESP->return_serial($serial_handle), 'LANG_ELEM_COMPONENTS', 'COMPONENT_TYPE', $ii);
                    $tmp_elem_content = $oDB_RESP->return_data_element($oDB_RESP->return_serial($serial_handle), 'LANG_ELEM_COMPONENTS', 'ELEMENT_CONTENT', $ii);
                    $tmp_elem_lang_id = $oDB_RESP->return_data_element($oDB_RESP->return_serial($serial_handle), 'LANG_ELEM_COMPONENTS', 'LANG_ID', $ii);
                    $tmp_elem_lang_page_id = $oDB_RESP->return_data_element($oDB_RESP->return_serial($serial_handle), 'LANG_ELEM_COMPONENTS', 'PAGE_ID', $ii);

                    //
                    // PAGE_HEADER AND PAGE_TITLE
                    if (($tmp_elem_lang_id == $tmp_LANG_REQUESTS_LANG_ID) && ($tmp_elem_component_type == 'PAGE_HEADER') && ($tmp_page_id==$tmp_elem_lang_page_id) ) {
                        $tmp_page_data_ARRAY[$ss]['header'] = '<div class="main_copy_header"><h3>'.$tmp_elem_content.'</h3></div>';
                        $tmp_content_for_page_hash .=  $tmp_elem_content;

                    }else{

                        if (($tmp_elem_lang_id == $tmp_LANG_REQUESTS_LANG_ID) && ($tmp_elem_component_type == 'PAGE_TITLE') && ($tmp_page_id==$tmp_elem_lang_page_id)) {
                            $tmp_page_data_ARRAY[$ss]['title'] = '<div class="main_document_title"><h1>'.$tmp_elem_content.'</h1></div>';
                            $tmp_content_for_page_hash .=  $tmp_elem_content;

                        }
                    }
                }

                //
                // RETRIEVE COMPONENT CONTENT FOR THIS PAGE
                $tmp_loop_size_PAGE_COMPONENTS = $oDB_RESP->return_sizeof($oDB_RESP->return_serial($serial_handle), 'PAGE_COMPONENTS');

                for($i_cnt=0; $i_cnt<$tmp_loop_size_PAGE_COMPONENTS; $i_cnt++){
                    $tmp_componentid = $oDB_RESP->return_data_element($oDB_RESP->return_serial($serial_handle), 'PAGE_COMPONENTS', 'COMPONENT_ID', $i_cnt);
                    $tmp_pageid_PAGE_COMPONENTS = $oDB_RESP->return_data_element($oDB_RESP->return_serial($serial_handle), 'PAGE_COMPONENTS', 'PAGE_ID', $i_cnt);
                    //$tmp_profileid = $oDB_RESP->return_data_element($oDB_RESP->return_serial($serial_handle), 'PAGE_COMPONENTS', 'PROFILE_ID', $i_cnt);
                    $tmp_key = $oDB_RESP->return_data_element($oDB_RESP->return_serial($serial_handle), 'PAGE_COMPONENTS', 'COMPONENT_TYPE_KEY', $i_cnt);
                    //$tmp_name = $oDB_RESP->retrieveDataByID($oDB_RESP->return_serial($serial_handle), 'COMPONENT_TYPES', $tmp_key, 'NAME');

                    //
                    // IF COMPONENT BELONGS TO THIS PAGE
                    if($tmp_pageid_PAGE_COMPONENTS == $tmp_page_id){

                        // COMPONENT_SUBTITLE', 'COMPONENT_ID
                        // COMPONENTS SHOULD BE ORDERED ACCORDING TO PAGE SEQUENCE FROM THE DB. DITTO FOR XML GENERATION.
                        // ALLOW PAGE_COMPONENTS.PAGE_SEQUENCE TO DRIVE...PERHAPS?
                        switch($tmp_key){
                            case 'SUB_TITLE':

                                $tmp_loop_size_SUBTITLE = $oDB_RESP->return_sizeof($oDB_RESP->return_serial($serial_handle), 'COMPONENT_SUBTITLE');

                                for($iii=0; $iii<$tmp_loop_size_SUBTITLE; $iii++){
                                    $tmp_subtitle_element_id = $oDB_RESP->return_data_element($oDB_RESP->return_serial($serial_handle), 'COMPONENT_SUBTITLE', 'ELEMENT_ID', $iii);
                                    $tmp_subtitle_alignment = $oDB_RESP->return_data_element($oDB_RESP->return_serial($serial_handle), 'COMPONENT_SUBTITLE', 'COPY_ALIGNMENT', $iii);

                                    if(!isset($tmp_placed_lang_elements_ARRAY[$tmp_subtitle_element_id]) && $tmp_LANG_REQUESTS_LANG_ID == $oDB_RESP->retrieveDataByID($oDB_RESP->return_serial($serial_handle), 'LANG_ELEM_COMPONENTS', $tmp_subtitle_element_id, 'LANG_ID')){
                                        $tmp_placed_lang_elements_ARRAY[$tmp_subtitle_element_id] = 1;
                                        $tmp_content_for_page_hash .= $tmp_subtitle_alignment;
                                        $tmp_subtitle_copy = html_entity_decode($oDB_RESP->retrieveDataByID($oDB_RESP->return_serial($serial_handle), 'LANG_ELEM_COMPONENTS', $tmp_subtitle_element_id, 'ELEMENT_CONTENT_BLOB'));
                                        $tmp_content_for_page_hash .= $tmp_subtitle_copy;

                                        $tmp_page_data_ARRAY[$ss]['content_body'] .= '<h3 style="padding-top:0; margin-top:0; align:'.$tmp_subtitle_alignment.';">';
                                        $tmp_output_HTML_ELEM_CLOSE = '</h3>';

                                        $tmp_page_data_ARRAY[$ss]['content_body'] .= $tmp_subtitle_copy;

                                        $tmp_page_data_ARRAY[$ss]['content_body'] .= $tmp_output_HTML_ELEM_CLOSE;

                                    }

                                }

                            break;
                            case 'PARAGRAPH':
                                $tmp_loop_size_PARAGRAPH = $oDB_RESP->return_sizeof($oDB_RESP->return_serial($serial_handle), 'COMPONENT_PARAGRAPH');

                                for($iii=0; $iii<$tmp_loop_size_PARAGRAPH; $iii++){
                                    $tmp_paragraph_element_id = $oDB_RESP->return_data_element($oDB_RESP->return_serial($serial_handle), 'COMPONENT_PARAGRAPH', 'ELEMENT_ID', $iii);
                                    $tmp_paragraph_is_bold = $oDB_RESP->return_data_element($oDB_RESP->return_serial($serial_handle), 'COMPONENT_PARAGRAPH', 'IS_BOLD', $iii);
                                    $tmp_paragraph_is_blockquote = $oDB_RESP->return_data_element($oDB_RESP->return_serial($serial_handle), 'COMPONENT_PARAGRAPH', 'IS_BLOCKQUOTE', $iii);
                                    $tmp_paragraph_alignment = $oDB_RESP->return_data_element($oDB_RESP->return_serial($serial_handle), 'COMPONENT_PARAGRAPH', 'COPY_ALIGNMENT', $iii);

                                    if(!isset($tmp_placed_lang_elements_ARRAY[$tmp_paragraph_element_id]) && $tmp_LANG_REQUESTS_LANG_ID == $oDB_RESP->retrieveDataByID($oDB_RESP->return_serial($serial_handle), 'LANG_ELEM_COMPONENTS', $tmp_paragraph_element_id, 'LANG_ID')){

                                        $tmp_placed_lang_elements_ARRAY[$tmp_paragraph_element_id] = 1;
                                        $tmp_content_for_page_hash .= $tmp_paragraph_is_bold;
                                        $tmp_content_for_page_hash .= $tmp_paragraph_is_blockquote;
                                        $tmp_content_for_page_hash .= $tmp_paragraph_alignment;

                                        $tmp_paragraph_copy = html_entity_decode($oDB_RESP->retrieveDataByID($oDB_RESP->return_serial($serial_handle), 'LANG_ELEM_COMPONENTS', $tmp_paragraph_element_id, 'ELEMENT_CONTENT_BLOB'));
                                        $tmp_content_for_page_hash .= $tmp_paragraph_copy;

                                        if($tmp_paragraph_is_blockquote == 1 || $tmp_paragraph_is_blockquote == '1'){
                                            $tmp_page_data_ARRAY[$ss]['content_body'] .= '<blockquote>';
                                            $tmp_output_HTML_ELEM_CLOSE = '</blockquote>';

                                        }else{
                                            $tmp_page_data_ARRAY[$ss]['content_body'] .= '<p style="padding-top:0; margin-top:0; align:'.$tmp_paragraph_alignment.';">';
                                            $tmp_output_HTML_ELEM_CLOSE = '</p>';

                                        }

                                        if($tmp_paragraph_is_bold=='1'){
                                            $tmp_page_data_ARRAY[$ss]['content_body'] .= '<strong>'.$tmp_paragraph_copy.'</strong>';
                                        }else{
                                            $tmp_page_data_ARRAY[$ss]['content_body'] .= $tmp_paragraph_copy;
                                        }

                                        $tmp_page_data_ARRAY[$ss]['content_body'] .= $tmp_output_HTML_ELEM_CLOSE;
                                    }

                                }

                            break;
                            case 'BULLET_LIST':
                                $tmp_loop_size_BULLET_LIST = $oDB_RESP->return_sizeof($oDB_RESP->return_serial($serial_handle), 'COMPONENT_BULLETLIST');
                                $tmp_loop_size_BULLET_BULLETS = $oDB_RESP->return_sizeof($oDB_RESP->return_serial($serial_handle), 'COMPONENT_BLIST_BULLETS');

                                for($iii=0; $iii<$tmp_loop_size_BULLET_LIST; $iii++){
                                    $tmp_bulletlist_component_id = $oDB_RESP->return_data_element($oDB_RESP->return_serial($serial_handle), 'COMPONENT_BULLETLIST', 'COMPONENT_ID', $iii);
                                    $tmp_bulletlist_bullet_style_ordered = $oDB_RESP->return_data_element($oDB_RESP->return_serial($serial_handle), 'COMPONENT_BULLETLIST', 'BULLET_STYLE_ORDERED', $iii);
                                    $tmp_bulletlist_bullet_style_unordered = $oDB_RESP->return_data_element($oDB_RESP->return_serial($serial_handle), 'COMPONENT_BULLETLIST', 'BULLET_STYLE_NOT_ORDERED', $iii);
                                    $tmp_bulletlist_is_ordered = $oDB_RESP->return_data_element($oDB_RESP->return_serial($serial_handle), 'COMPONENT_BULLETLIST', 'ISORDERED', $iii);

                                    $tmp_prior_content_to_hash  = '';
                                    $tmp_prior_content_to_hash .= $tmp_bulletlist_bullet_style_ordered;
                                    $tmp_prior_content_to_hash .= $tmp_bulletlist_bullet_style_unordered;
                                    $tmp_prior_content_to_hash .= $tmp_bulletlist_is_ordered;

                                    if($tmp_bulletlist_is_ordered == 1 || $tmp_bulletlist_is_ordered == '1'){
                                        $tmp_page_data_ARRAY[$ss]['content_body'] .= '<ol type="'.$tmp_bulletlist_bullet_style_ordered.'" style="padding-top:0;margin-top:0;">';
                                        $tmp_output_HTML_ELEM_CLOSE = '</ol>';

                                    }else{
                                        $tmp_page_data_ARRAY[$ss]['content_body'] .= '<ul  style="list-style-type:'.$tmp_bulletlist_bullet_style_unordered.'; padding-top:0;margin-top:0;">';
                                        $tmp_output_HTML_ELEM_CLOSE = '</ul>';

                                    }

                                    //
                                    // OUTPUT ALL BULLETS FOR THIS LIST
                                    for($ii=0;$ii<$tmp_loop_size_BULLET_BULLETS;$ii++){
                                        $tmp_bullet_component_id = $oDB_RESP->return_data_element($oDB_RESP->return_serial($serial_handle), 'COMPONENT_BLIST_BULLETS', 'COMPONENT_ID', $ii);
                                        $tmp_bullet_element_id = $oDB_RESP->return_data_element($oDB_RESP->return_serial($serial_handle), 'COMPONENT_BLIST_BULLETS', 'ELEMENT_ID', $ii);
                                        $tmp_bullet_desc_is_bold = $oDB_RESP->return_data_element($oDB_RESP->return_serial($serial_handle), 'COMPONENT_BLIST_BULLETS', 'DESCRIPTION_IS_BOLD', $ii);

                                        if(!isset($tmp_placed_lang_elements_ARRAY[$tmp_bullet_element_id]) && $tmp_LANG_REQUESTS_LANG_ID == $oDB_RESP->retrieveDataByID($oDB_RESP->return_serial($serial_handle), 'LANG_ELEM_COMPONENTS', $tmp_bullet_element_id, 'LANG_ID')) {

                                            $tmp_placed_lang_elements_ARRAY[$tmp_bullet_element_id] = 1;
                                            $tmp_content_for_page_hash .= $tmp_prior_content_to_hash;
                                            $tmp_prior_content_to_hash = '';
                                            $tmp_content_for_page_hash .= $tmp_bullet_desc_is_bold;

                                            $tmp_bullet_description = $oDB_RESP->retrieveDataByID($oDB_RESP->return_serial($serial_handle), 'LANG_ELEM_COMPONENTS', $tmp_bullet_element_id, 'ELEMENT_CONTENT_BLOB');
                                            $tmp_content_for_page_hash .= $tmp_bullet_description;

                                            if($tmp_bullet_component_id == $tmp_bulletlist_component_id){
                                                if($tmp_bullet_desc_is_bold=='1'){

                                                    $tmp_page_data_ARRAY[$ss]['content_body'] .= '<li><div style="width:220px;"><strong>'.$tmp_bullet_description.'</strong></div></li>';
                                                }else{

                                                    $tmp_page_data_ARRAY[$ss]['content_body'] .= '<li><div style="width:220px;">'.$tmp_bullet_description.'</div></li>';
                                                }
                                            }

                                        }

                                    }

                                    $tmp_page_data_ARRAY[$ss]['content_body'] .= $tmp_output_HTML_ELEM_CLOSE;

                                }

                            break;
                            case 'SCHEDULE':
                                $tmp_loop_size_PAGE_DAYS = $oDB_RESP->return_sizeof($oDB_RESP->return_serial($serial_handle), 'COMPONENT_SCHED_DAY');
                                $tmp_loop_size_PAGE_EVENTS = $oDB_RESP->return_sizeof($oDB_RESP->return_serial($serial_handle), 'COMPONENT_SCHED_EVENT');

                                $tmp_schedule_day_pos = 0;
                                $event_date_format = $oDB_RESP->retrieveDataByID($oDB_RESP->return_serial($serial_handle), 'COMPONENT_SCHEDULE', $tmp_componentid, 'DATE_FORMAT');
                                $event_time_format = $oDB_RESP->retrieveDataByID($oDB_RESP->return_serial($serial_handle), 'COMPONENT_SCHEDULE', $tmp_componentid, 'TIME_FORMAT');

                                //
                                // FROM COMPONENT_ID...BUILD SCHEDULE OUTPUT
                                # GET DAYS...
                                # FOR EACH DAY...

                                //
                                // FOR EACH DAY
                                for($ii=0;$ii<$tmp_loop_size_PAGE_DAYS;$ii++){

                                    $tmp_schedule_day_pos++;
                                    $tmp_prior_content_to_hash = '';
                                    $tmp_prior_content_to_hash .= $event_date_format;
                                    $tmp_prior_content_to_hash .= $event_time_format;

                                    $tmp_day_id = $oDB_RESP->return_data_element($oDB_RESP->return_serial($serial_handle), 'COMPONENT_SCHED_DAY', 'DAY_ID', $ii);
                                    $tmp_day_component_id = $oDB_RESP->return_data_element($oDB_RESP->return_serial($serial_handle), 'COMPONENT_SCHED_DAY', 'COMPONENT_ID', $ii);

                                    if($tmp_day_component_id==$tmp_componentid){

                                        $tmp_date = $oDB_RESP->return_data_element($oDB_RESP->return_serial($serial_handle), 'COMPONENT_SCHED_DAY', 'DATE', $ii);
                                        $tmp_prior_content_to_hash .= $tmp_date;

                                        $tmp_page_data_ARRAY[$ss]['content_body'] .= '<h4 style="padding-top:0;margin-top:0;padding-bottom:0;margin-bottom:0;">'.date($event_date_format, strtotime($tmp_date)).'</h4>';

                                        //
                                        // EVENTS OF DAY [HAS ALL EVENTS FOR ALL DAYS ON PAGE]
                                        for($iii=0;$iii<$tmp_loop_size_PAGE_EVENTS;$iii++){

                                            $tmp_event_component_id = $oDB_RESP->return_data_element($oDB_RESP->return_serial($serial_handle), 'COMPONENT_SCHED_EVENT', 'COMPONENT_ID', $iii);
                                            $tmp_event_day_id = $oDB_RESP->return_data_element($oDB_RESP->return_serial($serial_handle), 'COMPONENT_SCHED_EVENT', 'DAY_ID', $iii);

                                            if($tmp_event_component_id==$tmp_componentid && $tmp_event_day_id==$tmp_day_id){

                                                $tmp_event_element_id = $oDB_RESP->return_data_element($oDB_RESP->return_serial($serial_handle), 'COMPONENT_SCHED_EVENT', 'ELEMENT_ID', $iii);
                                                $tmp_event_desc_is_bold = $oDB_RESP->return_data_element($oDB_RESP->return_serial($serial_handle), 'COMPONENT_SCHED_EVENT', 'DESCRIPTION_IS_BOLD', $iii);
                                                $tmp_event_date = $oDB_RESP->return_data_element($oDB_RESP->return_serial($serial_handle), 'COMPONENT_SCHED_EVENT', 'DATE', $iii);

                                                if(!isset($tmp_placed_lang_elements_ARRAY[$tmp_event_element_id]) && $tmp_LANG_REQUESTS_LANG_ID == $oDB_RESP->retrieveDataByID($oDB_RESP->return_serial($serial_handle), 'LANG_ELEM_COMPONENTS', $tmp_event_element_id, 'LANG_ID')) {

                                                    $tmp_placed_lang_elements_ARRAY[$tmp_event_element_id] = 1;
                                                    $tmp_event_description = $oDB_RESP->retrieveDataByID($oDB_RESP->return_serial($serial_handle), 'LANG_ELEM_COMPONENTS', $tmp_event_element_id, 'ELEMENT_CONTENT_BLOB');
                                                    $tmp_content_for_page_hash .= $tmp_prior_content_to_hash;
                                                    $tmp_prior_content_to_hash = '';
                                                    $tmp_content_for_page_hash .= $tmp_event_desc_is_bold;
                                                    $tmp_content_for_page_hash .= $tmp_event_date;
                                                    $tmp_content_for_page_hash .= $tmp_event_description;

                                                    if($tmp_event_desc_is_bold=='1'){

                                                        $tmp_page_data_ARRAY[$ss]['content_body'] .= '<div style="float:left; padding-left: 5px; padding-right: 10px; min-width:70px;"><strong>'.self::$oUser->returnFormattedTimeCopy($event_time_format, $tmp_event_date).'</strong></div><div style="float:left; padding-right:10px; width:200px;"><strong>'.$tmp_event_description.'</strong></div><div class="cb"></div>';
                                                    }else{

                                                        $tmp_page_data_ARRAY[$ss]['content_body'] .= '<div style="float:left; padding-left: 5px; padding-right: 10px; min-width:70px;"><strong>'.self::$oUser->returnFormattedTimeCopy($event_time_format, $tmp_event_date).'</strong></div><div style="float:left; padding-right:10px; width:200px;">'.$tmp_event_description.'</div><div class="cb"></div>';
                                                    }

                                                }

                                            }

                                        }

                                    }

                                }

                            break;
                            default:

                                //
                                // HOOOSTON...VE HAF PROBLEM!
                                throw new Exception('Unknown component type ['.$tmp_key.'] found in HTMLGEN object for the purposes of XML content generation.');

                            break;

                        }

                        $tmp_page_data_ARRAY[$ss]['content_body'] .= '<div class="cb_10"></div>';
                        $tmp_page_data_ARRAY[$ss]['cleartext_endpoint'] = 'NULL';

                    }

                }

                $tmp_hash_algo = self::$oEnv->getEnvParam('COPY_HASH_ALGO');
                $tmp_content_for_page_hash = hash($tmp_hash_algo, $tmp_content_for_page_hash);
                $tmp_page_data_ARRAY[$ss]['content_hash'] = $tmp_content_for_page_hash;

                $tmp_page_data_ARRAY['cnt'] = $ss;

            }

        }catch( Exception $e ) {
                //
                // SEND THIS THROUGH THE LOGGER OBJECT
            self::$oLogger->captureNotice('html_generator->returnPageDataByLang()', LOG_EMERG, $e->getMessage());

        }


        return $tmp_page_data_ARRAY;
    }

    public function returnOverlayHTML($oDB_RESP, $display_location, $lang_id){

        switch($display_location){
            case 'PAGE_HEADER':

            break;
            case 'PAGE_TITLE':

            break;
            case 'DYNAMIC_CONTENT':

            break;
        }

        return '<div><strong>Hello <i>'.$display_location.'</i></strong></div>';
    }

    //
    // I REALIZE THIS FUNCTIONALITY IS BEING BUILT AROUND AGGREGATE RESPONSE PROCESSING...MAY WANT TO USE THIS EVERYWHERE...HOWEVER. GOT TO START SOMEWHERE.
    public function returnHTML($elem_array, $show_username=true, $is_email=false, $is_sms=false){
        try {
            # self::$element_array[0] = PROFILE
            # self::$element_array[1] = ELEMENT DATA
            # self::$element_array[2] = FIELDNAME ARRAY

            self::$element_array = $elem_array;
            self::$element_array[2] = array_flip(self::$element_array[2]);

            switch (self::$oEnv->oSESSION_MGR->getSessionParam("DEVICETYPE")) {
                case 'm':
                    return $this->html_return_mobile($show_username);
                break;
                case 'd':
                    return $this->html_return_desktop($show_username);
                break;
                default:
                    if($is_email) {
                        return $this->html_return_email();

                    } else {

                        if($is_sms){
                            return $this->html_return_sms();

                        }else{
                            //
                            // HOOOSTON...VE HAF PROBLEM!
                            throw new Exception('Unable to determine target output channel for HTML rendering.');
                        }

                    }
                break;

            }

        }catch( Exception $e ) {
            //
            // SEND THIS THROUGH THE LOGGER OBJECT
            self::$oLogger->captureNotice('html_generator->returnHTML()', LOG_EMERG, $e->getMessage());
        }

    }

    private function valReturn($field){

        return self::$element_array[1][self::$element_array[2][$field]];
    }


    private function html_return_mobile($show_username){
        # self::$element_array[0] = PROFILE
        # self::$element_array[1] = ELEMENT DATA
        # self::$element_array[2] = FIELDNAME ARRAY
        # self::$oEnv->oFINITE_EXPRESS->incarnate('ELAPSED', $tmp_elem_ts, $tmp_format_override)

        //
        // CURRENT ICON SET - SPRITE THIS?
        /*<img src="<?php echo self::$oEnv->getEnvParam('ROOT_PATH_CLIENT_HTTP').self::$oEnv->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/icon_stream.png" width="20" height="20" alt="stream" title="stream"><br>
            <img src="<?php echo self::$oEnv->getEnvParam('ROOT_PATH_CLIENT_HTTP').self::$oEnv->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/icon_kivotos.png" width="20" height="20" alt="kivotos" title="kivotos" style="border: 2px solid #FFDA3F;">&nbsp;<br>
            <img src="<?php echo self::$oEnv->getEnvParam('ROOT_PATH_CLIENT_HTTP').self::$oEnv->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/icon_asset.png" width="20" height="20" alt="asset" title="asset" style="border: 2px solid #4126FF;">*/

        if($show_username){
            $tmp_username = '<div class="element_owner">by <a href="#" style="text-decoration: none; font-weight: normal;">User Name</a></div>';
        }else{
            $tmp_username = NULL;
        }

        if(!self::$oUser->isSSL()){
            $tmp_curr_uri = urlencode(self::$oEnv->paramTunnelEncrypt("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"));
        }else{
            $tmp_curr_uri = urlencode(self::$oEnv->paramTunnelEncrypt("https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"));

        }


        switch(self::$element_array[0]){
            case 'KIVOTOS':
                $tmp_HTML = '<div class="agg_element_hr"></div><div class="cb_5"></div><div class="agg_element_wrapper" onclick="evifweb_followLink(\''.self::$oEnv->getEnvParam('ROOT_PATH_CLIENT_HTTP').self::$oEnv->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'dashboard/kivotos/?kid='.$this->valReturn('KIVOTOS_ID').'\');">
            <div class="icon_wrapper"><img src="'.self::$oEnv->getEnvParam('ROOT_PATH_CLIENT_HTTP').self::$oEnv->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'common/imgs/icon_kivotos.png" width="20" height="20" alt="kivotos" title="kivotos" style="border: 2px solid #FFDA3F;"></div>
            <div class="element_detail_wrapper">
                <div class="element_title"><a href="'.self::$oEnv->getEnvParam('ROOT_PATH_CLIENT_HTTP').self::$oEnv->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'dashboard/kivotos/?kid='.$this->valReturn('KIVOTOS_ID').'" data-ajax="false" style="text-decoration: none; font-weight: normal;">'.$this->valReturn('NAME').'</a></div>
                <div class="cb"></div>
                <div class="element_date">'.self::$oEnv->oFINITE_EXPRESS->incarnate('ELAPSED', $this->valReturn('DATECREATED')).'.</div>
                '.$tmp_username.'
                <div class="cb"></div>
            </div>
        </div>
        <div class="cb_5"></div>';

            break;
            case 'STREAMS':
                //
                // DEEP LINK TO STREAM evifweb/stream/?sid=xxxxxx&ruri
                if($this->valReturn('FEEDER_STREAM_COUNT')!="0"){
                    $tmp_feeder_count = '<div class="element_feeder_cnt">'.$this->valReturn('FEEDER_STREAM_COUNT').'</div>';

                }else{

                    $tmp_feeder_count = NULL;
                }

                $tmp_HTML = '<div class="agg_element_hr"></div><div class="cb_5"></div><div class="agg_element_wrapper" onclick="evifweb_followLink(\''.self::$oEnv->getEnvParam('ROOT_PATH_CLIENT_HTTP').self::$oEnv->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'stream/?sid='.$this->valReturn('STREAM_ID').'&ruri='.$tmp_curr_uri.'\');">
            <div class="icon_wrapper">
                <div class="icon_img"><img src="'.self::$oEnv->getEnvParam('ROOT_PATH_CLIENT_HTTP').self::$oEnv->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'common/imgs/icon_stream.png" width="20" height="20" alt="stream" title="stream"></div>
                '.$tmp_feeder_count.'
            </div>
            <div class="element_detail_wrapper">
                <div class="element_title">'.$this->valReturn('STREAM_FORMATTED').'</div>
                <div class="cb"></div>
                <div class="element_date">'.self::$oEnv->oFINITE_EXPRESS->incarnate('ELAPSED', $this->valReturn('DATECREATED')).'.</div>
                '.$tmp_username.'
                <div class="cb"></div>
            </div>
        </div>
        <div class="cb_5"></div>';
            break;
            case 'ASSETS':
                $tmp_HTML = '<div class="agg_element_hr"></div><div class="cb_5"></div><div class="agg_element_wrapper" onclick="evifweb_followLink(\''.self::$oEnv->getEnvParam('ROOT_PATH_CLIENT_HTTP').self::$oEnv->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."dashboard/kivotos/asset/preview/?tunnelEncrypt=".urlencode(self::$oEnv->paramTunnelEncrypt('&kid='.$this->valReturn('KIVOTOS_ID').'&aid='.$this->valReturn('ASSET_ID').'&cid='.$this->valReturn('CLIENT_ID').'&uid='.$this->valReturn('USER_ID'))).'\');">
            <div class="icon_wrapper"><img src="'.self::$oEnv->getEnvParam('ROOT_PATH_CLIENT_HTTP').self::$oEnv->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'common/imgs/icon_asset.png" width="20" height="20" alt="asset" title="asset" style="border: 2px solid #3C32F5;"></div>
            <div class="element_detail_wrapper">
                <div class="element_title"><a href="'.self::$oEnv->getEnvParam('ROOT_PATH_CLIENT_HTTP').self::$oEnv->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."dashboard/kivotos/asset/preview/?tunnelEncrypt=".urlencode(self::$oEnv->paramTunnelEncrypt('&kid='.$this->valReturn('KIVOTOS_ID').'&aid='.$this->valReturn('ASSET_ID').'&cid='.$this->valReturn('CLIENT_ID').'&uid='.$this->valReturn('USER_ID'))).'" data-ajax="false" style="text-decoration: none; font-weight: normal;">'.$this->valReturn('NAME').'</a></div>
                <div class="cb"></div>
                <div class="element_date">'.self::$oEnv->oFINITE_EXPRESS->incarnate('ELAPSED', $this->valReturn('DATECREATED')).'.</div>
                '.$tmp_username.'
                <div class="cb"></div>
            </div>
        </div>
        <div class="cb_5"></div>';
            break;
        }

        return $tmp_HTML;

    }

    private function html_return_desktop($show_username){

        switch($elem_array[0]){
            case 'KIVOTOS':
                $tmp_HTML = '<p>KIVOTOS OUTPUT</p>';
                break;
            case 'STREAMS':
                $tmp_HTML = '<p>STREAMS OUTPUT</p>';
                break;
            case 'ASSETS':
                $tmp_HTML = '<p>ASSETS OUTPUT</p>';
                break;
        }

        return $tmp_HTML;
    }

    private function html_return_email(){

        switch($elem_array[0]){
            case 'KIVOTOS':
                $tmp_HTML = '<p>KIVOTOS OUTPUT</p>';
                break;
            case 'STREAMS':
                $tmp_HTML = '<p>STREAMS OUTPUT</p>';
                break;
            case 'ASSETS':
                $tmp_HTML = '<p>ASSETS OUTPUT</p>';
                break;
        }

        return $tmp_HTML;

    }

    private function html_return_sms(){

        switch($elem_array[0]){
            case 'KIVOTOS':
                echo '<p>KIVOTOS OUTPUT</p>';
                break;
            case 'STREAMS':
                echo '<p>STREAMS OUTPUT</p>';
                break;
            case 'ASSETS':
                echo '<p>ASSETS OUTPUT</p>';
                break;
        }

        return $tmp_HTML;

    }

    private function int_to_string_BOOL_conversion($str){

        if($str==0 || $str=='0' || $str==3 || $str=='3'){

            return 'false';

        }else{

            return 'true';
        }

    }

    public function html_return()
    {
        try{


        }catch( Exception $e ) {
            //
            // SEND THIS THROUGH THE LOGGER OBJECT
            self::$oLogger->captureNotice('living_stream->__construct()', LOG_EMERG, $e->getMessage());
        }

    }


    public function __destruct() {

    }

}
