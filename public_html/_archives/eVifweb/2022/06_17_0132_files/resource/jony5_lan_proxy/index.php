<?php
/* 
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
include_once($CRNRSTN_ROOT.'_crnrstn.config.inc.php');
#require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/security/secure.inc.php');
#require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/session/session.inc.php');

#require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/language/lang.inc.php');

//
// LANGUAGE SUPPORT
#$tmp_lang_elem = 'SITE_TITLE|SITE_TITLE_STYLED|SITE_FOOTER_RIGHTS|SITE_TITLE_WEB_DEV|SITE_TITLE_DIGIT_MARKET|SITE_TITLE_AND|TEXT_CLICK_HERE|PROXY_REDIRECT_HELP';
#$oUSER->prepLangElem($tmp_lang_elem);

//
// LOAD DEVICE DETECT AFTER LANGUAGE PACK PREPPED FOR POPULATION OF COMBO COPY WITH LANG DATA
#require($oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT').$oCRNRSTN_ENV->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/device/detect.inc.php');

//
// RETRIEVE RESPONSE OBJECT
#$tmp_serial_handle = 'PROXY';
#$oDB_RESP = $oUSER->getProxyData($tmp_serial_handle);

# I WANT THIS PAGE TO BE AS LIGHT AS POSSIBLE...CLIENT-SIDE. NO DOWNLOADS OF SUPPORT FILES (ALTHOUGH, THEY
# WOULD BE CACHED BY BROWSER ANYWAYS....) SO PROBABLY NO JS/CSS INCLUDES. WE WILL PUT EVERYTHING HERE.

if($oCRNRSTN_ENV->oHTTP_MGR->issetHTTP($_GET)) {

    $tmp_auth = $oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, 'auth_key');
    $tmp_msg = $oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, 'msg');
    $tmp_msgtype = $oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, 'type');


    #http://evifweb.com/resource/jony5_lan_proxy/?auth_key=gY96sb21!&type=SMS&msg=Hello%20World

    $tmp_msg = nl2br(rawurldecode($tmp_msg));

    $tmp_subj = $oCRNRSTN_ENV->oHTTP_MGR->extractData($_GET, 'subj');

    if($tmp_auth=="gY96sb21!"){
        if($tmp_subj==""){
            $tmp_subj = "JONY5 2276 LAN Status Notification";

        }

        if($tmp_msgtype=="SMS"){

            $oUSER->triggerSMS($tmp_msg, $tmp_subj);
        }else{

            $oUSER->triggerEmail($tmp_msg, $tmp_subj);
        }


    }


    echo "HTTP_SUCCESS";


}else{


    echo "HTTP_NO_GET";


}



