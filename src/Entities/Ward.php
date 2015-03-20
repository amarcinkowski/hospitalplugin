<?php
/**
 * Ward
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

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Ward
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
 * @Table(name="hospital_ward",
 * options={"collate"="utf8_polish_ci", "charset"="utf8", "engine"="MyISAM"},
 * indexes={@index(name="name_idx", columns={"name"})})
 */
class Ward
{

    /**
     * id
     * @Id @Column(type="integer") @GeneratedValue
     */
    public $id;

    /**
     * name
     * @Column(type="string") *
     */
    protected $name;

    /**
     * TODO dodac:
     * konta: [{ id: '0', account: brak }]
     * lokalizacje: [{ adres: 'Poznańska 79', kondygnacja: '0', odcinek: '' }]
     */
    
    /**
     * @Column(type="string") *
     */
    protected $infomedica;

    /**
         * @Column(type="string") *
         */
    protected $komorkaOrg;

    /**
         * @Column(type="string") *
         */
    protected $kierownik;

    /**
         * @Column(type="string") *
         */
    protected $typOddzialu;

    /**
     * @Column(type="integer") *
     */
    protected $pododdzial;

    /**
     * @Column(type="string") *
     */
    protected $adres;

    /**
     * @Column(type="string") *
     */
    protected $kondygnacja;

    /**
     * @Column(type="string") *
     */
    protected $odcinek;

    /**
     * @Column(type="string", length=5000) *
     */
    protected $opis;

    /**
     * @OneToMany(targetEntity="Hospitalplugin\Entities\User", mappedBy="ward")
     **/
    private $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    /**
     * toString
     * @return string
     */
    public function toString()
    {
        return $this->getName();
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function getInfomedica()
    {
        return $this->infomedica;
    }

    public function setInfomedica($infomedica)
    {
        $this->infomedica = $infomedica;
        return $this;
    }

    public function getKomorkaOrg()
    {
        return $this->komorkaOrg;
    }

    public function setKomorkaOrg($komorkaOrg)
    {
        $this->komorkaOrg = $komorkaOrg;
        return $this;
    }

    public function getKierownik()
    {
        return $this->kierownik;
    }

    public function setKierownik($kierownik)
    {
        $this->kierownik = $kierownik;
        return $this;
    }

    public function getTypOddzialu()
    {
        return $this->typOddzialu;
    }

    public function setTypOddzialu($typOddzialu)
    {
        $this->$typOddzialu = $typOddzialu;
        return $this;
    }

    public function getPododdzial()
    {
        return $this->pododdzial;
    }

    public function setPododdzial($pododdzial)
    {
        $this->pododdzial = $pododdzial;
        return $this;
    }

    public function getAdres()
    {
        return $this->adres;
    }

    public function setAdres($adres)
    {
        $this->adres = $adres;
        return $this;
    }

    public function getKondygnacja()
    {
        return $this->kondygnacja;
    }

    public function setKondygnacja($kondygnacja)
    {
        $this->kondygnacja = $kondygnacja;
        return $this;
    }

    public function getOdcinek()
    {
        return $this->odcinek;
    }

    public function setOdcinek($odcinek)
    {
        $this->odcinek = $odcinek;
        return $this;
    }

    public function getOpis()
    {
        return $this->opis;
    }

    public function setOpis($opis)
    {
        $this->opis = $opis;
        return $this;
    }
}


