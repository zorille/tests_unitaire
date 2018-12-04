<?php
namespace Zorille\itop;
use Zorille\framework as Core;
/**
 * @author dvargas
 * @package Lib
 *
 */
if (! defined ( '__DOCUMENT_ROOT__' )) {
	require_once $_SERVER ["PWD"] . '/prepare.php';
}
class UserRequestTest extends Core\MockedListeOptions {
	/**
	 * @var UserRequest
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
		$itop_Contact = $this ->createMock('Zorille\itop\Contact' );
		
		$this->object = new UserRequest ( false, "TESTS UserRequest" );
		$this->object ->setListeOptions ( $this ->getListeOption () ) 
			->setObjetItopWsclientRest ( $itop_wsclient_rest ) 
			->setObjetItopOrganization ( $itop_Organization )
		    ->setObjetItopContact($itop_Contact);
		
		$this->object ->getObjetItopOrganization () 
			->expects ( $this ->any () ) 
			->method ( 'creer_oql' ) 
			->will ( $this ->returnValue ( $itop_Organization ) );
		$this->object ->getObjetItopContact ()
			->expects ( $this ->any () )
			->method ( 'creer_oql' )
			->will ( $this ->returnValue ( $itop_Contact ) );
		$this->object ->setFormat ( 'UserRequest' );
	}

	/**
	 * Tears down the fixture, for example, closes a network connection.
	 * This method is called after a test is executed.
	 */
	protected function tearDown() {
		ob_end_clean ();
	}

	/**
	 * @covers Zorille\itop\UserRequest::retrouve_UserRequest
	 */
	public function testretrouve_UserRequest() {
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
		$this ->assertSame ( $this->object, $this->object ->retrouve_UserRequest ( 'TITRE1') );
	}

	/**
	 * @covers Zorille\itop\UserRequest::creer_oql
	 */
	public function testcreer_oql_all() {
		$this ->assertSame ( $this->object, $this->object ->creer_oql ( '' ) );
		$this ->assertEquals ( "SELECT UserRequest WHERE status NOT IN ('closed')", $this->object ->getOqlCi () );
	}
	
	/**
	 * @covers Zorille\itop\UserRequest::creer_oql
	 */
	public function testcreer_oql_all_other_status() {
		$this ->assertSame ( $this->object, $this->object ->creer_oql ( '', "closed','new" ) );
		$this ->assertEquals ( "SELECT UserRequest WHERE status NOT IN ('closed','new')", $this->object ->getOqlCi () );
	}
	
	/**
	 * @covers Zorille\itop\UserRequest::creer_oql
	 */
	public function testcreer_oql_avec_titre() {
		$this ->assertSame ( $this->object, $this->object ->creer_oql ( 'Test' ) );
		$this ->assertEquals ( "SELECT UserRequest WHERE status NOT IN ('closed') AND title='Test'", $this->object ->getOqlCi () );
	}

	/**
	 * @covers Zorille\itop\UserRequest::gestion_UserRequest
	 */
	public function testgestion_UserRequest() {
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
		
		$this ->assertSame ( $this->object, $this->object ->gestion_UserRequest ( 'TITRE1', 'ORG1', 'DESCRIPTION1', 1, 1,array('contacs'),array('CIs'),array('WorkOrders') ) );
	}

}
?>
