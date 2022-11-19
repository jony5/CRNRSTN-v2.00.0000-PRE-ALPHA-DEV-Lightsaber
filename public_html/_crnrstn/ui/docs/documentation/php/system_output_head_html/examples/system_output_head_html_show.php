<?php
/*
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
include_once(CRNRSTN_ROOT . '/_crnrstn.config.inc.php');

//
// PASS TRUE TO SPOOL DESIRED CONTENT TO BE OUTPUTTED LATER
// INTO THE HTML <HEAD> VIA system_output_head_html()
$oCRNRSTN->system_output_head_html(CRNRSTN_UI_JS_JQUERY_UI, true);
$oCRNRSTN->system_output_head_html(CRNRSTN_UI_CSS_MAIN_DESKTOP & CRNRSTN_UI_JS_MAIN_DESKTOP, true);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>CRNRSTN ::</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <?php

        echo $oCRNRSTN->system_output_head_html();

    ?>

</head>
<body>
<p>hello HTML!</p>

</body>
</html>