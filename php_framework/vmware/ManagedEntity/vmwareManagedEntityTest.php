<?php
namespace Zorille\framework;
use \stdClass as stdClass;
/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2015-04-29 at 09:07:56.
 */
if (! defined ( '__DOCUMENT_ROOT__' )) {
	require_once $_SERVER ["PWD"] . '/prepare.php';
}
class vmwareManagedEntityTest extends MockedListeOptions {
	/**
     * @var vmwareManagedEntity
     */
	protected $object;

	/**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
	protected function setUp() {
		ob_start ();
		
		$objetVmwareWsclient = $this->createMock('Zorille\framework\vmwareWsclient' );
		$objetVmwareWsclient->expects ( $this->any () )
			->method ( 'applique_requete_soap' )
			->will ( $this->returnValue ( array (
				"RESULTAT SOAP" 
		) ) );
		
		$this->object = new vmwareManagedEntity ( false, "TESTS vmwareManagedEntity" );
		$this->object->setListeOptions ( $this->getListeOption () )
			->setObjectVmwareWsclient ( $objetVmwareWsclient );
		
		$ManagedEntity = new stdClass ();
		$ManagedEntity->_ = "MOID_ManagedEntity";
		$ManagedEntity->type = "ManagedEntity";
		$this->object->setManagedObject ( $ManagedEntity );
	}

	/**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
	protected function tearDown() {
		ob_end_clean ();
	}

	/**
     * @covers Zorille\framework\vmwareManagedEntity::Destroy_Task
     */
	public function testDestroy_Task() {
		$this->assertEquals ( array (
				"RESULTAT SOAP" 
		), $this->object->Destroy_Task () );
	}
}
