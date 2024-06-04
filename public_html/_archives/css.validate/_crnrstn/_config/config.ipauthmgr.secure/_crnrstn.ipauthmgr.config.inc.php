<?php
//
// INITIALIZE SECURITY PROTOCOLS FOR RESOURCE ACCESS [IPv4 and IPv6]

//
// GRANT ACCESS - EXCLUSIVE
/**
 * $this->oCRNRSTN_IPSECURITY_MGR->grantAccess()
 *
 * DESCRIPTION :: To grant exclusive access to an IP/range, this grantAccess() method will
 *  evaluate the comma delimited string of IP/ranges provided and will return TRUE if the client IP
 *  is to be granted access; FALSE will be returned if the client IP is outside the range of
 *  IP provided to grantAccess().
 *
 * @param   string $envKey represents a specific environment within which the application
 * will be running.
 *
 * @param   string $ip contains a comma delimited set of IP from which a set of IP ranges will be
 * derived in order to evaluate the client IP for appropriateness.
 *
 * Example ::
 * $oCRNRSTN->grantExclusiveAccess('LOCALHOST_MACBOOKTERMINAL','192.168.172.*,192.168.173.*,192.168.174.3, FE80::230:80FF:FEF3:4701');
 */
$this->oCRNRSTN_IPSECURITY_MGR->grantAccess('LOCALHOST_PC','127.0.0.1');
$this->oCRNRSTN_IPSECURITY_MGR->grantAccess('LOCALHOST_MACBOOKTERMINAL','192.168.172.1,192.168.172.135');
#$this->oCRNRSTN_IPSECURITY_MGR->grantAccess('STAGE','FE80::230:80FF:FEF3:4701');
#$this->oCRNRSTN_IPSECURITY_MGR->grantAccess('PREPROD','127.0.0.1, 127.*, 128.0.4.50-128.0.4.60, 129.*-130.50.*, 130.51.10.*');
#$this->oCRNRSTN_IPSECURITY_MGR->grantAccess('PRODUCTION','127.0.0.1, 130.*, 128.0.4.50-129.0.*, 129.*-130.50.10.10, 130.51.10.*');

//
// DENY ACCESS
//
/**
 * $this->oCRNRSTN_IPSECURITY_MGR->denyAccess()
 *
 * DESCRIPTION :: To deny access to resources before potentially returning a result or
 *  processing data, the denyAccess() method will evaluate the comma delimited string of
 *  IP/ranges provided and will return TRUE if the client IP matches the provided $ip
 *  (FALSE if otherwise). One may then process the remainder of the
 *  use-case appropriately.
 *
 * @param   string $envKey represents a specific environment within which the application
 * will be running.
 *
 * @param   string $ip contains a comma delimited set of IP from which a set of IP ranges will be
 * derived in order to evaluate the client IP for appropriateness.
 *
 * Example ::
 * $this->oCRNRSTN_IPSECURITY_MGR->denyAccess('PREPROD','127.0.0.1, 127.*, 128.0.4.50-128.0.4.60, 129.*-130.50.*, 130.51.10.*');
 */
#$this->oCRNRSTN_IPSECURITY_MGR->denyAccess('LOCALHOST_MACBOOKTERMINAL','192.168.172.1');
#$this->oCRNRSTN_IPSECURITY_MGR->denyAccess('LOCALHOST_PC','FE80::230:80FF:FEF3:4701');
#$this->oCRNRSTN_IPSECURITY_MGR->denyAccess('PREPROD','127.0.0.1, 127.*, 128.0.4.50-128.0.4.60, 129.*-130.50.*, 130.51.10.*');
#$this->oCRNRSTN_IPSECURITY_MGR->denyAccess('PRODUCTION','127.0.0.1, 130.*, 128.0.4.50-129.0.*, 129.*-130.50.10.10, 130.51.10.*');