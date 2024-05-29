/*
// J5
// Code is Poetry */

// lowly JavaScript Document

var myAjax = "";
var ajax_root;
var requestedmodule = "";

var banner_pause_buffer_ttl = 2500;		// APPLIES TO SCRIPTURE <A> CLICKS.
var bannerImageIndexARRAY = [];
var objectArrayBannerImageIndex = 0;
var imageHTML_ARRAY = [];
var shownImage_ARRAY = [];
var imageDisplayControllerQueue_ARRAY = [];
var currentBackControlIndex = 0;
var img_request_duration_secs = 0;
var last_img_index = 0;
var track_img_request_duration = false;
var img_rotation_sleep = 0;
var img_rotation_locked = false;
var img_button_sleep = 0;
var jesus_christ_is_lord = '';
var satan_is_a_liar = '';
var bassdrive_active_sync_delay = 0;
var bassdrive_social_height = 0;
var rotateBanner_delay = 0;
var banner_display_cnt = 0;
var image_err_load_cnt = 0;
var view_state_sleep_flag = 0;
var delay_refresh_from_sleep = 0;
var delay_main_refresh = 0;
var delay_colors_refresh = 0;
var delay_social_refresh = 0;
var delay_truth_refresh = 0;
var current_bass_situation = '';
var current_locale_state = 'DOWN';
var ui_status_indicator_cnt = 5;
var transition_title = '';
var bassdrive_curr_total_bandwidth = '';
var bassdrive_curr_total_connections = '';
var bassdrive_curr_total_name = '';
var bassdrive_curr_total_capacity = '';
var bassdrive_curr_total_bandwidthFormat = '';
var curr_lifestyle_container_top = 'banner_lifestyle_alpha';
var back_lck = true;
var forward_lck = true;
var tmp_node = undefined;
var bassdrive_sync_uri_params = '';
var stats_sync_content;
var stream_info_sync_content;
var alert_events_flag_ARRAY = [];
var copy_clipboard_active = 'FALSE';
var copy_clipboard_fadeout_ttl = 7;
var copy_clipboard_fadeout_ttl_reset = 7;

var ojson_packet_ARRAY = [];
var ojson_packet_output_ARRAY = [];
ojson_packet_output_ARRAY['json_cummulative'] = '';
var ojson_elem_flag_HANDLE_ARRAY = [];
var ojson_elem_flag_ARRAY = [];
var ojson_packet_txt = '';
var ojson_stringify_ARRAY = [];

var tmp_wrk_str;
var refresh_colors = false;
var broadcast_nation;

var broadcast_scroller_serial = [];
var broadcast_scroller_dynamic = [];
var broadcast_scroller_width = [];
var broadcast_colors_width = [];
var broadcast_nation_thumb_width;
var broadcast_title;
var broadcast_locale;
var broadcast_is_LIVE;
var broadcast_scroller_content;

//
// HERE IS THE DOCUMENT CONNECTION STRING ROOT VAR.
// ** THIS MUST BE ABSOLUTE TO HTTP **
// ** FOR THE XML TO SUCCESSFULLY PARSE **
var urlbase = "";

var log_controller = 1;   // [0=off|1=on]
var activity_log_FLAG;

var bassdrive_for_BOLD_RED = ['LIVE!!!', 'Live!!', 'LIVE!', ' live', ' Live ', ' LIVE', 'Live!', '*LIVE*', 'Live'];
var bassdrive_month = ['Jan','Feb','Mar','Apr','May','Jun','Jul','July','Aug','Sept','Oct','Nov','Dec'];
var bassdrive_day = ['31','30','29','28','27','26','25','24','23','22','21','20','19','18','17','16','15','14','13','12','11','10','9','8','7','6','5','4','3','2','1'];

var specialty = ['Wadjit (Canada)', 'Wadjit (CAN)', 'Wadjit (CANADA)', 'Wadjit (canada)', 'Wadjit (can)', 'THE GREENROOM', 'Blu Saphir'];
var specialty_out = ['Wadjit <img src="https://jony5.com/common/imgs/canada_thumb.gif" width="33" height="16" alt="Canada" title="Canada">','Wadjit <img src="https://jony5.com/common/imgs/canada_thumb.gif" width="33" height="16" alt="Canada" title="Canada">','Wadjit <img src="https://jony5.com/common/imgs/canada_thumb.gif" width="33" height="16" alt="Canada" title="Canada">','Wadjit <img src="http://jony5.com/common/imgs/canada_thumb.gif" width="33" height="16" alt="Canada" title="Canada">','Wadjit <img src="https://jony5.com/common/imgs/canada_thumb.gif" width="33" height="16" alt="Canada" title="Canada">', '<span style="color:#06730A; font-weight: bold; font-size: 110%;">THE GREENROOM</span>', '<span style="color:#3133D5; font-weight: bold;">Blu Saphir</span>'];

/*
str = str.replace(" LIVE", "&nbsp;<span style=\"color:#F00; font-weight: bold;\">LIVE</span>");
str = str.replace(" Live ", "&nbsp;<span style=\"color:#F00; font-weight: bold;\">LIVE </span>");
str = str.replace(" live", "&nbsp;<span style=\"color:#F00; font-weight: bold;\">LIVE</span>");
str = str.replace("LIVE!!!", "<span style=\"color:#F00; font-weight: bold;\">LIVE!!!</span>");
str = str.replace("Live!!", "<span style=\"color:#F00; font-weight: bold;\">LIVE!!</span>");

*/

var bassdrive_find_HYPER_LNK = ['tweet@DrumObsessionPL', 'facebook.com/louis.overfiend', 'fb.com/louis.overfiend', 'www.facebook.com/operondnb', 'www.northerngroove.co.uk/', 'Facebook.com/DLO.DNB', 'RandomMovementMusic', 'Random_Movement', 'www.soundcloud.com/amnesty', 'www.facebook.com/NateReflect', 'FB/impression2377', '@schematicdnb', 'fb.com/thebryangee', '@warmearsmusic', 'Insta@fuzedfunk', 'insta/impression_ucr', 'fb.com/drumobsession', 'fb.com/DrumObsession', '@bdxposure', 'https://xo.am/', 'www.northerngroove.co.uk', 'www.djspim.com', 'fb.com/schematicdnb', 'www.Facebook.com/NateReflect', 'soundcloud.com/LQDAudio', 'Facebook.com/JasonMagin', 'facebook.com/impression23'];
var bassdrive_replace_HYPER_LNK = ['https://twitter.com/DrumObsessionPL', 'https://www.facebook.com/louis.overfiend/', 'https://www.facebook.com/louis.overfiend', 'https://www.facebook.com/operondnb', 'http://www.northerngroove.co.uk/', 'https://www.facebook.com/DLO.DNB', 'https://www.instagram.com/Randommovementmusic/', 'https://twitter.com/random_movement' , 'https://soundcloud.com/amnesty', 'https://www.facebook.com/NateReflect/', 'https://www.facebook.com/Impression2377/', 'https://www.facebook.com/schematicdnb/', 'https://www.facebook.com/thebryangee/', 'https://www.instagram.com/warmearsmusic/', 'https://www.instagram.com/fuzedfunk/', 'https://www.instagram.com/impression_ucr/', 'https://www.facebook.com/drumobsession', 'https://www.facebook.com/drumobsession', 'https://twitter.com/bdxposure', 'https://xo.am/', 'http://www.northerngroove.co.uk/', 'http://www.djspim.com', 'https://www.facebook.com/schematicdnb', 'https://www.facebook.com/NateReflect', 'https://soundcloud.com/LQDAudio', 'https://www.facebook.com/JasonMagin', 'https://www.Facebook.com/impression23'];

//
// INITIALIZE TIMER AND
// STATE CONTROLLER.
wallTimer = setTimeout("syncWallTimeState()", 1000);
clearTimeout(wallTimer);

bannerRotationTimer = setTimeout("rotateBanner()", 15000);
clearTimeout(bannerRotationTimer);

//bassdriveSyncTimer = setTimeout("bassdriveSync()", 45000);
//clearTimeout(bassdriveSyncTimer);

//speakTheTruthTimer = setTimeout("stateOfSituationSync()", 30000);
//clearTimeout(speakTheTruthTimer);

//
// INITIALIZE DOM.
$.when(

	//$.getJSON("ajax/test.json"),
	$.ready

).done(function(){

	//
	// THE DOCUMENT IS READY.
	// Value of test.json can be passed in as `data`.
	log_activity("DOM ready.");

	initGlobal();

	var tmp_logging = getUrlParameter('logs');
	var tmp_audio = false;
	var showbg_demo = false;
	var tmp_overlayfs = false;

	if($('#ajax_root').length){

		ajax_root = $('#ajax_root').html();

	}else{

		ajax_root = 'https://jony5.com/';

	}

	var is_prod = ajax_root.indexOf("jony5.com");

	if((tmp_logging == true) || (tmp_logging == 'true')){

		activity_log_FLAG = 'WeloveJesus!';

		document.getElementById('activity_log').style.opacity = 0.8;

	}else{

		log_controller = 0;

		urlbase = $('#ajax_root').html();

	}

	if((tmp_overlayfs == true) || (tmp_overlayfs == 'true')){

		profile_overload = true;

		//
		// LOAD FULL SCREEN DEMO.
		profile_xml_http = ajax_root + 'common/xml/_profiles/2019seblendjville_fullscrn4674863872.xml';

		profile_overload_xml_ARRAY.push(profile_xml_http);

		profile_xml_http = ajax_root + 'common/xml/_profiles/2019seblendjville_mini4674863872f.xml';
		profile_overload_xml_ARRAY.push(profile_xml_http);

		syncOverlayStateXML(1);

	}

	if(showbg_demo == '1'){

		//
		// SHOW DEMO BG.
		ajax_root = $('#ajax_root').html();
		tmp_http_uri = ajax_root + 'common/imgs/overlay_OBS_demo_bg_compressed.jpg';
		document.body.style.backgroundColor = "#0057F6";
		document.body.style.backgroundImage = "url('" + tmp_http_uri + "')";
		showbg_demo = '0';

	}

	if((tmp_audio == true) || (tmp_audio == 'true')){

		//
		// SOURCE :: https://stackoverflow.com/questions/38316679/autoplay-html-audio-created-with-javascript
		// AUTHOR :: https://stackoverflow.com/users/1927618/radiantstatic
		ajax_root = $('#ajax_root').html();
		var source = ajax_root + "common/audio/jehovah_has_revealed_his_heart.mp3";

		/*
		//test_oAudio = new Audio(); // use the constructor in JavaScript, just easier that way

		tmp_html = '<audio autoplay loop>' +
			'      <source src="' + source + '">' +
			'</audio>';

		test_oAudio.addEventListener("load", function(){
			test_oAudio.play();
		}, true);

		test_oAudio.src = source;
		test_oAudio.autoplay = true; // add this

		// setTimeout(autoPlayCheck, 4000);

	   */

		tmp_html = '<audio id="sample_audio" controls autoplay>' +
			'<source src="' + source + '" type="audio/mpeg">' +
			'Your browser does not support the audio element.' +
			'</audio>';

		var objAudioDiv = document.createElement('div');
		objAudioDiv.setAttribute('id', 'testAudio');
		objAudioDiv.setAttribute('class', 'hidden');

		$("#mini_overlay_handle").append(objAudioDiv);

		//$('#testAudio').html(tmp_html);
		objAudioDiv.innerHTML = tmp_html;
		log_activity('Load AUDIO TEST file [' + source + '] Play for 30 seconds.');

		//var sample_audio = document.getElementById("sample_audio");
		//sample_audio.autoplay = true;
		//sample_audio.loop = true;
		//sample_audio.load();
		//sample_audio.play();

	}

	if($('#static_jony5_performance_report_return').length){

		if($('#static_jony5_performance_report_wrapper').length){

			var tmp_report = $('#static_jony5_performance_report_return').html();
			$('#static_jony5_performance_report_wrapper').html(tmp_report);

		}

	}

});

function launch_search_for_the_precious(dom_form_wrapper_id){

	//
	// COPY THE SOURCE SEARCH UGC INPUT <FORM>
	// TO THE TARGET DOM CONTAINER.
	$('#' + target_element_id).html($('#' + source_element_id).html());

	//
	// EMPTY THE SOURCE DOM CONTAINER.
	$('#' + source_element_id).html('');

}

function log_activity(str){

	switch(log_controller){
		case 1:

			if(activity_log_FLAG != ''){

				//
				// LOG ACTIVITY TO SCREEN.
				var timeStampInMs = window.performance && window.performance.now && window.performance.timing && window.performance.timing.navigationStart ? window.performance.now() + window.performance.timing.navigationStart : Date.now();

				var walltime = $("#wall_time").html();
				var objLOGDiv = document.createElement('div');
				objLOGDiv.setAttribute('class', 'log_entry');

				$("#activity_log_output").prepend(objLOGDiv);

				//
				// A CLEAN STRING FOR USE IN
				// HTML DOM INJECTIONS.
				//
				// E.G.:
				// &lt;profile&gt;
				str_clean = htmlEntities(str);

				objLOGDiv.innerHTML = timeStampInMs + ' (' + walltime + ') :: ' + str_clean;
				console.log(timeStampInMs + ' (' + walltime + ') :: ' + str);

			}

		break;
		case 0:
			//
			// SILENCE IS GOLDEN.

		break;
		default:

			alert('The logger param [var log_controller] is not visible to me.');

		break;

	}

}

function initGlobal(){

	log_activity('Starting heartbeats...');
	startHeartBeats();

	// if($('#bassdrive_nowplaying_wrapper').length){
	//
	// 	bassdriveSync();
	//
	// }

	if($('#page_scroll_to').length){

		var scroll_to_elem = $('#page_scroll_to').html();

		jony5_scroll_to(scroll_to_elem);

	}

	if($('#vv_deep_link_active').length){

		//
		// DISABLE PAGE SCROLLING.
		$('body').addClass('lb-disable-scrolling');

		scripture_vv = extract_http_get_param_data('vv');

		$('#scripture_lightbox_overlay').animate({
			height: $(document).height(),
			width: $(document).width()
		}, {
			duration: 0,
			queue: false,
			complete: function(){

				$('#scripture_lightbox_overlay').animate({
					opacity: 0.5
				}, {
					duration: 500,
					queue: false,
					specialEasing: {
						opacity: "swing"
					},
					complete: function(){

						var HTTP_ROOT = $('#ajax_root').html();
						var uri = HTTP_ROOT + 'scriptures/';
						var params = '?vv=' + scripture_vv;
						uri = uri + params;

						var arrayPageSize = getPageSize();

						// calculate top offset for the popup
						var arrayPageSize = getPageSize();
						var arrayPageScroll = getPageScroll();
						var scriptureTop = arrayPageScroll[1] + (arrayPageSize[3] / 15);
						var top_px = scriptureTop + 'px';

						$("#script_popup_lock").html("ON");

						if($("#script_popup").length){
							var tmp_vv_html = '<div id="script_wrapper">' +
								'<div id="script_loading_book_icon"><img src="' + HTTP_ROOT + 'common/imgs/book_icon.jpg" width="600" height="200" alt="Holy Bible" title="Holy Bible"></div>' +
								'<div id="script_loading"><img src="' + HTTP_ROOT + 'common/imgs/long_loader.gif" width="220" height="19" alt="CRNRSTN :: LOADING..." title="CRNRSTN :: LOADING..."></div>' +
								'<div class="cb"></div></div>';

							$("#script_popup").html(tmp_vv_html);

							$('#script_popup').css('top', top_px);

							log_activity("Sending XHR request [_GET][" + uri + "].");

							$.ajax({
								type: "POST",
								url: uri,
								dataType: "html",
								success: displayScriptures

							});

						}

						$("#scripture_lightbox_overlay").animate({
							opacity: 0.5
						}, {
							duration: 2000,
							queue: false,
							specialEasing: {
								opacity: "linear"
							},
							complete: function(){

								//
								// PAUSE LIFESTYLE BANNER ROTATION.
								//toggle_banner_mode();

								if($('#vv_deep_link_active').length){

									scripture_vv = extract_http_get_param_data('vv');

									if(scripture_vv.length < 1){

										jony5_scroll_to();

									}

								}

							}

						});

					}

				});

			}

		});

	}

	rotateBanner();

	if($("#body_wrapper").length){

		$("#body_wrapper").onclick = function(event){

			if($("#script_popup_lock").html() == "OFF"){

				clearScriptures();

			}

			$("#script_popup_lock").html("OFF");

		}

	}

	//
	// SCRIPTURE POPUP RESIZE CONTROLLER.
	if($('#script_popup_window_handle').length){

		var curr_window_height = parseInt($(window).height);
		var content_height = $('#script_wrapper').height();
		var content_width = $('#script_wrapper').width();

		var tgt_window_height = parseInt(content_height) + 54;
		var tgt_window_width = parseInt(content_width) + 3;

		//
		// SOURCE :: https://stackoverflow.com/questions/6709408/how-to-resize-a-window-using-jquery
		// COMMENT :: https://stackoverflow.com/a/6709468
		// AUTHOR :: ShankarSangoli :: https://stackoverflow.com/users/772055/shankarsangoli
		window.resizeTo(tgt_window_width, tgt_window_height);

	}

	//
	// FOOTER COPY.
	if($("footer-copyright")){

		form_sysdate = new Date();
		var dy = fullYear(form_sysdate);
		$("#footer-copyright").html("&copy; "+dy+" Jonathan '5' Harris :: All Rights Reserved.");

	}

	//
	// PAGE LOAD SCROLL.
	//scrollTo_PageLoad();

	//tgt=lsm
	var tgt = gup('tgt');
	if(tgt == 'lsm'){

		new Effect.ScrollTo("podcast_listen_btn", {offset: (0*1)+(0*1)});

	}

	//
	// TRANSACTION STATUS MESSAGE CONTROLLER.
	if($('#user_transaction_status_msg').length){

		if($('#user_transaction_status_msg').html() != ''){

			usr_transTimer = setTimeout(toggleTransactionWrapperOpen, 1200);

		}

	}

	//
	// FORM FOCUS TO PREVENT MOBILE FORM PRE-
	// POPULATE SUGGESTIONS GLITCH.
	//if($("#feedback").length){
	//
	//	$("#feedback").focus();
	//
	//}

	//
	// WORDPRESS FORM THAT IS STEALING FOCUS ON LOAD.
	/*
	if($("page")){

		var query = window.location.href;
		var vars = query.split("#");
		if(vars.length < 2){

			new Effect.ScrollTo('page', {offset: (0*1)+(0*1)});

		}

	}

	*/

	if($('#banner_button_bg').length){

		$('.banner_button_bg').css('opacity', '0.3');

		$("#img_back_controller").animate({
			opacity: 0.0
		}, {
			duration: 0,
			queue: false,
			specialEasing: {
				opacity: "linear"
			},
			step: function(now, fx){

			},
			complete: function(){

			}

		});

		$("#img_fwd_controller").animate({
			opacity: 0.0
		}, {
			duration: 0,
			queue: false,
			specialEasing: {
				opacity: "linear"
			},
			step: function(now, fx){

			},
			complete: function(){

			}

		});

		$("#banner_control_play_wrapper").animate({
			opacity: 0.0
		}, {
			duration: 0,
			queue: false,
			specialEasing: {
				opacity: "swing"
			},
			step: function(now, fx){

			},
			complete: function(){

			}

		});

	}

	pushToControllerQueue($("#banner_lifestyle").html());

}

function scripture_deep_link_copy_clipboard(serial, deep_link_url){

	copy_clipboard_fadeout_ttl = copy_clipboard_fadeout_ttl_reset;

	copy_clipboard_active = 'TRUE';
	var prefix_element = deep_link_url;
	var target_elem_id = 'scripture_deep_link_' + serial;
	var copy_clipboard_input_source = 'input_scripture_deep_link_' + serial;
	var action_status_elem = 'scripture_deep_link_status_' + serial;

	tmp_copy = '<span style="color:#FFF; font-size:13px; font-weight:normal; padding:1px 3px 1px 3px; border-radius: 15px;"><span style="color:#CF0202;">_</span> Copied! <span style="color:#CF0202;">_</span></span>';
	tmp_share_component_html = '<div id="scripture_deep_link_status_' + serial + '" class="scripture_deep_link_status">' + tmp_copy + '</div>' +
		'                    <div class="cb"></div>' +
		'                    <form action="#" method="post" name="scripture_deep_link_copy_' + serial + '" enctype="multipart/form-data">' +
		'                        <input type="text" id="input_scripture_deep_link_' + serial + '" class="input_scripture_deep_link" name="scripture_deep_link" value="">' +
		'                    </form>';

	$('#' + target_elem_id).html(tmp_share_component_html);
	if(parseInt($('#' + target_elem_id).css('opacity')) < 1){

		$('#' + target_elem_id).animate({
			opacity: 1
		}, {
			duration: 0,
			queue: false,
			complete: function(){

			}

		});

	}

	//$('#' + action_status_elem).html(tmp_copy);
	$('#' + action_status_elem).css('border', '1px #cecece');
	$('#' + action_status_elem).css('backgroundColor', '#CF0202');

	$('#' + copy_clipboard_input_source).val(deep_link_url);
	$('#' + copy_clipboard_input_source).css('backgroundColor', '#F1F2FF');

	copy_clipboard(serial);

	return false;

}

function hide_copy_clipboard(){

	//
	// SOURCE :: https://www.geeksforgeeks.org/how-to-dynamically-create-and-apply-css-class-in-javascript/
	var class_elem_set = document.querySelectorAll(".scripture_deep_link_shell");

	//
	// APPLY CSS PROPERTIES TO
	// THIS ELEMENT SET.
	for(var i = 0; i < class_elem_set.length; i++){

		//
		// PARSE OUT THE SERIAL. crnrstn_module_share_component_{SERIAL}
		var tmp_share_id_ARRAY = class_elem_set[i].id.split('scripture_deep_link_status_');
		var tmp_cnt = tmp_share_id_ARRAY.length;
		for(iii = 0; iii < tmp_cnt; iii++){

			if(tmp_share_id_ARRAY[iii].length > 0){

				$('#' + tmp_share_id_ARRAY[iii]).animate({
					opacity: 0
				}, {
					duration: 500,
					queue: false,
					specialEasing: {
						opacity: "swing"
					},
					complete: function(){

						$('#' + tmp_share_id_ARRAY[iii]).html('');
						$('#' + tmp_share_id_ARRAY[iii]).animate({
							opacity: 1
						}, {
							duration: 0,
							queue: false,
							specialEasing: {
								opacity: "swing"
							},
							complete: function(){

							}

						});

					}

				});

				//this.set_ui_component_state('share_module_click_' + tmp_share_id_ARRAY[iii], 'OFF');
				//document.getElementById("crnrstn_module_share_component_input_" + tmp_share_id_ARRAY[iii]).style.backgroundColor = "#FFF";
				//document.getElementById("crnrstn_module_share_component_copy_status_" + tmp_share_id_ARRAY[iii]).innerHTML = "";

			}

		}

	}

}

function copy_clipboard(serial = 'J5MYBOY!'){

	//
	// SOURCE :: https://stackoverflow.com/questions/1173194/select-all-div-text-with-single-mouse-click
	// COMMENT :: https://stackoverflow.com/a/1173319
	// AUTHOR :: Denis Sadowski :: https://stackoverflow.com/users/136482/denis-sadowski
	if(document.selection){ // IE

		var range = document.body.createTextRange();
		range.moveToElementText(document.getElementById("input_scripture_deep_link_" + serial));
		range.select();

	}else if(window.getSelection){

		var range = document.createRange();
		if($('#input_scripture_deep_link_' + serial).length){

			range.selectNode(document.getElementById("input_scripture_deep_link_" + serial));
			window.getSelection().removeAllRanges();
			window.getSelection().addRange(range);

			//
			// SOURCE :: https://www.w3schools.com/howto/howto_js_copy_clipboard.asp
			/* Copy the text inside the text field */
			document.execCommand('copy');

			/* Alert the copied text */
			//alert("Copied the text: " + document.getElementById("crnstn_print_r_source_' . $tmp_hash . '").innerHTML);
			//document.getElementById("copy_clipboard_input_source" + serial).style.backgroundColor = "#FFF";
			$('#input_scripture_deep_link_' + serial).css('backgroundColor', '#F1F2FF');

		}

	}

}

//
// SOURCE :: https://stackoverflow.com/questions/19491336/how-to-get-url-parameter-using-jquery-or-plain-javascript
// COMMENT :: https://stackoverflow.com/a/21903119
// AUTHOR :: Sameer Kazi :: https://stackoverflow.com/users/1897010/sameer-kazi
function extract_http_get_param_data(sParam){

	var sPageURL = window.location.search.substring(1),
		sURLVariables = sPageURL.split('&'),
		sParameterName,
		i;

	for(i = 0; i < sURLVariables.length; i++){

		sParameterName = sURLVariables[i].split('=');

		if(sParameterName[0] === sParam){

			return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);

		}

	}

	return false;

}

function close_scripture_overlay_modal(){

	//
	// OPACITY 0 THE OVERLAY AND
	// THE VV CONTAINER.
	$('#script_wrapper').animate({
		opacity: 0
	}, {
		duration: 500,
		queue: false,
		specialEasing: {
			opacity: "swing"
		},
		complete: function(){

		}

	});

	$('#scripture_lightbox_overlay').animate({
		opacity: 0
	}, {
		duration: 500,
		queue: false,
		specialEasing: {
			opacity: "swing"
		},
		complete: function(){

			$('#scripture_lightbox_overlay').css('width', '0');
			$('#scripture_lightbox_overlay').animate({
				height: 0,
				width: 0
			}, {
				duration: 0,
				queue: false,
				specialEasing: {
					opacity: "swing"
				},
				complete: function(){

				}

			});

		}

	});

	clearScriptures();

	$('body').removeClass('lb-disable-scrolling');

	$('#script_wrapper').animate({
		opacity: 1
	}, {
		duration: 0,
		queue: false,
		specialEasing: {
			opacity: "swing"
		},
		complete: function(){

		}

	});

}

function syncWallTimeState(){

	if(copy_clipboard_active === 'TRUE'){

		if(copy_clipboard_fadeout_ttl > 0){

			copy_clipboard_fadeout_ttl--;

		}else{

			copy_clipboard_active = 'FALSE';
			copy_clipboard_fadeout_ttl = copy_clipboard_fadeout_ttl_reset;

			hide_copy_clipboard();

		}

	}

	if($("#wall_time").length){

		var time_shown = $("#wall_time").html();
		var time_chunks = time_shown.split(":");
		var hour, mins, secs;

		hour = Number(time_chunks[0]);
		mins = Number(time_chunks[1]);
		secs = Number(time_chunks[2]);
		secs++;

		if(secs == 5){

			//alert($('#minimax_primary_copy_sectA_handle_en').html()+'<--END]');
			//id="minimax_primary_copy_sectA_handle_'+lang_id+'"

		}

		if(secs == 60){

			secs = 0;
			mins = mins + 1;

		}

		if(mins == 60){

			mins = 0;
			hour = hour + 1;

		}

		//if(hour == 13){
		//
		//	hour = 1;
		//
		//}

		$("#wall_time").html(hour + ":" + plz(mins) + ":" + plz(secs));
		log_activity("Wall time...[" + $("#wall_time").html() + "].");

	}

	//
	// FOR THE MAINTENANCE OF THE STATE OF
	// THE USER'S EXPERIENCE.
	sleepBanner();
	// if($('#bassdrive_nowplaying_wrapper').length){
	//
	// 	bassdrive_broadcast_scroll_pos_listener();
	//
	// }

	if(view_state_sleep_flag == 1){

		if(!isPageHidden() && (delay_refresh_from_sleep == 1)){

			delay_refresh_from_sleep = 3;

			//
			// A SLIGHT DELAY.
			//speakTheTruthTimer = setTimeout("stateOfSituationSync()", 5000);

			// if($('#bassdrive_nowplaying_wrapper').length){
			//
			// 	bassdriveSyncTimer = setTimeout("bassdriveSync()", 1500);
			// 	resetViewStateSleep = setTimeout("resetViewState()", 2500);
			//
			// }

		}

	}

}

function resetViewState(){

	delay_refresh_from_sleep = 0;

}

function plz(digit){

	var zpad = digit + '';

	if(digit < 10){

		zpad = "0" + zpad;

	}

	return zpad;

}

function startHeartBeats(){

	//
	// TIMER SEC INTERVAL.
	clearTimeout(wallTimer);
	wallTimer = setInterval("syncWallTimeState()",1000);
	log_activity(":: 1 sec interval wall time process started.");

	// if($("#bassdrive_nowplaying_wrapper").length){
	//
	// 	//hideBassdrive_component(0);
	//
	// 	bassdriveSyncTimer = setInterval("bassdriveSync()", 45000);
	// 	log_activity(":: 45 sec Bassdrive systems sync process started.");
	//
	// 	speakTheTruthTimer = setInterval("stateOfSituationSync()", 30000);
	// 	log_activity(":: 30 sec process started to speak the truth.");
	//
	// 	start_broadcast_scroll('dom_load_driven');
	//
	// }else{
	//
	// 	log_activity(":: 45 sec Bassdrive systems sync process SKIPPED.");
	//
	// }

	if($("#banner_mode_track").length){

		clearInterval(bannerRotationTimer);
		bannerRotationTimer = setInterval("rotateBanner()", 15000);
		log_activity(":: 10 sec lifestyle banner rotation process started.");

	}

}

function return_active_serial(){

	broadcast_scroller_serial.forEach((string_pattern, index) => {

		if(broadcast_scroller_dynamic[string_pattern] == 'active'){

			tmp_serial = string_pattern;

		}

	});

	return tmp_serial;

}

function bassdrive_broadcast_scroll_pos_listener(){

	tmp_curr_active_serial = return_active_serial();

	if($('#bassdrive_broadcast_scroller_' + tmp_curr_active_serial).length){

		scroller_left = window.getComputedStyle(document.getElementById('bassdrive_broadcast_scroller_' + tmp_curr_active_serial)).getPropertyValue("left");

		scroller_left = scroller_left.replace('px', '');

		if(scroller_left < -1 * (broadcast_scroller_width[tmp_serial_seed] - ((broadcast_colors_width[tmp_serial_seed]*1) + 100)) && broadcast_scroller_dynamic[tmp_serial_seed] == 'active'){

			log_activity(':: FIRE CLOSE RIGHT GATE @ position' + scroller_left + ' where width=' + broadcast_scroller_width[tmp_serial_seed]);

			$('#locale_copy_gate_right').animate({
				opacity: 0
			}, {
				duration: 1000,
				queue: false,
				specialEasing: {
					opacity: "swing"
				},
				complete: function(){

				}

			});

		}

		if(scroller_left < -1 * (broadcast_scroller_width[tmp_serial_seed] - ((broadcast_colors_width[tmp_serial_seed] * 1) + (90 - (broadcast_colors_width[tmp_serial_seed] * 1)))) && broadcast_scroller_dynamic[tmp_serial_seed] == 'active'){

			$('#locale_copy_gate_left').animate({
				opacity: 0
			}, {
				duration: 1000,
				queue: false,
				specialEasing: {
					opacity: "swing"
				},
				complete: function(){

				}

			});

		}

	}

}

function start_broadcast_scroll(driver='dom_load_driven'){

	if(driver == 'xhr_driven'){

		$('#component_tech_integration_driver').html('XHR_REQUEST');

		//
		// SUNSET CURRENT SCROLL STATE.
		// tmp_curr_active_serial = return_active_serial();
		// broadcast_scroller_dynamic[tmp_curr_active_serial] = 'inactive';
		//
		// $('#bassdrive_broadcast_scroller_' + tmp_curr_active_serial).animate({
		// 	opacity: 0
		// }, {
		// 	duration: 250,
		// 	queue: false,
		// 	specialEasing: {
		// 		opacity: "linear"
		// 	},
		// 	complete: function(){
		//
		// 		//
		// 		// CLOSE THE GATES.
		// 		$('#locale_copy_gate_right').animate({
		// 			opacity: 0
		// 		}, {
		// 			duration: 250,
		// 			queue: false,
		// 			specialEasing: {
		// 				opacity: "swing"
		// 			},
		// 			complete: function(){
		//
		// 			}
		//
		// 		});
		//
		// 		$('#locale_copy_gate_left').animate({
		// 			opacity: 0
		// 		}, {
		// 			duration: 250,
		// 			queue: false,
		// 			specialEasing: {
		// 				opacity: "swing"
		// 			},
		// 			complete: function(){
		//
		// 			}
		//
		// 		});
		//
		// 	}
		//
		// });

	}

	//
	// EXTRACT ANY STREAM INFO
	// FROM THE DOM.
	broadcast_nation_thumb_width = $('#bassdrive_broadcast_nation_thumb_width').html();
	broadcast_title = $('#broadcast_show_original_title').html();
	broadcast_locale = $('#broadcast_scroller_content').html();
	broadcast_is_LIVE = $('#broadcast_is_LIVE').html();

	//
	// GENERATE THE BROADCAST
	// SERIALIZATION PROFILE.
	tmp_serial_seed = Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2, 15);
	broadcast_scroller_serial.push(tmp_serial_seed);
	broadcast_scroller_dynamic[tmp_serial_seed] = 'active';

	//
	// COMPILE THE CONTENT TO SCROLL
	// HORIZONTALLY (COLORS, WIDTH, THUMB WIDTH, AND COPY).
	tmp_locale_array = return_locale_array();

	if((tmp_locale_array['colors'] != '') && (tmp_locale_array['colors'] != undefined)){

		broadcast_scroller_width[tmp_serial_seed] = tmp_locale_array['width'];
		broadcast_colors_width[tmp_serial_seed] = tmp_locale_array['thumb_width'];

		//
		// BUILD DOM ELEMENTS (COLORS AND COPY).
		var obj_broadcast_colors = document.createElement('div');
		obj_broadcast_colors.setAttribute('id', 'nation_colors_' + tmp_serial_seed);

		$('#nation_colors_wrapper').html('');

		tmp_locale_width = (broadcast_nation_thumb_width * 1) + 15;
		tmp_locale_wrapper_width = (broadcast_nation_thumb_width * 1) + 16;

		$('#broadcast_nation_wrapper').animate({
			width: tmp_locale_wrapper_width
		}, {
			duration: 1000,
			queue: false,
			specialEasing: {
				width: "linear"
			},
			complete: function(){

			}

		});

		$('#broadcast_nation_rel').animate({
			width: tmp_locale_width
		}, {
			duration: 2000,
			queue: false,
			specialEasing: {
				width: "linear"
			},
			complete: function(){

			}

		});

		$("#nation_colors_wrapper").append(obj_broadcast_colors);

		if($('#bassdrive_broadcast_scroller_dyn_wrapper').length){

			//
			// CLEAR EXISTING DOM ELEMENT.
			$('#bassdrive_broadcast_scroller_dyn_wrapper').html('');

		}

		//
		// BUILD THE GATES.
		var obj_gate_left = document.createElement('div');
		obj_gate_left.setAttribute('id', 'locale_copy_gate_left');
		obj_gate_left.setAttribute('class', 'locale_copy_gate_left');

		var obj_gate_right = document.createElement('div');
		obj_gate_right.setAttribute('id', 'locale_copy_gate_right');
		obj_gate_right.setAttribute('class', 'locale_copy_gate_right');

		//
		// BUILD THE SCROLLING COPY ELEMENT.
		var obj_broadcast_copy = document.createElement('div');
		obj_broadcast_copy.setAttribute('id', 'bassdrive_broadcast_scroller_' + tmp_serial_seed);
		obj_broadcast_copy.setAttribute('class', 'bassdrive_broadcast_scroller');

		var obj_broadcast_copy_shell = document.createElement('div');
		obj_broadcast_copy_shell.setAttribute('id', 'bassdrive_broadcast_scroller_shell_' + tmp_serial_seed);
		obj_broadcast_copy_shell.setAttribute('class', 'bassdrive_broadcast_scroller_shell');

		//
		// DRAW THE LINE.
		var obj_cb = document.createElement('div');
		obj_cb.setAttribute('class', 'cb');

		$("#bassdrive_broadcast_scroller_dyn_wrapper").append(obj_gate_left);
		$("#bassdrive_broadcast_scroller_dyn_wrapper").append(obj_broadcast_copy_shell);
		$("#bassdrive_broadcast_scroller_shell_" + tmp_serial_seed).append(obj_broadcast_copy);
		$("#bassdrive_broadcast_scroller_dyn_wrapper").append(obj_gate_right);
		$("#bassdrive_broadcast_scroller_dyn_wrapper").append(obj_cb);

		//
		// INJECT CONTENT INTO IT'S
		// RESPECTIVE DOM ELEMENTS.
		$('#nation_colors_' + tmp_serial_seed).html(tmp_locale_array['colors']);
		$('#bassdrive_broadcast_scroller_' + tmp_serial_seed).html(tmp_locale_array['copy']);

		document.getElementById('locale_copy_gate_left').style.backgroundImage = "url('" + $('#ajax_root').html() + 'common/imgs/copy_fade_12_left.png' + "')";
		document.getElementById('locale_copy_gate_right').style.backgroundImage = "url('" + $('#ajax_root').html() + 'common/imgs/copy_fade_12_right.png' + "')";

		tmp_total_width = 15 + (tmp_locale_array['thumb_width'] * 1);

		//alert(tmp_locale_array['width']);

		//
		// STYLE DOM ELEMENTS
		$('#bassdrive_broadcast_scroller_wrapper').animate({
			width: tmp_total_width
		}, {
			duration: 0,
			queue: false,
			specialEasing: {
				width: "linear"
			},
			complete: function(){

			}

		});

		$('#bassdrive_broadcast_scroller_dyn_wrapper').animate({
			width: tmp_total_width
		}, {
			duration: 0,
			queue: false,
			specialEasing: {
				width: "linear"
			},
			complete: function(){

			}

		});

		//width: tmp_locale_array['thumb_width'] - 15

		$('#bassdrive_broadcast_scroller_shell_' + tmp_serial_seed).animate({
			width: tmp_locale_array['thumb_width']
		}, {
			duration: 0,
			queue: false,
			specialEasing: {
				width: "linear"
			},
			complete: function(){

			}

		});

		$('#bassdrive_broadcast_scroller_' + tmp_serial_seed).animate({
			width: tmp_locale_array['width']
		}, {
			duration: 0,
			queue: false,
			specialEasing: {
				width: "linear"
			},
			complete: function(){

			}

		});

		//
		// RUN THE SEQUENCE.
		roll_sequence(tmp_serial_seed);

	}else{

		if($('#nation_colors_wrapper').length){

			$('#nation_colors_wrapper').html('');

		}

	}

}

function roll_sequence(serial_seed){

	if(current_locale_state == 'UP'){

		current_locale_state = 'TRANSITION';

		$('#animation_06_delay').animate({
			top: 0
		}, {
			duration: 5000,
			queue: false,
			specialEasing: {
				top: "linear"
			},
			complete: function(){

				$('#broadcast_nation_wrapper').animate({
					borderColor: '#F90000'
				}, {
					duration: 2000,
					queue: false,
					specialEasing: {
						top: "linear"
					},
					complete: function(){

						$('#broadcast_nation_wrapper').css('borderColor', '#F90000');

						$('#broadcast_nation').animate({
							top: 0
						}, {
							duration: 5000,
							queue: false,
							specialEasing: {
								top: "linear"
							},
							complete: function(){

								current_locale_state = 'DOWN';

								$('#broadcast_nation_wrapper').animate({
									borderColor: '#FFFFFF'
								}, {
									duration: 2000,
									queue: false,
									specialEasing: {
										borderTopColor: "linear"
									},
									complete: function(){
										$('#broadcast_nation_wrapper').css('borderColor', '#FFFFFF');

									}

								});

							}

						});

					}

				});

			}

		});

	}

	//
	// INITIALIZE SCROLL
	$('#bassdrive_broadcast_scroller_' + serial_seed).animate({
		left: '-' + tmp_locale_array['width'] + 'px'
	}, {
		duration: 244000,
		queue: false,
		specialEasing: {
			left: "linear"
		},
		complete: function(){

			//
			// NEED TO RUN PARENT FUNCTION AGAIN....
			switch(broadcast_scroller_dynamic[serial_seed]){
				case 'inactive':

					//
					// THERE WAS A CHANGE IN
					// BROADCAST PROGRAM.

				break;
				case 'active':

					broadcast_scroller_dynamic[serial_seed] = 'complete';

					start_broadcast_scroll();

				break;

			}

		}

	});

	//
	// INSERT A SEQUENCE BUFFER.
	$("#animation_00_delay").animate({
		opacity: 0
	}, {
		duration: 500,
		queue: false,
		specialEasing: {
			opacity: "swing"
		},
		complete: function(){

			//
			// OPEN THE RIGHT GATE.
			$('#locale_copy_gate_right').animate({
				opacity: 1.0
			}, {
				duration: 2000,
				queue: false,
				specialEasing: {
					opacity: "swing"
				},
				complete: function(){

					//
					// INSERT A SEQUENCE BUFFER.
					$("#animation_01_delay").animate({
						opacity: 0
					}, {
						duration: 200,
						queue: false,
						specialEasing: {
							opacity: "swing"
						},
						complete: function(){

							$('#locale_copy_gate_left').animate({
								opacity: 1.0
							}, {
								duration: 2000,
								queue: false,
								specialEasing: {
									opacity: "swing"
								},
								complete: function(){

								}

							});

						}

					});

				}

			});

		}

	});

}

function return_locale_array(){

	tmp_locale_array = [];
	tmp_nation_flag_creative = '';

	if($('#broadcast_nation').length){

		broadcast_title = $('#stream_info').html();
		thumb_width = $('#bassdrive_broadcast_nation_thumb_width').html();
		broadcast_nation_title = $('#broadcast_nation_title').html();
		tmp_nation_flag_creative = $('#broadcast_nation_img').html();
		tmp_broadcast_locale = $('#broadcast_locale').html();

		if(tmp_nation_flag_creative!=undefined){

			tmp_locale_array['colors'] = '<img src="' + $('#ajax_root').html() + 'common/imgs/bassdrive_component_creative/' + tmp_nation_flag_creative + '" width="' + thumb_width + '" title="The national flag of ' + broadcast_nation_title + '" alt="' + broadcast_nation_title + '" >';
			tmp_locale_array['thumb_width'] = $('#bassdrive_broadcast_nation_thumb_width').html();

		}else{

			tmp_locale_array['colors'] = '';
			tmp_locale_array['thumb_width'] = '';

		}

		//
		// IS THE CURRENT BROADCAST
		// PROGRAM LIVE?
		tmp_MONTH_cnt = bassdrive_month.length;
		tmp_DAY_cnt = bassdrive_day.length;

		tmp_isLIVE = true;
		tmp_isLIVE_str = 'TRUE';

		for(i = 0; i < tmp_MONTH_cnt; i++){

			for(ii = 0; ii < tmp_DAY_cnt; ii++){

				tmp_DAY_pattern = bassdrive_month[i] + ' ' + bassdrive_day[ii];
				str_match = broadcast_title.indexOf(tmp_DAY_pattern);

				if(str_match > 0){

					i = tmp_MONTH_cnt +	1;
					ii = tmp_DAY_cnt + 1;
					tmp_isLIVE = false;
					tmp_isLIVE_str = 'FALSE';

				}

			}

		}

		$('#broadcast_is_LIVE').html(tmp_isLIVE_str);
		$('#component_tech_integration_driver').html('XHR_REQUEST');

		if(tmp_isLIVE_str == 'FALSE'){

			scroller_copy_base = ':: BROADCASTED WORLDWIDE FROM ' + tmp_broadcast_locale + ' ';

		}else{

			scroller_copy_base = ':: BROADCASTING WORLDWIDE FROM ' + tmp_broadcast_locale + ' ';

		}

		$('#bassdrive_standard_for_measurement').html(scroller_copy_base + 'X');

		scroller_width = window.getComputedStyle(document.getElementById('bassdrive_standard_for_measurement')).getPropertyValue("width");

		scroller_width = scroller_width.replace('px', '');

		log_activity('Content width = ' + scroller_width + '[' + scroller_copy_base + ']');

		scroller_width = scroller_width * 23;

		log_activity('100% scroller content width = ' + scroller_width);

		// 23 :: https://www.youtube.com/watch?v=bbEoRnaOIbs
		tmp_scroll_copy_long = scroller_copy_base + scroller_copy_base + scroller_copy_base + scroller_copy_base + scroller_copy_base +
			scroller_copy_base + scroller_copy_base + scroller_copy_base + scroller_copy_base + scroller_copy_base + scroller_copy_base +
			scroller_copy_base + scroller_copy_base + scroller_copy_base + scroller_copy_base + scroller_copy_base + scroller_copy_base +
			scroller_copy_base + scroller_copy_base + scroller_copy_base + scroller_copy_base + scroller_copy_base + scroller_copy_base;

		tmp_locale_array['copy'] = tmp_scroll_copy_long;
		tmp_locale_array['width'] = scroller_width;

	}

	return tmp_locale_array;

}

function fire_xhr_complete_status_indication(blink_cnt = 5, blink_color = '#4ab106'){

	ui_status_indicator_cnt = blink_cnt;

	$('#animation_00_delay').animate({
		top: 0
	}, {
		duration: 0,
		queue: false,
		specialEasing: {
			borderColor: "linear"
		},
		complete: function(){

			$('#animation_01_delay').animate({
				top: 0
			}, {
				duration: 250,
				queue: false,
				specialEasing: {
					borderColor: "linear"
				},
				complete: function(){

					$('#broadcast_nation_wrapper').css('borderColor', blink_color);

					$('#animation_00_delay').animate({
						top: 0
					}, {
						duration: 250,
						queue: false,
						specialEasing: {
							borderColor: "linear"
						},
						complete: function(){

							ui_status_indicator_cnt--;
							$('#broadcast_nation_wrapper').css('borderColor', '#FFFFFF');

							if(ui_status_indicator_cnt > 0){

								fire_xhr_complete_status_indication(ui_status_indicator_cnt, blink_color);

							}

						}

					});
				}

			});

		}

	});

}

function parseBassdriveColorsResponse(resp){

	if(delay_colors_refresh == 0){

		delay_colors_refresh = 1;

		if(resp != ""){

			if(current_locale_state !== 'TRANSITION'){

				if(current_locale_state === 'DOWN'){

					current_locale_state = 'TRANSITION';

					$('#broadcast_nation_wrapper').animate({
						borderColor: '#F90000'
					}, {
						duration: 2500,
						queue: false,
						specialEasing: {
							borderColor: "linear"
						},
						complete: function(){

							$('#animation_00_delay').animate({
								top: 0
							}, {
								duration: 1000,
								queue: false,
								specialEasing: {
									borderColor: "linear"
								},
								complete: function(){

									$('#broadcast_nation_wrapper').css('borderColor', '#F90000');

								}

							});

							$('#animation_01_delay').animate({
								top: 0
							}, {
								duration: 2000,
								queue: false,
								specialEasing: {
									borderColor: "linear"
								},
								complete: function(){

									$('#broadcast_nation').animate({
										top: -100
									}, {
										duration: 7500,
										queue: false,
										specialEasing: {
											top: "linear"
										},
										complete: function(){

											current_locale_state = 'UP';

											$('#broadcast_nation_wrapper').animate({
												borderColor: '#FFFFFF'
											}, {
												duration: 500,
												queue: false,
												specialEasing: {
													borderTopColor: "linear"
												},
												complete: function(){

													$('#broadcast_nation_wrapper').css('borderColor', '#FFFFFF');

													$('#broadcast_nation_wrapper').animate({
														borderColor: '#FFFFFF'
													}, {
														duration: 1500,
														queue: false,
														specialEasing: {
															borderTopColor: "linear"
														},
														complete: function(){

															toggle_bassdrive_stat('stream_info', transition_title, '04', 'blind');

															$("#broadcast_nation").html(resp);

															start_broadcast_scroll('xhr_driven');

														}

													});

												}

											});

										}

									});

								}

							});

						}

					});

				}

			}else{

				$("#broadcast_nation").html(resp);

				start_broadcast_scroll('xhr_driven');

			}

		}else{

			if(transition_title.length > 3){

				toggle_bassdrive_stat('stream_info', transition_title, '04', 'blind');

			}

			$("#broadcast_nation").html('');

		}

	}

}

function parseBassdriveSocialsResponse(resp){

	if(delay_social_refresh == 0){

		delay_social_refresh = 1;

		if(resp != ""){

			//
			// INSERT A SEQUENCE BUFFER
			$("#animation_00_delay").animate({
				opacity: 0
			}, {
				duration: 14500,
				queue: false,
				specialEasing: {
					opacity: "swing"
				},
				complete: function(){

					toggle_bassdrive_stat('stream_social', resp, '06', 'blind');

					$("#animation_00_delay").animate({
						opacity: 0
					}, {
						duration: 1500,
						queue: false,
						specialEasing: {
							opacity: "swing"
						},
						complete: function(){

							bassdrive_social_height = return_padding_to_honor_social_height();

							// $("#jony5_legal_social_wrapper").animate({
							// 	paddingTop: bassdrive_social_height
							// }, {
							// 	duration: 1500,
							// 	queue: false,
							// 	specialEasing: {
							// 		paddingTop: "swing"
							// 	},
							// 	complete: function(){
							//
							// 	}
							//
							// });

						}

					});

				}

			});

		}else{

			toggle_bassdrive_stat('stream_social', '', '06', 'blind');

			$("#animation_00_delay").animate({
				opacity: 0
			}, {
				duration: 8500,
				queue: false,
				specialEasing: {
					opacity: "swing"
				},
				complete: function(){

					bassdrive_social_height = return_padding_to_honor_social_height();

					// $("#jony5_legal_social_wrapper").animate({
					// 	paddingTop: bassdrive_social_height
					// }, {
					// 	duration: 1500,
					// 	queue: false,
					// 	specialEasing: {
					// 		paddingTop: "swing"
					// 	},
					// 	complete: function(){
					//
					// 	}
					//
					// });

				}

			});

		}

	}

}

function parseBassdriveResponse(oElemJSON){

	if(delay_main_refresh == 0){

		delay_main_refresh = 1;

		var tmp_bassdrive_curr_total_bandwidth = oElemJSON.stats[0].bandwidth;
		var tmp_bassdrive_curr_total_connections = oElemJSON.stats[0].connections;
		bassdrive_curr_total_name = oElemJSON.stats[0].name;
		var tmp_bassdrive_curr_total_capacity = oElemJSON.stats[0].capacity;
		var tmp_bassdrive_curr_total_bandwidthFormat = oElemJSON.stats[0].bandwidthFormat;

		var bassdrive_nowplaying_artist = oElemJSON.nowplaying[0].name;
		var bassdrive_nowplaying_title = oElemJSON.nowplaying[1].name;

		if(bassdrive_nowplaying_title.length < 5){

			bassdrive_nowplaying_title = oElemJSON.relays[0].title;

		}

		tmp_bassdrive_curr_total_bandwidthFormat = shortFormat(tmp_bassdrive_curr_total_bandwidthFormat);
		tmp_bassdrive_curr_total_capacity = prettyNumber(tmp_bassdrive_curr_total_capacity);
		tmp_bassdrive_curr_total_connections = prettyNumber(tmp_bassdrive_curr_total_connections);
		tmp_bassdrive_curr_total_bandwidth = prettyNumber(tmp_bassdrive_curr_total_bandwidth);

		log_activity("XHR :: Process Bassdrive JSON response object.");

		if(bassdrive_nowplaying_title.length > 5){

			var bassdrive_nowplaying_title_ARRAY = bassdrive_nowplaying_title.split(' - ');

			if(bassdrive_nowplaying_title_ARRAY.length < 2){

				var bassdrive_nowplaying_title_ARRAY = bassdrive_nowplaying_title.split('hosted');

				if(bassdrive_nowplaying_title_ARRAY < 2 || bassdrive_nowplaying_title_ARRAY[1] == undefined || bassdrive_nowplaying_title_ARRAY[1] == ''){

					var tmp_title = bassdrive_nowplaying_title_ARRAY[0];
					var tmp_host = '';

					tmp_title = tmp_title.trim();

				}else{

					var tmp_title = bassdrive_nowplaying_title_ARRAY[0];
					var tmp_host = 'hosted' + bassdrive_nowplaying_title_ARRAY[1];

					tmp_title = tmp_title.trim();
					tmp_host = tmp_host.trim();

				}

			}else{

				if(bassdrive_nowplaying_title_ARRAY.length>2){

					var tmp_title = bassdrive_nowplaying_title_ARRAY[0];
					tmp_title = tmp_title.trim();
					var tmp_title = tmp_title + ' ' + bassdrive_nowplaying_title_ARRAY[1];

					var tmp_host = bassdrive_nowplaying_title_ARRAY[2];

					if(bassdrive_nowplaying_title_ARRAY.length>3){
						tmp_host = tmp_host + ' ' + bassdrive_nowplaying_title_ARRAY[3];
					}

					if(bassdrive_nowplaying_title_ARRAY.length>4){
						tmp_host = tmp_host + ' ' + bassdrive_nowplaying_title_ARRAY[4];
					}

					tmp_title = tmp_title.trim();
					tmp_host = tmp_host.trim();

				}else{

					var tmp_title = bassdrive_nowplaying_title_ARRAY[0];
					var tmp_host = bassdrive_nowplaying_title_ARRAY[1];

					tmp_title = tmp_title.trim();
					tmp_host = tmp_host.trim();

				}

			}

			//
			// IS THE CURRENT PROGRAM LIVE?
			tmp_MONTH_cnt = bassdrive_month.length;
			tmp_DAY_cnt = bassdrive_day.length;
			tmp_sync_str = tmp_title + ' ' + tmp_host;

			tmp_isLIVE = true;
			tmp_isLIVE_str = 'TRUE';

			for(i = 0; i < tmp_MONTH_cnt; i++){

				for(ii = 0; ii < tmp_DAY_cnt; ii++){

					tmp_DAY_pattern = bassdrive_month[i] + ' ' + bassdrive_day[ii];
					str_match = tmp_sync_str.indexOf(tmp_DAY_pattern);

					if(str_match > 0){

						i = tmp_MONTH_cnt +	1;
						ii = tmp_DAY_cnt + 1;
						tmp_isLIVE = false;
						tmp_isLIVE_str = 'FALSE';

					}

				}

			}

			$('#broadcast_is_LIVE').html(tmp_isLIVE_str);
			$('#component_tech_integration_driver').html('XHR_REQUEST');

			if(tmp_host != ''){

				if(tmp_isLIVE_str == 'FALSE'){

					tmp_title = tmp_title + '<div class = "cb_2"></div><span class = "player-host">' + tmp_host + "</span>";

				}else{

					tmp_title = tmp_title + "<br><span class = \"player-host\">" + tmp_host + "</span>";

				}

			}

			$('#broadcast_show_original_title').html(tmp_title);

			tmp_curr_stream_info = $('#stream_info').html();

			tmp_title = applyProgramTitleFormatting(tmp_title);
			transition_title = tmp_title;

			if(tmp_curr_stream_info != tmp_title && (delay_refresh_from_sleep == 0 || delay_refresh_from_sleep == 3)){

				log_activity("Transition Bassdrive component to current stream info.");
				fire_xhr_complete_status_indication(5, '#F90000');

				//toggle_bassdrive_stat('stream_info', tmp_title, '04', 'blind');

				//
				// REFRESH NATIONAL COLORS.
				if($('#ajax_root').length){

					var HTTP_ROOT = $('#ajax_root').html();

				}else{

					var HTTP_ROOT = 'https://jony5.com/';

				}

				delay_colors_refresh = 0;
				var uri = HTTP_ROOT + '_proxy/bassdrive/';
				var params = '?action=colors_sync';
				uri = uri + params;

				$.ajax({
					type: "GET",
					url: uri,
					dataType: "html",
					success: parseBassdriveColorsResponse
				});

				delay_social_refresh = 0;
				var uri = HTTP_ROOT + '_proxy/bassdrive/';
				var params = '?action=social_sync';
				uri = uri + params;

				$.ajax({
					type: "GET",
					url: uri,
					dataType: "html",
					success: parseBassdriveSocialsResponse
				});

			}else{

				log_activity("Bassdrive component stream info matches current.");

				$('#stream_info').html(tmp_title);

				bassdrive_social_height = return_padding_to_honor_social_height();

				// $("#jony5_legal_social_wrapper").animate({
				// 	paddingTop: bassdrive_social_height
				// }, {
				// 	duration: 1500,
				// 	queue: false,
				// 	specialEasing: {
				// 		paddingTop: "swing"
				// 	},
				// 	complete: function(){
				//
				// 		fire_xhr_complete_status_indication(3);
				//
				// 	}
				//
				// });

			}

			bassdrive_active_sync_delay = 0;
			tmp_bass_situation = $('#the_bassdrive_situation').html();

			var tmp_bassdrive_stats_sync = '<div style="height:15px; overflow:hidden;"><div class="bassdrive_stats_copy_elem" style="padding-left: 0px;">*</div><div class="bassdrive_stats_copy_elem" id="curr_total_connections">' + tmp_bassdrive_curr_total_connections + '</div><div class="bassdrive_stats_copy_elem">connections (</div><div id="curr_total_capacity" class="bassdrive_stats_copy_elem" style="padding-left:0px;">' + tmp_bassdrive_curr_total_capacity + '</div><div id="curr_total_capacity" class="bassdrive_stats_copy_elem">max conn.) are</div></div><div style="height:15px; overflow:hidden; clear:both;"><div class="bassdrive_stats_copy_elem" style="padding-left: 7px;">pulling</div><div class="bassdrive_stats_copy_elem" id="curr_total_bandwidth">' + tmp_bassdrive_curr_total_bandwidth + '</div><div class="bassdrive_stats_copy_elem" id="curr_total_bandwidthFormat">' + tmp_bassdrive_curr_total_bandwidthFormat + '</div><div class="bassdrive_stats_copy_elem" style="padding-left:0px;">/s of </div><div id="bass_situation" class="bassdrive_stats_copy_elem">' + tmp_bass_situation + '</div> <div class="bassdrive_stats_copy_elem">from Bassdrive.</div></div>';

			stats_sync_content = encodeURIComponent(tmp_bassdrive_stats_sync);
			stream_info_sync_content = encodeURIComponent(tmp_title);

			if($('#bass_situation').length){

				bassdrive_curr_total_connections = $('#curr_total_connections').html();

				if(bassdrive_curr_total_connections != tmp_bassdrive_curr_total_connections){

					toggle_bassdrive_stat('curr_total_connections', tmp_bassdrive_curr_total_connections, '03', 'left');

					bassdrive_curr_total_connections = tmp_bassdrive_curr_total_connections;

				}

				bassdrive_curr_total_bandwidth = $('#curr_total_bandwidth').html();

				if(bassdrive_curr_total_bandwidth != tmp_bassdrive_curr_total_bandwidth){

					toggle_bassdrive_stat('curr_total_bandwidth', tmp_bassdrive_curr_total_bandwidth, '02', 'left');

					bassdrive_curr_total_bandwidth = tmp_bassdrive_curr_total_bandwidth;

				}

				bassdrive_curr_total_bandwidthFormat = $('#curr_total_bandwidthFormat').html();

				if(bassdrive_curr_total_bandwidthFormat != tmp_bassdrive_curr_total_bandwidthFormat){

					toggle_bassdrive_stat('curr_total_bandwidthFormat', tmp_bassdrive_curr_total_bandwidthFormat, '01', 'left');

					bassdrive_curr_total_bandwidthFormat = tmp_bassdrive_curr_total_connections;

				}

				bassdrive_curr_total_capacity = $('#curr_total_capacity').html();

				if(bassdrive_curr_total_capacity != tmp_bassdrive_curr_total_capacity){

					toggle_bassdrive_stat('curr_total_capacity', tmp_bassdrive_curr_total_capacity, '06', 'left');

					bassdrive_curr_total_capacity = tmp_bassdrive_curr_total_capacity;

				}

			}else{

				var tmp_stats = '<div style="height:15px; overflow:hidden;"><div class="bassdrive_stats_copy_elem" style="padding-left: 0px;">*</div><div class="bassdrive_stats_copy_elem" id="curr_total_connections">' + tmp_bassdrive_curr_total_connections + '</div><div class="bassdrive_stats_copy_elem">connections (</div><div id="curr_total_capacity" class="bassdrive_stats_copy_elem" style="padding-left:0px;">' + tmp_bassdrive_curr_total_capacity + '</div><div id="curr_total_capacity" class="bassdrive_stats_copy_elem">max conn.) are</div></div><div style="height:15px; overflow:hidden; clear:both;"><div class="bassdrive_stats_copy_elem" style="padding-left: 7px;">pulling</div><div class="bassdrive_stats_copy_elem" id="curr_total_bandwidth">' + tmp_bassdrive_curr_total_bandwidth + '</div><div class="bassdrive_stats_copy_elem" id="curr_total_bandwidthFormat">' + tmp_bassdrive_curr_total_bandwidthFormat + '</div><div class="bassdrive_stats_copy_elem" style="padding-left:0px;">/s of </div><div id="bass_situation" class="bassdrive_stats_copy_elem">' + tmp_bass_situation + '</div> <div class="bassdrive_stats_copy_elem">from Bassdrive.</div></div>';

				$('#bassdrive_stats').html(tmp_stats);
			}

			showBassdrive_component(1000);

		}

	}

}

function string_clean_css_px_int(css_pixel_int_string){

	var tmp_css_pixel_ARRAY = css_pixel_int_string.split('px');
	css_pixel = tmp_css_pixel_ARRAY[0];

	return css_pixel;

}

function return_padding_to_honor_social_height(){

	var delta_adjust = 12;

	bassdrive_social_height = string_clean_css_px_int(window.getComputedStyle(document.getElementById('stream_social')).getPropertyValue("height"));
	bassdrive_social_height = parseInt(bassdrive_social_height);

	//
	// SOCIAL WRAPS THREE LINES.
	if(bassdrive_social_height > 99){ // 103px

		//
		// DIALED THIS IN
		// TO 4px ON 1/16/2023 @ 1124 hrs.
		delta_adjust = 4;

	}

	//
	// SOCIAL WRAP TWO LINES.
	if(bassdrive_social_height <= 99){

		//
		// NOT DIALED IN.
		delta_adjust = 4;

	}

	//
	// SOCIAL WRAP ONE LINE.
	if(bassdrive_social_height <= 35){ // 34px

		//
		// NOT DIALED IN.
		delta_adjust = 31;

	}

	bassdrive_social_height = parseInt(bassdrive_social_height) + parseInt(delta_adjust);

	return bassdrive_social_height;

}

function applyProgramTitleFormatting(str){

	tmp_wrk_str = str;
	tmp_LIVE_cnt = bassdrive_for_BOLD_RED.length;
	tmp_HYPER_cnt = bassdrive_find_HYPER_LNK.length;
	tmp_MONTH_cnt = bassdrive_month.length;
	tmp_DAY_cnt = bassdrive_day.length;
	tmp_SPECIALTY_cnt = specialty.length;

	for(i = 0; i < tmp_LIVE_cnt; i++){

		tmp_LIVE_pattern = bassdrive_for_BOLD_RED[i];
		var str_match = tmp_wrk_str.indexOf(tmp_LIVE_pattern);

		if(str_match > -1){

			tmp_wrk_str = tmp_wrk_str.replace(tmp_LIVE_pattern, "<span style=\"color:#F00; font-weight: bold;\">" + tmp_LIVE_pattern + "</span>");

			i = tmp_LIVE_cnt + 1;

		}

	}

	//
	// Launch in Session LIVE from The Launch Pad with Dj Handy
	// LINE BREAK.
	var str_match = tmp_wrk_str.indexOf('Launch Pad with Dj Handy');

	if(str_match > 0){

		tmp_wrk_str = tmp_wrk_str.replace('Launch Pad with Dj Handy', 'Launch Pad<br>with Dj Handy');

	}

	//
	// The Onward Show LIVE from Shrewsbury UK with Jay Dubz
	// LINE BREAK.
	var str_match = tmp_wrk_str.indexOf('Shrewsbury UK with Jay Dubz');

	if(str_match > 0){

		tmp_wrk_str = tmp_wrk_str.replace('Shrewsbury UK with Jay Dubz', 'Shrewsbury UK<br>with Jay Dubz');

	}
	
	//
	// host INDENTATION
	var str_match = tmp_wrk_str.indexOf('host INDENTATION');

	if(str_match > 0){

		tmp_wrk_str = tmp_wrk_str.replace('host INDENTATION', 'host INDENTATION<br>');

	}

	//
	// [@bdxposure
	var str_match = tmp_wrk_str.indexOf('[@bdxposure');
	if(str_match > 0){

		tmp_wrk_str = tmp_wrk_str.replace('[@bdxposure', '<br>[@bdxposure');

	}

	for(i = 0; i < tmp_HYPER_cnt; i++){

		tmp_HYPER_pattern = bassdrive_find_HYPER_LNK[i];
		var str_match = tmp_wrk_str.indexOf(tmp_HYPER_pattern);

		if(str_match>0){

			tmp_lnk = bassdrive_replace_HYPER_LNK[i];
			tmp_wrk_str = tmp_wrk_str.replace(tmp_HYPER_pattern, "<a style=\"color:#0066CC; font-weight: normal;\" href=\"" + tmp_lnk + "\" target=\"_blank\">" + tmp_HYPER_pattern + "</a>");

			//i = tmp_HYPER_cnt + 1;

		}

	}

	tmp_isLIVE = true;

	for(i = 0; i < tmp_MONTH_cnt; i++){

		for(ii = 0; ii < tmp_DAY_cnt; ii++){

			tmp_DAY_pattern = bassdrive_month[i] + ' ' + bassdrive_day[ii];
			str_match = tmp_wrk_str.indexOf(tmp_DAY_pattern);

			if(str_match > 0){

				tmp_copy = '<span style="background-color: #CF0202; color:#FFF; font-size:11px; font-weight:normal; padding:1px 3px 1px 3px; border-radius: 15px;"><span style="color:#CF0202;">_</span> ' + tmp_DAY_pattern + ' :: REPLAY <span style="color:#CF0202;">_</span></span>';
				tmp_wrk_str = tmp_wrk_str.replace(tmp_DAY_pattern, tmp_copy);

				i = tmp_MONTH_cnt +	1;
				ii = tmp_DAY_cnt + 1;
				tmp_isLIVE = false;

			}

		}

	}

	for(i = 0; i < tmp_SPECIALTY_cnt; i++){

		tmp_SPECIALTY_pattern = specialty[i];
		str_match = tmp_wrk_str.indexOf(tmp_SPECIALTY_pattern);

		if(str_match > 0){

			tmp_wrk_str = tmp_wrk_str.replace(tmp_SPECIALTY_pattern, specialty_out[i]);

			i = tmp_SPECIALTY_cnt + 1;

		}

	}

	if(tmp_isLIVE == true){

		$('#broadcast_is_LIVE').html('TRUE');

	}else{

		$('#broadcast_is_LIVE').html('FALSE');

	}

	$('#component_tech_integration_driver').html('XHR_REQUEST');

	return tmp_wrk_str;

}

function toggle_bassdrive_stat(elem_id, val, delay_elem, toggle_type){

	$('#' + elem_id).toggle(toggle_type);

	$("#animation_" + delay_elem + "_delay").animate({
		left: "0px"
	}, {
		duration: 700,
		queue: false,
		step: function(now, fx){

		},
		complete: function(){

			$('#' + elem_id).html(val);

			$('#' + elem_id).toggle(toggle_type);

		}

	});

}

function shortFormat(data_format){

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

function prettyNumber(num){

	return numberWithCommas(num);

}

function showBassdrive_component(duration_ms){

	$("#bassdrive_nowplaying_wrapper").animate({
		opacity: 1
	}, {
		duration: duration_ms,
		queue: false,
		specialEasing: {
			opacity: "linear"
		}

	});

}

function hideBassdrive_component(duration_ms){

	$("#bassdrive_nowplaying_wrapper").animate({
		opacity: 0
	}, {
		duration: duration_ms,
		queue: false,
		specialEasing: {
			opacity: "linear"
		}

	});

}

function show_forward_button(duration_ms){

	forward_lck = false;
	$("#img_fwd_controller").css('cursor', 'pointer'); // cursor: default;

	$("#img_fwd_controller").animate({
		opacity: 1.0
	}, {
		duration: duration_ms,
		queue: false,
		specialEasing: {
			opacity: "swing"
		},
		step: function(now, fx){

		},
		complete: function(){

		}

	});

}

function hide_forward_button(duration_ms){

	forward_lck = true;
	$("#img_fwd_controller").css('cursor', 'default'); // cursor: default;

	$("#img_fwd_controller").animate({
		opacity: 0.0
	}, {
		duration: duration_ms,
		queue: false,
		specialEasing: {
			opacity: "swing"
		},
		step: function(now, fx){

		},
		complete: function(){

		}

	});

}

function show_back_button(duration_ms){

	back_lck = false;
	$("#img_back_controller").css('cursor', 'pointer'); // cursor: default;

	$("#img_back_controller").animate({
		opacity: 1.0
	}, {
		duration: duration_ms,
		queue: false,
		specialEasing: {
			opacity: "swing"
		},
		step: function(now, fx){

		},
		complete: function(){

		}

	});

}

function hide_back_button(duration_ms){

	back_lck = true;
	$("#img_back_controller").css('cursor', 'default');

	$("#img_back_controller").animate({
		opacity: 0.0
	}, {
		duration: duration_ms,
		queue: false,
		specialEasing: {
			opacity: "swing"
		},
		step: function(now, fx){

		},
		complete: function(){

		}

	});

}

function pushToControllerQueue(content){

	imageDisplayControllerQueue_ARRAY.push(content);

}

function sleepBanner(){

	if(img_rotation_sleep > 0){

		img_rotation_sleep--;

	}

	if(img_button_sleep > 0){

		img_button_sleep--;

	}

	bassdrive_active_sync_delay++;

	if(track_img_request_duration){

		img_request_duration_secs++;

	}

	if(bassdrive_active_sync_delay > 120){

		if(alert_events_flag_ARRAY['LONG_TERM_DELAY'] == undefined){

			alert_events_flag_ARRAY['LONG_TERM_DELAY'] = 0;
			fire_xhr_complete_status_indication(20, '#F90000');

			alert_events_flag_ARRAY['LONG_TERM_DELAY'] = bassdrive_active_sync_delay + (alert_events_flag_ARRAY['LONG_TERM_DELAY'] * 1);

		}

		bassdrive_active_sync_delay = 0;

		$("#animation_00_delay").animate({
			opacity: 0
		}, {
			duration: 13500,
			queue: false,
			specialEasing: {
				opacity: "swing"
			},
			complete: function(){

				$('#stream_info').html('');
				$('#bassdrive_stats').html('');
				$('#nation_colors_wrapper').html('');
				$('#bassdrive_broadcast_scroller_dyn_wrapper').html('');
				$('#stream_social').html('');

				bassdrive_social_height = return_padding_to_honor_social_height();

				$("#animation_00_delay").animate({
					opacity: 0
				}, {
					duration: 1500,
					queue: false,
					specialEasing: {
						paddingTop: "swing"
					},
					complete: function(){

						// $("#jony5_legal_social_wrapper").animate({
						// 	paddingTop: bassdrive_social_height
						// }, {
						// 	duration: 1500,
						// 	queue: false,
						// 	specialEasing: {
						// 		paddingTop: "swing"
						// 	},
						// 	complete: function(){
						//
						// 	}
						//
						// });

					}

				});

			}

		});

	}

	var tmp_mode = $("#banner_mode_track").html();

	if(tmp_mode == 'PLAY'){

		rotateBanner_delay++;

	}

	if(rotateBanner_delay > 30 && tmp_mode == 'PLAY'){

		log_activity("Fire helper banner rotation kick.");
		rotateBanner();
		clearInterval(bannerRotationTimer);
		bannerRotationTimer = setInterval("rotateBanner()", 15000);

	}

}

function bassdriveSync(){

	// https://jony5.com/_proxy/bassdrive/
	if(isPageHidden()){
		delay_refresh_from_sleep = 1;
		view_state_sleep_flag = 1;
		log_activity("Skipping Bassdrive Sync...");
		bassdrive_active_sync_delay = 0;

	}else{

		if((delay_refresh_from_sleep == 0) || (delay_refresh_from_sleep == 3)){

			delay_main_refresh = 0;

			if($('#ajax_root').length){

				var HTTP_ROOT = $('#ajax_root').html();

			}else{

				var HTTP_ROOT = 'https://jony5.com/';

			}

			var uri = HTTP_ROOT + '_proxy/bassdrive/';
			var params = '';

			log_activity("Fire Bassdrive Sync...");
			log_activity("Sending XHR request [_GET][" + uri + "].");

			$.ajax({
				type: "GET",
				url: uri,
				dataType: "json",
				success: parseBassdriveResponse
			});

		}

	}

}

function bassdrive_close_history(){

	$('#bassdrive_history_close_wrapper').animate({
		opacity: 0.0
	}, {
		duration: 500,
		queue: false,
		specialEasing: {
			opacity: "linear"
		},
		complete: function(){

			$('#bassdrive_history_close_wrapper').animate({
				left: -2000,
			}, {
				duration: 0,
				queue: false,
				specialEasing: {
					left: "swing"
				},
				complete: function(){

				}
			});

			$('#bassdrive_history_popup').animate({
				height: 0,
				opacity: 0.0
			}, {
				duration: 700,
				queue: false,
				specialEasing: {
					opacity: "swing"
				},
				complete: function(){

					$('#bassdrive_history_popup').animate({
						left: -2000,
						height: 55
					}, {
						duration: 0,
						queue: false,
						specialEasing: {
							left: "swing"
						},
						complete: function(){

						}

					});

				}

			});

		}

	});

}

function bassdrive_load_history(){

	$('#bassdrive_history_popup').animate({
		left: -2
	}, {
		duration: 0,
		queue: false,
		specialEasing: {
			left: "swing"
		},
		complete: function(){

			var HTTP_ROOT = $('#ajax_root').html();
			var tmp_loading_html = '<div class="cb"></div>' +
				'<div style="text-align: center; margin:0px auto;padding:20px 0 25px 0;"><img src="' + HTTP_ROOT + 'common/imgs/long_loader.gif" width="220" height="19" alt="CRNRSTN :: LOADING..." title="CRNRSTN :: LOADING..."></div>' +
				'<div class="cb"></div>';

			$("#bassdrive_history_popup").html(tmp_loading_html);

			$('#bassdrive_history_popup').animate({
				opacity: 1.0
			}, {
				duration: 1000,
				queue: false,
				specialEasing: {
					opacity: "swing"
				},
				complete: function(){

					var HTTP_ROOT = $('#ajax_root').html();

					var uri = HTTP_ROOT + '_proxy/bassdrive/?action=load_history';

					$.ajax({
						type: "POST",
						url: uri,
						dataType: "html",
						success: displayBassdriveStreamHistory
					});

					$('#bassdrive_history_close_wrapper').animate({
						left: 550
					}, {
						duration: 0,
						queue: false,
						specialEasing: {
							left: "linear"
						},
						complete: function(){

							$('#bassdrive_history_close_wrapper').animate({
								opacity: 1.0
							}, {
								duration: 500,
								queue: false,
								specialEasing: {
									opacity: "swing"
								},
								complete: function(){

								}

							});

						}

					});

				}

			});

		}

	});

}

function displayBassdriveStreamHistory(resp){

	$("#bassdrive_history_popup").html(resp);

	$('#bassdrive_history_popup').animate({
		height: 350
	}, {
		duration: 1000,
		queue: false,
		specialEasing: {
			height: "swing"
		},
		complete: function(){

		}

	});

}

function scripture_return(elem, mode = 'embedded', height= 800, width = 672){

	// https://jony5.com/scriptures/?vv=matt3_15&type=lp

	switch(mode){
		case 'popup':

			var HTTP_ROOT = $('#ajax_root').html();
			var uri = HTTP_ROOT + 'scriptures/';
			var params = '?vv=' + elem.getAttribute('vvid') + '&type=lp';

			uri = uri + params;
			var window_features = "left=100,top=100,width=" + width + ",height=" + height;
			var handle = window.open(uri, "jony5BlessingsInChrist", window_features);

			if(!handle){

				// The window wasn't allowed to open
				// This is likely caused by built-in popup blockers.

			}

		break;
		case 'nav_return':

			var HTTP_ROOT = $('#ajax_root').html();
			var uri = HTTP_ROOT + 'scriptures/';
			var params = '?vv=' + elem.getAttribute('vvid') + '&type=lp';

			var tmp_vv_html = '<div>' +
				'<div id="script_loading_book_icon"><img src="' + HTTP_ROOT + 'common/imgs/book_icon.jpg" width="600" height="200" alt="Holy Bible" title="Holy Bible"></div>' +
				'<div id="script_loading"><img src="' + HTTP_ROOT + 'common/imgs/long_loader.gif" width="220" height="19" alt="CRNRSTN :: LOADING..." title="CRNRSTN :: LOADING..."></div>' +
				'<div class="cb"></div></div>';

			//$("#script_popup").html(tmp_vv_html);

			$('#script_wrapper').html(tmp_vv_html);
			// $('#script_popup').css('top', top_px);
			//
			// log_activity("Sending XHR request [_GET][" + uri + "].");
			// $.ajax({
			// 	type: "POST",
			// 	url: uri,
			// 	dataType: "html",
			// 	success: displayScriptures
			// });

			uri = uri + params;
			window.open(uri, "_self");

		break;
		default:

			$('body').addClass('lb-disable-scrolling');
			show_scripture_overlay(elem);

		break;

	}

}

function show_scripture_overlay(elem){

	$('#scripture_lightbox_overlay').animate({
		height: $(document).height(),
		width: $(document).width()
	}, {
		duration: 0,
		queue: false,
		complete: function(){

			$('#scripture_lightbox_overlay').animate({
				opacity: 0.5
			}, {
				duration: 500,
				queue: false,
				specialEasing: {
					opacity: "swing"
				},
				complete: function(){

					var HTTP_ROOT = $('#ajax_root').html();

					var uri = HTTP_ROOT + 'scriptures/';
					var params = '?vv=' + elem.getAttribute('vvid');
					uri = uri + params;

					var arrayPageSize = getPageSize();

					// calculate top offset for the popup
					var arrayPageSize = getPageSize();
					var arrayPageScroll = getPageScroll();
					var scriptureTop = arrayPageScroll[1] + (arrayPageSize[3] / 15);
					var top_px = scriptureTop + 'px';

					$("#script_popup_lock").html("ON");

					if($("#script_popup").length){
						var tmp_vv_html = '<div id="script_wrapper">' +
							'<div id="script_loading_book_icon"><img src="' + HTTP_ROOT + 'common/imgs/book_icon.jpg" width="600" height="200" alt="Holy Bible" title="Holy Bible"></div>' +
							'<div id="script_loading"><img src="' + HTTP_ROOT + 'common/imgs/long_loader.gif" width="220" height="19" alt="CRNRSTN :: LOADING..." title="CRNRSTN :: LOADING..."></div>' +
							'<div class="cb"></div></div>';

						$("#script_popup").html(tmp_vv_html);

						$('#script_popup').css('top', top_px);

						log_activity("Sending XHR request [_GET][" + uri + "].");
						$.ajax({
							type: "POST",
							url: uri,
							dataType: "html",
							success: displayScriptures

						});

					}

				}

			});

			//
			// $('#crnrstn_interact_ui_full_lightbox').animate({
			// 		top: self.docs_page_css_top + 'px',
			// 		left: self.docs_page_css_left + 'px',
			// 		width: $(document).width(),
			// 		height: $(document).height()
			//
			// }, {
			// 	duration: 100,
			// 	queue: false,
			// 	complete: function(){
			//
			// 		if($('#crnrstn_interact_ui_full_lightbox').length){
			//
			// 		}
			//
			// 	}
			//
			// });

		}

	});

}

function displayScriptures(resp){

	if(resp != ""){

		var arrayPageSize = getPageSize();

		// calculate top offset for the popup
		var arrayPageSize = getPageSize();
		var arrayPageScroll = getPageScroll();
		var scriptureTop = arrayPageScroll[1] + (arrayPageSize[3] / 15);
		var top_px = scriptureTop + 'px';

		$("#script_popup_lock").html("OFF");
		$("#script_popup").html(resp);

		$('#script_popup').css('top', top_px);

		var el;
		var i = 0;
		var fragment = document.createDocumentFragment();

		el = document.createElement('div');
		el.innerHTML = resp;
		fragment.appendChild(el);
		$("#script_popup").html('');
		$("#script_popup").append(fragment);

		//
		// THIS MAY AFFECT THE LIFESTYLE BANNER
		// IMAGE ROTATION MODE.
		jony5_scroll_to('display_scriptures_xhr');

	}

}

function lockPopup(curr_action='silent'){

	$("#script_popup_lock").html("ON");

	switch(curr_action){
		case 'silent_the_ide':
		case 'silent':
			// ...IS GOLDEN.
		break;
		default:

			launch_newwindow(curr_action);

		break;

	}

}

function clearScriptures(){

	if($("#script_popup").length){
		
		$("#script_popup_lock").html("OFF");

		if($("#script_popup_lock").html() == 'OFF'){

			$("#script_popup").html('');

		}

	}

	if($("#bassdrive_history_popup").length){

		$("#bassdrive_history_popup").html('');

	}

}

function jony5_vv_scroll_to(elem_id){

	if(elem_id == 'ftnt_1'){

		var buffer = 25;

	}else{

		var buffer = 5;

	}

	if(elem_id == 'top'){

		var tmp_top = 0 + buffer;

		document.getElementById('script_scroll').scrollTop = tmp_top;

	}else{

		//
		// SOURCE :: https://stackoverflow.com/questions/635706/how-to-scroll-to-an-element-inside-a-div
		// AUTHOR :: Brian Barrett :: https://stackoverflow.com/users/192848/brian-barrett
		var note_elem = document.getElementById(elem_id);
		var note_elem_topPos = note_elem.offsetTop;

		var scroll_elem = document.getElementById('script_scroll');
		var scroll_elem_topPos = scroll_elem.offsetTop;

		var tmp_top = note_elem_topPos - scroll_elem_topPos - buffer;

		document.getElementById('script_scroll').scrollTop = tmp_top;

	}

}

function closePolarBearOverlay(){

	//new Effect.Appear('lightbox', { duration: 0.0, from: 0.0, to: 0.0, afterFinish: function(){
	//$('lightbox').style.display='none;';

	//} });

	//new Effect.Appear('overlay', { duration: 0.0, from: 0.0, to: 0.0, afterFinish: function(){
	//$('overlay').style.display='none;';

	//} });

	$('lightbox').hide();
	new Effect.Fade(('overlay'), { duration:1 });

}

//
// getPageScroll()
// Returns array with x,y page scroll values.
// Core code from - quirksmode.org
function getPageScroll(){

	var yScroll;

	if(self.pageYOffset){

		yScroll = self.pageYOffset;

	}else if(document.documentElement && document.documentElement.scrollTop){	 	// Explorer 6 Strict

		yScroll = document.documentElement.scrollTop;

	}else if(document.body){														// all other Explorers

		yScroll = document.body.scrollTop;

	}

	arrayPageScroll = new Array('', yScroll);

	return arrayPageScroll;

}

//
// getPageSize()
// Returns array with page width, height and window width, height
// Core code from - quirksmode.org
// Edit for Firefox by pHaez
function getPageSize(){

	var xScroll, yScroll;

	if(window.innerHeight && window.scrollMaxY){

		xScroll = document.body.scrollWidth;
		yScroll = window.innerHeight + window.scrollMaxY;

	}else if(document.body.scrollHeight > document.body.offsetHeight){ 			// all but Explorer Mac

		xScroll = document.body.scrollWidth;
		yScroll = document.body.scrollHeight;

	}else{ 																		// Explorer Mac...would also work in Explorer 6 Strict, Mozilla and Safari

		xScroll = document.body.offsetWidth;
		yScroll = document.body.offsetHeight;

	}

	var windowWidth, windowHeight;
	if(self.innerHeight){														// all except Explorer

		windowWidth = self.innerWidth;
		windowHeight = self.innerHeight;

	}else if(document.documentElement && document.documentElement.clientHeight){ // Explorer 6 Strict Mode

		windowWidth = document.documentElement.clientWidth;
		windowHeight = document.documentElement.clientHeight;

	}else if(document.body){ 													// other Explorers

		windowWidth = document.body.clientWidth;
		windowHeight = document.body.clientHeight;

	}

	// for small pages with total height less then height of the viewport
	if(yScroll < windowHeight){

		pageHeight = windowHeight;

	}else{

		pageHeight = yScroll;

	}

	// for small pages with total width less then width of the viewport
	if(xScroll < windowWidth){

		pageWidth = windowWidth;

	}else{

		pageWidth = xScroll;

	}

	arrayPageSize = new Array(pageWidth,pageHeight,windowWidth,windowHeight);

	return arrayPageSize;

}

function rotateBanner(mode='auto_advance'){

	rotateBanner_delay = 0;

	var tmp_mode = $("#banner_mode_track").html();

	if((img_rotation_sleep < 1 || mode == 'fwd') && !img_rotation_locked && !isPageHidden()){

		if((tmp_mode == 'PLAY') || (mode == 'fwd')){

			if(bannerImageIndexARRAY.length < 5){

				log_activity("Fire Banner XML XHR Request.");

				generate_cachebust();

				if($('#ajax_root').length){

					var HTTP_ROOT = $('#ajax_root').html();

				}else{

					var HTTP_ROOT = 'https://jony5.com/';

				}

				//var HTTP_ROOT = $('#ajax_root').html();
				var datafile = HTTP_ROOT + '_proxy/banner_xml/';
				var pars = "cache_b=" + $('#cache_bust').html();
				var uri = datafile + '?' + pars;

				log_activity("Sending XHR request [_GET][" + uri + "].");
				$.ajax({
					type: "GET",
					url: uri,
					dataType: "xml",
					success: parseBannerImageXML
				});

			}else{

				//
				// CLEAR INTERVAL.
				clearInterval(bannerRotationTimer);

				var tmp_img_queue = imageDisplayControllerQueue_ARRAY.length;
				var queue_location = tmp_img_queue - currentBackControlIndex;
				var tmp_nxt = currentBackControlIndex + 1;

				if((currentBackControlIndex < (tmp_img_queue - 1) && (imageDisplayControllerQueue_ARRAY[tmp_nxt] != undefined))){

					log_activity("Rotate [FORWARD CACHE] lifestyle banner image.");

					usermod_transitionBanner();

					if(queue_location <= 2){

						//
						// HIDE FORWARD BUTTON.
						hide_forward_button(1500);

					}

					//
					// SET INTERVAL.
					//bannerRotationTimer = setInterval("rotateBanner()", 10000);

				}else{

					log_activity("Rotate [REQUEST NEW] lifestyle banner image.");

					//
					// HIDE FORWARD BUTTON.
					hide_forward_button(1500);

					//
					// ROTATE THE BANNER COMPONENT
					// ACCORDING TO THE CONTENTS
					// OF THE XHR (XML) DOCUMENT RETURN.
					// bannerImageIndexARRAY[ss].uri
					tmp_image_count = bannerImageIndexARRAY.length;

					//
					// SOURCE :: https://stackoverflow.com/questions/2450954/how-to-randomize-shuffle-a-javascript-array
					// AUTHOR :: https://stackoverflow.com/users/151312/coolaj86
					bannerImageIndexARRAY = shuffle(bannerImageIndexARRAY);

					var tmp_image_found = false;
					var tmp_skipped_pos = '';

					for(var iii = 0; iii < tmp_image_count; iii++){

						//
						// IF WE HAVE NOT SHOWN THIS IMAGE...THEN LOAD...AND DONE.
						if((shownImage_ARRAY[bannerImageIndexARRAY[iii].uri] == undefined) && (tmp_image_found == false)){

							//
							// LOCK BANNER ROTATION.
							img_rotation_locked = true;

							img_request_duration_secs = 0;
							track_img_request_duration = true;
							last_img_index = iii;

							$("<img/>")
								.on('load', function(){

									//
									// CHECK TO SEE IF PAUSED AFTER IMAGE REQUEST SENT.
									tmp_mode = $("#banner_mode_track").html();

									if(tmp_mode == 'PLAY'){

										//img_rotation_locked = false;
										track_img_request_duration = false;
										banner_display_cnt++;

										log_activity("DOM Image loaded...[" + this.src + "].");

										auto_transitionBanner(this);
										show_back_button(1500);

									}else{

										clearInterval(bannerRotationTimer);
										bannerRotationTimer = setInterval("rotateBanner()", 15000);

									}

								})
								.on('error', function(){

									log_activity("!!!Failed to load image...[" + this.src + "].");
									img_rotation_locked = false;
									image_err_load_cnt++;

								})
								.attr("src", bannerImageIndexARRAY[iii].uri);

							$('#curr_banner_img_array_index').html(iii);
							shownImage_ARRAY[bannerImageIndexARRAY[iii].uri] = 1;
							iii = tmp_image_count + 1;
							tmp_image_found = true;

						}

					}

					if(!tmp_image_found){

						bannerImageIndexARRAY = [];
						shownImage_ARRAY = [];
						imageDisplayControllerQueue_ARRAY = [];

						currentBackControlIndex = 0;
						objectArrayBannerImageIndex = 0;

						pushToControllerQueue($("#banner_lifestyle").html());

						//
						// RECURSIVE CALL...ONCE END OF FRESH
						// AVAILABLE IMAGES HAS BEEN REACHED.
						rotateBanner();
						clearInterval(bannerRotationTimer);
						bannerRotationTimer = setInterval("rotateBanner()", 15000);

						hide_back_button(1500);
						hide_forward_button(1500);

					}

				}

			}

		}

	}

}

function usermod_transitionBanner(mode= 'auto'){

	switch(mode){
		case 'back':

			log_activity("User Initiated Banner Transition [BACK] :: INDEX[" + currentBackControlIndex + "].");

			switch(curr_lifestyle_container_top){
				case 'banner_lifestyle_alpha':

					//
					// LOAD banner_cache INTO :: BETA.
					var tmp = injectIntoElement(imageDisplayControllerQueue_ARRAY[currentBackControlIndex], 'banner_lifestyle_beta');

				break;
				default:
					// banner_lifestyle_beta

					//
					// LOAD banner_cache INTO ALPHA.
					var tmp = injectIntoElement(imageDisplayControllerQueue_ARRAY[currentBackControlIndex], 'banner_lifestyle_alpha');

				break;

			}

			//
			// THROW THE TRANSITION.
			bannerTransition_modrun(curr_lifestyle_container_top);

		break;
		case 'forward':

			mode = 'user-forward';

		default:

			currentBackControlIndex++;

			log_activity("Initiated [" + mode + "] Banner Transition [FORWARD] :: INDEX[" + currentBackControlIndex + "].");

			switch(curr_lifestyle_container_top){
				case 'banner_lifestyle_alpha':

					//
					// LOAD banner_cache INTO :: BETA.
					var tmp = injectIntoElement(imageDisplayControllerQueue_ARRAY[currentBackControlIndex], 'banner_lifestyle_beta');

				break;
				default:
					// banner_lifestyle_beta

					//
					// LOAD banner_cache INTO ALPHA.
					var tmp = injectIntoElement(imageDisplayControllerQueue_ARRAY[currentBackControlIndex], 'banner_lifestyle_alpha');

				break;

			}

			//
			// THROW THE TRANSITION.
			bannerTransition_modrun(curr_lifestyle_container_top);

			show_back_button(1500);

		break;

	}

}

function toggle_banner_mode(mode= 'play_pause'){

	switch(mode){
		case 'forward':
			if((img_button_sleep == 0) && (forward_lck == false)){

				log_activity("User toggled :: " + mode);

				img_rotation_sleep = 3;
				img_button_sleep = 1;
				rotateBanner_delay = 0;

				usermod_transitionBanner(mode);

				var tmp_img_queue = imageDisplayControllerQueue_ARRAY.length;
				var queue_location = tmp_img_queue - currentBackControlIndex;

				log_activity("BUTTON FORWARD :: QUEUE LOCATION :: " + queue_location);

				if(currentBackControlIndex > 0){

					show_back_button(1500);

				}

				if(queue_location < 2){

					hide_forward_button(1500);

				}

			}else{

				log_activity("User toggle :: " + mode + " MUTED.");

			}

		break;
		case 'back':

			if((img_button_sleep == 0) && (back_lck == false)){

				log_activity("User toggled :: " + mode);

				img_rotation_sleep = 3;
				img_button_sleep = 1;
				rotateBanner_delay = 0;

				if(currentBackControlIndex == 0){

					currentBackControlIndex = imageDisplayControllerQueue_ARRAY.length - 1;

				}

				currentBackControlIndex--;
				usermod_transitionBanner(mode);

				var tmp_img_queue = imageDisplayControllerQueue_ARRAY.length;
				var queue_location = tmp_img_queue - currentBackControlIndex;

				log_activity("BUTTON BACK :: QUEUE LOCATION :: " + queue_location);

				//
				// SHOW FORWARD BUTTON.
				show_forward_button(1500);

				if(queue_location > tmp_img_queue - 1){

					hide_back_button(1500);

				}

			}else{

				log_activity("User toggle :: " + mode + " MUTED.");

			}

		break;
		default:

			tmp_mode = $("#banner_mode_track").html();

			if(tmp_mode == 'PAUSE'){

				//
				// PLAY BUTTON CLICKED.
				$("#banner_control_play_wrapper").animate({
					opacity: 0.0
				}, {
					duration: 0,
					queue: false,
					specialEasing: {
						opacity: "swing"
					},
					step: function(now, fx){

					},
					complete: function(){

					}

				});

				$("#banner_control_pause_wrapper").animate({
					opacity: 1.0
				}, {
					duration: 0,
					queue: false,
					specialEasing: {
						opacity: "swing"
					},
					step: function(now, fx){

					},
					complete: function(){

					}

				});

				$("#banner_mode_track").html('PLAY');

			}else{

				$("#banner_control_pause_wrapper").animate({
					opacity: 0.0
				}, {
					duration: 0,
					queue: false,
					specialEasing: {
						opacity: "swing"
					},
					step: function(now, fx){

					},
					complete: function(){

					}

				});

				$("#banner_control_play_wrapper").animate({
					opacity: 1.0
				}, {
					duration: 0,
					queue: false,
					specialEasing: {
						opacity: "swing"
					},
					step: function(now, fx){

					},
					complete: function(){

					}

				});

				$("#banner_mode_track").html('PAUSE');

			}

		break;

	}

}

function auto_transitionBanner(oImg){

	/*
	if(injectIntoElement($("#banner_cache").html(), 'banner_lifestyle')){

		currentBackControlIndex++;
		pushToControllerQueue($("#banner_cache").html());

		var tmp_img_html = '<img src="' + this.src + '" width="1180" height="250" alt="Jonathan \'5\' Harris">';

		var tmp = injectIntoElement($("#banner_cache_slower_conn").html(), 'banner_cache');
		var tmp = injectIntoElement(tmp_img_html, 'banner_cache_slower_conn');

		show_back_button(1500);

	}

	*/

	switch(curr_lifestyle_container_top){
		case 'banner_lifestyle_alpha':

			//
			// LOAD banner_cache INTO :: BETA.
			var tmp = injectIntoElement($("#banner_cache").html(), 'banner_lifestyle_beta');

		break;
		default:
			// banner_lifestyle_beta

			//
			// LOAD banner_cache INTO ALPHA.
			var tmp = injectIntoElement($("#banner_cache").html(), 'banner_lifestyle_alpha');

		break;

	}

	currentBackControlIndex++;
	pushToControllerQueue($("#banner_cache").html());

	//
	// PUSH NEXT IMAGE TO banner_cache AND
	// INJECT NEW oImg INTO THE SITUATION.
	var tmp = injectIntoElement($("#banner_cache_slower_conn").html(), 'banner_cache');

	//
	// THROW THE TRANSITION.
	bannerTransition_run(curr_lifestyle_container_top, oImg);

}

function bannerTransition_modrun(top_container){

	switch(top_container){
		case 'banner_lifestyle_alpha':

			//
			// TRANSITION OUT :: ALPHA.
			$("#"+top_container).animate({
				opacity: 0
			}, {
				duration: 700,
				queue: false,
				step: function(now, fx){

				},
				complete: function(){

					img_rotation_locked = false;

					//
					// SHIFT TO PRIMARY Z :: BETA.
					$('#banner_lifestyle_beta').css('z-index', '12');
					curr_lifestyle_container_top = 'banner_lifestyle_beta';

					//
					// SHIFT TO SECONDARY Z :: ALPHA.
					$("#"+top_container).css('z-index', '11');

					//
					// TRANSITION IN :: ALPHA.
					$("#"+top_container).animate({
						opacity: 1.0
					}, {
						duration: 0,
						queue: false,
						step: function(now, fx){

						},
						complete: function(){

						}

					});

					clearInterval(bannerRotationTimer);
					bannerRotationTimer = setInterval("rotateBanner()", 15000);

				}

			});

		break;
		default:
			// banner_lifestyle_beta

			//
			// TRANSITION OUT :: BETA.
			$("#"+top_container).animate({
				opacity: 0
			}, {
				duration: 700,
				queue: false,
				step: function(now, fx){

				},
				complete: function(){

					img_rotation_locked = false;

					//
					// SHIFT TO PRIMARY Z :: ALPHA.
					$("#banner_lifestyle_alpha").css('z-index', '12');
					curr_lifestyle_container_top = 'banner_lifestyle_alpha';

					//
					// SHIFT TO SECONDARY Z :: BETA.
					$("#"+top_container).css('z-index', '11');

					//
					// TRANSITION IN :: BETA.
					$("#"+top_container).animate({
						opacity: 1.0
					}, {
						duration: 0,
						queue: false,
						step: function(now, fx){

						},
						complete: function(){

						}
					});

					clearInterval(bannerRotationTimer);
					bannerRotationTimer = setInterval("rotateBanner()", 15000);

				}

			});

		break;

	}

}

function bannerTransition_run(top_container, oImg){

	switch(top_container){
		case 'banner_lifestyle_alpha':

			//
			// TRANSITION OUT :: ALPHA.
			$("#"+top_container).animate({
				opacity: 0
			}, {
				duration: 700,
				queue: false,
				step: function(now, fx){

				},
				complete: function(){

					img_rotation_locked = false;

					//
					// SHIFT TO PRIMARY Z :: BETA.
					$('#banner_lifestyle_beta').css('z-index', '12');
					curr_lifestyle_container_top = 'banner_lifestyle_beta';

					//
					// SHIFT TO SECONDARY Z :: ALPHA.
					$("#"+top_container).css('z-index', '11');

					//
					// TRANSITION IN :: ALPHA.
					$("#"+top_container).animate({
						opacity: 1.0
					}, {
						duration: 0,
						queue: false,
						step: function(now, fx){

						},
						complete: function(){

						}

					});

					tmp_msec_duration = img_request_duration_secs * 1000;

					if(tmp_msec_duration > 15000){

						//
						// FIRE IMMEDIATELY. ROTATION TARGET IS
						// 10 SECS...BANDWIDTH IS TOO SLOW FOR THIS?
						rotateBanner();

						//
						// COULD THIS RESULT IN OVERLOAD? COULD
						// DIAL-UP CONNECTION PRODUCE .5 SEC
						// INTERVAL IMG REQUESTS?
						//tmp_interval = tmp_msec_duration - 10000;
						//bannerRotationTimer = setInterval("rotateBanner()", tmp_interval);
						clearInterval(bannerRotationTimer);
						bannerRotationTimer = setInterval("rotateBanner()", 15000);

					}else{

						tmp_interval = 15000 - tmp_msec_duration;

						//
						// 5 SEC INTERVAL MINIMUM.
						if(tmp_interval < 5000){

							tmp_interval = 15000;

						}

						clearInterval(bannerRotationTimer);
						bannerRotationTimer = setInterval("rotateBanner()", tmp_interval);

					}

				}

			});

		break;
		default:
			// banner_lifestyle_beta

			//
			// TRANSITION OUT :: BETA.
			$("#"+top_container).animate({
				opacity: "0"
			}, {
				duration: 700,
				queue: false,
				step: function(now, fx){

				},
				complete: function(){

					img_rotation_locked = false;

					//
					// SHIFT TO PRIMARY Z :: ALPHA.
					$("#banner_lifestyle_alpha").css('z-index', '12');
					curr_lifestyle_container_top = 'banner_lifestyle_alpha';

					//
					// SHIFT TO SECONDARY Z :: BETA.
					$("#"+top_container).css('z-index', '11');

					//
					// TRANSITION IN :: BETA.
					$("#"+top_container).animate({
						opacity: 1.0
					}, {
						duration: 0,
						queue: false,
						step: function(now, fx){

						},
						complete: function(){

						}

					});

					tmp_msec_duration = img_request_duration_secs * 1000;

					if(tmp_msec_duration > 15000){

						//
						// FIRE IMMEDIATELY. ROTATION TARGET IS
						// 10 SECS...BANDWIDTH IS TOO SLOW FOR THIS?
						rotateBanner();

						//
						// COULD THIS RESULT IN OVERLOAD? COULD
						// DIAL-UP CONNECTION PRODUCE .5 SEC
						// INTERVAL IMG REQUESTS?
						//tmp_interval = tmp_msec_duration - 10000;
						//bannerRotationTimer = setInterval("rotateBanner()", tmp_interval);
						clearInterval(bannerRotationTimer);
						bannerRotationTimer = setInterval("rotateBanner()", 15000);

					}else{

						tmp_interval = 15000 - tmp_msec_duration;

						//
						// 5 SEC INTERVAL MINIMUM.
						if(tmp_interval < 5000){

							tmp_interval = 15000;

						}

						clearInterval(bannerRotationTimer);
						bannerRotationTimer = setInterval("rotateBanner()", tmp_interval);

					}

				}
			});

		break;

	}

	var tmp_img_html = '<img src="' + oImg.src + '" width="1180" height="250" alt="Jonathan \'5\' Harris">';
	var tmp = injectIntoElement(tmp_img_html, 'banner_cache_slower_conn');

}

function stateOfSituationSync(){

	if(!isPageHidden()){

		if((delay_refresh_from_sleep == 0) || (delay_refresh_from_sleep == 3)){

			generate_cachebust();
			tmp_image_count = bannerImageIndexARRAY.length;

			if($('#ajax_root').length){

				var HTTP_ROOT = $('#ajax_root').html();

			}else{

				var HTTP_ROOT = 'https://jony5.com/';

			}

			delay_truth_refresh = 0;
			var pars = "doSayWhat=theTruthIfYouWouldPlz&iload_err_cnt=" + image_err_load_cnt + "&icnt=" + tmp_image_count + "&bpos=" + last_img_index + "&simg=" + banner_display_cnt + "&cache_b=" + $('#cache_bust').html();
			var uri = HTTP_ROOT + '_proxy/resource_access_ok/?' + pars;

			log_activity("Fire State of Situation Sync...");
			log_activity("Sending XHR request [_GET][" + uri + "]");
			$.ajax({
				type: "GET",
				url: uri,
				dataType: "xml",
				success: parseStateOfSituationResponse
			});

		}

	}else{

		delay_refresh_from_sleep = 1;
		view_state_sleep_flag = 1;

	}

}

function parseBannerImageAccessXML(originalAccessRequest){

	var oBannerImageAccessData = originalAccessRequest.responseXML.getElementsByTagName("jony5_dot_com_banner_image_access");

	//
	// CALL FOR XML FILE, AND THEN
	// SEND THE RESPONSE TO XML THE
	// LOAD CONTROLLER FOR PROFILE INDEXING.
	loadBannerImageAccessData(oBannerImageAccessData);

}

function parseBannerImageXML(xml){

	var cnt = 0;
	tmp_node = undefined;

	$(xml).find("banner_img").each(function(){

		if(cnt < 10){

			log_activity("Traversing returned banner xml node [uri=" + $(this).find("uri").text() + "]. loop cnt=[" + cnt + "].");

		}

		cnt++;

		//
		// SEND THE RESPONSE NODE TO THE XML LOAD
		// CONTROLLER FOR PROFILE INDEXING.
		loadBannerImageData(this);

		tmp_node = this;

	});

	log_activity('...');
	log_activity("Finished traversing returned banner xml node [uri=" + $(tmp_node).find("uri").text() + "]. loop cnt=[" + cnt + "].");

}

//
// PRIMARY XML LOAD CONTROLLER - RESOURCE
// ACCESS CONFIRMATION.
function parseStateOfSituationResponse(xml){

	/*
	<jony5_dot_com_banner_image_access>
		<jesus_christ_is_lord source="Philippians 2:9-11">TRUE</jesus_christ_is_lord>
		<satan_is_a_liar source="Genesis 3:4">TRUE</satan_is_a_liar>
		<total_img_cnt>'.$tmp_total_img_cnt.'</total_img_cnt>
		<curr_browser_arrayshuffle_pos>'.$tmp_curr_browser_array_pos.'</curr_browser_arrayshuffle_pos>
		<the_situation_with_bassdrive></the_situation_with_bassdrive>
	</jony5_dot_com_banner_image_access>

	*/

	if(delay_truth_refresh == 0){

		delay_truth_refresh = 1;

		$(xml).find("jony5_dot_com_banner_image_access").each(function(){

			jesus_christ_is_lord = $(this).find("jesus_christ_is_lord").text();
			satan_is_a_liar = $(this).find("satan_is_a_liar").text();
			var total_img_cnt = $(this).find("total_img_cnt").text();
			var curr_browser_arrayshuffle_pos = $(this).find("curr_browser_arrayshuffle_pos").text();
			var the_situation_with_bassdrive = $(this).find("the_situation_with_bassdrive").text();

			//
			// APPLY THE TRUTH RETURNED.
			standOnThis(jesus_christ_is_lord,satan_is_a_liar,total_img_cnt,curr_browser_arrayshuffle_pos,the_situation_with_bassdrive);

		});

	}

}

//
// SOURCE OF SOURCE :: http://www.nczonline.net/blog/2011/08/09/introduction-to-the-page-visibility-api/
// SOURCE :: https://stackoverflow.com/questions/12536562/detect-whether-a-window-is-visible
// AUTHOR :: https://stackoverflow.com/users/284685/adam
function isPageHidden(){

	return document.hidden || document.msHidden || document.webkitHidden || document.mozHidden;

}

function standOnThis(jesus_christ_is_lord, satan_is_a_liar, total_img_cnt, curr_browser_arrayshuffle_pos, the_situation_with_bassdrive){

	if(jesus_christ_is_lord && satan_is_a_liar){

		if($('#bass_situation').length){

			//$('#bass_situation').html(the_situation_with_bassdrive);
			current_bass_situation = $('#bass_situation').html();

			if(current_bass_situation != the_situation_with_bassdrive){

				toggle_bassdrive_stat('bass_situation',the_situation_with_bassdrive, '00', 'left');

				current_bass_situation = the_situation_with_bassdrive;

			}

		}

	}

}

function injectIntoElement(content, tgt_elem_id){

	tgt_elem_id = '#' + tgt_elem_id;
	$(tgt_elem_id).html(content);

	return true;

}

//
// PRIMARY XML LOAD CONTROLLER - BANNER IMAGE.
function loadBannerImageData(oItemNode){

	/*
	<banner_img>
		<queue_position>3</queue_position>
		<content_type></content_type>
		<uri>http://172.16.225.128/jony5/common/imgs/banner_1180x250/banner_new_j5_18.jpg</uri>
		<title></title>
		<description></description>
		<date></date>
	</banner_img>

	*/

	var queue_position = $(oItemNode).find("queue_position").text();
	//var content_type = oContent_type[0];
	var uri = $(oItemNode).find("uri").text();
	var filesize = $(oItemNode).find("filesize").text();
	//var description = oDescription[0];
	//var date = oDate[0];
	var content_type = '';
	var title = '';
	var description = '';
	var date = '';

	//
	// STORE IN OBJECT.
	setBannerImageIndexObject(queue_position, content_type, uri, filesize, description, date);

}

function syncToBannerImageIndex(){

	var tmp_len = bannerImageIndexARRAY.length;

	for(var ss=0; ss<tmp_len; ss++){

		imageHTML_ARRAY[ss] = '<img src="' + bannerImageIndexARRAY[ss].uri + '" width="1180" height="250" alt="Jonathan \'5\' Harris">';

	}

}

function setBannerImageIndexObject(queue_position, content_type, uri, filesize, description, date){

	bannerImageIndexARRAY[objectArrayBannerImageIndex++] = new oBannerImageIndex(queue_position, content_type, uri, filesize, description, date);

}

function oBannerImageIndex(queue_position, content_type, uri, filesize, description, date){

	this.queue_position = queue_position;
	this.content_type = content_type;
	this.uri = uri;
	this.filesize = filesize;
	this.description = description;
	this.date = date;

}

function generate_cachebust(dom_elem= '#cache_bust'){

	//
	// SOURCE :: https://gist.github.com/6174/6062387
	// SOURCE :: http://stackoverflow.com/questions/105034/how-to-create-a-guid-uuid-in-javascript
	tmp_rando = Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2, 15);

	if($(dom_elem)){

		$(dom_elem).html(tmp_rando);

	}else{

		//
		// ERROR ACCESSING DOM ELEMENT TO
		// STORE FRESH CACHE BUST.
		var tmp = true;

	}

}

function toggleTransactionWrapperOpen(){

	if($('primary').length){

	}else{

		new Effect.Appear('user_transaction_wrapper', { duration: 0.1, from: 0.0, to: 1.0 });
		new Effect.toggle('user_transaction_wrapper', 'slide');
		usr_transTimer = setTimeout(toggleTransactionWrapperClose, 15000);

	}

}

function toggleTransactionWrapperClose(){

	new Effect.Appear('user_transaction_wrapper', { duration: 2.0, from: 1.0, to: 0.0, afterFinish: function(){
			new Effect.toggle('user_transaction_wrapper', 'blind');
		}  });

}

function toggleFeedbackForm(frmElem){

	tmp_val = $('#form_fb_shell').css('left');

	if(tmp_val == '-352px'){

		$("#form_fb_shell").animate({
			left: "0px"
		}, {
			duration: 1000,
			queue: false,
			step: function(now, fx){

			},
			complete: function(){

				$('#'+frmElem.id).html('&nbsp;&nbsp;X');

				$("#"+frmElem.id).animate({
					height: "25px",
					fontSize: "18px"
				}, {
					duration: 500,
					queue: false,
					step: function(now, fx){

					},
					complete: function(){

					}

				});

			}

		});

	}else{

		$("#form_fb_shell").animate({
			left: "-352px"
		}, {
			duration: 500,
			queue: false,
			step: function(now, fx){

			},
			complete: function(){

				$("#"+frmElem.id).animate({
					height: "120px",
					fontSize: "14px"
				}, {
					duration: 500,
					queue: false,
					step: function(now, fx){

					},
					complete: function(){

						tmp_button_html = '&nbsp;&nbsp;C<br>&nbsp;&nbsp;O<br>&nbsp;&nbsp;N<br>&nbsp;&nbsp;T<br>&nbsp;&nbsp;A<br>&nbsp;&nbsp;C<br>&nbsp;&nbsp;T';
						$('#' + frmElem.id).html(tmp_button_html);

					}

				});

			}

		});

	}

	return false;

}

function crnrstn_chkbxSel(elem, inputName){

	if($('#crnrstn_' + elem.id).hasClass("crnrstn_chkbx_on")){

		//
		// UNCHECK THIS CHECKBOX.
		$('#crnrstn_' + elem.id).removeClass('crnrstn_chkbx_on').addClass("crnrstn_chkbx");
		$('#' + inputName).val('0');

	}else{

		//
		// CHECK THIS CHECKBOX.
		$('#crnrstn_' + elem.id).removeClass('crnrstn_chkbx').addClass("crnrstn_chkbx_on");
		$('#' + inputName).val('1');

	}

}

function crnrstn_vv_chkbxSel(elem, inputName){

	if(document.getElementById('scriptures_group_by_chkbx').checked == true){

		//
		// UNCHECK THIS CHECKBOX.
		document.getElementById('scriptures_group_by_chkbx').checked = false;
		$('#' + inputName).val('0');

	}else{

		//
		// CHECK THIS CHECKBOX.
		document.getElementById('scriptures_group_by_chkbx').checked = true
		$('#' + inputName).val('1');

	}

	$('#post_scriptures_group_by').submit();

}

function crnrstn_radioSel(elem, elem_IDSeed, radio_qty, inputName, inputValue){

	for(var i = 0; i < (radio_qty * 1); i++){

		if(elem.id == 'crnrstn_' + elem_IDSeed + '_' + i){

			$('#' + elem_IDSeed + '_' + i).removeClass('crnrstn_radio').addClass("crnrstn_radio_on");
			$('input#' + inputName).value = inputValue;

		}else{

			$('#'+elem_IDSeed + '_' + i).removeClass('crnrstn_radio_on').addClass("crnrstn_radio");

		}

	}

}

function loadPage(requestCaller, pageUri){

	var ns = '';
	var classes = $('ns_opt').innerHTML;

	//
	// REMAIN STILL WHILE
	// YOUR LIFE IS EXTRACTED.
	classes.split('|').each(
		function(navElemName){
			//
			// APPEND NAMES OF ANY
			// OPEN CLASS SUBNAVS.
			if($(navElemName + '_subnav')){

				if($(navElemName + '_subnav').visible()){

					ns = ns + navElemName + '|';

				}

			}

		});

	//
	// IF pageUri HAS ?, &ns. ELSE ?ns
	if(pageUri.split("?").length > 1){

		//
		// REQUEST NEW PAGE APPENDING TO
		// EXISTING GET PARAMS.
		if(ns.length > 0){

			ns = ns.replace(/^\||\|+$/g, '');			// TRIM LEADING AND TRAILING PIPE.
			window.location = pageUri + '&ns=' + ns;

		}else{

			window.location = pageUri;

		}

	}else{

		//
		// REQUEST NEW PAGE.
		// INITIALIZING GET PARAMS WITH A "?".
		if(ns.length > 0){

			ns = ns.replace(/^\||\|+$/g, '');			// TRIM LEADING AND TRAILING PIPE.
			window.location = pageUri + '?ns=' + ns;

		}else{

			window.location = pageUri;

		}

	}

}

function loadPageFromIndex(pageUri){

	window.location = pageUri;

}

function launch_popup(uri, popup_width, popup_height, popup_name = 'basic'){

	newwindow = window.open(uri, popup_name, 'height=' + popup_height + ',width=' + popup_width + '');

	if(window.focus){

		newwindow.focus();

	}

	return false;

}

function launch_newwindow(pageUri){

	window.open(pageUri);

}

function jony5_scroll_to(target){

	switch(target){
		case 'display_scriptures_xhr':

			//
			// CHECK ON THE LIFESTYLE BANNER IMAGE ROTATION MODE, AND
			// TURN OFF BANNER IMAGE ROTATION IF IT IS ON.
			// Saturday, April 20, 2024 @ 0149 hrs.
			tmp_mode = $("#banner_mode_track").html();

			if(tmp_mode != 'PAUSE'){

				//
				// APPLY A 2.5 SECOND TTL ON A PAUSE BUFFER, AND
				// TOGGLE THE LIFESTYLE BANNER IMAGE ROTATION MODE
				// WHEN THE TTL EXPIRES.
				$('#animation_05_delay').animate({
					opacity: 0
				}, {
					duration: banner_pause_buffer_ttl,
					queue: false,
					specialEasing: {
						left: "swing"
					},
					complete: function(){

						//
						// PAUSE LIFESTYLE BANNER ROTATION.
						toggle_banner_mode();

					}

				});

			}

		break;
		case  'top':

			$("html, body").animate({
				scrollTop: 0
			}, {
				duration: 300,
				queue: false,
				specialEasing: {
					scrollTop: "swing"
				}

			});

		break;
		default:

			//
			// SOURCE :: https://stackoverflow.com/questions/24665602/scrollintoview-scrolls-just-too-far
			// COMMENT :: https://stackoverflow.com/a/56391657
			// AUTHOR :: Arseniy-II :: https://stackoverflow.com/users/8163773/arseniy-ii
			// const id = target;
			const yOffset = -40;
			const element = document.getElementById(target);
			const y = element.getBoundingClientRect().top + window.pageYOffset + yOffset;

			window.scrollTo({top: y, behavior: 'smooth'});

			deep_link_content_highlight(target);

			//
			// CHECK ON THE LIFESTYLE BANNER IMAGE ROTATION MODE, AND
			// TURN OFF BANNER IMAGE ROTATION IF IT IS ON.
			// Saturday, April 20, 2024 @ 0149 hrs.
			tmp_mode = $("#banner_mode_track").html();

			if(tmp_mode != 'PAUSE'){

				//
				// APPLY A 2.5 SECOND TTL ON A PAUSE BUFFER, AND
				// TOGGLE THE LIFESTYLE BANNER IMAGE ROTATION MODE
				// WHEN THE TTL EXPIRES.
				$('#animation_05_delay').animate({
					opacity: 0
				}, {
					duration: banner_pause_buffer_ttl,
					queue: false,
					specialEasing: {
						left: "swing"
					},
					complete: function(){

						//
						// PAUSE LIFESTYLE BANNER ROTATION.
						toggle_banner_mode();

					}

				});

			}

		break;

	}

	return false;

}

function scrollTo_PageLoad(){

	if($("page_scrl").length == true){

		var brwsr_offset = 0;
		var scrlPos = $("page_scrl").innerHTML;
		var src_brwsr = $("brwsr").innerHTML;
		var tgt_brwsr = '';

		if(Prototype.Browser.WebKit){

			tgt_brwsr = 'webkit';

		}

		if(Prototype.Browser.IE){

			tgt_brwsr = 'ie';

		}

		if(Prototype.Browser.Opera){

			tgt_brwsr = 'opera';

		}

		if(Prototype.Browser.Gecko){

			tgt_brwsr = 'gecko';

		}

		if(Prototype.Browser.MobileSafari){

			tgt_brwsr = 'mobilesafari';

		}

		if(scrlPos != ''){

			if($('content_wrapper')){

				new Effect.ScrollTo("content_wrapper", {offset: (scrlPos * 1) + (brwsr_offset * 1)});

			}

		}

	}

}

function deep_link_content_highlight(target){

	var highlight_elem_id = target  + '_highlight_content';

	$("#" + highlight_elem_id).css('backgroundColor', '#FFF8CA');

	$("#" + highlight_elem_id).animate({
		backgroundColor: '#FFF8CA'
	}, {
		duration: 250,
		queue: false,
		specialEasing: {
			backgroundColor: "swing"
		},
		complete: function(){

			$("#" + highlight_elem_id).animate({
				backgroundColor: '#FFF8CA'
			}, {
				duration: 3000,
				queue: false,
				specialEasing: {
					backgroundColor: "swing"
				},
				complete: function(){

					$("#" + highlight_elem_id).animate({
						backgroundColor: 'transparent'
					}, {
						duration: 1000,
						queue: false,
						specialEasing: {
							backgroundColor: "swing"
						},
						complete: function(){

							$("#" + highlight_elem_id).css('backgroundColor', 'transparent');

						}

					});

				}

			});

		}

	});

}

function initScrollTo_lnk(elem, uri){

	var pos = elem.positionedOffset()[1];
	var brwsr = '';

	if(Prototype.Browser.WebKit){

		brwsr = 'webkit';

	}

	if(Prototype.Browser.IE){

		brwsr = 'ie';

	}

	if(Prototype.Browser.Opera){

		brwsr = 'opera';

	}

	if(Prototype.Browser.Gecko){

		brwsr = 'gecko';

	}

	if(Prototype.Browser.MobileSafari){

		brwsr = 'mobilesafari';

	}

	//alert('cumulativeOffset :: ' + elem.cumulativeOffset()[1]);
	//alert('positionedOffset :: ' + elem.positionedOffset()[1]);
	window.location = uri + '&scrl=' + pos + '&brwsr=' + brwsr;

}

function fullYear(theDate){

	x = theDate.getYear();
	var y = x % 100;
	y += (y < 38) ? 2000 : 1900;

	return y;

}


/* MISC FORM CONTROLS :: CHECKBOX BEHAVIOR */
function checkMe(elemID){

	if($(elemID).checked){

		$(elemID).checked = false;

	}else{

		$(elemID).checked = true;

	}

}

/* SEARCH CONTROLS */
function s_ovr(element){

	element.morph('background-color:#ff0000; color:#FFF;', {duration: 0.1});

}

function s_out(element){

	element.morph('background-color:#E1E2E5; color:#6F6F6F;', {duration: 0.3});

}

function searchBtnMouseOver(element){

}

function searchBtnMouseOut(element){

	element.morph('background-color:#FF0000; color:#E7E7E7;', {duration: 0.3});

}

function crnrstn_search_radioSel(elem, elem_IDSeed, radio_qty){
	for(var i = 0; i < (radio_qty * 1); i++){

		if(elem.id == elem_IDSeed + '_' + i){

			$('s_results_filter_radio_' + i).removeClassName('s_results_filter_radio');
			$('s_results_filter_radio_' + i).addClassName('s_results_filter_radio_on');

		}else{

			$('s_results_filter_radio_' + i).removeClassName('s_results_filter_radio_on');
			$('s_results_filter_radio_' + i).addClassName('s_results_filter_radio');

		}

	}

}

function initFilterRadio(){

	var tmp_pointer = '0';
	var query = window.location.href;
	var vars_Filter = query.split("&");

	for(var i = 0; i < vars_Filter.length; i++){

		switch(vars_Filter[i]){
			case 'filter=all':

				var tmp_pointer = '0';

			break;
			case 'filter=code':

				var tmp_pointer = '2';

			break;
			case 'filter=desc':

				var tmp_pointer = '3';

			break;
			case 'filter=ugc':

				var tmp_pointer = '1';

			break;

		}

	}

	for(var i = 0; i < 4; i++){

		if('s_results_filter_radio_' + tmp_pointer == 's_results_filter_radio_' + i){

			$('s_results_filter_radio_'+i).removeClassName('s_results_filter_radio');
			$('s_results_filter_radio_'+i).addClassName('s_results_filter_radio_on');

		}else{

			$('s_results_filter_radio_'+i).removeClassName('s_results_filter_radio_on');
			$('s_results_filter_radio_'+i).addClassName('s_results_filter_radio');

		}

	}

}

function crnrstn_search_filter(filterType){

	var query = window.location.href;
	var query_clean = query.split("#");
	var query_Filter = query_clean[0].split("&filter=");

	//alert(query_clean[0] + '&filter=' + filterType);

	window.location = query_Filter[0] + '&filter=' + filterType;

}

var hoverCount = 0;
var tt_timer;
var tt_locktimer;
var tt_currElemId = '';
var tt_lock = 0;

function ttMsOvr(element){

	tt_currElemId = element.id;
	tt_timer = setTimeout(loadToolTip, 500);

}

function clear_tt_lock(){

	tt_lock=0;
	clearInterval(tt_locktimer);
	tt_locktimer = null;

}

/* NAVIGATION CONTROLS :: MOUSEOVER OVERLAY */
var currOverlayLnkNm = "";

function lnkMouseOver(lnkName){

	if(lnkName != currOverlayLnkNm){

		new Effect.Appear(lnkName + '_lnk_activity_overlay', { duration: 0.2, from: 0.0, to: 0.4 });

	}

	currOverlayLnkNm = lnkName;

}

function lnkMouseOut(lnkName){

	if(lnkName == currOverlayLnkNm){

		new Effect.Appear(lnkName + '_lnk_activity_overlay', { duration: 0.2, from: 0.4, to: 0.0 });

		currOverlayLnkNm = "";

	}

}

function sublnkMouseOver(element){

	$(element.id).removeClassName('subnav_lnk_clear');
	$(element.id).removeClassName('subnav_lnk_highlighted');
	$(element.id).addClassName('subnav_lnk_highlighted');

}

function sublnkMouseOut(element){

	$(element.id).removeClassName('subnav_lnk_highlighted');
	$(element.id).addClassName('subnav_lnk_clear');

}

function submitBtnMouseOver(element, class_to_remove = 'submit_btn_clear', class_to_add = 'submit_btn_highlighted'){

	// $("p").removeClass("myClass noClass").addClass("yourClass");
	$('#' + element.id).removeClass(class_to_remove).addClass(class_to_add);
	//$('#' + element.id).removeClass('submit_btn_highlighted').addClass('submit_btn_highlighted');

	//element.addClassName('submit_btn_highlighted');

}

function submitBtnMouseOut(element, class_to_remove = 'submit_btn_highlighted', class_to_add = 'submit_btn_clear'){

	$('#' + element.id).removeClass(class_to_remove).addClass(class_to_add);
	//element.removeClassName('submit_btn_highlighted');
	//element.addClassName('submit_btn_clear');

}

//
// SOURCE :: https://stackoverflow.com/questions/2450954/how-to-randomize-shuffle-a-javascript-array
// AUTHOR :: https://stackoverflow.com/users/151312/coolaj86
function shuffle(array){

	var currentIndex = array.length, temporaryValue, randomIndex;

	// While there remain elements to shuffle...
	while (0 !== currentIndex){

		// Pick a remaining element...
		randomIndex = Math.floor(Math.random() * currentIndex);
		currentIndex -= 1;

		// And swap it with the current element.
		temporaryValue = array[currentIndex];
		array[currentIndex] = array[randomIndex];
		array[randomIndex] = temporaryValue;
	}

	return array;

}

//
// SOURCE :: https://stackoverflow.com/questions/14129953/how-to-encode-a-string-in-javascript-for-displaying-in-html
// AUTHOR :: https://stackoverflow.com/users/616443/j08691
function htmlEntities(str){

	return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');

}

//
// SOURCE :: https://stackoverflow.com/questions/19491336/get-url-parameter-jquery-or-how-to-get-query-string-values-in-js
// AUTHOR :: https://stackoverflow.com/users/1897010/sameer-kazi
// SOURCE [ORIGINAL] :: http://www.jquerybyexample.net/2012/06/get-url-parameters-using-jquery.html
function getUrlParameter(sParam_cust){

	var sPageURL_cust = window.location.search.substring(1),
		sURLVariables_cust = sPageURL_cust.split('&'),
		sParameterName_cust,
		aaa;

	for(aaa = 0; aaa < sURLVariables_cust.length; aaa++){

		sParameterName_cust = sURLVariables_cust[aaa].split('=');

		if(sParameterName_cust[0] === sParam_cust){

			return sParameterName_cust[1] === undefined ? true : decodeURIComponent(sParameterName_cust[1]);

		}

	}

}

//
// SOURCE :: https://stackoverflow.com/questions/2901102/how-to-print-a-number-with-commas-as-thousands-separators-in-javascript
// AUTHOR :: https://stackoverflow.com/users/28324/elias-zamaria
function numberWithCommas(x){

	var parts = x.toString().split(".");
	parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
	return parts.join(".");

}

function gup(name){

	name = name.replace(/[\[]/, "\\\[").replace(/[\]]/, "\\\]");

	var regexS = "[\\?&]" + name + "=([^&#]*)";
	var regex = new RegExp(regexS);
	var results = regex.exec(window.location.href);

	if(results == null){

		return "";

	}else{

		return results[1];

	}

}