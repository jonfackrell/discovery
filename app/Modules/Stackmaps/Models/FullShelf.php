<?php

namespace App\Modules\Stackmaps\Models;

use Illuminate\Database\Eloquent\Model;

class FullShelf extends Model
{
    public static function makeMask($callno) // Find type of each character in callno string and return template
    {
        for ($i = 0; $i < strlen($callno); $i++) { // Get existing pattern in Ascii Decimal form
            if (ord($callno[$i]) >= 48 and ord($callno[$i]) <= 57) {
                $amask[] = "I";
                $calla[] = $callno[$i];
            }
            if (ord($callno[$i]) >= 65 and ord($callno[$i]) <= 90) {
                $amask[] = "A";
                $calla[] = $callno[$i];
            }
            if (ord($callno[$i]) >= 97 and ord($callno[$i]) <= 122) {
                $amask[] = "a";
                $calla[] = $callno[$i];
            }
            if (ord($callno[$i]) === 46) {
                $amask[] = "D";
                $calla[] = $callno[$i];
            }
            if (ord($callno[$i]) === 45) {
                $amask[] = "H";
                $calla[] = $callno[$i];
            }
            if (ord($callno[$i]) === 32) {
                $amask[] = "_";
                $calla[] = $callno[$i];
            } // This is a space
        }


        $amask[] = "~"; // put a marker at the end of the array
    $smask = implode("", $amask); // Returns string with no spaces

    $masks = [$amask,$smask,$calla];

        return $masks;
    }

    public static function pMask($amask, $smask, $callno, $calla)
    {
        $str = $smask;

        $pos = (strpos($str, "DA")); // Gives position of decimal in cutter counting from 0
        $bd = $pos-1; //gives position right before cutter counting from  0 - usually last character in precutter string
        $endofcutter = ($pos+1); // In the array, will be the key of the letter that follows the decimal in the cutter
        $pnum = (strpos($str, "I")); // Gives position of 1st number in callno string
        $preflength = $pos-1; //Total length of prefix including spaces
        $volume = (strpos($callno, "V.")); // Find volume section if any
        $space = (strpos($str, "_")); //gives position of 1st space counting from 0
        $xmask = str_replace("_", " ", $smask); // Replace "_" is $smask with spaces

        $pvn = null;
        $pvl = null;

        ########################################################################################################################

        // Make separate section for call numbers with no cutter

        if ($pos === false) {

            //Count number of spaces in $amask
            $cspace = 0;
            foreach ($amask as $key => $a) {
                if ($a == "_") {
                    $cspace++;
                    $skey = $key;
                }
            }

            // Get prefix

            //Find out how many numbers are in prefix
        $prenums = 0; // initiate variable

        foreach ($amask as $key=>$a) {
            if ($a == 'D') {
                break;
            }
            if ($amask[$key] == 'I') {
                $prenums++;
            }
            if ($key == $preflength) {
                break;
            }
        }


            foreach ($amask as $key=>$a) {
                if ($a == 'D') {
                    break;
                }
                if ($amask[$key] == 'A') {
                    $prefix[] = $calla[$key];
                }


                if ($key == 3) {
                    break;
                }
            }



            $prefix = implode("", $prefix);




            // Construct 6 character number section after prefix

            // First get the array before any precutter decimal points, however many there are
            foreach ($amask as $key=>$a) {
                // stop when you hit end of string
                if ($a == '~') {
                    break;
                }
                if ($a == '_') {
                    break;
                } //Stop at space

                // Stop if there is a decimal
                if ($amask[$key] == 'D') {
                    break;
                }
                if ($amask[$key] == 'I') {
                    $section2b[] = $calla[$key];
                }
            }

            $off = 0;
            $d = 0;

            foreach ($amask as $key=>$a) {
                // stop when you hit end of string
                if ($a == '~') {
                    break;
                }

                //count number of decimals before cutter
                if ($amask[$key] == 'D') {
                    $d++;
                }

                if ($a=="_") {
                    break;
                }

                if ($amask[$key] == 'I' and $d>0) {  //Start constructing after 1st precutter decimal


                    { $section2c[]=$calla[$key]; }
                }
            }


            if (isset($section2b)) {
                $cnum = count($section2b);

                $missing = 6-$cnum; // 6 to allow for the place the decimal point takes

                // Add 0's if less than 5 characters

                if ($missing > 0) {
                    for ($i=0; $i < $missing; $i++) {
                        $section2a[] = 0;
                    }
                }
            }
            // So far $section2a is the leading 0's before any integers

            // merge with the integers that occur before any precutter decimal

            if (isset($section2a) and isset($section2b)) {
                $section2a = array_merge($section2a, $section2b);

                $section2a = implode("", $section2a);
            } else {
                $section2a = "";
            }

            if (isset($section2c)) {
                $section2c = implode("", $section2c);
            } else {
                $section2c = "";
            }

            $cutter = "";
            $post_cutter = "";
            $cutter2 = "";
            $post_cutter2 = "";


            $pre_marker = 0; //For no cutter pre_date will fall in line 2 section
       $pre_date = ""; //For no cutter pre_date will fall in line 2 section
        } else {  // Resume after topline processing done

##################################################################################################################

            //Count number of spaces in $amask
            $cspace = 0;
            foreach ($amask as $key => $a) {
                if ($a == "_") {
                    $cspace++;
                    $skey = $key;
                }
            }


            // Find out if topline contains a space and a date

            if ($space !== false and $space < $pos) { //If true there is a space before the cutter
                foreach ($amask as $key=>$a) {
                    if ($key<=$space) {
                        continue;
                    }
                    if ($key == $pos) {
                        break;
                    }
                    $pre1_date[] = $calla[$key];
                }




                if (isset($pre1_date)) {
                    $pre1_date = implode("", $pre1_date);

                    $status = Sort::isDate($pre1_date);

                    if ($status == 1) {
                        $pre_date = $pre1_date;
                        $pre_marker = 1;
                    } else {
                        $pre_date = "";
                        $pre_marker = 0;

                        //See if it's a volume number
                        $vstatus = Sort::isVnum($pre1_date);

                        if ($vstatus != 0) {
                            $pvn1 = explode("/", $vstatus);

                            $pvn = Sort::leadingZeros($pvn1[0]);

                            $pvl = $pvn1[1];
                        }
                    }
                } else {
                    $pre_date = "";
                    $pre_marker = 0;
                }
            } else {
                $pre_date="";
                $pre_marker = 0;
            }

            // Get prefix

            //Find out how many numbers are in prefix
        $prenums = 0; // initiate variable

        foreach ($amask as $key=>$a) {
            if ($amask[$key] == 'I') {
                $prenums++;
            }
            if ($key == $preflength) {
                break;
            }
        }


            foreach ($amask as $key=>$a) {
                if ($a == 'D') {
                    break;
                }
                if ($amask[$key] == 'A') {
                    $prefix[] = $calla[$key];
                }


                if ($key == 3) {
                    break;
                }
            }



            $prefix = implode("", $prefix);

            ################################################################################

            // Construct 6 character number section after prefix

            // First get the array before any precutter decimal points, however many there are
            foreach ($amask as $key=>$a) {
                // stop when you hit cutter
            if ($key == $pos) {
                break;
            } // stop when you hit cutter
            if ($a == "_") {
                break;
            }
                // Stop if there is a decimal
                if ($amask[$key] == 'D') {
                    break;
                }
                if ($amask[$key] == 'I') {
                    $section2b[] = $calla[$key];
                }
            }

            #####################################################################################################
            // Get only part after pre-cutter decimal. This part is separate section
            // First find the position of the pre-cutter decimal



            if ($pos !== false) {
                $off = 0;
                $d = 0;
                foreach ($amask as $key=>$a) {
                    // stop when you hit cutter
                    if ($key == $pos) {
                        break;
                    }

                    if ($a == "_") {
                        break;
                    }

                    //count number of decimals before cutter
                    if ($amask[$key] == 'D') {
                        $d++;
                    }

                    if ($amask[$key] == 'I' and $d>0) {  //Start constructing after 1st precutter decimal

                        { $section2c[]=$calla[$key]; }
                    }
                }

                // $section2c is an array of post-decimal integers
                // $secton2b is an array of pre-decimal integers
                // $section2a is array of zeros to pad $section2b
                // $section 2c is array_merge of $section2a and section2b



                if (isset($section2b)) {
                    $cnum = count($section2b);

                    $missing = 6-$cnum; // 6 to allow for the place the decimal point takes

                    // Add 0's if less than 5 characters

                    if ($missing > 0) {
                        for ($i=0; $i < $missing; $i++) {
                            $section2a[] = 0;
                        }
                    }


                    $section2a = array_merge($section2a, $section2b);
                    $section2a = implode("", $section2a);
                } else {
                    $section2b = "";
                    $section2a = "";
                }


                if (isset($section2c)) {
                    $section2c = implode("", $section2c);
                } else {
                    $section2c = "";
                }
            }

            #############################################################
            // Get cutter
            $i =0;
            foreach ($amask as $key=>$a) {
                if ($key >= $pos) {
                    if ($a == 'D') {
                        continue;
                    }
                    if ($a == 'I' or $a == '_') {
                        break;
                    }
                    $cutterp[] = $calla[$key];
                }
            }

            $lcut = $key-1; // One less than last iteration because loop has iterated an additional time before break

            $cutter = implode("", $cutterp);

            ###################################################################################################

            // Beginning of Post-Cutter

            // Get second cutter if it exists

            foreach ($amask as $key=>$a) {
                if ($key > $lcut) {  // last character in first cutter
                    if ($a == '_') {
                        break;
                    }

                    if ($a == 'A') {
                        $cutter2letters[] = $calla[$key];
                        $cutter2_position = $key;
                    }
                }
            }

            if (isset($cutter2letters)) {
                $cutter2 = implode("", $cutter2letters);
            } else {
                $cutter2 ="";
            }


            // Get first post cutter or pcd
            foreach ($amask as $key=>$a) {
                if ($key > $lcut) {

                // Stop if you hit beginning of second cutter or end
                    if ($a == '_' or $a == "A") {
                        break;
                    }

                    if ($amask[$key] == 'I') {
                        if ($calla[$key] == 0) {
                            $postcutter[] = 'a';
                        }
                        if ($calla[$key] == 1) {
                            $postcutter[] = 'b';
                        }
                        if ($calla[$key] == 2) {
                            $postcutter[] = 'c';
                        }
                        if ($calla[$key] == 3) {
                            $postcutter[] = 'd';
                        }
                        if ($calla[$key] == 4) {
                            $postcutter[] = 'e';
                        }
                        if ($calla[$key] == 5) {
                            $postcutter[] = 'f';
                        }
                        if ($calla[$key] == 6) {
                            $postcutter[] = 'g';
                        }
                        if ($calla[$key] == 7) {
                            $postcutter[] = 'h';
                        }
                        if ($calla[$key] == 8) {
                            $postcutter[] = 'i';
                        }
                        if ($calla[$key] == 9) {
                            $postcutter[] = 'j';
                        }
                    }
                }
            }

            $post_cutter = implode("", $postcutter); //post_cutter string


            // Get second post cutter numbers, converted to lower case letters

            if (isset($cutter2) and $cutter2 !=="") {
                foreach ($amask as $key=>$a) {
                    if ($key > $cutter2_position) {
                        if ($a == '_') {
                            break;
                        }

                        if ($amask[$key] == 'I') {
                            if ($calla[$key] == 0) {
                                $postcutter2[] = 'a';
                            }
                            if ($calla[$key] == 1) {
                                $postcutter2[] = 'b';
                            }
                            if ($calla[$key] == 2) {
                                $postcutter2[] = 'c';
                            }
                            if ($calla[$key] == 3) {
                                $postcutter2[] = 'd';
                            }
                            if ($calla[$key] == 4) {
                                $postcutter2[] = 'e';
                            }
                            if ($calla[$key] == 5) {
                                $postcutter2[] = 'f';
                            }
                            if ($calla[$key] == 6) {
                                $postcutter2[] = 'g';
                            }
                            if ($calla[$key] == 7) {
                                $postcutter2[] = 'h';
                            }
                            if ($calla[$key] == 8) {
                                $postcutter2[] = 'i';
                            }
                            if ($calla[$key] == 9) {
                                $postcutter2[] = 'j';
                            }
                        }
                    }
                }
            }

            if (isset($postcutter2)) {
                $post_cutter2 = implode("", $postcutter2);
            } else {
                $post_cutter2 = "";
            }



            ##################################################################################################################
        } // End of no cutter section

        // Identify index volumes


        // Split call number at topline boundary

        if ($space !== false) {
            if ($pre_marker == 0) { //There is no pre_date
            // Split the call number in 2 parts at the first space if there is no pre_date space
                $call = (explode(' ', $callno, 2));
                $call = $call[1];
            }


            if (isset($call)) {



        // Create array from characters in last part of call number
                $string = preg_split('//', $call, -1, PREG_SPLIT_NO_EMPTY);


                // Find out if there is date followed by letter


                if ($pre_marker == 0 and $pvn == null) { // If there's no pre_date split $smask in 2 parts at 1st space
                    $dx = (explode('_', $smask, 2));
                    $dm = $dx[1];  // Split the call number template in 2 parts at the first space
                } elseif ($pre_marker != 0 or $pvn !== null and $cspace >= 2) {
                    preg_match('/^([^ ]+ +[^ ]+) +(.*)$/', $xmask, $matches);
                    $dm=$matches[2];  //Split $xmask in 2 at second space
                } else {
                    // account for $pvn with no cutter here
                }

                //dd($matches[2]);

                $hyphen = (strpos($dm, "H")); //position of the hyphen in the last part of call number

                $bhyphen = (strpos($smask, "H")); // positon of hyphen in the string as a whole

                if ($volume !== false and $hyphen !== false) { // Have to check by !== false because if true, then = an integer, not true
        // Look for IHI pattern in $smask

                    $vindex = (strpos($smask, "IHI"));

                    if ($vindex !== false) {
                        foreach ($amask as $key=>$a) {
                            if ($key<=$bhyphen) {
                                continue;
                            }
                            if ($a=="_") {
                                break;
                            }
                            $index_end = $key;
                            if ($a=="~") {
                                break;
                            }

                            $index_values[] = $calla[$key]; // Get the actual values in the index string
                        }
                    }
                }

                if (isset($index_values)) {
                    $letter = "A";
                    $index = implode("", $index_values);
                    $index = Sort::leadingZeros($index);
                    $zindex = "$index$letter";
                } else {
                    $zindex = 0;
                }



                $dp = (strpos($dm, "IIIIA")); // Find pattern of date with letter
                $vol2 = (strpos($dm, "V."));

                if ($dp !== false) {
                    if ($string[$dp] == 1 or $string[$dp] == 2) {
                        $tdwl = 1;
                    }

                    if (isset($tdwl)) {
                        if ($tdwl == 1) {
                            $p1=$string[$dp];
                            $p2=$string[$dp+1];
                            $p3=$string[$dp+2];
                            $p4=$string[$dp+3];
                            $p5=$string[$dp+4];

                            $dwl = "$p1$p2$p3$p4$p5";
                        }
                    } else {
                        $dwl = "";
                    }
                }


                //Create an array, replace spaces and number-letter transitions with delimiter /
                //dd($index_values);
                $past = null;
                foreach ($string as $key=>$s) {
                    if ($zindex !== 0 and $key>$vol2) {
                        if ($s == "~") {
                            break;
                        } // Break if you hit end of string
            if ($key >$vol2 and $key<$hyphen) {
                continue;
            } //skip everything from the decimal point to the hyphen
            if ($s == " ") {
                $temp[] = "/";
                continue;
            }
                        if ($key == $hyphen) {
                            $temp[] = "/$zindex";
                            continue;
                        }

                        if ($key>$hyphen and $key<=$hyphen+count($index_values)) {
                            continue;
                        }
                    }


                    if ($dp !== false and $key == $dp) { // get pre_date
                        $temp[] = 0;
                        $temp[] = 0;

                        for ($i=0; $i<=4; $i++) {
                            $temp[] = $string[$dp+$i];
                        }
                    }



                    if ($dp !== false) {
                        if ($key >= $dp and $key <= $dp+4) {
                            continue;
                        }
                    }

                    if ($s == " ") {
                        $temp[]="/";
                        continue;
                    } // Replace each space with a delimiter
        if ($s == ".") {
            continue;
        } // Remove decimal points

        if (is_numeric($s) === true) {
            $type1 = 1;
        } else {
            $type1 = 2;
        }

                    if (isset($type2) and $type2 != $type1 and end($temp) != "/") {
                        $temp[] = "/";
                    }

                    $temp[]=$s;

                    $type2 = $type1;
                }




                if ($pvn !== null) {
                    unset($temp);
                    $temp = [];
                    foreach ($amask as $key=>$s) {
                        if ($key > $skey) { // $skey is position of 2nd space
                            if ($s == "~") {
                                break;
                            }
                            $temp[] = $calla[$key];
                        }
                    }
                }

                $temp = implode("", $temp); // Convert array to sting
             $parts = explode("/", $temp); // Create an array of strings using delimiter



    if (isset($parts[0])) {
        $part1 = trim($parts[0]);
    } else {
        $part1="";
    }
                if (isset($parts[1])) {
                    $part2 = trim($parts[1]);
                } else {
                    $part2="";
                }
                if (isset($parts[2])) {
                    $part3 = trim($parts[2]);
                } else {
                    $part3="";
                }
                if (isset($parts[3])) {
                    $part4 = trim($parts[3]);
                } else {
                    $part4="";
                }
                if (isset($parts[4])) {
                    $part5 = trim($parts[4]);
                } else {
                    $part5="";
                }
                if (isset($parts[5])) {
                    $part6 = trim($parts[5]);
                } else {
                    $part6="";
                }
                if (isset($parts[6])) {
                    $part7 = trim($parts[6]);
                } else {
                    $part7="";
                }

                if ($part1) {
                    if (is_numeric($part1) === true and strlen($part1) < 6) {
                        $part1 = Sort::leadingZeros($part1);
                    }

                    $abstat = (Sort::dateAbbr($part1));

                    if ($abstat !== 0) {
                        $part1 = $abstat;
                    }
                }

                // Normalize any numbers to 6 places, adding leading zeros

                if ($part2) {
                    if (is_numeric($part2) === true and strlen($part2) < 6) {
                        $part2 = Sort::leadingZeros($part2);
                    }


                    $abstat = (Sort::dateAbbr($part2));

                    if ($abstat !== 0) {
                        $part2 = $abstat;
                    }
                }

                if ($part3) {
                    if (is_numeric($part3) === true and strlen($part3) < 6) {
                        $part3 = Sort::leadingZeros($part3);
                    }

                    $abstat = (Sort::dateAbbr($part3));

                    if ($abstat !== 0) {
                        $part3 = $abstat;
                    }
                }

                if ($part4) {
                    if (is_numeric($part4) === true and strlen($part4) < 6) {
                        $part4 = Sort::leadingZeros($part4);
                    }

                    $abstat = (Sort::dateAbbr($part4));

                    if ($abstat !== 0) {
                        $part4 = $abstat;
                    }
                }

                if ($part5) {
                    if (is_numeric($part5) === true and strlen($part5) < 6) {
                        $part5 = Sort::leadingZeros($part5);
                    }

                    $abstat = (Sort::dateAbbr($part5));

                    if ($abstat !== 0) {
                        $part5 = $abstat;
                    }
                }


                if ($part6) {
                    if (is_numeric($part6) === true and strlen($part6) < 6) {
                        $part6 = Sort::leadingZeros($part6);
                    }

                    $abstat = (Sort::dateAbbr($part6));

                    if ($abstat !== 0) {
                        $part6 = $abstat;
                    }
                }

                if ($part7) {
                    if (is_numeric($part7) === true and strlen($part7) < 6) {
                        $part7 = Sort::leadingZeros($part7);
                    }

                    $abstat = (Sort::dateAbbr($part7));

                    if ($abstat !== 0) {
                        $part7 = $abstat;
                    }
                }
            } else {
                $part1="";
                $part2="";
                $part3="";
                $part4="";
                $part5="";
                $part6="";
                $part7="";
            }
        } else {
            $part1="";
            $part2="";
            $part3="";
            $part4="";
            $part5="";
            $part6="";
            $part7="";
        }

        ######################################
        if ($pos === false) {
            $cdate = Sort::isDate(ltrim($part1, 0));

            if ($part2 == "" and isset($part1)) {
                $part1 = ltrim($part1, 0);
                $pre_date = "$part1";
                $part1 = "";
            }

            if ($part3 == "" and $part2 != "") {
                $part1 = ltrim($part1, 0);
                $part2 = ltrim($part2, 0);
                $testp = "$part1$part2";
                $vstatus = Sort::isVnum($testp);
                if ($vstatus != 0) {
                    $pvn = $part1;
                    $pvl = $part2;
                    $part1 = "";
                    $part2 = "";
                }
            }
        }

        ######################################


        ###################################################################################################################


        if (isset($section2c)) {
            $sort_key = "$prefix/$section2a/$section2c/$pre_date/$pvn/$pvl/$cutter/$post_cutter/$cutter2/$post_cutter2/$part1/
    $part2/$part3/$part4/$part5/$part6/$part7";
        } else {
            $sort_key = "$prefix/$section2a/0/$pre_date/$pvn/$pvl/$cutter/$post_cutter/$cutter2/post_cutter2/$part1/$part2/part3/
        $part4/$part5/$part6/$part7";
        }


        return $sort_key;
    }
}
