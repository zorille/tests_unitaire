<?php
namespace Zorille\framework;
use \Exception as Exception;
use \ArrayObject as ArrayObject;
use \soapvar as soapvar;
/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2015-09-07 at 11:31:16.
 */
if (! defined ( '__DOCUMENT_ROOT__' )) {
	require_once $_SERVER ["PWD"] . '/prepare.php';
}
class VirtualDeviceURIBackingInfoTest extends MockedListeOptions {
	/**
     * @var VirtualDeviceURIBackingInfo
     */
	protected $object;

	/**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
	protected function setUp() {
		ob_start ();
		$this->object = new VirtualDeviceURIBackingInfo ( false, "TESTS VirtualDeviceURIBackingInfo" );
	}

	/**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
	protected function tearDown() {
		ob_end_clean ();
	}

	/**
	 * @covers Zorille\framework\VirtualDeviceURIBackingInfo::renvoi_donnees_soap
	 */
	public function testrenvoi_donnees_soap_Exception() {
		$this ->expectException(Exception::class);
        $this->expectExceptionMessage( '(TESTS VirtualDeviceURIBackingInfo) Il faut une direction' );
		$this->object ->renvoi_donnees_soap ();
	}

	/**
	 * @covers Zorille\framework\VirtualDeviceURIBackingInfo::renvoi_donnees_soap
	 */
	public function testrenvoi_donnees_soap_Exception2() {
		$this->object ->setDirection ( "server" );
		$this ->expectException(Exception::class);
        $this->expectExceptionMessage( '(TESTS VirtualDeviceURIBackingInfo) Il faut un serviceURI' );
		$this->object ->renvoi_donnees_soap ();
	}

	/**
	 * @covers Zorille\framework\VirtualDeviceURIBackingInfo::renvoi_donnees_soap
	 */
	public function testrenvoi_donnees_soap() {
		$this->object ->setDeviceName ( "NAME" ) 
			->setDirection ( "client" ) 
			->setProxyURI ( "http://10.10.10.10" ) 
			->setServiceURI ( "http://15.15.15.15/service" );
		$this ->assertEquals ( array ( 
				'deviceName' => 'NAME', 
				'direction' => 'client', 
				'proxyURI' => 'http://10.10.10.10', 
				'serviceURI' => 'http://15.15.15.15/service' ), $this->object ->renvoi_donnees_soap () );
	}

	/**
	 * @covers Zorille\framework\VirtualDeviceURIBackingInfo::renvoi_donnees_soap
	 */
	public function testrenvoi_donnees_soap_renvoi_objet() {
		$this->object ->setDeviceName ( "NAME" ) 
			->setDirection ( "client" ) 
			->setServiceURI ( "http://15.15.15.15/service" );
		$object = new arrayObject ( array ( 
				'deviceName' => 'NAME', 
				'direction' => 'client', 
				'serviceURI' => 'http://15.15.15.15/service' ) );
		$this ->assertEquals ( $object, $this->object ->renvoi_donnees_soap ( true ) );
	}

	/**
	 * @covers Zorille\framework\VirtualDeviceURIBackingInfo::renvoi_objet_soap
	 */
	public function testrenvoi_objet_soap_renvoi_objet() {
		$this->object ->setDeviceName ( "NAME" ) 
			->setDirection ( "client" ) 
			->setServiceURI ( "http://15.15.15.15/service" );
		$object = new arrayObject ( array ( 
				'deviceName' => 'NAME', 
				'direction' => 'client', 
				'serviceURI' => 'http://15.15.15.15/service' ) );
		$resultat = new soapvar ( $object, SOAP_ENC_OBJECT, "VirtualDeviceURIBackingInfo" );
		$this ->assertEquals ( $resultat, $this->object ->renvoi_objet_soap ( true ) );
	}
}
