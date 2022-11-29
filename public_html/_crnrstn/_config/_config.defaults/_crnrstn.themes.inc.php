<?php

//
// FLAGS FOR USER INTERFACE THEME STYLES
// $this->system_theme_style_constants_ARRAY = array(
// CRNRSTN_UI_PHPNIGHT                 // REPLICATION OF LEAD DEVELOPER IDE THEME. HOW CRNRSTN :: LIGHTSABER LOOKS TO ME.
// CRNRSTN_UI_DARKNIGHT                // LIKE CRNRSTN_UI_PHPNIGHT, BUT DARKER. NOTHING COULD BE DARKER. NOTHING.
// CRNRSTN_UI_PHP                      // ALL ABOUT THE BUSINESS.
// CRNRSTN_UI_GREYSKYS                 // // ALONE AND SAD WITH A NICE CUP OF COFFEE, A RACK MOUNTED DUAL-VIDEO CARD MAC PRO, AND FOUR (4) PRO DISPLAYS.
// CRNRSTN_UI_HTML                     // BE LIGHT AND HAPPY.
// CRNRSTN_UI_DAYLIGHT                 // LIKE CRNRSTN_UI_HTML BUT...LIGHTER. NOTHING COULD BE LIGHTER.
// CRNRSTN_UI_FEATHER                  // LIGHTER THAN DAYLIGHT.
// CRNRSTN_UI_GLASS_LIGHT_COPY,
// CRNRSTN_UI_GLASS_DARK_COPY,
// CRNRSTN_UI_TERMINAL,
// CRNRSTN_UI_RANDOM);
//
$tmp_theme_attributes_ARRAY = array();

switch($theme_style){
    case CRNRSTN_UI_PHPNIGHT:

        //
        // REPLICATION OF LEAD DEVELOPER IDE THEME. HOW CRNRSTN :: LIGHTSABER LOOKS TO ME.
        $tmp_theme_attributes_ARRAY['highlight.comment'] = '#7EC3E6';
        $tmp_theme_attributes_ARRAY['highlight.default'] = '#9876AA';
        $tmp_theme_attributes_ARRAY['highlight.html'] = '#EBEBEB';
        $tmp_theme_attributes_ARRAY['highlight.keyword'] = '#ED864A; font-weight: normal';
        $tmp_theme_attributes_ARRAY['highlight.string'] = '#54B33E';

        $tmp_theme_attributes_ARRAY['stage.canvas.background-color'] = '#131314';
        $tmp_theme_attributes_ARRAY['stage.canvas.background-opacity'] = 'filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=100); opacity: 1.0';
        $tmp_theme_attributes_ARRAY['stage.canvas.border-width'] = '3px';
        $tmp_theme_attributes_ARRAY['stage.canvas.border-color'] = '#9E9E9E';
        $tmp_theme_attributes_ARRAY['stage.canvas.border-style'] = 'solid';
        $tmp_theme_attributes_ARRAY['stage.content.background-opacity'] = 'filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=100); opacity: 1.0';
        $tmp_theme_attributes_ARRAY['stage.content.highlight-color'] = '#393939';
        $tmp_theme_attributes_ARRAY['stage.lnum.css.right-border-width'] = '1px';
        $tmp_theme_attributes_ARRAY['stage.lnum.css.right-border-color'] = '#833131';
        $tmp_theme_attributes_ARRAY['stage.lnum.css.right-border-style'] = 'solid';
        $tmp_theme_attributes_ARRAY['stage.lnum.css.background-color'] = '#282828';
        $tmp_theme_attributes_ARRAY['stage.lnum.css.color'] = '#00D500';

        $tmp_theme_attributes_ARRAY['stage.canvas.box-shadow.inset'][] = '';
        $tmp_theme_attributes_ARRAY['stage.canvas.box-shadow.offset-x'][] = '3px';
        $tmp_theme_attributes_ARRAY['stage.canvas.box-shadow.offset-y'][] = '3px';
        $tmp_theme_attributes_ARRAY['stage.canvas.box-shadow.blur-radius'][] = '3px';
        $tmp_theme_attributes_ARRAY['stage.canvas.box-shadow.spread-radius'][] = '';
        $tmp_theme_attributes_ARRAY['stage.canvas.box-shadow.color'][] = '#BFBFBF';

    break;
    case  CRNRSTN_UI_PHP:
        
        //
        // ALL ABOUT THE BUSINESS.
        $tmp_theme_attributes_ARRAY['highlight.comment'] = '#008000';
        $tmp_theme_attributes_ARRAY['highlight.default'] = '#191A31';
        $tmp_theme_attributes_ARRAY['highlight.html'] = '#808080';
        $tmp_theme_attributes_ARRAY['highlight.keyword'] = '#00B; font-weight: normal';
        $tmp_theme_attributes_ARRAY['highlight.string'] = '#D00';

        $tmp_theme_attributes_ARRAY['stage.canvas.background-color'] = '#F2F2F2';
        $tmp_theme_attributes_ARRAY['stage.canvas.background-opacity'] = 'filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=100); opacity: 1.0';
        $tmp_theme_attributes_ARRAY['stage.canvas.border-width'] = '3px';
        $tmp_theme_attributes_ARRAY['stage.canvas.border-color'] = '#C2C7DF';
        $tmp_theme_attributes_ARRAY['stage.canvas.border-style'] = 'solid';
        $tmp_theme_attributes_ARRAY['stage.content.background-opacity'] = 'filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=100); opacity: 1.0';
        $tmp_theme_attributes_ARRAY['stage.content.highlight-color'] = '#D6D6F4';
        $tmp_theme_attributes_ARRAY['stage.lnum.css.right-border-width'] = '1px';
        $tmp_theme_attributes_ARRAY['stage.lnum.css.right-border-color'] = '#2C2C2C';
        $tmp_theme_attributes_ARRAY['stage.lnum.css.right-border-style'] = 'solid';
        $tmp_theme_attributes_ARRAY['stage.lnum.css.background-color'] = '#787CAF';
        $tmp_theme_attributes_ARRAY['stage.lnum.css.color'] = '#EEE8E8';

        $tmp_theme_attributes_ARRAY['stage.canvas.box-shadow.inset'][] = '';
        $tmp_theme_attributes_ARRAY['stage.canvas.box-shadow.offset-x'][] = '3px';
        $tmp_theme_attributes_ARRAY['stage.canvas.box-shadow.offset-y'][] = '3px';
        $tmp_theme_attributes_ARRAY['stage.canvas.box-shadow.blur-radius'][] = '3px';
        $tmp_theme_attributes_ARRAY['stage.canvas.box-shadow.spread-radius'][] = '';
        $tmp_theme_attributes_ARRAY['stage.canvas.box-shadow.color'][] = '#BFBFBF';

    break;
    case  CRNRSTN_UI_GREYSKYS:
        
        //
        // ALONE AND SAD WITH A NICE CUP OF COFFEE, A RACK MOUNTED
        // DUAL-VIDEO CARD MAC PRO, AND FOUR (4) APPLE PRO DISPLAYS.
        $tmp_theme_attributes_ARRAY['highlight.comment'] = '#D4762D';
        $tmp_theme_attributes_ARRAY['highlight.default'] = '#939393';
        $tmp_theme_attributes_ARRAY['highlight.html'] = '#C8C8C8';
        $tmp_theme_attributes_ARRAY['highlight.keyword'] = '#212121; font-weight: normal';
        $tmp_theme_attributes_ARRAY['highlight.string'] = '#421414';

        $tmp_theme_attributes_ARRAY['stage.canvas.background-color'] = '#F5F5F5';
        $tmp_theme_attributes_ARRAY['stage.canvas.background-opacity'] = 'filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=100); opacity: 1.0';
        $tmp_theme_attributes_ARRAY['stage.canvas.border-width'] = '3px';
        $tmp_theme_attributes_ARRAY['stage.canvas.border-color'] = '#C3C3C3';
        $tmp_theme_attributes_ARRAY['stage.canvas.border-style'] = 'solid';
        $tmp_theme_attributes_ARRAY['stage.content.background-opacity'] = 'filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=100); opacity: 1.0';
        $tmp_theme_attributes_ARRAY['stage.content.highlight-color'] = '#DBDBDB';
        $tmp_theme_attributes_ARRAY['stage.lnum.css.right-border-width'] = '1px';
        $tmp_theme_attributes_ARRAY['stage.lnum.css.right-border-color'] = '#333';
        $tmp_theme_attributes_ARRAY['stage.lnum.css.right-border-style'] = 'solid';
        $tmp_theme_attributes_ARRAY['stage.lnum.css.background-color'] = '#A5A5A5';
        $tmp_theme_attributes_ARRAY['stage.lnum.css.color'] = '#E8E8E8';

        $tmp_theme_attributes_ARRAY['stage.canvas.box-shadow.inset'][] = '';
        $tmp_theme_attributes_ARRAY['stage.canvas.box-shadow.offset-x'][] = '3px';
        $tmp_theme_attributes_ARRAY['stage.canvas.box-shadow.offset-y'][] = '3px';
        $tmp_theme_attributes_ARRAY['stage.canvas.box-shadow.blur-radius'][] = '3px';
        $tmp_theme_attributes_ARRAY['stage.canvas.box-shadow.spread-radius'][] = '';
        $tmp_theme_attributes_ARRAY['stage.canvas.box-shadow.color'][] = '#BFBFBF';
        
    break;
    case  CRNRSTN_UI_HTML:
        
        //
        // BE LIGHT AND HAPPY.
        $tmp_theme_attributes_ARRAY['highlight.comment'] = '#169B2B';
        $tmp_theme_attributes_ARRAY['highlight.default'] = '#B72620';
        $tmp_theme_attributes_ARRAY['highlight.html'] = '#666';
        $tmp_theme_attributes_ARRAY['highlight.keyword'] = '#C08E1A; font-weight: normal;';
        $tmp_theme_attributes_ARRAY['highlight.string'] = '#2020BD';

        $tmp_theme_attributes_ARRAY['stage.canvas.background-color'] = '#F3F0F0';
        $tmp_theme_attributes_ARRAY['stage.canvas.background-opacity'] = 'filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=100); opacity: 1.0';
        $tmp_theme_attributes_ARRAY['stage.canvas.border-width'] = '3px';
        $tmp_theme_attributes_ARRAY['stage.canvas.border-color'] = '#80A0DD';
        $tmp_theme_attributes_ARRAY['stage.canvas.border-style'] = 'solid';
        $tmp_theme_attributes_ARRAY['stage.content.background-opacity'] = 'filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=100); opacity: 1.0';
        $tmp_theme_attributes_ARRAY['stage.content.highlight-color'] = '#EBDCB8';
        $tmp_theme_attributes_ARRAY['stage.lnum.css.right-border-width'] = '1px';
        $tmp_theme_attributes_ARRAY['stage.lnum.css.right-border-color'] = '#333';
        $tmp_theme_attributes_ARRAY['stage.lnum.css.right-border-style'] = 'solid';
        $tmp_theme_attributes_ARRAY['stage.lnum.css.background-color'] = '#3F6EC9';
        $tmp_theme_attributes_ARRAY['stage.lnum.css.color'] = '#F3F0F0';

        $tmp_theme_attributes_ARRAY['stage.canvas.box-shadow.inset'][] = '';
        $tmp_theme_attributes_ARRAY['stage.canvas.box-shadow.offset-x'][] = '3px';
        $tmp_theme_attributes_ARRAY['stage.canvas.box-shadow.offset-y'][] = '3px';
        $tmp_theme_attributes_ARRAY['stage.canvas.box-shadow.blur-radius'][] = '3px';
        $tmp_theme_attributes_ARRAY['stage.canvas.box-shadow.spread-radius'][] = '';
        $tmp_theme_attributes_ARRAY['stage.canvas.box-shadow.color'][] = '#BFBFBF';

    break;
    case  CRNRSTN_UI_DAYLIGHT:

        //
        // LIKE CRNRSTN_UI_HTML BUT...LIGHTER. NOTHING COULD BE LIGHTER.
        $tmp_theme_attributes_ARRAY['highlight.comment'] = '#5AC86C';
        $tmp_theme_attributes_ARRAY['highlight.default'] = '#CC6762';
        $tmp_theme_attributes_ARRAY['highlight.html'] = '#666';
        $tmp_theme_attributes_ARRAY['highlight.keyword'] = '#C08E1A; font-weight: normal;';
        $tmp_theme_attributes_ARRAY['highlight.string'] = '#5F5FD0';

        $tmp_theme_attributes_ARRAY['stage.canvas.background-color'] = '#F7F5F5';
        $tmp_theme_attributes_ARRAY['stage.canvas.background-opacity'] = 'filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=100); opacity: 1.0';
        $tmp_theme_attributes_ARRAY['stage.canvas.border-width'] = '3px';
        $tmp_theme_attributes_ARRAY['stage.canvas.border-color'] = '#80A0DD';
        $tmp_theme_attributes_ARRAY['stage.canvas.border-style'] = 'solid';
        $tmp_theme_attributes_ARRAY['stage.content.background-opacity'] = 'filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=100); opacity: 1.0';
        $tmp_theme_attributes_ARRAY['stage.content.highlight-color'] = '#F5EDDA';
        $tmp_theme_attributes_ARRAY['stage.lnum.css.right-border-width'] = '1px';
        $tmp_theme_attributes_ARRAY['stage.lnum.css.right-border-color'] = '#5F5FD0';
        $tmp_theme_attributes_ARRAY['stage.lnum.css.right-border-style'] = 'solid';
        $tmp_theme_attributes_ARRAY['stage.lnum.css.background-color'] = '#809FDB';
        $tmp_theme_attributes_ARRAY['stage.lnum.css.color'] = '#F3F0F0';

        $tmp_theme_attributes_ARRAY['stage.canvas.box-shadow.inset'][] = '';
        $tmp_theme_attributes_ARRAY['stage.canvas.box-shadow.offset-x'][] = '3px';
        $tmp_theme_attributes_ARRAY['stage.canvas.box-shadow.offset-y'][] = '3px';
        $tmp_theme_attributes_ARRAY['stage.canvas.box-shadow.blur-radius'][] = '3px';
        $tmp_theme_attributes_ARRAY['stage.canvas.box-shadow.spread-radius'][] = '';
        $tmp_theme_attributes_ARRAY['stage.canvas.box-shadow.color'][] = '#BFBFBF';

    break;
    case  CRNRSTN_UI_FEATHER:
        
        //
        // LIGHTER THAN DAYLIGHT.
        $tmp_theme_attributes_ARRAY['highlight.comment'] = '#7CD38B';
        $tmp_theme_attributes_ARRAY['highlight.default'] = '#D78783';
        $tmp_theme_attributes_ARRAY['highlight.html'] = '#868686';
        $tmp_theme_attributes_ARRAY['highlight.keyword'] = '#CDA54A; font-weight: normal;';
        $tmp_theme_attributes_ARRAY['highlight.string'] = '#8080DA';

        $tmp_theme_attributes_ARRAY['stage.canvas.background-color'] = '#FFF';
        $tmp_theme_attributes_ARRAY['stage.canvas.background-opacity'] = 'filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=100); opacity: 1.0';
        $tmp_theme_attributes_ARRAY['stage.canvas.border-width'] = '3px';
        $tmp_theme_attributes_ARRAY['stage.canvas.border-color'] = '#ECEFF2';
        $tmp_theme_attributes_ARRAY['stage.canvas.border-style'] = 'solid';
        $tmp_theme_attributes_ARRAY['stage.content.background-opacity'] = 'filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=100); opacity: 1.0';
        $tmp_theme_attributes_ARRAY['stage.content.highlight-color'] = '#F7F1E2';
        $tmp_theme_attributes_ARRAY['stage.lnum.css.right-border-width'] = '1px';
        $tmp_theme_attributes_ARRAY['stage.lnum.css.right-border-color'] = '#D6D6F0';
        $tmp_theme_attributes_ARRAY['stage.lnum.css.right-border-style'] = 'solid';
        $tmp_theme_attributes_ARRAY['stage.lnum.css.background-color'] = '#D4E1EE';
        $tmp_theme_attributes_ARRAY['stage.lnum.css.color'] = '#FFF';

        // * offset-x | offset-y | blur-radius | spread-radius | color
        // <div style="box-shadow: 2px 3px 3px 0 #bfbfbf;">
        $tmp_theme_attributes_ARRAY['stage.canvas.box-shadow.inset'][] = '';
        $tmp_theme_attributes_ARRAY['stage.canvas.box-shadow.offset-x'][] = '3px';
        $tmp_theme_attributes_ARRAY['stage.canvas.box-shadow.offset-y'][] = '3px';
        $tmp_theme_attributes_ARRAY['stage.canvas.box-shadow.blur-radius'][] = '3px';
        $tmp_theme_attributes_ARRAY['stage.canvas.box-shadow.spread-radius'][] = '';
        $tmp_theme_attributes_ARRAY['stage.canvas.box-shadow.color'][] = '#BFBFBF';

    break;
    case  CRNRSTN_UI_GLASS_LIGHT_COPY:

        // CONCEPT WORK IN PROGRESS.
        $tmp_theme_attributes_ARRAY['highlight.comment'] = '#7CD38B';
        $tmp_theme_attributes_ARRAY['highlight.default'] = '#D78783';
        $tmp_theme_attributes_ARRAY['highlight.html'] = '#868686';
        $tmp_theme_attributes_ARRAY['highlight.keyword'] = '#CDA54A; font-weight: normal;';
        $tmp_theme_attributes_ARRAY['highlight.string'] = '#8080DA';

        $tmp_theme_attributes_ARRAY['stage.canvas.background-color'] = 'transparent';
        $tmp_theme_attributes_ARRAY['stage.canvas.background-opacity'] = 'filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=100); opacity: 1.0';
        $tmp_theme_attributes_ARRAY['stage.canvas.border-width'] = '3px';
        $tmp_theme_attributes_ARRAY['stage.canvas.border-color'] = '#ECEFF2';
        $tmp_theme_attributes_ARRAY['stage.canvas.border-style'] = 'solid';
        $tmp_theme_attributes_ARRAY['stage.content.background-opacity'] = 'filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=100); opacity: 1.0';
        $tmp_theme_attributes_ARRAY['stage.content.highlight-color'] = '#F7F1E2';
        $tmp_theme_attributes_ARRAY['stage.lnum.css.right-border-width'] = '1px';
        $tmp_theme_attributes_ARRAY['stage.lnum.css.right-border-color'] = '#D6D6F0';
        $tmp_theme_attributes_ARRAY['stage.lnum.css.right-border-style'] = 'solid';
        $tmp_theme_attributes_ARRAY['stage.lnum.css.background-color'] = '#D4E1EE';
        $tmp_theme_attributes_ARRAY['stage.lnum.css.color'] = '#FFF';

        $tmp_theme_attributes_ARRAY['stage.canvas.box-shadow.inset'][] = '';
        $tmp_theme_attributes_ARRAY['stage.canvas.box-shadow.offset-x'][] = '3px';
        $tmp_theme_attributes_ARRAY['stage.canvas.box-shadow.offset-y'][] = '3px';
        $tmp_theme_attributes_ARRAY['stage.canvas.box-shadow.blur-radius'][] = '3px';
        $tmp_theme_attributes_ARRAY['stage.canvas.box-shadow.spread-radius'][] = '';
        $tmp_theme_attributes_ARRAY['stage.canvas.box-shadow.color'][] = '#BFBFBF';

    break;
    case  CRNRSTN_UI_GLASS_DARK_COPY:
        
        // CONCEPT WORK IN PROGRESS.
        $tmp_theme_attributes_ARRAY['highlight.comment'] = '#008000';
        $tmp_theme_attributes_ARRAY['highlight.default'] = '#191A31';
        $tmp_theme_attributes_ARRAY['highlight.html'] = '#808080';
        $tmp_theme_attributes_ARRAY['highlight.keyword'] = '#00B; font-weight: normal';
        $tmp_theme_attributes_ARRAY['highlight.string'] = '#D00';

        $tmp_theme_attributes_ARRAY['stage.canvas.background-color'] = 'transparent';
        $tmp_theme_attributes_ARRAY['stage.canvas.background-opacity'] = 'filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=100); opacity: 1.0';
        $tmp_theme_attributes_ARRAY['stage.canvas.border-width'] = '3px';
        $tmp_theme_attributes_ARRAY['stage.canvas.border-color'] = '#ECEFF2';
        $tmp_theme_attributes_ARRAY['stage.canvas.border-style'] = 'solid';
        $tmp_theme_attributes_ARRAY['stage.content.background-opacity'] = 'filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=100); opacity: 1.0';
        $tmp_theme_attributes_ARRAY['stage.content.highlight-color'] = '#EFEFFB';
        $tmp_theme_attributes_ARRAY['stage.lnum.css.right-border-width'] = '1px';
        $tmp_theme_attributes_ARRAY['stage.lnum.css.right-border-color'] = '#D6D6F0';
        $tmp_theme_attributes_ARRAY['stage.lnum.css.right-border-style'] = 'solid';
        $tmp_theme_attributes_ARRAY['stage.lnum.css.background-color'] = '#D4E1EE';
        $tmp_theme_attributes_ARRAY['stage.lnum.css.color'] = '#FFF';

        $tmp_theme_attributes_ARRAY['stage.canvas.box-shadow.inset'][] = '';
        $tmp_theme_attributes_ARRAY['stage.canvas.box-shadow.offset-x'][] = '3px';
        $tmp_theme_attributes_ARRAY['stage.canvas.box-shadow.offset-y'][] = '3px';
        $tmp_theme_attributes_ARRAY['stage.canvas.box-shadow.blur-radius'][] = '3px';
        $tmp_theme_attributes_ARRAY['stage.canvas.box-shadow.spread-radius'][] = '';
        $tmp_theme_attributes_ARRAY['stage.canvas.box-shadow.color'][] = '#BFBFBF';

    break;
    case  CRNRSTN_UI_WOOD:

        // GOT WOOD?
        $tmp_theme_attributes_ARRAY['highlight.comment'] = '#7CD38B';
        $tmp_theme_attributes_ARRAY['highlight.default'] = '#D78783';
        $tmp_theme_attributes_ARRAY['highlight.html'] = '#868686';
        $tmp_theme_attributes_ARRAY['highlight.keyword'] = '#CDA54A; font-weight: normal;';
        $tmp_theme_attributes_ARRAY['highlight.string'] = '#8080DA';

        $tmp_theme_attributes_ARRAY['stage.canvas.background-color'] = 'transparent';
        $tmp_theme_attributes_ARRAY['stage.canvas.background-opacity'] = 'filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=100); opacity: 1.0';
        $tmp_theme_attributes_ARRAY['stage.canvas.border-width'] = '3px';
        $tmp_theme_attributes_ARRAY['stage.canvas.border-color'] = '#ECEFF2';
        $tmp_theme_attributes_ARRAY['stage.canvas.border-style'] = 'solid';
        $tmp_theme_attributes_ARRAY['stage.content.background-opacity'] = 'filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=100); opacity: 1.0';
        $tmp_theme_attributes_ARRAY['stage.content.highlight-color'] = '#F7F1E2';
        $tmp_theme_attributes_ARRAY['stage.lnum.css.right-border-width'] = '1px';
        $tmp_theme_attributes_ARRAY['stage.lnum.css.right-border-color'] = '#D6D6F0';
        $tmp_theme_attributes_ARRAY['stage.lnum.css.right-border-style'] = 'solid';
        $tmp_theme_attributes_ARRAY['stage.lnum.css.background-color'] = '#D4E1EE';
        $tmp_theme_attributes_ARRAY['stage.lnum.css.color'] = '#FFF';

        $tmp_theme_attributes_ARRAY['stage.canvas.box-shadow.inset'][] = '';
        $tmp_theme_attributes_ARRAY['stage.canvas.box-shadow.offset-x'][] = '3px';
        $tmp_theme_attributes_ARRAY['stage.canvas.box-shadow.offset-y'][] = '3px';
        $tmp_theme_attributes_ARRAY['stage.canvas.box-shadow.blur-radius'][] = '3px';
        $tmp_theme_attributes_ARRAY['stage.canvas.box-shadow.spread-radius'][] = '';
        $tmp_theme_attributes_ARRAY['stage.canvas.box-shadow.color'][] = '#BFBFBF';

    break;
    case  CRNRSTN_UI_TERMINAL:
        
        //
        // HARDCORE.
        $tmp_theme_attributes_ARRAY['highlight.comment'] = '#257129';
        $tmp_theme_attributes_ARRAY['highlight.default'] = '#41DB3C';
        $tmp_theme_attributes_ARRAY['highlight.html'] = '#EBEBEB';
        $tmp_theme_attributes_ARRAY['highlight.keyword'] = '#19EE28; font-weight: bold';
        $tmp_theme_attributes_ARRAY['highlight.string'] = '#54B33E';

        $tmp_theme_attributes_ARRAY['stage.canvas.background-color'] = '#131314';
        $tmp_theme_attributes_ARRAY['stage.canvas.background-opacity'] = 'filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=100); opacity: 1.0';
        $tmp_theme_attributes_ARRAY['stage.canvas.border-width'] = '3px';
        $tmp_theme_attributes_ARRAY['stage.canvas.border-color'] = '#000';
        $tmp_theme_attributes_ARRAY['stage.canvas.border-style'] = 'solid';
        $tmp_theme_attributes_ARRAY['stage.content.background-opacity'] = 'filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=100); opacity: 1.0';
        $tmp_theme_attributes_ARRAY['stage.content.highlight-color'] = '#073F0B';
        $tmp_theme_attributes_ARRAY['stage.lnum.css.right-border-width'] = '1px';
        $tmp_theme_attributes_ARRAY['stage.lnum.css.right-border-color'] = '#0C8800';
        $tmp_theme_attributes_ARRAY['stage.lnum.css.right-border-style'] = 'solid';
        $tmp_theme_attributes_ARRAY['stage.lnum.css.background-color'] = '#282828';
        $tmp_theme_attributes_ARRAY['stage.lnum.css.color'] = '#1FA61F';

        $tmp_theme_attributes_ARRAY['stage.canvas.box-shadow.inset'][] = '';
        $tmp_theme_attributes_ARRAY['stage.canvas.box-shadow.offset-x'][] = '3px';
        $tmp_theme_attributes_ARRAY['stage.canvas.box-shadow.offset-y'][] = '3px';
        $tmp_theme_attributes_ARRAY['stage.canvas.box-shadow.blur-radius'][] = '3px';
        $tmp_theme_attributes_ARRAY['stage.canvas.box-shadow.spread-radius'][] = '';
        $tmp_theme_attributes_ARRAY['stage.canvas.box-shadow.color'][] = '#BFBFBF';
        
    break;
    case  CRNRSTN_UI_DARKNIGHT:
    default:

        //
        // LIKE CRNRSTN_UI_PHPNIGHT, BUT DARKER.
        // NOTHING COULD BE DARKER. NOTHING.
        $tmp_theme_attributes_ARRAY['highlight.comment'] = '#006498';
        $tmp_theme_attributes_ARRAY['highlight.default'] = '#9E9D9F';
        $tmp_theme_attributes_ARRAY['highlight.html'] = '#8C8C8C';
        $tmp_theme_attributes_ARRAY['highlight.keyword'] = '#CB733F; font-weight: normal';
        $tmp_theme_attributes_ARRAY['highlight.string'] = '#216D10';

        $tmp_theme_attributes_ARRAY['stage.canvas.background-color'] = '#04050A';
        $tmp_theme_attributes_ARRAY['stage.canvas.background-opacity'] = 'filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=100); opacity: 1.0';
        $tmp_theme_attributes_ARRAY['stage.canvas.border-width'] = '3px';
        $tmp_theme_attributes_ARRAY['stage.canvas.border-color'] = '#000';
        $tmp_theme_attributes_ARRAY['stage.canvas.border-style'] = 'solid';
        $tmp_theme_attributes_ARRAY['stage.content.background-opacity'] = 'filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=100); opacity: 1.0';
        $tmp_theme_attributes_ARRAY['stage.content.highlight-color'] = '#052E08';
        $tmp_theme_attributes_ARRAY['stage.lnum.css.right-border-width'] = '1px';
        $tmp_theme_attributes_ARRAY['stage.lnum.css.right-border-color'] = '#4B4444';
        $tmp_theme_attributes_ARRAY['stage.lnum.css.right-border-style'] = 'solid';
        $tmp_theme_attributes_ARRAY['stage.lnum.css.background-color'] = '#111';
        $tmp_theme_attributes_ARRAY['stage.lnum.css.color'] = '#1A6F1A';

        $tmp_theme_attributes_ARRAY['stage.canvas.box-shadow.inset'][] = '';
        $tmp_theme_attributes_ARRAY['stage.canvas.box-shadow.offset-x'][] = '3px';
        $tmp_theme_attributes_ARRAY['stage.canvas.box-shadow.offset-y'][] = '3px';
        $tmp_theme_attributes_ARRAY['stage.canvas.box-shadow.blur-radius'][] = '3px';
        $tmp_theme_attributes_ARRAY['stage.canvas.box-shadow.spread-radius'][] = '';
        $tmp_theme_attributes_ARRAY['stage.canvas.box-shadow.color'][] = '#BFBFBF';

        // CRNRSTN :: INTERACT UI
        $tmp_theme_attributes_ARRAY['interact.ui.document_bg_overlay_background_color'][] = '#003eff';
        $tmp_theme_attributes_ARRAY['interact.ui.document_bg_overlay_background_opacity'][] = '0.8';
        $tmp_theme_attributes_ARRAY['interact.ui.document_bg_overlay_background_zindex'][] = '1';

    break;

}