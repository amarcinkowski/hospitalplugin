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
	 * 
	 */
	public static function getColumnLetter($num) {
		return chr ( 65 + $num );
	}
	/**
	 */
	static function excel_export() {
		if (! isset ( $_POST ['excel'] )) {
			return;
		} else {
			// dataSetName: Infections, Punction
			$dataSetName = $_POST ['dataSetName'];
			$classname = '\Hospitalplugin\utils\ExcelExport' . $dataSetName;
		}
		
		$objPHPExcel = new \PHPExcel ();
		$classname::fillData ( $objPHPExcel );
		
		ExcelExport::downloadExcel ( $objPHPExcel, $dataSetName . '.xlsx' );
	}
	/**
	 */
	static function cellColor($objPHPExcel, $cells, $color) {
		$objPHPExcel->getActiveSheet ()->getStyle ( $cells )->getFill ()->applyFromArray ( array (
				'type' => \PHPExcel_Style_Fill::FILL_SOLID,
				'startcolor' => array (
						'rgb' => $color 
				) 
		) );
	}
	/**
	 */
	static function styleActiveSheet($objPHPExcel) {
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
	/**
	 * remove special chars and words from string 
	 * @param unknown $string        	
	 */
	private static function clearName($string, $removeWords) {
		$string = str_replace ( ' ', '-', $string );
		$string = preg_replace ( '/[^A-Za-z0-9\-]/', '', $string );
		foreach ( $removeWords as $word ) {
			$string = str_replace ( $word, '', $string );
		}
		$string = substr ( $string, 0, 29 );
		return $string;
	}
	/**
	 * @param unknown $objPHPExcel        	
	 * @param unknown $title        	
	 */
	static function printTitle($objPHPExcel, $title) {
		$objPHPExcel->getActiveSheet ()->setTitle ( ExcelExport::clearName ( $title, array('ddzia') ), true );
		$objPHPExcel->getActiveSheet ()->setCellValueByColumnAndRow ( 0, 1, $title );
	}
	/**
	 *
	 * @param unknown $objPHPExcel
	 */
	static function newSheet($objPHPExcel, $index = -1) {
		if ($index < 0) {
			$index = $objPHPExcel->getSheetCount ();
		}
		$objPHPExcel->createSheet ( $index );
		$objPHPExcel->setActiveSheetIndex ( $index );
		$sheet = $objPHPExcel->getActiveSheet ();
		return $sheet;
	}
	
}