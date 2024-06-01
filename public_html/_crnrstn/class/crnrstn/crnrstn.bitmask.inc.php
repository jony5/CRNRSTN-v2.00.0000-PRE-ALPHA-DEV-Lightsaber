<?php
/**
* @package CRNRSTN

// J5
// Code is Poetry */
# # C # R # N # R # S # T # N # : : # # # #
#
#        CRNRSTN :: An open source PHP class library supporting enterprise application development that is framed within
#                   the context of mature/rigid RTM protocols.
#        VERSION :: 2.00.0000 PRE-ALPHA-DEV (Lightsaber)
#      TIMESTAMP :: Tuesday, November 28, 2023 @ 16:20:00.065620.
#  DATE (v1.0.0) :: July 4, 2018 - Happy Independence Day from my dog and I to you...wherever and whenever you are.
#         AUTHOR :: Jonathan '5' Harris, CEO, CTO, Lead Full Stack Developer, jharris@eVifweb.com, eVifweb@gmail.com.
#            URI :: https://crnrstn.jony5.com
#       OVERVIEW :: CRNRSTN :: An Open Source PHP Class Library that stands on top of a robust web services oriented
#                   architecture to both facilitate, augment, and enhance (with stability) the operations of a code base
#                   for a web application across multiple hosting environments.
#
#                   CRNRSTN :: is powered by eVifweb; CRNRSTN :: is powered by eCRM Strategy and Execution,
#                   Web Design & Development, and Only The Best Coffee.
#
#                   Copyright (c) 2012-2024 :: eVifweb development :: All Rights Reserved.
#    DESCRIPTION :: CRNRSTN :: is an open source PHP class library that will facilitate and spread (via SOAP services)
#                   operations of a web application across multiple servers or environments (e.g. localhost, stage,
#                   preprod, and production). With this tool, data and functionality possessing characteristics that
#                   inherently create distinctions between one environment and another can all be managed through one
#                   framework for an entire application. IP address restrictions, error logging profiles, and database
#                   authentication credentials are a few areas within an application's architecture where
#                   CRNRSTN :: was designed to excel.
#
#                   Once CRNRSTN :: has been configured to support all of a web application's running servers, one can
#                   seamlessly RTM the codebase of the web site without having to modify the configuration to account
#                   for any unique and environmentally specific parameters. Receive the benefit of a robust and polished
#                   framework that will bubble up logs from exception notifications to any output channel (email, hidden
#                   HTML comment, native default,...etc.) of one's own choosing.
#
#                   Stand on top of the CRNRSTN :: SOAP Services Layer to, for example, organize and strengthen the
#                   communications architecture of any web application. By supporting many-to-one proxy messaging
#                   relationships between slaves and a master "communications server", CRNRSTN :: can streamline and
#                   simplify the management of web application communications; one can configure everything from SMTP
#                   credentials to the character count for line wrapping in the text versions of multi-part HTML email.
#
#                   This is the "King's Highway" for sending email communications.
#        LICENSE :: MIT
#                   Permission is hereby granted, free of charge, to any person obtaining
#                   a copy of this software and associated documentation files (the
#                   "Software"), to deal in the Software without restriction, including
#                   without limitation the rights to use, copy, modify, merge, publish,
#                   distribute, sublicense, and/or sell copies of the Software, and to
#                   permit persons to whom the Software is furnished to do so, subject to
#                   the following conditions:
#
#                   The above copyright notice and this permission notice shall be
#                   included in all copies or substantial portions of the Software.
#
#                   THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
#                   EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
#                   MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.
#                   IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY
#                   CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT,
#                   TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE
#                   SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
#
# # C # R # N # R # S # T # N # : : # # # #
#
#  CLASS :: crnrstn_bitmask
#  VERSION :: 1.0.0
#  DATE :: Friday, October 27, 2023 @ 0518 hrs.
#  AUTHOR :: icy at digitalitcc dot com
#  URI :: https://www.php.net/manual/en/language.operators.bitwise.php#50299
#  DESCRIPTION :: Infinite* bits and bit handling in general. Perceivably, the only
#                 limit to the bitmask class in storing bits would be the maximum
#                 limit of the index number, on 32 bit integer systems 2^31 - 1, so
#                 2^31 * 31 - 1 = 66571993087 bits, assuming floats are 64 bit
#                 or something.
#
#                 I'm sure that's enough enough bits for anything...I hope :D.
#
#                 *Not infinite, sorry.
#
#                 Say... you really want to have say... more than 31 bits available
#                 to you in your happy bitmask. And you don't want to use floats.
#                 So, one solution would to have an array of bitmasks, that are
#                 accessed through some kind of interface.
#
#                 Here is my solution for this: A class to store an array of
#                 integers being the bitmasks. It can hold up to 66571993087 bits,
#                 and frees up unused bitmasks when there are no bits being stored
#                 in them.
#
#  LICENSE :: MIT | https://crnrstn.jony5.com/licensing/
#
class crnrstn_bitmask {

    protected $bitmask = array();

    public function set($bit) // Set some bit
    {
        $key = (int) ($bit / CRNRSTN_INTEGER_LENGTH);
        $bit = (int) fmod($bit,CRNRSTN_INTEGER_LENGTH);
        @$this->bitmask[$key] |= 1 << $bit;
    }

    public function remove($bit) // Remove some bit
    {
        $key = (int) ($bit / CRNRSTN_INTEGER_LENGTH);
        $bit = (int) fmod($bit,CRNRSTN_INTEGER_LENGTH);
        $this->bitmask[$key] &= ~ (1 << $bit);
        if(!$this->bitmask[$key])
            unset($this->bitmask[$key]);
    }

    public function toggle($bit) // Toggle some bit
    {
        $key = (int) ($bit / CRNRSTN_INTEGER_LENGTH);
        $bit = (int) fmod($bit,CRNRSTN_INTEGER_LENGTH);
        @$this->bitmask[$key] ^= 1 << $bit;
        if(!$this->bitmask[$key])
            unset($this->bitmask[$key]);
    }

    public function read($bit) // Read some bit
    {
        $key = (int) ($bit / CRNRSTN_INTEGER_LENGTH);
        $bit = (int) fmod($bit,CRNRSTN_INTEGER_LENGTH);
        return @$this->bitmask[$key] & (1 << $bit);
    }

    public function stringin($string) // Read a string of bits that can be up to the maximum amount of bits long.
    {
        $this->bitmask = array();
        $array = str_split( strrev($string), CRNRSTN_INTEGER_LENGTH );
        foreach( $array as $key => $value )
        {
            if($value = bindec(strrev($value)))
                $this->bitmask[$key] = $value;
        }
    }

    public function stringout() // Print out a string of your nice little bits
    {
        $string = "";

        $keys = array_keys($this->bitmask);

        sort($keys, SORT_NUMERIC);

        for($i = array_pop($keys); $i >= 0; $i--){

            if(isset($this->bitmask[$i])){

                $string .= sprintf("%0" . CRNRSTN_INTEGER_LENGTH . "b", $this->bitmask[$i]);
                //error_log(__LINE__ .' BITMASK index is set i=['.$i.'] $string=['.$string.']');

            }else{

                //error_log(__LINE__ .' BITMASK index i NOT SET i=['.$i.'] $string=['.$string.']');

            }

        }

        //return print_r(__METHOD__ .' $keys='.print_r($keys, true), true);

        return $string;

    }

    public function clear() // Purge!
    {
        $this->bitmask = array();
    }

    public function debug() // See what's going on in your bitmask array
    {
        var_dump($this->bitmask);
    }

}