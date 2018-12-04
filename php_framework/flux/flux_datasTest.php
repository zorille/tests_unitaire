<?php
namespace Zorille\framework;
use \Exception as Exception;
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
class flux_datasTest extends MockedListeOptions {
	/**
     * @var flux_datas
     */
	protected $object;

	/**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
	protected function setUp() {
		ob_start ();
		
		$utilisateurs = $this ->createMock('Zorille\framework\utilisateurs' );
		
		$this->object = new flux_datas ( false, "TESTS flux_datas" );
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
	 * @covers Zorille\framework\flux_datas::retrouve_flux_param
	 */
	public function testretrouve_flux_param_Exception() {
		$this->object ->getListeOptions () 
			->expects ( $this ->at ( 0 ) ) 
			->method ( 'verifie_variable_standard' ) 
			->will ( $this ->returnValue ( false ) );
		$this ->expectException(Exception::class);
        $this->expectExceptionMessage( '(TESTS flux_datas) Il manque le parametre : liste_flux_serveur' );
		$this->object ->retrouve_flux_param ( "liste_flux" );
	}

	/**
	 * @covers Zorille\framework\flux_datas::retrouve_flux_param
	 */
	public function testretrouve_flux_param() {
		$this->object ->getListeOptions () 
			->expects ( $this ->at ( 0 ) ) 
			->method ( 'verifie_variable_standard' ) 
			->will ( $this ->returnValue ( true ) );
		$this->object ->getListeOptions () 
			->expects ( $this ->any () ) 
			->method ( 'renvoi_variables_standard' ) 
			->will ( $this ->returnValue ( array ( 
				"#comment" => "et voila un commentaire", 
				"nom" => "FLUX_TEST" ) ) );
		$this ->assertSame ( $this->object, $this->object ->retrouve_flux_param ( "liste_flux" ) );
	}

	/**
	 * @covers Zorille\framework\flux_datas::valide_presence_flux_data
	 */
	public function testvalide_presence_flux_data() {
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
		
		$this->object ->setFluxData ( array ( 
				"TEST" => array ( 
						"nom" => "USERLOCAL1" ), 
				"TEST2" => array ( 
						"nom" => "USERDISTANT1" ) ) );
		$this ->assertEquals ( array ( 
				"nom" => "USERLOCAL1", 
				'username' => 'USER1', 
				'password' => 'PASS1' ), $this->object ->valide_presence_flux_data ( "USERLOCAL1" ) );
		$this ->assertEquals ( array ( 
				"nom" => "USERDISTANT1", 
				'username' => 'USER2', 
				'password' => 'PASS2' ), $this->object ->valide_presence_flux_data ( "USERDISTANT1" ) );
		$this ->assertFalse ( $this->object ->valide_presence_flux_data ( "NOMMACHINE3" ) );
	}
}
?>
