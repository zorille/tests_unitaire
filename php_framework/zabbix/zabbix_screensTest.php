<?php
namespace Zorille\framework;
/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2015-05-12 at 10:29:51.
 */
if (! defined ( '__DOCUMENT_ROOT__' )) {
	require_once $_SERVER ["PWD"] . '/prepare.php';
}
class zabbix_screensTest extends MockedListeOptions {
	/**
     * @var zabbix_screens
     */
	protected $object;

	/**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
	protected function setUp() {
		ob_start ();
		$zabbix_wsclient = $this->createMock('Zorille\framework\zabbix_wsclient' );
		
		$this->object = new zabbix_screens ( false, "zabbix_screens" );
		$this->object->setObjetZabbixWsclient ( $zabbix_wsclient );
	}

	/**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
	protected function tearDown() {
		ob_end_clean ();
	}

	/**
     * @covers Zorille\framework\zabbix_screens::creer_definition_screenids_sans_champ_screenid_ws
     */
	public function testcreer_definition_screenids_sans_champ_screenid_ws() {
		$this->assertEquals ( array (), $this->object->creer_definition_screenids_sans_champ_screenid_ws () );
	}
}
