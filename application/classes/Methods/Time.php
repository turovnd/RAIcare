<?php

class Methods_Time
{

    public static function getTimeFromTime($start, $end)
    {
        $start  = strtotime($start);
        $end    = strtotime($end);

        $timestamp  = $start - $end;
        $has_year   = $timestamp / Date::YEAR > 1 ? true : false;
        $has_month  = $timestamp / Date::MONTH > 1 ? true : false;
        $has_day    = $timestamp / Date::DAY > 1 ? true : false;
        $has_hour   = $timestamp / Date::HOUR > 1 ? true : false;
        $has_minute = $timestamp / Date::MINUTE > 1 ? true : false;

        $year   = $has_year ? intval($timestamp / Date::YEAR) : 0;
        $month  = $has_month ?
                    $has_year ?
                        intval(($timestamp - Date::YEAR * $year) / Date::MONTH) :
                        intval($timestamp / Date::MONTH) : 0;

        $day    = $has_day ?
                    $has_month ?
                        $has_year ?
                            intval(($timestamp - Date::YEAR * $year - Date::MONTH * $month) / Date::DAY) :
                            intval(($timestamp - Date::MONTH * $month) / Date::DAY) :
                            intval($timestamp / Date::DAY) : 0;

        $hour   = $has_hour ?
                    $has_day ?
                        $has_month ?
                            $has_year ?
                                intval(($timestamp - Date::YEAR * $year - Date::MONTH * $month - Date::DAY * $day) / Date::HOUR) :
                                intval(($timestamp - Date::MONTH * $month - Date::DAY * $day) / Date::HOUR) :
                                intval(($timestamp - Date::DAY * $day) / Date::HOUR) :
                                intval($timestamp / Date::HOUR) : 0;

        $minute = $has_minute ?
                    $has_hour ?
                        $has_day ?
                            $has_month ?
                                $has_year ?
                                    intval(($timestamp - Date::YEAR * $year - Date::MONTH * $month - Date::DAY * $day - Date::HOUR * $hour) / Date::MINUTE) :
                                    intval(($timestamp - Date::MONTH * $month - Date::DAY * $day - Date::HOUR * $hour) / Date::MINUTE) :
                                    intval(($timestamp - Date::DAY * $day - Date::HOUR * $hour) / Date::MINUTE) :
                                    intval(($timestamp - Date::HOUR * $hour) / Date::MINUTE) :
                                    intval($timestamp / Date::MINUTE) : 0;
        $str = '';

        $str .= $has_year ? ' ' . Methods_Time::relativeTimeWithPlural($year, false, 'yy') : '';
        $str .= $has_month ? ' ' . Methods_Time::relativeTimeWithPlural($month, false, 'MM') : '';
        $str .= $has_day ? ' ' . Methods_Time::relativeTimeWithPlural($day, false, 'dd') : '';
        $str .= $has_hour ? ' ' . Methods_Time::relativeTimeWithPlural($hour, false, 'hh') : '';
        $str .= $has_minute ? ' ' . Methods_Time::relativeTimeWithPlural($minute,true, 'mm') : '';

        return $str;
    }

    public static function relativeTimeWithPlural($number, $withoutSuffix, $key) {
        $format = array(
            'mm' => $withoutSuffix ? array('минута','минуты','минут') : array('минуту','минуты','минут'),
            'hh' => array('час','часа','часов'),
            'dd' => array('день','дня','дней'),
            'MM' => array('месяц','месяца','месяцев'),
            'yy' => array('год','года','лет')
        );

        $forms = $format[$key];
        return $number . ' ' . ($number % 10 == 1 && $number % 100 != 11 ? $forms[0] : ($number % 10 >= 2 && $number % 10 <= 4 && ($number % 100 < 10 || $number % 100 >= 20) ? $forms[1] : $forms[2]));
    }

    public static function getSurveyLeftTime($dt_create, $dt_finish, $as_timestamp = false)
    {
        $cur = strtotime(Date::formatted_time('now'));
        $finish = strtotime($dt_create) + Date::DAY * 3;
        $timestamp  = $finish - $cur;

        $is_finish = $dt_finish != NULL;

        if ($is_finish) {
            $finish = strtotime($dt_finish);
            $timestamp  = $cur - $finish;
        }

        if ($as_timestamp)
            return $timestamp;

        $has_day    = $timestamp / Date::DAY > 1 ? true : false;
        $has_hour   = $timestamp / Date::HOUR > 1 ? true : false;
        $has_minute = $timestamp / Date::MINUTE > 1 ? true : false;

        $day    = $has_day ? intval($timestamp / Date::DAY) : 0;

        $hour   = $has_hour ?
                    $has_day ?
                        intval(($timestamp - Date::DAY * $day) / Date::HOUR) :
                        intval($timestamp / Date::HOUR) : 0;

        $minute = $has_minute ?
                    $has_hour ?
                        $has_day ?
                            intval(($timestamp - Date::DAY * $day - Date::HOUR * $hour) / Date::MINUTE) :
                            intval(($timestamp - Date::HOUR * $hour) / Date::MINUTE) :
                            intval($timestamp / Date::MINUTE) : 0;

        $str = '';

        if ($is_finish) {
            $str .= $has_day ? ' ' . Methods_Time::relativeTimeWithPlural($day, false, 'dd') : '';
            if (!$has_day) {
                $str .= $has_hour ? ' ' . Methods_Time::relativeTimeWithPlural($hour, false, 'hh') : '';
                $str .= $has_minute ? ' ' . Methods_Time::relativeTimeWithPlural($minute,false, 'mm') : '';
            }
            $str .= ' назад';
        } else {
            $str .= $has_day ? ' ' . Methods_Time::relativeTimeWithPlural($day, false, 'dd') : '';
            $str .= $has_hour ? ' ' . Methods_Time::relativeTimeWithPlural($hour, false, 'hh') : '';
            $str .= $has_minute ? ' ' . Methods_Time::relativeTimeWithPlural($minute,true, 'mm') : '';
        }

        if (!$has_day && !$has_hour && !$has_minute) return 'только что';
        return $str;
    }

}
