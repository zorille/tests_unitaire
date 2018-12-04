<?php
namespace Zorille\framework;
use \Exception as Exception;
if (! defined ( '__DOCUMENT_ROOT__' )) {
	require_once $_SERVER ["PWD"] . '/prepare.php';
}

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2014-08-25 at 17:20:27.
 */
class wsclientTest extends MockedListeOptions {
	/**
     * @var wsclient
     */
	protected $object;

	/**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
	protected function setUp() {
		ob_start ();
		
		$this->object = new wsclient ( false, "TEST wsclient" );
		$this->object ->setListeOptions ( $this ->getListeOption () );
	}

	/**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
	protected function tearDown() {
		ob_end_clean ();
	}

	/**
	 * @covers Zorille\framework\wsclient::retrouve_variables_tableau
	 */
	public function testRetrouve_variables_tableau_Exception() {
		$gestion_connexion_url = $this ->createMock('Zorille\framework\gestion_connexion_url' );
		$gestion_connexion_url ->expects ( $this ->any () ) 
			->method ( 'reset_datas', 'retrouve_connexion_params' ) 
			->will ( $this ->returnSelf () );
		$this->object ->setGestionConnexionUrl ( $gestion_connexion_url );
		
		$serveur_data = array ();
		$this ->expectException(Exception::class);
        $this->expectExceptionMessage( '(TEST wsclient) Il faut un champ url dans la definition du serveur' );
		$this->object ->retrouve_variables_tableau ( $serveur_data );
	}

	/**
	 * @covers Zorille\framework\wsclient::retrouve_variables_tableau
	 */
	public function testRetrouve_variables_tableau() {
		$gestion_connexion_url = $this ->createMock('Zorille\framework\gestion_connexion_url' );
		$gestion_connexion_url ->expects ( $this ->any () ) 
			->method ( 'reset_datas', 'retrouve_connexion_params' ) 
			->will ( $this ->returnSelf () );
		$this->object ->setGestionConnexionUrl ( $gestion_connexion_url );
		
		$serveur_data = array ();
		$serveur_data ["url"] = "TEST_URL";
		$this ->assertSame ( $this->object, $this->object ->retrouve_variables_tableau ( $serveur_data ) );
		$serveur_data ["RequestTimeout"] = 240;
		$this ->assertSame ( $this->object, $this->object ->retrouve_variables_tableau ( $serveur_data ) );
	}

	/**
     * @covers Zorille\framework\wsclient::retrouve_variables_liste_options
     */
	public function testRetrouve_variables_liste_options() {
		$this ->getListeOption () 
			->expects ( $this ->any () ) 
			->method ( 'renvoi_variables_standard' ) 
			->will ( $this ->returnValue ( "TEST" ) );
		$this->object ->setListeOptions ( $this ->getListeOption () );
		$this ->getListeOption () 
			->expects ( $this ->any () ) 
			->method ( 'verifie_option_existe' ) 
			->will ( $this ->onConsecutiveCalls ( true, false ) );
		$gestion_connexion_url = $this ->createMock('Zorille\framework\gestion_connexion_url' );
		$gestion_connexion_url ->expects ( $this ->any () ) 
			->method ( 'reset_datas', 'retrouve_connexion_params' ) 
			->will ( $this ->returnSelf () );
		$this->object ->setGestionConnexionUrl ( $gestion_connexion_url );
		
		$this ->assertSame ( $this->object, $this->object ->retrouve_variables_liste_options () );
		$this ->assertSame ( $this->object, $this->object ->retrouve_variables_liste_options () );
	}

	/**
	 * @covers Zorille\framework\wsclient::traite_retour_json
	 */
	public function testTraite_retour_json() {
		$retour_json = '{"response":"TEST1","traitement":"T1"}';
		$this ->assertEquals ( array ( 
				"response" => "TEST1", 
				"traitement" => "T1" ), $this->object ->traite_retour_json ( $retour_json ) );
		
		$retour_json = '{"response":"TEST2","traitement":"T2"}{"message":"","success":true,"return_code":0}';
		$this ->assertEquals ( array ( 
				"response" => "TEST2", 
				"traitement" => "T2", 
				"message" => "", 
				"success" => true, 
				"return_code" => 0 ), $this->object ->traite_retour_json ( $retour_json ) );
	}

	/**
	 * @covers Zorille\framework\wsclient::envoi_requete
	 */
	public function testenvoi_requete_Exception() {
		$utilisateurs = $this ->createMock('Zorille\framework\utilisateurs' );
		$gestion_connexion_url = $this ->createMock('Zorille\framework\gestion_connexion_url' );
		$gestion_connexion_url ->expects ( $this ->any () ) 
			->method ( 'getObjetUtilisateurs' ) 
			->will ( $this ->returnValue ( $utilisateurs ) );
		$curl = $this ->createMock('Zorille\framework\curl' );
		$curl ->expects ( $this ->any () )
		->method ( 'setUserPasswd', 'setHttpHAuth' )
		->will ( $this ->returnSelf () );
		$curl ->expects ( $this ->any () ) 
			->method ( 'send_curl' ) 
			->will ( $this ->throwException ( new Exception ( 'EXCEP1' ) ) );
		$this->object ->setListeOptions ( $this ->getListeOption () ) 
			->setGestionConnexionUrl ( $gestion_connexion_url ) 
			->setObjetCurl ( $curl ) 
			->setUrl ( "http://url" );
		
		$this ->expectException(Exception::class);
        $this->expectExceptionMessage( '(TEST wsclient) Requete http://url en erreur' );
		$this->object ->envoi_requete ();
	}

	/**
	 * @covers Zorille\framework\wsclient::envoi_requete
	 */
	public function testenvoi_requete_NoConnection() {
		$gestion_connexion_url = $this ->createMock('Zorille\framework\gestion_connexion_url' );
		$this->object ->setGestionConnexionUrl ( $gestion_connexion_url ) 
			->setNoconnexion ( true );
		
		$this ->assertEquals ( array (), $this->object ->envoi_requete () );
	}

	/**
	 * @covers Zorille\framework\wsclient::envoi_requete
	 */
	public function testenvoi_requete_valide() {
		$utilisateurs = $this ->createMock('Zorille\framework\utilisateurs' );
		$gestion_connexion_url = $this ->createMock('Zorille\framework\gestion_connexion_url' );
		$gestion_connexion_url ->expects ( $this ->any () ) 
			->method ( 'getObjetUtilisateurs' ) 
			->will ( $this ->returnValue ( $utilisateurs ) );
		$curl = $this ->createMock('Zorille\framework\curl' );
		$curl ->expects ( $this ->any () )
		->method ( 'setUserPasswd', 'setHttpHAuth' )
		->will ( $this ->returnSelf () );
		$curl ->expects ( $this ->any () ) 
			->method ( 'send_curl' ) 
			->will ( $this ->returnValue ( array ( 
				"Resultat" ) ) );
		$this->object ->setListeOptions ( $this ->getListeOption () ) 
			->setGestionConnexionUrl ( $gestion_connexion_url ) 
			->setObjetCurl ( $curl ) 
			->setUrl ( "http://url" );
		//Active le verbose de CURL
		$this->getListeOption()->expects ( $this ->any () ) 
			->method ( 'getOption' ) 
			->will ( $this ->returnValue ( 3 ) );
		
		$this ->assertEquals ( array ( 
				"Resultat" ), $this->object ->envoi_requete () );
	}

	/**
	 * @covers Zorille\framework\wsclient::gere_header
	 */
	public function testgere_header_valide() {
		$curl = $this ->createMock('Zorille\framework\curl' );
		$curl ->expects ( $this ->any () ) 
			->method ( 'setHttpHeader' ) 
			->will ( $this ->returnValue ( $curl ) );
		$this->object ->setObjetCurl ( $curl );
		
		$this ->assertSame ( $this->object, $this->object ->gere_header () );
	}

	/**
	 * @covers Zorille\framework\wsclient::gere_request
	 */
	public function testgere_request_valide() {
		$curl = $this ->createMock('Zorille\framework\curl' );
		$curl ->expects ( $this ->any () ) 
			->method ( 'setRequest', 'setPostData' ) 
			->will ( $this ->returnValue ( $curl ) );
		$this->object ->setObjetCurl ( $curl ) 
			->setHttpMethod ( 'POST' );
		
		$this ->assertSame ( $this->object, $this->object ->gere_request () );
	}

	/**
	* @covers Zorille\framework\wsclient::gere_post_data
	*/
	public function testgere_post_data_params() {
		$curl = $this ->createMock('Zorille\framework\curl' );
		$curl ->expects ( $this ->any () ) 
			->method ( 'setPostData' ) 
			->will ( $this ->returnValue ( $curl ) );
		$this->object ->setObjetCurl ( $curl ) 
			->setHttpMethod ( 'POST' ) 
			->setParams ( "Param1", "Value1" );
		
		$this ->assertSame ( $this->object, $this->object ->gere_post_data () );
	}

	/**
	 * @covers Zorille\framework\wsclient::gere_post_data
	 */
	public function testgere_post_data_postdata() {
		$curl = $this ->createMock('Zorille\framework\curl' );
		$curl ->expects ( $this ->any () ) 
			->method ( 'setPostData' ) 
			->will ( $this ->returnValue ( $curl ) );
		$this->object ->setObjetCurl ( $curl ) 
			->setHttpMethod ( 'POST' ) 
			->setPostDatas ( array ( 
				"Param1" => "Value1" ) );
		
		$this ->assertSame ( $this->object, $this->object ->gere_post_data () );
	}

	/**
	 * @covers Zorille\framework\wsclient::gere_utilisateurs
	 */
	public function testgere_utilisateurs_valide() {
		$utilisateurs = $this ->createMock('Zorille\framework\utilisateurs' );
		$utilisateurs ->expects ( $this ->any () ) 
			->method ( 'getUsername' ) 
			->will ( $this ->returnValue ( "USER1" ) );
		$utilisateurs ->expects ( $this ->any () ) 
			->method ( 'getPassword' ) 
			->will ( $this ->returnValue ( "PASS1" ) );
		$gestion_connexion_url = $this ->createMock('Zorille\framework\gestion_connexion_url' );
		$gestion_connexion_url ->expects ( $this ->any () ) 
			->method ( 'getObjetUtilisateurs' ) 
			->will ( $this ->returnValue ( $utilisateurs ) );
		$curl = $this ->createMock('Zorille\framework\curl' );
		$curl ->expects ( $this ->any () ) 
			->method ( 'setUserPasswd' ) 
			->will ( $this ->returnValue ( $curl ) );
		$this->object ->setObjetCurl ( $curl ) 
			->setGestionConnexionUrl ( $gestion_connexion_url );
		
		$this ->assertSame ( $this->object, $this->object ->gere_utilisateurs () );
	}

	/**
	 * @covers Zorille\framework\wsclient::gere_proxy
	 */
	public function testgere_proxy_valide() {
		$gestion_connexion_url = $this ->createMock('Zorille\framework\gestion_connexion_url' );
		$gestion_connexion_url ->expects ( $this ->any () ) 
			->method ( 'valide_proxy_existe' ) 
			->will ( $this ->returnValue ( TRUE ) );
		$gestion_connexion_url ->expects ( $this ->any () ) 
			->method ( 'utilise_proxy' ) 
			->will ( $this ->returnValue ( array ( 
				"proxy_host" => "H1", 
				"proxy_port" => "100000", 
				"proxy_login" => "P_USER", 
				"proxy_password" => "P_PASSW", 
				"proxy_type" => 5 ) ) );
		$curl = $this ->createMock('Zorille\framework\curl' );
		$curl ->expects ( $this ->any () ) 
			->method ( 'setProxy' ) 
			->will ( $this ->returnValue ( $curl ) );
		$this->object ->setObjetCurl ( $curl ) 
			->setGestionConnexionUrl ( $gestion_connexion_url );
		
		$this ->assertSame ( $this->object, $this->object ->gere_proxy () );
	}

	/**
	 * @covers Zorille\framework\wsclient::prepare_url_standard
	 */
	public function testPrepare_url_standard() {
		$gestion_connexion_url = $this ->createMock('Zorille\framework\gestion_connexion_url' );
		$gestion_connexion_url ->expects ( $this ->any () ) 
			->method ( 'getPrependUrl' ) 
			->will ( $this ->returnValue ( "http://TEST/" ) );
		$this->object ->setGestionConnexionUrl ( $gestion_connexion_url );
		
		$this ->assertEquals ( "http://TEST/", $this->object ->prepare_url_standard () );
		$this->object ->setParams ( array ( 
				"param1" => "test1" ) );
		$this ->assertEquals ( "http://TEST/?param1=test1", $this->object ->prepare_url_standard () );
		$this->object ->setHttpMethod ( "post" );
		$this ->assertEquals ( "http://TEST/", $this->object ->prepare_url_standard () );
	}

	/**
	 * @covers Zorille\framework\wsclient::prepare_url_get
	 */
	public function testPrepare_url_get() {
		$gestion_connexion_url = $this ->createMock('Zorille\framework\gestion_connexion_url' );
		$gestion_connexion_url ->expects ( $this ->any () ) 
			->method ( 'getPrependUrl' ) 
			->will ( $this ->returnValue ( "http://TEST/" ) );
		$this->object ->setGestionConnexionUrl ( $gestion_connexion_url );
		
		$this ->assertEquals ( "http://TEST/", $this->object ->prepare_url_get () );
		$this->object ->setParams ( array ( 
				"param1" => "test1" ) );
		$this ->assertEquals ( "http://TEST/?param1=test1", $this->object ->prepare_url_get () );
		$this->object ->setParams ( "param2", "test2" );
		$this ->assertEquals ( "http://TEST/?param2=test2", $this->object ->prepare_url_get () );
		$this->object ->setParams ( "param3", "test3", true );
		$this ->assertEquals ( "http://TEST/?param2=test2&param3=test3", $this->object ->prepare_url_get () );
		$this->object ->setParams ( "param4", "test4" );
		$this ->assertEquals ( "http://TEST/?param4=test4", $this->object ->prepare_url_get () );
	}
}
