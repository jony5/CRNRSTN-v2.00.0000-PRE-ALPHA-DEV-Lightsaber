<?php
//
// INITIALIZE SECURITY PROTOCOLS FOR RESOURCE ACCESS [IPv4 and IPv6]
//
// GRANT ACCESS
// 
# $this->oCRNRSTN_IPSECURITY_MGR->grantAccess([environment-key], [ip]);
$this->oCRNRSTN_IPSECURITY_MGR->grantAccess('LOCALHOST_PC','127.0.0.1');
$this->oCRNRSTN_IPSECURITY_MGR->grantAccess('LOCALHOST_MAC','192.168.172.1,192.168.172.135');
#$this->oCRNRSTN_IPSECURITY_MGR->grantAccess('STAGE','FE80::230:80FF:FEF3:4701');
#$this->oCRNRSTN_IPSECURITY_MGR->grantAccess('PREPROD','127.0.0.1, 127.*, 128.0.4.50-128.0.4.60, 129.*-130.50.*, 130.51.10.*');
#$this->oCRNRSTN_IPSECURITY_MGR->grantAccess('PRODUCTION','127.0.0.1, 130.*, 128.0.4.50-129.0.*, 129.*-130.50.10.10, 130.51.10.*');

//
// DENY ACCESS
//
#$this->oCRNRSTN_IPSECURITY_MGR->denyAccess([environment-key], [ip]);
#$this->oCRNRSTN_IPSECURITY_MGR->denyAccess('LOCALHOST_MAC','192.168.172.1');
#$this->oCRNRSTN_IPSECURITY_MGR->denyAccess('LOCALHOST_PC','FE80::230:80FF:FEF3:4701');
#$this->oCRNRSTN_IPSECURITY_MGR->denyAccess('PREPROD','127.0.0.1, 127.*, 128.0.4.50-128.0.4.60, 129.*-130.50.*, 130.51.10.*');
#$this->oCRNRSTN_IPSECURITY_MGR->denyAccess('PRODUCTION','127.0.0.1, 130.*, 128.0.4.50-129.0.*, 129.*-130.50.10.10, 130.51.10.*');
?>