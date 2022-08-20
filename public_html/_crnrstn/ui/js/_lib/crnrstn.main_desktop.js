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
// #  CLASS :: CRNRSTN_JS
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
        // CRNRSTN :: DEBUG MODES
        this.CRNRSTN_DEBUG_OFF = 0;
        this.CRNRSTN_DEBUG_BASIC = 100;
        this.CRNRSTN_DEBUG_VERBOSE = 200;
        this.CRNRSTN_DEBUG_LIFESTYLE_BANNER = 300;
        this.CRNRSTN_DEBUG_BASSDRIVE = 420;
        this.CRNRSTN_DEBUG_CONTROLS = 500;

        this.crnrstn_debug_mode = this.CRNRSTN_DEBUG_LIFESTYLE_BANNER;

        this.form_input_serialization_key = 'crnrstn_request_serialization_key';
        this.form_input_serialization_checksum = 'crnrstn_request_serialization_checksum';
        this.current_serialization_key = '';
        this.current_serialization_checksum = '';
        this.data_tunnel_ttl_monitor_isactive = false;
        this.ttl_tunnel_monitor_seconds = -1;
        this.rand_index_spoiler_ARRAY = [];
        this.ttl_array_pointer_index_ARRAY = [];
        this.ttl_array_pointer_index_root_ARRAY = [];
        this.transaction_thread_count_ARRAY = [];
        this.transaction_thread_id_key_ARRAY = ['bassdrive_last_updated', 'bassdrive_relay_access_by_bitrate',
            'bassdrive_the_situation', 'bassdrive_title', 'bassdrive_social', 'bassdrive_locale_colors', 
            'bassdrive_locale_city_state_prov', 'bassdrive_connection_stats', 'bassdrive_history', 
            'bassdrive_reporting', 'bassdrive_archives', 'lifestyle_banner_image_rotation', 'wethrbug_results', 'living_stream_podcast_selection',
            'css_validator_featured_element'];
        this.data_array_adjusted_ttl_ARRAY = [];
        this.transaction_count_ARRAY = [];
        this.transaction_ARRAY = [];
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
        this.jony5_lifestyle_banner_images_FULLSCREEN_ARRAY = [];
        this.jony5_lifestyle_banner_index_FULLSCREEN_ARRAY = [];
        this.jony5_lifestyle_banner_images_ARRAY = [];
        this.jony5_lifestyle_banner_index_ARRAY = [];
        this.jony5_lifestyle_banner_sequence_control_ARRAY = [];
        this.jony5_lifestyle_banner_sequence_position = 0;
        this.sdtl_response_data_container_ARRAY = [];
        this.sdtl_response_data_index_tracker_ARRAY = [];
        this.ui_sync_controller_thread_delay_ARRAY = [];

        this.ttl_age_seconds = 0;   // secs
        this.client_rtime_pretty = '';
        this.client_rtime_millis = 0;
        this.data_tunnel_ttl_monitor_ARRAY = [];
        //this.data_tunnel_ttl_monitor_ARRAY['page_load_data_ttl'] = 30;
        this.data_tunnel_ttl_monitor_ARRAY['page_load_data_ttl'] = 5;

        //
        // MULTI-LANGUAGE SUPPORT CAN COME LATER
        this.client_month_abbrev_ARRAY = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sept','Oct','Nov','Dec'];
        this.client_month_ARRAY = ['January','February','March','April','May','June','July','August','September','October','November','December'];

        this.client_day_abbrev_ARRAY = ['Sun', 'Mon','Tues','Wed','Thurs','Fri','Sat'];
        this.client_day_ARRAY = ['Sunday', 'Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];

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
    //     // 1) AJAX REQUEST TO SERVER WITH META ON ALL "SDT INTEGRATIONS SUPPORTED" FUNCTIONALITY
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

    CRNRSTN_JS.prototype.crnrstn_init = function() {

        var self = this;

        // Both enable and build methods require the body tag to be in the DOM.
        $(document).ready(function() {

            //$('<div id="crnrstn_activity_log" class="crnrstn_log_output_wrapper"><div id="crnrstn_activity_log_output" class="crnrstn_log_output"></div></div>').appendTo($('body'));
            $('<div id="crnrstn_activity_log" class="crnrstn_log_output_wrapper"><div id="crnrstn_activity_log_output" class="crnrstn_log_output"></div></div>').prependTo($('body'));

            if(self.crnrstn_debug_mode === self.CRNRSTN_DEBUG_OFF){

            }else{

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

            self.log_activity('DOM READY.', self.CRNRSTN_DEBUG_VERBOSE);

            self.crnrstn_data_tunnel_session_init();
            self.initialize_delay_ui_sync_controllers();
            self.initialize_jony5_lifestyle_banner_controller();

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

        this.log_activity('Begin client cycling of a second. TTL delta=[' + this.ttl_age_seconds + ']', this.CRNRSTN_DEBUG_CONTROLS);

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

        if (secs == 60){
            secs = 0;
            mins = mins + 1;
        }

        if (mins == 60){
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

        if (hour > 0) {

            hour_copy = hour + " hr";

            if (hour > 1) {

                hour_copy = hour_copy + "s";

            }

            hour_copy = hour_copy + " ";

        }

        if (mins > 0) {

            min_copy = mins + " min";

            if (mins > 1) {

                min_copy = min_copy + "s";

            }

        }

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

        tmp_thread_id_cnt = this.transaction_thread_id_key_ARRAY.length;

        for(let i = 0; i < tmp_thread_id_cnt; i++){

            if(this.ui_sync_controller_thread_delay_ARRAY[this.transaction_thread_id_key_ARRAY[i]] > -1 ){

                tmp_delay_secs = this.ui_sync_controller_thread_delay_ARRAY[this.transaction_thread_id_key_ARRAY[i]];

                if(tmp_delay_secs > 0){

                    tmp_delay_secs--;
                    this.ui_sync_controller_thread_delay_ARRAY[this.transaction_thread_id_key_ARRAY[i]] = tmp_delay_secs;

                }else{

                    if(tmp_delay_secs === 0){

                        this.log_activity('FIRE! FIRE! FIRE! Executing instructions for ' + this.transaction_thread_id_key_ARRAY[i] + ' UI sync now. Looking forward to hearing from you! All the best, J5.', this.CRNRSTN_DEBUG_BASIC);

                        this.execution_delay_ui_sync_controller('fire', this.transaction_thread_id_key_ARRAY[i], false);

                        this.ui_sync_controller_thread_delay_ARRAY[this.transaction_thread_id_key_ARRAY[i]] = -1;

                    }

                }

            }

        }

    }

    CRNRSTN_JS.prototype.process_data_tunnel_ttl = function() {

        this.log_activity('Analyzing data TTL.', this.CRNRSTN_DEBUG_CONTROLS);

        // CHECK PAGE LOAD TTL
        if(this.ttl_age_seconds > this.data_tunnel_ttl_monitor_ARRAY['page_load_data_ttl'] && this.data_tunnel_ttl_monitor_ARRAY['page_load_data_ttl'] != -1){

            this.log_activity('Page load TTL has expired.', this.CRNRSTN_DEBUG_BASIC);

            this.ttl_age_seconds = 0;
            this.data_tunnel_ttl_monitor_ARRAY['page_load_data_ttl'] = -1;

            this.ttl_tunnel_monitor_seconds = 0;
            this.fire_dom_state_controller();

        }else{

            if(this.data_tunnel_ttl_monitor_isactive){


                // DO NOT RUN UNTIL READY TO PROCESS XML DRIVEN TTL UPDATES
                // CHECK FOR THREAD ID TTL EXPIRE
                if(this.thread_id_ttl_expired()){

                    this.ttl_age_seconds = 0;
                    this.data_tunnel_ttl_monitor_isactive = false;
                    this.ttl_tunnel_monitor_seconds = 0;
                    this.log_activity('467 :: ***** fire_dom_state_controller() DEV ABORTED ***** [process_data_tunnel_ttl()] Analyzing data transport TTL.', this.CRNRSTN_DEBUG_CONTROLS);
                    //this.fire_dom_state_controller();

                }

            }else{

                // INACTIVTY REFRESH. SET TO 5 MIN (300s)?
                if(this.ttl_tunnel_monitor_seconds > 300){

                    this.ttl_age_seconds = 0;
                    this.data_transport_ttl_monitor_isactive = false;
                    this.ttl_transport_monitor_seconds = 0;
                    this.log_activity('480 :: ***** fire_dom_state_controller() DEV ABORTED ***** [process_data_transport_ttl()] Analyzing data transport TTL.', this.CRNRSTN_DEBUG_CONTROLS);
                    this.fire_dom_state_controller();

                }

            }

        }

    };

    CRNRSTN_JS.prototype.fire_dom_state_controller = function() {

        //
        // HARD-CODED TESTING ENDPOINT. CHANGE TO CURRENT PAGE OR WWW_ROOT FOR PROD.
        var sdt_layer_endpoint = document.getElementById("jony5_ajax_root").innerHTML;
        //sdt_layer_endpoint = sdt_layer_endpoint + '_crnrstn/soa/tunnel/';
        var uri = sdt_layer_endpoint;

        //
        // SERIALIZATION FOR FORM DATA AND RESPONSE HANDLING
        this.initialize_transaction_serialization();

        var form = $("#crnrstn_soap_data_tunnel_frm");
        var dataString = $(form).serialize();

        this.log_activity('Firing DOM state controller for client UI sync. Sending POST to [' + uri + ']. Serialization key=[' + $('#' + this.form_input_serialization_key).val() + '] Checksum=[' + $('#' + this.form_input_serialization_checksum).val() + ']');

        $.ajax({
            type: "POST",
            url: uri,
            data: dataString,
            dataType: "xml",
            success: parse_data_transport_response
        });

    };

    CRNRSTN_JS.prototype.return_data_transport_xml_data = function(nomination, index = 0) {

        return this.sdtl_response_data_container_ARRAY[nomination + '_' + index];

    }

    CRNRSTN_JS.prototype.return_xml_response_data_index = function(nomination) {

        var tmp_index_cnt = 0;

        if(!(nomination in this.sdtl_response_data_index_tracker_ARRAY)){

            this.sdtl_response_data_index_tracker_ARRAY[nomination] = 1;
            tmp_index_cnt = this.sdtl_response_data_index_tracker_ARRAY[nomination];

        }else{

            tmp_index_cnt = this.sdtl_response_data_index_tracker_ARRAY[nomination];
            tmp_index_cnt = (tmp_index_cnt * 1) + 1;
            this.sdtl_response_data_index_tracker_ARRAY[nomination] = tmp_index_cnt;

        }

        return tmp_index_cnt;

    }

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

    }

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

            this.log_activity('615 :: TTL tracking has been initialized for XML node [' + nomination + '] with index append of [\'_' + index + '\'] .', this.CRNRSTN_DEBUG_BASIC);

        }

    }

    CRNRSTN_JS.prototype.compile_jony5_lifestyle_banner_images = function(nomination, response_data) {

        switch(nomination){
            case 'banner_img_uri':

                if(!(response_data in this.jony5_lifestyle_banner_index_ARRAY)){

                    var tmp_str = this.extract_filename(response_data);
                    this.log_activity('STORING XML DATA [' + tmp_str + '] FROM NODE ' + nomination + '.', this.CRNRSTN_DEBUG_LIFESTYLE_BANNER);

                    this.jony5_lifestyle_banner_index_ARRAY[response_data] = 1;
                    this.jony5_lifestyle_banner_images_ARRAY.push(response_data);

                }

            break;
            case 'banner_img_full_scrn_uri':

                //
                // FULL SCREEN EXPERIENCE
                if(!(response_data in this.jony5_lifestyle_banner_index_FULLSCREEN_ARRAY)){

                    var tmp_str = this.extract_filename(response_data);
                    this.log_activity('STORING XML DATA [' + tmp_str + '] FROM NODE ' + nomination + '.', this.CRNRSTN_DEBUG_LIFESTYLE_BANNER);

                    this.jony5_lifestyle_banner_index_FULLSCREEN_ARRAY[response_data] = 1;
                    this.jony5_lifestyle_banner_images_FULLSCREEN_ARRAY.push(response_data);

                }

            break;

        }

    }

    CRNRSTN_JS.prototype.consume_data_transport_xml_node = function(response_data, nomination, xml_nom, node_attribute_nom, serialize_response, index = 0) {

        var tmp_data = this.get_xml_response_node_data(response_data, xml_nom, node_attribute_nom);

        tmp_data = tmp_data.trim();

        if(xml_nom == 'soap_data_transport_layer_fih_packet'){

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

            this.log_activity('Storing XML data (len='+ tmp_data.length +') attribute [' + node_attribute_nom + '] from XML node [' + xml_nom + '] as [' + nomination + '] with index append of [\'_' + index + '\'] .', this.CRNRSTN_DEBUG_CONTROLS);

        }else{

            this.log_activity('Storing XML node [' + xml_nom + '] data[' + tmp_data + '] (len='+ tmp_data.length +') as [' + nomination + '] with index append of [\'_' + index + '\'] .', this.CRNRSTN_DEBUG_CONTROLS);

        }

        if(tmp_data === 'undefined' || tmp_data === null){

            this.sdtl_response_data_container_ARRAY[nomination + '_' + index] = '';

        }else{

            this.sdtl_response_data_container_ARRAY[nomination + '_' + index] = tmp_data;

        }

        this.initialize_ttl_tracking(nomination, index);

    }

    CRNRSTN_JS.prototype.consume_browser_state_sync_data = function(response_data, serialize_response) {

        this.consume_data_transport_xml_node(response_data, 'response_serial', 'serial', '' , serialize_response);
        this.consume_data_transport_xml_node(response_data, 'request_timestamp', 'request_id', 'timestamp' , serialize_response);
        this.consume_data_transport_xml_node(response_data, 'request_id', 'request_id', '' , serialize_response);
        this.consume_data_transport_xml_node(response_data, 'response_server_runtime', 'server_runtime', '' , serialize_response);
        this.consume_data_transport_xml_node(response_data, 'request_authorization_key', 'request_authorization_key', '' , serialize_response);
        this.consume_data_transport_xml_node(response_data, 'request_locale_identifier', 'request_locale_identifier', '' , serialize_response);
        this.consume_data_transport_xml_node(response_data, 'request_referer', 'request_referer', '' , serialize_response);
        this.consume_data_transport_xml_node(response_data, 'client_id', 'client_id', '' , serialize_response);
        this.consume_data_transport_xml_node(response_data, 'client_auth_key', 'client_auth_key', '' , serialize_response);
        this.consume_data_transport_xml_node(response_data, 'server_name', 'server_name', '' , serialize_response);
        this.consume_data_transport_xml_node(response_data, 'server_ip_address', 'server_ip_address', '' , serialize_response);
        this.consume_data_transport_xml_node(response_data, 'client_ip_address', 'client_ip_address', '' , serialize_response);

    }

    CRNRSTN_JS.prototype.consume_response_status_data = function(response_data, serialize_response){

        var NODE_status_report = response_data.getElementsByTagName('status_report');
        var tmp_node_cnt = NODE_status_report.length;
        if(tmp_node_cnt > 0){

            for(let i = 0; i < tmp_node_cnt; i++){

                this.consume_data_transport_xml_node(NODE_status_report[i], 'target_element', 'target_element', '' , true, i);
                this.consume_data_transport_xml_node(NODE_status_report[i], 'status_code', 'status_code', '' , true, i);
                this.consume_data_transport_xml_node(NODE_status_report[i], 'status_message', 'status_message', '' , true, i);
                this.consume_data_transport_xml_node(NODE_status_report[i], 'is_error_code', 'is_error_code', '' , true, i);
                this.consume_data_transport_xml_node(NODE_status_report[i], 'is_error_message', 'is_error_message', '' , true, i);

            }

        }

    }

    CRNRSTN_JS.prototype.consume_response_client_profile_data = function(response_data, serialize_response){

        //
        // GLOBAL PRIVACY CONTROL
        var NODE_global_privacy_control = response_data.getElementsByTagName('global_privacy_control');
        var tmp_node_cnt = NODE_global_privacy_control.length;
        if(tmp_node_cnt > 0) {

            for (i = 0; i < tmp_node_cnt; i++) {

                this.consume_data_transport_xml_node(NODE_global_privacy_control[i], 'sec_gpc', 'sec_gpc', '' , true, i);

            }

        }

        //
        // DEVICE TYPE
        var NODE_device_type = response_data.getElementsByTagName('device_type');
        tmp_node_cnt = NODE_device_type.length;
        if(tmp_node_cnt > 0) {

            this.consume_data_transport_xml_node(response_data, 'device_type', 'device_type', '', serialize_response);

        }

        // //
        // // LANGUAGE
        // var NODE_global_privacy_control = response_data.getElementsByTagName('global_privacy_control');
        // var tmp_node_cnt = NODE_global_privacy_control.length;
        // if(tmp_node_cnt > 0) {
        //
        //     for (i = 0; i < tmp_node_cnt; i++) {
        //
        //         this.consume_data_transport_xml_node(NODE_global_privacy_control[i], 'sec_gpc', 'sec_gpc', '' , true, i);
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

                this.consume_data_transport_xml_node(NODE_language_preference[i], 'language_preference_request_id_timestamp', 'request_id', 'timestamp' , true, i);
                this.consume_data_transport_xml_node(NODE_language_preference[i], 'language_preference_request_id', 'request_id', '' , true, i);
                this.consume_data_transport_xml_node(NODE_language_preference[i], 'language_preference_request_referer', 'request_referer', '' , true, i);
                this.consume_data_transport_xml_node(NODE_language_preference[i], 'language_preference_locale_identifier', 'locale_identifier', '' , true, i);
                this.consume_data_transport_xml_node(NODE_language_preference[i], 'language_preference_region_variant', 'region_variant', '' , true, i);
                this.consume_data_transport_xml_node(NODE_language_preference[i], 'language_preference_factor_weighting', 'factor_weighting', '' , true, i);
                this.consume_data_transport_xml_node(NODE_language_preference[i], 'language_preference_iso_language_nomination', 'iso_language_nomination', '' , true, i);
                this.consume_data_transport_xml_node(NODE_language_preference[i], 'language_preference_native_nomination', 'native_nomination', '' , true, i);
                this.consume_data_transport_xml_node(NODE_language_preference[i], 'language_preference_iso_639-1_2002', 'iso_639-1_2002', '' , true, i);
                this.consume_data_transport_xml_node(NODE_language_preference[i], 'language_preference_iso_639-2_1998', 'iso_639-2_1998', '' , true, i);
                this.consume_data_transport_xml_node(NODE_language_preference[i], 'language_preference_iso_639-3_2007', 'iso_639-3_2007', '' , true, i);

            }

        }

    }

    CRNRSTN_JS.prototype.consume_response_bassdrive_data = function(response_data, serialize_response){

        //
        // JSON SOURCE
        var NODE_json_log_id = response_data.getElementsByTagName('json_log_id');
        var tmp_node_cnt = NODE_json_log_id.length;
        if(tmp_node_cnt > 0) {

            this.consume_data_transport_xml_node(response_data, 'bassdrive_json_log_id', 'json_log_id', '', serialize_response);
            this.consume_data_transport_xml_node(response_data, 'bassdrive_json_log_id_url', 'json_log_id', 'url', serialize_response);
            this.consume_data_transport_xml_node(response_data, 'bassdrive_json_log_id_timestamp', 'json_log_id', 'timestamp', serialize_response);

        }

        //
        // WEB PLAYER URL
        var NODE_web_player_url = response_data.getElementsByTagName('web_player_url');
        tmp_node_cnt = NODE_web_player_url.length;
        if(tmp_node_cnt > 0) {

            this.consume_data_transport_xml_node(response_data, 'bassdrive_web_player_url', 'web_player_url', '', serialize_response);

        }

        //
        // IS LIVE
        var NODE_is_live = response_data.getElementsByTagName('is_live');
        tmp_node_cnt = NODE_is_live.length;
        if(tmp_node_cnt > 0) {

            this.consume_data_transport_xml_node(response_data, 'bassdrive_is_live', 'is_live', '', serialize_response);
            this.consume_data_transport_xml_node(response_data, 'bassdrive_is_live_ttl', 'is_live', 'ttl', serialize_response);

        }

        //
        // THE SITUATION WITH BASSDRIVE
        var NODE_the_situation_with_bassdrive = response_data.getElementsByTagName('the_situation_with_bassdrive');
        tmp_node_cnt = NODE_the_situation_with_bassdrive.length;
        if(tmp_node_cnt > 0) {

            this.consume_data_transport_xml_node(response_data, 'the_situation_with_bassdrive_ttl', 'the_situation_with_bassdrive', 'ttl' , serialize_response);

            var NODE_likely_status = response_data.getElementsByTagName('likely_status');
            var tmp_node_cnt = NODE_likely_status.length;
            for (i = 0; i < tmp_node_cnt; i++) {

                this.consume_data_transport_xml_node(NODE_likely_status[i], 'the_situation_with_bassdrive_likely_status', 'likely_status', '' , serialize_response, i);

            }

        }

        //
        // STREAM KEY
        var NODE_stream_key = response_data.getElementsByTagName('stream_key');
        tmp_node_cnt = NODE_stream_key.length;
        if(tmp_node_cnt > 0) {

            this.consume_data_transport_xml_node(response_data, 'bassdrive_stream_key', 'stream_key', '', serialize_response);

        }

        //
        // RELAY STREAM TITLE
        var NODE_title = response_data.getElementsByTagName('title');
        tmp_node_cnt = NODE_title.length;
        if(tmp_node_cnt > 0) {

            this.consume_data_transport_xml_node(response_data, 'bassdrive_title', 'title', '', serialize_response);
            this.consume_data_transport_xml_node(response_data, 'bassdrive_title_ttl', 'title', 'ttl', serialize_response);

        }

        //
        // RELAY BROADCAST LOCALE
        var NODE_locale_city_province = response_data.getElementsByTagName('locale_city_province');
        tmp_node_cnt = NODE_locale_city_province.length;
        if(tmp_node_cnt > 0) {

            this.consume_data_transport_xml_node(response_data, 'bassdrive_locale_city_province', 'locale_city_province', '', serialize_response);
            this.consume_data_transport_xml_node(response_data, 'bassdrive_locale_city_province_ttl', 'locale_city_province', 'ttl', serialize_response);

        }

        //
        // RELAY BROADCAST LOCALE NATION
        var NODE_locale_nation = response_data.getElementsByTagName('locale_nation');
        tmp_node_cnt = NODE_locale_nation.length;
        if(tmp_node_cnt > 0) {

            this.consume_data_transport_xml_node(response_data, 'bassdrive_locale_nation', 'locale_nation', '', serialize_response);
            this.consume_data_transport_xml_node(response_data, 'bassdrive_locale_nation_ttl', 'locale_nation', 'ttl', serialize_response);
            this.consume_data_transport_xml_node(response_data, 'bassdrive_locale_nation_colors_url', 'locale_nation', 'url', serialize_response);

        }

        //
        // RELAY BROADCAST TITLE HTML
        var NODE_title_html = response_data.getElementsByTagName('title_html');
        tmp_node_cnt = NODE_title_html.length;
        if(tmp_node_cnt > 0) {

            this.consume_data_transport_xml_node(response_data, 'bassdrive_title_html', 'title_html', '', serialize_response);

        }

        //
        // RELAY BROADCAST LOCALE HTML
        var NODE_locale_html = response_data.getElementsByTagName('locale_html');
        tmp_node_cnt = NODE_locale_html.length;
        if(tmp_node_cnt > 0) {

            this.consume_data_transport_xml_node(response_data, 'bassdrive_locale_html', 'locale_html', '', serialize_response);

        }

        //
        // RELAY BROADCAST SOCIAL MEDIA HTML
        var NODE_social_html = response_data.getElementsByTagName('social_html');
        tmp_node_cnt = NODE_social_html.length;
        if(tmp_node_cnt > 0) {

            this.consume_data_transport_xml_node(response_data, 'bassdrive_social_html', 'social_html', '', serialize_response);

        }

        //
        // RELAYS
        var NODE_stream_relays = response_data.getElementsByTagName('stream_relays');
        tmp_node_cnt = NODE_stream_relays.length;
        if(tmp_node_cnt > 0) {

            this.consume_data_transport_xml_node(response_data, 'stream_relays_ttl', 'stream_relays', 'ttl' , serialize_response);

            var NODE_stream = NODE_stream_relays[0].getElementsByTagName('stream');
            var tmp_node_cnt = NODE_stream.length;
            for (i = 0; i < tmp_node_cnt; i++) {

                this.consume_data_transport_xml_node(NODE_stream[i], 'stream_url', 'stream', 'url' , serialize_response, i);
                this.consume_data_transport_xml_node(NODE_stream[i], 'stream_url_ios', 'stream', 'url_ios' , serialize_response, i);
                this.consume_data_transport_xml_node(NODE_stream[i], 'stream_bitrate', 'bitrate', '' , serialize_response, i);
                this.consume_data_transport_xml_node(NODE_stream[i], 'stream_audio_format', 'audio_format', '' , serialize_response, i);
                this.consume_data_transport_xml_node(NODE_stream[i], 'stream_listener_count', 'listener_count', '' , serialize_response, i);
                this.consume_data_transport_xml_node(NODE_stream[i], 'stream_listener_count_percentage', 'listener_count_percentage', '' , serialize_response, i);

            }

        }

        //
        // SOCIAL MEDIA INTEGRATIONS
        var NODE_social_media_connects = response_data.getElementsByTagName('social_media_connects');
        tmp_node_cnt = NODE_social_media_connects.length;
        if(tmp_node_cnt > 0) {

            this.consume_data_transport_xml_node(response_data, 'social_media_connects_ttl', 'social_media_connects', 'ttl' , serialize_response);

            var NODE_endpoint = NODE_social_media_connects[0].getElementsByTagName('endpoint');
            var tmp_node_cnt = NODE_endpoint.length;
            for (i = 0; i < tmp_node_cnt; i++) {

                this.consume_data_transport_xml_node(NODE_endpoint[i], 'endpoint_type', 'endpoint', 'type' , serialize_response, i);
                this.consume_data_transport_xml_node(NODE_endpoint[i], 'endpoint_url', 'endpoint', 'url' , serialize_response, i);

            }

        }

        //
        // STREAM PERFORMANCE
        var NODE_performance = response_data.getElementsByTagName('performance');
        var tmp_node_cnt = NODE_performance.length;
        if(tmp_node_cnt > 0) {

            //
            // TTL
            this.consume_data_transport_xml_node(response_data, 'relay_performance_ttl', 'performance', 'ttl' , serialize_response);

            //
            // CURRENT STREAM PERFORMANCE
            var NODE_current_statistics = NODE_performance[0].getElementsByTagName('current_statistics');
            tmp_node_cnt = NODE_current_statistics.length;
            for (i = 0; i < tmp_node_cnt; i++) {

                //
                // TIMESTAMP
                this.consume_data_transport_xml_node(NODE_current_statistics[0], 'current_connection_stat_timestamp', 'connection_stat', 'timestamp' , serialize_response);
                this.consume_data_transport_xml_node(NODE_current_statistics[0], 'current_connection_stat_json_log_id', 'connection_stat', 'json_log_id' , serialize_response);

                var NODE_current_connection_stat = NODE_current_statistics[0].getElementsByTagName('connection_stat');
                tmp_node_cnt = NODE_current_connection_stat.length;
                for (ii = 0; ii < tmp_node_cnt; ii++) {

                    var NODE_current_stream_stat = NODE_current_connection_stat[ii].getElementsByTagName('stream_stat');
                    var tmp_node_cnt_inner = NODE_current_stream_stat.length;
                    for (iii = 0; iii < tmp_node_cnt_inner; iii++) {

                        this.consume_data_transport_xml_node(NODE_current_stream_stat[iii], 'current_stream_stat_type', 'stream_stat', 'type' , serialize_response, iii);
                        this.consume_data_transport_xml_node(NODE_current_stream_stat[iii], 'current_stream_stat_connections', 'connections', '', serialize_response, iii);
                        this.consume_data_transport_xml_node(NODE_current_stream_stat[iii], 'current_stream_stat_connections_capacity', 'connections', 'capacity', serialize_response, iii);
                        this.consume_data_transport_xml_node(NODE_current_stream_stat[iii], 'current_stream_stat_bandwidth', 'bandwidth', '', serialize_response, iii);
                        this.consume_data_transport_xml_node(NODE_current_stream_stat[iii], 'current_stream_stat_bandwidth_format', 'bandwidth', 'format', serialize_response, iii);
                        this.consume_data_transport_xml_node(NODE_current_stream_stat[iii], 'current_stream_stat_bitrate', 'bitrate', '', serialize_response, iii);
                        this.consume_data_transport_xml_node(NODE_current_stream_stat[iii], 'current_stream_stat_bitrate_format', 'bitrate', 'format', serialize_response, iii);

                    }

                }

            }

            //
            // RECENT STREAM PERFORMANCE
            //var ii = 0;
            var NODE_recent_statistics = NODE_performance[0].getElementsByTagName('recent_statistics');
            tmp_node_cnt = NODE_recent_statistics.length;
            for (i = 0; i < tmp_node_cnt; i++) {

                //
                // TIMESTAMP
                this.consume_data_transport_xml_node(NODE_recent_statistics[0], 'recent_connection_stat_timestamp', 'connection_stat', 'timestamp' , serialize_response);

                var NODE_recent_connection_stat = NODE_recent_statistics[0].getElementsByTagName('connection_stat');
                tmp_node_cnt = NODE_recent_connection_stat.length;
                for (ii = 0; ii < tmp_node_cnt; ii++) {

                    var NODE_recent_stream_stat = NODE_recent_connection_stat[ii].getElementsByTagName('stream_stat');
                    tmp_node_cnt_inner = NODE_recent_stream_stat.length;
                    for (iii = 0; iii < tmp_node_cnt_inner; iii++) {

                        this.consume_data_transport_xml_node(NODE_recent_stream_stat[iii], 'recent_stream_stat_type', 'stream_stat', 'type' , serialize_response, iii);
                        this.consume_data_transport_xml_node(NODE_recent_stream_stat[iii], 'recent_stream_stat_connections', 'connections', '', serialize_response, iii);
                        this.consume_data_transport_xml_node(NODE_recent_stream_stat[iii], 'recent_stream_stat_connections_capacity', 'connections', 'capacity', serialize_response, iii);
                        this.consume_data_transport_xml_node(NODE_recent_stream_stat[iii], 'recent_stream_stat_bandwidth', 'bandwidth', '', serialize_response, iii);
                        this.consume_data_transport_xml_node(NODE_recent_stream_stat[iii], 'recent_stream_stat_bandwidth_format', 'bandwidth', 'format', serialize_response, iii);
                        this.consume_data_transport_xml_node(NODE_recent_stream_stat[iii], 'recent_stream_stat_bitrate', 'bitrate', '', serialize_response, iii);
                        this.consume_data_transport_xml_node(NODE_recent_stream_stat[iii], 'recent_stream_stat_bitrate_format', 'bitrate', 'format', serialize_response, iii);

                    }

                }

            }

            //
            // HISTORICAL STREAM PERFORMANCE
            var NODE_historical_statistics = NODE_performance[0].getElementsByTagName('historical_statistics');
            var tmp_node_cnt_outer = NODE_historical_statistics.length;
            for (i = 0; i < tmp_node_cnt_outer; i++) {

                var NODE_historical_connection_stat = NODE_historical_statistics[0].getElementsByTagName('connection_stat');
                tmp_node_cnt = NODE_historical_connection_stat.length;
                for (ii = 0; ii < tmp_node_cnt; ii++) {

                    //
                    // TIMESTAMP
                    this.consume_data_transport_xml_node(NODE_historical_connection_stat[ii], 'historical_connection_stat_timestamp', 'connection_stat', 'timestamp' , serialize_response);

                    var NODE_historical_stream_stat = NODE_historical_connection_stat[ii].getElementsByTagName('stream_stat');
                    tmp_node_cnt_inner = NODE_historical_stream_stat.length;
                    for (iii = 0; iii < tmp_node_cnt_inner; iii++) {

                        this.consume_data_transport_xml_node(NODE_historical_stream_stat[iii], 'historical_stream_stat_type', 'stream_stat', 'type' , serialize_response, iii);
                        this.consume_data_transport_xml_node(NODE_historical_stream_stat[iii], 'historical_stream_stat_connections', 'connections', '', serialize_response, iii);
                        this.consume_data_transport_xml_node(NODE_historical_stream_stat[iii], 'historical_stream_stat_connections_capacity', 'connections', 'capacity', serialize_response, iii);
                        this.consume_data_transport_xml_node(NODE_historical_stream_stat[iii], 'historical_stream_stat_bandwidth', 'bandwidth', '', serialize_response, iii);
                        this.consume_data_transport_xml_node(NODE_historical_stream_stat[iii], 'historical_stream_stat_bandwidth_format', 'bandwidth', 'format', serialize_response, iii);
                        this.consume_data_transport_xml_node(NODE_historical_stream_stat[iii], 'historical_stream_stat_bitrate', 'bitrate', '', serialize_response, iii);
                        this.consume_data_transport_xml_node(NODE_historical_stream_stat[iii], 'historical_stream_stat_bitrate_format', 'bitrate', 'format', serialize_response, iii);

                    }

                }

            }

        }

    }

    CRNRSTN_JS.prototype.consume_response_lifestyle_banner_data = function(response_data, serialize_response){

        //
        // BANNER
        var NODE_lifestyle_banner = response_data.getElementsByTagName('banner_img');
        var tmp_node_cnt = NODE_lifestyle_banner.length;

        if(tmp_node_cnt > 0) {

            this.consume_data_transport_xml_node(response_data, 'lifestyle_banner_ttl', 'lifestyle_banner', 'ttl' , serialize_response);
            this.consume_data_transport_xml_node(response_data, 'lifestyle_banner_ttl_count', 'lifestyle_banner', 'count' , serialize_response);

            for (i = 0; i < tmp_node_cnt; i++) {

                this.consume_data_transport_xml_node(NODE_lifestyle_banner[i], 'banner_img_uri', 'banner_img', 'uri' , serialize_response, i);
                this.consume_data_transport_xml_node(NODE_lifestyle_banner[i], 'banner_img_full_scrn_uri', 'banner_img', 'full_scrn_uri' , serialize_response, i);
                this.consume_data_transport_xml_node(NODE_lifestyle_banner[i], 'banner_img_filesize', 'filesize', '' , serialize_response, i);
                this.consume_data_transport_xml_node(NODE_lifestyle_banner[i], 'banner_img_md5', 'filesize', 'md5' , serialize_response, i);
                this.consume_data_transport_xml_node(NODE_lifestyle_banner[i], 'banner_img_sha1', 'filesize', 'sha1' , serialize_response, i);

            }

        }

    }

    CRNRSTN_JS.prototype.consume_data_transport_response = function(response_data, data_type, serialize_response = false) {

        switch(data_type){
            case 'XML':

                //debugger;

                var NODE_client_response = response_data.getElementsByTagName('client_response');
                if (NODE_client_response.length > 0) {

                    this.log_activity('Extracting ' + data_type + ' data from CRNRSTN :: SOAP data transport layer response.', this.CRNRSTN_DEBUG_VERBOSE);
                    this.consume_data_transport_xml_node(response_data, 'response_timestamp', 'client_response', 'timestamp' , serialize_response);

                    //
                    // RECEIVE NEW SOAP-SERVICES DATA TUNNEL LAYER FORM PACKET SITUATION....SITUATION
                    this.consume_data_transport_xml_node(response_data, 'sdtl_packet', 'soap_data_transport_layer_fih_packet', '' , serialize_response);

                    //
                    //
                    // IF WE HAVE RESPONSE STATUS REPORT DATA
                    var NODE_data_signature = response_data.getElementsByTagName('data_signature');
                    var tmp_node_cnt = NODE_data_signature.length;
                    if (tmp_node_cnt > 0) {

                        for(let i = 0; i < tmp_node_cnt; i++){

                            this.log_activity('Extracting [data_signature] data from CRNRSTN :: SDTL response.', this.CRNRSTN_DEBUG_CONTROLS);

                            this.consume_data_transport_xml_node(NODE_data_signature[i], 'data_signature_request_key', 'request_key', '' , true, i);
                            this.consume_data_transport_xml_node(NODE_data_signature[i], 'data_signature_request_checksum', 'request_checksum', '' , true, i);
                            this.consume_data_transport_xml_node(NODE_data_signature[i], 'jesus_christ_is_lord_bool', 'jesus_christ_is_lord', '' , true, i);
                            this.consume_data_transport_xml_node(NODE_data_signature[i], 'jesus_christ_is_lord_vv', 'jesus_christ_is_lord', 'source' , true, i);
                            this.consume_data_transport_xml_node(NODE_data_signature[i], 'satan_is_a_liar_bool', 'satan_is_a_liar', '' , true, i);
                            this.consume_data_transport_xml_node(NODE_data_signature[i], 'satan_is_a_liar_vv', 'satan_is_a_liar', 'source' , true, i);

                        }

                    }

                    //
                    // IF WE HAVE BROWSER STATE SYNC DATA
                    var NODE_state_synchronization_data = response_data.getElementsByTagName('state_synchronization_data');
                    if (NODE_state_synchronization_data.length > 0) {

                        this.log_activity('Extracting [state_synchronization_data] data from CRNRSTN :: SDTL response.', this.CRNRSTN_DEBUG_CONTROLS);

                        this.consume_browser_state_sync_data(NODE_state_synchronization_data[0], serialize_response);

                    }

                    //
                    // IF WE HAVE RESPONSE STATUS REPORT DATA
                    var NODE_response_status = response_data.getElementsByTagName('response_status');
                    var tmp_node_cnt = NODE_response_status.length;
                    if (tmp_node_cnt > 0) {

                        for(let i = 0; i < tmp_node_cnt; i++){

                            this.log_activity('Extracting [response_status] data from CRNRSTN :: SDTL response.', this.CRNRSTN_DEBUG_CONTROLS);

                            this.consume_response_status_data(NODE_response_status[i], serialize_response);

                        }

                    }

                    //
                    // CLIENT PROFILE DATA
                    var NODE_client_profile = response_data.getElementsByTagName('client_profile');
                    tmp_node_cnt = NODE_client_profile.length;
                    if (tmp_node_cnt > 0) {

                        for(let i = 0; i < tmp_node_cnt; i++){

                            this.log_activity('Extracting [client_profile] data from CRNRSTN :: SDTL response.', this.CRNRSTN_DEBUG_CONTROLS);

                            this.consume_response_client_profile_data(NODE_client_profile[i], serialize_response);

                        }

                    }

                    //
                    // BASSDRIVE DATA
                    var NODE_bassdrive = response_data.getElementsByTagName('bassdrive');
                    tmp_node_cnt = NODE_bassdrive.length;
                    if (tmp_node_cnt > 0) {

                        for(let i = 0; i < tmp_node_cnt; i++){

                            this.log_activity('Extracting [bassdrive] data from CRNRSTN :: SDTL response.', this.CRNRSTN_DEBUG_CONTROLS);

                            this.consume_response_bassdrive_data(NODE_bassdrive[i], serialize_response);

                        }

                    }

                    //
                    // LIFESTYLE IMAGE BANNER DATA
                    var NODE_lifestyle_banner = response_data.getElementsByTagName('lifestyle_banner');
                    tmp_node_cnt = NODE_lifestyle_banner.length;
                    if (tmp_node_cnt > 0) {

                        for(let i = 0; i < tmp_node_cnt; i++){

                            this.log_activity('Extracting [lifestyle_banner] data from CRNRSTN :: SDTL response.', this.CRNRSTN_DEBUG_CONTROLS);

                            this.consume_response_lifestyle_banner_data(NODE_lifestyle_banner[i], serialize_response);

                        }

                    }

                    this.data_transport_ttl_monitor_isactive = true;
                    this.log_activity('CRNRSTN :: SDTL response consumption is now complete.', this.CRNRSTN_DEBUG_BASIC);
                    this.log_activity('CRNRSTN :: SDTL TTL monitoring for client state is now active.', this.CRNRSTN_DEBUG_BASIC);

                    //debugger;
                }

            break;
            case 'SOAP':
                //
                // CRNRSTN :: SOAP-SERVICES DATA TUNNEL RAW SOAP RESPONSE TO BROWSER (EXPERIMENTAL)

            break;

        }

    }

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

    }


    CRNRSTN_JS.prototype.array_adjust_ttl_value = function(thread_id_index) {

        //
        // WHERE thread_id_index = 'xml_node_name' + '_' + array_increment
        tmp_xml_node_nomination = this.ttl_array_pointer_index_root_ARRAY[thread_id_index];
        tmp_ttl_secs = this.return_data_transport_xml_data(tmp_xml_node_nomination);

        switch(tmp_xml_node_nomination){
            case 'lifestyle_banner_ttl':

                //
                // CURRENTLY, ONLY ONE USE CASE TO SUPPORT (GLOBAL/MACRO TTL AT TOP NODE).
                // THIS MAY CHANGE...WITH THE ADDITION OF MICRO-TTL'D REPORTING META ARRAY....E.G.
                if(!(tmp_xml_node_nomination in this.data_array_adjusted_ttl_ARRAY)){

                    tmp_count = this.return_data_transport_xml_data(tmp_xml_node_nomination + '_count');

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

                        tmp_count = this.return_data_transport_xml_data(tmp_xml_node_nomination + '_count');
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

    }

    CRNRSTN_JS.prototype.thread_id_ttl_expired = function() {

        var tmp_ttl_expired = false;
        var tmp_array_adjusted_ttl = 0;

        //
        // BASED OFF TTL DATA FROM CONSUMED XML RESPONSE DOCUMENT
        tmp_ttl_cnt = this.ttl_array_pointer_index_ARRAY.length;
        for(let i = 0; i < tmp_ttl_cnt; i++){

            //tmp_array_adjusted_ttl = this.array_adjust_ttl_value(this.ttl_array_pointer_index_ARRAY[i], this.sdtl_response_data_index_tracker_ARRAY[this.ttl_array_pointer_index_ARRAY[i]]);
            tmp_array_adjusted_ttl = this.array_adjust_ttl_value(this.ttl_array_pointer_index_ARRAY[i]);

            if((tmp_array_adjusted_ttl < this.ttl_age_seconds) && (tmp_array_adjusted_ttl > 0)){

                //
                // TTL IS EXPIRED. ADD TO CLIENT SYNC REQUEST.
                //this.update_dom_state_controller_ttl(this.ttl_array_pointer_index_ARRAY[i]);

                tmp_ttl_expired = true;

                this.log_activity('TTL for a data transported thread [' + this.ttl_array_pointer_index_ARRAY[i] + '] has expired at ' + this.ttl_age_seconds + ' seconds, where the threshold is ' + tmp_array_adjusted_ttl + ' secs.', this.CRNRSTN_DEBUG_BASIC);

            }

        }

        return tmp_ttl_expired;

    }

    CRNRSTN_JS.prototype.return_count_response_data = function(nomination) {

        //
        // COUNT FOR LOOP CONTROL OF XML ARRAY DATA
        return this.sdtl_response_data_index_tracker_ARRAY[nomination]

    }

    CRNRSTN_JS.prototype.update_thread_count = function(thread_id, delta, scheduler_invoked) {

        if(!scheduler_invoked){

            tmp_cnt = this.transaction_thread_count_ARRAY[thread_id];
            tmp_cnt = tmp_cnt + (delta);
            this.transaction_thread_count_ARRAY[thread_id] = tmp_cnt;

            this.log_activity('UI sync controller transaction thread count updated to ' + tmp_cnt + ' with the initialization of [' + thread_id + '].', this.CRNRSTN_DEBUG_CONTROLS);

        }

    }

    CRNRSTN_JS.prototype.update_transaction_count = function() {

        this.transaction_count_ARRAY.push(this.current_serialization_key);
        this.transaction_ARRAY.push(this.current_serialization_key);

        if(this.transaction_count_ARRAY.length > 1){

            tmp_str = 'have';

        }else{

            tmp_str = 'has';

        }

        this.log_activity('1 out of ' + this.transaction_count_ARRAY.length + ' UI state sync transactions (serialization key=[' + this.current_serialization_key + ']) ' + tmp_str + ' been started.', this.CRNRSTN_DEBUG_BASIC);

    }

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

    }

    CRNRSTN_JS.prototype.active_transaction_count = function() {

        return this.transaction_count_ARRAY[this.current_serialization_key];

    }

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

    }

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

    }

    CRNRSTN_JS.prototype.execute_ui_sync = function(ui_thread_id){

        switch(ui_thread_id){
            case 'bassdrive_title':

                tmp_title_html = this.return_data_transport_xml_data('bassdrive_title_html');
                tmp_title_html = tmp_title_html.trim();
                if(tmp_title_html.length > 0){

                    this.transitions_ui_content_update('stream_info', tmp_title_html, 'blind');

                }

            break;
            case 'bassdrive_locale_colors':

                tmp_locale_colors = this.return_data_transport_xml_data('bassdrive_locale_html');
                tmp_locale_colors = tmp_locale_colors.trim();
                if(tmp_locale_colors.length > 0) {

                    this.transitions_ui_content_update('broadcast_nation', tmp_locale_colors);

                }

            break;
            case 'bassdrive_social':

                tmp_social_html = this.return_data_transport_xml_data('bassdrive_social_html');
                tmp_social_html = tmp_social_html.trim();
                if(tmp_social_html.length > 0) {

                    this.transitions_ui_content_update('stream_social', tmp_social_html, 'blind');

                }

            break;
            case 'bassdrive_connection_stats':

                tmp_stat_connections = this.return_data_transport_xml_data('current_stream_stat_connections');
                tmp_stat_connections_capacity = this.return_data_transport_xml_data('current_stream_stat_connections_capacity');
                tmp_stat_bandwidth = this.return_data_transport_xml_data('current_stream_stat_bandwidth');
                tmp_stat_bandwidth_format = this.return_data_transport_xml_data('current_stream_stat_bandwidth_format');

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

                tmp_bassdrive_situation = this.return_data_transport_xml_data('the_situation_with_bassdrive_likely_status', rand_index);

                tmp_bassdrive_situation = tmp_bassdrive_situation.trim();
                if(tmp_bassdrive_situation.length > 0) {

                    this.transitions_ui_content_update('crnrstn_bassdrive_situation', tmp_bassdrive_situation, 'blind');

                }

            break;
            case 'lifestyle_banner_image_rotation':

                this.log_activity('1725 :: FIRE! FIRE! FIRE! [' + ui_thread_id + ']. ', this.CRNRSTN_DEBUG_LIFESTYLE_BANNER);

                this.rotate_lifestyle_banner_image();

            break;
            default:

                this.log_activity('UI sync instructions have not been configured for [' + ui_thread_id + '].', this.CRNRSTN_DEBUG_CONTROLS);

            break;

        }

    }

    CRNRSTN_JS.prototype.execution_delay_ui_sync_controller = function(action_init, action_id, delay_ttl = 0, scheduler_invoked = false){

        switch(action_init){
            case 'fire':

                this.update_thread_count(action_id, 1, scheduler_invoked);

                this.log_activity('UI sync controller set to fire [' + action_id + '].', this.CRNRSTN_DEBUG_CONTROLS);

                //
                // FIRE UI UPDATE THREAD
                this.execute_ui_sync(action_id);

                this.ui_sync_controller_thread_delay_ARRAY[action_id] = -1;

            break;
            case 'schedule':

                this.ui_sync_controller_thread_delay_ARRAY[action_id] = delay_ttl;

                this.log_activity('UI sync controller has scheduled [' + action_id + '] to fire in ' + delay_ttl + ' seconds.', this.CRNRSTN_DEBUG_UI);

            break;
            case 'stop':

                this.ui_sync_controller_thread_delay_ARRAY[action_id] = -1;

            break;
            case 'cancel':

                this.log_activity('UI sync controller has cancelled [' + action_id + '].', this.CRNRSTN_DEBUG_CONTROLS);

            break;
            case 'sleep':

                this.log_activity('UI sync controller has put [' + action_id + '] to sleep.', this.CRNRSTN_DEBUG_CONTROLS);

            break;
            case 'silence_is_golden':

                //this.update_thread_count(action_id, 1, scheduler_invoked);
                this.log_activity('UI sync controller has scheduled [' + action_id + '] to run silently in ' + delay_ttl + ' seconds.', this.CRNRSTN_DEBUG_CONTROLS);

            break;

        }

    }

    CRNRSTN_JS.prototype.initialize_jony5_lifestyle_banner_controller = function() {

        var self = this;

        //
        // SOURCE :: https://stackoverflow.com/questions/4735342/jquery-to-loop-through-elements-with-the-same-class
        // AUTHOR :: Kees C. Bakker :: https://stackoverflow.com/users/201482/kees-c-bakker
        $('.jony5_lifestyle_image').each(function(i, obj) {

            //self.log_activity(' ADDING LIFESTYLE BANNER IMAGE[' + i + '] TO ARRAY CONSTRUCT :: ' + obj.innerHTML);
            var image_uri = $('#jony5_ajax_root').html() + $('#jony5_lifestyle_image_path').html() + obj.innerHTML;

            if(!(image_uri in self.jony5_lifestyle_banner_index_ARRAY)){

                var tmp_str = self.extract_filename(image_uri);
                self.log_activity('1811 :: STORING STATIC BANNER DOM DATA [' + tmp_str + '].', self.CRNRSTN_DEBUG_LIFESTYLE_BANNER);

                self.jony5_lifestyle_banner_index_ARRAY[image_uri] = 1;
                self.jony5_lifestyle_banner_images_ARRAY.push(image_uri);

            }

        });

        //
        // ACCOUNT FOR STATIC IMAGE IN HTML LOADED BY DOM FOR BACK BUTTON ACCESS TO START
        var tmp_index = 0;
        var tmp_next_image = this.jony5_lifestyle_banner_images_ARRAY[tmp_index];
        this.jony5_lifestyle_banner_sequence_control_ARRAY.push(tmp_next_image);
        this.jony5_lifestyle_banner_sequence_position++;

        var tmp_str = this.extract_filename(tmp_next_image);
        var tmp_zindex_alpha = $("#jony5_banner_lifestyle_alpha").css('zIndex');
        this.log_activity('1829 :: STATIC DOM LOAD [' + tmp_str + '] INTO ALPHA, where Z=' + tmp_zindex_alpha + ' OPACITY=' + $('#jony5_banner_lifestyle_alpha').css('opacity') + '.', self.CRNRSTN_DEBUG_LIFESTYLE_BANNER);

        //
        // SELECT AN IMAGE AND LOAD IT INTO THE LOWEST Z-INDEX DOM ELEMENT
        //tmp_index = Math.floor(Math.random() * this.jony5_lifestyle_banner_images_ARRAY.length);
        tmp_index++;
        tmp_next_image = this.jony5_lifestyle_banner_images_ARRAY[tmp_index];

        this.jony5_lifestyle_banner_sequence_control_ARRAY.push(tmp_next_image);
        this.jony5_lifestyle_banner_sequence_position++;

        var tmp_str = this.extract_filename(tmp_next_image);
        var tmp_zindex_alpha = $("#jony5_banner_lifestyle_beta").css('zIndex');
        $("#jony5_banner_lifestyle_beta").css('opacity', 0);
        this.log_activity('1835 :: STATIC DOM LOAD [' + tmp_str + '] INTO ALPHA, where Z=' + tmp_zindex_alpha + ' OPACITY=' + $('#jony5_banner_lifestyle_beta').css('opacity') + '.', self.CRNRSTN_DEBUG_LIFESTYLE_BANNER);

        this.load_image_lowest_z_indice('jony5_banner_lifestyle_alpha', 'jony5_banner_lifestyle_beta', tmp_next_image);

        this.log_activity('1837 :: INITIALIZE 7 SECOND TTL ON ELEMENT HOLD - BANNER IMAGE ROTATION.', this.CRNRSTN_DEBUG_LIFESTYLE_BANNER);
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

    }

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

    }

    CRNRSTN_JS.prototype.refresh_ui_state = function(request_key, request_checksum) {

        //
        // START UI REFRESH TRANSACTION. HERE, ONLY ONE (1) AT ANY GIVEN TIME, PLEASE.
        if(this.authorize_transaction(request_key, request_checksum, 1)) {

            //alert('WE GOOD!');
            this.ttl_transport_monitor_seconds = -1;
            this.update_transaction_count();

            //
            // UI :: UPDATE PRIMARY SEQUENCE CONTROLLER
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

    }

    CRNRSTN_JS.prototype.receive_data_transport_response = function(response_data) {

        if(response_data != null){

            var NODE_crnrstn_client_response = response_data.getElementsByTagName('crnrstn_client_response');

            if(NODE_crnrstn_client_response.length > 0){

                //
                // CONSUME XML RESPONSE DATA
                this.consume_data_transport_response(response_data, 'XML');

                //
                // SYNC CLIENT STATE TO THE FRESH XML
                tmp_data_signature_request_key = this.return_data_transport_xml_data('data_signature_request_key');
                tmp_data_signature_request_checksum = this.return_data_transport_xml_data('data_signature_request_checksum');

                this.refresh_ui_state(tmp_data_signature_request_key, tmp_data_signature_request_checksum);

            }
        }

    };

    // CRNRSTN_JS.prototype.process_data_transport_response = function(oItemNode) {
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
        $('<div id="lightboxOverlay" tabindex="-1" class="lightboxOverlay"></div><div id="lightbox" tabindex="-1" class="lightbox"><div class="lb-outerContainer"><div class="lb-container"><img class="lb-image" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" alt=""/><div class="lb-nav"><a class="lb-prev" aria-label="Previous image" href="" ></a><a class="lb-next" aria-label="Next image" href="" ></a></div><div class="lb-loader"><a class="lb-cancel"></a></div></div></div><div class="lb-dataContainer"><div class="lb-data"><div class="lb-details"><span class="lb-caption"></span><span class="lb-number"></span></div><div class="lb-closeContainer"><a class="lb-close"></a></div></div></div></div>').appendTo($('body'));

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
            for (var i = 0; i < $links.length; i = ++i) {

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

                for (var j = 0; j < $links.length; j = ++j) {

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

    }

    //
    // SOURCE :: https://stackoverflow.com/questions/14129953/how-to-encode-a-string-in-javascript-for-displaying-in-html
    // AUTHOR :: j08691:: https://stackoverflow.com/users/616443/j08691
    CRNRSTN_JS.prototype.html_entities = function(str){

        return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');

    }

    CRNRSTN_JS.prototype.log_out = function(str){

        var curr_date_obj = new Date();

        switch(this.CRNRSTN_LOGGING_OUTPUT){
            case 'DOM':

                var log_out = '[' + this.return_log_date_string(curr_date_obj, 'sys_ts') + '] [rtime' + this.return_log_date_string(curr_date_obj, 'sys_rtime') + '] :: ' + str;
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
                console.log('[' + this.return_log_date_string(curr_date_obj, 'sys_ts') + '] [rtime' + this.return_log_date_string(curr_date_obj, 'sys_rtime') + '] :: ' + str);

            break;

        }

    }

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

    CRNRSTN_JS.prototype.return_log_date_string = function(date_obj, type, abbreviated = true){

        var output_str = '';

        switch(type){
            case 'sys_rtime':
                //0.434234 secs
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

                var day = this.return_log_date_string(date_obj, 'day');
                var month = this.return_log_date_string(date_obj, 'month');
                var date = this.return_log_date_string(date_obj, 'date');
                var hours = this.return_log_date_string(date_obj, 'hours');
                var minutes = this.return_log_date_string(date_obj, 'minutes');
                var seconds = this.return_log_date_string(date_obj, 'seconds');
                var year = this.return_log_date_string(date_obj, 'year');

                output_str = day + ' '+ month + ' ' + date + ' ' + hours + ':' + minutes + ':' + seconds + ' ' + year;

            break;
            case 'sys_ts':
                //2021-11-20 08:48:42.179295
                //  date_obj.getTimezoneOffset();

                var day = this.return_log_date_string(date_obj, 'day');
                var month = date_obj.getMonth();
                var date = this.return_log_date_string(date_obj, 'date');
                var hours = this.return_log_date_string(date_obj, 'hours');
                var minutes = this.return_log_date_string(date_obj, 'minutes');
                var seconds = this.return_log_date_string(date_obj, 'seconds');
                var year = this.return_log_date_string(date_obj, 'year');

                output_str = year + '-'+ month + '-' + date + ' ' + hours + ':' + minutes + ':' + seconds + ' ' + date_obj.getTimezoneOffset();

            break;
            case 'day':
                // Mon
                // this.client_day_abbrev_ARRAY = ['Sun', 'Mon','Tues','Wed','Thurs','Fri','Sat'];
                // this.client_day_ARRAY = ['Sunday', 'Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];

                var day = date_obj.getDay();
                if(abbreviated){

                    output_str = this.client_day_abbrev_ARRAY[day];

                }else{

                    output_str = this.client_day_ARRAY[day];

                }

            break;
            case 'date':
                // 29
                output_str = date_obj.getDate();

            break;
            case 'month':
                // this.client_month_abbrev_ARRAY = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sept','Oct','Nov','Dec'];
                // this.client_month_ARRAY = ['January','February','March','April','May','June','July','August','September','October','November','December'];

                var month = date_obj.getMonth();
                if(abbreviated){

                    output_str = this.client_month_abbrev_ARRAY[month];

                }else{

                    output_str = this.client_month_ARRAY[month];

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
                output_str = secs + '.' + this.client_millisecs;

            break;

        }

        return output_str;

    };

    //
    // SOURCE :: https://stackoverflow.com/questions/2901102/how-to-print-a-number-with-commas-as-thousands-separators-in-javascript
    // AUTHOR :: https://stackoverflow.com/users/28324/elias-zamaria
    CRNRSTN_JS.prototype.pretty_format_number = function(num){

        var parts = num.toString().split(".");
        parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");

        return parts.join(".");

    }

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

    }

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

        for (i = 0; i < str.length; i++) {
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
            this.log_activity('3052 :: ALPHA Z-SHIFTED ' + tmp_zindex_alpha + '->' + tmp_zindex_beta + '. [' + tmp_str + '] NOW FIRING! OPACITY-TRANSITION ' + $('#' + dom_element_alpha).css( "opacity" ) + ' TO  1.0.', this.CRNRSTN_DEBUG_LIFESTYLE_BANNER);

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

                            if(self.jony5_lifestyle_banner_sequence_control_ARRAY.length > self.jony5_lifestyle_banner_sequence_position + 1){

                                self.jony5_lifestyle_banner_sequence_position = self.jony5_lifestyle_banner_sequence_position + 1;
                                var tmp_next_image = self.jony5_lifestyle_banner_sequence_control_ARRAY[self.jony5_lifestyle_banner_sequence_position];

                                var tmp_str = self.extract_filename(tmp_next_image);
                                self.log_activity('3091 :: QUEUE IMAGE ' + self.jony5_lifestyle_banner_sequence_position + ' FROM CACHE. [' + tmp_str + '] POS[' + self.jony5_lifestyle_banner_sequence_position + '].', self.CRNRSTN_DEBUG_LIFESTYLE_BANNER);

                            }else{

                                var tmp_index = self.return_random_index_int(self.jony5_lifestyle_banner_images_ARRAY);
                                var tmp_next_image = self.jony5_lifestyle_banner_images_ARRAY[tmp_index];

                                self.jony5_lifestyle_banner_sequence_control_ARRAY.push(tmp_next_image);
                                self.jony5_lifestyle_banner_sequence_position++;

                                var tmp_str = self.extract_filename(tmp_next_image);
                                self.log_activity('3102 :: QUEUE RANDOM IMAGE ' + tmp_index + ' (OUT OF ' + self.jony5_lifestyle_banner_images_ARRAY.length + '). [' + tmp_str + '].', self.CRNRSTN_DEBUG_LIFESTYLE_BANNER);

                            }

                            if(self.jony5_lifestyle_banner_sequence_position > 0){

                                $('#img_back_controller').css('visibility', 'visible');

                            }else{

                                $('#img_back_controller').css('visibility', 'hidden');

                            }

                            self.load_image_lowest_z_indice('jony5_banner_lifestyle_alpha', 'jony5_banner_lifestyle_beta', tmp_next_image);

                            self.log_activity('3107 :: INITIALIZE 7 SECOND TTL ON ELEMENT HOLD - BANNER IMAGE ROTATION.', self.CRNRSTN_DEBUG_LIFESTYLE_BANNER);
                            self.execution_delay_ui_sync_controller('schedule', 'lifestyle_banner_image_rotation', 7);

                        }

                    });

                }
            });

        }else{

            var tmp_str = $('#' + dom_element_beta).html();
            tmp_str = this.extract_filename(tmp_str);
            this.log_activity('3121 :: BETA Z-SHIFTED ' + tmp_zindex_beta + '->' + tmp_zindex_alpha + ' [' + tmp_str + '] NOW FIRING! OPACITY-TRANSITION ' + $('#' + dom_element_beta).css( "opacity" ) + ' TO  1.0.', this.CRNRSTN_DEBUG_LIFESTYLE_BANNER);

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

                            if(self.jony5_lifestyle_banner_sequence_control_ARRAY.length > self.jony5_lifestyle_banner_sequence_position + 1){

                                self.jony5_lifestyle_banner_sequence_position = self.jony5_lifestyle_banner_sequence_position + 1;
                                var tmp_next_image = self.jony5_lifestyle_banner_sequence_control_ARRAY[self.jony5_lifestyle_banner_sequence_position];
                                var tmp_str = self.extract_filename(tmp_next_image);
                                self.log_activity('3159 :: QUEUE IMAGE ' + self.jony5_lifestyle_banner_sequence_position + ' FROM CACHE. [' + tmp_str + '] POS[' + self.jony5_lifestyle_banner_sequence_position + '].', self.CRNRSTN_DEBUG_LIFESTYLE_BANNER);

                            }else{

                                var tmp_index = self.return_random_index_int(self.jony5_lifestyle_banner_images_ARRAY);
                                var tmp_next_image = self.jony5_lifestyle_banner_images_ARRAY[tmp_index];

                                self.jony5_lifestyle_banner_sequence_control_ARRAY.push(tmp_next_image);
                                self.jony5_lifestyle_banner_sequence_position++;

                                var tmp_str = self.extract_filename(tmp_next_image);
                                self.log_activity('3170 :: QUEUE RANDOM IMAGE ' + tmp_index + ' (OUT OF ' + self.jony5_lifestyle_banner_images_ARRAY.length + '). [' + tmp_str + '].', self.CRNRSTN_DEBUG_LIFESTYLE_BANNER);

                            }

                            if(self.jony5_lifestyle_banner_sequence_position > 0){

                                $('#img_back_controller').css('visibility', 'visible');

                            }else{

                                $('#img_back_controller').css('visibility', 'hidden');

                            }

                            self.load_image_lowest_z_indice('jony5_banner_lifestyle_alpha', 'jony5_banner_lifestyle_beta', tmp_next_image);

                            self.log_activity('3186 :: INITIALIZE 7 SECOND TTL ON ELEMENT HOLD - BANNER IMAGE ROTATION.', self.CRNRSTN_DEBUG_LIFESTYLE_BANNER);
                            self.execution_delay_ui_sync_controller('schedule', 'lifestyle_banner_image_rotation', 7);

                        }

                    });

                }

            });

        }

    }

    CRNRSTN_JS.prototype.extract_filename = function(str_path){

        var str_array = str_path.split('http://172.16.225.128/jony5/common/imgs/lifestyle_banner/desktop/');
        var tmp_str = str_array[1];
        var str_array = tmp_str.split('" width="1180" height="250" alt="Jonathan \'J5\' Harris">');

        return str_array[0];

    }

    CRNRSTN_JS.prototype.transition_lifestyle_banner_elem = function(dom_element_alpha, dom_element_beta){

        var self = this;

        //
        // dom_element_alpha = dom_element_beta = string data
        tmp_zindex_alpha = $('#' + dom_element_alpha).css( "zIndex" );
        tmp_zindex_beta = $('#' + dom_element_beta).css( "zIndex" );

        $('#' + dom_element_alpha).css('zIndex', tmp_zindex_beta);
        $('#' + dom_element_beta).css('zIndex', tmp_zindex_alpha);

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

                            self.log_activity('3245 :: INITIALIZE 7 SECOND TTL ON ELEMENT HOLD - BANNER IMAGE ROTATION.', self.CRNRSTN_DEBUG_LIFESTYLE_BANNER);
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

                            self.log_activity('3278 :: INITIALIZE 7 SECOND TTL ON ELEMENT HOLD - BANNER IMAGE ROTATION.', self.CRNRSTN_DEBUG_LIFESTYLE_BANNER);
                            self.execution_delay_ui_sync_controller('schedule', 'lifestyle_banner_image_rotation', 7);

                        }

                    });

                }

            });

        }

    }

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

                    self.log_activity('3317 :: LOAD [' + tmp_fname + '] INTO ALPHA, where Z=' + tmp_zindex_alpha + ' OPACITY=' + $('#' + dom_element_alpha).css('opacity') + '.', self.CRNRSTN_DEBUG_LIFESTYLE_BANNER);

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
                    self.log_activity('3335 :: LOAD [' + tmp_fname + '] INTO BETA, where Z=' + tmp_zindex_beta + ' OPACITY=' + $('#' + dom_element_beta).css('opacity') + '.', self.CRNRSTN_DEBUG_LIFESTYLE_BANNER);

                }
            });

        }

    }

    CRNRSTN_JS.prototype.rotate_lifestyle_banner_image = function(){

        //
        // SHIFT LOWER DOM ELEMENT TO HIGHER POSITION AND TRANSITION TO VISIBLE
        this.rotate_jony5_lifestyle_image('jony5_banner_lifestyle_alpha', 'jony5_banner_lifestyle_beta');

    }

    CRNRSTN_JS.prototype.toggle_banner_mode = function(mode = 'pause_play'){

        switch(mode){
            case 'pause_play':

                if(this.jony5_banner_mode == 'PLAY'){

                    this.jony5_banner_mode = 'PAUSE';
                    this.log_activity('3360 :: STOP BANNER IMAGE ROTATION.', this.CRNRSTN_DEBUG_LIFESTYLE_BANNER);
                    this.execution_delay_ui_sync_controller('stop', 'lifestyle_banner_image_rotation');


                }else{

                    this.jony5_banner_mode = 'PLAY';
                    this.log_activity('3367 :: INITIALIZE 7 SECOND TTL ON ELEMENT HOLD - BANNER IMAGE ROTATION.', this.CRNRSTN_DEBUG_LIFESTYLE_BANNER);
                    this.execution_delay_ui_sync_controller('schedule', 'lifestyle_banner_image_rotation', 7);

                }

                this.jony5_lifestyle_play_button_mode();

            break;
            case 'forward':

                this.jony5_lifestyle_advance_button('forward');

            break;
            case 'back':

                this.jony5_lifestyle_advance_button('back');

            break;

        }

    }

    CRNRSTN_JS.prototype.jony5_lifestyle_advance_button = function(mode){

        switch(mode){
            case 'forward':



            break;
            case 'back':
                this.execution_delay_ui_sync_controller('stop', 'lifestyle_banner_image_rotation');

                this.jony5_lifestyle_banner_sequence_position = this.jony5_lifestyle_banner_sequence_position - 3;

                if(this.jony5_lifestyle_banner_sequence_position > 0){

                    $('#img_back_controller').css('visibility', 'visible');

                }else{

                    $('#img_back_controller').css('visibility', 'hidden');

                }

                this.log_activity('3413 :: BACK CLICKED. NEW (-3) SEQ POS=[' + this.jony5_lifestyle_banner_sequence_position + '] IMAGE AT SEQ POS[' + this.jony5_lifestyle_banner_sequence_control_ARRAY[this.jony5_lifestyle_banner_sequence_position] + '] TOT IMAGE CNT=[' + this.jony5_lifestyle_banner_sequence_control_ARRAY.length + ']', this.CRNRSTN_DEBUG_BASIC);

                this.load_image_lowest_z_indice('jony5_banner_lifestyle_alpha', 'jony5_banner_lifestyle_beta', this.jony5_lifestyle_banner_sequence_control_ARRAY[this.jony5_lifestyle_banner_sequence_position]);

                this.transition_lifestyle_banner_elem('jony5_banner_lifestyle_alpha', 'jony5_banner_lifestyle_beta');

                //this.execution_delay_ui_sync_controller('fire', 'lifestyle_banner_image_rotation');

            break;

        }

    }

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

    }

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

    }

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

function parse_data_transport_response(response_data) {

    oCRNRSTN_JS.log_activity('Receiving form POST data transport response.', oCRNRSTN_JS.CRNRSTN_DEBUG_VERBOSE);

    oCRNRSTN_JS.receive_data_transport_response(response_data);

}