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
class ServiceSubcategoryTest extends Core\MockedListeOptions {
	/**
	 * @var ServiceSubcategory
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
		$itop_Service = $this ->createMock('Zorille\itop\Service' );
		
		$this->object = new ServiceSubcategory ( false, "TESTS ServiceSubcategory" );
		$this->object ->setListeOptions ( $this ->getListeOption () ) 
			->setObjetItopWsclientRest ( $itop_wsclient_rest ) 
			->setObjetItopOrganization ( $itop_Organization ) 
			->setObjetItopService ( $itop_Service );
		
		$this->object ->getObjetItopOrganization () 
			->expects ( $this ->any () ) 
			->method ( 'creer_oql' ) 
			->will ( $this ->returnValue ( $itop_Organization ) );
		
		$this->object ->getObjetItopService () 
			->expects ( $this ->any () ) 
			->method ( 'creer_oql' ) 
			->will ( $this ->returnValue ( $itop_Service ) );
		
		$this->object ->setFormat ( 'ServiceSubcategory' );
	}

	/**
	 * Tears down the fixture, for example, closes a network connection.
	 * This method is called after a test is executed.
	 */
	protected function tearDown() {
		ob_end_clean ();
	}

	/**
	 * @covers Zorille\itop\ServiceSubcategory::retrouve_ServiceSubcategory
	 */
	public function testretrouve_ServiceSubcategory() {
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
		$this ->assertSame ( $this->object, $this->object ->retrouve_ServiceSubcategory ( 'NAME1' ) );
	}

	/**
	 * @covers Zorille\itop\ServiceSubcategory::creer_oql
	 */
	public function testcreer_oql() {
		$this ->assertSame ( $this->object, $this->object ->creer_oql ( 'NAME1' ) );
		$this ->assertEquals ( "SELECT ServiceSubcategory WHERE name='NAME1'", $this->object ->getOqlCi () );
	}

	/**
	 * @covers Zorille\itop\ServiceSubcategory::gestion_ServiceSubcategory
	 */
	public function testgestion_ServiceSubcategory() {
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
		
		$this ->assertSame ( $this->object, $this->object ->gestion_ServiceSubcategory ( 'NAME1', 'ORG1', 'LINUX', 'Ubuntu', 'active', 'high', '1.1.1.2', '2', '80000 kB', '2015-02-02', 'FQDN' ) );
	}
}
?>
