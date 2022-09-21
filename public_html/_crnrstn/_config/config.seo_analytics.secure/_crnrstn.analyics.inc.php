<?php
# # # # # # # # # # # # # # # # # # # #
# # # # # # # # # # # # # # # # # # # #
# BEGIN INITIALIZATION OF ENVIRONMENTALLY
# RELEVANT RESOURCE WILDCARDS

switch($this->env_key){
    case 'BLUEHOST':
    case 'BLUEHOST_GITHUB':

        # # # # #
        ### NEW WILD CARD RESOURCE
        $oWCR = $this->define_wildcard_resource('CRNRSTN::ANALYTICS::INTEGRATIONS');

        $tmp_str = '<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-2181418-32"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag(\'js\', new Date());

    gtag(\'config\', \'UA-2181418-32\');
</script>
';

        //
        // CRNRSTN :: WORDPRESS INTEGRATIONS
        $oWCR->add_attribute('CRNRSTN_ANALYTICS_SEO_HTML', $tmp_str);

        $oWildCardResource_ARRAY[$oWCR->return_resource_key()] = $oWCR;

    break;
    case 'LOCALHOST_MACBOOKPRO':
    case 'LOCALHOST_CHAD_MACBOOKPRO':

        # # # # #
        ### NEW WILD CARD RESOURCE
        $oWCR = $this->define_wildcard_resource('CRNRSTN::ANALYTICS::INTEGRATIONS');

    $tmp_str = ' <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-2181418-32"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag(\'js\', new Date());

    gtag(\'config\', \'UA-2181418-32\');
</script>
';

        //
        // CRNRSTN :: WORDPRESS INTEGRATIONS
        $oWCR->add_attribute('CRNRSTN_ANALYTICS_SEO_HTML', $tmp_str);

        $oWildCardResource_ARRAY[$oWCR->return_resource_key()] = $oWCR;

    break;
    case 'LOCALHOST_PC':

    break;
    default:

        //
        // HOOOSTON...VE HAF PROBLEM!
        throw new Exception('An unknown...and hence unhandled...environmental reference key,"' . $this->env_key . '", has been provided for this environment. WordPress cannot be initialized by CRNRSTN :: without an acknowledged key.');

    break;

}