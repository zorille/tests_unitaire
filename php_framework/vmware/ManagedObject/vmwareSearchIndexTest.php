<?php
namespace Zorille\framework;
use \stdClass as stdClass;
/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2015-04-29 at 09:09:03.
 */
if (! defined ( '__DOCUMENT_ROOT__' )) {
	require_once $_SERVER ["PWD"] . '/prepare.php';
}
class vmwareSearchIndexTest extends MockedListeOptions {
	/**
     * @var vmwareSearchIndex
     */
	protected $object;

	/**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
	protected function setUp() {
		ob_start ();
		$soap_message = new stdClass ();
		$soap_message->searchIndex = "MOID_searchIndex";
		$objetVmwareServiceInstance = $this->createMock('Zorille\framework\vmwareServiceInstance' );
		$objetVmwareServiceInstance->expects ( $this->any () )
			->method ( 'getAuth' )
			->will ( $this->returnValue ( $soap_message ) );
		$objetVmwareWsclient = $this->createMock('Zorille\framework\vmwareWsclient' );
		$objetVmwareWsclient->expects ( $this->any () )
			->method ( 'getObjectServiceInstance' )
			->will ( $this->returnValue ( $objetVmwareServiceInstance ) );
		
		$this->object = new vmwareSearchIndex ();
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
	 * @covers Zorille\framework\vmwareSearchIndex::creer_entete_searchIndex_this
	 */
	public function testcreer_entete_searchIndex_this() {
		$resultat_soap = new stdClass ();
		$resultat_soap->_this = "MOID_searchIndex";
	
		$this->assertEquals ( $resultat_soap, $this->object->creer_entete_searchIndex_this (  ) );
	}
	
	/**
	 * @covers Zorille\framework\vmwareSearchIndex::FindChild
	 */
	public function testFindChild() {
		$resultat_soap = new stdClass ();
		$resultat_soap->object = "THIS";
		
		$this->object->getObjectVmwareWsclient ()
		->expects ( $this->any () )
		->method ( 'applique_requete_soap' )
		->will ( $this->returnValue ( $resultat_soap ) );
		
		$ManagedObjectReference = array (
				"_" => "MOID_vmware",
				"type" => "HostSystem"
		);
		$this->assertEquals ( $resultat_soap, $this->object->FindChild ( $ManagedObjectReference, "NOM" ) );
	}
}
