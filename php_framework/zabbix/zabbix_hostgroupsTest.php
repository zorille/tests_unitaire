<?php
namespace Zorille\framework;
use \Exception as Exception;
if (! defined ( '__DOCUMENT_ROOT__' )) {
	require_once $_SERVER ["PWD"] . '/prepare.php';
}

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2014-08-25 at 16:53:15.
 */
class zabbix_hostgroupsTest extends MockedListeOptions {
	/**
     * @var zabbix_hostgroups
     */
	protected $object;

	/**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
	protected function setUp() {
		ob_start ();
		
		$zabbix_wsclient = $this ->createMock('Zorille\framework\zabbix_wsclient' );
		$zabbix_hostgroup_reference = $this ->createMock('Zorille\framework\zabbix_hostgroup' );
		
		$this->object = new zabbix_hostgroups ( false, "TESTS zabbix_hostgroups" );
		$this->object ->setListeOptions ( $this ->getListeOption () );
		$this->object ->setObjetZabbixWsclient ( $zabbix_wsclient );
		$this->object ->setObjetHostGroupRef ( $zabbix_hostgroup_reference );
	}

	/**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
	protected function tearDown() {
		ob_end_clean ();
	}

	/**
	 * @covers Zorille\framework\zabbix_hostgroups::retrouve_zabbix_param
	 */
	public function testRetrouve_zabbix_param_Exception() {
		$this ->getListeOption () 
			->expects ( $this ->any () ) 
			->method ( 'verifie_variable_standard' ) 
			->will ( $this ->returnValue ( false ) );
		$this->object ->setListeOptions ( $this ->getListeOption () );
		$this ->expectException(Exception::class);
        $this->expectExceptionMessage( '(TESTS zabbix_hostgroups) Il manque le parametre : zabbix_host_groups' );
		$this->object ->retrouve_zabbix_param ();
		
		$this ->assertEquals ( array (), $this->object ->getListeGroups () );
	}

	/**
	 * @covers Zorille\framework\zabbix_hostgroups::retrouve_zabbix_param
	 */
	public function testRetrouve_zabbix_param() {
		$this ->getListeOption () 
			->expects ( $this ->any () ) 
			->method ( 'verifie_variable_standard' ) 
			->will ( $this ->returnValue ( true ) );
		$this ->getListeOption () 
			->expects ( $this ->any () ) 
			->method ( 'renvoi_variables_standard' ) 
			->will ( $this ->onConsecutiveCalls ( 'val1', array ( 
				'val2' ) ) );
		$this->object ->setListeOptions ( $this ->getListeOption () );
		
		$this ->assertSame ( $this->object, $this->object ->retrouve_zabbix_param () );
		$this ->assertSame ( $this->object, $this->object ->retrouve_zabbix_param () );
	}

	/**
	 * @covers Zorille\framework\zabbix_hostgroups::ajoute_groupe_a_partir_cli
	 */
	public function testAjoute_groupe_a_partir_cli() {
		$liste_groupes_cli = array ( 
				"val1", 
				"val2" );
		$liste_groupes = array ( 
				"val1" => array ( 
						"groupeid" => '', 
						"name" => "val1", 
						"exist" => false ), 
				"val2" => array ( 
						"groupeid" => '', 
						"name" => "val2", 
						"exist" => false ) );
		$this->object ->setListeGroupsCli ( $liste_groupes_cli );
		$this->object ->setListeGroups ( $liste_groupes );
		
		$this ->assertSame ( $this->object, $this->object ->ajoute_groupe_a_partir_cli () );
		$this ->assertSame ( array ( 
				"val1" => array ( 
						"groupeid" => '', 
						"name" => "val1", 
						"exist" => true ), 
				"val2" => array ( 
						"groupeid" => '', 
						"name" => "val2", 
						"exist" => true ) ), $this->object ->getListeGroups () );
	}

	/**
		 * @covers Zorille\framework\zabbix_hostgroups::retire_groupe_a_partir_cli
		 */
	public function testRetire_groupe_a_partir_cli() {
		$liste_groupes_cli = array ( 
				"val1" );
		$liste_groupes = array ( 
				"val1" => array ( 
						"groupeid" => '', 
						"name" => "val1", 
						"exist" => true ), 
				"val2" => array ( 
						"groupeid" => '', 
						"name" => "val2", 
						"exist" => true ) );
		$this->object ->setListeGroupsCli ( $liste_groupes_cli );
		$this->object ->setListeGroups ( $liste_groupes );
		
		$this ->assertSame ( $this->object, $this->object ->retire_groupe_a_partir_cli () );
		$this ->assertSame ( array ( 
				"val1" => array ( 
						"groupeid" => '', 
						"name" => "val1", 
						"exist" => false ), 
				"val2" => array ( 
						"groupeid" => '', 
						"name" => "val2", 
						"exist" => true ) ), $this->object ->getListeGroups() );
	}

	/**
	 * @covers Zorille\framework\zabbix_hostgroups::RemplaceValeurListeGroups
	 */
	public function testRemplaceValeurListeGroups_exception() {
		$liste_groups = array ( 
				"NOM1" => array ( 
						"name" => "NOM1", 
						"groupid" => 1, 
						"exist" => true ), 
				"NOM2" => array ( 
						"name" => "NOM2", 
						"groupid" => 2, 
						"exist" => false ) );
		$this->object ->setListeGroups ( $liste_groups );
		$this ->expectException(Exception::class);
        $this->expectExceptionMessage( '(TESTS zabbix_hostgroups) le groupe NOM10 n\'existe pas.' );
		$this ->assertSame ( $this->object, $this->object ->RemplaceValeurListeGroups ( "NOM10", "exist", false ) );
		
		$this ->assertSame ( array ( 
				"NOM1" => array ( 
						"name" => "NOM1", 
						"groupid" => 1, 
						"exist" => true ), 
				"NOM2" => array ( 
						"name" => "NOM2", 
						"groupid" => 2, 
						"exist" => false ) ), $this->object ->getListeGroups () );
	}

	/**
	 * @covers Zorille\framework\zabbix_hostgroups::RemplaceValeurListeGroups
	 */
	public function testRemplaceValeurListeGroups_valide() {
		$liste_groups = array ( 
				"NOM1" => array ( 
						"name" => "NOM1", 
						"groupid" => 1, 
						"exist" => true ), 
				"NOM2" => array ( 
						"name" => "NOM2", 
						"groupid" => 2, 
						"exist" => false ) );
		$this->object ->setListeGroups ( $liste_groups );
		$this ->assertSame ( $this->object, $this->object ->RemplaceValeurListeGroups ( "NOM10", "exist", false, false ) );
		$this ->assertSame ( array ( 
				"NOM1" => array ( 
						"name" => "NOM1", 
						"groupid" => 1, 
						"exist" => true ), 
				"NOM2" => array ( 
						"name" => "NOM2", 
						"groupid" => 2, 
						"exist" => false ) ), $this->object ->getListeGroups () );
		$this ->assertSame ( $this->object, $this->object ->RemplaceValeurListeGroups ( "NOM1", "exist", false, false ) );
		$this ->assertSame ( array ( 
				"NOM1" => array ( 
						"name" => "NOM1", 
						"groupid" => 1, 
						"exist" => false ), 
				"NOM2" => array ( 
						"name" => "NOM2", 
						"groupid" => 2, 
						"exist" => false ) ), $this->object ->getListeGroups () );
	}

	/**
	 * @covers Zorille\framework\zabbix_hostgroups::creer_liste_groups
	 */
	public function testCreer_liste_groups() {
		$liste_groups = array ( 
				"NOM1" => array ( 
						"name" => "NOM1", 
						"exist" => false ), 
				"NOM2" => array ( 
						"name" => "NOM2", 
						"groupid" => 2, 
						"exist" => true ) );
		$this->object ->setListeGroups ( $liste_groups );
		
		$this->object ->getObjetHostGroupRef () 
			->expects ( $this ->any () ) 
			->method ( 'creer_hostGroup' ) 
			->will ( $this ->onConsecutiveCalls ( false, array ( 
				"groupids" => array ( 
						10 ) ) ) );
		
		//Creation impossible
		$this ->assertSame ( $this->object, $this->object ->creer_liste_groups () );
		$this ->assertSame ( array ( 
				"NOM1" => array ( 
						"name" => "NOM1", 
						"exist" => false ), 
				"NOM2" => array ( 
						"name" => "NOM2", 
						"groupid" => 2, 
						"exist" => true ) ), $this->object ->getListeGroups () );
		
		//Creation reussi
		$this ->assertSame ( $this->object, $this->object ->creer_liste_groups () );
		$this ->assertSame ( array ( 
				"NOM1" => array ( 
						"name" => "NOM1", 
						"exist" => true, 
						"groupid" => 10 ), 
				"NOM2" => array ( 
						"name" => "NOM2", 
						"groupid" => 2, 
						"exist" => true ) ), $this->object ->getListeGroups () );
	}

	/**
	 * @covers Zorille\framework\zabbix_hostgroups::recherche_liste_groups
	 */
	public function testRecherche_liste_groups() {
		$liste_groups = array ( 
				array ( 
						"name" => "NOM1", 
						"groupid" => 1 ), 
				array ( 
						"name" => "NOM2", 
						"groupid" => 2 ) );
		$this->object ->getObjetZabbixWsclient () 
			->expects ( $this ->any () ) 
			->method ( 'hostgroupGet' ) 
			->will ( $this ->returnValue ( $liste_groups ) );
		$this ->assertSame ( $this->object, $this->object ->recherche_liste_groups () );
		$this ->assertSame ( array ( 
				"NOM1" => array ( 
						"groupid" => 1, 
						"name" => "NOM1", 
						"exist" => true ), 
				"NOM2" => array ( 
						"groupid" => 2, 
						"name" => "NOM2", 
						"exist" => true ) ), $this->object ->getListeGroups () );
	}

	/**
     * @covers Zorille\framework\zabbix_hostgroups::valide_liste_groups
     */
	public function testValide_liste_groups() {
		$liste_groups = array ( 
				array ( 
						"name" => "NOM1", 
						"groupid" => 1 ), 
				array ( 
						"name" => "NOM2", 
						"groupid" => 2 ) );
		$this->object ->getObjetZabbixWsclient () 
			->expects ( $this ->any () ) 
			->method ( 'hostgroupGet' ) 
			->will ( $this ->returnValue ( $liste_groups ) );
		$this ->assertSame ( $this->object, $this->object ->valide_liste_groups () );
		$this ->assertSame ( array (), $this->object ->getListeGroups () );
	}
	
	/**
	 * @covers Zorille\framework\zabbix_hostgroups::ajoute_liste_groupes_a_partir_de_tableau
	 */
	public function testAjoute_liste_groupes_a_partir_de_tableau() {
		$liste_groupes = array (
				"NOM1" => array (
						"name" => "NOM1",
						"groupid" => 1,
						"exist" => false ),
				"NOM2" => array (
						"name" => "NOM2",
						"groupid" => 2,
						"exist" => false ) );
		$this->object ->setListeGroups ( $liste_groupes );
	
		$liste_ids = array (
				10,
				2 );
	
		$this ->assertSame ( $this->object, $this->object ->ajoute_liste_groupes_a_partir_de_tableau ( $liste_ids ) );
		$this ->assertSame ( array (
				"NOM1" => array (
						"name" => "NOM1",
						"groupid" => 1,
						"exist" => false ),
				"NOM2" => array (
						"name" => "NOM2",
						"groupid" => 2,
						"exist" => true ) ), $this->object ->getListeGroups () );
	}
	
	/**
	 * @covers Zorille\framework\zabbix_hostgroups::valide_liste_groupes_a_partir_de_tableau
	 */
	public function testValide_liste_groupes_a_partir_de_tableau() {
		$liste_groupes = array (
				"NOM1" => array (
						"name" => "NOM1",
						"groupid" => 1,
						"exist" => true ),
				"NOM2" => array (
						"name" => "NOM2",
						"groupid" => 2,
						"exist" => false ) );
		$this->object ->setListeGroups ( $liste_groupes );
	
		$liste_ids = array (
				10,
				2 );
	
		$this ->assertSame ( $this->object, $this->object ->valide_liste_groupes_a_partir_de_tableau ( $liste_ids ) );
		$this ->assertSame ( array (
				"NOM1" => array (
						"name" => "NOM1",
						"groupid" => 1,
						"exist" => false ),
				"NOM2" => array (
						"name" => "NOM2",
						"groupid" => 2,
						"exist" => true ) ), $this->object ->getListeGroups () );
	}
	
	/**
	 * @covers Zorille\framework\zabbix_hostgroups::invalide_liste_groupes_a_partir_de_tableau
	 */
	public function testInvalide_liste_groupes_a_partir_de_tableau() {
		$liste_groupes = array (
				"NOM1" => array (
						"name" => "NOM1",
						"groupid" => 1,
						"exist" => false ),
				"NOM2" => array (
						"name" => "NOM2",
						"groupid" => 2,
						"exist" => true ),
				"NOM3" => array (
						"name" => "NOM3",
						"groupid" => 3,
						"exist" => true ) );
		$this->object ->setListeGroups ( $liste_groupes );
	
		$liste_ids = array (
				10,
				2 );
	
		$this ->assertSame ( $this->object, $this->object ->invalide_liste_groupes_a_partir_de_tableau ( $liste_ids ) );
		$this ->assertSame (
				array (
						"NOM1" => array (
								"name" => "NOM1",
								"groupid" => 1,
								"exist" => false ),
						"NOM2" => array (
								"name" => "NOM2",
								"groupid" => 2,
								"exist" => false ),
						"NOM3" => array (
								"name" => "NOM3",
								"groupid" => 3,
								"exist" => true ) ),
				$this->object ->getListeGroups () );
	}

	/**
	 * @covers Zorille\framework\zabbix_hostgroups::creer_definition_groupsids_ws
	 */
	public function testcreer_definition_groupsids_ws() {
		$liste_groups = array ( 
				array ( 
						"name" => "NOM1", 
						"groupid" => 1 ), 
				array ( 
						"name" => "NOM2", 
						"groupid" => 2 ) );
		$this->object ->getObjetZabbixWsclient () 
			->expects ( $this ->any () ) 
			->method ( 'hostgroupGet' ) 
			->will ( $this ->returnValue ( $liste_groups ) );
		$this->object ->recherche_liste_groups ();
		
		$this ->assertEquals ( array ( 
				0 => array ( 
						"groupid" => 1 ), 
				1 => array ( 
						"groupid" => 2 ) ), $this->object ->creer_definition_groupsids_ws () );
	}

	/**
	 * @covers Zorille\framework\zabbix_hostgroups::creer_definition_groupsids_sans_champ_groupid_ws
	 */
	public function testcreer_definition_groupsids_sans_champ_groupid_ws() {
		$liste_groups = array ( 
				array ( 
						"name" => "NOM1", 
						"groupid" => 1 ), 
				array ( 
						"name" => "NOM2", 
						"groupid" => 2 ) );
		$this->object ->getObjetZabbixWsclient () 
			->expects ( $this ->any () ) 
			->method ( 'hostgroupGet' ) 
			->will ( $this ->returnValue ( $liste_groups ) );
		$this->object ->recherche_liste_groups ();
		
		$this ->assertEquals ( array ( 
				1, 
				2 ), $this->object ->creer_definition_groupsids_sans_champ_groupid_ws () );
	}

	/**
	 * @covers Zorille\framework\zabbix_hostgroups::retrouve_hostgroupId
	 */
	public function testRetrouve_hostgroupId() {
		$liste_groups = array ( 
				array ( 
						"name" => "NOM1", 
						"groupid" => 1, 
						"exist" => true ), 
				array ( 
						"name" => "NOM2", 
						"groupid" => 2, 
						"exist" => false ) );
		$this->object ->setListeGroups ( $liste_groups );
		
		$this ->assertFalse ( $this->object ->retrouve_hostgroupId ( "no name" ) );
		$this ->assertFalse ( $this->object ->retrouve_hostgroupId ( "NOM2" ) );
		$this ->assertEquals ( 1, $this->object ->retrouve_hostgroupId ( "NOM1" ) );
	}
}
