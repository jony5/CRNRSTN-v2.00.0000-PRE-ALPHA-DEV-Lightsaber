<?php
/*
// J5
// Code is Poetry */


class messenger_scroll {

    private static $oLogger;
    private static $oData;

    public $contains_message = false;

    private static $scroll_data_ARRAY = array();


    /* MSG_SOURCEID char(70)
     * MSG_SOURCEID_CRC32
     * MSG_KEYID char(25)
     * MSG_KEYID_CRC32
     * REQUESTID char(50)
     * DATEMODIFIED
     * BODY_HTML
     * BODY_TEXT
     * SUBJECT_LINE
     * EMAIL
     * RECIPIENTNAME
     * LANGCODE
     * */

    public function __construct($oData)
    {
        //
        // INSTANTIATE LOGGER
        self::$oLogger = new crnrstn_logging();
        self::$oData = $oData;

    }

    public function roll_into_scroll($msg_array){

        $this->contains_message = true;

        self::$scroll_data_ARRAY[] = $msg_array;

    }

    public function unroll_scroll($output_key='NULL ERROR'){

        try{
            switch($output_key) {

                case 'SQL':

                    $tmp_message_SQL = '';

                    //
                    // LEAVE DATA IN ARRAY.
                    $tmp_message_SQL = self::$oData->convert_scroll_to_SQL(self::$scroll_data_ARRAY);

                    return $tmp_message_SQL;

                break;
                default:

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('Unable to determine unroll_scroll() requested output type [' . $output_key . '].');

                break;
            }

        }catch( Exception $e ) {
            //
            // SEND THIS THROUGH THE LOGGER OBJECT
            self::$oLogger->captureNotice('messenger_scroll->unroll_scroll()', LOG_EMERG, $e->getMessage());

        }

    }

    public function clear_messages(){

        //
        // CLEAR RESULT ARRAY
        array_splice(self::$scroll_data_ARRAY, 0);

        $this->contains_message = false;
    }


    public function __destruct() {

    }

}



class messenger_from_north {

    private static $oLogger;
    private static $oScroll;
    private static $oData;
    private static $oUser;
    private static $oEnv;
    private static $oDB_RESP;

    private static $message_to_scroll_ARRAY = array();
    private static $sys_notice_cnt;
    private static $sys_notice_meta_ARRAY = array();
    private static $sys_notice_SQL_ARRAY = array();
    private static $sys_notice_SQL_FLAG_ARRAY = array();
    private static $sys_notice_SQL_FIELDCNT_ARRAY = array();

    public function __construct($oData, $oUser, $oEnv, $oDB_RESP=NULL)
    {
            //
            // INSTANTIATE LOGGER
            self::$oLogger = new crnrstn_logging();

            //
            // INSTANTIATE SCROLL
            self::$oScroll = new messenger_scroll($oData);

            self::$oData = $oData;
            self::$oUser = $oUser;
            self::$oEnv = $oEnv;
            self::$oDB_RESP = $oDB_RESP;

    }

    private function prep_stream_data_SQL($stream_id,$i_feed_stream_id=NULL){

        if(!isset(self::$sys_notice_SQL_FLAG_ARRAY[$stream_id.$i_feed_stream_id])){

            $tmp_SQL_ARRAY = self::$oData->return_sys_notice_SQL('STREAM',$stream_id,$i_feed_stream_id);

            $tmp_loop_size = sizeof($tmp_SQL_ARRAY);
            for($i=0;$i<$tmp_loop_size;$i++){

                self::$sys_notice_SQL_ARRAY[] = $tmp_SQL_ARRAY[$i]['SQL'];
                self::$sys_notice_SQL_FIELDCNT_ARRAY[] = $tmp_SQL_ARRAY[$i]['FIELDCNT'];

            }

            self::$sys_notice_SQL_FLAG_ARRAY[$stream_id.$i_feed_stream_id] = 1;
        }

    }

    private function prep_kivotos_data_SQL($kivotos_id){

        if(!isset(self::$sys_notice_SQL_FLAG_ARRAY[$kivotos_id])){

            $tmp_SQL_ARRAY = self::$oData->return_sys_notice_SQL('KIVOTOS',$kivotos_id);

            self::$sys_notice_SQL_ARRAY[] = $tmp_SQL_ARRAY['SQL'];
            self::$sys_notice_SQL_FIELDCNT_ARRAY[] = $tmp_SQL_ARRAY['FIELDCNT'];

            self::$sys_notice_SQL_FLAG_ARRAY[$kivotos_id] = 1;
        }

    }

    private function prep_recent_data_SQL($element_type,$element_id){

        if(!isset(self::$sys_notice_SQL_FLAG_ARRAY[$element_id])){

            $tmp_SQL_ARRAY = self::$oData->return_sys_notice_SQL('RECENT',$element_type,$element_id);

            self::$sys_notice_SQL_ARRAY[] = $tmp_SQL_ARRAY['SQL'];
            self::$sys_notice_SQL_FIELDCNT_ARRAY[] = $tmp_SQL_ARRAY['FIELDCNT'];

            self::$sys_notice_SQL_FLAG_ARRAY[$element_id] = 1;
        }

    }


    private function assemble_notice_SQL($queryType, $cnt){

        /* $tmp_notice_ARRAY
         * [0] = RECIPIENT_EMAIL
         * [1] = RECIPIENT_NAME
         * [2] = SUBJECTLINE
         * [3] = FORMAT [HTML/TEXT]
         * [4] = HTML_BODY
         * [5] = TEXT_BODY
         * */

        $tmp_I_FEED_STREAM_ID = NULL;

        try {
            switch($queryType){
                case 'create_stream_reply':
                    $tmp_I_FEED_STREAM_ID = self::$oDB_RESP->return_data_element(self::$oDB_RESP->return_serial('SYS_NOTICE'), 'SYS_NOTICE', 'I_FEED_STREAM_ID', $cnt);

                case 'create_stream':

                    $tmp_STREAM_TYPE = self::$oDB_RESP->return_data_element(self::$oDB_RESP->return_serial('SYS_NOTICE'), 'SYS_NOTICE', 'STREAM_TYPE', $cnt);
                    $tmp_STREAM_ID = self::$oDB_RESP->return_data_element(self::$oDB_RESP->return_serial('SYS_NOTICE'), 'SYS_NOTICE', 'STREAM_ID', $cnt);

                    switch($tmp_STREAM_TYPE){
                        case 'KIVOTOS':
                            # STREAM DATA
                            # KIVOTOS DATA
                            # KIVOTOS RECENT ACTIVITY
                            $tmp_KIVOTOS_ID = self::$oDB_RESP->return_data_element(self::$oDB_RESP->return_serial('SYS_NOTICE'), 'SYS_NOTICE', 'KIVOTOS_ID', $cnt);

                            $this->prep_stream_data_SQL($tmp_STREAM_ID,$tmp_I_FEED_STREAM_ID);
                            $this->prep_kivotos_data_SQL($tmp_KIVOTOS_ID);
                            $this->prep_recent_data_SQL($tmp_STREAM_TYPE,$tmp_KIVOTOS_ID);

                        break;
                        case 'ASSET':
                            # STREAM DATA
                            # ASSET DATA
                            # ASSET RECENT ACTIVITY
                            $tmp_ASSET_ID = self::$oDB_RESP->return_data_element(self::$oDB_RESP->return_serial('SYS_NOTICE'), 'SYS_NOTICE', 'ASSET_ID', $cnt);

                            $this->prep_stream_data_SQL($tmp_STREAM_ID,$tmp_I_FEED_STREAM_ID);
                            $this->prep_asset_data_SQL($tmp_ASSET_ID);
                            $this->prep_recent_data_SQL($tmp_STREAM_TYPE,$tmp_ASSET_ID);

                        break;
                        case 'USER':
                            # STREAM DATA
                            # USER (SUBMITTER) DATA
                            # USER (SUBMITTER) RECENT ACTIVITY

                        break;
                        case 'CLIENT':
                            # STREAM DATA
                            # USER (SUBMITTER) DATA
                            # USER (SUBMITTER) RECENT ACTIVITY

                        break;
                        default:

                            //
                            // HOOOSTON...VE HAF PROBLEM!
                            throw new Exception('Unable to determine assemble_notice tmp_STREAM_TYPE ['.$tmp_STREAM_TYPE.'].');

                        break;
                    }

                    # MENTIONS - STREAM_TYPE = KIVOTOS
                    /*
                     * STREAM_ID self::$oUser->retrieve_Form_Data("STREAM_ID")
                     * I_FEED_STREAM_ID (for create_stream_reply)
                     * KIVOTOS_ID
                     * CLIENT_ID (of kivotos)
                     * USERID_SUBMITTER
                     * USERID_MENTION
                     * */

                break;
                default:

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('Unable to determine assemble_notice queryType ['.$queryType.'].');

                break;

            }

        }catch( Exception $e ) {

            //
            // SEND THIS THROUGH THE LOGGER OBJECT
            self::$oLogger->captureNotice('messenger_from_north->assemble_notice()', LOG_EMERG, $e->getMessage());

        }

    }

    public function process_scroll(){


    }

    public function build_notification_scroll(){

        for($i=0;$i<self::$sys_notice_cnt;$i++){

            $tmp_NOTICE_ID = self::$oDB_RESP->return_data_element(self::$oDB_RESP->return_serial('SYS_NOTICE'), 'SYS_NOTICE', 'NOTIFICATION_ID', $i);
            $tmp_USERID_MENTION = self::$oDB_RESP->return_data_element(self::$oDB_RESP->return_serial('SYS_NOTICE'), 'SYS_NOTICE', 'USERID_MENTION', $i);
            error_log("gabriel->build_notification_scroll() (140) notice id[".$tmp_NOTICE_ID."] mention id[".$tmp_USERID_MENTION."]");

            $tmp_QUERY_TYPE = self::$oDB_RESP->return_data_element(self::$oDB_RESP->return_serial('SYS_NOTICE'), 'SYS_NOTICE', 'QUERY_TYPE', $i);

            $this->assemble_notice_SQL($tmp_QUERY_TYPE, $i);



        }




        self::$oScroll->roll_into_scroll($tmp_notification_ARRAY);

    }

    public function has_primitive_scroll(){

        self::$sys_notice_cnt = self::$oDB_RESP->return_sizeof(self::$oDB_RESP->return_serial('SYS_NOTICE'), 'SYS_NOTICE');

        if(self::$sys_notice_cnt>0){

            return true;
        }else{

            return false;
        }

    }

    public function retrieve_primitive_scroll(){

        self::$oDB_RESP = self::$oData->processRequest('retrieve_primitive_scroll' ,self::$oUser, self::$oEnv);

    }

    private function assemble_scroll_array($queryType, $mention_id){
        try {
            //
            //
            switch ($queryType) {
                case 'create_stream_reply':
                case 'create_stream':
                    switch(self::$oUser->retrieve_Form_Data("STREAM_TYPE")){
                        case 'KIVOTOS':
                            //
                            // QUEUE KIVOTOS MENTION NOTICE
                            # MENTIONS - STREAM_TYPE = KIVOTOS
                            /*
                             * STREAM_ID self::$oUser->retrieve_Form_Data("STREAM_ID")
                             * I_FEED_STREAM_ID (for create_stream_reply)
                             * KIVOTOS_ID
                             * CLIENT_ID (of kivotos)
                             * USERID_SUBMITTER
                             * USERID_MENTION
                             * */

                            $tmp_scroll_array = array();

                            $tmp_scroll_array['QUERY_TYPE'] = $queryType;
                            $tmp_scroll_array['STREAM_TYPE'] = self::$oUser->retrieve_Form_Data("STREAM_TYPE");
                            $tmp_scroll_array['CLIENT_ID'] = self::$oUser->retrieve_Form_Data("CLIENT_ID");
                            $tmp_scroll_array['USERID_MENTION'] = $mention_id;
                            $tmp_scroll_array['USERID_SUBMITTER'] = self::$oEnv->oSESSION_MGR->getSessionParam('USERID');
                            $tmp_scroll_array['KIVOTOS_ID'] = self::$oUser->retrieve_Form_Data("KIVOTOS_ID");
                            $tmp_scroll_array['STREAM_ID'] = self::$oUser->retrieve_Form_Data("STREAM_ID");
                            $tmp_scroll_array['I_FEED_STREAM_ID'] = self::$oUser->retrieve_Form_Data("I_FEED_STREAM_ID");

                            return $tmp_scroll_array;

                        break;
                        case 'ASSET':
                            //
                            // QUEUE ASSET MENTION NOTICE
                            # MENTIONS - STREAM_TYPE = ASSETS
                            /*
                             * STREAM_ID self::$oUser->retrieve_Form_Data("STREAM_ID")
                             * I_FEED_STREAM_ID (for create_stream_reply)
                             * CLIENT_ID (of asset)
                             * ASSET_ID
                             * USERID_SUBMITTER
                             * USERID_MENTION
                             * */

                            $tmp_scroll_array = array();

                            $tmp_scroll_array['QUERY_TYPE'] = $queryType;
                            $tmp_scroll_array['STREAM_TYPE'] = self::$oUser->retrieve_Form_Data("STREAM_TYPE");
                            $tmp_scroll_array['CLIENT_ID'] = self::$oUser->retrieve_Form_Data("CLIENT_ID");
                            $tmp_scroll_array['USERID_MENTION'] = $mention_id;
                            $tmp_scroll_array['USERID_SUBMITTER'] = self::$oEnv->oSESSION_MGR->getSessionParam('USERID');
                            $tmp_scroll_array['ASSET_ID'] = self::$oUser->retrieve_Form_Data("ASSET_ID");
                            $tmp_scroll_array['STREAM_ID'] = self::$oUser->retrieve_Form_Data("STREAM_ID");
                            $tmp_scroll_array['I_FEED_STREAM_ID'] = self::$oUser->retrieve_Form_Data("I_FEED_STREAM_ID");

                            return $tmp_scroll_array;

                        break;
                        case 'USER':
                            //
                            // QUEUE USER MENTION NOTICE
                            # MENTIONS - STREAM_TYPE = USER
                            /*
                             * STREAM_ID self::$oUser->retrieve_Form_Data("STREAM_ID")
                             * I_FEED_STREAM_ID (for create_stream_reply)
                             * USERID_SUBMITTER
                             * USERID_MENTION
                             * USERID_DASHBOARD
                             * */

                            $tmp_scroll_array = array();

                            $tmp_scroll_array['QUERY_TYPE'] = $queryType;
                            $tmp_scroll_array['STREAM_TYPE'] = self::$oUser->retrieve_Form_Data("STREAM_TYPE");
                            $tmp_scroll_array['USERID_MENTION'] = $mention_id;
                            $tmp_scroll_array['USERID_SUBMITTER'] = self::$oEnv->oSESSION_MGR->getSessionParam('USERID');
                            $tmp_scroll_array['USERID_DASHBOARD'] = self::$oUser->retrieve_Form_Data("USERID_DASHBOARD");
                            $tmp_scroll_array['STREAM_ID'] = self::$oUser->retrieve_Form_Data("STREAM_ID");
                            $tmp_scroll_array['I_FEED_STREAM_ID'] = self::$oUser->retrieve_Form_Data("I_FEED_STREAM_ID");

                            return $tmp_scroll_array;

                        break;
                        case 'CLIENT':
                            //
                            // QUEUE CLIENT MENTION NOTICE
                            # MENTIONS - STREAM_TYPE = CLIENT
                            /*
                             * STREAM_ID self::$oUser->retrieve_Form_Data("STREAM_ID")
                             * I_FEED_STREAM_ID (for create_stream_reply)
                             * CLIENT_ID (of client dashboard)
                             * USERID_SUBMITTER
                             * USERID_MENTION
                             * */

                            $tmp_scroll_array = array();

                            $tmp_scroll_array['QUERY_TYPE'] = $queryType;
                            $tmp_scroll_array['STREAM_TYPE'] = self::$oUser->retrieve_Form_Data("STREAM_TYPE");
                            $tmp_scroll_array['CLIENT_ID'] = self::$oUser->retrieve_Form_Data("CLIENT_ID");
                            $tmp_scroll_array['USERID_MENTION'] = $mention_id;
                            $tmp_scroll_array['USERID_SUBMITTER'] = self::$oEnv->oSESSION_MGR->getSessionParam('USERID');
                            $tmp_scroll_array['STREAM_ID'] = self::$oUser->retrieve_Form_Data("STREAM_ID");
                            $tmp_scroll_array['I_FEED_STREAM_ID'] = self::$oUser->retrieve_Form_Data("I_FEED_STREAM_ID");

                            return $tmp_scroll_array;

                        break;
                        default:

                            //
                            // HOOOSTON...VE HAF PROBLEM!
                            throw new Exception('Unable to determine assemble_scroll_array STREAM_TYPE ['.self::$oUser->retrieve_Form_Data("STREAM_TYPE").'] .');

                        breaK;

                    }

                break;
                case 'create_child_kivotos':
                case 'create_kivotos':

                    # MENTIONS - create_kivotos
                    /*
                     * KIVOTOS_ID
                     * P_KIVOTOS_ID (for create_child_kivotos)
                     * CLIENT_ID (of kivotos)
                     * USERID_MENTION
                     * USERID_SUBMITTER
                     * */
                    $tmp_scroll_array = array();

                    $tmp_scroll_array['QUERY_TYPE'] = $queryType;
                    $tmp_scroll_array['CLIENT_ID'] = self::$oUser->retrieve_Form_Data("CLIENT_ID");
                    $tmp_scroll_array['KIVOTOS_ID'] = self::$oUser->retrieve_Form_Data("KIVOTOS_ID");
                    $tmp_scroll_array['P_KIVOTOS_ID'] = self::$oUser->retrieve_Form_Data("P_KIVOTOS_ID");
                    $tmp_scroll_array['USERID_MENTION'] = $mention_id;
                    $tmp_scroll_array['USERID_SUBMITTER'] = self::$oEnv->oSESSION_MGR->getSessionParam('USERID');

                    return $tmp_scroll_array;

                break;
                case 'save_asset_update':
                case 'save_asset_content':
                    /*
                     $oUser->save_Form_Data('MENTION_ARRAY', $oInputTransformer->return_mention_id());
                        $oUser->save_Form_Data('KIVOTOS_ID', $oUser->getReqParamByKey("KIVOTOS_ID"));
                        $oUser->save_Form_Data('STREAM_ID', $oUser->getReqParamByKey("STREAM_ID"));
                        $oUser->save_Form_Data('ASSET_ID', $oUser->getReqParamByKey("ASSET_ID"));
                        $oUser->save_Form_Data('CLIENT_ID', $oUser->getReqParamByKey("CLIENT_ID"));
                        $oUser->save_Form_Data('ASSET_TYPE', $oUser->getReqParamByKey("ASSET_TYPE"));
                        $oUser->save_Form_Data('SPECIALTY_TYPE', $oUser->getReqParamByKey("SPECIALTY_TYPE"));
                     * */

                    $tmp_scroll_array = array();

                    $tmp_scroll_array['QUERY_TYPE'] = $queryType;
                    $tmp_scroll_array['ASSET_TYPE'] = self::$oUser->retrieve_Form_Data("ASSET_TYPE");
                    $tmp_scroll_array['SPECIALTY_TYPE'] = self::$oUser->retrieve_Form_Data("SPECIALTY_TYPE");
                    $tmp_scroll_array['CLIENT_ID'] = self::$oUser->retrieve_Form_Data("CLIENT_ID");
                    $tmp_scroll_array['KIVOTOS_ID'] = self::$oUser->retrieve_Form_Data("KIVOTOS_ID");
                    $tmp_scroll_array['STREAM_ID'] = self::$oUser->retrieve_Form_Data("STREAM_ID");
                    $tmp_scroll_array['ASSET_ID'] = self::$oUser->retrieve_Form_Data("ASSET_ID");
                    $tmp_scroll_array['USERID_MENTION'] = $mention_id;
                    $tmp_scroll_array['USERID_SUBMITTER'] = self::$oEnv->oSESSION_MGR->getSessionParam('USERID');

                    return $tmp_scroll_array;

                break;
                default:
                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('Unable to determine assemble_scroll_array queryType ['.$queryType.'] .');

                break;


            }

        }catch( Exception $e ) {
            //
            // SEND THIS THROUGH THE LOGGER OBJECT
            self::$oLogger->captureNotice('messenger_from_north->assemble_scroll_array()', LOG_EMERG, $e->getMessage());

        }

    }

    public function is_mention_notification_on(){

        //
        // DO WE HAVE USER DATA? IF NOT, GET.
        /*
        if(self::$oDB_RESP->ping_profile_existence(self::$oDB_RESP->return_serial('SYS_USERS'), 'USERS')){



        }else{

            //
            // GET USERS DATA WITH ALL PREFERENCES

        }

        */

        return true;

    }

    private function queue_mentions_notifications($queryType){
        /**
         * NEW TABLE FOR SUPPORT OF GABRIEL'S MESSAGING
         * sys_notification
         * NOTIFICATION_ID auto_increment
         * ISACTIVE
         * CLIENT_ID
         * USERID_SUBMITTER
         * USERID_MENTION
         * USERID_DASHBOARD
         * CLIENT_ID_MENTION
         * CLIENT_ID_DASHBOARD
         * STREAM_ID
         * I_FEED_STREAM_ID
         * KIVOTOS_ID
         * P_KIVOTOS_ID
         * ASSET_ID
         * DATEMODIFIED
         * DATECREATED
         */

        try{
            $tmp_mentions_array = self::$oUser->retrieve_Form_Data("MENTION_ARRAY");

            $tmp_loop_size = sizeof($tmp_mentions_array);
            if($tmp_loop_size>0){

                switch($queryType){
                    case 'create_stream_reply':
                    case 'create_stream':

                        //
                        // WE HAVE MENTIONS TO PROCESS FOR NOTIFICATIONS
                        for($i=0;$i<$tmp_loop_size;$i++){

                            //
                            // IS USER_MENTION_NOTIFICATION_ON = 1
                            if($this->is_mention_notification_on($tmp_mentions_array[$i])){

                                # WILL LOOP THROUGH THIS FOR EACH MENTION TO BE BUILD AND QUEUED #

                                # ASSEMBLE MESSAGE (SAME METHOD HANDLES ALL ASSEMBLY) - POSSIBLE READ REQUESTS
                                # QUEUE QUEUE-MESSAGE-SQL (DO NOT WRITE YET..WILL BATCH)
                                # CLEAR ANY *UNNECESSARY* MESSAGE ASSEMBLY CACHE

                                self::$message_to_scroll_ARRAY = $this->assemble_scroll_array($queryType, $tmp_mentions_array[$i]);

                                self::$oScroll->roll_into_scroll(self::$message_to_scroll_ARRAY);

                                array_splice(self::$message_to_scroll_ARRAY, 0);


                            }

                        }


                    break;
                    case 'create_child_kivotos':
                    case 'create_kivotos':

                        /*
                         *
                        $oUser->save_Form_Data('MENTION_ARRAY', $oInputTransformer->return_mention_id());
                        $oUser->save_Form_Data('KIVOTOS_ID', $tmp_kivotosid);

                        PARENT_KIVOTOS_ID

                        self::$http_param_handle["CLIENT_ID"] = self::$oUserEnvironment->paramTunnelDecrypt(self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'cid'));
                        self::$http_param_handle["NAME"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'kivotosname');
                        self::$http_param_handle["DESCRIPTION"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'description');
                        self::$http_param_handle["ASSIGN_USERID"] = self::$oUserEnvironment->paramTunnelDecrypt(self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'user_assign'));
                        self::$http_param_handle["ISPRIVATE"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'isprivate');
                        self::$http_param_handle["STREAM_MENTIONS_EID"]
                         * */

                        //
                        // WE HAVE MENTIONS TO PROCESS FOR NOTIFICATIONS
                        for($i=0;$i<$tmp_loop_size;$i++){

                            //
                            // IS USER_MENTION_NOTIFICATION_ON = 1
                            if($this->is_mention_notification_on($tmp_mentions_array[$i])){

                                self::$message_to_scroll_ARRAY = $this->assemble_scroll_array($queryType, $tmp_mentions_array[$i]);

                                self::$oScroll->roll_into_scroll(self::$message_to_scroll_ARRAY);

                                array_splice(self::$message_to_scroll_ARRAY, 0);

                            }

                        }


                    break;
                    case 'save_asset_update':
                    case 'save_asset_content':

                        /*
                         $oUser->save_Form_Data('MENTION_ARRAY', $oInputTransformer->return_mention_id());
                            $oUser->save_Form_Data('KIVOTOS_ID', $oUser->getReqParamByKey("KIVOTOS_ID"));
                            $oUser->save_Form_Data('STREAM_ID', $oUser->getReqParamByKey("STREAM_ID"));
                            $oUser->save_Form_Data('ASSET_ID', $oUser->getReqParamByKey("ASSET_ID"));
                            $oUser->save_Form_Data('CLIENT_ID', $oUser->getReqParamByKey("CLIENT_ID"));
                            $oUser->save_Form_Data('ASSET_TYPE', $oUser->getReqParamByKey("ASSET_TYPE"));
                            $oUser->save_Form_Data('SPECIALTY_TYPE', $oUser->getReqParamByKey("SPECIALTY_TYPE"));
                         * */

                        //
                        // WE HAVE MENTIONS TO PROCESS FOR NOTIFICATIONS
                        for($i=0;$i<$tmp_loop_size;$i++){

                            //
                            // IS USER_MENTION_NOTIFICATION_ON = 1
                            if($this->is_mention_notification_on($tmp_mentions_array[$i])){

                                self::$message_to_scroll_ARRAY = $this->assemble_scroll_array($queryType, $tmp_mentions_array[$i]);

                                self::$oScroll->roll_into_scroll(self::$message_to_scroll_ARRAY);

                                array_splice(self::$message_to_scroll_ARRAY, 0);

                            }

                        }

                    break;
                    default:

                        //
                        // HOOOSTON...VE HAF PROBLEM!
                        throw new Exception('Unable to determine queue_mentions_notifications queryType ['.$queryType.'] .');


                    break;

                }


            }


        }catch( Exception $e ) {
            //
            // SEND THIS THROUGH THE LOGGER OBJECT
            self::$oLogger->captureNotice('messenger_from_north->queue_mentions_notifications()', LOG_EMERG, $e->getMessage());

        }

    }

    private function queue_watchers_notifications($queryType){
        try{
            switch($queryType){
                case 'create_stream':

                    switch(self::$oUser->retrieve_Form_Data("STREAM_TYPE")){
                        case 'KIVOTOS':
                            //
                            // QUEUE KIVOTOS WATCHERS NOTICE
                            # MENTIONS - STREAM_TYPE = KIVOTOS
                            /*
                             * STREAM_ID self::$oUser->retrieve_Form_Data("STREAM_ID")
                             * KIVOTOS_ID (queue to watchers of this KIVOTOS_ID)
                             * CLIENT_ID (of kivotos)
                             * USERID_SUBMITTER
                             * */

                        break;
                        case 'ASSET':
                            //
                            // QUEUE ASSET WATCHERS NOTICE
                            # MENTIONS - STREAM_TYPE = ASSETS
                            /*
                             * STREAM_ID self::$oUser->retrieve_Form_Data("STREAM_ID")
                             * CLIENT_ID (of asset)
                             * ASSET_ID (queue to watchers of this ASSET_ID)
                             * USERID_SUBMITTER
                             * */

                        break;
                        case 'USER':
                            //
                            // QUEUE USER WATCHERS NOTICE
                            # MENTIONS - STREAM_TYPE = USER
                            /*
                             * STREAM_ID self::$oUser->retrieve_Form_Data("STREAM_ID")
                             * USERID_SUBMITTER
                             * USERID_DASHBOARD (queue to watchers of this USERID_DASHBOARD)
                             * */

                        break;
                        case 'CLIENT':
                            //
                            // QUEUE CLIENT WATCHERS NOTICE
                            # MENTIONS - STREAM_TYPE = CLIENT
                            /*
                             * STREAM_ID self::$oUser->retrieve_Form_Data("STREAM_ID")
                             * CLIENT_ID (of dashboard)  (queue to watchers of this CLIENT_ID)
                             * USERID_SUBMITTER
                             * */

                        break;
                        default:

                            //
                            // HOOOSTON...VE HAF PROBLEM!
                            throw new Exception('Unable to determine create_stream STREAM_TYPE ['.self::$oUser->retrieve_Form_Data("STREAM_TYPE").'] .');

                        breaK;

                    }

                break;

            }



        }catch( Exception $e ) {
            //
            // SEND THIS THROUGH THE LOGGER OBJECT
            self::$oLogger->captureNotice('messenger_from_north->queue_watchers_notifications()', LOG_EMERG, $e->getMessage());

        }

    }

    public function scroll_messages($queryType){
        try {
            switch($queryType){
                case 'create_stream':

                    $this->queue_mentions_notifications($queryType);
                    $this->queue_watchers_notifications($queryType);

                    // NOTIFICATION TYPES WILL SHARE CONTENT REGIONS. ZONE THIS UP TO DO AS LITTLE OOP WORK AS POSSIBLE.
                    // NOTIFICATIONS TO CONSIDER FOR create_stream ::
                    // [MENTIONS-ASSET,
                    // MENTIONS-KIVOTOS,
                    // NEW STREAM OWNER OF ASSET/KIVOTOS (DEFAULT WATCHER #1. SUBJECT LINE OWNER REFERENCE),
                    // NEW STREAM WATCHER OF ASSET/KIVOTOS,
                    // NEW STREAM ON USER DASHBOARD PAGE,
                    // NEW STREAM ON CLIENT DASHBOARD PAGE]


                    # ASSETS OWNER (NEW STREAM) - STREAM_TYPE = ASSETS
                    /*
                     * STREAM_ID self::$oUser->retrieve_Form_Data("STREAM_ID")
                     * CLIENT_ID (of asset)
                     * ASSET_ID
                     * USERID_SUBMITTER
                     * */

                    # KIVOTOS OWNER (NEW STREAM) - STREAM_TYPE = KIVOTOS
                    /*
                     * STREAM_ID self::$oUser->retrieve_Form_Data("STREAM_ID")
                     * KIVOTOS_ID
                     * CLIENT_ID (of kivotos)
                     * USERID_SUBMITTER
                     * */

                    # USER OWNER (NEW STREAM) - STREAM_TYPE = USER
                    /*
                     * STREAM_ID self::$oUser->retrieve_Form_Data("STREAM_ID")
                     * USERID_DASHBOARD
                     * USERID_SUBMITTER
                     * */

                    # ASSETS WATCHERS (NEW STREAM) - STREAM_TYPE = ASSETS
                    /*
                     * STREAM_ID self::$oUser->retrieve_Form_Data("STREAM_ID")
                     * CLIENT_ID
                     * ASSET_ID  (notice to watchers of this ASSET_ID)
                     * USERID_SUBMITTER
                     * */

                    # KIVOTOS WATCHERS (NEW STREAM) - STREAM_TYPE = KIVOTOS
                    /*
                     * STREAM_ID self::$oUser->retrieve_Form_Data("STREAM_ID")
                     * KIVOTOS_ID  (notice to watchers of this KIVOTOS_ID)
                     * CLIENT_ID
                     * USERID_SUBMITTER
                     * */

                    # USER WATCHERS (NEW STREAM) - STREAM_TYPE = USER
                    /*
                     * STREAM_ID self::$oUser->retrieve_Form_Data("STREAM_ID")
                     * USERID_DASHBOARD (notice to watchers of this USERID)
                     * USERID_SUBMITTER
                     * */

                    # CLIENT WATCHERS (NEW STREAM) - STREAM_TYPE = CLIENT
                    /*
                     * STREAM_ID self::$oUser->retrieve_Form_Data("STREAM_ID")
                     * CLIENTID_DASHBOARD (notice to watchers of this CLIENTID)
                     * USERID_SUBMITTER
                     * */

                    //
                    // FLOW
                    # 1 - DO WE HAVE MENTIONS TO SEE ABOUT NOTICE SENDING?
                    # 2 - DO WE HAVE MATCHING USERS WITH MENTION NOTICE ON?
                    # 3 - BUILD NOTICE MESSAGE AND APPEND SQL FOR EACH USER.
                    # 4 - DO WE HAVE OWNER WITH WATCHING ON AND NOT MENTIONED?
                    # 5 - BUILD NOTICE MESSAGE AND APPEND SQL FOR OWNER.
                    # 6 - DO WE HAVE NON-OWNER WATCHERS?
                    # 7 - BUILD NOTICE MESSAGE AND APPEND SQL FOR EACH WATCHER.



                    /*
                     * self::$http_param_handle["CLIENT_ID"] = self::$oUserEnvironment->paramTunnelDecrypt(self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'cid'));
                    self::$http_param_handle["STREAM_TYPE"] = self::$oUserEnvironment->paramTunnelDecrypt(self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'stk'));
                    self::$http_param_handle["KIVOTOS_ID"] = self::$oUserEnvironment->paramTunnelDecrypt(self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'kid'));
                    self::$http_param_handle["ASSET_ID"] = self::$oUserEnvironment->paramTunnelDecrypt(self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'aid'));
                    self::$http_param_handle["STREAM_CONTENT"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'stream');
                    self::$http_param_handle["STREAM_MENTIONS_EID"]*/

                    // MENTIONS/NEW STREAM [KIVOTOS/ASSETS] - MESSAGE CONTENT AREAS
                    # HEADER
                    # FORMATTED STREAM + META
                    # ASSET OR KIVOTOS DETAILS
                    # ASSET OR KIVOTOS RECENT ACTIVITY
                    # FOOTER

                    // MENTIONS/NEW STREAM [CLIENT/USER] - MESSAGE CONTENT AREAS
                    # HEADER
                    # FORMATTED STREAM + META
                    # USER(STREAM-SUBMITTER) DETAILS
                    # USER(STREAM-SUBMITTER) RECENT ACTIVITY
                    # FOOTER

                    //
                    // NECESSARY SUPPORT DATA
                    # USER EMAIL PREFERENCES
                    #// USER_MENTION_NOTIFICATION_ON
                    #// CLIENT_MENTION_NOTIFICATION_ON  * SHOW CLIENT USERS TO RECEIVE/SUPPRESS NOTICE?
                    #// WATCH_NOTIFICATION_ON (GIVE GRANULAR CONTROL OF ALL WATCHING ITEMS AS WELL AS GLOBAL)


                    # MESSAGE DELIVERY NEEDS ::
                    # self::$query .= 'INSERT INTO `sys_msg_queue` (`MSG_SOURCEID`,`MSG_SOURCEID_CRC32`,`MSG_KEYID`,`MSG_KEYID_CRC32`,`REQUESTID`,`PWD_RESET`,`EMAIL`,`RECIPIENTNAME`,`DATEMODIFIED`) VALUES ("'.$tmp_msgsourceid.'","'.crc32($tmp_msgsourceid).'","PASSWORD_RESET","'.crc32('PASSWORD_RESET').'","'.$tmp_requestid.'","1","'.self::$mysqli->real_escape_string(strtolower($oUser->retrieve_Form_Data('EMAIL'))).'","'.self::$mysqli->real_escape_string(self::$result_ARRAY[0][1]).'","'.$ts.'");';
                    # MSG_SOURCEID,MSG_KEYID,REQUESTID,EMAIL,RECIPIENTNAME,SUBJECT_LINE,BODY_HTML,BODY_TEXT,DATEMODIFIED

                    # WE HAVE CONTENT REGIONS TO PRELOAD, ASSEMBLE AND DELIVER TO SQL QUEUE. STORE THE WHOLE MESSAGE.

                    //
                    // RETRIEVE MESSAGE HTML/TEXT TEMPLATE(S) FROM evifweb_stage.sys_messages FOR POTENTIAL MESSAGE TYPES

                    //
                    // WE SHOULD ALREADY HAVE ALL APPROPRIATE USERS...BUT ANYONE CAN BE A WATCHER. WE
                    // NEED TO UPDATE SOURCE SQL TO INCLUDE ADD'L/ACCOMPANYING NOTIFICATION
                    // PREFERENCES...INCLUDING WATCHERS

                    /*
                     * sys_watches
                     * things to watch = [ASSETS, KIVOTOS, STREAM, CLIENT X DASHBOARD PAGE, USER X DASHBOARD PAGE]
                     * WATCH_ID (70)
                     * WATCH_ID_CRC32
                     * ISACTIVE
                     * CLIENT_ID (50)
                     * CLIENT_ID_CRC32
                     * USER_ID (50)
                     * USER_ID_CRC32
                     * W_ASSET_ID (70)
                     * W_ASSET_ID_CRC32
                     * W_KIVOTOS_ID (70)
                     * W_KIVOTOS_ID_CRC32
                     * W_STREAM_ID (100)
                     * W_STREAM_ID_CRC32
                     * W_CLIENT_ID (50)
                     * W_CLIENT_ID_CRC32
                     * W_USER_ID (50)
                     * W_USER_ID_CRC32
                     * DATECREATED
                     *
                     * log_sys_watches
                     * ID auto increment
                     * WATCH_ID (70)
                     * WATCH_ID_CRC32
                     * CLIENT_ID (50)
                     * CLIENT_ID_CRC32
                     * USER_ID (50)
                     * USER_ID_CRC32
                     * W_ASSET_ID (70)
                     * W_ASSET_ID_CRC32
                     * W_KIVOTOS_ID (70)
                     * W_KIVOTOS_ID_CRC32
                     * W_STREAM_ID (100)
                     * W_STREAM_ID_CRC32
                     * W_CLIENT_ID (50)
                     * W_CLIENT_ID_CRC32
                     * W_USER_ID (50)
                     * W_USER_ID_CRC32
                     * DATECREATED
                     * */




                break;
                case 'create_kivotos':
                    //
                    // NOTIFICATIONS TO CONSIDER [MENTIONS]

                    /*self::$http_param_handle["CLIENT_ID"] = self::$oUserEnvironment->paramTunnelDecrypt(self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'cid'));
		self::$http_param_handle["NAME"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'kivotosname');
		self::$http_param_handle["DESCRIPTION"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'description');
		self::$http_param_handle["ASSIGN_USERID"] = self::$oUserEnvironment->paramTunnelDecrypt(self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'user_assign'));
		self::$http_param_handle["ISPRIVATE"] = self::$oUserEnvironment->oHTTP_MGR->extractData($_POST, 'isprivate');
        self::$http_param_handle["STREAM_MENTIONS_EID"]
                     * */

                    $this->queue_mentions_notifications($queryType);



                    break;
                case 'save_asset_content':
                    //
                    // NOTIFICATIONS TO CONSIDER [MENTIONS, KIVOTOS WATCH ASSET UPLOAD]
                    $this->queue_mentions_notifications($queryType);
                    $this->queue_watchers_notifications($queryType);

                break;
                case 'save_asset_update':
                    //
                    // NOTIFICATIONS TO CONSIDER [MENTIONS, KIVOTOS WATCH ASSET UPLOAD]
                    $this->queue_mentions_notifications($queryType);
                    $this->queue_watchers_notifications($queryType);

                break;
                case 'create_child_kivotos':
                    //
                    // NOTIFICATIONS TO CONSIDER [MENTIONS, KIVOTOS WATCH CHILD CREATE]
                    $this->queue_mentions_notifications($queryType);
                    $this->queue_watchers_notifications($queryType);

                break;
                case 'create_stream_reply':
                    //
                    // NOTIFICATIONS TO CONSIDER [MENTIONS, STREAM WATCHERS]
                    $this->queue_mentions_notifications($queryType);
                    $this->queue_watchers_notifications($queryType);

                break;
                default:
                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('Unable to determine message assembly type.');

                break;
            }

        }catch( Exception $e ) {
            //
            // SEND THIS THROUGH THE LOGGER OBJECT
            self::$oLogger->captureNotice('messenger_from_north->scroll_messages()', LOG_EMERG, $e->getMessage());

        }

    }

    public function deliver_scroll(){
        try{

            //
            // INVOKE DATABASE_MANAGER QUEUE WRITE METHOD - SHOULD RECEIVE/PROCESS oSCROLL OBJECT
            if(self::$oScroll->contains_message){

                $tmp_injest_resp = self::$oData->injest_scroll(self::$oScroll, self::$oEnv);

                if($tmp_injest_resp == 'success'){
                    //
                    // SUCCESS
                    self::$oScroll->clear_messages();

                }else{

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('System scroll injestion error :: '.$tmp_injest_resp);
                }
            }


        }catch( Exception $e ) {
            //
            // SEND THIS THROUGH THE LOGGER OBJECT
            self::$oLogger->captureNotice('messenger_from_north->deliver_scroll()', LOG_EMERG, $e->getMessage());

            return false;
        }



    }

    public function __destruct() {

    }

}