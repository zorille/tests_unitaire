<?php
namespace Zorille\framework;
use \Exception as Exception;

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
class ucmdb_datasTest extends MockedListeOptions {
	/**
     * @var ucmdb_datas
     */
	protected $object;

	/**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
	protected function setUp() {
		ob_start ();
		
		$utilisateurs = $this ->createMock('Zorille\framework\utilisateurs' );
		$utilisateurs ->expects ( $this ->any () ) 
			->method ( 'retrouve_utilisateurs_array' ) 
			->will ( $this ->returnValue ( $utilisateurs ) );
		$utilisateurs ->expects ( $this ->any () ) 
			->method ( 'getUsername' ) 
			->will ( $this ->returnValue ( 'USER1' ) );
		$utilisateurs ->expects ( $this ->any () ) 
			->method ( 'getPassword' ) 
			->will ( $this ->returnValue ( 'PASS1' ) );
		
		$this->object = new ucmdb_datas ( false, "TESTS ucmdb_datas" );
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
	 * @covers Zorille\framework\ucmdb_datas::retrouve_ucmdb_param
	 */
	public function testRetrouve_ucmdb_param_exception1() {
		$this->object ->getListeOptions () 
			->method ( 'verifie_variable_standard' ) 
			->will ( $this ->returnValue ( false ) );
		$this->object ->getListeOptions () 
			->expects ( $this ->any () ) 
			->method ( 'renvoi_variables_standard' ) 
			->will ( $this ->returnValue ( array ( 
				"#comment" => "et voila un commentaire", 
				"nom" => "SIS_TEST" ) ) );
		
		$this ->expectException(Exception::class);
        $this->expectExceptionMessage( '(TESTS ucmdb_datas) Il manque le parametre : ucmdb_serveur' );
		$this->object ->retrouve_ucmdb_param ();
	}

	/**
	 * @covers Zorille\framework\ucmdb_datas::retrouve_ucmdb_param
	 */
	public function testRetrouve_ucmdb_param_exception2() {
		$this->object ->getListeOptions () 
			->method ( 'verifie_variable_standard' ) 
			->will ( $this ->onConsecutiveCalls ( true, false ) );
		$this->object ->getListeOptions () 
			->expects ( $this ->any () ) 
			->method ( 'renvoi_variables_standard' ) 
			->will ( $this ->returnValue ( array ( 
				"#comment" => "et voila un commentaire", 
				"nom" => "SIS_TEST" ) ) );
		
		$this ->expectException(Exception::class);
        $this->expectExceptionMessage( '(TESTS ucmdb_datas) Il manque le parametre : ucmdb_wsdl' );
		$this->object ->retrouve_ucmdb_param ();
	}

	/**
	 * @covers Zorille\framework\ucmdb_datas::retrouve_ucmdb_param
	 */
	public function testRetrouve_ucmdb_param_valide() {
		$this->object ->getListeOptions () 
			->method ( 'verifie_variable_standard' ) 
			->will ( $this ->onConsecutiveCalls ( true, true ) );
		$this->object ->getListeOptions () 
			->expects ( $this ->any () ) 
			->method ( 'renvoi_variables_standard' ) 
			->will ( $this ->returnValue ( array ( 
				"#comment" => "et voila un commentaire", 
				"nom" => "SIS_TEST" ) ) );
		
		$this ->assertInstanceOf ( 'Zorille\framework\ucmdb_datas', $this->object ->retrouve_ucmdb_param () );
	}

	/**
	 * @covers Zorille\framework\ucmdb_datas::valide_presence_ucmdb_data
	 */
	public function testvalide_presence_ucmdb_data() {
		$this->object ->setServeurData ( array ( 
				"TEST" => array ( 
						"nom" => "NOMMACHINE" ), 
				"TEST2" => array ( 
						"nom" => "NOMMACHINE2" ) ) );
		$this ->assertEquals ( array ( 
				"nom" => "NOMMACHINE", 
				'username' => 'USER1', 
				'password' => 'PASS1' ), $this->object ->valide_presence_ucmdb_data ( "NOMMACHINE" ) );
		$this ->assertEquals ( array ( 
				"nom" => "NOMMACHINE2", 
				'username' => 'USER1', 
				'password' => 'PASS1' ), $this->object ->valide_presence_ucmdb_data ( "NOMMACHINE2" ) );
		$this ->assertFalse ( $this->object ->valide_presence_ucmdb_data ( "NOMMACHINE3" ) );
	}

	/**
	 * @covers Zorille\framework\ucmdb_datas::retrouve_wsdl
	 */
	public function testRetrouve_wsdl_exception() {
		$this->object ->setWsdlData ( array ( 
				"WSDL_DATA1" => "DATA1", 
				"WSDL_DATA2" => array ( 
						"DATA2" ) ) );
		
		$this ->expectException(Exception::class);
        $this->expectExceptionMessage( '(TESTS ucmdb_datas) Ce wsdl FALSE_WSDL n\'existe pas.' );
		$this->object ->retrouve_wsdl ( "FALSE_WSDL" );
	}

	/**
	 * @covers Zorille\framework\ucmdb_datas::retrouve_wsdl
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
	 * @covers Zorille\framework\ucmdb_datas::recupere_donnees_ucmdb_serveur
	 */
	public function testRecupere_donnees_ucmdb_serveur_exception1() {
		$this->object ->setServeurData ( array ( 
				"sis_name_test" => array ( 
						"nom" => "SIS_TEST" ) ) );
		$this->object ->setWsdlData ( array ( 
				"WSDL_TEST" => "DATA1" ) );
		
		$this ->expectException(Exception::class);
        $this->expectExceptionMessage( '(TESTS ucmdb_datas) Il faut un nom de ucmdb pour se connecter.' );
		$this->object ->recupere_donnees_ucmdb_serveur ( "", "" );
	}

	/**
	 * @covers Zorille\framework\ucmdb_datas::recupere_donnees_ucmdb_serveur
	 */
	public function testRecupere_donnees_ucmdb_serveur_exception2() {
		$this->object ->setServeurData ( array ( 
				"sis_name_test" => array ( 
						"nom" => "SIS_TEST" ) ) );
		$this->object ->setWsdlData ( array ( 
				"WSDL_TEST" => "DATA1" ) );
		
		$this ->expectException(Exception::class);
        $this->expectExceptionMessage( '(TESTS ucmdb_datas) Il faut un wsdl de ucmdb pour se connecter.' );
		$this->object ->recupere_donnees_ucmdb_serveur ( "SIS_TEST", "" );
	}

	/**
	 * @covers Zorille\framework\ucmdb_datas::recupere_donnees_ucmdb_serveur
	 */
	public function testRecupere_donnees_ucmdb_serveur_false() {
		$this->object ->setServeurData ( array ( 
				"sis_name_test" => array ( 
						"nom" => "SIS_TEST" ) ) );
		$this->object ->setWsdlData ( array ( 
				"WSDL_TEST" => "DATA1" ) );
		
		$this ->assertFalse ( $this->object ->recupere_donnees_ucmdb_serveur ( "NOMMACHINE3", "WSDL_TEST" ) );
	}

	/**
	 * @covers Zorille\framework\ucmdb_datas::recupere_donnees_ucmdb_serveur
	 */
	public function testRecupere_donnees_ucmdb_serveur_valide() {
		$this->object ->setServeurData ( array ( 
				"sis_name_test" => array ( 
						"nom" => "SIS_TEST" ) ) );
		$this->object ->setWsdlData ( array ( 
				"WSDL_TEST" => "DATA1" ) );
		
		$this ->assertEquals ( array ( 
				'nom' => 'SIS_TEST', 
				'username' => 'USER1', 
				'password' => 'PASS1', 
				'wsdl' => 'DATA1' ), $this->object ->recupere_donnees_ucmdb_serveur ( "SIS_TEST", "WSDL_TEST" ) );
	}
}
?>
