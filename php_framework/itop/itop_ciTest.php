<?php
/**
 * @author dvargas
 * @package Lib
 *
 */
if (! defined ( '__DOCUMENT_ROOT__' )) {
	require_once $_SERVER ["PWD"] . '/prepare.php';
}
class itop_ciTest extends MockedListeOptions {
	/**
	 * @var itop_ci
	 */
	protected $object;

	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 */
	protected function setUp() {
		ob_start ();
		
		$itop_wsclient_rest = $this ->createMock ( "itop_wsclient_rest" );
		
		$this->object = new itop_ci ( false, "TESTS itop_ci" );
		$this->object ->setListeOptions ( $this ->getListeOption () ) 
			->setObjetItopWsclientRest ( $itop_wsclient_rest );
	}

	/**
	 * Tears down the fixture, for example, closes a network connection.
	 * This method is called after a test is executed.
	 */
	protected function tearDown() {
		ob_end_clean ();
	}

	/**
	 * @covers itop_ci::enregistre_ci_a_partir_rest
	 */
	public function testenregistre_ci_a_partir_rest() {
		$ci = array ( 
				'objects' => array ( 
						array ( 
								'class' => "CLASS1", 
								'key' => 10, 
								'fields' => array ( 
										'array_of_fields1' ) ), 
						array ( 
								'class' => "CLASS2", 
								'key' => 15, 
								'fields' => array ( 
										'array_of_fields2' ) ) ) );
		$this ->assertSame ( $this->object, $this->object ->enregistre_ci_a_partir_rest ( $ci ) );
		$this ->assertEquals ( "CLASS1", $this->object ->getFormat () );
		$this ->assertEquals ( 10, $this->object ->getId () );
		$this ->assertEquals ( array ( 
				'array_of_fields1' ), $this->object ->getDonnees () );
	}

	/**
	 * @covers itop_ci::recupere_ci_dans_itop
	 */
	public function testrecupere_ci_dans_itop() {
		$this->object ->getObjetItopWsclientRest () 
			->expects ( $this ->any () ) 
			->method ( 'core_get' ) 
			->will ( $this ->returnValue ( array ( 
				'objects' ) ) );
		$this ->assertEquals ( array ( 
				"objects" ), $this->object ->recupere_ci_dans_itop () );
	}

	/**
	 * @covers itop_ci::retrouve_ci
	 */
	public function testretrouve_ci_exception() {
		$this->object ->getObjetItopWsclientRest () 
			->expects ( $this ->any () ) 
			->method ( 'core_get' ) 
			->will ( $this ->returnValue ( array ( 
				'objects' => array (), 
				'message' => 'Found: 10' ) ) );
		$this->object ->setOqlCi ( "SELECT CI" );
		$this ->expectException(Exception::class);
        $this->expectExceptionMessage( '(TESTS itop_ci) Probleme avec la requete : SELECT CI : Found: 10' );
		$this->object ->retrouve_ci ();
	}

	/**
	 * @covers itop_ci::retrouve_ci
	 */
	public function testretrouve_ci() {
		$this->object ->getObjetItopWsclientRest () 
			->expects ( $this ->any () ) 
			->method ( 'core_get' ) 
			->will ( $this ->returnValue ( array ( 
				'objects' => array ( 
						array ( 
								'class' => "CLASS1", 
								'key' => 10, 
								'fields' => array ( 
										'array_of_fields1' ) ) ), 
				'message' => 'Found: 1' ) ) );
		$this->object ->setOqlCi ( "SELECT CI" );
		$this ->assertSame ( $this->object, $this->object ->retrouve_ci () );
		$this ->assertEquals ( "CLASS1", $this->object ->getFormat () );
		$this ->assertEquals ( 10, $this->object ->getId () );
		$this ->assertEquals ( array ( 
				'array_of_fields1' ), $this->object ->getDonnees () );
	}

	/**
	 * @covers itop_ci::retrouve_ci
	 */
	public function testretrouve_ci_deja_a_jour() {
		$this->object ->setDonnees ( array ( 
				"name" => "TEST" ) );
		$this ->assertSame ( $this->object, $this->object ->retrouve_ci () );
		$this ->assertEquals ( array ( 
				"name" => "TEST" ), $this->object ->getDonnees () );
	}

	/**
	 * @covers itop_ci::valide_ci_existe
	 */
	public function testvalide_ci_existe_null() {
		$this->object ->getObjetItopWsclientRest () 
			->expects ( $this ->any () ) 
			->method ( 'core_get' ) 
			->will ( $this ->returnValue ( array ( 
				'objects' => array (), 
				'message' => 'Found: 10' ) ) );
		$this->object ->setOqlCi ( "SELECT CI" );
		$this ->assertEquals ( NULL, $this->object ->valide_ci_existe () );
	}
	
	/**
	 * @covers itop_ci::valide_ci_existe
	 */
	public function testvalide_ci_existe_deja_a_jour() {
		$this->object ->setDonnees ( array (
				"name" => "TEST" ) );
		$this ->assertSame ( $this->object, $this->object ->valide_ci_existe () );
		$this ->assertEquals ( array (
				"name" => "TEST" ), $this->object ->getDonnees () );
	}

	/**
	 * @covers itop_ci::valide_ci_existe
	 */
	public function testvalide_ci_existe() {
		$this->object ->getObjetItopWsclientRest () 
			->expects ( $this ->any () ) 
			->method ( 'core_get' ) 
			->will ( $this ->returnValue ( array ( 
				'objects' => array ( 
						array ( 
								'class' => "CLASS1", 
								'key' => 10, 
								'fields' => array ( 
										'array_of_fields1' ) ) ), 
				'message' => 'Found: 1' ) ) );
		$this->object ->setOqlCi ( "SELECT CI" );
		$this ->assertSame ( $this->object, $this->object ->valide_ci_existe () );
		$this ->assertEquals ( "CLASS1", $this->object ->getFormat () );
		$this ->assertEquals ( 10, $this->object ->getId () );
		$this ->assertEquals ( array ( 
				'array_of_fields1' ), $this->object ->getDonnees () );
	}

	/**
	 * @covers itop_ci::creer_ci
	 */
	public function testcreer_ci() {
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
		$this->object ->setOqlCi ( "SELECT CI" );
		
		$this ->assertSame ( $this->object, $this->object ->creer_ci ( "NOM1", array () ) );
		$this ->assertEquals ( "CLASS1", $this->object ->getFormat () );
		$this ->assertEquals ( 10, $this->object ->getId () );
		$this ->assertEquals ( array ( 
				'name' => 'NOM1' ), $this->object ->getDonnees () );
	}
}
?>
