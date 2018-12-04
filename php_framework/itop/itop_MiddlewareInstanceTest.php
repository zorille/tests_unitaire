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
class MiddlewareInstanceTest extends Core\MockedListeOptions {
	/**
	 * @var MiddlewareInstance
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
		$itop_Middleware = $this ->createMock('Zorille\itop\Middleware' );
		
		$this->object = new MiddlewareInstance ( false, "TESTS MiddlewareInstance" );
		$this->object ->setListeOptions ( $this ->getListeOption () ) 
			->setObjetItopWsclientRest ( $itop_wsclient_rest ) 
			->setObjetItopOrganization ( $itop_Organization ) 
			->setObjetItopMiddleware ( $itop_Middleware );
		
		$this->object ->getObjetItopOrganization () 
			->expects ( $this ->any () ) 
			->method ( 'creer_oql' ) 
			->will ( $this ->returnValue ( $itop_Organization ) );
		$this->object ->getObjetItopMiddleware()
		->expects ( $this ->any () )
		->method ( 'creer_oql' )
		->will ( $this ->returnValue ( $itop_Middleware ) );
		$this->object ->setFormat ( 'MiddlewareInstance' );
	}

	/**
	 * Tears down the fixture, for example, closes a network connection.
	 * This method is called after a test is executed.
	 */
	protected function tearDown() {
		ob_end_clean ();
	}

	/**
	 * @covers Zorille\itop\MiddlewareInstance::retrouve_MiddlewareInstance
	 */
	public function testretrouve_MiddlewareInstance() {
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
		$this ->assertSame ( $this->object, $this->object ->retrouve_MiddlewareInstance ( 'NAME1', 'server_name' ) );
	}

	/**
	 * @covers Zorille\itop\MiddlewareInstance::creer_oql
	 */
	public function testcreer_oql() {
		$this ->assertSame ( $this->object, $this->object ->creer_oql ( 'NAME1' ) );
		$this ->assertEquals ( "SELECT MiddlewareInstance WHERE name='NAME1'", $this->object ->getOqlCi () );
	}

	/**
	 * @covers Zorille\itop\MiddlewareInstance::gestion_MiddlewareInstance
	 */
	public function testgestion_MiddlewareInstance() {
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
			
		$this ->assertSame ( $this->object, $this->object ->gestion_MiddlewareInstance ( 'NAME1', 'ORG1', 'active', 'high', 'server_name', 'SOFT 1.0','/bin/path', '2015-02-02' ) );
	}
}
?>
