<?php

//
// BEGIN SYSTEM RESOURCE DEFINITIONS FOR THE NEXT ENVIRONMENT.
$this->config_add_resource('BLUEHOST_EVIFWEB', 'WETHRBUG_APP', 'https://wethrbug.jony5.com/');
$this->config_add_resource('BLUEHOST_EVIFWEB', 'CRNRSTN_UI_INTERACT_ENABLED', false);
$this->config_add_resource('BLUEHOST_EVIFWEB', 'CRNRSTN_UI_INTERACT_ISVISIBLE', false);
$this->config_add_resource('BLUEHOST_EVIFWEB', 'SSL_ENABLED', true);

//
// BEGIN SYSTEM RESOURCE DEFINITIONS FOR THE NEXT ENVIRONMENT.
//$this->config_add_resource('LOCALHOST_PC', 'WETHRBUG_APP', 'https://wethrbug.jony5.com/');     // TOSHIBA M100 [eVifweb] :: RADIOHEAD.
//$this->config_add_resource('LOCALHOST_PC', 'CRNRSTN_UI_INTERACT_ENABLED', true);               // TOSHIBA M100 [eVifweb] :: RADIOHEAD.
//$this->config_add_resource('LOCALHOST_PC', 'CRNRSTN_UI_INTERACT_ISVISIBLE', true);             // TOSHIBA M100 [eVifweb] :: RADIOHEAD.
//$this->config_add_resource('LOCALHOST_PC', 'SSL_ENABLED', false);                              // TOSHIBA M100 [eVifweb] :: RADIOHEAD.

//
// BEGIN SYSTEM RESOURCE DEFINITIONS FOR THE NEXT ENVIRONMENT.
$this->config_add_resource('LOCALHOST_CHAD_MACBOOKPRO', 'WETHRBUG_APP', 'https://wethrbug.jony5.com/');
$this->config_add_resource('LOCALHOST_CHAD_MACBOOKPRO', 'CRNRSTN_UI_INTERACT_ENABLED', true);
$this->config_add_resource('LOCALHOST_CHAD_MACBOOKPRO', 'CRNRSTN_UI_INTERACT_ISVISIBLE', true);
$this->config_add_resource('LOCALHOST_CHAD_MACBOOKPRO', 'SSL_ENABLED', false);

//
// BEGIN SYSTEM RESOURCE DEFINITIONS FOR ALL ENVIRONMENTS :: AS DESIGNATED BY PASSING CRNRSTN_RESOURCE_ALL AS ENV KEY PARAMETER
$this->config_add_resource(CRNRSTN_RESOURCE_ALL, 'WSDL_CACHE_TTL', '80');	# REQUIRED BY CRNRSTN :: SOAP CONNECTION MANAGER
$this->config_add_resource(CRNRSTN_RESOURCE_ALL, 'SOA_NAMESPACE', 'http://www.w3.org/2003/05/soap-encoding');   # USED BY CRNRSTN :: SOAP CONNECTION MANAGER