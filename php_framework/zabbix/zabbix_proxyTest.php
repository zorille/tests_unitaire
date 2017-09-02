<?php
if (! defined ( '__DOCUMENT_ROOT__' )) {
	require_once $_SERVER ["PWD"] . '/prepare.php';
}

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2015-03-20 at 10:12:22.
 */
class zabbix_proxyTest extends MockedListeOptions {
	/**
     * @var zabbix_proxy
     */
	protected $object;

	/**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
	protected function setUp() {
		ob_start ();
		$zabbix_wsclient = $this ->createMock ( "zabbix_wsclient" );
		$zabbix_hosts_reference = $this ->createMock ( "zabbix_hosts" );
		$zabbix_proxy_interface_reference = $this ->createMock ( "zabbix_proxy_interface" );
		
		$this->object = new zabbix_proxy ( false, "zabbix_proxy" );
		$this->object ->setObjetZabbixWsclient ( $zabbix_wsclient ) 
			->setObjetInterface ( $zabbix_proxy_interface_reference ) 
			->setObjetHosts ( $zabbix_hosts_reference );
	}

	/**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
	protected function tearDown() {
		ob_end_clean ();
	}

	/**
     * @covers zabbix_proxy::retrouve_zabbix_param
     */
	public function testRetrouve_zabbix_param_Exception() {
		$this ->getListeOption () 
			->expects ( $this ->any () ) 
			->method ( 'verifie_variable_standard' ) 
			->will ( $this ->returnValue ( false ) );
		$this->object ->setListeOptions ( $this ->getListeOption () );
		
		$this ->expectException(Exception::class);
        $this->expectExceptionMessage( '(zabbix_proxy) Il manque le parametre : zabbix_proxy_name' );
		$this->object ->retrouve_zabbix_param ();
	}

	/**
	 * @covers zabbix_proxy::retrouve_zabbix_param
	 */
	public function testRetrouve_zabbix_param() {
		$this ->getListeOption () 
			->expects ( $this ->any () ) 
			->method ( 'verifie_variable_standard' ) 
			->will ( $this ->returnValue ( true ) );
		$this ->getListeOption () 
			->expects ( $this ->any () ) 
			->method ( 'renvoi_variables_standard' ) 
			->will ( $this ->onConsecutiveCalls ( "PROXY1", "passive" ) );
		$this->object ->setListeOptions ( $this ->getListeOption () );
		
		$this ->assertSame ( $this->object, $this->object ->retrouve_zabbix_param () );
		$this ->assertEquals ( "PROXY1", $this->object ->getProxy () );
	}

	/**
	 * @covers zabbix_proxy::creer_definition_proxy_create_ws
	 */
	public function testCreer_definition_proxy_create_ws() {
		$this->object ->setProxy ( "PROXY1" );
		$this->object ->setStatus ( 10 );
		$this->object ->getObjetInterface () 
			->expects ( $this ->any () ) 
			->method ( 'creer_definition_proxy_interface_ws' ) 
			->will ( $this ->returnValue ( "Interface" ) );
		$this->object ->getObjetHosts () 
			->expects ( $this ->any () ) 
			->method ( 'creer_definition_hostids_ws' ) 
			->will ( $this ->returnValue ( "HOST" ) );
		
		$this ->assertEquals ( array ( 
				"host" => "PROXY1", 
				"status" => 10, 
				"interface" => "Interface", 
				"hosts" => "HOST" ), $this->object ->creer_definition_proxy_create_ws () );
	}

	/**
	 * @covers zabbix_proxy::creer_proxy
	 */
	public function testCreer_proxy() {
		$this->object ->setProxy ( "PROXY1" );
		$this->object ->setStatus ( 10 );
		$this->object ->getObjetInterface () 
			->expects ( $this ->any () ) 
			->method ( 'creer_definition_proxy_interface_ws' ) 
			->will ( $this ->returnValue ( "Interface" ) );
		$this->object ->getObjetHosts () 
			->expects ( $this ->any () ) 
			->method ( 'creer_definition_hostids_ws' ) 
			->will ( $this ->returnValue ( "HOST" ) );
		
		$this->object ->getObjetZabbixWsclient () 
			->expects ( $this ->any () ) 
			->method ( 'proxyCreate' ) 
			->will ( $this ->returnValue ( array ( 
				"proxyid" => array ( 
						10 ) ) ) );
		
		$this ->assertEquals ( array ( 
				"proxyid" => array ( 
						10 ) ), $this->object ->creer_proxy () );
	}

	/**
	 * @covers zabbix_proxy::creer_definition_proxy_delete_ws
	 */
	public function testCreer_definition_proxy_delete_ws() {
		$this ->assertEquals ( array (), $this->object ->creer_definition_proxy_delete_ws () );
		$this->object ->setProxyId ( 10 );
		$this ->assertEquals ( array ( 
				10 ), $this->object ->creer_definition_proxy_delete_ws () );
	}

	/**
	 * @covers zabbix_proxy::supprime_proxy
	 */
	public function testSupprime_proxy() {
		$this->object ->getObjetZabbixWsclient () 
			->expects ( $this ->any () ) 
			->method ( 'proxyDelete' ) 
			->will ( $this ->returnValue ( array ( 
				"proxyids" => array ( 
						10 ) ) ) );
		
		$this->object ->getObjetZabbixWsclient () 
			->expects ( $this ->any () ) 
			->method ( 'proxyGet' ) 
			->will ( $this ->onConsecutiveCalls ( array (), array ( 
				array ( 
						"proxyid" => 10 ) ) ) );
		
		$this ->assertEquals ( array (), $this->object ->supprime_proxy () );
		$this ->assertEquals ( array ( 
				"proxyids" => array ( 
						10 ) ), $this->object ->supprime_proxy () );
	}

	/**
	 * @covers zabbix_proxy::creer_definition_proxy_get_ws
	 */
	public function testCreer_definition_proxy_get_ws() {
		$this->object ->setProxy ( "PROXY1" );
		$this ->assertEquals ( array ( 
				"output" => "proxyid", 
				"filter" => array ( 
						"host" => "PROXY1" ) ), $this->object ->creer_definition_proxy_get_ws () );
	}

	/**
	 * @covers zabbix_proxy::recherche_proxy
	 */
	public function testRecherche_proxy() {
		$this->object ->getObjetZabbixWsclient () 
			->expects ( $this ->any () ) 
			->method ( 'proxyGet' ) 
			->will ( $this ->returnValue ( array ( 
				"proxyids" => array ( 
						"proxyid" => 10 ) ) ) );
		
		$this ->assertEquals ( array ( 
				"proxyids" => array ( 
						"proxyid" => 10 ) ), $this->object ->recherche_proxy () );
	}

	/**
     * @covers zabbix_proxy::retrouve_Status
     */
	public function testRetrouve_Status() {
		$this ->assertEquals ( 5, $this->object ->retrouve_Status ( "" ) );
		$this ->assertEquals ( 5, $this->object ->retrouve_Status ( "active" ) );
		$this ->assertEquals ( 6, $this->object ->retrouve_Status ( "passive" ) );
		$this ->assertEquals ( 10, $this->object ->retrouve_Status ( 10 ) );
	}
}