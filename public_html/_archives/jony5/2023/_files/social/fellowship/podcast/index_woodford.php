<?php
/* 
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
include_once($CRNRSTN_ROOT . '_crnrstn.config.inc.php');
#phpinfo();

#$oENV->oCOOKIE_MGR->addCookie("loginPersist", "This is my cookie data1", time()+60*60*24*100, '/');
$oENV->oCOOKIE_MGR->addEncryptedCookie("loginPersist", "This is my cookie data9", time()+60*60*24*100, '/');


$tstCookie_data = $oENV->oCOOKIE_MGR->getEncryptedCookie("loginPersist");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
</head>

<body>
<?php

echo "DOCUMENT_ROOT: ".$_SERVER['DOCUMENT_ROOT']."<br>";
echo "SERVER_NAME: ".$_SERVER['SERVER_NAME']."<br>";
echo "SERVER_ADDR: ".$_SERVER['SERVER_ADDR']."<br>";
echo "SERVER_PORT: ".$_SERVER['SERVER_PORT']."<br>";
echo "SERVER_PROTOCOL: ".$_SERVER['SERVER_PROTOCOL']."<br>";
echo "REMOTE_ADDR: ".$_SERVER['REMOTE_ADDR']."<br><br>";


print_r("<br><br> A few parameters extracted from CRNRSTN Configuration file for the running environment :<br>");
print_r('DOCUMENT_ROOT :: '.$oENV->getEnvParam('DOCUMENT_ROOT').'<br>DOCUMENT_ROOT_DIR :: '.$oENV->getEnvParam('DOCUMENT_ROOT_DIR').'<br>');
print_r('SERVER_NAME :: '.$oENV->getEnvParam('SERVER_NAME').'<br>');
print_r('SERVER_PORT :: '.$oENV->getEnvParam('SERVER_PORT').'<br>');
print_r('DATA_MODE :: '.$oENV->getEnvParam('DATA_MODE').'<br>');
print_r("<br>---<br><br>");

//
// DATABASE TESTING. DATABASE CONNECTIVITY PARAMS MANAGED BY CRNRSTN.
$mysqli = $oENV->oMYSQLI_CONN_MGR->returnConnection();
//$mysqli = new mysqli("localhost", "jony5_prod01", "-AqBmF_DHaD9", "jony5_prod01", "3306");


/*
 * This is the "official" OO way to do it,
 * BUT $connect_error was broken until PHP 5.2.9 and 5.3.0.
 */
if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') '
            . $mysqli->connect_error);
}



//$query = 'SELECT `crnrstn_class`.`CLASSID`,`crnrstn_class`.`NAME`,`crnrstn_class`.`URI`,`crnrstn_class`.`LANGCODE`,`crnrstn_method`.`METHODID`,`crnrstn_method`.`NAME`,`crnrstn_method`.`URI`,`crnrstn_method`.`ISACTIVE` FROM `crnrstn_class` LEFT OUTER JOIN `crnrstn_method` ON `crnrstn_class`.`CLASSID` = `crnrstn_method`.`CLASSID` WHERE `crnrstn_class`.`ISACTIVE`="1" ORDER BY `crnrstn_class`.`NAV_POSITION`,
//`crnrstn_method`.`NAV_POSITION`;';

$query = 'SELECT `lsm_podcast_daily`.`TITLE`,`lsm_podcast_daily`.`URI` FROM `lsm_podcast_daily`';

$queryType = "TEST QUERY";

//
// CRNRSTN MYSQLI CONNECTION MANAGER TO PROCESS QUERY AND RETURN DATABASE RESULT.
$result = $oENV->oMYSQLI_CONN_MGR->processMultiQuery($mysqli, $query);	// PROCESS MULTI QUERY AND RETURN FIRST RESULT SET OR FALSE

if($mysqli->error){
	throw new Exception('CRNRSTN database_integration :: '.$queryType.' ERROR :: ['.$mysqli->error.']');
	
	
}else{
	if ($result) {	
		do {

				while ($row = $result->fetch_row()) {
					printf("%s\n", $row[1]);
				}
				$result->free();

			/* print divider */
			if ($mysqli->more_results()) {
				printf("-----------------\n");
			}
		} while ($mysqli->next_result());
	}	
	
}


//
// CLOSE CONNECTION
$oENV->oMYSQLI_CONN_MGR->closeConnection($mysqli);


//
// SOURCE MATERIAL
# http://php.net/manual/en/function.openssl-encrypt.php

//
// TO BE DEFINED IN THE CONFIG FILE
$plaintext = "message to be encrypted";

//$encryptionCipher = "AES-128-CBC";
$encryptionCipher = "blowfish";
$key = "123456789abcdefgh";
$opensslEncryptDecryptOptions = OPENSSL_RAW_DATA;
$hmac_algorithm = "gost";

//
// Function Source ::
// http://php.net/manual/en/function.hash-equals.php
// To transparently support this function on older versions of PHP use this:
if(!function_exists('hash_equals')) {
  function hash_equals($str1, $str2) {
    if(strlen($str1) != strlen($str2)) {
      return false;
    } else {
      $res = $str1 ^ $str2;
      $ret = 0;
      for($i = strlen($res) - 1; $i >= 0; $i--) $ret |= ord($res[$i]);
      return !$ret;
    }
  }
}

//
// DYNAMIC CALCULATIONS
$ivlen = openssl_cipher_iv_length($cipher=$encryptionCipher);
$iv = openssl_random_pseudo_bytes($ivlen);
$ciphertext_raw = openssl_encrypt($plaintext, $encryptionCipher, $key, $options=$opensslEncryptDecryptOptions, $iv);
$hmac = hash_hmac($hmac_algorithm, $ciphertext_raw, $key, $as_binary=true);
$ciphertext = base64_encode( $iv.$hmac.$ciphertext_raw );

//decrypt later....
$c = base64_decode($ciphertext);
$ivlen = openssl_cipher_iv_length($cipher=$encryptionCipher);
$iv = substr($c, 0, $ivlen);
$hmac = substr($c, $ivlen, $sha2len=32);
$ciphertext_raw = substr($c, $ivlen+$sha2len);
$original_plaintext = openssl_decrypt($ciphertext_raw, $encryptionCipher, $key, $options=$opensslEncryptDecryptOptions, $iv);
$calcmac = hash_hmac($hmac_algorithm, $ciphertext_raw, $key, $as_binary=true);

if (hash_equals($hmac, $calcmac))//PHP 5.6+ timing attack safe comparison
{
    echo "<br><br>".$original_plaintext."\n";
}else{
	echo "Oops. Something went wrong. Hash_equals comparison failed...<br>\n";	
}

echo '<br><br>//<a href="./__total_purge.php">session purge</a>';
echo "<hr>";

#####################
#####################
echo '<br><br>List of appropriate ciphers and aliases for openssl_decrypt()/openssl_encrypt() from openssl_get_cipher_methods() ::<br>';
print_r($oENV->openssl_get_cipher_methods());

echo '<br><br>List of avaliable hash_algos() for use in hash_hmac() ::<br>';
#print_r(hash_hmac_algos());
print_r(hash_algos());
echo "<hr>";
echo 'MD5 Hash Test ::<br><br>';
echo $tstCookie_data;
echo '<br><br>';
echo md5($tstCookie_data, false);
echo '<br><br>';
print_r($oENV->oHTTP_MGR->extractData($_GET,"hello"));



if($oENV->oSESSION_MGR->issetSessionParam("DOCUMENT_ROOT_DIR")){
	print_r("<br><br>(167) param is set in session.<br>");	
}else{
	print_r("<br><br>(169) param is NOT set in session.<br>");
}


print_r($oENV->oHTTP_MGR->getHeaders());





#error_log("index has run to end of file...(226)");
?>
</body>
</html>