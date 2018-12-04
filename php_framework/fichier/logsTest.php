<?php
namespace Zorille\framework;
/**
 * @ignore
 */
if (! defined ( '__DOCUMENT_ROOT__' )) {
	require_once $_SERVER ["PWD"] . '/prepare.php';
}

class testZ {
	var $var="TEST";
}

/**
 * Test class for logs.
 * Generated by PHPUnit on 2010-08-03 at 10:44:27.
 */
class logsTest extends MockedListeOptions {
	/**
	 * @var logs
	 */
	protected $object;
	protected $object_compress;
	protected $object_no_file;

	public static function tearDownAfterClass() {
		system ( "rm -Rf /tmp/test_log_*", $retour );
	}

	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 */
	protected function setUp() {
		ob_start ();
		
		$this->object = new logs ( 0, "oui", "/tmp", "test_log", "oui", "non", "non", "oui" );
		$this->object_compress = new logs ( 0, "oui", "/tmp", "test_log_compress", "oui", "non", "oui" );
		$this->object_no_file = new logs ( 0, "non", "/", "test_log_compress", "oui", "non", "oui" );
	}

	/**
	 * Tears down the fixture, for example, closes a network connection.
	 * This method is called after a test is executed.
	 */
	protected function tearDown() {
		ob_end_clean ();
	}

	protected function open_file() {
		$this->object->ouvre_fichier_log ( $this->getListeOption() );
		$this->object_compress->ouvre_fichier_log ( $this->getListeOption() );
	}

	/**
	 * Implement testOuvre_fichier_log().
	 */
	public function testOuvre_fichier_log() {
		$this->assertTrue ( $this->object->ouvre_fichier_log ( $this->getListeOption() ) );
		$this->assertTrue ( $this->object_compress->ouvre_fichier_log ( $this->getListeOption() ) );
		
		$this->assertFalse ( $this->object_no_file->ouvre_fichier_log ( $this->getListeOption() ) );
	}

	/**
	 * Implement testAjouter_fichier_log().
	 */
	public function testAjouter_fichier_log() {
		$this->open_file ();
		$this->assertTrue ( $this->object->ajouter_fichier_log ( "test d'ajout" ) );
		$this->assertTrue ( $this->object_compress->ajouter_fichier_log ( "test d'ajout" ) );
		
		$this->assertFalse ( $this->object_no_file->ajouter_fichier_log ( "test d'ajout no file" ) );
	}

	/**
	 * Implement testFerme_fichier_log().
	 */
	public function testFerme_fichier_log() {
		$this->open_file ();
		$this->assertTrue ( $this->object->ferme_fichier_log () );
		$this->assertTrue ( $this->object_compress->ferme_fichier_log () );
		
		$this->assertFalse ( $this->object_no_file->ferme_fichier_log () );
	}

	/**
	 * Implement testgetExit().
	 */
	public function testgetExit() {
		//code de depart = 0
		$this->assertEquals ( 0, $this->object->renvoiExit () );
		//code de sortie en erreur
		$this->object->setExit ( 1 );
		$this->assertEquals ( 1, $this->object->renvoiExit () );
		//code de sortie a true aprés un code a 1 ne doit rien faire
		$this->object->setExit ( true );
		$this->assertEquals ( 1, $this->object->renvoiExit () );
		//On force la valeur du Exit
		$this->object->setExit ( true, true );
		$this->assertEquals ( 0, $this->object->renvoiExit () );
		//On force a false
		$this->object->setExit ( false, true );
		$this->assertEquals ( 1, $this->object->renvoiExit () );
		//On force a ""
		$this->object->setExit ( "", true );
		$this->assertEquals ( 0, $this->object->renvoiExit () );
	}

	/**
	 * Implement valide_exit_web().
	 */
	public function testValide_exit_web() {
		$this->assertNull ( $this->object->valide_exit_web () );
		
		$this->object->setIsWeb ( true );
		$this->assertNull ( $this->object->valide_exit_web () );
		
		$this->object->setErrorList ( "E1" );
		$this->object->setErrorList ( "E2" );
		$this->object->setExit ( 1 );
		$this->assertNull ( $this->object->valide_exit_web () );
	}

	/**
	 * Implement testprepare_affichage().
	 */
	public function testprepare_affichage_string() {
		$this->assertEquals ( "TestZ\n", $this->object->prepare_affichage ( "TestZ" ) );
	}
	
	/**
	 * Implement testprepare_affichage().
	 */
	public function testprepare_affichage_array() {
		$this->assertEquals ( "Array\n(\n    [0] => TestZ\n)\n\n", $this->object->prepare_affichage ( array("TestZ") ) );
	}
	
	/**
	 * Implement testprepare_affichage().
	 */
	public function testprepare_affichage_objet() {
		$this->assertEquals ( 'Zorille\framework\testZ '."Object\n(\n    [var] => TEST\n)\n\n", $this->object->prepare_affichage ( new testZ() ) );
	}
	
	/**
	 * Implement testVerbose().
	 */
	public function testVerbose() {
		$this->assertTrue ( $this->object->verbose ( "TestZ" ) );
		$this->assertTrue ( $this->object->verbose ( "TestZ", 0 ) );
		$this->assertTrue ( $this->object->verbose ( array (
				"TestZ" 
		) ) );
		$this->assertTrue ( $this->object->verbose ( $this->object ) );
		
		$this->object->setIsWeb ( true );
		$this->assertTrue ( $this->object->verbose ( "TestZ" ) );
	}

	/**
	 * Implement testaffiche_erreur().
	 */
	public function testaffiche_erreur() {
		$this->object->setIsErrorStdout ( true );
		$this->assertSame ( $this->object, $this->object->affiche_erreur ( "TestZ" ) );
		$this->assertEquals ( array (
				'TestZ' 
		), $this->object->getErrorList () );
	}

	/**
	 * Implement testVerbose().
	 */
	public function testValideVerbose() {
		$this->assertFalse ( $this->object->valideVerbose ( 3 ) );
		
		$this->assertTrue ( $this->object->valideVerbose ( 1 ) );
	}

	/**
	 * Implement testOnError().
	 */
	public function testlogs_onError() {
		$this->object->setIsErrorStdout ( true );
		$this->assertFalse ( $this->object->logs_onError ( "OnError" ) );
	}
}
?>
