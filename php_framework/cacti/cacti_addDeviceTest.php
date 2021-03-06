<?php
namespace Zorille\framework;
use \Exception as Exception;
/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2014-08-25 at 16:38:50.
 */
if (! defined ( '__DOCUMENT_ROOT__' )) {
	require_once $_SERVER ["PWD"] . '/prepare.php';
}
require_once "cacti_API_fonctions.php";
class cacti_addDeviceTest extends MockedListeOptions {
	/**
     * @var cacti_addDevice
     */
	protected $object;

	/**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
	protected function setUp() {
		ob_start ();
		
		$this->object = new cacti_addDevice ( false, "TESTS cacti_addDevice" );
	}

	/**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
	protected function tearDown() {
		ob_end_clean ();
	}

	/**
     * @covers Zorille\framework\cacti_addDevice::prepareVariablescacti_addDevice
     */
	public function testPrepareVariablescacti_addDevice() {
		$this ->assertTrue ( $this->object ->prepareVariablescacti_addDevice () );
	}

	/**
     * @covers Zorille\framework\cacti_addDevice::valide_host_description
     */
	public function testValide_host_description() {
		$this->object ->setDescription ( "Host" );
		$this ->assertFalse ( $this->object ->valide_host_description () );
		$this->object ->setDescription ( "Host1" );
		$this ->assertTrue ( $this->object ->valide_host_description () );
	}

	/**
     * @covers Zorille\framework\cacti_addDevice::valide_host_ip
     */
	public function testValide_host_ip() {
		$this->object ->setIp ( 'Address1' );
		$this ->assertFalse ( $this->object ->valide_host_ip () );
		$this->object ->setIp ( 'Addresse1' );
		$this ->assertTrue ( $this->object ->valide_host_ip () );
	}

	/**
     * @covers Zorille\framework\cacti_addDevice::valide_SNMP
     */
	public function testValide_SNMP_exception1() {
		$this->object ->setSnmpVersion ( 10 );
		$this ->expectException(Exception::class);
        $this->expectExceptionMessage( '(TESTS cacti_addDevice) Mauvaise version de SNMP : 10' );
		$this->object ->valide_SNMP ();
	}

	/**
	 * @covers Zorille\framework\cacti_addDevice::valide_SNMP
	 */
	public function testValide_SNMP_exception2() {
		$this->object ->setSnmpVersion ( 3 );
		
		$this->object ->setSNMPPort ( 1 );
		$this ->expectException(Exception::class);
        $this->expectExceptionMessage( '(TESTS cacti_addDevice) Mauvais port SNMP : 1' );
		$this->object ->valide_SNMP ();
	}

	/**
	 * @covers Zorille\framework\cacti_addDevice::valide_SNMP
	 */
	public function testValide_SNMP_exception3() {
		$this->object ->setSnmpVersion ( 3 );
		$this->object ->setSNMPPort ( 161 );
		
		$this->object ->setSnmpTimeout ( 100000 );
		$this ->expectException(Exception::class);
        $this->expectExceptionMessage( '(TESTS cacti_addDevice) Le timeout SNMP doit etre compris entre 0 et 20000 : 100000' );
		$this->object ->valide_SNMP ();
	}

	/**
	 * @covers Zorille\framework\cacti_addDevice::valide_SNMP
	 */
	public function testValide_SNMP_exception4() {
		$this->object ->setSnmpVersion ( 3 );
		$this->object ->setSNMPPort ( 161 );
		$this->object ->setSnmpTimeout ( 1000 );
		
		$this ->expectException(Exception::class);
        $this->expectExceptionMessage( '(TESTS cacti_addDevice) En snmp V3 if faut un username et un password.' );
		$this->object ->valide_SNMP ();
	}

	/**
	 * @covers Zorille\framework\cacti_addDevice::valide_SNMP
	 */
	public function testValide_SNMP_valide() {
		$this->object ->setSnmpVersion ( 3 );
		$this->object ->setSNMPPort ( 161 );
		$this->object ->setSnmpTimeout ( 1000 );
		$this->object ->setSnmpUsername ( "USER" );
		$this->object ->setSnmpPassword ( "PASS" );
		
		$this ->assertTrue ( $this->object ->valide_SNMP () );
	}

	/**
     * @covers Zorille\framework\cacti_addDevice::executeCacti_AddDevice
     */
	public function testExecuteCacti_AddDevice_exception1() {
		$this ->expectException(Exception::class);
        $this->expectExceptionMessage( '(TESTS cacti_addDevice) Il faut une description.' );
		$this->object ->executeCacti_AddDevice ();
	}

	/**
	 * @covers Zorille\framework\cacti_addDevice::executeCacti_AddDevice
	 */
	public function testExecuteCacti_AddDevice_exception2() {
		$this->object ->setDescription ( "DESC" );
		
		$this ->expectException(Exception::class);
        $this->expectExceptionMessage( '(TESTS cacti_addDevice) Il faut une Ip.' );
		$this->object ->executeCacti_AddDevice ();
	}

	/**
	 * @covers Zorille\framework\cacti_addDevice::executeCacti_AddDevice
	 */
	public function testExecuteCacti_AddDevice_exception3() {
		$this->object ->setDescription ( "DESC" );
		$this->object ->setIp ( "IP" );
		
		$this->object ->setSnmpVersion ( 10 );
		$this ->expectException(Exception::class);
        $this->expectExceptionMessage( '(TESTS cacti_addDevice) Mauvaise version de SNMP : 10' );
		$this->object ->executeCacti_AddDevice ();
	}

	/**
	 * @covers Zorille\framework\cacti_addDevice::executeCacti_AddDevice
	 */
	public function testExecuteCacti_AddDevice_exception4() {
		$this->object ->setDescription ( "DESC" );
		$this->object ->setIp ( "IP" );
		$this->object ->setSnmpVersion ( 2 );
		
		$this->object ->setDescription ( "Host1" );
		$this ->expectException(Exception::class);
        $this->expectExceptionMessage( '(TESTS cacti_addDevice) Doublon en base.' );
		$this->object ->executeCacti_AddDevice ();
	}

	/**
	 * @covers Zorille\framework\cacti_addDevice::executeCacti_AddDevice
	 */
	public function testExecuteCacti_AddDevice_exception5() {
		$this->object ->setDescription ( "DESC" );
		$this->object ->setIp ( "IP" );
		$this->object ->setSnmpVersion ( 2 );
		$this->object ->setDescription ( "DESC" );
		
		$this ->expectException(Exception::class);
        $this->expectExceptionMessage( '(TESTS cacti_addDevice) Le template n\'existe pas' );
		$this->object ->executeCacti_AddDevice ();
	}

	/**
	 * @covers Zorille\framework\cacti_addDevice::executeCacti_AddDevice
	 */
	public function testExecuteCacti_AddDevice_exception6() {
		$this->object ->setDescription ( "DESC" );
		$this->object ->setIp ( "IP" );
		$this->object ->setSnmpVersion ( 2 );
		$this->object ->setDescription ( "DESC" );
		$this->object ->setTemplate_id ( "123456" );
		
		$this ->expectException(Exception::class);
        $this->expectExceptionMessage( '(TESTS cacti_addDevice) Erreur d\'ajout/modification de CI' );
		$GLOBALS ['global_error_message'] = true;
		$this->object ->executeCacti_AddDevice ();
	}

	/**
	 * @covers Zorille\framework\cacti_addDevice::executeCacti_AddDevice
	 */
	public function testExecuteCacti_AddDevice_exception7() {
		$this->object ->setDescription ( "DESC" );
		$this->object ->setIp ( "IP" );
		$this->object ->setSnmpVersion ( 2 );
		$this->object ->setDescription ( "DESC" );
		$this->object ->setTemplate_id ( "123456" );
		$GLOBALS ['global_error_message'] = false;
		$this ->expectException(Exception::class);
        $this->expectExceptionMessage( '(TESTS cacti_addDevice) Ce CI n\'existe pas en base. Donc pas d\'update possible' );
		$this->object ->setDescription ( "Host" );
		$this->object ->executeCacti_AddDevice ( true, "description" );
	}

	/**
	 * @covers Zorille\framework\cacti_addDevice::executeCacti_AddDevice
	 */
	public function testExecuteCacti_AddDevice_valide() {
		$this->object ->setDescription ( "DESC" );
		$this->object ->setIp ( "IP" );
		$this->object ->setSnmpVersion ( 2 );
		$this->object ->setDescription ( "DESC" );
		$this->object ->setTemplate_id ( "123456" );
		$GLOBALS ['global_error_message'] = false;
		$this ->assertEquals ( "1234567890", $this->object ->executeCacti_AddDevice () );
		
		$this ->assertEquals ( "1234567890", $this->object ->executeCacti_AddDevice ( true ) );
		$this ->assertEquals ( "1234567890", $this->object ->executeCacti_AddDevice ( true, "description" ) );
		$this ->assertEquals ( "1234567890", $this->object ->executeCacti_AddDevice ( true, "ip" ) );
	}

	/**
     * @covers Zorille\framework\cacti_addDevice::reset_host
     */
	public function testReset_host() {
		$this ->assertTrue ( $this->object ->reset_host () );
	}
}
