<?php
/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2015-09-07 at 11:31:16.
 */
if (! defined ( '__DOCUMENT_ROOT__' )) {
	require_once $_SERVER ["PWD"] . '/prepare.php';
}
class CustomizationCustomNameTest extends MockedListeOptions {
	/**
     * @var CustomizationCustomName
     */
	protected $object;

	/**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
	protected function setUp() {
		ob_start ();
		$this->object = new CustomizationCustomName ( false, "TESTS CustomizationCustomName" );
	}

	/**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
	protected function tearDown() {
		ob_end_clean ();
	}

	/**
	 * @covers CustomizationCustomName::renvoi_donnees_soap
	 */
	public function testrenvoi_donnees_soap() {
		$this->object->setArgument ( "argument" );
		$this->assertEquals ( array (
				'argument' => 'argument' 
		), $this->object->renvoi_donnees_soap () );
	}

	/**
	 * @covers CustomizationCustomName::renvoi_donnees_soap
	 */
	public function testrenvoi_donnees_soap_renvoi_objet() {
		$object = new arrayObject ();
		$this->assertEquals ( $object, $this->object->renvoi_donnees_soap ( true ) );
	}

	/**
	 * @covers CustomizationCustomName::renvoi_objet_soap
	 */
	public function testrenvoi_objet_soap_renvoi_objet() {
		$object = new arrayObject ();
		$resultat = new soapvar ( $object, SOAP_ENC_OBJECT, "CustomizationCustomName" );
		$this->assertEquals ( $resultat, $this->object->renvoi_objet_soap ( true ) );
	}
}
