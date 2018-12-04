<?php
namespace Zorille\framework;
use \Exception as Exception;
if (! defined ( '__DOCUMENT_ROOT__' )) {
	require_once $_SERVER ["PWD"] . '/prepare.php';
}

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2015-03-20 at 10:12:22.
 */
class zabbix_connexionTest extends MockedListeOptions {
	/**
     * @var zabbix_connexion
     */
	protected $object;

	/**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
	protected function setUp() {
		ob_start ();
		$zabbix_wsclient = $this ->createMock('Zorille\framework\zabbix_wsclient' );
		
		$this->object = new zabbix_connexion ( false, "zabbix_connexion" );
		$this->object ->setObjetZabbixWsclient ( $zabbix_wsclient );
	}

	/**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
	protected function tearDown() {
		ob_end_clean ();
	}

	/**
     * @covers Zorille\framework\zabbix_connexion::connect_zabbix
     */
	public function testconnect_zabbix_Exception() {
		$this ->getListeOption () 
			->expects ( $this ->any () ) 
			->method ( 'verifie_option_existe' ) 
			->will ( $this ->returnValue ( false ) );
		$this->object ->setListeOptions ( $this ->getListeOption () );
		
		$this ->expectException(Exception::class);
        $this->expectExceptionMessage( '(zabbix_connexion) Il faut un --zabbix_serveur pour travailler.' );
		$this->object ->connect_zabbix ();
	}

	/**
	 * @covers Zorille\framework\zabbix_connexion::connect_zabbix
	 */
	public function testconnect_zabbix() {
		$this ->getListeOption () 
			->expects ( $this ->any () ) 
			->method ( 'verifie_variable_standard' ) 
			->will ( $this ->returnValue ( true ) );
		$this->object ->setListeOptions ( $this ->getListeOption () );
		
		$this->object ->getObjetZabbixWsclient () 
			->expects ( $this ->any () ) 
			->method ( 'prepare_connexion' ) 
			->will ( $this ->returnValue ( $this->object ) );
		
		$this ->assertSame ( $this->object, $this->object ->connect_zabbix () );
	}
}
