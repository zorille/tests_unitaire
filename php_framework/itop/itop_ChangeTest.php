<?php
namespace Zorille\itop;
use Zorille\framework as Core;
/**
 * @author dvargas
 * @package Lib
 *
 */
if (! defined ( '__DOCUMENT_ROOT__' )) {
	require_once $_SERVER ["PWD"] . '/prepare.php';
}
class ChangeTest extends Core\MockedListeOptions {
	/**
	 * @var Change
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
		$itop_Contact = $this ->createMock('Zorille\itop\Contact' );
		
		$this->object = new Change ( false, "TESTS Change" );
		$this->object ->setListeOptions ( $this ->getListeOption () ) 
			->setObjetItopWsclientRest ( $itop_wsclient_rest ) 
			->setObjetItopOrganization ( $itop_Organization ) 
			->setObjetItopContact ( $itop_Contact );
		
		$this->object ->getObjetItopOrganization () 
			->expects ( $this ->any () ) 
			->method ( 'creer_oql' ) 
			->will ( $this ->returnValue ( $itop_Organization ) );
		$this->object ->getObjetItopContact () 
			->expects ( $this ->any () ) 
			->method ( 'creer_oql' ) 
			->will ( $this ->returnValue ( $itop_Contact ) );
		
		$this->object ->setFormat ( 'Change' );
	}

	/**
	 * Tears down the fixture, for example, closes a network connection.
	 * This method is called after a test is executed.
	 */
	protected function tearDown() {
		ob_end_clean ();
	}

	/**
	 * @covers Zorille\itop\Change::retrouve_Change
	 */
	public function testretrouve_Change() {
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
		$this ->assertSame ( $this->object, $this->object ->retrouve_Change ( 'TITRE1' ) );
	}

	/**
	 * @covers Zorille\itop\Change::creer_oql
	 */
	public function testcreer_oql_all() {
		$this ->assertSame ( $this->object, $this->object ->creer_oql ( 'NAME1' ) );
		$this ->assertEquals ( "SELECT Change WHERE status NOT IN ('closed') AND title='NAME1'", $this->object ->getOqlCi () );
	}

	/**
	 * @covers Zorille\itop\Change::gestion_Change
	 */
	public function testgestion_Change() {
		$this->object ->getObjetItopWsclientRest () 
			->expects ( $this ->any () ) 
			->method ( 'core_get' ) 
			->will ( $this ->returnValue ( array ( 
				'objects' => array (), 
				'message' => 'Found: 0' ) ) );
		$this->object ->getObjetItopWsclientRest () 
			->expects ( $this ->any () ) 
			->method ( 'core_create' ) 
			->will ( $this ->returnValue ( array ( 
				'objects' => array ( 
						array ( 
								'class' => "CLASS1", 
								'key' => 10, 
								'fields' => array ( 
										'name' => 'NOM1' ) ) ), 
				'message' => 'Found: 1' ) ) );
		
		$this ->assertSame ( $this->object, $this->object ->gestion_Change ( 'TITRE1', 'ORG1', 'DESCRIPTION1', 1, 1, 'REQUESTER', array ( 
				'contacs' ), array ( 
				'CIs' ), array ( 
				'WorkOrders' ) ) );
	}
}
?>
