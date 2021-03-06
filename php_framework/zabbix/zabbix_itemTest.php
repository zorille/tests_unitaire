<?php
namespace Zorille\framework;
use \Exception as Exception;
if (! defined ( '__DOCUMENT_ROOT__' )) {
	require_once $_SERVER ["PWD"] . '/prepare.php';
}

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2014-08-25 at 16:53:15.
 */
class zabbix_itemTest extends MockedListeOptions {
	/**
     * @var zabbix_item
     */
	protected $object;

	/**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
	protected function setUp() {
		ob_start ();
		
		$zabbix_wsclient = $this ->createMock('Zorille\framework\zabbix_wsclient' );
		
		$this->object = new zabbix_item ( false, "TESTS zabbix HOST" );
		$this->object ->setListeOptions ( $this ->getListeOption () ) 
			->setObjetZabbixWsclient ( $zabbix_wsclient );
	}

	/**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
	protected function tearDown() {
		ob_end_clean ();
	}

	/**
	 * @covers Zorille\framework\zabbix_item::retrouve_zabbix_param
	 */
	public function testRetrouve_zabbix_param_Exception() {
		$this ->getListeOption () 
			->expects ( $this ->any () ) 
			->method ( 'verifie_variable_standard' ) 
			->will ( $this ->returnValue ( false ) );
		$this->object ->setListeOptions ( $this ->getListeOption () );
		
		$this ->expectException(Exception::class);
        $this->expectExceptionMessage( '(TESTS zabbix HOST) Il manque le parametre : zabbix_item_name' );
		$this->object ->retrouve_zabbix_param ();
		
		$this ->assertEquals ( "", $this->object ->getName () );
	}

	/**
	 * @covers Zorille\framework\zabbix_item::retrouve_zabbix_param
	 */
	public function testRetrouve_zabbix_param() {
		$this ->getListeOption () 
			->expects ( $this ->any () ) 
			->method ( 'verifie_variable_standard' ) 
			->will ( $this ->returnValue ( true ) );
		$this ->getListeOption () 
			->expects ( $this ->any () ) 
			->method ( 'renvoi_variables_standard' ) 
			->will ( $this ->returnValue ( 'val1' ) );
		$this->object ->setListeOptions ( $this ->getListeOption () );
		
		$this ->assertSame ( $this->object, $this->object ->retrouve_zabbix_param () );
		$this ->assertEquals ( "val1", $this->object ->getName () );
	}

	/**
	 * @covers Zorille\framework\zabbix_item::inserer_ws_item
	 */
	public function testinserer_ws_item() {
		$liste = array ( 
				'name' => 'NOM1' );
		$this ->assertSame ( $this->object, $this->object ->inserer_ws_item ( $liste ) );
		$this ->assertEquals ( "NOM1", $this->object ->getName () );
	}

	/**
	 * @covers Zorille\framework\zabbix_item::creer_definition_item_ws
	 */
	public function testcreer_definition_item_ws() {
		$this ->assertEquals ( 
				array ( 
							"delay" => "", 
							"hostId" => "", 
							"interfaceid" => "", 
							"key_" => "", 
							"name" => "", 
							"type" => "0", 
							"value_type" => "0", 
							"authtype" => "0", 
							"data_type" => "0", 
							"delay_flex" => "0", 
							"delta" => "0", 
							"description" => "", 
							"formula" => "1", 
							"history" => "90", 
							"inventory_link" => "", 
							"ipmi_sensor" => "", 
							"logtimefmt" => "", 
							"mtime" => "", 
							"multiplier" => "", 
							"params" => "", 
							"password" => "", 
							"port" => "", 
							"privatekey" => "", 
							"publickey" => "", 
							"snmp_community" => "", 
							"snmp_oid" => "", 
							"snmpv3_authpassphrase" => "", 
							"snmpv3_authprotocol" => "", 
							"snmpv3_contextname" => "", 
							"snmpv3_privpassphrase" => "", 
							"snmpv3_privprotocol" => "0", 
							"snmpv3_securitylevel" => "", 
							"snmpv3_securityname" => "", 
							"state" => "0", 
							"status" => "0", 
							"trapper_hosts" => "", 
							"trends" => "365", 
							"units" => "", 
							"username" => "", 
							"valuemapid" => "", 
							"applications" => array () ), 
					$this->object ->creer_definition_item_ws () );
	}

	/**
		 * @covers Zorille\framework\zabbix_item::creer_item
		 */
	public function testcreer_item() {
		$this->object ->getObjetZabbixWsclient () 
			->expects ( $this ->any () ) 
			->method ( 'itemCreate' ) 
			->will ( $this ->returnValue ( array ( 
				"itemids" => array ( 
						1 ) ) ) );
		$this->object ->setName ( "NOM1" );
		
		$this ->assertEquals ( array ( 
				"itemids" => array ( 
						1 ) ), $this->object ->creer_item () );
	}

	/**
		 * @covers Zorille\framework\zabbix_item::creer_definition_item_delete_ws
		 */
	public function testcreer_definition_item_delete_ws() {
		$this ->assertEquals ( array (), $this->object ->creer_definition_item_delete_ws () );
		$this->object ->setItemId ( 10 );
		$this ->assertEquals ( array ( 
				10 ), $this->object ->creer_definition_item_delete_ws () );
	}

	/**
		 * @covers Zorille\framework\zabbix_item::supprime_item
		 */
	public function testsupprime_item() {
		$this->object ->getObjetZabbixWsclient () 
			->expects ( $this ->any () ) 
			->method ( 'itemDelete' ) 
			->will ( $this ->returnValue ( array ( 
				"itemids" => array ( 
						10 ) ) ) );
		$this ->assertEquals ( array (), $this->object ->supprime_item () );
		
		$this->object ->setItemId ( 10 );
		$this ->assertEquals ( array ( 
				"itemids" => array ( 
						10 ) ), $this->object ->supprime_item () );
	}

	/**
		 * @covers Zorille\framework\zabbix_item::creer_definition_itemByName_get_ws
		 */
	public function testcreer_definition_itemByName_get_ws() {
		$this->object ->setName ( "TEST" );
		$this ->assertEquals ( array ( 
				"output" => "extend", 
				"filter" => array ( 
						"name" => "TEST" ) ), $this->object ->creer_definition_itemByName_get_ws () );
	}

	/**
		 * @covers Zorille\framework\zabbix_item::recherche_itemid_by_Name
		 */
	public function testrecherche_itemid_by_Name() {
		$this->object ->setName ( "TEST" );
		$this->object ->getObjetZabbixWsclient () 
			->expects ( $this ->any () ) 
			->method ( 'itemGet' ) 
			->will ( $this ->returnValue ( array ( 
				0 => array ( 
						"itemid" => 10 ) ) ) );
		$this ->assertSame ( $this->object, $this->object ->recherche_itemid_by_Name () );
	}

	/**
		 * @covers Zorille\framework\zabbix_item::recherche_donnees_by_Name
		 */
	public function testrecherche_donnees_by_Name() {
		$this->object ->setName ( "TEST" );
		$this->object ->getObjetZabbixWsclient () 
			->expects ( $this ->any () ) 
			->method ( 'itemGet' ) 
			->will ( $this ->returnValue ( array ( 
				0 => array ( 
						"itemid" => 10 ) ) ) );
		$this ->assertEquals ( array ( 
				0 => array ( 
						"itemid" => 10 ) ), $this->object ->recherche_donnees_by_Name () );
	}

	/**
	 * @covers Zorille\framework\zabbix_item::compare_item
	 */
	public function testcompare_item() {
		$this->object ->setName ( "NAME1" );
		$objet_test = clone $this->object;
		$this ->assertTrue ( $this->object ->compare_item ( $objet_test ) );
		$this->object ->setItemId ( 10 );
		$this ->assertTrue ( $this->object ->compare_item ( $objet_test ) );
		$objet_test ->setItemId ( 11 );
		$this ->assertFalse ( $this->object ->compare_item ( $objet_test ) );
		$objet_test ->setItemId ( 10 );
		$objet_test ->setName ( "NAME2" );
		$this ->assertFalse ( $this->object ->compare_item ( $objet_test ) );
	}

	/**
	 * @covers Zorille\framework\zabbix_item::retrouve_Type
	 */
	public function testretrouve_Type() {
		$this ->assertEquals ( 0, $this->object ->retrouve_Type ( "" ) );
		$this ->assertEquals ( 0, $this->object ->retrouve_Type ( "Zabbix agent" ) );
		$this ->assertEquals ( 1, $this->object ->retrouve_Type ( "SNMPv1 agent" ) );
		$this ->assertEquals ( 2, $this->object ->retrouve_Type ( "Zabbix trapper" ) );
		$this ->assertEquals ( 3, $this->object ->retrouve_Type ( "simple check" ) );
		$this ->assertEquals ( 4, $this->object ->retrouve_Type ( "SNMPv2 agent" ) );
		$this ->assertEquals ( 5, $this->object ->retrouve_Type ( "Zabbix internal" ) );
		$this ->assertEquals ( 6, $this->object ->retrouve_Type ( "SNMPv3 agent" ) );
		$this ->assertEquals ( 7, $this->object ->retrouve_Type ( "Zabbix agent (active)" ) );
		$this ->assertEquals ( 8, $this->object ->retrouve_Type ( "Zabbix aggregate" ) );
		$this ->assertEquals ( 9, $this->object ->retrouve_Type ( "web item" ) );
		$this ->assertEquals ( 10, $this->object ->retrouve_Type ( "external check" ) );
		$this ->assertEquals ( 11, $this->object ->retrouve_Type ( "database monitor" ) );
		$this ->assertEquals ( 12, $this->object ->retrouve_Type ( "IPMI agent" ) );
		$this ->assertEquals ( 13, $this->object ->retrouve_Type ( "SSH agent" ) );
		$this ->assertEquals ( 14, $this->object ->retrouve_Type ( "TELNET agent" ) );
		$this ->assertEquals ( 15, $this->object ->retrouve_Type ( "calculated" ) );
		$this ->assertEquals ( 16, $this->object ->retrouve_Type ( "JMX agent" ) );
		$this ->assertEquals ( 17, $this->object ->retrouve_Type ( "SNMP trap" ) );
		$this ->assertEquals ( 10, $this->object ->retrouve_Type ( 10 ) );
	}

	/**
	 * @covers Zorille\framework\zabbix_item::retrouve_ValueType
	 */
	public function testretrouve_ValueType() {
		$this ->assertEquals ( 0, $this->object ->retrouve_ValueType ( "" ) );
		$this ->assertEquals ( 0, $this->object ->retrouve_ValueType ( "numeric float" ) );
		$this ->assertEquals ( 1, $this->object ->retrouve_ValueType ( "character" ) );
		$this ->assertEquals ( 2, $this->object ->retrouve_ValueType ( "log" ) );
		$this ->assertEquals ( 3, $this->object ->retrouve_ValueType ( "numeric unsigned" ) );
		$this ->assertEquals ( 4, $this->object ->retrouve_ValueType ( "text" ) );
		$this ->assertEquals ( 10, $this->object ->retrouve_ValueType ( 10 ) );
	}

	/**
	 * @covers Zorille\framework\zabbix_item::retrouve_Authtype
	 */
	public function testretrouve_Authtype() {
		$this ->assertEquals ( 0, $this->object ->retrouve_Authtype ( "" ) );
		$this ->assertEquals ( 0, $this->object ->retrouve_Authtype ( "password" ) );
		$this ->assertEquals ( 1, $this->object ->retrouve_Authtype ( "public key" ) );
		$this ->assertEquals ( 10, $this->object ->retrouve_Authtype ( 10 ) );
	}

	/**
	 * @covers Zorille\framework\zabbix_item::retrouve_DataType
	 */
	public function testretrouve_DataType() {
		$this ->assertEquals ( 0, $this->object ->retrouve_DataType ( "" ) );
		$this ->assertEquals ( 0, $this->object ->retrouve_DataType ( "decimal" ) );
		$this ->assertEquals ( 1, $this->object ->retrouve_DataType ( "octal" ) );
		$this ->assertEquals ( 2, $this->object ->retrouve_DataType ( "hexadecimal" ) );
		$this ->assertEquals ( 3, $this->object ->retrouve_DataType ( "boolean" ) );
		$this ->assertEquals ( 10, $this->object ->retrouve_DataType ( 10 ) );
	}

	/**
	 * @covers Zorille\framework\zabbix_item::retrouve_Delta
	 */
	public function testretrouve_Delta() {
		$this ->assertEquals ( 0, $this->object ->retrouve_Delta ( "" ) );
		$this ->assertEquals ( 0, $this->object ->retrouve_Delta ( "as is" ) );
		$this ->assertEquals ( 1, $this->object ->retrouve_Delta ( "speed per second" ) );
		$this ->assertEquals ( 2, $this->object ->retrouve_Delta ( "simple change" ) );
		$this ->assertEquals ( 10, $this->object ->retrouve_Delta ( 10 ) );
	}

	/**
	 * @covers Zorille\framework\zabbix_item::retrouve_Snmpv3Authprotocol
	 */
	public function testretrouve_Snmpv3Authprotocol() {
		$this ->assertEquals ( 0, $this->object ->retrouve_Snmpv3Authprotocol ( "" ) );
		$this ->assertEquals ( 0, $this->object ->retrouve_Snmpv3Authprotocol ( "MD5" ) );
		$this ->assertEquals ( 1, $this->object ->retrouve_Snmpv3Authprotocol ( "SHA" ) );
		$this ->assertEquals ( 10, $this->object ->retrouve_Snmpv3Authprotocol ( 10 ) );
	}

	/**
	 * @covers Zorille\framework\zabbix_item::retrouve_Snmpv3Privprotocol
	 */
	public function testretrouve_Snmpv3Privprotocol() {
		$this ->assertEquals ( 0, $this->object ->retrouve_Snmpv3Privprotocol ( "" ) );
		$this ->assertEquals ( 0, $this->object ->retrouve_Snmpv3Privprotocol ( "DES" ) );
		$this ->assertEquals ( 1, $this->object ->retrouve_Snmpv3Privprotocol ( "AES" ) );
		$this ->assertEquals ( 10, $this->object ->retrouve_Snmpv3Privprotocol ( 10 ) );
	}

	/**
	 * @covers Zorille\framework\zabbix_item::retrouve_Snmpv3Securitylevel
	 */
	public function testretrouve_Snmpv3Securitylevel() {
		$this ->assertEquals ( 0, $this->object ->retrouve_Snmpv3Securitylevel ( "" ) );
		$this ->assertEquals ( 0, $this->object ->retrouve_Snmpv3Securitylevel ( "noAuthNoPriv" ) );
		$this ->assertEquals ( 1, $this->object ->retrouve_Snmpv3Securitylevel ( "authNoPriv" ) );
		$this ->assertEquals ( 2, $this->object ->retrouve_Snmpv3Securitylevel ( "authPriv" ) );
		$this ->assertEquals ( 10, $this->object ->retrouve_Snmpv3Securitylevel ( 10 ) );
	}

	/**
	 * @covers Zorille\framework\zabbix_item::retrouve_State
	 */
	public function testretrouve_State() {
		$this ->assertEquals ( 0, $this->object ->retrouve_State ( "" ) );
		$this ->assertEquals ( 0, $this->object ->retrouve_State ( "normal" ) );
		$this ->assertEquals ( 1, $this->object ->retrouve_State ( "not supported" ) );
		$this ->assertEquals ( 10, $this->object ->retrouve_State ( 10 ) );
	}

	/**
	 * @covers Zorille\framework\zabbix_item::retrouve_Status
	 */
	public function testRetrouve_Status() {
		$this ->assertEquals ( 0, $this->object ->retrouve_Status ( "" ) );
		$this ->assertEquals ( 0, $this->object ->retrouve_Status ( "enabled item" ) );
		$this ->assertEquals ( 1, $this->object ->retrouve_Status ( "disabled item" ) );
		$this ->assertEquals ( 10, $this->object ->retrouve_Status ( 10 ) );
	}
}
