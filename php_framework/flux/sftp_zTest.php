<?php
/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2014-08-25 at 17:29:51.
 */
if (! defined ( '__DOCUMENT_ROOT__' )) {
	require_once $_SERVER ["PWD"] . '/prepare.php';
}
class sftp_zTest extends MockedListeOptions {
	/**
     * @var sftp_z
     */
	protected $object;

	/**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
	protected function setUp() {
		ob_start ();
		$this->object = new sftp_z ( false, "TESTS sftp_z" );
	}

	/**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
	protected function tearDown() {
		ob_end_clean ();
	}

	/**
     * @covers sftp_z::tester_sftp_existe
     */
	public function testTester_sftp_existe_False() {
		$this->assertFalse ( $this->object->tester_sftp_existe (  ) );
	}
	
	/**
	 * @covers sftp_z::tester_sftp_existe
	 */
	public function testTester_sftp_existe_True() {
		$this->object->setSftpConnexion(true);
		$this->assertTrue ( $this->object->tester_sftp_existe (  ) );
	}
}
