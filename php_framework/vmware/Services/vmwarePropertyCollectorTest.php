<?php
namespace Zorille\framework;
use \Exception as Exception;
use \stdClass as stdClass;
/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2015-04-29 at 09:07:56.
 */
if (! defined ( '__DOCUMENT_ROOT__' )) {
	require_once $_SERVER ["PWD"] . '/prepare.php';
}
class vmwarePropertyCollectorTest extends MockedListeOptions {
	/**
     * @var vmwarePropertyCollector
     */
	protected $object;

	/**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
	protected function setUp() {
		ob_start ();
		
		$objetVmwareWsclient = $this ->createMock('Zorille\framework\vmwareWsclient' );
		$objetVmwareWsclient ->expects ( $this ->any () ) 
			->method ( 'applique_requete_soap' ) 
			->will ( $this ->returnValue ( array ( 
				"RESULTAT SOAP" ) ) );
		
		$this->object = new vmwarePropertyCollector ( false, "TESTS vmwarePropertyCollector" );
		$this->object ->setListeOptions ( $this ->getListeOption () ) 
			->setObjectVmwareWsclient ( $objetVmwareWsclient );
		
		$soap_ServiceInstance_MOID = new stdClass ();
		$soap_ServiceInstance_MOID->_ = "MOID_propertyCollector";
		$soap_ServiceInstance_MOID->type = "propertyCollector";
		$this->object ->setPropertyCollector ( $soap_ServiceInstance_MOID );
	}

	/**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
	protected function tearDown() {
		ob_end_clean ();
	}

	/**
	 * @covers Zorille\framework\vmwarePropertyCollector::retrouve_propertyCollector
	 */
	public function testretrouve_propertyCollector_Exception() {
		$soap_message = new stdClass ();
		$soap_message->noFolders = "MOID_noFolders";
		$this ->expectException(Exception::class);
        $this->expectExceptionMessage( '(TESTS vmwarePropertyCollector) Pas de propriete propertyCollector dans la liste des ServiceInstances' );
		$this->object ->retrouve_propertyCollector ( $soap_message );
	}

	/**
	 * @covers Zorille\framework\vmwarePropertyCollector::retrouve_propertyCollector
	 */
	public function testretrouve_propertyCollector() {
		$soap_ServiceInstance = new stdClass ();
		$soap_ServiceInstance->propertyCollector = "MOID_propertyCollector";
		
		$this ->assertSame ( $this->object, $this->object ->retrouve_propertyCollector ( $soap_ServiceInstance ) );
	}

	/**
	 * @covers Zorille\framework\vmwarePropertyCollector::creer_entete_propertyCollector_this
	 */
	public function testcreer_entete_propertyCollector_this() {
		$MOID_propertyCollector = new stdClass ();
		$MOID_propertyCollector->_this = $this->object ->getPropertyCollector ();
		
		$this ->assertEquals ( $MOID_propertyCollector, $this->object ->creer_entete_propertyCollector_this () );
	}

	/**
     * @covers Zorille\framework\vmwarePropertyCollector::retrouve_donnees_par_ManagedObject
     */
	public function testretrouve_donnees_par_ManagedObject_array() {
		$ManagedObjectReference = array ( 
				"_" => "MOID_vmware", 
				"type" => "TYPE_VMWARE" );
		$this ->assertEquals ( array ( 
				"RESULTAT SOAP" ), $this->object ->retrouve_donnees_par_ManagedObject ( $ManagedObjectReference ) );
	}

	/**
	 * @covers Zorille\framework\vmwarePropertyCollector::retrouve_donnees_par_ManagedObject
	 */
	public function testretrouve_donnees_par_ManagedObject_stdclass() {
		$ManagedObjectReference = new stdClass ();
		$ManagedObjectReference->_ = "MOID_vmware";
		$ManagedObjectReference->type = "TYPE_VMWARE";
		$this ->assertEquals ( array ( 
				"RESULTAT SOAP" ), $this->object ->retrouve_donnees_par_ManagedObject ( $ManagedObjectReference ) );
	}

	/**
	 * @covers Zorille\framework\vmwarePropertyCollector::retrouve_propset
	 */
	public function testretrouve_propset_without_propset() {
		$objetXML = $this ->createMock('Zorille\framework\xml' );
		$objetXML ->expects ( $this ->any () ) 
			->method ( 'renvoi_donnee' ) 
			->will ( $this ->returnValue ( false ) );
		$objetVmwareWsclient = $this ->createMock('Zorille\framework\vmwareWsclient' );
		$objetVmwareWsclient ->expects ( $this ->any () ) 
			->method ( 'applique_requete_soap' ) 
			->will ( $this ->returnValue ( array () ) );
		$objetVmwareWsclient ->expects ( $this ->any () ) 
			->method ( 'convertit_donnees' ) 
			->will ( $this ->returnValue ( $objetXML ) );
		$this->object ->setObjectVmwareWsclient ( $objetVmwareWsclient );
		
		$ManagedObjectReference = array ( 
				"_" => "MOID_vmware", 
				"type" => "TYPE_VMWARE" );
		$this ->assertEquals ( array (), $this->object ->retrouve_propset ( $ManagedObjectReference ) );
	}

	/**
	 * @covers Zorille\framework\vmwarePropertyCollector::retrouve_propset
	 */
	public function testretrouve_propset_with_propset() {
		$objetXML = $this ->createMock('Zorille\framework\xml' );
		$objetXML ->expects ( $this ->any () ) 
			->method ( 'renvoi_donnee' ) 
			->will ( $this ->returnValue ( "DATAS PROPSET" ) );
		$objetVmwareWsclient = $this ->createMock('Zorille\framework\vmwareWsclient' );
		$objetVmwareWsclient ->expects ( $this ->any () ) 
			->method ( 'applique_requete_soap' ) 
			->will ( $this ->returnValue ( array () ) );
		$objetVmwareWsclient ->expects ( $this ->any () ) 
			->method ( 'convertit_donnees' ) 
			->will ( $this ->returnValue ( $objetXML ) );
		$this->object ->setObjectVmwareWsclient ( $objetVmwareWsclient );
		
		$ManagedObjectReference = array ( 
				"_" => "MOID_vmware", 
				"type" => "TYPE_VMWARE" );
		$this ->assertEquals ( "DATAS PROPSET", $this->object ->retrouve_propset ( $ManagedObjectReference ) );
	}

	/**
     * @covers Zorille\framework\vmwarePropertyCollector::RetrievePropertiesEx
     */
	public function testRetrievePropertiesEx() {
		$this ->assertEquals ( array ( 
				"RESULTAT SOAP" ), $this->object ->RetrievePropertiesEx ( "TYPE1" ) );
	}

	/**
	 * @covers Zorille\framework\vmwarePropertyCollector::ContinueRetrievePropertiesEx
	 */
	public function testContinueRetrievePropertiesEx() {
		$this ->assertEquals ( array ( 
				"RESULTAT SOAP" ), $this->object ->ContinueRetrievePropertiesEx ( "Token" ) );
	}

	/**
     * @covers Zorille\framework\vmwarePropertyCollector::PropertyFilterSpec
     */
	public function testPropertyFilterSpec() {
		$this ->assertEquals ( 
				array ( 
							0 => array ( 
									'type' => 'TYPE1', 
									'all' => 0, 
									'pathSet' => Array ( 
											'name', 
											'guest.ipAddress', 
											'guest.guestState', 
											'runtime.powerState', 
											'config.hardware.numCPU', 
											'config.hardware.memoryMB' ) ) ), 
					$this->object ->PropertyFilterSpec ( "TYPE1", 0, array ( 
							'name', 
							'guest.ipAddress', 
							'guest.guestState', 
							'runtime.powerState', 
							'config.hardware.numCPU', 
							'config.hardware.memoryMB' ) ) );
	}

	/**
     * @covers Zorille\framework\vmwarePropertyCollector::ObjectSpec
     */
	public function testObjectSpec() {
		$ManagedObjectReference = new stdClass ();
		$ManagedObjectReference->_this = "ha-datacenter";
		$this ->assertSame ( $this->object, $this->object ->ObjectSpec ( $ManagedObjectReference ) );
		$this ->assertEquals ( array ( 
				'obj' => 'ha-datacenter', 
				'skip' => false, 
				'selectSet' => Array () ), $this->object ->getObjectSpec () );
	}
}
