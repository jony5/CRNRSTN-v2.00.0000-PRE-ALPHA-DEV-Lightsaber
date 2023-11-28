<?php
/* 
// J5
// Code is Poetry */

?>
    <div data-role="panel" id="rightpanel_search" data-position="right" data-display="overlay" data-theme="a" class="ui-panel ui-panel-position-right ui-panel-display-overlay ui-body-a ui-panel-animate ui-panel-closed">
        <div class="ui-panel-inner">
            <form class="ui-filterable" action="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR')."dashboard/search/"; ?>" method="get" name="filter_kivotos_results_<?php echo $tmp_formUnique; ?>" id="filter_kivotos_results_<?php echo $tmp_formUnique; ?>" data-ajax="false">

                <input id="autocomplete-input" data-type="search" name="q" placeholder="Search the extranet...">
				<ul id="autocomplete" data-role="listview" data-inset="true" data-filter="true" data-input="#autocomplete-input" class="ui-alt-icon"></ul>
            
            	<div class="cb_10"></div>
            	<button type="submit" class="ui-btn ui-corner-all ui-shadow ui-btn-a">SEARCH</button>
            </form>
            <p><br><br></p>
            <a href="#close_lnk" data-rel="close" class="ui-btn ui-shadow ui-corner-all ui-btn-a ui-icon-delete ui-btn-icon-left ui-btn-inline">Close</a>
        </div>
	</div>