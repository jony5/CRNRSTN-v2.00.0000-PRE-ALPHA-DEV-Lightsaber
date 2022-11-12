<?php
/*
// J5
// Code is Poetry */

/*
SOUNDCLOUD_SMALL
SOUNDCLOUD_MEDIUM
SOUNDCLOUD_LARGE

*/

//
// HTML STRING DATA FOR A SMALL SOUNDCLOUD MEDIA ICON WITH
// A STICKY LINK IS RETURNED FOR USE IN EMAIL (OR WHENEVER A
// SIMPLE ANCHOR TAG WRAPPED <IMG> IS DESIRED).
$tmp_html_out .= 'HTML Email Compatible (small):<br>';
$tmp_html_out .= $this->oCRNRSTN->return_sticky_media_link('SOUNDCLOUD_SMALL', 'https://soundcloud.com/jonathan-harris-772368100', '_blank', true);

$tmp_html_out .= '<div class="crnrstn_cb_20"></div>';
$tmp_html_out .= 'Image Sprite (medium):<br>';

//
// HTML FOR A MEDIUM SOUNDCLOUD MEDIA ICON WITH A STICKY LINK IS
// RETURNED WITH A SYSTEM IMAGE SPRITE IN USE. THIS WILL
// GRACEFULLY DEGRADE TO A SIMPLE ANCHOR TAG WRAPPED <IMG> IF
// THE SPRITE COORDINATES HAVE NOT YET BEEN APPROVED.
$tmp_html_out .= $this->oCRNRSTN->return_sticky_media_link('SOUNDCLOUD_MEDIUM', 'https://soundcloud.com/jonathan-harris-772368100', '_blank');

$tmp_html_out .= '<div class="crnrstn_cb_20"></div>';
$tmp_html_out .= 'Image Sprite (large):<br>';

$tmp_html_out .= $this->oCRNRSTN->return_sticky_media_link('SOUNDCLOUD_LARGE', 'https://soundcloud.com/jonathan-harris-772368100', '_blank');
