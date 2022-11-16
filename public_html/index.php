<?php
/*
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
include_once(CRNRSTN_ROOT . '/_crnrstn.config.inc.php');

$oCRNRSTN->framework_integrations_client_packet(CRNRSTN_RESOURCE_DOCUMENTATION, true);

echo $oCRNRSTN->ui_module_out('MIT_license');

exit();