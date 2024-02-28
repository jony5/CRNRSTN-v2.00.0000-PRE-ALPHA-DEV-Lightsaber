<?php
/*
// J5
// Code is Poetry */

class polar_bear_meta {

    private static $oLogger;
    private static $oEnv;
    private static $errCopy;

    public function __construct($oEnv)
    {
        try{

            //
            // INSTANTIATE LOGGER
            self::$oLogger = new crnrstn_logging();
            self::$oEnv = $oEnv;

            //
            // DEFAULT COPY IN CASE OF ERR OR EXCEPTION
            self::$errCopy = "One may click upon the right half of the image to move forward.";

            //
            // HOOOSTON...VE HAF PROBLEM!
            #throw new Exception('Hello world');

        }catch( Exception $e ) {

            //
            // SEND THIS THROUGH THE LOGGER OBJECT
            self::$oLogger->captureNotice('polar_bear_meta->__construct()', LOG_EMERG, $e->getMessage());

        }

    }

    public function returnCopy($dir_path, $dart_filename, $type){

        return $this->loadImageCopy($dir_path, $dart_filename, $type);
    }

    private function loadImageCopy($dir_path, $dart_filename, $type){

        try{

            switch($dart_filename){
                # SECTION START - FACTORY
                #http://jony5.com//common/imgs/dart/factory/20190507_143957.png
                case '20190507_143957.png':
                    $tmp_copy_caption = "After some time (Feb2017-Apr2019) and amazingly routine and troubling experiences of odd meddling with the automatic transmission's shift curve (whilst often in the immediate presence of pedestrian &quot;witnesses&quot;) for the purposes of consistently misrepresenting my state of mind whilst driving, I had to step away from the automatic transmission in my new 2017 Chevy Cruz. The un-micro-manageable transmission left me with no peace in my human spirit, the dwelling place of God. I drove to Carmax in Gastonia, NC from my home in Norcross, GA with full cash in pocket for this 2014 Dodge Dart SXT 2.4L with manual transmission. I think it was the second cheapest manual I could find; my first choice (another red Chevy Cruz in maybe Illinois) was hung up in a timely holding pattern.";
                    $tmp_copy_alt = "";
                break;
                case '20190507_144032_HDR.png':
                    $tmp_copy_caption ="The nice sales man offered a test drive, but with $22K in my 2003 Timbuk2 Dee Dog[L] messenger bag, I was not driving back to GA heavy, and I was not wasting any time. I took this photo and immediately went in for paperwork and to see the cashier in order to close out this transaction to acquire transportation for my full-time service unto the Lord whilst the vehicle was being prepared.";
                    $tmp_copy_alt = "";
                break;
                case '20190507_164258_HDR.png':
                    $tmp_copy_caption = "When I cranked the Dodge Dart SXT at this spot and setup my mobile into the UConnect bluetooth situation for music and to establish directions back to GA, it was immediately discovered by me that one speaker was blown and another damaged (front passenger = total blown; rear passenger = very faint). I was not going back inside the dealership for this; I had just handed over $22K in cash (negative equity on the Cruz doubled the cost) and had walked out. That &quot;they would never see my face again&quot; was my mantra for this whole business transaction,...and I followed through. On the drive back, fellowship with the Lord Jesus was clear about how to recover the situation with perfect peace in my mingled spirit.";
                    $tmp_copy_alt = "";
                break;
                case '20190507_173319.png':
                    $tmp_copy_caption ="As I engaged first gear in my manual transmission and exited Carmax - Gastonia, NC, the brakes were oscillating the hydraulics in what felt like a destructive way. It seemed serious, but I was not turning around; at least one &quot;Dilly Dilly&trade;&quot; was waiting for me at Hooters (photo taken from my patio table)! Please note that this was my first parking job in the Dodge Dart SXT 2.4L, and I could not figure out how to shift into reverse. After +5hrs on the road to get this car that I found on the internet, it was definitely about time for a &quot;brewsky babba-buushhkee!!!&quot;; it was not the time to ask questions about &quot;how&quot; to drive this car; that could wait! I parked in a way to make it easier for me to leave Hooters if reverse gear was busted (it was not; I was just an idiot).";
                    $tmp_copy_alt = "";
                break;
                case '20190508_101320.png':
                case '20190508_101349.png':
                    $tmp_copy_caption ="I returned home from NC to Norcross, GA around 1AM or something, and the next morning I went straight to Hayes Chrysler Dodge Jeep of Duluth, GA. I had been there years prior to see the Hellcat Challenger in person, and I was stoked about bringing this car up to OEM standard...specifically in the brakes and routine service (e.g. cabin air filter maintenance) department. Here you can clearly see that standard &quot;civilian&quot; rotors have been installed...although, I asked specifically about drilled and slotted Mopar&reg; performance rotors for maximum heat dissipation. I was given a super-slippery slope (vicious persistence to steer away and misdirect at EVERY SINGLE decision) from service that began with them trying to &quot;expert recommend&quot; that they perform only a cheap &quot;adjustment&quot;. I basically demanded that ALL brakes and rotors be replaced to OEM, and this position also prevented me from being able to grip any performance products! This grieved my spirit in a way that perfectly explains the whole trajectory of the rest of this project; my speakers were still busted at this time. Hayes Chrysler Dodge Jeep did confess that the brakes they removed from the Dodge Dart turned out to be too small for the car and also mismatched; this firmly locked in my new trajectory for rest of the project.";
                    $tmp_copy_alt = "";
                break;

                case '20190514_134248.png':
                case '20190514_204741.png':
                case '20190517_115205_HDR.png':
                    $tmp_copy_caption ="I left Hayes Chrysler Dodge Jeep and...starting with audio on that very day...immediately began work on what would soon (in 3 months) become &quot;The Polar Bear.&quot; Everything up to this point was a sunk cost...F*%$ it. To facilitate the needs of the &quot;Polar Bear&quot;, I was FORCED to purchase a Yakima roof rack and cargo box; this is because I acquired from Chavez Electronics of Norcross, GA (on Buford Highway) the biggest and most expensive top of the line sound system on the market from the folks over at JL Audio&reg;. With no space in my trunk (on account of the massive JL Audio&reg; 12&quot; sub-woofers living and breathing in there), I HAD to look to the roof for proper storage of my full size Pirelli performance spare tire plus anything else! My &quot;trunk&quot; is on the roof now. The $600 fully OEM brake service from Hayes was trash as far as I was concerned; I told Solo MotorSports (SMS) of Norcross to destroy or sell on Craigslist (brakes and rotors were NEW) everything they took off the car when the parts were upgraded to racing...F*%$ it. Just hand over the stickers, new part packaging with any factory paperwork, and my key when I close my SMS tab.";
                    $tmp_copy_alt = "";
                break;
                case '2012':
                    $tmp_copy_caption ="";
                    $tmp_copy_alt = "";
                    break;
                # SECTION START - TINT
    
                # SECTION START - AUDIO
                # https://www.youtube.com/watch?v=cG21b8Kx2DI&t=1m53s
                case '20190510_132412.png':
                    $tmp_copy_caption = 'Here I am with J5 replacing all the factory speakers (the two passenger speakers were busted before I could even &quot;fish-tail off the lot&quot; of Carmax - Gastonia, NC) and acquiring four (4) top of the line 6x9 JL Audio speakers plus installation @ Chavez Electronics of Norcross, GA on Buford Highway.';
                    $tmp_copy_alt = "";
                break;

                # SECTION START - PERFORMANCE

                # SECTION START - EXHAUST

                # SECTION START - WRAP

                # SECTION START - HOONIGAN

                # SECTION START - TRANSPARENCY

                default:
                    $tmp_copy_caption = "One may click upon the right half of the image to move forward.";
                    $tmp_copy_alt = "";
                break;

            }

            switch($type){
                case 'caption':
                    return $tmp_copy_caption;
                break;
                default:
                    return $tmp_copy_alt;
                break;

            }

        }catch( Exception $e ) {
            //
            // SEND THIS THROUGH THE LOGGER OBJECT
            self::$oLogger->captureNotice('polar_bear_meta->loadImageCopy()', LOG_EMERG, $e->getMessage());

            return self::$errCopy;
        }

    }

    public function __destruct() {

    }

}