<?php
/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2014-08-25 at 16:54:34.
 */
if (! defined ( '__DOCUMENT_ROOT__' )) {
	require_once $_SERVER ["PWD"] . '/prepare.php';
}
require_once "cacti_API_fonctions.php";
class cacti_graphsTest extends MockedListeOptions {
	/**
     * @var cacti_graphs
     */
	protected $object;

	/**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
	protected function setUp() {
		ob_start ();
		$this->object = new cacti_graphs ( false, "TESTS cacti_graphs" );
	}

	/**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
	protected function tearDown() {
		ob_end_clean ();
	}

	/**
     * @covers cacti_graphs::charge_graphs
     */
	public function testCharge_graphs() {
		$this->assertSame ( $this->object, $this->object->charge_graphs () );
		$this->assertEquals ( array (
				'1' => array (
						'id' => 1,
						"graph_tree_id" => 10,
						'name' => 'd1' 
				),
				'2' => array (
						'id' => 2,
						"graph_tree_id" => 20,
						'name' => 'd2' 
				) 
		), $this->object->getGraphIds () );
	}

	/**
     * @covers cacti_graphs::valide_graph_by_id
     */
	public function testValide_graph_by_id() {
		$this->object->setGraphIds ( array (
				'1' => array (
						'id' => 1,
						'name' => 'd1' 
				) 
		) );
		
		$this->assertFalse ( $this->object->valide_graph_by_id ( 2 ) );
		$this->assertTrue ( $this->object->valide_graph_by_id ( 1 ) );
	}
}
