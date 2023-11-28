<?php
//
// INITIALIZE DATABASE FUNCTIONALITY FOR EACH ENVIRONMENT.
# $this->oMYSQLI_CONN_MGR->addConnection([environment-key], [db-host], [db-user-name], [db-user-pswd], [db-database-name], [optional-db-port]);
#$this->oMYSQLI_CONN_MGR->addConnection('LOCALHOST_PC', '127.0.0.4', 'crnrstn_demo3_un', 'FZZ88X3EU5s8vFAC', 'crnrstn_demo3');
#$this->oMYSQLI_CONN_MGR->addConnection('LOCALHOST_PC', '127.0.0.3', 'crnrstn_demo2_un', 'PwdBNBvuFHrwMqCS', 'crnrstn_demo2');
$this->oMYSQLI_CONN_MGR->addConnection('LOCALHOST_TERMINAL_MAC', 'localhost', 'wethrbug_stage', 'zmqM8oD2zTYBMd2K', 'wethrbug_stage','3306');
$this->oMYSQLI_CONN_MGR->addConnection('CYEXX_SYSTEMS', 'localhost', 'jonyfive_wethrbug', 'password_123456789', 'jonyfive_wethrbug','3306');
