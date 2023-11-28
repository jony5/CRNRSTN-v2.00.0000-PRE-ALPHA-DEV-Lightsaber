/* 
// J5
// Code is Poetry */

// OVERLAY CONTROLS
// lowly JavaScript Document

var ajax_root;
var requestedmodule = "";

//
// INIT TIMER AND STATE CONTROLLER
baseHeartBeat = setTimeout( "syncTimerState()", 1000 );
clearTimeout(baseHeartBeat);

//
// OBJECT CONTROLLER
var mini_vs = '';
var fullscrn_vs = '';
var log_controller = 1;   // [0=off|1=on]
var activity_log_FLAG;
var xygrid_geozip_uri = '';
var geozip_forecast_uri = '';
var geo_gridX;
var geo_gridY;
var forecast_day_HTML;
var forecast_night_HTML;
var forecast_item_cnt = 0;

var oWindage_words = {};
oWindage_words['N'] = 'Northernly';
oWindage_words['NE'] = 'North-Easternly';
oWindage_words['NW'] = 'North-Westernly';
oWindage_words['E'] = 'Easternly';
oWindage_words['S'] = 'Southernly';
oWindage_words['SE'] = 'South-Easternly';
oWindage_words['SW'] = 'South-Westernly';
oWindage_words['W'] = 'Westernly';

var oDate_month = {};
oDate_month['01'] = 'Jan.';
oDate_month['02'] = 'Feb.';
oDate_month['03'] = 'Mar.';
oDate_month['04'] = 'Apr.';
oDate_month['05'] = 'May';
oDate_month['06'] = 'June';
oDate_month['07'] = 'July';
oDate_month['08'] = 'Aug.';
oDate_month['09'] = 'Sept.';
oDate_month['10'] = 'Oct.';
oDate_month['11'] = 'Nov.';
oDate_month['12'] = 'Dec.';

var oDate_day_eng = {};
oDate_day_eng['01'] = '1st';
oDate_day_eng['02'] = '2nd';
oDate_day_eng['03'] = '3rd';
oDate_day_eng['04'] = '4th';
oDate_day_eng['05'] = '5th';
oDate_day_eng['06'] = '6th';
oDate_day_eng['07'] = '7th';
oDate_day_eng['08'] = '8th';
oDate_day_eng['09'] = '9th';
oDate_day_eng['10'] = '10th';
oDate_day_eng['11'] = '11th';
oDate_day_eng['12'] = '12th';
oDate_day_eng['13'] = '13th';
oDate_day_eng['14'] = '14th';
oDate_day_eng['15'] = '15th';
oDate_day_eng['16'] = '16th';
oDate_day_eng['17'] = '17th';
oDate_day_eng['18'] = '18th';
oDate_day_eng['19'] = '19th';
oDate_day_eng['20'] = '20th';
oDate_day_eng['21'] = '21st';
oDate_day_eng['22'] = '22nd';
oDate_day_eng['23'] = '23rd';
oDate_day_eng['24'] = '24th';
oDate_day_eng['25'] = '25th';
oDate_day_eng['26'] = '26th';
oDate_day_eng['27'] = '27th';
oDate_day_eng['28'] = '28th';
oDate_day_eng['29'] = '29th';
oDate_day_eng['30'] = '30th';
oDate_day_eng['31'] = '31st';

var oDayOfWeek = {};
oDayOfWeek['Sunday'] = 'The Lord\'s Day';
oDayOfWeek['Sunday Night'] = 'Evening of the Lord\'s Day';
oDayOfWeek['Monday'] = 'Case of the &quot;Mondays&quot;';
oDayOfWeek['Tuesday'] = 'Tuesday';
oDayOfWeek['Wednesday'] = 'Wednesday';
oDayOfWeek['Thursday'] = 'Thursday';
oDayOfWeek['Friday'] = 'Friday';
oDayOfWeek['Saturday'] = 'Saturday';

var oMouseState_hover = {};

//
// INITIALIZE
$.when(
	//$.getJSON( "ajax/test.json" ),
	$.ready
).done(function( ) {
	// Document is ready.
	// Value of test.json can be passed in as `data`.

	log_activity("DOM ready.");
	ajax_root = $('#ajax_root').html();

	startHeartbeats();

	if($('#cityState_star').length){

		$('#zipcode_star').hide();
		$('#cityState_star').hide();
	}

	if($('#xygrid_geozip_uri').length){

		xygrid_geozip_uri = $('#xygrid_geozip_uri').html();

		if(xygrid_geozip_uri=="" || xygrid_geozip_uri==undefined){

		}else{

			geozip_forecast_uri = request_geozip_forecast_uri();

		}

		//wethr_refresh_timer = setTimeout( "wethr_refresh()", 30000 );
		//clearTimeout(wethr_refresh_timer);

	}

});

function wethr_refresh(){

	if($('#xygrid_geozip_uri').length){

		xygrid_geozip_uri = $('#xygrid_geozip_uri').html();

		if(xygrid_geozip_uri == "" || xygrid_geozip_uri == undefined){

		}else{

			geozip_forecast_uri = request_geozip_forecast_uri();

		}

	}

}

function wthrbg_ugc_load(locale_name, locale_geoid, locale_geopoint, locale_city, locale_state, locale_zipcode, locale_wikipedia){

	$('input#autocomplete-input').val(locale_name);
	$('input#locale_geoid').val(locale_geoid);
	$('input#locale_geopoint').val(locale_geopoint);
	$('input#locale_city').val(locale_city);
	$('input#locale_state').val(locale_state);
	$('input#locale_zipcode').val(locale_zipcode);
	$('input#locale_wikipedia').val(locale_wikipedia);

	$('#autocomplete').html('');

	$("div.one_required_invalid").hide();

}

function request_geozip_forecast_uri(){

	var data = '';

	$.ajax({
		type: "GET",
		url: xygrid_geozip_uri,
		data: data,
		beforeSend: function(x) {
			if (x && x.overrideMimeType) {
				x.overrideMimeType("multipart/form-data;charset=UTF-8");
			}
		},
		success: parseXHRCP_JSON,
		error: parseXHRCP_JSON_error,
		dataType: "html"
	});

}

function apply_celsius_formatting(tmp_temperature_C){

	// tmp_temperature_C = temp + '';
	// tmp_temperature_C_str_ARRAY = tmp_temperature_C.split('.');
	//
	// if(tmp_temperature_C_str_ARRAY.length > 1){
	//
	// 	tmp_str2 = tmp_temperature_C_str_ARRAY[1];
	// 	tmp_temperature_C_str2_ARRAY = tmp_str2.split('');
	//
	// 	tmp_temperature_C = tmp_temperature_C_str_ARRAY[0] + '.' + tmp_temperature_C_str2_ARRAY[0];
	//
	// }else{
	//
	// 	tmp_temperature_C = tmp_temperature_C_str_ARRAY[0] + '.0';
	//
	// }

	return tmp_temperature_C.toPrecision(3);

}

function apply_tmp_detailedForecast_Formatting(str, unit){

	if(unit === 'F'){

		var wethrbug_find = ['1.','2.','3.','4.','5.','6.','7.','8.','9.','0.'];
		var wethrbug_replace = ['1&deg;' +  unit + '.','2&deg;' +  unit + '.','3&deg;' +  unit + '.','4&deg;' +  unit + '.','5&deg;' +  unit + '.','6&deg;' +  unit + '.','7&deg;' +  unit + '.','8&deg;' +  unit + '.','9&deg;' +  unit + '.','0&deg;' +  unit + '.'];

		tmp_wrk_str = str;
		tmp_find_cnt = wethrbug_find.length;

		for(i = 0; i < tmp_find_cnt; i++) {

			tmp_find_pattern = wethrbug_find[i];
			var str_match = tmp_wrk_str.indexOf(tmp_find_pattern);

			if (str_match > -1) {

				tmp_replace_pattern = wethrbug_replace[i];

				tmp_wrk_str = tmp_wrk_str.replace(tmp_find_pattern, tmp_replace_pattern);

				i = tmp_find_cnt + 1;

			}

		}

	}else{

		//Celcius
		tmp_wrk_str = str;
		tmp_celcius_str_ARRAY = tmp_wrk_str.split('.');

		for(i = 0; i < tmp_celcius_str_ARRAY.length; i++){

			tmp_celcius_str_A = tmp_celcius_str_ARRAY[i];
			tmp_celcius_str_A_word_ARRAY = tmp_celcius_str_A.split(' ');
			tmp_word_ARRAY_len = tmp_celcius_str_A_word_ARRAY.length;

			//(32°F − 32) × 5/9 = 0°C
			tmp_wrk_temperature_C = tmp_celcius_str_A_word_ARRAY[tmp_word_ARRAY_len - 1] * 1;

			if(Number.isInteger(tmp_wrk_temperature_C)){

				tmp_wrk_temperature_C = (tmp_wrk_temperature_C - 32)  * (5/9);
				tmp_wrk_temperature_C = apply_celsius_formatting(tmp_wrk_temperature_C);

				i = tmp_celcius_str_ARRAY.length + 1;

			}

		}

		var wethrbug_find = [tmp_celcius_str_A_word_ARRAY[tmp_word_ARRAY_len - 1]];
		var wethrbug_replace = [tmp_wrk_temperature_C + '&deg;' +  unit];

		tmp_find_cnt = wethrbug_find.length;

		for(i = 0; i < tmp_find_cnt; i++) {

			tmp_find_pattern = wethrbug_find[i];
			var str_match = tmp_wrk_str.indexOf(tmp_find_pattern);

			if (str_match > -1) {

				tmp_replace_pattern = wethrbug_replace[i];

				tmp_wrk_str = tmp_wrk_str.replace(tmp_find_pattern, tmp_replace_pattern);

				i = tmp_find_cnt + 1;

			}

		}

	}

	return tmp_wrk_str;

}

function parseXHRCP_JSON(oElemJSON){

	var data = '';
	forecast_day_HTML = '';
	forecast_night_HTML = '';
	forecast_day_celsius_HTML = '';
	forecast_night_celsius_HTML = '';
	tmp_daycnt = 5;
	tmp_nightcnt = 5;

	var oElemJSON = jQuery.parseJSON( oElemJSON );

	geo_forecast_resp_check = oElemJSON.properties.forecast;

	if(geo_forecast_resp_check != "" && geo_forecast_resp_check != undefined){

		mode = 'GRID_URI_RESP';

	}else{

		mode = 'FORECAST_URI_RESP';

	}

	switch(mode){
		case 'GRID_URI_RESP':

			geo_gridX = oElemJSON.properties.gridX;		// 31
			geo_gridY = oElemJSON.properties.gridY;		// 80

			// https://api.weather.gov/gridpoints/TOP/31,80/forecast
			//geozip_forecast_uri = $('#xygrid_forecast_uri').html();

			//geozip_forecast_uri = geozip_forecast_uri + geo_gridX + ',' + geo_gridY + '/forecast/';
			geozip_forecast_uri = geo_forecast_resp_check;

			$.ajax({
				type: "GET",
				url: geozip_forecast_uri,
				data: data,
				beforeSend: function(x) {
					if (x && x.overrideMimeType) {
						x.overrideMimeType("multipart/form-data;charset=UTF-8");
					}
				},
				success: parseXHRCP_JSON,
				error: parseXHRCP_JSON_error,
				dataType: "html"
			});

		break;
		case 'FORECAST_URI_RESP':

			$('#nws_json_raw').html('<p style="padding-top: 0; margin-top:0;">' + JSON.stringify(oElemJSON) + '</p>');
			var period_cnt = oElemJSON.properties.periods.length;

			var tmp_locale = $('#wethrbug_geozip_city').html()+', <a href="'+$('#wethrbug_geozip_wikipedia').html()+'" target="_blank" data-ajax="false" style="font-weight:normal; color:#0066CC;">' + $('#wethrbug_geozip_state').html()+ '</a> ' + $('#wethrbug_geozip_zipcode').html();
			var tmp_date_generated = $('#date_generated').html();
			$('#forecast_locale').html('<a href="https://www.weather.gov/" target="_blank" style="font-weight:normal; color:#0066CC;" data-ajax="false">National Weather Service</a> results (<a id="open-popupViewJSON" href="#" data-rel="popup" data-transition="pop" style="font-weight: normal; color:#0066CC;" title="View">view</a>) for ' + tmp_locale + ' requested on ' + tmp_date_generated +'.');
			$('#nws_jason_header').html('<a href="' + geozip_forecast_uri + '" target="_blank" style="font-weight:normal; color:#0066CC;" data-ajax="false">open in browser</a>');

			//
			// BUILD OUT HTML FORECAST
			// forecast_HTML
			for(var ii  = 0; ii < period_cnt; ii++){
				var tmp_number = oElemJSON.properties.periods[ii].number;
				var tmp_name = oElemJSON.properties.periods[ii].name;
				var tmp_startTime = oElemJSON.properties.periods[ii].startTime;
				var tmp_endTime = oElemJSON.properties.periods[ii].endTime;
				var tmp_isDaytime = oElemJSON.properties.periods[ii].isDaytime;

				var tmp_temperature = oElemJSON.properties.periods[ii].temperature;
				var tmp_temperatureUnit = oElemJSON.properties.periods[ii].temperatureUnit;

				if(tmp_temperatureUnit === 'F'){
					//(32°F − 32) × 5/9 = 0°C
					var tmp_temperature_C = tmp_temperature * 1;
					tmp_temperature_C = (tmp_temperature_C - 32)  * (5/9);

					tmp_temperature_C = apply_celsius_formatting(tmp_temperature_C);

					var tmp_temperatureUnit_C = 'C';

				}

				var tmp_temperatureTrend = oElemJSON.properties.periods[ii].temperatureTrend;
				var tmp_windSpeed = oElemJSON.properties.periods[ii].windSpeed;
				var tmp_windDirection = oElemJSON.properties.periods[ii].windDirection;
				var tmp_icon = oElemJSON.properties.periods[ii].icon;
				var tmp_shortForecast = oElemJSON.properties.periods[ii].shortForecast;
				var tmp_detailedForecast = oElemJSON.properties.periods[ii].detailedForecast;

				tmp_detailedForecast_celsius = apply_tmp_detailedForecast_Formatting(tmp_detailedForecast, tmp_temperatureUnit_C);
				tmp_detailedForecast = apply_tmp_detailedForecast_Formatting(tmp_detailedForecast, tmp_temperatureUnit);

				$('#nws_json_rawMORE_' + ii).html(tmp_detailedForecast);
				$('#nws_json_rawMORE_celsius_' + ii).html(tmp_detailedForecast_celsius);

				tmp_name = returnDayOfWeekOrTimePeriod(tmp_name);

				if(tmp_isDaytime === "true" || tmp_isDaytime === true){

					var thumb_bg_class = 'wethr_thum_day';

				}else{

					var thumb_bg_class = 'wethr_thum_night';

				}

				tmp_YMD = tmp_startTime.split('T');
				tmp_YMD_str = tmp_YMD[0];
				tmp_date_array = tmp_YMD_str.split('-');
				tmp_year_str = tmp_date_array[0];
				tmp_mnth_str = tmp_date_array[1];
				tmp_day_str = tmp_date_array[2];

				$('#nws_json_headerMORE_' + ii).html('<strong>' + tmp_name + ' :: </strong>' + oDate_month[tmp_mnth_str] + ' ' + oDate_day_eng[tmp_day_str] + ', ' + tmp_year_str);
				$('#nws_json_headerMORE_celsius_' + ii).html('<strong>' + tmp_name + ' :: </strong>' + oDate_month[tmp_mnth_str] + ' ' + oDate_day_eng[tmp_day_str] + ', ' + tmp_year_str);

				if((tmp_isDaytime === true || tmp_isDaytime === "true" || tmp_number === 1 || tmp_number === "1") && tmp_daycnt > 0){
					forecast_item_cnt++;
					tmp_daycnt--;

					if(oWindage_words[tmp_windDirection] != undefined){

						tmp_windage_html = 'Windage '+ tmp_windSpeed +' in '+oWindage_words[tmp_windDirection]+' direction. (<a id="open-popupViewMORE_' + ii + '" href="#" data-rel="popup" data-transition="pop" style="font-weight: normal; color:#0066CC;" title="Detail">detail</a>)';
						tmp_windage_celsius_html = 'Windage '+ tmp_windSpeed +' in '+oWindage_words[tmp_windDirection]+' direction. (<a id="open-popupViewMORE_celsius_' + ii + '" href="#" data-rel="popup" data-transition="pop" style="font-weight: normal; color:#0066CC;" title="Detail">detail</a>)';

					}else{

						tmp_windage_html = ' (<a id="open-popupViewMORE_' + ii + '" href="#" data-rel="popup" data-transition="pop" style="font-weight: normal; color:#0066CC;" title="Detail">detail</a>)' + '<div class="cb_10"></div>';
						tmp_windage_celsius_html = ' (<a id="open-popupViewMORE_celsius_' + ii + '" href="#" data-rel="popup" data-transition="pop" style="font-weight: normal; color:#0066CC;" title="Detail">detail</a>)' + '<div class="cb_10"></div>';

					}

					/*
					<div data-role="popup" id="popupViewMORE_<?php echo $i; ?>" class="ui-content" data-theme="b" data-arrow="false">
						<a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn-a ui-icon-delete ui-btn-icon-notext ui-btn-right">Close</a>
						<div id="nws_json_headerMORE_<?php echo $i; ?>"></div>
						<div class="cb_5" style="border-bottom: 2px solid #ccc;"></div>
						<div class="cb_5"></div>
						<div style="width:100%; font-family:Courier, monospace;">
							<div style="height:350px; overflow: scroll;">
								<div id="nws_json_rawMORE_<?php echo $i; ?>"></div>
							</div>
						</div>
					</div>
					*/

					tmp_forecast_day_period_HTML = '<div class="wethr_period_wrapper">' +
						'<div class="' + thumb_bg_class + '"><img src="' + tmp_icon + '" title="Weather forecast thumbnail for ' + tmp_name + '" alt="' + tmp_shortForecast + '" width="86" height="86"></div>' +
						'<div class="wethr_datum_copy_wrapper">' +
						'<div class="wethr_title_wrapper">' +
						'<div class="wethr_period_name">' + tmp_name + ' :: ' +
						'<span class="wethr_period_dForecast">' + tmp_shortForecast + '. ' + tmp_windage_html + '</span></div>' +
						'<div class="cb"></div>' +
						'</div>' +
						'<div class="degree_date_wrapper">' +
						'<div id="wethr_degree_' + ii + '" class="wethr_degree">' + tmp_temperature + '&deg; ' + tmp_temperatureUnit + '</div>' +
						'<div class="wethr_date">' + oDate_month[tmp_mnth_str] + ' ' + oDate_day_eng[tmp_day_str] + ', ' + tmp_year_str + '</div>' +
						'</div>' +
						'</div>' +
						'</div><div class="cb"></div>';

					tmp_forecast_day_celsius_period_HTML = '<div class="wethr_period_wrapper">' +
						'<div class="' + thumb_bg_class + '"><img src="' + tmp_icon + '" title="Weather forecast thumbnail for ' + tmp_name + '" alt="' + tmp_shortForecast + '" width="86" height="86"></div>' +
						'<div class="wethr_datum_copy_wrapper">' +
						'<div class="wethr_title_wrapper">' +
						'<div class="wethr_period_name">' + tmp_name + ' :: ' +
						'<span class="wethr_period_dForecast">' + tmp_shortForecast + '. ' + tmp_windage_celsius_html + '</span></div>' +
						'<div class="cb"></div>' +
						'</div>' +
						'<div class="degree_date_wrapper">' +
						'<div id="wethr_degree_' + ii + '" class="wethr_degree_celsius">' + tmp_temperature_C + '&deg; ' + tmp_temperatureUnit_C + '</div>' +
						'<div class="wethr_date">' + oDate_month[tmp_mnth_str] + ' ' + oDate_day_eng[tmp_day_str] + ', ' + tmp_year_str + '</div>' +
						'</div>' +
						'</div>' +
						'</div><div class="cb"></div>';

					if(tmp_isDaytime === false || tmp_isDaytime === "false"){

						forecast_night_HTML = forecast_night_HTML + tmp_forecast_day_period_HTML + '<div class="cb_10"></div>';
						forecast_night_celsius_HTML = forecast_night_celsius_HTML + tmp_forecast_day_celsius_period_HTML + '<div class="cb_10"></div>';

					}

					forecast_day_HTML = forecast_day_HTML + tmp_forecast_day_period_HTML;
					forecast_day_celsius_HTML = forecast_day_celsius_HTML + tmp_forecast_day_celsius_period_HTML;

					if(tmp_daycnt>0){

						forecast_day_HTML = forecast_day_HTML + '<div class="cb_10"></div>';
						forecast_day_celsius_HTML = forecast_day_celsius_HTML + '<div class="cb_10"></div>';

					}

				}else{

					if(tmp_nightcnt > 0){
						forecast_item_cnt++;
						tmp_nightcnt--;

						if(oWindage_words[tmp_windDirection] != undefined){

							tmp_windage_html = 'Windage ' + tmp_windSpeed + ' in ' + oWindage_words[tmp_windDirection]  + ' direction. (<a id="open-popupViewMORE_' + ii + '" href="#" data-rel="popup" data-transition="pop" style="font-weight: normal; color:#0066CC;" title="Detail">detail</a>)';
							tmp_windage_celsius_html = 'Windage ' + tmp_windSpeed + ' in ' + oWindage_words[tmp_windDirection]  + ' direction. (<a id="open-popupViewMORE_celsius_' + ii + '" href="#" data-rel="popup" data-transition="pop" style="font-weight: normal; color:#0066CC;" title="Detail">detail</a>)';

						}else{

							tmp_windage_html = ' (<a id="open-popupViewMORE_' + ii + '" href="#" data-rel="popup" data-transition="pop" style="font-weight: normal; color:#0066CC;" title="Detail">detail</a>)' + '<div class="cb_10"></div>';
							tmp_windage_celsius_html = ' (<a id="open-popupViewMORE_celsius_' + ii + '" href="#" data-rel="popup" data-transition="pop" style="font-weight: normal; color:#0066CC;" title="Detail">detail</a>)' + '<div class="cb_10"></div>';

						}

						tmp_forecast_night_period_HTML = '<div class="wethr_period_wrapper">' +
							'<div class="' + thumb_bg_class + '"><img src="' + tmp_icon + '" title="Weather forecast thumbnail for ' + tmp_name + '" alt="' + tmp_shortForecast +'" width="86" height="86"></div>' +
							'<div class="wethr_datum_copy_wrapper">' +
							'<div class="wethr_title_wrapper">' +
							'<div class="wethr_period_name">' + tmp_name + ' :: ' +
							'<span class="wethr_period_dForecast">' + tmp_shortForecast + '. ' + tmp_windage_html + '</span></div>' +
							'<div class="cb"></div>' +
							'</div>' +
							'<div class="degree_date_wrapper">' +
							'<div id="wethr_degree_' + ii + '" class="wethr_degree">' + tmp_temperature + '&deg; ' + tmp_temperatureUnit + '</div>' +
							'<div class="wethr_date">' + oDate_month[tmp_mnth_str] + ' '  + oDate_day_eng[tmp_day_str] + ', ' + tmp_year_str + '</div>' +
							'</div>' +
							'</div>' +
							'</div><div class="cb"></div>';

						tmp_forecast_night_celsius_period_HTML = '<div class="wethr_period_wrapper">' +
							'<div class="' + thumb_bg_class + '"><img src="' + tmp_icon  + '" title="Weather forecast thumbnail for ' + tmp_name + '" alt="' + tmp_shortForecast + '" width="86" height="86"></div>' +
							'<div class="wethr_datum_copy_wrapper">' +
							'<div class="wethr_title_wrapper">' +
							'<div class="wethr_period_name">' + tmp_name + ' :: ' +
							'<span class="wethr_period_dForecast">' + tmp_shortForecast + '. ' + tmp_windage_celsius_html + '</span></div>' +
							'<div class="cb"></div>' +
							'</div>' +
							'<div class="degree_date_wrapper">' +
							'<div id="wethr_degree_' + ii + '" class="wethr_degree_celsius">' + tmp_temperature_C + '&deg; ' + tmp_temperatureUnit_C +  '</div>' +
							'<div class="wethr_date">' + oDate_month[tmp_mnth_str] + ' ' + oDate_day_eng[tmp_day_str] + ', ' + tmp_year_str + '</div>' +
							'</div>' +
							'</div>' +
							'</div><div class="cb"></div>';

						forecast_night_HTML = forecast_night_HTML + tmp_forecast_night_period_HTML;
						forecast_night_celsius_HTML = forecast_night_celsius_HTML + tmp_forecast_night_celsius_period_HTML;

						if(tmp_nightcnt>0){

							forecast_night_HTML = forecast_night_HTML + '<div class="cb_10"></div>';
							forecast_night_celsius_HTML = forecast_night_celsius_HTML + '<div class="cb_10"></div>';

						}

					}

				}

			}

			$('#xygrid_forecast_output').html(forecast_day_HTML);

			$('#forecast_day').html(forecast_day_HTML);
			$('#forecast_night').html(forecast_night_HTML);

			$('#forecast_day_celsius').html(forecast_day_celsius_HTML);
			$('#forecast_night_celsius').html(forecast_night_celsius_HTML);

			/*
			"number": 1,
			"name": "Today",
			"startTime": "2020-02-29T10:00:00-06:00",
			"endTime": "2020-02-29T18:00:00-06:00",
			"isDaytime": true,
			"temperature": 65,
			"temperatureUnit": "F",
			"temperatureTrend": null,
			"windSpeed": "15 to 20 mph",
			"windDirection": "S",
			"icon": "https://api.weather.gov/icons/land/day/wind_few?size=medium",
			"shortForecast": "Sunny",
			"detailedForecast": "Sunny, with a high near 65. South wind 15 to 20 mph, with gusts as high as 40 mph."
			* */

			//clearTimeout(wethr_refresh_timer);

			// 15 min
			//wethr_refresh_timer = setInterval("wethr_refresh()",900000);

		break;

	}

}

function parseXHRCP_JSON_error(oElemJSON){

	/*
	{
    "correlationId": "24181cdc-fbc9-4e2d-a560-4c564b8c6b25",
    "title": "Forecast Grid Expired",
    "type": "https://api.weather.gov/problems/ForecastGridExpired",
    "status": 503,
    "detail": "The requested forecast grid was issued 2020-03-24T16:24:12+00:00 and has expired.",
    "instance": "https://api.weather.gov/requests/24181cdc-fbc9-4e2d-a560-4c564b8c6b25"
}
	* */

	//var tmp_number = oElemJSON.title;
	//var tmp_name = oElemJSON.detail;

	//alert('hello error response');
	//$('#xygrid_forecast_output').html(forecast_day_HTML);

	if(oElemJSON.responseText == ""){

		var tmp_resp = "The National Weather Service API is not responding; it may currently be down for maintenance. Please check back later for good wethr report.";

	}else{

		var tmp_resp = oElemJSON.responseText;
	}

	var tmp_err_output = '<strong><a href="https://www.weather.gov/" target="_blank" style="font-weight:normal; color:#0066CC;">National Weather Service</a> Response ::</strong><div class="cb_10"></div>' + tmp_resp;

	tmp_err_output = tmp_err_output + '<div class="cb_10"></div><a href="' + $('#ajax_root').html() + '" target="_self" style="color:#0066CC; font-weight:normal;" data-ajax="false">Click here</a> for a new wethr lookup.';

	$('#xygrid_forecast_output').html(tmp_err_output);
	$('#toggleUnit_wrapper').html('');

}

function returnDayOfWeekOrTimePeriod(str){

	switch(str){
		case 'Sunday Night':
		case 'Sunday':
		case 'Monday':
			var outputPeriod = oDayOfWeek[str];
		break;
		default:
			var outputPeriod = str;
		break;

	}

	return outputPeriod;

}

function unitConversionHover(elem, state='OFF'){

	switch(state){
		case 'MOUSE_DOWN':

			if(oMouseState_hover[elem.id] === 'ON'){

				obj_btn = $('#toggleUnit_btn');
				obj_btn.removeClass('toggleUnit_btn');
				obj_btn.removeClass('toggleUnit_btn_hvr');
				obj_btn.addClass('toggleUnit_btn_clck');

				obj_btn = $('#toggleUnit_deg');
				obj_btn.removeClass('toggleUnit_deg');
				obj_btn.removeClass('toggleUnit_deg_hvr');
				obj_btn.addClass('toggleUnit_deg_clck');

				obj_btn = $('#toggleUnit_copy');
				obj_btn.removeClass('toggleUnit_deg');
				obj_btn.removeClass('toggleUnit_deg_hvr');
				obj_btn.addClass('toggleUnit_copy_clck');

				obj_btn = $('#toggleUnit_btn_btm');
				obj_btn.removeClass('toggleUnit_btn_btm');
				obj_btn.removeClass('toggleUnit_btn_hvr_btm');
				obj_btn.addClass('toggleUnit_btn_clck_btm');

				obj_btn = $('#toggleUnit_deg_btm');
				obj_btn.removeClass('toggleUnit_deg');
				obj_btn.removeClass('toggleUnit_deg_hvr');
				obj_btn.addClass('toggleUnit_deg_clck');

				obj_btn = $('#toggleUnit_copy_btm');
				obj_btn.removeClass('toggleUnit_copy');
				obj_btn.removeClass('toggleUnit_copy_hvr');
				obj_btn.addClass('toggleUnit_copy_clck');

			}else{

				obj_btn = $('#toggleUnit_btn');
				obj_btn.removeClass('toggleUnit_btn_hvr');
				obj_btn.removeClass('toggleUnit_btn_clck');
				obj_btn.addClass('toggleUnit_btn');

				obj_btn = $('#toggleUnit_deg');
				obj_btn.removeClass('toggleUnit_deg_hvr');
				obj_btn.removeClass('toggleUnit_deg_clck');
				obj_btn.addClass('toggleUnit_deg');

				obj_btn = $('#toggleUnit_copy');
				obj_btn.removeClass('toggleUnit_deg_hvr');
				obj_btn.removeClass('toggleUnit_copy_clck');
				obj_btn.addClass('toggleUnit_deg');

				obj_btn = $('#toggleUnit_btn_btm');
				obj_btn.removeClass('toggleUnit_btn_hvr_btm');
				obj_btn.removeClass('toggleUnit_btn_clck_btm');
				obj_btn.addClass('toggleUnit_btn_btm');

				obj_btn = $('#toggleUnit_deg_btm');
				obj_btn.removeClass('toggleUnit_deg_hvr');
				obj_btn.removeClass('toggleUnit_deg_clck');
				obj_btn.addClass('toggleUnit_deg');

				obj_btn = $('#toggleUnit_copy_btm');
				obj_btn.removeClass('toggleUnit_copy_hvr');
				obj_btn.removeClass('toggleUnit_copy_clck');
				obj_btn.addClass('toggleUnit_copy');

			}

		break;
		case 'MOUSE_UP':

			if(oMouseState_hover[elem.id] === 'ON'){

				obj_btn = $('#toggleUnit_btn');
				obj_btn.removeClass('toggleUnit_btn');
				obj_btn.removeClass('toggleUnit_btn_clck');
				obj_btn.addClass('toggleUnit_btn_hvr');

				obj_btn = $('#toggleUnit_deg');
				obj_btn.removeClass('toggleUnit_deg');
				obj_btn.removeClass('toggleUnit_deg_clck');
				obj_btn.addClass('toggleUnit_deg_hvr');

				obj_btn = $('#toggleUnit_copy');
				obj_btn.removeClass('toggleUnit_deg');
				obj_btn.removeClass('toggleUnit_copy_clck');
				obj_btn.addClass('toggleUnit_copy_hvr');

				obj_btn = $('#toggleUnit_btn_btm');
				obj_btn.removeClass('toggleUnit_btn_btm');
				obj_btn.removeClass('toggleUnit_btn_clck_btm');
				obj_btn.addClass('toggleUnit_btn_hvr_btm');

				obj_btn = $('#toggleUnit_deg_btm');
				obj_btn.removeClass('toggleUnit_deg');
				obj_btn.removeClass('toggleUnit_deg_clck');
				obj_btn.addClass('toggleUnit_deg_hvr');

				obj_btn = $('#toggleUnit_copy_btm');
				obj_btn.removeClass('toggleUnit_copy');
				obj_btn.removeClass('toggleUnit_copy_clck');
				obj_btn.addClass('toggleUnit_copy_hvr');

			}else{

				obj_btn = $('#toggleUnit_btn');
				obj_btn.removeClass('toggleUnit_btn_hvr');
				obj_btn.removeClass('toggleUnit_btn_clck');
				obj_btn.addClass('toggleUnit_btn');

				obj_btn = $('#toggleUnit_deg');
				obj_btn.removeClass('toggleUnit_deg_hvr');
				obj_btn.removeClass('toggleUnit_deg_clck');
				obj_btn.addClass('toggleUnit_deg');

				obj_btn = $('#toggleUnit_copy');
				obj_btn.removeClass('toggleUnit_deg_hvr');
				obj_btn.removeClass('toggleUnit_copy_clck');
				obj_btn.addClass('toggleUnit_copy');

				obj_btn = $('#toggleUnit_btn_btm');
				obj_btn.removeClass('toggleUnit_btn_hvr_btm');
				obj_btn.removeClass('toggleUnit_btn_clck_btm');
				obj_btn.addClass('toggleUnit_btn_btm');

				obj_btn = $('#toggleUnit_deg_btm');
				obj_btn.removeClass('toggleUnit_deg_hvr');
				obj_btn.removeClass('toggleUnit_deg_clck');
				obj_btn.addClass('toggleUnit_deg');

				obj_btn = $('#toggleUnit_copy_btm');
				obj_btn.removeClass('toggleUnit_copy_hvr');
				obj_btn.removeClass('toggleUnit_copy_clck');
				obj_btn.addClass('toggleUnit_copy');

			}

		break;
		case 'ON':

			oMouseState_hover[elem.id] = 'ON';

			obj_btn = $('#toggleUnit_btn');
			obj_btn.removeClass('toggleUnit_btn');
			obj_btn.removeClass('toggleUnit_btn_clck');
			obj_btn.addClass('toggleUnit_btn_hvr');

			obj_btn = $('#toggleUnit_deg');
			obj_btn.removeClass('toggleUnit_deg');
			obj_btn.removeClass('toggleUnit_deg_clck');
			obj_btn.addClass('toggleUnit_deg_hvr');

			obj_btn = $('#toggleUnit_copy');
			obj_btn.removeClass('toggleUnit_copy');
			obj_btn.removeClass('toggleUnit_copy_clck');
			obj_btn.addClass('toggleUnit_copy_hvr');

			obj_btn = $('#toggleUnit_btn_btm');
			obj_btn.removeClass('toggleUnit_btn_btm');
			obj_btn.removeClass('toggleUnit_btn_clck_btm');
			obj_btn.addClass('toggleUnit_btn_hvr_btm');

			obj_btn = $('#toggleUnit_deg_btm');
			obj_btn.removeClass('toggleUnit_deg');
			obj_btn.removeClass('toggleUnit_deg_clck');
			obj_btn.addClass('toggleUnit_deg_hvr');

			obj_btn = $('#toggleUnit_copy_btm');
			obj_btn.removeClass('toggleUnit_copy');
			obj_btn.removeClass('toggleUnit_copy_clck');
			obj_btn.addClass('toggleUnit_copy_hvr');

		break;
		default:
			// OFF
			oMouseState_hover[elem.id] = 'OFF';

			obj_btn = $('#toggleUnit_btn');
			obj_btn.removeClass('toggleUnit_btn_hvr');
			obj_btn.removeClass('toggleUnit_btn_clck');
			obj_btn.addClass('toggleUnit_btn');

			obj_btn = $('#toggleUnit_deg');
			obj_btn.removeClass('toggleUnit_deg_hvr');
			obj_btn.removeClass('toggleUnit_deg_clck');
			obj_btn.addClass('toggleUnit_deg');

			obj_btn = $('#toggleUnit_copy');
			obj_btn.removeClass('toggleUnit_copy_hvr');
			obj_btn.removeClass('toggleUnit_copy_clck');
			obj_btn.addClass('toggleUnit_copy');

			obj_btn = $('#toggleUnit_btn_btm');
			obj_btn.removeClass('toggleUnit_btn_hvr_btm');
			obj_btn.removeClass('toggleUnit_btn_clck_btm');
			obj_btn.addClass('toggleUnit_btn_btm');

			obj_btn = $('#toggleUnit_deg_btm');
			obj_btn.removeClass('toggleUnit_deg_hvr');
			obj_btn.removeClass('toggleUnit_deg_clck');
			obj_btn.addClass('toggleUnit_deg');

			obj_btn = $('#toggleUnit_copy_btm');
			obj_btn.removeClass('toggleUnit_copy_hvr');
			obj_btn.removeClass('toggleUnit_copy_clck');
			obj_btn.addClass('toggleUnit_copy');

		break;

	}

}

function toggleUnit(){

	tmp_unit = $('#toggleUnit_copy').html();

	switch(tmp_unit){
		case 'F':

			tmp_lnk_copy = $('#toggle_daynight_anchor').html();

			if(tmp_lnk_copy == "View Daytime Forecast"){

				if(forecast_item_cnt > 0){

					$('#xygrid_forecast_output').html($('#forecast_night').html());
					$('#toggleUnit_copy').html('C');
					$('#toggleUnit_copy_btm').html('C');

				}else{

					$('#toggle_daynight').html("");
					$('#toggle_daynight_btm').html("");

				}

			}else{

				if(forecast_item_cnt > 0) {

					$('#xygrid_forecast_output').html($('#forecast_day').html());
					$('#toggleUnit_copy').html('C');
					$('#toggleUnit_copy_btm').html('C');

				}else{

					$('#toggle_daynight').html("");
					$('#toggle_daynight_btm').html("");

				}

			}

		break;
		default:

			tmp_lnk_copy = $('#toggle_daynight_anchor').html();

			//
			// Celsius
			if(tmp_lnk_copy === "View Daytime Forecast"){

				if(forecast_item_cnt > 0){

					$('#xygrid_forecast_output').html($('#forecast_night_celsius').html());
					$('#toggleUnit_copy').html('F');
					$('#toggleUnit_copy_btm').html('F');

				}else{

					$('#toggle_daynight').html("");
					$('#toggle_daynight_btm').html("");

				}

			}else{

				if(forecast_item_cnt > 0) {

					$('#xygrid_forecast_output').html($('#forecast_day_celsius').html());
					$('#toggleUnit_copy').html('F');
					$('#toggleUnit_copy_btm').html('F');

				}else{

					$('#toggle_daynight').html("");
					$('#toggle_daynight_btm').html("");

				}

			}

		break;

	}

}

function toggleDayNight(elem){

	tmp_lnk_copy = elem.innerHTML;
	tmp_unit = $('#toggleUnit_copy').html();

	switch(tmp_unit){
		case 'F':

			if(tmp_lnk_copy === "View Evening Forecast"){

				$('#toggle_daynight').html('<a id="toggle_daynight_anchor"  href="#" target="_self" onclick="toggleDayNight(this);" style="color:#0066CC; font-weight:normal;" data-ajax="false">View Daytime Forecast</a>');
				$('#toggle_daynight_btm').html('<a href="#" target="_self" onclick="toggleDayNight(this);" style="color:#0066CC; font-weight:normal;" data-ajax="false">View Daytime Forecast</a>');

				if(forecast_item_cnt > 0){

					$('#xygrid_forecast_output').html($('#forecast_night_celsius').html());

				}else{

					$('#toggle_daynight').html("");
					$('#toggle_daynight_btm').html("");

				}

			}else{

				$('#toggle_daynight').html('<a id="toggle_daynight_anchor" href="#" target="_self" onclick="toggleDayNight(this);" style="color:#0066CC; font-weight:normal;" data-ajax="false">View Evening Forecast</a>');
				$('#toggle_daynight_btm').html('<a href="#" target="_self" onclick="toggleDayNight(this);" style="color:#0066CC; font-weight:normal;" data-ajax="false">View Evening Forecast</a>');

				if(forecast_item_cnt > 0) {

					$('#xygrid_forecast_output').html($('#forecast_day_celsius').html());

				}else{

					$('#toggle_daynight').html("");
					$('#toggle_daynight_btm').html("");

				}

			}

		break;
		default:

			//
			// Celsius
			if(tmp_lnk_copy === "View Evening Forecast"){

				$('#toggle_daynight').html('<a id="toggle_daynight_anchor" href="#" target="_self" onclick="toggleDayNight(this);" style="color:#0066CC; font-weight:normal;" data-ajax="false">View Daytime Forecast</a>');
				$('#toggle_daynight_btm').html('<a href="#" target="_self" onclick="toggleDayNight(this);" style="color:#0066CC; font-weight:normal;" data-ajax="false">View Daytime Forecast</a>');

				if(forecast_item_cnt > 0){

					$('#xygrid_forecast_output').html($('#forecast_night').html());

				}else{

					$('#toggle_daynight').html("");
					$('#toggle_daynight_btm').html("");

				}

			}else{

				$('#toggle_daynight').html('<a id="toggle_daynight_anchor" href="#" target="_self" onclick="toggleDayNight(this);" style="color:#0066CC; font-weight:normal;" data-ajax="false">View Evening Forecast</a>');
				$('#toggle_daynight_btm').html('<a href="#" target="_self" onclick="toggleDayNight(this);" style="color:#0066CC; font-weight:normal;" data-ajax="false">View Evening Forecast</a>');

				if(forecast_item_cnt > 0) {

					$('#xygrid_forecast_output').html($('#forecast_day').html());

				}else{

					$('#toggle_daynight').html("");
					$('#toggle_daynight_btm').html("");

				}

			}

		break;

	}

}

// SOURCE :: https://stackoverflow.com/questions/19491336/get-url-parameter-jquery-or-how-to-get-query-string-values-in-js
// AUTHOR :: https://stackoverflow.com/users/1897010/sameer-kazi
// SOURCE [ORIGINAL] :: http://www.jquerybyexample.net/2012/06/get-url-parameters-using-jquery.html
function getUrlParameter(sParam_cust) {
	var sPageURL_cust = window.location.search.substring(1),
		sURLVariables_cust = sPageURL_cust.split('&'),
		sParameterName_cust,
		aaa;

	for (aaa = 0; aaa < sURLVariables_cust.length; aaa++) {
		sParameterName_cust = sURLVariables_cust[aaa].split('=');

		if (sParameterName_cust[0] === sParam_cust) {
			return sParameterName_cust[1] === undefined ? true : decodeURIComponent(sParameterName_cust[1]);
		}
	}
}

function startHeartbeats(){

	//
	// TIMER SEC INTERVAL
	clearTimeout(baseHeartBeat);
	baseHeartBeat = setInterval("syncTimerState()",1000);
	log_activity("1 sec interval heartbeat started.");

}

//
// SOURCE :: https://joe-riggs.com/blog/2012/05/javascript-count-up-timer-with-hours-minutes-second-hours-minutes/
// AUTHOR :: https://joe-riggs.com/blog/author/jriggs/
function syncTimerState(){
	if($('#timer_lck').html()==="OFF"){

		if($("#timer_copy_persist").length){
			var time_shown = $("#timer_copy_persist").html();
			var time_chunks = time_shown.split(":");
			var hour, mins, secs;

			hour=Number(time_chunks[0]);
			mins=Number(time_chunks[1]);
			secs=Number(time_chunks[2]);
			secs++;

			if (secs==60){
				secs = 0;
				mins=mins + 1;
			}
			if (mins==60){
				mins=0;
				hour=hour + 1;
			}
			//if (hour==13){
			//	hour=1;
			//}

			$("#timer_copy_persist").html(hour +":" + plz(mins) + ":" + plz(secs));

			if($("#timer_copy").length){

				$("#timer_copy").html(hour +":" + plz(mins) + ":" + plz(secs));
			}

		}

	}else{

		//alert('timer locked...');
	}

}

function plz(digit){

	var zpad = digit + '';
	if (digit < 10) {
		zpad = "0" + zpad;
	}
	return zpad;
}

function applyLangPackStyles_FULL(overlay_type, objLangPack, tmp_copy_fullscrn_font_size_percentage, cleartext_endpoint,copy_hash){

	//
	// APPLY CSS STYLES  [font_size_percentage]
	objLangPack.getElementsByClassName("main_copy_header")[0].style.fontSize = tmp_copy_fullscrn_font_size_percentage+"%";
	objLangPack.getElementsByClassName("main_document_title")[0].style.fontSize = tmp_copy_fullscrn_font_size_percentage+"%";
	objLangPack.getElementsByClassName("main_document_body")[0].style.fontSize = tmp_copy_fullscrn_font_size_percentage+"%";

}


// SOURCE :: https://stackoverflow.com/questions/14129953/how-to-encode-a-string-in-javascript-for-displaying-in-html
// AUTHOR :: https://stackoverflow.com/users/616443/j08691
function htmlEntities(str) {
	return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
}

function log_activity(str){

	switch(log_controller){
		case 1:

			if(activity_log_FLAG!='') {

				//
				// LOG ACTIVITY TO SCREEN
				var timeStampInMs = window.performance && window.performance.now && window.performance.timing && window.performance.timing.navigationStart ? window.performance.now() + window.performance.timing.navigationStart : Date.now();

				var walltime = $("#timer_copy_persist").html();
				//var objLOGDiv = document.createElement('div');
				//objLOGDiv.setAttribute('class', 'log_entry');
				//$("#activity_log_output").prepend(objLOGDiv);

				//
				// CLEAN STRING FOR HTML
				// &lt;profile&gt;
				//str_clean = htmlEntities(str);

				//objLOGDiv.innerHTML = timeStampInMs + ' (' + walltime + ') :: ' + str_clean;
				console.log(timeStampInMs + ' (' + walltime + ') :: ' + str);

			}

		break;
		case 0:
			//
			// SILENCE IS GOLDEN
		break;
		default:
			alert('The logger param [var log_controller] is not visible to me.');
		break;


	}

}


function oProfileIndex(requestor_id,pid,config_hash,profile_endpoint,lastmodified) {
	this.requestor_id = requestor_id;
	this.pid = pid;
	this.config_hash = config_hash;
	this.profile_endpoint = profile_endpoint;
	this.lastmodified = lastmodified;
	log_activity("Object created: oProfileIndex ["+this.pid+"] config_hash ["+this.config_hash+"]");

}


function generate_cachebust(){
	//https://gist.github.com/6174/6062387
	//http://stackoverflow.com/questions/105034/how-to-create-a-guid-uuid-in-javascript
	$('#cache_bust').html(Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2, 15));
}
