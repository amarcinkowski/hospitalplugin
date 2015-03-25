<?php
// DO NOT CHANGE LINES ABOVE (see tests below) X
use Hospitalplugin\utils\Utils;
class UtilsTest extends PHPUnit_Framework_TestCase {
	function testDateFunctions() {
		$currentmonth = (new DateTime ())->format ( "m" );
		$currentday = (new DateTime ())->format ( "d" );
		
		$diff = Utils::diffDates ( "2015-05-17", "2015-05-18" );
		$this->assertEquals ( 1, $diff );
		$diff = Utils::diffDates ( "2015-05-17", "2015-06-17" );
		$this->assertEquals ( 31, $diff );
		$date = Utils::getNextDayDate ( "2015-05-17" );
		$this->assertEquals ( "2015-05-18", $date );
		$date = Utils::getNextMonthFirstDay ( 5, 17 );
		$this->assertTrue ( $this->endsWith ( $date, "06-01" ) );
		$date = Utils::getPreviousDay ( "2015-05-18" );
		$this->assertEquals ( "2015-05-17", $date );
		
		$date = Utils::getStartDate ();
		$this->assertEquals ( (new DateTime ())->format ( "Y-m-d" ), $date );
		$date = Utils::getStartDate ( $currentmonth );
		$this->assertEquals ( (new DateTime ())->format ( "Y-m-01" ), $date );
		$date = Utils::getStartDate ( $currentmonth, $currentday );
		$this->assertEquals ( (new DateTime ())->format ( "Y-m-d" ), $date );
		
		$date = Utils::getEndDate ();
		$this->assertEquals ( Utils::getNextDay ( $currentmonth, $currentday ), $date );
		$date = Utils::getEndDate ( $currentmonth );
		$this->assertEquals ( Utils::getNextMonthFirstDay ( $currentmonth, $currentday ), $date );
		$date = Utils::getEndDate ( $currentmonth, $currentday );
		$this->assertEquals ( Utils::getNextDay ( $currentmonth, $currentday ), $date );
		
		$this->assertEquals ( Utils::getStartEndDate ( 7 )['startDate'], Utils::getDateWeekAgo () );
		$this->assertEquals ( Utils::getStartEndDate ( 1 )['startDate'], Utils::getPreviousDay ( (new \DateTime ())->format ( "y-m-d" ) ) );
		$this->assertEquals ( Utils::getStartEndDate ( 0 )['startDate'], (new \DateTime ())->format ( "Y-m-d" ) );
		
		$dateweekago = Utils::getDateWeekAgo ();
		$date = (new DateTime ())->format ( "y-m-d" );
		$this->assertEquals ( Utils::diffDates ( $dateweekago, $date ), 7 );
	}
	function testReadFile() {
		$fileInArray = Utils::readFileToArray ( __FILE__ );
		$firstLine = ($fileInArray [0] [0]);
		$this->assertEquals ( $firstLine, "<?php" );
		$fileInArray = Utils::readFileToArray ( __FILE__, ';', '\"', true );
	}
	function testEncoding() {
		$this->assertEquals ( Utils::w1250_to_utf8 ( "" . chr ( 0xB1 ) ), 'ą' );
	}
	function testCast() {
		$d = new DateTime ();
		$this->assertEquals ( Utils::cast ( '\DateTime', $d ), $d );
	}
	function endsWith($haystack, $needle) {
		// search forward starting from end minus needle length characters
		return $needle === "" || (($temp = strlen ( $haystack ) - strlen ( $needle )) >= 0 && strpos ( $haystack, $needle, $temp ) !== FALSE);
	}
}