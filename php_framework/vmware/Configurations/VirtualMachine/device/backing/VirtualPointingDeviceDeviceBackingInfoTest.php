<?php
namespace Zorille\framework;
use \ArrayObject as ArrayObject;
use \soapvar as soapvar;
/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2015-09-07 at 11:31:16.
 */
if (! defined ( '__DOCUMENT_ROOT__' )) {
	require_once $_SERVER ["PWD"] . '/prepare.php';
}
class VirtualPointingDeviceDeviceBackingInfoTest extends MockedListeOptions {
	/**
     * @var VirtualPointingDeviceDeviceBackingInfo
     */
	protected $object;

	/**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
	protected function setUp() {
		ob_start ();
		$this->object = new VirtualPointingDeviceDeviceBackingInfo ( false, "TESTS VirtualPointingDeviceDeviceBackingInfo" );
	}

	/**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
	protected function tearDown() {
		ob_end_clean ();
	}

	/**
	 * @covers Zorille\framework\VirtualPointingDeviceDeviceBackingInfo::renvoi_donnees_soap
	 */
	public function testrenvoi_donnees_soap() {
		$this->object->setDeviceName ( "NAME" )
			->setUseAutoDetect ( TRUE )
			->setHostPointingDevice ( "intellimousePs2" );
		$this->assertEquals ( array (
				'deviceName' => 'NAME',
				'useAutoDetect' => true,
				'hostPointingDevice' => 'intellimousePs2' 
		), $this->object->renvoi_donnees_soap () );
	}

	/**
	 * @covers Zorille\framework\VirtualPointingDeviceDeviceBackingInfo::renvoi_donnees_soap
	 */
	public function testrenvoi_donnees_soap_renvoi_objet() {
		$object = new arrayObject ( array (
				'deviceName' => '',
				'hostPointingDevice' => 'autodetect' 
		) );
		$this->assertEquals ( $object, $this->object->renvoi_donnees_soap ( true ) );
	}

	/**
	 * @covers Zorille\framework\VirtualPointingDeviceDeviceBackingInfo::renvoi_objet_soap
	 */
	public function testrenvoi_objet_soap_renvoi_objet() {
		$object = new arrayObject ( array (
				'deviceName' => '',
				'hostPointingDevice' => 'autodetect' 
		) );
		$resultat = new soapvar ( $object, SOAP_ENC_OBJECT, "VirtualPointingDeviceDeviceBackingInfo" );
		$this->assertEquals ( $resultat, $this->object->renvoi_objet_soap ( true ) );
	}
}
