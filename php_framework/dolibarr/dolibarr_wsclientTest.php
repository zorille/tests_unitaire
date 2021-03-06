<?php

namespace Zorille\dolibarr;
use Zorille\framework as Core;

use Exception as Exception;

if (! defined ( '__DOCUMENT_ROOT__' )) {
	require_once $_SERVER ["PWD"] . '/prepare.php';
}
/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2014-08-25 at 16:53:15.
 */
class wsclientTest extends Core\MockedListeOptions {
	/**
	 * @var wsclient
	 */
	protected $object;

	/**
	 * Sets up the fixture, for example, opens a network connection. This method is called before a test is executed.
	 */
	protected function setUp() {
		ob_start ();
		$utilisateurs = $this->createMock ( 'Zorille\framework\utilisateurs' );
		$utilisateurs->expects ( $this->any () )
		->method ('setUsername','setPassword')
		->will ( $this->returnSelf () );
		$gestion_connexion_url = $this->createMock ( 'Zorille\framework\gestion_connexion_url' );
		$gestion_connexion_url->expects ( $this->any () )
			->method ( 'getObjetUtilisateurs' )
			->will ( $this->returnValue ( $utilisateurs ) );
		$dolibarr_datas = $this->createMock ( 'Zorille\dolibarr\datas' );
		$curl = $this->createMock ( 'Zorille\framework\curl' );
		$curl->expects ( $this->any () )
			->method ( 'setUserPasswd', 'setHttpHAuth' )
			->will ( $this->returnSelf () );
		$this->object = new wsclient ( false, "dolibarr_wsclient" );
		$this->object->setListeOptions ( $this->getListeOption () )
			->setGestionConnexionUrl ( $gestion_connexion_url )
			->setObjetDolibarrdatas ( $dolibarr_datas )
			->setObjetCurl ( $curl );
	}

	/**
	 * Tears down the fixture, for example, closes a network connection. This method is called after a test is executed.
	 */
	protected function tearDown() {
		ob_end_clean ();
	}

	/**
	 * @covers Zorille\dolibarr\wsclient::prepare_connexion
	 */
	public function testPrepare_connexion_exception1() {
		$this->object->getGestionConnexionUrl ()
			->expects ( $this->any () )
			->method ( 'retrouve_connexion_params', 'prepare_prepend_url' )
			->will ( $this->returnSelf () );
		$this->object->getGestionConnexionUrl ()
			->expects ( $this->any () )
			->method ( 'getPrependUrl' )
			->will ( $this->returnValue ( "http://localhost:80" ) );
		$this->object->getObjetDolibarrdatas ()
			->method ( 'valide_presence_data' )
			->will ( $this->returnValue ( false ) );
		$this->expectException ( Exception::class );
		$this->expectExceptionMessage ( '(dolibarr_wsclient) Aucune definition de dolibarr pour NOM1' );
		$this->object->prepare_connexion ( "NOM1" );
	}

	/**
	 * @covers Zorille\dolibarr\wsclient::prepare_connexion
	 */
	public function testPrepare_connexion_exception2() {
		$this->object->getGestionConnexionUrl ()
			->expects ( $this->any () )
			->method ( 'retrouve_connexion_params', 'prepare_prepend_url' )
			->will ( $this->returnSelf () );
		$this->object->getGestionConnexionUrl ()
			->expects ( $this->any () )
			->method ( 'getPrependUrl' )
			->will ( $this->returnValue ( "http://localhost:80" ) );
		$this->object->getObjetDolibarrdatas ()
			->method ( 'valide_presence_data' )
			->will ( $this->returnValue ( array () ) );
		$this->expectException ( Exception::class );
		$this->expectExceptionMessage ( '(dolibarr_wsclient) Il faut un username dans la liste des parametres dolibarr' );
		$this->object->prepare_connexion ( "NOM1" );
	}

	/**
	 * @covers Zorille\dolibarr\wsclient::prepare_connexion
	 */
	public function testPrepare_connexion_exception3() {
		$this->object->getGestionConnexionUrl ()
			->expects ( $this->any () )
			->method ( 'retrouve_connexion_params', 'prepare_prepend_url' )
			->will ( $this->returnSelf () );
		$this->object->getGestionConnexionUrl ()
			->expects ( $this->any () )
			->method ( 'getPrependUrl' )
			->will ( $this->returnValue ( "http://localhost:80" ) );
		$this->object->getObjetDolibarrdatas ()
			->method ( 'valide_presence_data' )
			->will ( $this->returnValue ( array (
				"username" => "user"
		) ) );
		$this->expectException ( Exception::class );
		$this->expectExceptionMessage ( '(dolibarr_wsclient) Il faut un password dans la liste des parametres dolibarr' );
		$this->object->prepare_connexion ( "NOM1" );
	}

	/**
	 * @covers Zorille\dolibarr\wsclient::prepare_connexion
	 */
	public function testPrepare_connexion_exception4() {
		$this->object->getGestionConnexionUrl ()
			->expects ( $this->any () )
			->method ( 'retrouve_connexion_params', 'prepare_prepend_url' )
			->will ( $this->returnSelf () );
		$this->object->getGestionConnexionUrl ()
			->expects ( $this->any () )
			->method ( 'getPrependUrl' )
			->will ( $this->returnValue ( "http://localhost:80" ) );
		$this->object->getObjetDolibarrdatas ()
			->method ( 'valide_presence_data' )
			->will ( $this->returnValue ( array (
				"username" => "user",
				"password" => "pwd"
		) ) );
		$this->expectException ( Exception::class );
		$this->expectExceptionMessage ( '(dolibarr_wsclient) Il faut une url dans la liste des parametres dolibarr' );
		$this->object->prepare_connexion ( "NOM1" );
	}

	/**
	 * @covers Zorille\dolibarr\wsclient::prepare_connexion
	 */
	public function testPrepare_connexion_valide() {
		$this->object->getGestionConnexionUrl ()
			->expects ( $this->any () )
			->method ( 'retrouve_connexion_params', 'prepare_prepend_url' )
			->will ( $this->returnSelf () );
		$this->object->getGestionConnexionUrl ()
			->expects ( $this->any () )
			->method ( 'getPrependUrl' )
			->will ( $this->returnValue ( "http://localhost:80" ) );
		$this->object->getObjetDolibarrdatas ()
			->method ( 'valide_presence_data' )
			->will ( $this->returnValue ( array (
				"username" => "user",
				"password" => "pwd",
				"url" => "localhost"
		) ) );
		$this->assertSame ( $this->object, $this->object->prepare_connexion ( "NOM1" ) );
	}

	/**
	 * @covers Zorille\dolibarr\wsclient::prepare_requete
	 */
	public function testprepare_requete_json_dry_run() {
		$this->object->getListeOptions ()
			->method ( 'verifie_option_existe' )
			->will ( $this->returnValue ( true ) );
			$this->assertSame ( null, $this->object->prepare_requete () );
	}

	/**
	 * @covers Zorille\dolibarr\wsclient::prepare_requete
	 */
	public function testprepare_requete_json_valide() {
		$retour_json = '{"code":0,"message":"T2"}';
		$this->object->getObjetCurl ()
			->method ( 'send_curl' )
			->will ( $this->returnValue ( $retour_json ) );
		$this->assertSame ( array (
				'code' => 0,
				'message' => 'T2'
		), $this->object->prepare_requete () );
	}
}
