<?php
namespace Zorille\framework;
use \Exception as Exception;
use \PDOException as PDOException;
/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2014-08-26 at 11:31:40.
 */
if (! defined ( '__DOCUMENT_ROOT__' )) {
	require_once $_SERVER ["PWD"] . '/prepare.php';
}
class PDO_localTest extends MockedListeOptions {
	/**
     * @var PDO_local
     */
	protected $object;

	/**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
	protected function setUp() {
		ob_start ();
		$this->object = new PDO_local ( false, "TESTS PDO_local" );
	}

	/**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
	protected function tearDown() {
		ob_end_clean ();
	}

	/**
	 * @covers Zorille\framework\PDO_local::connexion
	 */
	public function testConnexion_Exception() {
	    $this ->expectException(PDOException::class);
	    $this->expectExceptionMessage('invalid data source name' );
		$this->object ->connexion ( "nodb", "", "", array () );
	}

	/**
	 * @covers Zorille\framework\PDO_local::connexion
	 */
	public function testConnexion_Exception2() {
	    $this ->expectException(PDOException::class);
	    $this->expectExceptionMessage('invalid data source name' );
		$this->object ->connexion ( "nodb", "user", "pass", array () );
	}
}
