<?php
namespace Zorille\itop;
use Zorille\framework as Core;
use \Exception as Exception;
/**
 * @author dvargas
 * @package Lib
 *
 */
if (! defined ( '__DOCUMENT_ROOT__' )) {
	require_once $_SERVER ["PWD"] . '/prepare.php';
}
class ContactTest extends Core\MockedListeOptions {
	/**
	 * @var Contact
	 */
	protected $object;

	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 */
	protected function setUp() {
		ob_start ();
		
		$itop_wsclient_rest = $this ->createMock('Zorille\itop\wsclient_rest' );
		$itop_Organization = $this ->createMock('Zorille\itop\Organization' );
		
		$this->object = new Contact ( false, "TESTS Contact" );
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
	 * @covers Zorille\itop\Contact::retrouve_Contact
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
	 * @covers Zorille\itop\Contact::creer_oql
	 */
	public function testcreer_oql() {
		$this ->assertSame ( $this->object, $this->object ->creer_oql ( 'NAME1', 'EMAIL1' ) );
		$this ->assertEquals ( "SELECT Contact WHERE name='NAME1' AND  email='EMAIL1'", $this->object ->getOqlCi () );
	}
	

	/**
	 * @covers Zorille\itop\Contact::creer_lnkContactToFunctionalCI
	 */
	public function testcreer_lnkContactToFunctionalCI_exception() {
		$this->object ->setFormat ( "Contact" )
		->setDonnees ( array (
				'name' => 'NOM2' ) );
	
		$this ->expectException(Exception::class);
        $this->expectExceptionMessage( '(TESTS Contact) Il faut un ID a cette Contact' );
		$this->object ->creer_lnkContactToFunctionalCI ( "FRIENDLYNAME", 15 );
	}
	
	/**
	 * @covers Zorille\itop\Contact::creer_lnkContactToFunctionalCI
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
