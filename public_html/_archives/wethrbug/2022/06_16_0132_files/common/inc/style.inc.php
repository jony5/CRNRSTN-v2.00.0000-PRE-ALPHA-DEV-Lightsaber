<style type="text/css">
	*				{ font-family:Arial, Helvetica, sans-serif;}
	body  			{ padding:0px; margin:0px;}

    .wethr_period_wrapper               { width:350px; line-height: 16px; font-size:12px; color:#FFF; font-weight:normal; height:114px; overflow: hidden;}
    .wethr_thum_day                     { float:left; width:86px; height:86px; background-color:#FFF; border:2px solid #FFF; overflow: hidden;}
    .wethr_thum_night                   { float:left; width:86px; height:86px; background-color:#907F7F; border:2px solid #907F7F; overflow: hidden;}
    .wethr_datum_copy_wrapper           { float:left; color:#090; width:230px; padding-left:10px;}

    #forecast_locale                    { padding-top: 5px;padding-bottom: 10px;}
    #toggle_daynight                    { padding-bottom:10px; }
    #toggle_daynight_btm                { }

    #toggle_daynight a                  { font-weight:normal; }
    #toggle_daynight_btm a              { font-weight:normal; }

    .toggleUnit_wrapper                 { float:right; width: 1px; height: 1px;}
    .toggleUnit_rel                     { position: relative;}
    .toggleUnit_btn                     { position: absolute; top:-35px; left:-62px; width: 53px; height: 22px; background-color: #000; border: 2px solid #090; border-radius: 5px; cursor: pointer;}
    .toggleUnit_btn_hvr                 { position: absolute; top:-35px; left:-62px; width: 53px; height: 22px; background-color: #090; border: 2px solid #090; border-radius: 5px; cursor: pointer;}
    .toggleUnit_btn_clck                { position: absolute; top:-35px; left:-62px; width: 53px; height: 22px; background-color: #F90000; border: 2px solid #F90000; border-radius: 5px; cursor: pointer;}

    .toggleUnit_btn_btm                 { position: absolute; top:-25px; left:-62px; width: 53px; height: 22px; background-color: #000; border: 2px solid #090; border-radius: 5px; cursor: pointer;}
    .toggleUnit_btn_hvr_btm             { position: absolute; top:-25px; left:-62px; width: 53px; height: 22px; background-color: #090; border: 2px solid #090; border-radius: 5px; cursor: pointer;}
    .toggleUnit_btn_clck_btm            { position: absolute; top:-25px; left:-62px; width: 53px; height: 22px; background-color: #F90000; border: 2px solid #F90000; border-radius: 5px; cursor: pointer;}

    .toggleUnit_content                 { width: 32px; text-align: center; margin: 0px auto;}
    .toggleUnit_deg                     { float: left; padding-top: 2px; font-weight: bold; font-size: 20px; line-height:25px; font-family: "Courier New", Courier, monospace; color: #090; }
    .toggleUnit_deg_hvr                 { float: left; padding-top: 2px; font-weight: bold; font-size: 20px; line-height:25px; font-family: "Courier New", Courier, monospace; color: #000; text-shadow: 0px 1px 0px #090, 0 0 1em #090, 0 0 0.2em #090;}
    .toggleUnit_deg_clck                { float: left; padding-top: 2px; font-weight: bold; font-size: 20px; line-height:25px; font-family: "Courier New", Courier, monospace; color: #FFF; text-shadow: 0px 1px 0px #F90000, 0 0 1em #F90000, 0 0 0.2em #F90000;}

    .toggleUnit_copy                    { float: left; font-weight: bold;  font-size: 20px; line-height:25px; font-family: "Courier New", Courier, monospace; color: #090;}
    .toggleUnit_copy_hvr                { float: left; font-weight: bold;  font-size: 20px; line-height:25px; font-family: "Courier New", Courier, monospace; color: #000; text-shadow: 0px 1px 0px #090, 0 0 1em #090, 0 0 0.2em #090;}
    .toggleUnit_copy_clck               { float: left; font-weight: bold;  font-size: 20px; line-height:25px; font-family: "Courier New", Courier, monospace; color: #FFF; text-shadow: 0px 1px 0px #F90000, 0 0 1em #F90000, 0 0 0.2em #F90000;}

    .wethr_title_wrapper                { width:220px;}
    .wethr_period_name                  { font-weight: bold; color:#FFF;}
    .wethr_period_dForecast             { color:#090; font-weight:normal; }
    .degree_date_wrapper                { float:left; width:220px; clear:both;}
    .wethr_degree                       { font-size:36px; float:left; line-height:40px;}
    .wethr_degree_celsius               { font-size:26px; float:left; line-height:40px;}
    .wethr_date                         { float:right; padding:20px 15px; 0 0;}

	#body_wrapper						{ margin:10px;}
	.hometitle							{ font-size:medium; }
	.hometinysubtitle					{ font-size:x-small; }

	.fieldtitle							{ font-size:11px;}
	.weatherIcon						{ float:left; padding:10px;}
	.legal								{ font-size:x-small; text-align:center; margin:0px auto;}
	#formStatus							{ font-size:11px; color:#F00;}

    .wthrbg_title_sub_title             { color:#FFF; font-size:small;}
    .wthrbg_small_sub_title             { color:#FFF; font-size:x-small;}
	
	.frm_errstatus						{ color:#F30; font-size: 11px;}
    .req_star                           { font-weight: bold; font-size:120%; color:#F30;}

    /*JQUERY MOBILE AUTO COMPLETE*/
    .ui-filter-inset {
            margin-top: 0;
    }

    /*UTILITY*/
    .hidden								{ width:0px; height:0px; position:absolute; left:-2000px; overflow:hidden;}
    .cb_mini							{ display:block; clear:both; height:1px; line-height:1px; overflow:hidden; width:100%; padding-bottom:4px;  font-size:1px;}
	.cb_small 							{ display:block; clear:both; height:10px;  line-height:1px; overflow:hidden; border:0px; padding:0px; margin:0px; font-size:1px;}
	.cb_small20							{ display:block; clear:both; height:20px;  line-height:1px; overflow:hidden; border:0px; padding:0px; margin:0px; font-size:1px;}
    .cb 								{ display:block; clear:both; height:0px; line-height:0px; overflow:hidden; width:100%; font-size:1px;}
    .cb_5	 							{ display:block; clear:both; height:5px;  line-height:1px; overflow:hidden; border:0px; padding:0px; margin:0px; font-size:1px;}
    .cb_10	 							{ display:block; clear:both; height:10px;  line-height:1px; overflow:hidden; border:0px; padding:0px; margin:0px; font-size:1px;}
    .cb_15	 							{ display:block; clear:both; height:15px;  line-height:1px; overflow:hidden; border:0px; padding:0px; margin:0px; font-size:1px;}
    .cb_20								{ display:block; clear:both; height:20px;  line-height:1px; overflow:hidden; border:0px; padding:0px; margin:0px; font-size:1px;}
    .cb_30								{ display:block; clear:both; height:30px;  line-height:1px; overflow:hidden; border:0px; padding:0px; margin:0px; font-size:1px;}
    .cb_40								{ display:block; clear:both; height:40px;  line-height:1px; overflow:hidden; border:0px; padding:0px; margin:0px; font-size:1px;}
    .cb_50	 							{ display:block; clear:both; height:50px;  line-height:1px; overflow:hidden; border:0px; padding:0px; margin:0px; font-size:1px;}
    .cb_75								{ display:block; clear:both; height:75px;  line-height:1px; overflow:hidden; border:0px; padding:0px; margin:0px; font-size:1px;}
    .cb_100 							{ display:block; clear:both; height:100px; line-height:1px; overflow:hidden; border:0px; padding:0px; margin:0px; font-size:1px;}
    .cb_200								{ display:block; clear:both; height:200px; line-height:1px; overflow:hidden; border:0px; padding:0px; margin:0px; font-size:1px;}
</style>