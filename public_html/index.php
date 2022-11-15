<?php
/*
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
include_once(CRNRSTN_ROOT . '/_crnrstn.config.inc.php');

/*
//ONCE FORM HANDLING AND THE CRNRSTN :: CSS VALIDATOR ARE RE-ARCH'ED ONTO LIGHTSABER.
$oCRNRSTN->framework_integrations_client_packet(CRNRSTN_RESOURCE_DOCUMENTATION, true);
echo $oCRNRSTN->ui_module_out('css_validator');
exit();

*/

/*
CRNRSTN :: R&D (read as "messy kitchen below"...and this right here is by no means the end of it.)
CONFIGURATION OF OUTPUT FORMAT FOR MAPPED ASSETS

CRNRSTN_UI_IMG_HTML_WRAPPED & CRNRSTN_ASSET_MODE_BASE64
CRNRSTN_UI_IMG_HTML_WRAPPED & CRNRSTN_ASSET_MODE_PNG
CRNRSTN_UI_IMG_HTML_WRAPPED & CRNRSTN_ASSET_MODE_JPEG



---
CRNRSTN_UI_IMG_HTML_WRAPPED
CRNRSTN_UI_IMG_HTML_WRAPPED & CRNRSTN_UI_IMG_PNG
CRNRSTN_UI_IMG_HTML_WRAPPED & CRNRSTN_UI_IMG_JPEG
CRNRSTN_UI_IMG_HTML_WRAPPED & CRNRSTN_ASSET_MODE_JPEG
CRNRSTN_UI_IMG_HTML_WRAPPED & CRNRSTN_ASSET_MODE_PNG

CRNRSTN_UI_IMG_PNG
CRNRSTN_ASSET_MODE_PNG
CRNRSTN_UI_IMG_JPEG
CRNRSTN_ASSET_MODE_JPEG

case CRNRSTN_UI_IMG_HTML_WRAPPED & CRNRSTN_UI_IMG_BASE64_JPEG
case CRNRSTN_UI_IMG_HTML_WRAPPED & CRNRSTN_ASSET_MODE_BASE64 & CRNRSTN_UI_IMG_JPEG
case CRNRSTN_UI_IMG_HTML_WRAPPED & CRNRSTN_ASSET_MODE_BASE64
case CRNRSTN_UI_IMG_HTML_WRAPPED & CRNRSTN_ASSET_MODE_BASE64 & CRNRSTN_UI_IMG_PNG
case CRNRSTN_UI_IMG_HTML_WRAPPED & CRNRSTN_UI_IMG_BASE64
case CRNRSTN_UI_IMG_HTML_WRAPPED & CRNRSTN_UI_IMG_BASE64_PNG
case CRNRSTN_ASSET_MODE_BASE64
case CRNRSTN_UI_IMG_BASE64
case CRNRSTN_ASSET_MODE_BASE64
case CRNRSTN_UI_IMG_BASE64_PNG
case CRNRSTN_UI_IMG_BASE64_JPEG

*/

//echo $oCRNRSTN->return_system_image('CRNRSTN_LOGO', '', 250, NULL, NULL, NULL, NULL, CRNRSTN_UI_IMG_HTML_WRAPPED);
//echo $oCRNRSTN->return_sticky_media_link('SOUNDCLOUD_LARGE', 'https://soundcloud.com/jonathan-harris-772368100', '_blank', true);
//echo $oCRNRSTN->return_sticky_media_link('SOUNDCLOUD_LARGE', 'https://soundcloud.com/jonathan-harris-772368100', '_blank', false);
//echo $oCRNRSTN->return_creative('CRNRSTN_FAVICON', CRNRSTN_UI_IMG_HTML_WRAPPED);
//

/*
CRNRSTN :: LEAD DEVELOPER HELPER FOR SPRITE SETUP
* = THIS NOT CRNRSTN :: LIGHTSABER, AND IT WILL BE DELETED WHEN MEDIA SPRITE SETUP IS COMPLETE.
0 = TEMP HOME [currently MIT_license...soon (and permanently?) css_validator, once form handling can be completed.]
1 = MEDIA SPRITE
2 = BASE64 SYNC (...IF EVERYTHING IS UP TO DATE, JUST A CHECK.)

//$tmp_mode = O;

*/

//$tmp_mode = 2;
//$tmp_mode = 1;
$tmp_mode = 0;

$media_key = 'MOZILLA_WORDMARK';
$sprite_debug_bg_color = '#FFF';
///$sprite_debug_bg_color = '#000';
switch($tmp_mode){
    case 2:

        //
        // SYNC BASE64 TO SYSTEM AND SOCIAL PNG AND JPEG ASSETS.
        // THIS MAINTAINS A BASE64 FILE SYSTEM THAT PARALLELS THE SOURCE PNG/JPG FILES.
        $oCRNRSTN->system_base64_synchronize();

        // TODO :: THE GOAL IS TO RECEIVE A DIR PATH FROM AN ADMIN FOR BASE64 REPLICATION OF *.* IMAGES (e.g.
        // USER PROFILE PICS). AND THEN GET THESE ASSETS BEHIND CRNRSTN :: ASSET MAPPING AND CONTENT CONTROL.
        // e.g. https://yourdomain.com/?crnrstn_01010010110=your_image_name.jpg&crnrstn_hsh=c2e96b13634c287620fd5f9d51708946
        // e.g. ONLY JPEGS RETURNED (OR CREATED FROM PNG ON "NO FILE" AND RETURNED) FOR ALL HTML META TAG FOR SOCIAL MEDIA PREVIEWS.
        exit();

    break;
    case 0:

        $oCRNRSTN->framework_integrations_client_packet(CRNRSTN_RESOURCE_DOCUMENTATION, true);

        echo $oCRNRSTN->ui_module_out('MIT_license');
        exit();

    break;
    case 1:
    default:

        /*
         YAAAY! IT'S FINALLY "BRING-A-SPRITE-ONLINE DAY" ::
         0) REMOVE THE DESIRED SPRITE MEDIA IMAGE (TO COMPLETE) FROM $tmp_ARRAY @
              FILE: [/crnrstn/crnrstn.inc.php] [lnum 3355]
              METHOD: crnrstn::tmp_restrict_this_image_sprite_media_constant()
         1) RUN THIS PAGE WITH $test_sprite = true. See [lnum 53] above.
         2) FIND MATCHING SWITCH STATEMENT CASE STARTING AT [lnum 7380] @
              FILE: [/user/crnrstn.user.inc.php]
              METHOD: crnrstn_user::return_sticky_media_link()
         3) SNIFF THE HTML DOM TO GET THE WIDTH OF THE BOTTOM IMAGE. THAT WOULD BE THE
            EMAIL_CHANNEL VERSION; THIS ONE WILL JUST LOAD.
         4) PUT THAT WIDTH VALUE INTO THE $tmp_social_img_width OF THE RESPECTIVE
            'SMALL', 'MEDIUM', OR 'LARGE' CASE STATEMENT IN STEP 2.
         5) REFRESH THIS PAGE TO TEST ALL EDITS TO $tmp_social_img_left AND $tmp_social_img_top (FROM STEP 2):
            - BOTH IMAGES (TOP AND BOTTOM) SHOULD LOOK THE SAME.
            - THE TOP EDGE SHOULD NOT LOOK CROPPED OR CLIPPED
            - THE BOTTOM EDGE SHOULD NOT LOOK CROPPED OR CLIPPED
            - BOTH IMAGES (TOP AND BOTTOM) SHOULD LOOK THE SAME, BUT THE IMAGE SPRITE VERSION WILL
              NEED TO BE JUST A SHITE BIT SMALLER TO KEEP THE DOM OBJECT'S TOTAL HEIGHT STUCK ON
              RAILS AT 25, 50, AND 75px.
            - NOTHING SHOULD LOOK CROPPED OR CLIPPED. IF NO HOPE, SAVE WHAT YOU HAVE AND MOVE ON...OR SEE FIX BELOW.

         NOTES ABOUT $tmp_social_img_width = '' FROM STEP 2 ABOVE ::
         A) UNTIL THE DEFAULT EMPTY STRING IS CHANGED TO A USEFUL INTEGER, THE IMAGE SPRITE WILL SHOW NOTHING USEFUL.
         B) IF THE DESIRED MEDIA IMAGE CANNOT BE CENTERED WITHOUT CROPPING AN EDGE, IT WILL NEED:
              a] TO BE RESIZED TO BE SMALLER WITHIN EACH OF THE PNG AND JPEG CREATIVE SOURCE FILES,
              b] TO HAVE FRESH IMAGES CUT FOR TESTING,
              c] AND TO BE BASE64 ENCODED...THE FRESH PNG AND JPEG. TO ENCODE, UPDATE THE PNG AND JPEG ON THIS
                 SERVER, AND RUN lnum 52 ABOVE ($oCRNRSTN->system_base64_synchronize()).

              IF SPRITE UPDATES ARE DONE CAREFULLY, NO OTHER MEDIA SHOULD BE AFFECTED BY THESE KINDS OF "UNAVOIDABLE" AND
              TRAGIC---. THE 25, 50, AND 75px HEIGHTS ARE FIRM (THINKING ABOUT UI STABILITY HAVING 400 USERS ON ANY MIX
              OF SOCIAL). THE PROJECT LEAD FULL STACK MAY HAVE BEEN SLOPPY CUTTING THE 118 MEDIA IMAGES NECESSARY TO
              COMPLETE THIS ASSIGNMENT, AND WE (PLEASE LORD, MAY IT JUST BE THAT GUY) MAY PAY FOR IT DEARLY AT
              IMPLEMENTATION. WELL,...JACK OF ALL TRADES AND MAST...

        */

        //
        // IMAGE SPRITE COORDINATES TESTING
        // APPLE_MUSIC_SMALL, APPLE_MUSIC_MEDIUM, APPLE_MUSIC_LARGE
        echo '<div style="padding: 20px; background-color: ' . $sprite_debug_bg_color . ';">';
        echo '<div style="font-family: Courier New, Courier, monospace; color: #333; font-size: 14px;">[small]</div>';
        echo '<div style="display:block; clear:both; height:3px; line-height:1px; overflow:hidden; border:0; padding:0; margin:0; font-size:1px;"></div>';

        echo $oCRNRSTN->return_sticky_media_link($media_key . '_SMALL', 'https://soundcloud.com/jonathan-harris-772368100', '_blank');
        echo '<div style="display:block; clear:both; height:3px; line-height:1px; overflow:hidden; border:0; padding:0; margin:0; font-size:1px;"></div>';
        echo $oCRNRSTN->return_sticky_media_link($media_key . '_SMALL', 'https://soundcloud.com/jonathan-harris-772368100', '_blank', true);
        echo '<div style="display:block; clear:both; height:20px; line-height:1px; overflow:hidden; border:0; padding:0; margin:0; font-size:1px;"></div>';

        echo '<div style="font-family: Courier New, Courier, monospace; color: #333; font-size: 14px;">[medium]</div>';
        echo '<div style="display:block; clear:both; height:3px; line-height:1px; overflow:hidden; border:0; padding:0; margin:0; font-size:1px;"></div>';

        echo $oCRNRSTN->return_sticky_media_link($media_key . '_MEDIUM', 'https://soundcloud.com/jonathan-harris-772368100', '_blank');
        echo '<div style="display:block; clear:both; height:3px; line-height:1px; overflow:hidden; border:0; padding:0; margin:0; font-size:1px;"></div>';
        echo $oCRNRSTN->return_sticky_media_link($media_key . '_MEDIUM', 'https://soundcloud.com/jonathan-harris-772368100', '_blank', true);
        echo '<div style="display:block; clear:both; height:20px; line-height:1px; overflow:hidden; border:0; padding:0; margin:0; font-size:1px;"></div>';

        echo '<div style="font-family: Courier New, Courier, monospace; color: #333; font-size: 14px;">[large]</div>';
        echo '<div style="display:block; clear:both; height:3px; line-height:1px; overflow:hidden; border:0; padding:0; margin:0; font-size:1px;"></div>';

        echo $oCRNRSTN->return_sticky_media_link($media_key . '_LARGE', 'https://soundcloud.com/jonathan-harris-772368100', '_blank');
        echo '<div style="display:block; clear:both; height:3px; line-height:1px; overflow:hidden; border:0; padding:0; margin:0; font-size:1px;"></div>';
        echo $oCRNRSTN->return_sticky_media_link($media_key . '_LARGE', 'https://soundcloud.com/jonathan-harris-772368100', '_blank', true);
        echo '</div>';

        exit();

    break;

}