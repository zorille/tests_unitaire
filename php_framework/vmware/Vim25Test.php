<?php
/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2015-04-29 at 09:09:03.
 */
if (! defined ( '__DOCUMENT_ROOT__' )) {
	require_once $_SERVER ["PWD"] . '/prepare.php';
}
class Vim25Test extends MockedListeOptions {
	/**
     * @var Vim25
     */
	protected $object;

	/**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
	protected function setUp() {
		ob_start ();
		
		$objetVmwareWsclient = $this->createMock ( "vmwareWsclient" );
		$objetVmwareWsclient->expects ( $this->any () )
			->method ( 'applique_requete_soap' )
			->will ( $this->returnValue ( array () ) );
		$objetVmwareWsclient->expects ( $this->any () )
			->method ( 'convertit_donnees' )
			->will ( $this->returnValue ( array (
				"DATAS SOAP" 
		) ) );
		
		$this->object = new Vim25 ( false, "TESTS Vim25" );
		$this->object->setListeOptions ( $this->getListeOption () )
			->setObjectVmwareWsclient ( $objetVmwareWsclient );
	}

	/**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
	protected function tearDown() {
		ob_end_clean ();
	}

	/**
	 * @covers Vim25::affiche_les_Tests
	 */
	public function testaffiche_les_Tests() {
		$this->assertEquals ( "affiche", $this->object->affiche_les_Tests () );
	}
}