<?php
namespace Zorille\itop;
use Zorille\framework as Core;
use \Exception as Exception;
/**
 * @author dvargas
 * @package Lib
 *
 */
if (! defined ( '__DOCUMENT_ROOT__' )) {
	require_once $_SERVER ["PWD"] . '/prepare.php';
}
class BusinessProcessTest extends Core\MockedListeOptions {
	/**
	 * @var BusinessProcess
	 */
	protected $object;

	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 */
	protected function setUp() {
		ob_start ();
		
		$itop_wsclient_rest = $this ->createMock('Zorille\itop\wsclient_rest' );
		$itop_Organization = $this ->createMock('Zorille\itop\Organization' );
		
		$this->object = new BusinessProcess ( false, "TESTS BusinessProcess" );
		$this->object ->setListeOptions ( $this ->getListeOption () ) 
			->setObjetItopWsclientRest ( $itop_wsclient_rest ) 
			->setObjetItopOrganization ( $itop_Organization );
		
		$this->object ->getObjetItopOrganization () 
			->expects ( $this ->any () ) 
			->method ( 'creer_oql' ) 
			->will ( $this ->returnValue ( $itop_Organization ) );
		$this->object ->setFormat ( 'BusinessProcess' );
	}

	/**
	 * Tears down the fixture, for example, closes a network connection.
	 * This method is called after a test is executed.
	 */
	protected function tearDown() {
		ob_end_clean ();
	}

	/**
	 * @covers Zorille\itop\BusinessProcess::retrouve_BusinessProcess
	 */
	public function testretrouve_BusinessProcess() {
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
		$this ->assertSame ( $this->object, $this->object ->retrouve_BusinessProcess ( 'NAME1' ) );
	}

	/**
	 * @covers Zorille\itop\BusinessProcess::creer_oql
	 */
	public function testcreer_oql() {
		$this ->assertSame ( $this->object, $this->object ->creer_oql ( 'NAME1' ) );
		$this ->assertEquals ( "SELECT BusinessProcess WHERE name='NAME1'", $this->object ->getOqlCi () );
	}

	/**
	 * @covers Zorille\itop\BusinessProcess::gestion_BusinessProcess
	 */
	public function testgestion_BusinessProcess() {
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
			
		$this ->assertSame ( $this->object, $this->object ->gestion_BusinessProcess ( 'NAME1', 'ORG1', 'active', 'high', '2015-02-02', 'desc',  array ('contactList'), array ('ApplicationSolutionList') ) );
	}

	/**
	 * @covers Zorille\itop\BusinessProcess::creer_lnkApplicationSolutionToBusinessProcess
	 */
	public function testcreer_lnkApplicationSolutionToBusinessProcess_exception() {
		$this->object ->setFormat ( "BusinessProcess" )
		->setDonnees ( array (
				'name' => 'NOM2' ) );
	
		$this ->expectException(Exception::class);
        $this->expectExceptionMessage( '(TESTS BusinessProcess) Il faut un ID a ce BusinessProcess' );
		$this->object ->creer_lnkApplicationSolutionToBusinessProcess ( "FRIENDLYNAME", 15 );
	}
	
	/**
	 * @covers Zorille\itop\BusinessProcess::creer_lnkApplicationSolutionToBusinessProcess
	 */
	public function testcreer_lnkApplicationSolutionToBusinessProcess() {
		$this->object ->setId ( 10 ) 
			->setFormat ( "BusinessProcess" ) 
			->setDonnees ( array ( 
				'name' => 'NOM2' ) );
		
		$this ->assertEquals ( array ( 
				'businessprocess_id' => 10, 
				'businessprocess_name' => 'NOM2', 
				'applicationsolution_id' => 'FRIENDLYNAME', 
				'applicationsolution_name' => 15 ), $this->object ->creer_lnkApplicationSolutionToBusinessProcess ( "FRIENDLYNAME", 15 ) );
	}
}
?>
