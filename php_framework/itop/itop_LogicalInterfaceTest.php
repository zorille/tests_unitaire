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
class LogicalInterfaceTest extends Core\MockedListeOptions {
	/**
	 * @var LogicalInterface
	 */
	protected $object;

	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 */
	protected function setUp() {
		ob_start ();
		
		$itop_wsclient_rest = $this ->createMock('Zorille\itop\wsclient_rest' );
		$itop_VirtualMachine = $this ->createMock('Zorille\itop\VirtualMachine' );
		
		$this->object = new LogicalInterface ( false, "TESTS LogicalInterface" );
		$this->object ->setListeOptions ( $this ->getListeOption () ) 
			->setObjetItopWsclientRest ( $itop_wsclient_rest ) 
			->setObjetItopVirtualMachine ( $itop_VirtualMachine );
		
		$this->object ->getObjetItopVirtualMachine () 
			->expects ( $this ->any () ) 
			->method ( 'creer_oql' ) 
			->will ( $this ->returnValue ( $itop_VirtualMachine ) );
		$this->object ->setFormat ( 'LogicalInterface' );
	}

	/**
	 * Tears down the fixture, for example, closes a network connection.
	 * This method is called after a test is executed.
	 */
	protected function tearDown() {
		ob_end_clean ();
	}

	/**
	 * @covers Zorille\itop\LogicalInterface::retrouve_LogicalInterface
	 */
	public function testretrouve_LogicalInterface() {
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
		$this ->assertSame ( $this->object, $this->object ->retrouve_LogicalInterface ( 'NAME1','server_name' ) );
	}

	/**
	 * @covers Zorille\itop\LogicalInterface::creer_oql
	 */
	public function testcreer_oql() {
		$this ->assertSame ( $this->object, $this->object ->creer_oql ( 'NAME1','server_name' ) );
		$this ->assertEquals ( "SELECT LogicalInterface WHERE friendlyname='NAME1 server_name'", $this->object ->getOqlCi () );
	}
	
	/**
	 * @covers Zorille\itop\LogicalInterface::creer_oql
	 */
	public function testcreer_oql_sans_servername() {
		$this ->assertSame ( $this->object, $this->object ->creer_oql ( 'NAME2 server_name' ) );
		$this ->assertEquals ( "SELECT LogicalInterface WHERE friendlyname='NAME2 server_name'", $this->object ->getOqlCi () );
	}

	/**
	 * @covers Zorille\itop\LogicalInterface::gestion_LogicalInterface
	 */
	public function testgestion_LogicalInterface() {
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
			
		$this ->assertSame ( $this->object, $this->object ->gestion_LogicalInterface ( 'NAME1', 'server_name', '1.1.1.2', 'aef0-afea-2947','1.1.1.1','255.255.255.255' ) );
	}
}
?>
