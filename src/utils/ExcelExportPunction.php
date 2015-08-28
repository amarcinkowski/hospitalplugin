<?php

namespace Hospitalplugin\utils;

use Hospitalplugin\Entities\InfectionsCRUD;
use Hospitalplugin\Entities\Infections;
use Hospitalplugin\Entities\PatientRaport;
use Hospitalplugin\Entities\WardCRUD;

class ExcelExportPunction {
	
	/**
	 *
	 * @param unknown $id        	
	 */
	private static function getData($id, $type) {
		$raport = PatientRaport::getRaportBetweenDates ( $id, $type, '2014-06-01', (new \DateTime ())->format ( "Y-m-d" ) );
		return $raport;
	}
	/**
	 *
	 * @param unknown $objPHPExcel        	
	 * @param unknown $cols        	
	 */
	private static function printHeaders($objPHPExcel, $cols) {
		$count = 1;
		$objPHPExcel->getActiveSheet ()->setCellValueByColumnAndRow ( 0, 2, "Data" );
		foreach ( $cols as $col ) {
			$objPHPExcel->getActiveSheet ()->setCellValueByColumnAndRow ( $count ++, 2, sprintf ( "%7s", $col ) );
		}
	}
	/**
	 */
	private static function printData($objPHPExcel, $data, $type) {
		$row = 3;
		$lastColumn = 1;
		$colNumberOfPatients = ExcelExport::getColumnLetter ( 1 );
		$indexes = PatientRaport::getIndexes ( $type );
		foreach ( $data as $rowKey => $rowValue ) {
			// 1 col: date
			$objPHPExcel->getActiveSheet ()->setCellValueByColumnAndRow ( 0, $row, json_encode ( $rowKey ) );
			$count = 1;
			// 2-5 cols: N1 N2 N3 N0
			foreach ( $indexes as $index ) {
				$value = isset ( $rowValue [$index] ) ? $rowValue [$index] : "0";
				$objPHPExcel->getActiveSheet ()->setCellValueByColumnAndRow ( $count ++, $row, $value );
			}
			// 6 col: num of categorized (N = N1+N2+N3)
			$colHighestCategory = ExcelExport::getColumnLetter ( $count - 2 );
			$colNumberOfPatients = ExcelExport::getColumnLetter ( $count );
			$objPHPExcel->getActiveSheet ()->setCellValueByColumnAndRow ( $count ++, $row, '=SUM(B' . $row . ':' . $colHighestCategory . $row . ')' );
			$tpb = PatientRaport::getTpb ( $type );
			// 7-11 tpb1, tpb2, tpb3, 0 (no-cat), 2 (add)
			foreach ( $tpb as $tpbn ) {
				$objPHPExcel->getActiveSheet ()->setCellValueByColumnAndRow ( $count ++, $row, $tpbn );
			}
			// 9-11: Tpb1*N1,Tpb2*N2,Tpb3*N3+2xN
			$tpbSize = count ( $tpb );
			foreach ( $tpb as $tpbn ) {
				$col1Letter = ExcelExport::getColumnLetter ( $count - 2 * $tpbSize );
				$col2Letter = ExcelExport::getColumnLetter ( $count - $tpbSize );
				$objPHPExcel->getActiveSheet ()->setCellValueByColumnAndRow ( $count ++, $row, '=' . $col1Letter . $row . "*" . $col2Letter . $row );
			}
			// SUM Tpb
			$col3Letter = ExcelExport::getColumnLetter ( $count - $tpbSize );
			$col4Letter = ExcelExport::getColumnLetter ( $count - 1 );
			$objPHPExcel->getActiveSheet ()->setCellValueByColumnAndRow ( $count ++, $row, '=SUM(' . $col3Letter . $row . ":" . $col4Letter . $row . ")" );
			$row ++;
			$lastColumn = $count - 1;
		}
		// number of categorization days
		$objPHPExcel->getActiveSheet ()->setCellValueByColumnAndRow ( 1, 1, '=COUNTIFS(' . $colNumberOfPatients . '3:' . $colNumberOfPatients . ($row - 1) . ',">0")' );
		// sum
		$col5Letter = ExcelExport::getColumnLetter ( $lastColumn );
		$objPHPExcel->getActiveSheet ()->setCellValueByColumnAndRow ( 2, 1, '=SUM(' . $col5Letter . '3:' . $col5Letter . ($row - 1) . ')/60' );
		return $row;
	}
	
	/**
	 *
	 * @param unknown $objPHPExcel        	
	 */
	static function fillSummary($objPHPExcel) {
		ExcelExport::newSheet ( $objPHPExcel, 0 );
		ExcelExport::printTitle ( $objPHPExcel, "Raport" );
		$sheetCount = $objPHPExcel->getSheetCount ();
		$objPHPExcel->getActiveSheet ()->setCellValue ( 'A2', 'Oddz.' );
		$objPHPExcel->getActiveSheet ()->setCellValue ( 'B2', 'Dni' );
		$objPHPExcel->getActiveSheet ()->setCellValue ( 'C2', 'Tpb' );
		$objPHPExcel->getActiveSheet ()->setCellValue ( 'D2', 'Tśpb' );
		$objPHPExcel->getActiveSheet ()->setCellValue ( 'E2', 'Tśpc*' );
		$objPHPExcel->getActiveSheet ()->setCellValue ( 'F2', 'Tśpc**' );
		$objPHPExcel->getActiveSheet ()->setCellValue ( 'G2', 'Td***' );
		$objPHPExcel->getActiveSheet ()->setCellValue ( 'H2', 'Le*' );
		$objPHPExcel->getActiveSheet ()->setCellValue ( 'I2', 'Le**' );
		for($i = 1; $i < $sheetCount; $i ++) {
			$loadedSheetNames = $objPHPExcel->getSheetNames ();
			foreach ( $loadedSheetNames as $sheetIndex => $loadedSheetName ) {
				if ($sheetIndex == 0) {
					continue;
				}
				$row = $sheetIndex + 2;
				$objPHPExcel->getActiveSheet ()->setCellValue ( 'A' . $row, "='" . $loadedSheetName . "'!A1" );
				$objPHPExcel->getActiveSheet ()->setCellValue ( 'B' . $row, "='" . $loadedSheetName . "'!B1" );
				$objPHPExcel->getActiveSheet ()->setCellValue ( 'C' . $row, "='" . $loadedSheetName . "'!C1" );
				$objPHPExcel->getActiveSheet ()->setCellValueByColumnAndRow ( 3, $row, "=IF(C" . $row . ">0,C" . $row . "/B" . $row . ",0)" );
				$objPHPExcel->getActiveSheet ()->setCellValueByColumnAndRow ( 4, $row, "=D" . $row . "*110%" );
				$objPHPExcel->getActiveSheet ()->setCellValueByColumnAndRow ( 5, $row, "=D" . $row . "*125%" );
				$objPHPExcel->getActiveSheet ()->setCellValueByColumnAndRow ( 6, $row, "1531" );
				$objPHPExcel->getActiveSheet ()->setCellValueByColumnAndRow ( 7, $row, "=IF(E" . $row . ">0,E" . $row . "*365/G" . $row . ",\"-\")" );
				$objPHPExcel->getActiveSheet ()->setCellValueByColumnAndRow ( 8, $row, "=IF(F" . $row . ">0,F" . $row . "*365/G" . $row . ",\"-\")" );
			}
			$objPHPExcel->getActiveSheet ()->getStyle ( 'C3:I100' )->getNumberFormat ()->setFormatCode ( '#,##0.0' );
			$objPHPExcel->getActiveSheet ()->setCellValueByColumnAndRow ( 0, $row + 1, "* Czas pielęgnacji pośredniej jako 10% czasu pielęgnacji bezpośredniej" );
			$objPHPExcel->getActiveSheet ()->setCellValueByColumnAndRow ( 0, $row + 2, "** Czas pielęgnacji pośredniej jako 25% czasu pielęgnacji bezpośredniej" );
			$objPHPExcel->getActiveSheet ()->setCellValueByColumnAndRow ( 0, $row + 3, "*** Czas dyspozycyjny - propozycja z Rozporządzenia MZ: 202 dni x 7,58 h" );
			ExcelExport::styleActiveSheet ( $objPHPExcel );
		}
	}
	static function fillData($objPHPExcel) {
		// no time limit for this script
		set_time_limit ( 0 );
		$time_start = microtime ( true );
		// remove first default sheet
		$objPHPExcel->removeSheetByIndex ( 0 );
		// get wards
		$wards = WardCRUD::getWardsArray ();
		foreach ( $wards as $ward ) {
			ExcelExport::newSheet ( $objPHPExcel );
			$wardName = $ward->name . " (" . $ward->getTypOddzialu () . ")";
			ExcelExport::printTitle ( $objPHPExcel, $wardName );
			$data = ExcelExportPunction::getData ( $ward->id, $ward->getTypOddzialu () );
			$cols = PatientRaport::getColumns ( $ward->getTypOddzialu () );
			ExcelExportPunction::printHeaders ( $objPHPExcel, $cols );
			ExcelExportPunction::printData ( $objPHPExcel, $data, $ward->getTypOddzialu () );
			ExcelExport::styleActiveSheet ( $objPHPExcel );
		}
		ExcelExportPunction::fillSummary ( $objPHPExcel );
		$objPHPExcel->getActiveSheet ()->setCellValueByColumnAndRow ( 0, 100, "summary " . ($time_start - microtime ( true )) . " s" );
	}
}