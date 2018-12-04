<?php
namespace Zorille\framework;
use \Exception as Exception;
/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2014-08-25 at 17:17:12.
 */
if (! defined ( '__DOCUMENT_ROOT__' )) {
	require_once $_SERVER ["PWD"] . '/prepare.php';
}
class optionsTest extends MockedListeOptions {
	/**
     * @var options
     */
	protected $object;
	protected $fichier = "";
	protected $argc = 11;
	protected $argv = array ();

	/**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
	protected function setUp() {
	    ob_start ();
		$this->argv = array ( 
				"optionsTest.php", 
				"--champ1", 
				1, 
				"--paramT", 
				"--param1", 
				"valueA", 
				"valueB", 
				"valueC", 
				"valueD", 
				"valueE", 
				"--param2=value2", 
				"--param3", 
				"--verbose" );
		$datas = '<?xml version="1.0" encoding="UTF-8"?>
<xml>
	<simple_data sort_en_erreur="non">data1</simple_data>
	<dup_data>data2</dup_data>
	<dup_data>data3</dup_data>
	<node_vide></node_vide>
	<arraydatas>
		<serveurs  sort_en_erreur="non" using="oui">
			<!-- Commentaire -->
			<serveurTemplates>
				<host>10.10.10.10</host>
				<nom>NOMDETEST</nom>
				<nom>GROUPE_NOMS</nom>
				<hostname>localhost</hostname>
				<port>80</port>
    	
				<!-- Commentaire -->
				<includes>
					<global>/include/global.php</global>
					<local>/include/local.php</local>
				</includes>
			</serveurTemplates>
		</serveurs>
	</arraydatas>
</xml>';
		$this->fichier = "/tmp/testXml_" . getmypid () . ".xml";
		system ( "echo '" . $datas . "' > " . $this->fichier, $retour );
		$this->object = new options ( false, "TESTS options" );
		$this->object ->prepare_xml ();
	}

	/**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
	protected function tearDown() {
		system ( "rm -f /tmp/testXml_*", $retour );
		ob_end_clean ();
	}

	/**
	 * @covers Zorille\framework\options::retrouve_options_param
	 */
	public function testRetrouve_options_param_exception() {
		$this ->expectException(Exception::class);
        $this->expectExceptionMessage( '(TESTS options) Le nombre de parametres ne correspond pas pour optionsTest.php usage Error' );
		$this->object ->retrouve_options_param ( $this->argc, $this->argv, 49, 50, "usage Error", '/rep_framework' );
	}

	/**
	 * @covers Zorille\framework\options::retrouve_options_param
	 */
	public function testRetrouve_options_param_valide1() {
		$this ->assertSame ( $this->object, $this->object ->retrouve_options_param ( $this->argc, $this->argv, 1, 50, "usage Error", '/rep_framework' ) );
		$this ->assertEquals ( 
				array ( 
							'rep_scripts' => '.', 
							'netname' => php_uname ( "n" ), 
							'Erreur' => '', 
							'verbose' => '0', 
							'param1' => array ( 
									'valueA', 
									'valueB', 
									'valueC', 
									'valueD', 
									'valueE' ), 
							'param2' => 'value2', 
							'param3' => '', 
							'paramT' => '', 
							'rep_framework' => '/rep_framework', 
							'champ1' => '1' ), 
					$this->object ->getListeOption () );
	}

	/**
	 * @covers Zorille\framework\options::retrouve_options_param
	 */
	public function testRetrouve_options_param_valide2() {
		$argv = array ( 
				"file.php", 
				"--use_local_dir", 
				"--verbose" );
		$argc = 3;
		$this ->assertSame ( $this->object, $this->object ->retrouve_options_param ( $argc, $argv, 1, 50, "usage Error" ) );
		$this ->assertEquals ( array ( 
				'rep_scripts' => '.', 
				'netname' => php_uname ( "n" ), 
				'Erreur' => '', 
				'verbose' => '0', 
				'use_local_dir' => '', 
				'dossier_tempo' => posix_getcwd () ), $this->object ->getListeOption () );
	}

	/**
     * @covers Zorille\framework\options::gestion_des_confs_par_fichier
     * @covers Zorille\framework\options::_retrouveParamConf
     */
	public function testRecupere_fichier_conf() {
		$argv = array ( 
				"--conf", 
				$this->fichier, 
				"/dev/null" );
		$this ->assertSame ( $this->object, $this->object ->gestion_des_confs_par_fichier ( $argv ) );
		$this ->assertEquals ( array ( 
				$this->fichier => array ( 
						'nom' => $this->fichier, 
						'load' => false ), 
				'/dev/null' => array ( 
						'nom' => '/dev/null', 
						'load' => false ) ), $this->object ->getListeFichiersConf () );
		
		$argv = array ( 
				"optionsTest.php", 
				"--conf=" . $this->fichier, 
				"--dir_conf", 
				"/tmp", 
				"--verbose", 
				1 );
		
		$this->object ->setListeFichiersConf ( array () );
		$this ->assertSame ( $this->object, $this->object ->gestion_des_confs_par_fichier ( $argv ) );
		$this ->assertEquals ( array ( 
				$this->fichier => array ( 
						'nom' => $this->fichier, 
						'load' => false ) ), $this->object ->getListeFichiersConf () );
	}

	/**
     * @covers Zorille\framework\options::gestion_des_confs_par_fichier
     * @covers Zorille\framework\options::_retrouveParamConf
     */
	public function testRecupere_regexp_dossier_conf() {
		$this ->assertEquals ( "/.*_prod\.xml$/", $this->object ->getRegexpConfDir () );
		
		$argv = array ( 
				"--conf_regexp", 
				"/testXml_.*\.xml/", 
				"--param2=value2" );
		$this ->assertSame ( $this->object, $this->object ->gestion_des_confs_par_fichier ( $argv ) );
		$this ->assertEquals ( "/testXml_.*\.xml/", $this->object ->getRegexpConfDir () );
		
		$this->object ->setRegexpConfDir ( "" );
		$argv = array ( 
				"--conf_regexp=/testXml_.*\.xml/" );
		$this ->assertSame ( $this->object, $this->object ->gestion_des_confs_par_fichier ( $argv ) );
		$this ->assertEquals ( "/testXml_.*\.xml/", $this->object ->getRegexpConfDir () );
	}

	/**
     * @covers Zorille\framework\options::gestion_des_confs_par_fichier
     * @covers Zorille\framework\options::_retrouveParamConf
     */
	public function testRecupere_dossier_conf() {
		$this->object ->setRegexpConfDir ( "/testXml_.*\.xml/" );
		$argv = array ( 
				"--conf_dir", 
				"/tmp", 
				"--param2=value2" );
		$this ->assertSame ( $this->object, $this->object ->gestion_des_confs_par_fichier ( $argv ) );
		$this ->assertEquals ( array ( 
				$this->fichier => array ( 
						'nom' => $this->fichier, 
						'load' => false ) ), $this->object ->getListeFichiersConf () );
		
		$this->object ->setListeFichiersConf ( array () );
		$argv = array ( 
				"--conf_dir=/tmp" );
		$this ->assertSame ( $this->object, $this->object ->gestion_des_confs_par_fichier ( $argv ) );
		$this ->assertEquals ( array ( 
				$this->fichier => array ( 
						'nom' => $this->fichier, 
						'load' => false ) ), $this->object ->getListeFichiersConf () );
	}

	/**
     * @covers Zorille\framework\options::lit_dossier_conf
     */
	public function testLit_dossier_conf() {
		$this->object ->setRegexpConfDir ( "/testXml_.*\.xml/" );
		$this->object ->ajoute_Dossiers_conf ( "/tmp" );
		$this ->assertSame ( $this->object, $this->object ->lit_dossier_conf () );
		$this ->assertEquals ( array ( 
				$this->fichier => array ( 
						'nom' => $this->fichier, 
						'load' => false ) ), $this->object ->getListeFichiersConf () );
	}

	/**
	 * @covers Zorille\framework\options::ajouter_fichier_conf
	 */
	public function testAjouter_fichier_conf() {
		$this ->assertEquals ( array (), $this->object ->getListeFichiersConf () );
		$this ->assertSame ( $this->object, $this->object ->ajouter_fichier_conf ( $this->fichier ) );
		$this ->assertEquals ( array ( 
				$this->fichier => array ( 
						'nom' => $this->fichier, 
						'load' => true ) ), $this->object ->getListeFichiersConf () );
	}

	/**
	 * @covers Zorille\framework\options::parse_file_option
	 */
	public function testParse_file_option() {
		$this->object ->setListeFichiersConf ( array ( 
				$this->fichier => array ( 
						'nom' => $this->fichier, 
						'load' => false ) ) );
		$this ->assertSame ( $this->object, $this->object ->parse_file_option () );
		$this ->assertEquals ( array ( 
				$this->fichier => array ( 
						'nom' => $this->fichier, 
						'load' => true ) ), $this->object ->getListeFichiersConf () );
	}

	/**
     * @covers Zorille\framework\options::parse_ligne_option
     * @covers Zorille\framework\options::setOption
     */
	public function testParse_ligne_option_exception() {
		$argv = array ( 
				"fichier.php", 
				"-PARAM1", 
				"VALUE1", 
				"--param2=value2" );
		$this ->expectException(Exception::class);
        $this->expectExceptionMessage( '(TESTS options) Erreur de syntax dans vos options : -PARAM1 usage Error' );
		$this->object ->parse_ligne_option ( 4, $argv, "usage Error" );
	}

	/**
	 * @covers Zorille\framework\options::parse_ligne_option
	 * @covers Zorille\framework\options::_setOptionParDefaut
	 */
	public function testParse_ligne_option_valide() {
		$this ->assertSame ( $this->object, $this->object ->parse_ligne_option ( $this->argc, $this->argv, "usage Error" ) );
		$this ->assertEquals ( array ( 
				'verbose' => '0', 
				'param1' => array ( 
						'valueA', 
						'valueB', 
						'valueC', 
						'valueD', 
						'valueE' ), 
				'param2' => 'value2', 
				'param3' => '', 
				'paramT' => '', 
				'champ1' => '1' ), $this->object ->getListeOption () );
	}

	/**
     * @covers Zorille\framework\options::verifie_option_existe
     * @covers Zorille\framework\options::_trouvePosition0ption
     */
	public function testVerifie_option_existe() {
		$this->object ->ajouter_fichier_conf ( $this->fichier );
		$this ->assertFalse ( $this->object ->verifie_option_existe ( "NOTFOUND" ) );
		$this ->assertFalse ( $this->object ->verifie_option_existe ( "node_vide", true ) );
		$this ->assertTrue ( $this->object ->verifie_option_existe ( "node_vide" ) );
		$this ->assertFalse ( $this->object ->verifie_option_existe ( "host" ) );
		$this ->assertTrue ( $this->object ->verifie_option_existe ( array ( 
				"arraydatas", 
				"serveurs", 
				"serveurTemplates" ) ) );
	}

	/**
     * @covers Zorille\framework\options::setOption
     */
	public function testSetOption_exception() {
		$this ->expectException(Exception::class);
        $this->expectExceptionMessage( '(TESTS options) Le champ est nul.' );
		$this->object ->setOption ( "", "VALEUR" );
	}

	/**
	 * @covers Zorille\framework\options::setOption
	 */
	public function testSetOption_valide_string() {
		$this ->assertSame ( $this->object, $this->object ->setOption ( "CHAMP1", "&VALEUR1" ) );
		$this ->assertEquals ( "&VALEUR1", $this->object ->getOption ( "CHAMP1" ) );
		
		$this ->assertSame ( $this->object, $this->object ->setOption ( array ( 
				"CHAMP2", 
				"SOUSCHAMP1" ), "VALEUR2" ) );
		$this ->assertEquals ( "VALEUR2", $this->object ->getOption ( array ( 
				"CHAMP2", 
				"SOUSCHAMP1" ) ) );
		
		$this ->assertSame ( $this->object, $this->object ->setOption ( "CHAMP1", "VALEUR3", true ) );
		$this ->assertEquals ( array ( 
				"&VALEUR1", 
				"VALEUR3" ), $this->object ->getOption ( "CHAMP1" ) );
	}

	/**
	 * @covers Zorille\framework\options::setOption
	 */
	public function testSetOption_valide_array() {
		$this ->assertSame ( $this->object, $this->object ->setOption ( "CHAMP4", array ( 
				"VALEUR4" ) ) );
		$this ->assertEquals ( array ( 
				"VALEUR4" ), $this->object ->getOption ( "CHAMP4" ) );
		$this ->assertSame ( $this->object, $this->object ->setOption ( "CHAMP4", array ( 
				"VALEUR5" ) ) );
		$this ->assertEquals ( array ( 
				"VALEUR5" ), $this->object ->getOption ( "CHAMP4" ) );
	}

	/**
     * @covers Zorille\framework\options::supprime_option
     */
	public function testsupprime_option() {
		$this->object ->ajouter_fichier_conf ( $this->fichier );
		$nom = "arraydatas";
		$this ->assertSame ( $this->object, $this->object ->supprime_option ( $nom ) );
		$this ->assertEquals ( array ( 
				'simple_data' => 'data1', 
				'dup_data' => Array ( 
						'data2', 
						'data3' ), 
				'node_vide' => '' ), $this->object ->getListeOption () );
	}

	/**
     * @covers Zorille\framework\options::getOption
     * @covers Zorille\framework\options::_trouvePosition0ption
     */
	public function testGetOption() {
		$this->object ->ajouter_fichier_conf ( $this->fichier );
		$this->object ->setOption ( "CHAMP4", array ( 
				"VALEUR4" ) );
		
		$this->object ->setOption ( "CHAMP5", "VALEUR5" );
		$this->object ->setOption ( "CHAMP5", "VALEUR6", true );
		
		$this ->assertEquals ( "data1", $this->object ->getOption ( "simple_data" ) );
		$this ->assertEquals ( array ( 
				"VALEUR4" ), $this->object ->getOption ( "CHAMP4" ) );
		$this ->assertEquals ( "", $this->object ->getOption ( "node_vide" ) );
		$this ->assertEquals ( "", $this->object ->getOption ( "node_vide", true ) );
		$this ->assertEquals ( array ( 
				"VALEUR5", 
				"VALEUR6" ), $this->object ->getOption ( "CHAMP5" ) );
		
		$this ->assertFalse ( $this->object ->getOption ( "NOTEXIST" ) );
	}

	/**
     * @covers Zorille\framework\options::getListeOption
     */
	public function testgetListeOption() {
		$this->object ->setOption ( "CHAMP4", array ( 
				"VALEUR4" ) );
		$this ->assertSame ( $this->object, $this->object ->parse_ligne_option ( $this->argc, $this->argv, "usage Error" ) );
		$this ->assertEquals ( 
				array ( 
							'verbose' => '0', 
							'param1' => array ( 
									'valueA', 
									'valueB', 
									'valueC', 
									'valueD', 
									'valueE' ), 
							'param2' => 'value2', 
							'param3' => '', 
							'paramT' => '', 
							'champ1' => '1', 
							"CHAMP4" => array ( 
									"VALEUR4" ) ), 
					$this->object ->getListeOption () );
	}

	/**
	 * Implement testConstruit_parametre_standard().
	 */
	public function testConstruit_parametre_standard() {
		$this ->assertEquals ( array ( 
				"class" => "class", 
				"param" => "test_partie1", 
				"result" => "test" ), $this->object ->construit_parametre_standard ( "class[@test_partie1='test']" ) );
		
		//sans @ => false
		$this ->assertFalse ( $this->object ->construit_parametre_standard ( "class[test_partie1='test']" ) );
		//sans = => false
		$this ->assertFalse ( $this->object ->construit_parametre_standard ( "class[@test_partie1'test']" ) );
	}

	/**
	 * Implement testVerifie_parametre_standard().
	 */
	public function testVerifie_parametre_standard_paramXmlTrue() {
		//check la ligne de commande a partir d'un parametre --class_test_partie1 test
		$this->object ->setOption ( "class_test_partie1", 'test' );
		$this ->assertTrue ( $this->object ->verifie_parametre_standard ( "class[@test_partie1='test']" ) );
	}

	/**
	 * Implement testVerifie_parametre_standard().
	 */
	public function testVerifie_parametre_standard_paramXmlFalse() {
		$this->object ->setOption ( "class_test_partie1", 'test' );
		$this ->assertFalse ( $this->object ->verifie_parametre_standard ( "class[@test_partie1='testerreur']" ) );
	}

	/**
	 * Implement testVerifie_parametre_standard().
	 */
	public function testVerifie_parametre_standard_paramUnique() {
		//check la ligne de commande a partir d'un parametre class[@test_partie1='test']
		$this->object ->ajouter_fichier_conf ( $this->fichier );
		$this ->assertTrue ( $this->object ->verifie_parametre_standard ( "simple_data[@sort_en_erreur='non']" ) );
	}

	/**
	 * Implement testVerifie_parametre_standard().
	 */
	public function testVerifie_parametre_standard_False() {
		$this->object ->setOption ( "class_test_partie1", 'test' );
		//check sans la valeur par defaut
		$this ->assertFalse ( $this->object ->verifie_parametre_standard ( array ( 
				"classfalse", 
				"testfalse", 
				"partie1" ) ) );
		$this ->assertFalse ( $this->object ->verifie_parametre_standard ( "classfalse_testfalse='partie1'" ) );
	}

	/**
	 * Implement testConstruit_variable_ligne_commande_standard().
	 */
	public function testConstruit_variable_ligne_commande_standard() {
		$this ->assertEquals ( "class_test_partie1", $this->object ->construit_variable_ligne_commande_standard ( array ( 
				"class", 
				"test", 
				"partie1" ) ) );
	}

	/**
	 * Implement testVerifie_variables_standard().
	 */
	public function testVerifie_variable_standard_ligneCommande() {
		//check la ligne de commande a partir d'une ligne
		$this->object ->setOption ( "class_test_partie1", 'test' );
		$this ->assertEquals ( 1, $this->object ->verifie_variable_standard ( "class_test_partie1" ) );
		//check la ligne de commande a partir d'un tableau
	}

	/**
	 * Implement testVerifie_variables_standard().
	 */
	public function testVerifie_variable_standard_ligneCommandeParTableau() {
		//check la ligne de commande a partir d'un tableau
		$this->object ->setOption ( "class_test_partie1", 'test' );
		$this ->assertEquals ( 1, $this->object ->verifie_variable_standard ( array ( 
				"class", 
				"test", 
				"partie1" ) ) );
	}

	/**
	 * Implement testVerifie_variables_standard().
	 */
	public function testVerifie_variable_standard_XML() {
		//check le fichier XML
		$this->object ->setOption ( array ( 
				"class", 
				"test", 
				"partie1" ), 'test' );
		$this ->assertEquals ( 2, $this->object ->verifie_variable_standard ( array ( 
				"class", 
				"test", 
				"partie1" ) ) );
	}

	/**
	 * Implement testVerifie_variables_standard().
	 */
	public function testVerifie_variable_standard_false() {
		//check la valeur non existante
		$this ->assertFalse ( $this->object ->verifie_variable_standard ( array ( 
				"classfalse", 
				"testfalse", 
				"partie1" ) ) );
	}

	/**
	 * Implement testPrepare_variable_standard().
	 */
	public function testPrepare_variable_standard_ligneCommande() {
		$this->object ->setOption ( "class_test_partie1", 'test' );
		$this ->assertTrue ( $this->object ->prepare_variable_standard ( "class_test_partie1", "none" ) );
		$this ->assertEquals ( "test", $this->object ->getOption ( "class_test_partie1" ) );
	}

	/**
	 * Implement testPrepare_variable_standard().
	 */
	public function testPrepare_variable_standard_XML() {
		$this->object ->setOption ( array ( 
				"class", 
				"test", 
				"partie1" ), 'test' );
		$this ->assertTrue ( $this->object ->prepare_variable_standard ( array ( 
				"class", 
				"test", 
				"partie1" ), "none" ) );
		$this ->assertEquals ( "test", $this->object ->getOption ( array ( 
				"class", 
				"test", 
				"partie1" ) ) );
	}

	/**
	 * Implement testPrepare_variable_standard().
	 */
	public function testPrepare_variable_standard_valeurParDefaut() {
		$this ->assertTrue ( $this->object ->prepare_variable_standard ( array ( 
				"class", 
				"test", 
				"partie2" ), "none" ) );
		$this ->assertEquals ( "none", $this->object ->getOption ( array ( 
				"class", 
				"test", 
				"partie2" ) ) );
	}

	/**
	 * Implement testrenvoi_variables_standard().
	 */
	public function testrenvoi_variables_standard_ligneCommande() {
		//check la ligne de commande a partir d'une ligne
		$this->object ->setOption ( "class_test_partie1", 'test' );
		$this ->assertEquals ( 'test', $this->object ->renvoi_variables_standard ( "class_test_partie1" ) );
	}

	/**
	 * Implement testrenvoi_variables_standard().
	 */
	public function testrenvoi_variables_standard_ligneCommandeParTableau() {
		//check la ligne de commande a partir d'un tableau
		$this->object ->setOption ( "class_test_partie1", 'test' );
		$this ->assertEquals ( 'test', $this->object ->renvoi_variables_standard ( array ( 
				"class", 
				"test", 
				"partie1" ) ) );
	}

	/**
	 * Implement testrenvoi_variables_standard().
	 */
	public function testrenvoi_variables_standard_XML() {
		//check le fichier XML
		$this->object ->setOption ( array ( 
				"class", 
				"test", 
				"partie1" ), 'test' );
		$this ->assertEquals ( 'test', $this->object ->renvoi_variables_standard ( array ( 
				"class", 
				"test", 
				"partie1" ) ) );
	}

	/**
	 * Implement testrenvoi_variables_standard().
	 */
	public function testrenvoi_variables_standard_ValeurDefaut() {
		//check la valeur false
		$this ->assertEquals ( 'defaut', $this->object ->renvoi_variables_standard ( array ( 
				"classfalse", 
				"testfalse", 
				"partie1" ), "defaut" ) );
	}

	/**
	 * Implement testrenvoi_variables_standard().
	 */
	public function testrenvoi_variables_standard_false() {
		//check la valeur false
		$this ->assertFalse ( $this->object ->renvoi_variables_standard ( array ( 
				"classfalse", 
				"testfalse", 
				"partie1" ) ) );
	}
}
