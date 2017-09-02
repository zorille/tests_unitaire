<?php
/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2014-08-26 at 11:02:26.
 */
if (! defined ( '__DOCUMENT_ROOT__' )) {
	require_once $_SERVER ["PWD"] . '/prepare.php';
}
class fonctions_standards_gestion_machinesTest extends MockedListeOptions {
	/**
     * @var fonctions_standards_gestion_machines
     */
	protected $object;

	/**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
	protected function setUp() {
		ob_start ();
		$this->object = new fonctions_standards_gestion_machines ( false, 'TESTS fonctions_standards_gestion_machines' );
		$this->object->setListeOptions ( $this->getListeOption () );
	}

	/**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
	protected function tearDown() {
		ob_end_clean ();
	}

	/**
     * @covers fonctions_standards_gestion_machines::update_calculateur
     */
	public function testUpdate_calculateur_array() {
		$calculateur = array ();
		$this->assertTrue ( $this->object->update_calculateur ( $calculateur, "CHAMP", "VALEUR" ) );
		$this->assertEquals ( array (
				'CHAMP' => 'VALEUR' 
		), $calculateur );
	}

	/**
	 * @covers fonctions_standards_gestion_machines::update_calculateur
	 */
	public function testUpdate_calculateur_string() {
		$calculateur = 'VALEUR';
		$this->assertTrue ( $this->object->update_calculateur ( $calculateur, "CHAMP", "VALEUR" ) );
		$this->assertEquals ( array (
				'netname' => 'VALEUR',
				'CHAMP' => 'VALEUR' 
		), $calculateur );
	}

	/**
     * @covers fonctions_standards_gestion_machines::update_liste_calculateurs
     */
	public function testUpdate_liste_calculateurs() {
		$liste_calc = array (
				"calc1",
				"calc2" 
		);
		$liste = array (
				"STRING",
				array (
						"NOM" => "DATA" 
				) 
		);
		$this->assertTrue ( $this->object->update_liste_calculateurs ( $liste_calc, $liste, "NOM", "DEFAUT" ) );
		$this->assertEquals ( array (
				array (
						'netname' => 'calc1',
						'NOM' => 'DEFAUT' 
				),
				array (
						'netname' => 'calc2',
						'NOM' => 'DATA' 
				) 
		), $liste_calc );
	}

	/**
     * @covers fonctions_standards_gestion_machines::organise_variables_calculateurs
     */
	public function testOrganise_variables_calculateurs_cli() {
		$this->object->getListeOptions ()
			->expects ( $this->any () )
			->method ( 'verifie_option_existe' )
			->will ( $this->returnValue ( true ) );
		$this->object->getListeOptions ()
			->expects ( $this->any () )
			->method ( 'getOption' )
			->will ( $this->returnValue ( "calc1 calc2 calc3" ) );
		$this->assertTrue ( $this->object->organise_variables_calculateurs ( $liste_calc, "CLI", "DEFAUT" ) );
	}

	/**
	 * @covers fonctions_standards_gestion_machines::organise_variables_calculateurs
	 */
	public function testOrganise_variables_calculateurs_xml() {
		$this->object->getListeOptions ()
			->expects ( $this->any () )
			->method ( 'verifie_option_existe' )
			->will ( $this->onConsecutiveCalls ( false, true ) );
		$this->object->getListeOptions ()
			->expects ( $this->any () )
			->method ( 'getOption' )
			->will ( $this->returnValue ( "calc1" ) );
		$this->assertTrue ( $this->object->organise_variables_calculateurs ( $liste_calc, "XML", "DEFAUT" ) );
	}

	/**
	 * @covers fonctions_standards_gestion_machines::organise_variables_calculateurs
	 */
	public function testOrganise_variables_calculateurs_string() {
		$this->object->getListeOptions ()
			->expects ( $this->any () )
			->method ( 'verifie_option_existe' )
			->will ( $this->returnValue ( false ) );
		$this->object->getListeOptions ()
			->expects ( $this->any () )
			->method ( 'getOption' )
			->will ( $this->returnValue ( "calc1" ) );
		$this->assertTrue ( $this->object->organise_variables_calculateurs ( $liste_calc, "XML", "DEFAUT" ) );
	}

	/**
     * @covers fonctions_standards_gestion_machines::trouve_attribut_calculateur
     */
	public function testTrouve_attribut_calculateur_defaut() {
		$this->object->getListeOptions ()
			->expects ( $this->any () )
			->method ( 'verifie_option_existe' )
			->will ( $this->returnValue ( false ) );
		$this->assertEquals ( array (), $this->object->trouve_attribut_calculateur () );
	}

	/**
	 * @covers fonctions_standards_gestion_machines::trouve_attribut_calculateur
	 */
	public function testTrouve_attribut_calculateur_cli() {
		$this->object->getListeOptions ()
			->expects ( $this->any () )
			->method ( 'verifie_option_existe' )
			->will ( $this->returnValue ( true ) );
		$this->object->getListeOptions ()
			->expects ( $this->any () )
			->method ( 'getOption' )
			->will ( $this->returnValue ( "calc1" ) );
		$this->assertEquals ( array (
				array (
						'NetName' => 'calc1',
						'Name' => 'calc1',
						'IP' => 'calc1',
						'Username' => 'calc1',
						'Password' => 'calc1',
						'FTPPassword' => 'calc1',
						'DiskSpace' => 'calc1',
						'RamSpace' => 'calc1',
						'MaxRamJob' => 'calc1',
						'CPUUnit' => 'calc1',
						'MinCPUJob' => 'calc1',
						'MaxCPUJob' => 'calc1',
						'MaxNbJob' => 'calc1' 
				) 
		), $this->object->trouve_attribut_calculateur () );
	}

	/**
	 * @covers fonctions_standards_gestion_machines::trouve_attribut_calculateur
	 */
	public function testTrouve_attribut_calculateur_array() {
		$this->object->getListeOptions ()
			->expects ( $this->any () )
			->method ( 'verifie_option_existe' )
			->will ( $this->returnValue ( true ) );
		$this->object->getListeOptions ()
			->expects ( $this->any () )
			->method ( 'getOption' )
			->will ( $this->returnValue ( array (
				"calc1" 
		) ) );
		$this->assertEquals ( array (
				array (
						'NetName' => 'calc1',
						'Name' => 'calc1',
						'IP' => 'calc1',
						'Username' => 'calc1',
						'Password' => 'calc1',
						'FTPPassword' => 'calc1',
						'DiskSpace' => 'calc1',
						'RamSpace' => 'calc1',
						'MaxRamJob' => 'calc1',
						'CPUUnit' => 'calc1',
						'MinCPUJob' => 'calc1',
						'MaxCPUJob' => 'calc1',
						'MaxNbJob' => 'calc1' 
				) 
		), $this->object->trouve_attribut_calculateur () );
	}

	/**
	 * @covers fonctions_standards_gestion_machines::trouve_attribut_calculateur
	 */
	public function testTrouve_attribut_calculateur_xml() {
		$this->object->getListeOptions ()
			->expects ( $this->any () )
			->method ( 'verifie_option_existe' )
			->will ( $this->returnValue ( true ) );
		$this->object->getListeOptions ()
			->expects ( $this->any () )
			->method ( 'getOption' )
			->will ( $this->returnValue ( array (
				"calculateur" => array (
						"calc1",
						array (
								"netname" => "calc2" 
						) 
				) 
		) ) );
		$this->assertEquals ( array (
				array (
						'NetName' => 'calc1',
						'Name' => array (
								'calc1',
								array (
										'netname' => 'calc2' 
								) 
						),
						'IP' => array (
								'calc1',
								array (
										'netname' => 'calc2' 
								) 
						),
						'Username' => array (
								'calc1',
								array (
										'netname' => 'calc2' 
								) 
						),
						'Password' => array (
								'calc1',
								array (
										'netname' => 'calc2' 
								) 
						),
						'FTPPassword' => array (
								'calc1',
								array (
										'netname' => 'calc2' 
								) 
						),
						'DiskSpace' => array (
								'calc1',
								array (
										'netname' => 'calc2' 
								) 
						),
						'RamSpace' => array (
								'calc1',
								array (
										'netname' => 'calc2' 
								) 
						),
						'MaxRamJob' => array (
								'calc1',
								array (
										'netname' => 'calc2' 
								) 
						),
						'CPUUnit' => array (
								'calc1',
								array (
										'netname' => 'calc2' 
								) 
						),
						'MinCPUJob' => array (
								'calc1',
								array (
										'netname' => 'calc2' 
								) 
						),
						'MaxCPUJob' => array (
								'calc1',
								array (
										'netname' => 'calc2' 
								) 
						),
						'MaxNbJob' => array (
								'calc1',
								array (
										'netname' => 'calc2' 
								) 
						) 
				),
				array (
						'NetName' => 'calc2' 
				) 
		), $this->object->trouve_attribut_calculateur () );
	}

	/**
     * @covers fonctions_standards_gestion_machines::creer_liste_calculateurs
     */
	public function testCreer_liste_calculateurs_defaut() {
		$this->assertFalse ( $this->object->creer_liste_calculateurs () );
	}

	/**
	 * @covers fonctions_standards_gestion_machines::creer_liste_calculateurs
	 */
	public function testCreer_liste_calculateurs_cli_random() {
		$this->object->getListeOptions ()
			->expects ( $this->any () )
			->method ( 'verifie_option_existe' )
			->will ( $this->returnValue ( true ) );
		$this->object->getListeOptions ()
			->expects ( $this->any () )
			->method ( 'getOption' )
			->will ( $this->returnValue ( "calc1" ) );
		$this->assertInstanceOf ( "calculateurs", $this->object->creer_liste_calculateurs () );
	}

	/**
	 * @covers fonctions_standards_gestion_machines::creer_liste_calculateurs
	 */
	public function testCreer_liste_calculateurs_cli() {
		$this->object->getListeOptions ()
			->expects ( $this->any () )
			->method ( 'verifie_option_existe' )
			->will ( $this->returnValue ( true ) );
		$this->object->getListeOptions ()
			->expects ( $this->any () )
			->method ( 'getOption' )
			->will ( $this->returnValue ( "calc1" ) );
		$this->assertInstanceOf ( "calculateurs", $this->object->creer_liste_calculateurs ( false ) );
	}

	/**
     * @covers fonctions_standards_gestion_machines::renvoi_liste_machines_standard
     */
	public function testrenvoi_liste_machines_standard() {
		$this->object->getListeOptions ()
			->expects ( $this->any () )
			->method ( 'getOption' )
			->will ( $this->returnValue ( array (
				array (
						"type" => "TYPE",
						"netname" => "NOM" 
				) 
		) ) );
		$this->assertEquals ( array (
				array (
						"type" => "TYPE",
						"netname" => "NOM" 
				) 
		), $this->object->renvoi_liste_machines_standard ( "TYPE", "NOM" ) );
	}
}