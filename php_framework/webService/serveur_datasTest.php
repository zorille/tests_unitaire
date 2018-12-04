<?php
namespace Zorille\framework;

/**
 * @author dvargas
 * @package Lib
 *
 */
if (! defined ( '__DOCUMENT_ROOT__' )) {
	require_once $_SERVER ["PWD"] . '/prepare.php';
}

/**
 */
class serveur_datasTest extends MockedListeOptions {
	/**
     * @var serveur_datas
     */
	protected $object;

	/**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
	protected function setUp() {
		ob_start ();
		
		$utilisateurs = $this ->createMock('Zorille\framework\utilisateurs' );
		
		$this->object = new serveur_datas ( false, "TESTS serveur HOST" );
		$this->object ->setListeOptions ( $this ->getListeOption () ) 
			->setObjetUtilisateurs ( $utilisateurs );
	}

	/**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
	protected function tearDown() {
		ob_end_clean ();
	}

	/**
	 * @covers Zorille\framework\serveur_datas::valide_presence_serveur_data
	 */
	public function testvalide_presence_serveur_data() {
		$this->object ->getObjetUtilisateurs () 
			->expects ( $this ->any () ) 
			->method ( 'retrouve_utilisateurs_array' ) 
			->will ( $this ->returnValue ( $this->object ->getObjetUtilisateurs () ) );
		$this->object ->getObjetUtilisateurs () 
			->expects ( $this ->any () ) 
			->method ( 'getUsername' ) 
			->will ( $this ->onconsecutiveCalls ( 'USER1', 'USER2' ) );
		$this->object ->getObjetUtilisateurs () 
			->expects ( $this ->any () ) 
			->method ( 'getPassword' ) 
			->will ( $this ->onconsecutiveCalls ( 'PASS1', 'PASS2' ) );
		
		$this->object ->setServeurData ( array ( 
				"TEST" => array ( 
						"nom" => "NOMMACHINE" ), 
				"TEST2" => array ( 
						"nom" => "NOMMACHINE2" ) ) );
		$this ->assertEquals ( array ( 
				"nom" => "NOMMACHINE", 
				'username' => 'USER1', 
				'password' => 'PASS1' ), $this->object ->valide_presence_serveur_data ( "NOMMACHINE" ) );
		$this ->assertEquals ( array ( 
				"nom" => "NOMMACHINE2", 
				'username' => 'USER2', 
				'password' => 'PASS2' ), $this->object ->valide_presence_serveur_data ( "NOMMACHINE2" ) );
		$this ->assertFalse ( $this->object ->valide_presence_serveur_data ( "NOMMACHINE3" ) );
	}

	/**
	 * @covers Zorille\framework\serveur_datas::valide_presence_serveur_data
	 */
	public function testvalide_presence_serveur_data_protocole() {
		$this->object ->getObjetUtilisateurs () 
			->expects ( $this ->any () ) 
			->method ( 'retrouve_utilisateurs_array' ) 
			->will ( $this ->returnValue ( $this->object ->getObjetUtilisateurs () ) );
		$this->object ->getObjetUtilisateurs () 
			->expects ( $this ->any () ) 
			->method ( 'getUsername' ) 
			->will ( $this ->onconsecutiveCalls ( 'USER1', 'USER2' ) );
		$this->object ->getObjetUtilisateurs () 
			->expects ( $this ->any () ) 
			->method ( 'getPassword' ) 
			->will ( $this ->onconsecutiveCalls ( 'PASS1', 'PASS2' ) );
		
		$this->object ->setServeurData ( array ( 
				"TEST" => array ( 
						"nom" => "NOMMACHINE", 
						"protocole" => 'soap' ) ) );
		$this ->assertFalse ( $this->object ->valide_presence_serveur_data ( "NOMMACHINE", 'rest' ) );
	}
}
?>
