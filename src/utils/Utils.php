<?php
/**
 * Utils
 *
 * THIS MATERIAL IS PROVIDED AS IS, WITH ABSOLUTELY NO WARRANTY EXPRESSED
 * OR IMPLIED. ANY USE IS AT YOUR OWN RISK.
 *
 * Permission is hereby granted to use or copy this program
 * for any purpose, provided the above notices are retained on all copies.
 * Permission to modify the code and to distribute modified code is granted,
 * provided the above notices are retained, and a notice that the code was
 * modified is included with the above copyright notice.
 *
 * @category  Wp
 * @package   Punction
 * @author    Andrzej Marcinkowski <andrzej.max.marcinkowski@gmail.com>
 * @copyright 2014 Wojewódzki Szpital Zespolony, Kalisz
 * @license   MIT http://opensource.org/licenses/MIT
 * @version   1.0 $Id: 654aa9ca96042e8f8814f3d117791957e31d6088 $ $Format:%H$
 * @link      http://
 * @since     File available since Release 1.0.0
 * PHP Version 5
 */
namespace Hospitalplugin\utils;

/**
 * Utils
 *
 * @category  Wp
 * @package   Punction
 * @author    Andrzej Marcinkowski <andrzej.max.marcinkowski@gmail.com>
 * @copyright 2014 Wojewódzki Szpital Zespolony, Kalisz
 * @license   MIT http://opensource.org/licenses/MIT
 * @version   1.0 $Id: 654aa9ca96042e8f8814f3d117791957e31d6088 $ $Format:%H$
 * @link      http://
 * @since     File available since Release 1.0.0
 *
 */
class Utils
{

    /**
     * diff in days
     *
     * @param $date1 $date1 string parsable date strtotime(date)           
     * @param $date2 $date2 string parsable date strtotime(date)          
     * @return number
     */
    public static function diffDates($date1, $date2)
    {
        $ts1 = strtotime($date1);
        $ts2 = strtotime($date2);
        
        $seconds_diff = $ts2 - $ts1;
        
        return floor($seconds_diff / 3600 / 24);
    }

    /**
     * next day in Y-m-d format
     *
     * @param $month int month 1-12         
     * @param $day int day 1-31          
     * @return string Y-m-d
     */
    public static function getNextDay($month, $day)
    {
        return Utils::getNextDayDate('Y-' . $month . '-' . $day);
    }

    /**
     * next day in Y-m-d format
     *
     * @param $month int month 1-12
     * @param $day int day 1-31
     * @return string Y-m-d
     */
    public static function getNextDayDate($date)
    {
        $dateString = strtotime(date($date));
        return date('Y-m-d', strtotime('+1 day', $dateString));
    }

    /**
     * precious day in Y-m-d format
     *
     * @param $date sttring Y-m-d
     * @return string Y-m-d
     */
    public static function getPreviousDay($date)
    {
        $dateMinus1 = strtotime('-1 day', strtotime($date));
        return date('Y-m-d', $dateMinus1);
    }

    /**
     * first day of next month
     *
     * @param month int no def val 
     * @param day int no def val         
     * @return string Y-m-d
     */
    public static function getNextMonthFirstDay($month, $day)
    {
        return date('Y-m-d', strtotime('+1 month', strtotime(date('Y-' . $month . '-01'))));
    }

    /**
     * getStartDate
     *
     * Returns today if no date specified,
     * First date of month if just month specified,
     * Exact date if month and date specified.
     * @example getStartDate() will return today (2014-09-28)
     * @example getStartDate(2) will return 2014-02-01
     * @example getStartDate(12,7) will return 2014-12-07
     *
     * @return string date
     *
     *
     * @param $month int default null
     * @param $day int default null            
     */
    public static function getStartDate($month = null, $day = null)
    {
        if ($month == null && $day == null) {
            // today
            $date = new \DateTime(date('Y-m-d'));
        } else 
            if ($day == null) {
                // first day of mnth
                $date = new \DateTime(date('Y-') . $month . '-01');
            } else {
                // date
                $date = new \DateTime(date('Y-' . $month . '-' . $day));
            }
        return $date->format('Y-m-d');
    }

    /**
     * getEndDate
     *
     * @param $month int default null
     * @param $day int default null
     */
    public static function getEndDate($month = null, $day = null)
    {
        if ($month == null && $day == null) {
            // tomorrow
            $date = new \DateTime(Utils::getNextDay(date('m'), date('d')));
        } else 
            if ($day == null) {
                // first day of next mnth
                $date = new \DateTime(Utils::getNextMonthFirstDay($month, $day));
            } else {
                // date +1 day
                $date = new \DateTime(Utils::getNextDay($month, $day));
            }
        return $date->format('Y-m-d');
    }

    /**
     * getStartEndDate
     * 
     * pobierz date $_GET['date']; / domyslnie dzisiaj
     * 0 - dzisiaj; 1 - wczoraj; 7 - week
     * 
     * @param unknown $dateParam
     * @return unknown
     */
    public static function getStartEndDate($dateParam)
    {
        if (empty($dateParam) || ! in_array($dateParam, array(
            0,
            1,
            7
        ))) {
            $dateParam = 0;
        } 
        $date = array();
        $today = (new \DateTime("now"))->format("Y-m-d");
        $tomorrow = Utils::getNextDayDate($today);
        $yesterday = Utils::getPreviousDay($today);
        switch ($dateParam) {
            case 0:
                $date['startDate'] = $today;
                $date['endDate'] = $tomorrow;
                break;
            case 1:
                $date['startDate'] = $yesterday;
                $date['endDate'] = $today;
                break;
            case 7:
                $date['endDate'] = $tomorrow;
                $date['startDate'] = Utils::getDateWeekAgo();
                break;
        }
        return $date;
    }

    /**
     * getDateWeekAgo
     *
     * @param $month int default null
     * @param $day int default null
     */
    public static function getDateWeekAgo()
    {
        // today
        $date = new \DateTime(date('Y-m-d'));
        // minus 7 days
        $date = $date->sub(new \DateInterval('P7D'));
        return $date->format('Y-m-d');
    }

    /**
     * read file to array
     *
     * @param $url file url
     * @param $delm default ;
     * @param $encl default \
     * @param $head default false
     * @return array of strings
     */
    public static function readFileToArray($url, $delm = ";", $encl = "\"", $head = false)
    {
        $csvxrow = file($url); // ---- csv rows to array ----
        
        $csvxrow[0] = chop($csvxrow[0]);
        $csvxrow[0] = str_replace($encl, '', $csvxrow[0]);
        $keydata = explode($delm, $csvxrow[0]);
        $keynumb = count($keydata);
        $csv_data = array();
        $out = array();
        if ($head === true) {
            $anzdata = count($csvxrow);
            $z = 0;
            for ($x = 1; $x < $anzdata; $x ++) {
                $csvxrow[$x] = chop($csvxrow[$x]);
                $csvxrow[$x] = str_replace($encl, '', $csvxrow[$x]);
                $csv_data[$x] = explode($delm, $csvxrow[$x]);
                $i = 0;
                foreach ($keydata as $key) {
                    $out[$z][$key] = $csv_data[$x][$i];
                    $i ++;
                }
                $z ++;
            }
        } else {
            $i = 0;
            foreach ($csvxrow as $item) {
                $item = chop($item);
                $item = str_replace($encl, '', $item);
                $csv_data = explode($delm, $item);
                for ($y = 0; $y < $keynumb; $y ++) {
                    $out[$i][$y] = $csv_data[$y];
                }
                $i ++;
            }
        }
        
        return $out;
    }

    /**
     * PL chars conv iso8859-2 => win1250 => utf8
     *
     * @param text string with PL chars           
     * @return string encoded
     */
    public static function w1250_to_utf8($text)
    {
        // map based on:
        // http://konfiguracja.c0.pl/iso02vscp1250en.html
        // http://konfiguracja.c0.pl/webpl/index_en.html#examp
        // http://www.htmlentities.com/html/entities/
        $map = array(
            chr(0x8A) => chr(0xA9),
            chr(0x8C) => chr(0xA6),
            chr(0x8D) => chr(0xAB),
            chr(0x8E) => chr(0xAE),
            chr(0x8F) => chr(0xAC),
            chr(0x9C) => chr(0xB6),
            chr(0x9D) => chr(0xBB),
            chr(0xA1) => chr(0xB7),
            chr(0xA5) => chr(0xA1),
            chr(0xBC) => chr(0xA5),
            
            // chr ( 0x9F ) => chr ( 0xBC ),
            chr(0xB9) => chr(0xB1),
            chr(0x9A) => chr(0xB9),
            chr(0xBE) => chr(0xB5),
            chr(0x9E) => chr(0xBE),
            chr(0x80) => '&euro;',
            chr(0x82) => '&sbquo;',
            chr(0x84) => '&bdquo;',
            chr(0x85) => '&hellip;',
            chr(0x86) => '&dagger;',
            chr(0x87) => '&Dagger;',
            chr(0x89) => '&permil;',
            chr(0x8B) => '&lsaquo;',
            chr(0x91) => '&lsquo;',
            chr(0x92) => '&rsquo;',
            chr(0x93) => '&ldquo;',
            chr(0x94) => '&rdquo;',
            chr(0x95) => '&bull;',
            chr(0x96) => '&ndash;',
            chr(0x97) => '&mdash;',
            chr(0x99) => '&trade;',
            chr(0x9B) => '&rsquo;',
            chr(0xA9) => '&copy;',
            chr(0xAB) => '&laquo;',
            chr(0xAE) => '&reg;',
            chr(0xB1) => '&plusmn;',
            chr(0xB5) => '&micro;',
            chr(0xB7) => '&middot;',
            chr(0xBB) => '&raquo;',
            
            // ś
            chr(0xB6) => '&#347;',
            
            // ą
            chr(0xB1) => '&#261;',
            
            // Ś
            chr(0xA6) => '&#346;',
            
            // ż
            chr(0xBF) => '&#380;',
            
            // ź
            chr(0x9F) => '&#378;'
        );
        return html_entity_decode(mb_convert_encoding(strtr($text, $map), 'UTF-8', 'ISO-8859-2'), ENT_QUOTES, 'UTF-8');
    }

    /**
     * Class casting
     *
     * @param string|object $destination
     * @param object $sourceObject
     * @return object
     */
    static function cast($destination, $sourceObject, $arguments)
    {
        if (is_string($destination)) {
            $destination = new $destination($arguments);
        }
        $sourceReflection = new \ReflectionObject($sourceObject);
        $destinationReflection = new \ReflectionObject($destination);
        $sourceProperties = $sourceReflection->getProperties();
        foreach ($sourceProperties as $sourceProperty) {
            $sourceProperty->setAccessible(true);
            $name = $sourceProperty->getName();
            $value = $sourceProperty->getValue($sourceObject);
            if ($destinationReflection->hasProperty($name)) {
                $propDest = $destinationReflection->getProperty($name);
                $propDest->setAccessible(true);
                $propDest->setValue($destination, $value);
            } else {
                $destination->$name = $value;
            }
        }
        return $destination;
    }
}

