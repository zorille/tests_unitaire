<?php
/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2015-09-07 at 11:31:16.
 */
if (! defined ( '__DOCUMENT_ROOT__' )) {
	require_once $_SERVER ["PWD"] . '/prepare.php';
}
class VirtualDiskSparseVer2BackingInfoTest extends MockedListeOptions {
	/**
     * @var VirtualDiskSparseVer2BackingInfo
     */
	protected $object;

	/**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
	protected function setUp() {
		ob_start ();
		$this->object = new VirtualDiskSparseVer2BackingInfo ( false, "TESTS VirtualDiskSparseVer2BackingInfo" );
	}

	/**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
	protected function tearDown() {
		ob_end_clean ();
	}

	/**
	 * @covers VirtualDiskSparseVer2BackingInfo::renvoi_donnees_soap
	 */
	public function testrenvoi_donnees_soap_Exception() {
		$this->object ->setFileName ( "FILENAME" );
		$this ->expectException(Exception::class);
        $this->expectExceptionMessage( '(TESTS VirtualDiskSparseVer2BackingInfo) Il faut un diskMode' );
		$this->object ->renvoi_donnees_soap ();
	}

	/**
	 * @covers VirtualDiskSparseVer2BackingInfo::renvoi_donnees_soap
	 */
	public function testrenvoi_donnees_soap() {
		$parent = $this ->createMock ( "VirtualDiskSparseVer2BackingInfo" );
		$parent ->expects ( $this ->any () ) 
			->method ( 'renvoi_donnees_soap' ) 
			->will ( $this ->returnValue ( array ( 
				"VirtualDiskSparseVer2BackingInfo" ) ) );
		$this->object ->setFileName ( "FILENAME" ) 
			->setDiskMode ( "persistent" ) 
			->setChangeId ( "changeId" ) 
			->setContentId ( "contentId" ) 
			->setParent ( $parent ) 
			->setSpaceUsedInKB ( 80000000 ) 
			->setSplit ( TRUE ) 
			->setUuid ( "UUID" ) 
			->setWriteThrough ( TRUE );
		$this ->assertEquals ( 
				array ( 
							'fileName' => 'FILENAME', 
							'diskMode' => 'persistent', 
							'changeId' => 'changeId', 
							'contentId' => 'contentId', 
							'parent' => Array ( 
									'VirtualDiskSparseVer2BackingInfo' ), 
							'spaceUsedInKB' => 80000000, 
							'split' => true, 
							'uuid' => 'UUID', 
							'writeThrough' => true ), 
					$this->object ->renvoi_donnees_soap () );
	}

	/**
	 * @covers VirtualDiskSparseVer2BackingInfo::renvoi_donnees_soap
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
	 * @covers VirtualDiskSparseVer2BackingInfo::renvoi_objet_soap
	 */
	public function testrenvoi_objet_soap_renvoi_objet() {
		$this->object ->setFileName ( "FILENAME" ) 
			->setDiskMode ( "persistent" );
		$object = new arrayObject ( array ( 
				'fileName' => 'FILENAME', 
				'diskMode' => 'persistent' ) );
		$resultat = new soapvar ( $object, SOAP_ENC_OBJECT, "VirtualDiskSparseVer2BackingInfo" );
		$this ->assertEquals ( $resultat, $this->object ->renvoi_objet_soap ( true ) );
	}
}
