<?php

namespace Hospitalplugin\utils;

use Hospitalplugin\Entities\InfectionsCRUD;
use Hospitalplugin\Entities\Infections;

class ExcelExportInfections {
	private static function getData() {
		$wardId = (! empty ( $_POST ['wardId'] ) ? $_POST ['wardId'] : 0);
		$date = (! empty ( $_POST ['date'] ) ? $_POST ['date'] : (new \DateTime ())->format ( "Y-m" ));
		$from = new \DateTime ( $date . '-01' );
		$fromStr = $from->format ( 'Y-m-01' );
		$toStr = $from->format ( 'Y-m-t' );
		$infections = InfectionsCRUD::getInfections ( $fromStr, $toStr, $wardId, 'Infections' );
		return $infections;
	}
	private static function getColumns() {
		return Infections::getFields ();
	}
	private static function printHeaders($objPHPExcel, $cols) {
		$count = 0;
		foreach ( $cols as $col => $sym ) {
			$objPHPExcel->getActiveSheet ()->setCellValueByColumnAndRow ( $count ++, 2, sprintf ( "%7s", $col ) );
		}
	}
	/**
	 */
	private static function printData($objPHPExcel, $data, $cols) {
		$row = 3;
		foreach ( $data as $rowValue ) {
			$count = 0;
			foreach ( $cols as $col => $sym ) {
				$value = $rowValue->$sym;
				$objPHPExcel->getActiveSheet ()->setCellValueByColumnAndRow ( $count ++, $row, $value );
			}
			$row ++;
		}
		return $row;
	}
	private static function printTitle($objPHPExcel, $title) {
		$objPHPExcel->getActiveSheet ()->setCellValueByColumnAndRow ( 0, 1, $title );
	}
	/**
	 *
	 * @param PHPExcel $objPHPExcel        	
	 */
	private static function printFooter($objPHPExcel, $cols, $row) {
		$objPHPExcel->getActiveSheet ()->getStyle ( 'A' . $row . ':AA' . ($row + 1) )->getFont ()->setBold ( true );
		// SUM
		$objPHPExcel->getActiveSheet ()->setCellValueByColumnAndRow ( 1, $row, "SUMA" );
		for($i = 2; $i < count ( $cols ); $i ++) {
			$colLetter = chr ( 65 + $i );
			$objPHPExcel->getActiveSheet ()->setCellValueByColumnAndRow ( $i, $row, "=sum(" . $colLetter . "3" . ":" . $colLetter . ($row - 1) . ")" );
		}
		ExcelExport::cellColor ( $objPHPExcel, 'A' . $row . ':AA' . ($row + 1), 'DDDDDD' );
	}
	static function fillData($objPHPExcel) {
		$data = ExcelExportInfections::getData ();
		$cols = ExcelExportInfections::getColumns ();
		
		ExcelExportInfections::printTitle ( $objPHPExcel, "Raport" );
		ExcelExportInfections::printHeaders ( $objPHPExcel, $cols );
		$lastRow = ExcelExportInfections::printData ( $objPHPExcel, $data, $cols );
		ExcelExportInfections::printFooter ( $objPHPExcel, $cols, $lastRow );
	}
}