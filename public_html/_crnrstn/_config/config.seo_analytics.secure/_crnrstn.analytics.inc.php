<?php

//
// INITIALIZATION OF THIRD PARTY ANALYTICS TAG PROFILES ::
// CRNRSTN :: ADVANCED CONFIGURATION PARAMETERS

$tmp_str_JONY5 = '<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-5WQEX5QE9Y"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag(\'js\', new Date());

  gtag(\'config\', \'G-5WQEX5QE9Y\');
</script>
';

$tmp_str_EVIFWEB = '<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-EVBJ1EJ75E"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag(\'js\', new Date());

  gtag(\'config\', \'G-EVBJ1EJ75E\');
</script>
';

$tmp_str_JONY5_TEST = $tmp_str_CHAD_MACBOOKPRO = $tmp_str_MACBOOKPRO = '<!-- Global site tag - **config_add_seo_analytics TEST**  -->
<script>
// HELLO TEST
</script>
';

//
// INITIALIZE ANALYTICS PROFILE(S) FOR EACH ENVIRONMENT.
// $this->config_add_seo_analytics([environment-key], [data-key], [3rd-party-html-injection-string], [enabled-by-default]=true);
$this->config_add_seo_analytics('BLUEHOST_JONY5', 'GOOGLE_ANALYTICS', $tmp_str_JONY5);
$this->config_add_seo_analytics('BLUEHOST_EVIFWEB', 'GOOGLE_ANALYTICS', $tmp_str_EVIFWEB);
$this->config_add_seo_analytics('LOCALHOST_CHAD_MACBOOKPRO', 'GOOGLE_ANALYTICS_TEST', $tmp_str_JONY5_TEST, false);
$this->config_add_seo_analytics('LOCALHOST_CHAD_MACBOOKPRO', 'GOOGLE_ANALYTICS', $tmp_str_CHAD_MACBOOKPRO);
$this->config_add_seo_analytics('LOCALHOST_MACBOOKPRO', 'GOOGLE_ANALYTICS', $tmp_str_MACBOOKPRO);