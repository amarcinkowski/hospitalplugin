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

/**
 * User
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
 * @Table(name="hospital_user",
 * options={"collate"="utf8_polish_ci", "charset"="utf8", "engine"="MyISAM"},
 * indexes={@index(name="name_idx", columns={"name"})})
 */
class User
{

    /**
     * id
     * @Id @Column(type="integer") @GeneratedValue
     */
    protected $id;

    /**
     * name
     * @Column(type="string")
     */
    protected $name;

    /**
     * @ManyToOne(targetEntity="Hospitalplugin\Entities\Ward", inversedBy="users")
     * @JoinColumn(name="ward_id", referencedColumnName="id")
     **/
    private $ward;

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

    public function getWard()
    {
        return $this->ward;
    }

    public function setWard($ward)
    {
        $this->ward = $ward;
        return $this;
    }
 

    
}


