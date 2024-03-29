<?php
/*
 * @Author: Dicky Ermawan S., S.T., MTA 
 * @Email: wanasaja@gmail.com 
 * @Web: dickyermawan.github.io 
 * @Linkedin: linkedin.com/in/dickyermawan 
 * @Date: 2019-07-05 17:36:12 
 * @Last Modified by:   Dicky Ermawan S., S.T., MTA 
 * @Last Modified time: 2019-07-05 17:36:12 
 */


namespace dickyermawan\hijridate;

/**
 * This is just an example.
 */
class HijriDate extends \yii\base\Widget
{
    private $hijri;

    public function __construct( $time = false ){
        if(!$time) 
            $time = time();
        else
            $time = strtotime($time);

        $this->hijri = $this->GregorianToHijri($time);
    }

    public function get_date($space = false, $zero = false){
        $tglHijri = $this->hijri[1];
        if($zero && $tglHijri<10)
            $tglHijri = '0'.$tglHijri;

        return $tglHijri . ' ' . $this->get_month_name($this->hijri[0]) . ' ' . $this->hijri[2] . (($space)?' ':'') .'H';
    }

    public function get_day(){
        return $this->hijri[1];
    }

    public function get_month(){
        return $this->hijri[0];
    }

    public function get_year(){
        return $this->hijri[2];
    }
    
    public function get_month_name($i){
        static $month = [
            'Muharram',
            'Shafar',
            'Rabi\'ul Awwal',
            'Rabi\'ul Akhir',
            'Jumadil Awwal',
            'Jumadil Akhir',
            'Rajab',
            'Sya\'ban',
            'Ramadhan',
            'Syawwal',
            'Dzul Qa\'dah',
            'Dzul Hijjah',
        ];
        return $month[$i-1];
    }

    private function GregorianToHijri($time = null){
        if ($time === null)
            $time = time();

        $m = date('m', $time);
        $d = date('d', $time);
        $y = date('Y', $time);

        return $this->JDToHijri(cal_to_jd(CAL_GREGORIAN, $m, $d, $y));
    }

    private function HijriToGregorian($m, $d, $y){
        return jd_to_cal(CAL_GREGORIAN, $this->HijriToJD($m, $d, $y));
    }

    # Julian Day Count To Hijri
    private function JDToHijri($jd){
        $jd = $jd - 1948440 + 10632;
        $n  = (int)(($jd - 1) / 10631);
        $jd = $jd - 10631 * $n + 354;
        $j  = ((int)((10985 - $jd) / 5316)) *
            ((int)(50 * $jd / 17719)) +
            ((int)($jd / 5670)) *
            ((int)(43 * $jd / 15238));
        $jd = $jd - ((int)((30 - $j) / 15)) *
            ((int)((17719 * $j) / 50)) -
            ((int)($j / 16)) *
            ((int)((15238 * $j) / 43)) + 29;
        $m  = (int)(24 * $jd / 709);
        $d  = $jd - (int)(709 * $m / 24);
        $y  = 30*$n + $j - 30;

        return array($m, $d, $y);
    }

    # Hijri To Julian Day Count
    private function HijriToJD($m, $d, $y){
        return (int)((11 * $y + 3) / 30) +
            354 * $y + 30 * $m -
            (int)(($m - 1) / 2) + $d + 1948440 - 385;
    }
}
