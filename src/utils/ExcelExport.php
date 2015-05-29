<?php

namespace Hospitalplugin\utils;

use Hospitalplugin\Entities\InfectionsCRUD;
use Hospitalplugin\Entities\Infections;

class ExcelExport {
	
	/**
	 */
	public static function init() {
		add_action ( 'admin_init', array (
				'Hospitalplugin\utils\ExcelExport',
				'excel_export' 
		), 1 );
	}
	
	/**
	 */
	static function excel_export() {
		if (! isset ( $_POST ['excel'] )) {
			return;
		} else {
			// dataSetName: Infections,
			$dataSetName = $_POST ['dataSetName'];
			$data = ExcelExport::getData ( $dataSetName );
			$cols = ExcelExport::getColumns ( $dataSetName );
		}
		
		$objPHPExcel = ExcelExport::createExcelSheet ();
		ExcelExport::printTitle ( $objPHPExcel, "Raport Epidemiologiczny" );
		ExcelExport::fillData ( $objPHPExcel, $data, $cols );
		
		ExcelExport::downloadExcel ( $objPHPExcel, $dataSetName . '.xlsx' );
	}
	/**
	 */
	private static function cellColor($objPHPExcel, $cells, $color) {
		$objPHPExcel->getActiveSheet ()->getStyle ( $cells )->getFill ()->applyFromArray ( array (
				'type' => \PHPExcel_Style_Fill::FILL_SOLID,
				'startcolor' => array (
						'rgb' => $color 
				) 
		) );
	}
	private static function getData($type) {
		if ($type == 'Infections') {
			$wardId = (! empty ( $_POST ['wardId'] ) ? $_POST ['wardId'] : 0);
			$date = (! empty ( $_POST ['date'] ) ? $_POST ['date'] : (new \DateTime ())->format ( "Y-m" ));
			$from = new \DateTime ( $date . '-01' );
			$fromStr = $from->format ( 'Y-m-01' );
			$toStr = $from->format ( 'Y-m-t' );
			$infections = InfectionsCRUD::getInfections ( $fromStr, $toStr, $wardId, 'Infections' );
			return $infections;
		}
	}
	private static function getColumns($type) {
		if ($type = 'Infections') {
			return Infections::getFields ();
		}
	}
	/**
	 */
	private static function createExcelSheet() {
		$objPHPExcel = new \PHPExcel ();
		$objPHPExcel->getProperties ()->setTitle ( "export" )->setDescription ( "excel export" );
		$objPHPExcel->setActiveSheetIndex ( 0 );
		
		$objPHPExcel->getActiveSheet ()->getDefaultStyle ()->getFont ()->setName ( 'Arial' )->setSize ( 8 )->setBold ( false );
		$objPHPExcel->getActiveSheet ()->getDefaultStyle ()->getNumberFormat ()->setFormatCode ( \PHPExcel_Style_NumberFormat::FORMAT_TEXT );
		$objPHPExcel->getActiveSheet ()->freezePane ( 'A3' );
		$style = array (
				'alignment' => array (
						'horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
						'vertical' => \PHPExcel_Style_Alignment::VERTICAL_CENTER 
				) 
		);
		$objWorksheet = $objPHPExcel->getActiveSheet ();
		$objWorksheet->setTitle ( 'epidemio', true );
		$objWorksheet->getDefaultStyle ()->applyFromArray ( $style );
		$objWorksheet->getStyle ( 'A1:AA2' )->getFont ()->setBold ( true );
		for($col = ord ( 'a' ); $col <= ord ( 'z' ); $col ++) {
			$objWorksheet->getColumnDimension ( chr ( $col ) )->setAutoSize ( true );
		}
		return $objPHPExcel;
	}
	/**
	 *
	 * @param unknown $objPHPExcel        	
	 */
	private static function downloadExcel($objPHPExcel, $filename) {
		ob_end_clean ();
		ob_start ();
		// header("Content-type: application/x-download");
		// header('Content-Type: application/octet-stream');
		header ( "Content-type: application/vnd.ms-excel; charset=utf-8" );
		header ( "Content-Transfer-Encoding: binary" );
		header ( "Content-Description: File Transfer" );
		header ( "Content-Disposition: attachment; filename=\"" . $filename . "\"" );
		header ( "Cache-Control: max-age=0" );
		header ( "Expires: 0" );
		header ( "Pragma: no-cache" );
		
		$objWriter = \PHPExcel_IOFactory::createWriter ( $objPHPExcel, 'Excel2007' );
		$objWriter->setPreCalculateFormulas ( true );
		$objWriter->save ( 'php://output' );
		exit ();
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
		$objPHPExcel->getActiveSheet ()->setCellValueByColumnAndRow ( 1, $row + 1, "ŚREDNIA" );
		for($i = 2; $i < count ( $cols ); $i ++) {
			$colLetter = chr ( 65 + $i );
			$objPHPExcel->getActiveSheet ()->getStyleByColumnAndRow ( $i, $row + 1 )->getNumberFormat ()->setFormatCode ( '0.00' );
			$objPHPExcel->getActiveSheet ()->setCellValueByColumnAndRow ( $i, $row + 1, "=average(" . $colLetter . "3" . ":" . $colLetter . ($row - 1) . ")" );
		}
		ExcelExport::cellColor ( $objPHPExcel, 'A' . $row . ':AA' . ($row + 1), 'DDDDDD' );
	}
	private static function fillData($objPHPExcel, $data, $cols) {
		ExcelExport::printHeaders ( $objPHPExcel, $cols );
		$lastRow = ExcelExport::printData ( $objPHPExcel, $data, $cols );
		ExcelExport::printFooter ( $objPHPExcel, $cols, $lastRow );
	}
}