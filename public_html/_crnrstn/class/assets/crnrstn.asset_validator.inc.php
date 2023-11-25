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
# # C # R # N # R # S # T # N # : : # # # #
#
#  CLASS :: crnrstn_asset_validator
#  VERSION :: 1.00.0000
#  DATE :: April 14, 2020 2202hrs
#  AUTHOR :: Jonathan 'J5' Harris, jharris@eVifweb.com
#  URI ::
#  DESCRIPTION ::
#  LICENSE :: MIT | http://crnrstn.evifweb.com/licensing/
#
class crnrstn_asset_validator {

    private static $asset_type;
    private static $asset_ext;
    private static $asset_mime;
    private static $auth_mime_cnt = 0;

    private static $approved_mime_ARRAY = array();

    public function __construct($type, $ext, $mime){

        self::$asset_type = $type;
        self::$asset_ext = $ext;
        self::$asset_mime = $mime;

        switch(self::$asset_type){
            case 'BRIEF':

                //
                // HOW CAN I REUSE THIS CODE THE BEST...SO I HAVE TO DO THE LEAST WORK?
                $this->add_auth_mime_type('txt','text/plain');
                $this->add_auth_mime_type('doc','application/msword');
                $this->add_auth_mime_type('docx','application/vnd.openxmlformats-officedocument.wordprocessingml.document');
                $this->add_auth_mime_type('odt','application/vnd.oasis.opendocument.text');
                $this->add_auth_mime_type('pdf','application/pdf');
                $this->add_auth_mime_type('rtf','application/rtf');
                $this->add_auth_mime_type('tex','application/x-tex');
                $this->add_auth_mime_type('wks','application/vnd.ms-works');
                $this->add_auth_mime_type('wps','application/vnd.ms-works');
                $this->add_auth_mime_type('wpd','application/vnd.wordperfect');
                $this->add_auth_mime_type('zip','application/zip');
                $this->add_auth_mime_type('zip','multipart/x-zip');
                $this->add_auth_mime_type('xls','application/vnd.ms-excel');
                $this->add_auth_mime_type('xlsx','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                $this->add_auth_mime_type('ppt','application/vnd.ms-powerpoint');
                $this->add_auth_mime_type('ods','application/vnd.oasis.opendocument.spreadsheet');
                $this->add_auth_mime_type('pps','application/vnd.ms-powerpoint');
                $this->add_auth_mime_type('ppsx','application/vnd.openxmlformats-officedocument.presentationml.slideshow');

            break;
            case 'CREATIVE':
                $this->add_auth_mime_type('jpg','image/jpeg');
                $this->add_auth_mime_type('jpeg','image/jpeg');
                $this->add_auth_mime_type('jpg2','image/jpeg');
                $this->add_auth_mime_type('gif','image/gif');
                $this->add_auth_mime_type('bmp','image/bmp');
                $this->add_auth_mime_type('bmp','image/x-windows-bmp');
                $this->add_auth_mime_type('jpe','image/jpeg');
                $this->add_auth_mime_type('tif','image/tiff');
                $this->add_auth_mime_type('tif','image/x-tiff');
                $this->add_auth_mime_type('pdf','application/pdf');
                $this->add_auth_mime_type('ico','image/x-icon');
                $this->add_auth_mime_type('mp2','video/mpeg');
                $this->add_auth_mime_type('mpa','video/mpeg');
                $this->add_auth_mime_type('mpe','video/mpeg');
                $this->add_auth_mime_type('mpeg','video/mpeg');
                $this->add_auth_mime_type('mpg','video/mpeg');
                $this->add_auth_mime_type('mpg','audio/mpeg');
                $this->add_auth_mime_type('mpv2','video/mpeg');
                $this->add_auth_mime_type('mov','video/quicktime');
                $this->add_auth_mime_type('qt','video/quicktime');
                $this->add_auth_mime_type('avi','video/x-msvideo');
                $this->add_auth_mime_type('movie','video/x-sgi-movie');
                $this->add_auth_mime_type('swf','application/x-shockwave-flash');
                $this->add_auth_mime_type('svg','image/svg+xml');
                $this->add_auth_mime_type('avi','application/x-troff-msvideo');
                $this->add_auth_mime_type('avi','video/avi');
                $this->add_auth_mime_type('avi','video/msvideo');
                $this->add_auth_mime_type('avi','video/x-msvideo');
                $this->add_auth_mime_type('avs','video/avs-video');
                $this->add_auth_mime_type('m1v','video/mpeg');
                $this->add_auth_mime_type('m2a','audio/mpeg');
                $this->add_auth_mime_type('m2v','video/mpeg');
                $this->add_auth_mime_type('m3u','audio/x-mpequrl');
                $this->add_auth_mime_type('mid','application/x-midi');
                $this->add_auth_mime_type('mid','audio/midi');
                $this->add_auth_mime_type('mid','audio/x-mid');
                $this->add_auth_mime_type('mid','audio/x-midi');
                $this->add_auth_mime_type('mid','music/crescendo');
                $this->add_auth_mime_type('mid','x-music/x-midi');
                $this->add_auth_mime_type('midi','application/x-midi');
                $this->add_auth_mime_type('midi','audio/midi');
                $this->add_auth_mime_type('midi','audio/x-mid');
                $this->add_auth_mime_type('midi','audio/x-midi');
                $this->add_auth_mime_type('midi','music/crescendo');
                $this->add_auth_mime_type('midi','x-music/x-midi');
                $this->add_auth_mime_type('mjpg','video/x-motion-jpeg');
                $this->add_auth_mime_type('mp2','audio/mpeg');
                $this->add_auth_mime_type('mp2','audio/x-mpeg');
                $this->add_auth_mime_type('mp2','video/mpeg');
                $this->add_auth_mime_type('mp2','video/x-mpeg');
                $this->add_auth_mime_type('mp2','video/x-mpeq2a');
                $this->add_auth_mime_type('mp3','audio/mpeg3');
                $this->add_auth_mime_type('mp3','audio/x-mpeg-3');
                $this->add_auth_mime_type('mp3','video/mpeg');
                $this->add_auth_mime_type('mp3','video/x-mpeg');
                $this->add_auth_mime_type('mpa','audio/mpeg');
                $this->add_auth_mime_type('mpa','video/mpeg');
                $this->add_auth_mime_type('mpe','video/mpeg');
                $this->add_auth_mime_type('mpga','audio/mpeg');
                $this->add_auth_mime_type('mv','video/x-sgi-movie');
                $this->add_auth_mime_type('pic','image/pict');
                $this->add_auth_mime_type('pict','image/pict');
                $this->add_auth_mime_type('png','image/png');
                $this->add_auth_mime_type('qif','image/x-quicktime');
                $this->add_auth_mime_type('qtc','video/x-qtc');
                $this->add_auth_mime_type('qti','image/x-quicktime');
                $this->add_auth_mime_type('qtif','image/x-quicktime');
                $this->add_auth_mime_type('ra','audio/x-pn-realaudio');
                $this->add_auth_mime_type('ra','audio/x-pn-realaudio-plugin');
                $this->add_auth_mime_type('ra','audio/x-realaudio');
                $this->add_auth_mime_type('ram','audio/x-pn-realaudio');
                $this->add_auth_mime_type('wav','audio/wav');
                $this->add_auth_mime_type('wav','audio/x-wav');
                $this->add_auth_mime_type('zip','application/zip');
                $this->add_auth_mime_type('zip','multipart/x-zip');

            break;
            case 'REPORT':
                $this->add_auth_mime_type('txt','text/plain');
                $this->add_auth_mime_type('doc','application/msword');
                $this->add_auth_mime_type('docx','application/vnd.openxmlformats-officedocument.wordprocessingml.document');
                $this->add_auth_mime_type('odt','application/vnd.oasis.opendocument.text');
                $this->add_auth_mime_type('pdf','application/pdf');
                $this->add_auth_mime_type('rtf','application/rtf');
                $this->add_auth_mime_type('tex','application/x-tex');
                $this->add_auth_mime_type('wks','application/vnd.ms-works');
                $this->add_auth_mime_type('wps','application/vnd.ms-works');
                $this->add_auth_mime_type('wpd','application/vnd.wordperfect');
                $this->add_auth_mime_type('zip','application/zip');
                $this->add_auth_mime_type('zip','multipart/x-zip');
                $this->add_auth_mime_type('xls','application/vnd.ms-excel');
                $this->add_auth_mime_type('xlsx','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                $this->add_auth_mime_type('ppt','application/vnd.ms-powerpoint');
                $this->add_auth_mime_type('ods','application/vnd.oasis.opendocument.spreadsheet');
                $this->add_auth_mime_type('pps','application/vnd.ms-powerpoint');
                $this->add_auth_mime_type('ppsx','application/vnd.openxmlformats-officedocument.presentationml.slideshow');

            break;
            case 'DELIVERABLE':
            case 'STREAM':
                $this->add_auth_mime_type('txt','text/plain');
                $this->add_auth_mime_type('doc','application/msword');
                $this->add_auth_mime_type('docx','application/vnd.openxmlformats-officedocument.wordprocessingml.document');
                $this->add_auth_mime_type('odt','application/vnd.oasis.opendocument.text');
                $this->add_auth_mime_type('pdf','application/pdf');
                $this->add_auth_mime_type('rtf','application/rtf');
                $this->add_auth_mime_type('tex','application/x-tex');
                $this->add_auth_mime_type('wks','application/vnd.ms-works');
                $this->add_auth_mime_type('wps','application/vnd.ms-works');
                $this->add_auth_mime_type('wpd','application/vnd.wordperfect');
                $this->add_auth_mime_type('xls','application/vnd.ms-excel');
                $this->add_auth_mime_type('xlsx','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                $this->add_auth_mime_type('ppt','application/vnd.ms-powerpoint');
                $this->add_auth_mime_type('ods','application/vnd.oasis.opendocument.spreadsheet');
                $this->add_auth_mime_type('pps','application/vnd.ms-powerpoint');
                $this->add_auth_mime_type('ppsx','application/vnd.openxmlformats-officedocument.presentationml.slideshow');
                $this->add_auth_mime_type('jpg','image/jpeg');
                $this->add_auth_mime_type('jpeg','image/jpeg');
                $this->add_auth_mime_type('jpg2','image/jpeg');
                $this->add_auth_mime_type('gif','image/gif');
                $this->add_auth_mime_type('bmp','image/bmp');
                $this->add_auth_mime_type('bmp','image/x-windows-bmp');
                $this->add_auth_mime_type('jpe','image/jpeg');
                $this->add_auth_mime_type('tif','image/tiff');
                $this->add_auth_mime_type('tif','image/x-tiff');
                $this->add_auth_mime_type('pdf','application/pdf');
                $this->add_auth_mime_type('ico','image/x-icon');
                $this->add_auth_mime_type('mp2','video/mpeg');
                $this->add_auth_mime_type('mpa','video/mpeg');
                $this->add_auth_mime_type('mpe','video/mpeg');
                $this->add_auth_mime_type('mpeg','video/mpeg');
                $this->add_auth_mime_type('mpg','video/mpeg');
                $this->add_auth_mime_type('mpg','audio/mpeg');
                $this->add_auth_mime_type('mpv2','video/mpeg');
                $this->add_auth_mime_type('mov','video/quicktime');
                $this->add_auth_mime_type('qt','video/quicktime');
                $this->add_auth_mime_type('avi','video/x-msvideo');
                $this->add_auth_mime_type('movie','video/x-sgi-movie');
                $this->add_auth_mime_type('swf','application/x-shockwave-flash');
                $this->add_auth_mime_type('svg','image/svg+xml');
                $this->add_auth_mime_type('avi','application/x-troff-msvideo');
                $this->add_auth_mime_type('avi','video/avi');
                $this->add_auth_mime_type('avi','video/msvideo');
                $this->add_auth_mime_type('avi','video/x-msvideo');
                $this->add_auth_mime_type('avs','video/avs-video');
                $this->add_auth_mime_type('m1v','video/mpeg');
                $this->add_auth_mime_type('m2a','audio/mpeg');
                $this->add_auth_mime_type('m2v','video/mpeg');
                $this->add_auth_mime_type('m3u','audio/x-mpequrl');
                $this->add_auth_mime_type('mid','application/x-midi');
                $this->add_auth_mime_type('mid','audio/midi');
                $this->add_auth_mime_type('mid','audio/x-mid');
                $this->add_auth_mime_type('mid','audio/x-midi');
                $this->add_auth_mime_type('mid','music/crescendo');
                $this->add_auth_mime_type('mid','x-music/x-midi');
                $this->add_auth_mime_type('midi','application/x-midi');
                $this->add_auth_mime_type('midi','audio/midi');
                $this->add_auth_mime_type('midi','audio/x-mid');
                $this->add_auth_mime_type('midi','audio/x-midi');
                $this->add_auth_mime_type('midi','music/crescendo');
                $this->add_auth_mime_type('midi','x-music/x-midi');
                $this->add_auth_mime_type('mjpg','video/x-motion-jpeg');
                $this->add_auth_mime_type('mp2','audio/mpeg');
                $this->add_auth_mime_type('mp2','audio/x-mpeg');
                $this->add_auth_mime_type('mp2','video/mpeg');
                $this->add_auth_mime_type('mp2','video/x-mpeg');
                $this->add_auth_mime_type('mp2','video/x-mpeq2a');
                $this->add_auth_mime_type('mp3','audio/mpeg3');
                $this->add_auth_mime_type('mp3','audio/x-mpeg-3');
                $this->add_auth_mime_type('mp3','video/mpeg');
                $this->add_auth_mime_type('mp3','video/x-mpeg');
                $this->add_auth_mime_type('mpa','audio/mpeg');
                $this->add_auth_mime_type('mpa','video/mpeg');
                $this->add_auth_mime_type('mpe','video/mpeg');
                $this->add_auth_mime_type('mpga','audio/mpeg');
                $this->add_auth_mime_type('mv','video/x-sgi-movie');
                $this->add_auth_mime_type('pic','image/pict');
                $this->add_auth_mime_type('pict','image/pict');
                $this->add_auth_mime_type('png','image/png');
                $this->add_auth_mime_type('qif','image/x-quicktime');
                $this->add_auth_mime_type('qtc','video/x-qtc');
                $this->add_auth_mime_type('qti','image/x-quicktime');
                $this->add_auth_mime_type('qtif','image/x-quicktime');
                $this->add_auth_mime_type('ra','audio/x-pn-realaudio');
                $this->add_auth_mime_type('ra','audio/x-pn-realaudio-plugin');
                $this->add_auth_mime_type('ra','audio/x-realaudio');
                $this->add_auth_mime_type('ram','audio/x-pn-realaudio');
                $this->add_auth_mime_type('wav','audio/wav');
                $this->add_auth_mime_type('wav','audio/x-wav');
                $this->add_auth_mime_type('zip','application/zip');
                $this->add_auth_mime_type('zip','multipart/x-zip');

            break;
            default:

            break;

        }

    }

    public function isValid(){

        $tmp_loop_size = sizeof(self::$approved_mime_ARRAY);
        for($i=0;$i<$tmp_loop_size;$i++){

            //
            // RUN THROUGH ONCE FOR MATCH
            if(isset(self::$approved_mime_ARRAY[$i][crc32(self::$asset_ext)][crc32(self::$asset_mime)])){

                return true;
            }

        }

        return false;

    }

    private function add_auth_mime_type($ext,$mime){

        //
        // ADD APPROVED MIME TYPE
        self::$approved_mime_ARRAY[self::$auth_mime_cnt][crc32($ext)][crc32($mime)] = 1;
        self::$auth_mime_cnt++;

    }

    public function __destruct() {

    }

}