<?php
/*
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
include_once(CRNRSTN_ROOT . '/_crnrstn.config.inc.php');

//
// GET THE CURRENT (HIGHEST PREFERENCE) LANGUAGE
// PROFILE. iso_639-1_2002 BY DEFAULT.
$lang_iso = $oCRNRSTN->iso_language_profile();
echo 'Preferred language: ' . $lang_iso . '.<br><br>';

//
// GET A TOTAL COUNT.
$lang_iso_count = $oCRNRSTN->iso_language_profile_count();
echo 'Count of language preference profiles: ' . $lang_iso_count . '.<br><br>';

//
// DEMONSTRATION :: LOOP THROUGH ALL LANGUAGE PROFILES FOR ONE ATTRIBUTE, native_nomination.
for($i = 0; $i < $lang_iso_count; $i++){

    //
    // WHEN EXTRACTING A SINGLE LANGUAGE PROFILE, THE OUTPUT
    // ARRAY, $iso_profile_ARRAY, WILL HAVE ALL DATA AT $iso_profile_ARRAY[0].
    $iso_profile_ARRAY = $oCRNRSTN->iso_language_profile(NULL, $i);
    echo 'The native nomination for language profile ' . $i . ' is ' . $iso_profile_ARRAY[0]['native_nomination'] . '. <br>';

}

//
// RETURN ALL THE LANGUAGE DATA FOR ALL PROFILES.
$lang_iso_ALL_profile_ARRAY = $oCRNRSTN->iso_language_profile(CRNRSTN_RESOURCE_ALL);
echo $oCRNRSTN->var_dump($lang_iso_ALL_profile_ARRAY);

//
// RETURN ALL THE LANGUAGE DATA FOR A SINGLE PROFILE (THE PREFERRED LANGUAGE).
$lang_iso_ALL_profile_ARRAY = $oCRNRSTN->iso_language_profile(NULL);
echo $oCRNRSTN->var_dump($lang_iso_ALL_profile_ARRAY);

?>