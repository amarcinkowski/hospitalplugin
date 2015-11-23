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
 * @version   1.0  $Format:%H$
 * @link      http://
 * @since     File available since Release 1.0.0
 * PHP Version 5
 */
namespace Hospitalplugin\Entities;

/**
 * Patient
 *
 * @category Wp
 * @package Punction
 * @author Andrzej Marcinkowski <andrzej.max.marcinkowski@gmail.com>
 * @copyright 2014 Wojewódzki Szpital Zespolony, Kalisz
 * @license MIT http://opensource.org/licenses/MIT
 * @version 1.0 $Format:%H$
 * @link http://
 * @since File available since Release 1.0.0
 *       
 *        @Entity
 *        @Table(name="Patient",
 *        options={"collate"="utf8_unicode_ci", "charset"="utf8", "engine"="InnoDB"},
 *        indexes={
 *        @index(name="name_idx", columns={"name"}),
 *        @index(name="dataKategoryzacji_idx", columns={"dataKategoryzacji"}),
 *        @index(name="oddzialId_idx", columns={"oddzialId"}),
 *        @index(name="kategoriaPacjenta_idx", columns={"kategoriaPacjenta"})})
 *        @InheritanceType("JOINED")
 *        @DiscriminatorColumn(name="discr", type="string")
 *        @DiscriminatorMap({"patient" = "Patient",
 *        "patientzz" = "PatientZZ",
 *        "patientped" = "PatientPED",
 *        "patientpsy" = "PatientPSY",
 *        "patientdia" = "PatientDIA",
 *        "patientpor" = "PatientPOR",
 *        "patientpol" = "PatientPOL"
 *        })
 */
class Patient {
	
	/**
	 *
	 * @var string $typ typ pacjenta
	 */
	protected $typ = "";
	
	/**
	 * id
	 * @Id @Column(type="integer") @GeneratedValue
	 */
	public $id;
	
	/**
	 * name
	 * @Column(type="string", length=50)
	 */
	public $name;
	
	/**
	 * @Column(type="string", length=11)
	 */
	public $pesel;
	
	/**
	 * @Column(type="integer") *
	 */
	public $numerHistorii;
	
	/**
	 * $dataKategoryzacji datetime
	 * @Column(type="datetime") *
	 */
	public $dataKategoryzacji;
	
	/**
	 * @Column(type="integer") *
	 */
	protected $oddzialId;
	
	/**
	 * @Column(columnDefinition="TINYINT(4) NOT NULL DEFAULT 0")
	 */
	public $kategoriaPacjenta = 0;
	
	/**
	 * @ManyToOne(targetEntity="Hospitalplugin\Entities\User")
	 * @JoinColumn(name="userId", referencedColumnName="id", nullable=false)
	 */
	public $user;
	 	
	/**
	 * Constructor
	 *
	 * @param unknown $args        	
	 */
	function __construct($args) {
		if (! isset ( $args ) || empty ( $args )) {
			return;
		}
		foreach ( $args as $key => $value ) {
			if ($key == 'dataKategoryzacji') {
				$value = new \DateTime ( $value . ' 12:00:00' );
			}
			call_user_func ( array (
					$this,
					'set' . $key 
			), $value );
		}
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
	 * @return \Hospitalplugin\Entities\Patient
	 */
	public function setId($id) {
		$this->id = $id;
		return $this;
	}
	
	/**
	 * getName
	 *
	 * @return name
	 */
	public function getName() {
		return $this->name;
	}
	
	/**
	 * setName
	 *
	 * @param string $name
	 *        	string name
	 *        	
	 * @return Patient
	 */
	public function setName($name) {
		$this->name = $name;
		return $this;
	}
	
	/**
	 * getDataKategoryzacji
	 *
	 * @return \DateTime dataKategoryzacji
	 */
	public function getDataKategoryzacji() {
		return $this->dataKategoryzacji;
	}
	
	/**
	 * setDataKategoryzacji
	 *
	 * @param \DateTime $dataKategoryzacji
	 *        	data kategoryzyzacji
	 *        	
	 * @return Patient
	 */
	public function setDataKategoryzacji(\DateTime $dataKategoryzacji) {
		$this->dataKategoryzacji = $dataKategoryzacji;
		return $this;
	}
	
	/**
	 * getOddzialId
	 *
	 * @return oddzialId
	 */
	public function getOddzialId() {
		return $this->oddzialId;
	}
	
	/**
	 * setOddzialId
	 *
	 * @param int $oddzialId
	 *        	oddzial id
	 *        	
	 * @return Patient
	 */
	public function setOddzialId($oddzialId) {
		$this->oddzialId = $oddzialId;
		return $this;
	}
	
	/**
	 *
	 * @param Ward $ward        	
	 */
	public function setWard($ward) {
		$this->oddzialId = $ward->id;
		return $this;
	}
	
	/**
	 * getOddzialId
	 *
	 * @return oddzialId
	 */
	public function getNumerHistorii() {
		return $this->numerHistorii;
	}
	
	/**
	 * setOddzialId
	 *
	 * @param int $oddzialId
	 *        	oddzial id
	 *        	
	 * @return Patient
	 */
	public function setNumerHistorii($numerHistorii) {
		$this->numerHistorii = $numerHistorii;
		return $this;
	}
	
	/**
	 * getPesel
	 *
	 * @return pesel
	 */
	public function getPesel() {
		return $this->pesel;
	}
	
	/**
	 * setPesel
	 *
	 * @param string $pesel
	 *        	nr pesel
	 *        	
	 * @return Patient
	 */
	public function setPesel($pesel) {
		$this->pesel = $pesel;
		return $this;
	}
	
	/**
	 * getKategoriaPacjenta
	 *
	 * @return kategoriaPacjenta
	 */
	public function getKategoriaPacjenta() {
		return $this->kategoriaPacjenta;
	}
	
	/**
	 * setKategoriaPacjenta
	 *
	 * @param int $kategoriaPacjenta
	 *        	kategoriaPacjenta
	 *        	
	 * @return Patient
	 */
	public function setKategoriaPacjenta($kategoriaPacjenta) {
		$this->kategoriaPacjenta = $kategoriaPacjenta;
		return $this;
	}
	
	/**
	 * getTyp
	 *
	 * @return typ
	 */
	public function getTyp() {
		return $this->typ;
	}
	
	/**
	 * setTyp
	 *
	 * @param string $typ        	
	 *
	 * @return \Hospitalplugin\Entities\Patient
	 */
	public function setTyp($typ) {
		$this->typ = $typ;
		return $this;
	}
	
	/**
	 * getUser
	 */
	public function getUser() {
		return $this->user;
	}
	
	/**
	 *
	 * @param User $user        	
	 */
	public function setUser($user) {
		$this->user = $user;
		return $this;
	}
	
	/**
	 * toString
	 *
	 * @return string
	 */
	public function toString() {
		$txt = $this->getName ();
		$txt .= $this->getPesel ();
		$txt .= "id:";
		$txt .= $this->getId ();
		$txt .= "oid:";
		$txt .= $this->getOddzialId ();
		$txt .= "d:";
		$data = $this->getDataKategoryzacji ();
		if ($data instanceof \DateTime) {
			$txt .= $this->getDataKategoryzacji ()->format ( "Y-m-d" );
		} else {
			$txt .= $this->getDataKategoryzacji ();
		}
		return $txt;
	}
	public function __toString() {
		return $this->toString ();
	}
	
	/**
	 * getFields
	 *
	 * @return multitype:string
	 */
	protected static function getFields() {
		$fields = array (
				"id",
				"name",
				"pesel",
				"numerHistorii",
				"dataKategoryzacji",
				"kategoriaPacjenta" 
		);
		return $fields;
	}
	
	/**
	 * toDatatablesJSONString
	 *
	 * @return string
	 */
	public function toDatatablesJSONString() {
		$return_object_array = [ ];
		$fields = $this->getFields ();
		foreach ( $fields as $field ) {
			$value = call_user_func ( array (
					$this,
					'get' . $field 
			) );
			if ($value instanceof \DateTime) {
				$value = $value->format ( 'Y-m-d' );
			}
			array_push ( $return_object_array, array (
					$field => $value 
			) );
		}
		return json_encode ( $this );
	}
	
	/**
	 * String with comma separated values.
	 *
	 * @deprecated JSON used
	 * @param unknown $patient        	
	 *
	 * @return string
	 */
	public function toDatatablesString() {
		$string = "";
		$fields = $this::getFields ();
		foreach ( $fields as $field ) {
			$value = call_user_func ( array (
					$this,
					'get' . $field 
			) );
			if ($value instanceof \DateTime) {
				$value = $value->format ( 'Y-m-d' );
			}
			$string .= $value . ",";
		}
		$string = trim ( $string, "," );
		$string = str_replace ( "\n", "", $string );
		return $string;
	}
}
