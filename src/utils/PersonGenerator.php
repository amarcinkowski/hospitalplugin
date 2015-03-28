<?php
/**
 * PersonGenerator
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
 * @version   1.0 $Id: a88997670673063e272ee5666aa86ed1ec9a1561 $ $Format:%H$
 * @link      http://
 * @since     File available since Release 1.0.0
 * PHP Version 5
 */
namespace Hospitalplugin\utils;

use Punction\Entities\Patient;
use Punction\Entities\PatientZZ;

/**
 * PersonGenerator
 *
 * @category  Wp
 * @package   Punction
 * @author    Andrzej Marcinkowski <andrzej.max.marcinkowski@gmail.com>
 * @copyright 2014 Wojewódzki Szpital Zespolony, Kalisz
 * @license   MIT http://opensource.org/licenses/MIT
 * @version   1.0 $Id: a88997670673063e272ee5666aa86ed1ec9a1561 $ $Format:%H$
 * @link      http://
 * @since     File available since Release 1.0.0
 *
 */
class PersonGenerator
{

    private static $names;

    private static $mnames;

    private static $fnames;

    /**
     * @return \Punction\Entities\Patient
	 */
    public static function getRandomPerson()
    {
        // TODO extract paths
        self::$names = Utils::readFileToArray(__DIR__ . '/../../resources/pl_names.csv');
        self::$mnames = Utils::readFileToArray(__DIR__ . '/../../resources/pl_mnames.csv');
        self::$fnames = Utils::readFileToArray(__DIR__ . '/../../resources/pl_fnames.csv');
        // var_dump(self::$mnames);
        $sex = (rand(0, 1) == 0 ? 'm' : 'f');
        $firstname = ($sex == 'm' ? self::getRandom(self::$mnames) : self::getRandom(self::$fnames));
        $lastname = self::getRandom(self::$names);
        if ($sex == 'f' && self::endsWith($lastname, 'i')) {
            $lastname = rtrim($lastname, "i") . 'a';
        }
        $bdate = self::getRandomBirthDate();
        $pesel = self::getRandomPesel($bdate, $sex);
        return $firstname . ' ' . $lastname . '|' . $pesel;
    }

    /**
     * @param unknown $haystack
     * @param unknown $needle
     * @return boolean
     */
    static function endsWith($haystack, $needle)
    {
        return $needle === "" || substr($haystack, - strlen($needle)) === $needle;
    }

    /**
     * @return random date 
     */
    public static function getRandomBirthDate()
    {
        $age = rand(0, 100);
        $dayOfYear = rand(0, 365);
        $interval = new \DateInterval('P' . $age . 'Y' . $dayOfYear . 'D');
        $date = new \DateTime();
        $birth = $date->sub($interval);
        return $birth->format('Y-m-d');
    }

    /**
	 *
	 * @param $date        	
	 * @param $sex
	 *        	'm' / 'f'
	 */
    public static function getRandomPesel($date, $sex = 'm')
    {
        $datetime = new \DateTime($date);
        $y = (int) $datetime->format('y');
        $Y = (int) $datetime->format('Y');
        $m = (int) $datetime->format('m');
        $d = (int) $datetime->format('d');
        if ($Y >= 2000) {
            $m += 20;
        }
        $sexNum = ($sex == 'f' ? rand(0, 4) * 2 : rand(0, 4) * 2 + 1);
        $x = sprintf('%02d%02d%02d%03d%d', $y, $m, $d, rand(0, 999), $sexNum);
        $arrSteps = array(
            1,
            3,
            7,
            9,
            1,
            3,
            7,
            9,
            1,
            3
        ); // tablica z odpowiednimi wagami
        $intSum = 0;
        for ($i = 0; $i < 10; $i ++) {
            $intSum += $arrSteps[$i] * $x[$i]; // mnożymy każdy ze znaków
                                                   // przez wagć i sumujemy
                                                   // wszystko
        }
        $int = 10 - $intSum % 10; // obliczamy sumć kontrolną
        $intControlNr = ($int == 10) ? 0 : $int;
        $x .= $intControlNr;
        return $x;
    }

    /**
     * random element frmo array
     * 
     * @param unknown $arr
     * @return string random element
	 */
    public static function getRandom($arr)
    {
        return implode('', $arr[array_rand($arr)]);
    }
}

