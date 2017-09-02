<?php
/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2014-08-25 at 17:26:39.
 */
if (! defined ( '__DOCUMENT_ROOT__' )) {
	require_once $_SERVER ["PWD"] . '/prepare.php';
}
class ftpTest extends MockedListeOptions {
	/**
     * @var ftp
     */
	protected $object;

	/**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
	protected function setUp() {
		ob_start ();
		$this->object = new ftp ( "USER", "PASS", false, 21, 30, 'TESTS ftp' );
	}

	/**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
	protected function tearDown() {
		ob_end_clean ();
	}

	/**
     * @covers ftp::verifie_connexion
     */
	public function testVerifie_connexion_Exception() {
		$this ->expectException(Exception::class);
        $this->expectExceptionMessage( '(TESTS ftp) Erreur la connexion n\'existe pas' );
		$this->object ->verifie_connexion ();
	}

	/**
	 * @covers ftp::verifie_connexion
	 */
	public function testVerifie_connexion_False() {
		$this ->assertFalse ( $this->object ->verifie_connexion ( false ) );
	}
}