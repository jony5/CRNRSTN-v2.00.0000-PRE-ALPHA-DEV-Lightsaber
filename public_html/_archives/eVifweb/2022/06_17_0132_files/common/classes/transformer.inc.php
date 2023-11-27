<?php
/*
// J5
// Code is Poetry */

class transformer {

    private static $oLogger;
    private static $oData;
    private static $oEnv;
    private static $oUser;
    private static $transform_output_ARRAY = array();

    private static $queue_mention_ARRAY = array();
    private static $queue_id_ARRAY = array();       // USER, CLIENT
    private static $mentions_SQL_prep_ARRAY = array();
    public $formatted_content;

    public function __construct($oENV, $oDB, $oUSER)
    {
        try{
            //
            // INSTANTIATE LOGGER
            self::$oLogger = new crnrstn_logging();

            self::$oData = $oDB;
            self::$oEnv = $oENV;
            self::$oUser = $oUSER;


        }catch( Exception $e ) {
            //
            // SEND THIS THROUGH THE LOGGER OBJECT
            self::$oLogger->captureNotice('transformer->__construct()', LOG_EMERG, $e->getMessage());
        }

    }

    //
    // ANY CONTENT FROM ANYTHING. I DO NOT CARE ABOUT SOURCE. BUT WILL KEY FOR BEHAVIOR DISTINCTIONS
    public function returnTransformedInput($key, $content){

        self::$transform_output_ARRAY['STYLED_CONTENT'] = nl2br($content);
        self::$transform_output_ARRAY['QUERY'] = "";

        try{
            switch($key){
                case 'LINKS':

                    //
                    // WE PROCESS FOR 3 SITUATIONS. [EVIF LINKS, EXTERNAL LINKS(PROXY US PLZ), @MENTION]
                    // * WHERE RETURN array() = {'QUERY'=>'INSERT...', 'STYLED_CONTENT'=>'QWERTY1234567890'}
                    // * REMEMBER...HANDLE LINKS, EXTERNAL LINKS (NEED TO BE PROXIED), AND @MENTION LINKING TO PROFILES. DO WE
                    // WANT @CLIENT MENTIONS(INCLUDING eVif)? WITH "GLOBAL" NOTIFICATIONS?

                    $this->transform_links();            // MAY MAKE SENSE TO DO ALL LINKS HERE. PROXY AND STANDARD eVif
                    #self::$transform_output_ARRAY = $this->transform_mentions(self::$transform_output_ARRAY);

                break;
                default:



                break;

            }




            return self::$transform_output_ARRAY;

        }catch( Exception $e ) {

            //
            // SEND THIS THROUGH THE LOGGER OBJECT
            self::$oLogger->captureNotice('transformer->returnTransformedInput()', LOG_EMERG, $e->getMessage());
        }

    }

    private function transform_links(){

        #error_log("transformer (81) transform_links ready to transform links in [".self::$transform_output_ARRAY['STYLED_CONTENT']."]");

        //
        // NOW TO LOOK INTO CONNECTING THIS TO A LINK PROXY ARCHITECTURE...WE ALSO NEED MOBILE DETECTION TO ADD data-ajax="false" for jquery mobile platform

        $protocols = array('http', 'mail', 'https');
        $attributes = array('target' => '_blank');
        $showimg = 1;

        self::$transform_output_ARRAY['STYLED_CONTENT'] = $this->linkify( $showimg, self::$transform_output_ARRAY['STYLED_CONTENT'], $protocols, $attributes);

    }

    public function queueMentionForTransform($mention, $user_id){

        self::$queue_mention_ARRAY[] = $mention;
        self::$queue_id_ARRAY[] = $user_id;

    }

    public function return_mention_id(){

        return self::$queue_id_ARRAY;
    }

    public function build_mentions_SQL($content){

        $tmp_sql_prep_ARRAY = self::$oData->prepare_mentions_sql(self::$oUser, self::$mentions_SQL_prep_ARRAY, $content);
        self::$transform_output_ARRAY['QUERY'] .= $tmp_sql_prep_ARRAY[1];


        return self::$transform_output_ARRAY;

    }

    public function transform_mentions($str){

        $tmp_hyperlink_mention_ARRAY = array();

        $tmp_loop_size = sizeof(self::$queue_mention_ARRAY);
        for($i=0;$i<$tmp_loop_size;$i++){
            error_log("transformer (116) mention[".self::$queue_mention_ARRAY[$i]."] userid[".self::$queue_id_ARRAY[$i]."]");
            error_log("transformer (117) str[".$str."]");

            //
            // NEEDS TO BE LINKED THROUGH CRNRSTN ::
            $tmp_hyperlink_mention_ARRAY[] = '<a href="'.self::$oEnv->getEnvParam('ROOT_PATH_CLIENT_HTTP').self::$oEnv->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'account/dashboard/?uid='.self::$queue_id_ARRAY[$i].'" target="_self" data-ajax="false">'.self::$queue_mention_ARRAY[$i].'</a>';

            self::$mentions_SQL_prep_ARRAY[] = self::$queue_id_ARRAY[$i];
        }

        //
        // USER PROFILE PAGE (@MENTION LINK) SHOULD BE SOMETHING LIKE THIS...ALWAYS THE SAME FOR EVERY USER::
        # http://evifweb.com/account/profile/?uid=USER_ID

        //
        // CLIENT PROFILE PAGE (@MENTION LINK) SHOULD BE SOMETHING LIKE THIS ::
        # http://evifweb.com/client/home/?cid=USER_ID

        #$str = preg_replace($patterns, $replacements, $str);
        #$str = str_replace(self::$queue_mention_ARRAY, $tmp_hyperlink_mention_ARRAY, $str);
        $str = str_ireplace(self::$queue_mention_ARRAY, $tmp_hyperlink_mention_ARRAY, $str);
        #error_log("transformer (140) str[".$str."]");
        return $str;
    }

    public function transform_mentions_internal($str){

        $tmp_hyperlink_mention_ARRAY = array();

        $tmp_loop_size = sizeof(self::$queue_mention_ARRAY);
        for($i=0;$i<$tmp_loop_size;$i++){
            error_log("transformer (116) mention[".self::$queue_mention_ARRAY[$i]."] userid[".self::$queue_id_ARRAY[$i]."]");
            error_log("transformer (117) str[".$str."]");

            //
            // NEEDS TO BE LINKED THROUGH CRNRSTN ::
            $tmp_hyperlink_mention_ARRAY[] = '<a href="'.self::$oEnv->getEnvParam('ROOT_PATH_CLIENT_HTTP').self::$oEnv->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR').'account/dashboard/?uid='.self::$queue_id_ARRAY[$i].'" target="_self" data-ajax="false">'.self::$queue_mention_ARRAY[$i].'</a>';

            self::$mentions_SQL_prep_ARRAY[] = self::$queue_id_ARRAY[$i];
        }

        //
        // USER PROFILE PAGE (@MENTION LINK) SHOULD BE SOMETHING LIKE THIS...ALWAYS THE SAME FOR EVERY USER::
        # http://evifweb.com/account/profile/?uid=USER_ID

        //
        // CLIENT PROFILE PAGE (@MENTION LINK) SHOULD BE SOMETHING LIKE THIS ::
        # http://evifweb.com/client/home/?cid=USER_ID

        #$str = preg_replace($patterns, $replacements, $str);
        #$str = str_replace(self::$queue_mention_ARRAY, $tmp_hyperlink_mention_ARRAY, $str);
        $str = str_ireplace(self::$queue_mention_ARRAY, $tmp_hyperlink_mention_ARRAY, $str);
        #error_log("transformer (140) str[".$str."]");
        $this->formatted_content = $str;
    }



    private function formatUri($uri){

        $link_is_external = true;

        if($link_is_external){

            //
            // BEHAVIOR IS TO PROXY
            $this->establishProxy($uri);

        }else{

            //
            // JUST HYPERLINK LINK


        }
    }

    private function establishProxy($uri){

        //
        // self::$transform_output_ARRAY = {'QUERY'=>'INSERT...', 'STYLED_CONTENT'=>'QWERTY1234567890'}
        // I AM RECONSIDERING PUTTING SQL IN THIS FILE. WOULD BE NICE TO KEEP IT ALL WITHIN DATABASE CLASS
        // YES...BUILD THE SQL HERE AND RETURN. IT WILL SIMPLIFY THE DB CLASS.
        error_log('transformer (151) the system may need a tag to prevent the HTML-ing of a link. Is there a use case?');
        error_log('transformer (152) consider this. youtube links can be embedded(why just hyperlink)..as can vimeo...etc. ');

        #self::$transform_output_ARRAY['QUERY'] = '';

        //
        // YOUTUBE EMBED FORMAT
        #<iframe width="560" height="315" src="https://www.youtube.com/embed/9hMhj-zxeSk" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>

        //
        // EVIFWEB PROXY ENDPOINT SHOULD BE SOMETHING LIKE THIS ::
        # http://evifweb.com/resource/proxy/?pid=xxxxxxx

        // sys_uri_proxy
        # PROXY_ID  char(100)
        # PROXY_ID_CRC32    bigint(11) unsigned
        # URI   varchar(1000)
        # USER_ID  char(50)
        # CLIENT_ID  char(50)
        # DATECREATED

        // sys_uri_proxy_log
        # LOG_ID int(11) autoincr
        # PROXY_ID  char(100)
        # USER_ID  char(50)
        # CLIENT_ID  char(50)
        # CHANNEL char (1)
        # IPADDRESS varchar(50)   // TECHNICALLY, IP CAN BE STORED WITHIN INT OR SOMETHING...THIS IS OK FOR LOGGING.
        # PHPSESSION char(26)
        # HTTP_USER_AGENT varchar(500)
        # DATECREATED

        error_log("transformer (171) BUILD OUT SQL HERE FOR PROXY.");

        // THANKS FOR WATCHING! TIME TO CHANGE THINGS UP. I GOT TO GO. CHEERS!

    }

    //
    // SOURCE :: https://gist.github.com/breakermind forked from https://gist.github.com/jasny/2000705
    private function linkify($showimg = 1, $value, $protocols = array('http', 'mail', 'https'), array $attributes = array('target' => '_blank')){
        // Link attributes
        $attr = '';
        foreach ($attributes as $key => $val) {
            $attr = ' ' . $key . '="' . htmlentities($val) . '"';
        }

        $links = array();

        // Extract existing links and tags
        $value = preg_replace_callback('~(<a .*?>.*?</a>|<.*?>)~i', function ($match) use (&$links) { return '<' . array_push($links, $match[1]) . '>'; }, $value);

        // Extract text links for each protocol
        foreach ((array)$protocols as $protocol) {
            switch ($protocol) {
                case 'http':
                case 'https':   $value = preg_replace_callback('~(?:(https?)://([^\s<]+)|(www\.[^\s<]+?\.[^\s<]+))(?<![\.,:])~i',
                    function ($match) use ($protocol, &$links, $attr, $showimg) {
                        if ($match[1]){
                            $protocol = $match[1]; $link = $match[2] ?: $match[3];
                            // Youtube
                            if($showimg == 1){
                                if(strpos($link, 'youtube.com')>0 || strpos($link, 'youtu.be')>0){
                                    $link = '<iframe width="100%" height="315" src="https://www.youtube.com/embed/'.end(explode('=', $link)).'?rel=0&showinfo=0&color=orange&iv_load_policy=3" frameborder="0" allowfullscreen></iframe>';
                                    return '<' . array_push($links, $link) . '></a>';
                                }
                                if(strpos($link, '.png')>0 || strpos($link, '.jpg')>0 || strpos($link, '.jpeg')>0 || strpos($link, '.gif')>0 || strpos($link, '.bmp')>0){
                                    return '<' . array_push($links, "<a $attr href=\"$protocol://$link\" class=\"htmllink\"><img src=\"$protocol://$link\" class=\"htmlimg\">") . '></a>';
                                }
                            }

                            //
                            // PROXY CHECK HERE. DO WE HAVE EXTERNAL LINK? IF SO, PROXY IT. self::$transform_output_ARRAY['QUERY'/'STYLED_CONTENT']
                            if(strpos($link, 'evifweb.com')>0){

                                if(self::$oEnv->oSESSION_MGR->getSessionParam("DEVICETYPE")=="m"){
                                    return '<' . array_push($links, "<a $attr href=\"$protocol://$link\" class=\"htmllink\" data-ajax=\"false\">$link</a>") . '>';
                                }else {
                                    return '<' . array_push($links, "<a $attr href=\"$protocol://$link\" class=\"htmllink\">$link</a>") . '>';
                                }

                            }else{

                                //
                                // LINK NEEDS TO BE PROXIED
                                # $tmp_output_ARRAY[0]=PROTOCOL $tmp_output_ARRAY[1]=LINK
                                $tmp_output_ARRAY = $this->buildProxy($protocol,$link);

                                if(self::$oEnv->oSESSION_MGR->getSessionParam("DEVICETYPE")=="m"){
                                    return '<' . array_push($links, "<a $attr href=\"$tmp_output_ARRAY[0]://$tmp_output_ARRAY[1]\" class=\"htmllink\" data-ajax=\"false\">$link</a>") . '>';
                                }else {
                                    return '<' . array_push($links, "<a $attr href=\"$tmp_output_ARRAY[0]://$tmp_output_ARRAY[1]\" class=\"htmllink\">$link</a>") . '>';
                                }


                            }

                        }
                    }, $value); break;
                case 'mail':    $value = preg_replace_callback('~([^\s<]+?@[^\s<]+?\.[^\s<]+)(?<![\.,:])~', function ($match) use (&$links, $attr) { return '<' . array_push($links, "<a $attr href=\"mailto:{$match[1]}\" class=\"htmllink\">{$match[1]}</a>") . '>'; }, $value); break;
                case 'twitter': $value = preg_replace_callback('~(?<!\w)[@#](\w++)~', function ($match) use (&$links, $attr) { return '<' . array_push($links, "<a $attr href=\"https://twitter.com/" . ($match[0][0] == '@' ? '' : 'search/%23') . $match[1]  . "\" class=\"htmllink\">{$match[0]}</a>") . '>'; }, $value); break;
                default:        $value = preg_replace_callback('~' . preg_quote($protocol, '~') . '://([^\s<]+?)(?<![\.,:])~i', function ($match) use ($protocol, &$links, $attr) { return '<' . array_push($links, "<a $attr href=\"$protocol://{$match[1]}\" class=\"htmllink\">{$match[1]}</a>") . '>'; }, $value); break;
            }
        }

        // Insert all link
        return preg_replace_callback('/<(\d+)>/', function ($match) use (&$links) { return $links[$match[1] - 1]; }, $value);
    }

    private function buildProxy($protocol,$link){

        $tmp_output_ARRAY = array();
        #self::$transform_output_ARRAY['QUERY'/'STYLED_CONTENT']
        if(self::$oEnv->getEnvParam('FORCE_SSL')){
            $tmp_output_ARRAY[0] = "https";

        }else{
            $tmp_output_ARRAY[0] = "http";

        }

        //
        // WE CAN STILL KEEP ALL SQL WITHIN THE DATABASE CLASS OBJECT
        # $tmp_sql_prep_ARRAY[0]=$new_proxy_link, $tmp_sql_prep_ARRAY[1]=SQL
        $tmp_sql_prep_ARRAY = self::$oData->prepare_proxy_sql($protocol, $link, self::$oUser);

        $tmp_output_ARRAY[1] = $tmp_sql_prep_ARRAY[0];
        self::$transform_output_ARRAY['QUERY'] .= $tmp_sql_prep_ARRAY[1];

        return $tmp_output_ARRAY;

    }

    public function __destruct() {

    }

}