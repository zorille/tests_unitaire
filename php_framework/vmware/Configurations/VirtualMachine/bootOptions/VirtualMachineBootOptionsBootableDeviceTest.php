<?php
namespace Zorille\framework;
use \ArrayObject as ArrayObject;
/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2015-09-07 at 11:31:16.
 */
if (! defined ( '__DOCUMENT_ROOT__' )) {
	require_once $_SERVER ["PWD"] . '/prepare.php';
}
class VirtualMachineBootOptionsBootableDeviceTest extends MockedListeOptions {
	/**
     * @var VirtualMachineBootOptionsBootableDevice
     */
	protected $object;

	/**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
	protected function setUp() {
		ob_start ();
		$this->object = $this->getMockForAbstractClass ( 'Zorille\framework\VirtualMachineBootOptionsBootableDevice' );
	}

	/**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
	protected function tearDown() {
		ob_end_clean ();
	}
	
	/**
	 * @covers Zorille\framework\VirtualMachineBootOptionsBootableDevice::renvoi_donnees_soap
	 */
	public function testrenvoi_donnees_soap() {
		$this->assertEquals ( array(), $this->object->renvoi_donnees_soap (  ) );
	}
	
	/**
	 * @covers Zorille\framework\VirtualMachineBootOptionsBootableDevice::renvoi_donnees_soap
	 */
	public function testrenvoi_donnees_soap_renvoi_objet() {
		$object = new arrayObject ();
		$this->assertEquals ( $object, $this->object->renvoi_donnees_soap ( true ) );
	}
}
