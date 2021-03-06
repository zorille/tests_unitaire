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
class VirtualDiskFlatVer1BackingInfoTest extends MockedListeOptions {
	/**
     * @var VirtualDiskFlatVer1BackingInfo
     */
	protected $object;

	/**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
	protected function setUp() {
		ob_start ();
		$this->object = new VirtualDiskFlatVer1BackingInfo ( false, "TESTS VirtualDiskFlatVer1BackingInfo" );
	}

	/**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
	protected function tearDown() {
		ob_end_clean ();
	}

	/**
	 * @covers Zorille\framework\VirtualDiskFlatVer1BackingInfo::renvoi_donnees_soap
	 */
	public function testrenvoi_donnees_soap_Exception() {
		$this->object ->setFileName ( "FILENAME" );
		$this ->expectException(Exception::class);
        $this->expectExceptionMessage( '(TESTS VirtualDiskFlatVer1BackingInfo) Il faut un diskMode' );
		$this->object ->renvoi_donnees_soap ();
	}

	/**
	 * @covers Zorille\framework\VirtualDiskFlatVer1BackingInfo::renvoi_donnees_soap
	 */
	public function testrenvoi_donnees_soap() {
		$parent = $this ->createMock('Zorille\framework\VirtualDiskFlatVer1BackingInfo' );
		$parent ->expects ( $this ->any () ) 
			->method ( 'renvoi_donnees_soap' ) 
			->will ( $this ->returnValue ( array ( 
				"VirtualDiskFlatVer1BackingInfo" ) ) );
		$this->object ->setFileName ( "FILENAME" ) 
			->setDiskMode ( "persistent" ) 
			->setContentId ( "contentId" ) 
			->setParent ( $parent ) 
			->setSplit ( TRUE ) 
			->setWriteThrough ( TRUE );
		$this ->assertEquals ( array ( 
				'fileName' => 'FILENAME', 
				'diskMode' => 'persistent', 
				'contentId' => 'contentId', 
				'parent' => Array ( 
						'VirtualDiskFlatVer1BackingInfo' ), 
				'split' => true, 
				'writeThrough' => true ), $this->object ->renvoi_donnees_soap () );
	}

	/**
	 * @covers Zorille\framework\VirtualDiskFlatVer1BackingInfo::renvoi_donnees_soap
	 */
	public function testrenvoi_donnees_soap_renvoi_objet() {
		$this->object ->setFileName ( "FILENAME" ) 
			->setDiskMode ( "persistent" );
		$object = new arrayObject ( array ( 
				'fileName' => 'FILENAME', 
				'diskMode' => 'persistent' ) );
		$this ->assertEquals ( $object, $this->object ->renvoi_donnees_soap ( true ) );
	}

	/**
	 * @covers Zorille\framework\VirtualDiskFlatVer1BackingInfo::renvoi_objet_soap
	 */
	public function testrenvoi_objet_soap_renvoi_objet() {
		$this->object ->setFileName ( "FILENAME" ) 
			->setDiskMode ( "persistent" );
		$object = new arrayObject ( array ( 
				'fileName' => 'FILENAME', 
				'diskMode' => 'persistent' ) );
		$resultat = new soapvar ( $object, SOAP_ENC_OBJECT, "VirtualDiskFlatVer1BackingInfo" );
		$this ->assertEquals ( $resultat, $this->object ->renvoi_objet_soap ( true ) );
	}
}
