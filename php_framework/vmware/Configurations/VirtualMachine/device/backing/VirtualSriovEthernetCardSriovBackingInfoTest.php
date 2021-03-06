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
class VirtualSriovEthernetCardSriovBackingInfoTest extends MockedListeOptions {
	/**
     * @var VirtualSriovEthernetCardSriovBackingInfo
     */
	protected $object;

	/**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
	protected function setUp() {
		ob_start ();
		$this->object = new VirtualSriovEthernetCardSriovBackingInfo ( false, "TESTS VirtualSriovEthernetCardSriovBackingInfo" );
	}

	/**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
	protected function tearDown() {
		ob_end_clean ();
	}

	/**
	 * @covers Zorille\framework\VirtualSriovEthernetCardSriovBackingInfo::renvoi_donnees_soap
	 */
	public function testrenvoi_donnees_soap_Exception() {
		$this ->expectException(Exception::class);
        $this->expectExceptionMessage( '(TESTS VirtualSriovEthernetCardSriovBackingInfo) Il faut un virtualFunctionBacking' );
		$this->object ->renvoi_donnees_soap ();
	}

	/**
	 * @covers Zorille\framework\VirtualSriovEthernetCardSriovBackingInfo::renvoi_donnees_soap
	 */
	public function testrenvoi_donnees_soap() {
		$physicalFunctionBacking = $this ->createMock('Zorille\framework\VirtualPCIPassthroughDeviceBackingInfo' );
		$physicalFunctionBacking ->expects ( $this ->any () ) 
			->method ( 'renvoi_donnees_soap' ) 
			->will ( $this ->returnValue ( array ( 
				"VirtualPCIPassthroughDeviceBackingInfo" ) ) );
		$virtualFunctionBacking = $this ->createMock('Zorille\framework\VirtualPCIPassthroughDeviceBackingInfo' );
		$virtualFunctionBacking ->expects ( $this ->any () ) 
			->method ( 'renvoi_donnees_soap' ) 
			->will ( $this ->returnValue ( array ( 
				"VirtualPCIPassthroughDeviceBackingInfo" ) ) );
		$this->object ->setPhysicalFunctionBacking ( $physicalFunctionBacking ) 
			->setVirtualFunctionBacking ( $virtualFunctionBacking ) 
			->setVirtualFunctionIndex ( 3 );
		$this ->assertEquals ( array ( 
				'physicalFunctionBacking' => Array ( 
						"VirtualPCIPassthroughDeviceBackingInfo" ), 
				'virtualFunctionBacking' => Array ( 
						"VirtualPCIPassthroughDeviceBackingInfo" ), 
				'virtualFunctionIndex' => 3 ), $this->object ->renvoi_donnees_soap () );
	}

	/**
	 * @covers Zorille\framework\VirtualSriovEthernetCardSriovBackingInfo::renvoi_donnees_soap
	 */
	public function testrenvoi_donnees_soap_renvoi_objet() {
		$virtualFunctionBacking = $this ->createMock('Zorille\framework\VirtualPCIPassthroughDeviceBackingInfo' );
		$virtualFunctionBacking ->expects ( $this ->any () ) 
			->method ( 'renvoi_donnees_soap' ) 
			->will ( $this ->returnValue ( array ( 
				"VirtualPCIPassthroughDeviceBackingInfo" ) ) );
		$this->object ->setVirtualFunctionBacking ( $virtualFunctionBacking );
		$object = new arrayObject ( array ( 
				'virtualFunctionBacking' => Array ( 
						"VirtualPCIPassthroughDeviceBackingInfo" ) ) );
		$this ->assertEquals ( $object, $this->object ->renvoi_donnees_soap ( true ) );
	}

	/**
	 * @covers Zorille\framework\VirtualSriovEthernetCardSriovBackingInfo::renvoi_objet_soap
	 */
	public function testrenvoi_objet_soap_renvoi_objet() {
		$virtualFunctionBacking = $this ->createMock('Zorille\framework\VirtualPCIPassthroughDeviceBackingInfo' );
		$virtualFunctionBacking ->expects ( $this ->any () ) 
			->method ( 'renvoi_donnees_soap' ) 
			->will ( $this ->returnValue ( array ( 
				"VirtualPCIPassthroughDeviceBackingInfo" ) ) );
		$this->object ->setVirtualFunctionBacking ( $virtualFunctionBacking );
		$object = new arrayObject ( array ( 
				'virtualFunctionBacking' => Array ( 
						"VirtualPCIPassthroughDeviceBackingInfo" ) ) );
		$resultat = new soapvar ( $object, SOAP_ENC_OBJECT, "VirtualSriovEthernetCardSriovBackingInfo" );
		$this ->assertEquals ( $resultat, $this->object ->renvoi_objet_soap ( true ) );
	}
}
