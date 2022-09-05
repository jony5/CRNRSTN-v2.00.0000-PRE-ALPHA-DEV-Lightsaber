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
# # C # R # N # R # S # T # N # : : # # ##
#
#  CLASS :: crnrstn_multi_language_manager
#  VERSION :: 1.00.0000
#  DATE :: Friday May 14, 2021 @ 0611hrs
#  AUTHOR :: Jonathan 'J5' Harris, jharris@eVifweb.com
#  URI :: 
#  DESCRIPTION :: Multi-language management.
#  LICENSE :: MIT | http://crnrstn.evifweb.com/licensing/
#
class crnrstn_multi_language_manager {

	protected $oLogger;
    public $oCRNRSTN;

    protected $country_iso_code = 'en';
    protected $lang_pref_serial_ARRAY = array();
    protected $lang_pref_data_ARRAY = array();

    private static $lang_pref_seq_ARRAY = array();
    private static $lang_pref_base_ARRAY = array();
    private static $lang_pref_region_ARRAY = array();
    private static $lang_pref_weight_ARRAY = array();

    public function __construct($oCRNRSTN){

        $this->oCRNRSTN = $oCRNRSTN;

        //
        // INSTANTIATE LOGGER
        $this->oLogger = new crnrstn_logging(__CLASS__, $this->oCRNRSTN);
        
	}

	public function return_lang_pref_data($data_element, $i){

	    return $this->lang_pref_data_ARRAY[$this->lang_pref_serial_ARRAY[$i]][$data_element];

    }

	public function return_lang_pref_serial($index){

        return $this->lang_pref_serial_ARRAY[$index];

    }

	public function return_lang_pref_count(){

	    return count($this->lang_pref_serial_ARRAY);

    }

	private function load_language_preference($base, $region = null, $weighting = null){

        $tmp_lang_pref_serialization = $this->oCRNRSTN->generate_new_key(10);

        $this->lang_pref_serial_ARRAY[] = $tmp_lang_pref_serialization;

        $tmp_base_lower = strtolower($base);
        switch($tmp_base_lower){
            case '*':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = '*';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = '*';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = '*';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = '*';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = '*';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = '*';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = '*';

            break;
            case 'ab':
            case 'abk':

                //
                // SOURCE :: https://en.wikipedia.org/wiki/List_of_ISO_639-1_codes

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Abkhazian';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'аҧсуа бызшәа, аҧсшәа';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'ab';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'abk';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'abk';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Abkhazian_language';

            break;
            case 'aa':
            case 'aar':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Afar';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'Afaraf';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'aa';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'aar';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'aar';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Afar_language';

            break;
            case 'af':
            case 'afr':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Afrikaans';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'Afrikaans';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'af';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'afr';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'afr';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Afrikaans_language';

            break;
            case 'ak':
            case 'aka':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Akan';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'Akan';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'ak';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'aka';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'aka';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Akan_language';

            break;
            case 'sq':
            case 'sqi':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Albanian';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'Shqip';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'sq';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'sqi';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'sqi';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Albanian_language';

            break;
            case 'am':
            case 'amh':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Amharic';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'አማርኛ';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'am';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'amh';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'amh';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Amharic_language';

            break;
            case 'ar':
            case 'ara':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Arabic';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'العربية';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'ar';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'ara';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'ara';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Arabic_language';

            break;
            case 'an':
            case 'arg':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Aragonese';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'aragonés';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'an';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'arg';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'arg';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Aragonese_language';

            break;
            case 'hy':
            case 'hye':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Armenian';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'Հայերեն';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'hy';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'hye';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'hye';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Armenian_language';

            break;
            case 'as':
            case 'asm':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Assamese';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'অসমীয়া';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'as';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'asm';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'asm';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Assamese_language';

            break;
            case 'av':
            case 'ava':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Avaric';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'авар мацӀ, магӀарул мацӀ';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'av';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'ava';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'ava';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Avar_language';

            break;
            case 'ae':
            case 'ave':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Avestan';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'avesta';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'ae';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'ave';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'ave';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Avestan_language';

            break;
            case 'ay':
            case 'aym':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Aymara';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'aymar aru';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'ay';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'aym';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'aym';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Aymara_language';

            break;
            case 'az':
            case 'aze':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Azerbaijani';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'azərbaycan dili, تۆرکجه';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'az';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'aze';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'aze';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Azerbaijani_language';

            break;
            case 'bm':
            case 'bam':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Bambara';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'bamanankan';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'bm';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'bam';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'bam';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Bambara_language';

            break;
            case 'ba':
            case 'bak':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Bashkir';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'башҡорт теле';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'ba';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'bak';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'bak';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Bashkir_language';

            break;
            case 'eu':
            case 'eus':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Basque';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'euskara, euskera';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'eu';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'eus';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'eus';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Basque_language';

            break;
            case 'be':
            case 'bel':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Belarusian';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'беларуская мова';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'be';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'bel';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'bel';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Belarusian_language';

            break;
            case 'bn':
            case 'ben':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Bengali';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'বাংলা';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'bn';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'ben';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'ben';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Bengali_language';

            break;
            case 'bi':
            case 'bis':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Bislama';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'Bislama';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'bi';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'bis';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'bis';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Bislama_language';

            break;
            case 'bs':
            case 'bos':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Bosnian';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'bosanski jezik';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'bs';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'bos';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'bos';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Bosnian_language';

            break;
            case 'br':
            case 'bre':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Breton';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'brezhoneg';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'br';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'bre';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'bre';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Breton_language';

            break;
            case 'bg':
            case 'bul':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Bulgarian';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'български език';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'bg';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'bul';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'bul';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Bulgarian_language';

            break;
            case 'my':
            case 'mya':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Burmese';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'ဗမာစာ';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'my';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'mya';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'mya';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Burmese_language';

            break;
            case 'ca':
            case 'cat':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Catalan, Valencian';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'català, valencià';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'ca';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'cat';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'cat';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Catalan_language';

            break;
            case 'ch':
            case 'cha':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Chamorro';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'Chamoru';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'ch';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'cha';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'cha';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Chamorro_language';

            break;
            case 'ce':
            case 'che':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Chechen';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'нохчийн мотт';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'ce';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'che';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'che';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Chechen_language';

            break;
            case 'ny':
            case 'nya':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Chichewa, Chewa, Nyanja';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'chiCheŵa, chinyanja';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'ny';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'nya';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'nya';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Chichewa_language';

            break;
            case 'zh':
            case 'zho':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Chinese';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = '中文 (Zhōngwén), 汉语, 漢語';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'zh';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'zho';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'zho';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Chinese_language';

            break;
            case 'cv':
            case 'chv':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Chuvash';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'чӑваш чӗлхи';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'cv';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'chv';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'chv';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Chuvash_language';

            break;
            case 'kw':
            case 'cor':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Cornish';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'Kernewek';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'kw';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'cor';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'cor';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Cornish_language';

            break;
            case 'co':
            case 'cos':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Corsican';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'corsu, lingua corsa';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'co';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'cos';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'cos';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Corsican_language';

            break;
            case 'cr':
            case 'cre':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Cree';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'ᓀᐦᐃᔭᐍᐏᐣ';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'cr';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'cre';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'cre';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Cree_language';

            break;
            case 'hr':
            case 'hrv':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Croatian';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'hrvatski jezik';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'hr';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'hrv';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'hrv';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Croatian_language';

            break;
            case 'cs':
            case 'ces':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Czech';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'čeština, český jazyk';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'cs';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'ces';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'ces';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Czech_language';

            break;
            case 'da':
            case 'dan':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Danish';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'dansk';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'da';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'dan';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'dan';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Danish_language';

            break;
            case 'dv':
            case 'div':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Divehi, Dhivehi, Maldivian';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'ދިވެހި';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'dv';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'div';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'div';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Dhivehi_language';

            break;
            case 'nl':
            case 'nld':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Dutch, Flemish';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'Nederlands, Vlaams';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'nl';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'nld';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'nld';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Dutch_language';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Flemish';

            break;
            case 'dz':
            case 'dzo':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Dzongkha';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'རྫོང་ཁ';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'dz';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'dzo';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'dzo';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Dzongkha_language';

            break;
            case 'en':
            case 'eng':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'English';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'English';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'en';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'eng';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'eng';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/English_language';

            break;
            case 'eo':
            case 'epo':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Esperanto';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'Esperanto';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'eo';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'epo';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'epo';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Esperanto';

            break;
            case 'et':
            case 'est':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Estonian';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'eesti, eesti keel';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'et';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'est';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'est';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Estonian_language';

            break;
            case 'ee':
            case 'ewe':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Ewe';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'Eʋegbe';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'ee';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'ewe';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'ewe';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Ewe_language';

            break;
            case 'fo':
            case 'fao':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Faroese';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'føroyskt';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'fo';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'fao';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'fao';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Faroese_language';

            break;
            case 'fj':
            case 'fij':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Fijian';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'vosa Vakaviti';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'fj';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'fij';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'fij';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Fijian_language';

            break;
            case 'fi':
            case 'fin':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Finnish';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'suomi, suomen kieli';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'fi';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'fin';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'fin';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Finnish_language';

            break;
            case 'fr':
            case 'fra':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'French';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'français';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'fr';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'fra';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'fra';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/French_language';

            break;
            case 'ff':
            case 'ful':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Fulah';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'Fulfulde, Pulaar, Pular';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'ff';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'ful';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'ful';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Fulah_language';

            break;
            case 'gl':
            case 'glg':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Galician';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'Galego';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'gl';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'glg';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'glg';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Galician_language';

            break;
            case 'ka':
            case 'kat':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Georgian';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'ქართული';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'ka';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'kat';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'kat';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Georgian_language';

            break;
            case 'de':
            case 'deu':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'German';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'Deutsch';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'de';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'deu';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'deu';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/German_language';

            break;
            case 'el':
            case 'ell':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Greek';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'ελληνικά';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'el';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'ell';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'ell';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Greek_language';

            break;
            case 'gn':
            case 'grn':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Guarani';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'Avañe\'ẽ';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'gn';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'grn';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'grn';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Guarani_language';

            break;
            case 'gu':
            case 'guj':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Gujarati';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'ગુજરાતી';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'gu';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'guj';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'guj';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Gujarati_language';

            break;
            case 'ht':
            case 'hat':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Haitian, Haitian Creole';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'Kreyòl ayisyen';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'ht';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'hat';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'hat';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Haitian_Creole_language';

            break;
            case 'ha':
            case 'hau':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Hausa';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = '(Hausa) هَوُسَ';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'ha';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'hau';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'hau';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Hausa_language';

            break;
            case 'he':
            case 'heb':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Hebrew';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'עברית';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'he';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'heb';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'heb';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Hebrew_language';

            break;
            case 'hi':
            case 'hin':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Hindi';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'हिन्दी, हिंदी';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'hi';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'hin';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'hin';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Hindi';

            break;
            case 'ho':
            case 'hmo':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Hiri Motu';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'Hiri Motu';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'ho';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'hmo';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'hmo';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Hiri_Motu_language';

            break;
            case 'hu':
            case 'hun':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Hungarian';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'magyar';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'hu';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'hun';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'hun';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Hungarian_language';

            break;
            case 'ia':
            case 'ina':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Interlingua';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'Interlingua';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'ia';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'ina';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'ina';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Interlingua';

            break;
            case 'id':
            case 'ind':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Indonesian';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'Bahasa Indonesia';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'id';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'ind';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'ind';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Indonesian_language';

            break;
            case 'ie':
            case 'ile':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Interlingue, Occidental';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'Interlingue';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'ie';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'ile';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'ile';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Interlingue';

            break;
            case 'ga':
            case 'gle':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Irish';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'Gaeilge';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'ga';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'gle';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'gle';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Irish_language';

            break;
            case 'ig':
            case 'ibo':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Igbo';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'Asụsụ Igbo';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'ig';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'ibo';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'ibo';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Igbo_language';

            break;
            case 'ik':
            case 'ipk':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Inupiaq';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'Iñupiaq, Iñupiatun';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'ik';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'ipk';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'ipk';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Inupiaq_language';

            break;
            case 'io':
            case 'ido':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Ido';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'Ido';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'io';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'ido';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'ido';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Ido_(language)';

            break;
            case 'is':
            case 'isl':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Icelandic';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'Íslenska';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'is';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'isl';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'isl';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Icelandic_language';

            break;
            case 'it':
            case 'ita':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Italian';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'Italiano';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'it';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'ita';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'ita';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Italian_language';

            break;
            case 'iu':
            case 'iku':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Inuktitut';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'ᐃᓄᒃᑎᑐᑦ';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'iu';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'iku';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'iku';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Inuktitut';

            break;
            case 'ja':
            case 'jpn':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Japanese';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = '日本語 (にほんご)';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'ja';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'jpn';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'jpn';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Japanese_language';

            break;
            case 'jv':
            case 'jav':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Javanese';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'ꦧꦱꦗꦮ, Basa Jawa';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'jv';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'jav';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'jav';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Javanese_language';

            break;
            case 'kl':
            case 'kal':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Kalaallisut, Greenlandic';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'kalaallisut, kalaallit oqaasii';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'kl';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'kal';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'kal';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Greenlandic_language';

            break;
            case 'kn':
            case 'kan':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Kannada';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'ಕನ್ನಡ';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'kn';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'kan';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'kan';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Kannada_language';

            break;
            case 'kr':
            case 'kau':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Kanuri';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'Kanuri';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'kr';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'kau';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'kau';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Kanuri_language';

            break;
            case 'ks':
            case 'kas':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Kashmiri';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'कॉशुर, کٲشُر‎';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'ks';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'kas';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'kas';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Kashmiri_language';

            break;
            case 'kk':
            case 'kaz':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Kazakh';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'қазақ тілі';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'kk';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'kaz';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'kaz';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Kazakh_language';

            break;
            case 'km':
            case 'khm':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Central Khmer';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'ខ្មែរ, ខេមរភាសា, ភាសាខ្មែរ';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'km';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'khm';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'khm';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Central_Khmer_language';

            break;
            case 'ki':
            case 'kik':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Kikuyu, Gikuyu';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'Gĩkũyũ';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'ki';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'kik';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'kik';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Gikuyu_language';

            break;
            case 'rw':
            case 'kin':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Kinyarwanda';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'Ikinyarwanda';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'rw';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'kin';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'kin';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Kinyarwanda';

            break;
            case 'ky':
            case 'kir':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Kirghiz, Kyrgyz';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'Кыргызча, Кыргыз тили';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'ky';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'kir';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'kir';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Kirghiz_language';

            break;
            case 'kv':
            case 'kom':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Komi';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'коми кыв';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'kv';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'kom';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'kom';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Komi_language';

            break;
            case 'kg':
            case 'kon':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Kongo';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'Kikongo';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'kg';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'kon';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'kon';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Kongo_language';

            break;
            case 'ko':
            case 'kor':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Korean';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = '한국어';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'ko';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'kor';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'kor';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Korean_language';

            break;
            case 'ku':
            case 'kur':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Kurdish';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'Kurdî, کوردی';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'ku';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'kur';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'kur';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Kurdish_language';

            break;
            case 'kj':
            case 'kua':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Kuanyama, Kwanyama';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'Kuanyama';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'kj';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'kua';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'kua';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Kuanyama_language';

            break;
            case 'la':
            case 'lat':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Latin';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'latine, lingua latina';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'la';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'lat';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'lat';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Latin';

            break;
            case 'lb':
            case 'ltz':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Luxembourgish, Letzeburgesch';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'Lëtzebuergesch';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'lb';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'ltz';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'ltz';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Luxembourgish_language';

            break;
            case 'lg':
            case 'lug':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Ganda';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'Luganda';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'lg';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'lug';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'lug';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Ganda_language';

            break;
            case 'li':
            case 'lim':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Limburgan, Limburger, Limburgish';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'Limburgs';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'li';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'lim';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'lim';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Limburgan_language';

            break;
            case 'ln':
            case 'lin':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Lingala';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'Lingála';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'ln';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'lin';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'lin';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Lingala_language';

            break;
            case 'lo':
            case 'lao':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Lao';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'ພາສາລາວ';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'lo';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'lao';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'lao';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Lao_language';

            break;
            case 'lt':
            case 'lit':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Lithuanian';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'lietuvių kalba';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'lt';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'lit';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'lit';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Lithuanian_language';

            break;
            case 'lu':
            case 'lub':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Luba-Katanga';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'Kiluba';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'lu';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'lub';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'lub';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Luba-Katanga_language';

            break;
            case 'lv':
            case 'lav':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Latvian';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'latviešu valoda';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'lv';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'lav';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'lav';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Latvian_language';

            break;
            case 'gv':
            case 'glv':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Manx';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'Gaelg, Gailck';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'gv';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'glv';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'glv';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Manx_language';

            break;
            case 'mk':
            case 'mkd':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Macedonian';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'македонски јазик';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'mk';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'mkd';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'mkd';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Macedonian_language';

            break;
            case 'mg':
            case 'mlg':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Malagasy';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'fiteny malagasy';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'mg';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'mlg';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'mlg';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Malagasy_language';

            break;
            case 'ms':
            case 'msa':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Malay';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'Bahasa Melayu, بهاس ملايو';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'ms';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'msa';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'msa';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Malay_language';

            break;
            case 'ml':
            case 'mal':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Malayalam';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'മലയാളം';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'ml';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'mal';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'mal';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Malayalam_language';

            break;
            case 'mt':
            case 'mlt':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Maltese';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'Malti';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'mt';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'mlt';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'mlt';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Maltese_language';

            break;
            case 'mi':
            case 'mri':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Maori';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'te reo Māori';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'mi';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'mri';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'mri';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/M%C4%81ori_language';

            break;
            case 'mr':
            case 'mar':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Marathi';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'मराठी';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'mr';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'mar';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'mar';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Marathi_language';

            break;
            case 'mh':
            case 'mah':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Marshallese';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'Kajin M̧ajeļ';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'mh';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'mah';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'mah';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Marshallese_language';

            break;
            case 'mn':
            case 'mon':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Mongolian';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'Монгол хэл';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'mn';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'mon';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'mon';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Mongolian_language';

            break;
            case 'na':
            case 'nau':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Nauru';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'Dorerin Naoero';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'na';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'nau';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'nau';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Nauru_language';

            break;
            case 'nv':
            case 'nav':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Navajo, Navaho';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'Diné bizaad';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'nv';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'nav';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'nav';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Navajo_language';

            break;
            case 'nd':
            case 'nde':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'North Ndebele';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'isiNdebele';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'nd';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'nde';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'nde';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/North_Ndebele_language';

            break;
            case 'ne':
            case 'nep':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Nepali';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'नेपाली';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'ne';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'nep';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'nep';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Nepali_language';

            break;
            case 'ng':
            case 'ndo':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Ndonga';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'Owambo';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'ng';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'ndo';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'ndo';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Ndonga';

            break;
            case 'nb':
            case 'nob':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Norwegian Bokmål';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'Norsk Bokmål';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'nb';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'nob';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'nob';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Bokm%C3%A5l';

            break;
            case 'nn':
            case 'nno':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Norwegian Nynorsk';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'Norsk Nynorsk';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'nn';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'nno';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'nno';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Nynorsk';

            break;
            case 'no':
            case 'nor':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Norwegian Nynorsk';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'Norsk Nynorsk';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'no';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'nor';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'nor';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Norwegian_language';

            break;
            case 'ii':
            case 'iii':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Sichuan Yi, Nuosu';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'ꆈꌠ꒿ Nuosuhxop';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'ii';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'iii';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'iii';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Sichuan_Yi_language';

            break;
            case 'nr':
            case 'nbl':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'South Ndebele';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'isiNdebele';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'nr';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'nbl';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'nbl';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/South_Ndebele_language';

            break;
            case 'oc':
            case 'oci':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Occitan';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'occitan, lenga d\'òc';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'oc';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'oci';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'oci';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Occitan_language';

            break;
            case 'oj':
            case 'oji':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Ojibwa';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'ᐊᓂᔑᓈᐯᒧᐎᓐ';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'oj';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'oji';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'oji';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Ojibwa_language';

            break;
            case 'cu':
            case 'chu':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Church Slavic, Old Slavonic, Church Slavonic, Old Bulgarian, Old Church Slavonic';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'ѩзыкъ словѣньскъ';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'cu';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'chu';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'chu';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Church_Slavonic_language';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Old_Church_Slavonic';

            break;
            case 'om':
            case 'orm':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Oromo';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'Afaan Oromoo';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'om';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'orm';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'orm';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Oromo_language';

            break;
            case 'or':
            case 'ori':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Oriya';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'ଓଡ଼ିଆ';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'or';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'ori';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'ori';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Oriya_language';

            break;
            case 'os':
            case 'oss':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Ossetian, Ossetic';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'ирон ӕвзаг';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'os';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'oss';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'oss';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Ossetian_language';

            break;
            case 'pa':
            case 'pan':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Punjabi, Panjabi';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'ਪੰਜਾਬੀ, پنجابی';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'pa';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'pan';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'pan';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Punjabi_language';

            break;
            case 'pi':
            case 'pli':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Pali';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'पालि, पाळि';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'pi';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'pli';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'pli';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Pali_language';

            break;
            case 'fa':
            case 'fas':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Persian';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'فارسی';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'fa';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'fas';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'fas';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Persian_language';

            break;
            case 'pl':
            case 'pol':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Polish';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'język polski, polszczyzna';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'pl';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'pol';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'pol';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Polish_language';

            break;
            case 'ps':
            case 'pus':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Pashto, Pushto';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'پښتو';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'ps';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'pus';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'pus';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Pashto_language';

            break;
            case 'pt':
            case 'por':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Portuguese';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'Português';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'pt';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'por';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'por';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Portuguese_language';

            break;
            case 'qu':
            case 'que':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Quechua';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'Runa Simi, Kichwa';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'qu';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'que';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'que';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Quechua_language';

            break;
            case 'rm':
            case 'roh':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Romansh';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'Rumantsch Grischun';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'rm';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'roh';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'roh';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Romansh_language';

            break;
            case 'rn':
            case 'run':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Rundi';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'Ikirundi';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'rn';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'run';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'run';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Rundi_language';

            break;
            case 'ro':
            case 'ron':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Romanian, Moldavian, Moldovan';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'Română, Moldovenească';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'ro';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'ron';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'ron';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Romanian_language';

            break;
            case 'ru':
            case 'rus':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Russian';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'русский';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'ru';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'rus';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'rus';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Russian_language';

            break;
            case 'sa':
            case 'san':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Sanskrit';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'संस्कृतम्, 𑌸𑌂𑌸𑍍𑌕𑍃𑌤𑌮𑍍';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'sa';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'san';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'san';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Sanskrit';

            break;
            case 'sc':
            case 'srd':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Sardinian';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'sardu';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'sc';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'srd';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'srd';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Sardinian_language';

            break;
            case 'sd':
            case 'snd':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Sindhi';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'सिंधी, سنڌي';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'sd';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'snd';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'snd';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Sindhi_language';

            break;
            case 'se':
            case 'sme':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Northern Sami';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'Davvisámegiella';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'se';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'sme';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'sme';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Northern_Sami';

            break;
            case 'sm':
            case 'smo':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Samoan';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'gagana fa\'a Samoa';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'sm';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'smo';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'smo';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Samoan_language';

            break;
            case 'sg':
            case 'sag':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Sango';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'yângâ tî sängö';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'sg';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'sag';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'sag';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Sango_language';

            break;
            case 'sr':
            case 'srp':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Serbian';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'српски језик';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'sr';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'srp';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'srp';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Serbian_language';

            break;
            case 'gd':
            case 'gla':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Gaelic, Scottish Gaelic';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'Gàidhlig';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'gd';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'gla';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'gla';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Scottish_Gaelic';

            break;
            case 'sn':
            case 'sna':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Shona';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'chiShona';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'sn';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'sna';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'sna';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Shona_language';

            break;
            case 'si':
            case 'sin':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Sinhala, Sinhalese';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'සිංහල';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'si';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'sin';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'sin';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Sinhala_language';

            break;
            case 'sk':
            case 'slk':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Slovak';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'Slovenčina, Slovenský jazyk';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'sk';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'slk';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'slk';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Slovak_language';

            break;
            case 'sl':
            case 'slv':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Slovenian';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'Slovenski jezik, Slovenščina';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'sl';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'slv';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'slv';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Slovene_language';

            break;
            case 'so':
            case 'som':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Somali';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'Soomaaliga, af Soomaali';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'so';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'som';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'som';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Somali_language';

            break;
            case 'st':
            case 'sot':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Southern Sotho';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'Sesotho';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'st';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'sot';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'sot';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Sotho_language';

            break;
            case 'es':
            case 'spa':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Spanish, Castilian';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'Español';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'es';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'spa';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'spa';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Spanish_language';

            break;
            case 'su':
            case 'sun':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Sundanese';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'Basa Sunda';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'su';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'sun';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'sun';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Sundanese_language';

            break;
            case 'sw':
            case 'swa':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Swahili';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'Kiswahili';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'sw';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'swa';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'swa';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Swahili_language';

            break;
            case 'ss':
            case 'ssw':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Swati';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'SiSwati';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'ss';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'ssw';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'ssw';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Swati_language';

            break;
            case 'sv':
            case 'swe':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Swedish';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'Svenska';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'sv';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'swe';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'swe';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Swedish_language';

            break;
            case 'ta':
            case 'tam':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Tamil';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'தமிழ்';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'ta';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'tam';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'tam';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Tamil_language';

            break;
            case 'te':
            case 'tel':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Telugu';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'తెలుగు';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'te';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'tel';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'tel';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Telugu_language';

            break;
            case 'tg':
            case 'tgk':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Tajik';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'тоҷикӣ, toçikī, تاجیکی';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'tg';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'tgk';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'tgk';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Tajik_language';

            break;
            case 'th':
            case 'tha':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Thai';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'ไทย';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'th';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'tha';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'tha';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Thai_language';

            break;
            case 'ti':
            case 'tir':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Tigrinya';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'ትግርኛ';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'ti';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'tir';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'tir';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Tigrinya_language';

            break;
            case 'bo':
            case 'bod':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Tibetan';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'བོད་ཡིག';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'bo';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'bod';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'bod';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Standard_Tibetan';

            break;
            case 'tk':
            case 'tuk':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Turkmen';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'Türkmençe, Türkmen dili';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'tk';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'tuk';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'tuk';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Turkmen_language';

            break;
            case 'tl':
            case 'tgl':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Tagalog';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'Wikang Tagalog';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'tl';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'tgl';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'tgl';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Tagalog_language';

            break;
            case 'tn':
            case 'tsn':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Tswana';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'Setswana';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'tn';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'tsn';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'tsn';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Tswana_language';

            break;
            case 'to':
            case 'ton':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Tonga (Tonga Islands)';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'Faka Tonga';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'to';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'ton';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'ton';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Tongan_language';

            break;
            case 'tr':
            case 'tur':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Turkish';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'Türkçe';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'tr';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'tur';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'tur';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Turkish_language';

            break;
            case 'ts':
            case 'tso':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Tsonga';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'Xitsonga';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'ts';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'tso';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'tso';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Tsonga_language';

            break;
            case 'tt':
            case 'tat':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Tatar';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'татар теле, tatar tele';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'tt';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'tat';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'tat';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Tatar_language';

            break;
            case 'tw':
            case 'twi':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Twi';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'Twi';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'tw';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'twi';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'twi';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Twi';

            break;
            case 'ty':
            case 'tah':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Tahitian';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'Reo Tahiti';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'ty';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'tah';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'tah';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Tahitian_language';

            break;
            case 'ug':
            case 'uig':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Uighur, Uyghur';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'ئۇيغۇرچە‎, Uyghurche';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'ug';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'uig';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'uig';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Uighur_language';

            break;
            case 'uk':
            case 'ukr':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Ukrainian';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'Українська';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'uk';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'ukr';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'ukr';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Ukrainian_language';

            break;
            case 'ur':
            case 'urd':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Urdu';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'اردو';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'ur';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'urd';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'urd';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Urdu';

            break;
            case 'uz':
            case 'uzb':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Uzbek';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'Oʻzbek, Ўзбек, أۇزبېك';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'uz';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'uzb';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'uzb';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Uzbek_language';

            break;
            case 've':
            case 'ven':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Venda';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'Tshivenḓa';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 've';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'ven';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'ven';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Venda_language';

            break;
            case 'vi':
            case 'vie':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Vietnamese';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'Tiếng Việt';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'vi';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'vie';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'vie';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Vietnamese_language';

            break;
            case 'vo':
            case 'vol':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Volapük';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'Volapük';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'vo';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'vol';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'vol';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Volap%C3%BCk';

            break;
            case 'wa':
            case 'wln':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Walloon';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'Walon';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'wa';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'wln';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'wln';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Walloon_language';

            break;
            case 'cy':
            case 'cym':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Welsh';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'Cymraeg';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'cy';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'cym';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'cym';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Welsh_language';

            break;
            case 'wo':
            case 'wol':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Wolof';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'Wolof';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'wo';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'wol';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'wol';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Wolof_language';

            break;
            case 'fy':
            case 'fry':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Western Frisian';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'Frysk';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'fy';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'fry';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'fry';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/West_Frisian_language';

            break;
            case 'xh':
            case 'xho':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Xhosa';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'isiXhosa';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'xh';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'xho';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'xho';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Xhosa_language';

            break;
            case 'yi':
            case 'yid':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Yiddish';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'ייִדיש';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'yi';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'yid';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'yid';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Yiddish_language';

            break;
            case 'yo':
            case 'yor':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Yoruba';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'Yorùbá';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'yo';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'yor';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'yor';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Yoruba_language';

            break;
            case 'za':
            case 'zha':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Zhuang, Chuang';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'Saɯ cueŋƅ, Saw cuengh';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'za';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'zha';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'zha';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Zhuang_language';

            break;
            case 'zu':
            case 'zul':

                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['locale_identifier'] = $tmp_base_lower;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['region_variant'] = $region;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['factor_weighting'] = $weighting;
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_language_nomination'] = 'Zulu';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['native_nomination'] = 'isiZulu';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-1_2002'] = 'zu';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-2_1998'] = 'zul';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['iso_639-3_2007'] = 'zul';
                $this->lang_pref_data_ARRAY[$tmp_lang_pref_serialization]['uri'][] = 'https://en.wikipedia.org/wiki/Zulu_language';

            break;

        }

    }

    private function store_language_preference($base, $meta = null, $meta_type = null){

//        private static $lang_pref_base_ARRAY = array();
//        private static $lang_pref_region_ARRAY = array();
//        private static $lang_pref_weight_ARRAY = array();

        //error_log(__LINE__ . ' multi-lang [' . $base . '][' . $meta . '][' . $meta_type . ']');

        $tmp_serial = $this->oCRNRSTN->generate_new_key(25);

        self::$lang_pref_seq_ARRAY[] = $tmp_serial;

        if(isset($meta_type)){

            switch($meta_type){
                case 'region':

                    self::$lang_pref_base_ARRAY[$tmp_serial] = $base;
                    self::$lang_pref_region_ARRAY[$tmp_serial] = $meta;

                break;
                case 'weight':

                    self::$lang_pref_base_ARRAY[$tmp_serial] = $base;
                    self::$lang_pref_weight_ARRAY[$tmp_serial] = $meta;

                break;

            }

        }else{

            self::$lang_pref_base_ARRAY[$tmp_serial] = $base;

        }

    }

	public function consume_accept_language_data($header_accept_language){

	    $tmp_len = strlen($header_accept_language);

        //
        //en-US,en;q=0.9,zh-CN;q=0.8,zh;q=0.7
        //fr-CH, fr;q=0.9, en;q=0.8, de;q=0.7, *;q=0.5
        $tmp_pos_comma = strpos($header_accept_language,',');
        $tmp_pos_dash = strpos($header_accept_language,'-');
        $tmp_pos_weight = strpos($header_accept_language,';q=');

        if ($tmp_pos_comma !== false) {

            $tmp_lang_str_manip_00 = explode(',', $header_accept_language);

            foreach($tmp_lang_str_manip_00 as $index => $value){

                //error_log(__LINE__ . ' multi-lang process[' . $value . ']');

                $value = trim($value);
                $tmp_pos_dash = strpos($value,'-');
                $tmp_pos_weight = strpos($value,';q=');

                if ($tmp_pos_dash !== false) {

                    if ($tmp_pos_weight !== false) {
                        //zh-CN;q=0.8
                        //de;q=0.7
                        //*;q=0.5

                        $tmp_lang_str_manip_02 = explode(';q=', $value);

                        $tmp_pos_dash02 = strpos($tmp_lang_str_manip_02[0],'-');

                        if ($tmp_pos_dash02 !== false) {
                            //zh-CN
                            $tmp_lang_str_manip_03 = explode('-', $tmp_lang_str_manip_02[0]);

                            $tmp_base = $tmp_lang_str_manip_03[0];
                            $tmp_region = $tmp_lang_str_manip_03[1];
                            $tmp_weight = $tmp_lang_str_manip_02[1];

                            $this->store_language_preference($tmp_base, $tmp_region, 'region');
                            $this->store_language_preference($tmp_base, $tmp_weight, 'weight');

                        }else{
                            //de;q=0.7
                            //*;q=0.5

                            $tmp_base = $tmp_lang_str_manip_02[0];
                            $tmp_weight = $tmp_lang_str_manip_02[1];

                            $this->store_language_preference($tmp_base, $tmp_weight, 'weight');

                        }

                    }else{
                        //fr-CH
                        $tmp_lang_str_manip_01 = explode('-', $value);
                        $tmp_base = $tmp_lang_str_manip_01[0];
                        $tmp_region = $tmp_lang_str_manip_01[1];

                        $this->store_language_preference($tmp_base, $tmp_region, 'region');

                    }

                }else{

                    if ($tmp_pos_weight !== false) {
                        // fr;q=0.9

                        $tmp_lang_str_manip_02 = explode(';q=', $value);

                        $tmp_base = $tmp_lang_str_manip_02[0];
                        $tmp_weight = $tmp_lang_str_manip_02[1];

                        $this->store_language_preference($tmp_base, $tmp_weight, 'weight');

                    }else{

                        //fr
                        $tmp_lang_pref_base_ARRAY[$value] = $value;
                        $this->store_language_preference($tmp_base);

                    }

                }

            }

        }else{

            if ($tmp_pos_dash !== false) {

                if ($tmp_pos_weight !== false) {
                    //zh-CN;q=0.8
                    //de;q=0.7
                    //*;q=0.5

                    $tmp_lang_str_manip_02 = explode(';q=', $header_accept_language);

                    $tmp_pos_dash02 = strpos($tmp_lang_str_manip_02[0],'-');

                    if ($tmp_pos_dash02 !== false) {
                        //zh-CN
                        $tmp_lang_str_manip_03 = explode('-', $tmp_lang_str_manip_02[0]);

                        $tmp_base = $tmp_lang_str_manip_03[0];
                        $tmp_region = $tmp_lang_str_manip_03[1];

                        $this->store_language_preference($tmp_base, $tmp_region, 'region');

                    }else{
                        //de;q=0.7
                        //*;q=0.5

                        $tmp_base = $tmp_lang_str_manip_02[0];
                        $tmp_weight = $tmp_lang_str_manip_02[1];

                        $this->store_language_preference($tmp_base, $tmp_weight, 'weight');

                    }

                }else{
                    //fr-CH
                    $tmp_lang_str_manip_01 = explode('-', $header_accept_language);
                    $tmp_base = $tmp_lang_str_manip_01[0];
                    $tmp_region = $tmp_lang_str_manip_01[1];

                    $this->store_language_preference($tmp_base, $tmp_region, 'region');

                }

            }else{

                if ($tmp_pos_weight !== false) {
                    // fr;q=0.9

                    $tmp_lang_str_manip_02 = explode(';q=', $header_accept_language);

                    $tmp_base = $tmp_lang_str_manip_02[0];
                    $tmp_weight = $tmp_lang_str_manip_02[1];

                    $this->store_language_preference($tmp_base, $tmp_weight, 'weight');

                }else{

                    //fr
                    $tmp_lang_pref_base_ARRAY[$header_accept_language] = $header_accept_language;
                    //error_log(__LINE__ . ' multi-lang [' . $header_accept_language . ']');

                    $this->store_language_preference($header_accept_language);

                }

            }

        }

        $tmp_lang_pref_complete_ARRAY = array();

        foreach (self::$lang_pref_seq_ARRAY as $index => $serialization){

            if(isset(self::$lang_pref_region_ARRAY[$serialization])){

                $tmp_lang_pref_complete_ARRAY[self::$lang_pref_base_ARRAY[$serialization]]['region'][] = self::$lang_pref_region_ARRAY[$serialization];

            }

            if(isset(self::$lang_pref_weight_ARRAY[$serialization])){

                $tmp_lang_pref_complete_ARRAY[self::$lang_pref_base_ARRAY[$serialization]]['weight'][] = self::$lang_pref_weight_ARRAY[$serialization];

            }

        }

        $i = 0;
        $tmp_region = $tmp_weight = '';
        $tmp_lang_flag = array();
        foreach (self::$lang_pref_seq_ARRAY as $index => $serialization){

            if(isset($tmp_lang_pref_complete_ARRAY[self::$lang_pref_base_ARRAY[$serialization]]['weight'])){

                if(count($tmp_lang_pref_complete_ARRAY[self::$lang_pref_base_ARRAY[$serialization]]['weight']) > 1){

                    $tmp_base = self::$lang_pref_base_ARRAY[$serialization];
                    if(isset($tmp_lang_pref_complete_ARRAY[self::$lang_pref_base_ARRAY[$serialization]]['region'][$i])){

                        $tmp_region = $tmp_lang_pref_complete_ARRAY[self::$lang_pref_base_ARRAY[$serialization]]['region'][$i];

                    }

                    if(isset($tmp_lang_pref_complete_ARRAY[self::$lang_pref_base_ARRAY[$serialization]]['weight'][$i])){

                        $tmp_weight = $tmp_lang_pref_complete_ARRAY[self::$lang_pref_base_ARRAY[$serialization]]['weight'][$i];

                    }

                    $i++;

                }else{

                    $tmp_base = self::$lang_pref_base_ARRAY[$serialization];

                    if(isset($tmp_lang_pref_complete_ARRAY[self::$lang_pref_base_ARRAY[$serialization]]['region'][0])){

                        $tmp_region = $tmp_lang_pref_complete_ARRAY[self::$lang_pref_base_ARRAY[$serialization]]['region'][0];

                    }

                    if(isset($tmp_lang_pref_complete_ARRAY[self::$lang_pref_base_ARRAY[$serialization]]['weight'][0])){

                        $tmp_weight = $tmp_lang_pref_complete_ARRAY[self::$lang_pref_base_ARRAY[$serialization]]['weight'][0];

                    }

                }

            }else{

                $tmp_base = self::$lang_pref_base_ARRAY[$serialization];

                if(isset($tmp_lang_pref_complete_ARRAY[self::$lang_pref_base_ARRAY[$serialization]]['region'][0])){

                    $tmp_region = $tmp_lang_pref_complete_ARRAY[self::$lang_pref_base_ARRAY[$serialization]]['region'][0];

                }

                if(isset($tmp_lang_pref_complete_ARRAY[self::$lang_pref_base_ARRAY[$serialization]]['weight'][0])){

                    $tmp_weight = $tmp_lang_pref_complete_ARRAY[self::$lang_pref_base_ARRAY[$serialization]]['weight'][0];

                }

            }

            if(!isset($tmp_lang_flag[md5($tmp_base)][md5($tmp_region)][md5($tmp_weight)])){

                if($tmp_region == '' && $tmp_weight == '' && isset($tmp_lang_flag[md5($tmp_base)])){


                }else{

                    //error_log(__LINE__ . ' multi-lang [' . $header_accept_language . '] [' . $tmp_base . '][' . $tmp_region . '][' . $tmp_weight . ']');
                    $this->load_language_preference($tmp_base , $tmp_region , $tmp_weight);

                }

                $tmp_lang_flag[md5($tmp_base)][md5($tmp_region)][md5($tmp_weight)] = 1;

            }

            $tmp_region = $tmp_weight = $tmp_base = '';

        }

    }

//	public function initialize_oCRNRSTN($oCRNRSTN){
//
//        $this->oCRNRSTN = $oCRNRSTN;
//
//        $this->country_iso_code = $this->oCRNRSTN->country_iso_code;
//
//        $header_language_attribute = $this->oCRNRSTN->return_client_header_value('Accept-Language');
//
//        $this->consume_accept_language_data($header_language_attribute);
//
//        //
//        // INSTANTIATE LOGGER
//        $this->oLogger = new crnrstn_logging(__CLASS__, $this->oCRNRSTN);
//
//    }

	public function get_lang_copy($message_key){

        //
        // WORRY NOT. THIS WILL BE DATABASE DRIVEN.
        switch($message_key) {
            case 'FOR_CONFIG_REFERENCE_PLEASE_SEE':

                switch($this->country_iso_code) {
                    case 'es':

                        break;
                    default:

                        //case 'en':
                        return 'For a quick reference on environmental configuration and detection, please see the demonstration below.';

                        break;

                }

                break;
            case 'FOR_REFERENCE_PLEASE_SEE':

                switch($this->country_iso_code) {
                    case 'es':

                    break;
                    default:

                        //case 'en':
                        return 'For a quick reference, please see the demonstration below.';

                    break;

                }

            break;
            case 'TO_COPY_THE_CHAR_SERIAL_TO_CLIPBOARD':

                switch($this->country_iso_code) {
                    case 'es':

                    break;
                    default:

                        //case 'en':
                        return 'char string to clipboard';

                    break;

                }

            break;
            case 'CLICK_HERE':

                switch($this->country_iso_code) {
                    case 'es':

                    break;
                    default:
                        //case 'en':

                        return 'Click here';

                    break;

                }

            break;
            case 'TO_COPY_THE_LINES_ABOVE_TO_CLIPBOARD':

                switch($this->country_iso_code) {
                    case 'es':

                    break;
                    default:
                        //case 'en':

                        return ' to copy the lines above to clipboard';

                    break;

                }

            break;
            case  'PLEASE_ENTER_VALID_ENV_DETECTION':

                switch($this->country_iso_code) {
                    case 'es':

                    break;
                    default:
                        //case 'en':

                        return 'To enable server detection, please configure C<span style="color:#F90000;">R</span>NRSTN :: for this 
environment within the configuration file.';

                    break;

                }

            break;
            case 'PLEASE_ENTER_A_CONFIG_SERIAL':

                switch($this->country_iso_code) {
                    case 'es':

                    break;
                    default:
                        //case 'en':

                        return 'Please specify a configuration serial in the C<span style="color:#F90000;">R</span>NRSTN :: config file.';

                    break;

                }

            break;
            case 'SYSTEM_IMAGE_SYNC_ENTER_JPG_PNG':

                switch($this->country_iso_code) {
                    case 'es':

                    break;
                    default:
                        //case 'en':

                        return 'Enter filename for PNG, JPG or base64';

                    break;

                }

            break;
            case 'UI_PRIMARY_NAV_ALT_MENU':

                switch($this->country_iso_code) {
                    case 'es':

                    break;
                    default:
                        //case 'en':

                        return 'Menu';

                    break;

                }

            break;
            case 'UI_PRIMARY_NAV_TITLE_MENU':

                switch($this->country_iso_code) {
                    case 'es':

                    break;
                    default:
                        //case 'en':

                        return 'Navigation to Menu';

                    break;

                }

            break;
            case 'UI_PRIMARY_NAV_ALT_CLOSE':

                switch($this->country_iso_code) {
                    case 'es':

                    break;
                    default:
                        //case 'en':

                        return 'Close';

                    break;

                }

            break;
            case 'UI_PRIMARY_NAV_TITLE_CLOSE':

                switch($this->country_iso_code) {
                    case 'es':

                    break;
                    default:
                        //case 'en':

                        return 'Navigation to Close';

                    break;

                }

            break;
            case 'UI_PRIMARY_NAV_ALT_FULLSCREEN':

                switch($this->country_iso_code) {
                    case 'es':

                    break;
                    default:
                        //case 'en':

                        return 'Full Screen';

                    break;

                }

            break;
            case 'UI_PRIMARY_NAV_TITLE_FULLSCREEN':

                switch($this->country_iso_code) {
                    case 'es':

                    break;
                    default:
                        //case 'en':

                        return 'Navigation to Full Screen';

                    break;

                }

            break;
            case 'UI_PRIMARY_NAV_ALT_MINIMIZE':

                switch($this->country_iso_code) {
                    case 'es':

                    break;
                    default:
                        //case 'en':

                        return 'Minimize';

                    break;

                }

            break;
            case 'UI_PRIMARY_NAV_TITLE_MINIMIZE':

                switch($this->country_iso_code) {
                    case 'es':

                    break;
                    default:
                        //case 'en':

                        return 'Navigation to Minimize';

                    break;

                }

            break;
            case 'UI_PRIMARY_NAV_ALT_FIVEDEV':

                switch($this->country_iso_code) {
                    case 'es':

                        break;
                    default:
                        //case 'en':

                        return '5';

                        break;

                }

            break;
            case 'UI_PRIMARY_NAV_TITLE_FIVEDEV':

                switch($this->country_iso_code) {
                    case 'es':

                    break;
                    default:
                        //case 'en':

                        return 'eVifweb development';

                    break;

                }

            break;
            case 'FORM_LNK_TXT_EULA':

                switch($this->country_iso_code) {
                    case 'es':

                    break;
                    default:
                        //case 'en':

                        return 'EULA';

                    break;

                }

            break;
            case 'CHKBX_TEXT_PROCESS_TO_BATCH':

                switch($this->country_iso_code) {
                    case 'es':

                    break;
                    default:
                        //case 'en':

                        return 'Process to batch';

                    break;

                }

            break;
            case 'FORM_BUTTON_TEXT_CONNECT':

                switch($this->country_iso_code) {
                    case 'es':

                    break;
                    default:
                        //case 'en':

                        return 'connect';

                    break;

                }

            break;
            case 'FORM_LABEL_PASSWORD_OPTIONAL':

                switch($this->country_iso_code) {
                    case 'es':

                    break;
                    default:
                        //case 'en':

                        return 'password (optional)';

                    break;

                }

            break;
            case  'FORM_LABEL_USERNAME':

                switch($this->country_iso_code) {
                    case 'es':

                    break;
                    default:
                        //case 'en':

                        return 'username';

                    break;

                }

            break;
            case 'TEXT_PLACEHOLDER_CHAR_COUNT':

                switch($this->country_iso_code) {
                    case 'es':

                    break;
                    default:
                        //case 'en':

                        return 'Enter char count';

                    break;

                }
            break;
            case 'BUTTON_TEXT_SUBMIT':

                switch($this->country_iso_code) {
                    case 'es':

                    break;
                    default:
                        //case 'en':

                        return 'Submit';

                    break;

                }

            break;
            case 'BUTTON_TEXT_ADD':

                switch($this->country_iso_code) {
                    case 'es':

                    break;
                    default:
                        //case 'en':

                        return 'Add';

                    break;

                }

            break;
            case 'CRNRSTN_SESSION_INACTIVE_EXPIRE':

                switch($this->country_iso_code) {
                    case 'es':

                    break;
                    default:
                        //case 'en':

                        return 'The session has expired due to inactivity exceeding x seconds.';

                    break;

                }

            break;
            case 'EMAIL_REQUIRED':

                switch($this->country_iso_code) {
                    case 'es':

                    break;
                    default:
                        //case 'en':

                        return 'Email is required.';

                    break;

                }

            break;
            case 'PASSWORD_REQUIRED':

                switch($this->country_iso_code) {
                    case 'es':

                    break;
                    default:
                        //case 'en':

                        return 'Password is required.';

                    break;

                }

            break;
            case 'INPUT_LABEL_PASSWORD':
                switch($this->country_iso_code) {
                    case 'es':

                        break;
                    default:
                        //case 'en':

                        return 'password';

                        break;

                }

            break;
            case 'INPUT_LABEL_EMAIL':
                switch($this->country_iso_code) {
                    case 'es':

                    break;
                    default:
                        //case 'en':

                        return 'email';

                    break;

                }

            break;
            case 'BTN_TEXT_SIGN_IN':
                switch($this->country_iso_code) {
                    case 'es':

                        break;
                    default:
                        //case 'en':

                        return 'SIGN IN';

                        break;

                }

            break;
            case 'COPY_PART1_NEED_TO':
                switch($this->country_iso_code) {
                    case 'es':

                        break;
                    default:
                        //case 'en':

                        return 'Need to';

                        break;

                }

            break;
            case 'COPY_PART2_CREATE_ACCOUNT':
                switch($this->country_iso_code) {
                    case 'es':

                    break;
                    default:
                        //case 'en':

                        return 'create an account';

                    break;

                }

            break;
            case 'COPY_PART_x_OR':
                switch($this->country_iso_code) {
                    case 'es':

                    break;
                    default:
                        //case 'en':

                        return 'or';

                    break;

                }

            break;
            case 'COPY_PART3_FORGET_PWD':
                switch($this->country_iso_code) {
                    case 'es':

                    break;
                    default:
                        //case 'en':

                        return 'forget your password';

                break;

                }

            break;
            case 'COPY_YOUR_IP':
                switch($this->country_iso_code) {
                    case 'es':

                    break;
                    default:
                        //case 'en':

                        return 'Your IP';

                    break;

                }

            break;
            case 'COPY_LOGIN_ATTEMPTS':
                switch($this->country_iso_code) {
                    case 'es':

                    break;
                    default:
                        //case 'en':

                        return 'Login attempts';

                    break;

                }

            break;
            case 'COPY_ATTEMPTS_REMAINING':
                switch($this->country_iso_code) {
                    case 'es':

                    break;
                    default:
                        //case 'en':

                        return 'Attempts remaining';

                    break;

                }

            break;
            case 'COPY_ALL_RIGHTS_PART1':
                switch($this->country_iso_code) {
                    case 'es':

                    break;
                    default:
                        //case 'en':

                        return 'All Rights Reserved in accordance with';

                    break;

                }

            break;
            case 'COPY_ALL_RIGHTS_PART2':
                switch($this->country_iso_code) {
                    case 'es':

                    break;
                    default:
                        //case 'en':

                        return 'the latest version of the';

                    break;

                }

            break;
            case 'COPY_ALL_RIGHTS_PART_MIT':
                switch($this->country_iso_code) {
                    case 'es':

                    break;
                    default:
                        //case 'en':

                        return 'MIT License';

                    break;

                }

            break;

        }

        return NULL;

    }



    public function __destruct() {

	}

}