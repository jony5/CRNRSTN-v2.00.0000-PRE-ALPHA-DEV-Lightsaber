<?php
/* 
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
include_once($CRNRSTN_ROOT . '_crnrstn.config.inc.php');
require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/session/session.inc.php');

if($oCRNRSTN_ENV->oSESSION_MGR->getSessionParam("DEVICETYPE") == "m" ||  $oCRNRSTN_ENV->getEnvParam('MOBILE_ONLY') == true){

    $tmp_serial_handle = 'LOCALE_UGC_SEARCH';
    $tmp_callback = $oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, 'callback');
    $oDB_RESP = $oUSER->wthrbg_locale_search_request();

    $tmp_resp_size = $oDB_RESP->return_sizeof($oDB_RESP->return_serial($tmp_serial_handle), 'LOCALE_SEARCH');
    $tmp_resp_typo_size = $oDB_RESP->return_sizeof($oDB_RESP->return_serial($tmp_serial_handle), 'LOCALE_TYPO_SEARCH');

    if($tmp_resp_size<1){

        if($tmp_resp_typo_size<1){

            header('Content-Type: application/javascript');
            print_r($tmp_callback.'([]);');

        }else{

            //
            // RETURN TYPO DATASET RESULTS
            $list_count = 0;
            $tmp_js_open = '([';
            $tmp_js_close = '])';
            $tmp_js_content = '';
            $tmp_flag = array();
            for($i=0;$i<$tmp_resp_typo_size;$i++){

                $tmp_SEARCH_ID = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'LOCALE_TYPO_SEARCH', 'SEARCH_ID', $i);
                $tmp_ZG_GEO_ID = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'LOCALE_TYPO_SEARCH', 'ZG_GEO_ID', $i);
                $tmp_ZG_CITY = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'LOCALE_TYPO_SEARCH', 'ZG_CITY', $i);
                $tmp_ZG_STATE = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'LOCALE_TYPO_SEARCH', 'ZG_STATE', $i);
                $tmp_ZG_ZIPCODE = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'LOCALE_TYPO_SEARCH', 'ZG_ZIPCODE', $i);
                $tmp_ZG_GEOPOINT = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'LOCALE_TYPO_SEARCH', 'ZG_GEOPOINT', $i);
                $tmp_SPROV_POSTAL = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'LOCALE_TYPO_SEARCH', 'SPROV_POSTAL', $i);
                $tmp_SPROV_NAME = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'LOCALE_TYPO_SEARCH', 'SPROV_NAME', $i);
                $tmp_SPROV_GEOPOINT = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'LOCALE_TYPO_SEARCH', 'SPROV_GEOPOINT', $i);
                $tmp_SPROV_WIKIPEDIA = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'LOCALE_TYPO_SEARCH', 'SPROV_WIKIPEDIA', $i);
                $tmp_SPROV_NAME_ALT = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'LOCALE_TYPO_SEARCH', 'SPROV_NAME_ALT', $i);
                $tmp_SPROV_ABBREV = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'LOCALE_TYPO_SEARCH', 'SPROV_ABBREV', $i);
                $tmp_DATEMODIFIED = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'LOCALE_TYPO_SEARCH', 'DATEMODIFIED', $i);

                $tmp_ugc = $oUSER->retrieve_Form_Data('USER_QUERY');
                //$tmp_filter = $tmp_ugc.' '.$tmp_ZG_CITY.' '.$tmp_ZG_STATE.' '.$tmp_SPROV_NAME.' '.$tmp_SPROV_NAME_ALT.' '.$tmp_SPROV_ABBREV;
                $tmp_filter = $tmp_ugc;

                if($list_count<5 && !isset($tmp_flag[$tmp_ZG_CITY.$tmp_ZG_STATE])){
                    $list_count++;
                    $tmp_flag[$tmp_ZG_CITY.$tmp_ZG_STATE] = 1;

                    if($tmp_js_content!=""){
                        $tmp_js_content .= ',';

                    }

                    $tmp_js_content .= '{"locale_name":"'.$tmp_ZG_CITY.', '.$tmp_SPROV_NAME.'","locale_wikipedia":"'.$tmp_SPROV_WIKIPEDIA.'","locale_filtertext":"'.$tmp_filter.'","locale_city":"'.$tmp_ZG_CITY.'","locale_state":"'.$tmp_ZG_STATE.'","locale_zipcode":"'.$tmp_ZG_ZIPCODE.'","locale_geoid":"'.$oCRNRSTN_ENV->paramTunnelEncrypt($tmp_ZG_GEO_ID).'","locale_geopoint":"'.$tmp_ZG_GEOPOINT.'"}';

                }

            }

            if($tmp_js_content!=''){

                header('Content-Type: application/javascript');
                print_r($tmp_callback.$tmp_js_open.$tmp_js_content.$tmp_js_close); //'([{"kivotosname":"item 1","kivotosuri":"http://www.google.com","kivotossearch":"norcross"},{"kivotosname":"item 2","kivotosuri":"http://www.jony5.com","kivotossearch":"norcross"},{"kivotosname":"item 3","kivotosuri":"http://www.cnn.com","kivotossearch":"norcross"},{"kivotosname":"item 4","kivotosuri":"http://www.evifweb.com","kivotossearch":"norcross"},{"kivotosname":"item 5","kivotosuri":"http://www.wired.com","kivotossearch":"norcross"}]);');

            }else{

                header('Content-Type: application/javascript');
                print_r($tmp_callback.'([]);');

            }

        }

    }else{

        $list_count = 0;
        $tmp_js_open = '([';
        $tmp_js_close = '])';
        $tmp_js_content = '';
        $tmp_flag = array();
        for($i=0;$i<$tmp_resp_size;$i++){

            $tmp_SEARCH_ID = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'LOCALE_SEARCH', 'SEARCH_ID', $i);
            $tmp_ZG_GEO_ID = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'LOCALE_SEARCH', 'ZG_GEO_ID', $i);
            $tmp_ZG_CITY = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'LOCALE_SEARCH', 'ZG_CITY', $i);
            $tmp_ZG_STATE = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'LOCALE_SEARCH', 'ZG_STATE', $i);
            $tmp_ZG_ZIPCODE = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'LOCALE_SEARCH', 'ZG_ZIPCODE', $i);
            $tmp_ZG_GEOPOINT = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'LOCALE_SEARCH', 'ZG_GEOPOINT', $i);
            $tmp_SPROV_POSTAL = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'LOCALE_SEARCH', 'SPROV_POSTAL', $i);
            $tmp_SPROV_NAME = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'LOCALE_SEARCH', 'SPROV_NAME', $i);
            $tmp_SPROV_GEOPOINT = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'LOCALE_SEARCH', 'SPROV_GEOPOINT', $i);
            $tmp_SPROV_WIKIPEDIA = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'LOCALE_SEARCH', 'SPROV_WIKIPEDIA', $i);
            $tmp_SPROV_NAME_ALT = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'LOCALE_SEARCH', 'SPROV_NAME_ALT', $i);
            $tmp_SPROV_ABBREV = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'LOCALE_SEARCH', 'SPROV_ABBREV', $i);
            $tmp_DATEMODIFIED = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'LOCALE_SEARCH', 'DATEMODIFIED', $i);

            $tmp_ugc = $oUSER->retrieve_Form_Data('USER_QUERY');
            //$tmp_filter = $tmp_ugc.' '.$tmp_ZG_CITY.' '.$tmp_ZG_STATE.' '.$tmp_SPROV_NAME.' '.$tmp_SPROV_NAME_ALT.' '.$tmp_SPROV_ABBREV;
            $tmp_filter = $tmp_ugc;


            /*
            `wthrbg_citystate_search`.`SEARCH_ID`,
            `wthrbg_citystate_search`.`ZG_GEO_ID`,
            `wthrbg_citystate_search`.`ZG_CITY`,
            `wthrbg_citystate_search`.`ZG_STATE`,
            `wthrbg_citystate_search`.`ZG_ZIPCODE`,

            ,"locale_city":"'.$tmp_ZG_CITY.'"
            ,"locale_state":"'.$tmp_ZG_STATE.'"
            ,"locale_zipcode":"'.$tmp_ZG_ZIPCODE.'"


            `wthrbg_citystate_search`.`ZG_GEOPOINT`,
            `wthrbg_citystate_search`.`SPROV_POSTAL`,
            `wthrbg_citystate_search`.`SPROV_NAME`,
            `wthrbg_citystate_search`.`SPROV_GEOPOINT`,
            `wthrbg_citystate_search`.`SPROV_WIKIPEDIA`,
            `wthrbg_citystate_search`.`SPROV_NAME_ALT`,
            `wthrbg_citystate_search`.`SPROV_ABBREV`,
            `wthrbg_citystate_search`.`DATEMODIFIED`

            $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'USERS', 'USERID', $i)
            */

            if($list_count<5 && !isset($tmp_flag[$tmp_ZG_CITY.$tmp_ZG_STATE])){
                $list_count++;
                $tmp_flag[$tmp_ZG_CITY.$tmp_ZG_STATE] = 1;

                if($tmp_js_content!=""){
                    $tmp_js_content .= ',';

                }

                $tmp_js_content .= '{"locale_name":"'.$tmp_ZG_CITY.', '.$tmp_SPROV_NAME.'","locale_wikipedia":"'.$tmp_SPROV_WIKIPEDIA.'","locale_filtertext":"'.$tmp_filter.'","locale_city":"'.$tmp_ZG_CITY.'","locale_state":"'.$tmp_ZG_STATE.'","locale_zipcode":"'.$tmp_ZG_ZIPCODE.'","locale_geoid":"'.$oCRNRSTN_ENV->paramTunnelEncrypt($tmp_ZG_GEO_ID).'","locale_geopoint":"'.$tmp_ZG_GEOPOINT.'"}';

            }

        }

        if($list_count<5){

            //
            // ADD ANY TYPO RESULTS
            $tmp_js_open = '([';
            $tmp_js_close = '])';
            $tmp_flag = array();
            for($i=0;$i<$tmp_resp_typo_size;$i++){

                $tmp_SEARCH_ID = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'LOCALE_TYPO_SEARCH', 'SEARCH_ID', $i);
                $tmp_ZG_GEO_ID = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'LOCALE_TYPO_SEARCH', 'ZG_GEO_ID', $i);
                $tmp_ZG_CITY = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'LOCALE_TYPO_SEARCH', 'ZG_CITY', $i);
                $tmp_ZG_STATE = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'LOCALE_TYPO_SEARCH', 'ZG_STATE', $i);
                $tmp_ZG_ZIPCODE = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'LOCALE_TYPO_SEARCH', 'ZG_ZIPCODE', $i);
                $tmp_ZG_GEOPOINT = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'LOCALE_TYPO_SEARCH', 'ZG_GEOPOINT', $i);
                $tmp_SPROV_POSTAL = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'LOCALE_TYPO_SEARCH', 'SPROV_POSTAL', $i);
                $tmp_SPROV_NAME = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'LOCALE_TYPO_SEARCH', 'SPROV_NAME', $i);
                $tmp_SPROV_GEOPOINT = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'LOCALE_TYPO_SEARCH', 'SPROV_GEOPOINT', $i);
                $tmp_SPROV_WIKIPEDIA = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'LOCALE_TYPO_SEARCH', 'SPROV_WIKIPEDIA', $i);
                $tmp_SPROV_NAME_ALT = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'LOCALE_TYPO_SEARCH', 'SPROV_NAME_ALT', $i);
                $tmp_SPROV_ABBREV = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'LOCALE_TYPO_SEARCH', 'SPROV_ABBREV', $i);
                $tmp_DATEMODIFIED = $oDB_RESP->return_data_element($oDB_RESP->return_serial($tmp_serial_handle), 'LOCALE_TYPO_SEARCH', 'DATEMODIFIED', $i);

                $tmp_ugc = $oUSER->retrieve_Form_Data('USER_QUERY');
                //$tmp_filter = $tmp_ugc.' '.$tmp_ZG_CITY.' '.$tmp_ZG_STATE.' '.$tmp_SPROV_NAME.' '.$tmp_SPROV_NAME_ALT.' '.$tmp_SPROV_ABBREV;
                $tmp_filter = $tmp_ugc;

                if($list_count<5 && !isset($tmp_flag[$tmp_ZG_CITY.$tmp_ZG_STATE])){
                    $list_count++;
                    $tmp_flag[$tmp_ZG_CITY.$tmp_ZG_STATE] = 1;

                    if($tmp_js_content!=""){
                        $tmp_js_content .= ',';

                    }

                    $tmp_js_content .= '{"locale_name":"'.$tmp_ZG_CITY.', '.$tmp_SPROV_NAME.'","locale_wikipedia":"'.$tmp_SPROV_WIKIPEDIA.'","locale_filtertext":"'.$tmp_filter.'","locale_city":"'.$tmp_ZG_CITY.'","locale_state":"'.$tmp_ZG_STATE.'","locale_zipcode":"'.$tmp_ZG_ZIPCODE.'","locale_geoid":"'.$oCRNRSTN_ENV->paramTunnelEncrypt($tmp_ZG_GEO_ID).'","locale_geopoint":"'.$tmp_ZG_GEOPOINT.'"}';

                }

            }

        }

        if($tmp_js_content!=''){

            header('Content-Type: application/javascript');
            print_r($tmp_callback.$tmp_js_open.$tmp_js_content.$tmp_js_close); //'([{"kivotosname":"item 1","kivotosuri":"http://www.google.com","kivotossearch":"norcross"},{"kivotosname":"item 2","kivotosuri":"http://www.jony5.com","kivotossearch":"norcross"},{"kivotosname":"item 3","kivotosuri":"http://www.cnn.com","kivotossearch":"norcross"},{"kivotosname":"item 4","kivotosuri":"http://www.evifweb.com","kivotossearch":"norcross"},{"kivotosname":"item 5","kivotosuri":"http://www.wired.com","kivotossearch":"norcross"}]);');

        }else{

            header('Content-Type: application/javascript');
            print_r($tmp_callback.'([]);');

        }

    }

}