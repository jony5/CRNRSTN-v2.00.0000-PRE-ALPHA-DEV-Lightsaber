<?php
/*
// J5
// Code is Poetry */

/*
//
// Therefore thus says Jehovah,
//   If you return, I will restore you;
// You will stand before Me;
//   And if you bring out the precious from the worthless,
// You will be as My mouth;
//   They will turn to you,
//   But you will not turn to them.
// And I will make you to this people
//   A fortified wall of bronze;
// And they will fight against you,
//   But they will not prevail against you;
// For I am with you
//   To save you and deliver you,
//   Declares Jehovah.
// And I will deliver you from the hand of the wicked
//   And redeem you from the hand of those who terrorize.
//
// - Jeremiah 15:19-21
//
// CLASS :: bringer_of_the_precious_things
// AUTHOR :: Jonathan 'J5' Harris <jharris@evifweb.com>
// VERSION :: 1.0.0
// DATE :: 4.5.2019 1519 hrs
*/
class bringer_of_the_precious_things {

    private static $oLogger;
    private static $oEnv;
    public $oCRNRSTN_USR;

    public $vvid;
    public $starttime;
    private static $vvid_is_grouped = false;
    private static $bytes_processed = 0;
    private static $mbstring_func_overload = false;
    private static $valid_session = false;

    public function __construct($oCRNRSTN_USR, $page = 'home'){

        try{

            $this->starttime = $_SERVER['REQUEST_TIME_FLOAT'];

            if(get_class($oCRNRSTN_USR) == 'crnrstn_user'){

                $this->oCRNRSTN_USR = $oCRNRSTN_USR;

                self::$oLogger = new crnrstn_logging($this->oCRNRSTN_USR->CRNRSTN_debugMode, __CLASS__, $this->oCRNRSTN_USR->log_silo_profile, $this->oCRNRSTN_USR);
                self::$oEnv = $oCRNRSTN_USR->return_oCRNRSTN_ENV();

            }else{

                self::$oEnv = $oCRNRSTN_USR;

                //
                // INSTANTIATE LOGGER
                self::$oLogger = new crnrstn_logging();

            }

            if(self::$oEnv->oHTTP_MGR->issetHTTP($_GET)){

                if(self::$oEnv->oHTTP_MGR->extractData($_GET,'vv') != ""){

                    $this->vvid = self::$oEnv->oHTTP_MGR->extractData($_GET,'vv');
                    //error_log(__LINE__ . ' pfw vvid[' . $this->vvid . '].');

                }

            }else{

                if($page != 'home') {

                    $this->vvid = self::$oEnv->oHTTP_MGR->extractData($_GET, 'vv');
                    //error_log('issetHTTP returned FALSE for meta-key vvid['.$this->vvid.'] concerning requested preciousness.');

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('issetHTTP returned FALSE for meta-key vvid['.$this->vvid.'] concerning requested preciousness.');

                }

            }

            if(ini_get('mbstring.func_overload') > 0){

                self::$mbstring_func_overload = true;

            }

        }catch(Exception $e){

            //
            // SEND THIS THROUGH THE LOGGER OBJECT
            if(isset($this->oCRNRSTN_USR)){

                $this->oCRNRSTN_USR->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

            }else{

                self::$oLogger->captureNotice('bringer_of_the_precious_things->__construct()', LOG_EMERG, $e->getMessage());

            }

        }

    }

    private function search_optimized_content($ugc_str){

        $tmp_search_meta_ARRAY = array();

        /*
        $tmp_search_meta_ARRAY[] = array('rev21_3-5' => '{IMAGE_PREVIEW_SALT}', 'rev21_21' => '{IMAGE_PREVIEW_SALT}', 'rev22_2' => '{IMAGE_PREVIEW_SALT}');

        case 'psa97_2':

            $tmp_verse_array['REFERENCE'][0]        = '97:2';
            $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'Clouds and deep darkness surround Him; Righteousness and justice are the foundation of His throne.';
            $tmp_verse_array['COPY'][0]             = 'Clouds and deep darkness surround Him;<br>
            &nbsp;&nbsp;&nbsp;Righteousness and justice are the foundation of His throne.';

        break;

        $tmp_link_vvid_ARRAY[] = array(array('1kings2_1-3' => '1 Kings 2:1-3'));
        $tmp_link_vvid_ARRAY[] = array(array('1kings18_37-40,45;19_1-18' => '1 Kings 18:37-40, 45; 19:1-18'));
        $tmp_link_vvid_ARRAY[] = array(array('1sam4_4' => '1 Samuel 4:4'));
        $tmp_link_vvid_ARRAY[] = array(array('psa97_2' => 'Psalm 97:2'));

        */

        return $tmp_search_meta_ARRAY;

    }

    private function return_search_controller_static_struct($data_key = 'SCRIPTURES'){

        $tmp_output_ARRAY = array();
        $tmp_search_meta_ARRAY = array();

        switch($data_key){
            case 'JONY5':
                
                //
                // PUSH ALL CUSTOM CONTENT
                // CONTENT_IDS FOR STATIC
                // SEARCH SUPPORT.
                //
                // PAGE URL:                https://jony5.com/?scroll=welcome
                // DATA CAPTURE ENDPOINT:   https://jony5.com/search/
                // DATE CREATED:            2024-03-03 20:17:19.788213
                // CLIENT IP:               104.15.178.8
                // SESSION ID:              99869f0a88f39cb430de9334cec4ef4e
                $tmp_search_meta_ARRAY[] = array(
                    array('SEARCH_CONTENT'                => 'WelcomeImJonathanJ5HarrisRev3713Gen4912528Deut33141229Isa1615Dan91727Matt24152224814James312Num25113Jer11119Luke123444awebprofessionallivingandworkinginAtlantaGAWith6yearsofsolidagencyexperience18yearsofprogrammingexperienceinopensourcewebtechnologiesbehindmeIamalwaysopentoinvestigatefreshopportunitiestoworkwithactivegrowinganddigitallyfueledcompaniesinordertostrengthenandbroadenaspectsoftheirserviceofferingsfromatechnicalperspectiveFormypreviousemployerIworkedwithcorporateclientstoformulateandexecutewithmyownbarehandsinthecodewhenevernecessarymultichannelbusinessmarketinginitiativesDigitalbrandstrategyandexecutionaremycorecompetenciesIn2004IworkedasafreelancedesignerwebapplicationdeveloperandserialentrepreneurAftertheimplosionofmy8personstartupcompanyCommercialNetIncIenteredtheworldofinteractivemarketingandadvertisingbyacceptingaUIdeveloperpositionwiththeAtlantabasedagencyMoxieIn2007IhelpedatalentedanddiverseteamofpeopleatMoxietostarttheeCRMdepartmentLeadbyDarrylBolducTinaWestandSapanaNanuwaandwithover50yearsofcombinedemailmarketingexperienceweworkedwithourclientstodesignandexecutebothawardwinningandstateoftheartemailmarketingprogramsinsupportoftheirglobalstrategicinitiativesBornonNov10th2005mydognamedJ5properispartKoreanJindoGermanShepherdandTimberWolfGalleryWhenIworkedatagencyJ5accompaniedmetotheofficeonoccasionaswellastolocalparkscoffeeshopsneighborhoodbarsandeventheoccasionalhousepartyOnthemorningofMondayAug162021at0345hrsandwhilelayingundermyarmJ5wentthewayofalltheearth1Kings213evenwithmuchencouragementandcelebrationfrommebyhissideInthewoodsbehindmyhouseinthedarkofnightat0500hrsasIwasreturningJ5totheearthfromwhencehecamewhilstshovelingthedirtbackinplaceIthankedhimrepeatedlyforeverythinghegavetomeduringoursojourntogetheruponthefaceoftheearthinthisGodsoldcreationIthankedhimforbringingmeintopracticalparticipationwithandintothepropheticfulfillmentoftheblessingsofIsraeltohistwelvesonsGen4821224912528whichareforallofthepeopleofGodacrossallspaceandalltimeEvenallthenationsoftheearthwillbeblessedThebonefromhislastwholesteaka100raretomahawkribeyefromRuthsChrisisstillclutchedagainsthischestinthearmofhisfrontrightpawLaterIcametorealizethatIburiedhimfacingtowardsthedirectionoftherisingofthesuntotheeastClickheretodownloadthelatestversionofmyresumeorvisitmyLinkedInprofile'),
                    array('SOCIAL_PREVIEW_IMAGE_HTTP'     => 'https://jony5.com/common/imgs/social_share/preview/jony5_social_preview_00.png?vers=876321.1674187423.0'),
                    array('RESOURCE_ENDPOINT_URI'         => 'https://jony5.com/?scroll=welcome')
                );

            break;
            case 'SCRIPTURES':

                //
                // Thursday, February 29, 2024 @ 1632 hrs.
                // FOR THE GENERATION OF A NEW MASTER CONTROL
                // STRUCTURE (THIS STRUCT DRIVES SEARCH),
                // PLEASE SEE, THE INSTRUCTIONS LOCATED
                // WITHIN, $this->build_link_html_index(), AND
                // TITLED: "HOW TO GET MORE DATA INTO SEARCH ::".
                $tmp_search_meta_ARRAY[] = array('jehovah_has_revealed_dl' => 'capoiv');
                $tmp_search_meta_ARRAY[] = array('jehovah_has_revealed_audio' => 'capoiv');
                $tmp_search_meta_ARRAY[] = array('jehovah_has_revealed_chords' => 'capoiv');
                $tmp_search_meta_ARRAY[] = array('jehovah_has_revealed' => 'capoiv');
                $tmp_search_meta_ARRAY[] = array('hymn979' => 'hymns');
                $tmp_search_meta_ARRAY[] = array('gen1_1' => 'genesis');
                $tmp_search_meta_ARRAY[] = array('gen1_26' => 'genesis');
                $tmp_search_meta_ARRAY[] = array('gen2_7' => 'genesis');
                $tmp_search_meta_ARRAY[] = array('gen3_1' => 'genesis');
                $tmp_search_meta_ARRAY[] = array('gen3_14[COVID]' => 'genesis');
                $tmp_search_meta_ARRAY[] = array('gen3_14[solo]' => 'genesis');
                $tmp_search_meta_ARRAY[] = array('gen3_14' => 'genesis');
                $tmp_search_meta_ARRAY[] = array('gen26_4-5' => 'genesis');
                $tmp_search_meta_ARRAY[] = array('gen48_21-22|49_1,25-28' => 'genesis');
                $tmp_search_meta_ARRAY[] = array('gen49_1,25-28' => 'genesis');
                $tmp_search_meta_ARRAY[] = array('lifestudy_exo_156' => 'lifestudyofexodus');
                $tmp_search_meta_ARRAY[] = array('exo9_29' => 'exodus');
                $tmp_search_meta_ARRAY[] = array('exo15_26' => 'exodus');
                $tmp_search_meta_ARRAY[] = array('exo20_6' => 'exodus');
                $tmp_search_meta_ARRAY[] = array('exo20_13' => 'exodus');
                $tmp_search_meta_ARRAY[] = array('exo20_15' => 'exodus');
                $tmp_search_meta_ARRAY[] = array('exo30_18' => 'exodus');
                $tmp_search_meta_ARRAY[] = array('exo30_17-21' => 'exodus');
                $tmp_search_meta_ARRAY[] = array('lev2_1' => 'leviticus');
                $tmp_search_meta_ARRAY[] = array('lev18_1-5,24-28' => 'leviticus');
                $tmp_search_meta_ARRAY[] = array('lev26_3-13' => 'leviticus');
                $tmp_search_meta_ARRAY[] = array('lev26_3,11b-12' => 'leviticus');
                $tmp_search_meta_ARRAY[] = array('num14_31' => 'numbers');
                $tmp_search_meta_ARRAY[] = array('num14_31[000]' => 'numbers');
                $tmp_search_meta_ARRAY[] = array('num14_29-30' => 'numbers');
                $tmp_search_meta_ARRAY[] = array('num14_35' => 'numbers');
                $tmp_search_meta_ARRAY[] = array('num25_1-13' => 'numbers');
                $tmp_search_meta_ARRAY[] = array('num32_13' => 'numbers');
                $tmp_search_meta_ARRAY[] = array('num33_50-54' => 'numbers');
                $tmp_search_meta_ARRAY[] = array('deut4_1-2,39-40' => 'deuteronomy');
                $tmp_search_meta_ARRAY[] = array('deut5_10,29' => 'deuteronomy');
                $tmp_search_meta_ARRAY[] = array('deut6_1-6,16-25' => 'deuteronomy');
                $tmp_search_meta_ARRAY[] = array('deut6_25' => 'deuteronomy');
                $tmp_search_meta_ARRAY[] = array('deut7_9-26' => 'deuteronomy');
                $tmp_search_meta_ARRAY[] = array('deut8_1-10' => 'deuteronomy');
                $tmp_search_meta_ARRAY[] = array('deut10_14-22' => 'deuteronomy');
                $tmp_search_meta_ARRAY[] = array('deut11_14' => 'deuteronomy');
                $tmp_search_meta_ARRAY[] = array('deut11_1,8-15,22-28' => 'deuteronomy');
                $tmp_search_meta_ARRAY[] = array('deut26_16-19' => 'deuteronomy');
                $tmp_search_meta_ARRAY[] = array('deut28_1-14' => 'deuteronomy');
                $tmp_search_meta_ARRAY[] = array('deut30_11-20' => 'deuteronomy');
                $tmp_search_meta_ARRAY[] = array('deut33_1-4,12,29' => 'deuteronomy');
                $tmp_search_meta_ARRAY[] = array('josh5_6' => 'joshua');
                $tmp_search_meta_ARRAY[] = array('1sam4_4' => '1samuel');
                $tmp_search_meta_ARRAY[] = array('1kings2_1-3' => '1kings');
                $tmp_search_meta_ARRAY[] = array('1kings8_54-66' => '1kings');
                $tmp_search_meta_ARRAY[] = array('1kings18_37-40,45;19_1-18' => '1kings');
                $tmp_search_meta_ARRAY[] = array('neh1_1-11' => 'nehemiah');
                $tmp_search_meta_ARRAY[] = array('psa24' => 'psalms');
                $tmp_search_meta_ARRAY[] = array('psa95_10-11' => 'psalms');
                $tmp_search_meta_ARRAY[] = array('psa97_2' => 'psalms');
                $tmp_search_meta_ARRAY[] = array('psa119_103' => 'psalms');
                $tmp_search_meta_ARRAY[] = array('prov20_27' => 'proverbs');
                $tmp_search_meta_ARRAY[] = array('isa14_13' => 'isaiah');
                $tmp_search_meta_ARRAY[] = array('isa14_21-24' => 'isaiah');
                $tmp_search_meta_ARRAY[] = array('isa16_1-5' => 'isaiah');
                $tmp_search_meta_ARRAY[] = array('isa53_6' => 'isaiah');
                $tmp_search_meta_ARRAY[] = array('jer1_11-19' => 'jeremiah');
                $tmp_search_meta_ARRAY[] = array('jer24_7' => 'jeremiah');
                $tmp_search_meta_ARRAY[] = array('jer31_31-34' => 'jeremiah');
                $tmp_search_meta_ARRAY[] = array('jer31_33-34' => 'jeremiah');
                $tmp_search_meta_ARRAY[] = array('jer31_33-37' => 'jeremiah');
                $tmp_search_meta_ARRAY[] = array('jer31_31-37' => 'jeremiah');
                $tmp_search_meta_ARRAY[] = array('ezek11_17-25' => 'ezekiel');
                $tmp_search_meta_ARRAY[] = array('dan9_4' => 'daniel');
                $tmp_search_meta_ARRAY[] = array('dan9_17-27' => 'daniel');
                $tmp_search_meta_ARRAY[] = array('joel2_23' => 'joel');
                $tmp_search_meta_ARRAY[] = array('matt1_18,20' => 'matthew');
                $tmp_search_meta_ARRAY[] = array('matt2_4-6' => 'matthew');
                $tmp_search_meta_ARRAY[] = array('matt3_15' => 'matthew');
                $tmp_search_meta_ARRAY[] = array('matt4_1-2' => 'matthew');
                $tmp_search_meta_ARRAY[] = array('matt4_3' => 'matthew');
                $tmp_search_meta_ARRAY[] = array('matt4_4b' => 'matthew');
                $tmp_search_meta_ARRAY[] = array('matt4_5-7' => 'matthew');
                $tmp_search_meta_ARRAY[] = array('matt5_10' => 'matthew');
                $tmp_search_meta_ARRAY[] = array('matt5_13' => 'matthew');
                $tmp_search_meta_ARRAY[] = array('matt5' => 'matthew');
                $tmp_search_meta_ARRAY[] = array('matt6' => 'matthew');
                $tmp_search_meta_ARRAY[] = array('matt7' => 'matthew');
                $tmp_search_meta_ARRAY[] = array('matt7_13-14' => 'matthew');
                $tmp_search_meta_ARRAY[] = array('matt10_10b' => 'matthew');
                $tmp_search_meta_ARRAY[] = array('matt10_16-33' => 'matthew');
                $tmp_search_meta_ARRAY[] = array('matt11_28-30' => 'matthew');
                $tmp_search_meta_ARRAY[] = array('matt12_1-8' => 'matthew');
                $tmp_search_meta_ARRAY[] = array('matt12_5' => 'matthew');
                $tmp_search_meta_ARRAY[] = array('matt13_4' => 'matthew');
                $tmp_search_meta_ARRAY[] = array('matt16_25-26' => 'matthew');
                $tmp_search_meta_ARRAY[] = array('matt19_12' => 'matthew');
                $tmp_search_meta_ARRAY[] = array('matt24_8-14' => 'matthew');
                $tmp_search_meta_ARRAY[] = array('matt24_14' => 'matthew');
                $tmp_search_meta_ARRAY[] = array('matt24_15-22' => 'matthew');
                $tmp_search_meta_ARRAY[] = array('matt25_4' => 'matthew');
                $tmp_search_meta_ARRAY[] = array('matt25_23,10b' => 'matthew');
                $tmp_search_meta_ARRAY[] = array('matt26_33-35,69-75' => 'matthew');
                $tmp_search_meta_ARRAY[] = array('matt27_46' => 'matthew');
                $tmp_search_meta_ARRAY[] = array('mark7_19-23' => 'mark');
                $tmp_search_meta_ARRAY[] = array('mark9_50' => 'mark');
                $tmp_search_meta_ARRAY[] = array('mark14_27-31,66-72' => 'mark');
                $tmp_search_meta_ARRAY[] = array('luke1_26-33' => 'luke');
                $tmp_search_meta_ARRAY[] = array('luke9_1-6' => 'luke');
                $tmp_search_meta_ARRAY[] = array('luke9_5-6' => 'luke');
                $tmp_search_meta_ARRAY[] = array('luke10_19' => 'luke');
                $tmp_search_meta_ARRAY[] = array('luke12_35' => 'luke');
                $tmp_search_meta_ARRAY[] = array('luke12_34-44' => 'luke');
                $tmp_search_meta_ARRAY[] = array('luke13_17' => 'luke');
                $tmp_search_meta_ARRAY[] = array('luke14_31-32' => 'luke');
                $tmp_search_meta_ARRAY[] = array('luke14_34-35' => 'luke');
                $tmp_search_meta_ARRAY[] = array('luke18_11-12' => 'luke');
                $tmp_search_meta_ARRAY[] = array('luke18_13' => 'luke');
                $tmp_search_meta_ARRAY[] = array('luke19_12,14,15,27' => 'luke');
                $tmp_search_meta_ARRAY[] = array('luke22_24-30' => 'luke');
                $tmp_search_meta_ARRAY[] = array('luke22_33-34,54-62' => 'luke');
                $tmp_search_meta_ARRAY[] = array('luke22_42' => 'luke');
                $tmp_search_meta_ARRAY[] = array('luke22_42[solo]' => 'luke');
                $tmp_search_meta_ARRAY[] = array('luke23_27-30' => 'luke');
                $tmp_search_meta_ARRAY[] = array('luke23_38,42-43' => 'luke');
                $tmp_search_meta_ARRAY[] = array('luke24_31-32' => 'luke');
                $tmp_search_meta_ARRAY[] = array('john2_20-21' => 'john');
                $tmp_search_meta_ARRAY[] = array('john2_21' => 'john');
                $tmp_search_meta_ARRAY[] = array('john5_24-25' => 'john');
                $tmp_search_meta_ARRAY[] = array('john8_1-11' => 'john');
                $tmp_search_meta_ARRAY[] = array('john8_6' => 'john');
                $tmp_search_meta_ARRAY[] = array('john8_51-59' => 'john');
                $tmp_search_meta_ARRAY[] = array('john9_41' => 'john');
                $tmp_search_meta_ARRAY[] = array('john13_3-17' => 'john');
                $tmp_search_meta_ARRAY[] = array('john13_34' => 'john');
                $tmp_search_meta_ARRAY[] = array('john13_34[solo]' => 'john');
                $tmp_search_meta_ARRAY[] = array('john13_37-38' => 'john');
                $tmp_search_meta_ARRAY[] = array('john13_37-38;18_14-27' => 'john');
                $tmp_search_meta_ARRAY[] = array('john14_10' => 'john');
                $tmp_search_meta_ARRAY[] = array('john14_10-14' => 'john');
                $tmp_search_meta_ARRAY[] = array('john14_12-14' => 'john');
                $tmp_search_meta_ARRAY[] = array('john14_15,20-21' => 'john');
                $tmp_search_meta_ARRAY[] = array('john16_15' => 'john');
                $tmp_search_meta_ARRAY[] = array('acts1_5' => 'acts');
                $tmp_search_meta_ARRAY[] = array('acts2_22-25' => 'acts');
                $tmp_search_meta_ARRAY[] = array('acts8_29' => 'acts');
                $tmp_search_meta_ARRAY[] = array('acts10_15-16b,19-21' => 'acts');
                $tmp_search_meta_ARRAY[] = array('acts16_6,7' => 'acts');
                $tmp_search_meta_ARRAY[] = array('acts11_12' => 'acts');
                $tmp_search_meta_ARRAY[] = array('acts11_18' => 'acts');
                $tmp_search_meta_ARRAY[] = array('rom2_6-7' => 'romans');
                $tmp_search_meta_ARRAY[] = array('rom5_1-5[000]' => 'romans');
                $tmp_search_meta_ARRAY[] = array('rom5_1-5' => 'romans');
                $tmp_search_meta_ARRAY[] = array('rom5_10' => 'romans');
                $tmp_search_meta_ARRAY[] = array('rom5_14,17,21' => 'romans');
                $tmp_search_meta_ARRAY[] = array('rom6_3' => 'romans');
                $tmp_search_meta_ARRAY[] = array('rom6_8' => 'romans');
                $tmp_search_meta_ARRAY[] = array('rom6_8-11' => 'romans');
                $tmp_search_meta_ARRAY[] = array('rom6_9-11' => 'romans');
                $tmp_search_meta_ARRAY[] = array('rom6_18-19[000]' => 'romans');
                $tmp_search_meta_ARRAY[] = array('rom6_18-19' => 'romans');
                $tmp_search_meta_ARRAY[] = array('rom6_22' => 'romans');
                $tmp_search_meta_ARRAY[] = array('rom7_2-4,6' => 'romans');
                $tmp_search_meta_ARRAY[] = array('rom8_2' => 'romans');
                $tmp_search_meta_ARRAY[] = array('rom8_2,4' => 'romans');
                $tmp_search_meta_ARRAY[] = array('rom8_14' => 'romans');
                $tmp_search_meta_ARRAY[] = array('rom8_16-17,24-25' => 'romans');
                $tmp_search_meta_ARRAY[] = array('rom8_14-23' => 'romans');
                $tmp_search_meta_ARRAY[] = array('rom8_33-39' => 'romans');
                $tmp_search_meta_ARRAY[] = array('rom9_31-33' => 'romans');
                $tmp_search_meta_ARRAY[] = array('rom10_2-3' => 'romans');
                $tmp_search_meta_ARRAY[] = array('rom12_2' => 'romans');
                $tmp_search_meta_ARRAY[] = array('rom12_11' => 'romans');
                $tmp_search_meta_ARRAY[] = array('rom12_11-12' => 'romans');
                $tmp_search_meta_ARRAY[] = array('rom13_14' => 'romans');
                $tmp_search_meta_ARRAY[] = array('rom14_1' => 'romans');
                $tmp_search_meta_ARRAY[] = array('rom14_7-12' => 'romans');
                $tmp_search_meta_ARRAY[] = array('rom15_4[000]' => 'romans');
                $tmp_search_meta_ARRAY[] = array('rom15_4' => 'romans');
                $tmp_search_meta_ARRAY[] = array('1cor1_22-25' => '1corinthians');
                $tmp_search_meta_ARRAY[] = array('1cor3_21-23' => '1corinthians');
                $tmp_search_meta_ARRAY[] = array('1cor5_1,5' => '1corinthians');
                $tmp_search_meta_ARRAY[] = array('1cor6_12' => '1corinthians');
                $tmp_search_meta_ARRAY[] = array('1cor6_17' => '1corinthians');
                $tmp_search_meta_ARRAY[] = array('1cor9_8-11,13' => '1corinthians');
                $tmp_search_meta_ARRAY[] = array('1cor10_5' => '1corinthians');
                $tmp_search_meta_ARRAY[] = array('1cor10_23' => '1corinthians');
                $tmp_search_meta_ARRAY[] = array('1cor10_26,29b-31' => '1corinthians');
                $tmp_search_meta_ARRAY[] = array('1cor11_4' => '1corinthians');
                $tmp_search_meta_ARRAY[] = array('1cor15_58' => '1corinthians');
                $tmp_search_meta_ARRAY[] = array('1cor15_55,58' => '1corinthians');
                $tmp_search_meta_ARRAY[] = array('2cor1_9-10' => '2corinthians');
                $tmp_search_meta_ARRAY[] = array('2cor1_20-22[000]' => '2corinthians');
                $tmp_search_meta_ARRAY[] = array('2cor1_20-22' => '2corinthians');
                $tmp_search_meta_ARRAY[] = array('2cor3_6-9' => '2corinthians');
                $tmp_search_meta_ARRAY[] = array('2cor3_12' => '2corinthians');
                $tmp_search_meta_ARRAY[] = array('2cor3_12,17' => '2corinthians');
                $tmp_search_meta_ARRAY[] = array('2cor11_2a' => '2corinthians');
                $tmp_search_meta_ARRAY[] = array('2cor11_2b-3' => '2corinthians');
                $tmp_search_meta_ARRAY[] = array('1cor11_22' => '1corinthians');
                $tmp_search_meta_ARRAY[] = array('2cor3_3' => '2corinthians');
                $tmp_search_meta_ARRAY[] = array('2cor3_17-18' => '2corinthians');
                $tmp_search_meta_ARRAY[] = array('2cor3_18' => '2corinthians');
                $tmp_search_meta_ARRAY[] = array('gal1_14' => 'galatians');
                $tmp_search_meta_ARRAY[] = array('gal2_20' => 'galatians');
                $tmp_search_meta_ARRAY[] = array('gal2_20_x' => 'galatians');
                $tmp_search_meta_ARRAY[] = array('gal3_1' => 'galatians');
                $tmp_search_meta_ARRAY[] = array('gal5_1,7' => 'galatians');
                $tmp_search_meta_ARRAY[] = array('gal5_1' => 'galatians');
                $tmp_search_meta_ARRAY[] = array('gal5_5-6' => 'galatians');
                $tmp_search_meta_ARRAY[] = array('gal4_11' => 'galatians');
                $tmp_search_meta_ARRAY[] = array('gal5_13,16' => 'galatians');
                $tmp_search_meta_ARRAY[] = array('gal5_16,18,22-23,25' => 'galatians');
                $tmp_search_meta_ARRAY[] = array('gal6_14' => 'galatians');
                $tmp_search_meta_ARRAY[] = array('eph1_3' => 'ephesians');
                $tmp_search_meta_ARRAY[] = array('eph1_3-12' => 'ephesians');
                $tmp_search_meta_ARRAY[] = array('eph1_3-14[000]' => 'ephesians');
                $tmp_search_meta_ARRAY[] = array('eph1_3-14' => 'ephesians');
                $tmp_search_meta_ARRAY[] = array('eph1_9' => 'ephesians');
                $tmp_search_meta_ARRAY[] = array('eph1_9-14,18-23' => 'ephesians');
                $tmp_search_meta_ARRAY[] = array('phil1_6' => 'philippians');
                $tmp_search_meta_ARRAY[] = array('phil1_20' => 'philippians');
                $tmp_search_meta_ARRAY[] = array('phil1_27' => 'philippians');
                $tmp_search_meta_ARRAY[] = array('phil2_3' => 'philippians');
                $tmp_search_meta_ARRAY[] = array('phil2_5-8' => 'philippians');
                $tmp_search_meta_ARRAY[] = array('phil2_5-16[000]' => 'philippians');
                $tmp_search_meta_ARRAY[] = array('phil2_5-16' => 'philippians');
                $tmp_search_meta_ARRAY[] = array('phil2_5-9' => 'philippians');
                $tmp_search_meta_ARRAY[] = array('phil2_8' => 'philippians');
                $tmp_search_meta_ARRAY[] = array('phil2_13[001]' => 'philippians');
                $tmp_search_meta_ARRAY[] = array('phil2_13[000]' => 'philippians');
                $tmp_search_meta_ARRAY[] = array('phil2_13' => 'philippians');
                $tmp_search_meta_ARRAY[] = array('col1_5' => 'colossians');
                $tmp_search_meta_ARRAY[] = array('col1_27' => 'colossians');
                $tmp_search_meta_ARRAY[] = array('col1_5-6,21-23,26-27' => 'colossians');
                $tmp_search_meta_ARRAY[] = array('col1_16' => 'colossians');
                $tmp_search_meta_ARRAY[] = array('col2_9' => 'colossians');
                $tmp_search_meta_ARRAY[] = array('col2_8,12,20-23' => 'colossians');
                $tmp_search_meta_ARRAY[] = array('col3_5' => 'colossians');
                $tmp_search_meta_ARRAY[] = array('col3_6' => 'colossians');
                $tmp_search_meta_ARRAY[] = array('1thes1_2-3' => '1thessalonians');
                $tmp_search_meta_ARRAY[] = array('1thes5_7-11' => '1thessalonians');
                $tmp_search_meta_ARRAY[] = array('2thes2_8-12' => '2thessalonians');
                $tmp_search_meta_ARRAY[] = array('2thes2_16-17' => '2thessalonians');
                $tmp_search_meta_ARRAY[] = array('1tim1_1' => '1timothy');
                $tmp_search_meta_ARRAY[] = array('1tim4_1-5' => '1timothy');
                $tmp_search_meta_ARRAY[] = array('1tim6_17' => '1timothy');
                $tmp_search_meta_ARRAY[] = array('2tim1_6' => '2timothy');
                $tmp_search_meta_ARRAY[] = array('2tim1_6-8' => '2timothy');
                $tmp_search_meta_ARRAY[] = array('titus1_1-3' => 'titus');
                $tmp_search_meta_ARRAY[] = array('titus2_11-15' => 'titus');
                $tmp_search_meta_ARRAY[] = array('titus3_7[000]' => 'titus');
                $tmp_search_meta_ARRAY[] = array('titus3_7' => 'titus');
                $tmp_search_meta_ARRAY[] = array('heb2_14-15' => 'hebrews');
                $tmp_search_meta_ARRAY[] = array('heb3_6[000]' => 'hebrews');
                $tmp_search_meta_ARRAY[] = array('heb3_6' => 'hebrews');
                $tmp_search_meta_ARRAY[] = array('heb3_7-19[000]' => 'hebrews');
                $tmp_search_meta_ARRAY[] = array('heb3_7-19' => 'hebrews');
                $tmp_search_meta_ARRAY[] = array('heb4_8-16' => 'hebrews');
                $tmp_search_meta_ARRAY[] = array('heb4_11' => 'hebrews');
                $tmp_search_meta_ARRAY[] = array('heb6_17-20' => 'hebrews');
                $tmp_search_meta_ARRAY[] = array('heb7_17-19' => 'hebrews');
                $tmp_search_meta_ARRAY[] = array('heb8_10[000]' => 'hebrews');
                $tmp_search_meta_ARRAY[] = array('heb8_10' => 'hebrews');
                $tmp_search_meta_ARRAY[] = array('heb9_14' => 'hebrews');
                $tmp_search_meta_ARRAY[] = array('heb10_22,19' => 'hebrews');
                $tmp_search_meta_ARRAY[] = array('heb10_22' => 'hebrews');
                $tmp_search_meta_ARRAY[] = array('heb10_21-23' => 'hebrews');
                $tmp_search_meta_ARRAY[] = array('heb10_23' => 'hebrews');
                $tmp_search_meta_ARRAY[] = array('heb10_35' => 'hebrews');
                $tmp_search_meta_ARRAY[] = array('heb10_35,38-39' => 'hebrews');
                $tmp_search_meta_ARRAY[] = array('heb11_1' => 'hebrews');
                $tmp_search_meta_ARRAY[] = array('heb12_1' => 'hebrews');
                $tmp_search_meta_ARRAY[] = array('james3_1-2' => 'james');
                $tmp_search_meta_ARRAY[] = array('1pet1_3-9,13,21' => '1peter');
                $tmp_search_meta_ARRAY[] = array('1pet1_3-5' => '1peter');
                $tmp_search_meta_ARRAY[] = array('1pet1_13' => '1peter');
                $tmp_search_meta_ARRAY[] = array('1pet2_16' => '1peter');
                $tmp_search_meta_ARRAY[] = array('1pet2_20' => '1peter');
                $tmp_search_meta_ARRAY[] = array('1pet2_7-8' => '1peter');
                $tmp_search_meta_ARRAY[] = array('1pet2_24' => '1peter');
                $tmp_search_meta_ARRAY[] = array('1pet3_15' => '1peter');
                $tmp_search_meta_ARRAY[] = array('1pet3_5-7,14-22' => '1peter');
                $tmp_search_meta_ARRAY[] = array('1pet5_8' => '1peter');
                $tmp_search_meta_ARRAY[] = array('1john2_15-17' => '1john');
                $tmp_search_meta_ARRAY[] = array('1john3_1-10' => '1john');
                $tmp_search_meta_ARRAY[] = array('rev2_10-11' => 'revelation');
                $tmp_search_meta_ARRAY[] = array('rev2_12-17' => 'revelation');
                $tmp_search_meta_ARRAY[] = array('rev2_18-23' => 'revelation');
                $tmp_search_meta_ARRAY[] = array('rev2_14[solo]' => 'revelation');
                $tmp_search_meta_ARRAY[] = array('rev2_14' => 'revelation');
                $tmp_search_meta_ARRAY[] = array('rev2_11|2_17,26-28|3_5,12,21' => 'revelation');
                $tmp_search_meta_ARRAY[] = array('rev2_21-22' => 'revelation');
                $tmp_search_meta_ARRAY[] = array('rev3_8' => 'revelation');
                $tmp_search_meta_ARRAY[] = array('rev3_7-13' => 'revelation');
                $tmp_search_meta_ARRAY[] = array('rev3_19' => 'revelation');
                $tmp_search_meta_ARRAY[] = array('rev6_16-17' => 'revelation');
                $tmp_search_meta_ARRAY[] = array('rev12_3-4,9' => 'revelation');
                $tmp_search_meta_ARRAY[] = array('rev12_3-4,13,17;13:2,4' => 'revelation');
                $tmp_search_meta_ARRAY[] = array('rev20_6' => 'revelation');
                $tmp_search_meta_ARRAY[] = array('rev21_2,9-27' => 'revelation');
                $tmp_search_meta_ARRAY[] = array('rev21_7' => 'revelation');
                $tmp_search_meta_ARRAY[] = array('rev21_3-5' => 'revelation');
                $tmp_search_meta_ARRAY[] = array('rev21_21' => 'revelation');
                $tmp_search_meta_ARRAY[] = array('rev22_2' => 'revelation');
                
            break;

        }

        return $tmp_search_meta_ARRAY;

    }

    public function generate_optimized_search_content($mode = 'VVID_LOOKUP_MASTER'){

        $tmp_php_generated_html = '
';
        
        //
        // $tmp_output_ARRAY = $this->return_search_controller_static_struct();
        // WHERE, $tmp_output_ARRAY['VVID'] AND $tmp_output_ARRAY['WWW'].
        $tmp_search_meta_ARRAY = $this->return_search_controller_static_struct();

        switch($mode){
            case 'VVID_LOOKUP_MASTER':
                // SCRIPTURES.

                /*
                [INPUT] --------
                    case 'psa97_2':

                        $tmp_verse_array['REFERENCE'][0]        = '97:2';
                        $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'Clouds and deep darkness surround Him; Righteousness and justice are the foundation of His throne.';
                        $tmp_verse_array['COPY'][0]             = 'Clouds and deep darkness surround Him;<br>
                        &nbsp;&nbsp;&nbsp;Righteousness and justice are the foundation of His throne.';

                    break;

                [OUTPUT] --------
                    $tmp_search_meta_ARRAY[] = array('{vvid}' => '{IMAGE_PREVIEW_SALT}');
                    - - - - -
                    $tmp_search_meta_ARRAY[] = array('1kings2_1-3' => '1kings');
                    $tmp_search_meta_ARRAY[] = array('1kings18_37-40,45;19_1-18' => '1kings');
                    $tmp_search_meta_ARRAY[] = array('1sam4_4' => '1samuel');
                    $tmp_search_meta_ARRAY[] = array('psa97_2' => 'psalms');

                */

                foreach($tmp_search_meta_ARRAY as $tmp_index => $tmp_vvid_meta_CHUNKARRAY0){

                    foreach($tmp_vvid_meta_CHUNKARRAY0 as $vvid => $meta_content){

                        $this->vvid = $vvid;
                        $tmp_vnav_vvid_ARRAY = $this->return_book_preciousness();

                        /*
                        [Sat Mar 02 01:49:51.201318 2024] [:error] [pid 121890] [client 172.16.225.1:55119] 693 precious [
                            Array\n(\n
                                [VVID] => Array\n        (\n            [0] => rev2_21-22\n        )\n\n
                                [COPY] => Array\n        (\n            [0] => Revelation 2:21-22\n        )\n\n
                            )\n].
                            $this->vvid[rev2_21-22].

                        [Sat Mar 02 02:38:11.375792 2024] [:error] [pid 121798] [client 172.16.225.1:56403] 693 precious [
                            Array\n(\n
                                [COPY] => Array\n        (\n            [0] => 1 Peter\n        )\n\n
                            )\n].
                            $this->vvid[1pet2_16].

                        [Sat Mar 02 04:54:57.670339 2024] [:error] [pid 125740] [client 172.16.225.1:59001] 741 precious [
                            Array\n(\n
                                [COPY] => Array\n        (\n            [0] => 1 Thessalonians\n        )\n\n
                            )\n]
                            $tmp_vvid_meta[1thessalonians].
                            $this->vvid[1thes5_7-11].

                        */

                        if(isset($tmp_vnav_vvid_ARRAY['COPY'][0])){

                            //
                            // LOWERCASE.
                            $tmp_book_str = strtolower($tmp_vnav_vvid_ARRAY['COPY'][0]);
                            $tmp_vvid_meta = $this->str_sanitize($tmp_book_str, 'bible_book_name');

                            switch($vvid){
                                case 'jehovah_has_revealed_dl':
                                case 'jehovah_has_revealed_audio':
                                case 'jehovah_has_revealed_chords':

                                    $tmp_vvid_meta = 'capoiv';

                                break;
                                case 'jony5_home_page':
                                    // projects/crnrstn/philosophy/

                                break;

                            }

                            //error_log(__LINE__ . ' precious [' . print_r($tmp_vnav_vvid_ARRAY, true) . '] $tmp_vvid_meta[' . $tmp_vvid_meta . ']. $this->vvid[' . $this->vvid . '].');

                            $tmp_php_generated_html .= '$tmp_search_meta_ARRAY[] = array(\'' . $vvid . '\' => \'' . $tmp_vvid_meta . '\');
';

                        }else{

                            error_log(__LINE__ . ' '. __METHOD__ . ' MISSING COPY DATA FOR THE vvid, [' . $this->vvid . '].');

                        }

                    }

                }

            break;
            case 'COMPRESSED_SEARCH_CONTENT':

                /*
                [INPUT] --------
                    case 'psa97_2':

                        $tmp_verse_array['REFERENCE'][0]        = '97:2';
                        $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'Clouds and deep darkness surround Him; Righteousness and justice are the foundation of His throne.';
                        $tmp_verse_array['COPY'][0]             = 'Clouds and deep darkness surround Him;<br>
                        &nbsp;&nbsp;&nbsp;Righteousness and justice are the foundation of His throne.';

                    break;

                [OUTPUT] --------
                    $tmp_search_meta_ARRAY[] = array(array('ASSET_RESOURCE_HTTP' => ''), array('psa97_2' => 'cloudsanddeepdarknesssurroundhimrighteo'));

                */
                foreach($tmp_search_meta_ARRAY as $tmp_index => $tmp_vvid_meta_CHUNKARRAY0){

                    foreach($tmp_vvid_meta_CHUNKARRAY0 as $vvid => $meta_content){

                        $this->vvid = $vvid;
                        $tmp_verse_meta_ARRAY = $this->return_verse_preciousness();

                        //error_log(__LINE__ . ' precious [' . print_r($tmp_verse_meta_ARRAY, true) . '] $tmp_vvid_meta[' . $meta_content . ']. $this->vvid[' . $this->vvid . '].');
                        /*
                        [Sat Mar 02 07:09:09.364794 2024] [:error] [pid 6891] [client 172.16.225.1:63241] 799 precious [
                        Array\n(\n
                            [REFERENCE] => Array\n        (\n            [0] => \n        )\n\n
                            [SOCIAL_PREVIEW] =>
                                Array\n        (\n
                                    [0] => Download Jehovah Has Revealed (Ashes). Vocals: Sister Doris K., Brother Jonathan H. African Djembe Hand Bongo: Brother Kenton W. Guitar: Brother Jonathan H.Jehovah has revealed / His heart to me. / To Him I thus would consecrated be. / As Daniel purposed in his heart...I'll be. / And pray; that God could move on earth through me. / Lord, You need me.\n        )\n\n
                            [COPY] =>
                                Array\n        (\n
                                    [0] => <a href="#" onclick="launch_newwindow('https://jony5.com/downloads/audio/jehovah_has_revealed_his_heart.php'); return false;" target="_blank">Click \n                here</a> to download.\n        )\n\n)\n] $tmp_vvid_meta[capoiv]. $this->vvid[jehovah_has_revealed_dl].

                        */

                        if(isset($tmp_verse_meta_ARRAY['COPY'][0])){

                            //
                            // LOWERCASE.
                            $tmp_copy_str = strtolower($tmp_verse_meta_ARRAY['COPY'][0]);
                            $tmp_vvid_meta = $this->str_sanitize($tmp_copy_str, 'search_jony5_vvid_content');

                            switch($vvid){
                                case 'jehovah_has_revealed_dl':
                                case 'jehovah_has_revealed_audio':
                                case 'jehovah_has_revealed_chords':

                                    $tmp_vvid_meta = 'capoiv';

                                break;
                                case 'jony5_home_page':
                                    // projects/crnrstn/philosophy/

                                break;

                            }

                            //error_log(__LINE__ . ' precious [' . print_r($tmp_verse_meta_ARRAY, true) . '] $tmp_vvid_meta[' . $tmp_vvid_meta . ']. $this->vvid[' . $this->vvid . '].');

                            $tmp_php_generated_html .= '$tmp_search_meta_ARRAY[] = array(array(\'ASSET_RESOURCE_HTTP\' => \'\'), array(\'' . $vvid . '\' => \'' . $tmp_vvid_meta . '\'));
';

                        }else{

                            error_log(__LINE__ . ' '. __METHOD__ . ' MISSING COPY DATA FOR THE vvid, [' . $this->vvid . '].');

                        }

                    }

                }

            break;
            case 'JONY5_COMPRESSED_SEARCH_CONTENT':
            default:

                $tmp_html_output = '';

                if(self::$oEnv->oSESSION_MGR->issetSessionParam('JONY5_ADMIN_SESSION') !== false){

                    //
                    // INITIALIZE ADMIN SESSION.
                    self::$valid_session = self::$oEnv->oSESSION_MGR->getSessionParam('JONY5_ADMIN_SESSION');

                }

                if(self::$oEnv->oHTTP_MGR->issetHTTP($_POST)){

                    //
                    // STORE THE $_GET[] DATA THAT HAS BEEN SENT.
                    $tmp_social_media_preview_img_url = self::$oEnv->oHTTP_MGR->extractData($_POST, 'social_media_preview_img_url');

                    if(strlen($tmp_social_media_preview_img_url) < 2){

                        //
                        // $tmp_output_ARRAY = $this->return_search_controller_static_struct();
                        // WHERE, $tmp_output_ARRAY['VVID'] AND $tmp_output_ARRAY['WWW'].
                        $tmp_www_jony5_ARRAY = $this->return_search_controller_static_struct('JONY5');

                        /*
                        [Sun Mar 03 20:55:19.539639 2024] [:error] [pid 20182] [client 172.16.225.1:49152] 694 precious [].
                        $tmp_vvid_jony5_ARRAY[
                        Array\n(\n
                            [0] => Array\n        (\n
                                [0] => Array\n                (\n
                                        [SEARCH_CONTENT] => WelcomeImJonathanJ5HarrisRev3713Gen4912528Deut33141229Isa1615Dan91727Matt24152224814James312Num25113Jer11119Luke123444awebprofessionallivingandworkinginAtlantaGAWith6yearsofsolidagencyexperience18yearsofprogrammingexperienceinopensourcewebtechnologiesbehindmeIamalwaysopentoinvestigatefreshopportunitiestoworkwithactivegrowinganddigitallyfueledcompaniesinordertostrengthenandbroadenaspectsoftheirserviceofferingsfromatechnicalperspectiveFormypreviousemployerIworkedwithcorporateclientstoformulateandexecutewithmyownbarehandsinthecodewhenevernecessarymultichannelbusinessmarketinginitiativesDigitalbrandstrategyandexecutionaremycorecompetenciesIn2004IworkedasafreelancedesignerwebapplicationdeveloperandserialentrepreneurAftertheimplosionofmy8personstartupcompanyCommercialNetIncIenteredtheworldofinteractivemarketingandadvertisingbyacceptingaUIdeveloperpositionwiththeAtlantabasedagencyMoxieIn2007IhelpedatalentedanddiverseteamofpeopleatMoxietostarttheeCRMdepartmentLeadbyDarrylBolducTinaWestandSapanaNanuwaandwithover50yearsofcombinedemailmarketingexperienceweworkedwithourclientstodesignandexecutebothawardwinningandstateoftheartemailmarketingprogramsinsupportoftheirglobalstrategicinitiativesBornonNov10th2005mydognamedJ5properispartKoreanJindoGermanShepherdandTimberWolfGalleryWhenIworkedatagencyJ5accompaniedmetotheofficeonoccasionaswellastolocalparkscoffeeshopsneighborhoodbarsandeventheoccasionalhousepartyOnthemorningofMondayAug162021at0345hrsandwhilelayingundermyarmJ5wentthewayofalltheearth1Kings213evenwithmuchencouragementandcelebrationfrommebyhissideInthewoodsbehindmyhouseinthedarkofnightat0500hrsasIwasreturningJ5totheearthfromwhencehecamewhilstshovelingthedirtbackinplaceIthankedhimrepeatedlyforeverythinghegavetomeduringoursojourntogetheruponthefaceoftheearthinthisGodsoldcreationIthankedhimforbringingmeintopracticalparticipationwithandintothepropheticfulfillmentoftheblessingsofIsraeltohistwelvesonsGen4821224912528whichareforallofthepeopleofGodacrossallspaceandalltimeEvenallthenationsoftheearthwillbeblessedThebonefromhislastwholesteaka100raretomahawkribeyefromRuthsChrisisstillclutchedagainsthischestinthearmofhisfrontrightpawLaterIcametorealizethatIburiedhimfacingtowardsthedirectionoftherisingofthesuntotheeastClickheretodownloadthelatestversionofmyresumeorvisitmyLinkedInprofile\n                )\n\n
                                [1] => Array\n                (\n
                                        [SOCIAL_PREVIEW_IMAGE_HTTP] => https://jony5.com/common/imgs/social_share/preview/jony5_social_preview_00.png?vers=876321.1674187423.0\n                )\n\n
                                [2] => Array\n                (\n
                                        [RESOURCE_ENDPOINT_URI] => https://jony5.com/?scroll=welcome\n                )\n\n        )\n\n)\n]., referer: http://172.16.225.139/jony5.com/search/

                        */

                        foreach($tmp_www_jony5_ARRAY as $img_index => $img_CHUNKARRAY0){

                            if(isset($img_CHUNKARRAY0[1]['SOCIAL_PREVIEW_IMAGE_HTTP'])){

                                $tmp_social_media_preview_img_url = $img_CHUNKARRAY0[1]['SOCIAL_PREVIEW_IMAGE_HTTP'];  //'https://jony5.com/common/imgs/social_share/preview/jony5_social_preview_00.png?vers=876321.1674187423.0';

                                if(strlen($tmp_social_media_preview_img_url) > 0){

                                    break 1;

                                }

                            }

                        }

                        //error_log(__LINE__ . ' precious [' . $tmp_social_media_preview_img_url . ']. $tmp_vvid_jony5_ARRAY[' . print_r($tmp_www_jony5_ARRAY, true) . '].');

                    }

                    $tmp_resource_endpoint_uri = self::$oEnv->oHTTP_MGR->extractData($_POST, 'page_content_endpoint_url');
                    $tmp_search_content = self::$oEnv->oHTTP_MGR->extractData($_POST, 'search_content');
                    $tmp_page_uri = self::$oEnv->paramTunnelDecrypt(self::$oEnv->oHTTP_MGR->extractData($_POST, 'uri'));
                    $tmp_search_content_compress_passphase = self::$oEnv->oHTTP_MGR->extractData($_POST, 'search_content_compress_passphase');

                    if(strlen($tmp_page_uri) < 1){

                        $tmp_page_uri = self::$oEnv->currentLocation();

                    }

                    $tmp_search_bytes_original = $this->count_processed_bytes($tmp_search_content,true);
                    $tmp_original_bytes = $tmp_search_bytes_original + $this->count_processed_bytes($tmp_social_media_preview_img_url . $tmp_resource_endpoint_uri, true);

                    $this->count_processed_bytes($tmp_social_media_preview_img_url);
                    $this->count_processed_bytes($tmp_resource_endpoint_uri);

                    $tmp_search_content = $this->str_sanitize($tmp_search_content, 'search_jony5_vvid_content');

                    //
                    // SOURCE :: https://stackoverflow.com/questions/3760816/remove-new-lines-from-string-and-replace-with-one-empty-space
                    // AUTHOR :: jwueller :: https://stackoverflow.com/users/427328/jwueller
                    // COMMENT :: https://stackoverflow.com/a/3760830
                    $tmp_search_content = trim(preg_replace('/\s+/', '', $tmp_search_content));

                    $this->count_processed_bytes($tmp_search_content);
                    $tmp_serial = $this->generate_new_key(50, '01');

                    //
                    // CHECK FOR A COMMAND TO EXIT THE
                    // ADMIN SESSION.
                    if(trim(strtolower($tmp_search_content_compress_passphase)) == 'exit'){

                        //
                        // LOG OUT.
                        self::$oEnv->oSESSION_MGR->setSessionParam('JONY5_ADMIN_SESSION', false);
                        self::$valid_session = false;

                        $tmp_search_logout_msg = '<div class="cb_20"></div><p>Goodbye!</p>
<div class="cb_30"></div>
<p><span><a href="' . $tmp_page_uri . '" target="_self"style="color: #0066CC; text-align: left;">Back</a></span></p>';
                        $this->count_processed_bytes($tmp_search_logout_msg);

                        return $tmp_search_logout_msg;

                    }

                    //
                    // CHECK FOR A VALID PASSPHRASE OR A
                    // PRE-EXISTING AND VALID ADMIN SESSION.
                    if(($tmp_search_content_compress_passphase == '011011100101101001000') || (self::$valid_session == true)){

                        //
                        // AUTHENTICATE THIS SESSION...I.E. LOGIN.
                        self::$oEnv->oSESSION_MGR->setSessionParam('JONY5_ADMIN_SESSION', true);

                        $tmp_html_output = '<div class="cb_20"></div>
    <span><a href="' . $tmp_page_uri . '" target="_self"style="font-family: Courier New, Courier, monospace; font-size:12px; color:#06C; text-align: left;">New</a></span>&nbsp;&nbsp;&nbsp;<a href="#" onclick="copy_output_' . $tmp_serial . '(); return false;" style="font-family: Courier New, Courier, monospace; font-size:12px; color:#06C; text-align: left;">Copy to clipboard</a>&nbsp;&nbsp;&nbsp;<span id="jony5_search_meta_clipboard_state_' . $tmp_serial . '" class="jony5_search_meta_clipboard_state"></span>
    <script>
        function copy_output_' . $tmp_serial . '(){

                        //
                        // SOURCE :: https://stackoverflow.com/questions/1173194/select-all-div-text-with-single-mouse-click
                        // COMMENT :: https://stackoverflow.com/a/1173319
                        // AUTHOR :: Denis Sadowski :: https://stackoverflow.com/users/136482/denis-sadowski
                        if(document.selection){ // IE

                            var range = document.body.createTextRange();
                            range.moveToElementText(document.getElementById("jony5_search_meta_www_data_' . $tmp_serial . '"));
                            range.select();

                        }else if(window.getSelection){

                            var range = document.createRange();
                            range.selectNode(document.getElementById("jony5_search_meta_www_data_' . $tmp_serial . '"));
                            window.getSelection().removeAllRanges();
                            window.getSelection().addRange(range);

                        }

                        //
                        // SOURCE :: https://www.w3schools.com/howto/howto_js_copy_clipboard.asp
                        /* Copy the text inside the text field */
                        document.execCommand(\'copy\');

            /* Alert the copied text */
            //alert("Copied the text: " + document.getElementById("crnrstn_print_r_source_' . $tmp_serial . '").innerHTML);
            document.getElementById("jony5_search_meta_www_data_' . $tmp_serial . '").style.backgroundColor = "#60bbff;";
            document.getElementById("jony5_search_meta_clipboard_state_' . $tmp_serial . '").innerHTML = "' . $this->formatBytes(self::$bytes_processed, 3) . ' Copied!";

        }
    </script>
    <div class="cb_5"></div>
    <textarea id="jony5_search_meta_www_data_' . $tmp_serial . '" class="jony5_search_meta_www_data_textarea" onclick="copy_output_' . $tmp_serial . '(); return false;" cols="80" rows="8">//
                                                            // PAGE URL:                ' . $tmp_resource_endpoint_uri . '
                                                            // DATA CAPTURE ENDPOINT:   ' . $tmp_page_uri . '
                                                            // DATE CREATED:            ' . self::$oEnv->return_micro_time() . '
                                                            // CLIENT IP:               ' . self::$oEnv->oCRNRSTN_IPSECURITY_MGR->clientIpAddress() . '
                                                            // SESSION ID:              ' . session_id() . '
                                                            $tmp_search_meta_ARRAY[] = array(
                                                                array(\'SEARCH_CONTENT\'                => \'' . $tmp_search_content . '\'),
                                                                array(\'SOCIAL_PREVIEW_IMAGE_HTTP\'     => \'' . $tmp_social_media_preview_img_url . '\'),
                                                                array(\'RESOURCE_ENDPOINT_URI\'         => \'' . $tmp_resource_endpoint_uri . '\')
                                                            );</textarea>

<div class="jony5_meta_report_header_wrap"><p><strong>Input Meta Report:</strong></p></div>
<div class="jony5_meta_report_body_wrap">
    <p><strong>Content Length (original):</strong><br>
    ' . $this->formatBytes($tmp_original_bytes, 3) . '</p>
    <p><strong>Content Length (search compressed):</strong><br>
    ' . $this->formatBytes(self::$bytes_processed, 3) . '</p>
    <p><strong>Search Content Endpoint URL:</strong><br>
    <a href="' . $tmp_resource_endpoint_uri . '" target="_blank">' . $tmp_resource_endpoint_uri . '</a>
    </p>
    <p><strong>Social Media Preview Image:</strong><br>
    <a href="' . $tmp_resource_endpoint_uri . '" target="_blank"><img src="' . $tmp_social_media_preview_img_url . '" height = "300"></a></p>

</div>
';

                    }else{

                        //
                        // THE SESSION IS NOT AUTHENTICATED.
                        $tmp_html_output = '<div class="cb_20"></div>
    <span><a href="' . $tmp_page_uri . '" target="_self"style="font-family: Courier New, Courier, monospace; font-size:12px; color:#06C; text-align: left;">New</a></span>&nbsp;&nbsp;&nbsp;<a href="#" onclick="copy_output_' . $tmp_serial . '(); return false;" style="font-family: Courier New, Courier, monospace; font-size:12px; color:#06C; text-align: left;">Copy to clipboard</a>&nbsp;&nbsp;&nbsp;<span id="jony5_search_meta_clipboard_state_' . $tmp_serial . '" class="jony5_search_meta_clipboard_state"></span>
    <script>
        function copy_output_' . $tmp_serial . '(){

                        //
                        // SOURCE :: https://stackoverflow.com/questions/1173194/select-all-div-text-with-single-mouse-click
                        // COMMENT :: https://stackoverflow.com/a/1173319
                        // AUTHOR :: Denis Sadowski :: https://stackoverflow.com/users/136482/denis-sadowski
                        if(document.selection){ // IE

                            var range = document.body.createTextRange();
                            range.moveToElementText(document.getElementById("jony5_search_meta_www_data_' . $tmp_serial . '"));
                            range.select();

                        }else if(window.getSelection){

                            var range = document.createRange();
                            range.selectNode(document.getElementById("jony5_search_meta_www_data_' . $tmp_serial . '"));
                            window.getSelection().removeAllRanges();
                            window.getSelection().addRange(range);

                        }

                        //
                        // SOURCE :: https://www.w3schools.com/howto/howto_js_copy_clipboard.asp
                        /* Copy the text inside the text field */
                        document.execCommand(\'copy\');

            /* Alert the copied text */
            //alert("Copied the text: " + document.getElementById("crnrstn_print_r_source_' . $tmp_serial . '").innerHTML);
            document.getElementById("jony5_search_meta_www_data_' . $tmp_serial . '").style.backgroundColor = "#60bbff;";
            document.getElementById("jony5_search_meta_clipboard_state_' . $tmp_serial . '").innerHTML = "' . $this->formatBytes(self::$bytes_processed, 3) . ' Copied!";

        }
    </script>
    <div class="cb_5"></div>
    <textarea id="jony5_search_meta_www_data_' . $tmp_serial . '" class="jony5_search_meta_www_data_textarea" onclick="copy_output_' . $tmp_serial . '(); return false;" cols="80" rows="8">//
                                                            // PAGE URL:                [CONTENT LEN=' . strlen($tmp_resource_endpoint_uri) . ']
                                                            // DATA CAPTURE ENDPOINT:   ' . $tmp_page_uri . '
                                                            // DATE CREATED:            ' . self::$oEnv->return_micro_time() . '
                                                            // CLIENT IP:               ' . self::$oEnv->oCRNRSTN_IPSECURITY_MGR->clientIpAddress() . '
                                                            // SESSION ID:              ' . session_id() . '
                                                            $tmp_search_meta_ARRAY[] = array(
                                                                array(\'SEARCH_CONTENT\'                => [CONTENT LEN=' . strlen($tmp_search_content) . ']),
                                                                array(\'SOCIAL_PREVIEW_IMAGE_HTTP\'     => [CONTENT LEN=' . strlen($tmp_social_media_preview_img_url) . ']),
                                                                array(\'RESOURCE_ENDPOINT_URI\'         => [CONTENT LEN=' . strlen($tmp_resource_endpoint_uri) . '])
                                                            );</textarea>

<div class="jony5_meta_report_header_wrap"><p><strong>Input Meta Report:</strong></p></div>
<div class="jony5_meta_report_body_wrap">
    <p><strong>Content Length (original):</strong><br>
    ' . $this->formatBytes($tmp_original_bytes, 3) . '</p>
    <p><strong>Content Length (search compressed):</strong><br>
    ' . $this->formatBytes(self::$bytes_processed, 3) . '</p>
    <p><strong>Search Content Endpoint URL:</strong><br>
    [CONTENT LEN=' . strlen($tmp_resource_endpoint_uri) . ']
    </p>
    <p><strong>Social Media Preview Image:</strong><br>
    [CONTENT LEN=' . strlen($tmp_social_media_preview_img_url) . ']</p>

</div>
';

                    }

                    return $tmp_html_output;

                }else{

                    /*
                    [INPUT] --------
                        - Search content copy-paste words
                        - Image URL
                        - Anchor tag link to the www content.

                    [OUTPUT] --------
                        $tmp_search_meta_ARRAY[] = array(
                                                            array('SEARCH_CONTENT' => 'cloudsanddeepdarknesssurroundhimrighteo'));
                                                            array('IMAGE_PREVIEW_HTTP' => ''),
                                                            array('CONTENT_URL' => 'http://jony5.com/')

                                                            );

                    */

                    $tmp_php_generated_html = '<div class="cb_30"></div>
<form action="#" method="post" name="post_search_content" id="post_search_content" enctype="multipart/form-data">

    <div class="form_input_shell_search">
        <div id="social_media_preview_img_url_form_element_label" class="form_element_label_search">Social Media Preview Image</div>
        <div class="form_element_input_search_wrapper">
            <div class="form_element_input_search">
                <input frm_init="crnrstn_frm_handle" crnrstn_frm_valtype="none" name="social_media_preview_img_url" type="text" id="social_media_preview_img_url" size="20" value="" placeholder="https://jony5.com/common/imgs/social_share/preview/jony5_social_preview_00.png" />
            </div>
            <div class="cb_10"></div>
            <div class="form_element_instruct_search"><p>Enter the HTTP image URL for social media preview image into the input box that is above.</p><p>The image should be at least 640px x 320px, and as stated <a href="https://docs.github.com/en/repositories/managing-your-repositorys-settings-and-features/customizing-your-repository/customizing-your-repositorys-social-media-preview" target="_blank">by Github</a>, shoot for 1280 by 640 pixels for best display.</p></div>
            <div class="cb"></div>
            <div class="input_validation_copy_shell"><div id="social_media_preview_img_url_input_validation_copy" class="input_validation_copy" style="display:none;">Required</div></div>
        </div>
        <div class="cb"></div>
    </div>

    <div class="form_input_shell_search">
        <div id="page_content_endpoint_url_form_element_label" class="form_element_label_search">Page Content URL</div>
        <div class="form_element_input_search_wrapper">
            <div class="form_element_input_search">
                <input frm_init="crnrstn_frm_handle" crnrstn_frm_valtype="required" name="page_content_endpoint_url" type="text" id="page_content_endpoint_url" size="20" value="" placeholder="https://jony5.com/about/bio/professional/" />
            </div>
            <div class="cb_10"></div>
            <div class="form_element_instruct_search"><p>Enter a HTTP URL for this content into the input box that is above.</p></div>
            <div class="cb"></div>
            <div class="input_validation_copy_shell"><div id="page_content_endpoint_url_input_validation_copy" class="input_validation_copy" style="display:none;">Required</div></div>
        </div>
        <div class="cb"></div>
    </div>

    <div class="form_input_shell_search">
        <div id="search_content_form_element_label" class="form_element_label_search">Page Content to Make Searchable</div>
        <div class="form_element_input_search_wrapper">
            <div class="form_element_input_search">
                <textarea frm_init="crnrstn_frm_handle" crnrstn_frm_valtype="required" name="search_content" id="search_content" cols="80" rows="8"></textarea>
            </div>
            <div class="cb_10"></div>
            <div class="form_element_instruct_search"><p>Paste the page content that is to be searchable into the textbox above.</p></div>
            <div class="cb"></div>
            <div class="input_validation_copy_shell"><div id="search_content_input_validation_copy" class="input_validation_copy" style="display:none;">Required</div></div>
       </div>
       <div class="cb"></div>
    </div>

    <div class="form_input_shell_search">
        <div id="social_media_preview_img_url_form_element_label" class="form_element_label_search">Passphrase</div>
        <div class="form_element_input_search_wrapper">
            <div class="form_element_input_search">
                <input frm_init="crnrstn_frm_handle" crnrstn_frm_valtype="none" name="search_content_compress_passphase" type="text" id="search_content_compress_passphase" size="20" value="" placeholder="' . $this->generate_new_key(25) . '" />
            </div>
            <div class="cb_10"></div>
            <div class="form_element_instruct_search"><p>Enter the pass phrase.</p></div>
            <div class="cb"></div>
            <div class="input_validation_copy_shell"><div id="social_media_preview_img_url_input_validation_copy" class="input_validation_copy" style="display:none;">Required</div></div>
        </div>
        <div class="cb"></div>
    </div>

    <div class="cb_10"></div>
    <div class="form_input_shell_search">
        <div class="form_element_submit_search_wrapper">
            <div id="form_submit_btn_search" class="form_submit_btn_search" onmouseover="submitBtnMouseOver(this, \'submit_btn_search_clear\',\'submit_btn_search_highlighted\'); return false;" onmouseout="submitBtnMouseOut(this,\'submit_btn_search_highlighted\', \'submit_btn_search_clear\'); return false;" onmouseup="document.getElementById(\'post_search_content\').submit();">GENERATE SEARCH DATA STRUCTURE</div>
        </div>
       <div class="cb"></div>
    </div>

    <input type="hidden" name="postid" id="postid" value="post_search_content" />
    <input type="hidden" name="OPTIN" id="OPTIN" value="0">
    <input type="hidden" name="uri" id="uri" value="' . self::$oEnv->paramTunnelEncrypt(self::$oEnv->currentLocation()) . '">
    <input type="hidden" name="post_search_content_form_serial" id="post_search_content_form_serial" value="' . time() . '">
</form>
';
                    //error_log(__LINE__ . ' precious [' . print_r($tmp_verse_meta_ARRAY, true) . '] $tmp_vvid_meta[' . $tmp_vvid_meta . ']. $this->vvid[' . $this->vvid . '].');
//                $tmp_php_generated_html .= '$tmp_search_meta_ARRAY[] = array(\'' . $vvid . '\' => \'' . $tmp_vvid_meta . '\');
//';

                }

            break;

        }

        $this->count_processed_bytes($tmp_php_generated_html);

        return $tmp_php_generated_html;

    }

    public function return_search_meta_scriptures($ugc_str){
        // Friday, March 1, 2024 2205 hrs.

        //
        // BUILD SEARCH CONTENT ARRAY.
        // BUILD AND RETURN A SEARCH
        // STRUCT OF SCRIPTURES META.
        $tmp_search_meta_ARRAY = '[' . time() . '] from return_search_meta_scriptures(UGC LEN=' . strlen($ugc_str) . ')';

        $tmp_search_meta_ARRAY[] = array('jehovah_has_revealed_dl' => 'capoiv');
        $tmp_search_meta_ARRAY[] = array('jehovah_has_revealed_audio' => 'capoiv');
        $tmp_search_meta_ARRAY[] = array('jehovah_has_revealed_chords' => 'capoiv');
        $tmp_search_meta_ARRAY[] = array('jehovah_has_revealed' => 'divcb_10divstanza_copyspanstanza_copychordsasus2spanstanza_copychordspaddingleft228pxdsus2dsus2adivcbdivscript_ref_numhymn_stanza1divstanza_copyjehovahhasrevealedhishearttomespanchordsasus2spanchordspaddingleft215pxdsus2dsus2atohimithuswouldconsecratedbespanchordspaddingleft30pxfmspanchordspaddingleft215pxeasdanielpurposedinhisheartillbespanchordspaddingleft40pxbmspanchordspaddingleft307pxaspanchordspaddingleft30pxeandpraythatgodcouldmoveonearththroughmespanchordspaddingleft120pxasus2spanchordspaddingleft100pxdsus2dsus2alordyouneedmedivcb_10divscript_ref_numhymn_stanza2divstanza_copysohereiamlordstandingbeforeyouirealizethatmynaturalmanisthroughonlychristhimselfcansatisfymygodhesabsolutemyburntofferingtruelordineedyoudivcb_10divscript_ref_numhymn_stanza3divstanza_copylordyouaretheonewhomeetsgodsneedallmynaturalgoodnessimustleaveuponthealteriwouldfindmyresttobecomeintheendashesatbestwhollyforgoddivcb_10divscript_ref_numhymn_stanza4divstanza_copyohthereisnothingsweetertomylordthanthosewhowouldtheirwholebeingoutpourlivingsacrificesuntogodthroughthemyoudgainyourbrideyourwifeyourlovenewjerusalemnewjerusalem');
        $tmp_search_meta_ARRAY[] = array('hymn979' => 'divscript_ref_numhymn_stanzafloatleft1divstanza_copyhowglorioushowbrightitshinestheholynewjerusalemitisgodsdwellingplacewithmanthespotlessbrideofchristthelambdivcb_10divscript_ref_numhymn_stanza2divstanza_copysaintsoftheoldandofthenewheirsofthepromisegodbestowedcomponentsofthecityaretogetherbuiltforgodsabodedivcb_10divscript_ref_numhymn_stanza3divstanza_copyperfectlysquarethecityliesallsidesareequal&ndash&ndashlengthwidthheightnomeasurementmorelongorshortnopartobliqueitstandsuprightdivcb_10spanscript_ref_numhymn_stanza4divstanza_copythecitywithitsstreetpuregoldasclearasglasstransparentisshowingthatgodstranscendentlifeitsqualityandnatureisdivcb_10divscript_ref_numhymn_stanza5divstanza_copytwelvecitygatesareeachonepearlthusmanisthroughredemptionshownrebornandasapearltransformedenteringtoarealmgodsowndivcb_10divscript_ref_numhymn_stanza6divstanza_copythetwelvefoundationsofitswallarewithtwelvepreciousstonesadornedthroughfireandpressurerecomposedandwitheternalvalueformeddivcb_10divscript_ref_numhymn_stanza7divstanza_copythewallofjaspercrystalcleargodsglorybyitfullyshownhisgloriouslightthroughitdoesshineandheappearsasjasperstonedivcb_10divscript_ref_numhymn_stanza8divstanza_copythewallaseparationmakesexcludingallthatisuncleangoldpearlsandpreciousstonesalonetheholycityhaswithindivcb_10divscript_ref_numhymn_stanza9divstanza_copygodandthelambthetempleareweshallbeholdhisgloriousfacehispresenceneverwilldepartwellworshiphimthruendlessdaysdivcb_10spanscript_ref_numhymn_stanza10divstanza_copythecityneedsnosunnormoonforgodsowngloryisitslightthelambsthelampthecitybearsinalldirectionsblazingbrightdivcb_10divscript_ref_numhymn_stanza11divstanza_copyoutfromthethroneofgodandthelambflowsmidstthestreetalivingstreamandonitsbanksoneithersidethetreeoflifeisthrivingseendivcb_10divscript_ref_numhymn_stanza12divstanza_copythissignifiesthelifeofgodnotjustforfoodorwaterflowsbutcarriesgodsauthorityasitthroughoutthecitygoesdivcb_10divscript_ref_numhymn_stanza13divstanza_copythestreetofpurestgoldthereingodsnatureasthewaydothshowariverinitflowsfordrinkandfruitsoflifeabundantgrowdivcb_10spanscript_ref_numhymn_stanza14divstanza_copythenumbertwelvemeansgovernmentperfectionwhicheternalisgodblentwithmanitalsotells&ndash&ndashthreemultipliedbyfourshowsthisdivcb_10divscript_ref_numhymn_stanza15divstanza_copydarknessanddeathshallbenomoresorrowandpainshallpassawayoldwillbegoneandallbenewgodwillabidewithmanforayedivcb_10divscript_ref_numhymn_stanza16divstanza_copythecityhasgodsimagefullitrulesforhimthesovereignkingfulfillinghiseternalplancompletecontenttohimtobring');
        $tmp_search_meta_ARRAY[] = array('gen1_1' => 'inthebeginninggodcreatedtheheavensandtheearth');
        $tmp_search_meta_ARRAY[] = array('gen1_26' => 'andgodsaidletusmakemaninourimageaccordingtoourlikenessandletthemhavedominionoverthefishoftheseaandoverthebirdsofheavenandoverthecattleandoveralltheearthandovereverycreepingthingthatcreepsupontheearth');
        $tmp_search_meta_ARRAY[] = array('gen2_7' => 'jehovahgodformedmanfromthedustofthegroundandbreathedintohisnostrilsthebreathoflifeandmanbecamealivingsoul');
        $tmp_search_meta_ARRAY[] = array('gen3_1' => 'nowtheserpentwasmorecraftythananyemotheremanimalofthefieldthatjehovahgodhadmadeandhesaidtothewomandidgodreallysayyoushallnoteatofanytreeofthegarden');
        $tmp_search_meta_ARRAY[] = array('gen3_14[COVID]' => 'andjehovahgodsaidtotheserpentbecauseyouhavedonethis&nbsp&nbsp&nbspyouarecursedmorethanallthecattle&nbsp&nbsp&nbspandmorethanalltheanimalsofthefielduponyourstomachyouwillgo&nbsp&nbsp&nbspanddustyouwilleat&nbsp&nbsp&nbspallthedaysofyourlife');
        $tmp_search_meta_ARRAY[] = array('gen3_14[solo]' => 'andjehovahgodsaidtotheserpentbecauseyouhavedonethis&nbsp&nbsp&nbspyouarecursedmorethanallthecattle&nbsp&nbsp&nbspandmorethanalltheanimalsofthefielduponyourstomachyouwillgo&nbsp&nbsp&nbspanddustyouwilleat&nbsp&nbsp&nbspallthedaysofyourlife');
        $tmp_search_meta_ARRAY[] = array('gen3_14' => 'andjehovahgodsaidtotheserpentbecauseyouhavedonethis&nbsp&nbsp&nbspyouarecursedmorethanallthecattle&nbsp&nbsp&nbspandmorethanalltheanimalsofthefielduponyourstomachyouwillgo&nbsp&nbsp&nbspanddustyouwilleat&nbsp&nbsp&nbspallthedaysofyourlife');
        $tmp_search_meta_ARRAY[] = array('gen26_4-5' => 'andiwillmultiplyyourseedasthestarsofheavenandwillgivetoyourseedalltheselandsandinyourseedallthenationsoftheearthwillbeblessedbecauseabrahamobeyedmyvoiceandkeptmychargemycommandmentsmystatutesandmylaws');
        $tmp_search_meta_ARRAY[] = array('gen48_21-22|49_1,25-28' => 'spanscript_ref_num21andisraelsaidtojosephnowiamabouttodiebutgodwillbewithyouandwillbringyouagaintothelandofyourfathersmoreoverihavegiventoyouoneportionmorethanyourbrotherswhichitookoutofthehandoftheamoritewithmyswordandwithmybowandjacobcalledtohissonsandsaidgatheryourselvestogetherthatimaytellyouwhatwillhappentoyouinthelastdaysdivcb_10spanscript_ref_num25fromthegodofyourfatherwhowillhelpyou&nbsp&nbsp&nbspandfromtheallsufficientonewhowillblessyouwithblessingsofheavenabove&nbsp&nbsp&nbspblessingsofthedeepthatliesbeneath&nbsp&nbsp&nbspblessingsofthebreastsandofthewombdivcb_5theblessingsofyourfathersurpass&nbsp&nbsp&nbsptheblessingsofmyancestors&nbsp&nbsp&nbsptotheutmostboundoftheeverlastinghillstheywillbeontheheadofjoseph&nbsp&nbsp&nbspandonthecrownoftheheadoftheonewhowasseparatefrom&nbsp&nbsp&nbsp&nbsp&nbsp&nbsphisbrothersdivcb_5benjaminisaspanscript_sup1ravenouswolf&nbsp&nbsp&nbspinthemorningdevouringtheprey&nbsp&nbsp&nbspandintheeveningdividingthespoildivcb_5allthesearethetwelvetribesofisraelandthisiswhattheirfatherspoketothemwhenheblessedthemheblessedthemeachoneaccordingtohisblessing');
        $tmp_search_meta_ARRAY[] = array('gen49_1,25-28' => 'spanscript_ref_num1andjacobcalledtohissonsandsaidgatheryourselvestogetherthatimaytellyouwhatwillhappentoyouinthelastdaysdivcb_10spanscript_ref_num25fromthegodofyourfatherwhowillhelpyou&nbsp&nbsp&nbspandfromtheallsufficientonewhowillblessyouwithblessingsofheavenabove&nbsp&nbsp&nbspblessingsofthedeepthatliesbeneath&nbsp&nbsp&nbspblessingsofthebreastsandofthewombdivcb_5theblessingsofyourfathersurpass&nbsp&nbsp&nbsptheblessingsofmyancestors&nbsp&nbsp&nbsptotheutmostboundoftheeverlastinghillstheywillbeontheheadofjoseph&nbsp&nbsp&nbspandonthecrownoftheheadoftheonewhowasseparatefrom&nbsp&nbsp&nbsp&nbsp&nbsp&nbsphisbrothersdivcb_5benjaminisaspanscript_sup1ravenouswolf&nbsp&nbsp&nbspinthemorningdevouringtheprey&nbsp&nbsp&nbspandintheeveningdividingthespoildivcb_5allthesearethetwelvetribesofisraelandthisiswhattheirfatherspoketothemwhenheblessedthemheblessedthemeachoneaccordingtohisblessing');
        $tmp_search_meta_ARRAY[] = array('lifestudy_exo_156' => 'theresultofservinginthetabernaclewithoutfirstwashinginthelaverdivcb_10whenwepraytooffersomethingtothelordwefirstneedtowashourhandsandevenourfeetinthelavertocometothemeetingtofunctionisactuallytocomeintothetabernacletoservethelordbeforeweservethelordinthetabernacleweneedtowashhoweverinthechristianlifeofmanybelieversandintheirservicetogodtheredoesnotseemtobealaverwhentheycometothealtertomakeanofferingtogodtheyhaveuncleanhandstheymaycomeintothechurchmeetingsandservewithoutwashingtheirhandsinthelaverthiskindofservicebringsindeaththisisthereasonexodus3021says&quotthentheyshallwashtheirhandsandtheirfeetthattheymaynotdie&quotdivcb_10weshouldbecarefulnottotouchgodsserviceunlesswehavefirstwashedourhandsinthelaverifwetrytoservegodinthetabernaclewithuncleanhandsweshalldiespirituallyspeakinghowmuchdeaththereisamongchristianstodaythemoretheyservethemoredeaththeyhavebecausetheyservewithuncleanhandsprayingandservingwithuncleanhandsbringsindeathdivcb_10ifwedonotprayinthemeetingsorfunctioninasensewemaybesomewhatlivingbutifweprayorfunctionwithoutwashinginthelaverweshallbringdeathtoourselvesandalsospreaddeathtoothersdeathistheresultofourtryingtoprayorservewithoutwashinginthelaver');
        $tmp_search_meta_ARRAY[] = array('exo9_29' => 'andmosessaidtohimassoonasihavegoneoutofthecityiwillspreadoutmyhandstojehovahthethunderwillceaseandtherewillnotbeanymorehailthatyoumayknowthattheearthisjehovahs');
        $tmp_search_meta_ARRAY[] = array('exo15_26' => 'andhesaidifyouwilllistencarefullytothevoiceofjehovahyourgodanddowhatisrightinhiseyesandgiveeartohiscommandmentsandkeepallhisstatutesiwillputnoneofthediseasesonyouwhichihaveputontheegyptiansforiamjehovahwhohealsyou');
        $tmp_search_meta_ARRAY[] = array('exo20_6' => 'yetshowinglovingkindnesstothousandsofgenerationsofthosewholovemeandkeepmycommandments');
        $tmp_search_meta_ARRAY[] = array('exo20_13' => 'youshallnotkill');
        $tmp_search_meta_ARRAY[] = array('exo20_15' => 'youshallnotsteal');
        $tmp_search_meta_ARRAY[] = array('exo30_18' => 'youshallalsomakeaspanscript_sup1laverofbronzewithitsbaseofbronzeforwashingandyoushallputitbetweenthetentofmeetingandthealterandyoushallputwaterinit');
        $tmp_search_meta_ARRAY[] = array('exo30_17-21' => 'andjehovahspoketomosessayingyoushallalsomakealaverofbronzewithitsbaseofbronzeforwashingandyoushallputitbetweenthetentofmeetingandthealterandyoushallputwaterinitandaaronandhissonsshallwashtheirhandsandtheirfeetemwithwateremfromitwhentheygointothetentofmeetingtheyshallwashwithwaterthattheymanynotdieorwhentheycomeneartothealtertoministertoburnanofferingbyfiretojehovahtheyshallwashtheirhandsandtheirfeetthattheymaynotdieanditshallbeaperpetualstatutetothemforhimandforhisseedthroughouttheirgenerations');
        $tmp_search_meta_ARRAY[] = array('lev2_1' => 'andwhenanyonepresentsanofferingofamealofferingtojehovahhisofferingshallbeofspanscript_sup2fineflourandheshallpouroilonitandputfrankincenseonit');
        $tmp_search_meta_ARRAY[] = array('lev18_1-5,24-28' => 'spanscript_ref_num1thenjehovahspoketomosessayingspeaktothechildrenofisraelandsaytothemiamjehovahyourgodyoushallnotdoastheydointhelandofegyptinwhichyoudweltandyoushallnotdoastheydointhelandofcanaanwhereiambringingyounorshallyouwalkintheirstatutesdivcb_10youshallobservemyordinancesandyoushallkeepmystatutestowalkinthemiamjehovahyourgodsoyoushallkeepmystatutesandmyordinancesbywhichifamandoesthemhewilllivedivcb_10iamjehovahdivcb_10spanscript_ref_num24donotdefileyourselvesinanyofthesethingsforbyallthesethenationswhichiamcastingoutbeforeyouhavedefiledthemselvesbecausethelandhasbecomedefiledivisiteditsiniquityuponitandthelandvomitedoutitsinhabitantsdivcb_10youthereforeshallkeepmystatutesandmyordinancesandshallnotdoanyoftheseabominationsneitherthenativenorthesojournerwhosojournsamongyouforthemenofthelandwhowerebeforeyouhavedonealltheseabominationsandthelandhasbecomedefileddivcb_10thatthelanddoesnotvomityououtwhenyoudefileitasitvomitedoutthenationwhichwasbeforeyouforallwhodoanyoftheseabominationsthosepersonswhodothemshallbecutofffromamongtheirpeoplethereforeyoushallkeepmychargesothatyoudonotcommitanyoftheseabominablecustomswhichwerecommittedbeforeyouandyoudonotdefileyourselvesbythemdivcb_10iamjehovahyourgod');
        $tmp_search_meta_ARRAY[] = array('lev26_3-13' => 'ifyouwalkinmystatutesandkeepmycommandmentsanddothemtheniwillgiveyouyourrainsintheirseasonandthelandwillyielditsproduceandthetreesofthefieldwillyieldtheirfruitdivcb_10indeedyourthreshingwillovertakethevintageandthevintagewillovertakethesowingtimethusyouwilleatyourbreaduntosatisfactionanddwellsecurelyinyourlandandiwillgiveyoupeaceinthelandsothatyouwillliedownandnoonewillmakeyouafraidandiwillcausewildbeaststoceaseoutofyourlandandnoswordwillpassthroughyourlanddivcb_10andyouwillchaseyourenemiesandtheywillfallbytheswordbeforeyouandfiveofyouwillchaseahundredandahundredofyouwillchasetenthousandandyourenemieswillfallbytheswordbeforeyouandiwillturnmyfacetowardyouandmakeyoufruitfulandmultiplyyouandiwillestablishmycovenantwithyouandyouwilleattheoldsupplylongstoredandwillhavetoclearouttheoldbecauseofthenewdivcb_10andiwillsetmytabernacleamongyouandmysoulwillnotabhoryouandiwillwalkamongyouandbeyourgodandyouwillbemypeopleiamjehovahyourgodwhobroughtyououtofthelandofegyptsothatyoushouldnotbetheirslavesandihavebrokenthebarsofyouryokeandmadeyouwalkupright');
        $tmp_search_meta_ARRAY[] = array('lev26_3,11b-12' => 'spanscript_ref_num3ifyouwalkinmystatutesandkeepmycommandmentsanddothemdivcb_10spanscript_ref_num11bmysoulwillnotabhoryouandiwillwalkamongyouandbeyourgodandyouwillbemypeople');
        $tmp_search_meta_ARRAY[] = array('num14_31' => 'butyourlittleoneswhomyousaidwouldbecomeplunderiwillbringinandtheywillknowthelandwhichyouhaverejected');
        $tmp_search_meta_ARRAY[] = array('num14_31[000]' => 'butyourlittleoneswhomyousaidwouldbecomeplunderiwillbringinandtheywillknowthelandwhichyouhaverejected');
        $tmp_search_meta_ARRAY[] = array('num14_29-30' => 'yourcorpsesshallfallinthiswildernessandnoneofyouwhowerenumberedaccordingtothenumberyoucountedfromtwentyyearsoldandupwardwhohavemurmuredagainstmeshallcomeintothelandinwhichisworetosettleyouexceptcalebthesonofjephunnehandjoshuathesonnun');
        $tmp_search_meta_ARRAY[] = array('num14_35' => 'ijehovahhavespokensurelyiwilldothistoallthisevilassemblywhoaregatheredtogetheragainstmeinthiswildernesstheyshallbeconsumedandtheretheyshalldie');
        $tmp_search_meta_ARRAY[] = array('num25_1-13' => 'whileisraeldweltinshittimthepeoplebegantocommitfornicationwiththedaughtersofmoabfortheyinvitedthepeopletothesacrificesoftheirgodsandthepeopleateandboweddowntotheirgodsandisraeljoineditselftobaalpeorandtheangerofjehovahwaskindledagainstisraelandjehovahsaidtomosestakealltheleadersofthepeopleandhangthemuptojehovahbeforethesunsothatthefierceangerofjehovahmayturnawayfromisraelandmosessaidtothejudgesofisraeleachofyouslayhismenwhohavejoinedthemselvestobaalpeordivcb_10justthenoneofthechildrenofisraelcameandbroughtamidianitewomantohisbrothersinthesightofmosesandonthesightofthewholeassemblyofthechildrenofisraelwhiletheywereweepingattheentranceofthetentofmeetingandwhenphinehasthesonofeleazarthesonofaaronthepriestsawitheroseupfromthemidstoftheassemblyandtookaspearinhishanddivcb_10andhewentafterthemanofisraelintothetentandpiercedbothofthemthemanofisraelandthewomanthroughherstomachsotheplagueamongthechildrenofisraelwasstoppedandthosewhodiedbytheplagueweretwentyfourthousanddivcb_10thenjehovahspoketomosessayingphinehasthesonofeleazarthesonofaaronthepriesthasturnedmywrathawayfromthechildrenofisraelinthathewasjealouswithmyjealousyamongthemsothatididnotconsumethechildrenofisraelinmyjealousydivcb_10thereforesayinowgivehimmycovenantofpeaceanditshallbetohimandtohisseedafterhimthecovenantofaneverlastingpriesthoodbecausehewasjealousforhisgodandmadeexpiationforthechildrenofisrael');
        $tmp_search_meta_ARRAY[] = array('num32_13' => 'andjehovahsangerwaskindledagainstisraelhemadethemwanderinthewildernessfortyyearsuntilthewholegenerationwhichhaddoneevilinthesightofjehovahwasconsumed');
        $tmp_search_meta_ARRAY[] = array('num33_50-54' => 'thenjehovahspoketomosesintheplainsofmoabbythejordanatjerichosayingspeaktothechildrenofisraelandsaytothemwhenyoupassoverthejordanintothelandofcanaanyoushalldriveoutalltheinhabitantsofthelandfrombeforeyouandyoushalldestroyalltheirfiguredstonesanddestroyalltheirmoltenimagesanddemolishalltheirhighplacesdivcb_10andyoushalltakepossessionofthelandanddwellinitfortoyouihavegiventhelandtopossessitandyoushallinheritthelandbylotaccordingtoyourfamiliestothelargeryoushallgivealargerinheritanceandtothesmalleryoushallgiveasmallerinheritancewhereverthelotfallstoanyonethatshallbehisyoushallinheritaccordingtothetribesofyourfathersdivcb_10butifyoudonotdriveouttheinhabitantsofthelandfrombeforeyouthenthosewhomyouletremainofthemwillbecomeassplintersinyoureyesandasthornsinyoursidesandtheywilltroubleyouinthelandinwhichyouaredwellingandjustasithoughttodotothemsowillidotoyou');
        $tmp_search_meta_ARRAY[] = array('deut4_1-2,39-40' => 'spanscript_ref_num1andnowoisraellistentothestatutesandtheordinanceswhichiamteachingyoutodoinorderthatyoumayliveandgoinandpossessthelandwhichjehovahthegodofyourfathersisgivingyouyoushallnotaddtothewordwhichiamcommandingyounorshallyoutakeawayfromitthatyoumaykeepthecommandmentsofjehovahyourgodwhichiamcommandingyoudivcb_10spanscript_ref_num39knowthereforetodayandbringittoheartthatjehovahisgodinheavenaboveandupontheearthbelowthereisnootherthereforekeephisstatutesandhiscommandmentswhichiamcommandingyoutodaythatitmaygowellwithyouandwithyourchildrenafteryousothatyoumayextendyourdaysuponthelandwhichjehovahyourgodisgivingyouforever');
        $tmp_search_meta_ARRAY[] = array('deut5_10,29' => 'spanscript_ref_num10yetshowinglovingkindnesstothousandsofgenerationsofthosewholovemeandkeepmycommandmentsdivcb_10spanscript_ref_num29ohthatthisheartoftheirswouldbeinthemalwaystofearmeandkeepallmycommandmentssothatitmaygowellwiththemandwiththeirchildrenforever');
        $tmp_search_meta_ARRAY[] = array('deut6_1-6,16-25' => 'spanscript_ref_num1nowthisisthecommandmentthestatutesandtheordinanceswhichjehovahyourgodhascommandedmetoteachyouthatyoumaydotheminthelandintowhichyouarecrossingovertopossessthatyoumayfearjehovahyourgodandkeepallhisstatutesandhiscommandmentswhichiamcommandingyouyouandyoursonandyourgrandsonallthedaysofyourlifeandthatyourdaysmaybeextendeddivcb_10thereforehearoisraelandbecertaintodoitthatitmaygowellwithyouandthatyoumaybegreatlyincreasedinalandflowingwithmilkandhoneyevenasjehovahthegodofyourfatherspromisedyoudivcb_10hearoisraeljehovahisourgodjehovahisoneandyoushalllovejehovahyourgodwithallyourheartandwithallyoursoulandwithallyourmightandthesewordswhichicommandyoutodayshallbeuponyourheartdivcb_10spanscript_ref_num16youshallnottestjehovahyourgodasyoutestedhimatmassahyoushalldiligentlykeepthecommandmentsofjehovahyourgodandhistestimoniesandhisstatuteswhichhehascommandedyouandyoushalldothatwhichisrightandgoodinthesightofjehovahsothatitmaygowellwithyouandyoumayenterandpossessthegoodlandconcerningwhichjehovahsworetoyourfatherstodriveoutallyourenemiesfrombeforeyouasjehovahhasspokendivcb_10whenyoursonasksyouinthefuturesayingwhatisthesignificanceofthetestimoniesandthestatutesandtheordinancesthatjehovahourgodcommandedyouthenyouwillsaytoyoursonwewerepharaohsslavesinegyptandjehovahbroughtusoutofegyptwithamightyhandandjehovahputforthbeforeoureyesgreatandgrievoussignsandwondersinegyptagainstpharaohandallhishousethenhebroughtusoutfromthereinordertobringusinthathemightgiveusthelandwhichhesworetoourfathersdivcb_10andjehovahcommandedustodoallthesestatutessothatwewouldfearjehovahourgodforourgoodalwaysandhewouldpreserveusaliveaswearethisdayanditwillberighteousnesstousifwearecertaintodoallthiscommandmentbeforejehovahourgodashecommandedus');
        $tmp_search_meta_ARRAY[] = array('deut6_25' => 'anditwillberighteousnesstousifwearecertaintodoallthiscommandmentbeforejehovahourgodashecommandedus');
        $tmp_search_meta_ARRAY[] = array('deut7_9-26' => 'knowthereforethatitisjehovahyourgodwhoisgodthefaithfulgodwhokeepscovenantandlovingkindnesstothethousandthgenerationwiththosewholovehimandkeephiscommandmentsbutrepaysdirectlythosewhohatehimbydestroyingthemhewillnotbeslowtowardhimwhohateshimhewillrepayhimdirectlydivcb_10thereforeyoushallkeepthecommandmentandthestatutesandtheordinanceswhichiamcommandingyoutodaytodoanditwillbethatbecauseyoulistentotheseordinancesandkeepthemanddothemjehovahyourgodwillkeepwithyouthecovenantandthelovingkindnesswhichhesworetoyourfathersdivcb_10andhewillloveyouandblessyouandmultiplyyouhewillalsoblessthefruitofyourwombandthefruitofyourgroundyourgrainandyournewwineandyourfreshoiltheoffspringofyourcattleandtheyoungofyourflockonthelandwhichhesworetoyourfatherstogiveyoudivcb_10youwillbemoreblessedthanallotherpeoplestherewillnotbeanybarrenmaleorfemaleamongyouoramongyouranimalsandjehovahwillremoveeverysicknessfromyouandnoneoftheevilillnessesofegyptwhichyouknowaboutwillheputuponyoubuthewillgivethemtoallwhohateyoudivcb_10andyoushalldevourallthepeopleswhichjehovahyourgodisgivingyouyoureyeshallnotpitythemnorshallyouservetheirgodsforthatwouldbeasnaretoyoudivcb_10ifyousayinyourheartthesenationsaregreaterthanihowwillibeabletodispossessthemyoushallnotbeafraidofthemyoumustrememberwhatjehovahyourgoddidtopharaohandtoallegyptthegreattrialsthatyoureyessawandthesignsandthewondersandthemightyhandandtheoutstretchedarmwithwhichjehovahyourgodbroughtyououtsowilljehovahyourgoddotoallthepeopleswhomyouareafraidofdivcb_10furthermorejehovahyourgodwillsendthehornetamongthemuntilthosewhoareleftandthosewhohidethemselvesfromyouaredestroyedyoushallnotbeterrifiedofthemforjehovahyourgodisinyourmidstagreatandawesomegoddivcb_10andjehovahyourgodwillclearawaythesenationsfrombeforeyoulittlebylittleyoushallnotdevourallofthemimmediatelylestthebeastsofthefieldmultiplyagainstyoubutjehovahyourgodwilldeliverthemupbeforeyouandroutthemutterlyuntiltheyaredestroyeddivcb_10andhewilldelivertheirkingsintoyourhandandyoushalldestroytheirnamefromunderheavennomanwillbeabletostandagainstyouuntilyoudestroythemtheidolsoftheirgodsyoushallburnwithfireyoushallnotdesirethesilverorgolduponthemnortakeitforyourselflestyoubeensnaredbyitforitisanabominationtojehovahyourgodandyoushallnotbringanabominationintoyourhouselestyoubecomeacursedthinglikeityoushallutterlydetestitandutterlyabhoritforitisacursedthing');
        $tmp_search_meta_ARRAY[] = array('deut8_1-10' => 'thewholecommandmentwhichiamcommandingyoutodayyoushallkeepanddosothatyoumayliveandmultiplyandenterandpossessthelandwhichjehovahsworetoyourfathersandyoushallrememberallthewaythatjehovahyourgodhasledyouthesefortyyearsinthewildernessinordertohumbleyouandtestyoutoknowwhatwasinyourheartwhetheryouwouldkeephiscommandmentsornotdivcb_10andhehumbledyouandletyougohungryandfedyouthemannawhichyouhadneverknownnoryourfathershadeverknownsothathemightmakeyouknowthatmanlivesnotbybreadalonebutthatmanlivesbyeverythingthatproceedsoutfromthemouthofjehovahdivcb_10yourclothingdidnotwearoutfromuponyounordidyourfootswellthesefortyyearsknowtheninyourheartthatasamandisciplineshissonsojehovahyourgodwasdiscipliningyoudivcb_10thereforekeepthecommandmentsofjehovahyourgodwalkinginhiswaysandfearinghimdivcb_10forjehovahyourgodisbringingyoutoagoodlandalandofwaterbrooksofspringsandoffountainsflowingforthinvalleysandinmountiansalandofwheatandbarleyandvinesandfigtreesandpomegranatesalandofolivetreeswithoilandofhoneyalandinwhichyouwilleatbreadwithoutscarcityyouwillnotlackanythinginitalandwhosestonesareironandfromwhosemountainsyoucanminecopperdivcb_10andyoushalleatandbesatisfiedandyoushallblessjehovahyourgodforthegoodlandwhichhehasgivenyou');
        $tmp_search_meta_ARRAY[] = array('deut10_14-22' => 'beholdheavenandtheheavenofheavensbelongtojehovahyourgodtheearthandallthatisinitbutonyourfathersjehovahsethisaffectiontolovethemandtochoosetheirseedafterthemthatisyouaboveallthepeoplesasitisthisdaycircumcisethentheforeskinofyourheartanddonotbestiffneckedanylongerforitisjehovahyourgodwhoisthegodofgodsandthelordoflordsthegreatgodmightyandawesomewhodoesnotregardpersonsanddoesnottakebribesheexecutesjusticefortheorphanandthewidowandhelovesthesojournergivinghimfoodandclothingdivcb_10thereforelovethesojournerforyouweresojournersinthelandofegyptyoushallfearjehovahyourgodhimshallyouserveandtohimshallyouholdfastandbyhisnameshallyouswearheisyourpraiseandheisyourgodwhohasdonethesegreatandawesomethingsforyouwhichyoureyeshaveseenyourfatherswentdownintoegyptasseventysoulsandnowjehovahyourgodhasmadeyouasthestarsofheaveninmultitude');
        $tmp_search_meta_ARRAY[] = array('deut11_14' => 'iwillgiverainforyourlandinitsseasontheearlyrainandthelaterainsothatyoumaygatheryourgrainandyournewwineandyourfreshoil');
        $tmp_search_meta_ARRAY[] = array('deut11_1,8-15,22-28' => 'spanscript_ref_num1thereforeyoushalllovejehovahyourgodandkeephischargeandhisstatutesandhisordinancesandhiscommandmentsalwaysdivcb_10spanscript_ref_num8thereforeyoushallkeepthewholecommandmentwhichiamcommandingyoutodaysothatyoumaybestrongandthatyoumaygoinandpossessthelandintowhichyouarecrossingovertopossessandsothatyoumayextendyourdaysuponthegroundwhichjehovahsworetoyourfatherstogivetothemandtotheirseedalandflowingwithmilkandhoneydivcb_10forthelandwhichyouareenteringintopossessisnotlikethelandofegyptfromwhichyoucameforthwhereyouusedtosowyourseedandwaterbyfootasinavegetablegardenbutthelandintowhichyouarecrossingovertopossessisalandofmountainsandvalleysbyvirtueofheavensrainitdrinksinwaterdivcb_10itisalandwhichjehovahyourgodcaresforalwaystheeyesofjehovahyourgodareuponitfromthebeginningoftheyeareventotheendoftheyearandifyouarecertaintolistentomycommandmentswhichiamcommandingyoutodaytolovejehovahyourgodandservehimwithallyourheartandwithallyoursouliwillgiverainforyourlandinitsseasontheearlyrainandthelaterainsothatyoumaygatheryourgrainandyournewwineandyourfreshoilandiwillputgrassinyourfieldforyourcattleandyouwilleatandbesatisfieddivcb_10spanscript_ref_num22forifyouarecertaintokeepallthiscommandmentwhichiamcommandingyoutodotolovejehovahyourgodtowalkinallhiswaysandholdfasttohimjehovahwilldispossessallthesenationsfrombeforeyouandyouwilldispossessnationsgreaterandmightierthanyoudivcb_10everyplaceonwhichthesoleofyourfoottreadswillbeyoursfromthewildernessandlebanonfromtherivertherivereuphrateseventothefarmostseawillbeyourterritorynomanwillbeabletostandagainstyoujehovahyourgodwillputthedreadandfearofyouuponallthelandonwhichyoutreadashehasspokentoyoudivcb_10seeiamsettingbeforeyoutodayablessingandacursetheblessingifyoulistentothecommandmentsofjehovahyourgodwhichiamcommandingyoutodayandthecurseifyoudonotlistentothecommandmentsofjehovahyourgodandyouturnasidefromthewaywhichiamcommandingyoutodaytogoafterothergodswhomyouhavenotknown');
        $tmp_search_meta_ARRAY[] = array('deut26_16-19' => 'thisdayjehovahyourgodiscommandingyoutodothesestatutesandordinancesthereforeyoushallkeepthemanddothemwithallyourheartandwithallyoursoulitisjehovahwhomyouhavetodaydeclaredtobeyourgodandthatyouwillwalkinhiswaysandkeephisstatutesandhiscommandmentsandhisordinancesandwilllistentohisvoicedivcb_10anditisjehovahwhohastodaydeclaredyoutobeapeopleforhispersonaltreasureevenashepromisedyouandthatyouwillkeepallhiscommandmentsandthathewillsetyouhighaboveallthenationswhichhehasmadeforpraiseandforanameandforhonorandthatyouwillbeaholypeopletojehovahyourgodashehasspoken');
        $tmp_search_meta_ARRAY[] = array('deut28_1-14' => 'andifyoulistendiligentlytothevoiceofjehovahyourgodandarecertaintodoallhiscommandmentswhichiamcommandingyoutodayjehovahyourgodwillsetyouhighaboveallthenationsoftheearthandalltheseblessingswillcomeuponyouandovertakeyouifyoulistentothevoiceofjehovahyourgoddivcb_10blessedshallyoubeinthecityandblessedshallyoubeinthefieldblessedshallbethefruitofyourwombandthefruitofyourgroundandthefruitofyouranimalstheoffspringofyourcattleandtheyoungofyourflockdivcb_10blessedshallbeyourbasketandyourkneadingbowlblessedshallyoubewhenyoucomeinandblessedshallyoubewhenyougooutjehovahwillcauseyourenemieswhoriseupagainstyoutobestruckdownbeforeyouononeroadtheywillcomeoutagainstyoubutonsevenroadstheywillfleebeforeyoudivcb_10jehovahwillcommandtheblessinguponyouinyourstorehousesandinallyourundertakingsandhewillblessyouinthelandwhichjehovahyourgodisgivingyoujehovahwillestablishyouasaholypeopletohimselfashesworetoyouifyoukeepthecommandmentsofjehovahyourgodandwalkinhiswaysdivcb_10andallthepeoplesoftheearthwillseethatyouarecalledbyjehovahsnameandtheywillbeafraidofyouandjehovahwillgiveyouanexcessofprosperityinthefruitofyourwombandinthefruitofyouranimalsandinthefruitofyourgrounduponthegroundwhichjehovahsworetoyourfatherstogiveyoudivcb_10jehovahwillopenuptoyouhisgoodtreasurytheheavenstogiverainforyourlandinitsseasonandtoblessallyourundertakingsandyouwilllendtomanynationsbutyouwillnotborrowandjehovahwillmakeyoutheheadandnotthetailandyouwilltendonlyupwardandyouwillnottenddownwardifyouwilllistentothecommandmentsofjehovahyourgodwhichiamcommandingyoutodaytokeepandtododivcb_10andyoushallnotturnasidefromanyofthewordswhichiamcommandingyoutodaytotherightortothelefttogoafterothergodstoservethem');
        $tmp_search_meta_ARRAY[] = array('deut30_11-20' => 'forthiscommandmentwhichiamcommandingyoutodayitisnottoodifficultforyounorisitdistantitisnotinheaventhatyoushouldsaywhowillascendtoheavenforusandbringittoustomakeushearitanddoitnorisitacrosstheseathatyoushouldsaywhowillgoacrosstheseaforusandbringittoustomakeushearitanddoitdivcb_10butthewordisveryneartoyoueveninyourmouthandinyourheartthatyoumaydoitseeihaveputbeforeyoutodaylifeandgoodanddeathandevilifyouobeythecommandmentsofjehovahyourgodwhichiamcommandingyoutodaytolovejehovahyourgodandwalkinhiswaysandkeephiscommandmentsandhisstatutesandhisordinancesthenyouwillliveandmultiplyandjehovahyourgodwillblessyouinthelandwhichyouareenteringtopossessdivcb_10butifyourheartturnsandyoudonotlistenbutratheryouaredrawnawayinworshiptoothergodsandservethemideclaretoyoutodaythatyoushallsurelyperishyourdayswillnotbeextendeduponthelandintowhichyouarecrossingoverthejordantogoandpossessdivcb_10icallheavenandearthtowitnessagainstyoutodayihavesetbeforeyoulifeanddeathblessingandcursethereforechooselifethatyouandyourseedmayliveinlovingjehovahyourgodbylisteningtohisvoiceandholdingfasttohimforheisyourlifeandthelengthofyourdaysthatyoumaydwelluponthelandwhichjehovahsworetoyourfatherstoabrahamtoissacandtojacobtogivethem');
        $tmp_search_meta_ARRAY[] = array('deut33_1-4,12,29' => 'spanscript_ref_num1andthisistheblessingwithwhichmosesthemanofgodblessedthechildrenofisraelbeforehisdeathdivcb_5andhesaidjehovahcamefromsinai&nbsp&nbsp&nbspandhedawneduponthemfromseirheshinedforthfrommountparan&nbsp&nbsp&nbspandheapproachedfromthemyriadsofholyones&nbsp&nbsp&nbspfromhisrighthandafierylawemwentemouttothemdivcb_5indeedhelovesthepeople&nbsp&nbsp&nbspallhissaintswereinyourhandandtheysatdownatyourfeet&nbsp&nbsp&nbspemeveryoneemreceivesofyourwordsdivcb_5mosescommandedusalaw&nbsp&nbsp&nbspapossessionofthecongregationofjacobdivcb_10spanscript_ref_num12concerningbenjaminhesaidthebelovedofjehovahshalldwellsecurelybesidehim&nbsp&nbsp&nbspemjehovahemshallcoveroverhimalltheday&nbsp&nbsp&nbspandheshalldwellbetweenhisshouldersdivcb_10spanscript_ref_num29happyareyouoisraelwhoislikeyou&nbsp&nbsp&nbspapeoplesavedbyjehovahtheshieldofyourhelp&nbsp&nbsp&nbspandemheemwhoistheswordofyourmajestysoyourenemiesshallcomecringingtoyou&nbsp&nbsp&nbspandyoushalltreadupontheirhighplaces');
        $tmp_search_meta_ARRAY[] = array('josh5_6' => 'forthechildrenofisraelwentforfortyyearsthroughthewildernessuntilallthenationthemenofwarwhohadcomeoutofegyptwereconsumedbecausetheydidnotlistentothevoiceofjehovahtheytowhomjehovahsworethattheywouldnotseethelandthatjehovahhassworntotheirfatherstogiveusalandflowingwithmilkandhoney');
        $tmp_search_meta_ARRAY[] = array('1sam4_4' => 'sothepeoplesentemmenemtoshilohandtheytookupfromtherethearkofthecovenantofjehovahofhostswhoisenthronedembetweenemthecherubimandthetwosonsofelihophniandphinehasweretherewiththearkofthecovenantofgod');
        $tmp_search_meta_ARRAY[] = array('1kings2_1-3' => 'whendavidstimetodiedrewnearhecommandedsolomonhissonsayingiamgoingthewayofalltheearthbestrongthereforeandbeamanandkeepthechargeofjehovahyourgodbywalkinginhiswaysbykeepinghisstatuteshiscommandmentsandhisordinancesandhistestimoniesastheyarewritteninthelawofmosesthatyoumayprosperinallthatyoudoandwhereveryouturn');
        $tmp_search_meta_ARRAY[] = array('1kings8_54-66' => 'andwhensolomonhasfinishedprayingallthisprayerandsupplicationtojehovahheroseupfrombeforethealterofjehovahfromkneelingonhiskneeswithhishandsspreadtowardtheheavensandhestoodandblessedthewholecongregationofisraelwithaloudvoicesayingdivcb_10blessedbejehovahwhohasgivenresttohispeopleisraelaccordingtoallthathepromisednotonewordofallhisgoodpromiseswhichhespokethroughmoseshisservanthasfailedmayjehovahourgodbewithusashewaswithourfatherslethimnotforsakeusnorabandonusthathemayinclineourheartstohimselftowalkinallhiswaysandtokeephiscommandmentsandhisstatutesandhisordinanceswhichhecommandedourfathersdivcb_10andletthesewordsofminewithwhichimadesupplicationtojehovahbeneartojehovahourgoddayandnighttomaintainthecauseofhisservantandthecauseofhispeopleisraelaseachdayrequiresthatallthepeoplesoftheearthmayknowthatjehovahisgodthereisnoneelseletyourheartthereforebeperfectwithjehovahourgodtowalkinhisstatutesandtokeephiscommandmentsasonthisdaydivcb_10andthekingandallisraelwithhimofferedsacrificesbeforejehovahandsolomonofferedasacrificeofpeaceofferingswhichheofferedtojehovahtwentytwothousandoxenandonehundredandtwentythousandsheepthusthekingandallthechildrenofisraeldedicatedthehouseofjehovahdivcb_10onthatdaythekingsanctifiedthemiddleofthecourtthatwasbeforethehouseofjehovahforthereheofferedtheburntofferingandthemealofferingandthefatofpeaceofferingsbecausethebronzealterwhichwasbeforejehovahwastoosmalltoreceivetheburntofferingandthemealofferingandthefatofpeaceofferingsdivcb_10andsolomonheldafeastatthattimeandallisraelwithhimagreatcongregationfromtheentranceofhamathtothebrookofegyptbeforejehovahourgodsevendaysandsevenmoredaysfourteendaysinallontheeightdayhesentthepeopleawayandtheyblessedthekingandwenttotheirtentsjoyfulandhappyinheartforallthegoodnesswhichjehovahhadshowntodavidhisservantandtoisraelhispeople');
        $tmp_search_meta_ARRAY[] = array('1kings18_37-40,45;19_1-18' => 'spanscript_ref_num37answermeojehovahanswermethatthispeoplemayknowthatyouojehovaharegodandthatyouhaveturnedtheirheartbackagainandthefireofjehovahfellandconsumedtheburntofferingandthewoodandthestonesandthedustanditlickedupthewaterthatwasinthetrenchdivcb_10andwhenthepeoplesawthistheyfellontheirfacesandsaidjehovah&ndash&ndashheisgodjehovah&ndash&ndashheisgoddivcb_10andelijahsaidtothemseizetheprophetsofbaalletnotoneofthemescapeandtheyseizedthemandelijahbroughtthemdowntothebrookkishonandslaughteredthemtheredivcb_10spanscript_ref_num45andinthemeantimetheheavensbecameblackwithcloudsandtherewaswindandagreatrainandahabmountedhischariotandwenttojezreeldivcb_10andthehandofjehovahwasuponelijahandhegirdeduphisloinsandranbeforeahabtotheentranceofjezreelandahabtoldjezebelallthatelijahhaddoneandallabouthowhehadslainalltheprophetswiththeswordandjezebelsentamessengertoelijahsayingthegodsdosotomeandevenmoreifbythistimetomorrowidonotmakeyourlifelikethelifeofoneofthemdivcb_10andbecausehewasafraidheroseupandwentawayforhislifeandhecametobeershebawhichbelongstojudahandlefthisattendantthereandhehimselfwentadaysjourneyintothewildernessandcameandsatdownunderacertainbroomshrubandherequestedforhimselfthathemightdieandsaiditisenoughnowojehovahtakemylifeforiamnobetterthanmyfathersdivcb_10andhelaydownandsleptunderthebroomshrubandsuddenlyanangeltouchedhimandsaidtohimriseupandeatandhelookedandthereathisheadwasacakebakedonhotstonesandajarofwaterandheateanddrankandlaydownagainandtheangelofjehovahcameagainthesecondtimeandtouchedhimandsaidriseupandeatforthejourneyistoogreatforyoudivcb_10andheroseupandateanddrankandhewentinthestrengthofthatfoodfortydaysandfortynightstohorebthemountofgodandtherehewentintoacaveandlodgedthereandatthattimethewordofjehovahcametohimandhesaidtohimwhatareyoudoinghereelijahdivcb_10andhesaidihavebeenveryjealousforjehovahthegodofhostsforthechildrenofisraelhaveforsakenyourcovenantthrowndownyouraltersandslainyourprophetswiththeswordandialoneamleftandtheyseektotakemylifedivcb_10andhesaidgooutandstanduponthemountainbeforejehovahandsuddenlyjehovahpassedbyandagreatstrongwindrentthemountainsandbroketherocksinpiecesbeforejehovah&ndash&ndashjehovahwasnotinthewindandafterthewindanearthquake&ndash&ndashjehovahwasnotintheearthquakedivcb_10andaftertheearthquakeafire&ndash&ndashjehovahwasnotinthefireandafterthefireagentlequietvoiceandwhenelijahheardithewrappedhisfaceinhismantleandwentoutandstoodattheentranceofthecaveandthenavoicecametohimandsaidwhatareyoudoinghereelijahdivcb_10andhesaidihavebeenveryjealousforjehovahthegodofhostsforthechildrenofisraelhaveforsakenyourcovenantthrowndownyouraltersandslainyourprophetswiththeswordandialoneamleftandtheyseektotakemylifedivcb_10andjehovahsaidtohimgoreturnonyourwaytothewildernessofdamascusandwhenyoucomethereanointhazaelaskingoversyriaandjehuthesonofnimshiyoushallanointaskingoverisraelandelishathesonofshaphatofabelmeholahyoushallanointasprophetinyourplacedivcb_10andhimwhoescapestheswordofhazaeljehuwillkillandhimwhoescapestheswordofjehuelishawillkilldivcb_10yetihaveleftmyselfseventhousandinisraelallthekneesthathavenotboweduntobaalandeverymouththathasnotkissedhim');
        $tmp_search_meta_ARRAY[] = array('neh1_1-11' => 'thewordsofnehemiahthesonofhacaliahnowinthemonthofchislevinthetwentiethyearwhileiwasinsusathecapitalhananioneofmybrotherscameheandsomemenfromjudahandiaskedthemaboutthejewswhohadescapedwhowereleftfromthecaptivityandaboutjerusalemdivcb_10andtheysaidtometheremnantwhoareleftfromthecaptivitythereintheprovinceareinanexceedinglybadstateandreproachandthewallofjerusalemisbrokendownanditsgateshavebeenburnedwithfiredivcb_10andwheniheardthesewordsisatdownandweptandimournedforsomedaysandifastedandprayedbeforethegodofheavenandisaidibeseechyouojehovahthegodofheaventhegreatandawesomegodwhokeepscovenantandlovingkindnesswiththosewholovehimandkeephiscommandmentsletyourearbeattentiveandyoureyesopentoheartheprayerofyourservantwhichipraybeforeyounowdayandnightconcerningthechildrenofisraelyourservantswhileiconfessthesinsofthechildrenofisraelthatwehavesinnedagainstyoudivcb_10indeediandthehouseofmyfatherhavesinnedwehavebeenmostcorrupttowardyouandhavenotkeptthecommandmentsandthestatutesandtheordinancesthatyoucommandedmosesyourservantremembernowthewordthatyoucommandedmosesyourservantsayingifyouareunfaithfuliwillscatteryouamongthepeoplesbutifyoureturntomeandkeepmycommandmentsandperformthemthoughyouroutcastsareundertheendsofheavenfromthereiwillgatherthemandbringthemtotheplacewhereihavechosentocausemynametodwelldivcb_10nowtheseareyourservantsandyourpeoplewhomyouhaveredeemedbyyourgreatpowerandbyyourstronghandibeseechyouolordletyourearbeattentivetotheprayerofyourservantandtotheprayerofyourservantswhotakedelightinfearingyournameandcauseyourservanttoprospertodayandgranthimtofindcompassionbeforethismandivcb_10nowiwascupbearertotheking');
        $tmp_search_meta_ARRAY[] = array('psa24' => 'apsalmofdaviddivcb_10theearthisjehovahsanditsfullness&nbsp&nbsp&nbspthehabitablelandandthosewhodwellinitforitishewhofoundeditupontheseas&nbsp&nbsp&nbspandestablishedituponthestreamsdivcb_5whomayascendthemountainofjehovah&nbsp&nbsp&nbspandwhomaystandinhisholyplacehewhohascleanhandsandapureheart&nbsp&nbsp&nbspwhohasnotlifteduphissoultofalsehood&nbsp&nbsp&nbsporsworndeceitfullyhewillreceiveblessingfromjehovah&nbsp&nbsp&nbspandrighteousnessfromthegodofhissalvationthisisthegenerationofthosewhoseekhim&nbsp&nbsp&nbspthosewhoseekyourfaceevenjacobselahdivcb_5liftupyourheadsogates&nbsp&nbsp&nbspandbeliftedupolongenduringdoors&nbsp&nbsp&nbspandthekingofglorywillcomeinwhoisthekingofglory&nbsp&nbsp&nbspjehovahstrongandmighty&nbsp&nbsp&nbspjehovahmightyinbattleliftupyourheadsogates&nbsp&nbsp&nbspandliftupolongenduringdoors&nbsp&nbsp&nbspandthekingofglorywillcomeinwhoisthiskingofglory&nbsp&nbsp&nbspjehovahofhosts&ndash&ndash&nbsp&nbsp&nbspheisthekingofgloryselah');
        $tmp_search_meta_ARRAY[] = array('psa95_10-11' => 'forfortyyearsiloathedthatgeneration&nbsp&nbsp&nbspandisaidtheyareapeoplewhogoastrayinheart&nbsp&nbsp&nbspandtheydonotknowmywaysthereforeisworeinmyanger&nbsp&nbsp&nbsptheyshallbynomeansenterintomyrest');
        $tmp_search_meta_ARRAY[] = array('psa97_2' => 'cloudsanddeepdarknesssurroundhim&nbsp&nbsp&nbsprighteousnessandjusticearethefoundationofhisthrone');
        $tmp_search_meta_ARRAY[] = array('psa119_103' => 'howsweetareyourwordstomytaste&nbsp&nbsp&nbspemsweeteremthanhoneytomymouth');
        $tmp_search_meta_ARRAY[] = array('prov20_27' => 'thespiritofmanisthelampofjehovah&nbsp&nbsp&nbspsearchingalltheinnermostpartsoftheinnerbeing');
        $tmp_search_meta_ARRAY[] = array('isa14_13' => 'butyouyousaidinyourheart&nbsp&nbsp&nbspiwillascendtoheavenabovethestarsofgod&nbsp&nbsp&nbspiwillexaltmythroneandiwillsituponthemountofassembly&nbsp&nbsp&nbspinthespanscript_sup2uttermostpartsofthenorth');
        $tmp_search_meta_ARRAY[] = array('isa14_21-24' => 'prepareaslaughterhouseforhischildren&nbsp&nbsp&nbspbecauseoftheiniquityoftheirfatherssothattheydonotriseupandpossesstheland&nbsp&nbsp&nbspandfillthesurfaceoftheworldwithcitiesdivcb_5andiwillriseupagainstthem&nbsp&nbsp&nbspdeclaresjehovahofhostsandiwillcutofffrombabylonnameandremnant&nbsp&nbsp&nbspandposterityandprogenydeclaresjehovahdivcb_5andiwillmakeitapossessionforporcupines&nbsp&nbsp&nbspandmuddiedpoolsofwaterandiwillsweepitwiththebroomofdestruction&nbsp&nbsp&nbspdeclaresjehovahofhostsdivcb_5jehovahofhostshasswornsayingsurelyjustasiconceiveditsohasithappened&nbsp&nbsp&nbspandjustasihavepurposeditsoshallthisstand');
        $tmp_search_meta_ARRAY[] = array('isa16_1-5' => 'sendalambemoftributeem&nbsp&nbsp&nbsptotherulerofthelandfromselaacrossthewilderness&nbsp&nbsp&nbsptothemountainofthedaughterofziondivcb_5likewanderingbirds&nbsp&nbsp&nbspemlikeemascatterednestwillthedaughtersofmoabbe&nbsp&nbsp&nbspatthefordsofthearnondivcb_5giveemusemcounsel&nbsp&nbsp&nbspmakeajudgementemconcerningusemmakeyourshadowathighnoon&nbsp&nbsp&nbsplikenightemtousemhidetheoutcasts&nbsp&nbsp&nbspdonotexposehimwhowandersdivcb_5lettheoutcastsofmoab&nbsp&nbsp&nbspdwellwithyoubeahidingplacetothem&nbsp&nbsp&nbspfromthedestroyerwhentheextortionerfinishes&nbsp&nbsp&nbspemandemdestructionends&nbsp&nbsp&nbspemwhenemtheoppressoriscompletelyemgoneemfromthelanddivcb_5thenwillathronebeestablishedinlovingkindness&nbsp&nbsp&nbspanduponitonewillsitintruth&nbsp&nbsp&nbspinthetentofdavidjudgingandpursuingjustice&nbsp&nbsp&nbspandhasteningrighteousness');
        $tmp_search_meta_ARRAY[] = array('isa53_6' => 'wealllikesheephavegoneastray&nbsp&nbsp&nbspeachofushasturnedtohisownwayandjehovahhascausedtheiniquityofusall&nbsp&nbsp&nbsptofallonhim');
        $tmp_search_meta_ARRAY[] = array('jer1_11-19' => 'thenthewordofjehovahcametomesayingwhatdoyouseejeremiahandisaidiseearodofanalmondtreeandjehovahsaidtomeyouhaveseenwellforiamwatchingovermywordtoperformitthenthewordofjehovahcametomeasecondtimesayingwhatdoyouseeandisaidiseeaboilingpotanditisfacingawayfromthenorthdivcb_10andjehovahsaidtomeoutofthenorthevilwillbeletlooseuponalltheinhabitantsofthelandforiamnowcallingallthefamiliesfromthekingdomsofthenorthdeclaresjehovahandtheywillcomeandseteachonehisthroneattheentranceofthegatesofjerusalemandagainstallitswallsallaroundandagainstallthecitiesofjudahandiwilluttermyjudgementonthemconcerningalltheirwickednessbywhichtheyhaveforsakenmeandhaveburnedincensetoothergodsandhaveworshippedtheworksoftheirownhandsdivcb_10youthereforegirdupyourloinsandriseupandspeaktothemeverythingthaticommandyoudonotbedismayedbeforethemlestidismayyouintheirpresenceandiamnowmakingyoutodayintoafortifiedcityandintoanironpillarandintobronzewallsagainstthewholelandagainstthekingsofjudahagainstitsprincesagainstitspriestsandagainstthepeopleofthelandandtheywillfightagainstyoubuttheywillnotprevailagainstyouforiamwithyoudeclaresjehovahtodeliveryou');
        $tmp_search_meta_ARRAY[] = array('jer24_7' => 'andiwillgivethemahearttoknowmethatiamjehovahandtheywillbemypeopleandiwillbetheirgodfortheywillreturntomewiththeirwholeheart');
        $tmp_search_meta_ARRAY[] = array('jer31_31-34' => 'indeeddaysarecomingdeclaresjehovahwheniwillmakeanewcovenantwiththehouseofisraelandwiththehouseofjudahnotlikethecovenantwhichimadewiththeirfathersinthedayitookthembytheirhandtobringthemoutfromthelandofegyptmycovenantwhichtheybrokealthoughiwastheirhusbanddeclaresjehovahdivcb_10butthisisthecovenantwhichiwillmakewiththehouseofisraelafterthosedaysdeclaresjehovahiwillputmylawintheirinwardpartsandwriteitupontheirheartsandiwillbetheirgodandtheywillbemypeopledivcb_10andtheywillnolongerteacheachmanhisneighborandeachmanhisbrothersayingknowjehovahforallofthemwillknowmefromthelittleoneamongthemeventothegreatoneamongthemdeclaresjehovahforiwillforgivetheiriniquityandtheirsiniwillremembernomore');
        $tmp_search_meta_ARRAY[] = array('jer31_33-34' => 'butthisisthecovenantwhichiwillmakewiththehouseofisraelafterthosedaysdeclaresjehovahiwillputmylawintheirinwardpartsandwriteitupontheirheartsandiwillbetheirgodandtheywillbemypeopledivcb_10andtheywillnolongerteacheachmanhisneighborandeachmanhisbrothersayingknowjehovahforallofthemwillknowmefromthelittleoneamongthemeventothegreatoneamongthemdeclaresjehovahforiwillforgivetheiriniquityandtheirsiniwillremembernomore');
        $tmp_search_meta_ARRAY[] = array('jer31_33-37' => 'butthisisthecovenantwhichiwillmakewiththehouseofisraelafterthosedaysdeclaresjehovahiwillputmylawintheirinwardpartsandwriteitupontheirheartsandiwillbetheirgodandtheywillbemypeopleandtheywillnolongerteacheachmanhisneighborandeachmanhisbrothersayingknowjehovahforallofthemwillknowmefromthelittleoneamongthemeventothegreatoneamongthemdeclaresjehovahforiwillforgivetheiriniquityandtheirsiniwillremembernomoredivcb_10thussaysjehovahwhogivesthesunforlightbyday&nbsp&nbsp&nbspandtheorderofthemoonandthestarsforlightbynightwhostirsuptheseasothatitswavesroar&ndash&ndash&nbsp&nbsp&nbspjehovahofhostsishisname&ndash&ndashdivcb_10ifthisorderdeparts&nbsp&nbsp&nbspfrombeforemedeclaresjehovahthentheseedofisraelwillalsocease&nbsp&nbsp&nbspfrombeinganationbeforemeforeverdivcb_10thussaysjehovahiftheheavensabovecanbemeasured&nbsp&nbsp&nbspandthefoundationsoftheearthbelowcanbeexaminedcarefullytheniwillalsocastoffalltheseedofisrael&nbsp&nbsp&nbspforalltheyhavedonedeclaresjehovah');
        $tmp_search_meta_ARRAY[] = array('jer31_31-37' => 'indeeddaysarecomingdeclaresjehovahwheniwillmakeanewcovenantwiththehouseofisraelandwiththehouseofjudahnotlikethecovenantwhichimadewiththeirfathersinthedayitookthembytheirhandtobringthemoutfromthelandofegyptmycovenantwhichtheybrokealthoughiwastheirhusbanddeclaresjehovahdivcb_10butthisisthecovenantwhichiwillmakewiththehouseofisraelafterthosedaysdeclaresjehovahiwillputmylawintheirinwardpartsandwriteitupontheirheartsandiwillbetheirgodandtheywillbemypeopleandtheywillnolongerteacheachmanhisneighborandeachmanhisbrothersayingknowjehovahforallofthemwillknowmefromthelittleoneamongthemeventothegreatoneamongthemdeclaresjehovahforiwillforgivetheiriniquityandtheirsiniwillremembernomoredivcb_10thussaysjehovahwhogivesthesunforlightbyday&nbsp&nbsp&nbspandtheorderofthemoonandthestarsforlightbynightwhostirsuptheseasothatitswavesroar&ndash&ndash&nbsp&nbsp&nbspjehovahofhostsishisname&ndash&ndashdivcb_10ifthisorderdeparts&nbsp&nbsp&nbspfrombeforemedeclaresjehovahthentheseedofisraelwillalsocease&nbsp&nbsp&nbspfrombeinganationbeforemeforeverdivcb_10thussaysjehovahiftheheavensabovecanbemeasured&nbsp&nbsp&nbspandthefoundationsoftheearthbelowcanbeexaminedcarefullytheniwillalsocastoffalltheseedofisrael&nbsp&nbsp&nbspforalltheyhavedonedeclaresjehovah');
        $tmp_search_meta_ARRAY[] = array('ezek11_17-25' => 'thereforesaythussaysthelordjehovahiwillgatheryoufromthepeoplesandassembleyoufromthecountriesamongwhichyouhavebeenscatteredandiwillgiveyouthelandofisraelandtheywillcomethereandtakeawayallitsdetestablethingsandallitsabominationsfromitdivcb_10andiwillgivethemoneheartandanewspiritiwillputwithinthemandiwilltaketheheartofstoneoutoftheirfleshandgivethemaheartoffleshthattheymaywalkinmystatutesandkeepmyordinancesanddothemandtheywillbemypeopleandiwillbetheirgoddivcb_10butasforthosewhoseheartgoesaftertheirdetestablethingsandtheirabominationsiwillbringtheirwaysupontheirheadsdeclaresthelordjehovahdivcb_10thenthecherubimlifteduptheirwingsandthewheelswerenexttothemandthegloryofthegodofisraelwasoverthemaboveandthegloryofjehovahwentupfromthemidstofthecityandstooduponthemountainwhichiseastofthecityandthespiritliftedmeupandbroughtmetochaldeatothecaptivesinavisionbythespiritofgodandthevisionthatihadseenwentupfrommedivcb_10thenitoldthecaptivesallthethingsthatjehovahhadshownme');
        $tmp_search_meta_ARRAY[] = array('dan9_4' => 'andiprayedtojehovahmygodandconfessedandisaidahlordthegreatandawesomegodwhokeepscovenantandlovingkindnesswiththosewholovehimandkeephiscommandments');
        $tmp_search_meta_ARRAY[] = array('dan9_17-27' => 'andnowhearoourgodtheprayerofyourservantandhissupplicationsandcauseyourfacetoshineuponyoursanctuarythathasbeendesolatedforthelordssakeomygodinclineyourearandhearopenyoureyesandseeourdesolationsandthecitythatiscalledbyyournameforwearenotpresentingoursupplicationsbeforeyoubaseduponanyrighteousdoingsthatwehavedonebutbaseduponyourgreatcompassiondivcb_10olordhearolordforgiveolordlistenandtakeactiondonotdelayforyourownsakeomygodforyourcityandyourpeoplearecalledbyyouremownemnamedivcb_10andwhileiwasstillspeakingandprayingandconfessingmysinandthesinofmypeopleisraelandpresentingmysupplicationbeforejehovahmygodfortheholymountainofmygodevenwhileiwasspeakinginprayerthemangabrielwhomihadseeninthevisionatthebeginningreachedmeinemmyemutterexhaustionaboutthetimeoftheeveningoblationdivcb_10andheinformedemmeemandtalkedwithmeandsaiddanielihavenowcomeforthtogiveyouinsightandunderstandingatthebeginningofyoursupplicationsthecommandwentforthandihavecometotellemyouemforyouarepreciousnessitselfthereforeunderstandthematterandconsiderthevisiondivcb_10seventyweeksareapportionedforyourpeopleandforyourholycitytoclosethetransgressionandtomakeanendofsinsandtomakepropitiationforiniquityandtobringintherighteousnessoftheagesandtosealupvisionandprophetandtoanointtheholyofholiesdivcb_10knowthereforeandcomprehendfromtheissuingofthedecreetorestoreandrebuildjerusalemuntilemthetimeofemmessiahtheprincewillbesevenweeksandsixtytwoweeksitwillbebuiltagainwithstreetandtrenchevenindistressfultimesandafterthesixtytwoweeksmessiahwillbecutoffandwillhavenothingandthepeopleoftheprincewhowillcomewilldestroythecityandthesanctuaryandtheendofitwillbeafloodandeventotheendemtherewillbeemwardesolationsaredetermineddivcb_10andhewillmakeafirmcovenantwiththemanyforoneweekandinthemiddleoftheweekhewillasup_ftnt_1script_suponclickjony5_vv_scroll_toftnt_11acausethesacrificeandtheoblationtoceaseandwillreplacethesacrificeandtheoblationwithabominationsofthedesolatorevenuntilthecompletedestructionthathasbeendeterminedispouredoutuponthedesolator');
        $tmp_search_meta_ARRAY[] = array('joel2_23' => 'ochildrenofzion&nbsp&nbsp&nbspbegladandrejoice&nbsp&nbsp&nbspinjehovahyourgodforhegivesyou&nbsp&nbsp&nbsptheearlyraininrighteousness&nbsp&nbsp&nbspandhemakestheraincomedownforyoutheasup_ftnt_1script_suponclickjony5_vv_scroll_toftnt_11aearlyrainandtheasup_ftnt_1script_suponclickjony5_vv_scroll_toftnt_11alaterain&nbsp&nbsp&nbspatthebeginningoftheseason');
        $tmp_search_meta_ARRAY[] = array('matt1_18,20' => 'spanscript_ref_num18nowtheoriginofjesuschristwasinthiswayhismothermaryaftershehadbeenengagedtojosephbeforetheycametogetherwasfoundtobewithchildoftheholyspiritdivcb_10spanscript_ref_num20butwhileheponderedthesethingsbeholdanangelofthelordappearedtohiminadreamsayingjosephsonofdaviddonotbeafraidtotakemaryyourwifeforthatwhichhasbeenspanscript_sup1begotteninherisoftheholyspirit');
        $tmp_search_meta_ARRAY[] = array('matt2_4-6' => 'andgatheringtogetherallthechiefpriestsandscribesofthepeopleheinquiredofthemwherethechristwastobebornandtheysaidtohiminbethlehemofjudeaforsoitiswrittenthroughtheprophet&quotandyoubethlehemlandofjudahbynomeansareyoutheleastamongtheprincesofjudahforoutofyoushallcomefortharuleronewhowillshepherdmypeopleisrael&quot');
        $tmp_search_meta_ARRAY[] = array('matt3_15' => 'butjesusansweredandsaidtohimpermititfornowforitisfittingforusinthiswaytofulfillallspanscript_sup1righteousnessthenhepermittedhim');
        $tmp_search_meta_ARRAY[] = array('matt4_1-2' => 'thenjesuswasledupintothewildernessbythespirittobetemptedbythedevilandwhenhehadfastedfortydaysandfortynightsafterwardhebecamehungry');
        $tmp_search_meta_ARRAY[] = array('matt4_3' => 'andthetemptercameandsaidtohimifyouarethesonofgodspeakthatthesestonesmaybecomeloavesofbread');
        $tmp_search_meta_ARRAY[] = array('matt4_4b' => 'manshallnotliveonbreadalonebutoneverywordthatproceedsoutthroughthemouthofgod');
        $tmp_search_meta_ARRAY[] = array('matt4_5-7' => 'thenthedeviltookhimintotheholycityandsethimonthewingofthetempleandsaidtohimifyouarethesonofgodcastyourselfdownforitiswritten&quottohisangelsheshallgivechargeconcerningyouandonemtheiremhandstheyshallbearyouuplestyoustrikeyourfootagainstastone&quotjesussaidtohimagainitiswritten&quotyoushallnottestthelordyourgod&quot');
        $tmp_search_meta_ARRAY[] = array('matt5_10' => 'blessedarethosewhoarepersecutedforthesakeofrighteousnessfortheirsisthekingdomoftheheavens');
        $tmp_search_meta_ARRAY[] = array('matt5_13' => 'youarethesaltoftheearthbutifthesalthasbecometastelesswithwhatshallitbesalteditisnolongergoodforanythingexcepttobecastoutandtrampledunderfootbymen');
        $tmp_search_meta_ARRAY[] = array('matt5' => 'andwhenhesawthecrowdshewentuptothemountainandafterhesatdownhisdisciplescametohimandopeninghismouthhetaughtthemsayingblessedarethepoorinspiritfortheirsisthekingdomoftheheavensblessedarethosewhomournfortheyshallbecomfortedblessedarethemeekfortheyshallinherittheearthblessedarethosewhohungerandthirstforrighteousnessfortheyshallbesatisfiedblessedarethemercifulfortheyshallbeshownmercyblessedarethepureinheartfortheyshallseegodblessedarethepeacemakersfortheyshallbecalledthesonsofgodblessedarethosewhoarepersecutedforthesakeofrighteousnessfortheirsisthekingdomoftheheavensblessedareyouwhentheyreproachandpersecuteyouandwhilespeakingliessayeveryevilthingagainstyoubecauseofmerejoiceandexultforyourrewardisgreatintheheavensforsotheypersecutedtheprophetswhowerebeforeyoudivcb_10youarethesaltoftheearthbutifthesalthasbecometastelesswithwhatshallitbesalteditisnolongergoodforanythingexcepttobecastoutandtrampledunderfootbymenyouarethelightoftheworlditisimpossibleforacitysituateduponamountaintobehiddennordoemmenemlightalampandplaceitunderthebushelbutonthelampstandanditshinestoallwhoareinthehouseinthesamewayletyourlightshinebeforemensothattheymayseeyourgoodworksandglorifyyourfatherwhoisintheheavensdivcb_10donotthinkthatihavecometoabolishthelawortheprophetsihavenotcometoabolishbuttofulfillfortrulyisaytoyouuntilheavenandearthpassawayoneiotaoroneserifshallbynomeanspassawayfromthelawuntilallcometopassthereforewhoeverannulsoneoftheleastofthesecommandmentsandteachesmensoshallbecalledtheleastinthekingdomoftheheavensbutwhoeverpracticesandteachesemthememheshallbecalledgreatinthekingdomoftheheavensforisaytoyouthatunlessyourrighteousnesssurpassesthatofthescribesandphariseesyoushallbynomeansenterintothekingdomoftheheavensyouhaveheardthatitwassaidtotheancients&quotyoushallnotmurderandwhoevermurdersshallbeliabletothejudgement&quotbutisaytoyouthateveryonewhoisangrywithhisbrothershallbeliabletothejudgementandwhoeversaystohisbrotherracashallbeliabletoemthejudgementofemthesanhedrinandwhoeversaysmorehshallbeliabletothegehennaoffirethereforeifyouareofferingyourgiftatthealterandthereyourememberthatyourbrotherhassomethingagainstyouleaveyourgifttherebeforethealterandfirstgoandbereconciledtoyourbrotherandthencomeandofferyourgiftbewelldisposedquicklytowardyouropponentatlawwhileyouarewithhimonthewaylesttheopponentdeliveryoutothejudgeandthejudgetotheofficerandyoubethrownintoprisontrulyisaytoyouyoushallbynomeanscomeoutfromthereuntilyoupaythelastquadransyouhaveheardthatitwassaid&quotyoushallnotcommitadultery&quotbutisaytoyouthateveryonewholooksatawomaninordertolustafterherhasalreadycommittedadulterywithherinhisheartsoifyourrighteyestumblesyoupluckitoutandcastemitemfromyouforitismoreprofitableforyouthatoneofyourmembersperishthanforyourwholebodytobecastintogehennaandifyourrighthandstumblesyoucutitoffandcastemitemfromyouforitismoreprofitableforyouthatoneofyourmembersperishthanforyourwholebodytopassawayintogehennaanditwassaidwhoeverdivorceshiswifelethimgiveheracertificateofdivorcebutisaytoyouthateveryonewhodivorceshiswifeexceptforthecauseoffornicationcauseshertocommitadulteryandwhoevermarriesherwhohasbeendivorcedcommitsadulteryagainyouhaveheardthatitwassaidtotheancients&quotyoushallnotbreakanoathbutyoushallrendertothelordyouroaths&quotbutitellyounottoswearatallneitherbyheavenbecauseitisthethroneofgodnorbytheearthbecauseitisthefootstoolofhisfeetnoruntojerusalembecauseitisthecityofthegreatkingneithershallyouswearbyyourheadbecauseyoucannotmakeonehairwhiteorblackbutletyourwordbeyesyesnonoforanythingmorethantheseisoftheeviloneyouhaveheardthatitwassaid&quotaneyeforaneyeandatoothforatooth&quotbutitellyounottoresisthimwhoisevilratherwhoeverslapsyouonyourrightcheekturntohimtheotheralsoandtohimwhowishestosueyouandtakeyourtunicyieldtohimyourcloakalsoandwhoevercompelsyoutogoonemilegowithhimtwotohimwhoasksofyougiveandfromhimwhowantstoborrowfromyoudonotturnawayyouhaveheardthatitwassaid&quotyoushallloveyourneighborandhateyourenemy&quotbutisaytoyouloveyourenemiesandprayforthosewhopersecuteyousothatyoumaybecomesonsofyourfatherwhoisintheheavensbecausehecauseshissuntoriseontheevilandthegoodandsendsrainonthejustandtheunjustforifyoulovethosewholoveyouwhatrewarddoyouhavedonoteventhetaxcollectorsdothesameandifyougreetonlyyourbrotherswhatbetterthingareyoudoingdonoteventhegentilesdothesameyouthereforeshallbeperfectasyourheavenlyfatherisperfect');
        $tmp_search_meta_ARRAY[] = array('matt6' => 'buttakecarenottodoyourrighteousnessbeforemeninordertobegazedatbythemotherwiseyouhavenorewardwithyourfatherwhoisintheheavensthereforewhenyougivealmsdonotsoundatrumpetbeforeyouasthehypocritesdointhesynagoguesandinthestreetssothattheymaybeglorifiedbymentrulyisaytoyoutheyhavetheirrewardinfullbutyouwhenyougivealmsdonotletyourlefthandknowwhatyourrighthandisdoingsothatyouralmsmaybeinsecretandyourfatherwhoseesinsecretwillrepayyouandwhenyouprayyoushallnotbelikethehypocritesbecausetheylovetopraystandinginthesynagoguesandonthestreetcornerssothattheymaybeseenbymentrulyisaytoyoutheyhavetheirrewardinfullbutyouwhenyouprayenterintoyourprivateroomandshutyourdoorandpraytoyourfatherwhoisinsecretandyourfatherwhoseesinsecretwillrepayyouandinprayingdonotbabbleemptywordsasthegentilesdofortheysupposethatintheirmultiplicityofwordstheywillbeheardthereforedonotbelikethemforyourfatherknowsthethingsthatyouhaveneedofbeforeyouaskhimyouthenprayinthiswayourfatherwhoisintheheavensyournamebesanctifiedyourkingdomcomeyourwillbedoneasinheavenemsoemalsoonearthgiveustodayourdailybreadandforgiveusourdebtsaswealsohaveforgivenourdebtorsanddonotbringusintotemptationbutdeliverusfromtheeviloneforyoursisthekingdomandthepowerandthegloryforeveramenforifyouforgivementheiroffensesyourheavenlyfatherwillforgiveyoualsobutifyoudonotforgivementheiroffensesneitherwillyourfatherforgiveyouroffensesandwhenyoufastdonotbelikethesullenfacedhypocritesfortheydisfiguretheirfacessothattheymayappeartomentobefastingtrulyisaytoyoutheyhavetheirrewardinfullbutyouwhenyoufastanointyourheadandwashyourfacesothatyoumaynotappeartomentobefastingbuttoyourfatherwhoisinsecretandyourfatherwhoseesinsecretwillrepayyoudivcb_10donotstoreupforyourselvestreasuresontheearthwheremothandrustconsumeandwherethievesdigthroughandstealbutstoreupforyourselvestreasuresinheavenwhereneithermothnorrustconsumesandwherethievesdonotdigthroughnorstealforwhereyourtreasureistherewillyourheartbealsothelampofthebodyistheeyeifthereforeyoureyeissingleyourwholebodywillbefulloflightbutifyoureyeisevilyourwholebodywillbedarkifthenthelightthatisinyouisdarknesshowgreatisthedarknessnoonecanservetwomastersforeitherhewillhatetheoneandlovetheotherorhewillholdtooneanddespisetheotheryoucannotservegodandmammonbecauseofthisisaytoyoudonotbeanxiousforyourlifewhatyoushouldeatorwhatyoushoulddrinknorforyourbodywhatyoushouldputonisnotthelifemorethanfoodandthebodythanclothinglookatthebirdsofheaventheydonotsownorreapnorgatherintobarnsyetyourheavenlyfathernourishesthemareyounotofmorevaluethantheywhoamongyoubybeinganxiouscanaddonecubittohisstatureandwhyareyouanxiousconcerningclothingconsiderwelltheliliesofthefieldhowtheygrowtheydonottoilneitherdotheyspinemthreadembutitellyouthatnotevensolomoninallhisglorywasclothedlikeoneoftheseandifgodsoarraysthegrassofthefieldwhichisemhereemtodayandtomorrowiscastintothefurnaceemwillheemnotmuchmoreemclotheemyouyouoflittlefaiththereforedonotbeanxioussayingwhatshallweeatorwhatshallwedrinkorwithwhatshallwebeclothedforallthesethingsthegentilesareanxiouslyseekingforyourheavenlyfatherknowsthatyouneedallthesethingsbutseekfirsthiskingdomandhisrighteousnessandallthesethingswillbeaddedtoyouthereforedonotbeanxiousfortomorrowfortomorrowwillbeanxiousforitselfsufficientforthedayisitsemownemevil');
        $tmp_search_meta_ARRAY[] = array('matt7' => 'donotjudgethatyoubenotjudgedforwithwhatjudgementyoujudgeyoushallbejudgedandwithwhatmeasureyoumeasureitshallbemeasuredtoyouandwhydoyoulookatthesplinterwhichisinyourbrothersseyebutthebeaminyoureyeyoudonotconsiderorhowcanyousaytoyourbrotherletmeremovethesplinterfromyoureyeandbeholdthebeamisinyoureyehypocritefirstremovethebeamfromyoureyeandthenyouwillseeclearlytoremovethesplinterfromyourbrotherseyedonotgivethatwhichisholytothedogsneithercastyourpearlsbeforethehogslesttheytramplethemwiththeirfeetandturnandtearyouaskanditshallbegiventoyouseekandyoushallfindknockanditshallbeopenedtoyouforeveryonewhoasksreceivesandhewhoseeksfindsandtohimwhoknocksitshallbeopenedorwhatmanisthereamongyouwhowhenhissonaskshimforaloafwillgivehimastoneoralsowhenheasksforafishwillgivehimaserpentifyouthenbeingevilknowemhowemtogivegoodgiftstoyourchildrenhowmuchmorewillyourfatherwhoisintheheavensgivegoodthingstothosewhoaskhimthereforeallthatyouwishmenwoulddotoyousoalsoyoudotothemforthisisthelawandtheprophetsdivcb_10enterthroughthenarrowgateforwideisthegateandbroadisthewaythatleadstodestructionandmanyarethosewhoenterthroughitbecausenarrowisthegateandconstrictedisthewaythatleadstolifeandfewarethosewhofinditbewareoffalseprophetswhocometoyouinsheepsclothingbutinwardlytheyareravenouswolvesbytheirfruitsyouwillrecognizethemdoemmenemgathergrapesfromthornsorfigsfromthistlesevensoeverygoodtreeproducesgoodfruitbutthecorrupttreeproducesbadfruitagoodtreecannotproducebadfruitneithercanacorrupttreeproducegoodfruiteverytreethatdoesnotproducegoodfruitiscutdownandcastintothefiresothenbytheirfruitsyouwillrecognizethemnoteveryonewhosaystomelordlordwillenterintothekingdomoftheheavensbuthewhodoesthewillofmyfatherwhoisintheheavensmanywillsaytomeinthatdaylordlordemwasitemnotinyournameemthatemweprophesiedandinyournamecastoutdemonsandinyournamedidmanyworksofpowerandtheniwilldeclaretothemineverknewyoudepartfrommeyouworkersoflawlessnesseveryonethereforewhohearsthesewordsofmineanddoesthemshallbelikenedtoaprudentmanwhobuilthishouseupontherockandtheraindescendedandtheriverscameandthewindsblewandtheybeatagainstthathouseanditdidnotfallforitwasfoundedontherockandeveryonewhohearsthesewordsofmineanddoesnotdothemshallbelikenedtoafoolishmanwhobuilthishouseuponthesandandtheraindescendedandtheriverscameandthewindsblewandtheydashedagainstthathouseanditfellanditsfallwasgreatandwhenjesusfinishedthesewordsthecrowdswereastoundedathisteachingforhetaughtthemasonehavingauthorityandnotliketheirscribes');
        $tmp_search_meta_ARRAY[] = array('matt7_13-14' => 'enterinthroughthenarrowgateforwideisthegateandbroadisthewaythatleadstodestructionandmanyarethosewhoenterthroughitbecausenarrowisthegateandconstrictedisthewaythatleadstolifeandfewarethosewhofindit');
        $tmp_search_meta_ARRAY[] = array('matt10_10b' => 'fortheworkerisworthyofhisfood');
        $tmp_search_meta_ARRAY[] = array('matt10_16-33' => 'beholdisendyouforthassheepinthemidstofwolvesbethereforeprudentasserpentsandguilelessasdovesandbewareofmenfortheywilldeliveryouuptosanhedrinsandintheirsynagoguestheywillscourgeyouandyouwillalsobebroughtbeforegovernorsandkingsformysakeforatestimonytothemandtothegentilesdivcb_10butwhentheydeliveryouupdonotbeanxiousabouthoworwhatyoushouldspeakforitwillbegiventoyouinthathourwhatyoushouldspeakforyouarenottheonesspeakingbutthespiritofyourfatheristheonespeakinginyoudivcb_10andbrotherwilldeliverupbrothertodeathandfatheremhisemchildandchildrenwillriseupagainstemtheiremparentsandputthemtodeathandyouwillbehatedbyallbecauseofmynamebuthewhohasenduredtotheendthisoneshallbesaveddivcb_10andwhentheypersecuteyouinthiscityfleeintoanotherfortrulyisaytoyouyoushallbynomeansfinishthecitiesofisraeluntilthesonofmancomesadiscipleisnotabovetheteachernoraslaveabovehismasteritissufficientforthedisciplethathebecomelikehisteacherandtheslavelikehismasteriftheyhavecalledthemasterofthehousebeelzebulhowmuchmorethoseofhishouseholddivcb_10thereforedonotfearthemforthereisnothingcoveredwhichwillnotberevealedandhiddenwhichwillnotbemadeknownwhatisaytoyouinthedarknessspeakinthelightandwhatyouhearintheearproclaimonthehousetopsanddonotfearthosewhokillthebodybutarenotabletokillthesoulbutratherfearhimwhoisabletodestroybothsoulandbodyingehennadivcb_10arenottwosparrowssoldforanassarionandnotoneofthemwillfalltotheearthapartfromyourfatherbuteventhehairsofyourheadareallnumberedthereforedonotfearyouareofmorevaluethanmanysparrowsdivcb_10everyonethereforewhowillconfessinmebeforemenialsowillconfessinhimbeforemyfatherwhoisintheheavensbutwhoeverwilldenymebeforemenialsowilldenyhimbeforemyfatherwhoisintheheavens');
        $tmp_search_meta_ARRAY[] = array('matt11_28-30' => 'cometomeallwhotoilandareburdenedandiwillgiveyouresttakemyyokeuponyouandlearnfrommeforiammeekandlowlyinheartandyouwillfindrestforyoursoulsformyyokeiseasyandmyburdenislight');
        $tmp_search_meta_ARRAY[] = array('matt12_1-8' => 'atthattimejesuswentonthesabbaththroughthegrainfieldsandhisdisciplesbecamehungryandbegantopickearsofgrainandeatbutthephariseesseeingemthisemsaidtohimbeholdyourdisciplesaredoingwhatisnotlawfultodoonthesabbathbuthesaidtothemhaveyounotreadwhatdaviddidwhenhebecamehungryandthosewhowerewithhimhowheenteredintothehouseofgodandtheyatethebreadofthepresencewhichwasnotlawfulforhimtoeatnorforthosewhowerewithhimexceptforthepriestsonlyorhaveyounotreadinthelawthatonthesabbaththepriestsinthetempleprofanethesabbathandareguiltlessdivcb_10butisaytoyouthatsomethinggreaterthanthetempleisherebutifyouknewwhatemthisemmeans&quotidesiremercyandnotsacrifice&quotyouwouldnothavecondemnedtheguiltlessforthesonofmanislordofthesabbath');
        $tmp_search_meta_ARRAY[] = array('matt12_5' => 'orhaveyounotreadinthelawthatonthesabbaththepriestsinthetempleprofanethesabbathandareguiltless');
        $tmp_search_meta_ARRAY[] = array('matt13_4' => 'andashesowedsomeasup_ftnt_1script_suponclickjony5_vv_scroll_toftnt_11aemseedsemfellasup_ftnt_2script_suponclickjony5_vv_scroll_toftnt_22abesidethewayandthebirdscameanddevouredthem');
        $tmp_search_meta_ARRAY[] = array('matt16_25-26' => 'forwhoeverwantstosavehissoullifeshallloseitbutwhoeverloseshissoullifeformysakeshallitforwhatshallamanbeprofitedifhegainsthewholeworldbutforfeitshissoullifeorwhatshallamangiveinexchangeforhissoullife');
        $tmp_search_meta_ARRAY[] = array('matt19_12' => 'forthereareeunuchswhowerebornsofromtheirmotherswombandthereareeunuchswhoweremadeeunuchsbymenandthereareeunuchswhomadethemselveseunuchsbecauseofthekingdomoftheheavenshewhocanemacceptitemlethimacceptemitem');
        $tmp_search_meta_ARRAY[] = array('matt24_8-14' => 'allthesethingsarethebeginningofbirthpangsthentheywilldeliveryouuptotribulationandwillkillyouandyouwillbehatedbyallthenationsbecauseofmynameandatthattimemanywillbestumbledandwilldeliveruponeanotherandwillhateoneanotherandmanyfalseprophetswillariseandwillleadmanyastrayandbecauselawlessnesswillbemultipliedtheloveofthemanywillgrowcolddivcb_10buthewhohasenduredtotheendthisoneshallbesavedandthisgospelofthekingdomwillbepreachedinthewholeinhabitedearthforatestimonytoallthenationsandthentheendwillcome');
        $tmp_search_meta_ARRAY[] = array('matt24_14' => 'andthisgospelofthekingdomwillbepreachedinthewholeinhabitedearthforatestimonytoallthenationsandthentheendwillcome');
        $tmp_search_meta_ARRAY[] = array('matt24_15-22' => 'thereforewhenyouseetheabominationofdesolationwhichwasspokenofthroughdanieltheprophetstandingintheholyplaceletasup_ftnt_1script_suponclickjony5_vv_scroll_toftnt_11ahimwhoreadsunderstandthenletthoseinjudeafleetothemountainslethimwhoisonthehousetopnotcomedowntotakethethingsoutofhishouseandlethimwhoisinthefieldnotturnbacktotakehisgarmentbutwoetothosewhoarepregnantandtothosewhoarenursingembabieseminthosedaysandpraythatyourflightmaynotbeinwinternoronasabbathdivcb_10foratthattimetherewillbegreattribulationsuchashasnotoccurredfromthebeginningoftheworlduntilnownorshallbyanymeanseveroccurandunlessthosedayshadbeencutshortnofleshwouldbesavedbutonaccountofthechosenthosedayswillbecutshort');
        $tmp_search_meta_ARRAY[] = array('matt25_4' => 'buttheprudenttookoilintheirvesselswiththeirlamps');
        $tmp_search_meta_ARRAY[] = array('matt25_23,10b' => 'spanscript_ref_num23hismastersaidtohimwellemdoneemgoodandfaithfulslaveyouwerefaithfuloverafewthingsiwillsetyouovermanythingsenterintothejoyofyourmasterdivcb_10spanscript_ref_num10bandthosewhowerereadywentinwithhimtotheweddingfeastandthedoorwasshut');
        $tmp_search_meta_ARRAY[] = array('matt26_33-35,69-75' => 'spanscript_ref_num33thenpeteransweredandsaidtohimifallwillbestumbledbecauseofyouiwillneverbestumbledjesussaidtohimtrulyisaytoyouthatinthisnightbeforearoostercrowsyouwilldenymethreetimespetersaidtohimevenifimustdiewithyouiwillbynomeansdenyyouandallthedisciplessaidlikewisedivcb_10spanscript_ref_num69nowpeterwassittingoutsideinthecourtyardandaservantgirlcametohimandsaidyoualsowerewithjesusthegalileanbuthedeniedemitembeforeallsayingidonotknowwhatyouaretalkingaboutandafterhehadgoneouttotheporchanothergirlsawhimandsaidtothosewhoweretherethismanwaswithjesusthenazarenedivcb_10andagainhedeniedwithanoathidonotknowthemanandafteralittlewhilethosewhowerestandingemthereemcametopeterandsaidsurelyyoualsoareoneofthemforyourspeechalsomakesitclearemthatemyouemareemthenhebegantocurseandtoswearidonotknowthemanandimmediatelyaroostercroweddivcb_10andpeterrememberedthewordwhichjesushassaidbeforearoostercrowsyouwilldenymethreetimesandhewentoutandweptbitterly');
        $tmp_search_meta_ARRAY[] = array('matt27_46' => 'andabouttheninthhourjesuscriedoutwithaloudvoicesayingelielilamasabachthanithatismygodmygodwhyhaveyouforsakenme');
        $tmp_search_meta_ARRAY[] = array('mark7_19-23' => 'becauseitdoesnotenterintohisheartbutintothestomachandgoesoutintothedraineminsayingthisemhemadeallfoodscleanandhesaidthatwhichgoesoutofthemanthatdefilesthemanforfromwithinoutoftheheartofmenproceedevilreasoningsfornicationstheftsmurdersadulteriescovetousnesswickednessdeceitlicentiousnessenvyblasphemyarrogancefoolishnessallthesewickedthingsproceedfromwithinanddefiletheman');
        $tmp_search_meta_ARRAY[] = array('mark9_50' => 'saltisgoodbutifthesaltbecomesunsaltywithwhatwillyourestoreitssaltinesshavesaltinyourselvesandbeatpeacewithoneanother');
        $tmp_search_meta_ARRAY[] = array('mark14_27-31,66-72' => 'spanscript_ref_num27andjesussaidtothemyouwillallbestumbledbecauseitiswritten&quotiwillsmitetheshepherdandthesheepwillbescattered&quotbutafterihavebeenraisediwillgobeforeyouintogalileedivcb_10butpetersaidtohimevenifallwillbestumbledyetiwillnotandjesussaidtohimtrulyisaytoyouthattodayinthisnightbeforearoostercrowstwiceyouwilldenymethreetimesbuthewentonspeakingmoreintenselyemevenemifimustdiewithyouiwillbynomeansdenyyouandtheyallsaidsimilarlydivcb_10spanscript_ref_num66andwhilepeterwasbelowinthecourtyardoneoftheservantgirlsofthehighpriestcameandseeingpeterwarminghimselfshelookedathimandsaidyoualsowerewiththenazarenejesusbuthedeniedemitemsayingineitherknownorunderstandwhatyouaretalkingaboutandhewentoutsideintotheforecourtandaroostercroweddivcb_10andtheservantgirlseeinghimbeganagaintosaytothosestandingbythismanisemoneemofthembutagainhedeniedemitemandafteralittlewhilethosestandingbyagainsaidtopetersurelyyouareemoneemofthemforyouareagalileanaswellbuthebegantocurseandtoswearidonotknowthismanofwhomyouspeakdivcb_10andimmediatelyaroostercrowedasecondtimeandpeterrememberedthewordhowjesushadsaidtohimbeforearoostercrowstwiceyouwilldenymethreetimesandthinkinguponithewept');
        $tmp_search_meta_ARRAY[] = array('luke1_26-33' => 'andinthesixthmonththeangelgabrielwassentfromgodtoacityofgalileenamednazarethtoavirginengagedtoamannamedjosephofthehouseofdavidandthevirginsnamewasmaryandhecametoherandsaidrejoiceyouwhohavebeengracedthelordiswithyoudivcb_10andshewasgreatlytroubledatthissayingandbeganreasoningwhatkindofgreetingthismightbeandtheangelsaidtoherdonotbeafraidmaryforyouhavefoundgracewithgodandbeholdyouwillconceiveinemyouremwombandbearasonandyoushallcallhisnamejesusdivcb_10hewillbegreatandwillbecalledsonofthemosthighandthelordgodwillgivetohimthethroneofdavidhisfatherandhewillreignoverthehouseofjacobforeverandofhiskingdomtherewillbenoend');
        $tmp_search_meta_ARRAY[] = array('luke9_1-6' => 'andhecalledtogetherthetwelveandgavethempowerandauthorityoverallthedemonsandtohealdiseasesandhesentthemtoproclaimthekingdomofgodandtohealthesickandhesaidtothemtakenothingforthejourneyneitherastaffnorabagnorbreadnormoneynorhavetwotunicsapieceandintowhateverhouseyouenterremainthereandfromtheregooutandasmanyasdonotreceiveyouasyougooutfromthatcityshakeoffthedustfromyourfeetforatestimonyagainstthemdivcb_10andtheywentoutandpassedthroughvillageaftervillageannouncingthegospelandhealingeverywhere');
        $tmp_search_meta_ARRAY[] = array('luke9_5-6' => 'andasmanyasdonotreceiveyouasyougooutfromthatcityshakeoffthedustfromyourfeetforatestimonyagainstthemandtheywentoutandpassedthroughvillageaftervillageannouncingthegospelandhealingeverywhere');
        $tmp_search_meta_ARRAY[] = array('luke10_19' => 'beholdihavegivenyoutheauthoritytotreaduponserpentsandscorpionsandoverallthepoweroftheenemyandnothingshallbyanymeanshurtyou');
        $tmp_search_meta_ARRAY[] = array('luke12_35' => 'letyourloinsbegirdedandyourlampsburning');
        $tmp_search_meta_ARRAY[] = array('luke12_34-44' => 'forwhereyourtreasureistherealsoyourheartwillbeletyourloinsbegirdedandyourlampsburningandyoubelikemenwaitingfortheirownmasterwhenhereturnsfromtheweddingfeastsothatwhenhecomesandknockstheymayopentohimimmediatelyblessedarethoseslaveswhomthemasterwhenhecomeswillfindwatchingtrulyitellyouthathewillgirdhimselfandwillhavethemreclineemattableemandhewillcometoemthememandservethemdivcb_10andifhecomesinthesecondwatchorifinthethirdandfindsemthememsoblessedarethoseemslavesembutknowthisthatifthemasterofthehousehadknowninwhathourthethiefwascominghewouldnothaveallowedhishousetobebrokenintoyoualsobereadybecauseatanhourwhenyoudonotexpectemitemthesonofmaniscomingdivcb_10andpetersaidlordareyousayinghisparabletousoralsotoallandthelordsaidwhothenisthefaithfulemandemprudentstewardwhomthemasterwillsetoverhisservicetogiveemthememtheirportionoffoodatthepropertimedivcb_10blessedisthatslavewhomhismasterwhenhecomeswillfindsodoingtrulyitellyouthathewillsethimoverallhispossessions');
        $tmp_search_meta_ARRAY[] = array('luke13_17' => 'andwhenhesaidthesethingsallthoseopposinghimwereputtoshameandallthecrowdrejoicedoverallthegloriousthingsthatwerebeingdonebyhim');
        $tmp_search_meta_ARRAY[] = array('luke14_31-32' => 'orwhatkinggoingtoengageanotherkinginwarwillnotfirstsitdownanddeliberatewhetherheisablewithtenthousandtomeettheonecomingagainsthimwithtwentythousandotherwisewhileheisyetatadistancehesendsanenvoyandasksfortheemtermsemofpeace');
        $tmp_search_meta_ARRAY[] = array('luke14_34-35' => 'thereforesaltisgoodbutifeventhesaltbecomestastelesswithwhatwillitssaltinessberestoreditisfitneitherforthelandnorforthemanurepiletheywillthrowitouthewhohasearstohearlethimhear');
        $tmp_search_meta_ARRAY[] = array('luke18_11-12' => 'thephariseestoodandprayedthesethingstohimselfgodithankyouthatiamnotliketherestofmen&ndash&ndashextortionersunjustadulterersorevenlikethistaxcollectorifasttwiceaweekigiveatenthofallthatiget');
        $tmp_search_meta_ARRAY[] = array('luke18_13' => 'butthetaxcollectorstandingatadistancewouldnotevenliftuphiseyestoheavenbutbeathisbreastsayinggodbepropitiatedtomethesinner');
        $tmp_search_meta_ARRAY[] = array('luke19_12,14,15,27' => 'spanscript_ref_num12hesaidthereforeacertainmanofnoblebirthwenttoadistantcountrytoreceiveforhimselfakingdomandtoreturndivcb_10spanscript_ref_num14buthiscitizenshatedhimandsentanenvoyafterhimsayingwedonotwantthismantoreignoverusdivcb_10spanscript_ref_num15andwhenhecamebackhavingreceivedthekingdomhecommandedthatthoseslavestowhomhehadgiventhemoneyshouldbecalledtohimsothathemightknowwhattheyhadgainedbydoingbusinessdivcb_10spanscript_ref_num27howevertheseenemiesofminewhodidnotwantmetoreignoverthembringemthememhereandslaythembeforeme');
        $tmp_search_meta_ARRAY[] = array('luke22_24-30' => 'andacontentionalsooccurredamongthemastowhichofthemseemedtobegreatestandhesaidtothemthekingsofthegentileslorditoverthemandthosewhohaveauthorityoverthemarecalledbenefactorsdivcb_10butyoushallnotbesobutletthegreatestamongyoubecomeliketheyoungestandtheonewholeadsliketheonewhoservesdivcb_10forwhoisgreatertheonewhoreclinesemattableemortheonewhoservesisitnottheonewhoreclinesemattableembutiaminyourmidstastheonewhoservesbutyouarethosewhohaveremainedwithmethroughoutmytrialsandiappointtoyouevenasmyfatherhasappointedtomeakingdomthatyoumayeatanddrinkatmytableinmykingdomandyouwillsitonthronesjudgingthetwelvetribesofisrael');
        $tmp_search_meta_ARRAY[] = array('luke22_33-34,54-62' => 'spanscript_ref_num33andhesaidtohimlordiamreadytogowithyoubothtoprisonandtodeathbuthesaiditellyoupeteraroosterwillnotcrowtodayuntilyoudenythreetimesthatyouknowmedivcb_10spanscript_ref_num54andhavingarrestedhimtheyledemhimawayemandbroughtemhimemintothehouseofthehighpriestbutpeterfollowedatadistanceandwhentheyhadlitafireinthemiddleofthecourtyardandsatdowntogetherpetersatamongthemandacertainservantgirlseeinghimseatedinthelightemofthefireemlookedintentlyathimandsaidthismanwaswithhimtoodivcb_10buthedeniedemitemsayingidonotknowhimwomanandafterashorttimeanotherpersonseeinghimsaidyoualsoareoneofthembutpetersaidmaniamnotdivcb_10andafteraboutonehourhadpassedanotheroneinsistedsayingsurelythismanwasalsowithhimforheisalsoagalileanbutpetersaidmanidonotknowwhatyouaresayingandinstantlywhilehewasstillspeakingaroostercroweddivcb_10andthelordturnedandlookedatpeterandpeterrememberedthewordofthelordhowhehadsaidtohimbeforearoostercrowstodayyouwilldenymethreetimesdivcb_10andhewentoutsideandweptbitterly');
        $tmp_search_meta_ARRAY[] = array('luke22_42' => 'sayingfatherifyouarewillingremovethiscupfrommeyetnotmywillbutyoursbedone');
        $tmp_search_meta_ARRAY[] = array('luke22_42[solo]' => 'sayingfatherifyouarewillingremovethiscupfrommeyetnotmywillbutyoursbedone');
        $tmp_search_meta_ARRAY[] = array('luke23_27-30' => 'andagreatmultitudeofthepeopleandofwomenwhoweremourningandlamentinghimfollowedhimbutjesusturnedtothemandsaiddaughtersofjerusalemdonotweepovermebutweepoveryourselvesandoveryourchildrenforbeholdthedaysarecominginwhichtheywillsayblessedarethebarrenandthewombswhichhavenotborneandthebreastswhichhavenotnourishedthentheywillbegintosaytothemountainsfallonusandtothehillscoverus');
        $tmp_search_meta_ARRAY[] = array('luke23_38,42-43' => 'spanscript_ref_num38andtherewasalsoaninscriptionoverhimthisisthekingofthejewsdivcb_10spanscript_ref_num42andhesaidjesusremembermewhenyoucomeintoyourkingdomandhesaidtohimtrulyisaytoyoutodayyoushallbewithmeinparadise');
        $tmp_search_meta_ARRAY[] = array('luke24_31-32' => 'andtheireyeswereopenedandtheyrecognizedhimandhedisappearedfromthemandtheysaidtooneanotherwasnotourheartburningwithinuswhilehewasspeakingtousontheroadwhilehewasopeningtousthescriptures');
        $tmp_search_meta_ARRAY[] = array('john2_20-21' => 'thenthejewssaidthistemplewasbuiltinfortysixyearsandyouwillraiseitupinthreedaysbuthespokeofthetempleofhisbody');
        $tmp_search_meta_ARRAY[] = array('john2_21' => 'buthespokeofthetempleofhisbody');
        $tmp_search_meta_ARRAY[] = array('john5_24-25' => 'trulytrulyisaytoyouhewhohearsmywordandbelieveshimwhosentmehaseternallifeanddoesnotcomeintojudgementbuthaspassedoutofdeathintolifetrulytrulyisaytoyouanhouriscominganditisnowwhenthedeadwillhearthevoiceofthesonofgodandthosewhohearwilllive');
        $tmp_search_meta_ARRAY[] = array('john8_1-11' => 'butjesuswenttothemountofolivesandearlyinthemorninghecameagainintothetempleandallthepeoplecametohimandhesatdownandtaughtthemdivcb_10andthescribesandphariseesbroughtawomancaughtinadulteryandhavingsetherinthemidsttheysaidtohimteacherthiswomanhasbeencaughtcommittingadulteryintheveryactnowinthelawmosescommandedustostonesuchwomenwhatthendoyousaydivcb_10buttheysaidthistotempthimsothattheymighthavetoaccusehimbutjesusstoopeddownandasup_ftnt_1script_suponclickjony5_vv_scroll_toftnt_11awrotewithhisfingeronthegroundbutwhentheypersistedinquestioninghimhestoodupandsaidtothemhewhoiswithoutsinamongyoulethimembetheemfirsttothrowastoneatherdivcb_10andagainhestoopeddownandwroteonthegroundandwhentheyheardemthatemtheywentoutonebyonebeginningwiththeolderonesandjesuswasleftaloneandthewomanemstoodemwhereshewasinthemidstdivcb_10andjesusstoodupandsaidtoherwomanwherearetheyhasnoonecondemnedyouandshesaidnoonelordandjesussaidneitherdoicondemnyougoandfromnowonsinnomore');
        $tmp_search_meta_ARRAY[] = array('john8_6' => 'buttheysaidthistotempthimsothattheymighthavetoaccusehimbutjesusstoopeddownandwrotewithhisfingerontheground');
        $tmp_search_meta_ARRAY[] = array('john8_51-59' => 'trulytrulyisaytoyouifanyonekeepsmywordheshallbynomeansseedeathforeverthejewsthereforesaidtohimnowweknowthatyouhaveademonabrahamdiedandtheprophetsemtooemyetyousayifanyonekeepsmywordheshallbynomeanstastedeathforeverareyougreaterthanourfatherabrahamwhodiedtheprophetsdiedtoowhoareyoumakingyourselfdivcb_10jesusansweredifiglorifymyselfmygloryisnothingitismyfatherwhoglorifiesmeofwhomyousaythatheisyourgodyetyouhavenotknownhimbutiknowhimandifisaythatidonotknowhimiwillbelikeyoualiarbutidoknowhimandikeephiswordyourfatherabrahamexultedthathewouldseemydayandhesawemitemandrejoiceddivcb_10thejewsthensaidtohimyouarenotyetfiftyyearsoldandhaveyouseenabrahamjesussaidtothemtrulytrulyisaytoyoubeforeabrahamcameintobeingiamsotheypickedupstonestothrowathimbutjesuswashiddenandwentoutofthetemple');
        $tmp_search_meta_ARRAY[] = array('john9_41' => 'jesussaidtothemifyouwereblindyouwouldnothavesinbutnowyousayweseeyoursinremains');
        $tmp_search_meta_ARRAY[] = array('john13_3-17' => 'emjesusemknowingthatthefatherhadgivenallintohishandsandthathehadcomeforthfromgodandwasgoingtogodrosefromsupperandlaidasidehisoutergarmentsandtakingatowelhegirdedhimselfdivcb_10thenhepouredwaterintothebasinandbegantowashthedisciplesfeetandtowipeemthememwiththetowelwithwhichhewasgirdedhecamethentosimonpeterempeteremsaidtohimlorddoyouwashmyfeetjesusansweredandsaidtohimwhatiamdoingyoudonotknownowbutyouwillknowafterthesethingsdivcb_10petersaidtohimyoushallbynomeanswashmyfeetforeverjesusansweredhimunlessiwashyouyouhavenopartwithmesimonpetersaidtohimlordnotmyfeetonlybutalsomyhandsandmyheadjesussaidtohimhewhoisbathedhasnoneedexcepttowashhisfeetbutiswhollycleanandyouarecleanbutnotallemofyouemforheknewtheonebetrayinghimforthisemreasonemhesaidnotallofyouarecleandivcb_10thenwhenhehaswashedtheirfeetandtakenhisoutergarmentsandreclinedematthetableagainemhesaidtothemdoyouknowwhatihavedonetoyouyoucallmetheteacherandthelordandyousayrightlyforiamifithenthelordandtheteacherhavewashedyourfeetyoualsooughttowashoneanothersfeetdivcb_10forihavegivenyouanexamplesothatyoualsomaydoevenasihavedonetoyoutrulytrulyisaytoyouaslaveisnotgreaterthanhismasternoronewhoissentgreaterthantheonewhosendshimdivcb_10ifyouknowthesethingsblessedareyouifyoudothem');
        $tmp_search_meta_ARRAY[] = array('john13_34' => 'anewcommandmentigivetoyouthatyouloveoneanotherevenasihavelovedyouthatyoualsoloveoneanother');
        $tmp_search_meta_ARRAY[] = array('john13_34[solo]' => 'anewcommandmentigivetoyouthatyouloveoneanotherevenasihavelovedyouthatyoualsoloveoneanother');
        $tmp_search_meta_ARRAY[] = array('john13_37-38' => 'petersaidtohimlordwhycantifollowyounowiwilllaydownmylifeforyoujesusansweredwillyoulaydownyourlifeformetrulytrulyisaytoyouaroostershallbynomeanscrowuntilyoudenymethreetimes');
        $tmp_search_meta_ARRAY[] = array('john13_37-38;18_14-27' => 'spanscript_ref_num1337petersaidtohimlordwhycantifollowyounowiwilllaydownmylifeforyoujesusansweredwillyoulaydownyourlifeformetrulytrulyisaytoyouaroostershallbynomeanscrowuntilyoudenymethreetimesdivcb_10spanscript_ref_num1814nowitwascaiaphaswhohadadvisedthejewsthatitwasexpedientforonemantodieforthepeopleandsimonpeterfollowedjesusaswellasanotherdiscipleandthatdisciplewasknowntothehighpriestandheenteredwithjesusintothecourtofthehighpriestbutpeterstoodatthedooroutsidethentheotherdiscipletheoneknowntothehighpriestwentoutandspoketoemthemaidemwhokeptthedoorandbroughtpeterindivcb_10thenthemaidwhokeptthedoorsaidtopeterareyounotalsoemoneemofthismansdiscipleshesaidiamnotnowtheslavesandtheattendantswerestandingemthereemhavingmadeafireofcoalsforitwascoldandtheywerewarmingthemselvesandpeteralsowaswiththemstandingandwarminghimselfdivcb_10thehighpriestthenquestionedjesusconcerninghisdisciplesandconcerninghisteachingjesusansweredhimihavespokenopenlytotheworldialwaystaughtinthesynagogueandinthetemplewhereallthejewscometogetherandispokenothinginsecretwhydoyouquestionmequestionthosewhohaveheardemmeconcerningemwhatispoketothembeholdtheseknowwhatisaiddivcb_10andwhenhesaidthesethingsoneoftheattendantsstandingbyslappedjesussayingisthathowyouanswerthehighpriestjesusansweredhimifihavespokenwronglytestifyconcerningthewrongbutifrightlywhydoyoustrikemeannasthensenthimboundtocaiaphasthehighpriestdivcb_10nowsimonpeterwasstandingandwarminghimselfthentheysaidtohimareyounotalsoemoneemofhisdiscipleshedeniedandsaidiamnotoneoftheslavesofthehighpriestwhowasarelativeofhimwhoseearpeterhadcutoffsaiddidinotseeyouinthegardenwithhimthenpeterdeniedagainandimmediatelyaroostercrowed');
        $tmp_search_meta_ARRAY[] = array('john14_10' => 'doyounotbelievethatiaminthefatherandthefatherisinmethewordsthatisaytoyouidonotspeakfrommyselfbutthefatherwhoabidesinmedoeshisworks');
        $tmp_search_meta_ARRAY[] = array('john14_10-14' => 'doyounotbelievethatiaminthefatherandthefatherisinmethewordsthatisaytoyouidonotspeakfrommyselfbutthefatherwhoabidesinmedoeshisworksbelievemethatiaminthefatherandthefatherisinmebutifnotbelievebecauseoftheworksthemselvesdivcb_10trulytrulyisaytoyouhewhobelievesintometheworkswhichidoheshalldoalsoandgreaterthantheseheshalldobecauseiamgoingtothefatherdivcb_10andwhateveryouaskinmynamethatiwilldothatthefathermaybeglorifiedinthesonifyouaskmeanythinginmynameiwilldoemitem');
        $tmp_search_meta_ARRAY[] = array('john14_12-14' => 'trulytrulyisaytoyouhewhobelievesintometheworkswhichidoheshalldoalsoandgreaterthantheseheshalldobecauseiamgoingtothefatherandwhateveryouaskinmynamethatiwilldothatthefathermaybeglorifiedinthesonifyouaskmeanythinginmynameiwilldoemitem');
        $tmp_search_meta_ARRAY[] = array('john14_15,20-21' => 'spanscript_ref_num15ifyoulovemeyouwillkeepmycommandmentsdivcb_10spanscript_ref_num20inthatdayyouwillknowthatiaminmyfatherandyouinmeandiinyouhewhohasmycommandmentsandkeepsthemheistheonewholovesmeandhewholovesmewillbelovedbymyfatherandiwilllovehimandwillmanifestmyselftohim');
        $tmp_search_meta_ARRAY[] = array('john16_15' => 'allthatthefatherhasismineforthisemreasonemihavesaidthathereceivesofmineandwilldeclareemitemtoyou');
        $tmp_search_meta_ARRAY[] = array('acts1_5' => 'forjohnbaptizedwithwaterbutyoushallbebaptizedintheholyspiritnotmanydaysfromnow');
        $tmp_search_meta_ARRAY[] = array('acts2_22-25' => 'menofisraelhearthesewordsjesusthenazareneamanshownbygodtoyoutobeapprovedbyworksofpowerandwondersandsignswhichgoddidthroughhiminyourmidstevenasyouyourselvesknow&ndash&ndashthismandeliveredupbythedeterminedcounselandforeknowledgeofgodyouthroughthehandoflawlessmennailedtoemacrossemandkilleddivcb_10whomgodhasraiseduphavingloosedthepangsofdeathsinceitwasnotpossibleforhimtobeheldbyitfordavidsaysregardinghim&quotisawthelordcontinuallybeforemebecauseheisonmyrighthandthatimaynotbeshaken&quot');
        $tmp_search_meta_ARRAY[] = array('acts8_29' => 'andthespiritsaidtophilipapproachandjointhischariot');
        $tmp_search_meta_ARRAY[] = array('acts10_15-16b,19-21' => 'spanscript_ref_num15andavoiceemcameemtohimagainasecondtimethethingsthatgodhascleanseddonotmakecommonandthisoccurredthreetimesdivcb_10spanscript_ref_num19andwhilepeterwasponderingoverthevisionthespiritsaidtohimbeholdemthereareemthreemenseekingyoubutriseupgodownandgowiththemdoubtingnothingbecauseihavesentthemandpeterwentdowntothemenandsaidbeholdiamhewhomyouseekwhatisthecauseforwhichyouhavecome');
        $tmp_search_meta_ARRAY[] = array('acts16_6,7' => 'spanscript_ref_num6andtheypassedthroughtheregionofphrygiaandgalatiahavingbeenforbiddenbytheholyspirittospeakthewordinasiadivcb_10spanscript_ref_num7andwhentheyhadcometomysiatheytriedtogointobithyniayetthespiritofjesusdidnotallowthem');
        $tmp_search_meta_ARRAY[] = array('acts11_12' => 'andthespirittoldmetogowiththemdoubtingnothingandthesesixbrotherswentwithmealsoandweenteredintothemanshouse');
        $tmp_search_meta_ARRAY[] = array('acts11_18' => 'andwhentheyheardthesethingstheybecamesilentandglorifiedgodsayingthentothegentilesalsogodhasgivenrepentanceuntolife');
        $tmp_search_meta_ARRAY[] = array('rom2_6-7' => 'whowillrendertoeachaccordingtohisworkstothosewhobyenduranceingoodworkseekgloryandhonorandincorruptibilitylifeeternal');
        $tmp_search_meta_ARRAY[] = array('rom5_1-5[000]' => 'thereforehavingbeenjustifiedoutoffaithwehavepeacetowardgodthroughourlordjesuschristthroughwhomalsowehaveobtainedaccessbyfaithintothisgraceinwhichwestandandboastbecauseofthehopeofthegloryofgoddivcb_10andnotonlysobutwealsoboastinourtribulationsknowingthattribulationproducesenduranceandenduranceapprovednessandapprovednesshopedivcb_10andhopedoesnotputemusemtoshamebecausetheloveofgodhasbeenpouredoutinourheartsthroughtheholyspiritwhohasbeengiventous');
        $tmp_search_meta_ARRAY[] = array('rom5_1-5' => 'thereforehavingbeenjustifiedoutoffaithwehavepeacetowardgodthroughourlordjesuschristthroughwhomalsowehaveobtainedaccessbyfaithintothisgraceinwhichwestandandboastbecauseofthehopeofthegloryofgoddivcb_10andnotonlysobutwealsoboastinourtribulationsknowingthattribulationproducesenduranceandenduranceapprovednessandapprovednesshopedivcb_10andhopedoesnotputemusemtoshamebecausetheloveofgodhasbeenpouredoutinourheartsthroughtheholyspiritwhohasbeengiventous');
        $tmp_search_meta_ARRAY[] = array('rom5_10' => 'forifwebeingenemieswerereconciledtogodthroughthedeathofhissonmuchmorewewillbesavedinhislifehavingbeenreconciled');
        $tmp_search_meta_ARRAY[] = array('rom5_14,17,21' => 'spanscript_ref_num14butdeathreignedfromadamuntilmosesevenoverthosewhohadnotsinnedafterthelikenessofadamstransgressionwhoisatypeofhimwhowastocomedivcb_10spanscript_ref_num17forifbytheoffenseoftheonedeathreignedthroughtheonemuchmorethosewhoreceivetheabundanceofgraceandofthegiftofrighteousnesswillreigninlifethroughtheonejesuschristdivcb_10spanscript_ref_num21inorderthatjustassinreignedindeathsoalsogracemightreignthroughrighteousnessuntoeternallifethroughjesuschristourlord');
        $tmp_search_meta_ARRAY[] = array('rom6_3' => 'orareyouignorantthatallofuswhohavebeenbaptizedintochristjesushavebeenbaptizedintohisdeath');
        $tmp_search_meta_ARRAY[] = array('rom6_8' => 'nowifwehavediedwithchristwebelievethatwewillalsolivewithhim');
        $tmp_search_meta_ARRAY[] = array('rom6_8-11' => 'nowifwehavediedwithchristwebelievethatwewillalsolivewithhimknowingthatchristhavingbeenraisedfromthedeaddiesnomoredeathlordsitoverhimnomoreforemthedeathemwhichhediedhediedtosinonceforallbutemthelifeemwhichheliveshelivestogodsoalsoyoureckonyourselvestobedeadtosinbutlivingtogodinchristjesus');
        $tmp_search_meta_ARRAY[] = array('rom6_9-11' => 'knowingthatchristhavingbeenraisedfromthedeaddiesnomoredeathlordsitoverhimnomoreforemthedeathemwhichhediedhediedtosinonceforallbutemthelifeemwhichheliveshelivestogodsoalsoyoureckonyourselvestobedeadtosinbutlivingtogodinchristjesus');
        $tmp_search_meta_ARRAY[] = array('rom6_18-19[000]' => 'andhavingbeenfreedfromsinyouwereenslavedtorighteousnessispeakinhumanemtermsembecauseoftheweaknessofyourfleshforjustasyoupresentedyourmembersasslavestouncleannessandlawlessnessuntolawlessnesssonowpresentyourmembersasslavestorighteousnessuntosanctification');
        $tmp_search_meta_ARRAY[] = array('rom6_18-19' => 'andhavingbeenfreedfromsinyouwereenslavedtorighteousnessispeakinhumanemtermsembecauseoftheweaknessofyourfleshforjustasyoupresentedyourmembersasslavestouncleannessandlawlessnessuntolawlessnesssonowpresentyourmembersasslavestorighteousnessuntosanctification');
        $tmp_search_meta_ARRAY[] = array('rom6_22' => 'butnowhavingbeenfreedfromsinandenslavedtogodyouhaveyourfruituntosanctificationandtheendeternallife');
        $tmp_search_meta_ARRAY[] = array('rom7_2-4,6' => 'spanscript_ref_num2forthemarriedwomanisboundbythelawtoherhusbandwhileheislivingbutifthehusbanddiessheisdischargedfromthelawregardingthehusbandsothenifwhilethehusbandislivingsheisjoinedtoanothermanshewillbecalledanadulteressbutifthehusbanddiessheisfreefromthelawsothatsheisnotanadulteressthoughsheisjoinedtoanothermansothenmybrothersyoualsohavebeenmadedeadtothelawthroughthebodyofchristsothatyoumightbejoinedtoanothertohimwhohasbeenraisedfromthedeadthatwemightbearfruittogoddivcb_10spanscript_ref_num6butnowwehavebeendischargedfromthelawhavingdiedtothatinwhichwewereheldsothatweserveinnewnessofspiritandnotinoldnessofletter');
        $tmp_search_meta_ARRAY[] = array('rom8_2' => 'forthelawofthespiritoflifehasfreedmeinchristjesusfromthelawofsinandofdeath');
        $tmp_search_meta_ARRAY[] = array('rom8_2,4' => 'spanscript_ref_num2forthelawofthespiritoflifehasfreedmeinchristjesusfromthelawofsinandofdeathdivcb_10spanscript_ref_num4thattherighteousrequirementofthelawmightbefulfilledinuswhodonotwalkaccordingtothefleshbutaccordingtothespirit');
        $tmp_search_meta_ARRAY[] = array('rom8_14' => 'forasmanyasareledbythespiritofgodthesearesonsofgod');
        $tmp_search_meta_ARRAY[] = array('rom8_16-17,24-25' => 'spanscript_ref_num16thespirithimselfwitnesseswithourspiritthatwearechildrenofgodandifchildrenheirsalsoontheonehandheirsofgodontheotherjointheirswithchristifindeedwesufferwithemhimemthatwemayalsobeglorifiedwithemhimemdivcb_10spanscript_ref_num24forweweresavedinhopebutahopethatisseenisnothopeforwhohopesforwhatheseesbutifwehopeforwhatwedonotseeweeagerlyawaitemitemthroughendurance');
        $tmp_search_meta_ARRAY[] = array('rom8_14-23' => 'forasmanyasareledbythespiritofgodthesearesonsofgodforyouhavenotreceivedaspiritofslaveryembringingyouemintofearagainbutyouhavereceivedaspiritofsonshipinwhichwecryabbafatherthespirithimselfwitnesseswithourspiritthatwearechildrenofgodandifchildrenheirsalsoontheonehandheirsofgodontheotherjointheirswithchristifindeedwesufferwithemhimemthatwemayalsobeglorifiedwithemhimemdivcb_10foriconsiderthatthesufferingsofthispresenttimearenotworthytobecomparedwiththecomingglorytoberevealeduponusdivcb_10fortheanxiouswatchingofthecreationeagerlyawaitstherevelationofthesonsofgodforthecreationwasmadesubjecttovanitynotofitsownwillbutbecauseofhimwhosubjectedemiteminhopethatthecreationitselfwillalsobefreedfromtheslaveryofcorruptionintothefreedomofthegloryofthechildrenofgodforweknowthatthewholecreationgroanstogetherandtravailsinpaintogetheruntilnowdivcb_10andnotonlyemsoembutweourselvesalsowhohavethefirstfruisofthespiritevenweourselvesgroaninourselveseagerlyawaitingsonshiptheredemptionofourbody');
        $tmp_search_meta_ARRAY[] = array('rom8_33-39' => 'whoshallbringachargeagainstgodschosenonesitisgodwhojustifieswhoishewhocondemnsitischristjesuswhodiedandratherwhowasraisedwhoisalsoattherighthandofgodwhoalsointercedesforuswhoshallseparateusfromtheloveofchristshalltribulationoranguishorpersecutionorfamineornakednessorperilorswordasitiswritten&quotforyoursakewearebeingputtodeathalldaylongwehavebeenaccountedassheepforslaughter&quotbutinallthesethingswemorethanconquerthroughhimwholovedusdivcb_10foriampersuadedthatneitherdeathnorlifenorangelsnorprincipalitiesnorthingspresentnorthingstocomenorpowersnorheightnordepthnoranyothercreaturewillbeabletoseparateusfromtheloveofgodwhichisinchristjesusourlord');
        $tmp_search_meta_ARRAY[] = array('rom9_31-33' => 'butisraelpursuingalawofrighteousnessdidnotattaintoemthatemlawwhybecauseemtheypursueditemnotoutoffaithbutasitwereoutofworkstheystumbledatthestoneofstumblingasitiswritten&quotbeholdilayinzionastoneofstumblingarockofoffenseandhewhobelievesonhimshallnotbeputtoshame&quot');
        $tmp_search_meta_ARRAY[] = array('rom10_2-3' => 'foribearthemwitnessthattheyhaveazealforgodbutnotaccordingtofullknowledgeforbecausetheywereignorantofgodsrighteousnessandsoughttoestablishtheirownrighteousnesstheywerenotsubjecttotherighteousnessofgod');
        $tmp_search_meta_ARRAY[] = array('rom12_2' => 'anddonotbefashionedaccordingtothisagebutbetransformedbytherenewingofthemindthatyoumayprovewhatthewillofgodisthatwhichisgoodandwellpleasingandperfect');
        $tmp_search_meta_ARRAY[] = array('rom12_11' => 'donotbeslothfulinzealembutembeburninginspiritservingthelord');
        $tmp_search_meta_ARRAY[] = array('rom12_11-12' => 'donotbeslothfulinzealembutembeburninginspiritservingthelordrejoiceinhopeendureintribulationpersevereinprayer');
        $tmp_search_meta_ARRAY[] = array('rom13_14' => 'butputonthelordjesuschristandmakenoprovisionforthefleshtoemfulfillemitslusts');
        $tmp_search_meta_ARRAY[] = array('rom14_1' => 'nowhimwhoisweakinfaithreceiveembutemnotforthepurposeofpassingjudgementonemhisemconsiderations');
        $tmp_search_meta_ARRAY[] = array('rom14_7-12' => 'fornoneofuslivestohimselfandnonediestohimselfforwhetherwelivewelivetothelordandwhetherwediewedietothelordthereforewhetherweliveorwediewearethelordsforchristdiedandlivedemagainemforthisthathemightbelordbothofthedeadandofthelivingdivcb_10butyouwhydoyoujudgeyourbrotheroryouwhydoyoudespiseyourbrotherforwewillallstandbeforethejudgementseatofgodforitiswritten&quotasilivesaysthelordeverykneeshallbowtomeandeverytongueshallopenlyconfesstogod&quotdivcb_10sotheneachoneofuswillgiveanaccountconcerninghimselftogod');
        $tmp_search_meta_ARRAY[] = array('rom15_4[000]' => 'forthethingsthatwerewrittenpreviouslywerewrittenforourinstructioninorderthatthroughenduranceandthroughtheencouragementofthescriptureswemighthavehope');
        $tmp_search_meta_ARRAY[] = array('rom15_4' => 'forthethingsthatwerewrittenpreviouslywerewrittenforourinstructioninorderthatthroughenduranceandthroughtheencouragementofthescriptureswemighthavehope');
        $tmp_search_meta_ARRAY[] = array('1cor1_22-25' => 'forindeedjewsrequiresignsandgreeksseekwisdombutwepreachchristcrucifiedtojewsastumblingblockandtogentilesfoolishnessbuttothosewhoarecalledbothjewsandgreekschristthepowerofgodandthewisdomofgodbecausethefoolishnessofgodiswiserthanmenandtheweaknessofgodisstrongerthanmen');
        $tmp_search_meta_ARRAY[] = array('1cor3_21-23' => 'sothenletnooneboastinmenforallthingsareyourswhetherpaulorapollosorcephasortheworldorlifeordeathorthingspresentorthingstocomeallareyoursbutyouarechristsandchristisgods');
        $tmp_search_meta_ARRAY[] = array('1cor5_1,5' => 'spanscript_ref_num1itisactuallyreportedthatthereisfornicationamongyouandsuchfornicationthatemdoesemnotevenemoccuremamongthegentilesthatsomeonehashisstepmotherdivcb_10spanscript_ref_num5todeliversuchaonetosatanforthedestructionofhisfleshthathisspiritmaybesavedinthedayofthelord');
        $tmp_search_meta_ARRAY[] = array('1cor6_12' => 'allthingsarelawfultomebutnotallthingsareprofitableallthingsarelawfultomebutiwillnotbebroughtunderthepowerofanything');
        $tmp_search_meta_ARRAY[] = array('1cor6_17' => 'buthewhoisjoinedtothelordisonespirit');
        $tmp_search_meta_ARRAY[] = array('1cor9_8-11,13' => 'spanscript_ref_num8amispeakingthesethingsaccordingtomanordoesthelawnotalsosaythesethingsforinthelawofmosesitiswritten&quotyoushallnotmuzzletheoxwhileitistreadingoutthegrain&quotisitforoxenthatgodcaresordoeshesayemitemaltogetherforoursakedivcb_10yesforoursakeitwaswrittenbecausetheplowmanshouldplowinhopeandhewhothreshesinhopeofpartakingifwehavesowntoyouthespiritualthingsisitagreatthingifweshallreapfromyouthefleshlythingsdivcb_10spanscript_ref_num13doyounotknowthatthosewholaboronthesacredthingseatthethingsofthesacredtempleemthatemthosewhoattendtothealterhavetheirportionwiththealter');
        $tmp_search_meta_ARRAY[] = array('1cor10_5' => 'butwithmostofthemgodwasnotwellpleasedfortheywerestrewnalonginthewilderness');
        $tmp_search_meta_ARRAY[] = array('1cor10_23' => 'allthingsarelawfulbutnotallthingsareprofitableallthingsarelawfulbutnotallthingsbuildup');
        $tmp_search_meta_ARRAY[] = array('1cor10_26,29b-31' => 'spanscript_ref_num26fortheearthisthelordsandthefullnessthereofdivcb_10spanscript_ref_num29bforwhyismyfreedomjudgedbyemsomeemotherconscienceifipartakewiththankfulnesswhyamispokenevilofconcerningthatforwhichigivethanksthereforewhetheryoueatordrinkorwhateveryoudodoalltothegloryofgod');
        $tmp_search_meta_ARRAY[] = array('1cor11_4' => 'everymanprayingorprophesyingwithhisheadcoveredspanscript_sup2disgraceshishead');
        $tmp_search_meta_ARRAY[] = array('1cor15_58' => 'thereforemybelovedbrothersbesteadfastimmovablealwaysaboundingintheworkoflordknowingthatyourlaborisnotinvaininthelord');
        $tmp_search_meta_ARRAY[] = array('1cor15_55,58' => 'spanscript_ref_num55whereodeathisyourvictorywhereodeathisyourstingdivcb_10spanscript_ref_num58thereforemybelovedbrothersbesteadfastimmovablealwaysaboundingintheworkofthelordknowingthatyourlaborisnotinvaininthelord');
        $tmp_search_meta_ARRAY[] = array('2cor1_9-10' => 'indeedweourselveshadtheresponseofdeathinourselvesthatweshouldnotbaseourconfidenceonourselvesbutongodwhoraisesthedeadwhohasdeliveredusoutofsogreatadeathandwilldeliveremuseminwhomwehavehopedthathewillalsoyetdeliveremusem');
        $tmp_search_meta_ARRAY[] = array('2cor1_20-22[000]' => 'forasmanypromisesofgodasemthereareeminhimistheyesthereforealsothroughhimistheamentogodforglorythroughusemtogodembuttheonewhofirmlyattachesuswithyouuntochristandhasanointedusisgodhewhohasalsosealedusandgiventhespiritinourheartsasapledge');
        $tmp_search_meta_ARRAY[] = array('2cor1_20-22' => 'forasmanypromisesofgodasemthereareeminhimistheyesthereforealsothroughhimistheamentogodforglorythroughusemtogodembuttheonewhofirmlyattachesuswithyouuntochristandhasanointedusisgodhewhohasalsosealedusandgiventhespiritinourheartsasapledge');
        $tmp_search_meta_ARRAY[] = array('2cor3_6-9' => 'whohasalsomadeussufficientasministersofanewcovenantemministersemnotoftheletterbutofthespiritfortheletterkillsbutthespiritgiveslifemoreoveriftheministryofdeathengravedinstoneinletterscameaboutinglorysothatthesonsofisraelwerenotabletogazeatthefaceofmosesbecauseofthegloryofhisfaceemagloryemwhichwasbeingdoneawaywithhowshalltheministryofthespiritnotbemoreingloryforifthereisglorywiththeministryofcondemnationmuchmoretheministryofrighteousnessaboundswithglory');
        $tmp_search_meta_ARRAY[] = array('2cor3_12' => 'thereforesincewehavesuchhopeweusemuchboldness');
        $tmp_search_meta_ARRAY[] = array('2cor3_12,17' => 'spanscript_ref_num12thereforesincewehavesuchhopeweusemuchboldnessdivcb_10spanscript_ref_num17andthelordisthespiritandwherethespiritofthelordisthereisfreedom');
        $tmp_search_meta_ARRAY[] = array('2cor11_2a' => 'foriamjealousoveryouwithajealousyofgod');
        $tmp_search_meta_ARRAY[] = array('2cor11_2b-3' => 'foribetrothedyoutoonehusbandtopresentemyouasemapurevirgintochristbutifearlestsomehowastheserpentdeceivedevebyhiscraftinessyourthoughtswouldbecorruptedfromthesimplicityandthepuritytowardchrist');
        $tmp_search_meta_ARRAY[] = array('1cor11_22' => 'doyounothavehousestoeatanddrinkinordoyoudespisethechurchofgodandputthosetoshamewhohavenotwhatshallisaytoyoushallipraiseyouinthisidonotpraiseemyouem');
        $tmp_search_meta_ARRAY[] = array('2cor3_3' => 'sinceyouarebeingmanifestedthatyouarealetterofchristministeredbyusinscribednotwithinkbutwiththespiritofthelivinggodnotintabletsofstonebutintabletsofheartsofflesh');
        $tmp_search_meta_ARRAY[] = array('2cor3_17-18' => 'andthelordisthespiritandwherethespiritofthelordisthereisfreedombutweallwithunveiledfacebeholdingandreflectinglikeamirrorthegloryofthelordarebeingtransformedintothesameimagefromglorytogloryevenasfromthelordspirit');
        $tmp_search_meta_ARRAY[] = array('2cor3_18' => 'butweallwithunveiledfacebeholdingandreflectinglikeamirrorthegloryofthelordarebeingtransformedintothesameimagefromglorytogloryevenasfromthelordspirit');
        $tmp_search_meta_ARRAY[] = array('gal1_14' => 'andiadvancedinjudaismbeyondmanycontemporariesinmyracebeingmoreabundantlyazealotforthetraditionsofmyfathers');
        $tmp_search_meta_ARRAY[] = array('gal2_20' => 'iamcrucifiedwithchristandnolongeriemwhoemlivebutemitisemchristemwhoemlivesinmeandtheemlifeemwhichinowliveinthefleshiliveinfaiththeemfaithemofthesonofgodwholovedmeandgavehimselfupforme');
        $tmp_search_meta_ARRAY[] = array('gal2_20_x' => 'iamcrucifiedwithchristandnolongeriemwhoemlivebutemitisemchristemwhoemlivesinmeandtheemlifeemwhichinowliveinthefleshiliveinfaiththeemfaithemofthesonofgodwholovedmeandgavehimselfupforme');
        $tmp_search_meta_ARRAY[] = array('gal3_1' => 'ofoolishgalatianswhohasbewitchedyoubeforewhoseeyesjesuschristwasopenlyportrayedcrucified');
        $tmp_search_meta_ARRAY[] = array('gal5_1,7' => 'spanscript_ref_num1emitisemforfreedomemthatemchristhassetusfreestandfastthereforeanddonotbeentangledwithayokeofslaveryagaindivcb_10spanscript_ref_num7youwererunningwellwhohinderedyouthatyouwouldnotbelieveandobeythetruth');
        $tmp_search_meta_ARRAY[] = array('gal5_1' => 'emitisemforfreedomemthatemchristhassetusfreestandfastthereforeanddonotbeentangledwithayokeofslaveryagain');
        $tmp_search_meta_ARRAY[] = array('gal5_5-6' => 'forwebythespiritoutoffaitheagerlyawaitthehopeofrighteousnessforinchristjesusneithercircumcisionavailsanythingnoruncircumcisionbutfaithemavailsemoperatingthroughlove');
        $tmp_search_meta_ARRAY[] = array('gal4_11' => 'ifearforyoulestihavelaboreduponyouinvain');
        $tmp_search_meta_ARRAY[] = array('gal5_13,16' => 'spanscript_ref_num13foryouwerecalledforfreedombrothersonlydonotemturnemthisfreedomintoanopportunityforthefleshbutthroughloveserveoneanotherdivcb_10spanscript_ref_num16butisaywalkbythespiritandyoushallbynomeansfulfillthelustoftheflesh');
        $tmp_search_meta_ARRAY[] = array('gal5_16,18,22-23,25' => 'spanscript_ref_num16butisaywalkbythespiritandyoushallbynomeansfulfillthelustofthefleshdivcb_10spanscript_ref_num18butifyouareledbythespirityouarenotunderthelawdivcb_10spanscript_ref_num22butthefruitofthespiritislovejoypeacelongsufferingkindnessgoodnessfaithfulnessmeeknessselfcontrolagainstsuchthingsthereisnolawdivcb_10spanscript_ref_num25ifwelivebythespiritletusalsowalkbythespirit');
        $tmp_search_meta_ARRAY[] = array('gal6_14' => 'butfarbeitfrommetoboastexceptinthecrossofourlordjesuschristthroughwhomtheworldhasbeencrucifiedtomeanditotheworld');
        $tmp_search_meta_ARRAY[] = array('eph1_3' => 'blessedbethegodandfatherofourlordjesuschristwhohasblesseduswitheveryspiritualblessingintheheavenliesinchrist');
        $tmp_search_meta_ARRAY[] = array('eph1_3-12' => 'blessedbethegodandfatherofourlordjesuschristwhohasblesseduswitheveryspiritualblessingintheheavenliesinchristevenashechoseusinhimbeforethefoundationoftheworldtobeholyandwithoutblemishbeforehiminlovepredestinatingusuntosonshipthroughjesuschristtohimselfaccordingtothegoodpleasureofhiswilldivcb_10tothepraiseofthegloryofhisgracewithwhichhegracedusinthebelovedinwhomwehaveredemptionthroughhisbloodtheforgivenessofoffensesaccordingtotherichesofhisgracewhichhecausedtoaboundtousinallwisdomandprudencedivcb_10makingknowntousthemysteryofhiswillaccordingtohisgoodpleasurewhichhepurposedinhimselfuntotheeconomyofthefullnessofthetimestoheadupallthingsinchristthethingsintheheavensandthethingsontheearthinhiminwhomalsoweweredesignatedasaninheritancehavingbeenpredestinatedaccordingtothepurposeoftheonewhoworksallthingsaccordingtothecounselofhiswillthatwewouldbetothepraiseofhisglorywhohavefirsthopedinchrist');
        $tmp_search_meta_ARRAY[] = array('eph1_3-14[000]' => 'blessedbethegodandfatherofourlordjesuschristwhohasblesseduswitheveryspiritualblessingintheheavenliesinchristevenashechoseusinhimbeforethefoundationoftheworldtobeholyandwithoutblemishbeforehiminlovepredestinatingusuntosonshipthroughjesuschristtohimselfaccordingtothegoodpleasureofhiswilldivcb_10tothepraiseofthegloryofhisgracewithwhichhegracedusinthebelovedinwhomwehaveredemptionthroughhisbloodtheforgivenessofoffensesaccordingtotherichesofhisgracewhichhecausedtoaboundtousinallwisdomandprudencedivcb_10makingknowntousthemysteryofhiswillaccordingtohisgoodpleasurewhichhepurposedinhimselfuntotheeconomyofthefullnessofthetimestoheadupallthingsinchristthethingsintheheavensandthethingsontheearthinhiminwhomalsoweweredesignatedasaninheritancehavingbeenpredestinatedaccordingtothepurposeoftheonewhoworksallthingsaccordingtothecounselofhiswillthatwewouldbetothepraiseofhisglorywhohavefirsthopedinchristdivcb_10inwhomyoualsohavingheardthewordofthetruththegospelofyoursalvationinhimalsobelievingyouweresealedwiththeholyspiritofthepromisewhoisthepledgeofourinheritanceuntotheredemptionoftheacquiredpossessiontothepraiseofhisglory');
        $tmp_search_meta_ARRAY[] = array('eph1_3-14' => 'blessedbethegodandfatherofourlordjesuschristwhohasblesseduswitheveryspiritualblessingintheheavenliesinchristevenashechoseusinhimbeforethefoundationoftheworldtobeholyandwithoutblemishbeforehiminlovepredestinatingusuntosonshipthroughjesuschristtohimselfaccordingtothegoodpleasureofhiswilldivcb_10tothepraiseofthegloryofhisgracewithwhichhegracedusinthebelovedinwhomwehaveredemptionthroughhisbloodtheforgivenessofoffensesaccordingtotherichesofhisgracewhichhecausedtoaboundtousinallwisdomandprudencedivcb_10makingknowntousthemysteryofhiswillaccordingtohisgoodpleasurewhichhepurposedinhimselfuntotheeconomyofthefullnessofthetimestoheadupallthingsinchristthethingsintheheavensandthethingsontheearthinhiminwhomalsoweweredesignatedasaninheritancehavingbeenpredestinatedaccordingtothepurposeoftheonewhoworksallthingsaccordingtothecounselofhiswillthatwewouldbetothepraiseofhisglorywhohavefirsthopedinchristdivcb_10inwhomyoualsohavingheardthewordofthetruththegospelofyoursalvationinhimalsobelievingyouweresealedwiththeholyspiritofthepromisewhoisthepledgeofourinheritanceuntotheredemptionoftheacquiredpossessiontothepraiseofhisglory');
        $tmp_search_meta_ARRAY[] = array('eph1_9' => 'makingknowntousthemysteryofhiswillaccordingtohisgoodpleasurewhichhepurposedinhimself');
        $tmp_search_meta_ARRAY[] = array('eph1_9-14,18-23' => 'spanscript_ref_num9makingknowntousthemysteryofhiswillaccordingtohisgoodpleasurewhichhepurposedinhimselfuntotheeconomyofthefullnessofthetimestoheadupallthingsinchristthethingsintheheavensandthethingsontheearthinhimdivcb_10inwhomalsoweweredesignatedasaninheritancehavingbeenpredestinatedaccordingtothepurposeoftheonewhoworksallthingsaccordingtothecounselofhiswillthatwewouldbetothepraiseofhisglorywhohavefirsthopedinchristdivcb_10inwhomyoualsohavingheardthewordofthetruththegospelofyoursalvationinhimalsobelievingyouweresealedwiththeholyspiritofthepromisewhoisthepledgeofourinheritanceuntotheredemptionoftheacquiredpossessiontothepraiseofhisglorydivcb_10spanscript_ref_num18theeyesofyourhearthavingbeenenlightenedthatyoumayknowwhatisthehopeofhiscallingandwhataretherichesofthegloryofhisinheritanceinthesaintsandwhatisthesurpassinggreatnessofhispowertowarduswhobelieveaccordingtotheoperationofthemightofhisstrengthwhichhecausedtooperateinchristinraisinghimfromthedeadandseatinghimathisrighthandintheheavenliesfaraboveallruleandauthorityandpowerandlordshipandeverynamethatisnamednotonlyinthisagebutalsointhatwhichistocomedivcb_10andhesubjectedallthingsunderhisfeetandgavehimemtobeemheadoverallthingstothechurchwhichishisbodythefullnessoftheonewhofillsallinall');
        $tmp_search_meta_ARRAY[] = array('phil1_6' => 'beingconfidentofthisverythingthathewhohasbeguninyouagoodworkwillcompleteituntilthedayofchristjesus');
        $tmp_search_meta_ARRAY[] = array('phil1_20' => 'accordingtomyearnestexpectationandhopethatinnothingiwillbeputtoshamebutwithallboldnessasalwaysevennowchristwillbemagnifiedinmybodywhetherthroughlifeorthroughdeath');
        $tmp_search_meta_ARRAY[] = array('phil1_27' => 'onlyconductyourselvesinamannerworthyofthegospelofchristthatwhethercomingandseeingyouorbeingabsentimayhearofthethingsconcerningyouthatyoustandfirminonespiritwithonesoulstrivingtogetheremalongemwiththefaithofthegospel');
        $tmp_search_meta_ARRAY[] = array('phil2_3' => 'emdoingemnothingbywayofselfishambitionnorbywayofvainglorybutinlowlinessofmindconsideringoneanothermoreexcellentthanyourselves');
        $tmp_search_meta_ARRAY[] = array('phil2_5-8' => 'letthismindbeinyouwhichwasalsoinchristjesuswhoexistingintheformofgoddidnotconsiderbeingequalwithgodatreasuretobegraspedbutemptiedhimselftakingtheformofaslavebecominginthelikenessofmendivcb_10andbeingfoundinfashionasamanhehumbledhimselfbecomingobedientevenuntodeathandemthatemthedeathofacross');
        $tmp_search_meta_ARRAY[] = array('phil2_5-16[000]' => 'letthismindbeinyouwhichwasalsoinchristjesuswhoexistingintheformofgoddidnotconsiderbeingequalwithgodatreasuretobegraspedbutemptiedhimselftakingtheformofaslavebecominginthelikenessofmenandbeingfoundinfashionasamanhehumbledhimselfbecomingobedientevenuntodeathandemthatemthedeathofacrossdivcb_10thereforealsogodhighlyexaltedhimandbestowedonhimthenamewhichisaboveeverynamethatinthenameofjesuseverykneeshouldbowofthosewhoareinheavenandonearthandundertheearthandeverytongueshouldopenlyconfessthatjesuschristislordtothegloryofgodthefatherdivcb_10sothenmybelovedevenasyouhavealwaysobeyednotasinmypresenceonlybutnowmuchratherinmyabsenceworkoutyourownsalvationwithfearandtremblingforitisgodwhooperatesinyouboththewillingandtheworkingforemyouremgoodpleasuredoallthingswithoutmurmuringsandreasoningsthatyoumaybeblamelessandguilelesschildrenofgodwithoutblemishinthemidstofacrookedandpervertedgenerationamongwhomyoushineasluminariesintheworldholdingforththewordoflifesothatimayhaveaboastinthedayofchristthatididnotruninvainnorlaborinvain');
        $tmp_search_meta_ARRAY[] = array('phil2_5-16' => 'letthismindbeinyouwhichwasalsoinchristjesuswhoexistingintheformofgoddidnotconsiderbeingequalwithgodatreasuretobegraspedbutemptiedhimselftakingtheformofaslavebecominginthelikenessofmenandbeingfoundinfashionasamanhehumbledhimselfbecomingobedientevenuntodeathandemthatemthedeathofacrossdivcb_10thereforealsogodhighlyexaltedhimandbestowedonhimthenamewhichisaboveeverynamethatinthenameofjesuseverykneeshouldbowofthosewhoareinheavenandonearthandundertheearthandeverytongueshouldopenlyconfessthatjesuschristislordtothegloryofgodthefatherdivcb_10sothenmybelovedevenasyouhavealwaysobeyednotasinmypresenceonlybutnowmuchratherinmyabsenceworkoutyourownsalvationwithfearandtremblingforitisgodwhooperatesinyouboththewillingandtheworkingforemyouremgoodpleasuredoallthingswithoutmurmuringsandreasoningsthatyoumaybeblamelessandguilelesschildrenofgodwithoutblemishinthemidstofacrookedandpervertedgenerationamongwhomyoushineasluminariesintheworldholdingforththewordoflifesothatimayhaveaboastinthedayofchristthatididnotruninvainnorlaborinvain');
        $tmp_search_meta_ARRAY[] = array('phil2_5-9' => 'letthismindbeinyouwhichwasalsoinchristjesuswhoexistingintheformofgoddidnotconsiderbeingequalwithgodatreasuretobegraspedbutemptiedhimselftakingtheformofaslavebecominginthelikenessofmenandbeingfoundinfashionasamanhehumbledhimselfbecomingobedientevenuntodeathandemthatemthedeathofacrossdivcb_10thereforealsogodhighlyexaltedhimandbestowedonhimthenamewhichisaboveeveryname');
        $tmp_search_meta_ARRAY[] = array('phil2_8' => 'andbeingfoundinfashionasamanhehumbledhimselfbecomingobedientevenuntodeathandemthatemthedeathofacross');
        $tmp_search_meta_ARRAY[] = array('phil2_13[001]' => 'foritisgodwhooperatesinyouboththewillingandtheworkingforemyouremgoodpleasure');
        $tmp_search_meta_ARRAY[] = array('phil2_13[000]' => 'foritisgodwhooperatesinyouboththewillingandtheworkingforemyouremgoodpleasure');
        $tmp_search_meta_ARRAY[] = array('phil2_13' => 'foritisgodwhooperatesinyouboththewillingandtheworkingforemyouremgoodpleasure');
        $tmp_search_meta_ARRAY[] = array('col1_5' => 'becauseofthehopelaidupforyouintheheavensofwhichyouheardbeforeinthewordofthetruthofthegospel');
        $tmp_search_meta_ARRAY[] = array('col1_27' => 'towhomgodwilledtomakeknownwhataretherichesofthegloryofthismysteryamongthegentileswhichischristinyouthehopeofglory');
        $tmp_search_meta_ARRAY[] = array('col1_5-6,21-23,26-27' => 'spanscript_ref_num5becauseofthehopelaidupforyouintheheavensofwhichyouheardbeforeinthewordofthetruthofthegospelwhichhascometoyouevenasitisalsoinalltheworldbearingfruitandgrowingasalsoinyousincethedayyouheardandknewthegraceofgodintruthdivcb_10spanscript_ref_num21andyouthoughoncealienatedandenemiesinyourmindbecauseofyourevilworkshenowhasreconciledinthebodyofhisfleshthroughdeathtopresentyouholyandwithoutblemishandwithoutreproachbeforehimifindeedyoucontinueinthefaithgroundedandsteadfastandnotbeingmovedawayfromthehopeofthegospelwhichyouheardwhichwasproclaimedinallcreationunderheavenofwhichipaulbecameaministerdivcb_10spanscript_ref_num26themysterywhichhasbeenhiddenfromtheagesandfromthegenerationsbutnowhasbeenmanifestedtohissaintstowhomgodwilledtomakeknownwhataretherichesofthegloryofthismysteryamongthegentileswhichischristinyouthehopeofglory');
        $tmp_search_meta_ARRAY[] = array('col1_16' => 'becauseinhimallthingswerecreatedintheheavensandontheearththevisibleandtheinvisiblewhetherthronesorlordshipsorrulersorauthoritiesallthingshavebeencreatedthroughhimanduntohim');
        $tmp_search_meta_ARRAY[] = array('col2_9' => 'forinhimdwellsallthefullnessofthegodheadbodily');
        $tmp_search_meta_ARRAY[] = array('col2_8,12,20-23' => 'spanscript_ref_num8bewarethatnoonecarriesyouoffasspoilthroughhisphilosophyandemptydeceitaccordingtothetraditionofmenaccordingtotheelementsoftheworldandnotaccordingtochristdivcb_10spanscript_ref_num12buriedtogetherwithhiminbaptisminwhichalsoyouwereraisedtogetherwithemhimemthroughthefaithoftheoperationofgodwhoraisedhimfromthedeaddivcb_10spanscript_ref_num20ifyoudiedwithchristfromtheelementsoftheworldwhyaslivingintheworlddoyousubjectyourselvestoordinancesdonothandlenortastenortouchemregardingemthingswhicharealltoperishwhenusedaccordingtothecommandmentsandteachingsofmensuchthingsindeedhaveareputationofwisdominselfimposedworshipandlowlinessandseveretreatmentofthebodyembutemarenotofanyvalueagainsttheindulgenceoftheflesh');
        $tmp_search_meta_ARRAY[] = array('col3_5' => 'puttodeaththereforeyourmemberswhichareontheearthfornicationuncleannesspassionevildesireandgreedinesswhichisidolatry');
        $tmp_search_meta_ARRAY[] = array('col3_6' => 'becauseofwhichthingsthewrathofgodiscominguponthesonsofdisobedience');
        $tmp_search_meta_ARRAY[] = array('1thes1_2-3' => 'wethankgodalwaysconcerningallofyoumakingmentionemofyoueminourprayersrememberingunceasinglyyourworkoffaithandlaborofloveandenduranceofhopeinourlordjesuschristbeforeourgodandfather');
        $tmp_search_meta_ARRAY[] = array('1thes5_7-11' => 'forthosewhosleepsleepduringthenightandthosewhogetdrunkaredrunkduringthenightbutsinceweareofthedayletusbesoberputtingonthebreastplateoffaithandloveandahelmetthehopeofsalvationdivcb_10forgoddidnotappointustowrathbuttotheobtainingofsalvationthroughourlordjesuschristwhodiedforusinorderthatwhetherwewatchorsleepwemaylivetogetherwithhimthereforecomfortoneanotherandbuildupeachonetheotherevenasyoualsodo');
        $tmp_search_meta_ARRAY[] = array('2thes2_8-12' => 'andthenthelawlessonewillberevealedwhomthelordjesuswillslaybythebreathofhismouthandbringtonothingbythemanifestationofhiscomingthecomingofwhomisaccordingtosatansoperationinallpowerandsignsandwondersofalieandinalldeceitofunrighteousnessamongthosewhoareperishingbecausetheydidnotreceivetheloveofthetruththattheymightbesaveddivcb_10andbecauseofthisgodsendstothemanoperationoferrorthattheymightbelievetheliesothatallwhohavenotbelievedthetruthbuthavetakenpleasureinunrighteousnessmightbejudged');
        $tmp_search_meta_ARRAY[] = array('2thes2_16-17' => 'nowourlordjesuschristhimselfandgodourfatherwhohaslovedusandgivenuseternalcomfortandgoodhopeingracecomfortyourheartsandestablishemyouemineverygoodworkandword');
        $tmp_search_meta_ARRAY[] = array('1tim1_1' => 'paulanapostleofchristjesusaccordingtothecommandofgodoursaviorandofchristjesusourhope');
        $tmp_search_meta_ARRAY[] = array('1tim4_1-5' => 'butthespiritsaysexpresslythatinlatertimessomewilldepartfromthefaithgivingheedtodeceivingspiritsandteachingsofdemonsbymeansofthehypocrisyofmenwhospeakliesofmenwhoarebrandedintheirownconscienceaswithahotirondivcb_10whoforbidmarriageemandcommandemabstainingfromfoodswhichgodhascreatedtobepartakenofwiththanksgivingbythosewhobelieveandhavefullknowledgeofthetruthdivcb_10foreverycreatureofgodisgoodandnothingistoberejectedifreceivedwiththanksgivingforitissanctifiedthroughthewordofgodandintercession');
        $tmp_search_meta_ARRAY[] = array('1tim6_17' => 'chargethosewhoarerichinthepresentagenottobehighmindednortosettheirhopeontheuncertaintyofrichesbutongodwhoaffordsusallthingsrichlyforemouremenjoyment');
        $tmp_search_meta_ARRAY[] = array('2tim1_6' => 'forwhichcauseiremindyoutofanintoflamethegiftofgodwhichisinyouthroughthelayingonofmyhands');
        $tmp_search_meta_ARRAY[] = array('2tim1_6-8' => 'forwhichcauseiremindyoutofanintoflamethegiftofgodwhichisinyouthroughthelayingonofmyhandsforgodhasnotgivenusaspiritofcowardicebutofpowerandofloveandofsobermindednessthereforedonotbeashamedofthetestimonyofourlordnorofmehisprisonerbutsufferevilwiththegospelaccordingtothepowerofgod');
        $tmp_search_meta_ARRAY[] = array('titus1_1-3' => 'paulaslaveofgodandanapostleofjesuschristaccordingtothefaithofgodschosenonesandthefullknowledgeofthetruthwhichisaccordingtogodlinessinthehopeofeternallifewhichgodwhocannotliepromisedbeforethetimesoftheagesbutinitsowntimesmanifestedhiswordintheproclamationwithwhichiwasentrustedaccordingtothecommandofoursaviorgod');
        $tmp_search_meta_ARRAY[] = array('titus2_11-15' => 'forthegraceofgodbringingsalvationtoallmenhasappearedtrainingusthatdenyingungodlinessandworldlylustsweshouldlivesoberlyandrighteouslyandgodlyinthepresentagedivcb_10awaitingtheblessedhopeeventheappearingofthegloryofourgreatgodandsaviorjesuschristwhogavehimselfforusthathemightredeemusfromalllawlessnessandpurifytohimselfaparticularpeopleashisuniquepossessionzealousofgoodworksdivcb_10thesethingsspeakandexhortandconvictwithallauthorityletnoonedespiseyou');
        $tmp_search_meta_ARRAY[] = array('titus3_7[000]' => 'inorderthathavingbeenjustifiedbyhisgracewemightbecomeheirsaccordingtothehopeofeternallife');
        $tmp_search_meta_ARRAY[] = array('titus3_7' => 'inorderthathavingbeenjustifiedbyhisgracewemightbecomeheirsaccordingtothehopeofeternallife');
        $tmp_search_meta_ARRAY[] = array('heb2_14-15' => 'sincethereforethechildrenhavesharedinbloodandfleshhealsohimselfinlikemannerpartookofthesamethatthroughdeathhemightdestroyhimwhohasthemightofdeaththatisthedevilandmightreleasethosewhobecauseofthefearofdeaththroughalltheirlifewereheldinslavery');
        $tmp_search_meta_ARRAY[] = array('heb3_6[000]' => 'butchristemwasfaithfulemasasonoverhishousewhosehouseweareifindeedweholdfasttheboldnessandtheboastofhopefirmtotheend');
        $tmp_search_meta_ARRAY[] = array('heb3_6' => 'butchristemwasfaithfulemasasonoverhishousewhosehouseweareifindeedweholdfasttheboldnessandtheboastofhopefirmtotheend');
        $tmp_search_meta_ARRAY[] = array('heb3_7-19[000]' => 'thereforeevenastheholyspiritsays&quottodayifyouhearhisvoicedonothardenyourheartsasintheprovocationinthedayoftrialinthewildernesswhereyourfatherstriedemmeembytestingemmeemandsawmyworksforfortyyearsthereforeiwasdispleasedwiththisgenerationandisaidtheyalwaysgoastrayintheirheartandtheyhavenotknownmywaysdivcb_10asisworeinmywraththeyshallnotenterintomyrest&quotdivcb_10bewarebrotherslestperhapstherebeinanyoneofyouanevilheartofunbeliefinfallingawayfromthelivinggodbutexhortoneanothereachdayaslongasitiscalled&quottoday&quotlestanyoneofyoubehardenedbythedeceitfulnessofsin&ndash&ndashdivcb_10forwehavebecomepartnersofchristifindeedweholdfastthebeginningoftheassurancefirmtotheend&ndash&ndashdivcb_10whileitissaid&quottodayifyouhearhisvoicedonothardenyourheartsasintheprovocation&quotforwhoprovokedemhimemwhentheyheardindeedwasitnotallwhocameoutofegyptbymosesandwithwhomwashedispleasedforfortyyearswasitnotwiththosewhosinnedwhosecarcassesfellinthewildernessdivcb_10andtowhomdidheswearthattheyshouldnotenterintohisrestexcepttothedisobedientandweseethattheywerenotabletoenterinbecauseofunbelief');
        $tmp_search_meta_ARRAY[] = array('heb3_7-19' => 'thereforeevenastheholyspiritsays&quottodayifyouhearhisvoicedonothardenyourheartsasintheprovocationinthedayoftrialinthewildernesswhereyourfatherstriedemmeembytestingemmeemandsawmyworksforfortyyearsthereforeiwasdispleasedwiththisgenerationandisaidtheyalwaysgoastrayintheirheartandtheyhavenotknownmywaysdivcb_10asisworeinmywraththeyshallnotenterintomyrest&quotdivcb_10bewarebrotherslestperhapstherebeinanyoneofyouanevilheartofunbeliefinfallingawayfromthelivinggodbutexhortoneanothereachdayaslongasitiscalled&quottoday&quotlestanyoneofyoubehardenedbythedeceitfulnessofsin&ndash&ndashdivcb_10forwehavebecomepartnersofchristifindeedweholdfastthebeginningoftheassurancefirmtotheend&ndash&ndashdivcb_10whileitissaid&quottodayifyouhearhisvoicedonothardenyourheartsasintheprovocation&quotforwhoprovokedemhimemwhentheyheardindeedwasitnotallwhocameoutofegyptbymosesandwithwhomwashedispleasedforfortyyearswasitnotwiththosewhosinnedwhosecarcassesfellinthewildernessdivcb_10andtowhomdidheswearthattheyshouldnotenterintohisrestexcepttothedisobedientandweseethattheywerenotabletoenterinbecauseofunbelief');
        $tmp_search_meta_ARRAY[] = array('heb4_8-16' => 'forifjoshuahadbroughtthemintoresthewouldnothavespokenconcerninganotherdayafterthesethingssothenthereremainsasabbathrestforthepeopleofgodforhewhohasenteredintohisresthashimselfalsorestedfromhisworksasgoddidfromhisownletusthereforebediligenttoenterintothatrestlestanyonefallafterthesameexampleofdisobediencedivcb_10forthewordofgodislivingandoperativeandsharperthananytwoedgedswordandpiercingeventothedividingofsoulandspiritandofjointsandmarrowandabletodiscernthethoughtsandintentionsoftheheartandthereisnocreaturethatisnotmaifestbeforehimbutallthingsarenakedandlaidbaretotheeyesofhimtowhomweareemtogiveemouraccountdivcb_10havingthereforeagreathighpriestwhohaspassedthroughtheheavensjesusthesonofgodletusholdfasttheconfessionforwedonothaveahighpriestwhocannotbetouchedwiththefeelingofourweaknessesbutonewhohasbeentemptedinallrespectslikeemusyetemwithoutsinletusthereforecomeforwardwithboldnesstothethroneofgracethatwemayrecievemercyandfindgracefortimelyhelp');
        $tmp_search_meta_ARRAY[] = array('heb4_11' => 'letusthereforebediligenttoenterintothatrestlestanyonefallafterthesameexampleofdisobedience');
        $tmp_search_meta_ARRAY[] = array('heb6_17-20' => 'thereforegodintendingtoshowmoreabundantlytotheheirsofthepromisetheunchangeablenessofhiscounselinterposedwithanoathinorderthatbytwounchangeablethingsinwhichitwasimpossibleforgodtoliewemayhavestrongencouragementwewhohavefledforrefugetolayholdofthehopesetbeforeemusemdivcb_10whichwehaveasananchorofthesoulbothsecureandfirmandwhichenterswithintheveilwheretheforerunnerjesushasenteredforushavingbecomeforeverahighpriestaccordingtotheorderofmelchizedek');
        $tmp_search_meta_ARRAY[] = array('heb7_17-19' => 'foritistestified&quotyouareapriestforeveraccordingtotheorderofmelchizedek&quotforthereisontheonehandthesettingasideoftheprecedingcommandmentbecauseofitsweaknessandunprofitablenessforthelawperfectednothingandontheotherhandthebringinginthereuponofabetterhopethroughwhichwedrawneartogoddivcb_10andinasmuchasemhewasemnotemmadeapriestemwithoutthetakingofanoathfortheyareappointedpriestswithoutthetakingofanoathbuthewiththetakingofanoathbyhimwhosaidtohim&quotthelordhasswornandwillnotregretemitemyouareapriestforever&quotdivcb_10bysomuchjesushasalsobecomethesuretyofabettercovenant');
        $tmp_search_meta_ARRAY[] = array('heb8_10[000]' => 'forthisisthecovenantwhichiwillcovenantwiththehouseofisraelafterthosedayssaysthelordiwillimpartmylawsintotheirmindandontheirheartsiwillinscribethemandiwillbegodtothemandtheywillbeapeopletome');
        $tmp_search_meta_ARRAY[] = array('heb8_10' => 'forthisisthecovenantwhichiwillcovenantwiththehouseofisraelafterthosedayssaysthelordiwillimpartmylawsintotheirmindandontheirheartsiwillinscribethemandiwillbegodtothemandtheywillbeapeopletome');
        $tmp_search_meta_ARRAY[] = array('heb9_14' => 'howmuchmorewillthebloodchristwhothroughtheeternalspiritofferedhimselfwithoutblemishtogodpurifyourconsciencefromdeadworkstoservethelivinggod');
        $tmp_search_meta_ARRAY[] = array('heb10_22,19' => 'spanscript_ref_num22letuscomeforwardtoemtheholyofholiesemwithatrueheartinfullassuranceoffaithhavingourheartssprinkledfromanevilconscienceandhavingourbodieswashedwithpurewaterdivcb_10spanscript_ref_num19havingthereforebrothersboldnessforenteringtheemholyofemholiesinthebloodofjesus');
        $tmp_search_meta_ARRAY[] = array('heb10_22' => 'letuscomeforwardtoemtheholyofholiesemwithatrueheartinfullassuranceoffaithhavingourheartssprinkledfromanevilconscienceandhavingourbodieswashedwithpurewater');
        $tmp_search_meta_ARRAY[] = array('heb10_21-23' => 'andemhavingemagreatpriestoverthehouseofgodletuscomeforwardtoemtheholyofholiesemwithatrueheartinfullassuranceoffaithhavingourheartssprinkledfromanevilconscienceandhavingourbodieswashedwithpurewaterdivcb_10letusholdfasttheconfessionofourhopeunwaveringforhewhohaspromisedisfaithful');
        $tmp_search_meta_ARRAY[] = array('heb10_23' => 'letusholdfasttheconfessionofourhopeunwaveringforhewhohaspromisedisfaithful');
        $tmp_search_meta_ARRAY[] = array('heb10_35' => 'donotcastawaythereforeyourboldnesswhichhasgreatreward');
        $tmp_search_meta_ARRAY[] = array('heb10_35,38-39' => 'spanscript_ref_num35donotcastawaythereforeyourboldnesswhichhasgreatrewarddivcb_10spanscript_ref_num38butmyrighteousoneshalllivebyfaithandifheshrinksbackmysouldoesnotdelightinhimbutwearenotofthosewhoshrinkbacktoruinbutofthosewhohavefaithtothegainingofthesoul');
        $tmp_search_meta_ARRAY[] = array('heb11_1' => 'nowfaithisthesubstantiationofthingshopedfortheconvictionofthingsnotseen');
        $tmp_search_meta_ARRAY[] = array('heb12_1' => 'thereforeletusalsohavingsogreatacloudofwitnessessurroundingusputawayeveryencumbranceandthesinwhichsoeasilyentanglesemusemandrunwithendurancetheracewhichissetbeforeus');
        $tmp_search_meta_ARRAY[] = array('james3_1-2' => 'donotbecomemanyteachersmybrothersknowingthatwewillreceivegreaterjudgementforinmanythingsweallstumbleifanyonedoesnotstumbleinwordthisoneisaperfectmanabletobridlethewholebodyaswell');
        $tmp_search_meta_ARRAY[] = array('1pet1_3-9,13,21' => 'spanscript_ref_num3blessedbethegodandfatherofourlordjesuschristwhoaccordingtohisgreatmercyhasregeneratedusuntoalivinghopethroughtheresurrectionofjesuschristfromthedeaduntoaninheritanceincorruptibleandundefiledandunfadingkeptintheheavensforyouwhoarebeingguardedbythepowerofgodthroughfaithuntoasalvationreadytoberevealedatthelasttimedivcb_10inwhichemtimeemyouexultthoughforalittlewhileatpresentifitmustbeyouhavebeenmadesorrowfulbyvarioustrialssothattheprovingofyourfaithmuchmorepreciousthanofgoldwhichperishesthoughitisprovedbyfiremaybefounduntopraiseandgloryandhonorattherevelationofjesuschristdivcb_10whomhavingnotseenyouloveintowhomthoughnotseeingemhimematpresentyetbelievingyouexultwithjoyemthatisemunspeakableandfullofgloryreceivingtheendofyourfaiththesalvationofyoursoulsdivcb_10spanscript_ref_num13thereforegirdinguptheloinsofyourmindemandembeingsobersetyourhopeperfectlyonthegracebeingbroughttoyouattherevelationofjesuschristdivcb_10spanscript_ref_num21whothroughhimbelieveintogodwhoraisedhimfromthedeadandgavehimglorysothatyourfaithandhopeareingod');
        $tmp_search_meta_ARRAY[] = array('1pet1_3-5' => 'blessedbethegodandfatherofourlordjesuschristwhoaccordingtohisgreatmercyhasregeneratedusuntoalivinghopethroughtheresurrectionofjesuschristfromthedeaduntoaninheritanceincorruptibleandundefiledandunfadingkeptintheheavensforyouwhoarebeingguardedbythepowerofgodthroughfaithuntoasalvationreadytoberevealedatthelasttime');
        $tmp_search_meta_ARRAY[] = array('1pet1_13' => 'thereforegirdinguptheloinsofyourmindemandembeingsobersetyourhopeperfectlyonthegracebeingbroughttoyouattherevelationofjesuschrist');
        $tmp_search_meta_ARRAY[] = array('1pet2_16' => 'asfreeandyetnothavingfreedomasacoveringforevilbutasslavesofgod');
        $tmp_search_meta_ARRAY[] = array('1pet2_20' => 'forwhatgloryisitifwhilesinningandbeingbuffetedyouendurebutifwhiledoinggoodandsufferingyouendurethisisgracewithgod');
        $tmp_search_meta_ARRAY[] = array('1pet2_7-8' => 'toyouthereforewhobelieveisthepreciousnessbuttotheunbelieving&quotthestonewhichthebuildersrejectedthishasbecometheheadofthecorner&quotand&quotastoneofstumblingandarockofoffense&quotwhostumbleatthewordbeingdisobedienttowhichalsotheywereappointed');
        $tmp_search_meta_ARRAY[] = array('1pet2_24' => 'whohimselfboreupoursinsinhisbodyonthetreeinorderthatwehavingdiedtosinsmightlivetorighteousnessbywhosebruiseyouwerehealed');
        $tmp_search_meta_ARRAY[] = array('1pet3_15' => 'butsanctifychristaslordinyourheartsbeingalwaysreadyforadefensetoeveryonewhoasksofyouanaccountconcerningthehopewhichisinyou');
        $tmp_search_meta_ARRAY[] = array('1pet3_5-7,14-22' => 'spanscript_ref_num5forinthismannerformerlytheholywomenalsowhohopedingodadornedthemselvesbeingsubjecttotheirownhusbandsassarahobeyedabrahamcallinghimlordwhosechildrenyouhavebecomeifyoudogoodanddonotfearanyterrordivcb_10husbandsinlikemannerdwelltogetherwithemthememaccordingtoknowledgeaswiththeweakerfemalevesselassigninghonortoemthememasalsotofellowheirsofthegraceoflifethatyourprayersmaynotbehindereddivcb_10spanscript_ref_num14butevenifyousufferbecauseofrighteousnessyouareblessedanddonotbeafraidemwithemfearfromthemnorbetroubledbutsanctifychristaslordinyourheartsbeingalwaysreadyforadefensetoeveryonewhoasksofyouanaccountconcerningthehopewhichisinyouyetwithmeeknessandfearhavingagoodconsciencesothatinthemannerinwhichyouarespokenagainstthosewhorevileyourgoodmanneroflifeinchristmaybeputtoshamedivcb_10foritisbetterifthewillofgodshouldwillemitemtosufferfordoinggoodthanfordoingevilforchristalsohassufferedonceforsinstherighteousonbehalfoftheunrighteousthathemightbringyoutogodontheonehandbeingputtodeathinthefleshbutontheothermadealiveinthespiritdivcb_10inwhichalsohewentandproclaimedtothespiritsinprisonwhohadformerlydisobeyedwhenthelongsufferingofgodwaitedinthedaysofnoahwhilethearkwasbeingpreparedementeringemintowhichafewthatiseightsoulswerebroughtsafelythroughbywaterdivcb_10whichemwateremastheantitypealsonowsavesyouemthatisembaptismnotaputtingawayofthefilthofthefleshbuttheappealofagoodconscienceuntogodthroughtheresurrectionofjesuschristwhoisattherighthandofgodhavinggoneintoheavenangelsandauthoritiesandpowersbeingsubjectedtohim');
        $tmp_search_meta_ARRAY[] = array('1pet5_8' => 'besoberwatchyouradversarythedevilasaroaringlionwalksaboutseekingsomeonetodevour');
        $tmp_search_meta_ARRAY[] = array('1john2_15-17' => 'donotlovetheworldnorthethingsintheworldifanyonelovestheworldloveforthefatherisnotinhimbecauseallthatisintheworldthelustofthefleshandthelustoftheeyesandthevaingloryoflifeisnotofthefatherbutisoftheworldandtheworldispassingawayanditslustbuthewhodoesthewillofgodabidesforever');
        $tmp_search_meta_ARRAY[] = array('1john3_1-10' => 'beholdwhatmanneroflovethefatherhasgiventousthatweshouldbecalledchildrenofgodandwearebecauseofthistheworlddoesnotknowusbecauseitdidnotknowhimbelovednowwearechildrenofgodandithasnotyetbeenmanifestedwhatwewillbeweknowthatifheismanifestedwewillbelikehimbecausewewillseehimevenasheisdivcb_10andeveryonewhohasthishopeemsetemonhimpurifieshimselfevenasheispureeveryonewhopracticessinpracticeslawlessnessalsoandsinislawlessnessandyouknowthathewasmanifestedthathemighttakeawaysinsandsinisnotinhimdivcb_10everyonewhoabidesinhimdoesnotsineveryonewhosinshasnotseenhimorknownhimlittlechildrenletnooneleadyouastrayhewhopracticesrighteousnessisrighteousevenasheisrighteousdivcb_10hewhopracticessinisofthedevilbecausethedevilhassinnedfromthebeginningforthispurposethesongodwasmanifestedthathemightdestroytheworksofthedevileveryonewhohasbeenbegottenofgoddoesnotpracticesinbecausehisseedabidesinhimandhecannotsinbecausehehasbeenbegottenofgoddivcb_10inthisthechildrenofgodandthechildrenofthedevilaremanifesteveryonewhodoesnotpracticerighteousnessisnotofgodneitherhewhodoesnotlovehisbrother');
        $tmp_search_meta_ARRAY[] = array('rev2_10-11' => 'donotfearthethingsthatyouareabouttosufferbeholdthedevilisabouttocastsomeofyouintoprisonthatyoumaybetriedandyouwillhavetribulationfortendaysbefaithfuluntodeathandiwillgiveyouthecrownoflifehewhohasanearlethimhearwhatthespiritsaystothechurcheshewhoovercomesshallbynomeansbehurtoftheseconddeath');
        $tmp_search_meta_ARRAY[] = array('rev2_12-17' => 'andtothemessengerofthechurchinpergamoswritethesethingssayshewhohasthesharptwoedgedswordiknowwhereyoudwellwheresatansthroneisandyouholdfastmynameandhavenotdeniedmyfaitheveninthedaysofantipasmywitnessmyfaithfulonewhowaskilledamongyouwheresatandwellsdivcb_10butihaveafewthingsagainstyouthatyouhavesometherewhoholdtheteachingofbalaamwhotaughtbalaktoputastumblingblockbeforethesonsofisraeltoeatidolsacrificesandtocommitfornicationdivcb_10inthesamewayyoualsohavesomewhoholdinlikemannertheteachingofthenicolaitansrepentthereforebutifnotiamcomingtoyouquicklyandiwillmakewarwiththemwiththeswordofmymouthdivcb_10hewhohasanearlethimhearwhatthespiritsaystothechurchestohimwhoovercomestohimiwillgiveofthehiddenmannaandtohimiwillgiveawhitestoneanduponthestoneanewnamewrittenwhichnooneknowsexcepthimwhoreceivesemitem');
        $tmp_search_meta_ARRAY[] = array('rev2_18-23' => 'andtothemessengerofthechurchinthyatirawritethesethingssaysthesonofgodhewhohaseyeslikeaflameoffireandhisfeetarelikeshiningbronzeiknowyourworksandloveandfaithandserviceandyourenduranceandthatyourlastworksaremorethanthefirstbutihaveemsomethingemagainstyouthatyoutoleratethewomanjezebelshewhocallsherselfaprophetessandteachesandleadsmyslavesastraytocommitfornicationandtoeatidolsacrificesdivcb_10andigavehertimethatshemightrepentandsheisnotwillingtorepentofherfornicationbeholdicastherintoabedandthosewhocommitadulterywithherintogreattribulationunlesstheyrepentofherworksandherchildreniwillkillwithdeathandallthechurcheswillknowthatiamhewhosearchestheinwardpartsandtheheartsandiwillgivetoeachoneofyouaccordingtoyourworks');
        $tmp_search_meta_ARRAY[] = array('rev2_14[solo]' => 'butihaveafewthingsagainstyouthatyouhavesometherewhoholdtheteachingofbalaamwhotaughtbalaktoputastumblingblockbeforethesonsofisraeltoeatidolsacrificesandtocommitfornication');
        $tmp_search_meta_ARRAY[] = array('rev2_14' => 'butihaveafewthingsagainstyouthatyouhavesometherewhoholdtheteachingofbalaamwhotaughtbalaktoputastumblingblockbeforethesonsofisraeltoeatidolsacrificesandtocommitfornication');
        $tmp_search_meta_ARRAY[] = array('rev2_11|2_17,26-28|3_5,12,21' => 'spanscript_ref_num11hewhohasanearlethimhearwhatthespiritsaystothechurcheshewhoovercomesshallbynomeansbehurtoftheseconddeathdivcb_10spanscript_ref_num17hewhohasanearlethimhearwhatthespiritsaystothechurchestohimwhoovercomestohimiwillgiveofthehiddenmannaandtohimiwillgiveawhitestoneanduponthestoneanewnamewrittenwhichnooneknowsexcepthimwhoreceivesemitemdivcb_10spanscript_ref_num26andhewhoovercomesandhewhokeepsmyworksuntiltheendtohimiwillgiveauthorityoverthenationsandhewillshepherdthemwithanironrodasvesselsofpotteryarebrokeninpiecesasialsohavereceivedfrommyfatherandtohimiwillgivethemorningstardivcb_10spanscript_ref_num5hewhoovercomeswillbeclothedthusinwhitegarmentsandishallbynomeanserasehisnameoutofthebookoflifeandiwillconfesshisnamebeforemyfatherandbeforehisangelsdivcb_10spanscript_ref_num12hewhoovercomeshimiwillmakeapillarinthetempleofmygodandheshallbynomeansgooutanymoreandiwillwriteuponhimthenameofmygodandthenameofthecityofmygodthenewjerusalemwhichdescendsoutofheavenfrommygodandmynewnamedivcb_10spanscript_ref_num21hewhoovercomestohimiwillgivetositwithmeonmythroneasialsoovercameandsatwithmyfatheronhisthrone');
        $tmp_search_meta_ARRAY[] = array('rev2_21-22' => 'andigavehertimethatshemightrepentandsheisnotwillingtorepentofherfornicationbeholdicastherintoabedandthosewhocommitadulterywithherintogreattribulationunlesstheyrepentofherworks');
        $tmp_search_meta_ARRAY[] = array('rev3_8' => 'iknowyourworksbeholdihaveputbeforeyouanopeneddoorwhichnoonecanshutbecauseyouhavealittlepowerandhavekeptmywordandhavenotdeniedmyname');
        $tmp_search_meta_ARRAY[] = array('rev3_7-13' => 'andtotheasup_ftnt_1script_suponclickjony5_vv_scroll_toftnt_11amessengerofthechurchinphiladelphiawritethesethingssaysasup_ftnt_2script_suponclickjony5_vv_scroll_toftnt_2displaynone2atheholyonethetrueonetheonewhohasthekeyofdavidtheonewhoopensandnoonewillshutandshutsandnooneopensdivcb_10iknowyourasup_ftnt_3script_suponclickjony5_vv_scroll_toftnt_3displaynone3aworksbeholdihaveputbeforeyouanasup_ftnt_4script_suponclickjony5_vv_scroll_toftnt_4displaynone4aopeneddoorwhichnoonecanshutbecauseyouhaveaasup_ftnt_5script_suponclickjony5_vv_scroll_toftnt_5displaynone5alittlepowerandhaveasup_ftnt_6script_suponclickjony5_vv_scroll_toftnt_6displaynone6akeptmywordandhaveasup_ftnt_7script_suponclickjony5_vv_scroll_toftnt_7displaynone7anotdeniedmynamebeholdiwillmakeasup_ftnt_8script_suponclickjony5_vv_scroll_toftnt_8displaynone8athoseofthesynagogueofsatanthosewhocallthemselvesjewsandarenotbutlie&ndash&ndashbeholdiwillcausethemtocomeandfallprostratebeforeyourfeetandtoknowthatihavelovedyoudivcb_10asup_ftnt_9script_suponclickjony5_vv_scroll_toftnt_9displaynone9abecauseyouhavekepttheasup_ftnt_10script_suponclickjony5_vv_scroll_toftnt_10displaynone10awordofmyenduranceialsowillkeepyououtoftheasup_ftnt_11script_suponclickjony5_vv_scroll_toftnt_11displaynone11ahouroftrialwhichisabouttocomeonthewholeinhabitedearthtotrythemwhodwellontheearthasup_ftnt_12script_suponclickjony5_vv_scroll_toftnt_12displaynone12aicomequicklyasup_ftnt_13script_suponclickjony5_vv_scroll_toftnt_13displaynone13aholdfastwhatyouhavethatnoonetakeyourcrowndivcb_10asup_ftnt_14script_suponclickjony5_vv_scroll_toftnt_14displaynone14ahewhoovercomeshimiwillmakeapillarinthetempleofmygodandheshallbynomeansgooutanymoreandiwillwriteuponhimthenameofmygodandthenameofthecityofmygodthenewjerusalemwhichdescendsoutofheavenfrommygodandmynewnamehewhohasanearlethimhearwhatthespiritsaystothechurches');
        $tmp_search_meta_ARRAY[] = array('rev3_19' => 'asmanyasiloveireproveanddisciplinebezealousthereforeandrepent');
        $tmp_search_meta_ARRAY[] = array('rev6_16-17' => 'andtheysaytothemountainsandtotherocksfallonusandhideusfromthefaceofhimwhositsuponthethroneandfromthewrathofthelambforthegreatdayoftheirwrathhascomeandwhoisabletostand');
        $tmp_search_meta_ARRAY[] = array('rev12_3-4,9' => 'spanscript_ref_num3andanothersignwasseeninheavenandbeholdemtherewasemagreatreddragonhavingsevenheadsandtenhornsandonhisheadssevendiademsandhistaildragsawaythethirdpartofthestarsofheavenandhecastthemtotheearthandthedragonstoodbeforethewomanwhowasabouttobringforthsothatwhenshebringsforthhemightdevourherchilddivcb_10spanscript_ref_num9andthegreatdragonwascastdowntheancientserpenthewhoiscalledthedevilandsatanhewhodeceivesthewholeinhabitedearthhewascasttotheearthandhisangelswerecastdownwithhim');
        $tmp_search_meta_ARRAY[] = array('rev12_3-4,13,17;13:2,4' => 'spanscript_ref_num3andanothersignwasseeninheavenandbeholdemtherewasemagreatreddragonhavingsevenheadsandtenhornsandonhisheadssevendiademsandhistaildragsawaythethirdpartofthestarsofheavenandhecastthemtotheearthandthedragonstoodbeforethewomanwhowasabouttobringforthsothatwhenshebringsforthhemightdevourherchilddivcb_10spanscript_ref_num13andwhenthedragonsawthathewascasttotheearthhepersecutedthewomanwhobroughtforththemanchilddivcb_10spanscript_ref_num17andthedragonbecameangrywiththewomanandwentawaytomakewarwiththerestofherseedwhokeepthecommandmentsofgodandhavethetestimonyofjesusdivcb_10spanscript_ref_num132andthebeastwhichisawwaslikealeopardandhisfeetlikethoseofabearandhismouthlikethemouthofalionandthedragongavehimhispowerandhisthroneandgreatauthoritydivcb_10spanscript_ref_num4andtheyworshippedthedragonbecausehegavehisauthoritytothebeastandtheyworshippedthebeastsayingwhoislikethebeastandwhocanmakewarwithhim');
        $tmp_search_meta_ARRAY[] = array('rev20_6' => 'blessedandholyishewhohaspartinthefirstresurrectionoverthesetheseconddeathhasnoauthoritybuttheywillbepriestsofgodandofchristandwillreignwithhimforathousandyears');
        $tmp_search_meta_ARRAY[] = array('rev21_2,9-27' => 'spanscript_ref_num2andisawtheholycitynewjerusalemcomingdownoutofheavenfromgodpreparedasabrideadornedforherhusbanddivcb_10spanscript_ref_num9andoneofthesevenangelswhohadthesevenbowlsfullofthesevenlastplaguescameandspokewithmesayingcomehereiwillshowyouthebridethewifeofthelambandhecarriedmeawayinspiritontoagreatandhighmountainandshowedmetheholycityjerusalemcomingdownoutofheavenfromgodhavingthegloryofgodherlightwaslikeamostpreciousstonelikeajasperstoneasclearascrystalithadagreatandhighwallandhadtwelvegatesandatthegatestwelveangelsandnamesinscribedwhicharethenamesofthetwelvetribesofthesonsofisraelontheeastthreegatesandonthenorththreegatesandonthesouththreegatesandonthewestthreegatesandthewallofthecityhadtwelvefoundationsandonthemthetwelvenamesofthetwelveapostlesofthelambandhewhospokewithmehadagoldenreedasameasurethathemightmeasurethecityanditsgatesanditswallandthecityliessquareanditslengthisasgreatasthebreadthandhemeasuredthecitywiththereedtoemalengthofemtwelvethousandstadiathelengthandthebreadthandtheheightofitareequalandhemeasureditswallahundredandfortyfourcubitsemaccordingtoemthemeasureofamanthatisofanangelandthebuildingworkofitswallwasjasperandthecitywaspuregoldlikeclearglassthefoundationsofthewallofthecitywereadornedwitheverypreciousstonethefirstfoundationwasjasperthesecondsapphirethethirdchalcedonythefourthemeraldthefifthsardonyxthesixthsardiustheseventhchrysolitetheeightberyltheninthtopazthetenthchrysoprasetheeleventhjacinththetwelfthamethystandthetwelvegatesweretwelvepearlseachoneofthegateswasrespectivelyofonepearlandthestreetofthecitywaspuregoldliketransparentglassandisawnotempleinitforthelordgodthealmightyandthelambareitstempleandthecityhasnoneedofthesunorofthemoonthattheyshouldshineinitforthegloryofgodillumineditanditslampisthelambandthenationswillwalkbyitslightandthekingsoftheearthbringtheirgloryintoitanditsgatesshallbynomeansbeshutbydayfortherewillbenonightthereandtheywillbringthegloryandthehonorofthenationsintoitandanythingcommonandhewhomakesanabominationandalieshallbynomeansenterintoitbutonlythosewhoarewritteninthelambsbookoflife');
        $tmp_search_meta_ARRAY[] = array('rev21_7' => 'hewhoovercomeswillinheritthesethingsandiwillbegodtohimandhewillbeasontome');
        $tmp_search_meta_ARRAY[] = array('rev21_3-5' => 'andiheardaloudvoiceoutofthethronesayingbeholdthetabernacleofgodiswithmenandhewilltabernaclewiththemandtheywillbehispeoplesandgodhimselfwillbewiththememandbeemtheirgodandhewillwipeawayeverytearfromtheireyesanddeathwillbenomorenorwilltherebesorroworcryingorpainanymorefortheformerthingshavepassedawayandhewhositsonthethronesaidbeholdimakeallthingsnewandhesaidwriteforthesewordsarefaithfulandtrue');
        $tmp_search_meta_ARRAY[] = array('rev21_21' => 'andthetwelvegatesweretwelvepearlseachoneofthegateswasrespectivelyofonepearlandtheasup_ftnt_3script_suponclickjony5_vv_scroll_toftnt_33astreetofthecitywaspuregoldliketransparentglass');
        $tmp_search_meta_ARRAY[] = array('rev22_2' => 'andonthissideandonthatsideoftheriverwasthetreeoflifeproducingtwelvefruitsyieldingitsfruiteachmonthandtheleavesofthetreeoflifeareforthehealingofthenations');

        return $tmp_search_meta_ARRAY;

    }

    public function return_search_meta_jony5($ugc_str){
        // Friday, March 1, 2024 2158 hrs.

        //
        // BUILD SEARCH CONTENT ARRAY.
        // BUILD AND RETURN A COMPLETE
        // SEARCH STRUCT OF JONY5 META.
        $tmp_search_meta_ARRAY = '[' . time() . '] from return_search_meta_jony5(UGC LEN=' . strlen($ugc_str) . ')';

        return $tmp_search_meta_ARRAY;

    }

    public function return_search_meta_ARRAY($ugc_str, $search_all_jony5){
        // Thursday, February 29, 2024 1430 hrs.

        //
        // BUILD SEARCH CONTENT ARRAY.
        if($search_all_jony5 !== false){

            //
            // BUILD AND RETURN A COMPLETE
            // SEARCH STRUCT OF JONY5 META.
            $tmp_search_meta_ARRAY[] = $this->return_search_meta_jony5($ugc_str);
            $tmp_search_meta_ARRAY[] = $this->return_search_meta_scriptures($ugc_str);

        }else{

            //
            // BUILD AND RETURN A SEARCH
            // STRUCT OF SCRIPTURES META.
            $tmp_search_meta_ARRAY[] = $this->return_search_meta_scriptures($ugc_str);

        }

        return $tmp_search_meta_ARRAY;

    }

    public function search_for_all_preciousness($search_all_jony5 = false){

        //
        // Thursday, February 29, 2024 1430 hrs.
        $tmp_ugc_str = $tmp_result_html = '';

        //
        // DO WE HAVE $_GET[] UGC DATA?
        if(self::$oEnv->oHTTP_MGR->issetHTTP($_GET)){

            //
            // STORE THE $_GET[] DATA THAT HAS BEEN SENT.
            $tmp_ugc_str = self::$oEnv->oHTTP_MGR->extractData($_GET, 's');
            $tmp_site_search_str = self::$oEnv->oHTTP_MGR->extractData($_GET, 'site');

            if(strlen($tmp_ugc_str) > 1){

                //
                // IS THIS A GLOBAL SITE SEARCH?
                if(strlen($tmp_site_search_str) > 0){

                    switch($tmp_site_search_str){
                        case 'jony5':

                            $search_all_jony5 = true;

                        break;

                    }

                }

                //
                // RETURN THE SEARCH CONTENT ARRAY.
                $tmp_search_meta_ARRAY = $this->return_search_meta_ARRAY($tmp_ugc_str, $search_all_jony5);

            }

        }

        if(isset($tmp_search_meta_ARRAY)){

            $tmp_result_html = '<p>' . __LINE__ . ' ' . __FUNCTION__ . ' ' . print_r($tmp_search_meta_ARRAY, true) . '</p>';

        }

        echo $tmp_result_html;

    }

    public function build_link_html_index($vv_grouped = false){

        //
        // A NULL $vv_grouped IS INDICATION OF A
        // REQUEST TO BUILD AND RETURN HTML FOR
        // SCRIPTURES GROUPING UGC INPUT CONTROL.
        if(!isset($vv_grouped)){

            $tmp_JONY5_SCRIPTURES_INDEXED_BY_GROUP = 0;

            if(isset($_POST['JONY5_SCRIPTURES_INDEXED_BY_GROUP'])){

                $tmp_JONY5_SCRIPTURES_INDEXED_BY_GROUP = $_POST['JONY5_SCRIPTURES_INDEXED_BY_GROUP'];

            }else{

                if(self::$oEnv->oSESSION_MGR->issetSessionParam('JONY5_SCRIPTURES_INDEXED_BY_GROUP') !== false){

                    self::$vvid_is_grouped = false;

                    //
                    // INITIALIZE SCRIPTURE INDEX MODE SESSION PARAM.
                    self::$oEnv->oSESSION_MGR->setSessionParam('JONY5_SCRIPTURES_INDEXED_BY_GROUP', self::$vvid_is_grouped);

                }else{

                    $tmp_JONY5_SCRIPTURES_INDEXED_BY_GROUP = self::$oEnv->oSESSION_MGR->getSessionParam('JONY5_SCRIPTURES_INDEXED_BY_GROUP');

                }

            }

            $tmp_checkbox_state = '';
            if($tmp_JONY5_SCRIPTURES_INDEXED_BY_GROUP != 0){

                $tmp_checkbox_state = 'checked="checked"';
                self::$vvid_is_grouped = true;
                self::$oEnv->oSESSION_MGR->setSessionParam('JONY5_SCRIPTURES_INDEXED_BY_GROUP', true);

            }else{

                self::$vvid_is_grouped = false;
                self::$oEnv->oSESSION_MGR->setSessionParam('JONY5_SCRIPTURES_INDEXED_BY_GROUP', false);

            }

            //
            // RETURN HTML OUTPUT FOR UGC INPUT CONTROL LINK TO
            // TOGGLE SCRIPTURES PARENTHETICAL GROUPING "ON AND OFF".
            $tmp_group_by_link_html = '<div class="cb"></div>
                    <div style="float:left; padding-left:0; margin-left: 0; width:280px; cursor:pointer;" id="chkbx_JONY5_SCRIPTURES_INDEXED_BY_GROUP" class="crnrstn_chkbx_wrapper" onclick="crnrstn_vv_chkbxSel(this, \'JONY5_SCRIPTURES_INDEXED_BY_GROUP\');">
                        <form action="#" method="post" name="post_scriptures_group_by" id="post_scriptures_group_by" enctype="multipart/form-data">
                            <div style="float:left;"><input type="checkbox" id="scriptures_group_by_chkbx" name="scriptures_group_by_chkbx" style="width:22px; height:22px;" ' . $tmp_checkbox_state . '></div>
                            <div class="crnrstn_chkbx_copy" style="float:left; width:240px; padding-left: 5px;"><span class="script_lnk" style="font-size: 15px; color:#0066CC;">Display by Parenthetical Grouping</span></div>
                            <div class="cb"></div>
                            <div id="submit_shell" class="hidden">
                                <div id="vv_form_submit_btn" class="form_submit_btn" onmouseover="submitBtnMouseOver(this); return false;" onmouseout="submitBtnMouseOut(this); return false;" onclick="$(\'post_scriptures_group_by\').submit();">Submit</div>
                            </div>
                            <input type="hidden" name="JONY5_SCRIPTURES_INDEXED_BY_GROUP" id="JONY5_SCRIPTURES_INDEXED_BY_GROUP" value="' . $tmp_JONY5_SCRIPTURES_INDEXED_BY_GROUP . '" />
                            <input type="hidden" name="postid" id="postid" value="post_scriptures_group_by" />
                            <input type="hidden" name="OPTIN" id="OPTIN" value="0" />
                            <input type="hidden" name="crnrstn_interact_ui_sysdate" value="' . date('F j, Y H:i:s') . '">
                        </form>
                    </div>
                    <div class="cb"></div>
';

            //
            // AGGREGATE REPORTING ON BYTES RETURNED.
            $this->count_processed_bytes($tmp_group_by_link_html);

            echo $tmp_group_by_link_html;

            return NULL;

        }

        $tmp_link_vvid_ARRAY = array();

        if(self::$vvid_is_grouped !== false){

            //
            // Thursday, February 29, 2024 @ 0240 hrs.
            //
            // BUILD SCRIPTURE <A> LINK HTML
            // OUTPUT SCRIPTURES VVID INDEX CONTROL STRUCTURE.
            //$tmp_link_vvid_ARRAY[] = array(array('jehovah_has_revealed' => 'Jehovah Has Revealed His Heart'), array('jehovah_has_revealed_chords' => 'Chords'), array('jehovah_has_revealed_audio' => 'Listen&nbsp;&nbsp;<img src="https://jony5.com/common/imgs/listen_icon_wht.png" width="20" height="18" alt="Listen">'), array('jehovah_has_revealed_dl' => 'Listen&nbsp;&nbsp;<img src="https://jony5.com/common/imgs/listen_icon.png" width="20" height="18" alt="Download">'));
            $tmp_link_vvid_ARRAY[] = array(array('jehovah_has_revealed' => 'Jehovah Has Revealed His Heart'));
            $tmp_link_vvid_ARRAY[] = array(array('jehovah_has_revealed_chords' => 'Jehovah Has Revealed His Heart :: Chords'));
            //$tmp_link_vvid_ARRAY[] = array(array('jehovah_has_revealed_audio' => 'Jehovah Has Revealed His Heart :: Listen&nbsp;&nbsp;<img src="https://jony5.com/common/imgs/listen_icon_wht.png" width="20" height="18" alt="Listen">'));
            $tmp_link_vvid_ARRAY[] = array(array('jehovah_has_revealed_dl' => 'Jehovah Has Revealed His Heart :: Download'));
            $tmp_link_vvid_ARRAY[] = array(array('hymn979' => 'HYMNS #979'), array('gen1_1' => 'Genesis 1:1'), array('gen2_7' => 'Genesis 2:7'), array('col1_16' => 'Colossians 1:16'), array('gen1_26' => 'Genesis 1:26'), array('gen3_1' => 'Genesis 3:1'), array('gen3_14[solo]' => 'Genesis 3:14'), array('gen48_21-22|49_1,25-28' => 'Genesis 48:21-22; 49:1, 25-28'));
            $tmp_link_vvid_ARRAY[] = array(array('rev3_7-13' => 'Revelation 3:7-13'), array('gen49_1,25-28' => 'Genesis 49:1, 25-28'), array('deut33_1-4,12,29' => 'Deuteronomy 33:1-4, 12, 29'), array('isa16_1-5' => 'Isaiah 16:1-5'), array('dan9_17-27' => 'Daniel 9:17-27'), array('matt24_15-22' => 'Matthew 24:15-22'), array('matt24_8-14' => 'Matthew 24:8-14'), array('james3_1-2' => 'James 3:1-2'), array('num25_1-13' => 'Numbers 25:1-13'), array('jer1_11-19' => 'Jeremiah 1:11-19'), array('luke12_34-44' => 'Luke 12:34-44'));
            $tmp_link_vvid_ARRAY[] = array(array('lifestudy_exo_156' => 'Life-Study of Exodus, Message 156'));
            $tmp_link_vvid_ARRAY[] = array(array('exo20_15' => 'Exodus 20:15'));
            $tmp_link_vvid_ARRAY[] = array(array('exo20_13' => 'Exodus 20:13'));
            $tmp_link_vvid_ARRAY[] = array(array('exo30_18' => 'Exodus 30:18'));
            $tmp_link_vvid_ARRAY[] = array(array('exo30_17-21' => 'Exodus 30:17-21'));
            $tmp_link_vvid_ARRAY[] = array(array('lev18_1-5,24-28' => 'Leviticus 18:1-5, 24-28'));
            $tmp_link_vvid_ARRAY[] = array(array('lev26_3-13' => 'Leviticus 26:3-13'), array('deut4_1-2,39-40' => 'Deuteronomy 4:1-2, 39-40'), array('deut5_10,29' => 'Deuteronomy 5:10, 29'), array('deut6_1-6,16-25' => 'Deuteronomy 6:1-6, 16-25'), array('deut6_25' => 'Deuteronomy 6:25'), array('deut7_9-26' => 'Deuteronomy 7:9-26'), array('deut8_1-10' => 'Deuteronomy 8:1-10'), array('deut11_1,8-15,22-28' => 'Deuteronomy 11:1, 8-15, 22-28'), array('deut26_16-19' => 'Deuteronomy 26:16-19'), array('deut28_1-14' => 'Deuteronomy 28:1-14'), array('deut30_11-20' => 'Deuteronomy 30:11-20'), array('exo15_26' => 'Exodus 15:26'), array('1kings8_54-66' => '1 Kings 8:54-66'), array('neh1_1-11' => 'Nehemiah 1:1-11'));
            $tmp_link_vvid_ARRAY[] = array(array('num14_29-30' => 'Numbers 14:29-30'), array('1cor10_5' => '1 Corinthians 10:5'));
            $tmp_link_vvid_ARRAY[] = array(array('num14_31[000]' => 'Numbers 14:31'), array('1pet2_7-8' => '1 Peter 2:7-8'), array('rom9_31-33' => 'Romans 9:31-33'), array('1cor1_22-25' => '1 Corinthians 1:22-25'));
            $tmp_link_vvid_ARRAY[] = array(array('num14_31' => 'Numbers 14:31'), array('num32_13' => 'Numbers 32:13'), array('josh5_6' => 'Joshua 5:6'), array('psa95_10-11' => 'Psalm 95:10-11'), array('num14_35' => 'Numbers 14:35'), array('matt4_1-2' => 'Matthew 4:1-2'));
            $tmp_link_vvid_ARRAY[] = array(array('num33_50-54' => 'Numbers 33:50-54'));
            $tmp_link_vvid_ARRAY[] = array(array('deut11_14' => 'Deuteronomy 11:14'), array('joel2_23' => 'Joel 2:23'));
            $tmp_link_vvid_ARRAY[] = array(array('1kings2_1-3' => '1 Kings 2:1-3'));
            $tmp_link_vvid_ARRAY[] = array(array('1kings18_37-40,45;19_1-18' => '1 Kings 18:37-40, 45; 19:1-18'));
            $tmp_link_vvid_ARRAY[] = array(array('1sam4_4' => '1 Samuel 4:4'));
            $tmp_link_vvid_ARRAY[] = array(array('psa97_2' => 'Psalm 97:2'));
            $tmp_link_vvid_ARRAY[] = array(array('psa119_103' => 'Psalm 119:103'));
            $tmp_link_vvid_ARRAY[] = array(array('isa14_13' => 'Isaiah 14:13'));
            $tmp_link_vvid_ARRAY[] = array(array('isa14_21-24' => 'Isaiah 14:21-24'));
            $tmp_link_vvid_ARRAY[] = array(array('jer24_7' => 'Jeremiah 24:7'), array('1pet3_15' => '1 Peter 3:15'));
            $tmp_link_vvid_ARRAY[] = array(array('jer31_33' => 'Jeremiah 31:33'));
            $tmp_link_vvid_ARRAY[] = array(array('jer31_31-37' => 'Jeremiah 31:31-37'));
            $tmp_link_vvid_ARRAY[] = array(array('ezek11_17-25' => 'Ezekiel 11:17-25'), array('jer31_33-37' => 'Jeremiah 31:33-37'));
            $tmp_link_vvid_ARRAY[] = array(array('dan9_4' => 'Daniel 9:4'), array('gen26_4-5' => 'Genesis 26:4-5'), array('exo20_6' => 'Exodus 20:6'));
            $tmp_link_vvid_ARRAY[] = array(array('matt1_18,20' => 'Matthew 1:18, 20'));
            $tmp_link_vvid_ARRAY[] = array(array('matt2_4-6' => 'Matthew 2:4-6'));
            $tmp_link_vvid_ARRAY[] = array(array('lev2_1' => 'Leviticus 2:1'), array('matt3_15' => 'Matthew 3:15'));
            $tmp_link_vvid_ARRAY[] = array(array('matt4_3' => 'Matthew 4:3'));
            $tmp_link_vvid_ARRAY[] = array(array('matt4_4b' => 'Matthew 4:4b'), array('luke22_42' => 'Luke 22:42'));
            $tmp_link_vvid_ARRAY[] = array(array('matt4_5-7' => 'Matthew 4:5-7'));
            $tmp_link_vvid_ARRAY[] = array(array('matt5' => 'Matthew Chapter 5'), array('matt6' => 'Matthew Chapter 6'), array('matt7' => 'Matthew Chapter 7'));
            $tmp_link_vvid_ARRAY[] = array(array('rom6_18-19' => 'Romans 6:18-19'), array('1pet2_20' => '1 Peter 2:20'), array('matt5_10' => 'Matthew 5:10'));
            $tmp_link_vvid_ARRAY[] = array(array('matt5_13' => 'Matthew 5:13'), array('mark9_50' => 'Mark 9:50'), array('luke14_34-35' => 'Luke 14:34-35'));
            $tmp_link_vvid_ARRAY[] = array(array('matt7_13-14' => 'Matthew 7:13-14'));
            $tmp_link_vvid_ARRAY[] = array(array('matt10_16-33' => 'Matthew 10:16-33'));
            $tmp_link_vvid_ARRAY[] = array(array('matt11_28-30' => 'Matthew 11:28-30'));
            $tmp_link_vvid_ARRAY[] = array(array('matt12_1-8' => 'Matthew 12:1-8'));
            $tmp_link_vvid_ARRAY[] = array(array('matt13_4' => 'Matthew 13:4'));
            $tmp_link_vvid_ARRAY[] = array(array('matt19_12' => 'Matthew 19:12'));
            $tmp_link_vvid_ARRAY[] = array(array('matt24_14' => 'Matthew 24:14'));
            $tmp_link_vvid_ARRAY[] = array(array('matt25_4' => 'Matthew 25:4'));
            $tmp_link_vvid_ARRAY[] = array(array('matt26_33-35,69-75' => 'Matthew 26:33-35, 69-75'), array('mark14_27-31,66-72' => 'Mark 14:27-31, 66-72'), array('luke22_33-34,54-62' => 'Luke 22:33-34, 54-62'), array('john13_37-38;18_14-27' => 'John 13:37-38; 18:14-27'));
            $tmp_link_vvid_ARRAY[] = array(array('matt27_46' => 'Matthew 27:46'));
            $tmp_link_vvid_ARRAY[] = array(array('luke9_5-6' => 'Luke 9:5-6'), array('luke13_17' => 'Luke 13:17'), array('heb2_14-15' => 'Hebrews 2:14-15'), array('2cor3_12,17' => '2 Corinthians 3:12, 17'), array('rom8_33-39' => 'Romans 8:33-39'), array('1cor3_21-23' => '1 Corinthians 3:21-23'));
            $tmp_link_vvid_ARRAY[] = array(array('luke14_31-32' => 'Luke 14:31-32'));
            $tmp_link_vvid_ARRAY[] = array(array('luke18_11-12' => 'Luke 18:11-12'));
            $tmp_link_vvid_ARRAY[] = array(array('luke18_13' => 'Luke 18:13'));
            $tmp_link_vvid_ARRAY[] = array(array('rev6_16-17' => 'Revelation 6:16-17'), array('luke23_27-30' => 'Luke 23:28-30'), array('luke19_12,14,15,27' => 'Luke 19:12, 14, 15, 27'));
            $tmp_link_vvid_ARRAY[] = array(array('luke22_24-30' => 'Luke 22:24-27'), array('john13_3-17' => 'John 13:3-17'), array('matt16_25-26' => 'Matthew 16:25-26'));
            $tmp_link_vvid_ARRAY[] = array(array('luke22_42[solo]' => 'Luke 22:42'));
            $tmp_link_vvid_ARRAY[] = array(array('luke23_38,42-43' => 'Luke 23:38, 42-43'), array('john8_51-59' => 'John 8:51-59'), array('acts2_22-25' => 'Acts 2:22-25'), array('exo9_29' => 'Exodus 9:29'), array('deut10_14-22' => 'Deuteronomy 10:14-22'), array('psa24' => 'Psalm 24'), array('1cor10_26,29b-31' => '1 Corinthians 10:26, 29b-31'), array('luke1_26-33' => 'Luke 1:26-33'));
            $tmp_link_vvid_ARRAY[] = array(array('john2_20-21' => 'John 2:20-21'));
            $tmp_link_vvid_ARRAY[] = array(array('john2_21' => 'John 2:21'), array('matt12_5' => 'Matthew 12:5'));
            $tmp_link_vvid_ARRAY[] = array(array('john8_6' => 'John 8:6'), array('john9_41' => 'John 9:41'));
            $tmp_link_vvid_ARRAY[] = array(array('john13_34[solo]' => 'John 13:34'));
            $tmp_link_vvid_ARRAY[] = array(array('john13_37-38' => 'John 13:37-38'));
            $tmp_link_vvid_ARRAY[] = array(array('john14_10-14' => 'John 14:10-14'));
            $tmp_link_vvid_ARRAY[] = array(array('john14_12-14' => 'John 14:12-14'));
            $tmp_link_vvid_ARRAY[] = array(array('john16_15' => 'John 16:15'));
            $tmp_link_vvid_ARRAY[] = array(array('acts1_5' => 'Acts 1:5'));
            $tmp_link_vvid_ARRAY[] = array(array('acts8_29' => 'Acts 8:29'), array('acts16_6,7' => 'Acts 16:6, 7'), array('acts11_12' => 'Acts 11:12'));
            $tmp_link_vvid_ARRAY[] = array(array('acts11_18' => 'Acts 11:18'));
            $tmp_link_vvid_ARRAY[] = array(array('eph1_3-12' => 'Ephesians 1:3-12'), array('rom5_1-5[000]' => 'Romans 5:1-5'), array('rom15_4[000]' => 'Romans 15:4'), array('1cor9_8-11,13' => '1 Corinthians 9:8-11, 13'));
            $tmp_link_vvid_ARRAY[] = array(array('rom5_10' => 'Romans 5:10'));
            $tmp_link_vvid_ARRAY[] = array(array('rom5_14,17,21' => 'Romans 5:14, 17, 21'), array('rom6_9-11' => 'Romans 6:9-11'), array('rom14_7-12' => 'Romans 14:7-12'));
            $tmp_link_vvid_ARRAY[] = array(array('rom6_3' => 'Romans 6:3'));
            $tmp_link_vvid_ARRAY[] = array(array('rom6_8' => 'Romans 6:8'));
            $tmp_link_vvid_ARRAY[] = array(array('rom6_18-19[000]' => 'Romans 6:18-19'));
            $tmp_link_vvid_ARRAY[] = array(array('rom6_22' => 'Romans 6:22'));
            $tmp_link_vvid_ARRAY[] = array(array('rom7_2-4,6' => 'Romans 7:2-4, 6'));
            $tmp_link_vvid_ARRAY[] = array(array('rom8_2' => 'Romans 8:2'));
            $tmp_link_vvid_ARRAY[] = array(array('rom8_2,4' => 'Romans 8:2, 4'));
            $tmp_link_vvid_ARRAY[] = array(array('rom8_14' => 'Romans 8:14'));
            $tmp_link_vvid_ARRAY[] = array(array('rom12_2' => 'Romans 12:2'), array('phil2_13' => 'Philippians 2:13'));
            $tmp_link_vvid_ARRAY[] = array(array('rom12_11' => 'Romans 12:11'));
            $tmp_link_vvid_ARRAY[] = array(array('rom13_14' => 'Romans 13:14'));
            $tmp_link_vvid_ARRAY[] = array(array('rom14_1' => 'Romans 14:1'));
            $tmp_link_vvid_ARRAY[] = array(array('1cor5_1,5' => '1 Corinthians 5:1, 5'));
            $tmp_link_vvid_ARRAY[] = array(array('1cor10_23' => '1 Corinthians 10:23'), array('1cor6_12' => '1 Corinthians 6:12'));
            $tmp_link_vvid_ARRAY[] = array(array('1cor11_4' => '1 Corinthians 11:4'));
            $tmp_link_vvid_ARRAY[] = array(array('1cor11_22' => '1 Corinthians 11:22'));
            $tmp_link_vvid_ARRAY[] = array(array('1cor15_55,58' => '1 Corinthians 15:55, 58'), array('2cor1_9-10' => '2 Corinthians 1:9-10'), array('rom6_8-11' => 'Romans 6:8-11'));
            $tmp_link_vvid_ARRAY[] = array(array('1cor15_58' => '1 Corinthians 15:58'), array('matt10_10b' => 'Matthew 10:10b'), array('john14_10' => 'John 14:10'), array('rom2_6-7' => 'Romans 2:6-7'));
            $tmp_link_vvid_ARRAY[] = array(array('2cor1_20-22' => '2 Corinthians 1:20-22'));
            $tmp_link_vvid_ARRAY[] = array(array('2cor1_20-22[000]' => '2 Corinthians 1:20-22'), array('rom10_2-3' => 'Romans 10:2-3'), array('gal1_14' => 'Galatians 1:14'));
            $tmp_link_vvid_ARRAY[] = array(array('2cor3_3' => '2 Corinthians 3:3'), array('heb8_10[000]' => 'Hebrews 8:10'), array('jer31_31-34' => 'Jeremiah 31:31-34'));
            $tmp_link_vvid_ARRAY[] = array(array('2cor3_6-9' => '2 Corinthians 3:6-9'), array('rom8_14-23' => 'Romans 8:14-23'));
            $tmp_link_vvid_ARRAY[] = array(array('2cor3_17-18' => '2 Corinthians 3:17-18'));
            $tmp_link_vvid_ARRAY[] = array(array('2cor11_2a' => '2 Corinthians 11:2a'), array('gal4_11' => 'Galatians 4:11'));
            $tmp_link_vvid_ARRAY[] = array(array('2cor11_2b-3' => '2 Corinthians 11:2b-3'), array('rev2_14' => 'Revelation 2:14'));
            $tmp_link_vvid_ARRAY[] = array(array('gal2_20' => 'Galatians 2:20'));
            $tmp_link_vvid_ARRAY[] = array(array('gal2_20_x' => 'Galatians 2:20'), array('gal6_14' => 'Galatians 6:14'));
            $tmp_link_vvid_ARRAY[] = array(array('gal3_1' => 'Galatians 3:1'), array('gal5_1,7' => 'Galatians 5:1, 7'));
            $tmp_link_vvid_ARRAY[] = array(array('gal5_1' => 'Galatians 5:1'));
            $tmp_link_vvid_ARRAY[] = array(array('gal5_16,18,22-23,25' => 'Galatians 5:16, 18, 22-23, 25'));
            $tmp_link_vvid_ARRAY[] = array(array('eph1_9' => 'Ephesians 1:9'));
            $tmp_link_vvid_ARRAY[] = array(array('eph1_3-14[000]' => 'Ephesians 1:3-14'));
            $tmp_link_vvid_ARRAY[] = array(array('eph1_3' => 'Ephesians 1:3'), array('rom5_1-5' => 'Romans 5:1-5'), array('rom8_16-17,24-25' => 'Romans 8:16-17, 24-25'), array('rom15_4' => 'Romans 15:4'), array('2cor3_12' => '2 Corinthians 3:12'), array('gal5_5-6' => 'Galatians 5:5-6'), array('eph1_9-14,18-23' => 'Ephesians 1:9-14, 18-23'), array('col1_5-6,21-23,26-27' => 'Colossians 1:5-6, 21-23, 26-27'), array('1thes1_2-3' => '1 Thessalonians 1:2-3'), array('1thes5_7-11' => '1 Thessalonians 5:7-11'), array('2thes2_16-17' => '2 Thessalonians 2:16-17'), array('1tim1_1' => '1 Tim 1:1'), array('1tim6_17' => '1 Tim 6:17'), array('titus1_1-3' => 'Titus 1:1-3'), array('titus2_11-15' => 'Titus 2:11-15'), array('titus3_7[000]' => 'Titus 3:7'), array('heb3_6[000]' => 'Hebrews 3:6'), array('heb6_17-20' => 'Hebrews 6:17-20'), array('heb7_17-19' => 'Hebrews 7:17-19'), array('heb10_21-23' => 'Hebrews 10:21-23'), array('heb11_1' => 'Hebrews 11:1'), array('1pet1_3-9,13,21' => '1 Pet 1:3-9, 13, 21'), array('1pet3_5-7,14-22' => '1 Pet. 3:5-7, 14-22'), array('1john3_1-10' => '1 John 3:1-10'));
            $tmp_link_vvid_ARRAY[] = array(array('phil1_6' => 'Philippians 1:6'));
            $tmp_link_vvid_ARRAY[] = array(array('phil1_20' => 'Philippians 1:20'));
            $tmp_link_vvid_ARRAY[] = array(array('phil1_27' => 'Philippians 1:27'));
            $tmp_link_vvid_ARRAY[] = array(array('phil2_13[001]' => 'Philippians 2:13'));
            $tmp_link_vvid_ARRAY[] = array(array('phil2_13[000]' => 'Philippians 2:13'));
            $tmp_link_vvid_ARRAY[] = array(array('phil2_3' => 'Philippians 2:3'), array('john13_34' => 'John 13:34'));
            $tmp_link_vvid_ARRAY[] = array(array('phil2_5-8' => 'Philippians 2:5-8'));
            $tmp_link_vvid_ARRAY[] = array(array('phil2_5-16[000]' => 'Philippians 2:5-16'));
            $tmp_link_vvid_ARRAY[] = array(array('phil2_5-16' => 'Philippians 2:5-16'), array('john14_15,20-21' => 'John 14:15, 20-21'));
            $tmp_link_vvid_ARRAY[] = array(array('phil2_5-9' => 'Philippians 2:5-9'), array('gal5_13,16' => 'Galatians 5:13, 16'), array('1pet2_16' => '1 Peter 2:16'), array('1john2_15-17' => '1 John 2:15-17'), array('mark7_19-23' => 'Mark 7:19-23'), array('acts10_15-16b,19-21' => 'Acts 10:15-16b, 19-21'));
            $tmp_link_vvid_ARRAY[] = array(array('phil2_8' => 'Philippians 2:8'));
            $tmp_link_vvid_ARRAY[] = array(array('col1_5' => 'Colossians 1:5'), array('col1_27' => 'Colossians 1:27'), array('1pet1_3-5' => '1 Peter 1:3-5'), array('1pet1_13' => '1 Peter 1:13'), array('titus3_7' => 'Titus 3:7'), array('heb3_6' => 'Hebrews 3:6'), array('heb10_23' => 'Hebrews 10:23'));
            $tmp_link_vvid_ARRAY[] = array(array('col2_9' => 'Colossians 2:9'));
            $tmp_link_vvid_ARRAY[] = array(array('col2_8,12,20-23' => 'Colossians 2:8, 12, 20-23'));
            $tmp_link_vvid_ARRAY[] = array(array('col3_5' => 'Colossians 3:5'));
            $tmp_link_vvid_ARRAY[] = array(array('col3_6' => 'Colossians 3:6'));
            $tmp_link_vvid_ARRAY[] = array(array('2thes2_8-12' => '2 Thessalonians 2:8-12'), array('heb3_7-19[000]' => 'Hebrews 3:7-19'), array('john8_1-11' => 'John 8:1-11'));
            $tmp_link_vvid_ARRAY[] = array(array('1tim4_1-5' => '1 Timothy 4:1-5'), array('rev2_12-17' => 'Revelation 2:12-17'), array('rev2_18-23' => 'Revelation 2:18-23'));
            $tmp_link_vvid_ARRAY[] = array(array('2tim1_6' => '2 Timothy 1:6'));
            $tmp_link_vvid_ARRAY[] = array(array('2tim1_6-8' => '2 Timothy 1:6-8'), array('rom12_11-12' => 'Romans 12:11-12'), array('luke24_31-32' => 'Luke 24:31-32'), array('prov20_27' => 'Proverbs 20:27'), array('luke12_35' => 'Luke 12:35'));
            $tmp_link_vvid_ARRAY[] = array(array('heb3_7-19' => 'Hebrews 3:7-19'));
            $tmp_link_vvid_ARRAY[] = array(array('heb4_8-16' => 'Hebrews 4:8-16'));
            $tmp_link_vvid_ARRAY[] = array(array('heb4_11' => 'Hebrews 4:11'));
            $tmp_link_vvid_ARRAY[] = array(array('heb8_10' => 'Hebrews 8:10'));
            $tmp_link_vvid_ARRAY[] = array(array('heb9_14' => 'Hebrews 9:14'));
            $tmp_link_vvid_ARRAY[] = array(array('heb10_22,19' => 'Hebrews 10:22, 19'), array('1cor6_17' => '1 Corinthians 6:17'), array('2cor3_18' => '2 Corinthians 3:18'));
            $tmp_link_vvid_ARRAY[] = array(array('heb10_22' => 'Hebrews 10:22'));
            $tmp_link_vvid_ARRAY[] = array(array('heb10_35' => 'Hebrews 10:35'));
            $tmp_link_vvid_ARRAY[] = array(array('heb10_35,38-39' => 'Hebrews 10:35, 38-39'), array('lev26_3,11b-12' => 'Leviticus 26:3, 11b-12'));
            $tmp_link_vvid_ARRAY[] = array(array('heb12_1' => 'Hebrews 12:1'));
            $tmp_link_vvid_ARRAY[] = array(array('1pet2_24' => '1 Peter 2:24'), array('isa53_6' => 'Isaiah 53:6'));
            $tmp_link_vvid_ARRAY[] = array(array('1pet5_8' => '1 Peter 5:8'));
            $tmp_link_vvid_ARRAY[] = array(array('rev2_21-22' => 'Revelation 2:21-22'));
            $tmp_link_vvid_ARRAY[] = array(array('rev3_8' => 'Revelation 3:8'));
            $tmp_link_vvid_ARRAY[] = array(array('rev2_11|2_17,26-28|3_5,12,21' => 'Revelation 2:11; 2:17,<br>26-28; 3:5, 12, 21;'), array('matt25_23,10b' => 'Matthew 25:23, 10b<br>&nbsp;&nbsp;'));
            $tmp_link_vvid_ARRAY[] = array(array('rev2_14[solo]' => 'Revelation 2:14'));
            $tmp_link_vvid_ARRAY[] = array(array('rev3_19' => 'Revelation 3:19'));
            $tmp_link_vvid_ARRAY[] = array(array('rev12_3-4,9' => 'Revelation 12:3-4, 9'), array('gen3_14' => 'Genesis 3:14'));
            $tmp_link_vvid_ARRAY[] = array(array('gen3_14[COVID]' => 'Genesis 3:14'), array('rev12_3-4,13,17;13:2,4' => 'Revelation 12:3-4, 13, 17; 13:2, 4'));
            $tmp_link_vvid_ARRAY[] = array(array('rev21_2,9-27' => 'Revelation 21:2, 9-27'));
            $tmp_link_vvid_ARRAY[] = array(array('rev21_7' => 'Revelation 21:7'), array('rev21_3-5' => 'Revelation 21:3-5'), array('rev2_10-11' => 'Revelation 2:10-11'), array('rev20_6' => 'Revelation 20:6'), array('eph1_3-14' => 'Ephesians 1:3-14'), array('john5_24-25' => 'John 5:24-25'), array('luke9_1-6' => 'Luke 9:1-6'), array('luke10_19' => 'Luke 10:19'), array('rev21_21' => 'Revelation 21:21'));
            $tmp_link_vvid_ARRAY[] = array(array('rev22_2' => 'Revelation 22:2'));

        }else{

            //
            // Thursday, February 29, 2024 @ 1632 hrs.
            //
            // HERE ARE THE SCRIPTURES (VVID) BY VERSE.
            // ------
            // HOW TO GET MORE DATA INTO SEARCH ::
            //      1. COPY ALL OF THE FOLLOWING LINES LIKE, "$tmp_link_vvid_ARRAY[] = ...."
            //         TO THE METHOD, $this->return_search_controller_static_struct().
            //      2. RUN:
            //         echo $this->generate_optimized_search_content('REFRESH_VVID');
            //      3. FINALLY, COPY THE STRING OUTPUT OF $this->generate_optimized_search_content('REFRESH_VVID')
            //         TO $this->return_search_controller_static_struct();
            //
            $tmp_link_vvid_ARRAY[] = array('jehovah_has_revealed_dl'        => 'Download Jehovah Has Revealed (Ashes). Vocals: Sister Doris K., Brother Jonathan H. African Djembe Hand Bongo: Brother Kenton W. Guitar: Brother Jonathan H.Jehovah has revealed / His heart to me. / To Him I thus would consecrated be. / As Daniel purposed in his heart...I\'ll be. / And pray; that God could move on earth through me. / Lord, You need me.');
            //$tmp_link_vvid_ARRAY[] = array('jehovah_has_revealed_audio'     => 'Audio Stream for Jehovah has revealed His heart (Ashes) :: Vocals: Sister Doris K., Brother Jonathan H. African Djembe Hand Bongo: Brother Kenton W. Guitar: Brother Jonathan H.Jehovah has revealed / His heart to me. / To Him I thus would consecrated be. / As Daniel purposed in his heart...I\'ll be. / And pray; that God could move on earth through me. / Lord, You need me.');
            $tmp_link_vvid_ARRAY[] = array('jehovah_has_revealed_chords'    => 'Jehovah has revealed His heart (Ashes) Guitar Chord Chart. Vocals: Sister Doris K., Brother Jonathan H. African Djembe Hand Bongo: Brother Kenton W. Guitar: Brother Jonathan H.Jehovah has revealed / His heart to me. / To Him I thus would consecrated be. / As Daniel purposed in his heart...I\'ll be. / And pray; that God could move on earth through me. / Lord, You need me.');
            $tmp_link_vvid_ARRAY[] = array('jehovah_has_revealed'           => 'Lyrics and chords. Jehovah has revealed His heart (Ashes) :: Vocals: Sister Doris K., Brother Jonathan H. African Djembe Hand Bongo: Brother Kenton W. Guitar: Brother Jonathan H.Jehovah has revealed / His heart to me. / To Him I thus would consecrated be. / As Daniel purposed in his heart...I\'ll be. / And pray; that God could move on earth through me. / Lord, You need me.');
            $tmp_link_vvid_ARRAY[] = array('hymn979'                        => 'HYMNS #979. How glorious, how bright it shines, / The holy, new Jerusalem; / It is God\'s dwelling place with man, / The spotless bride of Christ, the Lamb. 2. Saints of the Old and of the New, /Heirs of the promise God bestowed, / Components of the city are, / Together built for God\'s abode.');
            $tmp_link_vvid_ARRAY[] = array('gen1_1'                         => 'In the beginning God created the heavens and the earth.');
            $tmp_link_vvid_ARRAY[] = array('gen1_26'                        => 'And God said, Let Us make man in Our image, according to Our likeness; and let them have dominion over the fish of the sea and over the birds of heaven and over the cattle and over all the earth and over every creeping thing that creeps upon the earth.');
            $tmp_link_vvid_ARRAY[] = array('gen2_7'                         => 'Jehovah God formed man from the dust of the ground and breathed into his nostrils the breath of life, and man became a living soul.');
            $tmp_link_vvid_ARRAY[] = array('gen3_1'                         => 'Now the serpent was more crafty than any animal of the field that Jehovah God had made. And he said to the woman, Did God really say, You shall not eat of any tree of the garden?');
            //$tmp_link_vvid_ARRAY[] = array('gen3_14[COVID]'                 => 'And Jehovah God said to the serpent, / Because you have done this, / You are cursed more than all the cattle / And more than all the animals of the field: / Upon your stomach you will go, / And dust you will eat / All the days of your life.');
            //$tmp_link_vvid_ARRAY[] = array('gen3_14[solo]'                  => 'And Jehovah God said to the serpent, / Because you have done this, / You are cursed more than all the cattle / And more than all the animals of the field: / Upon your stomach you will go, / And dust you will eat / All the days of your life.');
            $tmp_link_vvid_ARRAY[] = array('gen3_14'                        => 'And Jehovah God said to the serpent, / Because you have done this, / You are cursed more than all the cattle / And more than all the animals of the field: / Upon your stomach you will go, / And dust you will eat / All the days of your life.');
            $tmp_link_vvid_ARRAY[] = array('gen26_4-5'                      => 'And I will multiply your seed as the stars of heaven and will give to your seed all these lands; and in your seed all the nations of the earth will be blessed, Because Abraham obeyed My voice and kept My charge, My commandments, My statutes, and My laws.');
            $tmp_link_vvid_ARRAY[] = array('gen48_21-22|49_1,25-28'         => '21 And Israel said to Joseph, Now I am about to die, but God will be with you and will bring you again to the land of your fathers. Moreover I have given to you one portion more than your brothers, which I took out of the hand of the Amorite with my sword and with my bow. And Jacob called to his sons and said, Gather yourselves together that I may tell you what will happen to you in the last days.');
            $tmp_link_vvid_ARRAY[] = array('gen49_1,25-28'                  => '1 And Jacob called to his sons and said, Gather yourselves together that I may tell you what will happen to you in the last days. 25 From the God of your father, who will help you, / And from the All-sufficient One, who will bless you / With blessings of heaven above, / Blessings of the deep that lies beneath, / Blessings of the breasts and of the womb.');
            $tmp_link_vvid_ARRAY[] = array('lifestudy_exo_156'              => 'THE RESULT OF SERVING IN THE TABERNACLE WITHOUT FIRST WASHING IN THE LAVER. When we pray to offer something to the Lord, we first need to wash our hands and even our feet in the laver. To come to the meeting to function is actually to come into the tabernacle to serve the Lord. Before we serve the Lord in the tabernacle, we need to wash.');
            $tmp_link_vvid_ARRAY[] = array('exo9_29'                        => 'And Moses said to him, As soon as I have gone out of the city, I will spread out my hands to Jehovah: The thunder will cease, and there will not be any more hail, that you may know that the earth is Jehovah\'s.');
            $tmp_link_vvid_ARRAY[] = array('exo15_26'                       => 'And He said, If you will listen carefully to the voice of Jehovah your God and do what is right in His eyes and give ear to His commandments and keep all His statutes, I will put none of the diseases on you which I have put on the Egyptians;');
            $tmp_link_vvid_ARRAY[] = array('exo20_6'                        => 'Yet showing lovingkindness to thousands of generations of those who love Me and keep My commandments.');
            $tmp_link_vvid_ARRAY[] = array('exo20_13'                       => 'You shall not kill.');
            $tmp_link_vvid_ARRAY[] = array('exo20_15'                       => 'You shall not steal.');
            $tmp_link_vvid_ARRAY[] = array('exo30_18'                       => 'You shall also make a laver of bronze, with its base of bronze, for washing. And you shall put it between the Tent of Meeting and the alter, and you shall put water in it.');
            $tmp_link_vvid_ARRAY[] = array('exo30_17-21'                    => 'And Jehovah spoke to Moses, saying, You shall also make a laver of bronze, with its base of bronze, for washing. And you shall put it between the Tent of Meeting and the alter, and you shall put water in it. And Aaron and his sons shall wash their hands and their feet from it; When they go into the Tent of Meeting, they shall wash with water, that they many not die;');
            $tmp_link_vvid_ARRAY[] = array('lev2_1'                         => 'And when anyone presents an offering of a meal offering to Jehovah, his offering shall be of fine flour; and he shall pour oil on it and put frankincense on it.');
            $tmp_link_vvid_ARRAY[] = array('lev18_1-5,24-28'                => '1 Then Jehovah spoke to Moses, saying, Speak to the children of Israel, and say to them, I am Jehovah your God. You shall not do as they do in the land of Egypt, in which you dwelt; and you shall not do as they do in the land of Canaan, where I am bringing you, nor shall you walk in their statutes.');
            $tmp_link_vvid_ARRAY[] = array('lev26_3-13'                     => 'If you walk in My statutes and keep My commandments and do them, Then I will give you your rains in their season, and the land will yield its produce, and the trees of the field will yield their fruit.');
            $tmp_link_vvid_ARRAY[] = array('lev26_3,11b-12'                 => '3 If you walk in My statutes and keep My commandments and do them, 11b My soul will not abhor you. And I will walk among you and be your God, and you will be My people.');
            $tmp_link_vvid_ARRAY[] = array('num14_31'                       => 'But your little ones, whom you said would become plunder, I will bring in, and they will know the land which you have rejected.');
            //$tmp_link_vvid_ARRAY[] = array('num14_31[000]'                  => 'But your little ones, whom you said would become plunder, I will bring in, and they will know the land which you have rejected.');
            $tmp_link_vvid_ARRAY[] = array('num14_29-30'                    => 'Your corpses shall fall in this wilderness, and none of you who were numbered, according to the number you counted from twenty years old and upward, who have murmured against Me, Shall come into the land, in which I swore to settle you, except Caleb the son of Jephunneh and Joshua the son Nun.');
            $tmp_link_vvid_ARRAY[] = array('num14_35'                       => 'I, Jehovah, have spoken; surely I will do this to all this evil assembly who are gathered together against Me. In this wilderness they shall be consumed, and there they shall die.');
            $tmp_link_vvid_ARRAY[] = array('num25_1-13'                     => 'While Israel dwelt in Shittim, the people began to commit fornication with the daughters of Moab. For they invited the people to the sacrifices of their gods, and the people ate and bowed down to their gods. And Israel joined itself to Baal-peor, and the anger of Jehovah was kindled against Israel.');
            $tmp_link_vvid_ARRAY[] = array('num32_13'                       => 'And Jehovah\'s anger was kindled against Israel, He made them wander in the wilderness forty years, until the whole generation which had done evil in the sight of Jehovah was consumed.');
            $tmp_link_vvid_ARRAY[] = array('num33_50-54'                    => 'Then Jehovah spoke to Moses in the plains of Moab by the Jordan at Jericho, saying, Speak to the children of Israel, and say to them, When you pass over the Jordan into the land of Canaan, You shall drive out all the inhabitants of the land from before you, and you shall destroy all their figured stones and destroy all their molten images and demolish all their high places;');
            $tmp_link_vvid_ARRAY[] = array('deut4_1-2,39-40'                => '1 And now, O Israel, listen to the statutes and the ordinances which I am teaching you to do, in order that you may live and go in and possess the land which Jehovah, the God of your fathers, is giving you.');
            $tmp_link_vvid_ARRAY[] = array('deut5_10,29'                    => '10 Yet showing lovingkindness to thousands of generations of those who love Me and keep My commandments. 29 Oh that this heart of theirs would be in them always to fear Me and keep all My commandments so that it may go well with them and with their children forever!');
            $tmp_link_vvid_ARRAY[] = array('deut6_1-6,16-25'                => '1 Now this is the commandment, the statutes and the ordinances, which Jehovah your God has commanded me to teach you, that you may do them in the land into which you are crossing over to possess;');
            $tmp_link_vvid_ARRAY[] = array('deut6_25'                       => 'And it will be righteousness to us if we are certain to do all this commandment before Jehovah our God, as He commanded us.');
            $tmp_link_vvid_ARRAY[] = array('deut7_9-26'                     => 'Know therefore that it is Jehovah your God who is God, the faithful God who keeps covenant and lovingkindness to the thousandth generation with those who love him and keep His commandments,');
            $tmp_link_vvid_ARRAY[] = array('deut8_1-10'                     => 'The whole commandment which I am commanding you today, you shall keep and do, so that you may live and multiply, and enter and possess the land which Jehovah swore to your fathers.');
            $tmp_link_vvid_ARRAY[] = array('deut10_14-22'                   => 'Behold, heaven and the heaven of heavens belong to Jehovah your God, the earth and all that is in it. But on your fathers Jehovah set His affection to love them and to choose their seed after them, that is, you above all the peoples, as it is this day. Circumcise then the foreskin of your heart, and do not be stiff-necked any longer;');
            $tmp_link_vvid_ARRAY[] = array('deut11_14'                      => 'I will give rain for your land in its season, the early rain and the late rain, so that you may gather your grain and your new wine and your fresh oil.');
            $tmp_link_vvid_ARRAY[] = array('deut11_1,8-15,22-28'            => '1 Therefore you shall love Jehovah your God and keep His charge and His statutes and His ordinances and His commandments always. 8 Therefore you shall keep the whole commandment which I am commanding you today so that you may be strong and that you may go in and possess the land into which you are crossing over to possess,');
            $tmp_link_vvid_ARRAY[] = array('deut26_16-19'                   => 'This day Jehovah your God is commanding you to do these statutes and ordinances; therefore you shall keep them and do them with all your heart and with all your soul. It is Jehovah whom you have today declared to be your God and that you will walk in His ways and keep His statutes and His commandments and His ordinances, and will listen to His voice.');
            $tmp_link_vvid_ARRAY[] = array('deut28_1-14'                    => 'And if you listen diligently to the voice of Jehovah your God and are certain to do all His commandments, which I am commanding you today, Jehovah your God will set you high above all the nations of the earth;');
            $tmp_link_vvid_ARRAY[] = array('deut30_11-20'                   => 'For this commandment which I am commanding you today, it is not too difficult for you, nor is it distant. It is not in heaven that you should say, Who will ascend to heaven for us and bring it to us to make us hear it and do it?');
            $tmp_link_vvid_ARRAY[] = array('deut33_1-4,12,29'               => '1 And this is the blessing with which Moses, the man of God, / blessed the children of Israel before his death. / And he said, / Jehovah came from Sinai, / And He dawned upon them from Seir; / He shined forth from Mount Paran, / And He approached from the myriads of holy ones; / From His right hand a fiery law out to them.');
            $tmp_link_vvid_ARRAY[] = array('josh5_6'                        => 'For the children of Israel went for forty years through the wilderness until all the nation, the men of war who had come out of Egypt, were consumed, because they did not listen to the voice of Jehovah, they to whom Jehovah swore that they would not see the land that Jehovah has sworn to their fathers to give us, a land flowing with milk and honey.');
            $tmp_link_vvid_ARRAY[] = array('1sam4_4'                        => 'So the people sent to Shiloh, and they took up from there the Ark of the Covenant of Jehovah of hosts who is enthroned the cherubim. And the two sons of Eli, Hophni and Phinehas, were there with the Ark of the Covenant of God.');
            $tmp_link_vvid_ARRAY[] = array('1kings2_1-3'                    => 'When David\'s time to die drew near, he commanded Solomon his son, saying, I am going the way of all the earth. Be strong therefore and be a man; And keep the charge of Jehovah your God by walking in His ways, by keeping His statutes, His commandments, and His ordinances and His testimonies as they are written in the law of Moses, that you may prosper in all that you do and wherever you turn;');
            $tmp_link_vvid_ARRAY[] = array('1kings8_54-66'                  => 'And when Solomon has finished praying all this prayer and supplication to Jehovah, he rose up from before the alter of Jehovah, from kneeling on his knees with his hands spread toward the heavens. And he stood and blessed the whole congregation of Israel with a loud voice, saying,');
            $tmp_link_vvid_ARRAY[] = array('1kings18_37-40,45;19_1-18'      => '37 Answer me, O Jehovah; answer me, that this people may know that You, O Jehovah, are God and that You have turned their heart back again. And the fire of Jehovah fell and consumed the burnt offering and the wood and the stones and the dust, and it licked up the water that was in the trench.');
            $tmp_link_vvid_ARRAY[] = array('neh1_1-11'                      => 'The words of Nehemiah the son of Hacaliah. Now in the month of Chislev, in the twentieth year, while I was in Susa the capital, Hanani, one of my brothers, came, he and some men from Judah; and I asked them about the Jews who had escaped, who were left from the captivity, and about Jerusalem.');
            $tmp_link_vvid_ARRAY[] = array('psa24'                          => 'A Psalm of David. The earth is Jehovah\'s, and its fullness, / The habitable land and those who dwell in it. / For it is He who founded it upon the seas / And established it upon the streams. Who may ascend the mountain of Jehovah, / And who may stand in His holy place? / He who has clean hands and a pure heart, / Who has not lifted up his soul to falsehood Or sworn deceitfully. / He will receive blessing from Jehovah, / And righteousness from the God of His salvation. / This is the generation of those who seek Him, / Those who seek Your face, even Jacob. Selah');
            $tmp_link_vvid_ARRAY[] = array('psa95_10-11'                    => 'For forty years I loathed that generation, / And I said, They are a people who go astray in heart; / And they do not know My ways; / Therefore I swore in My anger: / They shall by no means enter into My rest!');
            $tmp_link_vvid_ARRAY[] = array('psa97_2'                        => 'Clouds and deep darkness surround Him; Righteousness and justice are the foundation of His throne.');
            $tmp_link_vvid_ARRAY[] = array('psa119_103'                     => 'How sweet are Your words to my taste! than honey to my mouth!');
            $tmp_link_vvid_ARRAY[] = array('prov20_27'                      => 'The spirit of man is the lamp of Jehovah, Searching all the innermost parts of the inner being.');
            $tmp_link_vvid_ARRAY[] = array('isa14_13'                       => 'But you, you said in your heart: / I will ascend to heaven; / Above the stars of God / I will exalt my throne. / And I will sit upon the mount of assembly / In the uttermost parts of the north.');
            $tmp_link_vvid_ARRAY[] = array('isa14_21-24'                    => 'Prepare a slaughterhouse for his children / Because of the iniquity of their fathers, / So that they do not rise up and possess the land, / And fill the surface of the world with cities. / And I will rise up against them, / Declares Jehovah of hosts. / And I will cut off from Babylon name and remnant, / And posterity and progeny, declares Jehovah.');
            $tmp_link_vvid_ARRAY[] = array('isa16_1-5'                      => 'Send a lamb / To the ruler of the land, / From Sela across the wilderness / To the mountain of the daughter of Zion. / Like wandering birds, / a scattered nest, / Will the daughters of Moab be / At the fords of the Arnon.');
            $tmp_link_vvid_ARRAY[] = array('isa53_6'                        => 'We all like sheep have gone astray; / Each of us has turned to his own way, / And Jehovah has caused the iniquity of us all / To fall on Him.');
            $tmp_link_vvid_ARRAY[] = array('jer1_11-19'                     => 'Then the word of Jehovah came to me, saying, What do you see, Jeremiah? And I said, I see a rod of an almond tree. And Jehovah said to me, You have seen well, for I am watching over My word to perform it. Then the word of Jehovah came to me a second time, saying, What do you see? And I said, I see a boiling pot, and it is facing away from the north.');
            $tmp_link_vvid_ARRAY[] = array('jer24_7'                        => 'And I will give them a heart to know Me, that I am Jehovah; and they will be My people, and I will be their God; for they will return to Me with their whole heart.');
            $tmp_link_vvid_ARRAY[] = array('jer31_31-34'                    => 'Indeed, days are coming, declares Jehovah, when I will make a new covenant with the house of Israel and with the house of Judah, Not like the covenant which I made with their fathers in the day I took them by their hand to bring them out from the land of Egypt, My covenant which they broke, although I was their Husband, declares Jehovah.');
            $tmp_link_vvid_ARRAY[] = array('jer31_33-34'                    => 'But this is the covenant which I will make with the house of Israel after those days, declares Jehovah: I will put My law in their inward parts and write it upon their hearts; and I will be their God, and they will be My people.');
            $tmp_link_vvid_ARRAY[] = array('jer31_33-37'                    => 'But this is the covenant which I will make with the house of Israel after those days, declares Jehovah: I will put My law in their inward parts and write it upon their hearts; and I will be their God, and they will be My people. And they will no longer teach, each man his neighbor and each man his brother, saying, Know Jehovah; for all of them will know Me, from the little one among them even to the great one among them, declares Jehovah, for I will forgive their iniquity, and their sin I will remember no more.');
            $tmp_link_vvid_ARRAY[] = array('jer31_31-37'                    => 'Indeed days are coming, declares Jehovah, when I will make a new covenant with the house of Israel and with the house of Judah, Not like the covenant which I made with their fathers in the day I took them by their hand to bring them out from the land of Egypt, My covenant which they broke, although I was their Husband, declares Jehovah.');
            $tmp_link_vvid_ARRAY[] = array('ezek11_17-25'                   => 'Therefore say, Thus says the Lord Jehovah, I will gather you from the peoples and assemble you from the countries among which you have been scattered, and I will give you the land of Israel. And they will come there and take away all its detestable things and all its abominations from it.');
            $tmp_link_vvid_ARRAY[] = array('dan9_4'                         => 'And I prayed to Jehovah my God and confessed; and I said, Ah, Lord, the great and awesome God, who keeps covenant and lovingkindness with those who love Him and keep His commandments,');
            $tmp_link_vvid_ARRAY[] = array('dan9_17-27'                     => 'And now hear, O our God, the prayer of Your servant and his supplications, and cause Your face to shine upon Your sanctuary that has been desolated, for the Lord\'s sake. O my God, incline Your ear and hear; open Your eyes and see our desolations and the city that is called by Your name; for we are not presenting our supplications before You based upon any righteous doings that we have done, but based upon Your great compassion.');
            $tmp_link_vvid_ARRAY[] = array('joel2_23'                       => 'O children of Zion, / Be glad and rejoice / In Jehovah your God. / For He gives you / The early rain in righteousness, / And He makes the rain come down for you: / The early rain and the late rain / At the beginning of the season.');
            $tmp_link_vvid_ARRAY[] = array('matt1_18,20'                    => '18 Now the origin of Jesus Christ was in this way: His mother, Mary, after she had been engaged to Joseph, before they came together, was found to be with child of the Holy Spirit. 20 But while he pondered these things, behold, an angel of the Lord appeared to him in a dream, saying, Joseph, son of David, do not be afraid to take Mary your wife, for that which has been begotten in her is of the Holy Spirit.');
            $tmp_link_vvid_ARRAY[] = array('matt2_4-6'                      => 'And gathering together all the chief priests and scribes of the people, he inquired of them where the Christ was to be born. And they said to him, In Bethlehem of Judea, for so it is written through the prophet: &quot;And you, Bethlehem, land of Judah, by no means are you the least among the princes of Judah; for out of you shall come forth a Ruler, One who will shepherd My people Israel.&quot;');
            $tmp_link_vvid_ARRAY[] = array('matt3_15'                       => 'But Jesus answered and said to him, Permit it for now, for it is fitting for us in this way to fulfill all righteousness. Then he permitted Him.');
            $tmp_link_vvid_ARRAY[] = array('matt4_1-2'                      => 'Then Jesus was led up into the wilderness by the Spirit to be tempted by the devil. And when He had fasted forty days and forty nights, afterward He became hungry.');
            $tmp_link_vvid_ARRAY[] = array('matt4_3'                        => 'And the tempter came and said to Him, If You are the Son of God, speak that these stones may become loaves of bread.');
            $tmp_link_vvid_ARRAY[] = array('matt4_4b'                       => 'Man shall not live on bread alone, but on every word that proceeds out through the mouth of God.');
            $tmp_link_vvid_ARRAY[] = array('matt4_5-7'                      => 'Then the devil took Him into the holy city and set Him on the wing of the temple, And said to Him, If You are the Son of God, cast Yourself down; for it is written, &quot;To His angels He shall give charge concerning You, and on hands they shall bear You up, lest You strike Your foot against a stone.&quot; Jesus said to him, Again, it is written, &quot;You shall not test the Lord your God.&quot;');
            $tmp_link_vvid_ARRAY[] = array('matt5_10'                       => 'Blessed are those who are persecuted for the sake of righteousness, for theirs is the kingdom of the heavens.');
            $tmp_link_vvid_ARRAY[] = array('matt5_13'                       => 'You are the salt of the earth. But if the salt has become tasteless, with what shall it be salted? It is no longer good for anything except to be cast out and trampled underfoot by men.');
            $tmp_link_vvid_ARRAY[] = array('matt5'                          => 'And when He saw the crowds, He went up to the mountain. And after He sat down, His disciples came to Him. And opening His mouth, He taught them, saying, Blessed are the poor in spirit, for theirs is the kingdom of the heavens. Blessed are those who mourn, for they shall be comforted. Blessed are the meek, for they shall inherit the earth. Blessed are those who hunger and thirst for righteousness, for they shall be satisfied.');
            $tmp_link_vvid_ARRAY[] = array('matt6'                          => 'But take care not to do your righteousness before men in order to be gazed at by them; otherwise, you have no reward with your Father who is in the heavens. Therefore when you give alms, do not sound a trumpet before you as the hypocrites do in the synagogues and in the streets, so that they may be glorified by men. Truly I say to you, They have their reward in full.');
            $tmp_link_vvid_ARRAY[] = array('matt7'                          => 'Do not judge, that you be not judged. For with what judgement you judge, you shall be judged; and with what measure you measure, it shall be measured to you. And why do you look at the splinter which is in your brothers\'s eye, but the beam in your eye you do not consider? Or how can you say to your brother, Let me remove the splinter from your eye, and behold, the beam is in your eye?');
            $tmp_link_vvid_ARRAY[] = array('matt7_13-14'                    => 'Enter in through the narrow gate, for wide is the gate and broad is the way that leads to destruction, and many are those who enter through it. Because narrow is the gate and constricted is the way that leads to life, and few are those who find it.');
            $tmp_link_vvid_ARRAY[] = array('matt10_10b'                     => 'For the worker is worthy of his food.');
            $tmp_link_vvid_ARRAY[] = array('matt10_16-33'                   => 'Behold, I send you forth as sheep in the midst of wolves. Be therefore prudent as serpents and guileless as doves. And beware of men, for they will deliver you up to sanhedrins, and in their synagogues they will scourge you.');
            $tmp_link_vvid_ARRAY[] = array('matt11_28-30'                   => 'Come to Me all who toil and are burdened, and I will give you rest. Take My yoke upon you and learn from Me, for I am meek and lowly in heart, and you will find rest for your souls. For My yoke is easy and My burden is light.');
            $tmp_link_vvid_ARRAY[] = array('matt12_1-8'                     => 'At that time Jesus went on the Sabbath through the grainfields. And His disciples became hungry and began to pick ears of grain and eat. But the Pharisees, seeing, said to Him, Behold, Your disciples are doing what is not lawful to do on the Sabbath. But He said to them, Have you not read what David did when he became hungry, and those who were with him; How he entered into the house of God, and they ate the bread of the Presence, which was not lawful for him to eat, nor for those who were with him, except for the priests only?');
            $tmp_link_vvid_ARRAY[] = array('matt12_5'                       => 'Or have you not read in the law that on the Sabbath the priests in the temple profane the Sabbath and are guiltless?');
            $tmp_link_vvid_ARRAY[] = array('matt13_4'                       => 'And as he sowed, some fell beside the way, and the birds came and devoured them.');
            $tmp_link_vvid_ARRAY[] = array('matt16_25-26'                   => 'For whoever wants to save his soul-life shall lose it; but whoever loses his soul-life for My sake shall it. For what shall a man be profited if he gains the whole world, but forfeits his soul-life? Or what shall a man give in exchange for his soul-life?');
            $tmp_link_vvid_ARRAY[] = array('matt19_12'                      => 'For there are eunuchs who were born so from their mother\'s womb, and there are eunuchs who were made eunuchs by men, and there are eunuchs who made themselves eunuchs because of the kingdom of the heavens. He who can, let him accept.');
            $tmp_link_vvid_ARRAY[] = array('matt24_8-14'                    => 'All these things are the beginning of birth pangs. Then they will deliver you up to tribulation and will kill you, and you will be hated by all the nations because of My name. And at that time many will be stumbled and will deliver up one another and will hate one another. And many false prophets will arise and will lead many astray. And because lawlessness will be multiplied, the love of the many will grow cold.');
            $tmp_link_vvid_ARRAY[] = array('matt24_14'                      => 'And this gospel of the kingdom will be preached in the whole inhabited earth for a testimony to all the nations, and then the end will come.');
            $tmp_link_vvid_ARRAY[] = array('matt24_15-22'                   => 'Therefore when you see the abomination of desolation, which was spoken of through Daniel the prophet, standing in the Holy Place (let him who reads understand), Then let those in Judea flee to the mountains; Let him who is on the housetop not come down to take the things out of his house; And let him who is in the field not turn back to take his garment.');
            $tmp_link_vvid_ARRAY[] = array('matt25_4'                       => 'But the prudent took oil in their vessels with their lamps.');
            $tmp_link_vvid_ARRAY[] = array('matt25_23,10b'                  => '23 His master said to him, Well, good and faithful slave. You were faithful over a few things; I will set you over many things. Enter into the joy of your master. 10b And those who were ready went in with him to the wedding feast. And the door was shut.');
            $tmp_link_vvid_ARRAY[] = array('matt26_33-35,69-75'             => '33 Then Peter answered and said to Him, If all will be stumbled because of You, I will never be stumbled. Jesus said to him, Truly I say to you that in this night, before a rooster crows, you will deny Me three times.');
            $tmp_link_vvid_ARRAY[] = array('matt27_46'                      => 'And about the ninth hour Jesus cried out with a loud voice, saying, Eli, Eli, lama sabachthani? that is, My God, My God, why have You forsaken Me?');
            $tmp_link_vvid_ARRAY[] = array('mark7_19-23'                    => 'Because it does not enter into his heart, but into the stomach, and goes out into the drain? (He made all foods clean.) And He said, That which goes out of the man, that defiles the man. For from within, out of the heart of men, proceed evil reasonings, fornications, thefts, murders, adulteries, covetousness, wickedness, deceit, licentiousness, envy, blasphemy, arrogance, foolishness. All these wicked things proceed from within and defile the man.');
            $tmp_link_vvid_ARRAY[] = array('mark9_50'                       => 'Salt is good, but if the salt becomes unsalty, with what will you restore its saltiness? Have salt in yourselves and be at peace with one another.');
            $tmp_link_vvid_ARRAY[] = array('mark14_27-31,66-72'             => '27 And Jesus said to them, You will all be stumbled, because it is written, &quot;I will smite the Shepherd, and the sheep will be scattered.&quot; But after I have been raised, I will go before you into Galilee.');
            $tmp_link_vvid_ARRAY[] = array('luke1_26-33'                    => 'And in the sixth month the angel Gabriel was sent from God to a city of Galilee named Nazareth, To a virgin engaged to a man named Joseph, of the house of David; and the virgin\'s name was Mary. And he came to her and said, Rejoice, you who have been graced! The Lord is with you.');
            $tmp_link_vvid_ARRAY[] = array('luke9_1-6'                      => 'And He called together the twelve and gave them power and authority over all the demons and to heal diseases. And He sent them to proclaim the kingdom of God and to heal the sick. And He said to them, Take nothing for the journey, neither a staff nor a bag nor bread nor money, nor have two tunics apiece. And into whatever house you enter, remain there and from there go out. And as many as do not receive you, as you go out from that city, shake off the dust from your feet for a testimony against them.');
            $tmp_link_vvid_ARRAY[] = array('luke9_5-6'                      => 'And as many as do not receive you, as you go out from that city, shake off the dust from your feet for a testimony against them. And they went out and passed through village after village, announcing the gospel and healing everywhere.');
            $tmp_link_vvid_ARRAY[] = array('luke10_19'                      => 'Behold, I have given you the authority to tread upon serpents and scorpions and over all the power of the enemy, and nothing shall by any means hurt you.');
            $tmp_link_vvid_ARRAY[] = array('luke12_35'                      => 'Let your loins be girded and your lamps burning,');
            $tmp_link_vvid_ARRAY[] = array('luke12_34-44'                   => 'For where your treasure is, there also your heart will be. Let your loins be girded and your lamps burning, And you be like men waiting for their own master when he returns from the wedding feast, so that when he comes and knocks they may  open to him immediately. Blessed are those slaves whom the master, when he comes, will find watching. Truly I tell you that he will gird himself and will have them recline, and he will come to and serve them.');
            $tmp_link_vvid_ARRAY[] = array('luke13_17'                      => 'And when He said these things, all those opposing Him were put to shame, and all the crowd rejoiced over all the glorious things that were being done by Him.');
            $tmp_link_vvid_ARRAY[] = array('luke14_31-32'                   => 'Or what king, going to engage another king in war, will not first sit down and deliberate whether he is able with ten thousand to meet the one coming against him with twenty thousand? Otherwise, while he is yet at a distance, he sends an envoy and asks for the of peace.');
            $tmp_link_vvid_ARRAY[] = array('luke14_34-35'                   => 'Therefore salt is good; but if even the salt becomes tasteless, with what will its saltiness be restored? It is fit neither for the land nor for the manure pile; they will throw it out. He who has ears to hear, let him hear.');
            $tmp_link_vvid_ARRAY[] = array('luke18_11-12'                   => 'The Pharisee stood and prayed these things to himself: God, I thank You that I am not like the rest of men&ndash;&ndash;extortioners, unjust, adulterers, or even like this tax collector. I fast twice a week; I give a tenth of all that I get.');
            $tmp_link_vvid_ARRAY[] = array('luke18_13'                      => 'But the tax collector, standing at a distance, would not even lift up his eyes to heaven, but beat his breast, saying, God, be propitiated to me, the sinner!');
            $tmp_link_vvid_ARRAY[] = array('luke19_12,14,15,27'             => '12 He said therefore, A certain man of noble birth went to a distant country to receive for himself a kingdom and to return. 14 But his citizens hated him and sent an envoy after him, saying, We do not want this man to reign over us.');
            $tmp_link_vvid_ARRAY[] = array('luke22_24-30'                   => 'And a contention also occurred among them as to which of them seemed to be greatest. And He said to them, The kings of the Gentiles lord it over them, and those who have authority over them are called benefactors.');
            $tmp_link_vvid_ARRAY[] = array('luke22_33-34,54-62'             => '33 And he said to Him, Lord, I am ready to go with You both to prison and to death. But He said, I tell you, Peter, a rooster will not crow today until you deny three times that you know Me.');
            $tmp_link_vvid_ARRAY[] = array('luke22_42'                      => 'Saying, Father, if You are willing, remove this cup from Me; yet, not My will, but Yours be done.');
            //$tmp_link_vvid_ARRAY[] = array('luke22_42[solo]'                => 'Saying, Father, if You are willing, remove this cup from Me; yet, not My will, but Yours be done.');
            $tmp_link_vvid_ARRAY[] = array('luke23_27-30'                   => 'And a great multitude of the people and of women who were mourning and lamenting Him followed Him. But Jesus turned to them and said, Daughters of Jerusalem, do not weep over Me, but weep over yourselves and over your children. For behold, the days are coming in which they will say, Blessed are the barren, and the wombs which have not borne, and the breasts which have not nourished.');
            $tmp_link_vvid_ARRAY[] = array('luke23_38,42-43'                => '38 And there was also an inscription over Him : THIS IS THE KING OF THE JEWS. 42 And he said, Jesus, remember me when You come into Your kingdom. And He said to him, Truly I say to you, Today you shall be with Me in Paradise.');
            $tmp_link_vvid_ARRAY[] = array('luke24_31-32'                   => 'And their eyes were opened, and they recognized Him; and He disappeared from them. And they said to one another, Was not our heart burning within us while He was speaking to us on the road, while He was opening to us the Scriptures?');
            $tmp_link_vvid_ARRAY[] = array('john2_20-21'                    => 'Then the Jews said, This temple was built in forty-six years, and You will raise it up in three days? But He spoke of the temple of His body.');
            $tmp_link_vvid_ARRAY[] = array('john2_21'                       => 'But He spoke of the temple of His body.');
            $tmp_link_vvid_ARRAY[] = array('john5_24-25'                    => 'Truly, truly, I say to you, He who hears My word and believes Him who sent Me has eternal life, and does not come into judgement but has passed out of death into life. Truly, truly, I say to you, An hour is coming, and it is now, when the dead will hear the voice of the Son of God, and those who hear will live.');
            $tmp_link_vvid_ARRAY[] = array('john8_1-11'                     => 'But Jesus went to the Mount of Olives. And early in the morning He came again into the temple, and all the people came to Him, and He sat down and taught them. And the scribes and Pharisees brought a woman caught in adultery, and having set her in the midst,');
            $tmp_link_vvid_ARRAY[] = array('john8_6'                        => 'But they said this to tempt Him, so that they might have to accuse Him. But Jesus stooped down and wrote with His finger on the ground.');
            $tmp_link_vvid_ARRAY[] = array('john8_51-59'                    => 'Truly, truly, I say to you, If anyone keeps My word, he shall by no means see death forever. The Jews therefore said to Him, Now we know that You have a demon. Abraham died, and the prophets; yet You say, If anyone keeps My word, he shall by no means taste death forever. Are You greater than our father Abraham, who died? The prophets died too. Who are You making Yourself?');
            $tmp_link_vvid_ARRAY[] = array('john9_41'                       => 'Jesus said to them, If you were blind, you would not have sin; but now you say, We see; your sin remains.');
            $tmp_link_vvid_ARRAY[] = array('john13_3-17'                    => 'Knowing that the Father had given all into His hands and that He had come forth from God and was going to God, Rose from supper and laid aside His outer garments; and taking a towel, He girded Himself');
            $tmp_link_vvid_ARRAY[] = array('john13_34'                      => 'A new commandment I give to you, that you love one another, even as I have loved you, that you also love one another.');
            //$tmp_link_vvid_ARRAY[] = array('john13_34[solo]'                => 'A new commandment I give to you, that you love one another, even as I have loved you, that you also love one another.');
            $tmp_link_vvid_ARRAY[] = array('john13_37-38'                   => 'Peter said to Him, Lord, why can\'t I follow You now? I will lay down my life for You. Jesus answered, Will you lay down your life for Me? Truly, truly, I say to you, A rooster shall by no means crow until you deny Me three times.');
            $tmp_link_vvid_ARRAY[] = array('john13_37-38;18_14-27'          => '13:37 Peter said to Him, Lord, why can\'t I follow You now? I will lay down my life for You. Jesus answered, Will you lay down your life for Me? Truly, truly, I say to you, A rooster shall by no means crow until you deny Me three times.');
            $tmp_link_vvid_ARRAY[] = array('john14_10'                      => 'Do you not believe that I am in the Father and the Father is in Me? The words that I say to you I do not speak from Myself, but the Father who abides in Me does His works.');
            $tmp_link_vvid_ARRAY[] = array('john14_10-14'                   => 'Do you not believe that I am in the Father and the Father is in Me? The words that I say to you I do not speak from Myself, but the Father who abides in Me does His works. Believe Me that I am in the Father and the Father is in Me; but if not, believe because of the works themselves.');
            $tmp_link_vvid_ARRAY[] = array('john14_12-14'                   => 'Truly, truly, I say to you, He who believes into Me, the works which I do he shall do also; and greater than these he shall do because I am going to the Father. And whatever you ask in My name, that I will do, that the Father may be glorified in the Son. If you ask Me anything in My name, I will do.');
            $tmp_link_vvid_ARRAY[] = array('john14_15,20-21'                => '15 If you love Me, you will keep My commandments. 20 In that day you will know that I am in My Father, and you in Me, and I in you. He who has My commandments and keeps them, he is the one who loves Me; and he who loves Me will be loved by My Father, and I will love him and will manifest Myself to him.');
            $tmp_link_vvid_ARRAY[] = array('john16_15'                      => 'All that the Father has is Mine; for this I have said that He receives of Mine and will declare to you.');
            $tmp_link_vvid_ARRAY[] = array('acts1_5'                        => 'For John baptized with water, but you shall be baptized in the Holy Spirit not many days from now.');
            $tmp_link_vvid_ARRAY[] = array('acts2_22-25'                    => 'Men of Israel, hear these words: Jesus the Nazarene, a man shown by God to you to be approved by works of power and wonders and signs, which God did through Him in your midst, even as you yourselves know&ndash;&ndash; This man, delivered up by the determined counsel and foreknowledge of God, you, through the hand of lawless men, nailed to and killed;');
            $tmp_link_vvid_ARRAY[] = array('acts8_29'                       => 'And the Spirit said to Philip, Approach and join this chariot.');
            $tmp_link_vvid_ARRAY[] = array('acts10_15-16b,19-21'            => '15 And a voice to him again a second time: The things that God has cleansed, do not make common. And this occurred three times. 19 And while Peter was pondering over the vision, the Spirit said to him, Behold, three men seeking you. But rise up, go down and go with them, doubting nothing, because I have sent them.');
            $tmp_link_vvid_ARRAY[] = array('acts16_6,7'                     => '6 And they passed through the region of Phrygia and Galatia, having been forbidden by the Holy Spirit to speak the word in Asia. 7 And when they had come to Mysia, they tried to go into Bithynia, yet the Spirit of Jesus did not allow them.');
            $tmp_link_vvid_ARRAY[] = array('acts11_12'                      => 'And the Spirit told me to go with them, doubting nothing. And these six brothers went with me also; and we entered into the man\'s house.');
            $tmp_link_vvid_ARRAY[] = array('acts11_18'                      => 'And when they heard these things, they became silent and glorified God, saying, Then to the Gentiles also God has given repentance unto life.');
            $tmp_link_vvid_ARRAY[] = array('rom2_6-7'                       => 'Who will render to each according to his works: To those who by endurance in good work seek glory and honor and incorruptibility, life eternal;');
            //$tmp_link_vvid_ARRAY[] = array('rom5_1-5[000]'                  => 'Therefore having been justified out of faith, we have peace toward God through our Lord Jesus Christ, Through whom also we have obtained access by faith into this grace in which we stand and boast because if the hope of the glory of God.');
            $tmp_link_vvid_ARRAY[] = array('rom5_1-5'                       => 'Therefore having been justified out of faith, we have peace toward God through our Lord Jesus Christ, Through whom also we have obtained access by faith into this grace in which we stand and boast because if the hope of the glory of God.');
            $tmp_link_vvid_ARRAY[] = array('rom5_10'                        => 'For if we, being enemies, were reconciled to God through the death of His Son, much more we will be saved in His life, having been reconciled.');
            $tmp_link_vvid_ARRAY[] = array('rom5_14,17,21'                  => '14 But death reigned from Adam until Moses, even over those who had not sinned after the likeness of Adam\'s transgression, who is a type of Him who was to come. 17 For if, by the offense of the one, death reigned through the one, much more those who receive the abundance of grace and of the gift of righteousness will reign in life through the One, Jesus Christ.');
            $tmp_link_vvid_ARRAY[] = array('rom6_3'                         => 'Or are you ignorant that all of us who have been baptized into Christ Jesus have been baptized into His death?');
            $tmp_link_vvid_ARRAY[] = array('rom6_8'                         => 'Now if we have died with Christ, we believe that we will also live with Him.');
            $tmp_link_vvid_ARRAY[] = array('rom6_8-11'                      => 'Now if we have died with Christ, we believe that we will also live with Him, Knowing that Christ, having been raised from the dead, dies no more; death lords it over Him no more. For which He died, He died to sin once for all; but which He lives, He lives to God. So also you, reckon yourselves to be dead to sin, but living to God in Christ Jesus.');
            $tmp_link_vvid_ARRAY[] = array('rom6_9-11'                      => 'Knowing that Christ, having been raised from the dead, dies no more; death lords it over Him no more. For which He died, He died to sin once for all; but which He lives, He lives to God. So also you, reckon yourselves to be dead to sin, but living to God in Christ Jesus.');
            //$tmp_link_vvid_ARRAY[] = array('rom6_18-19[000]'                => 'And having been freed from sin, you were enslaved to righteousness. I speak in human because of the weakness of your flesh. For just as you presented your members as slaves to uncleanness and lawlessness unto lawlessness, so now present your members as slaves to righteousness unto sanctification.');
            $tmp_link_vvid_ARRAY[] = array('rom6_18-19'                     => 'And having been freed from sin, you were enslaved to righteousness. I speak in human because of the weakness of your flesh. For just as you presented your members as slaves to uncleanness and lawlessness unto lawlessness, so now present your members as slaves to righteousness unto sanctification.');
            $tmp_link_vvid_ARRAY[] = array('rom6_22'                        => 'But now, having been freed from sin and enslaved to God, you have your fruit unto sanctification, and the end, eternal life.');
            $tmp_link_vvid_ARRAY[] = array('rom7_2-4,6'                     => '2 For the married woman is bound by the law to her husband while he is living; but if the husband dies, she is discharged from the law regarding the husband. So then if, while the husband is living, she is joined to another man, she will be called an adulteress; but if the husband dies, she is free from the law, so that she is not an adulteress, though she is joined to another man.');
            $tmp_link_vvid_ARRAY[] = array('rom8_2'                         => 'For the law of the Spirit of life has freed me in Christ Jesus from the law of sin and of death.');
            $tmp_link_vvid_ARRAY[] = array('rom8_2,4'                       => '2 For the law of the Spirit of life has freed me in Christ Jesus from the law of sin and of death. 4 That the righteous requirement of the law might be fulfilled in us, who do not walk according to the flesh but according to the spirit.');
            $tmp_link_vvid_ARRAY[] = array('rom8_14'                        => 'For as many as are led by the Spirit of God, these are sons of God.');
            $tmp_link_vvid_ARRAY[] = array('rom8_16-17,24-25'               => '16 The Spirit Himself witnesses with our spirit that we are children of God. And if children, heirs also; on the one hand, heirs of God; on the other, joint heirs with Christ, if indeed we suffer with that we may also be glorified with.');
            $tmp_link_vvid_ARRAY[] = array('rom8_14-23'                     => 'For as many as are led by the Spirit of God, these are sons of God. For you have not received a spirit of slavery into fear again, but you have received a spirit of sonship in which we cry, Abba, Father! The Spirit Himself witnesses with our spirit that we are children of God.');
            $tmp_link_vvid_ARRAY[] = array('rom8_33-39'                     => 'Who shall bring a charge against God\'s chosen ones? It is God who justifies. Who is he who condemns? It is Christ Jesus who died and, rather, who was raised, who is also at the right hand of God, who also intercedes for us. Who shall separate us from the love of Christ? Shall tribulation or anguish or persecution or famine or nakedness or peril or sword?');
            $tmp_link_vvid_ARRAY[] = array('rom9_31-33'                     => 'But Israel, pursuing a law of righteousness, did not attain to law. Why? Because not out of faith, but as it were out of works. They stumbled at the stone of stumbling, As it is written, &quot;Behold, I lay in Zion a stone of stumbling, a rock of offense, and he who believes on Him shall not be put to shame.&quot;');
            $tmp_link_vvid_ARRAY[] = array('rom10_2-3'                      => 'For I bear them witness that they have a zeal for God, but not according to full knowledge; For because they were ignorant of God\'s righteousness and sought to establish their own righteousness, they were not subject to the righteousness of God.');
            $tmp_link_vvid_ARRAY[] = array('rom12_2'                        => 'And do not be fashioned according to this age, but be transformed by the renewing of the mind that you may prove what the will of God is, that which is good and well pleasing and perfect.');
            $tmp_link_vvid_ARRAY[] = array('rom12_11'                       => 'Do not be slothful in zeal, be burning in spirit, serving the Lord.');
            $tmp_link_vvid_ARRAY[] = array('rom12_11-12'                    => 'Do not be slothful in zeal, be burning in spirit, serving the Lord. Rejoice in hope; endure in tribulation; persevere in prayer.');
            $tmp_link_vvid_ARRAY[] = array('rom13_14'                       => 'But put on the Lord Jesus Christ, and make no provision for the flesh to its lusts.');
            $tmp_link_vvid_ARRAY[] = array('rom14_1'                        => 'Now him who is weak in faith receive, not for the purpose of passing judgement on considerations.');
            $tmp_link_vvid_ARRAY[] = array('rom14_7-12'                     => 'For none of us lives to himself, and none dies to himself; For whether we live, we live to the Lord, and whether we die, we die to the Lord. Therefore whether we live or we die, we are the Lord\'s. For Christ died and lived for this, that He might be Lord both of the dead and of the living.');
            //$tmp_link_vvid_ARRAY[] = array('rom15_4[000]'                   => 'For the things that were written previously were written for our instruction, in order that through endurance and through the encouragement of the Scriptures we might have hope.');
            $tmp_link_vvid_ARRAY[] = array('rom15_4'                        => 'For the things that were written previously were written for our instruction, in order that through endurance and through the encouragement of the Scriptures we might have hope.');
            $tmp_link_vvid_ARRAY[] = array('1cor1_22-25'                    => 'For indeed Jews require signs and Greeks seek wisdom, But we preach Christ crucified, to Jews a stumbling block, and to Gentiles foolishness, But to those who are called, both Jews and Greeks, Christ the power of God and the wisdom of God. Because the foolishness of God is wiser than men, and the weakness of God is stronger than men.');
            $tmp_link_vvid_ARRAY[] = array('1cor3_21-23'                    => 'So then let no one boast in men, for all things are yours, Whether Paul or Apollos or Cephas or the world or life or death or things present or things to come; all are yours, But you are Christ\'s, and Christ is God\'s.');
            $tmp_link_vvid_ARRAY[] = array('1cor5_1,5'                      => '1 It is actually reported that there is fornication among you, and such fornication that not even among the Gentiles, that someone has his stepmother. 5 To deliver such a one to Satan for the destruction of his flesh, that his spirit may be saved in the day of the Lord.');
            $tmp_link_vvid_ARRAY[] = array('1cor6_12'                       => 'All things are lawful to me, but not all things are profitable; all things are lawful to me, but I will not be brought under the power of anything.');
            $tmp_link_vvid_ARRAY[] = array('1cor6_17'                       => 'But he who is joined to the Lord is one spirit.');
            $tmp_link_vvid_ARRAY[] = array('1cor9_8-11,13'                  => '8 Am I speaking these things according to man? Or does the law not also say these things? For in the law of Moses it is written: &quot;You shall not muzzle the ox while it is treading out the grain.&quot; Is it for oxen that God cares? Or does He say <em>it</em> altogether for our sake?');
            $tmp_link_vvid_ARRAY[] = array('1cor10_5'                       => 'But with most of them God was not well pleased, for they were strewn along in the wilderness.');
            $tmp_link_vvid_ARRAY[] = array('1cor10_23'                      => 'All things are lawful, but not all things are profitable; all things are lawful, but not all things build up.');
            $tmp_link_vvid_ARRAY[] = array('1cor10_26,29b-31'               => '26 For the earth is the Lord\'s and the fullness thereof. 29b For why is my freedom judged by other conscience? If I partake with thankfulness, why am I spoken evil of concerning that for which I give thanks? Therefore whether you eat or drink, or whatever you do, do all to the glory of God.');
            $tmp_link_vvid_ARRAY[] = array('1cor11_4'                       => 'Every man praying or prophesying with his head covered disgraces his head.');
            $tmp_link_vvid_ARRAY[] = array('1cor15_58'                      => 'Therefore, my beloved brothers, be steadfast, immovable, always abounding in the work of Lord, knowing that your labor is not in vain in the Lord.');
            $tmp_link_vvid_ARRAY[] = array('1cor15_55,58'                   => '55 Where, O death, is your victory? Where, O death, is your sting? 58 Therefore, my beloved brothers, be steadfast, immovable, always abounding in the work of the Lord, knowing that your labor is not in vain in the Lord.');
            $tmp_link_vvid_ARRAY[] = array('2cor1_9-10'                     => 'Indeed we ourselves had the response of death in ourselves, that we should not base our confidence on ourselves but on God, who raises the dead; Who has delivered us out of so great a death, and will deliver; in whom we have hoped that He will also yet deliver,');
            $tmp_link_vvid_ARRAY[] = array('2cor1_20-22[000]'               => 'For as many promises of God as, in Him is the Yes; therefore also through Him is the Amen to God, for glory through us. But the One who firmly attaches us with you unto Christ and has anointed us is God, He who has also sealed us and given the Spirit in our hearts as a pledge.');
            $tmp_link_vvid_ARRAY[] = array('2cor1_20-22'                    => 'For as many promises of God as, in Him is the Yes; therefore also through Him is the Amen to God, for glory through us. But the One who firmly attaches us with you unto Christ and has anointed us is God, He who has also sealed us and given the Spirit in our hearts as a pledge.');
            $tmp_link_vvid_ARRAY[] = array('2cor3_6-9'                      => 'Who has also made us sufficient as ministers of a new covenant, not of the letter but of the Spirit; for the letter kills, but the Spirit gives life. Moreover if the ministry of death, engraved in stone in letters, came about in glory, so that the sons of Israel were not able to gaze at the face of Moses because of the glory of his face, which was being done away with, How shall the ministry of the Spirit not be more in glory? For if there is glory with the ministry of condemnation, much more the ministry of righteousness abounds with glory.');
            $tmp_link_vvid_ARRAY[] = array('2cor3_12'                       => 'Therefore since we have such hope, we use much boldness,');
            $tmp_link_vvid_ARRAY[] = array('2cor3_12,17'                    => '12 Therefore since we have such hope, we use much boldness, 17 And the Lord is the Spirit; and where the Spirit of the Lord is, there is freedom.');
            $tmp_link_vvid_ARRAY[] = array('2cor11_2a'                      => 'For I am jealous over you with a jealousy of God.');
            $tmp_link_vvid_ARRAY[] = array('2cor11_2b-3'                    => 'For I betrothed you to one husband to present a pure virgin to Christ. But I fear lest somehow, as the serpent deceived Eve by his craftiness, your thoughts would be corrupted from the simplicity and the purity toward Christ.');
            $tmp_link_vvid_ARRAY[] = array('1cor11_22'                      => 'Do you not have houses to eat and drink in? Or do you despise the church of God and put those to shame who have not? What shall I say to you? Shall I praise you? In this I do not praise.');
            $tmp_link_vvid_ARRAY[] = array('2cor3_3'                        => 'Since you are being manifested that you are a letter of Christ ministered by us, inscribed not with ink but with the Spirit of the living God; not in tablets of stone but in tablets of hearts of flesh.');
            $tmp_link_vvid_ARRAY[] = array('2cor3_17-18'                    => 'And the Lord is the Spirit; and where the Spirit of the Lord is, there is freedom. But we all with unveiled face, beholding and reflecting like a mirror the glory of the Lord, are being transformed into the same image from glory to glory, even as from the Lord Spirit.');
            $tmp_link_vvid_ARRAY[] = array('2cor3_18'                       => 'But we all with unveiled face, beholding and reflecting like a mirror the glory of the Lord, are being transformed into the same image from glory to glory, even as from the Lord Spirit.');
            $tmp_link_vvid_ARRAY[] = array('gal1_14'                        => 'And I advanced in Judaism beyond many contemporaries in my race, being more abundantly a zealot for the traditions of my fathers.');
            $tmp_link_vvid_ARRAY[] = array('gal2_20'                        => 'I am crucified with Christ; and no longer I live, but Christ lives in me; and the which I now live in the flesh I live in faith, the of the Son of God, who loved me and gave Himself up for me.');
            //$tmp_link_vvid_ARRAY[] = array('gal2_20_x'                      => 'I am crucified with Christ; and no longer I live, but Christ lives in me; and the which I now live in the flesh I live in faith, the of the Son of God, who loved me and gave Himself up for me.');
            $tmp_link_vvid_ARRAY[] = array('gal3_1'                         => 'O foolish Galatians, who has bewitched you, before whose eyes Jesus Christ was openly portrayed crucified?');
            $tmp_link_vvid_ARRAY[] = array('gal5_1,7'                       => '1 For freedom Christ has set us free; stand fast therefore, and do not be entangled with a yoke of slavery again. 7 You were running well. Who hindered you that you would not believe and obey the truth?');
            $tmp_link_vvid_ARRAY[] = array('gal5_1'                         => 'For freedom Christ has set us free; stand fast therefore, and do not be entangled with a yoke of slavery again.');
            $tmp_link_vvid_ARRAY[] = array('gal5_5-6'                       => 'For we by the Spirit out of faith eagerly await the hope of righteousness.');
            $tmp_link_vvid_ARRAY[] = array('gal4_11'                        => 'I fear for you, lest I have labored upon you in vain.');
            $tmp_link_vvid_ARRAY[] = array('gal5_13,16'                     => '13 For you were called for freedom, brothers; only do not this freedom into an opportunity for the flesh, but through love serve one another. 16 But I say, Walk by the Spirit and you shall by no means fulfill the lust of the flesh.');
            $tmp_link_vvid_ARRAY[] = array('gal5_16,18,22-23,25'            => '16 But I say, Walk by the Spirit and you shall by no means fulfill the lust of the flesh. 18 But if you are led by the Spirit, you are not under the law. 22 But the fruit of the Spirit is love, joy, peace, long-suffering, kindness, goodness, faithful, Meekness, self-control; against such things there is no law.');
            $tmp_link_vvid_ARRAY[] = array('gal6_14'                        => 'But far be it from me to boast except in the cross of our Lord Jesus Christ, through whom the world has been crucified to me and I to the world.');
            $tmp_link_vvid_ARRAY[] = array('eph1_3'                         => 'Blessed be the God and Father of our Lord Jesus Christ, who has blessed us with every spiritual blessing in the heavenlies in Christ,');
            $tmp_link_vvid_ARRAY[] = array('eph1_3-12'                      => 'Blessed be the God and Father of our Lord Jesus Christ, who has blessed us with every spiritual blessing in the heavenlies in Christ, Even as He chose us in Him before the foundation of the world to be holy and without blemish before Him in love, Predestinating us unto sonship through Jesus Christ to Himself, according to the good pleasure of His will,');
            //$tmp_link_vvid_ARRAY[] = array('eph1_3-14[000]'                 => 'Blessed be the God and Father of our Lord Jesus Christ, who has blessed us with every spiritual blessing in the heavenlies in Christ, Even as He chose us in Him before the foundation of the world to be holy and without blemish before Him in love, Predestinating us unto sonship through Jesus Christ to Himself, according to the good pleasure of His will,');
            $tmp_link_vvid_ARRAY[] = array('eph1_3-14'                      => 'Blessed be the God and Father of our Lord Jesus Christ, who has blessed us with every spiritual blessing in the heavenlies in Christ, Even as He chose us in Him before the foundation of the world to be holy and without blemish before Him in love, Predestinating us unto sonship through Jesus Christ to Himself, according to the good pleasure of His will,');
            $tmp_link_vvid_ARRAY[] = array('eph1_9'                         => 'Making known to us the mystery of His will according to His good pleasure, which He purposed in Himself,');
            $tmp_link_vvid_ARRAY[] = array('eph1_9-14,18-23'                => '9 Making known to us the mystery of His will according to His good pleasure, which He purposed in Himself, Unto the economy of the fullness of the times, to head up all things in Christ, the things in the heavens and the things on the earth, in Him;');
            $tmp_link_vvid_ARRAY[] = array('phil1_6'                        => 'Being confident of this very thing, that He who has begun in you a good work will complete it until the day of Christ Jesus.');
            $tmp_link_vvid_ARRAY[] = array('phil1_20'                       => 'According to my earnest expectation and hope that in nothing I will be put to shame, but with all boldness, as always, even now Christ will be magnified in my body, whether through life or through death.');
            $tmp_link_vvid_ARRAY[] = array('phil1_27'                       => 'Only, conduct yourselves in a manner worthy of the gospel of Christ, that whether coming and seeing you or being absent, I may hear of the things concerning you, that you stand firm in one spirit, with one soul striving together with the faith of the gospel.');
            $tmp_link_vvid_ARRAY[] = array('phil2_3'                        => 'Nothing by way of selfish ambition nor by way of vainglory, but in lowliness of mind considering one another more excellent than yourselves.');
            $tmp_link_vvid_ARRAY[] = array('phil2_5-8'                      => 'Let this mind be in you, which was also in Christ Jesus, Who, existing in the form of God, did not consider being equal with God a treasure to be grasped, But emptied Himself, taking the form of a slave, becoming in the likeness of men; And being found in fashion as a man, He humbled Himself, becoming obedient even unto death, and the death of a cross.');
            //$tmp_link_vvid_ARRAY[] = array('phil2_5-16[000]'                => 'Let this mind be in you, which was also in Christ Jesus, Who, existing in the form of God, did not consider being equal with God a treasure to be grasped, But emptied Himself, taking the form of a slave, becoming in the likeness of men; And being found in fashion as a man, He humbled Himself, becoming obedient even unto death, and the death of a cross.');
            $tmp_link_vvid_ARRAY[] = array('phil2_5-16'                     => 'Let this mind be in you, which was also in Christ Jesus, Who, existing in the form of God, did not consider being equal with God a treasure to be grasped, But emptied Himself, taking the form of a slave, becoming in the likeness of men; And being found in fashion as a man, He humbled Himself, becoming obedient even unto death, and the death of a cross.');
            $tmp_link_vvid_ARRAY[] = array('phil2_5-9'                      => 'Let this mind be in you, which was also in Christ Jesus, Who, existing in the form of God, did not consider being equal with God a treasure to be grasped, But emptied Himself, taking the form of a slave, becoming in the likeness of men; And being found in fashion as a man, He humbled Himself, becoming obedient even unto death, and the death of a cross.');
            $tmp_link_vvid_ARRAY[] = array('phil2_8'                        => 'And being found in fashion as a man, He humbled Himself, becoming obedient even unto death, and the death of a cross.');
            //$tmp_link_vvid_ARRAY[] = array('phil2_13[001]'                  => 'For it is God who operates in you both the willing and the working for good pleasure.');
            //$tmp_link_vvid_ARRAY[] = array('phil2_13[000]'                  => 'For it is God who operates in you both the willing and the working for good pleasure.');
            $tmp_link_vvid_ARRAY[] = array('phil2_13'                       => 'For it is God who operates in you both the willing and the working for good pleasure.');
            $tmp_link_vvid_ARRAY[] = array('col1_5'                         => 'Because of the hope laid up for you in the heavens, of which you heard before in the word of the truth of the gospel,');
            $tmp_link_vvid_ARRAY[] = array('col1_27'                        => 'To whom God willed to make known what are the riches of the glory of this mystery among the Gentiles, which is Christ in you, the hope of glory,');
            $tmp_link_vvid_ARRAY[] = array('col1_5-6,21-23,26-27'           => '5 Because of the hope laid up for you in the heavens, of which you heard before in the word of the truth of the gospel, Which has come to you, even as it is also in all the world, bearing fruit and growing, as also in you, since the day you heard and knew the grace of God in truth;');
            $tmp_link_vvid_ARRAY[] = array('col1_16'                        => 'Because in Him all things were created, in the heavens and on the earth, the visible and the invisible, whether thrones or lordships or rulers or authorities; all things have been created through Him and unto Him.');
            $tmp_link_vvid_ARRAY[] = array('col2_9'                         => 'For in Him dwells all the fullness of the Godhead bodily.');
            $tmp_link_vvid_ARRAY[] = array('col2_8,12,20-23'                => '8 Beware that no one carries you off as spoil through his philosophy and empty deceit, according to the tradition of men, according to the elements of the world, and not according to Christ;');
            $tmp_link_vvid_ARRAY[] = array('col3_5'                         => 'Put to death therefore your members which are on the earth: fornication, uncleanness, passion, evil desire, and greediness, which is idolatry.');
            $tmp_link_vvid_ARRAY[] = array('col3_6'                         => 'Because of which things the wrath of God is coming upon the sons of disobedience;');
            $tmp_link_vvid_ARRAY[] = array('1thes1_2-3'                     => 'We thank God always concerning all of you, making mention in our prayers, Remembering unceasingly your work of faith and labor of love and endurance of hope in our Lord Jesus Christ, before our God and Father;');
            $tmp_link_vvid_ARRAY[] = array('1thes5_7-11'                    => 'For those who sleep, sleep during the night, and those who get drunk are drunk during the night; But since we are of the day, let us be sober, putting on the breastplate of faith and love and a helmet, the hope of salvation.');
            $tmp_link_vvid_ARRAY[] = array('2thes2_8-12'                    => 'And then the lawless one will be revealed (whom the Lord Jesus will slay by the breath of His mouth and bring to nothing by the manifestation of His coming), The coming of whom is according to Satan\'s operation in all power and signs and wonders of a lie And in all deceit of unrighteousness among those who are perishing, because they did not receive the love of the truth that they might be saved.');
            $tmp_link_vvid_ARRAY[] = array('2thes2_16-17'                   => 'Now our Lord Jesus Christ Himself and God our Father, who has loved us and given us eternal comfort and good hope in grace, Comfort your hearts and establish in every good work and word.');
            $tmp_link_vvid_ARRAY[] = array('1tim1_1'                        => 'Paul, an apostle of Christ Jesus according to the command of God our Savior and of Christ Jesus our hope,');
            $tmp_link_vvid_ARRAY[] = array('1tim4_1-5'                      => 'But the Spirit says expressly that in later times some will depart from the faith, giving heed to deceiving spirits and teachings of demons By means of the hypocrisy of men who speak lies, of men who are branded in their own conscience as with a hot iron,');
            $tmp_link_vvid_ARRAY[] = array('1tim6_17'                       => 'Charge those who are rich in the present age not to be high-minded, nor to set their hope on the uncertainty of riches but on God, who affords us all things richly for enjoyment;');
            $tmp_link_vvid_ARRAY[] = array('2tim1_6'                        => 'For which cause I remind you to fan into flame the gift of God, which is in you through the laying on of my hands.');
            $tmp_link_vvid_ARRAY[] = array('2tim1_6-8'                      => 'For which cause I remind you to fan into flame the gift of God, which is in you through the laying on of my hands. For God has not given us a spirit of cowardice, but of power and of love and of sobermindedness. Therefore do not be ashamed of the testimony of our Lord nor of me His prisoner; but suffer evil with the gospel according to the power of God;');
            $tmp_link_vvid_ARRAY[] = array('titus1_1-3'                     => 'Paul, a slave of God and an apostle of Jesus Christ according to the faith of God\'s chosen ones and the full knowledge of the truth, which is according to godliness, In the hope of eternal life, which God, who cannot lie, promised before the times of the ages.');
            $tmp_link_vvid_ARRAY[] = array('titus2_11-15'                   => 'For the grace of God, bringing salvation to all men, has appeared, Training us that, denying ungodliness and worldly lusts, we should live soberly and righteously and godly in the present age,');
            //$tmp_link_vvid_ARRAY[] = array('titus3_7[000]'                  => 'In order that having been justified by His grace, we might become heirs according to the hope of eternal life.');
            $tmp_link_vvid_ARRAY[] = array('titus3_7'                       => 'In order that having been justified by His grace, we might become heirs according to the hope of eternal life.');
            $tmp_link_vvid_ARRAY[] = array('heb2_14-15'                     => 'Since therefore the children have shared in blood and flesh, He also Himself in like manner partook of the same, that through death He might destroy him who has the might of death, that is, the devil, And might release those who because of the fear of death through all their life were held in slavery.');
            $tmp_link_vvid_ARRAY[] = array('heb3_6[000]'                    => 'But Christ as a Son over His house, whose house we are if indeed we hold fast the boldness and the boast of hope firm to the end.');
            $tmp_link_vvid_ARRAY[] = array('heb3_6'                         => 'But Christ as a Son over His house, whose house we are if indeed we hold fast the boldness and the boast of hope firm to the end.');
            //$tmp_link_vvid_ARRAY[] = array('heb3_7-19[000]'                 => 'Therefore, even as the Holy Spirit says, &quot;Today if you hear His voice, Do not harden your hearts as in the provocation, in the day of trial in the wilderness, Where your fathers tried by testing and saw My works for forty years. Therefore I was displeased with this generation, and I said, They always go astray in their heart, and they have not known My ways;');
            $tmp_link_vvid_ARRAY[] = array('heb3_7-19'                      => 'Therefore, even as the Holy Spirit says, &quot;Today if you hear His voice, Do not harden your hearts as in the provocation, in the day of trial in the wilderness, Where your fathers tried by testing and saw My works for forty years. Therefore I was displeased with this generation, and I said, They always go astray in their heart, and they have not known My ways;');
            $tmp_link_vvid_ARRAY[] = array('heb4_8-16'                      => 'For if Joshua had brought them into rest, He would not have spoken concerning another day after these things. So then there remains a Sabbath rest for the people of God. For he who has entered into His rest has himself also rested from his works, as God did from His own. Let us therefore be diligent to enter into that rest lest anyone fall after the same example of disobedience.');
            $tmp_link_vvid_ARRAY[] = array('heb4_11'                        => 'Let us therefore be diligent to enter into that rest lest anyone fall after the same example of disobedience.');
            $tmp_link_vvid_ARRAY[] = array('heb6_17-20'                     => 'Therefore God, intending to show more abundantly to the heirs of the promise the unchangeableness of His counsel, interposed with an oath, In order that by two unchangeable things, in which it was impossible for God to lie we may have strong encouragement, we who have fled for refuge to lay hold of the hope set before,');
            $tmp_link_vvid_ARRAY[] = array('heb7_17-19'                     => 'For it is testified, &quot;You are a Priest forever according to the order of Melchizedek.&quot; For there is, on the one hand, the setting aside of the preceding commandment because of its weakness and unprofitableness (For the law perfected nothing), and, on the other hand, the bringing in thereupon of a better hope, through which we draw near to God.');
            //$tmp_link_vvid_ARRAY[] = array('heb8_10[000]'                   => 'For this is the covenant which I will covenant with the house of Israel after those days, says the Lord: I will impart My laws into their mind, and on their hearts I will inscribe them; and I will be God to them, and they will be a people to Me.');
            $tmp_link_vvid_ARRAY[] = array('heb8_10'                        => 'For this is the covenant which I will covenant with the house of Israel after those days, says the Lord: I will impart My laws into their mind, and on their hearts I will inscribe them; and I will be God to them, and they will be a people to Me.');
            $tmp_link_vvid_ARRAY[] = array('heb9_14'                        => 'How much more will the blood Christ, who through the eternal Spirit offered Himself without blemish to God, purify our conscience from dead works to serve the living God?');
            $tmp_link_vvid_ARRAY[] = array('heb10_22,19'                    => '22 Let us come forward to with a true heart in full assurance of faith, having our hearts sprinkled from an evil conscience and having our bodies washed with pure water. 19 Having therefore, brothers, boldness for entering the Holies in the blood of Jesus.');
            $tmp_link_vvid_ARRAY[] = array('heb10_22'                       => 'Let us come forward to with a true heart in full assurance of faith, having our hearts sprinkled from an evil conscience and having our bodies washed with pure water.');
            $tmp_link_vvid_ARRAY[] = array('heb10_21-23'                    => 'And a great Priest over the house of God, Let us come forward to with a true heart in full assurance of faith, having our hearts sprinkled from an evil conscience and having our bodies washed with pure water.');
            $tmp_link_vvid_ARRAY[] = array('heb10_23'                       => 'Let us hold fast the confession of our hope unwavering, for He who has promised is faithful;');
            $tmp_link_vvid_ARRAY[] = array('heb10_35'                       => 'Do not cast away therefore your boldness, which has great reward.');
            $tmp_link_vvid_ARRAY[] = array('heb10_35,38-39'                 => '35 Do not cast away therefore your boldness, which has great reward. 38 &quot;...But My righteous one shall live by faith; and if he shrinks back, My soul does not delight in him.&quot; But we are not of those who shrink back to ruin but of those who have faith to the gaining of the soul.');
            $tmp_link_vvid_ARRAY[] = array('heb11_1'                        => 'Now faith is the substantiation of things hoped for, the conviction of things not seen.');
            $tmp_link_vvid_ARRAY[] = array('heb12_1'                        => 'Therefore let us also, having so great a cloud of witnesses surrounding us, put away every encumbrance and the sin which so easily entangles and run with endurance the race which is set before us,');
            $tmp_link_vvid_ARRAY[] = array('james3_1-2'                     => 'Do not become many teachers, my brothers, knowing that we will receive greater judgement. For in many things we all stumble. If anyone does not stumble in word, this one is a perfect man, able to bridle the whole body as well.');
            $tmp_link_vvid_ARRAY[] = array('1pet1_3-9,13,21'                => '3 Blessed be the God and Father of our Lord Jesus Christ, who according to His great mercy has regenerated us unto a living hope through the resurrection of Jesus Christ from the dead, Unto an inheritance, incorruptible and undefiled and unfading, kept in the heavens for you,');
            $tmp_link_vvid_ARRAY[] = array('1pet1_3-5'                      => 'Blessed be the God and Father of our Lord Jesus Christ, who according to His great mercy has regenerated us unto a living hope through the resurrection of Jesus Christ from the dead, Unto an inheritance, incorruptible and undefiled and unfading, kept in the heavens for you,');
            $tmp_link_vvid_ARRAY[] = array('1pet1_13'                       => 'Therefore girding up the loins of your mind being sober, set your hope perfectly on the grace being brought to you at the revelation of Jesus Christ.');
            $tmp_link_vvid_ARRAY[] = array('1pet2_16'                       => 'As free, and yet not having freedom as a covering for evil, but as slaves of God.');
            $tmp_link_vvid_ARRAY[] = array('1pet2_20'                       => 'For what glory is it if, while sinning and being buffeted, you endure? But if, while doing good and suffering, you endure, this is grace with God.');
            $tmp_link_vvid_ARRAY[] = array('1pet2_7-8'                      => 'To you therefore who believe is the preciousness; but to the unbelieving, &quot;The stone which the builders rejected, this has become the head of the corner,&quot; And, &quot;A stone of stumbling and a rock of offense&quot;; who stumble at the word, being disobedient, to which also they were appointed.');
            $tmp_link_vvid_ARRAY[] = array('1pet2_24'                       => 'Who Himself bore up our sins in His body on the tree, in order that we, having died to sins, might live to righteousness; by whose bruise you were healed.');
            $tmp_link_vvid_ARRAY[] = array('1pet3_15'                       => 'But sanctify Christ as Lord in your hearts, being always ready for a defense to everyone who asks of you an account concerning the hope which is in you,');
            $tmp_link_vvid_ARRAY[] = array('1pet3_5-7,14-22'                => '5 For in this manner formerly the holy women also, who hoped in God, adorned themselves, being subject to their own husbands, As Sarah obeyed Abraham, calling him lord; whose children you have become, if you do good and do not fear any terror.');
            $tmp_link_vvid_ARRAY[] = array('1pet5_8'                        => 'Be sober; watch. Your adversary, the devil, as a roaring lion, walks about, seeking someone to devour.');
            $tmp_link_vvid_ARRAY[] = array('1john2_15-17'                   => 'Do not love the world nor the things in the world. If anyone loves the world, love for the Father is not in him; Because all that is in the world, the lust of the flesh and the lust of the eyes and the vainglory of life, is not of the Father but is of the world. And the world is passing away, and its lust, but he who does the will of God abides forever.');
            $tmp_link_vvid_ARRAY[] = array('1john3_1-10'                    => 'Behold what manner of love the Father has given to us, that we should be called children of God; and we are. Because of this the world does not know us, because it did not know Him.');
            $tmp_link_vvid_ARRAY[] = array('rev2_10-11'                     => 'Do not fear the things that you are about to suffer. Behold, the devil is about to cast some of you into prison that you may be tried, and you will have tribulation for ten days. Be faithful unto death, and I will give you the crown of life. He who has an ear, let him hear what the Spirit says to the churches. He who overcomes shall by no means be hurt of the second death.');
            $tmp_link_vvid_ARRAY[] = array('rev2_12-17'                     => 'And to the messenger of the church in Pergamos write: These things says He who has the sharp two-edged sword: I know where you dwell, where Satan\'s throne is; and you hold fast My name and have not denied My faith, even in the days of Antipas, My witness, My faithful one, who was killed among you, where Satan dwells.');
            $tmp_link_vvid_ARRAY[] = array('rev2_18-23'                     => 'And to the messenger of the church in Thyatira write: These things says the Son of God, He who has eyes like a flame of fire, and His feet are like shining bronze: I know your works and love and faith and service and your endurance and that your last works are more than the first. But I have against you, that you tolerate the woman Jezebel,');
            //$tmp_link_vvid_ARRAY[] = array('rev2_14[solo]'                => 'But I have a few things against you, that you have some there who hold the teaching of Balaam, who taught Balak to put a stumbling block before the sons of Israel, to eat idol sacrifices and to commit fornication.');
            $tmp_link_vvid_ARRAY[] = array('rev2_14'                        => 'But I have a few things against you, that you have some there who hold the teaching of Balaam, who taught Balak to put a stumbling block before the sons of Israel, to eat idol sacrifices and to commit fornication.');
            $tmp_link_vvid_ARRAY[] = array('rev2_11|2_17,26-28|3_5,12,21'   => '11 He who has an ear, let him hear what the Spirit says to the churches. He who overcomes shall by no means be hurt of the second death. 17 He who has an ear, let him hear what the Spirit says to the churches. To him who overcomes, to him I will give of the hidden manna, and to him I will give a white stone, and upon the stone a new name written, which no one knows except him who receives.');
            $tmp_link_vvid_ARRAY[] = array('rev2_21-22'                     => 'And I gave her time that she might repent, and she is not willing to repent of her fornication. Behold, I cast her into a bed, and those who commit adultery with her, into great tribulation, unless they repent of her works;');
            $tmp_link_vvid_ARRAY[] = array('rev3_8'                         => 'I know your works; behold, I have put before you an opened door which no one can shut, because you have a little power and have kept My word and have not denied My name.');
            $tmp_link_vvid_ARRAY[] = array('rev3_7-13'                      => 'And to the messenger of the church in Philadelphia write: These things says the Holy One, the true One, the One who has the key of David, the One who opens and no one will shut, and shuts and no one opens:');
            $tmp_link_vvid_ARRAY[] = array('rev3_19'                        => 'As many as I love I reprove and discipline; be zealous therefore and repent.');
            $tmp_link_vvid_ARRAY[] = array('rev6_16-17'                     => 'And they say to the mountains and to the rocks, Fall on us and hide us from the face of Him who sits upon the throne and from the wrath of the Lamb; For the great day of Their wrath has come, and who is able to stand?');
            $tmp_link_vvid_ARRAY[] = array('rev12_3-4,9'                    => '3 And another sign was seen in heaven; and behold, a great red dragon, having seven heads and ten horns, and on his heads seven diadems. And his tail drags away the third part of the stars of heaven, and he cast them to the earth. And the dragon stood before the woman who was about to bring forth, so that when she brings forth he might devour her child.');
            $tmp_link_vvid_ARRAY[] = array('rev12_3-4,13,17;13:2,4'         => '3 And another sign was seen in heaven; and behold, a great red dragon, having seven heads and ten horns, and on his heads seven diadems. And his tail drags away the third part of the stars of heaven, and he cast them to the earth. And the dragon stood before the woman who was about to bring forth, so that when she brings forth he might devour her child.');
            $tmp_link_vvid_ARRAY[] = array('rev20_6'                        => 'Blessed and holy is he who has part in the first resurrection; over these the second death has no authority, but they will be priests of God and of Christ and will reign with Him for a thousand years.');
            $tmp_link_vvid_ARRAY[] = array('rev21_2,9-27'                   => '2 And I saw the holy city, New Jerusalem, coming down out of heaven from God, prepared as a bride adorned for her husband. 9 And one of the seven angels who had the seven bowls full of the seven last plagues came and spoke with me, saying, Come here; I will show you the bride, the wife of the Lamb. And he carried me away in spirit onto a great and high mountain and showed me the holy city, Jerusalem, coming down out of heaven from God, Having the glory of God.');
            $tmp_link_vvid_ARRAY[] = array('rev21_7'                        => 'He who overcomes will inherit these things, and I will be God to him, and he will be a son to Me.');
            $tmp_link_vvid_ARRAY[] = array('rev21_3-5'                      => 'And I heard a loud voice out of the throne, saying, Behold, the tabernacle of God is with men, and He will tabernacle with them, and they will be His peoples, and God Himself will be with them their God. And He will wipe away every tear from their eyes; and death will be no more, nor will there be sorrow or crying or pain anymore; for the former things have passed away. And He who sits on the throne said, Behold, I make all things new. And He said, Write, for these words are faithful and true.');
            $tmp_link_vvid_ARRAY[] = array('rev21_21'                       => 'And the twelve gates were twelve pearls; each one of the gates was, respectively, of one pearl. And the street of the city was pure gold, like transparent glass.');
            $tmp_link_vvid_ARRAY[] = array('rev22_2'                        => 'And on this side and on that side of the river was the tree of life, producing twelve fruits, yielding its fruit each month; and the leaves of the tree of life are for the healing of the nations.');
            //
            // Friday, March 1, 2024 @ 0304 hrs.    // $tmp_link_vvid_ARRAY ARRAY BUILD; THE FIRST PASS HAS BEEN FINISHED.
            //
            // THE TARGET FORMAT FOR HTML OUTPUT:
            // Philippians 1:27 - Only, conduct yourselves in a manner worthy of the gospe...

        }

        if(self::$vvid_is_grouped !== false){

            //
            // HTML OUTPUT SCRIPTURE INDEX BY GROUP.
            foreach($tmp_link_vvid_ARRAY as $index_grp => $vvid_grp_CHUNKARRAY0){

                $tmp_grp_html_str = '';
                $tmp_grp_html_str_open = '<div class="cb_10"></div><p>(';
                $tmp_grp_html_str_delim = ', ';
                $tmp_grp_html_str_close = ')</p>';

                foreach($vvid_grp_CHUNKARRAY0 as $index_vv => $vvid_grp_CHUNKARRAY1){

                    foreach($vvid_grp_CHUNKARRAY1 as $vvid => $vvid_reference_copy){

                        $tmp_grp_html_str .= $this->link_html($vvid, $vvid_reference_copy);
                        $tmp_grp_html_str .= $tmp_grp_html_str_delim;

                    }

                }

                //
                // REMOVE TRAILING COMMA.
                $tmp_grp_html_str = $this->strrtrim($tmp_grp_html_str,', ');

                //
                // AGGREGATE REPORTING ON BYTES RETURNED.
                $this->count_processed_bytes($tmp_grp_html_str_open . $tmp_grp_html_str . $tmp_grp_html_str_close);

                echo $tmp_grp_html_str_open . $tmp_grp_html_str . $tmp_grp_html_str_close;

            }

        }else{

            //
            // HTML OUTPUT AN INDEX OF ALL SCRIPTURES.
            foreach($tmp_link_vvid_ARRAY as $index_vv => $vvid_vv_CHUNKARRAY0){

                $tmp_vv_html_str = '';
                $tmp_vv_html_str_open = '<div class="cb_10"></div><p>';
                $tmp_vv_html_str_close = '</p>';

                foreach($vvid_vv_CHUNKARRAY0 as $tmp_vvid => $vvid_social_share_preview_copy){

                    $this->vvid = $tmp_vvid;
                    $tmp_vvid_vnav_reference_ARRAY = $this->return_vnav_preciousness();

                    foreach($tmp_vvid_vnav_reference_ARRAY['VVID'] as $index => $vnav_reference_copy){

                        //
                        // BECAUSE THE bringer_of_the_precious_things DATA STRUCTURE
                        // BOTH 1) DRIVES THE HTML UI AND 2) ONLY HONORS SCRIPTURES
                        // BY THEIR "UI GROUPING", WE MUST LOOP THROUGH THE VERSE
                        // CLUSTER (THIS WILL BE A ONE VERSE LOOP[?] SOMETIMES) AND
                        // THEN LOAD THE MATCHING VVID,...JUST.
                        //
                        // Friday, March 1, 2024 @ 0441 hrs.
                        if($this->vvid == $vnav_reference_copy){

                            switch($this->vvid){
                                case 'jehovah_has_revealed_dl':

                                    $tmp_vvid_vnav_reference_ARRAY['COPY'][$index] = 'Jehovah Has Revealed His Heart :: DOWNLOAD';

                                break;
                                case 'jehovah_has_revealed_chords':

                                    $tmp_vvid_vnav_reference_ARRAY['COPY'][$index] = 'Jehovah Has Revealed His Heart :: CHORDS';

                                break;

                            }

                            //
                            // SOURCE :: https://stackoverflow.com/questions/4915753/how-can-i-remove-three-characters-at-the-end-of-a-string-in-php
                            // AUTHOR :: bensiu :: https://stackoverflow.com/users/367878/bensiu
                            // COMMENT :: https://stackoverflow.com/a/4915787
                            $vvid_social_share_preview_copy = trim(substr($vvid_social_share_preview_copy, 0, strlen($vvid_social_share_preview_copy) - 3));

                            $tmp_vvid_copy = $tmp_vvid_vnav_reference_ARRAY['COPY'][$index] . ' &ndash; ' . $vvid_social_share_preview_copy . '...';

                            $tmp_vv_html_str .= $this->link_html($this->vvid, $tmp_vvid_copy);

                        }

                    }

                }

                //
                // AGGREGATE REPORTING ON BYTES RETURNED.
                $this->count_processed_bytes($tmp_vv_html_str_open . $tmp_vv_html_str . $tmp_vv_html_str_close);

                echo $tmp_vv_html_str_open . $tmp_vv_html_str . $tmp_vv_html_str_close;

            }

        }

    }

    public function link_html($vvid, $link_text, $mode = 'embedded', $height = 246){

        if($mode === 'popup'){

            $tmp_str = '<a vvid="' . $vvid . '" class="script_lnk" href="#" target="_blank" onclick="scripture_return(this, \'popup\', ' . $height . ');">' . $link_text . '</a>' . $this->seo_out($vvid);

            return $tmp_str;

        }

        switch($vvid){
            case 'jehovah_has_revealed_dl':

                $tmp_str = '<a vvid="' . $vvid . '" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">' . $link_text . '</a>';

            break;
            default:

                $tmp_str = '<a vvid="' . $vvid . '" class="script_lnk" href="#" target="_self" onclick="scripture_return(this); return false;">' . $link_text . '</a>' . $this->seo_out($vvid);

            break;

        }

        return $tmp_str;

    }

    public function return_to_me_the_precious(){

        $tmp_preciousness = array();
        $tmp_preciousness[0] = $this->return_vnav_preciousness();
        $tmp_preciousness[1] = $this->return_book_preciousness();
        $tmp_preciousness[2] = $this->return_verse_preciousness();
        $tmp_preciousness[3] = $this->return_footnote_preciousness();

        return $tmp_preciousness;

    }

    private function return_vnav_preciousness(){

        //
        // THE VERSE NAV ARRAY STRUCTURE IS AS FOLLOWS.
        // ['VVID'][n+1] = REFERENCE
        // ['COPY'][n+1] = COPY

        $tmp_vnav_array = array();

        switch($this->vvid){
            case 'jehovah_has_revealed':
            case 'jehovah_has_revealed_chords':
            case 'jehovah_has_revealed_audio':
            case 'jehovah_has_revealed_dl':

                $tmp_vnav_array['VVID'][0] = 'jehovah_has_revealed';
                $tmp_vnav_array['COPY'][0] = 'Jehovah Has Revealed His Heart';
                $tmp_vnav_array['VVID'][1] = 'jehovah_has_revealed_chords';
                $tmp_vnav_array['COPY'][1] = 'Chords';
                $tmp_vnav_array['VVID'][2] = 'jehovah_has_revealed_audio';

                if($this->vvid == 'jehovah_has_revealed_audio'){

                    $tmp_vnav_array['COPY'][2] = 'Listen&nbsp;&nbsp;<img src="https://jony5.com/common/imgs/listen_icon_wht.png" width="20" height="18" alt="Listen">';

                }else{

                    $tmp_vnav_array['COPY'][2] = 'Listen&nbsp;&nbsp;<img src="https://jony5.com/common/imgs/listen_icon.png" width="20" height="18" alt="Listen">';

                }

                $tmp_vnav_array['VVID'][3] = 'jehovah_has_revealed_dl';

                if($this->vvid == 'jehovah_has_revealed_dl'){

                    $tmp_vnav_array['COPY'][3] = '<span style="padding:0 8px 0 8px;"><img src="https://jony5.com/common/imgs/download_icon_wht.png" width="20" height="20" alt="Download"></span>';

                }else{

                    $tmp_vnav_array['COPY'][3] = '<span style="padding:0 8px 0 8px;"><img src="https://jony5.com/common/imgs/download_icon.png" width="20" height="20" alt="Download"></span>';

                }

            break;
            case 'hymn979':

                $tmp_vnav_array['VVID'][0] = 'hymn979';
                $tmp_vnav_array['COPY'][0] = 'HYMNS #979';

            break;
            case 'gen1_1':
            case 'gen2_7':
            case 'col1_16':

                $tmp_vnav_array['VVID'][0] = 'gen1_1';
                $tmp_vnav_array['COPY'][0] = 'Genesis 1:1';
                $tmp_vnav_array['VVID'][1] = 'gen2_7';
                $tmp_vnav_array['COPY'][1] = 'Genesis 2:7';
                $tmp_vnav_array['VVID'][2] = 'col1_16';
                $tmp_vnav_array['COPY'][2] = 'Colossians 1:16';

            break;
            case 'gen1_26':

                $tmp_vnav_array['VVID'][0] = 'gen1_26';
                $tmp_vnav_array['COPY'][0] = 'Genesis 1:26';

            break;
            case 'gen3_1':

                $tmp_vnav_array['VVID'][0] = 'gen3_1';
                $tmp_vnav_array['COPY'][0] = 'Genesis 3:1';

            break;
            case 'gen3_14[solo]':

                $tmp_vnav_array['VVID'][0] = 'gen3_14[solo]';
                $tmp_vnav_array['COPY'][0] = 'Genesis 3:14';

            break;
            case 'gen48_21-22|49_1,25-28':

                $tmp_vnav_array['VVID'][0] = 'gen48_21-22|49_1,25-28';
                $tmp_vnav_array['COPY'][0] = 'Genesis 48:21-22; 49:1, 25-28';

            break;
            case 'deut33_1-4,12,29':
            case 'gen49_1,25-28':
            case 'dan9_17-27':
            case 'matt24_8-14':
            case 'matt24_15-22':
            case 'rev3_7-13':
            case 'isa16_1-5':
            case 'james3_1-2':
            case 'num25_1-13':
            case 'jer1_11-19':
            case 'luke12_34-44':

                $tmp_vnav_array['VVID'][0] = 'rev3_7-13';
                $tmp_vnav_array['COPY'][0] = 'Revelation 3:7-13';
                $tmp_vnav_array['VVID'][1] = 'gen49_1,25-28';
                $tmp_vnav_array['COPY'][1] = 'Genesis 49:1, 25-28';
                $tmp_vnav_array['VVID'][2] = 'deut33_1-4,12,29';
                $tmp_vnav_array['COPY'][2] = 'Deuteronomy 33:1-4, 12, 29';
                $tmp_vnav_array['VVID'][3] = 'isa16_1-5';
                $tmp_vnav_array['COPY'][3] = 'Isaiah 16:1-5';
                $tmp_vnav_array['VVID'][4] = 'dan9_17-27';
                $tmp_vnav_array['COPY'][4] = 'Daniel 9:17-27';
                $tmp_vnav_array['VVID'][5] = 'matt24_15-22';
                $tmp_vnav_array['COPY'][5] = 'Matthew 24:15-22';
                $tmp_vnav_array['VVID'][6] = 'matt24_8-14';
                $tmp_vnav_array['COPY'][6] = 'Matthew 24:8-14';
                $tmp_vnav_array['VVID'][7] = 'james3_1-2';
                $tmp_vnav_array['COPY'][7] = 'James 3:1-2';
                $tmp_vnav_array['VVID'][8] = 'num25_1-13';
                $tmp_vnav_array['COPY'][8] = 'Numbers 25:1-13';
                $tmp_vnav_array['VVID'][9] = 'jer1_11-19';
                $tmp_vnav_array['COPY'][9] = 'Jeremiah 1:11-19';
                $tmp_vnav_array['VVID'][10] = 'luke12_34-44';
                $tmp_vnav_array['COPY'][10] = 'Luke 12:34-44';


            break;
            case 'lifestudy_exo_156':

                $tmp_vnav_array['VVID'][0] = 'lifestudy_exo_156';
                $tmp_vnav_array['COPY'][0] = 'Life-Study of Exodus, Message 156';

            break;
            case 'exo20_15':

                $tmp_vnav_array['VVID'][0] = 'exo20_15';
                $tmp_vnav_array['COPY'][0] = 'Exodus 20:15';

            break;
            case 'exo20_13':

                $tmp_vnav_array['VVID'][0] = 'exo20_13';
                $tmp_vnav_array['COPY'][0] = 'Exodus 20:13';

            break;
            case 'exo30_18':

                $tmp_vnav_array['VVID'][0] = 'exo30_18';
                $tmp_vnav_array['COPY'][0] = 'Exodus 30:18';

            break;
            case 'exo30_17-21':

                $tmp_vnav_array['VVID'][0] = 'exo30_17-21';
                $tmp_vnav_array['COPY'][0] = 'Exodus 30:17-21';

            break;
            case 'lev18_1-5,24-28':

                $tmp_vnav_array['VVID'][0] = 'lev18_1-5,24-28';
                $tmp_vnav_array['COPY'][0] = 'Leviticus 18:1-5, 24-28';

            break;
            case 'lev26_3-13':
            case 'deut4_1-2,39-40':
            case 'deut5_10,29':
            case 'deut6_1-6,16-25':
            case 'deut6_25':
            case 'deut7_9-26':
            case 'deut8_1-10':
            case 'deut11_1,8-15,22-28':
            case 'deut26_16-19':
            case 'deut28_1-14':
            case 'deut30_11-20':
            case 'exo15_26':
            case '1kings8_54-66':
            case 'neh1_1-11':

                $tmp_vnav_array['VVID'][0] = 'lev26_3-13';
                $tmp_vnav_array['COPY'][0] = 'Leviticus 26:3-13';
                $tmp_vnav_array['VVID'][1] = 'deut4_1-2,39-40';
                $tmp_vnav_array['COPY'][1] = 'Deuteronomy 4:1-2, 39-40';
                $tmp_vnav_array['VVID'][2] = 'deut5_10,29';
                $tmp_vnav_array['COPY'][2] = 'Deuteronomy 5:10, 29';
                $tmp_vnav_array['VVID'][3] = 'deut6_1-6,16-25';
                $tmp_vnav_array['COPY'][3] = 'Deuteronomy 6:1-6, 16-25';
                $tmp_vnav_array['VVID'][4] = 'deut6_25';
                $tmp_vnav_array['COPY'][4] = 'Deuteronomy 6:25';
                $tmp_vnav_array['VVID'][5] = 'deut7_9-26';
                $tmp_vnav_array['COPY'][5] = 'Deuteronomy 7:9-26';
                $tmp_vnav_array['VVID'][6] = 'deut8_1-10';
                $tmp_vnav_array['COPY'][6] = 'Deuteronomy 8:1-10';
                $tmp_vnav_array['VVID'][7] = 'deut11_1,8-15,22-28';
                $tmp_vnav_array['COPY'][7] = 'Deuteronomy 11:1, 8-15, 22-28';
                $tmp_vnav_array['VVID'][8] = 'deut26_16-19';
                $tmp_vnav_array['COPY'][8] = 'Deuteronomy 26:16-19';
                $tmp_vnav_array['VVID'][9] = 'deut28_1-14';
                $tmp_vnav_array['COPY'][9] = 'Deuteronomy 28:1-14';
                $tmp_vnav_array['VVID'][10] = 'deut30_11-20';
                $tmp_vnav_array['COPY'][10] = 'Deuteronomy 30:11-20';
                $tmp_vnav_array['VVID'][11] = 'exo15_26';
                $tmp_vnav_array['COPY'][11] = 'Exodus 15:26';
                $tmp_vnav_array['VVID'][12] = '1kings8_54-66';
                $tmp_vnav_array['COPY'][12] = '1 Kings 8:54-66';
                $tmp_vnav_array['VVID'][13] = 'neh1_1-11';
                $tmp_vnav_array['COPY'][13] = 'Nehemiah 1:1-11';

            break;
            case 'num14_29-30':
            case '1cor10_5':

                $tmp_vnav_array['VVID'][0] = 'num14_29-30';
                $tmp_vnav_array['COPY'][0] = 'Numbers 14:29-30';
                $tmp_vnav_array['VVID'][1] = '1cor10_5';
                $tmp_vnav_array['COPY'][1] = '1 Corinthians 10:5';

            break;
            case 'num14_31[000]':
            case '1pet2_7-8':
            case 'rom9_31-33':
            case '1cor1_22-25':

                $tmp_vnav_array['VVID'][0] = 'num14_31[000]';
                $tmp_vnav_array['COPY'][0] = 'Numbers 14:31';
                $tmp_vnav_array['VVID'][1] = '1pet2_7-8';
                $tmp_vnav_array['COPY'][1] = '1 Peter 2:7-8';
                $tmp_vnav_array['VVID'][2] = 'rom9_31-33';
                $tmp_vnav_array['COPY'][2] = 'Romans 9:31-33';
                $tmp_vnav_array['VVID'][3] = '1cor1_22-25';
                $tmp_vnav_array['COPY'][3] = '1 Corinthians 1:22-25';

            break;
            case 'num14_31':
            case 'num32_13':
            case 'josh5_6':
            case 'psa95_10-11':
            case 'num14_35':
            case 'matt4_1-2':

                $tmp_vnav_array['VVID'][0] = 'num14_31';
                $tmp_vnav_array['COPY'][0] = 'Numbers 14:31';
                $tmp_vnav_array['VVID'][1] = 'num32_13';
                $tmp_vnav_array['COPY'][1] = 'Numbers 32:13';
                $tmp_vnav_array['VVID'][2] = 'josh5_6';
                $tmp_vnav_array['COPY'][2] = 'Joshua 5:6';
                $tmp_vnav_array['VVID'][3] = 'psa95_10-11';
                $tmp_vnav_array['COPY'][3] = 'Psalm 95:10-11';
                $tmp_vnav_array['VVID'][4] = 'num14_35';
                $tmp_vnav_array['COPY'][4] = 'Numbers 14:35';
                $tmp_vnav_array['VVID'][5] = 'matt4_1-2';
                $tmp_vnav_array['COPY'][5] = 'Matthew 4:1-2';

            break;
            case 'num33_50-54':

                $tmp_vnav_array['VVID'][0] = 'num33_50-54';
                $tmp_vnav_array['COPY'][0] = 'Numbers 33:50-54';

            break;
            case 'deut11_14':
            case 'joel2_23':

                $tmp_vnav_array['VVID'][0] = 'deut11_14';
                $tmp_vnav_array['COPY'][0] = 'Deuteronomy 11:14';
                $tmp_vnav_array['VVID'][1] = 'joel2_23';
                $tmp_vnav_array['COPY'][1] = 'Joel 2:23';

            break;
            case '1kings2_1-3':

                $tmp_vnav_array['VVID'][0] = '1kings2_1-3';
                $tmp_vnav_array['COPY'][0] = '1 Kings 2:1-3';

            break;
            case '1kings18_37-40,45;19_1-18':

                $tmp_vnav_array['VVID'][0] = '1kings18_37-40,45;19_1-18';
                $tmp_vnav_array['COPY'][0] = '1 Kings 18:37-40, 45; 19:1-18';

            break;
            case '1sam4_4':

                $tmp_vnav_array['VVID'][0] = '1sam4_4';
                $tmp_vnav_array['COPY'][0] = '1 Samuel 4:4';

            break;
            case 'psa97_2':

                $tmp_vnav_array['VVID'][0] = 'psa97_2';
                $tmp_vnav_array['COPY'][0] = 'Psalm 97:2';

            break;
            case 'psa119_103':

                $tmp_vnav_array['VVID'][0] = 'psa119_103';
                $tmp_vnav_array['COPY'][0] = 'Psalm 119:103';

            break;
            //'','Isa. 14:23'
            case 'isa14_13':

                $tmp_vnav_array['VVID'][0] = 'isa14_13';
                $tmp_vnav_array['COPY'][0] = 'Isaiah 14:13';

            break;
            case 'isa14_21-24':

                $tmp_vnav_array['VVID'][0] = 'isa14_21-24';
                $tmp_vnav_array['COPY'][0] = 'Isaiah 14:21-24';

            break;
            case 'jer24_7':
            case '1pet3_15':

                $tmp_vnav_array['VVID'][0] = 'jer24_7';
                $tmp_vnav_array['COPY'][0] = 'Jeremiah 24:7';
                $tmp_vnav_array['VVID'][1] = '1pet3_15';
                $tmp_vnav_array['COPY'][1] = '1 Peter 3:15';

            break;
            case 'jer31_33':

                $tmp_vnav_array['VVID'][0] = 'jer31_33';
                $tmp_vnav_array['COPY'][0] = 'Jeremiah 31:33';

            break;
            case 'jer31_33-34':

                $tmp_vnav_array['VVID'][0] = 'jer31_33-34';
                $tmp_vnav_array['COPY'][0] = 'Jeremiah 31:33-34';

            break;
            case 'jer31_31-37':

                $tmp_vnav_array['VVID'][0] = 'jer31_31-37';
                $tmp_vnav_array['COPY'][0] = 'Jeremiah 31:31-37';

            break;
            case 'ezek11_17-25':
            case 'jer31_33-37':

                $tmp_vnav_array['VVID'][0] = 'ezek11_17-25';
                $tmp_vnav_array['COPY'][0] = 'Ezekiel 11:17-25';
                $tmp_vnav_array['VVID'][1] = 'jer31_33-37';
                $tmp_vnav_array['COPY'][1] = 'Jeremiah 31:33-37';

            break;
            case 'dan9_4':
            case 'gen26_4-5':
            case 'exo20_6':

                $tmp_vnav_array['VVID'][0] = 'dan9_4';
                $tmp_vnav_array['COPY'][0] = 'Daniel 9:4';
                $tmp_vnav_array['VVID'][1] = 'gen26_4-5';
                $tmp_vnav_array['COPY'][1] = 'Genesis 26:4-5';
                $tmp_vnav_array['VVID'][2] = 'exo20_6';
                $tmp_vnav_array['COPY'][2] = 'Exodus 20:6';

            break;
            case 'matt1_18,20':

                $tmp_vnav_array['VVID'][0] = 'matt1_18,20';
                $tmp_vnav_array['COPY'][0] = 'Matthew 1:18, 20';

            break;
            case 'matt2_4-6':

                $tmp_vnav_array['VVID'][0] = 'matt2_4-6';
                $tmp_vnav_array['COPY'][0] = 'Matthew 2:4-6';

            break;
            case 'lev2_1':
            case 'matt3_15':

                $tmp_vnav_array['VVID'][0] = 'lev2_1';
                $tmp_vnav_array['COPY'][0] = 'Leviticus 2:1';
                $tmp_vnav_array['VVID'][1] = 'matt3_15';
                $tmp_vnav_array['COPY'][1] = 'Matthew 3:15';

            break;
            case 'matt4_3':

                $tmp_vnav_array['VVID'][0] = 'matt4_3';
                $tmp_vnav_array['COPY'][0] = 'Matthew 4:3';

            break;
            case 'matt4_4b':
            case 'luke22_42':

                $tmp_vnav_array['VVID'][0] = 'matt4_4b';
                $tmp_vnav_array['COPY'][0] = 'Matthew 4:4b';
                $tmp_vnav_array['VVID'][1] = 'luke22_42';
                $tmp_vnav_array['COPY'][1] = 'Luke 22:42';

            break;
            case 'matt4_5-7':

                $tmp_vnav_array['VVID'][0] = 'matt4_5-7';
                $tmp_vnav_array['COPY'][0] = 'Matthew 4:5-7';

            break;
            case 'matt5':
            case 'matt6':
            case 'matt7':

                $tmp_vnav_array['VVID'][0] = 'matt5';
                $tmp_vnav_array['COPY'][0] = 'Matthew Chapter 5';
                $tmp_vnav_array['VVID'][1] = 'matt6';
                $tmp_vnav_array['COPY'][1] = 'Matthew Chapter 6';
                $tmp_vnav_array['VVID'][2] = 'matt7';
                $tmp_vnav_array['COPY'][2] = 'Matthew Chapter 7';

            break;
            case 'matt5_10':
            case '1pet2_20':
            case 'rom6_18-19':

                $tmp_vnav_array['VVID'][0] = 'rom6_18-19';
                $tmp_vnav_array['COPY'][0] = 'Romans 6:18-19';
                $tmp_vnav_array['VVID'][1] = '1pet2_20';
                $tmp_vnav_array['COPY'][1] = '1 Peter 2:20';
                $tmp_vnav_array['VVID'][2] = 'matt5_10';
                $tmp_vnav_array['COPY'][2] = 'Matthew 5:10';

            break;
            case 'matt5_13':
            case 'mark9_50':
            case 'luke14_34-35':

                $tmp_vnav_array['VVID'][0] = 'matt5_13';
                $tmp_vnav_array['COPY'][0] = 'Matthew 5:13';
                $tmp_vnav_array['VVID'][1] = 'mark9_50';
                $tmp_vnav_array['COPY'][1] = 'Mark 9:50';
                $tmp_vnav_array['VVID'][2] = 'luke14_34-35';
                $tmp_vnav_array['COPY'][2] = 'Luke 14:34-35';

            break;
            case 'matt7_13-14':

                $tmp_vnav_array['VVID'][0] = 'matt7_13-14';
                $tmp_vnav_array['COPY'][0] = 'Matthew 7:13-14';

            break;
            case 'matt10_16-33':

                $tmp_vnav_array['VVID'][0] = 'matt10_16-33';
                $tmp_vnav_array['COPY'][0] = 'Matthew 10:16-33';

            break;
            case 'matt11_28-30':

                $tmp_vnav_array['VVID'][0] = 'matt11_28-30';
                $tmp_vnav_array['COPY'][0] = 'Matthew 11:28-30';

            break;
            case 'matt12_1-8':

                $tmp_vnav_array['VVID'][0] = 'matt12_1-8';
                $tmp_vnav_array['COPY'][0] = 'Matthew 12:1-8';

            break;
            case 'matt13_4':

                $tmp_vnav_array['VVID'][0] = 'matt13_4';
                $tmp_vnav_array['COPY'][0] = 'Matthew 13:4';

            break;
            case 'matt19_12':

                $tmp_vnav_array['VVID'][0] = 'matt19_12';
                $tmp_vnav_array['COPY'][0] = 'Matthew 19:12';

            break;
            case 'matt24_14':

                $tmp_vnav_array['VVID'][0] = 'matt24_14';
                $tmp_vnav_array['COPY'][0] = 'Matthew 24:14';

            break;
            case 'matt25_4':

                $tmp_vnav_array['VVID'][0] = 'matt25_4';
                $tmp_vnav_array['COPY'][0] = 'Matthew 25:4';

            break;
            case 'matt26_33-35,69-75':
            case 'mark14_27-31,66-72':
            case 'luke22_33-34,54-62':
            case 'john13_37-38;18_14-27':

                $tmp_vnav_array['VVID'][0] = 'matt26_33-35,69-75';
                $tmp_vnav_array['COPY'][0] = 'Matthew 26:33-35, 69-75';
                $tmp_vnav_array['VVID'][1] = 'mark14_27-31,66-72';
                $tmp_vnav_array['COPY'][1] = 'Mark 14:27-31, 66-72';
                $tmp_vnav_array['VVID'][2] = 'luke22_33-34,54-62';
                $tmp_vnav_array['COPY'][2] = 'Luke 22:33-34, 54-62';
                $tmp_vnav_array['VVID'][3] = 'john13_37-38;18_14-27';
                $tmp_vnav_array['COPY'][3] = 'John 13:37-38; 18:14-27';

            break;
            case 'matt27_46':

                $tmp_vnav_array['VVID'][0] = 'matt27_46';
                $tmp_vnav_array['COPY'][0] = 'Matthew 27:46';

            break;
            case 'luke9_5-6':
            case 'luke13_17':
            case 'heb2_14-15':
            case '2cor3_12,17':
            case 'rom8_33-39':
            case '1cor3_21-23':

                $tmp_vnav_array['VVID'][0] = 'luke9_5-6';
                $tmp_vnav_array['COPY'][0] = 'Luke 9:5-6';
                $tmp_vnav_array['VVID'][1] = 'luke13_17';
                $tmp_vnav_array['COPY'][1] = 'Luke 13:17';
                $tmp_vnav_array['VVID'][2] = 'heb2_14-15';
                $tmp_vnav_array['COPY'][2] = 'Hebrews 2:14-15';
                $tmp_vnav_array['VVID'][3] = '2cor3_12,17';
                $tmp_vnav_array['COPY'][3] = '2 Corinthians 3:12, 17';
                $tmp_vnav_array['VVID'][4] = 'rom8_33-39';
                $tmp_vnav_array['COPY'][4] = 'Romans 8:33-39';
                $tmp_vnav_array['VVID'][5] = '1cor3_21-23';
                $tmp_vnav_array['COPY'][5] = '1 Corinthians 3:21-23';

            break;
            case 'luke14_31-32':

                $tmp_vnav_array['VVID'][0] = 'luke14_31-32';
                $tmp_vnav_array['COPY'][0] = 'Luke 14:31-32';

            break;
            case 'luke18_11-12':

                $tmp_vnav_array['VVID'][0] = 'luke18_11-12';
                $tmp_vnav_array['COPY'][0] = 'Luke 18:11-12';

            break;
            case 'luke18_13':

                $tmp_vnav_array['VVID'][0] = 'luke18_13';
                $tmp_vnav_array['COPY'][0] = 'Luke 18:13';

            break;
            case 'luke19_12,14,15,27':
            case 'luke23_27-30':
            case 'rev6_16-17':

                $tmp_vnav_array['VVID'][0] = 'rev6_16-17';
                $tmp_vnav_array['COPY'][0] = 'Revelation 6:16-17';
                $tmp_vnav_array['VVID'][1] = 'luke23_27-30';
                $tmp_vnav_array['COPY'][1] = 'Luke 23:28-30';
                $tmp_vnav_array['VVID'][2] = 'luke19_12,14,15,27';
                $tmp_vnav_array['COPY'][2] = 'Luke 19:12, 14, 15, 27';

            break;
            case 'luke22_24-30':
            case 'john13_3-17':
            case 'matt16_25-26':

                $tmp_vnav_array['VVID'][0] = 'luke22_24-30';
                $tmp_vnav_array['COPY'][0] = 'Luke 22:24-27';
                $tmp_vnav_array['VVID'][1] = 'john13_3-17';
                $tmp_vnav_array['COPY'][1] = 'John 13:3-17';
                $tmp_vnav_array['VVID'][2] = 'matt16_25-26';
                $tmp_vnav_array['COPY'][2] = 'Matthew 16:25-26';

            break;
            case 'luke22_42[solo]':

                $tmp_vnav_array['VVID'][0] = 'luke22_42[solo]';
                $tmp_vnav_array['COPY'][0] = 'Luke 22:42';

            break;
            case 'luke23_38,42-43':
            case 'john8_51-59':
            case 'acts2_22-25':
            case 'exo9_29':
            case 'deut10_14-22':
            case 'psa24':
            case '1cor10_26,29b-31':
            case 'luke1_26-33':

                $tmp_vnav_array['VVID'][0] = 'luke23_38,42-43';
                $tmp_vnav_array['COPY'][0] = 'Luke 23:38, 42-43';
                $tmp_vnav_array['VVID'][1] = 'john8_51-59';
                $tmp_vnav_array['COPY'][1] = 'John 8:51-59';
                $tmp_vnav_array['VVID'][2] = 'acts2_22-25';
                $tmp_vnav_array['COPY'][2] = 'Acts 2:22-25';
                $tmp_vnav_array['VVID'][3] = 'exo9_29';
                $tmp_vnav_array['COPY'][3] = 'Exodus 9:29';
                $tmp_vnav_array['VVID'][4] = 'deut10_14-22';
                $tmp_vnav_array['COPY'][4] = 'Deuteronomy 10:14-22';
                $tmp_vnav_array['VVID'][5] = 'psa24';
                $tmp_vnav_array['COPY'][5] = 'Psalm 24';
                $tmp_vnav_array['VVID'][6] = '1cor10_26,29b-31';
                $tmp_vnav_array['COPY'][6] = '1 Corinthians 10:26, 29b-31';
                $tmp_vnav_array['VVID'][7] = 'luke1_26-33';
                $tmp_vnav_array['COPY'][7] = 'Luke 1:26-33';

            break;
            case 'john2_20-21':

                $tmp_vnav_array['VVID'][0] = 'john2_20-21';
                $tmp_vnav_array['COPY'][0] = 'John 2:20-21';

            break;
            case 'john2_21':
            case 'matt12_5':

                $tmp_vnav_array['VVID'][0] = 'john2_21';
                $tmp_vnav_array['COPY'][0] = 'John 2:21';
                $tmp_vnav_array['VVID'][1] = 'matt12_5';
                $tmp_vnav_array['COPY'][1] = 'Matthew 12:5';

            break;
            case 'john8_6':
            case 'john9_41':

                $tmp_vnav_array['VVID'][0] = 'john8_6';
                $tmp_vnav_array['COPY'][0] = 'John 8:6';
                $tmp_vnav_array['VVID'][1] = 'john9_41';
                $tmp_vnav_array['COPY'][1] = 'John 9:41';

            break;
            case 'john13_34[solo]':

                $tmp_vnav_array['VVID'][0] = 'john13_34[solo]';
                $tmp_vnav_array['COPY'][0] = 'John 13:34';

            break;
            case 'john13_37-38':

                $tmp_vnav_array['VVID'][0] = 'john13_37-38';
                $tmp_vnav_array['COPY'][0] = 'John 13:37-38';

            break;
            case 'john14_10-14':

                $tmp_vnav_array['VVID'][0] = 'john14_10-14';
                $tmp_vnav_array['COPY'][0] = 'John 14:10-14';

            break;
            case 'john14_12-14':

                $tmp_vnav_array['VVID'][0] = 'john14_12-14';
                $tmp_vnav_array['COPY'][0] = 'John 14:12-14';

            break;
            case 'john16_15':

                $tmp_vnav_array['VVID'][0] = 'john16_15';
                $tmp_vnav_array['COPY'][0] = 'John 16:15';

            break;
            case 'acts1_5':

                $tmp_vnav_array['VVID'][0] = 'acts1_5';
                $tmp_vnav_array['COPY'][0] = 'Acts 1:5';

            break;
            case 'acts8_29':
            case 'acts16_6,7':
            case 'acts11_12':

                $tmp_vnav_array['VVID'][0] = 'acts8_29';
                $tmp_vnav_array['COPY'][0] = 'Acts 8:29';
                $tmp_vnav_array['VVID'][1] = 'acts16_6,7';
                $tmp_vnav_array['COPY'][1] = 'Acts 16:6, 7';
                $tmp_vnav_array['VVID'][2] = 'acts11_12';
                $tmp_vnav_array['COPY'][2] = 'Acts 11:12';

            break;
            case 'acts11_18':

                $tmp_vnav_array['VVID'][0] = 'acts11_18';
                $tmp_vnav_array['COPY'][0] = 'Acts 11:18';

            break;
            case 'eph1_3-12':
            case 'rom5_1-5[000]':
            case 'rom15_4[000]':
            case '1cor9_8-11,13':

                $tmp_vnav_array['VVID'][0] = 'eph1_3-12';
                $tmp_vnav_array['COPY'][0] = 'Ephesians 1:3-12';
                $tmp_vnav_array['VVID'][1] = 'rom5_1-5[000]';
                $tmp_vnav_array['COPY'][1] = 'Romans 5:1-5';
                $tmp_vnav_array['VVID'][2] = 'rom15_4[000]';
                $tmp_vnav_array['COPY'][2] = 'Romans 15:4';
                $tmp_vnav_array['VVID'][3] = '1cor9_8-11,13';
                $tmp_vnav_array['COPY'][3] = '1 Corinthians 9:8-11, 13';

            break;
            case 'rom5_10':

                $tmp_vnav_array['VVID'][0] = 'rom5_10';
                $tmp_vnav_array['COPY'][0] = 'Romans 5:10';

            break;
            case 'rom5_14,17,21':
            case 'rom6_9-11':
            case 'rom14_7-12':

                $tmp_vnav_array['VVID'][0] = 'rom5_14,17,21';
                $tmp_vnav_array['COPY'][0] = 'Romans 5:14, 17, 21';
                $tmp_vnav_array['VVID'][1] = 'rom6_9-11';
                $tmp_vnav_array['COPY'][1] = 'Romans 6:9-11';
                $tmp_vnav_array['VVID'][2] = 'rom14_7-12';
                $tmp_vnav_array['COPY'][2] = 'Romans 14:7-12';

            break;
            case 'rom6_3':

                $tmp_vnav_array['VVID'][0] = 'rom6_3';
                $tmp_vnav_array['COPY'][0] = 'Romans 6:3';

            break;
            case 'rom6_8':

                $tmp_vnav_array['VVID'][0] = 'rom6_8';
                $tmp_vnav_array['COPY'][0] = 'Romans 6:8';

            break;
            case 'rom6_18-19[000]':

                $tmp_vnav_array['VVID'][0] = 'rom6_18-19[000]';
                $tmp_vnav_array['COPY'][0] = 'Romans 6:18-19';

            break;
            case 'rom6_22':

                $tmp_vnav_array['VVID'][0] = 'rom6_22';
                $tmp_vnav_array['COPY'][0] = 'Romans 6:22';

            break;
            case 'rom7_2-4,6':

                $tmp_vnav_array['VVID'][0] = 'rom7_2-4,6';
                $tmp_vnav_array['COPY'][0] = 'Romans 7:2-4, 6';

            break;
            case 'rom8_2':

                $tmp_vnav_array['VVID'][0] = 'rom8_2';
                $tmp_vnav_array['COPY'][0] = 'Romans 8:2';

            break;
            case 'rom8_2,4':

                $tmp_vnav_array['VVID'][0] = 'rom8_2,4';
                $tmp_vnav_array['COPY'][0] = 'Romans 8:2, 4';

            break;
            case 'rom8_14':

                $tmp_vnav_array['VVID'][0] = 'rom8_14';
                $tmp_vnav_array['COPY'][0] = 'Romans 8:14';

            break;
            case 'rom12_2':
            case 'phil2_13':

                $tmp_vnav_array['VVID'][0] = 'rom12_2';
                $tmp_vnav_array['COPY'][0] = 'Romans 12:2';
                $tmp_vnav_array['VVID'][1] = 'phil2_13';
                $tmp_vnav_array['COPY'][1] = 'Philippians 2:13';

            break;
            case 'rom12_11':

                $tmp_vnav_array['VVID'][0] = 'rom12_11';
                $tmp_vnav_array['COPY'][0] = 'Romans 12:11';

            break;
            case 'rom13_14':

                $tmp_vnav_array['VVID'][0] = 'rom13_14';
                $tmp_vnav_array['COPY'][0] = 'Romans 13:14';

            break;
            case 'rom14_1':

                $tmp_vnav_array['VVID'][0] = 'rom14_1';
                $tmp_vnav_array['COPY'][0] = 'Romans 14:1';

            break;
            case '1cor5_1,5':

                $tmp_vnav_array['VVID'][0] = '1cor5_1,5';
                $tmp_vnav_array['COPY'][0] = '1 Corinthians 5:1, 5';

            break;
            case '1cor6_12':
            case '1cor10_23':

                $tmp_vnav_array['VVID'][0] = '1cor10_23';
                $tmp_vnav_array['COPY'][0] = '1 Corinthians 10:23';
                $tmp_vnav_array['VVID'][1] = '1cor6_12';
                $tmp_vnav_array['COPY'][1] = '1 Corinthians 6:12';

            break;
            case '1cor11_4':

                $tmp_vnav_array['VVID'][0] = '1cor11_4';
                $tmp_vnav_array['COPY'][0] = '1 Corinthians 11:4';

            break;
            case '1cor11_22':

                $tmp_vnav_array['VVID'][0] = '1cor11_22';
                $tmp_vnav_array['COPY'][0] = '1 Corinthians 11:22';

            break;
            case '1cor15_55,58':
            case '2cor1_9-10':
            case 'rom6_8-11':

                $tmp_vnav_array['VVID'][0] = '1cor15_55,58';
                $tmp_vnav_array['COPY'][0] = '1 Corinthians 15:55, 58';
                $tmp_vnav_array['VVID'][1] = '2cor1_9-10';
                $tmp_vnav_array['COPY'][1] = '2 Corinthians 1:9-10';
                $tmp_vnav_array['VVID'][2] = 'rom6_8-11';
                $tmp_vnav_array['COPY'][2] = 'Romans 6:8-11';

            break;
            case '1cor15_58':
            case 'matt10_10b':
            case 'john14_10':
            case 'rom2_6-7':

                $tmp_vnav_array['VVID'][0] = '1cor15_58';
                $tmp_vnav_array['COPY'][0] = '1 Corinthians 15:58';
                $tmp_vnav_array['VVID'][1] = 'matt10_10b';
                $tmp_vnav_array['COPY'][1] = 'Matthew 10:10b';
                $tmp_vnav_array['VVID'][2] = 'john14_10';
                $tmp_vnav_array['COPY'][2] = 'John 14:10';
                $tmp_vnav_array['VVID'][3] = 'rom2_6-7';
                $tmp_vnav_array['COPY'][3] = 'Romans 2:6-7';

            break;
            case '2cor1_20-22':

                $tmp_vnav_array['VVID'][0] = '2cor1_20-22';
                $tmp_vnav_array['COPY'][0] = '2 Corinthians 1:20-22';

            break;
            case '2cor1_20-22[000]':
            case 'rom10_2-3':
            case 'gal1_14':

                $tmp_vnav_array['VVID'][0] = '2cor1_20-22[000]';
                $tmp_vnav_array['COPY'][0] = '2 Corinthians 1:20-22';
                $tmp_vnav_array['VVID'][1] = 'rom10_2-3';
                $tmp_vnav_array['COPY'][1] = 'Romans 10:2-3';
                $tmp_vnav_array['VVID'][2] = 'gal1_14';
                $tmp_vnav_array['COPY'][2] = 'Galatians 1:14';

            break;
            case '2cor3_3':
            case 'heb8_10[000]':
            case 'jer31_31-34':

                $tmp_vnav_array['VVID'][0] = '2cor3_3';
                $tmp_vnav_array['COPY'][0] = '2 Corinthians 3:3';
                $tmp_vnav_array['VVID'][1] = 'heb8_10[000]';
                $tmp_vnav_array['COPY'][1] = 'Hebrews 8:10';
                $tmp_vnav_array['VVID'][2] = 'jer31_31-34';
                $tmp_vnav_array['COPY'][2] = 'Jeremiah 31:31-34';

            break;
            case '2cor3_6-9':
            case 'rom8_14-23':

                $tmp_vnav_array['VVID'][0] = '2cor3_6-9';
                $tmp_vnav_array['COPY'][0] = '2 Corinthians 3:6-9';
                $tmp_vnav_array['VVID'][1] = 'rom8_14-23';
                $tmp_vnav_array['COPY'][1] = 'Romans 8:14-23';

            break;
            case '2cor3_17-18':

                $tmp_vnav_array['VVID'][0] = '2cor3_17-18';
                $tmp_vnav_array['COPY'][0] = '2 Corinthians 3:17-18';

            break;
            case '2cor11_2a':
            case 'gal4_11':

                $tmp_vnav_array['VVID'][0] = '2cor11_2a';
                $tmp_vnav_array['COPY'][0] = '2 Corinthians 11:2a';
                $tmp_vnav_array['VVID'][1] = 'gal4_11';
                $tmp_vnav_array['COPY'][1] = 'Galatians 4:11';

            break;
            case '2cor11_2b-3':
            case 'rev2_14':

                $tmp_vnav_array['VVID'][0] = '2cor11_2b-3';
                $tmp_vnav_array['COPY'][0] = '2 Corinthians 11:2b-3';
                $tmp_vnav_array['VVID'][1] = 'rev2_14';
                $tmp_vnav_array['COPY'][1] = 'Revelation 2:14';

            break;
            case 'gal2_20':

                $tmp_vnav_array['VVID'][0] = 'gal2_20';
                $tmp_vnav_array['COPY'][0] = 'Galatians 2:20';

            break;
            case 'gal2_20_x':
            case 'gal6_14':

                $tmp_vnav_array['VVID'][0] = 'gal2_20_x';
                $tmp_vnav_array['COPY'][0] = 'Galatians 2:20';
                $tmp_vnav_array['VVID'][1] = 'gal6_14';
                $tmp_vnav_array['COPY'][1] = 'Galatians 6:14';

            break;
            case 'gal3_1':
            case 'gal5_1,7':

                $tmp_vnav_array['VVID'][0] = 'gal3_1';
                $tmp_vnav_array['COPY'][0] = 'Galatians 3:1';
                $tmp_vnav_array['VVID'][1] = 'gal5_1,7';
                $tmp_vnav_array['COPY'][1] = 'Galatians 5:1, 7';

            break;
            case 'gal5_1':

                $tmp_vnav_array['VVID'][0] = 'gal5_1';
                $tmp_vnav_array['COPY'][0] = 'Galatians 5:1';

            break;
            case 'gal5_16,18,22-23,25':

                $tmp_vnav_array['VVID'][0] = 'gal5_16,18,22-23,25';
                $tmp_vnav_array['COPY'][0] = 'Galatians 5:16, 18, 22-23, 25';

            break;
            case 'eph1_9':

                $tmp_vnav_array['VVID'][0] = 'eph1_9';
                $tmp_vnav_array['COPY'][0] = 'Ephesians 1:9';

            break;
            case 'eph1_3-14[000]':

                $tmp_vnav_array['VVID'][0] = 'eph1_3-14[000]';
                $tmp_vnav_array['COPY'][0] = 'Ephesians 1:3-14';

            break;
            case 'eph1_3':
            case 'eph1_9-14,18-23':
            case 'rom5_1-5':
            case 'rom8_16-17,24-25':
            case 'rom15_4':
            case '2cor3_12':
            case 'gal5_5-6':
            case 'col1_5-6,21-23,26-27':
            case '1thes1_2-3':
            case '1thes5_7-11':
            case '2thes2_16-17':
            case '1tim1_1':
            case '1tim6_17':
            case 'titus1_1-3':
            case 'titus2_11-15':
            case 'titus3_7[000]':
            case 'heb3_6[000]':
            case 'heb6_17-20':
            case 'heb7_17-19':
            case 'heb10_21-23':
            case 'heb11_1':
            case '1pet1_3-9,13,21':
            case '1pet3_5-7,14-22':
            case '1john3_1-10':

                $tmp_vnav_array['VVID'][0] = 'eph1_3';
                $tmp_vnav_array['COPY'][0] = 'Ephesians 1:3';
                $tmp_vnav_array['VVID'][1] = 'rom5_1-5';
                $tmp_vnav_array['COPY'][1] = 'Romans 5:1-5';
                $tmp_vnav_array['VVID'][2] = 'rom8_16-17,24-25';
                $tmp_vnav_array['COPY'][2] = 'Romans 8:16-17, 24-25';
                $tmp_vnav_array['VVID'][3] = 'rom15_4';
                $tmp_vnav_array['COPY'][3] = 'Romans 15:4';
                $tmp_vnav_array['VVID'][4] = '2cor3_12';
                $tmp_vnav_array['COPY'][4] = '2 Corinthians 3:12';
                $tmp_vnav_array['VVID'][5] = 'gal5_5-6';
                $tmp_vnav_array['COPY'][5] = 'Galatians 5:5-6';
                $tmp_vnav_array['VVID'][6] = 'eph1_9-14,18-23';
                $tmp_vnav_array['COPY'][6] = 'Ephesians 1:9-14, 18-23';
                $tmp_vnav_array['VVID'][7] = 'col1_5-6,21-23,26-27';
                $tmp_vnav_array['COPY'][7] = 'Colossians 1:5-6, 21-23, 26-27';
                $tmp_vnav_array['VVID'][8] = '1thes1_2-3';
                $tmp_vnav_array['COPY'][8] = '1 Thessalonians 1:2-3';
                $tmp_vnav_array['VVID'][9] = '1thes5_7-11';
                $tmp_vnav_array['COPY'][9] = '1 Thessalonians 5:7-11';
                $tmp_vnav_array['VVID'][10] = '2thes2_16-17';
                $tmp_vnav_array['COPY'][10] = '2 Thessalonians 2:16-17';
                $tmp_vnav_array['VVID'][11] = '1tim1_1';
                $tmp_vnav_array['COPY'][11] = '1 Tim 1:1';
                $tmp_vnav_array['VVID'][12] = '1tim6_17';
                $tmp_vnav_array['COPY'][12] = '1 Tim 6:17';
                $tmp_vnav_array['VVID'][13] = 'titus1_1-3';
                $tmp_vnav_array['COPY'][13] = 'Titus 1:1-3';
                $tmp_vnav_array['VVID'][14] = 'titus2_11-15';
                $tmp_vnav_array['COPY'][14] = 'Titus 2:11-15';
                $tmp_vnav_array['VVID'][15] = 'titus3_7[000]';
                $tmp_vnav_array['COPY'][15] = 'Titus 3:7';
                $tmp_vnav_array['VVID'][16] = 'heb3_6[000]';
                $tmp_vnav_array['COPY'][16] = 'Hebrews 3:6';
                $tmp_vnav_array['VVID'][17] = 'heb6_17-20';
                $tmp_vnav_array['COPY'][17] = 'Hebrews 6:17-20';
                $tmp_vnav_array['VVID'][18] = 'heb7_17-19';
                $tmp_vnav_array['COPY'][18] = 'Hebrews 7:17-19';
                $tmp_vnav_array['VVID'][19] = 'heb10_21-23';
                $tmp_vnav_array['COPY'][19] = 'Hebrews 10:21-23';
                $tmp_vnav_array['VVID'][20] = 'heb11_1';
                $tmp_vnav_array['COPY'][20] = 'Hebrews 11:1';
                $tmp_vnav_array['VVID'][21] = '1pet1_3-9,13,21';
                $tmp_vnav_array['COPY'][21] = '1 Pet 1:3-9, 13, 21';
                $tmp_vnav_array['VVID'][22] = '1pet3_5-7,14-22';
                $tmp_vnav_array['COPY'][22] = '1 Pet. 3:5-7, 14-22';
                $tmp_vnav_array['VVID'][23] = '1john3_1-10';
                $tmp_vnav_array['COPY'][23] = '1 John 3:1-10';

            break;
            case 'phil1_6':

                $tmp_vnav_array['VVID'][0] = 'phil1_6';
                $tmp_vnav_array['COPY'][0] = 'Philippians 1:6';

            break;
            case 'phil1_20':

                $tmp_vnav_array['VVID'][0] = 'phil1_20';
                $tmp_vnav_array['COPY'][0] = 'Philippians 1:20';

            break;
            case 'phil1_27':

                $tmp_vnav_array['VVID'][0] = 'phil1_27';
                $tmp_vnav_array['COPY'][0] = 'Philippians 1:27';

            break;
            case 'phil2_13[001]':

                $tmp_vnav_array['VVID'][0] = 'phil2_13[001]';
                $tmp_vnav_array['COPY'][0] = 'Philippians 2:13';

            break;
            case 'phil2_13[000]':

                $tmp_vnav_array['VVID'][0] = 'phil2_13[000]';
                $tmp_vnav_array['COPY'][0] = 'Philippians 2:13';

            break;
            case 'phil2_3':
            case 'john13_34':

                $tmp_vnav_array['VVID'][0] = 'phil2_3';
                $tmp_vnav_array['COPY'][0] = 'Philippians 2:3';
                $tmp_vnav_array['VVID'][1] = 'john13_34';
                $tmp_vnav_array['COPY'][1] = 'John 13:34';

            break;
            case 'phil2_5-8':

                $tmp_vnav_array['VVID'][0] = 'phil2_5-8';
                $tmp_vnav_array['COPY'][0] = 'Philippians 2:5-8';

            break;
            case 'phil2_5-16[000]':

                $tmp_vnav_array['VVID'][0] = 'phil2_5-16[000]';
                $tmp_vnav_array['COPY'][0] = 'Philippians 2:5-16';

            break;
            case 'phil2_5-16':
            case 'john14_15,20-21':

                $tmp_vnav_array['VVID'][0] = 'phil2_5-16';
                $tmp_vnav_array['COPY'][0] = 'Philippians 2:5-16';
                $tmp_vnav_array['VVID'][1] = 'john14_15,20-21';
                $tmp_vnav_array['COPY'][1] = 'John 14:15, 20-21';

            break;
            case 'phil2_5-9':
            case 'gal5_13,16':
            case '1pet2_16':
            case '1john2_15-17':
            case 'mark7_19-23':
            case 'acts10_15-16b,19-21':

                $tmp_vnav_array['VVID'][0] = 'phil2_5-9';
                $tmp_vnav_array['COPY'][0] = 'Philippians 2:5-9';
                $tmp_vnav_array['VVID'][1] = 'gal5_13,16';
                $tmp_vnav_array['COPY'][1] = 'Galatians 5:13, 16';
                $tmp_vnav_array['VVID'][2] = '1pet2_16';
                $tmp_vnav_array['COPY'][2] = '1 Peter 2:16';
                $tmp_vnav_array['VVID'][3] = '1john2_15-17';
                $tmp_vnav_array['COPY'][3] = '1 John 2:15-17';
                $tmp_vnav_array['VVID'][4] = 'mark7_19-23';
                $tmp_vnav_array['COPY'][4] = 'Mark 7:19-23';
                $tmp_vnav_array['VVID'][5] = 'acts10_15-16b,19-21';
                $tmp_vnav_array['COPY'][5] = 'Acts 10:15-16b, 19-21';

            break;
            case 'phil2_8':

                $tmp_vnav_array['VVID'][0] = 'phil2_8';
                $tmp_vnav_array['COPY'][0] = 'Philippians 2:8';

            break;
            case 'col1_5':
            case 'col1_27':
            case '1pet1_3-5':
            case '1pet1_13':
            case 'titus3_7':
            case 'heb3_6':
            case 'heb10_23':

                $tmp_vnav_array['VVID'][0] = 'col1_5';
                $tmp_vnav_array['COPY'][0] = 'Colossians 1:5';
                $tmp_vnav_array['VVID'][1] = 'col1_27';
                $tmp_vnav_array['COPY'][1] = 'Colossians 1:27';
                $tmp_vnav_array['VVID'][2] = '1pet1_3-5';
                $tmp_vnav_array['COPY'][2] = '1 Peter 1:3-5';
                $tmp_vnav_array['VVID'][3] = '1pet1_13';
                $tmp_vnav_array['COPY'][3] = '1 Peter 1:13';
                $tmp_vnav_array['VVID'][4] = 'titus3_7';
                $tmp_vnav_array['COPY'][4] = 'Titus 3:7';
                $tmp_vnav_array['VVID'][5] = 'heb3_6';
                $tmp_vnav_array['COPY'][5] = 'Hebrews 3:6';
                $tmp_vnav_array['VVID'][6] = 'heb10_23';
                $tmp_vnav_array['COPY'][6] = 'Hebrews 10:23';

            break;
            case 'col2_9':

                $tmp_vnav_array['VVID'][0] = 'col2_9';
                $tmp_vnav_array['COPY'][0] = 'Colossians 2:9';

            break;
            case 'col2_8,12,20-23':

                $tmp_vnav_array['VVID'][0] = 'col2_8,12,20-23';
                $tmp_vnav_array['COPY'][0] = 'Colossians 2:8, 12, 20-23';

            break;
            case 'col3_5':

                $tmp_vnav_array['VVID'][0] = 'col3_5';
                $tmp_vnav_array['COPY'][0] = 'Colossians 3:5';

            break;
            case 'col3_6':

                $tmp_vnav_array['VVID'][0] = 'col3_6';
                $tmp_vnav_array['COPY'][0] = 'Colossians 3:6';

            break;
            case '2thes2_8-12':
            case 'heb3_7-19[000]':
            case 'john8_1-11':

                $tmp_vnav_array['VVID'][0] = '2thes2_8-12';
                $tmp_vnav_array['COPY'][0] = '2 Thessalonians 2:8-12';
                $tmp_vnav_array['VVID'][1] = 'heb3_7-19[000]';
                $tmp_vnav_array['COPY'][1] = 'Hebrews 3:7-19';
                $tmp_vnav_array['VVID'][2] = 'john8_1-11';
                $tmp_vnav_array['COPY'][2] = 'John 8:1-11';

            break;
            case '1tim4_1-5':
            case 'rev2_12-17':
            case 'rev2_18-23':

                $tmp_vnav_array['VVID'][0] = '1tim4_1-5';
                $tmp_vnav_array['COPY'][0] = '1 Timothy 4:1-5';
                $tmp_vnav_array['VVID'][1] = 'rev2_12-17';
                $tmp_vnav_array['COPY'][1] = 'Revelation 2:12-17';
                $tmp_vnav_array['VVID'][2] = 'rev2_18-23';
                $tmp_vnav_array['COPY'][2] = 'Revelation 2:18-23';

            break;
            case '2tim1_6':

                $tmp_vnav_array['VVID'][0] = '2tim1_6';
                $tmp_vnav_array['COPY'][0] = '2 Timothy 1:6';

            break;
            case '2tim1_6-8':
            case 'rom12_11-12':
            case 'luke24_31-32':
            case 'prov20_27':
            case 'luke12_35':

                $tmp_vnav_array['VVID'][0] = '2tim1_6-8';
                $tmp_vnav_array['COPY'][0] = '2 Timothy 1:6-8';
                $tmp_vnav_array['VVID'][1] = 'rom12_11-12';
                $tmp_vnav_array['COPY'][1] = 'Romans 12:11-12';
                $tmp_vnav_array['VVID'][2] = 'luke24_31-32';
                $tmp_vnav_array['COPY'][2] = 'Luke 24:31-32';
                $tmp_vnav_array['VVID'][3] = 'prov20_27';
                $tmp_vnav_array['COPY'][3] = 'Proverbs 20:27';
                $tmp_vnav_array['VVID'][4] = 'luke12_35';
                $tmp_vnav_array['COPY'][4] = 'Luke 12:35';

            break;
            case 'heb3_7-19':

                $tmp_vnav_array['VVID'][0] = 'heb3_7-19';
                $tmp_vnav_array['COPY'][0] = 'Hebrews 3:7-19';

            break;
            case 'heb4_8-16':

                $tmp_vnav_array['VVID'][0] = 'heb4_8-16';
                $tmp_vnav_array['COPY'][0] = 'Hebrews 4:8-16';

            break;
            case 'heb4_11':

                $tmp_vnav_array['VVID'][0] = 'heb4_11';
                $tmp_vnav_array['COPY'][0] = 'Hebrews 4:11';

            break;
            case 'heb8_10':

                $tmp_vnav_array['VVID'][0] = 'heb8_10';
                $tmp_vnav_array['COPY'][0] = 'Hebrews 8:10';

            break;
            case 'heb9_14':

                $tmp_vnav_array['VVID'][0] = 'heb9_14';
                $tmp_vnav_array['COPY'][0] = 'Hebrews 9:14';

            break;
            case 'heb10_22,19':
            case '1cor6_17':
            case '2cor3_18':

                $tmp_vnav_array['VVID'][0] = 'heb10_22,19';
                $tmp_vnav_array['COPY'][0] = 'Hebrews 10:22, 19';
                $tmp_vnav_array['VVID'][1] = '1cor6_17';
                $tmp_vnav_array['COPY'][1] = '1 Corinthians 6:17';
                $tmp_vnav_array['VVID'][2] = '2cor3_18';
                $tmp_vnav_array['COPY'][2] = '2 Corinthians 3:18';

            break;
            case 'heb10_22':

                $tmp_vnav_array['VVID'][0] = 'heb10_22';
                $tmp_vnav_array['COPY'][0] = 'Hebrews 10:22';

            break;
            case 'heb10_35':

                $tmp_vnav_array['VVID'][0] = 'heb10_35';
                $tmp_vnav_array['COPY'][0] = 'Hebrews 10:35';

            break;
            case 'heb10_35,38-39':
            case 'lev26_3,11b-12':

                $tmp_vnav_array['VVID'][0] = 'heb10_35,38-39';
                $tmp_vnav_array['COPY'][0] = 'Hebrews 10:35, 38-39';
                $tmp_vnav_array['VVID'][1] = 'lev26_3,11b-12';
                $tmp_vnav_array['COPY'][1] = 'Leviticus 26:3, 11b-12';

            break;
            case 'heb12_1':

                $tmp_vnav_array['VVID'][0] = 'heb12_1';
                $tmp_vnav_array['COPY'][0] = 'Hebrews 12:1';

            break;
            case '1pet2_24':
            case 'isa53_6':

                $tmp_vnav_array['VVID'][0] = '1pet2_24';
                $tmp_vnav_array['COPY'][0] = '1 Peter 2:24';
                $tmp_vnav_array['VVID'][1] = 'isa53_6';
                $tmp_vnav_array['COPY'][1] = 'Isaiah 53:6';

            break;
            case '1pet5_8':

                $tmp_vnav_array['VVID'][0] = '1pet5_8';
                $tmp_vnav_array['COPY'][0] = '1 Peter 5:8';

            break;
            case 'rev2_21-22':

                $tmp_vnav_array['VVID'][0] = 'rev2_21-22';
                $tmp_vnav_array['COPY'][0] = 'Revelation 2:21-22';

            break;
            case 'rev3_8':

                $tmp_vnav_array['VVID'][0] = 'rev3_8';
                $tmp_vnav_array['COPY'][0] = 'Revelation 3:8';

            break;
            case 'rev2_11|2_17,26-28|3_5,12,21':
            case 'matt25_23,10b':

                $tmp_vnav_array['VVID'][0] = 'rev2_11|2_17,26-28|3_5,12,21';
                $tmp_vnav_array['COPY'][0] = 'Revelation 2:11; 2:17,<br>26-28; 3:5, 12, 21;';
                $tmp_vnav_array['VVID'][1] = 'matt25_23,10b';
                $tmp_vnav_array['COPY'][1] = 'Matthew 25:23, 10b<br>&nbsp;&nbsp;';

            break;
            case 'rev2_14[solo]':

                $tmp_vnav_array['VVID'][0] = 'rev2_14[solo]';
                $tmp_vnav_array['COPY'][0] = 'Revelation 2:14';

            break;
            case 'rev3_19':

                $tmp_vnav_array['VVID'][0] = 'rev3_19';
                $tmp_vnav_array['COPY'][0] = 'Revelation 3:19';

            break;
            case 'rev12_3-4,9':
            case 'gen3_14':

                $tmp_vnav_array['VVID'][0] = 'rev12_3-4,9';
                $tmp_vnav_array['COPY'][0] = 'Revelation 12:3-4, 9';
                $tmp_vnav_array['VVID'][1] = 'gen3_14';
                $tmp_vnav_array['COPY'][1] = 'Genesis 3:14';

            break;
            case 'rev12_3-4,13,17;13:2,4':
            case 'gen3_14[COVID]':

                $tmp_vnav_array['VVID'][0] = 'gen3_14[COVID]';
                $tmp_vnav_array['COPY'][0] = 'Genesis 3:14';
                $tmp_vnav_array['VVID'][1] = 'rev12_3-4,13,17;13:2,4';
                $tmp_vnav_array['COPY'][1] = 'Revelation 12:3-4, 13, 17; 13:2, 4';

            break;
            case 'rev21_2,9-27':

                $tmp_vnav_array['VVID'][0] = 'rev21_2,9-27';
                $tmp_vnav_array['COPY'][0] = 'Revelation 21:2, 9-27';

            break;
            case 'rev21_7':
            case 'rev21_3-5':
            case 'rev2_10-11':
            case 'rev20_6':
            case 'eph1_3-14':
            case 'john5_24-25':
            case 'luke9_1-6':
            case 'luke10_19':
            case 'rev21_21':

                $tmp_vnav_array['VVID'][0] = 'rev21_7';
                $tmp_vnav_array['COPY'][0] = 'Revelation 21:7';
                $tmp_vnav_array['VVID'][1] = 'rev21_3-5';
                $tmp_vnav_array['COPY'][1] = 'Revelation 21:3-5';
                $tmp_vnav_array['VVID'][2] = 'rev2_10-11';
                $tmp_vnav_array['COPY'][2] = 'Revelation 2:10-11';
                $tmp_vnav_array['VVID'][3] = 'rev20_6';
                $tmp_vnav_array['COPY'][3] = 'Revelation 20:6';
                $tmp_vnav_array['VVID'][4] = 'eph1_3-14';
                $tmp_vnav_array['COPY'][4] = 'Ephesians 1:3-14';
                $tmp_vnav_array['VVID'][5] = 'john5_24-25';
                $tmp_vnav_array['COPY'][5] = 'John 5:24-25';
                $tmp_vnav_array['VVID'][6] = 'luke9_1-6';
                $tmp_vnav_array['COPY'][6] = 'Luke 9:1-6';
                $tmp_vnav_array['VVID'][7] = 'luke10_19';
                $tmp_vnav_array['COPY'][7] = 'Luke 10:19';
                $tmp_vnav_array['VVID'][8] = 'rev21_21';
                $tmp_vnav_array['COPY'][8] = 'Revelation 21:21';

            break;
            case 'rev22_2':

                $tmp_vnav_array['VVID'][0] = 'rev22_2';
                $tmp_vnav_array['COPY'][0] = 'Revelation 22:2';


            break;
            default:
                //
                // NOTHING TO DO HERE.

            break;

        }

        return $tmp_vnav_array;

    }

    private function return_book_preciousness(){

        //
        // THE VERSE ARRAY STRUCTURE IS AS FOLLOWS.
        // ['COPY'][n+1] = COPY

        $tmp_book_array = array();

        switch($this->vvid){
            case 'jehovah_has_revealed':

                $tmp_book_array['COPY'][0] = 'CAPO IV';

            break;
            case 'hymn979':

                $tmp_book_array['COPY'][0] = 'HYMNS';

            break;
            case 'jehovah_has_revealed_dl':
            case 'jehovah_has_revealed_audio':
            case 'jehovah_has_revealed_chords':

                $tmp_book_array['COPY'][0] = 'Jehovah Has Revealed His Heart';

            break;
            case 'gen1_1':
            case 'gen1_26':
            case 'gen2_7':
            case 'gen3_1':
            case 'gen3_14':
            case 'gen3_14[solo]':
            case 'gen3_14[COVID]':
            case 'gen26_4-5':
            case 'gen49_1,25-28':
            case 'gen48_21-22|49_1,25-28':

                $tmp_book_array['COPY'][0] = 'Genesis';

            break;
            case 'lifestudy_exo_156':

                $tmp_book_array['COPY'][0] = 'Life Study of Exodus';

            break;
            case 'exo20_6':
            case 'exo20_15':
            case 'exo20_13':
            case 'exo30_18':
            case 'exo9_29':
            case 'exo15_26':
            case 'exo30_17-21':

                $tmp_book_array['COPY'][0] = 'Exodus';

            break;
            case 'lev2_1':
            case 'lev18_1-5,24-28':
            case 'lev26_3,11b-12':
            case 'lev26_3-13':

                $tmp_book_array['COPY'][0] = 'Leviticus';

            break;
            case 'num14_29-30':
            case 'num14_35':
            case 'num14_31':
            case 'num14_31[000]':
            case 'num32_13':
            case 'num25_1-13':
            case 'num33_50-54':

                $tmp_book_array['COPY'][0] = 'Numbers';

            break;
            case 'deut4_1-2,39-40':
            case 'deut5_10,29':
            case 'deut6_1-6,16-25':
            case 'deut6_25':
            case 'deut7_9-26':
            case 'deut8_1-10':
            case 'deut10_14-22':
            case 'deut11_14':
            case 'deut11_1,8-15,22-28':
            case 'deut26_16-19':
            case 'deut28_1-14':
            case 'deut30_11-20':
            case 'deut33_1-4,12,29':

                $tmp_book_array['COPY'][0] = 'Deuteronomy';

            break;
            case 'josh5_6':

                $tmp_book_array['COPY'][0] = 'Joshua';

            break;
            case '1sam4_4':

                $tmp_book_array['COPY'][0] = '1 Samuel';

            break;
            case '1kings2_1-3':
            case '1kings8_54-66':
            case '1kings18_37-40,45;19_1-18':

                $tmp_book_array['COPY'][0] = '1 Kings';

            break;
            case 'neh1_1-11':

                $tmp_book_array['COPY'][0] = 'Nehemiah';

            break;
            case 'psa95_10-11':
            case 'psa97_2':
            case 'psa119_103':
            case 'psa24':

                $tmp_book_array['COPY'][0] = 'Psalms';

            break;
            case 'prov20_27':

                $tmp_book_array['COPY'][0] = 'Proverbs';

            break;
            case 'isa14_13';
            case 'isa14_21-24':
            case 'isa16_1-5':
            case 'isa53_6':

                $tmp_book_array['COPY'][0] = 'Isaiah';

            break;
            case 'jer1_11-19':
            case 'jer24_7':
            case 'jer31_31-34':
            case 'jer31_33-34':
            case 'jer31_33-37':
            case 'jer31_31-37':

                $tmp_book_array['COPY'][0] = 'Jeremiah';

            break;
            case 'ezek11_17-25':

                $tmp_book_array['COPY'][0] = 'Ezekiel';

            break;
            case 'joel2_23':

                $tmp_book_array['COPY'][0] = 'Joel';

            break;
            case 'dan9_4':
            case 'dan9_17-27':

                $tmp_book_array['COPY'][0] = 'Daniel';

            break;
            case 'matt1_18,20':
            case 'matt2_4-6':
            case 'matt3_15':
            case 'matt4_1-2':
            case 'matt4_3':
            case 'matt4_4b':
            case 'matt4_5-7':
            case 'matt5_10':
            case 'matt5_13':
            case 'matt5':
            case 'matt6':
            case 'matt7':
            case 'matt7_13-14':
            case 'matt10_10b':
            case 'matt10_16-33':
            case 'matt11_28-30':
            case 'matt12_1-8':
            case 'matt12_5':
            case 'matt13_4':
            case 'matt16_25-26':
            case 'matt19_12':
            case 'matt24_8-14':
            case 'matt24_14':
            case 'matt25_4':
            case 'matt24_15-22':
            case 'matt25_23,10b':
            case 'matt26_33-35,69-75':
            case 'matt27_46':

                $tmp_book_array['COPY'][0] = 'Matthew';

            break;
            case 'mark7_19-23':
            case 'mark9_50':
            case 'mark14_27-31,66-72':

                $tmp_book_array['COPY'][0] = 'Mark';

            break;
            case 'luke1_26-33':
            case 'luke9_1-6':
            case 'luke9_5-6':
            case 'luke10_19':
            case 'luke12_35':
            case 'luke12_34-44':
            case 'luke13_17':
            case 'luke14_31-32':
            case 'luke14_34-35':
            case 'luke18_11-12':
            case 'luke18_13':
            case 'luke19_12,14,15,27':
            case 'luke22_24-30':
            case 'luke22_33-34,54-62':
            case 'luke22_42':
            case 'luke22_42[solo]':
            case 'luke23_27-30':
            case 'luke24_31-32':
            case 'luke23_38,42-43':

                $tmp_book_array['COPY'][0] = 'Luke';

            break;
            case 'john2_20-21':
            case 'john2_21':
            case 'john5_24-25':
            case 'john8_1-11':
            case 'john8_6':
            case 'john8_51-59':
            case 'john9_41':
            case 'john13_3-17':
            case 'john13_34':
            case 'john13_34[solo]':
            case 'john13_37-38;18_14-27':
            case 'john13_37-38':
            case 'john14_10':
            case 'john14_10-14':
            case 'john14_12-14':
            case 'john14_15,20-21':
            case 'john16_15':

                $tmp_book_array['COPY'][0] = 'John';

            break;
            case 'acts1_5':
            case 'acts2_22-25':
            case 'acts8_29':
            case 'acts16_6,7':
            case 'acts11_12':
            case 'acts11_18':
            case 'acts10_15-16b,19-21':

                $tmp_book_array['COPY'][0] = 'Acts';

            break;
            case 'rom2_6-7':
            case 'rom5_1-5[000]':
            case 'rom5_1-5':
            case 'rom5_10':
            case 'rom5_14,17,21':
            case 'rom6_3':
            case 'rom6_8':
            case 'rom6_8-11':
            case 'rom6_9-11':
            case 'rom6_18-19[000]':
            case 'rom6_18-19':
            case 'rom6_22':
            case 'rom7_2-4,6':
            case 'rom8_2':
            case 'rom8_2,4':
            case 'rom8_14':
            case 'rom8_14-23':
            case 'rom8_33-39':
            case 'rom9_31-33':
            case 'rom10_2-3':
            case 'rom12_2':
            case 'rom12_11':
            case 'rom12_11-12':
            case 'rom13_14':
            case 'rom14_1':
            case 'rom14_7-12':
            case 'rom8_16-17,24-25':
            case 'rom15_4[000]':
            case 'rom15_4':

                $tmp_book_array['COPY'][0] = 'Romans';

            break;
            case '1cor1_22-25':
            case '1cor3_21-23':
            case '1cor5_1,5':
            case '1cor6_12':
            case '1cor6_17':
            case '1cor9_8-11,13':
            case '1cor10_5':
            case '1cor10_23':
            case '1cor10_26,29b-31':
            case '1cor11_4':
            case '1cor11_22':
            case '1cor15_55,58':
            case '1cor15_58':

                $tmp_book_array['COPY'][0] = '1 Corinthians';

            break;
            case '2cor1_9-10':
            case '2cor1_20-22':
            case '2cor1_20-22[000]':
            case '2cor3_3':
            case '2cor3_6-9':
            case '2cor3_12':
            case '2cor3_12,17':
            case '2cor3_17-18':
            case '2cor3_18':
            case '2cor11_2a':
            case '2cor11_2b-3':

                $tmp_book_array['COPY'][0] = '2 Corinthians';

            break;
            case 'gal1_14':
            case 'gal2_20':
            case 'gal2_20_x':
            case 'gal3_1':
            case 'gal4_11':
            case 'gal5_1':
            case 'gal5_1,7':
            case 'gal5_13,16':
            case 'gal5_16,18,22-23,25':
            case 'gal5_5-6':
            case 'gal6_14':

                $tmp_book_array['COPY'][0] = 'Galatians';

            break;
            case 'eph1_3':
            case 'eph1_3-12':
            case 'eph1_3-14[000]':
            case 'eph1_3-14':
            case 'eph1_9':
            case 'eph1_9-14,18-23':

                $tmp_book_array['COPY'][0] = 'Ephesians';

            break;
            case 'phil1_6':
            case 'phil1_20':
            case 'phil1_27':
            case 'phil2_3':
            case 'phil2_5-8':
            case 'phil2_5-16[000]':
            case 'phil2_5-16':
            case 'phil2_5-9':
            case 'phil2_8':
            case 'phil2_13[001]':
            case 'phil2_13[000]':
            case 'phil2_13':

                $tmp_book_array['COPY'][0] = 'Philippians';

            break;
            case 'col1_5':
            case 'col1_16':
            case 'col1_27':
            case 'col1_5-6,21-23,26-27':
            case 'col2_9':
            case 'col2_8,12,20-23':
            case 'col3_5':
            case 'col3_6':

                $tmp_book_array['COPY'][0] = 'Colossians';

            break;
            case '1thes1_2-3':
            case '1thes5_7-11':

                $tmp_book_array['COPY'][0] = '1 Thessalonians';

            break;
            case '2thes2_8-12':
            case '2thes2_16-17':

                $tmp_book_array['COPY'][0] = '2 Thessalonians';

            break;
            case '1tim1_1':
            case '1tim4_1-5':
            case '1tim6_17':

                $tmp_book_array['COPY'][0] = '1 Timothy';

            break;
            case '2tim1_6':
            case '2tim1_6-8':

                $tmp_book_array['COPY'][0] = '2 Timothy';

            break;
            case 'titus1_1-3':
            case 'titus2_11-15':
            case 'titus3_7[000]':
            case 'titus3_7':

                $tmp_book_array['COPY'][0] = 'Titus';

            break;
            case 'heb2_14-15':
            case 'heb3_6[000]':
            case 'heb3_6':
            case 'heb3_7-19':
            case 'heb3_7-19[000]':
            case 'heb4_8-16':
            case 'heb4_11':
            case 'heb6_17-20':
            case 'heb7_17-19':
            case 'heb8_10[000]':
            case 'heb8_10':
            case 'heb9_14':
            case 'heb10_22,19':
            case 'heb10_22':
            case 'heb10_21-23':
            case 'heb10_23':
            case 'heb10_35':
            case 'heb10_35,38-39':
            case 'heb11_1':
            case 'heb12_1':

                $tmp_book_array['COPY'][0] = 'Hebrews';

            break;
            case 'james3_1-2':

                $tmp_book_array['COPY'][0] = 'James';

            break;
            case '1pet1_3-5':
            case '1pet1_3-9,13,21':
            case '1pet1_13':
            case '1pet2_7-8':
            case '1pet2_16':
            case '1pet2_20':
            case '1pet2_24':
            case '1pet3_5-7,14-22':
            case '1pet3_15':
            case '1pet5_8':

                $tmp_book_array['COPY'][0] = '1 Peter';

            break;
            case '1john2_15-17':
            case '1john3_1-10':

                $tmp_book_array['COPY'][0] = '1 John';

            break;
            case 'rev2_10-11':
            case 'rev2_12-17':
            case 'rev2_14':
            case 'rev2_14[solo]':
            case 'rev2_11|2_17,26-28|3_5,12,21':
            case 'rev2_18-23':
            case 'rev2_21-22':
            case 'rev3_7-13':
            case 'rev3_8':
            case 'rev3_19':
            case 'rev6_16-17':
            case 'rev12_3-4,9':
            case 'rev12_3-4,13,17;13:2,4':
            case 'rev20_6':
            case 'rev21_2,9-27':
            case 'rev21_3-5':
            case 'rev21_7':
            case 'rev21_21':
            case 'rev22_2':

                $tmp_book_array['COPY'][0] = 'Revelation';

            break;
            default:
                //
                // NOTHING TO DO HERE.

            break;

        }

        return $tmp_book_array;

    }

    private function return_verse_preciousness(){

        //
        // THE VERSE ARRAY STRUCTURE IS AS FOLLOWS.
        // ['REFERENCE'][n+1] = REFERENCE
        // ['COPY'][n+1] = COPY

        $tmp_verse_array = array();

        switch($this->vvid){
            case 'jehovah_has_revealed_dl':

                $tmp_verse_array['REFERENCE'][0]        = '';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'Download Jehovah Has Revealed (Ashes). Vocals: Sister Doris K., Brother Jonathan H. African Djembe Hand Bongo: Brother Kenton W. Guitar: Brother Jonathan H. Jehovah has revealed / His heart to me. / To Him I thus would consecrated be. / As Daniel purposed in his heart...I\'ll be. / And pray; that God could move on earth through me. / Lord, You need me.';
                $tmp_verse_array['COPY'][0]             = '<p>Download Jehovah Has Revealed (Ashes).</p>
                <div class="cb_10"></div>
                <a href="#" onclick="launch_newwindow(\'https://jony5.com/downloads/audio/jehovah_has_revealed_his_heart.php\'); return false;" target="_blank">Click 
                here</a> to download.
                <div class="cb_10"></div>
                <p><strong>Vocals:</strong> Sister Doris K., Brother Jonathan H.<br><strong>African Djembe Hand 
                Bongo:</strong> Brother Kenton W.<br><strong>Guitar:</strong> Brother Jonathan H.</p>';

            break;
            case 'jehovah_has_revealed_audio':

                $tmp_verse_array['REFERENCE'][0]        = '';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'Audio Stream for Jehovah has revealed His heart (Ashes) :: Vocals: Sister Doris K., Brother Jonathan H. African Djembe Hand Bongo: Brother Kenton W. Guitar: Brother Jonathan H.Jehovah has revealed / His heart to me. / To Him I thus would consecrated be. / As Daniel purposed in his heart...I\'ll be. / And pray; that God could move on earth through me. / Lord, You need me.';
                $tmp_verse_array['COPY'][0]             = '<p>Jehovah has revealed His heart (Ashes) ::</p><div class="cb_10"></div>
                <!--[if lt IE 9]><script>document.createElement(\'audio\');</script><![endif]-->
                <audio class="wp-audio-shortcode" id="audio-199-1" preload="none" style="width: 100%;" controls="controls"><source type="audio/mpeg" src="https://jony5.com/common/audio/jehovah_has_revealed_his_heart.mp3" /><a href="https://jony5.com/common/audio/jehovah_has_revealed_his_heart.mp3">https://jony5.com/common/audio/jehovah_has_revealed_his_heart.mp3</a></audio></p>

                <div class="cb_10"></div>
                <p><strong>Vocals:</strong> Sister Doris K., Brother Jonathan H.<br><strong>African Djembe Hand 
                Bongo:</strong> Brother Kenton W.<br><strong>Guitar:</strong> Brother Jonathan H.</p>
                <div class="cb_10"></div>
                <div class="script_ref_num hymn_stanza">1</div>	
                <div class="stanza_copy">Jehovah has revealed 
                    His heart to me.<br>
                    To Him I thus would consecrated be.<br>
                    As Daniel purposed in his heart...I\'ll be.<br>
                    And pray; that God could move on earth through me.<br>
                    Lord, You need me.
                </div>
                <div class="cb_10"></div>
                <div class="script_ref_num hymn_stanza">2</div>	
                <div class="stanza_copy">So here I am Lord standing before You.<br>
                    I realize that my natural man is through.<br>
                    Only Christ Himself can satisfy my God.<br>
                    He\'s absolute; my burnt offering true.<br>
                    Lord, I need You.
                </div>
                <div class="cb_10"></div>
                <div class="script_ref_num hymn_stanza">3</div>	
                <div class="stanza_copy">Lord, You are the One who meets God\'s need.<br>
                    All my natural goodness I must leave.<br>
                    Upon the alter I would find my rest.<br>
                    To become in the end ashes at best.<br>
                    Wholly for God.
                </div>
                <div class="cb_10"></div>
                <div class="script_ref_num hymn_stanza">4</div>	
                <div class="stanza_copy">Oh, there is nothing sweeter to my Lord.<br>
                    Than those who would their whole being outpour.<br>
                    Living sacrifices unto God.<br>
                    Through them You\'d gain Your bride, Your wife, Your love.<br>
                    New Jerusalem.<br>
                    New Jerusalem.
                </div>';

            break;
            case 'jehovah_has_revealed_chords':

                $tmp_verse_array['REFERENCE'][0]        = '';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'Jehovah has revealed His heart (Ashes) Guitar Chord Chart. Vocals: Sister Doris K., Brother Jonathan H. African Djembe Hand Bongo: Brother Kenton W. Guitar: Brother Jonathan H.Jehovah has revealed / His heart to me. / To Him I thus would consecrated be. / As Daniel purposed in his heart...I\'ll be. / And pray; that God could move on earth through me. / Lord, You need me.';
                $tmp_verse_array['COPY'][0]             = '<img src="https://jony5.com/common/imgs/jehovah_has_revealed_his_heart_chords.png" width="580" height="650" alt="Jehovah has revealed His heart - chords">';

            break;
            case 'jehovah_has_revealed':

                $tmp_verse_array['REFERENCE'][0]        = '';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'Lyrics and chords. Jehovah has revealed His heart (Ashes) :: Vocals: Sister Doris K., Brother Jonathan H. African Djembe Hand Bongo: Brother Kenton W. Guitar: Brother Jonathan H.Jehovah has revealed / His heart to me. / To Him I thus would consecrated be. / As Daniel purposed in his heart...I\'ll be. / And pray; that God could move on earth through me. / Lord, You need me.';
                $tmp_verse_array['COPY'][0]             = '<div class="cb_10"></div>
                <div class="stanza_copy">
                    <span class="stanza_copy chords">Asus2</span> <span class="stanza_copy chords" style="padding-left:228px;">Dsus2 - Dsus2+A</span>
                </div>
                <div class="cb"></div>
                <div class="script_ref_num hymn_stanza">1</div>	
                <div class="stanza_copy">Jehovah has revealed His heart to me.<br>
                    <span class="chords">Asus2</span><span class="chords" style="padding-left:215px;">Dsus2 - Dsus2+A</span><br>
                    To Him I thus would consecrated be.<br>
                    <span class="chords" style="padding-left:30px;">F#m</span> <span class="chords" style="padding-left:215px;">E</span><br>
                    As Daniel purposed in his heart...I\'ll be.<br>
                    <span class="chords" style="padding-left:40px;">Bm</span> <span class="chords" style="padding-left:307px;">A</span> <span class="chords" style="padding-left:30px;">E</span><br>
                    And pray; that God could move on earth through me.<br>
                    <span class="chords" style="padding-left:120px;">Asus2</span> <span class="chords" style="padding-left:100px;">Dsus2 - Dsus2+A</span><br>
                    Lord, You need me.
                </div>
                <div class="cb_10"></div>
                <div class="script_ref_num hymn_stanza">2</div>
                <div class="stanza_copy">So here I am Lord standing before You.<br>
                    I realize that my natural man is through.<br>
                    Only Christ Himself can satisfy my God.<br>
                    He\'s absolute; my burnt offering true.<br>
                    Lord, I need You.
                </div>
                <div class="cb_10"></div>
                <div class="script_ref_num hymn_stanza">3</div>
                <div class="stanza_copy">Lord, You are the One who meets God\'s need.<br>
                    All my natural goodness I must leave.<br>
                    Upon the alter I would find my rest.<br>
                    To become in the end ashes at best.<br>
                    Wholly for God.
                </div>
                <div class="cb_10"></div>
                <div class="script_ref_num hymn_stanza">4</div>
                <div class="stanza_copy">Oh, there is nothing sweeter to my Lord.<br>
                    Than those who would their whole being outpour.<br>
                    Living sacrifices unto God.<br>
                    Through them You\'d gain Your bride, Your wife, Your love.<br>
                    New Jerusalem.<br>
                    New Jerusalem.
                </div>';

            break;
            case 'hymn979':

                $tmp_verse_array['REFERENCE'][0]        = '#979*';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'HYMNS #979. How glorious, how bright it shines, / The holy, new Jerusalem; / It is God\'s dwelling place with man, / The spotless bride of Christ, the Lamb. 2. Saints of the Old and of the New, /Heirs of the promise God bestowed, / Components of the city are, / Together built for God\'s abode.';
                $tmp_verse_array['COPY'][0]             = '<div class="script_ref_num hymn_stanza" style="float:left;">1</div> 
                <div class="stanza_copy">How glorious, how bright it shines,<br>
                    The holy, new Jerusalem;<br>
                    It is God\'s dwelling place with man,<br>
                    The spotless bride of Christ, the Lamb.
                </div>
                <div class="cb_10"></div>

                <div class="script_ref_num hymn_stanza">2</div> 
                <div class="stanza_copy">Saints of the Old and of the New,<br>
                    Heirs of the promise God bestowed,<br>
                    Components of the city are,<br>
                    Together built for God\'s abode.
                </div>
                <div class="cb_10"></div>

                <div class="script_ref_num hymn_stanza">3</div> 
                <div class="stanza_copy">Perfectly square the city lies,<br>
                    All sides are equal &ndash;&ndash; length, width, height;<br>
                    No measurement more long or short,<br>
                    No part oblique, it stands upright.
                </div>
                <div class="cb_10"></div>

                <span class="script_ref_num hymn_stanza">4</span> 
                <div class="stanza_copy">The city with its street pure gold<br>
                    As clear as glass transparent is,<br>
                    Showing that God\'s transcendent life<br>
                    Its quality and nature is.
                </div>
                <div class="cb_10"></div>

                <div class="script_ref_num hymn_stanza">5</div> 
                <div class="stanza_copy">Twelve city gates are each one pearl;<br>
                    Thus man is through redemption shown<br>
                    Reborn and as a pearl transformed,<br>
                    Entering to a realm God\'s own.
                </div>
                <div class="cb_10"></div>

                <div class="script_ref_num hymn_stanza">6</div> 
                <div class="stanza_copy">The twelve foundations of its wall<br>
                    Are with twelve precious stones adorned;<br>
                    Through fire and pressure recomposed<br>
                    And with eternal value formed.
                </div>
                <div class="cb_10"></div>

                <div class="script_ref_num hymn_stanza">7</div> 
                <div class="stanza_copy">The wall of jasper, crystal clear,<br>
                    God\'s glory by it fully shown;<br>
                    His glorious light through it does shine,<br>
                    And He appears as jasper stone.
                </div>
                <div class="cb_10"></div>

                <div class="script_ref_num hymn_stanza">8</div> 
                <div class="stanza_copy">The wall a separation makes,<br>
                    Excluding all that is unclean;<br>
                    Gold, pearls, and precious stones alone<br>
                    The holy city has within.
                </div>
                <div class="cb_10"></div>

                <div class="script_ref_num hymn_stanza">9</div> 
                <div class="stanza_copy">God and the Lamb the Temple are!<br>
                    We shall behold His glorious face;<br>
                    His presence never will depart,<br>
                    We\'ll worship Him thru endless days.
                </div>
                <div class="cb_10"></div>

                <span class="script_ref_num hymn_stanza">10</span> 
                <div class="stanza_copy">The city needs no sun nor moon<br>
                    For God\'s own glory is its light;<br>
                    The Lamb\'s the lamp the city bears,<br>
                    In all directions blazing bright.
                </div>
                <div class="cb_10"></div>

                <div class="script_ref_num hymn_stanza">11</div> 
                <div class="stanza_copy">Out from the throne of God and the Lamb<br>
                    Flows midst the street a living stream,<br>
                    And on its banks, on either side,<br>
                    The tree of life is thriving seen.
                </div>
                <div class="cb_10"></div>

                <div class="script_ref_num hymn_stanza">12</div> 
                <div class="stanza_copy">This signifies the life of God<br>
                    Not just for food or water flows,<br>
                    But carries God\'s authority<br>
                    As it throughout the city goes.
                </div>
                <div class="cb_10"></div>

                <div class="script_ref_num hymn_stanza">13</div> 
                <div class="stanza_copy">The street of purest gold therein<br>
                    God\'s nature as the way doth show;<br>
                    A river in it flows for drink<br>
                    And fruits of life abundant grow.
                </div>
                <div class="cb_10"></div>

                <span class="script_ref_num hymn_stanza">14</span> 
                <div class="stanza_copy">The number twelve means government,<br>
                    Perfection which eternal is;<br>
                    God blent with man it also tells &ndash;&ndash;<br>
                    Three multiplied by four shows this.
                </div>
                <div class="cb_10"></div>

                <div class="script_ref_num hymn_stanza">15</div> 
                <div class="stanza_copy">Darkness and death shall be no more,<br>
                    Sorrow and pain shall pass away,<br>
                    Old will be gone and all be new,<br>
                    God will abide with man for aye.
                </div>
                <div class="cb_10"></div>

                <div class="script_ref_num hymn_stanza">16</div> 
                <div class="stanza_copy">The city has God\'s image full,<br>
                    It rules for Him, the sovereign King,<br>
                    Fulfilling His eternal plan,<br>
                    Complete content to Him to bring.
                </div>';

            break;
            case 'gen1_1':

                $tmp_verse_array['REFERENCE'][0]        = '1:1';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'In the beginning God created the heavens and the earth.';
                $tmp_verse_array['COPY'][0]             = 'In the beginning God created the heavens and the earth.';

            break;
            case 'gen1_26':

                $tmp_verse_array['REFERENCE'][0]        = '1:26';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'And God said, Let Us make man in Our image, according to Our likeness; and let them have dominion over the fish of the sea and over the birds of heaven and over the cattle and over all the earth and over every creeping thing that creeps upon the earth.';
                $tmp_verse_array['COPY'][0]             = 'And God said, Let Us make man in Our image, according to Our likeness; 
                and let them have dominion over the fish of the sea and over the birds of heaven and over the cattle and 
                over all the earth and over every creeping thing that creeps upon the earth.';

            break;
            case 'gen2_7':

                $tmp_verse_array['REFERENCE'][0]        = '2:7';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'Jehovah God formed man from the dust of the ground and breathed into his nostrils the breath of life, and man became a living soul.';
                $tmp_verse_array['COPY'][0]             = 'Jehovah God formed man from the dust of the ground and breathed into 
                his nostrils the breath of life, and man became a living soul.';

            break;
            case 'gen3_1':

                $tmp_verse_array['REFERENCE'][0]        = '3:1';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'Now the serpent was more crafty than any animal of the field that Jehovah God had made. And he said to the woman, Did God really say, You shall not eat of any tree of the garden?';
                $tmp_verse_array['COPY'][0]             = 'Now the serpent was more crafty than any <em>other</em> animal of the 
                field that Jehovah God had made. And he said to the woman, Did God really say, You shall not eat of 
                any tree of the garden?';

            break;
            case 'gen3_14[COVID]':
            case 'gen3_14[solo]':
            case 'gen3_14':

                $tmp_verse_array['REFERENCE'][0]        = '3:14';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'And Jehovah God said to the serpent, / Because you have done this, / You are cursed more than all the cattle / And more than all the animals of the field: / Upon your stomach you will go, / And dust you will eat / All the days of your life.';
                $tmp_verse_array['COPY'][0]             = 'And Jehovah God said to the serpent,<br>
                Because you have done this,<br>
                &nbsp;&nbsp;&nbsp;You are cursed more than all the cattle<br>
                &nbsp;&nbsp;&nbsp;And more than all the animals of the field:<br>
                Upon your stomach you will go,<br>
                &nbsp;&nbsp;&nbsp;And dust you will eat<br>
                &nbsp;&nbsp;&nbsp;All the days of your life.';

            break;
            case 'gen26_4-5':

                $tmp_verse_array['REFERENCE'][0]        = '26:4-5';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'And I will multiply your seed as the stars of heaven and will give to your seed all these lands; and in your seed all the nations of the earth will be blessed, Because Abraham obeyed My voice and kept My charge, My commandments, My statutes, and My laws.';
                $tmp_verse_array['COPY'][0]             = 'And I will multiply your seed as the stars of heaven and will give to 
                your seed all these lands; and in your seed all the nations of the earth will be blessed, Because 
                Abraham obeyed My voice and kept My charge, My commandments, My statutes, and My laws.';

            break;
            case 'gen48_21-22|49_1,25-28':

                $tmp_verse_array['REFERENCE'][0]        = '48:21-22; 49:1, 25-28';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = '21 And Israel said to Joseph, Now I am about to die, but God will be with you and will bring you again to the land of your fathers. Moreover I have given to you one portion more than your brothers, which I took out of the hand of the Amorite with my sword and with my bow. And Jacob called to his sons and said, Gather yourselves together that I may tell you what will happen to you in the last days.';
                $tmp_verse_array['COPY'][0]             = '<span class="script_ref_num">21</span> And Israel said to Joseph, Now 
                I am about to die, but God will be with you and will bring you again to the land of your fathers. 
                Moreover I have given to you one portion more than your brothers, which I took out of the hand of 
                the Amorite with my sword and with my bow. And Jacob called to his sons and said, Gather yourselves 
                together that I may tell you what will happen to you in the last days.

                <div class="cb_10"></div>
                <span class="script_ref_num">25</span> From the God of your father, who will help you,<br>
                &nbsp;&nbsp;&nbsp;And from the All-sufficient One, who will bless you<br>
                With blessings of heaven above,<br>
                &nbsp;&nbsp;&nbsp;Blessings of the deep that lies beneath,<br>
                &nbsp;&nbsp;&nbsp;Blessings of the breasts and of the womb.<br>

                <div class="cb_5"></div>
                The blessings of your father surpass<br>
                &nbsp;&nbsp;&nbsp;The blessings of my ancestors<br>
                &nbsp;&nbsp;&nbsp;To the utmost bound of the everlasting hills.<br>
                They will be on the head of Joseph,<br>
                &nbsp;&nbsp;&nbsp;And on the crown of the head of the one who was separate from<br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;his brothers.<br>

                <div class="cb_5"></div>
                Benjamin is a <span class="script_sup">1</span>ravenous wolf,<br>
                &nbsp;&nbsp;&nbsp;In the morning devouring the prey<br>
                &nbsp;&nbsp;&nbsp;And in the evening dividing the spoil.<br>

                <div class="cb_5"></div>
                All these are the twelve tribes of Israel, and this is what their father spoke to them when he 
                blessed them; he blessed them, each one according to his blessing.';

            break;
            case 'gen49_1,25-28':

                $tmp_verse_array['REFERENCE'][0]        = '49:1, 25-28';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = '1 And Jacob called to his sons and said, Gather yourselves together that I may tell you what will happen to you in the last days. 25 From the God of your father, who will help you, / And from the All-sufficient One, who will bless you / With blessings of heaven above, / Blessings of the deep that lies beneath, / Blessings of the breasts and of the womb.';
                $tmp_verse_array['COPY'][0]             = '<span class="script_ref_num">1</span> And Jacob called to his sons 
                and said, Gather yourselves together that I may tell you what will happen to you in the last days.

                <div class="cb_10"></div>
                <span class="script_ref_num">25</span> From the God of your father, who will help you,<br>
                &nbsp;&nbsp;&nbsp;And from the All-sufficient One, who will bless you<br>
                With blessings of heaven above,<br>
                &nbsp;&nbsp;&nbsp;Blessings of the deep that lies beneath,<br>
                &nbsp;&nbsp;&nbsp;Blessings of the breasts and of the womb.<br>

                <div class="cb_5"></div>
                The blessings of your father surpass<br>
                &nbsp;&nbsp;&nbsp;The blessings of my ancestors<br>
                &nbsp;&nbsp;&nbsp;To the utmost bound of the everlasting hills.<br>
                They will be on the head of Joseph,<br>
                &nbsp;&nbsp;&nbsp;And on the crown of the head of the one who was separate from<br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;his brothers.<br>

                <div class="cb_5"></div>
                Benjamin is a <span class="script_sup">1</span>ravenous wolf,<br>
                &nbsp;&nbsp;&nbsp;In the morning devouring the prey<br>
                &nbsp;&nbsp;&nbsp;And in the evening dividing the spoil.<br>

                <div class="cb_5"></div>
                All these are the twelve tribes of Israel, and this is what their father spoke to them when he 
                blessed them; he blessed them, each one according to his blessing.';

            break;
            case 'lifestudy_exo_156':

                $tmp_verse_array['REFERENCE'][0]        = 'page 1672';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'THE RESULT OF SERVING IN THE TABERNACLE WITHOUT FIRST WASHING IN THE LAVER. When we pray to offer something to the Lord, we first need to wash our hands and even our feet in the laver. To come to the meeting to function is actually to come into the tabernacle to serve the Lord. Before we serve the Lord in the tabernacle, we need to wash.';
                $tmp_verse_array['COPY'][0]             = '<strong>THE RESULT OF SERVING IN THE TABERNACLE WITHOUT FIRST WASHING 
                IN THE LAVER</strong>

                <div class="cb_10"></div>
                When we pray to offer something to the Lord, we first need to wash our hands and even our feet in 
                the laver. To come to the meeting to function is actually to come into the tabernacle to serve the 
                Lord. Before we serve the Lord in the tabernacle, we need to wash. However, in the Christian life of 
                many believers and in their service to God there does not seem to be a laver. When they come to the 
                alter to make an offering to God, they have unclean hands. They may come into the church meetings 
                and serve without washing their hands in the laver. This kind of service brings in death. This is 
                the reason Exodus 30:21 says &quot;Then they shall wash their hands and their feet, that they may 
                not die.&quot;

                <div class="cb_10"></div>
                We should be careful not to touch God\'s service unless we have first washed our hands in the laver. 
                If we try to serve God in the tabernacle with unclean hands, we shall die, spiritually speaking. How 
                much death there is among Christians today! The more they serve, the more death they have because 
                they serve with unclean hands. Praying and serving with unclean hands brings in death.

                <div class="cb_10"></div>
                If we do not pray in the meetings or function, in a sense we may be somewhat living. But if we pray 
                or function without washing in the laver, we shall bring death to ourselves and also spread death to 
                others. Death is the result of our trying to pray or serve without washing in the laver.';

            break;
            case 'exo9_29':

                $tmp_verse_array['REFERENCE'][0]        = '9:29';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'And Moses said to him, As soon as I have gone out of the city, I will spread out my hands to Jehovah: The thunder will cease, and there will not be any more hail, that you may know that the earth is Jehovah\'s.';
                $tmp_verse_array['COPY'][0]             = 'And Moses said to him, As soon as I have gone out of the city, I will 
                spread out my hands to Jehovah: The thunder will cease, and there will not be any more hail, that 
                you may know that the earth<br>is Jehovah\'s.';

            break;
            case 'exo15_26':

                $tmp_verse_array['REFERENCE'][0]        = '15:26';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'And He said, If you will listen carefully to the voice of Jehovah your God and do what is right in His eyes and give ear to His commandments and keep all His statutes, I will put none of the diseases on you which I have put on the Egyptians;';
                $tmp_verse_array['COPY'][0]             = 'And He said, If you will listen carefully to the voice of Jehovah your 
                God and do what is right in His eyes and give ear to His commandments and keep all His statutes, I will 
                put none of the diseases on you which I have put on the Egyptians; for I am Jehovah who heals you.';

            break;
            case 'exo20_6':

                $tmp_verse_array['REFERENCE'][0]        = '20:6';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'Yet showing lovingkindness to thousands of generations of those who love Me and keep My commandments.';
                $tmp_verse_array['COPY'][0]             = 'Yet showing lovingkindness to thousands of generations of those who love 
                Me and keep My commandments.';

            break;
            case 'exo20_13':

                $tmp_verse_array['REFERENCE'][0]        = '20:13';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'You shall not kill.';
                $tmp_verse_array['COPY'][0]             = 'You shall not kill.';

            break;
            case 'exo20_15':

                $tmp_verse_array['REFERENCE'][0]        = '20:15';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'You shall not steal.';
                $tmp_verse_array['COPY'][0]             = 'You shall not steal.';

            break;
            case 'exo30_18':

                $tmp_verse_array['REFERENCE'][0]        = '30:18';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'You shall also make a laver of bronze, with its base of bronze, for washing. And you shall put it between the Tent of Meeting and the alter, and you shall put water in it.';
                $tmp_verse_array['COPY'][0]             = 'You shall also make a <span class="script_sup">1</span>laver of 
                bronze, with its base of bronze, for washing. And you shall put it between the Tent of Meeting and 
                the alter, and you shall put water in it.';

            break;
            case 'exo30_17-21':

                $tmp_verse_array['REFERENCE'][0]        = '30:17-21';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'And Jehovah spoke to Moses, saying, You shall also make a laver of bronze, with its base of bronze, for washing. And you shall put it between the Tent of Meeting and the alter, and you shall put water in it. And Aaron and his sons shall wash their hands and their feet from it; When they go into the Tent of Meeting, they shall wash with water, that they many not die;';
                $tmp_verse_array['COPY'][0]             = 'And Jehovah spoke to Moses, saying, You shall also make a laver of 
                bronze, with its base of bronze, for washing. And you shall put it between the Tent of Meeting and 
                the alter, and you shall put water in it. And Aaron and his sons shall wash their hands and their 
                feet <em>with water</em> from it; When they go into the Tent of Meeting, they shall wash with water, 
                that they many not die; or when they come near to the alter to minister, to burn an offering by fire 
                to Jehovah, They shall wash their hands and their feet, that they may not die. And it shall be a 
                perpetual statute to them, for him and for his seed throughout<br>their generations.';

            break;
            case 'lev2_1':

                $tmp_verse_array['REFERENCE'][0]        = '2:1';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'And when anyone presents an offering of a meal offering to Jehovah, his offering shall be of fine flour; and he shall pour oil on it and put frankincense on it.';
                $tmp_verse_array['COPY'][0]             = 'And when anyone presents an offering of a meal offering to Jehovah, 
                his offering shall be of <span class="script_sup">2</span>fine flour; and he shall pour oil on it 
                and put frankincense on it.';

            break;
            case 'lev18_1-5,24-28':

                $tmp_verse_array['REFERENCE'][0]        = '18:1-5, 24-28';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = '1 Then Jehovah spoke to Moses, saying, Speak to the children of Israel, and say to them, I am Jehovah your God. You shall not do as they do in the land of Egypt, in which you dwelt; and you shall not do as they do in the land of Canaan, where I am bringing you, nor shall you walk in their statutes.';
                $tmp_verse_array['COPY'][0]             = '<span class="script_ref_num">1</span> Then Jehovah spoke to Moses, 
                saying, Speak to the children of Israel, and say to them, I am Jehovah your God. You shall not do as 
                they do in the land of Egypt, in which you dwelt; and you shall not do as they do in the land of Canaan, 
                where I am bringing you, nor shall you walk in their statutes. 

                <div class="cb_10"></div>
                You shall observe My ordinances, and you shall keep My statutes to walk in them; I am Jehovah your God. 
                So you shall keep My statutes and My ordinances, by which, if a man does them, he will live; 

                <div class="cb_10"></div>
                I am Jehovah.

                <div class="cb_10"></div>
                <span class="script_ref_num">24</span> Do not defile yourselves in any of these things, for by all these 
                the nations which I am casting out before you have defiled themselves. Because the land has become 
                defiled, I visited its iniquity upon it, and the land vomited out its inhabitants.

                <div class="cb_10"></div>
                You therefore shall keep My statutes and My ordinances, and shall not do any of these abominations, 
                neither the native nor the sojourner who sojourns among you (For the men of the land who were before you 
                have done all these abominations, and the land has become defiled); 

                <div class="cb_10"></div>
                That the land does not vomit you out when you defile it, as it vomited out the nation which was before 
                you. For all who do any of these abominations, those persons who do them shall be cut off from among 
                their people. Therefore you shall keep My charge, so that you do not commit any of these abominable 
                customs which were committed before you, and you do not defile yourselves by them; 

                <div class="cb_10"></div>
                I am Jehovah your God.';

            break;
            case 'lev26_3-13':

                $tmp_verse_array['REFERENCE'][0]        = '26:3-13';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'If you walk in My statutes and keep My commandments and do them, Then I will give you your rains in their season, and the land will yield its produce, and the trees of the field will yield their fruit.';
                $tmp_verse_array['COPY'][0]             = 'If you walk in My statutes and keep My commandments and do them, Then I 
                will give you your rains in their season, and the land will yield its produce, and the trees of the 
                field will yield their fruit.

                <div class="cb_10"></div>
                Indeed your threshing will overtake the vintage, and the vintage will overtake the sowing time. Thus you 
                will eat your bread unto satisfaction and dwell securely in your land. And I will give you peace in the 
                land, so that you will lie down and no one will make you afraid; and I will cause wild beasts to cease 
                out of your land, and no sword will pass through your land.

                <div class="cb_10"></div>
                And you will chase your enemies, and they will fall by the sword before you. And five of you will chase 
                a hundred, and a hundred of you will chase ten thousand; and your enemies will fall by the sword before 
                you. And I will turn My face toward you and make you fruitful and multiply you, and I will establish My 
                covenant with you. And you will eat the old supply long stored and will have to clear out the old 
                because of the new.

                <div class="cb_10"></div>
                And I will set My tabernacle among you; and My soul will not abhor you. And I will walk among you and be 
                your God, and you will be My people. I am Jehovah your God, who brought you out of the land of Egypt so 
                that you should not be their slaves; and I have broken the bars of your yoke and made you walk upright.';

            break;
            case 'lev26_3,11b-12':

                $tmp_verse_array['REFERENCE'][0]        = '26:3, 11b-12';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = '3 If you walk in My statutes and keep My commandments and do them, 11b My soul will not abhor you. And I will walk among you and be your God, and you will be My people.';
                $tmp_verse_array['COPY'][0]             = '<span class="script_ref_num">3</span> If you walk in My statutes and 
                keep My commandments and<br>do them,

                <div class="cb_10"></div>
                <span class="script_ref_num">11b</span> My soul will not abhor you. And I will walk among you and be 
                your God, and you will be My people.';

            break;
            case 'num14_31':
            case 'num14_31[000]':

                $tmp_verse_array['REFERENCE'][0]        = '14:31';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'But your little ones, whom you said would become plunder, I will bring in, and they will know the land which you have rejected.';
                $tmp_verse_array['COPY'][0]             = 'But your little ones, whom you said would become plunder, I will 
                bring in, and they will know the land which you have rejected.';

            break;
            case 'num14_29-30':

                $tmp_verse_array['REFERENCE'][0]        = '14:29-30';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'Your corpses shall fall in this wilderness, and none of you who were numbered, according to the number you counted from twenty years old and upward, who have murmured against Me, Shall come into the land, in which I swore to settle you, except Caleb the son of Jephunneh and Joshua the son Nun.';
                $tmp_verse_array['COPY'][0]             = 'Your corpses shall fall in this wilderness, and none of you
                who were numbered, according to the number you counted from twenty years old and upward, who have 
                murmured against Me, Shall come into the land, in which I swore to settle you, except Caleb the son 
                of Jephunneh and Joshua the son Nun.';

            break;
            case 'num14_35':

                $tmp_verse_array['REFERENCE'][0]        = '14:35';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'I, Jehovah, have spoken; surely I will do this to all this evil assembly who are gathered together against Me. In this wilderness they shall be consumed, and there they shall die.';
                $tmp_verse_array['COPY'][0]             = 'I, Jehovah, have spoken; surely I will do this to all this evil 
                assembly who are gathered together against Me. In this wilderness they shall be consumed, and there 
                they shall die.';

            break;
            case 'num25_1-13':

                $tmp_verse_array['REFERENCE'][0]        = '25:1-13';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'While Israel dwelt in Shittim, the people began to commit fornication with the daughters of Moab. For they invited the people to the sacrifices of their gods, and the people ate and bowed down to their gods. And Israel joined itself to Baal-peor, and the anger of Jehovah was kindled against Israel.';
                $tmp_verse_array['COPY'][0]             = 'While Israel dwelt in Shittim, the people began to commit fornication 
                with the daughters of Moab. For they invited the people to the sacrifices of their gods, and the 
                people ate and bowed down to their gods. And Israel joined itself to Baal-peor, and the anger of 
                Jehovah was kindled against Israel. And Jehovah said to Moses, Take all the leaders of the people 
                and hang them up to Jehovah before the sun, so that the fierce anger of Jehovah may turn away from 
                Israel. And Moses said to the judges of Israel, Each of you slay his men who have joined themselves 
                to Baal-peor. 

                <div class="cb_10"></div>
                Just then one of the children of Israel came and brought a Midianite woman to his brothers in the 
                sight of Moses and on the sight of the whole assembly of the children of Israel, while they were 
                weeping at the entrance of the Tent of Meeting. And when Phinehas the son of Eleazar, the son of 
                Aaron the priest, saw it, he rose up from the midst of the assembly and took a spear in his hand, 

                <div class="cb_10"></div>
                And he went after the man of Israel into the tent and pierced both of them, the man of Israel and 
                the woman through her stomach. So the plague among the children of Israel was stopped. And those who 
                died by the plague were twenty-four thousand.

                <div class="cb_10"></div>
                Then Jehovah spoke to Moses, saying, Phinehas the son of Eleazar, the son of Aaron the priest, has 
                turned My wrath away from the children of Israel, in that he was jealous with My jealousy among them, 
                so that I did not consume the children of Israel in My jealousy.

                <div class="cb_10"></div>
                Therefore say, I now give him My covenant of peace; And it shall be to him and to his seed after him 
                the covenant of an everlasting priesthood, because he was jealous for his God and made expiation for 
                the children of Israel.';

            break;
            case 'num32_13':

                $tmp_verse_array['REFERENCE'][0]        = '32:13';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'And Jehovah\'s anger was kindled against Israel, He made them wander in the wilderness forty years, until the whole generation which had done evil in the sight of Jehovah was consumed.';
                $tmp_verse_array['COPY'][0]             = 'And Jehovah\'s anger was kindled against Israel, He made 
                them wander in the wilderness forty years, until the whole generation which had done evil in the 
                sight of Jehovah was consumed.';

            break;
            case 'num33_50-54':

                $tmp_verse_array['REFERENCE'][0]        = '33:50-56';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'Then Jehovah spoke to Moses in the plains of Moab by the Jordan at Jericho, saying, Speak to the children of Israel, and say to them, When you pass over the Jordan into the land of Canaan, You shall drive out all the inhabitants of the land from before you, and you shall destroy all their figured stones and destroy all their molten images and demolish all their high places;';
                $tmp_verse_array['COPY'][0]             = 'Then Jehovah spoke to Moses in the plains of Moab by the 
                Jordan at Jericho, saying, Speak to the children of Israel, and say to them, When you pass over the 
                Jordan into the land of Canaan, You shall drive out all the inhabitants of the land from before you, 
                and you shall destroy all their figured stones and destroy all their molten images and demolish all 
                their high places; 

                <div class="cb_10"></div>
                And you shall take possession of the land and dwell in it, for to you I have given the land to 
                possess it. And you shall inherit the land by lot according to your families; to the larger you 
                shall give a larger inheritance, and to the smaller you shall give a smaller inheritance. Wherever 
                the lot falls to anyone, that shall be his. You shall inherit according to the tribes of 
                your fathers.

                <div class="cb_10"></div>
                But if you do not drive out the inhabitants of the land from before you, then those whom you let 
                remain of them will become as splinters in your eyes and as thorns in your sides, and they will 
                trouble you in the land in which you are dwelling. And just as I thought to do to them, so will I do 
                to you.';

            break;
            case 'deut4_1-2,39-40':

                $tmp_verse_array['REFERENCE'][0]        = '4:1-2, 39-40';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = '1 And now, O Israel, listen to the statutes and the ordinances which I am teaching you to do, in order that you may live and go in and possess the land which Jehovah, the God of your fathers, is giving you.';
                $tmp_verse_array['COPY'][0]             = '<span class="script_ref_num">1</span> And now, O Israel, listen to the 
                statutes and the ordinances which I am teaching you to do, in order that you may live and go in and 
                possess the land which Jehovah, the God of your fathers, is giving you. You shall not add to the word which I 
                am commanding you, nor shall you take away from it, that you may keep the commandments of Jehovah your 
                God, which I am commanding you.

                <div class="cb_10"></div>
                <span class="script_ref_num">39</span> Know therefore today and bring it to heart that Jehovah is God in 
                heaven above and upon the earth below; there is no other. Therefore keep His statutes and His 
                commandments, which I am commanding you today, that it may go well with you and with your children after 
                you, so that you may extend your days upon the land which Jehovah your God is giving you forever.';

            break;
            case 'deut5_10,29':

                $tmp_verse_array['REFERENCE'][0]        = '5:10, 29';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = '10 Yet showing lovingkindness to thousands of generations of those who love Me and keep My commandments. 29 Oh that this heart of theirs would be in them always to fear Me and keep all My commandments so that it may go well with them and with their children forever!';
                $tmp_verse_array['COPY'][0]             = '<span class="script_ref_num">10</span> Yet showing lovingkindness to 
                thousands of generations of those who love Me and keep My commandments.

                <div class="cb_10"></div>
                <span class="script_ref_num">29</span> Oh that this heart of theirs would be in them always to fear Me 
                and keep all My commandments so that it may go well with them and with their children forever!';

            break;
            case 'deut6_1-6,16-25':

                $tmp_verse_array['REFERENCE'][0]        = '6:1-6, 16-25';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = '1 Now this is the commandment, the statutes and the ordinances, which Jehovah your God has commanded me to teach you, that you may do them in the land into which you are crossing over to possess;';
                $tmp_verse_array['COPY'][0]             = '<span class="script_ref_num">1</span> Now this is the commandment, the 
                statutes and the ordinances, which Jehovah your God has commanded me to teach you, that you may do them 
                in the land into which you are crossing over to possess; That you may fear Jehovah your God and keep all 
                His statutes and His commandments, which I am commanding you, you and your son and your grandson, all 
                the days of your life; and that your days may be extended. 

                <div class="cb_10"></div>
                Therefore hear, O Israel, and be certain to do it, that it may go well with you and that you may be 
                greatly increased, in a land flowing with milk and honey, even as Jehovah, the God of your fathers, 
                promised you.

                <div class="cb_10"></div>
                Hear, O Israel, Jehovah is our God; Jehovah is one. And you shall love Jehovah your God with all your 
                heart and with all your soul and with all your might. And these words, which I command you today, shall 
                be upon your heart;

                <div class="cb_10"></div>
                <span class="script_ref_num">16</span> You shall not test Jehovah your God, as you tested Him at Massah. 
                You shall diligently keep the commandments of Jehovah your God and His testimonies and His statutes, 
                which He has commanded you. And you shall do that which is right and good in the sight of Jehovah so 
                that it may go well with you and you may enter and possess the good land, concerning which Jehovah swore 
                to your fathers To drive out all your enemies from before you, as Jehovah has spoken.

                <div class="cb_10"></div>
                When your son asks you in the future, saying, What is the significance of the testimonies and the statutes 
                and the ordinances that Jehovah our God commanded you? Then you will say to your son, We were Pharaoh\'s 
                slaves in Egypt, and Jehovah brought us out of Egypt with a mighty hand. And Jehovah put forth before 
                our eyes great and grievous signs and wonders in Egypt against Pharaoh and all his house. Then He brought 
                us out from there in order to bring us in, that He might give us the land which He swore to our fathers. 

                <div class="cb_10"></div>
                And Jehovah commanded us to do all these statutes so that we would fear Jehovah our God for our good 
                always and He would preserve us alive, as we are this day. And it will be righteousness to us if we are 
                certain to do all this commandment before Jehovah our God, as He commanded us.';

            break;
            case 'deut6_25':

                $tmp_verse_array['REFERENCE'][0]        = '6:25';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'And it will be righteousness to us if we are certain to do all this commandment before Jehovah our God, as He commanded us.';
                $tmp_verse_array['COPY'][0]             = 'And it will be righteousness to us if we are certain to do all this 
                commandment before Jehovah our God, as He commanded us.';

            break;
            case 'deut7_9-26':

                $tmp_verse_array['REFERENCE'][0]        = '7:9-26';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'Know therefore that it is Jehovah your God who is God, the faithful God who keeps covenant and lovingkindness to the thousandth generation with those who love him and keep His commandments,';
                $tmp_verse_array['COPY'][0]             = 'Know therefore that it is Jehovah your God who is God, the faithful God 
                who keeps covenant and lovingkindness to the thousandth generation with those who love him and keep His 
                commandments, But repays directly those who hate Him by destroying them. He will not be slow toward him 
                who hates Him; He will repay him directly.

                <div class="cb_10"></div>
                Therefore you shall keep the commandment, and the statutes and the ordinances, which I am commanding you 
                today to do. And it will be that because you listen to these ordinances, and keep them and do them, 
                Jehovah your God will keep with you the covenant and the lovingkindness which He swore to your fathers. 

                <div class="cb_10"></div>
                And He will love you and bless you and multiply you; He will also bless the fruit of your womb and the 
                fruit of your ground, your grain and your new wine and your fresh oil, the offspring of your cattle and 
                the young of your flock, on the land which He swore to your fathers to give you.

                <div class="cb_10"></div>
                You will be more blessed than all other peoples; there will not be any barren male or female among you 
                or among your animals. And Jehovah will remove every sickness from you, and none of the evil illnesses 
                of Egypt, which you know about, will He put upon you; but He will give them to all who hate you.

                <div class="cb_10"></div>
                And you shall devour all the peoples which Jehovah your God is giving you; your eye shall not pity them, 
                nor shall you serve their gods, for that would be a snare to you. 

                <div class="cb_10"></div>
                If you say in your heart, These nations are greater than I, how will I be able to dispossess them? You 
                shall not be afraid of them; you must remember what Jehovah your God did to Pharaoh and to all Egypt, 
                The great trials that your eyes saw, and the signs and the wonders, and the mighty hand and the 
                outstretched arm with which Jehovah your God brought you out; so will Jehovah your God do to all the 
                peoples whom you are afraid of.

                <div class="cb_10"></div>
                Furthermore, Jehovah your God will send the hornet among them until those who are left and those who 
                hide themselves from you are destroyed. You shall not be terrified of them, for Jehovah your God is in 
                your midst, a great and awesome God.

                <div class="cb_10"></div>
                And Jehovah your God will clear away these nations from before you little by little; you shall not 
                devour all of them immediately, lest the beasts of the field multiply against you. But Jehovah your God 
                will deliver them up before you and rout them utterly until they<br>are destroyed.

                <div class="cb_10"></div>
                And He will deliver their kings into your hand, and you shall destroy their name from under heaven; no 
                man will be able to stand against you until you destroy them. The idols of their gods you shall burn 
                with fire; you shall not desire the silver or gold upon them, nor take it for yourself, lest you be 
                ensnared by it; for it is an abomination to Jehovah your God. And you shall not bring an abomination 
                into your house, lest you become a cursed thing like it; you shall utterly detest it and utterly abhor 
                it, for it is a cursed thing.';

            break;
            case 'deut8_1-10':

                $tmp_verse_array['REFERENCE'][0]        = '8:1-10';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'The whole commandment which I am commanding you today, you shall keep and do, so that you may live and multiply, and enter and possess the land which Jehovah swore to your fathers.';
                $tmp_verse_array['COPY'][0]             = 'The whole commandment which I am commanding you today, you shall keep and 
                do, so that you may live and multiply, and enter and possess the land which Jehovah swore to your 
                fathers. And you shall remember all the way that Jehovah your God has led you these forty years in the 
                wilderness in order to humble you and test you to know what was in your heart, whether you would keep 
                His commandments or not.

                <div class="cb_10"></div>
                And He humbled you and let you go hungry and fed you the manna, which you had never known nor your 
                fathers had ever known, so that He might make you know that man lives not by bread alone, but that man 
                lives by everything that proceeds out from the mouth<br>of Jehovah.

                <div class="cb_10"></div>
                Your clothing did not wear out from upon you, nor did your foot swell these forty years. Know then in 
                your heart that as a man disciplines his son, so Jehovah your God was disciplining you;

                <div class="cb_10"></div>
                Therefore keep the commandments of Jehovah your God, walking in His ways and fearing Him. 

                <div class="cb_10"></div>
                For Jehovah your God is bringing you to a good land, a land of waterbrooks, of springs and of fountains, 
                flowing forth in valleys and in mountians; A land of wheat and barley and vines and fig trees and 
                pomegranates; a land of olive trees with oil and of honey; A land in which you will eat bread without 
                scarcity; you will not lack anything in it; a land whose stones are iron, and from whose mountains you 
                can mine copper.

                <div class="cb_10"></div>
                And you shall eat and be satisfied, and you shall bless Jehovah your God for the good land which He has 
                given you.';

            break;
            case 'deut10_14-22':

                $tmp_verse_array['REFERENCE'][0]        = '10:14-22';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'Behold, heaven and the heaven of heavens belong to Jehovah your God, the earth and all that is in it. But on your fathers Jehovah set His affection to love them and to choose their seed after them, that is, you above all the peoples, as it is this day. Circumcise then the foreskin of your heart, and do not be stiff-necked any longer;';
                $tmp_verse_array['COPY'][0]             = 'Behold, heaven and the heaven of heavens belong to Jehovah your God, 
                the earth and all that is in it. But on your fathers Jehovah set His affection to love them and to 
                choose their seed after them, that is, you above all the peoples, as it is this day. Circumcise then 
                the foreskin of your heart, and do not be stiff-necked any longer; For it is Jehovah your God who 
                is the God of gods and the Lord of lords, the great God, mighty and awesome, who does not regard 
                persons and does not take bribes; He executes justice for the orphan and the widow, and He loves the 
                sojourner, giving him food and clothing.

                <div class="cb_10"></div>
                Therefore love the sojourner, for you were sojourners in the land of Egypt. You shall fear Jehovah 
                your God; Him shall you serve and to Him shall you hold fast and by His name shall you swear. He is 
                your praise and He is your God, who has done these great and awesome things for you, which your eyes 
                have seen. Your fathers went down into Egypt as seventy souls; and now Jehovah your God has made 
                you as the stars of heaven in multitude.';

            break;
            case 'deut11_14':

                $tmp_verse_array['REFERENCE'][0]        = '11:14';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'I will give rain for your land in its season, the early rain and the late rain, so that you may gather your grain and your new wine and your fresh oil.';
                $tmp_verse_array['COPY'][0]             = 'I will give rain for your land in its season, the early rain and the 
                late rain, so that you may gather your grain and your new wine and your fresh oil.';

            break;
            case 'deut11_1,8-15,22-28':

                $tmp_verse_array['REFERENCE'][0]        = '11:1, 8-15, 22-28';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = '1 Therefore you shall love Jehovah your God and keep His charge and His statutes and His ordinances and His commandments always. 8 Therefore you shall keep the whole commandment which I am commanding you today so that you may be strong and that you may go in and possess the land into which you are crossing over to possess,';
                $tmp_verse_array['COPY'][0]             = '<span class="script_ref_num">1</span> Therefore you shall love Jehovah 
                your God and keep His charge and His statutes and His ordinances and His<br>commandments always.

                <div class="cb_10"></div>
                <span class="script_ref_num">8</span> Therefore you shall keep the whole commandment which I am 
                commanding you today so that you may be strong and that you may go in and possess the land into which 
                you are crossing over to possess, And so that you may extend your days upon the ground which Jehovah 
                swore to your fathers, to give to them and to their seed, a land flowing with milk and honey.

                <div class="cb_10"></div>
                For the land which you are entering in to possess is not like the land of Egypt, from which you came 
                forth, where you used to sow your seed and water by foot as in a vegetable garden. But the land into 
                which you are crossing over to possess is a land of mountains and valleys; by virtue of heaven\'s rain, 
                it drinks in water.

                <div class="cb_10"></div>
                It is a land which Jehovah your God cares for; always the eyes of Jehovah your God are upon it, from the 
                beginning of the year even to the end of the year. And if you are certain to listen to my commandments, 
                which I am commanding you today, to love Jehovah your God and serve Him with all your heart and with all 
                your soul, I will give rain for your land in its season, the early rain and the late rain, so that you 
                may gather your grain and your new wine and your fresh oil. And I will put grass in your field for your 
                cattle, and you will eat and be satisfied.

                <div class="cb_10"></div>
                <span class="script_ref_num">22</span> For if you are certain to keep all this commandment which I am 
                commanding you to do, to love Jehovah your God, to walk in all His ways and hold fast to Him, Jehovah 
                will dispossess all these nations from before you, and you will dispossess nations greater and mightier 
                than you.

                <div class="cb_10"></div>
                Every place on which the sole of your foot treads will be yours; from the wilderness and Lebanon, from 
                the river, the river Euphrates, even to the farmost sea will be your territory. No man will be able to 
                stand against you; Jehovah your God will put the dread and fear of you upon all the land on which you 
                tread, as He has spoken to you.

                <div class="cb_10"></div>
                See, I am setting before you today a blessing and a curse: The blessing, if you listen to the 
                commandments of Jehovah your God, which I am commanding you today; And the curse, if you do not listen 
                to the commandments of Jehovah your God and you turn aside from the way which I am commanding you today, 
                to go after other gods whom you have not known.';

            break;
            case 'deut26_16-19':

                $tmp_verse_array['REFERENCE'][0]        = '26:16-19';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'This day Jehovah your God is commanding you to do these statutes and ordinances; therefore you shall keep them and do them with all your heart and with all your soul. It is Jehovah whom you have today declared to be your God and that you will walk in His ways and keep His statutes and His commandments and His ordinances, and will listen to His voice.';
                $tmp_verse_array['COPY'][0]             = 'This day Jehovah your God is commanding you to do these statutes and 
                ordinances; therefore you shall keep them and do them with all your heart and with all your soul. It is 
                Jehovah whom you have today declared to be your God and that you will walk in His ways and keep His 
                statutes and His commandments and His ordinances, and will listen to His voice. 

                <div class="cb_10"></div>
                And it is Jehovah who has today declared you to be a people for His personal treasure, even as He 
                promised you; and that you will keep all His commandments; And that He will set you high above all the 
                nations which He has made, for praise and for a name and for honor; and that you will be a holy people 
                to Jehovah your God, as He<br>has spoken.';

            break;
            case 'deut28_1-14':

                $tmp_verse_array['REFERENCE'][0]        = '28:1-14';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'And if you listen diligently to the voice of Jehovah your God and are certain to do all His commandments, which I am commanding you today, Jehovah your God will set you high above all the nations of the earth;';
                $tmp_verse_array['COPY'][0]             = 'And if you listen diligently to the voice of Jehovah your God and are 
                certain to do all His commandments, which I am commanding you today, Jehovah your God will set you high 
                above all the nations of the earth; And all these blessings will come upon you and overtake you if you 
                listen to the voice of Jehovah your God.

                <div class="cb_10"></div>
                Blessed shall you be in the city, and blessed shall you be in the field. Blessed shall be the fruit of 
                your womb and the fruit of your ground and the fruit of your animals, the offspring of your cattle and 
                the young of your flock. 

                <div class="cb_10"></div>
                Blessed shall be your basket and your kneading bowl. Blessed shall you be when you come in, and blessed 
                shall you be when you go out. Jehovah will cause your enemies, who rise up against you, to be struck 
                down before you; on one road they will come out against you, but on seven roads they will flee before 
                you.

                <div class="cb_10"></div>
                Jehovah will command the blessing upon you in your storehouses and in all your undertakings; and He will 
                bless you in the land which Jehovah your God is giving you. Jehovah will establish you as a holy people 
                to Himself, as He swore to you, if you keep the commandments of Jehovah your God and walk in His ways.

                <div class="cb_10"></div>
                And all the peoples of the earth will see that you are called by Jehovah\'s name, and they will be 
                afraid of you. And Jehovah will give you an excess of prosperity in the fruit of your womb and in the 
                fruit of your animals and in the fruit of your ground, upon the ground which Jehovah swore to your 
                fathers to give you.

                <div class="cb_10"></div>
                Jehovah will open up to you His good treasury, the heavens, to give rain for your land in its season and 
                to bless all your undertakings. And you will lend to many nations, but you will not borrow. And Jehovah 
                will make you the head and not the tail, and you will tend only upward, and you will not tend downward, 
                if you will listen to the commandments of Jehovah your God, which I am commanding you today to keep and 
                to do.

                <div class="cb_10"></div>
                And you shall not turn aside from any of the words which I am commanding you today, to the right or to 
                the left, to go after other gods to serve them.';

            break;
            case 'deut30_11-20':

                $tmp_verse_array['REFERENCE'][0]        = '30:11-20';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'For this commandment which I am commanding you today, it is not too difficult for you, nor is it distant. It is not in heaven that you should say, Who will ascend to heaven for us and bring it to us to make us hear it and do it?';
                $tmp_verse_array['COPY'][0]             = 'For this commandment which I am commanding you today, it is not too 
                difficult for you, nor is it distant. It is not in heaven that you should say, Who will ascend to heaven 
                for us and bring it to us to make us hear it and do it? Nor is it across the sea that you should say, 
                Who will go across the sea for us and bring it to us to make us hear it and do it?

                <div class="cb_10"></div>
                But the word is very near to you, even in your mouth and in your heart, that you may do it. See, I have 
                put before you today life and good, and death and evil. If you obey the commandments of Jehovah your God, 
                which I am commanding you today, to love Jehovah your God and walk in His ways and keep His commandments 
                and His statutes and His ordinances, then you will live and multiply, and Jehovah your God will bless 
                you in the land which you are entering to possess.

                <div class="cb_10"></div>
                But if your heart turns and you do not listen, but rather you are drawn away in worship to other gods 
                and serve them, I declare to you today that you shall surely perish; your days will not be extended upon the 
                land into which you are crossing over the Jordan to go and possess.

                <div class="cb_10"></div>
                I call heaven and earth to witness against you today: I have set before you life and death, blessing and 
                curse; therefore choose life that you and your seed may live, In loving Jehovah your God by listening to 
                His voice and holding fast to Him; for He is your life and the length of your days, that you may dwell 
                upon the land which Jehovah swore to your fathers, to Abraham, to Issac, and to Jacob, to give them.';

            break;
            case 'deut33_1-4,12,29':

                $tmp_verse_array['REFERENCE'][0]        = '33:1-4, 12, 29';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = '1 And this is the blessing with which Moses, the man of God, / blessed the children of Israel before his death. / And he said, / Jehovah came from Sinai, / And He dawned upon them from Seir; / He shined forth from Mount Paran, / And He approached from the myriads of holy ones; / From His right hand a fiery law out to them.';
                $tmp_verse_array['COPY'][0]             = '<span class="script_ref_num">1</span> And this is the blessing with 
                which Moses, the man of God,<br>
                blessed the children of Israel before his death.<br>

                <div class="cb_5"></div>
                And he said,<br>
                Jehovah came from Sinai,<br>
                &nbsp;&nbsp;&nbsp;And He dawned upon them from Seir;<br>
                He shined forth from Mount Paran,<br>
                &nbsp;&nbsp;&nbsp;And He approached from the myriads of holy ones;<br>
                &nbsp;&nbsp;&nbsp;From His right hand a fiery law <em>went</em> out to them.<br>

                <div class="cb_5"></div>
                Indeed, He loves the people.<br>
                &nbsp;&nbsp;&nbsp;All His saints were in Your hand,<br>
                And they sat down at Your feet;<br>
                &nbsp;&nbsp;&nbsp;<em>Everyone</em> receives of Your words.<br>

                <div class="cb_5"></div>
                Moses commanded us a law,<br>
                &nbsp;&nbsp;&nbsp;A possession of the congregation of Jacob.<br>

                <div class="cb_10"></div>
                <span class="script_ref_num">12</span> Concerning Benjamin he said,<br>
                The beloved of Jehovah shall dwell securely beside Him;<br>
                &nbsp;&nbsp;&nbsp;<em>Jehovah</em> shall cover over him all the day,<br>
                &nbsp;&nbsp;&nbsp;And He shall dwell between his shoulders.<br>

                <div class="cb_10"></div>
                <span class="script_ref_num">29</span> Happy are you, O Israel; who is like you?<br>
                &nbsp;&nbsp;&nbsp;A people saved by Jehovah,<br>
                The shield of your help<br>
                &nbsp;&nbsp;&nbsp;And <em>He</em> who is the sword of your majesty!<br>
                So your enemies shall come cringing to you,<br>
                &nbsp;&nbsp;&nbsp;And you shall tread upon their high places.';

            break;
            case 'josh5_6':

                $tmp_verse_array['REFERENCE'][0]        = '5:6';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'For the children of Israel went for forty years through the wilderness until all the nation, the men of war who had come out of Egypt, were consumed, because they did not listen to the voice of Jehovah, they to whom Jehovah swore that they would not see the land that Jehovah has sworn to their fathers to give us, a land flowing with milk and honey.';
                $tmp_verse_array['COPY'][0]             = 'For the children of Israel went for forty years through the 
                wilderness until all the nation, the men of war who had come out of Egypt, were consumed, because 
                they did not listen to the voice of Jehovah, they to whom Jehovah swore that they would not see the 
                land that Jehovah has sworn to their fathers to give us, a land flowing with milk and honey.';

            break;
            case '1sam4_4':

                $tmp_verse_array['REFERENCE'][0]        = '4:4';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'So the people sent to Shiloh, and they took up from there the Ark of the Covenant of Jehovah of hosts who is enthroned the cherubim. And the two sons of Eli, Hophni and Phinehas, were there with the Ark of the Covenant of God.';
                $tmp_verse_array['COPY'][0]             = 'So the people sent <em>men</em> to Shiloh, and they took up from 
                there the Ark of the Covenant of Jehovah of hosts who is enthroned <em>between</em> the cherubim. 
                And the two sons of Eli, Hophni and Phinehas, were there with the Ark of the Covenant of God.';

            break;
            case '1kings2_1-3':

                $tmp_verse_array['REFERENCE'][0]        = '2:1-3';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'When David\'s time to die drew near, he commanded Solomon his son, saying, I am going the way of all the earth. Be strong therefore and be a man; And keep the charge of Jehovah your God by walking in His ways, by keeping His statutes, His commandments, and His ordinances and His testimonies as they are written in the law of Moses, that you may prosper in all that you do and wherever you turn;';
                $tmp_verse_array['COPY'][0]             = 'When David\'s time to die drew near, he commanded Solomon his son, 
                saying, I am going the way of all the earth. Be strong therefore and be a man; And keep the charge 
                of Jehovah your God by walking in His ways, by keeping His statutes, His commandments, and His 
                ordinances and His testimonies as they are written in the law of Moses, that you may prosper in all 
                that you do and wherever<br>you turn;';

            break;
            case '1kings8_54-66':

                $tmp_verse_array['REFERENCE'][0]        = '8:54-66';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'And when Solomon has finished praying all this prayer and supplication to Jehovah, he rose up from before the alter of Jehovah, from kneeling on his knees with his hands spread toward the heavens. And he stood and blessed the whole congregation of Israel with a loud voice, saying,';
                $tmp_verse_array['COPY'][0]             = 'And when Solomon has finished praying all this prayer and supplication to 
                Jehovah, he rose up from before the alter of Jehovah, from kneeling on his knees with his hands spread 
                toward the heavens. And he stood and blessed the whole congregation of Israel with a loud voice, saying,

                <div class="cb_10"></div>
                Blessed be Jehovah, who has given rest to His people Israel, according to all that He promised. Not one 
                word of all His good promises which He spoke through Moses His servant has failed. May Jehovah our God 
                be with us, as He was with our fathers; let Him not forsake us nor abandon us, That He may incline our 
                hearts to Himself, to walk in all His ways and to keep His commandments and His statutes and His 
                ordinances, which He commanded our fathers.

                <div class="cb_10"></div>
                And let these words of mine, with which I made supplication to Jehovah, be near to Jehovah our God day 
                and night to maintain the cause of His servant and the cause of His people Israel as each day requires;
                That all the peoples of the earth may know that Jehovah is God; there is none else. Let your heart 
                therefore be perfect with Jehovah our God, to walk in His statutes and to keep His commandments as on 
                this day.

                <div class="cb_10"></div>
                And the king and all Israel with Him offered sacrifices before Jehovah. And Solomon offered a sacrifice 
                of peace offerings, which he offered to Jehovah: twenty-two thousand oxen and one hundred and twenty 
                thousand sheep. Thus the king and all the children of Israel dedicated the house of Jehovah.

                <div class="cb_10"></div>
                On that day the king sanctified the middle of the court that was before the house of Jehovah, for there 
                he offered the burnt offering and the meal offering and the fat of peace offerings because the bronze 
                alter which was before Jehovah was too small to receive the burnt offering and the meal offering and the 
                fat of peace offerings.

                <div class="cb_10"></div>
                And Solomon held a feast at that time and all Israel with him, a great congregation, from the entrance 
                of Hamath to the brook of Egypt, before Jehovah our God, seven days and seven more days, fourteen days 
                in all. On the eight day he sent the people away, and they blessed the king and went to their tents 
                joyful and happy in heart for all the goodness which Jehovah had shown to David His servant and to 
                Israel His people.';

            break;
            case '1kings18_37-40,45;19_1-18':

                $tmp_verse_array['REFERENCE'][0]        = '18:37-40, 45; 19:1-18';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = '37 Answer me, O Jehovah; answer me, that this people may know that You, O Jehovah, are God and that You have turned their heart back again. And the fire of Jehovah fell and consumed the burnt offering and the wood and the stones and the dust, and it licked up the water that was in the trench.';
                $tmp_verse_array['COPY'][0]             = '<span class="script_ref_num">37</span> Answer me, O Jehovah; answer me, 
                that this people may know that You, O Jehovah, are God and that You have turned their heart back again. 
                And the fire of Jehovah fell and consumed the burnt offering and the wood and the stones and the dust, 
                and it licked up the water that was in the trench.

                <div class="cb_10"></div>
                And when the people saw this, they fell on their faces and said, Jehovah&ndash;&ndash;He is God! 
                Jehovah&ndash;&ndash;He is God!

                <div class="cb_10"></div>
                And Elijah said to them, Seize the prophets of Baal; let not one of them escape! And they seized them, 
                and Elijah brought them down to the brook Kishon and slaughtered them there.

                <div class="cb_10"></div>
                <span class="script_ref_num">45</span> And in the meantime the heavens became black with clouds, and 
                there was wind and a great rain. And Ahab mounted his chariot and went to Jezreel.

                <div class="cb_10"></div>
                And the hand of Jehovah was upon Elijah; and he girded up his loins and ran before Ahab to the 
                entrance of Jezreel. And Ahab told Jezebel all that Elijah had done and all about how he had slain all 
                the prophets with the sword. And Jezebel sent a messenger to Elijah, saying, The gods do so to me and 
                even more, if by this time tomorrow I do not make your life like the life of one of them!

                <div class="cb_10"></div>
                And because he was afraid, he rose up and went away for his life; and he came to Beer-sheba, which 
                belongs to Judah, and left his attendant there. And he himself went a day\'s journey into the wilderness 
                and came and sat down under a certain broom shrub; and he requested for himself that he might die and 
                said, It is enough; now, O Jehovah, take my life, for I am no better than my fathers.

                <div class="cb_10"></div>
                And he lay down and slept under the broom shrub. And suddenly an angel touched him and said to him, Rise 
                up and eat. And he looked, and there at his head was a cake, baked on hot stones, and a jar of water. 
                And he ate and drank, and lay down again. And the angel of Jehovah came again the second time and 
                touched him and said, Rise up and eat; for the journey is too great for you. 

                <div class="cb_10"></div>
                And he rose up and ate and drank, and he went in the strength of that food forty days and forty nights 
                to Horeb the mount of God. And there he went into a cave and lodged there. And at that time the word of 
                Jehovah came to him; and He said to him, What are you doing here, Elijah?

                <div class="cb_10"></div>
                And he said, I have been very jealous for Jehovah the God of hosts; for the children of Israel have 
                forsaken Your covenant, thrown down Your alters, and slain Your prophets with the sword; and I alone am 
                left, and they seek to take my life.

                <div class="cb_10"></div>
                And He said, Go out, and stand upon the mountain before Jehovah. And suddenly Jehovah passed by, and a 
                great, strong wind rent the mountains and broke the rocks in pieces before Jehovah&ndash;&ndash;Jehovah 
                was not in the wind. And after the wind, an earthquake&ndash;&ndash;Jehovah was not in the earthquake.

                <div class="cb_10"></div>
                And after the earthquake, a fire&ndash;&ndash;Jehovah was not in the fire. And after the fire, a gentle, 
                quiet voice. And when Elijah heard it, he wrapped his face in his mantle and went out and stood at the 
                entrance of the cave. And then a voice came to him and said, What are you doing here, Elijah?

                <div class="cb_10"></div>
                And he said, I have been very jealous for Jehovah the God of hosts; for the children of Israel have 
                forsaken Your covenant, thrown down Your alters, and slain Your prophets with the sword; and I alone am 
                left, and they seek to take my life.

                <div class="cb_10"></div>
                And Jehovah said to him, Go; return on your way to the wilderness of Damascus; and when you come there, 
                anoint Hazael as king over Syria; And Jehu the son of Nimshi you shall anoint as king over Israel; and 
                Elisha the son of Shaphat of Abel-meholah you shall anoint as prophet in your place.

                <div class="cb_10"></div>
                And him who escapes the sword of Hazael, Jehu will kill; and him who escapes the sword of Jehu, Elisha 
                will kill.

                <div class="cb_10"></div>
                Yet I have left Myself seven thousand in Israel, all the knees that have not bowed unto Baal and every 
                mouth that has not kissed him.';

            break;
            case 'neh1_1-11':

                $tmp_verse_array['REFERENCE'][0]        = '1:1-11';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'The words of Nehemiah the son of Hacaliah. Now in the month of Chislev, in the twentieth year, while I was in Susa the capital, Hanani, one of my brothers, came, he and some men from Judah; and I asked them about the Jews who had escaped, who were left from the captivity, and about Jerusalem.';
                $tmp_verse_array['COPY'][0]             = 'The words of Nehemiah the son of Hacaliah. Now in the month of Chislev, 
                in the twentieth year, while I was in Susa the capital, Hanani, one of my brothers, came, he and some 
                men from Judah; and I asked them about the Jews who had escaped, who were left from the captivity, and 
                about Jerusalem.

                <div class="cb_10"></div>
                And they said to me, The remnant who are left from the captivity there in the province are in an 
                exceedingly bad state and reproach, and the wall of Jerusalem is broken down and its gates have been 
                burned with fire.

                <div class="cb_10"></div>
                And when I heard these words, I sat down and wept, and I mourned for some days; and I fasted and prayed 
                before the God of heaven, And I said, I beseech You, O Jehovah the God of heaven, the great and awesome 
                God, who keeps covenant and lovingkindness with those who love Him and keep His commandments: Let Your 
                ear be attentive and Your eyes open to hear the prayer of Your servant, which I pray before You now day 
                and night, concerning the children of Israel, Your servants, while I confess the sins of the children of 
                Israel that we have sinned against You. 

                <div class="cb_10"></div>
                Indeed, I and the house of my father have sinned; We have been most corrupt toward You and have not kept 
                the commandments and the statutes and the ordinances that You commanded Moses Your servant. Remember now 
                the word that You commanded Moses Your servant, saying, If you are unfaithful, I will scatter you among 
                the peoples; But if you return to Me and keep My commandments and perform them, though your outcasts are 
                under the ends of heaven, from there I will gather them and bring them to the place where I have chosen 
                to cause My name to dwell.

                <div class="cb_10"></div>
                Now these are Your servants and Your people, whom You have redeemed by Your great power and by Your 
                strong hand. I beseech You, O Lord, let Your ear be attentive to the prayer of Your servant and to the 
                prayer of Your servants, who take delight in fearing Your name; and cause Your servant to prosper today, 
                and grant him to find compassion before this man. 

                <div class="cb_10"></div>
                Now I was cupbearer to the king.';

            break;
            case 'psa24':

                $tmp_verse_array['REFERENCE'][0]        = '24';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'A Psalm of David. The earth is Jehovah\'s, and its fullness, / The habitable land and those who dwell in it. / For it is He who founded it upon the seas / And established it upon the streams. Who may ascend the mountain of Jehovah, / And who may stand in His holy place? / He who has clean hands and a pure heart, / Who has not lifted up his soul to falsehood Or sworn deceitfully. / He will receive blessing from Jehovah, / And righteousness from the God of His salvation. / This is the generation of those who seek Him, / Those who seek Your face, even Jacob. Selah';
                $tmp_verse_array['COPY'][0]             = '<strong>A Psalm of David</strong><div class="cb_10"></div>

                The earth is Jehovah\'s, and its fullness,<br>
                &nbsp;&nbsp;&nbsp;The habitable land and those who dwell in it.<br>
                For it is He who founded it upon the seas<br>
                &nbsp;&nbsp;&nbsp;And established it upon the streams.

                <div class="cb_5"></div>
                Who may ascend the mountain of Jehovah,<br>
                &nbsp;&nbsp;&nbsp;And who may stand in His holy place?<br>
                He who has clean hands and a pure heart,<br>
                &nbsp;&nbsp;&nbsp;Who has not lifted up his soul to falsehood<br>
                &nbsp;&nbsp;&nbsp;Or sworn deceitfully.<br>
                He will receive blessing from Jehovah,<br>
                &nbsp;&nbsp;&nbsp;And righteousness from the God of His salvation.<br>
                This is the generation of those who seek Him,<br>
                &nbsp;&nbsp;&nbsp;Those who seek Your face, even Jacob. Selah<br>

                <div class="cb_5"></div>
                Lift up your heads, O gates;<br>
                &nbsp;&nbsp;&nbsp;And be lifted up, O long enduring doors;<br>
                &nbsp;&nbsp;&nbsp;And the King of glory will come in.<br>
                Who is the King of glory?<br>
                &nbsp;&nbsp;&nbsp;Jehovah strong and mighty!<br>
                &nbsp;&nbsp;&nbsp;Jehovah mighty in battle!<br>
                Lift up your heads, O gates;<br>
                &nbsp;&nbsp;&nbsp;And lift up, O long enduring doors;<br>
                &nbsp;&nbsp;&nbsp;And the King of glory will come in.<br>
                Who is this King of glory?<br>
                &nbsp;&nbsp;&nbsp;Jehovah of hosts&ndash;&ndash;<br>
                &nbsp;&nbsp;&nbsp;He is the King of glory! Selah';

            break;
            case 'psa95_10-11':

                $tmp_verse_array['REFERENCE'][0]        = '95:10-11';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'For forty years I loathed that generation, / And I said, They are a people who go astray in heart; / And they do not know My ways; / Therefore I swore in My anger: / They shall by no means enter into My rest!';
                $tmp_verse_array['COPY'][0]             = 'For forty years I loathed that generation,<br>
                &nbsp;&nbsp;&nbsp;And I said, They are a people who go astray in heart;<br>
                &nbsp;&nbsp;&nbsp;And they do not know My ways;<br>
                Therefore I swore in My anger:<br>
                &nbsp;&nbsp;&nbsp;They shall by no means enter into My rest!';

            break;
            case 'psa97_2':

                $tmp_verse_array['REFERENCE'][0]        = '97:2';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'Clouds and deep darkness surround Him; Righteousness and justice are the foundation of His throne.';
                $tmp_verse_array['COPY'][0]             = 'Clouds and deep darkness surround Him;<br>
                &nbsp;&nbsp;&nbsp;Righteousness and justice are the foundation of His throne.';

            break;
            case 'psa119_103':

                $tmp_verse_array['REFERENCE'][0]        = '119:103';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'How sweet are Your words to my taste! than honey to my mouth!';
                $tmp_verse_array['COPY'][0]             = 'How sweet are Your words to my taste!<br>
                &nbsp;&nbsp;&nbsp;<em>Sweeter</em> than honey to my mouth!';

            break;
            case 'prov20_27':

                $tmp_verse_array['REFERENCE'][0]        = '20:27';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'The spirit of man is the lamp of Jehovah, Searching all the innermost parts of the inner being.';
                $tmp_verse_array['COPY'][0]             = 'The spirit of man is the lamp of Jehovah,<br>
                &nbsp;&nbsp;&nbsp;Searching all the innermost parts of the inner being.';

            break;
            case 'isa14_13':

                $tmp_verse_array['REFERENCE'][0]        = '14:13';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'But you, you said in your heart: / I will ascend to heaven; / Above the stars of God / I will exalt my throne. / And I will sit upon the mount of assembly / In the uttermost parts of the north.';
                $tmp_verse_array['COPY'][0]             = 'But you, you said in your heart:<br>
                &nbsp;&nbsp;&nbsp;I will ascend to heaven;<br>
                Above the stars of God<br>
                &nbsp;&nbsp;&nbsp;I will exalt my throne.<br>
                And I will sit upon the mount of assembly<br>
                &nbsp;&nbsp;&nbsp;In the <span class="script_sup">2</span>uttermost parts of the north.';

            break;
            case 'isa14_21-24':

                $tmp_verse_array['REFERENCE'][0]        = '14:21-24';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'Prepare a slaughterhouse for his children / Because of the iniquity of their fathers, / So that they do not rise up and possess the land, / And fill the surface of the world with cities. / And I will rise up against them, / Declares Jehovah of hosts. / And I will cut off from Babylon name and remnant, / And posterity and progeny, declares Jehovah.';
                $tmp_verse_array['COPY'][0]             = 'Prepare a slaughterhouse for his children<br>
                &nbsp;&nbsp;&nbsp;Because of the iniquity of their fathers,<br>
                So that they do not rise up and possess the land,<br>
                &nbsp;&nbsp;&nbsp;And fill the surface of the world with cities.

                <div class="cb_5"></div>
                And I will rise up against them,<br>
                &nbsp;&nbsp;&nbsp;Declares Jehovah of hosts.<br>
                And I will cut off from Babylon name and remnant,<br>
                &nbsp;&nbsp;&nbsp;And posterity and progeny, declares Jehovah.<br>

                <div class="cb_5"></div>
                And I will make it a possession for porcupines<br>
                &nbsp;&nbsp;&nbsp;And muddied pools of water,<br>
                And I will sweep it with the broom of destruction,<br>
                &nbsp;&nbsp;&nbsp;Declares Jehovah of hosts.

                <div class="cb_5"></div>
                Jehovah of hosts has sworn, saying,<br>
                Surely just as I conceived it, so has it happened;<br>
                &nbsp;&nbsp;&nbsp;And just as I have purposed it, so shall this stand,';

            break;
            case 'isa16_1-5':

                $tmp_verse_array['REFERENCE'][0]        = '16:1-5';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'Send a lamb / To the ruler of the land, / From Sela across the wilderness / To the mountain of the daughter of Zion. / Like wandering birds, / a scattered nest, / Will the daughters of Moab be / At the fords of the Arnon.';
                $tmp_verse_array['COPY'][0]             = 'Send a lamb <em>of tribute</em><br>
                &nbsp;&nbsp;&nbsp;To the ruler of the land,<br>
                From Sela across the wilderness<br>
                &nbsp;&nbsp;&nbsp;To the mountain of the daughter of Zion.<br>

            <div class="cb_5"></div>
                Like wandering birds,<br>
                &nbsp;&nbsp;&nbsp;<em>Like</em> a scattered nest,<br>
                Will the daughters of Moab be<br>
                &nbsp;&nbsp;&nbsp;At the fords of the Arnon.<br>

            <div class="cb_5"></div>
                Give <em>us</em> counsel,<br>
                &nbsp;&nbsp;&nbsp;Make a judgement <em>concerning us</em>.<br>
                Make your shadow at high noon<br>
                &nbsp;&nbsp;&nbsp;Like night <em>to us</em>.<br>
                Hide the outcasts;<br>
                &nbsp;&nbsp;&nbsp;Do not expose him who wanders.<br>

            <div class="cb_5"></div>
                Let the outcasts of Moab<br>
                &nbsp;&nbsp;&nbsp;Dwell with you;<br>
                Be a hiding place to them<br>
                &nbsp;&nbsp;&nbsp;From the destroyer.<br>
                When the extortioner finishes<br>
                &nbsp;&nbsp;&nbsp;<em>And</em> destruction ends,<br>
                &nbsp;&nbsp;&nbsp;<em>When</em> the oppressor is completely <em>gone</em> from the land,<br>

            <div class="cb_5"></div>
                Then will a throne be established in lovingkindness,<br>
                &nbsp;&nbsp;&nbsp;And upon it One will sit in truth<br>
                &nbsp;&nbsp;&nbsp;In the tent of David,<br>
                Judging and pursuing justice<br>
                &nbsp;&nbsp;&nbsp;And hastening righteousness.';

            break;
            case 'isa53_6':

                $tmp_verse_array['REFERENCE'][0]        = '53:6';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'We all like sheep have gone astray; / Each of us has turned to his own way, / And Jehovah has caused the iniquity of us all / To fall on Him.';
                $tmp_verse_array['COPY'][0]             = 'We all like sheep have gone astray;<br>
                &nbsp;&nbsp;&nbsp;Each of us has turned to his own way,<br>
                And Jehovah has caused the iniquity of us all<br>
                &nbsp;&nbsp;&nbsp;To fall on Him.';

            break;
            case 'jer1_11-19':

                $tmp_verse_array['REFERENCE'][0]        = '1:11-19';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'Then the word of Jehovah came to me, saying, What do you see, Jeremiah? And I said, I see a rod of an almond tree. And Jehovah said to me, You have seen well, for I am watching over My word to perform it. Then the word of Jehovah came to me a second time, saying, What do you see? And I said, I see a boiling pot, and it is facing away from the north.';
                $tmp_verse_array['COPY'][0]             = 'Then the word of Jehovah came to me, saying, What do you see, Jeremiah? 
                And I said, I see a rod of an almond tree. And Jehovah said to me, You have seen well, for I am 
                watching over My word to perform it. Then the word of Jehovah came to me a second time, saying, What 
                do you see? And I said, I see a boiling pot, and it is facing away from the north.

                <div class="cb_10"></div>
                And Jehovah said to me, Out of the north evil will be let loose upon all the inhabitants of the land. 
                For I am now calling all the families from the kingdoms of the north, declares Jehovah, and they 
                will come and set each one his throne at the entrance of the gates of Jerusalem and against all its 
                walls all around and against all the cities of Judah. And I will utter My judgement on them 
                concerning all their wickedness by which they have forsaken Me and have burned incense to other gods 
                and have worshipped the works of their<br>own hands.

                <div class="cb_10"></div>
                You therefore gird up your loins, and rise up and speak to them everything that I command you. Do 
                not be dismayed before them, lest I dismay you in their presence. And I am now making you today into 
                a fortified city and into an iron pillar and into bronze walls against the whole land, against the 
                kings of Judah, against its princes, against its priests, and against the people of the land. And 
                they will fight against you, but they will not prevail against you; for I am with you, declares 
                Jehovah, to deliver you.';

            break;
            case 'jer24_7':

                $tmp_verse_array['REFERENCE'][0]        = '24:7';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'And I will give them a heart to know Me, that I am Jehovah; and they will be My people, and I will be their God; for they will return to Me with their whole heart.';
                $tmp_verse_array['COPY'][0]             = 'And I will give them a heart to know Me, that I am Jehovah; and they will 
                be My people, and I will be their God; for they will return to Me with their whole heart.';

            break;
            case 'jer31_31-34':

                $tmp_verse_array['REFERENCE'][0]        = '31:31-34';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'Indeed, days are coming, declares Jehovah, when I will make a new covenant with the house of Israel and with the house of Judah, Not like the covenant which I made with their fathers in the day I took them by their hand to bring them out from the land of Egypt, My covenant which they broke, although I was their Husband, declares Jehovah.';
                $tmp_verse_array['COPY'][0]             = 'Indeed, days are coming, declares Jehovah, when I will make a new 
                covenant with the house of Israel and with the house of Judah, Not like the covenant which I made with 
                their fathers in the day I took them by their hand to bring them out from the land of Egypt, My covenant 
                which they broke, although I was their Husband,<br>declares Jehovah. 

                <div class="cb_10"></div>
                But this is the covenant which I will make with the house of Israel 
                after those days, declares Jehovah: I will put My law in their inward parts and write it upon their 
                hearts; and I will be their God, and they will be My people.

                <div class="cb_10"></div>
                And they will no longer teach, each man his neighbor and each man his brother, saying, Know Jehovah; for 
                all of them will know Me, from the little one among them even to the great one among them, declares 
                Jehovah, for I will forgive their iniquity, and their sin I will remember no more.';

            break;
            case 'jer31_33-34':

                $tmp_verse_array['REFERENCE'][0]        = '31:33-34';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'But this is the covenant which I will make with the house of Israel after those days, declares Jehovah: I will put My law in their inward parts and write it upon their hearts; and I will be their God, and they will be My people.';
                $tmp_verse_array['COPY'][0]             = 'But this is the covenant which I will make with the house of Israel 
                after those days, declares Jehovah: I will put My law in their inward parts and write it upon their 
                hearts; and I will be their God, and they will be My people.

                <div class="cb_10"></div>
                And they will no longer teach, each man his neighbor and each man his brother, saying, Know Jehovah; for 
                all of them will know Me, from the little one among them even to the great one among them, declares 
                Jehovah, for I will forgive their iniquity, and their sin I will remember no more.';

            break;
            case 'jer31_33-37':

                $tmp_verse_array['REFERENCE'][0]        = '31:33-37';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'But this is the covenant which I will make with the house of Israel after those days, declares Jehovah: I will put My law in their inward parts and write it upon their hearts; and I will be their God, and they will be My people. And they will no longer teach, each man his neighbor and each man his brother, saying, Know Jehovah; for all of them will know Me, from the little one among them even to the great one among them, declares Jehovah, for I will forgive their iniquity, and their sin I will remember no more.';
                $tmp_verse_array['COPY'][0]             = 'But this is the covenant which I will make with the house of Israel 
                after those days, declares Jehovah: I will put My law in their inward parts and write it upon their 
                hearts; and I will be their God, and they will be My people. And they will no longer teach, each man 
                his neighbor and each man his brother, saying, Know Jehovah; for all of them will know Me, from the 
                little one among them even to the great one among them, declares Jehovah, for I will forgive their 
                iniquity, and their sin I will remember no more.

                <div class="cb_10"></div>
                Thus says Jehovah,<br>
                Who gives the sun for light by day<br>
                &nbsp;&nbsp;&nbsp;And the order of the moon and the stars for light by night,<br>
                Who stirs up the sea so that its waves roar&ndash;&ndash;<br>
                &nbsp;&nbsp;&nbsp;Jehovah of hosts is His name&ndash;&ndash;<br>

                <div class="cb_10"></div>
                If this order departs<br>
                &nbsp;&nbsp;&nbsp;From before Me, declares Jehovah,<br>
                Then the seed of Israel will also cease<br>
                &nbsp;&nbsp;&nbsp;From being a nation before Me forever.

                <div class="cb_10"></div>
                Thus says Jehovah,<br>
                If the heavens above can be measured,<br>
                &nbsp;&nbsp;&nbsp;And the foundations of the earth below can be examined carefully,<br>
                Then I will also cast off all the seed of Israel<br>
                &nbsp;&nbsp;&nbsp;For all they have done, declares Jehovah.';

            break;
            case 'jer31_31-37':

                $tmp_verse_array['REFERENCE'][0]        = '31:33-37';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'Indeed days are coming, declares Jehovah, when I will make a new covenant with the house of Israel and with the house of Judah, Not like the covenant which I made with their fathers in the day I took them by their hand to bring them out from the land of Egypt, My covenant which they broke, although I was their Husband, declares Jehovah.';
                $tmp_verse_array['COPY'][0]             = 'Indeed days are coming, declares Jehovah, when I will make a new covenant 
                with the house of Israel and with the house of Judah, Not like the covenant which I made with their 
                fathers in the day I took them by their hand to bring them out from the land of Egypt, My covenant which 
                they broke, although I was their Husband,<br>declares Jehovah.

                <div class="cb_10"></div>
                But this is the covenant which I will make with the house of Israel after those days, declares Jehovah: 
                I will put My law in their inward parts and write it upon their hearts; and I will be their God, and 
                they will be My people. And they will no longer teach, each man his neighbor and each man his brother, 
                saying, Know Jehovah; for all of them will know Me, from the little one among them even to the great one 
                among them, declares Jehovah, for I will forgive their iniquity, and their sin I will remember no more.

                <div class="cb_10"></div>
                Thus says Jehovah,<br>
                Who gives the sun for light by day<br>
                &nbsp;&nbsp;&nbsp;And the order of the moon and the stars for light by night,<br>
                Who stirs up the sea so that its waves roar&ndash;&ndash;<br>
                &nbsp;&nbsp;&nbsp;Jehovah of hosts is His name&ndash;&ndash;<br>

                <div class="cb_10"></div>
                If this order departs<br>
                &nbsp;&nbsp;&nbsp;From before Me, declares Jehovah,<br>
                Then the seed of Israel will also cease<br>
                &nbsp;&nbsp;&nbsp;From being a nation before Me forever.

                <div class="cb_10"></div>
                Thus says Jehovah,<br>
                If the heavens above can be measured,<br>
                &nbsp;&nbsp;&nbsp;And the foundations of the earth below can be examined carefully,<br>
                Then I will also cast off all the seed of Israel<br>
                &nbsp;&nbsp;&nbsp;For all they have done, declares Jehovah.';

            break;
            case 'ezek11_17-25':

                $tmp_verse_array['REFERENCE'][0]        = '11:17-25';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'Therefore say, Thus says the Lord Jehovah, I will gather you from the peoples and assemble you from the countries among which you have been scattered, and I will give you the land of Israel. And they will come there and take away all its detestable things and all its abominations from it.';
                $tmp_verse_array['COPY'][0]             = 'Therefore say, Thus says the Lord Jehovah, I will gather you from the 
                peoples and assemble you from the countries among which you have been scattered, and I will give 
                you the land of Israel. And they will come there and take away all its detestable things and all its 
                abominations from it. 

                <div class="cb_10"></div>
                And I will give them one heart, and a new spirit I will put within them; and I will take the heart 
                of stone out of their flesh and give them a heart of flesh, That they may walk in My statutes and 
                keep My ordinances and do them; and they will be My people, and I will be their God.

                <div class="cb_10"></div>
                But as for those whose heart goes after their detestable things and their abominations, I will bring 
                their ways upon their heads, declares the Lord Jehovah. 

                <div class="cb_10"></div>
                Then the cherubim lifted up their wings, and the wheels were next to them; and the glory of the God 
                of Israel was over them above. And the glory of Jehovah went up from the midst of the city and stood
                upon the mountain which is east of the city. And the Spirit lifted me up and brought me to Chaldea, 
                to the captives, in a vision by the Spirit of God. And the vision that I had seen went up from me.

                <div class="cb_10"></div>
                Then I told the captives all the things that Jehovah had shown me.';

            break;
            case 'dan9_4':

                $tmp_verse_array['REFERENCE'][0]        = '9:4';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'And I prayed to Jehovah my God and confessed; and I said, Ah, Lord, the great and awesome God, who keeps covenant and lovingkindness with those who love Him and keep His commandments,';
                $tmp_verse_array['COPY'][0]             = 'And I prayed to Jehovah my God and confessed; and I said, Ah, Lord, the 
                great and awesome God, who keeps covenant and lovingkindness with those who love Him and keep<br>
                His commandments,';

            break;
            case 'dan9_17-27':

                $tmp_verse_array['REFERENCE'][0]        = '9:17-27';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'And now hear, O our God, the prayer of Your servant and his supplications, and cause Your face to shine upon Your sanctuary that has been desolated, for the Lord\'s sake. O my God, incline Your ear and hear; open Your eyes and see our desolations and the city that is called by Your name; for we are not presenting our supplications before You based upon any righteous doings that we have done, but based upon Your great compassion.';
                $tmp_verse_array['COPY'][0]             = 'And now hear, O our God, the prayer of Your servant and his 
                supplications, and cause Your face to shine upon Your sanctuary that has been desolated, for the 
                Lord\'s sake. O my God, incline Your ear and hear; open Your eyes and see our desolations and the 
                city that is called by Your name; for we are not presenting our supplications before You based upon 
                any righteous doings that we have done, but based upon Your great compassion.

                <div class="cb_10"></div>
                O Lord, hear! O Lord, forgive! O Lord, listen and take action! Do not delay, for Your own sake, O my 
                God; for Your city and Your people are called by Your <em>own</em> name.

                <div class="cb_10"></div>
                And while I was still speaking and praying and confessing my sin and the sin of my people Israel and 
                presenting my supplication before Jehovah my God for the holy mountain of my God, Even while I was 
                speaking in prayer, the man Gabriel, whom I had seen in the vision at the beginning, reached me in <em>my</em> 
                utter exhaustion about the time of the evening oblation.

                <div class="cb_10"></div>
                And he informed <em>me</em> and talked with me and said, Daniel, I have now come forth to give you 
                insight and understanding. At the beginning of your supplications the command went forth, and I have 
                come to tell <em>you</em>, for you are preciousness itself. Therefore understand the matter, and 
                consider the vision.

                <div class="cb_10"></div>
                Seventy weeks are apportioned for your people and for your holy city, to close the transgression, 
                and to make an end of sins, and to make propitiation for iniquity, and to bring in the righteousness 
                of the ages, and to seal up vision and prophet, and to anoint the Holy of Holies.

                <div class="cb_10"></div>
                Know therefore and comprehend: From the issuing of the decree to restore and rebuild Jerusalem until 
                <em>the time of</em> Messiah the Prince will be seven weeks and sixty-two weeks; it will be built 
                again, with street and trench, even in distressful times. And after the sixty-two weeks Messiah will 
                be cut off and will have nothing; and the people of the prince who will come will destroy the city 
                and the sanctuary; and the end of it will be a flood, and even to the end <em>there will be</em> war; 
                desolations are determined.

                <div class="cb_10"></div>
                And he will make a firm covenant with the many for one week; and in the middle of the week he will <a id="sup_ftnt_1" href="#" class="script_sup" onclick="jony5_vv_scroll_to(\'ftnt_1\');">1</a>cause 
                the sacrifice and the oblation to cease and will replace the sacrifice and the oblation with 
                abominations of the desolator, even until the complete destruction that has been determined is 
                poured out upon the desolator.';

            break;
            case 'joel2_23':

                $tmp_verse_array['REFERENCE'][0]        = '2:23';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'O children of Zion, / Be glad and rejoice / In Jehovah your God. / For He gives you / The early rain in righteousness, / And He makes the rain come down for you: / The early rain and the late rain / At the beginning of the season.';
                $tmp_verse_array['COPY'][0]             = 'O children of Zion,<br>
                &nbsp;&nbsp;&nbsp;Be glad and rejoice<br>
                &nbsp;&nbsp;&nbsp;In Jehovah your God.<br>
                For He gives you<br>
                &nbsp;&nbsp;&nbsp;The early rain in righteousness,<br>
                &nbsp;&nbsp;&nbsp;And He makes the rain come down for you:<br>
                The <a id="sup_ftnt_1" href="#" class="script_sup" onclick="jony5_vv_scroll_to(\'ftnt_1\');">1</a>early 
                rain and the <a id="sup_ftnt_1" href="#" class="script_sup" onclick="jony5_vv_scroll_to(\'ftnt_1\');">1</a>late rain<br>
                &nbsp;&nbsp;&nbsp;At the beginning of the season.';

            break;
            case 'matt1_18,20':

                $tmp_verse_array['REFERENCE'][0]        = '1:18, 20';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = '18 Now the origin of Jesus Christ was in this way: His mother, Mary, after she had been engaged to Joseph, before they came together, was found to be with child of the Holy Spirit. 20 But while he pondered these things, behold, an angel of the Lord appeared to him in a dream, saying, Joseph, son of David, do not be afraid to take Mary your wife, for that which has been begotten in her is of the Holy Spirit.';
                $tmp_verse_array['COPY'][0]             = '<span class="script_ref_num">18</span> Now the origin of Jesus Christ 
                was in this way: His mother, Mary, after she had been engaged to Joseph, before they came together, 
                was found to be with child of the Holy Spirit.

                <div class="cb_10"></div>
                <span class="script_ref_num">20</span> But while he pondered these things, behold, an angel of the 
                Lord appeared to him in a dream, saying, Joseph, son of David, do not be afraid to take Mary your 
                wife, for that which has been <span class="script_sup">1</span>begotten in her is of the 
                Holy Spirit.';

            break;
            case 'matt2_4-6':

                $tmp_verse_array['REFERENCE'][0]        = '2:4-6';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'And gathering together all the chief priests and scribes of the people, he inquired of them where the Christ was to be born. And they said to him, In Bethlehem of Judea, for so it is written through the prophet: &quot;And you, Bethlehem, land of Judah, by no means are you the least among the princes of Judah; for out of you shall come forth a Ruler, One who will shepherd My people Israel.&quot;';
                $tmp_verse_array['COPY'][0]             = 'And gathering together all the chief priests and scribes of the 
                people, he inquired of them where the Christ was to be born. And they said to him, In Bethlehem of 
                Judea, for so it is written through the prophet: &quot;And you, Bethlehem, land of Judah, by no 
                means are you the least among the princes of Judah; for out of you shall come forth a Ruler, One 
                who will shepherd My people Israel.&quot;';

            break;
            case 'matt3_15':

                $tmp_verse_array['REFERENCE'][0]        = '3:15';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'But Jesus answered and said to him, Permit it for now, for it is fitting for us in this way to fulfill all righteousness. Then he permitted Him.';
                $tmp_verse_array['COPY'][0]             = 'But Jesus answered and said to him, Permit it for now, for it is 
                fitting for us in this way to fulfill all <span class="script_sup">1</span>righteousness. Then he 
                permitted Him.';

            break;
            case 'matt4_1-2':

                $tmp_verse_array['REFERENCE'][0]        = '4:1-2';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'Then Jesus was led up into the wilderness by the Spirit to be tempted by the devil. And when He had fasted forty days and forty nights, afterward He became hungry.';
                $tmp_verse_array['COPY'][0]             = 'Then Jesus was led up into the wilderness by the Spirit to be 
                tempted by the devil. And when He had fasted forty days and forty nights, afterward He became 
                hungry.';

            break;
            case 'matt4_3':

                $tmp_verse_array['REFERENCE'][0]        = '4:3';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'And the tempter came and said to Him, If You are the Son of God, speak that these stones may become loaves of bread.';
                $tmp_verse_array['COPY'][0]             = 'And the tempter came and said to Him, If You are the Son of God, 
                speak that these stones may become loaves of bread.';

            break;
            case 'matt4_4b':

                $tmp_verse_array['REFERENCE'][0]        = '4:4b';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'Man shall not live on bread alone, but on every word that proceeds out through the mouth of God.';
                $tmp_verse_array['COPY'][0]             = 'Man shall not live on bread alone, but on every word that proceeds 
                out through the mouth of God.';

            break;
            case 'matt4_5-7':

                $tmp_verse_array['REFERENCE'][0]        = '4:5-7';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'Then the devil took Him into the holy city and set Him on the wing of the temple, And said to Him, If You are the Son of God, cast Yourself down; for it is written, &quot;To His angels He shall give charge concerning You, and on hands they shall bear You up, lest You strike Your foot against a stone.&quot; Jesus said to him, Again, it is written, &quot;You shall not test the Lord your God.&quot;';
                $tmp_verse_array['COPY'][0]             = 'Then the devil took Him into the holy city and set Him on the wing of 
                the temple, And said to Him, If You are the Son of God, cast Yourself down; for it is written, 
                &quot;To His angels He shall give charge concerning You, and on <em>their</em> hands they shall bear 
                You up, lest You strike Your foot against a stone.&quot; Jesus said to him, Again, it is written, 
                &quot;You shall not test the Lord your God.&quot;';

            break;
            case 'matt5_10':

                $tmp_verse_array['REFERENCE'][0]        = '5:10';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'Blessed are those who are persecuted for the sake of righteousness, for theirs is the kingdom of the heavens.';
                $tmp_verse_array['COPY'][0]             = 'Blessed are those who are persecuted for the sake of righteousness, 
                for theirs is the kingdom of the heavens.';

            break;
            case 'matt5_13':

                $tmp_verse_array['REFERENCE'][0]        = '5:13';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'You are the salt of the earth. But if the salt has become tasteless, with what shall it be salted? It is no longer good for anything except to be cast out and trampled underfoot by men.';
                $tmp_verse_array['COPY'][0]             = 'You are the salt of the earth. But if the salt has become tasteless, 
                with what shall it be salted? It is no longer good for anything except to be cast out and trampled 
                underfoot by men.';

            break;
            case 'matt5':

                $tmp_verse_array['REFERENCE'][0]        = '5';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'And when He saw the crowds, He went up to the mountain. And after He sat down, His disciples came to Him. And opening His mouth, He taught them, saying, Blessed are the poor in spirit, for theirs is the kingdom of the heavens. Blessed are those who mourn, for they shall be comforted. Blessed are the meek, for they shall inherit the earth. Blessed are those who hunger and thirst for righteousness, for they shall be satisfied.';
                $tmp_verse_array['COPY'][0]             = 'And when He saw the crowds, He went up to the mountain. And after He 
                sat down, His disciples came to Him. And opening His mouth, He taught them, saying, Blessed are the 
                poor in spirit, for theirs is the kingdom of the heavens. Blessed are those who mourn, for they 
                shall be comforted. Blessed are the meek, for they shall inherit the earth. Blessed are those who 
                hunger and thirst for righteousness, for they shall be satisfied. Blessed are the merciful, for they 
                shall be shown mercy. Blessed are the pure in heart, for they shall see God. Blessed are the 
                peacemakers, for they shall be called the sons of God. Blessed are those who are persecuted for the 
                sake of righteousness, for theirs is the kingdom of the heavens. Blessed are you when they reproach 
                and persecute you, and while speaking lies, say every evil thing against you because of Me. Rejoice 
                and exult, for your reward is great in the heavens; for so they persecuted the prophets who were 
                before you.

                <div class="cb_10"></div>
                You are the salt of the earth. But if the salt has become tasteless, with what shall it be salted? 
                It is no longer good for anything except to be cast out and trampled underfoot by men. You are the 
                light of the world. It is impossible for a city situated upon a mountain to be hidden. Nor do 
                <em>men</em> light a lamp and place it under the bushel, but on the lampstand; and it shines to all 
                who are in the house. In the same way, let your light shine before men, so that they may see your 
                good works and glorify your Father who is in the heavens. 

                <div class="cb_10"></div>
                Do not think that I have come to abolish the law or the prophets; I have not come to abolish, but to 
                fulfill. For truly I say to you, Until heaven and earth pass away, one iota or one serif shall by no 
                means pass away from the law until all come to pass. Therefore whoever annuls one of the least of 
                these commandments, and teaches men so, shall be called the least in the kingdom of the heavens; but 
                whoever practices and teaches <em>them</em>, he shall be called great in the kingdom of the heavens. 
                For I say to you that unless your righteousness surpasses that of the scribes and Pharisees, you 
                shall by no means enter into the kingdom of the heavens. You have heard that it was said to the 
                ancients, &quot;You shall not murder, and whoever murders shall be liable to the judgement.&quot; But I 
                say to you that everyone who is angry with his brother shall be liable to the judgement. And whoever 
                says to his brother, Raca, shall be liable to <em>the judgement of</em> the Sanhedrin; and whoever says, 
                Moreh, shall be liable to the Gehenna of fire. Therefore if you are offering your gift at the alter 
                and there you remember that your brother has something against you, Leave your gift there before the 
                alter, and first go and be reconciled to your brother, and then come and offer your gift. Be well 
                disposed quickly toward your opponent at law, while you are with him on the way, lest the opponent 
                deliver you to the judge, and the judge to the officer, and you be thrown into prison. Truly I say 
                to you, You shall by no means come out from there until you pay the last quadrans. You have heard 
                that it was said, &quot;You shall not commit adultery.&quot; But I say to you that everyone who looks at 
                a woman in order to lust after her has already committed adultery with her in his heart. So if your 
                right eye stumbles you, pluck it out and cast <em>it</em> from you; for it is more profitable for 
                you that one of your members perish than for your whole body to be cast into Gehenna. And if your 
                right hand stumbles you, cut it off and cast <em>it</em> from you, for it is more profitable for you 
                that one of your members perish than for your whole body to pass away into Gehenna. And it was said, 
                Whoever divorces his wife, let him give her a certificate of divorce. But I say to you that everyone 
                who divorces his wife, except for the cause of fornication, causes her to commit adultery, and 
                whoever marries her who has been divorced commits adultery. Again, you have heard that it was said 
                to the ancients, &quot;You shall not break an oath, but you shall render to the Lord your oaths.&quot; 
                But I tell you not to swear at all; neither by heaven, because it is the throne of God; Nor by the 
                earth, because it is the footstool of His feet; nor unto Jerusalem, because it is the city of the great 
                King; Neither shall you swear by your head, because you cannot make one hair white or black. But let 
                your word be, Yes, yes; No, no; for anything more than these is of the evil one. You have heard that 
                it was said, &quot;An eye for an eye, and a tooth for a tooth.&quot; But I tell you not to resist him 
                who is evil; rather whoever slaps you on your right cheek, turn to him the other also. And to him who 
                wishes to sue you and take your tunic, yield to him your cloak also; And whoever compels you to go 
                one mile, go with him two. To him who asks of you, give; and from him who wants to borrow from you, 
                do not turn away. You have heard that it was said, &quot;You shall love your neighbor and hate your 
                enemy.&quot; But I say to you, Love your enemies, and pray for those who persecute you, So that you may 
                become sons of your Father who is in the heavens, because He causes His sun to rise on the evil and 
                the good and sends rain on the just and the unjust. For if you love those who love you, what reward 
                do you have? Do not even the tax collectors do the same? And if you greet only your brothers, what 
                better thing are you doing? Do not even the Gentiles do the same? You therefore shall be perfect as 
                your heavenly Father is perfect.';

            break;
            case 'matt6':

                $tmp_verse_array['REFERENCE'][0]        = '6';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'But take care not to do your righteousness before men in order to be gazed at by them; otherwise, you have no reward with your Father who is in the heavens. Therefore when you give alms, do not sound a trumpet before you as the hypocrites do in the synagogues and in the streets, so that they may be glorified by men. Truly I say to you, They have their reward in full.';
                $tmp_verse_array['COPY'][0]             = 'But take care not to do your righteousness before men in order to be 
                gazed at by them; otherwise, you have no reward with your Father who is in the heavens. Therefore 
                when you give alms, do not sound a trumpet before you as the hypocrites do in the synagogues and in 
                the streets, so that they may be glorified by men. Truly I say to you, They have their reward in 
                full. But you, when you give alms, do not let your left hand know what your right hand is doing, So 
                that your alms may be in secret; and your Father who sees in secret will repay you. And when you 
                pray, you shall not be like the hypocrites, because they love to pray standing in the synagogues and 
                on the street corners, so that they may be seen by men. Truly I say to you, They have their reward 
                in full. But you, when you pray, enter into your private room, and shut your door and pray to your 
                Father who is in secret; and your Father who sees in secret will repay you. And in praying do not 
                babble empty words as the Gentiles do; for they suppose that in their multiplicity of words they 
                will be heard. Therefore do not be like them, for your Father knows the things that you have need of 
                before you ask Him. You then pray in this way: Our Father who is in the heavens, Your name be 
                sanctified; Your kingdom come; Your will be done, as in heaven, <em>so</em> also on earth. Give us 
                today our daily bread. And forgive us our debts, as we also have forgiven our debtors. And do not 
                bring us into temptation, but deliver us from the evil one. For Yours is the kingdom and the power 
                and the glory forever. Amen. For if you forgive men their offenses, your heavenly Father will 
                forgive you also; But if you do not forgive men their offenses, neither will your Father forgive 
                your offenses. And when you fast, do not be like the sullen-faced hypocrites, for they disfigure 
                their faces so that they may appear to men to be fasting. Truly I say to you, They have their reward 
                in full. But you, when you fast, anoint your head and wash your face, So that you may not appear to 
                men to be fasting, but to your Father who is in secret; and your Father who sees in secret will 
                repay you.

                <div class="cb_10"></div>
                Do not store up for yourselves treasures on the earth, where moth and rust consume and where thieves 
                dig through and steal. But store up for yourselves treasures in heaven, where neither moth nor rust 
                consumes and where thieves do not dig through nor steal. For where your treasure is, there will your 
                heart be also. The lamp of the body is the eye. If therefore your eye is single, your whole body 
                will be full of light; But if your eye is evil, your whole body will be dark. If then the light that 
                is in you is darkness, how great is the darkness! No one can serve two masters, for either he will 
                hate the one and love the other, or he will hold to one and despise the other. You cannot serve God 
                and mammon. Because of this, I say to you, Do not be anxious for your life, what you should eat or 
                what you should drink; nor for your body, what you should put on. Is not the life more than food, 
                and the body than clothing? Look at the birds of heaven. They do not sow nor reap nor gather into 
                barns, yet your heavenly Father nourishes them. Are you not of more value than they? Who among you 
                by being anxious can add one cubit to his stature? And why are you anxious concerning clothing? 
                Consider well the lilies of the field, how they grow. They do not toil, neither do they spin 
                <em>thread</em>. But I tell you that not even Solomon in all his glory was clothed like one of 
                these. And if God so arrays the grass of the field, which is <em>here</em> today and tomorrow is 
                cast into the furnace, <em>will He</em> not much more <em>clothe</em> you, you of little faith? 
                Therefore do not be anxious, saying, What shall we eat? or, What shall we drink? or, With what shall 
                we be clothed? For all these things the Gentiles are anxiously seeking. For your heavenly Father 
                knows that you need all these things. But seek first His kingdom and His righteousness, and all 
                these things will be added to you. Therefore do not be anxious for tomorrow, for tomorrow will be 
                anxious for itself; sufficient for the day is its<br><em>own</em> evil.';

            break;
            case 'matt7':

                $tmp_verse_array['REFERENCE'][0]        = '7';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'Do not judge, that you be not judged. For with what judgement you judge, you shall be judged; and with what measure you measure, it shall be measured to you. And why do you look at the splinter which is in your brothers\'s eye, but the beam in your eye you do not consider? Or how can you say to your brother, Let me remove the splinter from your eye, and behold, the beam is in your eye?';
                $tmp_verse_array['COPY'][0]             = 'Do not judge, that you be not judged. For with what judgement you 
                judge, you shall be judged; and with what measure you measure, it shall be measured to you. And why 
                do you look at the splinter which is in your brothers\'s eye, but the beam in your eye you do not 
                consider? Or how can you say to your brother, Let me remove the splinter from your eye, and behold, 
                the beam is in your eye? Hypocrite, first remove the beam from your eye, and then you will see 
                clearly to remove the splinter from your brother\'s eye. Do not give that which is holy to the dogs, 
                neither cast your pearls before the hogs, lest they trample them with their feet, and turn and tear 
                you. Ask and it shall be given to you; seek and you shall find; knock and it shall be opened to you. 
                For everyone who asks receives, and he who seeks finds, and to him who knocks it shall be opened. Or 
                what man is there among you who, when his son asks him for a loaf, will give him a stone? Or also 
                when he asks for a fish, will give him a serpent? If you then being evil know <em>how</em> to give 
                good gifts to your children, how much more will your Father who is in the heavens give good things 
                to those who ask Him! Therefore all that you wish men would do to you, so also you do to them; for 
                this is the law and<br>the prophets.

                <div class="cb_10"></div>
                Enter through the narrow gate, for wide is the gate and broad is the way that leads to destruction, 
                and many are those who enter through it. Because narrow is the gate and constricted is the way that 
                leads to life, and few are those who find it. Beware of false prophets, who come to you in sheep\'s 
                clothing, but inwardly they are ravenous wolves. By their fruits you will recognize them. Do <em>men</em> 
                gather grapes from thorns, or figs from thistles? Even so every good tree produces good fruit, but 
                the corrupt tree produces bad fruit. A good tree cannot produce bad fruit, neither can a corrupt 
                tree produce good fruit. Every tree that does not produce good fruit is cut down and cast into the 
                fire. So then, by their fruits you will recognize them. Not everyone who says to Me, Lord, Lord, 
                will enter into the kingdom of the heavens, but he who does the will of My Father who is in the 
                heavens. Many will say to Me in that day, Lord, Lord, <em>was it</em> not in Your name <em>that</em> 
                we prophesied, and in Your name cast out demons, and in Your name did many works of power? And then 
                I will declare to them: I never knew you. Depart from Me, you workers of lawlessness. Everyone 
                therefore who hears these words of Mine and does them shall be likened to a prudent man who built 
                his house upon the rock. And the rain descended, and the rivers came, and the winds blew, and they 
                beat against that house; and it did not fall, for it was founded on the rock. And everyone who hears 
                these words of Mine and does not do them shall be likened to a foolish man who built his house upon 
                the sand. And the rain descended, and the rivers came, and the winds blew, and they dashed against 
                that house; and it fell, and its fall was great. And when Jesus finished these words, the crowds 
                were astounded at His teaching, For He taught them as One having authority and not like 
                their scribes.';

            break;
            case 'matt7_13-14':

                $tmp_verse_array['REFERENCE'][0]        = '7:13-14';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'Enter in through the narrow gate, for wide is the gate and broad is the way that leads to destruction, and many are those who enter through it. Because narrow is the gate and constricted is the way that leads to life, and few are those who find it.';
                $tmp_verse_array['COPY'][0]             = 'Enter in through the narrow gate, for wide is the gate and broad is the 
                way that leads to destruction, and many are those who enter through it. Because narrow is the gate and 
                constricted is the way that leads to life, and few are those who find it.';

            break;
            case 'matt10_10b':

                $tmp_verse_array['REFERENCE'][0]        = '10:10b';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'For the worker is worthy of his food.';
                $tmp_verse_array['COPY'][0]             = 'For the worker is worthy of his food.';

            break;
            case 'matt10_16-33':

                $tmp_verse_array['REFERENCE'][0]        = '10:16-33';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'Behold, I send you forth as sheep in the midst of wolves. Be therefore prudent as serpents and guileless as doves. And beware of men, for they will deliver you up to sanhedrins, and in their synagogues they will scourge you.';
                $tmp_verse_array['COPY'][0]             = 'Behold, I send you forth as sheep in the midst of wolves. Be therefore 
                prudent as serpents and guileless as doves. And beware of men, for they will deliver you up to 
                sanhedrins, and in their synagogues they will scourge you. And you will also be brought before governors 
                and kings for My sake, for a testimony to them and to the Gentiles.

                <div class="cb_10"></div>
                But when they deliver you up, do not be anxious about how or what you should speak, for it will be given 
                to you in that hour what you should speak; For you are not the ones speaking, but the Spirit of your 
                Father is the One speaking in you.

                <div class="cb_10"></div>
                And brother will deliver up brother to death, and father <em>his</em> child; and children will rise up 
                against <em>their</em> parents and put them to death. And you will be hated by all because of My name. 
                But he who has endured to the end, this one shall be saved.

                <div class="cb_10"></div>
                And when they persecute you in this city, flee into another. For truly I say to you, You shall by no 
                means finish the cities of Israel until the Son of Man comes. A disciple is not above the teacher, nor 
                a slave above his master. It is sufficient for the disciple that he become like his teacher, and the 
                slave like his master. If they have called the Master of the house Beelzebul, how much more those of<br> 
                His household!

                <div class="cb_10"></div>
                Therefore do not fear them; for there is nothing covered which will not be revealed, and hidden which 
                will not be made known. What I say to you in the darkness, speak in the light; and what you hear in the 
                ear, proclaim on the housetops. And do not fear those who kill the body, but are not able to kill the 
                soul; but rather fear Him who is able to destroy both soul and body in Gehenna.

                <div class="cb_10"></div>
                Are not two sparrows sold for an assarion? And not one of them will fall to the earth apart from your 
                Father. But even the hairs of your head are all numbered. Therefore do not fear; you are of more value 
                than many sparrows.

                <div class="cb_10"></div>
                Everyone therefore who will confess in Me before men, I also will confess in him before My Father who is 
                in the heavens; But whoever will deny Me before men, I also will deny him before My Father who is in 
                the heavens.';

            break;
            case 'matt11_28-30':

                $tmp_verse_array['REFERENCE'][0]        = '11:28-30';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'Come to Me all who toil and are burdened, and I will give you rest. Take My yoke upon you and learn from Me, for I am meek and lowly in heart, and you will find rest for your souls. For My yoke is easy and My burden is light.';
                $tmp_verse_array['COPY'][0]             = 'Come to Me all who toil and are burdened, and I will give you rest. Take 
                My yoke upon you and learn from Me, for I am meek and lowly in heart, and you will find rest for your 
                souls. For My yoke is easy and My burden is light.';

            break;
            case 'matt12_1-8':

                $tmp_verse_array['REFERENCE'][0]        = '12:1-8';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'At that time Jesus went on the Sabbath through the grainfields. And His disciples became hungry and began to pick ears of grain and eat. But the Pharisees, seeing, said to Him, Behold, Your disciples are doing what is not lawful to do on the Sabbath. But He said to them, Have you not read what David did when he became hungry, and those who were with him; How he entered into the house of God, and they ate the bread of the Presence, which was not lawful for him to eat, nor for those who were with him, except for the priests only?';
                $tmp_verse_array['COPY'][0]             = 'At that time Jesus went on the Sabbath through the grainfields. And 
                His disciples became hungry and began to pick ears of grain and eat. But the Pharisees, seeing <em>this</em>, 
                said to Him, Behold, Your disciples are doing what is not lawful to do on the Sabbath. But He said 
                to them, Have you not read what David did when he became hungry, and those who were with him; How he 
                entered into the house of God, and they ate the bread of the Presence, which was not lawful for him 
                to eat, nor for those who were with him, except for the priests only? Or have you not read in the 
                law that on the Sabbath the priests in the temple profane the Sabbath and<br>are guiltless?<br>

                <div class="cb_10"></div>
                But I say to you that something greater than the temple is here. But if you knew 
                what <em>this</em> means, &quot;I desire mercy and not sacrifice,&quot; you would not have condemned the 
                guiltless. For the Son of Man is Lord of the Sabbath.';

            break;
            case 'matt12_5':

                $tmp_verse_array['REFERENCE'][0]        = '12:5';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'Or have you not read in the law that on the Sabbath the priests in the temple profane the Sabbath and are guiltless?';
                $tmp_verse_array['COPY'][0]             = 'Or have you not read in the law that on the Sabbath the priests in the 
                temple profane the Sabbath and are guiltless?';

            break;
            case 'matt13_4':

                $tmp_verse_array['REFERENCE'][0]        = '13:4';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'And as he sowed, some fell beside the way, and the birds came and devoured them.';
                $tmp_verse_array['COPY'][0]             = 'And as he sowed, some <a id="sup_ftnt_1" href="#" class="script_sup" onclick="jony5_vv_scroll_to(\'ftnt_1\');">1</a><em>seeds</em> 
                fell <a id="sup_ftnt_2" href="#" class="script_sup" onclick="jony5_vv_scroll_to(\'ftnt_2\');">2</a>beside 
                the way, and the birds came and devoured them.';

            break;
            case 'matt16_25-26':

                $tmp_verse_array['REFERENCE'][0]        = '16:25-26';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'For whoever wants to save his soul-life shall lose it; but whoever loses his soul-life for My sake shall it. For what shall a man be profited if he gains the whole world, but forfeits his soul-life? Or what shall a man give in exchange for his soul-life?';
                $tmp_verse_array['COPY'][0]             = 'For whoever wants to save his soul-life shall lose it; but whoever loses 
                his soul-life for My sake shall it. For what shall a man be profited if he gains the whole world, but 
                forfeits his soul-life? Or what shall a man give in exchange for his soul-life?';

            break;
            case 'matt19_12':

                $tmp_verse_array['REFERENCE'][0]        = '19:12';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'For there are eunuchs who were born so from their mother\'s womb, and there are eunuchs who were made eunuchs by men, and there are eunuchs who made themselves eunuchs because of the kingdom of the heavens. He who can, let him accept.';
                $tmp_verse_array['COPY'][0]             = 'For there are eunuchs who were born so from their mother\'s womb, and 
                there are eunuchs who were made eunuchs by men, and there are eunuchs who made themselves eunuchs 
                because of the kingdom of the heavens. He who can <em>accept it</em>, let him accept <em>it</em>.';

            break;
            case 'matt24_8-14':

                $tmp_verse_array['REFERENCE'][0]        = '24:8-14';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'All these things are the beginning of birth pangs. Then they will deliver you up to tribulation and will kill you, and you will be hated by all the nations because of My name. And at that time many will be stumbled and will deliver up one another and will hate one another. And many false prophets will arise and will lead many astray. And because lawlessness will be multiplied, the love of the many will grow cold.';
                $tmp_verse_array['COPY'][0]             = 'All these things are the beginning of birth pangs. Then they will 
                deliver you up to tribulation and will kill you, and you will be hated by all the nations because of 
                My name. And at that time many will be stumbled and will deliver up one another and will hate one 
                another. And many false prophets will arise and will lead many astray. And because lawlessness will 
                be multiplied, the love of the many will grow cold.<br>

                <div class="cb_10"></div>
                But he who has endured to the end, this one shall be saved. And this gospel of the kingdom will be 
                preached in the whole inhabited earth for a testimony to all the nations, and then the end 
                will come.';

            break;
            case 'matt24_14':

                $tmp_verse_array['REFERENCE'][0]        = '24:14';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'And this gospel of the kingdom will be preached in the whole inhabited earth for a testimony to all the nations, and then the end will come.';
                $tmp_verse_array['COPY'][0]             = 'And this gospel of the kingdom will be preached in the whole 
                inhabited earth for a testimony to all the nations, and then the end will come.';

            break;
            case 'matt24_15-22':

                $tmp_verse_array['REFERENCE'][0]        = '24:15-22';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'Therefore when you see the abomination of desolation, which was spoken of through Daniel the prophet, standing in the Holy Place (let him who reads understand), Then let those in Judea flee to the mountains; Let him who is on the housetop not come down to take the things out of his house; And let him who is in the field not turn back to take his garment.';
                $tmp_verse_array['COPY'][0]             = 'Therefore when you see the abomination of desolation, which was 
                spoken of through Daniel the prophet, standing in the Holy Place<br>
                (let <a id="sup_ftnt_1" href="#" class="script_sup" onclick="jony5_vv_scroll_to(\'ftnt_1\');">1</a>him 
                who reads understand), Then let those in Judea flee to the mountains; Let him who is on the housetop 
                not come down to take the things out of his house; And let him who is in the field not turn back to 
                take his garment. But woe to those who are pregnant and to those who are nursing <em>babies</em> in 
                those days. And pray that your flight may not be in winter, nor on a Sabbath,<br>

                <div class="cb_10"></div>
                For at that time there will be great tribulation, such as has not occurred from the beginning of the 
                world until now, nor shall by any means ever occur. And unless those days had been cut short, no 
                flesh would be saved; but on account of the chosen, those days will be cut short.';

            break;
            case 'matt25_4':

                $tmp_verse_array['REFERENCE'][0]        = '25:4';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'But the prudent took oil in their vessels with their lamps.';
                $tmp_verse_array['COPY'][0]             = 'But the prudent took oil in their vessels with their lamps.';

            break;
            case 'matt25_23,10b':

                $tmp_verse_array['REFERENCE'][0]        = '25:23, 10b';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = '23 His master said to him, Well, good and faithful slave. You were faithful over a few things; I will set you over many things. Enter into the joy of your master. 10b And those who were ready went in with him to the wedding feast. And the door was shut.';
                $tmp_verse_array['COPY'][0]             = '<span class="script_ref_num">23</span> His master said to him, Well 
                <em>done</em>, good and faithful slave. You were faithful over a few things; I will set you over 
                many things. Enter into the joy of your master.

                <div class="cb_10"></div>
                <span class="script_ref_num">10b</span> And those who were ready went in with him to the wedding 
                feast. And the door was shut.';

            break;
            case 'matt26_33-35,69-75':

                $tmp_verse_array['REFERENCE'][0]        = '26:33-35, 69-75';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = '33 Then Peter answered and said to Him, If all will be stumbled because of You, I will never be stumbled. Jesus said to him, Truly I say to you that in this night, before a rooster crows, you will deny Me three times.';
                $tmp_verse_array['COPY'][0]             = '<span class="script_ref_num">33</span> Then Peter answered and said to 
                Him, If all will be stumbled because of You, I will never be stumbled. Jesus said to him, Truly I say to 
                you that in this night, before a rooster crows, you will deny Me three times. Peter said to Him, Even if 
                I must die with You, I will by no means deny You. And all the disciples said likewise.

                <div class="cb_10"></div>
                <span class="script_ref_num">69</span> Now Peter was sitting outside in the courtyard, and a servant 
                girl came to him and said, You also were with Jesus the Galilean. But he denied <em>it</em> before all, 
                saying, I do not know what you are talking about! And after he had gone out to the porch, another girl 
                saw him and said to those who were there, This man was with Jesus<br>the Nazarene.

                <div class="cb_10"></div>
                And again he denied with an oath, I do not know the man! And after a little while those who were 
                standing <em>there</em> came to Peter and said, Surely you also are one of them, for your speech also 
                makes it clear <em>that</em> you <em>are</em>. Then he began to curse and to swear: I do not know the 
                man! And immediately a rooster crowed.

                <div class="cb_10"></div>
                And Peter remembered the word which Jesus has said, Before a rooster crows, you will deny Me three 
                times. And he went out and wept bitterly.';

            break;
            case 'matt27_46':

                $tmp_verse_array['REFERENCE'][0]        = '27:46';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'And about the ninth hour Jesus cried out with a loud voice, saying, Eli, Eli, lama sabachthani? that is, My God, My God, why have You forsaken Me?';
                $tmp_verse_array['COPY'][0]             = 'And about the ninth hour Jesus cried out with a loud voice, saying, 
                Eli, Eli, lama sabachthani? that is, My God, My God, why have You forsaken Me?';

            break;
            case 'mark7_19-23':

                $tmp_verse_array['REFERENCE'][0]        = '7:19-23';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'Because it does not enter into his heart, but into the stomach, and goes out into the drain? (He made all foods clean.) And He said, That which goes out of the man, that defiles the man. For from within, out of the heart of men, proceed evil reasonings, fornications, thefts, murders, adulteries, covetousness, wickedness, deceit, licentiousness, envy, blasphemy, arrogance, foolishness. All these wicked things proceed from within and defile the man.';
                $tmp_verse_array['COPY'][0]             = 'Because it does not enter into his heart, but into the stomach, and 
                goes out into the drain? (<em>In saying this,</em> He made all foods clean.) And He said, That which 
                goes out of the man, that defiles the man. For from within, out of the heart of men, proceed evil 
                reasonings, fornications, thefts, murders, adulteries, covetousness, wickedness, deceit, 
                licentiousness, envy, blasphemy, arrogance, foolishness. All these wicked things proceed from within 
                and defile the man.';

            break;
            case 'mark9_50':

                $tmp_verse_array['REFERENCE'][0]        = '9:50';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'Salt is good, but if the salt becomes unsalty, with what will you restore its saltiness? Have salt in yourselves and be at peace with one another.';
                $tmp_verse_array['COPY'][0]             = 'Salt is good, but if the salt becomes unsalty, with what will you restore 
                its saltiness? Have salt in yourselves and be at peace with one another.';

            break;
            case 'mark14_27-31,66-72':

                $tmp_verse_array['REFERENCE'][0]        = '14:27-31, 66-72';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = '27 And Jesus said to them, You will all be stumbled, because it is written, &quot;I will smite the Shepherd, and the sheep will be scattered.&quot; But after I have been raised, I will go before you into Galilee.';
                $tmp_verse_array['COPY'][0]             = '<span class="script_ref_num">27</span> And Jesus said to them, You will all be stumbled, because it is written, 
                &quot;I will smite the Shepherd, and the sheep will be scattered.&quot; But after I have been raised, I 
                will go before you into Galilee. 

                <div class="cb_10"></div>
                But Peter said to Him, Even if all will be stumbled, yet I will not! And Jesus said to him, Truly I say 
                to you that today in this night, before a rooster crows twice, you will deny Me three times. But he went 
                on speaking more intensely, <em>Even</em> if I must die with You, I will by no means deny You! And they 
                all said similarly.

                <div class="cb_10"></div>
                <span class="script_ref_num">66</span> And while Peter was below in the courtyard, one of the servant 
                girls of the high priest came, And seeing Peter warming himself, she looked at him and said, You also 
                were with the Nazarene, Jesus. But he denied <em>it</em>, saying, I neither know nor understand what you 
                are talking about. And he went outside into the forecourt, and a<br>rooster crowed.

                <div class="cb_10"></div>
                And the servant girl, seeing him, began again to say to those standing by, This man is <em>one</em> of 
                them! But again he denied <em>it</em>. And after a little while, those standing by again said to Peter, 
                Surely you are <em>one</em> of them, for you are a Galilean as well. But he began to curse and to swear, 
                I do not know this man of whom you speak!

                <div class="cb_10"></div>And immediately a rooster crowed a second time. And Peter remembered the word, 
                how Jesus had said to him, Before a rooster crows twice, you will deny Me three times. And thinking upon 
                it,<br>he wept.';

            break;
            case 'luke1_26-33':

                $tmp_verse_array['REFERENCE'][0]        = '1:26-33';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'And in the sixth month the angel Gabriel was sent from God to a city of Galilee named Nazareth, To a virgin engaged to a man named Joseph, of the house of David; and the virgin\'s name was Mary. And he came to her and said, Rejoice, you who have been graced! The Lord is with you.';
                $tmp_verse_array['COPY'][0]             = 'And in the sixth month the angel Gabriel was sent from God to a city 
                of Galilee named Nazareth, To a virgin engaged to a man named Joseph, of the house of David; and the
                virgin\'s name was Mary. And he came to her and said, Rejoice, you who have been graced! The Lord is 
                with you. 

                <div class="cb_10"></div>
                And she was greatly troubled at this saying and began reasoning what kind of greeting this might be. 
                And the angel said to her, Do not be afraid, Mary, for you have found grace with God. And behold, 
                you will conceive in <em>your</em> womb and bear a son, and you shall call His name Jesus. 

                <div class="cb_10"></div>
                He will be great and will be called Son of the Most High; and the Lord God will give to Him the 
                throne of David His father, And He will reign over the house of Jacob forever, and of His kingdom 
                there will be<br>no end.';

            break;
            case 'luke9_1-6':

                $tmp_verse_array['REFERENCE'][0]        = '9:1-6';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'And He called together the twelve and gave them power and authority over all the demons and to heal diseases. And He sent them to proclaim the kingdom of God and to heal the sick. And He said to them, Take nothing for the journey, neither a staff nor a bag nor bread nor money, nor have two tunics apiece. And into whatever house you enter, remain there and from there go out. And as many as do not receive you, as you go out from that city, shake off the dust from your feet for a testimony against them.';
                $tmp_verse_array['COPY'][0]             = 'And He called together the twelve and gave them power and authority 
                over all the demons and to heal diseases. And He sent them to proclaim the kingdom of God and to 
                heal the sick. And He said to them, Take nothing for the journey, neither a staff nor a bag nor 
                bread nor money, nor have two tunics apiece. And into whatever house you enter, remain there and 
                from there go out. And as many as do not receive you, as you go out from that city, shake off the 
                dust from your feet for a testimony against them. 

                <div class="cb_10"></div>
                And they went out and passed through village after village, announcing the gospel and 
                healing everywhere.';

            break;
            case 'luke9_5-6':

                $tmp_verse_array['REFERENCE'][0]        = '9:5-6';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'And as many as do not receive you, as you go out from that city, shake off the dust from your feet for a testimony against them. And they went out and passed through village after village, announcing the gospel and healing everywhere.';
                $tmp_verse_array['COPY'][0]             = 'And as many as do not receive you, as you go out from that city, 
                shake off the dust from your feet for a testimony against them. And they went out and passed through 
                village after village, announcing the gospel and healing everywhere.';

            break;
            case 'luke10_19':

                $tmp_verse_array['REFERENCE'][0]        = '10:19';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'Behold, I have given you the authority to tread upon serpents and scorpions and over all the power of the enemy, and nothing shall by any means hurt you.';
                $tmp_verse_array['COPY'][0]             = 'Behold, I have given you the authority to tread upon serpents and 
                scorpions and over all the power of the enemy, and nothing shall by any means hurt you.';

            break;
            case 'luke12_35':

                $tmp_verse_array['REFERENCE'][0]        = '12:35';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'Let your loins be girded and your lamps burning,';
                $tmp_verse_array['COPY'][0]             = 'Let your loins be girded and your lamps burning,';

            break;
            case 'luke12_34-44':

                $tmp_verse_array['REFERENCE'][0]        = '12:34-44';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'For where your treasure is, there also your heart will be. Let your loins be girded and your lamps burning, And you be like men waiting for their own master when he returns from the wedding feast, so that when he comes and knocks they may  open to him immediately. Blessed are those slaves whom the master, when he comes, will find watching. Truly I tell you that he will gird himself and will have them recline, and he will come to and serve them.';
                $tmp_verse_array['COPY'][0]             = 'For where your treasure is, there also your heart will be. Let your 
                loins be girded and your lamps burning, And you be like men waiting for their own master when he 
                returns from the wedding feast, so that when he comes and knocks they may open to him immediately. 
                Blessed are those slaves whom the master, when he comes, will find watching. Truly I tell you that 
                he will gird himself and will have them recline <em>at table</em>, and he will come to <em>them</em>
                and serve them.

                <div class="cb_10"></div>
                And if he comes in the second watch, or if in the third, and finds <em>them</em> so, blessed are 
                those <em>slaves</em>. But know this, that if the master of the house had known in what hour the 
                thief was coming, he would not have allowed his house to be broken into. You also, be ready, because 
                at an hour when you do not expect <em>it</em>, the Son of Man<br>is coming. 

                <div class="cb_10"></div>
                And Peter said, Lord, are You saying his parable to us, or also to all? And the Lord said, Who then 
                is the faithful <em>and</em> prudent steward, whom the master will set over his service to give <em>them</em>
                their portion of food at the proper time?
                <div class="cb_10"></div>

                Blessed is that slave whom his master, when he comes, will find so doing. Truly I tell you that he 
                will set him over all his possessions.';

            break;
            case 'luke13_17':

                $tmp_verse_array['REFERENCE'][0]        = '13:17';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'And when He said these things, all those opposing Him were put to shame, and all the crowd rejoiced over all the glorious things that were being done by Him.';
                $tmp_verse_array['COPY'][0]             = 'And when He said these things, all those opposing Him were put to 
                shame, and all the crowd rejoiced over all the glorious things that were being done by Him.';

            break;
            case 'luke14_31-32':

                $tmp_verse_array['REFERENCE'][0]        = '14:31-32';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'Or what king, going to engage another king in war, will not first sit down and deliberate whether he is able with ten thousand to meet the one coming against him with twenty thousand? Otherwise, while he is yet at a distance, he sends an envoy and asks for the of peace.';
                $tmp_verse_array['COPY'][0]             = 'Or what king, going to engage another king in war, will not first sit 
                down and deliberate whether he is able with ten thousand to meet the one coming against him with twenty 
                thousand? Otherwise, while he is yet at a distance, he sends an envoy and asks for the <em>terms</em><br> 
                of peace.';

            break;
            case 'luke14_34-35':

                $tmp_verse_array['REFERENCE'][0]        = '14:34-35';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'Therefore salt is good; but if even the salt becomes tasteless, with what will its saltiness be restored? It is fit neither for the land nor for the manure pile; they will throw it out. He who has ears to hear, let him hear.';
                $tmp_verse_array['COPY'][0]             = 'Therefore salt is good; but if even the salt becomes tasteless, with what 
                will its saltiness be restored? It is fit neither for the land nor for the manure pile; they will throw 
                it out. He who has ears to hear, let him hear.';

            break;
            case 'luke18_11-12':

                $tmp_verse_array['REFERENCE'][0]        = '18:11-12';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'The Pharisee stood and prayed these things to himself: God, I thank You that I am not like the rest of men&ndash;&ndash;extortioners, unjust, adulterers, or even like this tax collector. I fast twice a week; I give a tenth of all that I get.';
                $tmp_verse_array['COPY'][0]             = 'The Pharisee stood and prayed these things to himself: God, I thank 
                You that I am not like the rest of men&ndash;&ndash;extortioners, unjust, adulterers, or even like 
                this tax collector. I fast twice a week; I give a tenth of all that I get.';

            break;
            case 'luke18_13':

                $tmp_verse_array['REFERENCE'][0]        = '18:13';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'But the tax collector, standing at a distance, would not even lift up his eyes to heaven, but beat his breast, saying, God, be propitiated to me, the sinner!';
                $tmp_verse_array['COPY'][0]             = 'But the tax collector, standing at a distance, would not even lift up 
                his eyes to heaven, but beat his breast, saying, God, be propitiated to me, the sinner!';

            break;
            case 'luke19_12,14,15,27':

                $tmp_verse_array['REFERENCE'][0]        = '19:12, 14, 15, 27';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = '12 He said therefore, A certain man of noble birth went to a distant country to receive for himself a kingdom and to return. 14 But his citizens hated him and sent an envoy after him, saying, We do not want this man to reign over us.';
                $tmp_verse_array['COPY'][0]             = '<span class="script_ref_num">12</span> He said therefore, A certain 
                man of noble birth went to a distant country to receive for himself a kingdom and to return.

                <div class="cb_10"></div>
                <span class="script_ref_num">14</span> But his citizens hated him and 
                sent an envoy after him, saying, We do not want this man to reign over us.

                <div class="cb_10"></div>
                <span class="script_ref_num">15</span> And when he came back, having received the kingdom, he 
                commanded that those slaves to whom he had given the money should be called to him so that he might
                know what they had gained by doing business.

                <div class="cb_10"></div>
                <span class="script_ref_num">27</span> However, these enemies of mine, who did not want me to reign 
                over them, bring <em>them</em> here and slay them before me.';

            break;
            case 'luke22_24-30':

                $tmp_verse_array['REFERENCE'][0]        = '22:24-30';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'And a contention also occurred among them as to which of them seemed to be greatest. And He said to them, The kings of the Gentiles lord it over them, and those who have authority over them are called benefactors.';
                $tmp_verse_array['COPY'][0]             = 'And a contention also occurred among them as to which of them seemed to 
                be greatest. And He said to them, The kings of the Gentiles lord it over them, and those who have 
                authority over them are called benefactors. 

                <div class="cb_10"></div>But you shall not be so; but let the greatest among you become like the 
                youngest, and the one who leads like the one who serves. 

                <div class="cb_10"></div>
                For who is greater, the one who reclines <em>at table</em> or the one who serves? Is it not the one who 
                reclines <em>at table</em>? But I am in your midst as the one who serves. But you are those who have 
                remained with Me throughout My trials. And I appoint to you, even as My Father has appointed to Me, a 
                kingdom, That you may eat and drink at My table in My kingdom; and you will sit on thrones judging the 
                twelve tribes of Israel.';

            break;
            case 'luke22_33-34,54-62':

                $tmp_verse_array['REFERENCE'][0]        = '22:33-34, 54-62';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = '33 And he said to Him, Lord, I am ready to go with You both to prison and to death. But He said, I tell you, Peter, a rooster will not crow today until you deny three times that you know Me.';
                $tmp_verse_array['COPY'][0]             = '<span class="script_ref_num">33</span> And he said to Him, Lord, I am 
                ready to go with You both to prison and to death. But He said, I tell you, Peter, a rooster will not 
                crow today until you deny three times that you know Me.

                <div class="cb_10"></div>
                <span class="script_ref_num">54</span> And having arrested Him, they led <em>Him away</em>, and brought 
                <em>Him</em> into the house of the high priest. But Peter followed at a distance. And when they had lit 
                a fire in the middle of the courtyard and sat down together, Peter sat among them. And a certain servant 
                girl, seeing him seated in the light <em>of the fire</em>, looked intently at him and said, This man was 
                with Him too.

                <div class="cb_10"></div>
                But he denied <em>it</em>, saying, I do not know Him, woman. And after a short time, another person, 
                seeing him, said, You also are one of them. But Peter said, Man, I am not!

                <div class="cb_10"></div>
                And after about one hour had passed, another one insisted, saying, Surely this man was also with Him, 
                for he is also a Galilean. But Peter said, Man, I do not know what you are saying. And instantly, while 
                he was still speaking, a rooster crowed. 

                <div class="cb_10"></div>
                And the Lord turned and looked at Peter, and Peter remembered the word of the Lord, how He had said to 
                him, Before a rooster crows today, you will deny Me three times. 

                <div class="cb_10"></div>
                And he went outside and wept bitterly.';

            break;
            case 'luke22_42':
            case 'luke22_42[solo]':

                $tmp_verse_array['REFERENCE'][0]        = '22:42';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'Saying, Father, if You are willing, remove this cup from Me; yet, not My will, but Yours be done.';
                $tmp_verse_array['COPY'][0]             = 'Saying, Father, if You are willing, remove this cup from Me; yet, not 
                My will, but Yours be done.';

            break;
            case 'luke23_27-30':

                $tmp_verse_array['REFERENCE'][0]        = '23:27-30';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'And a great multitude of the people and of women who were mourning and lamenting Him followed Him. But Jesus turned to them and said, Daughters of Jerusalem, do not weep over Me, but weep over yourselves and over your children. For behold, the days are coming in which they will say, Blessed are the barren, and the wombs which have not borne, and the breasts which have not nourished.';
                $tmp_verse_array['COPY'][0]             = 'And a great multitude of the people and of women who were mourning 
                and lamenting Him followed Him. But Jesus turned to them and said, Daughters of Jerusalem, do not 
                weep over Me, but weep over yourselves and over your children. For behold, the days are coming in 
                which they will say, Blessed are the barren, and the wombs which have not borne, and the breasts 
                which have not nourished. Then they will begin to say to the mountains, Fall on us! and to the 
                hills, Cover us!';

            break;
            case 'luke23_38,42-43':

                $tmp_verse_array['REFERENCE'][0]        = '23:38, 42-43';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = '38 And there was also an inscription over Him : THIS IS THE KING OF THE JEWS. 42 And he said, Jesus, remember me when You come into Your kingdom. And He said to him, Truly I say to you, Today you shall be with Me in Paradise.';
                $tmp_verse_array['COPY'][0]             = '<span class="script_ref_num">38</span> And there was also an 
                inscription over Him : THIS IS THE KING OF THE JEWS.

                <div class="cb_10"></div>
                <span class="script_ref_num">42</span> And he said, Jesus, remember me when You come into Your 
                kingdom. And He said to him, Truly I say to you, Today you shall be with Me in Paradise.';

            break;
            case 'luke24_31-32':

                $tmp_verse_array['REFERENCE'][0]        = '24:31-32';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'And their eyes were opened, and they recognized Him; and He disappeared from them. And they said to one another, Was not our heart burning within us while He was speaking to us on the road, while He was opening to us the Scriptures?';
                $tmp_verse_array['COPY'][0]             = 'And their eyes were opened, and they recognized Him; and He 
                disappeared from them. And they said to one another, Was not our heart burning within us while He 
                was speaking to us on the road, while He was opening to us the Scriptures?';

            break;
            case 'john2_20-21':

                $tmp_verse_array['REFERENCE'][0]        = '2:20-21';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'Then the Jews said, This temple was built in forty-six years, and You will raise it up in three days? But He spoke of the temple of His body.';
                $tmp_verse_array['COPY'][0]             = 'Then the Jews said, This temple was built in forty-six years, and You 
                will raise it up in three days? But He spoke of the temple of His body.';

            break;
            case 'john2_21':

                $tmp_verse_array['REFERENCE'][0]        = '2:21';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'But He spoke of the temple of His body.';
                $tmp_verse_array['COPY'][0]             = 'But He spoke of the temple of His body.';

            break;
            case 'john5_24-25':

                $tmp_verse_array['REFERENCE'][0]        = '5:24-25';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'Truly, truly, I say to you, He who hears My word and believes Him who sent Me has eternal life, and does not come into judgement but has passed out of death into life. Truly, truly, I say to you, An hour is coming, and it is now, when the dead will hear the voice of the Son of God, and those who hear will live.';
                $tmp_verse_array['COPY'][0]             = 'Truly, truly, I say to you, He who hears My word and believes Him 
                who sent Me has eternal life, and does not come into judgement but has passed out of death into 
                life. Truly, truly, I say to you, An hour is coming, and it is now, when the dead will hear the 
                voice of the Son of God, and those who hear will live.';

            break;
            case 'john8_1-11':

                $tmp_verse_array['REFERENCE'][0]        = '8:1-11';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'But Jesus went to the Mount of Olives. And early in the morning He came again into the temple, and all the people came to Him, and He sat down and taught them. And the scribes and Pharisees brought a woman caught in adultery, and having set her in the midst,';
                $tmp_verse_array['COPY'][0]             = 'But Jesus went to the Mount of Olives. And early in the morning He came 
                again into the temple, and all the people came to Him, and He sat down and taught them.

                <div class="cb_10"></div>
                And the scribes and Pharisees brought a woman caught in adultery, and having set her in the midst, They 
                said to Him, Teacher, this woman has been caught committing adultery, in the very act. Now in the law, 
                Moses commanded us to stone such women. What then do you say?

                <div class="cb_10"></div>
                But they said this to tempt Him, so that they might have to accuse Him. But Jesus 
                stooped down and <a id="sup_ftnt_1" href="#" class="script_sup" onclick="jony5_vv_scroll_to(\'ftnt_1\');">1</a>wrote 
                with His finger on the ground. But when they persisted in questioning Him, He stood up and said to them, 
                He who is without sin among you, let him <em>be the</em> first to throw a stone at her.

                <div class="cb_10"></div>
                And again He stooped down and wrote on the ground. And when they heard <em>that</em>, they went out one 
                by one, beginning with the older ones. And Jesus was left alone, and the woman <em>stood</em> where she 
                was, in the midst.

                <div class="cb_10"></div>
                And Jesus stood up and said to her, Woman, where are they? Has no one condemned you? And she said, No 
                one, Lord. And Jesus said, Neither do I condemn you; go, and from now on sin no more.';

            break;
            case 'john8_6':

                $tmp_verse_array['REFERENCE'][0]        = '8:6';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'But they said this to tempt Him, so that they might have to accuse Him. But Jesus stooped down and wrote with His finger on the ground.';
                $tmp_verse_array['COPY'][0]             = 'But they said this to tempt Him, so that they might have to accuse Him. 
                But Jesus stooped down and wrote with His finger on the ground.';

            break;
            case 'john8_51-59':

                $tmp_verse_array['REFERENCE'][0]        = '8:51-59';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'Truly, truly, I say to you, If anyone keeps My word, he shall by no means see death forever. The Jews therefore said to Him, Now we know that You have a demon. Abraham died, and the prophets; yet You say, If anyone keeps My word, he shall by no means taste death forever. Are You greater than our father Abraham, who died? The prophets died too. Who are You making Yourself?';
                $tmp_verse_array['COPY'][0]             = 'Truly, truly, I say to you, If anyone keeps My word, he shall by no 
                means see death forever. The Jews therefore said to Him, Now we know that You have a demon. Abraham 
                died, and the prophets <em>too</em>; yet You say, If anyone keeps My word, he shall by no means 
                taste death forever. Are You greater than our father Abraham, who died? The prophets died too. Who 
                are You making Yourself?

                <div class="cb_10"></div>
                Jesus answered, If I glorify Myself, My glory is nothing; it is My Father who glorifies Me, of whom 
                you say that He is your God. Yet you have not known Him, but I know Him. And if I say that I do not 
                know Him, I will be like you, a liar; but I do know Him and I keep His word. Your father Abraham 
                exulted that he would see My day, and he saw <em>it</em> and rejoiced.

                <div class="cb_10"></div>
                The Jews then said to Him, You are not yet fifty years old, and have You seen Abraham? Jesus said to 
                them, Truly, truly, I say to you, Before Abraham came into being, I am. So they picked up stones to 
                throw at Him, but Jesus was hidden and went out of the temple.';

            break;
            case 'john9_41':

                $tmp_verse_array['REFERENCE'][0]        = '9:41';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'Jesus said to them, If you were blind, you would not have sin; but now you say, We see; your sin remains.';
                $tmp_verse_array['COPY'][0]             = 'Jesus said to them, If you were blind, you would not have sin; but now 
                you say, We see; your sin remains.';

            break;
            case 'john13_3-17':

                $tmp_verse_array['REFERENCE'][0]        = '13:3-17';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'Knowing that the Father had given all into His hands and that He had come forth from God and was going to God, Rose from supper and laid aside His outer garments; and taking a towel, He girded Himself';
                $tmp_verse_array['COPY'][0]             = '<em>Jesus</em> knowing that the Father had given all into His hands and 
                that He had come forth from God and was going to God, Rose from supper and laid aside His outer 
                garments; and taking a towel, He girded Himself;

                <div class="cb_10"></div>
                Then He poured water into the basin and began to wash the disciples\' feet and to wipe <em>them</em> 
                with the towel with which He was girded. He came then to Simon Peter. <em>Peter</em> said to Him, Lord, 
                do You wash my feet? Jesus answered and said to him, What I am doing you do not know now, but you will 
                know after these things. 

                <div class="cb_10"></div>
                Peter said to Him, You shall by no means wash my feet forever. Jesus answered him, Unless I wash you, 
                you have no part with Me. Simon Peter said to Him, Lord, not my feet only, but also my hands and my 
                head. Jesus said to him, He who is bathed has no need except to wash his feet, but is wholly clean; and 
                you are clean, but not all <em>of you</em>. For He knew the one betraying Him; for this <em>reason</em> 
                He said, Not all of you are clean.

                <div class="cb_10"></div>
                Then when He has washed their feet and taken His outer garments and reclined <em>at the table again</em>,
                He said to them, Do you know what I have done to you? You call Me the Teacher and the Lord, and you say 
                rightly, for I am. If I then, the Lord and the Teacher, have washed your feet, you also ought to wash 
                one another\'s feet.

                <div class="cb_10"></div>
                For I have given you an example so that you also may do even as I have done to you. Truly, truly, I say 
                to you, A slave is not greater than his master, nor one who is sent greater than the one who sends him.

                <div class="cb_10"></div>
                If you know these things, blessed are you if you do them.';

            break;
            case 'john13_34':
            case 'john13_34[solo]':

                $tmp_verse_array['REFERENCE'][0]        = '13:34';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'A new commandment I give to you, that you love one another, even as I have loved you, that you also love one another.';
                $tmp_verse_array['COPY'][0]             = 'A new commandment I give to you, that you love one another, even as I 
                have loved you, that you also love one another.';

            break;
            case 'john13_37-38':

                $tmp_verse_array['REFERENCE'][0]        = '13:37-38';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'Peter said to Him, Lord, why can\'t I follow You now? I will lay down my life for You. Jesus answered, Will you lay down your life for Me? Truly, truly, I say to you, A rooster shall by no means crow until you deny Me three times.';
                $tmp_verse_array['COPY'][0]             = 'Peter said to Him, Lord, why can\'t I follow You now? I will lay down my 
                life for You. Jesus answered, Will you lay down your life for Me? Truly, truly, I say to you, A rooster 
                shall by no means crow until you deny Me three times.';

            break;
            case 'john13_37-38;18_14-27':

                $tmp_verse_array['REFERENCE'][0]        = '13:37-38; 18:14-27';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = '13:37 Peter said to Him, Lord, why can\'t I follow You now? I will lay down my life for You. Jesus answered, Will you lay down your life for Me? Truly, truly, I say to you, A rooster shall by no means crow until you deny Me three times.';
                $tmp_verse_array['COPY'][0]             = '<span class="script_ref_num">13:37</span> Peter said to Him, Lord, why 
                can\'t I follow You now? I will lay down my life for You. Jesus answered, Will you lay down your life 
                for Me? Truly, truly, I say to you, A rooster shall by no means crow until you deny Me three times.

                <div class="cb_10"></div>
                <span class="script_ref_num">18:14</span> Now it was Caiaphas who had advised the Jews that it was 
                expedient for one man to die for the people. And Simon Peter followed Jesus, as well as another disciple. 
                And that disciple was known to the high priest, and he entered with Jesus into the court of the high 
                priest; But Peter stood at the door outside. Then the other disciple, the one known to the high priest, 
                went out and spoke to <em>the maid</em> who kept the door and brought Peter in. 

                <div class="cb_10"></div>
                Then the maid who kept the door said to Peter, Are you not also <em>one</em> of this man\'s disciples? 
                He said, I am not. Now the slaves and the attendants were standing <em>there</em>, having made a fire 
                of coals, for it was cold, and they were warming themselves; and Peter also was with them, standing and 
                warming himself.

                <div class="cb_10"></div>
                The high priest then questioned Jesus concerning His disciples and concerning His teaching. Jesus 
                answered him, I have spoken openly to the world; I always taught in the synagogue and in the temple, 
                where all the Jews come together, and I spoke nothing in secret. Why do you question Me? Question those 
                who have heard <em>Me, concerning</em> what I spoke to them; behold, these know what I said. 

                <div class="cb_10"></div>
                And when He said these things, one of the attendants standing by slapped Jesus, saying, Is that how You 
                answer the high priest? Jesus answered him, If I have spoken wrongly, testify concerning the wrong; but 
                if rightly, why do you strike Me? Annas then sent Him bound to Caiaphas the high priest.

                <div class="cb_10"></div>
                Now Simon Peter was standing and warming himself. Then they said to him, Are you not also <em>one</em> 
                of His disciples? He denied and said, I am not. One of the slaves of the high priest, who was a relative 
                of him whose ear Peter had cut off, said, Did I not see you in the garden with Him? Then Peter denied 
                again, and immediately a rooster crowed.';

            break;
            case 'john14_10':

                $tmp_verse_array['REFERENCE'][0]        = '14:10';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'Do you not believe that I am in the Father and the Father is in Me? The words that I say to you I do not speak from Myself, but the Father who abides in Me does His works.';
                $tmp_verse_array['COPY'][0]             = 'Do you not believe that I am in the Father and the Father is in Me? The 
                words that I say to you I do not speak from Myself, but the Father who abides in Me does His works.';

            break;
            case 'john14_10-14':

                $tmp_verse_array['REFERENCE'][0]        = '14:10-14';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'Do you not believe that I am in the Father and the Father is in Me? The words that I say to you I do not speak from Myself, but the Father who abides in Me does His works. Believe Me that I am in the Father and the Father is in Me; but if not, believe because of the works themselves.';
                $tmp_verse_array['COPY'][0]             = 'Do you not believe that I am in the Father and the Father is in Me? The 
                words that I say to you I do not speak from Myself, but the Father who abides in Me does His works. 
                Believe Me that I am in the Father and the Father is in Me; but if not, believe because of the 
                works themselves.

                <div class="cb_10"></div>
                Truly, truly, I say to you, He who believes into Me, the works which I do he shall do also; and greater 
                than these he shall do because I am going to the Father.

                <div class="cb_10"></div>
                And whatever you ask in My name, that I will do, that the Father may be glorified in the Son. If you ask 
                Me anything in My name, I will<br>do <em>it</em>.';

            break;
            case 'john14_12-14':

                $tmp_verse_array['REFERENCE'][0]        = '14:12-14';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'Truly, truly, I say to you, He who believes into Me, the works which I do he shall do also; and greater than these he shall do because I am going to the Father. And whatever you ask in My name, that I will do, that the Father may be glorified in the Son. If you ask Me anything in My name, I will do.';
                $tmp_verse_array['COPY'][0]             = 'Truly, truly, I say to you, He who believes into Me, the works which I do 
                he shall do also; and greater than these he shall do because I am going to the Father. And whatever you 
                ask in My name, that I will do, that the Father may be glorified in the Son. If you ask Me anything in 
                My name, I will do <em>it</em>.';

            break;
            case 'john14_15,20-21':

                $tmp_verse_array['REFERENCE'][0]        = '14:15, 20-21';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = '15 If you love Me, you will keep My commandments. 20 In that day you will know that I am in My Father, and you in Me, and I in you. He who has My commandments and keeps them, he is the one who loves Me; and he who loves Me will be loved by My Father, and I will love him and will manifest Myself to him.';
                $tmp_verse_array['COPY'][0]             = '<span class="script_ref_num">15</span> If you love Me, you will keep My commandments.

                <div class="cb_10"></div>
                <span class="script_ref_num">20</span> In that day you will know that I am in My Father, and you in Me, 
                and I in you. He who has My commandments and keeps them, he is the one who loves Me; and he who loves Me 
                will be loved by My Father, and I will love him and will manifest Myself to him.';

            break;
            case 'john16_15':

                $tmp_verse_array['REFERENCE'][0]        = '16:15';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'All that the Father has is Mine; for this I have said that He receives of Mine and will declare to you.';
                $tmp_verse_array['COPY'][0]             = 'All that the Father has is Mine; for this <em>reason</em> I have said 
                that He receives of Mine and will declare <em>it</em> to you.';

            break;
            case 'acts1_5':

                $tmp_verse_array['REFERENCE'][0]        = '1:5';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'For John baptized with water, but you shall be baptized in the Holy Spirit not many days from now.';
                $tmp_verse_array['COPY'][0]             = 'For John baptized with water, but you shall be baptized in the Holy 
                Spirit not many days from now.';

            break;
            case 'acts2_22-25':

                $tmp_verse_array['REFERENCE'][0]        = '2:22-25';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'Men of Israel, hear these words: Jesus the Nazarene, a man shown by God to you to be approved by works of power and wonders and signs, which God did through Him in your midst, even as you yourselves know&ndash;&ndash; This man, delivered up by the determined counsel and foreknowledge of God, you, through the hand of lawless men, nailed to and killed;';
                $tmp_verse_array['COPY'][0]             = 'Men of Israel, hear these words: Jesus the Nazarene, a man shown by 
                God to you to be approved by works of power and wonders and signs, which God did through Him in your 
                midst, even as you yourselves know&ndash;&ndash; This man, delivered up by the determined counsel 
                and foreknowledge of God, you, through the hand of lawless men, nailed to <em>a cross</em> 
                and killed; 

                <div class="cb_10"></div>
                Whom God has raised up, having loosed the pangs of death, since it was not possible for Him to be 
                held by it. For David says regarding Him, &quot;I saw the Lord continually before me, because He is 
                on my right hand, that I may not be shaken...&quot;';

            break;
            case 'acts8_29':

                $tmp_verse_array['REFERENCE'][0]        = '8:29';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'And the Spirit said to Philip, Approach and join this chariot.';
                $tmp_verse_array['COPY'][0]             = 'And the Spirit said to Philip, Approach and join this chariot.';

            break;
            case 'acts10_15-16b,19-21':

                $tmp_verse_array['REFERENCE'][0]        = '10:15-16b, 19-21';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = '15 And a voice to him again a second time: The things that God has cleansed, do not make common. And this occurred three times. 19 And while Peter was pondering over the vision, the Spirit said to him, Behold, three men seeking you. But rise up, go down and go with them, doubting nothing, because I have sent them.';
                $tmp_verse_array['COPY'][0]             = '<span class="script_ref_num">15</span> And a voice <em>came</em> to 
                him again a second time: The things that God has cleansed, do not make common. And this occurred<br>
                three times.

                <div class="cb_10"></div>
                <span class="script_ref_num">19</span> And while Peter was pondering over the vision, the Spirit 
                said to him, Behold, <em>there are</em> three men seeking you. But rise up, go down and go with 
                them, doubting nothing, because I have sent them. And Peter went down to the men and said, Behold, I 
                am he whom you seek; what is the cause for which you have come?';

            break;
            case 'acts16_6,7':

                $tmp_verse_array['REFERENCE'][0]        = '16:6, 7';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = '6 And they passed through the region of Phrygia and Galatia, having been forbidden by the Holy Spirit to speak the word in Asia. 7 And when they had come to Mysia, they tried to go into Bithynia, yet the Spirit of Jesus did not allow them.';
                $tmp_verse_array['COPY'][0]             = '<span class="script_ref_num">6</span> And they passed through the 
                region of Phrygia and Galatia, having been forbidden by the Holy Spirit to speak the word in Asia. 
                <div class="cb_10"></div>
                <span class="script_ref_num">7</span> And when they had come to Mysia, they tried to go into 
                Bithynia, yet the Spirit of Jesus did not allow them.';

            break;
            case 'acts11_12':

                $tmp_verse_array['REFERENCE'][0]        = '11:12';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'And the Spirit told me to go with them, doubting nothing. And these six brothers went with me also; and we entered into the man\'s house.';
                $tmp_verse_array['COPY'][0]             = 'And the Spirit told me to go with them, doubting nothing. And these 
                six brothers went with me also; and we entered into the<br>man\'s house.';

            break;
            case 'acts11_18':

                $tmp_verse_array['REFERENCE'][0]        = '11:18';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'And when they heard these things, they became silent and glorified God, saying, Then to the Gentiles also God has given repentance unto life.';
                $tmp_verse_array['COPY'][0]             = 'And when they heard these things, they became silent and glorified 
                God, saying, Then to the Gentiles also God has given repentance<br>unto life.';

            break;
            case 'rom2_6-7':

                $tmp_verse_array['REFERENCE'][0]        = '2:6-7';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'Who will render to each according to his works: To those who by endurance in good work seek glory and honor and incorruptibility, life eternal;';
                $tmp_verse_array['COPY'][0]             = 'Who will render to each according to his works: To those who by endurance 
                in good work seek glory and honor and incorruptibility,<br>life eternal;';

            break;
            case 'rom5_1-5[000]':
            case 'rom5_1-5':

                $tmp_verse_array['REFERENCE'][0]        = '5:1-5';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'Therefore having been justified out of faith, we have peace toward God through our Lord Jesus Christ, Through whom also we have obtained access by faith into this grace in which we stand and boast because if the hope of the glory of God.';
                $tmp_verse_array['COPY'][0]             = 'Therefore having been justified out of faith, we have peace toward God 
                through our Lord Jesus Christ, Through whom also we have obtained access by faith into this grace in 
                which we stand and boast because of the hope of the glory of God.

                <div class="cb_10"></div>
                And not only so, but we also boast in our tribulations, knowing that tribulation produces endurance; And 
                endurance, approvedness; and approvedness, hope;

                <div class="cb_10"></div>
                And hope does not put <em>us</em> to shame, because the love of God has been poured 
                out in our hearts through the Holy Spirit, who has been given to us.';

            break;
            case 'rom5_10':

                $tmp_verse_array['REFERENCE'][0]        = '5:10';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'For if we, being enemies, were reconciled to God through the death of His Son, much more we will be saved in His life, having been reconciled.';
                $tmp_verse_array['COPY'][0]             = 'For if we, being enemies, were reconciled to God through the death of 
                His Son, much more we will be saved in His life, having<br>been reconciled.';

            break;
            case 'rom5_14,17,21':

                $tmp_verse_array['REFERENCE'][0]        = '5:14, 17, 21';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = '14 But death reigned from Adam until Moses, even over those who had not sinned after the likeness of Adam\'s transgression, who is a type of Him who was to come. 17 For if, by the offense of the one, death reigned through the one, much more those who receive the abundance of grace and of the gift of righteousness will reign in life through the One, Jesus Christ.';
                $tmp_verse_array['COPY'][0]             = '<span class="script_ref_num">14</span> But death reigned from Adam 
                until Moses, even over those who had not sinned after the likeness of Adam\'s transgression, who is 
                a type of Him who was to come.

                <div class="cb_10"></div>
                <span class="script_ref_num">17</span> For if, by the offense of the one, death reigned through the 
                one, much more those who receive the abundance of grace and of the gift of righteousness will reign 
                in life through the One, Jesus Christ.
                <div class="cb_10"></div>
                <span class="script_ref_num">21</span> In order that just as sin reigned in death, so also grace 
                might reign through righteousness unto eternal life through Jesus Christ our Lord.';

            break;
            case 'rom6_3':

                $tmp_verse_array['REFERENCE'][0]        = '6:3';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'Or are you ignorant that all of us who have been baptized into Christ Jesus have been baptized into His death?';
                $tmp_verse_array['COPY'][0]             = 'Or are you ignorant that all of us who have been baptized into Christ 
                Jesus have been baptized into His death?';

            break;
            case 'rom6_8':

                $tmp_verse_array['REFERENCE'][0]        = '6:8';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'Now if we have died with Christ, we believe that we will also live with Him.';
                $tmp_verse_array['COPY'][0]             = 'Now if we have died with Christ, we believe that we will also live<br>
                with Him.';

            break;
            case 'rom6_8-11':

                $tmp_verse_array['REFERENCE'][0]        = '6:8-11';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'Now if we have died with Christ, we believe that we will also live with Him, Knowing that Christ, having been raised from the dead, dies no more; death lords it over Him no more. For which He died, He died to sin once for all; but which He lives, He lives to God. So also you, reckon yourselves to be dead to sin, but living to God in Christ Jesus.';
                $tmp_verse_array['COPY'][0]             = 'Now if we have died with Christ, we believe that we will also live 
                with Him, Knowing that Christ, having been raised from the dead, dies no more; 
                death lords it over Him no more. For <em>the death</em> which He died, He died to sin once for all; 
                but <em>the life</em> which He lives, He lives to God. So also you, reckon yourselves to be dead to 
                sin, but living to God in Christ Jesus.';

            break;
            case 'rom6_9-11':

                $tmp_verse_array['REFERENCE'][0]        = '6:9-11';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'Knowing that Christ, having been raised from the dead, dies no more; death lords it over Him no more. For which He died, He died to sin once for all; but which He lives, He lives to God. So also you, reckon yourselves to be dead to sin, but living to God in Christ Jesus.';
                $tmp_verse_array['COPY'][0]             = 'Knowing that Christ, having been raised from the dead, dies no more; 
                death lords it over Him no more. For <em>the death</em> which He died, He died to sin once for all; 
                but <em>the life</em> which He lives, He lives to God. So also you, reckon yourselves to be dead to 
                sin, but living to God in Christ Jesus.';

            break;
            case 'rom6_18-19[000]':
            case 'rom6_18-19':

                $tmp_verse_array['REFERENCE'][0]        = '6:18-19';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'And having been freed from sin, you were enslaved to righteousness. I speak in human because of the weakness of your flesh. For just as you presented your members as slaves to uncleanness and lawlessness unto lawlessness, so now present your members as slaves to righteousness unto sanctification.';
                $tmp_verse_array['COPY'][0]             = 'And having been freed from sin, you were enslaved to righteousness. I 
                speak in human <em>terms</em> because of the weakness of your flesh. For just as you presented your 
                members as slaves to uncleanness and lawlessness unto lawlessness, so now present your members as 
                slaves to righteousness unto sanctification.';

            break;
            case 'rom6_22':

                $tmp_verse_array['REFERENCE'][0]        = '6:22';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'But now, having been freed from sin and enslaved to God, you have your fruit unto sanctification, and the end, eternal life.';
                $tmp_verse_array['COPY'][0]             = 'But now, having been freed from sin and enslaved to God, you have your 
                fruit unto sanctification, and the end, eternal life.';

            break;
            case 'rom7_2-4,6':

                $tmp_verse_array['REFERENCE'][0]        = '7:2-4, 6';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = '2 For the married woman is bound by the law to her husband while he is living; but if the husband dies, she is discharged from the law regarding the husband. So then if, while the husband is living, she is joined to another man, she will be called an adulteress; but if the husband dies, she is free from the law, so that she is not an adulteress, though she is joined to another man.';
                $tmp_verse_array['COPY'][0]             = '<span class="script_ref_num">2</span> For the married woman is bound 
                by the law to her husband while he is living; but if the husband dies, she is discharged from the 
                law regarding the husband. So then if, while the husband is living, she is joined to another man, 
                she will be called an adulteress; but if the husband dies, she is free from the law, so that she is 
                not an adulteress, though she is joined to another man. So then, my brothers, you also have been 
                made dead to the law through the body of Christ so that you might be joined to another, to Him who 
                has been raised from the dead, that we might bear fruit to God.

                <div class="cb_10"></div>
                <span class="script_ref_num">6</span> But now we have been discharged from the law, having died to 
                that in which we were held, so that we serve in newness of spirit and not in oldness of letter.';

            break;
            case 'rom8_2':

                $tmp_verse_array['REFERENCE'][0]        = '8:2';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'For the law of the Spirit of life has freed me in Christ Jesus from the law of sin and of death.';
                $tmp_verse_array['COPY'][0]             = 'For the law of the Spirit of life has freed me in Christ Jesus from 
                the law of sin and of death.';

            break;
            case 'rom8_2,4':

                $tmp_verse_array['REFERENCE'][0]        = '8:2, 4';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = '2 For the law of the Spirit of life has freed me in Christ Jesus from the law of sin and of death. 4 That the righteous requirement of the law might be fulfilled in us, who do not walk according to the flesh but according to the spirit.';
                $tmp_verse_array['COPY'][0]             = '<span class="script_ref_num">2</span> For the law of the Spirit of 
                life has freed me in Christ Jesus from the law of sin and of death.

                <div class="cb_10"></div>
                <span class="script_ref_num">4</span> That the righteous requirement of the law might be fulfilled 
                in us, who do not walk according to the flesh but according to the spirit.';

            break;
            case 'rom8_14':

                $tmp_verse_array['REFERENCE'][0]        = '8:14';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'For as many as are led by the Spirit of God, these are sons of God.';
                $tmp_verse_array['COPY'][0]             = 'For as many as are led by the Spirit of God, these are sons of God.';

            break;
            case 'rom8_16-17,24-25':

                $tmp_verse_array['REFERENCE'][0]        = '8:16-17, 24-25';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = '16 The Spirit Himself witnesses with our spirit that we are children of God. And if children, heirs also; on the one hand, heirs of God; on the other, joint heirs with Christ, if indeed we suffer with that we may also be glorified with.';
                $tmp_verse_array['COPY'][0]             = '<span class="script_ref_num">16</span> The Spirit Himself witnesses with our spirit that we are children of God. 
                And if children, heirs also; on the one hand, heirs of God; on the other, joint heirs with Christ, if 
                indeed we suffer with <em>Him</em> that we may also be glorified with <em>Him</em>. 

                <div class="cb_10"></div>
                <span class="script_ref_num">24</span> For we were saved in hope. But a hope that is seen is not hope, for who hopes for what he sees? But if 
                we hope for what we do not see, we eagerly await <em>it</em> through endurance.';

            break;
            case 'rom8_14-23':

                $tmp_verse_array['REFERENCE'][0]        = '8:14-23';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'For as many as are led by the Spirit of God, these are sons of God. For you have not received a spirit of slavery into fear again, but you have received a spirit of sonship in which we cry, Abba, Father! The Spirit Himself witnesses with our spirit that we are children of God.';
                $tmp_verse_array['COPY'][0]             = 'For as many as are led by the Spirit of God, these are sons of God. 
                For you have not received a spirit of slavery <em>bringing you</em> into fear again, but you have 
                received a spirit of sonship in which we cry, Abba, Father! The Spirit Himself witnesses with our 
                spirit that we are children of God. And if children, heirs also; on the one hand, heirs of God; 
                on the other, joint heirs with Christ, if indeed we suffer with <em>Him</em> that we may also be 
                glorified with <em>Him</em>. 

                <div class="cb_10"></div>
                For I consider that the sufferings of this present time are not worthy to be compared with the 
                coming glory to be revealed upon us.

                <div class="cb_10"></div>
                For the anxious watching of the creation eagerly awaits the revelation of the sons of God. For the 
                creation was made subject to vanity, not of its own will, but because of Him who subjected <em>it</em>, 
                In hope that the creation itself will also be freed from the slavery of corruption into the freedom 
                of the glory of the children of God. For we know that the whole creation groans together and 
                travails in pain together until now. 

                <div class="cb_10"></div>
                And not only <em>so</em>, but we ourselves also, who have the firstfruis of the Spirit, even we 
                ourselves groan in ourselves, eagerly awaiting sonship, the redemption of our body.';

            break;
            case 'rom8_33-39':

                $tmp_verse_array['REFERENCE'][0]        = '8:33-39';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'Who shall bring a charge against God\'s chosen ones? It is God who justifies. Who is he who condemns? It is Christ Jesus who died and, rather, who was raised, who is also at the right hand of God, who also intercedes for us. Who shall separate us from the love of Christ? Shall tribulation or anguish or persecution or famine or nakedness or peril or sword?';
                $tmp_verse_array['COPY'][0]             = 'Who shall bring a charge against God\'s chosen ones? It is God who 
                justifies. Who is he who condemns? It is Christ Jesus who died and, rather, who was raised, who is 
                also at the right hand of God, who also intercedes for us. Who shall separate us from the love of
                Christ? Shall tribulation or anguish or persecution or famine or nakedness or peril or sword? As it 
                is written, &quot;For Your sake we are being put to death all day long; we have been accounted as 
                sheep for slaughter.&quot; But in all these things we more than conquer through Him who<br>loved us.

                <div class="cb_10"></div>
                For I am persuaded that neither death nor life nor angels nor principalities nor things present nor 
                things to come nor powers Nor height nor depth nor any other creature will be able to separate us 
                from the love of God, which is in Christ Jesus our Lord.';

            break;
            case 'rom9_31-33':

                $tmp_verse_array['REFERENCE'][0]        = '9:31-33';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'But Israel, pursuing a law of righteousness, did not attain to law. Why? Because not out of faith, but as it were out of works. They stumbled at the stone of stumbling, As it is written, &quot;Behold, I lay in Zion a stone of stumbling, a rock of offense, and he who believes on Him shall not be put to shame.&quot;';
                $tmp_verse_array['COPY'][0]             = 'But Israel, pursuing a law of righteousness, did not attain to 
                <em>that</em> law. Why? Because <em>they pursued it</em> not out of faith, but as it were out of 
                works. They stumbled at the stone of stumbling, As it is written, &quot;Behold, I lay in Zion a 
                stone of stumbling, a rock of offense, and he who believes on Him shall not be put to shame.&quot;';

            break;
            case 'rom10_2-3':

                $tmp_verse_array['REFERENCE'][0]        = '10:2-3';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'For I bear them witness that they have a zeal for God, but not according to full knowledge; For because they were ignorant of God\'s righteousness and sought to establish their own righteousness, they were not subject to the righteousness of God.';
                $tmp_verse_array['COPY'][0]             = 'For I bear them witness that they have a zeal for God, but not according 
                to full knowledge; For because they were ignorant of God\'s righteousness and sought to establish their 
                own righteousness, they were not subject to the righteousness of God.';

            break;
            case 'rom12_2':

                $tmp_verse_array['REFERENCE'][0]        = '12:2';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'And do not be fashioned according to this age, but be transformed by the renewing of the mind that you may prove what the will of God is, that which is good and well pleasing and perfect.';
                $tmp_verse_array['COPY'][0]             = 'And do not be fashioned according to this age, but be transformed by the 
                renewing of the mind that you may prove what the will of God is, that which is good and well pleasing 
                and perfect.';

            break;
            case 'rom12_11':

                $tmp_verse_array['REFERENCE'][0]        = '12:11';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'Do not be slothful in zeal, be burning in spirit, serving the Lord.';
                $tmp_verse_array['COPY'][0]             = 'Do not be slothful in zeal, <em>but</em> be burning in spirit, 
                serving the Lord.';

            break;
            case 'rom12_11-12':

                $tmp_verse_array['REFERENCE'][0]        = '12:11-12';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'Do not be slothful in zeal, be burning in spirit, serving the Lord. Rejoice in hope; endure in tribulation; persevere in prayer.';
                $tmp_verse_array['COPY'][0]             = 'Do not be slothful in zeal, <em>but</em> be burning in spirit, 
                serving the Lord. Rejoice in hope; endure in tribulation; persevere in prayer.';

            break;
            case 'rom13_14':

                $tmp_verse_array['REFERENCE'][0]        = '13:14';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'But put on the Lord Jesus Christ, and make no provision for the flesh to its lusts.';
                $tmp_verse_array['COPY'][0]             = 'But put on the Lord Jesus Christ, and make no provision for the flesh 
                to <em>fulfill</em> its lusts.';

            break;
            case 'rom14_1':

                $tmp_verse_array['REFERENCE'][0]        = '14:1';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'Now him who is weak in faith receive, not for the purpose of passing judgement on considerations.';
                $tmp_verse_array['COPY'][0]             = 'Now him who is weak in faith receive, <em>but</em> not for the 
                purpose of passing judgement on <em>his</em> considerations.';

            break;
            case 'rom14_7-12':

                $tmp_verse_array['REFERENCE'][0]        = '14:7-12';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'For none of us lives to himself, and none dies to himself; For whether we live, we live to the Lord, and whether we die, we die to the Lord. Therefore whether we live or we die, we are the Lord\'s. For Christ died and lived for this, that He might be Lord both of the dead and of the living.';
                $tmp_verse_array['COPY'][0]             = 'For none of us lives to himself, and none dies to himself; For 
                whether we live, we live to the Lord, and whether we die, we die to the Lord. Therefore whether we 
                live or we die, we are the Lord\'s. For Christ died and lived <em>again</em> for this, that He might 
                be Lord both of the dead and of the living.

                <div class="cb_10"></div> 
                But you, why do you judge your brother? Or you, why do you despise your brother? For we will all 
                stand before the judgement seat of God, For it is written, &quot;As I live, says the Lord, every 
                knee shall bow to Me, and every tongue shall openly confess to God.&quot; 

                <div class="cb_10"></div>
                So then each one of us will give an account concerning himself<br>to God.';

            break;
            case 'rom15_4[000]':
            case 'rom15_4':

                $tmp_verse_array['REFERENCE'][0]        = '15:4';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'For the things that were written previously were written for our instruction, in order that through endurance and through the encouragement of the Scriptures we might have hope.';
                $tmp_verse_array['COPY'][0]             = 'For the things that were written previously were written for our 
                instruction, in order that through endurance and through the encouragement of the Scriptures we might 
                have hope.';

            break;
            case '1cor1_22-25':

                $tmp_verse_array['REFERENCE'][0]        = '1:22-25';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'For indeed Jews require signs and Greeks seek wisdom, But we preach Christ crucified, to Jews a stumbling block, and to Gentiles foolishness, But to those who are called, both Jews and Greeks, Christ the power of God and the wisdom of God. Because the foolishness of God is wiser than men, and the weakness of God is stronger than men.';
                $tmp_verse_array['COPY'][0]             = 'For indeed Jews require signs and Greeks seek wisdom, But we preach 
                Christ crucified, to Jews a stumbling block, and to Gentiles foolishness, But to those who are 
                called, both Jews and Greeks, Christ the power of God and the wisdom of God. Because the 
                foolishness of God is wiser than men, and the weakness of God is stronger than men.';

            break;
            case '1cor3_21-23':

                $tmp_verse_array['REFERENCE'][0]        = '3:21-23';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'So then let no one boast in men, for all things are yours, Whether Paul or Apollos or Cephas or the world or life or death or things present or things to come; all are yours, But you are Christ\'s, and Christ is God\'s.';
                $tmp_verse_array['COPY'][0]             = 'So then let no one boast in men, for all things are yours, Whether 
                Paul or Apollos or Cephas or the world or life or death or things present or things to come; all are 
                yours, But you are Christ\'s, and Christ is God\'s.';

            break;
            case '1cor5_1,5':

                $tmp_verse_array['REFERENCE'][0]        = '5:1, 5';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = '1 It is actually reported that there is fornication among you, and such fornication that not even among the Gentiles, that someone has his stepmother. 5 To deliver such a one to Satan for the destruction of his flesh, that his spirit may be saved in the day of the Lord.';
                $tmp_verse_array['COPY'][0]             = '<span class="script_ref_num">1</span> It is actually reported that 
                there is fornication among you, and such fornication that <em>does</em> not even <em>occur</em> 
                among the Gentiles, that someone has his stepmother.

                <div class="cb_10"></div>
                <span class="script_ref_num">5</span> To deliver such a one to Satan for the destruction of his 
                flesh, that his spirit may be saved in the day of the Lord.';

            break;
            case '1cor6_12':

                $tmp_verse_array['REFERENCE'][0]        = '6:12';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'All things are lawful to me, but not all things are profitable; all things are lawful to me, but I will not be brought under the power of anything.';
                $tmp_verse_array['COPY'][0]             = 'All things are lawful to me, but not all things are profitable; all 
                things are lawful to me, but I will not be brought under the power<br>of anything.';

            break;
            case '1cor6_17':

                $tmp_verse_array['REFERENCE'][0]        = '6:17';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'But he who is joined to the Lord is one spirit.';
                $tmp_verse_array['COPY'][0]             = 'But he who is joined to the Lord is one spirit.';

            break;
            case '1cor9_8-11,13':

                $tmp_verse_array['REFERENCE'][0]        = '9:8-11, 13';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = '8 Am I speaking these things according to man? Or does the law not also say these things? For in the law of Moses it is written: &quot;You shall not muzzle the ox while it is treading out the grain.&quot; Is it for oxen that God cares? Or does He say <em>it</em> altogether for our sake?';
                $tmp_verse_array['COPY'][0]             = '<span class="script_ref_num">8</span> Am I speaking these things 
                according to man? Or does the law not also say these things? For in the law of Moses it is written: 
                &quot;You shall not muzzle the ox while it is treading out the grain.&quot; Is it for oxen that God 
                cares? Or does He say <em>it</em> altogether for our sake?

                <div class="cb_10"></div>
                Yes, for our sake it was written because the plowman should plow in hope, and he who threshes, in hope 
                of partaking. If we have sown to you the spiritual things, is it a great thing if we shall reap from you 
                the fleshly things?

                <div class="cb_10"></div>
                <span class="script_ref_num">13</span> Do you not know that those who labor on the sacred things eat the 
                things of the sacred temple, <em>that</em> those who attend to the alter have their portion with 
                the alter?';

            break;
            case '1cor10_5':

                $tmp_verse_array['REFERENCE'][0]        = '10:23';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'But with most of them God was not well pleased, for they were strewn along in the wilderness.';
                $tmp_verse_array['COPY'][0]             = 'But with most of them God was not well pleased, for they 
                were strewn along in the wilderness.';

            break;
            case '1cor10_23':

                $tmp_verse_array['REFERENCE'][0]        = '10:23';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'All things are lawful, but not all things are profitable; all things are lawful, but not all things build up.';
                $tmp_verse_array['COPY'][0]             = 'All things are lawful, but not all things are profitable; all things 
                are lawful, but not all things build up.';

            break;
            case '1cor10_26,29b-31':

                $tmp_verse_array['REFERENCE'][0]        = '10:26, 29b-31';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = '26 For the earth is the Lord\'s and the fullness thereof. 29b For why is my freedom judged by other conscience? If I partake with thankfulness, why am I spoken evil of concerning that for which I give thanks? Therefore whether you eat or drink, or whatever you do, do all to the glory of God.';
                $tmp_verse_array['COPY'][0]             = '<span class="script_ref_num">26</span> For the earth is the Lord\'s 
                and the fullness thereof.
                <div class="cb_10"></div>
                <span class="script_ref_num">29b</span> For why is my freedom judged by <em>some</em> other 
                conscience? If I partake with thankfulness, why am I spoken evil of concerning that for which I give 
                thanks? Therefore whether you eat or drink, or whatever you do, do all to the glory of God.';

            break;
            case '1cor11_4':

                $tmp_verse_array['REFERENCE'][0]        = '11:4';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'Every man praying or prophesying with his head covered disgraces his head.';
                $tmp_verse_array['COPY'][0]             = 'Every man praying or prophesying with his head covered <span class="script_sup">2</span>disgraces 
                his head.';

            break;
            case '1cor15_58':

                $tmp_verse_array['REFERENCE'][0]        = '15:58';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'Therefore, my beloved brothers, be steadfast, immovable, always abounding in the work of Lord, knowing that your labor is not in vain in the Lord.';
                $tmp_verse_array['COPY'][0]             = 'Therefore, my beloved brothers, be steadfast, immovable, always abounding 
                in the work of Lord, knowing that your labor is not in vain in the Lord.';

            break;
            case '1cor15_55,58':

                $tmp_verse_array['REFERENCE'][0]        = '15:55, 58';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = '55 Where, O death, is your victory? Where, O death, is your sting? 58 Therefore, my beloved brothers, be steadfast, immovable, always abounding in the work of the Lord, knowing that your labor is not in vain in the Lord.';
                $tmp_verse_array['COPY'][0]             = '<span class="script_ref_num">55</span> Where, O death, is your 
                victory? Where, O death, is your sting?

                <div class="cb_10"></div>
                <span class="script_ref_num">58</span> Therefore, my beloved brothers, be steadfast, immovable, 
                always abounding in the work of the Lord, knowing that your labor is not in vain in the Lord.';

            break;
            case '2cor1_9-10':

                $tmp_verse_array['REFERENCE'][0]        = '1:9-10';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'Indeed we ourselves had the response of death in ourselves, that we should not base our confidence on ourselves but on God, who raises the dead; Who has delivered us out of so great a death, and will deliver; in whom we have hoped that He will also yet deliver,';
                $tmp_verse_array['COPY'][0]             = 'Indeed we ourselves had the response of death in ourselves, that we 
                should not base our confidence on ourselves but on God, who raises the dead; Who has delivered us 
                out of so great a death, and will deliver <em>us</em>; in whom we have hoped that He will also yet 
                deliver <em>us</em>,';

            break;
            case '2cor1_20-22[000]':
            case '2cor1_20-22':

                $tmp_verse_array['REFERENCE'][0]        = '1:20-22';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'For as many promises of God as, in Him is the Yes; therefore also through Him is the Amen to God, for glory through us. But the One who firmly attaches us with you unto Christ and has anointed us is God, He who has also sealed us and given the Spirit in our hearts as a pledge.';
                $tmp_verse_array['COPY'][0]             = 'For as many promises of God as <em>there are</em>, in Him is the Yes; 
                therefore also through Him is the Amen to God, for glory through us <em>to God</em>. But the One who 
                firmly attaches us with you unto Christ and has anointed us is God, He who has also sealed us and given 
                the Spirit in our hearts as a pledge.';

            break;
            case '2cor3_6-9':

                $tmp_verse_array['REFERENCE'][0]        = '3:6-9';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'Who has also made us sufficient as ministers of a new covenant, not of the letter but of the Spirit; for the letter kills, but the Spirit gives life. Moreover if the ministry of death, engraved in stone in letters, came about in glory, so that the sons of Israel were not able to gaze at the face of Moses because of the glory of his face, which was being done away with, How shall the ministry of the Spirit not be more in glory? For if there is glory with the ministry of condemnation, much more the ministry of righteousness abounds with glory.';
                $tmp_verse_array['COPY'][0]             = 'Who has also made us sufficient as ministers of a new covenant, <em>ministers</em> 
                not of the letter but of the Spirit; for the letter kills, but the Spirit gives life. Moreover if the 
                ministry of death, engraved in stone in letters, came about in glory, so that the sons of Israel 
                were not able to gaze at the face of Moses because of the glory of his face, <em>a glory</em> which 
                was being done away with, How shall the ministry of the Spirit not be more in glory? For if there is
                glory with the ministry of condemnation, much more the ministry of righteousness abounds with glory.';

            break;
            case '2cor3_12':

                $tmp_verse_array['REFERENCE'][0]        = '3:12';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'Therefore since we have such hope, we use much boldness,';
                $tmp_verse_array['COPY'][0]             = 'Therefore since we have such hope, we use much boldness,';

            break;
            case '2cor3_12,17':

                $tmp_verse_array['REFERENCE'][0]        = '3:12, 17';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = '12 Therefore since we have such hope, we use much boldness, 17 And the Lord is the Spirit; and where the Spirit of the Lord is, there is freedom.';
                $tmp_verse_array['COPY'][0]             = '<span class="script_ref_num">12</span> Therefore since we have such 
                hope, we use much boldness,

                <div class="cb_10"></div>
                <span class="script_ref_num">17</span> And the Lord is the Spirit; and where the Spirit of the Lord 
                is, there is freedom.';

            break;
            case '2cor11_2a':

                $tmp_verse_array['REFERENCE'][0]        = '11:2a';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'For I am jealous over you with a jealousy of God.';
                $tmp_verse_array['COPY'][0]             = 'For I am jealous over you with a jealousy of God.';

            break;
            case '2cor11_2b-3':

                $tmp_verse_array['REFERENCE'][0]        = '11:2b-3';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'For I betrothed you to one husband to present a pure virgin to Christ. But I fear lest somehow, as the serpent deceived Eve by his craftiness, your thoughts would be corrupted from the simplicity and the purity toward Christ.';
                $tmp_verse_array['COPY'][0]             = 'For I betrothed you to one husband to present <em>you as</em> a pure 
                virgin to Christ. But I fear lest somehow, as the serpent deceived Eve by his craftiness, your 
                thoughts would be corrupted from the simplicity and the purity toward Christ.';

            break;
            case '1cor11_22':

                $tmp_verse_array['REFERENCE'][0]        = '11:22';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'Do you not have houses to eat and drink in? Or do you despise the church of God and put those to shame who have not? What shall I say to you? Shall I praise you? In this I do not praise.';
                $tmp_verse_array['COPY'][0]             = 'Do you not have houses to eat and drink in? Or do you despise the 
                church of God and put those to shame who have not? What shall I say to you? Shall I praise you? In 
                this I do not praise <em>you</em>.';

            break;
            case '2cor3_3':

                $tmp_verse_array['REFERENCE'][0]        = '3:3';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'Since you are being manifested that you are a letter of Christ ministered by us, inscribed not with ink but with the Spirit of the living God; not in tablets of stone but in tablets of hearts of flesh.';
                $tmp_verse_array['COPY'][0]             = 'Since you are being manifested that you are a letter of Christ ministered
                by us, inscribed not with ink but with the Spirit of the living God; not in tablets of stone but in 
                tablets of hearts of flesh.';

            break;
            case '2cor3_17-18':

                $tmp_verse_array['REFERENCE'][0]        = '3:17-18';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'And the Lord is the Spirit; and where the Spirit of the Lord is, there is freedom. But we all with unveiled face, beholding and reflecting like a mirror the glory of the Lord, are being transformed into the same image from glory to glory, even as from the Lord Spirit.';
                $tmp_verse_array['COPY'][0]             = 'And the Lord is the Spirit; and where the Spirit of the Lord is, 
                there is freedom. But we all with unveiled face, beholding and reflecting like a mirror the glory of 
                the Lord, are being transformed into the same image from glory to glory, even as from the 
                Lord Spirit.';

            break;
            case '2cor3_18':

                $tmp_verse_array['REFERENCE'][0]        = '3:18';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'But we all with unveiled face, beholding and reflecting like a mirror the glory of the Lord, are being transformed into the same image from glory to glory, even as from the Lord Spirit.';
                $tmp_verse_array['COPY'][0]             = 'But we all with unveiled face, beholding and reflecting like a mirror 
                the glory of the Lord, are being transformed into the same image from glory to glory, even as from 
                the Lord Spirit.';

            break;
            case 'gal1_14':

                $tmp_verse_array['REFERENCE'][0]        = '1:14';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'And I advanced in Judaism beyond many contemporaries in my race, being more abundantly a zealot for the traditions of my fathers.';
                $tmp_verse_array['COPY'][0]             = 'And I advanced in Judaism beyond many contemporaries in my race, being 
                more abundantly a zealot for the traditions of my fathers.';

            break;
            case 'gal2_20':
            case 'gal2_20_x':

                $tmp_verse_array['REFERENCE'][0]        = '2:20';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'I am crucified with Christ; and no longer I live, but Christ lives in me; and the which I now live in the flesh I live in faith, the of the Son of God, who loved me and gave Himself up for me.';
                $tmp_verse_array['COPY'][0]             = 'I am crucified with Christ; and no longer I <em>who</em> 
                live, but <em>it is</em> Christ <em>who</em> lives in me; and the <em>life</em> which I now live in 
                the flesh I live in faith, the <em>faith</em> of the Son of God, who loved me and gave Himself 
                up<br>for me.';

            break;
            case 'gal3_1':

                $tmp_verse_array['REFERENCE'][0]        = '3:1';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'O foolish Galatians, who has bewitched you, before whose eyes Jesus Christ was openly portrayed crucified?';
                $tmp_verse_array['COPY'][0]             = 'O foolish Galatians, who has bewitched you, before whose eyes Jesus 
                Christ was openly portrayed crucified?';

            break;
            case 'gal5_1,7':

                $tmp_verse_array['REFERENCE'][0]        = '5:1, 7';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = '1 For freedom Christ has set us free; stand fast therefore, and do not be entangled with a yoke of slavery again. 7 You were running well. Who hindered you that you would not believe and obey the truth?';
                $tmp_verse_array['COPY'][0]             = '<span class="script_ref_num">1</span> <em>It is</em> for freedom 
                <em>that</em> Christ has set us free; stand fast therefore, and do not be entangled with a yoke of 
                slavery again.

                <div class="cb_10"></div>
                <span class="script_ref_num">7</span> You were running well. Who hindered you that you would not 
                believe and obey the truth?';

            break;
            case 'gal5_1':

                $tmp_verse_array['REFERENCE'][0]        = '5:1';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'For freedom Christ has set us free; stand fast therefore, and do not be entangled with a yoke of slavery again.';
                $tmp_verse_array['COPY'][0]             = '<em>It is</em> for freedom <em>that</em> Christ has set us free; 
                stand fast therefore, and do not be entangled with a yoke of slavery again.';

            break;
            case 'gal5_5-6':

                $tmp_verse_array['REFERENCE'][0]        = '5:5-6';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'For we by the Spirit out of faith eagerly await the hope of righteousness.';
                $tmp_verse_array['COPY'][0]             = 'For we by the Spirit out of faith eagerly await the hope<br> 
                of righteousness. For in Christ Jesus neither circumcision avails anything nor uncircumcision, but faith 
                <em>avails</em>, operating through love.';

            break;
            case 'gal4_11':

                $tmp_verse_array['REFERENCE'][0]        = '4:11';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'I fear for you, lest I have labored upon you in vain.';
                $tmp_verse_array['COPY'][0]             = 'I fear for you, lest I have labored upon you in vain.';

            break;
            case 'gal5_13,16':

                $tmp_verse_array['REFERENCE'][0]        = '5:13, 16';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = '13 For you were called for freedom, brothers; only do not this freedom into an opportunity for the flesh, but through love serve one another. 16 But I say, Walk by the Spirit and you shall by no means fulfill the lust of the flesh.';
                $tmp_verse_array['COPY'][0]             = '<span class="script_ref_num">13</span> For you were called for 
                freedom, brothers; only do not <em>turn</em> this freedom into an opportunity for the flesh, but 
                through love serve<br>one another.

                <div class="cb_10"></div>
                <span class="script_ref_num">16</span> But I say, Walk by the Spirit and 
                you shall by no means fulfill the lust of the flesh.';

            break;
            case 'gal5_16,18,22-23,25':

                $tmp_verse_array['REFERENCE'][0]        = '5:16, 18, 22-23, 25';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = '16 But I say, Walk by the Spirit and you shall by no means fulfill the lust of the flesh. 18 But if you are led by the Spirit, you are not under the law. 22 But the fruit of the Spirit is love, joy, peace, long-suffering, kindness, goodness, faithful, Meekness, self-control; against such things there is no law.';
                $tmp_verse_array['COPY'][0]             = '<span class="script_ref_num">16</span> But I say, Walk by the Spirit and you shall by no means fulfill the lust 
                of the flesh.

                <div class="cb_10"></div>
                <span class="script_ref_num">18</span> But if you are led by the Spirit, you are not under the law.

                <div class="cb_10"></div>
                <span class="script_ref_num">22</span> But the fruit of the Spirit is love, joy, peace, long-suffering, 
                kindness, goodness, faithfulness, Meekness, self-control; against such things there is no law.

                <div class="cb_10"></div>
                <span class="script_ref_num">25</span> If we live by the Spirit, let us also walk by the Spirit.';

            break;
            case 'gal6_14':

                $tmp_verse_array['REFERENCE'][0]        = '6:14';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'But far be it from me to boast except in the cross of our Lord Jesus Christ, through whom the world has been crucified to me and I to the world.';
                $tmp_verse_array['COPY'][0]             = 'But far be it from me to boast except in the cross of our Lord Jesus 
                Christ, through whom the world has been crucified to me and I to<br>the world.';

            break;
            case 'eph1_3':

                $tmp_verse_array['REFERENCE'][0]        = '1:3';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'Blessed be the God and Father of our Lord Jesus Christ, who has blessed us with every spiritual blessing in the heavenlies in Christ,';
                $tmp_verse_array['COPY'][0]             = 'Blessed be the God and Father of our Lord Jesus Christ, who has blessed 
                us with every spiritual blessing in the heavenlies in Christ,';

            break;
            case 'eph1_3-12':

                $tmp_verse_array['REFERENCE'][0]        = '1:3-12';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'Blessed be the God and Father of our Lord Jesus Christ, who has blessed us with every spiritual blessing in the heavenlies in Christ, Even as He chose us in Him before the foundation of the world to be holy and without blemish before Him in love, Predestinating us unto sonship through Jesus Christ to Himself, according to the good pleasure of His will,';
                $tmp_verse_array['COPY'][0]             = 'Blessed be the God and Father of our Lord Jesus Christ, who has 
                blessed us with every spiritual blessing in the heavenlies in Christ, Even as He chose us in Him 
                before the foundation of the world to be holy and without blemish before Him in love, Predestinating 
                us unto sonship through Jesus Christ to Himself, according to the good pleasure of His will,

                <div class="cb_10"></div> 
                To the praise of the glory of His grace, with which He graced us in the Beloved; In whom we have 
                redemption through His blood, the forgiveness of offenses, according to the riches of His grace, 
                Which He caused to abound to us in all wisdom and prudence, 

                <div class="cb_10"></div> 
                Making known to us the mystery of His will according to His good pleasure, which He purposed in 
                Himself, Unto the economy of the fullness of the times, to head up all things in Christ, the things 
                in the heavens and the things on the earth, in Him; In whom also we were designated as an 
                inheritance, having been predestinated according to the purpose of the One who works all things 
                according to the counsel of His will, That we would be to the praise of His glory who have first 
                hoped in Christ.';

            break;
            case 'eph1_3-14[000]':
            case 'eph1_3-14':

                $tmp_verse_array['REFERENCE'][0]        = '1:3-14';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'Blessed be the God and Father of our Lord Jesus Christ, who has blessed us with every spiritual blessing in the heavenlies in Christ, Even as He chose us in Him before the foundation of the world to be holy and without blemish before Him in love, Predestinating us unto sonship through Jesus Christ to Himself, according to the good pleasure of His will,';
                $tmp_verse_array['COPY'][0]             = 'Blessed be the God and Father of our Lord Jesus Christ, who has 
                blessed us with every spiritual blessing in the heavenlies in Christ, Even as He chose us in Him 
                before the foundation of the world to be holy and without blemish before Him in love, Predestinating 
                us unto sonship through Jesus Christ to Himself, according to the good pleasure of His will,

                <div class="cb_10"></div> 
                To the praise of the glory of His grace, with which He graced us in the Beloved; In whom we have 
                redemption through His blood, the forgiveness of offenses, according to the riches of His grace, 
                Which He caused to abound to us in all wisdom and prudence, 

                <div class="cb_10"></div> 
                Making known to us the mystery of His will according to His good pleasure, which He purposed in 
                Himself, Unto the economy of the fullness of the times, to head up all things in Christ, the things 
                in the heavens and the things on the earth, in Him; In whom also we were designated as an 
                inheritance, having been predestinated according to the purpose of the One who works all things 
                according to the counsel of His will, That we would be to the praise of His glory who have first 
                hoped in Christ.

                <div class="cb_10"></div> 
                In whom you also, having heard the word of the truth, the gospel of your salvation, in Him also 
                believing, you were sealed with the Holy Spirit of the promise, Who is the pledge of our inheritance 
                unto the redemption of the acquired possession, to the praise of His glory.';

            break;
            case 'eph1_9':

                $tmp_verse_array['REFERENCE'][0]        = '1:9';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'Making known to us the mystery of His will according to His good pleasure, which He purposed in Himself,';
                $tmp_verse_array['COPY'][0]             = 'Making known to us the mystery of His will according to His good 
                pleasure, which He purposed in Himself,';

            break;
            case 'eph1_9-14,18-23':

                $tmp_verse_array['REFERENCE'][0]        = '1:9-14, 18-23';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = '9 Making known to us the mystery of His will according to His good pleasure, which He purposed in Himself, Unto the economy of the fullness of the times, to head up all things in Christ, the things in the heavens and the things on the earth, in Him;';
                $tmp_verse_array['COPY'][0]             = '<span class="script_ref_num">9</span> Making known to us the mystery of 
                His will according to His good pleasure, which He purposed in Himself, Unto the economy of the fullness 
                of the times, to head up all things in Christ, the things in the heavens and the things on the earth, 
                in Him; 

                <div class="cb_10"></div> 
                In whom also we were designated as an inheritance, having been predestinated according to the purpose of 
                the One who works all things according to the counsel of His will, That we would be to the praise of His 
                glory who have first hoped in Christ.

                <div class="cb_10"></div> 
                In whom you also, having heard the word of the truth, the gospel of your salvation, in Him also 
                believing, you were sealed with the Holy Spirit of the promise, Who is the pledge of our inheritance 
                unto the redemption of the acquired possession, to the praise of His glory.

                <div class="cb_10"></div> 
                <span class="script_ref_num">18</span> The eyes of your heart having been enlightened, that you may know 
                what is the hope of His calling, and what are the riches of the glory of His inheritance in the 
                saints, And what is the surpassing greatness of His power toward us who believe, according to the 
                operation of the might of His strength, Which He caused to operate in Christ in raising Him from the 
                dead and seating Him at His right hand in the heavenlies, Far above all rule and authority and power and 
                lordship and every name that is named not only in this age but also in that which is to come;

                <div class="cb_10"></div> 
                And He subjected all things under His feet and gave Him <em>to be</em> Head over all things to the 
                church, Which is His Body, the fullness of the One who fills all in all.';

            break;
            case 'phil1_6':

                $tmp_verse_array['REFERENCE'][0]        = '1:6';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'Being confident of this very thing, that He who has begun in you a good work will complete it until the day of Christ Jesus.';
                $tmp_verse_array['COPY'][0]             = 'Being confident of this very thing, that He who has begun in you a 
                good work will complete it until the day of Christ Jesus.';

            break;
            case 'phil1_20':

                $tmp_verse_array['REFERENCE'][0]        = '1:20';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'According to my earnest expectation and hope that in nothing I will be put to shame, but with all boldness, as always, even now Christ will be magnified in my body, whether through life or through death.';
                $tmp_verse_array['COPY'][0]             = 'According to my earnest expectation and hope that in nothing I will be 
                put to shame, but with all boldness, as always, even now Christ will be magnified in my body, whether 
                through life or through death.';

            break;
            case 'phil1_27':

                $tmp_verse_array['REFERENCE'][0]        = '1:27';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'Only, conduct yourselves in a manner worthy of the gospel of Christ, that whether coming and seeing you or being absent, I may hear of the things concerning you, that you stand firm in one spirit, with one soul striving together with the faith of the gospel.';
                $tmp_verse_array['COPY'][0]             = 'Only, conduct yourselves in a manner worthy of the gospel of Christ, 
                that whether coming and seeing you or being absent, I may hear of the things concerning you, that 
                you stand firm in one spirit, with one soul striving together <em>along</em> with the faith of 
                the gospel.';

            break;
            case 'phil2_3':

                $tmp_verse_array['REFERENCE'][0]        = '2:3';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'Nothing by way of selfish ambition nor by way of vainglory, but in lowliness of mind considering one another more excellent than yourselves.';
                $tmp_verse_array['COPY'][0]             = '<em>Doing</em> nothing by way of selfish ambition nor by way of 
                vainglory, but in lowliness of mind considering one another more excellent<br>than yourselves.';

            break;
            case 'phil2_5-8':

                $tmp_verse_array['REFERENCE'][0]        = '2:5-8';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'Let this mind be in you, which was also in Christ Jesus, Who, existing in the form of God, did not consider being equal with God a treasure to be grasped, But emptied Himself, taking the form of a slave, becoming in the likeness of men; And being found in fashion as a man, He humbled Himself, becoming obedient even unto death, and the death of a cross.';
                $tmp_verse_array['COPY'][0]             = 'Let this mind be in you, which was also in Christ Jesus, Who, existing in 
                the form of God, did not consider being equal with God a treasure to be grasped, But emptied Himself, 
                taking the form of a slave, becoming in the likeness of men; 

                <div class="cb_10"></div>
                And being found in fashion as a man, He humbled Himself, becoming obedient even unto death, and 
                <em>that</em> the death of a cross.';

            break;
            case 'phil2_5-16[000]':
            case 'phil2_5-16':

                $tmp_verse_array['REFERENCE'][0]        = '2:5-16';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'Let this mind be in you, which was also in Christ Jesus, Who, existing in the form of God, did not consider being equal with God a treasure to be grasped, But emptied Himself, taking the form of a slave, becoming in the likeness of men; And being found in fashion as a man, He humbled Himself, becoming obedient even unto death, and the death of a cross.';
                $tmp_verse_array['COPY'][0]             = 'Let this mind be in you, which was also in Christ Jesus, Who, existing in 
                the form of God, did not consider being equal with God a treasure to be grasped, But emptied Himself, 
                taking the form of a slave, becoming in the likeness of men; And being found in fashion as a man, He 
                humbled Himself, becoming obedient even unto death, and <em>that</em> the death of a cross.

                <div class="cb_10"></div>
                Therefore also God highly exalted Him and bestowed on Him the name which is above every name, That in 
                the name of Jesus every knee should bow, of those who are in heaven and on earth and under the earth, 
                And every tongue should openly confess that Jesus Christ is Lord to the glory of God the Father.

                <div class="cb_10"></div>
                So then, my beloved, even as you have always obeyed, not as in my presence only but now much rather in 
                my absence, work out your own salvation with fear and trembling; For it is God who operates in you both
                the willing and the working for <em>your</em> good pleasure. Do all things without murmurings and 
                reasonings That you may be blameless and guileless, children of God without blemish in the midst of a 
                crooked and perverted generation, among whom you shine as luminaries in the world, Holding forth the 
                word of life, so that I may have a boast in the day of Christ that I did not run in vain nor labor<br> 
                in vain.';

            break;
            case 'phil2_5-9':

                $tmp_verse_array['REFERENCE'][0]        = '2:5-9';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'Let this mind be in you, which was also in Christ Jesus, Who, existing in the form of God, did not consider being equal with God a treasure to be grasped, But emptied Himself, taking the form of a slave, becoming in the likeness of men; And being found in fashion as a man, He humbled Himself, becoming obedient even unto death, and the death of a cross.';
                $tmp_verse_array['COPY'][0]             = 'Let this mind be in you, which was also in Christ Jesus, Who, 
                existing in the form of God, did not consider being equal with God a treasure to be grasped, But 
                emptied Himself, taking the form of a slave, becoming in the likeness of men; And being found in 
                fashion as a man, He humbled Himself, becoming obedient even unto death, and <em>that</em> the death 
                of a cross.

                <div class="cb_10"></div>
                Therefore also God highly exalted Him and bestowed on Him the name which is above every name,';

            break;
            case 'phil2_8':

                $tmp_verse_array['REFERENCE'][0]        = '2:8';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'And being found in fashion as a man, He humbled Himself, becoming obedient even unto death, and the death of a cross.';
                $tmp_verse_array['COPY'][0]             = 'And being found in fashion as a man, He humbled Himself, becoming 
                obedient even unto death, and <em>that</em> the death of a cross.';

            break;
            case 'phil2_13[001]':
            case 'phil2_13[000]':
            case 'phil2_13':

                $tmp_verse_array['REFERENCE'][0]        = '2:13';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'For it is God who operates in you both the willing and the working for good pleasure.';
                $tmp_verse_array['COPY'][0]             = 'For it is God who operates in you both the willing and the working for 
                <em>your</em> good pleasure.';

            break;
            case 'col1_5':

                $tmp_verse_array['REFERENCE'][0]        = '1:5';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'Because of the hope laid up for you in the heavens, of which you heard before in the word of the truth of the gospel,';
                $tmp_verse_array['COPY'][0]             = 'Because of the hope laid up for you in the heavens, of which you heard 
                before in the word of the truth of the gospel,';

            break;
            case 'col1_27':

                $tmp_verse_array['REFERENCE'][0]        = '1:27';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'To whom God willed to make known what are the riches of the glory of this mystery among the Gentiles, which is Christ in you, the hope of glory,';
                $tmp_verse_array['COPY'][0]             = 'To whom God willed to make known what are the riches of the glory of this 
                mystery among the Gentiles, which is Christ in you, the hope of glory,';

            break;
            case 'col1_5-6,21-23,26-27':

                $tmp_verse_array['REFERENCE'][0]        = '1:5-6, 21-23, 26-27';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = '5 Because of the hope laid up for you in the heavens, of which you heard before in the word of the truth of the gospel, Which has come to you, even as it is also in all the world, bearing fruit and growing, as also in you, since the day you heard and knew the grace of God in truth;';
                $tmp_verse_array['COPY'][0]             = '<span class="script_ref_num">5</span> Because of the hope laid up for you 
                in the heavens, of which you heard before in the word of the truth of the gospel, Which has come to you, 
                even as it is also in all the world, bearing fruit and growing, as also in you, since the day you heard 
                and knew the grace of God<br>in truth;

                <div class="cb_10"></div> 
                <span class="script_ref_num">21</span> And you, though once alienated and enemies in your mind because 
                of your evil works, He now has reconciled in the body of His flesh through death, to present you holy 
                and without blemish and without reproach before Him; If indeed you continue in the faith, grounded and 
                steadfast and not being moved away from the hope of the gospel, which you heard, which was proclaimed in 
                all creation under heaven, of which I Paul became a minister.

                <div class="cb_10"></div> 
                <span class="script_ref_num">26</span> The mystery which has been hidden from the ages and from the 
                generations but now has been manifested to His saints; To whom God willed to make known what are the 
                riches of the glory of this mystery among the Gentiles, which is Christ in you, the hope<br>of glory,';

            break;
            case 'col1_16':

                $tmp_verse_array['REFERENCE'][0]        = '1:16';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'Because in Him all things were created, in the heavens and on the earth, the visible and the invisible, whether thrones or lordships or rulers or authorities; all things have been created through Him and unto Him.';
                $tmp_verse_array['COPY'][0]             = 'Because in Him all things were created, in the heavens and on the 
                earth, the visible and the invisible, whether thrones or lordships or rulers or authorities; all 
                things have been created through Him and unto Him.';

            break;
            case 'col2_9':

                $tmp_verse_array['REFERENCE'][0]        = '2:9';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'For in Him dwells all the fullness of the Godhead bodily.';
                $tmp_verse_array['COPY'][0]             = 'For in Him dwells all the fullness of the Godhead bodily.';

            break;
            case 'col2_8,12,20-23':

                $tmp_verse_array['REFERENCE'][0]        = '2:8, 12, 20-23';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = '8 Beware that no one carries you off as spoil through his philosophy and empty deceit, according to the tradition of men, according to the elements of the world, and not according to Christ;';
                $tmp_verse_array['COPY'][0]             = '<span class="script_ref_num">8</span> Beware that no one carries you 
                off as spoil through his philosophy and empty deceit, according to the tradition of men, according 
                to the elements of the world, and not according to Christ;

                <div class="cb_10"></div>
                <span class="script_ref_num">12</span> Buried together with Him in baptism, in which also you were 
                raised together with <em>Him</em> through the faith of the operation of God, who raised Him from 
                the dead.

                <div class="cb_10"></div>
                <span class="script_ref_num">20</span> If you died with Christ from the elements of the world, why, 
                as living in the world, do you subject yourselves to ordinances: Do not handle, nor taste, nor 
                touch, (<em>Regarding</em> things which are all to perish when used) according to the commandments 
                and teachings of men? Such things indeed have a reputation of wisdom in self-imposed worship and 
                lowliness and severe treatment of the body, <em>but</em> are not of any value against the indulgence 
                of the flesh.';

            break;
            case 'col3_5':

                $tmp_verse_array['REFERENCE'][0]        = '3:5';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'Put to death therefore your members which are on the earth: fornication, uncleanness, passion, evil desire, and greediness, which is idolatry.';
                $tmp_verse_array['COPY'][0]             = 'Put to death therefore your members which are on the earth: fornication, 
                uncleanness, passion, evil desire, and greediness, which is idolatry.';

            break;
            case 'col3_6':

                $tmp_verse_array['REFERENCE'][0]        = '3:6';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'Because of which things the wrath of God is coming upon the sons of disobedience;';
                $tmp_verse_array['COPY'][0]             = 'Because of which things the wrath of God is coming upon the sons 
                of disobedience;';

            break;
            case '1thes1_2-3':

                $tmp_verse_array['REFERENCE'][0]        = '1:2-3';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'We thank God always concerning all of you, making mention in our prayers, Remembering unceasingly your work of faith and labor of love and endurance of hope in our Lord Jesus Christ, before our God and Father;';
                $tmp_verse_array['COPY'][0]             = 'We thank God always concerning all of you, making mention <em>of you</em> 
                in our prayers, Remembering unceasingly your work of faith and labor of love and endurance of hope in 
                our Lord Jesus Christ, before our God and Father;';

            break;
            case '1thes5_7-11':

                $tmp_verse_array['REFERENCE'][0]        = '5:7-11';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'For those who sleep, sleep during the night, and those who get drunk are drunk during the night; But since we are of the day, let us be sober, putting on the breastplate of faith and love and a helmet, the hope of salvation.';
                $tmp_verse_array['COPY'][0]             = 'For those who sleep, sleep during the night, and those who get drunk are 
                drunk during the night; But since we are of the day, let us be sober, putting on the breastplate of 
                faith and love and a helmet, the hope of salvation.

                <div class="cb_10"></div>
                For God did not appoint us to wrath but to the obtaining of salvation through our Lord Jesus Christ, Who 
                died for us in order that whether we watch or sleep, we may live together with Him. Therefore comfort 
                one another, and build up each one the other, even as you also do.';

            break;
            case '2thes2_8-12':

                $tmp_verse_array['REFERENCE'][0]        = '2:8-12';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'And then the lawless one will be revealed (whom the Lord Jesus will slay by the breath of His mouth and bring to nothing by the manifestation of His coming), The coming of whom is according to Satan\'s operation in all power and signs and wonders of a lie And in all deceit of unrighteousness among those who are perishing, because they did not receive the love of the truth that they might be saved.';
                $tmp_verse_array['COPY'][0]             = 'And then the lawless one will be revealed (whom the Lord Jesus will slay 
                by the breath of His mouth and bring to nothing by the manifestation of His coming), The coming of whom 
                is according to Satan\'s operation in all power and signs and wonders of a lie And in all deceit of 
                unrighteousness among those who are perishing, because they did not receive the love of the truth that 
                they might<br>be saved.

                <div class="cb_10"></div>
                And because of this God sends to them an operation of error that they might believe the lie, So that all 
                who have not believed the truth but have taken pleasure in unrighteousness might be judged.';

            break;
            case '2thes2_16-17':

                $tmp_verse_array['REFERENCE'][0]        = '2:16-17';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'Now our Lord Jesus Christ Himself and God our Father, who has loved us and given us eternal comfort and good hope in grace, Comfort your hearts and establish in every good work and word.';
                $tmp_verse_array['COPY'][0]             = 'Now our Lord Jesus Christ Himself and God our Father, who has loved us 
                and given us eternal comfort and good hope in grace, Comfort your hearts and establish <em>you</em> in 
                every good work and word.';

            break;
            case '1tim1_1':

                $tmp_verse_array['REFERENCE'][0]        = '1:1';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'Paul, an apostle of Christ Jesus according to the command of God our Savior and of Christ Jesus our hope,';
                $tmp_verse_array['COPY'][0]             = 'Paul, an apostle of Christ Jesus according to the command of God our 
                Savior and of Christ Jesus our hope,';

            break;
            case '1tim4_1-5':

                $tmp_verse_array['REFERENCE'][0]        = '4:1-5';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'But the Spirit says expressly that in later times some will depart from the faith, giving heed to deceiving spirits and teachings of demons By means of the hypocrisy of men who speak lies, of men who are branded in their own conscience as with a hot iron,';
                $tmp_verse_array['COPY'][0]             = 'But the Spirit says expressly that in later times some will depart from 
                the faith, giving heed to deceiving spirits and teachings of demons By means of the hypocrisy of men who 
                speak lies, of men who are branded in their own conscience as with a hot iron,

                <div class="cb_10"></div>
                Who forbid marriage <em>and command</em> abstaining from foods, which God has created to be partaken of 
                with thanksgiving by those who believe and have full knowledge of the truth. 

                <div class="cb_10"></div>
                For every creature of God is good, and nothing is to be rejected if received with thanksgiving; For it 
                is sanctified through the word of God and intercession.';

            break;
            case '1tim6_17':

                $tmp_verse_array['REFERENCE'][0]        = '6:17';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'Charge those who are rich in the present age not to be high-minded, nor to set their hope on the uncertainty of riches but on God, who affords us all things richly for enjoyment;';
                $tmp_verse_array['COPY'][0]             = 'Charge those who are rich in the present age not to be high-minded, nor 
                to set their hope on the uncertainty of riches but on God, who affords us all things richly for 
                <em>our</em> enjoyment;';

            break;
            case '2tim1_6':

                $tmp_verse_array['REFERENCE'][0]        = '1:6';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'For which cause I remind you to fan into flame the gift of God, which is in you through the laying on of my hands.';
                $tmp_verse_array['COPY'][0]             = 'For which cause I remind you to fan into flame the gift of God, 
                which is in you through the laying on of my hands.';

            break;
            case '2tim1_6-8':

                $tmp_verse_array['REFERENCE'][0]        = '1:6-8';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'For which cause I remind you to fan into flame the gift of God, which is in you through the laying on of my hands. For God has not given us a spirit of cowardice, but of power and of love and of sobermindedness. Therefore do not be ashamed of the testimony of our Lord nor of me His prisoner; but suffer evil with the gospel according to the power of God;';
                $tmp_verse_array['COPY'][0]             = 'For which cause I remind you to fan into flame the gift of God, which 
                is in you through the laying on of my hands. For God has not given us a spirit of cowardice, but of 
                power and of love and of sobermindedness. Therefore do not be ashamed of the testimony of our Lord 
                nor of me His prisoner; but suffer evil with the gospel according to the power of God;';

            break;
            case 'titus1_1-3':

                $tmp_verse_array['REFERENCE'][0]        = '1:1-3';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'Paul, a slave of God and an apostle of Jesus Christ according to the faith of God\'s chosen ones and the full knowledge of the truth, which is according to godliness, In the hope of eternal life, which God, who cannot lie, promised before the times of the ages.';
                $tmp_verse_array['COPY'][0]             = 'Paul, a slave of God and an apostle of Jesus Christ according to the 
                faith of God\'s chosen ones and the full knowledge of the truth, which is according to godliness, In the 
                hope of eternal life, which God, who cannot lie, promised before the times of the ages But in its own 
                times manifested His word in the proclamation with which I was entrusted according to the command of our 
                Savior God;';

            break;
            case 'titus2_11-15':

                $tmp_verse_array['REFERENCE'][0]        = '2:11-15';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'For the grace of God, bringing salvation to all men, has appeared, Training us that, denying ungodliness and worldly lusts, we should live soberly and righteously and godly in the present age,';
                $tmp_verse_array['COPY'][0]             = 'For the grace of God, bringing salvation to all men, has appeared, 
                Training us that, denying ungodliness and worldly lusts, we should live soberly and righteously and 
                godly in the present age,

                <div class="cb_10"></div>
                Awaiting the blessed hope, even the appearing of the glory of our great God and Savior, Jesus Christ, 
                Who gave Himself for us that He might redeem us from all lawlessness and purify to Himself a particular 
                people as His unique possession, zealous of good works.

                <div class="cb_10"></div>
                These things speak, and exhort and convict with all authority. Let no one despise you.';

            break;
            case 'titus3_7[000]':
            case 'titus3_7':

                $tmp_verse_array['REFERENCE'][0]        = '3:7';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'In order that having been justified by His grace, we might become heirs according to the hope of eternal life.';
                $tmp_verse_array['COPY'][0]             = 'In order that having been justified by His grace, we might become heirs 
                according to the hope of eternal life.';

            break;
            case 'heb2_14-15':

                $tmp_verse_array['REFERENCE'][0]        = '2:14-15';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'Since therefore the children have shared in blood and flesh, He also Himself in like manner partook of the same, that through death He might destroy him who has the might of death, that is, the devil, And might release those who because of the fear of death through all their life were held in slavery.';
                $tmp_verse_array['COPY'][0]             = 'Since therefore the children have shared in blood and flesh, He also 
                Himself in like manner partook of the same, that through death He might destroy him who has the 
                might of death, that is, the devil, And might release those who because of the fear of death through 
                all their life were held in slavery.';

            break;
            case 'heb3_6[000]':
            case 'heb3_6':

                $tmp_verse_array['REFERENCE'][0]        = '3:6';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'But Christ as a Son over His house, whose house we are if indeed we hold fast the boldness and the boast of hope firm to the end.';
                $tmp_verse_array['COPY'][0]             = 'But Christ <em>was faithful</em> as a Son over His house, whose house we 
                are if indeed we hold fast the boldness and the boast of hope firm to<br>the end.';

            break;
            case 'heb3_7-19[000]':
            case 'heb3_7-19':

                $tmp_verse_array['REFERENCE'][0]        = '3:7-19';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'Therefore, even as the Holy Spirit says, &quot;Today if you hear His voice, Do not harden your hearts as in the provocation, in the day of trial in the wilderness, Where your fathers tried by testing and saw My works for forty years. Therefore I was displeased with this generation, and I said, They always go astray in their heart, and they have not known My ways;';
                $tmp_verse_array['COPY'][0]             = 'Therefore, even as the Holy Spirit says, &quot;Today if you hear 
                His voice, Do not harden your hearts as in the provocation, in the day of trial in the wilderness, 
                Where your fathers tried <em>Me</em> by testing <em>Me</em> and saw My works for forty years. 
                Therefore I was displeased with this generation, and I said, They always go astray in their heart, 
                and they have not known My ways;

                <div class="cb_10"></div>
                As I swore in My wrath, They shall not enter into My rest!&quot; 

                <div class="cb_10"></div>
                Beware, brothers, lest perhaps there be in any one of you an evil heart of unbelief in falling away from 
                the living God. But exhort one another each day, as long as it is called &quot;today,&quot; lest any one 
                of you be hardened by the deceitfulness of sin&ndash;&ndash; 

                <div class="cb_10"></div>
                For we have become partners of Christ, if indeed we hold fast the beginning of the assurance firm to 
                the end&ndash;&ndash; 

                <div class="cb_10"></div>
                While it is said, &quot;Today if you hear His voice, do not harden your hearts as in the 
                provocation.&quot; For who provoked <em>Him</em> when they heard? Indeed was it not all who came 
                out of Egypt by Moses? And with whom was He displeased for forty years? Was it not with those who 
                sinned, whose carcasses fell in the wilderness? 

                <div class="cb_10"></div>
                And to whom did He swear that they should not enter into His rest, except to the disobedient? And we see 
                that they were not able to enter in because of unbelief.';

            break;
            case 'heb4_8-16':

                $tmp_verse_array['REFERENCE'][0]        = '4:8-16';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'For if Joshua had brought them into rest, He would not have spoken concerning another day after these things. So then there remains a Sabbath rest for the people of God. For he who has entered into His rest has himself also rested from his works, as God did from His own. Let us therefore be diligent to enter into that rest lest anyone fall after the same example of disobedience.';
                $tmp_verse_array['COPY'][0]             = 'For if Joshua had brought them into rest, He would not have spoken 
                concerning another day after these things. So then there remains a Sabbath rest for the people of God. 
                For he who has entered into His rest has himself also rested from his works, as God did from His own.
                Let us therefore be diligent to enter into that rest lest anyone fall after the same example of 
                disobedience. 

                <div class="cb_10"></div>
                For the word of God is living and operative and sharper than any two-edged sword, and 
                piercing even to the dividing of soul and spirit and of joints and marrow, and able to discern the 
                thoughts and intentions of the heart. And there is no creature that is not maifest before Him, but all 
                things are naked and laid bare to the eyes of Him to whom we are <em>to give</em> our account.

                <div class="cb_10"></div>
                Having therefore a great High Priest who has passed through the heavens, Jesus, the Son of God, let us 
                hold fast the confession. For we do not have a High Priest who cannot be touched with the feeling of our
                weaknesses, but One who has been tempted in all respects like <em>us, yet</em> without sin. Let us 
                therefore come forward with boldness to the throne of grace that we may recieve mercy and find grace for
                timely help.';

            break;
            case 'heb4_11':

                $tmp_verse_array['REFERENCE'][0]        = '4:11';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'Let us therefore be diligent to enter into that rest lest anyone fall after the same example of disobedience.';
                $tmp_verse_array['COPY'][0]             = 'Let us therefore be diligent to enter into that rest lest 
                anyone fall after the same example of disobedience.';

            break;
            case 'heb6_17-20':

                $tmp_verse_array['REFERENCE'][0]        = '6:17-20';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'Therefore God, intending to show more abundantly to the heirs of the promise the unchangeableness of His counsel, interposed with an oath, In order that by two unchangeable things, in which it was impossible for God to lie we may have strong encouragement, we who have fled for refuge to lay hold of the hope set before,';
                $tmp_verse_array['COPY'][0]             = 'Therefore God, intending to show more abundantly to the heirs of the 
                promise the unchangeableness of His counsel, interposed with an oath, In order that by two unchangeable 
                things, in which it was impossible for God to lie, we may have strong encouragement, we who have fled 
                for refuge to lay hold of the hope set before <em>us</em>,

                <div class="cb_10"></div>
                Which we have as an anchor of the soul, both secure and firm and which enters within the veil, Where the 
                Forerunner, Jesus, has entered for us, having become forever a High Priest according to the order 
                of Melchizedek.';

            break;
            case 'heb7_17-19':

                $tmp_verse_array['REFERENCE'][0]        = '7:17-19';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'For it is testified, &quot;You are a Priest forever according to the order of Melchizedek.&quot; For there is, on the one hand, the setting aside of the preceding commandment because of its weakness and unprofitableness (For the law perfected nothing), and, on the other hand, the bringing in thereupon of a better hope, through which we draw near to God.';
                $tmp_verse_array['COPY'][0]             = 'For it is testified, &quot;You are a Priest forever according to the 
                order of Melchizedek.&quot; For there is, on the one hand, the setting aside of the preceding commandment 
                because of its weakness and unprofitableness (For the law perfected nothing), and, on the other hand, 
                the bringing in thereupon of a better hope, through which we draw near to God.

                <div class="cb_10"></div>
                And inasmuch as <em>He was</em> not <em>made a Priest</em> without the taking of an oath (For they are 
                appointed priests without the taking of an oath, but He, with the taking of an oath by Him who said to 
                Him, &quot;The Lord has sworn and will not regret <em>it</em>, You are a Priest forever&quot;),

                <div class="cb_10"></div>
                By so much Jesus has also become the surety of a better covenant.';

            break;
            case 'heb8_10[000]':
            case 'heb8_10':

                $tmp_verse_array['REFERENCE'][0]        = '8:10';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'For this is the covenant which I will covenant with the house of Israel after those days, says the Lord: I will impart My laws into their mind, and on their hearts I will inscribe them; and I will be God to them, and they will be a people to Me.';
                $tmp_verse_array['COPY'][0]             = 'For this is the covenant which I will covenant with the house of 
                Israel after those days, says the Lord: I will impart My laws into their mind, and on their hearts I 
                will inscribe them; and I will be God to them, and they will be a people to Me.';

            break;
            case 'heb9_14':

                $tmp_verse_array['REFERENCE'][0]        = '9:14';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'How much more will the blood Christ, who through the eternal Spirit offered Himself without blemish to God, purify our conscience from dead works to serve the living God?';
                $tmp_verse_array['COPY'][0]             = 'How much more will the blood Christ, who through the eternal Spirit 
                offered Himself without blemish to God, purify our conscience from dead works to serve the living God?';

            break;
            case 'heb10_22,19':

                $tmp_verse_array['REFERENCE'][0]        = '10:22, 19';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = '22 Let us come forward to with a true heart in full assurance of faith, having our hearts sprinkled from an evil conscience and having our bodies washed with pure water. 19 Having therefore, brothers, boldness for entering the Holies in the blood of Jesus.';
                $tmp_verse_array['COPY'][0]             = '<span class="script_ref_num">22</span> Let us come forward to <em>the 
                Holy of Holies</em> with a true heart in full assurance of faith, having our hearts sprinkled from 
                an evil conscience and having our bodies washed with pure water.

                <div class="cb_10"></div>
                <span class="script_ref_num">19</span> Having therefore, brothers, boldness for entering the 
                <em>Holy of</em> Holies in the blood of Jesus.';

            break;
            case 'heb10_22':

                $tmp_verse_array['REFERENCE'][0]        = '10:22';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'Let us come forward to with a true heart in full assurance of faith, having our hearts sprinkled from an evil conscience and having our bodies washed with pure water.';
                $tmp_verse_array['COPY'][0]             = 'Let us come forward to <em>the Holy of Holies</em> with a true heart 
                in full assurance of faith, having our hearts sprinkled from an evil conscience and having our 
                bodies washed with pure water.';

            break;
            case 'heb10_21-23':

                $tmp_verse_array['REFERENCE'][0]        = '10:21-23';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'And a great Priest over the house of God, Let us come forward to with a true heart in full assurance of faith, having our hearts sprinkled from an evil conscience and having our bodies washed with pure water.';
                $tmp_verse_array['COPY'][0]             = 'And <em>having</em> a great Priest over the house of God, Let us come 
                forward to <em>the Holy of Holies</em> with a true heart in full assurance of faith, having our hearts 
                sprinkled from an evil conscience and having our bodies washed with pure water.

                <div class="cb_10"></div>
                Let us hold fast the confession of our hope unwavering, for He who has 
                promised is faithful;';

            break;
            case 'heb10_23':

                $tmp_verse_array['REFERENCE'][0]        = '10:23';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'Let us hold fast the confession of our hope unwavering, for He who has promised is faithful;';
                $tmp_verse_array['COPY'][0]             = 'Let us hold fast the confession of our hope unwavering, for He who has 
                promised is faithful;';

            break;
            case 'heb10_35':

                $tmp_verse_array['REFERENCE'][0]        = '10:35';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'Do not cast away therefore your boldness, which has great reward.';
                $tmp_verse_array['COPY'][0]             = 'Do not cast away therefore your boldness, which has great reward.';

            break;
            case 'heb10_35,38-39':

                $tmp_verse_array['REFERENCE'][0]        = '10:35, 38-39';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = '35 Do not cast away therefore your boldness, which has great reward. 38 &quot;...But My righteous one shall live by faith; and if he shrinks back, My soul does not delight in him.&quot; But we are not of those who shrink back to ruin but of those who have faith to the gaining of the soul.';
                $tmp_verse_array['COPY'][0]             = '<span class="script_ref_num">35</span> Do not cast away therefore 
                your boldness, which has<br>great reward.

                <div class="cb_10"></div>
                <span class="script_ref_num">38</span> "...But My righteous one shall live by faith; and if he 
                shrinks back, My soul does not delight in him." But we are not of those who shrink back to ruin but 
                of those who have faith to the gaining of the soul.';

            break;
            case 'heb11_1':

                $tmp_verse_array['REFERENCE'][0]        = '11:1';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'Now faith is the substantiation of things hoped for, the conviction of things not seen.';
                $tmp_verse_array['COPY'][0]             = 'Now faith is the substantiation of things hoped for, the conviction of 
                things not seen.';

            break;
            case 'heb12_1':

                $tmp_verse_array['REFERENCE'][0]        = '12:1';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'Therefore let us also, having so great a cloud of witnesses surrounding us, put away every encumbrance and the sin which so easily entangles and run with endurance the race which is set before us,';
                $tmp_verse_array['COPY'][0]             = 'Therefore let us also, having so great a cloud of witnesses surrounding 
                us, put away every encumbrance and the sin which so easily entangles <em>us</em> and run with endurance 
                the race which is set before us,';

            break;
            case 'james3_1-2':

                $tmp_verse_array['REFERENCE'][0]        = '3:1-2';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'Do not become many teachers, my brothers, knowing that we will receive greater judgement. For in many things we all stumble. If anyone does not stumble in word, this one is a perfect man, able to bridle the whole body as well.';
                $tmp_verse_array['COPY'][0]             = 'Do not become many teachers, my brothers, knowing that we will 
                receive greater judgement. For in many things we all stumble. If anyone does not stumble in word, 
                this one is a perfect man, able to bridle the whole body as well.';

            break;
            case '1pet1_3-9,13,21':

                $tmp_verse_array['REFERENCE'][0]        = '1:3-9, 13, 21';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = '3 Blessed be the God and Father of our Lord Jesus Christ, who according to His great mercy has regenerated us unto a living hope through the resurrection of Jesus Christ from the dead, Unto an inheritance, incorruptible and undefiled and unfading, kept in the heavens for you,';
                $tmp_verse_array['COPY'][0]             = '<span class="script_ref_num">3</span> Blessed be the God and Father of 
                our Lord Jesus Christ, who according to His great mercy has regenerated us unto a living hope through 
                the resurrection of Jesus Christ from the dead, Unto an inheritance, incorruptible and undefiled and 
                unfading, kept in the heavens for you, Who are being guarded by the power of God through faith unto a 
                salvation ready to be revealed at the last time;

                <div class="cb_10"></div> 
                In which <em>time</em> you exult, though for a little while at present, if it must be, you have been 
                made sorrowful by various trials, So that the proving of your faith, much more precious than of gold 
                which perishes though it is proved by fire, may be found unto praise and glory and honor at the 
                revelation of Jesus Christ;

                <div class="cb_10"></div> 
                Whom having not seen, you love; into whom though not seeing <em>Him</em> at present, yet believing, you 
                exult with joy <em>that is</em> unspeakable and full of glory, Receiving the end of your faith, the 
                salvation of<br>your souls.

                <div class="cb_10"></div> 
                <span class="script_ref_num">13</span> Therefore girding up the loins of your mind <em>and</em> being 
                sober, set your hope perfectly on the grace being brought to you at the revelation of Jesus Christ.

                <div class="cb_10"></div> 
                <span class="script_ref_num">21</span> Who through Him believe into God, who raised Him from the dead 
                and gave Him glory, so that your faith and hope are in God.';

            break;
            case '1pet1_3-5':

                $tmp_verse_array['REFERENCE'][0]        = '1:3-5';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'Blessed be the God and Father of our Lord Jesus Christ, who according to His great mercy has regenerated us unto a living hope through the resurrection of Jesus Christ from the dead, Unto an inheritance, incorruptible and undefiled and unfading, kept in the heavens for you,';
                $tmp_verse_array['COPY'][0]             = 'Blessed be the God and Father of our Lord Jesus Christ, who according to 
                His great mercy has regenerated us unto a living hope through the resurrection of Jesus Christ from the 
                dead, Unto an inheritance, incorruptible and undefiled and unfading, kept in the heavens for you, Who 
                are being guarded by the power of God through faith unto a salvation ready to be revealed at the 
                last time.';

            break;
            case '1pet1_13':

                $tmp_verse_array['REFERENCE'][0]        = '1:13';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'Therefore girding up the loins of your mind being sober, set your hope perfectly on the grace being brought to you at the revelation of Jesus Christ.';
                $tmp_verse_array['COPY'][0]             = 'Therefore girding up the loins of your mind <em>and</em> being sober, set
                your hope perfectly on the grace being brought to you at the revelation of Jesus Christ.';

            break;
            case '1pet2_16':

                $tmp_verse_array['REFERENCE'][0]        = '2:16';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'As free, and yet not having freedom as a covering for evil, but as slaves of God.';
                $tmp_verse_array['COPY'][0]             = 'As free, and yet not having freedom as a covering for evil, but as 
                slaves of God.';

            break;
            case '1pet2_20':

                $tmp_verse_array['REFERENCE'][0]        = '2:20';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'For what glory is it if, while sinning and being buffeted, you endure? But if, while doing good and suffering, you endure, this is grace with God.';
                $tmp_verse_array['COPY'][0]             = 'For what glory is it if, while sinning and being buffeted, you 
                endure? But if, while doing good and suffering, you endure, this is grace<br>with God.';

            break;
            case '1pet2_7-8':

                $tmp_verse_array['REFERENCE'][0]        = '2:7-8';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'To you therefore who believe is the preciousness; but to the unbelieving, &quot;The stone which the builders rejected, this has become the head of the corner,&quot; And, &quot;A stone of stumbling and a rock of offense&quot;; who stumble at the word, being disobedient, to which also they were appointed.';
                $tmp_verse_array['COPY'][0]             = 'To you therefore who believe is the preciousness; but to the 
                unbelieving, &quot;The stone which the builders rejected, this has become the head of the corner,&quot; 
                And, &quot;A stone of stumbling and a rock of offense&quot;; who stumble at the word, being 
                disobedient, to which also they were appointed.';

            break;
            case '1pet2_24':

                $tmp_verse_array['REFERENCE'][0]        = '2:24';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'Who Himself bore up our sins in His body on the tree, in order that we, having died to sins, might live to righteousness; by whose bruise you were healed.';
                $tmp_verse_array['COPY'][0]             = 'Who Himself bore up our sins in His body on the tree, in order that 
                we, having died to sins, might live to righteousness; by whose bruise you were healed.';

            break;
            case '1pet3_15':

                $tmp_verse_array['REFERENCE'][0]        = '3:15';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'But sanctify Christ as Lord in your hearts, being always ready for a defense to everyone who asks of you an account concerning the hope which is in you,';
                $tmp_verse_array['COPY'][0]             = 'But sanctify Christ as Lord in your hearts, being always ready for a 
                defense to everyone who asks of you an account concerning the hope which is in you,';

            break;
            case '1pet3_5-7,14-22':

                $tmp_verse_array['REFERENCE'][0]        = '3:5-7, 14-22';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = '5 For in this manner formerly the holy women also, who hoped in God, adorned themselves, being subject to their own husbands, As Sarah obeyed Abraham, calling him lord; whose children you have become, if you do good and do not fear any terror.';
                $tmp_verse_array['COPY'][0]             = '<span class="script_ref_num">5</span> For in this manner formerly the 
                holy women also, who hoped in God, adorned themselves, being subject to their own husbands, As Sarah 
                obeyed Abraham, calling him lord; whose children you have become, if you do good and do not fear any 
                terror.

                <div class="cb_10"></div> 
                Husbands, in like manner dwell together with <em>them</em> according to knowledge, as with the 
                weaker, female vessel, assigning honor to <em>them</em> as also to fellow heirs of the grace of life, 
                that your prayers may not be hindered.

                <div class="cb_10"></div> 
                <span class="script_ref_num">14</span> But even if you suffer because of righteousness, you are blessed. 
                And do not be afraid <em>with</em> fear from them, nor be troubled, But sanctify Christ as Lord in your 
                hearts, being always ready for a defense to everyone who asks of you an account concerning the hope 
                which is in you, Yet with meekness and fear, having a good conscience, so that in the manner in which 
                you are spoken against, those who revile your good manner of life in Christ may be put<br>to shame.

                <div class="cb_10"></div> 
                For it is better, if the will of God should will <em>it</em>, to suffer for doing good than for doing 
                evil. For Christ also has suffered once for sins, the Righteous on behalf of the unrighteous, that He 
                might bring you to God, on the one hand being put to death in the flesh, but on the other, made alive in 
                the Spirit;

                <div class="cb_10"></div> 
                In which also He went and proclaimed to the spirits in prison, Who had formerly disobeyed when the 
                long-suffering of God waited in the days of Noah, while the ark was being prepared; <em>entering</em> 
                into which, a few, that is, eight souls, were brought safely through by water.

                <div class="cb_10"></div> 
                Which <em>water</em>, as the antitype, also now saves you, <em>that is</em>, baptism, not a putting away 
                of the filth of the flesh but the appeal of a good conscience unto God, through the resurrection of 
                Jesus Christ, Who is at the right hand of God, having gone into heaven, angels and authorities and 
                powers being subjected to Him.';

            break;
            case '1pet5_8':

                $tmp_verse_array['REFERENCE'][0]        = '5:8';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'Be sober; watch. Your adversary, the devil, as a roaring lion, walks about, seeking someone to devour.';
                $tmp_verse_array['COPY'][0]             = 'Be sober; watch. Your adversary, the devil, as a roaring lion, walks 
                about, seeking someone to devour.';

            break;
            case '1john2_15-17':

                $tmp_verse_array['REFERENCE'][0]        = '2:15-17';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'Do not love the world nor the things in the world. If anyone loves the world, love for the Father is not in him; Because all that is in the world, the lust of the flesh and the lust of the eyes and the vainglory of life, is not of the Father but is of the world. And the world is passing away, and its lust, but he who does the will of God abides forever.';
                $tmp_verse_array['COPY'][0]             = 'Do not love the world nor the things in the world. If anyone loves 
                the world, love for the Father is not in him; Because all that is in the world, the lust of the 
                flesh and the lust of the eyes and the vainglory of life, is not of the Father but is of the world. 
                And the world is passing away, and its lust, but he who does the will of God<br>abides forever.';

            break;
            case '1john3_1-10':

                $tmp_verse_array['REFERENCE'][0]        = '3:1-10';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'Behold what manner of love the Father has given to us, that we should be called children of God; and we are. Because of this the world does not know us, because it did not know Him.';
                $tmp_verse_array['COPY'][0]             = 'Behold what manner of love the Father has given to us, that we should be 
                called children of God; and we are. Because of this the world does not know us, because it did not know 
                Him. Beloved, now we are children of God, and it has not yet been manifested what we will be. We know 
                that if He is manifested, we will be like Him because we will see Him even as He is.

                <div class="cb_10"></div>
                And everyone who has this hope <em>set</em> on Him purifies himself, even as He is pure. Everyone who 
                practices sin practices lawlessness also, and sin is lawlessness. And you know that He was manifested 
                that He might take away sins; and sin is not in Him.

                <div class="cb_10"></div>
                Everyone who abides in Him does not sin; everyone who sins has not seen Him or known Him. Little 
                children, let no one lead you astray; he who practices righteousness is righteous, even as He<br> 
                is righteous;

                <div class="cb_10"></div>
                He who practices sin is of the devil, because the devil has sinned from the beginning. For this purpose 
                the Son God was manifested, that He might destroy the works of the devil. Everyone who has been begotten 
                of God does not practice sin, because His seed abides in him; and he cannot sin, because he has been 
                begotten of God.

                <div class="cb_10"></div>
                In this the children of God and the children of the devil are manifest. Everyone who does not practice 
                righteousness is not of God, neither he who does not love his brother.';

            break;
            case 'rev2_10-11':

                $tmp_verse_array['REFERENCE'][0]        = '2:10-11';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'Do not fear the things that you are about to suffer. Behold, the devil is about to cast some of you into prison that you may be tried, and you will have tribulation for ten days. Be faithful unto death, and I will give you the crown of life. He who has an ear, let him hear what the Spirit says to the churches. He who overcomes shall by no means be hurt of the second death.';
                $tmp_verse_array['COPY'][0]             = 'Do not fear the things that you are about to suffer. Behold, the 
                devil is about to cast some of you into prison that you may be tried, and you will have tribulation 
                for ten days. Be faithful unto death, and I will give you the crown of life. He who has an ear, let 
                him hear what the Spirit says to the churches. He who overcomes shall by no means be hurt of the 
                second death.';

            break;
            case 'rev2_12-17':

                $tmp_verse_array['REFERENCE'][0]        = '2:12-17';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'And to the messenger of the church in Pergamos write: These things says He who has the sharp two-edged sword: I know where you dwell, where Satan\'s throne is; and you hold fast My name and have not denied My faith, even in the days of Antipas, My witness, My faithful one, who was killed among you, where Satan dwells.';
                $tmp_verse_array['COPY'][0]             = 'And to the messenger of the church in Pergamos write: These things says 
                He who has the sharp two-edged sword: I know where you dwell, where Satan\'s throne is; and you hold 
                fast My name and have not denied My faith, even in the days of Antipas, My witness, My faithful one, who 
                was killed among you, where Satan dwells. 

                <div class="cb_10"></div>
                But I have a few things against you, that you have some there who hold the teaching of Balaam, who 
                taught Balak to put a stumbling block before the sons of Israel, to eat idol sacrifices and to<br>
                commit fornication.

                <div class="cb_10"></div>
                In the same way you also have some who hold in like manner the teaching of the Nicolaitans. Repent 
                therefore; but if not, I am coming to you quickly, and I will make war with them with the sword of<br> 
                My mouth.

                <div class="cb_10"></div>
                He who has an ear, let him hear what the Spirit says to the churches. To him who overcomes, to him I 
                will give of the hidden manna, and to him I will give a white stone, and upon the stone a new name 
                written, which no one knows except him who receives <em>it</em>.';

            break;
            case 'rev2_18-23':

                $tmp_verse_array['REFERENCE'][0]        = '2:18-23';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'And to the messenger of the church in Thyatira write: These things says the Son of God, He who has eyes like a flame of fire, and His feet are like shining bronze: I know your works and love and faith and service and your endurance and that your last works are more than the first. But I have against you, that you tolerate the woman Jezebel,';
                $tmp_verse_array['COPY'][0]             = 'And to the messenger of the church in Thyatira write: These things says 
                the Son of God, He who has eyes like a flame of fire, and His feet are like shining bronze: I know your 
                works and love and faith and service and your endurance and that your last works are more than the 
                first. But I have <em>something</em> against you, that you tolerate the woman Jezebel, she who calls 
                herself a prophetess and teaches and leads My slaves astray to commit fornication and to eat<br>idol 
                sacrifices.

                <div class="cb_10"></div>
                And I gave her time that she might repent, and she is not willing to repent of her fornication. Behold, 
                I cast her into a bed, and those who commit adultery with her, into great tribulation, unless they 
                repent of her works; And her children I will kill with death; and all the churches will know that I am 
                He who searches the inward parts and the hearts; and I will give to each one of you according to<br> 
                your works.';

            break;
            case 'rev2_14[solo]':
            case 'rev2_14':

                $tmp_verse_array['REFERENCE'][0]        = '2:14';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'But I have a few things against you, that you have some there who hold the teaching of Balaam, who taught Balak to put a stumbling block before the sons of Israel, to eat idol sacrifices and to commit fornication.';
                $tmp_verse_array['COPY'][0]             = 'But I have a few things against you, that you have some there who 
                hold the teaching of Balaam, who taught Balak to put a stumbling block before the sons of Israel, to 
                eat idol sacrifices and to<br>commit fornication.';

            break;
            case 'rev2_11|2_17,26-28|3_5,12,21':

                $tmp_verse_array['REFERENCE'][0]        = '2:11; 2:17,<br>26-28; 3:5,12,<br>21';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = '11 He who has an ear, let him hear what the Spirit says to the churches. He who overcomes shall by no means be hurt of the second death. 17 He who has an ear, let him hear what the Spirit says to the churches. To him who overcomes, to him I will give of the hidden manna, and to him I will give a white stone, and upon the stone a new name written, which no one knows except him who receives.';
                $tmp_verse_array['COPY'][0]             = '<span class="script_ref_num">11</span> He who has an ear, let him 
                hear what the Spirit says to the churches. He who overcomes shall by no means be hurt of the<br>
                second death.

                <div class="cb_10"></div>
                <span class="script_ref_num">17</span> He who has an ear, let him hear what the Spirit says to the 
                churches. To him who overcomes, to him I will give of the hidden manna, and to him I will give a 
                white stone, and upon the stone a new name written, which no one knows except him who 
                receives <em>it</em>.

                <div class="cb_10"></div>
                <span class="script_ref_num">26</span> And he who overcomes and he who keeps My works until the end, 
                to him I will give authority over the nations; And he will shepherd them with an iron rod, as 
                vessels of pottery are broken in pieces, as I also have received from My Father; And to him I will 
                give the morning star.

                <div class="cb_10"></div>
                <span class="script_ref_num">5</span> He who overcomes will be clothed thus, in white garments, and 
                I shall by no means erase his name out of the book of life, and I will confess his name before My 
                Father and before His angels.

                <div class="cb_10"></div>
                <span class="script_ref_num">12</span> He who overcomes, him I will make a pillar in the temple of 
                My God, and he shall by no means go out anymore, and I will write upon him the name of My God and 
                the name of the city of My God, the New Jerusalem, which descends out of heaven from My God, and My 
                new name.

                <div class="cb_10"></div>
                <span class="script_ref_num">21</span> He who overcomes, to him I will give to sit with Me on My 
                throne, as I also overcame and sat with My Father on His throne.';

            break;
            case 'rev2_21-22':

                $tmp_verse_array['REFERENCE'][0]        = '2:21-22';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'And I gave her time that she might repent, and she is not willing to repent of her fornication. Behold, I cast her into a bed, and those who commit adultery with her, into great tribulation, unless they repent of her works;';
                $tmp_verse_array['COPY'][0]             = 'And I gave her time that she might repent, and she is not willing to 
                repent of her fornication. Behold, I cast her into a bed, and those who commit adultery with her, 
                into great tribulation, unless they repent of her works;';

            break;
            case 'rev3_8':

                $tmp_verse_array['REFERENCE'][0]        = '3:8';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'I know your works; behold, I have put before you an opened door which no one can shut, because you have a little power and have kept My word and have not denied My name.';
                $tmp_verse_array['COPY'][0]             = 'I know your works; behold, I have put before you an opened door which 
                no one can shut, because you have a little power and have kept My word and have not denied My name.';

            break;
            case 'rev3_7-13':

                $tmp_verse_array['REFERENCE'][0]        = '3:7-13';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'And to the messenger of the church in Philadelphia write: These things says the Holy One, the true One, the One who has the key of David, the One who opens and no one will shut, and shuts and no one opens:';
                $tmp_verse_array['COPY'][0]             = 'And to the <a id="sup_ftnt_1" href="#" class="script_sup" onclick="jony5_vv_scroll_to(\'ftnt_1\');">1</a>messenger 
                of the church in Philadelphia write: These things says <a id="sup_ftnt_2" href="#" class="script_sup" onclick="jony5_vv_scroll_to(\'ftnt_2\');" style="display: none;">2</a>the 
                Holy One, the true One, the One who has the key of David, the One who opens and no one will shut, 
                and shuts and no one opens:<br>

                <div class="cb_10"></div>
                I know your <a id="sup_ftnt_3" href="#" class="script_sup" onclick="jony5_vv_scroll_to(\'ftnt_3\');" style="display: none;">3</a>works; 
                behold, I have put before you an <a id="sup_ftnt_4" href="#" class="script_sup" onclick="jony5_vv_scroll_to(\'ftnt_4\');" style="display: none;">4</a>opened 
                door which no one can shut, because you have a <a id="sup_ftnt_5" href="#" class="script_sup" onclick="jony5_vv_scroll_to(\'ftnt_5\');" style="display: none;">5</a>little 
                power and have <a id="sup_ftnt_6" href="#" class="script_sup" onclick="jony5_vv_scroll_to(\'ftnt_6\');" style="display: none;">6</a>kept 
                My word and have <a id="sup_ftnt_7" href="#" class="script_sup" onclick="jony5_vv_scroll_to(\'ftnt_7\');" style="display: none;">7</a>not 
                denied My name. Behold, I will make <a id="sup_ftnt_8" href="#" class="script_sup" onclick="jony5_vv_scroll_to(\'ftnt_8\');" style="display: none;">8</a>those 
                of the synagogue of Satan, those who call themselves Jews and are not, but lie&ndash;&ndash;behold, 
                I will cause them to come and fall prostrate before your feet and to know that I have loved you.

                <div class="cb_10"></div>
                <a id="sup_ftnt_9" href="#" class="script_sup" onclick="jony5_vv_scroll_to(\'ftnt_9\');" style="display: none;">9</a>Because 
                you have kept the <a id="sup_ftnt_10" href="#" class="script_sup" onclick="jony5_vv_scroll_to(\'ftnt_10\');" style="display: none;">10</a>word 
                of My endurance, I also will keep you out of the <a id="sup_ftnt_11" href="#" class="script_sup" onclick="jony5_vv_scroll_to(\'ftnt_11\');" style="display: none;">11</a>hour 
                of trial, which is about to come on the whole inhabited earth, to try them who dwell on the earth.

                <a id="sup_ftnt_12" href="#" class="script_sup" onclick="jony5_vv_scroll_to(\'ftnt_12\');" style="display: none;">12</a>I 
                come quickly; <a id="sup_ftnt_13" href="#" class="script_sup" onclick="jony5_vv_scroll_to(\'ftnt_13\');" style="display: none;">13</a>hold 
                fast what you have that no one take your crown.<br>

                <div class="cb_10"></div>
                <a id="sup_ftnt_14" href="#" class="script_sup" onclick="jony5_vv_scroll_to(\'ftnt_14\');" style="display: none;">14</a>He 
                who overcomes, him I will make a pillar in the temple of My God, and he shall by no means go out 
                anymore, and I will write upon him the name of My God and the name of the city of My God, the New 
                Jerusalem, which descends out of heaven from My God, and My new name. He who has an ear, let him 
                hear what the Spirit says to the churches.';

            break;
            case 'rev3_19':

                $tmp_verse_array['REFERENCE'][0]        = '3:19';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'As many as I love I reprove and discipline; be zealous therefore and repent.';
                $tmp_verse_array['COPY'][0]             = 'As many as I love I reprove and discipline; be zealous therefore<br> 
                and repent.';

            break;
            case 'rev6_16-17':

                $tmp_verse_array['REFERENCE'][0]        = '6:16-17';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'And they say to the mountains and to the rocks, Fall on us and hide us from the face of Him who sits upon the throne and from the wrath of the Lamb; For the great day of Their wrath has come, and who is able to stand?';
                $tmp_verse_array['COPY'][0]             = 'And they say to the mountains and to the rocks, Fall on us and hide 
                us from the face of Him who sits upon the throne and from the wrath of the Lamb; For the great day 
                of Their wrath has come, and who is able to stand?';

            break;
            case 'rev12_3-4,9':

                $tmp_verse_array['REFERENCE'][0]        = '12:3-4, 9';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = '3 And another sign was seen in heaven; and behold, a great red dragon, having seven heads and ten horns, and on his heads seven diadems. And his tail drags away the third part of the stars of heaven, and he cast them to the earth. And the dragon stood before the woman who was about to bring forth, so that when she brings forth he might devour her child.';
                $tmp_verse_array['COPY'][0]             = '<span class="script_ref_num">3</span> And another sign was seen in 
                heaven; and behold, <em>there was</em> a great red dragon, having seven heads and ten horns, and on 
                his heads seven diadems. And his tail drags away the third part of the stars of heaven, and he cast 
                them to the earth. And the dragon stood before the woman who was about to bring forth, so that when 
                she brings forth he might devour her child.

                <div class="cb_10"></div>
                <span class="script_ref_num">9</span> And the great dragon was cast down, the ancient serpent, he 
                who is called the Devil and Satan, he who deceives the whole inhabited earth; he was cast to the 
                earth, and his angels were cast down<br>with him.';

            break;
            case 'rev12_3-4,13,17;13:2,4':

                $tmp_verse_array['REFERENCE'][0]        = '12:3-4, 13, 17; 13:2, 4';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = '3 And another sign was seen in heaven; and behold, a great red dragon, having seven heads and ten horns, and on his heads seven diadems. And his tail drags away the third part of the stars of heaven, and he cast them to the earth. And the dragon stood before the woman who was about to bring forth, so that when she brings forth he might devour her child.';
                $tmp_verse_array['COPY'][0]             = '<span class="script_ref_num">3</span> And another sign was seen in 
                heaven; and behold, <em>there was</em> a great red dragon, having seven heads and ten horns, and on 
                his heads seven diadems. And his tail drags away the third part of the stars of heaven, and he cast 
                them to the earth. And the dragon stood before the woman who was about to bring forth, so that when 
                she brings forth he might devour her child.

                <div class="cb_10"></div>
                <span class="script_ref_num">13</span> And when the dragon saw that he was cast to the earth, he 
                persecuted the woman who brought forth the man-child.

                <div class="cb_10"></div>
                <span class="script_ref_num">17</span> And the dragon became angry with the woman and went away to 
                make war with the rest of her seed, who keep the commandments of God and have the testimony 
                of Jesus.

                <div class="cb_10"></div>
                <span class="script_ref_num">13:2</span> And the beast which I saw was like a leopard, and his feet 
                like those of a bear, and his mouth like the mouth of a lion. And the dragon gave him his power and 
                his throne and great authority.

                <div class="cb_10"></div>
                <span class="script_ref_num">4</span> And they worshipped the dragon because he gave his authority 
                to the beast; and they worshipped the beast, saying, Who is like the beast? And who can make war 
                with him?';

            break;
            case 'rev20_6':

                $tmp_verse_array['REFERENCE'][0]        = '20:6';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'Blessed and holy is he who has part in the first resurrection; over these the second death has no authority, but they will be priests of God and of Christ and will reign with Him for a thousand years.';
                $tmp_verse_array['COPY'][0]             = 'Blessed and holy is he who has part in the first resurrection; over 
                these the second death has no authority, but they will be priests of God and of Christ and will 
                reign with Him for a thousand years.';

            break;
            case 'rev21_2,9-27':

                $tmp_verse_array['REFERENCE'][0]        = '21:2, 9-27';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = '2 And I saw the holy city, New Jerusalem, coming down out of heaven from God, prepared as a bride adorned for her husband. 9 And one of the seven angels who had the seven bowls full of the seven last plagues came and spoke with me, saying, Come here; I will show you the bride, the wife of the Lamb. And he carried me away in spirit onto a great and high mountain and showed me the holy city, Jerusalem, coming down out of heaven from God, Having the glory of God.';
                $tmp_verse_array['COPY'][0]             = '<span class="script_ref_num">2</span> And I saw the holy city, New 
                Jerusalem, coming down out of heaven from God, prepared as a bride adorned for her husband.

                <div class="cb_10"></div>
                <span class="script_ref_num">9</span> And one of the seven angels who had the seven bowls full of 
                the seven last plagues came and spoke with me, saying, Come here; I will show you the bride, the 
                wife of the Lamb. And he carried me away in spirit onto a great and high mountain and showed me the 
                holy city, Jerusalem, coming down out of heaven from God, Having the glory of God. Her light was 
                like a most precious stone, like a jasper stone, as clear as crystal. It had a great and high wall 
                and had twelve gates, and at the gates twelve angels, and names inscribed, which are the names of 
                the twelve tribes of the sons of Israel: On the east three gates, and on the north three gates, and 
                on the south three gates, and on the west three gates. And the wall of the city had twelve 
                foundations, and on them the twelve names of the twelve apostles of the Lamb. And he who spoke with 
                me had a golden reed as a measure that he might measure the city and its gates and its wall. And the 
                city lies square, and its length is as great as the breadth. And he measured the city with the reed 
                to <em>a length of</em> twelve thousand stadia; the length and the breadth and the height of it are 
                equal. And he measured its wall, a hundred and forty-four cubits, <em>according to</em> the measure 
                of a man, that is, of an angel. And the building work of its wall was jasper; and the city was pure 
                gold, like clear glass. The foundations of the wall of the city were adorned with every precious 
                stone: the first foundation was jasper; the second, sapphire; the third, chalcedony; the fourth, 
                emerald; The fifth, sardonyx; the sixth, sardius; the seventh, chrysolite; the eight, beryl; the 
                ninth, topaz; the tenth, chrysoprase; the eleventh, jacinth; the twelfth, amethyst. And the twelve 
                gates were twelve pearls; each one of the gates was, respectively, of one pearl. And the street of 
                the city was pure gold, like transparent glass. And I saw no temple in it, for the Lord God the 
                Almighty and the Lamb are its temple. And the city has no need of the sun or of the moon that they 
                should shine in it, for the glory of God illumined it, and its lamp is the Lamb. And the nations 
                will walk by its light; and the kings of the earth bring their glory into it. And its gates shall 
                by no means be shut by day, for there will be no night there. And they will bring the glory and the 
                honor of the nations into it. And anything common and he who makes an abomination and a lie shall by 
                no means enter into it, but only those who are written in the Lamb\'s book of life.';

            break;
            case 'rev21_7':

                $tmp_verse_array['REFERENCE'][0]        = '21:7';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'He who overcomes will inherit these things, and I will be God to him, and he will be a son to Me.';
                $tmp_verse_array['COPY'][0]             = 'He who overcomes will inherit these things, and I will be God to 
                him, and he will be a son to Me.';

            break;
            case 'rev21_3-5':

                $tmp_verse_array['REFERENCE'][0]        = '21:3-5';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'And I heard a loud voice out of the throne, saying, Behold, the tabernacle of God is with men, and He will tabernacle with them, and they will be His peoples, and God Himself will be with them their God. And He will wipe away every tear from their eyes; and death will be no more, nor will there be sorrow or crying or pain anymore; for the former things have passed away. And He who sits on the throne said, Behold, I make all things new. And He said, Write, for these words are faithful and true.';
                $tmp_verse_array['COPY'][0]             = 'And I heard a loud voice out of the throne, saying, Behold, the 
                tabernacle of God is with men, and He will tabernacle with them, and they will be His peoples, and 
                God Himself will be with them <em>and be</em> their God. And He will wipe away every tear from their 
                eyes; and death will be no more, nor will there be sorrow or crying or pain anymore; for the former
                things have passed away. And He who sits on the throne said, Behold, I make all things new. And He 
                said, Write, for these words are faithful and true.';

            break;
            case 'rev21_21':

                $tmp_verse_array['REFERENCE'][0]        = '21:21';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'And the twelve gates were twelve pearls; each one of the gates was, respectively, of one pearl. And the street of the city was pure gold, like transparent glass.';
                $tmp_verse_array['COPY'][0]             = 'And the twelve gates were twelve pearls; each one of the gates was, 
                respectively, of one pearl. And the <a id="sup_ftnt_3" href="#" class="script_sup" onclick="jony5_vv_scroll_to(\'ftnt_3\');">3</a>street 
                of the city was pure gold, like transparent glass.';

            break;
            case 'rev22_2':

                $tmp_verse_array['REFERENCE'][0]        = '22:2';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = 'And on this side and on that side of the river was the tree of life, producing twelve fruits, yielding its fruit each month; and the leaves of the tree of life are for the healing of the nations.';
                $tmp_verse_array['COPY'][0]             = 'And on this side and on that side of the river was the tree of life, 
                producing twelve fruits, yielding its fruit each month; and the leaves of the tree of life are for the 
                healing of the nations.';

            break;
            default:

                //
                // NOTHING TO DO HERE...BUT, HELLO :)
                $tmp_verse_array['REFERENCE'][0]        = 'Hi there.';
                $tmp_verse_array['SOCIAL_PREVIEW'][0]   = '';
                $tmp_verse_array['COPY'][0]             = 'Thanks for stopping by!';

            break;

        }

        return $tmp_verse_array;

    }

    private function return_footnote_preciousness(){

        //
        // THE FOOTNOTE ARRAY STRUCTURE IS AS FOLLOWS.
        // [0][n+1] = REFERENCE
        // [1][n+1] = COPY
        $tmp_footnote_array = array();
        $tmp_top_lnk_html = '';

        if(self::$oEnv->oHTTP_MGR->issetHTTP($_GET)){

            //
            // STORE THE $_GET[] DATA THAT HAS BEEN SENT.
            $tmp_vvid = self::$oEnv->oHTTP_MGR->extractData($_GET, 'vv');

            //
            // ?vv=deut33_1-4,12,29
            if(strlen($tmp_vvid) != 0){

                $tmp_request_uri = $_SERVER['REQUEST_URI'];

                $patterns = array();
                $patterns[0] = 'vv=' . $tmp_vvid;
                $patterns[1] = self::$oEnv->getEnvParam('DOCUMENT_ROOT_DIR');       // ALIGN SOCIAL SHARE URI DEEP LINK TESTING ON LOCALHOST_CHAD_MACBOOKPRO TO PRODUCTION.
                $patterns[2] = '/';                                                 // ALIGN SOCIAL SHARE URI DEEP LINK TESTING ON LOCALHOST_CHAD_MACBOOKPRO TO PRODUCTION.

                $replacements = array();
                $replacements[0] = '';
                $replacements[1] = '';
                $replacements[2] = '';
                $tmp_request_uri = str_replace($patterns, $replacements, $tmp_request_uri);

                //
                // Sunday, March 3, 2024 @ 1659 hrs.
                //error_log(__LINE__ . ' precious $tmp_request_uri[' . $tmp_request_uri . ']. vvid[' . $tmp_vvid . ']. REQUEST_URI[' . $_SERVER['REQUEST_URI'] . '].');

                if(strlen($tmp_request_uri) > 1){

                    $tmp_top_lnk_html = '                    <div style="width:100%;">
                    <div style="position:relative; float:right;">
                        <div style="position:absolute;"><a href="#" onclick="jony5_vv_scroll_to(\'script_scroll\');" style=\'color:#0066CC; text-decoration:none; font-family: "Courier New", Courier, monospace; font-size: 16px;\'>top</a></div>
                    </div>
                </div>';

                }

            }

        }

        switch($this->vvid){
            case 'gen49_1,25-28':
            case 'gen48_21-22|49_1,25-28':

                $tmp_footnote_array['REFERENCE'][0] = '49:27<span class="script_sup">1</span>';
                $tmp_footnote_array['COPY'][0]      = 'Lit., tearing. As a tearing wolf, Benjamin is a type of Christ, 
                who destroys the enemy by tearing him to pieces (Eph. 4:8; 2 Cor. 10:5). <span class="crnrstn_cite_lee">- w. lee.</span><div class="cb_10"></div>
                <div class="cb_20"></div>';

            break;
            case 'exo30_18':

                $tmp_footnote_array['REFERENCE'][0] = '30:18<span class="script_sup">1</span>';
                $tmp_footnote_array['COPY'][0]      = 'The laver typifies the washing power of the life-giving Spirit 
                issuing from the death of Christ. The locating of the laver after the alter signifies that the 
                washing power of the laver comes out of God\'s judgement at the alter. After passing through God\'s 
                full judgement at the alter (the cross), the crucified Christ entered into resurrection and became 
                the life-giving Spirit who washes us (1 Cor. 15:45; 6:11; Titus 3:5). The dimensions of the laver 
                are not given, signifying that the life-giving Spirit is immeasurable, unlimited (John 3:34). 
                <span class="crnrstn_cite_lee">- w. lee.</span><div class="cb_10"></div>
                <div class="cb_20"></div>';

            break;
            case 'lev2_1':

                $tmp_footnote_array['REFERENCE'][0] = '2:1<span class="script_sup">2</span>';
                $tmp_footnote_array['COPY'][0]      = 'Fine flour, the main element of the meal offering, signifies 
                Christ\'s humanity, which is fine, perfect, tender, balanced, and right in every way, with no excess 
                and no deficiency. This signifies the beauty and excellence of Christ\'s human living and daily 
                walk. The fine flour of the meal offering was produced out of wheat that had passed through many 
                processes, which signify the various sufferings of Christ that made Him &quot;a man of sorrows&quot; 
                (Isa. 53:3).

                <div class="cb_10"></div>
                In contrast to the burnt offering, nothing of the animal life, but only the vegetable life, is seen 
                in the meal offering. As a type of Christ, the vegetable life indicates the produce, the 
                propagation, and the increase for the supplying of life to people. <span class="crnrstn_cite_lee">- w. lee.</span><div class="cb_10"></div>
                <div class="cb_20"></div>';

            break;
            case 'isa14_13':

                $tmp_footnote_array['REFERENCE'][0] = '14:13<span class="script_sup">2</span>';
                $tmp_footnote_array['COPY'][0]      = 'The highest place, where God sits on His throne, in the place 
                where He assembles with all the angels (Job 1:6; 2:1). In his rebellion against God, Satan wanted to 
                be on the same level as God. <span class="crnrstn_cite_lee">- w. lee.</span><div class="cb_10"></div>
                <div class="cb_20"></div>';

            break;
            case 'dan9_17-27':

                $tmp_footnote_array['REFERENCE'][0] = '9:27<span class="script_sup">1</span>';
                $tmp_footnote_array['COPY'][0]      = '<a id="ftnt_1"></a>
                The fulfillment of the prophecies concerning both the ceasing of the sacrifice and the bringing in 
                of the abominations of the desolator have transpired within the temple (John 2:19-21) or soul of a 
                christian brother, the messenger to the church in Philadelphia, between Q4 2011 and 2023. For more 
                on the messenger to the church in Philadelphia, see ' . $this->link_html('rev3_7-13', 'Rev. 3:7, note 1') . '.
                ' . $tmp_top_lnk_html . '<div class="cb_10"></div>

                For a laboring priest of Jehovah, a portion of food is often available from God for the priest\'s 
                satisfaction and enjoyment through the ordinary course and fulfillment of the priestly duties. In 
                the Old Testament, the animal sacrifices often provided meat for the offering priest and offerrer to 
                eat after sacrificing to Jehovah. Now that the Lord is the Spirit (2 Cor 3:17) within the believers, 
                when the prophet of Jehovah faithfully speaks the word of the Lord, the heavenly Master of the 
                prophet can respond within the heart of the laboring priest with &quot;AMEN!&quot;, which to the 
                speaking prophet is truly a most satisfying meal to their soul (John 4:32-34). This is an example of 
                the enjoyment of sacrifice for a priest in God\'s New Testament economy.' . $tmp_top_lnk_html . '<div class="cb_10"></div>

                When the synagogue of Satan (Rev. 3:9) uses advanced technology to trample the outer court (Rev. 
                11:1-2) of the temple (John 2:21)...perverting the mouth of the prophet away from speaking the word 
                of the Lord, the heavenly Master of the prophet does not respond with &quot;AMEN!&quot; inside of the heart of 
                the speaking saint. This deprives His own slave (Rev. 10:7) of food and the enjoyment of sacrifice; 
                the sacrifice and enjoyment within the soul of the prophet has ceased. This is the precise method 
                and manner of the fulfillment of the prophecies concerning the ceasing of the sacrifice and the 
                oblation recorded in both the Old and New Testaments of the Bible (Dan. 9:27; Matt. 24:15).

                ' . $tmp_top_lnk_html . '
                <div class="cb_10"></div>
                Sacrifice, as used here, (1) refers generally to the satisfaction, rest, and enjoyment of the soul 
                obtained in the course of normal human living, and (2) refers specifically to the food or enjoyment 
                received from doing the will of God our Father. Oftentimes, there is significant overlap betwixt 
                the former and the latter...such as when going to a rave, when crushing a beer, or when leaving 
                independent contractors at the strip club with no other option but to bring out the rakes. All of 
                these forms of sacrifice and many more unmentioned have ceased in the living of the messenger to the 
                church in Philadelphia to fulfill the Word of God at the end of this age.' . $tmp_top_lnk_html . '<div class="cb_10"></div>

                The vessel or soul of the messenger to the church in Philadelphia is the temple within which the 
                abominations or the evil possessions (even intentions of heart) of the desolation (Matt. 24:15; see 
                synagogue of Satan in Rev. 3:9) are slanderously established (or cast by shadow and illusion)...and 
                all this whilst the testimony of the gospel of the kingdom is being preached with boldness, clarity, 
                and wit to the whole inhabited earth (Matt. 24:14).
                <div class="cb_20"></div>';

            break;
            case 'joel2_23':

                $tmp_footnote_array['REFERENCE'][0] = '2:23<span class="script_sup">1</span>';
                $tmp_footnote_array['COPY'][0]      = '<a id="ftnt_1"></a>
                The rain in the Scriptures signifies the Spirit of God sent by Him from the heavens to water His 
                people (cf. Gen. 2:5; Deut. 11:14). The outpourings of the Spirit referred to in vv. 28-29 and in Zech. 
                12:10 are the fulfillment of the early rain (the autumn rain) and the late rain (the spring rain). <span class="crnrstn_cite_lee">- w. lee.</span><div class="cb_10"></div>
                <div class="cb_20"></div>';

            break;
            case 'matt1_18,20':

                $tmp_footnote_array['REFERENCE'][0] = '1:20<span class="script_sup">1</span>';
                $tmp_footnote_array['COPY'][0]      = 'God was first born into Mary through His Spirit; after the 
                conception was completed, He, with the human nature, was born to be a God-man, possessing both 
                divinity and humanity. This is the origin<br>of Christ. <span class="crnrstn_cite_lee">- w. lee.</span><div class="cb_10"></div>
                <div class="cb_20"></div>';

            break;
            case 'matt3_15':

                $tmp_footnote_array['REFERENCE'][0] = '3:15<span class="script_sup">1</span>';
                $tmp_footnote_array['COPY'][0]      = 'Righteousness is to be right by living, walking, and doing things 
                in the way God has ordained. In the Old Testament, to be righteous was to keep the law that God had 
                given. Now God sent John the Baptist to institute baptism. To be baptized also is to fulfill 
                righteousness before God, that is, to fulfill the requirement of God. The Lord Jesus came to John 
                not as God but as a typical man, a real Israelite. Hence, He had to be baptized in order to keep 
                this dispensational practice of God; otherwise, He would not have been right with God. <span class="crnrstn_cite_lee">- w. lee.</span><div class="cb_10"></div>
                <div class="cb_20"></div>';

            break;
            case 'matt13_4':

                $tmp_footnote_array['REFERENCE'][0] = '13:4<span class="script_sup">1</span>';
                $tmp_footnote_array['COPY'][0]      = '<a id="ftnt_1"></a>
                The seeds are the word of the kingdom (v 19), the Lord being in this word as life. <span class="crnrstn_cite_lee">- w. lee.</span><div class="cb_10"></div>';

                $tmp_footnote_array['REFERENCE'][1] = '13:4<span class="script_sup">2</span>';
                $tmp_footnote_array['COPY'][1]      = '<a id="ftnt_2"></a>
                Beside the way refers to a place close to the way. It is hardened by the traffic of the way; thus, 
                it is difficult for the seeds to penetrate it. The wayside signifies the heart that is hardened by 
                worldly traffic and cannot open to understand, to comprehend, the word of the kingdom. <span class="crnrstn_cite_lee">- w. lee.</span><div class="cb_10"></div>
                <div class="cb_20"></div>';

            break;
            case 'matt24_15-22':

                $tmp_footnote_array['REFERENCE'][0] = '24:15<span class="script_sup">1</span>';
                $tmp_footnote_array['COPY'][0]      = '<a id="ftnt_1"></a>
                In its literal application, &quot;him&quot; refers to or is the Lord speaking to a Christian 
                brother, prophet of Jehovah, and slave of our Lord Jesus Christ from Atlanta, Georgia, USA who is 
                currently residing in the metro-atlanta area. The 43 years old Jonathan Paul Harris (a.k.a. \'5\', 
                \'J5\', or \'jony5\', pronounced as "Johnny Five") serving the Lord before both God and man at the 
                end of this age to faithfully and openly bear this testimony of the gospel of the kingdom before the 
                whole inhabited earth (Matt. 24:14) is spoken to by the Lord here.

                ' . $tmp_top_lnk_html . '
                <div class="cb_10"></div>
                This brother is the specific saint to whom the Holy Spirit is directing this word of Scripture to 
                cause this one to bear the responsibility of drawing out interpretation of prophecy and application 
                of the same in order to signal the close of the age. More importantly...or more interestingly,...the 
                vessel of this saint is the precise location for the application of the temple or Holy Place in the 
                prophecy that the same brother is here responsible for interpreting. Our brothers Daniel the prophet 
                (Dan 9) and Jesus the Prophet (Matt 24) were not talking about sacrifice ceasing in a physical 
                building in Jerusalem rebuilt by the Jewish people at the end of the age. But He spoke of the 
                temple of His body (John 2:21).

                ' . $tmp_top_lnk_html . '
                <div class="cb_10"></div>
                The prophecy of sacrifice ceasing in the Holy Place when viewed through the lens of God\'s New 
                Testament economy and honoring everything the Lord has given to His people to this day basically 
                implies as clear as day that in the midst of slanderous accusations (or abominations) cast at the 
                contents of (even the disposition of) the soul of a saint (the Holy Place), a Christian is going to 
                be persecuted dearly in their soul for it\'s enjoyment to reduce the enjoyment (or sacrifice in the 
                Holy Place) down to nothing. See more on the sacrifice ceasing in ' . $this->link_html('dan9_17-27', 'Dan. 9:17-27, note 1') . '. 
                But...just a grain of salt,...this may all seem so obvious to me simply because of where I am 
                sitting.

                ' . $tmp_top_lnk_html . '
                <div class="cb_10"></div>
                For a duration of +10 years (Q4 2011 &ndash;&ndash; Jan. 10, 2023 0926 hrs) now the desolation 
                has been trampling the outer court and causing the sacrifice to cease in the temple...the 
                body...of a particular saint,...the messenger to the church in Philadelphia. Death to the soul life 
                for this length of time makes the fulfillment of this prophecy in Dan 9 and Matt 24 to be borne in 
                the Spirit of martyrdom in full and proper measure (Rev. 2:10-11).
                ' . $tmp_top_lnk_html . '
                <div class="cb_10"></div>
                And in fact, there may be many other saints also bearing the testimony of martyrdom under this +10 
                years running prophetic fulfillment of the desolation spoken of by Daniel the prophet.
                ' . $tmp_top_lnk_html . '
                <div class="cb_10"></div>
                For more on the abomination of desolation spoken of here in Matt 24 and the fulfillment of the 
                prophecies concerning both the ceasing of the sacrifice and the abominations of the desolator setup 
                in the Holy Place, see ' . $this->link_html('dan9_17-27', 'Dan. 9:17-27, note 1') . '. 
                See ' . $this->link_html('rev3_7-13', 'Note 1 on Rev. 3:7-13') . ' for more on the 
                messenger to the church in Philadelphia.<div class="cb_10"></div>
                <div class="cb_20"></div>';

            break;
            case 'john8_1-11':

                $tmp_footnote_array['REFERENCE'][0] = '8:6<span class="script_sup">1</span>';
                $tmp_footnote_array['COPY'][0]      = '<a id="ftnt_1"></a>
                While the Holy Spirit sealed (or kept as a secret) the word of the Lord written in the dirt upon the 
                ground here before the adulterous woman, before her accusers, and before the writer of this book of 
                gospel, there is yet clear scriptural record of this hidden truth spoken openly by the Lord in His 
                earthly ministry. 

                <div class="cb_10"></div>
                This truth was able to muzzle the mouths of the accusing and unbelieving Jews in the days of our Lord, 
                and this...now unsealed...speaking will have the same affect upon the unbelieving, the finger pointing, 
                and the beating-their-fellow-slaves-and-drunk-with-the-blood-of-the-saints Christians today in 2023.

                <div class="cb_10"></div>
                What Jesus wrote upon the ground would have aligned very closely to the word spoken by the Lord 
                (recorded in scripture) later in the gospel of John. 

                <div class="cb_10"></div>
                According to the word of the Lord in John 9:39-41, if a saint sees sin in another (or in themselves!), 
                this is equal to that saint (the accuser) still having that sin; I.e. an accuser is not forgiven by God 
                of any sin they see in themselves or another. This is the deceitfulness of sin&ndash;&ndash; 

                <div class="cb_10"></div>
                Therefore, those bringing accusation against the adulterous woman here in John 8...they still had their 
                sin; they made it very clear that they saw sin in their Hebrew sister. And because the accusers still 
                had their sin, they were not qualified to throw a single stone at the woman...as the Lord said when He 
                stood up. &quot;He who is without sin among you, let him be the first to throw a stone at her.&quot;

                <div class="cb_10"></div>
                Only the Lord Jesus, who saw no sin in the woman, was qualified to throw a stone at the woman, and the 
                scriptural record indicates that the Lord did not condemn her to death. Neither will our heavenly Master 
                condemn us, dear saints; His burden is easy, and His yoke<br>is light.

                <div class="cb_10"></div>Furthermore, the woman was told to &quot;go, and from now on sin no more.&quot; 
                This was a command from the king of kings for the believing woman to simply live out her life...to 
                simply honor the desires (the good pleasures) of her heart, to simply fear nothing, and...most 
                importantly...to simply see no sin in herself! 

                <div class="cb_10"></div>
                This woman walked out of the presence of the Lord as a believing Christian living in simplicity 
                according to the two (2) pillars! All things are lawful; honor the good pleasures of your heart as 
                commandment from God.

                <div class="cb_10"></div>
                This adulterous woman will be fucking forever...unlike most of the saints whose carcasses fell in the 
                wilderness as they wandered aimlessly for forty years. According to the Bible, most Christians<br>(1 
                Cor. 10:5) will be made to be as eunuchs from God for the healing of the nations; most of the Christians 
                will live forever in the kingdom of God as such...eunuchs who heal the basic and natural humans that are 
                allowed live in the kingdom of God and which said humans comprise the totality of all the nations living 
                in God\'s earthly kingdom for all eternity.

                <div class="cb_10"></div>
                This is the truth of the Gospel; this is the two (2) pillars.

                <div class="cb_10"></div>
                When a Christian points a finger and makes accusation against another or even against themselves (a 
                house divided), that accusing saint still has their sin, and they will die in that sin when they stand 
                before the Lord at His judgement seat. For with what judgement you judge, you shall be judged by God, 
                and in what you judge another, you condemn yourself...to death.

                <div class="cb_10"></div>
                On a slightly more positive note, the scriptures hold record elsewhere of another woman &quot;caught in 
                promiscuity&quot;, and yet with very different results. In this other scene, the &quot;adulterous&quot; 
                woman does not find herself surrounded by those with a thirst for the bloodshed of the saints (Rev. 
                17:6; 16:5-6; 18:23-24), does not find herself surrounded by those like the self righteous and 
                unbelieving scribes and Pharisees who live as if their conscience is branded as with a hot iron (1 Tim. 
                4:2-3), and does not find herself surrounded by the unrighteous who only see trespasses and sins in 
                their brethren (John 9:41). The &quot;adulterous&quot; woman in this other scene is shepherded unto life 
                and much blessing (Luke 1:42-55) by<br>the righteous.

                <div class="cb_10"></div>
                When a Hebrew sister named Mary was found to be with child before she had come together with her 
                husband, Joseph (Matt. 1:18), her husband did not drag her out by the hair and to the synagogue or to 
                the temple in Jerusalem for judgement before the high priest and also for the subsequent stoning. 
                Instead, Joseph sought to send his wife away in secret to thus spare her any public shame, spare her any 
                additional embarrassment, and of course spare her from the judgement of death. 

                <div class="cb_10"></div>
                Today in 2023, unfaithful spouses are shamefully and openly crucified with all fanfare and celebrity by 
                Christians as standard issue, and the kings of the earth (human governments) get rich (Rev. 17:2; 
                18:3, 9) taking their money. This is a Babylonian business model that is permeated through and through 
                with Asherah idol sacrifice (savage appreciation of fairytale white dress marriage ceremony). This is a 
                business model that is powered by fornication (marriage contract violators are 
                expected...even taught...to feel bad (Rev. 2:14, 20, 24)). And this is a business model that is promoted 
                by Catholicism along with her many daughters. 

                <div class="cb_10"></div>
                The king of kings has judged this satanic system in its entirety, and He is returning soon (Matt. 
                24:15-22) in order to miserably kill all of these demonically influenced (Isa. 14:21-23; 1 Cor. 
                10:19-20; 1 Tim. 4:1-5; Rev. 9:20-21; 18:2-3) and murderous people of Babylon with the sword of His 
                mouth and to burn their city (Matt. 21:40-41; Luke 19:15, 27; Rev. 2:16; 19:15, 21; Matt. 22:7) to 
                the ground.

                <div class="cb_10"></div>
                The New Testament...the covenant (legally binding and blood sealed contract) that Christians have with 
                Jehovah...teaches and testifies to all Christians that the manner in which Joseph sought to handle his 
                &quot;unfaithful&quot; wife, Mary, was a clear demonstration of righteousness as coming from a righteous 
                saint (Matt. 1:19). And as a righteous saint, Joseph will hence be feasting and fucking forever. Any 
                Christian that is seeking to have a testimony of righteousness before God and man will honor the 
                testimony of this husband that is recorded in the Bible with their Christian life and with a healthy 
                fear of the Lord God the Almighty presiding over their heart. 

                <div class="cb_10"></div>
                This is the testimony of the Gospel.

                <div class="cb_10"></div>
                Any Christian who expects to be fucking for all eternity surely has to do better than the unbelieving 
                scribes and Pharisees (Matt. 5:20), lest the appointment of that Christians\' portion be as with the 
                hypocrites (Matt. 24:51), as with the unbelievers (Luke 12:46). In that place[outer darkness or lake of 
                fire or the second death] there will be the weeping and the gnashing of teeth. In that place, no rest 
                will be found for the soul in waterless places (Matt. 12:43). This is because in waterless places 
                (wherever there is land), the righteous and joyfully living people...the saints and the nations...are 
                eating, drinking,...and fucking. 

                <div class="cb_10"></div>
                Observation of and longings for this wedding feast enjoyment from the position of the lake of fire will 
                trigger destruction within the souls that are under the authority of the second death. The souls of the 
                saints that are in outer darkness will face destruction when their desires for participation are 
                provoked by observation of the feasting and fucking in the 1,000 year millennium kingdom.

                <div class="cb_10"></div>
                Furthermore, it must be understood that both hell[death before the King\'s return] and the lake of 
                fire[outer darkness or the second death after the return of the King in about 5 years] are right here on 
                earth. The bodyless souls of men in these places (or rather...in these conditions of existence) are 
                invisible to the living and even to the other dead, but the dead can talk to and hear each other. They 
                have no bodies to be seen, nonetheless. So all of the dead unregenerate[not God\'s Old/New Testament 
                people] and all of the sleeping saints are right here on earth with full access to travel anywhere, to 
                see anything in their line of sight, and to hear everything from the surface of the moon, to the <a onclick=\'window.open("https://www.nasa.gov/mission_pages/station/main/index.html", "jony5BlessingsInChristTab");\' href="#" target="_blank" style="color#0066CC; text-decoration:none;">ISS</a> 
                in orbit, down to a submarine in the <a onclick=\'window.open("https://en.wikipedia.org/wiki/Mariana_Trench", "jony5BlessingsInChristTab");\' href="#" target="_blank" style="color#0066CC; text-decoration:none;">Mariana Trench</a>. 
                Understand that there are no secrets (Matt. 10:26). Every single human that has ever existed is still 
                here, and they will always be here...no...matter...what...for...all...eternity. Only God\'s people 
                amongst the living will ever have access to heaven in that day, however. Saints in outer darkness have 
                to wait 1,000 years before that can go between heaven and earth at their own will.

                <div class="cb_10"></div>
                Most Christians, the eunuchs (sons of Gehenna), will have to wait 1,000 years before they are able to 
                climb the heavenly ladder to go to heaven. The harlot and the tax collector will have been ascending and 
                descending upon the Son of Man as the heavenly ladder for 1,000 years (and starting in about 5 years) 
                by the time the workers of lawlessness (the broken cisterns which hold no water for the enjoyment of God 
                and man (Jer. 2:12-13)) gain access to heaven (Matt. 21:28-32).

                <div class="cb_10"></div>
                In hell or hades, unbelievers[not God\'s people] hunger and thirst for the satisfaction of their 
                hearts\' desires (Luke 16:24-25) according to what they can see and hear in the living. From Adam and 
                Eve until today, all of God\'s people in hell are resting in peace in Abraham\'s bosom (Luke 16:22) and 
                will be as such until the return of the King. The &quot;bosom of Abraham&quot; or &quot;Paradise&quot; 
                (Luke 23:42-43) is a condition of comfort and rest for those who have completed their course in life and 
                are chosen by God to be among God\'s people...even those chosen to live in His kingdom for all eternity.

                <div class="cb_10"></div>
                In the lake of fire, <strong>both the unbelievers</strong> (lasting for all eternity, and to start in 5 years for:<br> - the 
                tares[fake christians (Matt. 13:24-30)], <br> - the antichrist (Rev. 19:20), <br> - the false 
                prophet (Rev. 19:20), <br> - and the deceived modern-society-nations[the goats (Matt. 25:32-46)] 
                who live to see Jesus return in about 5 years; <br> - and to start in just over 1,000 years for those not 
                written in the book of life and already dead + the armies at Armageddon that Jesus will send to hell by 
                speaking (Rev. 19:21))
                <div class="cb_5"></div><strong>and the lawless Christians</strong> (lasting for 1,000 years, and 
                to start in about 5 years for most of the Christians) will all face the agony of the loss or destruction of their soul. 

                <div class="cb_10"></div>
                In the lake of fire which burns with fire and brimstone (Rev. 14:9-11), when the desires of the heart 
                are stirred up by what one can see and hear of the enjoyment of the living upon the surface of the 
                earth, the agony of the destruction (Isa. 14:21-23; 1 Cor. 5:5; 2 Cor. 3:3; Gal. 6:8; James 5:3; 
                Col. 3:5-6) of the desires of the heart comes upon the soul like a flame to the flesh. 

                <div class="cb_10"></div>
                In the kingdom of the heavens, there is an actual place, a literal Gehenna, that will begin to smoke as 
                visible indication to the saints in heaven...even to the martyrs and faithful witnesses...of the torment 
                of the souls of men (and eventually of Satan with his principalities, powers, and the demons) in the 
                lake of fire. Once started, Gehenna will always have smoke ascending from it in heaven for all eternity.

                <div class="cb_10"></div>
                Today, Jan 31, 2023 @ 0645 hrs, there is no smoke in that place, called Gehenna, in heaven. There is no 
                smoke because the lake of fire here on earth is currently empty; Soul occupancy = 0; smoke = 0. Soon, 
                Gehenna in heaven will <a onclick=\'window.open("https://www.youtube.com/watch?v=oorVWW9ywG0", "jony5BlessingsInChristTab");\' href="#" target="_blank" style="color#0066CC; text-decoration:none;">pop smoke</a>, 
                and the sons of Gehenna (Matt. 23:15)...which also includes all of the fear mongering 9/11 murderers and 
                their children appointed by God to complete destruction...will be produced by God here on earth in the 
                lake of fire. 

                <div class="cb_10"></div>
                These workers of lawlessness (Matt. 7:23; 13:40-42) who, in 2011, came into apartment #305 on Marietta 
                Street in Atlanta will comprise the most savagely FUBAR\'d segment of the population of eternal eunuchs 
                in the kingdom of the heavens ever to be produced by God our Father for the healing of the nations 
                (Rev. 22:2) for all eternity. When these saints walk into the room, everyone will know they were in my 
                apartment in 2011; everyone will know they fucked with the messeger to the church in Philadelphia 
                towards and even through the end of the age of grace in 2023; everyone will know these are the 
                Christians who picked the wrong nigger to fuck with.

                <div class="cb_10"></div>
                It is strongly indicated in scripture that all such workers may neither eat nor drink, as well; their 
                only food may be to do the will of God (John 4:31-34), and rivers of living water come forth from their 
                innermost being (John 7:38)...this may be their eternal drink. More than 50% of all Christians have been 
                appointed by God to receive this portion (1 Cor. 10:5) of wrath from God. 

                <div class="cb_10"></div>
                Furthemore and as prophesied by Jesus (Matt. 24:15), abominations coming out of the possessions of and 
                supporting the political agendas of the desolator...these same 9/11 murders...with said desolation 
                having been set to trample, set to come up against, and even set to satisfy legalities for the 
                destruction of the holy temple, and as if that\'s not enough, with set resolve to hinder all 
                priestly temple services, sacrifice (this shit is strictly personal), and oblation contained therein&ndash;&ndash;

                <div class="cb_10"></div>
                Which said holy temple...the vessel of the messenger to the church in Philadelphia (a veritable and God 
                damned muther fucking badass community college negro from the south hailing from Atlanta, GA) is 
                simultaneously being trampled and, by virtue and provocation of said trampling before the eyes of God 
                the Father, is also commanding a special portion of complete destruction from God Himself for the 
                desolator (the same fear mongering bloodshed 9/11 idiots mentioned above) and their children...as 
                prophesied by Daniel the prophet (Dan. 9:17-27). 

                <div class="cb_10"></div>
                This destruction is being stored up at this very moment and daily in 2023 for (and will be dispensed by 
                God Himself personally to ALL) of the 9/11 conspirators (and those UK bombings wankers) and their 
                spiritual children, even to the third and fourth generation (Exo. 20:5) of those who hate Jehovah. 

                <div class="cb_10"></div>
                <strong>Says the messenger, J5:</strong> <em>[earmuffs!]</em>
                <div class="cb_5"></div>
                &quot;<em>I wish these ivy league PhDs would go home, get way more people and permission to waste 
                another 12 years of the prime of my life; then come back and trample the outer court (the mortal body) 
                of my temple (soul) with both feet. I\'m most terribly bored and almost 
                certainly...no...definitely...dying slowly from boredom and lack of any current or even a forseable 
                challenge that I can use to muster up some feeling of excitement or anticipation. 

                <div class="cb_10"></div>
                I have nothing to dream about.</em>

                <div class="cb_10"></div>
                <em>All of these muppets are dumb as fuck and soft like a napkin...in summary...they\'re just a bunch of 
                academically juiced, scare mongering, story-telling pussies with nothing but organizational book smarts, 
                with old age in spades, with the Catholic Pope\'s dick repeatedly getting jammed down their throat 
                (absolutely no gagging&ndash;&ndash;), and with an around-the-clock need to have their dusty ivy league 
                PhD-umb asses wiped by this negro community college boy from Atlanta with an undergrad from state and a 
                B-minus GPA.</em>

                <div class="cb_10"></div>
                <em>Gawd dammit...where\'s my friggin\' beer!?! I can be piss freekin\' drunk 24/7/365 and still hand 
                this crowd-of-dunces-riff-raff-of-men their dusty flippin\' asses every...God...damn...muther...lovin\' 
                day!!</em>

                <div class="cb_10"></div>
                <em>...and this is all before my heavenly Master has even stepped up to the plate to have a swing at 
                these chumps. 

                <div class="cb_10"></div>
                YEAH, that\'s right, you suckers! I haven\'t even tagged my Lord and Savior Jesus Christ into the ring 
                yet, you fools! And I happen to know for a God-damned muther truckin\' fact that my heavenly Father God 
                in God-dawggit freekin\' heaven above is absolutely and positively chomping at the bit to have just one 
                round with your stuck up lil\' miss fancy pants asses. 

                <div class="cb_10"></div>
                At this point, I\'ve taken like 12 years to go to town and back on a daily basis and all over your dumb 
                ivy league asses. My God in heaven above...He only wants one day (Psa. 90:4; 2 Pet. 3:8).</em>

                <div class="cb_10"></div>
                <em>NOW GO GET WAY MORE PEOPLE SO I CAN TAG JESUS INTO THIS BITCH ON SOMETHING FRESH!! THIS OLD THING IS 
                SLOPPY AND TIRED...Well, mainly sloppy...</em>

                <div class="cb_10"></div>
                <em>p.s. - Tell your girl I said hi...Just tell her I said, hello!</em>&quot;

                <div class="cb_10"></div>
                Like a cast-out-of-body and wandering demon in Satan\'s kingdom of darkness, the saint which took the teachings 
                of demons from blind guides and then fell short of Joseph\'s testimony in caring for themself and 
                others before the Lord...the saint that fell short of a testimony borne in righteousness...that saint 
                will run like a demon to the middle of the South Pacific Ocean for their unclean spirit to brood over 
                the deep, dark, and rolling waters in order to find rest for their soul (Mark 5:7-13). In that place, 
                there will be the weeping and the gnashing of teeth for 1,000 years.

                <div class="cb_10"></div>
                <strong>The Lord\'s speaking, as recorded in John 9:39-41:</strong>

                <div class="cb_5"></div>
                And Jesus said, For judgement I have come into this world, that those who do not see may see, and that 
                those who see may<br>become blind.

                <div class="cb_10"></div>
                <em>Some</em> of the Pharisees who were with Him heard these things and said to Him, We are not blind 
                also, are we? 

                <div class="cb_10"></div>
                Jesus said to them, If you were blind, you would not have sin; but now <em>that</em> you say, We see; 
                your sin remains.

                <div class="cb_20"></div>';

            break;
            case '1cor11_4':

                $tmp_footnote_array['REFERENCE'][0] = '11:4<span class="script_sup">2</span>';
                $tmp_footnote_array['COPY'][0]      = 'Since man has the headship over woman and is God\'s image and 
                glory (1 Cor. 11:7), he should keep his head manifested, unconcealed, uncovered, when he touches the 
                throne of God\'s administration by praying to God or speaking for Him. Otherwise, he dishonors or 
                shames his head. <span class="crnrstn_cite_lee">- w. lee.</span><div class="cb_10"></div>
                <div class="cb_20"></div>';

            break;
            case 'rev3_7-13':

                //
                // rev3_7-13
                // 01/23/2022 2211 hrs :: RTM
                // And to the 1messenger of the church in Philadelphia write:
                $tmp_footnote_array['REFERENCE'][0] = 'Note <span class="script_sup">1</span>';
                $tmp_footnote_array['COPY'][0]      = '<a id="ftnt_1"></a>
                ' . $tmp_top_lnk_html . '
                The messenger of the church in Philadelphia to whom the Lord is speaking in this portion of John\'s 
                Revelation is a Christian brother, prophet of Jehovah, and slave of our Lord Jesus Christ from 
                Atlanta, Georgia, USA who is currently residing in the metro-atlanta area. The 43 years old Jonathan 
                Paul Harris (a.k.a. \'5\', \'J5\', or \'jony5\', pronounced as "Johnny Five") is serving the Lord 
                before both God and man at the end of this age to faithfully and openly bear this testimony of the 
                gospel of the kingdom before the whole inhabited earth (' . $this->link_html('matt24_14','Matt. 24:14', 'popup', 246) . '). 
                Saints, when God our heavenly Father sees fruit from this gospel preaching being borne in the 
                hearts of men throughout all the nations (i.e. the hearts of the unregenerate or non-Christian have 
                received this testimony), then the end (of the world or age) will come.<br>

                ' . $tmp_top_lnk_html . '
                <div class="cb_10"></div>
                Through a door opened by the Lord (' . $this->link_html('rev3_8','Rev. 3:8', 'popup', 246) . ') 
                in Q4 of 2011 and continuing until today, this testimony of the gospel of the kingdom is being borne 
                by the messenger of the church in Philadelphia before all of God\'s people on the earth. When this 
                word bears fruit in the hearts of the dear saints, the &quot;40 years&quot; (full measure of trials, 
                tests, and sufferings, see ' .

                $this->link_html('num14_31','Num. 14:31', 'popup', 360) . '; ' .
                $this->link_html('num32_13','32:13', 'popup', 360) . '; ' .
                $this->link_html('josh5_6','Josh. 5:6', 'popup', 360) . '; ' .
                $this->link_html('psa95_10-11','Psa. 95:10-11', 'popup', 360) . '; ' .
                $this->link_html('num14_35','Num. 14:35', 'popup', 360) . '; ' .
                $this->link_html('matt4_1-2','Matt. 4:1-2', 'popup', 360) .

                ') of God\'s people wandering in the wilderness where their corpses were being strewn along (' .

                $this->link_html('num14_29-30','Num. 14:29-30', 'popup', 295) . '; ' .
                $this->link_html('1cor10_5','1 Cor. 10:5', 'popup', 295) .

                ') on account of their unbelief in God\'s word (' . $this->link_html('heb3_7-19','Heb. 3:9-19', 'popup', 295) . ') will be over.<br> 

                ' . $tmp_top_lnk_html . '
                <div class="cb_10"></div>
                In fact and in practicality, this places the typological fulfillment of the Jordan River crossing 
                of God\'s people (' . $this->link_html('num33_50-54','Num. 33:50-54', 'popup', 295) . ') 
                as having started in Q2 of 2019 with the re-speaking (the deuteronomy) of the gospel on <a href="https://jony5.com" target="_blank">jony5.com</a> 
                where Christians were reminded of their blood-sealed and eternally binding covenant with Jehovah to 
                keep the commandments of the Lord which are written upon their very heart of flesh (' .
                $this->link_html('ezek11_17-25','Ezek. 11:17-25', 'popup', 295) . '; ' .
                $this->link_html('jer31_33-37','Jer. 31:33-37', 'popup', 295) .
                '). And yet, many of God\'s people, lacking repentance (' . $this->link_html('rev2_21-22','Rev. 2:21-22', 'popup', 295) . ') and even rejecting this 
                very revelation, will be measured by the Lord in that day, will be found by the Lord to be wanting, 
                and will have thus fallen in the wilderness (' . $this->link_html('heb4_11','Heb. 4:11', 'popup', 295) . ') due to their unbelief in God\'s word.<br>

                ' . $tmp_top_lnk_html . '
                <div class="cb_10"></div>
                A new generation of God\'s people (even the children of those who are stumbling at the stone of 
                stumbling, see ' .
                $this->link_html('num14_31[000]','Num. 14:31', 'popup', 295) . '; ' .
                $this->link_html('1pet2_7-8','1 Pet. 2:7-8', 'popup', 295) . '; ' .
                $this->link_html('rom9_31-33','Rom. 9:31-33', 'popup', 295) . '; ' .
                $this->link_html('1cor1_22-25','1 Cor. 1:23-25', 'popup', 295) .

                ') will be the generation to enter 
                into and to possess the good land, their own heart, with all boldness (' . $this->link_html('heb10_35','Heb. 10:35', 'popup', 295) . ') according to all 
                the promises of God. 

                ' . $tmp_top_lnk_html . '
                <div class="cb_10"></div>
                Saints, we are the &quot;stone become bread&quot; people...the &quot;water become wine&quot; 
                peop...no...we are the &quot;water become whiskey&quot; people! We are the &quot;stone become steamed 10 
                lb. lobster&quot; people! We are the &quot;stone become factory fresh <a onclick=\'window.open("https://www.bugatti.com/discover-chiron-pur-sport/", "jony5BlessingsInChristTab");\' href="#" target="_blank" style="color#0066CC; text-decoration:none;">Bugatti 
                Chiron PUR Sport</a>&quot; people (' . $this->link_html('john14_12-14','John 14:12-14', 'popup', 295) . ')! 
                God our Father has blessed us with every spiritual blessing in the heavenlies to the praise of the glory 
                of His grace (' . $this->link_html('eph1_3-14[000]','Eph. 1:3-14', 'popup', 295) . ').

                ' . $tmp_top_lnk_html . '
                <div class="cb_10"></div>
                This is our hope of glory laid up in the heavens (' .

                $this->link_html('col1_5','Col. 1:5', 'popup', 295) . '; ' .
                $this->link_html('col1_27','1:27', 'popup', 295) . '; ' .
                $this->link_html('1pet1_3-5','1 Pet. 1:3-5', 'popup', 295) . '; ' .
                $this->link_html('1pet1_13','1:13', 'popup', 295) . '; ' .
                $this->link_html('titus3_7','Tit. 3:7', 'popup', 295) . '; ' .
                $this->link_html('heb3_6','Heb. 3:6', 'popup', 295) . '; ' .
                $this->link_html('heb10_23','Heb. 10:23', 'popup', 295)

                . '). Jesus, our real Joshua (' . $this->link_html('heb4_8-16','Heb. 4:8-16', 'popup', 295) . '), is now leading us to enter and to 
                take the land, our heart...our eternal inheritance.

                ' . $tmp_top_lnk_html . '
                <div class="cb_10"></div>
                A saint\'s good pleasure (' .
                $this->link_html('rom12_2','Rom. 12:2', 'popup', 295) .'; ' .
                $this->link_html('phil2_13','Phil. 2:13', 'popup', 295)

                . ') to smoke a cigarette is the will of God or God\'s 
                very commandment made known to them, as a faithful slave of God and laboring priest in the temple 
                (' .
                $this->link_html('john2_21','John 2:21', 'popup', 295) .'; ' .
                $this->link_html('matt12_5','Matt. 12:5', 'popup', 295)

                . '). Since they are a Christian and are thus enslaved to God (' .

                $this->link_html('rom6_22','Rom. 6:22', 'popup', 295)

                . '), in 
                order to faithfully satisfy the blood sealed and eternally effective (' .

                $this->link_html('heb9_14','Heb. 9:14', 'popup', 295)

                . ') contract of their 
                enslavement to righteousness (' .

                $this->link_html('rom6_18-19[000]','Rom. 6:18-19', 'popup', 295)

                . '), they have no choice but to obey (' .

                $this->link_html('phil2_5-16','Phil. 2:5-16', 'popup', 295) .'; ' .
                $this->link_html('john14_15,20-21','John 14:15, 20-21', 'popup', 295)

                . ') the will of God made known to them through their recognition of what is pleasurable or 
                most delightful to their soul (' .

                $this->link_html('2cor3_3','2 Cor. 3:3', 'popup', 295) .'; ' .
                $this->link_html('heb8_10[000]','Heb. 8:10', 'popup', 295) .'; ' .
                $this->link_html('jer31_31-34','Jer. 31:31-34', 'popup', 295)

                . ') which at this very moment and in 
                this demonstration of a hope or of a spiritual blessing kept in the heavenlies ('.

                $this->link_html('eph1_3','Eph. 1:3', 'popup', 295) . '; ' .
                $this->link_html('rom5_1-5','Rom. 5:1-5', 'popup', 295) . '; ' .
                $this->link_html('rom8_16-17,24-25','8:16-17, 24-25', 'popup', 295) . '; ' .
                $this->link_html('rom15_4','15:4', 'popup', 295) . '; ' .
                $this->link_html('2cor3_12','2 Cor. 3:12', 'popup', 295) . '; ' .
                $this->link_html('gal5_5-6','Gal. 5:5-6', 'popup', 295) . '; ' .
                $this->link_html('eph1_9-14,18-23','Eph. 1:9-14, 18-23', 'popup', 295) . '; ' .
                $this->link_html('col1_5-6,21-23,26-27','Col. 1:5-6, 21-23, 26-27', 'popup', 295) . '; ' .
                $this->link_html('1thes1_2-3','1 Thes. 1:2-3', 'popup', 295) . '; ' .
                $this->link_html('1thes5_7-11','5:7-11', 'popup', 295) . '; ' .
                $this->link_html('2thes2_16-17','2 Thes. 2:16-17', 'popup', 295) . '; ' .
                $this->link_html('1tim1_1','1 Tim. 1:1', 'popup', 295) . '; ' .
                $this->link_html('1tim6_17','6:17', 'popup', 295) . '; ' .
                $this->link_html('titus1_1-3','Titus 1:1-3', 'popup', 295) . '; ' .
                $this->link_html('titus2_11-15','2:11-15', 'popup', 295) . '; ' .
                $this->link_html('titus3_7[000]','3:7', 'popup', 295) . '; ' .
                $this->link_html('heb3_6[000]','Heb 3:6', 'popup', 295) . '; ' .
                $this->link_html('heb6_17-20','6:17-20', 'popup', 295) . '; ' .
                $this->link_html('heb7_17-19','7:17-19', 'popup', 295) . '; ' .
                $this->link_html('heb10_21-23','10:21-23', 'popup', 295) . '; ' .
                $this->link_html('heb11_1','11:1', 'popup', 295) . '; ' .
                $this->link_html('1pet1_3-9,13,21','1 Pet. 1:3-9, 13, 21', 'popup', 295) . '; ' .
                $this->link_html('1pet3_5-7,14-22','3:5-7, 14-22', 'popup', 295) . '; ' .
                $this->link_html('1john3_1-10','1 John 3:1-10', 'popup', 295)

                . '), kept in Christ for this particular saint...is lighting up a cigarette. 

                ' . $tmp_top_lnk_html . '
                <div class="cb_10"></div>
                For it is God who operates in that saint (1) to make His will manifest to them and (2) to affect the 
                working out of His will in their life. This shit is always in alignment with the good pleasure 
                (' .

                $this->link_html('phil2_13[000]','Phil. 2:13', 'popup', 295)

                . ') of one\'s soul; how can one fail under such a light burden? A saint always does what 
                they want to do, and this is their &quot;law.&quot; Our heavenly Master\'s burden is easy, and His 
                yoke is light (' .

                $this->link_html('matt11_28-30','Matt. 11:28-30', 'popup', 295)

                . '). If a saint has routine &quot;failures,&quot; in daily life&ndash;&ndash;.

                ' . $tmp_top_lnk_html . '
                <div class="cb_10"></div>
                Saints, our vessel (' .

                $this->link_html('matt25_4','Matt. 25:4, lit. soul', 'popup', 295)

                . ') holds our person with its\' God created natural delights 
                (' .

                $this->link_html('phil2_13[001]','Phil. 2:13', 'popup', 295)

                . ') or what one may even call soulish pleasures, and our vessel also holds God the Father 
                in Christ the Son as the Spirit with all of Their (' .

                $this->link_html('gen1_26','Gen. 1:26', 'popup', 295)

                . ') delight and good pleasure (' .

                $this->link_html('eph1_9','Eph. 1:9', 'popup', 295)

                . '). 
                This makes the soul of the saint to be a container or vessel for a proper and tasty tea blend of the 
                person of that saint and that of their Creator, God the Almighty, whom the saint formally addresses 
                in their heart as Jesus Christ, the man. There is no need for formality, however. One can live by 
                the feeling of the Lord in their soul and never mention or even consider His<br>name...His person.

                <div class="cb_10"></div>
                As the saint considers their feelings here and there throughout the day, they are kinda just sipping 
                on this tea. If something tastes good to them, they will consider going that way; God\'s will is 
                there. If it tastes bad, they turn away; the will of God for the path they walk in life is in this, 
                too. Just believe it. Many times considerations result in or are unto enjoyment or pleasure for body 
                and/or soul. Again, if you feel good about it &ndash;&ndash;,...and if you feel bad &ndash;&ndash;. 
                The faithful slave sanctifies Christ Jesus as Lord in their heart (' .

                $this->link_html('jer24_7','Jer. 24:7', 'popup', 295) . '; ' .
                $this->link_html('1pet3_15','1 Pet. 3:15', 'popup', 295)

                . '), and then 
                they honor God\'s commandments (' .

                $this->link_html('lev26_3-13','Lev. 26:3-13', 'popup', 295) . '; ' .
                $this->link_html('deut4_1-2,39-40','Deut. 4:1-2, 39-40', 'popup', 295) . '; ' .
                $this->link_html('deut5_10,29','5:10, 29', 'popup', 295) . '; ' .
                $this->link_html('deut6_1-6,16-25','6:1-6, 16-25', 'popup', 295) . '; ' .
                $this->link_html('deut6_25','6:25', 'popup', 295) . '; ' .
                $this->link_html('deut7_9-26','7:9-26', 'popup', 295) . '; ' .
                $this->link_html('deut8_1-10','8:1-10', 'popup', 295) . '; ' .
                $this->link_html('deut11_1,8-15,22-28','11:1, 8-15, 22-28', 'popup', 295) . '; ' .
                $this->link_html('deut26_16-19','26:16-19', 'popup', 295) . '; ' .
                $this->link_html('deut28_1-14','28:1-14', 'popup', 295) . '; ' .
                $this->link_html('deut30_11-20','30:11-20', 'popup', 295) . '; ' .
                $this->link_html('exo15_26','Exo. 15:26', 'popup', 295) . '; ' .
                $this->link_html('1kings8_54-66','1 Kings 8:54-66', 'popup', 295) . '; ' .
                $this->link_html('neh1_1-11','Neh. 1:1-11', 'popup', 295)

                . ') which are written upon the very same (' .

                $this->link_html('jer31_31-37','Jer. 31:31-37', 'popup', 295)

                . '). This is what Jehovah says is to 
                &quot;love the Lord your God&quot; ('.

                $this->link_html('dan9_4','Dan. 9:4', 'popup', 295) . '; ' .
                $this->link_html('gen26_4-5','Gen. 26:4-5', 'popup', 295) . '; ' .
                $this->link_html('exo20_6','Exo. 20:6', 'popup', 295)

                . '). Can anyone guess what hatred of 
                God looks like to Jehovah? Next question...who throws away their child\'s best porno mag?

                ' . $tmp_top_lnk_html . '
                <div class="cb_10"></div>
                As a Christian, as a slave of God, there is a blood sealed contractual obligation for one to 
                honor their God created God given natural desires according to the terms of peace (' .

                $this->link_html('luke14_31-32','Luke 14:31-32', 'popup', 295)

                . '), 
                and there should also be a desire to &quot;NOT be put to shame&quot; before their Master in heaven 
                above (' .

                $this->link_html('phil1_20','Phil. 1:20', 'popup', 295)

                . ') and before so great a cloud of witnesses surrounding us (' .

                $this->link_html('heb12_1','Heb. 12:1', 'popup', 295)

                . '). Being a 
                proper slave of God will definitely make a Christian to be salty to God (' .

                $this->link_html('matt5_13','Matt. 5:13', 'popup', 295) . '; ' .
                $this->link_html('mark9_50','Mark 9:50', 'popup', 295) . '; ' .
                $this->link_html('luke14_34-35','Luke 14:34-35', 'popup', 295)

                . ')...lots of 
                flavor! In complete ignorance and with no instructions save the teaching of the Anointing, I applied 
                this truth perfectly as a young single college brother in 2003 (now Jan. 23, 2023). 

                ' . $tmp_top_lnk_html . '
                <div class="cb_10"></div>
                After 20 years of living in this truth...people, at a glance, think that I am a criminal (or a 
                rapper). Christian living during the apostolic period of church history (A.D. 33&ndash;100) left 
                many saints dead or imprisoned as criminals. So, I think I can say I am living (and am here 
                teaching) the perfect carbon copy of a pure and apostolically sourced Christian living,...with 
                exceptions being on account of maybe the internet existing and the popularity of human rights...oh 
                yeah, and we have penicillin. Hey, don\'t knock it; penicillin is the next best thing to having a 
                son of God with leaves in your midst (' .

                $this->link_html('rev22_2','Rev. 22:2', 'popup', 295)

                . ').

                ' . $tmp_top_lnk_html . '
                <div class="cb_10"></div>
                This is the truth of the Gospel which the saints guarded as a secret in the midst of those most 
                violent and pagan days (' .

                $this->link_html('matt10_16-33','Matt. 10:16-33', 'popup', 295)

                . '); this is the narrow Way that leads to life (' .

                $this->link_html('matt7_13-14','Matt. 7:13-14', 'popup', 295)

                . ').

                ' . $tmp_top_lnk_html . '
                <div class="cb_10"></div>
                This good pleasure of soul can and must be honored (' .

                $this->link_html('phil2_5-16[000]','Phil. 2:5-16', 'popup', 295)

                . '). If the heart of God should 
                &quot;feel differently&quot; on any matter, in Him is the Yes, through Him is the Amen to God (' .

                $this->link_html('2cor1_20-22','2 Cor. 1:20-22', 'popup', 295)

                . '). The slave\'s response, as being obedient, is always &quot;Amen&quot; or &quot;yes&quot; 
                to their Lord. And this is especially true when their heavenly Master says &quot;no.&quot;
                <div class="cb_10"></div>
                &quot;Amen, my Lord.&quot; 
                <div class="cb_10"></div>
                The Lord saying &quot;no&quot; always (read this as...always check 2 out of the 3) turns out to be 
                so easy, precious, and completely unpredictable. As a faithful slave of the Lord Jesus Christ, I can 
                testify that usually, I just get to do what I want to do day to day. And to secretly suffer loss of 
                enjoyment at your Masters beckoning and for your Master\'s sake&ndash;&ndash; ...well, our Lord 
                suffered loss as He faithfully walked in obedience to the Father, so the company is good if one is 
                hanging around in that place. We will follow our Master spontaneously as we consider one another in 
                love under the light of the truth of<br>the Gospel. 

                ' . $tmp_top_lnk_html . '
                <div class="cb_10"></div>
                When at the moment of choice, it is clearly realized by any faithful slave...uplifting sacrifice 
                (loss) before the eyes of the saints with all the talk of sacrifice and teaching of sacrifice is 
                useless. Teaching sacrifice (loss) does nothing but tempt the saints to deny (' .

                $this->link_html('matt26_33-35,69-75','Matt. 26:33-35, 69-75', 'popup', 295) . '; ' .
                $this->link_html('mark14_27-31,66-72','Mark 14:27-31, 66-72', 'popup', 295) . '; ' .
                $this->link_html('luke22_33-34,54-62','Luke 22:33-34, 54-62', 'popup', 295) . '; ' .
                $this->link_html('john13_37-38;18_14-27','John 13:37-38; 18:14-27', 'popup', 295)

                . ') the 
                Lord. What can the saints even do? They can only lose enjoyment when their Master says to them 
                &quot;no&quot;. What does teaching sacrifice (loss) accomplish? Rebellion. 

                ' . $tmp_top_lnk_html . '
                <div class="cb_10"></div>
                Honoring all revelation and practicality, the dominant force of understanding for the Christian 
                notion of sacrifice should strongly align with feasting and enjoyment. Overemphasizing sacrifice 
                (loss) to the saints tempts the slaves of the Lord to start playing the role of master (' .

                $this->link_html('phil2_5-8','Phil. 2:5-8', 'popup', 295)

                . ') 
                with themselves whilst randomly selecting some God created, God honored, and basically God mandated 
                pleasure of the soul to be denyed to themselves after having sent themselves on an unguided, soul, 
                searching, strain-out-the-gnat tour of duty passing through all of the high places in the good land 
                (their soul) for any frigg\'n stick or stone pillar that can be earnestly bowed down to for a sugar 
                pill demonstration to themselves of their devotion to God through suffering borne out of zeal (' .

                $this->link_html('rom10_2-3','Rom. 10:2-3', 'popup', 295) . '; ' .
                $this->link_html('gal1_14','Gal. 1:14', 'popup', 295)

                . ') but absent of revelation. With a swiftness, there should be zeal exercised unto 
                repentance (' .

                $this->link_html('rev3_19','Rev. 3:19', 'popup', 295)

                . ') in all of these situations amongst the people of the Lord.

                ' . $tmp_top_lnk_html . '
                <div class="cb_10"></div>
                When a slave of the Lord follows and honors their enjoyment of smoking a cigarette in their soul 
                moment by moment and day by day, they are walking by the Spirit (' .

                $this->link_html('gal5_16,18,22-23,25','Gal. 5:16, 18, 22-23, 25', 'popup', 295)

                . '). As laboring priest in 
                the temple of their own body (' .

                $this->link_html('john2_20-21','John 2:20-21', 'popup', 295)

                . '), they do the work of the Lord (' .

                $this->link_html('1cor15_58','1 Cor. 15:58', 'popup', 295) . '; ' .
                $this->link_html('matt10_10b','Matt. 10:10b', 'popup', 295) . '; ' .
                $this->link_html('john14_10','John 14:10', 'popup', 295) . '; ' .
                $this->link_html('rom2_6-7','Rom 2:6-7', 'popup', 295)

                . '), and they light up that cigarette...being faithful and obedient even unto 
                death...and that the death of a cigarette. Our Lord, also, was a faithful and obedient slave 
                (' .

                $this->link_html('phil2_8','Phil. 2:8', 'popup', 295)

                . ') of God.

                ' . $tmp_top_lnk_html . '
                <div class="cb_10"></div>
                Disobeying God\'s commandments (i.e. dishonoring but especially denying (' .

                $this->link_html('john13_37-38','John 13:37-38', 'popup', 295)

                . ') one\'s own 
                natural desires of the soul) can provoke the chastening of the Lord. Chastisement has various severities 
                and, absent repentance, all can lead to discipline by fire and brimstone in outer darkness. 

                ' . $tmp_top_lnk_html . '
                <div class="cb_10"></div>
                <strong>What a saint under the chastening of the Lord can look like: </strong><br>
                For example and brevity: &quot;A-B-C-X-Y-Z.&quot; = I <3 smoking cigarettes!<br><br>
                Daily Prayers:<br>
                Forgive me Jesus, I just did &quot;<em>A-B-C-X-Y-Z</em>.&quot;<br>
                Forgive me Jesus, I just did &quot;<em>A-B-C-X-Y-Z</em>&quot; again.<br>
                Forgive me Jesus, I just did &quot;<em>A-B-C-X-Y-Z</em>&quot; for the last time.<br>
                Forgive me Jesus, I just did &quot;<em>A-B-C-X-Y-Z</em>&quot;...last time...really.<br>

                ' . $tmp_top_lnk_html . '
                <div class="cb_10"></div>
                <strong>The rebellion of the saint: </strong><br>
                As a created being, the soul\'s naturally inclined sentiments of appreciation are a significant 
                factor in a saint\'s realization of the will God for them. Indeed, all of the hopes of that saint in 
                Christ will align with these their naturally created God given delights as part of the expected 
                fulfillment of all of the promises of God. If the saint can faithfully keep God\'s commandments to 
                them, which commandments are written upon their very heart, they will receive all of their hopes 
                (' .

                $this->link_html('eph1_3-12','Eph. 1:3-12', 'popup', 295) . '; ' .
                $this->link_html('rom5_1-5[000]','Rom. 5:1-5', 'popup', 295) . '; ' .
                $this->link_html('rom15_4[000]','15:4', 'popup', 295) . '; ' .
                $this->link_html('1cor9_8-11,13','1 Cor. 9:8-11, 13', 'popup', 295)

                . ') or promised blessings. Today I purchase cigarettes, tomorrow, 
                &quot;stone become cigarette&quot; (' .

                $this->link_html('john14_10-14','John 14:10-14', 'popup', 295)

                . ')!

                ' . $tmp_top_lnk_html . '
                <div class="cb_10"></div>
                Following blind guides under the influence of the teachings of Satan (' .

                $this->link_html('1tim4_1-5','1 Tim. 4:1-5', 'popup', 295) . '; ' .
                $this->link_html('rev2_12-17','Rev. 2:12-17', 'popup', 295) . '; ' .
                $this->link_html('rev2_18-23','2:18-23', 'popup', 295)

                . '), the 
                saint is taught to appreciate &quot;clean smoke free Christian living&quot;, and the saint enjoys 
                eating sacrifice at the feet of this Asherah idol with other Christians of similiar ilk. Now when 
                this saint desires to smoke a cigarette according to their God created natural desires, the 
                &quot;clean living&quot; Asherah idol with all of that saint\'s appreciation from enjoyment at 
                sacrifice are insulted. 

                ' . $tmp_top_lnk_html . '
                <div class="cb_10"></div>
                The saint has sinned in the face of their Asherah idol and the deceitfulness (' .

                $this->link_html('2thes2_8-12','2 Thes. 2:8-12', 'popup', 295) . '; ' .
                $this->link_html('heb3_7-19[000]','Heb. 3:7-19', 'popup', 295) . '; ' .
                $this->link_html('john8_1-11','John 8:1-11', 'popup', 295)

                . ') of said transgression (there is no sin) then leads their heart into 
                fornication. As the Lord wrote in the dirt, if you see sin, you have sin (' .

                $this->link_html('john8_6','John 8:6', 'popup', 295) . '; ' .
                $this->link_html('john9_41','9:41', 'popup', 295)

                . '). Something that is NOT the Holy Spirit has pricked this Christian\'s conscience, telling them that 
                they did wrong and have sinned before heaven and earth; this is spiritual fornication, and the wrath of 
                God will come (' .

                $this->link_html('col3_6','Col. 3:6', 'popup', 295)

                . ') to destroy the offending desire from the soul. The good land will vomit this 
                saint out (' .

                $this->link_html('lev18_1-5,24-28','Lev. 18:1-5, 24-28', 'popup', 295)

                . ') at the location in question and at every high place in the soul (' .

                $this->link_html('col3_5','Col. 3:5', 'popup', 295)

                . ') where the saint has setup an Asherah or (and with the highest degree of certainty) a Baal (' .

                $this->link_html('1kings18_37-40,45;19_1-18','1 Kings 18:37-40, 45; 19:1-18', 'popup', 295)

                . ').

                ' . $tmp_top_lnk_html . '
                <div class="cb_10"></div>
                If the offending (offending to the dumb idol set up in the good land, a pillar stood up at a grand vista 
                [a place with a good view] in the heart of the saint) desire of the saint is something like online 
                pornography, then the wrath of God will come as the Spirit to sweep the soul of that saint unto 
                destruction (' .

                $this->link_html('isa14_21-24','Isa. 14:21-24', 'popup', 295)

                . ') in the territory of the heart where the idol was setup...the territory that 
                lead the saint one to appreciate pornography.

                <div class="cb_10"></div>
                Therefore, in the case of certain forms of idolatry such as fornication, passion, and evil[in the eyes 
                of a pagan society] desire, discipline from God can produce an eternal eunuch (' .

                $this->link_html('matt19_12','Matt. 19:12', 'popup', 295)

                . '). The prayers 
                of the saint (above) indicate that there exists a certain delight within the soul of this Christian. The 
                saint builds regularly at this place in their soul. Then the saint destroys what they built in 
                confession (Gal. 2:18). Jesus, forgive me for doing &quot;<em>A-B-C-X-Y-Z</em>&quot; again.

                ' . $tmp_top_lnk_html . '
                <div class="cb_10"></div>The saint despises their God-given portion of the good land (their God 
                created soul), and they hate their Creator (Exo. 20:5; Deut. 5:9-10). This is what Jezebel 
                (Roman Catholicism and her many daughters) produces in God\'s people. This is rebellion.

                ' . $tmp_top_lnk_html . '
                <div class="cb_10"></div>
                <strong>The chastisement from Jehovah: </strong><br>
                In the Old Testament, the nations (Canaanites, Jebusites, Amorites, Moabites, etc. See Exo. 23:23 
                and footnotes, Recovery Version) represent different aspects of our natural life. When a saint 
                brings idolatry and fornication into the promised good land (their heart) Jehovah will cause the 
                sword from the pagan tribes in the land to rise up against them to dispossess them from off of the 
                land...to bring them into slavery or captivity. If there is no repentance and return to the good 
                land (honoring their whole heart) whilst breath is still in the lungs of that saint and before their 
                Master\'s return, the high places in their portion of the good land (soul) which kept the idols will 
                get destruction from the Spirit (Isa. 14:23; Luke 15:8-10; Col. 3:5-6) in outer darkness. 
                Effectively the saint will have gotten evicted or vomited out of their own heart in 
                the ressurection. 

                <div class="cb_10"></div>
                The commandments of God written upon the heart of this dear saint, with all of their heart\'s 
                natural or soulish delights included therein, have become the very instrument of this saint\'s 
                destruction due to their disobedience unto the Lord.

                ' . $tmp_top_lnk_html . '
                <div class="cb_10"></div>
                The saint in this example naturally likes smoking cigarettes, but then they brought idolatry into 
                their heart, and set up a pillar unto Baal at that grand vista, high place, or splendid vantage 
                point of the soul. Other high places of the soul...common Asherah and Baal worship locations in the 
                good land...are mentioned in Col. 3:5. The Baal is for the protection of some kind of appreciation 
                (Asherah) that was taught to the saint (Gen. 2:17). &quot;Feeling good&quot; about &quot;clean smoke 
                free Christian living&quot; when you smoke cigarettes is to eat idol sacrifiice at the feet of an 
                Asherah. This will result in fornication, and Catholicism teaches (Rev. 2:20) this rebellious 
                and leavened shit to Christians as if it were clean, straight, and standard issue church doctrine. 

                ' . $tmp_top_lnk_html . '
                <div class="cb_10"></div>
                As chastisement, Jehovah then allowed the saint\'s God created natural 
                (the pagan nations in the good land) desire for cigarettes to rise up against the saint provoking 
                bouts of apparent loss of self control. Many apparent &quot;transgressions&quot; (Heb. 3:13; 2 Thes. 
                2:10) against a &quot;clean smoke free Christian living&quot; false god burst forth. This uprising 
                of the saint\'s own natural desires for cigarettes also provoked many trespass offerings unto 
                Jehovah at the alter in the outer court...but offerings that were without the Holy Spirit (laver). 

                ' . $tmp_top_lnk_html . '
                <div class="cb_10"></div>
                The laboring priest must first wash in the laver before offering sacrifice at the alter. See excerpt 
                from the ' . $this->link_html('lifestudy_exo_156', 'Life Study of Exodus', 'popup', 465) . ' 
                for more fellowship on the laver in Christian experience. In the example here (cigarettes), the Holy 
                Spirit has not convicted a single soul, and the Holy Spirit has had nothing to do with any trespass 
                offering unto the Lord. It is a &quot;clean smoke free Christian living&quot; dumb idol that is 
                somehow lodging complaints. But idols don\'t speak (Psa. 38:13; Hab. 2:18; 1 Cor. 12:2). It is 
                solely the uncircumcised heart of the dear fornicating saint making the accusations. There is no 
                god, so there is actually no &quot;physical&quot; trespass. The &quot;sin&quot; here is an illusion, 
                but sacrifice for forgiveness (this is called a trespass offering) at the alter unto Jehovah without 
                the laver (Holy Spirit) is a sin unto death (Exo. 30:18-21).
                <div class="cb_20"></div>';
//
//                    $tmp_footnote_array['REFERENCE'][1] = '<span class="script_sup">2</span>';
//                    $tmp_footnote_array['COPY'][1] = '<a id="ftnt_2"></a>Hello world [note 2]. <a href="#" onclick="jony5_vv_scroll_to(\'sup_ftnt_2\');">top</a><div class="cb_10"></div>';
//
//                    $tmp_footnote_array['REFERENCE'][2] = '<span class="script_sup">3</span>';
//                    $tmp_footnote_array['COPY'][2] = '<a id="ftnt_3"></a>Hello world [note 3]. <a href="#" onclick="jony5_vv_scroll_to(\'sup_ftnt_3\');">top</a><div class="cb_10"></div>';
//
//                    $tmp_footnote_array['REFERENCE'][3] = '<span class="script_sup">4</span>';
//                    $tmp_footnote_array['COPY'][3] = '<a id="ftnt_4"></a>Hello world [note 4]. <a href="#" onclick="jony5_vv_scroll_to(\'sup_ftnt_4\');">top</a><div class="cb_10"></div>';
//
//                    $tmp_footnote_array['REFERENCE'][4] = '<span class="script_sup">5</span>';
//                    $tmp_footnote_array['COPY'][4] = '<a id="ftnt_5"></a>Hello world [note 5]. <a href="#" onclick="jony5_vv_scroll_to(\'sup_ftnt_5\');">top</a><div class="cb_10"></div>';
//
//                    $tmp_footnote_array['REFERENCE'][5] = '<span class="script_sup">6</span>';
//                    $tmp_footnote_array['COPY'][5] = '<a id="ftnt_6"></a>Hello world [note 6]. <a href="#" onclick="jony5_vv_scroll_to(\'sup_ftnt_6\');">top</a><div class="cb_10"></div>';
//
//                    $tmp_footnote_array['REFERENCE'][6] = '<span class="script_sup">7</span>';
//                    $tmp_footnote_array['COPY'][6] = '<a id="ftnt_7"></a>Hello world [note 7]. <a href="#" onclick="jony5_vv_scroll_to(\'sup_ftnt_7\');">top</a><div class="cb_10"></div>';
//
//                    $tmp_footnote_array['REFERENCE'][7] = '<span class="script_sup">8</span>';
//                    $tmp_footnote_array['COPY'][7] = '<a id="ftnt_8"></a>Hello world [note 8]. <a href="#" onclick="jony5_vv_scroll_to(\'sup_ftnt_8\');">top</a><div class="cb_10"></div>';
//
//                    $tmp_footnote_array['REFERENCE'][8] = '<span class="script_sup">9</span>';
//                    $tmp_footnote_array['COPY'][8] = '<a id="ftnt_9"></a>Hello world [note 9]. <a href="#" onclick="jony5_vv_scroll_to(\'sup_ftnt_9\');">top</a><div class="cb_10"></div>';
//
//                    $tmp_footnote_array['REFERENCE'][9] = '<span class="script_sup">10</span>';
//                    $tmp_footnote_array['COPY'][9] = '<a id="ftnt_10"></a>Hello world [note 10]. <a href="#" onclick="jony5_vv_scroll_to(\'sup_ftnt_10\');">top</a><div class="cb_10"></div>';
//
//                    $tmp_footnote_array['REFERENCE'][10] = '<span class="script_sup">11</span>';
//                    $tmp_footnote_array['COPY'][10] = '<a id="ftnt_11"></a>Hello world [note 11]. <a href="#" onclick="jony5_vv_scroll_to(\'sup_ftnt_11\');">top</a><div class="cb_10"></div>';
//
//                    $tmp_footnote_array['REFERENCE'][11] = '<span class="script_sup">12</span>';
//                    $tmp_footnote_array['COPY'][11] = '<a id="ftnt_12"></a>Hello world [note 12]. <a href="#" onclick="jony5_vv_scroll_to(\'sup_ftnt_12\');">top</a><div class="cb_10"></div>';
//
//                    $tmp_footnote_array['REFERENCE'][12] = '<span class="script_sup">13</span>';
//                    $tmp_footnote_array['COPY'][12] = '<a id="ftnt_13"></a>Hello world [note 13]. <a href="#" onclick="jony5_vv_scroll_to(\'sup_ftnt_13\');">top</a><div class="cb_10"></div>';
//
//                    $tmp_footnote_array['REFERENCE'][13] = '<span class="script_sup">14</span>';
//                    $tmp_footnote_array['COPY'][13] = '<a id="ftnt_14"></a>Hello world [note 14]. <a href="#" onclick="jony5_vv_scroll_to(\'sup_ftnt_14\');">top</a><div class="cb_10"></div>';
//
            break;
            case 'rev21_21':

                $tmp_footnote_array['REFERENCE'][0] = '21:21<span class="script_sup">3</span>';
                $tmp_footnote_array['COPY'][0]      = '<a id="ftnt_3"></a>The gates are for the entrance into the city, 
                whereas the street is for the daily walk, the daily living, in the city. The entrance into the city 
                is through Christ\'s death and resurrection, whereas the daily walk, the daily living, in the city 
                is according to the divine nature of God, signified by the street being of pure gold. After the 
                saints enter through regeneration, they must daily live and walk in God\'s divine nature as the way. 
                The divine nature of God is their pathway. <span class="crnrstn_cite_lee">- w. lee.</span><div class="cb_10"></div>';

            break;
            default:
                //
                // NOTHING TO DO HERE.

            break;

        }

        return $tmp_footnote_array;

    }

    public function return_performance_report_html(){

        $tmp_report_html = '';
        $tmp_report_html_open = '<div id="static_jony5_performance_report_return" class="hidden">';
        $tmp_report_html_close = '</div>';

        $tmp_report_html .= $this->formatBytes(self::$bytes_processed, 3) . ' of data was returned in ' . $this->wall_time() . ' seconds.';

        return $tmp_report_html_open . $tmp_report_html . $tmp_report_html_close;

    }

    public function seo_out($vv){

        //
        // WE STORE VVID SO THAT IT CAN
        // BE REVERTED BACK TO THE ORIGINAL
        // AT THE END OF SEO GENERATION.
        $tmp_vvid = $this->vvid;
        $this->vvid = $vv;

        //
        // BOOK NAME.
        $tmp_book_name = $this->return_book_preciousness();

        //
        // REFERENCE.
        $tmp_reference = $this->return_verse_preciousness();

        //
        // FOOTNOTE.
        $tmp_footnote = $this->return_footnote_preciousness();

        if(isset($tmp_footnote['REFERENCE'][0])){

            if(sizeof($tmp_footnote['REFERENCE']) > 0){

                $tmp_ftnt = $tmp_footnote['REFERENCE'][0] . ' ' . $tmp_footnote['COPY'][0];

            }else{

                $tmp_ftnt = '';

            }

        }else{

            $tmp_ftnt = '';

        }

        switch($vv){
            case 'matt5':
            case 'matt6':
            case 'matt7':

                $tmp_lbl = 'Chapter ';

            break;
            default:

                $tmp_lbl = '';

            break;

        }

        if(!isset($tmp_book_name['COPY'][0])){

            $tmp_book_name['COPY'][0] = '';

        }

        if($tmp_ftnt == ''){

            $tmp_output = $tmp_book_name['COPY'][0] . ' ' . $tmp_lbl . $tmp_reference['REFERENCE'][0] . ' - ' . $tmp_reference['COPY'][0];

        }else{

            $tmp_output = $tmp_book_name['COPY'][0] . ' ' . $tmp_reference['REFERENCE'][0] . ' - ' . $tmp_reference['COPY'][0] . ' Footnote: ' . $tmp_ftnt;

        }

        $tmp_output = $this->seo_Sanitize($tmp_output);

        $this->vvid = $tmp_vvid;

        return '<span class="hidden">' . $tmp_output . '</span>';

    }

    private function seo_Sanitize($str){

        $patterns = array();
        $patterns[0] = '<div class="cb_10"></div>';
        $patterns[1] = '<div class="cb"></div>';
        $patterns[2] = '<div';
        $patterns[3] = '</div>';

        $replacements = array();
        $replacements[0] = ' ';
        $replacements[1] = ' ';
        $replacements[2] = '<span';
        $replacements[3] = '</span>';

        $str = str_replace($patterns, $replacements, $str);

        return $str;

    }

    public function str_sanitize($str, $type){

        $patterns = array();
        $replacements = array();

        $type = strtolower($type);

        switch($type){
            case 'bible_book_name':

                $patterns[0] = ' ';
                $replacements[0] = '';

            break;
            case 'index':

                $patterns[0] = '&nbsp;';
                $patterns[1] = ')';
                $replacements[0] = ' ';
                $replacements[1] = ') ';

            break;
            case 'search_jony5_vvid_content':

                $patterns[0] = 'href="';
                $patterns[1] = 'src="';
                $patterns[2] = 'type="';
                $patterns[3] = 'controls="';
                $patterns[4] = 'style="';
                $patterns[5] = 'target="_blank"';
                $patterns[6] = 'id="';
                $patterns[7] = 'class="';
                $patterns[8] = '<audio';
                $patterns[9] = '</audio';
                $patterns[10] = '[if lt IE';
                $patterns[11] = '<![endif]-->';
                $patterns[12] = '<script>';
                $patterns[13] = '</script>';
                $patterns[14] = 'document.createElement';
                $patterns[15] = 'return false;"';
                $patterns[16] = 'onclick="launch_newwindow(';
                $patterns[17] = '<strong>';
                $patterns[18] = '</strong>';
                $patterns[19] = '<img src="https://jony5.com/common/imgs/';
                $patterns[20] = '<span class="chords"';
                $patterns[21] = '<span class="chords" style';
                $patterns[22] = '<div class="stanza_copy">';
                $patterns[23] = '<div class="script_ref_num hymn_stanza"';
                $patterns[24] = '<br>';
                $patterns[25] = '<div class="cb_10"></div>';
                $patterns[26] = '</div>';
                $patterns[27] = '</span>';
                $patterns[28] = '
';
                $patterns[29] = '"';
                $patterns[30] = '=';
                $patterns[31] = '{';
                $patterns[32] = '}';
                $patterns[33] = '(';
                $patterns[34] = ')';
                $patterns[35] = '[';
                $patterns[36] = ']';
                $patterns[37] = ' ';
                $patterns[38] = '	';
                $patterns[39] = ',';
                $patterns[40] = '.';
                $patterns[41] = '\n';
                $patterns[42] = '\r';
                $patterns[43] = '\'';
                $patterns[44] = '/';
                $patterns[45] = '#';
                $patterns[46] = ':';
                $patterns[47] = '>';
                $patterns[48] = '<';
                $patterns[49] = '-';
                $patterns[50] = '+';
                $patterns[51] = '^';
                $patterns[52] = '%';
                $patterns[53] = '$';
                $patterns[54] = '@';
                $patterns[55] = '!';
                $patterns[56] = '?';
                $patterns[57] = '~';
                $patterns[58] = '`';
                $patterns[59] = ';';
                $patterns[60] = '|';
                $patterns[61] = '\\';
                $patterns[62] = '\n\r';
                $patterns[63] = 'tmp_search_meta_www_ARRAYarrayarraySEARCH_CONTENT';

                $replacements[0] = '';
                $replacements[1] = '';
                $replacements[2] = '';
                $replacements[3] = '';
                $replacements[4] = '';
                $replacements[5] = '';
                $replacements[6] = '';
                $replacements[7] = '';
                $replacements[8] = '';
                $replacements[9] = '';
                $replacements[10] = '';
                $replacements[11] = '';
                $replacements[12] = '';
                $replacements[13] = '';
                $replacements[14] = '';
                $replacements[15] = '';
                $replacements[16] = '';
                $replacements[17] = '';
                $replacements[18] = '';
                $replacements[19] = '';
                $replacements[20] = '';
                $replacements[21] = '';
                $replacements[22] = '';
                $replacements[23] = '';
                $replacements[24] = '';
                $replacements[25] = '';
                $replacements[26] = '';
                $replacements[27] = '';
                $replacements[28] = '';
                $replacements[29] = '';
                $replacements[30] = '';
                $replacements[31] = '';
                $replacements[32] = '';
                $replacements[33] = '';
                $replacements[34] = '';
                $replacements[35] = '';
                $replacements[36] = '';
                $replacements[37] = '';
                $replacements[38] = '';
                $replacements[39] = '';
                $replacements[40] = '';
                $replacements[41] = '';
                $replacements[42] = '';
                $replacements[43] = '';
                $replacements[44] = '';
                $replacements[45] = '';
                $replacements[46] = '';
                $replacements[47] = '';
                $replacements[48] = '';
                $replacements[49] = '';
                $replacements[50] = '';
                $replacements[51] = '';
                $replacements[52] = '';
                $replacements[53] = '';
                $replacements[54] = '';
                $replacements[55] = '';
                $replacements[56] = '';
                $replacements[57] = '';
                $replacements[58] = '';
                $replacements[59] = '';
                $replacements[60] = '';
                $replacements[61] = '';
                $replacements[62] = '';
                $replacements[63] = '';

            break;
            case 'search':

                $patterns[0] = "
";
                $patterns[1] = '"';
                $patterns[2] = '=';
                $patterns[3] = '{';
                $patterns[4] = '}';
                $patterns[5] = '(';
                $patterns[6] = ')';
                $patterns[7] = ' ';
                $patterns[8] = '	';
                $patterns[9] = ',';
                $patterns[10] = '\n';
                $patterns[11] = '\r';
                $patterns[12] = '\'';
                $patterns[13] = '/';
                $patterns[14] = '#';
                $patterns[15] = ';';
                $patterns[16] = ':';
                //$patterns[17] = '>';

                $replacements[0] = '';
                $replacements[1] = '';
                $replacements[2] = '';
                $replacements[3] = '';
                $replacements[4] = '';
                $replacements[5] = '';
                $replacements[6] = '';
                $replacements[7] = '';
                $replacements[8] = '';
                $replacements[9] = '';
                $replacements[10] = '';
                $replacements[11] = '';
                $replacements[12] = '';
                $replacements[13] = '';
                $replacements[14] = '';
                $replacements[15] = '';
                $replacements[16] = '';
                //$replacements[17] = '';

            break;
            case 'email_private':

                $tmp_new_post_at_ARRAY = array();
                $clean_str = '';
                $last_dot_flag = false;
                $tmp_at_split_ARRAY = explode('@', $str);
                $tmp_post_at_len = strlen($tmp_at_split_ARRAY[1]);
                $tmp_str_ARRAY = $this->str_split_unicode($str);
                $tmp_post_at_str_ARRAY = $this->str_split_unicode($tmp_at_split_ARRAY[1]);
                $tmp_post_at_str_rev_ARRAY = array_reverse($tmp_post_at_str_ARRAY);

                //
                // PREP POST @ SITUATION
                for($i = 0; $i < $tmp_post_at_len; $i++){

                    if(!$last_dot_flag){

                        if($tmp_post_at_str_rev_ARRAY[$i] == '.'){

                            $last_dot_flag = true;

                        }

                        $tmp_new_post_at_ARRAY[] = $tmp_post_at_str_rev_ARRAY[$i];

                        if($last_dot_flag){

                            $i = $tmp_post_at_len + 420;
                            $tmp_new_post_at_ARRAY = array_reverse($tmp_new_post_at_ARRAY);

                        }

                    }

                }

                $tmp_str_len = sizeof($tmp_str_ARRAY);
                for($i = 0; $i < $tmp_str_len; $i++){

                    if($i == 0){

                        $clean_str .= $tmp_str_ARRAY[$i] . '*****';

                    }else{

                        if($tmp_str_ARRAY[$i] == '@'){

                            $at_flag = true;
                            $tmp_plus_one = $i + 1;
                            $clean_str .= $tmp_str_ARRAY[$i] . $tmp_str_ARRAY[$tmp_plus_one] . '*****';
                            $clean_str .= implode($tmp_new_post_at_ARRAY);
                            $i = $tmp_str_len + 420;

                        }

                    }

                }

                return $clean_str;

            break;
            case 'http_protocol_simple':

                $patterns[0] = '_';
                $patterns[1] = '$';
                $patterns[2] = ' ';
                $replacements[0] = '';
                $replacements[1] = '';
                $replacements[2] = '';

            break;
            case 'max_storage_utilization':

                $patterns[0] = '%';
                $patterns[1] = 'percent';
                $patterns[2] = ' ';
                $patterns[3] = '!';

                $replacements[0] = '';
                $replacements[1] = '';
                $replacements[2] = '';
                $replacements[3] = '';

            break;
            case 'custom_mobi_detect_alg':

                $patterns[0] = '(';
                $patterns[1] = ')';
                $replacements[0] = '';
                $replacements[1] = '';

            break;
            case 'select_statement':

                $patterns[0] = "`";
                $replacements[0] = '';

            break;
            case 'select_field_name':

                $patterns[0] = "
";
                $patterns[1] = '"';
                $patterns[2] = '=';
                $patterns[3] = '{';
                $patterns[4] = '}';
                $patterns[5] = '(';
                $patterns[6] = ')';
                $patterns[7] = ' ';
                $patterns[8] = '    ';
                $patterns[9] = ',';
                $patterns[10] = '\n';
                $patterns[11] = '\r';
                $patterns[12] = '\'';
                $patterns[13] = '/';
                $patterns[14] = '#';
                $patterns[15] = ';';
                $patterns[16] = ':';
                $patterns[17] = '>';

                $replacements = array();
                $replacements[0] = '';
                $replacements[1] = '';
                $replacements[2] = '';
                $replacements[3] = '';
                $replacements[4] = '';
                $replacements[5] = '';
                $replacements[6] = '';
                $replacements[7] = '';
                $replacements[8] = '';
                $replacements[9] = '';
                $replacements[10] = '';
                $replacements[11] = '';
                $replacements[12] = '';
                $replacements[13] = '';
                $replacements[14] = '';
                $replacements[15] = '';
                $replacements[16] = '';
                $replacements[17] = '';

            break;
            default:

                return $str;

            break;

        }

        $str = str_replace($patterns, $replacements, $str);

        return $str;

    }

    //
    // SOURCE :: https://stackoverflow.com/questions/1846202/php-how-to-generate-a-random-unique-alphanumeric-string
    // COMMENT :: https://stackoverflow.com/a/13733588
    // AUTHOR :: Scott :: https://stackoverflow.com/users/1698153/scott
    public function generate_new_key($len = 32, $char_selection = NULL){

        //
        // SEND -1 AS $char_selection FOR USE OF *ALL* CHARACTERS IN RANDOM KEY
        // GENERATION...ALL EXCEPT THE SEQUENCE \e ESCAPE KEY (ESC or 0x1B (27) in
        // ASCII) AND NOT SPLITTING HAIRS CHOOSING BETWEEN SEQUENCE \n LINEFEED (LF or
        // 0x0A (10) in ASCII) AND THE SEQUENCE \r CARRIAGE RETURN (CR or 0x0D
        // (13) in ASCII)...AND ALSO SCREW BOTH \f FORM FEED (FF or 0x0C (12)
        // in ASCII) AND \v VERTICAL TAB (VT or 0x0B (11) in ASCII) SEQUENCES.
        // https://www.php.net/manual/en/language.types.string.php#language.types.string.syntax.double
        $token = "";

        if(isset($char_selection) && ($char_selection != -1) && ($char_selection != -2) && ($char_selection != -3)){

            $codeAlphabet = $char_selection;

            $max = strlen($codeAlphabet); // edited

            if(function_exists('random_int')){

                for($i = 0; $i < $len; $i++){

                    $token .= $codeAlphabet[random_int(0, $max - 1)];

                }

            }else{

                for($i = 0; $i < $len; $i++){

                    $token .= $codeAlphabet[$this->crypto_rand_secure(0, $max - 1)];

                }

            }

        }else{

            $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
            $codeAlphabet .= "abcdefghijklmnopqrstuvwxyz";
            $codeAlphabet .= "0123456789";

            if($char_selection == -1){

                $codeAlphabet .= "{}[]:;\"\'|\\+=_- )(*&^%$#@!~
                `?./><,   '";

            }

            //
            // ADDED EXCLUSION TO -2 ABOVE WHEN CHECKING FOR $char_selection
            if($char_selection == -2){

                $codeAlphabet .= "{}[]:+=_- )(*&%$#@!~?.";

            }

            //
            // ADDED EXCLUSION TO -3 ABOVE WHEN CHECKING FOR $char_selection
            if($char_selection == -3){

                $codeAlphabet .= ":+=_- )(*$#@!~.";

            }

            $max = strlen($codeAlphabet); // edited

            if(function_exists('random_int')){

                for($i = 0; $i < $len; $i++){

                    $token .= $codeAlphabet[random_int(0, $max - 1)];

                }

            }else{

                for($i = 0; $i < $len; $i++){

                    $token .= $codeAlphabet[$this->crypto_rand_secure(0, $max - 1)];

                }

            }

        }

        return $token;

    }

    //
    // SOURCE :: https://stackoverflow.com/questions/1846202/php-how-to-generate-a-random-unique-alphanumeric-string
    // COMMENT :: https://stackoverflow.com/a/13733588
    // AUTHOR :: Scott :: https://stackoverflow.com/users/1698153/scott
    private function crypto_rand_secure($min, $max){

        $range = $max - $min;
        if($range < 1) return $min; // not so random...

        $log    = ceil(log($range, 2));
        $bytes  = (int) ($log / 8) + 1; // length in bytes
        $bits   = (int) $log + 1; // length in bits
        $filter = (int) (1 << $bits) - 1; // set all lower bits to 1

        do{

            $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
            $rnd = $rnd & $filter; // discard irrelevant bits

        }while($rnd > $range);

        return $min + $rnd;

    }

    //
    // SOURCE :: https://www.php.net/manual/en/function.str-split.php
    // AUTHOR :: qeremy [atta] gmail [dotta] com :: https://www.php.net/manual/en/function.str-split.php#113274
    public function str_split_unicode($str, $length = 1){

        $tmp = preg_split('~~u', $str, -1, PREG_SPLIT_NO_EMPTY);

        if($length > 1){

            $chunks = array_chunk($tmp, $length);

            foreach($chunks as $i => $chunk){

                $chunks[$i] = join('', (array)$chunk);

            }

            $tmp = $chunks;

        }

        return $tmp;

    }

    //
    // SOURCE :: https://www.php.net/manual/en/function.rtrim.php
    // AUTHOR :: pinkgothic at gmail dot com :: https://www.php.net/manual/en/function.rtrim.php#95802
    public function strrtrim($message, $strip){

        // break message apart by strip string
        $lines = explode($strip, $message);
        $last = '';

        // pop off empty strings at the end
        do{

            $last = array_pop($lines);

        }while(empty($last) && (count($lines)));

        // re-assemble what remains
        return implode($strip, array_merge($lines, array($last)));

    }

    public function wall_time(){

        $timediff = $this->microtime_float() - $this->starttime;

        return substr($timediff, 0, -8);

    }

    /**
     * SOURCE :: NUSOAP.PHP - http://sourceforge.net/projects/nusoap/
     * returns the time in ODBC canonical form with microseconds
     *
     * @return string The time in ODBC canonical form with microseconds
     * @access public
     */
    public function microtime_float(){

        //list($usec, $sec) = explode(' ', microtime());
        //return ((float)$usec + (float)$sec);

        if(function_exists('gettimeofday')){

            $tod = gettimeofday();
            $sec = $tod['sec'];
            $usec = $tod['usec'];

        }else{

            $sec = time();
            $usec = 0;

        }

        return $sec . '.' . sprintf('%06d', $usec);

    }

    private function count_processed_bytes($data, $nerf_reporting_these_bytes = false){

        $tmp_int = 0;
        $tmp_type = gettype($data);

        switch($tmp_type){
            case 'float':
            case 'double':
                //NO CHANGE IS POSSIBLE WITHOUT DATA LOSS.
            case 'int':
            case 'integer':

                $tmp_int += self::$mbstring_func_overload ? mb_strlen((string) $data, '8bit') : strlen((string) $data);

            break;
            case 'bool':
            case 'boolean':

                $tmp_int += 8;

            break;
            case 'str':
            case 'string':

                //
                // SOURCE :: https://stackoverflow.com/questions/7568949/measure-string-size-in-bytes-in-php
                // AUTHOR :: Ulver :: https://stackoverflow.com/users/1773335/ulver
                // COMMENT :: https://stackoverflow.com/a/25299281
                //
                // Further to PhoneixS answer to get the correct length of string in bytes - Since mb_strlen()
                // is slower than strlen(), for the best performance one can check "mbstring.func_overload" ini
                // setting so that mb_strlen() is used only when it is really required:
                //
                // Thankfully, this check is no longer needed as of PHP 8.0.0. The function overloading
                // "feature" has been removed as of PHP 8.0.0, and deprecated in 7.2.0.
                // - Buttle Butkus, 2022, https://stackoverflow.com/a/7568984
                //
                // CRNRSTN :: PHP SUPPORT.
                // PHP 5 >= 5.5, PHP 6, PHP 7, PHP 8.
                $tmp_int += self::$mbstring_func_overload ? mb_strlen((string) $data, '8bit') : strlen((string) $data);

            break;
            default:

                $tmp_int += self::$mbstring_func_overload ? mb_strlen((string) serialize($data), '8bit') : strlen((string) serialize($data));

            break;

        }

        if(!($nerf_reporting_these_bytes !== false)){

            self::$bytes_processed += $tmp_int;

            return self::$bytes_processed;

        }

        return $tmp_int;

    }

    //
    // SOURCE :: https://stackoverflow.com/questions/2510434/format-bytes-to-kilobytes-megabytes-gigabytes
    // AUTHOR :: https://stackoverflow.com/users/227532/leo
    public function formatBytes($bytes, $precision = 2){

        $units = array('bytes', 'KiB', 'MiB', 'GiB', 'TiB');

        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);

        $bytes /= pow(1024, $pow);

        return round($bytes, $precision) . ' ' . $units[$pow];

    }

    public function __destruct(){

    }

}