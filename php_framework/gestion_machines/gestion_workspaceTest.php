<?php
/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2014-08-26 at 11:02:26.
 */
if (! defined ( '__DOCUMENT_ROOT__' )) {
	require_once $_SERVER ["PWD"] . '/prepare.php';
}
class gestion_workspaceTest extends MockedListeOptions {
	/**
     * @var gestion_workspace
     */
	protected $object;

	/**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
	protected function setUp() {
		ob_start ();
		$this->object = new gestion_workspace ( false, 'TESTS gestion_workspace' );
		$this->object ->setListeOptions ( $this ->getListeOption () );
	}

	/**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
	protected function tearDown() {
		ob_end_clean ();
	}

	/**
     * @covers gestion_workspace::creer_workspace
     */
	public function testCreer_workspace_True() {
		$this->object ->getListeOptions () 
			->expects ( $this ->any () ) 
			->method ( 'verifie_option_existe' ) 
			->will ( $this ->returnValue ( false ) );
		$this ->assertSame ( $this->object, $this->object ->creer_workspace () );
		$this ->assertContains ( "Tests_unitaire", $this->object ->getAllWorkspace () );
	}

	/**
	 * @covers gestion_workspace::creer_workspace
	 */
	public function testCreer_workspace_Exception() {
		$this->object ->getListeOptions () 
			->expects ( $this ->any () ) 
			->method ( 'verifie_option_existe' ) 
			->will ( $this ->returnValue ( true ) );
		$this->object ->getListeOptions () 
			->expects ( $this ->any () ) 
			->method ( 'getOption' ) 
			->will ( $this ->returnValue ( array () ) );
		
		$this ->expectException(Exception::class);
        $this->expectExceptionMessage( '(TESTS gestion_workspace) La definition du workspace est fausse.' );
		$this->object ->creer_workspace ();
	}

	/**
	 * @covers gestion_workspace::creer_workspace
	 */
	public function testCreer_workspace_cli() {
		$this->object ->getListeOptions () 
			->expects ( $this ->any () ) 
			->method ( 'verifie_option_existe' ) 
			->will ( $this ->returnValue ( true ) );
		$this->object ->getListeOptions () 
			->expects ( $this ->any () ) 
			->method ( 'getOption' ) 
			->will ( $this ->returnValue ( "/WORKSPACE" ) );
		
		$this ->assertSame ( $this->object, $this->object ->creer_workspace () );
		$this ->assertEquals ( "/WORKSPACE", $this->object ->getAllWorkspace () );
	}

	/**
	 * @covers gestion_workspace::creer_workspace
	 */
	public function testCreer_workspace_xml() {
		$this->object ->getListeOptions () 
			->expects ( $this ->any () ) 
			->method ( 'verifie_option_existe' ) 
			->will ( $this ->returnValue ( true ) );
		$this->object ->getListeOptions () 
			->expects ( $this ->any () ) 
			->method ( 'getOption' ) 
			->will ( $this ->returnValue ( array ( 
				"liste_workspace" => array ( 
						"TYPE1" => array ( 
								"dossier_source" => "/WORKSPACE1" ), 
						"TYPE2" => array ( 
								"dossier_source" => "/WORKSPACE2" ) ) ) ) );
		
		$this ->assertSame ( $this->object, $this->object ->creer_workspace () );
		$this ->assertEquals ( "/WORKSPACE1", $this->object ->getTypeWorkspace ( "TYPE1" ) );
		$this ->assertEquals ( "/WORKSPACE2", $this->object ->getTypeWorkspace ( "TYPE2" ) );
	}

	/**
     * @covers gestion_workspace::supprime_workspace
     */
	public function testSupprime_workspace_Exception() {
		$this->object ->setAllWorkspace ( "/dev/null" );
		$this ->expectException(Exception::class);
        $this->expectExceptionMessage( '(TESTS gestion_workspace) Le dossier : /dev/null ne peut pas etre supprime.' );
		$this->object ->supprime_workspace ();
	}

	/**
	 * @covers gestion_workspace::supprime_workspace
	 */
	public function testSupprime_workspace_valide() {
		system ( "mkdir /tmp/TEST_workspace", $retour );
		$this->object ->setAllWorkspace ( "/tmp/TEST_workspace" );
		$this ->assertSame ( $this->object, $this->object ->supprime_workspace () );
	}
}
