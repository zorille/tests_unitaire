<?php
/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2015-05-18 at 14:42:26.
 */
if (! defined ( '__DOCUMENT_ROOT__' )) {
	require_once $_SERVER ["PWD"] . '/prepare.php';
}
class hpom_datasTest extends MockedListeOptions {
	/**
     * @var hpom_datas
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
		$soap = $this ->createMock ( "soap" );
		
		$this->object = new hpom_datas ( false, "TESTS hpom_datas" );
		$this->object ->setSoapConnection ( $soap ) 
			->setListeOptions ( $this ->getListeOption () ) 
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
	 * @covers hpom_datas::retrouve_hpom_param
	 */
	public function testRetrouve_hpom_param_Exception() {
		$this->object ->getListeOptions () 
			->expects ( $this ->at ( 0 ) ) 
			->method ( 'verifie_variable_standard' ) 
			->will ( $this ->returnValue ( false ) );
		
		$this ->expectException(Exception::class);
        $this->expectExceptionMessage( '(TESTS hpom_datas) Il manque les parametres clients hpom.' );
		$this->object ->retrouve_hpom_param ();
	}

	/**
	 * @covers hpom_datas::retrouve_hpom_param
	 */
	public function testRetrouve_hpom_param_Exception2() {
		$this->object ->getListeOptions () 
			->expects ( $this ->at ( 0 ) ) 
			->method ( 'verifie_variable_standard' ) 
			->will ( $this ->returnValue ( true ) );
		$this->object ->getListeOptions () 
			->expects ( $this ->any () ) 
			->method ( 'renvoi_variables_standard' ) 
			->will ( $this ->returnValue ( array ( 
				"#comment" => "et voila un commentaire", 
				"nom" => "HPOM_TEST" ) ) );
		$this->object ->getListeOptions () 
			->expects ( $this ->at ( 2 ) ) 
			->method ( 'verifie_variable_standard' ) 
			->will ( $this ->returnValue ( false ) );
		
		$this ->expectException(Exception::class);
        $this->expectExceptionMessage( '(TESTS hpom_datas) Il manque les parametres WSDL pour hpom.' );
		$this->object ->retrouve_hpom_param ();
	}

	/**
	 * @covers hpom_datas::retrouve_hpom_param
	 */
	public function testRetrouve_hpom_param() {
		$this->object ->getListeOptions () 
			->expects ( $this ->at ( 0 ) ) 
			->method ( 'verifie_variable_standard' ) 
			->will ( $this ->returnValue ( true ) );
		$this->object ->getListeOptions () 
			->expects ( $this ->any () ) 
			->method ( 'renvoi_variables_standard' ) 
			->will ( $this ->returnValue ( array ( 
				"#comment" => "et voila un commentaire", 
				"nom" => "HPOM_TEST" ) ) );
		$this->object ->getListeOptions () 
			->expects ( $this ->at ( 2 ) ) 
			->method ( 'verifie_variable_standard' ) 
			->will ( $this ->returnValue ( true ) );
		$this ->assertInstanceOf ( 'hpom_datas', $this->object ->retrouve_hpom_param () );
	}

	/**
	 * @covers hpom_datas::valide_presence_hpom_data
	 */
	public function testValide_presence_hpom_data() {
		$this->object ->setServeurData ( array ( 
				"hpom_name_test" => array ( 
						"nom" => "HPOM_TEST" ) ) );
		
		$this ->assertFalse ( $this->object ->valide_presence_hpom_data ( "NO_HPOM" ) );
		$this ->assertEquals ( array ( 
				"nom" => "HPOM_TEST", 
				'username' => 'USER1', 
				'password' => 'PASS1' ), $this->object ->valide_presence_hpom_data ( "HPOM_TEST" ) );
	}

	/**
	 * @covers hpom_datas::connexion
	 */
	public function testConnexion_Exception() {
		$this->object ->setServeurData ( array ( 
				"hpom_name_test" => array ( 
						"nom" => "HPOM_TEST" ) ) );
		
		$this ->expectException(Exception::class);
        $this->expectExceptionMessage( '(TESTS hpom_datas) Il faut un nom de hpom pour se connecter.' );
		$this->object ->connexion ( "", "" );
	}

	/**
	 * @covers hpom_datas::connexion
	 */
	public function testConnexion_Exception2() {
		$this->object ->setServeurData ( array ( 
				"hpom_name_test" => array ( 
						"nom" => "HPOM_TEST" ) ) );
		
		$this ->expectException(Exception::class);
        $this->expectExceptionMessage( '(TESTS hpom_datas) Il faut un wsdl de hpom pour se connecter.' );
		$this->object ->connexion ( "HPOM_TEST", "" );
	}

	/**
	 * @covers hpom_datas::connexion
	 */
	public function testConnexion_Exception3() {
		$this->object ->setServeurData ( array ( 
				"hpom_name_test" => array ( 
						"nom" => "HPOM_TEST" ) ) );
		
		$this ->expectException(Exception::class);
        $this->expectExceptionMessage( '(TESTS hpom_datas) Ce wsdl WSDL_TEST n\'existe pas.' );
		$this->object ->connexion ( "HPOM_TEST", "WSDL_TEST" );
	}

	/**
	 * @covers hpom_datas::connexion
	 */
	public function testConnexion_False() {
		$this->object ->getSoapConnection () 
			->expects ( $this ->any () ) 
			->method ( 'setCacheWsdl' ) 
			->will ( $this ->returnSelf () );
		$this->object ->getSoapConnection () 
			->expects ( $this ->any () ) 
			->method ( 'retrouve_variables_tableau' ) 
			->will ( $this ->returnSelf () );
		$this->object ->getSoapConnection () 
			->expects ( $this ->any () ) 
			->method ( 'connect' ) 
			->will ( $this ->returnValue ( true ) );
		
		$this ->assertFalse ( $this->object ->connexion ( "HPOM_TEST", "WSDL_TEST" ) );
	}

	/**
	 * @covers hpom_datas::connexion
	 */
	public function testConnexion() {
		$this->object ->setServeurData ( array ( 
				"hpom_name_test" => array ( 
						"nom" => "HPOM_TEST" ) ) );
		$this->object ->setWsdlData ( array ( 
				"WSDL_TEST" => "WSDL" ) );
		
		$this->object ->getSoapConnection () 
			->expects ( $this ->any () ) 
			->method ( 'setSoapVersion' ) 
			->will ( $this ->returnSelf () );
		$this->object ->getSoapConnection () 
			->expects ( $this ->any () ) 
			->method ( 'setCacheWsdl' ) 
			->will ( $this ->returnSelf () );
		$this->object ->getSoapConnection () 
			->expects ( $this ->any () ) 
			->method ( 'retrouve_variables_tableau' ) 
			->will ( $this ->returnSelf () );
		$this->object ->getSoapConnection () 
			->expects ( $this ->any () ) 
			->method ( 'connect' ) 
			->will ( $this ->returnValue ( true ) );
		
		$this ->assertTrue ( $this->object ->connexion ( "HPOM_TEST", "WSDL_TEST" ) );
	}
}