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
class SoftwareTest extends Core\MockedListeOptions {
	/**
	 * @var Software
	 */
	protected $object;

	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 */
	protected function setUp() {
		ob_start ();
		
		$itop_wsclient_rest = $this ->createMock('Zorille\itop\wsclient_rest' );
		
		$this->object = new Software ( false, "TESTS Software" );
		$this->object ->setListeOptions ( $this ->getListeOption () ) 
			->setObjetItopWsclientRest ( $itop_wsclient_rest );
		
		$this->object ->setFormat ( 'Software' );
	}

	/**
	 * Tears down the fixture, for example, closes a network connection.
	 * This method is called after a test is executed.
	 */
	protected function tearDown() {
		ob_end_clean ();
	}

	/**
	 * @covers Zorille\itop\Software::retrouve_Software
	 */
	public function testretrouve_Software() {
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
		$this ->assertSame ( $this->object, $this->object ->retrouve_Software ( 'NAME1', 'server_name' ) );
	}

	/**
	 * @covers Zorille\itop\Software::creer_oql
	 */
	public function testcreer_oql() {
		$this ->assertSame ( $this->object, $this->object ->creer_oql ( 'NAME1','server_name' ) );
		$this ->assertEquals ( "SELECT Software WHERE friendlyname='NAME1 server_name'", $this->object ->getOqlCi () );
	}
	
	/**
	 * @covers Zorille\itop\Software::creer_oql
	 */
	public function testcreer_oql_sans_servername() {
		$this ->assertSame ( $this->object, $this->object ->creer_oql ( 'NAME2 server_name' ) );
		$this ->assertEquals ( "SELECT Software WHERE friendlyname='NAME2 server_name'", $this->object ->getOqlCi () );
	}

	/**
	 * @covers Zorille\itop\Software::gestion_Software
	 */
	public function testgestion_Software() {
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
			
		$this ->assertSame ( $this->object, $this->object ->gestion_Software ( 'NAME1', 'VENDOR', '1.0', 'Middleware' ) );
	}
}
?>
