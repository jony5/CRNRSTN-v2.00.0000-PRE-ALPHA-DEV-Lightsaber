<?php
/* 
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
require($ROOT.'_crnrstn.config.inc.php');
require($oUSER->getEnvParam('DOCUMENT_ROOT').$oUSER->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/fh/session.inc.php');

//
// RETRIEVE CONTENT FOR FORM PREPOPULATION
$oUSER->contentRetrieveAdmin();

$EXAMPLEID = $oENV->oHTTP_MGR->extractData($_GET,'e');
$page_title = "SOAP";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<?php
require($oUSER->getEnvParam('DOCUMENT_ROOT').$oUSER->getEnvParam('DOCUMENT_ROOT_DIR').'/common/inc/head/head.inc.php');
?>
</head>

<body>
<div id="content_wrapper">
	<div id="content_area_wrapper">
		<div id="content_area_main">
			<div id="doc_content_results_wrapper">
				<div id="doc_content_results">
					<h1 id="content_results_title"><?php echo $oUSER->contentOutput_ARRAY[1]['NAME'].' ::'; ?></h1>
					<div class="cb_15"></div>
					<div id="content_results_body">
						<div class="title_editable_section"><h3 class="content_results_subtitle">Examples ::</h3></div>
						<div class="cb"></div>
						<div class="content_results_subtitle_divider"></div>
						<?php 
							for($i=0;$i<sizeof($oUSER->contentOutput_ARRAY[1]['EXAMPLES']);$i++){
								if($oUSER->contentOutput_ARRAY[1]['EXAMPLES'][$i]['EXAMPLEID']==$EXAMPLEID){
									echo '<p><strong>TITLE = </strong> '.$oUSER->contentOutput_ARRAY[1]['EXAMPLES'][$i]['TITLE'].'</p>';;
									echo '<div class="cb_15"></div>';
									echo '<p><strong>DESCRIPTION = </strong> '.$oUSER->contentOutput_ARRAY[1]['EXAMPLES'][$i]['DESCRIPTION'].'</p>';
									echo '<div class="cb_15"></div>';
									echo '<p><strong>CONTENT = </strong> </p>';
									echo $oUSER->contentOutput_ARRAY[1]['EXAMPLES'][$i]['EXAMPLE_FORMATTED'];
								}
							}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>