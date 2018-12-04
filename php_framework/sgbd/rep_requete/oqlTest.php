<?php
namespace Zorille\framework;
use \Exception as Exception;
/**
 * @ignore
 */
if (! defined ( '__DOCUMENT_ROOT__' )) {
	require_once $_SERVER ["PWD"] . '/prepare.php';
}

require_once __DOCUMENT_ROOT__ . '/sgbd/rep_requete/Zorille_framework_oql.class.php';
use Zorille\framework;

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2014-06-04 at 12:16:00.
 */
class oqlTest extends MockedListeOptions {
	/**
     * @var oql
     */
	protected $object;

	/**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
	protected function setUp() {
		ob_start ();
		$this->object = new oql ( false, "TESTS oql" );
	}

	/**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
	protected function tearDown() {
		ob_end_clean ();
	}

	/**
     * @covers Zorille\framework\oql::creer_select
     * Implement testCreer_select().
     */
	public function testCreer_select_String() {
		$this->object->creer_select ( "from1", "test1='oui'", "ORDER BY champ1" );
		$this->assertEquals ( "SELECT from1  WHERE test1='oui' ORDER BY champ1 ", $this->object->getRequete () );
	}
	
	/**
	 * @covers Zorille\framework\oql::creer_select
	 * Implement testCreer_select().
	 */
	public function testCreer_select_array() {
		$this ->expectException(Exception::class);
        $this->expectExceptionMessage( '(TESTS oql) Le FROM ne peut pas etre un tableau' );
		$this->object->creer_select ( array (
				"from1",
				"from2"
		), array (
				"test1='oui'",
				"test2='non'"
		) );
	}

	/**
     * @covers Zorille\framework\oql::creer_from_join
     * Implement testCreer_from_join().
     */
	public function testCreer_from_join_from_array() {
		$this ->expectException(Exception::class);
        $this->expectExceptionMessage( '(TESTS oql) Il ne peux y avoir qu\'un FROM en OQL' );
		$this->object->creer_from_join ( array (
				"from1",
				"from2" 
		) );
	}
	
	/**
	 * @covers Zorille\framework\oql::creer_from_join
	 * Implement testCreer_from_join().
	 */
	public function testCreer_from_join() {
		$this->assertEquals ( "", $this->object->creer_from_join ( "" ) );
		$this->assertEquals ( "from1 JOIN from2 ON champ1=champ2", $this->object->creer_from_join ( array (
				"from1",
				array (
						"type" => "BOTH",
						"table" => "from2",
						"champ1" => "champ1",
						"champ2" => "champ2"
				)
		) ) );
		$this->assertEquals ( "from1 JOIN from2 ON champ1 BELOW champ2", $this->object->creer_from_join ( array (
				"from1",
				array (
						"type" => "BELOW",
						"table" => "from2",
						"champ1" => "champ1",
						"champ2" => "champ2"
				)
		) ) );
		$this->assertEquals ( "from1 JOIN from2 ON champ1 BELOW STRICT champ2", $this->object->creer_from_join ( array (
				"from1",
				array (
						"type" => "BELOW STRICT",
						"table" => "from2",
						"champ1" => "champ1",
						"champ2" => "champ2"
				)
		) ) );
		$this->assertEquals ( "from1 JOIN from2 ON champ1 ABOVE champ2", $this->object->creer_from_join ( array (
				"from1",
				array (
						"type" => "ABOVE",
						"table" => "from2",
						"champ1" => "champ1",
						"champ2" => "champ2"
				)
		) ) );
		$this->assertEquals ( "from1 JOIN from2 ON champ1 ABOVE STRICT champ2", $this->object->creer_from_join ( array (
				"from1",
				array (
						"type" => "ABOVE STRICT",
						"table" => "from2",
						"champ1" => "champ1",
						"champ2" => "champ2"
				)
		) ) );
	}
}
