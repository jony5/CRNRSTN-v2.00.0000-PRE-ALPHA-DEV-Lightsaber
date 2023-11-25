<?php
//
// INITIALIZE RESOURCE AUTHORIZATION PROFILE FOR CRNRSTN :: SOAP SERVICES LAYER.
$CRNRSTN_NUSOAP_SVC_debugMode = false;
$oSOAP_access_manager = new crnrstn_soap_services_access_manager('BLUEHOST_JONY5', $CRNRSTN_NUSOAP_SVC_debugMode, $this);
$oSOAP_access_manager->init_soap_encryption_config('BLUEHOST_JONY5', 'AES-192-OFB', 'cXAXAq_It g=5?]8iL@sKq&lWD7BW1=f', 'sha256', OPENSSL_RAW_DATA);

$oSOAP_access_manager = new crnrstn_soap_services_access_manager('BLUEHOST_GITHUB', $CRNRSTN_NUSOAP_SVC_debugMode, $this);
$oSOAP_access_manager->init_soap_encryption_config('BLUEHOST_GITHUB', 'AES-192-OFB', ' +-ubkEG=W{uR_X8-q{fq.t0N2+UpKDj', 'sha256', OPENSSL_RAW_DATA);

$oSOAP_access_manager = new crnrstn_soap_services_access_manager('LOCALHOST_MACBOOKTERMINAL', $CRNRSTN_NUSOAP_SVC_debugMode, $this);
$oSOAP_access_manager->init_soap_encryption_config('LOCALHOST_MACBOOKTERMINAL', 'AES-256-CTR', 'EkN9{{WCOS2igN%G{6?@vWCv#c_&Fsic', 'ripemd256', OPENSSL_RAW_DATA);

$oSOAP_access_manager = new crnrstn_soap_services_access_manager('LOCALHOST_PC_XP', $CRNRSTN_NUSOAP_SVC_debugMode, $this);
$oSOAP_access_manager->init_soap_encryption_config('LOCALHOST_PC_XP', 'AES-256-CTR', 'n~]CbiPI&LoLn0_ }C.o~q}IQ%#k6u.(', 'ripemd256', OPENSSL_RAW_DATA);

$oSOAP_access_manager = new crnrstn_soap_services_access_manager('LOCALHOST_CHAD_MACBOOKPRO', $CRNRSTN_NUSOAP_SVC_debugMode, $this);
$oSOAP_access_manager->init_soap_encryption_config('LOCALHOST_CHAD_MACBOOKPRO', 'AES-256-CTR', 'GL2AL)t8g).550i3Rla3ZTncUFX7}:vn', 'ripemd256', OPENSSL_RAW_DATA);

//case 'LOCALHOST_PC':              // TOSHIBA M100 [eVifweb] :: RADIOHEAD.
//
// CREATE AND CONFIGURE SINGLE/GROUP ACCESS AUTHORIZATION KEY(S)
$oAuth_single = $oSOAP_access_manager->generate_SOAPAuthKey('BLUEHOST_JONY5', 'ss~2j{P%DE3.=o)FUqO47&X*GtR~q}Fc');
$oAuth_single->update_permissions(CRNRSTN_RESOURCE_OPENSOURCE);
//$oAuth_single->IP_exclusiveAccess($_SERVER['SERVER_ADDR']);
//$oAuth_single->IP_exclusiveAccess('111.111.110.*');
//$oAuth_single->IP_denyAccess('111.111.111.112');
$oAuth_single->override_soap_encryption_config('AES-256-CTR', ' bcmUxkOT1_z2mrElii4{W4-G]m[JDv$', 'ripemd256', OPENSSL_RAW_DATA);

$oAuth_single = $oSOAP_access_manager->generate_SOAPAuthKey('BLUEHOST_EVIFWEB', 'bU&n@&LLJNM_ 63a@?bD4eMj-ol)H)dP');
$oAuth_single->update_permissions(CRNRSTN_RESOURCE_OPENSOURCE);
//$oAuth_single->IP_exclusiveAccess($_SERVER['SERVER_ADDR']);
//$oAuth_single->IP_exclusiveAccess('111.111.110.*');
//$oAuth_single->IP_denyAccess('111.111.111.112');
$oAuth_single->override_soap_encryption_config('AES-256-CTR', 'sc@4wv(YzlC2HnO6i%.qqro3XVf58e=R', 'ripemd256', OPENSSL_RAW_DATA);

$oAuth_single = $oSOAP_access_manager->generate_SOAPAuthKey('LOCALHOST_PC_XP', 'Ko+-(f@NfgqR@n}[Mde@!Fh5b&O:uCV]');
$oAuth_single->update_permissions(CRNRSTN_RESOURCE_OPENSOURCE);
$oAuth_single->update_permissions(CRNRSTN_LOG_EMAIL);

$oAuth_single = $oSOAP_access_manager->generate_SOAPAuthKey('LOCALHOST_CHAD_MACBOOKPRO', 'B6R5PF#0v7~6QXImy.SB&*mGYvD~RrEx');
$oAuth_single->update_permissions(CRNRSTN_RESOURCE_OPENSOURCE);
$oAuth_single->update_permissions(CRNRSTN_LOG_EMAIL);

//
//$oAuth_group = $oSOAP_access_manager->generate_SOAPAuthKeyInGroup('LOCALHOST_MACBOOKTERMINAL', ';fD_EYt$4Gm$ypA6za~hFA&WTayOnI2k');
//$oAuth_group = $oSOAP_access_manager->generate_SOAPAuthKeyInGroup('LOCALHOST_MACBOOKTERMINAL', ';x_-5yTfwcruW lmXN+}N:LJH{J[TgE?', $oAuth_group);
//$oAuth_group = $oSOAP_access_manager->generate_SOAPAuthKeyInGroup('LOCALHOST_MACBOOKTERMINAL', ';WHbw)@IE+#0EBR}E}kMN@YV{RkoPMU+', $oAuth_group);
//$oAuth_group = $oSOAP_access_manager->generate_SOAPAuthKeyInGroup('LOCALHOST_MACBOOKTERMINAL', ';EB8q0q?~WG$$-}#0:2o7T6Z#+n-_9MP', $oAuth_group);
//$oAuth_group = $oSOAP_access_manager->generate_SOAPAuthKeyInGroup('LOCALHOST_MACBOOKTERMINAL', ';6 mWG+0=z6wSfWzcAO{f=zWIuATiNx6', $oAuth_group);
//
//$oAuth_group->update_permissions('FTP|FILE|EMAIL|DEFAULT|ELECTRUM');
////$oAuth_group->IP_exclusiveAccess($_SERVER['SERVER_ADDR']);
//$oAuth_group->IP_exclusiveAccess('111.111.111.*');
////$oAuth_group->IP_denyAccess('172.16.* - 172.16.195.131, 172.16.195.132 - 172.16.*');
////$oAuth_group->override_soap_encryption_config('AES-192-OFB', '[2!+b&:G**0YU{LgrN+nnFx)ZnGx2xCC', 'sha256', OPENSSL_RAW_DATA);
//$oAuth_group->override_soap_encryption_config('aes256', 'B3MoBu_LE_6YK 44-iEQw0{VZiBN%9FL', 'fnv1a32', OPENSSL_RAW_DATA);

$CRNRSTN_NUSOAP_SVC_debugMode = true;

//
// ADD USER ACCOUNT - LOCALHOST_PC_XP
$oClient = $oSOAP_access_manager->addClient('LOCALHOST_PC_XP', '0364087231749672543475966333893875', '83g#k487fg5hY%@i4fs84jfmdld8!~lf;|Qkeiur84', $CRNRSTN_NUSOAP_SVC_debugMode);
$oClient->override_soap_encryption_config('AES-192-OFB', '5jfu8chH#5%BNufn49fn4k3nvn9mmN!)000m32N3jN#', 'sha256', OPENSSL_RAW_DATA);
$oClient->activate_SOAP_method('mayItakeTheKingsHighway|returnCRNRSTN_UI_GLOBAL_SYNC');

//
// ADD USER ACCOUNT - LOCALHOST_PC_XP
$oClient = $oSOAP_access_manager->addClient('LOCALHOST_PC_XP', '03856145387465910978456438', '7dj3m9d2m2d99dd2dm', $CRNRSTN_NUSOAP_SVC_debugMode);
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
$oClient = $oSOAP_access_manager->addClient('LOCALHOST_CHAD_MACBOOKPRO', '03856145387465910978456438', '?Lu:Q9W(ISA6-1MZ@cqE0&1_UIX5Iu@N', $CRNRSTN_NUSOAP_SVC_debugMode);
//$oClient_044->override_soap_encryption_config('AES-192-OFB', '4$#HDBidjh7&$*tn4njfn3f7&&*(*', 'sha256', OPENSSL_RAW_DATA);
$oClient->activate_SOAP_method('mayItakeTheKingsHighway|returnCRNRSTN_UI_GLOBAL_SYNC');
$oClient->update_permissions(CRNRSTN_RESOURCE_OPENSOURCE);
//$oClient->IP_denyAccess('111.111.111.112');
//$oClient->IP_exclusiveAccess($_SERVER['SERVER_ADDR']);

//$oClient_group_007 = $oSOAP_access_manager->addClientToGroup('LOCALHOST_MACBOOKTERMINAL', 'hello_un00737289745665293879240', '0N?KTJ$$O.?Qo2oz+uh3C=EwY?q%%p2x');
//$oClient_group_007 = $oSOAP_access_manager->addClientToGroup('LOCALHOST_MACBOOKTERMINAL', 'hello_un01737289745665293879240', 'f!GOs~i+XYe9ctTbPHPF4wZtHa4ecKKy', $oClient_group_007);
//$oClient_group_007 = $oSOAP_access_manager->addClientToGroup('LOCALHOST_MACBOOKTERMINAL', '00737289745665293879240', 'nA55DN{Fu&zZIFBsiaPw6LWe! Qj3Tq(', $oClient_group_007, $CRNRSTN_NUSOAP_SVC_debugMode);
//$oClient_group_007 = $oSOAP_access_manager->addClientToGroup('LOCALHOST_MACBOOKTERMINAL', 'hello_un03737289745665293879240', 'UV7pjj=P6C(O5-O =G+*zK$3]+%OG~V2', $oClient_group_007);
//$oClient_group_007 = $oSOAP_access_manager->addClientToGroup('LOCALHOST_MACBOOKTERMINAL', 'hello_un04737289745665293879240', 'j$f)D@HK)+Gbk(%z}*Wc@@XEFfV)YE[f', $oClient_group_007);
//
//$oClient_group_007->update_permissions('EMAIL|FTP|FILE|DEFAULT|ELECTRUM');
//$oClient_group_007->override_soap_encryption_config('AES-192-OFB', 'poi++wJb?ki2s OY 9sMcGMniCetT)Jg', 'sha256', OPENSSL_RAW_DATA);
//
//$oClient_group_007->activate_SOAP_method('mayItakeTheKingsHighway');
//$oClient_group_007->activate_SOAP_method('takeTheKingsHighway');
//$oClient_group_007->deactivate_SOAP_method('sendElectrumPerformanceReport');
//$oClient_group_007->IP_exclusiveAccess('111.111.111.111');