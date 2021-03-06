<?php
namespace Zorille\framework;
/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2014-08-26 at 10:24:49.
 */
if (! defined ( '__DOCUMENT_ROOT__' )) {
	require_once $_SERVER ["PWD"] . '/prepare.php';
}
class mem_messageTest extends MockedListeOptions {
	/**
     * @var mem_message
     */
	protected $object;

	/**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
	protected function setUp() {
		ob_start ();
		$this->object = new mem_message ( "KEY", false, 'TESTS mem_message' );
		/********************************************/
		/* CLASS IMPOSSIBLE EN TESTS UNITAIRES      */
		/********************************************/
	}

	/**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
	protected function tearDown() {
		ob_end_clean ();
	}

	/**
	 * @covers Zorille\framework\mem_message::calcul_taille
	 */
	public function testcalcul_taille() {
		$this->assertEquals ( 68,$this->object->calcul_taille ( 'donnees de taille connue' ));
	}
}
