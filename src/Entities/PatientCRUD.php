<?php

/**
 * PatientCRUD
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

use Hospitalplugin\DB\DoctrineBootstrap;
use Hospitalplugin\Entities\Patient;
use Hospitalplugin\Entities\PatientDeleted;
use Hospitalplugin\Entities\PatientFactory;
use Hospitalplugin\utils\Utils;

class PatientCRUD {
	
	/**
	 * getPatients
	 *
	 * @param int $day
	 *        	dayOfTheMonth
	 * @param int $month
	 *        	month
	 *        	
	 * @return Patient array
	 */
	public static function getPatients($month = null, $day = null, $wardId = 0) {
		return PatientCRUD::getPatientsDateRange ( Utils::getStartDate ( $month, $day ), Utils::getEndDate ( $month, $day ), $wardId );
	}
	
	/**
	 * getPatientsDateRange
	 *
	 * TODO(AM) testy na przypadki graniczne - pacjenci z data przed polnoca, po polnocy, godzina przed obecna, po obecnej
	 *
	 * @param int $day
	 *        	dayOfTheMonth
	 * @param int $month
	 *        	month
	 *        	
	 * @return Patient array
	 */
	public static function getPatientsDateRange($date1, $date2, $wardId = 0) {
		$entityManager = ( object ) DoctrineBootstrap::getEntityManager ();
		$params = array (
				'from' => $date1,
				'to' => $date2,
				'oddzialId' => $wardId 
		);
		$q = $entityManager->createQuery ( 'select p FROM Hospitalplugin\Entities\Patient p WHERE p.dataKategoryzacji BETWEEN :from AND :to and p.oddzialId = :oddzialId ORDER BY p.name' )->setParameters ( $params )->setFirstResult ( 0 )->setMaxResults ( 1000 );
		$patients = $q->getResult ();
		return $patients;
	}
	
	/**
	 * getPatient
	 *
	 * @param $id $id
	 *        	int
	 *        	
	 * @return Patient Patient
	 */
	public static function getPatient($id, $type = '') {
		$entityManager = ( object ) DoctrineBootstrap::getEntityManager ();
		$type = 'Hospitalplugin\Entities\Patient' . $type;
		$patient = $entityManager->getRepository ( $type )->findOneBy ( array (
				'id' => $id 
		) );
		return Utils::cast ( $type, ( object ) $patient, 0 );
	}
	
	/**
	 * setPatientCategories
	 *
	 * @param Patient $obj        	
	 *
	 * @return Patient
	 */
	public static function setPatientCategories($obj, $type) {
		$entityManager = DoctrineBootstrap::getEntityManager ();
		$patient = PatientCRUD::getPatient ( $obj->id, $type );
		foreach ( get_object_vars ( $obj ) as $key => $value ) {
			call_user_func ( array (
					$patient,
					'set' . ucwords ( $key ) 
			), $value );
		}
		$entityManager->merge ( $patient );
		$entityManager->flush ();
		return $patient;
	}
	
	/**
	 * setPatientCategories
	 *
	 * @param Patient $obj        	
	 *
	 * @return Patient
	 */
	public static function createPatient($type, $name, $pesel) {
		$entityManager = DoctrineBootstrap::getEntityManager ();
		$type = 'Hospitalplugin\Entities\Patient' . $type;
		$patient = new $type ();
		$patient->setName ( $name );
		$patient->setPesel ( $pesel );
		$entityManager->persist ( $patient );
		$entityManager->flush ();
		return $patient;
	}
	
	/**
	 * deletePatient
	 *
	 * @param $id $id
	 *        	int
	 */
	public static function deletePatient($id, $userId = 0) {
		$entityManager = ( object ) DoctrineBootstrap::getEntityManager ();
		$type = 'Hospitalplugin\Entities\Patient';
		$patient = $entityManager->getRepository ( $type )->findOneBy ( array (
				'id' => $id 
		) );
		$entityManager->remove ( $patient );
		$log = strval($patient);
		$audit = new PatientDeleted();
		$audit->deletedAt = new \DateTime ();
		$audit->deletedByUserId = $userId;
		$audit->log = $log;
		$entityManager->persist ( $audit );
		$entityManager->flush ();
	}
}
?>