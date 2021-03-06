<?php
namespace Zorille\framework;
use \Exception as Exception;
if (! defined ( '__DOCUMENT_ROOT__' )) {
	require_once $_SERVER ["PWD"] . '/prepare.php';
}

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2015-03-20 at 10:17:12.
 */
class zabbix_templateTest extends MockedListeOptions {
	/**
     * @var zabbix_template
     */
	protected $object;

	/**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
	protected function setUp() {
		ob_start ();
		$zabbix_wsclient = $this->createMock('Zorille\framework\zabbix_wsclient' );
		
		$this->object = new zabbix_template ( false, "zabbix_template" );
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
     * @covers Zorille\framework\zabbix_template::retrouve_zabbix_param
     */
	public function testRetrouve_zabbix_param_Exception() {
			
			$this->getListeOption ()
				->expects ( $this->any () )
				->method ( 'verifie_variable_standard' )
				->will ( $this->returnValue ( false ) );
			$this->object->setListeOptions ( $this->getListeOption () );
			
			$this ->expectException(Exception::class);
        $this->expectExceptionMessage( '(zabbix_template) Il manque le parametre : zabbix_template' );
			$this->object->retrouve_zabbix_param ();
			$this->assertEquals ( "", $this->object->getName () );
	}

	/**
	 * @covers Zorille\framework\zabbix_template::retrouve_zabbix_param
	 */
	public function testRetrouve_zabbix_param() {
		$this->getListeOption ()
			->expects ( $this->any () )
			->method ( 'verifie_variable_standard' )
			->will ( $this->returnValue ( true ) );
		$this->getListeOption ()
			->expects ( $this->any () )
			->method ( 'renvoi_variables_standard' )
			->will ( $this->returnValue ( "template" ) );
		$this->object->setListeOptions ( $this->getListeOption () );
		
		$this->assertSame ( $this->object, $this->object->retrouve_zabbix_param () );
		$this->assertEquals ( "template", $this->object->getName () );
	}

	/**
     * @covers Zorille\framework\zabbix_template::creer_definition_template_create_ws
     */
	public function testCreer_definition_template_create_ws() {
		$this->object->setName ( "DESC" );
		$this->assertEquals ( array (
				"host" => "",
				"name" => "DESC" 
		), $this->object->creer_definition_template_create_ws () );
		
		$this->object->setName ( "" );
		$this->object->setHost ( "DESC" );
		$this->assertEquals ( array (
				"host" => "DESC",
				"name" => "DESC" 
		), $this->object->creer_definition_template_create_ws () );
	}

	/**
     * @covers Zorille\framework\zabbix_template::creer_template
     */
	public function testCreer_template() {
		$this->object->setName ( "DESC" );
		
		$this->object->getObjetZabbixWsclient ()
			->expects ( $this->any () )
			->method ( 'templateCreate' )
			->will ( $this->returnValue ( array (
				"templateid" => array (
						10 
				) 
		) ) );
		
		$this->assertEquals ( array (
				"templateid" => array (
						10 
				) 
		), $this->object->creer_template () );
	}
}
