<?php
namespace Zorille\framework;
use \Exception as Exception;
if (! defined ( '__DOCUMENT_ROOT__' )) {
	require_once $_SERVER ["PWD"] . '/prepare.php';
}

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2014-08-25 at 16:53:15.
 */
class zabbix_host_interfaceTest extends MockedListeOptions {
	/**
     * @var zabbix_host_interface
     */
	protected $object;

	/**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
	protected function setUp() {
		ob_start ();
		
		$this->object = new zabbix_host_interface ( false, "TESTS zabbix HOST" );
		$this->object ->setListeOptions ( $this ->getListeOption () );
	}

	/**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
	protected function tearDown() {
		ob_end_clean ();
	}

	/**
	 * @covers Zorille\framework\zabbix_host_interface::retrouve_zabbix_param
	 */
	public function testRetrouve_zabbix_param_Exception1() {
		$this ->getListeOption () 
			->expects ( $this ->any () ) 
			->method ( 'verifie_variable_standard' ) 
			->will ( $this ->returnValue ( true ) );
		$this ->getListeOption () 
			->expects ( $this ->any () ) 
			->method ( 'renvoi_variables_standard' ) 
			->will ( $this ->returnValue ( 'val1' ) );
		$this->object ->setListeOptions ( $this ->getListeOption () );
		
		$interface = false;
		$this ->expectException(Exception::class);
        $this->expectExceptionMessage( '(TESTS zabbix HOST) Parametre inutilisable : ' );
		$this->object ->retrouve_zabbix_param ( $interface );
	}

	/**
	 * @covers Zorille\framework\zabbix_host_interface::retrouve_zabbix_param
	 */
	public function testRetrouve_zabbix_param_Exception2() {
		$this ->getListeOption () 
			->expects ( $this ->any () ) 
			->method ( 'verifie_variable_standard' ) 
			->will ( $this ->returnValue ( true ) );
		$this ->getListeOption () 
			->expects ( $this ->any () ) 
			->method ( 'renvoi_variables_standard' ) 
			->will ( $this ->returnValue ( '' ) );
		$this->object ->setListeOptions ( $this ->getListeOption () );
		
		$interface = false;
		$this ->expectException(Exception::class);
        $this->expectExceptionMessage( '(TESTS zabbix HOST) Il faut une IP ou un FQDN pour travailler.' );
		$this->object ->retrouve_zabbix_param ( $interface );
	}

	/**
	 * @covers Zorille\framework\zabbix_host_interface::retrouve_zabbix_param
	 */
	public function testRetrouve_zabbix_param_Exception3() {
		$this ->getListeOption () 
			->expects ( $this ->any () ) 
			->method ( 'verifie_variable_standard' ) 
			->will ( $this ->returnValue ( true ) );
		$this ->getListeOption () 
			->expects ( $this ->any () ) 
			->method ( 'renvoi_variables_standard' ) 
			->will ( $this ->onconsecutiveCalls ( 'IP', 'FQDN', '' ) );
		$this->object ->setListeOptions ( $this ->getListeOption () );
		
		$interface = false;
		$this ->expectException(Exception::class);
        $this->expectExceptionMessage( '(TESTS zabbix HOST) Il n\'y a pas resolv_fqdn defini pour travailler' );
		$this->object ->retrouve_zabbix_param ( $interface );
	}

	/**
	 * @covers Zorille\framework\zabbix_host_interface::retrouve_zabbix_param
	 */
	public function testRetrouve_zabbix_param_Exception4() {
		$this ->getListeOption () 
			->expects ( $this ->any () ) 
			->method ( 'verifie_variable_standard' ) 
			->will ( $this ->returnValue ( true ) );
		$this ->getListeOption () 
			->expects ( $this ->any () ) 
			->method ( 'renvoi_variables_standard' ) 
			->will ( $this ->onconsecutiveCalls ( 'IP', '', 'IP' ) );
		$this->object ->setListeOptions ( $this ->getListeOption () );
		
		$interface = false;
		$this ->expectException(Exception::class);
        $this->expectExceptionMessage( '(TESTS zabbix HOST) Parametre inutilisable : ' );
		$this->object ->retrouve_zabbix_param ( $interface );
	}

	/**
	 * @covers Zorille\framework\zabbix_host_interface::retrouve_zabbix_param
	 */
	public function testRetrouve_zabbix_param_Exception5() {
		$this ->getListeOption () 
			->expects ( $this ->any () ) 
			->method ( 'verifie_variable_standard' ) 
			->will ( $this ->returnValue ( true ) );
		$this ->getListeOption () 
			->expects ( $this ->any () ) 
			->method ( 'renvoi_variables_standard' ) 
			->will ( $this ->onconsecutiveCalls ( '', 'FQDN', 'FQDN' ) );
		$this->object ->setListeOptions ( $this ->getListeOption () );
		
		$interface = false;
		$this ->expectException(Exception::class);
        $this->expectExceptionMessage( '(TESTS zabbix HOST) Parametre inutilisable : ' );
		$this->object ->retrouve_zabbix_param ( $interface );
	}

	/**
	 * @covers Zorille\framework\zabbix_host_interface::retrouve_zabbix_param
	 */
	public function testRetrouve_zabbix_param() {
		$interface = 'agent|oui|10050';
		$this ->assertSame ( $this->object, $this->object ->retrouve_zabbix_param ( $interface ) );
	}

	/**
	 * @covers Zorille\framework\zabbix_host_interface::compare_interface
	 */
	public function testCompare_interface() {
		$this->object ->creer_une_interface ( "USEIP", "IP", "FQDN" );
		$this->object ->setType ( "TYPE" );
		$this->object ->setMain ( "MAIN" );
		$this->object ->setPort ( "PORT1" );
		$objet_test = clone $this->object;
		$this ->assertTrue ( $this->object ->compare_interface ( $objet_test ) );
		$objet_test ->setType ( "SNMP" );
		$this ->assertFalse ( $this->object ->compare_interface ( $objet_test ) );
		$objet_test ->setType ( "TYPE" );
		$objet_test ->setMain ( "non" );
		$this ->assertFalse ( $this->object ->compare_interface ( $objet_test ) );
		$objet_test ->setMain ( "MAIN" );
		$objet_test ->setIP ( "IP2" );
		$this ->assertFalse ( $this->object ->compare_interface ( $objet_test ) );
		$objet_test ->setIP ( "IP" );
		$objet_test ->setFQDN ( "FQDN2" );
		$this ->assertFalse ( $this->object ->compare_interface ( $objet_test ) );
		$objet_test ->setFQDN ( "FQDN" );
		$objet_test ->setPort ( "PORT2" );
		$this ->assertFalse ( $this->object ->compare_interface ( $objet_test ) );
	}

	/**
	 * @covers Zorille\framework\zabbix_host_interface::retrouve_code_interface
	 */
	public function testRetrouve_code_interface() {
		$this ->assertEquals ( 1, $this->object ->retrouve_code_interface ( "" ) );
		$this ->assertEquals ( 1, $this->object ->retrouve_code_interface ( "agent" ) );
		$this ->assertEquals ( 2, $this->object ->retrouve_code_interface ( "SNMP" ) );
		$this ->assertEquals ( 3, $this->object ->retrouve_code_interface ( "ipmi" ) );
		$this ->assertEquals ( 4, $this->object ->retrouve_code_interface ( "jmx" ) );
		$this ->assertEquals ( 10, $this->object ->retrouve_code_interface ( 10 ) );
	}

	/**
	 * @covers Zorille\framework\zabbix_host_interface::retrouve_main
	 */
	public function testRetrouve_main() {
		$this ->assertEquals ( 1, $this->object ->retrouve_main ( "" ) );
		$this ->assertEquals ( 1, $this->object ->retrouve_main ( "oui" ) );
		$this ->assertEquals ( 0, $this->object ->retrouve_main ( "non" ) );
		$this ->assertEquals ( 10, $this->object ->retrouve_main ( 10 ) );
	}

	/**
     * @covers Zorille\framework\zabbix_host_interface::creer_definition_host_interface_ws
     */
	public function testCreer_definition_host_interface_ws() {
		$this->object ->setType ( "agent" );
		$this->object ->setMain ( "oui" );
		$this->object ->setUseIp ( "oui" );
		$this->object ->setIP ( "IP1" );
		$this->object ->setFQDN ( "FQDN1" );
		$this->object ->setPort ( "Port1" );
		$this ->assertEquals ( array ( 
				"type" => 1, 
				"main" => 1, 
				"useip" => 0, 
				"ip" => "IP1", 
				"dns" => "FQDN1", 
				"port" => "Port1" ), $this->object ->creer_definition_host_interface_ws ( true ) );
		
		$this->object ->setInterfaceId ( "IT1" );
		$this->object ->setHostId ( "H1" );
		
		$this ->assertEquals ( array ( 
				"type" => 1, 
				"main" => 1, 
				"useip" => 0, 
				"ip" => "IP1", 
				"dns" => "FQDN1", 
				"port" => "Port1", 
				"interfaceid" => "IT1", 
				"hostid" => "H1" ), $this->object ->creer_definition_host_interface_ws ( false ) );
	}
}
