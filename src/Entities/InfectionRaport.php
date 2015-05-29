<?php

/**
 * Patient
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
 * @version   1.0 $Id: 5e3d6d9fad27385cb557282c244e0767bf6c41e0 $ $Format:%H$
 * @link      http://
 * @since     File available since Release 1.0.0
 * PHP Version 5
 */
namespace Hospitalplugin\Entities;

/**
 * Infections
 *
 * @category Wp
 * @package Epidemio
 * @author Andrzej Marcinkowski <andrzej.max.marcinkowski@gmail.com>
 * @copyright 2014 Wojewódzki Szpital Zespolony, Kalisz
 * @license MIT http://opensource.org/licenses/MIT
 * @version 1.0 $Id: 5e3d6d9fad27385cb557282c244e0767bf6c41e0 $ $Format:%H$
 * @link http://
 * @since File available since Release 1.0.0
 *       
 */
class InfectionRaport {
	
	/**
	 * id
	 * @Id @Column(type="integer") @GeneratedValue
	 */
	public $id;
	
	/**
	 * $dataRaportu datetime
	 * @Column(type="datetime") *
	 */
	public $dataRaportu;
	
	/**
	 * $dataPrzeslania datetime
	 * @Column(type="datetime") *
	 */
	public $dataPrzeslania;
	
	/**
	 * @ManyToOne(targetEntity="Hospitalplugin\Entities\Ward")
	 * @JoinColumn(name="oddzialId", referencedColumnName="id")
	 */
	public $ward;
	
	/**
	 * @ManyToOne(targetEntity="Hospitalplugin\Entities\User")
	 * @JoinColumn(name="userId", referencedColumnName="id")
	 */
	protected $user;
	
	function __construct($args) {
		foreach ( $args as $key => $value ) {
			if ($key == 'dataRaportu') {
				$value = new \DateTime ( $value );
			} 
			call_user_func ( array (
					$this,
					'set' . $key 
			), $value );
		}
		$this->dataPrzeslania = new \DateTime ();
		echo '<h3><div class="alert alert-primary">Dziękuję za przesłanie raportu!</div></h3>';
	}
	
	/**
	 * getId
	 *
	 * @return id
	 */
	public function getId() {
		return $this->id;
	}
	
	/**
	 * sets id
	 *
	 * @param int $id
	 *        	ID
	 *        	
	 * @return \Punction\Entities\Patient
	 */
	public function setId($id) {
		$this->id = $id;
		return $this;
	}
	
	/**
	 * toString
	 *
	 * @return string
	 */
	public function toString() {
		$txt = $this->getId ();
		$data = $this->getDataRaportu ();
		if ($data instanceof \DateTime) {
			$txt .= $this->getDataRaportu ()->format ( "Y-m-d" );
		} else {
			$txt .= $this->getDataRaportu ();
		}
		return $txt;
	}
	public function getDataRaportu() {
		return $this->dataRaportu;
	}
	public function setDataRaportu($dataRaportu) {
		$this->dataRaportu = $dataRaportu;
		return $this;
	}
	
	public function getDataPrzeslania() {
		return $this->dataPrzeslania;
	}
	public function setDataPrzeslania($dataPrzeslania) {
		$this->dataPrzeslania = $dataPrzeslania;
		return $this;
	}
	public function getWard() {
		return $this->ward;
	}
	public function setWard($ward) {
		$this->ward = $ward;
		return $this;
	}
	public function getUser() {
		return $this->user;
	}
	public function setUser($user) {
		$this->user = $user;
		return $this;
	}
	
	
}
