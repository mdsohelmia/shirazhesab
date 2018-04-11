<?php
/**
 * Created by PhpStorm.
 * User: Ali Ghasemzadeh
 * Date: 3/21/2018
 * Time: 10:25 PM
 */

if (! function_exists('number_to_letters')) {
    function number_to_letters($number)
    {
        $ones = array("", "یک",'دو&nbsp;', "سه", "چهار", "پنج", "شش", "هفت", "هشت", "نه", "ده", "یازده", "دوازده", "سیزده", "چهارده", "پانزده", "شانزده", "هفده", "هجده", "نونزده");
        $tens = array("", "", "بیست", "سی", "چهل", "پنجاه", "شصت", "هفتاد", "هشتاد", "نود");
        $tows = array("", "صد", "دویست", "سیصد", "چهار صد", "پانصد", "ششصد", "هفتصد", "هشت صد", "نه صد");


        if (($number < 0) || ($number > 999999999)) {
            return "";
        }
        $Gn = floor($number / 1000000);
        /* Millions (giga) */
        $number -= $Gn * 1000000;
        $kn = floor($number / 1000);
        /* Thousands (kilo) */
        $number -= $kn * 1000;
        $Hn = floor($number / 100);
        /* Hundreds (hecto) */
        $number -= $Hn * 100;
        $Dn = floor($number / 10);
        /* Tens (deca) */
        $n = $number % 10;
        /* Ones */
        $res = "";
        if ($Gn) {
            $res .= number_to_letters($Gn) .  " میلیون و ";
        }
        if ($kn) {
            $res .= (empty($res) ? "" : " ") .number_to_letters($kn) . " هزار و";
        }
        if ($Hn) {
            $res .= (empty($res) ? "" : " ") . $tows[$Hn] . " و ";
        }
        if ($Dn || $n) {
            if (!empty($res)) {
                $res .= "";
            }
            if ($Dn < 2) {
                $res .= $ones[$Dn * 10 + $n];
            } else {
                $res .= $tens[$Dn];
                if ($n) {
                    $res .= " و " . $ones[$n];
                }
            }
        }
        if (empty($res)) {
            $res = "صفر";
        }
        $res=rtrim($res," و");
        return $res;
    }

}
function en_numbers($string) {
    return strtr($string, array('۰'=>'0', '۱'=>'1', '۲'=>'2', '۳'=>'3', '۴'=>'4', '۵'=>'5', '۶'=>'6', '۷'=>'7', '۸'=>'8', '۹'=>'9', '٠'=>'0', '١'=>'1', '٢'=>'2', '٣'=>'3', '٤'=>'4', '٥'=>'5', '٦'=>'6', '٧'=>'7', '٨'=>'8', '٩'=>'9'));
}
function random_color_part() {
    return str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT);
}

function random_color() {
    return random_color_part() . random_color_part() . random_color_part();
}

