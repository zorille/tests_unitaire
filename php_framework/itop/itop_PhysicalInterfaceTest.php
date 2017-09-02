<?php
/**
 * @author dvargas
 * @package Lib
 *
 */
if (! defined ( '__DOCUMENT_ROOT__' )) {
	require_once $_SERVER ["PWD"] . '/prepare.php';
}
class itop_PhysicalInterfaceTest extends MockedListeOptions {
	/**
	 * @var itop_PhysicalInterface
	 */
	protected $object;

	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 */
	protected function setUp() {
		ob_start ();
		
		$itop_wsclient_rest = $this ->createMock ( "itop_wsclient_rest" );
		
		$this->object = new itop_PhysicalInterface ( false, "TESTS itop_PhysicalInterface" );
		$this->object ->setListeOptions ( $this ->getListeOption () ) 
			->setObjetItopWsclientRest ( $itop_wsclient_rest );
		
		$this->object ->setFormat ( 'PhysicalInterface' );
	}

	/**
	 * Tears down the fixture, for example, closes a network connection.
	 * This method is called after a test is executed.
	 */
	protected function tearDown() {
		ob_end_clean ();
	}

	/**
	 * @covers itop_PhysicalInterface::retrouve_PhysicalInterface
	 */
	public function testretrouve_PhysicalInterface() {
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
		$this ->assertSame ( $this->object, $this->object ->retrouve_PhysicalInterface ( 'NAME1','server_name' ) );
	}

	/**
	 * @covers itop_PhysicalInterface::creer_oql
	 */
	public function testcreer_oql() {
		$this ->assertSame ( $this->object, $this->object ->creer_oql ( 'NAME1','server_name' ) );
		$this ->assertEquals ( "SELECT PhysicalInterface WHERE friendlyname='NAME1 server_name'", $this->object ->getOqlCi () );
	}
	
	/**
	 * @covers itop_PhysicalInterface::creer_oql
	 */
	public function testcreer_oql_sans_servername() {
		$this ->assertSame ( $this->object, $this->object ->creer_oql ( 'NAME2 server_name' ) );
		$this ->assertEquals ( "SELECT PhysicalInterface WHERE friendlyname='NAME2 server_name'", $this->object ->getOqlCi () );
	}

	/**
	 * @covers itop_PhysicalInterface::gestion_PhysicalInterface
	 */
	public function testgestion_PhysicalInterface() {
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
			
		$this ->assertSame ( $this->object, $this->object ->gestion_PhysicalInterface ( 'NAME1', 'server_name', '1.1.1.2', 'aef0-afea-2947','1.1.1.1','255.255.255.255') );
	}
}
?>
