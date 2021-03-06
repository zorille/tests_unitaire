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
class CustomizationGuiUnattendedTest extends MockedListeOptions {
	/**
     * @var CustomizationGuiUnattended
     */
	protected $object;

	/**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
	protected function setUp() {
		ob_start ();
		$this->object = new CustomizationGuiUnattended ( false, "TESTS CustomizationGuiUnattended" );
	}

	/**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
	protected function tearDown() {
		ob_end_clean ();
	}

	/**
	 * @covers Zorille\framework\CustomizationGuiUnattended::renvoi_donnees_soap
	 */
	public function testrenvoi_donnees_soap_Exception() {
		$this ->expectException(Exception::class);
        $this->expectExceptionMessage( '(TESTS CustomizationGuiUnattended) Il faut un password' );
		$this ->assertEquals ( "Never reached", $this->object ->renvoi_donnees_soap () );
	}

	/**
	 * @covers Zorille\framework\CustomizationGuiUnattended::renvoi_donnees_soap
	 */
	public function testrenvoi_donnees_soap() {
		$password = $this ->createMock('Zorille\framework\CustomizationPassword' );
		$password ->expects ( $this ->any () ) 
			->method ( 'renvoi_objet_soap' ) 
			->will ( $this ->returnValue ( array ( 
				"CustomizationPassword" ) ) );
		$this->object ->setAutoLogon ( TRUE ) 
			->setAutoLogonCount ( 3 ) 
			->setPassword ( $password ) 
			->setTimeZone ( 105 );
		$this ->assertEquals ( array ( 
				'password' => Array ( 
						"CustomizationPassword" ), 
				'timeZone' => 105, 
				'autoLogon' => true, 
				'autoLogonCount' => 3 ), $this->object ->renvoi_donnees_soap () );
	}

	/**
	 * @covers Zorille\framework\CustomizationGuiUnattended::renvoi_donnees_soap
	 */
	public function testrenvoi_donnees_soap_renvoi_objet() {
		$password = $this ->createMock('Zorille\framework\CustomizationPassword' );
		$password ->expects ( $this ->any () ) 
			->method ( 'renvoi_objet_soap' ) 
			->will ( $this ->returnValue ( array ( 
				"CustomizationPassword" ) ) );
		$this->object ->setPassword ( $password );
		$object = new arrayObject ( array ( 
				'password' => Array ( 
						"CustomizationPassword" ), 
				'timeZone' => 102, 
				'autoLogon' => false, 
				'autoLogonCount' => 0 ) );
		$this ->assertEquals ( $object, $this->object ->renvoi_donnees_soap ( true ) );
	}

	/**
	 * @covers Zorille\framework\CustomizationGuiUnattended::renvoi_objet_soap
	 */
	public function testrenvoi_objet_soap_renvoi_objet() {
		$password = $this ->createMock('Zorille\framework\CustomizationPassword' );
		$password ->expects ( $this ->any () ) 
			->method ( 'renvoi_objet_soap' ) 
			->will ( $this ->returnValue ( array ( 
				"CustomizationPassword" ) ) );
		$this->object ->setPassword ( $password );
		$object = new arrayObject ( array ( 
				'password' => Array ( 
						"CustomizationPassword" ), 
				'timeZone' => 102, 
				'autoLogon' => false, 
				'autoLogonCount' => 0 ) );
		$resultat = new soapvar ( $object, SOAP_ENC_OBJECT, "CustomizationGuiUnattended" );
		$this ->assertEquals ( $resultat, $this->object ->renvoi_objet_soap ( true ) );
	}
}
