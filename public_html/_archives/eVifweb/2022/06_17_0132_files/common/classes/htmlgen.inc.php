<?php
/*
// J5
// Code is Poetry */

class html_generator {

    private static $oLogger;
    private static $oEnv;
    private static $oUser;

    private static $element_array;

    public function __construct($oENV, $oUSER)
    {
            //
            // INSTANTIATE LOGGER
            self::$oLogger = new crnrstn_logging();
            self::$oEnv = $oENV;
            self::$oUser = $oUSER;

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
        /*<img src="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/icon_stream.png" width="20" height="20" alt="stream" title="stream"><br>
            <img src="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/icon_kivotos.png" width="20" height="20" alt="kivotos" title="kivotos" style="border: 2px solid #FFDA3F;">&nbsp;<br>
            <img src="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/icon_asset.png" width="20" height="20" alt="asset" title="asset" style="border: 2px solid #4126FF;">*/

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
