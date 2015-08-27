<?php

/**
 * PatientPOR
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
 * PatientPOR
 *
 * @category Wp
 * @package Punction
 * @author Andrzej Marcinkowski <andrzej.max.marcinkowski@gmail.com>
 * @copyright 2014 Wojewódzki Szpital Zespolony, Kalisz
 * @license MIT http://opensource.org/licenses/MIentT
 * @version 1.0 $Format:%H$
 * @link http://
 * @since File available since Release 1.0.0
 *    
 *     @Entity
 */
class PatientPOR extends Patient {
	
	/*
	 * I Ciąża;
	 * I Wywiad;
	 * I Pozycja;
	 * I Higiena;
	 * I Dieta;
	 * I Pomiar parametrów życiowych;
	 * I ASP;
	 * I Postęp porodu;
	 * I Wydalanie;
	 * I Pęcherz płodowy;
	 * I Ćwiczenia oddechowe;
	 * I Leki;
	 * I Edukacja zdrowotna i wsparcie psychiczne;
	 * II Czas;
	 * II Pozycja;
	 * II Czystość krocza;
	 * II Nacięcie;
	 * II Aktywność;
	 * II Higiena;
	 * II Dieta;
	 * II Pomiar parametrów życiowych;
	 * II ASP;
	 * II Wydalanie;
	 * II Leki;
	 * II Edukacja zdrowotna i wsparcie psychiczne;
	 * III Apgar;
	 * III Waga;
	 * III Kontakt;
	 * III Zabiegi;
	 * III Krwawienie;
	 * III Nacięcie;
	 * III Higiena;
	 * III Dieta;
	 * III Pomiar parametrów życiowych;
	 * III Wydalanie;
	 * III Leki;
	 * III Edukacja zdrowotna i wsparcie psychiczne;
	 * IV Obserwacja;
	 * IV Pomiar parametrów życiowych;
	 * IV Karmienie;
	 * IV Edukacja zdrowotna i wsparcie psychiczne;
	 */
	/**
	 *
	 * @var string $typ typ pacjenta
	 */
	protected $typ = "POR";
	
	/**
	 * @Column(columnDefinition="TINYINT(4) DEFAULT 0")
	 */
	public $iCiaza;
	
	/**
	 * @Column(columnDefinition="TINYINT(4) DEFAULT 0")
	 */
	public $iWywiad;
	/**
	 * @Column(columnDefinition="TINYINT(4) DEFAULT 0")
	 */
	public $iPozycja;
	/**
	 * @Column(columnDefinition="TINYINT(4) DEFAULT 0")
	 */
	public $iHigiena;
	/**
	 * @Column(columnDefinition="TINYINT(4) DEFAULT 0")
	 */
	public $iDieta;
	/**
	 * @Column(columnDefinition="TINYINT(4) DEFAULT 0")
	 */
	public $iPomiarParametrowZyciowych;
	/**
	 * @Column(columnDefinition="TINYINT(4) DEFAULT 0")
	 */
	public $iASP;
	/**
	 * @Column(columnDefinition="TINYINT(4) DEFAULT 0")
	 */
	public $iPostepPorodu;
	/**
	 * @Column(columnDefinition="TINYINT(4) DEFAULT 0")
	 */
	public $iWydalanie;
	/**
	 * @Column(columnDefinition="TINYINT(4) DEFAULT 0")
	 */
	public $iPecherzPlodowy;
	/**
	 * @Column(columnDefinition="TINYINT(4) DEFAULT 0")
	 */
	public $iCwiczeniaOddechowe;
	/**
	 * @Column(columnDefinition="TINYINT(4) DEFAULT 0")
	 */
	public $iLeki;
	/**
	 * @Column(columnDefinition="TINYINT(4) DEFAULT 0")
	 */
	public $iEdukacjaZdrowotnaIWsparciePsychiczne;
	/**
	 * @Column(columnDefinition="TINYINT(4) DEFAULT 0")
	 */
	public $iICzas;
	/**
	 * @Column(columnDefinition="TINYINT(4) DEFAULT 0")
	 */
	public $iIPozycja;
	/**
	 * @Column(columnDefinition="TINYINT(4) DEFAULT 0")
	 */
	public $iICzystoscKrocza;
	/**
	 * @Column(columnDefinition="TINYINT(4) DEFAULT 0")
	 */
	public $iINaciecie;
	/**
	 * @Column(columnDefinition="TINYINT(4) DEFAULT 0")
	 */
	public $iIAktywnosc;
	/**
	 * @Column(columnDefinition="TINYINT(4) DEFAULT 0")
	 */
	public $iIHigiena;
	/**
	 * @Column(columnDefinition="TINYINT(4) DEFAULT 0")
	 */
	public $iIDieta;
	/**
	 * @Column(columnDefinition="TINYINT(4) DEFAULT 0")
	 */
	public $iIPomiarParametrowZyciowych;
	/**
	 * @Column(columnDefinition="TINYINT(4) DEFAULT 0")
	 */
	public $iIASP;
	/**
	 * @Column(columnDefinition="TINYINT(4) DEFAULT 0")
	 */
	public $iIWydalanie;
	/**
	 * @Column(columnDefinition="TINYINT(4) DEFAULT 0")
	 */
	public $iILeki;
	/**
	 * @Column(columnDefinition="TINYINT(4) DEFAULT 0")
	 */
	public $iIEdukacjaZdrowotnaIWsparciePsychiczne;
	/**
	 * @Column(columnDefinition="TINYINT(4) DEFAULT 0")
	 */
	public $iIIApgar;
	/**
	 * @Column(columnDefinition="TINYINT(4) DEFAULT 0")
	 */
	public $iIIWaga;
	/**
	 * @Column(columnDefinition="TINYINT(4) DEFAULT 0")
	 */
	public $iIIKontakt;
	/**
	 * @Column(columnDefinition="TINYINT(4) DEFAULT 0")
	 */
	public $iIIZabiegi;
	/**
	 * @Column(columnDefinition="TINYINT(4) DEFAULT 0")
	 */
	public $iIIKrwawienie;
	/**
	 * @Column(columnDefinition="TINYINT(4) DEFAULT 0")
	 */
	public $iIINaciecie;
	/**
	 * @Column(columnDefinition="TINYINT(4) DEFAULT 0")
	 */
	public $iIIHigiena;
	/**
	 * @Column(columnDefinition="TINYINT(4) DEFAULT 0")
	 */
	public $iIIDieta;
	/**
	 * @Column(columnDefinition="TINYINT(4) DEFAULT 0")
	 */
	public $iIIPomiarParametrowZyciowych;
	/**
	 * @Column(columnDefinition="TINYINT(4) DEFAULT 0")
	 */
	public $iIIWydalanie;
	/**
	 * @Column(columnDefinition="TINYINT(4) DEFAULT 0")
	 */
	public $iIILeki;
	/**
	 * @Column(columnDefinition="TINYINT(4) DEFAULT 0")
	 */
	public $iIIEdukacjaZdrowotnaIWsparciePsychiczne;
	/**
	 * @Column(columnDefinition="TINYINT(4) DEFAULT 0")
	 */
	public $iVObserwacja;
	/**
	 * @Column(columnDefinition="TINYINT(4) DEFAULT 0")
	 */
	public $iVPomiarParametrowZyciowych;
	/**
	 * @Column(columnDefinition="TINYINT(4) DEFAULT 0")
	 */
	public $iVKarmienie;
	/**
	 * @Column(columnDefinition="TINYINT(4) DEFAULT 0")
	 */
	public $iVEdukacjaZdrowotnaIWsparciePsychiczne;
	
	
	
	
	
	
	
	
	
	
	/**
	 * getFields
	 *
	 * @return multitype:string
	 */
	public static function getFields() {
		$superFields = parent::getFields ();
		$fields = array_merge ( $superFields, array (
				"iCiaza",
				"iWywiad",
				"iPozycja",
				"iHigiena",
				"iDieta",
				"iPomiarParametrowZyciowych",
				"iASP",
				"iPostepPorodu",
				"iWydalanie",
				"iPecherzPlodowy",
				"iCwiczeniaOddechowe",
				"iLeki",
				"iEdukacjaZdrowotnaIWsparciePsychiczne",
				"iICzas",
				"iIPozycja",
				"iICzystoscKrocza",
				"iINaciecie",
				"iIAktywnosc",
				"iIHigiena",
				"iIDieta",
				"iIPomiarParametrowZyciowych",
				"iIASP",
				"iIWydalanie",
				"iILeki",
				"iIEdukacjaZdrowotnaIWsparciePsychiczne",
				"iIIApgar",
				"iIIWaga",
				"iIIKontakt",
				"iIIZabiegi",
				"iIIKrwawienie",
				"iIINaciecie",
				"iIIHigiena",
				"iIIDieta",
				"iIIPomiarParametrowZyciowych",
				"iIIWydalanie",
				"iIILeki",
				"iIIEdukacjaZdrowotnaIWsparciePsychiczne",
				"iVObserwacja",
				"iVPomiarParametrowZyciowych",
				"iVKarmienie",
				"iVEdukacjaZdrowotnaIWsparciePsychiczne" 
		) );
		return $fields;
	}
	public function getICiaza() {
		return $this->iCiaza;
	}
	public function setICiaza($iCiaza) {
		$this->iCiaza = $iCiaza;
		return $this;
	}
	public function getIWywiad() {
		return $this->iWywiad;
	}
	public function setIWywiad($iWywiad) {
		$this->iWywiad = $iWywiad;
		return $this;
	}
	public function getIPozycja() {
		return $this->iPozycja;
	}
	public function setIPozycja($iPozycja) {
		$this->iPozycja = $iPozycja;
		return $this;
	}
	public function getIHigiena() {
		return $this->iHigiena;
	}
	public function setIHigiena($iHigiena) {
		$this->iHigiena = $iHigiena;
		return $this;
	}
	public function getIDieta() {
		return $this->iDieta;
	}
	public function setIDieta($iDieta) {
		$this->iDieta = $iDieta;
		return $this;
	}
	public function getIPomiarParametrowZyciowych() {
		return $this->iPomiarParametrowZyciowych;
	}
	public function setIPomiarParametrowZyciowych($iPomiarParametrowZyciowych) {
		$this->iPomiarParametrowZyciowych = $iPomiarParametrowZyciowych;
		return $this;
	}
	public function getIASP() {
		return $this->iASP;
	}
	public function setIASP($iASP) {
		$this->iASP = $iASP;
		return $this;
	}
	public function getIPostepPorodu() {
		return $this->iPostepPorodu;
	}
	public function setIPostepPorodu($iPostepPorodu) {
		$this->iPostepPorodu = $iPostepPorodu;
		return $this;
	}
	public function getIWydalanie() {
		return $this->iWydalanie;
	}
	public function setIWydalanie($iWydalanie) {
		$this->iWydalanie = $iWydalanie;
		return $this;
	}
	public function getIPecherzPlodowy() {
		return $this->iPecherzPlodowy;
	}
	public function setIPecherzPlodowy($iPecherzPlodowy) {
		$this->iPecherzPlodowy = $iPecherzPlodowy;
		return $this;
	}
	public function getICwiczeniaOddechowe() {
		return $this->iCwiczeniaOddechowe;
	}
	public function setICwiczeniaOddechowe($iCwiczeniaOddechowe) {
		$this->iCwiczeniaOddechowe = $iCwiczeniaOddechowe;
		return $this;
	}
	public function getILeki() {
		return $this->iLeki;
	}
	public function setILeki($iLeki) {
		$this->iLeki = $iLeki;
		return $this;
	}
	public function getIEdukacjaZdrowotnaIWsparciePsychiczne() {
		return $this->iEdukacjaZdrowotnaIWsparciePsychiczne;
	}
	public function setIEdukacjaZdrowotnaIWsparciePsychiczne($iEdukacjaZdrowotnaIWsparciePsychiczne) {
		$this->iEdukacjaZdrowotnaIWsparciePsychiczne = $iEdukacjaZdrowotnaIWsparciePsychiczne;
		return $this;
	}
	public function getIICzas() {
		return $this->iICzas;
	}
	public function setIICzas($iICzas) {
		$this->iICzas = $iICzas;
		return $this;
	}
	public function getIIPozycja() {
		return $this->iIPozycja;
	}
	public function setIIPozycja($iIPozycja) {
		$this->iIPozycja = $iIPozycja;
		return $this;
	}
	public function getIICzystoscKrocza() {
		return $this->iICzystoscKrocza;
	}
	public function setIICzystoscKrocza($iICzystoscKrocza) {
		$this->iICzystoscKrocza = $iICzystoscKrocza;
		return $this;
	}
	public function getIINaciecie() {
		return $this->iINaciecie;
	}
	public function setIINaciecie($iINaciecie) {
		$this->iINaciecie = $iINaciecie;
		return $this;
	}
	public function getIIAktywnosc() {
		return $this->iIAktywnosc;
	}
	public function setIIAktywnosc($iIAktywnosc) {
		$this->iIAktywnosc = $iIAktywnosc;
		return $this;
	}
	public function getIIHigiena() {
		return $this->iIHigiena;
	}
	public function setIIHigiena($iIHigiena) {
		$this->iIHigiena = $iIHigiena;
		return $this;
	}
	public function getIIDieta() {
		return $this->iIDieta;
	}
	public function setIIDieta($iIDieta) {
		$this->iIDieta = $iIDieta;
		return $this;
	}
	public function getIIPomiarParametrowZyciowych() {
		return $this->iIPomiarParametrowZyciowych;
	}
	public function setIIPomiarParametrowZyciowych($iIPomiarParametrowZyciowych) {
		$this->iIPomiarParametrowZyciowych = $iIPomiarParametrowZyciowych;
		return $this;
	}
	public function getIIASP() {
		return $this->iIASP;
	}
	public function setIIASP($iIASP) {
		$this->iIASP = $iIASP;
		return $this;
	}
	public function getIIWydalanie() {
		return $this->iIWydalanie;
	}
	public function setIIWydalanie($iIWydalanie) {
		$this->iIWydalanie = $iIWydalanie;
		return $this;
	}
	public function getIILeki() {
		return $this->iILeki;
	}
	public function setIILeki($iILeki) {
		$this->iILeki = $iILeki;
		return $this;
	}
	public function getIIEdukacjaZdrowotnaIWsparciePsychiczne() {
		return $this->iIEdukacjaZdrowotnaIWsparciePsychiczne;
	}
	public function setIIEdukacjaZdrowotnaIWsparciePsychiczne($iIEdukacjaZdrowotnaIWsparciePsychiczne) {
		$this->iIEdukacjaZdrowotnaIWsparciePsychiczne = $iIEdukacjaZdrowotnaIWsparciePsychiczne;
		return $this;
	}
	public function getIiiApgar() {
		return $this->iIIApgar;
	}
	public function setIiiApgar($iIIApgar) {
		$this->iIIApgar = $iIIApgar;
		return $this;
	}
	public function getIiiWaga() {
		return $this->iIIWaga;
	}
	public function setIiiWaga($iIIWaga) {
		$this->iIIWaga = $iIIWaga;
		return $this;
	}
	public function getIiiKontakt() {
		return $this->iIIKontakt;
	}
	public function setIiiKontakt($iIIKontakt) {
		$this->iIIKontakt = $iIIKontakt;
		return $this;
	}
	public function getIiiZabiegi() {
		return $this->iIIZabiegi;
	}
	public function setIiiZabiegi($iIIZabiegi) {
		$this->iIIZabiegi = $iIIZabiegi;
		return $this;
	}
	public function getIiiKrwawienie() {
		return $this->iIIKrwawienie;
	}
	public function setIiiKrwawienie($iIIKrwawienie) {
		$this->iIIKrwawienie = $iIIKrwawienie;
		return $this;
	}
	public function getIiiNaciecie() {
		return $this->iIINaciecie;
	}
	public function setIiiNaciecie($iIINaciecie) {
		$this->iIINaciecie = $iIINaciecie;
		return $this;
	}
	public function getIiiHigiena() {
		return $this->iIIHigiena;
	}
	public function setIiiHigiena($iIIHigiena) {
		$this->iIIHigiena = $iIIHigiena;
		return $this;
	}
	public function getIiiDieta() {
		return $this->iIIDieta;
	}
	public function setIiiDieta($iIIDieta) {
		$this->iIIDieta = $iIIDieta;
		return $this;
	}
	public function getIiiPomiarParametrowZyciowych() {
		return $this->iIIPomiarParametrowZyciowych;
	}
	public function setIiiPomiarParametrowZyciowych($iIIPomiarParametrowZyciowych) {
		$this->iIIPomiarParametrowZyciowych = $iIIPomiarParametrowZyciowych;
		return $this;
	}
	public function getIiiWydalanie() {
		return $this->iIIWydalanie;
	}
	public function setIiiWydalanie($iIIWydalanie) {
		$this->iIIWydalanie = $iIIWydalanie;
		return $this;
	}
	public function getIiiLeki() {
		return $this->iIILeki;
	}
	public function setIiiLeki($iIILeki) {
		$this->iIILeki = $iIILeki;
		return $this;
	}
	public function getIiiEdukacjaZdrowotnaIWsparciePsychiczne() {
		return $this->iIIEdukacjaZdrowotnaIWsparciePsychiczne;
	}
	public function setIiiEdukacjaZdrowotnaIWsparciePsychiczne($iIIEdukacjaZdrowotnaIWsparciePsychiczne) {
		$this->iIIEdukacjaZdrowotnaIWsparciePsychiczne = $iIIEdukacjaZdrowotnaIWsparciePsychiczne;
		return $this;
	}
	public function getIVObserwacja() {
		return $this->iVObserwacja;
	}
	public function setIVObserwacja($iVObserwacja) {
		$this->iVObserwacja = $iVObserwacja;
		return $this;
	}
	public function getIVPomiarParametrowZyciowych() {
		return $this->iVPomiarParametrowZyciowych;
	}
	public function setIVPomiarParametrowZyciowych($iVPomiarParametrowZyciowych) {
		$this->iVPomiarParametrowZyciowych = $iVPomiarParametrowZyciowych;
		return $this;
	}
	public function getIVKarmienie() {
		return $this->iVKarmienie;
	}
	public function setIVKarmienie($iVKarmienie) {
		$this->iVKarmienie = $iVKarmienie;
		return $this;
	}
	public function getIVEdukacjaZdrowotnaIWsparciePsychiczne() {
		return $this->iVEdukacjaZdrowotnaIWsparciePsychiczne;
	}
	public function setIVEdukacjaZdrowotnaIWsparciePsychiczne($iVEdukacjaZdrowotnaIWsparciePsychiczne) {
		$this->iVEdukacjaZdrowotnaIWsparciePsychiczne = $iVEdukacjaZdrowotnaIWsparciePsychiczne;
		return $this;
	}
	
}
