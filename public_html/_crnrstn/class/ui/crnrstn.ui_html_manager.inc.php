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
#		Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated
#		documentation files (the "Software"), to deal in the Software without restriction, including without limitation
#       the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software,
#       and to permit persons to whom the Software is furnished to do so, subject to the following conditions:
#
#		The above copyright notice and this permission notice shall be included in all copies or substantial portions
#		of the Software.
#
#		THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED
#       TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL
#       THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF
#       CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER
#       DEALINGS IN THE SOFTWARE.
#
# # C # R # N # R # S # T # N # : : # # ##
#
#  CLASS :: crnrstn_ui_html_manager
#  VERSION :: 1.00.0000
#  DATE :: May 1, 2021 @ 1219hrs
#  AUTHOR :: Jonathan 'J5' Harris, jharris@eVifweb.com
#  URI :: 
#  DESCRIPTION :: Support for generation of CRNRSTN :: support web content.
#  LICENSE :: MIT | http://crnrstn.evifweb.com/licensing/
#
class crnrstn_ui_html_manager {

	protected $oLogger;
	public $oCRNRSTN;
    protected $oCRNRSTN_UI_ASSEMBLER;

    public $page_serial;
    protected $docs_nav_link_ARRAY = array();
    protected $docs_nav_html = '';

	public function __construct($oCRNRSTN){

	    $this->oCRNRSTN = $oCRNRSTN;

        //
        // INSTANTIATE LOGGER
        $this->oLogger = new crnrstn_logging(__CLASS__, $this->oCRNRSTN);

        //
        // PAGE CONTENT AGGREGATION
        $this->oCRNRSTN_UI_ASSEMBLER = new crnrstn_ui_content_assembler($this->oCRNRSTN);

        //$channel_selected_ARRAY = $this->oCRNRSTN->return_set_bits($this->oCRNRSTN->system_output_channel_constants);

	}

//    public function return_int_const_profile($resource_constant){
//
//        return $this->oCRNRSTN_UI_ASSEMBLER->return_int_const_profile($resource_constant);
//
//    }

    public function return_output_CRNRSTN_UI_DOCS_NAV_LINK($content_type, $output_type = 'HTML'){

	    if($output_type === 'array'){

	        if(count($this->docs_nav_link_ARRAY) > 0){

	            return $this->docs_nav_link_ARRAY;

            }

        }

	    if(strlen($this->docs_nav_html) > 0 && $output_type === 'HTML'){

	        return $this->docs_nav_html;

        }

        $tmp_str = '';
        $tmp_data_type_family = 'CRNRSTN_SYSTEM_RESOURCE::INTERACT_UI::DOCUMENTATION_NAV';

        $tmp_nav_cnt = $this->oCRNRSTN->get_resource_count('CRNRSTN_NAV_LINK', $tmp_data_type_family);
	    if($tmp_nav_cnt < 1){

            $directory = CRNRSTN_ROOT . '/_crnrstn/ui/docs/documentation/' . $content_type . '/';

            $scanned_directory_ARRAY = $this->oCRNRSTN->better_scandir($directory);

            //
            // SOURCE :: https://www.php.net/manual/en/function.scandir.php
            // AUTHOR :: dwieeb at gmail dot com :: https://www.php.net/manual/en/function.scandir.php#107215
            $scanned_directory_ARRAY = array_diff($scanned_directory_ARRAY, array('..', '.', 'index.php'));

            foreach($scanned_directory_ARRAY as $index => $dir_resource){

                $tmp_data_key = 'CRNRSTN_NAV_LINK';
                $this->oCRNRSTN->add_system_resource($tmp_data_key, $dir_resource, $tmp_data_type_family);

                if(!$this->oCRNRSTN->tmp_restrict_this_lorem_ipsum_method($dir_resource)){

                    $this->docs_nav_link_ARRAY[$dir_resource] = 1;

                    if($this->oCRNRSTN->is_bit_set(CRNRSTN_RESOURCE_PRODUCTION_MIN_JS_CSS)){

                        $this->docs_nav_html .= '<li><a rel="crnrstn_documentation_side_nav_' . $this->oCRNRSTN->session_salt() . '" data-crnrstn="' . $dir_resource . '" id="crnrstn_text_lnk_' . $this->oCRNRSTN->hash($dir_resource, 'md5') . '" href="#' . $dir_resource . '" title="' . $dir_resource . '">' . $dir_resource . '</a></li>';

                    }else{

                        $this->docs_nav_html .= '
                <li><a rel="crnrstn_documentation_side_nav_' . $this->oCRNRSTN->session_salt() . '" data-crnrstn="' . $dir_resource . '" id="crnrstn_text_lnk_' . $this->oCRNRSTN->hash($dir_resource, 'md5') . '" href="#' . $dir_resource . '" title="' . $dir_resource . '">' . $dir_resource . '</a></li>';

                    }

                }

            }

            if($output_type == 'array'){

                return $this->docs_nav_link_ARRAY;

            }

            $this->oCRNRSTN->add_system_resource('DOCUMENTATION_NAV_COMPONENT_HTML', $this->docs_nav_html, $tmp_data_type_family);

            return $this->docs_nav_html;

        }

	    for($i = 0; $i < $tmp_nav_cnt; $i++){

            $dir_resource = $this->oCRNRSTN->get_resource('CRNRSTN_NAV_LINK', $i, $tmp_data_type_family);

            if(!$this->oCRNRSTN->tmp_restrict_this_lorem_ipsum_method($dir_resource)){

                $this->docs_nav_link_ARRAY[$dir_resource] = 1;

                if($this->oCRNRSTN->is_bit_set(CRNRSTN_RESOURCE_PRODUCTION_MIN_JS_CSS)){

                    $this->docs_nav_html .= '<li><a rel="crnrstn_documentation_side_nav_' . $this->oCRNRSTN->session_salt() . '" data-crnrstn="' . $dir_resource . '" id="crnrstn_text_lnk_' . $this->oCRNRSTN->hash($dir_resource, 'md5') . '" href="#' . $dir_resource . '" title="' . $dir_resource . '">' . $dir_resource . '</a></li>';

                }else{

                    $this->docs_nav_html .= '
                <li><a rel="crnrstn_documentation_side_nav_' . $this->oCRNRSTN->session_salt() . '" data-crnrstn="' . $dir_resource . '" id="crnrstn_text_lnk_' . $this->oCRNRSTN->hash($dir_resource, 'md5') . '" href="#' . $dir_resource . '" title="' . $dir_resource . '">' . $dir_resource . '</a></li>';

                }

            }

        }

        return $this->docs_nav_html;

    }

    public function out_ui_module_html_system_mit_license(){

        $tmp_module_page_key = $this->oCRNRSTN->oDATA_TUNNEL_SERVICES_MGR->return_received_data('crnrstn_interact_ui_link_text_click');

        if(strlen($tmp_module_page_key) > 0){

            if($this->oCRNRSTN->is_bit_set(CRNRSTN_RESOURCE_PRODUCTION_MIN_JS_CSS)){

                $tmp_mit_license = '<div class="crnrstn_mit_license_hdr_branding_shell"><div class="crnrstn_env_select_wrapper"><div class="crnrstn_env_select_component_wrapper"><select name="crnrstn_host_endpoint" style="height: 15px; font-size: 11px; display:inline;"><option value="0">-</option><option value="7">Apache v' . $this->oCRNRSTN->version_apache() . '</option><option value="8">MySQLi v' . $this->oCRNRSTN->version_mysqli() . '</option><option value="9">PHP v' . $this->oCRNRSTN->version_php() . '</option></select></div><div class="crnrstn_cb"></div><div class="crnrstn_static_hdr_branding_shell"><div class="crnrstn_static_hdr_branding_copy">C<span class="the_R_in_crnrstn">R</span>NRSTN :: v' . $this->oCRNRSTN->version_crnrstn() . '</div></div></div><div class="crnrstn_dyn_branding_elem_wrapper signin"><div class="crnrstn_dyn_branding_elem_shell">' . $this->oCRNRSTN->return_branding_creative(true, CRNRSTN_UI_IMG_HTML_WRAPPED) . '</div></div><div class="crnrstn_cb_5"></div></div><div class="crnrstn_section_outter_wrapper signin"><div class="crnrstn_section_inner_wrapper signin"><div class="crnrstn_signin_meta_time_stats_wrapper"><div class="crnrstn_signin_meta_time_stats">[' . $this->oCRNRSTN->return_micro_time() . ' ' . date('T') . '] [rtime ' . $this->oCRNRSTN->wall_time() . ' secs]</div><div class="crnrstn_signin_meta_5_logo">' . $this->oCRNRSTN->return_creative('FIVE', CRNRSTN_UI_IMG_HTML_WRAPPED) . '</div><div class="crnrstn_signin_backdrop_logo">' . $this->oCRNRSTN->return_system_image('CRNRSTN_LOGO','', 250, '', '', '', '', CRNRSTN_UI_IMG_HTML_WRAPPED) . '</div><div class="crnrstn_cb"></div></div><div class="crnrstn_cb"></div><div class="crnrstn_signin_form_outter_wrapper"><div class="crnrstn_signin_form_inner_wrapper crnrstn_mit_landing"><div class="crnrstn_signin_form_inner_wrapper_rel"><div class="crnrstn_mit_license_wrapper">
<code><pre>MIT License

Copyright (c) 2012-' . date('Y') . ' Jonathan \'J5\' Harris

Permission is hereby granted, free of charge, to any person obtaining 
a copy of this software and associated documentation files (the 
"Software"), to deal in the Software without restriction, including 
without limitation the rights to use, copy, modify, merge, publish, 
distribute, sublicense, and/or sell copies of the Software, and to 
permit persons to whom the Software is furnished to do so, subject to
the following conditions:

The above copyright notice and this permission notice shall be 
included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, 
EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF 
MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. 
IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY 
CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, 
TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE 
SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
</pre></code></div></div></div></div></div></div><div class="crnrstn_cb_40"></div>';

            }else{

                $tmp_mit_license = '<div class="crnrstn_mit_license_hdr_branding_shell">
            <div class="crnrstn_env_select_wrapper">
                <div class="crnrstn_env_select_component_wrapper">
                    <select name="crnrstn_host_endpoint" style="height: 15px; font-size: 11px; display:inline;">
                        <option value="0">-</option>
                        <option value="7">Apache v' . $this->oCRNRSTN->version_apache() . '</option>
                        <option value="8">MySQLi v' . $this->oCRNRSTN->version_mysqli() . '</option>
                        <option value="9">PHP v' . $this->oCRNRSTN->version_php() . '</option>
                    </select>
                    
                </div>
                <div class="crnrstn_cb"></div>
                
                <div class="crnrstn_static_hdr_branding_shell">
                    <div class="crnrstn_static_hdr_branding_copy">C<span class="the_R_in_crnrstn">R</span>NRSTN :: v' . $this->oCRNRSTN->version_crnrstn() . '</div>
                </div>

            </div>

            <div class="crnrstn_dyn_branding_elem_wrapper signin">
                <div class="crnrstn_dyn_branding_elem_shell">' . $this->oCRNRSTN->return_branding_creative(true, CRNRSTN_UI_IMG_HTML_WRAPPED) . '</div>
            </div>

                <div class="crnrstn_cb_5"></div>
                
        </div>

        <div class="crnrstn_section_outter_wrapper signin">
            <div class="crnrstn_section_inner_wrapper signin">

                <div class="crnrstn_signin_meta_time_stats_wrapper">
                    <div class="crnrstn_signin_meta_time_stats">[' . $this->oCRNRSTN->return_micro_time() . ' ' . date('T') . '] [rtime ' . $this->oCRNRSTN->wall_time() . ' secs]</div>
                    <div class="crnrstn_signin_meta_5_logo">' . $this->oCRNRSTN->return_creative('FIVE', CRNRSTN_UI_IMG_HTML_WRAPPED) . '</div>

                    <div class="crnrstn_signin_backdrop_logo">' . $this->oCRNRSTN->return_system_image('CRNRSTN_LOGO','', 250, '', '', '', '', CRNRSTN_UI_IMG_HTML_WRAPPED) . '</div>

                    <div class="crnrstn_cb"></div>
                </div>

                <div class="crnrstn_cb"></div>

                <div class="crnrstn_signin_form_outter_wrapper">

                    <div class="crnrstn_signin_form_inner_wrapper crnrstn_mit_landing">

                        <div class="crnrstn_signin_form_inner_wrapper_rel">

                            <div class="crnrstn_mit_license_wrapper">
                                <code><pre>MIT License
                               
Copyright (c) 2012-' . date('Y') . ' Jonathan \'J5\' Harris

Permission is hereby granted, free of charge, to any person obtaining 
a copy of this software and associated documentation files (the 
"Software"), to deal in the Software without restriction, including 
without limitation the rights to use, copy, modify, merge, publish, 
distribute, sublicense, and/or sell copies of the Software, and to 
permit persons to whom the Software is furnished to do so, subject to
the following conditions:

The above copyright notice and this permission notice shall be 
included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, 
EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF 
MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. 
IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY 
CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, 
TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE 
SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
</pre></code>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

        </div>
        <div class="crnrstn_cb_40"></div>';

            }

            if($this->oCRNRSTN->is_bit_set(CRNRSTN_RESOURCE_PRODUCTION_MIN_JS_CSS)){

                $tmp_html_out = '<div class="crnrstn_lightbox_body_wrapper"><div class="crnrstn_lightbox_content_shell"><div class="crnrstn_mit_license_module_wrap_s3"><div class="crnrstn_mit_license_module_border_rel"><div class="crnrstn_mit_license_module_border"><div class="crnrstn_hidden_void"><div class="crnrstn_mit_license_module_content">' . $tmp_mit_license . '</div></div></div></div><div class="crnrstn_mit_license_module_wrap_s2_outter"><div class="crnrstn_mit_license_module_wrap_s2_inner"><div class="crnrstn_mit_license_module_bg_rel"><div class="crnrstn_mit_license_module_wrap_s1_rel"><div class="crnrstn_mit_license_module_wrap_s1"><div class="crnrstn_mit_license_module_content">' . $tmp_mit_license . '</div></div><div class="crnrstn_documentation_dyn_content_module_bg"></div><div class="crnrstn_hidden_void"><div class="crnrstn_mit_license_module_content">' . $tmp_mit_license . '</div></div></div></div></div></div></div></div></div>';

            }else{

                $tmp_html_out = '<div class="crnrstn_lightbox_body_wrapper">
            <div class="crnrstn_lightbox_content_shell">
            
                <div class="crnrstn_mit_license_module_wrap_s3">
                
                    <div class="crnrstn_mit_license_module_border_rel">
                        <div class="crnrstn_mit_license_module_border">
                            <div class="crnrstn_hidden_void">
                                <div class="crnrstn_mit_license_module_content">' . $tmp_mit_license . '</div>
                                
                            </div>
                        </div>
                    </div>
                    
                    <div class="crnrstn_mit_license_module_wrap_s2_outter">
                        <div class="crnrstn_mit_license_module_wrap_s2_inner">
                        
                            <div class="crnrstn_mit_license_module_bg_rel">
                                    
                                <div class="crnrstn_mit_license_module_wrap_s1_rel">
                               
                                    <div class="crnrstn_mit_license_module_wrap_s1">
                            
                                        <div class="crnrstn_mit_license_module_content">' . $tmp_mit_license . '</div>

                                    </div>
                                    
                                    <div class="crnrstn_documentation_dyn_content_module_bg"></div>
                                
                                    <div class="crnrstn_hidden_void">
                                        <div class="crnrstn_mit_license_module_content">' . $tmp_mit_license . '</div>
                                    
                                    </div>
                                    
                                </div>
                            
                            </div>
                            
                        </div>
                    </div>
                </div>
                
                </div>
        </div>';

            }

            return $tmp_html_out;

        }

        return '';

    }

    public function sauce($resource){

	    return $this->oCRNRSTN_UI_ASSEMBLER->sauce($resource);

    }

    public function out_ui_module_html_system_documentation_page($module_key_override = NULL){

	    //error_log(__LINE__ . ' ui html out_ui_module_html_system_documentation_page.');
        $this->page_serial = $this->oCRNRSTN_UI_ASSEMBLER->initialize_page_content($module_key_override);

        //
        // SEARCH INTEGRATION
        //$this->oCRNRSTN_UI_ASSEMBLER->index_page();

        $tmp_html_out = $this->oCRNRSTN_UI_ASSEMBLER->return_page_html($this->page_serial);

        return $tmp_html_out;

    }

    public function out_ui_module_html_system_documentation_nav($content_type = 'php'){

        if($this->oCRNRSTN->is_bit_set(CRNRSTN_RESOURCE_PRODUCTION_MIN_JS_CSS)){

            $tmp_html_out = '<div id="crnrstn_interact_ui_side_nav_search" class="crnrstn_interact_ui_side_nav_search" onmouseover="oCRNRSTN_JS.crnrstn_interact_ui_ux(\'onmouseover\', this);" onmouseout="oCRNRSTN_JS.crnrstn_interact_ui_ux(\'onmouseout\', this);" onclick="oCRNRSTN_JS.crnrstn_interact_ui_ux(\'onclick\', this);"><div id="crnrstn_interact_ui_side_nav_search_img_bg" class="crnrstn_interact_ui_bg_layer" style="width:2000px; height:2000px;"></div><div class="crnrstn_interact_ui_side_nav_search_bar_rel"><div id="crnrstn_interact_ui_side_nav_search_bar" class="crnrstn_interact_ui_side_nav_search_bar"></div></div><div id="crnrstn_interact_ui_side_nav_search_img_wrapper" class="crnrstn_interact_ui_side_nav_v_img_wrapper"><div id="crnrstn_interact_ui_side_nav_search_img_rel" class="crnrstn_interact_ui_side_nav_search_img_rel" style="width:35px; height:26px;"><div id="crnrstn_interact_ui_side_nav_search_img" class="crnrstn_interact_ui_side_nav_search_img">' . $this->oCRNRSTN->return_system_image('SEARCH_MAGNIFY_GLASS','', 20, NULL, NULL, NULL, NULL, CRNRSTN_UI_IMG_HTML_WRAPPED) . '</div><div class="crnrstn_cb"></div></div><div class="crnrstn_cb"></div></div><div class="crnrstn_cb"></div></div><div id="crnrstn_interact_ui_side_nav_logo" class="crnrstn_interact_ui_side_nav_logo" onmouseover="oCRNRSTN_JS.crnrstn_interact_ui_ux(\'onmouseover\', this);" onmouseout="oCRNRSTN_JS.crnrstn_interact_ui_ux(\'onmouseout\', this);" onclick="oCRNRSTN_JS.crnrstn_interact_ui_ux(\'onclick\', this);"><div id="crnrstn_interact_ui_side_nav_logo_img_bg" class="crnrstn_interact_ui_bg_layer" style="width:2000px; height:2000px;"></div><div class="crnrstn_interact_ui_side_nav_logo_bar_rel"><div id="crnrstn_interact_ui_side_nav_logo_bar" class="crnrstn_interact_ui_side_nav_logo_bar"></div></div><div id="crnrstn_interact_ui_side_nav_logo_img_wrapper" class="crnrstn_interact_ui_side_nav_logo_img_wrapper"><div id="crnrstn_interact_ui_side_nav_logo_img_rel" class="crnrstn_interact_ui_side_nav_logo_img_rel" style="width:80px; height:50px;"><div id="crnrstn_interact_ui_side_nav_logo_img" class="crnrstn_interact_ui_side_nav_logo_img">' . $this->oCRNRSTN->return_system_image('CRNRSTN_LOGO', '', 40, '', '', '', '', CRNRSTN_UI_IMG_HTML_WRAPPED) . '</div><div class="crnrstn_cb"></div></div><div class="crnrstn_cb"></div></div><div class="crnrstn_cb"></div></div><nav id="crnrstn_interact_ui_side_nav" class="crnrstn_interact_ui_side_nav"><!-- SOURCE :: https://www.w3schools.com/howto/howto_css_fixed_sidebar.asp --><ul>' . $this->return_output_CRNRSTN_UI_DOCS_NAV_LINK($content_type) . '</ul><div class="crnrstn_cb_20"></div><div class="crnrstn_interact_ui_side_nav_5">' . $this->oCRNRSTN->return_system_image('FIVE', 30, 30, '', '', '', '', CRNRSTN_UI_IMG_HTML_WRAPPED) . '</div><div class="crnrstn_cb_100"></div></nav></div>';

        }else{

            $tmp_html_out = '<div id="crnrstn_interact_ui_side_nav_search" class="crnrstn_interact_ui_side_nav_search" onmouseover="oCRNRSTN_JS.crnrstn_interact_ui_ux(\'onmouseover\', this);" onmouseout="oCRNRSTN_JS.crnrstn_interact_ui_ux(\'onmouseout\', this);" onclick="oCRNRSTN_JS.crnrstn_interact_ui_ux(\'onclick\', this);">
                
                <div id="crnrstn_interact_ui_side_nav_search_img_bg" class="crnrstn_interact_ui_bg_layer" style="width:2000px; height:2000px;"></div>

                <div class="crnrstn_interact_ui_side_nav_search_bar_rel">
                    <div id="crnrstn_interact_ui_side_nav_search_bar" class="crnrstn_interact_ui_side_nav_search_bar"></div>
                </div>
                
                <div id="crnrstn_interact_ui_side_nav_search_img_wrapper" class="crnrstn_interact_ui_side_nav_v_img_wrapper">
                    
                    <div id="crnrstn_interact_ui_side_nav_search_img_rel" class="crnrstn_interact_ui_side_nav_search_img_rel" style="width:35px; height:26px;">
                    
                        <div id="crnrstn_interact_ui_side_nav_search_img" class="crnrstn_interact_ui_side_nav_search_img">' . $this->oCRNRSTN->return_system_image('SEARCH_MAGNIFY_GLASS','', 20, NULL, NULL, NULL, NULL, CRNRSTN_UI_IMG_HTML_WRAPPED) . '</div>
                        <div class="crnrstn_cb"></div>

                    </div>
                    <div class="crnrstn_cb"></div>
                    
                </div>
                <div class="crnrstn_cb"></div>
                
            </div>
           
            <div id="crnrstn_interact_ui_side_nav_logo" class="crnrstn_interact_ui_side_nav_logo" onmouseover="oCRNRSTN_JS.crnrstn_interact_ui_ux(\'onmouseover\', this);" onmouseout="oCRNRSTN_JS.crnrstn_interact_ui_ux(\'onmouseout\', this);" onclick="oCRNRSTN_JS.crnrstn_interact_ui_ux(\'onclick\', this);">
                
                <div id="crnrstn_interact_ui_side_nav_logo_img_bg" class="crnrstn_interact_ui_bg_layer" style="width:2000px; height:2000px;"></div>

                <div class="crnrstn_interact_ui_side_nav_logo_bar_rel">
                    <div id="crnrstn_interact_ui_side_nav_logo_bar" class="crnrstn_interact_ui_side_nav_logo_bar"></div>
                </div>
                
                <div id="crnrstn_interact_ui_side_nav_logo_img_wrapper" class="crnrstn_interact_ui_side_nav_logo_img_wrapper">
                    
                    <div id="crnrstn_interact_ui_side_nav_logo_img_rel" class="crnrstn_interact_ui_side_nav_logo_img_rel" style="width:80px; height:50px;">
                    
                        <div id="crnrstn_interact_ui_side_nav_logo_img" class="crnrstn_interact_ui_side_nav_logo_img">' . $this->oCRNRSTN->return_system_image('CRNRSTN_LOGO', '', 40, '', '', '', '', CRNRSTN_UI_IMG_HTML_WRAPPED) . '</div>
                        <div class="crnrstn_cb"></div>

                    </div>
                    <div class="crnrstn_cb"></div>
                </div>
            <div class="crnrstn_cb"></div>
            </div>
           
            <div id="crnrstn_interact_ui_side_nav" class="crnrstn_interact_ui_side_nav">
                <!-- SOURCE :: https://www.w3schools.com/howto/howto_css_fixed_sidebar.asp -->
                <ul>' . $this->return_output_CRNRSTN_UI_DOCS_NAV_LINK($content_type) . '
                </ul>                
                <div class="crnrstn_cb_20"></div>
                <div class="crnrstn_interact_ui_side_nav_5">' . $this->oCRNRSTN->return_system_image('FIVE', 30, 30, '', '', '', '', CRNRSTN_UI_IMG_HTML_WRAPPED) . '</div>
                
                <div class="crnrstn_cb_100"></div>

           </div>
              
        </div>';

        }


        return $tmp_html_out;

    }

    public function out_ui_module_html_system_footer_content_container(){

	    $tmp_framework_link_value = $this->oCRNRSTN->oDATA_TUNNEL_SERVICES_MGR->return_received_data('crnrstn_interact_ui_link_text_click');

	    $tmp_string_constant_ARRAY = explode('|', $tmp_framework_link_value);

	    if(!isset($tmp_string_constant_ARRAY[1])){

            //
            // MISSING PIPE DELIMITED SITUATION, FOR SOME REASON.
	        return '';

        }

	    $tmp_resource_constant = $this->oCRNRSTN->return_int_const_profile($tmp_string_constant_ARRAY[1], 'DESCRIPTION');

//        if($this->oCRNRSTN->is_bit_set(CRNRSTN_RESOURCE_PRODUCTION_MIN_JS_CSS)){
//
//
//        }else{
//
//
//
//        }

        $tmp_html_out = '<div id="crnrstn_ui_system_footer_content_container_wrapper" class="crnrstn_ui_system_footer_content_container_wrapper">

            <div class="crnrstn_ui_system_footer_rel">
        
                <div id="crnrstn_ui_system_footer_content_container" class="crnrstn_ui_system_footer">
                    
                        <div class="crnrstn_ui_system_footer_content">
                            <div id="crnrstn_ui_system_footer_content_container_stache" class="crnrstn_ui_system_footer_stache">' . $this->oCRNRSTN->return_system_image('STACHE','', 17, NULL, NULL, NULL, NULL, CRNRSTN_UI_IMG_HTML_WRAPPED) . '</div>

                            <div id="crnrstn_ui_system_footer_content_container_mit" class="crnrstn_ui_system_footer_mit"><a id="crnrstn_ui_system_footer_content_container_mit_lnk" href="#" onclick="oCRNRSTN_JS.crnrstn_interact_ui_ux(\'onclick\', this);" target="_self">' . $this->oCRNRSTN->multi_lang_content_return('COPY_ALL_RIGHTS_PART_MIT') . '</a></div>
                            <div id="crnrstn_ui_system_footer_content_container_download" class="crnrstn_ui_system_footer_download"><a style="font-family: Courier New, Courier, monospace; font-size:12px; line-height: 20px;" href="'. $this->oCRNRSTN->return_sticky_link('https://github.com/jony5/CRNRSTN-v2.00.0000-PRE-ALPHA-DEV-Lightsaber', 'crnrstn_text_lnk_download') .'" target="_blank">' . $this->oCRNRSTN->multi_lang_content_return('LNK_DOWNLOAD_TXT_FOOTER') . '</a></div>
                            
                            <div class="crnrstn_ui_system_footer_stats_wrapper">
                                <div id="crnrstn_ui_system_footer_content_container_stat_stime" class="crnrstn_ui_system_footer_stat">[' . $this->oCRNRSTN->return_micro_time() . ']</div>
                                <div id="crnrstn_ui_system_footer_content_container_stat_rtime" class="crnrstn_ui_system_footer_stat">[rtime ' . $this->oCRNRSTN->wall_time() . ' secs]</div>
                                <div id="crnrstn_ui_system_footer_content_container_stat_wtime" class="crnrstn_ui_system_footer_stat">[' . $tmp_resource_constant . ']</div>
                                <div id="crnrstn_ui_system_footer_content_container_stat_meta" class="crnrstn_ui_system_footer_stat"></div>
                            </div>
                                    
                            <div class="crnrstn_ui_system_footer_5">' . $this->oCRNRSTN->return_system_image('FIVE', 20, 20, NULL, NULL, NULL, NULL, CRNRSTN_UI_IMG_HTML_WRAPPED) . '</div>

                            <div class="crnrstn_cb"></div>
                            
                        </div>
                    
                    <div class="crnrstn_cb"></div>
                    
               </div>
               
            </div>
            
        </div>';

        error_log(__LINE__ . ' html mgr RETURN SSDTLA XML data for [' . $this->oCRNRSTN->oDATA_TUNNEL_SERVICES_MGR->return_received_data('crnrstn_interact_ui_link_text_click') . '].');

        return $tmp_html_out;


    }

    public function out_ui_module_html_system_footer_generic(){

        if($this->oCRNRSTN->is_bit_set(CRNRSTN_RESOURCE_PRODUCTION_MIN_JS_CSS)){

            $tmp_html_out = '<div id="crnrstn_ui_system_footer_wrapper" class="crnrstn_ui_system_footer_wrapper"><div class="crnrstn_ui_system_footer_rel"><div id="crnrstn_ui_system_footer" class="crnrstn_ui_system_footer"><div class="crnrstn_ui_system_footer_content"><div id="crnrstn_ui_system_footer_stache" class="crnrstn_ui_system_footer_stache">' . $this->oCRNRSTN->return_system_image('STACHE','', 17, NULL, NULL, NULL, NULL, CRNRSTN_UI_IMG_HTML_WRAPPED) . '</div><div id="crnrstn_ui_system_footer_mit" class="crnrstn_ui_system_footer_mit"><a id="crnrstn_ui_system_footer_mit_lnk" href="#" onclick="oCRNRSTN_JS.crnrstn_interact_ui_ux(\'onclick\', this);" target="_self">' . $this->oCRNRSTN->multi_lang_content_return('COPY_ALL_RIGHTS_PART_MIT') . '</a></div><div id="crnrstn_ui_system_footer_download" class="crnrstn_ui_system_footer_download"><a style="font-family: Courier New, Courier, monospace; font-size:12px; line-height: 20px;" href="'. $this->oCRNRSTN->return_sticky_link('https://github.com/jony5/CRNRSTN-v2.00.0000-PRE-ALPHA-DEV-Lightsaber', 'crnrstn_text_lnk_download') .'" target="_blank">' . $this->oCRNRSTN->multi_lang_content_return('LNK_DOWNLOAD_TXT_FOOTER') . '</a></div><div class="crnrstn_ui_system_footer_stats_wrapper"><div id="crnrstn_ui_system_footer_stat_stime" class="crnrstn_ui_system_footer_stat">[' . $this->oCRNRSTN->return_micro_time() . ']</div><div id="crnrstn_ui_system_footer_stat_rtime" class="crnrstn_ui_system_footer_stat">[rtime ' . $this->oCRNRSTN->wall_time() . ' secs]</div><div id="crnrstn_ui_system_footer_stat_wtime" class="crnrstn_ui_system_footer_stat">[wtime ' . $this->oCRNRSTN->wall_time() . ' secs]</div><div id="crnrstn_ui_system_footer_stat_meta" class="crnrstn_ui_system_footer_stat"></div></div><div class="crnrstn_ui_system_footer_5">' . $this->oCRNRSTN->return_system_image('FIVE', 20, 20, NULL, NULL, NULL, NULL, CRNRSTN_UI_IMG_HTML_WRAPPED) . '</div><div class="crnrstn_cb"></div></div><div class="crnrstn_cb"></div></div></div></div>';

        }else{

            $tmp_html_out = '<div id="crnrstn_ui_system_footer_wrapper" class="crnrstn_ui_system_footer_wrapper">

                <div class="crnrstn_ui_system_footer_rel">
            
                    <div id="crnrstn_ui_system_footer" class="crnrstn_ui_system_footer">
                        
                            <div class="crnrstn_ui_system_footer_content">
                                <div id="crnrstn_ui_system_footer_stache" class="crnrstn_ui_system_footer_stache">' . $this->oCRNRSTN->return_system_image('STACHE','', 17, NULL, NULL, NULL, NULL, CRNRSTN_UI_IMG_HTML_WRAPPED) . '</div>

                                <div id="crnrstn_ui_system_footer_mit" class="crnrstn_ui_system_footer_mit"><a id="crnrstn_ui_system_footer_mit_lnk" href="#" onclick="oCRNRSTN_JS.crnrstn_interact_ui_ux(\'onclick\', this);" target="_self">' . $this->oCRNRSTN->multi_lang_content_return('COPY_ALL_RIGHTS_PART_MIT') . '</a></div>
                                <div id="crnrstn_ui_system_footer_download" class="crnrstn_ui_system_footer_download"><a style="font-family: Courier New, Courier, monospace; font-size:12px; line-height: 20px;" href="'. $this->oCRNRSTN->return_sticky_link('https://github.com/jony5/CRNRSTN-v2.00.0000-PRE-ALPHA-DEV-Lightsaber', 'crnrstn_text_lnk_download') .'" target="_blank">' . $this->oCRNRSTN->multi_lang_content_return('LNK_DOWNLOAD_TXT_FOOTER') . '</a></div>
                                
                                <div class="crnrstn_ui_system_footer_stats_wrapper">
                                    <div id="crnrstn_ui_system_footer_stat_stime" class="crnrstn_ui_system_footer_stat">[' . $this->oCRNRSTN->return_micro_time() . ']</div>
                                    <div id="crnrstn_ui_system_footer_stat_rtime" class="crnrstn_ui_system_footer_stat">[rtime ' . $this->oCRNRSTN->wall_time() . ' secs]</div>
                                    <div id="crnrstn_ui_system_footer_stat_wtime" class="crnrstn_ui_system_footer_stat">[wtime ' . $this->oCRNRSTN->wall_time() . ' secs]</div>
                                    <div id="crnrstn_ui_system_footer_stat_meta" class="crnrstn_ui_system_footer_stat"></div>
                                </div>
                                        
                                <div class="crnrstn_ui_system_footer_5">' . $this->oCRNRSTN->return_system_image('FIVE', 20, 20, NULL, NULL, NULL, NULL, CRNRSTN_UI_IMG_HTML_WRAPPED) . '</div>

                                <div class="crnrstn_cb"></div>
                                
                            </div>
                        
                        <div class="crnrstn_cb"></div>
                        
                   </div>
                   
                </div>
                
            </div>';

        }




        return $tmp_html_out;

    }

    public function out_ui_module_html_system_messenger(){

        if($this->oCRNRSTN->is_bit_set(CRNRSTN_RESOURCE_PRODUCTION_MIN_JS_CSS)){

            $tmp_html_out = '<div id="crnrstn_interact_ui_wrapper" class="crnrstn_interact_ui_wrapper"><div class="crnrstn_interact_ui"><div id="crnrstn_interact_ui_bg_border" class="crnrstn_interact_ui_bg_border"></div><div id="crnrstn_interact_ui_bg_border_edge" class="crnrstn_interact_ui_bg_border_edge" style="border: 1px solid #FFF;"></div><div style="position:relative; height:106px;"><div id="crnrstn_interact_ui_primary_navgroup_wrapper" class="crnrstn_interact_ui_primary_navgroup_wrapper"><div id="crnrstn_interact_ui_primary_nav_menu" class="crnrstn_interact_ui_primary_navgroup_lnk_border"><div id="crnrstn_interact_ui_primary_nav_img_shell_menu_inactive" class="crnrstn_interact_ui_primary_nav_img_shell"><img src="' . $this->oCRNRSTN->return_creative('PRIMARY_NAV_BLUE00_MENU_INACTIVE', CRNRSTN_UI_IMG_BASE64) . '" width="40" height="40" alt="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_ALT_MENU') . '" title="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_TITLE_MENU') . '"></div><div id="crnrstn_interact_ui_primary_nav_img_shell_menu_hvr" class="crnrstn_interact_ui_primary_nav_img_shell"><img src="' . $this->oCRNRSTN->return_creative('PRIMARY_NAV_BLUE00_MENU_HOVER', CRNRSTN_UI_IMG_BASE64) . '" width="40" height="40" alt="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_ALT_MENU') . '" title="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_TITLE_MENU') . '"></div><div id="crnrstn_interact_ui_primary_nav_img_shell_menu_click" class="crnrstn_interact_ui_primary_nav_img_shell"><img src="' . $this->oCRNRSTN->return_creative('PRIMARY_NAV_BLUE00_MENU_CLICK', CRNRSTN_UI_IMG_BASE64) . '" width="40" height="40" alt="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_ALT_MENU') . '" title="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_TITLE_MENU') . '"></div><div id="crnrstn_interact_ui_primary_nav_img_shell_menu" class="crnrstn_interact_ui_primary_nav_img_shell crnrstn_interact_ui_active"><img src="' . $this->oCRNRSTN->return_creative('PRIMARY_NAV_BLUE00_MENU', CRNRSTN_UI_IMG_BASE64) . '" width="40" height="40" alt="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_ALT_MENU') . '" title="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_TITLE_MENU') . '"></div><div id="crnrstn_interact_ui_primary_nav_img_shell_menu_glass_case" class="crnrstn_interact_ui_primary_nav_glass_case" onmouseover="oCRNRSTN_JS.crnrstn_interact_ui_ux(\'onmouseover\', this);" onmouseout="oCRNRSTN_JS.crnrstn_interact_ui_ux(\'onmouseout\', this);" onmousedown="oCRNRSTN_JS.crnrstn_interact_ui_ux(\'onmousedown\', this);" onmouseup="oCRNRSTN_JS.crnrstn_interact_ui_ux(\'onmouseup\', this);"><img src="' . $this->oCRNRSTN->return_creative('TRANSPARENT_1X1', CRNRSTN_UI_IMG_BASE64) . '" width="40" height="40" alt="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_ALT_MENU') . '" title="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_TITLE_MENU') . '"></div></div><div id="crnrstn_interact_ui_primary_nav_close_x" class="crnrstn_interact_ui_primary_navgroup_lnk_border"><div id="crnrstn_interact_ui_primary_nav_img_shell_close_x_inactive" class="crnrstn_interact_ui_primary_nav_img_shell"><img src="' . $this->oCRNRSTN->return_creative('PRIMARY_NAV_BLUE00_CLOSE_X_INACTIVE', CRNRSTN_UI_IMG_BASE64) . '" width="40" height="40" alt="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_ALT_CLOSE') . '" title="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_TITLE_CLOSE') . '"></div><div id="crnrstn_interact_ui_primary_nav_img_shell_close_x_hvr" class="crnrstn_interact_ui_primary_nav_img_shell"><img src="' . $this->oCRNRSTN->return_creative('PRIMARY_NAV_BLUE00_CLOSE_X_HOVER', CRNRSTN_UI_IMG_BASE64) . '" width="40" height="40" alt="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_ALT_CLOSE') . '" title="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_TITLE_CLOSE') . '"></div><div id="crnrstn_interact_ui_primary_nav_img_shell_close_x_click" class="crnrstn_interact_ui_primary_nav_img_shell"><img src="' . $this->oCRNRSTN->return_creative('PRIMARY_NAV_BLUE00_CLOSE_X_CLICK', CRNRSTN_UI_IMG_BASE64) . '" width="40" height="40" alt="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_ALT_CLOSE') . '" title="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_TITLE_CLOSE') . '"></div><div id="crnrstn_interact_ui_primary_nav_img_shell_close_x" class="crnrstn_interact_ui_primary_nav_img_shell crnrstn_interact_ui_active"><img src="' . $this->oCRNRSTN->return_creative('PRIMARY_NAV_BLUE00_CLOSE_X', CRNRSTN_UI_IMG_BASE64) . '" width="40" height="40" alt="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_ALT_CLOSE') . '" title="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_TITLE_CLOSE') . '"></div><div id="crnrstn_interact_ui_primary_nav_img_shell_close_x_glass_case" class="crnrstn_interact_ui_primary_nav_glass_case" onmouseover="oCRNRSTN_JS.crnrstn_interact_ui_ux(\'onmouseover\', this);" onmouseout="oCRNRSTN_JS.crnrstn_interact_ui_ux(\'onmouseout\', this);" onmousedown="oCRNRSTN_JS.crnrstn_interact_ui_ux(\'onmousedown\', this);" onmouseup="oCRNRSTN_JS.crnrstn_interact_ui_ux(\'onmouseup\', this);"><img src="' . $this->oCRNRSTN->return_creative('TRANSPARENT_1X1', CRNRSTN_UI_IMG_BASE64) . '" width="40" height="40" alt="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_ALT_CLOSE') . '" title="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_TITLE_CLOSE') . '"></div></div><div id="crnrstn_interact_ui_primary_nav_fs_expand" class="crnrstn_interact_ui_primary_navgroup_lnk_border"><div id="crnrstn_interact_ui_primary_nav_img_shell_fs_expand_inactive" class="crnrstn_interact_ui_primary_nav_img_shell"><img src="' . $this->oCRNRSTN->return_creative('PRIMARY_NAV_BLUE00_FULLSCREEN_EXPAND_INACTIVE', CRNRSTN_UI_IMG_BASE64) . '" width="40" height="40" alt="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_ALT_FULLSCREEN') . '" title="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_TITLE_FULLSCREEN') . '"></div><div id="crnrstn_interact_ui_primary_nav_img_shell_fs_expand_hvr" class="crnrstn_interact_ui_primary_nav_img_shell"><img src="' . $this->oCRNRSTN->return_creative('PRIMARY_NAV_BLUE00_FULLSCREEN_EXPAND_HOVER', CRNRSTN_UI_IMG_BASE64) . '" width="40" height="40" alt="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_ALT_FULLSCREEN') . '" title="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_TITLE_FULLSCREEN') . '"></div><div id="crnrstn_interact_ui_primary_nav_img_shell_fs_expand_click" class="crnrstn_interact_ui_primary_nav_img_shell"><img src="' . $this->oCRNRSTN->return_creative('PRIMARY_NAV_BLUE00_FULLSCREEN_EXPAND_CLICK', CRNRSTN_UI_IMG_BASE64) . '" width="40" height="40" alt="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_ALT_FULLSCREEN') . '" title="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_TITLE_FULLSCREEN') . '"></div><div id="crnrstn_interact_ui_primary_nav_img_shell_fs_expand" class="crnrstn_interact_ui_primary_nav_img_shell crnrstn_interact_ui_active"><img src="' . $this->oCRNRSTN->return_creative('PRIMARY_NAV_BLUE00_FULLSCREEN_EXPAND', CRNRSTN_UI_IMG_BASE64) . '" width="40" height="40" alt="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_ALT_FULLSCREEN') . '" title="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_TITLE_FULLSCREEN') . '"></div><div id="crnrstn_interact_ui_primary_nav_img_shell_fs_expand_glass_case" class="crnrstn_interact_ui_primary_nav_glass_case" onmouseover="oCRNRSTN_JS.crnrstn_interact_ui_ux(\'onmouseover\', this);" onmouseout="oCRNRSTN_JS.crnrstn_interact_ui_ux(\'onmouseout\', this);" onmousedown="oCRNRSTN_JS.crnrstn_interact_ui_ux(\'onmousedown\', this);" onmouseup="oCRNRSTN_JS.crnrstn_interact_ui_ux(\'onmouseup\', this);"><img src="' . $this->oCRNRSTN->return_creative('TRANSPARENT_1X1', CRNRSTN_UI_IMG_BASE64) . '" width="40" height="40" alt="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_ALT_FULLSCREEN') . '" title="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_TITLE_FULLSCREEN') . '"></div></div><div id="crnrstn_interact_ui_primary_nav_minimize" class="crnrstn_interact_ui_primary_navgroup_lnk_border"><div id="crnrstn_interact_ui_primary_nav_img_shell_minimize_inactive" class="crnrstn_interact_ui_primary_nav_img_shell"><img src="' . $this->oCRNRSTN->return_creative('PRIMARY_NAV_BLUE00_MINIMIZE_INACTIVE', CRNRSTN_UI_IMG_BASE64) . '" width="40" height="40" alt="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_ALT_MINIMIZE') . '" title="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_TITLE_MINIMIZE') . '"></div><div id="crnrstn_interact_ui_primary_nav_img_shell_minimize_hvr" class="crnrstn_interact_ui_primary_nav_img_shell"><img src="' . $this->oCRNRSTN->return_creative('PRIMARY_NAV_BLUE00_MINIMIZE_HOVER', CRNRSTN_UI_IMG_BASE64) . '" width="40" height="40" alt="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_ALT_MINIMIZE') . '" title="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_TITLE_MINIMIZE') . '"></div><div id="crnrstn_interact_ui_primary_nav_img_shell_minimize_click" class="crnrstn_interact_ui_primary_nav_img_shell"><img src="' . $this->oCRNRSTN->return_creative('PRIMARY_NAV_BLUE00_MINIMIZE_CLICK', CRNRSTN_UI_IMG_BASE64) . '" width="40" height="40" alt="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_ALT_MINIMIZE') . '" title="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_TITLE_MINIMIZE') . '"></div><div id="crnrstn_interact_ui_primary_nav_img_shell_minimize" class="crnrstn_interact_ui_primary_nav_img_shell"><img src="' . $this->oCRNRSTN->return_creative('PRIMARY_NAV_BLUE00_MINIMIZE', CRNRSTN_UI_IMG_BASE64) . '" width="40" height="40" alt="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_ALT_MINIMIZE') . '" title="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_TITLE_MINIMIZE') . '"></div><div id="crnrstn_interact_ui_primary_nav_img_shell_minimize_fivedev_sm" class="crnrstn_interact_ui_primary_nav_img_shell crnrstn_interact_ui_active"><img src="' . $this->oCRNRSTN->return_creative('PRIMARY_NAV_BLUE00_MINIMIZE_FIVEDEV_SMALL', CRNRSTN_UI_IMG_BASE64) . '" width="40" height="40" alt="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_ALT_FIVEDEV') . '" title="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_TITLE_FIVEDEV') . '"></div><div id="crnrstn_interact_ui_primary_nav_img_shell_minimize_glass_case" class="crnrstn_interact_ui_primary_nav_glass_case" onmouseover="oCRNRSTN_JS.crnrstn_interact_ui_ux(\'onmouseover\', this);" onmouseout="oCRNRSTN_JS.crnrstn_interact_ui_ux(\'onmouseout\', this);" onmousedown="oCRNRSTN_JS.crnrstn_interact_ui_ux(\'onmousedown\', this);" onmouseup="oCRNRSTN_JS.crnrstn_interact_ui_ux(\'onmouseup\', this);"><img src="' . $this->oCRNRSTN->return_creative('TRANSPARENT_1X1', CRNRSTN_UI_IMG_BASE64) . '" width="40" height="40" alt="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_ALT_FIVEDEV') . '" title="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_TITLE_FIVEDEV') . '"></div></div></div><div class="crnrstn_cb"></div></div><div class="crnrstn_cb"></div><div style="position:relative;"><div style="position:absolute; z-index:68; margin: 2px 0 0 16px; border: 1px solid #FFF;"><div id="crnrstn_interact_ui_bg_solid" class="crnrstn_interact_ui_bg_solid" onclick="oCRNRSTN_JS.sign_in_transition_via_micro_expansion();">' . $this->oCRNRSTN->return_creative('MESSAGE_CONVERSATION_BUBBLE_MICRO_THUMB_BLUE00', CRNRSTN_UI_IMG_HTML_WRAPPED) . '<div class="crnrstn_cb"></div></div></div><div class="crnrstn_cb"></div></div><div id="crnrstn_interact_ui_content_wrapper" class="crnrstn_interact_ui_content_wrapper"><div id="crnrstn_interact_ui_signin_frm_username" class="crnrstn_interact_ui_signin_frm_lbl">' . $this->oCRNRSTN->multi_lang_content_return('FORM_LABEL_USERNAME') . '</div><div class="crnrstn_cb_5"></div><input type="text" name="username" value=""><div class="crnrstn_cb_15"></div><div id="crnrstn_interact_ui_signin_frm_password" class="crnrstn_interact_ui_signin_frm_lbl">' . $this->oCRNRSTN->multi_lang_content_return('FORM_LABEL_PASSWORD_OPTIONAL') . '</div><div class="crnrstn_cb_5"></div><input type="password" name="password" value=""><div class="crnrstn_cb_10"></div><div class="crnrstn_interact_ui_signin_frm_chkbx_eula"><input type="checkbox" style="width: 20px;" name="crnrstn_signin_chkbx_eula_accept" value="eula_i_agree"></div><div class="crnrstn_interact_ui_signin_frm_lbl_eula"><a href="#">' . $this->oCRNRSTN->multi_lang_content_return('FORM_LNK_TXT_EULA') . '</a></div><div class="crnrstn_cb_10"></div><div class="crnrstn_interact_ui_frm_submit" onclick="oCRNRSTN_JS.sign_in_form_submit_via_micro_expansion();"><div id="crnrstn_interact_ui_signin_frm_btn_submit" class="crnrstn_interact_ui_signin_frm_btn_submit">' . $this->oCRNRSTN->multi_lang_content_return('FORM_BUTTON_TEXT_CONNECT') . '</div></div></div></div></div>';

        }else{

            $tmp_html_out = '<div id="crnrstn_interact_ui_wrapper" class="crnrstn_interact_ui_wrapper">
    <div class="crnrstn_interact_ui">

        <div id="crnrstn_interact_ui_bg_border" class="crnrstn_interact_ui_bg_border"></div>

        <div id="crnrstn_interact_ui_bg_border_edge" class="crnrstn_interact_ui_bg_border_edge" style="border: 1px solid #FFF;"></div>

        <div style="position:relative; height:106px;">

            <div id="crnrstn_interact_ui_primary_navgroup_wrapper" class="crnrstn_interact_ui_primary_navgroup_wrapper">

                <div id="crnrstn_interact_ui_primary_nav_menu" class="crnrstn_interact_ui_primary_navgroup_lnk_border">

                    <div id="crnrstn_interact_ui_primary_nav_img_shell_menu_inactive" class="crnrstn_interact_ui_primary_nav_img_shell"><img src="' . $this->oCRNRSTN->return_creative('PRIMARY_NAV_BLUE00_MENU_INACTIVE', CRNRSTN_UI_IMG_BASE64) . '" width="40" height="40" alt="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_ALT_MENU') . '" title="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_TITLE_MENU') . '"></div>
                    <div id="crnrstn_interact_ui_primary_nav_img_shell_menu_hvr" class="crnrstn_interact_ui_primary_nav_img_shell"><img src="' . $this->oCRNRSTN->return_creative('PRIMARY_NAV_BLUE00_MENU_HOVER', CRNRSTN_UI_IMG_BASE64) . '" width="40" height="40" alt="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_ALT_MENU') . '" title="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_TITLE_MENU') . '"></div>
                    <div id="crnrstn_interact_ui_primary_nav_img_shell_menu_click" class="crnrstn_interact_ui_primary_nav_img_shell"><img src="' . $this->oCRNRSTN->return_creative('PRIMARY_NAV_BLUE00_MENU_CLICK', CRNRSTN_UI_IMG_BASE64) . '" width="40" height="40" alt="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_ALT_MENU') . '" title="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_TITLE_MENU') . '"></div>
                    <div id="crnrstn_interact_ui_primary_nav_img_shell_menu" class="crnrstn_interact_ui_primary_nav_img_shell crnrstn_interact_ui_active"><img src="' . $this->oCRNRSTN->return_creative('PRIMARY_NAV_BLUE00_MENU', CRNRSTN_UI_IMG_BASE64) . '" width="40" height="40" alt="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_ALT_MENU') . '" title="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_TITLE_MENU') . '"></div>
                    <div id="crnrstn_interact_ui_primary_nav_img_shell_menu_glass_case" class="crnrstn_interact_ui_primary_nav_glass_case" onmouseover="oCRNRSTN_JS.crnrstn_interact_ui_ux(\'onmouseover\', this);" onmouseout="oCRNRSTN_JS.crnrstn_interact_ui_ux(\'onmouseout\', this);" onmousedown="oCRNRSTN_JS.crnrstn_interact_ui_ux(\'onmousedown\', this);" onmouseup="oCRNRSTN_JS.crnrstn_interact_ui_ux(\'onmouseup\', this);"><img src="' . $this->oCRNRSTN->return_creative('TRANSPARENT_1X1', CRNRSTN_UI_IMG_BASE64) . '" width="40" height="40" alt="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_ALT_MENU') . '" title="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_TITLE_MENU') . '"></div>

                </div>

                <div id="crnrstn_interact_ui_primary_nav_close_x" class="crnrstn_interact_ui_primary_navgroup_lnk_border">

                    <div id="crnrstn_interact_ui_primary_nav_img_shell_close_x_inactive" class="crnrstn_interact_ui_primary_nav_img_shell"><img src="' . $this->oCRNRSTN->return_creative('PRIMARY_NAV_BLUE00_CLOSE_X_INACTIVE', CRNRSTN_UI_IMG_BASE64) . '" width="40" height="40" alt="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_ALT_CLOSE') . '" title="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_TITLE_CLOSE') . '"></div>
                    <div id="crnrstn_interact_ui_primary_nav_img_shell_close_x_hvr" class="crnrstn_interact_ui_primary_nav_img_shell"><img src="' . $this->oCRNRSTN->return_creative('PRIMARY_NAV_BLUE00_CLOSE_X_HOVER', CRNRSTN_UI_IMG_BASE64) . '" width="40" height="40" alt="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_ALT_CLOSE') . '" title="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_TITLE_CLOSE') . '"></div>
                    <div id="crnrstn_interact_ui_primary_nav_img_shell_close_x_click" class="crnrstn_interact_ui_primary_nav_img_shell"><img src="' . $this->oCRNRSTN->return_creative('PRIMARY_NAV_BLUE00_CLOSE_X_CLICK', CRNRSTN_UI_IMG_BASE64) . '" width="40" height="40" alt="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_ALT_CLOSE') . '" title="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_TITLE_CLOSE') . '"></div>
                    <div id="crnrstn_interact_ui_primary_nav_img_shell_close_x" class="crnrstn_interact_ui_primary_nav_img_shell crnrstn_interact_ui_active"><img src="' . $this->oCRNRSTN->return_creative('PRIMARY_NAV_BLUE00_CLOSE_X', CRNRSTN_UI_IMG_BASE64) . '" width="40" height="40" alt="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_ALT_CLOSE') . '" title="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_TITLE_CLOSE') . '"></div>
                    <div id="crnrstn_interact_ui_primary_nav_img_shell_close_x_glass_case" class="crnrstn_interact_ui_primary_nav_glass_case" onmouseover="oCRNRSTN_JS.crnrstn_interact_ui_ux(\'onmouseover\', this);" onmouseout="oCRNRSTN_JS.crnrstn_interact_ui_ux(\'onmouseout\', this);" onmousedown="oCRNRSTN_JS.crnrstn_interact_ui_ux(\'onmousedown\', this);" onmouseup="oCRNRSTN_JS.crnrstn_interact_ui_ux(\'onmouseup\', this);"><img src="' . $this->oCRNRSTN->return_creative('TRANSPARENT_1X1', CRNRSTN_UI_IMG_BASE64) . '" width="40" height="40" alt="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_ALT_CLOSE') . '" title="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_TITLE_CLOSE') . '"></div>

                </div>

                <div id="crnrstn_interact_ui_primary_nav_fs_expand" class="crnrstn_interact_ui_primary_navgroup_lnk_border">

                    <div id="crnrstn_interact_ui_primary_nav_img_shell_fs_expand_inactive" class="crnrstn_interact_ui_primary_nav_img_shell"><img src="' . $this->oCRNRSTN->return_creative('PRIMARY_NAV_BLUE00_FULLSCREEN_EXPAND_INACTIVE', CRNRSTN_UI_IMG_BASE64) . '" width="40" height="40" alt="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_ALT_FULLSCREEN') . '" title="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_TITLE_FULLSCREEN') . '"></div>
                    <div id="crnrstn_interact_ui_primary_nav_img_shell_fs_expand_hvr" class="crnrstn_interact_ui_primary_nav_img_shell"><img src="' . $this->oCRNRSTN->return_creative('PRIMARY_NAV_BLUE00_FULLSCREEN_EXPAND_HOVER', CRNRSTN_UI_IMG_BASE64) . '" width="40" height="40" alt="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_ALT_FULLSCREEN') . '" title="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_TITLE_FULLSCREEN') . '"></div>
                    <div id="crnrstn_interact_ui_primary_nav_img_shell_fs_expand_click" class="crnrstn_interact_ui_primary_nav_img_shell"><img src="' . $this->oCRNRSTN->return_creative('PRIMARY_NAV_BLUE00_FULLSCREEN_EXPAND_CLICK', CRNRSTN_UI_IMG_BASE64) . '" width="40" height="40" alt="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_ALT_FULLSCREEN') . '" title="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_TITLE_FULLSCREEN') . '"></div>
                    <div id="crnrstn_interact_ui_primary_nav_img_shell_fs_expand" class="crnrstn_interact_ui_primary_nav_img_shell crnrstn_interact_ui_active"><img src="' . $this->oCRNRSTN->return_creative('PRIMARY_NAV_BLUE00_FULLSCREEN_EXPAND', CRNRSTN_UI_IMG_BASE64) . '" width="40" height="40" alt="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_ALT_FULLSCREEN') . '" title="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_TITLE_FULLSCREEN') . '"></div>
                    <div id="crnrstn_interact_ui_primary_nav_img_shell_fs_expand_glass_case" class="crnrstn_interact_ui_primary_nav_glass_case" onmouseover="oCRNRSTN_JS.crnrstn_interact_ui_ux(\'onmouseover\', this);" onmouseout="oCRNRSTN_JS.crnrstn_interact_ui_ux(\'onmouseout\', this);" onmousedown="oCRNRSTN_JS.crnrstn_interact_ui_ux(\'onmousedown\', this);" onmouseup="oCRNRSTN_JS.crnrstn_interact_ui_ux(\'onmouseup\', this);"><img src="' . $this->oCRNRSTN->return_creative('TRANSPARENT_1X1', CRNRSTN_UI_IMG_BASE64) . '" width="40" height="40" alt="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_ALT_FULLSCREEN') . '" title="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_TITLE_FULLSCREEN') . '"></div>

                </div>

                <div id="crnrstn_interact_ui_primary_nav_minimize" class="crnrstn_interact_ui_primary_navgroup_lnk_border">

                    <div id="crnrstn_interact_ui_primary_nav_img_shell_minimize_inactive" class="crnrstn_interact_ui_primary_nav_img_shell"><img src="' . $this->oCRNRSTN->return_creative('PRIMARY_NAV_BLUE00_MINIMIZE_INACTIVE', CRNRSTN_UI_IMG_BASE64) . '" width="40" height="40" alt="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_ALT_MINIMIZE') . '" title="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_TITLE_MINIMIZE') . '"></div>
                    <div id="crnrstn_interact_ui_primary_nav_img_shell_minimize_hvr" class="crnrstn_interact_ui_primary_nav_img_shell"><img src="' . $this->oCRNRSTN->return_creative('PRIMARY_NAV_BLUE00_MINIMIZE_HOVER', CRNRSTN_UI_IMG_BASE64) . '" width="40" height="40" alt="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_ALT_MINIMIZE') . '" title="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_TITLE_MINIMIZE') . '"></div>
                    <div id="crnrstn_interact_ui_primary_nav_img_shell_minimize_click" class="crnrstn_interact_ui_primary_nav_img_shell"><img src="' . $this->oCRNRSTN->return_creative('PRIMARY_NAV_BLUE00_MINIMIZE_CLICK', CRNRSTN_UI_IMG_BASE64) . '" width="40" height="40" alt="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_ALT_MINIMIZE') . '" title="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_TITLE_MINIMIZE') . '"></div>
                    <div id="crnrstn_interact_ui_primary_nav_img_shell_minimize" class="crnrstn_interact_ui_primary_nav_img_shell"><img src="' . $this->oCRNRSTN->return_creative('PRIMARY_NAV_BLUE00_MINIMIZE', CRNRSTN_UI_IMG_BASE64) . '" width="40" height="40" alt="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_ALT_MINIMIZE') . '" title="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_TITLE_MINIMIZE') . '"></div>
                    <div id="crnrstn_interact_ui_primary_nav_img_shell_minimize_fivedev_sm" class="crnrstn_interact_ui_primary_nav_img_shell crnrstn_interact_ui_active"><img src="' . $this->oCRNRSTN->return_creative('PRIMARY_NAV_BLUE00_MINIMIZE_FIVEDEV_SMALL', CRNRSTN_UI_IMG_BASE64) . '" width="40" height="40" alt="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_ALT_FIVEDEV') . '" title="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_TITLE_FIVEDEV') . '"></div>
                    <div id="crnrstn_interact_ui_primary_nav_img_shell_minimize_glass_case" class="crnrstn_interact_ui_primary_nav_glass_case" onmouseover="oCRNRSTN_JS.crnrstn_interact_ui_ux(\'onmouseover\', this);" onmouseout="oCRNRSTN_JS.crnrstn_interact_ui_ux(\'onmouseout\', this);" onmousedown="oCRNRSTN_JS.crnrstn_interact_ui_ux(\'onmousedown\', this);" onmouseup="oCRNRSTN_JS.crnrstn_interact_ui_ux(\'onmouseup\', this);"><img src="' . $this->oCRNRSTN->return_creative('TRANSPARENT_1X1', CRNRSTN_UI_IMG_BASE64) . '" width="40" height="40" alt="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_ALT_FIVEDEV') . '" title="' . $this->oCRNRSTN->multi_lang_content_return('UI_PRIMARY_NAV_TITLE_FIVEDEV') . '"></div>

                </div>

            </div>
            <div class="crnrstn_cb"></div>
        </div>

        <div class="crnrstn_cb"></div>

        <div style="position:relative;">
            <div style="position:absolute; z-index:68; margin: 2px 0 0 16px; border: 1px solid #FFF;">
                <div id="crnrstn_interact_ui_bg_solid" class="crnrstn_interact_ui_bg_solid" onclick="oCRNRSTN_JS.sign_in_transition_via_micro_expansion();">
                    ' . $this->oCRNRSTN->return_creative('MESSAGE_CONVERSATION_BUBBLE_MICRO_THUMB_BLUE00', CRNRSTN_UI_IMG_HTML_WRAPPED) . '
                    <div class="crnrstn_cb"></div>
                </div>
            </div>
            <div class="crnrstn_cb"></div>

        </div>

        <div id="crnrstn_interact_ui_content_wrapper" class="crnrstn_interact_ui_content_wrapper">
            <div id="crnrstn_interact_ui_signin_frm_username" class="crnrstn_interact_ui_signin_frm_lbl">' . $this->oCRNRSTN->multi_lang_content_return('FORM_LABEL_USERNAME') . '</div>
            <div class="crnrstn_cb_5"></div>
            <input type="text" name="username" value="">
            <div class="crnrstn_cb_15"></div>
            <div id="crnrstn_interact_ui_signin_frm_password" class="crnrstn_interact_ui_signin_frm_lbl">' . $this->oCRNRSTN->multi_lang_content_return('FORM_LABEL_PASSWORD_OPTIONAL') . '</div>
            <div class="crnrstn_cb_5"></div>
            <input type="password" name="password" value="">
            <div class="crnrstn_cb_10"></div>

            <div class="crnrstn_interact_ui_signin_frm_chkbx_eula"><input type="checkbox" style="width: 20px;" name="crnrstn_signin_chkbx_eula_accept" value="eula_i_agree"></div>
            <div class="crnrstn_interact_ui_signin_frm_lbl_eula"><a href="#">' . $this->oCRNRSTN->multi_lang_content_return('FORM_LNK_TXT_EULA') . '</a></div>

            <div class="crnrstn_cb_10"></div>

            <div class="crnrstn_interact_ui_frm_submit" onclick="oCRNRSTN_JS.sign_in_form_submit_via_micro_expansion();">
                <div id="crnrstn_interact_ui_signin_frm_btn_submit" class="crnrstn_interact_ui_signin_frm_btn_submit">' . $this->oCRNRSTN->multi_lang_content_return('FORM_BUTTON_TEXT_CONNECT') . '</div>
            </div>
        </div>
    </div>
</div>
';

        }


        return $tmp_html_out;

    }

    public function out_ui_module_html_system_search(){

        $tmp_html_out = '<div style="padding: 20px;"><h1>' . __METHOD__ . '</h1></div>';
        //error_log(__LINE__ . ' ui html mgr [' . $tmp_html_out . '].');

        return $tmp_html_out;

    }

    public function out_ui_html_doc_documentation(){

        $tmp_str = '';

        $filepath = '/_crnrstn/ui/docs/documentation/index.php';

        include(CRNRSTN_ROOT . $filepath);

        return $tmp_str;

    }

    public function out_ui_html_doc_mit_license(){

        $tmp_str = '';

        $filepath = '/_crnrstn/ui/docs/pages/mit_license.php';

        include(CRNRSTN_ROOT . $filepath);

        return $tmp_str;

    }

	public function out_ui_html_doc_signin(){

        $tmp_str = '';

        $filepath = '/_crnrstn/ui/docs/pages/signin.php';

        include(CRNRSTN_ROOT . $filepath);

        return $tmp_str;

    }

    public function out_ui_html_doc_css_validator(){

        $tmp_str = '';

        $filepath = '/_crnrstn/ui/docs/pages/css_validator.php';

        include(CRNRSTN_ROOT . $filepath);

        return $tmp_str;

    }

    public function out_ui_html_doc_css_validator_profile(){

        $tmp_str = '';

        $filepath = '/_crnrstn/ui/docs/pages/css_validator_profile.php';

        include(CRNRSTN_ROOT . $filepath);

        return $tmp_str;

    }

    public function out_ui_html_doc_dashboard(){

        $tmp_str = '';

        $filepath = '/_crnrstn/ui/docs/pages/dashboard.php';

        include(CRNRSTN_ROOT . $filepath);

        return $tmp_str;

    }

    public function out_ui_html_doc_config_wordpress(){

        $tmp_str = '';

        $filepath = '/_crnrstn/ui/docs/pages/config_wordpress.php';

        include(CRNRSTN_ROOT . $filepath);

        return $tmp_str;

    }

	public function __destruct() {

	}
}