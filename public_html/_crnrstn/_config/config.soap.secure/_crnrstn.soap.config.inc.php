<?php
//
// INITIALIZE RESOURCE AUTHORIZATION PROFILE FOR CRNRSTN :: SOAP SERVICES LAYER

$CRNRSTN_NUSOAP_SVC_debugMode = false;
$oSOAP_access_manager = new crnrstn_soap_services_access_manager('BLUEHOST_JONY5', $CRNRSTN_NUSOAP_SVC_debugMode, $this);
$oSOAP_access_manager->init_soap_encryption_config('BLUEHOST_JONY5', 'AES-192-OFB', 'u34#rejciuHdl;a#2hf8(7^2h@mf|}wnBskt7yHdn3&*@$j1wXz5', 'sha256', OPENSSL_RAW_DATA);

$oSOAP_access_manager = new crnrstn_soap_services_access_manager('BLUEHOST_GITHUB', $CRNRSTN_NUSOAP_SVC_debugMode, $this);
$oSOAP_access_manager->init_soap_encryption_config('BLUEHOST_GITHUB', 'AES-192-OFB', 'u34#rejciuHdl;a#2dwqdwqdhf8(7^2h@mf|}wnBskt7yHdn3&*@$j1wXz5', 'sha256', OPENSSL_RAW_DATA);

$oSOAP_access_manager = new crnrstn_soap_services_access_manager('LOCALHOST_MACBOOKTERMINAL', $CRNRSTN_NUSOAP_SVC_debugMode, $this);
$oSOAP_access_manager->init_soap_encryption_config('LOCALHOST_MACBOOKTERMINAL', 'AES-256-CTR', 'uerrueworuu@re2wruruewuureuwuroruurw5uowerurworuwo', 'ripemd256', OPENSSL_RAW_DATA);

$oSOAP_access_manager = new crnrstn_soap_services_access_manager('LOCALHOST_MACBOOKPRO', $CRNRSTN_NUSOAP_SVC_debugMode, $this);
$oSOAP_access_manager->init_soap_encryption_config('LOCALHOST_MACBOOKPRO', 'AES-256-CTR', 'uerrueworuu@re2wruruewuureuwuroruurw5uowerurworuwo', 'ripemd256', OPENSSL_RAW_DATA);

$oSOAP_access_manager = new crnrstn_soap_services_access_manager('LOCALHOST_CHAD_MACBOOKPRO', $CRNRSTN_NUSOAP_SVC_debugMode, $this);
$oSOAP_access_manager->init_soap_encryption_config('LOCALHOST_CHAD_MACBOOKPRO', 'AES-256-CTR', 'uerrueworuu@re2wruruewuureuwuroruurw5uowerurworuwo', 'ripemd256', OPENSSL_RAW_DATA);

//case 'LOCALHOST_MACBOOKPRO':
//
// CREATE AND CONFIGURE SINGLE/GROUP ACCESS AUTHORIZATION KEY(S)
$oAuth_single = $oSOAP_access_manager->generate_SOAPAuthKey('BLUEHOST_JONY5', '12345678987ftygyugyugg676t@5');
$oAuth_single->update_permissions(CRNRSTN_RESOURCE_OPENSOURCE);
//$oAuth_single->IP_exclusiveAccess($_SERVER['SERVER_ADDR']);
//$oAuth_single->IP_exclusiveAccess('111.111.110.*');
//$oAuth_single->IP_denyAccess('111.111.111.112');
$oAuth_single->override_soap_encryption_config('AES-256-CTR', 'this-Is-the_soap-3ncrypti0n-key-for_an_outsider', 'ripemd256', OPENSSL_RAW_DATA);

$oAuth_single = $oSOAP_access_manager->generate_SOAPAuthKey('BLUEHOST_EVIFWEB', '12345678987ftygyugyugg676t@5');
$oAuth_single->update_permissions(CRNRSTN_RESOURCE_OPENSOURCE);
//$oAuth_single->IP_exclusiveAccess($_SERVER['SERVER_ADDR']);
//$oAuth_single->IP_exclusiveAccess('111.111.110.*');
//$oAuth_single->IP_denyAccess('111.111.111.112');
$oAuth_single->override_soap_encryption_config('AES-256-CTR', 'this-Is-thedwqdw_soap-3ncrypti0n-key-for_an_outsider', 'ripemd256', OPENSSL_RAW_DATA);

$oAuth_single = $oSOAP_access_manager->generate_SOAPAuthKey('LOCALHOST_MACBOOKPRO', '9898e80wq8e008f8s8f80f8s0f');
$oAuth_single->update_permissions(CRNRSTN_RESOURCE_OPENSOURCE);
$oAuth_single->update_permissions(CRNRSTN_LOG_EMAIL);

$oAuth_single = $oSOAP_access_manager->generate_SOAPAuthKey('LOCALHOST_CHAD_MACBOOKPRO', '9898e80wq8e008f8s8f80f8s0f');
$oAuth_single->update_permissions(CRNRSTN_RESOURCE_OPENSOURCE);
$oAuth_single->update_permissions(CRNRSTN_LOG_EMAIL);

//
//$oAuth_group = $oSOAP_access_manager->generate_SOAPAuthKeyInGroup('LOCALHOST_MACBOOKTERMINAL', ';0TN:nrtjkljl4334k4;2kl;k;k4j3o4ouotjkljlwuO~u}DI2FKP');
//$oAuth_group = $oSOAP_access_manager->generate_SOAPAuthKeyInGroup('LOCALHOST_MACBOOKTERMINAL', ';1TN:nn8Q{U0jkjkljjjrj<aJNBza?!#btjkljlLQf{wc$1k$;cs=fFO~u}DI2FKP', $oAuth_group);
//$oAuth_group = $oSOAP_access_manager->generate_SOAPAuthKeyInGroup('LOCALHOST_MACBOOKTERMINAL', ';TN:nn8Q{U0Pvbduy|D>4}z!2L-<aJNBza?!#bLtjkljlQf{wc$1k$;cs=fFO~u}DI2FKP', $oAuth_group);
//$oAuth_group = $oSOAP_access_manager->generate_SOAPAuthKeyInGroup('LOCALHOST_MACBOOKTERMINAL', ';3TN:nn8Q{eqwqweT34T43U0Ptjkljlvbduy|D>rrewwc$1k$;cs=fTT6FO~u}DI2FKP', $oAuth_group);
//$oAuth_group = $oSOAP_access_manager->generate_SOAPAuthKeyInGroup('LOCALHOST_MACBOOKTERMINAL', ';4TU3U4422jJLJoi9U8u99ji=fFO~utjkljl}DI2FKP', $oAuth_group);
//
//$oAuth_group->update_permissions('FTP|FILE|EMAIL|DEFAULT|ELECTRUM');
////$oAuth_group->IP_exclusiveAccess($_SERVER['SERVER_ADDR']);
//$oAuth_group->IP_exclusiveAccess('111.111.111.*');
////$oAuth_group->IP_denyAccess('172.16.* - 172.16.195.131, 172.16.195.132 - 172.16.*');
////$oAuth_group->override_soap_encryption_config('AES-192-OFB', 'this-Is-the_soap-3ncrypti0n-key-for_an_outsider', 'sha256', OPENSSL_RAW_DATA);
//$oAuth_group->override_soap_encryption_config('aes256', '0#h6#J1~04!lsgQky0**5^3.?aqhfu4$3kJdG2n@wlWqpf:', 'fnv1a32', OPENSSL_RAW_DATA);

$CRNRSTN_NUSOAP_SVC_debugMode = true;

//
// ADD USER ACCOUNT - LOCALHOST_MACBOOKPRO
$oClient = $oSOAP_access_manager->addClient('LOCALHOST_MACBOOKPRO', '0364087231749672543475966333893875', '83g#k487fg5hY%@i4fs84jfmdld8!~lf;|Qkeiur84', $CRNRSTN_NUSOAP_SVC_debugMode);
$oClient->override_soap_encryption_config('AES-192-OFB', '5jfu8chH#5%BNufn49fn4k3nvn9mmN!)000m32N3jN#', 'sha256', OPENSSL_RAW_DATA);
$oClient->activate_SOAP_method('mayItakeTheKingsHighway|returnCRNRSTN_UI_GLOBAL_SYNC');

//
// ADD USER ACCOUNT - LOCALHOST_MACBOOKPRO
$oClient = $oSOAP_access_manager->addClient('LOCALHOST_MACBOOKPRO', '03856145387465910978456438', '7dj3m9d2m2d99dd2dm', $CRNRSTN_NUSOAP_SVC_debugMode);
//$oClient_044->override_soap_encryption_config('AES-192-OFB', '4$#HDBidjh7&$*tn4njfn3f7&&*(*', 'sha256', OPENSSL_RAW_DATA);
$oClient->activate_SOAP_method('mayItakeTheKingsHighway|returnCRNRSTN_UI_GLOBAL_SYNC');
$oClient->update_permissions(CRNRSTN_RESOURCE_OPENSOURCE);
//$oClient->IP_denyAccess('111.111.111.112');
//$oClient->IP_exclusiveAccess($_SERVER['SERVER_ADDR']);

//
// ADD USER ACCOUNT - LOCALHOST_CHAD_MACBOOKPRO
$oClient = $oSOAP_access_manager->addClient('LOCALHOST_CHAD_MACBOOKPRO', '0364087231749672543475966333893875', '83g#k487fg5hY%@i4fs84jfmdld8!~lf;|Qkeiur84', $CRNRSTN_NUSOAP_SVC_debugMode);
$oClient->override_soap_encryption_config('AES-192-OFB', '5jfu8chH#5%BNufn49fn4k3nvn9mmN!)000m32N3jN#', 'sha256', OPENSSL_RAW_DATA);
$oClient->activate_SOAP_method('mayItakeTheKingsHighway|returnCRNRSTN_UI_GLOBAL_SYNC');

//
// ADD USER ACCOUNT - LOCALHOST_CHAD_MACBOOKPRO
$oClient = $oSOAP_access_manager->addClient('LOCALHOST_CHAD_MACBOOKPRO', '03856145387465910978456438', '7dj3m9d2m2d99dd2dm', $CRNRSTN_NUSOAP_SVC_debugMode);
//$oClient_044->override_soap_encryption_config('AES-192-OFB', '4$#HDBidjh7&$*tn4njfn3f7&&*(*', 'sha256', OPENSSL_RAW_DATA);
$oClient->activate_SOAP_method('mayItakeTheKingsHighway|returnCRNRSTN_UI_GLOBAL_SYNC');
$oClient->update_permissions(CRNRSTN_RESOURCE_OPENSOURCE);
//$oClient->IP_denyAccess('111.111.111.112');
//$oClient->IP_exclusiveAccess($_SERVER['SERVER_ADDR']);

//$oClient_group_007 = $oSOAP_access_manager->addClientToGroup('LOCALHOST_MACBOOKTERMINAL', 'hello_un00737289745665293879240', 'password123bvdffg');
//$oClient_group_007 = $oSOAP_access_manager->addClientToGroup('LOCALHOST_MACBOOKTERMINAL', 'hello_un01737289745665293879240', 'password123frettn', $oClient_group_007);
//$oClient_group_007 = $oSOAP_access_manager->addClientToGroup('LOCALHOST_MACBOOKTERMINAL', '00737289745665293879240', 'password123wr4t4t', $oClient_group_007, $CRNRSTN_NUSOAP_SVC_debugMode);
//$oClient_group_007 = $oSOAP_access_manager->addClientToGroup('LOCALHOST_MACBOOKTERMINAL', 'hello_un03737289745665293879240', 'password123dadggh', $oClient_group_007);
//$oClient_group_007 = $oSOAP_access_manager->addClientToGroup('LOCALHOST_MACBOOKTERMINAL', 'hello_un04737289745665293879240', 'password123wqewed', $oClient_group_007);
//
//$oClient_group_007->update_permissions('EMAIL|FTP|FILE|DEFAULT|ELECTRUM');
//$oClient_group_007->override_soap_encryption_config('AES-192-OFB', 'hi, this-Is-the_soap-encrypti0n-key-for_a_group of _outsiders', 'sha256', OPENSSL_RAW_DATA);
//
//$oClient_group_007->activate_SOAP_method('mayItakeTheKingsHighway');
//$oClient_group_007->activate_SOAP_method('takeTheKingsHighway');
//$oClient_group_007->deactivate_SOAP_method('sendElectrumPerformanceReport');
//$oClient_group_007->IP_exclusiveAccess('111.111.111.111');