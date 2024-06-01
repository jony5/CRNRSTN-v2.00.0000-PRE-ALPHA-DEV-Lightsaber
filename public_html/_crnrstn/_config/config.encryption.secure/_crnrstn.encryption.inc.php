<?php
/**
* @package CRNRSTN

// J5
// Code is Poetry */
# # C # R # N # R # S # T # N # : : # # # #
#
#        CRNRSTN :: An open source PHP class library supporting enterprise application development that is framed within
#                   the context of mature/rigid RTM protocols.
#        VERSION :: 2.00.0000 PRE-ALPHA-DEV (Lightsaber)
#      TIMESTAMP :: Tuesday, November 28, 2023 @ 16:20:00.065620.
#  DATE (v1.0.0) :: July 4, 2018 - Happy Independence Day from my dog and I to you...wherever and whenever you are.
#         AUTHOR :: Jonathan '5' Harris, CEO, CTO, Lead Full Stack Developer, jharris@eVifweb.com, eVifweb@gmail.com.
#            URI :: https://crnrstn.jony5.com
#       OVERVIEW :: CRNRSTN :: An Open Source PHP Class Library that stands on top of a robust web services oriented
#                   architecture to both facilitate, augment, and enhance (with stability) the operations of a code base
#                   for a web application across multiple hosting environments.
#
#                   CRNRSTN :: is powered by eVifweb; CRNRSTN :: is powered by eCRM Strategy and Execution,
#                   Web Design & Development, and Only The Best Coffee.
#
#                   Copyright (c) 2012-2024 :: eVifweb development :: All Rights Reserved.
#    DESCRIPTION :: CRNRSTN :: is an open source PHP class library that will facilitate and spread (via SOAP services)
#                   operations of a web application across multiple servers or environments (e.g. localhost, stage,
#                   preprod, and production). With this tool, data and functionality possessing characteristics that
#                   inherently create distinctions between one environment and another can all be managed through one
#                   framework for an entire application. IP address restrictions, error logging profiles, and database
#                   authentication credentials are a few areas within an application's architecture where
#                   CRNRSTN :: was designed to excel.
#
#                   Once CRNRSTN :: has been configured to support all of a web application's running servers, one can
#                   seamlessly RTM the codebase of the web site without having to modify the configuration to account
#                   for any unique and environmentally specific parameters. Receive the benefit of a robust and polished
#                   framework that will bubble up logs from exception notifications to any output channel (email, hidden
#                   HTML comment, native default,...etc.) of one's own choosing.
#
#                   Stand on top of the CRNRSTN :: SOAP Services Layer to, for example, organize and strengthen the
#                   communications architecture of any web application. By supporting many-to-one proxy messaging
#                   relationships between slaves and a master "communications server", CRNRSTN :: can streamline and
#                   simplify the management of web application communications; one can configure everything from SMTP
#                   credentials to the character count for line wrapping in the text versions of multi-part HTML email.
#
#                   This is the "King's Highway" for sending email communications.
#        LICENSE :: MIT
#                   Permission is hereby granted, free of charge, to any person obtaining
#                   a copy of this software and associated documentation files (the
#                   "Software"), to deal in the Software without restriction, including
#                   without limitation the rights to use, copy, modify, merge, publish,
#                   distribute, sublicense, and/or sell copies of the Software, and to
#                   permit persons to whom the Software is furnished to do so, subject to
#                   the following conditions:
#
#                   The above copyright notice and this permission notice shall be
#                   included in all copies or substantial portions of the Software.
#
#                   THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
#                   EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
#                   MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.
#                   IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY
#                   CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT,
#                   TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE
#                   SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
#
# # C # R # N # R # S # T # N # : : # # # #
#
/**
 * $oCRNRSTN->init_session_encryption()
 * TODO :: FACILITATE GRACEFUL ROTATION OF THESE ENCRYPTION PROTOCOLS   <-- SEE OERSL.
 *
 * DESCRIPTION :: To configure any of your SERVER environments to hide persistent CRNRSTN :: configuration
 *  session data behind a layer of encryption, run $oCRNRSTN->init_session_encryption()...as defined below...
 *  specifying the environmental key for each environment where encryption is desired. The use of
 *  CRNRSTN :: to read data from and write data to session will apply these configured encryption settings
 *  upon all data types wherein the encryption of data is actually possible. E.g. objects will not be encrypted.
 *
 *  CAUTION: This feature WILL increase server load.
 *  CAUTION: CRNRSTN :: applies a combination of encryption cipher and HMAC keyed hash value data
 *  manipulations and comparisons to store and verify CRNRSTN :: session data. Some
 *  encryption-cipher / HMAC-algorithm combinations will not be compatible with CRNRSTN :: due
 *  to how they are applied to the data when encryption is initialized...so please test your
 *  encryption configuration before applying these settings to your production environment.
 *
 * @param   string $env_key is a custom user-defined value representing a specific environment
 * within which this application will be running and which key will be used throughout this
 * configuration file + any CRNRSTN :: resource includes in order to align the necessary
 * functionality and resources to said environment.
 *
 * @param   string $encryptCipher holds the designation of the cipher to be used. CRNRSTN :: ships with
 * a configuration debug page which will expose all of the available OpenSSL ciphers within the running
 * environment. This page is: crnrstn_config_debug.php Also, for the same list of recommended / available
 * OpenSSL ciphers in this environment, run: $oCRNRSTN_USR->openssl_get_cipher_methods(), which will
 * return an array containing OpenSSL ciphers in the array index value position. E.g. :
 * $return_array = $oCRNRSTN_USR->openssl_get_cipher_methods();
 * foreach($return_array as $key => $openSSL_cipher){ echo $openSSL_cipher.'<br>'; }
 *
 * @param   string $encryptSecretKey contains your secret password or hash to be used in openSSL
 * encrypt/decrypt operations.
 *
 * @param   int $encryptOptions contains a bitwise disjunction of the flags OPENSSL_RAW_DATA
 * and OPENSSL_ZERO_PADDING.
 *
 * @param   string $hmac_alg contains specification of the algorithm to be used by CRNRSTN :: when using
 * the HMAC library to generate a keyed hash value. For a list of available algorithms run hash_algos().
 * E.g. $return_array = hash_algos();
 * foreach($return_array as $key => $algReturn){ echo $algReturn.'<br>'; }
 *
 * CAUTION :: Some hash_algos returned algorithms will NOT be compatible with hash_hmac()
 * which CRNRSTN :: uses in validating it's decryption. And certain OpenSSL encryption cipher / hash_algos
 * algorithm combinations will not be compatible. Please test the init_session_encryption() compatibility
 * of your desired encryption cipher and hmac algorithm in each environment...especially before releasing
 * to production code base.
 *
 * NOTE :: The available cipher methods can differ between your dev server and your production server! They
 * will depend on the installation and compilation options used for OpenSSL in your machine(s).
 *
 * Example ::
 * $oCRNRSTN->init_session_encryption('LOCALHOST_PC', 'AES-192-OFB', 'this-Is-the-s3cret-encrypti0n-key', OPENSSL_RAW_DATA, 'sha256');          // TOSHIBA M100 [eVifweb] :: RADIOHEAD LAPTOP.
 */
$this->config_init_session_encryption('BLUEHOST_JONY5', 'AES-256-CTR', '0(.sRg*QieO7@3Uc?di+mzL}=nQVC9Em', OPENSSL_RAW_DATA, 'ripemd256');
$this->config_init_session_encryption('BLUEHOST_EVIFWEB', 'AES-256-CTR', '}8gHpd?Q(7PKFqfscZ&7*ITDgdf@AKRt', OPENSSL_RAW_DATA, 'ripemd256');
$this->config_init_session_encryption('LOCALHOST_CHAD_MACBOOKPRO', 'AES-192-OFB', '7+yyZF9R#20@8fi2-p5(xyWE#j4: U3x', OPENSSL_RAW_DATA, 'sha256');
$this->config_init_session_encryption('LOCALHOST_PC', 'AES-192-OFB', 'iB{5kb&0-I+C&MRF(i8Ip&ad4(igYN%#', OPENSSL_RAW_DATA, 'sha256');

//
// INITIALIZATION FOR ENCRYPTION :: CRNRSTN :: COOKIE DATA :: ADVANCED CONFIGURATION PARAMETERS
/**
 * $oCRNRSTN->init_cookie_encryption()
 * TODO :: FACILITATE GRACEFUL ROTATION OF THESE ENCRYPTION PROTOCOLS
 * DESCRIPTION :: To configure any of your SERVER environments to hide cookie data behind a layer of
 *  encryption, run $oCRNRSTN->init_cookie_encryption()...as defined below...specifying the environmental
 *  key for each environment where this encryption is desired. The use of CRNRSTN :: to read and write
 *  cookie data will apply these configured encryption settings automatically.
 *
 * CAUTION. If cookie encryption is enabled and then changed some time later. It is possible for
 * clients to have cookie data that was encrypted with a "no-longer-in-production" encryption cipher or
 * HMAC algorithm...and hence, become unreadable garbage to the application. Developer needs to take
 * this into consideration and plan for use case where cookie data is unreadable...with graceful
 * degradation or cookie reset.
 *
 * CAUTION: This feature WILL increase server load.
 *
 * CAUTION: CRNRSTN :: applies a combination of encryption cipher and HMAC keyed hash value data
 * manipulations and comparisons to store and verify CRNRSTN :: session data. Some
 * encryption-cipher / HMAC-algorithm combinations will not be compatible with CRNRSTN :: due
 * to how they are applied to the data when encryption is initialized...so please test your
 * encryption configuration before applying these settings to your production environment.
 *
 * @param   string $env_key is a custom user-defined value representing a specific environment
 * within which this application will be running and which key will be used throughout this
 * configuration file + any CRNRSTN :: resource includes in order to align the necessary
 * functionality and resources to said environment.
 *
 * @param   string $encryptCipher holds the designation of the cipher to be used. CRNRSTN :: ships with
 * a configuration debug page which will expose all of the available OpenSSL ciphers within the running
 * environment. This page is: crnrstn_config_debug.php Also, for the same list of recommended / available
 * OpenSSL ciphers in this environment, run: $this_USR->openssl_get_cipher_methods(), which will
 * return an array containing OpenSSL ciphers in the array index value position. E.g. :
 * $return_array = $oCRNRSTN_USR->openssl_get_cipher_methods();
 * foreach($return_array as $key => $openSSL_cipher){ echo $openSSL_cipher.'<br>'; }
 *
 * @param   string $encryptSecretKey contains your secret password or hash to be used in openSSL
 * encrypt/decrypt operations.
 *
 * @param   int $encryptOptions contains a bitwise disjunction of the flags OPENSSL_RAW_DATA
 * and OPENSSL_ZERO_PADDING.
 *
 * @param   string $hmac_alg contains specification of the algorithm to be used by CRNRSTN :: when using
 * the HMAC library to generate a keyed hash value. For a list of available algorithms run hash_algos().
 * E.g. $return_array = hash_algos();
 * foreach($return_array as $key => $algReturn){ echo $algReturn.'<br>'; }
 *
 * CAUTION :: Some hash_algos returned algorithms will NOT be compatible with hash_hmac()
 * which CRNRSTN :: uses in validating it's decryption. And certain OpenSSL encryption cipher / hash_algos
 * algorithm combinations will not be compatible. Please test the init_session_encryption() compatibility
 * of your desired encryption cipher and hmac algorithm in each environment...especially before releasing
 * to production code base.
 *
 * NOTE :: The available cipher methods can differ between your dev server and your production server! They
 * will depend on the installation and compilation options used for OpenSSL in your machine(s).
 *
 * Example ::
 * $oCRNRSTN->init_cookie_encryption('LOCALHOST_PC', 'AES-192-OFB', 'this-Is-the-s3cret-encrypti0n-key', OPENSSL_RAW_DATA, 'sha256');        // TOSHIBA M100 [eVifweb] :: RADIOHEAD LAPTOP.
 */
$this->config_init_cookie_encryption('BLUEHOST_JONY5', 'AES-256-CTR', 'II0]E{w D:?vRrb+a-3&i]U9Ei~ABI4?', OPENSSL_RAW_DATA, 'ripemd256');
$this->config_init_cookie_encryption('BLUEHOST_EVIFWEB', 'AES-256-CTR', '4?4x&M$%nXiJ$4Qizs~&*cD~+~1~F]Ll', OPENSSL_RAW_DATA, 'ripemd256');
$this->config_init_cookie_encryption('LOCALHOST_CHAD_MACBOOKPRO', 'AES-256-CTR', '5T:J~ws:r#($EZYwWZG)k9$SsSPr&NR+', OPENSSL_RAW_DATA, 'gost');
$this->config_init_cookie_encryption('LOCALHOST_PC', 'AES-256-CTR', 'M?3]~in?Y$K3DEeLZ:8frEuA &6uz4o5', OPENSSL_RAW_DATA, 'gost');
//#$this->config_init_cookie_encryption('LOCALHOST_PC', 'AES-192-OFB', 'vVdE!n.Di4vk+=$0Yj:1-tb(aAD)4lc6', OPENSSL_RAW_DATA, 'sha256');         // TOSHIBA M100 [eVifweb] :: RADIOHEAD LAPTOP.

//
// INITIALIZATION FOR ENCRYPTION :: CRNRSTN :: TUNNELLED DATA :: ADVANCED CONFIGURATION PARAMETERS
/**
 * $oCRNRSTN->init_tunnel_encryption()
 *
 * DESCRIPTION :: Application security and data hygiene can be significantly enhanced with the basic
 * and consistent (only as strong as the weakest link) utilization of CRNRSTN and its encryption
 * tunneling protocols. Sending data safely server to server (e.g. SOAP) and between the
 * server and client can be achieved with minimal effort and maximum data integrity through the
 * strategic application of this functionality across all data touch points within your application(s).
 * I have some apps where all data contained within hidden form fields is encrypted. When I have foreign
 * keys appended to a link that will go directly into the hidden fields of a form...and then directly
 * into my database!!, I will NOT spend additional server resources to confirm their accuracy before the
 * MySQL INSERT by racking up extra and peripheral MySQL database hits. If the data is corrupted in the
 * link, data_decrypt() will throw an exception that can be handled with grace before the face of
 * the end user (which could be my boss), and the database will only receive bona fide clean data.
 *
 * CAUTION: CRNRSTN :: applies a combination of encryption cipher and HMAC keyed hash value data
 * manipulations and comparisons to store and verify tunnel encrypted data. Some encryption-
 * cipher / HMAC-algorithm combinations will not be compatible with CRNRSTN :: due to how they
 * are applied to the data when encryption is initialized...so please test your encryption
 * configuration before applying these settings to your production environment.
 *
 * @param   string $env_key is a custom user-defined value representing a specific environment
 * within which this application will be running and which key will be used throughout this
 * configuration file + any CRNRSTN :: resource includes in order to align the necessary
 * functionality and resources to said environment.
 *
 * @param   string $encryptCipher holds the designation of the cipher to be used. CRNRSTN :: ships with
 * a configuration debug page which will expose all of the available OpenSSL ciphers within the running
 * environment. This page is: crnrstn_config_debug.php Also, for the same list of recommended / available
 * OpenSSL ciphers in this environment, run: $oCRNRSTN_USR->openssl_get_cipher_methods(), which will
 * return an array containing OpenSSL ciphers in the array index value position. E.g. :
 * $return_array = $oCRNRSTN_USR->openssl_get_cipher_methods();
 * foreach($return_array as $key => $openSSL_cipher){ echo $openSSL_cipher.'<br>'; }
 *
 * @param   string $encryptSecretKey contains your secret password or hash to be used in openSSL
 * encrypt/decrypt operations.
 *
 * @param   int $encryptOptions contains a bitwise disjunction of the flags OPENSSL_RAW_DATA
 * and OPENSSL_ZERO_PADDING.
 *
 * @param   string $hmac_alg contains specification of the algorithm to be used by CRNRSTN :: when using
 * the HMAC library to generate a keyed hash value. For a list of available algorithms run hash_algos().
 * E.g. $return_array = hash_algos();
 * foreach($return_array as $key => $algReturn){ echo $algReturn.'<br>'; }
 *
 * CAUTION :: Some hash_algos returned algorithms will NOT be compatible with hash_hmac()
 * which CRNRSTN :: uses in validating it's decryption. And certain OpenSSL encryption cipher / hash_algos
 * algorithm combinations will not be compatible. Please test the init_session_encryption() compatibility
 * of your desired encryption cipher and hmac algorithm in each environment...especially before releasing
 * to production code base.
 *
 * NOTE :: The available cipher methods can differ between your dev server and your production server! They
 * will depend on the installation and compilation options used for OpenSSL in your machine(s).
 *
 * Example ::
 * $oCRNRSTN->init_tunnel_encryption('LOCALHOST_PC', 'AES-192-OFB', 'this-Is-the-s3cret-encrypti0n-key', OPENSSL_RAW_DATA, 'sha256');               // TOSHIBA M100 [eVifweb] :: RADIOHEAD LAPTOP.
 */
$this->config_init_tunnel_encryption('BLUEHOST_JONY5', 'AES-256-CTR', 'l:pRuxhyg*uuO@(2k}:(:~U6#{qX(f}.', OPENSSL_RAW_DATA, 'ripemd256');
$this->config_init_tunnel_encryption('BLUEHOST_EVIFWEB', 'AES-256-CTR', 'Tkk7TvQ-xeE$c{#D1a6nC#]AV{]A7*Zd', OPENSSL_RAW_DATA, 'ripemd256');
$this->config_init_tunnel_encryption('LOCALHOST_CHAD_MACBOOKPRO', 'AES-192-OFB', '[bP*Tf=B{o0OewI@Nm=A8y7mq72eJ jB', OPENSSL_RAW_DATA, 'sha256');
$this->config_init_tunnel_encryption('LOCALHOST_PC', 'AES-192-OFB', '[YZ3$?pd%[$DROExVDL4O-R)_xW[[T F', OPENSSL_RAW_DATA, 'sha256');

$this->config_init_get_encryption('BLUEHOST_JONY5', 'AES-256-CTR', '?D}@zZ:}7EPwYXcsAy4!f%da@#O#S(A#', OPENSSL_RAW_DATA, 'ripemd256');
$this->config_init_get_encryption('BLUEHOST_EVIFWEB', 'AES-256-CTR', 'rX7ngy-tdV 80n}hlcnJVv{mx*$DL3T{', OPENSSL_RAW_DATA, 'ripemd256');
$this->config_init_get_encryption('LOCALHOST_CHAD_MACBOOKPRO', 'AES-192-OFB', '=[8gC]y(C9r)EXLn%%ZbBO#lb6*~jZqX', OPENSSL_RAW_DATA, 'sha256');
$this->config_init_get_encryption('LOCALHOST_PC', 'AES-192-OFB', 'CrYk%ROwg%2btUyVEAgnjG0vr*QZW1(v', OPENSSL_RAW_DATA, 'sha256');

$this->config_init_post_encryption('BLUEHOST_JONY5', 'AES-256-CTR', 'f2joVqpP}G*qc2HL b8FY*vgG4CroB=g', OPENSSL_RAW_DATA, 'ripemd256');
$this->config_init_post_encryption('BLUEHOST_EVIFWEB', 'AES-256-CTR', '}?tyG?R .JLj-E&2.P. RdI.(5VD%1@d', OPENSSL_RAW_DATA, 'ripemd256');
$this->config_init_post_encryption('LOCALHOST_CHAD_MACBOOKPRO', 'AES-192-OFB', 'z?Pi+6[8!HGIX_[tmy4Y97obWQFur$?&', OPENSSL_RAW_DATA, 'sha256');
$this->config_init_post_encryption('LOCALHOST_PC', 'AES-192-OFB', 'X~s[Az+65*~PVx@nMaD1JDNJ4xARN#@1', OPENSSL_RAW_DATA, 'sha256');

$this->config_init_database_encryption('BLUEHOST_JONY5', 'AES-256-CTR', 'z0}n+2*Xe(zb*_ddphir)VFL)ZuNm.5v', OPENSSL_RAW_DATA, 'ripemd256');
$this->config_init_database_encryption('BLUEHOST_EVIFWEB', 'AES-256-CTR', 'hrkuXz:V+-ZUx:K9vIpKQBXfq4IctRcS', OPENSSL_RAW_DATA, 'ripemd256');
$this->config_init_database_encryption('LOCALHOST_CHAD_MACBOOKPRO', 'AES-192-OFB', 'jIXA{ *+I_Q}rt(vp2B]l!mm6(jC$-f$', OPENSSL_RAW_DATA, 'sha256');
$this->config_init_database_encryption('LOCALHOST_PC', 'AES-192-OFB', '7mGiCkisIImW{}npDu&yk(6fa_gJROH!', OPENSSL_RAW_DATA, 'sha256');

$this->config_init_soap_encryption('BLUEHOST_JONY5', 'AES-256-CTR', '6Jh28hwCug{zetTTx39OvHawva]4ck}M', OPENSSL_RAW_DATA, 'ripemd256');
$this->config_init_soap_encryption('BLUEHOST_EVIFWEB', 'AES-256-CTR', ']O*Jb%6]GV$wm_P4~a~IK3XDF-$jnI=5', OPENSSL_RAW_DATA, 'ripemd256');
$this->config_init_soap_encryption('LOCALHOST_CHAD_MACBOOKPRO', 'AES-192-OFB', 'QMHQ$-oP:Ki7#fM1zYJ&@{aNZA.=nD?o', OPENSSL_RAW_DATA, 'sha256');
$this->config_init_soap_encryption('LOCALHOST_PC', 'AES-192-OFB', '3q?PCqf1*DP4%Z8yQNbp~C&Ln.IeT QU', OPENSSL_RAW_DATA, 'sha256');

$this->config_init_file_encryption('BLUEHOST_JONY5', 'AES-256-CTR', '6Jh00hwCug{zetTTx39OvHawva]4ck}M', OPENSSL_RAW_DATA, 'ripemd256');
$this->config_init_file_encryption('BLUEHOST_EVIFWEB', 'AES-256-CTR', ']O*Jb%6]GV$wm_P447~IK3XDF-$jnI=5', OPENSSL_RAW_DATA, 'ripemd256');
$this->config_init_file_encryption('LOCALHOST_CHAD_MACBOOKPRO', 'AES-192-OFB', 'QMHQ$-oP:Ki7#h21zYJ&@{aNZA.=nD?o', OPENSSL_RAW_DATA, 'sha256');
$this->config_init_file_encryption('LOCALHOST_PC', 'AES-192-OFB', '3q?PCqf1*DP4%Z8yQ0rp~C&Ln.IeT QU', OPENSSL_RAW_DATA, 'sha256');

$this->config_init_oersl_encryption('BLUEHOST_JONY5', 'AES-256-CTR', 'BVRJfa[&{LXyir4Spg$ *fICdXRg4R?L', OPENSSL_RAW_DATA, 'ripemd256');
$this->config_init_oersl_encryption('BLUEHOST_EVIFWEB', 'AES-256-CTR', '-z(ine9+EQlDC@-J#_fkFuTS% JLr xj', OPENSSL_RAW_DATA, 'ripemd256');
$this->config_init_oersl_encryption('LOCALHOST_CHAD_MACBOOKPRO', 'AES-192-OFB', 'rmnQMLYcsFXLW$xEM*]Y)ePH=2ujVkL?', OPENSSL_RAW_DATA, 'sha256');
$this->config_init_oersl_encryption('LOCALHOST_PC', 'AES-192-OFB', '_uvQqbhR97]sPo.WPh{FMS+}Sim9(0d}', OPENSSL_RAW_DATA, 'sha256');