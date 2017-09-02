<?php
/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2014-08-25 at 16:53:53.
 */
if (! defined ( '__DOCUMENT_ROOT__' )) {
	require_once $_SERVER ["PWD"] . '/prepare.php';
}
require_once "cacti_API_fonctions.php";
class cacti_graphTreeItemsTest extends MockedListeOptions {
	/**
     * @var cacti_graphTreeItems
     */
	protected $object;

	/**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
	protected function setUp() {
		ob_start ();
		$this->object = new cacti_graphTreeItems ( false, "TESTS cacti_graphTreeItems" );
	}

	/**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
	protected function tearDown() {
		ob_end_clean ();
	}

	/**
     * @covers cacti_graphTreeItems::charge_graphTreeItems
     */
	public function testCharge_graphTreeItems() {
		$this->assertSame ( $this->object, $this->object->charge_graphTreeItems () );
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
		), $this->object->getGraphTreeItems () );
	}

	/**
     * @covers cacti_graphTreeItems::valide_graphTreeItem_by_tree_id
     */
	public function testValide_graphTreeItem_by_tree_id() {
		$this->object->setGraphTreeItems ( array (
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
		) );
		$this->assertFalse ( $this->object->valide_graphTreeItem_by_tree_id ( "NOM" ) );
		$this->assertTrue ( $this->object->valide_graphTreeItem_by_tree_id ( "d1" ) );
	}

	/**
     * @covers cacti_graphTreeItems::valide_graphTreeItem_by_id
     */
	public function testValide_graphTreeItem_by_id() {
		$this->object->setGraphTreeItems ( array (
				'1' => array (),
				
				'2' => array () 
		) );
		$this->assertFalse ( $this->object->valide_graphTreeItem_by_id ( 3 ) );
		$this->assertTrue ( $this->object->valide_graphTreeItem_by_id ( 1 ) );
	}
}