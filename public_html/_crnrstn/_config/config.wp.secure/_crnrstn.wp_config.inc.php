<?php
//
// INITIALIZE WORDPRESS CONFIGURATION PROFILES FOR EACH ENVIRONMENT.
# # # # #
### NEW WORDPRESS CONFIG
### CRNRSTN :: WORDPRESS INTEGRATIONS
//$this->add_data_wp('BLUEHOST', 'DB_NAME', 'jony5_prod123', 'MY 2nd most Favorite of WORDPRESS Blog!');
$this->add_data_wp('BLUEHOST', 'DB_NAME', 'jony5_prod123', 'CRNRSTN::WP::INTEGRATIONS');
$this->add_data_wp('BLUEHOST', 'DB_USER', 'jony5_prod123');
$this->add_data_wp('BLUEHOST', 'DB_PASSWORD', 'password123456789');
$this->add_data_wp('BLUEHOST', 'DB_HOST', 'localhost');

# # # # #
### NEW WORDPRESS CONFIG
### CRNRSTN :: WORDPRESS INTEGRATIONS
$this->add_data_wp('BLUEHOST_WWW', 'DB_NAME', 'jony5_prod123');
$this->add_data_wp('BLUEHOST_WWW', 'DB_USER', 'jony5_prod123');
$this->add_data_wp('BLUEHOST_WWW', 'DB_PASSWORD', 'password123456789');
$this->add_data_wp('BLUEHOST_WWW', 'DB_HOST', 'localhost');

# # # # #
### NEW WORDPRESS CONFIG
### CRNRSTN :: WORDPRESS INTEGRATIONS
$this->add_data_wp('LOCALHOST_MACBOOKPRO', 'DB_NAME', 'jony5_stage');
$this->add_data_wp('LOCALHOST_MACBOOKPRO', 'DB_USER', 'jony5_stage');
$this->add_data_wp('LOCALHOST_MACBOOKPRO', 'DB_PASSWORD', 'aXNTPxGPeLRwYzTS');
$this->add_data_wp('LOCALHOST_MACBOOKPRO', 'DB_HOST', 'localhost');

# # # # #
### NEW WORDPRESS CONFIG
### CRNRSTN :: WORDPRESS INTEGRATIONS
$this->add_data_wp('LOCALHOST_CHAD_MACBOOKPRO', 'DB_NAME', 'jony5_stage');
$this->add_data_wp('LOCALHOST_CHAD_MACBOOKPRO', 'DB_USER', 'jony5_stage');
$this->add_data_wp('LOCALHOST_CHAD_MACBOOKPRO', 'DB_PASSWORD', 'aXNTPxGPeLRwYzTS');
$this->add_data_wp('LOCALHOST_CHAD_MACBOOKPRO', 'DB_HOST', 'localhost');

# # # # #
### WORDPRESS CONFIG SHARED IN COMMON
### CRNRSTN :: WORDPRESS INTEGRATIONS
$this->add_data_wp(CRNRSTN_RESOURCE_ALL, 'DB_CHARSET', 'utf8mb4');
$this->add_data_wp(CRNRSTN_RESOURCE_ALL, 'DB_COLLATE', '');
$this->add_data_wp(CRNRSTN_RESOURCE_ALL, 'AUTH_KEY', '7>gp}1Gayh}4gs&-2hq.O_[ktI$I*Lk]c,%*o7h3)8$`%LFY<>?rSmWE5GAZn}F.');
$this->add_data_wp(CRNRSTN_RESOURCE_ALL, 'SECURE_AUTH_KEY', 't<.{U.3~Fx9N,PX9RD# [4hIrKKI(g<zT19@(c4olb{PCi-#u5[v*slm,0sz1N^$');
$this->add_data_wp(CRNRSTN_RESOURCE_ALL, 'LOGGED_IN_KEY', 'BP H6dTa5_4VqhCZ::=8_=8CIHQUMu.@^jK9]|+9C!-G*o{wA[KpqWx9llz[dnV%');
$this->add_data_wp(CRNRSTN_RESOURCE_ALL, 'NONCE_KEY', '9:wk+}K87_jZ%_CI%qpo7q;_N<eWXWB?!pVGXTiq3]}|MIH~~p+p<W*G<Y0yn3I(');
$this->add_data_wp(CRNRSTN_RESOURCE_ALL, 'AUTH_SALT', 'Z04xtYL+)tvK F J11?xMC1OoKF<3lOF<{V<_?_SAPH*=(}GE#K8ScW0yzr(A/0C');
$this->add_data_wp(CRNRSTN_RESOURCE_ALL, 'SECURE_AUTH_SALT', ':3kIR3]vvUUKtgUc5s7%x1zE5I_XO->$e/LYN(Xt!:nto*&aCj|bK)OZ<2oxj1+p');
$this->add_data_wp(CRNRSTN_RESOURCE_ALL, 'LOGGED_IN_SALT', 'gO.)&}{)^B]K~<ZVV n-U)ZwuR`0PNx@S&;NyQ8,6#:gcgMO8x,J%gU+<kyZI}<b');
$this->add_data_wp(CRNRSTN_RESOURCE_ALL, 'NONCE_SALT', '1 Y/-q)$>_sVy[rA+K(3LB70yj(MBD&~N|7M$/*eFUT9>zowd>7@_GqwI4)b[b$q');
$this->add_data_wp(CRNRSTN_RESOURCE_ALL, 'TABLE_PREFIX', 'wp01_');
$this->add_data_wp(CRNRSTN_RESOURCE_ALL, 'WP_DEBUG', false);

// case 'LOCALHOST_PC':