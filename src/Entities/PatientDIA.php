<?php
/**
 * PatientZZ
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
 * @version   1.0  $Format:%H$
 * @link      http://
 * @since     File available since Release 1.0.0
 * PHP Version 5
 */
namespace Hospitalplugin\Entities;

/**
 * PatientZZ
 *
 * @category  Wp
 * @package   Punction
 * @author    Andrzej Marcinkowski <andrzej.max.marcinkowski@gmail.com>
 * @copyright 2014 Wojewódzki Szpital Zespolony, Kalisz
 * @license   MIT http://opensource.org/licenses/MIT
 * @version   1.0  $Format:%H$
 * @link      http://
 * @since     File available since Release 1.0.0
 *      
 * @Entity
 */
class PatientDIA extends Patient
{

    /**
     * @var string $typ typ pacjenta
     */
    protected $typ = "DIA";

    /**
     * @Column(columnDefinition="TINYINT(4) DEFAULT 0") *
     */
    public $aktywnoscFizyczna;

    /**
     * @Column(columnDefinition="TINYINT(4) DEFAULT 0") *
     */
    public $higiena;

    /**
     * @Column(columnDefinition="TINYINT(4) DEFAULT 0") *
     */
    public $odzywianie;

    /**
     * @Column(columnDefinition="TINYINT(4) DEFAULT 0") *
     */
    public $wydalanie;

    /**
     * @Column(columnDefinition="TINYINT(4) DEFAULT 0") *
     */
    public $pomiarParametrowZyciowych;

    /**
     * @Column(columnDefinition="TINYINT(4) DEFAULT 0") *
     */
    public $leczenie;

    /**
     * @Column(columnDefinition="TINYINT(4) DEFAULT 0") *
     */
    public $edukacjaZdrowotnaIOpiekaPsychospoleczna;
    //
    /**
     * @return aktywnoscFizyczna
     */
    public function getAktywnoscFizyczna()
    {
        return $this->aktywnoscFizyczna;
    }

    /**
     * @param int $aktywnoscFizyczna int aktywnoscFizyczna
     * @return PatientZZ
     */
    public function setAktywnoscFizyczna($aktywnoscFizyczna)
    {
        $this->aktywnoscFizyczna = $aktywnoscFizyczna;
        return $this;
    }

    /**
     * @return higiena
     */
    public function getHigiena()
    {
        return $this->higiena;
    }

    /**
     * @param int $higiena int higiena
     * @return PatientZZ
     */
    public function setHigiena($higiena)
    {
        $this->higiena = $higiena;
        return $this;
    }

    /**
     * @return odzywianie
     */
    public function getOdzywianie()
    {
        return $this->odzywianie;
    }

    /**
     * @param  int $odzywianie int odzywianie
     * @return PatientZZ
     */
    public function setOdzywianie($odzywianie)
    {
        $this->odzywianie = $odzywianie;
        return $this;
    }

    /**
     * @return wydalanie
     */
    public function getWydalanie()
    {
        return $this->wydalanie;
    }

    /**
     * @param  int $wydalanie int wydalanie
     * @return PatientZZ
     */
    public function setWydalanie($wydalanie)
    {
        $this->wydalanie = $wydalanie;
        return $this;
    }

    /**
     * @return pomiarParametrowZyciowych
     */
    public function getPomiarParametrowZyciowych()
    {
        return $this->pomiarParametrowZyciowych;
    }

    /**
     * @param  int $pomiarParametrowZyciowych int pomiarParametrowZyciowych
     * @return PatientZZ
     */
    public function setPomiarParametrowZyciowych($pomiarParametrowZyciowych)
    {
        $this->pomiarParametrowZyciowych = $pomiarParametrowZyciowych;
        return $this;
    }

    /**
     * @return leczenie
     */
    public function getLeczenie()
    {
        return $this->leczenie;
    }

    /**
     * @param  int $leczenie int leczenie
     * @return PatientZZ
     */
    public function setLeczenie($leczenie)
    {
        $this->leczenie = $leczenie;
        return $this;
    }

    /**
     * @return $edukacjaZdrowotnaIOpiekaPsychospoleczna
     */
    public function getEdukacjaZdrowotnaIOpiekaPsychospoleczna()
    {
        return $this->edukacjaZdrowotnaIOpiekaPsychospoleczna;
    }

    /**
     * @param  int $edukacjaZdrowotnaIOpiekaPsychospoleczna int edukacjaZdrowotnaIOpiekaPsychospoleczna
     * @return PatientZZ
     */
    public function setEdukacjaZdrowotnaIOpiekaPsychospoleczna($edukacjaZdrowotnaIOpiekaPsychospoleczna)
    {
        $this->edukacjaZdrowotnaIOpiekaPsychospoleczna = $edukacjaZdrowotnaIOpiekaPsychospoleczna;
        return $this;
    }

    /**
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
            "edukacjaZdrowotnaIOpiekaPsychospoleczna"
        ));
        return $fields;
    }

}
