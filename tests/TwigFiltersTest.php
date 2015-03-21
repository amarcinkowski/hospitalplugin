<?php
use Hospitalplugin\Twig\EscapePLCharsExtension;
use Hospitalplugin\Twig\GetPropertiesExtension;
use Hospitalplugin\utils\PersonGenerator;
use Hospitalplugin\utils\Utils;

/**
 * helper class
 */
class PatientABC {
	public $aktywnoscFizyczna;
	public $higiena;
}
class TwigFiltersTest extends PHPUnit_Framework_TestCase {
	function testEscape() {
		$e = new EscapePLCharsExtension ();
		$e->getFilters ();
		$e->getName ();
		// pl chars
		$string = $e->escapePLcharsFilter ( "ĄĆĘŁŃÓŚŹŻąćęłńóśźż" );
		$this->assertEquals ( $string, "ACELNOSZZacelnoszz" );
		// camelCase + rem whitesp
		$string = $e->escapePLcharsFilter ( "a b c d" );
		$this->assertEquals ( $string, "ABCD" );
		// pl chars + camel + rem white
		$string = $e->escapePLcharsFilter ( "Aż bu ćw dł ęóś" );
		$this->assertEquals ( $string, "AzBuCwDlEos" );
		// hyphen char
		$string = $e->escapePLcharsFilter ( "Aż - bu - ćw-dł-ęóś" );
		$this->assertEquals ( $string, "AzBuCwdleos" );
	}
	function testProps() {
		// having
		$p = new GetPropertiesExtension ();
		$p->getFilters ();
		$p->getName ();
		$patientABC = new PatientABC ();
		// get properties
		$props = $p->getPropsFilter ( $patientABC, array (), array (), array () );
		// check
		$this->assertTrue ( TwigFiltersTest::hasParam ( $props, 'aktywnoscFizyczna' ), "param" );
		// remove aktywnoscFizyczna
		$props = $p->getPropsFilter ( $patientABC, array (
				'aktywnoscFizyczna' 
		), array (), array () );
		$this->assertTrue ( ! TwigFiltersTest::hasParam ( $props, '"data":"aktywnoscFizyczna"' ), "param removed" );
		$this->assertTrue ( TwigFiltersTest::hasParam ( $props, '"data":"higiena"' ), "snd param" );
		// change name aktywnoscFizyczna to AF
		$props = $p->getPropsFilter ( $patientABC, array (), array (
				'aktywnoscFizyczna' => 'AF' 
		), array () );
		$this->assertTrue ( ! TwigFiltersTest::hasParam ( $props, '"data":"aktywnoscFizyczna"' ), "no param changed" );
		$this->assertTrue ( TwigFiltersTest::hasParam ( $props, '"data":"AF"' ), "param changed" );
		// set title aktywnoscFizyczna to Aktywność Fizyczna
		$props = $p->getPropsFilter ( $patientABC, array (), array (), array (
				'aktywnoscFizyczna' => 'Aktywność Fizyczna' 
		) );
		$this->assertTrue ( TwigFiltersTest::hasParam ( $props, '"data":"aktywnoscFizyczna"' ) );
		$this->assertTrue ( TwigFiltersTest::hasParam ( $props, '"title":"Aktywno\u015b\u0107\u00a0Fizyczna"' ) );
		$this->assertTrue ( TwigFiltersTest::hasParam ( $props, '"data":"higiena"' ) );
		$this->assertTrue ( TwigFiltersTest::hasParam ( $props, '"title":"H"' ) );
	}
	
	/**
	 * hasParam
	 *
	 * helper function
	 *
	 * @param unknown $obj        	
	 * @param unknown $prop        	
	 * @return boolean
	 */
	private static function hasParam($obj, $prop) {
		return strpos ( json_encode ( $obj ), $prop ) !== FALSE;
	}
}

