<?php

/**
 * @author dvargas
 * @package Lib
 *
 */
if (! defined ( '__DOCUMENT_ROOT__' )) {
	require_once $_SERVER ["PWD"] . '/prepare.php';
}

/**
 */
class vmwareDatasTest extends MockedListeOptions {
	/**
     * @var vmwareDatas
     */
	protected $object;

	/**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
	protected function setUp() {
		ob_start ();
		
		$utilisateurs = $this ->createMock ( "utilisateurs" );
		$utilisateurs ->expects ( $this ->any () ) 
			->method ( 'retrouve_utilisateurs_array' ) 
			->will ( $this ->returnValue ( $utilisateurs ) );
		$utilisateurs ->expects ( $this ->any () ) 
			->method ( 'getUsername' ) 
			->will ( $this ->returnValue ( 'USER1' ) );
		$utilisateurs ->expects ( $this ->any () ) 
			->method ( 'getPassword' ) 
			->will ( $this ->returnValue ( 'PASS1' ) );
		
		$this->object = new vmwareDatas ( false, "TESTS vmwareDatas" );
		$this->object ->setListeOptions ( $this ->getListeOption () ) 
			->setObjetUtilisateurs ( $utilisateurs );
	}

	/**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
	protected function tearDown() {
		ob_end_clean ();
	}

	/**
	 * @covers vmwareDatas::retrouve_vmware_param
	 */
	public function testRetrouve_vmware_param_exception1() {
		$this->object ->getListeOptions () 
			->method ( 'verifie_variable_standard' ) 
			->will ( $this ->returnValue ( false ) );
		$this->object ->getListeOptions () 
			->expects ( $this ->any () ) 
			->method ( 'renvoi_variables_standard' ) 
			->will ( $this ->returnValue ( array ( 
				"#comment" => "et voila un commentaire", 
				"nom" => "VMW_TEST" ) ) );
		
		$this ->expectException(Exception::class);
        $this->expectExceptionMessage( '(TESTS vmwareDatas) Il manque le parametre : vmware_machines_serveur' );
		$this->object ->retrouve_vmware_param ();
	}

	/**
	 * @covers vmwareDatas::retrouve_vmware_param
	 */
	public function testRetrouve_vmware_param_exception2() {
		$this->object ->getListeOptions () 
			->method ( 'verifie_variable_standard' ) 
			->will ( $this ->onConsecutiveCalls ( true, false ) );
		$this->object ->getListeOptions () 
			->expects ( $this ->any () ) 
			->method ( 'renvoi_variables_standard' ) 
			->will ( $this ->returnValue ( array ( 
				"#comment" => "et voila un commentaire", 
				"nom" => "VMW_TEST" ) ) );
		
		$this ->expectException(Exception::class);
        $this->expectExceptionMessage( '(TESTS vmwareDatas) Il manque le parametre : vmware_machines_wsdl' );
		$this->object ->retrouve_vmware_param ();
	}

	/**
	 * @covers vmwareDatas::retrouve_vmware_param
	 */
	public function testRetrouve_vmware_param_valide() {
		$this->object ->getListeOptions () 
			->method ( 'verifie_variable_standard' ) 
			->will ( $this ->onConsecutiveCalls ( true, true ) );
		$this->object ->getListeOptions () 
			->expects ( $this ->any () ) 
			->method ( 'renvoi_variables_standard' ) 
			->will ( $this ->returnValue ( array ( 
				"#comment" => "et voila un commentaire", 
				"nom" => "VMW_TEST" ) ) );
		
		$this ->assertSame ( $this->object, $this->object ->retrouve_vmware_param () );
		//$this->assertInstanceOf ( 'vmwareDatas', $this->object->retrouve_vmware_param () );
	}

	/**
	 * @covers vmwareDatas::valide_presence_vmware_data
	 */
	public function testvalide_presence_vmware_data() {
		$this->object ->setServeurData ( array ( 
				"TEST" => array ( 
						"nom" => "NOMMACHINE" ), 
				"TEST2" => array ( 
						"nom" => "NOMMACHINE2" ) ) );
		$this ->assertEquals ( array ( 
				"nom" => "NOMMACHINE", 
				'username' => 'USER1', 
				'password' => 'PASS1' ), $this->object ->valide_presence_vmware_data ( "NOMMACHINE" ) );
		$this ->assertEquals ( array ( 
				"nom" => "NOMMACHINE2", 
				'username' => 'USER1', 
				'password' => 'PASS1' ), $this->object ->valide_presence_vmware_data ( "NOMMACHINE2" ) );
		$this ->assertFalse ( $this->object ->valide_presence_vmware_data ( "NOMMACHINE3" ) );
	}

	/**
	 * @covers vmwareDatas::retrouve_wsdl
	 */
	public function testRetrouve_wsdl_exception() {
		$this->object ->setWsdlData ( array ( 
				"WSDL_DATA1" => "DATA1", 
				"WSDL_DATA2" => array ( 
						"DATA2" ) ) );
		
		$this ->expectException(Exception::class);
        $this->expectExceptionMessage( '(TESTS vmwareDatas) Ce wsdl FALSE_WSDL n\'existe pas.' );
		$this->object ->retrouve_wsdl ( "FALSE_WSDL" );
	}

	/**
	 * @covers vmwareDatas::retrouve_wsdl
	 */
	public function testRetrouve_wsdl_valide() {
		$this->object ->setWsdlData ( array ( 
				"WSDL_DATA1" => "DATA1", 
				"WSDL_DATA2" => array ( 
						"DATA2" ) ) );
		
		$this ->assertEquals ( "DATA1", $this->object ->retrouve_wsdl ( "WSDL_DATA1" ) );
		$this ->assertEquals ( "DATA2", $this->object ->retrouve_wsdl ( "WSDL_DATA2" ) );
	}

	/**
	 * @covers vmwareDatas::recupere_donnees_vmware_serveur
	 */
	public function testRecupere_donnees_vmware_serveur_exception1() {
		$this->object ->setServeurData ( array ( 
				"sis_name_test" => array ( 
						"nom" => "SIS_TEST" ) ) );
		$this->object ->setWsdlData ( array ( 
				"WSDL_TEST" => "DATA1" ) );
		
		$this ->expectException(Exception::class);
        $this->expectExceptionMessage( '(TESTS vmwareDatas) Il faut un nom de vmware pour se connecter.' );
		$this->object ->recupere_donnees_vmware_serveur ( "", "" );
	}

	/**
	 * @covers vmwareDatas::recupere_donnees_vmware_serveur
	 */
	public function testRecupere_donnees_vmware_serveur_exception2() {
		$this->object ->setServeurData ( array ( 
				"sis_name_test" => array ( 
						"nom" => "SIS_TEST" ) ) );
		$this->object ->setWsdlData ( array ( 
				"WSDL_TEST" => "DATA1" ) );
		
		$this ->expectException(Exception::class);
        $this->expectExceptionMessage( '(TESTS vmwareDatas) Il faut un wsdl de vmware pour se connecter.' );
		$this->object ->recupere_donnees_vmware_serveur ( "SIS_TEST", "" );
	}

	/**
	 * @covers vmwareDatas::recupere_donnees_vmware_serveur
	 */
	public function testRecupere_donnees_vmware_serveur_false() {
		$this->object ->setServeurData ( array ( 
				"sis_name_test" => array ( 
						"nom" => "SIS_TEST" ) ) );
		$this->object ->setWsdlData ( array ( 
				"WSDL_TEST" => "DATA1" ) );
		
		$this ->assertFalse ($this->object ->recupere_donnees_vmware_serveur ( "NO_SIS", "WSDL_TEST" ));
	}

	/**
	 * @covers vmwareDatas::recupere_donnees_vmware_serveur
	 */
	public function testRecupere_donnees_vmware_serveur_valide() {
		$this->object ->setServeurData ( array ( 
				"sis_name_test" => array ( 
						"nom" => "SIS_TEST" ) ) );
		$this->object ->setWsdlData ( array ( 
				"WSDL_TEST" => "DATA1" ) );
		
		$this ->assertEquals ( array ( 
				'nom' => 'SIS_TEST', 
				'username' => 'USER1', 
				'password' => 'PASS1', 
				'wsdl' => 'DATA1' ), $this->object ->recupere_donnees_vmware_serveur ( "SIS_TEST", "WSDL_TEST" ) );
	}
}
?>
