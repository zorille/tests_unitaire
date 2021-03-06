<?php
namespace Zorille\framework;
/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2014-08-25 at 17:26:39.
 */
if (! defined ( '__DOCUMENT_ROOT__' )) {
	require_once $_SERVER ["PWD"] . '/prepare.php';
}
class socket_serveurTest extends MockedListeOptions {
	/**
     * @var socket_serveur
     */
	protected $object;

	/**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
	protected function setUp() {
		ob_start ();
		$this->object = new socket_serveur ( "/tmp/zsocket.sock", "", "unix", false, "TESTS socket_serveur" );
	}

	/**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
	protected function tearDown() {
		ob_end_clean ();
	}

	/**
     * @covers Zorille\framework\socket_serveur::close_connexion
     */
	public function testClose_connexion() {
		$this->assertSame ( $this->object, $this->object->close_connexion ( ) );
	}
}
