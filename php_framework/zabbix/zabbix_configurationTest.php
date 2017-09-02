<?php
/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2015-05-12 at 10:29:51.
 */
if (! defined ( '__DOCUMENT_ROOT__' )) {
	require_once $_SERVER ["PWD"] . '/prepare.php';
}
class zabbix_configurationTest extends MockedListeOptions {
	/**
     * @var zabbix_configuration
     */
	protected $object;

	public static function tearDownAfterClass() {
		system ( "rm -f /tmp/zabbix_configurationTest_*.xml", $retour );
	}

	/**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
	protected function setUp() {
		ob_start ();
		$zabbix_wsclient = $this->createMock ( "zabbix_wsclient" );
		
		$this->object = new zabbix_configuration ( false, "zabbix_configuration" );
		$this->object->setObjetZabbixWsclient ( $zabbix_wsclient );
	}

	/**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
	protected function tearDown() {
		ob_end_clean ();
	}

	/**
     * @covers zabbix_configuration::retrouve_zabbix_param
     */
	public function testRetrouve_zabbix_param_exception() {
		
			$this->getListeOption ()
				->expects ( $this->any () )
				->method ( 'verifie_variable_standard' )
				->will ( $this->returnValue ( false ) );
			$this->object->setListeOptions ( $this->getListeOption () );
			
			$this ->expectException(Exception::class);
        $this->expectExceptionMessage( '(zabbix_configuration) Il manque le parametre : zabbix_configuration_format' );
			
			
			$this->assertEquals ( "", $this->object->retrouve_zabbix_param () );
	}

	/**
	 * @covers zabbix_configuration::retrouve_zabbix_param
	 */
	public function testRetrouve_zabbix_param() {
		$this->getListeOption ()
			->expects ( $this->any () )
			->method ( 'verifie_variable_standard' )
			->will ( $this->returnValue ( true ) );
		$this->getListeOption ()
			->expects ( $this->any () )
			->method ( 'renvoi_variables_standard' )
			->will ( $this->onConsecutiveCalls ( "NOFORMAT", "FICHIER1" ) );
		$this->object->setListeOptions ( $this->getListeOption () );
		
		$this->assertSame ( $this->object, $this->object->retrouve_zabbix_param () );
		$this->assertEquals ( "json", $this->object->getFormat () );
		$this->assertEquals ( "FICHIER1", $this->object->getFichier () );
	}

	/**
	 * @covers zabbix_configuration::retrouve_zabbix_param
	 */
	public function testRetrouve_zabbix_param_import_badRules() {
		$this->getListeOption ()
			->expects ( $this->any () )
			->method ( 'verifie_variable_standard' )
			->will ( $this->returnValue ( true ) );
		$this->getListeOption ()
			->expects ( $this->any () )
			->method ( 'renvoi_variables_standard' )
			->will ( $this->onConsecutiveCalls ( "NOFORMAT", "FICHIER1", "RULE1", true, false ) );
		$this->object->setListeOptions ( $this->getListeOption () );
		
		$this->assertSame ( $this->object, $this->object->retrouve_zabbix_param ( true ) );
		$this->assertEquals ( "json", $this->object->getFormat () );
		$this->assertEquals ( "FICHIER1", $this->object->getFichier () );
		$this->assertEquals ( array (), $this->object->getRules () );
		$this->assertEquals ( array (), $this->object->getRulesParams () );
	}

	/**
	 * @covers zabbix_configuration::retrouve_zabbix_param
	 */
	public function testRetrouve_zabbix_param_import() {
		$this->getListeOption ()
			->expects ( $this->any () )
			->method ( 'verifie_variable_standard' )
			->will ( $this->returnValue ( true ) );
		$this->getListeOption ()
			->expects ( $this->any () )
			->method ( 'renvoi_variables_standard' )
			->will ( $this->onConsecutiveCalls ( "NOFORMAT", "FICHIER1", "templates", true, false ) );
		$this->object->setListeOptions ( $this->getListeOption () );
		
		$this->assertSame ( $this->object, $this->object->retrouve_zabbix_param ( true ) );
		$this->assertEquals ( "json", $this->object->getFormat () );
		$this->assertEquals ( "FICHIER1", $this->object->getFichier () );
		$this->assertEquals ( array (
				"templates" 
		), $this->object->getRules () );
		$this->assertEquals ( array (
				"templates" => array (
						'createMissing' => true,
						'updateExisting' => false 
				) 
		), $this->object->getRulesParams () );
	}

	/**
	 * @covers zabbix_configuration::retrouve_zabbix_param
	 */
	public function testRetrouve_zabbix_param_export() {
		$this->getListeOption ()
			->expects ( $this->any () )
			->method ( 'verifie_variable_standard' )
			->will ( $this->returnValue ( true ) );
		$this->getListeOption ()
			->expects ( $this->any () )
			->method ( 'renvoi_variables_standard' )
			->will ( $this->onConsecutiveCalls ( "NOFORMAT", "FICHIER1", "OPTION" ) );
		$this->object->setListeOptions ( $this->getListeOption () );
		
		$this->assertSame ( $this->object, $this->object->retrouve_zabbix_param ( false, true ) );
		$this->assertEquals ( "json", $this->object->getFormat () );
		$this->assertEquals ( "FICHIER1", $this->object->getFichier () );
		$this->assertEquals ( array (
				"OPTION" 
		), $this->object->getOptions () );
	}

	/**
     * @covers zabbix_configuration::valide_format_param
     */
	public function testValide_format_param_noChange() {
		$param = true;
		$this->assertSame ( $this->object, $this->object->valide_format_param ( $param ) );
		$this->assertTrue ( $param );
	}

	/**
	 * @covers zabbix_configuration::valide_format_param
	 */
	public function testValide_format_param_true_string() {
		$param = "true";
		$this->assertSame ( $this->object, $this->object->valide_format_param ( $param ) );
		$this->assertTrue ( $param );
	}

	/**
	 * @covers zabbix_configuration::valide_format_param
	 */
	public function testValide_format_param_false_string() {
		$param = "false";
		$this->assertSame ( $this->object, $this->object->valide_format_param ( $param ) );
		$this->assertFalse ( $param );
	}

	/**
     * @covers zabbix_configuration::retrouve_rules_param
     */
	public function testRetrouve_rules_param() {
		$this->getListeOption ()
			->expects ( $this->any () )
			->method ( 'verifie_variable_standard' )
			->will ( $this->returnValue ( true ) );
		$this->getListeOption ()
			->expects ( $this->any () )
			->method ( 'renvoi_variables_standard' )
			->will ( $this->onConsecutiveCalls ( false, true ) );
		$this->object->setListeOptions ( $this->getListeOption () );
		
		$this->object->setRules ( array (
				"templates" 
		) );
		
		$this->assertSame ( $this->object, $this->object->retrouve_rules_param () );
		$this->assertEquals ( array (
				"templates" => array (
						'createMissing' => false,
						'updateExisting' => true 
				) 
		), $this->object->getRulesParams () );
	}

	/**
	 * @covers zabbix_configuration::charge_fichier
	 */
	public function testCharge_fichier_Exception() {
		$this->object->setFichier ( "/tmp/NOTEXISTINGFILE" );
		$this ->expectException(Exception::class);
        $this->expectExceptionMessage( '(zabbix_configuration) Le fichier /tmp/NOTEXISTINGFILE n\'est pas lisible.' );
			$this->object->charge_fichier ();
	}

	private function _prepareFichier() {
		$datas = '<?xml version="1.0" encoding="UTF-8"?>
<xml>
	<simple_data>data1</simple_data>
	<arraydatas>
		<serveurs  sort_en_erreur="non" using="oui">
			<!-- Commentaire -->
			<serveurTemplates>
				<host>10.10.10.10</host>
			</serveurTemplates>
		</serveurs>
	</arraydatas>
</xml>';
		$fichier = "/tmp/zabbix_configurationTest_" . getmypid () . ".xml";
		system ( "echo '" . $datas . "' > " . $fichier, $retour );
		$this->object->setFichier ( $fichier );
		
		return $datas;
	}

	/**
     * @covers zabbix_configuration::charge_fichier
     */
	public function testCharge_fichier() {
		$datas = $this->_prepareFichier ();
		$this->assertEquals ( $datas . "\n", $this->object->charge_fichier () );
	}

	/**
     * @covers zabbix_configuration::creer_definition_import_ws
     */
	public function testCreer_definition_import_ws() {
		$datas = $this->_prepareFichier ();
		$this->object->setFormat ( "xml" )
			->setRulesParams ( array (
				"templates" => array (
						'createMissing' => false,
						'updateExisting' => true 
				) 
		) );
		$this->assertEquals ( array (
				'format' => 'xml',
				'rules' => Array (
						"templates" => array (
								'createMissing' => false,
								'updateExisting' => true 
						) 
				),
				'source' => $datas . "\n" 
		), $this->object->creer_definition_import_ws () );
	}

	/**
     * @covers zabbix_configuration::importer
     */
	public function testImporter() {
		$datas = $this->_prepareFichier ();
		$this->object->getObjetZabbixWsclient ()
			->expects ( $this->any () )
			->method ( 'configurationImport' )
			->will ( $this->returnValue ( true ) );
		
		$this->assertTrue ( $this->object->importer () );
	}

	/**
     * @covers zabbix_configuration::creer_definition_export_ws
     */
	public function testCreer_definition_export_ws() {
		$this->object->setFormat ( "xml" )
			->setOptions ( array (
				"templates" 
		) );
		$zabbix_templates = $this->createMock ( "zabbix_templates" );
		$zabbix_templates->expects ( $this->any () )
			->method ( 'creer_definition_templatesids_sans_champ_templateid_ws' )
			->will ( $this->returnValue ( array (
				1,
				2,
				3 
		) ) );
		$this->object->setObjetTemplates ( $zabbix_templates );
		
		$this->assertEquals ( array (
				'format' => 'xml',
				'options' => Array (
						"templates" => array (
								1,
								2,
								3 
						) 
				) 
		), $this->object->creer_definition_export_ws () );
	}

	/**
     * @covers zabbix_configuration::exporter
     */
	public function testExporter() {
		$datas = $this->_prepareFichier ();
		$this->object->getObjetZabbixWsclient ()
			->expects ( $this->any () )
			->method ( 'configurationExport' )
			->will ( $this->returnValue ( '<?xml version="1.0" encoding="UTF-8"?>
<xml>
	<simple_data>data1</simple_data>
</xml>' ) );
		
		$this->assertSame ( $this->object, $this->object->exporter () );
	}

	/**
     * @covers zabbix_configuration::retrouve_Format
     */
	public function testRetrouve_Format() {
		$this->assertEquals ( "json", $this->object->retrouve_Format ( "NONDEF" ) );
		$this->assertEquals ( "json", $this->object->retrouve_Format ( "json" ) );
		$this->assertEquals ( "xml", $this->object->retrouve_Format ( "xml" ) );
	}

	/**
     * @covers zabbix_configuration::retrouve_Rules
     */
	public function testRetrouve_Rules() {
		$liste_rules = array (
				"applications",
				"discoveryrules",
				"graphs",
				"groups",
				"hosts",
				"images",
				"items",
				"maps",
				"screens",
				"templatelinkage",
				"templates",
				"templatescreens",
				"triggers",
				"RULES1" 
		);
		
		$this->assertSame ( $this->object, $this->object->retrouve_Rules ( $liste_rules ) );
		$this->assertEquals ( array (
				"applications",
				"discoveryRules",
				"graphs",
				"groups",
				"hosts",
				"images",
				"items",
				"maps",
				"screens",
				"templateLinkage",
				"templates",
				"templateScreens",
				"triggers" 
		), $liste_rules );
	}

	/**
     * @covers zabbix_configuration::valide_RulesParams
     */
	public function testValide_RulesParams() {
		$this->assertEquals ( array (
				'createMissing' => true,
				'updateExisting' => true 
		), $this->object->valide_RulesParams ( "templates", true, true ) );
		$this->assertEquals ( array (
				'createMissing' => true 
		), $this->object->valide_RulesParams ( "groups", true, true ) );
		$this->assertEquals ( array (
				'createMissing' => true 
		), $this->object->valide_RulesParams ( "templateLinkage", true, true ) );
	}

	/**
	 * @covers zabbix_configuration::fabrique_options
	 */
	public function testfabrique_options_Exception_option_existe_pas() {
		$this->object->setOptions ( array (
				"OPTION1" 
		) );
		
		$this ->expectException(Exception::class);
        $this->expectExceptionMessage( '(zabbix_configuration) Cette option OPTION1 n\'existe pas.' );
			$this->object->fabrique_options ();
	}

	/**
	 * @covers zabbix_configuration::fabrique_options
	 */
	public function testfabrique_options_Exception_groups() {
		$this->object->setOptions ( array (
				"groups" 
		) );
		
		$this ->expectException(Exception::class);
        $this->expectExceptionMessage( '(zabbix_configuration) Il faut un objet de type zabbix_hostgroups' );
			$this->object->fabrique_options ();
	}

	/**
	 * @covers zabbix_configuration::fabrique_options
	 */
	public function testfabrique_options_Exception_hosts() {
		$this->object->setOptions ( array (
				"hosts" 
		) );
		
		$this ->expectException(Exception::class);
        $this->expectExceptionMessage( '(zabbix_configuration) Il faut un objet de type zabbix_hosts' );
			$this->object->fabrique_options ();
	}

	/**
	 * @covers zabbix_configuration::fabrique_options
	 */
	public function testfabrique_options_Exception_images() {
		$this->object->setOptions ( array (
				"images" 
		) );
		
		$this ->expectException(Exception::class);
        $this->expectExceptionMessage( '(zabbix_configuration) Il faut un objet de type zabbix_images' );
			$this->object->fabrique_options ();
	}

	/**
	 * @covers zabbix_configuration::fabrique_options
	 */
	public function testfabrique_options_Exception_maps() {
		$this->object->setOptions ( array (
				"maps" 
		) );
		
		$this ->expectException(Exception::class);
        $this->expectExceptionMessage( '(zabbix_configuration) Il faut un objet de type zabbix_maps' );
			$this->object->fabrique_options ();
	}

	/**
	 * @covers zabbix_configuration::fabrique_options
	 */
	public function testfabrique_options_Exception_screens() {
		$this->object->setOptions ( array (
				"screens" 
		) );
		
		$this ->expectException(Exception::class);
        $this->expectExceptionMessage( '(zabbix_configuration) Il faut un objet de type zabbix_screens' );
			$this->object->fabrique_options ();
	}

	/**
	 * @covers zabbix_configuration::fabrique_options
	 */
	public function testfabrique_options_Exception_templates() {
		$this->object->setOptions ( array (
				"templates" 
		) );
		
		$this ->expectException(Exception::class);
        $this->expectExceptionMessage( '(zabbix_configuration) Il faut un objet de type zabbix_templates' );
			$this->object->fabrique_options ();
	}

	/**
	 * @covers zabbix_configuration::fabrique_options
	 */
	public function testfabrique_options() {
		$this->object->setOptions ( array (
				"groups",
				"hosts",
				"images",
				"maps",
				"screens",
				"templates" 
		) );
		$zabbix_groups = $this->createMock ( "zabbix_hostgroups" );
		$zabbix_groups->expects ( $this->any () )
			->method ( 'creer_definition_groupsids_sans_champ_groupid_ws' )
			->will ( $this->returnValue ( array (
				1 
		) ) );
		$this->object->setObjetGroups ( $zabbix_groups );
		$zabbix_hosts = $this->createMock ( "zabbix_hosts" );
		$zabbix_hosts->expects ( $this->any () )
			->method ( 'creer_definition_hostids_sans_champ_hostid_ws' )
			->will ( $this->returnValue ( array (
				2 
		) ) );
		$this->object->setObjetHosts ( $zabbix_hosts );
		$zabbix_images = $this->createMock ( 'zabbix_images' );
		$zabbix_images->expects ( $this->any () )
			->method ( 'creer_definition_imageids_sans_champ_imageid_ws' )
			->will ( $this->returnValue ( array (
				3 
		) ) );
		$this->object->setObjetImages ( $zabbix_images );
		$zabbix_maps = $this->createMock ( "zabbix_maps" );
		$zabbix_maps->expects ( $this->any () )
			->method ( 'creer_definition_mapids_sans_champ_mapid_ws' )
			->will ( $this->returnValue ( array (
				4 
		) ) );
		$this->object->setObjetMaps ( $zabbix_maps );
		$zabbix_screens = $this->createMock ( "zabbix_screens" );
		$zabbix_screens->expects ( $this->any () )
			->method ( 'creer_definition_screenids_sans_champ_screenid_ws' )
			->will ( $this->returnValue ( array (
				5 
		) ) );
		$this->object->setObjetScreens ( $zabbix_screens );
		$zabbix_templates = $this->createMock ( "zabbix_templates" );
		$zabbix_templates->expects ( $this->any () )
			->method ( 'creer_definition_templatesids_sans_champ_templateid_ws' )
			->will ( $this->returnValue ( array (
				6 
		) ) );
		$this->object->setObjetTemplates ( $zabbix_templates );
		
		$this->assertEquals ( array (
				"groups" => array (
						1 
				),
				"hosts" => array (
						2 
				),
				"images" => array (
						3 
				),
				"maps" => array (
						4 
				),
				"screens" => array (
						5 
				),
				"templates" => array (
						6 
				) 
		), $this->object->fabrique_options () );
	}
}