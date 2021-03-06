<?php
namespace Zorille\framework;
use \Exception as Exception;
/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2014-08-26 at 10:24:48.
 */
if (! defined ( '__DOCUMENT_ROOT__' )) {
	require_once $_SERVER ["PWD"] . '/prepare.php';
}
class fonctions_standards_forkTest extends MockedListeOptions {
	/**
     * @var fonctions_standards_fork
     */
	protected $object;

	/**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
	protected function setUp() {
		ob_start ();
		$this->object = new fonctions_standards_fork ( false, 'TESTS fonctions_standards_fork' );
	}

	/**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
	protected function tearDown() {
		ob_end_clean ();
	}

	/**
     * @covers Zorille\framework\fonctions_standards_fork::check_process_fils
     */
	public function testCheck_process_fils_False() {
		$liste_fork = array ();
		$this ->assertFalse ( $this->object ->check_process_fils ( $liste_fork, true ) );
	}

	/**
	 * @covers Zorille\framework\fonctions_standards_fork::check_process_fils
	 */
	public function testCheck_process_fils_attend_fin_fork() {
		$liste_fork = $this ->createMock('Zorille\framework\groupe_forks' );
		$liste_fork ->expects ( $this ->any () ) 
			->method ( 'wait_all_children' ) 
			->will ( $this ->returnValue ( true ) );
		$this ->assertTrue ( $this->object ->check_process_fils ( $liste_fork, true ) );
	}

	/**
	 * @covers Zorille\framework\fonctions_standards_fork::check_process_fils
	 */
	public function testCheck_process_fils_not_attend_fin_fork() {
		$liste_fork = $this ->createMock('Zorille\framework\groupe_forks' );
		$liste_fork ->expects ( $this ->any () ) 
			->method ( 'wait_one_of_all_children' ) 
			->will ( $this ->returnValue ( true ) );
		$this ->assertTrue ( $this->object ->check_process_fils ( $liste_fork, false ) );
	}

	/**
     * @covers Zorille\framework\fonctions_standards_fork::gestion_process_fils
     */
	public function testGestion_process_fils_False() {
		$liste_fork = array ();
		$this ->assertFalse ( $this->object ->gestion_process_fils ( $liste_fork, "MESSAGE", true ) );
	}

	/**
	 * @covers Zorille\framework\fonctions_standards_fork::gestion_process_fils
	 */
	public function testGestion_process_fils_Exception() {
		$liste_fork = $this ->createMock('Zorille\framework\groupe_forks' );
		$liste_fork ->expects ( $this ->any () ) 
			->method ( 'wait_all_children' ) 
			->will ( $this ->returnValue ( true ) );
		groupe_forks::setCodeRetour ( "NAME", 10000 );
		$this ->expectException(Exception::class);
        $this->expectExceptionMessage( '(TESTS fonctions_standards_fork) Probleme lors MESSAGE : NAME avec le code_retour : 39 .' );
		$this->object ->gestion_process_fils ( $liste_fork, "MESSAGE", true );
	}

	/**
	 * @covers Zorille\framework\fonctions_standards_fork::gestion_process_fils
	 */
	public function testGestion_process_fils_True() {
		$liste_fork = $this ->createMock('Zorille\framework\groupe_forks' );
		$liste_fork ->expects ( $this ->any () ) 
			->method ( 'wait_all_children' ) 
			->will ( $this ->returnValue ( true ) );
		groupe_forks::setCodeRetour ( "NAME", 1 );
		$this ->assertEquals ( Array ( 
				'NAME' => 0 ), $this->object ->gestion_process_fils ( $liste_fork, "MESSAGE", true ) );
	}
}
