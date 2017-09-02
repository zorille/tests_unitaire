<?php
/**
 * @ignore
 */
if (! defined ( '__DOCUMENT_ROOT__' )) {
	require_once $_SERVER ["PWD"] . '/prepare.php';
}

/**
 * Test class for CommandLine.
 * Generated by PHPUnit on 2011-11-16 at 16:00:31.
 */
class CommandLineTest extends MockedListeOptions {
	/**
	 * @var CommandLine
	 */
	protected $object;

	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 */
	protected function setUp() {
		ob_start ();
		$this->object = new CommandLine ( false, "TESTS CommandLine" );
	}

	/**
	 * Tears down the fixture, for example, closes a network connection.
	 * This method is called after a test is executed.
	 */
	protected function tearDown() {
		ob_end_clean ();
	}

	/**
	 * @covers CommandLine::CreerListeFichiers
	 */
	public function testCreerListeFichiers_ArrayVide() {
		$liste_vide = array ();
		$this ->assertFalse ( $this->object ->creerListeFichiers ( $liste_vide ) );
	}

	/**
	 * Verifie pour un tableau de string.
	 * @covers CommandLine::CreerListeFichiers
	 */
	public function testCreerListeFichiers_ArrayString() {
		$liste_fichiers = array ( 
				"test1", 
				"test2" );
		$this ->assertEquals ( "test1,test2", $this->object ->creerListeFichiers ( $liste_fichiers ) );
	}

	/**
	 * Verifie pour un tableau de string.
	 * @covers CommandLine::CreerListeFichiers
	 */
	public function testCreerListeFichiers_ArrayStringIsFileExist() {
		$liste_fichiers = array ( 
				"test1", 
				"test2" );
		$this ->assertEquals ( "test1:test2", $this->object ->creerListeFichiers ( $liste_fichiers, ':', true ) );
	}

	/**
	 * Verifie pour un tableau de string avec des entrees vides.
	 * @covers CommandLine::CreerListeFichiers
	 */
	public function testCreerListeFichiers_ArrayStringEntreeVide() {
		$liste_fichiers = array ( 
				"test1", 
				"", 
				"", 
				"test2" );
		$this ->assertEquals ( "test1,test2", $this->object ->creerListeFichiers ( $liste_fichiers ) );
	}

	/**
	 * Verifie pour un tableau de string.
	 * @covers CommandLine::CreerListeFichiers
	 */
	public function testCreerListeFichiers_ArrayObject() {
		$fichier1 = $this ->createMock ( "relation_fichier_machine", array ( 
				"renvoi_parametre_fichier" ) );
		$fichier1 ->expects ( $this ->at ( 0 ) ) 
			->method ( 'renvoi_parametre_fichier' ) 
			->with ( 'dossier' ) 
			->will ( $this ->returnValue ( "/dossier1" ) );
		$fichier1 ->expects ( $this ->at ( 1 ) ) 
			->method ( 'renvoi_parametre_fichier' ) 
			->with ( 'nom' ) 
			->will ( $this ->returnValue ( "test1" ) );
		
		$fichier2 = $this ->createMock ( "relation_fichier_machine", array ( 
				"renvoi_parametre_fichier" ) );
		$fichier2 ->expects ( $this ->at ( 0 ) ) 
			->method ( 'renvoi_parametre_fichier' ) 
			->with ( 'dossier' ) 
			->will ( $this ->returnValue ( "/dossier2" ) );
		$fichier2 ->expects ( $this ->at ( 1 ) ) 
			->method ( 'renvoi_parametre_fichier' ) 
			->with ( 'nom' ) 
			->will ( $this ->returnValue ( "test2" ) );
		
		$liste_fichiers = array ( 
				$fichier1, 
				$fichier2 );
		$this ->assertEquals ( "/dossier1/test1,/dossier2/test2", $this->object ->creerListeFichiers ( $liste_fichiers ) );
	}

	/**
	 * Verifie qu'il y a bien 2 lignes lorsqu'il y a plus de 4000 fichiers.
	 * @covers CommandLine::CreerListeFichiers
	 */
	public function testCreerListeFichiers_ArrayStringSup4000() {
		$liste_fichiers = array ();
		$ligne_retour1 = "";
		$ligne_retour2 = "";
		
		for($i = 0; $i < 4555; $i ++) {
			$liste_fichiers [$i] = "test" . $i;
			if ($ligne_retour1 != "") {
				$ligne_retour1 .= ",";
			}
			$ligne_retour1 .= "test" . $i;
		}
		
		$this ->assertEquals ( $ligne_retour1, $this->object ->creerListeFichiers ( $liste_fichiers ) );
	}

	/**
	 * Verifie le changement de separateur.
	 * @covers CommandLine::CreerListeFichiers
	 */
	public function testCreerListeFichiers_ArrayStringAvecSeparateur() {
		$liste_fichiers = array ( 
				"test1", 
				"test2" );
		$this ->assertEquals ( "test1|test2", $this->object ->creerListeFichiers ( $liste_fichiers, "|" ) );
	}

	/**
	 * Verifie que la string est bien renvoye.
	 * @covers CommandLine::RenvoieNomFichier
	 */
	public function testRenvoieNomFichier_String() {
		$this ->assertEquals ( "test1", $this->object ->renvoieNomFichier ( "test1" ) );
	}

	/**
	 * Verifie la creation de nom automatique.
	 * @covers CommandLine::RenvoieNomFichier
	 */
	public function testRenvoieNomFichier_vide() {
		$this ->assertContains ( "fichier_" . getmypid (), $this->object ->renvoieNomFichier ( "" ) );
	}

	/**
	 * Verifie qu'un objet machine_fichier_standard est bien traite.
	 * @covers CommandLine::RenvoieNomFichier
	 */
	public function testRenvoieNomFichier_Object() {
		$fichier1 = $this ->createMock ( "relation_fichier_machine", array ( 
				"renvoi_parametre_fichier" ) );
		$fichier1 ->expects ( $this ->at ( 0 ) ) 
			->method ( 'renvoi_parametre_fichier' ) 
			->with ( 'dossier' ) 
			->will ( $this ->returnValue ( "/dossier1" ) );
		$fichier1 ->expects ( $this ->at ( 1 ) ) 
			->method ( 'renvoi_parametre_fichier' ) 
			->with ( 'nom' ) 
			->will ( $this ->returnValue ( "test1" ) );
		
		$this ->assertEquals ( "/dossier1/test1", $this->object ->renvoieNomFichier ( $fichier1 ) );
	}

	/**
	 * Verifie que la string est bien renvoye.
	 * @covers CommandLine::ExtraireFichier
	 */
	public function testExtraireFichier_String() {
		$this ->assertEquals ( "test1", $this->object ->extraireFichier ( "test1" ) );
	}

	/**
	 * Verifie qu'il n'y a pas de creation de nom automatique.
	 * @covers CommandLine::ExtraireFichier
	 */
	public function testExtraireFichier_vide() {
		$this ->assertEquals ( "", $this->object ->extraireFichier ( "" ) );
	}

	/**
	 * Verifie qu'un objet machine_fichier_standard est bien traite.
	 * @covers CommandLine::ExtraireFichier
	 */
	public function testExtraireFichier_Object() {
		$fichier1 = $this ->createMock ( "relation_fichier_machine", array ( 
				"renvoi_parametre_fichier" ) );
		$fichier1 ->expects ( $this ->at ( 0 ) ) 
			->method ( 'renvoi_parametre_fichier' ) 
			->with ( 'dossier' ) 
			->will ( $this ->returnValue ( "/dossier1" ) );
		$fichier1 ->expects ( $this ->at ( 1 ) ) 
			->method ( 'renvoi_parametre_fichier' ) 
			->with ( 'nom' ) 
			->will ( $this ->returnValue ( "test1" ) );
		
		$this ->assertEquals ( "/dossier1/test1", $this->object ->extraireFichier ( $fichier1 ) );
	}

	/**
	 * ConcatDataWithValue throws Exception
	 * @covers CommandLine::ConcatDataWithValue
	 */
	public function testConcatDataWithValue_Exception() {
		$this ->expectException(Exception::class);
        $this->expectExceptionMessage( '(TESTS CommandLine) La liste doit etre un tableau.' );
		$this->object ->ConcatDataWithValue ( "UnitTest" );
	}

	/**
	 * ConcatDataWithValue correct
	 * @covers CommandLine::ConcatDataWithValue
	 */
	public function testConcatDataWithValue_correct() {
		$this ->assertEquals ( '"DATA1,DATA2"', $this->object ->ConcatDataWithValue ( array ( 
				"DATA1", 
				"DATA2" ) ) );
	}

	/**
	 * ConcatDataWithValue throws Exception
	 * @covers CommandLine::AddParam
	 */
	public function testAddParam_Exception() {
		$this ->expectException(Exception::class);
        $this->expectExceptionMessage( '(TESTS CommandLine) Le parametre  est obligatoire.' );
		$this->object ->AddParam ( false, "", true );
	}

	/**
	 * ConcatDataWithValue with NULL
	 * @covers CommandLine::AddParam
	 */
	public function testAddParam_NULL() {
		$this ->assertEquals ( NULL, $this->object ->AddParam ( false, "", false ) );
	}

	/**
	 * ConcatDataWithValue correct
	 * @covers CommandLine::AddParam
	 */
	public function testAddParam_correct() {
		$this ->assertEquals ( ' param valeur', $this->object ->AddParam ( "param", "valeur" ) );
	}

	/**
	 * Verifie le code retour 0
	 * @covers CommandLine::executeCommandLine
	 */
	public function testExecuteCommandLine_simpleRetour0() {
		$this->object ->setCmd ( "echo test" );
		$this ->assertEquals ( 0, $this->object ->executeCommandLine ( "UnitTest" ) );
	}

	/**
	 * Verifie le code retour 1
	 * @covers CommandLine::executeCommandLine
	 */
	public function testExecuteCommandLine_Exception() {
		$this->object ->setCmd ( "eho test > /dev/null 2>&1" );
		$this ->expectException(Exception::class);
        $this->expectExceptionMessage( '(TESTS CommandLine) Le service UnitTest s\'est termine en erreur.' );
		$this->object ->executeCommandLine ( "UnitTest" );
	}

	/**
	 * Verifie le code retour false
	 * @covers CommandLine::executeCommandLine
	 */
	public function testExecuteCommandLine_vide() {
		$this->object ->setCmd ( "" );
		$this ->assertEquals ( false, $this->object ->executeCommandLine ( "", "UnitTest" ) );
	}

	/**
	 * Verifie que les parametres sont bien traite.
	 * @covers CommandLine::executeCommandLine
	 */
	public function testExecuteCommandLine_AvecParam() {
		$texte = "[Ram]123456";
		$this->object ->setCmd ( "echo " . $texte );
		$this ->assertEquals ( 0, $this->object ->executeCommandLine ( "UnitTest" ) );
		$this ->assertEquals ( "123456", $this->object ->getRam () );
	}

	/**
	 * AfficheLogs correct
	 * @covers CommandLine::AfficheLogs
	 */
	public function testAfficheLogs_String() {
		$this ->assertFalse ( $this->object ->AfficheLogs ( "VAL" ) );
	}

	/**
	 * AfficheLogs correct
	 * @covers CommandLine::AfficheLogs
	 */
	public function testAfficheLogs_Array() {
		$this ->assertTrue ( $this->object ->AfficheLogs ( array ( 
				"VAL" ) ) );
	}

	/**
	 * Verifie la condition is_array().
	 * @covers CommandLine::recupereInfoDesLogs
	 */
	public function testRecupereInfoDesLogs_sansTableau() {
		$tableau = "";
		$this ->assertFalse ( $this->object ->recupereInfoDesLogs ( $tableau ) );
	}

	/**
	 * Verifie la condition is_array().
	 * @covers CommandLine::recupereInfoDesLogs
	 */
	public function testRecupereInfoDesLogs_avecTableau() {
		$tableau = array ( 
				0, 
				"", 
				"[Ram]123456", 
				"[Lines]321546", 
				"[Time]789456" );
		$this ->assertTrue ( $this->object ->recupereInfoDesLogs ( $tableau ) );
		$this ->assertEquals ( "123456", $this->object ->getRam () );
		$this ->assertEquals ( "789456", $this->object ->getTime () );
		$this ->assertEquals ( array ( 
				'NoSerial' => "321546" ), $this->object ->getNbLigne () );
	}
}
?>
