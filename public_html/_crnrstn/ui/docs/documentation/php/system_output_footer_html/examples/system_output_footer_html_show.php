<?php
/*
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
include_once(CRNRSTN_ROOT . '/_crnrstn.config.inc.php');

//
// PASS TRUE TO SPOOL DESIRED CONTENT TO BE OUTPUTTED LATER
// INTO THE HTML FOOTER VIA system_output_footer_html()
$oCRNRSTN->system_output_footer_html(CRNRSTN_RESOURCE_DOCUMENTATION, true);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>CRNRSTN ::</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<body>
<p>hello HTML!</p>

<?php

echo $oCRNRSTN->system_output_footer_html();

?>
</body>
</html>