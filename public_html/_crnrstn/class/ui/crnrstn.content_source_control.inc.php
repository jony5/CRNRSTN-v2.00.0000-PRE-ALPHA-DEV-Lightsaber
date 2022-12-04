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
#  CLASS :: crnrstn_content_source_controller
#  AUTHOR :: Jonathan 'J5' Harris, jharris@eVifweb.com
#  VERSION :: 1.00.0000
#  DATE :: May 4, 2020 @ 1620hrs
#  DESCRIPTION ::  Content source control.
class crnrstn_content_source_controller {

    private static $oLogger;
    public $oCRNRSTN;
    public $oCRNRSTN_UI_ASSEMBLER;

    public $page_path;
    public $module_key;
    private static $page_serial;

	public function __construct($oCRNRSTN, $oCRNRSTN_UI_ASSEMBLER, $module_key = NULL) {

        $this->oCRNRSTN = $oCRNRSTN;

        //
        // INSTANTIATE LOGGER
        self::$oLogger = new crnrstn_logging(__CLASS__, $this->oCRNRSTN);

        $this->oCRNRSTN_UI_ASSEMBLER = $oCRNRSTN_UI_ASSEMBLER;

        $this->page_path = $this->oCRNRSTN_UI_ASSEMBLER->return_page_path();
        $this->module_key = $module_key;

	}

	public function load_page($module_key = NULL){

	    if(isset($module_key)){

            $this->module_key = $module_key;

        }

        $return_true_str = 'This function always returns TRUE.';
        $tmp_path = '';

        try{

            switch($this->module_key){
                case 'is_mobile':

                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE');

                    //
                    // PAGE TITLE
                    $tmp_title_array = array();
                    $tmp_title_array['PAGE_TITLE'] = $this->module_key;
                    $tmp_title_array['PAGE_DESCRIPTION'] = 'Device type detection for mobile. Returns boolean TRUE on 
                    successful mobile device match. FALSE is returned for unsuccessful matches.';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial, 'PAGE_TITLE', $tmp_title_array);

                    //
                    // METHOD DEFINITION
                    $tmp_method_definition = 'is_mobile(<span class="crnrstn_documentation_method_data_type">boolean</span> $tablet_is_mobile = <span class="crnrstn_documentation_method_data_system_val">false</span>): <span class="crnrstn_documentation_method_data_type">boolean</span>';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial, 'METHOD_DEFINITION', $tmp_method_definition);

                    //
                    // RETURN VALUE
                    $tmp_str = 'Returns boolean TRUE on successful mobile match.<br><br>
                    If <span class="crnrstn_general_post_code_copy">$tablet_is_mobile = TRUE</span> and the User-Agent 
                    and HTTP headers indicate that the client is a tablet computer, TRUE will also be returned.<br><br>
                    FALSE is returned for unsuccessful matches.';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial, 'RETURN_VALUE', $tmp_str);

                    //
                    // PARAMETER DEFINITION
                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tablet_is_mobile';
                    $tmp_param_def[0]['param_definition'] = 'A boolean TRUE or FALSE.  If <span class="crnrstn_general_post_code_copy">$tablet_is_mobile = TRUE</span> 
                    and the User-Agent and HTTP headers indicate that the client is a tablet computer, TRUE will 
                    be returned.';
                    $tmp_param_def[0]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial, 'PARAMETER_DEFINITION', $tmp_param_def);

                    //
                    // EXAMPLE
                    $tmp_example_title_main = $this->oCRNRSTN->multi_lang_content_return('DOCUMENTATION_EXAMPLE_TITLE_TXT') . ' 1 ::';
                    $tmp_example_title_integrated = NULL;

                    $tmp_example_presentation_file = '/ui/docs/documentation/php/is_mobile/examples/is_mobile_show.php';
                    $tmp_example_execute_file = '/ui/docs/documentation/php/is_mobile/examples/is_mobile_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial, 'EXAMPLE_CONTENT', $tmp_example_title_main, $tmp_example_title_integrated, $tmp_example_presentation_file, $tmp_example_execute_file);

                    $tmp_str = 'This functionality stands on top of the <a href="' . $this->oCRNRSTN->return_sticky_link('http://mobiledetect.net/', 'crnrstn_documentation_mobile_detect_home') . '" target="_blank">Mobile Detect</a> 
                    project which has been fully incorporated into the HTTP Manager class of 
                    C<span class="the_R_in_crnrstn">R</span>NRSTN ::. <a href="' . $this->oCRNRSTN->return_sticky_link('http://mobiledetect.net/', 'crnrstn_documentation_mobile_detect_home2') . '" target="_blank">Mobile Detect</a> 
                    is a lightweight PHP class for detecting mobile devices (including tablets).<br><br>
                    
                    It uses the User-Agent string combined with specific HTTP headers to detect the mobile environment. 
                    <a href="' . $this->oCRNRSTN->return_sticky_link('http://mobiledetect.net/', 'crnrstn_documentation_mobile_detect_home3') . '" target="_blank">Mobile Detect</a> 
                    is sponsored by it\'s developers and community, and they send thanks to the <a href="' . $this->oCRNRSTN->return_sticky_link('https://www.jetbrains.com/', 'crnrstn_documentation_mobile_detect_jetbrains') . '" target="_blank">JetBrains</a> 
                    team for providing <a href="'.$this->oCRNRSTN->return_sticky_link('https://www.jetbrains.com/phpstorm/', 'crnrstn_documentation_mobile_detect_phpstorm') . '" target="_blank">PHPStorm</a> 
                    and <a href="'.$this->oCRNRSTN->return_sticky_link('https://www.jetbrains.com/phpstorm/', 'crnrstn_documentation_mobile_detect_datagrip') . '" target="_blank">DataGrip</a> 
                    licenses for said project.';

                    //
                    // NOTE
                    $tmp_note_array = array();
                    $tmp_note_array['NOTE_COPY'] = $tmp_str;
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial, 'NOTE', $tmp_note_array);



//                    public function is_mobile($tablet_is_mobile = false){
//
//                    public function is_tablet($mobile_is_tablet = false){
//                    public function set_desktop(){
//                    public function set_mobile(){
//                    public function set_tablet(){
//                    public function set_mobile_custom($target_device = NULL){
//                    public function is_mobile_custom($target_device = NULL){

                    //
                    // RELATED METHODS
                    $tmp_related_array = array();
                    $tmp_related_array[0] = 'is_tablet';
                    $tmp_related_array[1] = 'set_mobile';
                    $tmp_related_array[2] = 'set_tablet';
                    $tmp_related_array[3] = 'set_mobile_custom';
                    $tmp_related_array[4] = 'is_mobile_custom';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial, 'RELATED_METHODS', $tmp_related_array);

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial, 'PAGE_STATISTICS', 'STANDARD_REPORT');

                break;
                case 'is_tablet':

                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE');

                    //
                    // PAGE TITLE
                    $tmp_title_array = array();
                    $tmp_title_array['PAGE_TITLE'] = $this->module_key;
                    $tmp_title_array['PAGE_DESCRIPTION'] = 'Device type detection for tablets. Returns boolean TRUE on 
                    successful tablet match. FALSE is returned for unsuccessful matches.';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial, 'PAGE_TITLE', $tmp_title_array);

                    //
                    // METHOD DEFINITION
                    $tmp_method_definition = 'is_tablet(<span class="crnrstn_documentation_method_data_type">boolean</span> $mobile_is_tablet = <span class="crnrstn_documentation_method_data_system_val">false</span>): <span class="crnrstn_documentation_method_data_type">boolean</span>';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial, 'METHOD_DEFINITION', $tmp_method_definition);

                    //
                    // RETURN VALUE
                    $tmp_str = 'Returns boolean TRUE on successful tablet match.<br><br>
                    If <span class="crnrstn_general_post_code_copy">$mobile_is_tablet = TRUE</span> and the User-Agent 
                    and HTTP headers indicate that the client is a mobile device, TRUE will also be returned.<br><br>
                    FALSE is returned for unsuccessful matches.';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial, 'RETURN_VALUE', $tmp_str);

                    //
                    // PARAMETER DEFINITION
                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$mobile_is_tablet';
                    $tmp_param_def[0]['param_definition'] = 'A boolean TRUE or FALSE.  If <span class="crnrstn_general_post_code_copy">$mobile_is_tablet = TRUE</span> 
                    and the User-Agent and HTTP headers indicate that the client is a mobile device, TRUE will 
                    be returned.';
                    $tmp_param_def[0]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial, 'PARAMETER_DEFINITION', $tmp_param_def);

                    //
                    // EXAMPLE
                    $tmp_example_title_main = $this->oCRNRSTN->multi_lang_content_return('DOCUMENTATION_EXAMPLE_TITLE_TXT') . ' 1 ::';
                    $tmp_example_title_integrated = NULL;

                    $tmp_example_presentation_file = '/ui/docs/documentation/php/is_tablet/examples/is_tablet_show.php';
                    $tmp_example_execute_file = '/ui/docs/documentation/php/is_tablet/examples/is_tablet_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial, 'EXAMPLE_CONTENT', $tmp_example_title_main, $tmp_example_title_integrated, $tmp_example_presentation_file, $tmp_example_execute_file);

                    $tmp_str = 'This functionality stands on top of the <a href="' . $this->oCRNRSTN->return_sticky_link('http://mobiledetect.net/', 'crnrstn_documentation_mobile_detect_home') . '" target="_blank">Mobile Detect</a> 
                    project which has been fully incorporated into the HTTP Manager class of 
                    C<span class="the_R_in_crnrstn">R</span>NRSTN ::. <a href="' . $this->oCRNRSTN->return_sticky_link('http://mobiledetect.net/', 'crnrstn_documentation_mobile_detect_home2') . '" target="_blank">Mobile Detect</a> 
                    is a lightweight PHP class for detecting mobile devices (including tablets).<br><br>
                    
                    It uses the User-Agent string combined with specific HTTP headers to detect the mobile environment. 
                    <a href="' . $this->oCRNRSTN->return_sticky_link('http://mobiledetect.net/', 'crnrstn_documentation_mobile_detect_home3') . '" target="_blank">Mobile Detect</a> 
                    is sponsored by it\'s developers and community, and they send thanks to the <a href="' . $this->oCRNRSTN->return_sticky_link('https://www.jetbrains.com/', 'crnrstn_documentation_mobile_detect_jetbrains') . '" target="_blank">JetBrains</a> 
                    team for providing <a href="'.$this->oCRNRSTN->return_sticky_link('https://www.jetbrains.com/phpstorm/', 'crnrstn_documentation_mobile_detect_phpstorm') . '" target="_blank">PHPStorm</a> 
                    and <a href="'.$this->oCRNRSTN->return_sticky_link('https://www.jetbrains.com/phpstorm/', 'crnrstn_documentation_mobile_detect_datagrip') . '" target="_blank">DataGrip</a> 
                    licenses for said project.';

                    //
                    // NOTE
                    $tmp_note_array = array();
                    $tmp_note_array['NOTE_COPY'] = $tmp_str;
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial, 'NOTE', $tmp_note_array);



//                    public function is_mobile($tablet_is_mobile = false){
//
//                    public function is_tablet($mobile_is_tablet = false){
//                    public function set_desktop(){
//                    public function set_mobile(){
//                    public function set_tablet(){
//                    public function set_mobile_custom($target_device = NULL){
//                    public function is_mobile_custom($target_device = NULL){

                    //
                    // RELATED METHODS
                    $tmp_related_array = array();
                    $tmp_related_array[0] = 'is_mobile';
                    $tmp_related_array[1] = 'set_mobile';
                    $tmp_related_array[2] = 'set_tablet';
                    $tmp_related_array[3] = 'set_desktop';
                    $tmp_related_array[4] = 'set_mobile_custom';
                    $tmp_related_array[5] = 'is_mobile_custom';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial, 'RELATED_METHODS', $tmp_related_array);

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial, 'PAGE_STATISTICS', 'STANDARD_REPORT');

                break;
                case 'set_mobile':

                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE');

                    //
                    // PAGE TITLE
                    $tmp_title_array = array();
                    $tmp_title_array['PAGE_TITLE'] = $this->module_key;
                    $tmp_title_array['PAGE_DESCRIPTION'] = 'Set the device type to mobile.';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial, 'PAGE_TITLE', $tmp_title_array);

                    //
                    // METHOD DEFINITION
                    $tmp_method_definition = 'set_mobile(): <span class="crnrstn_documentation_method_data_type">boolean</span>';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial, 'METHOD_DEFINITION', $tmp_method_definition);

                    //
                    // RETURN VALUE
                    $tmp_str = 'Returns boolean TRUE.';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial, 'RETURN_VALUE', $tmp_str);

                    //
                    // EXAMPLE
                    $tmp_example_title_main = $this->oCRNRSTN->multi_lang_content_return('DOCUMENTATION_EXAMPLE_TITLE_TXT') . ' 1 ::';
                    $tmp_example_title_integrated = NULL;

                    $tmp_example_presentation_file = '/ui/docs/documentation/php/set_mobile/examples/set_mobile_show.php';
                    $tmp_example_execute_file = '/ui/docs/documentation/php/set_mobile/examples/set_mobile_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial, 'EXAMPLE_CONTENT', $tmp_example_title_main, $tmp_example_title_integrated, $tmp_example_presentation_file, $tmp_example_execute_file);

                    $tmp_str = 'This functionality stands on top of the <a href="' . $this->oCRNRSTN->return_sticky_link('http://mobiledetect.net/', 'crnrstn_documentation_mobile_detect_home') . '" target="_blank">Mobile Detect</a> 
                    project which has been fully incorporated into the HTTP Manager class of 
                    C<span class="the_R_in_crnrstn">R</span>NRSTN ::. <a href="' . $this->oCRNRSTN->return_sticky_link('http://mobiledetect.net/', 'crnrstn_documentation_mobile_detect_home2') . '" target="_blank">Mobile Detect</a> 
                    is a lightweight PHP class for detecting mobile devices (including tablets).<br><br>
                    
                    It uses the User-Agent string combined with specific HTTP headers to detect the mobile environment. 
                    <a href="' . $this->oCRNRSTN->return_sticky_link('http://mobiledetect.net/', 'crnrstn_documentation_mobile_detect_home3') . '" target="_blank">Mobile Detect</a> 
                    is sponsored by it\'s developers and community, and they send thanks to the <a href="' . $this->oCRNRSTN->return_sticky_link('https://www.jetbrains.com/', 'crnrstn_documentation_mobile_detect_jetbrains') . '" target="_blank">JetBrains</a> 
                    team for providing <a href="'.$this->oCRNRSTN->return_sticky_link('https://www.jetbrains.com/phpstorm/', 'crnrstn_documentation_mobile_detect_phpstorm') . '" target="_blank">PHPStorm</a> 
                    and <a href="'.$this->oCRNRSTN->return_sticky_link('https://www.jetbrains.com/phpstorm/', 'crnrstn_documentation_mobile_detect_datagrip') . '" target="_blank">DataGrip</a> 
                    licenses for said project.';

                    //
                    // NOTE
                    $tmp_note_array = array();
                    $tmp_note_array['NOTE_COPY'] = $tmp_str;
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial, 'NOTE', $tmp_note_array);
                    
                    //
                    // RELATED METHODS
                    $tmp_related_array = array();
                    $tmp_related_array[0] = 'is_mobile';
                    $tmp_related_array[1] = 'is_tablet';
                    $tmp_related_array[2] = 'set_tablet';
                    $tmp_related_array[3] = 'set_desktop';
                    $tmp_related_array[4] = 'set_mobile_custom';
                    $tmp_related_array[5] = 'is_mobile_custom';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial, 'RELATED_METHODS', $tmp_related_array);

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial, 'PAGE_STATISTICS', 'STANDARD_REPORT');

                break;
                case 'set_tablet':

                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE');

                    //
                    // PAGE TITLE
                    $tmp_title_array = array();
                    $tmp_title_array['PAGE_TITLE'] = $this->module_key;
                    $tmp_title_array['PAGE_DESCRIPTION'] = 'Set the device type to tablet.';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial, 'PAGE_TITLE', $tmp_title_array);

                    //
                    // METHOD DEFINITION
                    $tmp_method_definition = 'set_tablet(): <span class="crnrstn_documentation_method_data_type">boolean</span>';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial, 'METHOD_DEFINITION', $tmp_method_definition);

                    //
                    // RETURN VALUE
                    $tmp_str = 'Returns boolean TRUE.';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial, 'RETURN_VALUE', $tmp_str);

                    //
                    // EXAMPLE
                    $tmp_example_title_main = $this->oCRNRSTN->multi_lang_content_return('DOCUMENTATION_EXAMPLE_TITLE_TXT') . ' 1 ::';
                    $tmp_example_title_integrated = NULL;

                    $tmp_example_presentation_file = '/ui/docs/documentation/php/set_tablet/examples/set_tablet_show.php';
                    $tmp_example_execute_file = '/ui/docs/documentation/php/set_tablet/examples/set_tablet_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial, 'EXAMPLE_CONTENT', $tmp_example_title_main, $tmp_example_title_integrated, $tmp_example_presentation_file, $tmp_example_execute_file);

                    $tmp_str = 'This functionality stands on top of the <a href="' . $this->oCRNRSTN->return_sticky_link('http://mobiledetect.net/', 'crnrstn_documentation_mobile_detect_home') . '" target="_blank">Mobile Detect</a> 
                    project which has been fully incorporated into the HTTP Manager class of 
                    C<span class="the_R_in_crnrstn">R</span>NRSTN ::. <a href="' . $this->oCRNRSTN->return_sticky_link('http://mobiledetect.net/', 'crnrstn_documentation_mobile_detect_home2') . '" target="_blank">Mobile Detect</a> 
                    is a lightweight PHP class for detecting mobile devices (including tablets).<br><br>
                    
                    It uses the User-Agent string combined with specific HTTP headers to detect the mobile environment. 
                    <a href="' . $this->oCRNRSTN->return_sticky_link('http://mobiledetect.net/', 'crnrstn_documentation_mobile_detect_home3') . '" target="_blank">Mobile Detect</a> 
                    is sponsored by it\'s developers and community, and they send thanks to the <a href="' . $this->oCRNRSTN->return_sticky_link('https://www.jetbrains.com/', 'crnrstn_documentation_mobile_detect_jetbrains') . '" target="_blank">JetBrains</a> 
                    team for providing <a href="'.$this->oCRNRSTN->return_sticky_link('https://www.jetbrains.com/phpstorm/', 'crnrstn_documentation_mobile_detect_phpstorm') . '" target="_blank">PHPStorm</a> 
                    and <a href="'.$this->oCRNRSTN->return_sticky_link('https://www.jetbrains.com/phpstorm/', 'crnrstn_documentation_mobile_detect_datagrip') . '" target="_blank">DataGrip</a> 
                    licenses for said project.';

                    //
                    // NOTE
                    $tmp_note_array = array();
                    $tmp_note_array['NOTE_COPY'] = $tmp_str;
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial, 'NOTE', $tmp_note_array);

                    //
                    // RELATED METHODS
                    $tmp_related_array = array();
                    $tmp_related_array[0] = 'is_mobile';
                    $tmp_related_array[1] = 'is_tablet';
                    $tmp_related_array[2] = 'set_mobile';
                    $tmp_related_array[3] = 'set_desktop';
                    $tmp_related_array[4] = 'set_mobile_custom';
                    $tmp_related_array[5] = 'is_mobile_custom';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial, 'RELATED_METHODS', $tmp_related_array);

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial, 'PAGE_STATISTICS', 'STANDARD_REPORT');

                break;
                case 'set_desktop':
    
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE');
    
                    //
                    // PAGE TITLE
                    $tmp_title_array = array();
                    $tmp_title_array['PAGE_TITLE'] = $this->module_key;
                    $tmp_title_array['PAGE_DESCRIPTION'] = 'Set the device type to desktop.';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial, 'PAGE_TITLE', $tmp_title_array);
    
                    //
                    // METHOD DEFINITION
                    $tmp_method_definition = 'set_desktop(): <span class="crnrstn_documentation_method_data_type">boolean</span>';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial, 'METHOD_DEFINITION', $tmp_method_definition);
    
                    //
                    // RETURN VALUE
                    $tmp_str = 'Returns boolean TRUE.';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial, 'RETURN_VALUE', $tmp_str);

                    //
                    // EXAMPLE
                    $tmp_example_title_main = $this->oCRNRSTN->multi_lang_content_return('DOCUMENTATION_EXAMPLE_TITLE_TXT') . ' 1 ::';
                    $tmp_example_title_integrated = NULL;

                    $tmp_example_presentation_file = '/ui/docs/documentation/php/set_desktop/examples/set_desktop_show.php';
                    $tmp_example_execute_file = '/ui/docs/documentation/php/set_desktop/examples/set_desktop_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial, 'EXAMPLE_CONTENT', $tmp_example_title_main, $tmp_example_title_integrated, $tmp_example_presentation_file, $tmp_example_execute_file);

                    $tmp_str = 'This functionality stands on top of the <a href="' . $this->oCRNRSTN->return_sticky_link('http://mobiledetect.net/', 'crnrstn_documentation_mobile_detect_home') . '" target="_blank">Mobile Detect</a> 
                        project which has been fully incorporated into the HTTP Manager class of 
                        C<span class="the_R_in_crnrstn">R</span>NRSTN ::. <a href="' . $this->oCRNRSTN->return_sticky_link('http://mobiledetect.net/', 'crnrstn_documentation_mobile_detect_home2') . '" target="_blank">Mobile Detect</a> 
                        is a lightweight PHP class for detecting mobile devices (including tablets).<br><br>
                        
                        It uses the User-Agent string combined with specific HTTP headers to detect the mobile environment. 
                        <a href="' . $this->oCRNRSTN->return_sticky_link('http://mobiledetect.net/', 'crnrstn_documentation_mobile_detect_home3') . '" target="_blank">Mobile Detect</a> 
                        is sponsored by it\'s developers and community, and they send thanks to the <a href="' . $this->oCRNRSTN->return_sticky_link('https://www.jetbrains.com/', 'crnrstn_documentation_mobile_detect_jetbrains') . '" target="_blank">JetBrains</a> 
                        team for providing <a href="'.$this->oCRNRSTN->return_sticky_link('https://www.jetbrains.com/phpstorm/', 'crnrstn_documentation_mobile_detect_phpstorm') . '" target="_blank">PHPStorm</a> 
                        and <a href="'.$this->oCRNRSTN->return_sticky_link('https://www.jetbrains.com/phpstorm/', 'crnrstn_documentation_mobile_detect_datagrip') . '" target="_blank">DataGrip</a> 
                        licenses for said project.';
    
                    //
                    // NOTE
                    $tmp_note_array = array();
                    $tmp_note_array['NOTE_COPY'] = $tmp_str;
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial, 'NOTE', $tmp_note_array);
    
                    //
                    // RELATED METHODS
                    $tmp_related_array = array();
                    $tmp_related_array[0] = 'is_mobile';
                    $tmp_related_array[1] = 'is_tablet';
                    $tmp_related_array[2] = 'set_mobile';
                    $tmp_related_array[3] = 'set_tablet';
                    $tmp_related_array[4] = 'set_mobile_custom';
                    $tmp_related_array[5] = 'is_mobile_custom';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial, 'RELATED_METHODS', $tmp_related_array);
    
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial, 'PAGE_STATISTICS', 'STANDARD_REPORT');

                break;
                case 'set_mobile_custom':

                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE');

                    //
                    // PAGE TITLE
                    $tmp_title_array = array();
                    $tmp_title_array['PAGE_TITLE'] = $this->module_key;
                    $tmp_title_array['PAGE_DESCRIPTION'] = 'Force a custom device type (or magic method) profile onto a 
                    request. To perform actual device type validation, pass the same magic method parameter to <span class="crnrstn_general_post_code_copy">is_mobile_custom</span> 
                    instead.
                    <br><br>
                    Mobile Detect has a suite of over 150 <a href="' . $this->oCRNRSTN->return_sticky_link('http://demo.mobiledetect.net/', 'crnrstn_documentation_set_mobile_custom_mobile_detect_magic_method_demo00') . '" target="_blank">custom detection methods</a> 
                    (or magic methods) which can be used for a more granular approach to device detection. Designate a 
                    custom device type indication string for the client by passing the desired case-insensitive 
                    method name. ';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial, 'PAGE_TITLE', $tmp_title_array);

                    //
                    // METHOD DEFINITION
                    $tmp_method_definition = 'set_mobile_custom(<span class="crnrstn_documentation_method_data_type">string</span> $magic_method = \'<span class="crnrstn_documentation_method_string_data">isMobile</span>\'): <span class="crnrstn_documentation_method_data_type">boolean</span>';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial, 'METHOD_DEFINITION', $tmp_method_definition);

                    //
                    // RETURN VALUE
                    $tmp_str = 'Returns boolean TRUE.';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial, 'RETURN_VALUE', $tmp_str);

                    //
                    // PARAMETER DEFINITION
                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$magic_method';
                    $tmp_param_def[0]['param_definition'] = 'The name of a basic, custom, or experimental detection 
                    method. Method names can be taken from from a list of predefined suggestions 
                    on the <a href="'. $this->oCRNRSTN->return_sticky_link('http://demo.mobiledetect.net/', 'crnrstn_documentation_set_mobile_custom_magic_method_demo01') . '" target="_blank">Mobile Detect</a> 
                    website or the latest revision as of Mobile Detect v' . $this->oCRNRSTN->oCRNRSTN_ENV->oHTTP_MGR->oMOBI_DETECT->VERSION . ' 
                    can be reviewed below by scrolling down.';
                    $tmp_param_def[0]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial, 'PARAMETER_DEFINITION', $tmp_param_def);


                    $tmp_str = 'This functionality stands on top of the <a href="' . $this->oCRNRSTN->return_sticky_link('http://mobiledetect.net/', 'crnrstn_documentation_mobile_detect_home') . '" target="_blank">Mobile Detect</a> 
                    project which has been fully incorporated into the HTTP Manager class of 
                    C<span class="the_R_in_crnrstn">R</span>NRSTN ::. <a href="' . $this->oCRNRSTN->return_sticky_link('http://mobiledetect.net/', 'crnrstn_documentation_mobile_detect_home2') . '" target="_blank">Mobile Detect</a> 
                    is a lightweight PHP class for detecting mobile devices (including tablets).<br><br>
                    
                    It uses the User-Agent string combined with specific HTTP headers to detect the mobile environment. 
                    <a href="' . $this->oCRNRSTN->return_sticky_link('http://mobiledetect.net/', 'crnrstn_documentation_mobile_detect_home3') . '" target="_blank">Mobile Detect</a> 
                    is sponsored by it\'s developers and community, and they send thanks to the <a href="' . $this->oCRNRSTN->return_sticky_link('https://www.jetbrains.com/', 'crnrstn_documentation_mobile_detect_jetbrains') . '" target="_blank">JetBrains</a> 
                    team for providing <a href="'.$this->oCRNRSTN->return_sticky_link('https://www.jetbrains.com/phpstorm/', 'crnrstn_documentation_mobile_detect_phpstorm') . '" target="_blank">PHPStorm</a> 
                    and <a href="'.$this->oCRNRSTN->return_sticky_link('https://www.jetbrains.com/phpstorm/', 'crnrstn_documentation_mobile_detect_datagrip') . '" target="_blank">DataGrip</a> 
                    licenses for said project.';

                    //
                    // NOTE
                    $tmp_note_array = array();
                    $tmp_note_array['NOTE_COPY'] = $tmp_str;
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial, 'NOTE', $tmp_note_array);

                    $tmp_predefined_constants_html = '<div class="crnrstn_predefined_constant_title"><h2>Mobile Detect 
                    Magic Methods for Device Detection ::</h2></div>';
                    $tmp_predefined_constants_html .= '<div class="crnrstn_predefined_constant_title_description"><p>The 
                    magic methods below were taken from the <a href="'. $this->oCRNRSTN->return_sticky_link('http://demo.mobiledetect.net/', 'crnrstn_documentation_set_mobile_custom_demo02') . '" target="_blank">demo page</a> 
                    of the <a href="' . $this->oCRNRSTN->return_sticky_link('http://mobiledetect.net/', 'crnrstn_documentation_set_mobile_custom_mobile_detect_home') . '" target="_blank">Mobile Detect</a> 
                    website.
</p></div>';
                    $tmp_predefined_constants_html .= '<div class="crnrstn_predefined_constant_content">
';

                    // Basic methods
                    $tmp_ARRAY_basic = array('isMobile()', 'isTablet()');

                    //Custom detection methods
                    $tmp_ARRAY_custom = array('isiPhone()', 'isBlackBerry()', 'isPixel()', 'isHTC()',
                    'isNexus()', 'isDell()', 'isMotorola()', 'isSamsung()', 'isLG()', 'isSony()', 'isAsus()', 'isXiaomi()', 'isNokiaLumia()', 'isMicromax()', 'isPalm()', 'isVertu()', 'isPantech()', 'isFly()', 'isWiko()',
                    'isiMobile()', 'isSimValley()', 'isWolfgang()', 'isAlcatel()', 'isNintendo()', 'isAmoi()', 'isINQ()', 'isOnePlus()', 'isGenericPhone()', 'isiPad()', 'isNexusTablet()', 'isGoogleTablet()', 'isSamsungTablet()',
                    'isKindle()', 'isSurfaceTablet()', 'isHPTablet()', 'isAsusTablet()', 'isBlackBerryTablet()', 'isHTCtablet()',
                    'isMotorolaTablet()', 'isNookTablet()', 'isAcerTablet()', 'isToshibaTablet()', 'isLGTablet()', 'isFujitsuTablet()', 'isPrestigioTablet()', 'isLenovoTablet()',
                    'isDellTablet()', 'isXiaomiTablet()', 'isYarvikTablet()', 'isMedionTablet()', 'isArnovaTablet()', 'isIntensoTablet()', 'isIRUTablet()', 'isMegafonTablet()', 'isEbodaTablet()', 'isAllViewTablet()',
                    'isArchosTablet()', 'isAinolTablet()', 'isNokiaLumiaTablet()', 'isSonyTablet()', 'isPhilipsTablet()', 'isCubeTablet()', 'isCobyTablet()', 'isMIDTablet()',
                    'isMSITablet()', 'isSMiTTablet()', 'isRockChipTablet()', 'isFlyTablet()', 'isbqTablet()', 'isHuaweiTablet()', 'isNecTablet()',
                    'isPantechTablet()', 'isBronchoTablet()', 'isVersusTablet()', 'isZyncTablet()', 'isPositivoTablet()', 'isNabiTablet()',
                    'isKoboTablet()', 'isDanewTablet()', 'isTexetTablet()', 'isPlaystationTablet()', 'isTrekstorTablet()', 'isPyleAudioTablet()',
                    'isAdvanTablet()', 'isDanyTechTablet()', 'isGalapadTablet()', 'isMicromaxTablet()', 'isKarbonnTablet()', 'isAllFineTablet()', 'isPROSCANTablet()', 'isYONESTablet()',
                    'isChangJiaTablet()', 'isDPSTablet()', 'isVistureTablet()', 'isCrestaTablet()', 'isMediatekTablet()', 'isConcordeTablet()', 'isGoCleverTablet()', 'isModecomTablet()', 'isVoninoTablet()', 'isECSTablet()', 'isStorexTablet()',
                    'isVodafoneTablet()', 'isEssentielBTablet()', 'isRossMoorTablet()', 'isiMobileTablet()', 'isTolinoTablet()', 'isAudioSonicTablet()', 'isAMPETablet()', 'isSkkTablet()', 'isTecnoTablet()', 'isJXDTablet()',
                    'isiJoyTablet()', 'isFX2Tablet()', 'isXoroTablet()', 'isViewsonicTablet()', 'isVerizonTablet()', 'isOdysTablet()', 'isCaptivaTablet()', 'isIconbitTablet()',
                    'isTeclastTablet()', 'isOndaTablet()', 'isJaytechTablet()', 'isBlaupunktTablet()', 'isDigmaTablet()', 'isEvolioTablet()', 'isLavaTablet()', 'isAocTablet()', 'isMpmanTablet()', 'isCelkonTablet()', 'isWolderTablet()', 'isMediacomTablet()', 'isMiTablet()',
                    'isNibiruTablet()', 'isNexoTablet()', 'isLeaderTablet()', 'isUbislateTablet()', 'isPocketBookTablet()', 'isKocasoTablet()', 'isHisenseTablet()', 'isHudl()', 'isTelstraTablet()', 'isGenericTablet()', 'isAndroidOS()', 'isBlackBerryOS()',
                    'isPalmOS()', 'isSymbianOS()', 'isWindowsMobileOS()', 'isWindowsPhoneOS()', 'isiOS()', 'isiPadOS()', 'isSailfishOS()', 'isMeeGoOS()', 'isMaemoOS()',
                    'isJavaOS()', 'iswebOS()', 'isbadaOS()', 'isBREWOS()', 'isChrome()', 'isDolfin()', 'isOpera()', 'isSkyfire()', 'isEdge()', 'isIE()', 'isFirefox()', 'isBolt()', 'isTeaShark()', 'isBlazer()', 'isSafari()',
                    'isWeChat()', 'isUCBrowser()', 'isbaiduboxapp()', 'isbaidubrowser()', 'isDiigoBrowser()', 'isMercury()', 'isObigoBrowser()',
                    'isNetFront()', 'isGenericBrowser()', 'isPaleMoon()');

                    //Other tests
                    $tmp_ARRAY_other = array('isiphone()', 'isIphone()', 'istablet()', 'isIOS()', 'isWhateverYouWant()');
                    $tmp_str = '';
                    $tmp_predefined_constants_html .= '<div class="crnrstn_predefined_constant_title"><h3>Basic detection methods</h3></div>';
                    foreach($tmp_ARRAY_basic as $index => $method_name){

                        $tmp_str .= $method_name . '<br>';

                    }

                    $tmp_str = $this->oCRNRSTN->strrtrim($tmp_str, '<br>');
                    $tmp_predefined_constants_html .= '<div class="crnrstn_documentation_dyn_content_description"><p>' . $tmp_str . '</p></div>';

                    $tmp_str = '';
                    $tmp_predefined_constants_html .= '<div class="crnrstn_predefined_constant_title"><h3>Custom detection methods</h3></div>';
                    foreach($tmp_ARRAY_custom as $index => $method_name){

                        $tmp_str .= $method_name . '<br>';

                    }
                    $tmp_str = $this->oCRNRSTN->strrtrim($tmp_str, '<br>');
                    $tmp_predefined_constants_html .= '<div class="crnrstn_documentation_dyn_content_description">' . $tmp_str . '</div>';

                    $tmp_str = '';
                    $tmp_predefined_constants_html .= '<div class="crnrstn_predefined_constant_title"><h3>Other tests</h3></div>';
                    foreach($tmp_ARRAY_other as $index => $method_name){

                        $tmp_str .= $method_name . '<br>';

                    }
                    $tmp_str = $this->oCRNRSTN->strrtrim($tmp_str, '<br>');
                    $tmp_predefined_constants_html .= '<div class="crnrstn_documentation_dyn_content_description">' . $tmp_str . '</div>';

                    $tmp_predefined_constants_html .= '</div>';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial, 'GENERAL_COPY_R_STONE', $tmp_predefined_constants_html);


                    //
                    // RELATED METHODS
                    $tmp_related_array = array();
                    $tmp_related_array[0] = 'is_mobile';
                    $tmp_related_array[1] = 'is_tablet';
                    $tmp_related_array[2] = 'set_mobile';
                    $tmp_related_array[3] = 'set_tablet';
                    $tmp_related_array[4] = 'set_desktop';
                    $tmp_related_array[5] = 'is_mobile_custom';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial, 'RELATED_METHODS', $tmp_related_array);

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial, 'PAGE_STATISTICS', 'STANDARD_REPORT');

                break;
                case 'is_mobile_custom':

                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE');

                    //
                    // PAGE TITLE
                    $tmp_title_array = array();
                    $tmp_title_array['PAGE_TITLE'] = $this->module_key;
                    $tmp_title_array['PAGE_DESCRIPTION'] = 'Check for successful match of custom device type (or magic 
                    method) profile against the current User-Agent string. 
                    <br><br>
                    Mobile Detect has a suite of over 150 <a href="' . $this->oCRNRSTN->return_sticky_link('http://demo.mobiledetect.net/', 'crnrstn_documentation_is_mobile_custom_magic_method_demo00') . '" target="_blank">custom detection methods</a> 
                    (or magic methods) which can be used for a more granular approach to device detection. Designate a 
                    custom device type indication string for the client by passing the desired case-insensitive 
                    method name. A list of these methods is also below.';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial, 'PAGE_TITLE', $tmp_title_array);

                    //
                    // METHOD DEFINITION
                    $tmp_method_definition = 'is_mobile_custom(<span class="crnrstn_documentation_method_data_type">string</span> $magic_method = \'<span class="crnrstn_documentation_method_string_data">isMobile</span>\'): <span class="crnrstn_documentation_method_data_type">boolean</span>';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial, 'METHOD_DEFINITION', $tmp_method_definition);

                    //
                    // RETURN VALUE
                    $tmp_str = 'Returns boolean TRUE.';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial, 'RETURN_VALUE', $tmp_str);

                    //
                    // PARAMETER DEFINITION
                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$magic_method';
                    $tmp_param_def[0]['param_definition'] = 'The name of a basic, custom, or experimental detection 
                    method. Method names can be taken from from a list of predefined suggestions 
                    on the <a href="'. $this->oCRNRSTN->return_sticky_link('http://demo.mobiledetect.net/', 'crnrstn_documentation_is_mobile_custom_mobile_detect_magic_method_demo01') . '" target="_blank">Mobile Detect</a> 
                    website or the latest revision as of Mobile Detect v' . $this->oCRNRSTN->oCRNRSTN_ENV->oHTTP_MGR->oMOBI_DETECT->VERSION . ' 
                    can be reviewed below by scrolling down.';
                    $tmp_param_def[0]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial, 'PARAMETER_DEFINITION', $tmp_param_def);

                    $tmp_str = 'This functionality stands on top of the <a href="' . $this->oCRNRSTN->return_sticky_link('http://mobiledetect.net/', 'crnrstn_documentation_mobile_detect_home') . '" target="_blank">Mobile Detect</a> 
                    project which has been fully incorporated into the HTTP Manager class of 
                    C<span class="the_R_in_crnrstn">R</span>NRSTN ::. <a href="' . $this->oCRNRSTN->return_sticky_link('http://mobiledetect.net/', 'crnrstn_documentation_mobile_detect_home2') . '" target="_blank">Mobile Detect</a> 
                    is a lightweight PHP class for detecting mobile devices (including tablets).<br><br>
                    
                    It uses the User-Agent string combined with specific HTTP headers to detect the mobile environment. 
                    <a href="' . $this->oCRNRSTN->return_sticky_link('http://mobiledetect.net/', 'crnrstn_documentation_mobile_detect_home3') . '" target="_blank">Mobile Detect</a> 
                    is sponsored by it\'s developers and community, and they send thanks to the <a href="' . $this->oCRNRSTN->return_sticky_link('https://www.jetbrains.com/', 'crnrstn_documentation_mobile_detect_jetbrains') . '" target="_blank">JetBrains</a> 
                    team for providing <a href="'.$this->oCRNRSTN->return_sticky_link('https://www.jetbrains.com/phpstorm/', 'crnrstn_documentation_mobile_detect_phpstorm') . '" target="_blank">PHPStorm</a> 
                    and <a href="'.$this->oCRNRSTN->return_sticky_link('https://www.jetbrains.com/phpstorm/', 'crnrstn_documentation_mobile_detect_datagrip') . '" target="_blank">DataGrip</a> 
                    licenses for said project.';

                    //
                    // NOTE
                    $tmp_note_array = array();
                    $tmp_note_array['NOTE_COPY'] = $tmp_str;
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial, 'NOTE', $tmp_note_array);

                    $tmp_predefined_constants_html = '<div class="crnrstn_predefined_constant_title"><h2>Mobile Detect 
                    Magic Methods for Device Detection ::</h2></div>';
                    $tmp_predefined_constants_html .= '<div class="crnrstn_predefined_constant_title_description"><p>The 
                    magic methods below were taken from the <a href="'. $this->oCRNRSTN->return_sticky_link('http://demo.mobiledetect.net/', 'crnrstn_documentation_set_mobile_custom_mobile_detect_demo02') . '" target="_blank">demo page</a> 
                    of the <a href="' . $this->oCRNRSTN->return_sticky_link('http://mobiledetect.net/', 'crnrstn_documentation_set_mobile_custom_mobile_detect_home') . '" target="_blank">Mobile Detect</a> 
                    website.
</p></div>';
                    $tmp_predefined_constants_html .= '<div class="crnrstn_predefined_constant_content">
';

                    //
                    $tmp_ARRAY_basic = array('isMobile()', 'isTablet()');


                    //Custom detection methods
                    $tmp_ARRAY_custom = array('isiPhone()', 'isBlackBerry()', 'isPixel()', 'isHTC()',
                        'isNexus()', 'isDell()', 'isMotorola()', 'isSamsung()', 'isLG()', 'isSony()', 'isAsus()', 'isXiaomi()', 'isNokiaLumia()', 'isMicromax()', 'isPalm()', 'isVertu()', 'isPantech()', 'isFly()', 'isWiko()',
                        'isiMobile()', 'isSimValley()', 'isWolfgang()', 'isAlcatel()', 'isNintendo()', 'isAmoi()', 'isINQ()', 'isOnePlus()', 'isGenericPhone()', 'isiPad()', 'isNexusTablet()', 'isGoogleTablet()', 'isSamsungTablet()',
                        'isKindle()', 'isSurfaceTablet()', 'isHPTablet()', 'isAsusTablet()', 'isBlackBerryTablet()', 'isHTCtablet()',
                        'isMotorolaTablet()', 'isNookTablet()', 'isAcerTablet()', 'isToshibaTablet()', 'isLGTablet()', 'isFujitsuTablet()', 'isPrestigioTablet()', 'isLenovoTablet()',
                        'isDellTablet()', 'isXiaomiTablet()', 'isYarvikTablet()', 'isMedionTablet()', 'isArnovaTablet()', 'isIntensoTablet()', 'isIRUTablet()', 'isMegafonTablet()', 'isEbodaTablet()', 'isAllViewTablet()',
                        'isArchosTablet()', 'isAinolTablet()', 'isNokiaLumiaTablet()', 'isSonyTablet()', 'isPhilipsTablet()', 'isCubeTablet()', 'isCobyTablet()', 'isMIDTablet()',
                        'isMSITablet()', 'isSMiTTablet()', 'isRockChipTablet()', 'isFlyTablet()', 'isbqTablet()', 'isHuaweiTablet()', 'isNecTablet()',
                        'isPantechTablet()', 'isBronchoTablet()', 'isVersusTablet()', 'isZyncTablet()', 'isPositivoTablet()', 'isNabiTablet()',
                        'isKoboTablet()', 'isDanewTablet()', 'isTexetTablet()', 'isPlaystationTablet()', 'isTrekstorTablet()', 'isPyleAudioTablet()',
                        'isAdvanTablet()', 'isDanyTechTablet()', 'isGalapadTablet()', 'isMicromaxTablet()', 'isKarbonnTablet()', 'isAllFineTablet()', 'isPROSCANTablet()', 'isYONESTablet()',
                        'isChangJiaTablet()', 'isDPSTablet()', 'isVistureTablet()', 'isCrestaTablet()', 'isMediatekTablet()', 'isConcordeTablet()', 'isGoCleverTablet()', 'isModecomTablet()', 'isVoninoTablet()', 'isECSTablet()', 'isStorexTablet()',
                        'isVodafoneTablet()', 'isEssentielBTablet()', 'isRossMoorTablet()', 'isiMobileTablet()', 'isTolinoTablet()', 'isAudioSonicTablet()', 'isAMPETablet()', 'isSkkTablet()', 'isTecnoTablet()', 'isJXDTablet()',
                        'isiJoyTablet()', 'isFX2Tablet()', 'isXoroTablet()', 'isViewsonicTablet()', 'isVerizonTablet()', 'isOdysTablet()', 'isCaptivaTablet()', 'isIconbitTablet()',
                        'isTeclastTablet()', 'isOndaTablet()', 'isJaytechTablet()', 'isBlaupunktTablet()', 'isDigmaTablet()', 'isEvolioTablet()', 'isLavaTablet()', 'isAocTablet()', 'isMpmanTablet()', 'isCelkonTablet()', 'isWolderTablet()', 'isMediacomTablet()', 'isMiTablet()',
                        'isNibiruTablet()', 'isNexoTablet()', 'isLeaderTablet()', 'isUbislateTablet()', 'isPocketBookTablet()', 'isKocasoTablet()', 'isHisenseTablet()', 'isHudl()', 'isTelstraTablet()', 'isGenericTablet()', 'isAndroidOS()', 'isBlackBerryOS()',
                        'isPalmOS()', 'isSymbianOS()', 'isWindowsMobileOS()', 'isWindowsPhoneOS()', 'isiOS()', 'isiPadOS()', 'isSailfishOS()', 'isMeeGoOS()', 'isMaemoOS()',
                        'isJavaOS()', 'iswebOS()', 'isbadaOS()', 'isBREWOS()', 'isChrome()', 'isDolfin()', 'isOpera()', 'isSkyfire()', 'isEdge()', 'isIE()', 'isFirefox()', 'isBolt()', 'isTeaShark()', 'isBlazer()', 'isSafari()',
                        'isWeChat()', 'isUCBrowser()', 'isbaiduboxapp()', 'isbaidubrowser()', 'isDiigoBrowser()', 'isMercury()', 'isObigoBrowser()',
                        'isNetFront()', 'isGenericBrowser()', 'isPaleMoon()');

                    //Other tests
                    $tmp_ARRAY_other = array('isiphone()', 'isIphone()', 'istablet()', 'isIOS()', 'isWhateverYouWant()');

                    $tmp_predefined_constants_html .= '<div class="crnrstn_predefined_constant_title"><h3>Basic detection methods</h3></div>';
                    foreach($tmp_ARRAY_basic as $index => $method_name){

                        $tmp_predefined_constants_html .= '<div class="crnrstn_predefined_constant_demo_shell">
                        <div class="crnrstn_predefined_constant_demo_name">' . $method_name . '</div>
                        <div class="crnrstn_cb_5"></div>
                        </div>';

                    }

                    $tmp_predefined_constants_html .= '<div class="crnrstn_predefined_constant_title"><h3>Custom detection methods</h3></div>';
                    foreach($tmp_ARRAY_custom as $index => $method_name){

                        $tmp_predefined_constants_html .= '<div class="crnrstn_predefined_constant_demo_shell">
                        <div class="crnrstn_predefined_constant_demo_name">' . $method_name . '</div>
                        <div class="crnrstn_cb_5"></div>
                        </div>';

                    }

                    $tmp_predefined_constants_html .= '<div class="crnrstn_predefined_constant_title"><h3>Other tests</h3></div>';
                    foreach($tmp_ARRAY_other as $index => $method_name){

                        $tmp_predefined_constants_html .= '<div class="crnrstn_predefined_constant_demo_shell">
                        <div class="crnrstn_predefined_constant_demo_name">' . $method_name . '</div>
                        <div class="crnrstn_cb_5"></div>
                        </div>';

                    }

                    $tmp_predefined_constants_html .= '</div>';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial, 'GENERAL_COPY_R_STONE', $tmp_predefined_constants_html);


                    //
                    // RELATED METHODS
                    $tmp_related_array = array();
                    $tmp_related_array[0] = 'is_mobile';
                    $tmp_related_array[1] = 'is_tablet';
                    $tmp_related_array[2] = 'set_mobile';
                    $tmp_related_array[3] = 'set_tablet';
                    $tmp_related_array[4] = 'set_desktop';
                    $tmp_related_array[5] = 'set_mobile_custom';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial, 'RELATED_METHODS', $tmp_related_array);

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial, 'PAGE_STATISTICS', 'STANDARD_REPORT');

                break;
                case 'system_output_head_html':

                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE');

                    //
                    // PAGE TITLE
                    $tmp_title_array = array();
                    $tmp_title_array['PAGE_TITLE'] = $this->module_key;
                    $tmp_title_array['PAGE_DESCRIPTION'] = 'Output string data to be placed within the &lt;HEAD&gt; of 
                    an HTML document. Pass in TRUE to spool the requested content for output at a later time.';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial, 'PAGE_TITLE', $tmp_title_array);

                    //
                    // METHOD DEFINITION
                    $tmp_method_definition = 'system_output_head_html(<br>
                    &nbsp;&nbsp;&nbsp;<span class="crnrstn_documentation_method_data_type">string</span> $integer_constant = <span class="crnrstn_documentation_method_data_system_val">NULL</span>,<br>
                    &nbsp;&nbsp;&nbsp;<span class="crnrstn_documentation_method_data_type">boolean</span> $spool_for_output = <span class="crnrstn_documentation_method_data_system_val">false</span>,<br>
                    &nbsp;&nbsp;&nbsp;<span class="crnrstn_documentation_method_data_type">boolean</span> $footer_html_output = <span class="crnrstn_documentation_method_data_system_val">false</span>,<br>
                    &nbsp;&nbsp;&nbsp;<span class="crnrstn_documentation_method_data_type">boolean|NULL</span> $is_dev_mode = <span class="crnrstn_documentation_method_data_system_val">NULL</span><br>
                    ): <span class="crnrstn_documentation_method_data_type">string|boolean</span>';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial, 'METHOD_DEFINITION', $tmp_method_definition);

                    //
                    // RETURN VALUE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial, 'RETURN_VALUE', 'HTML OUTPUT or TRUE (if spooling).');

                    //
                    // PARAMETER DEFINITION
                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$resource_constant';
                    $tmp_param_def[0]['param_definition'] = 'An integer constant representing a resource that is 
                    being requested. A list of resource (CSS &amp; JS) constants that are currently being integrated into C<span class="the_R_in_crnrstn">R</span>NRSTN :: Lightsaber can be found below.';
                    $tmp_param_def[0]['param_required'] = false;

                    $tmp_param_def[1]['param_name'] = '$spool_for_output';
                    $tmp_param_def[1]['param_definition'] = 'Passing in FALSE will return the optional and currently 
                    requested resource as well as all previously requested (spooled) resources. All resources will 
                    be returned in the order in which they were requested.<br><br>
                    
                    When spooling is TRUE, the method will return boolean TRUE after storing the request for return at 
                    a later time.';
                    $tmp_param_def[1]['param_required'] = false;

                    $tmp_param_def[2]['param_name'] = '$footer_html_output';
                    $tmp_param_def[2]['param_definition'] = 'Passing in TRUE will cause the requested JS or CSS resource 
                    HTML output to be returned at the end of the HTML document by <span class="crnrstn_general_post_code_copy">system_output_footer_html().</span>';
                    $tmp_param_def[2]['param_required'] = false;

                    $tmp_param_def[3]['param_name'] = '$is_dev_mode';
                    $tmp_param_def[3]['param_definition'] = 'When min.js or min.css are available within the JS or CSS 
                    framework source files, passing in TRUE or FALSE will toggle the returned HTML string content 
                    between the production minimized version (e.g. simple-grid.min.css) of a framework and the 
                    development version (e.g. simple-grid.css).<br><br>
                    
                    This will override any configuration file settings that were established when calling 
                    <span class="crnrstn_general_post_code_copy">config_init_js_css_minimization().</span> Currently, if 
                    no minimized version is available, only the development version of the JS or CSS framework will be 
                    returned...and vice versa.';
                    $tmp_param_def[3]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial, 'PARAMETER_DEFINITION', $tmp_param_def);

                    //
                    // EXAMPLE
                    $tmp_example_title_main = $this->oCRNRSTN->multi_lang_content_return('DOCUMENTATION_EXAMPLE_TITLE_TXT') . ' 1 ::';
                    $tmp_example_title_integrated = NULL;

                    $tmp_example_presentation_file = '/ui/docs/documentation/php/system_output_head_html/examples/system_output_head_html_show.php';
                    $tmp_example_execute_file = ''; //'/ui/docs/documentation/php/system_output_head_html/examples/system_output_head_html_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial, 'EXAMPLE_CONTENT', $tmp_example_title_main, $tmp_example_title_integrated, $tmp_example_presentation_file, $tmp_example_execute_file);

                    //
                    // TECH SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on Ubuntu 18.04.1 LTS running Apache v2.4.29, MySQLi v5.0.12, php v7.0.33, OpenSSL v1.1.1, and NuSOAP v0.9.5.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial, 'TECH_SPECS', $tmp_spec_array);

                    $tmp_resource_profiles_ARRAY = $this->return_integer_constant_profiles($this->module_key);

                    //$this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial, 'GENERAL_COPY_NAKED', $this->oCRNRSTN->print_r_str($tmp_resource_profiles_ARRAY));

//
//                    $tmp_output_ARRAY[$resource_constant]['INTEGER'] = $resource_constant;
//                    $tmp_output_ARRAY[$resource_constant]['STRING'] = $this->oCRNRSTN->return_constant_profile_ARRAY($resource_constant, 'string');
//                    $tmp_output_ARRAY[$resource_constant]['TITLE'] = 'C<span class="the_R_in_crnrstn">R</span>NRSTN :: INTERACT UI JAVASCRIPT';
//                    $tmp_output_ARRAY[$resource_constant]['VERSION'] = '1.00.0000';
//                    $tmp_output_ARRAY[$resource_constant]['DESCRIPTION'] = '';
//                    $tmp_output_ARRAY[$resource_constant]['URL'][] = '';

                    $tmp_predefined_constants_html = '<div class="crnrstn_predefined_constant_title"><h2>Resource Constants :: CSS + JS</h2></div>';
                    $tmp_predefined_constants_html .= '<div class="crnrstn_predefined_constant_title_description"><p>The integer constants below are always available as part of the core of C<span class="the_R_in_crnrstn">R</span>NRSTN ::.
</p></div>';
                    $tmp_predefined_constants_html .= '<div class="crnrstn_predefined_constant_content">
';

                    $tmp_element_cnt = 0;

                    foreach($tmp_resource_profiles_ARRAY as $int_const => $profile_ARRAY){
                        $tmp_element_cnt++;
                        $tmp_www_link = '';
                        $tmp_inline_style = '';

                        if(isset($profile_ARRAY)){

                            if(isset($profile_ARRAY['URL'])){

                                $tmp_www_link = '';

                                foreach($profile_ARRAY['URL'] as $index => $url){

                                    $tmp_lnk = $url;

                                    if(strlen($tmp_lnk) > 0){

                                        $pos_web_archive = strpos($tmp_lnk, 'web.archive.org/');

                                        if($pos_web_archive !== false){

                                            $tmp_www_link .= '<span>' . $this->oCRNRSTN->return_sticky_media_link('INTERNET_ARCHIVE_SMALL', $tmp_lnk, '_blank') . '</span>&nbsp;&nbsp;';


                                        }else{

                                            //$tmp_www_link = '<a href="' . $this->oCRNRSTN->return_sticky_link($tmp_lnk) . '" target="_blank">website</a>';
                                            $tmp_www_link .= '<span>' . $this->oCRNRSTN->return_sticky_media_link('WWW_SMALL', $tmp_lnk, '_blank') . '</span>&nbsp;&nbsp;';

                                        }

                                    }

                                }

                            }

                        }

                        //
                        // KEEP DESCRIPTION TEXT FROM RUNNING ON TOP OF THE BACKGROUND R PILLAR GRAPHIC
                        if($tmp_element_cnt <= 5 ){

                            $tmp_inline_style =  'style="width:58%;"';

                        }

                        $tmp_browser_support_html = '';
                        if(isset($profile_ARRAY['BROWSER_COMPATIBILITY'])){

                            if(strlen($profile_ARRAY['BROWSER_COMPATIBILITY']) > 0){

                                $tmp_browser_support_html = '
                             <div class="crnrstn_resource_constant_browser_support">Supported Browsers: <span class="crnrstn_documentation_browser_compatability_nom_copy">' . $profile_ARRAY['BROWSER_COMPATIBILITY'] . '</span></div>';

                            }

                        }

                        $tmp_version = '';
                        if(isset($profile_ARRAY['VERSION'])){

                            if(strlen($profile_ARRAY['VERSION']) > 0){

                                $tmp_version = ' v' . $profile_ARRAY['VERSION'];

                            }

                        }

                        if(isset($profile_ARRAY['TITLE_DISPLAY'])){

                            $profile_ARRAY['TITLE'] = $profile_ARRAY['TITLE_DISPLAY'];

                        }

                        $tmp_predefined_constants_html .= '<div class="crnrstn_resource_constant_demo_shell">
                        <div class="crnrstn_resource_constant_nom"><span style="font-weight: normal;">' . $profile_ARRAY['INTEGER'] . '</span>&nbsp;&nbsp;&nbsp;' . $profile_ARRAY['STRING'] . '</div>                        
                        <div class="crnrstn_resource_constant_version"><p>' . $profile_ARRAY['TITLE'] . $tmp_version . '</p></div>
                        <div class="crnrstn_resource_constant_www">
                            <div class="crnrstn_resource_constant_www_source"><a href="#" target="_self" onclick="oCRNRSTN_JS.crnrstn_interact_ui_ux(\'resource_constant_view_source\', \'' . $profile_ARRAY['STRING'] . '\');" target="_self">view source</a></div>
                            <div class="crnrstn_resource_constant_www_website">' . $tmp_www_link . '</div>
                            <div class="crnrstn_cb"></div>
                        </div>' . $tmp_browser_support_html . '
                        <div class="crnrstn_cb"></div>
                        <div class="crnrstn_resource_constant_description" ' . $tmp_inline_style . '><p>' . $profile_ARRAY['DESCRIPTION'] . '</p></div>
                        <div class="crnrstn_cb_5"></div>
                        
                        </div>';

                    }

                    $tmp_predefined_constants_html .= '</div>';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial, 'GENERAL_COPY_R_STONE', $tmp_predefined_constants_html);

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial, 'PAGE_STATISTICS', 'STANDARD_REPORT');

                break;
                case 'system_output_footer_html':

                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE');

                    //
                    // PAGE TITLE
                    $tmp_title_array = array();
                    $tmp_title_array['PAGE_TITLE'] = $this->module_key;
                    $tmp_title_array['PAGE_DESCRIPTION'] = 'Output string data to be placed at the end of &lt;BODY&gt; 
                    content within an HTML document. Pass in TRUE to spool the requested content for output at a later time.';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial, 'PAGE_TITLE', $tmp_title_array);

                    //
                    // METHOD DEFINITION
                    $tmp_method_definition = 'system_output_footer_html(<br>
                    &nbsp;&nbsp;&nbsp;<span class="crnrstn_documentation_method_data_type">string</span> $resource_constant = <span class="crnrstn_documentation_method_data_system_val">NULL</span>,<br>
                    &nbsp;&nbsp;&nbsp;<span class="crnrstn_documentation_method_data_type">boolean</span> $spool_for_output = <span class="crnrstn_documentation_method_data_system_val">false</span>,<br>
                    &nbsp;&nbsp;&nbsp;<span class="crnrstn_documentation_method_data_type">boolean|NULL</span> $is_dev_mode = <span class="crnrstn_documentation_method_data_system_val">NULL</span><br>

                    ): <span class="crnrstn_documentation_method_data_type">string|boolean</span>';

                    
                    //    public function system_output_footer_html($resource_constant = NULL, $spool_for_output = false, $is_dev_mode = NULL){
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial, 'METHOD_DEFINITION', $tmp_method_definition);

                    //
                    // RETURN VALUE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial, 'RETURN_VALUE', 'HTML OUTPUT or TRUE (if spooling).');

                    //
                    // PARAMETER DEFINITION
                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$resource_constant';
                    $tmp_param_def[0]['param_definition'] = 'An integer constant representing a resource that is being requested.';
                    $tmp_param_def[0]['param_required'] = false;

                    $tmp_param_def[1]['param_name'] = '$spool_for_output';
                    $tmp_param_def[1]['param_definition'] = 'Passing in FALSE will return the optional and currently 
                    requested resource as well as all previously requested (spooled) resources. All resources will 
                    be returned in the order in which they were requested.<br><br>
                    
                    When spooling is TRUE, the method will return boolean TRUE after storing the request for return at 
                    a later time.';
                    $tmp_param_def[1]['param_required'] = false;
                    
                    $tmp_param_def[2]['param_name'] = '$is_dev_mode';
                    $tmp_param_def[2]['param_definition'] = 'When min.js or min.css are available within the JS or CSS 
                    framework source files, passing in TRUE or FALSE will toggle the returned HTML string content 
                    between the production minimized version (e.g. simple-grid.min.css) of a framework and the 
                    development version (e.g. simple-grid.css).<br><br>
                    
                    This will override any configuration file settings that were established when calling 
                    <span class="crnrstn_general_post_code_copy">config_init_js_css_minimization().</span> Currently, if 
                    no minimized version is available, only the development version of the JS or CSS framework will be 
                    returned...and vice versa.';
                    $tmp_param_def[2]['param_required'] = false;
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial, 'PARAMETER_DEFINITION', $tmp_param_def);

                    //
                    // EXAMPLE
                    $tmp_example_title_main = $this->oCRNRSTN->multi_lang_content_return('DOCUMENTATION_EXAMPLE_TITLE_TXT') . ' 1 ::';
                    $tmp_example_title_integrated = NULL;

                    $tmp_example_presentation_file = '/ui/docs/documentation/php/system_output_footer_html/examples/system_output_footer_html_show.php';
                    $tmp_example_execute_file = ''; //'/ui/docs/documentation/php/system_output_footer_html/examples/system_output_footer_html_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial, 'EXAMPLE_CONTENT', $tmp_example_title_main, $tmp_example_title_integrated, $tmp_example_presentation_file, $tmp_example_execute_file);

                    //
                    // TECH SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on Ubuntu 18.04.1 LTS running Apache v2.4.29, MySQLi v5.0.12, php v7.0.33, OpenSSL v1.1.1, and NuSOAP v0.9.5.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial, 'TECH_SPECS', $tmp_spec_array);

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial, 'PAGE_STATISTICS', 'STANDARD_REPORT');

                break;
                case 'return_sticky_media_link':

                    //
                    // return_sticky_media_link($media_element_key, $url = NULL, $target = '_blank', $email_channel = false)
                    
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE');

                    //
                    // PAGE TITLE
                    $tmp_title_array = array();
                    $tmp_title_array['PAGE_TITLE'] = $this->module_key;
                    $tmp_title_array['PAGE_DESCRIPTION'] = 'Returns a small (25px), medium (50px), or large (75px) 
                    image than can be sticky linked to a provided url. When $email_channel is TRUE, a single media 
                    image that is wrapped in a sticky linked anchor tag will be returned. When $email_channel is 
                    FALSE, an image sprite will be used in place of the single image.';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial, 'PAGE_TITLE', $tmp_title_array);

                    //
                    // METHOD DEFINITION
                    $tmp_method_definition = 'return_sticky_media_link(<br>
                    &nbsp;&nbsp;&nbsp;<span class="crnrstn_documentation_method_data_type">string</span> $media_element_key,<br>
                    &nbsp;&nbsp;&nbsp;<span class="crnrstn_documentation_method_data_type">string</span> $url = <span class="crnrstn_documentation_method_data_system_val">NULL</span>, <br>
                    &nbsp;&nbsp;&nbsp;<span class="crnrstn_documentation_method_data_type">string</span> $target = \'<span class="crnrstn_documentation_method_string_data">_blank</span>\', <br>
                    &nbsp;&nbsp;&nbsp;<span class="crnrstn_documentation_method_data_type">boolean</span> $email_channel = <span class="crnrstn_documentation_method_data_system_val">false</span><br>
                    ): <span class="crnrstn_documentation_method_data_type">string</span>';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial, 'METHOD_DEFINITION', $tmp_method_definition);

                    //
                    // RETURN VALUE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial, 'RETURN_VALUE', 'HTML OUTPUT.');

                    //
                    // PARAMETER DEFINITION
                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$media_element_key';
                    $tmp_param_def[0]['param_definition'] = 'A predefined (string) constant for the desired small (25 pixels in height), medium (50 pixels in height) or large (75 pixels in height) trademark logo, icon, or wordmark.';
                    $tmp_param_def[0]['param_required'] = true;

                    $tmp_param_def[1]['param_name'] = '$url';
                    $tmp_param_def[1]['param_definition'] = 'The destination url. This link will be sticky.';
                    $tmp_param_def[1]['param_required'] = false;

                    $tmp_param_def[2]['param_name'] = '$target';
                    $tmp_param_def[2]['param_definition'] = 'Where to display the linked URL. E.g. _self, _blank, _parent, or _top.';
                    $tmp_param_def[2]['param_required'] = false;

                    $tmp_param_def[3]['param_name'] = '$email_channel';
                    $tmp_param_def[3]['param_definition'] = 'Determines whether the returned and sticky linked HTML 
                    needs to work correctly within a multipart HTML email message. The default value, FALSE, will employ 
                    a sticky linked image sprite. Passing TRUE will return HTML having a traditional anchor tag 
                    linked media image.';
                    $tmp_param_def[3]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial, 'PARAMETER_DEFINITION', $tmp_param_def);

                    //
                    // EXAMPLE
                    $tmp_example_title_main = $this->oCRNRSTN->multi_lang_content_return('DOCUMENTATION_EXAMPLE_TITLE_TXT') . ' 1 ::';
                    $tmp_example_title_integrated = NULL;   //$this->oCRNRSTN->multi_lang_content_return('DOCUMENTATION_EXAMPLE_1_INTEGRATED_TITLE_TXT_ERROR_LOG');

                    $tmp_example_presentation_file = '/ui/docs/documentation/php/return_sticky_media_link/examples/return_sticky_media_link_show.php';
                    $tmp_example_execute_file = '/ui/docs/documentation/php/return_sticky_media_link/examples/return_sticky_media_link_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial, 'EXAMPLE_CONTENT', $tmp_example_title_main, $tmp_example_title_integrated, $tmp_example_presentation_file, $tmp_example_execute_file);

//                    //
//                    // NOTE
//                    $tmp_note_array = array();
//                    $tmp_note_array['NOTE_COPY'] = 'Velit HELLO [' . __LINE__ . '] NOTE_COPY! euismod in pellentesque massa placerat duis ultricies lacus sed. Hac habitasse platea dictumst quisque sagittis purus sit. Ipsum nunc aliquet bibendum enim facilisis. Nunc congue nisi vitae suscipit tellus mauris a. Eros in cursus turpis massa tincidunt dui ut ornare lectus. A lacus vestibulum sed arcu non. Pellentesque nec nam aliquam sem et tortor consequat.';
//                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial, 'NOTE', $tmp_note_array);

                    //
                    // TECH SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on Ubuntu 18.04.1 LTS running Apache v2.4.29, MySQLi v5.0.12, php v7.0.33, OpenSSL v1.1.1, and NuSOAP v0.9.5.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial, 'TECH_SPECS', $tmp_spec_array);

//                    //
//                    // GENERAL COPY DEMOS
//                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial, 'GENERAL_COPY_NAKED', 'Scelerisque HELLO [' . __LINE__ . '] GENERAL_COPY_NAKED! eleifend donec pretium vulputate sapien nec sagittis aliquam malesuada. At augue eget arcu dictum. Lorem ipsum dolor sit amet consectetur adipiscing elit duis tristique. Donec enim diam vulputate ut pharetra sit amet. Pulvinar neque laoreet suspendisse interdum. Dolor sed viverra ipsum nunc. Nisl rhoncus mattis rhoncus urna neque viverra justo nec ultrices. Lectus mauris ultrices eros in cursus turpis massa. Nec tincidunt praesent semper feugiat nibh sed pulvinar proin gravida. Faucibus scelerisque eleifend donec pretium vulputate sapien nec. Viverra suspendisse potenti nullam ac tortor vitae purus faucibus ornare. Consectetur adipiscing elit ut aliquam purus sit.');

                    $tmp_predefined_constants_html = '<div class="crnrstn_predefined_constant_title"><h2>Media Image Links Predefined String Constants ::</h2></div>';
                    $tmp_predefined_constants_html .= '<div class="crnrstn_predefined_constant_title_description"><p>The string constants below are derived from (and hence are always available as) part of the core of the C<span class="the_R_in_crnrstn">R</span>NRSTN :: ASSET MAPPING architecture.
</p></div>';
                    $tmp_predefined_constants_html .= '<div class="crnrstn_predefined_constant_content">
';

                    /*
                    $tmp_ARRAY[$str_constant]['alt_text'] = $tmp_alt_text;
                    $tmp_ARRAY[$str_constant]['title_text'] = $tmp_title_text;

                    return $tmp_ARRAY;
                    */

                    foreach($this->oCRNRSTN->asset_routing_data_key_lookup_ARRAY['social'] as $key => $str_constant){

                        $string_constant_is_valid = true;

                        $pos_HQ_chars = strpos($str_constant,'_HQ');
                        $pos_SPRITE_chars = strpos($str_constant,'SPRITE');

                        if($pos_HQ_chars !== false || $pos_SPRITE_chars !== false){

                            $string_constant_is_valid = false;

                        }

                        if($string_constant_is_valid){

                            $tmp_ARRAY = $this->oCRNRSTN->return_system_image($str_constant, '', '', '', '', '', '', CRNRSTN_RESOURCE_DOCUMENTATION);

                            $str_constant_trimmed = $this->oCRNRSTN->proper_replace('SOCIAL_', '', $str_constant);

                            $demo_media_constant = $str_constant_trimmed . '_LARGE';

                            if($str_constant_trimmed == 'BLUEHOST_WORDMARK'){

                                $demo_media_constant = $str_constant_trimmed . '_MEDIUM';

                            }

                            $tmp_predefined_constants_html .= '<div class="crnrstn_predefined_constant_demo_shell">
                        <div class="crnrstn_predefined_constant_demo_name">' . $str_constant_trimmed . '_SMALL<br>' . $str_constant_trimmed . '_MEDIUM<br>' . $str_constant_trimmed . '_LARGE</div>
                        <div class="crnrstn_predefined_constant_demo_icon_wrapper">
                            <div class="crnrstn_predefined_constant_demo_icon">' . $this->oCRNRSTN->return_sticky_media_link($demo_media_constant) . '</div>
                            <div class="crnrstn_cb_5"></div>
                            <div class="crnrstn_predefined_constant_demo_about"><p>' . $demo_media_constant . '</p></div>
                            <div class="crnrstn_predefined_constant_demo_about"><p>' . $tmp_ARRAY[$str_constant]['title_text'] . '</p></div>
                        
                        </div>
                        <div class="crnrstn_cb_5"></div>
                        </div>';

                        }

                    }

                    $tmp_predefined_constants_html .= '</div>';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial, 'GENERAL_COPY_R_STONE', $tmp_predefined_constants_html);

//                    //
//                    // RELATED METHODS
//                    $tmp_related_array = array();
//                    $tmp_related_array[0] = 'print_r';
//                    $tmp_related_array[1] = 'print_r_str';
//                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial, 'RELATED_METHODS', $tmp_related_array);

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial, 'PAGE_STATISTICS', 'STANDARD_REPORT');

                break;
                case 'add_system_resource':
                    /*
                    public function add_system_resource($data_key, $data_value, $data_type_family = 'CRNRSTN_SYSTEM_CHANNEL', $data_auth_profile = CRNRSTN_AUTHORIZE_RUNTIME_ONLY, $data_index = NULL, $env_key = NULL, $default_ttl = 60){

                    ON SUCCESS
                    return $data_key (hash)

                    ON ERR
                    return $this->session_salt();

                    */

                case 'config_add_administration':
                    /*
                    public function config_add_administration($env_key, $email_or_creds_path, $pwd = NULL, $ttl = 120, $max_login_attempts = 10){

                    return true;

                    */

                case 'config_add_database':
                    /*
                    public function config_add_database($env_key, $host_or_creds_path, $un = NULL, $pwd = NULL, $db = NULL, $port = NULL){

                    return true;

                    */

                case 'config_add_environment':
                    /*
                    public function config_add_environment($env_key, $err_reporting_profile){

                    return true;

                    */

                case 'config_add_seo_analytics':
                    /*
                    private function config_add_seo_analytics($env_key, $data_key, $data_value, $is_enabled = true){

                    return true;

                    */

                case 'config_add_seo_engagement':
                    /*
                    private function config_add_seo_engagement($env_key, $data_key, $data_value, $is_enabled = true){

                    return true;

                    */

                case 'config_deny_access':
                    /*
                    public function config_deny_access($env_key, $ipOrFile){

                    return true;

                    */

                case 'config_detect_environment':
                    /*
                    public function config_detect_environment($env_key = CRNRSTN_RESOURCE_ALL, $data_key = NULL, $value = NULL, $required_server_matches = 1){

                    ON SUCCESS
                    return self::$env_select_ARRAY[$this->config_serial_hash];

                    ON ERR (NO MATCH)
                    return false;

                    */

                case 'config_grant_exclusive_access':
                    /*
                    public function config_grant_exclusive_access($env_key, $ipOrFile){

                    return true;

                    */

                case 'config_include_encryption':
                    /*
                    public function config_include_encryption($env_key, $crnrstn_openssl_config_file_path){

                    return true;

                    */

                case 'config_include_seo_analytics':
                    /*
                    public function config_include_seo_analytics($env_key, $crnrstn_analytics_config_file_path){

                    return true;

                    */

                case 'config_include_seo_engagement':
                    /*
                    public function config_include_seo_engagement($env_key, $crnrstn_engagement_config_file_path){

                    return true;

                    */

                case 'config_include_system_resources':
                    /*
                    public function config_include_system_resources($env_key, $crnrstn_resource_config_file_path){

                    return true;

                    */

                case 'config_include_wordpress':
                    /*
                    public function config_include_wordpress($env_key, $crnrstn_wp_config_file_path){

                    return true;

                    */

                case 'config_init_images_http_dir':
                    /*
                    public function config_init_images_http_dir($env_key, $crnrstn_images_http_dir){

                    return true;

                    */

                case 'config_init_images_transport_mode':
                    /*
                    public function config_init_images_transport_mode($system_asset_mode = CRNRSTN_ASSET_MODE_BASE64){

                    return true;

                    */

                case 'config_init_logging':
                    /*
                    public function config_init_logging($env_key, $CRNRSTN_loggingProfile = CRNRSTN_LOG_DEFAULT, $CRNRSTN_loggingMeta = NULL){

                    return true;

                    */

                case 'form_hidden_input_add':
                    /*
                    public function form_hidden_input_add($crnrstn_form_handle = NULL, $field_input_name = NULL, $field_input_id = NULL, $default_value = NULL, $validation_constant_profile = CRNRSTN_INPUT_OPTIONAL, $table_field_name = NULL, $encrypt_data = true){

                    return NULL;

                    */

                case 'form_input_add':
                    /*
                    public function form_input_add($crnrstn_form_handle = NULL, $field_input_name = NULL, $field_input_id = NULL, $default_value = NULL, $validation_constant_profile = CRNRSTN_INPUT_OPTIONAL, $table_field_name = NULL){

                    return NULL;

                    */

                case 'form_input_feedback_copy_add':
                    /*
                    public function form_input_feedback_copy_add($crnrstn_form_handle, $validation_constant_profile, $field_input_name, $field_input_id = NULL, $err_msg = NULL, $success_msg = NULL, $info_msg = NULL){

                    return true;

                    */

                case 'form_integration_html_packet_output':
                    /*
                    public function form_integration_html_packet_output($crnrstn_form_handle){

                    return $this->oCRNRSTN_USR->ui_content_module_out(CRNRSTN_UI_FORM_INTEGRATION_PACKET, $crnrstn_form_handle);

                    */

                case 'form_response_add':
                    /*
                    public function form_response_add($crnrstn_form_handle, $field_input_name = NULL, $success_response_data = NULL, $success_response_type = NULL, $error_response_data = NULL, $error_response_type = NULL){

                    return true;

                    */

                case 'get_resource':
                    /*
                    public function get_resource($data_key, $index = NULL, $data_type_family = 'CRNRSTN_SYSTEM_CHANNEL', $data_auth_request = CRNRSTN_OUTPUT_RUNTIME){

                    return self::$oCRNRSTN_CONFIG_MGR->retrieve_data_value($data_key, $data_type_family, $index, self::$server_env_key_ARRAY[$this->config_serial_hash], $data_auth_request);

                    */

                case 'grant_permissions_fwrite':
                    /*
                    public function grant_permissions_fwrite($filepath, $minimum_bytes_required = 0){

                    return $this->oCRNRSTN_PERFORMANCE_REGULATOR->grant_permissions_fwrite($filepath, $minimum_bytes_required);

                    */

                case 'ini_set':
                    /*
                    public function ini_set($ini_setting, $ini_value){

                    return ini_set($ini_setting, $ini_value);

                    */

                case 'is_configured':
                    /*
                    public function is_configured(){

                    return true;

                    */

                case 'print_r':
                    /*
                    public function print_r($expression, $title = NULL, $theme_style = NULL, $line_num = NULL, $method = NULL, $file = NULL){

                    */

                case 'print_r_str':
                    /*
                    public function print_r_str($expression, $title = NULL, $theme_style = NULL, $line_num = NULL, $method = NULL, $file = NULL){


                    */

                case 'return_system_image':
                    /*
                    public function return_system_image($media_element_key, $height = NULL, $hyperlink = NULL, $alt = NULL, $title = NULL, $target = NULL, $width = NULL, $image_output_mode = NULL){

                    */

                case 'return_youtube_embed':
                    /*
                    public function return_youtube_embed($url, $width = 560, $height = 315, $fullscreen = true){

                    */

                case 'set_crnrstn_as_err_handler':
                    /*
                    public function set_crnrstn_as_err_handler($env_key, $crnrstn_is_active = true, $error_types_profile = NULL){

                    ON SUCCESS
                    return true;

                    ON ERR
                    return false;

                    */

                case 'set_max_login_attempts':
                    /*
                    public function set_max_login_attempts($env_key, $max_login_attempts){


                    */

                case 'set_timeout_user_inactive':
                    /*
                    public function set_timeout_user_inactive($env_key, $secs){


                    */

                case 'set_timezone_default':
                    /*
                    public function set_timezone_default($timezone_id){

                    return date_default_timezone_set($timezone_id);

                    */

                case 'set_ui_theme_style':
                    /*
                    public function set_ui_theme_style($theme_style = CRNRSTN_UI_PHPNIGHT, $index = NULL){

                    */

                case 'error_log':

                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE');

                    //
                    // PAGE TITLE
                    $tmp_title_array = array();
                    $tmp_title_array['PAGE_TITLE'] = $this->module_key;
                    $tmp_title_array['PAGE_DESCRIPTION'] = 'Lorem ipsum ' . $this->module_key . ' dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Neque sodales ut etiam sit. Tincidunt nunc pulvinar sapien et ligula ullamcorper malesuada proin libero. Ultricies tristique nulla aliquet enim tortor at. Posuere urna nec tincidunt praesent semper feugiat nibh sed.';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial, 'PAGE_TITLE', $tmp_title_array);

                    //
                    // METHOD DEFINITION
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial, 'METHOD_DEFINITION', 'error_log(<br>&nbsp;&nbsp;&nbsp;<span class="crnrstn_documentation_method_data_type">string</span> $str,<br>&nbsp;&nbsp;&nbsp;<span class="crnrstn_documentation_method_data_type">string</span> $line_num = NULL, <br>&nbsp;&nbsp;&nbsp;<span class="crnrstn_documentation_method_data_type">string</span> $method = NULL, <br>&nbsp;&nbsp;&nbsp;<span class="crnrstn_documentation_method_data_type">string</span> $file = NULL, <br>&nbsp;&nbsp;&nbsp;<span class="crnrstn_documentation_method_data_type">integer</span> $log_silo_key = NULL<br>): <span class="crnrstn_documentation_method_data_type">boolean|true</span>');

                    //
                    // PARAMETER DEFINITION
                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$str';
                    $tmp_param_def[0]['param_definition'] = 'This is the $str. Nec tincidunt praesent semper feugiat nibh sed pulvinar proin gravida. Faucibus scelerisque eleifend donec pretium vulputate sapien nec. Viverra suspendisse potenti nullam ac tortor vitae purus faucibus ornare. Consectetur adipiscing elit ut aliquam purus sit.';
                    $tmp_param_def[0]['param_required'] = true;

                    $tmp_param_def[1]['param_name'] = '$line_num';
                    $tmp_param_def[1]['param_definition'] = 'This is the $line_num.';
                    $tmp_param_def[1]['param_required'] = false;

                    $tmp_param_def[2]['param_name'] = '$method';
                    $tmp_param_def[2]['param_definition'] = 'This is the $method. Viverra suspendisse potenti nullam ac tortor vitae purus faucibus ornare. Consectetur adipiscing elit ut aliquam purus sit.';
                    $tmp_param_def[2]['param_required'] = false;

                    $tmp_param_def[3]['param_name'] = '$file';
                    $tmp_param_def[3]['param_definition'] = 'This is the $file. Faucibus scelerisque eleifend donec pretium vulputate sapien nec.';
                    $tmp_param_def[3]['param_required'] = false;

                    $tmp_param_def[4]['param_name'] = '$log_silo_key';
                    $tmp_param_def[4]['param_definition'] = 'This is the $log_silo_key. Viverra suspendisse potenti nullam ac tortor vitae purus faucibus ornare.Viverra suspendisse potenti nullam ac tortor vitae purus faucibus ornare.';
                    $tmp_param_def[4]['param_required'] = false;
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial, 'PARAMETER_DEFINITION', $tmp_param_def);

                    //
                    // RETURN VALUE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial, 'RETURN_VALUE', 'true');

                    //
                    // EXAMPLE
                    $tmp_example_title_main = $this->oCRNRSTN->multi_lang_content_return('DOCUMENTATION_EXAMPLE_TITLE_TXT') . ' 1 ::';
                    $tmp_example_title_integrated = ''; //$this->oCRNRSTN->multi_lang_content_return('DOCUMENTATION_EXAMPLE_1_INTEGRATED_TITLE_TXT_ERROR_LOG');
                    $tmp_example_presentation_file = '/ui/docs/documentation/php/error_log/examples/error_log_show.php';
                    $tmp_example_execute_file = '';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial, 'EXAMPLE_CONTENT', $tmp_example_title_main, $tmp_example_title_integrated, $tmp_example_presentation_file, $tmp_example_execute_file);

                    //
                    // NOTE
                    $tmp_note_array = array();
                    $tmp_note_array['NOTE_COPY'] = 'Velit HELLO [' . __LINE__ . '] NOTE_COPY! euismod in pellentesque massa placerat duis ultricies lacus sed. Hac habitasse platea dictumst quisque sagittis purus sit. Ipsum nunc aliquet bibendum enim facilisis. Nunc congue nisi vitae suscipit tellus mauris a. Eros in cursus turpis massa tincidunt dui ut ornare lectus. A lacus vestibulum sed arcu non. Pellentesque nec nam aliquam sem et tortor consequat.';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial, 'NOTE', $tmp_note_array);

                    //
                    // TECH SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on Ubuntu 18.04.1 LTS running Apache v2.4.29, MySQLi v5.0.12, php v7.0.33, OpenSSL v1.1.1, and NuSOAP v0.9.5.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial, 'TECH_SPECS', $tmp_spec_array);

                    //
                    // GENERAL COPY DEMOS
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial, 'GENERAL_COPY_NAKED', 'Scelerisque HELLO [' . __LINE__ . '] GENERAL_COPY_NAKED! eleifend donec pretium vulputate sapien nec sagittis aliquam malesuada. At augue eget arcu dictum. Lorem ipsum dolor sit amet consectetur adipiscing elit duis tristique. Donec enim diam vulputate ut pharetra sit amet. Pulvinar neque laoreet suspendisse interdum. Dolor sed viverra ipsum nunc. Nisl rhoncus mattis rhoncus urna neque viverra justo nec ultrices. Lectus mauris ultrices eros in cursus turpis massa. Nec tincidunt praesent semper feugiat nibh sed pulvinar proin gravida. Faucibus scelerisque eleifend donec pretium vulputate sapien nec. Viverra suspendisse potenti nullam ac tortor vitae purus faucibus ornare. Consectetur adipiscing elit ut aliquam purus sit.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial, 'GENERAL_COPY_R_STONE', 'Risus HELLO [' . __LINE__ . '] GENERAL_COPY_R_STONE! nullam eget felis eget nunc lobortis mattis aliquam faucibus. Nibh tortor id aliquet lectus proin nibh. In hac habitasse platea dictumst quisque sagittis purus sit amet. Sit amet volutpat consequat mauris nunc congue. Dui nunc mattis enim ut tellus elementum sagittis vitae et. Tristique et egestas quis ipsum suspendisse ultrices gravida. Rhoncus urna neque viverra justo nec. Eget nullam non nisi est sit amet facilisis magna etiam. Luctus accumsan tortor posuere ac ut. Purus viverra accumsan in nisl. Nunc congue nisi vitae suscipit tellus mauris a. Eros in cursus turpis massa tincidunt dui ut ornare lectus. Tellus at urna condimentum mattis pellentesque id nibh tortor id. Amet nisl purus in mollis nunc.');

                    //
                    // RELATED METHODS
                    $tmp_related_array = array();
                    $tmp_related_array[0] = 'print_r';
                    $tmp_related_array[1] = 'print_r_str';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial, 'RELATED_METHODS', $tmp_related_array);

                    /*
                    Tuesday, October 18, 2022 @ 0534 hrs
                    CRNRSTN :: LIGHTSABER
                    PAGE_TITLE
                    PAGE_DESCRIPTION
                    --EXAMPLE_TITLE_MAIN
                    --EXAMPLE_TITLE_INTEGRATED
                    EXAMPLE_CONTENT
                    NOTE_TITLE
                    NOTE_COPY
                    TECH_SPECS_TITLE
                    TECH_SPECS (array)
                    GENERAL_COPY_NAKED
                    GENERAL_COPY_R_STONE
                    ----
                    METHOD_DEFINITION
                    PARAMETER_DEFINITION
                    RETURN_VALUE

                    ====
                    September 28, 2020 @ 1857 hrs
                    http://v2.crnrstn.evifweb.com/

                    BASIC_COPY
                    NOTE_COPY
                    TECH_SPEC
                    METHOD_DEFINITION
                    PARAMETER_DEFINITION
                    RETURNED_VALUE
                    EXAMPLE

                    */

                break;
                case '/search/':
                    $tmp_categ_name = 'search results';
                    $tmp_subcateg_name = 'search results';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'search results for';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    // $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'SUB_TITLE','Scriptures :: <span style="font-size:11px;">(scrollable section)</span>');

                break;
                case '/amalek/':
                    $tmp_categ_name = 'amalek';
                    $tmp_subcateg_name = 'an amalekite princess';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'an amalekite princess';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'SUB_TITLE','Scriptures :: <span style="font-size:11px;">(scrollable section)</span>');

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','<div style="height:250px; overflow:scroll;">
                        	<p><strong>Gen. 25:23</strong> - And Jehovah said to her, / Two nations are in your womb, / And two peoples shall be separated from your bowels. / And the one people shall be stronger than the other people. / And the older shall serve the younger.</p>

<p><strong>Gen. 25:24-26</strong> - And when her days to be delivered were fulfilled, behold, there were twins in her womb. 25 And the first came forth red, all over like a hairy garment; and they called his name Esau. 26 And after that his brother came forth, and his hand was holding on to Esau\'s heel, so his name was called Jacob. And Isaac was sixty years old when she bore them.</p>
 
<p><strong>Gen. 36:12a</strong> - And Timna was a concubine to Eliphaz, Esau\'s son, and she bore Amalek to Eliphaz.</p>

<p><strong>Exo. 17:8-16</strong> - 8 Then Amalek came and fought with Isreal in Rephidim. 9 And Moses said to Joshua, Choose men for us, and go out; fight with Amalek. Tomorrow I will stand on the top of the hill with the staff of God in my hand. 10 So Joshua did as Moses has said to him and fought with Amalek; and Moses Aaron, and Hur went to the top of the hill. 11 And when Moses lifted his hand up, Israel prevailed; and when he let his hand down, Amalek prevailed. 12 But Moses\' hands were heavy, so they took a stone and put it under him, and he sat on it; and Aaron and Hur supported his hands, one on one side and one on the other side. So his hands were steady until the going down of the sun. 13 And Joshua defeated Amalek and his people with the edge of the sword. 14 And Jehovah said to Moses, Write this as a memorial in a book and recite it to Joshua, that I will utterly blot out the memory of Amalek from under heaven. 15 And Moses built an altar and called the name of it Jehovah-nissi; 16 For he said, For there is a hand against the throne of Jah! Jehovah will have war with Amalek from generation to generation. </p>

<p><strong>Mal. 1:2-3</strong> - I have loved you, says Jehovah; but you say, How have You loved us? Was not Esau Jacob\'s brother, declares Jehovah? Yet I loved Jacob; 3 But Esau I hated, and I made his mountains a desolation, and gave his inheritance to the jackals of the wilderness.</p>

<p><strong>Rom 9:13</strong> - As it is written, "Jacob have I loved, but Esau have I hated."</p>

<p><strong>Eph. 6:11-12</strong> - Put on the whole armor of God that you may be able to stand against the stratagems of the devil, 12 For our wrestling is not against blood and flesh but against the rulers, against the authorities, against the world-rulers of this darkness, against the spiritual forces of evil in the heavenlies.</p>
                  
                        </div>');

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'SUB_TITLE','Revelation');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Before these matters are laid at your feet for your consideration (and with the hope and expectation that the enlightenment of the Holy Spirit will follow), I have to humbly acknowledge my sources: 1) the faithful ministry of brothers Watchman Nee and Witness Lee (with those serving alongside them to shepherd the churches) combined with 2) the instant revelation...the instant speaking...of the Lord Jesus Christ as the all-inclusive, compound, seven-fold intensified, life-giving Spirit who dwells within my human spirit. The combination of these two (2) exposed the spiritual identity of an entity of people responsible for a certain vein of events which have been taking place in my life since beginning around Q3 of 2011.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','I say "spiritual identity" because the battle which God\'s people, the saints, are fighting at this very moment is not against blood and flesh (Eph. 6:11-12). There is a spiritual war taking place in this universe, and only a built up body of serving priests (the church)...God\'s saints...can be in a proper position to stand with God and gain the victory over God\'s enemy, Satan.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','To see "The Amalekite Princess", one must first have an understanding and an application of fundamental principles of God\'s economy. One must live their life by and according to their mingled spirit...allowing their spirit to be the leading organ in their being. One must spend their days abiding in the enjoyment of the Lord Jesus Christ...giving thanks for all things in simplicity.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Second, the saints must have the deep conviction and realization that when their conscience condemns them, that is God operating within their being to accuse or even excuse them regarding matters of their daily life and living (1 John 3:20). <strong>The divine revelation goes even further to identify our regenerated human spirit with the very throne of God in the universe (Heb. 4:16,12).</strong> The throne of God is the very center of God\'s divine administration in the whole universe. Saints, our human spirit is the very gate of heaven (Gen. 28:17)...the key to our entrance into (and existence in) the reality of God\'s kingdom.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Finally, one must understand the role of Amalek in God\'s economy. The divine revelation in the Holy Scriptures is very clear and consistent regarding the descendants of Esau...the Amalekites. Spiritually speaking, "Amalek typifies the flesh which is the totality of the fallen old man (Gal. 2:16). The fighting between Amalek and Israel depicts the conflict between the flesh and the Spirit within the believers." "The flesh is God\'s enemy. It has neither the intention nor the ability to obey God (Rom. 8:7-8)".');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','The role of Amalek can be summarized by Moses\' experience of building and naming an alter after the defeat of Amalek in Exo. 17. "And Moses built an altar and called the name of it Jehovah-nissi; For he said, For there is a hand against the throne of Jah!" The flesh...Amalek..."is a hand against" or a "raised...fist against the Lord\'s throne".');

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'SUB_TITLE','Application');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Now, why would I identify some group of people in my life as being the spiritual embodiment of an "Amalekite Princess"? The Lord revealed to me that certain oppressive situations which were being orchestrated around me were being done with the intention or expectation of "tricking my conscience" into telling me that I had done something wrong (when only appearances of wrong doing were being created). Why would someone try to trick my conscience?');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Modern science has discovered that when you feel guilty, there is activity in your brain which gives off a unique signature that can be monitored and recorded with technology. This Amalekite Princess knows when I feel guilty! And this particular data is what the Amalekite Princess was looking for when she was running her game around me. If this princess could show the whole world that a Christian\'s conscience was totally "trickable", it would follow that any "divine involvement in the inner being of a Christian" is just a figment of a Christian\'s imagination. This position would clearly give ground for Satan to attack the divine revelation in its application before the whole world.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','If this Amalekite Princess could show that a simple "spilled sugar trick" could trigger my conscience into condemning me and making me feel guilty, she would have the ground to go further and speculate that since an all-knowing God could never be tricked like this...God must not be leading Jonathan \'J5\' Harris (or perhaps anyone else on this planet!) in his human spirit as the Word of God clearly reveals and as I have been strongly testifying. <strong>The Lord revealed to me that someone was hovering around a position which was going to give ground to Satan to openly attack the Throne of God as it is made real in the experience of all of God\'s children through the Spirit. In the Bible, there is an entity...a body of people...known to raise a fist to attack the Throne of God in this universe: Amalek.</strong> And by the Lord\'s sovereign grace and mercy, I have had opportunity to live under the influence of not just any Amalekite...this corporate person is Amalekite royalty...she is a princess of the Amalekites...being so wealthy, so proud, and so sensitive of how she is made to appear before her own people. ');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Because I don\'t want to end on a down note, there is spiritual significance in how the victory over Amalek was won by God\'s people. Due to space and time I will just insert a quote from a footnote in my Recovery Version Bible (Exo. Footnote 11<sup>1</sup>, Recovery Version):');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','<blockquote><i><strong>We are victorious over the flesh by eating and drinking Christ as our life supply and by praying with the interceding Christ and putting the flesh to death with Christ as the fighting Spirit.</strong></i></blockquote>');

                break;
                case '/':
                    $tmp_categ_name = 'Home';
                    $tmp_subcateg_name = 'Home';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'Welcome';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Welcome to the C<span class="the_R">R</span>NRSTN Suite :: documentation and support website! C<span class="the_R">R</span>NRSTN is a free open source PHP class library that facilitates the operation of a LAMP application within multiple server environments (e.g. localhost, stage, production, .etc) effectively and properly joining the "wall of SERVER" to the "wall of application"...creating the two into one house. With this tool, data and functionality possessing characteristics which inherently create distinctions from one environment to the next...such as IP address restrictions, error logging profiles, and database authentication credentials...can all be managed through one framework for an entire application. C<span class="the_R">R</span>NRSTN also provides a layer of encryption which can be configured for both cookie and session data.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Thank you for taking the time to check out the C<span class="the_R">R</span>NRSTN Suite ::. If you would like to contribute to this project, consider <a href="https://github.com/jony5/crnrstn" target="_blank">following/watching this project on GitHub</a>. View the project <a href="https://www.facebook.com/media/set/?set=a.10152398953669503.1073741836.586549502&type=1&l=4ba17e313a" target="_blank">photo gallery</a>.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','As a "hat tip" to King Abdullah Bin Abdul Aziz\'s bold move to provide 500 tons of wheat to Syrian refugees in Jordan (as reported by <a href="http://english.alarabiya.net/en/News/2013/01/13/Saudi-king-orders-500-tons-of-wheat-to-Syrian-refugees-in-Jordan.html" target="_blank">Al Arabiya</a>), as of today (1/16/2013 @ 0600), I am undertaking a slightly less noble...but just as sincere...effort to "help the people" through my creation of an open source enterprise level PHP class library for the management of a web application\'s integration into n+1 hosting ($_SERVER) environments. This body of code is completely new, and I am only leveraging resources and knowledge as is readily and freely available to the open source PHP community at large for the benefit of exactly the same. No part of any application that I developed whilst under the employ of any agency or for-profit business entity has been lifted and placed into this work. Due to the fact that I am currently being subjected to extensive surveillance protocols by an entity which bears an inscription...even written upon it\'s very forehead...which reads as "<a href="' . $this->oCRNRSTN->crnrstn_http_endpoint() . '_crnrstn/amalek/" target="_self">AMALEKITE PRINCESS</a>", I have a high degree of confidence that the genesis of this project has been recorded and documented in a very thorough manner; there are witnesses who can vouch for the originality of this work.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'SUB_TITLE','History');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','When I entered the workforce in 2006 as an HTML developer making $35 an hour (after having to to step away from my internet start up company...where I was a full stack developer who was to be compensated through a stock offering upon going public), within the first few DAYS on the job, I was quietly using PHP to stand up tools to help me control the quality my HTML code via rendering it in an email to myself so that I could QA my code (and tweak it if necessary) before submitting my work to the team for the next step of the email marketing process. The quality of my email HTML code went from zero (0) to one hundred (100) real quick (within a day or so), and I (and our small team) knew immediately that things were going to work out. As far as I know, HTML email developers at <a href="http://www.moxieusa.com/" target="_blank">Moxie</a> are using the tools that I put together to test HTML email quality and rendering to this very day.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Through out the course of my career at Moxie, I would use PHP to put together various portals, a file sharing and project management extranet complete with MySQL powered search and user administration, and...heck...even web services for EMAIL and SMS real-time messaging. <strong>Sadly however, I never had the time to carve out for myself a solid and reusable PHP class library for the gaining of efficiencies in product maintenance, development and deployment.</strong> While working at Moxie (2006-2012), <strong>I really could have used an out-of-the-box/plug-n-play <a href="https://en.wikipedia.org/wiki/LAMP_(software_bundle)" target="_blank">LAMP stack</a> class library with the capability of facilitating an application\'s compliance with the RTM processes of a mature development shop.</strong>');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','In 2012 (after my exodus from Moxie with...according to what I have been told...&quot;a bang&quot;) on a 09\' model unibody Macbook Pro that I purchased with my own personal money while at Moxie...for my web application development at Moxie, <strong>I began work on just such a solution...coining the project name C<span class="the_R">R</span>NRSTN, because I was going to use this "stone" to properly join the "wall of server environment" and the "wall of application codebase" together into one house.</strong> In hindsight (when I look at archived code from the period of the C<span class="the_R">R</span>NRSTN genesis)...the approach of my execution in the code was a little off...leaning hard on achieving light and fast performance and completely abandoning flexibility and usability. My mind needed to be uplifted; I needed to experience a paradigm shift. Well...between October of 2012 and Jan 16, 2013, I took a break from programming to go deep in my study of the Bible together with books of ministry to strengthen the foundation of my faith, deepen my daily walk with the Lord Jesus Christ, and validate my moment by moment Christian experience against the teaching and fellowship of the apostles.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','While following the leading of the Spirit in my study of the Word of God...during this sabbatical of sorts..., I also began to reconsider the C<span class="the_R">R</span>NRSTN project and what I wanted this tool to be able to do. By that point, I had thoroughly re-read (cover to cover a couple of times) my second edition copy of <a href="https://g.co/kgs/kJbTk5" target="_blank">High Performance MySQL</a> that was purchased for me by Moxie on the professional development budget. ');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','&lt;flashback&gt; While at Moxie and when I was approaching a massive redesign (LAMP) for a client extranet that was growing in number of users and activity, I requested to be enrolled in a MySQL course from <a href="http://education.oracle.com/" target="_blank">Oracle</a>. That request was denied with audible laughs. Not giving up on my quest for <i>the knowledge</i>...I then found and purchased the best 2 books I could on the topics of interest (<a href="https://g.co/kgs/kJbTk5" target="_blank">High Performance MySQL</a> and <a href="https://g.co/kgs/7ZgxfK" target="_blank">Ajax Design Patterns</a>) and then requested for Moxie to recoup my investment. This request was approved...but I got a stern talking to about making future purchases without getting all of the approvals first. No problem. I\'ve read the MySQL book maybe 5 times by now, and it has changed the way that I architect data drive applications. I also have a loose development roadmap which will be directing my ongoing R&amp;D for the C<span class="the_R">R</span>NRSTN Suite ::. Any useful results from this research will be incorporated into the C<span class="the_R">R</span>NRSTN Suite in a future release. &lt;/flashback&gt;');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','So beginning in Jan of 2013...while I continued my study of the Holy Scriptures...I picked up the C<span class="the_R">R</span>NRSTN project and (starting from scratch with a much more insightful approach) began to architect and build out this tool. Between July of 2013 and March of 2016 all application development was moved to my pre-Moxie development machine...a circa 2005 Toshiba Portege M100 running Windows XP&reg; pro and Apache as a service (via <a href="https://www.apachefriends.org/" target="_blank">Xampp</a>). The AC power adapter for my 09\' unibody Macbook Pro had broken, and I did not feel to move in a direction to resolve that problem...so good bye for now dear 09\' Macbook Pro. The bulk of this second (fresh from the ground up) iteration of C<span class="the_R">R</span>NRSTN development was done from within the Windows environment.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Fast-forward to March of 2016,...the broken power adapter for my 09\' Macbook Pro was replaced by a good friend of mine, and I immediately copied the C<span class="the_R">R</span>NRSTN project (which was approximately 90% complete) from my 2005 Widows XP Toshiba Portege M100 laptop back to my 09\' Macbook Pro. I then began to painstakingly crawl through both the C<span class="the_R">R</span>NRSTN Suite :: class library and it\'s accompanying documentation web site...testing all the work I had done within the Windows environment on my Toshiba in my 09\' Mac localhost hosting environment. Once I got C<span class="the_R">R</span>NRSTN in shape on my Macbook Pro, a couple of other projects (including a redesign of my personal website <a href="http://jony5.com" target="_blank">jony5.com</a>) fell on my plate, and so I had opportunity to test the implementation of C<span class="the_R">R</span>NRSTN on these new projects and new hosting environments and make changes wherever it made sense. ');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','December of 2017 came around along with a renewed desire to pick up, complete and release the C<span class="the_R">R</span>NRSTN project, but my 09\' Macbook Pro began to freeze up on me and was not up for the task at hand. I shared my frustrations with my dad, and he offered to get me a new laptop. On Dec. 28 2017, a new 2017 Macbook Pro was purchased for me from the <a href="https://www.apple.com/" target="_blank">Apple</a> store at <a href="https://www.perimetermall.com/en.html" target="_blank">Perimeter Mall</a> in Atlanta, GA; I copied all my project files along with my XP and Ubuntu virtual machines from my 09\' Macbook Pro to the new 2017 Macbook Pro. I then upgraded my Ubuntu Server VM to the latest which brought with it PHP7 (previously, I had only supported PHP5) and the extra work of having to crawl through C<span class="the_R">R</span>NRSTN and the documentation website making updates to account for the new version of PHP. Both PHP5 and PHP7 are now supported by C<span class="the_R">R</span>NRSTN!');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Between Dec of 2017 and April of 2018, I completed a third iterative pass through the C<span class="the_R">R</span>NRSTN class library and the accompanying documentation web site. On top of making updates for PHP7 compatibility, the code for the C<span class="the_R">R</span>NRSTN Suite :: was tightened up a little more, the session and cookie encryption layers were updated to stand on the openssl encryption cipher library (as opposed to the deprecated[PHP5] and removed[PHP7] mcrypt library), and the documentation with the accompanying code examples were thoroughly fleshed out and checked against the C<span class="the_R">R</span>NRSTN Suite :: codebase for clarity and accuracy.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','It is now June 20, 2018, and a hard launch date of July 4, 2018 has been set. The C<span class="the_R">R</span>NRSTN Suite :: version 1.0.0 documentation has been pushed to production, and the <a href="https://github.com/jony5/CRNRSTN" target="_blank">GitHub repository</a> for this project has been updated with the latest release. We have now entered into the realm of soft launch for the C<span class="the_R">R</span>NRSTN Suite :: version 1.0.0. Over the next couple of weeks leading up to the official release date, there will be plenty of &quot;tire kicking&quot;, fine tuning, and copy tweaks. After a solid 6 years spent in thoughtful contemplation and faithful laboring, we are finally ready to go! Thank You, Lord Jesus!');

                break;
                case '/suite_methods/configuration_file/':
                    $tmp_categ_name = 'Configuration File';
                    $tmp_subcateg_name = 'Configuration File';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = '';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial, 'BASIC_COPY','The C<span class="the_R">R</span>NRSTN Suite :: 
                    is an open source PHP class library to both facilitate, augment, and enhance fundamental operations (from basic to advanced) 
                    of a code base for an application in parallel across multiple hosting environments. The configuration file of this suite with 
                    its accompanying configuration includes serves as a fitting cornerstone joining the &quot;wall&quot; of any server to the 
                    &quot;wall&quot; of the running application to produce a suitable abode at any IP.');

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial, 'NOTE_COPY','For consistency, process start time is 
                    the first data point acquired by the C<span class="the_R">R</span>NRSTN Suite ::. Placing the 
                    C<span class="the_R">R</span>NRSTN :: configuration include at the very top of every page is primarily 
                    important for the accuracy of any load testing results that would key against runtime calculations made from time related
                    data (such as &quot;rtime&quot; or runtime) reported on by C<span class="the_R">R</span>NRSTN ::. One (1) MD5 hash 
                    algorithm generation call (called before recording a start time) can throw off consistency of when the actual process 
                    start time is recorded (relative to &quot;true start time&quot;) due to fluctuations in processor load experienced 
                    during the operation of PHP when generating the hash algorithm. Indeed, future releases of 
                    C<span class="the_R">R</span>NRSTN :: may incorporate configurable data markers to key against defined application 
                    performance threshold limitations with subsequent system notifications triggered by data that falls outside the bounds of its 
                    threshold.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'To stand up the code base of a web application on top of the 
                    C<span class="the_R">R</span>NRSTN Suite ::, place the configuration file include at the top of every page 
                    or endpoint (i.e. at the very top of the first operation that runs) for the entire application. This 
                    documentation web site uses a &quot;current directory depth relative to root directory&quot; include 
                    file, <strong><em>_crnrstn.root.inc.php</em></strong>, to maintain the 
                    C<span class="the_R">R</span>NRSTN :: configuration file path on every page in every directory.';
                    $tmp_example_presentation_file = '/common/inc/examples/config_file_overview_show.php';
                    $tmp_example_execute_file = '';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/configuration_file/crnrstn/':
                    $tmp_categ_name = 'Configuration File';
                    $tmp_subcateg_name = 'Configuration File';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'crnrstn()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $tmp_str = 'The C<span class="the_R">R</span>NRSTN :: __construct() facilitates a number of critical performance behaviors. 1) Session serialization to prevent resource contention, 2) the debug output level for <a href="https://github.com/PHPMailer/PHPMailer" target="_blank">PHPMAILER</a> - a full-featured email creation and transfer class for PHP which has been refactored and deeply integrated into the C<span class="the_R">R</span>NRSTN Suite :: to provide rich email features and functionality and to lay a solid foundation for all system generated (or user initiated) notifications, 3) silos to capture user-defined subsets of error log trace data for bubbling up through a robust debug logging and notification services layer managed by 4) the C<span class="the_R">R</span>NRSTN :: master debug mode profile for the entire C<span class="the_R">R</span>NRSTN Suite ::.';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial, 'BASIC_COPY', $tmp_str);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial, 'NOTE_COPY','<span style="color:#F00; font-weight: bold;">!!</span> CAUTION :: <span style="font-family: "Courier New", Courier, monospace;">$PHPMAILER_debug_mode = 4</span> will expose ALL SMTP <strong>usernames</strong> and <strong>passwords</strong> to the C<span class="the_R">R</span>NRSTN :: debug log trace services layer which, said layer, includes user configured and browser accessible log output modes of SCREEN_TEXT, SCREEN or SCREEN_HTML, SCREEN_HTML_HIDDEN, EMAIL, and EMAIL_PROXY <span style="color:#F00; font-weight: bold;">!!</span>');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','__construct($config_filepath, $C<span class="the_R">R</span>NRSTN_config_serialization, $C<span class="the_R">R</span>NRSTN_debugMode=0, $PHPMAILER_debug_mode=0, $log_silo_key_piped=\'*\')');

                    $tmp_param_def = array();
                    $tmp_str = '__FILE__ path to the C<span class="the_R">R</span>NRSTN Suite :: configuration 
                                file. This is used to monitor the configuration file for any updates and to subsequently modify 
                                any active sessions for the purposes of reducing all C<span class="the_R">R</span>NRSTN :: 
                                environmental detection mid-active-session re-initialization-induced memory leaks to zero. Should
                                this transpire, it will result in a minor spike in the processing overhead requirements of a sufficiently 
                                highly trafficked environment.';

                    $tmp_param_def[0]['param_datatype'] = 'string';
                    $tmp_param_def[0]['param_name'] = '$config_filepath';
                    $tmp_param_def[0]['param_definition'] = $tmp_str;
                    $tmp_param_def[0]['param_required'] = true;

                    $tmp_str = 'This should be a unique and custom string in order to serialize this configuration 
                    of C<span class="the_R">R</span>NRSTN ::. If multiple 
                    C<span class="the_R">R</span>NRSTN :: config files are running within this environment (e.g. n+1 
                    micro-sites at the same IP) make this value unique for each configuration file in order to prevent 
                    SESSION resource contention for any site-to-site traffic in the form of array value overwrites 
                    (unless ALL config resources are EXACTLY the same site to site...which is unlikely). Should 
                    <span class="phpvar_copy">$C<span class="the_R">R</span>NRSTN_config_serialization</span> change 
                    during an active session, 
                    C<span class="the_R">R</span>NRSTN :: will need to perform a complete reset resulting in a 
                    re-execution of environmental detection 
                    and a reacquisition of all resource definitions. This will result in a minor spike in the 
                    processing overhead requirements of a 
                    sufficiently highly trafficked environment. Also, please note that ANY changes to this 
                    configuration file will result in the same...a full reset for the 
                    C<span class="the_R">R</span>NRSTN :: environmental detection layer and resource definitions.';

                    $tmp_param_def[1]['param_datatype'] = 'string';
                    $tmp_param_def[1]['param_name'] = '$C<span class="the_R">R</span>NRSTN_config_serialization';
                    $tmp_param_def[1]['param_definition'] = $tmp_str;
                    $tmp_param_def[1]['param_required'] = true;

                    $tmp_str = 'The master debug mode for the C<span class="the_R">R</span>NRSTN Suite ::, where $C<span class="the_R">R</span>NRSTN_debugMode =  0, 1, or 2.
                    <div class="cb_10"></div>

                    <strong>$C<span class="the_R">R</span>NRSTN_debugMode = 0</strong><br>
                    Turns all error trace logging off.
                    <br>
                    <strong style="font-size:95%;">NOTE ::</strong> Minimal additional memory and processing overhead 
                    performance requirements can be expected.
                    <div class="cb_10"></div>
                    
                    <strong>$C<span class="the_R">R</span>NRSTN_debugMode = 1</strong><br>
                    Activates real-time error trace logging output that will be sent to the default error logging location 
                    via PHP native error_log(). No log data is aggregated for delayed output via method invocation; 
                    <span class="phpvar_copy">$oC<span class="the_R">R</span>NRSTN_USR->get_error_log_trace()</span> 
                    will have no log data to return. Please note that ALL log 
                    silo data will be in the output unless n+1 pipe delimited silo key(s) are provided to the 
                    C<span class="the_R">R</span>NRSTN :: constructor. In this case, only error trace log data aligning to 
                    the provided silo key(s) (or the \'*\' silo key...same as NULL) will be sent to the PHP native 
                    error_log() method for output. This would be useful if one desires to inspect trace logs for a 
                    particular section of the application that possesses its own unique silo key. Log silo that are keyed 
                    with a \'*\' character...which also includes NULL log silo parameter...will ALWAYS be traced for 
                    error_log() output.
                    <br>
                    <strong style="font-size:95%;">NOTE ::</strong> Minimal memory & some additional processing overhead 
                    performance requirements can be expected.
                    <div class="cb_10"></div>
                    
                    <strong>$C<span class="the_R">R</span>NRSTN_debugMode = 2</strong><br>
                    100% error trace logging with rolling aggregation TO THE END of the running process. Provides 
                    controlled (invoked by method only) access to aggregated (and always chronologically presented) 
                    trace log data for any pipe delimited log silo key(s) passed to 
                    C<span class="the_R">R</span>NRSTN :: method(s) for log output. See methods such as 
                    <span class="phpvar_copy">$oC<span class="the_R">R</span>NRSTN_USR->get_error_log_trace()</span>. 
                    If ANY piped silo key(s) have been provided to the 
                    C<span class="the_R">R</span>NRSTN :: constructor, only that/those key(s) will be aggregated (and 
                    hence, available for output), and all other keyed log silo data will be ignored. This does not 
                    pertain to silo key of \'*\'...which also includes NULL log silo parameter; i.e. \'*\' log silo 
                    trace data will ALWAYS be aggregated and/or returned. Any aggregated log trace data will also be 
                    appended to any C<span class="the_R">R</span>NRSTN :: system exception notification...e.g. EMAIL 
                    or write to custom FILE output.
                    <br>
                    <strong style="font-size:95%;">NOTE ::</strong> Maximum memory and additional processing overhead 
                    requirements can be expected.
                    ';

                    $tmp_param_def[2]['param_datatype'] = 'int';
                    $tmp_param_def[2]['param_name'] = '$C<span class="the_R">R</span>NRSTN_debugMode';
                    $tmp_param_def[2]['param_definition'] = $tmp_str;
                    $tmp_param_def[2]['param_required'] = false;

                    $tmp_str = 'Debug output level for PHPMAILER - A full-featured email creation and transfer class for 
                    PHP which has been refactored into C<span class="the_R">R</span>NRSTN :: and which debug output is 
                    bubbled up through the C<span class="the_R">R</span>NRSTN :: error trace logging layer.
                    <div class="cb_5"></div>
                    <strong>$PHPMAILER_debug_mode = 0</strong> No debug output, default<br>
                    <strong>$PHPMAILER_debug_mode = 1</strong> Client commands<br>
                    <strong>$PHPMAILER_debug_mode = 2</strong> Client commands and server responses<br>
                    <strong>$PHPMAILER_debug_mode = 3</strong> As DEBUG_SERVER plus connection status<br>
                    <span style="color:#F00;"><strong>$PHPMAILER_debug_mode = 4</strong> Low-level data output, all 
                    messages (including exposure of usernames and passwords!!)</span>
                    <div class="cb_5"></div>
                    <span style="color:#F00;"><strong>!!CAUTION :: $PHPMAILER_debug_mode = 4 WILL expose all SMTP 
                    usernames and passwords to the C<span style="color:#000;">R</span>NRSTN :: debug layer which 
                    includes browser accessible output modes of SCREEN_TEXT, SCREEN or SCREEN_HTML, and 
                    SCREEN_HTML_HIDDEN!!</strong></span>';

                    $tmp_param_def[3]['param_datatype'] = 'int';
                    $tmp_param_def[3]['param_name'] = '$PHPMAILER_debug_mode';
                    $tmp_param_def[3]['param_definition'] = $tmp_str;
                    $tmp_param_def[3]['param_required'] = false;

                    $tmp_str = 'To limit ALL error log trace activity across the entire application to hand 
                    selected C<span class="the_R">R</span>NRSTN error log silo key(s), include the desired key(s) 
                    within a pipe delimited string to the C<span class="the_R">R</span>NRSTN :: constructor as the 
                    <span class="phpvar_copy">$C<span class="the_R">R</span>NRSTN_log_silo_key_piped parameter</span>. 
                    Only the provided keys will be 
                    processed. If an exclusion profile for C<span class="the_R">R</span>NRSTN error log silo output 
                    is desired, prefix any log silo key with \'~\' in order to exclude that key from error log trace 
                    output across the entire application.
                    <div class="cb_10"></div>
                    
                    When critical areas of an application need to be monitored in the background for exception error 
                    log trace or bubbled to the surface during real-time development and QA, the 
                    C<span class="the_R">R</span>NRSTN Suite :: has a properly robust error_log() method which allows 
                    for the strategic placement of "meta-data rich" application run-time log trace comments 
                    throughout the code base. Due to the limitations of reviewing error logs via file traversal 
                    within a terminal, it can be desired to effectively trim back error log trace output from all 
                    areas of an application which are NOT under review. This would leave error log trace data from 
                    the area(s) of interest front and center for more ready review through a terminal, for example. 
                    Enter stage left...C<span class="the_R">R</span>NRSTN :: Log Silos. By passing, as a parameter, 
                    a relevant-to-the-purpose-at-hand key at the end of each invocation of the 
                    $oC<span class="the_R">R</span>NRSTN_USR->error_log() method (such as, e.g., \'USER_SIGNIN\' for 
                    all error log trace relevant to user login use cases within an application), one can effectively 
                    drive the logging trace profile of the entire application from the 
                    C<span class="the_R">R</span>NRSTN :: constructor and/or any method within 
                    C<span class="the_R">R</span>NRSTN :: (such as $oC<span class="the_R">R</span>NRSTN_USR->get_error_log_trace()) 
                    which exposes log trace data by including just the silo key(s) of interest...or excluding via 
                    prefix of a \'~\' silo key(s) from perhaps more verbose sections of the application which 
                    effectively bloat the error log trace data and are cumbersome to dig through in order to find 
                    the relatively scant trace data currently under investigation.';

                    $tmp_param_def[4]['param_datatype'] = 'string';
                    $tmp_param_def[4]['param_name'] = '$log_silo_key_piped';
                    $tmp_param_def[4]['param_definition'] = $tmp_str;
                    $tmp_param_def[4]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','Returns an object instantiation of the C<span class="the_R">R</span>NRSTN :: class.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'A vanilla instantiation of the C<span class="the_R">R</span>NRSTN :: class object within the C<span class="the_R">R</span>NRSTN :: configuration file. ';
                    $tmp_example_presentation_file = '/common/inc/examples/config_file_crnrstn_instance_show.php';
                    $tmp_example_execute_file = '';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/configuration_file/addenvironment/':
                    $tmp_categ_name = 'Configuration File';
                    $tmp_subcateg_name = 'Configuration File';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'addEnvironment()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $tmp_str = 'The core competency of the C<span class="the_R">R</span>NRSTN Suite :: lay in its ability to seamlessly 
                    articulate environmentally unique data profiles of an application across multiple hosting environments and thereby with 
                    strength and precision joining the &quot;wall of server&quot; to the &quot;wall of application&quot;. From localhost 
                    to production, all hosting environments with their unique data profiles can be represented and managed from within a 
                    single configuration file.
                    <div class="cb_10"></div>
                    
                    The addEnvironment() method configures the C<span class="the_R">R</span>NRSTN Suite :: to acknowledge the existence of 
                    each specified hosting environment. Each of the (n+1) environments within which one wishes to run an application needs 
                    to be conveyed to the C<span class="the_R">R</span>NRSTN Suite :: through the addEnvironment() method where each 
                    environment is represented by a unique key, <span class="phpvar_copy">$env_key</span>.
                    <div class="cb_10"></div>
                    
                    In development and hosting shops which (either by force or choice) apply mature release to manufacture (RTM) protocols to 
                    their development life cycles, the application migration characteristics supported by the C<span class="the_R">R</span>NRSTN Suite :: are certainly 
                    the status quo. One goal in the development of the C<span class="the_R">R</span>NRSTN Suite :: has been to allow for 
                    said rigid RTM requirements to be met effectively and elegantly with as little performance overhead as possible. ';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY', $tmp_str);
                    //$this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue. ');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','addEnvironment($env_key, $errorReporting)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_datatype'] = 'string';
                    $tmp_param_def[0]['param_name'] = '$env_key';
                    $tmp_param_def[0]['param_definition'] = 'A custom user-defined value representing a specific environment 
                    within which this application will be running and which key will be used throughout this 
                    configuration file + any C<span class="the_R">R</span>NRSTN :: resource includes in order to align 
                    the necessary functionality and resources to said environment to support the seamless migration of the same 
                    code base across all environments.';
                    $tmp_param_def[0]['param_required'] = true;

                    $tmp_str = 'The desired error reporting profile for the specified hosting environment. Here are some common error reporting constants as presented by PHP.NET:<br>
                    <blockquote>
                    <ul style="list-style-type: square;">
                        <li><strong><span class="the_R">E_ALL</span></strong> (Show all errors, warnings and notices including coding standards.)</li>
                        <li><strong><span class="the_R">E_ALL</span> & <span class="the_R">~E_NOTICE</span></strong> (Show all errors, except for notices)</li>
                        <li><strong><span class="the_R">E_ALL</span> & <span class="the_R">~E_NOTICE</span> & <span class="the_R">~E_STRICT</span></strong> (Show all errors, except for notices and coding standards warnings.)</li>
                        <li><strong><span class="the_R">E_COMPILE_ERROR</span>|<span class="the_R">E_RECOVERABLE_ERROR</span>|<span class="the_R">E_ERROR</span>|<span class="the_R">E_CORE_ERROR</span></strong> (Show only errors)</li>
                    </ul>
                    </blockquote>
                    <div class="cb_10"></div>
                    Some error reporting profiles, for example:<br>
                    <strong>Default Value:</strong> <span class="the_R"><strong>E_ALL</strong></span> & <span class="the_R"><strong>~E_NOTICE</strong></span> & <span class="the_R"><strong>~E_STRICT</strong></span> & <span class="the_R"><strong>~E_DEPRECATED</strong></span><br>
                    <strong>Development Value:</strong> <span class="the_R"><strong>E_ALL</strong></span><br>
                    <strong>Production Value:</strong> <span class="the_R"><strong>E_ALL</strong></span> & <span class="the_R"><strong>~E_DEPRECATED</strong></span> & <span class="the_R"><strong>~E_STRICT</strong></span><br>';

                    $tmp_param_def[1]['param_datatype'] = 'int';
                    $tmp_param_def[1]['param_name'] = '$errorReporting';
                    $tmp_param_def[1]['param_definition'] = $tmp_str;
                    $tmp_param_def[1]['param_required'] = true;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE', $return_true_str);

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Within this demo C<span class="the_R">R</span>NRSTN :: configuration file, four (4) environments are added on lines 24-27.';
                    $tmp_example_presentation_file = '/common/inc/examples/addEnvironment_show.php';
                    $tmp_example_execute_file = '';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/configuration_file/init_crnrstn_aserrorhandler/':
                    $tmp_categ_name = 'Configuration File';
                    $tmp_subcateg_name = 'Configuration File';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'init_CRNRSTN_asErrorHandler()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $tmp_str = 'Passing value of TRUE (or NULL) for <span class="phpvar_copy">$isActive</span> will 
                    give C<span class="the_R">R</span>NRSTN :: and the currently embryonic configuration of its error log trace 
                    handling jurisdiction over all levels of error, from E_ERROR to E_USER_DEPRECATED. <strong>This 
                    effectively makes <em>everything</em> an exception.</strong>
                    <div class="cb_10"></div>
                    The second parameter, <span class="phpvar_copy">$errorTypesProfile</span>, will allow for 
                    customization of the error handling profile for C<span class="the_R">R</span>NRSTN :: to 
                    fine tune the PHP error level constants that C<span class="the_R">R</span>NRSTN Suite :: error log 
                    trace and exception handling will process by providing the desired profile of error level integer 
                    constants as this parameter. Feel free to use bit flips, and not (&amp; ~), etc.
                    <div class="cb_10"></div>
                    This error handling can (or will) be reset to PHP defaults and then reconfigured per the environmentally 
                    relevant error handling profile set through the C<span class="the_R">R</span>NRSTN configuration file 
                    method call of <span class="phpvar_copy">set_C<span class="the_R">R</span>NRSTN_asErrorHandler()</span>.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY', $tmp_str);

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','init_C<span class="the_R">R</span>NRSTN_asErrorHandler($isActive = true, $errorTypesProfile=NULL)');

                    $tmp_param_def = array();
                    $tmp_str = 'Passing the value of TRUE (or NULL) will give C<span class="the_R">R</span>NRSTN :: and 
                    the current configuration of its error log trace handling jurisdiction over all levels of error, 
                    from E_ERROR to E_USER_DEPRECATED. This effectively makes everything an exception. Passing the value 
                    of false (or simply ommiting this method call) indicates that C<span class="the_R">R</span>NRSTN :: is to only handle properly thrown 
                    exceptions. In this case, errors will be handled by PHP natively.';

                    $tmp_param_def[0]['param_datatype'] = 'boolean';
                    $tmp_param_def[0]['param_name'] = '$isActive';
                    $tmp_param_def[0]['param_definition'] = $tmp_str;
                    $tmp_param_def[0]['param_required'] = false;

                    $tmp_str = 'Configure the error level constants that should (or should not) be handled by PHP, 
                    natively...and, therefore provide definition...with specificity...for the jurisdiction of 
                    C<span class="the_R">R</span>NRSTN :: with respect to throw/error handling. Fine tune what 
                    C<span class="the_R">R</span>NRSTN :: error log trace and exception handling will process by 
                    providing the desired profile of error level integer constants as this parameter. Feel free to 
                    use bit flips, and not (&amp; ~), etc.';

                    $tmp_param_def[1]['param_datatype'] = 'int';
                    $tmp_param_def[1]['param_name'] = '$errorTypesProfile';
                    $tmp_param_def[1]['param_definition'] = $tmp_str;
                    $tmp_param_def[1]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE', $return_true_str);

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'In the following demonstration, within the 
                    C<span class="the_R">R</span>NRSTN :: configuration file, 
                    C<span class="the_R">R</span>NRSTN :: is set to be the error handler for everything except the 
                    error level constant, E_USER_DEPRECATED on line 33. This error handling profile will persist for 
                    the life of the process unless PHP native method, 
                    <span class="phpvar_copy">restore_error_handler()</span>, or 
                    <span class="phpvar_copy">set_C<span class="the_R">R</span>NRSTN_asErrorHandler()</span> is 
                    called for the running environment.';
                    $tmp_example_presentation_file = '/common/inc/examples/init_CRNRSTN_asErrorHandler_show.php';
                    $tmp_example_execute_file = '';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                    break;
                case '/suite_methods/configuration_file/set_crnrstn_as_err_handler/':
                    $tmp_categ_name = 'Configuration File';
                    $tmp_subcateg_name = 'Configuration File';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'set_crnrstn_as_err_handler()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $tmp_str = 'For each environment, passing the value of TRUE (or NULL) for <span class="phpvar_copy">$isActive</span> will 
                    give C<span class="the_R">R</span>NRSTN :: and the current configuration of its error log trace 
                    handling jurisdiction over all levels of error, from E_ERROR to E_USER_DEPRECATED within that 
                    environment. <strong>This effectively makes <em>everything</em> an exception.</strong> 
                    <div class="cb_10"></div>
                    The second parameter, <span class="phpvar_copy">$errorTypesProfile</span>, will allow for 
                    customization of the error handling profile for C<span class="the_R">R</span>NRSTN :: to 
                    fine tune the PHP error level constants that C<span class="the_R">R</span>NRSTN Suite :: error log 
                    trace and exception handling will process. Provide the desired profile of error level integer 
                    constants via this parameter. Feel free to use bit flips, and not (&amp; ~), etc.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY', $tmp_str);

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','set_C<span class="the_R">R</span>NRSTN_asErrorHandler($env_key, $isActive = true, $errorTypesProfile=NULL)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_datatype'] = 'string';
                    $tmp_param_def[0]['param_name'] = '$env_key';
                    $tmp_param_def[0]['param_definition'] = 'A custom user-defined value representing a specific environment 
                    within which this application will be running and which key will be used throughout this 
                    configuration file + any C<span class="the_R">R</span>NRSTN :: resource includes in order to align 
                    the necessary functionality and resources to said environment to support the seamless migration of the same 
                    code base across all environments.';
                    $tmp_param_def[0]['param_required'] = true;

                    $tmp_str = 'Passing the value of TRUE (or NULL) will give C<span class="the_R">R</span>NRSTN :: and 
                    the current configuration of its error log trace handling jurisdiction over all levels of error, 
                    from E_ERROR to E_USER_DEPRECATED. This effectively makes everything an exception. Passing the value 
                    of false (or simply ommiting this method call) indicates that C<span class="the_R">R</span>NRSTN :: is to only handle properly thrown 
                    exceptions. In this case, errors will be handled by PHP natively.';

                    $tmp_param_def[1]['param_datatype'] = 'boolean';
                    $tmp_param_def[1]['param_name'] = '$isActive';
                    $tmp_param_def[1]['param_definition'] = $tmp_str;
                    $tmp_param_def[1]['param_required'] = false;

                    $tmp_str = 'Configure the error level constants that should (or should not) be handled by PHP, 
                    natively...and, therefore provide definition...with specificity...for the jurisdiction of 
                    C<span class="the_R">R</span>NRSTN :: with respect to throw/error handling. Fine tune what 
                    C<span class="the_R">R</span>NRSTN :: error log trace and exception handling will process by 
                    providing the desired profile of error level integer constants as this parameter. Feel free to 
                    use bit flips, and not (&amp; ~), etc.';

                    $tmp_param_def[2]['param_datatype'] = 'int';
                    $tmp_param_def[2]['param_name'] = '$errorTypesProfile';
                    $tmp_param_def[2]['param_definition'] = $tmp_str;
                    $tmp_param_def[2]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE', $return_true_str);

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'In the following demonstration, within the 
                    C<span class="the_R">R</span>NRSTN :: configuration file, C<span class="the_R">R</span>NRSTN :: 
                    is set, on a per environment basis (lines 39-42), to be the error handler according to a 
                    particular error level constant profile. The environment set on line 42 will keep the error 
                    handling profile applied during the initialization and configuration of 
                    C<span class="the_R">R</span>NRSTN ::...which said error handling profile was processed on line 33 of this example. ';
                    $tmp_example_presentation_file = '/common/inc/examples/set_crnrstn_as_err_handler_show.php';
                    $tmp_example_execute_file = '';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/configuration_file/initsystemnoticesimagesmode/':
                    $tmp_categ_name = 'Configuration File';
                    $tmp_subcateg_name = 'Configuration File';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'initSystemNoticesImagesMode()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $tmp_str = 'Configure the HTML email image handling profile for C<span class="the_R">R</span>NRSTN :: system notifications.';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY', $tmp_str);

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','initSystemNoticesImagesMode($mode=\'ALL_HTML\')');

                    $tmp_param_def = array();
                    $tmp_str = 'Available options for HTML email creative include:<br>
                    <blockquote>
                    <ul style="list-style-type: square;">
                        <li><strong>ALL_IMAGE</strong> = Inject all creative within HTML system messages as &lt;img&gt; with hosted URI src.</li>
                        <li><strong>ALL_HTML</strong> = Show all creative within HTML system messages as HTML formatted table.</li>
                        <li><strong>ALL_IMAGE_LOGO_OFF</strong> = Load all (but not the CRNRSTN :: logo) creative within HTML system
                        messages as proper &lt;img&gt; with hosted URI src.</li>
                        <li><strong>ALL_HTML_LOGO_OFF</strong> = Show all (but not the CRNRSTN :: logo) creative within HTML system
                        messages as HTML formatted table.</li>
                    </ul>
                    </blockquote>
';

                    $tmp_param_def[0]['param_datatype'] = 'string';
                    $tmp_param_def[0]['param_name'] = '$mode';
                    $tmp_param_def[0]['param_definition'] = $tmp_str;
                    $tmp_param_def[0]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE', $return_true_str);

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'In the following demo CRNRSTN :: configuration file, HTML formatted 
                    email sent via system notifications are given the profile to use HTML code as a stand-in for proper
                    &lt;img&gt; creative on line 46';
                    $tmp_example_presentation_file = '/common/inc/examples/initsystemnoticesimagesmode_show.php';
                    $tmp_example_execute_file = '';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY', '<div class="section_title">Example 2 ::</div>');
                    $tmp_str = 'When C<span class="the_R">R</span>NRSTN :: has been configured to handle exceptions, 
                    here is an example of one such system notification with the HTML email creative:<br><br><img src="' . $this->oCRNRSTN->crnrstn_http_endpoint() . 'common/imgs/sys_notice_demo.png" width="571" height="677" alt="CRNRSTN ' . $this->oCRNRSTN->version_crnrstn . ' :: System Notification" title="CRNRSTN ' . $this->oCRNRSTN->version_crnrstn . ' :: System Notification">';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY', $tmp_str);


                break;
                case '/suite_methods/configuration_file/init_sys_comm_img_HTTP_DIR/':
                    $tmp_categ_name = 'Configuration File';
                    $tmp_subcateg_name = 'Configuration File';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'init_sys_comm_img_HTTP_DIR()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $tmp_str = 'Configure a public IP image directory hosting endpoint (HTTP URI) for each environment 
                    to support HTML images in email (if configured via 
                    <span class="phpvar_copy">initSystemNoticesImagesMode()</span>) within 
                    C<span class="the_R">R</span>NRSTN :: system notifications. Be mindful of pulling non-SSL encrypted 
                    data into email sent from an IP which has a cert on the box (SSL). Many email clients will 
                    complain.';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY', $tmp_str);

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','init_sys_comm_img_HTTP_DIR($env_key, $crnrstn_images_http_dir)');

                    $tmp_param_def = array();
                    $tmp_str = 'A custom user-defined value representing a specific environment within which this 
                    application will be running and which key will be used throughout this configuration file + any 
                    C<span class="the_R">R</span>NRSTN :: resource includes in order to align the necessary 
                    functionality and resources to said environment to support the seamless migration of the same 
                    code base across all environments.';

                    $tmp_param_def[0]['param_datatype'] = 'string';
                    $tmp_param_def[0]['param_name'] = '$env_key';
                    $tmp_param_def[0]['param_definition'] = $tmp_str;
                    $tmp_param_def[0]['param_required'] = true;

                    $tmp_str = 'A publically accessible HTTP/S endpoint according to which 
                    the C<span class="the_R">R</span>NRSTN :: email creative assets are hosted and can thus be 
                    accessed by any email client.';
                    $tmp_param_def[1]['param_datatype'] = 'string';
                    $tmp_param_def[1]['param_name'] = '$crnrstn_images_http_dir';
                    $tmp_param_def[1]['param_definition'] = $tmp_str;
                    $tmp_param_def[1]['param_required'] = true;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE', $return_true_str);

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'In the following demonstration of a 
                    C<span class="the_R">R</span>NRSTN :: configuration file, it has been determined to use a single
                    public IP to host C<span class="the_R">R</span>NRSTN :: system notification creative for all 
                    configured environments.';
                    $tmp_example_presentation_file = '/common/inc/examples/init_sys_comm_img_HTTP_DIR_show.php';
                    $tmp_example_execute_file = '';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY', '<div class="section_title">Example 2 ::</div>');
                    $tmp_str = 'When C<span class="the_R">R</span>NRSTN :: has been configured to handle exceptions, 
                    here is an example of one such system notification with the HTML email creative:<br><br><img src="' . $this->oCRNRSTN->crnrstn_http_endpoint() . 'common/imgs/sys_notice_demo.png" width="571" height="677" alt="CRNRSTN ' . $this->oCRNRSTN->version_crnrstn . ' :: System Notification" title="CRNRSTN ' . $this->oCRNRSTN->version_crnrstn . ' :: System Notification">';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY', $tmp_str);

                break;
                case '/suite_methods/configuration_file/initresourcewildcards/':
                    $tmp_categ_name = 'Configuration File';
                    $tmp_subcateg_name = 'Configuration File';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'initResourceWildCards()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $tmp_str = 'Wild card resource (WCR) objects are custom resources defined within the 
                    application to meet the need of more robust data requirements within an OOP context wherein which 
                    one would otherwise be forced to call several different methods or pass 9+ parameters into a 
                    single method in order to aggregate the necessary data to meet the need at hand. WCR data is 
                    accessed through a common method (a method also used to access the C<span class="the_R">R</span>NRSTN :: configuration\'s 
                    defined environmental resources) which simplifies the development process. The WCR objects can be 
                    defined in-line, but this side-steps the built-in C<span class="the_R">R</span>NRSTN :: environmental detection for 
                    environmentally specific WCR objects. However, one could still respect environmental alignment through the 
                    use of 1) switch() or other conditional statements and 2) methods such 
                    as: <span class="phpvar_copy">$oC<span class="the_R">R</span>NRSTN_USR->isCurrentEnvironment(\'LOCALHOST_MACBOOKPRO\')</span>, which will return 
                    boolean TRUE for successful match between the C<span class="the_R">R</span>NRSTN :: configuration 
                    of the running environment and the provided key, \'LOCALHOST_MACBOOKPRO\'. Also, there is  
                    <span class="phpvar_copy">$oC<span class="the_R">R</span>NRSTN_USR->currentEnvironment()</span>, 
                    which could return a string such as \'LOCALHOST_MACBOOKPRO\' 
                    representing the key of the current running environment to indicate what WCR to define and instantiate. ';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY', $tmp_str);

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','initResourceWildCards($env_key, $filepathWildCardResource)');

                    $tmp_param_def = array();
                    $tmp_str = 'A custom user-defined value representing a specific environment within which this 
                    application will be running and which key will be used throughout this configuration file + any 
                    C<span class="the_R">R</span>NRSTN :: resource includes in order to align the necessary 
                    functionality and resources to said environment to support the seamless migration of the same 
                    code base across all environments.';

                    $tmp_param_def[0]['param_datatype'] = 'string';
                    $tmp_param_def[0]['param_name'] = '$env_key';
                    $tmp_param_def[0]['param_definition'] = $tmp_str;
                    $tmp_param_def[0]['param_required'] = true;

                    $tmp_str = 'The full local directory path to the include file, 
                    <span class="phpvar_copy">_crnrstn.resource_wildcards.inc.php</span>, which ships with 
                    C<span class="the_R">R</span>NRSTN ::. This file can be found within 
                    <span class="phpvar_copy">\'/config.resource_wildcards.secure/\'</span>';

                    $tmp_param_def[1]['param_name'] = '$filepathWildCardResource';
                    $tmp_param_def[1]['param_definition'] = $tmp_str;
                    $tmp_param_def[1]['param_required'] = true;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','TRUE on success or FALSE on error, e.g. for invalid file path.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'For each environment configured within this C<span class="the_R">R</span>NRSTN :: 
                    configuration file, on lines 57-60, a path to a Wild Card Resource (WCR) definition file is provided. Only 
                    the WCR objects that are defined for the running environment are instantiated and stored within a multi-dimensional object array. 
                    WCR objects can also be defined in-line at the location of implementation throughout the code base 
                    of the application if desired. Of course, every environment would then have the potential to 
                    instantiate the same object...even if it is an environmentally specific resource. Use of methods such 
                    as <span class="phpvar_copy">currentEnvironment()</span> and 
                    <span class="phpvar_copy">isCurrentEnvironment()</span> can still provide a back door to environmentally 
                    aware resource utilization to persist data in memory or session...responsibly.';
                    $tmp_example_presentation_file = '/common/inc/examples/initresourcewildcards_show.php';
                    $tmp_example_execute_file = '';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/configuration_file/initlogging/':
                    $tmp_categ_name = 'Configuration File';
                    $tmp_subcateg_name = 'Configuration File';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'initLogging()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Configure the server error 
                    logging notifications profile for each environment. EMAIL_PROXY requires an endpoint which also has 
                    been configured with a C<span class="the_R">R</span>NRSTN :: error logging notifications profile. This 
                    endpoint can be the same server responsible for generating the original request, if desired.');
                    //$this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue. ');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS', 'crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','initLogging($env_key, $loggingProfilePipe=NULL, $loggingEndpointPipe=NULL, $wcrProfilePipe=NULL)');

                    $tmp_param_def = array();
                    $tmp_str = 'A custom user-defined value representing a specific environment within which this 
                    application will be running and which key will be used throughout this configuration file + any 
                    C<span class="the_R">R</span>NRSTN :: resource includes in order to align the necessary 
                    functionality and resources to said environment to support the seamless migration of the same 
                    code base across all environments.';

                    $tmp_param_def[0]['param_datatype'] = 'string';
                    $tmp_param_def[0]['param_name'] = '$env_key';
                    $tmp_param_def[0]['param_definition'] = $tmp_str;
                    $tmp_param_def[0]['param_required'] = true;

                    $tmp_str = 'Provide a pipe delimited string of the logging profiles that should be applied to meet 
                    the system logging requirements for each environment. Available profiles that can be queued in 
                    place include:<br>
                    <blockquote>
                    <ul style="list-style: square;">
                    <li><strong>EMAIL</strong> = Send error logging through email at running server. This requires 
                    honoring a templated WCR for email configuration (SMTP, QMAIL, PHPMAILER, or SENDMAIL) within the 
                    running environment.</li>
                    <li><strong>EMAIL_PROXY</strong> = Send error logging through the C<span class="the_R">R</span>NRSTN :: SOAP 
                    services layer to a proxy server endpoint (WSDL) for email send by the proxy server. This requires 
                    honoring a WCR template for SOAP integration at the requesting server, and a templated WCR for 
                    email configuration (SMTP, QMAIL, PHPMAILER, or SENDMAIL) within the proxy environment to 
                    support message delivery at the proxy.</li>
                    <li><strong>FILE</strong> = Send error logging to a custom file at a path provided. Data will be write 
                    appended to the provided file, and if the file does not exist, an attempt will be made to create it.</li>
                    <li><strong>SCREEN_TEXT</strong> = Return error logging to screen (e.g. echo...) using basic character
                    return sequence (i.e. \n).</li>
                    <li><strong>SCREEN</strong> or <strong>SCREEN_HTML</strong> = Send error logging output to screen 
                    (e.g. echo...) with support for HTML DOM rendering of line breaks (e.g. &lt;br&gt;).</li>
                    <li><strong>SCREEN_HTML_HIDDEN</strong> = Send error logging output to screen (e.g. echo...) with 
                    support for HTML DOM rendering of hidden browser content (e.g. &lt;!-- hidden error data here --&gt;).
                    <li><strong>DEFAULT</strong> (or NULL) = Send error logging output through native PHP error_log() 
                    method for default system handling.</li>
                    </ul>
                    </blockquote>';

                    $tmp_param_def[1]['param_datatype'] = 'string';
                    $tmp_param_def[1]['param_name'] = '$loggingProfilePipe';
                    $tmp_param_def[1]['param_definition'] = $tmp_str;
                    $tmp_param_def[1]['param_required'] = false;

                    $tmp_str = '<span class="phpvar_copy">$loggingEndpointPipe</span> and 
                    <span class="phpvar_copy">$loggingProfilePipe</span> (above) should have the same number of 
                    piped values wherein which keys such as EMAIL, EMAIL_PROXY and FILE that have additional data 
                    dependencies needing to be met can be satisfied. There needs to be the same number of 
                    pipes...even for NULL data...for all three (3) piped string params, <span class="phpvar_copy">$loggingProfilePipe</span>, 
                    <span class="phpvar_copy">$loggingEndpointPipe</span> and 
                    <span class="phpvar_copy">$wcrProfilePipe</span>. For example:<br>
                     <blockquote>
                     <ul style="list-style: square">
                     <li>If <span class="phpvar_copy">$loggingProfilePipe</span>=\'EMAIL\', then <span class="phpvar_copy">$loggingEndpointPipe</span>=\'fname lname email1@email.com, 
                     email2@email.com, fname lname email3@email.com\' and <span class="phpvar_copy">$wcrProfilePipe</span>=\'MY_EMAIL_AUTH_TEMPLATE_WCR_KEY\'</li>
                     <li>If <span class="phpvar_copy">$loggingProfilePipe</span>=\'EMAIL_PROXY\', then 
                     <span class="phpvar_copy">$loggingEndpointPipe</span>=\'fname lname email1@email.com, 
                     email2@email.com, fname lname email3@email.com\' and <span class="phpvar_copy">$wcrProfilePipe</span>=\'MY_EMAIL_AUTH_TEMPLATE_WCR_KEY\'</li>
                     <li>If <span class="phpvar_copy">$loggingProfilePipe</span>=\'FILE\', then 
                     <span class="phpvar_copy">$loggingEndpointPipe</span>=\'/a/full_path/to_the_file/for_log_append/customerror.log.\'
                      and <span class="phpvar_copy">$wcrProfilePipe</span>=\'\'</li>
                    </ul>
                     </blockquote><br>
                    When everything is put together, a <span class="phpvar_copy">$loggingProfilePipe</span> 
                    of \'EMAIL|DEFAULT|FILE\' to send error log trace data to 1) email, 2) PHP\'s native error_log(), and 
                    3) a custom output file...simultaneously would produce something like as follows for 
                    <span class="phpvar_copy">$loggingEndpointPipe</span>:<br>
                     <blockquote>
                     <ul style="list-style: square">
                     <li>\'Optional-FName1 Optional-LName1 email_01@email.com, email_02@email.com||/var/log/_dev_debug_output/custom_error.log\'</li> 
                     </ul>
                     </blockquote>
                     ';

                    $tmp_param_def[2]['param_datatype'] = 'string';
                    $tmp_param_def[2]['param_name'] = '$loggingEndpointPipe';
                    $tmp_param_def[2]['param_definition'] = $tmp_str;
                    $tmp_param_def[2]['param_required'] = false;

                    $tmp_str = '<span class="phpvar_copy">$wcrProfilePipe</span> should have the same number of pipes 
                    as the above <span class="phpvar_copy">$loggingEndpointPipe</span> and 
                    <span class="phpvar_copy">$loggingProfilePipe</span>.<br>
                    <blockquote>
                    <ul style="list-style: square">
                    <li>Wherein the <span class="phpvar_copy">$loggingEndpointPipe</span> is EMAIL, <span class="phpvar_copy">$wcrProfilePipe</span> should contain a 
                    key which aligns to a templated C<span class="the_R">R</span>NRSTN :: WCR object for email 
                    configuration and authentication.</li>
                    <li>Wherein the <span class="phpvar_copy">$loggingEndpointPipe</span> is EMAIL_PROXY, <span class="phpvar_copy">$wcrProfilePipe</span> should contain a 
                    key which aligns to a templated C<span class="the_R">R</span>NRSTN :: WCR object for CRNRSTN :: SOAP 
                    Services Layer integration.</li>
                    <li>Wherein the <span class="phpvar_copy">$loggingEndpointPipe</span> is SCREEN_TEXT, SCREEN, SCREEN_HTML, SCREEN_HTML_HIDDEN, FILE, or DEFAULT, 
                    <span class="phpvar_copy">$wcrProfilePipe</span> should honor the piped position, but be empty.</li>
                    </ul></blockquote> ';

                    $tmp_param_def[3]['param_datatype'] = 'string';
                    $tmp_param_def[3]['param_name'] = '$wcrProfilePipe';
                    $tmp_param_def[3]['param_definition'] = $tmp_str;
                    $tmp_param_def[3]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE', $return_true_str);

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'On lines 64-67 of this demonstrative C<span class="the_R">R</span>NRSTN :: 
                    configuration file, four (4) environments are configured to handle error log notifications per 
                    their own logging profile. ';
                    $tmp_example_presentation_file = '/common/inc/examples/initlogging_show.php';
                    $tmp_example_execute_file = '';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/configuration_file/adddatabase/':
                    $tmp_categ_name = 'Configuration File';
                    $tmp_subcateg_name = 'Configuration File';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'addDatabase()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue. ');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_definition'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile. ';
                    $tmp_param_def[0]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/configuration_file/grantexclusiveaccess/':
                    $tmp_categ_name = 'Configuration File';
                    $tmp_subcateg_name = 'Configuration File';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'grantExclusiveAccess()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue. ');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_definition'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile. ';
                    $tmp_param_def[0]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/configuration_file/denyaccess/':
                    $tmp_categ_name = 'Configuration File';
                    $tmp_subcateg_name = 'Configuration File';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'denyAccess()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue. ');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_definition'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile. ';
                    $tmp_param_def[0]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/configuration_file/initsessionencryption/':
                    $tmp_categ_name = 'Configuration File';
                    $tmp_subcateg_name = 'Configuration File';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'init_session_encryption()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue. ');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_definition'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile. ';
                    $tmp_param_def[0]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/configuration_file/initcookieencryption/':
                    $tmp_categ_name = 'Configuration File';
                    $tmp_subcateg_name = 'Configuration File';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'init_cookie_encryption()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue. ');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_definition'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile. ';
                    $tmp_param_def[0]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/configuration_file/inittunnelencryption/':
                    $tmp_categ_name = 'Configuration File';
                    $tmp_subcateg_name = 'Configuration File';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'init_tunnel_encryption()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue. ');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_definition'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/configuration_file/requireddetectionmatches/':
                    $tmp_categ_name = 'Configuration File';
                    $tmp_subcateg_name = 'Configuration File';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'requiredDetectionMatches()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_definition'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/configuration_file/defineenvresource/':
                    $tmp_categ_name = 'Configuration File';
                    $tmp_subcateg_name = 'Configuration File';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'defineEnvResource()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_definition'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;

                case '/suite_methods/logging/':
                    $tmp_categ_name = 'Logging';
                    $tmp_subcateg_name = 'Logging';                     # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = '';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_definition'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/logging/error_log/':
                    $tmp_categ_name = 'Logging';
                    $tmp_subcateg_name = 'Logging';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'error_log()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_definition'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/basic_functionality/':
                    $tmp_categ_name = 'Basic Functionality';
                    $tmp_subcateg_name = 'Basic Functionality';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = '';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_definition'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/basic_functionality/getenvresource/':
                    $tmp_categ_name = 'Basic Functionality';
                    $tmp_subcateg_name = 'Basic Functionality';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'get_resource()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_definition'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/basic_functionality/return_ocrnrstn_env/':
                    $tmp_categ_name = 'Basic Functionality';
                    $tmp_subcateg_name = 'Basic Functionality';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'return_oCRNRSTN_ENV()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_definition'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/basic_functionality/isset_server_param/':
                    $tmp_categ_name = 'Basic Functionality';
                    $tmp_subcateg_name = 'Basic Functionality';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'isset_SERVER_param()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_definition'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/basic_functionality/get_server_param/':
                    $tmp_categ_name = 'Basic Functionality';
                    $tmp_subcateg_name = 'Basic Functionality';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'get_SERVER_param()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_definition'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/basic_functionality/highlightcode/':
                    $tmp_categ_name = 'Basic Functionality';
                    $tmp_subcateg_name = 'Basic Functionality';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'highlightCode()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_definition'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/basic_functionality/highlighttext/':
                    $tmp_categ_name = 'Basic Functionality';
                    $tmp_subcateg_name = 'Basic Functionality';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'highlight_text()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_definition'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/basic_functionality/generatenewkey/':
                    $tmp_categ_name = 'Basic Functionality';
                    $tmp_subcateg_name = 'Basic Functionality';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'generate_new_key()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_definition'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/basic_functionality/create_adhocvar/':
                    $tmp_categ_name = 'Basic Functionality';
                    $tmp_subcateg_name = 'Basic Functionality';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'create_AdHocVar()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_definition'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/basic_functionality/get_adhocvar/':
                    $tmp_categ_name = 'Basic Functionality';
                    $tmp_subcateg_name = 'Basic Functionality';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'get_AdHocVar()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_definition'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/device_detection/':
                    $tmp_categ_name = 'Device Detection';
                    $tmp_subcateg_name = 'Device Detection';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = '';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);
                    //error_log('43 css - serial=' .self::$page_serial);
                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','When it is desired to determine what type of client is making a request to the server, version 2.0.0 of the C<span class="the_R">R</span>NRSTN Suite provides a rich set of crnrstn_user :: class object methods for device detection, session persistence of said device detection results, and the reversion of session data back to a state of agnosticism wherein which C<span class="the_R">R</span>NRSTN can start from "zero" again with respect to meeting the needs of any given use-case scenario.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','This functionality stands on top of the <a href="http://mobiledetect.net/" target="_blank">Mobile Detect</a> project which has been incorporated into C<span class="the_R">R</span>NRSTN Suite v2.0.0. <a href="http://mobiledetect.net/" target="_blank">Mobile Detect</a> is a lightweight PHP class for detecting mobile devices (including tablets). It uses the User-Agent string combined with specific HTTP headers to detect the mobile environment. <a href="http://mobiledetect.net/" target="_blank">Mobile Detect</a> is sponsored by it\'s developers and community, and they send thanks to the JetBrains team for providing <a href="https://www.jetbrains.com/phpstorm/" target="_blank">PHPStorm</a> and <a href="https://www.jetbrains.com/datagrip/" target="_blank">DataGrip</a> licenses for said project.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/device_detection/isclientmobile/':
                    $tmp_categ_name = 'Device Detection';
                    $tmp_subcateg_name = 'Device Detection';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'isClientMobile()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','For the purposes of supporting front-end and back-end functional use case requirements which walk lock-step with the need to accurately determine client device type from the server-side, C<span class="the_R">R</span>NRSTN Suite :: v2.0.0 incorporates into itself an active and developer supported open source PHP project, <a href="http://mobiledetect.net/" target="_blank">Mobile Detect</a>, in order to leverage the deep specialization of that project in the areas of mobile device and tablet computer detection over HTTP/S. isClientMobile() will enable the running application to cater to the experience of an end-user request coming from the mobile (and also tablet) device channel.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','This functionality stands on top of the <a href="http://mobiledetect.net/" target="_blank">Mobile Detect</a> project which has been incorporated into C<span class="the_R">R</span>NRSTN Suite v2.0.0. <a href="http://mobiledetect.net/" target="_blank">Mobile Detect</a> is a lightweight PHP class for detecting mobile devices (including tablets). It uses the User-Agent string combined with specific HTTP headers to detect the mobile environment. <a href="http://mobiledetect.net/" target="_blank">Mobile Detect</a> is sponsored by it\'s developers and community, and they send thanks to the JetBrains team for providing <a href="https://www.jetbrains.com/phpstorm/" target="_blank">PHPStorm</a> and <a href="https://www.jetbrains.com/datagrip/" target="_blank">DataGrip</a> licenses for said project.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_definition'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/device_detection/isclienttablet/':
                    $tmp_categ_name = 'Device Detection';
                    $tmp_subcateg_name = 'Device Detection';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'isClientTablet()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','For the purposes of supporting front-end and back-end functional use case requirements which walk lock-step with the need to accurately determine client device type from the server-side, C<span class="the_R">R</span>NRSTN Suite :: v2.0.0 incorporates into itself an active and developer supported open source PHP project, <a href="http://mobiledetect.net/" target="_blank">Mobile Detect</a>, in order to leverage the deep specialization of that project in the areas of mobile device and tablet computer detection over HTTP/S. isClientTablet() will enable the running application to cater to the experience of an end-user request coming from the tablet (and also mobile) device channel.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','This functionality stands on top of the <a href="http://mobiledetect.net/" target="_blank">Mobile Detect</a> project which has been incorporated into C<span class="the_R">R</span>NRSTN Suite v2.0.0. <a href="http://mobiledetect.net/" target="_blank">Mobile Detect</a> is a lightweight PHP class for detecting mobile devices (including tablets). It uses the User-Agent string combined with specific HTTP headers to detect the mobile environment. <a href="http://mobiledetect.net/" target="_blank">Mobile Detect</a> is sponsored by it\'s developers and community, and they send thanks to the JetBrains team for providing <a href="https://www.jetbrains.com/phpstorm/" target="_blank">PHPStorm</a> and <a href="https://www.jetbrains.com/datagrip/" target="_blank">DataGrip</a> licenses for said project.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','isClientTablet($mobileIsTablet=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$mobileIsTablet';
                    $tmp_param_def[0]['param_definition'] = 'Boolean value where TRUE indicates that mobile devices should be treated as tablet computer and where FALSE only allows identified-as-tablet user-agent and HTTP headers to qualify as tablet.';
                    $tmp_param_def[0]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isTablet\'</em> on successful tablet match. <em>\'isMobile\'</em> will be returned, however, if $mobileIsTablet is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a mobile device. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientTablet_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientTablet_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/device_detection/isclientmobilecustom/':
                    $tmp_categ_name = 'Device Detection';
                    $tmp_subcateg_name = 'Device Detection';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'isClientMobileCustom()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','For the purposes of supporting front-end and back-end functional use case requirements which walk lock-step with the need to accurately determine client device type from the server-side, C<span class="the_R">R</span>NRSTN Suite :: v2.0.0 incorporates into itself an active and developer supported open source PHP project, <a href="http://mobiledetect.net/" target="_blank">Mobile Detect</a>, in order to leverage the deep specialization of that project in the areas of mobile device and tablet computer detection over HTTP/S. isClientMobileCustom() will enable the running application to cater to the experience of an end-user request coming from the mobile/tablet device channel.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','This functionality stands on top of the <a href="http://mobiledetect.net/" target="_blank">Mobile Detect</a> project which has been incorporated into C<span class="the_R">R</span>NRSTN Suite v2.0.0. <a href="http://mobiledetect.net/" target="_blank">Mobile Detect</a> is a lightweight PHP class for detecting mobile devices (including tablets). It uses the User-Agent string combined with specific HTTP headers to detect the mobile environment. <a href="http://mobiledetect.net/" target="_blank">Mobile Detect</a> is sponsored by it\'s developers and community, and they send thanks to the JetBrains team for providing <a href="https://www.jetbrains.com/phpstorm/" target="_blank">PHPStorm</a> and <a href="https://www.jetbrains.com/datagrip/" target="_blank">DataGrip</a> licenses for said project.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','isClientMobileCustom($target_device=NULL)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$target_device';
                    $tmp_param_def[0]['param_definition'] = 'A string value representing a particular algorithm to be used to look for a specific mobile device or tablet computer platform. For a list of supported algorithms, you can check out the <a href="http://demo.mobiledetect.net/" target="_blank">Mobile Detect Demo</a>. While there, <strong>please feel free to help them improve the mobile detection algorithms by choosing an appropriate answer from the small user experience feedback form on that demo page. This will help to make future releases of <a href="http://mobiledetect.net/" target="_blank">Mobile Detect</a> more robust and accurate for everyone...and the C<span class="the_R">R</span>NRSTN Suite ::</strong> They are listed here as well. As of Mobile Detect v2.8.34, the custom detection methods are listed as: 
isiPhone(), isBlackBerry(), isHTC(), isNexus(), isDell(), isMotorola(), isSamsung(), isLG(), isSony(), isAsus(), isNokiaLumia(), isMicromax(), isPalm(), isVertu(), isPantech(), isFly(), isWiko(), isiMobile(), isSimValley(), isWolfgang(), isAlcatel(), isNintendo(), isAmoi(), isINQ(), isOnePlus(), isGenericPhone(), isiPad(), isNexusTablet(), isGoogleTablet(), isSamsungTablet(), isKindle(), isSurfaceTablet(), isHPTablet(), isAsusTablet(), isBlackBerryTablet(), isHTCtablet(), isMotorolaTablet(), isNookTablet(), isAcerTablet(), isToshibaTablet(), isLGTablet(), isFujitsuTablet(), isPrestigioTablet(), isLenovoTablet(), isDellTablet(), isYarvikTablet(), isMedionTablet(), isArnovaTablet(), isIntensoTablet(), isIRUTablet(), isMegafonTablet(), isEbodaTablet(), isAllViewTablet(), isArchosTablet(), isAinolTablet(), isNokiaLumiaTablet(), isSonyTablet(), isPhilipsTablet(), isCubeTablet(), isCobyTablet(), isMIDTablet(), isMSITablet(), isSMiTTablet(), isRockChipTablet(), isFlyTablet(), isbqTablet(), isHuaweiTablet(), isNecTablet(), isPantechTablet(), isBronchoTablet(), isVersusTablet(), isZyncTablet(), isPositivoTablet(), isNabiTablet(), isKoboTablet(), isDanewTablet(), isTexetTablet(), isPlaystationTablet(), isTrekstorTablet(), isPyleAudioTablet(), isAdvanTablet(), isDanyTechTablet(), isGalapadTablet(), isMicromaxTablet(), isKarbonnTablet(), isAllFineTablet(), isPROSCANTablet(), isYONESTablet(), isChangJiaTablet(), isGUTablet(), isPointOfViewTablet(), isOvermaxTablet(), isHCLTablet(), isDPSTablet(), isVistureTablet(), isCrestaTablet(), isMediatekTablet(), isConcordeTablet(), isGoCleverTablet(), isModecomTablet(), isVoninoTablet(), isECSTablet(), isStorexTablet(), isVodafoneTablet(), isEssentielBTablet(), isRossMoorTablet(), isiMobileTablet(), isTolinoTablet(), isAudioSonicTablet(), isAMPETablet(), isSkkTablet(), isTecnoTablet(), isJXDTablet(), isiJoyTablet(), isFX2Tablet(), isXoroTablet(), isViewsonicTablet(), isVerizonTablet(), isOdysTablet(), isCaptivaTablet(), isIconbitTablet(), isTeclastTablet(), isOndaTablet(), isJaytechTablet(), isBlaupunktTablet(), isDigmaTablet(), isEvolioTablet(), isLavaTablet(), isAocTablet(), isMpmanTablet(), isCelkonTablet(), isWolderTablet(), isMediacomTablet(), isMiTablet(), isNibiruTablet(), isNexoTablet(), isLeaderTablet(), isUbislateTablet(), isPocketBookTablet(), isKocasoTablet(), isHisenseTablet(), isHudl(), isTelstraTablet(), isGenericTablet(), isAndroidOS(), isBlackBerryOS(), isPalmOS(), isSymbianOS(), isWindowsMobileOS(), isWindowsPhoneOS(), isiOS(), isiPadOS(), isMeeGoOS(), isMaemoOS(), isJavaOS(), iswebOS(), isbadaOS(), isBREWOS(), isChrome(), isDolfin(), isOpera(), isSkyfire(), isEdge(), isIE(), isFirefox(), isBolt(), isTeaShark(), isBlazer(), isSafari(), isWeChat(), isUCBrowser(), isbaiduboxapp(), isbaidubrowser(), isDiigoBrowser(), isMercury(), isObigoBrowser(), isNetFront(), isGenericBrowser(), and isPaleMoon().';
                    $tmp_param_def[0]['param_required'] = true;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','Returns boolean TRUE if the algorithm aligns to the connecting client device or FALSE for no match.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve BOOLEAN response as an indication of the existence of conditions which confirm or deny that this is a request originating from a mobile device or tablet computer matching the provided algorithm.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobileCustom_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobileCustom_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/device_detection/setclientmobile/':
                    $tmp_categ_name = 'Device Detection';
                    $tmp_subcateg_name = 'Device Detection';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'setClientMobile()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Due to the fact that the C<span class="the_R">R</span>NRSTN Suite :: was engineered to sit so "low level" in the grand scheme of an application...sitting directly on top of the running $_SERVER environment and hooking into it at run time, it is necessary to provide functionality that will support the manual/brute force "straight lining" or persisting of the client\'s mobile device identity for the duration of their session (or until resetDeviceDetect() is appropriately called). Otherwise...for example, a mobile device or tablet user (maybe coming to the site from a link in an email) who clicks a link within the LAMP application to view the "desktop version" will still be met with whatever mobile device experience has been prepared in the application...with no way to change their stars. SO SAD! Enter stage left, setClientMobile(). This method forcefully pushes mobile device indicators to the C<span class="the_R">R</span>NRSTN managed session of said user, so that...regardless of their device or activity within the application...the user may receive the experience that they desire without any cursing and frustration. Hooray!!');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','setClientMobile()');

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','TRUE');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Set the client\'s sesson profile in the C<span class="the_R">R</span>NRSTN Suite :: to indicate that they are a mobile device.';
                    $tmp_example_presentation_file = '/common/inc/examples/setClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/setClientMobile_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/device_detection/setclienttablet/':
                    $tmp_categ_name = 'Device Detection';
                    $tmp_subcateg_name = 'Device Detection';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'setClientTablet()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Due to the fact that the C<span class="the_R">R</span>NRSTN Suite :: was engineered to sit so "low level" in the grand scheme of an application...sitting directly on top of the running $_SERVER environment and hooking into it at run time, it is necessary to provide functionality that will support the manual/brute force "straight lining" or persisting of the client\'s mobile device identity for the duration of their session (or until resetDeviceDetect() is appropriately called). Otherwise...for example, a mobile device or tablet user (maybe coming to the site from a link in an email) who clicks a link within the LAMP application to view the "desktop version" will still be met with whatever mobile device experience has been prepared in the application...with no way to change their stars. SO SAD! Enter stage left, setClientTablet(). This method forcefully pushes tablet computer indicators to the C<span class="the_R">R</span>NRSTN managed session of said user, so that...regardless of their device or activity within the application...the user may receive the experience that they desire without any cursing and frustration. Hooray!!');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','setClientTablet()');

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','TRUE');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Set the client\'s sesson profile in the C<span class="the_R">R</span>NRSTN Suite :: to indicate that they are a tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/setClientTablet_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/setClientTablet_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/device_detection/setclientmobilecustom/':
                    $tmp_categ_name = 'Device Detection';
                    $tmp_subcateg_name = 'Device Detection';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'setClientMobileCustom()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Due to the fact that the C<span class="the_R">R</span>NRSTN Suite :: was engineered to sit so "low level" in the grand scheme of an application...sitting directly on top of the running $_SERVER environment and hooking into it at run time, it is necessary to provide functionality that will support the manual/brute force "straight lining" or persisting of the client\'s mobile device identity for the duration of their session (or until resetDeviceDetect() is appropriately called). Otherwise...for example, a mobile device or tablet user (maybe coming to the site from a link in an email) who clicks a link within the LAMP application to view the "desktop version" will still be met with whatever mobile device experience has been prepared in the application...with no way to change their stars. SO SAD! Enter stage left, setClientMobileCustom(). This method forcefully pushes a custom device profile indicator to the C<span class="the_R">R</span>NRSTN managed session of said user, so that...regardless of their device or activity within the application...the user may receive the experience that is desired for them without them needing to provide any cursing and frustration along the way. Hooray!!');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','setClientMobileCustom($target_device=NULL)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$target_device';
                    $tmp_param_def[0]['param_definition'] = 'A string value representing a particular algorithm to be used to look for a specific mobile device or tablet computer platform. For a list of supported algorithms, you can check out the <a href="http://demo.mobiledetect.net/" target="_blank">Mobile Detect Demo</a>. While there, <strong>please feel free to help them improve the mobile detection algorithms by choosing an appropriate answer from the small user experience feedback form on that demo page. This will help to make future releases of <a href="http://mobiledetect.net/" target="_blank">Mobile Detect</a> more robust and accurate for everyone...and the C<span class="the_R">R</span>NRSTN Suite ::</strong> They are listed here as well. As of Mobile Detect v2.8.34, the custom detection methods are listed as: 
isiPhone(), isBlackBerry(), isHTC(), isNexus(), isDell(), isMotorola(), isSamsung(), isLG(), isSony(), isAsus(), isNokiaLumia(), isMicromax(), isPalm(), isVertu(), isPantech(), isFly(), isWiko(), isiMobile(), isSimValley(), isWolfgang(), isAlcatel(), isNintendo(), isAmoi(), isINQ(), isOnePlus(), isGenericPhone(), isiPad(), isNexusTablet(), isGoogleTablet(), isSamsungTablet(), isKindle(), isSurfaceTablet(), isHPTablet(), isAsusTablet(), isBlackBerryTablet(), isHTCtablet(), isMotorolaTablet(), isNookTablet(), isAcerTablet(), isToshibaTablet(), isLGTablet(), isFujitsuTablet(), isPrestigioTablet(), isLenovoTablet(), isDellTablet(), isYarvikTablet(), isMedionTablet(), isArnovaTablet(), isIntensoTablet(), isIRUTablet(), isMegafonTablet(), isEbodaTablet(), isAllViewTablet(), isArchosTablet(), isAinolTablet(), isNokiaLumiaTablet(), isSonyTablet(), isPhilipsTablet(), isCubeTablet(), isCobyTablet(), isMIDTablet(), isMSITablet(), isSMiTTablet(), isRockChipTablet(), isFlyTablet(), isbqTablet(), isHuaweiTablet(), isNecTablet(), isPantechTablet(), isBronchoTablet(), isVersusTablet(), isZyncTablet(), isPositivoTablet(), isNabiTablet(), isKoboTablet(), isDanewTablet(), isTexetTablet(), isPlaystationTablet(), isTrekstorTablet(), isPyleAudioTablet(), isAdvanTablet(), isDanyTechTablet(), isGalapadTablet(), isMicromaxTablet(), isKarbonnTablet(), isAllFineTablet(), isPROSCANTablet(), isYONESTablet(), isChangJiaTablet(), isGUTablet(), isPointOfViewTablet(), isOvermaxTablet(), isHCLTablet(), isDPSTablet(), isVistureTablet(), isCrestaTablet(), isMediatekTablet(), isConcordeTablet(), isGoCleverTablet(), isModecomTablet(), isVoninoTablet(), isECSTablet(), isStorexTablet(), isVodafoneTablet(), isEssentielBTablet(), isRossMoorTablet(), isiMobileTablet(), isTolinoTablet(), isAudioSonicTablet(), isAMPETablet(), isSkkTablet(), isTecnoTablet(), isJXDTablet(), isiJoyTablet(), isFX2Tablet(), isXoroTablet(), isViewsonicTablet(), isVerizonTablet(), isOdysTablet(), isCaptivaTablet(), isIconbitTablet(), isTeclastTablet(), isOndaTablet(), isJaytechTablet(), isBlaupunktTablet(), isDigmaTablet(), isEvolioTablet(), isLavaTablet(), isAocTablet(), isMpmanTablet(), isCelkonTablet(), isWolderTablet(), isMediacomTablet(), isMiTablet(), isNibiruTablet(), isNexoTablet(), isLeaderTablet(), isUbislateTablet(), isPocketBookTablet(), isKocasoTablet(), isHisenseTablet(), isHudl(), isTelstraTablet(), isGenericTablet(), isAndroidOS(), isBlackBerryOS(), isPalmOS(), isSymbianOS(), isWindowsMobileOS(), isWindowsPhoneOS(), isiOS(), isiPadOS(), isMeeGoOS(), isMaemoOS(), isJavaOS(), iswebOS(), isbadaOS(), isBREWOS(), isChrome(), isDolfin(), isOpera(), isSkyfire(), isEdge(), isIE(), isFirefox(), isBolt(), isTeaShark(), isBlazer(), isSafari(), isWeChat(), isUCBrowser(), isbaiduboxapp(), isbaidubrowser(), isDiigoBrowser(), isMercury(), isObigoBrowser(), isNetFront(), isGenericBrowser(), and isPaleMoon().';
                    $tmp_param_def[0]['param_required'] = true;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','TRUE');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Set the client\'s sesson profile in the C<span class="the_R">R</span>NRSTN Suite :: to indicate that they are a very specific kind of device/computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/setClientMobileCustom_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/setClientMobileCustom_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/device_detection/resetdevicedetect/':
                    $tmp_categ_name = 'Device Detection';
                    $tmp_subcateg_name = 'Device Detection';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'resetDeviceDetect()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Due to the fact that the C<span class="the_R">R</span>NRSTN Suite :: was engineered to sit so "low level" in the grand scheme of an application...sitting directly on top of the running $_SERVER environment and hooking into it at run time, it is necessary to provide functionality that will support the manual/brute force "straight lining" or persisting of the client\'s mobile device identity for the duration of their session (or until resetDeviceDetect() is appropriately called). Otherwise...for example, a mobile device or tablet user (maybe coming to the site from a link in an email) who clicks another link within the LAMP application to view the "desktop version" will still be met with whatever mobile device experience has been prepared in the application...with no way to change their stars. SO SAD! It stands to be said, therefore, that there was no choice but to create resetDeviceDetect() as a reversion enabling component for the device detection functionality within the C<span class="the_R">R</span>NRSTN Suite :: wherein mobile device/tablet computer profile data...which has been pushed to the session for persistence with the user\'s experience...can thereupon be reset, and the user\'s experience in the application can return to "zero" to re-open opportunity for the persistence of other (read as "desktop") use-case scenarios.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','resetDeviceDetect()');

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','TRUE');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Set the client\'s sesson profile in the C<span class="the_R">R</span>NRSTN Suite :: to indicate that they are a mobile device. We then use resetDeviceDetect() on Line 20 to return to "zero" so that the user can still access the desktop version (literally,...in this case) of the C<span class="the_R">R</span>NRSTN Suite :: documentation site.<br><br>resetDeviceDetect() needs only to be called if setClientMobile(), setClientTablet(), or setClientMobileCustom() are called, and there is the desire to reset the user\'s session in order to reopen opportunity for desktop experiences within the application in the same user session.';
                    $tmp_example_presentation_file = '/common/inc/examples/resetDeviceDetect_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/resetDeviceDetect_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/web_services/':
                    $tmp_categ_name = 'Web Services';
                    $tmp_subcateg_name = 'Web Services';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = '';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_definition'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/web_services/returncontent/':
                    $tmp_categ_name = 'Web Services';
                    $tmp_subcateg_name = 'Web Services';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'returnContent()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_definition'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/web_services/returnfault/':
                    $tmp_categ_name = 'Web Services';
                    $tmp_subcateg_name = 'Web Services';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'returnFault()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_definition'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/web_services/returnerror/':
                    $tmp_categ_name = 'Web Services';
                    $tmp_subcateg_name = 'Web Services';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'returnError()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_definition'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/web_services/returnresult/':
                    $tmp_categ_name = 'Web Services';
                    $tmp_subcateg_name = 'Web Services';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'returnResult()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_definition'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/web_services/returnclientrequest/':
                    $tmp_categ_name = 'Web Services';
                    $tmp_subcateg_name = 'Web Services';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'returnClientRequest()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_definition'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/web_services/returnclientresponse/':
                    $tmp_categ_name = 'Web Services';
                    $tmp_subcateg_name = 'Web Services';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'returnClientResponse()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_definition'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/web_services/returnclientgetdebug/':
                    $tmp_categ_name = 'Web Services';
                    $tmp_subcateg_name = 'Web Services';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'returnClientGetDebug()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_definition'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/date_time/':
                    $tmp_categ_name = 'Date Time';
                    $tmp_subcateg_name = 'Date Time';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = '';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_definition'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/date_time/elapsedtimemonitorfor/':
                    $tmp_categ_name = 'Date Time';
                    $tmp_subcateg_name = 'Date Time';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'elapsedTimeMonitorFor()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_definition'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/date_time/prettydeltatime/':
                    $tmp_categ_name = 'Date Time';
                    $tmp_subcateg_name = 'Date Time';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'prettyDeltaTime()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_definition'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/date_time/walltime/':
                    $tmp_categ_name = 'Date Time';
                    $tmp_subcateg_name = 'Date Time';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'wall_time()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_definition'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/ip_address/':
                    $tmp_categ_name = 'IP Address';
                    $tmp_subcateg_name = 'IP Address';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = '';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_definition'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/ip_address/returnclientip/':
                    $tmp_categ_name = 'IP Address';
                    $tmp_subcateg_name = 'IP Address';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'return_client_ip()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_definition'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/ip_address/exclusiveaccess/':
                    $tmp_categ_name = 'IP Address';
                    $tmp_subcateg_name = 'IP Address';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'exclusiveAccess()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_definition'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/ip_address/denyipaccess/':
                    $tmp_categ_name = 'IP Address';
                    $tmp_subcateg_name = 'IP Address';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'denyIPAccess()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_definition'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/http_management/':
                    $tmp_categ_name = 'HTTP Management';
                    $tmp_subcateg_name = 'HTTP Management';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = '';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_definition'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/http_management/isset_transport_protocol/':
                    $tmp_categ_name = 'HTTP Management';
                    $tmp_subcateg_name = 'HTTP Management';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'isset_transport_protocol()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_definition'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/http_management/isset_http_param/':
                    $tmp_categ_name = 'HTTP Management';
                    $tmp_subcateg_name = 'HTTP Management';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'isset_http_param()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_definition'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/http_management/extract_http_paramvalue/':
                    $tmp_categ_name = 'HTTP Management';
                    $tmp_subcateg_name = 'HTTP Management';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'extract_HTTP_paramValue()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_definition'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/http_management/return_http_headers/':
                    $tmp_categ_name = 'HTTP Management';
                    $tmp_subcateg_name = 'HTTP Management';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'return_HTTP_headers()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_definition'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/cookie_management/':
                    $tmp_categ_name = 'Cookie Management';
                    $tmp_subcateg_name = 'Cookie Management';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = '';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_definition'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/cookie_management/addcookie/':
                    $tmp_categ_name = 'Cookie Management';
                    $tmp_subcateg_name = 'Cookie Management';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'addCookie()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_definition'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/cookie_management/addrawcookie/':
                    $tmp_categ_name = 'Cookie Management';
                    $tmp_subcateg_name = 'Cookie Management';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'addRawCookie()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_definition'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/cookie_management/getcookie/':
                    $tmp_categ_name = 'Cookie Management';
                    $tmp_subcateg_name = 'Cookie Management';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'getCookie()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_definition'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/cookie_management/deletecookie/':
                    $tmp_categ_name = 'Cookie Management';
                    $tmp_subcateg_name = 'Cookie Management';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'deleteCookie()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_definition'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/cookie_management/deleteallcookies/':
                    $tmp_categ_name = 'Cookie Management';
                    $tmp_subcateg_name = 'Cookie Management';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'deleteAllCookies()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_definition'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/session_management/':
                    $tmp_categ_name = 'Session Management';
                    $tmp_subcateg_name = 'Session Management';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = '';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_definition'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/session_management/getsessionparam/':
                    $tmp_categ_name = 'Session Management';
                    $tmp_subcateg_name = 'Session Management';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'getSessionParam()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_definition'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/session_management/setsessionparam/':
                    $tmp_categ_name = 'Session Management';
                    $tmp_subcateg_name = 'Session Management';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'setSessionParam()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_definition'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/session_management/issetsessionparam/':
                    $tmp_categ_name = 'Session Management';
                    $tmp_subcateg_name = 'Session Management';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'issetSessionParam()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_definition'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/tunnel_encryption/':

                    $tmp_categ_name = 'HTTP Encryption Tunneling';
                    $tmp_subcateg_name = 'HTTP Encryption Tunneling';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = '';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Application security and data hygiene can be <strong>significantly enhanced</strong> with the basic and consistent (only as strong as the weakest link) utilization of the C<span class="the_R">R</span>NRSTN Suite v2.0.0 and its encryption tunneling protocols. Sending data safely server to server (e.g. SOAP) and 
between the server and client can be achieved with minimal effort and maximum data integrity through the strategic application of this functionality across all data touch points within your application(s). I have some apps where all data contained within hidden form fields is encrypted. When I have foreign keys appended to a link that will go directly into the hidden fields of a form...and then directly into my database!!..I will NOT spend additional server resources to confirm their accuracy <strong>before the MySQL INSERT</strong> by racking up extra and peripheral MySQL database hits. If the data is corrupted in the link, param_tunnel_decrypt() will throw an exception that can be handled with grace before the face of the end user (which could be my boss), and the database will only receive bona fide clean data.');

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','There are many encryption algorithms available...even version to version (or configuration) of PHP...and they have different requirements as far as the processing resources (memory) needed for them to execute. Before <strong>globally</strong> applying a layer of encryption to a high traffic application, it is recommended that some baseline performance metrics be established and that at least some load testing be performed to ensure that the chosen encrypt/decrypt algorithm will not cause debilitating (e.g. leading to significant site response lag or crash) spikes in the resource requirements of the overall application.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Send data to hidden fields of a form or append variables to a link after 1) passing the raw data through data_encrypt() and 2) receiving in return a unique and encrypted string that can be used in the form or link and then taken to point of insertion and decrypted at that location before..for example...a MySQL database INSERT. Be creative to save time and your effort; you can even append several sensitive parameters together (delimited by pipe, comma, ampersand, etc.), encrypt the entire string, and send it to where you need it before decryption and further processing to conclusion. For <a href="https://www.youtube.com/watch?v=LZosMwonEPM" target="_blank">just one second</a>, imagine ALL links in your site...apparently...having only one (1) variable (the name of which never changes) at the end.;)  Please note, objects and arrays are a couple of data structures that CANNOT BE ENCRYPTED (but...who puts an object in a hidden text input field of a form anyways, right?).';
                    $tmp_example_presentation_file = '/common/inc/examples/data_encrypt_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/data_encrypt_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/tunnel_encryption/param_tunnel_encrypt/':

                    $tmp_categ_name = 'HTTP Encryption Tunneling';
                    $tmp_subcateg_name = 'HTTP Encryption Tunneling';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'param_tunnel_encrypt()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Application security and data hygiene can be <strong>significantly enhanced</strong> with the basic and consistent (only as strong as the weakest link) utilization of the C<span class="the_R">R</span>NRSTN Suite v2.0.0 and its encryption tunneling protocols. Sending data safely server to server (e.g. SOAP) and between the server and client can be achieved with minimal effort and maximum data integrity through the strategic application of this functionality across all data touch points within your application(s). I have some apps where all data contained within hidden form fields is encrypted. When I have foreign keys appended to a link that will go directly into the hidden fields of a form...and then directly into my database!!..I will NOT spend additional server resources to confirm their accuracy <strong>before the MySQL INSERT</strong> by racking up extra and peripheral MySQL database hits. If the data is corrupted in the link, param_tunnel_decrypt() will throw an exception that can be handled with grace before the face of the end user (which could be my boss), and the database will only receive bona fide clean data.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','There are many encryption algorithms available...even version to version (or configuration) of PHP...and they have different requirements as far as the processing resources (memory) needed for them to execute. Before <strong>globally</strong> applying a layer of encryption to a high traffic application, it is recommended that some baseline performance metrics be established and that at least some load testing be performed to ensure that the chosen encrypt/decrypt algorithm will not cause debilitating (e.g. leading to significant site response lag or crash) spikes in the resource requirements of the overall application.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';
                    $tmp_spec_array[2] = 'Some hash_algos() returned methods will NOT be compatible with hash_hmac() which C<span class="the_R">R</span>NRSTN Suite :: v2.0.0 uses in validating its decryption. And certain openssl encryption cipher / hash_algos algorithm combinations will not be compatible. Please test the compatibility of your desired combination of encryption cipher and hmac algoritm for each environment...especially before releasing to production code base.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','param_tunnel_encrypt($data=NULL, $cipher_override=NULL, $secret_key_override=NULL)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$data';
                    $tmp_param_def[0]['param_definition'] = 'The data that is to be encrypted. Please note, only string, integer, double, float, int data types will be successfully processed. All other data types will return NULL.';
                    $tmp_param_def[0]['param_required'] = true;

                    $tmp_param_def[1]['param_name'] = '$secret_key';
                    $tmp_param_def[1]['param_definition'] = 'If it is desired to override the environmentally specific and globally applied openssl-encryption-key passed into init_tunnel_encryption(), this parameter will be used in place of the openssl encryption key provided there in the C<span class="the_R">R</span>NRSTN Suite :: configuration file for all of the environments within which the application code base will be running.';
                    $tmp_param_def[1]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','The raw data in an encrypted format or NULL on error...i.e. if the data is not able to be encrypted.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Send data to hidden fields of a form or append variables to a link after 1) passing the raw data through param_tunnel_encrypt() and 2) receiving in return a unique and encrypted string that can be used in the form or link and then taken to point of insertion and decrypted at that location before..for example...a MySQL database INSERT. Be creative to save time and your effort; you can even append several sensitive parameters together (delimited by pipe, comma, ampersand, etc.), encrypt the entire string, and send it to where you need it before decryption and further processing to conclusion. For <a href="https://www.youtube.com/watch?v=LZosMwonEPM" target="_blank">just one second</a>, imagine ALL links in your site...apparently...having only one (1) variable (the name of which never changes) at the end.;)  Please note, objects and arrays are a couple of data structures that CANNOT BE ENCRYPTED (but...who puts an object in a hidden text input field of a form anyways, right?).';
                    $tmp_example_presentation_file = '/common/inc/examples/param_tunnel_encrypt_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/param_tunnel_encrypt_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/tunnel_encryption/param_tunnel_decrypt/':

                    $tmp_categ_name = 'HTTP Encryption Tunneling';
                    $tmp_subcateg_name = 'HTTP Encryption Tunneling';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'param_tunnel_decrypt()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Application security and data hygiene can be <strong>significantly enhanced</strong> with the basic and consistent (only as strong as the weakest link) utilization of the C<span class="the_R">R</span>NRSTN Suite v2.0.0 and its encryption tunneling protocols. Sending data safely server to server (e.g. SOAP) and 
between the server and client can be achieved with minimal effort and maximum data integrity through the strategic application of this functionality across all data touch points within your application(s). I have some apps where all data contained within hidden form fields is encrypted. When I have foreign keys appended to a link that will go directly into the hidden fields of a form...and then directly into my database!!..I will NOT spend additional server resources to confirm their accuracy <strong>before the MySQL INSERT</strong> by racking up extra and peripheral MySQL database hits. If the data is corrupted in the link, param_tunnel_decrypt() will throw an exception that can be handled with grace before the face of the end user (which could be my boss), and the database will only receive bona fide clean data.');

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','There are many encryption algorithms available...even version to version (or configuration) of PHP...and they have different requirements as far as the processing resources (memory) needed for them to execute. Before <strong>globally</strong> applying a layer of encryption to a high traffic application, it is recommended that some baseline performance metrics be established and that at least some load testing be performed to ensure that the chosen encrypt/decrypt algorithm will not cause debilitating (e.g. leading to significant site response lag or crash) spikes in the resource requirements of the overall application.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';
                    $tmp_spec_array[2] = 'Some hash_algos() returned methods will NOT be compatible with hash_hmac() which C<span class="the_R">R</span>NRSTN Suite :: v2.0.0 uses in validating its decryption. And certain openssl encryption cipher / hash_algos algorithm combinations will not be compatible. Please test the compatibility of your desired combination of encryption cipher and hmac algorithm for each environment...especially before releasing to production code base.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','param_tunnel_decrypt($data=NULL, $uri_passthrough=false, $cipher_override=NULL, $secret_key_override=NULL)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$data';
                    $tmp_param_def[0]['param_definition'] = 'The data that is to be encrypted. Please note, only <em>string</em>, <em>integer</em>, <em>double</em>, <em>float</em>, and <em>int</em> data types will be successfully processed. All other data types will return NULL.';
                    $tmp_param_def[0]['param_required'] = true;

                    $tmp_param_def[1]['param_name'] = '$uri_passthrough';
                    $tmp_param_def[1]['param_definition'] = 'When openssl tunnel encrypted data is sent through GET, this should be TRUE. Due to the character sets <a href="https://www.youtube.com/watch?v=217CdX7Z2tM" target="_blank">emerging</a> from many openssl encryption algorithms, it is necessary to clean the string before successful decryption can be accomplished. Otherwise, an exception will be thrown. Therefore, this is actually a required parameter when the data tunnel mechanism is HTTP/S GET.';
                    $tmp_param_def[1]['param_required'] = false;

                    $tmp_param_def[2]['param_name'] = '$secret_key';
                    $tmp_param_def[2]['param_definition'] = 'If it is desired to override the environmentally specific and globally applied openssl-encryption-key passed into init_tunnel_encryption(), this parameter will be used in place of the openssl encryption key provided there in the C<span class="the_R">R</span>NRSTN Suite :: configuration file for all of the environments within which the application code base will be running.';
                    $tmp_param_def[2]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','The raw data in an encrypted format or NULL on error...i.e. if the data is not able to be encrypted.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Send data to hidden fields of a form or append variables to a link after 1) passing the raw data through param_tunnel_encrypt() and 2) receiving in return a unique and encrypted string that can be used in the form or link and then taken to point of insertion and decrypted at that location before..for example...a MySQL database INSERT. Be creative to save time and your effort; you can even append several sensitive parameters together (delimited by pipe, comma, ampersand, etc.), encrypt the entire string, and send it to where you need it before decryption and further processing to conclusion. For <a href="https://www.youtube.com/watch?v=LZosMwonEPM" target="_blank">just one second</a>, imagine ALL links in your site...apparently...having only one (1) variable (the name of which never changes) at the end. ;)  Please note, objects and arrays are a couple of data structures that CANNOT BE ENCRYPTED (but...who puts an object in a hidden text input field of a form anyways, right?).';
                    $tmp_example_presentation_file = '/common/inc/examples/param_tunnel_decrypt_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/param_tunnel_decrypt_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/tunnel_encryption/istunnelencryptconfigured/':
                    $tmp_categ_name = 'HTTP Encryption Tunneling';
                    $tmp_subcateg_name = 'HTTP Encryption Tunneling';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'isTunnelEncryptConfigured()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_definition'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/mysql_database/':
                    $tmp_categ_name = 'MySQL Database Query/Response';
                    $tmp_subcateg_name = 'MySQL Database Query/Response';      # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = '';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','If your application touches n+1 database instances, the C<span class="the_R">R</span>NRSTN :: Suite v2.0.0 is going to be the release wherein you would want to fully sign on. In v1.0.0, C<span class="the_R">R</span>NRSTN :: laid a solid foundation for database support with its responsible and intelligent n+1 database connection management and mysqli batching of SQL request submissions to the database. However, as far as how to store and recall the data returned through said database connection(s)...this huge burden was still left to the whims of the wild wild west of web development.<br><br>Enter C<span class="the_R">R</span>NRSTN :: Suite v2.0.0! Territory has been expanded FAR BEYOND the database connection management and request delivery methods (which simply "send the query") boundaries. Requests will be batched together (per each connection), and...new to v2.0.0...micro-batches of query requests to the database connection can be carved out if desired. All query results are aggregated into and persisted by C<span class="the_R">R</span>NRSTN ::, and there are plans are for future releases to be able to cache any desired results (or query) to SESSION for persistence...and this is with seamless access to the "same" result set through the same methods. With query cache management will come configurable TTL restrictions for this result set data in session. <br><br>Currently in C<span class="the_R">R</span>NRSTN :: Suite v2.0.0, all results can be de-normalized (in memory) on up to 10 simultaneous fields (at the same time) to facilitate direct pointer lookup of result set values. One can also check for the existence of a result set, record count of a result set, or even the existence of a value within the result set (no loops...only pointers!). Finally, accessing and handling any database results for their output, manipulation, or use to construct additional query (for n+1 round trips to the database) is done programmatically with the use of a few simple methods. With C<span class="the_R">R</span>NRSTN :: Suite v2.0.0, expect a reduction in your database troubles, and an increase in efficiency with all things database.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Here, a database connection is made, and a query is sent to the database with some minor checks and tests being performed on the result data set afterwards.';
                    $tmp_example_presentation_file = '/common/inc/examples/return_crnrstn_mysqli_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/return_crnrstn_mysqli_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/mysql_database/returnconnection_mysqli/':
                    $tmp_categ_name = 'MySQL Database Query/Response';
                    $tmp_subcateg_name = 'MySQL Database Query/Response';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'return_crnrstn_mysqli()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','If your application touches n+1 database instances, the C<span class="the_R">R</span>NRSTN :: Suite v2.0.0 is going to be the release wherein you would want to fully sign on. In v1.0.0, C<span class="the_R">R</span>NRSTN :: laid a solid foundation for database support with its responsible and intelligent n+1 database connection management and mysqli batching of SQL request submissions to the database. However, as far as how to store and recall the data returned through said database connection(s)...this huge burden was still left to the whims of the wild wild west of web development.<br><br>Enter C<span class="the_R">R</span>NRSTN :: Suite v2.0.0! Territory has been expanded FAR BEYOND the database connection management and request delivery methods (which simply "send the query") boundaries. Requests will be batched together (per each connection), and...new to v2.0.0...micro-batches of query requests to the database connection can be carved out if desired. All query results are aggregated into and persisted by C<span class="the_R">R</span>NRSTN ::, and there are plans are for future releases to be able to cache any desired results (or query) to SESSION for persistence...and this is with seamless access to the "same" result set through the same methods. With query cache management will come configurable TTL restrictions for this result set data in session. <br><br>Currently in C<span class="the_R">R</span>NRSTN :: Suite v2.0.0, all results can be de-normalized (in memory) on up to 10 simultaneous fields (at the same time) to facilitate direct pointer lookup of result set values. One can also check for the existence of a result set, record count of a result set, or even the existence of a value within the result set (no loops...only pointers!). Finally, accessing and handling any database results for their output, manipulation, or use to construct additional query (for n+1 round trips to the database) is done programmatically with the use of a few simple methods. With C<span class="the_R">R</span>NRSTN :: Suite v2.0.0, expect a reduction in your database troubles, and an increase in efficiency with all things database.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','param_tunnel_decrypt($data=NULL, $uri_passthrough=false, $cipher_override=NULL, $secret_key_override=NULL)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$data';
                    $tmp_param_def[0]['param_definition'] = 'The data that is to be encrypted. Please note, only <em>string</em>, <em>integer</em>, <em>double</em>, <em>float</em>, and <em>int</em> data types will be successfully processed. All other data types will return NULL.';
                    $tmp_param_def[0]['param_required'] = true;

                    $tmp_param_def[1]['param_name'] = '$uri_passthrough';
                    $tmp_param_def[1]['param_definition'] = 'When openssl tunnel encrypted data is sent through GET, this should be TRUE. Due to the character sets <a href="https://www.youtube.com/watch?v=217CdX7Z2tM" target="_blank">emerging</a> from many openssl encryption algorithms, it is necessary to clean the string before successful decryption can be accomplished. Otherwise, an exception will be thrown. Therefore, this is actually a required parameter when the data tunnel mechanism is HTTP/S GET.';
                    $tmp_param_def[1]['param_required'] = false;

                    $tmp_param_def[2]['param_name'] = '$secret_key';
                    $tmp_param_def[2]['param_definition'] = 'If it is desired to override the environmentally specific and globally applied openssl-encryption-key passed into init_tunnel_encryption(), this parameter will be used in place of the openssl encryption key provided there in the C<span class="the_R">R</span>NRSTN Suite :: configuration file for all of the environments within which the application code base will be running.';
                    $tmp_param_def[2]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','The raw data in an encrypted format or NULL on error...i.e. if the data is not able to be encrypted.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Here, a database connection is made, and a query is sent to the database with some minor checks and tests being performed on the result data set afterwards.';
                    $tmp_example_presentation_file = '/common/inc/examples/return_crnrstn_mysqli_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/return_crnrstn_mysqli_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/mysql_database/return_conn_object/':
                    $tmp_categ_name = 'MySQL Database Query/Response';
                    $tmp_subcateg_name = 'MySQL Database Query/Response';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'return_conn_object()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_definition'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/mysql_database/returnconnserial/':
                    $tmp_categ_name = 'MySQL Database Query/Response';
                    $tmp_subcateg_name = 'MySQL Database Query/Response';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'returnConnSerial()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_definition'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/mysql_database/new_crnrstn_query_profile_manager/':
                    $tmp_categ_name = 'MySQL Database Query/Response';
                    $tmp_subcateg_name = 'MySQL Database Query/Response';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'new crnrstn_query_profile_manager()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_definition'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/mysql_database/loadqueryprofile/':
                    $tmp_categ_name = 'MySQL Database Query/Response';
                    $tmp_subcateg_name = 'MySQL Database Query/Response';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'loadQueryProfile()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_definition'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/mysql_database/adddatabasequery/':
                    $tmp_categ_name = 'MySQL Database Query/Response';
                    $tmp_subcateg_name = 'MySQL Database Query/Response';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'add_database_query()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_definition'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/mysql_database/processquery/':
                    $tmp_categ_name = 'MySQL Database Query/Response';
                    $tmp_subcateg_name = 'MySQL Database Query/Response';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'processQuery()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_definition'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/mysql_database/returndatabasevalue/':
                    $tmp_categ_name = 'MySQL Database Query/Response';
                    $tmp_subcateg_name = 'MySQL Database Query/Response';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'return_db_value()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_definition'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/mysql_database/initlookupbyid/':
                    $tmp_categ_name = 'MySQL Database Query/Response';
                    $tmp_subcateg_name = 'MySQL Database Query/Response';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'init_lookup_by_id()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_definition'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/mysql_database/addlookupfielddata/':
                    $tmp_categ_name = 'MySQL Database Query/Response';
                    $tmp_subcateg_name = 'MySQL Database Query/Response';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'add_lookup_field_data()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_definition'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/mysql_database/loadpreviousrecordlookup/':
                    $tmp_categ_name = 'MySQL Database Query/Response';
                    $tmp_subcateg_name = 'MySQL Database Query/Response';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'load_previous_record_lookup()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_definition'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/mysql_database/retrievedatabyid/':
                    $tmp_categ_name = 'MySQL Database Query/Response';
                    $tmp_subcateg_name = 'MySQL Database Query/Response';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'retrieve_data_by_id()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_definition'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/mysql_database/pingvalueexistence/':
                    $tmp_categ_name = 'MySQL Database Query/Response';
                    $tmp_subcateg_name = 'MySQL Database Query/Response';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'ping_value_existence()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_definition'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/mysql_database/pingresultsetexistence/':
                    $tmp_categ_name = 'MySQL Database Query/Response';
                    $tmp_subcateg_name = 'MySQL Database Query/Response';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'ping_result_set_existence()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_definition'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/mysql_database/resultsetmerge/':
                    $tmp_categ_name = 'MySQL Database Query/Response';
                    $tmp_subcateg_name = 'MySQL Database Query/Response';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'resultSetMerge()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_definition'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/mysql_database/returnrecordcount/':
                    $tmp_categ_name = 'MySQL Database Query/Response';
                    $tmp_subcateg_name = 'MySQL Database Query/Response';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'return_record_count()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_definition'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/mysql_database/return_querydatetimestamp/':
                    $tmp_categ_name = 'MySQL Database Query/Response';
                    $tmp_subcateg_name = 'MySQL Database Query/Response';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'return_query_date_time_stamp()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_definition'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/mysql_database/closeconnection_mysqli/':
                    $tmp_categ_name = 'MySQL Database Query/Response';
                    $tmp_subcateg_name = 'MySQL Database Query/Response';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'closeConnection_MySQLi()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_definition'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/form_handling/':
                    $tmp_categ_name = 'Form Handling';
                    $tmp_subcateg_name = 'Form Handling';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = '';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_definition'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/form_handling/initfi_handle/':
                    $tmp_categ_name = 'Form Handling';
                    $tmp_subcateg_name = 'Form Handling';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'initFI_handle()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_definition'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/form_handling/addfi_input_listener/':
                    $tmp_categ_name = 'Form Handling';
                    $tmp_subcateg_name = 'Form Handling';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'addFI_Input_Listener()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_definition'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/form_handling/addfi_hiddeninput_listener/':
                    $tmp_categ_name = 'Form Handling';
                    $tmp_subcateg_name = 'Form Handling';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'addFI_HiddenInput_Listener()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_definition'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/form_handling/redirectfi_onvalidation/':
                    $tmp_categ_name = 'Form Handling';
                    $tmp_subcateg_name = 'Form Handling';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'redirectFI_OnValidation()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_definition'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/form_handling/errmsgfi_inputvalidation/':
                    $tmp_categ_name = 'Form Handling';
                    $tmp_subcateg_name = 'Form Handling';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'errMsgFI_InputValidation()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_definition'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/form_handling/inputfi_prepopulateValue/':
                    $tmp_categ_name = 'Form Handling';
                    $tmp_subcateg_name = 'Form Handling';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'inputFI_PrepopulateValue()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_definition'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/form_handling/injectfi_serializedpack/':
                    $tmp_categ_name = 'Form Handling';
                    $tmp_subcateg_name = 'Form Handling';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'injectFI_SerializedPack()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_definition'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/form_handling/receivefi_packet/':
                    $tmp_categ_name = 'Form Handling';
                    $tmp_subcateg_name = 'Form Handling';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'receiveFI_Packet()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_definition'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/form_handling/returnvalue_datafi_input/':
                    $tmp_categ_name = 'Form Handling';
                    $tmp_subcateg_name = 'Form Handling';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'returnValue_dataFI_Input()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_definition'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/form_handling/isvalid_datafi_validcheck/':
                    $tmp_categ_name = 'Form Handling';
                    $tmp_subcateg_name = 'Form Handling';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'isValid_dataFI_ValidCheck()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_definition'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/form_handling/returnerr_datafi_validcheck/':
                    $tmp_categ_name = 'Form Handling';
                    $tmp_subcateg_name = 'Form Handling';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'returnErr_dataFI_ValidCheck()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_definition'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/pagination/':
                    $tmp_categ_name = 'Pagination';
                    $tmp_subcateg_name = 'Pagination';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = '';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_definition'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/pagination/totalpgnate_results_increment/':
                    $tmp_categ_name = 'Pagination';
                    $tmp_subcateg_name = 'Pagination';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'totalPGNATE_results_increment()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);
    
                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');
    
                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';
    
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');
    
                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_definition'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;
    
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');
    
                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/pagination/setpgnate_max_result_count/':
                    $tmp_categ_name = 'Pagination';
                    $tmp_subcateg_name = 'Pagination';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'setPGNATE_max_result_count()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);
    
                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');
    
                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';
    
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');
    
                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_definition'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;
    
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');
    
                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/pagination/returnpgnate_serial/':
                    $tmp_categ_name = 'Pagination';
                    $tmp_subcateg_name = 'Pagination';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'returnPGNATE_Serial()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);
    
                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');
    
                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';
    
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');
    
                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_definition'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;
    
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');
    
                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/pagination/specifypgnate_httpvar/':
                    $tmp_categ_name = 'Pagination';
                    $tmp_subcateg_name = 'Pagination';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'specifyPGNATE_HTTPVar()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_definition'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/pagination/addpgnate_passthroughinputVal/':
                    $tmp_categ_name = 'Pagination';
                    $tmp_subcateg_name = 'Pagination';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'addPGNATE_PassthroughInputVal()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_definition'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/pagination/returnpgnate_currentpage/':
                    $tmp_categ_name = 'Pagination';
                    $tmp_subcateg_name = 'Pagination';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'returnPGNATE_CurrentPage()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_definition'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/email_messaging/':
                    $tmp_categ_name = 'Email Messaging';
                    $tmp_subcateg_name = 'Email Messaging';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = '';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_definition'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/email_messaging/initialize_ogabriel/':
                    $tmp_categ_name = 'Email Messaging';
                    $tmp_subcateg_name = 'Email Messaging';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'initialize_oGabriel()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_definition'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                    break;
                case '/suite_methods/email_messaging/addhostservers/':
                    $tmp_categ_name = 'Email Messaging';
                    $tmp_subcateg_name = 'Email Messaging';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'addHostServers()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_definition'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                    break;
                case '/suite_methods/email_messaging/addreplyto/':
                    $tmp_categ_name = 'Email Messaging';
                    $tmp_subcateg_name = 'Email Messaging';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'addReplyTo()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_definition'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                    break;
                case '/suite_methods/email_messaging/addfrom/':
                    $tmp_categ_name = 'Email Messaging';
                    $tmp_subcateg_name = 'Email Messaging';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'addFrom()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_definition'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                    break;
                case '/suite_methods/email_messaging/wordwrap/':
                    $tmp_categ_name = 'Email Messaging';
                    $tmp_subcateg_name = 'Email Messaging';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'wordWrap()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_definition'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                    break;
                case '/suite_methods/email_messaging/ishtml/':
                    $tmp_categ_name = 'Email Messaging';
                    $tmp_subcateg_name = 'Email Messaging';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'isHTML()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_definition'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                    break;
                case '/suite_methods/email_messaging/addsubject/':
                    $tmp_categ_name = 'Email Messaging';
                    $tmp_subcateg_name = 'Email Messaging';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'addSubject()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_definition'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                    break;
                case '/suite_methods/email_messaging/addmsgbody_htmlversion/':
                    $tmp_categ_name = 'Email Messaging';
                    $tmp_subcateg_name = 'Email Messaging';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'addMsgBody_HTMLversion()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_definition'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                    break;
                case '/suite_methods/email_messaging/addmsgbody_textversion/':
                    $tmp_categ_name = 'Email Messaging';
                    $tmp_subcateg_name = 'Email Messaging';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'addMsgBody_HTMLversion()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_definition'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                    break;
                case '/suite_methods/email_messaging/suppressemailduplicates/':
                    $tmp_categ_name = 'Email Messaging';
                    $tmp_subcateg_name = 'Email Messaging';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'suppressEmailDuplicates()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_definition'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                    break;
                case '/suite_methods/email_messaging/optoutdonotsendemail/':
                    $tmp_categ_name = 'Email Messaging';
                    $tmp_subcateg_name = 'Email Messaging';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'optOutDoNotSendEmail()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_definition'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                    break;
                case '/suite_methods/email_messaging/addaddress/':
                    $tmp_categ_name = 'Email Messaging';
                    $tmp_subcateg_name = 'Email Messaging';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'addAddress()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_definition'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                    break;
                case '/suite_methods/email_messaging/addcc/':
                    $tmp_categ_name = 'Email Messaging';
                    $tmp_subcateg_name = 'Email Messaging';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'addCC()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_definition'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                    break;
                case '/suite_methods/email_messaging/addbcc/':
                    $tmp_categ_name = 'Email Messaging';
                    $tmp_subcateg_name = 'Email Messaging';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'addBCC()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_definition'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                    break;
                case '/suite_methods/email_messaging/adddynamiccontent_subject/':
                    $tmp_categ_name = 'Email Messaging';
                    $tmp_subcateg_name = 'Email Messaging';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'addDynamicContent_SUBJECT()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_definition'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                    break;
                case '/suite_methods/email_messaging/adddynamiccontent_html/':
                    $tmp_categ_name = 'Email Messaging';
                    $tmp_subcateg_name = 'Email Messaging';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'addDynamicContent_HTML()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_definition'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                    break;
                case '/suite_methods/email_messaging/adddynamiccontent_text/':
                    $tmp_categ_name = 'Email Messaging';
                    $tmp_subcateg_name = 'Email Messaging';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'addDynamicContent_TEXT()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_definition'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                    break;
                case '/suite_methods/email_messaging/adddynamiccontent_multipart/':
                    $tmp_categ_name = 'Email Messaging';
                    $tmp_subcateg_name = 'Email Messaging';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'addDynamicContent_MULTIPART()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_definition'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                    break;
                case '/suite_methods/email_messaging/ogabriel_send/':
                    $tmp_categ_name = 'Email Messaging';
                    $tmp_subcateg_name = 'Email Messaging';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'oGabriel_Send()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_definition'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                    break;
                case '/suite_methods/email_messaging/addaddressbulk/':
                    $tmp_categ_name = 'Email Messaging';
                    $tmp_subcateg_name = 'Email Messaging';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'addAddressBulk()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_definition'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                    break;
                case '/suite_methods/email_messaging/addhtmlver_bulk/':
                    $tmp_categ_name = 'Email Messaging';
                    $tmp_subcateg_name = 'Email Messaging';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'addHTMLver_Bulk()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_definition'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                    break;
                case '/suite_methods/email_messaging/addtextver_bulk/':
                    $tmp_categ_name = 'Email Messaging';
                    $tmp_subcateg_name = 'Email Messaging';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'addTEXTver_Bulk()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_definition'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                    break;
                case '/suite_methods/email_messaging/ishtmlbulk/':
                    $tmp_categ_name = 'Email Messaging';
                    $tmp_subcateg_name = 'Email Messaging';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'isHTMLBulk()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_definition'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                    break;
                case '/suite_methods/email_messaging/wordwrapbulk/':
                    $tmp_categ_name = 'Email Messaging';
                    $tmp_subcateg_name = 'Email Messaging';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'wordWrapBulk()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_definition'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                    break;
                case '/suite_methods/email_messaging/addreplytobulk/':
                    $tmp_categ_name = 'Email Messaging';
                    $tmp_subcateg_name = 'Email Messaging';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'addReplyToBulk()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_definition'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                    break;
                case '/suite_methods/email_messaging/addfrombulk/':
                    $tmp_categ_name = 'Email Messaging';
                    $tmp_subcateg_name = 'Email Messaging';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'addFromBulk()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_definition'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                    break;
                case '/suite_methods/email_messaging/addsubjectbulk/':
                    $tmp_categ_name = 'Email Messaging';
                    $tmp_subcateg_name = 'Email Messaging';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'addSubjectBulk()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_definition'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                    break;
                case '/suite_methods/email_messaging/batchreadytosend/':
                    $tmp_categ_name = 'Email Messaging';
                    $tmp_subcateg_name = 'Email Messaging';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'batchReadyToSend()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_definition'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                    break;
                case '/suite_methods/email_messaging/sendstatusreportemail/':
                    $tmp_categ_name = 'Email Messaging';
                    $tmp_subcateg_name = 'Email Messaging';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'sendStatusReportEmail()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_definition'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                    break;
                case '/suite_methods/email_messaging/ogabriel_sendreport/':
                    $tmp_categ_name = 'Email Messaging';
                    $tmp_subcateg_name = 'Email Messaging';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'oGabriel_SendReport()';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_definition'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/multi_language/returnpgnate_currentpage/':
                    $tmp_categ_name = 'Multi-Language Support';
                    $tmp_subcateg_name = 'Multi-Language Support';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = '';
                    self::$page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_definition'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    $this->oCRNRSTN_UI_ASSEMBLER->add_page_element(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                default:

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    //throw new Exception('Error building page [' . $this->module_key . '|' . $this->page_path .  '] due to missing load_page() switch case.');

                    if(strlen($this->module_key) > 0){

                        $this->oCRNRSTN->error_log('Error building page [' . $this->module_key . '|' . $this->page_path .  '] due to missing load_page() switch case.', __LINE__, __METHOD__, __FILE__, CRNRSTN_SETTINGS_CRNRSTN);

                    }

                break;

            }

        }catch(Exception $e){

            //
            // LET CRNRSTN :: HANDLE THIS PER THE LOGGING PROFILE CONFIGURATION FOR THIS SERVER 
            $this->oCRNRSTN->catch_exception($e, LOG_ERR, __METHOD__, __NAMESPACE__);

        }

    }

    public function return_page_serial(){

        return self::$page_serial;

    }

//    public function returnLoadedBitch(){
//
//        return $this->oCRNRSTN_UI_ASSEMBLER;
//
//    }

    /*
    REFERENCE OF SYSTEM CONSTANTS ::
    // CRNRSTN :: DEBUG MODE
    CRNRSTN_DEBUG_OFF               // DEBUG MODE OFF.
    CRNRSTN_DEBUG_NATIVE_ERR_LOG    // DEBUG MODE REAL-TIME NATIVE PHP error_log() OUT.
    CRNRSTN_DEBUG_AGGREGATION_ON    // DEBUG MODE IS ON, BUT SAY NOTHING UNTIL THE END.
    * * WHAT YOU SAY AND HOW WILL BE ACCORDING TO THE LOGGING PROFILE.
    * * IF CRNRSTN :: IS CONFIGURED TO HANDLE ALL ERRORS, THIS WILL AFFECT HOW NATIVE PHP ERRORS ARE HANDLED AS WELL.

    // CRNRSTN :: OPENSSL ENCRYPTION PROFILE INTEGER CONSTANT
    CRNRSTN_ENCRYPT_TUNNEL
    * * DETAILS ::
    * * TUNNEL ENCRYPTION IS USED BY CRNRSTN :: FOR POINT TO POINT COMMUNICATIONS
    * * AFFECTS ::
    * * ~ THE CRNRSTN :: FORM INTEGRATIONS HANDLER PACKET.
    * *       ENCRYPTED DATA INJECTED AS HIDDEN FIELDS INTO FORMS TO FACILITATE CRNRSTN :: (1) RECEIVING, VALIDATING
    * *       AND STORING THE FORM DATA FOR ACCESS BY METHOD CALL, (2) HANDLING ANY REDIRECT OF THE USER AFTER FORM
    * *       SUBMISSION, (3) SUPPORT PRE-POPULATION OF FORM INPUT DATA ON RELOAD.
    * * ~ STICKY LINKS
    * * ~ SYSTEM GET DATA
    * * ~ CRNRSTN :: PSEUDO-SOAP SERVICES DATA TUNNEL LAYER PACKET. A SESSION CONFIGURATION OBJECT (JSON) OUTPUTTED FROM
    * *       THE SYSTEM CONFIG DDO WITH DATA FLAGGED AS AUTHORIZED FOR OUTPUT TO THE PSEUDO-SOAP SERVICES DATA TUNNEL
    * *       LAYER ARCHITECTURE (PSSDTLA) [CRNRSTN_AUTHORIZE_PSSDTLA].

    // CRNRSTN :: OPENSSL ENCRYPTION PROFILE INTEGER CONSTANT
    CRNRSTN_ENCRYPT_DATABASE
    * * DETAILS ::
    * * DATABASE ENCRYPTION IS USED BY CRNRSTN :: WHEN SENDING TO DATABASE FOR STORAGE
    * * AFFECTS ::
    * * ~ THE SYSTEM SESSION CONFIGURATION OBJECT. OUTPUT FROM THE SYSTEM CONFIG DDO FLAGGED AS AUTHORIZED FOR OUTPUT TO
    * *   DATABASE [CRNRSTN_AUTHORIZE_DATABASE].

    // CRNRSTN :: OPENSSL ENCRYPTION PROFILE INTEGER CONSTANTS
    CRNRSTN_ENCRYPT_SESSION
    CRNRSTN_ENCRYPT_COOKIE
    CRNRSTN_ENCRYPT_SOAP
    CRNRSTN_ENCRYPT_OERSL

    // CRNRSTN :: LOG PROFILES OF THE DEBUG MODE (OR PERSUASIONS OF THE KINDS OF THINGS THAT SHOULD BE REPORTED)
    CRNRSTN_LOG_ALL                 // REPORT ON EVERYTHING. 100% RETURN ON ALL CALLS OF $oCRNRSTN->error_log().
    CRNRSTN_LOG_NONE                // REPORT ON NOTHING. 0% RETURN ON ALL CALLS OF $oCRNRSTN->error_log().

    CRNRSTN_LOG_ELECTRUM            // REPORT ON ELECTRUM. ELECTRUM IS A DATA TRANSFORM SERVICE FOR MOVING FILES.
    CRNRSTN_DATABASE                // REPORT ON DATABASE.
    CRNRSTN_DATABASE_CONNECTION     // REPORT ON DATABASE CONNECTION.
    CRNRSTN_DATABASE_QUERY          // REPORT ON DATABASE QUERY.
    CRNRSTN_DATABASE_QUERY_SILO     // REPORT ON DATABASE QUERY SILO.
    CRNRSTN_DATABASE_QUERY_DYNAMIC  // REPORT ON DYNAMICALLY ASSEMBLED DATABASE QUERY. THINK DYNAMIC SERIALIZED SHARDS.
    CRNRSTN_DATABASE_RESULT         // REPORT ON DATABASE RESULT SET PROCESSING.

    CRNRSTN_BARNEY                  // REPORT ON ALL ERROR.
    CRNRSTN_BARNEY_DATABASE         // REPORT ON ALL DATABASE ERROR.
    CRNRSTN_BARNEY_FILE             // REPORT ON ALL FILE RELATED ERROR.
    CRNRSTN_BARNEY_FTP              // REPORT ON ALL FTP ERROR.
    CRNRSTN_BARNEY_ELECTRUM         // REPORT ON ALL ELECTRUM ERROR (ELECTRUM IS A DATA TRANSFORM SERVICE FOR MOVING FILES).
    CRNRSTN_BARNEY_GABRIEL          // REPORT ON ALL EMAIL ERROR.
    CRNRSTN_BARNEY_DISK             // REPORT ON ALL DISK RELATED ERROR (READ/WRITE).

    // OUTPUT FORMAT PROFILE FLAGS FOR CRNRSTN :: LOGGING
    CRNRSTN_LOG_EMAIL                   // LOG TO EMAIL.
    CRNRSTN_LOG_EMAIL_PROXY             // LOG TO EMAIL. SEND THE MULTI-PART HTML EMAIL THROUGH ANOTHER SERVER.
    CRNRSTN_LOG_FILE                    // LOG TO FILE.
    CRNRSTN_LOG_FILE_FTP                // LOG TO FILE. SEND THE FILE TO ANOTHER SERVER VIA FTP.
    CRNRSTN_LOG_SCREEN_TEXT             // LOG TO SCREEN. OUTPUT LOG DATA WITH \n LINE BREAKS.
    CRNRSTN_LOG_SCREEN                  // LOG TO SCREEN. OUTPUT LOG DATA WITH \n<br> LINE BREAKS.
    CRNRSTN_LOG_SCREEN_HTML             // LOG TO SCREEN. OUTPUT LOG DATA WITH <br> LINE BREAKS.
    CRNRSTN_LOG_SCREEN_HTML_HIDDEN      // LOG TO SCREEN. OUTPUT LOG DATA WITH \n LINE BREAKS WITHIN <!-- --> TAGS.
    CRNRSTN_LOG_DEFAULT                 // LOG TO PHP NATIVE error_log().

    // FLAGS FOR USER INTERFACE THEME STYLES
    CRNRSTN_UI_PHPNIGHT                 // REPLICATION OF LEAD DEVELOPER IDE THEME. HOW CRNRSTN :: LIGHTSABER LOOKS TO ME.
    CRNRSTN_UI_DARKNIGHT                // LIKE CRNRSTN_UI_PHPNIGHT, BUT DARKER. NOTHING COULD BE DARKER. NOTHING.
    CRNRSTN_UI_PHP                      // ALL ABOUT THE BUSINESS.
    CRNRSTN_UI_GREYSKYS                 // // ALONE AND SAD WITH A NICE CUP OF COFFEE, A RACK MOUNTED DUAL-VIDEO CARD MAC PRO, AND FOUR (4) PRO DISPLAYS.
    CRNRSTN_UI_HTML                     // BE LIGHT AND HAPPY.
    CRNRSTN_UI_DAYLIGHT                 // LIKE CRNRSTN_UI_HTML BUT...LIGHTER. NOTHING COULD BE LIGHTER.
    CRNRSTN_UI_FEATHER                  // LIGHTER THAN DAYLIGHT.

    // DEVICE TYPE FLAGS
    CRNRSTN_CHANNEL_DESKTOP
    CRNRSTN_CHANNEL_TABLET
    CRNRSTN_CHANNEL_MOBILE

    // CONTENT INCLUDE CONSTANTS :: CRNRSTN :: SYSTEM JAVASCRIPT FILE
    CRNRSTN_UI_JS_MAIN
    * * RECEIVED BY $oCRNRSTN->ui_content_module_out().
    * * PRODUCES, oCRNRSTN_JS IN THE DOM. A REPLICATION
    * * * * OF CRNRSTN :: ON THE CLIENT...BUT WITH METHODS
    * * * * SUPPORTING ANIMATIONS AND EFFECTS.

    // CONTENT INCLUDE CONSTANTS :: CRNRSTN :: SYSTEM CSS FILE
    CRNRSTN_UI_CSS_MAIN_DESKTOP
    CRNRSTN_UI_CSS_MAIN_TABLET
    CRNRSTN_UI_CSS_MAIN_MOBILE
    * * RECEIVED BY $oCRNRSTN->ui_content_module_out().
    * * RETURN CSS CONTENT BY DEVICE TYPE

    // CONTENT INCLUDE CONSTANTS :: JS + CSS
    CRNRSTN_JS_FRAMEWORK_JQUERY_1_11_1                     // RETURN JQUERY 1.11.1 (ASSET IS HERE. LACKS IMPLEMENTATION.).
    CRNRSTN_JS_FRAMEWORK_JQUERY                            // RETURN JQUERY.
    CRNRSTN_JS_FRAMEWORK_JQUERY_UI                         // RETURN JQUERY UI.
    CRNRSTN_JS_FRAMEWORK_JQUERY_MOBILE                     // RETURN JQUERY MOBILE.
    CRNRSTN_JS_FRAMEWORK_LIGHTBOX_DOT_JS_PLUS_JQUERY       // RETURN LIGHTBOX.JS (BUILT ON JQUERY) WITH JQUERY ALONG SIDE.
    CRNRSTN_JS_FRAMEWORK_LIGHTBOX_DOT_JS                   // RETURN LIGHTBOX.JS (BUILT ON JQUERY) WITHOUT JQUERY ALONG SIDE.
    * * RECEIVED BY $oCRNRSTN->ui_content_module_out().
    * * RETURN JAVASCRIPT FRAMEWORK.

    // CONTENT RETURN CONSTANT :: CRNRSTN :: SSDTLA SYSTEMS INTEGRATIONS FORM PACKET
    CRNRSTN_UI_SOAP_DATA_TUNNEL
    * * RECEIVED BY $oCRNRSTN->ui_content_module_out().

    // CONTENT RETURN CONSTANT :: CRNRSTN :: SYSTEM FORM HANDLING CONTENT INJECTION
    CRNRSTN_UI_FORM_INTEGRATION_PACKET
    * * RECEIVED BY $oCRNRSTN->ui_content_module_out().
    * * RETURN ENCRYPTED FORM INPUT DATA TO INTEGRATE THE FORM INTO CRNRSTN ::.

    // CONTENT RETURN CONSTANT :: CRNRSTN :: SYSTEM UI CONTENT RETURN ::
    CRNRSTN_UI_COOKIE_PREFERENCE
    * * RECEIVED BY $oCRNRSTN->ui_content_module_out().
    * * RETURN UI FOR MANAGEMENT OF THE COOKIE PREFERENCES OF THE SESSION.

    // CONTENT RETURN CONSTANT :: CRNRSTN :: SYSTEM UI CONTENT RETURN ::
    CRNRSTN_UI_COOKIE_YESNO
    * * RECEIVED BY $oCRNRSTN->ui_content_module_out().
    * * RETURN UI FOR MANAGEMENT OF COOKIE PREFERENCES "ACCEPT/REJECT" FOR THE SESSION.

    // CONTENT RETURN CONSTANT :: CRNRSTN :: SYSTEM UI CONTENT RETURN
    CRNRSTN_UI_COOKIE_NOTICE
    * * RECEIVED BY $oCRNRSTN->ui_content_module_out().
    * * RETURN UI FOR NOTICE OF COOKIE MANAGEMENT POLICY FOR THE SESSION.

    // CRNRSTN :: ASSET HANDLING POLICY (ALL SYSTEM IMAGES, SYSTEM CSS, SYSTEM JS)
    CRNRSTN_ASSET_MODE_PNG
    * * E.G. RECEIVED BY $oCRNRSTN->config_init_images_transport_mode(). CAN ALSO BE OVERRIDDEN ELSEWHERE.
    * * RETURN SYSTEM IMAGES AS PNG.
    * * RETURN SYSTEM CSS BY URL REFERENCE TO SERIALIZED FILE NAME.
    * * RETURN SYSTEM JS BY URL REFERENCE TO SERIALIZED FILE NAME.

    // CRNRSTN :: ASSET HANDLING POLICY (ALL SYSTEM IMAGES, SYSTEM CSS, SYSTEM JS)
    CRNRSTN_ASSET_MODE_JPEG
    * * E.G. RECEIVED BY $oCRNRSTN->config_init_images_transport_mode(). CAN ALSO BE OVERRIDDEN ELSEWHERE.
    * * RETURN SYSTEM IMAGES AS JPG.
    * * RETURN SYSTEM CSS BY URL REFERENCE TO SERIALIZED FILE NAME.
    * * RETURN SYSTEM JS BY URL REFERENCE TO SERIALIZED FILE NAME.

    // CRNRSTN :: ASSET HANDLING POLICY (ALL SYSTEM IMAGES, SYSTEM CSS, SYSTEM JS)
    CRNRSTN_ASSET_MODE_BASE64
    * * E.G. RECEIVED BY $oCRNRSTN->config_init_images_transport_mode(). CAN ALSO BE OVERRIDDEN ELSEWHERE.
    * * RETURN SYSTEM IMAGES BASE64 ENCODED.
    * * RETURN SYSTEM CSS BY DIRECT INJECTION OF THE RAW CSS INTO DOM.
    * * RETURN SYSTEM JS BY DIRECT INJECTION OF THE RAW JAVASCRIPT INTO DOM.

    // CRNRSTN :: ASSET HANDLING POLICY FOR SINGLE SERVING REQUEST FOR DATA
    CRNRSTN_UI_IMG_SOAP_DATA_TUNNEL                 // RETURN SYSTEM IMAGE FOR EXPOSURE TO SOAP TRANSPORT. SOAP = 65,535 CHAR LIMIT.
    CRNRSTN_UI_IMG_BASE64                           // RETURN BASE64 ENCODE OF PNG FORMAT.
    CRNRSTN_UI_IMG_BASE64_PNG                       // RETURN BASE64 ENCODE OF PNG FORMAT.
    CRNRSTN_UI_IMG_BASE64_JPEG                      // RETURN BASE64 ENCODE OF JPEG FORMAT.
    CRNRSTN_UI_IMG_HTML_WRAPPED              // RETURN SYSTEM IMAGE BASE64 ENCODED WITHIN <IMG> DOM TAGS.
    CRNRSTN_UI_IMG_JPEG                             // RETURN HTTP URI OF SYSTEM IMAGE IN JPEG FORMAT.
    CRNRSTN_UI_IMG_HTML_WRAPPED                // RETURN SYSTEM IMAGE AS JPEG WITHIN <IMG> DOM TAGS.
    CRNRSTN_UI_IMG_PNG                              // RETURN HTTP URI OF SYSTEM IMAGE IN PNG FORMAT.
    CRNRSTN_UI_IMG_HTML_WRAPPED                 // RETURN SYSTEM IMAGE AS PNG WITHIN <IMG> DOM TAGS.
    * * E.G. RECEIVED BY $oCRNRSTN->return_creative().

    // CONTENT INCLUDE CONSTANT :: UGC ANALYTICS
    CRNRSTN_UI_TAG_ANALYTICS
    * * RETURN UGC ANALYTICS TAG(S).

    // CONTENT INCLUDE CONSTANT :: UGC ENGAGEMENT
    CRNRSTN_UI_TAG_ENGAGEMENT
    * * RETURN UGC ENGAGEMENT TAG(S).

    /////////// STILL MORE
    CRNRSTN_PERFORMANCE_MONITOR
    CRNRSTN_IP_SECURITY
    CRNRSTN_GABRIEL
    CRNRSTN_SMTP_AUTHENTICATION
    CRNRSTN_EMAIL_CRNRSTN_SOURCE
    CRNRSTN_EMAIL_USER_SOURCE
    CRNRSTN_ELECTRUM
    CRNRSTN_ELECTRUM_THREAD
    CRNRSTN_ELECTRUM_COMM
    CRNRSTN_ELECTRUM_FTP
    CRNRSTN_ELECTRUM_LOCALDIR
    CRNRSTN_FILE_MANAGEMENT
    CRNRSTN_CREATIVE_EMBED
    CRNRSTN_FILE_RECEIVE
    CRNRSTN_FILE_LOCALDIR_MOVE
    CRNRSTN_FILE_FTP_SEND
    CRNRSTN_FILE_FTP_RECEIVE
    CRNRSTN_FILE_SOAP_SEND
    CRNRSTN_FILE_SOAP_RECEIVE
    CRNRSTN_FILE_CURL_SEND
    CRNRSTN_FILE_CURL_RECEIVE
    CRNRSTN_CSS_EMAIL_CLIENT_VALIDATE
    CRNRSTN_SOAP
    CRNRSTN_SOAP_SERVER
    CRNRSTN_SOAP_CLIENT
    CRNRSTN_PROXY_KINGS_HIGHWAY
    CRNRSTN_PROXY_EMAIL
    CRNRSTN_PROXY_ELECTRUM
    CRNRSTN_PROXY_AUTHENTICATE

    CRNRSTN_UI_INTERACT
    CRNRSTN_AUTHORIZE_ALL
    CRNRSTN_AUTHORIZE_DATABASE
    CRNRSTN_AUTHORIZE_SSDTLA
    CRNRSTN_AUTHORIZE_PSSDTLA
    CRNRSTN_AUTHORIZE_SESSION
    CRNRSTN_AUTHORIZE_COOKIE
    CRNRSTN_AUTHORIZE_SOAP
    CRNRSTN_AUTHORIZE_GET
    CRNRSTN_AUTHORIZE_ISEMAIL
    CRNRSTN_AUTHORIZE_ISPASSWORD

    CRNRSTN_RESOURCE_ALL
    CRNRSTN_RESOURCE_OPENSOURCE
    CRNRSTN_RESOURCE_NEWS_SYNDICATION
    CRNRSTN_WORDPRESS_DEBUG

    */

    public function return_resource_profile($resource_constant, $attribute = 'ARRAY'){

        $tmp_output_ARRAY = array();

        if(is_array($resource_constant)){

            $tmp_agg_output_ARRAY = array();

            foreach($resource_constant as $index => $res_const){

                $tmp_agg_output_ARRAY[$res_const] = $this->return_resource_profile($res_const, $attribute);

            }

            return $tmp_agg_output_ARRAY;

        }

        switch($resource_constant){
            case 'CRNRSTN_JS_FRAMEWORK_JQUERY':
            case CRNRSTN_JS_FRAMEWORK_JQUERY:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_JS_FRAMEWORK_JQUERY;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_JS_FRAMEWORK_JQUERY';
                $tmp_output_ARRAY['TITLE'] = 'jQuery';
                $tmp_output_ARRAY['VERSION'] = '3.6.1';
                $tmp_output_ARRAY['BROWSER_COMPATIBILITY'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = 'jQuery is a fast, small, and feature-rich JavaScript library. It makes
                                                    things like HTML document traversal and manipulation, event handling,
                                                    animation, and Ajax much simpler with an easy-to-use API that works
                                                    across a multitude of browsers. With a combination of versatility and
                                                    extensibility, jQuery has changed the way that millions of people
                                                    write JavaScript.
                                                    <br><br>
                                                    <a href="' . $this->oCRNRSTN->return_sticky_link('https://github.com/jquery/jquery', 'crnrstn_documentation_jquery_view_source_github') . '" target="_blank">View Source on GitHub.</a>
                                                    <br><br>
                                                    <a href="' . $this->oCRNRSTN->return_sticky_link('https://learn.jquery.com/about-jquery/how-jquery-works/', 'crnrstn_documentation_jquery_how_jquery_works') . '" target="_blank">How jQuery Works.</a>
                                                    <br><br>
                                                    ' . $this->oCRNRSTN->return_sticky_media_link('TWITTER_SMALL', 'https://twitter.com/jquery') . '&nbsp;
                                                    ' . $this->oCRNRSTN->return_sticky_media_link('GITHUB_SMALL', 'https://github.com/jquery');

                $tmp_output_ARRAY['URL'][] = 'https://jquery.com/';

            break;
            case 'CRNRSTN_JS_FRAMEWORK_JQUERY_2_2_4':
            case CRNRSTN_JS_FRAMEWORK_JQUERY_2_2_4:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_JS_FRAMEWORK_JQUERY_2_2_4;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_JS_FRAMEWORK_JQUERY_2_2_4';
                $tmp_output_ARRAY['TITLE'] = 'jQuery';
                $tmp_output_ARRAY['VERSION'] = '2.2.4';
                $tmp_output_ARRAY['BROWSER_COMPATIBILITY'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = 'jQuery is a fast, small, and feature-rich JavaScript library. It makes
                                                    things like HTML document traversal and manipulation, event handling,
                                                    animation, and Ajax much simpler with an easy-to-use API that works
                                                    across a multitude of browsers. With a combination of versatility and
                                                    extensibility, jQuery has changed the way that millions of people
                                                    write JavaScript.
                                                    <br><br>
                                                    <a href="' . $this->oCRNRSTN->return_sticky_link('https://github.com/jquery/jquery', 'crnrstn_documentation_jquery_224_view_source_github') . '" target="_blank">View Source on GitHub.</a>
                                                    <br><br>
                                                    <a href="' . $this->oCRNRSTN->return_sticky_link('https://learn.jquery.com/about-jquery/how-jquery-works/', 'crnrstn_documentation_jquery_how_jquery_224_works') . '" target="_blank">How jQuery Works.</a>
                                                    <br><br>
                                                    ' . $this->oCRNRSTN->return_sticky_media_link('TWITTER_SMALL', 'https://twitter.com/jquery') . '&nbsp;
                                                    ' . $this->oCRNRSTN->return_sticky_media_link('GITHUB_SMALL', 'https://github.com/jquery');
                $tmp_output_ARRAY['URL'][] = 'https://jquery.com/';

            break;
            case 'CRNRSTN_JS_FRAMEWORK_JQUERY_1_12_4':
            case CRNRSTN_JS_FRAMEWORK_JQUERY_1_12_4:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_JS_FRAMEWORK_JQUERY_1_12_4;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_JS_FRAMEWORK_JQUERY_1_12_4';
                $tmp_output_ARRAY['TITLE'] = 'jQuery';
                $tmp_output_ARRAY['VERSION'] = '1.12.4';
                $tmp_output_ARRAY['BROWSER_COMPATIBILITY'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = 'jQuery is a fast, small, and feature-rich JavaScript library. It makes
                                                    things like HTML document traversal and manipulation, event handling,
                                                    animation, and Ajax much simpler with an easy-to-use API that works
                                                    across a multitude of browsers. With a combination of versatility and
                                                    extensibility, jQuery has changed the way that millions of people
                                                    write JavaScript.
                                                    <br><br>
                                                    <a href="' . $this->oCRNRSTN->return_sticky_link('https://github.com/jquery/jquery', 'crnrstn_documentation_jquery_1124_view_source_github') . '" target="_blank">View Source on GitHub.</a>
                                                    <br><br>
                                                    <a href="' . $this->oCRNRSTN->return_sticky_link('https://learn.jquery.com/about-jquery/how-jquery-works/', 'crnrstn_documentation_jquery_1124_how_jquery_works') . '" target="_blank">How jQuery Works.</a>
                                                    <br><br>
                                                    ' . $this->oCRNRSTN->return_sticky_media_link('TWITTER_SMALL', 'https://twitter.com/jquery') . '&nbsp;
                                                    ' . $this->oCRNRSTN->return_sticky_media_link('GITHUB_SMALL', 'https://github.com/jquery');
                $tmp_output_ARRAY['URL'][] = 'https://jquery.com/';

            break;
            case 'CRNRSTN_JS_FRAMEWORK_JQUERY_1_11_1':
            case CRNRSTN_JS_FRAMEWORK_JQUERY_1_11_1:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_JS_FRAMEWORK_JQUERY_1_11_1;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_JS_FRAMEWORK_JQUERY_1_11_1';
                $tmp_output_ARRAY['TITLE'] = 'jQuery';
                $tmp_output_ARRAY['VERSION'] = '1.11.1';
                $tmp_output_ARRAY['BROWSER_COMPATIBILITY'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = 'jQuery is a fast, small, and feature-rich JavaScript library. It makes
                                                    things like HTML document traversal and manipulation, event handling,
                                                    animation, and Ajax much simpler with an easy-to-use API that works
                                                    across a multitude of browsers. With a combination of versatility and
                                                    extensibility, jQuery has changed the way that millions of people
                                                    write JavaScript.
                                                    <br><br>
                                                    <a href="' . $this->oCRNRSTN->return_sticky_link('https://github.com/jquery/jquery', 'crnrstn_documentation_jquery_1111_view_source_github') . '" target="_blank">View Source on GitHub.</a>
                                                    <br><br>
                                                    <a href="' . $this->oCRNRSTN->return_sticky_link('https://learn.jquery.com/about-jquery/how-jquery-works/', 'crnrstn_documentation_jquery_1111_how_jquery_works') . '" target="_blank">How jQuery Works.</a>
                                                    <br><br>
                                                    ' . $this->oCRNRSTN->return_sticky_media_link('TWITTER_SMALL', 'https://twitter.com/jquery') . '&nbsp;
                                                    ' . $this->oCRNRSTN->return_sticky_media_link('GITHUB_SMALL', 'https://github.com/jquery');
                $tmp_output_ARRAY['URL'][] = 'https://jquery.com/';

            break;
            case 'CRNRSTN_JS_FRAMEWORK_JQUERY_UI':
            case CRNRSTN_JS_FRAMEWORK_JQUERY_UI:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_JS_FRAMEWORK_JQUERY_UI;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_JS_FRAMEWORK_JQUERY_UI';
                $tmp_output_ARRAY['TITLE'] = 'jQuery UI';
                $tmp_output_ARRAY['VERSION'] = '1.13.2';
                $tmp_output_ARRAY['BROWSER_COMPATIBILITY'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = 'jQuery UI is a curated set of user interface interactions, effects,
                                                    widgets, and themes built on top of the jQuery JavaScript Library.
                                                    Whether you\'re building highly interactive web applications or you
                                                    just need to add a date picker to a form control, jQuery UI is the
                                                    perfect choice.
                                                    <br><br>
                                                    ' . $this->oCRNRSTN->return_sticky_media_link('GITHUB_SMALL', 'https://github.com/jquery/jquery-ui') . '&nbsp;
                                                    ' . $this->oCRNRSTN->return_sticky_media_link('TWITTER_SMALL', 'https://twitter.com/jqueryui');
                $tmp_output_ARRAY['URL'][] = 'https://jqueryui.com/';

            break;
            case 'CRNRSTN_JS_FRAMEWORK_JQUERY_UI_1_12_1':
            case CRNRSTN_JS_FRAMEWORK_JQUERY_UI_1_12_1:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_JS_FRAMEWORK_JQUERY_UI_1_12_1;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_JS_FRAMEWORK_JQUERY_UI_1_12_1';
                $tmp_output_ARRAY['TITLE'] = 'jQuery UI';
                $tmp_output_ARRAY['VERSION'] = '1.12.1';
                $tmp_output_ARRAY['BROWSER_COMPATIBILITY'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = 'jQuery UI is a curated set of user interface interactions, effects,
                                                    widgets, and themes built on top of the jQuery JavaScript Library.
                                                    Whether you\'re building highly interactive web applications or you
                                                    just need to add a date picker to a form control, jQuery UI is the
                                                    perfect choice.
                                                    <br><br>
                                                    ' . $this->oCRNRSTN->return_sticky_media_link('GITHUB_SMALL', 'https://github.com/jquery/jquery-ui') . '&nbsp;
                                                    ' . $this->oCRNRSTN->return_sticky_media_link('TWITTER_SMALL', 'https://twitter.com/jqueryui');
                $tmp_output_ARRAY['URL'][] = 'https://jqueryui.com/';

            break;
            case 'CRNRSTN_JS_FRAMEWORK_JQUERY_MOBILE':
            case CRNRSTN_JS_FRAMEWORK_JQUERY_MOBILE:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_JS_FRAMEWORK_JQUERY_MOBILE;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_JS_FRAMEWORK_JQUERY_MOBILE';
                $tmp_output_ARRAY['TITLE'] = 'jQuery Mobile';
                $tmp_output_ARRAY['VERSION'] = '1.4.5';
                $tmp_output_ARRAY['BROWSER_COMPATIBILITY'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = 'A Touch-Optimized Web Framework. jQuery Mobile is a HTML5-based user
                                                    interface system designed to make responsive web sites and apps that 
                                                    are accessible on all smartphone, tablet and desktop devices.
                                                    <br><br>
                                                    <strong>Seriously cross-platform with HTML5</strong><br>
                                                    jQuery Mobile framework takes the "write less, do more" mantra to 
                                                    the next level: Instead of writing unique applications for each 
                                                    mobile device or OS, the jQuery mobile framework allows you to 
                                                    design a single highly-branded responsive web site or application 
                                                    that will work on all popular smartphone, tablet, and 
                                                    desktop platforms.
                                                    <br><br>
                                                    <a href="' . $this->oCRNRSTN->return_sticky_link('https://jquerymobile.com/browser-support/1.4/', 'crnrstn_documentation_jquery_mobile_1_4_mobile_browser_support') . '" target="_blank">Mobile Browser Support</a>
                                                    <br><br>
                                                    ' . $this->oCRNRSTN->return_sticky_media_link('GITHUB_SMALL', 'https://github.com/jquery-archive/jquery-mobile');
                $tmp_output_ARRAY['URL'][] = 'https://jquerymobile.com/';

            break;
            case 'CRNRSTN_JS_FRAMEWORK_LIGHTBOX_DOT_JS':
            case CRNRSTN_JS_FRAMEWORK_LIGHTBOX_DOT_JS:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_JS_FRAMEWORK_LIGHTBOX_DOT_JS;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_JS_FRAMEWORK_LIGHTBOX_DOT_JS';
                $tmp_output_ARRAY['TITLE'] = 'LIGHTBOX';
                $tmp_output_ARRAY['VERSION'] = '2.11.3';
                $tmp_output_ARRAY['BROWSER_COMPATIBILITY'] = 'IE 9+, Chrome, Safari, Firefox, iOS Safari, iOS Chrome, 
                Android Browser, Android Chrome.';
                $tmp_output_ARRAY['DESCRIPTION'] = 'The <em>original</em> lightbox script.
                <br><br>
                Lightbox is a small javascript library used to overlay images on top of the current page. It\'s a snap to 
                setup and works on all modern browsers.
                <br><br>
                <strong>Demos and usage instructions.</strong> Visit the <a href="' . $this->oCRNRSTN->return_sticky_link('https://lokeshdhakar.com/projects/lightbox2/', 'crnrstn_documentation_lightbox_homepage_2_11_3') . '" target="_blank">Lightbox homepage</a> 
                to see examples, info on getting started, script options, how to get help, and more.
                <br><br>
                <strong>Releases and Changelog.</strong> Viewable on the <a href="' . $this->oCRNRSTN->return_sticky_link('https://github.com/lokesh/lightbox2/releases', 'crnrstn_documentation_lightbox_github_releases_2_11_3') . '" target="_blank">Github Releases</a> 
                page Roadmap. View the <a href="' . $this->oCRNRSTN->return_sticky_link('https://github.com/lokesh/lightbox2/blob/master/ROADMAP.md', 'crnrstn_documentation_lightbox_roadmap_2_11_3') . '" target="_blank">Roadmap</a> 
                for a peek at what is being planned for future releases.
                <br><br>
                <strong>License.</strong> Lightbox is licensed under the <a href="#" onclick="oCRNRSTN_JS.crnrstn_interact_ui_ux(\'mit_license_modal\', this);" target="_self">MIT License.</a> 
                <a href="' . $this->oCRNRSTN->return_sticky_link('https://lokeshdhakar.com/projects/lightbox2/#license', 'crnrstn_documentation_lightbox_mit_license_learn_more_2_11_3') . '" target="_blank">Learn more</a> 
                about the license.
                <br><br>
                by <a href="' . $this->oCRNRSTN->return_sticky_link('https://www.lokeshdhakar.com/', 'crnrstn_documentation_lightbox_roadmap_2_11_3') . '" target="_blank">Lokesh Dhakar</a>
                <br><br>
                ' . $this->oCRNRSTN->return_sticky_media_link('TWITTER_SMALL', 'https://twitter.com/lokesh') . '&nbsp;
                ' . $this->oCRNRSTN->return_sticky_media_link('GITHUB_SMALL', 'https://github.com/lokesh/lightbox2');
                $tmp_output_ARRAY['URL'][] = 'https://lokeshdhakar.com/projects/lightbox2/';

            break;
            case 'CRNRSTN_JS_FRAMEWORK_LIGHTBOX_DOT_JS_PLUS_JQUERY':
            case CRNRSTN_JS_FRAMEWORK_LIGHTBOX_DOT_JS_PLUS_JQUERY:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_JS_FRAMEWORK_LIGHTBOX_DOT_JS_PLUS_JQUERY;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_JS_FRAMEWORK_LIGHTBOX_DOT_JS_PLUS_JQUERY';
                $tmp_output_ARRAY['TITLE'] = 'LIGHTBOX + JQUERY';
                $tmp_output_ARRAY['VERSION'] = '2.11.3/v3.4.1';
                $tmp_output_ARRAY['BROWSER_COMPATIBILITY'] = 'IE 9+, Chrome, Safari, Firefox, iOS Safari, iOS Chrome, 
                Android Browser, Android Chrome.';
                $tmp_output_ARRAY['DESCRIPTION'] = 'The <em>original</em> lightbox script.
                <br><br>
                Lightbox is a small javascript library used to overlay images on top of the current page. It\'s a snap to 
                setup and works on all modern browsers.
                <br><br>
                <strong>Demos and usage instructions.</strong> Visit the <a href="' . $this->oCRNRSTN->return_sticky_link('https://lokeshdhakar.com/projects/lightbox2/', 'crnrstn_documentation_lightbox_homepage_2_11_3_3_4_1') . '" target="_blank">Lightbox homepage</a> 
                to see examples, info on getting started, script options, how to get help, and more.
                <br><br>
                <strong>Releases and Changelog.</strong> Viewable on the <a href="' . $this->oCRNRSTN->return_sticky_link('https://github.com/lokesh/lightbox2/releases', 'crnrstn_documentation_lightbox_github_releases_2_11_3_3_4_1') . '" target="_blank">Github Releases</a> 
                page Roadmap. View the <a href="' . $this->oCRNRSTN->return_sticky_link('https://github.com/lokesh/lightbox2/blob/master/ROADMAP.md', 'crnrstn_documentation_lightbox_roadmap_2_11_3_3_4_1') . '" target="_blank">Roadmap</a> 
                for a peek at what is being planned for future releases.
                <br><br>
                <strong>License.</strong> Lightbox is licensed under the <a href="#" onclick="oCRNRSTN_JS.crnrstn_interact_ui_ux(\'mit_license_modal\', this);" target="_self">MIT License.</a> 
                <a href="' . $this->oCRNRSTN->return_sticky_link('https://lokeshdhakar.com/projects/lightbox2/#license', 'crnrstn_documentation_lightbox_mit_license_learn_more_2_11_3_3_4_1') . '" target="_blank">Learn more</a> 
                about the license.
                <br><br>
                by <a href="' . $this->oCRNRSTN->return_sticky_link('https://www.lokeshdhakar.com/', 'crnrstn_documentation_lightbox_roadmap_2_11_3_3_4_1') . '" target="_blank">Lokesh Dhakar</a>
                <br><br>
                ' . $this->oCRNRSTN->return_sticky_media_link('TWITTER_SMALL', 'https://twitter.com/lokesh') . '&nbsp;
                ' . $this->oCRNRSTN->return_sticky_media_link('GITHUB_SMALL', 'https://github.com/lokesh/lightbox2');
                $tmp_output_ARRAY['URL'][] = 'https://lokeshdhakar.com/projects/lightbox2/';

            break;
            case 'CRNRSTN_JS_FRAMEWORK_REACT':
            case CRNRSTN_JS_FRAMEWORK_REACT:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_JS_FRAMEWORK_REACT;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_JS_FRAMEWORK_REACT';
                $tmp_output_ARRAY['TITLE'] = 'React';
                $tmp_output_ARRAY['VERSION'] = '18.2.0';
                $tmp_output_ARRAY['BROWSER_COMPATIBILITY'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = 'A JavaScript library for building user interfaces. React makes it 
                            painless to create interactive UIs. Design simple views for each state in your application, 
                            and React will efficiently update and render just the right components when your data changes.
                            <br><br>
                            Declarative views make your code more predictable and easier to debug.
                            <br><br>
                            <a href="' . $this->oCRNRSTN->return_sticky_link('https://reactjs.org/docs/getting-started.html', 'crnrstn_documentation_react_get_started') . '" target="_blank">Get started.</a>
                            <br><br>
                            <a href="' . $this->oCRNRSTN->return_sticky_link('https://reactjs.org/tutorial/tutorial.html', 'crnrstn_documentation_react_take_the_tutorial') . '" target="_blank">Take the Tutorial.</a>
                            <br><br>
                            ' . $this->oCRNRSTN->return_sticky_media_link('GITHUB_SMALL', 'https://github.com/facebook/react') . '&nbsp;
                            ' . $this->oCRNRSTN->return_sticky_media_link('STACKOVERFLOW_SMALL', 'https://stackoverflow.com/questions/tagged/reactjs') . '&nbsp;
                            ' . $this->oCRNRSTN->return_sticky_media_link('FACEBOOK_SMALL', 'https://www.facebook.com/react') . '&nbsp;
                            ' . $this->oCRNRSTN->return_sticky_media_link('TWITTER_SMALL', 'https://twitter.com/reactjs');
                $tmp_output_ARRAY['URL'][] = 'https://reactjs.org/';

            break;
            case 'CRNRSTN_JS_FRAMEWORK_REACT_DOM':
            case CRNRSTN_JS_FRAMEWORK_REACT_DOM:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_JS_FRAMEWORK_REACT_DOM;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_JS_FRAMEWORK_REACT_DOM';
                $tmp_output_ARRAY['TITLE'] = 'ReactDOM';
                $tmp_output_ARRAY['VERSION'] = '18.2.0';
                $tmp_output_ARRAY['BROWSER_COMPATIBILITY'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = 'The react-dom package provides DOM-specific methods that can be used 
                            at the top level of your app and as an escape hatch to get outside the React model if you 
                            need to do so. React is a JavaScript library for building user interfaces. React makes it 
                            painless to create interactive UIs. Design simple views for each state in your application, 
                            and React will efficiently update and render just the right components when your data changes.
                            <br><br>
                            Declarative views make your code more predictable and easier to debug.
                            <br><br>
                            <a href="' . $this->oCRNRSTN->return_sticky_link('https://reactjs.org/docs/getting-started.html', 'crnrstn_documentation_react_dom_get_started') . '" target="_blank">Get started.</a>
                            <br><br>
                            <a href="' . $this->oCRNRSTN->return_sticky_link('https://reactjs.org/tutorial/tutorial.html', 'crnrstn_documentation_react_dom_take_the_tutorial') . '" target="_blank">Take the Tutorial.</a>
                            <br><br>
                            ' . $this->oCRNRSTN->return_sticky_media_link('GITHUB_SMALL', 'https://github.com/facebook/react') . '&nbsp;
                            ' . $this->oCRNRSTN->return_sticky_media_link('STACKOVERFLOW_SMALL', 'https://stackoverflow.com/questions/tagged/reactjs') . '&nbsp;
                            ' . $this->oCRNRSTN->return_sticky_media_link('FACEBOOK_SMALL', 'https://www.facebook.com/react') . '&nbsp;
                            ' . $this->oCRNRSTN->return_sticky_media_link('TWITTER_SMALL', 'https://twitter.com/reactjs');
                $tmp_output_ARRAY['URL'][] = 'https://reactjs.org/';

            break;
            case 'CRNRSTN_JS_FRAMEWORK_MITHRIL':
            case CRNRSTN_JS_FRAMEWORK_MITHRIL:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_JS_FRAMEWORK_MITHRIL;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_JS_FRAMEWORK_MITHRIL';
                $tmp_output_ARRAY['TITLE'] = 'Mithril.js';
                $tmp_output_ARRAY['VERSION'] = '2.2.2';
                $tmp_output_ARRAY['BROWSER_COMPATIBILITY'] = 'IE11, Firefox ESR, Firefox, Edge, Safari, Chrome';
                $tmp_output_ARRAY['DESCRIPTION'] = 'Mithril.js is a modern client-side JavaScript framework for building 
                            Single Page Applications. It\'s small (&LT; 10kb gzip), fast, and provides routing and XHR 
                            utilities out of the box.
                            <br><br>
                            Mithril.js is used by companies like Vimeo and Nike, and open source platforms like Lichess.
                            <br><br>
                            If you are an experienced developer and want to know how Mithril.js compares to other frameworks, see the 
                            <a href="' . $this->oCRNRSTN->return_sticky_link('https://mithril.js.org/framework-comparison.html', 'crnrstn_documentation_mithril_js_framework_comparison') . '" target="_blank">framework comparison</a> 
                            page.
                            <br><br>
                            Mithril.js supports IE11, Firefox ESR, and the last two versions of Firefox, Edge, Safari, and Chrome. No polyfills required.
                            <br><br>
                            Looking for the v1 docs? <a href="' . $this->oCRNRSTN->return_sticky_link('https://mithril.js.org/archive/v1.1.7/index.html', 'crnrstn_documentation_mithril_js_v1_docs_click_here') . '" target="_blank">Click here.</a>
                            <br><br>
                            ' . $this->oCRNRSTN->return_sticky_media_link('GITHUB_SMALL', 'https://github.com/MithrilJS/mithril.js');

                $tmp_output_ARRAY['URL'][] = 'https://mithril.js.org/';

            break;
            case 'CRNRSTN_JS_FRAMEWORK_BACKBONE':
            case CRNRSTN_JS_FRAMEWORK_BACKBONE:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_JS_FRAMEWORK_BACKBONE;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_JS_FRAMEWORK_BACKBONE';
                $tmp_output_ARRAY['TITLE'] = 'BACKBONE.JS';
                $tmp_output_ARRAY['VERSION'] = '1.4.1';
                $tmp_output_ARRAY['BROWSER_COMPATIBILITY'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = 'Backbone.js gives structure to web applications by providing models 
                            with key-value binding and custom events, collections with a rich API of enumerable functions, 
                            views with declarative event handling, and connects it all to your existing API over a 
                            RESTful JSON interface.
                            <br><br>
                            The project is <a href="' . $this->oCRNRSTN->return_sticky_link('https://github.com/jashkenas/backbone/', 'crnrstn_documentation_backbonejs_hosted_github') . '" target="_blank">hosted on GitHub</a>, 
                            and the <a href="' . $this->oCRNRSTN->return_sticky_link('https://backbonejs.org/docs/backbone.html', 'crnrstn_documentation_backbonejs_annotated_source_code') . '" target="_blank">annotated source code</a> 
                            is available, as well as an online <a href="' . $this->oCRNRSTN->return_sticky_link('https://backbonejs.org/test/', 'crnrstn_documentation_backbonejs_test_suite')  . '" target="_blank">test suite</a>, 
                            an <a href="' . $this->oCRNRSTN->return_sticky_link('https://backbonejs.org/examples/todos/index.html', 'crnrstn_documentation_backbonejs_example_application').'" target="_blank">example application</a>, 
                            a <a href="' . $this->oCRNRSTN->return_sticky_link('https://github.com/jashkenas/backbone/wiki/Tutorials%2C-blog-posts-and-example-sites', 'crnrstn_documentation_backbonejs_list_of_tutorials').'" target="_blank">list of tutorials</a> and a <a href="' . $this->oCRNRSTN->return_sticky_link('https://backbonejs.org/#examples', 'crnrstn_documentation_backbonejs_real_world_projects') . '" target="_blank">long list of real-world projects</a> 
                            that use Backbone. Backbone is available for use under the <a href="#" onclick="oCRNRSTN_JS.crnrstn_interact_ui_ux(\'mit_license_modal\', this);" target="_self">MIT software license</a>.
                            <br><br>
                            You can report bugs and discuss features on the <a href="' . $this->oCRNRSTN->return_sticky_link('https://github.com/jashkenas/backbone/issues', 'crnrstn_documentation_backbonejs_github_issues_page') . '" target="_blank">GitHub issues page</a>, 
                            or add pages to the <a href="' . $this->oCRNRSTN->return_sticky_link('https://github.com/jashkenas/backbone/wiki', 'crnrstn_documentation_backbonejs_wiki') . '" target="_blank">wiki</a>.
                            <br><br>
                            <em>Backbone is an open-source component of <a href="' . $this->oCRNRSTN->return_sticky_link('https://documentcloud.org/', 'crnrstn_documentation_backbonejs_documentcloud') . '" target="_blank">DocumentCloud</a></em>.                           
                            <br><br>
                            ' . $this->oCRNRSTN->return_sticky_media_link('GITHUB_SMALL', 'https://github.com/jashkenas/backbone');
                $tmp_output_ARRAY['URL'][] = 'https://backbonejs.org/';

            break;
            case 'CRNRSTN_JS_FRAMEWORK_PROTOTYPE':
            case CRNRSTN_JS_FRAMEWORK_PROTOTYPE:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_JS_FRAMEWORK_PROTOTYPE;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_JS_FRAMEWORK_PROTOTYPE';
                $tmp_output_ARRAY['TITLE'] = 'Prototype';
                $tmp_output_ARRAY['VERSION'] = '1.7.3';
                $tmp_output_ARRAY['BROWSER_COMPATIBILITY'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = 'Prototype takes the complexity out of client-side web programming. 
                            Built to solve real-world problems, it adds useful extensions to the browser scripting 
                            environment and provides elegant APIs around the clumsy interfaces of Ajax and the Document 
                            Object Model.
                            <br><br>
                            Getting started: 
                            <br>&nbsp;&bullet; <a href="' . $this->oCRNRSTN->return_sticky_link('http://prototypejs.org/learn/class-inheritance', 'crnrstn_documentation_prototypejs_defining_classes_inheritance') . '" target="_blank">Defining classes and inheritance</a> 
                            <br>&nbsp;&bullet; <a href="' . $this->oCRNRSTN->return_sticky_link('http://prototypejs.org/learn/extensions', 'crnrstn_documentation_prototypejs_how_prototype_extends_dom') . '" target="_blank">How Prototype extends the DOM</a> 
                            <br>&nbsp;&bullet; <a href="' . $this->oCRNRSTN->return_sticky_link('http://prototypejs.org/learn/introduction-to-ajax', 'crnrstn_documentation_prototypejs_intro_to_ajax') . '" target="_blank">Introduction to Ajax</a> 
                            <br>&nbsp;&bullet; <a href="' . $this->oCRNRSTN->return_sticky_link('http://prototypejs.org/learn/json', 'crnrstn_documentation_prototypejs_using_json') . '" target="_blank">Using JSON</a> 
                            <br>&nbsp;&bullet; <a href="' . $this->oCRNRSTN->return_sticky_link('http://prototypejs.org/learn/event-delegation', 'crnrstn_documentation_prototypejs_event_delegation') . '" target="_blank">Event delegation</a> 
                            <br>&nbsp;&bullet; <a href="' . $this->oCRNRSTN->return_sticky_link('http://prototypejs.org/learn/element-layout', 'crnrstn_documentation_prototypejs_using_element.layout') . '" target="_blank">Using Element.Layout</a>
                            <br><br>
                            <!-- https://groups.google.com/g/prototype-scriptaculous?pli=1 -->
                            <a href="' . $this->oCRNRSTN->return_sticky_link('http://prototypejs.org/blog', 'crnrstn_documentation_prototypejs_weblog') . '" target="_blank">Weblog</a>';
                $tmp_output_ARRAY['URL'][] = 'http://prototypejs.org/';

            break;
            case 'CRNRSTN_JS_FRAMEWORK_SCRIPTACULOUS':
            case CRNRSTN_JS_FRAMEWORK_SCRIPTACULOUS:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_JS_FRAMEWORK_SCRIPTACULOUS;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_JS_FRAMEWORK_SCRIPTACULOUS';
                $tmp_output_ARRAY['TITLE'] = 'script.aculo.us';
                $tmp_output_ARRAY['VERSION'] = '1.9.0';
                $tmp_output_ARRAY['BROWSER_COMPATIBILITY'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = 'script.aculo.us provides you with easy-to-use, cross-browser user 
                            interface JavaScript libraries to make your web sites and web applications fly.<br><br>
                            What\'s inside? animation framework, drag and drop, Ajax controls DOM utilities, and 
                            unit testing.<br><br>
                            It\'s an add-on to the fantastic Prototype framework.
                            <br><br>
                            What\'s inside? animation framework, drag and drop, Ajax controls, DOM utilities, and unit testing.
                            <br><br>
                            It\'s an add-on to the fantastic <a href="' . $this->oCRNRSTN->return_sticky_link('http://prototypejs.org/', 'crnrstn_documentation_script.aculo.us_prototype') . '" target="_blank">Prototype</a>
                            framework.';
                $tmp_output_ARRAY['URL'][] = 'http://script.aculo.us/';

            break;
            case 'CRNRSTN_JS_FRAMEWORK_PROTOTYPE_MOOFX':
            case CRNRSTN_JS_FRAMEWORK_PROTOTYPE_MOOFX:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_JS_FRAMEWORK_PROTOTYPE_MOOFX;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_JS_FRAMEWORK_PROTOTYPE_MOOFX';
                $tmp_output_ARRAY['TITLE'] = 'moo.fx';
                $tmp_output_ARRAY['VERSION'] = '2.0';
                $tmp_output_ARRAY['BROWSER_COMPATIBILITY'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = 'moo.fx is a superlightweight, ultratiny, megasmall javascript 
                            effects library, to be used with prototype.js or the mootools framework.
                            <br><br>
                            It\'s very easy to use, blazing fast, cross-browser, standards compliant, provides controls 
                            to modify any CSS property of any HTML element, including colors, with builtin checks that 
                            won\'t let a user break the effect with multiple, crazy clicks. Optimized to make you write 
                            the lesser code possible, the new moo.fx is so modular you can create any kind of effect 
                            with it.<br><br>
                            moo.fx is open source, released under the very liberal <a href="#" onclick="oCRNRSTN_JS.crnrstn_interact_ui_ux(\'mit_license_modal\', this);" target="_self">MIT License</a>, 
                            so feel free to do anything you want with it.';
                $tmp_output_ARRAY['URL'][] = 'https://web.archive.org/web/20080430210446/http://moofx.mad4milk.net/';

            break;
            case 'CRNRSTN_JS_FRAMEWORK_LIGHTBOX_DOT_JS_2_03_3':
            case CRNRSTN_JS_FRAMEWORK_LIGHTBOX_DOT_JS_2_03_3:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_JS_FRAMEWORK_LIGHTBOX_DOT_JS_2_03_3;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_JS_FRAMEWORK_LIGHTBOX_DOT_JS_2_03_3';
                $tmp_output_ARRAY['TITLE'] = 'LIGHTBOX';
                $tmp_output_ARRAY['VERSION'] = '2.03.3';
                $tmp_output_ARRAY['BROWSER_COMPATIBILITY'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = 'The original lightbox script (circa 2008) which will load using 
                            prototype.js.
                            <br><br>
                            ' . $this->oCRNRSTN->return_sticky_media_link('TWITTER_SMALL', 'https://twitter.com/lokesh');
                $tmp_output_ARRAY['URL'][] = 'https://lokeshdhakar.com/projects/lightbox2/';

            break;
            case 'CRNRSTN_JS_FRAMEWORK_MOOTOOLS_MORE':
            case CRNRSTN_JS_FRAMEWORK_MOOTOOLS_MORE:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_JS_FRAMEWORK_MOOTOOLS_MORE;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_JS_FRAMEWORK_MOOTOOLS_MORE';
                $tmp_output_ARRAY['TITLE'] = 'MooTools MORE (all boxes checked + full core)';
                $tmp_output_ARRAY['VERSION'] = '1.6.0';
                $tmp_output_ARRAY['BROWSER_COMPATIBILITY'] = 'IE, Firefox, Safari, Chrome, Opera, PhantomJS (virtual browser).';
                $tmp_output_ARRAY['DESCRIPTION'] = 'Welcome to MooTools More, the official plugin repository for the 
                MooTools JavaScript Framework. More includes extra features to Core classes and UI. MooTools More makes 
                MooTools even More awesome.
                <br><br>
                MooTools is a collection of JavaScript utilities designed for the 
                intermediate to advanced JavaScript developer. It allows you to write powerful and flexible code with 
                its elegant, well documented, and coherent APIs. MooTools code is extensively documented and easy to 
                read, enabling you to extend the functionality to match your requirements.
                <br><br>
                MooTools is compatible and fully tested with Safari, internet explorer 6 and 7, Firefox (and its mozilla 
                friends), Opera and Camino.
                <br><br>
                MooTools libraries are released under the Open Source <a href="#" onclick="oCRNRSTN_JS.crnrstn_interact_ui_ux(\'mit_license_modal\', this);" target="_self">MIT license</a>
                which gives you the possibility to use them and modify them in every circumstance.
                <br><br>
                ' . $this->oCRNRSTN->return_sticky_media_link('GITHUB_SMALL', 'https://github.com/mootools/mootools-more') . '&nbsp;
                ' . $this->oCRNRSTN->return_sticky_media_link('TWITTER_SMALL', 'https://twitter.com/mootools') . '&nbsp;
                ' . $this->oCRNRSTN->return_sticky_media_link('FACEBOOK_SMALL', 'https://www.facebook.com/mootools') . '&nbsp;
                ' . $this->oCRNRSTN->return_sticky_media_link('STACKOVERFLOW_SMALL', 'https://stackoverflow.com/questions/tagged/mootools');

                $tmp_output_ARRAY['URL'][] = 'https://mootools.net/more/docs/1.6.0';

            break;
            case 'CRNRSTN_JS_FRAMEWORK_MOOTOOLS_CORE':
            case CRNRSTN_JS_FRAMEWORK_MOOTOOLS_CORE:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_JS_FRAMEWORK_MOOTOOLS_CORE;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_JS_FRAMEWORK_MOOTOOLS_CORE';
                $tmp_output_ARRAY['TITLE'] = 'MooTools CORE';
                $tmp_output_ARRAY['VERSION'] = '1.6.0';
                $tmp_output_ARRAY['BROWSER_COMPATIBILITY'] = 'IE, Firefox, Safari, Chrome, Opera, PhantomJS (virtual browser).';
                $tmp_output_ARRAY['DESCRIPTION'] = 'MooTools is a compact, modular, Object-Oriented JavaScript framework 
                designed for the intermediate to advanced JavaScript developer. It allows you to write powerful, 
                flexible, and cross-browser code with its elegant, well documented, and coherent API.
                <br><br>
                MooTools is compatible and fully tested with Safari, internet explorer 6 and 7, Firefox (and its mozilla 
                friends), Opera and Camino.
                <br><br>
                MooTools libraries are released under the Open Source <a href="#" onclick="oCRNRSTN_JS.crnrstn_interact_ui_ux(\'mit_license_modal\', this);" target="_self">MIT license</a> 
                which gives you the possibility to use them and modify them in every circumstance.
                <br><br>
                ' . $this->oCRNRSTN->return_sticky_media_link('GITHUB_SMALL', 'https://github.com/mootools/mootools-core') . '&nbsp
                ' . $this->oCRNRSTN->return_sticky_media_link('TWITTER_SMALL', 'https://twitter.com/mootools') . '&nbsp;
                ' . $this->oCRNRSTN->return_sticky_media_link('FACEBOOK_SMALL', 'https://www.facebook.com/mootools') . '&nbsp;
                ' . $this->oCRNRSTN->return_sticky_media_link('STACKOVERFLOW_SMALL', 'https://stackoverflow.com/questions/tagged/mootools');
                $tmp_output_ARRAY['URL'][] = 'https://mootools.net/core/docs/1.6.0';

            break;
            case 'CRNRSTN_UI_JS_MAIN':
            case CRNRSTN_UI_JS_MAIN:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_UI_JS_MAIN;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_UI_JS_MAIN';
                $tmp_output_ARRAY['TITLE'] = 'CRNRSTN :: INTERACT UI/UX JS';
                $tmp_output_ARRAY['TITLE_DISPLAY'] = 'C<span class="the_R_in_crnrstn">R</span>NRSTN :: INTERACT UI/UX JS';
                $tmp_output_ARRAY['VERSION'] = '1.00.0000 PRE-ALPHA-DEV (Lightsaber)';
                $tmp_output_ARRAY['BROWSER_COMPATIBILITY'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = 'The oCRNRSTN_JS object was built starting from the latest release of
                                                    LIGHTBOX.JS and supports the mobile, tablet, and desktop experience
                                                    for C<span class="the_R_in_crnrstn">R</span>NRSTN :: INTERACT UI.
                                                    <br><br>
                                                    ' . $this->oCRNRSTN->return_system_image('FIVE', 35, 35, NULL, NULL, NULL, NULL, CRNRSTN_UI_IMG_HTML_WRAPPED);
                $tmp_output_ARRAY['URL'][] = '';

            break;
            case 'CRNRSTN_CSS_FRAMEWORK_SIMPLE_GRID':
            case CRNRSTN_CSS_FRAMEWORK_SIMPLE_GRID:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_CSS_FRAMEWORK_SIMPLE_GRID;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_CSS_FRAMEWORK_SIMPLE_GRID';
                $tmp_output_ARRAY['TITLE'] = 'Simple Grid';
                $tmp_output_ARRAY['VERSION'] = '';
                $tmp_output_ARRAY['BROWSER_COMPATIBILITY'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = 'Responsive; your website will 
                            display beautifully, no matter the device or screen type. Lightweight; the CSS is super 
                            light, so you won’t have to worry about adding to page load times. Simple; Simple Grid is 
                            made for all skill levels, so you can jump right into your project. Simple Grid is a 
                            12-column, lightweight CSS grid to help you quickly build responsive websites. 
                            Download the CSS stylesheet, add the appropriate classes to your markup, and you\'re off to 
                            the races. It’s that simple.<br><br>
                            Each column is contained within rows, which are contained within a container. The container 
                            is set to a maximum width of 960px, but you can edit without having to break anything.
                            <br><br>
                            ' . $this->oCRNRSTN->return_sticky_media_link('TWITTER_SMALL', 'https://twitter.com/ZachACole') . '&nbsp;
                            ' . $this->oCRNRSTN->return_sticky_media_link('WWW_SMALL', 'https://zcole.me/') . '&nbsp;
                            ' . $this->oCRNRSTN->return_sticky_media_link('GITHUB_SMALL', 'https://github.com/zachacole/Simple-Grid');
                $tmp_output_ARRAY['URL'][] = 'https://simplegrid.io/';

            break;
            case 'CRNRSTN_CSS_FRAMEWORK_960_GRID_SYSTEM':
            case CRNRSTN_CSS_FRAMEWORK_960_GRID_SYSTEM:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_CSS_FRAMEWORK_960_GRID_SYSTEM;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_CSS_FRAMEWORK_960_GRID_SYSTEM';
                $tmp_output_ARRAY['TITLE'] = '960 Grid System';
                $tmp_output_ARRAY['VERSION'] = '';
                $tmp_output_ARRAY['BROWSER_COMPATIBILITY'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = 'The 960 Grid System is an effort to streamline web development 
                            workflow by providing commonly used dimensions, based on a width of 960 pixels. There are 
                            two variants: 12 and 16 columns, which can be used separately or in tandem.
                            <br><br>
                            <!-- CRNRSTN :: COMMUNITY OVER CODE -->
                            ' . $this->oCRNRSTN->return_sticky_media_link('LINKEDIN_SMALL', 'https://www.linkedin.com/in/nathan/') . '&nbsp;
                            ' . $this->oCRNRSTN->return_sticky_media_link('WWW_SMALL', 'https://sonspring.com/') . '&nbsp;
                            ' . $this->oCRNRSTN->return_sticky_media_link('FLICKR_SMALL', 'https://flickr.com/photos/nathansmith') . '&nbsp;
                            ' . $this->oCRNRSTN->return_sticky_media_link('GITHUB_SMALL', 'https://github.com/nathansmith/960-grid-system/');
                $tmp_output_ARRAY['URL'][] = 'https://960.gs/';

            break;
            case 'CRNRSTN_CSS_FRAMEWORK_960_GRID_SYSTEM_24COL':
            case CRNRSTN_CSS_FRAMEWORK_960_GRID_SYSTEM_24COL:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_CSS_FRAMEWORK_960_GRID_SYSTEM_24COL;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_CSS_FRAMEWORK_960_GRID_SYSTEM_24COL';
                $tmp_output_ARRAY['TITLE'] = '960 Grid System';
                $tmp_output_ARRAY['VERSION'] = '';
                $tmp_output_ARRAY['BROWSER_COMPATIBILITY'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = 'The 960 Grid System is an effort to streamline web development 
                                workflow by providing commonly used dimensions, based on a width of 960 pixels. There are 
                                two variants: 12 and 16 columns, which can be used separately or in tandem.
                                <br><br>
                                <!-- CRNRSTN :: COMMUNITY OVER CODE -->
                                ' . $this->oCRNRSTN->return_sticky_media_link('LINKEDIN_SMALL', 'https://www.linkedin.com/in/nathan/') . '&nbsp;
                                ' . $this->oCRNRSTN->return_sticky_media_link('WWW_SMALL', 'https://sonspring.com/') . '&nbsp;
                                ' . $this->oCRNRSTN->return_sticky_media_link('FLICKR_SMALL', 'https://flickr.com/photos/nathansmith') . '&nbsp;
                                ' . $this->oCRNRSTN->return_sticky_media_link('GITHUB_SMALL', 'https://github.com/nathansmith/960-grid-system/');
                $tmp_output_ARRAY['URL'][] = 'https://960.gs/';

            break;
            case 'CRNRSTN_CSS_FRAMEWORK_960_GRID_SYSTEM_16COL':
            case CRNRSTN_CSS_FRAMEWORK_960_GRID_SYSTEM_16COL:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_CSS_FRAMEWORK_960_GRID_SYSTEM_16COL;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_CSS_FRAMEWORK_960_GRID_SYSTEM_16COL';
                $tmp_output_ARRAY['TITLE'] = '960 Grid System';
                $tmp_output_ARRAY['VERSION'] = '';
                $tmp_output_ARRAY['BROWSER_COMPATIBILITY'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = 'The 960 Grid System is an effort to streamline web development 
                                workflow by providing commonly used dimensions, based on a width of 960 pixels. There are 
                                two variants: 12 and 16 columns, which can be used separately or in tandem.
                                <br><br>
                                <!-- CRNRSTN :: COMMUNITY OVER CODE -->
                                ' . $this->oCRNRSTN->return_sticky_media_link('LINKEDIN_SMALL', 'https://www.linkedin.com/in/nathan/') . '&nbsp;
                                ' . $this->oCRNRSTN->return_sticky_media_link('WWW_SMALL', 'https://sonspring.com/') . '&nbsp;
                                ' . $this->oCRNRSTN->return_sticky_media_link('FLICKR_SMALL', 'https://flickr.com/photos/nathansmith') . '&nbsp;
                                ' . $this->oCRNRSTN->return_sticky_media_link('GITHUB_SMALL', 'https://github.com/nathansmith/960-grid-system/');
                $tmp_output_ARRAY['URL'][] = 'https://960.gs/';

            break;
            case 'CRNRSTN_CSS_FRAMEWORK_960_GRID_SYSTEM_12COL':
            case CRNRSTN_CSS_FRAMEWORK_960_GRID_SYSTEM_12COL:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_CSS_FRAMEWORK_960_GRID_SYSTEM_12COL;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_CSS_FRAMEWORK_960_GRID_SYSTEM_12COL';
                $tmp_output_ARRAY['TITLE'] = '960 Grid System';
                $tmp_output_ARRAY['VERSION'] = '';
                $tmp_output_ARRAY['BROWSER_COMPATIBILITY'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = 'The 960 Grid System is an effort to streamline web development 
                                workflow by providing commonly used dimensions, based on a width of 960 pixels. There are 
                                two variants: 12 and 16 columns, which can be used separately or in tandem.
                                <br><br>
                                <!-- CRNRSTN :: COMMUNITY OVER CODE -->
                                ' . $this->oCRNRSTN->return_sticky_media_link('LINKEDIN_SMALL', 'https://www.linkedin.com/in/nathan/') . '&nbsp;
                                ' . $this->oCRNRSTN->return_sticky_media_link('WWW_SMALL', 'https://sonspring.com/') . '&nbsp;
                                ' . $this->oCRNRSTN->return_sticky_media_link('FLICKR_SMALL', 'https://flickr.com/photos/nathansmith') . '&nbsp;
                                ' . $this->oCRNRSTN->return_sticky_media_link('GITHUB_SMALL', 'https://github.com/nathansmith/960-grid-system/');
                $tmp_output_ARRAY['URL'][] = 'https://960.gs/';

            break;
            case 'CRNRSTN_CSS_FRAMEWORK_960_GRID_SYSTEM_24COL_RTL':
            case CRNRSTN_CSS_FRAMEWORK_960_GRID_SYSTEM_24COL_RTL:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_CSS_FRAMEWORK_960_GRID_SYSTEM_24COL_RTL;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_CSS_FRAMEWORK_960_GRID_SYSTEM_24COL_RTL';
                $tmp_output_ARRAY['TITLE'] = '960 Grid System';
                $tmp_output_ARRAY['VERSION'] = '';
                $tmp_output_ARRAY['BROWSER_COMPATIBILITY'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = 'The 960 Grid System is an effort to streamline web development 
                            workflow by providing commonly used dimensions, based on a width of 960 pixels. There are 
                            two variants: 12 and 16 columns, which can be used separately or in tandem.
                            <br><br>
                            <!-- CRNRSTN :: COMMUNITY OVER CODE -->
                            ' . $this->oCRNRSTN->return_sticky_media_link('LINKEDIN_SMALL', 'https://www.linkedin.com/in/nathan/') . '&nbsp;
                            ' . $this->oCRNRSTN->return_sticky_media_link('WWW_SMALL', 'https://sonspring.com/') . '&nbsp;
                            ' . $this->oCRNRSTN->return_sticky_media_link('FLICKR_SMALL', 'https://flickr.com/photos/nathansmith') . '&nbsp;
                            ' . $this->oCRNRSTN->return_sticky_media_link('GITHUB_SMALL', 'https://github.com/nathansmith/960-grid-system/');
                $tmp_output_ARRAY['URL'][] = 'https://960.gs/';

            break;
            case 'CRNRSTN_CSS_FRAMEWORK_960_GRID_SYSTEM_16COL_RTL':
            case CRNRSTN_CSS_FRAMEWORK_960_GRID_SYSTEM_16COL_RTL:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_CSS_FRAMEWORK_960_GRID_SYSTEM_16COL_RTL;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_CSS_FRAMEWORK_960_GRID_SYSTEM_16COL_RTL';
                $tmp_output_ARRAY['TITLE'] = '960 Grid System';
                $tmp_output_ARRAY['VERSION'] = '';
                $tmp_output_ARRAY['BROWSER_COMPATIBILITY'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = 'The 960 Grid System is an effort to streamline web development 
                            workflow by providing commonly used dimensions, based on a width of 960 pixels. There are 
                            two variants: 12 and 16 columns, which can be used separately or in tandem.
                            <br><br>
                            <!-- CRNRSTN :: COMMUNITY OVER CODE -->
                            ' . $this->oCRNRSTN->return_sticky_media_link('LINKEDIN_SMALL', 'https://www.linkedin.com/in/nathan/') . '&nbsp;
                            ' . $this->oCRNRSTN->return_sticky_media_link('WWW_SMALL', 'https://sonspring.com/') . '&nbsp;
                            ' . $this->oCRNRSTN->return_sticky_media_link('FLICKR_SMALL', 'https://flickr.com/photos/nathansmith') . '&nbsp;
                            ' . $this->oCRNRSTN->return_sticky_media_link('GITHUB_SMALL', 'https://github.com/nathansmith/960-grid-system/');
                $tmp_output_ARRAY['URL'][] = 'https://960.gs/';

            break;
            case 'CRNRSTN_CSS_FRAMEWORK_960_GRID_SYSTEM_12COL_RTL':
            case CRNRSTN_CSS_FRAMEWORK_960_GRID_SYSTEM_12COL_RTL:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_CSS_FRAMEWORK_960_GRID_SYSTEM_12COL_RTL;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_CSS_FRAMEWORK_960_GRID_SYSTEM_12COL_RTL';
                $tmp_output_ARRAY['TITLE'] = '960 Grid System';
                $tmp_output_ARRAY['VERSION'] = '';
                $tmp_output_ARRAY['BROWSER_COMPATIBILITY'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = 'The 960 Grid System is an effort to streamline web development 
                            workflow by providing commonly used dimensions, based on a width of 960 pixels. There are 
                            two variants: 12 and 16 columns, which can be used separately or in tandem.
                            <br><br>
                            <!-- CRNRSTN :: COMMUNITY OVER CODE -->
                            ' . $this->oCRNRSTN->return_sticky_media_link('LINKEDIN_SMALL', 'https://www.linkedin.com/in/nathan/') . '&nbsp;
                            ' . $this->oCRNRSTN->return_sticky_media_link('WWW_SMALL', 'https://sonspring.com/') . '&nbsp;
                            ' . $this->oCRNRSTN->return_sticky_media_link('FLICKR_SMALL', 'https://flickr.com/photos/nathansmith') . '&nbsp;
                            ' . $this->oCRNRSTN->return_sticky_media_link('GITHUB_SMALL', 'https://github.com/nathansmith/960-grid-system/');
                $tmp_output_ARRAY['URL'][] = 'https://960.gs/';

            break;
            case 'CRNRSTN_CSS_FRAMEWORK_960_GRID_SYSTEM_RTL':
            case CRNRSTN_CSS_FRAMEWORK_960_GRID_SYSTEM_RTL:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_CSS_FRAMEWORK_960_GRID_SYSTEM_RTL;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_CSS_FRAMEWORK_960_GRID_SYSTEM_RTL';
                $tmp_output_ARRAY['TITLE'] = '960 Grid System';
                $tmp_output_ARRAY['VERSION'] = '';
                $tmp_output_ARRAY['BROWSER_COMPATIBILITY'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = 'The 960 Grid System is an effort to streamline web development 
                            workflow by providing commonly used dimensions, based on a width of 960 pixels. There are 
                            two variants: 12 and 16 columns, which can be used separately or in tandem.
                            <br><br>
                            <!-- CRNRSTN :: COMMUNITY OVER CODE -->
                            ' . $this->oCRNRSTN->return_sticky_media_link('LINKEDIN_SMALL', 'https://www.linkedin.com/in/nathan/') . '&nbsp;
                            ' . $this->oCRNRSTN->return_sticky_media_link('WWW_SMALL', 'https://sonspring.com/') . '&nbsp;
                            ' . $this->oCRNRSTN->return_sticky_media_link('FLICKR_SMALL', 'https://flickr.com/photos/nathansmith') . '&nbsp;
                            ' . $this->oCRNRSTN->return_sticky_media_link('GITHUB_SMALL', 'https://github.com/nathansmith/960-grid-system/');
                $tmp_output_ARRAY['URL'][] = 'https://960.gs/';

            break;
            case 'CRNRSTN_CSS_FRAMEWORK_FOUNDATION':
            case CRNRSTN_CSS_FRAMEWORK_FOUNDATION:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_CSS_FRAMEWORK_FOUNDATION;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_CSS_FRAMEWORK_FOUNDATION';
                $tmp_output_ARRAY['TITLE'] = 'Foundation';
                $tmp_output_ARRAY['VERSION'] = '0.00.0000';
                $tmp_output_ARRAY['BROWSER_COMPATIBILITY'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = 'The most advanced responsive 
                            front-end framework in the world. A Framework for any device, medium, and accessibility. 
                            Foundation is a family of responsive front-end frameworks that make it easy to design 
                            beautiful responsive websites, apps and emails that look amazing on any device. Foundation 
                            is semantic, readable, flexible, and completely customizable. We’re constantly adding new 
                            resources and code snippets, including handy HTML templates to help get you started!
                            <br><br>
                            ' . $this->oCRNRSTN->return_sticky_media_link('YOUTUBE_SMALL', 'https://www.youtube.com/channel/UCS7eqSwmBYuslPEKeJBq-kg') . '&nbsp;
                            ' . $this->oCRNRSTN->return_sticky_media_link('TWITTER_SMALL', 'https://twitter.com/FoundationCSS') . '&nbsp;
                            ' . $this->oCRNRSTN->return_sticky_media_link('GITHUB_SMALL', 'https://github.com/foundation/foundation-sites/');
                $tmp_output_ARRAY['URL'][] = 'https://get.foundation/';

            break;
            case 'CRNRSTN_CSS_FRAMEWORK_HTML5_BOILERPLATE':
            case CRNRSTN_CSS_FRAMEWORK_HTML5_BOILERPLATE:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_CSS_FRAMEWORK_HTML5_BOILERPLATE;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_CSS_FRAMEWORK_HTML5_BOILERPLATE';
                $tmp_output_ARRAY['TITLE'] = 'HTML5 Boilerplate';
                $tmp_output_ARRAY['VERSION'] = '0.00.0000';
                $tmp_output_ARRAY['BROWSER_COMPATIBILITY'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = 'The web\'s most popular front-end template, HTML5 Boilerplate helps 
                            you build fast, robust, and adaptable web apps or sites. Kick-start your project with the 
                            combined knowledge and effort of 100s of developers, all in one little package.
                            <br><br>
                            ' . $this->oCRNRSTN->return_sticky_media_link('TWITTER_SMALL', 'https://twitter.com/h5bp') . '&nbsp;
                            ' . $this->oCRNRSTN->return_sticky_media_link('GITHUB_SMALL', 'https://github.com/h5bp/html5-boilerplate/') . '&nbsp;
                            ' . $this->oCRNRSTN->return_sticky_media_link('STACKOVERFLOW_SMALL', 'https://stackoverflow.com/questions/tagged/html5boilerplate');
                $tmp_output_ARRAY['URL'][] = 'https://html5boilerplate.com/';

            break;
            case 'CRNRSTN_CSS_FRAMEWORK_RESPONSIVE_GRID_SYSTEM':
            case CRNRSTN_CSS_FRAMEWORK_RESPONSIVE_GRID_SYSTEM:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_CSS_FRAMEWORK_RESPONSIVE_GRID_SYSTEM;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_CSS_FRAMEWORK_RESPONSIVE_GRID_SYSTEM';
                $tmp_output_ARRAY['TITLE'] = 'Responsive Grid System';
                $tmp_output_ARRAY['VERSION'] = '0.00.0000';
                $tmp_output_ARRAY['BROWSER_COMPATIBILITY'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = 'Spectacularly Easy Responsive 
                            Design. The Responsive Grid System isn\'t a framework. It\'s not a boilerplate either. It\'s 
                            a quick, easy &amp; flexible way to create a responsive web site.
                            <br><br>
                            ' . $this->oCRNRSTN->return_sticky_media_link('TWITTER_SMALL', 'https://twitter.com/graham_r_miller') . '&nbsp;
                            ' . $this->oCRNRSTN->return_sticky_media_link('WWW_SMALL', 'https://www.edwardrobertson.co.uk/');
                $tmp_output_ARRAY['URL'][] = 'http://www.responsivegridsystem.com/';

            break;
            case 'CRNRSTN_CSS_FRAMEWORK_UNSEMANTIC':
            case CRNRSTN_CSS_FRAMEWORK_UNSEMANTIC:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_CSS_FRAMEWORK_UNSEMANTIC;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_CSS_FRAMEWORK_UNSEMANTIC';
                $tmp_output_ARRAY['TITLE'] = 'unsemantic';
                $tmp_output_ARRAY['VERSION'] = '0.00.0000';
                $tmp_output_ARRAY['BROWSER_COMPATIBILITY'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = 'Unsemantic is a fluid grid system that is the successor to the 960 
                            Grid System. It works in a similar way, but instead of being a set number of columns, 
                            it\'s entirely based on percentages.
                            <br><br>
                            ' . $this->oCRNRSTN->return_sticky_media_link('GITHUB_SMALL', 'https://github.com/nathansmith/unsemantic/');
                $tmp_output_ARRAY['URL'][] = 'https://unsemantic.com/';

            break;
            case 'CRNRSTN_CSS_FRAMEWORK_UNSEMANTIC_RTL':
            case CRNRSTN_CSS_FRAMEWORK_UNSEMANTIC_RTL:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_CSS_FRAMEWORK_UNSEMANTIC_RTL;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_CSS_FRAMEWORK_UNSEMANTIC_RTL';
                $tmp_output_ARRAY['TITLE'] = 'unsemantic';
                $tmp_output_ARRAY['VERSION'] = '0.00.0000';
                $tmp_output_ARRAY['BROWSER_COMPATIBILITY'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = 'Unsemantic is a fluid grid system that is the successor to the 960 
                            Grid System. It works in a similar way, but instead of being a set number of columns, 
                            it\'s entirely based on percentages.
                            <br><br>
                            ' . $this->oCRNRSTN->return_sticky_media_link('GITHUB_SMALL', 'https://github.com/nathansmith/unsemantic/');
                $tmp_output_ARRAY['URL'][] = 'https://unsemantic.com/';

            break;
            case 'CRNRSTN_CSS_FRAMEWORK_UNSEMANTIC_RESET':
            case CRNRSTN_CSS_FRAMEWORK_UNSEMANTIC_RESET:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_CSS_FRAMEWORK_UNSEMANTIC_RESET;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_CSS_FRAMEWORK_UNSEMANTIC_RESET';
                $tmp_output_ARRAY['TITLE'] = 'unsemantic';
                $tmp_output_ARRAY['VERSION'] = '0.00.0000';
                $tmp_output_ARRAY['BROWSER_COMPATIBILITY'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = 'Unsemantic is a fluid grid system that is the successor to the 960 
                            Grid System. It works in a similar way, but instead of being a set number of columns, 
                            it\'s entirely based on percentages.
                            <br><br>
                            ' . $this->oCRNRSTN->return_sticky_media_link('GITHUB_SMALL', 'https://github.com/nathansmith/unsemantic/');
                $tmp_output_ARRAY['URL'][] = 'https://unsemantic.com/';

            break;

            case 'CRNRSTN_CSS_FRAMEWORK_UNSEMANTIC_RESET_RTL':
            case CRNRSTN_CSS_FRAMEWORK_UNSEMANTIC_RESET_RTL:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_CSS_FRAMEWORK_UNSEMANTIC_RESET_RTL;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_CSS_FRAMEWORK_UNSEMANTIC_RESET_RTL';
                $tmp_output_ARRAY['TITLE'] = 'unsemantic';
                $tmp_output_ARRAY['VERSION'] = '0.00.0000';
                $tmp_output_ARRAY['BROWSER_COMPATIBILITY'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = 'Unsemantic is a fluid grid system that is the successor to the 960 
                            Grid System. It works in a similar way, but instead of being a set number of columns, 
                            it\'s entirely based on percentages.
                            <br><br>
                            ' . $this->oCRNRSTN->return_sticky_media_link('GITHUB_SMALL', 'https://github.com/nathansmith/unsemantic/');
                $tmp_output_ARRAY['URL'][] = 'https://unsemantic.com/';

            break;
            case 'CRNRSTN_CSS_FRAMEWORK_UNSEMANTIC_ADAPT':
            case CRNRSTN_CSS_FRAMEWORK_UNSEMANTIC_ADAPT:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_CSS_FRAMEWORK_UNSEMANTIC_ADAPT;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_CSS_FRAMEWORK_UNSEMANTIC_ADAPT';
                $tmp_output_ARRAY['TITLE'] = 'unsemantic';
                $tmp_output_ARRAY['VERSION'] = '0.00.0000';
                $tmp_output_ARRAY['BROWSER_COMPATIBILITY'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = 'Unsemantic is a fluid grid system that is the successor to the 960 
                            Grid System. It works in a similar way, but instead of being a set number of columns, 
                            it\'s entirely based on percentages.
                            <br><br>
                            ' . $this->oCRNRSTN->return_sticky_media_link('GITHUB_SMALL', 'https://github.com/nathansmith/unsemantic/');
                $tmp_output_ARRAY['URL'][] = 'https://unsemantic.com/';

            break;
            case 'CRNRSTN_CSS_FRAMEWORK_UNSEMANTIC_ADAPT_RTL':
            case CRNRSTN_CSS_FRAMEWORK_UNSEMANTIC_ADAPT_RTL:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_CSS_FRAMEWORK_UNSEMANTIC_ADAPT_RTL;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_CSS_FRAMEWORK_UNSEMANTIC_ADAPT_RTL';
                $tmp_output_ARRAY['TITLE'] = 'unsemantic';
                $tmp_output_ARRAY['VERSION'] = '0.00.0000';
                $tmp_output_ARRAY['BROWSER_COMPATIBILITY'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = 'Unsemantic is a fluid grid system that is the successor to the 960 
                            Grid System. It works in a similar way, but instead of being a set number of columns, 
                            it\'s entirely based on percentages.
                            <br><br>
                            ' . $this->oCRNRSTN->return_sticky_media_link('GITHUB_SMALL', 'https://github.com/nathansmith/unsemantic/');
                $tmp_output_ARRAY['URL'][] = 'https://unsemantic.com/';

            break;
            case 'CRNRSTN_CSS_FRAMEWORK_DEAD_SIMPLE_GRID':
            case CRNRSTN_CSS_FRAMEWORK_DEAD_SIMPLE_GRID:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_CSS_FRAMEWORK_DEAD_SIMPLE_GRID;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_CSS_FRAMEWORK_DEAD_SIMPLE_GRID';
                $tmp_output_ARRAY['TITLE'] = 'Dead Simple Grid';
                $tmp_output_ARRAY['VERSION'] = '0.00.0000';
                $tmp_output_ARRAY['BROWSER_COMPATIBILITY'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = 'Dead Simple Grid is a responsive CSS 
                            grid micro framework that is just that. Dead simple. It\'s the Malevich\'s Black Square of
                            grid frameworks. It is tiny (about 250 bytes of CSS) and without dependencies, has only two
                            classes (row and col), fluid columns with fixed gutters, supports infinite nesting, and
                            doesn\'t constrain you to any column sets or media query breakpoints. It embraces concepts 
                            of progressive enhancement and mobile first, serving one-column mobile layout to older 
                            browsers (IE 6-7). IE 8 is supported if you use Respond.js
                            <br><br>
                            ' . $this->oCRNRSTN->return_sticky_media_link('GITHUB_SMALL', 'https://github.com/mourner/dead-simple-grid') . '&nbsp;
                            ' . $this->oCRNRSTN->return_sticky_media_link('WWW_SMALL', 'https://agafonkin.com/');
                $tmp_output_ARRAY['URL'][] = 'https://mourner.github.io/dead-simple-grid/';

            break;
            case 'CRNRSTN_CSS_FRAMEWORK_SKELETON':
            case CRNRSTN_CSS_FRAMEWORK_SKELETON:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_CSS_FRAMEWORK_SKELETON;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_CSS_FRAMEWORK_SKELETON';
                $tmp_output_ARRAY['TITLE'] = 'SKELETON';
                $tmp_output_ARRAY['VERSION'] = '0.00.0000';
                $tmp_output_ARRAY['BROWSER_COMPATIBILITY'] = 'Chrome, Firefox, Opera, Safari, IE.';
                $tmp_output_ARRAY['DESCRIPTION'] = 'A dead simple, responsive boilerplate. Light as a feather at ~400 
                            lines &amp; built with mobile in mind. Styles designed to be a starting point, not a UI 
                            framework. Quick to start with zero compiling or installing necessary.
                            <br><br>
                            <strong>IS SKELETON FOR YOU?</strong>
                            <br>
                            You should use Skeleton if you\'re embarking on a smaller project or just don\'t feel like 
                            you need all the utility of larger frameworks. Skeleton only styles a handful of standard 
                            HTML elements and includes a grid, but that\'s often more than enough to get started.
                            <br><br>
                            Love Skeleton and want to Tweet it, share it, or star it? Well, I appreciate that <3
                            <br><br>
                            ' . $this->oCRNRSTN->return_sticky_media_link('GITHUB_SMALL', 'https://github.com/dhg/Skeleton') . '&nbsp;                            
                            ' . $this->oCRNRSTN->return_sticky_media_link('TWITTER_SMALL', 'https://twitter.com/dhg');
                $tmp_output_ARRAY['URL'][] = 'http://getskeleton.com/';

            break;
            case 'CRNRSTN_CSS_FRAMEWORK_RWDGRID':
            case CRNRSTN_CSS_FRAMEWORK_RWDGRID:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_CSS_FRAMEWORK_RWDGRID;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_CSS_FRAMEWORK_RWDGRID';
                $tmp_output_ARRAY['TITLE'] = 'RWD GRID';
                $tmp_output_ARRAY['VERSION'] = '0.00.0000';
                $tmp_output_ARRAY['BROWSER_COMPATIBILITY'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = 'Responsive Grid System for your Next Project. 2kb, Mobile First 
                            Grid System, HTML5 Boilerplate Head, 960grid like naming convention,IE8+, Firefox, Chrome, 
                            Safari, Opera, PSD Grid & included, Free to use and Abuse.
                            <br><br>
                            <!-- https://dribbble.com/gsvineeth -->
                            ' . $this->oCRNRSTN->return_sticky_media_link('TWITTER_SMALL', 'https://twitter.com/gsvineeth') . '&nbsp;
                            ' . $this->oCRNRSTN->return_sticky_media_link('GITHUB_SMALL', 'https://github.com/gsvineeth');

                $tmp_output_ARRAY['URL'][] = 'http://rwdgrid.com/';

            break;
            case 'CRNRSTN_CSS_FRAMEWORK_THISISDALLAS_SIMPLEGRID':
            case CRNRSTN_CSS_FRAMEWORK_THISISDALLAS_SIMPLEGRID:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_CSS_FRAMEWORK_THISISDALLAS_SIMPLEGRID;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_CSS_FRAMEWORK_THISISDALLAS_SIMPLEGRID';
                $tmp_output_ARRAY['TITLE'] = 'Simple Grid (ThisIsDallas)';
                $tmp_output_ARRAY['VERSION'] = '';
                $tmp_output_ARRAY['BROWSER_COMPATIBILITY'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = 'Simple Grid was created for developers who need a barebones grid. 
                            Simple Grid works well with 1140px layouts but easily adapts to any size of layout. With 
                            fluid columns, Simple Grid is responsive down to mobile.
                            <br><br>
                            Simple Grid is a basic lightweight grid, not a CSS framework. There are no styles for 
                            buttons, tables, typography etc. etc. Simple Grid comes with two different types of grids. 
                            There is a grid for content, which looks like <span class="crnrstn_general_post_code_copy">&lt;div class="col-1-3"&gt;&lt;/div&gt;&gt;</span> and a grid for 
                            layouts, which looks like <span class="crnrstn_general_post_code_copy">&lt;div class="col-4-12"&gt;&lt;/div&gt;</span>. 
                            <br><br>
                            Simple Grid is also built for responsive layouts. With fluid columns, the grid will resize 
                            to adjust to the browser resolution. To accommodate for mobile and tablet devices, the grid 
                            will essentially stack all columns, one above another, when viewed on smaller screens.
                            <br><br>
                            ' . $this->oCRNRSTN->return_sticky_media_link('GITHUB_SMALL', 'https://github.com/ThisIsDallas/Simple-Grid');

                $tmp_output_ARRAY['URL'][] = 'http://thisisdallas.github.io/Simple-Grid/';

            break;
            case 'CRNRSTN_UI_CSS_MAIN_DESKTOP':
            case CRNRSTN_UI_CSS_MAIN_DESKTOP:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_UI_CSS_MAIN_DESKTOP;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_UI_CSS_MAIN_DESKTOP';
                $tmp_output_ARRAY['TITLE'] = 'CRNRSTN :: INTERACT UI Desktop Stylesheet';
                $tmp_output_ARRAY['TITLE_DISPLAY'] = 'C<span class="the_R_in_crnrstn">R</span>NRSTN :: INTERACT UI Desktop Stylesheet';
                $tmp_output_ARRAY['VERSION'] = '1.00.0000 PRE-ALPHA-DEV (Lightsaber)';
                $tmp_output_ARRAY['BROWSER_COMPATIBILITY'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = 'The desktop stylesheet for C<span class="the_R_in_crnrstn">R</span>NRSTN :: INTERACT UI.
                                                    <br><br>
                                                    ' . $this->oCRNRSTN->return_system_image('FIVE', 35, 35, NULL, NULL, NULL, NULL, CRNRSTN_UI_IMG_HTML_WRAPPED);
                $tmp_output_ARRAY['URL'][] = '';

            break;
            case 'CRNRSTN_UI_CSS_MAIN_TABLET':
            case CRNRSTN_UI_CSS_MAIN_TABLET:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_UI_CSS_MAIN_TABLET;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_UI_CSS_MAIN_TABLET';
                $tmp_output_ARRAY['TITLE'] = 'CRNRSTN :: INTERACT UI Tablet Device Stylesheet';
                $tmp_output_ARRAY['TITLE_DISPLAY'] = 'C<span class="the_R_in_crnrstn">R</span>NRSTN :: INTERACT UI Tablet Device Stylesheet';
                $tmp_output_ARRAY['VERSION'] = '1.00.0000 PRE-ALPHA-DEV (Lightsaber)';
                $tmp_output_ARRAY['BROWSER_COMPATIBILITY'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = 'The tablet device stylesheet for C<span class="the_R_in_crnrstn">R</span>NRSTN :: INTERACT UI.
                                                    <br><br>
                                                    ' . $this->oCRNRSTN->return_system_image('FIVE', 35, 35, NULL, NULL, NULL, NULL, CRNRSTN_UI_IMG_HTML_WRAPPED);
                $tmp_output_ARRAY['URL'][] = '';

            break;
            case 'CRNRSTN_UI_CSS_MAIN_MOBILE':
            case CRNRSTN_UI_CSS_MAIN_MOBILE:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_UI_CSS_MAIN_MOBILE;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_UI_CSS_MAIN_MOBILE';
                $tmp_output_ARRAY['TITLE'] = 'C<span class="the_R_in_crnrstn">R</span>NRSTN :: INTERACT UI Mobile 
                            Device Stylesheet';
                $tmp_output_ARRAY['TITLE_DISPLAY'] = 'C<span class="the_R_in_crnrstn">R</span>NRSTN :: INTERACT UI Mobile 
                            Device Stylesheet';
                $tmp_output_ARRAY['VERSION'] = '1.00.0000 PRE-ALPHA-DEV (Lightsaber)';
                $tmp_output_ARRAY['BROWSER_COMPATIBILITY'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = 'The mobile device stylesheet for C<span class="the_R_in_crnrstn">R</span>NRSTN :: INTERACT UI.
                                                    <br><br>
                                                    ' . $this->oCRNRSTN->return_system_image('FIVE', 35, 35, NULL, NULL, NULL, NULL, CRNRSTN_UI_IMG_HTML_WRAPPED);
                $tmp_output_ARRAY['URL'][] = '';

            break;
            case 'CRNRSTN_DEBUG_OFF':
            case CRNRSTN_DEBUG_OFF:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_DEBUG_OFF;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_DEBUG_OFF';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_DEBUG_NATIVE_ERR_LOG':
            case CRNRSTN_DEBUG_NATIVE_ERR_LOG:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_DEBUG_NATIVE_ERR_LOG;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_DEBUG_NATIVE_ERR_LOG';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_DEBUG_AGGREGATION_ON':
            case CRNRSTN_DEBUG_AGGREGATION_ON:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_DEBUG_AGGREGATION_ON;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_DEBUG_AGGREGATION_ON';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_LOG_NONE':
            case CRNRSTN_LOG_NONE:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_LOG_NONE;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_LOG_NONE';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_LOG_ALL':
            case CRNRSTN_LOG_ALL:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_LOG_ALL;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_LOG_ALL';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_AUTHORIZED_ACCOUNT':
            case CRNRSTN_AUTHORIZED_ACCOUNT:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_AUTHORIZED_ACCOUNT;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_AUTHORIZED_ACCOUNT';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_INTEGER_LENGTH':
            case CRNRSTN_INTEGER_LENGTH:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_INTEGER_LENGTH;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_INTEGER_LENGTH';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_SETTINGS_APACHE':
            case CRNRSTN_SETTINGS_APACHE:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_SETTINGS_APACHE;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_SETTINGS_APACHE';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_SETTINGS_MYSQLI':
            case CRNRSTN_SETTINGS_MYSQLI:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_SETTINGS_MYSQLI;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_SETTINGS_MYSQLI';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_SETTINGS_PHP':
            case CRNRSTN_SETTINGS_PHP:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_SETTINGS_PHP;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_SETTINGS_PHP';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_SETTINGS_CRNRSTN':
            case CRNRSTN_SETTINGS_CRNRSTN:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_SETTINGS_CRNRSTN;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_SETTINGS_CRNRSTN';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_SETTINGS_WORDPRESS':
            case CRNRSTN_SETTINGS_WORDPRESS:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_SETTINGS_WORDPRESS;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_SETTINGS_WORDPRESS';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_SETTINGS_CLIENT':
            case CRNRSTN_SETTINGS_CLIENT:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_SETTINGS_CLIENT;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_SETTINGS_CLIENT';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_INPUT_OPTIONAL':
            case CRNRSTN_INPUT_OPTIONAL:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_INPUT_OPTIONAL;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_INPUT_OPTIONAL';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_INPUT_REQUIRED':
            case CRNRSTN_INPUT_REQUIRED:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_INPUT_REQUIRED;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_INPUT_REQUIRED';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_INPUT_PASSWORD':
            case CRNRSTN_INPUT_PASSWORD:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_INPUT_PASSWORD;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_INPUT_PASSWORD';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_INPUT_IS_EMAIL':
            case CRNRSTN_INPUT_IS_EMAIL:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_INPUT_IS_EMAIL;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_INPUT_IS_EMAIL';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_INPUT_CHAR_RESTRICTIONS':
            case CRNRSTN_INPUT_CHAR_RESTRICTIONS:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_INPUT_CHAR_RESTRICTIONS;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_INPUT_CHAR_RESTRICTIONS';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_INPUT_CHAR_LIMITS':
            case CRNRSTN_INPUT_CHAR_LIMITS:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_INPUT_CHAR_LIMITS;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_INPUT_CHAR_LIMITS';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_INPUT_IS_FILE_IMAGE':
            case CRNRSTN_INPUT_IS_FILE_IMAGE:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_INPUT_IS_FILE_IMAGE;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_INPUT_IS_FILE_IMAGE';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_INPUT_IS_FILE_IMAGE_PNG':
            case CRNRSTN_INPUT_IS_FILE_IMAGE_PNG:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_INPUT_IS_FILE_IMAGE_PNG;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_INPUT_IS_FILE_IMAGE_PNG';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_INPUT_IS_FILE_IMAGE_JPEG':
            case CRNRSTN_INPUT_IS_FILE_IMAGE_JPEG:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_INPUT_IS_FILE_IMAGE_JPEG;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_INPUT_IS_FILE_IMAGE_JPEG';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_INPUT_IS_FILE_IMAGE_GIF':
            case CRNRSTN_INPUT_IS_FILE_IMAGE_GIF:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_INPUT_IS_FILE_IMAGE_GIF;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_INPUT_IS_FILE_IMAGE_GIF';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_INPUT_IS_FILE_DOCUMENT':
            case CRNRSTN_INPUT_IS_FILE_DOCUMENT:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_INPUT_IS_FILE_DOCUMENT;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_INPUT_IS_FILE_DOCUMENT';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_INPUT_IS_FILE_ZIP':
            case CRNRSTN_INPUT_IS_FILE_ZIP:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_INPUT_IS_FILE_ZIP;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_INPUT_IS_FILE_ZIP';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_DATABASE':
            case CRNRSTN_DATABASE:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_DATABASE;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_DATABASE';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_DATABASE_CONNECTION':
            case CRNRSTN_DATABASE_CONNECTION:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_DATABASE_CONNECTION;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_DATABASE_CONNECTION';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_DATABASE_QUERY':
            case CRNRSTN_DATABASE_QUERY:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_DATABASE_QUERY;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_DATABASE_QUERY';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_DATABASE_QUERY_SILO':
            case CRNRSTN_DATABASE_QUERY_SILO:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_DATABASE_QUERY_SILO;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_DATABASE_QUERY_SILO';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_DATABASE_QUERY_DYNAMIC':
            case CRNRSTN_DATABASE_QUERY_DYNAMIC:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_DATABASE_QUERY_DYNAMIC;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_DATABASE_QUERY_DYNAMIC';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_DATABASE_RESULT':
            case CRNRSTN_DATABASE_RESULT:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_DATABASE_RESULT;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_DATABASE_RESULT';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_GABRIEL':
            case CRNRSTN_GABRIEL:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_GABRIEL;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_GABRIEL';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_SMTP_AUTHENTICATION':
            case CRNRSTN_SMTP_AUTHENTICATION:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_SMTP_AUTHENTICATION;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_SMTP_AUTHENTICATION';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_EMAIL_CRNRSTN_SOURCE':
            case CRNRSTN_EMAIL_CRNRSTN_SOURCE:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_EMAIL_CRNRSTN_SOURCE;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_EMAIL_CRNRSTN_SOURCE';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_EMAIL_USER_SOURCE':
            case CRNRSTN_EMAIL_USER_SOURCE:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_EMAIL_USER_SOURCE;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_EMAIL_USER_SOURCE';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_ELECTRUM':
            case CRNRSTN_ELECTRUM:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_ELECTRUM;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_ELECTRUM';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_ELECTRUM_THREAD':
            case CRNRSTN_ELECTRUM_THREAD:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_ELECTRUM_THREAD;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_ELECTRUM_THREAD';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_ELECTRUM_COMM':
            case CRNRSTN_ELECTRUM_COMM:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_ELECTRUM_COMM;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_ELECTRUM_COMM';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_ELECTRUM_FTP':
            case CRNRSTN_ELECTRUM_FTP:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_ELECTRUM_FTP;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_ELECTRUM_FTP';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_ELECTRUM_LOCALDIR':
            case CRNRSTN_ELECTRUM_LOCALDIR:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_ELECTRUM_LOCALDIR;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_ELECTRUM_LOCALDIR';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_FILE_MANAGEMENT':
            case CRNRSTN_FILE_MANAGEMENT:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_FILE_MANAGEMENT;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_FILE_MANAGEMENT';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_SOAP':
            case CRNRSTN_SOAP:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_SOAP;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_SOAP';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_SOAP_SERVER':
            case CRNRSTN_SOAP_SERVER:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_SOAP_SERVER;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_SOAP_SERVER';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_SOAP_CLIENT':
            case CRNRSTN_SOAP_CLIENT:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_SOAP_CLIENT;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_SOAP_CLIENT';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_PROXY_KINGS_HIGHWAY':
            case CRNRSTN_PROXY_KINGS_HIGHWAY:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_PROXY_KINGS_HIGHWAY;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_PROXY_KINGS_HIGHWAY';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_PROXY_EMAIL':
            case CRNRSTN_PROXY_EMAIL:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_PROXY_EMAIL;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_PROXY_EMAIL';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_PROXY_ELECTRUM':
            case CRNRSTN_PROXY_ELECTRUM:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_PROXY_ELECTRUM;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_PROXY_ELECTRUM';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_PROXY_AUTHENTICATE':
            case CRNRSTN_PROXY_AUTHENTICATE:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_PROXY_AUTHENTICATE;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_PROXY_AUTHENTICATE';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_UI_PHPNIGHT':
            case CRNRSTN_UI_PHPNIGHT:

                /*
                // CRNRSTN_UI_PHPNIGHT              //
                // CRNRSTN_UI_DARKNIGHT             //
                // CRNRSTN_UI_PHP                   //
                // CRNRSTN_UI_GREYSKYS              //
                // CRNRSTN_UI_HTML                  //
                // CRNRSTN_UI_DAYLIGHT              //
                // CRNRSTN_UI_FEATHER               //
                // CRNRSTN_UI_GLASS_LIGHT_COPY      //
                // CRNRSTN_UI_GLASS_DARK_COPY       // UI EXPERIMENTAL
                // CRNRSTN_UI_WOOD                  // UI EXPERIMENTAL
                // CRNRSTN_UI_TERMINAL              //

                */

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_UI_PHPNIGHT;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_UI_PHPNIGHT';
                $tmp_output_ARRAY['TITLE'] = 'PHP Night';
                $tmp_output_ARRAY['DESCRIPTION'] = 'REPLICATION OF LEAD DEVELOPER IDE THEME. HOW CRNRSTN :: LIGHTSABER LOOKS TO ME.';

            break;
            case 'CRNRSTN_UI_DARKNIGHT':
            case CRNRSTN_UI_DARKNIGHT:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_UI_DARKNIGHT;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_UI_DARKNIGHT';
                $tmp_output_ARRAY['TITLE'] = 'Dark Night';
                $tmp_output_ARRAY['DESCRIPTION'] = 'SIMILAR TO CRNRSTN_UI_PHPNIGHT, BUT DARKER. NOTHING COULD BE DARKER. NOTHING.';

            break;
            case 'CRNRSTN_UI_PHP':
            case CRNRSTN_UI_PHP:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_UI_PHP;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_UI_PHP';
                $tmp_output_ARRAY['TITLE'] = 'PHP';
                $tmp_output_ARRAY['DESCRIPTION'] = 'ALL ABOUT THE BUSINESS.';

            break;
            case 'CRNRSTN_UI_GREYSKYS':
            case CRNRSTN_UI_GREYSKYS:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_UI_GREYSKYS;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_UI_GREYSKYS';
                $tmp_output_ARRAY['TITLE'] = 'Grey Skys';
                $tmp_output_ARRAY['DESCRIPTION'] = 'ALONE AND SAD WITH A NICE CUP OF COFFEE, A RACK MOUNTED DUAL-VIDEO CARD MAC PRO, AND FOUR (4) APPLE PRO DISPLAYS.';

            break;
            case 'CRNRSTN_UI_HTML':
            case CRNRSTN_UI_HTML:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_UI_HTML;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_UI_HTML';
                $tmp_output_ARRAY['TITLE'] = 'HTML';
                $tmp_output_ARRAY['DESCRIPTION'] = 'BE LIGHT AND HAPPY.';

            break;
            case 'CRNRSTN_UI_DAYLIGHT':
            case CRNRSTN_UI_DAYLIGHT:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_UI_DAYLIGHT;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_UI_DAYLIGHT';
                $tmp_output_ARRAY['TITLE'] = 'Daylight';
                $tmp_output_ARRAY['DESCRIPTION'] = 'SIMILAR TO CRNRSTN_UI_HTML BUT...LIGHTER. NOTHING COULD BE LIGHTER.';

            break;
            case 'CRNRSTN_UI_FEATHER':
            case CRNRSTN_UI_FEATHER:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_UI_FEATHER;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_UI_FEATHER';
                $tmp_output_ARRAY['TITLE'] = 'Feather';
                $tmp_output_ARRAY['DESCRIPTION'] = 'LIGHTER THAN DAYLIGHT.';

            break;
            case 'CRNRSTN_UI_GLASS_LIGHT_COPY':
            case CRNRSTN_UI_GLASS_LIGHT_COPY:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_UI_GLASS_LIGHT_COPY;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_UI_GLASS_LIGHT_COPY';
                $tmp_output_ARRAY['TITLE'] = 'Glass (light text)';
                $tmp_output_ARRAY['DESCRIPTION'] = 'UI EXPERIMENTAL';

            break;
            case 'CRNRSTN_UI_GLASS_DARK_COPY':
            case CRNRSTN_UI_GLASS_DARK_COPY:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_UI_GLASS_DARK_COPY;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_UI_GLASS_DARK_COPY';
                $tmp_output_ARRAY['TITLE'] = 'Glass (dark text)';
                $tmp_output_ARRAY['DESCRIPTION'] = 'UI EXPERIMENTAL';

            break;
            case 'CRNRSTN_UI_WOOD':
            case CRNRSTN_UI_WOOD:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_UI_WOOD;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_UI_WOOD';
                $tmp_output_ARRAY['TITLE'] = 'Wood';
                $tmp_output_ARRAY['DESCRIPTION'] = 'GOT WOOD?';

            break;
            case 'CRNRSTN_UI_TERMINAL':
            case CRNRSTN_UI_TERMINAL:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_UI_TERMINAL;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_UI_TERMINAL';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = 'GREEN TEXT. BLACK BACKGROUND. HARDCORE.';

            break;
            case 'CRNRSTN_UI_RANDOM':
            case CRNRSTN_UI_RANDOM:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_UI_RANDOM;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_UI_RANDOM';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = 'GREEN TEXT. BLACK BACKGROUND. HARDCORE.';

            break;
            case 'CRNRSTN_CHANNEL_DESKTOP':
            case CRNRSTN_CHANNEL_DESKTOP:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_CHANNEL_DESKTOP;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_CHANNEL_DESKTOP';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_CHANNEL_TABLET':
            case CRNRSTN_CHANNEL_TABLET:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_CHANNEL_TABLET;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_CHANNEL_TABLET';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_CHANNEL_MOBILE':
            case CRNRSTN_CHANNEL_MOBILE:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_CHANNEL_MOBILE;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_CHANNEL_MOBILE';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_UI_SOAP_DATA_TUNNEL':
            case CRNRSTN_UI_SOAP_DATA_TUNNEL:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_UI_SOAP_DATA_TUNNEL;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_UI_SOAP_DATA_TUNNEL';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_REPORT_RESPONSE_RETURN':
            case CRNRSTN_REPORT_RESPONSE_RETURN:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_REPORT_RESPONSE_RETURN;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_REPORT_RESPONSE_RETURN';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_UI_IMG_SOAP_DATA_TUNNEL':
            case CRNRSTN_UI_IMG_SOAP_DATA_TUNNEL:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_UI_IMG_SOAP_DATA_TUNNEL;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_UI_IMG_SOAP_DATA_TUNNEL';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_UI_IMG_BASE64':
            case CRNRSTN_UI_IMG_BASE64:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_UI_IMG_BASE64;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_UI_IMG_BASE64';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_UI_IMG_BASE64_PNG':
            case CRNRSTN_UI_IMG_BASE64_PNG:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_UI_IMG_BASE64_PNG;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_UI_IMG_BASE64_PNG';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_UI_IMG_HTML_WRAPPED':
            case CRNRSTN_UI_IMG_HTML_WRAPPED:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_UI_IMG_HTML_WRAPPED;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_UI_IMG_HTML_WRAPPED';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_UI_IMG_BASE64_JPEG':
            case CRNRSTN_UI_IMG_BASE64_JPEG:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_UI_IMG_BASE64_JPEG;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_UI_IMG_BASE64_JPEG';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_UI_IMG_JPEG':
            case CRNRSTN_UI_IMG_JPEG:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_UI_IMG_JPEG;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_UI_IMG_JPEG';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_UI_IMG_PNG':
            case CRNRSTN_UI_IMG_PNG:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_UI_IMG_PNG;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_UI_IMG_PNG';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_UI_IMG':
            case CRNRSTN_UI_IMG:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_UI_IMG;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_UI_IMG';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_UI_CSS':
            case CRNRSTN_UI_CSS:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_UI_CSS;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_UI_CSS';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_UI_JS':
            case CRNRSTN_UI_JS:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_UI_JS;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_UI_JS';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_RESOURCE_PRODUCTION_MIN_JS_CSS':
            case CRNRSTN_RESOURCE_PRODUCTION_MIN_JS_CSS:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_RESOURCE_PRODUCTION_MIN_JS_CSS;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_RESOURCE_PRODUCTION_MIN_JS_CSS';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_UI_TAG_ANALYTICS':
            case CRNRSTN_UI_TAG_ANALYTICS:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_UI_TAG_ANALYTICS;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_UI_TAG_ANALYTICS';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_UI_TAG_ENGAGEMENT':
            case CRNRSTN_UI_TAG_ENGAGEMENT:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_UI_TAG_ENGAGEMENT;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_UI_TAG_ENGAGEMENT';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_UI_FORM_INTEGRATION_PACKET':
            case CRNRSTN_UI_FORM_INTEGRATION_PACKET:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_UI_FORM_INTEGRATION_PACKET;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_UI_FORM_INTEGRATION_PACKET';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_UI_COOKIE_PREFERENCE':
            case CRNRSTN_UI_COOKIE_PREFERENCE:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_UI_COOKIE_PREFERENCE;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_UI_COOKIE_PREFERENCE';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_UI_COOKIE_YESNO':
            case CRNRSTN_UI_COOKIE_YESNO:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_UI_COOKIE_YESNO;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_UI_COOKIE_YESNO';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_UI_COOKIE_NOTICE':
            case CRNRSTN_UI_COOKIE_NOTICE:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_UI_COOKIE_NOTICE;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_UI_COOKIE_NOTICE';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_UI_INTERACT':
            case CRNRSTN_UI_INTERACT:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_UI_INTERACT;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_UI_INTERACT';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_ASSET_MODE_BASE64':
            case CRNRSTN_ASSET_MODE_BASE64:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_ASSET_MODE_BASE64;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_ASSET_MODE_BASE64';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_ASSET_MODE_PNG':
            case CRNRSTN_ASSET_MODE_PNG:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_ASSET_MODE_PNG;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_ASSET_MODE_PNG';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_ASSET_MODE_JPEG':
            case CRNRSTN_ASSET_MODE_JPEG:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_ASSET_MODE_JPEG;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_ASSET_MODE_JPEG';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_ASSET_MODE_ICO':
            case CRNRSTN_ASSET_MODE_ICO:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_ASSET_MODE_ICO;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_ASSET_MODE_ICO';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_LOG_EMAIL':
            case CRNRSTN_LOG_EMAIL:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_LOG_EMAIL;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_LOG_EMAIL';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_LOG_EMAIL_PROXY':
            case CRNRSTN_LOG_EMAIL_PROXY:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_LOG_EMAIL_PROXY;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_LOG_EMAIL_PROXY';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_LOG_FILE':
            case CRNRSTN_LOG_FILE:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_LOG_FILE;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_LOG_FILE';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_LOG_FILE_PROXY':
            case CRNRSTN_LOG_FILE_PROXY:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_LOG_FILE_PROXY;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_LOG_FILE_PROXY';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_LOG_FILE_FTP':
            case CRNRSTN_LOG_FILE_FTP:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_LOG_FILE_FTP;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_LOG_FILE_FTP';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_LOG_SCREEN_TEXT':
            case CRNRSTN_LOG_SCREEN_TEXT:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_LOG_SCREEN_TEXT;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_LOG_SCREEN_TEXT';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_LOG_SCREEN':
            case CRNRSTN_LOG_SCREEN:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_LOG_SCREEN;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_LOG_SCREEN';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_LOG_SCREEN_HTML':
            case CRNRSTN_LOG_SCREEN_HTML:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_LOG_SCREEN_HTML;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_LOG_SCREEN_HTML';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_LOG_SCREEN_HTML_HIDDEN':
            case CRNRSTN_LOG_SCREEN_HTML_HIDDEN:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_LOG_SCREEN_HTML_HIDDEN;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_LOG_SCREEN_HTML_HIDDEN';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_LOG_DEFAULT':
            case CRNRSTN_LOG_DEFAULT:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_LOG_DEFAULT;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_LOG_DEFAULT';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_LOG_DEFAULT_PROXY':
            case CRNRSTN_LOG_DEFAULT_PROXY:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_LOG_DEFAULT_PROXY;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_LOG_DEFAULT_PROXY';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_LOG_ELECTRUM':
            case CRNRSTN_LOG_ELECTRUM:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_LOG_ELECTRUM;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_LOG_ELECTRUM';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_AUTHORIZE_RUNTIME_ONLY':
            case CRNRSTN_AUTHORIZE_RUNTIME_ONLY:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_AUTHORIZE_RUNTIME_ONLY;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_AUTHORIZE_RUNTIME_ONLY';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_AUTHORIZE_ALL':
            case CRNRSTN_AUTHORIZE_ALL:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_AUTHORIZE_ALL;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_AUTHORIZE_ALL';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_AUTHORIZE_DATABASE':
            case CRNRSTN_AUTHORIZE_DATABASE:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_AUTHORIZE_DATABASE;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_AUTHORIZE_DATABASE';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_AUTHORIZE_SSDTLA':
            case CRNRSTN_AUTHORIZE_SSDTLA:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_AUTHORIZE_SSDTLA;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_AUTHORIZE_SSDTLA';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_AUTHORIZE_PSSDTLA':
            case CRNRSTN_AUTHORIZE_PSSDTLA:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_AUTHORIZE_PSSDTLA;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_AUTHORIZE_PSSDTLA';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_AUTHORIZE_SESSION':
            case CRNRSTN_AUTHORIZE_SESSION:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_AUTHORIZE_SESSION;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_AUTHORIZE_SESSION';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_AUTHORIZE_COOKIE':
            case CRNRSTN_AUTHORIZE_COOKIE:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_AUTHORIZE_COOKIE;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_AUTHORIZE_COOKIE';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_AUTHORIZE_SOAP':
            case CRNRSTN_AUTHORIZE_SOAP:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_AUTHORIZE_SOAP;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_AUTHORIZE_SOAP';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_AUTHORIZE_GET':
            case CRNRSTN_AUTHORIZE_GET:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_AUTHORIZE_GET;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_AUTHORIZE_GET';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_AUTHORIZE_ISEMAIL':
            case CRNRSTN_AUTHORIZE_ISEMAIL:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_AUTHORIZE_ISEMAIL;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_AUTHORIZE_ISEMAIL';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_AUTHORIZE_ISPASSWORD':
            case CRNRSTN_AUTHORIZE_ISPASSWORD:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_AUTHORIZE_ISPASSWORD;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_AUTHORIZE_ISPASSWORD';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_ENCRYPT_TUNNEL':
            case CRNRSTN_ENCRYPT_TUNNEL:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_ENCRYPT_TUNNEL;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_ENCRYPT_TUNNEL';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_ENCRYPT_DATABASE':
            case CRNRSTN_ENCRYPT_DATABASE:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_ENCRYPT_DATABASE;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_ENCRYPT_DATABASE';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_ENCRYPT_SESSION':
            case CRNRSTN_ENCRYPT_SESSION:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_ENCRYPT_SESSION;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_ENCRYPT_SESSION';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_ENCRYPT_COOKIE':
            case CRNRSTN_ENCRYPT_COOKIE:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_ENCRYPT_COOKIE;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_ENCRYPT_COOKIE';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_ENCRYPT_SOAP':
            case CRNRSTN_ENCRYPT_SOAP:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_ENCRYPT_SOAP;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_ENCRYPT_SOAP';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_ENCRYPT_OERSL':
            case CRNRSTN_ENCRYPT_OERSL:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_ENCRYPT_OERSL;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_ENCRYPT_OERSL';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_FAVICON_ASSET_MAPPING':
            case CRNRSTN_FAVICON_ASSET_MAPPING:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_FAVICON_ASSET_MAPPING;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_FAVICON_ASSET_MAPPING';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_SYSTEM_IMG_ASSET_MAPPING':
            case CRNRSTN_SYSTEM_IMG_ASSET_MAPPING:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_SYSTEM_IMG_ASSET_MAPPING;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_SYSTEM_IMG_ASSET_MAPPING';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_SOCIAL_IMG_ASSET_MAPPING':
            case CRNRSTN_SOCIAL_IMG_ASSET_MAPPING:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_SOCIAL_IMG_ASSET_MAPPING;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_SOCIAL_IMG_ASSET_MAPPING';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_JS_ASSET_MAPPING':
            case CRNRSTN_JS_ASSET_MAPPING:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_JS_ASSET_MAPPING;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_JS_ASSET_MAPPING';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_CSS_ASSET_MAPPING':
            case CRNRSTN_CSS_ASSET_MAPPING:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_CSS_ASSET_MAPPING;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_CSS_ASSET_MAPPING';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_SYSTEM_EMAIL_IS_HTML':
            case CRNRSTN_SYSTEM_EMAIL_IS_HTML:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_SYSTEM_EMAIL_IS_HTML;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_SYSTEM_EMAIL_IS_HTML';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_ASSET_MAPPING':
            case CRNRSTN_ASSET_MAPPING:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_ASSET_MAPPING;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_ASSET_MAPPING';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_ASSET_MAPPING_PROXY':
            case CRNRSTN_ASSET_MAPPING_PROXY:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_ASSET_MAPPING_PROXY;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_ASSET_MAPPING_PROXY';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_RESOURCE_ALL':
            case CRNRSTN_RESOURCE_ALL:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_RESOURCE_ALL;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_RESOURCE_ALL';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_RESOURCE_BASSDRIVE':
            case CRNRSTN_RESOURCE_BASSDRIVE:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_RESOURCE_BASSDRIVE;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_RESOURCE_BASSDRIVE';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_RESOURCE_NATIONAL_WEATHER_SERVICE':
            case CRNRSTN_RESOURCE_NATIONAL_WEATHER_SERVICE:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_RESOURCE_NATIONAL_WEATHER_SERVICE;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_RESOURCE_NATIONAL_WEATHER_SERVICE';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_RESOURCE_CSS_VALIDATOR':
            case CRNRSTN_RESOURCE_CSS_VALIDATOR:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_RESOURCE_CSS_VALIDATOR;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_RESOURCE_CSS_VALIDATOR';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_RESOURCE_DOCUMENTATION':
            case CRNRSTN_RESOURCE_DOCUMENTATION:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_RESOURCE_DOCUMENTATION;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_RESOURCE_DOCUMENTATION';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_RESOURCE_IMAGE':
            case CRNRSTN_RESOURCE_IMAGE:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_RESOURCE_IMAGE;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_RESOURCE_IMAGE';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_RESOURCE_DOCUMENT':
            case CRNRSTN_RESOURCE_DOCUMENT:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_RESOURCE_DOCUMENT;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_RESOURCE_DOCUMENT';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_RESOURCE_OPENSOURCE':
            case CRNRSTN_RESOURCE_OPENSOURCE:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_RESOURCE_OPENSOURCE;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_RESOURCE_OPENSOURCE';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_RESOURCE_NEWS_SYNDICATION':
            case CRNRSTN_RESOURCE_NEWS_SYNDICATION:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_RESOURCE_NEWS_SYNDICATION;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_RESOURCE_NEWS_SYNDICATION';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_RESOURCE_ELECTRUM':
            case CRNRSTN_RESOURCE_ELECTRUM:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_RESOURCE_ELECTRUM;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_RESOURCE_ELECTRUM';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_BARNEY':
            case CRNRSTN_BARNEY:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_BARNEY;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_BARNEY';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_BARNEY_DATABASE':
            case CRNRSTN_BARNEY_DATABASE:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_BARNEY_DATABASE;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_BARNEY_DATABASE';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_BARNEY_FILE':
            case CRNRSTN_BARNEY_FILE:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_BARNEY_FILE;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_BARNEY_FILE';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_BARNEY_FTP':
            case CRNRSTN_BARNEY_FTP:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_BARNEY_FTP;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_BARNEY_FTP';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_BARNEY_ELECTRUM':
            case CRNRSTN_BARNEY_ELECTRUM:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_BARNEY_ELECTRUM;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_BARNEY_ELECTRUM';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_BARNEY_GABRIEL':
            case CRNRSTN_BARNEY_GABRIEL:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_BARNEY_GABRIEL;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_BARNEY_GABRIEL';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_BARNEY_DISK':
            case CRNRSTN_BARNEY_DISK:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_BARNEY_DISK;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_BARNEY_DISK';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_PERFORMANCE_MONITOR':
            case CRNRSTN_PERFORMANCE_MONITOR:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_PERFORMANCE_MONITOR;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_PERFORMANCE_MONITOR';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_WORDPRESS_DEBUG':
            case CRNRSTN_WORDPRESS_DEBUG:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_WORDPRESS_DEBUG;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_WORDPRESS_DEBUG';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_IP_SECURITY':
            case CRNRSTN_IP_SECURITY:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_IP_SECURITY;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_IP_SECURITY';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_CSS_EMAIL_CLIENT_VALIDATE':
            case CRNRSTN_CSS_EMAIL_CLIENT_VALIDATE:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_CSS_EMAIL_CLIENT_VALIDATE;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_CSS_EMAIL_CLIENT_VALIDATE';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';
                
            break;
            case 'CRNRSTN_OUTPUT_RUNTIME':
            case CRNRSTN_OUTPUT_RUNTIME:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_OUTPUT_RUNTIME;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_OUTPUT_RUNTIME';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_OUTPUT_ALL':
            case CRNRSTN_OUTPUT_ALL:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_OUTPUT_ALL;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_OUTPUT_ALL';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_OUTPUT_DATABASE':
            case CRNRSTN_OUTPUT_DATABASE:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_OUTPUT_DATABASE;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_OUTPUT_DATABASE';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_OUTPUT_SSDTLA':
            case CRNRSTN_OUTPUT_SSDTLA:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_OUTPUT_SSDTLA;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_OUTPUT_SSDTLA';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_OUTPUT_PSSDTLA':
            case CRNRSTN_OUTPUT_PSSDTLA:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_OUTPUT_PSSDTLA;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_OUTPUT_PSSDTLA';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_OUTPUT_SESSION':
            case CRNRSTN_OUTPUT_SESSION:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_OUTPUT_SESSION;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_OUTPUT_SESSION';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_OUTPUT_COOKIE':
            case CRNRSTN_OUTPUT_COOKIE:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_OUTPUT_COOKIE;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_OUTPUT_COOKIE';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_OUTPUT_SOAP':
            case CRNRSTN_OUTPUT_SOAP:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_OUTPUT_SOAP;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_OUTPUT_SOAP';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_OUTPUT_GET':
            case CRNRSTN_OUTPUT_GET:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_OUTPUT_GET;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_OUTPUT_GET';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_OUTPUT_ISEMAIL':
            case CRNRSTN_OUTPUT_ISEMAIL:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_OUTPUT_ISEMAIL;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_OUTPUT_ISEMAIL';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_OUTPUT_ISPASSWORD':
            case CRNRSTN_OUTPUT_ISPASSWORD:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_OUTPUT_ISPASSWORD;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_OUTPUT_ISPASSWORD';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_OUTPUT_FORM_INTEGRATIONS':
            case CRNRSTN_OUTPUT_FORM_INTEGRATIONS:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_OUTPUT_FORM_INTEGRATIONS;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_OUTPUT_FORM_INTEGRATIONS';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_HTTP_REDIRECT':
            case CRNRSTN_HTTP_REDIRECT:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_HTTP_REDIRECT;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_HTTP_REDIRECT';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_HTTPS_REDIRECT':
            case CRNRSTN_HTTPS_REDIRECT:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_HTTPS_REDIRECT;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_HTTPS_REDIRECT';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_HTTP_DATA_RETURN':
            case CRNRSTN_HTTP_DATA_RETURN:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_HTTP_DATA_RETURN;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_HTTP_DATA_RETURN';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_HTTPS_DATA_RETURN':
            case CRNRSTN_HTTPS_DATA_RETURN:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_HTTPS_DATA_RETURN;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_HTTPS_DATA_RETURN';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_JSON_RETURN':
            case CRNRSTN_JSON_RETURN:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_JSON_RETURN;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_JSON_RETURN';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_XML_RETURN':
            case CRNRSTN_XML_RETURN:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_XML_RETURN;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_XML_RETURN';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_SOAP_RETURN':
            case CRNRSTN_SOAP_RETURN:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_SOAP_RETURN;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_SOAP_RETURN';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_HTML_TEXT_RETURN':
            case CRNRSTN_HTML_TEXT_RETURN:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_HTML_TEXT_RETURN;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_HTML_TEXT_RETURN';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_DOCUMENT_FILE_RETURN':
            case CRNRSTN_DOCUMENT_FILE_RETURN:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_DOCUMENT_FILE_RETURN;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_DOCUMENT_FILE_RETURN';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            case 'CRNRSTN_SERVER_RESPONSE_CODE':
            case CRNRSTN_SERVER_RESPONSE_CODE:

                $tmp_output_ARRAY['INTEGER'] = CRNRSTN_SERVER_RESPONSE_CODE;
                $tmp_output_ARRAY['STRING'] = 'CRNRSTN_SERVER_RESPONSE_CODE';
                $tmp_output_ARRAY['TITLE'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = '';

            break;
            default:

                $tmp_output_ARRAY['INTEGER'] = $resource_constant;
                $tmp_output_ARRAY['STRING'] = 'UNKNOWN RESOURCE';
                $tmp_output_ARRAY['TITLE'] = 'UNKNOWN RESOURCE';
                $tmp_output_ARRAY['VERSION'] = '';
                $tmp_output_ARRAY['BROWSER_COMPATIBILITY'] = '';
                $tmp_output_ARRAY['DESCRIPTION'] = 'UNKNOWN RESOURCE';
                $tmp_output_ARRAY['URL'][] = '';

            break;

        }

        if(isset($attribute)){

            //
            // $attribute DEFAULT VALUE OF 'ARRAY' WILL NEVER BE SET WITHIN $tmp_output_ARRAY, WHICH
            // WILL RESULT IN THE ENTIRE ARRAY BEING RETURNED.
            if(isset($tmp_output_ARRAY[$attribute])){

                return $tmp_output_ARRAY[$attribute];

            }

        }

        return $tmp_output_ARRAY;

    }

    public function return_integer_constant_profiles($module_key = NULL){

        /*
        $this->system_theme_style_constants_ARRAY = array(
        CRNRSTN_UI_PHPNIGHT,
        CRNRSTN_UI_DARKNIGHT,
        CRNRSTN_UI_PHP,
        CRNRSTN_UI_GREYSKYS,
        CRNRSTN_UI_HTML,
        CRNRSTN_UI_DAYLIGHT,
        CRNRSTN_UI_FEATHER,
        CRNRSTN_UI_GLASS_LIGHT_COPY,
        CRNRSTN_UI_GLASS_DARK_COPY,
        CRNRSTN_UI_WOOD,
        CRNRSTN_UI_TERMINAL,
        CRNRSTN_UI_RANDOM);

        CRNRSTN_CSS_FRAMEWORK_SIMPLE_GRID
        CRNRSTN_CSS_FRAMEWORK_960_GRID_SYSTEM
        CRNRSTN_CSS_FRAMEWORK_FOUNDATION
        CRNRSTN_CSS_FRAMEWORK_HTML5_BOILERPLATE
        CRNRSTN_CSS_FRAMEWORK_RESPONSIVE_GRID_SYSTEM
        CRNRSTN_CSS_FRAMEWORK_UNSEMANTIC
        CRNRSTN_CSS_FRAMEWORK_DEAD_SIMPLE_GRID
        CRNRSTN_CSS_FRAMEWORK_SKELETON
        CRNRSTN_CSS_FRAMEWORK_RWDGRID

        Simple Grid
        https://simplegrid.io/
        Simple Grid
        http://thisisdallas.github.io/Simple-Grid/

        960 Grid System
        https://960.gs/

        Foundation
        https://get.foundation/

        HTML5 Boilerplate
        https://html5boilerplate.com/

        Responsive Grid System
        http://www.responsivegridsystem.com/

        Unsemantic
        https://unsemantic.com/

        Dead Simple Grid
        https://mourner.github.io/dead-simple-grid/

        Skeleton
        http://getskeleton.com/

        rwdgrid
        http://rwdgrid.com/

       */

        switch($module_key){
            case 'system_output_head_html':

                $tmp_output_ARRAY = array();

                // 25
                // MASTER CLIENT META ASSET ARRAY (CSS, JS)
                $tmp_resource_ctrl_ARRAY = array(CRNRSTN_JS_FRAMEWORK_JQUERY,
                    CRNRSTN_JS_FRAMEWORK_JQUERY_2_2_4, CRNRSTN_JS_FRAMEWORK_JQUERY_1_12_4,
                    CRNRSTN_JS_FRAMEWORK_JQUERY_1_11_1, CRNRSTN_JS_FRAMEWORK_JQUERY_UI,
                    CRNRSTN_JS_FRAMEWORK_JQUERY_UI_1_12_1, CRNRSTN_JS_FRAMEWORK_JQUERY_MOBILE,
                    CRNRSTN_JS_FRAMEWORK_LIGHTBOX_DOT_JS, CRNRSTN_JS_FRAMEWORK_LIGHTBOX_DOT_JS_PLUS_JQUERY,
                    CRNRSTN_JS_FRAMEWORK_REACT, CRNRSTN_JS_FRAMEWORK_REACT_DOM,
                    CRNRSTN_JS_FRAMEWORK_MITHRIL, CRNRSTN_JS_FRAMEWORK_BACKBONE, CRNRSTN_JS_FRAMEWORK_PROTOTYPE,
                    CRNRSTN_JS_FRAMEWORK_SCRIPTACULOUS, CRNRSTN_JS_FRAMEWORK_PROTOTYPE_MOOFX,
                    CRNRSTN_JS_FRAMEWORK_LIGHTBOX_DOT_JS_2_03_3, CRNRSTN_JS_FRAMEWORK_MOOTOOLS_MORE,
                    CRNRSTN_JS_FRAMEWORK_MOOTOOLS_CORE, CRNRSTN_UI_JS_MAIN,
                    CRNRSTN_CSS_FRAMEWORK_SIMPLE_GRID, CRNRSTN_CSS_FRAMEWORK_960_GRID_SYSTEM,
                    CRNRSTN_CSS_FRAMEWORK_960_GRID_SYSTEM_24COL,  CRNRSTN_CSS_FRAMEWORK_960_GRID_SYSTEM_16COL,
                    CRNRSTN_CSS_FRAMEWORK_960_GRID_SYSTEM_12COL, CRNRSTN_CSS_FRAMEWORK_960_GRID_SYSTEM_24COL_RTL,
                    CRNRSTN_CSS_FRAMEWORK_960_GRID_SYSTEM_16COL_RTL, CRNRSTN_CSS_FRAMEWORK_960_GRID_SYSTEM_12COL_RTL,
                    CRNRSTN_CSS_FRAMEWORK_960_GRID_SYSTEM_RTL, CRNRSTN_CSS_FRAMEWORK_FOUNDATION,
                    CRNRSTN_CSS_FRAMEWORK_HTML5_BOILERPLATE, CRNRSTN_CSS_FRAMEWORK_RESPONSIVE_GRID_SYSTEM,
                    CRNRSTN_CSS_FRAMEWORK_UNSEMANTIC, CRNRSTN_CSS_FRAMEWORK_UNSEMANTIC_RESET,
                    CRNRSTN_CSS_FRAMEWORK_UNSEMANTIC_RESET_RTL, CRNRSTN_CSS_FRAMEWORK_UNSEMANTIC_RTL,
                    CRNRSTN_CSS_FRAMEWORK_UNSEMANTIC_ADAPT, CRNRSTN_CSS_FRAMEWORK_UNSEMANTIC_ADAPT_RTL,
                    CRNRSTN_CSS_FRAMEWORK_DEAD_SIMPLE_GRID, CRNRSTN_CSS_FRAMEWORK_SKELETON,
                    CRNRSTN_CSS_FRAMEWORK_RWDGRID, CRNRSTN_CSS_FRAMEWORK_THISISDALLAS_SIMPLEGRID,
                    CRNRSTN_UI_CSS_MAIN_DESKTOP, CRNRSTN_UI_CSS_MAIN_TABLET, CRNRSTN_UI_CSS_MAIN_MOBILE);

                $tmp_output_ARRAY = $this->return_resource_profile($tmp_resource_ctrl_ARRAY);

            break;
            case 'system_output_footer_html':

                //
                //CRNRSTN_RESOURCE_DOCUMENTATION
                //CRNRSTN_UI_TAG_ENGAGEMENT
                //CRNRSTN_UI_TAG_ANALYTICS
                //CRNRSTN_UI_SOAP_DATA_TUNNEL
                //CRNRSTN_REPORT_RESPONSE_RETURN
                $tmp_output_ARRAY = array();

            break;
            case 'system_theme_profiles':

                $tmp_output_ARRAY = $this->oCRNRSTN->system_theme_style_constants_ARRAY;

            break;
            default:

                //
                // ALL CONSTANTS
                $tmp_output_ARRAY = $this->oCRNRSTN->return_global_constants_string_ARRAY();

            break;

        }

        return $tmp_output_ARRAY;

    }

	public function __destruct() {
		
	}
}