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
class VirtualPCIControllerTest extends MockedListeOptions {
	/**
     * @var VirtualPCIController
     */
	protected $object;

	/**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
	protected function setUp() {
		ob_start ();
		$this->object = new VirtualPCIController ( false, "TESTS VirtualPCIController" );
	}

	/**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
	protected function tearDown() {
		ob_end_clean ();
	}

	/**
	 * @covers Zorille\framework\VirtualPCIController::renvoi_donnees_soap
	 */
	public function testrenvoi_donnees_soap_Exception() {
		$this ->expectException(Exception::class);
        $this->expectExceptionMessage( '(TESTS VirtualPCIController) Il faut un busNumber' );
		$this->object ->renvoi_donnees_soap ();
	}

	/**
	 * @covers Zorille\framework\VirtualPCIController::renvoi_donnees_soap
	 */
	public function testrenvoi_donnees_soap() {
		$this->object ->setBusNumber ( 1 );
		$this ->assertEquals ( array ( 
				'busNumber' => 1 ), $this->object ->renvoi_donnees_soap () );
	}

	/**
	 * @covers Zorille\framework\VirtualPCIController::renvoi_donnees_soap
	 */
	public function testrenvoi_donnees_soap_renvoi_objet() {
		$this->object ->setBusNumber ( 1 );
		$object = new arrayObject ( array ( 
				'busNumber' => 1 ) );
		$this ->assertEquals ( $object, $this->object ->renvoi_donnees_soap ( true ) );
	}

	/**
	 * @covers Zorille\framework\VirtualPCIController::renvoi_objet_soap
	 */
	public function testrenvoi_objet_soap_renvoi_objet() {
		$this->object ->setBusNumber ( 1 );
		$object = new arrayObject ( array ( 
				'busNumber' => 1 ) );
		$resultat = new soapvar ( $object, SOAP_ENC_OBJECT, "VirtualPCIController" );
		$this ->assertEquals ( $resultat, $this->object ->renvoi_objet_soap ( true ) );
	}
}
