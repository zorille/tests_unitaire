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
class itop_datasTest extends MockedListeOptions {
	/**
     * @var itop_datas
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
		
		$this->object = new itop_datas ( false, "TESTS itop_datas" );
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
	 * @covers itop_datas::retrouve_itop_param
	 */
	public function testRetrouve_itop_param_exception1() {
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
        $this->expectExceptionMessage( '(TESTS itop_datas) Il manque le parametre : itop_machines_serveur' );
		$this->object ->retrouve_itop_param ();
	}

	/**
	 * @covers itop_datas::retrouve_itop_param
	 */
	public function testRetrouve_itop_param_exception2() {
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
        $this->expectExceptionMessage( '(TESTS itop_datas) Il manque le parametre : itop_machines_wsdl' );
		$this->object ->retrouve_itop_param ();
	}

	/**
	 * @covers itop_datas::retrouve_itop_param
	 */
	public function testRetrouve_itop_param_valide() {
		$this->object ->getListeOptions () 
			->method ( 'verifie_variable_standard' ) 
			->will ( $this ->onConsecutiveCalls ( true, true ) );
		$this->object ->getListeOptions () 
			->expects ( $this ->any () ) 
			->method ( 'renvoi_variables_standard' ) 
			->will ( $this ->onConsecutiveCalls ( array ( 
				"#comment" => "et voila un commentaire", 
				"nom" => "VMW_TEST" ), array ( 
				"wsdl" => "WSDL_NAME" ) ) );
		$this ->assertSame ( $this->object, $this->object ->retrouve_itop_param () );
		$this ->assertEquals ( array ( 
				'nom' => 'VMW_TEST' ), $this->object ->getServeurDatas () );
		$this ->assertEquals ( array ( 
				'wsdl' => 'WSDL_NAME' ), $this->object ->getWsdlDatas () );
	}

	/**
	 * @covers itop_datas::valide_presence_itop_data
	 */
	public function testvalide_presence_itop_data() {
		$this->object ->setServeurData ( array ( 
				"TEST" => array ( 
						"nom" => "NOMMACHINE" ), 
				"TEST2" => array ( 
						"nom" => "NOMMACHINE2" ) ) );
		$this ->assertEquals ( array ( 
				"nom" => "NOMMACHINE", 
				'username' => 'USER1', 
				'password' => 'PASS1' ), $this->object ->valide_presence_itop_data ( "NOMMACHINE" ) );
		$this ->assertEquals ( array ( 
				"nom" => "NOMMACHINE2", 
				'username' => 'USER1', 
				'password' => 'PASS1' ), $this->object ->valide_presence_itop_data ( "NOMMACHINE2" ) );
		$this ->assertFalse ( $this->object ->valide_presence_itop_data ( "NOMMACHINE3" ) );
	}

	/**
	 * @covers itop_datas::retrouve_wsdl
	 */
	public function testRetrouve_wsdl_exception() {
		$this->object ->setWsdlData ( array ( 
				"WSDL_DATA1" => "DATA1", 
				"WSDL_DATA2" => array ( 
						"DATA2" ) ) );
		
		$this ->expectException(Exception::class);
        $this->expectExceptionMessage( '(TESTS itop_datas) Ce wsdl FALSE_WSDL n\'existe pas.' );
		$this->object ->retrouve_wsdl ( "FALSE_WSDL" );
	}

	/**
	 * @covers itop_datas::retrouve_wsdl
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
	 * @covers itop_datas::recupere_donnees_itop_serveur
	 */
	public function testRecupere_donnees_itop_serveur_exception1() {
		$this->object ->setServeurData ( array ( 
				"sis_name_test" => array ( 
						"nom" => "SIS_TEST" ) ) );
		$this->object ->setWsdlData ( array ( 
				"WSDL_TEST" => "DATA1" ) );
		
		$this ->expectException(Exception::class);
        $this->expectExceptionMessage( '(TESTS itop_datas) Il faut un nom de itop pour se connecter.' );
		$this->object ->recupere_donnees_itop_serveur ( "", "" );
	}

	/**
	 * @covers itop_datas::recupere_donnees_itop_serveur
	 */
	public function testRecupere_donnees_itop_serveur_exception2() {
		$this->object ->setServeurData ( array ( 
				"sis_name_test" => array ( 
						"nom" => "SIS_TEST" ) ) );
		$this->object ->setWsdlData ( array ( 
				"WSDL_TEST" => "DATA1" ) );
		
		$this ->expectException(Exception::class);
        $this->expectExceptionMessage( '(TESTS itop_datas) Il faut un wsdl de itop pour se connecter.' );
		$this->object ->recupere_donnees_itop_serveur ( "SIS_TEST", "" );
	}

	/**
	 * @covers itop_datas::recupere_donnees_itop_serveur
	 */
	public function testRecupere_donnees_itop_serveur_exception3() {
		$this->object ->setServeurData ( array ( 
				"sis_name_test" => array ( 
						"nom" => "SIS_TEST" ) ) );
		$this->object ->setWsdlData ( array ( 
				"WSDL_TEST" => "DATA1" ) );
		
		
		$this ->assertFalse ($this->object ->recupere_donnees_itop_serveur ( "NO_SIS", "WSDL_TEST" ));
	}

	/**
	 * @covers itop_datas::recupere_donnees_itop_serveur
	 */
	public function testRecupere_donnees_itop_serveur_valide() {
		$this->object ->setServeurData ( array ( 
				"sis_name_test" => array ( 
						"nom" => "SIS_TEST" ) ) );
		$this->object ->setWsdlData ( array ( 
				"WSDL_TEST" => "DATA1" ) );
		
		$this ->assertEquals ( array ( 
				'nom' => 'SIS_TEST', 
				'username' => 'USER1', 
				'password' => 'PASS1', 
				'wsdl' => 'DATA1' ), $this->object ->recupere_donnees_itop_serveur ( "SIS_TEST", "WSDL_TEST" ) );
	}
}
?>
