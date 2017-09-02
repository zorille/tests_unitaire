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
class zabbix_datasTest extends MockedListeOptions {
	/**
     * @var zabbix_datas
     */
	protected $object;

	/**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
	protected function setUp() {
		ob_start ();
		
		$utilisateurs = $this->createMock ( "utilisateurs" );
		$utilisateurs->expects ( $this->any () )
			->method ( 'retrouve_utilisateurs_array' )
			->will ( $this->returnValue ( $utilisateurs ) );
		$utilisateurs->expects ( $this->any () )
			->method ( 'getUsername' )
			->will ( $this->returnValue ( 'USER1' ) );
		$utilisateurs->expects ( $this->any () )
			->method ( 'getPassword' )
			->will ( $this->returnValue ( 'PASS1' ) );
		
		$this->object = new zabbix_datas ( false,"zabbix_datas" );
		$this->object->setListeOptions ( $this->getListeOption () )
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
	 * @covers zabbix_datas::retrouve_zabbix_param
	 */
	public function testRetrouve_zabbix_param_exception() {
		$this->object->getListeOptions ()
			->expects ( $this->at ( 0 ) )
			->method ( 'verifie_variable_standard' )
			->will ( $this->returnValue ( false ) );
		
		$this ->expectException(Exception::class);
        $this->expectExceptionMessage( '(zabbix_datas) Il manque le parametre : zabbix_machines_serveur' );
		$this->object->retrouve_zabbix_param ();
	}
	
	/**
	 * @covers zabbix_datas::retrouve_zabbix_param
	 */
	public function testRetrouve_zabbix_param() {
		$this->object->getListeOptions ()
		->expects ( $this->at ( 0 ) )
		->method ( 'verifie_variable_standard' )
		->will ( $this->returnValue ( true ) );
		$this->object->getListeOptions ()
		->expects ( $this->any () )
		->method ( 'renvoi_variables_standard' )
		->will ( $this->returnValue ( array (
				"#comment" => "et voila un commentaire",
				"nom" => "SIS_TEST"
		) ) );
		$this->assertInstanceOf ( 'zabbix_datas', $this->object->retrouve_zabbix_param () );
	}

	/**
	 * @covers zabbix_datas::valide_presence_zabbix_data
	 */
	public function testvalide_presence_zabbix_data() {
		$this->object->setServeurData ( array (
				"TEST" => array (
						"nom" => "NOMMACHINE" 
				),
				"TEST2" => array (
						"nom" => "NOMMACHINE2" 
				) 
		) );
		$this->assertEquals ( array (
				"nom" => "NOMMACHINE",
				'username' => 'USER1',
				'password' => 'PASS1' 
		), $this->object->valide_presence_zabbix_data ( "NOMMACHINE" ) );
		$this->assertEquals ( array (
				"nom" => "NOMMACHINE2",
				'username' => 'USER1',
				'password' => 'PASS1' 
		), $this->object->valide_presence_zabbix_data ( "NOMMACHINE2" ) );
		$this->assertFalse ( $this->object->valide_presence_zabbix_data ( "NOMMACHINE3" ) );
	}
}
?>
