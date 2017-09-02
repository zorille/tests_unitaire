<?php
/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2015-09-07 at 11:31:16.
 */
if (! defined ( '__DOCUMENT_ROOT__' )) {
	require_once $_SERVER ["PWD"] . '/prepare.php';
}
class VirtualUSBRemoteHostBackingInfoTest extends MockedListeOptions {
	/**
     * @var VirtualUSBRemoteHostBackingInfo
     */
	protected $object;

	/**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
	protected function setUp() {
		ob_start ();
		$this->object = new VirtualUSBRemoteHostBackingInfo ( false, "TESTS VirtualUSBRemoteHostBackingInfo" );
	}

	/**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
	protected function tearDown() {
		ob_end_clean ();
	}

	/**
	 * @covers VirtualUSBRemoteHostBackingInfo::renvoi_donnees_soap
	 */
	public function testrenvoi_donnees_soap_Exception() {
		$this ->expectException(Exception::class);
        $this->expectExceptionMessage( '(TESTS VirtualUSBRemoteHostBackingInfo) Il faut un hostname' );
		$this->object ->renvoi_donnees_soap ();
	}

	/**
	 * @covers VirtualUSBRemoteHostBackingInfo::renvoi_donnees_soap
	 */
	public function testrenvoi_donnees_soap() {
		$this->object ->setDeviceName ( "NAME" ) 
			->setUseAutoDetect ( TRUE ) 
			->setHostname ( "HOSTNAME" );
		$this ->assertEquals ( array ( 
				'deviceName' => 'NAME', 
				'useAutoDetect' => true, 
				'hostname' => 'HOSTNAME' ), $this->object ->renvoi_donnees_soap () );
	}

	/**
	 * @covers VirtualUSBRemoteHostBackingInfo::renvoi_donnees_soap
	 */
	public function testrenvoi_donnees_soap_renvoi_objet() {
		$this->object ->setHostname ( "HOSTNAME" );
		$object = new arrayObject ( array ( 
				'deviceName' => '', 
				'hostname' => 'HOSTNAME' ) );
		$this ->assertEquals ( $object, $this->object ->renvoi_donnees_soap ( true ) );
	}

	/**
	 * @covers VirtualUSBRemoteHostBackingInfo::renvoi_objet_soap
	 */
	public function testrenvoi_objet_soap_renvoi_objet() {
		$this->object ->setHostname ( "HOSTNAME" );
		$object = new arrayObject ( array ( 
				'deviceName' => '', 
				'hostname' => 'HOSTNAME' ) );
		$resultat = new soapvar ( $object, SOAP_ENC_OBJECT, "VirtualUSBRemoteHostBackingInfo" );
		$this ->assertEquals ( $resultat, $this->object ->renvoi_objet_soap ( true ) );
	}
}
