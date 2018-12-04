<?php
namespace Zorille\framework;
use \Exception as Exception;
/**
 * @ignore
 */
if (! defined ( '__DOCUMENT_ROOT__' )) {
	require_once $_SERVER ["PWD"] . '/prepare.php';
}

/**
 * Test class for fichier_gz.
 * Generated by PHPUnit on 2010-08-09 at 10:02:40.
 */
class fichier_gzTest extends MockedListeOptions {
	/**
	 * @var fichier_gz
	 */
	protected $object;
	protected $nom_fichier = "/tmp/fichier_test.gz";
	protected $nom_fichier_non_comp = "/tmp/fichier_test_local";
	protected $nom_fichier_false = "/tmp/fichier_test_false.gz";

	public static function tearDownAfterClass() {
		system ( "rm -f /tmp/fichier_test*", $retour );
	}

	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 */
	protected function setUp() {
		ob_start ();
		$this->object = new fichier_gz ( $this->nom_fichier, "oui", false, "TESTS fichier_gz" );
	}

	/**
	 * Tears down the fixture, for example, closes a network connection.
	 * This method is called after a test is executed.
	 */
	protected function tearDown() {
		ob_end_clean ();
	}

	/**
	 * @covers Zorille\framework\fichier::__construct
	 */
	public function testNewFichier_Exception() {
		$this ->expectException(Exception::class);
        $this->expectExceptionMessage( '(TESTS fichier_gz) Erreur le fichier GZ : /tmp/fichier_test_false.gz n\'existe pas' );
		$this->object_false = new fichier_gz ( $this->nom_fichier_false, "non", false, "TESTS fichier_gz" );
	}

	/**
	 * Implement testOuvrir().
	 */
	public function testOuvrir() {
		$this ->assertTrue ( $this->object ->ouvrir ( "w" ) );
		$this->object ->close ();
	}

	/**
	 * Implement testEcrit().
	 */
	public function testEcrit() {
		$this->object ->ouvrir ( "a" );
		$this ->assertTrue ( $this->object ->ecrit ( "ceci est un test\n" ) );
		$this->object ->ecrit ( "ceci est un test bis\n" );
		$this->object ->close ();
	}

	/**
	 * Implement testLit_une_ligne().
	 */
	public function testLit_une_ligne() {
		$this->object ->ouvrir ( "r" );
		$this ->assertEquals ( "ceci est un test\n", $this->object ->lit_une_ligne () );
		$this ->assertEquals ( "cec", $this->object ->lit_une_ligne ( 4 ) );
		$this->object ->close ();
	}

	/**
	 * Implement testLit_fichier().
	 */
	public function testLit_fichier() {
		$this ->assertEquals ( array ( 
				0 => "ceci est un test\n", 
				1 => "ceci est un test bis\n" ), fichier_gz::lit_fichier ( $this->nom_fichier ) );
		
		$this ->assertFalse ( fichier_gz::lit_fichier () );
	}

	/**
	 * Implement testCompresse().
	 */
	public function testCompresse() {
		$fichier = new fichier ( $this->nom_fichier_non_comp, "oui", false );
		$fichier ->ouvrir ( "w" );
		$fichier ->ecrit ( "test de compression" );
		$fichier ->close ();
		
		$this->object ->ouvrir ( "w" );
		$this ->assertTrue ( $this->object ->compresse ( $this->nom_fichier_non_comp, 5 ) );
		$this->object ->close ();
		$this ->expectException(Exception::class);
        $this->expectExceptionMessage( '(TESTS fichier_gz) Le fichier /tmp/fichier_test_false.gz ne peut pas etre lu.' );
		$this->object ->compresse ( $this->nom_fichier_false, 5 );
	}

	/**
	 * Implement testDecompresse().
	 */
	public function testDecompresse_exception1() {
		$this ->expectException(Exception::class);
        $this->expectExceptionMessage( '(TESTS fichier_gz) Il manque un nom de fichier : /tmp/fichier_test.gz ' );
		$this->object ->decompresse ( $this->nom_fichier, "" );
	}

	/**
	 * Implement testDecompresse().
	 */
	public function testDecompresse_exception2() {
		$this ->expectException(Exception::class);
        $this->expectExceptionMessage( '(TESTS fichier_gz) Il manque un nom de fichier :  /tmp/fichier_test_local' );
		$this->object ->decompresse ( "", $this->nom_fichier_non_comp );
	}

	/**
	 * Implement testDecompresse().
	 */
	public function testDecompresse_exception3() {
		$this ->expectException(Exception::class);
        $this->expectExceptionMessage( '(TESTS fichier_gz) Le fichier /tmp/fichier_test_false.gz ne peut pas etre lu.' );
		$this->object ->decompresse ( $this->nom_fichier_false, $this->nom_fichier_non_comp );
	}

	/**
	 * Implement testDecompresse().
	 */
	public function testDecompresse_valide() {
		$this ->assertTrue ( $this->object ->decompresse ( $this->nom_fichier, $this->nom_fichier_non_comp ) );
	}

	/**
	 * Implement testClose().
	 */
	public function testClose() {
		$this->object ->ouvrir ( "r" );
		$this ->assertTrue ( $this->object ->close () );
	}
}
?>
