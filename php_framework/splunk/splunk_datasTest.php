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
class splunk_datasTest extends MockedListeOptions {
	/**
     * @var splunk_datas
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
		
		$this->object = new splunk_datas ( false, "splunk_datas" );
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
	 * @covers splunk_datas::retrouve_splunk_param
	 */
	public function testRetrouve_splunk_param_exception() {
		$this->object ->getListeOptions () 
			->expects ( $this ->at ( 0 ) ) 
			->method ( 'verifie_variable_standard' ) 
			->will ( $this ->returnValue ( false ) );
		
		$this ->expectException(Exception::class);
        $this->expectExceptionMessage( '(splunk_datas) Il manque le parametre : splunk_machines_serveur' );
		$this->object ->retrouve_splunk_param ();
	}

	/**
	 * @covers splunk_datas::retrouve_splunk_param
	 */
	public function testRetrouve_splunk_param() {
		$this->object ->getListeOptions () 
			->expects ( $this ->at ( 0 ) ) 
			->method ( 'verifie_variable_standard' ) 
			->will ( $this ->returnValue ( true ) );
		$this->object ->getListeOptions () 
			->expects ( $this ->any () ) 
			->method ( 'renvoi_variables_standard' ) 
			->will ( $this ->returnValue ( array ( 
				"#comment" => "et voila un commentaire", 
				"nom" => "SIS_TEST" ) ) );
		$this ->assertSame ( $this->object, $this->object ->retrouve_splunk_param () );
	}

	/**
	 * @covers splunk_datas::valide_presence_splunk_data
	 */
	public function testvalide_presence_splunk_data() {
		$this->object ->setServeurData ( array ( 
				"TEST" => array ( 
						"nom" => "NOMMACHINE" ), 
				"TEST2" => array ( 
						"nom" => "NOMMACHINE2" ) ) );
		$this ->assertEquals ( array ( 
				"nom" => "NOMMACHINE", 
				'username' => 'USER1', 
				'password' => 'PASS1' ), $this->object ->valide_presence_splunk_data ( "NOMMACHINE" ) );
		$this ->assertEquals ( array ( 
				"nom" => "NOMMACHINE2", 
				'username' => 'USER1', 
				'password' => 'PASS1' ), $this->object ->valide_presence_splunk_data ( "NOMMACHINE2" ) );
		$this ->assertFalse ( $this->object ->valide_presence_splunk_data ( "NOMMACHINE3" ) );
	}
}
?>
