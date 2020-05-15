<?php

namespace App\Modules\Stackmaps\Models;

use Illuminate\Database\Eloquent\Model;

class Sort extends Model
{

    public static function cutter_date($amask,$calla,$smask)
    {

        $pos = (strpos($smask, "DA"));
        //dd($pos);
        if($pos!=false) {
            $cdate = strpos($smask, '_IIII_DA', $pos);

            if($cdate != false)
            {
                foreach($amask as $key=>$a)
                {

                    if($key<=$cdate) {continue;}
                    if($a == '_') {break;}
                    $cutter_date[] = $calla[$key];

                }

                return implode("", $cutter_date);
            } }

        else

        {
            return 0;
        }

    }

    public static function cutter_call($amask,$calla,$smask)
    {

        foreach($amask as $key=>$a)
        {
            $pos = (strpos($smask, "DA"));
            $cdate = strpos($smask, '_IIII_DA', $pos);

            if($key>=$cdate AND $key<=$cdate+6) {continue;}
            if($a == '~') {break;}

            $cutter_call[] = $calla[$key];

        }

        return implode("", $cutter_call);

    }

    public static function isDate($string)

    {
        if(strlen($string) == 5 OR strlen($string) == 4)

        {
            if(is_numeric($string[0])
                AND
                is_numeric($string[1])
                AND
                is_numeric($string[2])
                AND
                is_numeric($string[3])
                AND
                $string[0]<3
                AND
                $string[0]>0
            )
            { $status = 1; }

            else
            { $status = 0; }
        }

        else

        { $status = 0; }



        return $status;
    }

    // Check string occurring after space and before cutter for volume number

    public static function isVnum($str)

    {
        //Explode the string into individual characters
        $star = preg_split('//', $str, -1, PREG_SPLIT_NO_EMPTY);

        $type = null;
        foreach($star as $key=>$s)

        {
            if(is_numeric($s)) {$type = "n";} else {$type = "l";}

            if($type != null AND isset($ltype) AND $type != $ltype)

            { $starr[] = "/"; }

            $starr[] = $s;

            if(is_numeric($s)) {$ltype = "n";} else {$ltype = "l";}
        }

        $string = implode("", $starr);
        $strings = explode("/", $string);

        if(is_numeric($strings[0]) AND !is_numeric($strings[1]))

        { return $string; }

        else

        { return 0; }
    }

    // Call number processing functions

    public static function leadingZeros($string)

    {
        $c = strlen($string);
        $missing = 6-$c;

        if($missing > 0) {

            for ($i=0; $i < $missing; $i++)

            {

                $zeros[] = 0;

            }
        }

        $lzeros = implode("", $zeros);

        return "$lzeros$string";

    }

    public static function dateAbbr($string)

    {
        if($string == "JAN" OR
            $string == "FEB" OR
            $string == "MAR" OR
            $string == "APR" OR
            $string == "MAY" OR
            $string == "JUNE" OR
            $string == "JUN" OR
            $string == "JULY" OR
            $string == "JUL" OR
            $string == "AUG" OR
            $string == "SEPT" OR
            $string == "SEP" OR
            $string == "OCT" OR
            $string == "NOV" OR
            $string == "DEC")
        {
            if($string == "JAN") {return "01";}
            if($string == "FEB") {return "02";}
            if($string == "MAR") {return "03";}
            if($string == "APR") {return "04";}
            if($string == "MAY") {return "05";}
            if($string == "JUNE") {return "06";}
            if($string == "JUN") {return "06";}
            if($string == "JULY") {return "07";}
            if($string == "JUL") {return "07";}
            if($string == "AUG") {return "08";}
            if($string == "SEPT") {return "09";}
            if($string == "SEP") {return "09";}
            if($string == "OCT") {return "10";}
            if($string == "NOV") {return "11";}
            if($string == "DEC") {return "12";}
        }
        else
        { return 0; }

    }


    public static function pMask($amask,$smask,$callno,$calla)
    {

        $str = $smask;

        $pos = (strpos($str, "DA")); // Gives position of decimal in cutter counting from 0
        //dd($pos);
        $bd = $pos-1; //gives position right before cutter counting from  0 - usually last character in precutter string
        $endofcutter = ($pos+1); // In the array, will be the key of the letter that follows the decimal in the cutter
        $pnum = (strpos($str, "I")); // Gives position of 1st number in callno string
        $preflength = $pos-1; //Total length of prefix including spaces
        $volume = (strpos($callno, "V.")); // Find volume section if any
        $space = (strpos($str, "_")); //gives position of 1st space counting from 0
        $xmask = str_replace("_", " ", $smask); // Replace "_" is $smask with spaces
        $capdate = (strpos($str, "_IIIID"));
        $edatea = (strpos($str, "_IIIIA_"));
        $edate = (strpos($str, "_IIII_"));

        $cutter_date = self::cutter_date($amask,$calla,$smask);

        if($cutter_date != 0)

        {
            $cutter_call = self::cutter_call($amask,$calla,$smask);
            dd($cutter_call);
        }

        $pvn = null;
        $pvl = null;

        ########################################################################################################################

        // Make separate section for call numbers with no cutter

        if ($pos === false) {

            //Count number of spaces in $amask
            $cspace = 0;
            foreach($amask as $key => $a)
            {
                if($a == "_") { $cspace++; $skey = $key; }
            }

            // Get prefix

            //Find out how many numbers are in prefix
            $prenums = 0; // initiate variable

            foreach($amask as $key=>$a)
            {
                if($a == 'D') { break; }
                if($a == '_') { break; }
                if($amask[$key] == 'I')
                { $prenums++; }
                if($key == $preflength ) { break; }
            }

            //dd($prenums);
            foreach($amask as $key=>$a)
            {
                if($a == 'D') { break; }
                if($a == '_') { break; }
                if($a == 'I') { break; }
                if($amask[$key] == 'A') {

                    $prefix[] = $calla[$key];

                }


                if($key == 3) { break; }


            }

            //dd($prefix);

            $prefix = implode("", $prefix);




            // Construct 6 character number section after prefix

            // First get the array before any precutter decimal points, however many there are
            foreach($amask as $key=>$a)

            {
                // stop when you hit end of string
                if($a == '~') { break; }
                if($a == '_') { break; } //Stop at space

                // Stop if there is a decimal
                if($amask[$key] == 'D') { break; }
                if($amask[$key] == 'I') { $section2b[] = $calla[$key]; }


            }

            $off = 0;
            $d = 0;

            foreach($amask as $key=>$a)

            {
                // stop when you hit end of string
                if($a == '~') { break; }

                //count number of decimals before cutter
                if($amask[$key] == 'D') { $d++; }

                if($a=="_") { break; }

                if($amask[$key] == 'I' AND $d>0) {  //Start constructing after 1st precutter decimal


                    { $section2c[]=$calla[$key]; }

                }

            }


            if(isset($section2b)) {
                $cnum = count($section2b);

                $missing = 6-$cnum; // 6 to allow for the place the decimal point takes

                // Add 0's if less than 5 characters

                if($missing > 0) {

                    for ($i=0; $i < $missing; $i++) {

                        $section2a[] = 0; }
                }
            }
            // So far $section2a is the leading 0's before any integers

            // merge with the integers that occur before any precutter decimal

            if( isset($section2a) AND isset($section2b) ) {
                $section2a = array_merge($section2a,$section2b);

                $section2a = implode("", $section2a);

            } else { $section2a = "";}

            if(isset($section2c)) { $section2c = implode("", $section2c); } else {$section2c = "";}

            $cutter = ""; $post_cutter = ""; $cutter2 = ""; $post_cutter2 = "";


            $pre_marker = 0; //For no cutter pre_date will fall in line 2 section
            $pre_date = ""; //For no cutter pre_date will fall in line 2 section
        }



        else {  // Resume no cutter processing after topline processing done

##################################################################################################################

            //Count number of spaces in $amask
            $cspace = 0;
            foreach($amask as $key => $a)
            {
                if($a == "_") { $cspace++; $skey = $key; }
            }


            // Find out if topline contains a space and a date

            if($space !== false AND $space < $pos ) //If true there is a space before the cutter

            {

                foreach($amask as $key=>$a)

                {
                    if($key<=$space) { continue; }
                    if($key == $pos) { break; }
                    $pre1_date[] = $calla[$key];
                }




                if(isset($pre1_date))

                {

                    $pre1_date = implode("", $pre1_date);

                    $status = Sort::isDate($pre1_date);

                    if($status == 1)
                    { $pre_date = $pre1_date; $pre_marker = 1; }
                    else
                    { $pre_date = ""; $pre_marker = 0;

                        //See if it's a volume number
                        $vstatus = Sort::isVnum($pre1_date);

                        if($vstatus != 0)

                        {
                            $pvn1 = explode("/",$vstatus);

                            $pvn = Sort::leadingZeros($pvn1[0]);

                            $pvl = $pvn1[1];
                        }

                    }
                }

                else
                { $pre_date = ""; $pre_marker = 0; }

            }
            else
            { $pre_date=""; $pre_marker = 0; }

            // Get prefix

            //Find out how many numbers are in prefix
            $prenums = 0; // initiate variable

            foreach($amask as $key=>$a)
            {
                if($amask[$key] == 'I')
                { $prenums++; }
                if($key == $preflength ) { break; }
            }


            foreach($amask as $key=>$a)
            {
                if($a == 'D') { break; }
                if($amask[$key] == 'A') {

                    $prefix[] = $calla[$key];

                }


                if($key == 3) { break; }


            }



            $prefix = implode("", $prefix);

            ################################################################################

            // Construct 6 character number section after prefix

            // First get the array before any precutter decimal points, however many there are
            foreach($amask as $key=>$a)

            {
                // stop when you hit cutter
                if($key == $pos) { break; } // stop when you hit cutter
                if($a == "_") { break; }
                // Stop if there is a decimal
                if($amask[$key] == 'D') { break; }
                if($amask[$key] == 'I') { $section2b[] = $calla[$key]; }


            }

            #####################################################################################################
            // Get only part after pre-cutter decimal. This part is separate section
            // First find the position of the pre-cutter decimal



            if ($pos !== false) {

                $off = 0;
                $d = 0;
                foreach($amask as $key=>$a)

                {
                    // stop when you hit cutter
                    if($key == $pos) { break; }

                    if($a == "_") { break; }

                    //count number of decimals before cutter
                    if($amask[$key] == 'D') { $d++; }

                    if($amask[$key] == 'I' AND $d>0) {  //Start constructing after 1st precutter decimal

                        { $section2c[]=$calla[$key]; }

                    }

                }

                // $section2c is an array of post-decimal integers
                // $secton2b is an array of pre-decimal integers
                // $section2a is array of zeros to pad $section2b
                // $section 2c is array_merge of $section2a and section2b



                if(isset($section2b)) {
                    $cnum = count($section2b);

                    $missing = 6-$cnum; // 6 to allow for the place the decimal point takes

                    // Add 0's if less than 5 characters

                    if($missing > 0) {

                        for ($i=0; $i < $missing; $i++) {

                            $section2a[] = 0; }
                    }


                    $section2a = array_merge($section2a,$section2b);
                    $section2a = implode("", $section2a);

                }

                else

                {
                    $section2b = ""; $section2a = "";

                }


                if(isset($section2c))

                {
                    $section2c = implode("", $section2c);
                }

                else

                { $section2c = ""; }

            }

#############################################################
            // Get cutter
            $i =0;
            foreach($amask as $key=>$a)
            {
                if($key >= $pos)


                {
                    if($a == 'D') { continue; }
                    if($a == 'I' OR $a == '_') {break;}
                    $cutterp[] = $calla[$key];
                }

            }

            $lcut = $key-1; // One less than last iteration because loop has iterated an additional time before break

            $cutter = implode("", $cutterp);

###################################################################################################

// Beginning of Post-Cutter

            // Get second cutter if it exists

            foreach($amask as $key=>$a)

            {
                if($key > $lcut)  {  // last character in first cutter
                    if($a == '_') { break; }

                    if($a == 'A') {

                        $cutter2letters[] = $calla[$key]; $cutter2_position = $key;

                    }
                }
            }

            if(isset($cutter2letters)) { $cutter2 = implode("", $cutter2letters); }

            else
            { $cutter2 ="";}


            // Get first post cutter or pcd
            foreach($amask as $key=>$a) {

                if($key > $lcut)  {

                    // Stop if you hit beginning of second cutter or end
                    if($a == '_' OR $a == "A") { break; }

                    if($amask[$key] == 'I') {

                        if($calla[$key] == 0) {$postcutter[] = 0;}
                        if($calla[$key] == 1) {$postcutter[] = 1;}
                        if($calla[$key] == 2) {$postcutter[] = 2;}
                        if($calla[$key] == 3) {$postcutter[] = 3;}
                        if($calla[$key] == 4) {$postcutter[] = 4;}
                        if($calla[$key] == 5) {$postcutter[] = 5;}
                        if($calla[$key] == 6) {$postcutter[] = 6;}
                        if($calla[$key] == 7) {$postcutter[] = 7;}
                        if($calla[$key] == 8) {$postcutter[] = 8;}
                        if($calla[$key] == 9) {$postcutter[] = 9;}
                    }

                }

            }

            $post_cutter = implode("", $postcutter); //post_cutter string


            // Get second post cutter numbers, converted to lower case letters

            if(isset($cutter2) AND $cutter2 !=="") {

                foreach($amask as $key=>$a)

                {

                    if($key > $cutter2_position)

                    {
                        if($a == '_') { break; }

                        if($amask[$key] == 'I') {

                            if($calla[$key] == 0) {$postcutter2[] = 0;}
                            if($calla[$key] == 1) {$postcutter2[] = 1;}
                            if($calla[$key] == 2) {$postcutter2[] = 2;}
                            if($calla[$key] == 3) {$postcutter2[] = 3;}
                            if($calla[$key] == 4) {$postcutter2[] = 4;}
                            if($calla[$key] == 5) {$postcutter2[] = 5;}
                            if($calla[$key] == 6) {$postcutter2[] = 6;}
                            if($calla[$key] == 7) {$postcutter2[] = 7;}
                            if($calla[$key] == 8) {$postcutter2[] = 8;}
                            if($calla[$key] == 9) {$postcutter2[] = 9;}
                        }

                    }


                }


            }

            if(isset($postcutter2)) { $post_cutter2 = implode("", $postcutter2); }

            else

            { $post_cutter2 = ""; }



##################################################################################################################

        } // End of no cutter section - processing now continues after cutter and post cutter section done or skipped

        // Identify index volumes


        // Split call number at topline boundary

        if($space !== false) {
            //dd($space);
            if($pre_marker == 0 AND $capdate == false) //There is no pre_date
            {
                // Split the call number in 2 parts at the first space if there is no pre_date space
                $call = (explode(' ', $callno, 2)); $call = $call[1];

                //dd($call);

            }

            elseif ($capdate != false AND $cspace == 2)
            {
                preg_match('/^([^ ]+ +[^ ]+) +(.*)$/', $callno, $matches); $call=$matches[2];
            }
            //dd($call);

            if(isset($call)) { //There is no pre_date



                // Create array from characters in last part of call number
                $string = preg_split('//', $call, -1, PREG_SPLIT_NO_EMPTY);

                //dd($string);
                // Find out if there is date followed by letter


                if($pre_marker == 0 AND $pvn == null) // If there's no pre_date split $smask in 2 parts at 1st space
                {

                    $dx = (explode('_', $smask, 2));  $dm = $dx[1];  // Split the call number template in 2 parts at the first space

                }


                elseif( $cspace >= 2)

                {

                    preg_match('/^([^ ]+ +[^ ]+) +(.*)$/', $xmask, $matches); $dm=$matches[2];  //Split $xmask in 2 at second space
                    dd($dm);
                }



                else

                {
                    // account for $pvn with no cutter here
                }

                //dd($matches[2]);

                $hyphen = (strpos($dm, "H")); //position of the hyphen in the last part of call number

                $bhyphen = (strpos($smask, "H")); // positon of hyphen in the string as a whole

                if( $volume !== false AND $hyphen !== false ) // Have to check by !== false because if true, then = an integer, not true

                {
                    // Look for IHI pattern in $smask

                    $vindex = (strpos($smask, "IHI"));

                    if($vindex !== false)

                    {
                        foreach($amask as $key=>$a)
                        {
                            if($key<=$bhyphen) { continue; }
                            if($a=="_") { break; }
                            $index_end = $key;
                            if($a=="~") { break; }

                            $index_values[] = $calla[$key]; // Get the actual values in the index string

                        }

                    }



                }

                if(isset($index_values))

                {
                    $letter = "A";
                    $index = implode("", $index_values);
                    $index = Sort::leadingZeros($index);
                    $zindex = "$index$letter";

                }

                else

                { $zindex = 0; }



                $dp = (strpos($dm, "IIIIA")); // Find pattern of date with letter
                //dd($dp);
                $vol2 = (strpos($dm, "V."));

                if($dp !== FALSE)

                {

                    if($string[$dp] == 1 OR $string[$dp] == 2) { $tdwl = 1; }

                    if(isset($tdwl)) {
                        if( $tdwl == 1) {

                            $p1=$string[$dp];
                            $p2=$string[$dp+1];
                            $p3=$string[$dp+2];
                            $p4=$string[$dp+3];
                            $p5=$string[$dp+4];

                            $dwl = "$p1$p2$p3$p4$p5"; }
                    }
                    else

                    { $dwl = ""; }

                }


                //Create an array, replace spaces and number-letter transitions with delimiter /
                //dd($index_values);
                $past = null;
                foreach($string as $key=>$s)

                {

                    if($s == "/") { $temp[] = "*"; continue; }
                    if($zindex !== 0 AND $key>$vol2)

                    {
                        if($s == "~") { break; } // Break if you hit end of string
                        if($key >$vol2 AND $key<$hyphen) { continue; } //skip everything from the decimal point to the hyphen
                        if($s == " ") { $temp[] = "*"; continue; }

                        if($key == $hyphen)

                        { $temp[] = "*$zindex"; continue; }

                        if($key>$hyphen AND $key<=$hyphen+count($index_values)) { continue; }

                    }


                    if($dp !== false AND $key == $dp) // get pre_date

                    {
                        $temp[] = 0;
                        $temp[] = 0;

                        for($i=0; $i<=4; $i++)

                        { $temp[] = $string[$dp+$i]; }

                    }



                    if($dp !== false)
                    {

                        if($key >= $dp AND $key <= $dp+4) { continue; }

                    }

                    if($s == " ") { $temp[]="*"; continue; } // Replace each space with a delimiter
                    if($s == ".") { continue; } // Remove decimal points

                    if(is_numeric($s) === TRUE) {$type1 = 1;} else {$type1 = 2;}

                    if(isset($type2) AND $type2 != $type1 AND end($temp) != "*") { $temp[] = "*"; }

                    $temp[]=$s;

                    $type2 = $type1;

                }


                //dd($temp);

                if($pvn !== null) {

                    unset($temp);
                    $temp = array();
                    foreach($amask as $key=>$s) {
                        if($key > $skey ) // $skey is position of 2nd space
                        {
                            if($s == "~") { break; }
                            $temp[] = $calla[$key];
                        }
                    }
                }

                $temp = implode("",$temp); // Convert array to sting
                $parts = explode("*", $temp); // Create an array of strings using delimiter

                //dd($parts);

                if(isset($parts[0])) { $part1 = trim($parts[0]); } else {$part1="";}
                if(isset($parts[1])) { $part2 = trim($parts[1]); } else {$part2="";}
                if(isset($parts[2])) { $part3 = trim($parts[2]); } else {$part3="";}
                if(isset($parts[3])) { $part4 = trim($parts[3]); } else {$part4="";}
                if(isset($parts[4])) { $part5 = trim($parts[4]); } else {$part5="";}
                if(isset($parts[5])) { $part6 = trim($parts[5]); } else {$part6="";}
                if(isset($parts[6])) { $part7 = trim($parts[6]); } else {$part7="";}

                if($part1) {
                    if(is_numeric($part1) === TRUE AND strlen($part1) < 6)
                    {
                        $part1 = Sort::leadingZeros($part1);

                    }

                    $abstat = (Sort::dateAbbr($part1));

                    if($abstat !== 0) $part1 = $abstat;

                }


                // Normalize any numbers to 6 places, adding leading zeros

                if($part2) {
                    if(is_numeric($part2) === TRUE AND strlen($part2) < 6)
                    {
                        $part2 = Sort::leadingZeros($part2);

                    }


                    $abstat = (Sort::dateAbbr($part2));

                    if($abstat !== 0) $part2 = $abstat;

                }

                if($part3) {
                    if(is_numeric($part3) === TRUE AND strlen($part3) < 6)
                    {
                        $part3 = Sort::leadingZeros($part3);

                    }

                    $abstat = (Sort::dateAbbr($part3));

                    if($abstat !== 0) $part3 = $abstat;

                }

                if($part4) {
                    if(is_numeric($part4) === TRUE AND strlen($part4) < 6)
                    {
                        $part4 = Sort::leadingZeros($part4);

                    }

                    $abstat = (Sort::dateAbbr($part4));

                    if($abstat !== 0) $part4 = $abstat;

                }

                if($part5) {
                    if(is_numeric($part5) === TRUE AND strlen($part5) < 6)
                    {
                        $part5 = Sort::leadingZeros($part5);

                    }

                    $abstat = (Sort::dateAbbr($part5));

                    if($abstat !== 0) $part5 = $abstat;

                }


                if($part6) {
                    if(is_numeric($part6) === TRUE AND strlen($part6) < 6)
                    {
                        $part6 = Sort::leadingZeros($part6);

                    }

                    $abstat = (Sort::dateAbbr($part6));

                    if($abstat !== 0) $part6 = $abstat;

                }

                if($part7) {
                    if(is_numeric($part7) === TRUE AND strlen($part7) < 6)
                    {
                        $part7 = Sort::leadingZeros($part7);

                    }

                    $abstat = (Sort::dateAbbr($part7));

                    if($abstat !== 0) $part7 = $abstat;

                }

            }

            else

            {

                $part1="";
                $part2="";
                $part3="";
                $part4="";
                $part5="";
                $part6="";
                $part7="";
            }

        }

        else

        {

            $part1="";
            $part2="";
            $part3="";
            $part4="";
            $part5="";
            $part6="";
            $part7="";

        }

        ######################################
// if($pos === false) {


//     $cdate = Sort::isDate(ltrim($part1,0));

//     if($part2 == "" AND isset($part1))
//     {
//         $part1 = ltrim($part1,0);
//         //$pre_date = "$part1";  $part1 = "";
//     }

//     if($part3 == "" AND $part2 != "")

//     {
//         $part1 = ltrim($part1,0);
//         $part2 = ltrim($part2,0);
//         $testp = "$part1$part2";
//         $vstatus = Sort::isVnum($testp);
//         if($vstatus != 0) {
//         $pvn = $part1;
//         $pvl = $part2;
//         $part1 = "";
//         $part2 = "";
//     }
//     }
// }

        ######################################


###################################################################################################################


        if(isset($section2c))
        { $sort_key = "$prefix*$section2a*$section2c*$pre_date*$pvn*$pvl*$cutter*$post_cutter*$cutter2*$post_cutter2*$part1*
    $part2*$part3*$part4*$part5*$part6*$part7"; }

        else
        { $sort_key = "$prefix*$section2a*0*$pre_date*$pvn*$pvl*$cutter*$post_cutter*$cutter2*$post_cutter2*$part1*$part2*part3*$part4*$part5*$part6*$part7"; }


        return $sort_key;

    }

}
