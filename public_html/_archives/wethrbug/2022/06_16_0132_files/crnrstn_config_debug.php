<?php
/*
// J5
// Code is Poetry */
#  CRNRSTN Suite :: An Open Source PHP Class Library to facilitate the operation of an application across multiple hosting environments.
#  Copyright (C) 2012-2018 eVifweb Development
#  VERSION :: 1.0.1
#  RELEASE DATE (v1.0.0) :: July 4, 2018 - Happy Independence Day from my dog and I to you...wherever and whenever you are.
#  AUTHOR :: Jonathan 'J5' Harris, CEO, CTO, Lead Full Stack Developer.
#  URI :: http://crnrstn.evifweb.com/
#  OVERVIEW :: CRNRSTN is an open source PHP class library that facilitates the operation of an application within multiple server 
#		environments (e.g. localhost, stage, preprod, and production). With this tool, data and functionality with 
#		characteristics that inherently create distinctions from one environment to the next...such as IP address restrictions, 
#		error logging profiles, and database authentication credentials...can all be managed through one framework for an entire 
#		application. Once CRNRSTN has been configured for your different hosting environments, seamlessly release a web 
#		application from one environment to the next without having to change your code-base to account for environmentally 
#		specific parameters; and manage this all from one place within the CRNRSTN Suite ::

#  MIT LICENSE :: Copyright 2018 Jonathan J5 Harris
#		Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated 
#		documentation files (the "Software"), to deal in the Software without restriction, including without limitation the 
#		rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to 
#		permit persons to whom the Software is furnished to do so, subject to the following conditions:

#		The above copyright notice and this permission notice shall be included in all copies or substantial portions 
#		of the Software.

#		THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE 
#		WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS 
#		OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT 
#		OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.ncluding without limitation the rights to use, copy, 
#			  modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the 
#			  Software is furnished to do so, subject to the following conditions:

#			  The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

#			  THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE 
#			  WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT 
#			  HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, 
#			  OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.

require('_crnrstn.root.inc.php');
include_once($CRNRSTN_ROOT . '_crnrstn.config.inc.php');

//
// ADD A COOKIE
$oCRNRSTN_ENV->oCOOKIE_MGR->addCookie("loginPersist", "This is my cookie data!", time()+60*60*24*100);


# #
# SOURCE
# http://patorjk.com/software/taag/#p=display&f=Doh&t=CRNRSTN%20%3A%3A
$tmp_crnrstnART[0] = '      ___           <span class="the_R">___</span>           ___           ___           ___                         ___              
     /\__\         <span class="the_R">/\  \</span>         /\  \         /\  \         /\__\                       /\  \             
    /:/  /        <span class="the_R">/::\  \</span>        \:\  \       /::\  \       /:/ _/_         ___          \:\  \            
   /:/  /        <span class="the_R">/:/\:\__\</span>        \:\  \     /:/\:\__\     /:/ /\  \       /\__\          \:\  \      ::::::  ::::::           
  /:/  /  ___   <span class="the_R">/:/ /:/  /</span>    _____\:\  \   /:/ /:/  /    /:/ /::\  \     /:/  /      _____\:\  \     ::::::  ::::::          
 /:/__/  /\__\ <span class="the_R">/:/_/:/__/</span>___ /::::::::\__\ /:/_/:/__/___ /:/_/:/\:\__\   /:/__/      /::::::::\__\         
 \:\  \ /:/  / <span class="the_R">\:\/:::::/  / </span>\:\~~\~~\/__/ \:\/:::::/  / \:\/:/ /:/  /  /::\  \      \:\~~\~~\/__/         
  \:\  /:/  /   <span class="the_R">\::/~~/~~~~</span>   \:\  \        \::/~~/~~~~   \::/ /:/  /  /:/\:\  \      \:\  \          ::::::  ::::::         
   \:\/:/  /     <span class="the_R">\:\~~\</span>        \:\  \        \:\~~\        \/_/:/  /   \/__\:\  \      \:\  \         ::::::  ::::::          
    \::/  /       <span class="the_R">\:\__\</span>        \:\__\        \:\__\         /:/  /         \:\__\      \:\__\             
     \/__/         <span class="the_R">\/__/</span>         \/__/         \/__/         \/__/           \/__/       \/__/      
	 

';

$tmp_crnrstnART[1] = '        CCCCCCCCCCCCC<span class="the_R">RRRRRRRRRRRRRRRRR</span>   NNNNNNNN        NNNNNNNNRRRRRRRRRRRRRRRRR      SSSSSSSSSSSSSSS TTTTTTTTTTTTTTTTTTTTTTTNNNNNNNN        NNNNNNNN
     CCC::::::::::::C<span class="the_R">R::::::::::::::::R</span>  N:::::::N       N::::::NR::::::::::::::::R   SS:::::::::::::::ST:::::::::::::::::::::TN:::::::N       N::::::N
   CC:::::::::::::::C<span class="the_R">R::::::RRRRRR:::::R</span> N::::::::N      N::::::NR::::::RRRRRR:::::R S:::::SSSSSS::::::ST:::::::::::::::::::::TN::::::::N      N::::::N
  C:::::CCCCCCCC::::C<span class="the_R">RR:::::R     R:::::R</span>N:::::::::N     N::::::NRR:::::R     R:::::RS:::::S     SSSSSSST:::::TT:::::::TT:::::TN:::::::::N     N::::::N
 C:::::C       CCCCCC  <span class="the_R">R::::R     R:::::R</span>N::::::::::N    N::::::N  R::::R     R:::::RS:::::S            TTTTTT  T:::::T  TTTTTTN::::::::::N    N::::::N
C:::::C                <span class="the_R">R::::R     R:::::R</span>N:::::::::::N   N::::::N  R::::R     R:::::RS:::::S                    T:::::T        N:::::::::::N   N::::::N      ::::::  ::::::
C:::::C                <span class="the_R">R::::RRRRRR:::::R</span> N:::::::N::::N  N::::::N  R::::RRRRRR:::::R  S::::SSSS                 T:::::T        N:::::::N::::N  N::::::N      ::::::  ::::::
C:::::C                <span class="the_R">R:::::::::::::RR</span>  N::::::N N::::N N::::::N  R:::::::::::::RR    SS::::::SSSSS            T:::::T        N::::::N N::::N N::::::N      ::::::  ::::::
C:::::C                <span class="the_R">R::::RRRRRR:::::R</span> N::::::N  N::::N:::::::N  R::::RRRRRR:::::R     SSS::::::::SS          T:::::T        N::::::N  N::::N:::::::N
C:::::C                <span class="the_R">R::::R</span>     <span class="the_R">R:::::R</span>N::::::N   N:::::::::::N  R::::R     R:::::R       SSSSSS::::S         T:::::T        N::::::N   N:::::::::::N
C:::::C                <span class="the_R">R::::R</span>     <span class="the_R">R:::::R</span>N::::::N    N::::::::::N  R::::R     R:::::R            S:::::S        T:::::T        N::::::N    N::::::::::N
 C:::::C       CCCCCC  <span class="the_R">R::::R</span>     <span class="the_R">R:::::R</span>N::::::N     N:::::::::N  R::::R     R:::::R            S:::::S        T:::::T        N::::::N     N:::::::::N      ::::::  ::::::
  C:::::CCCCCCCC::::C<span class="the_R">RR:::::R</span>     <span class="the_R">R:::::R</span>N::::::N      N::::::::NRR:::::R     R:::::RSSSSSSS     S:::::S      TT:::::::TT      N::::::N      N::::::::N      ::::::  ::::::
   CC:::::::::::::::C<span class="the_R">R::::::R</span>     <span class="the_R">R:::::R</span>N::::::N       N:::::::NR::::::R     R:::::RS::::::SSSSSS:::::S      T:::::::::T      N::::::N       N:::::::N      ::::::  ::::::
     CCC::::::::::::C<span class="the_R">R::::::R</span>     <span class="the_R">R:::::R</span>N::::::N        N::::::NR::::::R     R:::::RS:::::::::::::::SS       T:::::::::T      N::::::N        N::::::N
        CCCCCCCCCCCCC<span class="the_R">RRRRRRRR</span>     <span class="the_R">RRRRRRR</span>NNNNNNNN         NNNNNNNRRRRRRRR     RRRRRRR SSSSSSSSSSSSSSS         TTTTTTTTTTT      NNNNNNNN         NNNNNNN
                                                                                                                                                       

';

$tmp_crnrstnART[2]= '

 ######  <span class="the_R">########</span>  ##    ## ########   ######  ######## ##    ##     ##   ##  
##    ## <span class="the_R">##     ##</span> ###   ## ##     ## ##    ##    ##    ###   ##    #### #### 
##       <span class="the_R">##     ##</span> ####  ## ##     ## ##          ##    ####  ##     ##   ##  
##       <span class="the_R">########</span>  ## ## ## ########   ######     ##    ## ## ##              
##       <span class="the_R">##   ##</span>   ##  #### ##   ##         ##    ##    ##  ####     ##   ##  
##    ## <span class="the_R">##    ##</span>  ##   ### ##    ##  ##    ##    ##    ##   ###    #### #### 
 ######  <span class="the_R">##     ##</span> ##    ## ##     ##  ######     ##    ##    ##     ##   ##  


';

$tmp_crnrstnART[3] = '

                                                                                         
   _|_|_|  <span class="the_R">_|_|_|</span>    _|      _|  _|_|_|      _|_|_|  _|_|_|_|_|  _|      _|              
 _|        <span class="the_R">_|    _|</span>  _|_|    _|  _|    _|  _|            _|      _|_|    _|      _|  _|  
 _|        <span class="the_R">_|_|_|</span>    _|  _|  _|  _|_|_|      _|_|        _|      _|  _|  _|              
 _|        <span class="the_R">_|    _|</span>  _|    _|_|  _|    _|        _|      _|      _|    _|_|              
   _|_|_|  <span class="the_R">_|    _|</span>  _|      _|  _|    _|  _|_|_|        _|      _|      _|      _|  _|  
                                                                                         
                                                                                         

';


?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>CRNRSTN Suite :: Configuration Debug</title>
<style type="text/css">
	body						{ margin:0;font-size:.7em; font-family:Arial, Helvetica, sans-serif; background:#EEE;}
	#content_wrapper			{ width:100%; text-align:center; margin:0px auto;}
	#mini_nav_wrapper			{ width:590px; text-align:center; margin:0px auto;}
	.mini_nav_lnk				{ float:left; padding-right:9px;}
	.topAnchor_lnk				{ padding:15px; float:right;}
	#content_main				{ width:800px; text-align:center; margin:0px auto;}
	#page_title					{ font-size:25px; padding-bottom:10px; padding-top:5px;}
	#sess_clear_link			{ text-align:center; margin:0px auto;}
	#sess_id					{ font-family:"Courier New", Courier, monospace; padding-top:5px;}
	.the_R						{ color:#F00;}
	.hr							{ width:90%; text-align:center; margin:0px auto; border-bottom:2px dashed #06F;}
	.svr_elem_scroll			{ height:200px; overflow-y:scroll;}
	#server_param_overview		{ font-size:13px; text-align:left; padding:5px 20px 10px 20px; line-height:19px;}
	#server_params_wrapper		{ border:3px solid #F00; width:750px; text-align:center; margin:0px auto;}
	.server_param				{ text-align:left; padding:5px 10px 2px 20px;}
	.server_param_best			{ text-align:left; padding:5px 10px 2px 20px; font-weight:bold; color:#900; font-size:13px;}
	.red						{ font-weight:bold; color:#900; font-size:13px;}
	.copy_wrapper				{ width:750px; text-align:center; margin:0px auto;}
	.copy						{ text-align:left; padding:0 10px 10px 10px; font-size:13px; line-height:18px;}
	.underL						{ text-decoration:underline;}
	.crnrstn_param				{ text-align:left; padding:5px 10px 12px 20px;}
	
	#crnrstn_params_wrapper		{ border:3px solid #06F; width:750px; text-align:center; margin:0px auto;}
	#crnrstn_param_overview		{ font-size:13px; text-align:left; padding:5px 20px 0 20px; line-height:19px;}
	
	#crnrstn_test_wrapper		{ border:3px solid #009000; width:750px; text-align:center; margin:0px auto;}
	#crnrstn_test_overview		{ font-size:13px; text-align:left; padding:5px 20px 0 20px; line-height:19px;}
	
	#crnrstn_algo_wrapper		{ border:3px solid #F90; width:750px; text-align:center; margin:0px auto;}
	#crnrstn_algo_overview		{ font-size:13px; text-align:left; padding:5px 20px 0 20px; line-height:19px;}
	
	#crnrstn_hash_wrapper		{ border:3px solid #00FFF7; width:750px; text-align:center; margin:0px auto;}
	#crnrstn_hash_overview		{ font-size:13px; text-align:left; padding:5px 20px 0 20px; line-height:19px;}
	
	#crnrstn_db_wrapper			{ border:3px solid #F100DB; width:750px; text-align:center; margin:0px auto;}
	#crnrstn_db_overview		{ font-size:13px; text-align:left; padding:5px 20px 0 20px; line-height:19px;}
	
	.debug_output				{ font-size:10px;height:400px;overflow:scroll;border-bottom:2px solid #333;padding-bottom:10px;}
	
	#ftr_cw						{ text-align:center; font-size:11px; color:#333; padding:20px 0 30px 0;}
	
	.cb_5						{ display:block; clear:both; height:5px;  line-height:1px; overflow:hidden; border:0px; padding:0px; margin:0px; font-size:1px;}
	.cb_10						{ display:block; clear:both; height:10px;  line-height:1px; overflow:hidden; border:0px; padding:0px; margin:0px; font-size:1px;}
	.cb_20						{ display:block; clear:both; height:20px;  line-height:1px; overflow:hidden; border:0px; padding:0px; margin:0px; font-size:1px;}
</style>
</head>

<body>
<a name="debugTop"></a>
<div id="content_wrapper">
	<div id="content_main">
    	<div id="page_title">C<span class="the_R">R</span>NRSTN Suite :: Configuration Debug</div>
        <div id="mini_nav_wrapper">
        	<div class="mini_nav_lnk"><a href="#configConfirm">Confirmation</a></div>
        	<div class="mini_nav_lnk"><a href="#debugOutput">Debug Output</a></div>
        	<div class="mini_nav_lnk"><a href="#opensslCiphers">Available OpenSSL Ciphers</a></div>
            <div class="mini_nav_lnk"><a href="#hashAlgo">Available Hash Algorithms</a></div>
            <div class="mini_nav_lnk"><a href="#dbTest">Database Configuration Test</a></div>
            <div class="cb_5"></div>
        </div>
        <div id="sess_clear_link"><a href="_crnrstn_config_purge.php" target="_self">clear session data</a> to reconfigure C<span class="the_R">R</span>NRSTN with any updated configuration file settings.</div>
        <div id="sess_id"><span style="font-family:Arial, Helvetica, sans-serif;">session id =</span> <?php echo session_id(); ?></div>
        <div class="cb_10"></div>
        <div id="server_params_wrapper">
        	<div id="server_param_overview"><strong>$_SERVER DATA ::</strong><br>Use at least one (1) SERVER param + value below by passing the resourceKey and resourceValue into <a href="http://crnrstn.evifweb.com/documentation/classes/crnrstn/defineenvresource/" target="_blank">defineEnvResource()</a> in the C<span class="the_R">R</span>NRSTN Suite :: configuration file <em>_crnrstn.config.inc.php</em> to configure C<span class="the_R">R</span>NRSTN for this environment. The resource definition section begins on line 250 of the config file. Of particular interest would be the $_SERVER variables that will differ from one environment to the next (e.g. <span class="underL">scroll down to see <span class="red">red items</span> below</span>).
            </div>
            <div class="hr"></div>
            <div class="svr_elem_scroll">
        	<?php
				foreach($_SERVER as $key=>$value){
					switch($key){
						case 'SERVER_NAME':
						case 'SERVER_ADDR':
						case 'DOCUMENT_ROOT':
							$tmp_class = "server_param_best";
						break;
						default:
							$tmp_class = "server_param";
						break;
						
					}
					
					echo '<div class="'.$tmp_class.'">'.$key." = ".$value."</div>";
				}
			?>
            </div>
            <div class="cb_5"></div>
        </div>
        <div class="cb_10"></div>
        <div class="copy_wrapper">
        	<div class="copy">
        * To optimize the C<span class="the_R">R</span>NRSTN configuration process at first run time, enter the number of $_SERVER params (above) that you will be using for environmental detection (<strong class="red">every environment from localhost to production should be parallel with respect to the $_SERVER params defined</strong>) into $oCRNRSTN->requiredDetectionMatches() in the config file...the first environment to get this number of $_SERVER matches will be chosen and the remainder of the configuration process can be accelerated. Also, it is recommended that you define the resources for your production environment first so that that environment will be the fastest on first load.
        	</div>
        </div>
        <div class="cb_10"></div>
        <a name="configConfirm"></a>
        <div id="crnrstn_params_wrapper">
        	<div class="topAnchor_lnk"><a href="#debugTop">top</a></div>
        	<div id="crnrstn_param_overview"><strong>C<span class="the_R">R</span>NRSTN SUITE CONFIGURATION CONFIRMATION ::</strong><br>If <em>"SERVER_NAME = <?php echo $_SERVER['SERVER_NAME'] ?>"</em> does not load below, check your error logs for captured C<span class="the_R">R</span>NRSTN notifications. This test is expecting that <strong>SERVER_NAME</strong> has been configured through <a href="http://crnrstn.evifweb.com/documentation/classes/crnrstn/defineenvresource/" target="_blank">defineEnvResource()</a> for this environment:</div>
        	<div class="cb_5"></div>
            <div class="crnrstn_param">SERVER_NAME = <?php echo $oCRNRSTN_ENV->getEnvParam('SERVER_NAME'); ?></div>
    		<div class="crnrstn_param"><strong>Error reporting on the following types in this environment:</strong><br><?php 
		
				# SOURCE :: http://php.net/manual/en/errorfunc.constants.php#109430
				$errLvl = error_reporting(); 
				for ($i = 0; $i < 15;  $i++ ) { 
					print FriendlyErrorType($errLvl & pow(2, $i)) . "<br>"; 
				} 
				
				function FriendlyErrorType($type) 
				{ 
					switch($type) 
					{ 
						case E_ERROR: // 1 // 
							return 'E_ERROR'; 
						case E_WARNING: // 2 // 
							return 'E_WARNING'; 
						case E_PARSE: // 4 // 
							return 'E_PARSE'; 
						case E_NOTICE: // 8 // 
							return 'E_NOTICE'; 
						case E_CORE_ERROR: // 16 // 
							return 'E_CORE_ERROR'; 
						case E_CORE_WARNING: // 32 // 
							return 'E_CORE_WARNING'; 
						case E_COMPILE_ERROR: // 64 // 
							return 'E_COMPILE_ERROR'; 
						case E_COMPILE_WARNING: // 128 // 
							return 'E_COMPILE_WARNING'; 
						case E_USER_ERROR: // 256 // 
							return 'E_USER_ERROR'; 
						case E_USER_WARNING: // 512 // 
							return 'E_USER_WARNING'; 
						case E_USER_NOTICE: // 1024 // 
							return 'E_USER_NOTICE'; 
						case E_STRICT: // 2048 // 
							return 'E_STRICT'; 
						case E_RECOVERABLE_ERROR: // 4096 // 
							return 'E_RECOVERABLE_ERROR'; 
						case E_DEPRECATED: // 8192 // 
							return 'E_DEPRECATED'; 
						case E_USER_DEPRECATED: // 16384 // 
							return 'E_USER_DEPRECATED'; 
					} 
					return ""; 
				} 
		
		
		?></div>
        </div>
        
    </div>
</div>

<!-- BEGIN DEBUG OUTPUT-->
<a name="debugOutput"></a>
<div class="topAnchor_lnk" style="float:none; text-align:center; margin:0px auto;"><a href="#debugTop">top</a></div>
<h2>C<span class="the_R">R</span>NRSTN Debug Output ::</h2>
<?php

if($oCRNRSTN_ENV->debugMode<1){
	echo '<p><pre class="debug_output">Debug MODE = 0. No output to display.<br><br>';
	echo $tmp_crnrstnART[rand ( 0 , 3)];
	echo '</pre></p>';
}
	
if($oCRNRSTN_ENV->debugMode>0){																									 
																										 
?>
<p><pre class="debug_output"><?php echo htmlspecialchars($oCRNRSTN_ENV->getDebug(), ENT_QUOTES); ?><br><br><?php echo $tmp_crnrstnART[rand ( 0 , 3)];  ?></pre></p>
<?php
}

?>

<!-- END DEBUG OUTPUT-->

<div id="crnrstn_test_wrapper">
	<div id="crnrstn_test_overview"><strong>C<span class="the_R">R</span>NRSTN TESTING ::</strong> <a href="_crnrstn_config_purge.php" target="_self">clear session data</a></div>
    
    <div class="crnrstn_param">
    <?php
	if($oCRNRSTN_ENV->oSESSION_MGR->issetSessionParam("USER_SIGNON_STATUS")){
		echo "Demo session param USER_SIGNON_STATUS is set to: ".$oCRNRSTN_ENV->oSESSION_MGR->getSessionParam("USER_SIGNON_STATUS").".";
	}else{
		echo "Demo session param USER_SIGNON_STATUS is not set. Submit the form below to initialize this parameter in session.";	
	}
	?>
    </div>
    
    <div class="crnrstn_param">
    <?php
	if($oCRNRSTN_ENV->oHTTP_MGR->issetHTTP($_GET)){
		echo 'C<span class="the_R">R</span>NRSTN has detected that there is GET data to process.<br>';
	}else{
		echo 'C<span class="the_R">R</span>NRSTN has not detected any GET data for processing.<br>';
	}
	?>
    
    </div>
	
    <div class="crnrstn_param">
    <?php
	if($oCRNRSTN_ENV->oHTTP_MGR->issetHTTP($_POST)){
		echo 'C<span class="the_R">R</span>NRSTN has detected that there is POST data to process.<br>';
		
		if($oCRNRSTN_ENV->oHTTP_MGR->issetParam($_POST,"firstname")){
			echo 'The POST parameter "firstname" contains the data:<br> <strong>'.$oCRNRSTN_ENV->oHTTP_MGR->extractData($_POST,"firstname").'</strong>.<br>';	
		}else{
			echo 'The POST parameter "firstname" has no data.<br>';
		}
		
		echo '<br>Initializing a demo session parameter "USER_SIGNON_STATUS" with value "ACTIVE".';
		$oCRNRSTN_ENV->oSESSION_MGR->setSessionParam("USER_SIGNON_STATUS","ACTIVE");
	}else{
		echo 'C<span class="the_R">R</span>NRSTN has not detected any POST data for processing.<br>';
	}
	?>
	</div>
    
    <div class="crnrstn_param">
    <?php
	
	//
	// IT IS RECOMMENDED THAT YOU LEVERAGE THE CRNRSTN SUITE CONFIG FUNCTIONALITY TO 
	// SIMPLIFY THE MANAGEMENT OF DENIAL IP IN YOUR APPLICATION TO ONE PLACE.
	// HERE, DENIED_ACCESS_IP HAS BEEN CONFIGURED TO STORE THE DENIAL IP IN THE 
	// CRNRSTN CONFIG FILE THROUGH defineEnvResource() 
	//if($oCRNRSTN_ENV->oCRNRSTN_IPSECURITY_MGR->denyIPAccess($oCRNRSTN_ENV->getEnvParam('DENIED_ACCESS_IP'))){
	if($oCRNRSTN_ENV->oCRNRSTN_IPSECURITY_MGR->denyIPAccess('*.*')){
		echo "IP address processed by denyIPAccess(). Access Denial = YES";
	}else{
		echo "IP address processed by denyIPAccess(). Access Denial = NO";
	}
	
	?>
    </div>
    
    <div class="crnrstn_param">
    <?php
	
	//  http://172.16.110.134/evifweb/crnrstn_config_debug.php
	// IT IS RECOMMENDED THAT YOU LEVERAGE THE CRNRSTN SUITE CONFIG FUNCTIONALITY TO 
	// SIMPLIFY THE MANAGEMENT OF IP ACCESS IN YOUR APPLICATION.
	// HERE, AUTH_ACCESS_IP HAS BEEN CONFIGURED TO STORE THE ACCESS AUTH IP IN THE 
	// CRNRSTN CONFIG FILE THROUGH defineEnvResource()
	//if($oCRNRSTN_ENV->oCRNRSTN_IPSECURITY_MGR->exclusiveAccess($oCRNRSTN_ENV->getEnvParam('AUTH_ACCESS_IP'))){
	#if($oCRNRSTN_ENV->oCRNRSTN_IPSECURITY_MGR->exclusiveAccess('0.0.0.1-255.255.255.255')){
	if($oCRNRSTN_ENV->oCRNRSTN_IPSECURITY_MGR->exclusiveAccess('2600:1700:fed0:7ce0:c442:8ab4:8dc0:7b2f,108.210.7.32')){
		echo "IP address processed by exclusiveAccess(). Grant exclusive access = YES";
	}else{
		echo "IP address processed by exclusiveAccess(). IP not given exclusive access. Deny access to ".$_SERVER['REMOTE_ADDR']." = YES";
	}
	?>
    </div>
    
    <div class="crnrstn_param">
    <hr>
    <br>Test the C<span class="the_R">R</span>NRSTN HTTP manager POST processing:
    <div class="cb_10"></div>
    <form action="#" method="post" enctype="multipart/form-data">
    First name:<br>
    <input type="text" name="firstname" value="">
    <div class="cb_10"></div>
    Last name:<br>
    <input type="text" name="lastname" value=""><br>
    <br>
    <input type="submit" value="Submit">
    </form>
    
    </div>

</div>

<div class="cb_20"></div>
<a name="opensslCiphers"></a>
<div id="crnrstn_algo_wrapper">
	<div class="topAnchor_lnk"><a href="#debugTop">top</a></div>
	<div id="crnrstn_algo_overview"><strong>SERVER's Available OpenSSL Ciphers ::</strong><br>Here is a list of available ciphers and aliases that can be passed into <a href="http://crnrstn.evifweb.com/documentation/classes/crnrstn/initsessionencryption/" target="_blank">initSessionEncryption()</a> and <a href="http://crnrstn.evifweb.com/documentation/classes/crnrstn/initcookieencryption/" target="_blank">initCookieEncryption()</a> as the <em>$opensslEncryptCipher</em> parameter to enable execution of  openssl_decrypt()/openssl_encrypt().</div>
	<div class="cb_10"></div>
    <div class="hr"></div>
    <div class="svr_elem_scroll">
    <?php
	//print_r($oCRNRSTN_ENV->openssl_get_cipher_methods());
	$tmp_array = $oCRNRSTN_ENV->openssl_get_cipher_methods();
	foreach($tmp_array as $key1=>$data1){
		echo '<div class="server_param">'.$data1."</div>";
	}
	?>
    <div class="cb_10"></div>
	</div>
</div>

<div class="cb_20"></div>
<a name="hashAlgo"></a>
<div id="crnrstn_hash_wrapper">
	<div class="topAnchor_lnk"><a href="#debugTop">top</a></div>
	<div id="crnrstn_hash_overview"><strong>SERVER's Available Hash Algorithms ::</strong><br>Here is a list of available hash algorithms that can be passed into <a href="http://crnrstn.evifweb.com/documentation/classes/crnrstn/initsessionencryption/" target="_blank">initSessionEncryption()</a> and <a href="http://crnrstn.evifweb.com/documentation/classes/crnrstn/initcookieencryption/" target="_blank">initCookieEncryption()</a> as the <em>$hmacAlg</em> parameter to be used by C<span class="the_R">R</span>NRSTN when using the HMAC library to generate a keyed hash value.</div>	
	<div class="cb_10"></div>
    <div class="hr"></div>
    <div class="svr_elem_scroll">
    <?php
	//print_r(hash_algos());
	$tmp_array = hash_algos();
	foreach($tmp_array as $key1=>$data1){
		echo '<div class="server_param">'.$data1."</div>";
	}	
	
	?>
    <div class="cb_10"></div>
    </div>

</div>

<div class="cb_20"></div>
<a name="dbTest"></a>
<div id="crnrstn_db_wrapper">
	<div class="topAnchor_lnk"><a href="#debugTop">top</a></div>
	<div id="crnrstn_db_overview"><strong>Database Configuration Test ::</strong><br>
    Update the queries in this test to align them to a table(s) in your database. Ensure that the database authentication profile for this environment has been configured through the execution of <a href="http://crnrstn.evifweb.com/documentation/classes/crnrstn/adddatabase/" target="_blank">addDatabase()</a> in your C<span class="the_R">R</span>NRSTN Suite ::<br>configuration file.<br><br>Multi-query being sent to the database:
    </div>
    
    
    <?php
	
	//
	// CREATE LOGGING OBJECT TO CATCH ANY EXCEPTIONS
	$oLogger = new crnrstn_logging();

	//
	// DATABASE TESTING. DATABASE CONNECTIVITY PARAMS MANAGED BY CRNRSTN.
	$mysqli = $oCRNRSTN_ENV->oMYSQLI_CONN_MGR->returnConnection();
	
	$query = 'SELECT `sessions`.`SESSIONID`,`sessions`.`USERID` FROM `sessions` WHERE `sessions`.`ISACTIVE`="1" ORDER BY `sessions`.`SESSIONID` LIMIT 3;';
	$query .= 'SELECT `sessions`.`SESSIONID`,`sessions`.`USERID` FROM `sessions` WHERE `sessions`.`ISACTIVE`="1" ORDER BY `sessions`.`USERID` LIMIT 3;';
	?>
    
    <div class="crnrstn_param"><em style="font-family:'Courier New', Courier, monospace;"><?php echo $query; ?></em></div>
	<div class="cb_10"></div>
	<div class="crnrstn_param"><strong>Returned Database Result ::</strong></div>
    <div class="hr"></div>
    <div class="svr_elem_scroll">
	<?php
	
	try{
		
		//
		// CRNRSTN MYSQLI CONNECTION MANAGER TO PROCESS QUERY AND RETURN DATABASE RESULT.
		$mysqli = $oCRNRSTN_ENV->oMYSQLI_CONN_MGR->processMultiQuery($mysqli, $query);
		if($mysqli->error){
			throw new Exception('CRNRSTN configuration debug :: MYSQLI ERROR :: ['.$mysqli->error.']');
			
		}else{
			$ROWCNT=0;
			do {
				if ($result = $mysqli->store_result()) {
					while ($row = $result->fetch_row()) {
						foreach($row as $fieldPos=>$value){
							
							//
							// DISPLAY RESULT
							echo '<div class="crnrstn_param" style="padding-bottom:4px;">ROW='.$ROWCNT." || FIELDPOS=".$fieldPos." || VALUE=".$value."</div>";						
						}
						$ROWCNT++;
					}
					$result->free();
				}
			
				if ($mysqli->more_results()) {
					
					//
					// END OF RECORD. MORE TO FOLLOW.
				}
			
				
			} while ($mysqli->next_result());
			
			//
			// CHECK FOR ANY ERROR IN SQL RESULT BEYOND FIRST QUERY IN MULTI-QUERY
			if($mysqli->error){
				throw new Exception('CRNRSTN configuration debug :: MYSQLI ERROR :: ['.$mysqli->error.']');
	
			}
		}
	
	} catch( Exception $e ) {

			//
			// SEND THIS THROUGH THE LOGGER OBJECT
			$oLogger->captureNotice('CRNRSTN config debugger :: database configuration test', LOG_ERR, $e->getMessage());

		}
	
	//
	// CLOSE CONNECTION
	$oCRNRSTN_ENV->oMYSQLI_CONN_MGR->closeConnection($mysqli);
	
	?>
	</div>
</div>
<!-- I DO NOT MIND IF THE FOLLOWING LINE IS REMOVED.  -->
<div id="ftr_cw">&copy; 2012-2018 Jonathan 'J5' Harris :: All Rights Reserved.</div>  

</body>
</html>