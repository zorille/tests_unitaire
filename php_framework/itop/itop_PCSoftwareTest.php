<?php
/**
 * @author dvargas
 * @package Lib
 *
 */
if (! defined ( '__DOCUMENT_ROOT__' )) {
	require_once $_SERVER ["PWD"] . '/prepare.php';
}
class itop_PCSoftwareTest extends MockedListeOptions {
	/**
	 * @var itop_PCSoftware
	 */
	protected $object;

	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 */
	protected function setUp() {
		ob_start ();
		
		$itop_wsclient_rest = $this ->createMock ( "itop_wsclient_rest" );
		$itop_Organization = $this ->createMock ( "itop_Organization" );
		$itop_Software = $this ->createMock ( "itop_Software" );
		
		$this->object = new itop_PCSoftware ( false, "TESTS itop_PCSoftware" );
		$this->object ->setListeOptions ( $this ->getListeOption () ) 
			->setObjetItopWsclientRest ( $itop_wsclient_rest ) 
			->setObjetItopOrganization ( $itop_Organization ) 
			->setObjetItopSoftware ( $itop_Software );
		
		$this->object ->getObjetItopOrganization () 
			->expects ( $this ->any () ) 
			->method ( 'creer_oql' ) 
			->will ( $this ->returnValue ( $itop_Organization ) );
		$this->object ->getObjetItopSoftware()
		->expects ( $this ->any () )
		->method ( 'creer_oql' )
		->will ( $this ->returnValue ( $itop_Software ) );
		$this->object ->setFormat ( 'PCSoftware' );
	}

	/**
	 * Tears down the fixture, for example, closes a network connection.
	 * This method is called after a test is executed.
	 */
	protected function tearDown() {
		ob_end_clean ();
	}

	/**
	 * @covers itop_PCSoftware::retrouve_PCSoftware
	 */
	public function testretrouve_PCSoftware() {
		$this->object ->getObjetItopWsclientRest () 
			->expects ( $this ->any () ) 
			->method ( 'core_get' ) 
			->will ( $this ->returnValue ( array ( 
				'objects' => array ( 
						array ( 
								'class' => "CLASS1", 
								'key' => 10, 
								'fields' => array ( 
										'name' => 'NOM1' ) ) ), 
				'message' => 'Found: 1' ) ) );
		$this ->assertSame ( $this->object, $this->object ->retrouve_PCSoftware ( 'NAME1', 'server_name' ) );
	}

	/**
	 * @covers itop_PCSoftware::creer_oql
	 */
	public function testcreer_oql() {
		$this ->assertSame ( $this->object, $this->object ->creer_oql ( 'NAME1','server_name' ) );
		$this ->assertEquals ( "SELECT PCSoftware WHERE friendlyname='NAME1 server_name'", $this->object ->getOqlCi () );
	}
	
	/**
	 * @covers itop_PCSoftware::creer_oql
	 */
	public function testcreer_oql_sans_servername() {
		$this ->assertSame ( $this->object, $this->object ->creer_oql ( 'NAME2 server_name' ) );
		$this ->assertEquals ( "SELECT PCSoftware WHERE friendlyname='NAME2 server_name'", $this->object ->getOqlCi () );
	}

	/**
	 * @covers itop_PCSoftware::gestion_PCSoftware
	 */
	public function testgestion_PCSoftware() {
		$this->object ->getObjetItopWsclientRest () 
			->expects ( $this ->any () ) 
			->method ( 'core_get' ) 
			->will ( $this ->returnValue ( array ( 
				'objects' => array (), 
				'message' => 'Found: 0' ) ) );
		$this->object ->getObjetItopWsclientRest () 
			->expects ( $this ->any () ) 
			->method ( 'core_create' ) 
			->will ( $this ->returnValue ( array ( 
				'objects' => array ( 
						array ( 
								'class' => "CLASS1", 
								'key' => 10, 
								'fields' => array ( 
										'name' => 'NOM1' ) ) ), 
				'message' => 'Found: 1' ) ) );
			
		$this ->assertSame ( $this->object, $this->object ->gestion_PCSoftware ( 'NAME1', 'ORG1', 'active', 'high', 'server_name', 'SOFT 1.0','/bin/path', '2015-02-02' ) );
	}
}
?>
