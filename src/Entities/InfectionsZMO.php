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
 *        @Table(name="epidemio_infections_monthly",
 *        options={"collate"="utf8_polish_ci", "charset"="utf8", "engine"="MyISAM"},
 *        indexes={
 *        @index(name="dataRaportu_idx", columns={"dataRaportu"}),
 *        @index(name="oddzialId_idx", columns={"oddzialId"}),
 *        @index(name="userId_idx", columns={"userId"})})
 */
class InfectionsZMO extends InfectionRaport{
	
	/**
	 * @Column(columnDefinition="DECIMAL(4,0) NOT NULL DEFAULT 0") *
	 */
	public $LKZMO;
	
	/**
	 * @Column(columnDefinition="DECIMAL(4,0) NOT NULL DEFAULT 0") *
	 */
	public $ZMO1;
	
	/**
	 * @Column(columnDefinition="DECIMAL(4,0) NOT NULL DEFAULT 0") *
	 */
	public $ZMO2;
	
	/**
	 * @Column(columnDefinition="DECIMAL(4,0) NOT NULL DEFAULT 0") *
	 */
	public $ZMO3;
	
	/**
	 * @Column(columnDefinition="DECIMAL(4,0) NOT NULL DEFAULT 0") *
	 */
	public $ZMO4;
	
	/**
	 * @Column(columnDefinition="DECIMAL(4,0) NOT NULL DEFAULT 0") *
	 */
	public $BM;
	
	/**
	 * @Column(columnDefinition="DECIMAL(4,0) NOT NULL DEFAULT 0") *
	 */
	public $PH;

	public function getLKZMO() {
		return $this->LKZMO;
	}
	public function setLKZMO($LKZMO) {
		$this->LKZMO = $LKZMO;
		return $this;
	}
	public function getZMO1() {
		return $this->ZMO1;
	}
	public function setZMO1($ZMO1) {
		$this->ZMO1 = $ZMO1;
		return $this;
	}
	public function getZMO2() {
		return $this->ZMO2;
	}
	public function setZMO2($ZMO2) {
		$this->ZMO2 = $ZMO2;
		return $this;
	}
	public function getZMO3() {
		return $this->ZMO3;
	}
	public function setZMO3($ZMO3) {
		$this->ZMO3 = $ZMO3;
		return $this;
	}
	public function getZMO4() {
		return $this->ZMO4;
	}
	public function setZMO4($ZMO4) {
		$this->ZMO4 = $ZMO4;
		return $this;
	}
	public function getBM() {
		return $this->BM;
	}
	public function setBM($BM) {
		$this->BM = $BM;
		return $this;
	}
	public function getPH() {
		return $this->PH;
	}
	public function setPH($PH) {
		$this->PH = $PH;
		return $this;
	}
	
	
}
