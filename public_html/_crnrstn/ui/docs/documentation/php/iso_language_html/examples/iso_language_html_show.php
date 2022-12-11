<?php
/*
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
include_once(CRNRSTN_ROOT . '/_crnrstn.config.inc.php');

//
// GET THE BEST LANGUAGE INDICATOR FOR USE
// AS THE <HTML> LANGUAGE ATTRIBUTE.
// iso_639-1_2002 BY DEFAULT.
$lang_iso = $oCRNRSTN->iso_language_html();

echo 'Preferred language: ' . $lang_iso . '.';

?>