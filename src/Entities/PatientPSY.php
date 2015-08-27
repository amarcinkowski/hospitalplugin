<?php
/**
 * PatientPSY
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
 * @version   1.0 $Format:%H$
 * @link      http://
 * @since     File available since Release 1.0.0
 * PHP Version 5
 */
namespace Hospitalplugin\Entities;

/**
 * PatientPSY
 *
 * @category  Wp
 * @package   Punction
 * @author    Andrzej Marcinkowski <andrzej.max.marcinkowski@gmail.com>
 * @copyright 2014 Wojewódzki Szpital Zespolony, Kalisz
 * @license   MIT http://opensource.org/licenses/MIT
 * @version   1.0 $Format:%H$
 * @link      http://
 * @since     File available since Release 1.0.0
 *
 * @Entity
 */
class PatientPSY extends Patient
{

    /**
     * @var string $typ typ pacjenta
     */
    public $typ = "PSY";

    /** @Column(columnDefinition="TINYINT(4) DEFAULT 0") */
    public $aktywnoscFizyczna;

    /** @Column(columnDefinition="TINYINT(4) DEFAULT 0") */
    public $higiena;

    /** @Column(columnDefinition="TINYINT(4) DEFAULT 0") */
    public $odzywianie;

    /** @Column(columnDefinition="TINYINT(4) DEFAULT 0") */
    public $wydalanie;

    /** @Column(columnDefinition="TINYINT(4) DEFAULT 0") */
    public $pomiarParametrowZyciowych;

    /** @Column(columnDefinition="TINYINT(4) DEFAULT 0") */
    public $leczenie;

    /** @Column(columnDefinition="TINYINT(4) DEFAULT 0") */
    public $edukacjaIWsparciePsychiczne;

    /** @Column(columnDefinition="TINYINT(4) DEFAULT 0") */
    public $zachowaniaAgresywne;

    /** @Column(columnDefinition="TINYINT(4) DEFAULT 0") */
    public $dezorganizacjaZachowania;

    /** @Column(columnDefinition="TINYINT(4) DEFAULT 0") */
    public $napedPsychoruchowy;

    /** @Column(columnDefinition="TINYINT(4) DEFAULT 0") */
    public $depresja;

    /** @Column(columnDefinition="TINYINT(4) DEFAULT 0") */
    public $mysliSamobojcze;

    /** @Column(columnDefinition="TINYINT(4) DEFAULT 0") */
    public $objawyPsychotyczne;

    /** @Column(columnDefinition="TINYINT(4) DEFAULT 0") */
    public $swiadomosc;

    /** @Column(columnDefinition="TINYINT(4) DEFAULT 0") */
    public $udzialWTerapii;

    public function getTyp()
    {
        return $this->typ;
    }

    public function setTyp($typ)
    {
        $this->typ = $typ;
        return $this;
    }

    public function getAktywnoscFizyczna()
    {
        return $this->aktywnoscFizyczna;
    }

    public function setAktywnoscFizyczna($aktywnoscFizyczna)
    {
        $this->aktywnoscFizyczna = $aktywnoscFizyczna;
        return $this;
    }

    public function getHigiena()
    {
        return $this->higiena;
    }

    public function setHigiena($higiena)
    {
        $this->higiena = $higiena;
        return $this;
    }

    public function getOdzywianie()
    {
        return $this->odzywianie;
    }

    public function setOdzywianie($odzywianie)
    {
        $this->odzywianie = $odzywianie;
        return $this;
    }

    public function getWydalanie()
    {
        return $this->wydalanie;
    }

    public function setWydalanie($wydalanie)
    {
        $this->wydalanie = $wydalanie;
        return $this;
    }

    public function getPomiarParametrowZyciowych()
    {
        return $this->pomiarParametrowZyciowych;
    }

    public function setPomiarParametrowZyciowych($pomiarParametrowZyciowych)
    {
        $this->pomiarParametrowZyciowych = $pomiarParametrowZyciowych;
        return $this;
    }

    public function getLeczenie()
    {
        return $this->leczenie;
    }

    public function setLeczenie($leczenie)
    {
        $this->leczenie = $leczenie;
        return $this;
    }

    public function getEdukacjaIWsparciePsychiczne()
    {
        return $this->edukacjaIWsparciePsychiczne;
    }

    public function setEdukacjaIWsparciePsychiczne($edukacjaZdrowotnaIWsparciePsychiczne)
    {
        $this->edukacjaIWsparciePsychiczne = $edukacjaZdrowotnaIWsparciePsychiczne;
        return $this;
    }

    public function getZachowaniaAgresywne()
    {
        return $this->zachowaniaAgresywne;
    }

    public function setZachowaniaAgresywne($zachowaniaAgresywne)
    {
        $this->zachowaniaAgresywne = $zachowaniaAgresywne;
        return $this;
    }

    public function getDezorganizacjaZachowania()
    {
        return $this->dezorganizacjaZachowania;
    }

    public function setDezorganizacjaZachowania($dezorganizacjaZachowania)
    {
        $this->dezorganizacjaZachowania = $dezorganizacjaZachowania;
        return $this;
    }

    public function getNapedPsychoruchowy()
    {
        return $this->napedPsychoruchowy;
    }

    public function setNapedPsychoruchowy($napedPsychoruchowy)
    {
        $this->napedPsychoruchowy = $napedPsychoruchowy;
        return $this;
    }

    public function getDepresja()
    {
        return $this->depresja;
    }

    public function setDepresja($depresja)
    {
        $this->depresja = $depresja;
        return $this;
    }

    public function getMysliSamobojcze()
    {
        return $this->mysliSamobojcze;
    }

    public function setMysliSamobojcze($mysliSamobojcze)
    {
        $this->mysliSamobojcze = $mysliSamobojcze;
        return $this;
    }

    public function getObjawyPsychotyczne()
    {
        return $this->objawyPsychotyczne;
    }

    public function setObjawyPsychotyczne($objawyPsychotyczne)
    {
        $this->objawyPsychotyczne = $objawyPsychotyczne;
        return $this;
    }

    public function getSwiadomosc()
    {
        return $this->swiadomosc;
    }

    public function setSwiadomosc($swiadomosc)
    {
        $this->swiadomosc = $swiadomosc;
        return $this;
    }

    public function getUdzialWTerapii()
    {
        return $this->udzialWTerapii;
    }

    public function setUdzialWTerapii($udzialWTerapii)
    {
        $this->udzialWTerapii = $udzialWTerapii;
        return $this;
    }

    /**
     * getFields
     *
     * @return multitype:string
     */
    public static function getFields()
    {
        $superFields = parent::getFields();
        $fields = array_merge($superFields, array(
            "aktywnoscFizyczna",
            "higiena",
            "odzywianie",
            "wydalanie",
            "pomiarParametrowZyciowych",
            "leczenie",
            "edukacjaIWsparciePsychiczne",
            "zachowaniaAgresywne",
            "dezorganizacjaZachowania",
            "napedPsychoruchowy",
            "depresja",
            "mysliSamobojcze",
            "objawyPsychotyczne",
            "swiadomosc",
            "udzialWTerapii"
        ));
        return $fields;
    }
}
