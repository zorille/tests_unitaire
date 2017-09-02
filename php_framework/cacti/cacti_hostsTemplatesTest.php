<?php

/**
 * @author dvargas
 * @package Lib
 *
 */
if (! defined ( '__DOCUMENT_ROOT__' )) {
	require_once $_SERVER ["PWD"] . '/prepare.php';
}
require_once "cacti_API_fonctions.php";

/**
 */
class cacti_hostsTemplatesTest extends MockedListeOptions {
	/**
     * @var cacti_hosts
     */
	protected $object;

	/**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
	protected function setUp() {
		ob_start ();
		$this->object = new cacti_hostsTemplates ( false, "TESTS cacti_hostsTemplates" );
	}

	/**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
	protected function tearDown() {
		ob_end_clean ();
	}

	/**
     * @covers cacti_hostsTemplates::charge_templates
     */
	public function testcharge_templates() {
		$this ->assertInstanceOf ( 'cacti_hostsTemplates', $this->object ->charge_templates () );
	}

	/**
	 * @covers cacti_hostsTemplates::valide_template_by_id
	 */
	public function testvalide_template_by_id() {
		$this->object ->setTemplates ( array ( 
				"123456" => "data" ) );
		$this ->assertFalse ( $this->object ->valide_template_by_id ( "1234" ) );
		$this ->assertTrue ( $this->object ->valide_template_by_id ( "123456" ) );
	}

	/**
	 * @covers cacti_hostsTemplates::retrouve_templateid_par_nom
	 */
	public function testretrouve_templateid_par_nom_exception1() {
		$dbCon = $this ->createMock ( "requete_complexe_cacti" );
		$dbCon ->expects ( $this ->at ( 0 ) ) 
			->method ( 'requete_select_standard' ) 
			->will ( $this ->returnValue ( false ) );
		$dbCon ->expects ( $this ->any () ) 
			->method ( 'requete_select_standard' ) 
			->will ( $this ->returnValue ( array ( 
				array ( 
						"id" => "123456", 
						"name" => "tests unitaires en cours" ) ) ) );
		
		$this ->expectException(Exception::class);
        $this->expectExceptionMessage( '(TESTS cacti_hostsTemplates) Erreur durant la requete sur les host_template' );
		$this->object ->retrouve_templateid_par_nom ( $dbCon, "unitaires", "/^tests/" );
	}

	/**
	 * @covers cacti_hostsTemplates::retrouve_templateid_par_nom
	 */
	public function testretrouve_templateid_par_nom_exception2() {
		$dbCon = $this ->createMock ( "requete_complexe_cacti" );
		$dbCon ->expects ( $this ->at ( 0 ) ) 
			->method ( 'requete_select_standard' ) 
			->will ( $this ->returnValue ( array () ) );
		$dbCon ->expects ( $this ->any () ) 
			->method ( 'requete_select_standard' ) 
			->will ( $this ->returnValue ( array ( 
				array ( 
						"id" => "123456", 
						"name" => "tests unitaires en cours" ) ) ) );
		
		$this ->expectException(Exception::class);
        $this->expectExceptionMessage( '(TESTS cacti_hostsTemplates) Pas de template pour ce type de template : unitaires et preg_match : /^tests/' );
		$this->object ->retrouve_templateid_par_nom ( $dbCon, "unitaires", "/^tests/" );
	}

	/**
	 * @covers cacti_hostsTemplates::retrouve_templateid_par_nom
	 */
	public function testretrouve_templateid_par_nom_exception3() {
		$dbCon = $this ->createMock ( "requete_complexe_cacti" );
		$dbCon ->expects ( $this ->any () ) 
			->method ( 'requete_select_standard' ) 
			->will ( $this ->returnValue ( array ( 
				array ( 
						"id" => "123456", 
						"name" => "tests unitaires en cours" ) ) ) );
		
		$this ->expectException(Exception::class);
        $this->expectExceptionMessage( '(TESTS cacti_hostsTemplates) Pas de template pour ce type de template : unitaires et preg_match : /^tests sans pregmatch/' );
		$this->object ->retrouve_templateid_par_nom ( $dbCon, "unitaires", "/^tests sans pregmatch/" );
	}

	/**
	 * @covers cacti_hostsTemplates::retrouve_templateid_par_nom
	 */
	public function testretrouve_templateid_par_nom_valide() {
		$dbCon = $this ->createMock ( "requete_complexe_cacti" );
		$dbCon ->expects ( $this ->any () ) 
			->method ( 'requete_select_standard' ) 
			->will ( $this ->returnValue ( array ( 
				array ( 
						"id" => "123456", 
						"name" => "tests unitaires en cours" ) ) ) );
		
		$this ->assertFalse ( $this->object ->retrouve_templateid_par_nom ( $dbCon, "unitaires", "/^tests sans pregmatch/", false ) );
		$this ->assertEquals ( "123456", $this->object ->retrouve_templateid_par_nom ( $dbCon, "unitaires", "/^tests/" ) );
	}
}
?>
