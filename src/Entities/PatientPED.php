<?php
/**
 * PatientPED
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
 * PatientPED
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
class PatientPED extends Patient
{

    /**
     * @var string $typ typ pacjenta
     */
    protected $typ = "PED";

    /**
     * @Column(columnDefinition="TINYINT(4) DEFAULT 0")
     */
    public $aktywnoscFizyczna;

    /**
     * @Column(columnDefinition="TINYINT(4) DEFAULT 0")
     */
    public $higiena;

    /**
     * @Column(columnDefinition="TINYINT(4) DEFAULT 0")
     */
    public $karmienieIOdzywianie;

    /**
     * @Column(columnDefinition="TINYINT(4) DEFAULT 0")
     */
    public $wydalanie;

    /**
     * @Column(columnDefinition="TINYINT(4) DEFAULT 0")
     */
    public $pomiarParametrowZyciowych;

    /**
     * @Column(columnDefinition="TINYINT(4) DEFAULT 0")
     */
    public $leczenie;

    /**
     * @Column(columnDefinition="TINYINT(4) DEFAULT 0")
     */
    public $edukacjaZdrowotnaOrazWsparcieDzieckaIRodzicow;

    /**
     * getaktywnoscFizyczna
     * 
     * @return aktywnoscFizyczna int
     */
    public function getAktywnoscFizyczna()
    {
        return $this->aktywnoscFizyczna;
    }

    /**
     * setaktywnoscFizyczna
     * 
     * @param int $aktywnoscFizyczna aktywnosc fizyczna
     * 
     * @return PatientPED
     */
    public function setAktywnoscFizyczna($aktywnoscFizyczna)
    {
        $this->aktywnoscFizyczna = $aktywnoscFizyczna;
        return $this;
    }

    /**
     * getHigiena
     * 
     * @return Higiena int Higiena
     */
    public function getHigiena()
    {
        return $this->higiena;
    }

    /**
     * setHigiena
     * 
     * @param int $Higiena int higiena
     * 
     * @return PatientPED
     */
    public function setHigiena($higiena)
    {
        $this->higiena = $higiena;
        return $this;
    }

    /**
     * getKarmienieIOdzywianie
     * 
     * @return KarmienieIOdzywianie
     */
    public function getKarmienieIOdzywianie()
    {
        return $this->karmienieIOdzywianie;
    }

    /**
     * setKarmienieIOdzywianie
     * 
     * @param int $KarmienieIOdzywianie itn karmienieIOdzywianie
     * 
     * @return PatientPED
     */
    public function setKarmienieIOdzywianie($karmienieIOdzywianie)
    {
        $this->karmienieIOdzywianie = $karmienieIOdzywianie;
        return $this;
    }

    /**
     * getWydalanie
     * 
     * @return Wydalanie
     */
    public function getWydalanie()
    {
        return $this->wydalanie;
    }

    /**
     * PatientPED
     * 
     * @param int $Wydalanie Wydalanie
     * 
     * @return PatientPED
     */
    public function setWydalanie($wydalanie)
    {
        $this->wydalanie = $wydalanie;
        return $this;
    }

    /**
     * getPomiarParametrowZyciowych
     * 
     * @return PomiarParametrowZyciowych
     */
    public function getPomiarParametrowZyciowych()
    {
        return $this->pomiarParametrowZyciowych;
    }

    /**
     * setPomiarParametrowZyciowych
     * 
     * @param int $PomiarParametrowZyciowych int PomiarParametrowZyciowych
     * 
     * @return PatientPED
     */
    public function setPomiarParametrowZyciowych($pomiarParametrowZyciowych)
    {
        $this->pomiarParametrowZyciowych = $pomiarParametrowZyciowych;
        return $this;
    }

    /**
     * getLeczenie
     * 
     * @return Leczenie
     */
    public function getLeczenie()
    {
        return $this->leczenie;
    }

    /**
     * setLeczenie
     * 
     * @param int $Leczenie int Leczenie
     * 
     * @return PatientPED
     */
    public function setLeczenie($Leczenie)
    {
        $this->leczenie = $Leczenie;
        return $this;
    }

    /**
     * getEdukacjaZdrowotnaOrazWsparcieDzieckaIRodzicow
     * 
     * @return EdukacjaZdrowotnaOrazWsparcieDzieckaIRodzicow
     */
    public function getEdukacjaZdrowotnaOrazWsparcieDzieckaIRodzicow()
    {
        return $this->edukacjaZdrowotnaOrazWsparcieDzieckaIRodzicow;
    }

    /**
     * setEdukacjaZdrowotnaOrazWsparcieDzieckaIRodzicow
     * 
     * @param int $EdukacjaZdrowotnaOrazWsparcieDzieckaIRodzicow int ezowdir
     * 
     * @return PatientPED
     */
    public function setEdukacjaZdrowotnaOrazWsparcieDzieckaIRodzicow($EdukacjaZdrowotnaOrazWsparcieDzieckaIRodzicow)
    {
        $this->edukacjaZdrowotnaOrazWsparcieDzieckaIRodzicow = $EdukacjaZdrowotnaOrazWsparcieDzieckaIRodzicow;
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
            "karmienieIOdzywianie",
            "wydalanie",
            "pomiarParametrowZyciowych",
            "leczenie",
            "edukacjaZdrowotnaOrazWsparcieDzieckaIRodzicow"
        ));
        return $fields;
    }
}
