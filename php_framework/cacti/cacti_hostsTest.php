<?php

/**
 * @author dvargas
 * @package Lib
 *
 */
if (! defined ( '__DOCUMENT_ROOT__' )) {
	require_once $_SERVER ["PWD"] . '/prepare.php';
}
require_once "cacti_API_fonctions.php";

/**
 */
class cacti_hostsTest extends PHPUnit\Framework\TestCase {
	/**
     * @var cacti_hosts
     */
	protected $object;

	/**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
	protected function setUp() {
		ob_start ();
		$this->object = new cacti_hosts ( false, "TESTS CACTI HOST" );
		$this->object->charge_hosts();
	}

	/**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
	protected function tearDown() {
		ob_end_clean ();
	}

	/**
     * @covers cacti_hosts::charge_hosts
     */
	public function testcharge_hosts() {
		$this->assertInstanceOf ( 'cacti_hosts', $this->object->charge_hosts () );
	}

	/**
     * @covers cacti_hosts::valide_host_by_id
     */
	public function testvalide_host_by_id() {
		$this->assertFalse ( $this->object->valide_host_by_id ( '1234' ) );
		$this->assertTrue ( $this->object->valide_host_by_id ( '123456' ) );
	}

	/**
	 * @covers cacti_hosts::valide_host_by_description
	 */
	public function testvalide_host_by_description() {
		$this->assertFalse ( $this->object->valide_host_by_description ( 'Host' ) );
		$this->assertTrue ( $this->object->valide_host_by_description ( 'Host1' ) );
	}

	/**
	 * @covers cacti_hosts::renvoi_hostid_by_description
	 */
	public function testrenvoi_hostid_by_description() {
		$this->assertFalse ( $this->object->renvoi_hostid_by_description ( 'Host' ) );
		$this->assertEquals ( '123456', $this->object->renvoi_hostid_by_description ( 'Host1' ) );
	}

	/**
	 * @covers cacti_hosts::valide_host_by_ip
	 */
	public function testvalide_host_by_ip() {
		$this->assertFalse ( $this->object->valide_host_by_ip ( 'Address1' ) );
		$this->assertTrue ( $this->object->valide_host_by_ip ( 'Addresse1' ) );
	}

	/**
	 * @covers cacti_hosts::renvoi_hostid_by_ip
	 */
	public function testrenvoi_hostid_by_ip() {
		$this->assertFalse ( $this->object->renvoi_hostid_by_ip ( 'Address1' ) );
		$this->assertEquals ( '123456', $this->object->renvoi_hostid_by_ip ( 'Addresse1' ) );
	}

	/**
    * @covers cacti_hosts::getOneHosts
    */
	public function testgetOneHosts() {
		$this->assertFalse ( $this->object->getOneHosts ( 'Host' ) );
		$this->assertEquals ( array (
				"description" => "Host1" 
		), $this->object->getOneHosts ( 'Host1' ) );
	}

	/**
	 * @covers cacti_hosts::ajouteHosts
	 */
	public function testajouteHosts() {
		$this->assertFalse ( $this->object->renvoi_hostid_by_description ( 'Host3' ) );
		$this->object->ajouteHosts ( "Host3", "369258" );
		$this->assertEquals ( '369258', $this->object->renvoi_hostid_by_description ( 'Host3' ) );
	}

	/**
	 * @covers cacti_hosts::ajouteHostsByIPs
	 */
	public function testajouteHostsByIPs() {
		$this->assertFalse ( $this->object->renvoi_hostid_by_ip ( 'Addresse2' ) );
		$this->object->ajouteHostsByIPs ( "Addresse2", "369852" );
		$this->assertEquals ( '369852', $this->object->renvoi_hostid_by_ip ( 'Addresse2' ) );
	}
}
?>
