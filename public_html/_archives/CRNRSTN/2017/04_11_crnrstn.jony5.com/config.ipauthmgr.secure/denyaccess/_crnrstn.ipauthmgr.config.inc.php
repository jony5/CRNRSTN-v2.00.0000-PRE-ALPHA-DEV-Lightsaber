<?php
//
// INITIALIZE SECURITY PROTOCOLS FOR RESOURCE ACCESS [IPv4 and IPv6 (testing needed)]
//

//
// DENY ACCESS
//
#$this->oCRNRSTN_IPSECURITY_MGR->denyAccess([environment-key], [ip]);
$this->oCRNRSTN_IPSECURITY_MGR->denyAccess('LOCALHOST_MAC','192.168.*');
$this->oCRNRSTN_IPSECURITY_MGR->denyAccess('LOCALHOST_PC','FE80::230:80FF:FEF3:4701');
#$this->oCRNRSTN_IPSECURITY_MGR->denyAccess('PREPROD','192.168.172.1, 127.*, 130.51.10.*');
#$this->oCRNRSTN_IPSECURITY_MGR->denyAccess('PRODUCTION','127.0.0.1, 130.*, 130.51.10.*');
?>