<?php

namespace Zorille\itop;

use Zorille\framework as Core;

/**
 * @author dvargas
 * @package Lib
 */
if (! defined ( '__DOCUMENT_ROOT__' )) {
	require_once $_SERVER ["PWD"] . '/prepare.php';
}
class ServiceTest extends Core\MockedListeOptions {
	/**
	 * @var Service
	 */
	protected $object;

	/**
	 * Sets up the fixture, for example, opens a network connection. This method is called before a test is executed.
	 */
	protected function setUp() {
		ob_start ();
		$itop_wsclient_rest = $this->createMock ( 'Zorille\itop\wsclient_rest' );
		$itop_Organization = $this->createMock ( 'Zorille\itop\Organization' );
		$itop_ServiceFamily = $this->createMock ( 'Zorille\itop\ServiceFamily' );
		$this->object = new Service ( false, "TESTS Service" );
		$this->object->setListeOptions ( $this->getListeOption () )
			->setObjetItopWsclientRest ( $itop_wsclient_rest )
			->setObjetItopOrganization ( $itop_Organization )
			->setObjetItopServiceFamily ( $itop_ServiceFamily );
		$this->object->getObjetItopOrganization ()
			->expects ( $this->any () )
			->method ( 'creer_oql' )
			->will ( $this->returnValue ( $itop_Organization ) );
		$this->object->getObjetItopServiceFamily()
			->expects ( $this->any () )
			->method ( 'creer_oql' )
			->will ( $this->returnValue ( $itop_ServiceFamily ) );
		$this->object->setFormat ( 'Service' );
	}

	/**
	 * Tears down the fixture, for example, closes a network connection. This method is called after a test is executed.
	 */
	protected function tearDown() {
		ob_end_clean ();
	}

	/**
	 * @covers Zorille\itop\Service::retrouve_Service
	 */
	public function testretrouve_Service() {
		$this->object->getObjetItopWsclientRest ()
			->expects ( $this->any () )
			->method ( 'core_get' )
			->will ( $this->returnValue ( array (
				'objects' => array (
						array (
								'class' => "CLASS1",
								'key' => 10,
								'fields' => array (
										'name' => 'NOM1'
								)
						)
				),
				'message' => 'Found: 1'
		) ) );
		$this->assertSame ( $this->object, $this->object->retrouve_Service ( 'NAME1' ) );
	}

	/**
	 * @covers Zorille\itop\Service::creer_oql
	 */
	public function testcreer_oql() {
		$this->assertSame ( $this->object, $this->object->creer_oql ( 'NAME1' ) );
		$this->assertEquals ( "SELECT Service WHERE name='NAME1'", $this->object->getOqlCi () );
	}

	/**
	 * @covers Zorille\itop\Service::gestion_Service
	 */
	public function testgestion_Service() {
		$this->object->getObjetItopWsclientRest ()
			->expects ( $this->any () )
			->method ( 'core_get' )
			->will ( $this->returnValue ( array (
				'objects' => array (),
				'message' => 'Found: 0'
		) ) );
		$this->object->getObjetItopWsclientRest ()
			->expects ( $this->any () )
			->method ( 'core_create' )
			->will ( $this->returnValue ( array (
				'objects' => array (
						array (
								'class' => "CLASS1",
								'key' => 10,
								'fields' => array (
										'name' => 'NOM1'
								)
						)
				),
				'message' => 'Found: 1'
		) ) );
		$this->assertSame ( $this->object, $this->object->gestion_Service ( 'NAME1', 'ORG1', 'LINUX', 'Ubuntu', 'active', 'high', '1.1.1.2', '2', '80000 kB', '2015-02-02', 'FQDN' ) );
	}
}
?>
