<?php
namespace Zorille\framework;
use \Exception as Exception;
use \ArrayObject as ArrayObject;
/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2015-09-07 at 11:31:16.
 */
if (! defined ( '__DOCUMENT_ROOT__' )) {
	require_once $_SERVER ["PWD"] . '/prepare.php';
}
class VirtualDeviceFileBackingInfoTest extends MockedListeOptions {
	/**
     * @var VirtualDeviceFileBackingInfo
     */
	protected $object;

	/**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
	protected function setUp() {
		ob_start ();
		$this->object = $this ->getMockForAbstractClass ( 'Zorille\framework\VirtualDeviceFileBackingInfo' );
	}

	/**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
	protected function tearDown() {
		ob_end_clean ();
	}

	/**
	 * @covers Zorille\framework\VirtualDeviceFileBackingInfo::renvoi_donnees_soap
	 */
	public function testrenvoi_donnees_soap_Exception() {
		$this ->expectException(Exception::class);
        $this->expectExceptionMessage( '(abstract_log) Il faut un fileName' );
		$this->object ->renvoi_donnees_soap ();
	}

	/**
	 * @covers Zorille\framework\VirtualDeviceFileBackingInfo::renvoi_donnees_soap
	 */
	public function testrenvoi_donnees_soap() {
		$this->object ->setBackingObjectId ( "ID" ) 
			->setDatastore ( array ( 
				"_" => "MOID_Datastore" ) ) 
			->setFileName ( "FILENAME" );
		$this ->assertEquals ( array ( 
				'fileName' => 'FILENAME', 
				'datastore' => "MOID_Datastore", 
				'backingObjectId' => 'ID' ), $this->object ->renvoi_donnees_soap () );
	}

	/**
	 * @covers Zorille\framework\VirtualDeviceFileBackingInfo::renvoi_donnees_soap
	 */
	public function testrenvoi_donnees_soap_renvoi_objet() {
		$this->object ->setFileName ( "FILENAME" );
		$object = new arrayObject ( array ( 
				'fileName' => 'FILENAME' ) );
		$this ->assertEquals ( $object, $this->object ->renvoi_donnees_soap ( true ) );
	}
}
