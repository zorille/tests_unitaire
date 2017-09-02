<?php
/**
 * @author dvargas
 * @package Lib
 *
 */
if (! defined ( '__DOCUMENT_ROOT__' )) {
	require_once $_SERVER ["PWD"] . '/prepare.php';
}
class itop_ContactTest extends MockedListeOptions {
	/**
	 * @var itop_Contact
	 */
	protected $object;

	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 */
	protected function setUp() {
		ob_start ();
		
		$itop_wsclient_rest = $this ->createMock ( "itop_wsclient_rest" );
		$itop_Organization = $this ->createMock ( "itop_Organization" );
		
		$this->object = new itop_Contact ( false, "TESTS itop_Contact" );
		$this->object ->setListeOptions ( $this ->getListeOption () ) 
			->setObjetItopWsclientRest ( $itop_wsclient_rest ) 
			->setObjetItopOrganization ( $itop_Organization );
		
		$this->object ->getObjetItopOrganization () 
			->expects ( $this ->any () ) 
			->method ( 'creer_oql' ) 
			->will ( $this ->returnValue ( $itop_Organization ) );
		$this->object ->setFormat ( 'Contact' );
	}

	/**
	 * Tears down the fixture, for example, closes a network connection.
	 * This method is called after a test is executed.
	 */
	protected function tearDown() {
		ob_end_clean ();
	}

	/**
	 * @covers itop_Contact::retrouve_Contact
	 */
	public function testretrouve_Contact() {
		$this->object ->getObjetItopWsclientRest () 
			->expects ( $this ->any () ) 
			->method ( 'core_get' ) 
			->will ( $this ->returnValue ( array ( 
				'objects' => array ( 
						array ( 
								'class' => "CLASS1", 
								'key' => 10, 
								'fields' => array ( 
										'name' => 'NOM1' ) ) ), 
				'message' => 'Found: 1' ) ) );
		$this ->assertSame ( $this->object, $this->object ->retrouve_Contact ( 'NAME1', 'EMAIL1') );
	}

	/**
	 * @covers itop_Contact::creer_oql
	 */
	public function testcreer_oql() {
		$this ->assertSame ( $this->object, $this->object ->creer_oql ( 'NAME1', 'EMAIL1' ) );
		$this ->assertEquals ( "SELECT Contact WHERE name='NAME1' AND  email='EMAIL1'", $this->object ->getOqlCi () );
	}
	

	/**
	 * @covers itop_Contact::creer_lnkContactToFunctionalCI
	 */
	public function testcreer_lnkContactToFunctionalCI_exception() {
		$this->object ->setFormat ( "Contact" )
		->setDonnees ( array (
				'name' => 'NOM2' ) );
	
		$this ->expectException(Exception::class);
        $this->expectExceptionMessage( '(TESTS itop_Contact) Il faut un ID a cette Contact' );
		$this->object ->creer_lnkContactToFunctionalCI ( "FRIENDLYNAME", 15 );
	}
	
	/**
	 * @covers itop_Contact::creer_lnkContactToFunctionalCI
	 */
	public function testcreer_lnkContactToFunctionalCI() {
		$this->object ->setId ( 10 )
		->setFormat ( "Team" )
		->setDonnees ( array (
				'name' => 'NOM2' ) );
	
		$this ->assertEquals ( array (
				'contact_id' => 10,
				'contact_name' => 'NOM2',
				'functionalci_id' => 'FRIENDLYNAME',
				'functionalci_name' => 15 ), $this->object ->creer_lnkContactToFunctionalCI ( "FRIENDLYNAME", 15 ) );
	}
}
?>
