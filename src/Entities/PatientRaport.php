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
	public static function getRaport($wardId, $date) {
		$startDate = $date . '-01';
		$endDate = date ( "Y-m-t 23:59:59", strtotime ( $startDate ) );
		
		return PatientRaport::getRaportBetweenDates ( $wardId, $startDate, $endDate );
	}
	public static function updateNativeRaport() {
		$em = DoctrineBootstrap::getEntityManager ();
		$conn = $em->getConnection ();
		// create report table
		$sql1 = "CREATE TABLE IF NOT EXISTS kategoria_view 
					(data DATETIME, oddzialId INT, kategoria INT, suma INT,
					PRIMARY KEY (data,oddzialId,kategoria));";
		// update view
		$sql2 = "INSERT INTO kategoria_view 
					SELECT 
						date( dataKategoryzacji ), 
						oddzialId, 
						kategoriaPacjenta, 
						count( kategoriaPacjenta )
				FROM 
					Patient p 
				WHERE
					dataKategoryzacji 
						BETWEEN 
							(IFNULL((SELECT 
										DATE_ADD(MAX(data), INTERVAL 1 day )
									FROM kategoria_view),
								'2014-06-01')) 
						AND
							DATE_ADD( CURDATE( ) , INTERVAL -1 day ) 
				GROUP BY 
					oddzialId, 
					date( dataKategoryzacji ) , 
					kategoriaPacjenta";
		// select
		try {
			$conn->query ( $sql1 );
			$conn->query ( $sql2 );
		} catch ( Exception $e ) {
			// echo 'Caught exception: ', $e->getMessage(), "\n";
		}
	}
	/**
	 * 
	 * @param unknown $wardId
	 * @param unknown $startDate
	 * @param unknown $endDate
	 */
	public static function getRaportBetweenDatesNative($wardId, $startDate, $endDate) {
		$em = DoctrineBootstrap::getEntityManager ();
		$conn = $em->getConnection ();
		$sql3 = "SELECT kategoria, date(data) as data, suma FROM kategoria_view WHERE data between :data1 AND :data2 and oddzialId = :oddzialId";
		$stmt = $conn->prepare ( $sql3 );
		$stmt->execute ( array (
				'data1' => $startDate,
				'data2' => $endDate,
				'oddzialId' => $wardId 
		) );
		$result = $stmt->fetchAll();
		$table = array ();
		foreach ( $result as $row ) {
			$table [$row ['data']] [$row ['kategoria']] = $row ['suma'];
		}
		return $table;
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