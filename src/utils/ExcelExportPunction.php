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
	private static function getData($id) {
		PatientRaport::updateNativeRaport ();
		$raport = PatientRaport::getRaportBetweenDatesNative ( $id, '2014-06-01', '2015-08-27' );
		return $raport;
	}
	/**
	 */
	private static function getColumns() {
		return array (
				'Kategoria I' => '1',
				'Kategoria 2' => '2',
				'Kategoria 3' => '3',
				'b.k.' => '0' 
		);
	}
	/**
	 *
	 * @param unknown $objPHPExcel        	
	 */
	private static function newSheet($objPHPExcel, $index = -1) {
		if ($index < 0) {
			$index = $objPHPExcel->getSheetCount ();
		}
		$objPHPExcel->createSheet ( $index );
		$objPHPExcel->setActiveSheetIndex ( $index );
		$sheet = $objPHPExcel->getActiveSheet ();
		return $sheet;
	}
	/**
	 *
	 * @param unknown $objPHPExcel        	
	 * @param unknown $cols        	
	 */
	private static function printHeaders($objPHPExcel, $cols) {
		$count = 1;
		$objPHPExcel->getActiveSheet ()->setCellValueByColumnAndRow ( 0, 2, "Data" );
		foreach ( $cols as $col => $sym ) {
			$objPHPExcel->getActiveSheet ()->setCellValueByColumnAndRow ( $count ++, 2, sprintf ( "%7s", $col ) );
		}
	}
	/**
	 */
	private static function printData($objPHPExcel, $data, $cols) {
		$row = 3;
		foreach ( $data as $rowKey => $rowValue ) {
			// 1 col: date
			$objPHPExcel->getActiveSheet ()->setCellValueByColumnAndRow ( 0, $row, json_encode ( $rowKey ) );
			$count = 1;
			// 2-4 cols: cat1 cat2 cat3
			foreach ( $cols as $col => $sym ) {
				
				$value = isset ( $rowValue [$sym] ) ? $rowValue [$sym] : "-";
				$objPHPExcel->getActiveSheet ()->setCellValueByColumnAndRow ( $count ++, $row, $value );
			}
			// 5 col: num of categorized
			$objPHPExcel->getActiveSheet ()->setCellValueByColumnAndRow ( 5, $row, '=SUM(B' . $row . ':D' . $row . ')' );
			$row ++;
		}
		$objPHPExcel->getActiveSheet ()->setCellValueByColumnAndRow ( 1, 1, '=COUNTIFS(F3:F' . ($row - 1) . ',">0")' );
		return $row;
	}
	/**
	 *
	 * @param unknown $string        	
	 */
	private static function clearName($string) {
		$string = str_replace ( ' ', '-', $string );
		$string = preg_replace ( '/[^A-Za-z0-9\-]/', '', $string );
		$string = str_replace ( 'ddzia', '', $string );
		$string = substr ( $string, 0, 29 );
		return $string;
	}
	/**
	 *
	 * @param unknown $objPHPExcel        	
	 * @param unknown $title        	
	 */
	private static function printTitle($objPHPExcel, $title) {
		$objPHPExcel->getActiveSheet ()->setTitle ( ExcelExportPunction::clearName ( $title ), true );
		$objPHPExcel->getActiveSheet ()->setCellValueByColumnAndRow ( 0, 1, $title );
	}
	/**
	 * based on
	 * Zalecenie Konsultanta Krajowego w dz.
	 * pielęgniarstwa w sprawie realizacji przepisów rozporządzenia Ministra Zdrowia z dnia 28 grudnia 2012 roku w sprawie sposobu ustalenia minimalnych norm zatrudnienia pielęgniarek i położnych w podmiotach leczniczych niebędących przedsiębiorcami.
	 * http://www.nipip.pl/index.php/prawo/opiniekk/w-dz-pielegniarstwa/konsultant-krajowy-dr-hab-n-hum-maria-kozka/2265-zalecenie-konsultanta-krajowego-w-dz-pielegniarstwa-w-sprawie-realizacji-przepisow-rozporzadzenia-ministra-zdrowia-z-dnia-28-grudnia-2012-roku-w-sprawie-sposobu-ustalenia-minimalnych-norm-zatrudnienia-pielegniarek-i-poloznych-w-podmiotach-leczniczych-nieb
	 *
	 * @param unknown $type        	
	 */
	private static function getTpb($type) {
		if ($type == 'ZZ' || $type = 'PED') {
			return array (
					38,
					95,
					159,
					'',
					2 
			);
		} else if ($type == 'PSY') {
			return array (
					40,
					100,
					160,
					'',
					2 
			);
		} else if ($type == 'POR') {
			return array (
					137,
					274,
					328,
					'',
					2 
			);
		} else if ($type == 'POL') {
			return array (
					72,
					100,
					98,
					'',
					2 
			);
		}
	}
	/**
	 *
	 * @param PHPExcel $objPHPExcel        	
	 */
	private static function printFooter($objPHPExcel, $cols, $row, $typOddzialu) {
		$objPHPExcel->getActiveSheet ()->getStyle ( 'A' . $row . ':AA' . ($row + 1) )->getFont ()->setBold ( true );
		// SUM N1, N2, N3
		for($i = 0; $i < 5; $i ++) {
			$column = $i + 1;
			$colLetter = chr ( 65 + $column );
			$objPHPExcel->getActiveSheet ()->setCellValueByColumnAndRow ( $column, $row, "=sum(" . $colLetter . "3" . ":" . $colLetter . ($row - 1) . ")" );
		}
		$row ++;
		// Tpb1, Tpb2, Tpb3
		$tpb = ExcelExportPunction::getTpb ( $typOddzialu ); // 38,95,159
		for($i = 0; $i < count ( $tpb ); $i ++) {
			$column = $i + 1;
			$objPHPExcel->getActiveSheet ()->setCellValueByColumnAndRow ( $column, $row, $tpb [$i] );
		}
		$row ++;
		// N1 * Tpb1, ...
		for($i = 0; $i < count ( $tpb ); $i ++) {
			$column = $i + 1;
			$colLetter = chr ( 65 + $column );
			$oneUp = $colLetter . ($row - 1);
			$twoUp = $colLetter . ($row - 2);
			$objPHPExcel->getActiveSheet ()->setCellValueByColumnAndRow ( $column, $row, "=" . $oneUp . "*" . $twoUp . "/60" );
		}
		// SUM Tpb1 + Tpb2 + Tpb3 + 2xN
		$objPHPExcel->getActiveSheet ()->setCellValueByColumnAndRow ( 2, 1, '=sum(B' . $row . ':F' . $row . ')' );
	}
	/**
	 *
	 * @param unknown $objPHPExcel        	
	 */
	static function fillSummary($objPHPExcel) {
		ExcelExportPunction::newSheet ( $objPHPExcel, 0 );
		ExcelExportPunction::printTitle ( $objPHPExcel, "Raport" );
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
		// remove first default sheet
		$objPHPExcel->removeSheetByIndex ( 0 );
		// get wards
		$wards = WardCRUD::getWardsArray ();
		foreach ( $wards as $ward ) {
			ExcelExportPunction::newSheet ( $objPHPExcel );
			$wardName = $ward->name . " (" . $ward->getTypOddzialu () . ")";
			ExcelExportPunction::printTitle ( $objPHPExcel, $wardName );
			$data = ExcelExportPunction::getData ( $ward->id );
			$cols = ExcelExportPunction::getColumns ();
			ExcelExportPunction::printHeaders ( $objPHPExcel, $cols );
			$lastRow = ExcelExportPunction::printData ( $objPHPExcel, $data, $cols );
			ExcelExportPunction::printFooter ( $objPHPExcel, $cols, $lastRow, $ward->getTypOddzialu () );
			ExcelExport::styleActiveSheet ( $objPHPExcel );
		}
		ExcelExportPunction::fillSummary ( $objPHPExcel );
	}
}