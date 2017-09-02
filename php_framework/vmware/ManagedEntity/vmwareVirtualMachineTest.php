<?php
/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2015-04-29 at 09:07:56.
 */
if (! defined ( '__DOCUMENT_ROOT__' )) {
	require_once $_SERVER ["PWD"] . '/prepare.php';
}
class vmwareVirtualMachineTest extends MockedListeOptions {
	/**
     * @var vmwareVirtualMachine
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
			->will ( $this->returnValue ( array (
				"RESULTAT SOAP" 
		) ) );
		
		$this->object = new vmwareVirtualMachine ( false, "TESTS vmwareVirtualMachine" );
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
     * @covers vmwareVirtualMachine::CloneVM_Task
     */
	public function testCloneVM_Task() {
		$this->assertEquals ( array (
				"RESULTAT SOAP" 
		), $this->object->CloneVM_Task ( "NAME", "MOID_Folder", "VM_Spec" ) );
	}

	/**
	 * @covers vmwareVirtualMachine::ExportVm
	 */
	public function testExportVm() {
		$this->assertEquals ( array (
				"RESULTAT SOAP" 
		), $this->object->ExportVm () );
	}

	/**
	 * @covers vmwareVirtualMachine::ExtractOvfEnvironment
	 */
	public function testExtractOvfEnvironment() {
		$this->assertEquals ( array (
				"RESULTAT SOAP" 
		), $this->object->ExtractOvfEnvironment () );
	}

	/**
	 * @covers vmwareVirtualMachine::MarkAsVirtualMachine
	 */
	public function testMarkAsVirtualMachine() {
		$this->assertEquals ( array (
				"RESULTAT SOAP" 
		), $this->object->MarkAsVirtualMachine ( "MoID_ResourcePool", "MoID_host" ) );
	}

	/**
	 * @covers vmwareVirtualMachine::PowerOffVM_Task
	 */
	public function testPowerOffVM_Task() {
		$this->assertEquals ( array (
				"RESULTAT SOAP" 
		), $this->object->PowerOffVM_Task () );
	}

	/**
	 * @covers vmwareVirtualMachine::PowerOnVM_Task
	 */
	public function testPowerOnVM_Task() {
		$this->assertEquals ( array (
				"RESULTAT SOAP" 
		), $this->object->PowerOnVM_Task ( "MoID_host" ) );
	}

	/**
	 * @covers vmwareVirtualMachine::ReconfigVM_Task
	 */
	public function testReconfigVM_Task() {
		$this->assertEquals ( array (
				"RESULTAT SOAP" 
		), $this->object->ReconfigVM_Task ( array (
				"VirtualMachineConfigSpec" 
		) ) );
	}

	/**
	 * @covers vmwareVirtualMachine::ShutdownGuest
	 */
	public function testShutdownGuest() {
		$this->assertEquals ( array (
				"RESULTAT SOAP" 
		), $this->object->ShutdownGuest () );
	}

	/**
	 * @covers vmwareVirtualMachine::remplace_annotation
	 */
	public function testremplace_annotation() {
		$this->assertEquals ( array (
				"RESULTAT SOAP" 
		), $this->object->remplace_annotation ( "NEW ANNOTATION" ) );
	}
}
