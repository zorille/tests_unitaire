<?php
/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2014-08-26 at 11:09:00.
 */
if (! defined ( '__DOCUMENT_ROOT__' )) {
	require_once $_SERVER ["PWD"] . '/prepare.php';
}
class vmware_fonctions_standardsTest extends MockedListeOptions {
	/**
     * @var vmware_fonctions_standards
     */
	protected $object;

	/**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
	protected function setUp() {
		ob_start ();
		
		$vmwareWsclient = $this ->createMock ( "vmwareWsclient" );
		
		$this->object = new vmware_fonctions_standards ( false, "vmware_fonctions_standards" );
		$this->object ->setListeOptions ( $this ->getListeOption () ) 
			->setObjetVmwareSoapConfigurationRef ( $vmwareWsclient );
	}

	/**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
	protected function tearDown() {
		ob_end_clean ();
	}

	/**
     * @covers vmware_fonctions_standards::connexion_soap_configuration_de_tous_les_vmwares
     */
	public function testConnexion_soap_configuration_de_tous_les_vmwares_Exception_liste_vmware() {
		$this ->expectException(Exception::class);
        $this->expectExceptionMessage( '(vmware_fonctions_standards) Il faut un tableau de nom de vmware' );
		$liste_noms_sis = "VMWARE1";
		$this->object ->connexion_soap_configuration_de_tous_les_vmwares ( $liste_noms_sis );
	}

	/**
	 * @covers vmware_fonctions_standards::connexion_soap_configuration_de_tous_les_vmwares
	 */
	public function testConnexion_soap_configuration_de_tous_les_vmwares_Exception_connect() {
		$liste_noms_sis = array ( 
				"VMWARE1" );
		
		$this->object ->getObjetVmwareSoapConfigurationRef () 
			->expects ( $this ->any () ) 
			->method ( 'prepare_connexion' ) 
			->will ( $this ->throwException ( new Exception () ) );
		
		$this ->assertTrue ( $this->object ->connexion_soap_configuration_de_tous_les_vmwares ( $liste_noms_sis ) );
		$this ->assertEquals ( array (), $liste_noms_sis );
	}

	/**
	 * @covers vmware_fonctions_standards::connexion_soap_configuration_de_tous_les_vmwares
	 */
	public function testConnexion_soap_configuration_de_tous_les_vmwares_valide() {
		$liste_noms_sis = array ( 
				"VMWARE1" );
		$this ->assertTrue ( $this->object ->connexion_soap_configuration_de_tous_les_vmwares ( $liste_noms_sis ) );
		$this ->assertEquals ( array ( 
				$this->object ->getObjetVmwareSoapConfigurationRef () ), $liste_noms_sis );
	}

	/**
	 * @covers vmware_fonctions_standards::nettoie_vmware_non_connecte
	 */
	public function testnettoie_vmware_non_connecte() {
		$liste_noms_sis = array ( 
				"VMWARE1", 
				"VMWARE2" );
		$this ->assertSame ( $this->object, $this->object ->nettoie_vmware_non_connecte ( $liste_noms_sis, 1 ) );
		$this ->assertEquals ( array ( 
				'VMWARE1' ), $liste_noms_sis );
	}
}
