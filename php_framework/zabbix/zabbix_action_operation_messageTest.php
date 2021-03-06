<?php
namespace Zorille\framework;
use \Exception as Exception;
if (! defined ( '__DOCUMENT_ROOT__' )) {
	require_once $_SERVER ["PWD"] . '/prepare.php';
}

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2015-03-24 at 09:39:51.
 */
class zabbix_action_operation_messageTest extends MockedListeOptions {
	/**
     * @var zabbix_action_operation_message
     */
	protected $object;

	/**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
	protected function setUp() {
		ob_start ();
		$zabbix_wsclient = $this ->createMock('Zorille\framework\zabbix_wsclient' );
		$zabbix_mediatype = $this ->createMock('Zorille\framework\zabbix_mediatype' );
		
		$this->object = new zabbix_action_operation_message ( false, "zabbix_action_operation_message" );
		$this->object ->setObjetZabbixWsclient ( $zabbix_wsclient ) 
			->setObjetMediatype ( $zabbix_mediatype );
	}

	/**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
	protected function tearDown() {
		ob_end_clean ();
	}

	/**
     * @covers Zorille\framework\zabbix_action_operation_message::retrouve_zabbix_param
     */
	public function testRetrouve_zabbix_param() {
		$this ->getListeOption () 
			->expects ( $this ->any () ) 
			->method ( 'verifie_variable_standard' ) 
			->will ( $this ->returnValue ( false ) );
		$this->object ->setListeOptions ( $this ->getListeOption () );
		
		$this->object ->getObjetMediatype () 
			->expects ( $this ->any () ) 
			->method ( 'retrouve_zabbix_param' ) 
			->will ( $this ->returnSelf () );
		$this->object ->getObjetMediatype () 
			->expects ( $this ->any () ) 
			->method ( 'recherche_mediatypeid_by_Name' ) 
			->will ( $this ->returnSelf () );
		$this->object ->getObjetMediatype () 
			->expects ( $this ->any () ) 
			->method ( 'getMediatypeId' ) 
			->will ( $this ->returnValue ( 123 ) );
		
		$this ->assertSame ( $this->object, $this->object ->retrouve_zabbix_param () );
		$this ->assertEquals ( 0, $this->object ->getDefaultMsg () );
	}

	/**
	 * @covers Zorille\framework\zabbix_action_operation_message::retrouve_zabbix_param
	 */
	public function testRetrouve_zabbix_param_1() {
		$this ->getListeOption () 
			->expects ( $this ->any () ) 
			->method ( 'verifie_variable_standard' ) 
			->will ( $this ->returnValue ( true ) );
		$this ->getListeOption () 
			->expects ( $this ->any () ) 
			->method ( 'renvoi_variables_standard' ) 
			->will ( $this ->returnValue ( "action" ) );
		$this->object ->setListeOptions ( $this ->getListeOption () );
		
		$this->object ->getObjetMediatype () 
			->expects ( $this ->any () ) 
			->method ( 'retrouve_zabbix_param' ) 
			->will ( $this ->returnSelf () );
		$this->object ->getObjetMediatype () 
			->expects ( $this ->any () ) 
			->method ( 'recherche_mediatypeid_by_Name' ) 
			->will ( $this ->returnSelf () );
		$this->object ->getObjetMediatype () 
			->expects ( $this ->any () ) 
			->method ( 'getMediatypeId' ) 
			->will ( $this ->returnValue ( 123 ) );
		
		$this ->assertSame ( $this->object, $this->object ->retrouve_zabbix_param () );
		$this ->assertEquals ( 1, $this->object ->getDefaultMsg () );
	}

	/**
	 * @covers Zorille\framework\zabbix_action_operation_message::retrouve_mediaTypeId
	 */
	public function testRetrouve_mediaTypeId() {
		$this->object ->getObjetMediatype () 
			->expects ( $this ->any () ) 
			->method ( 'retrouve_zabbix_param' ) 
			->will ( $this ->returnSelf () );
		$this->object ->getObjetMediatype () 
			->expects ( $this ->any () ) 
			->method ( 'recherche_mediatypeid_by_Name' ) 
			->will ( $this ->returnValue ( array () ) );
		$this->object ->getObjetMediatype () 
			->expects ( $this ->any () ) 
			->method ( 'getDescription' ) 
			->will ( $this ->returnValue ( "DESC1" ) );
		
		$this->object ->getObjetMediatype () 
			->expects ( $this ->any () ) 
			->method ( 'getMediatypeId' ) 
			->will ( $this ->returnValue ( "" ) );
		
		$this ->expectException(Exception::class);
        $this->expectExceptionMessage( '(zabbix_action_operation_message) Aucun Mediatype avec le nom DESC1' );
		$this->object ->retrouve_mediaTypeId ();
	}

	/**
	 * @covers Zorille\framework\zabbix_action_operation_message::retrouve_mediaTypeId
	 */
	public function testRetrouve_mediaTypeId_valide() {
		$this->object ->getObjetMediatype () 
			->expects ( $this ->any () ) 
			->method ( 'retrouve_zabbix_param' ) 
			->will ( $this ->returnSelf () );
		$this->object ->getObjetMediatype () 
			->expects ( $this ->any () ) 
			->method ( 'recherche_mediatypeid_by_Name' ) 
			->will ( $this ->returnValue ( array () ) );
		$this->object ->getObjetMediatype () 
			->expects ( $this ->any () ) 
			->method ( 'getDescription' ) 
			->will ( $this ->returnValue ( "DESC1" ) );
		
		$this->object ->getObjetMediatype () 
			->expects ( $this ->any () ) 
			->method ( 'getMediatypeId' ) 
			->will ( $this ->returnValue ( 123 ) );
		
		$this ->assertSame ( $this->object, $this->object ->retrouve_mediaTypeId () );
	}

	/**
     * @covers Zorille\framework\zabbix_action_operation_message::creer_definition_zabbix_operation_message_ws
     */
	public function testCreer_definition_zabbix_operation_message_ws_exception() {
		$this->object ->setDefaultMsg ( "operation" );
		$this ->expectException(Exception::class);
        $this->expectExceptionMessage( '(zabbix_action_operation_message) Il faut un mediatype' );
		$this->object ->creer_definition_zabbix_operation_message_ws ();
	}

	/**
	 * @covers Zorille\framework\zabbix_action_operation_message::creer_definition_zabbix_operation_message_ws
	 */
	public function testCreer_definition_zabbix_operation_message_ws_valide() {
		$this ->assertEquals ( array (), $this->object ->creer_definition_zabbix_operation_message_ws () );
		
		$this->object ->setDefaultMsg ( "operation" );
		$this->object ->setMediaTypeId ( 10 );
		$this->object ->setOperationId ( 100 );
		$this ->assertEquals ( array ( 
				"default_msg" => 0, 
				"mediatypeid" => 10, 
				"message" => "", 
				"subject" => "", 
				"operationid" => 100 ), $this->object ->creer_definition_zabbix_operation_message_ws () );
	}

	/**
     * @covers Zorille\framework\zabbix_action_operation_message::retrouve_defaultMsg
     */
	public function testRetrouve_defaultMsg() {
		$this ->assertEquals ( 0, $this->object ->retrouve_defaultMsg ( "" ) );
		$this ->assertEquals ( 0, $this->object ->retrouve_defaultMsg ( "operation" ) );
		$this ->assertEquals ( 1, $this->object ->retrouve_defaultMsg ( "action" ) );
		$this ->assertEquals ( 10, $this->object ->retrouve_defaultMsg ( 10 ) );
	}
}
