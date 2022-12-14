<?php
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
// CRNRSTN_UI_GLASS_DARK_COPY
// CRNRSTN_UI_WOOD
// CRNRSTN_UI_TERMINAL,
// CRNRSTN_UI_RANDOM);

$tmp_theme_attributes_ARRAY = array();
$tmp_pos = 0;

//
// REPLICATION OF LEAD DEVELOPER IDE THEME. HOW CRNRSTN :: LIGHTSABER LOOKS TO ME.
$int_const = CRNRSTN_UI_PHPNIGHT;
$tmp_resource_meta_ARRAY = $this->return_int_const_profile($int_const);
$tmp_theme_attributes_ARRAY[$int_const]['NOM_STRING'] = $tmp_resource_meta_ARRAY['STRING'];
$tmp_theme_attributes_ARRAY[$int_const]['INTEGER'] = $tmp_resource_meta_ARRAY['INTEGER'];
$tmp_theme_attributes_ARRAY[$int_const]['TITLE'] = $tmp_resource_meta_ARRAY['TITLE'];
$tmp_theme_attributes_ARRAY[$int_const]['DESCRIPTION'] = $tmp_resource_meta_ARRAY['DESCRIPTION'];
$tmp_theme_attributes_ARRAY[$int_const]['POSITION'] = $tmp_pos++;
$tmp_theme_attributes_ARRAY[$int_const]['DISPLAY_POSITION'] = 0;
$tmp_theme_attributes_ARRAY[$int_const]['IS_ACTIVE'] = 0;
if($this->is_bit_set($int_const)) $tmp_theme_attributes_ARRAY[$int_const]['IS_ACTIVE'] = 1;

$tmp_theme_attributes_ARRAY[$int_const]['highlight.comment'] = '#7EC3E6';
$tmp_theme_attributes_ARRAY[$int_const]['highlight.default'] = '#9876AA';
$tmp_theme_attributes_ARRAY[$int_const]['highlight.html'] = '#EBEBEB';
$tmp_theme_attributes_ARRAY[$int_const]['highlight.keyword'] = '#ED864A; font-weight: normal';
$tmp_theme_attributes_ARRAY[$int_const]['highlight.string'] = '#54B33E';

$tmp_theme_attributes_ARRAY[$int_const]['stage.canvas.background-color'] = '#131314';
$tmp_theme_attributes_ARRAY[$int_const]['stage.canvas.background-opacity'] = 'filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=100); opacity: 1.0';
$tmp_theme_attributes_ARRAY[$int_const]['stage.canvas.border-width'] = '3px';
$tmp_theme_attributes_ARRAY[$int_const]['stage.canvas.border-color'] = '#9E9E9E';
$tmp_theme_attributes_ARRAY[$int_const]['stage.canvas.border-style'] = 'solid';
$tmp_theme_attributes_ARRAY[$int_const]['stage.content.background-opacity'] = 'filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=100); opacity: 1.0';
$tmp_theme_attributes_ARRAY[$int_const]['stage.content.highlight-color'] = '#393939';
$tmp_theme_attributes_ARRAY[$int_const]['stage.lnum.css.right-border-width'] = '1px';
$tmp_theme_attributes_ARRAY[$int_const]['stage.lnum.css.right-border-color'] = '#833131';
$tmp_theme_attributes_ARRAY[$int_const]['stage.lnum.css.right-border-style'] = 'solid';
$tmp_theme_attributes_ARRAY[$int_const]['stage.lnum.css.background-color'] = '#282828';
$tmp_theme_attributes_ARRAY[$int_const]['stage.lnum.css.color'] = '#00D500';

$tmp_theme_attributes_ARRAY[$int_const]['stage.canvas.box-shadow.inset'][] = '';
$tmp_theme_attributes_ARRAY[$int_const]['stage.canvas.box-shadow.offset-x'][] = '3px';
$tmp_theme_attributes_ARRAY[$int_const]['stage.canvas.box-shadow.offset-y'][] = '3px';
$tmp_theme_attributes_ARRAY[$int_const]['stage.canvas.box-shadow.blur-radius'][] = '3px';
$tmp_theme_attributes_ARRAY[$int_const]['stage.canvas.box-shadow.spread-radius'][] = '';
$tmp_theme_attributes_ARRAY[$int_const]['stage.canvas.box-shadow.color'][] = '#BFBFBF';

// CRNRSTN :: INTERACT UI
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_bg_overlay_background_color'][] = '#003eff';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_bg_overlay_background_opacity'][] = '0.8';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_bg_overlay_background_zindex'][] = '1';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_copy_overflowrap'][] = 'break-word';

//
// CRNRSTN :: INTERACT UI
// DOCUMENTATION PAGE TITLE SECTION :: PAGE TITLE
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_font_family'][] = 'Arial, Helvetica, sans-serif';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_font_weight'][] = 'bold';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_color'][] = '#333';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_line_height'][] = '55px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_padding_top'][] = '0';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_padding_right'][] = '10px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_padding_bottom'][] = '0';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_padding_left'][] = '20px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_text_shadow'][] = '1px 1px 2px #ECECEC, 0 0 1em #ECECEC, 0 0 0.2em #ECECEC';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_font_size_h1'][] = '45px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_font_size_h2'][] = '35px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_font_size_h3'][] = '25px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_font_size_h4'][] = '15px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_margin_bottom'][] = '0';

//
// CRNRSTN :: INTERACT UI
// DOCUMENTATION PAGE TITLE SECTION :: PAGE TITLE DESCRIPTION
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_font_family'][] = 'Arial, Helvetica, sans-serif';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_color'][] = '#333';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_width'][] = '90%';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_font_size'][] = '20px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_overflow_wrap'][] = 'break-word';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_padding_top'][] = '12px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_padding_right'][] = '10px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_padding_bottom'][] = '25px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_padding_left'][] = '20px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_line_height'][] = '33px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_text_shadow'][] = '1px 1px 2px #ECECEC, 0 0 1em #ECECEC, 0 0 0.2em #ECECEC';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_paragraph_padding'][] = '0';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_paragraph_margin'][] = '0';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_paragraph_text_align'][] = 'left';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_paragraph_anchor_text_decoration'][] = 'none';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_paragraph_anchor_color'][] = '#0066CC';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_text_embed_image_padding_top'][] = '0';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_text_embed_image_padding_right'][] = '6px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_text_embed_image_padding_bottom'][] = '0';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_text_embed_image_padding_left'][] = '0';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_text_embed_image_line_height'][] = '90px';

//
// CRNRSTN :: INTERACT UI
// DOCUMENTATION GENERAL :: ALERT / CAUTION NOTE
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_alert_caution_border_wrap_border'][] = '1px solid #A5B9D8';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_alert_caution_border_wrap_margin'][] = '10px 20px 10px 20px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_alert_caution_border_wrap_padding'][] = '10px 0 10px 0';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_alert_caution_bg_icon_wrap_top'][] = '-120px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_alert_caution_bg_icon_wrap_left'][] = '48%';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_alert_caution_copy_width'][] = '85%';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_alert_caution_copy_text_align'][] = 'left';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_alert_caution_copy_paragraph_padding'][] = '0 10px 0 20px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_alert_caution_copy_paragraph_background_color'][] = 'rgba(255, 255, 255, 0.67)';
/*//////////
//////////

*/

//
// LIKE CRNRSTN_UI_PHPNIGHT, BUT DARKER.
// NOTHING COULD BE DARKER. NOTHING.
$int_const = CRNRSTN_UI_DARKNIGHT;
$tmp_resource_meta_ARRAY = $this->return_int_const_profile($int_const);
$tmp_theme_attributes_ARRAY[$int_const]['NOM_STRING'] = $tmp_resource_meta_ARRAY['STRING'];
$tmp_theme_attributes_ARRAY[$int_const]['INTEGER'] = $tmp_resource_meta_ARRAY['INTEGER'];
$tmp_theme_attributes_ARRAY[$int_const]['TITLE'] = $tmp_resource_meta_ARRAY['TITLE'];
$tmp_theme_attributes_ARRAY[$int_const]['DESCRIPTION'] = $tmp_resource_meta_ARRAY['DESCRIPTION'];
$tmp_theme_attributes_ARRAY[$int_const]['POSITION'] = $tmp_pos++;
$tmp_theme_attributes_ARRAY[$int_const]['DISPLAY_POSITION'] = 1;
$tmp_theme_attributes_ARRAY[$int_const]['IS_ACTIVE'] = 0;
if($this->is_bit_set($int_const)) $tmp_theme_attributes_ARRAY[$int_const]['IS_ACTIVE'] = 1;

$tmp_theme_attributes_ARRAY[$int_const]['highlight.comment'] = '#006498';
$tmp_theme_attributes_ARRAY[$int_const]['highlight.default'] = '#9E9D9F';
$tmp_theme_attributes_ARRAY[$int_const]['highlight.html'] = '#8C8C8C';
$tmp_theme_attributes_ARRAY[$int_const]['highlight.keyword'] = '#CB733F; font-weight: normal';
$tmp_theme_attributes_ARRAY[$int_const]['highlight.string'] = '#216D10';

$tmp_theme_attributes_ARRAY[$int_const]['stage.canvas.background-color'] = '#04050A';
$tmp_theme_attributes_ARRAY[$int_const]['stage.canvas.background-opacity'] = 'filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=100); opacity: 1.0';
$tmp_theme_attributes_ARRAY[$int_const]['stage.canvas.border-width'] = '3px';
$tmp_theme_attributes_ARRAY[$int_const]['stage.canvas.border-color'] = '#000';
$tmp_theme_attributes_ARRAY[$int_const]['stage.canvas.border-style'] = 'solid';
$tmp_theme_attributes_ARRAY[$int_const]['stage.content.background-opacity'] = 'filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=100); opacity: 1.0';
$tmp_theme_attributes_ARRAY[$int_const]['stage.content.highlight-color'] = '#052E08';
$tmp_theme_attributes_ARRAY[$int_const]['stage.lnum.css.right-border-width'] = '1px';
$tmp_theme_attributes_ARRAY[$int_const]['stage.lnum.css.right-border-color'] = '#4B4444';
$tmp_theme_attributes_ARRAY[$int_const]['stage.lnum.css.right-border-style'] = 'solid';
$tmp_theme_attributes_ARRAY[$int_const]['stage.lnum.css.background-color'] = '#111';
$tmp_theme_attributes_ARRAY[$int_const]['stage.lnum.css.color'] = '#1A6F1A';

$tmp_theme_attributes_ARRAY[$int_const]['stage.canvas.box-shadow.inset'][] = '';
$tmp_theme_attributes_ARRAY[$int_const]['stage.canvas.box-shadow.offset-x'][] = '3px';
$tmp_theme_attributes_ARRAY[$int_const]['stage.canvas.box-shadow.offset-y'][] = '3px';
$tmp_theme_attributes_ARRAY[$int_const]['stage.canvas.box-shadow.blur-radius'][] = '3px';
$tmp_theme_attributes_ARRAY[$int_const]['stage.canvas.box-shadow.spread-radius'][] = '';
$tmp_theme_attributes_ARRAY[$int_const]['stage.canvas.box-shadow.color'][] = '#BFBFBF';

//
// CRNRSTN :: INTERACT UI
// DOCUMENTATION BACKGROUND OVERLAY
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_bg_overlay_background_color'][] = '#003eff';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_bg_overlay_background_opacity'][] = '0.8';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_bg_overlay_background_zindex'][] = '1';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_copy_overflowrap'][] = 'break-word';

//
// CRNRSTN :: INTERACT UI
// DOCUMENTATION PAGE TITLE SECTION :: PAGE TITLE
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_font_family'][] = 'Arial, Helvetica, sans-serif';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_font_weight'][] = 'bold';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_color'][] = '#333';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_line_height'][] = '55px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_padding_top'][] = '0';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_padding_right'][] = '10px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_padding_bottom'][] = '0';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_padding_left'][] = '20px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_text_shadow'][] = '1px 1px 2px #ECECEC, 0 0 1em #ECECEC, 0 0 0.2em #ECECEC';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_font_size_h1'][] = '45px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_font_size_h2'][] = '35px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_font_size_h3'][] = '25px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_font_size_h4'][] = '15px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_margin_bottom'][] = '0';

//
// CRNRSTN :: INTERACT UI
// DOCUMENTATION PAGE TITLE SECTION :: PAGE TITLE DESCRIPTION
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_font_family'][] = 'Arial, Helvetica, sans-serif';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_color'][] = '#333';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_width'][] = '90%';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_font_size'][] = '20px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_overflow_wrap'][] = 'break-word';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_padding_top'][] = '12px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_padding_right'][] = '10px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_padding_bottom'][] = '25px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_padding_left'][] = '20px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_line_height'][] = '33px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_text_shadow'][] = '1px 1px 2px #ECECEC, 0 0 1em #ECECEC, 0 0 0.2em #ECECEC';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_paragraph_padding'][] = '0';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_paragraph_margin'][] = '0';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_paragraph_text_align'][] = 'left';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_paragraph_anchor_text_decoration'][] = 'none';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_paragraph_anchor_color'][] = '#0066CC';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_text_embed_image_padding_top'][] = '0';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_text_embed_image_padding_right'][] = '6px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_text_embed_image_padding_bottom'][] = '0';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_text_embed_image_padding_left'][] = '0';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_text_embed_image_line_height'][] = '90px';

//
// CRNRSTN :: INTERACT UI
// DOCUMENTATION GENERAL :: ALERT / CAUTION NOTE
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_alert_caution_border_wrap_border'][] = '1px solid #A5B9D8';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_alert_caution_border_wrap_margin'][] = '10px 20px 10px 20px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_alert_caution_border_wrap_padding'][] = '10px 0 10px 0';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_alert_caution_bg_icon_wrap_top'][] = '-120px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_alert_caution_bg_icon_wrap_left'][] = '48%';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_alert_caution_copy_width'][] = '85%';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_alert_caution_copy_text_align'][] = 'left';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_alert_caution_copy_paragraph_padding'][] = '0 10px 0 20px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_alert_caution_copy_paragraph_background_color'][] = 'rgba(255, 255, 255, 0.67)';
/*//////////
//////////

*/

//
// ALL ABOUT THE BUSINESS.
$int_const = CRNRSTN_UI_PHP;
$tmp_resource_meta_ARRAY = $this->return_int_const_profile($int_const);
$tmp_theme_attributes_ARRAY[$int_const]['NOM_STRING'] = $tmp_resource_meta_ARRAY['STRING'];
$tmp_theme_attributes_ARRAY[$int_const]['INTEGER'] = $tmp_resource_meta_ARRAY['INTEGER'];
$tmp_theme_attributes_ARRAY[$int_const]['TITLE'] = $tmp_resource_meta_ARRAY['TITLE'];
$tmp_theme_attributes_ARRAY[$int_const]['DESCRIPTION'] = $tmp_resource_meta_ARRAY['DESCRIPTION'];
$tmp_theme_attributes_ARRAY[$int_const]['POSITION'] = $tmp_pos++;
$tmp_theme_attributes_ARRAY[$int_const]['DISPLAY_POSITION'] = 2;
$tmp_theme_attributes_ARRAY[$int_const]['IS_ACTIVE'] = 0;
if($this->is_bit_set($int_const)) $tmp_theme_attributes_ARRAY[$int_const]['IS_ACTIVE'] = 1;

$tmp_theme_attributes_ARRAY[$int_const]['highlight.comment'] = '#008000';
$tmp_theme_attributes_ARRAY[$int_const]['highlight.default'] = '#191A31';
$tmp_theme_attributes_ARRAY[$int_const]['highlight.html'] = '#808080';
$tmp_theme_attributes_ARRAY[$int_const]['highlight.keyword'] = '#00B; font-weight: normal';
$tmp_theme_attributes_ARRAY[$int_const]['highlight.string'] = '#D00';

$tmp_theme_attributes_ARRAY[$int_const]['stage.canvas.background-color'] = '#F2F2F2';
$tmp_theme_attributes_ARRAY[$int_const]['stage.canvas.background-opacity'] = 'filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=100); opacity: 1.0';
$tmp_theme_attributes_ARRAY[$int_const]['stage.canvas.border-width'] = '3px';
$tmp_theme_attributes_ARRAY[$int_const]['stage.canvas.border-color'] = '#C2C7DF';
$tmp_theme_attributes_ARRAY[$int_const]['stage.canvas.border-style'] = 'solid';
$tmp_theme_attributes_ARRAY[$int_const]['stage.content.background-opacity'] = 'filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=100); opacity: 1.0';
$tmp_theme_attributes_ARRAY[$int_const]['stage.content.highlight-color'] = '#D6D6F4';
$tmp_theme_attributes_ARRAY[$int_const]['stage.lnum.css.right-border-width'] = '1px';
$tmp_theme_attributes_ARRAY[$int_const]['stage.lnum.css.right-border-color'] = '#2C2C2C';
$tmp_theme_attributes_ARRAY[$int_const]['stage.lnum.css.right-border-style'] = 'solid';
$tmp_theme_attributes_ARRAY[$int_const]['stage.lnum.css.background-color'] = '#787CAF';
$tmp_theme_attributes_ARRAY[$int_const]['stage.lnum.css.color'] = '#EEE8E8';

$tmp_theme_attributes_ARRAY[$int_const]['stage.canvas.box-shadow.inset'][] = '';
$tmp_theme_attributes_ARRAY[$int_const]['stage.canvas.box-shadow.offset-x'][] = '3px';
$tmp_theme_attributes_ARRAY[$int_const]['stage.canvas.box-shadow.offset-y'][] = '3px';
$tmp_theme_attributes_ARRAY[$int_const]['stage.canvas.box-shadow.blur-radius'][] = '3px';
$tmp_theme_attributes_ARRAY[$int_const]['stage.canvas.box-shadow.spread-radius'][] = '';
$tmp_theme_attributes_ARRAY[$int_const]['stage.canvas.box-shadow.color'][] = '#BFBFBF';

// CRNRSTN :: INTERACT UI
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_bg_overlay_background_color'][] = '#003eff';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_bg_overlay_background_opacity'][] = '0.8';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_bg_overlay_background_zindex'][] = '1';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_copy_overflowrap'][] = 'break-word';

//
// CRNRSTN :: INTERACT UI
// DOCUMENTATION PAGE TITLE SECTION :: PAGE TITLE
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_font_family'][] = 'Arial, Helvetica, sans-serif';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_font_weight'][] = 'bold';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_color'][] = '#333';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_line_height'][] = '55px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_padding_top'][] = '0';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_padding_right'][] = '10px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_padding_bottom'][] = '0';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_padding_left'][] = '20px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_text_shadow'][] = '1px 1px 2px #ECECEC, 0 0 1em #ECECEC, 0 0 0.2em #ECECEC';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_font_size_h1'][] = '45px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_font_size_h2'][] = '35px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_font_size_h3'][] = '25px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_font_size_h4'][] = '15px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_margin_bottom'][] = '0';

//
// CRNRSTN :: INTERACT UI
// DOCUMENTATION PAGE TITLE SECTION :: PAGE TITLE DESCRIPTION
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_font_family'][] = 'Arial, Helvetica, sans-serif';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_color'][] = '#333';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_width'][] = '90%';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_font_size'][] = '20px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_overflow_wrap'][] = 'break-word';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_padding_top'][] = '12px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_padding_right'][] = '10px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_padding_bottom'][] = '25px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_padding_left'][] = '20px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_line_height'][] = '33px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_text_shadow'][] = '1px 1px 2px #ECECEC, 0 0 1em #ECECEC, 0 0 0.2em #ECECEC';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_paragraph_padding'][] = '0';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_paragraph_margin'][] = '0';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_paragraph_text_align'][] = 'left';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_paragraph_anchor_text_decoration'][] = 'none';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_paragraph_anchor_color'][] = '#0066CC';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_text_embed_image_padding_top'][] = '0';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_text_embed_image_padding_right'][] = '6px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_text_embed_image_padding_bottom'][] = '0';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_text_embed_image_padding_left'][] = '0';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_text_embed_image_line_height'][] = '90px';

//
// CRNRSTN :: INTERACT UI
// DOCUMENTATION GENERAL :: ALERT / CAUTION NOTE
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_alert_caution_border_wrap_border'][] = '1px solid #A5B9D8';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_alert_caution_border_wrap_margin'][] = '10px 20px 10px 20px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_alert_caution_border_wrap_padding'][] = '10px 0 10px 0';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_alert_caution_bg_icon_wrap_top'][] = '-120px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_alert_caution_bg_icon_wrap_left'][] = '48%';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_alert_caution_copy_width'][] = '85%';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_alert_caution_copy_text_align'][] = 'left';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_alert_caution_copy_paragraph_padding'][] = '0 10px 0 20px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_alert_caution_copy_paragraph_background_color'][] = 'rgba(255, 255, 255, 0.67)';
/*//////////
//////////

*/

//
// ALONE AND SAD WITH A NICE CUP OF COFFEE, A RACK MOUNTED
// DUAL-VIDEO CARD MAC PRO, AND FOUR (4) APPLE PRO DISPLAYS.
$int_const = CRNRSTN_UI_GREYSKYS;
$tmp_resource_meta_ARRAY = $this->return_int_const_profile($int_const);
$tmp_theme_attributes_ARRAY[$int_const]['NOM_STRING'] = $tmp_resource_meta_ARRAY['STRING'];
$tmp_theme_attributes_ARRAY[$int_const]['INTEGER'] = $tmp_resource_meta_ARRAY['INTEGER'];
$tmp_theme_attributes_ARRAY[$int_const]['TITLE'] = $tmp_resource_meta_ARRAY['TITLE'];
$tmp_theme_attributes_ARRAY[$int_const]['DESCRIPTION'] = $tmp_resource_meta_ARRAY['DESCRIPTION'];
$tmp_theme_attributes_ARRAY[$int_const]['POSITION'] = $tmp_pos++;
$tmp_theme_attributes_ARRAY[$int_const]['DISPLAY_POSITION'] = 3;
$tmp_theme_attributes_ARRAY[$int_const]['IS_ACTIVE'] = 0;
if($this->is_bit_set($int_const)) $tmp_theme_attributes_ARRAY[$int_const]['IS_ACTIVE'] = 1;

$tmp_theme_attributes_ARRAY[$int_const]['highlight.comment'] = '#D4762D';
$tmp_theme_attributes_ARRAY[$int_const]['highlight.default'] = '#939393';
$tmp_theme_attributes_ARRAY[$int_const]['highlight.html'] = '#C8C8C8';
$tmp_theme_attributes_ARRAY[$int_const]['highlight.keyword'] = '#212121; font-weight: normal';
$tmp_theme_attributes_ARRAY[$int_const]['highlight.string'] = '#421414';

$tmp_theme_attributes_ARRAY[$int_const]['stage.canvas.background-color'] = '#F5F5F5';
$tmp_theme_attributes_ARRAY[$int_const]['stage.canvas.background-opacity'] = 'filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=100); opacity: 1.0';
$tmp_theme_attributes_ARRAY[$int_const]['stage.canvas.border-width'] = '3px';
$tmp_theme_attributes_ARRAY[$int_const]['stage.canvas.border-color'] = '#C3C3C3';
$tmp_theme_attributes_ARRAY[$int_const]['stage.canvas.border-style'] = 'solid';
$tmp_theme_attributes_ARRAY[$int_const]['stage.content.background-opacity'] = 'filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=100); opacity: 1.0';
$tmp_theme_attributes_ARRAY[$int_const]['stage.content.highlight-color'] = '#DBDBDB';
$tmp_theme_attributes_ARRAY[$int_const]['stage.lnum.css.right-border-width'] = '1px';
$tmp_theme_attributes_ARRAY[$int_const]['stage.lnum.css.right-border-color'] = '#333';
$tmp_theme_attributes_ARRAY[$int_const]['stage.lnum.css.right-border-style'] = 'solid';
$tmp_theme_attributes_ARRAY[$int_const]['stage.lnum.css.background-color'] = '#A5A5A5';
$tmp_theme_attributes_ARRAY[$int_const]['stage.lnum.css.color'] = '#E8E8E8';

$tmp_theme_attributes_ARRAY[$int_const]['stage.canvas.box-shadow.inset'][] = '';
$tmp_theme_attributes_ARRAY[$int_const]['stage.canvas.box-shadow.offset-x'][] = '3px';
$tmp_theme_attributes_ARRAY[$int_const]['stage.canvas.box-shadow.offset-y'][] = '3px';
$tmp_theme_attributes_ARRAY[$int_const]['stage.canvas.box-shadow.blur-radius'][] = '3px';
$tmp_theme_attributes_ARRAY[$int_const]['stage.canvas.box-shadow.spread-radius'][] = '';
$tmp_theme_attributes_ARRAY[$int_const]['stage.canvas.box-shadow.color'][] = '#BFBFBF';

// CRNRSTN :: INTERACT UI
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_bg_overlay_background_color'][] = '#003eff';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_bg_overlay_background_opacity'][] = '0.8';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_bg_overlay_background_zindex'][] = '1';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_copy_overflowrap'][] = 'break-word';

//
// CRNRSTN :: INTERACT UI
// DOCUMENTATION PAGE TITLE SECTION :: PAGE TITLE
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_font_family'][] = 'Arial, Helvetica, sans-serif';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_font_weight'][] = 'bold';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_color'][] = '#333';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_line_height'][] = '55px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_padding_top'][] = '0';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_padding_right'][] = '10px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_padding_bottom'][] = '0';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_padding_left'][] = '20px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_text_shadow'][] = '1px 1px 2px #ECECEC, 0 0 1em #ECECEC, 0 0 0.2em #ECECEC';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_font_size_h1'][] = '45px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_font_size_h2'][] = '35px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_font_size_h3'][] = '25px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_font_size_h4'][] = '15px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_margin_bottom'][] = '0';

//
// CRNRSTN :: INTERACT UI
// DOCUMENTATION PAGE TITLE SECTION :: PAGE TITLE DESCRIPTION
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_font_family'][] = 'Arial, Helvetica, sans-serif';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_color'][] = '#333';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_width'][] = '90%';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_font_size'][] = '20px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_overflow_wrap'][] = 'break-word';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_padding_top'][] = '12px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_padding_right'][] = '10px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_padding_bottom'][] = '25px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_padding_left'][] = '20px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_line_height'][] = '33px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_text_shadow'][] = '1px 1px 2px #ECECEC, 0 0 1em #ECECEC, 0 0 0.2em #ECECEC';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_paragraph_padding'][] = '0';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_paragraph_margin'][] = '0';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_paragraph_text_align'][] = 'left';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_paragraph_anchor_text_decoration'][] = 'none';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_paragraph_anchor_color'][] = '#0066CC';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_text_embed_image_padding_top'][] = '0';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_text_embed_image_padding_right'][] = '6px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_text_embed_image_padding_bottom'][] = '0';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_text_embed_image_padding_left'][] = '0';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_text_embed_image_line_height'][] = '90px';

//
// CRNRSTN :: INTERACT UI
// DOCUMENTATION GENERAL :: ALERT / CAUTION NOTE
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_alert_caution_border_wrap_border'][] = '1px solid #A5B9D8';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_alert_caution_border_wrap_margin'][] = '10px 20px 10px 20px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_alert_caution_border_wrap_padding'][] = '10px 0 10px 0';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_alert_caution_bg_icon_wrap_top'][] = '-120px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_alert_caution_bg_icon_wrap_left'][] = '48%';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_alert_caution_copy_width'][] = '85%';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_alert_caution_copy_text_align'][] = 'left';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_alert_caution_copy_paragraph_padding'][] = '0 10px 0 20px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_alert_caution_copy_paragraph_background_color'][] = 'rgba(255, 255, 255, 0.67)';
/*//////////
//////////

*/

//
// BE LIGHT AND HAPPY.
$int_const = CRNRSTN_UI_HTML;
$tmp_resource_meta_ARRAY = $this->return_int_const_profile($int_const);
$tmp_theme_attributes_ARRAY[$int_const]['NOM_STRING'] = $tmp_resource_meta_ARRAY['STRING'];
$tmp_theme_attributes_ARRAY[$int_const]['INTEGER'] = $tmp_resource_meta_ARRAY['INTEGER'];
$tmp_theme_attributes_ARRAY[$int_const]['TITLE'] = $tmp_resource_meta_ARRAY['TITLE'];
$tmp_theme_attributes_ARRAY[$int_const]['DESCRIPTION'] = $tmp_resource_meta_ARRAY['DESCRIPTION'];
$tmp_theme_attributes_ARRAY[$int_const]['POSITION'] = $tmp_pos++;
$tmp_theme_attributes_ARRAY[$int_const]['DISPLAY_POSITION'] = 4;
$tmp_theme_attributes_ARRAY[$int_const]['IS_ACTIVE'] = 0;
if($this->is_bit_set($int_const)) $tmp_theme_attributes_ARRAY[$int_const]['IS_ACTIVE'] = 1;

$tmp_theme_attributes_ARRAY[$int_const]['highlight.comment'] = '#169B2B';
$tmp_theme_attributes_ARRAY[$int_const]['highlight.default'] = '#B72620';
$tmp_theme_attributes_ARRAY[$int_const]['highlight.html'] = '#666';
$tmp_theme_attributes_ARRAY[$int_const]['highlight.keyword'] = '#C08E1A; font-weight: normal;';
$tmp_theme_attributes_ARRAY[$int_const]['highlight.string'] = '#2020BD';

$tmp_theme_attributes_ARRAY[$int_const]['stage.canvas.background-color'] = '#F3F0F0';
$tmp_theme_attributes_ARRAY[$int_const]['stage.canvas.background-opacity'] = 'filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=100); opacity: 1.0';
$tmp_theme_attributes_ARRAY[$int_const]['stage.canvas.border-width'] = '3px';
$tmp_theme_attributes_ARRAY[$int_const]['stage.canvas.border-color'] = '#80A0DD';
$tmp_theme_attributes_ARRAY[$int_const]['stage.canvas.border-style'] = 'solid';
$tmp_theme_attributes_ARRAY[$int_const]['stage.content.background-opacity'] = 'filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=100); opacity: 1.0';
$tmp_theme_attributes_ARRAY[$int_const]['stage.content.highlight-color'] = '#EBDCB8';
$tmp_theme_attributes_ARRAY[$int_const]['stage.lnum.css.right-border-width'] = '1px';
$tmp_theme_attributes_ARRAY[$int_const]['stage.lnum.css.right-border-color'] = '#333';
$tmp_theme_attributes_ARRAY[$int_const]['stage.lnum.css.right-border-style'] = 'solid';
$tmp_theme_attributes_ARRAY[$int_const]['stage.lnum.css.background-color'] = '#3F6EC9';
$tmp_theme_attributes_ARRAY[$int_const]['stage.lnum.css.color'] = '#F3F0F0';

$tmp_theme_attributes_ARRAY[$int_const]['stage.canvas.box-shadow.inset'][] = '';
$tmp_theme_attributes_ARRAY[$int_const]['stage.canvas.box-shadow.offset-x'][] = '3px';
$tmp_theme_attributes_ARRAY[$int_const]['stage.canvas.box-shadow.offset-y'][] = '3px';
$tmp_theme_attributes_ARRAY[$int_const]['stage.canvas.box-shadow.blur-radius'][] = '3px';
$tmp_theme_attributes_ARRAY[$int_const]['stage.canvas.box-shadow.spread-radius'][] = '';
$tmp_theme_attributes_ARRAY[$int_const]['stage.canvas.box-shadow.color'][] = '#BFBFBF';

// CRNRSTN :: INTERACT UI
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_bg_overlay_background_color'][] = '#003eff';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_bg_overlay_background_opacity'][] = '0.8';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_bg_overlay_background_zindex'][] = '1';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_copy_overflowrap'][] = 'break-word';

//
// CRNRSTN :: INTERACT UI
// DOCUMENTATION PAGE TITLE SECTION :: PAGE TITLE
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_font_family'][] = 'Arial, Helvetica, sans-serif';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_font_weight'][] = 'bold';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_color'][] = '#333';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_line_height'][] = '55px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_padding_top'][] = '0';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_padding_right'][] = '10px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_padding_bottom'][] = '0';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_padding_left'][] = '20px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_text_shadow'][] = '1px 1px 2px #ECECEC, 0 0 1em #ECECEC, 0 0 0.2em #ECECEC';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_font_size_h1'][] = '45px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_font_size_h2'][] = '35px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_font_size_h3'][] = '25px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_font_size_h4'][] = '15px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_margin_bottom'][] = '0';

//
// CRNRSTN :: INTERACT UI
// DOCUMENTATION PAGE TITLE SECTION :: PAGE TITLE DESCRIPTION
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_font_family'][] = 'Arial, Helvetica, sans-serif';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_color'][] = '#333';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_width'][] = '90%';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_font_size'][] = '20px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_overflow_wrap'][] = 'break-word';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_padding_top'][] = '12px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_padding_right'][] = '10px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_padding_bottom'][] = '25px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_padding_left'][] = '20px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_line_height'][] = '33px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_text_shadow'][] = '1px 1px 2px #ECECEC, 0 0 1em #ECECEC, 0 0 0.2em #ECECEC';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_paragraph_padding'][] = '0';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_paragraph_margin'][] = '0';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_paragraph_text_align'][] = 'left';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_paragraph_anchor_text_decoration'][] = 'none';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_paragraph_anchor_color'][] = '#0066CC';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_text_embed_image_padding_top'][] = '0';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_text_embed_image_padding_right'][] = '6px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_text_embed_image_padding_bottom'][] = '0';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_text_embed_image_padding_left'][] = '0';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_text_embed_image_line_height'][] = '90px';

//
// CRNRSTN :: INTERACT UI
// DOCUMENTATION GENERAL :: ALERT / CAUTION NOTE
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_alert_caution_border_wrap_border'][] = '1px solid #A5B9D8';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_alert_caution_border_wrap_margin'][] = '10px 20px 10px 20px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_alert_caution_border_wrap_padding'][] = '10px 0 10px 0';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_alert_caution_bg_icon_wrap_top'][] = '-120px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_alert_caution_bg_icon_wrap_left'][] = '48%';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_alert_caution_copy_width'][] = '85%';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_alert_caution_copy_text_align'][] = 'left';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_alert_caution_copy_paragraph_padding'][] = '0 10px 0 20px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_alert_caution_copy_paragraph_background_color'][] = 'rgba(255, 255, 255, 0.67)';
/*//////////
//////////

*/

//
// LIKE CRNRSTN_UI_HTML BUT...LIGHTER. NOTHING COULD BE LIGHTER.
$int_const = CRNRSTN_UI_DAYLIGHT;
$tmp_resource_meta_ARRAY = $this->return_int_const_profile($int_const);
$tmp_theme_attributes_ARRAY[$int_const]['NOM_STRING'] = $tmp_resource_meta_ARRAY['STRING'];
$tmp_theme_attributes_ARRAY[$int_const]['INTEGER'] = $tmp_resource_meta_ARRAY['INTEGER'];
$tmp_theme_attributes_ARRAY[$int_const]['TITLE'] = $tmp_resource_meta_ARRAY['TITLE'];
$tmp_theme_attributes_ARRAY[$int_const]['DESCRIPTION'] = $tmp_resource_meta_ARRAY['DESCRIPTION'];
$tmp_theme_attributes_ARRAY[$int_const]['POSITION'] = $tmp_pos++;
$tmp_theme_attributes_ARRAY[$int_const]['DISPLAY_POSITION'] = 5;
$tmp_theme_attributes_ARRAY[$int_const]['IS_ACTIVE'] = 0;
if($this->is_bit_set($int_const)) $tmp_theme_attributes_ARRAY[$int_const]['IS_ACTIVE'] = 1;

$tmp_theme_attributes_ARRAY[$int_const]['highlight.comment'] = '#5AC86C';
$tmp_theme_attributes_ARRAY[$int_const]['highlight.default'] = '#CC6762';
$tmp_theme_attributes_ARRAY[$int_const]['highlight.html'] = '#666';
$tmp_theme_attributes_ARRAY[$int_const]['highlight.keyword'] = '#C08E1A; font-weight: normal;';
$tmp_theme_attributes_ARRAY[$int_const]['highlight.string'] = '#5F5FD0';

$tmp_theme_attributes_ARRAY[$int_const]['stage.canvas.background-color'] = '#F7F5F5';
$tmp_theme_attributes_ARRAY[$int_const]['stage.canvas.background-opacity'] = 'filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=100); opacity: 1.0';
$tmp_theme_attributes_ARRAY[$int_const]['stage.canvas.border-width'] = '3px';
$tmp_theme_attributes_ARRAY[$int_const]['stage.canvas.border-color'] = '#80A0DD';
$tmp_theme_attributes_ARRAY[$int_const]['stage.canvas.border-style'] = 'solid';
$tmp_theme_attributes_ARRAY[$int_const]['stage.content.background-opacity'] = 'filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=100); opacity: 1.0';
$tmp_theme_attributes_ARRAY[$int_const]['stage.content.highlight-color'] = '#F5EDDA';
$tmp_theme_attributes_ARRAY[$int_const]['stage.lnum.css.right-border-width'] = '1px';
$tmp_theme_attributes_ARRAY[$int_const]['stage.lnum.css.right-border-color'] = '#5F5FD0';
$tmp_theme_attributes_ARRAY[$int_const]['stage.lnum.css.right-border-style'] = 'solid';
$tmp_theme_attributes_ARRAY[$int_const]['stage.lnum.css.background-color'] = '#809FDB';
$tmp_theme_attributes_ARRAY[$int_const]['stage.lnum.css.color'] = '#F3F0F0';

$tmp_theme_attributes_ARRAY[$int_const]['stage.canvas.box-shadow.inset'][] = '';
$tmp_theme_attributes_ARRAY[$int_const]['stage.canvas.box-shadow.offset-x'][] = '3px';
$tmp_theme_attributes_ARRAY[$int_const]['stage.canvas.box-shadow.offset-y'][] = '3px';
$tmp_theme_attributes_ARRAY[$int_const]['stage.canvas.box-shadow.blur-radius'][] = '3px';
$tmp_theme_attributes_ARRAY[$int_const]['stage.canvas.box-shadow.spread-radius'][] = '';
$tmp_theme_attributes_ARRAY[$int_const]['stage.canvas.box-shadow.color'][] = '#BFBFBF';

// CRNRSTN :: INTERACT UI
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_bg_overlay_background_color'][] = '#003eff';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_bg_overlay_background_opacity'][] = '0.8';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_bg_overlay_background_zindex'][] = '1';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_copy_overflowrap'][] = 'break-word';

//
// CRNRSTN :: INTERACT UI
// DOCUMENTATION PAGE TITLE SECTION :: PAGE TITLE
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_font_family'][] = 'Arial, Helvetica, sans-serif';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_font_weight'][] = 'bold';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_color'][] = '#333';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_line_height'][] = '55px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_padding_top'][] = '0';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_padding_right'][] = '10px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_padding_bottom'][] = '0';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_padding_left'][] = '20px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_text_shadow'][] = '1px 1px 2px #ECECEC, 0 0 1em #ECECEC, 0 0 0.2em #ECECEC';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_font_size_h1'][] = '45px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_font_size_h2'][] = '35px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_font_size_h3'][] = '25px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_font_size_h4'][] = '15px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_margin_bottom'][] = '0';

//
// CRNRSTN :: INTERACT UI
// DOCUMENTATION PAGE TITLE SECTION :: PAGE TITLE DESCRIPTION
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_font_family'][] = 'Arial, Helvetica, sans-serif';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_color'][] = '#333';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_width'][] = '90%';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_font_size'][] = '20px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_overflow_wrap'][] = 'break-word';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_padding_top'][] = '12px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_padding_right'][] = '10px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_padding_bottom'][] = '25px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_padding_left'][] = '20px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_line_height'][] = '33px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_text_shadow'][] = '1px 1px 2px #ECECEC, 0 0 1em #ECECEC, 0 0 0.2em #ECECEC';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_paragraph_padding'][] = '0';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_paragraph_margin'][] = '0';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_paragraph_text_align'][] = 'left';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_paragraph_anchor_text_decoration'][] = 'none';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_paragraph_anchor_color'][] = '#0066CC';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_text_embed_image_padding_top'][] = '0';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_text_embed_image_padding_right'][] = '6px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_text_embed_image_padding_bottom'][] = '0';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_text_embed_image_padding_left'][] = '0';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_text_embed_image_line_height'][] = '90px';

//
// CRNRSTN :: INTERACT UI
// DOCUMENTATION GENERAL :: ALERT / CAUTION NOTE
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_alert_caution_border_wrap_border'][] = '1px solid #A5B9D8';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_alert_caution_border_wrap_margin'][] = '10px 20px 10px 20px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_alert_caution_border_wrap_padding'][] = '10px 0 10px 0';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_alert_caution_bg_icon_wrap_top'][] = '-120px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_alert_caution_bg_icon_wrap_left'][] = '48%';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_alert_caution_copy_width'][] = '85%';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_alert_caution_copy_text_align'][] = 'left';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_alert_caution_copy_paragraph_padding'][] = '0 10px 0 20px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_alert_caution_copy_paragraph_background_color'][] = 'rgba(255, 255, 255, 0.67)';
/*//////////
//////////

*/

//
// LIGHTER THAN DAYLIGHT.
$int_const = CRNRSTN_UI_FEATHER;
$tmp_resource_meta_ARRAY = $this->return_int_const_profile($int_const);
$tmp_theme_attributes_ARRAY[$int_const]['NOM_STRING'] = $tmp_resource_meta_ARRAY['STRING'];
$tmp_theme_attributes_ARRAY[$int_const]['INTEGER'] = $tmp_resource_meta_ARRAY['INTEGER'];
$tmp_theme_attributes_ARRAY[$int_const]['TITLE'] = $tmp_resource_meta_ARRAY['TITLE'];
$tmp_theme_attributes_ARRAY[$int_const]['DESCRIPTION'] = $tmp_resource_meta_ARRAY['DESCRIPTION'];
$tmp_theme_attributes_ARRAY[$int_const]['POSITION'] = $tmp_pos++;
$tmp_theme_attributes_ARRAY[$int_const]['DISPLAY_POSITION'] = 6;
$tmp_theme_attributes_ARRAY[$int_const]['IS_ACTIVE'] = 0;
if($this->is_bit_set($int_const)) $tmp_theme_attributes_ARRAY[$int_const]['IS_ACTIVE'] = 1;

$tmp_theme_attributes_ARRAY[$int_const]['highlight.comment'] = '#7CD38B';
$tmp_theme_attributes_ARRAY[$int_const]['highlight.default'] = '#D78783';
$tmp_theme_attributes_ARRAY[$int_const]['highlight.html'] = '#868686';
$tmp_theme_attributes_ARRAY[$int_const]['highlight.keyword'] = '#CDA54A; font-weight: normal;';
$tmp_theme_attributes_ARRAY[$int_const]['highlight.string'] = '#8080DA';

$tmp_theme_attributes_ARRAY[$int_const]['stage.canvas.background-color'] = '#FFF';
$tmp_theme_attributes_ARRAY[$int_const]['stage.canvas.background-opacity'] = 'filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=100); opacity: 1.0';
$tmp_theme_attributes_ARRAY[$int_const]['stage.canvas.border-width'] = '3px';
$tmp_theme_attributes_ARRAY[$int_const]['stage.canvas.border-color'] = '#ECEFF2';
$tmp_theme_attributes_ARRAY[$int_const]['stage.canvas.border-style'] = 'solid';
$tmp_theme_attributes_ARRAY[$int_const]['stage.content.background-opacity'] = 'filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=100); opacity: 1.0';
$tmp_theme_attributes_ARRAY[$int_const]['stage.content.highlight-color'] = '#F7F1E2';
$tmp_theme_attributes_ARRAY[$int_const]['stage.lnum.css.right-border-width'] = '1px';
$tmp_theme_attributes_ARRAY[$int_const]['stage.lnum.css.right-border-color'] = '#D6D6F0';
$tmp_theme_attributes_ARRAY[$int_const]['stage.lnum.css.right-border-style'] = 'solid';
$tmp_theme_attributes_ARRAY[$int_const]['stage.lnum.css.background-color'] = '#D4E1EE';
$tmp_theme_attributes_ARRAY[$int_const]['stage.lnum.css.color'] = '#FFF';

// * offset-x | offset-y | blur-radius | spread-radius | color
// <div style="box-shadow: 2px 3px 3px 0 #bfbfbf;">
$tmp_theme_attributes_ARRAY[$int_const]['stage.canvas.box-shadow.inset'][] = '';
$tmp_theme_attributes_ARRAY[$int_const]['stage.canvas.box-shadow.offset-x'][] = '3px';
$tmp_theme_attributes_ARRAY[$int_const]['stage.canvas.box-shadow.offset-y'][] = '3px';
$tmp_theme_attributes_ARRAY[$int_const]['stage.canvas.box-shadow.blur-radius'][] = '3px';
$tmp_theme_attributes_ARRAY[$int_const]['stage.canvas.box-shadow.spread-radius'][] = '';
$tmp_theme_attributes_ARRAY[$int_const]['stage.canvas.box-shadow.color'][] = '#BFBFBF';

// CRNRSTN :: INTERACT UI
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_bg_overlay_background_color'][] = '#003eff';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_bg_overlay_background_opacity'][] = '0.8';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_bg_overlay_background_zindex'][] = '1';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_copy_overflowrap'][] = 'break-word';

//
// CRNRSTN :: INTERACT UI
// DOCUMENTATION PAGE TITLE SECTION :: PAGE TITLE
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_font_family'][] = 'Arial, Helvetica, sans-serif';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_font_weight'][] = 'bold';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_color'][] = '#333';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_line_height'][] = '55px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_padding_top'][] = '0';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_padding_right'][] = '10px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_padding_bottom'][] = '0';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_padding_left'][] = '20px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_text_shadow'][] = '1px 1px 2px #ECECEC, 0 0 1em #ECECEC, 0 0 0.2em #ECECEC';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_font_size_h1'][] = '45px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_font_size_h2'][] = '35px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_font_size_h3'][] = '25px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_font_size_h4'][] = '15px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_margin_bottom'][] = '0';

//
// CRNRSTN :: INTERACT UI
// DOCUMENTATION PAGE TITLE SECTION :: PAGE TITLE DESCRIPTION
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_font_family'][] = 'Arial, Helvetica, sans-serif';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_color'][] = '#333';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_width'][] = '90%';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_font_size'][] = '20px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_overflow_wrap'][] = 'break-word';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_padding_top'][] = '12px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_padding_right'][] = '10px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_padding_bottom'][] = '25px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_padding_left'][] = '20px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_line_height'][] = '33px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_text_shadow'][] = '1px 1px 2px #ECECEC, 0 0 1em #ECECEC, 0 0 0.2em #ECECEC';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_paragraph_padding'][] = '0';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_paragraph_margin'][] = '0';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_paragraph_text_align'][] = 'left';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_paragraph_anchor_text_decoration'][] = 'none';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_paragraph_anchor_color'][] = '#0066CC';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_text_embed_image_padding_top'][] = '0';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_text_embed_image_padding_right'][] = '6px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_text_embed_image_padding_bottom'][] = '0';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_text_embed_image_padding_left'][] = '0';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_text_embed_image_line_height'][] = '90px';

//
// CRNRSTN :: INTERACT UI
// DOCUMENTATION GENERAL :: ALERT / CAUTION NOTE
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_alert_caution_border_wrap_border'][] = '1px solid #A5B9D8';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_alert_caution_border_wrap_margin'][] = '10px 20px 10px 20px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_alert_caution_border_wrap_padding'][] = '10px 0 10px 0';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_alert_caution_bg_icon_wrap_top'][] = '-120px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_alert_caution_bg_icon_wrap_left'][] = '48%';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_alert_caution_copy_width'][] = '85%';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_alert_caution_copy_text_align'][] = 'left';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_alert_caution_copy_paragraph_padding'][] = '0 10px 0 20px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_alert_caution_copy_paragraph_background_color'][] = 'rgba(255, 255, 255, 0.67)';
/*//////////
//////////

*/

//
// CONCEPT WORK IN PROGRESS.
$int_const = CRNRSTN_UI_GLASS_LIGHT_COPY;
$tmp_resource_meta_ARRAY = $this->return_int_const_profile($int_const);
$tmp_theme_attributes_ARRAY[$int_const]['NOM_STRING'] = $tmp_resource_meta_ARRAY['STRING'];
$tmp_theme_attributes_ARRAY[$int_const]['INTEGER'] = $tmp_resource_meta_ARRAY['INTEGER'];
$tmp_theme_attributes_ARRAY[$int_const]['TITLE'] = $tmp_resource_meta_ARRAY['TITLE'];
$tmp_theme_attributes_ARRAY[$int_const]['DESCRIPTION'] = $tmp_resource_meta_ARRAY['DESCRIPTION'];
$tmp_theme_attributes_ARRAY[$int_const]['POSITION'] = $tmp_pos++;
$tmp_theme_attributes_ARRAY[$int_const]['DISPLAY_POSITION'] = 7;
$tmp_theme_attributes_ARRAY[$int_const]['IS_ACTIVE'] = 0;
if($this->is_bit_set($int_const)) $tmp_theme_attributes_ARRAY[$int_const]['IS_ACTIVE'] = 1;

$tmp_theme_attributes_ARRAY[$int_const]['highlight.comment'] = '#7CD38B';
$tmp_theme_attributes_ARRAY[$int_const]['highlight.default'] = '#D78783';
$tmp_theme_attributes_ARRAY[$int_const]['highlight.html'] = '#868686';
$tmp_theme_attributes_ARRAY[$int_const]['highlight.keyword'] = '#CDA54A; font-weight: normal;';
$tmp_theme_attributes_ARRAY[$int_const]['highlight.string'] = '#8080DA';

$tmp_theme_attributes_ARRAY[$int_const]['stage.canvas.background-color'] = 'transparent';
$tmp_theme_attributes_ARRAY[$int_const]['stage.canvas.background-opacity'] = 'filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=100); opacity: 1.0';
$tmp_theme_attributes_ARRAY[$int_const]['stage.canvas.border-width'] = '3px';
$tmp_theme_attributes_ARRAY[$int_const]['stage.canvas.border-color'] = '#ECEFF2';
$tmp_theme_attributes_ARRAY[$int_const]['stage.canvas.border-style'] = 'solid';
$tmp_theme_attributes_ARRAY[$int_const]['stage.content.background-opacity'] = 'filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=100); opacity: 1.0';
$tmp_theme_attributes_ARRAY[$int_const]['stage.content.highlight-color'] = '#F7F1E2';
$tmp_theme_attributes_ARRAY[$int_const]['stage.lnum.css.right-border-width'] = '1px';
$tmp_theme_attributes_ARRAY[$int_const]['stage.lnum.css.right-border-color'] = '#D6D6F0';
$tmp_theme_attributes_ARRAY[$int_const]['stage.lnum.css.right-border-style'] = 'solid';
$tmp_theme_attributes_ARRAY[$int_const]['stage.lnum.css.background-color'] = '#D4E1EE';
$tmp_theme_attributes_ARRAY[$int_const]['stage.lnum.css.color'] = '#FFF';

$tmp_theme_attributes_ARRAY[$int_const]['stage.canvas.box-shadow.inset'][] = '';
$tmp_theme_attributes_ARRAY[$int_const]['stage.canvas.box-shadow.offset-x'][] = '3px';
$tmp_theme_attributes_ARRAY[$int_const]['stage.canvas.box-shadow.offset-y'][] = '3px';
$tmp_theme_attributes_ARRAY[$int_const]['stage.canvas.box-shadow.blur-radius'][] = '3px';
$tmp_theme_attributes_ARRAY[$int_const]['stage.canvas.box-shadow.spread-radius'][] = '';
$tmp_theme_attributes_ARRAY[$int_const]['stage.canvas.box-shadow.color'][] = '#BFBFBF';

// CRNRSTN :: INTERACT UI
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_bg_overlay_background_color'][] = '#003eff';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_bg_overlay_background_opacity'][] = '0.8';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_bg_overlay_background_zindex'][] = '1';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_copy_overflowrap'][] = 'break-word';

//
// CRNRSTN :: INTERACT UI
// DOCUMENTATION PAGE TITLE SECTION :: PAGE TITLE
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_font_family'][] = 'Arial, Helvetica, sans-serif';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_font_weight'][] = 'bold';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_color'][] = '#333';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_line_height'][] = '55px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_padding_top'][] = '0';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_padding_right'][] = '10px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_padding_bottom'][] = '0';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_padding_left'][] = '20px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_text_shadow'][] = '1px 1px 2px #ECECEC, 0 0 1em #ECECEC, 0 0 0.2em #ECECEC';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_font_size_h1'][] = '45px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_font_size_h2'][] = '35px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_font_size_h3'][] = '25px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_font_size_h4'][] = '15px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_margin_bottom'][] = '0';

//
// CRNRSTN :: INTERACT UI
// DOCUMENTATION PAGE TITLE SECTION :: PAGE TITLE DESCRIPTION
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_font_family'][] = 'Arial, Helvetica, sans-serif';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_color'][] = '#333';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_width'][] = '90%';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_font_size'][] = '20px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_overflow_wrap'][] = 'break-word';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_padding_top'][] = '12px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_padding_right'][] = '10px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_padding_bottom'][] = '25px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_padding_left'][] = '20px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_line_height'][] = '33px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_text_shadow'][] = '1px 1px 2px #ECECEC, 0 0 1em #ECECEC, 0 0 0.2em #ECECEC';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_paragraph_padding'][] = '0';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_paragraph_margin'][] = '0';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_paragraph_text_align'][] = 'left';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_paragraph_anchor_text_decoration'][] = 'none';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_paragraph_anchor_color'][] = '#0066CC';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_text_embed_image_padding_top'][] = '0';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_text_embed_image_padding_right'][] = '6px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_text_embed_image_padding_bottom'][] = '0';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_text_embed_image_padding_left'][] = '0';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_text_embed_image_line_height'][] = '90px';

//
// CRNRSTN :: INTERACT UI
// DOCUMENTATION GENERAL :: ALERT / CAUTION NOTE
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_alert_caution_border_wrap_border'][] = '1px solid #A5B9D8';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_alert_caution_border_wrap_margin'][] = '10px 20px 10px 20px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_alert_caution_border_wrap_padding'][] = '10px 0 10px 0';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_alert_caution_bg_icon_wrap_top'][] = '-120px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_alert_caution_bg_icon_wrap_left'][] = '48%';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_alert_caution_copy_width'][] = '85%';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_alert_caution_copy_text_align'][] = 'left';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_alert_caution_copy_paragraph_padding'][] = '0 10px 0 20px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_alert_caution_copy_paragraph_background_color'][] = 'rgba(255, 255, 255, 0.67)';
/*//////////
//////////

*/

//
// CONCEPT WORK IN PROGRESS.
$int_const = CRNRSTN_UI_GLASS_DARK_COPY;
$tmp_resource_meta_ARRAY = $this->return_int_const_profile($int_const);
$tmp_theme_attributes_ARRAY[$int_const]['NOM_STRING'] = $tmp_resource_meta_ARRAY['STRING'];
$tmp_theme_attributes_ARRAY[$int_const]['INTEGER'] = $tmp_resource_meta_ARRAY['INTEGER'];
$tmp_theme_attributes_ARRAY[$int_const]['TITLE'] = $tmp_resource_meta_ARRAY['TITLE'];
$tmp_theme_attributes_ARRAY[$int_const]['DESCRIPTION'] = $tmp_resource_meta_ARRAY['DESCRIPTION'];
$tmp_theme_attributes_ARRAY[$int_const]['POSITION'] = $tmp_pos++;
$tmp_theme_attributes_ARRAY[$int_const]['DISPLAY_POSITION'] = 8;
$tmp_theme_attributes_ARRAY[$int_const]['IS_ACTIVE'] = 0;
if($this->is_bit_set($int_const)) $tmp_theme_attributes_ARRAY[$int_const]['IS_ACTIVE'] = 1;

$tmp_theme_attributes_ARRAY[$int_const]['highlight.comment'] = '#008000';
$tmp_theme_attributes_ARRAY[$int_const]['highlight.default'] = '#191A31';
$tmp_theme_attributes_ARRAY[$int_const]['highlight.html'] = '#808080';
$tmp_theme_attributes_ARRAY[$int_const]['highlight.keyword'] = '#00B; font-weight: normal';
$tmp_theme_attributes_ARRAY[$int_const]['highlight.string'] = '#D00';

$tmp_theme_attributes_ARRAY[$int_const]['stage.canvas.background-color'] = 'transparent';
$tmp_theme_attributes_ARRAY[$int_const]['stage.canvas.background-opacity'] = 'filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=100); opacity: 1.0';
$tmp_theme_attributes_ARRAY[$int_const]['stage.canvas.border-width'] = '3px';
$tmp_theme_attributes_ARRAY[$int_const]['stage.canvas.border-color'] = '#ECEFF2';
$tmp_theme_attributes_ARRAY[$int_const]['stage.canvas.border-style'] = 'solid';
$tmp_theme_attributes_ARRAY[$int_const]['stage.content.background-opacity'] = 'filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=100); opacity: 1.0';
$tmp_theme_attributes_ARRAY[$int_const]['stage.content.highlight-color'] = '#EFEFFB';
$tmp_theme_attributes_ARRAY[$int_const]['stage.lnum.css.right-border-width'] = '1px';
$tmp_theme_attributes_ARRAY[$int_const]['stage.lnum.css.right-border-color'] = '#D6D6F0';
$tmp_theme_attributes_ARRAY[$int_const]['stage.lnum.css.right-border-style'] = 'solid';
$tmp_theme_attributes_ARRAY[$int_const]['stage.lnum.css.background-color'] = '#D4E1EE';
$tmp_theme_attributes_ARRAY[$int_const]['stage.lnum.css.color'] = '#FFF';

$tmp_theme_attributes_ARRAY[$int_const]['stage.canvas.box-shadow.inset'][] = '';
$tmp_theme_attributes_ARRAY[$int_const]['stage.canvas.box-shadow.offset-x'][] = '3px';
$tmp_theme_attributes_ARRAY[$int_const]['stage.canvas.box-shadow.offset-y'][] = '3px';
$tmp_theme_attributes_ARRAY[$int_const]['stage.canvas.box-shadow.blur-radius'][] = '3px';
$tmp_theme_attributes_ARRAY[$int_const]['stage.canvas.box-shadow.spread-radius'][] = '';
$tmp_theme_attributes_ARRAY[$int_const]['stage.canvas.box-shadow.color'][] = '#BFBFBF';

// CRNRSTN :: INTERACT UI
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_bg_overlay_background_color'][] = '#003eff';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_bg_overlay_background_opacity'][] = '0.8';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_bg_overlay_background_zindex'][] = '1';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_copy_overflowrap'][] = 'break-word';

//
// CRNRSTN :: INTERACT UI
// DOCUMENTATION PAGE TITLE SECTION :: PAGE TITLE
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_font_family'][] = 'Arial, Helvetica, sans-serif';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_font_weight'][] = 'bold';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_color'][] = '#333';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_line_height'][] = '55px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_padding_top'][] = '0';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_padding_right'][] = '10px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_padding_bottom'][] = '0';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_padding_left'][] = '20px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_text_shadow'][] = '1px 1px 2px #ECECEC, 0 0 1em #ECECEC, 0 0 0.2em #ECECEC';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_font_size_h1'][] = '45px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_font_size_h2'][] = '35px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_font_size_h3'][] = '25px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_font_size_h4'][] = '15px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_margin_bottom'][] = '0';

//
// CRNRSTN :: INTERACT UI
// DOCUMENTATION PAGE TITLE SECTION :: PAGE TITLE DESCRIPTION
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_font_family'][] = 'Arial, Helvetica, sans-serif';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_color'][] = '#333';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_width'][] = '90%';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_font_size'][] = '20px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_overflow_wrap'][] = 'break-word';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_padding_top'][] = '12px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_padding_right'][] = '10px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_padding_bottom'][] = '25px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_padding_left'][] = '20px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_line_height'][] = '33px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_text_shadow'][] = '1px 1px 2px #ECECEC, 0 0 1em #ECECEC, 0 0 0.2em #ECECEC';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_paragraph_padding'][] = '0';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_paragraph_margin'][] = '0';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_paragraph_text_align'][] = 'left';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_paragraph_anchor_text_decoration'][] = 'none';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_paragraph_anchor_color'][] = '#0066CC';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_text_embed_image_padding_top'][] = '0';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_text_embed_image_padding_right'][] = '6px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_text_embed_image_padding_bottom'][] = '0';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_text_embed_image_padding_left'][] = '0';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_text_embed_image_line_height'][] = '90px';

//
// CRNRSTN :: INTERACT UI
// DOCUMENTATION GENERAL :: ALERT / CAUTION NOTE
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_alert_caution_border_wrap_border'][] = '1px solid #A5B9D8';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_alert_caution_border_wrap_margin'][] = '10px 20px 10px 20px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_alert_caution_border_wrap_padding'][] = '10px 0 10px 0';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_alert_caution_bg_icon_wrap_top'][] = '-120px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_alert_caution_bg_icon_wrap_left'][] = '48%';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_alert_caution_copy_width'][] = '85%';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_alert_caution_copy_text_align'][] = 'left';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_alert_caution_copy_paragraph_padding'][] = '0 10px 0 20px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_alert_caution_copy_paragraph_background_color'][] = 'rgba(255, 255, 255, 0.67)';
/*//////////
//////////

*/

//
// GOT WOOD?
$int_const = CRNRSTN_UI_WOOD;
$tmp_resource_meta_ARRAY = $this->return_int_const_profile($int_const);
$tmp_theme_attributes_ARRAY[$int_const]['NOM_STRING'] = $tmp_resource_meta_ARRAY['STRING'];
$tmp_theme_attributes_ARRAY[$int_const]['INTEGER'] = $tmp_resource_meta_ARRAY['INTEGER'];
$tmp_theme_attributes_ARRAY[$int_const]['TITLE'] = $tmp_resource_meta_ARRAY['TITLE'];
$tmp_theme_attributes_ARRAY[$int_const]['DESCRIPTION'] = $tmp_resource_meta_ARRAY['DESCRIPTION'];
$tmp_theme_attributes_ARRAY[$int_const]['POSITION'] = $tmp_pos++;
$tmp_theme_attributes_ARRAY[$int_const]['DISPLAY_POSITION'] = 9;
$tmp_theme_attributes_ARRAY[$int_const]['IS_ACTIVE'] = 0;
if($this->is_bit_set($int_const)) $tmp_theme_attributes_ARRAY[$int_const]['IS_ACTIVE'] = 1;

$tmp_theme_attributes_ARRAY[$int_const]['highlight.comment'] = '#7CD38B';
$tmp_theme_attributes_ARRAY[$int_const]['highlight.default'] = '#D78783';
$tmp_theme_attributes_ARRAY[$int_const]['highlight.html'] = '#868686';
$tmp_theme_attributes_ARRAY[$int_const]['highlight.keyword'] = '#CDA54A; font-weight: normal;';
$tmp_theme_attributes_ARRAY[$int_const]['highlight.string'] = '#8080DA';

$tmp_theme_attributes_ARRAY[$int_const]['stage.canvas.background-color'] = 'transparent';
$tmp_theme_attributes_ARRAY[$int_const]['stage.canvas.background-opacity'] = 'filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=100); opacity: 1.0';
$tmp_theme_attributes_ARRAY[$int_const]['stage.canvas.border-width'] = '3px';
$tmp_theme_attributes_ARRAY[$int_const]['stage.canvas.border-color'] = '#ECEFF2';
$tmp_theme_attributes_ARRAY[$int_const]['stage.canvas.border-style'] = 'solid';
$tmp_theme_attributes_ARRAY[$int_const]['stage.content.background-opacity'] = 'filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=100); opacity: 1.0';
$tmp_theme_attributes_ARRAY[$int_const]['stage.content.highlight-color'] = '#F7F1E2';
$tmp_theme_attributes_ARRAY[$int_const]['stage.lnum.css.right-border-width'] = '1px';
$tmp_theme_attributes_ARRAY[$int_const]['stage.lnum.css.right-border-color'] = '#D6D6F0';
$tmp_theme_attributes_ARRAY[$int_const]['stage.lnum.css.right-border-style'] = 'solid';
$tmp_theme_attributes_ARRAY[$int_const]['stage.lnum.css.background-color'] = '#D4E1EE';
$tmp_theme_attributes_ARRAY[$int_const]['stage.lnum.css.color'] = '#FFF';

$tmp_theme_attributes_ARRAY[$int_const]['stage.canvas.box-shadow.inset'][] = '';
$tmp_theme_attributes_ARRAY[$int_const]['stage.canvas.box-shadow.offset-x'][] = '3px';
$tmp_theme_attributes_ARRAY[$int_const]['stage.canvas.box-shadow.offset-y'][] = '3px';
$tmp_theme_attributes_ARRAY[$int_const]['stage.canvas.box-shadow.blur-radius'][] = '3px';
$tmp_theme_attributes_ARRAY[$int_const]['stage.canvas.box-shadow.spread-radius'][] = '';
$tmp_theme_attributes_ARRAY[$int_const]['stage.canvas.box-shadow.color'][] = '#BFBFBF';

// CRNRSTN :: INTERACT UI
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_bg_overlay_background_color'][] = '#003eff';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_bg_overlay_background_opacity'][] = '0.8';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_bg_overlay_background_zindex'][] = '1';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_copy_overflowrap'][] = 'break-word';

//
// CRNRSTN :: INTERACT UI
// DOCUMENTATION PAGE TITLE SECTION :: PAGE TITLE
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_font_family'][] = 'Arial, Helvetica, sans-serif';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_font_weight'][] = 'bold';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_color'][] = '#333';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_line_height'][] = '55px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_padding_top'][] = '0';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_padding_right'][] = '10px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_padding_bottom'][] = '0';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_padding_left'][] = '20px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_text_shadow'][] = '1px 1px 2px #ECECEC, 0 0 1em #ECECEC, 0 0 0.2em #ECECEC';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_font_size_h1'][] = '45px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_font_size_h2'][] = '35px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_font_size_h3'][] = '25px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_font_size_h4'][] = '15px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_margin_bottom'][] = '0';

//
// CRNRSTN :: INTERACT UI
// DOCUMENTATION PAGE TITLE SECTION :: PAGE TITLE DESCRIPTION
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_font_family'][] = 'Arial, Helvetica, sans-serif';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_color'][] = '#333';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_width'][] = '90%';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_font_size'][] = '20px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_overflow_wrap'][] = 'break-word';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_padding_top'][] = '12px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_padding_right'][] = '10px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_padding_bottom'][] = '25px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_padding_left'][] = '20px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_line_height'][] = '33px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_text_shadow'][] = '1px 1px 2px #ECECEC, 0 0 1em #ECECEC, 0 0 0.2em #ECECEC';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_paragraph_padding'][] = '0';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_paragraph_margin'][] = '0';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_paragraph_text_align'][] = 'left';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_paragraph_anchor_text_decoration'][] = 'none';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_paragraph_anchor_color'][] = '#0066CC';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_text_embed_image_padding_top'][] = '0';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_text_embed_image_padding_right'][] = '6px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_text_embed_image_padding_bottom'][] = '0';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_text_embed_image_padding_left'][] = '0';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_text_embed_image_line_height'][] = '90px';

//
// CRNRSTN :: INTERACT UI
// DOCUMENTATION GENERAL :: ALERT / CAUTION NOTE
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_alert_caution_border_wrap_border'][] = '1px solid #A5B9D8';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_alert_caution_border_wrap_margin'][] = '10px 20px 10px 20px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_alert_caution_border_wrap_padding'][] = '10px 0 10px 0';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_alert_caution_bg_icon_wrap_top'][] = '-120px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_alert_caution_bg_icon_wrap_left'][] = '48%';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_alert_caution_copy_width'][] = '85%';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_alert_caution_copy_text_align'][] = 'left';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_alert_caution_copy_paragraph_padding'][] = '0 10px 0 20px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_alert_caution_copy_paragraph_background_color'][] = 'rgba(255, 255, 255, 0.67)';
/*//////////
//////////

*/

//
// GREEN TEXT. BLACK BACKGROUND. HARDCORE.
$int_const = CRNRSTN_UI_TERMINAL;
$tmp_resource_meta_ARRAY = $this->return_int_const_profile($int_const);
$tmp_theme_attributes_ARRAY[$int_const]['NOM_STRING'] = $tmp_resource_meta_ARRAY['STRING'];
$tmp_theme_attributes_ARRAY[$int_const]['INTEGER'] = $tmp_resource_meta_ARRAY['INTEGER'];
$tmp_theme_attributes_ARRAY[$int_const]['TITLE'] = $tmp_resource_meta_ARRAY['TITLE'];
$tmp_theme_attributes_ARRAY[$int_const]['DESCRIPTION'] = $tmp_resource_meta_ARRAY['DESCRIPTION'];
$tmp_theme_attributes_ARRAY[$int_const]['POSITION'] = $tmp_pos++;
$tmp_theme_attributes_ARRAY[$int_const]['DISPLAY_POSITION'] = 10;
$tmp_theme_attributes_ARRAY[$int_const]['IS_ACTIVE'] = 0;
if($this->is_bit_set($int_const)) $tmp_theme_attributes_ARRAY[$int_const]['IS_ACTIVE'] = 1;

$tmp_theme_attributes_ARRAY[$int_const]['highlight.comment'] = '#257129';
$tmp_theme_attributes_ARRAY[$int_const]['highlight.default'] = '#41DB3C';
$tmp_theme_attributes_ARRAY[$int_const]['highlight.html'] = '#EBEBEB';
$tmp_theme_attributes_ARRAY[$int_const]['highlight.keyword'] = '#19EE28; font-weight: bold';
$tmp_theme_attributes_ARRAY[$int_const]['highlight.string'] = '#54B33E';

$tmp_theme_attributes_ARRAY[$int_const]['stage.canvas.background-color'] = '#131314';
$tmp_theme_attributes_ARRAY[$int_const]['stage.canvas.background-opacity'] = 'filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=100); opacity: 1.0';
$tmp_theme_attributes_ARRAY[$int_const]['stage.canvas.border-width'] = '3px';
$tmp_theme_attributes_ARRAY[$int_const]['stage.canvas.border-color'] = '#000';
$tmp_theme_attributes_ARRAY[$int_const]['stage.canvas.border-style'] = 'solid';
$tmp_theme_attributes_ARRAY[$int_const]['stage.content.background-opacity'] = 'filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=100); opacity: 1.0';
$tmp_theme_attributes_ARRAY[$int_const]['stage.content.highlight-color'] = '#073F0B';
$tmp_theme_attributes_ARRAY[$int_const]['stage.lnum.css.right-border-width'] = '1px';
$tmp_theme_attributes_ARRAY[$int_const]['stage.lnum.css.right-border-color'] = '#0C8800';
$tmp_theme_attributes_ARRAY[$int_const]['stage.lnum.css.right-border-style'] = 'solid';
$tmp_theme_attributes_ARRAY[$int_const]['stage.lnum.css.background-color'] = '#282828';
$tmp_theme_attributes_ARRAY[$int_const]['stage.lnum.css.color'] = '#1FA61F';

$tmp_theme_attributes_ARRAY[$int_const]['stage.canvas.box-shadow.inset'][] = '';
$tmp_theme_attributes_ARRAY[$int_const]['stage.canvas.box-shadow.offset-x'][] = '3px';
$tmp_theme_attributes_ARRAY[$int_const]['stage.canvas.box-shadow.offset-y'][] = '3px';
$tmp_theme_attributes_ARRAY[$int_const]['stage.canvas.box-shadow.blur-radius'][] = '3px';
$tmp_theme_attributes_ARRAY[$int_const]['stage.canvas.box-shadow.spread-radius'][] = '';
$tmp_theme_attributes_ARRAY[$int_const]['stage.canvas.box-shadow.color'][] = '#BFBFBF';

// CRNRSTN :: INTERACT UI
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_bg_overlay_background_color'][] = '#003eff';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_bg_overlay_background_opacity'][] = '0.8';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_bg_overlay_background_zindex'][] = '1';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_copy_overflowrap'][] = 'break-word';

//
// CRNRSTN :: INTERACT UI
// DOCUMENTATION PAGE TITLE SECTION :: PAGE TITLE
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_font_family'][] = 'Arial, Helvetica, sans-serif';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_font_weight'][] = 'bold';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_color'][] = '#333';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_line_height'][] = '55px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_padding_top'][] = '0';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_padding_right'][] = '10px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_padding_bottom'][] = '0';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_padding_left'][] = '20px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_text_shadow'][] = '1px 1px 2px #ECECEC, 0 0 1em #ECECEC, 0 0 0.2em #ECECEC';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_font_size_h1'][] = '45px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_font_size_h2'][] = '35px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_font_size_h3'][] = '25px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_font_size_h4'][] = '15px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_copy_margin_bottom'][] = '0';

//
// CRNRSTN :: INTERACT UI
// DOCUMENTATION PAGE TITLE SECTION :: PAGE TITLE DESCRIPTION
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_font_family'][] = 'Arial, Helvetica, sans-serif';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_color'][] = '#333';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_width'][] = '90%';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_font_size'][] = '20px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_overflow_wrap'][] = 'break-word';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_padding_top'][] = '12px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_padding_right'][] = '10px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_padding_bottom'][] = '25px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_padding_left'][] = '20px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_line_height'][] = '33px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_text_shadow'][] = '1px 1px 2px #ECECEC, 0 0 1em #ECECEC, 0 0 0.2em #ECECEC';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_paragraph_padding'][] = '0';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_paragraph_margin'][] = '0';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_paragraph_text_align'][] = 'left';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_paragraph_anchor_text_decoration'][] = 'none';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_paragraph_anchor_color'][] = '#0066CC';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_text_embed_image_padding_top'][] = '0';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_text_embed_image_padding_right'][] = '6px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_text_embed_image_padding_bottom'][] = '0';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_text_embed_image_padding_left'][] = '0';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_title_description_text_embed_image_line_height'][] = '90px';

//
// CRNRSTN :: INTERACT UI
// DOCUMENTATION GENERAL :: ALERT / CAUTION NOTE
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_alert_caution_border_wrap_border'][] = '1px solid #A5B9D8';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_alert_caution_border_wrap_margin'][] = '10px 20px 10px 20px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_alert_caution_border_wrap_padding'][] = '10px 0 10px 0';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_alert_caution_bg_icon_wrap_top'][] = '-120px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_alert_caution_bg_icon_wrap_left'][] = '48%';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_alert_caution_copy_width'][] = '85%';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_alert_caution_copy_text_align'][] = 'left';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_alert_caution_copy_paragraph_padding'][] = '0 10px 0 20px';
$tmp_theme_attributes_ARRAY[$int_const]['interact.ui.document_page_alert_caution_copy_paragraph_background_color'][] = 'rgba(255, 255, 255, 0.67)';
/*//////////
//////////

*/