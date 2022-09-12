/*!
// J5
// Code is Poetry */
// ...such as this lowly JavaScript Document

/*
CRNRSTN :: CLIENT SIDE CODE INSPIRED BY ::
 * Lightbox v2.11.3
 * by Lokesh Dhakar
 *
 * More info:
 * http://lokeshdhakar.com/projects/lightbox2/
 *
 * Copyright Lokesh Dhakar
 * Released under the MIT license
 * https://github.com/lokesh/lightbox2/blob/master/LICENSE
 *
 * @preserve

RECEIVE COMPLETE DATA RESPONSE FROM SERVER ::
    ~ XML
    ~ JSON
    ~ HTML (injection WITH CSS)
    ~ HTML (injection WITH CSS - WIRE-FRAME ONLY)
    ~ SOAP RESPONSE (XML)
    ~ CARRIER PIGEON

SERVER DRIVEN VARIABLE INITIALIZATION AND STATE MANAGEMENT - REAL-TIME MANAGEMENT CONSIDERATIONS IMPACTING UI/UX ::
    ~ NEW ALERTS
    ~ NEW NOTIFICATIONS
    ~ REGULAR MEASUREMENT FOR MAINTENANCE OF TARGET TOLERANCES FOR RANGES OF OPERATION
        * CONTENT TTL
        * SESSION TTL ALERT TO IMMINENT CHANGE FOR FORCED LOGOUT TO TEMPORARY LANDING PAGE...E.G. BEFORE MAINTENANCE MODE
        * SESSION TTL (FORCED LOGOUT TO TEMPORARY LANDING PAGE...E.G. BEFORE MAINTENANCE MODE)
        * INACTIVITY TIMEOUT DEFAULT - REAL-TIME ADJUSTMENT APPLICATION
        * MAXIMUM UNSUCCESSFUL LOGIN ATTEMPTS ADJUSTMENT - REAL-TIME APPLICATION
        * LOGIN ATTEMPTS EXCEEDED TIMEOUT ADJUSTMENT - REAL-TIME APPLICATION
        * ACCOUNT SUSPENDED BY ADMIN - REAL-TIME APPLICATION
        * ACCOUNT DEACTIVATED BY ADMIN - REAL-TIME APPLICATION
        * ACCOUNT ACTIVATED BY ADMIN - REAL-TIME APPLICATION
    ~ COOKIE MANAGEMENT POLICY - DNF
        * HTML (injection WITH CSS - THEME OPTIONS...PHPNIGHT, HTML, FEATHER...)
        * HTML (injection WITH CSS - WIRE-FRAME ONLY)
    ~ ACCOUNT ACTIVITY
        * START OUT FULL TRANSPARENCY. WHAT THE SYSTEM ADMINISTRATOR SEES.
        * BUILD IN SUPPORT FOR ACCOUNT RELATIONSHIP STRUCTURES WITH REGULATED VISIBILITY INTO THE SAME
            ~ CONSIDER EMPLOYEE vs CLIENT IN CONTEXT OF EXTRANET AND THE VISIBILITY THERE. E.G., WHY WOULD CLIENT "A"
              SEE ACTIVITY FOR CLIENT "B" IN THE SYSTEM?
        * LIVING STREAMS COMMUNICATIONS MESSAGING LAYER WHERE USER @MENTIONS THROW ALERTS TO USERS FOR REAL-TIME
          COMMUNICATIONS IN SYSTEM. CONSIDER DATA OUTPUT FORMAT FOR MOBILE DEVICE APPLICATION PUSHING AND PULLING
          CRNRSTN :: DRIVEN MOBILE COMMUNICATIONS WHERE LOGGING INTO CRNRSTN :: WILL EXPOSE TO THE SAME "MOBILE APP"
          THREAD WITHIN THE RUNNING LAMP ENVIRONMENT.
        * WE NEED TO PUT TOGETHER A EULA FOR ANY ACCOUNTS IN THE SYSTEM (EULA INTERSTITIAL WAY-POINT WHEN ACTIVATING
          ANY ACCOUNT) WHICH HONORS ALL OF THE ABOVE.

*/
// # # C # R # N # R # S # T # N # : : # # ##
// #
// #  CLASS :: oCRNRSTN_JS
// #  VERSION :: 1.00.0000
// #  DATE :: July 1, 2021 @ 0352hrs
// #  AUTHOR :: Jonathan 'J5' Harris, jharris@eVifweb.com
// #  URI ::
// #  DESCRIPTION :: CRNRSTN :: Main Javascript Support [DESKTOP VARIANT].
// #  LICENSE :: MIT | http://crnrstn.evifweb.com/licensing/
// #
// Uses Node, AMD or browser globals to create a module.
(function (root, factory) {

    if (typeof define === 'function' && define.amd) {

        // AMD. Register as an anonymous module.
        define(['jquery'], factory);

    } else if (typeof exports === 'object') {

        // Node. Does not work with strict CommonJS, but
        // only CommonJS-like environments that support module.exports,
        // like Node.
        module.exports = factory(require('jquery'));

    } else {

        // Browser globals (root is window)
        // root.lightbox = factory(root.jQuery);
        root.oCRNRSTN_JS = factory(root.jQuery);

    }

}(this, function ($) {

    //function Lightbox(options) {
    function CRNRSTN_JS(options) {

        this.album = [];
        this.currentImageIndex = void 0;

        //
        // CRNRSTN :: CONFIG
        this.CRNRSTN_LOGGING_OUTPUT = 'DOM';    // ['CONSOLE', 'DOM', 'ALERT'];

        //
        // CRNRSTN JS :: DEBUG MODES
        this.CRNRSTN_DEBUG_OFF = 0;
        this.CRNRSTN_DEBUG_BASIC = 100;
        this.CRNRSTN_DEBUG_VERBOSE = 200;
        this.CRNRSTN_DEBUG_LIFESTYLE_BANNER = 300;
        this.CRNRSTN_DEBUG_BASSDRIVE = 420;
        this.CRNRSTN_DEBUG_CONTROLS = 500;

        this.baseline_z_index = 60;

        //
        // TODO :: NEED TO SET DEBUG MODE FROM SERVER RETURN/SSDTLA XML RESPONSE DATA (WILL HONOR ADMIN SESSION)
        this.crnrstn_debug_mode = this.CRNRSTN_DEBUG_LIFESTYLE_BANNER;

        this.form_input_serialization_key = 'crnrstn_request_serialization_key';
        this.form_input_serialization_checksum = 'crnrstn_request_serialization_checksum';
        this.dom_element_mouse_state_tracker_ARRAY = [];
        this.dom_element_mouse_state_lock_ARRAY = [];
        this.dom_element_mouse_state_ARRAY = [];
        this.side_navigation_min_width = 17;
        this.side_navigation_toggle_expand_width = 250;
        this.current_serialization_key = '';
        this.current_serialization_checksum = '';
        this.crnrstn_ui_interact_mode = 'mini_canvas';
        this.data_tunnel_ttl_monitor_isactive = false;
        this.ttl_tunnel_monitor_seconds = 0;
        this.rand_index_spoiler_ARRAY = [];
        this.ttl_array_pointer_index_ARRAY = [];
        this.ttl_array_pointer_index_root_ARRAY = [];
        this.transaction_thread_count_ARRAY = [];

        /*

        <input type="hidden" id="crnrstn_ui_interact_canvas_checksum" name="crnrstn_ui_interact_canvas_checksum" value="">
        <input type="hidden" id="crnrstn_ui_interact_mini_canvas_checksum" name="crnrstn_ui_interact_mini_canvas_checksum" value="">
        <input type="hidden" id="crnrstn_ui_interact_signin_canvas_checksum" name="crnrstn_ui_interact_signin_canvas_checksum" value="">
        <input type="hidden" id="crnrstn_ui_interact_main_canvas_checksum" name="crnrstn_ui_interact_main_canvas_checksum" value="">
        <input type="hidden" id="crnrstn_ui_interact_eula_canvas_checksum" name="crnrstn_ui_interact_eula_canvas_checksum" value="">
        <input type="hidden" id="crnrstn_ui_interact_mit_license_canvas_checksum" name="crnrstn_ui_interact_mit_license_canvas_checksum" value="">

        */

        //
        // TODO :: NEED TO POPULATE THIS ARRAY FROM SSDTLA XML RESPONSE DATA
        this.transaction_thread_id_key_ARRAY = ['crnrstn_ui_interact', 'bassdrive_last_updated',
            'bassdrive_relay_access_by_bitrate', 'bassdrive_the_situation', 'bassdrive_title', 'bassdrive_social',
            'bassdrive_locale_colors', 'bassdrive_locale_city_state_prov', 'bassdrive_connection_stats',
            'bassdrive_history', 'bassdrive_reporting', 'bassdrive_archives', 'lifestyle_banner_image_rotation',
            'wethrbug_results', 'living_stream_podcast_selection', 'css_validator_featured_element'];

        //
        // TODO :: NEED TO POPULATE THIS ARRAY FROM SSDTLA XML RESPONSE DATA
        this.ui_interact_input_id_ARRAY = ['crnrstn_ui_interact_primary_nav_img_shell_menu_glass_case', 'crnrstn_ui_interact_primary_nav_img_shell_close_x_glass_case', 'crnrstn_ui_interact_primary_nav_img_shell_fs_expand_glass_case', 'crnrstn_ui_interact_primary_nav_img_shell_minimize_glass_case'];
        this.ui_interact_input_type_ARRAY = ['menu', 'close_x', 'fs_expand', 'minimize'];

        this.data_array_adjusted_ttl_ARRAY = [];
        this.transaction_count_ARRAY = [];
        this.transaction_ARRAY = [];

        //
        // TODO :: NEED TO POPULATE THIS ARRAY FROM THE SSDTLA XML RESPONSE DATA
        this.xml_node_ttl_indices_ARRAY = [
            'bassdrive_is_live_ttl', 'the_situation_with_bassdrive_ttl', 'bassdrive_title_ttl',
            'bassdrive_locale_city_province_ttl', 'bassdrive_locale_nation_ttl', 'stream_relays_ttl',
            'social_media_connects_ttl', 'relay_performance_ttl', 'lifestyle_banner_ttl'];

        this.jony5_banner_mode = 'PLAY';
        this.client_rtime = '0:00:00';
        this.client_rtime_year = '';
        this.client_rtime_month = '';
        this.client_rtime_week = '';
        this.client_rtime_day = '';
        this.client_rtime_hour = '0';
        this.client_rtime_mins = '0';
        this.client_rtime_secs = '0';
        this.back_press_cnt = 0;
        this.top_lifestyle_banner_image_container = '';
        this.jony5_lifestyle_banner_images_FULLSCREEN_ARRAY = [];
        this.jony5_lifestyle_banner_index_FULLSCREEN_ARRAY = [];
        this.jony5_lifestyle_banner_images_ARRAY = [];
        this.jony5_lifestyle_banner_index_ARRAY = [];
        this.jony5_lifestyle_banner_sequence_control_ARRAY = [];
        this.jony5_lifestyle_banner_sequence_position = 0;
        this.jony5_lifestyle_banner_img_int_sequence_alpha = [];
        this.jony5_lifestyle_banner_img_int_sequence_beta = [];
        this.ssdtl_response_data_container_ARRAY = [];
        this.ssdtl_response_data_index_tracker_ARRAY = [];
        this.ui_sync_controller_thread_delay_ARRAY = [];

        this.ttl_age_seconds = 1;   // secs
        this.client_rtime_pretty = '';
        this.client_rtime_millis = 0;
        this.data_tunnel_ttl_monitor_ARRAY = [];
        //this.data_tunnel_ttl_monitor_ARRAY['page_load_data_ttl'] = 30;
        this.data_tunnel_ttl_monitor_ARRAY['page_load_data_ttl'] = 2;

        //
        // TODO :: NEED TO POPULATE THIS ARRAY FROM THE SSDTLA XML RESPONSE
        // TODO :: MULTI-LANGUAGE SUPPORT
        this.client_month_abbrev_ARRAY = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec'];
        this.client_month_ARRAY = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        this.client_day_abbrev_ARRAY = ['Sun', 'Mon', 'Tues', 'Wed', 'Thurs', 'Fri', 'Sat'];
        this.client_day_ARRAY = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

        //
        // CRNRSTN :: CLIENT RESPONSE
        this.response_serial = '';
        this.response_timestamp = '';
        this.response_server_runtime = '';

        //
        // CRNRSTN :: INITIALIZATION
        this.crnrstn_init();

        // options
        this.options = $.extend({}, this.constructor.defaults);
        this.option(options);

    }

    // Descriptions of all options available on the demo site:
    // http://lokeshdhakar.com/projects/lightbox2/index.html#options
    CRNRSTN_JS.defaults = {
        albumLabel: 'Image %1 of %2',
        alwaysShowNavOnTouchDevices: false,
        fadeDuration: 600,
        fitImagesInViewport: true,
        imageFadeDuration: 600,
        // maxWidth: 800,
        // maxHeight: 600,
        positionFromTop: 50,
        resizeDuration: 700,
        showImageNumberLabel: true,
        wrapAround: false,
        disableScrolling: false,
        /*
        Sanitize Title
        If the caption data is trusted, for example you are hardcoding it in, then leave this to false.
        This will free you to add html tags, such as links, in the caption.

        If the caption data is user submitted or from some other untrusted source, then set this to true
        to prevent xss and other injection attacks.
         */
        sanitizeTitle: false

    };

    // CRNRSTN_JS.prototype.crnrstn_xxxxxx = function(elem) {
    //
    //     alert('hello crnrstn_xxxxxx {CRNRSTN_JS} world!');
    //
    //     //
    //     /*
    //     AJAX FORM SUBMISSION (SDT) TO PRODUCE CRNRSTN :: SIGN-IN "SITUATION"
    //     // 1) AJAX REQUEST TO SERVER WITH META ON ALL "SSDTL INTEGRATIONS SUPPORTED" FUNCTIONALITY
    //
    //
    //     */
    //
    //     if ($('#crnrstn').length > 0) {
    //
    //         return;
    //
    //     }
    //
    //     // this.$oCRNRSTN_JS       = $('#crnrstn');
    //     //
    //     // this.$lightbox.find('.lb-pr').on('click', function() {
    //     //
    //     //     if (self.currentImageIndex === 0) {
    //     //
    //     //         self.changeImage(self.album.length - 1);
    //     //
    //     //     } else {
    //     //
    //     //         self.changeImage(self.currentImageIndex - 1);
    //     //
    //     //     }
    //     //
    //     //     return false;
    //     //
    //     // });
    //
    // };

    CRNRSTN_JS.prototype.crnrstn_signin = function(elem) {

        //$.extend(this.options, options);
        alert('hello crnrstn_signin {CRNRSTN_JS} world!');

    };

    CRNRSTN_JS.prototype.crnrstn_bassdrive_stream = function(elem) {

        //$.extend(this.options, options);
        alert('hello crnrstn_bassdrive_stream {CRNRSTN_JS} world!');

    };

    /*
    $( "#foo" ).on( "custom", function( event, param1, param2 ) {
      alert( param1 + "\n" + param2 );
    });
    $( "#foo").trigger( "custom", [ "Custom", "Event" ] );
    */

    CRNRSTN_JS.prototype.option = function(options) {

        $.extend(this.options, options);

    };

    CRNRSTN_JS.prototype.imageCountLabel = function(currentImageNum, totalImages) {

        return this.options.albumLabel.replace(/%1/g, currentImageNum).replace(/%2/g, totalImages);

    };

    CRNRSTN_JS.prototype.init_ui_input_control_state = function(nomination, state = 'ON') {

        switch(nomination){
            case 'forward_btn_banner':

                if(state === 'ON'){

                    if($('#img_fwd_controller').css('visibility') === 'hidden') {

                        $('#img_fwd_controller').css('visibility', 'visible');

                        $('#img_fwd_controller').animate({
                            opacity: 0
                        }, {
                            duration: 0,
                            queue: true,
                            step: function( now, fx ) {

                            },
                            complete: function () {

                                $('#img_fwd_controller').animate({
                                    opacity: 1.0
                                },{
                                    duration: 750,
                                    queue: true,
                                    step: function( now, fx ) {

                                    },
                                    complete: function () {

                                    }

                                });

                            }

                        });

                    }

                }else{

                    $('#img_fwd_controller').animate({
                        opacity: 0
                    }, {
                        duration: 250,
                        queue: false,
                        step: function( now, fx ) {

                        },
                        complete: function () {

                            $('#img_fwd_controller').css('visibility', 'hidden');

                        }

                    });

                }

            break;
            case 'back_btn_banner':

                if(state === 'ON'){

                    if($('#img_back_controller').css('visibility') === 'hidden') {

                        $('#img_back_controller').css('visibility', 'visible');

                        $('#img_back_controller').animate({
                            opacity: 0
                        }, {
                            duration: 0,
                            queue: true,
                            step: function( now, fx ) {

                            },
                            complete: function () {

                                $('#img_back_controller').animate({
                                    opacity: 1.0
                                },{
                                    duration: 750,
                                    queue: true,
                                    step: function( now, fx ) {

                                    },
                                    complete: function () {

                                    }

                                });

                            }

                        });

                    }

                }else{

                    $('#img_back_controller').animate({
                        opacity: 0
                    }, {
                        duration: 250,
                        queue: false,
                        step: function( now, fx ) {

                        },
                        complete: function () {

                            $('#img_back_controller').css('visibility', 'hidden');

                        }

                    });

                }

            break;

        }

    };

    CRNRSTN_JS.prototype.link_text_click = function(page_key){

        this.log_activity('[lnum 449] SSDTLA Sending request for data [' + page_key + '].', this.CRNRSTN_DEBUG_VERBOSE);

        //
        // SET THE LINK
        $('#crnrstn_interact_ui_link_text_click').val(page_key);

        this.fire_dom_state_controller();

    };

    CRNRSTN_JS.prototype.initialize_interact_ui_documentation_mode = function() {

        var self = this;
        this.$overlay = $('#crnrstn_interact_ui_full_lightbox_overlay');
        this.$crnrstn_lightbox = $('#crnrstn_interact_ui_full_lightbox');

        if(!this.$overlay.length){

            $('<div id="crnrstn_interact_ui_full_lightbox_overlay" class="crnrstn_interact_ui_full_lightbox_overlay"></div><div id="crnrstn_interact_ui_full_lightbox" class="crnrstn_interact_ui_full_lightbox"></div><div id="crnrstn_interact_ui_full_document_wrapper"><div class="crnrstn_interact_ui_full_document_rel"><div id="crnrstn_interact_ui_full_document" class="crnrstn_interact_ui_full_document"></div><div id="crnrstn_documentation_dyn_shell" class="crnrstn_documentation_dyn_shell"></div></div></div>').prependTo($('body'));
            self.log_activity('[lnum 468] INJECTING crnrstn_interact_ui_full_lightbox_overlay INTO DOM.', self.CRNRSTN_DEBUG_VERBOSE);

        }

        if($('#crnrstn_ui_documentation_side_nav_src').length){

            this.interact_ui_full_documentation_navigation();

            $tmp_sidenav_html = $('#crnrstn_ui_documentation_side_nav_src').html();
            $('#crnrstn_interact_ui_full_document').html($tmp_sidenav_html);

            $('#crnrstn_ui_documentation_side_nav_src').html('');

            $('#crnrstn_interact_ui_side_nav').animate({
                width: this.side_navigation_min_width
            }, {
                duration: 500,
                queue: false,
                specialEasing: {
                    opacity: "swing"
                },
                step: function( now, fx ) {

                },
                complete: function () {

                }

            });

            $('#crnrstn_interact_ui_side_nav_logo').animate({
                left: 18
            }, {
                duration: 500,
                queue: false,
                specialEasing: {
                    opacity: "swing"
                },
                complete: function () {

                }

            });

            $('body').animate({
                marginLeft: this.side_navigation_min_width
            }, {
                duration: 500,
                queue: false,
                specialEasing: {
                    opacity: "swing"
                },
                complete: function () {

                }

            });

        }

        // Attach event handlers to the newly minted DOM elements
        this.$overlay.hide().on('click', function() {

            self.end();
            return false;

        });

    };

    CRNRSTN_JS.prototype.interact_ui_full_documentation_navigation = function() {

        var self = this;
        /*
        We use a setTimeout 0 to pause JS execution and let the rendering catch-up.
        Why do this? If the `disableScrolling` option is set to true, a class is added to the body
        tag that disables scrolling and hides the scrollbar. We want to make sure the scrollbar is
        hidden before we measure the document width, as the presence of the scrollbar will affect the
        number.
        */

        setTimeout(function() {

            $('#crnrstn_interact_ui_side_nav').css('max-height', parseInt($(window).height()));
            $('#crnrstn_interact_ui_side_nav').css('height', parseInt($(window).height()));

        }, 0);

    };

    CRNRSTN_JS.prototype.toggle_full_overlay = function() {

        //
        // ON OR OFF?
        if($('#crnrstn_interact_ui_full_lightbox_overlay').css('opacity') > 0){

            //
            // TURN OFF
            this.end();

        }else{

            //
            // TURN ON
            // Position Lightbox
            var top  = $window.scrollTop() + this.options.positionFromTop;
            var left = $window.scrollLeft();

            this.$lightbox.css({
                top: top + 'px',
                left: left + 'px'
            }).fadeIn(this.options.fadeDuration);

            // Disable scrolling of the page while open
            if (this.options.disableScrolling) {

                $('body').addClass('lb-disable-scrolling');

            }

            this.sizeOverlay();

        }

        //this.$overlay.fadeIn(this.options.fadeDuration);
        //
        // $('#crnrstn_interact_ui_full_overlay').animate({
        //     width: 130
        // }, {
        //     duration: 500,
        //     queue: false,
        //     step: function( now, fx ) {
        //
        //     },
        //     complete: function () {
        //
        //     }
        //
        // });
        //
        // $('#crnrstn_interact_ui_full_overlay').animate({
        //     width: 100%,
        //
        // }, {
        //     duration: 500,
        //     queue: false,
        //     step: function( now, fx ) {
        //
        //     },
        //     complete: function () {
        //
        //     }
        //
        // });
        //
        //
        // $('#crnrstn_interact_ui_full_overlay').animate({
        //     width: 130
        // }, {
        //     duration: 500,
        //     queue: false,
        //     step: function( now, fx ) {
        //
        //     },
        //     complete: function () {
        //
        //     }
        //
        // });

    };

    CRNRSTN_JS.prototype.crnrstn_init = function() {

        var self = this;

        // Both enable and build methods require the body tag to be in the DOM.
        $(document).ready(function() {

            if(self.crnrstn_debug_mode === self.CRNRSTN_DEBUG_OFF){

            }else{

                $('<div id="crnrstn_activity_log_output_wrapper">' +
                    '<div id="crnrstn_activity_log_output_title" style="float:left; padding:5px 0 5px 10px; text-align:left; font-family: Courier New, Courier, monospace; font-size:20px;">C<span class="the_R_in_crnrstn">R</span>NRSTN :: SOAP-SERVICES DATA TUNNEL LAYER ARCHITECTURE (SSDTLA) :: DEBUG WINDOW</div>' +
                    '<div id="crnrstn_activity_log" class="crnrstn_log_output_wrapper">' +
                    '   <div id="crnrstn_activity_log_output" class="crnrstn_log_output"></div>' +
                    '</div>' +
                    '<div id="crnrstn_activity_log_output_lnk_wrapper" style="margin:0; width:98%; text-align: right;">' +
                    '   <div onclick="oCRNRSTN_JS.crnrstn_ui_hide_ssdtla_debug();" style="float:right; padding:5px 5px 0 0; text-align:right;"><a href="#" style="font-family: Courier New, Courier, monospace; color:#06C; font-size:12px;">Hide</a></div>' +
                    '   <div style="float:right; padding:5px 25px 0 0; text-align:right; font-family: Courier New, Courier, monospace; font-size:20px;"><a href="#" onclick="$(\'#crnrstn_activity_log_output\').html(\'\');" style="font-family: Courier New, Courier, monospace; color:#06C; font-size:12px;">Clear</a></div>' +
                    '</div>' +
                '</div>').prependTo($('body'));

                switch(self.CRNRSTN_LOGGING_OUTPUT){
                    case 'DOM':

                        $('#crnrstn_activity_log').animate({
                            opacity: 1.0
                        }, {
                            duration: 1000,
                            queue: false,
                            step: function( now, fx ) {

                            },
                            complete: function () {

                            }

                        });

                    break;

                }

            }

            self.log_activity('[lnum 481] DOM READY.', self.CRNRSTN_DEBUG_VERBOSE);

            if($('#crnrstn_ui_documentation_side_nav_src').length){

                self.initialize_interact_ui_documentation_mode();

            }

            self.crnrstn_data_tunnel_session_init();
            self.initialize_delay_ui_sync_controllers();

            if($("#jony5_banner_component_wrapper").length){

                self.initialize_jony5_lifestyle_banner_controller();

            }

            self.enable();
            self.build();

        });

    };

    CRNRSTN_JS.prototype.crnrstn_data_tunnel_session_init = function() {

        this.crnrstn_rtime_timer = setTimeout.call("crnrstn_rtime_timer_interval()", 1000);
        clearTimeout(this.crnrstn_rtime_timer);

        this.start_client_rtime_timer();

    };

    CRNRSTN_JS.prototype.start_client_rtime_timer = function() {

        this.crnrstn_rtime_timer = setTimeout.call("crnrstn_rtime_timer_interval()", 1000);

    };

    //
    // SOURCE :: https://joe-riggs.com/blog/2012/05/javascript-count-up-timer-with-hours-minutes-second-hours-minutes/
    // AUTHOR :: Joe Riggs :: https://joe-riggs.com/blog/author/jriggs/
    CRNRSTN_JS.prototype.crnrstn_rtime_timer_cycle = function() {

        this.log_activity('[lnum 519] Begin client cycling of a second. TTL delta=[' + this.ttl_age_seconds + ']', this.CRNRSTN_DEBUG_CONTROLS);

        this.ttl_age_seconds = this.ttl_age_seconds + 1;

        if(this.ttl_tunnel_monitor_seconds > -1){

            this.ttl_tunnel_monitor_seconds++;

        }

        var time_chunks = this.client_rtime.split(":");
        var hour, mins, secs;
        var hour_copy = '';
        var min_copy = '';
        var secs_copy = '';

        var temp_curr_date = new Date();
        this.client_millisecs = temp_curr_date.getMilliseconds();

        hour = Number(time_chunks[0]);
        mins = Number(time_chunks[1]);
        secs = Number(time_chunks[2]);
        secs++;

        if (secs === 60){
            secs = 0;
            mins = mins + 1;
        }

        if (mins === 60){
            mins = 0;
            hour = hour + 1;
        }

        //if (hour == 13){
        //	hour = 1;
        //}

        this.client_rtime_hour = hour;
        this.client_rtime_mins = this.plz(mins);
        this.client_rtime_secs = this.plz(secs);
        this.client_rtime = this.client_rtime_hour + ":" + this.client_rtime_mins + ":" + this.client_rtime_secs;

        //
        // TODO :: NEED TO POPULATE UNIT/UNITS FROM THE SSDTLA XML RESPONSE DATA FOR MULTI-LANGUAGE SUPPORT
        if (hour > 0) {

            hour_copy = hour + " hr";

            if (hour > 1) {

                hour_copy = hour_copy + "s";

            }

            hour_copy = hour_copy + " ";

        }

        //
        // TODO :: NEED TO POPULATE UNIT/UNITS FROM THE SSDTLA XML RESPONSE DATA FOR MULTI-LANGUAGE SUPPORT
        if (mins > 0) {

            min_copy = mins + " min";

            if (mins > 1) {

                min_copy = min_copy + "s";

            }

        }

        //
        // TODO :: NEED TO POPULATE UNIT/UNITS FROM THE SSDTLA XML RESPONSE DATA FOR MULTI-LANGUAGE SUPPORT
        if (secs > 0) {

            secs_copy = " " + secs + "." + this.client_millisecs + " secs";

        } else {

            secs_copy = " 0." + this.client_millisecs + " secs";

        }

        this.client_rtime_pretty = hour_copy + min_copy + secs_copy;

        //
        // PROCESS TTL
        this.process_data_tunnel_ttl();

        //
        // PROCESS UI STATE UPDATES
        this.execute_ui_sync_controller();

    };

    CRNRSTN_JS.prototype.execute_ui_sync_controller = function() {

        var tmp_thread_id_cnt = this.transaction_thread_id_key_ARRAY.length;

        for(let i = 0; i < tmp_thread_id_cnt; i++){

            if(this.ui_sync_controller_thread_delay_ARRAY[this.transaction_thread_id_key_ARRAY[i]] > -1 ){

                var tmp_delay_secs = this.ui_sync_controller_thread_delay_ARRAY[this.transaction_thread_id_key_ARRAY[i]];

                if(tmp_delay_secs > 0){

                    tmp_delay_secs--;
                    this.ui_sync_controller_thread_delay_ARRAY[this.transaction_thread_id_key_ARRAY[i]] = tmp_delay_secs;

                }else{

                    if(tmp_delay_secs === 0){

                        //this.log_activity('[lnum 635] FIRE! FIRE! FIRE! Executing ' + this.transaction_thread_id_key_ARRAY[i] + ' UI sync now. Looking forward to hearing from you! All the best, J5.', this.CRNRSTN_DEBUG_VERBOSE);

                        this.execution_delay_ui_sync_controller('fire', this.transaction_thread_id_key_ARRAY[i], false);

                        this.ui_sync_controller_thread_delay_ARRAY[this.transaction_thread_id_key_ARRAY[i]] = -1;

                    }

                }

            }

        }

    };

    CRNRSTN_JS.prototype.process_data_tunnel_ttl = function() {

        this.log_activity('[lnum 653] Analyzing SSDTLA TTL.', this.CRNRSTN_DEBUG_CONTROLS);

        //
        // CHECK PAGE LOAD TTL
        if(this.ttl_age_seconds > this.data_tunnel_ttl_monitor_ARRAY['page_load_data_ttl'] && this.data_tunnel_ttl_monitor_ARRAY['page_load_data_ttl'] != -1){

            this.log_activity('[lnum 659] CRNRSTN :: SOAP Services Data Tunnel Layer Architecture (SSDTLA) TTL EXPIRED - PAGE LOAD TTL (' + this.data_tunnel_ttl_monitor_ARRAY['page_load_data_ttl']  + ' secs).', this.CRNRSTN_DEBUG_VERBOSE);   // CRNRSTN_DEBUG_BASIC

            this.ttl_age_seconds = -1;
            this.data_tunnel_ttl_monitor_ARRAY['page_load_data_ttl'] = -1;

            this.ttl_tunnel_monitor_seconds = 1;
            this.fire_dom_state_controller();

        }else{

            if(this.data_tunnel_ttl_monitor_isactive){

                // DO NOT RUN UNTIL READY TO PROCESS XML DRIVEN TTL UPDATES
                // CHECK FOR THREAD ID TTL EXPIRE
                if(this.thread_id_ttl_expired()){

                    this.ttl_age_seconds = -1;
                    this.data_tunnel_ttl_monitor_isactive = false;
                    this.ttl_tunnel_monitor_seconds = 1;
                    this.log_activity('[lnum 678] ***** fire_dom_state_controller() DEV ABORTED ***** [CRNRSTN_JS.prototype.process_data_tunnel_ttl()].', this.CRNRSTN_DEBUG_VERBOSE);
                    //this.fire_dom_state_controller();

                }

            }else{

                //
                // INACTIVITY REFRESH. SET TO 5 MIN (300s)?
                if(this.ttl_tunnel_monitor_seconds > 300){

                    this.ttl_age_seconds = -1;
                    this.data_tunnel_ttl_monitor_isactive = false;
                    this.ttl_tunnel_monitor_seconds = 1;
                    this.log_activity('[lnum 692] CRNRSTN :: SOAP Services Data Tunnel Layer Architecture (SSDTLA) TTL EXPIRED - INACTIVITY REFRESH TTL (5 min).', this.CRNRSTN_DEBUG_VERBOSE);   // CRNRSTN_DEBUG_BASIC
                    this.fire_dom_state_controller();

                }

            }

        }

    };

    CRNRSTN_JS.prototype.fire_dom_state_controller = function() {

        //var ssdtl_endpoint = document.getElementById("crnrstn_request_ajax_root").innerHTML;
        var ssdtl_endpoint = $("#crnrstn_request_ajax_root").val();

        if(ssdtl_endpoint !== undefined && ssdtl_endpoint != ''){

            //
            // SERIALIZATION FOR FORM DATA AND RESPONSE HANDLING
            this.initialize_transaction_serialization();

            var form = $("#crnrstn_soap_data_tunnel_frm");
            var dataString = $(form).serialize();
            //debugger;

            this.log_activity('[lnum 928] Sending CRNRSTN :: SOAP Services Data Tunnel Layer Packet (SSDTLP) in AJAX POST to [' + ssdtl_endpoint + '].', this.CRNRSTN_DEBUG_LIFESTYLE_BANNER);
            this.log_activity('[lnum 929] SSDTLP Serialization Key = [' + $('#' + this.form_input_serialization_key).val() + '].', this.CRNRSTN_DEBUG_LIFESTYLE_BANNER);
            this.log_activity('[lnum 930] SSDTLP Checksum = [' + $('#' + this.form_input_serialization_checksum).val() + '].', this.CRNRSTN_DEBUG_LIFESTYLE_BANNER);
            this.log_activity('[lnum 931] SSDTLP [ACTION] = [' + $('#crnrstn_interact_ui_link_text_click').val() + '].', this.CRNRSTN_DEBUG_LIFESTYLE_BANNER);

            if($('#crnrstn_interact_ui_link_text_click').val() != ''){

                //
                // THIS IS SO BAD! LOL.
                $.ajax({
                    type: "POST",
                    url: ssdtl_endpoint,
                    data: dataString,
                    dataType: "html",
                    success: this.parse_data_tunnel_response

                });

            }else{

                $.ajax({
                    type: "POST",
                    url: ssdtl_endpoint,
                    data: dataString,
                    dataType: "xml",
                    success: this.parse_data_tunnel_response

                });

            }

        }

        //this.log_activity('[lnum 778] CRNRSTN :: SOAP Services Data Tunnel Layer Architecture (SSDTLA) aborting AJAX POST to [' + ssdtl_endpoint + '].', this.CRNRSTN_DEBUG_LIFESTYLE_BANNER);

    };

    CRNRSTN_JS.prototype.parse_data_tunnel_response = function(response_data) {

        //var packet_dl_bytes = response_data.documentElement.innerHTML.length;
        var packet_dl_bytes = response_data.length;
        oCRNRSTN_JS.log_activity('[lnum 739] Receiving ' + oCRNRSTN_JS.pretty_format_number(packet_dl_bytes) + ' chars in POST response from CRNRSTN :: SOAP Services Data Tunnel Layer Architecture (SSDTLA).', oCRNRSTN_JS.CRNRSTN_DEBUG_VERBOSE);

        oCRNRSTN_JS.receive_data_tunnel_response(response_data);

    };

    CRNRSTN_JS.prototype.return_data_tunnel_xml_data = function(nomination, index = 0) {

        return this.ssdtl_response_data_container_ARRAY[nomination + '_' + index];

    };

    CRNRSTN_JS.prototype.return_xml_response_data_index = function(nomination) {

        var tmp_index_cnt = 0;

        if(!(nomination in this.ssdtl_response_data_index_tracker_ARRAY)){

            this.ssdtl_response_data_index_tracker_ARRAY[nomination] = 1;
            tmp_index_cnt = this.ssdtl_response_data_index_tracker_ARRAY[nomination];

        }else{

            tmp_index_cnt = this.ssdtl_response_data_index_tracker_ARRAY[nomination];
            tmp_index_cnt = (tmp_index_cnt * 1) + 1;
            this.ssdtl_response_data_index_tracker_ARRAY[nomination] = tmp_index_cnt;

        }

        return tmp_index_cnt;

    };

    CRNRSTN_JS.prototype.get_xml_response_node_data = function(response_data, xml_nom, node_attribute_nom) {

        var tmp_data = '';

        if(node_attribute_nom.length > 0){

            if(response_data.localName === xml_nom){

                tmp_data = response_data.getAttribute(node_attribute_nom);

            }else{

                var NODE_response_data = response_data.getElementsByTagName(xml_nom);

                if(NODE_response_data[0] != undefined){

                    tmp_data = NODE_response_data[0].getAttribute(node_attribute_nom);

                }

            }

        }else{

            tmp_len = response_data.childNodes.length;
            for(let i = 0; i < tmp_len; i++){

                var tmp_node = response_data.childNodes[i];
                if(tmp_node.nodeName === xml_nom){

                    tmp_data = tmp_node.textContent;
                    i = tmp_len + 1;

                }else{

                    if(tmp_node.nodeName === '#cdata-section'){

                        tmp_data = response_data.textContent;

                    }

                }

            }

        }

        return tmp_data;

    };

    CRNRSTN_JS.prototype.initialize_ttl_tracking = function(nomination, index) {

        /*
        bassdrive_is_live_ttl
        the_situation_with_bassdrive_ttl
        bassdrive_title_ttl
        bassdrive_locale_city_province_ttl
        bassdrive_locale_nation_ttl
        stream_relays_ttl
        social_media_connects_ttl
        relay_performance_ttl
        lifestyle_banner_ttl
        */

        if($.inArray(nomination, this.xml_node_ttl_indices_ARRAY) >= 0){

            this.ttl_array_pointer_index_ARRAY.push(nomination + '_' + index);
            this.ttl_array_pointer_index_root_ARRAY[nomination + '_' + index] = nomination;

            this.log_activity('[lnum 842] TTL tracking has been initialized for XML node [' + nomination + '] with index append of [\'_' + index + '\'] .', this.CRNRSTN_DEBUG_BASIC);

        }

    };

    CRNRSTN_JS.prototype.compile_jony5_lifestyle_banner_images = function(nomination, response_data) {

        switch(nomination){
            case 'banner_img_uri':

                if(!(response_data in this.jony5_lifestyle_banner_index_ARRAY)){

                    var tmp_str = this.extract_filename(response_data);
                    this.log_activity('[lnum 856] STORING CRNRSTN :: SSDTL RESPONSE XML DATA [' + tmp_str + '] FROM NODE ' + nomination + '.', this.CRNRSTN_DEBUG_LIFESTYLE_BANNER);

                    this.jony5_lifestyle_banner_index_ARRAY[response_data] = 1;
                    this.jony5_lifestyle_banner_images_ARRAY.push(response_data);

                }else{

                    var tmp_str = this.extract_filename(response_data);
                    this.log_activity('[lnum 864] SKIPPING CRNRSTN :: SSDTL RESPONSE REDUNDANT XML DATA [' + tmp_str + '] FROM NODE ' + nomination + '.', this.CRNRSTN_DEBUG_LIFESTYLE_BANNER);

                }

            break;
            case 'banner_img_full_scrn_uri':

                //
                // FULL SCREEN EXPERIENCE
                if(!(response_data in this.jony5_lifestyle_banner_index_FULLSCREEN_ARRAY)){

                    var tmp_str = this.extract_filename(response_data);
                    this.log_activity('[lnum 876] STORING CRNRSTN :: SSDTL RESPONSE XML DATA [' + tmp_str + '] FROM NODE ' + nomination + '.', this.CRNRSTN_DEBUG_LIFESTYLE_BANNER);

                    this.jony5_lifestyle_banner_index_FULLSCREEN_ARRAY[response_data] = 1;
                    this.jony5_lifestyle_banner_images_FULLSCREEN_ARRAY.push(response_data);

                }else{

                    var tmp_str = this.extract_filename(response_data);
                    this.log_activity('[lnum 884] SKIPPING REDUNDANT CRNRSTN :: SSDTL RESPONSE XML DATA [' + tmp_str + '] FROM NODE ' + nomination + '.', this.CRNRSTN_DEBUG_LIFESTYLE_BANNER);

                }

            break;

        }

    };

    CRNRSTN_JS.prototype.consume_data_tunnel_xml_node = function(response_data, nomination, xml_nom, node_attribute_nom, serialize_response, index = 0) {

        var tmp_data = this.get_xml_response_node_data(response_data, xml_nom, node_attribute_nom);

        tmp_data = tmp_data.trim();

        if(xml_nom === 'soap_data_tunnel_layer_fih_packet'){

            if(tmp_data != ''){

                $("#crnrstn_soap_data_tunnel_form_shell").html(tmp_data);

            }

        }

        var tmp_index_cnt = this.return_xml_response_data_index(nomination);

        if(serialize_response == true){

            index = tmp_index_cnt;
            index--;

        }

        if((nomination == 'banner_img_uri' || nomination == 'banner_img_full_scrn_uri') && tmp_data != ''){

            this.compile_jony5_lifestyle_banner_images(nomination, tmp_data);

        }

        if(node_attribute_nom.length > 0){

            this.log_activity('[lnum 927] Storing XML data (len='+ tmp_data.length +') attribute [' + node_attribute_nom + '] from XML node [' + xml_nom + '] as [' + nomination + '] with index append of [\'_' + index + '\'] .', this.CRNRSTN_DEBUG_CONTROLS);

        }else{

            this.log_activity('[lnum 931] Storing XML node [' + xml_nom + '] data[' + tmp_data + '] (len='+ tmp_data.length +') as [' + nomination + '] with index append of [\'_' + index + '\'] .', this.CRNRSTN_DEBUG_CONTROLS);

        }

        if(tmp_data === 'undefined' || tmp_data === null){

            this.ssdtl_response_data_container_ARRAY[nomination + '_' + index] = '';

        }else{

            //
            // NOTE :: endpoint_url NEEDS URL DECODING BEFORE IMPLEMENTATION AT CLIENT
            this.ssdtl_response_data_container_ARRAY[nomination + '_' + index] = tmp_data;

        }

        this.initialize_ttl_tracking(nomination, index);

    };

    // CRNRSTN_JS.prototype.crnrstn_ui_interact_is_visible_show = function() {
    //
    //     $('#crnrstn_ui_interact_wrapper').animate({
    //         opacity: 0
    //     }, {
    //         duration: 0,
    //         queue: false,
    //         step: function( now, fx ) {
    //
    //         },
    //         complete: function () {
    //
    //             $('#crnrstn_ui_interact_wrapper').css('overflow', 'visible');
    //
    //             $('#crnrstn_ui_interact_wrapper').animate({
    //                 width: 100,
    //                 height: 70,
    //                 paddingBottom: 20,
    //                 left: '84%'
    //             }, {
    //                 duration: 0,
    //                 queue: false,
    //                 step: function( now, fx ) {
    //
    //                 },
    //                 complete: function () {
    //
    //                     $( "#crnrstn_ui_interact_wrapper").animate({
    //                         opacity: 1.0
    //                     }, {
    //                         duration: 250,
    //                         queue: false,
    //                         specialEasing: {
    //                             opacity: "swing"
    //                         },
    //                         step: function( now, fx ) {
    //
    //                         },
    //                         complete: function () {
    //
    //                         }
    //                     });
    //
    //                 }
    //
    //             });
    //
    //         }
    //
    //     });
    //
    // };

    CRNRSTN_JS.prototype.consume_browser_state_sync_data = function(response_data, serialize_response) {

        this.consume_data_tunnel_xml_node(response_data, 'response_serial', 'serial', '' , serialize_response);
        this.consume_data_tunnel_xml_node(response_data, 'request_timestamp', 'request_id', 'timestamp' , serialize_response);
        this.consume_data_tunnel_xml_node(response_data, 'request_id', 'request_id', '' , serialize_response);
        this.consume_data_tunnel_xml_node(response_data, 'response_server_runtime', 'server_runtime', '' , serialize_response);
        this.consume_data_tunnel_xml_node(response_data, 'request_authorization_key', 'request_authorization_key', '' , serialize_response);
        this.consume_data_tunnel_xml_node(response_data, 'request_locale_identifier', 'request_locale_identifier', '' , serialize_response);
        this.consume_data_tunnel_xml_node(response_data, 'request_referer', 'request_referer', '' , serialize_response);
        this.consume_data_tunnel_xml_node(response_data, 'client_id', 'client_id', '' , serialize_response);
        this.consume_data_tunnel_xml_node(response_data, 'client_auth_key', 'client_auth_key', '' , serialize_response);
        this.consume_data_tunnel_xml_node(response_data, 'server_name', 'server_name', '' , serialize_response);
        this.consume_data_tunnel_xml_node(response_data, 'server_ip_address', 'server_ip_address', '' , serialize_response);
        this.consume_data_tunnel_xml_node(response_data, 'client_ip_address', 'client_ip_address', '' , serialize_response);

    };

    CRNRSTN_JS.prototype.consume_response_status_data = function(response_data, serialize_response){

        var NODE_status_report = response_data.getElementsByTagName('status_report');
        var tmp_node_cnt = NODE_status_report.length;
        if(tmp_node_cnt > 0){

            for(let i = 0; i < tmp_node_cnt; i++){

                this.consume_data_tunnel_xml_node(NODE_status_report[i], 'target_element', 'target_element', '' , true, i);
                this.consume_data_tunnel_xml_node(NODE_status_report[i], 'status_code', 'status_code', '' , true, i);
                this.consume_data_tunnel_xml_node(NODE_status_report[i], 'status_message', 'status_message', '' , true, i);
                this.consume_data_tunnel_xml_node(NODE_status_report[i], 'is_error_code', 'is_error_code', '' , true, i);
                this.consume_data_tunnel_xml_node(NODE_status_report[i], 'is_error_message', 'is_error_message', '' , true, i);

            }

        }

    };

    CRNRSTN_JS.prototype.consume_response_client_profile_data = function(response_data, serialize_response){

        //
        // GLOBAL PRIVACY CONTROL
        var NODE_global_privacy_control = response_data.getElementsByTagName('global_privacy_control');
        var tmp_node_cnt = NODE_global_privacy_control.length;
        if(tmp_node_cnt > 0) {

            for(let i = 0; i < tmp_node_cnt; i++) {

                this.consume_data_tunnel_xml_node(NODE_global_privacy_control[i], 'sec_gpc', 'sec_gpc', '' , true, i);

            }

        }

        //
        // DEVICE TYPE
        var NODE_device_type = response_data.getElementsByTagName('device_type');
        tmp_node_cnt = NODE_device_type.length;
        if(tmp_node_cnt > 0) {

            this.consume_data_tunnel_xml_node(response_data, 'device_type', 'device_type', '', serialize_response);

        }

        // //
        // // LANGUAGE
        // var NODE_global_privacy_control = response_data.getElementsByTagName('global_privacy_control');
        // var tmp_node_cnt = NODE_global_privacy_control.length;
        // if(tmp_node_cnt > 0) {
        //
        //     for (i = 0; i < tmp_node_cnt; i++) {
        //
        //         this.consume_data_tunnel_xml_node(NODE_global_privacy_control[i], 'sec_gpc', 'sec_gpc', '' , true, i);
        //
        //     }
        //
        // }

        //
        // LANGUAGE PREFERENCES
        var NODE_language = response_data.getElementsByTagName('language');
        tmp_node_cnt = NODE_language.length;
        if(tmp_node_cnt > 0){

            var NODE_language_preference = response_data.getElementsByTagName('language_preference');
            tmp_node_cnt = NODE_language_preference.length;

            for(let i = 0; i < tmp_node_cnt; i++){

                this.consume_data_tunnel_xml_node(NODE_language_preference[i], 'language_preference_request_id_timestamp', 'request_id', 'timestamp' , true, i);
                this.consume_data_tunnel_xml_node(NODE_language_preference[i], 'language_preference_request_id', 'request_id', '' , true, i);
                this.consume_data_tunnel_xml_node(NODE_language_preference[i], 'language_preference_request_referer', 'request_referer', '' , true, i);
                this.consume_data_tunnel_xml_node(NODE_language_preference[i], 'language_preference_locale_identifier', 'locale_identifier', '' , true, i);
                this.consume_data_tunnel_xml_node(NODE_language_preference[i], 'language_preference_region_variant', 'region_variant', '' , true, i);
                this.consume_data_tunnel_xml_node(NODE_language_preference[i], 'language_preference_factor_weighting', 'factor_weighting', '' , true, i);
                this.consume_data_tunnel_xml_node(NODE_language_preference[i], 'language_preference_iso_language_nomination', 'iso_language_nomination', '' , true, i);
                this.consume_data_tunnel_xml_node(NODE_language_preference[i], 'language_preference_native_nomination', 'native_nomination', '' , true, i);
                this.consume_data_tunnel_xml_node(NODE_language_preference[i], 'language_preference_iso_639-1_2002', 'iso_639-1_2002', '' , true, i);
                this.consume_data_tunnel_xml_node(NODE_language_preference[i], 'language_preference_iso_639-2_1998', 'iso_639-2_1998', '' , true, i);
                this.consume_data_tunnel_xml_node(NODE_language_preference[i], 'language_preference_iso_639-3_2007', 'iso_639-3_2007', '' , true, i);

            }

        }

    };

    CRNRSTN_JS.prototype.consume_response_crnrstn_ui_interact_profile_data = function(response_data, serialize_response){

        /*
        <crnrstn_ui_interact_profile>
            <is_enabled>true</is_enabled>
            <is_visible>true</is_visible>
            <theme_configuration>
                <canvas z_index="60" window_edge_padding="20" outline_border_edge_line_width="2" outline_border_edge_line_style="solid" outline_border_edge_line_color="#767676" border_width="10" border_color="#FFF" border_opacity="0.3" background_color="#FFF" background_opacity="1" inner_content_edge_padding="25" checksum="1618734614"></canvas>
                <mini_canvas left="84%" width="100" height="70" checksum="956164994"></mini_canvas>
                <signin_canvas width="260" height="305" checksum="2313296795"></signin_canvas>
                <main_canvas width="1080" height="760" checksum="2023304991"></main_canvas>
                <eula_canvas width="700" height="400" checksum="592092546"></eula_canvas>
                <mit_license_canvas width="500" height="400" checksum="1854028937"></mit_license_canvas>
            </theme_configuration>
        </crnrstn_ui_interact_profile>

        */

        //
        // CRNRSTN :: UI INTERACT ENABLED
        var NODE_crnrstn_ui_interact_is_enabled = response_data.getElementsByTagName('is_enabled');
        tmp_node_cnt = NODE_crnrstn_ui_interact_is_enabled.length;
        if(tmp_node_cnt > 0) {

            this.consume_data_tunnel_xml_node(response_data, 'crnrstn_ui_interact_is_enabled', 'is_enabled', '', serialize_response);

        }

        //
        // CRNRSTN :: UI INTERACT IS_VISIBLE
        var NODE_crnrstn_ui_interact_is_visible = response_data.getElementsByTagName('is_visible');
        tmp_node_cnt = NODE_crnrstn_ui_interact_is_visible.length;
        if(tmp_node_cnt > 0) {

            this.consume_data_tunnel_xml_node(response_data, 'crnrstn_ui_interact_is_visible', 'is_visible', '', serialize_response);

        }

        //
        // CRNRSTN :: UI INTERACT THEME CONFIGURATION
        var NODE_theme_configuration = response_data.getElementsByTagName('theme_configuration');
        tmp_node_cnt = NODE_theme_configuration.length;
        if(tmp_node_cnt > 0) {

            this.consume_data_tunnel_xml_node(response_data, 'canvas_z_index', 'canvas', 'z_index' , serialize_response);
            this.consume_data_tunnel_xml_node(response_data, 'canvas_window_edge_padding', 'canvas', 'window_edge_padding', serialize_response);
            this.consume_data_tunnel_xml_node(response_data, 'canvas_outline_border_edge_line_width', 'canvas', 'outline_border_edge_line_width', serialize_response);
            this.consume_data_tunnel_xml_node(response_data, 'canvas_outline_border_edge_line_style', 'canvas', 'outline_border_edge_line_style', serialize_response);
            this.consume_data_tunnel_xml_node(response_data, 'canvas_outline_border_edge_line_color', 'canvas', 'outline_border_edge_line_color', serialize_response);
            this.consume_data_tunnel_xml_node(response_data, 'canvas_border_width', 'canvas', 'border_width', serialize_response);
            this.consume_data_tunnel_xml_node(response_data, 'canvas_border_color', 'canvas', 'border_color', serialize_response);
            this.consume_data_tunnel_xml_node(response_data, 'canvas_border_opacity', 'canvas', 'border_opacity', serialize_response);
            this.consume_data_tunnel_xml_node(response_data, 'canvas_background_color', 'canvas', 'background_color', serialize_response);
            this.consume_data_tunnel_xml_node(response_data, 'canvas_background_opacity', 'canvas', 'background_opacity', serialize_response);
            this.consume_data_tunnel_xml_node(response_data, 'canvas_inner_content_edge_padding', 'canvas', 'inner_content_edge_padding', serialize_response);
            this.consume_data_tunnel_xml_node(response_data, 'canvas_checksum', 'canvas', 'checksum', serialize_response);

            this.consume_data_tunnel_xml_node(response_data, 'mini_canvas_left', 'mini_canvas', 'left', serialize_response);
            this.consume_data_tunnel_xml_node(response_data, 'mini_canvas_width', 'mini_canvas', 'width', serialize_response);
            this.consume_data_tunnel_xml_node(response_data, 'mini_canvas_height', 'mini_canvas', 'height', serialize_response);
            this.consume_data_tunnel_xml_node(response_data, 'mini_canvas_checksum', 'mini_canvas', 'checksum', serialize_response);

            this.consume_data_tunnel_xml_node(response_data, 'signin_canvas_width', 'signin_canvas', 'width', serialize_response);
            this.consume_data_tunnel_xml_node(response_data, 'signin_canvas_height', 'signin_canvas', 'height', serialize_response);
            this.consume_data_tunnel_xml_node(response_data, 'signin_canvas_checksum', 'signin_canvas', 'checksum', serialize_response);

            this.consume_data_tunnel_xml_node(response_data, 'main_canvas_width', 'main_canvas', 'width', serialize_response);
            this.consume_data_tunnel_xml_node(response_data, 'main_canvas_height', 'main_canvas', 'height', serialize_response);
            this.consume_data_tunnel_xml_node(response_data, 'main_canvas_checksum', 'main_canvas', 'checksum', serialize_response);

            this.consume_data_tunnel_xml_node(response_data, 'eula_canvas_width', 'eula_canvas', 'width', serialize_response);
            this.consume_data_tunnel_xml_node(response_data, 'eula_canvas_height', 'eula_canvas', 'height', serialize_response);
            this.consume_data_tunnel_xml_node(response_data, 'eula_canvas_checksum', 'eula_canvas', 'checksum', serialize_response);

            this.consume_data_tunnel_xml_node(response_data, 'mit_license_canvas_width', 'mit_license_canvas', 'width', serialize_response);
            this.consume_data_tunnel_xml_node(response_data, 'mit_license_canvas_height', 'mit_license_canvas', 'height', serialize_response);
            this.consume_data_tunnel_xml_node(response_data, 'mit_license_canvas_checksum', 'mit_license_canvas', 'checksum', serialize_response);

        }

    };

    CRNRSTN_JS.prototype.consume_response_bassdrive_data = function(response_data, serialize_response){

        //
        // JSON SOURCE
        var NODE_json_log_id = response_data.getElementsByTagName('json_log_id');
        var tmp_node_cnt = NODE_json_log_id.length;
        if(tmp_node_cnt > 0) {

            this.consume_data_tunnel_xml_node(response_data, 'bassdrive_json_log_id', 'json_log_id', '', serialize_response);
            this.consume_data_tunnel_xml_node(response_data, 'bassdrive_json_log_id_url', 'json_log_id', 'url', serialize_response);
            this.consume_data_tunnel_xml_node(response_data, 'bassdrive_json_log_id_timestamp', 'json_log_id', 'timestamp', serialize_response);

        }

        //
        // WEB PLAYER URL
        var NODE_web_player_url = response_data.getElementsByTagName('web_player_url');
        tmp_node_cnt = NODE_web_player_url.length;
        if(tmp_node_cnt > 0) {

            this.consume_data_tunnel_xml_node(response_data, 'bassdrive_web_player_url', 'web_player_url', '', serialize_response);

        }

        //
        // IS LIVE
        var NODE_is_live = response_data.getElementsByTagName('is_live');
        tmp_node_cnt = NODE_is_live.length;
        if(tmp_node_cnt > 0) {

            this.consume_data_tunnel_xml_node(response_data, 'bassdrive_is_live', 'is_live', '', serialize_response);
            this.consume_data_tunnel_xml_node(response_data, 'bassdrive_is_live_ttl', 'is_live', 'ttl', serialize_response);

        }

        //
        // THE SITUATION WITH BASSDRIVE
        var NODE_the_situation_with_bassdrive = response_data.getElementsByTagName('the_situation_with_bassdrive');
        tmp_node_cnt = NODE_the_situation_with_bassdrive.length;
        if(tmp_node_cnt > 0) {

            this.consume_data_tunnel_xml_node(response_data, 'the_situation_with_bassdrive_ttl', 'the_situation_with_bassdrive', 'ttl' , serialize_response);

            var NODE_likely_status = response_data.getElementsByTagName('likely_status');
            var tmp_node_cnt = NODE_likely_status.length;
            for(let i = 0; i < tmp_node_cnt; i++) {

                this.consume_data_tunnel_xml_node(NODE_likely_status[i], 'the_situation_with_bassdrive_likely_status', 'likely_status', '' , serialize_response, i);

            }

        }

        //
        // STREAM KEY
        var NODE_stream_key = response_data.getElementsByTagName('stream_key');
        tmp_node_cnt = NODE_stream_key.length;
        if(tmp_node_cnt > 0) {

            this.consume_data_tunnel_xml_node(response_data, 'bassdrive_stream_key', 'stream_key', '', serialize_response);

        }

        //
        // RELAY STREAM TITLE
        var NODE_title = response_data.getElementsByTagName('title');
        tmp_node_cnt = NODE_title.length;
        if(tmp_node_cnt > 0) {

            this.consume_data_tunnel_xml_node(response_data, 'bassdrive_title', 'title', '', serialize_response);
            this.consume_data_tunnel_xml_node(response_data, 'bassdrive_title_ttl', 'title', 'ttl', serialize_response);

        }

        //
        // RELAY BROADCAST LOCALE
        var NODE_locale_city_province = response_data.getElementsByTagName('locale_city_province');
        tmp_node_cnt = NODE_locale_city_province.length;
        if(tmp_node_cnt > 0) {

            this.consume_data_tunnel_xml_node(response_data, 'bassdrive_locale_city_province', 'locale_city_province', '', serialize_response);
            this.consume_data_tunnel_xml_node(response_data, 'bassdrive_locale_city_province_ttl', 'locale_city_province', 'ttl', serialize_response);

        }

        //
        // RELAY BROADCAST LOCALE NATION
        var NODE_locale_nation = response_data.getElementsByTagName('locale_nation');
        tmp_node_cnt = NODE_locale_nation.length;
        if(tmp_node_cnt > 0) {

            this.consume_data_tunnel_xml_node(response_data, 'bassdrive_locale_nation', 'locale_nation', '', serialize_response);
            this.consume_data_tunnel_xml_node(response_data, 'bassdrive_locale_nation_ttl', 'locale_nation', 'ttl', serialize_response);
            this.consume_data_tunnel_xml_node(response_data, 'bassdrive_locale_nation_colors_url', 'locale_nation', 'url', serialize_response);

        }

        //
        // RELAY BROADCAST TITLE HTML
        var NODE_title_html = response_data.getElementsByTagName('title_html');
        tmp_node_cnt = NODE_title_html.length;
        if(tmp_node_cnt > 0) {

            this.consume_data_tunnel_xml_node(response_data, 'bassdrive_title_html', 'title_html', '', serialize_response);

        }

        //
        // RELAY BROADCAST LOCALE HTML
        var NODE_locale_html = response_data.getElementsByTagName('locale_html');
        tmp_node_cnt = NODE_locale_html.length;
        if(tmp_node_cnt > 0) {

            this.consume_data_tunnel_xml_node(response_data, 'bassdrive_locale_html', 'locale_html', '', serialize_response);

        }

        //
        // RELAY BROADCAST SOCIAL MEDIA HTML
        var NODE_social_html = response_data.getElementsByTagName('social_html');
        tmp_node_cnt = NODE_social_html.length;
        if(tmp_node_cnt > 0) {

            this.consume_data_tunnel_xml_node(response_data, 'bassdrive_social_html', 'social_html', '', serialize_response);

        }

        //
        // RELAYS
        var NODE_stream_relays = response_data.getElementsByTagName('stream_relays');
        tmp_node_cnt = NODE_stream_relays.length;
        if(tmp_node_cnt > 0) {

            this.consume_data_tunnel_xml_node(response_data, 'stream_relays_ttl', 'stream_relays', 'ttl' , serialize_response);

            var NODE_stream = NODE_stream_relays[0].getElementsByTagName('stream');
            var tmp_node_cnt = NODE_stream.length;
            for(let i = 0; i < tmp_node_cnt; i++) {

                this.consume_data_tunnel_xml_node(NODE_stream[i], 'stream_url', 'stream', 'url' , serialize_response, i);
                this.consume_data_tunnel_xml_node(NODE_stream[i], 'stream_url_ios', 'stream', 'url_ios' , serialize_response, i);
                this.consume_data_tunnel_xml_node(NODE_stream[i], 'stream_bitrate', 'bitrate', '' , serialize_response, i);
                this.consume_data_tunnel_xml_node(NODE_stream[i], 'stream_audio_format', 'audio_format', '' , serialize_response, i);
                this.consume_data_tunnel_xml_node(NODE_stream[i], 'stream_listener_count', 'listener_count', '' , serialize_response, i);
                this.consume_data_tunnel_xml_node(NODE_stream[i], 'stream_listener_count_percentage', 'listener_count_percentage', '' , serialize_response, i);

            }

        }

        //
        // SOCIAL MEDIA INTEGRATIONS
        var NODE_social_media_connects = response_data.getElementsByTagName('social_media_connects');
        tmp_node_cnt = NODE_social_media_connects.length;
        if(tmp_node_cnt > 0) {

            this.consume_data_tunnel_xml_node(response_data, 'social_media_connects_ttl', 'social_media_connects', 'ttl' , serialize_response);

            var NODE_endpoint = NODE_social_media_connects[0].getElementsByTagName('endpoint');
            var tmp_node_cnt = NODE_endpoint.length;
            for(let i = 0; i < tmp_node_cnt; i++) {

                this.consume_data_tunnel_xml_node(NODE_endpoint[i], 'endpoint_type', 'endpoint', 'type' , serialize_response, i);
                this.consume_data_tunnel_xml_node(NODE_endpoint[i], 'endpoint_url', 'endpoint', 'url' , serialize_response, i);

            }

        }

        //
        // STREAM PERFORMANCE
        var NODE_performance = response_data.getElementsByTagName('performance');
        var tmp_node_cnt = NODE_performance.length;
        if(tmp_node_cnt > 0) {

            //
            // TTL
            this.consume_data_tunnel_xml_node(response_data, 'relay_performance_ttl', 'performance', 'ttl' , serialize_response);

            //
            // CURRENT STREAM PERFORMANCE
            var NODE_current_statistics = NODE_performance[0].getElementsByTagName('current_statistics');
            tmp_node_cnt = NODE_current_statistics.length;
            for(let i = 0; i < tmp_node_cnt; i++) {

                //
                // TIMESTAMP
                this.consume_data_tunnel_xml_node(NODE_current_statistics[0], 'current_connection_stat_timestamp', 'connection_stat', 'timestamp' , serialize_response);
                this.consume_data_tunnel_xml_node(NODE_current_statistics[0], 'current_connection_stat_json_log_id', 'connection_stat', 'json_log_id' , serialize_response);

                var NODE_current_connection_stat = NODE_current_statistics[0].getElementsByTagName('connection_stat');
                tmp_node_cnt = NODE_current_connection_stat.length;
                for(let ii = 0; ii < tmp_node_cnt; ii++) {

                    var NODE_current_stream_stat = NODE_current_connection_stat[ii].getElementsByTagName('stream_stat');
                    var tmp_node_cnt_inner = NODE_current_stream_stat.length;
                    for(let iii = 0; iii < tmp_node_cnt_inner; iii++) {

                        this.consume_data_tunnel_xml_node(NODE_current_stream_stat[iii], 'current_stream_stat_type', 'stream_stat', 'type' , serialize_response, iii);
                        this.consume_data_tunnel_xml_node(NODE_current_stream_stat[iii], 'current_stream_stat_connections', 'connections', '', serialize_response, iii);
                        this.consume_data_tunnel_xml_node(NODE_current_stream_stat[iii], 'current_stream_stat_connections_capacity', 'connections', 'capacity', serialize_response, iii);
                        this.consume_data_tunnel_xml_node(NODE_current_stream_stat[iii], 'current_stream_stat_bandwidth', 'bandwidth', '', serialize_response, iii);
                        this.consume_data_tunnel_xml_node(NODE_current_stream_stat[iii], 'current_stream_stat_bandwidth_format', 'bandwidth', 'format', serialize_response, iii);
                        this.consume_data_tunnel_xml_node(NODE_current_stream_stat[iii], 'current_stream_stat_bitrate', 'bitrate', '', serialize_response, iii);
                        this.consume_data_tunnel_xml_node(NODE_current_stream_stat[iii], 'current_stream_stat_bitrate_format', 'bitrate', 'format', serialize_response, iii);

                    }

                }

            }

            //
            // RECENT STREAM PERFORMANCE
            //var ii = 0;
            var NODE_recent_statistics = NODE_performance[0].getElementsByTagName('recent_statistics');
            tmp_node_cnt = NODE_recent_statistics.length;
            for(let i = 0; i < tmp_node_cnt; i++) {

                //
                // TIMESTAMP
                this.consume_data_tunnel_xml_node(NODE_recent_statistics[0], 'recent_connection_stat_timestamp', 'connection_stat', 'timestamp' , serialize_response);

                var NODE_recent_connection_stat = NODE_recent_statistics[0].getElementsByTagName('connection_stat');
                tmp_node_cnt = NODE_recent_connection_stat.length;
                for(let ii = 0; ii < tmp_node_cnt; ii++) {

                    var NODE_recent_stream_stat = NODE_recent_connection_stat[ii].getElementsByTagName('stream_stat');
                    tmp_node_cnt_inner = NODE_recent_stream_stat.length;
                    for(let iii = 0; iii < tmp_node_cnt_inner; iii++) {

                        this.consume_data_tunnel_xml_node(NODE_recent_stream_stat[iii], 'recent_stream_stat_type', 'stream_stat', 'type' , serialize_response, iii);
                        this.consume_data_tunnel_xml_node(NODE_recent_stream_stat[iii], 'recent_stream_stat_connections', 'connections', '', serialize_response, iii);
                        this.consume_data_tunnel_xml_node(NODE_recent_stream_stat[iii], 'recent_stream_stat_connections_capacity', 'connections', 'capacity', serialize_response, iii);
                        this.consume_data_tunnel_xml_node(NODE_recent_stream_stat[iii], 'recent_stream_stat_bandwidth', 'bandwidth', '', serialize_response, iii);
                        this.consume_data_tunnel_xml_node(NODE_recent_stream_stat[iii], 'recent_stream_stat_bandwidth_format', 'bandwidth', 'format', serialize_response, iii);
                        this.consume_data_tunnel_xml_node(NODE_recent_stream_stat[iii], 'recent_stream_stat_bitrate', 'bitrate', '', serialize_response, iii);
                        this.consume_data_tunnel_xml_node(NODE_recent_stream_stat[iii], 'recent_stream_stat_bitrate_format', 'bitrate', 'format', serialize_response, iii);

                    }

                }

            }

            //
            // HISTORICAL STREAM PERFORMANCE
            var NODE_historical_statistics = NODE_performance[0].getElementsByTagName('historical_statistics');
            var tmp_node_cnt_outer = NODE_historical_statistics.length;
            for(let i = 0; i < tmp_node_cnt_outer; i++) {

                var NODE_historical_connection_stat = NODE_historical_statistics[0].getElementsByTagName('connection_stat');
                tmp_node_cnt = NODE_historical_connection_stat.length;
                for(let ii = 0; ii < tmp_node_cnt; ii++) {

                    //
                    // TIMESTAMP
                    this.consume_data_tunnel_xml_node(NODE_historical_connection_stat[ii], 'historical_connection_stat_timestamp', 'connection_stat', 'timestamp' , serialize_response);

                    var NODE_historical_stream_stat = NODE_historical_connection_stat[ii].getElementsByTagName('stream_stat');
                    tmp_node_cnt_inner = NODE_historical_stream_stat.length;
                    for(let iii = 0; iii < tmp_node_cnt_inner; iii++) {

                        this.consume_data_tunnel_xml_node(NODE_historical_stream_stat[iii], 'historical_stream_stat_type', 'stream_stat', 'type' , serialize_response, iii);
                        this.consume_data_tunnel_xml_node(NODE_historical_stream_stat[iii], 'historical_stream_stat_connections', 'connections', '', serialize_response, iii);
                        this.consume_data_tunnel_xml_node(NODE_historical_stream_stat[iii], 'historical_stream_stat_connections_capacity', 'connections', 'capacity', serialize_response, iii);
                        this.consume_data_tunnel_xml_node(NODE_historical_stream_stat[iii], 'historical_stream_stat_bandwidth', 'bandwidth', '', serialize_response, iii);
                        this.consume_data_tunnel_xml_node(NODE_historical_stream_stat[iii], 'historical_stream_stat_bandwidth_format', 'bandwidth', 'format', serialize_response, iii);
                        this.consume_data_tunnel_xml_node(NODE_historical_stream_stat[iii], 'historical_stream_stat_bitrate', 'bitrate', '', serialize_response, iii);
                        this.consume_data_tunnel_xml_node(NODE_historical_stream_stat[iii], 'historical_stream_stat_bitrate_format', 'bitrate', 'format', serialize_response, iii);

                    }

                }

            }

        }

    };

    CRNRSTN_JS.prototype.consume_response_lifestyle_banner_data = function(response_data, serialize_response){

        //
        // BANNER
        var NODE_lifestyle_banner = response_data.getElementsByTagName('banner_img');
        var tmp_node_cnt = NODE_lifestyle_banner.length;

        if(tmp_node_cnt > 0) {

            this.consume_data_tunnel_xml_node(response_data, 'lifestyle_banner_ttl', 'lifestyle_banner', 'ttl' , serialize_response);
            this.consume_data_tunnel_xml_node(response_data, 'lifestyle_banner_ttl_count', 'lifestyle_banner', 'count' , serialize_response);

            for(let i = 0; i < tmp_node_cnt; i++) {

                this.consume_data_tunnel_xml_node(NODE_lifestyle_banner[i], 'banner_img_uri', 'banner_img', 'uri' , serialize_response, i);
                this.consume_data_tunnel_xml_node(NODE_lifestyle_banner[i], 'banner_img_full_scrn_uri', 'banner_img', 'full_scrn_uri' , serialize_response, i);
                this.consume_data_tunnel_xml_node(NODE_lifestyle_banner[i], 'banner_img_filesize', 'filesize', '' , serialize_response, i);
                this.consume_data_tunnel_xml_node(NODE_lifestyle_banner[i], 'banner_img_md5', 'filesize', 'md5' , serialize_response, i);
                this.consume_data_tunnel_xml_node(NODE_lifestyle_banner[i], 'banner_img_sha1', 'filesize', 'sha1' , serialize_response, i);

            }

        }

    };

    CRNRSTN_JS.prototype.consume_data_tunnel_response = function(response_data, data_type, serialize_response = false) {

        switch(data_type){
            case 'XML':

                var NODE_client_response = response_data.getElementsByTagName('client_response');
                if (NODE_client_response.length > 0) {

                    this.log_activity('[lnum 1507] Extracting ' + data_type + ' data from CRNRSTN :: SOAP Services Data Tunnel Layer (SSDTL) response.', this.CRNRSTN_DEBUG_VERBOSE);
                    this.consume_data_tunnel_xml_node(response_data, 'response_timestamp', 'client_response', 'timestamp' , serialize_response);

                    //
                    // RECEIVE NEW SOAP SERVICES DATA TUNNEL LAYER FORM PACKET SITUATION....SITUATION
                    this.consume_data_tunnel_xml_node(response_data, 'ssdtl_packet', 'soap_data_tunnel_layer_fih_packet', '' , serialize_response);

                    //
                    // IF WE HAVE RESPONSE STATUS REPORT DATA
                    var NODE_data_signature = response_data.getElementsByTagName('data_signature');
                    var tmp_node_cnt = NODE_data_signature.length;
                    if (tmp_node_cnt > 0) {

                        for(let i = 0; i < tmp_node_cnt; i++){

                            this.log_activity('Extracting [data_signature] data from CRNRSTN :: SSDTL response.', this.CRNRSTN_DEBUG_CONTROLS);

                            this.consume_data_tunnel_xml_node(NODE_data_signature[i], 'data_signature_request_key', 'request_key', '' , true, i);
                            this.consume_data_tunnel_xml_node(NODE_data_signature[i], 'data_signature_request_checksum', 'request_checksum', '' , true, i);
                            this.consume_data_tunnel_xml_node(NODE_data_signature[i], 'jesus_christ_is_lord_bool', 'jesus_christ_is_lord', '' , true, i);
                            this.consume_data_tunnel_xml_node(NODE_data_signature[i], 'jesus_christ_is_lord_vv', 'jesus_christ_is_lord', 'source' , true, i);
                            this.consume_data_tunnel_xml_node(NODE_data_signature[i], 'satan_is_a_liar_bool', 'satan_is_a_liar', '' , true, i);
                            this.consume_data_tunnel_xml_node(NODE_data_signature[i], 'satan_is_a_liar_vv', 'satan_is_a_liar', 'source' , true, i);

                        }

                    }

                    //
                    // IF WE HAVE BROWSER STATE SYNC DATA
                    var NODE_state_synchronization_data = response_data.getElementsByTagName('state_synchronization_data');
                    if (NODE_state_synchronization_data.length > 0) {

                        this.log_activity('[lnum 1540] Extracting [state_synchronization_data] data from CRNRSTN :: SSDTL response.', this.CRNRSTN_DEBUG_CONTROLS);

                        this.consume_browser_state_sync_data(NODE_state_synchronization_data[0], serialize_response);

                    }

                    //
                    // IF WE HAVE RESPONSE STATUS REPORT DATA
                    var NODE_response_status = response_data.getElementsByTagName('response_status');
                    var tmp_node_cnt = NODE_response_status.length;
                    if (tmp_node_cnt > 0) {

                        for(let i = 0; i < tmp_node_cnt; i++){

                            this.log_activity('[lnum 1554] Extracting [response_status] data from CRNRSTN :: SSDTL response.', this.CRNRSTN_DEBUG_CONTROLS);

                            this.consume_response_status_data(NODE_response_status[i], serialize_response);

                        }

                    }

                    //
                    // CLIENT PROFILE DATA
                    var NODE_client_profile = response_data.getElementsByTagName('client_profile');
                    tmp_node_cnt = NODE_client_profile.length;
                    if (tmp_node_cnt > 0) {

                        for(let i = 0; i < tmp_node_cnt; i++){

                            this.log_activity('[lnum 1570] Extracting [client_profile] data from CRNRSTN :: SSDTL response.', this.CRNRSTN_DEBUG_CONTROLS);

                            this.consume_response_client_profile_data(NODE_client_profile[i], serialize_response);

                        }

                    }

                    //
                    // CRNRSTN :: UI INTERACT DATA
                    var NODE_crnrstn_ui_interact_profile = response_data.getElementsByTagName('crnrstn_ui_interact_profile');
                    tmp_node_cnt = NODE_crnrstn_ui_interact_profile.length;
                    if (tmp_node_cnt > 0) {

                        for(let i = 0; i < tmp_node_cnt; i++){

                            this.log_activity('[lnum 1586] Extracting [crnrstn_ui_interact_profile] data from CRNRSTN :: SSDTL response.', this.CRNRSTN_DEBUG_VERBOSE);

                            this.consume_response_crnrstn_ui_interact_profile_data(NODE_crnrstn_ui_interact_profile[i], serialize_response);

                        }

                    }

                    //
                    // BASSDRIVE DATA
                    var NODE_bassdrive = response_data.getElementsByTagName('bassdrive');
                    tmp_node_cnt = NODE_bassdrive.length;
                    if (tmp_node_cnt > 0) {

                        for(let i = 0; i < tmp_node_cnt; i++){

                            this.log_activity('[lnum 1602] Extracting [bassdrive] data from CRNRSTN :: SSDTL response.', this.CRNRSTN_DEBUG_CONTROLS);

                            this.consume_response_bassdrive_data(NODE_bassdrive[i], serialize_response);

                        }

                    }

                    //
                    // LIFESTYLE IMAGE BANNER DATA
                    var NODE_lifestyle_banner = response_data.getElementsByTagName('lifestyle_banner');
                    tmp_node_cnt = NODE_lifestyle_banner.length;
                    if (tmp_node_cnt > 0) {

                        for(let i = 0; i < tmp_node_cnt; i++){

                            this.log_activity('[lnum 1618] Extracting [lifestyle_banner] data from CRNRSTN :: SSDTL response.', this.CRNRSTN_DEBUG_CONTROLS);

                            this.consume_response_lifestyle_banner_data(NODE_lifestyle_banner[i], serialize_response);

                        }

                    }

                    this.data_tunnel_ttl_monitor_isactive = true;
                    this.log_activity('[lnum 1627] CRNRSTN :: SSDTL response consumption is now complete.', this.CRNRSTN_DEBUG_VERBOSE);
                    this.log_activity('[lnum 1628] CRNRSTN :: SSDTL TTL monitoring for client state is now active.', this.CRNRSTN_DEBUG_VERBOSE);

                    //debugger;

                }

            break;
            case 'SOAP':
                //
                // CRNRSTN :: SOAP SERVICES DATA TUNNEL RAW SOAP RESPONSE TO BROWSER (EXPERIMENTAL)

            break;

        }

    };

    //
    // CRNRSTN_JS.prototype.update_dom_state_controller_ttl = function(thread_id_index) {
    //
    //     //
    //     // MODIFY FORM HIDDEN INPUT TO ACKNOWLEDGE EXPIRED TTL
    //
    //     /*
    //     CRNRSTN :: UI SOAP SERVICES DATA TUNNEL MODULE OUTPUT
    //     $tmp_str_array[] = '
    //     <div id="crnrstn_soap_data_tunnel_form_shell" class="hidden">
    //     <form action="' . $this->crnrstn_resources_http_path.'soa/tunnel/" method="post" id="crnrstn_soap_data_tunnel_frm" name="crnrstn_soap_data_tunnel_frm" enctype="multipart/form-data">
    //         <textarea id="crnrstn_soap_srvc_data" name="crnrstn_soap_srvc_data" cols="130" rows="5">SOAP_DATA_TUNNEL_LAYER_PACKET</textarea>
    //         <button type="submit">SUBMIT</button>
    //         <input type="hidden" id="crnrstn_request_serialization_key" name="crnrstn_request_serialization_key" value="">
    //         <input type="hidden" id="crnrstn_request_serialization_checksum" name="crnrstn_request_serialization_checksum" value="">
    //         <input type="hidden" id="crnrstn_ttl_expired_ui_threads" name="crnrstn_ttl_expired_ui_threads" value="">
    //         ' . $this->oCRNRSTN_USR->ui_content_module_out(CRNRSTN_UI_FORM_INTEGRATION_PACKET, 'crnrstn_soap_data_tunnel_form').'
    //
    //     </form>
    //     </div>';
    //     */
    //
    //     //
    //     // CHECK FOR EXISTENCE OF TTL TO BE EXPIRED
    //     var tmp_ttl_expired_input_val_ARRAY = $('#crnrstn_ttl_expired_ui_threads').val().split('|');
    //     var input_val_str = '';
    //
    //     if($.inArray(thread_id_index, tmp_ttl_expired_input_val_ARRAY) >= 0){
    //
    //         //
    //         // NOTHING TO DO, WE ALREADY HAVE THE TTL RECORDED
    //
    //     }else{
    //
    //         var clean_thread_id_index = this.remove_trailing_underscored_index(thread_id_index);
    //         //debugger;
    //
    //         //
    //         // ADD NEW THREAD TTL TO SSDTL REQUEST
    //         tmp_ttl_expired_count = tmp_ttl_expired_input_val_ARRAY.length;
    //         for(let i = 0; i < tmp_ttl_expired_count; i++){
    //
    //             if(tmp_ttl_expired_input_val_ARRAY[i] !== ''){
    //
    //                 input_val_str += tmp_ttl_expired_input_val_ARRAY[i] + '|';
    //
    //             }
    //
    //         }
    //
    //         input_val_str += clean_thread_id_index + '|';
    //
    //         this.log_activity('The CRNRSTN :: SOAP SERVICES data tunnel layer has received a new TTL expired thread [' + clean_thread_id_index + '].', this.CRNRSTN_DEBUG_CONTROLS);
    //
    //         $('#crnrstn_ttl_expired_ui_threads').val(input_val_str);
    //
    //     }
    //
    // }

    CRNRSTN_JS.prototype.remove_trailing_underscored_index = function(str) {

        //
        // I'M NOT DOING THIS WORK IN THE CLOUD.
        // xxxx_xxxx_xxx_0  <- REMOVE TRAILING INDEX FOR CLEAN SERVER PROCESSING.
        var clean_index_str = '';
        var tmp_clean_input_str_ARRAY = [];
        var tmp_str_ARRAY = str.split('_');
        var tmp_array_len = tmp_str_ARRAY.length;
        tmp_array_len--;
        for(let i = 0; i < tmp_array_len; i++){

            tmp_clean_input_str_ARRAY.push(tmp_str_ARRAY[i]);

        }

        tmp_array_len = tmp_clean_input_str_ARRAY.length;

        for(let i = 0; i < tmp_array_len; i++){

            if(clean_index_str === ''){

                clean_index_str = tmp_clean_input_str_ARRAY[i];

            }else{

                clean_index_str = clean_index_str + '_' + tmp_clean_input_str_ARRAY[i];

            }

        }

        return clean_index_str;

    };

    CRNRSTN_JS.prototype.array_adjust_ttl_value = function(thread_id_index) {

        //
        // WHERE thread_id_index = 'xml_node_name' + '_' + array_increment
        tmp_xml_node_nomination = this.ttl_array_pointer_index_root_ARRAY[thread_id_index];
        tmp_ttl_secs = this.return_data_tunnel_xml_data(tmp_xml_node_nomination);

        switch(tmp_xml_node_nomination){
            case 'lifestyle_banner_ttl':

                //
                // CURRENTLY, ONLY ONE USE CASE TO SUPPORT (GLOBAL/MACRO TTL AT TOP NODE).
                // THIS MAY CHANGE...WITH THE ADDITION OF MICRO-TTL'D REPORTING META ARRAY....E.G.
                if(!(tmp_xml_node_nomination in this.data_array_adjusted_ttl_ARRAY)){

                    tmp_count = this.return_data_tunnel_xml_data(tmp_xml_node_nomination + '_count');

                    //
                    // RULE OF THUMB IS TO EXPIRE TTL LEAVING A MINIMUM OF 15 SECONDS TO PROCESS RESPONSE FROM
                    // SERVER. SO, 10 IMAGES WITH 7 SEC TTL...HAS 55 SECS BEFORE TTL EXPIRE.
                    var tmp_ttl_buffer_secs = ((tmp_count * 1) * tmp_ttl_secs) - 15;

                    this.data_array_adjusted_ttl_ARRAY[tmp_xml_node_nomination] = tmp_ttl_buffer_secs;

                }else{

                    tmp_ttl_buffer_secs = this.data_array_adjusted_ttl_ARRAY[tmp_xml_node_nomination];

                    if(tmp_ttl_buffer_secs > -1){

                        tmp_ttl_buffer_secs--;
                        this.data_array_adjusted_ttl_ARRAY[tmp_xml_node_nomination] = tmp_ttl_buffer_secs;

                    }else{

                        tmp_count = this.return_data_tunnel_xml_data(tmp_xml_node_nomination + '_count');
                        var tmp_ttl_buffer_secs = ((tmp_count * 1) * tmp_ttl_secs) - 15;

                        this.data_array_adjusted_ttl_ARRAY[tmp_xml_node_nomination] = tmp_ttl_buffer_secs;

                    }

                }

                return tmp_ttl_buffer_secs;

            break;
            default:

                return tmp_ttl_secs;

            break;

        }

    };

    CRNRSTN_JS.prototype.thread_id_ttl_expired = function() {

        var tmp_ttl_expired = false;
        var tmp_array_adjusted_ttl = 0;

        //
        // BASED OFF TTL DATA FROM CONSUMED XML RESPONSE DOCUMENT
        tmp_ttl_cnt = this.ttl_array_pointer_index_ARRAY.length;
        for(let i = 0; i < tmp_ttl_cnt; i++){

            //tmp_array_adjusted_ttl = this.array_adjust_ttl_value(this.ttl_array_pointer_index_ARRAY[i], this.ssdtl_response_data_index_tracker_ARRAY[this.ttl_array_pointer_index_ARRAY[i]]);
            tmp_array_adjusted_ttl = this.array_adjust_ttl_value(this.ttl_array_pointer_index_ARRAY[i]);

            if((tmp_array_adjusted_ttl < this.ttl_age_seconds) && (tmp_array_adjusted_ttl > 0)){

                //
                // TTL IS EXPIRED. ADD TO CLIENT SYNC REQUEST.
                //this.update_dom_state_controller_ttl(this.ttl_array_pointer_index_ARRAY[i]);

                tmp_ttl_expired = true;

                this.log_activity('[lnum 1819] TTL for a data tunneled thread [' + this.ttl_array_pointer_index_ARRAY[i] + '] has been expired at ' + this.ttl_age_seconds + ' seconds, where the threshold is ' + tmp_array_adjusted_ttl + ' secs.', this.CRNRSTN_DEBUG_BASIC);

            }

        }

        return tmp_ttl_expired;

    };

    CRNRSTN_JS.prototype.return_count_response_data = function(nomination) {

        //
        // COUNT FOR LOOP CONTROL OF XML ARRAY DATA
        return this.ssdtl_response_data_index_tracker_ARRAY[nomination]

    };

    CRNRSTN_JS.prototype.update_thread_count = function(thread_id, delta, scheduler_invoked) {

        if(!scheduler_invoked){

            tmp_cnt = this.transaction_thread_count_ARRAY[thread_id];
            tmp_cnt = tmp_cnt + (delta);
            this.transaction_thread_count_ARRAY[thread_id] = tmp_cnt;

            this.log_activity('[lnum 1845] UI sync controller transaction thread count updated to ' + tmp_cnt + ' with the initialization of [' + thread_id + '].', this.CRNRSTN_DEBUG_CONTROLS);

        }

    };

    CRNRSTN_JS.prototype.update_transaction_count = function() {

        this.transaction_count_ARRAY.push(this.current_serialization_key);
        this.transaction_ARRAY.push(this.current_serialization_key);

        if(this.transaction_count_ARRAY.length > 1){

            tmp_str = 'have';

        }else{

            tmp_str = 'has';

        }

        this.log_activity('1 out of ' + this.transaction_count_ARRAY.length + ' UI state sync transactions (serialization key=[' + this.current_serialization_key + ']) ' + tmp_str + ' been started.', this.CRNRSTN_DEBUG_BASIC);

    };

    CRNRSTN_JS.prototype.active_thread_count = function(tmp_thread_id = null) {

        if(tmp_thread_id == null){

            //
            // TOTAL THREAD COUNT
            var tmp_thread_cnt = this.transaction_thread_id_key_ARRAY.length;
            for(let i = 0; i < tmp_thread_cnt; i++){

                tmp_thread_id = this.transaction_thread_id_key_ARRAY[i];
                tmp_cnt += this.transaction_thread_count_ARRAY[tmp_thread_id];

            }

        }else{

            //
            // THREAD COUNT OF ID
            if(tmp_thread_id in this.transaction_thread_count_ARRAY){

                tmp_cnt = this.transaction_thread_count_ARRAY[tmp_thread_id];

            }else{

                //
                // ERR IN SILENCE
                tmp_cnt = 0;

            }

        }

        return tmp_cnt;

    };

    CRNRSTN_JS.prototype.active_transaction_count = function() {

        return this.transaction_count_ARRAY[this.current_serialization_key];

    };

    CRNRSTN_JS.prototype.initialize_transaction_serialization = function(serial = null){

        var request_serial = '';

        if(serial == null){

            request_serial = this.generate_new_key();

        }else{

            if(serial.length < 1){

                request_serial = this.generate_new_key();

            }else{

                request_serial = serial;

            }

        }

        this.current_serialization_key = request_serial;
        this.current_serialization_checksum = this.return_hash(request_serial);

        $('#' + this.form_input_serialization_key).val(this.current_serialization_key);
        $('#' + this.form_input_serialization_checksum).val(this.current_serialization_checksum);


        $('#' + this.form_input_serialization_checksum).val(this.current_serialization_checksum);

        /*
        <input type="hidden" id="crnrstn_ui_interact_canvas_checksum" name="crnrstn_ui_interact_canvas_checksum" value="">
            <input type="hidden" id="crnrstn_ui_interact_mini_canvas_checksum" name="crnrstn_ui_interact_mini_canvas_checksum" value="">
            <input type="hidden" id="crnrstn_ui_interact_signin_canvas_checksum" name="crnrstn_ui_interact_signin_canvas_checksum" value="">
            <input type="hidden" id="crnrstn_ui_interact_main_canvas_checksum" name="crnrstn_ui_interact_main_canvas_checksum" value="">
            <input type="hidden" id="crnrstn_ui_interact_eula_canvas_checksum" name="crnrstn_ui_interact_eula_canvas_checksum" value="">
            <input type="hidden" id="crnrstn_ui_interact_mit_license_canvas_checksum" name="crnrstn_ui_interact_mit_license_canvas_checksum" value="">

        * */


    };

    CRNRSTN_JS.prototype.authorize_transaction = function(request_key, request_checksum, max_concurrent = 1, redundancy_ok = false, expire_checksum_hold_ttl = null) {

        tmp_transaction_is_authorized = true;
        tmp_active_count = this.active_transaction_count();

        if(redundancy_ok){

            if(tmp_active_count >= max_concurrent){

                tmp_transaction_is_authorized = false;

            }

        }else{

            var tmp_checksum = this.return_hash(request_key);
            if((this.current_serialization_key == request_key) && (this.current_serialization_checksum == request_checksum) && (tmp_checksum == request_checksum)){

                if(tmp_active_count >= max_concurrent){

                    tmp_transaction_is_authorized = false;

                }

            }else{

                tmp_transaction_is_authorized = false;

            }

        }

        if(tmp_transaction_is_authorized){

            this.active_transaction_checksum = this.form_input_serialization_checksum;

        }

        return tmp_transaction_is_authorized;

    };

    CRNRSTN_JS.prototype.crnrstn_ui_interact_canvas_theme_sync = function(){
        /*
        <canvas
        z_index="60"
        window_edge_padding="20"
        outline_border_edge_line_width="2"
        outline_border_edge_line_style="solid"
        outline_border_edge_line_color="#767676"
        border_width="10"
        border_color="#FFF"
        border_opacity="0.3"
        background_color="#FFF"
        background_opacity="1"
        inner_content_edge_padding="25"
        checksum="1618734614">
        </canvas>

        this.containerPadding = {
            top: parseInt(this.$container.css('padding-top'), 10),
            right: parseInt(this.$container.css('padding-right'), 10),
            bottom: parseInt(this.$container.css('padding-bottom'), 10),
            left: parseInt(this.$container.css('padding-left'), 10)
        };

        this.imageBorderWidth = {
            top: parseInt(this.$image.css('border-top-width'), 10),
            right: parseInt(this.$image.css('border-right-width'), 10),
            bottom: parseInt(this.$image.css('border-bottom-width'), 10),
            left: parseInt(this.$image.css('border-left-width'), 10)
        */

        tmp_canvas_z_index = this.return_data_tunnel_xml_data('canvas_z_index');
        this.baseline_z_index = tmp_canvas_z_index;
        tmp_canvas_window_edge_padding = this.return_data_tunnel_xml_data('canvas_window_edge_padding');

        tmp_canvas_outline_border_edge_line_width = this.return_data_tunnel_xml_data('canvas_outline_border_edge_line_width');
        tmp_canvas_outline_border_edge_line_style = this.return_data_tunnel_xml_data('canvas_outline_border_edge_line_style');
        tmp_canvas_outline_border_edge_line_color = this.return_data_tunnel_xml_data('canvas_outline_border_edge_line_color');

        tmp_canvas_border_width = this.return_data_tunnel_xml_data('canvas_border_width');
        tmp_canvas_border_color = this.return_data_tunnel_xml_data('canvas_border_color');
        tmp_canvas_border_opacity = this.return_data_tunnel_xml_data('canvas_border_opacity');

        tmp_canvas_background_color = this.return_data_tunnel_xml_data('canvas_background_color');
        tmp_canvas_background_opacity = this.return_data_tunnel_xml_data('canvas_background_opacity');

        tmp_canvas_inner_content_edge_padding = this.return_data_tunnel_xml_data('canvas_inner_content_edge_padding');

        tmp_canvas_checksum = this.return_data_tunnel_xml_data('canvas_checksum');

        //
        // PRIMARY NAVIGATION DISPLAY CASE Z-INDEX INIT
        tmp_tgt_z = parseInt(this.baseline_z_index) + 10;
        $('#crnrstn_ui_interact_primary_nav_img_shell_menu_glass_case').css('zIndex', parseInt(tmp_tgt_z));
        $('#crnrstn_ui_interact_primary_nav_img_shell_close_x_glass_case').css('zIndex', parseInt(tmp_tgt_z));
        $('#crnrstn_ui_interact_primary_nav_img_shell_fs_expand_glass_case').css('zIndex', parseInt(tmp_tgt_z));
        $('#crnrstn_ui_interact_primary_nav_img_shell_minimize_glass_case').css('zIndex', parseInt(tmp_tgt_z));

        $('#crnrstn_ui_interact_wrapper').css('zIndex', parseInt(this.baseline_z_index));

        $('#crnrstn_ui_interact_wrapper').css('padding-top', parseInt(tmp_canvas_window_edge_padding));
        $('#crnrstn_ui_interact_wrapper').css('padding-right', parseInt(tmp_canvas_window_edge_padding));
        $('#crnrstn_ui_interact_wrapper').css('padding-bottom', parseInt(tmp_canvas_window_edge_padding));
        $('#crnrstn_ui_interact_wrapper').css('padding-left', parseInt(tmp_canvas_window_edge_padding));

        // border: 2px solid #767676;
        $('#crnrstn_ui_interact_bg_border').css('border-top-width', parseInt(tmp_canvas_outline_border_edge_line_width));
        $('#crnrstn_ui_interact_bg_border').css('border-right-width', parseInt(tmp_canvas_outline_border_edge_line_width));
        $('#crnrstn_ui_interact_bg_border').css('border-bottom-width', parseInt(tmp_canvas_outline_border_edge_line_width));
        $('#crnrstn_ui_interact_bg_border').css('border-left-width', parseInt(tmp_canvas_outline_border_edge_line_width));
        $('#crnrstn_ui_interact_bg_border').css('borderStyle', tmp_canvas_outline_border_edge_line_style);
        $('#crnrstn_ui_interact_bg_border').css('borderColor', tmp_canvas_outline_border_edge_line_color);
        $('#crnrstn_ui_interact_bg_border').css('opacity', tmp_canvas_border_opacity);
        $('#crnrstn_ui_interact_bg_border').css('backgroundColor', tmp_canvas_border_color);

        //crnrstn_ui_interact_bg_border_edge
        $('#crnrstn_ui_interact_bg_border_edge').css('border-top-width', parseInt('1'));
        $('#crnrstn_ui_interact_bg_border_edge').css('border-right-width', parseInt('1'));
        $('#crnrstn_ui_interact_bg_border_edge').css('border-bottom-width', parseInt('1'));
        $('#crnrstn_ui_interact_bg_border_edge').css('border-left-width', parseInt('1'));
        $('#crnrstn_ui_interact_bg_border_edge').css('borderStyle', 'solid');
        $('#crnrstn_ui_interact_bg_border_edge').css('borderColor', '#FFF');
        $('#crnrstn_ui_interact_bg_border_edge').css('opacity', '0.5');
        $('#crnrstn_ui_interact_bg_border_edge').css('backgroundColor', 'transparent');

        $('#crnrstn_ui_interact_bg_solid').css('backgroundColor', tmp_canvas_background_color);
        $('#crnrstn_ui_interact_bg_solid').css('width', 80);
        $('#crnrstn_ui_interact_bg_solid').css('height', 50);

        //$('#crnrstn_ui_interact_bg_solid').css('opacity', tmp_canvas_background_opacity);
        //$('#crnrstn_ui_interact_bg_solid').css('margin-top', parseInt(tmp_canvas_border_width) - parseInt(tmp_canvas_outline_border_edge_line_width));
        //$('#crnrstn_ui_interact_bg_solid').css('margin-left', parseInt(tmp_canvas_border_width) - parseInt(tmp_canvas_outline_border_edge_line_width));
        //$('#crnrstn_ui_interact_bg_solid').css('margin-left', parseInt(10));

        $('#crnrstn_ui_interact_content_wrapper').css('padding-top', parseInt(tmp_canvas_inner_content_edge_padding));
        $('#crnrstn_ui_interact_content_wrapper').css('padding-left', parseInt(tmp_canvas_inner_content_edge_padding));

        this.canvas_border_calibrate($('#crnrstn_ui_interact_wrapper'), $('#crnrstn_ui_interact_bg_border'), $('#crnrstn_ui_interact_bg_solid'), $('#crnrstn_ui_interact_bg_border_edge'), tmp_canvas_border_width);

        /*
        XML
        <crnrstn_ui_interact_profile>
            <is_enabled>true</is_enabled>
            <is_visible>true</is_visible>
            <theme_configuration>
                <canvas z_index="60" window_edge_padding="20" outline_border_edge_line_width="2" outline_border_edge_line_style="solid" outline_border_edge_line_color="#767676" border_width="10" border_color="#FFF" border_opacity="0.3" background_color="#FFF" background_opacity="1" inner_content_edge_padding="25" checksum="1618734614"></canvas>

                <mini_canvas left="84%" width="100" height="70" checksum="956164994"></mini_canvas>
                <signin_canvas width="260" height="305" checksum="2313296795"></signin_canvas>
                <main_canvas width="1080" height="760" checksum="2023304991"></main_canvas>
                <eula_canvas width="700" height="400" checksum="592092546"></eula_canvas>
                <mit_license_canvas width="500" height="400" checksum="1854028937"></mit_license_canvas>

            </theme_configuration>
        </crnrstn_ui_interact_profile>

        CSS
        .crnrstn_ui_interact_wrapper                    { position:-webkit-sticky; position: sticky; bottom:5px; z-index: 60; width: 100px; left: 84%; height: 70px; padding: 0 0 20px 0; left:-3000px; width:0; height: 0; overflow: hidden;}
        .crnrstn_ui_interact                            { }
        .crnrstn_ui_interact_bg_border                  { position: absolute; width:100px; height: 70px; border: 2px solid #767676; background-color: #FFF; opacity: 0.3; }
        .crnrstn_ui_interact_bg_solid                   { position: absolute; width: 85px; height:46px; background-color: #FFF; opacity: 1; margin: 8px; padding: 11px 0 0 2px; cursor:pointer; }

        .crnrstn_ui_interact_content_wrapper         { position: absolute; display: none; z-index: 61; padding: 25px 0 0 25px; }
        .crnrstn_ui_interact_content_wrapper input   { text-align: left; font-size: 20px; width: 208px; height: 34px; border:2px solid #676767; background-color: #FFF;}
        .crnrstn_ui_interact_signin_frm_lbl             { text-align: left; font-size: 20px;}
        .crnrstn_ui_interact_signin_frm_chkbx_eula      { float: left; width: 16px;}
        .crnrstn_ui_interact_signin_frm_lbl_eula        { float: left; width: 80px; font-size: 18px; padding:7px 0 0 0; cursor: pointer;}
        .crnrstn_ui_interact_signin_frm_lbl_eula a      { text-decoration: none; color: #0066CC; text-decoration: underline;}
        .crnrstn_ui_interact_frm_submit                 { width: 115px; height: 37px; background-color: #FFF; border: 2px solid #5C98EB; cursor:pointer; }
        .crnrstn_ui_interact_signin_frm_btn_submit      { text-align: left; font-size: 20px; color: #5C98EB; font-weight: bold; padding: 7px 0 0 17px; cursor:pointer;}

        HTML
        <div id="crnrstn_ui_interact_wrapper" class="crnrstn_ui_interact_wrapper">
            <div class="crnrstn_ui_interact">
                <div id="crnrstn_ui_interact_bg_border" class="crnrstn_ui_interact_bg_border"></div>
                <div id="crnrstn_ui_interact_bg_solid" class="crnrstn_ui_interact_bg_solid" onclick="oCRNRSTN_JS.sign_in_transition_via_micro_expansion();">
                    ' . $this->return_creative('MESSAGE_CONVERSATION_BUBBLE_MICRO_THUMB_BLUE00', CRNRSTN_UI_IMG_BASE64_HTML_WRAPPED) . '
                    <div class="crnrstn_cb"></div>
                </div>
                <div id="crnrstn_ui_interact_content_wrapper" class="crnrstn_ui_interact_content_wrapper">
                    <div id="crnrstn_ui_interact_signin_frm_username" class="crnrstn_ui_interact_signin_frm_lbl">' . $this->get_lang_copy('FORM_LABEL_USERNAME') . '</div>
                    <div class="crnrstn_cb_5"></div>
                    <input type="text" name="username" value="">
                    <div class="crnrstn_cb_15"></div>
                    <div id="crnrstn_ui_interact_signin_frm_password" class="crnrstn_ui_interact_signin_frm_lbl">' . $this->get_lang_copy('FORM_LABEL_PASSWORD_OPTIONAL') . '</div>
                    <div class="crnrstn_cb_5"></div>
                    <input type="password" name="password" value="">
                    <div class="crnrstn_cb_10"></div>

                    <div class="crnrstn_ui_interact_signin_frm_chkbx_eula"><input type="checkbox" style="width: 20px;" name="crnrstn_signin_chkbx_eula_accept" value="eula_i_agree"></div>
                    <div class="crnrstn_ui_interact_signin_frm_lbl_eula"><a href="#">EULA</a></div>

                    <div class="crnrstn_cb_10"></div>

                    <div class="crnrstn_ui_interact_frm_submit" onclick="oCRNRSTN_JS.sign_in_form_submit_via_micro_expansion();">
                        <div id="crnrstn_ui_interact_signin_frm_btn_submit" class="crnrstn_ui_interact_signin_frm_btn_submit">' . $this->get_lang_copy('FORM_BUTTON_TEXT_CONNECT') . '</div>
                    </div>
                </div>
            </div>
        </div>
        */

    };

    CRNRSTN_JS.prototype.canvas_border_calibrate = function(elem_wrap, elem_bg, elem_bg_solid, elem_bg_edge, border_width) {

        tmp_left = this.return_data_tunnel_xml_data(this.crnrstn_ui_interact_mode + '_left');
        tmp_width = this.return_data_tunnel_xml_data(this.crnrstn_ui_interact_mode + '_width');
        tmp_height = this.return_data_tunnel_xml_data(this.crnrstn_ui_interact_mode + '_height');

        tmp_target_net_border_width = parseInt(border_width) * 2;
        tmp_target_delta_border_width = parseInt(border_width) / 2;

        tmp_inner_width = tmp_width - tmp_target_net_border_width;
        tmp_inner_height = tmp_height - tmp_target_net_border_width;

        //
        // SYNC TO WIDTH AND HEIGHT
        elem_wrap.css('left', tmp_left);
        elem_wrap.css('width', parseInt(tmp_width));
        elem_wrap.css('height', parseInt(tmp_height));

        elem_bg.css('width', parseInt(tmp_width));
        elem_bg.css('height', parseInt(tmp_height));

        elem_bg_edge.css('width', parseInt(tmp_width));
        elem_bg_edge.css('height', parseInt(tmp_height));
        elem_bg_edge.css('margin-top', parseInt(1));
        elem_bg_edge.css('margin-left', parseInt(1));

        //elem_bg_solid.css('width', parseInt(tmp_inner_width));
        //elem_bg_solid.css('height', parseInt(tmp_inner_height));
        elem_bg_solid.css('width', parseInt(78));
        elem_bg_solid.css('height', parseInt(45));

        elem_bg_solid.css('padding-top', parseInt(tmp_target_delta_border_width + 2));
        //elem_bg_solid.css('padding-left', parseInt(tmp_target_delta_border_width + 2));
        elem_bg_solid.css('padding-left', parseInt(tmp_target_delta_border_width + 2));

        elem_wrap.css('opacity', 0);

    };

    CRNRSTN_JS.prototype.crnrstn_ui_interact_canvas_mode_sync = function() {

        this.crnrstn_ui_interact_is_visible(this.return_data_tunnel_xml_data('crnrstn_ui_interact_is_visible'));

    };

    CRNRSTN_JS.prototype.crnrstn_ui_interact_is_visible = function(is_visible) {

        switch(is_visible){
            case 'true':

                // show
                this.crnrstn_ui_interact_is_visible_show();

            break;
            default:

                //false
                //this.crnrstn_ui_interact_is_visible_hide();

            break;
        }

    };

    CRNRSTN_JS.prototype.crnrstn_ui_interact_is_visible_show = function() {

        //tmp_bounce_max_width = 0;
        //tmp_bounce_max_height = 0;

        $( "#crnrstn_ui_interact_wrapper").animate({
            opacity: 1.0
        }, {
            duration: 250,
            queue: false,
            specialEasing: {
                opacity: "swing"
            },
            step: function( now, fx ) {

            },
            complete: function () {

            }
        });

    };

    CRNRSTN_JS.prototype.crnrstn_ui_hide_ssdtla_debug = function() {

        //tmp_bounce_max_width = 0;
        //tmp_bounce_max_height = 0;

        $( "#crnrstn_activity_log").animate({
            opacity: 0,
            height: 0
        }, {
            duration: 1500,
            queue: false,
            specialEasing: {
                opacity: "swing"
            },
            step: function( now, fx ) {

            },
            complete: function () {

                //$('#crnrstn_activity_log_output_wrapper').html('');

                $( "#crnrstn_activity_log_output_wrapper").animate({
                    height: 0
                }, {
                    duration: 500,
                    queue: false,
                    specialEasing: {
                        opacity: "swing"
                    },
                    step: function( now, fx ) {

                    },
                    complete: function () {

                    }
                });
            }
        });

        $( "#crnrstn_activity_log_output_title").animate({
            opacity: 0,
            height: 0
        }, {
            duration: 1000,
            queue: false,
            specialEasing: {
                opacity: "swing"
            },
            step: function( now, fx ) {

            },
            complete: function () {

                $('#crnrstn_activity_log_output_lnk_wrapper').html('');

            }
        });

    };

    CRNRSTN_JS.prototype.execute_ui_sync = function(ui_thread_id){

        switch(ui_thread_id){
            case 'crnrstn_ui_interact':

                //
                // SYNC CANVAS THEME
                this.crnrstn_ui_interact_canvas_theme_sync();

                //
                // SYNC UI MODE
                this.crnrstn_ui_interact_canvas_mode_sync();

            break;
            case 'bassdrive_title':

                tmp_title_html = this.return_data_tunnel_xml_data('bassdrive_title_html');
                tmp_title_html = tmp_title_html.trim();
                if(tmp_title_html.length > 0){

                    this.transitions_ui_content_update('stream_info', tmp_title_html, 'blind');

                }

            break;
            case 'bassdrive_locale_colors':

                tmp_locale_colors = this.return_data_tunnel_xml_data('bassdrive_locale_html');
                tmp_locale_colors = tmp_locale_colors.trim();
                if(tmp_locale_colors.length > 0) {

                    this.transitions_ui_content_update('broadcast_nation', tmp_locale_colors);

                }

            break;
            case 'bassdrive_social':

                tmp_social_html = this.return_data_tunnel_xml_data('bassdrive_social_html');
                tmp_social_html = tmp_social_html.trim();
                if(tmp_social_html.length > 0) {

                    this.transitions_ui_content_update('stream_social', tmp_social_html, 'blind');

                }

            break;
            case 'bassdrive_connection_stats':

                tmp_stat_connections = this.return_data_tunnel_xml_data('current_stream_stat_connections');
                tmp_stat_connections_capacity = this.return_data_tunnel_xml_data('current_stream_stat_connections_capacity');
                tmp_stat_bandwidth = this.return_data_tunnel_xml_data('current_stream_stat_bandwidth');
                tmp_stat_bandwidth_format = this.return_data_tunnel_xml_data('current_stream_stat_bandwidth_format');

                tmp_stat_connections = tmp_stat_connections.trim();
                tmp_stat_connections_capacity = tmp_stat_connections_capacity.trim();
                tmp_stat_bandwidth = tmp_stat_bandwidth.trim();
                tmp_stat_bandwidth_format = tmp_stat_bandwidth_format.trim();

                tmp_stat_bandwidth_format = this.short_format_data_size(tmp_stat_bandwidth_format);
                tmp_stat_connections = this.pretty_format_number(tmp_stat_connections);
                tmp_stat_connections_capacity = this.pretty_format_number(tmp_stat_connections_capacity);

                if($('#crnrstn_curr_total_connections').html() != tmp_stat_connections && tmp_stat_connections.length > 0){

                    this.transitions_ui_content_update('crnrstn_curr_total_connections', tmp_stat_connections, 'blind');

                }

                if($('#crnrstn_curr_total_capacity').html() != tmp_stat_connections_capacity && tmp_stat_connections_capacity.length > 0){

                    this.transitions_ui_content_update('crnrstn_curr_total_capacity', tmp_stat_connections_capacity, 'blind');

                }

                if($('#crnrstn_curr_total_bandwidth').html() != tmp_stat_bandwidth && tmp_stat_bandwidth.length > 0){

                    this.transitions_ui_content_update('crnrstn_curr_total_bandwidth', tmp_stat_bandwidth, 'blind');

                }

                if($('#crnrstn_curr_total_bandwidth_format').html() != tmp_stat_bandwidth_format && tmp_stat_bandwidth_format.length > 0){

                    this.transitions_ui_content_update('crnrstn_curr_total_bandwidth_format', tmp_stat_bandwidth_format, 'blind');

                }

            break;
            case 'bassdrive_the_situation':

                tmp_count = this.return_count_response_data('the_situation_with_bassdrive_likely_status');

                rand_index = Math.floor(Math.random() * tmp_count);

                tmp_bassdrive_situation = this.return_data_tunnel_xml_data('the_situation_with_bassdrive_likely_status', rand_index);

                tmp_bassdrive_situation = tmp_bassdrive_situation.trim();
                if(tmp_bassdrive_situation.length > 0) {

                    this.transitions_ui_content_update('crnrstn_bassdrive_situation', tmp_bassdrive_situation, 'blind');

                }

            break;
            case 'lifestyle_banner_image_rotation':

                if(this.jony5_banner_mode == 'PLAY'){

                    this.log_activity('[lnum 2357] FIRE! FIRE! FIRE! [' + ui_thread_id + ']. ', this.CRNRSTN_DEBUG_LIFESTYLE_BANNER);

                    this.rotate_lifestyle_banner_image();

                }

            break;
            default:

                this.log_activity('[lnum 2366] UI sync instructions have not been configured for [' + ui_thread_id + '].', this.CRNRSTN_DEBUG_CONTROLS);

            break;

        }

    };

    CRNRSTN_JS.prototype.execution_delay_ui_sync_controller = function(action_init, action_id, delay_ttl = 0, scheduler_invoked = false){

        switch(action_init){
            case 'fire':

                this.update_thread_count(action_id, 1, scheduler_invoked);

                this.log_activity('[lnum 2381] UI sync controller set to fire [' + action_id + '].', this.CRNRSTN_DEBUG_CONTROLS);

                //
                // FIRE UI UPDATE THREAD
                this.execute_ui_sync(action_id);

                this.ui_sync_controller_thread_delay_ARRAY[action_id] = -1;

            break;
            case 'schedule':

                this.ui_sync_controller_thread_delay_ARRAY[action_id] = delay_ttl;

                this.log_activity('[lnum 2394] UI sync controller has scheduled [' + action_id + '] to fire in ' + delay_ttl + ' seconds.', this.CRNRSTN_DEBUG_UI);

            break;
            case 'stop':

                this.ui_sync_controller_thread_delay_ARRAY[action_id] = -1;

            break;
            case 'cancel':

                this.log_activity('[lnum 2404] UI sync controller has cancelled [' + action_id + '].', this.CRNRSTN_DEBUG_CONTROLS);

            break;
            case 'sleep':

                this.log_activity('[lnum 2409] UI sync controller has put [' + action_id + '] to sleep.', this.CRNRSTN_DEBUG_CONTROLS);

            break;
            case 'silence_is_golden':

                //this.update_thread_count(action_id, 1, scheduler_invoked);
                this.log_activity('[lnum 2415] UI sync controller has scheduled [' + action_id + '] to run silently in ' + delay_ttl + ' seconds.', this.CRNRSTN_DEBUG_CONTROLS);

            break;

        }

    };

    CRNRSTN_JS.prototype.initialize_jony5_lifestyle_banner_controller = function() {

        var self = this;

        //
        // SOURCE :: https://stackoverflow.com/questions/4735342/jquery-to-loop-through-elements-with-the-same-class
        // AUTHOR :: Kees C. Bakker :: https://stackoverflow.com/users/201482/kees-c-bakker
        $('.jony5_lifestyle_image').each(function(i, obj) {

            //self.log_activity(' ADDING LIFESTYLE BANNER IMAGE[' + i + '] TO ARRAY CONSTRUCT :: ' + obj.innerHTML);
            var image_uri = $('#crnrstn_request_ajax_root').val() + $('#jony5_lifestyle_image_path').html() + obj.innerHTML;

            if(!(image_uri in self.jony5_lifestyle_banner_index_ARRAY)){

                var tmp_str = self.extract_filename(image_uri);
                self.log_activity('[lnum 2438] STORING STATIC BANNER DOM DATA [' + tmp_str + '].', self.CRNRSTN_DEBUG_LIFESTYLE_BANNER);

                self.jony5_lifestyle_banner_index_ARRAY[image_uri] = 1;
                self.jony5_lifestyle_banner_images_ARRAY.push(image_uri);

            }

        });

        //
        // ACCOUNT FOR STATIC IMAGE IN HTML LOADED BY DOM FOR BACK BUTTON ACCESS TO START
        var tmp_index = 0;
        var tmp_next_image = this.jony5_lifestyle_banner_images_ARRAY[tmp_index];
        this.jony5_lifestyle_banner_sequence_control_ARRAY.push(tmp_index);
        this.jony5_lifestyle_banner_img_int_sequence_alpha.push(tmp_index);

        this.jony5_lifestyle_banner_sequence_position++;

        var tmp_str = this.extract_filename(tmp_next_image);
        var tmp_zindex_alpha = $("#jony5_banner_lifestyle_alpha").css('zIndex');
        this.log_activity('[lnum 2458] STATIC DOM LOAD [' + tmp_str + '] INTO ALPHA, where Z=' + tmp_zindex_alpha + ' OPACITY=' + $('#jony5_banner_lifestyle_alpha').css('opacity') + '.', self.CRNRSTN_DEBUG_LIFESTYLE_BANNER);

        //
        // SELECT AN IMAGE AND LOAD IT INTO THE LOWEST Z-INDEX DOM ELEMENT
        tmp_index++;
        tmp_next_image = this.jony5_lifestyle_banner_images_ARRAY[tmp_index];

        this.jony5_lifestyle_banner_sequence_control_ARRAY.push(tmp_index);
        this.jony5_lifestyle_banner_img_int_sequence_beta.push(tmp_index);

        this.jony5_lifestyle_banner_sequence_position++;

        var tmp_str = this.extract_filename(tmp_next_image);
        var tmp_zindex_beta = $("#jony5_banner_lifestyle_beta").css('zIndex');
        $("#jony5_banner_lifestyle_beta").css('opacity', 0);

        this.log_activity('[lnum 2474] STATIC DOM LOAD [' + tmp_str + '] INTO BETA, where Z=' + tmp_zindex_beta + ' OPACITY=' + $('#jony5_banner_lifestyle_beta').css('opacity') + '.', self.CRNRSTN_DEBUG_LIFESTYLE_BANNER);

        this.load_image_lowest_z_indice('jony5_banner_lifestyle_alpha', 'jony5_banner_lifestyle_beta', tmp_next_image);

        this.log_activity('[lnum 2478] INITIALIZE 7 SECOND TTL ON ELEMENT HOLD - BANNER IMAGE ROTATION.', this.CRNRSTN_DEBUG_LIFESTYLE_BANNER);
        this.execution_delay_ui_sync_controller('schedule', 'lifestyle_banner_image_rotation', 7);

        $('#banner_control_play_wrapper').html('<div class="banner_play_arrow"></div>');

        $( "#banner_control_play_wrapper").animate({
            opacity: 0.0
        }, {
            duration: 0,
            queue: false,
            specialEasing: {
                opacity: "swing"
            },
            step: function( now, fx ) {

            },
            complete: function () {

            }
        });

    };

    CRNRSTN_JS.prototype.initialize_delay_ui_sync_controllers = function() {

        tmp_id_len = this.transaction_thread_id_key_ARRAY.length;
        for(let i = 0; i < tmp_id_len; i++){

            //
            // INITIALIZE THREAD ID
            var tmp_i = this.transaction_thread_id_key_ARRAY[i];
            if(!(tmp_i in this.transaction_thread_count_ARRAY)){

                this.transaction_thread_count_ARRAY[this.transaction_thread_id_key_ARRAY[i]] = 0;
                this.ui_sync_controller_thread_delay_ARRAY[this.transaction_thread_id_key_ARRAY[i]] = -1;

            }

        }

    };

    CRNRSTN_JS.prototype.refresh_ui_state = function(request_key, request_checksum) {

        //
        // START UI REFRESH TRANSACTION. HERE, ONLY ONE (1) AT ANY GIVEN TIME, PLEASE.
        if(this.authorize_transaction(request_key, request_checksum, 1)) {

            //alert('WE GOOD!');
            this.ttl_tunnel_monitor_seconds = 0;
            this.update_transaction_count();

            //
            // UI :: UPDATE PRIMARY SEQUENCE CONTROLLER
            this.execution_delay_ui_sync_controller('fire', 'crnrstn_ui_interact');
            this.execution_delay_ui_sync_controller('fire', 'bassdrive_last_updated');
            this.execution_delay_ui_sync_controller('schedule', 'bassdrive_relay_access_by_bitrate', 3);
            this.execution_delay_ui_sync_controller('schedule', 'bassdrive_the_situation', 6);
            this.execution_delay_ui_sync_controller('schedule', 'bassdrive_title', 9);
            this.execution_delay_ui_sync_controller('schedule', 'bassdrive_locale_colors', 10);
            this.execution_delay_ui_sync_controller('schedule', 'bassdrive_social', 12);
            this.execution_delay_ui_sync_controller('schedule', 'bassdrive_locale_city_state_prov', 14);
            this.execution_delay_ui_sync_controller('schedule', 'bassdrive_connection_stats', 17);
            this.execution_delay_ui_sync_controller('schedule', 'bassdrive_history', 20);
            this.execution_delay_ui_sync_controller('schedule', 'bassdrive_reporting', 20);
            this.execution_delay_ui_sync_controller('schedule', 'bassdrive_archives', 20);

            //this.execution_delay_ui_sync_controller('schedule', 'wethrbug_results');
            //this.execution_delay_ui_sync_controller('schedule', 'living_stream_podcast_selection');
            //this.execution_delay_ui_sync_controller('schedule', 'css_validator_featured_element');

        }

    };

    CRNRSTN_JS.prototype.receive_data_tunnel_response = function(response_data) {

        //alert($('#crnrstn_interact_ui_link_text_click').val());

        //alert(response_data);

        if(response_data != null){

            if($('#crnrstn_interact_ui_link_text_click').val() != ''){

                //
                // I HATE TO DO IT THIS WAY...BUT WE JUST NEED TO GET DOCUMENTATION GOING. CAN RETURN TO
                // REFACTOR ALL THIS, AND WILL HAVE MUCH BETTER COPY-PASTE-DOCUMENTATION WHEN THAT CAN HAPPEN.
                var tmp_docs_page = $('#crnrstn_interact_ui_link_text_click').val();

                //
                // CLEAR OUT PAGE NAME TO AVOID REDUNDANT AJAX CALLS.
                //alert($('#crnrstn_interact_ui_link_text_click').val());
                //$('#crnrstn_interact_ui_link_text_click').val('');

                //$('#crnrstn_interact_ui_full_document').html($tmp_sidenav_html);

                if($('#crnrstn_documentation_dyn_shell').length){

                    //var oCRNRSTN_DOCS_DOM_ELEM = document.createElement('div');

                    //oCRNRSTN_DOCS_DOM_ELEM.setAttribute('class', 'crnrstn_documentation_dyn_shell');
                    //oCRNRSTN_DOCS_DOM_ELEM.setAttribute('id', 'crnrstn_documentation_dyn_shell');

                    //$("#crnrstn_interact_ui_full_document").appendTo(oCRNRSTN_DOCS_DOM_ELEM);
                    //$("#crnrstn_documentation_dyn_shell").prependTo($('body'));
                    //oCRNRSTN_DOCS_DOM_ELEM.prependTo();

                    //alert(response_data);
                    //$("#crnrstn_documentation_dyn_shell").html(response_data);
                    //document.getElementById("crnrstn_documentation_dyn_shell").innerHTML = response_data;

                    //$("#crnrstn_documentation_dyn_shell").html(response_data);
                    //document.getElementById("crnrstn_documentation_dyn_shell").innerHTML = response_data;
                    $("#crnrstn_documentation_dyn_shell").html(response_data);

                }

                $('#crnrstn_documentation_dyn_shell').animate({
                    width: '90%',
                    height: '100%'
                }, {
                    duration: 500,
                    queue: false,
                    step: function( now, fx ) {

                    },
                    complete: function () {

                        $("#crnrstn_documentation_dyn_shell").html(response_data);

                    }

                });

            }else{

                //var NODE_crnrstn_client_response = response_data.getElementsByTagName('crnrstn_client_response');

                if(response_data.length > 0){
                //if(NODE_crnrstn_client_response.length > 0){

                    //
                    // CONSUME XML RESPONSE DATA
                    //this.consume_data_tunnel_response(response_data, 'XML');

                    //
                    // SYNC CLIENT STATE TO THE FRESH XML
                    //tmp_data_signature_request_key = this.return_data_tunnel_xml_data('data_signature_request_key');
                    //tmp_data_signature_request_checksum = this.return_data_tunnel_xml_data('data_signature_request_checksum');

                    //this.refresh_ui_state(tmp_data_signature_request_key, tmp_data_signature_request_checksum);

                }

            }


        }

    };

    // CRNRSTN_JS.prototype.process_data_tunnel_response = function(oItemNode) {
    //
    //     var serial = $(oItemNode).find("serial").text();
    //     var request_id = $(oItemNode).find("request_id").text();
    //     var server_runtime = $(oItemNode).find("server_runtime").text();
    //
    //     this.log_activity("serial=[" + serial + "] request_id=[" + request_id + "] [" + server_runtime + "]" + this.client_rtime_pretty);
    //
    // }

    // Loop through anchors and areamaps looking for either data-lightbox attributes or rel attributes
    // that contain 'lightbox'. When these are clicked, start lightbox.
    CRNRSTN_JS.prototype.enable = function() {

        var self = this;

        $('body').on('click', 'a[rel^=lightbox], area[rel^=lightbox], a[data-lightbox], area[data-lightbox]', function(event) {

            self.start($(event.currentTarget));
            return false;

        });

        var session_salt = $("#crnrstn_session_salt").html();

        // $('body').on('click', 'a[href-crnrstn_top_' + session_salt + ']', function(event) {
        //
        //     //alert('hello world');
        //     $("html, body").animate({ scrollTop: 0 }, "slow");
        //     return false;
        //
        // });

        $('body').on('click', 'a[data-crnrstn]', 'a[rel^=crnrstn_documentation_side_nav_' + session_salt + ']', function(event) {

            //alert('currentTarget=' + this.attributes.item(1).value);
            //alert('text=' + this.text);
            //alert('innerHTML=' + this.innerHTML);

            self.link_text_click(this.text);

            return false;

        });

        //
        // CRNRSTN :: SIGN IN SUPPORT
        $('body').on('click', 'a[rel^=crnrstn_signin], area[rel^=crnrstn_signin], a[data-crnrstn_signin], area[data-crnrstn_signin]', function(event) {

            self.crnrstn_signin();
            return false;

        });

        //
        // CRNRSTN :: BASSDRIVE SUPPORT
        $('body').on('click', 'a[rel^=crnrstn_signin], area[rel^=crnrstn_signin], a[data-crnrstn_signin], area[data-crnrstn_signin]', function(event) {

            self.crnrstn_signin();
            return false;

        });

    };

    // Build html for the lightbox and the overlay.
    // Attach event handlers to the new DOM elements. click click click
    CRNRSTN_JS.prototype.build = function() {

        if ($('#lightbox').length > 0) {

            return;

        }

        var self = this;

        // The two root notes generated, #lightboxOverlay and #lightbox are given
        // tabindex attrs so they are focusable. We attach our keyboard event
        // listeners to these two elements, and not the document. Clicking anywhere
        // while Lightbox is opened will keep the focus on or inside one of these
        // two elements.
        //
        // We do this so we can prevent propagation of the Esc keypress when
        // Lightbox is open. This prevents it from interfering with other components
        // on the page below.
        //
        // Github issue: https://github.com/lokesh/lightbox2/issues/663
        $('<div id="lightboxOverlay" tabindex="-1" class="lightboxOverlay"></div><div id="lightbox" tabindex="-1" class="lightbox"><div class="lb-outerContainer"><div class="lb-container"><img class="lb-image" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" alt=""/><div class="lb-nav"><a class="lb-prev" aria-label="Previous image" href=""></a><a class="lb-next" aria-label="Next image" href=""></a></div><div class="lb-loader"><a class="lb-cancel"></a></div></div></div><div class="lb-dataContainer"><div class="lb-data"><div class="lb-details"><span class="lb-caption"></span><span class="lb-number"></span></div><div class="lb-closeContainer"><a class="lb-close"></a></div></div></div></div>').appendTo($('body'));

        // Cache jQuery objects
        this.$lightbox       = $('#lightbox');
        this.$overlay        = $('#lightboxOverlay');
        this.$outerContainer = this.$lightbox.find('.lb-outerContainer');
        this.$container      = this.$lightbox.find('.lb-container');
        this.$image          = this.$lightbox.find('.lb-image');
        this.$nav            = this.$lightbox.find('.lb-nav');

        // Store css values for future lookup
        this.containerPadding = {
            top: parseInt(this.$container.css('padding-top'), 10),
            right: parseInt(this.$container.css('padding-right'), 10),
            bottom: parseInt(this.$container.css('padding-bottom'), 10),
            left: parseInt(this.$container.css('padding-left'), 10)
        };

        this.imageBorderWidth = {
            top: parseInt(this.$image.css('border-top-width'), 10),
            right: parseInt(this.$image.css('border-right-width'), 10),
            bottom: parseInt(this.$image.css('border-bottom-width'), 10),
            left: parseInt(this.$image.css('border-left-width'), 10)
        };

        // Attach event handlers to the newly minted DOM elements
        this.$overlay.hide().on('click', function() {

            self.end();
            return false;

        });

        this.$lightbox.hide().on('click', function(event) {

            if ($(event.target).attr('id') === 'lightbox') {
                self.end();
            }

        });

        this.$outerContainer.on('click', function(event) {

            if ($(event.target).attr('id') === 'lightbox') {

                self.end();

            }

            return false;

        });

        this.$lightbox.find('.lb-prev').on('click', function() {

            if (self.currentImageIndex === 0) {

                self.changeImage(self.album.length - 1);

            } else {

                self.changeImage(self.currentImageIndex - 1);

            }

            return false;

        });

        this.$lightbox.find('.lb-next').on('click', function() {

            if (self.currentImageIndex === self.album.length - 1) {

                self.changeImage(0);

            } else {

                self.changeImage(self.currentImageIndex + 1);

            }

            return false;

        });

        /*
          Show context menu for image on right-click

          There is a div containing the navigation that spans the entire image and lives above of it. If
          you right-click, you are right clicking this div and not the image. This prevents users from
          saving the image or using other context menu actions with the image.

          To fix this, when we detect the right mouse button is pressed down, but not yet clicked, we
          set pointer-events to none on the nav div. This is so that the upcoming right-click event on
          the next mouseup will bubble down to the image. Once the right-click/contextmenu event occurs
          we set the pointer events back to auto for the nav div so it can capture hover and left-click
          events as usual.
         */
        this.$nav.on('mousedown', function(event) {

            if (event.which === 3) {

                self.$nav.css('pointer-events', 'none');

                self.$lightbox.one('contextmenu', function() {

                    setTimeout(function() {

                        this.$nav.css('pointer-events', 'auto');

                    }.bind(self), 0);

                });

            }

        });

        this.$lightbox.find('.lb-loader, .lb-close').on('click', function() {

            self.end();
            return false;

        });

    };

    // Show overlay and lightbox. If the image is part of a set, add siblings to album array.
    CRNRSTN_JS.prototype.start = function($link) {

        var self    = this;
        var $window = $(window);

        $window.on('resize', $.proxy(this.sizeOverlay, this));

        this.sizeOverlay();

        this.album = [];
        var imageNumber = 0;

        function addToAlbum($link) {

            self.album.push({
                alt: $link.attr('data-alt'),
                link: $link.attr('href'),
                title: $link.attr('data-title') || $link.attr('title')
            });

        }

        // Support both data-lightbox attribute and rel attribute implementations
        var dataLightboxValue = $link.attr('data-lightbox');
        var $links;

        if (dataLightboxValue) {

            $links = $($link.prop('tagName') + '[data-lightbox="' + dataLightboxValue + '"]');
            for(let i = 0; i < $links.length; i = ++i) {

                addToAlbum($($links[i]));
                if ($links[i] === $link[0]) {

                    imageNumber = i;

                }

            }

        } else {

            if ($link.attr('rel') === 'lightbox') {

                // If image is not part of a set
                addToAlbum($link);

            } else {

                // If image is part of a set
                $links = $($link.prop('tagName') + '[rel="' + $link.attr('rel') + '"]');

                for(let j = 0; j < $links.length; j = ++j) {

                    addToAlbum($($links[j]));
                    if ($links[j] === $link[0]) {

                        imageNumber = j;

                    }

                }

            }

        }

        // Position Lightbox
        var top  = $window.scrollTop() + this.options.positionFromTop;
        var left = $window.scrollLeft();

        this.$lightbox.css({
            top: top + 'px',
            left: left + 'px'
        }).fadeIn(this.options.fadeDuration);

        // Disable scrolling of the page while open
        if (this.options.disableScrolling) {

            $('body').addClass('lb-disable-scrolling');

        }

        this.changeImage(imageNumber);

    };

    // Hide most UI elements in preparation for the animated resizing of the lightbox.
    CRNRSTN_JS.prototype.changeImage = function(imageNumber) {

        var self = this;
        var filename = this.album[imageNumber].link;
        var filetype = filename.split('.').slice(-1)[0];
        var $image = this.$lightbox.find('.lb-image');

        // Disable keyboard nav during transitions
        this.disableKeyboardNav();

        // Show loading state
        this.$overlay.fadeIn(this.options.fadeDuration);
        $('.lb-loader').fadeIn('slow');
        this.$lightbox.find('.lb-image, .lb-nav, .lb-prev, .lb-next, .lb-dataContainer, .lb-numbers, .lb-caption').hide();
        this.$outerContainer.addClass('animating');

        // When image to show is preloaded, we send the width and height to sizeContainer()
        var preloader = new Image();
        preloader.onload = function() {

            var $preloader;
            var imageHeight;
            var imageWidth;
            var maxImageHeight;
            var maxImageWidth;
            var windowHeight;
            var windowWidth;

            $image.attr({
                'alt': self.album[imageNumber].alt,
                'src': filename
            });

            $preloader = $(preloader);

            $image.width(preloader.width);
            $image.height(preloader.height);
            windowWidth = $(window).width();
            windowHeight = $(window).height();

            // Calculate the max image dimensions for the current viewport.
            // Take into account the border around the image and an additional 10px gutter on each side.
            maxImageWidth  = windowWidth - self.containerPadding.left - self.containerPadding.right - self.imageBorderWidth.left - self.imageBorderWidth.right - 20;
            maxImageHeight = windowHeight - self.containerPadding.top - self.containerPadding.bottom - self.imageBorderWidth.top - self.imageBorderWidth.bottom - self.options.positionFromTop - 70;

            /*
            Since many SVGs have small intrinsic dimensions, but they support scaling
            up without quality loss because of their vector format, max out their
            size.
            */
            if (filetype === 'svg') {

                $image.width(maxImageWidth);
                $image.height(maxImageHeight);

            }

            // Fit image inside the viewport.
            if (self.options.fitImagesInViewport) {

                // Check if image size is larger then maxWidth|maxHeight in settings
                if (self.options.maxWidth && self.options.maxWidth < maxImageWidth) {

                    maxImageWidth = self.options.maxWidth;

                }

                if (self.options.maxHeight && self.options.maxHeight < maxImageHeight) {

                    maxImageHeight = self.options.maxHeight;

                }

            } else {

                maxImageWidth = self.options.maxWidth || preloader.width || maxImageWidth;
                maxImageHeight = self.options.maxHeight || preloader.height || maxImageHeight;

            }

            // Is the current image's width or height is greater than the maxImageWidth or maxImageHeight
            // option than we need to size down while maintaining the aspect ratio.
            if ((preloader.width > maxImageWidth) || (preloader.height > maxImageHeight)) {

                if ((preloader.width / maxImageWidth) > (preloader.height / maxImageHeight)) {

                    imageWidth  = maxImageWidth;
                    imageHeight = parseInt(preloader.height / (preloader.width / imageWidth), 10);
                    $image.width(imageWidth);
                    $image.height(imageHeight);

                } else {

                    imageHeight = maxImageHeight;
                    imageWidth = parseInt(preloader.width / (preloader.height / imageHeight), 10);
                    $image.width(imageWidth);
                    $image.height(imageHeight);

                }

            }

            self.sizeContainer($image.width(), $image.height());

        };

        // Preload image before showing
        preloader.src = this.album[imageNumber].link;
        this.currentImageIndex = imageNumber;

    };

    // Stretch overlay to fit the viewport
    CRNRSTN_JS.prototype.sizeOverlay = function() {

        var self = this;
        /*
        We use a setTimeout 0 to pause JS execution and let the rendering catch-up.
        Why do this? If the `disableScrolling` option is set to true, a class is added to the body
        tag that disables scrolling and hides the scrollbar. We want to make sure the scrollbar is
        hidden before we measure the document width, as the presence of the scrollbar will affect the
        number.
        */

        setTimeout(function() {

            self.$overlay
                .width($(document).width())
                .height($(document).height());

        }, 0);

    };

    // Animate the size of the lightbox to fit the image we are showing
    // This method also shows the the image.
    CRNRSTN_JS.prototype.sizeContainer = function(imageWidth, imageHeight) {

        var self = this;

        var oldWidth  = this.$outerContainer.outerWidth();
        var oldHeight = this.$outerContainer.outerHeight();
        var newWidth  = imageWidth + this.containerPadding.left + this.containerPadding.right + this.imageBorderWidth.left + this.imageBorderWidth.right;
        var newHeight = imageHeight + this.containerPadding.top + this.containerPadding.bottom + this.imageBorderWidth.top + this.imageBorderWidth.bottom;

        function postResize() {

            self.$lightbox.find('.lb-dataContainer').width(newWidth);
            self.$lightbox.find('.lb-prevLink').height(newHeight);
            self.$lightbox.find('.lb-nextLink').height(newHeight);

            // Set focus on one of the two root nodes so keyboard events are captured.
            self.$overlay.focus();

            self.showImage();

        }

        if (oldWidth !== newWidth || oldHeight !== newHeight) {

            this.$outerContainer.animate({
                width: newWidth,
                height: newHeight
            }, this.options.resizeDuration, 'swing', function() {
                postResize();
            });

        } else {

            postResize();

        }

    };

    // Display the image and its details and begin preload neighboring images.
    CRNRSTN_JS.prototype.showImage = function() {

        this.$lightbox.find('.lb-loader').stop(true).hide();
        this.$lightbox.find('.lb-image').fadeIn(this.options.imageFadeDuration);

        this.updateNav();
        this.updateDetails();
        this.preloadNeighboringImages();
        this.enableKeyboardNav();

    };

    // Display previous and next navigation if appropriate.
    CRNRSTN_JS.prototype.updateNav = function() {
        // Check to see if the browser supports touch events. If so, we take the conservative approach
        // and assume that mouse hover events are not supported and always show prev/next navigation
        // arrows in image sets.
        var alwaysShowNav = false;

        try {

            document.createEvent('TouchEvent');
            alwaysShowNav = (this.options.alwaysShowNavOnTouchDevices) ? true : false;

        } catch (e) {}

        this.$lightbox.find('.lb-nav').show();

        if (this.album.length > 1) {

            if (this.options.wrapAround) {

                if (alwaysShowNav) {

                    this.$lightbox.find('.lb-prev, .lb-next').css('opacity', '1');

                }

                this.$lightbox.find('.lb-prev, .lb-next').show();

            } else {

                if (this.currentImageIndex > 0) {

                    this.$lightbox.find('.lb-prev').show();

                    if (alwaysShowNav) {

                        this.$lightbox.find('.lb-prev').css('opacity', '1');

                    }

                }

                if (this.currentImageIndex < this.album.length - 1) {

                    this.$lightbox.find('.lb-next').show();

                    if (alwaysShowNav) {

                        this.$lightbox.find('.lb-next').css('opacity', '1');

                    }

                }

            }

        }

    };

    // Display caption, image number, and closing button.
    CRNRSTN_JS.prototype.updateDetails = function() {

        var self = this;

        // Enable anchor clicks in the injected caption html.
        // Thanks Nate Wright for the fix. @https://github.com/NateWr
        if (typeof this.album[this.currentImageIndex].title !== 'undefined' &&
            this.album[this.currentImageIndex].title !== '') {

            var $caption = this.$lightbox.find('.lb-caption');

            if (this.options.sanitizeTitle) {

                $caption.text(this.album[this.currentImageIndex].title);

            } else {

                $caption.html(this.album[this.currentImageIndex].title);

            }

            $caption.fadeIn('fast');

        }

        if (this.album.length > 1 && this.options.showImageNumberLabel) {

            var labelText = this.imageCountLabel(this.currentImageIndex + 1, this.album.length);
            this.$lightbox.find('.lb-number').text(labelText).fadeIn('fast');

        } else {

            this.$lightbox.find('.lb-number').hide();

        }

        this.$outerContainer.removeClass('animating');

        this.$lightbox.find('.lb-dataContainer').fadeIn(this.options.resizeDuration, function() {

            return self.sizeOverlay();

        });

    };

    // Preload previous and next images in set.
    CRNRSTN_JS.prototype.preloadNeighboringImages = function() {

        if (this.album.length > this.currentImageIndex + 1) {

            var preloadNext = new Image();
            preloadNext.src = this.album[this.currentImageIndex + 1].link;

        }

        if (this.currentImageIndex > 0) {

            var preloadPrev = new Image();
            preloadPrev.src = this.album[this.currentImageIndex - 1].link;

        }

    };

    CRNRSTN_JS.prototype.enableKeyboardNav = function() {

        this.$lightbox.on('keyup.keyboard', $.proxy(this.keyboardAction, this));
        this.$overlay.on('keyup.keyboard', $.proxy(this.keyboardAction, this));

    };

    CRNRSTN_JS.prototype.disableKeyboardNav = function() {

        this.$lightbox.off('.keyboard');
        this.$overlay.off('.keyboard');

    };

    CRNRSTN_JS.prototype.keyboardAction = function(event) {

        var KEYCODE_ESC        = 27;
        var KEYCODE_LEFTARROW  = 37;
        var KEYCODE_RIGHTARROW = 39;

        var keycode = event.keyCode;
        if (keycode === KEYCODE_ESC) {

            // Prevent bubbling so as to not affect other components on the page.
            event.stopPropagation();
            this.end();

        } else if (keycode === KEYCODE_LEFTARROW) {

            if (this.currentImageIndex !== 0) {

                this.changeImage(this.currentImageIndex - 1);

            } else if (this.options.wrapAround && this.album.length > 1) {

                this.changeImage(this.album.length - 1);

            }

        } else if (keycode === KEYCODE_RIGHTARROW) {

            if (this.currentImageIndex !== this.album.length - 1) {

                this.changeImage(this.currentImageIndex + 1);

            } else if (this.options.wrapAround && this.album.length > 1) {

                this.changeImage(0);

            }

        }

    };

    CRNRSTN_JS.prototype.transitions_ui_content_update = function(target_dom_elem_id, content, transition = null){

        if(transition === null){

            $('#' + target_dom_elem_id).html(content);

        }else{

            $('#' + target_dom_elem_id).toggle( transition );

            $( "#crnrstn_ui_transition_delay").animate({
                left: "0px"
            }, {
                duration: 700,
                queue: false,
                step: function( now, fx ) {

                },
                complete: function () {

                    $('#' + target_dom_elem_id).html(content);

                    $('#' + target_dom_elem_id).toggle( transition );

                }

            });

        }

    };

    //
    // SOURCE :: https://stackoverflow.com/questions/14129953/how-to-encode-a-string-in-javascript-for-displaying-in-html
    // AUTHOR :: j08691:: https://stackoverflow.com/users/616443/j08691
    CRNRSTN_JS.prototype.html_entities = function(str){

        return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');

    };

    CRNRSTN_JS.prototype.log_out = function(str){

        var curr_date_obj = new Date();

        switch(this.CRNRSTN_LOGGING_OUTPUT){
            case 'DOM':

                var log_out = '[' + this.return_log_date_string(curr_date_obj, 'sys_ts') + '] [rtime' + this.return_log_date_string(curr_date_obj, 'sys_rtime') + '] ' + str;
                var oCRNRSTN_LOG_DOM_ELEM = document.createElement('div');

                oCRNRSTN_LOG_DOM_ELEM.setAttribute('class', 'crnrstn_log_entry');
                $("#crnrstn_activity_log_output").prepend(oCRNRSTN_LOG_DOM_ELEM);

                //
                // CLEAN STRING FOR HTML
                // &lt;profile&gt;
                str_clean = this.html_entities(log_out);

                oCRNRSTN_LOG_DOM_ELEM.innerHTML = str_clean;

            break;
            case 'ALERT':

                alert(str);

            break;
            default:
                //CONSOLE OUT
                console.log('[' + this.return_log_date_string(curr_date_obj, 'sys_ts') + '] [rtime' + this.return_log_date_string(curr_date_obj, 'sys_rtime') + '] ' + str);

            break;

        }

    };

    CRNRSTN_JS.prototype.log_activity = function(str, mode = this.CRNRSTN_DEBUG_BASIC){

        if(this.crnrstn_debug_mode === this.CRNRSTN_DEBUG_OFF){

        }else{

            switch(this.CRNRSTN_LOGGING_OUTPUT){
                case 'DOM':
                case 'CONSOLE':
                case 'ALERT':
                default:

                    if(mode === this.CRNRSTN_DEBUG_VERBOSE){

                        //
                        // VERBOSE IS SET LOCALLY
                        this.log_out(str);

                    }else{

                        switch (this.crnrstn_debug_mode) {
                            case this.CRNRSTN_DEBUG_VERBOSE:

                                //
                                // VERBOSE IS SET GLOBALLY
                                this.log_out(str);

                            break;
                            case this.CRNRSTN_DEBUG_BASSDRIVE:

                                if (mode === this.CRNRSTN_DEBUG_BASSDRIVE) {

                                    this.log_out(str);

                                }

                            break;
                            case this.CRNRSTN_DEBUG_LIFESTYLE_BANNER:

                                if (mode === this.CRNRSTN_DEBUG_LIFESTYLE_BANNER) {

                                    this.log_out(str);

                                }

                            break;
                            case this.CRNRSTN_DEBUG_BASIC:

                                if (mode === this.CRNRSTN_DEBUG_BASIC) {

                                    this.log_out(str);

                                } else {

                                    if (mode === this.CRNRSTN_DEBUG_LIFESTYLE_BANNER) {

                                        this.log_out(str);

                                    } else {

                                        if (mode === this.CRNRSTN_DEBUG_BASSDRIVE) {

                                            this.log_out(str);

                                        }

                                    }

                                }

                            break;
                            default:
                                //
                                // SILENCE IS GOLDEN

                            break;

                        }

                    }

                break;

            }

        }

    };

    CRNRSTN_JS.prototype.return_log_date_string = function(date_obj, type, abbrev_type = 'short_str'){

        var output_str = '';

        switch(type){
            case 'sys_rtime':
                //  0.434234 secs
                // 1 min 5.434234 secs
                // 1 hr 3 mins 15.434234 secs

                var time_chunks = this.client_rtime.split(":");
                var year, month, week, day, hour, mins, secs;
                var year_copy = '';
                var month_copy = '';
                var week_copy = '';
                var day_copy = '';
                var hour_copy = '';
                var min_copy = '';
                var secs_copy = '';

                hour = Number(time_chunks[0]);
                mins = Number(time_chunks[1]);
                secs = Number(time_chunks[2]);

                this.client_rtime_hour = hour;
                this.client_rtime_mins = this.plz(mins);
                this.client_rtime_secs = this.plz(secs);

                // if(hour > 24){
                //
                //     this.client_rtime_day = hour;
                //     hour_copy = '';
                //
                // }

                if (hour > 0) {

                    hour_copy =  " " + hour + " hr";

                    if (hour > 1) {

                        hour_copy = hour_copy + "s";

                    }

                    hour_copy = hour_copy;

                }

                if (mins > 0) {

                    min_copy =  " " + mins + " min";

                    if (mins > 1) {

                        min_copy = min_copy + "s";

                    }

                }

                var temp_curr_date = new Date();
                this.client_millisecs = temp_curr_date.getMilliseconds();

                if (secs > 0) {

                    secs_copy = " " + secs + "." + this.client_millisecs + " secs";

                } else {

                    secs_copy = " 0." + this.client_millisecs + " secs";

                }

                output_str = hour_copy + min_copy + secs_copy;

            break;
            case 'timestamp':

                var day_mth = this.return_log_date_string(date_obj, 'day_mth', 'long_int');
                var month = this.return_log_date_string(date_obj, 'month');
                var day_wk = this.return_log_date_string(date_obj, 'day_wk', 'long_int');
                var hours = this.return_log_date_string(date_obj, 'hours');
                var minutes = this.return_log_date_string(date_obj, 'minutes');
                var seconds = this.return_log_date_string(date_obj, 'seconds', 'long_int');
                var year = this.return_log_date_string(date_obj, 'year');

                output_str = day_wk + ' ' + month + ' ' + day_mth + ' ' + hours + ':' + minutes + ':' + seconds + ' ' + year;

            break;
            case 'sys_ts':
                //2021-11-20 08:48:42.179295
                // date_obj.getTimezoneOffset();

                var day_mth = this.return_log_date_string(date_obj, 'day_mth', 'long_int');
                var month = this.return_log_date_string(date_obj, 'month', 'long_int');  //date_obj.getMonth();
                //var day_wk = this.return_log_date_string(date_obj, 'day_wk', 'long_int');
                var hours = this.return_log_date_string(date_obj, 'hours');
                var minutes = this.return_log_date_string(date_obj, 'minutes');
                var seconds = this.return_log_date_string(date_obj, 'seconds', 'long_int');
                var year = this.return_log_date_string(date_obj, 'year');

                dtz_delta = this.return_utc_offset(date_obj);

                output_str = year + '-'+ month + '-' + day_mth + ' ' + hours + ':' + minutes + ':' + seconds + ' ' + dtz_delta;

            break;
            case 'day_wk':
                // Mon
                // this.client_day_abbrev_ARRAY = ['Sun', 'Mon', 'Tues', 'Wed', 'Thurs', 'Fri', 'Sat'];
                // this.client_day_ARRAY = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

                var day = date_obj.getDay();
                if(abbrev_type == 'short_str'){

                    output_str = this.client_day_abbrev_ARRAY[day];

                }else{

                    if(abbrev_type == 'long_str'){

                        output_str = this.client_day_ARRAY[day];

                    }else{

                        day++;

                        if (abbrev_type == 'long_int') {

                            if (day < 10) {

                                output_str = '0' + day;

                            }else{

                                output_str = day;

                            }

                        }

                    }

                }

            break;
            case 'day_mth':
                // 29
                // this.client_day_mth_en_ARRAY = ['first', 'second', 'third', 'fourth', 'fifth', 'sixth', 'seventh',
                // 'eigth', 'ninth', 'tenth',  'eleventh', 'twelfth', 'thirtenth', '', '',  '', '', '', '', '',  '',
                // '', '', '', '',  '', '', '', '', '',  '', '', '',
                // '', '',  '', '', '', '', '',  '', '', '', '', '',  '', '', '', '', '',  '', '', ''];

                // this.client_day_mth_en_ARRAY = ['1st', '2nd', '3rd', '4th', '5th', '6th', '7th',
                // '8th', '9th', '10th',  '11th', '12th', '13th', '', '',  '', '', '', '', '',  '',
                // '', '', '', '',  '', '', '', '', '',  '', '', '',
                // '', '',  '', '', '', '', '',  '', '', '', '', '',  '', '', '', '', '',  '', '', ''];

                day = date_obj.getDate();

                if (abbrev_type == 'long_int') {

                    if (day < 10) {

                        output_str = '0' + day;

                    }else{

                        output_str = day;

                    }

                }

            break;
            case 'month':
                // long_int, long_str, short_str
                // this.client_month_abbrev_ARRAY = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sept','Oct','Nov','Dec'];
                // this.client_month_ARRAY = ['January','February','March','April','May','June','July','August','September','October','November','December'];

                var month = date_obj.getMonth();

                if(abbrev_type == 'short_str'){

                    output_str = this.client_month_abbrev_ARRAY[month];

                }else{

                    if(abbrev_type == 'long_str'){

                        output_str = this.client_month_ARRAY[month];

                    }else{

                        month++;

                        if (abbrev_type == 'long_int') {

                            if (month < 10) {

                                output_str = '0' + month;

                            }else{

                                output_str = month;

                            }

                        }

                    }

                }

            break;
            case 'year':

                output_str = date_obj.getFullYear();

            break;
            case 'hours':

                output_str = date_obj.getHours();
                output_str = this.plz(output_str);

            break;
            case 'minutes':

                output_str = date_obj.getMinutes();
                output_str = this.plz(output_str);

            break;
            case 'seconds':

                var temp_curr_date = new Date();
                this.client_millisecs = temp_curr_date.getMilliseconds();

                var secs = date_obj.getSeconds();

                if (abbrev_type == 'long_int') {

                    if (secs < 10) {

                        output_str = '0' + secs;

                    }else{

                        output_str = secs;

                    }

                }

                output_str = output_str + '.' + this.client_millisecs;

            break;

        }

        return output_str;

    };

    CRNRSTN_JS.prototype.return_utc_offset = function(date_obj){

        var dtz_delta = date_obj.getTimezoneOffset();

        dtz_delta_units_hr = dtz_delta / 60;
        dtz_delta_units_min = dtz_delta_units_hr % 1;

        if(dtz_delta_units_hr > 0){

            dtz_sign = '+';

        }else{

            dtz_sign = '-';
            dtz_delta_units_hr = dtz_delta_units_hr * -1;
            dtz_delta_units_min = dtz_delta_units_min * -1;

        }

        dtz_delta_hr = dtz_delta_units_hr - dtz_delta_units_min;
        dtz_delta_min = dtz_delta_units_min * 60;

        dtz_delta_hr = this.plz(dtz_delta_hr);
        dtz_delta_min = this.plz(dtz_delta_min);

        dtz_delta = 'UTC' + dtz_sign + dtz_delta_hr + dtz_delta_min;

        return dtz_delta;

    };

    //
    // SOURCE :: https://stackoverflow.com/questions/2901102/how-to-print-a-number-with-commas-as-thousands-separators-in-javascript
    // AUTHOR :: https://stackoverflow.com/users/28324/elias-zamaria
    CRNRSTN_JS.prototype.pretty_format_number = function(num){

        var parts = num.toString().split(".");
        parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");

        return parts.join(".");

    };

    CRNRSTN_JS.prototype.short_format_data_size = function(data_format){

        var format = '';

        switch(data_format){
            case 'kilabit':

                format = 'KB';

            break;
            case 'megabit':

                format = 'MB';

            break;
            case 'gigabit':

                format = 'GB';

            break;
            default:

                format = '?B';

            break;

        }

        return format;

    };

    //
    // SOURCE :: https://stackoverflow.com/questions/16153479/jquery-checksum
    // AUTHOR :: Siva Charan :: https://stackoverflow.com/users/500725/siva-charan
    CRNRSTN_JS.prototype.return_hash = function(str = null){

        var hash = 0, i, char;

        if(str.length == 0){

            tmp_timestamp = new Date();
            str = this.return_log_date_string(tmp_timestamp, 'sys_ts');

        }

        if (str.length == 0) return hash;

        for(let i = 0; i < str.length; i++) {
            char = str.charCodeAt(i);
            hash = ((hash<<5)-hash)+char;
            hash = hash & hash; // Convert to 32bit integer
        }

        return hash;

    };

    //
    // SOURCE :: https://codepen.io/kachibito/pen/PjqrEE
    // AUTHOR :: kachibito :: https://codepen.io/kachibito
    CRNRSTN_JS.prototype.generate_new_key = function(length = 64, chars_selection = null){

        var chars = '';
        var text = '';

        if(chars_selection == null){

            chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            chars += 'abcdefghijklmnopqrstuvwxyz';
            chars += '0123456789';
            chars += '![]{}()%&*$#^<>~@|- ';

        }else{

            if(chars_selection.length < 1){

                chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                chars += 'abcdefghijklmnopqrstuvwxyz';
                chars += '0123456789';
                chars += '![]{}()%&*$#^<>~@|- ';

            }else{

                chars = chars_selection;

            }
        }

        for(let i = 0; i < length; i++) {

            text += chars.charAt(Math.floor(Math.random() * chars.length));

        }

        return text;

    };

    //
    // LINING UP TO RE-ARCH THIS INTO CRNRSTN ::
    CRNRSTN_JS.prototype.rotate_jony5_lifestyle_image = function(dom_element_alpha, dom_element_beta){

        var self = this;

        tmp_zindex_alpha = $('#' + dom_element_alpha).css( "zIndex" );
        tmp_zindex_beta = $('#' + dom_element_beta).css( "zIndex" );

        //
        // SHIFT TO HIGHER Z AND MAKE VISIBLE
        $('#' + dom_element_alpha).css('zIndex', tmp_zindex_beta);
        $('#' + dom_element_beta).css('zIndex', tmp_zindex_alpha);

        if(tmp_zindex_alpha < tmp_zindex_beta){

            var tmp_str = $('#' + dom_element_beta).html();
            tmp_str = this.extract_filename(tmp_str);
            this.log_activity('[lnum 3816] ALPHA Z-SHIFTED ' + tmp_zindex_alpha + '->' + tmp_zindex_beta + '. [' + tmp_str + '] NOW FIRING! OPACITY-TRANSITION ' + $('#' + dom_element_alpha).css( "opacity" ) + ' TO  1.0.', this.CRNRSTN_DEBUG_LIFESTYLE_BANNER);

            $('#' + dom_element_alpha).animate({
                opacity: 1.0
            }, {
                duration: 1000,
                queue: false,
                step: function( now, fx ) {

                },
                complete: function () {

                    $('#' + dom_element_beta).animate({
                        opacity: 0
                    }, {
                        duration: 0,
                        queue: false,
                        step: function( now, fx ) {

                        },
                        complete: function () {

                            var seq_adj_pos = self.back_press_cnt + self.jony5_lifestyle_banner_sequence_position;

                            if(self.jony5_lifestyle_banner_sequence_control_ARRAY.length > seq_adj_pos){

                                self.jony5_lifestyle_banner_sequence_position = self.jony5_lifestyle_banner_sequence_position + 1;

                                //
                                // MOVE TOP DOM ELEM CONTENT TO TEMP CONTAINER TO TEMP TOP CONTAINER
                                $('#jony5_banner_lifestyle_transition_tmp').html($('#' + self.top_lifestyle_banner_image_container).html());

                                //
                                // RESET ALPHA AND BETA CONTAINERS TO PREV/NEXT STATE
                                self.jony5_lifestyle_banner_state_revert();

                                //
                                // FIRE TRANSITION ("OPACITY OUT" TEMP CONTAINER)
                                self.jony5_lifestyle_banner_tmp_transition();

                                //
                                // HIDE/SHOW BUTTONS (FWD OR BACK) IF AT THRESHOLD
                                var result = self.jony5_lifestyle_banner_sequence_control_ARRAY.length - self.jony5_lifestyle_banner_sequence_position - self.back_press_cnt - 2;

                                if((result != 0) && (result < self.jony5_lifestyle_banner_sequence_control_ARRAY.length)){

                                    self.log_activity('[lnum 3862] VISIBILITY FWD BUTTON banner_sequence_position=[' + self.jony5_lifestyle_banner_sequence_position + ']', self.CRNRSTN_DEBUG_VERBOSE);

                                    self.init_ui_input_control_state('forward_btn_banner', 'ON');

                                }else{

                                    self.log_activity('[lnum 3868] VISIBILITY FWD BUTTON banner_sequence_position=[' + self.jony5_lifestyle_banner_sequence_position + ']', self.CRNRSTN_DEBUG_VERBOSE);

                                    self.init_ui_input_control_state('forward_btn_banner', 'OFF');

                                }

                                if(self.jony5_lifestyle_banner_sequence_position > 2){

                                    self.log_activity('[lnum 3876] VISIBILITY BACK BUTTON banner_sequence_position=[' + self.jony5_lifestyle_banner_sequence_position + ']', self.CRNRSTN_DEBUG_VERBOSE);

                                    self.init_ui_input_control_state('back_btn_banner', 'ON');

                                }else{

                                    self.log_activity('[lnum 3882] VISIBILITY BACK BUTTON banner_sequence_position=[' + self.jony5_lifestyle_banner_sequence_position + ']', self.CRNRSTN_DEBUG_VERBOSE);

                                    self.init_ui_input_control_state('back_btn_banner', 'OFF');

                                }

                            }else{

                                var tmp_index = self.return_random_index_int(self.jony5_lifestyle_banner_images_ARRAY);
                                var tmp_next_image = self.jony5_lifestyle_banner_images_ARRAY[tmp_index];

                                self.jony5_lifestyle_banner_sequence_control_ARRAY.push(tmp_index);
                                self.jony5_lifestyle_banner_img_int_sequence_alpha.push(tmp_index);

                                self.jony5_lifestyle_banner_sequence_position++;

                                var tmp_str = self.extract_filename(tmp_next_image);
                                self.log_activity('[lnum 3899] QUEUE RANDOM IMAGE ' + tmp_index + ' (OUT OF ' + self.jony5_lifestyle_banner_images_ARRAY.length + '). [' + tmp_str + '].', self.CRNRSTN_DEBUG_VERBOSE);

                                if(self.jony5_lifestyle_banner_sequence_position > 0){

                                    self.init_ui_input_control_state('back_btn_banner', 'ON');

                                }else{

                                    self.init_ui_input_control_state('back_btn_banner', 'OFF');

                                }

                                self.back_press_cnt = self.back_press_cnt * 1;
                                var result = self.jony5_lifestyle_banner_sequence_control_ARRAY.length - self.jony5_lifestyle_banner_sequence_position - self.back_press_cnt;

                                self.log_activity('[lnum 3914] FWD BUTTON ON IF [' + self.back_press_cnt + '][' + self.jony5_lifestyle_banner_sequence_position + '][' + result + '] < [' + self.jony5_lifestyle_banner_sequence_control_ARRAY.length + ']', self.CRNRSTN_DEBUG_LIFESTYLE_BANNER);

                                if((result != 0) && (result < self.jony5_lifestyle_banner_sequence_control_ARRAY.length)){

                                    self.init_ui_input_control_state('forward_btn_banner', 'ON');

                                }else{

                                    self.init_ui_input_control_state('forward_btn_banner', 'OFF');

                                }

                                self.load_image_lowest_z_indice('jony5_banner_lifestyle_alpha', 'jony5_banner_lifestyle_beta', tmp_next_image);

                                self.log_activity('[lnum 3928] INITIALIZE 7 SECOND TTL ON ELEMENT HOLD - BANNER IMAGE ROTATION.', self.CRNRSTN_DEBUG_LIFESTYLE_BANNER);
                                self.execution_delay_ui_sync_controller('schedule', 'lifestyle_banner_image_rotation', 7);

                            }

                            if(self.back_press_cnt > 0){

                                self.back_press_cnt = self.back_press_cnt - 1;

                            }

                        }

                    });

                }

            });

            return dom_element_alpha;

        }else{

            var tmp_str = $('#' + dom_element_beta).html();
            tmp_str = this.extract_filename(tmp_str);
            this.log_activity('[lnum 3953] BETA Z-SHIFTED ' + tmp_zindex_beta + '->' + tmp_zindex_alpha + ' [' + tmp_str + '] NOW FIRING! OPACITY-TRANSITION ' + $('#' + dom_element_beta).css( "opacity" ) + ' TO  1.0.', this.CRNRSTN_DEBUG_LIFESTYLE_BANNER);

            $('#' + dom_element_beta).animate({
                opacity: 1.0
            }, {
                duration: 1000,
                queue: false,
                step: function( now, fx ) {

                },
                complete: function () {

                    $('#' + dom_element_alpha).animate({
                        opacity: 0
                    }, {
                        duration: 0,
                        queue: false,
                        step: function( now, fx ) {

                        },
                        complete: function () {

                            var seq_adj_pos = self.back_press_cnt + self.jony5_lifestyle_banner_sequence_position;

                            if(self.jony5_lifestyle_banner_sequence_control_ARRAY.length > seq_adj_pos){

                                self.jony5_lifestyle_banner_sequence_position = self.jony5_lifestyle_banner_sequence_position + 1;

                                //
                                // MOVE TOP DOM ELEM CONTENT TO TEMP CONTAINER TO TEMP TOP CONTAINER
                                $('#jony5_banner_lifestyle_transition_tmp').html($('#' + self.top_lifestyle_banner_image_container).html());

                                //
                                // RESET ALPHA AND BETA CONTAINERS TO PREV/NEXT STATE
                                self.jony5_lifestyle_banner_state_revert();

                                //
                                // FIRE TRANSITION ("OPACITY OUT" TEMP CONTAINER)
                                self.jony5_lifestyle_banner_tmp_transition();

                                //
                                // HIDE/SHOW BUTTONS (FWD OR BACK) IF AT THRESHOLD
                                var result = self.jony5_lifestyle_banner_sequence_control_ARRAY.length - self.jony5_lifestyle_banner_sequence_position - self.back_press_cnt - 2;

                                if((result != 0) && (result < self.jony5_lifestyle_banner_sequence_control_ARRAY.length)){

                                    self.log_activity('[lnum 3999] VISIBILITY FWD BUTTON banner_sequence_position=[' + self.jony5_lifestyle_banner_sequence_position + ']', self.CRNRSTN_DEBUG_VERBOSE);

                                    self.init_ui_input_control_state('forward_btn_banner', 'ON');

                                }else{

                                    self.log_activity('[lnum 4005] VISIBILITY FWD BUTTON banner_sequence_position=[' + self.jony5_lifestyle_banner_sequence_position + ']', self.CRNRSTN_DEBUG_VERBOSE);

                                    self.init_ui_input_control_state('forward_btn_banner', 'OFF');

                                }

                                if(self.jony5_lifestyle_banner_sequence_position > 2){

                                    self.log_activity('[lnum 4013] VISIBILITY BACK BUTTON banner_sequence_position=[' + self.jony5_lifestyle_banner_sequence_position + ']', self.CRNRSTN_DEBUG_VERBOSE);

                                    self.init_ui_input_control_state('back_btn_banner', 'ON');

                                }else{

                                    self.log_activity('[lnum 4019] VISIBILITY BACK BUTTON banner_sequence_position=[' + self.jony5_lifestyle_banner_sequence_position + ']', self.CRNRSTN_DEBUG_VERBOSE);

                                    self.init_ui_input_control_state('back_btn_banner', 'OFF');

                                }

                            }else{

                                var tmp_index = self.return_random_index_int(self.jony5_lifestyle_banner_images_ARRAY);
                                var tmp_next_image = self.jony5_lifestyle_banner_images_ARRAY[tmp_index];

                                self.jony5_lifestyle_banner_sequence_control_ARRAY.push(tmp_index);
                                self.jony5_lifestyle_banner_img_int_sequence_beta.push(tmp_index);

                                self.jony5_lifestyle_banner_sequence_position++;

                                var tmp_str = self.extract_filename(tmp_next_image);
                                self.log_activity('[lnum 4036] QUEUE RANDOM IMAGE ' + tmp_index + ' (OUT OF ' + self.jony5_lifestyle_banner_images_ARRAY.length + '). [' + tmp_str + '].', self.CRNRSTN_DEBUG_VERBOSE);

                                if(self.jony5_lifestyle_banner_sequence_position > 0){

                                    self.init_ui_input_control_state('back_btn_banner', 'ON');

                                }else{

                                    self.init_ui_input_control_state('back_btn_banner', 'OFF');

                                }

                                self.back_press_cnt = self.back_press_cnt * 1;
                                var result = self.jony5_lifestyle_banner_sequence_control_ARRAY.length - self.jony5_lifestyle_banner_sequence_position - self.back_press_cnt;
                                self.log_activity('[lnum 4050] FWD BUTTON ON IF [' + self.back_press_cnt + '][' + self.jony5_lifestyle_banner_sequence_position + '][' + result + '] < [' + self.jony5_lifestyle_banner_sequence_control_ARRAY.length + ']', self.CRNRSTN_DEBUG_VERBOSE);
                                if((result != 0) && (result < self.jony5_lifestyle_banner_sequence_control_ARRAY.length)){

                                    self.init_ui_input_control_state('forward_btn_banner', 'ON');

                                }else{

                                    self.init_ui_input_control_state('forward_btn_banner', 'OFF');

                                }

                                self.load_image_lowest_z_indice('jony5_banner_lifestyle_alpha', 'jony5_banner_lifestyle_beta', tmp_next_image);

                                self.log_activity('[lnum 4063] INITIALIZE 7 SECOND TTL ON ELEMENT HOLD - BANNER IMAGE ROTATION.', self.CRNRSTN_DEBUG_LIFESTYLE_BANNER);

                                self.execution_delay_ui_sync_controller('schedule', 'lifestyle_banner_image_rotation', 7);

                            }

                            if(self.back_press_cnt > 0){

                                self.back_press_cnt = self.back_press_cnt - 1;

                            }

                        }

                    });

                }

            });

            return dom_element_beta;

        }

    };

    //
    // LINING UP TO RE-ARCH THIS INTO CRNRSTN ::
    CRNRSTN_JS.prototype.extract_filename = function(str_path){

        //
        // TODO :: GET SITE WWW ROOT INFO FROM THE PSSDTLP/CRNRSTN :: DDO UI TUNNEL RESPONSE
        //  SITUATION....IN FACT, WHY DON'T YOU GET ALL THE VALUES WITH FLIPPED BITS.
        // var str_array = str_path.split(this.get_resource('ROOT_PATH_CLIENT_HTTP') + this.get_resource('ROOT_PATH_CLIENT_HTTP_DIR') + 'common/imgs/lifestyle_banner/desktop/');
        var str_array = str_path.split('http://172.16.225.128/jony5/common/imgs/lifestyle_banner/desktop/');
        var tmp_str = str_array[1];

        if(tmp_str !== undefined){

            var str_array = tmp_str.split('" width="1180" height="250" alt="Jonathan \'J5\' Harris">');

            return str_array[0];

        }else{

            var str_array = str_path.split('http://172.16.225.139/alpha.jony5.com/common/imgs/lifestyle_banner/desktop/');
            var tmp_str = str_array[1];

            var str_array = tmp_str.split('" width="1180" height="250" alt="Jonathan \'J5\' Harris">');

            return str_array[0];

        }

    };

    CRNRSTN_JS.prototype.transition_lifestyle_banner_elem = function(dom_element_alpha, dom_element_beta){

        var self = this;

        tmp_zindex_alpha = $('#' + dom_element_alpha).css( "zIndex" );
        tmp_zindex_beta = $('#' + dom_element_beta).css( "zIndex" );

        var tmp_alpha_img = this.extract_filename($('#' + dom_element_alpha).html());
        var tmp_beta_img = this.extract_filename($('#' + dom_element_beta).html());
        this.log_activity('[lnum 4126] TRANSITION AFTER BUTTON PRESS. ALPHA-Z[' + tmp_zindex_alpha + '][' + tmp_alpha_img + '] *** BETA-Z[' + tmp_zindex_beta + '][' + tmp_beta_img + '].', this.CRNRSTN_DEBUG_LIFESTYLE_BANNER);

        $('#' + dom_element_alpha).css('zIndex', tmp_zindex_beta);
        $('#' + dom_element_beta).css('zIndex', tmp_zindex_alpha);

        tmp_zindex_alpha_new = $('#' + dom_element_alpha).css( "zIndex" );
        tmp_zindex_beta_new = $('#' + dom_element_beta).css( "zIndex" );
        this.log_activity('[lnum 4133] NEW ALPHA-Z[' + tmp_zindex_alpha_new + '][' + tmp_alpha_img + '] *** BETA-Z[' + tmp_zindex_beta_new + '][' + tmp_beta_img + '].', this.CRNRSTN_DEBUG_LIFESTYLE_BANNER);

        if(tmp_zindex_alpha < tmp_zindex_beta){

            $('#' + dom_element_alpha).animate({
                opacity: 1.0
            }, {
                duration: 1000,
                queue: false,
                step: function( now, fx ) {

                },
                complete: function () {

                    $('#' + dom_element_beta).animate({
                        opacity: 0
                    }, {
                        duration: 0,
                        queue: false,
                        step: function( now, fx ) {

                        },
                        complete: function () {

                            self.log_activity('[lnum 4157] INITIALIZE 7 SECOND TTL ON ELEMENT HOLD - BANNER IMAGE ROTATION.', self.CRNRSTN_DEBUG_LIFESTYLE_BANNER);
                            self.execution_delay_ui_sync_controller('schedule', 'lifestyle_banner_image_rotation', 7);

                        }

                    });

                }

            });

        }else{

            $('#' + dom_element_beta).animate({
                opacity: 1.0
            }, {
                duration: 1000,
                queue: false,
                step: function( now, fx ) {

                },
                complete: function () {

                    $('#' + dom_element_alpha).animate({
                        opacity: 0
                    }, {
                        duration: 0,
                        queue: false,
                        step: function( now, fx ) {

                        },
                        complete: function () {

                            self.log_activity('[lnum 4190] INITIALIZE 7 SECOND TTL ON ELEMENT HOLD - BANNER IMAGE ROTATION.', self.CRNRSTN_DEBUG_LIFESTYLE_BANNER);
                            self.execution_delay_ui_sync_controller('schedule', 'lifestyle_banner_image_rotation', 7);

                        }

                    });

                }

            });

        }

    };

    CRNRSTN_JS.prototype.load_image_lowest_z_indice = function(dom_element_alpha, dom_element_beta, image_uri){

        var self = this;

        var image_html = '<img src="' + image_uri + '" width="1180" height="250" alt="Jonathan \'J5\' Harris">';
        var tmp_fname = this.extract_filename(image_uri);

        tmp_zindex_alpha = $('#' + dom_element_alpha).css( "zIndex" );
        tmp_zindex_beta = $('#' + dom_element_beta).css( "zIndex" );

        if(tmp_zindex_alpha < tmp_zindex_beta){

            $('#' + dom_element_alpha).animate({
                opacity: 0
            }, {
                duration: 0,
                queue: false,
                step: function( now, fx ) {

                },
                complete: function () {

                    $('#' + dom_element_alpha).html(image_html);

                    self.log_activity('[lnum 4229] LOAD [' + tmp_fname + '] INTO ALPHA, where Z=' + tmp_zindex_alpha + ' OPACITY=' + $('#' + dom_element_alpha).css('opacity') + '.', self.CRNRSTN_DEBUG_LIFESTYLE_BANNER);

                }

            });

        }else{

            $('#' + dom_element_beta).animate({
                opacity: 0
            }, {
                duration: 0,
                queue: false,
                step: function( now, fx ) {

                },
                complete: function () {

                    $('#' + dom_element_beta).html(image_html);
                    self.log_activity('[lnum 4248] LOAD [' + tmp_fname + '] INTO BETA, where Z=' + tmp_zindex_beta + ' OPACITY=' + $('#' + dom_element_beta).css('opacity') + '.', self.CRNRSTN_DEBUG_LIFESTYLE_BANNER);

                }

            });

        }

    };

    CRNRSTN_JS.prototype.rotate_lifestyle_banner_image = function(){

        //
        // SHIFT LOWER DOM ELEMENT TO HIGHER POSITION AND TRANSITION TO VISIBLE
        this.top_lifestyle_banner_image_container = this.rotate_jony5_lifestyle_image('jony5_banner_lifestyle_alpha', 'jony5_banner_lifestyle_beta');

        //
        // TRACK (SNAP SHOT) STATE FOR BANNER CONTROL REVERSION +/- 1
        // this.jony5_lifestyle_banner_images_ARRAY = [];
        // this.jony5_lifestyle_banner_index_ARRAY = [];
        // this.jony5_lifestyle_banner_sequence_control_ARRAY = [];
        // this.jony5_lifestyle_banner_sequence_position = 0;

        // this.jony5_lifestyle_banner_img_int_sequence_alpha = [];
        // this.jony5_lifestyle_banner_img_int_sequence_beta = [];


    };

    CRNRSTN_JS.prototype.toggle_banner_mode = function(mode = 'pause_play'){

        switch(mode){
            case 'pause_play':

                if(this.jony5_banner_mode == 'PLAY'){

                    this.jony5_banner_mode = 'PAUSE';
                    this.log_activity('[lnum 4285] STOP BANNER IMAGE ROTATION.', this.CRNRSTN_DEBUG_LIFESTYLE_BANNER);
                    this.execution_delay_ui_sync_controller('stop', 'lifestyle_banner_image_rotation');

                }else{

                    this.jony5_banner_mode = 'PLAY';
                    this.log_activity('[lnum 4291] INITIALIZE 7 SECOND TTL ON ELEMENT HOLD - BANNER IMAGE ROTATION.', this.CRNRSTN_DEBUG_LIFESTYLE_BANNER);
                    this.execution_delay_ui_sync_controller('schedule', 'lifestyle_banner_image_rotation', 7);

                }

                this.jony5_lifestyle_play_button_mode();

            break;
            case 'forward':

                this.log_activity('[lnum 4301] ADVANCE ONE (1) BANNER IMAGE.', this.CRNRSTN_DEBUG_LIFESTYLE_BANNER);
                this.jony5_lifestyle_advance_button('forward');

            break;
            case 'back':

                this.log_activity('[lnum 4307] REVERSE ONE (1) BANNER IMAGE.', this.CRNRSTN_DEBUG_LIFESTYLE_BANNER);
                this.jony5_lifestyle_advance_button('back');

            break;

        }

    };

    CRNRSTN_JS.prototype.jony5_lifestyle_advance_button = function(mode){

        switch(mode){
            case 'forward':

                this.jony5_lifestyle_advance(mode);

            break;
            case 'back':

                this.jony5_lifestyle_advance(mode, -1);

            break;

        }

    };

    CRNRSTN_JS.prototype.jony5_lifestyle_banner_tmp_transition = function(){

        var self = this;

        tmp_zindex_alpha = $('#jony5_banner_lifestyle_alpha').css( "zIndex" );
        tmp_zindex_beta = $('#jony5_banner_lifestyle_beta').css( "zIndex" );
        tmp_zindex_trans = $('#jony5_banner_lifestyle_transition_tmp').css( "zIndex" );

        this.log_activity('[lnum 4342] PRE-TRANSITION Z-INDICES tmp_zindex_trans=[' + tmp_zindex_trans + '] tmp_zindex_alpha=[' + tmp_zindex_alpha + '] tmp_zindex_beta=[' + tmp_zindex_beta + ']', this.CRNRSTN_DEBUG_VERBOSE);

        if(tmp_zindex_alpha < tmp_zindex_beta){

            //
            // OPACITY 0 THE TOP ELEM (ALPHA OR BETA)
            $( "#jony5_banner_lifestyle_beta").animate({
                opacity: 0.0
            }, {
                duration: 0,
                queue: false,
                specialEasing: {
                    opacity: "swing"
                },
                step: function( now, fx ) {

                },
                complete: function () {

                    //
                    // SWAP POSITIONS WITH THE TOP ELEM AND THE TMP TRANS ELEM
                    $('#jony5_banner_lifestyle_transition_tmp').css('zIndex', tmp_zindex_beta);
                    $('#jony5_banner_lifestyle_beta').css('zIndex', tmp_zindex_trans);

                    tmp_zindex_alpha = $('#jony5_banner_lifestyle_alpha').css( "zIndex" );
                    tmp_zindex_beta = $('#jony5_banner_lifestyle_beta').css( "zIndex" );
                    tmp_zindex_trans = $('#jony5_banner_lifestyle_transition_tmp').css( "zIndex" );

                    self.log_activity('[lnum 4370] MID-TRANSITION Z-INDICES tmp_zindex_trans=[' + tmp_zindex_trans + '] tmp_zindex_alpha=[' + tmp_zindex_alpha + '] tmp_zindex_beta=[' + tmp_zindex_beta + ']', self.CRNRSTN_DEBUG_VERBOSE);

                    //
                    // OPACITY TO 1.0 THE TOP ELEM
                    $('#jony5_banner_lifestyle_beta').animate({
                        opacity: 1.0
                    }, {
                        duration: 1000,
                        queue: false,
                        step: function( now, fx ) {

                        },
                        complete: function () {

                            //
                            // EMPTY THE TMP TRANS ELEM
                            $('#jony5_banner_lifestyle_transition_tmp').html('');

                            //
                            // TRANSITION THE TMP BACK TO TOP (WILL THIS BLOCK BUTTON CONTROL ACCESS?)
                            $('#jony5_banner_lifestyle_transition_tmp').css('zIndex', tmp_zindex_beta);
                            $('#jony5_banner_lifestyle_beta').css('zIndex', tmp_zindex_trans);

                            $('#jony5_banner_lifestyle_alpha').animate({
                                opacity: 0
                            }, {
                                duration: 0,
                                queue: false,
                                step: function( now, fx ) {

                                },
                                complete: function () {


                                }

                            });

                        }

                    });

                }
            });

        }else{

            //
            // OPACITY 0 THE TOP ELEM (ALPHA OR BETA)
            $( "#jony5_banner_lifestyle_alpha").animate({
                opacity: 0.0
            }, {
                duration: 0,
                queue: false,
                specialEasing: {
                    opacity: "swing"
                },
                step: function( now, fx ) {

                },
                complete: function () {

                    //
                    // SWAP POSITIONS WITH THE TOP ELEM AND THE TMP TRANS ELEM
                    $('#jony5_banner_lifestyle_transition_tmp').css('zIndex', tmp_zindex_alpha);
                    $('#jony5_banner_lifestyle_alpha').css('zIndex', tmp_zindex_trans);

                    tmp_zindex_alpha = $('#jony5_banner_lifestyle_alpha').css( "zIndex" );
                    tmp_zindex_beta = $('#jony5_banner_lifestyle_beta').css( "zIndex" );
                    tmp_zindex_trans = $('#jony5_banner_lifestyle_transition_tmp').css( "zIndex" );

                    self.log_activity('[lnum 4441] MID-TRANSITION Z-INDICES tmp_zindex_trans=[' + tmp_zindex_trans + '] tmp_zindex_alpha=[' + tmp_zindex_alpha + '] tmp_zindex_beta=[' + tmp_zindex_beta + ']', self.CRNRSTN_DEBUG_VERBOSE);

                    //
                    // OPACITY TO 1.0 THE TOP ELEM
                    $('#jony5_banner_lifestyle_alpha').animate({
                        opacity: 1.0
                    }, {
                        duration: 1000,
                        queue: false,
                        step: function( now, fx ) {

                        },
                        complete: function () {

                            //
                            // EMPTY THE TMP TRANS ELEM
                            $('#jony5_banner_lifestyle_transition_tmp').html('');

                            //
                            // TRANSITION THE TMP BACK TO TOP (WILL THIS BLOCK BUTTON CONTROL ACCESS?)
                            $('#jony5_banner_lifestyle_transition_tmp').css('zIndex', tmp_zindex_alpha);
                            $('#jony5_banner_lifestyle_alpha').css('zIndex', tmp_zindex_trans);

                            $('#jony5_banner_lifestyle_beta').animate({
                                opacity: 0
                            }, {
                                duration: 0,
                                queue: false,
                                step: function( now, fx ) {

                                },
                                complete: function () {


                                }

                            });

                        }

                    });

                }

            });

        }

        tmp_zindex_alpha = $('#jony5_banner_lifestyle_alpha').css( "zIndex" );
        tmp_zindex_beta = $('#jony5_banner_lifestyle_beta').css( "zIndex" );
        tmp_zindex_trans = $('#jony5_banner_lifestyle_transition_tmp').css( "zIndex" );

        this.log_activity('[lnum 4493] POST-TRANSITION Z-INDICES tmp_zindex_trans=[' + tmp_zindex_trans + '] tmp_zindex_alpha=[' + tmp_zindex_alpha + '] tmp_zindex_beta=[' + tmp_zindex_beta + ']', this.CRNRSTN_DEBUG_VERBOSE);

    };

    CRNRSTN_JS.prototype.jony5_lifestyle_advance = function(mode, delta = 1){

        switch(mode){
            case 'forward':

            break;
            case 'back':

                this.back_press_cnt = this.back_press_cnt + 1;
                //this.jony5_lifestyle_banner_sequence_position--;

                // this.execution_delay_ui_sync_controller('stop', 'lifestyle_banner_image_rotation');
                //
                // this.back_press_cnt = self.back_press_cnt + 3;
                //
                // this.jony5_lifestyle_banner_sequence_position = this.jony5_lifestyle_banner_sequence_position - 3;
                //
                // if(this.jony5_lifestyle_banner_sequence_position > 0){
                //
                //     this.init_ui_input_control_state('back_btn_banner', 'ON');
                //
                // }else{
                //
                //     this.init_ui_input_control_state('back_btn_banner', 'OFF');
                //
                // }
                //
                // if(this.jony5_lifestyle_banner_sequence_position < this.jony5_lifestyle_banner_sequence_control_ARRAY.length){
                //
                //     this.init_ui_input_control_state('forward_btn_banner', 'ON');
                //
                // }else{
                //
                //     this.init_ui_input_control_state('forward_btn_banner', 'OFF');
                //
                // }
                //
                // var tmp_str = this.extract_filename(this.jony5_lifestyle_banner_sequence_control_ARRAY[this.jony5_lifestyle_banner_sequence_position]);
                // this.log_activity('[lnum 4535] BACK CLICKED. NEW (-3) SEQ POS=[' + this.jony5_lifestyle_banner_sequence_position + '] IMAGE AT SEQ POS[' + tmp_str + '] SEQ-IMAGE-CNT[' + this.jony5_lifestyle_banner_sequence_control_ARRAY.length + ']', this.CRNRSTN_DEBUG_LIFESTYLE_BANNER);
                //
                // this.load_image_lowest_z_indice('jony5_banner_lifestyle_alpha', 'jony5_banner_lifestyle_beta', this.jony5_lifestyle_banner_sequence_control_ARRAY[this.jony5_lifestyle_banner_sequence_position]);
                //
                // this.transition_lifestyle_banner_elem('jony5_banner_lifestyle_alpha', 'jony5_banner_lifestyle_beta');
                //

                ////this.execution_delay_ui_sync_controller('fire', 'lifestyle_banner_image_rotation');

                break;

        }

        //
        // MOVE TOP DOM ELEM CONTENT TO TEMP CONTAINER TO TEMP TOP CONTAINER
        $('#jony5_banner_lifestyle_transition_tmp').html($('#' + this.top_lifestyle_banner_image_container).html());

        //
        // RESET ALPHA AND BETA CONTAINERS TO PREV/NEXT STATE
        this.jony5_lifestyle_banner_state_revert(delta);

        //
        // FIRE TRANSITION ("OPACITY OUT" TEMP CONTAINER)
        this.jony5_lifestyle_banner_tmp_transition();

        //
        // HIDE/SHOW BUTTONS (FWD OR BACK) IF AT THRESHOLD
        var result = this.jony5_lifestyle_banner_sequence_control_ARRAY.length - this.jony5_lifestyle_banner_sequence_position - this.back_press_cnt - 2;

        if((result != 0) && (result < this.jony5_lifestyle_banner_sequence_control_ARRAY.length)){

            this.log_activity('[lnum 4566] VISIBILITY FWD BUTTON banner_sequence_position=[' + this.jony5_lifestyle_banner_sequence_position + ']', this.CRNRSTN_DEBUG_VERBOSE);

            this.init_ui_input_control_state('forward_btn_banner', 'ON');

        }else{

            this.log_activity('[lnum 4572] VISIBILITY FWD BUTTON banner_sequence_position=[' + this.jony5_lifestyle_banner_sequence_position + ']', this.CRNRSTN_DEBUG_VERBOSE);

            this.init_ui_input_control_state('forward_btn_banner', 'OFF');

        }

        if(this.jony5_lifestyle_banner_sequence_position > 2){

            this.log_activity('[lnum 4580] VISIBILITY BACK BUTTON banner_sequence_position=[' + this.jony5_lifestyle_banner_sequence_position + ']', this.CRNRSTN_DEBUG_VERBOSE);

            this.init_ui_input_control_state('back_btn_banner', 'ON');

        }else{

            this.log_activity('[lnum 4586] VISIBILITY BACK BUTTON banner_sequence_position=[' + this.jony5_lifestyle_banner_sequence_position + ']', this.CRNRSTN_DEBUG_VERBOSE);

            this.init_ui_input_control_state('back_btn_banner', 'OFF');

        }

    };

    CRNRSTN_JS.prototype.jony5_lifestyle_banner_state_revert = function(delta){

        this.jony5_lifestyle_banner_sequence_position = this.jony5_lifestyle_banner_sequence_position + delta;

        //
        // SET ALPHA AND BETA Z-INDEX - JUST FLIP MODE SQUAD
        tmp_zindex_alpha = $('#jony5_banner_lifestyle_alpha').css( "zIndex" );
        tmp_zindex_beta = $('#jony5_banner_lifestyle_beta').css( "zIndex" );
        $('#jony5_banner_lifestyle_alpha').css('zIndex', tmp_zindex_beta);
        $('#jony5_banner_lifestyle_beta').css('zIndex', tmp_zindex_alpha);

        //
        // SET ALPHA AND BETA CONTENT TO THE STATE INDICATED BY THE "NOW" CURRENT POSITION
        var index_img_seq_int_alpha = this.jony5_lifestyle_banner_img_int_sequence_alpha[this.jony5_lifestyle_banner_sequence_position - 2]
        var index_img_seq_int_beta = this.jony5_lifestyle_banner_img_int_sequence_beta[this.jony5_lifestyle_banner_sequence_position - 2]

        var image_uri_alpha = this.jony5_lifestyle_banner_images_ARRAY[index_img_seq_int_alpha];
        var image_uri_beta = this.jony5_lifestyle_banner_images_ARRAY[index_img_seq_int_beta];

        this.log_activity('[lnum 4613] BANNER STATE REVERSION DELTA[' + delta + '] index/img alpha=[' + index_img_seq_int_alpha + '/' + image_uri_alpha + '] index/img beta=[' + index_img_seq_int_beta + '/' + image_uri_beta + ']', this.CRNRSTN_DEBUG_VERBOSE);

        var image_html_alpha = '<img src="' + image_uri_alpha + '" width="1180" height="250" alt="Jonathan \'J5\' Harris">';
        var image_html_beta = '<img src="' + image_uri_beta + '" width="1180" height="250" alt="Jonathan \'J5\' Harris">';

        $('#jony5_banner_lifestyle_alpha').html(image_html_alpha);
        $('#jony5_banner_lifestyle_beta').html(image_html_beta);

    };

    CRNRSTN_JS.prototype.jony5_lifestyle_play_button_mode = function(){

        switch(this.jony5_banner_mode){
            case 'PAUSE':

                $( "#banner_control_pause_wrapper").animate({
                    opacity: 0.0
                }, {
                    duration: 0,
                    queue: false,
                    specialEasing: {
                        opacity: "swing"
                    },
                    step: function( now, fx ) {

                    },
                    complete: function () {

                    }
                });

                $( "#banner_control_play_wrapper").animate({
                    opacity: 1.0
                }, {
                    duration: 0,
                    queue: false,
                    specialEasing: {
                        opacity: "swing"
                    },
                    step: function( now, fx ) {

                    },
                    complete: function () {

                    }
                });

            break;
            default:
               // PAUSE
                $( "#banner_control_play_wrapper").animate({
                    opacity: 0.0
                }, {
                    duration: 0,
                    queue: false,
                    specialEasing: {
                        opacity: "swing"
                    },
                    step: function( now, fx ) {

                    },
                    complete: function () {

                    }
                });

                $( "#banner_control_pause_wrapper").animate({
                    opacity: 1.0
                }, {
                    duration: 0,
                    queue: false,
                    specialEasing: {
                        opacity: "swing"
                    },
                    step: function( now, fx ) {

                    },
                    complete: function () {

                    }
                });

            break;

        }

    };

    CRNRSTN_JS.prototype.sign_in_form_submit_via_micro_expansion = function(){

        // crnrstn_ui_interact_wrapper
        // [current=bottom:5px; width: 100px; left: 84%; height: 80px;]
        // [target=1085wx756h]

        // crnrstn_ui_interact_bg_border
        // [current=width:260px; height: 305px;]
        // [target=1085wx756h]

        // crnrstn_ui_interact_bg_solid
        // [current=width: 85px; height:46px; margin: 8px; padding: 11px 0 0 2px; cursor: pointer;]
        // [target=260wx305h]

        $( "#crnrstn_ui_interact_content_wrapper").toggle();
        $( "#crnrstn_ui_interact_bg_solid").html('');

        $( "#crnrstn_ui_interact_wrapper").animate({
            height: 756,
            width: 1085,
            bottom: 20,
            left: '20%'
        }, {
            duration: 250,
            queue: false,
            specialEasing: {
                opacity: "swing"
            },
            step: function( now, fx ) {

            },
            complete: function () {

            }
        });

        $( "#crnrstn_ui_interact_bg_border").animate({
            height: 756,
            width: 1085
        }, {
            duration: 250,
            queue: false,
            specialEasing: {
                opacity: "swing"
            },
            step: function( now, fx ) {

            },
            complete: function () {


            }

        });

        $( "#crnrstn_ui_interact_bg_solid").animate({
            height: 736,
            width: 1060
        }, {
            duration: 250,
            queue: false,
            specialEasing: {
                opacity: "swing"
            },
            step: function( now, fx ) {

            },
            complete: function () {

                $( "#crnrstn_ui_interact_wrapper").animate({
                    height: 756,
                    width: 1085,
                    bottom: 20,
                    left: '20%'
                }, {
                    duration: 250,
                    queue: false,
                    specialEasing: {
                        opacity: "swing"
                    },
                    step: function( now, fx ) {

                    },
                    complete: function () {

                    }
                });

                $( "#crnrstn_ui_interact_bg_border").animate({
                    height: 756,
                    width: 1085
                }, {
                    duration: 150,
                    queue: false,
                    specialEasing: {
                        opacity: "swing"
                    },
                    step: function( now, fx ) {

                    },
                    complete: function () {

                    }
                });

            }
        });

    };

    CRNRSTN_JS.prototype.sign_in_transition_via_micro_expansion = function(){

        this.log_activity('[lnum 4813] [MOUSE CLICK] CRNRSTN :: UI INTERACT MODULE BEGIN SIGN IN FORM EXPANSION', oCRNRSTN_JS.CRNRSTN_DEBUG_VERBOSE);

        // crnrstn_ui_interact_wrapper
        // [current=bottom:5px; width: 100px; left: 84%; height: 80px;]
        // [target=260wx305h]

        // crnrstn_ui_interact_bg_border
        // [current=width:100px; height: 70px;]
        // [target=260wx305h]

        // crnrstn_ui_interact_bg_solid
        // [current=width: 85px; height:46px; margin: 8px; padding: 11px 0 0 2px; cursor: pointer;]
        // [target=260wx305h]

        $( "#crnrstn_ui_interact_wrapper").animate({
            height: 315,
            width: 270,
            bottom: 20,
            left: '70%'
        }, {
            duration: 250,
            queue: false,
            specialEasing: {
                opacity: "swing"
            },
            step: function( now, fx ) {

            },
            complete: function () {

            }
        });

        $( "#crnrstn_ui_interact_bg_border").animate({
            height: 315,
            width: 270
        }, {
            duration: 250,
            queue: false,
            specialEasing: {
                opacity: "swing"
            },
            step: function( now, fx ) {

            },
            complete: function () {

            }
        });

        $( "#crnrstn_ui_interact_bg_solid").animate({
            height: 291,
            width: 255
        }, {
            duration: 250,
            queue: false,
            specialEasing: {
                opacity: "swing"
            },
            step: function( now, fx ) {

            },
            complete: function () {

            }
        });

        $( "#crnrstn_messenger_message_bubbles_thumb").animate({
            height: 116,
            width: 182,
            paddingTop:170,
            paddingLeft:38
        }, {
            duration: 250,
            queue: false,
            specialEasing: {
                opacity: "swing"
            },
            step: function( now, fx ) {

            },
            complete: function () {

                $( "#crnrstn_ui_interact_wrapper").animate({
                    height: 305,
                    width: 260,
                    bottom: 15,
                    left: '71%'
                }, {
                    duration: 150,
                    queue: false,
                    specialEasing: {
                        opacity: "swing"
                    },
                    step: function( now, fx ) {

                    },
                    complete: function () {

                    }
                });

                $( "#crnrstn_ui_interact_bg_border").animate({
                    height: 305,
                    width: 260
                }, {
                    duration: 150,
                    queue: false,
                    specialEasing: {
                        opacity: "swing"
                    },
                    step: function( now, fx ) {

                    },
                    complete: function () {

                    }
                });

                $( "#crnrstn_ui_interact_bg_solid").animate({
                    height: 281,
                    width: 245
                }, {
                    duration: 150,
                    queue: false,
                    specialEasing: {
                        opacity: "swing"
                    },
                    step: function( now, fx ) {

                    },
                    complete: function () {

                    }
                });

                $( "#crnrstn_messenger_message_bubbles_thumb").animate({
                    height: 106,
                    width: 172,
                    paddingTop:164,
                    paddingLeft:41
                }, {
                    duration: 150,
                    queue: false,
                    specialEasing: {
                        opacity: "swing"
                    },
                    step: function( now, fx ) {

                    },
                    complete: function () {


                    }
                });

                //
                // INJECT SIGN IN FORM ELEMENTS
                $( "#crnrstn_ui_interact_content_wrapper").toggle();

                $('#crnrstn_ui_interact_bg_solid').css('cursor', 'auto');

            }

        });

    };

    CRNRSTN_JS.prototype.primary_ui_interact_nav_state_shift = function(dom_handle_root, dom_handle_variant_element, dom_handle_postfix, element_exclude = ''){

        /*
        Z INDEX OF 66 ASSIGNED TO PARENT CONTAINER...BUT MAY BE LOWER THAN MESSAGING ICON BUTTON...JUST SAYING...

        SET TRANSITION-TO-VISIBLE SCOPE TO 68
        SET STAGE SCOPE TO 67
        SET ALL HIDDEN Z-INDEX TO 66.

                                dom_handle_root             dom_handle_variant_element     dom_handle_postfix
        Z-INDEX = auto = <div id="crnrstn_ui_interact_primary_nav_img_shell_ menu _inactive">
        Z-INDEX = auto = <div id="crnrstn_ui_interact_primary_nav_img_shell_ menu _hvr">
        Z-INDEX = auto = <div id="crnrstn_ui_interact_primary_nav_img_shell_ menu _click">
        Z-INDEX = 68 = <div id="crnrstn_ui_interact_primary_nav_img_shell_ menu ">

        */

        var system_nav_state_ARRAY = ['_inactive', '_hvr', '_click',  ''];
        var current_z_index_state_ARRAY = [];
        var tmp_z_index = 0;
        var skip_transition = false;

        //
        // TRANSITION TO HIGHEST Z INDEX THEN OPACITY 1 target_dom_handle

        //
        // CLEAR HIGHEST Z-INDEX FOR TRANSITION
        tmp_state_cnt = system_nav_state_ARRAY.length;
        this.log_activity('[lnum 5009] zIndex shift for all ' +  dom_handle_root + dom_handle_variant_element + '.', oCRNRSTN_JS.CRNRSTN_DEBUG_VERBOSE);

        for(let i = 0; i < tmp_state_cnt; i++){

            tmp_z_index = $('#' + dom_handle_root + dom_handle_variant_element + system_nav_state_ARRAY[i]).css('zIndex');
            tmp_tgt_z = parseInt(this.baseline_z_index) + 7;
            if(tmp_z_index > tmp_tgt_z){

                tmp_str = system_nav_state_ARRAY[i];

                if(tmp_str.length > 0 || (element_exclude != dom_handle_root + dom_handle_variant_element)){

                    //
                    // SET TO 67 Z INDEX FOR STAGING IN 68
                    $('#' + dom_handle_root + dom_handle_variant_element + system_nav_state_ARRAY[i]).css('zIndex', tmp_tgt_z);
                    this.log_activity('[lnum 5024] zIndex shift for HIGHEST AT 68 [' + dom_handle_root + dom_handle_variant_element + system_nav_state_ARRAY[i] + '].', oCRNRSTN_JS.CRNRSTN_DEBUG_VERBOSE);

                }else{

                    //
                    // DEFAULT IMAGERY IS ON TOP. LEAVE IT.
                    skip_transition = true;

                }

            }else{

                //$tmp_str = dom_handle_root + dom_handle_variant_element + dom_handle_postfix;

                //if($tmp_str != ){
                tmp_tgt_z = parseInt(this.baseline_z_index) + 6;
                $('#' + dom_handle_root + dom_handle_variant_element + system_nav_state_ARRAY[i]).css('zIndex', tmp_tgt_z);
                this.log_activity('[lnum 5041] zIndex shift TO 66 FOR OTHERS [' + dom_handle_root + dom_handle_variant_element + system_nav_state_ARRAY[i] + '].', oCRNRSTN_JS.CRNRSTN_DEBUG_VERBOSE);

                //}

            }

            //current_z_index_state_ARRAY[dom_handle_root + dom_handle_variant_element + system_nav_state_ARRAY[i]] =
            this.log_activity('[lnum 5048] current_z_index_state_ARRAY[' + dom_handle_root + dom_handle_variant_element + system_nav_state_ARRAY[i] + '] = ' + $('#' + dom_handle_root + dom_handle_variant_element + system_nav_state_ARRAY[i]).css('zIndex') + '.', oCRNRSTN_JS.CRNRSTN_DEBUG_VERBOSE);

        }

        if(!skip_transition){

            //
            // CALL TRANSITION.
            this.primary_ui_interact_transition_nav_state(dom_handle_root, dom_handle_variant_element, dom_handle_postfix);

        }

    };

    CRNRSTN_JS.prototype.primary_ui_interact_transition_nav_state = function(dom_handle_root, dom_handle_variant_element, dom_handle_postfix){

        var self = this;

        //
        //  SET OPACITY TO O
        $('#' + dom_handle_root + dom_handle_variant_element + dom_handle_postfix).animate({
            opacity: 0
        }, {
            duration: 0,
            queue: false,
            step: function( now, fx ) {

            },
            complete: function () {

                tmp_tgt_z = parseInt(this.baseline_z_index) + 8;
                $('#' + dom_handle_root + dom_handle_variant_element + dom_handle_postfix).css('zIndex', tmp_tgt_z);

                self.log_activity('[lnum 5081] SHOW ' + '#' + dom_handle_root + dom_handle_variant_element + dom_handle_postfix, oCRNRSTN_JS.CRNRSTN_DEBUG_VERBOSE);

                $('#' + dom_handle_root + dom_handle_variant_element + dom_handle_postfix).animate({
                    opacity: 1.0
                }, {
                    duration: 250,
                    queue: false,
                    specialEasing: {
                        opacity: "swing"
                    },
                    step: function( now, fx ) {

                    },
                    complete: function () {

                        self.dom_element_mouse_state_lock_ARRAY[dom_handle_root + dom_handle_variant_element] = 'OFF';

                        self.log_activity('[lnum 5098] REMOVE dom_element_mouse_state_lock_ARRAY LOCK ON [' + '#' + dom_handle_root + dom_handle_variant_element + ']', oCRNRSTN_JS.CRNRSTN_DEBUG_VERBOSE);

                    }

                });

            }

        });

    };

    CRNRSTN_JS.prototype.crnrstn_ui_interact_ux = function(ux_action, elem){

        /*

        <div id="crnrstn_ui_interact_primary_nav_menu" class="crnrstn_ui_interact_primary_navgroup_lnk_border">

            <div id="crnrstn_ui_interact_primary_nav_img_shell_menu_inactive" class="crnrstn_ui_interact_primary_nav_img_shell"><img src="../../../_crnrstn/ui/imgs/png/primary_nav_seriesblue00_120x120_menu_inactive.png" width="40" height="40" alt="Menu" title="Navigation to Menu"></div>
            <div id="crnrstn_ui_interact_primary_nav_img_shell_menu_hvr"  class="crnrstn_ui_interact_primary_nav_img_shell"><img src="../../../_crnrstn/ui/imgs/png/primary_nav_seriesblue00_120x120_menu_hvr.png" width="40" height="40" alt="Menu" title="Navigation to Menu"></div>
            <div id="crnrstn_ui_interact_primary_nav_img_shell_menu_click"  class="crnrstn_ui_interact_primary_nav_img_shell"><img src="../../../_crnrstn/ui/imgs/png/primary_nav_seriesblue00_120x120_menu_click.png" width="40" height="40" alt="Menu" title="Navigation to Menu"></div>
            <div id="crnrstn_ui_interact_primary_nav_img_shell_menu"  class="crnrstn_ui_interact_primary_nav_img_shell crnrstn_ui_interact_active"><img src="../../../_crnrstn/ui/imgs/png/primary_nav_seriesblue00_120x120_menu.png" width="40" height="40" alt="Menu" title="Navigation to Menu"></div>

            <div id="crnrstn_ui_interact_primary_nav_img_shell_menu_glass_case"  class="crnrstn_ui_interact_primary_nav_glass_case" onmouseover="oCRNRSTN_JS.crnrstn_ui_interact_ux('onmouseover', this);" onmouseout="oCRNRSTN_JS.crnrstn_ui_interact_ux('onmouseout', this);" onmousedown="oCRNRSTN_JS.crnrstn_ui_interact_ux('onmousedown', this);" onmouseup="oCRNRSTN_JS.crnrstn_ui_interact_ux('onmouseup', this);"><img src="../../../_crnrstn/ui/imgs/gif/x.gif" width="40" height="40" alt="Menu" title="Navigation to Menu"></div>

        </div>

        this.ui_interact_input_id_ARRAY = ['crnrstn_ui_interact_primary_nav_img_shell_menu_glass_case', 'crnrstn_ui_interact_primary_nav_img_shell_close_x_glass_case', 'crnrstn_ui_interact_primary_nav_img_shell_fs_expand_glass_case', 'crnrstn_ui_interact_primary_nav_img_shell_minimize_glass_case'];
        this.ui_interact_input_type_ARRAY = ['menu', 'close_x', 'fs_expand', 'minimize'];



        <div id="crnrstn_interact_ui_side_nav_logo" class="crnrstn_interact_ui_side_nav_logo" onmouseover="oCRNRSTN_JS.crnrstn_ui_interact_ux(\'onmouseover\', this);" onmouseout="oCRNRSTN_JS.crnrstn_ui_interact_ux(\'onmouseout\', this);" onclick="oCRNRSTN_JS.crnrstn_ui_interact_ux(\'onclick\', this);">' . $this->oCRNRSTN->return_system_image('CRNRSTN_LOGO', 40, '', '', '', '', NULL, CRNRSTN_UI_IMG_BASE64_PNG_HTML_WRAPPED) . '</div>

        */

        switch(elem.id){
            case 'crnrstn_ui_interact_primary_nav_img_shell_menu_glass_case':

                //dom_handle_variant_element = 'menu';

            break;
            case 'crnrstn_ui_interact_primary_nav_img_shell_close_x_glass_case':

                //dom_handle_variant_element = 'close_x';

            break;
            case 'crnrstn_ui_interact_primary_nav_img_shell_fs_expand_glass_case':

                //dom_handle_variant_element = 'fs_expand';

            break;
            case 'crnrstn_ui_interact_primary_nav_img_shell_minimize_glass_case':

                //dom_handle_variant_element = 'minimize';

            break;
            case 'crnrstn_interact_ui_side_nav_logo':

                switch(ux_action){
                    case 'onmouseover':

                        //this.log_activity('[lnum 5434] ' + ux_action + ' FIRED ON [' + '#' + elem.id + '].', oCRNRSTN_JS.CRNRSTN_DEBUG_VERBOSE);

                        // ACTIVE MOUSEOVER (HOVER STATE)
                        //$('#crnrstn_interact_ui_side_nav_logo_img_bg').css('backgroundColor', '#b4b4b4');   // f8f8f8
                        $('#crnrstn_interact_ui_side_nav_logo_bar').css('width', parseInt('4'));
                        $('#crnrstn_interact_ui_side_nav_logo_bar').css('backgroundColor', '#F90000');
                        $('#crnrstn_interact_ui_side_nav_logo').css('borderColor', '#F90000');

                        $('#crnrstn_interact_ui_side_nav_logo_img_bg').animate({
                            opacity: 1.0
                        }, {
                            duration: 100,
                            queue: false,
                            specialEasing: {
                                opacity: "swing"
                            },
                            complete: function () {

                            }

                        });

                        //$('#crnrstn_interact_ui_side_nav_logo').css('backgroundColor', '#FFF');

                    break;
                    case 'onmouseout':

                        //this.log_activity('[lnum 5441] ' + ux_action + ' FIRED ON [' + '#' + elem.id + '].', oCRNRSTN_JS.CRNRSTN_DEBUG_VERBOSE);

                        // ACTIVE MOUSEOUT (BACK TO NORMAL)
                        //$('#crnrstn_interact_ui_side_nav_logo_img_bg').css('backgroundColor', '#FFF');
                        $('#crnrstn_interact_ui_side_nav_logo_bar').css('width', parseInt('2'));
                        $('#crnrstn_interact_ui_side_nav_logo_bar').css('backgroundColor', '#A5B9D8');
                        $('#crnrstn_interact_ui_side_nav_logo').css('borderColor', '#A5B9D8');

                        $('#crnrstn_interact_ui_side_nav_logo_img_bg').animate({
                            opacity: 0.2
                        }, {
                            duration: 100,
                            queue: false,
                            specialEasing: {
                                opacity: "swing"
                            },
                            complete: function () {

                            }

                        });

                        //$('#crnrstn_interact_ui_side_nav_logo').css('backgroundColor', 'transparent');

                    break;
                    case 'onmousedown':

                    break;
                    case 'onmouseup':

                    break;
                    case 'onclick':

                        this.toggle_documentation_side_navigation();

                    break;

                }

            break;
            default:

                this.log_activity('[lnum 5155] [ACTION=' + ux_action + '] CRNRSTN :: UI INTERACT UNKNOWN ELEMENT ID [' + elem.id + ']', oCRNRSTN_JS.CRNRSTN_DEBUG_VERBOSE);

            break;

        }

        switch(ux_action){
            case 'onmouseover':

            break;
            case 'onmouseout':

            break;
            case 'onmousedown':

            break;
            case 'onmouseup':

            break;

        }

        return true;

    };

    CRNRSTN_JS.prototype.string_clean_css_px_int = function(css_pixel_int_string){

        var tmp_css_pixel_ARRAY = css_pixel_int_string.split('px');
        css_pixel = tmp_css_pixel_ARRAY[0];

        return css_pixel;

    }

    CRNRSTN_JS.prototype.toggle_documentation_side_navigation = function(){

        var css_int = this.string_clean_css_px_int($('#crnrstn_interact_ui_side_nav').css('width'));

        if(css_int > this.side_navigation_min_width + 35){

            //
            // CLOSE SIDE NAVIGATION
            $('#crnrstn_interact_ui_side_nav').animate({
                width: parseInt(this.side_navigation_min_width)
            }, {
                duration: 500,
                queue: false,
                specialEasing: {
                    opacity: "swing"
                },
                complete: function () {

                }

            });

            $('#crnrstn_interact_ui_side_nav_logo').animate({
                left: 18
            }, {
                duration: 500,
                queue: false,
                specialEasing: {
                    opacity: "swing"
                },
                complete: function () {

                }

            });

            //var b_width = parseInt($('body').width()) - parseInt(this.side_navigation_toggle_expand_width);

            $('body').animate({
                marginLeft: parseInt(this.side_navigation_min_width)
            }, {
                duration: 500,
                queue: false,
                specialEasing: {
                    opacity: "swing"
                },
                complete: function () {

                }

            });

            return true;

        }

        //
        // EXPAND NAVIGATION
        $('#crnrstn_interact_ui_side_nav').animate({
            width: parseInt(this.side_navigation_toggle_expand_width)
        }, {
            duration: 100,
            queue: false,
            specialEasing: {
                opacity: "swing"
            },
            step: function( now, fx ) {

            },
            complete: function () {

            }

        });


        $('#crnrstn_interact_ui_side_nav_logo').animate({
            left: parseInt(this.side_navigation_toggle_expand_width)
        }, {
            duration: 100,
            queue: false,
            specialEasing: {
                opacity: "swing"
            },
            complete: function () {

            }

        });

        //var b_width = parseInt($('body').width()) - parseInt(this.side_navigation_toggle_expand_width);

        $('body').animate({
            marginLeft: parseInt(this.side_navigation_toggle_expand_width)
        }, {
            duration: 100,
            queue: false,
            specialEasing: {
                opacity: "swing"
            },
            complete: function () {

            }

        });

        return true;

    };

    CRNRSTN_JS.prototype.____crnrstn_ui_interact_ux = function(ux_action, elem){

        var dom_handle_postfix = '';
        var dom_handle_variant_element = '';

        var element_id = elem.id;

        switch(element_id){
            case 'crnrstn_ui_interact_primary_nav_img_shell_menu_glass_case':

                dom_handle_variant_element = 'menu';

            break;
            case 'crnrstn_ui_interact_primary_nav_img_shell_close_x_glass_case':

                dom_handle_variant_element = 'close_x';

            break;
            case 'crnrstn_ui_interact_primary_nav_img_shell_fs_expand_glass_case':

                dom_handle_variant_element = 'fs_expand';

            break;
            case 'crnrstn_ui_interact_primary_nav_img_shell_minimize_glass_case':

                dom_handle_variant_element = 'minimize';

            break;
            default:

                this.log_activity('[lnum 5212] [ACTION=' + ux_action + '] CRNRSTN :: UI INTERACT UNKNOWN ELEMENT ID [' + elem.id + ']', oCRNRSTN_JS.CRNRSTN_DEBUG_VERBOSE);

            break;

        }

        //
        // TODO :: GET THIS INFO THROUGH THE SSDTLA XHR XML RESPONSE
        var element_id_split_ARRAY = element_id.split("crnrstn_ui_interact_primary_nav_img_shell_");
        //dom_handle_variant_element = element_id_split_ARRAY[1];

        var dom_handle_root = 'crnrstn_ui_interact_primary_nav_img_shell_';

        var dom_handle_element = dom_handle_root + dom_handle_variant_element;

        this.log_activity('[lnum 5227] element_id_split_ARRAY[0]=' + element_id_split_ARRAY[0] + '] element_id_split_ARRAY[1]=' + element_id_split_ARRAY[1] + ']', oCRNRSTN_JS.CRNRSTN_DEBUG_VERBOSE);

        if(this.dom_element_mouse_state_lock_ARRAY[dom_handle_element] === 'undefined'){

            alert('[lnum 5231] dom_element_mouse_state_lock_ARRAY is undefined at ' + dom_handle_element + ' for ' + element_id + '.');

        }else{

            if(this.dom_element_mouse_state_lock_ARRAY[dom_handle_element] !== 'ON'){

                switch(ux_action){
                    case 'onmouseover':

                        this.dom_element_mouse_state_tracker_ARRAY[dom_handle_variant_element] = '_hvr';
                        this.dom_element_mouse_state_lock_ARRAY[dom_handle_element] = 'ON';
                        this.log_activity('[lnum 5242] [ACTION=onmouseover on ' + element_id + ']', oCRNRSTN_JS.CRNRSTN_DEBUG_VERBOSE);

                        this.log_activity('[lnum 5244] LOCK ON FOR [' + element_id + ']', oCRNRSTN_JS.CRNRSTN_DEBUG_VERBOSE);

                        dom_handle_postfix = '_hvr';

                        /*
                        <div id="crnrstn_ui_interact_primary_nav_img_shell_menu_inactive" class="crnrstn_ui_interact_primary_nav_img_shell"><img src="../../../_crnrstn/ui/imgs/png/primary_nav_seriesblue00_120x120_menu_inactive.png" width="40" height="40" alt="Menu" title="Navigation to Menu"></div>
                        <div id="crnrstn_ui_interact_primary_nav_img_shell_menu_hvr"  class="crnrstn_ui_interact_primary_nav_img_shell"><img src="../../../_crnrstn/ui/imgs/png/primary_nav_seriesblue00_120x120_menu_hvr.png" width="40" height="40" alt="Menu" title="Navigation to Menu"></div>
                        <div id="crnrstn_ui_interact_primary_nav_img_shell_menu_click"  class="crnrstn_ui_interact_primary_nav_img_shell"><img src="../../../_crnrstn/ui/imgs/png/primary_nav_seriesblue00_120x120_menu_click.png" width="40" height="40" alt="Menu" title="Navigation to Menu"></div>
                        <div id="crnrstn_ui_interact_primary_nav_img_shell_menu"  class="crnrstn_ui_interact_primary_nav_img_shell crnrstn_ui_interact_active"><img src="../../../_crnrstn/ui/imgs/png/primary_nav_seriesblue00_120x120_menu.png" width="40" height="40" alt="Menu" title="Navigation to Menu"></div>

                        */

                        //crnrstn_ui_interact_primary_nav_img_shell_menu_hvr
                        //var ui_interact_primary_nav_dom_ARRAY = ['crnrstn_ui_interact_primary_nav_img_shell_menu', 'crnrstn_ui_interact_primary_nav_img_shell_close_x', 'crnrstn_ui_interact_primary_nav_img_shell_fs_expand'];

                        //tmp_nav_cnt = ui_interact_primary_nav_dom_ARRAY.length;

                        //
                        // TURN OFF ALL OTHER HOVER NAV STATES
                        // for(var i = 0; i < tmp_nav_cnt; i++){
                        //
                        //     if(dom_handle_element != ui_interact_primary_nav_dom_ARRAY[i]){
                        //         var tmp_elem = ui_interact_primary_nav_dom_ARRAY[i];
                        //         element_id_split_ARRAY = tmp_elem.split("crnrstn_ui_interact_primary_nav_img_shell_");
                        //         tmp_element_dom_handle = element_id_split_ARRAY[1];
                        //
                        //         if(this.dom_element_mouse_state_tracker_ARRAY[tmp_element_dom_handle] ===  '_hvr'){
                        //
                        //             this.primary_ui_interact_nav_state_shift(dom_handle_root, tmp_element_dom_handle, '', dom_handle_element);
                        //
                        //         }
                        //
                        //     }
                        //
                        // }

                        this.primary_ui_interact_nav_state_shift(dom_handle_root, dom_handle_variant_element, dom_handle_postfix);

                    break;
                    case 'onmouseout':

                        dom_handle_postfix = '';
                        this.dom_element_mouse_state_tracker_ARRAY[dom_handle_variant_element] = '';
                        this.dom_element_mouse_state_ARRAY[dom_handle_element] = 'ON';

                        this.log_activity('[lnum 5289] [ACTION=onmouseout on ' + element_id + ']', oCRNRSTN_JS.CRNRSTN_DEBUG_VERBOSE);

                        this.primary_ui_interact_nav_state_shift(dom_handle_root, dom_handle_variant_element, dom_handle_postfix);

                    break;
                    case 'onmousedown':

                        dom_handle_postfix = '_click';
                        this.dom_element_mouse_state_tracker_ARRAY[dom_handle_variant_element] = '_click';
                        this.dom_element_mouse_state_lock_ARRAY[dom_handle_element] = 'ON';

                        this.primary_ui_interact_nav_state_shift(dom_handle_root, dom_handle_variant_element, dom_handle_postfix);

                    break;
                    case 'onmouseup':

                        dom_handle_postfix = '';
                        this.dom_element_mouse_state_lock_ARRAY[dom_handle_element] = 'ON';

                        if(this.dom_element_mouse_state_ARRAY[dom_handle_element] === 'MOUSEOVER'){

                            this.dom_element_mouse_state_tracker_ARRAY[dom_handle_variant_element] = '_hvr';
                            this.primary_ui_interact_nav_state_shift(dom_handle_root, dom_handle_variant_element, '_hvr');

                        }else{

                            this.dom_element_mouse_state_tracker_ARRAY[dom_handle_variant_element] = '';
                            this.primary_ui_interact_nav_state_shift(dom_handle_root, dom_handle_variant_element, dom_handle_postfix);

                        }

                    break;

                }

                //
                // FIRE TRANSITION TO TARGET IMAGE WITHIN ACTIVE ELEMENT
                var target_dom_handle = dom_handle_root + dom_handle_variant_element + dom_handle_postfix;
                this.log_activity('[lnum 5327] [ACTION=' + ux_action + '] [target_dom_handle=' + target_dom_handle + '] CRNRSTN :: UI INTERACT (UX) ELEMENT ID [' + elem.id + ']', oCRNRSTN_JS.CRNRSTN_DEBUG_VERBOSE);

            }

        }

        return true;

    };

    CRNRSTN_JS.prototype.return_random_index_int = function(content_ARRAY, type = 'LIFESTYLE_IMG'){

        //
        // NOTE :: IF THIS METHOD IS USED FOR ANY OTHER TYPE OF ARRAY-INDEX-FORCE-UNIQUE-RETURN...UP
        // TO AND INCLUDING ARRAY RESET..., NEED TO IMPLEMENT SERIALIZATION BASED OFF OF THE ADDITIONAL
        // INPUT PARAM, "type" TO AVOID CANNIBALISM OF SINGLE-DIMENSION INDEX SPOILER ARRAY.
        var rand_int = 0;
        var index_cnt = content_ARRAY.length;
        var rand_success = false;

        for(let i = 0; i < index_cnt; i++){

            rand_int = Math.floor(Math.random() * index_cnt);

            //
            // SOURCE :: https://stackoverflow.com/questions/2613192/check-if-an-array-item-is-set-in-js
            // AUTHOR :: Stefan :: https://stackoverflow.com/users/108009/stefan
            if (!(rand_int in this.rand_index_spoiler_ARRAY)){

                rand_success = true;
                this.rand_index_spoiler_ARRAY[rand_int] = 1;
                i = index_cnt + 1;

            }

        }

        if(rand_success){

            return rand_int;

        }else{

            //
            // LOOP THROUGH ARRAY FOR FIRST VIRGIN.
            for(let i = 0; i < index_cnt; i++){

                rand_int = i;

                if (!(rand_int in this.rand_index_spoiler_ARRAY)){

                    rand_success = true;
                    this.rand_index_spoiler_ARRAY[rand_int] = 1;
                    i = index_cnt + 1;

                }

            }

            if(rand_success){

                return rand_int;

            }else{

                //
                // ALL INDICES HAVE BEEN USED. RESET AND CONTINUE.
                this.rand_index_spoiler_ARRAY = [];
                rand_int = Math.floor(Math.random() * index_cnt);
                this.rand_index_spoiler_ARRAY[rand_int] = 1;

                return rand_int;

            }

        }

    };

    CRNRSTN_JS.prototype.plz = function(digit){

        var zpad = digit + '';

        if (digit < 10) {

            zpad = "0" + zpad;

        }

        return zpad;

    };

    // Closing time. :-(
    CRNRSTN_JS.prototype.end = function() {

        this.disableKeyboardNav();
        $(window).off('resize', this.sizeOverlay);
        this.$lightbox.fadeOut(this.options.fadeDuration);
        this.$overlay.fadeOut(this.options.fadeDuration);

        if (this.options.disableScrolling) {

            $('body').removeClass('lb-disable-scrolling');

        }

    };

    return new CRNRSTN_JS();

}));

//
// SOURCE :: https://developer.mozilla.org/en-US/docs/Web/API/setInterval
var __nativeST__ = window.setTimeout, __nativeSI__ = window.setInterval;

window.setTimeout = function (vCallback, nDelay /*, argumentToPass1, argumentToPass2, etc. */) {
    var oThis = this, aArgs = Array.prototype.slice.call(arguments, 2);
    return __nativeST__(vCallback instanceof Function ? function () {
        vCallback.apply(oThis, aArgs);
    } : vCallback, nDelay);
};

window.setInterval = function (vCallback, nDelay /*, argumentToPass1, argumentToPass2, etc. */) {
    var oThis = this, aArgs = Array.prototype.slice.call(arguments, 2);
    return __nativeSI__(vCallback instanceof Function ? function () {
        vCallback.apply(oThis, aArgs);
    } : vCallback, nDelay);
};

(function crnrstn_rtime_timer_interval(){
    setInterval(function() {
        // Your logic here
        this.oCRNRSTN_JS.crnrstn_rtime_timer_cycle();
        }, 1000);
})();