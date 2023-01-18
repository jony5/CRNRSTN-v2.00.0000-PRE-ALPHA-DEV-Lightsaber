<?php

//
// INITIALIZE DATABASE CONNECTION PROFILE(S) FOR EACH ENVIRONMENT.
// $this->config_add_connection([environment-key], [db-host], [db-user-name], [db-user-pswd], [db-database-name], [optional-db-port]);
$this->config_add_database_connection('LOCALHOST_MACBOOKPRO', 'localhost', 'jony5_stage', 'aXNTPxGPeLRwYzTS', 'jony5_stage','3306');
$this->config_add_database_connection('LOCALHOST_CHAD_MACBOOKPRO', 'localhost', 'jony5_stage00000', 'hello_000000', 'jony5_stage','3306');
$this->config_add_database_connection('LOCALHOST_CHAD_MACBOOKPRO', 'localhost', 'jony5_stage11111', 'hello_111111', 'jony5_stage','3306');
$this->config_add_database_connection('LOCALHOST_CHAD_MACBOOKPRO', 'localhost', 'jony5_stage', 'aXNTPxGPeLRwYzTS', 'jony5_stage','3306');
$this->config_add_database_connection('BLUEHOST_JONY5', 'localhost', 'jonyfivc_prod01', 'password123456789', 'jonyfivc_prod01','3306');
$this->config_add_database_connection('BLUEHOST_EVIFWEB', 'localhost', 'jonyfivc_prod01', 'password123456789', 'jonyfivc_prod01','3306');
//$this->config_add_database_connection('BLUEHOST_SUB', 'localhost', 'evifwebc_jony5', 'password123456789', 'evifwebc_jony5','3306');
#$this->config_add_database_connection('LOCALHOST_PC', 'localhost', 'crnrstn_stage', 'password123456789', 'crnrstn_stage','');
#$this->config_add_database_connection('LOCALHOST_PC', 'localhost', 'crnrstn_demo', 'password123456789', 'crnrstn_demo', 3306);