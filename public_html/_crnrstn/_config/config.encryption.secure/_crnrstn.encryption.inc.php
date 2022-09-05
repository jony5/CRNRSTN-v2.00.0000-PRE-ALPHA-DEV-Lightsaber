<?php

/**
 * $oCRNRSTN->init_session_encryption()
 * TODO :: FACILITATE GRACEFUL ROTATION OF THESE ENCRYPTION PROTOCOLS
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
 * $oCRNRSTN->init_session_encryption('LOCALHOST_MACBOOKPRO', 'AES-192-OFB', 'this-Is-the-s3cret-encrypti0n-key', OPENSSL_RAW_DATA, 'sha256');
 */
$this->config_init_session_encryption('BLUEHOST', 'AES-256-CTR', 'this-Is-theession_e-encryption-key', OPENSSL_RAW_DATA, 'ripemd256');
$this->config_init_session_encryption('BLUEHOST_WWW', 'AES-256-CTR', 'this-Is-ession_ethe-encryDption-key', OPENSSL_RAW_DATA, 'ripemd256');
$this->config_init_session_encryption('LOCALHOST_MACBOOKPRO', 'AES-192-OFB', 'this-Is-the-enession_ecrypti0n-key', OPENSSL_RAW_DATA, 'sha256');
$this->config_init_session_encryption('LOCALHOST_CHAD_MACBOOKPRO', 'AES-192-OFB', 'this-Is-theession_e-CHAD-encrypti0n-key', OPENSSL_RAW_DATA, 'sha256');

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
 * $oCRNRSTN->init_cookie_encryption('LOCALHOST_MACBOOKPRO', 'AES-192-OFB', 'this-Is-the-s3cret-encrypti0n-key', OPENSSL_RAW_DATA, 'sha256');
 */
$this->config_init_cookie_encryption('BLUEHOST', 'AES-256-CTR', 'this-Is-tcookie_he-encryption-key', OPENSSL_RAW_DATA, 'ripemd256');
$this->config_init_cookie_encryption('BLUEHOST_WWW', 'AES-256-CTR', 'this-Is-the-encookie_cryption-key', OPENSSL_RAW_DATA, 'ripemd256');
$this->config_init_cookie_encryption('LOCALHOST_MACBOOKPRO', 'AES-256-CTR', 'this-Is-the-encryptiocookie_n-key', OPENSSL_RAW_DATA, 'gost');
$this->config_init_cookie_encryption('LOCALHOST_CHAD_MACBOOKPRO', 'AES-256-CTR', 'this-Is-the-cookie_CHAD-encryption-key', OPENSSL_RAW_DATA, 'gost');
//#$this->config_init_cookie_encryption('LOCALHOST_PC', 'AES-192-OFB', 'this-Is-the-encryption-key', OPENSSL_RAW_DATA, 'sha256');

//
// INITIALIZATION FOR ENCRYPTION :: CRNRSTN :: TUNNELLED DATA :: ADVANCED CONFIGURATION PARAMETERS
/**
 * $oCRNRSTN->init_tunnel_encryption()
 *
 * DESCRIPTION :: Application security and data hygiene can be significantly enhanced with the basic
 * and consistent (only as strong as the weakest link) utilization of the CRNRSTN Suite :: v2.0.0 and its
 * encryption tunneling protocols. Sending data safely server to server (e.g. SOAP) and between the
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
 * $oCRNRSTN->init_tunnel_encryption('LOCALHOST_MACBOOKPRO', 'AES-192-OFB', 'this-Is-the-s3cret-encrypti0n-key', OPENSSL_RAW_DATA, 'sha256');
 */
$this->config_init_tunnel_encryption('BLUEHOST', 'AES-256-CTR', 'this-Is-unnel_the-encryption-key', OPENSSL_RAW_DATA, 'ripemd256');
$this->config_init_tunnel_encryption('BLUEHOST_WWW', 'AES-256-CTR', 'this-Is-d-encryunnel_ption-key', OPENSSL_RAW_DATA, 'ripemd256');
$this->config_init_tunnel_encryption('LOCALHOST_MACBOOKPRO', 'AES-192-OFB', 'hello-therunnel_e-mr-encryption-key', OPENSSL_RAW_DATA, 'sha256');
$this->config_init_tunnel_encryption('LOCALHOST_CHAD_MACBOOKPRO', 'AES-192-OFB', 'hello-unnel_there-mr-CHAD- encryption-key', OPENSSL_RAW_DATA, 'sha256');

$this->config_init_database_encryption('BLUEHOST', 'AES-256-CTR', 'this-Is-thedatabase-encryption-key', OPENSSL_RAW_DATA, 'ripemd256');
$this->config_init_database_encryption('BLUEHOST_WWW', 'AES-256-CTR', 'this-Is-d-thedatabase-key', OPENSSL_RAW_DATA, 'ripemd256');
$this->config_init_database_encryption('LOCALHOST_MACBOOKPRO', 'AES-192-OFB', 'hellothedatabase-there-mr-encryption-key', OPENSSL_RAW_DATA, 'sha256');
$this->config_init_database_encryption('LOCALHOST_CHAD_MACBOOKPRO', 'AES-192-OFB', 'hellothedatabase-there-mr-CHAD- encryption-key', OPENSSL_RAW_DATA, 'sha256');

$this->config_init_soap_encryption('BLUEHOST', 'AES-256-CTR', 'this-Is-thesoap-encryption-key', OPENSSL_RAW_DATA, 'ripemd256');
$this->config_init_soap_encryption('BLUEHOST_WWW', 'AES-256-CTR', 'this-Is-d-thesoape-key', OPENSSL_RAW_DATA, 'ripemd256');
$this->config_init_soap_encryption('LOCALHOST_MACBOOKPRO', 'AES-192-OFB', 'hellothsoapase-there-mr-encryption-key', OPENSSL_RAW_DATA, 'sha256');
$this->config_init_soap_encryption('LOCALHOST_CHAD_MACBOOKPRO', 'AES-192-OFB', 'hellothsoapase-there-mr-CHAD- encryption-key', OPENSSL_RAW_DATA, 'sha256');

$this->config_init_OERSL_encryption('BLUEHOST', 'AES-256-CTR', 'this-Is-the-en_OERSLcryption-key', OPENSSL_RAW_DATA, 'ripemd256');
$this->config_init_OERSL_encryption('BLUEHOST_WWW', 'AES-256-CTR', 'this-Is-d_OERSL-encryption-key', OPENSSL_RAW_DATA, 'ripemd256');
$this->config_init_OERSL_encryption('LOCALHOST_MACBOOKPRO', 'AES-192-OFB', 'hello-there-m_OERSLr-encryption-key', OPENSSL_RAW_DATA, 'sha256');
$this->config_init_OERSL_encryption('LOCALHOST_CHAD_MACBOOKPRO', 'AES-192-OFB', 'hello-th_OERSLere-mr-CHAD- encryption-key', OPENSSL_RAW_DATA, 'sha256');