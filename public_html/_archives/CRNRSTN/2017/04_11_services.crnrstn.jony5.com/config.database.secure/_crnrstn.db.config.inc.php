<?php
//
// INITIALIZE DATABASE FUNCTIONALITY FOR EACH ENVIRONMENT.
# $this->oMYSQLI_CONN_MGR->addConnection([environment-key], [db-host], [db-user-name], [db-user-pswd], [db-database-name], [optional-db-port]);
#$this->oMYSQLI_CONN_MGR->addConnection('LOCALHOST_PC', '127.0.0.4', 'crnrstn_demo3_un', 'FZZ88X3EU5s8vFAC', 'crnrstn_demo3');
#$this->oMYSQLI_CONN_MGR->addConnection('LOCALHOST_PC', '127.0.0.3', 'crnrstn_demo2_un', 'PwdBNBvuFHrwMqCS', 'crnrstn_demo2');
$this->oMYSQLI_CONN_MGR->addConnection('LOCALHOST_PC', 'localhost', 'crnrstn_stage', 'KNUcSHWCARrZUsaZ', 'crnrstn_stage','3306');
#$this->oMYSQLI_CONN_MGR->addConnection('LOCALHOST_PC', 'localhost', 'crnrstn_stage_ro', 'ntasfWqP38aSrC9s', 'crnrstn_stage','3306');
#$this->oMYSQLI_CONN_MGR->addConnection('LOCALHOST_PC', 'localhost', 'crnrstn_stage', 'KNUcSHWCARrZUsaZ', 'crnrstn_stage','');
#$this->oMYSQLI_CONN_MGR->addConnection('LOCALHOST_PC', 'localhost', 'crnrstn_demo', 'aXNTPxGPeLRwYzTS', 'crnrstn_demo', 3306);
$this->oMYSQLI_CONN_MGR->addConnection('PROD_HOST24', 'localhost', 'jony5com_crnrstn', 'aXNTPxGPeLRwYzTS', 'jony5com_crnrstn','');
#$this->oMYSQLI_CONN_MGR->addConnection('000WEBHOSTJONY5', 'mx.localhost.com', 'crnrstn_assets', '222222222222222', 'db_crnrstn_assets');
#$this->oMYSQLI_CONN_MGR->addConnection('000WEBHOSTJONY5', 'mx.localhost.com', 'crnrstn_posts', '33333333333333', 'db_crnrstn_posts');
#$this->oMYSQLI_CONN_MGR->addConnection('000WEBHOSTJONY5', 'mx.localhost.com', 'crnrstn_demo', '44444444444444', 'db_crnrstn_demo');
#$this->oMYSQLI_CONN_MGR->addConnection('000WEBHOSTJONY5', 'mx.localhost.com', 'crnrstn_users', '1111111111111', 'db_crnrstn_users');

?>