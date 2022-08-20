<?php

//
// INITIALIZE DATABASE FUNCTIONALITY FOR EACH ENVIRONMENT.
// $this->oMYSQLI_CONN_MGR->add_connection([environment-key], [db-host], [db-user-name], [db-user-pswd], [db-database-name], [optional-db-port]);
$this->oMYSQLI_CONN_MGR->add_connection('LOCALHOST_MACBOOKPRO', 'localhost', 'jony5_stage', 'aXNTPxGPeLRwYzTS', 'jony5_stage','3306');
$this->oMYSQLI_CONN_MGR->add_connection('LOCALHOST_CHAD_MACBOOKPRO', 'localhost', 'jony5_stage', 'aXNTPxGPeLRwYzTS', 'jony5_stage','3306');
$this->oMYSQLI_CONN_MGR->add_connection('BLUEHOST', 'localhost', 'jonyfivc_prod01', 'password123456789', 'jonyfivc_prod01','3306');
$this->oMYSQLI_CONN_MGR->add_connection('BLUEHOST_WWW', 'localhost', 'jonyfivc_prod01', 'password123456789', 'jonyfivc_prod01','3306');
//$this->oMYSQLI_CONN_MGR->add_connection('BLUEHOST_SUB', 'localhost', 'evifwebc_jony5', 'password123456789', 'evifwebc_jony5','3306');
#$this->oMYSQLI_CONN_MGR->add_connection('LOCALHOST_PC', 'localhost', 'crnrstn_stage', 'password123456789', 'crnrstn_stage','');
#$this->oMYSQLI_CONN_MGR->add_connection('LOCALHOST_PC', 'localhost', 'crnrstn_demo', 'password123456789', 'crnrstn_demo', 3306);