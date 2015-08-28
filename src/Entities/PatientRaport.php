<?php

namespace Hospitalplugin\Entities;

use Hospitalplugin\DB\DoctrineBootstrap;
use Hospitalplugin\utils\Utils;
use Doctrine\DBAL\Schema\View;
use Doctrine\ORM\Query\ResultSetMapping;

class PatientRaport {
	/**
	 *
	 * @param unknown $wardId        	
	 * @param unknown $date        	
	 */
	public static function getRaport($wardId, $date, $wardType) {
		$startDate = $date . '-01';
		$endDate = date ( "Y-m-t 23:59:59", strtotime ( $startDate ) );
		
		return PatientRaport::getRaportBetweenDates ( $wardId, $wardType, $startDate, $endDate );
	}
	private static function getQuery($type) {
		if ($type == 'POR') {
			// poród zabiegowy
			$dql1 = "  SELECT p.kategoriaPacjenta + 3 as kategoria, DATE(p.dataKategoryzacji) as data, COUNT(p.kategoriaPacjenta) as suma ";
			$dql1 .= " FROM Hospitalplugin\Entities\PatientPOR p ";
			$dql1 .= " WHERE p.dataKategoryzacji BETWEEN ?1 AND ?2 AND p.oddzialId = ?3 AND p.iICzas = 3";
			$dql1 .= " GROUP BY data, p.kategoriaPacjenta";
			// poród siłami natury
			$dql2 = "  SELECT p.kategoriaPacjenta as kategoria, DATE(p.dataKategoryzacji) as data, COUNT(p.kategoriaPacjenta) as suma ";
			$dql2 .= " FROM Hospitalplugin\Entities\PatientPOR p ";
			$dql2 .= " WHERE p.dataKategoryzacji BETWEEN ?1 AND ?2 AND p.oddzialId = ?3 AND (p.iICzas <> 3 OR p.iICzas IS NULL)";
			$dql2 .= " GROUP BY data, p.kategoriaPacjenta";
			return array (
					$dql1,
					$dql2 
			);
		} else {
			// pozostałe typy
			$dql = "  SELECT p.kategoriaPacjenta as kategoria, DATE(p.dataKategoryzacji) as data, COUNT(p.kategoriaPacjenta) as suma ";
			$dql .= " FROM Hospitalplugin\Entities\Patient p ";
			$dql .= " WHERE p.dataKategoryzacji BETWEEN ?1 AND ?2 AND p.oddzialId = ?3";
			$dql .= " GROUP BY data, p.kategoriaPacjenta";
			return array (
					$dql 
			);
		}
	}
	/**
	 *
	 * @param unknown $wardId        	
	 * @param unknown $type        	
	 * @param unknown $startDate        	
	 * @param unknown $endDate        	
	 * @return array
	 */
	public static function getRaportBetweenDates($wardId, $type, $startDate, $endDate) {
		$em = DoctrineBootstrap::getEntityManager ();
		$em->getConfiguration ()->addCustomDatetimeFunction ( 'DATE', 'Hospitalplugin\DQLFunctions\DateFunction' );
		$dql = PatientRaport::getQuery ( $type );
		$allResults = array ();
		foreach ( $dql as $query ) {
			$result = $em->createQuery ( $query )->setParameter ( 1, $startDate )->setParameter ( 2, $endDate )->setParameter ( 3, $wardId )->getResult ();
			$allResults = array_merge ( $result, $allResults );
		}
		
		$table = array ();
		foreach ( $allResults as $row ) {
			$table [$row ['data']] [$row ['kategoria']] = $row ['suma'];
		}
		return $table;
	}
	/**
	 * @param unknown $type
	 */
	static function getColumns($type) {
		if ($type == 'POR') {
			return array (
					'N1 naturalny',
					'N2 naturalny',
					'N3 naturalny',
					'N1 zabiegowy',
					'N2 zabiegowy',
					'N3 zabiegowy',
					'brak kat.',
					'N',
					'Tpb1',
					'Tpb2',
					'Tpb3',
					'Tpb1z',
					'Tpb2z',
					'Tpb3z',
					'Tpb0',
					'2',
					'Tpb1*N1',
					'Tpb2*N2',
					'Tpb3*N3',
					'Tpb1z*N1z',
					'Tpb2z*N2z',
					'Tpb3z*N3z',
					'Tpb0',
					'2*N',
					'Tpb/dzień'
			);
		} else {
			return array (
					'N1',
					'N2',
					'N3',
					'brak kat.',
					'N',
					'Tpb1',
					'Tpb2',
					'Tpb3',
					'Tpb0',
					'2',
					'Tpb1*N1',
					'Tpb2*N2',
					'Tpb3*N3',
					'Tpb0',
					'2*N',
					'Tpb/dzień'
			);
		}
	}
	static function getIndexes($type) {
		if ($type == 'POR') {
			return array (
					'1',
					'2',
					'3',
					'4',
					'5',
					'6',
					'0'
			);
		} else {
			return array (
					'1',
					'2',
					'3',
					'0'
			);
		}
	}
	/**
	 * based on
	 * Zalecenie Konsultanta Krajowego w dz.
	 * pielęgniarstwa w sprawie realizacji przepisów rozporządzenia Ministra Zdrowia z dnia 28 grudnia 2012 roku w sprawie sposobu ustalenia minimalnych norm zatrudnienia pielęgniarek i położnych w podmiotach leczniczych niebędących przedsiębiorcami.
	 * http://www.nipip.pl/index.php/prawo/opiniekk/w-dz-pielegniarstwa/konsultant-krajowy-dr-hab-n-hum-maria-kozka/2265-zalecenie-konsultanta-krajowego-w-dz-pielegniarstwa-w-sprawie-realizacji-przepisow-rozporzadzenia-ministra-zdrowia-z-dnia-28-grudnia-2012-roku-w-sprawie-sposobu-ustalenia-minimalnych-norm-zatrudnienia-pielegniarek-i-poloznych-w-podmiotach-leczniczych-nieb
	 *
	 * @param unknown $type
	 */
	static function getTpb($type) {
		if ($type == 'ZZ' || $type == 'PED') {
			return array (
					38,
					95,
					159,
					0,
					2
			);
		} else if ($type == 'PSY') {
			return array (
					40,
					100,
					160,
					0,
					2
			);
		} else if ($type == 'POR') {
			return array (
					137,
					274,
					328,
					53,
					53,
					120,
					0,
					2
			);
		} else if ($type == 'POL') {
			return array (
					72,
					100,
					98,
					0,
					2
			);
		}
	}
}