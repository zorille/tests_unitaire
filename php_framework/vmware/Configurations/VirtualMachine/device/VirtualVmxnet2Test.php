<?php
/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2015-09-07 at 11:31:16.
 */
if (! defined ( '__DOCUMENT_ROOT__' )) {
	require_once $_SERVER ["PWD"] . '/prepare.php';
}
class VirtualVmxnet2Test extends MockedListeOptions {
	/**
     * @var VirtualVmxnet2
     */
	protected $object;

	/**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
	protected function setUp() {
		ob_start ();
		$this->object = new VirtualVmxnet2 ( false, "TESTS VirtualVmxnet2" );
	}

	/**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
	protected function tearDown() {
		ob_end_clean ();
	}

	/**
	 * @covers VirtualVmxnet2::renvoi_donnees_soap
	 */
	public function testrenvoi_donnees_soap() {
		$this->assertEquals ( array (
				'addressType' => 'Assigned' 
		), $this->object->renvoi_donnees_soap () );
	}

	/**
	 * @covers VirtualVmxnet2::renvoi_donnees_soap
	 */
	public function testrenvoi_donnees_soap_renvoi_objet() {
		$object = new arrayObject ( array (
				'addressType' => 'Assigned' 
		) );
		$this->assertEquals ( $object, $this->object->renvoi_donnees_soap ( true ) );
	}

	/**
	 * @covers VirtualVmxnet2::renvoi_objet_soap
	 */
	public function testrenvoi_objet_soap_renvoi_objet() {
		$object = new arrayObject ( array (
				'addressType' => 'Assigned' 
		) );
		$resultat = new soapvar ( $object, SOAP_ENC_OBJECT, "VirtualVmxnet2" );
		$this->assertEquals ( $resultat, $this->object->renvoi_objet_soap ( true ) );
	}
}
