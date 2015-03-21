<?php
use Hospitalplugin\utils\PersonGenerator;
class PersonGeneratorTest extends PHPUnit_Framework_TestCase {
	function testGeneratedBirthDate() {
		$date = PersonGenerator::getRandomBirthDate ();
		$this->assertRegExp ( '/[0-9-]+/', $date );
		$this->assertEquals ( 10, strlen ( $date ) );
	}
	function testGeneratedPESEL() {
		$date = PersonGenerator::getRandomBirthDate ();
		$pesel = PersonGenerator::getRandomPesel ( $date );
		$this->assertRegExp ( '/[0-9]+/', $date );
		$this->assertEquals ( 11, strlen ( $pesel ) );
	}
	function testGeneratedPerson() {
		$person = PersonGenerator::getRandomPerson();
		$this->assertRegExp ( '/[A-Za-z ]+,[0-9]+/', $person );
	}
}