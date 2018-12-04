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
class VirtualMachineTest extends Core\MockedListeOptions {
	/**
	 * @var VirtualMachine
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
		$itop_Hypervisor = $this ->createMock('Zorille\itop\Hypervisor' );
		$itop_OSFamily = $this ->createMock('Zorille\itop\OSFamily' );
		$itop_OSVersion = $this ->createMock('Zorille\itop\OSVersion' );
		
		$this->object = new VirtualMachine ( false, "TESTS VirtualMachine" );
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
	 * @covers Zorille\itop\VirtualMachine::retrouve_VirtualMachine
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
	 * @covers Zorille\itop\VirtualMachine::creer_oql
	 */
	public function testcreer_oql() {
		$this ->assertSame ( $this->object, $this->object ->creer_oql ( 'NAME1' ) );
		$this ->assertEquals ( "SELECT VirtualMachine WHERE name='NAME1'", $this->object ->getOqlCi () );
	}

	/**
	 * @covers Zorille\itop\VirtualMachine::gestion_VirtualMachine
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
