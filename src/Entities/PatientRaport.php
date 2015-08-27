<?php

namespace Hospitalplugin\Entities;

use Hospitalplugin\DB\DoctrineBootstrap;
use Hospitalplugin\utils\Utils;

class PatientRaport {
	/**
	 * 
	 * @param unknown $wardId
	 * @param unknown $date
	 */
	public static function getRaport($wardId, $date) {
		$startDate = $date . '-01';
		$endDate = date ( "Y-m-t 23:59:59", strtotime ( $startDate ) );
		
		return PatientRaport::getRaportBetweenDates ( $wardId, $startDate, $endDate );
	}
	/**
	 * 
	 * @param unknown $wardId
	 * @param unknown $startDate
	 * @param unknown $endDate
	 */
	public static function getRaportBetweenDates($wardId, $startDate, $endDate) {
		$em = DoctrineBootstrap::getEntityManager ();
		$em->getConfiguration ()->addCustomDatetimeFunction ( 'DATE', 'Hospitalplugin\DQLFunctions\DateFunction' );
		
		$dql = "  SELECT p.kategoriaPacjenta as kategoria, DATE(p.dataKategoryzacji) as data, COUNT(p.kategoriaPacjenta) as suma ";
		$dql .= " FROM Hospitalplugin\Entities\Patient p ";
		$dql .= " WHERE p.dataKategoryzacji BETWEEN ?1 AND ?2 AND p.oddzialId = ?3";
		$dql .= " GROUP BY data, p.kategoriaPacjenta";
		
		$result = $em->createQuery ( $dql )->setParameter ( 1, $startDate )->setParameter ( 2, $endDate )->setParameter ( 3, $wardId )->getResult ();
		
		$table = array ();
		foreach ( $result as $row ) {
			$table [$row ['data']] [$row ['kategoria']] = $row ['suma'];
		}
		return $table;
	}
}