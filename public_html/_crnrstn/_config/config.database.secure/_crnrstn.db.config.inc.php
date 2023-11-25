<?php

//
// INITIALIZE CRNRSTN :: TABLE PROFILE.
$this->config_add_database_table_profile(CRNRSTN_RESOURCE_ALL, 'crnrstn_');

//
// ENABLE THE WIZARD PROMPTS OF CRNRSTN :: SETUP/INSTALL/CONFIGURATION TO BE
// OPTIONALLY POWERED BY ANOTHER CRNRSTN :: INSTALLATION.
// DURING SETUP, A URL TO THE ORIGIN SITE WILL BE REQUESTED.
$this->config_enable_database_table_replication(CRNRSTN_RESOURCE_ALL, true, 'https://lightsaber.crnrstn.evifweb.com/');
$this->config_enable_database_table_replication(CRNRSTN_RESOURCE_ALL, true, 'http://172.16.225.139/lightsaber.crnrstn.evifweb.com/');
$this->config_enable_database_table_replication(CRNRSTN_RESOURCE_ALL, true, 'http://172.16.225.139/evifweb.com/');
$this->config_enable_database_table_replication(CRNRSTN_RESOURCE_ALL, true, 'http://172.16.225.138/evifweb.com/');

//
// INITIALIZE DATABASE CONNECTION PROFILE(S) FOR EACH ENVIRONMENT.
// $this->config_add_connection([environment-key], [db-host], [db-user-name], [db-user-pswd], [db-database-name], [optional-db-port]);
$this->config_add_database_connection('LOCALHOST_CHAD_MACBOOKPRO', 'localhost', 'crnrstn_wolfpup', 'Kjo91ohxf3npcwl2', 'crnrstn_wolfpup', 3306);
$this->config_add_database_connection('LOCALHOST_CHAD_MACBOOKPRO', 'localhost', 'crnrstn_mirror00', '5xtEjguSpRPZBegn', 'crnrstn_mirror00', 3306);
$this->config_add_database_connection('LOCALHOST_CHAD_MACBOOKPRO', 'localhost', 'crnrstn_replicate00', 'SzKtmScdwWdPkMPf', 'crnrstn_replicate00', 3306);
$this->config_add_database_connection('LOCALHOST_CHAD_MACBOOKPRO', 'localhost', 'evifweb_cedar', 'sqTaHnsVcCgKjAQd', 'evifweb_cedar', 3306);

$this->config_add_database_connection('BLUEHOST_JONY5', 'localhost', 'jonyfivc_prod01', 'password123456789', 'jonyfivc_prod01', 3306);
$this->config_add_database_connection('BLUEHOST_EVIFWEB', 'localhost', 'jonyfivc_prod01', 'password123456789', 'jonyfivc_prod01', 3306);
$this->config_add_database_connection('LOCALHOST_PC_XP', 'localhost', 'jony5_stage', 'aXNTPxGPeLRwYzTS', 'jony5_stage', 3306);
//$this->config_add_database_connection('LOCALHOST_PC', 'localhost', 'crnrstn_stage', 'password123456789', 'crnrstn_stage');            // TOSHIBA M100 [eVifweb] :: RADIOHEAD.
//$this->config_add_database_connection('LOCALHOST_PC', 'localhost', 'crnrstn_demo', 'password123456789', 'crnrstn_demo', 3306);        // TOSHIBA M100 [eVifweb] :: RADIOHEAD.