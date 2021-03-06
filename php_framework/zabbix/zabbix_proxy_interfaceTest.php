<?php
namespace Zorille\framework;
if (! defined ( '__DOCUMENT_ROOT__' )) {
	require_once $_SERVER ["PWD"] . '/prepare.php';
}

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2014-08-25 at 16:53:15.
 */
class zabbix_proxy_interfaceTest extends MockedListeOptions {
	/**
     * @var zabbix_proxy_interface
     */
	protected $object;

	/**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
	protected function setUp() {
		ob_start ();
		
		$this->object = new zabbix_proxy_interface ( false, "TESTS zabbix PROXY" );
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
	 * @covers Zorille\framework\zabbix_proxy_interface::retrouve_zabbix_param
	 */
	public function testRetrouve_zabbix_param() {
		$this ->getListeOption () 
			->expects ( $this ->any () ) 
			->method ( 'verifie_variable_standard' ) 
			->will ( $this ->returnValue ( true ) );
		$this ->getListeOption () 
			->expects ( $this ->any () ) 
			->method ( 'renvoi_variables_standard' ) 
			->will ( $this ->returnValue ( 'test' ) );
		$this->object ->setListeOptions ( $this ->getListeOption () );
		
		$this ->assertSame ( $this->object, $this->object ->retrouve_zabbix_param () );
		$this ->assertSame ( 'test', $this->object ->getPort () );
	}

	/**
     * @covers Zorille\framework\zabbix_proxy_interface::creer_definition_proxy_interface_ws
     */
	public function testCreer_definition_proxy_interface_ws() {
		$this->object ->setUseIp ( "oui" );
		$this->object ->setIP ( "IP1" );
		$this->object ->setFQDN ( "FQDN1" );
		$this->object ->setPort ( "Port1" );
		$this ->assertEquals ( array ( 
				"useip" => 0, 
				"ip" => "IP1", 
				"dns" => "FQDN1", 
				"port" => "Port1" ), $this->object ->creer_definition_proxy_interface_ws () );
		
		$this->object ->setInterfaceId ( "IT1" );
		$this->object ->setHostId ( "H1" );
		
		$this ->assertEquals ( array ( 
				"useip" => 0, 
				"ip" => "IP1", 
				"dns" => "FQDN1", 
				"port" => "Port1", 
				"interfaceid" => "IT1", 
				"hostid" => "H1" ), $this->object ->creer_definition_proxy_interface_ws () );
	}
}
