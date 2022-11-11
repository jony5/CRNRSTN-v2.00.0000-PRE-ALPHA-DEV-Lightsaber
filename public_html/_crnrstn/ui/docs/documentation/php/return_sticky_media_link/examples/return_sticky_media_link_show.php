<?php
/*
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
include_once(CRNRSTN_ROOT . '/_crnrstn.config.inc.php');

//
// HTML STRING DATA FOR A LARGE SOUNDCLOUD MEDIA ICON WITH
// A STICKY LINK IS RETURNED FOR USE IN EMAIL (OR WHENEVER A
// SIMPLE ANCHOR TAG WRAPPED <IMG> IS DESIRED).
echo 'HTML Email Compatible:<br>';
echo $oCRNRSTN->return_sticky_media_link('SOUNDCLOUD_LARGE', 'https://soundcloud.com/jonathan-harris-772368100', '_blank', true);

echo '<div class="crnrstn_cb_20"></div>';
echo 'Image Sprite:<br>';

//
// HTML FOR A LARGE SOUNDCLOUD MEDIA ICON WITH A STICKY LINK IS
// RETURNED WITH A SYSTEM IMAGE SPRITE IN USE. THIS WILL
// GRACEFULLY DEGRADE TO A SIMPLE ANCHOR TAG WRAPPED <IMG> IF
// THE SPRITE COORDINATES HAVE NOT YET BEEN APPROVED.
echo $oCRNRSTN->return_sticky_media_link('SOUNDCLOUD_LARGE', 'https://soundcloud.com/jonathan-harris-772368100', '_blank');

?>