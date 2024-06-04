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
        $oWCR = $this->define_wildcard_resource('CRNRSTN::WP::INTEGRATIONS');

        //
        // CRNRSTN :: WORDPRESS INTEGRATIONS
        $oWCR->add_attribute('DB_NAME', 'jony5_alpha');
        $oWCR->add_attribute('DB_USER', 'jony5_alpha');
        $oWCR->add_attribute('DB_PASSWORD', '1234567890');
        $oWCR->add_attribute('DB_HOST', 'localhost');
        $oWCR->add_attribute('DB_CHARSET', 'utf8mb4');
        $oWCR->add_attribute('DB_COLLATE', '');

        $oWCR->add_attribute('AUTH_KEY', 'l|L+@=|6 7%7v;;=Q/jJYT+Se @!q(u [0ltJ[veCdb<YPzK>|?zJx+t^2<H-8~|');
        $oWCR->add_attribute('SECURE_AUTH_KEY', ' ++^]X:r%TBjRx1(:[E^3=bm}y+yWShNWQ?A(t7)+U-hKx??~w{0!~S*^]&#LL|3');
        $oWCR->add_attribute('LOGGED_IN_KEY', 'B8JD_D*]YOWF;JMz7uo3_buXjrb+;v+&#x.!VI$ i91+Gwl6C=%wn~&{# ZEB@Oy');
        $oWCR->add_attribute('NONCE_KEY', 'j-nbwnAKE,?Y8AF&Dgy-lW(]%z>dOOw$;5`-n6rdb4`<A#fka~zBWYVED~fi~?:k');
        $oWCR->add_attribute('AUTH_SALT', 'zDO x|b}Pw9u3Z)fk*B#w[?) 4gI-T`[tzgLDBMcd{Yd`MObkzWQyOAUrqn-Oe8m');
        $oWCR->add_attribute('SECURE_AUTH_SALT', 'AsODMnQ8LMPL%^P9T*=^3}iWP!E4@~5K)H5?{S2]r@36CI1VxJ]O%l1b]E^+m%$i');
        $oWCR->add_attribute('LOGGED_IN_SALT', 'g$B0)rZ=quXZFaI8.jef~Vob1Sl+Eo`LIFGPR wXirtv<lBT;D>j+|}-m_we`AJa');
        $oWCR->add_attribute('NONCE_SALT', ')ZOS+k-a<S&?ZAr:J8n;r3 #|n;lpN#|(+=WxB#B10%B|%D-nTZ>Oe^?r$4rK][e');

        $oWCR->add_attribute('TABLE_PREFIX', 'wp00_');
        $oWCR->add_attribute('WP_DEBUG', false);

        $oWildCardResource_ARRAY[$oWCR->return_resource_key()] = $oWCR;

    break;
    case 'LOCALHOST_MACBOOKPRO':
    case 'LOCALHOST_MACBOOKTERMINAL':

        # # # # #
        ### NEW WILD CARD RESOURCE
        $oWCR = $this->define_wildcard_resource('CRNRSTN::WP::INTEGRATIONS');

        //
        // CRNRSTN :: WORDPRESS INTEGRATIONS
        $oWCR->add_attribute('DB_NAME', 'jony5_alpha');
        $oWCR->add_attribute('DB_USER', 'jony5_alpha');
        $oWCR->add_attribute('DB_PASSWORD', 'GBhuLbDnj1dYQ2SR');
        $oWCR->add_attribute('DB_HOST', 'localhost');
        $oWCR->add_attribute('DB_CHARSET', 'utf8mb4');
        $oWCR->add_attribute('DB_COLLATE', '');

        $oWCR->add_attribute('AUTH_KEY', 'l|L+@=|6 7%7v;;=Q/jJYT+Se @!q(u [0ltJ[veCdb<YPzK>|?zJx+t^2<H-8~|');
        $oWCR->add_attribute('SECURE_AUTH_KEY', ' ++^]X:r%TBjRx1(:[E^3=bm}y+yWShNWQ?A(t7)+U-hKx??~w{0!~S*^]&#LL|3');
        $oWCR->add_attribute('LOGGED_IN_KEY', 'B8JD_D*]YOWF;JMz7uo3_buXjrb+;v+&#x.!VI$ i91+Gwl6C=%wn~&{# ZEB@Oy');
        $oWCR->add_attribute('NONCE_KEY', 'j-nbwnAKE,?Y8AF&Dgy-lW(]%z>dOOw$;5`-n6rdb4`<A#fka~zBWYVED~fi~?:k');
        $oWCR->add_attribute('AUTH_SALT', 'zDO x|b}Pw9u3Z)fk*B#w[?) 4gI-T`[tzgLDBMcd{Yd`MObkzWQyOAUrqn-Oe8m');
        $oWCR->add_attribute('SECURE_AUTH_SALT', 'AsODMnQ8LMPL%^P9T*=^3}iWP!E4@~5K)H5?{S2]r@36CI1VxJ]O%l1b]E^+m%$i');
        $oWCR->add_attribute('LOGGED_IN_SALT', 'g$B0)rZ=quXZFaI8.jef~Vob1Sl+Eo`LIFGPR wXirtv<lBT;D>j+|}-m_we`AJa');
        $oWCR->add_attribute('NONCE_SALT', ')ZOS+k-a<S&?ZAr:J8n;r3 #|n;lpN#|(+=WxB#B10%B|%D-nTZ>Oe^?r$4rK][e');

        $oWCR->add_attribute('TABLE_PREFIX', 'wp00_');
        $oWCR->add_attribute('WP_DEBUG', false);

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