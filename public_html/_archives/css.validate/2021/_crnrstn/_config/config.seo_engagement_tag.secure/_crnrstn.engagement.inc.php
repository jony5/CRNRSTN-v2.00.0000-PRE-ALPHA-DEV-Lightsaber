<?php
# # # # # # # # # # # # # # # # # # # #
# # # # # # # # # # # # # # # # # # # #
# BEGIN INITIALIZATION OF ENVIRONMENTALLY
# RELEVANT RESOURCE WILDCARDS

switch($this->env_cleartext_name){
    case 'BLUEHOST':
    case 'BLUEHOST_GITHUB':

        # # # # #
        ### NEW WILD CARD RESOURCE
        $oWCR = $this->define_wildcard_resource('CRNRSTN::ENGAGEMENT::INTEGRATIONS');


    $tmp_str = '<!-- Global site tag :: EXAMPLE -->
<script>

    //
	// USER ENGAGEMENT TRACKING TAG JS CODE :: HERE
	//
	// E.G. GOOGLE PLACEMENT TAG.
	// https://support.google.com/campaignmanager/answer/2826636?hl=en
	
</script>';

        //
        // CRNRSTN :: WORDPRESS INTEGRATIONS
        $oWCR->add_attribute('CRNRSTN_ENGAGEMENT_TAG_HTML', $tmp_str);

        $oWildCardResource_ARRAY[$oWCR->return_resource_key()] = $oWCR;

    break;
    case 'LOCALHOST_MACBOOKPRO':
    case 'LOCALHOST_MACBOOKTERMINAL':

        # # # # #
        ### NEW WILD CARD RESOURCE
        $oWCR = $this->define_wildcard_resource('CRNRSTN::ENGAGEMENT::INTEGRATIONS');

        $tmp_str = '<!-- LOCALHOST ONLY :: Global site tag :: EXAMPLE -->
<script>

    //
	// USER ENGAGEMENT TRACKING TAG JS CODE :: HERE
	//
	// E.G. GOOGLE PLACEMENT TAG.
	// https://support.google.com/campaignmanager/answer/2826636?hl=enI
	
</script>';

        //
        // CRNRSTN :: WORDPRESS INTEGRATIONS
        $oWCR->add_attribute('CRNRSTN_ENGAGEMENT_TAG_HTML', $tmp_str);

        $oWildCardResource_ARRAY[$oWCR->return_resource_key()] = $oWCR;

    break;
    case 'LOCALHOST_PC':

    break;
    default:

        //
        // HOOOSTON...VE HAF PROBLEM!
        throw new Exception('An unknown...and hence unhandled...environmental reference key,"'.$this->env_cleartext_name.'", has been provided for this environment. WordPress cannot be initialized by CRNRSTN :: without an acknowledged key.');

    break;

}