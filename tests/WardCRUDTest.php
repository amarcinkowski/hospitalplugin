<?php
use Hospitalplugin\utils\PersonGenerator;
use Hospitalplugin\Entities\WardCRUD;
use Hospitalplugin\Entities\Ward;
class WardCRUDTest extends PHPUnit_Framework_TestCase {
	private static function getWard() {
		$w = new Ward ();
		$w->setId ( 1 );
		$w->setInfomedica("A");
		$w->setKomorkaOrg("B");
		$w->setKierownik("C");
		$w->setTypOddzialu("D");
		$w->setAdres("E");
		$w->setOpis("F");
		$w->setKondygnacja("0");
		$w->setPododdzial("1");
		$w->setOdcinek("3");
		$w->setName ( "Oddział Anestezjologii i Intensywnej Terapii" );
		return $w;
	}
	function testAddWard() {
		$ward = WardCRUDTest::getWard ();
		WardCRUD::addWard ( $ward );
	}
	function testGetWards() {
		$wards = WardCRUD::getWardsArray ();
		$this->assertTrue ( count ( $wards ) > 0 );
		$ward = ( object ) $wards [0];
		$this->assertEquals ( $ward->getName (), "Oddział Anestezjologii i Intensywnej Terapii" );
	}
}