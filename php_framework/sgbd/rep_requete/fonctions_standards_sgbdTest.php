<?php
/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2014-08-26 at 11:31:40.
 */
if (! defined ( '__DOCUMENT_ROOT__' )) {
	require_once $_SERVER ["PWD"] . '/prepare.php';
}
class fonctions_standards_sgbdTest extends MockedListeOptions {
	/**
     * @var fonctions_standards_sgbd
     */
	protected $object;

	/**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
	protected function setUp() {
		ob_start ();
		
		$this->object = new fonctions_standards_sgbd ( false, "TESTS fonctions_standards_sgbd" );
	}

	/**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
	protected function tearDown() {
		ob_end_clean ();
	}

	/**
     * @covers fonctions_standards_sgbd::parse_option_sgbd
     */
	public function testParse_option_sgbd_array_vide() {
		
		$this->getListeOption ()
			->expects ( $this->any () )
			->method ( 'getOption' )
			->will ( $this->onConsecutiveCalls ( array (), "STRING" ) );
		$this->assertEquals ( Array (
				'using' => 'oui',
				'dbhost' => 'localhost',
				'username' => 'nobody',
				'password' => '',
				'database' => 'aucuneBD',
				'encode' => 'utf8',
				'maj_db' => 'oui',
				'port' => 3306,
				'socket' => '',
				'options' => '',
				'salvosize' => '',
				'type' => 'mysql',
				'sort_en_erreur' => 'oui' 
		), $this->object->parse_option_sgbd ( $this->getListeOption () ) );
	}

	/**
	 * @covers fonctions_standards_sgbd::parse_option_sgbd
	 */
	public function testParse_option_sgbd_array_plein() {
		
		$this->getListeOption ()
			->expects ( $this->any () )
			->method ( 'getOption' )
			->will ( $this->onConsecutiveCalls ( array (), array (
				"Value1" 
		) ) );
		$this->assertEquals ( Array (
				'liste_bases' => array (
						array (
								'using' => 'oui',
								'dbhost' => 'localhost',
								'username' => 'nobody',
								'password' => '',
								'database' => 'aucuneBD',
								'encode' => 'utf8',
								'maj_db' => 'oui',
								'port' => 3306,
								'socket' => '',
								'options' => '',
								'salvosize' => '',
								'type' => 'mysql',
								'sort_en_erreur' => 'oui' 
						) 
				) 
		), $this->object->parse_option_sgbd ( $this->getListeOption () ) );
	}

	/**
	 * @covers fonctions_standards_sgbd::parse_option_sgbd
	 */
	public function testParse_option_sgbd_oui() {
		
		$this->getListeOption ()
			->expects ( $this->any () )
			->method ( 'getOption' )
			->will ( $this->returnValue ( "oui" ) );
		$this->getListeOption ()
			->expects ( $this->any () )
			->method ( 'getListeOption' )
			->will ( $this->returnValue ( array () ) );
		$this->assertEquals ( Array (
				'using' => 'oui',
				'dbhost' => 'localhost',
				'username' => 'nobody',
				'password' => '',
				'database' => 'aucuneBD',
				'encode' => 'utf8',
				'maj_db' => 'oui',
				'port' => 3306,
				'socket' => '',
				'options' => '',
				'salvosize' => '',
				'type' => 'mysql',
				'sort_en_erreur' => 'oui' 
		), $this->object->parse_option_sgbd ( $this->getListeOption () ) );
	}

	/**
	 * @covers fonctions_standards_sgbd::parse_option_sgbd
	 */
	public function testParse_option_sgbd_multi() {
		
		$this->getListeOption ()
			->expects ( $this->any () )
			->method ( 'getOption' )
			->will ( $this->onConsecutiveCalls ( "multi", "DB1" ) );
		$this->getListeOption ()
			->expects ( $this->any () )
			->method ( 'getListeOption' )
			->will ( $this->returnValue ( array () ) );
		$this->assertEquals ( Array (
				'liste_bases' => array (
						'DB1' => array (
								'using' => 'oui',
								'dbhost' => 'localhost',
								'username' => 'nobody',
								'password' => '',
								'database' => 'aucuneBD',
								'encode' => 'utf8',
								'maj_db' => 'oui',
								'port' => 3306,
								'socket' => '',
								'options' => '',
								'salvosize' => '',
								'type' => 'mysql',
								'sort_en_erreur' => 'oui' 
						) 
				) 
		), $this->object->parse_option_sgbd ( $this->getListeOption () ) );
	}

	/**
     * @covers fonctions_standards_sgbd::verifie_variable_sgbd
     */
	public function testVerifie_variable_sgbd() {
		$this->assertEquals ( Array (
				'using' => 'oui',
				'dbhost' => 'localhost',
				'username' => 'nobody',
				'password' => '',
				'database' => 'aucuneBD',
				'encode' => 'utf8',
				'maj_db' => 'oui',
				'port' => 3306,
				'socket' => '',
				'options' => '',
				'salvosize' => '',
				'type' => 'mysql',
				'sort_en_erreur' => 'oui' 
		), $this->object->verifie_variable_sgbd ( array (), "DB2" ) );
		
		$this->assertEquals ( Array (
				'using' => 'oui',
				'dbhost' => 'localhost',
				'username' => 'nobody',
				'password' => '',
				'database' => 'aucuneBD',
				'encode' => 'utf8',
				'maj_db' => 'oui',
				'port' => 3306,
				'socket' => '',
				'options' => '',
				'salvosize' => '',
				'type' => 'mysql',
				'sort_en_erreur' => 'non' 
		), $this->object->verifie_variable_sgbd ( array (
				'DB2_using' => 'oui',
				'DB2_dbhost' => 'localhost',
				'DB2_username' => 'nobody',
				'DB2_password' => '',
				'DB2_database' => 'aucuneBD',
				'DB2_encode' => 'utf8',
				'DB2_maj_db' => 'oui',
				'DB2_port' => 3306,
				'DB2_socket' => '',
				'DB2_options' => '',
				'DB2_salvosize' => '',
				'DB2_type' => 'mysql',
				'DB2_sort_en_erreur' => 'non' 
		), "DB2" ) );
		
		$this->assertEquals ( Array (
				'using' => 'oui',
				'dbhost' => 'localhost',
				'username' => 'nobody',
				'password' => '',
				'database' => 'aucuneBD',
				'encode' => 'utf8',
				'maj_db' => 'oui',
				'port' => 3306,
				'socket' => '',
				'options' => '',
				'salvosize' => '',
				'type' => 'mysql',
				'sort_en_erreur' => 'non' 
		), $this->object->verifie_variable_sgbd ( array (
				'DB2_SQL_using' => 'oui',
				'DB2_dbhost' => 'localhost',
				'DB2_username' => 'nobody',
				'DB2_password' => '',
				'DB2_database' => 'aucuneBD',
				'DB2_encode' => 'utf8',
				'DB2_maj_db' => 'oui',
				'DB2_port' => 3306,
				'DB2_socket' => '',
				'DB2_options' => '',
				'DB2_salvosize' => '',
				'DB2_SQL_type' => 'mysql',
				'DB2_SQL_sort_en_erreur' => 'non' 
		), "DB2" ) );
	}

	/**
     * @covers fonctions_standards_sgbd::renvoi_parametres_database
     */
	public function testrenvoi_parametres_database_False() {
		
		$this->getListeOption ()
			->expects ( $this->any () )
			->method ( 'getOption' )
			->will ( $this->onConsecutiveCalls ( "multi", "DB1" ) );
		$this->getListeOption ()
			->expects ( $this->any () )
			->method ( 'getListeOption' )
			->will ( $this->returnValue ( array () ) );
		$this->assertFalse ( $this->object->renvoi_parametres_database ( $this->getListeOption (), "DB2" ) );
	}

	/**
	 * @covers fonctions_standards_sgbd::renvoi_parametres_database
	 */
	public function testrenvoi_parametres_database_Data() {
		
		$this->getListeOption ()
			->expects ( $this->any () )
			->method ( 'getOption' )
			->will ( $this->onConsecutiveCalls ( "multi", "DB1" ) );
		$this->getListeOption ()
			->expects ( $this->any () )
			->method ( 'getListeOption' )
			->will ( $this->returnValue ( array () ) );
		$this->assertEquals ( Array (
				'using' => 'oui',
				'dbhost' => 'localhost',
				'username' => 'nobody',
				'password' => '',
				'database' => 'aucuneBD',
				'encode' => 'utf8',
				'maj_db' => 'oui',
				'port' => 3306,
				'socket' => '',
				'options' => '',
				'salvosize' => '',
				'type' => 'mysql',
				'sort_en_erreur' => 'oui' 
		), $this->object->renvoi_parametres_database ( $this->getListeOption (), "DB1" ) );
	}

	/**
     * @covers fonctions_standards_sgbd::creer_connexion_liste_option
     */
	public function testCreer_connexion_liste_option_False() {
		
		;
		$this->getListeOption ()
			->expects ( $this->any () )
			->method ( 'verifie_option_existe' )
			->will ( $this->returnValue ( false ) );
		$this->assertFalse ( $this->object->creer_connexion_liste_option ( $this->getListeOption () ) );
	}

	/**
	 * @covers fonctions_standards_sgbd::recupere_db
	 */
	public function testRecupere_db__False() {
		$connexion = false;
		$this->assertFalse ( $this->object->recupere_db ( $connexion,"test", false ) );
	}
	
	/**
	 * @covers fonctions_standards_sgbd::recupere_db
	 */
	public function testRecupere_db__FalseonError() {
		$connexion = false;
		$this->assertFalse ( $this->object->recupere_db ( $connexion,"test", true ) );
	}
	
	/**
	 * @covers fonctions_standards_sgbd::recupere_db
	 */
	public function testRecupere_db__prod() {
		$connexion = array("test_prod"=>"SGBD test connexion");
		$this->assertEquals ( "SGBD test connexion",$this->object->recupere_db ( $connexion,"test", false ) );
	}
	
	/**
	 * @covers fonctions_standards_sgbd::recupere_db
	 */
	public function testRecupere_db__preprod() {
		$connexion = array("test_preprod"=>"SGBD test connexion PP");
		$this->assertEquals ( "SGBD test connexion PP",$this->object->recupere_db ( $connexion,"test", false ) );
	}
	
	/**
	 * @covers fonctions_standards_sgbd::recupere_db
	 */
	public function testRecupere_db__dev() {
		$connexion = array("test_dev"=>"SGBD test connexion Dev");
		$this->assertEquals ( "SGBD test connexion Dev",$this->object->recupere_db ( $connexion,"test", false ) );
	}
	
	/**
	 * @covers fonctions_standards_sgbd::recupere_db_cacti
	 */
	public function testRecupere_db_cacti_prod() {
		$connexion = array("cacti_prod"=>"SGBD connexion");
		$this->assertEquals ( "SGBD connexion",$this->object->recupere_db_cacti ( $connexion, false ) );
	}
	
	/**
	 * @covers fonctions_standards_sgbd::recupere_db_gestion_cacti
	 */
	public function testRecupere_db_gestion_cacti_prod() {
		$connexion = array("gestion_cacti_prod"=>"SGBD connexion");
		$this->assertEquals ( "SGBD connexion",$this->object->recupere_db_gestion_cacti ( $connexion, false ) );
	}
	
	/**
	 * @covers fonctions_standards_sgbd::recupere_db_gestion_idat
	 */
	public function testRecupere_db_gestion_idat_prod() {
		$connexion = array("gestion_idat_prod"=>"SGBD connexion");
		$this->assertEquals ( "SGBD connexion",$this->object->recupere_db_gestion_idat ( $connexion, false ) );
	}
	
	/**
	 * @covers fonctions_standards_sgbd::recupere_db_gestion_zabbix
	 */
	public function testRecupere_db_gestion_zabbix_prod() {
		$connexion = array("gestion_zabbix_prod"=>"SGBD connexion");
		$this->assertEquals ( "SGBD connexion",$this->object->recupere_db_gestion_zabbix ( $connexion, false ) );
	}
	
	/**
	 * @covers fonctions_standards_sgbd::recupere_db_sitescope
	 */
	public function testRecupere_db_sitescope_prod() {
		$connexion = array("sitescope_prod"=>"SGBD connexion");
		$this->assertEquals ( "SGBD connexion",$this->object->recupere_db_sitescope ( $connexion, false ) );
	}
	
// 	/**
// 	 * @covers fonctions_standards_sgbd::recupere_db_bo
// 	 */
// 	public function testRecupere_db_bo_prod() {
// 		$connexion = array("bo_prod"=>"SGBD connexion");
// 		$this->assertEquals ( "SGBD connexion",$this->object->recupere_db_bo ( $connexion, false ) );
// 	}
	
	/**
	 * @covers fonctions_standards_sgbd::recupere_db_gestion_sam
	 */
	public function testrecupere_db_gestion_sam() {
		$connexion = array("gestion_sam_prod"=>"SGBD connexion");
		$this->assertEquals ( "SGBD connexion",$this->object->recupere_db_gestion_sam ( $connexion, false ) );
	}
	
// 	/**
// 	 * @covers fonctions_standards_sgbd::recupere_db_cmdb_vodafone
// 	 */
// 	public function testrecupere_db_cmdb_vodafone() {
// 		$connexion = array("cmdb_vodafone_prod"=>"SGBD connexion");
// 		$this->assertEquals ( "SGBD connexion",$this->object->recupere_db_cmdb_vodafone ( $connexion, false ) );
// 	}
}
