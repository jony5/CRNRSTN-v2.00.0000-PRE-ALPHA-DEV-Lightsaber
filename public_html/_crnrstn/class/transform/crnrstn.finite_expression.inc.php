<?php
/*
// J5
// Code is Poetry */
#
#  CRNRSTN ::
#  VERSION :: 2.00.0000 PRE-ALPHA-DEV
#  DATE (v1.0.0) :: July 4, 2018 - Happy Independence Day from my dog and I to you...wherever and whenever you are.
#  AUTHOR :: Jonathan 'J5' Harris, Lead Full Stack Developer
#  URI :: http://crnrstn.evifweb.com/
#  DESCRIPTION :: CRNRSTN :: An Open Source PHP Class Library providing a robust services interface layer to both
#       facilitate, augment, and enhance the operations of code base for an application across multiple hosting
#       environments. Copyright (C) 2012-2021 eVifweb development.
#  OVERVIEW :: CRNRSTN :: is an open source PHP class library that facilitates the operation of an application within
#       multiple server environments (e.g. localhost, stage, preprod, and production). With this tool, data and
#       functionality with characteristics that inherently create distinctions from one environment to the next...such
#       as IP address restrictions, error logging profiles, and database authentication credentials...can all be
#       managed through one framework for an entire application. Once CRNRSTN :: has been configured for your different
#       hosting environments, seamlessly release a web application from one environment to the next without having to
#       change your code-base to account for environmentally specific parameters. Receive the benefit of a robust and
#       polished framework for bubbling up exception notifications through any output of your choosing. Take advantage
#       of the CRNRSTN :: SOAP Services layer supporting many to 1 proxy messaging relationships between slave and
#       master servers; regarding server communications i.e. notifications, some architectures will depend on one
#       master to support the communications needs of many slaves with respect their roles and responsibilities in
#       regards to sending an email. With CRNRSTN ::, slaves configured to log exceptions via EMAIL_PROXY will send
#       all of their internal system notifications to one master server (proxy) which server would posses the (if
#       necessary) SMTP credentials for authorization to access and execute more restricted communications
#       protocols of the network.
#  LICENSE :: MIT
#       Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated
#       documentation files (the "Software"), to deal in the Software without restriction, including without limitation
#       the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software,
#       and to permit persons to whom the Software is furnished to do so, subject to the following conditions:
#
#       The above copyright notice and this permission notice shall be included in all copies or substantial portions
#       of the Software.
#
#       THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED
#       TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL
#       THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF
#       CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER
#       DEALINGS IN THE SOFTWARE.
#
# # C # R # N # R # S # T # N # : : # # # #
#
#  CLASS :: crnrstn_finite_expression
#  VERSION :: 1.00.0000
#  DATE :: July 4, 2020 @ 1620hrs
#  AUTHOR :: Jonathan 'J5' Harris, jharris@eVifweb.com
#  URI :: 
#  DESCRIPTION :: Talking about time.
#  LICENSE :: MIT | http://crnrstn.evifweb.com/licensing/
#
//
// I'M NOT SUPER STOKED ABOUT THE CLASS NAME...BUT WE WILL CONTINUE.
// IF I CAN FIND SOME APPROPRIATE AND SCRIPTURALLY RELATED ELEMENT TO
// REPRESENT OR EMBODY THIS DATE/TIME THING, I'LL DO IT (sans_eternity, crnrstn_finite_expression).
// - "KIVOTOS" AND "STREAM" ARE EXCELLENT AND APPROPRIATE EXAMPLES OF
// THIS IN ACTION. JESUS CHRIST ON THE EARTH WAS GOD INFINITE EXPRESSED
// IN MAN-FINITE. JESUS ON EARTH WAS THE FINITE EXPRESSION OF THE ALMIGHTY
// GOD THE CREATOR OF THE HEAVENS AND THE EARTH IN SPACE AND IN TIME AND
// HE IS REPRODUCING HIMSELF IN US TODAY.
#
class crnrstn_finite_expression {

    private static $lang_content_ARRAY = array();

    public function __construct(){

        $this->initialize_language();

    }

     public function config_load_static_application_data($data_type){

        switch($data_type){
            case 'timezone_syntax_ARRAY':
                // Monday, November 20, 2023 @ 0446 hrs.

                return array(
                'africa/abidjan' => 'africa/abidjan', 'africa/accra' => 'africa/accra', 'africa/addis_ababa' => 'africa/addis_ababa',
                'africa/algiers' => 'africa/algiers', 'africa/asmara' => 'africa/asmara', 'africa/bamako' => 'africa/bamako',
                'africa/bangui' => 'africa/bangui', 'africa/banjul' => 'africa/banjul', 'africa/bissau' => 'africa/bissau',
                'africa/blantyre' => 'africa/blantyre', 'africa/brazzaville' => 'africa/brazzaville', 'africa/bujumbura' => 'africa/bujumbura',
                'africa/cairo' => 'africa/cairo', 'africa/casablanca' => 'africa/casablanca', 'africa/ceuta' => 'africa/ceuta',
                'africa/conakry' => 'africa/conakry', 'africa/dakar' => 'africa/dakar', 'africa/dar_es_salaam' => 'africa/dar_es_salaam',
                'africa/djibouti' => 'africa/djibouti', 'africa/douala' => 'africa/douala', 'africa/el_aaiun' => 'africa/el_aaiun',
                'africa/freetown' => 'africa/freetown', 'africa/gaborone' => 'africa/gaborone', 'africa/harare' => 'africa/harare',
                'africa/johannesburg' => 'africa/johannesburg', 'africa/juba' => 'africa/juba', 'africa/kampala' => 'africa/kampala',
                'africa/khartoum' => 'africa/khartoum', 'africa/kigali' => 'africa/kigali', 'africa/kinshasa' => 'africa/kinshasa',
                'africa/lagos' => 'africa/lagos', 'africa/libreville' => 'africa/libreville', 'africa/lome' => 'africa/lome',
                'africa/luanda' => 'africa/luanda', 'africa/lubumbashi' => 'africa/lubumbashi', 'africa/lusaka' => 'africa/lusaka',
                'africa/malabo' => 'africa/malabo', 'africa/maputo' => 'africa/maputo', 'africa/maseru' => 'africa/maseru',
                'africa/mbabane' => 'africa/mbabane', 'africa/mogadishu' => 'africa/mogadishu', 'africa/monrovia' => 'africa/monrovia',
                'africa/nairobi' => 'africa/nairobi', 'africa/ndjamena' => 'africa/ndjamena', 'africa/niamey' => 'africa/niamey',
                'africa/nouakchott' => 'africa/nouakchott', 'africa/ouagadougou' => 'africa/ouagadougou', 'africa/porto-novo' => 'africa/porto-novo',
                'africa/sao_tome' => 'africa/sao_tome', 'africa/tripoli' => 'africa/tripoli', 'africa/tunis' => 'africa/tunis',
                'africa/windhoek' => 'africa/windhoek', 'america/adak' => 'america/adak', 'america/anchorage' => 'america/anchorage',
                'america/anguilla' => 'america/anguilla', 'america/antigua' => 'america/antigua', 'america/araguaina' => 'america/araguaina',
                'america/argentina/buenos_aires' => 'america/argentina/buenos_aires', 'america/argentina/catamarca' => 'america/argentina/catamarca',
                'america/argentina/cordoba' => 'america/argentina/cordoba', 'america/argentina/jujuy' => 'america/argentina/jujuy',
                'america/argentina/la_rioja' => 'america/argentina/la_rioja', 'america/argentina/mendoza' => 'america/argentina/mendoza',
                'america/argentina/rio_gallegos' => 'america/argentina/rio_gallegos', 'america/argentina/salta' => 'america/argentina/salta',
                'america/argentina/san_juan' => 'america/argentina/san_juan', 'america/argentina/san_luis' => 'america/argentina/san_luis',
                'america/argentina/tucuman' => 'america/argentina/tucuman', 'america/argentina/ushuaia' => 'america/argentina/ushuaia',
                'america/aruba' => 'america/aruba', 'america/asuncion' => 'america/asuncion', 'america/atikokan' => 'america/atikokan',
                'america/bahia' => 'america/bahia', 'america/bahia_banderas' => 'america/bahia_banderas', 'america/barbados' => 'america/barbados',
                'america/belem' => 'america/belem', 'america/belize' => 'america/belize', 'america/blanc-sablon' => 'america/blanc-sablon',
                'america/boa_vista' => 'america/boa_vista', 'america/bogota' => 'america/bogota', 'america/boise' => 'america/boise',
                'america/cambridge_bay' => 'america/cambridge_bay', 'america/campo_grande' => 'america/campo_grande', 'america/cancun' => 'america/cancun',
                'america/caracas' => 'america/caracas', 'america/cayenne' => 'america/cayenne', 'america/cayman' => 'america/cayman',
                'america/chicago' => 'america/chicago', 'america/chihuahua' => 'america/chihuahua', 'america/ciudad_juarez' => 'america/ciudad_juarez',
                'america/costa_rica' => 'america/costa_rica', 'america/creston' => 'america/creston', 'america/cuiaba' => 'america/cuiaba',
                'america/curacao' => 'america/curacao', 'america/danmarkshavn' => 'america/danmarkshavn', 'america/dawson' => 'america/dawson',
                'america/dawson_creek' => 'america/dawson_creek', 'america/denver' => 'america/denver', 'america/detroit' => 'america/detroit',
                'america/dominica' => 'america/dominica', 'america/edmonton' => 'america/edmonton', 'america/eirunepe' => 'america/eirunepe',
                'america/el_salvador' => 'america/el_salvador', 'america/fort_nelson' => 'america/fort_nelson', 'america/fortaleza' => 'america/fortaleza',
                'america/glace_bay' => 'america/glace_bay', 'america/goose_bay' => 'america/goose_bay', 'america/grand_turk' => 'america/grand_turk',
                'america/grenada' => 'america/grenada', 'america/guadeloupe' => 'america/guadeloupe', 'america/guatemala' => 'america/guatemala',
                'america/guayaquil' => 'america/guayaquil', 'america/guyana' => 'america/guyana', 'america/halifax' => 'america/halifax',
                'america/havana' => 'america/havana', 'america/hermosillo' => 'america/hermosillo', 'america/indiana/indianapolis' => 'america/indiana/indianapolis',
                'america/indiana/knox' => 'america/indiana/knox', 'america/indiana/marengo' => 'america/indiana/marengo',
                'america/indiana/petersburg' => 'america/indiana/petersburg', 'america/indiana/tell_city' => 'america/indiana/tell_city',
                'america/indiana/vevay' => 'america/indiana/vevay', 'america/indiana/vincennes' => 'america/indiana/vincennes',
                'america/indiana/winamac' => 'america/indiana/winamac', 'america/inuvik' => 'america/inuvik', 'america/iqaluit' => 'america/iqaluit',
                'america/jamaica' => 'america/jamaica', 'america/juneau' => 'america/juneau', 'america/kentucky/louisville' => 'america/kentucky/louisville',
                'america/kentucky/monticello' => 'america/kentucky/monticello', 'america/kralendijk' => 'america/kralendijk',
                'america/la_paz' => 'america/la_paz', 'america/lima' => 'america/lima', 'america/los_angeles' => 'america/los_angeles',
                'america/lower_princes' => 'america/lower_princes', 'america/maceio' => 'america/maceio', 'america/managua' => 'america/managua',
                'america/manaus' => 'america/manaus', 'america/marigot' => 'america/marigot', 'america/martinique' => 'america/martinique',
                'america/matamoros' => 'america/matamoros', 'america/mazatlan' => 'america/mazatlan', 'america/menominee' => 'america/menominee',
                'america/merida' => 'america/merida', 'america/metlakatla' => 'america/metlakatla', 'america/mexico_city' => 'america/mexico_city',
                'america/miquelon' => 'america/miquelon', 'america/moncton' => 'america/moncton', 'america/monterrey' => 'america/monterrey',
                'america/montevideo' => 'america/montevideo', 'america/montserrat' => 'america/montserrat', 'america/nassau' => 'america/nassau',
                'america/new_york' => 'america/new_york', 'america/nome' => 'america/nome', 'america/noronha' => 'america/noronha',
                'america/north_dakota/beulah' => 'america/north_dakota/beulah', 'america/north_dakota/center' => 'america/north_dakota/center',
                'america/north_dakota/new_salem' => 'america/north_dakota/new_salem', 'america/nuuk' => 'america/nuuk', 'america/ojinaga' => 'america/ojinaga',
                'america/panama' => 'america/panama', 'america/paramaribo' => 'america/paramaribo', 'america/phoenix' => 'america/phoenix',
                'america/port-au-prince' => 'america/port-au-prince', 'america/port_of_spain' => 'america/port_of_spain',
                'america/porto_velho' => 'america/porto_velho', 'america/puerto_rico' => 'america/puerto_rico', 'america/punta_arenas' => 'america/punta_arenas',
                'america/rankin_inlet' => 'america/rankin_inlet', 'america/recife' => 'america/recife', 'america/regina' => 'america/regina',
                'america/resolute' => 'america/resolute', 'america/rio_branco' => 'america/rio_branco', 'america/santarem' => 'america/santarem',
                'america/santiago' => 'america/santiago', 'america/santo_domingo' => 'america/santo_domingo', 'america/sao_paulo' => 'america/sao_paulo',
                'america/scoresbysund' => 'america/scoresbysund', 'america/sitka' => 'america/sitka', 'america/st_barthelemy' => 'america/st_barthelemy',
                'america/st_johns' => 'america/st_johns', 'america/st_kitts' => 'america/st_kitts', 'america/st_lucia' => 'america/st_lucia',
                'america/st_thomas' => 'america/st_thomas', 'america/st_vincent' => 'america/st_vincent', 'america/swift_current' => 'america/swift_current',
                'america/tegucigalpa' => 'america/tegucigalpa', 'america/thule' => 'america/thule', 'america/tijuana' => 'america/tijuana',
                'america/toronto' => 'america/toronto', 'america/tortola' => 'america/tortola', 'america/vancouver' => 'america/vancouver',
                'america/whitehorse' => 'america/whitehorse', 'america/winnipeg' => 'america/winnipeg', 'america/yakutat' => 'america/yakutat',
                'antarctica/casey' => 'antarctica/casey', 'antarctica/davis' => 'antarctica/davis', 'antarctica/dumontdurville' => 'antarctica/dumontdurville',
                'antarctica/macquarie' => 'antarctica/macquarie', 'antarctica/mawson' => 'antarctica/mawson', 'antarctica/mcmurdo' => 'antarctica/mcmurdo',
                'antarctica/palmer' => 'antarctica/palmer', 'antarctica/rothera' => 'antarctica/rothera', 'antarctica/syowa' => 'antarctica/syowa',
                'antarctica/troll' => 'antarctica/troll', 'antarctica/vostok' => 'antarctica/vostok', 'arctic/longyearbyen' => 'arctic/longyearbyen',
                'asia/aden' => 'asia/aden', 'asia/almaty' => 'asia/almaty', 'asia/amman' => 'asia/amman', 'asia/anadyr' => 'asia/anadyr',
                'asia/aqtau' => 'asia/aqtau', 'asia/aqtobe' => 'asia/aqtobe', 'asia/ashgabat' => 'asia/ashgabat', 'asia/atyrau' => 'asia/atyrau',
                'asia/baghdad' => 'asia/baghdad', 'asia/bahrain' => 'asia/bahrain', 'asia/baku' => 'asia/baku', 'asia/bangkok' => 'asia/bangkok',
                'asia/barnaul' => 'asia/barnaul', 'asia/beirut' => 'asia/beirut', 'asia/bishkek' => 'asia/bishkek', 'asia/brunei' => 'asia/brunei',
                'asia/chita' => 'asia/chita', 'asia/choibalsan' => 'asia/choibalsan', 'asia/colombo' => 'asia/colombo', 'asia/damascus' => 'asia/damascus',
                'asia/dhaka' => 'asia/dhaka', 'asia/dili' => 'asia/dili', 'asia/dubai' => 'asia/dubai', 'asia/dushanbe' => 'asia/dushanbe',
                'asia/famagusta' => 'asia/famagusta', 'asia/gaza' => 'asia/gaza', 'asia/hebron' => 'asia/hebron', 'asia/ho_chi_minh' => 'asia/ho_chi_minh',
                'asia/hong_kong' => 'asia/hong_kong', 'asia/hovd' => 'asia/hovd', 'asia/irkutsk' => 'asia/irkutsk', 'asia/jakarta' => 'asia/jakarta',
                'asia/jayapura' => 'asia/jayapura', 'asia/jerusalem' => 'asia/jerusalem', 'asia/kabul' => 'asia/kabul', 'asia/kamchatka' => 'asia/kamchatka',
                'asia/karachi' => 'asia/karachi', 'asia/kathmandu' => 'asia/kathmandu', 'asia/khandyga' => 'asia/khandyga', 'asia/kolkata' => 'asia/kolkata',
                'asia/krasnoyarsk' => 'asia/krasnoyarsk', 'asia/kuala_lumpur' => 'asia/kuala_lumpur', 'asia/kuching' => 'asia/kuching',
                'asia/kuwait' => 'asia/kuwait', 'asia/macau' => 'asia/macau', 'asia/magadan' => 'asia/magadan', 'asia/makassar' => 'asia/makassar',
                'asia/manila' => 'asia/manila', 'asia/muscat' => 'asia/muscat', 'asia/nicosia' => 'asia/nicosia', 'asia/novokuznetsk' => 'asia/novokuznetsk',
                'asia/novosibirsk' => 'asia/novosibirsk', 'asia/omsk' => 'asia/omsk', 'asia/oral' => 'asia/oral', 'asia/phnom_penh' => 'asia/phnom_penh',
                'asia/pontianak' => 'asia/pontianak', 'asia/pyongyang' => 'asia/pyongyang', 'asia/qatar' => 'asia/qatar', 'asia/qostanay' => 'asia/qostanay',
                'asia/qyzylorda' => 'asia/qyzylorda', 'asia/riyadh' => 'asia/riyadh', 'asia/sakhalin' => 'asia/sakhalin', 'asia/samarkand' => 'asia/samarkand',
                'asia/seoul' => 'asia/seoul', 'asia/shanghai' => 'asia/shanghai', 'asia/singapore' => 'asia/singapore', 'asia/srednekolymsk' => 'asia/srednekolymsk',
                'asia/taipei' => 'asia/taipei', 'asia/tashkent' => 'asia/tashkent', 'asia/tbilisi' => 'asia/tbilisi', 'asia/tehran' => 'asia/tehran',
                'asia/thimphu' => 'asia/thimphu', 'asia/tokyo' => 'asia/tokyo', 'asia/tomsk' => 'asia/tomsk', 'asia/ulaanbaatar' => 'asia/ulaanbaatar',
                'asia/urumqi' => 'asia/urumqi', 'asia/ust-nera' => 'asia/ust-nera', 'asia/vientiane' => 'asia/vientiane', 'asia/vladivostok' => 'asia/vladivostok',
                'asia/yakutsk' => 'asia/yakutsk', 'asia/yangon' => 'asia/yangon', 'asia/yekaterinburg' => 'asia/yekaterinburg',
                'asia/yerevan' => 'asia/yerevan', 'atlantic/azores' => 'atlantic/azores', 'atlantic/bermuda' => 'atlantic/bermuda',
                'atlantic/canary' => 'atlantic/canary', 'atlantic/cape_verde' => 'atlantic/cape_verde', 'atlantic/faroe' => 'atlantic/faroe',
                'atlantic/madeira' => 'atlantic/madeira', 'atlantic/reykjavik' => 'atlantic/reykjavik', 'atlantic/south_georgia' => 'atlantic/south_georgia',
                'atlantic/st_helena' => 'atlantic/st_helena', 'atlantic/stanley' => 'atlantic/stanley', 'australia/adelaide' => 'australia/adelaide',
                'australia/brisbane' => 'australia/brisbane', 'australia/broken_hill' => 'australia/broken_hill', 'australia/darwin' => 'australia/darwin',
                'australia/eucla' => 'australia/eucla', 'australia/hobart' => 'australia/hobart', 'australia/lindeman' => 'australia/lindeman',
                'australia/lord_howe' => 'australia/lord_howe', 'australia/melbourne' => 'australia/melbourne', 'australia/perth' => 'australia/perth',
                'australia/sydney' => 'australia/sydney', 'europe/amsterdam' => 'europe/amsterdam', 'europe/andorra' => 'europe/andorra',
                'europe/astrakhan' => 'europe/astrakhan', 'europe/athens' => 'europe/athens', 'europe/belgrade' => 'europe/belgrade',
                'europe/berlin' => 'europe/berlin', 'europe/bratislava' => 'europe/bratislava', 'europe/brussels' => 'europe/brussels',
                'europe/bucharest' => 'europe/bucharest', 'europe/budapest' => 'europe/budapest', 'europe/busingen' => 'europe/busingen',
                'europe/chisinau' => 'europe/chisinau', 'europe/copenhagen' => 'europe/copenhagen', 'europe/dublin' => 'europe/dublin',
                'europe/gibraltar' => 'europe/gibraltar', 'europe/guernsey' => 'europe/guernsey', 'europe/helsinki' => 'europe/helsinki',
                'europe/isle_of_man' => 'europe/isle_of_man', 'europe/istanbul' => 'europe/istanbul', 'europe/jersey' => 'europe/jersey',
                'europe/kaliningrad' => 'europe/kaliningrad', 'europe/kirov' => 'europe/kirov', 'europe/kyiv' => 'europe/kyiv',
                'europe/lisbon' => 'europe/lisbon', 'europe/ljubljana' => 'europe/ljubljana', 'europe/london' => 'europe/london',
                'europe/luxembourg' => 'europe/luxembourg', 'europe/madrid' => 'europe/madrid', 'europe/malta' => 'europe/malta',
                'europe/mariehamn' => 'europe/mariehamn', 'europe/minsk' => 'europe/minsk', 'europe/monaco' => 'europe/monaco',
                'europe/moscow' => 'europe/moscow', 'europe/oslo' => 'europe/oslo', 'europe/paris' => 'europe/paris', 'europe/podgorica' => 'europe/podgorica',
                'europe/prague' => 'europe/prague', 'europe/riga' => 'europe/riga', 'europe/rome' => 'europe/rome', 'europe/samara' => 'europe/samara',
                'europe/san_marino' => 'europe/san_marino', 'europe/sarajevo' => 'europe/sarajevo', 'europe/saratov' => 'europe/saratov',
                'europe/simferopol' => 'europe/simferopol', 'europe/skopje' => 'europe/skopje', 'europe/sofia' => 'europe/sofia',
                'europe/stockholm' => 'europe/stockholm', 'europe/tallinn' => 'europe/tallinn', 'europe/tirane' => 'europe/tirane',
                'europe/ulyanovsk' => 'europe/ulyanovsk', 'europe/vaduz' => 'europe/vaduz', 'europe/vatican' => 'europe/vatican',
                'europe/vienna' => 'europe/vienna', 'europe/vilnius' => 'europe/vilnius', 'europe/volgograd' => 'europe/volgograd',
                'europe/warsaw' => 'europe/warsaw', 'europe/zagreb' => 'europe/zagreb', 'europe/zurich' => 'europe/zurich',
                'indian/antananarivo' => 'indian/antananarivo', 'indian/chagos' => 'indian/chagos', 'indian/christmas' => 'indian/christmas',
                'indian/cocos' => 'indian/cocos', 'indian/comoro' => 'indian/comoro', 'indian/kerguelen' => 'indian/kerguelen',
                'indian/mahe' => 'indian/mahe', 'indian/maldives' => 'indian/maldives', 'indian/mauritius' => 'indian/mauritius',
                'indian/mayotte' => 'indian/mayotte', 'indian/reunion' => 'indian/reunion', 'pacific/apia' => 'pacific/apia',
                'pacific/auckland' => 'pacific/auckland', 'pacific/bougainville' => 'pacific/bougainville', 'pacific/chatham' => 'pacific/chatham',
                'pacific/chuuk' => 'pacific/chuuk', 'pacific/easter' => 'pacific/easter', 'pacific/efate' => 'pacific/efate',
                'pacific/fakaofo' => 'pacific/fakaofo', 'pacific/fiji' => 'pacific/fiji', 'pacific/funafuti' => 'pacific/funafuti',
                'pacific/galapagos' => 'pacific/galapagos', 'pacific/gambier' => 'pacific/gambier', 'pacific/guadalcanal' => 'pacific/guadalcanal',
                'pacific/guam' => 'pacific/guam', 'pacific/honolulu' => 'pacific/honolulu', 'pacific/kanton' => 'pacific/kanton',
                'pacific/kiritimati' => 'pacific/kiritimati', 'pacific/kosrae' => 'pacific/kosrae', 'pacific/kwajalein' => 'pacific/kwajalein',
                'pacific/majuro' => 'pacific/majuro', 'pacific/marquesas' => 'pacific/marquesas', 'pacific/midway' => 'pacific/midway',
                'pacific/nauru' => 'pacific/nauru', 'pacific/niue' => 'pacific/niue', 'pacific/norfolk' => 'pacific/norfolk',
                'pacific/noumea' => 'pacific/noumea', 'pacific/pago_pago' => 'pacific/pago_pago', 'pacific/palau' => 'pacific/palau',
                'pacific/pitcairn' => 'pacific/pitcairn', 'pacific/pohnpei' => 'pacific/pohnpei', 'pacific/port_moresby' => 'pacific/port_moresby',
                'pacific/rarotonga' => 'pacific/rarotonga', 'pacific/saipan' => 'pacific/saipan', 'pacific/tahiti' => 'pacific/tahiti',
                'pacific/tarawa' => 'pacific/tarawa', 'pacific/tongatapu' => 'pacific/tongatapu',
                'pacific/wake' => 'pacific/wake', 'pacific/wallis' => 'pacific/wallis');

            break;  
            default:

                error_log(__LINE__ . ' env Unknown SWITCH CASE received. ['. strval($data_type) . '].');

            break;

        }

    }

    public function incarnate($mode, $sys_ts, $format_override=NULL){
        /* DATE DISPLAY MODES - MIN REQUIRED
         * ELAPSED_VERBOSE - 15 weeks 3 days 4 hours 2 minutes 5 seconds ago
         * ELAPSED - 15w 3d 4h 2m 5s ago
         * SYSTEM(DEFAULT) MM.DD.YYYY at 24:00:00
         * */

        // WE SHOULD CALC CURRENT TIMESTAMP USED IN MEASUREMENT AS CLOSE TO POINT OF IMPLEMENTATION AS POSSIBLE
        // Timestamp of the start of the request is available in $_SERVER['REQUEST_TIME'] since PHP 5.1. COMPARE THAT
        // WITH CRNRSTN oENV->wall_time() CALC AND CONSIDER PULLING IN $_SERVER[] PARAM INSTEAD OF CALCULATING START TIME WITHIN CONSTRUCTOR OF CRNRSTN ::

        // WE WILL NEED TO CONVERT SYSTEM TIME TO SECONDS. TRY THIS.
        $tmp_sys_ts_seconds = strtotime($sys_ts);

        switch($mode){
            case 'ELAPSED':
                 #$ts = time();
                 $tmp_output = $this->elapsed($tmp_sys_ts_seconds,$format_override);

            break;
            case 'ELAPSED_VERBOSE':
                #$ts = time();
                $tmp_output = $this->elapsed_verbose($tmp_sys_ts_seconds,$format_override);

            break;
            default:
                if(isset($format_override)){
                    $tmp_output = date($format_override, $tmp_sys_ts_seconds);
                }else{

                    $tmp_output = date('m.d.Y @ H:i:s', $tmp_sys_ts_seconds);
                }

            break;

        }

        return $tmp_output;

    }

    //
    // THIS SHOULD NOT REQUIRE OR DEPEND ON EVIFWEB LANGUAGE ENGINE. THIS IS TO SUPPORT CRNRSTN USES OF THIS CLASS SANS LANG SUPPORT.
    private function initialize_language(){

        self::$lang_content_ARRAY['YEAR'] = 'year';
        self::$lang_content_ARRAY['YEARS'] = 'years';
        self::$lang_content_ARRAY['Y'] = 'y';
        self::$lang_content_ARRAY['WEEK'] = 'week';
        self::$lang_content_ARRAY['WEEKS'] = 'weeks';
        self::$lang_content_ARRAY['W'] = 'w';
        self::$lang_content_ARRAY['DAY'] = 'day';
        self::$lang_content_ARRAY['DAYS'] = 'days';
        self::$lang_content_ARRAY['D'] = 'd';
        self::$lang_content_ARRAY['HOUR'] = 'hour';
        self::$lang_content_ARRAY['HOURS'] = 'hours';
        self::$lang_content_ARRAY['H'] = 'h';
        self::$lang_content_ARRAY['MINUTE'] = 'minute';
        self::$lang_content_ARRAY['MINUTES'] = 'minutes';
        self::$lang_content_ARRAY['M'] = 'm';
        self::$lang_content_ARRAY['SECOND'] = 'second';
        self::$lang_content_ARRAY['SECONDS'] = 'seconds';
        self::$lang_content_ARRAY['S'] = 's';
        self::$lang_content_ARRAY['AND'] = 'and';
        self::$lang_content_ARRAY['AGO'] = 'ago';

        #error_log("finite (101)->".print_r(self::$lang_content_ARRAY['WEEKS']));

    }

    //
    // THIS WILL INITIALIZE LANGUAGE (ISO) TO BE USED BY THE FINITE_EXPRESS OBJECT. HIT THIS ONCE PER PAGE TO CONFIGURE ALL FINITE EXPRESSIONS FOR SESSION ISOCODE.
    // METHOD CALL IS OPTIONAL. ENGLISH WILL BE ASSUMED DEFAULT.
    public function configure_language($oUser){

        //
        // THIS. WILL. BE. MANUAL.
        self::$lang_content_ARRAY['YEAR'] = $oUser->getLangElem('FINITE_EXP_YEAR');
        self::$lang_content_ARRAY['YEARS'] = $oUser->getLangElem('FINITE_EXP_YEARS');
        self::$lang_content_ARRAY['Y'] = $oUser->getLangElem('FINITE_EXP_Y');
        self::$lang_content_ARRAY['WEEK'] = $oUser->getLangElem('FINITE_EXP_WEEK');
        self::$lang_content_ARRAY['WEEKS'] = $oUser->getLangElem('FINITE_EXP_WEEKS');
        self::$lang_content_ARRAY['W'] = $oUser->getLangElem('FINITE_EXP_W');
        self::$lang_content_ARRAY['DAY'] = $oUser->getLangElem('FINITE_EXP_DAY');
        self::$lang_content_ARRAY['DAYS'] = $oUser->getLangElem('FINITE_EXP_DAYS');
        self::$lang_content_ARRAY['D'] = $oUser->getLangElem('FINITE_EXP_D');
        self::$lang_content_ARRAY['HOUR'] = $oUser->getLangElem('FINITE_EXP_HOUR');
        self::$lang_content_ARRAY['HOURS'] = $oUser->getLangElem('FINITE_EXP_HOURS');
        self::$lang_content_ARRAY['H'] = $oUser->getLangElem('FINITE_EXP_H');
        self::$lang_content_ARRAY['MINUTE'] = $oUser->getLangElem('FINITE_EXP_MINUTE');
        self::$lang_content_ARRAY['MINUTES'] = $oUser->getLangElem('FINITE_EXP_MINUTES');
        self::$lang_content_ARRAY['M'] = $oUser->getLangElem('FINITE_EXP_M');
        self::$lang_content_ARRAY['SECOND'] = $oUser->getLangElem('FINITE_EXP_SECOND');
        self::$lang_content_ARRAY['SECONDS'] = $oUser->getLangElem('FINITE_EXP_SECONDS');
        self::$lang_content_ARRAY['S'] = $oUser->getLangElem('FINITE_EXP_S');
        self::$lang_content_ARRAY['AND'] = $oUser->getLangElem('FINITE_EXP_AND');
        self::$lang_content_ARRAY['AGO'] = $oUser->getLangElem('FINITE_EXP_AGO');

    }

    # SOURCE :: http://php.net/manual/en/function.time.php
    private function elapsed($secs, $format_override){
        $ts = time();
        $delta_secs = $ts-$secs;

        $bit = array(
            self::$lang_content_ARRAY['Y'] => $delta_secs / 31556926 % 12,
            self::$lang_content_ARRAY['W'] => $delta_secs / 604800 % 52,
            self::$lang_content_ARRAY['D'] => $delta_secs / 86400 % 7,
            self::$lang_content_ARRAY['H'] => $delta_secs / 3600 % 24,
            self::$lang_content_ARRAY['M'] => $delta_secs / 60 % 60,
            self::$lang_content_ARRAY['S'] => $delta_secs % 60
        );

        //
        // LET'S CONFIRM LANG OPERATION
        //error_log("(146) Y->".self::$lang_content_ARRAY['Y']);      // shows 1...not y...

        foreach($bit as $k => $v){
            if($v > 0){
                //
                // PUT IN CURFEW FOR TIME GRANULARITY
                if($k==self::$lang_content_ARRAY['Y'] || $k==self::$lang_content_ARRAY['W'] || ($k==self::$lang_content_ARRAY['D'] && $v>1)){

                    //
                    // RETURN DEFAULT DATE FORMAT
                    if(isset($format_override)){

                        return date($format_override, $secs);

                    }else{

                        return date('m.d.Y @ H:i:s', $secs);
                    }

                }else{

                    $ret[] = $v . $k;

                }
            }
        }

        if(!isset($ret)){

            $ret[] = 'just now.';

        }else{

            if(sizeof($ret)==0){

                $ret[] = 'just now.';

            }else{

                $ret[] = self::$lang_content_ARRAY['AGO'];

            }

        }

        return join(' ', $ret);

    }

    # SOURCE :: http://php.net/manual/en/function.time.php
    private function elapsed_verbose($secs){

        //
        // THIS SHOULD BE EXPOSED TO THE LANGUAGE ENGINE OF THE EVIFWEB CLIENT EXTRANET. NOT HARD CODED ENGLISH....OH MY. WHAT A REQUIREMENT THIS IS.
        // RE-CRNRSTN, IT MAY NOT BE APPROPRIATE TO PUSH LANG CONSIDERATIONS. WELL, MAYBE....THIS WOULD BE A FIRST FOR CRNRSTN...
        // I DON'T WANT TO PROCEED UNTIL I AM CLEAR ABOUT LANG SUPPORT DIRECTION FOR THIS. THERE ARE IMPLICATIONS.
        // TO REALLY TAKE CARE OF THE PEOPLE, DON'T FORGET SINGULAR AND PLURAL SUPPORT FOR MULTIPLE LANG...SO 2x THE NUMBER OF FORMATS...

        //
        // WE NEED TO APPROACH THIS DIFFERENTLY TO ALLOW FOR PLURAL
        $bit = array(
            '0'        => $secs / 31556926 % 12,
            '1'        => $secs / 604800 % 52,
            '2'        => $secs / 86400 % 7,
            '3'        => $secs / 3600 % 24,
            '4'        => $secs / 60 % 60,
            '5'        => $secs % 60
        );

        $bit_singular = array(
            '0'     => ' '.self::$lang_content_ARRAY['YEAR'],
            '1'     => ' '.self::$lang_content_ARRAY['WEEK'],
            '2'     => ' '.self::$lang_content_ARRAY['DAY'],
            '3'     => ' '.self::$lang_content_ARRAY['HOUR'],
            '4'     => ' '.self::$lang_content_ARRAY['MINUTE'],
            '5'     => ' '.self::$lang_content_ARRAY['SECOND']
        );

        $bit_plural = array(
            '0'     => ' '.self::$lang_content_ARRAY['YEARS'],
            '1'     => ' '.self::$lang_content_ARRAY['WEEKS'],
            '2'     => ' '.self::$lang_content_ARRAY['DAYS'],
            '3'     => ' '.self::$lang_content_ARRAY['HOURS'],
            '4'     => ' '.self::$lang_content_ARRAY['MINUTES'],
            '5'     => ' '.self::$lang_content_ARRAY['SECONDS']
        );

        foreach($bit as $k => $v){
            if($v > 1){
                $ret[] = $v . $bit_plural[$k];
                //error_log("finite (194) test ->".$bit_plural[$k]);

            }else{

                if($v == 1){
                    $ret[] = $v . $bit_singular[$k];
                    //error_log("finite (200) test ->".$bit_singular[$k]);
                }
            }
        }

//        foreach($bit_singular as $k => $v){
//            if($v > 1)$ret[] = $v . $k . 's';           // APPENDING AN S FOR PLURAL IS PRIMARILY ENGLISH. WE CAN'T RELY ON THIS APPEND FOR OUR PURPOSES.
//            if($v == 1)$ret[] = $v . $k;
//        }

        array_splice($ret, count($ret)-1, 0, self::$lang_content_ARRAY['AND']);
        $ret[] = self::$lang_content_ARRAY['AGO'];

        return join(' ', $ret);

    }

    public function addTimerBuffer($timer_copy, $lastcontact){

        $tsec = time();

        //
        // GET DELTA SECONDS
        $tmp_lastcontact_tsec = strtotime($lastcontact);

        # $timer_copy = 0:00:09
        $delta_secs = $tsec - $tmp_lastcontact_tsec;

        list($tmp_hour, $tmp_min, $tmp_sec) = explode(':', $timer_copy);

        $tmp_secs_cum = $this->convertToSecs($tmp_hour, $tmp_min, $tmp_sec);

        $final_secs_cum = $tmp_secs_cum + $delta_secs;

        $timer_copy_new = $this->secsTimerExplode($final_secs_cum, ':');

        return $timer_copy_new;

    }

    public function secsTimerExplode($secs, $delim){

        //
        // EXTRACT HOURS MIN SECS FROM TOTAL SECS
        // SOURCE :: https://stackoverflow.com/questions/3172332/convert-seconds-to-hourminutesecond/3172358
        // COMMENT :: https://stackoverflow.com/a/3172368
        // AUTHOR :: aif :: https://stackoverflow.com/users/51760/aif
        $hours = floor($secs / 3600);
        $minutes = floor(($secs / 60) % 60);
        $seconds = $secs % 60;
        //error_log('287 finiteexpress hour[' . $hours.'] min[' . $minutes.'] sec[' . $seconds.']');

        if($seconds<10){
            $seconds = '0' . $seconds;
        }

        if($minutes<10){
            $minutes = '0' . $minutes;
        }

        return $hours.$delim.$minutes.$delim.$seconds;
    }

    private function convertToSecs($hour, $min, $sec){

        /*

        $hour = '01',
        $min = '05,
        $sec = '09'

        */

        $hour = intval($hour);
        $min = intval($min);
        $sec = intval($sec);

        //error_log('311 finiteexpress hour[' . $hour.'] min[' . $min.'] sec[' . $sec.']');

        $tmp_hour_secs = $hour * 60 * 60;
        $tmp_min_secs = $min * 60;

        $tmp_cum_secs = (int) $sec + (int) $tmp_hour_secs + (int) $tmp_min_secs;

        return $tmp_cum_secs;
    }

    public function __destruct() {

    }

}