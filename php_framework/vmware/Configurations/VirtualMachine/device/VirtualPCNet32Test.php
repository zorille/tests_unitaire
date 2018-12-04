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
class VirtualPCNet32Test extends MockedListeOptions {
	/**
     * @var VirtualPCNet32
     */
	protected $object;

	/**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
	protected function setUp() {
		ob_start ();
		$this->object = new VirtualPCNet32 ( false, "TESTS VirtualPCNet32" );
	}

	/**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
	protected function tearDown() {
		ob_end_clean ();
	}

	/**
	 * @covers Zorille\framework\VirtualPCNet32::renvoi_donnees_soap
	 */
	public function testrenvoi_donnees_soap() {
		$this->assertEquals ( array (
				'addressType' => 'Assigned' 
		), $this->object->renvoi_donnees_soap () );
	}

	/**
	 * @covers Zorille\framework\VirtualPCNet32::renvoi_donnees_soap
	 */
	public function testrenvoi_donnees_soap_renvoi_objet() {
		$object = new arrayObject ( array (
				'addressType' => 'Assigned' 
		) );
		$this->assertEquals ( $object, $this->object->renvoi_donnees_soap ( true ) );
	}

	/**
	 * @covers Zorille\framework\VirtualPCNet32::renvoi_objet_soap
	 */
	public function testrenvoi_objet_soap_renvoi_objet() {
		$object = new arrayObject ( array (
				'addressType' => 'Assigned' 
		) );
		$resultat = new soapvar ( $object, SOAP_ENC_OBJECT, "VirtualPCNet32" );
		$this->assertEquals ( $resultat, $this->object->renvoi_objet_soap ( true ) );
	}
}
