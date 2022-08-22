<?php

/*
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
include_once(CRNRSTN_ROOT . '/_crnrstn.config.inc.php');

echo 'C<span style="color:#F90000;">R</span>NRSTN :: forms! [hello]';

echo '<br><br><br><br><br><br><br><br><br>\n
';

echo $oCRNRSTN->get_resource_wp('AUTH_SALT', 0, 'CRNRSTN::WP::INTEGRATIONS');


echo '<br><br><br><br><br><br><br><br><br>\n
';

echo $oCRNRSTN->get_resource_wp('DB_USER', 0, 'CRNRSTN::WP::INTEGRATIONS');