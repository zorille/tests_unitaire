<?php
/**
 * @author dvargas
 * @package Lib
 *
 */
if (! defined ( '__DOCUMENT_ROOT__' )) {
	require_once $_SERVER ["PWD"] . '/prepare.php';
}
class itop_VirtualMachineTest extends MockedListeOptions {
	/**
	 * @var itop_VirtualMachine
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
		$itop_Hypervisor = $this ->createMock ( "itop_Hypervisor" );
		$itop_OSFamily = $this ->createMock ( "itop_OSFamily" );
		$itop_OSVersion = $this ->createMock ( "itop_OSVersion" );
		
		$this->object = new itop_VirtualMachine ( false, "TESTS itop_VirtualMachine" );
		$this->object ->setListeOptions ( $this ->getListeOption () ) 
			->setObjetItopWsclientRest ( $itop_wsclient_rest ) 
			->setObjetItopOrganization ( $itop_Organization ) 
			->setObjetItopHypervisor ( $itop_Hypervisor )
			->setObjetItopOSFamily ( $itop_OSFamily ) 
			->setObjetItopOSVersion ( $itop_OSVersion );
		
		$this->object ->getObjetItopOrganization () 
			->expects ( $this ->any () ) 
			->method ( 'creer_oql' ) 
			->will ( $this ->returnValue ( $itop_Organization ) );
		
		$this->object ->getObjetItopHypervisor () 
			->expects ( $this ->any () ) 
			->method ( 'creer_oql' ) 
			->will ( $this ->returnValue ( $itop_Hypervisor ) );
		
		$this->object ->getObjetItopOSFamily () 
			->expects ( $this ->any () ) 
			->method ( 'creer_oql' ) 
			->will ( $this ->returnValue ( $itop_OSFamily ) );
		
		$this->object ->getObjetItopOSVersion () 
			->expects ( $this ->any () ) 
			->method ( 'creer_oql' ) 
			->will ( $this ->returnValue ( $itop_OSVersion ) );
		$this->object ->setFormat ( 'VirtualMachine' );
	}

	/**
	 * Tears down the fixture, for example, closes a network connection.
	 * This method is called after a test is executed.
	 */
	protected function tearDown() {
		ob_end_clean ();
	}

	/**
	 * @covers itop_VirtualMachine::retrouve_VirtualMachine
	 */
	public function testretrouve_VirtualMachine() {
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
		$this ->assertSame ( $this->object, $this->object ->retrouve_VirtualMachine ( 'NAME1' ) );
	}

	/**
	 * @covers itop_VirtualMachine::creer_oql
	 */
	public function testcreer_oql() {
		$this ->assertSame ( $this->object, $this->object ->creer_oql ( 'NAME1' ) );
		$this ->assertEquals ( "SELECT VirtualMachine WHERE name='NAME1'", $this->object ->getOqlCi () );
	}

	/**
	 * @covers itop_VirtualMachine::gestion_VirtualMachine
	 */
	public function testgestion_VirtualMachine() {
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
			
		$this ->assertSame ( $this->object, $this->object ->gestion_VirtualMachine ( 'NAME1', 'ORG1','Hypervisor_name', 'LINUX', 'Ubuntu', 'active', 'high', '1.1.1.2', '2', '80000 kB', '2015-02-02', 'FQDN' ) );
	}
}
?>
