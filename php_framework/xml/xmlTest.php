<?php
namespace Zorille\framework;
use \Exception as Exception;
use \stdClass as stdClass;
Use \SimpleXMLElement as SimpleXMLElement;
use \DOMNodeList as DOMNodeList;
use \DOMElement as DOMElement;
/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2014-08-25 at 17:16:14.
 */
if (! defined ( '__DOCUMENT_ROOT__' )) {
	require_once $_SERVER ["PWD"] . '/prepare.php';
}

class xmlTest extends MockedListeOptions {
	/**
     * @var xml
     */
	protected $object;
	protected $fichier = "";

	/**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
	protected function setUp() {
		$datas = '<?xml version="1.0" encoding="UTF-8"?>
<xml>
	<simple_data>data1</simple_data>
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
		ob_start ();
		$this->object = new xml ( false, "TESTS xml" );
		$this->object ->prepare_xml ();
	}

	/**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
	protected function tearDown() {
		system ( "rm -f /tmp/testXml_*", $retour );
		system ( "rm -f /tmp/test2Xml_*", $retour );
		ob_end_clean ();
	}

	/**
	 * @covers Zorille\framework\xml::prepare_xml
	 */
	public function testprepare_xml() {
	    // Remove the following lines when you implement this test.
	    $this->markTestIncomplete ( 'This test has not been implemented yet.' );
	}

	/**
	 * @covers Zorille\framework\xml::import_dom_a_partir_de_simpleXML
	 */
	public function testimport_dom_a_partir_de_simpleXML_Exception() {
		$datas = new stdClass ();
		$datas->donnees = "donnees";
		$this ->expectException(Exception::class);
        $this->expectExceptionMessage( '(TESTS xml) Erreur lors de la conversion du simpleXML en DOMElement' );
		$this->object ->import_dom_a_partir_de_simpleXML ( $datas );
	}

	/**
	 * @covers Zorille\framework\xml::import_dom_a_partir_de_simpleXML
	 */
	public function testimport_dom_a_partir_de_simpleXML() {
		$xml_vm_info = new SimpleXMLElement ( "<?xml version=\"1.0\"?><tests/>" );
		$array_src = array ( 
				"test" => "valeur", 
				"test2" => array ( 
						"valeur3", 
						"valeur4" ) );
		$this->object ->array_to_xml ( $array_src, $xml_vm_info, "ISO-XXX" );
		$this ->assertInstanceOf ( 'Zorille\framework\xml', $this->object ->import_dom_a_partir_de_simpleXML ( $xml_vm_info ) );
	}

	/**
     * @covers Zorille\framework\xml::open_xml
     */
	public function testOpen_xml() {
		$this ->expectException(Exception::class);
        $this->expectExceptionMessage( '(TESTS xml) Le fichier /tmp/error_file n\'existe pas.' );
		$this->object ->open_xml ( "/tmp/error_file" );
		
		$this ->assertSame ( $this->object, $this->object ->open_xml ( $this->fichier ) );
	}

	/**
	 * @covers Zorille\framework\xml::renvoi_xpath
	 */
	public function testrenvoi_xpath() {
		$this->object ->open_xml ( $this->fichier );
		$this ->assertInstanceOf ( 'DOMNodeList', $this->object ->renvoi_xpath ( "simple_data" ) );
		$this ->assertInstanceOf ( 'DOMNodeList', $this->object ->renvoi_xpath ( array ( 
				"arraydatas", 
				"serveurs", 
				"serveurTemplates", 
				"host" ) ) );
	}

	/**
	 * @covers Zorille\framework\xml::renvoi_donnee
	 */
	public function testrenvoi_donnee_vide() {
		$this->object ->open_xml ( $this->fichier );
		
		$this ->assertFalse ( $this->object ->renvoi_donnee ( 'NOTEXIST' ) );
	}

	/**
	 * @covers Zorille\framework\xml::renvoi_donnee
	 */
	public function testrenvoi_donnee_defaut() {
		$this->object ->open_xml ( $this->fichier );
		$this ->assertEquals ( 
				array ( 
							'simple_data' => 'data1', 
							'dup_data' => Array ( 
									'data2', 
									'data3' ), 
							'node_vide' => '', 
							'arraydatas' => Array ( 
									"serveurs" => array ( 
											'sort_en_erreur' => 'non', 
											'using' => 'oui', 
											'serveurTemplates' => Array ( 
													'nom' => array ( 
															'NOMDETEST', 
															'GROUPE_NOMS' ), 
													'hostname' => 'localhost', 
													'port' => '80', 
													'includes' => Array ( 
															'global' => '/include/global.php', 
															'local' => '/include/local.php' ), 
													'host' => '10.10.10.10' ) ) ) ), 
					$this->object ->renvoi_donnee () );
	}

	/**
     * @covers Zorille\framework\xml::renvoi_donnee
     */
	public function testrenvoi_donnee_string() {
		$this->object ->open_xml ( $this->fichier );
		$this ->assertEquals ( 'data1', $this->object ->renvoi_donnee ( "simple_data" ) );
	}

	/**
	 * @covers Zorille\framework\xml::renvoi_donnee
	 */
	public function testrenvoi_donnee_array() {
		$this->object ->open_xml ( $this->fichier );
		$this ->assertEquals ( array ( 
				'data2', 
				'data3' ), $this->object ->renvoi_donnee ( "dup_data" ) );
	}

	/**
	 * @covers Zorille\framework\xml::renvoi_donnee
	 */
	public function testrenvoi_donnee_from_array() {
		$this->object ->open_xml ( $this->fichier );
		
		$this ->assertEquals ( 
				array ( 
							'sort_en_erreur' => 'non', 
							'using' => 'oui', 
							'serveurTemplates' => Array ( 
									'nom' => array ( 
											'NOMDETEST', 
											'GROUPE_NOMS' ), 
									'hostname' => 'localhost', 
									'port' => '80', 
									'includes' => Array ( 
											'global' => '/include/global.php', 
											'local' => '/include/local.php' ), 
									'host' => '10.10.10.10' ) ), 
					$this->object ->renvoi_donnee ( array ( 
							"arraydatas", 
							"serveurs" ) ) );
	}

	/**
     * @covers Zorille\framework\xml::Dom_To_Array
     */
	public function testDom_To_Array() {
		$this->object ->open_xml ( $this->fichier );
		$resultat = $this->object ->renvoi_xpath ( array ( 
				"arraydatas" ) );
		$this ->assertEquals ( 
				array ( 
							'serveurs' => Array ( 
									'sort_en_erreur' => 'non', 
									'using' => 'oui', 
									'serveurTemplates' => Array ( 
											'nom' => array ( 
													'NOMDETEST', 
													'GROUPE_NOMS' ), 
											'hostname' => 'localhost', 
											'port' => '80', 
											'includes' => Array ( 
													'global' => '/include/global.php', 
													'local' => '/include/local.php' ), 
											'host' => '10.10.10.10' ) ) ), 
					$this->object ->Dom_To_Array ( $resultat ->item ( 0 ) ) );
		
		$resultat = $this->object ->renvoi_xpath ( array ( 
				"arraydatas", 
				"serveurs" ) );
		$this ->assertEquals ( 
				Array ( 
							'sort_en_erreur' => 'non', 
							'using' => 'oui', 
							'serveurTemplates' => Array ( 
									'nom' => array ( 
											'NOMDETEST', 
											'GROUPE_NOMS' ), 
									'hostname' => 'localhost', 
									'port' => '80', 
									'includes' => Array ( 
											'global' => '/include/global.php', 
											'local' => '/include/local.php' ), 
									'host' => '10.10.10.10' ) ), 
					$this->object ->Dom_To_Array ( $resultat ->item ( 0 ) ) );
		
		$resultat = $this->object ->renvoi_xpath ( "node_vide" );
		$this ->assertEquals ( "", $this->object ->Dom_To_Array ( $resultat ->item ( 0 ) ) );
	}

	/**
     * @covers Zorille\framework\xml::renvoi_Dom_En_SimpleXmlElement
     */
	public function testrenvoi_Dom_En_SimpleXmlElement() {
		$this->object ->open_xml ( $this->fichier );
		$this ->assertInstanceOf ( 'SimpleXMLElement', $this->object ->renvoi_Dom_En_SimpleXmlElement () );
	}

	/**
     * @covers Zorille\framework\xml::ajoute_donnee
     */
	public function testAjoute_donnee() {
		$this->object ->open_xml ( $this->fichier );
		$this ->assertSame ( $this->object, $this->object ->ajoute_donnee ( 'new_data', 'new_valeur' ) );
		
		$this ->assertSame ( $this->object, $this->object ->ajoute_donnee ( array ( 
				'new_array_data', 
				'new_data' ), 'new_valeur' ) );
	}

	/**
	 * @covers Zorille\framework\xml::creer_element
	 */
	public function testCreer_element() {
		$this->object ->open_xml ( $this->fichier );
		$this ->assertInstanceOf ( "DOMElement", $this->object ->creer_element ( 'new_data', 'new_valeur' ) );
	}

	/**
	 * @covers Zorille\framework\xml::ajoute_element
	 */
	public function testAjoute_element() {
		$this->object ->open_xml ( $this->fichier );
		$domDoc = $this->object ->getDomDatas ();
		$domEle = $this->object ->creer_element ( 'new_data', 'new_valeur' );
		$this ->assertSame ( $this->object, $this->object ->ajoute_element ( $domDoc, $domEle ) );
	}

	/**
	 * @covers Zorille\framework\xml::ajoute_element_au_dom
	 * @covers Zorille\framework\xml::ajoute_element_liste
	 */
	public function testajoute_element_au_dom() {
		$this->object ->open_xml ( $this->fichier );
		$domEle = $this->object ->creer_element ( 'serveurs', 'new_valeur_dom' );
		$this ->assertTrue ( $this->object ->ajoute_element_au_dom ( $domEle ) );
	}

	/**
	 * @covers Zorille\framework\xml::ajoute_element_liste
	 */
	public function testAjoute_element_liste() {
		$this->object ->open_xml ( $this->fichier );
		
		$datas = '<?xml version="1.0" encoding="UTF-8"?>
<xml>
	<arraydatas>
		<serveurs  sort_en_erreur="non" using="oui">
			<serveurOver>
				<host>10.10.10.10</host>
				<nom>NOMDETEST</nom>
				<nom>GROUPE_NOMS</nom>
				<hostname>localhost</hostname>
				<port>80</port>
		
				<includes>
					<global>/include/global.php</global>
					<local>/include/local.php</local>
				</includes>
			</serveurOver>
		</serveurs>
	</arraydatas>
</xml>';
		$fichier = "/tmp/test2Xml_" . getmypid () . ".xml";
		system ( "echo '" . $datas . "' > " . $fichier, $retour );
		
		$this->object ->open_xml ( $fichier );
		$domEle = $this->object ->creer_element ( 'serveurs', 'new_valeur_dom' );
		
		$domDatas = $this->object ->getDomDatas ();
		$items = $domDatas ->getElementsByTagName ( 'xml' );
		foreach ( $items as $element_xml ) {
			$this ->assertFalse ( $this->object ->ajoute_element_liste ( $domEle, $element_xml ) );
		}
	}

	/**
     * @covers Zorille\framework\xml::array_to_dom
     */
	public function testArray_to_dom() {
		$this->object ->open_xml ( $this->fichier );
		$this ->assertInstanceOf ( 'DOMElement', $this->object ->array_to_dom ( array ( 
				'value1', 
				'value2' ), 'new_valeur' ) );
	}

	/**
     * @covers Zorille\framework\xml::supprime_element
     */
	public function testSupprime_element() {
		$this->object ->open_xml ( $this->fichier );
		$this ->assertSame ( $this->object, $this->object ->supprime_element ( array ( 
				"arraydatas", 
				"serveurs", 
				"serveurTemplates" ) ) );
	}

	/**
     * @covers Zorille\framework\xml::simpleXmlElement_to_array
     */
	public function testSimpleXmlElement_to_array() {
		$this->object ->open_xml ( $this->fichier );
		$this ->assertEquals ( 
				array ( 
							"simple_data" => "data1", 
							"dup_data" => array ( 
									"data2", 
									"data3" ), 
							"arraydatas" => array ( 
									'serveurs' => Array ( 
											
											'serveurTemplates' => Array ( 
													'nom' => array ( 
															'NOMDETEST', 
															'GROUPE_NOMS' ), 
													'hostname' => 'localhost', 
													'port' => '80', 
													'includes' => Array ( 
															'global' => '/include/global.php', 
															'local' => '/include/local.php' ), 
													'host' => '10.10.10.10', 
													'comment' => Array () ), 
											'@attributes' => Array ( 
													'sort_en_erreur' => 'non', 
													'using' => 'oui' ), 
											'comment' => Array () ) ), 
							'node_vide' => array () ), 
					$this->object ->simpleXmlElement_to_array ( $this->object ->renvoi_Dom_En_SimpleXmlElement () ) );
	}

	/**
     * @covers Zorille\framework\xml::simpleXml_to_array
     */
	public function testSimpleXml_to_array() {
		$donnees = simplexml_load_string ( 
				'<serveurs  sort_en_erreur="non" using="oui">
			<!-- Commentaire -->
			<serveurTemplates>
				<host>10.10.10.10</host>
				<nom>NOMDETEST</nom>
				<hostname>localhost</hostname>
				<port>80</port>
				
				<!-- Commentaire -->
				<includes>
					<global>/include/global.php</global>
					<local>/include/local.php</local>
				</includes>
			</serveurTemplates>
		</serveurs>' );
		$this ->assertEquals ( 
				array ( 
							'serveurTemplates' => Array ( 
									'nom' => 'NOMDETEST', 
									'hostname' => 'localhost', 
									'port' => '80', 
									'includes' => Array ( 
											'global' => '/include/global.php', 
											'local' => '/include/local.php' ), 
									'host' => '10.10.10.10' ), 
							'@attributes' => Array ( 
									'sort_en_erreur' => 'non', 
									'using' => 'oui' ) ), 
					$this->object ->simpleXml_to_array ( $donnees ) );
	}

	/**
     * @covers Zorille\framework\xml::creer_valeur
     */
	public function testCreer_valeur() {
		$var = "liste";
		$this ->assertSame ( $this->object, $this->object ->creer_valeur ( "valeur", $var ) );
		
		$var = array ();
		$this ->assertSame ( $this->object, $this->object ->creer_valeur ( "valeur", $var ['test'] ) );
	}

	/**
     * @covers Zorille\framework\xml::retrouve_attribut
     */
	public function testRetrouve_attribut() {
		$var = array ();
		$donnees = simplexml_load_string ( 
				'<serveurs  sort_en_erreur="non" using="oui">
			<!-- Commentaire -->
			<serveurTemplates sort_en_erreur="non" using="oui">
				<host>10.10.10.10</host>
				<nom>NOMDETEST</nom>
				<hostname>localhost</hostname>
				<port>80</port>
				
				<!-- Commentaire -->
				<includes>
					<global>/include/global.php</global>
					<local>/include/local.php</local>
				</includes>
			</serveurTemplates>
		</serveurs>' );
		foreach ( ( array ) $donnees as $nom => $valeur ) {
			if ($valeur instanceof SimpleXMLElement) {
				$this ->assertSame ( $this->object, $this->object ->retrouve_attribut ( $valeur, $var [$nom] ) );
			}
		}
	}

	/**
     * @covers Zorille\framework\xml::retrouve_valeur
     */
	public function testRetrouve_valeur() {
		$var = array ();
		$donnees = simplexml_load_string ( 
				'<serveurs  sort_en_erreur="non" using="oui">
			<!-- Commentaire -->
			<serveurTemplates>
				<host>10.10.10.10</host>
				<nom>NOMDETEST</nom>
				<hostname>localhost</hostname>
				<port>80</port>
				
				<!-- Commentaire -->
				<includes>
					<global>/include/global.php</global>
					<local>/include/local.php</local>
				</includes>
			</serveurTemplates>
		</serveurs>' );
		foreach ( ( array ) $donnees as $nom => $valeur ) {
			if ($valeur instanceof SimpleXMLElement) {
				$this ->assertSame ( $this->object, $this->object ->retrouve_valeur ( $valeur, $var [$nom] ) );
			}
		}
	}

	/**
     * @covers Zorille\framework\xml::recupere_donnee_fils
     */
	public function testRecupere_donnee_fils() {
		$var = array ();
		$donnees = simplexml_load_string ( 
				'<serveurs  sort_en_erreur="non" using="oui">
			<!-- Commentaire -->
			<serveurTemplates>
				<host>10.10.10.10</host>
				<nom>NOMDETEST</nom>
				<hostname>localhost</hostname>
				<port>80</port>
				
				<!-- Commentaire -->
				<includes>
					<global>/include/global.php</global>
					<local>/include/local.php</local>
				</includes>
			</serveurTemplates>
		</serveurs>' );
		foreach ( ( array ) $donnees as $nom => $valeur ) {
			if ($valeur instanceof SimpleXMLElement) {
				$this ->assertSame ( $this->object, $this->object ->recupere_donnee_fils ( $valeur, $var [$nom] ) );
			}
		}
	}

	/**
	 * @covers Zorille\framework\xml::array_to_xml
	 */
	public function testarray_to_xml() {
		$xml_vm_info = new SimpleXMLElement ( "<?xml version=\"1.0\"?><tests/>" );
		$array_src = array ( 
				"test" => "valeur", 
				"test2" => array ( 
						"valeur3", 
						"valeur4" ) );
		$this->object ->array_to_xml ( $array_src, $xml_vm_info, "ISO-XXX" );
		$this ->assertEquals ( "<?xml version=\"1.0\"?>\n<tests><test>valeur</test><test2><item>valeur3</item><item>valeur4</item></test2></tests>\n", $xml_vm_info ->asXML () );
	}
}
