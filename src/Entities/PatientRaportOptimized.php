<?php

namespace Hospitalplugin\Entities;

use Hospitalplugin\DB\DoctrineBootstrap;
use Hospitalplugin\utils\Utils;
use Doctrine\DBAL\Schema\View;
use Doctrine\ORM\Query\ResultSetMapping;

class PatientRaportOptimized {
	/**
	 *
	 * @param unknown $wardId        	
	 * @param unknown $date        	
	 */
	public static function getRaport($wardId, $date) {
		$startDate = $date . '-01';
		$endDate = date ( "Y-m-t 23:59:59", strtotime ( $startDate ) );
		
		return PatientRaportOptimized::getRaportBetweenDatesNative ( $wardId, $startDate, $endDate );
	}
	private static function updateNativeRaport() {
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
		PatientRaportOptimized::updateNativeRaport();
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
	
}