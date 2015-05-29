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
 *        @Table(name="epidemio_infections_zodc",
 *        options={"collate"="utf8_polish_ci", "charset"="utf8", "engine"="MyISAM"},
 *        indexes={
 *        @index(name="dataRaportu_idx", columns={"dataRaportu"}),
 *        @index(name="oddzialId_idx", columns={"oddzialId"}),
 *        @index(name="userId_idx", columns={"userId"})})
 */
class InfectionsZODC extends InfectionRaport {
	
	/**
	 * @Column(columnDefinition="DECIMAL(4,0) NOT NULL DEFAULT 0") *
	 */
	public $LDZ;

	/**
	 * @Column(columnDefinition="DECIMAL(4,0) NOT NULL DEFAULT 0") *
	 */
	public $LDKZ;

	/**
	 * @Column(columnDefinition="DECIMAL(4,0) NOT NULL DEFAULT 0") *
	 */
	public $PDOZ;
	
	/**
	 * @Column(columnDefinition="DECIMAL(4,0) NOT NULL DEFAULT 0") *
	 */
	public $LDCZ;
		
	/**
	 * @Column(columnDefinition="DECIMAL(4,0) NOT NULL DEFAULT 0") *
	 */
	public $LDKCZ;
		
	/**
	 * @Column(columnDefinition="DECIMAL(4,0) NOT NULL DEFAULT 0") *
	 */
	public $PDCZ;
		
	/**
	 * @Column(columnDefinition="DECIMAL(4,0) NOT NULL DEFAULT 0") *
	 */
	public $LDD;
		
	/**
	 * @Column(columnDefinition="DECIMAL(4,0) NOT NULL DEFAULT 0") *
	 */
	public $LDKD;
		
	/**
	 * @Column(columnDefinition="DECIMAL(4,0) NOT NULL DEFAULT 0") *
	 */
	public $PDD;
		
	/**
	 * @Column(columnDefinition="DECIMAL(4,0) NOT NULL DEFAULT 0") *
	 */
	public $LDT;
		
	/**
	 * @Column(columnDefinition="DECIMAL(4,0) NOT NULL DEFAULT 0") *
	 */
	public $LDKT;
		
	/**
	 * @Column(columnDefinition="DECIMAL(4,0) NOT NULL DEFAULT 0") *
	 */
	public $PDT;
		
	/**
	 * @Column(columnDefinition="DECIMAL(4,0) NOT NULL DEFAULT 0") *
	 */
	public $BM;
	
	public function getLDZ() {
		return $this->LDZ;
	}
	public function setLDZ($LDZ) {
		$this->LDZ = $LDZ;
		return $this;
	}
	
	
	public function getLDKZ() {
		return $this->LDKZ;
	}
	public function setLDKZ($LDKZ) {
		$this->LDKZ = $LDKZ;
		return $this;
	}
	
	public function getPDOZ() {
		return $this->PDOZ;
	}
	public function setPDOZ($PDOZ) {
		$this->PDOZ = $PDOZ;
		return $this;
	}
	
	
	public function getLDCZ() {
		return $this->LDCZ;
	}
	public function setLDCZ($LDCZ) {
		$this->LDCZ = $LDCZ;
		return $this;
	}
	
	
	public function getLDKCZ() {
		return $this->LDKCZ;
	}
	public function setLDKCZ($LDKCZ) {
		$this->LDKCZ = $LDKCZ;
		return $this;
	}
	
	
	public function getPDCZ() {
		return $this->PDCZ;
	}
	public function setPDCZ($PDCZ) {
		$this->PDCZ = $PDCZ;
		return $this;
	}
	
	
	public function getLDD() {
		return $this->LDD;
	}
	public function setLDD($LDD) {
		$this->LDD = $LDD;
		return $this;
	}
	
	
	public function getLDKD() {
		return $this->LDKD;
	}
	public function setLDKD($LDKD) {
		$this->LDKD = $LDKD;
		return $this;
	}
	
	
	public function getPDD() {
		return $this->PDD;
	}
	public function setPDD($PDD) {
		$this->PDD = $PDD;
		return $this;
	}
	
	
	public function getLDT() {
		return $this->LDT;
	}
	public function setLDT($LDT) {
		$this->LDT = $LDT;
		return $this;
	}
	
	
	public function getLDKT() {
		return $this->LDKT;
	}
	public function setLDKT($LDKT) {
		$this->LDKT = $LDKT;
		return $this;
	}
	
	
	public function getPDT() {
		return $this->PDT;
	}
	public function setPDT($PDT) {
		$this->PDT = $PDT;
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
