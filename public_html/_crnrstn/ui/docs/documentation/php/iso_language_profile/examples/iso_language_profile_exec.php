<?php
/*
// J5
// Code is Poetry */
$lang_iso = $this->oCRNRSTN->iso_language_profile();
$tmp_html_out .= 'Preferred language: ' . $lang_iso . '.<br><br>';

$lang_iso_count = $this->oCRNRSTN->iso_language_profile_count();
$tmp_html_out .= 'Count of language preference profiles: ' . $lang_iso_count . '.<br><br>';

for($i = 0; $i < $lang_iso_count; $i++){

    $iso_profile_ARRAY = $this->oCRNRSTN->iso_language_profile(NULL, $i);
    $tmp_html_out .= 'The native nomination for language profile ' . $i . ' is ' . $iso_profile_ARRAY[0]['native_nomination'] . '. <br>';

}

$lang_iso_ALL_profile_ARRAY = $this->oCRNRSTN->iso_language_profile(CRNRSTN_RESOURCE_ALL);
$tmp_html_out .= $this->oCRNRSTN->var_dump($lang_iso_ALL_profile_ARRAY);

$lang_iso_ALL_profile_ARRAY = $this->oCRNRSTN->iso_language_profile(NULL);
$tmp_html_out .= $this->oCRNRSTN->var_dump($lang_iso_ALL_profile_ARRAY);