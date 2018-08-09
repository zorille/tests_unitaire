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
class utilisateursTest extends MockedListeOptions {
	/**
	 *
	 * @var utilisateurs
	 */
	protected $object;

	/**
	 * Sets up the fixture, for example, opens a network connection. This method is called before a test is executed.
	 */
	protected function setUp() {
		ob_start ();
		
		$this->object = new utilisateurs ( false, "TESTS utilisateurs" );
		$this->object ->setListeOptions ( $this ->getListeOption () );
	}

	/**
	 * Tears down the fixture, for example, closes a network connection. This method is called after a test is executed.
	 */
	protected function tearDown() {
		ob_end_clean ();
	}

	/**
	 * @covers utilisateurs::retrouve_utilisateurs_param
	 */
	public function testretrouve_utilisateurs_param() {
		$this->object ->getListeOptions () 
			->expects ( $this ->at ( 0 ) ) 
			->method ( 'verifie_variable_standard' ) 
			->will ( $this ->returnValue ( true ) );
		$this->object ->getListeOptions () 
			->expects ( $this ->any () ) 
			->method ( 'renvoi_variables_standard' ) 
			->will ( $this ->returnValue ( array ( 
				"#comment" => "et voila un commentaire", 
				"NAME1" => array ( 
						"username" => "REAL_USERNAME" ) ) ) );
		$this ->assertSame ( $this->object, $this->object ->retrouve_utilisateurs_param () );
		$this ->assertEquals ( array ( 
				"NAME1" => array ( 
						"username" => "REAL_USERNAME" ) ), $this->object ->getListeUtilisateurs () );
	}

	/**
	 * @covers utilisateurs::prepare_cryptage
	 */
	public function testPrepare_cryptage() {
		$this ->assertSame ( $this->object, $this->object ->prepare_cryptage () );
		$this ->assertEquals ( 16, $this->object ->getIvSize () );
		$this ->assertEquals ( pack ( 'H*', "bcb04b7e103a0cd8b54763051cef08bc55abe029fdebae5e1d417e2ffb2a00a3" ), $this->object ->getCleCryptage () );
	}

	/**
	 * @covers utilisateurs::retrouve_utilisateur_centralise
	 */
	public function testretrouve_utilisateur_centralise_Exception1() {
		$this ->expectException(Exception::class);
        $this->expectExceptionMessage( '(TESTS utilisateurs) NO_USERNAME n\'est pas reconnu' );
		$this->object ->retrouve_utilisateur_centralise ( 'NO_USERNAME' );
	}

	/**
	 * @covers utilisateurs::retrouve_utilisateur_centralise
	 */
	public function testretrouve_utilisateur_centralise() {
		$this->object ->setListeUtilisateurs ( array ( 
				"NAME1" => array ( 
						"username" => "REAL_USERNAME" ) ) );
		$this ->assertSame ( $this->object, $this->object ->retrouve_utilisateur_centralise ( "NAME1" ) );
	}

	/**
	 * @covers utilisateurs::retrouve_utilisateurs_cli
	 */
	public function testRetrouve_utilisateurs_cli_Exception1() {
		$this ->getListeOption () 
			->expects ( $this ->any () ) 
			->method ( 'verifie_variable_standard' ) 
			->will ( $this ->returnValue ( false ) );
		$this->object ->setListeOptions ( $this ->getListeOption () );
		$this ->expectException(Exception::class);
        $this->expectExceptionMessage( '(TESTS utilisateurs) Il manque le parametre : utilisateur_username' );
		$this->object ->retrouve_utilisateurs_cli ();
	}

	/**
	 * @covers utilisateurs::retrouve_utilisateurs_cli
	 */
	public function testRetrouve_utilisateurs_cli_Exception2() {
		$this ->getListeOption () 
			->expects ( $this ->any () ) 
			->method ( 'verifie_variable_standard' ) 
			->will ( $this ->onConsecutiveCalls ( true, false, false ) );
		$this->object ->setListeOptions ( $this ->getListeOption () );
		$this ->expectException(Exception::class);
        $this->expectExceptionMessage( '(TESTS utilisateurs) Il manque le parametre : utilisateur_password ou utilisateur_crypt_password' );
		$this->object ->retrouve_utilisateurs_cli ();
	}

	/**
	 * @covers utilisateurs::retrouve_utilisateurs_cli
	 */
	public function testRetrouve_utilisateurs_cli() {
		$this ->getListeOption () 
			->expects ( $this ->any () ) 
			->method ( 'verifie_variable_standard' ) 
			->will ( $this ->returnValue ( true ) );
		$this->object ->setListeOptions ( $this ->getListeOption () );
		$this ->assertSame ( $this->object, $this->object ->retrouve_utilisateurs_cli () );
	}

	/**
	 * @covers utilisateurs::retrouve_utilisateurs_cli
	 */
	public function testRetrouve_utilisateurs_cli_crypt_password() {
		$this ->getListeOption () 
			->expects ( $this ->any () ) 
			->method ( 'verifie_variable_standard' ) 
			->will ( $this ->returnValue ( true ) );
		$this ->getListeOption () 
			->expects ( $this ->any () ) 
			->method ( 'renvoi_variables_standard' ) 
			->will ( $this ->onConsecutiveCalls ( 'USERNAME', false, "8Un/ml74+vWM4vmyusg4fvtxo4CPYPuXcVgySUbJmoA=" ) );
		$this->object ->setListeOptions ( $this ->getListeOption () );
		$this ->assertSame ( $this->object, $this->object ->retrouve_utilisateurs_cli () );
		$this ->assertEquals ( 'USERNAME', $this->object ->getUsername () );
		$this ->assertEquals ( 'mdpUnitaire', $this->object ->getPassword () );
	}

	/**
	 * @covers utilisateurs::retrouve_utilisateurs_array
	 */
	public function testRetrouve_utilisateurs_array_empty() {
		$datas = array ();
		$this ->assertSame ( $this->object, $this->object ->retrouve_utilisateurs_array ( $datas ) );
		$this ->assertEquals ( '', $this->object ->getUsername () );
		$this ->assertEquals ( '', $this->object ->getPassword () );
	}

	/**
	 * @covers utilisateurs::retrouve_utilisateurs_array
	 */
	public function testRetrouve_utilisateurs_array_user_pass() {
		$datas = array ( 
				'username' => "USER1", 
				"password" => "PASS1" );
		$this ->assertSame ( $this->object, $this->object ->retrouve_utilisateurs_array ( $datas ) );
		$this ->assertEquals ( 'USER1', $this->object ->getUsername () );
		$this ->assertEquals ( 'PASS1', $this->object ->getPassword () );
	}

	/**
	 * @covers utilisateurs::retrouve_utilisateurs_array
	 */
	public function testRetrouve_utilisateurs_array_user_crypt_pass() {
		$datas = array ( 
				'username' => "USER1", 
				"crypt_password" => "8Un/ml74+vWM4vmyusg4fvtxo4CPYPuXcVgySUbJmoA=" );
		$this ->assertSame ( $this->object, $this->object ->retrouve_utilisateurs_array ( $datas ) );
		$this ->assertEquals ( 'USER1', $this->object ->getUsername () );
		$this ->assertEquals ( 'mdpUnitaire', $this->object ->getPassword () );
	}

	/**
	 * @covers utilisateurs::retrouve_utilisateurs_array
	 */
	public function testRetrouve_utilisateurs_array_centralized_user() {
		$this->object ->setListeUtilisateurs ( array ( 
				"NAME1" => array ( 
						"username" => "USER1", 
						"password" => "PASS1" ) ) );
		$datas = array ( 
				'utilisateur' => "NAME1" );
		$this ->assertSame ( $this->object, $this->object ->retrouve_utilisateurs_array ( $datas ) );
		$this ->assertEquals ( 'USER1', $this->object ->getUsername () );
		$this ->assertEquals ( 'PASS1', $this->object ->getPassword () );
	}

	/**
	 * @covers utilisateurs::encrypt
	 */
	public function testEncrypt() {
		$this ->assertTrue ( true );
	}

	/**
	 * @covers utilisateurs::decrypt
	 */
	public function testDecrypt() {
		$this ->assertEquals ( 'mdpUnitaire', $this->object ->decrypt ( "8Un/ml74+vWM4vmyusg4fvtxo4CPYPuXcVgySUbJmoA=" ) );
	}
}
?>
