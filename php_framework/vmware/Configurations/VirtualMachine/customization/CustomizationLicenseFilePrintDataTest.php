<?php
/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2015-09-07 at 11:31:16.
 */
if (! defined ( '__DOCUMENT_ROOT__' )) {
	require_once $_SERVER ["PWD"] . '/prepare.php';
}
class CustomizationLicenseFilePrintDataTest extends MockedListeOptions {
	/**
     * @var CustomizationLicenseFilePrintData
     */
	protected $object;

	/**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
	protected function setUp() {
		ob_start ();
		$this->object = new CustomizationLicenseFilePrintData ( false, "TESTS CustomizationLicenseFilePrintData" );
	}

	/**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
	protected function tearDown() {
		ob_end_clean ();
	}

	/**
	 * @covers CustomizationLicenseFilePrintData::renvoi_donnees_soap
	 */
	public function testrenvoi_donnees_soap_Exception() {
		$this ->expectException(Exception::class);
        $this->expectExceptionMessage( '(TESTS CustomizationLicenseFilePrintData) Il faut un autoMode' );
		$this ->assertEquals ( "Never reached", $this->object ->renvoi_donnees_soap () );
	}

	/**
	 * @covers CustomizationLicenseFilePrintData::renvoi_donnees_soap
	 */
	public function testrenvoi_donnees_soap() {
		$this->object ->setAutoMode ( "perSeat" ) 
			->setAutoUsers ( 10 );
		$this ->assertEquals ( array ( 
				'autoMode' => 'perSeat', 
				'autoUsers' => 10 ), $this->object ->renvoi_donnees_soap () );
	}

	/**
	 * @covers CustomizationLicenseFilePrintData::renvoi_donnees_soap
	 */
	public function testrenvoi_donnees_soap_renvoi_objet() {
		$this->object ->setAutoMode ( "perSeat" );
		$object = new arrayObject ( array ( 
				'autoMode' => 'perSeat' ) );
		$this ->assertEquals ( $object, $this->object ->renvoi_donnees_soap ( true ) );
	}

	/**
	 * @covers CustomizationLicenseFilePrintData::renvoi_objet_soap
	 */
	public function testrenvoi_objet_soap_renvoi_objet() {
		$this->object ->setAutoMode ( "perSeat" );
		$object = new arrayObject ( array ( 
				'autoMode' => 'perSeat' ) );
		$resultat = new soapvar ( $object, SOAP_ENC_OBJECT, "CustomizationLicenseFilePrintData" );
		$this ->assertEquals ( $resultat, $this->object ->renvoi_objet_soap ( true ) );
	}
}