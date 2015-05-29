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
 *        @Entity
 *        @Table(name="epidemio_infections_zum",
 *        options={"collate"="utf8_polish_ci", "charset"="utf8", "engine"="MyISAM"},
 *        indexes={
 *        @index(name="dataRaportu_idx", columns={"dataRaportu"}),
 *        @index(name="oddzialId_idx", columns={"oddzialId"}),
 *        @index(name="userId_idx", columns={"userId"})})
 */
class InfectionsZUM extends InfectionRaport {
	
	/**
	 * @Column(columnDefinition="DECIMAL(4,0) NOT NULL DEFAULT 0") *
	 */
	public $LPKZUM;
	
	/**
	 * @Column(columnDefinition="DECIMAL(4,0) NOT NULL DEFAULT 0") *
	 */
	public $LPZUM;
	
	/**
	 * @Column(columnDefinition="DECIMAL(4,0) NOT NULL DEFAULT 0") *
	 */
	public $LPZUM1;
	
	/**
	 * @Column(columnDefinition="DECIMAL(4,0) NOT NULL DEFAULT 0") *
	 */
	public $LPZUM2;
	
	/**
	 * @Column(columnDefinition="DECIMAL(4,0) NOT NULL DEFAULT 0") *
	 */
	public $BM;
	
	public function getLPKZUM() {
		return $this->LPKZUM;
	}
	public function setLPKZUM($LPKZUM) {
		$this->LPKZUM = $LPKZUM;
		return $this;
	}
	
	public function getLPZUM() {
		return $this->LPZUM;
	}
	public function setLPZUM($LPZUM) {
		$this->LPZUM = $LPZUM;
		return $this;
	}
	
	public function getLPZUM1() {
		return $this->LPZUM1;
	}
	public function setLPZUM1($LPZUM1) {
		$this->LPZUM1 = $LPZUM1;
		return $this;
	}
	
	public function getLPZUM2() {
		return $this->LPZUM2;
	}
	public function setLPZUM2($LPZUM2) {
		$this->LPZUM2 = $LPZUM2;
		return $this;
	}
	
	public function getBM() {
		return $this->BM;
	}
	public function setBM($BM) {
		$this->BM = $BM;
		return $this;
	}
	
	
	
	
}
