<?php
/*
// J5
// Code is Poetry */
#
#  CRNRSTN ::
#  VERSION :: 2.00.0000 PRE-ALPHA-DEV
#  DATE (v1.0.0) :: July 4, 2018 - Happy Independence Day from my dog and I to you...wherever and whenever you are.
#  AUTHOR :: Jonathan 'J5' Harris, Lead Full Stack Developer
#  URI :: http://crnrstn.evifweb.com/
#  DESCRIPTION :: CRNRSTN :: An Open Source PHP Class Library providing a robust services interface layer to both
#       facilitate, augment, and enhance the operations of code base for an application across multiple hosting
#       environments. Copyright (C) 2012-2021 eVifweb development.
#  OVERVIEW :: CRNRSTN :: is an open source PHP class library that facilitates the operation of an application within
#       multiple server environments (e.g. localhost, stage, preprod, and production). With this tool, data and
#       functionality with characteristics that inherently create distinctions from one environment to the next...such
#       as IP address restrictions, error logging profiles, and database authentication credentials...can all be
#       managed through one framework for an entire application. Once CRNRSTN :: has been configured for your different
#       hosting environments, seamlessly release a web application from one environment to the next without having to
#       change your code-base to account for environmentally specific parameters. Receive the benefit of a robust and
#       polished framework for bubbling up exception notifications through any output of your choosing. Take advantage
#       of the CRNRSTN :: SOAP Services layer supporting many to 1 proxy messaging relationships between slave and
#       master servers; regarding server communications i.e. notifications, some architectures will depend on one
#       master to support the communications needs of many slaves with respect their roles and responsibilities in
#       regards to sending an email. With CRNRSTN ::, slaves configured to log exceptions via EMAIL_PROXY will send
#       all of their internal system notifications to one master server (proxy) which server would posses the (if
#       necessary) SMTP credentials for authorization to access and execute more restricted communications
#       protocols of the network.
#  LICENSE :: MIT
#		Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated
#		documentation files (the "Software"), to deal in the Software without restriction, including without limitation
#       the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software,
#       and to permit persons to whom the Software is furnished to do so, subject to the following conditions:
#
#		The above copyright notice and this permission notice shall be included in all copies or substantial portions
#		of the Software.
#
#		THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED
#       TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL
#       THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF
#       CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER
#       DEALINGS IN THE SOFTWARE.
#
# # C # R # N # R # S # T # N # : : # # ##
#
# IPV4
# '127.0.0.1', 						# STATIC DEFINE
# '172.0.0.*', 						# WILDCARD
# '173.0.*', 						# WILDCARD DEEPER
# '126.1.0.0/255.255.0.0', 			# RANGE SLASH
# '192.168.0.0/24'					# RANGE CIDR USING NET MASKING (SLASH)
# '192.168/24'						# RANGE CIDR USING NET MASKING (SLASH) [SHORTENED VERSION]
# '125.0.0.1-125.0.0.9', 			# RANGE DASH
#
# IPV6
# '::1'
# '0:0:0:0:0:0:0:1'
# '::168/24'						# RANGE CIDR USING NET MASKING (SLASH) [SHORTENED VERSION]
# '2000:1:1:1:1:1:1:1112/112'
# '4000:1:1:1:1:1:1:1111/112'
# '4000:1:1:1:1:1:1:1112'
# '2000:1:1:1:1:1:1112'
# '2000:1:1:1:1:1:1:1112'
# 'FE80::202:B9FF:FECB:D281'
# 'FE80::230:80FF:FEF3:4701'
# '2001:DB8:1111:2222::1/64'
# '2001:DB8:1111:2222::2/64'
# '2002:c0a8:6301:1::1/64'
# '2002:c0a8:6301:2::1/64'
# 'FE80::/10'
# 'FF00::/8'
# '3000::1/112'
#
# For example, the IPv4 address 192.23.1.2 on R2 S0/0 is converted to ::192.23.1.2 in the IPv6 notation. This address
# is used as BGP peer IPv6 address and BGP next-hop.
# SOURCE :: http://www.cisco.com/en/US/docs/ios/ipv6/configuration/guide/ip6-tunnel.html
# Automatic IPv4-compatible tunnels use IPv4-compatible IPv6 addresses. IPv4-compatible IPv6 addresses are IPv6
# unicast addresses that have zeros in the high-order 96 bits of the address, and an IPv4 address in the
# low-order 32 bits. They can be written as 0:0:0:0:0:0:A.B.C.D or ::A.B.C.D, where "A.B.C.D" represents the
# embedded IPv4 address.
#
# The tunnel destination is automatically determined by the IPv4 address in the low-order 32 bits of IPv4-compatible
# IPv6 addresses. The host or router at each end of an IPv4-compatible tunnel must support both the IPv4 and IPv6
# protocol stacks. IPv4-compatible tunnels can be configured between border-routers or between a border-router and a
# host. Using IPv4-compatible tunnels is an easy method to create tunnels for IPv6 over IPv4, but the technique does
# not scale for large networks.
#
# As shown in Table 3, Part 1, an ISATAP address consists of an IPv6 prefix and the ISATAP interface identifier. This
# interface identifier includes the IPv4 address of the underlying IPv4 link. The following example shows what an
# actual ISATAP address would look like if the prefix is 2001:DB8:1234:5678::/64 and the embedded IPv4 address
# is 10.173.129.8. In the ISATAP address, the IPv4 address is expressed in hexadecimal as 0AAD:8108 (for
# example, 2001:DB8:1234:5678:0000:5EFE:0AAD:8108).
#
# SOURCE :: http://tools.ietf.org/html/draft-ietf-ipv6-addr-arch-v4-04
# There are three conventional forms for representing IPv6 addresses as
# text strings:
#
# 1. The preferred form is x:x:x:x:x:x:x:x, where the 'x's are one to
#   four hexadecimal digits of the eight 16-bit pieces of the address.
#   Examples:
#
# 	ABCD:EF01:2345:6789:ABCD:EF01:2345:6789
#
# 	2001:DB8:0:0:8:800:200C:417A
#
#   Note that it is not necessary to write the leading zeros in an
#   individual field, but there must be at least one numeral in every
#   field (except for the case described in 2.).
#
# 2. Due to some methods of allocating certain styles of IPv6
# 	addresses, it will be common for addresses to contain long strings
# 	of zero bits.  In order to make writing addresses containing zero
# 	bits easier a special syntax is available to compress the zeros.
# 	The use of "::" indicates one or more groups of 16 bits of zeros.
# 	The "::" can only appear once in an address.  The "::" can also be
# 	used to compress leading or trailing zeros in an address.
#
# 	For example the following addresses:
#
#  	2001:DB8:0:0:8:800:200C:417A   a unicast address
#  	FF01:0:0:0:0:0:0:101           a multicast address
#  	0:0:0:0:0:0:0:1                the loopback address
#  	0:0:0:0:0:0:0:0                the unspecified address
#
# 	may be represented as:
#
#  	2001:DB8::8:800:200C:417A      a unicast address
#  	FF01::101                      a multicast address
#  	::1                            the loopback address
#  	::                             the unspecified address
#
# 3. An alternative form that is sometimes more convenient when dealing
# 	with a mixed environment of IPv4 and IPv6 nodes is
# 	x:x:x:x:x:x:d.d.d.d, where the 'x's are the hexadecimal values of
# 	the six high-order 16-bit pieces of the address, and the 'd's are
# 	the decimal values of the four low-order 8-bit pieces of the
# 	address (standard IPv4 representation).  Examples:
#
#  	0:0:0:0:0:0:13.1.68.3
#
#  	0:0:0:0:0:FFFF:129.144.52.38
#
# 	or in compressed form:
#
#  	::13.1.68.3
#
#  	::FFFF:129.144.52.38
#
#  	For example, the following are legal representations of the 60-bit
#    prefix 20010DB80000CD3 (hexadecimal):
#
# 	  2001:0DB8:0000:CD30:0000:0000:0000:0000/60
# 	  2001:0DB8::CD30:0:0:0:0/60
# 	  2001:0DB8:0:CD30::/60
#
#    The following are NOT legal representations of the above prefix:
#
# 	  2001:0DB8:0:CD3/60   may drop leading zeros, but not trailing
# 						   zeros, within any 16-bit chunk of the address
#
# 	  2001:0DB8::CD30/60   address to left of "/" expands to
# 						   2001:0DB8:0000:0000:0000:0000:0000:CD30
#
# 	  2001:0DB8::CD3/60    address to left of "/" expands to
# 						   2001:0DB8:0000:0000:0000:0000:0000:0CD3
#
#    When writing both a node address and a prefix of that node address
#    (e.g., the node's subnet prefix), the two can combined as follows:
#
#
# 	  the node address      2001:0DB8:0:CD30:123:4567:89AB:CDEF
# 	  and its subnet number 2001:0DB8:0:CD30::/60
#
# 	  can be abbreviated as 2001:0DB8:0:CD30:123:4567:89AB:CDEF/60
#
# A second type of IPv6 address that holds an embedded IPv4 address is
# defined.  This address type is used to represent the addresses of
# IPv4 nodes as IPv6 addresses.  The format of the "IPv4-mapped IPv6
# address" is:
#   |                80 bits               | 16 |      32 bits        |
#   +--------------------------------------+--------------------------+
#   |0000..............................0000|FFFF|    IPv4 address     |
#   +--------------------------------------+----+---------------------+
#
# See [*RFC4038] for background on the usage of the "IPv4-mapped IPv6 address".
# *http://tools.ietf.org/html/rfc4038
#
# Link-Local addresses are for use on a single link.  Link-Local
# addresses have the following format:
#   |   10     |
#   |  bits    |         54 bits         |          64 bits           |
#   +----------+-------------------------+----------------------------+
#   |1111111010|           0             |       interface ID         |
#   +----------+-------------------------+----------------------------+
#
#   Site-local addresses were originally designed to be used for
#   addressing inside of a site without the need for a global prefix.
#   Site-Local addresses are now deprecated as defined in [SLDEP].
#
#   Site-Local addresses have the following format:
#
#   |   10     |
#   |  bits    |         54 bits         |         64 bits            |
#   +----------+-------------------------+----------------------------+
#   |1111111011|        subnet ID        |       interface ID         |
#   +----------+-------------------------+----------------------------+
#
#   The Subnet-Router anycast address is predefined.  Its format is as
#   follows:
#
#   |                         n bits                 |   128-n bits   |
#   +------------------------------------------------+----------------+
#   |                   subnet prefix                | 00000000000000 |
#   +------------------------------------------------+----------------+
#
#   The "subnet prefix" in an anycast address is the prefix which
#   identifies a specific link.  This anycast address is syntactically
#   the same as a unicast address for an interface on the link with the
#   interface identifier set to zero.
#
#   An IPv6 multicast address is an identifier for a group of interfaces
#   (typically on different nodes).  An interface may belong to any
#   number of multicast groups.  Multicast addresses have the following
#   format:
#
#   |   8    |  4 |  4 |                  112 bits                   |
#   +------ -+----+----+---------------------------------------------+
#   |11111111|flgs|scop|                  group ID                   |
#   +--------+----+----+---------------------------------------------+
#
#      binary 11111111 at the start of the address identifies the address
#      as being a multicast address.
#
#                                    +-+-+-+-+
#      flgs is a set of 4 flags:     |0|R|P|T|
#                                    +-+-+-+-+
#
#         The high-order flag is reserved, and must be initialized to 0.
#
#         T = 0 indicates a permanently-assigned ("well-known") multicast
#         address, assigned by the Internet Assigned Number Authority
#         (IANA).
#
#         T = 1 indicates a non-permanently-assigned ("transient" or
#         "dynamically" assigned) multicast address.
#         The P flag's definition and usage can be found in [RFC3306].
#
#         The R flag's definition and usage can be found in [RFC3956].
#
#      scop is a 4-bit multicast scope value used to limit the scope of
#      the multicast group.  The values are:
#
#         0  reserved
#         1  interface-local scope
#         2  link-local scope
#         3  reserved
#         4  admin-local scope
#         5  site-local scope
#         6  (unassigned)
#         7  (unassigned)
#         8  organization-local scope
#         9  (unassigned)
#         A  (unassigned)
#         B  (unassigned)
#         C  (unassigned)
#         D  (unassigned)
#         E  global scope
#         F  reserved
#
#         interface-local scope spans only a single interface on a
#         node, and is useful only for loopback transmission of
#         multicast.
#
#         link-local multicast scope spans the same
#         topological region as the corresponding unicast scope.
#
#         admin-local scope is the smallest scope that must be
#         administratively configured, i.e., not automatically
#         derived from physical connectivity or other, non-
#         multicast-related configuration.
#
#         site-local scope is intended to span a single site.
#
#         organization-local scope is intended to span multiple
#         sites belonging to a single organization.
#
#         scopes labeled "(unassigned)" are available for
#         administrators to define additional multicast regions.
#
#      group ID identifies the multicast group, either permanent or
#      transient, within the given scope.  Additional definitions of the
#      multicast group ID field structure is defined in [RFC3306].
#
#
# SOURCE :: http://en.wikipedia.org/wiki/IPv6
# The 128 bits of an IPv6 address are represented in 8 groups of 16 bits each. Each group is written
# as 4 hexadecimal digits and the groups are separated by colons (:). The
# address 2001:0db8:0000:0000:0000:ff00:0042:8329 is an example of this representation.
#
# For convenience, an IPv6 address may be abbreviated to shorter notations by application of the following rules,
# where possible.
#
# One or more leading zeroes from any groups of hexadecimal digits are removed; this is usually done to either all or
# none of the leading zeroes. For example, the group 0042 is converted to 42.
# Consecutive sections of zeroes are replaced with a double colon (::). The double colon may only be used once in an
# address, as multiple use would render the address indeterminate. RFC 5952 recommends that a double colon
# must not be used to denote an omitted single section of zeroes.[38]
# An example of application of these rules:
#
# Initial address: 2001:0db8:0000:0000:0000:ff00:0042:8329
# After removing all leading zeroes: 2001:db8:0:0:0:ff00:42:8329
# After omitting consecutive sections of zeroes: 2001:db8::ff00:42:8329
# The loopback address, 0000:0000:0000:0000:0000:0000:0000:0001, may be abbreviated to ::1 by using both rules.
#
# Hybrid dual-stack IPv6/IPv4 implementations recognize a special class of addresses, the IPv4-mapped IPv6 addresses.
# In these addresses, the first 80 bits are zero, the next 16 bits are one, and the remaining 32 bits are the IPv4
# address. One may see these addresses with the first 96 bits written in the standard IPv6 format, and the
# remaining 32 bits written in the customary dot-decimal notation of IPv4. For example, ::ffff:192.0.2.128 represents
# the IPv4 address 192.0.2.128. A deprecated format for IPv4-compatible IPv6 addresses was ::192.0.2.128.[51]
#
# # C # R # N # R # S # T # N # : : # # ##
#
#  CLASS :: crnrstn_ip_auth_manager
#  VERSION :: 1.00.0001
#  DATE :: September 11, 2012 @ 1520hrs
#  AUTHOR :: Jonathan 'J5' Harris, jharris@eVifweb.com
#  URI :: 
#  DESCRIPTION :: Internal IP Address Manager For Resource Access Authorization
#  LICENSE :: MIT | http://crnrstn.evifweb.com/licensing/
#
class crnrstn_ip_auth_manager {

	private static $clientIpAddress;
	private static $allowedIp_ARRAY = array();
	private static $allowedIpRangeMIN_ARRAY = array();
	private static $allowedIpRangeMAX_ARRAY = array();
	private static $deniedIp_ARRAY = array();
	private static $deniedIpRangeMIN_ARRAY = array();
	private static $deniedIpRangeMAX_ARRAY = array();
	
	private static $tmp_ipconcat;
	private static $tmp_ipexplode = array();
	private static $tmp_rangeexplode = array();
	private static $tmp_ipv4wildcard = array();
	
	private static $allowedIpCounter = 0;
	private static $deniedIpCounter = 0;
	
	private static $accessGranted = array();
	private static $accessDenied = false;
	
	public $oSESSION_MGR;
	
	public function __construct() {
		
		//
		// SET IP ADDRESS
		self::$clientIpAddress = $this->return_ip();
		
	}
	
	public function clientIpAddress(){

		return self::$clientIpAddress;

	}
	
	public function authorizeEnvAccess($oCRNRSTN_ENV, $env){
		
		//
		// INITIALIZE SESSION MANAGER
		if(!isset($this->oSESSION_MGR)){

			$this->oSESSION_MGR = new crnrstn_session_manager($oCRNRSTN_ENV);

		}

		//
		// IF ACCESS HAS ALREADY BEEN GRANTED TO THIS IP, USE CACHED SESSION AUTH
		if(($this->oSESSION_MGR->isset_session_param('CRNRSTN_ACCESS_AUTHORIZED')) && ($this->oSESSION_MGR->getSessionIp('SESSION_IP') == md5(self::$clientIpAddress))){

		    return true;

		}else{
			
			//
			// DETERMINE IF SESSION IPADDRESS IS AUTHORIZED TO ACCESS SERVER RESOURCES
			if(self::validateIpAddress($env, self::$clientIpAddress)){

				self::$accessGranted[$env]=true;
				return self::$accessGranted[$env];

			}else{

				self::$accessDenied=true;				
				self::$accessGranted[$env]=false;
				return self::$accessGranted[$env];

			}
		}
	}
	
	public function grantAccessWKey($envKey, $ip){
		# $oCRNRSTN->grantExclusiveAccess('LOCALHOST_PC','127.0.0.1');
		# $oCRNRSTN->grantExclusiveAccess('LOCALHOST_PC','127.*');
		# $oCRNRSTN->grantExclusiveAccess('LOCALHOST_PC','127.0.0.1, 127.*, 128.0.4.50-128.0.4.60, 129.*-130.50.*, 130.51.10.*');
		#
		# IPV4
		# '127.0.0.1', 										# STATIC DEFINE
        # '172.0.0.*', 										# WILDCARD
        # '173.0.*', 										# WILDCARD DEEPER
        # FORMAT NOT ALLOWED-->'126.1.0.0/255.255.0.0', 	# RANGE SLASH
		# FORMAT NOT ALLOWED-->'192.168.0.0/24'				# RANGE CIDR USING NET MASKING (SLASH) 
		# FORMAT NOT ALLOWED-->'192.168/24'					# RANGE CIDR USING NET MASKING (SLASH) [SHORTENED VERSION]
        # '125.0.0.1-125.0.0.9', 							# RANGE DASH (BROKEN)
		#
		# IPV6
		# '::1'
		# FORMAT NOT ALLOWED-->'::168/24'					# RANGE CIDR USING NET MASKING (SLASH) [SHORTENED VERSION]
		# 

		//
		// STORE IPADDRESS(ES) INTO ARRAY. CHECK FOR COMMA DELIMITED LIST
		if(sizeof(explode(",", $ip))>1){
			
			//
			// WE HAVE A DELIMITED LIST TO PROCESS
			self::$tmp_ipexplode = explode(",", $ip);
			
			//
			// PROCESS DELIMITED LIST OF UNVERIFIED IPS
			foreach (self::$tmp_ipexplode as $pos=>$val) {
				
				//
				// ARE WE DEALING WITH AN INDICATION OF RANGE
				if (strpos($val, '*')!==false || strpos($val, '-')!==false){
					
					//
					// HANDLE DASH NOTATION
					self::$tmp_rangeexplode = explode("-", $val);
					
					//
					// IS FIRST PARAMETER WITH WILDCARD
					if(strpos(self::$tmp_rangeexplode[0], '*')!==false){
						
						//
						// EXPLODE DOT NOTATION TO ARRAY
						self::$tmp_ipv4wildcard = explode('.', self::$tmp_rangeexplode[0]);
                        $this->dressup_ipv4_wildcard();

						self::$allowedIp_ARRAY[$envKey][self::$allowedIpCounter] = self::$tmp_ipconcat;

					}else{
						
						//
						// NO WILDCARD IN FIRST PARAMETER. STORE TO TMP VAR.
						self::$tmp_ipconcat = trim(self::$tmp_rangeexplode[0]);
						self::$allowedIp_ARRAY[$envKey][self::$allowedIpCounter] = self::$tmp_ipconcat;

					}
					
					//
					// SAVE FIRST PARAMETER TO MIN RANGE INDICATOR FOR THIS ACCESS AUTHORIZATION PROFILE
					// APPLY IPV6 + LONG INT CONVERSION FOR LOCALLY CACHED RANGE BOUNDARY
					self::$allowedIpRangeMIN_ARRAY[$envKey][self::$allowedIpCounter] = $this->IPv6ToLong($this->ExpandIPv6Notation($this->IPv4To6(self::$tmp_ipconcat)), 1);
					
					// 
					// JUST SOMETHING TO CLEAR OUT NOTICES FOR PASSING AN UNDEFINED TO STRPOS()
					if(!isset(self::$tmp_rangeexplode[1])){

						self::$tmp_rangeexplode[1]='';

					}
					
					//
					// IS SECOND PARAMETER WITH WILDCARD
					if(strpos(self::$tmp_rangeexplode[1], '*')!==false){
						
						//
						// EXPLODE DOT NOTATION TO ARRAY
						self::$tmp_ipv4wildcard = explode('.', self::$tmp_rangeexplode[1]);
                        $this->dressup_ipv4_wildcard(true);

						//
						// SAVE SECOND PARAMETER TO MAX RANGE INDICATOR FOR THIS ACCESS AUTHORIZATION PROFILE
						// APPLY IPV6 + LONG INT CONVERSION FOR LOCALLY CACHED RANGE BOUNDARY
						self::$allowedIpRangeMAX_ARRAY[$envKey][self::$allowedIpCounter] = $this->IPv6ToLong($this->ExpandIPv6Notation($this->IPv4To6(self::$tmp_ipconcat)), 1);
						
						self::$allowedIp_ARRAY[$envKey][self::$allowedIpCounter] = self::$allowedIp_ARRAY[$envKey][self::$allowedIpCounter].'-'.self::$tmp_ipconcat;
						self::$allowedIpCounter++;

					}else{
						
						//
						// NO WILDCARD IN SECOND PARAMETER. STORE TO TMP VAR.
						if(trim(self::$tmp_rangeexplode[1])!=''){

							self::$tmp_ipconcat = trim(self::$tmp_rangeexplode[1]); 

							//
							// SAVE SECOND PARAMETER TO MAX RANGE INDICATOR FOR THIS ACCESS AUTHORIZATION PROFILE
							// APPLY IPV6 + LONG INT CONVERSION FOR LOCALLY CACHED RANGE BOUNDARY
							self::$allowedIpRangeMAX_ARRAY[$envKey][self::$allowedIpCounter] = $this->IPv6ToLong($this->ExpandIPv6Notation($this->IPv4To6(self::$tmp_ipconcat)), 1);
							
							self::$allowedIp_ARRAY[$envKey][self::$allowedIpCounter] = self::$allowedIp_ARRAY[$envKey][self::$allowedIpCounter].'-'.self::$tmp_ipconcat;
							self::$allowedIpCounter++;

						}else{
							
							//
							// ESTABLISH UPPER BOUND FROM UPPER LIMIT OF PROVIDED IP[0] WILDCARD
							// EXPLODE DOT NOTATION TO ARRAY FOR CONSTRUCTION OF MAXIMUM VALUE
							self::$tmp_ipv4wildcard = explode('.', self::$tmp_rangeexplode[0]);
                            $this->dressup_ipv4_wildcard(true);

							//
							// SAVE SECOND PARAMETER TO MAX RANGE INDICATOR FOR THIS ACCESS AUTHORIZATION PROFILE
							// APPLY IPV6 + LONG INT CONVERSION FOR LOCALLY CACHED RANGE BOUNDARY
							self::$allowedIpRangeMAX_ARRAY[$envKey][self::$allowedIpCounter] = $this->IPv6ToLong($this->ExpandIPv6Notation($this->IPv4To6(self::$tmp_ipconcat)), 1);
							
							self::$allowedIp_ARRAY[$envKey][self::$allowedIpCounter] = self::$allowedIp_ARRAY[$envKey][self::$allowedIpCounter].'-'.self::$tmp_ipconcat;
							self::$allowedIpCounter++;

						}
					}
					
				}else{

					//
					// NO INDICATION OF RANGE OR WILDCARD IN THIS [] COMMA DELIMITED PARAMETER
					self::$tmp_ipconcat = trim($val);

					//
					// SAVE TO MAX/MIN RANGE INDICATOR FOR THIS ACCESS AUTHORIZATION PROFILE
					// APPLY IPV6 + LONG INT CONVERSION FOR LOCALLY CACHED RANGE BOUNDARY
					self::$allowedIpRangeMIN_ARRAY[$envKey][self::$allowedIpCounter] = $this->IPv6ToLong($this->ExpandIPv6Notation($this->IPv4To6(self::$tmp_ipconcat)), 1);
					self::$allowedIpRangeMAX_ARRAY[$envKey][self::$allowedIpCounter] = self::$allowedIpRangeMIN_ARRAY[$envKey][self::$allowedIpCounter];
					
					// 
					// RAW RECORD OF PRE(IPV6 + LONG INT) CONVERTED IP VALUE
					self::$allowedIp_ARRAY[$envKey][self::$allowedIpCounter] = self::$tmp_ipconcat;
					self::$allowedIpCounter++;

				}
			}

		}else{
			
			//
			// ARE WE DEALING WITH AN INDICATION OF RANGE
			if (strpos($ip, '*')!==false || strpos($ip, '-')!==false){
				
				//
				// HANDLE DASH NOTATION
				self::$tmp_rangeexplode = explode('-', $ip);
				
				//
				// IS FIRST PARAMETER WITH WILDCARD
				if(strpos(self::$tmp_rangeexplode[0], '*')!==false){
					
					//
					// EXPLODE DOT NOTATION TO ARRAY
					self::$tmp_ipv4wildcard = explode('.', self::$tmp_rangeexplode[0]);
                    $this->dressup_ipv4_wildcard();

					self::$allowedIp_ARRAY[$envKey][self::$allowedIpCounter] = self::$tmp_ipconcat;

				}else{
					
					//
					// NO WILDCARD IN FIRST PARAMETER. STORE TO TMP VAR.
					self::$tmp_ipconcat = trim(self::$tmp_rangeexplode[0]);
					self::$allowedIp_ARRAY[$envKey][self::$allowedIpCounter] = self::$tmp_ipconcat;

				}
				
				//
				// SAVE FIRST PARAMETER TO MIN RANGE INDICATOR FOR THIS ACCESS AUTHORIZATION PROFILE
				// APPLY IPV6 + LONG INT CONVERSION FOR LOCALLY CACHED RANGE BOUNDARY
				self::$allowedIpRangeMIN_ARRAY[$envKey][self::$allowedIpCounter] = $this->IPv6ToLong($this->ExpandIPv6Notation($this->IPv4To6(self::$tmp_ipconcat)), 1);
				
				// 
				// JUST SOMETHING TO CLEAR OUT NOTICES FOR PASSING AN UNDEFINED TO STRPOS()
				if(!isset(self::$tmp_rangeexplode[1])){

					self::$tmp_rangeexplode[1]='';

				}
				
				//
				// IS SECOND PARAMETER WITH WILDCARD
				if(strpos(self::$tmp_rangeexplode[1], '*')!==false){
					
					//
					// EXPLODE DOT NOTATION TO ARRAY
					self::$tmp_ipv4wildcard = explode('.', self::$tmp_rangeexplode[1]);
                    $this->dressup_ipv4_wildcard(true);

					//
					// SAVE SECOND PARAMETER TO MAX RANGE INDICATOR FOR THIS ACCESS AUTHORIZATION PROFILE
					// APPLY IPV6 + LONG INT CONVERSION FOR LOCALLY CACHED RANGE BOUNDARY
					self::$allowedIpRangeMAX_ARRAY[$envKey][self::$allowedIpCounter] = $this->IPv6ToLong($this->ExpandIPv6Notation($this->IPv4To6(self::$tmp_ipconcat)), 1);
					
					self::$allowedIp_ARRAY[$envKey][self::$allowedIpCounter] = self::$allowedIp_ARRAY[$envKey][self::$allowedIpCounter].'-'.self::$tmp_ipconcat;
					self::$allowedIpCounter++;

				}else{
					
					//
					// NO WILDCARD IN SECOND PARAMETER. STORE TO TMP VAR.
					if(trim(self::$tmp_rangeexplode[1])!=''){

						self::$tmp_ipconcat = trim(self::$tmp_rangeexplode[1]); 

						//
						// SAVE SECOND PARAMETER TO MAX RANGE INDICATOR FOR THIS ACCESS AUTHORIZATION PROFILE
						// APPLY IPV6 + LONG INT CONVERSION FOR LOCALLY CACHED RANGE BOUNDARY
						self::$allowedIpRangeMAX_ARRAY[$envKey][self::$allowedIpCounter] = $this->IPv6ToLong($this->ExpandIPv6Notation($this->IPv4To6(self::$tmp_ipconcat)), 1);
						
						self::$allowedIp_ARRAY[$envKey][self::$allowedIpCounter] = self::$allowedIp_ARRAY[$envKey][self::$allowedIpCounter].'-'.self::$tmp_ipconcat;
						self::$allowedIpCounter++;

					}else{
						
						//
						// ESTABLISH UPPER BOUND FROM UPPER LIMIT OF PROVIDED IP[0] WILDCARD
						// EXPLODE DOT NOTATION TO ARRAY FOR CONSTRUCTION OF MAXIMUM VALUE
						self::$tmp_ipv4wildcard = explode('.', self::$tmp_rangeexplode[0]);
                        $this->dressup_ipv4_wildcard(true);

						//
						// SAVE SECOND PARAMETER TO MAX RANGE INDICATOR FOR THIS ACCESS AUTHORIZATION PROFILE
						// APPLY IPV6 + LONG INT CONVERSION FOR LOCALLY CACHED RANGE BOUNDARY
						self::$allowedIpRangeMAX_ARRAY[$envKey][self::$allowedIpCounter] = $this->IPv6ToLong($this->ExpandIPv6Notation($this->IPv4To6(self::$tmp_ipconcat)), 1);
						
						self::$allowedIp_ARRAY[$envKey][self::$allowedIpCounter] = self::$allowedIp_ARRAY[$envKey][self::$allowedIpCounter].'-'.self::$tmp_ipconcat;
						self::$allowedIpCounter++;

					}
				}
				
			}else{

				//
				// NO INDICATION OF RANGE OR WILDCARD IN THIS [] PARAMETER
				self::$tmp_ipconcat = trim($ip);

				//
				// SAVE TO MAX/MIN RANGE INDICATOR FOR THIS ACCESS AUTHORIZATION PROFILE
				// APPLY IPV6 + LONG INT CONVERSION FOR LOCALLY CACHED RANGE BOUNDARY
				self::$allowedIpRangeMIN_ARRAY[$envKey][self::$allowedIpCounter] = $this->IPv6ToLong($this->ExpandIPv6Notation($this->IPv4To6(self::$tmp_ipconcat)), 1);
				self::$allowedIpRangeMAX_ARRAY[$envKey][self::$allowedIpCounter] = self::$allowedIpRangeMIN_ARRAY[$envKey][self::$allowedIpCounter];
				
				// 
				// RAW RECORD OF PRE(IPV6 + LONG INT) CONVERTED IP VALUE
				self::$allowedIp_ARRAY[$envKey][self::$allowedIpCounter] = self::$tmp_ipconcat;
				self::$allowedIpCounter++;

			}
		}
	}

	public function grantAccess($envKey, $ip){
		# $oCRNRSTN->grantExclusiveAccess('LOCALHOST_PC','127.0.0.1');
		# $oCRNRSTN->grantExclusiveAccess('LOCALHOST_PC','127.*');
		# $oCRNRSTN->grantExclusiveAccess('LOCALHOST_PC','127.');
		# $oCRNRSTN->grantExclusiveAccess('LOCALHOST_PC','127.0.0.1, 127.*, 128.0.4.50-128.0.4.60, 129.*-130.50.*, 130.51.10.*');
		#
		# IPV4
		# '127.0.0.1', 										# STATIC DEFINE
        # '172.0.0.*', 										# WILDCARD
        # '173.0.*', 										# WILDCARD DEEPER
        # FORMAT NOT ALLOWED-->'126.1.0.0/255.255.0.0', 	# RANGE SLASH
		# FORMAT NOT ALLOWED-->'192.168.0.0/24'				# RANGE CIDR USING NET MASKING (SLASH) 
		# FORMAT NOT ALLOWED-->'192.168/24'					# RANGE CIDR USING NET MASKING (SLASH) [SHORTENED VERSION]
        # '125.0.0.1-125.0.0.9', 							# RANGE DASH
		#
		# IPV6
		# '::1'
		# '::168/24'										# RANGE CIDR USING NET MASKING (SLASH) [SHORTENED VERSION]
		# 
		
		//
		// CHECKSUM THE ENV
        $envKey = $this->crcINT($envKey);

		//
		// STORE IPADDRESS(ES) INTO ARRAY. CHECK FOR COMMA DELIMITED LIST
		if(sizeof(explode(',', $ip))>1){
			
			//
			// WE HAVE A DELIMITED LIST TO PROCESS
			self::$tmp_ipexplode = explode(',', $ip);
			
			//
			// PROCESS DELIMITED LIST OF UNVERIFIED IPS
			foreach (self::$tmp_ipexplode as $pos=>$val) {
				
				//
				// ARE WE DEALING WITH AN INDICATION OF RANGE
				if (strpos($val, '*')!==false || strpos($val, '-')!==false){
					
					//
					// HANDLE DASH NOTATION
					self::$tmp_rangeexplode = explode('-', $val);
					
					//
					// IS FIRST PARAMETER WITH WILDCARD
					if(strpos(self::$tmp_rangeexplode[0], '*')!==false){
						
						//
						// EXPLODE DOT NOTATION TO ARRAY
						self::$tmp_ipv4wildcard = explode('.', self::$tmp_rangeexplode[0]);
                        $this->dressup_ipv4_wildcard();

						self::$allowedIp_ARRAY[$envKey][self::$allowedIpCounter] = self::$tmp_ipconcat;

					}else{
						
						//
						// NO WILDCARD IN FIRST PARAMETER. STORE TO TMP VAR.
						self::$tmp_ipconcat = trim(self::$tmp_rangeexplode[0]);
						self::$allowedIp_ARRAY[$envKey][self::$allowedIpCounter] = self::$tmp_ipconcat;

					}
					
					//
					// SAVE FIRST PARAMETER TO MIN RANGE INDICATOR FOR THIS ACCESS AUTHORIZATION PROFILE
					// APPLY IPV6 + LONG INT CONVERSION FOR LOCALLY CACHED RANGE BOUNDARY
					self::$allowedIpRangeMIN_ARRAY[$envKey][self::$allowedIpCounter] = $this->IPv6ToLong($this->ExpandIPv6Notation($this->IPv4To6(self::$tmp_ipconcat)), 1);
					
					// 
					// JUST SOMETHING TO CLEAR OUT NOTICES FOR PASSING AN UNDEFINED TO STRPOS()
					if(!isset(self::$tmp_rangeexplode[1])){

						self::$tmp_rangeexplode[1]='';

					}
					
					//
					// IS SECOND PARAMETER WITH WILDCARD
					if(strpos(self::$tmp_rangeexplode[1], '*')!==false){
						
						//
						// EXPLODE DOT NOTATION TO ARRAY
						self::$tmp_ipv4wildcard = explode('.', self::$tmp_rangeexplode[1]);
                        $this->dressup_ipv4_wildcard(true);

						//
						// SAVE SECOND PARAMETER TO MAX RANGE INDICATOR FOR THIS ACCESS AUTHORIZATION PROFILE
						// APPLY IPV6 + LONG INT CONVERSION FOR LOCALLY CACHED RANGE BOUNDARY
						self::$allowedIpRangeMAX_ARRAY[$envKey][self::$allowedIpCounter] = $this->IPv6ToLong($this->ExpandIPv6Notation($this->IPv4To6(self::$tmp_ipconcat)), 1);
						
						self::$allowedIp_ARRAY[$envKey][self::$allowedIpCounter] = self::$allowedIp_ARRAY[$envKey][self::$allowedIpCounter].'-'.self::$tmp_ipconcat;
						self::$allowedIpCounter++;

					}else{
						
						//
						// NO WILDCARD IN SECOND PARAMETER. STORE TO TMP VAR.
						if(trim(self::$tmp_rangeexplode[1])!=''){

							self::$tmp_ipconcat = trim(self::$tmp_rangeexplode[1]); 

							//
							// SAVE SECOND PARAMETER TO MAX RANGE INDICATOR FOR THIS ACCESS AUTHORIZATION PROFILE
							// APPLY IPV6 + LONG INT CONVERSION FOR LOCALLY CACHED RANGE BOUNDARY
							self::$allowedIpRangeMAX_ARRAY[$envKey][self::$allowedIpCounter] = $this->IPv6ToLong($this->ExpandIPv6Notation($this->IPv4To6(self::$tmp_ipconcat)), 1);
							
							self::$allowedIp_ARRAY[$envKey][self::$allowedIpCounter] = self::$allowedIp_ARRAY[$envKey][self::$allowedIpCounter].'-'.self::$tmp_ipconcat;
							self::$allowedIpCounter++;

						}else{
							
							//
							// ESTABLISH UPPER BOUND FROM UPPER LIMIT OF PROVIDED IP[0] WILDCARD
							// EXPLODE DOT NOTATION TO ARRAY FOR CONSTRUCTION OF MAXIMUM VALUE
							self::$tmp_ipv4wildcard = explode('.', self::$tmp_rangeexplode[0]);
                            $this->dressup_ipv4_wildcard(true);

							//
							// SAVE SECOND PARAMETER TO MAX RANGE INDICATOR FOR THIS ACCESS AUTHORIZATION PROFILE
							// APPLY IPV6 + LONG INT CONVERSION FOR LOCALLY CACHED RANGE BOUNDARY
							self::$allowedIpRangeMAX_ARRAY[$envKey][self::$allowedIpCounter] = $this->IPv6ToLong($this->ExpandIPv6Notation($this->IPv4To6(self::$tmp_ipconcat)), 1);
							
							self::$allowedIp_ARRAY[$envKey][self::$allowedIpCounter] = self::$allowedIp_ARRAY[$envKey][self::$allowedIpCounter].'-'.self::$tmp_ipconcat;
							self::$allowedIpCounter++;

						}
					}
					
				}else{

					//
					// NO INDICATION OF RANGE OR WILDCARD IN THIS [] COMMA DELIMITED PARAMETER
					self::$tmp_ipconcat = trim($val);

					//
					// SAVE TO MAX/MIN RANGE INDICATOR FOR THIS ACCESS AUTHORIZATION PROFILE
					// APPLY IPV6 + LONG INT CONVERSION FOR LOCALLY CACHED RANGE BOUNDARY
					self::$allowedIpRangeMIN_ARRAY[$envKey][self::$allowedIpCounter] = $this->IPv6ToLong($this->ExpandIPv6Notation($this->IPv4To6(self::$tmp_ipconcat)), 1);
					self::$allowedIpRangeMAX_ARRAY[$envKey][self::$allowedIpCounter] = self::$allowedIpRangeMIN_ARRAY[$envKey][self::$allowedIpCounter];
					
					// 
					// RAW RECORD OF PRE(IPV6 + LONG INT) CONVERTED IP VALUE
					self::$allowedIp_ARRAY[$envKey][self::$allowedIpCounter] = self::$tmp_ipconcat;
					self::$allowedIpCounter++;

				}
			}

		}else{
		
			//
			// ARE WE DEALING WITH AN INDICATION OF RANGE
			if (strpos($ip, '*')!==false || strpos($ip, '-')!==false){
				
				//
				// HANDLE DASH NOTATION
				self::$tmp_rangeexplode = explode('-', $ip);
				
				//
				// IS FIRST PARAMETER WITH WILDCARD
				if(strpos(self::$tmp_rangeexplode[0], '*')!==false){
					
					//
					// EXPLODE DOT NOTATION TO ARRAY
					self::$tmp_ipv4wildcard = explode('.', self::$tmp_rangeexplode[0]);
					
					self::$tmp_ipconcat = '';
                    $this->dressup_ipv4_wildcard();
					
					self::$tmp_ipconcat = rtrim(self::$tmp_ipconcat, '.');
					self::$allowedIp_ARRAY[$envKey][self::$allowedIpCounter] = self::$tmp_ipconcat;

				}else{
					
					//
					// NO WILDCARD IN FIRST PARAMETER. STORE TO TMP VAR.
					self::$tmp_ipconcat = trim(self::$tmp_rangeexplode[0]);
					self::$allowedIp_ARRAY[$envKey][self::$allowedIpCounter] = self::$tmp_ipconcat;

				}
				
				//
				// SAVE FIRST PARAMETER TO MIN RANGE INDICATOR FOR THIS ACCESS AUTHORIZATION PROFILE
				// APPLY IPV6 + LONG INT CONVERSION FOR LOCALLY CACHED RANGE BOUNDARY
				self::$allowedIpRangeMIN_ARRAY[$envKey][self::$allowedIpCounter] = $this->IPv6ToLong($this->ExpandIPv6Notation($this->IPv4To6(self::$tmp_ipconcat)), 1);
				
				// 
				// JUST SOMETHING TO CLEAR OUT NOTICES FOR PASSING AN UNDEFINED TO STRPOS()
				if(!isset(self::$tmp_rangeexplode[1])){

					self::$tmp_rangeexplode[1]='';

				}
				
				//
				// IS SECOND PARAMETER WITH WILDCARD
				if(strpos(self::$tmp_rangeexplode[1], '*')!==false){
					
					//
					// EXPLODE DOT NOTATION TO ARRAY
					self::$tmp_ipv4wildcard = explode('.', self::$tmp_rangeexplode[1]);
                    $this->dressup_ipv4_wildcard(true);
					
					//
					// SAVE SECOND PARAMETER TO MAX RANGE INDICATOR FOR THIS ACCESS AUTHORIZATION PROFILE
					// APPLY IPV6 + LONG INT CONVERSION FOR LOCALLY CACHED RANGE BOUNDARY
					self::$allowedIpRangeMAX_ARRAY[$envKey][self::$allowedIpCounter] = $this->IPv6ToLong($this->ExpandIPv6Notation($this->IPv4To6(self::$tmp_ipconcat)), 1);
					
					self::$allowedIp_ARRAY[$envKey][self::$allowedIpCounter] = self::$allowedIp_ARRAY[$envKey][self::$allowedIpCounter].'-'.self::$tmp_ipconcat;
					self::$allowedIpCounter++;

				}else{
					
					//
					// NO WILDCARD IN SECOND PARAMETER. STORE TO TMP VAR.
					if(trim(self::$tmp_rangeexplode[1])!=''){

						self::$tmp_ipconcat = trim(self::$tmp_rangeexplode[1]); 

						//
						// SAVE SECOND PARAMETER TO MAX RANGE INDICATOR FOR THIS ACCESS AUTHORIZATION PROFILE
						// APPLY IPV6 + LONG INT CONVERSION FOR LOCALLY CACHED RANGE BOUNDARY
						self::$allowedIpRangeMAX_ARRAY[$envKey][self::$allowedIpCounter] = $this->IPv6ToLong($this->ExpandIPv6Notation($this->IPv4To6(self::$tmp_ipconcat)), 1);
						
						self::$allowedIp_ARRAY[$envKey][self::$allowedIpCounter] = self::$allowedIp_ARRAY[$envKey][self::$allowedIpCounter].'-'.self::$tmp_ipconcat;
						self::$allowedIpCounter++;

					}else{
						
						//
						// ESTABLISH UPPER BOUND FROM UPPER LIMIT OF PROVIDED IP[0] WILDCARD
						// EXPLODE DOT NOTATION TO ARRAY FOR CONSTRUCTION OF MAXIMUM VALUE
						self::$tmp_ipv4wildcard = explode('.', self::$tmp_rangeexplode[0]);
						$this->dressup_ipv4_wildcard(true);

						//
						// SAVE SECOND PARAMETER TO MAX RANGE INDICATOR FOR THIS ACCESS AUTHORIZATION PROFILE
						// APPLY IPV6 + LONG INT CONVERSION FOR LOCALLY CACHED RANGE BOUNDARY
						self::$allowedIpRangeMAX_ARRAY[$envKey][self::$allowedIpCounter] = $this->IPv6ToLong($this->ExpandIPv6Notation($this->IPv4To6(self::$tmp_ipconcat)), 1);
						
						self::$allowedIp_ARRAY[$envKey][self::$allowedIpCounter] = self::$allowedIp_ARRAY[$envKey][self::$allowedIpCounter].'-'.self::$tmp_ipconcat;
						self::$allowedIpCounter++;

					}
				}
				
			}else{

				//
				// NO INDICATION OF RANGE OR WILDCARD IN THIS []  PARAMETER
				self::$tmp_ipconcat = trim($ip);

				//
				// SAVE TO MAX/MIN RANGE INDICATOR FOR THIS ACCESS AUTHORIZATION PROFILE
				// APPLY IPV6 + LONG INT CONVERSION FOR LOCALLY CACHED RANGE BOUNDARY
				self::$allowedIpRangeMIN_ARRAY[$envKey][self::$allowedIpCounter] = $this->IPv6ToLong($this->ExpandIPv6Notation($this->IPv4To6(self::$tmp_ipconcat)), 1);
				self::$allowedIpRangeMAX_ARRAY[$envKey][self::$allowedIpCounter] = self::$allowedIpRangeMIN_ARRAY[$envKey][self::$allowedIpCounter];
				
				// 
				// RAW RECORD OF PRE(IPV6 + LONG INT) CONVERTED IP VALUE
				self::$allowedIp_ARRAY[$envKey][self::$allowedIpCounter] = self::$tmp_ipconcat;
				self::$allowedIpCounter++;

			}
		
		}

	}

	public function denyAccessWKey($envKey, $ip){
		# $oCRNRSTN->denyAccess('LOCALHOST_PC','127.0.0.1');
		# $oCRNRSTN->denyAccess('LOCALHOST_PC','127.*');
		# $oCRNRSTN->denyAccess('LOCALHOST_PC','127.');
		# $oCRNRSTN->denyAccess('LOCALHOST_PC','127.0.0.1, FE80::230:80FF:FEF3:4701, 128.0.4.50-128.0.4.60, 129.*-130.50.*, 130.51.*');
		#
		# IPV4
        # FORMAT NOT ALLOWED-->'126.1.0.0/255.255.0.0', 	# RANGE SLASH
		# FORMAT NOT ALLOWED-->'192.168.0.0/24'				# RANGE CIDR USING NET MASKING (SLASH) 
		# FORMAT NOT ALLOWED-->'192.168/24'					# RANGE CIDR USING NET MASKING (SLASH) [SHORTENED VERSION]
        # '125.0.0.1-125.0.0.9', 							# RANGE DASH
		#
		# IPV6
		# '::1'
		# FORMAT NOT ALLOWED-->'::168/24'					# RANGE CIDR USING NET MASKING (SLASH)
		# 
		
		//
		// STORE IPADDRESS(ES) INTO ARRAY. CHECK FOR COMMA DELIMITED LIST
		if(sizeof(explode(',', $ip))>1){
			
			//
			// WE HAVE A DELIMITED LIST TO PROCESS
			self::$tmp_ipexplode = explode(',', $ip);
			
			//
			// PROCESS DELIMITED LIST OF UNVERIFIED IPS
			foreach (self::$tmp_ipexplode as $pos=>$val) {
				
				//
				// ARE WE DEALING WITH AN INDICATION OF RANGE
				if (strpos($val, '*')!==false || strpos($val, '-')!==false){
					
					//
					// HANDLE DASH NOTATION
					self::$tmp_rangeexplode = explode('-', $val);
					
					//
					// IS FIRST PARAMETER WITH WILDCARD
					if(strpos(self::$tmp_rangeexplode[0], '*')!==false){
						
						//
						// EXPLODE DOT NOTATION TO ARRAY
						self::$tmp_ipv4wildcard = explode('.', self::$tmp_rangeexplode[0]);
                        $this->dressup_ipv4_wildcard();

						self::$deniedIp_ARRAY[$envKey][self::$deniedIpCounter] = self::$tmp_ipconcat;

					}else{
						
						//
						// NO WILDCARD IN FIRST PARAMETER. STORE TO TMP VAR.
						self::$tmp_ipconcat = trim(self::$tmp_rangeexplode[0]);
						self::$deniedIp_ARRAY[$envKey][self::$deniedIpCounter] = self::$tmp_ipconcat;

					}
					
					//
					// SAVE FIRST PARAMETER TO MIN RANGE INDICATOR FOR THIS ACCESS AUTHORIZATION PROFILE
					// APPLY IPV6 + LONG INT CONVERSION FOR LOCALLY CACHED RANGE BOUNDARY
					self::$deniedIpRangeMIN_ARRAY[$envKey][self::$deniedIpCounter] = $this->IPv6ToLong($this->ExpandIPv6Notation($this->IPv4To6(self::$tmp_ipconcat)), 1);
					
					// 
					// JUST SOMETHING TO CLEAR OUT NOTICES FOR PASSING AN UNDEFINED TO STRPOS()
					if(!isset(self::$tmp_rangeexplode[1])){

						self::$tmp_rangeexplode[1]='';

					}
					
					//
					// IS SECOND PARAMETER WITH WILDCARD
					if(strpos(self::$tmp_rangeexplode[1], '*')!==false){
						
						//
						// EXPLODE DOT NOTATION TO ARRAY
						self::$tmp_ipv4wildcard = explode('.', self::$tmp_rangeexplode[1]);
                        $this->dressup_ipv4_wildcard(true);

						//
						// SAVE SECOND PARAMETER TO MAX RANGE INDICATOR FOR THIS ACCESS AUTHORIZATION PROFILE
						// APPLY IPV6 + LONG INT CONVERSION FOR LOCALLY CACHED RANGE BOUNDARY
						self::$deniedIpRangeMAX_ARRAY[$envKey][self::$deniedIpCounter] = $this->IPv6ToLong($this->ExpandIPv6Notation($this->IPv4To6(self::$tmp_ipconcat)), 1);
						
						self::$deniedIp_ARRAY[$envKey][self::$deniedIpCounter] = self::$deniedIp_ARRAY[$envKey][self::$deniedIpCounter].'-'.self::$tmp_ipconcat;
						self::$deniedIpCounter++;

					}else{
						
						//
						// NO WILDCARD IN SECOND PARAMETER. STORE TO TMP VAR.
						if(trim(self::$tmp_rangeexplode[1])!=''){

							self::$tmp_ipconcat = trim(self::$tmp_rangeexplode[1]); 

							//
							// SAVE SECOND PARAMETER TO MAX RANGE INDICATOR FOR THIS ACCESS AUTHORIZATION PROFILE
							// APPLY IPV6 + LONG INT CONVERSION FOR LOCALLY CACHED RANGE BOUNDARY
							self::$deniedIpRangeMAX_ARRAY[$envKey][self::$deniedIpCounter] = $this->IPv6ToLong($this->ExpandIPv6Notation($this->IPv4To6(self::$tmp_ipconcat)), 1);
							
							self::$deniedIp_ARRAY[$envKey][self::$deniedIpCounter] = self::$deniedIp_ARRAY[$envKey][self::$deniedIpCounter].'-'.self::$tmp_ipconcat;
							self::$deniedIpCounter++;

						}else{
							
							//
							// ESTABLISH UPPER BOUND FROM UPPER LIMIT OF PROVIDED IP[0] WILDCARD
							// EXPLODE DOT NOTATION TO ARRAY FOR CONSTRUCTION OF MAXIMUM VALUE
							self::$tmp_ipv4wildcard = explode('.', self::$tmp_rangeexplode[0]);
                            $this->dressup_ipv4_wildcard(true);

							//
							// SAVE SECOND PARAMETER TO MAX RANGE INDICATOR FOR THIS ACCESS AUTHORIZATION PROFILE
							// APPLY IPV6 + LONG INT CONVERSION FOR LOCALLY CACHED RANGE BOUNDARY
							self::$deniedIpRangeMAX_ARRAY[$envKey][self::$deniedIpCounter] = $this->IPv6ToLong($this->ExpandIPv6Notation($this->IPv4To6(self::$tmp_ipconcat)), 1);
							
							self::$deniedIp_ARRAY[$envKey][self::$deniedIpCounter] = self::$deniedIp_ARRAY[$envKey][self::$deniedIpCounter].'-'.self::$tmp_ipconcat;
							self::$deniedIpCounter++;

						}
					}
					
				}else{

					//
					// NO INDICATION OF RANGE OR WILDCARD IN THIS [] COMMA DELIMITED PARAMETER
					self::$tmp_ipconcat = trim($val);

					//
					// SAVE TO MAX/MIN RANGE INDICATOR FOR THIS ACCESS AUTHORIZATION PROFILE
					// APPLY IPV6 + LONG INT CONVERSION FOR LOCALLY CACHED RANGE BOUNDARY
					self::$deniedIpRangeMIN_ARRAY[$envKey][self::$deniedIpCounter] = $this->IPv6ToLong($this->ExpandIPv6Notation($this->IPv4To6(self::$tmp_ipconcat)), 1);
					self::$deniedIpRangeMAX_ARRAY[$envKey][self::$deniedIpCounter] = self::$deniedIpRangeMIN_ARRAY[$envKey][self::$deniedIpCounter];
					
					// 
					// RAW RECORD OF PRE(IPV6 + LONG INT) CONVERTED IP VALUE
					self::$deniedIp_ARRAY[$envKey][self::$deniedIpCounter] = self::$tmp_ipconcat;
					self::$deniedIpCounter++;

				}
			}

		}else{
			
			//
			// ARE WE DEALING WITH AN INDICATION OF RANGE
			if (strpos($ip, '*')!==false || strpos($ip, '-')!==false){
				
				//
				// HANDLE DASH NOTATION
				self::$tmp_rangeexplode = explode('-', $ip);
				
				//
				// IS FIRST PARAMETER WITH WILDCARD
				if(strpos(self::$tmp_rangeexplode[0], '*')!==false){
					
					//
					// EXPLODE DOT NOTATION TO ARRAY
					self::$tmp_ipv4wildcard = explode('.', self::$tmp_rangeexplode[0]);
                    $this->dressup_ipv4_wildcard();

					self::$deniedIp_ARRAY[$envKey][self::$deniedIpCounter] = self::$tmp_ipconcat;

				}else{
					
					//
					// NO WILDCARD IN FIRST PARAMETER. STORE TO TMP VAR.
					self::$tmp_ipconcat = trim(self::$tmp_rangeexplode[0]);
					self::$deniedIp_ARRAY[$envKey][self::$deniedIpCounter] = self::$tmp_ipconcat;

				}
				
				//
				// SAVE FIRST PARAMETER TO MIN RANGE INDICATOR FOR THIS ACCESS AUTHORIZATION PROFILE
				// APPLY IPV6 + LONG INT CONVERSION FOR LOCALLY CACHED RANGE BOUNDARY
				self::$deniedIpRangeMIN_ARRAY[$envKey][self::$deniedIpCounter] = $this->IPv6ToLong($this->ExpandIPv6Notation($this->IPv4To6(self::$tmp_ipconcat)), 1);
				
				// 
				// JUST SOMETHING TO CLEAR OUT NOTICES FOR PASSING AN UNDEFINED TO STRPOS()
				if(!isset(self::$tmp_rangeexplode[1])){

					self::$tmp_rangeexplode[1]='';

				}
				
				//
				// IS SECOND PARAMETER WITH WILDCARD
				if(strpos(self::$tmp_rangeexplode[1], '*')!==false){
					
					//
					// EXPLODE DOT NOTATION TO ARRAY
					self::$tmp_ipv4wildcard = explode('.', self::$tmp_rangeexplode[1]);
                    $this->dressup_ipv4_wildcard(true);

					//
					// SAVE SECOND PARAMETER TO MAX RANGE INDICATOR FOR THIS ACCESS AUTHORIZATION PROFILE
					// APPLY IPV6 + LONG INT CONVERSION FOR LOCALLY CACHED RANGE BOUNDARY
					self::$deniedIpRangeMAX_ARRAY[$envKey][self::$deniedIpCounter] = $this->IPv6ToLong($this->ExpandIPv6Notation($this->IPv4To6(self::$tmp_ipconcat)), 1);
					
					self::$deniedIp_ARRAY[$envKey][self::$deniedIpCounter] = self::$deniedIp_ARRAY[$envKey][self::$deniedIpCounter].'-'.self::$tmp_ipconcat;
					self::$deniedIpCounter++;

				}else{
					
					//
					// NO WILDCARD IN SECOND PARAMETER. STORE TO TMP VAR.
					if(trim(self::$tmp_rangeexplode[1])!=''){

						self::$tmp_ipconcat = trim(self::$tmp_rangeexplode[1]); 

						//
						// SAVE SECOND PARAMETER TO MAX RANGE INDICATOR FOR THIS ACCESS AUTHORIZATION PROFILE
						// APPLY IPV6 + LONG INT CONVERSION FOR LOCALLY CACHED RANGE BOUNDARY
						self::$deniedIpRangeMAX_ARRAY[$envKey][self::$deniedIpCounter] = $this->IPv6ToLong($this->ExpandIPv6Notation($this->IPv4To6(self::$tmp_ipconcat)), 1);
						
						self::$deniedIp_ARRAY[$envKey][self::$deniedIpCounter] = self::$deniedIp_ARRAY[$envKey][self::$deniedIpCounter].'-'.self::$tmp_ipconcat;
						self::$deniedIpCounter++;

					}else{
						
						//
						// ESTABLISH UPPER BOUND FROM UPPER LIMIT OF PROVIDED IP[0] WILDCARD
						// EXPLODE DOT NOTATION TO ARRAY FOR CONSTRUCTION OF MAXIMUM VALUE
						self::$tmp_ipv4wildcard = explode('.', self::$tmp_rangeexplode[0]);
                        $this->dressup_ipv4_wildcard(true);

						//
						// SAVE SECOND PARAMETER TO MAX RANGE INDICATOR FOR THIS ACCESS AUTHORIZATION PROFILE
						// APPLY IPV6 + LONG INT CONVERSION FOR LOCALLY CACHED RANGE BOUNDARY
						self::$deniedIpRangeMAX_ARRAY[$envKey][self::$deniedIpCounter] = $this->IPv6ToLong($this->ExpandIPv6Notation($this->IPv4To6(self::$tmp_ipconcat)), 1);
						
						self::$deniedIp_ARRAY[$envKey][self::$deniedIpCounter] = self::$deniedIp_ARRAY[$envKey][self::$deniedIpCounter].'-'.self::$tmp_ipconcat;
						self::$deniedIpCounter++;

					}
				}
				
			}else{

				//
				// NO INDICATION OF RANGE OR WILDCARD IN THIS [] PARAMETER
				self::$tmp_ipconcat = trim($ip);

				//
				// SAVE TO MAX/MIN RANGE INDICATOR FOR THIS ACCESS AUTHORIZATION PROFILE
				// APPLY IPV6 + LONG INT CONVERSION FOR LOCALLY CACHED RANGE BOUNDARY
				self::$deniedIpRangeMIN_ARRAY[$envKey][self::$deniedIpCounter] = $this->IPv6ToLong($this->ExpandIPv6Notation($this->IPv4To6(self::$tmp_ipconcat)), 1);
				self::$deniedIpRangeMAX_ARRAY[$envKey][self::$deniedIpCounter] = self::$deniedIpRangeMIN_ARRAY[$envKey][self::$deniedIpCounter];
				
				// 
				// RAW RECORD OF PRE(IPV6 + LONG INT) CONVERTED IP VALUE
				self::$deniedIp_ARRAY[$envKey][self::$deniedIpCounter] = self::$tmp_ipconcat;
				self::$deniedIpCounter++;

			}
		}
	}

	public function denyAccess($envKey, $ip){
		# $oCRNRSTN->denyAccess('LOCALHOST_PC','127.0.0.1');
		# $oCRNRSTN->denyAccess('LOCALHOST_PC','127.*');
		# $oCRNRSTN->denyAccess('LOCALHOST_PC','127.');
		# $oCRNRSTN->denyAccess('LOCALHOST_PC','127.0.0.1, FE80::230:80FF:FEF3:4701, 128.0.4.50-128.0.4.60, 129.*-130.50.*, 130.51.*');
		#
		# IPV4
        # FORMAT NOT ALLOWED-->'126.1.0.0/255.255.0.0', 	# RANGE SLASH
		# FORMAT NOT ALLOWED-->'192.168.0.0/24'				# RANGE CIDR USING NET MASKING (SLASH) 
		# FORMAT NOT ALLOWED-->'192.168/24'					# RANGE CIDR USING NET MASKING (SLASH) [SHORTENED VERSION]
        # '125.0.0.1-125.0.0.9', 							# RANGE DASH
		#
		# IPV6
		# '::1'
		# FORMAT NOT ALLOWED-->'::168/24'					# RANGE CIDR USING NET MASKING (SLASH)
		# 
		
		//
		// CHECKSUM THE ENV
        $envKey = $this->crcINT($envKey);
		
		//
		// STORE IPADDRESS(ES) INTO ARRAY. CHECK FOR COMMA DELIMITED LIST
		if(sizeof(explode(',', $ip)) > 1){
			
			//
			// WE HAVE A DELIMITED LIST TO PROCESS
			self::$tmp_ipexplode = explode(',', $ip);
			
			//
			// PROCESS DELIMITED LIST OF UNVERIFIED IPS
			foreach (self::$tmp_ipexplode as $pos => $val) {
				
				//
				// ARE WE DEALING WITH AN INDICATION OF RANGE
				if (strpos($val, '*')!==false || strpos($val, '-')!==false){
					
					//
					// HANDLE DASH NOTATION
					self::$tmp_rangeexplode = explode('-', $val);
					
					//
					// IS FIRST PARAMETER WITH WILDCARD
					if(strpos(self::$tmp_rangeexplode[0], '*')!==false){
						
						//
						// EXPLODE DOT NOTATION TO ARRAY
						self::$tmp_ipv4wildcard = explode('.', self::$tmp_rangeexplode[0]);
                        $this->dressup_ipv4_wildcard();

						self::$deniedIp_ARRAY[$envKey][self::$deniedIpCounter] = self::$tmp_ipconcat;

					}else{
						
						//
						// NO WILDCARD IN FIRST PARAMETER. STORE TO TMP VAR.
						self::$tmp_ipconcat = trim(self::$tmp_rangeexplode[0]);
						self::$deniedIp_ARRAY[$envKey][self::$deniedIpCounter] = self::$tmp_ipconcat;

					}
					
					//
					// SAVE FIRST PARAMETER TO MIN RANGE INDICATOR FOR THIS ACCESS AUTHORIZATION PROFILE
					// APPLY IPV6 + LONG INT CONVERSION FOR LOCALLY CACHED RANGE BOUNDARY
					self::$deniedIpRangeMIN_ARRAY[$envKey][self::$deniedIpCounter] = $this->IPv6ToLong($this->ExpandIPv6Notation($this->IPv4To6(self::$tmp_ipconcat)), 1);
					
					// 
					// JUST SOMETHING TO CLEAR OUT NOTICES FOR PASSING AN UNDEFINED TO STRPOS()
					if(!isset(self::$tmp_rangeexplode[1])){

						self::$tmp_rangeexplode[1]='';

					}
					
					//
					// IS SECOND PARAMETER WITH WILDCARD
					if(strpos(self::$tmp_rangeexplode[1], '*')!==false){
						
						//
						// EXPLODE DOT NOTATION TO ARRAY
						self::$tmp_ipv4wildcard = explode('.', self::$tmp_rangeexplode[1]);
                        $this->dressup_ipv4_wildcard(true);
						
						//
						// SAVE SECOND PARAMETER TO MAX RANGE INDICATOR FOR THIS ACCESS AUTHORIZATION PROFILE
						// APPLY IPV6 + LONG INT CONVERSION FOR LOCALLY CACHED RANGE BOUNDARY
						self::$deniedIpRangeMAX_ARRAY[$envKey][self::$deniedIpCounter] = $this->IPv6ToLong($this->ExpandIPv6Notation($this->IPv4To6(self::$tmp_ipconcat)), 1);
						
						self::$deniedIp_ARRAY[$envKey][self::$deniedIpCounter] = self::$deniedIp_ARRAY[$envKey][self::$deniedIpCounter].'-'.self::$tmp_ipconcat;
						self::$deniedIpCounter++;

					}else{
						
						//
						// NO WILDCARD IN SECOND PARAMETER. STORE TO TMP VAR.
						if(trim(self::$tmp_rangeexplode[1])!=''){

							self::$tmp_ipconcat = trim(self::$tmp_rangeexplode[1]); 

							//
							// SAVE SECOND PARAMETER TO MAX RANGE INDICATOR FOR THIS ACCESS AUTHORIZATION PROFILE
							// APPLY IPV6 + LONG INT CONVERSION FOR LOCALLY CACHED RANGE BOUNDARY
							self::$deniedIpRangeMAX_ARRAY[$envKey][self::$deniedIpCounter] = $this->IPv6ToLong($this->ExpandIPv6Notation($this->IPv4To6(self::$tmp_ipconcat)), 1);
							
							self::$deniedIp_ARRAY[$envKey][self::$deniedIpCounter] = self::$deniedIp_ARRAY[$envKey][self::$deniedIpCounter].'-'.self::$tmp_ipconcat;
							self::$deniedIpCounter++;

						}else{
							
							//
							// ESTABLISH UPPER BOUND FROM UPPER LIMIT OF PROVIDED IP[0] WILDCARD
							// EXPLODE DOT NOTATION TO ARRAY FOR CONSTRUCTION OF MAXIMUM VALUE
							self::$tmp_ipv4wildcard = explode('.', self::$tmp_rangeexplode[0]);
                            $this->dressup_ipv4_wildcard(true);

							//
							// SAVE SECOND PARAMETER TO MAX RANGE INDICATOR FOR THIS ACCESS AUTHORIZATION PROFILE
							// APPLY IPV6 + LONG INT CONVERSION FOR LOCALLY CACHED RANGE BOUNDARY
							self::$deniedIpRangeMAX_ARRAY[$envKey][self::$deniedIpCounter] = $this->IPv6ToLong($this->ExpandIPv6Notation($this->IPv4To6(self::$tmp_ipconcat)), 1);
							
							self::$deniedIp_ARRAY[$envKey][self::$deniedIpCounter] = self::$deniedIp_ARRAY[$envKey][self::$deniedIpCounter].'-'.self::$tmp_ipconcat;
							self::$deniedIpCounter++;

						}
					}
					
				}else{

					//
					// NO INDICATION OF RANGE OR WILDCARD IN THIS [] COMMA DELIMITED PARAMETER
					self::$tmp_ipconcat = trim($val);

					//
					// SAVE TO MAX/MIN RANGE INDICATOR FOR THIS ACCESS AUTHORIZATION PROFILE
					// APPLY IPV6 + LONG INT CONVERSION FOR LOCALLY CACHED RANGE BOUNDARY
					self::$deniedIpRangeMIN_ARRAY[$envKey][self::$deniedIpCounter] = $this->IPv6ToLong($this->ExpandIPv6Notation($this->IPv4To6(self::$tmp_ipconcat)), 1);
					self::$deniedIpRangeMAX_ARRAY[$envKey][self::$deniedIpCounter] = self::$deniedIpRangeMIN_ARRAY[$envKey][self::$deniedIpCounter];
					
					// 
					// RAW RECORD OF PRE(IPV6 + LONG INT) CONVERTED IP VALUE
					self::$deniedIp_ARRAY[$envKey][self::$deniedIpCounter] = self::$tmp_ipconcat;
					self::$deniedIpCounter++;

				}
			}

		}else{
			
			//
			// ARE WE DEALING WITH AN INDICATION OF RANGE
			if (strpos($ip, '*')!==false || strpos($ip, '-')!==false){
				
				//
				// HANDLE DASH NOTATION
				self::$tmp_rangeexplode = explode('-', $ip);
				
				//
				// IS FIRST PARAMETER WITH WILDCARD
				if(strpos(self::$tmp_rangeexplode[0], '*')!==false){
					
					//
					// EXPLODE DOT NOTATION TO ARRAY
					self::$tmp_ipv4wildcard = explode('.', self::$tmp_rangeexplode[0]);
                    $this->dressup_ipv4_wildcard();

					self::$deniedIp_ARRAY[$envKey][self::$deniedIpCounter] = self::$tmp_ipconcat;

				}else{
					
					//
					// NO WILDCARD IN FIRST PARAMETER. STORE TO TMP VAR.
					self::$tmp_ipconcat = trim(self::$tmp_rangeexplode[0]);
					self::$deniedIp_ARRAY[$envKey][self::$deniedIpCounter] = self::$tmp_ipconcat;

				}
				
				//
				// SAVE FIRST PARAMETER TO MIN RANGE INDICATOR FOR THIS ACCESS AUTHORIZATION PROFILE
				// APPLY IPV6 + LONG INT CONVERSION FOR LOCALLY CACHED RANGE BOUNDARY
				self::$deniedIpRangeMIN_ARRAY[$envKey][self::$deniedIpCounter] = $this->IPv6ToLong($this->ExpandIPv6Notation($this->IPv4To6(self::$tmp_ipconcat)), 1);
				
				// 
				// JUST SOMETHING TO CLEAR OUT NOTICES FOR PASSING AN UNDEFINED TO STRPOS()
				if(!isset(self::$tmp_rangeexplode[1])){

					self::$tmp_rangeexplode[1]='';

				}
				
				//
				// IS SECOND PARAMETER WITH WILDCARD
				if(strpos(self::$tmp_rangeexplode[1], '*')!==false){
					
					//
					// EXPLODE DOT NOTATION TO ARRAY
					self::$tmp_ipv4wildcard = explode('.', self::$tmp_rangeexplode[1]);
                    $this->dressup_ipv4_wildcard(true);
					
					//
					// SAVE SECOND PARAMETER TO MAX RANGE INDICATOR FOR THIS ACCESS AUTHORIZATION PROFILE
					// APPLY IPV6 + LONG INT CONVERSION FOR LOCALLY CACHED RANGE BOUNDARY
					self::$deniedIpRangeMAX_ARRAY[$envKey][self::$deniedIpCounter] = $this->IPv6ToLong($this->ExpandIPv6Notation($this->IPv4To6(self::$tmp_ipconcat)), 1);
					
					self::$deniedIp_ARRAY[$envKey][self::$deniedIpCounter] = self::$deniedIp_ARRAY[$envKey][self::$deniedIpCounter].'-'.self::$tmp_ipconcat;
					self::$deniedIpCounter++;

				}else{
					
					//
					// NO WILDCARD IN SECOND PARAMETER. STORE TO TMP VAR.
					if(trim(self::$tmp_rangeexplode[1])!=''){

						self::$tmp_ipconcat = trim(self::$tmp_rangeexplode[1]); 

						//
						// SAVE SECOND PARAMETER TO MAX RANGE INDICATOR FOR THIS ACCESS AUTHORIZATION PROFILE
						// APPLY IPV6 + LONG INT CONVERSION FOR LOCALLY CACHED RANGE BOUNDARY
						self::$deniedIpRangeMAX_ARRAY[$envKey][self::$deniedIpCounter] = $this->IPv6ToLong($this->ExpandIPv6Notation($this->IPv4To6(self::$tmp_ipconcat)), 1);
						
						self::$deniedIp_ARRAY[$envKey][self::$deniedIpCounter] = self::$deniedIp_ARRAY[$envKey][self::$deniedIpCounter].'-'.self::$tmp_ipconcat;
						self::$deniedIpCounter++;

					}else{
						
						//
						// ESTABLISH UPPER BOUND FROM UPPER LIMIT OF PROVIDED IP[0] WILDCARD
						// EXPLODE DOT NOTATION TO ARRAY FOR CONSTRUCTION OF MAXIMUM VALUE
						self::$tmp_ipv4wildcard = explode('.', self::$tmp_rangeexplode[0]);
                        $this->dressup_ipv4_wildcard(true);

						//
						// SAVE SECOND PARAMETER TO MAX RANGE INDICATOR FOR THIS ACCESS AUTHORIZATION PROFILE
						// APPLY IPV6 + LONG INT CONVERSION FOR LOCALLY CACHED RANGE BOUNDARY
						self::$deniedIpRangeMAX_ARRAY[$envKey][self::$deniedIpCounter] = $this->IPv6ToLong($this->ExpandIPv6Notation($this->IPv4To6(self::$tmp_ipconcat)), 1);
						
						self::$deniedIp_ARRAY[$envKey][self::$deniedIpCounter] = self::$deniedIp_ARRAY[$envKey][self::$deniedIpCounter].'-'.self::$tmp_ipconcat;
						self::$deniedIpCounter++;

					}
				}
				
			}else{

				//
				// NO INDICATION OF RANGE OR WILDCARD IN THIS [] PARAMETER
				self::$tmp_ipconcat = trim($ip);

				//
				// SAVE TO MAX/MIN RANGE INDICATOR FOR THIS ACCESS AUTHORIZATION PROFILE
				// APPLY IPV6 + LONG INT CONVERSION FOR LOCALLY CACHED RANGE BOUNDARY
				self::$deniedIpRangeMIN_ARRAY[$envKey][self::$deniedIpCounter] = $this->IPv6ToLong($this->ExpandIPv6Notation($this->IPv4To6(self::$tmp_ipconcat)), 1);
				self::$deniedIpRangeMAX_ARRAY[$envKey][self::$deniedIpCounter] = self::$deniedIpRangeMIN_ARRAY[$envKey][self::$deniedIpCounter];
				
				// 
				// RAW RECORD OF PRE(IPV6 + LONG INT) CONVERTED IP VALUE
				self::$deniedIp_ARRAY[$envKey][self::$deniedIpCounter] = self::$tmp_ipconcat;
				self::$deniedIpCounter++;

			}
		}
	}
	
	public function validateIpAddress($env, $ip){
		
		//
		// IF NO IP AUTHORIZATION VALUES HAVE BEEN INITIALIZED...NOTHING TO DO HERE
		if(!isset(self::$deniedIp_ARRAY[$env])){

			self::$deniedIp_ARRAY[$env] = array();

		}
		
		if(!isset(self::$allowedIp_ARRAY[$env])){

			self::$allowedIp_ARRAY[$env] = array();

		}
		
		if(sizeof(self::$deniedIp_ARRAY[$env])==0 && sizeof(self::$allowedIp_ARRAY[$env])==0){
			
			//
			// STORE SUCCESSFUL IP ADDRESS AUTHORIZATION TO SESSION
			$this->oSESSION_MGR->set_session_param('CRNRSTN_ACCESS_AUTHORIZED', 1);
			$this->oSESSION_MGR->set_session_param('CRNRSTN_AUTHORIZED_IP', $ip);
			$this->oSESSION_MGR->setSessionIp('SESSION_IP', md5($ip));
			
			return true;
		}
			
		//
		// PROCESS EXCLUSIVE ACCESS
		if(isset(self::$allowedIp_ARRAY[$env])){

			if(is_array(self::$allowedIp_ARRAY[$env])){

				foreach (self::$allowedIp_ARRAY[$env] as $pos=>$val) {

					if(self::$allowedIpRangeMIN_ARRAY[$env][$pos]!=0){

						$tmp_endState = 1;

					}
		
					if(($this->IPv6ToLong($this->ExpandIPv6Notation($this->IPv4To6(self::$clientIpAddress)), 1)>=self::$allowedIpRangeMIN_ARRAY[$env][$pos]) && ($this->IPv6ToLong($this->ExpandIPv6Notation($this->IPv4To6(self::$clientIpAddress)), 1)<=self::$allowedIpRangeMAX_ARRAY[$env][$pos])){
						
						//
						// STORE SUCCESSFUL IP ADDRESS AUTHORIZATION TO SESSION
						$this->oSESSION_MGR->set_session_param('CRNRSTN_ACCESS_AUTHORIZED', 1);
						$this->oSESSION_MGR->set_session_param('CRNRSTN_AUTHORIZED_IP', $ip);
						$this->oSESSION_MGR->setSessionIp('SESSION_IP', md5($ip));
						
						return true;
					}
				}
			}
		}
		
		//
		// PROCESS DENIALS
		if(isset(self::$deniedIp_ARRAY[$env])){

			foreach (self::$deniedIp_ARRAY[$env] as $pos=>$val) {

				if(($this->IPv6ToLong($this->ExpandIPv6Notation($this->IPv4To6(self::$clientIpAddress)), 1)>=self::$deniedIpRangeMIN_ARRAY[$env][$pos]) && ($this->IPv6ToLong($this->ExpandIPv6Notation($this->IPv4To6(self::$clientIpAddress)), 1)<=self::$deniedIpRangeMAX_ARRAY[$env][$pos])){
					
					return false;

				}
			}
		}
		
		if(!isset($tmp_endState)){ $tmp_endState = 0; }
		
		//
		// IF EXCLUSIVES EXIST FOR PROCESSING, DEFAULT RESPONSE IS FALSE (tmp_endState initialized with 1)
		switch($tmp_endState){
			case 1:

				return false;

			break;
			default:

				return true;

			break;
		}

	}

	public function exclusiveAccess($ip){

		$env = "tmpEnv";
		
		if($ip=="*.*"){
			
			return true;	
		}
		
		//
		// STORE IPADDRESS(ES) INTO ARRAY. CHECK FOR COMMA DELIMITED LIST
		if(sizeof(explode(',', $ip))>1){
			
			//
			// WE HAVE A DELIMITED LIST TO PROCESS
			self::$tmp_ipexplode = explode(',', $ip);
			
			//
			// PROCESS DELIMITED LIST OF UNVERIFIED IPS
			foreach (self::$tmp_ipexplode as $pos => $val) {
				
				//
				// ARE WE DEALING WITH AN INDICATION OF RANGE
				if (strpos($val, '*') !== false || strpos($val, '-') !== false){
					
					//
					// HANDLE DASH NOTATION
					self::$tmp_rangeexplode = explode("-", $val);
					
					//
					// IS FIRST PARAMETER WITH WILDCARD
					if(strpos(self::$tmp_rangeexplode[0], '*') !== false){
						
						//
						// EXPLODE DOT NOTATION TO ARRAY
						self::$tmp_ipv4wildcard = explode('.', self::$tmp_rangeexplode[0]);
                        $this->dressup_ipv4_wildcard();

						self::$allowedIp_ARRAY[$env][self::$allowedIpCounter] = self::$tmp_ipconcat;

					}else{
						
						//
						// NO WILDCARD IN FIRST PARAMETER. STORE TO TMP VAR.
						self::$tmp_ipconcat = trim(self::$tmp_rangeexplode[0]);
						self::$allowedIp_ARRAY[$env][self::$allowedIpCounter] = self::$tmp_ipconcat;

					}
					
					//
					// SAVE FIRST PARAMETER TO MIN RANGE INDICATOR FOR THIS ACCESS AUTHORIZATION PROFILE
					// APPLY IPV6 + LONG INT CONVERSION FOR LOCALLY CACHED RANGE BOUNDARY
					self::$allowedIpRangeMIN_ARRAY[$env][self::$allowedIpCounter] = $this->IPv6ToLong($this->ExpandIPv6Notation($this->IPv4To6(self::$tmp_ipconcat)), 1);
					
					// 
					// JUST SOMETHING TO CLEAR OUT NOTICES FOR PASSING AN UNDEFINED TO STRPOS()
					if(!isset(self::$tmp_rangeexplode[1])){

						self::$tmp_rangeexplode[1]='';

					}
					
					//
					// IS SECOND PARAMETER WITH WILDCARD
					if(strpos(self::$tmp_rangeexplode[1], '*')!==false){
						
						//
						// EXPLODE DOT NOTATION TO ARRAY
						self::$tmp_ipv4wildcard = explode('.', self::$tmp_rangeexplode[1]);
                        $this->dressup_ipv4_wildcard(true);
						
						//
						// SAVE SECOND PARAMETER TO MAX RANGE INDICATOR FOR THIS ACCESS AUTHORIZATION PROFILE
						// APPLY IPV6 + LONG INT CONVERSION FOR LOCALLY CACHED RANGE BOUNDARY
						self::$allowedIpRangeMAX_ARRAY[$env][self::$allowedIpCounter] = $this->IPv6ToLong($this->ExpandIPv6Notation($this->IPv4To6(self::$tmp_ipconcat)), 1);
						
						self::$allowedIp_ARRAY[$env][self::$allowedIpCounter] = self::$allowedIp_ARRAY[$env][self::$allowedIpCounter].'-'.self::$tmp_ipconcat;				
						self::$allowedIpCounter++;

					}else{
						
						//
						// NO WILDCARD IN SECOND PARAMETER. STORE TO TMP VAR.
						if(trim(self::$tmp_rangeexplode[1])!=''){

							self::$tmp_ipconcat = trim(self::$tmp_rangeexplode[1]); 

							//
							// SAVE SECOND PARAMETER TO MAX RANGE INDICATOR FOR THIS ACCESS AUTHORIZATION PROFILE
							// APPLY IPV6 + LONG INT CONVERSION FOR LOCALLY CACHED RANGE BOUNDARY
							self::$allowedIpRangeMAX_ARRAY[$env][self::$allowedIpCounter] = $this->IPv6ToLong($this->ExpandIPv6Notation($this->IPv4To6(self::$tmp_ipconcat)), 1);
							
							self::$allowedIp_ARRAY[$env][self::$allowedIpCounter] = self::$allowedIp_ARRAY[$env][self::$allowedIpCounter].'-'.self::$tmp_ipconcat;				
							self::$allowedIpCounter++;

						}else{
							
							//
							// ESTABLISH UPPER BOUND FROM UPPER LIMIT OF PROVIDED IP[0] WILDCARD
							// EXPLODE DOT NOTATION TO ARRAY FOR CONSTRUCTION OF MAXIMUM VALUE
							self::$tmp_ipv4wildcard = explode('.', self::$tmp_rangeexplode[0]);
                            $this->dressup_ipv4_wildcard(true);

							//
							// SAVE SECOND PARAMETER TO MAX RANGE INDICATOR FOR THIS ACCESS AUTHORIZATION PROFILE
							// APPLY IPV6 + LONG INT CONVERSION FOR LOCALLY CACHED RANGE BOUNDARY
							self::$allowedIpRangeMAX_ARRAY[$env][self::$allowedIpCounter] = $this->IPv6ToLong($this->ExpandIPv6Notation($this->IPv4To6(self::$tmp_ipconcat)), 1);
							
							self::$allowedIp_ARRAY[$env][self::$allowedIpCounter] = self::$allowedIp_ARRAY[$env][self::$allowedIpCounter].'-'.self::$tmp_ipconcat;				
							self::$allowedIpCounter++;

						}
					}
					
				}else{

					//
					// NO INDICATION OF RANGE OR WILDCARD IN THIS [] COMMA DELIMITED PARAMETER
					self::$tmp_ipconcat = trim($val);

					//
					// SAVE TO MAX/MIN RANGE INDICATOR FOR THIS ACCESS AUTHORIZATION PROFILE
					// APPLY IPV6 + LONG INT CONVERSION FOR LOCALLY CACHED RANGE BOUNDARY
					self::$allowedIpRangeMIN_ARRAY[$env][self::$allowedIpCounter] = $this->IPv6ToLong($this->ExpandIPv6Notation($this->IPv4To6(self::$tmp_ipconcat)), 1);
					self::$allowedIpRangeMAX_ARRAY[$env][self::$allowedIpCounter] = self::$allowedIpRangeMIN_ARRAY[$env][self::$allowedIpCounter];
					
					// 
					// RAW RECORD OF PRE(IPV6 + LONG INT) CONVERTED IP VALUE
					self::$allowedIp_ARRAY[$env][self::$allowedIpCounter] = self::$tmp_ipconcat;
					self::$allowedIpCounter++;

				}

			}

		}else{
			
			//
			// ARE WE DEALING WITH AN INDICATION OF RANGE
			if (strpos($ip, '*') !== false || strpos($ip, '-') !== false){
				
				//
				// HANDLE DASH NOTATION
				self::$tmp_rangeexplode = explode('-', $ip);
				
				//
				// IS FIRST PARAMETER WITH WILDCARD
				if(strpos(self::$tmp_rangeexplode[0], '*')!==false){
					
					//
					// EXPLODE DOT NOTATION TO ARRAY
					self::$tmp_ipv4wildcard = explode('.', self::$tmp_rangeexplode[0]);
                    $this->dressup_ipv4_wildcard();

					self::$allowedIp_ARRAY[$env][self::$allowedIpCounter] = self::$tmp_ipconcat;

				}else{
					
					//
					// NO WILDCARD IN FIRST PARAMETER. STORE TO TMP VAR.
					self::$tmp_ipconcat = trim(self::$tmp_rangeexplode[0]);
					self::$allowedIp_ARRAY[$env][self::$allowedIpCounter] = self::$tmp_ipconcat;

				}
				
				//
				// SAVE FIRST PARAMETER TO MIN RANGE INDICATOR FOR THIS ACCESS AUTHORIZATION PROFILE
				// APPLY IPV6 + LONG INT CONVERSION FOR LOCALLY CACHED RANGE BOUNDARY
				self::$allowedIpRangeMIN_ARRAY[$env][self::$allowedIpCounter] = $this->IPv6ToLong($this->ExpandIPv6Notation($this->IPv4To6(self::$tmp_ipconcat)), 1);
				
				// 
				// JUST SOMETHING TO CLEAR OUT NOTICES FOR PASSING AN UNDEFINED TO STRPOS()
				if(!isset(self::$tmp_rangeexplode[1])){

					self::$tmp_rangeexplode[1]='';

				}
				
				//
				// IS SECOND PARAMETER WITH WILDCARD
				if(strpos(self::$tmp_rangeexplode[1], '*')!==false){
					
					//
					// EXPLODE DOT NOTATION TO ARRAY
					self::$tmp_ipv4wildcard = explode('.', self::$tmp_rangeexplode[1]);
					$this->dressup_ipv4_wildcard(true);
					
					//
					// SAVE SECOND PARAMETER TO MAX RANGE INDICATOR FOR THIS ACCESS AUTHORIZATION PROFILE
					// APPLY IPV6 + LONG INT CONVERSION FOR LOCALLY CACHED RANGE BOUNDARY
					self::$allowedIpRangeMAX_ARRAY[$env][self::$allowedIpCounter] = $this->IPv6ToLong($this->ExpandIPv6Notation($this->IPv4To6(self::$tmp_ipconcat)), 1);
					
					self::$allowedIp_ARRAY[$env][self::$allowedIpCounter] = self::$allowedIp_ARRAY[$env][self::$allowedIpCounter].'-'.self::$tmp_ipconcat;				
					self::$allowedIpCounter++;

				}else{
					
					//
					// NO WILDCARD IN SECOND PARAMETER. STORE TO TMP VAR.
					if(trim(self::$tmp_rangeexplode[1])!=''){

						self::$tmp_ipconcat = trim(self::$tmp_rangeexplode[1]); 

						//
						// SAVE SECOND PARAMETER TO MAX RANGE INDICATOR FOR THIS ACCESS AUTHORIZATION PROFILE
						// APPLY IPV6 + LONG INT CONVERSION FOR LOCALLY CACHED RANGE BOUNDARY
						self::$allowedIpRangeMAX_ARRAY[$env][self::$allowedIpCounter] = $this->IPv6ToLong($this->ExpandIPv6Notation($this->IPv4To6(self::$tmp_ipconcat)), 1);
						
						self::$allowedIp_ARRAY[$env][self::$allowedIpCounter] = self::$allowedIp_ARRAY[$env][self::$allowedIpCounter].'-'.self::$tmp_ipconcat;				
						self::$allowedIpCounter++;

					}else{
						
						//
						// ESTABLISH UPPER BOUND FROM UPPER LIMIT OF PROVIDED IP[0] WILDCARD
						// EXPLODE DOT NOTATION TO ARRAY FOR CONSTRUCTION OF MAXIMUM VALUE
						self::$tmp_ipv4wildcard = explode('.', self::$tmp_rangeexplode[0]);
                        $this->dressup_ipv4_wildcard(true);

						//
						// SAVE SECOND PARAMETER TO MAX RANGE INDICATOR FOR THIS ACCESS AUTHORIZATION PROFILE
						// APPLY IPV6 + LONG INT CONVERSION FOR LOCALLY CACHED RANGE BOUNDARY
						self::$allowedIpRangeMAX_ARRAY[$env][self::$allowedIpCounter] = $this->IPv6ToLong($this->ExpandIPv6Notation($this->IPv4To6(self::$tmp_ipconcat)), 1);
						
						self::$allowedIp_ARRAY[$env][self::$allowedIpCounter] = self::$allowedIp_ARRAY[$env][self::$allowedIpCounter].'-'.self::$tmp_ipconcat;				
						self::$allowedIpCounter++;

					}
				}
				
			}else{

				//
				// NO INDICATION OF RANGE OR WILDCARD IN THIS [] COMMA DELIMITED PARAMETER
				self::$tmp_ipconcat = trim($ip);

				//
				// SAVE TO MAX/MIN RANGE INDICATOR FOR THIS ACCESS AUTHORIZATION PROFILE
				// APPLY IPV6 + LONG INT CONVERSION FOR LOCALLY CACHED RANGE BOUNDARY
				self::$allowedIpRangeMIN_ARRAY[$env][self::$allowedIpCounter] = $this->IPv6ToLong($this->ExpandIPv6Notation($this->IPv4To6(self::$tmp_ipconcat)), 1);
				self::$allowedIpRangeMAX_ARRAY[$env][self::$allowedIpCounter] = self::$allowedIpRangeMIN_ARRAY[$env][self::$allowedIpCounter];
				
				// 
				// RAW RECORD OF PRE(IPV6 + LONG INT) CONVERTED IP VALUE
				self::$allowedIp_ARRAY[$env][self::$allowedIpCounter] = self::$tmp_ipconcat;
				self::$allowedIpCounter++;

			}
		}
		
		//
		// PROCESS EXCLUSIVE ACCESS
		if(isset(self::$allowedIp_ARRAY[$env])){

			if(is_array(self::$allowedIp_ARRAY[$env])){

				foreach (self::$allowedIp_ARRAY[$env] as $pos=>$val) {

					if(self::$allowedIpRangeMIN_ARRAY[$env][$pos]!=0){

						$tmp_endState = 1;

					}
		
					if(($this->IPv6ToLong($this->ExpandIPv6Notation($this->IPv4To6(self::$clientIpAddress)), 1)>=self::$allowedIpRangeMIN_ARRAY[$env][$pos]) && ($this->IPv6ToLong($this->ExpandIPv6Notation($this->IPv4To6(self::$clientIpAddress)), 1)<=self::$allowedIpRangeMAX_ARRAY[$env][$pos])){
						
						return true;

					}
				}
			}
		}
				
		//
		// IF WE GET THIS FAR AND NO MATCH
		return false;
		
	}

	public function denyIPAccess($ip){

		$env = 'tmpEnv';
		
		if($ip == '*.*'){
			
			return true;

		}
		
		//
		// STORE IPADDRESS(ES) INTO ARRAY. CHECK FOR COMMA DELIMITED LIST
		if(sizeof(explode(',', $ip))>1){
			
			//
			// WE HAVE A DELIMITED LIST TO PROCESS
			self::$tmp_ipexplode = explode(',', $ip);
			
			//
			// PROCESS DELIMITED LIST OF UNVERIFIED IPS
			foreach (self::$tmp_ipexplode as $pos=>$val) {
				
				//
				// ARE WE DEALING WITH AN INDICATION OF RANGE
				if (strpos($val, '*')!==false || strpos($val, '-')!==false){
					
					//
					// HANDLE DASH NOTATION
					self::$tmp_rangeexplode = explode('-', $val);
					
					//
					// IS FIRST PARAMETER WITH WILDCARD
					if(strpos(self::$tmp_rangeexplode[0], '*')!==false){
						
						//
						// EXPLODE DOT NOTATION TO ARRAY
						self::$tmp_ipv4wildcard = explode('.', self::$tmp_rangeexplode[0]);
                        $this->dressup_ipv4_wildcard();

                        self::$deniedIp_ARRAY[$env][self::$deniedIpCounter] = self::$tmp_ipconcat;

					}else{
						
						//
						// NO WILDCARD IN FIRST PARAMETER. STORE TO TMP VAR.
						self::$tmp_ipconcat = trim(self::$tmp_rangeexplode[0]);
						self::$deniedIp_ARRAY[$env][self::$deniedIpCounter] = self::$tmp_ipconcat;

					}
					
					//
					// SAVE FIRST PARAMETER TO MIN RANGE INDICATOR FOR THIS ACCESS AUTHORIZATION PROFILE
					// APPLY IPV6 + LONG INT CONVERSION FOR LOCALLY CACHED RANGE BOUNDARY
					self::$deniedIpRangeMIN_ARRAY[$env][self::$deniedIpCounter] = $this->IPv6ToLong($this->ExpandIPv6Notation($this->IPv4To6(self::$tmp_ipconcat)), 1);
					
					// 
					// JUST SOMETHING TO CLEAR OUT NOTICES FOR PASSING AN UNDEFINED TO STRPOS()
					if(!isset(self::$tmp_rangeexplode[1])){

						self::$tmp_rangeexplode[1]='';

					}
					
					//
					// IS SECOND PARAMETER WITH WILDCARD
					if(strpos(self::$tmp_rangeexplode[1], '*')!==false){
						
						//
						// EXPLODE DOT NOTATION TO ARRAY
						self::$tmp_ipv4wildcard = explode('.', self::$tmp_rangeexplode[1]);
                        $this->dressup_ipv4_wildcard(true);

						//
						// SAVE SECOND PARAMETER TO MAX RANGE INDICATOR FOR THIS ACCESS AUTHORIZATION PROFILE
						// APPLY IPV6 + LONG INT CONVERSION FOR LOCALLY CACHED RANGE BOUNDARY
						self::$deniedIpRangeMAX_ARRAY[$env][self::$deniedIpCounter] = $this->IPv6ToLong($this->ExpandIPv6Notation($this->IPv4To6(self::$tmp_ipconcat)), 1);
						
						self::$deniedIp_ARRAY[$env][self::$deniedIpCounter] = self::$deniedIp_ARRAY[$env][self::$deniedIpCounter].'-'.self::$tmp_ipconcat;				
						self::$deniedIpCounter++;

					}else{
						
						//
						// NO WILDCARD IN SECOND PARAMETER. STORE TO TMP VAR.
						if(trim(self::$tmp_rangeexplode[1])!=''){

							self::$tmp_ipconcat = trim(self::$tmp_rangeexplode[1]); 

							//
							// SAVE SECOND PARAMETER TO MAX RANGE INDICATOR FOR THIS ACCESS AUTHORIZATION PROFILE
							// APPLY IPV6 + LONG INT CONVERSION FOR LOCALLY CACHED RANGE BOUNDARY
							self::$deniedIpRangeMAX_ARRAY[$env][self::$deniedIpCounter] = $this->IPv6ToLong($this->ExpandIPv6Notation($this->IPv4To6(self::$tmp_ipconcat)), 1);
							
							self::$deniedIp_ARRAY[$env][self::$deniedIpCounter] = self::$deniedIp_ARRAY[$env][self::$deniedIpCounter].'-'.self::$tmp_ipconcat;				
							self::$deniedIpCounter++;

						}else{
							
							//
							// ESTABLISH UPPER BOUND FROM UPPER LIMIT OF PROVIDED IP[0] WILDCARD
							// EXPLODE DOT NOTATION TO ARRAY FOR CONSTRUCTION OF MAXIMUM VALUE
							self::$tmp_ipv4wildcard = explode('.', self::$tmp_rangeexplode[0]);
                            $this->dressup_ipv4_wildcard(true);

							//
							// SAVE SECOND PARAMETER TO MAX RANGE INDICATOR FOR THIS ACCESS AUTHORIZATION PROFILE
							// APPLY IPV6 + LONG INT CONVERSION FOR LOCALLY CACHED RANGE BOUNDARY
							self::$deniedIpRangeMAX_ARRAY[$env][self::$deniedIpCounter] = $this->IPv6ToLong($this->ExpandIPv6Notation($this->IPv4To6(self::$tmp_ipconcat)), 1);
							
							self::$deniedIp_ARRAY[$env][self::$deniedIpCounter] = self::$deniedIp_ARRAY[$env][self::$deniedIpCounter].'-'.self::$tmp_ipconcat;				
							self::$deniedIpCounter++;

						}
					}
					
				}else{

					//
					// NO INDICATION OF RANGE OR WILDCARD IN THIS [] COMMA DELIMITED PARAMETER
					self::$tmp_ipconcat = trim($val);

					//
					// SAVE TO MAX/MIN RANGE INDICATOR FOR THIS ACCESS AUTHORIZATION PROFILE
					// APPLY IPV6 + LONG INT CONVERSION FOR LOCALLY CACHED RANGE BOUNDARY
					self::$deniedIpRangeMIN_ARRAY[$env][self::$deniedIpCounter] = $this->IPv6ToLong($this->ExpandIPv6Notation($this->IPv4To6(self::$tmp_ipconcat)), 1);
					self::$deniedIpRangeMAX_ARRAY[$env][self::$deniedIpCounter] = self::$deniedIpRangeMIN_ARRAY[$env][self::$deniedIpCounter];
					
					// 
					// RAW RECORD OF PRE(IPV6 + LONG INT) CONVERTED IP VALUE
					self::$deniedIp_ARRAY[$env][self::$deniedIpCounter] = self::$tmp_ipconcat;
					self::$deniedIpCounter++;

				}
			}

		}else{
			
			//
			// ARE WE DEALING WITH AN INDICATION OF RANGE
			if (strpos($ip, '*')!==false || strpos($ip, '-')!==false){
				
				//
				// HANDLE DASH NOTATION
				self::$tmp_rangeexplode = explode('-', $ip);
				
				//
				// IS FIRST PARAMETER WITH WILDCARD
				if(strpos(self::$tmp_rangeexplode[0], '*')!==false){
					
					//
					// EXPLODE DOT NOTATION TO ARRAY
					self::$tmp_ipv4wildcard = explode('.', self::$tmp_rangeexplode[0]);
                    $this->dressup_ipv4_wildcard();

					self::$deniedIp_ARRAY[$env][self::$deniedIpCounter] = self::$tmp_ipconcat;

				}else{
					
					//
					// NO WILDCARD IN FIRST PARAMETER. STORE TO TMP VAR.
					self::$tmp_ipconcat = trim(self::$tmp_rangeexplode[0]);
					self::$deniedIp_ARRAY[$env][self::$deniedIpCounter] = self::$tmp_ipconcat;

				}
				
				//
				// SAVE FIRST PARAMETER TO MIN RANGE INDICATOR FOR THIS ACCESS AUTHORIZATION PROFILE
				// APPLY IPV6 + LONG INT CONVERSION FOR LOCALLY CACHED RANGE BOUNDARY
				self::$deniedIpRangeMIN_ARRAY[$env][self::$deniedIpCounter] = $this->IPv6ToLong($this->ExpandIPv6Notation($this->IPv4To6(self::$tmp_ipconcat)), 1);
				
				// 
				// JUST SOMETHING TO CLEAR OUT NOTICES FOR PASSING AN UNDEFINED TO STRPOS()
				if(!isset(self::$tmp_rangeexplode[1])){

					self::$tmp_rangeexplode[1]='';

				}
				
				//
				// IS SECOND PARAMETER WITH WILDCARD
				if(strpos(self::$tmp_rangeexplode[1], '*')!==false){
					
					//
					// EXPLODE DOT NOTATION TO ARRAY
					self::$tmp_ipv4wildcard = explode('.', self::$tmp_rangeexplode[1]);
                    $this->dressup_ipv4_wildcard(true);
					
					//
					// SAVE SECOND PARAMETER TO MAX RANGE INDICATOR FOR THIS ACCESS AUTHORIZATION PROFILE
					// APPLY IPV6 + LONG INT CONVERSION FOR LOCALLY CACHED RANGE BOUNDARY
					self::$deniedIpRangeMAX_ARRAY[$env][self::$deniedIpCounter] = $this->IPv6ToLong($this->ExpandIPv6Notation($this->IPv4To6(self::$tmp_ipconcat)), 1);
					
					self::$deniedIp_ARRAY[$env][self::$deniedIpCounter] = self::$deniedIp_ARRAY[$env][self::$deniedIpCounter].'-'.self::$tmp_ipconcat;				
					self::$deniedIpCounter++;

				}else{
					
					//
					// NO WILDCARD IN SECOND PARAMETER. STORE TO TMP VAR.
					if(trim(self::$tmp_rangeexplode[1])!=''){

						self::$tmp_ipconcat = trim(self::$tmp_rangeexplode[1]); 
			
						//
						// SAVE SECOND PARAMETER TO MAX RANGE INDICATOR FOR THIS ACCESS AUTHORIZATION PROFILE
						// APPLY IPV6 + LONG INT CONVERSION FOR LOCALLY CACHED RANGE BOUNDARY
						self::$deniedIpRangeMAX_ARRAY[$env][self::$deniedIpCounter] = $this->IPv6ToLong($this->ExpandIPv6Notation($this->IPv4To6(self::$tmp_ipconcat)), 1);
						
						self::$deniedIp_ARRAY[$env][self::$deniedIpCounter] = self::$deniedIp_ARRAY[$env][self::$deniedIpCounter].'-'.self::$tmp_ipconcat;				
						self::$deniedIpCounter++;

					}else{
						
						//
						// ESTABLISH UPPER BOUND FROM UPPER LIMIT OF PROVIDED IP[0] WILDCARD
						// EXPLODE DOT NOTATION TO ARRAY FOR CONSTRUCTION OF MAXIMUM VALUE
						self::$tmp_ipv4wildcard = explode('.', self::$tmp_rangeexplode[0]);
                        $this->dressup_ipv4_wildcard(true);

			
						//
						// SAVE SECOND PARAMETER TO MAX RANGE INDICATOR FOR THIS ACCESS AUTHORIZATION PROFILE
						// APPLY IPV6 + LONG INT CONVERSION FOR LOCALLY CACHED RANGE BOUNDARY
						self::$deniedIpRangeMAX_ARRAY[$env][self::$deniedIpCounter] = $this->IPv6ToLong($this->ExpandIPv6Notation($this->IPv4To6(self::$tmp_ipconcat)), 1);
						
						self::$deniedIp_ARRAY[$env][self::$deniedIpCounter] = self::$deniedIp_ARRAY[$env][self::$deniedIpCounter].'-'.self::$tmp_ipconcat;				
						self::$deniedIpCounter++;

					}
				}
				
			}else{
			
				//
				// NO INDICATION OF RANGE OR WILDCARD IN THIS [] COMMA DELIMITED PARAMETER
				self::$tmp_ipconcat = trim($ip);
			
				//
				// SAVE TO MAX/MIN RANGE INDICATOR FOR THIS ACCESS AUTHORIZATION PROFILE
				// APPLY IPV6 + LONG INT CONVERSION FOR LOCALLY CACHED RANGE BOUNDARY
				self::$deniedIpRangeMIN_ARRAY[$env][self::$deniedIpCounter] = $this->IPv6ToLong($this->ExpandIPv6Notation($this->IPv4To6(self::$tmp_ipconcat)), 1);
				self::$deniedIpRangeMAX_ARRAY[$env][self::$deniedIpCounter] = self::$deniedIpRangeMIN_ARRAY[$env][self::$deniedIpCounter];
				
				// 
				// RAW RECORD OF PRE(IPV6 + LONG INT) CONVERTED IP VALUE
				self::$deniedIp_ARRAY[$env][self::$deniedIpCounter] = self::$tmp_ipconcat;
				self::$deniedIpCounter++;

			}
		}
		
		//
		// PROCESS DENIALS
		if(isset(self::$deniedIp_ARRAY[$env])){

			foreach (self::$deniedIp_ARRAY[$env] as $pos=>$val) {

				if(($this->IPv6ToLong($this->ExpandIPv6Notation($this->IPv4To6(self::$clientIpAddress)), 1)>=self::$deniedIpRangeMIN_ARRAY[$env][$pos]) && ($this->IPv6ToLong($this->ExpandIPv6Notation($this->IPv4To6(self::$clientIpAddress)), 1)<=self::$deniedIpRangeMAX_ARRAY[$env][$pos])){
					
					return true;

				}
			}
		}
		
		return false;

	}

    private function dressup_ipv4_wildcard($upper_bound = false){

        self::$tmp_ipconcat = '';

        for($i=0; $i<4; $i++){

            if(!isset(self::$tmp_ipv4wildcard[$i])){

                if(!$upper_bound){

                    self::$tmp_ipv4wildcard[$i]=0;

                }else{

                    self::$tmp_ipv4wildcard[$i]=255;

                }

            }else{

                if(trim(self::$tmp_ipv4wildcard[$i])=='*'){

                    if(!$upper_bound){

                        self::$tmp_ipv4wildcard[$i]=0;

                    }else{

                        self::$tmp_ipv4wildcard[$i]=255;

                    }

                }
            }

            self::$tmp_ipconcat .= trim(self::$tmp_ipv4wildcard[$i]).'.';

        }

        //
        // REMOVE TRAILING .
        self::$tmp_ipconcat = rtrim(self::$tmp_ipconcat, '.');

        //error_log(__LINE__.' ip - $tmp_ipconcat='.self::$tmp_ipconcat);
        return NULL;

    }

    public function return_ClientIPV4(){

        return $this->clientIpAddress();

    }

    public function return_ClientIPV6(){

        $tmp_ipv4 = $this->clientIpAddress();

        //return $this->ExpandIPv6Notation($tmp_ipv4);
        return $this->IPv4To6($tmp_ipv4);

    }

    //
    // Sometimes you will find that your website will not get the correct user IP after
    // adding CDN, then this function will help you
    // SOURCE :: https://www.php.net/reserved.variables.server
    // AUTHOR :: https://www.php.net/manual/en/reserved.variables.server.php#122495
	public function return_ip(){
	    //
        // Whatever you do, make sure not to trust data sent from the client.
        // $_SERVER['REMOTE_ADDR'] contains the real IP address of the connecting party. That is the most
        // reliable value you can find. However, they can be behind a proxy server in which case
        // the proxy may have set the $_SERVER['HTTP_X_FORWARDED_FOR'], but this value is
        // easily spoofed. For example, it can be set by someone without a proxy, or the IP
        // can be an internal IP from the LAN behind the proxy.
        //
        // This means that if you are going to save the $_SERVER['HTTP_X_FORWARDED_FOR'], make sure you
        // also save the $_SERVER['REMOTE_ADDR'] value. E.g. by saving both values in different
        // fields in your database.If you are going to save the IP to a database as a string, make sure
        // you have space for at least 45 characters. IPv6 is here to stay and those addresses are
        // larger than the older IPv4 addresses.
        //
        // (Note that IPv6 usually uses 39 characters at most but there is also a special IPv6
        // notation for IPv4 addresses which in its full form can be up to 45 characters. So if you
        // know what you are doing you can use 39 characters, but if you just want to set and forget
        // it, use 45).
        // SOURCE :: https://stackoverflow.com/questions/3003145/how-to-get-the-client-ip-address-in-php
        // AUTHOR :: https://stackoverflow.com/a/3003233

        //
        // MOST TRUSTWORTHY.
        $ip = $_SERVER['REMOTE_ADDR'];

        //
        // SOURCE :: https://stackoverflow.com/questions/12435582/php-serverremote-addr-shows-ipv6/12436099
        // AUTHOR :: https://stackoverflow.com/users/813192/sander-steffann
        // Known prefix
        $v4mapped_prefix_hex = '00000000000000000000ffff';

        $tmp_ver = phpversion();

        if (version_compare(phpversion(), '5.4', '<')) {
            // php version isn't high enough
            $v4mapped_prefix_bin = pack('H*', $v4mapped_prefix_hex);

        }else{

            // Or more readable when using PHP >= 5.4
            $v4mapped_prefix_bin = hex2bin($v4mapped_prefix_hex);

        }

        // Parse
        //$addr = $_SERVER['REMOTE_ADDR'];
        $addr_bin = inet_pton($ip);
        if( $addr_bin === FALSE ) {
            // Unparsable? How did they connect?!?
            die('Invalid IP address');
        }

        // Check prefix
        if( substr($addr_bin, 0, strlen($v4mapped_prefix_bin)) == $v4mapped_prefix_bin) {
            // Strip prefix
            $addr_bin = substr($addr_bin, strlen($v4mapped_prefix_bin));
        }

        // Convert back to printable address in canonical form
        $ip = inet_ntop($addr_bin);

        return $ip;

    }
	
	/**
	* Convert an IPv4 address to IPv6
	*
	* @param string IP Address in dot notation (192.168.1.100)
	* @return string IPv6 formatted address or false if invalid input
	* @see http://stackoverflow.com/questions/444966/working-with-ipv6-addresses-in-php
	* @author https://stackoverflow.com/users/51021/matpie
	* 
	* MODIFIED FROM ORIGINAL
	* 
	*/
	public function IPv4To6($Ip) {
		#error_log("ipauth (1801) ip->".$Ip);
		static $Mask = '::ffff:'; // This tells IPv6 it has an IPv4 address
		#$IPv6 = (strpos($Ip, '::') === 0);			// THIS WAS BREAKING WITH IPV6 IPS, SO HARDCODED TO TRUE. SEEMS TO WORK FINE
		$IPv6 = true;
		$IPv4 = (strpos($Ip, '.') > 0);
	
		if (!$IPv4 && !$IPv6) return false;
		if ($IPv6 && $IPv4) $Ip = substr($Ip, strrpos($Ip, ':')+1); // Strip IPv4 Compatibility notation
		elseif (!$IPv4) return $Ip; // Seems to be IPv6 already?
		$Ip = array_pad(explode('.', $Ip), 4, 0);
		if (count($Ip) > 4) return false;
		for ($i = 0; $i < 4; $i++) if ($Ip[$i] > 255) return false;
		
		if($Ip[0]==""){
			$Ip[0]=0;	
		}
		
		$Part7 = base_convert(($Ip[0] * 256) + $Ip[1], 10, 16);
		$Part8 = base_convert(($Ip[2] * 256) + $Ip[3], 10, 16);
		return $Mask.$Part7.':'.$Part8;
	}
	
	/**
	* Replace '::' with appropriate number of ':0'
	* @see http://stackoverflow.com/questions/444966/working-with-ipv6-addresses-in-php
	* @author https://stackoverflow.com/users/51021/matpie
	*/
	public function ExpandIPv6Notation($Ip) {
		if (strpos($Ip, '::') !== false)
			$Ip = str_replace('::', str_repeat(':0', 8 - substr_count($Ip, ':')).':', $Ip);
		if (strpos($Ip, ':') === 0) $Ip = '0'.$Ip;
		return $Ip;
	}
	
	/**
	* Convert IPv6 address to an integer
	*
	* Optionally split in to two parts.
	*
	* @see https://stackoverflow.com/questions/444966/working-with-ipv6-addresses-in-php
	* @author https://stackoverflow.com/users/51021/matpie
	*
	* MODIFIED FROM ORIGINAL
	*
	*/
	public function IPv6ToLong($Ip, $DatabaseParts= 2) {
		$Ip = $this->ExpandIPv6Notation($Ip);
		$Parts = explode(':', $Ip);
		$Ip = array('', '');
		
		for ($i = 0; $i < 4; $i++){ 
			
			if(!isset($Parts[$i])){
				$Parts[$i]=0;
			}
			
			$Ip[0] .= str_pad(base_convert($Parts[$i], 16, 2), 16, 0, STR_PAD_LEFT); 
		
		
		}
		
		for ($i = 4; $i < 8; $i++){ 
			if(!isset($Parts[$i])){
				$Parts[$i]=0;
			}
			
			$Ip[1] .= str_pad(base_convert($Parts[$i], 16, 2), 16, 0, STR_PAD_LEFT); 
		
		}
	
		if ($DatabaseParts == 2)
				return array(base_convert($Ip[0], 2, 10), base_convert($Ip[1], 2, 10));
		else    return base_convert($Ip[0], 2, 10) + base_convert($Ip[1], 2, 10);
	}

    public function crcINT($value){

        $value = crc32($value);
        return sprintf("%u", $value);

    }
	
	public function __destruct() {
		
	}

}