<?php
namespace Zorille\framework;
/**
 * @ignore
 */
if (! defined ( '__DOCUMENT_ROOT__' )) {
	require_once $_SERVER ["PWD"] . '/prepare.php';
}

require_once __DOCUMENT_ROOT__ . '/sgbd/rep_requete/Zorille_framework_xql.class.php';
use Zorille\framework;
/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2014-06-04 at 12:16:00.
 */
class xqlTest extends MockedListeOptions {
	/**
     * @var xql
     */
	protected $object;

	/**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
	protected function setUp() {
		ob_start ();
		$this->object =  $this->getMockForAbstractClass ('Zorille\framework\xql');
	}

	/**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
	protected function tearDown() {
		ob_end_clean ();
	}

	/**
     * @covers Zorille\framework\xql::creer_where
     * Implement testCreer_where().
     */
	public function testCreer_where() {
		$this->assertEquals ( "", $this->object->creer_where ( "" ) );
		$this->assertEquals ( " WHERE test='oui'", $this->object->creer_where ( "test='oui'" ) );
		$this->assertEquals ( " WHERE test1='oui' AND test2='non'", $this->object->creer_where ( array (
				"test1='oui'",
				"test2='non'" 
		) ) );
	}

	/**
     * @covers Zorille\framework\xql::creer_liste_and
     * Implement testCreer_liste_and().
     */
	public function testCreer_liste_and() {
		$this->assertEquals ( "", $this->object->creer_liste_and ( "" ) );
		$this->assertEquals ( "", $this->object->creer_liste_and ( "test='oui'" ) );
		$this->assertEquals ( "test1='oui' AND test2='non'", $this->object->creer_liste_and ( array (
				"test1='oui'",
				"test2='non'" 
		) ) );
	}

	/**
     * @covers Zorille\framework\xql::creer_liste_or
     * Implement testCreer_liste_or().
     */
	public function testCreer_liste_or() {
		$this->assertEquals ( "", $this->object->creer_liste_or ( "" ) );
		$this->assertEquals ( "", $this->object->creer_liste_or ( "test='oui'" ) );
		$this->assertEquals ( "test1='oui' OR test2='non'", $this->object->creer_liste_or ( array (
				"test1='oui'",
				"test2='non'" 
		) ) );
	}

	/**
     * @covers Zorille\framework\xql::creer_liste
     * Implement testCreer_liste().
     */
	public function testCreer_liste() {
		$this->assertFalse ( $this->object->creer_liste ( "" ) );
		$this->assertFalse ( $this->object->creer_liste ( "test='oui'" ) );
		$this->assertEquals ( "val1,val2", $this->object->creer_liste ( array (
				"val1",
				"val2" 
		) ) );
		$this->assertEquals ( "'val1','val2'", $this->object->creer_liste ( array (
				"val1",
				"val2" 
		), "'" ) );
	}

	/**
     * @covers Zorille\framework\xql::choisie_type_where
     */
	public function testChoisie_type_where() {
		//text
		$this->assertEquals ( "champ='val1'", $this->object->choisie_type_where ( "champ", "val1", "text" ) );
		$this->assertEquals ( "champ<>'val1'", $this->object->choisie_type_where ( "champ", "!val1", "text" ) );
		
		//numeric
		$this->assertEquals ( "champ=1", $this->object->choisie_type_where ( "champ", "1", "numeric" ) );
		
		//date
		$this->assertEquals ( "champ='2010-05-25 00:40:45'", $this->object->choisie_type_where ( "champ", "2010-05-25 00:40:45", "date" ) );
		
		//type inconnu
		$this->assertEquals ( "champ=val1", $this->object->choisie_type_where ( "champ", "val1", "inconnu" ) );
		
		//gestion_not numeric
		$this->assertEquals ( "champ<>1", $this->object->choisie_type_where ( "champ", "!1", "numeric" ) );
		$this->assertEquals ( "champ  NOT  IN (1,2)", $this->object->choisie_type_where ( "champ", array (
				"!1",
				"2" 
		), "numeric" ) );
		$this->assertEquals ( "champ  NOT  IN (1,2)", $this->object->choisie_type_where ( "champ", "!1,2", "numeric" ) );
	}

	/**
	 * @covers Zorille\framework\xql::gestion_not
	 */
	public function testGestion_not_text() {
		$not = "";
		$not_text = "";
		$valeur = "!val1";
		//gestion_not text
		$this->assertSame ( $this->object, $this->object->gestion_not ( $not, $not_text, $valeur ) );
		$this->assertEquals ( " NOT ", $not );
		$this->assertEquals ( "<>", $not_text );
		$this->assertEquals ( "val1", $valeur );
	}

	/**
	 * @covers Zorille\framework\xql::gestion_not
	 */
	public function testGestion_not_textFalse() {
		$not = "";
		$not_text = "";
		$valeur = "v!al1";
		//gestion_not text
		$this->assertSame ( $this->object, $this->object->gestion_not ( $not, $not_text, $valeur ) );
		$this->assertEquals ( "", $not );
		$this->assertEquals ( "=", $not_text );
		$this->assertEquals ( "v!al1", $valeur );
	}

	/**
	 * @covers Zorille\framework\xql::gestion_not
	 */
	public function testGestion_not_Array() {
		$not = "";
		$not_text = "";
		$valeur = array (
				"!1",
				"2" 
		);
		//gestion_not text
		$this->assertSame ( $this->object, $this->object->gestion_not ( $not, $not_text, $valeur ) );
		$this->assertEquals ( " NOT ", $not );
		$this->assertEquals ( "<>", $not_text );
		$this->assertEquals ( array (
				"1",
				"2" 
		), $valeur );
	}

	/**
	 * @covers Zorille\framework\xql::valide_sous_requete
	 */
	public function testValide_sous_requeteFalse() {
		$this->assertFalse ( $this->object->valide_sous_requete ( "REQUESTS" ) );
	}

	/**
	 * @covers Zorille\framework\xql::valide_sous_requete
	 */
	public function testValide_sous_requeteTrue() {
		$this->assertTrue ( $this->object->valide_sous_requete ( "SELECT REQUESTS" ) );
	}

	/**
	 * @covers Zorille\framework\xql::traite_type_text
	 */
	public function testTraite_type_textDefaut() {
		$this->assertEquals ( "champ1<>'valeur1'", $this->object->traite_type_text ( "champ1", "valeur1", " NOT ", "<>" ) );
	}

	/**
	 * @covers Zorille\framework\xql::traite_type_text
	 */
	public function testTraite_type_textValeurTextSousRequete() {
		$this->assertEquals ( "champ1  NOT  IN (SELECT valeur1)", $this->object->traite_type_text ( "champ1", "SELECT valeur1", " NOT ", "<>" ) );
	}

	/**
	 * @covers Zorille\framework\xql::traite_type_text
	 */
	public function testTraite_type_textValeurTextLike() {
		$this->assertEquals ( "champ1  NOT  LIKE 'valeur%'", $this->object->traite_type_text ( "champ1", "valeur%", " NOT ", "<>" ) );
	}

	/**
	 * @covers Zorille\framework\xql::traite_type_text
	 */
	public function testTraite_type_textValeurTextList() {
		$this->assertEquals ( "champ1  NOT  IN ('valeur1','valeur2')", $this->object->traite_type_text ( "champ1", "valeur1','valeur2", " NOT ", "<>" ) );
	}

	/**
	 * @covers Zorille\framework\xql::traite_type_text
	 */
	public function testTraite_type_textValeurArray() {
		$this->assertEquals ( "champ1  NOT  IN ('valeur1','valeur2')", $this->object->traite_type_text ( "champ1", array (
				"valeur1",
				"valeur2" 
		), " NOT ", "<>" ) );
	}

	/**
	 * @covers Zorille\framework\xql::traite_type_text
	 */
	public function testTraite_type_textValeurArraySousRequete() {
		$this->assertEquals ( "champ1  NOT  IN (SELECT valeur1)", $this->object->traite_type_text ( "champ1", array (
				"SELECT valeur1" 
		), " NOT ", "<>" ) );
	}

	/**
	 * @covers Zorille\framework\xql::traite_type_numeric
	 */
	public function testTraite_type_numericDefaut() {
		$this->assertEquals ( "champ1=1", $this->object->traite_type_numeric ( "champ1", 1, "  ", "=" ) );
	}

	/**
	 * @covers Zorille\framework\xql::traite_type_numeric
	 */
	public function testTraite_type_numericDefautNot() {
		$this->assertEquals ( "champ1<>1", $this->object->traite_type_numeric ( "champ1", 1, " NOT ", "<>" ) );
	}

	/**
	 * @covers Zorille\framework\xql::traite_type_numeric
	 */
	public function testTraite_type_numericArray() {
		$this->assertEquals ( "champ1  NOT  IN (1,2)", $this->object->traite_type_numeric ( "champ1", array (
				1,
				2 
		), " NOT ", "<>" ) );
	}

	/**
	 * @covers Zorille\framework\xql::traite_type_numeric
	 */
	public function testTraite_type_numericBETWEEN() {
		$this->assertEquals ( "champ1 BETWEEN 1 AND 2", $this->object->traite_type_numeric ( "champ1", "BETWEEN 1 AND 2", " NOT ", "<>" ) );
	}

	/**
	 * @covers Zorille\framework\xql::traite_type_numeric
	 */
	public function testTraite_type_numericSUP() {
		$this->assertEquals ( "champ1 >1", $this->object->traite_type_numeric ( "champ1", ">1", " NOT ", "<>" ) );
	}

	/**
	 * @covers Zorille\framework\xql::traite_type_numeric
	 */
	public function testTraite_type_numericINF() {
		$this->assertEquals ( "champ1 <=1", $this->object->traite_type_numeric ( "champ1", "<=1", " NOT ", "<>" ) );
	}

	/**
	 * @covers Zorille\framework\xql::traite_type_numeric
	 */
	public function testTraite_type_numericList() {
		$this->assertEquals ( "champ1  NOT  IN (1,2)", $this->object->traite_type_numeric ( "champ1", "1,2", " NOT ", "<>" ) );
	}

	/**
	 * @covers Zorille\framework\xql::traite_type_date
	 */
	public function testTraite_type_dateDefaut() {
		$this->assertEquals ( "champ1='2010-05-25 00:40:45'", $this->object->traite_type_date ( "champ1", "2010-05-25 00:40:45", "  ", "=" ) );
	}

	/**
	 * @covers Zorille\framework\xql::traite_type_date
	 */
	public function testTraite_type_dateArray() {
		$this->assertEquals ( "champ1  IN ('2010-05-25 00:40:45','2010-05-25 00:40:46')", $this->object->traite_type_date ( "champ1", array (
				"2010-05-25 00:40:45",
				"2010-05-25 00:40:46" 
		), "", "=" ) );
	}

	/**
	 * @covers Zorille\framework\xql::traite_type_date
	 */
	public function testTraite_type_dateBETWEEN() {
		$this->assertEquals ( "champ1 BETWEEN '1' AND '2'", $this->object->traite_type_date ( "champ1", "BETWEEN '1' AND '2'", "", "=" ) );
	}

	/**
	 * @covers Zorille\framework\xql::traite_type_date
	 */
	public function testTraite_type_dateSUP() {
		$this->assertEquals ( "champ1 > '1'", $this->object->traite_type_date ( "champ1", "> '1'", "", "=" ) );
	}

	/**
	 * @covers Zorille\framework\xql::traite_type_date
	 */
	public function testTraite_type_dateINF() {
		$this->assertEquals ( "champ1 < '1'", $this->object->traite_type_date ( "champ1", "< '1'", "", "=" ) );
	}

	/**
	 * @covers Zorille\framework\xql::traite_type_date
	 */
	public function testTraite_type_dateList() {
		$this->assertEquals ( "champ1  IN ('1','2')", $this->object->traite_type_date ( "champ1", "1','2", "", "=" ) );
	}

	/**
     * @covers Zorille\framework\xql::choisie_type_set
     */
	public function testChoisie_type_set() {
		//text
		$this->assertEquals ( "champ='val1'", $this->object->choisie_type_set ( "champ", "val1", "text" ) );
		$this->assertEquals ( "champ=''", $this->object->choisie_type_set ( "champ", "", "text" ) );
		$this->assertEquals ( "champ=''", $this->object->choisie_type_set ( "champ", NULL, "text" ) );
		$this->assertEquals ( "champ=NULL", $this->object->choisie_type_set ( "champ", "NULL", "text" ) );
		
		//numeric
		$this->assertEquals ( "champ=1", $this->object->choisie_type_set ( "champ", "1", "numeric" ) );
		$this->assertEquals ( "", $this->object->choisie_type_set ( "champ", "", "numeric" ) );
		
		//numeric
		$this->assertEquals ( "champ='1'", $this->object->choisie_type_set ( "champ", "1", "date" ) );
		$this->assertEquals ( "", $this->object->choisie_type_set ( "champ", "", "date" ) );
		$this->assertEquals ( "champ=function(1)", $this->object->choisie_type_set ( "champ", "function(1)", "date" ) );
		
		//inconnu
		$this->assertEquals ( "champ=1", $this->object->choisie_type_set ( "champ", "1", "inconnu" ) );
	}

	/**
     * @covers Zorille\framework\xql::prepare_order_by
     * Implement testPrepare_order_by().
     */
	public function testPrepare_order_by() {
		$this->assertEquals ( "", $this->object->prepare_order_by ( "" ) );
		$this->assertEquals ( "", $this->object->prepare_order_by ( array () ) );
		$this->assertEquals ( "", $this->object->prepare_order_by ( array (
				array (
						"type" => "",
						"champ" => "" 
				) 
		) ) );
		$this->assertEquals ( "", $this->object->prepare_order_by ( array (
				array (
						"type" => "",
						"champ" => "donnee" 
				) 
		) ) );
		$this->assertEquals ( "ORDER BY donnee  ASC", $this->object->prepare_order_by ( array (
				array (
						"type" => " ASC",
						"champ" => "donnee" 
				) 
		) ) );
		$this->assertEquals ( "ORDER BY donnee  DESC", $this->object->prepare_order_by ( array (
				array (
						"type" => " DESC",
						"champ" => "donnee" 
				) 
		) ) );
		$this->assertEquals ( "ORDER BY donnee1  DESC,donnee2  ASC", $this->object->prepare_order_by ( array (
				array (
						"type" => " DESC",
						"champ" => "donnee1" 
				),
				array (
						"type" => " ASC",
						"champ" => "donnee2" 
				) 
		) ) );
	}

	/**
     * @covers Zorille\framework\xql::traite_valeur_null
     * Implement testTraite_valeur_null().
     */
	public function testTraite_valeur_null() {
		$this->assertEquals ( "''", $this->object->traite_valeur_null ( NULL ) );
		$this->assertEquals ( "NULL", $this->object->traite_valeur_null ( "NULL" ) );
		$this->assertEquals ( "null", $this->object->traite_valeur_null ( "null" ) );
		$this->assertEquals ( "'test'", $this->object->traite_valeur_null ( "test" ) );
		$this->assertEquals ( "\"message:'oui'\"", $this->object->traite_valeur_null ( "message:'oui'" ) );
	}
}
