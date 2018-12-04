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
class VirtualMachineConfigInfoTest extends MockedListeOptions {
	/**
     * @var VirtualMachineConfigInfo
     */
	protected $object;

	/**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
	protected function setUp() {
		ob_start ();
		$this->object = new VirtualMachineConfigInfo ( false, "TEST VirtualMachineConfigInfo" );
	}

	/**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
	protected function tearDown() {
		ob_end_clean ();
	}

	/**
	 * @covers Zorille\framework\VirtualMachineConfigInfo::renvoi_donnees_soap
	 */
	public function testrenvoi_donnees_soap_Valide() {
		$VirtualMachineConfigInfoDatastoreUrlPair = "OBJET TODO";
		$VirtualMachineDefaultPowerOpInfo = "OBJET TODO";
		$VirtualHardware = "OBJET TODO";
		$initialOverhead = "OBJET TODO";
		
		$this->object->setDatastoreUrl ( $VirtualMachineConfigInfoDatastoreUrlPair ) //VirtualMachineConfigInfoDatastoreUrlPair
			->setDefaultPowerOps ( $VirtualMachineDefaultPowerOpInfo ) //VirtualMachineDefaultPowerOpInfo
			->setGuestFullName ( "GUESTFULLNAME" )
			->setHardware ( $VirtualHardware ) //VirtualHardware
			->setHotPlugMemoryIncrementSize ( 18000 )
			->setHotPlugMemoryLimit ( 20000 )
			->setInitialOverhead ( $initialOverhead ) //VirtualMachineConfigInfoOverheadInfo
			->setModified ( "MODIFIED" )
			->setTemplate ( 'TEMPLATE' )
			->setVFlashCacheReservation ( 12 );
		$this->assertEquals ( array (
				'datastoreUrl' => "OBJET TODO",
				'defaultPowerOps' => "OBJET TODO",
				'guestFullName' => 'GUESTFULLNAME',
				'hardware' => "OBJET TODO",
				'hotPlugMemoryIncrementSize' => 18000,
				'hotPlugMemoryLimit' => 20000,
				'initialOverhead' => "OBJET TODO",
				'modified' => 'MODIFIED',
				'template' => 'TEMPLATE',
				'vFlashCacheReservation' => 12 
		)
		, $this->object->renvoi_donnees_soap () );
	}

	/**
	 * @covers Zorille\framework\VirtualMachineConfigInfo::renvoi_donnees_soap
	 */
	public function testrenvoi_donnees_soap_renvoi_objet() {
		$object = new arrayObject ();
		$this->assertEquals ( $object, $this->object->renvoi_donnees_soap ( true ) );
	}
	
	/**
	 * @covers Zorille\framework\VirtualMachineConfigInfo::renvoi_objet_soap
	 */
	public function testrenvoi_objet_soap_renvoi_objet() {
		$object = new arrayObject ();
		$resultat = new soapvar ( $object, SOAP_ENC_OBJECT, "VirtualMachineConfigInfo" );
		$this->assertEquals ( $resultat, $this->object->renvoi_objet_soap ( true ) );
	}
}
