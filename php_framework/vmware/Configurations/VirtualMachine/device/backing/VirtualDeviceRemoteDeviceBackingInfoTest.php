<?php
namespace Zorille\framework;
use \ArrayObject as ArrayObject;
/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2015-09-07 at 11:31:16.
 */
if (! defined ( '__DOCUMENT_ROOT__' )) {
	require_once $_SERVER ["PWD"] . '/prepare.php';
}
class VirtualDeviceRemoteDeviceBackingInfoTest extends MockedListeOptions {
	/**
     * @var VirtualDeviceRemoteDeviceBackingInfo
     */
	protected $object;

	/**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
	protected function setUp() {
		ob_start ();
		$this->object = $this->getMockForAbstractClass ( 'Zorille\framework\VirtualDeviceRemoteDeviceBackingInfo' );
	}

	/**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
	protected function tearDown() {
		ob_end_clean ();
	}

	/**
	 * @covers Zorille\framework\VirtualDeviceRemoteDeviceBackingInfo::renvoi_donnees_soap
	 */
	public function testrenvoi_donnees_soap() {
		$this->object->setDeviceName ( "NAME" )
			->setUseAutoDetect ( TRUE );
		$this->assertEquals ( array (
				'deviceName' => 'NAME',
				'useAutoDetect' => true
		), $this->object->renvoi_donnees_soap () );
	}

	/**
	 * @covers Zorille\framework\VirtualDeviceRemoteDeviceBackingInfo::renvoi_donnees_soap
	 */
	public function testrenvoi_donnees_soap_renvoi_objet() {
		$object = new arrayObject (array (
				'deviceName' => ''
		));
		$this->assertEquals ( $object, $this->object->renvoi_donnees_soap ( true ) );
	}
}
