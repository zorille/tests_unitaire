<?php
if (! defined ( '__DOCUMENT_ROOT__' )) {
	require_once $_SERVER ["PWD"] . '/prepare.php';
}

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2014-08-25 at 16:53:15.
 */
class solarwinds_wsclient_restTest extends MockedListeOptions {
	/**
	 *
	 * @var solarwinds_wsclient_rest
	 */
	protected $object;

	/**
	 * Sets up the fixture, for example, opens a network connection. This method is called before a test is executed.
	 */
	protected function setUp() {
		ob_start ();
		
		$utilisateurs = $this ->createMock ( "utilisateurs" );
		$utilisateurs ->expects ( $this ->any () ) 
			->method ( 'setUsername' ) 
			->will ( $this ->returnSelf () );
		$utilisateurs ->expects ( $this ->any () ) 
			->method ( 'setPassword' ) 
			->will ( $this ->returnSelf () );
		$gestion_connexion_url = $this ->createMock ( "gestion_connexion_url" );
		$gestion_connexion_url ->expects ( $this ->any () ) 
			->method ( 'getObjetUtilisateurs' ) 
			->will ( $this ->returnValue ( $utilisateurs ) );
		$gestion_connexion_url ->expects ( $this ->any () ) 
			->method ( 'retrouve_connexion_params', 'prepare_prepend_url' ) 
			->will ( $this ->returnSelf () );
		$gestion_connexion_url ->expects ( $this ->any () ) 
			->method ( 'getPrependUrl' ) 
			->will ( $this ->returnValue ( "http://localhost:80" ) );
		$solarwinds_datas = $this ->createMock ( "solarwinds_datas" );
		$curl = $this ->createMock ( "curl" );
		
		$this->object = new solarwinds_wsclient_rest ( false, "solarwinds_wsclient_rest" );
		$this->object ->setListeOptions ( $this ->getListeOption () ) 
			->setGestionConnexionUrl ( $gestion_connexion_url ) 
			->setObjetSolarwindsDatas ( $solarwinds_datas ) 
			->setObjetCurl ( $curl );
	}

	/**
	 * Tears down the fixture, for example, closes a network connection. This method is called after a test is executed.
	 */
	protected function tearDown() {
		ob_end_clean ();
	}

	/**
	 * @covers solarwinds_wsclient_rest::prepare_connexion
	 */
	public function testPrepare_connexion_exception1() {
		$this->object ->getObjetSolarwindsDatas () 
			->method ( 'valide_presence_solarwinds_data' ) 
			->will ( $this ->returnValue ( false ) );
		
		$this ->expectException(Exception::class);
        $this->expectExceptionMessage( '(solarwinds_wsclient_rest) Aucune definition de solarwinds pour NOM1' );
		$this->object ->prepare_connexion ( "NOM1" );
	}

	/**
	 * @covers solarwinds_wsclient_rest::prepare_connexion
	 */
	public function testPrepare_connexion_exception2() {
		$this->object ->getObjetSolarwindsDatas () 
			->method ( 'valide_presence_solarwinds_data' ) 
			->will ( $this ->returnValue ( array () ) );
		
		$this ->expectException(Exception::class);
        $this->expectExceptionMessage( '(solarwinds_wsclient_rest) Il faut un username dans la liste des parametres solarwinds' );
		$this->object ->prepare_connexion ( "NOM1" );
	}

	/**
	 * @covers solarwinds_wsclient_rest::prepare_connexion
	 */
	public function testPrepare_connexion_exception3() {
		$this->object ->getObjetSolarwindsDatas () 
			->method ( 'valide_presence_solarwinds_data' ) 
			->will ( $this ->returnValue ( array ( 
				"username" => "user" ) ) );
		
		$this ->expectException(Exception::class);
        $this->expectExceptionMessage( '(solarwinds_wsclient_rest) Il faut un password dans la liste des parametres solarwinds' );
		$this->object ->prepare_connexion ( "NOM1" );
	}

	/**
	 * @covers solarwinds_wsclient_rest::prepare_connexion
	 */
	public function testPrepare_connexion_exception4() {
		$this->object ->getObjetSolarwindsDatas () 
			->method ( 'valide_presence_solarwinds_data' ) 
			->will ( $this ->returnValue ( array ( 
				"username" => "user", 
				"password" => "pwd" ) ) );
		
		$this ->expectException(Exception::class);
        $this->expectExceptionMessage( '(solarwinds_wsclient_rest) Il faut une url dans la liste des parametres solarwinds' );
		$this->object ->prepare_connexion ( "NOM1" );
	}

	/**
	 * @covers solarwinds_wsclient_rest::prepare_connexion
	 */
	public function testPrepare_connexion_valide() {
		$this->object ->getObjetSolarwindsDatas () 
			->method ( 'valide_presence_solarwinds_data' ) 
			->will ( $this ->returnValue ( array ( 
				"username" => "user", 
				"password" => "pwd", 
				"url" => "localhost" ) ) );
		
		$this ->assertSame ( $this->object, $this->object ->prepare_connexion ( "NOM1" ) );
	}
	

	/**
	 * @covers solarwinds_wsclient_rest::prepare_requete_json
	 */
	public function testprepare_requete_json_exception() {
		$this->object ->getObjetCurl ()
		->method ( 'send_curl' )
		->will ( $this ->throwException ( new Exception ( '(solarwinds_wsclient_rest) error 500' ) )  );
	
		$this ->expectException(Exception::class);
        $this->expectExceptionMessage( '(solarwinds_wsclient_rest) Requete http://localhost:80 en erreur' );
		$this->object ->prepare_requete_json ( "Read" ) ;
	}
	
	/**
	 * @covers solarwinds_wsclient_rest::prepare_requete_json
	 */
	public function testprepare_requete_json_dry_run() {
		$this->object ->getListeOptions()
		->method ( 'verifie_option_existe' )
		->will ( $this ->returnValue ( true ) );
		$this ->assertSame ( array(), $this->object ->prepare_requete_json ( "Create" ) );
	}
	
	/**
	 * @covers solarwinds_wsclient_rest::prepare_requete_json
	 */
	public function testprepare_requete_json_valide1() {
		$this ->assertSame ( array(), $this->object ->prepare_requete_json ( "Read" ) );
	}
	
	/**
	 * @covers solarwinds_wsclient_rest::prepare_requete_json
	 */
	public function testprepare_requete_json_valide2() {
		$retour_json = '{"response":"TEST2","traitement":"T2"}{"message":"","success":true,"return_code":0}';
		$this->object ->getObjetCurl ()
		->method ( 'send_curl' )
		->will ( $this ->returnValue ( $retour_json ) );
		$this ->assertSame ( array (
				'response' => 'TEST2',
				'traitement' => 'T2',
				'success' => true,
				'return_code' => 0,
				'message' => '' ), $this->object ->prepare_requete_json ( "Read" ) );
	}
	
	/**
	 * @covers solarwinds_wsclient_rest::gestion_retour
	 */
	public function testgestion_retour_exception() {
		$retour=array("Message"=>"ALERT", "FullException"=>"STACK TRACE");
		$this ->expectException(Exception::class);
        $this->expectExceptionMessage( '(solarwinds_wsclient_rest) ALERT' );
		$this->object ->gestion_retour ($retour) ;
	}
	
	/**
	 * @covers solarwinds_wsclient_rest::gestion_retour
	 */
	public function testgestion_retour_valide1() {
		$retour="PAS DE DONNEES";
		
		$this ->assertEquals (array(),$this->object ->gestion_retour ($retour) );
	}
	
	/**
	 * @covers solarwinds_wsclient_rest::gestion_retour
	 */
	public function testgestion_retour_valide2() {
		$retour=array("DONNEES1");
	
		$this ->assertEquals (array('DONNEES1'),$this->object ->gestion_retour ($retour) );
	}
}
