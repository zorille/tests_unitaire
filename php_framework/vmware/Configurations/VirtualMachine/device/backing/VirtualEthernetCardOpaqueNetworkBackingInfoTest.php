<?php
/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2015-09-07 at 11:31:16.
 */
if (! defined ( '__DOCUMENT_ROOT__' )) {
	require_once $_SERVER ["PWD"] . '/prepare.php';
}
class VirtualEthernetCardOpaqueNetworkBackingInfoTest extends MockedListeOptions {
	/**
     * @var VirtualEthernetCardOpaqueNetworkBackingInfo
     */
	protected $object;

	/**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
	protected function setUp() {
		ob_start ();
		$this->object = new VirtualEthernetCardOpaqueNetworkBackingInfo ( false, "TESTS VirtualEthernetCardOpaqueNetworkBackingInfo" );
	}

	/**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
	protected function tearDown() {
		ob_end_clean ();
	}

	/**
	 * @covers VirtualEthernetCardOpaqueNetworkBackingInfo::renvoi_donnees_soap
	 */
	public function testrenvoi_donnees_soap_Exception() {
		$this ->expectException(Exception::class);
        $this->expectExceptionMessage( '(TESTS VirtualEthernetCardOpaqueNetworkBackingInfo) Il faut un opaqueNetworkId' );
		$this->object ->renvoi_donnees_soap ();
	}

	/**
	 * @covers VirtualEthernetCardOpaqueNetworkBackingInfo::renvoi_donnees_soap
	 */
	public function testrenvoi_donnees_soap_Exception2() {
		$this->object ->setOpaqueNetworkId ( "NETID" );
		$this ->expectException(Exception::class);
        $this->expectExceptionMessage( '(TESTS VirtualEthernetCardOpaqueNetworkBackingInfo) Il faut un opaqueNetworkType' );
		$this->object ->renvoi_donnees_soap ();
	}

	/**
	 * @covers VirtualEthernetCardOpaqueNetworkBackingInfo::renvoi_donnees_soap
	 */
	public function testrenvoi_donnees_soap() {
		$this->object ->setOpaqueNetworkId ( "NETID" ) 
			->setOpaqueNetworkType ( "NETTYPE" );
		$this ->assertEquals ( array ( 
				'opaqueNetworkId' => 'NETID', 
				'opaqueNetworkType' => 'NETTYPE' ), $this->object ->renvoi_donnees_soap () );
	}

	/**
	 * @covers VirtualEthernetCardOpaqueNetworkBackingInfo::renvoi_donnees_soap
	 */
	public function testrenvoi_donnees_soap_renvoi_objet() {
		$this->object ->setOpaqueNetworkId ( "NETID" ) 
			->setOpaqueNetworkType ( "NETTYPE" );
		$object = new arrayObject ( array ( 
				'opaqueNetworkId' => 'NETID', 
				'opaqueNetworkType' => 'NETTYPE' ) );
		$this ->assertEquals ( $object, $this->object ->renvoi_donnees_soap ( true ) );
	}

	/**
	 * @covers VirtualEthernetCardOpaqueNetworkBackingInfo::renvoi_objet_soap
	 */
	public function testrenvoi_objet_soap_renvoi_objet() {
		$this->object ->setOpaqueNetworkId ( "NETID" ) 
			->setOpaqueNetworkType ( "NETTYPE" );
		$object = new arrayObject ( array ( 
				'opaqueNetworkId' => 'NETID', 
				'opaqueNetworkType' => 'NETTYPE' ) );
		$resultat = new soapvar ( $object, SOAP_ENC_OBJECT, "VirtualEthernetCardOpaqueNetworkBackingInfo" );
		$this ->assertEquals ( $resultat, $this->object ->renvoi_objet_soap ( true ) );
	}
}
