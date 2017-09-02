<?php
/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2015-09-07 at 11:31:16.
 */
if (! defined ( '__DOCUMENT_ROOT__' )) {
	require_once $_SERVER ["PWD"] . '/prepare.php';
}
class VirtualSerialPortFileBackingInfoTest extends MockedListeOptions {
	/**
     * @var VirtualSerialPortFileBackingInfo
     */
	protected $object;

	/**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
	protected function setUp() {
		ob_start ();
		$this->object = new VirtualSerialPortFileBackingInfo ( false, "VirtualSerialPortFileBackingInfo" );
	}

	/**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
	protected function tearDown() {
		ob_end_clean ();
	}

	/**
	 * @covers VirtualSerialPortFileBackingInfo::renvoi_donnees_soap
	 */
	public function testrenvoi_donnees_soap() {
		$this->object->setFileName ( "FILENAME" );
		$this->assertEquals ( array (
				'fileName' => 'FILENAME' 
		), $this->object->renvoi_donnees_soap () );
	}

	/**
	 * @covers VirtualSerialPortFileBackingInfo::renvoi_donnees_soap
	 */
	public function testrenvoi_donnees_soap_renvoi_objet() {
		$this->object->setFileName ( "FILENAME" );
		$object = new arrayObject ( array (
				'fileName' => 'FILENAME' 
		) );
		$this->assertEquals ( $object, $this->object->renvoi_donnees_soap ( true ) );
	}

	/**
	 * @covers VirtualSerialPortFileBackingInfo::renvoi_objet_soap
	 */
	public function testrenvoi_objet_soap_renvoi_objet() {
		$this->object->setFileName ( "FILENAME" );
		$object = new arrayObject ( array (
				'fileName' => 'FILENAME' 
		) );
		$resultat = new soapvar ( $object, SOAP_ENC_OBJECT, "VirtualSerialPortFileBackingInfo" );
		$this->assertEquals ( $resultat, $this->object->renvoi_objet_soap ( true ) );
	}
}