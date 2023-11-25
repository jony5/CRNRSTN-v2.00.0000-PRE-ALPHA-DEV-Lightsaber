<?php
/*
//
// CRNRSTN :: INITIALIZE SECURITY PROFILES FOR MULTI-CHANNEL RESOURCE ACCESS [IPv4 and IPv6]
$oCRNRSTN->initialize_ip_address_profile([environment-key], [channel-constant], [ip], [deny-access-boolean]);

// WITH [deny-access-boolean], false[*DEFAULT*] = EXCLUSIVE ACCESS (AUTHORIZED TO PROVIDED IP/IP RANGE) AND
// true = DENY ACCESS (AUTHORIZED TO PROVIDED IP/IP RANGE).
$this->init_ip_authorization_profile(CRNRSTN_RESOURCE_ALL, CRNRSTN_AUTHORIZE_ALL, '127.0.0.1');

*/

//
// THIS CRNRSTN :: 1.0.0 TECH SHOULD BE PROMOTED DOWN TO A LOWER LEVEL FOR
// MULTI-CHANNEL SUPPORT AT THIS TIME. SAME METHOD NAMES. SAME INPUT PARAMS.
// Monday, September 4th, 2023 1046 hrs.
//
// INITIALIZE SECURITY PROTOCOLS FOR RESOURCE ACCESS [IPv4 and IPv6]
//
// DENY ACCESS
#$this->ip_deny_access([environment-key], [ip]);
$this->config_ip_deny_access('BLUEHOST_JONY5','192.168.172.1,192.168.172.135');
$this->config_ip_deny_access('BLUEHOST_EVIFWEB','FE80::230:80FF:FEF3:4701');
$this->config_ip_deny_access('LOCALHOST_PC_XP','127.0.0.1, 127.*, 128.0.4.50-128.0.4.60, 129.*-130.50.*, 130.51.10.*');
$this->config_ip_deny_access('LOCALHOST_CHAD_MACBOOKPRO','127.0.0.1, 130.*, 128.0.4.50-129.0.*, 129.*-130.50.10.10, 130.51.10.*');