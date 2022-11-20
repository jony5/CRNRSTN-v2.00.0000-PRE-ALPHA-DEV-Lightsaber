<?php
/*
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
include_once(CRNRSTN_ROOT . '/_crnrstn.config.inc.php');

//
// PASS TRUE TO SPOOL JQUERY UI TO BE OUTPUTTED LATER
// INTO THE HTML <HEAD> VIA system_output_head_html()
$oCRNRSTN->system_output_head_html(CRNRSTN_JS_FRAMEWORK_JQUERY_UI, true);

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

<?php

echo $oCRNRSTN->system_output_footer_html();

?>
</body>
</html>