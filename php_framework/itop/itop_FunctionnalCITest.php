<?php
/**
 * @author dvargas
 * @package Lib
 *
 */
if (! defined ( '__DOCUMENT_ROOT__' )) {
	require_once $_SERVER ["PWD"] . '/prepare.php';
}
class itop_FunctionalCITest extends MockedListeOptions {
	/**
	 * @var itop_FunctionalCI
	 */
	protected $object;

	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 */
	protected function setUp() {
		ob_start ();
		
		$itop_wsclient_rest = $this ->createMock ( "itop_wsclient_rest" );
		
		$this->object = new itop_FunctionalCI ( false, "TESTS itop_FunctionalCI" );
		$this->object ->setListeOptions ( $this ->getListeOption () ) 
			->setObjetItopWsclientRest ( $itop_wsclient_rest );
	}

	/**
	 * Tears down the fixture, for example, closes a network connection.
	 * This method is called after a test is executed.
	 */
	protected function tearDown() {
		ob_end_clean ();
	}

	/**
	 * @covers itop_FunctionalCI::creer_lnkApplicationSolutionToFunctionalCI
	 */
	public function testcreer_lnkApplicationSolutionToFunctionalCI() {
		$this->object ->setId ( 10 ) 
			->setFormat ( "CI" ) 
			->setDonnees ( array ( 
				'name' => 'NOM2' ) );
		
		$this ->assertEquals ( array ( 
				'functionalci_id' => 10, 
				'functionalci_name' => 'NOM2', 
				'friendlyname' => 'FRIENDLYNAME', 
				'functionalci_id_friendlyname' => 15, 
				'functionalci_id_finalclass_recall' => 'CI' ), $this->object ->creer_lnkApplicationSolutionToFunctionalCI ( "FRIENDLYNAME", 15 ) );
	}

	/**
	 * @covers itop_FunctionalCI::creer_lnkContactToFunctionalCI
	 */
	public function testcreer_lnkContactToFunctionalCI() {
		$this->object ->setId ( 10 ) 
			->setFormat ( "CI" ) 
			->setDonnees ( array ( 
				'name' => 'NOM3' ) );
		
		$this ->assertEquals ( array ( 
				'functionalci_id' => 10, 
				'functionalci_name' => 'NOM3', 
				'contact_id' => 12, 
				'contact_name' => 'CONTACT1' ), $this->object ->creer_lnkContactToFunctionalCI ( 12, "CONTACT1" ) );
	}
	
	/**
	 * @covers itop_FunctionalCI::creer_lnkToFunctionalCI
	 */
	public function testcreer_lnkToFunctionalCI() {
		$this->object ->setId ( 11 )
		->setFormat ( "CI" )
		->setDonnees ( array (
				'name' => 'NOM4' ) );
	
		$this ->assertEquals ( array (
				'functionalci_id' => 11,
				'functionalci_name' => 'NOM4' ), $this->object ->creer_lnkToFunctionalCI () );
	}
}
?>
