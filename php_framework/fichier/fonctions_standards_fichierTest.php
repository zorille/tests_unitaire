<?php
/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2014-08-25 at 17:07:23.
 */
if (! defined ( '__DOCUMENT_ROOT__' )) {
	require_once $_SERVER ["PWD"] . '/prepare.php';
}
class fonctions_standards_fichierTest extends MockedListeOptions {
	/**
     * @var fonctions_standards_fichier
     */
	protected $object;

	/**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
	protected function setUp() {
		ob_start ();
		$this->object = new fonctions_standards_fichier ( false, "TESTS fonctions_standards_fichier" );
	}

	/**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
	protected function tearDown() {
		ob_end_clean ();
	}

	/**
     * @covers fonctions_standards_fichier::structure_fichier_standard
     */
	public function testStructure_fichier_standard() {
		$this->assertEquals ( array (
				'nom' => 'NOM1',
				'dossier' => '',
				'type' => 'TYPE1',
				'mandatory' => false,
				'telecharger' => false 
		), $this->object->structure_fichier_standard("NOM1", "TYPE1") );
	}
}
