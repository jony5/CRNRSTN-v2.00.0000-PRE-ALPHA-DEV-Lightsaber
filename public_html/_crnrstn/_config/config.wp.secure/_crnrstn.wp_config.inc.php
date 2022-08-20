<?php
# # # # # # # # # # # # # # # # # # # #
# # # # # # # # # # # # # # # # # # # #
# BEGIN INITIALIZATION OF ENVIRONMENTALLY
# RELEVANT RESOURCE WILDCARDS

switch($this->env_key){
    case 'BLUEHOST':
    case 'BLUEHOST_WWW':

        # # # # #
        ### NEW WILD CARD RESOURCE
        $oWCR = $this->define_wildcard_resource('CRNRSTN::WP::INTEGRATIONS');

        //
        // CRNRSTN :: WORDPRESS INTEGRATIONS
        $oWCR->add_attribute('DB_NAME', 'jony5_prod123');
        $oWCR->add_attribute('DB_USER', 'jony5_prod123');
        $oWCR->add_attribute('DB_PASSWORD', 'password123456789');
        $oWCR->add_attribute('DB_HOST', 'localhost');
        $oWCR->add_attribute('DB_CHARSET', 'utf8mb4');
        $oWCR->add_attribute('DB_COLLATE', '');

        $oWCR->add_attribute('AUTH_KEY', '7>gp}1Gayh}4gs&-2hq.O_[ktI$I*Lk]c,%*o7h3)8$`%LFY<>?rSmWE5GAZn}F.');
        $oWCR->add_attribute('SECURE_AUTH_KEY', 't<.{U.3~Fx9N,PX9RD# [4hIrKKI(g<zT19@(c4olb{PCi-#u5[v*slm,0sz1N^$');
        $oWCR->add_attribute('LOGGED_IN_KEY', 'BP H6dTa5_4VqhCZ::=8_=8CIHQUMu.@^jK9]|+9C!-G*o{wA[KpqWx9llz[dnV%');
        $oWCR->add_attribute('NONCE_KEY', '9:wk+}K87_jZ%_CI%qpo7q;_N<eWXWB?!pVGXTiq3]}|MIH~~p+p<W*G<Y0yn3I(');
        $oWCR->add_attribute('AUTH_SALT', 'Z04xtYL+)tvK F J11?xMC1OoKF<3lOF<{V<_?_SAPH*=(}GE#K8ScW0yzr(A/0C');
        $oWCR->add_attribute('SECURE_AUTH_SALT', ':3kIR3]vvUUKtgUc5s7%x1zE5I_XO->$e/LYN(Xt!:nto*&aCj|bK)OZ<2oxj1+p');
        $oWCR->add_attribute('LOGGED_IN_SALT', 'gO.)&}{)^B]K~<ZVV n-U)ZwuR`0PNx@S&;NyQ8,6#:gcgMO8x,J%gU+<kyZI}<b');
        $oWCR->add_attribute('NONCE_SALT', '1 Y/-q)$>_sVy[rA+K(3LB70yj(MBD&~N|7M$/*eFUT9>zowd>7@_GqwI4)b[b$q');

        $oWCR->add_attribute('TABLE_PREFIX', 'wp01_');
        $oWCR->add_attribute('WP_DEBUG', false);

        $oWildCardResource_ARRAY[$oWCR->return_resource_key()] = $oWCR;

    break;
    case 'LOCALHOST_MACBOOKPRO':
    case 'LOCALHOST_CHAD_MACBOOKPRO':

        # # # # #
        ### NEW WILD CARD RESOURCE
        $oWCR = $this->define_wildcard_resource('CRNRSTN::WP::INTEGRATIONS');

        //
        // CRNRSTN :: WORDPRESS INTEGRATIONS
        $oWCR->add_attribute('DB_NAME', 'jony5_stage');
        $oWCR->add_attribute('DB_USER', 'jony5_stage');
        $oWCR->add_attribute('DB_PASSWORD', 'aXNTPxGPeLRwYzTS');
        $oWCR->add_attribute('DB_HOST', 'localhost');
        $oWCR->add_attribute('DB_CHARSET', 'utf8mb4');
        $oWCR->add_attribute('DB_COLLATE', '');

        $oWCR->add_attribute('AUTH_KEY', '7>gp}1Gayh}4gs&-2hq.O_[ktI$I*Lk]c,%*o7h3)8$`%LFY<>?rSmWE5GAZn}F.');
        $oWCR->add_attribute('SECURE_AUTH_KEY', 't<.{U.3~Fx9N,PX9RD# [4hIrKKI(g<zT19@(c4olb{PCi-#u5[v*slm,0sz1N^$');
        $oWCR->add_attribute('LOGGED_IN_KEY', 'BP H6dTa5_4VqhCZ::=8_=8CIHQUMu.@^jK9]|+9C!-G*o{wA[KpqWx9llz[dnV%');
        $oWCR->add_attribute('NONCE_KEY', '9:wk+}K87_jZ%_CI%qpo7q;_N<eWXWB?!pVGXTiq3]}|MIH~~p+p<W*G<Y0yn3I(');
        $oWCR->add_attribute('AUTH_SALT', 'Z04xtYL+)tvK F J11?xMC1OoKF<3lOF<{V<_?_SAPH*=(}GE#K8ScW0yzr(A/0C');
        $oWCR->add_attribute('SECURE_AUTH_SALT', ':3kIR3]vvUUKtgUc5s7%x1zE5I_XO->$e/LYN(Xt!:nto*&aCj|bK)OZ<2oxj1+p');
        $oWCR->add_attribute('LOGGED_IN_SALT', 'gO.)&}{)^B]K~<ZVV n-U)ZwuR`0PNx@S&;NyQ8,6#:gcgMO8x,J%gU+<kyZI}<b');
        $oWCR->add_attribute('NONCE_SALT', '1 Y/-q)$>_sVy[rA+K(3LB70yj(MBD&~N|7M$/*eFUT9>zowd>7@_GqwI4)b[b$q');

        $oWCR->add_attribute('TABLE_PREFIX', 'wp01_');
        $oWCR->add_attribute('WP_DEBUG', false);

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