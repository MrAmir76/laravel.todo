<?php


namespace App\helper;
class Jalali
{
    // string_time example: 2023-08-02 12:07:59
    public static function convert1($str_time): string

    {
        return explode(' ', self::convert($str_time))[1];
    }

    public static function convert($str_time): string

    {
        $datetime_list = explode(' ', $str_time); //["2023-08-02" ,"12:07:59"]
        $g_date_list = explode('-', $datetime_list[0]); // ['2023','08','02']
        $j_date_list = self::to_jalali($g_date_list[0], $g_date_list[1], $g_date_list[2]);// ['1402','05','14']

        $j_date = implode("/", $j_date_list); // 1402/5/11
        $time = $datetime_list[1]; //12:07:59

        return $time . " " . $j_date;
    }

    private static function to_jalali($gy, $gm, $gd, $mod = '')
    {
        list($gy, $gm, $gd) = explode('_', self::tr_num($gy . '_' . $gm . '_' . $gd));/* <= Extra :اين سطر ، جزء تابع اصلي نيست */
        $g_d_m = array(0, 31, 59, 90, 120, 151, 181, 212, 243, 273, 304, 334);
        $gy2 = ($gm > 2) ? ($gy + 1) : $gy;
        $days = 355666 + (365 * $gy) + ((int)(($gy2 + 3) / 4)) - ((int)(($gy2 + 99) / 100)) + ((int)(($gy2 + 399) / 400)) + $gd + $g_d_m[$gm - 1];
        $jy = -1595 + (33 * ((int)($days / 12053)));
        $days %= 12053;
        $jy += 4 * ((int)($days / 1461));
        $days %= 1461;
        if ($days > 365) {
            $jy += (int)(($days - 1) / 365);
            $days = ($days - 1) % 365;
        }
        if ($days < 186) {
            $jm = 1 + (int)($days / 31);
            $jd = 1 + ($days % 31);
        } else {
            $jm = 7 + (int)(($days - 186) / 30);
            $jd = 1 + (($days - 186) % 30);
        }
        return ($mod == '') ? array($jy, $jm, $jd) : $jy . $mod . $jm . $mod . $jd;
    }

    private static function tr_num($str, $mod = 'en', $mf = '٫'): array|string
    {
        $num_a = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '.');
        $key_a = array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹', $mf);
        return ($mod == 'fa') ? str_replace($num_a, $key_a, $str) : str_replace($key_a, $num_a, $str);
    }

}
