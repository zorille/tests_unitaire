<?php
namespace Zorille\framework;
use \Exception as Exception;
/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2014-08-25 at 16:46:54.
 */
if (! defined ( '__DOCUMENT_ROOT__' )) {
	require_once $_SERVER ["PWD"] . '/prepare.php';
}
require_once "cacti_API_fonctions.php";
class cacti_addTreeTest extends MockedListeOptions {
	/**
     * @var cacti_addTree
     */
	protected $object;

	/**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
	protected function setUp() {
		ob_start ();
		
		$cacti_graphTreeItems = $this ->createMock('Zorille\framework\cacti_graphTreeItems' );
		$cacti_hosts = $this ->createMock('Zorille\framework\cacti_hosts' );
		$cacti_graphs = $this ->createMock('Zorille\framework\cacti_graphs' );
		$this->object = new cacti_addTree ( false, "TESTS cacti_addTree" );
		
		$this->object ->setGraphTreesItemData ( $cacti_graphTreeItems ) 
			->setHostData ( $cacti_hosts ) 
			->setGraphsData ( $cacti_graphs );
	}

	/**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
	protected function tearDown() {
		ob_end_clean ();
	}

	/**
     * @covers Zorille\framework\cacti_addTree::valide_ParentNode
     */
	public function testValide_ParentNode() {
		$this->object ->getGraphTreesItemData () 
			->expects ( $this ->any () ) 
			->method ( 'getGraphTreeItems' ) 
			->will ( $this ->returnValue ( array ( 
				1, 
				2 ) ) );
		$this ->assertFalse ( $this->object ->valide_ParentNode () );
	}

	/**
     * @covers Zorille\framework\cacti_addTree::executeAdd_tree
     */
	public function testExecuteAdd_tree_exception1() {
		$this ->expectException(Exception::class);
        $this->expectExceptionMessage( '(TESTS cacti_addTree) Il faut un nom.' );
		$this->object ->executeAdd_tree ();
	}

	/**
	 * @covers Zorille\framework\cacti_addTree::executeAdd_tree
	 */
	public function testExecuteAdd_tree_exception2() {
		$this->object ->setName ( "d1" );
		$this->object ->setTrees ( array ( 
				'1' => array ( 
						'id' => 1, 
						"graph_tree_id" => 10, 
						'name' => 'd1' ), 
				'2' => array ( 
						'id' => 2, 
						"graph_tree_id" => 20, 
						'name' => 'd2' ) ) );
		$this ->expectException(Exception::class);
        $this->expectExceptionMessage( '(TESTS cacti_addTree) Doublon de tree en base.' );
		$this->object ->executeAdd_tree ();
	}

	/**
	 * @covers Zorille\framework\cacti_addTree::executeAdd_tree
	 */
	public function testExecuteAdd_tree_valide() {
		$this->object ->setTrees ( array ( 
				'1' => array ( 
						'id' => 1, 
						"graph_tree_id" => 10, 
						'name' => 'd1' ), 
				'2' => array ( 
						'id' => 2, 
						"graph_tree_id" => 20, 
						'name' => 'd2' ) ) );
		$this->object ->setName ( "d3" );
		$this ->assertEquals ( 10, $this->object ->executeAdd_tree () );
	}

	/**
     * @covers Zorille\framework\cacti_addTree::executeAdd_node
     */
	public function testExecuteAdd_node_exception1() {
		$this ->expectException(Exception::class);
        $this->expectExceptionMessage( '(TESTS cacti_addTree) Il faut un NodeType.' );
		$this->object ->executeAdd_node ();
	}

	/**
	 * @covers Zorille\framework\cacti_addTree::executeAdd_node
	 */
	public function testExecuteAdd_node_exception2() {
		$this ->expectException(Exception::class);
        $this->expectExceptionMessage( '(TESTS cacti_addTree) Ce typde de node n\'existe pas : TYPE' );
		$this->object ->setNodeType ( "TYPE" );
	}

	/**
	 * @covers Zorille\framework\cacti_addTree::executeAdd_node
	 */
	public function testExecuteAdd_node_exception3() {
		$this->object ->setNodeType ( "header" );
		$this->object ->getGraphTreesItemData () 
			->expects ( $this ->any () ) 
			->method ( 'getGraphTreeItems' ) 
			->will ( $this ->returnValue ( array ( 
				1, 
				2 ) ) );
		$this ->expectException(Exception::class);
        $this->expectExceptionMessage( '(TESTS cacti_addTree) Il faut un Parent Node valide.' );
		$this->object ->executeAdd_node ();
	}

	/**
	 * @covers Zorille\framework\cacti_addTree::executeAdd_node
	 */
	public function testExecuteAdd_node_exception4() {
		$this->object ->setNodeType ( "header" );
		$this->object ->getGraphTreesItemData () 
			->expects ( $this ->any () ) 
			->method ( 'getGraphTreeItems' ) 
			->will ( $this ->returnValue ( array ( 
				1, 
				2 ) ) );
		$this->object ->setTreeId ( 1 );
		$this ->expectException(Exception::class);
        $this->expectExceptionMessage( '(TESTS cacti_addTree) Il faut un Nom.' );
		$this->object ->executeAdd_node ();
	}

	/**
	 * @covers Zorille\framework\cacti_addTree::executeAdd_node
	 */
	public function testExecuteAdd_node_exception5() {
		$this->object ->setNodeType ( "header" );
		$this->object ->getGraphTreesItemData () 
			->expects ( $this ->any () ) 
			->method ( 'getGraphTreeItems' ) 
			->will ( $this ->returnValue ( array ( 
				1, 
				2 ) ) );
		$this->object ->setTreeId ( 1 );
		$this->object ->setName ( 'NOM1' );
		$this->object ->executeAdd_node ();
		
		$this->object ->setNodeType ( 'graph' );
		$this ->expectException(Exception::class);
        $this->expectExceptionMessage( '(TESTS cacti_addTree) Il faut un rra-id > 0.' );
		$this->object ->executeAdd_node ();
	}

	/**
	 * @covers Zorille\framework\cacti_addTree::executeAdd_node
	 */
	public function testExecuteAdd_node_exception6() {
		$this->object ->setNodeType ( "header" );
		$this->object ->getGraphTreesItemData () 
			->expects ( $this ->any () ) 
			->method ( 'getGraphTreeItems' ) 
			->will ( $this ->returnValue ( array ( 
				1, 
				2 ) ) );
		$this->object ->setTreeId ( 1 );
		$this->object ->setName ( 'NOM1' );
		$this->object ->executeAdd_node ();
		$this->object ->setNodeType ( 'graph' );
		$this->object ->setRraId ( 'weekly' );
		$this ->expectException(Exception::class);
        $this->expectExceptionMessage( '(TESTS cacti_addTree) Le graph Id n\'est pas valide.' );
		$this->object ->executeAdd_node ();
	}

	/**
	 * @covers Zorille\framework\cacti_addTree::executeAdd_node
	 */
	public function testExecuteAdd_node_valide1() {
		$this->object ->setNodeType ( "header" );
		$this->object ->getGraphTreesItemData () 
			->expects ( $this ->any () ) 
			->method ( 'getGraphTreeItems' ) 
			->will ( $this ->returnValue ( array ( 
				1, 
				2 ) ) );
		$this->object ->setTreeId ( 1 );
		$this->object ->setName ( 'NOM1' );
		$this->object ->executeAdd_node ();
		$this->object ->setNodeType ( 'graph' );
		$this->object ->setRraId ( 'weekly' );
		$this->object ->getGraphsData () 
			->expects ( $this ->any () ) 
			->method ( 'valide_graph_by_id' ) 
			->will ( $this ->returnValue ( true ) );
		$this ->assertEquals ( "15", $this->object ->executeAdd_node ());
	}

	/**
	 * @covers Zorille\framework\cacti_addTree::executeAdd_node
	 */
	public function testExecuteAdd_node_exception8() {
		$this->object ->setNodeType ( "header" );
		$this->object ->getGraphTreesItemData () 
			->expects ( $this ->any () ) 
			->method ( 'getGraphTreeItems' ) 
			->will ( $this ->returnValue ( array ( 
				1, 
				2 ) ) );
		$this->object ->setTreeId ( 1 );
		$this->object ->setName ( 'NOM1' );
		$this->object ->executeAdd_node ();
		$this->object ->setNodeType ( 'graph' );
		$this->object ->setRraId ( 'weekly' );
		$this->object ->getGraphsData () 
			->expects ( $this ->any () ) 
			->method ( 'valide_graph_by_id' ) 
			->will ( $this ->returnValue ( true ) );
		$this->object ->setNodeType ( 'host' );
		$this ->expectException(Exception::class);
        $this->expectExceptionMessage( '(TESTS cacti_addTree) Il faut un host Id valide.' );
		$this->object ->executeAdd_node ();
	}

	/**
	 * @covers Zorille\framework\cacti_addTree::executeAdd_node
	 */
	public function testExecuteAdd_node_valide2() {
		$this->object ->setNodeType ( "header" );
		$this->object ->getGraphTreesItemData () 
			->expects ( $this ->any () ) 
			->method ( 'getGraphTreeItems' ) 
			->will ( $this ->returnValue ( array ( 
				1, 
				2 ) ) );
		$this->object ->setTreeId ( 1 );
		$this->object ->setName ( 'NOM1' );
		$this->object ->executeAdd_node ();
		$this->object ->setNodeType ( 'graph' );
		$this->object ->setRraId ( 'weekly' );
		$this->object ->getGraphsData () 
			->expects ( $this ->any () ) 
			->method ( 'valide_graph_by_id' ) 
			->will ( $this ->returnValue ( true ) );
		$this->object ->setNodeType ( 'host' );
		$this->object ->getHostData () 
			->expects ( $this ->any () ) 
			->method ( 'valide_host_by_id' ) 
			->will ( $this ->returnValue ( true ) );
		$this ->assertEquals ( 15, $this->object ->executeAdd_node () );
	}

	/**
     * @covers Zorille\framework\cacti_addTree::executeCacti_addTree
     */
	public function testExecuteCacti_addTree_exception1() {
		$this ->expectException(Exception::class);
        $this->expectExceptionMessage( '(TESTS cacti_addTree) Ce type n\'existe pas : ' );
		$this->object ->executeCacti_addTree ();
	}

	/**
	 * @covers Zorille\framework\cacti_addTree::executeCacti_addTree
	 */
	public function testExecuteCacti_addTree_valide() {
		$this->object ->setType ( 'tree' );
		$this->object ->setTrees ( array ( 
				'1' => array ( 
						'id' => 1, 
						"graph_tree_id" => 10, 
						'name' => 'd1' ), 
				'2' => array ( 
						'id' => 2, 
						"graph_tree_id" => 20, 
						'name' => 'd2' ) ) );
		$this->object ->setName ( "d3" );
		$this ->assertEquals ( 10, $this->object ->executeCacti_addTree () );
		
		$this->object ->setType ( 'node' );
		$this->object ->setTreeId ( 1 );
		$this->object ->setNodeType ( 'graph' );
		$this->object ->setRraId ( 'weekly' );
		$this->object ->getGraphTreesItemData () 
			->expects ( $this ->any () ) 
			->method ( 'getGraphTreeItems' ) 
			->will ( $this ->returnValue ( array ( 
				1, 
				2 ) ) );
		$this->object ->getGraphsData () 
			->expects ( $this ->any () ) 
			->method ( 'valide_graph_by_id' ) 
			->will ( $this ->returnValue ( true ) );
		$this ->assertEquals ( 15, $this->object ->executeCacti_addTree () );
	}

	/**
     * @covers Zorille\framework\cacti_addTree::reset_host
     */
	public function testReset_host() {
		$this ->assertTrue ( $this->object ->reset_host () );
	}
}
