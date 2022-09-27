<?php

//
// INITIALIZATION OF THIRD PARTY ENGAGEMENT TAG PROFILES ::
// CRNRSTN :: ADVANCED CONFIGURATION PARAMETERS

$tmp_str_JONY5 = $tmp_str_EVIFWEB = $tmp_str_CHAD_MACBOOKPRO = $tmp_str_MACBOOKPRO = '<!-- Global ENGAGEMENT tag :: EXAMPLE -->
<script>

    //
	// USER ENGAGEMENT TRACKING TAG JS CODE :: HERE
	//
	// E.G. GOOGLE PLACEMENT TAG.
	// https://support.google.com/campaignmanager/answer/2826636?hl=en
	
</script>';

$tmp_str_JONY5_TEST = '<!-- Global ENGAGEMENT tag - **DEMO_ENGAGEMENT_TEST**  -->
<script>
// HELLO TEST - will only load if called manually, due to is_enabled = false.
</script>
';

//
// INITIALIZE ENGAGEMENT PROFILE(S) FOR EACH ENVIRONMENT.
// $this->config_add_seo_engagemnent([environment-key], [data-key], [3rd-party-html-injection-string], [enabled-by-default]=true);
$this->config_add_seo_engagemnent('BLUEHOST_JONY5', 'DEMO_ENGAGEMENT', $tmp_str_JONY5);
$this->config_add_seo_engagemnent('BLUEHOST_EVIFWEB', 'DEMO_ENGAGEMENT', $tmp_str_EVIFWEB);
$this->config_add_seo_engagemnent('LOCALHOST_CHAD_MACBOOKPRO', 'DEMO_ENGAGEMENT_TEST', $tmp_str_JONY5_TEST, false);
$this->config_add_seo_engagemnent('LOCALHOST_CHAD_MACBOOKPRO', 'DEMO_ENGAGEMENT', $tmp_str_CHAD_MACBOOKPRO);
$this->config_add_seo_engagemnent('LOCALHOST_MACBOOKPRO', 'DEMO_ENGAGEMENT', $tmp_str_MACBOOKPRO);