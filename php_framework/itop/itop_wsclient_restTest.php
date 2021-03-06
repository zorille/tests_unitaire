<?php

namespace Zorille\itop;
use Zorille\framework as Core;

use Exception as Exception;

if (! defined ( '__DOCUMENT_ROOT__' )) {
	require_once $_SERVER ["PWD"] . '/prepare.php';
}
/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2014-08-25 at 16:53:15.
 */
class wsclient_restTest extends Core\MockedListeOptions {
	/**
	 * @var wsclient_rest
	 */
	protected $object;

	/**
	 * Sets up the fixture, for example, opens a network connection. This method is called before a test is executed.
	 */
	protected function setUp() {
		ob_start ();
		$utilisateurs = $this->createMock ( 'Zorille\framework\utilisateurs' );
		$gestion_connexion_url = $this->createMock ( 'Zorille\framework\gestion_connexion_url' );
		$gestion_connexion_url->expects ( $this->any () )
			->method ( 'getObjetUtilisateurs' )
			->will ( $this->returnValue ( $utilisateurs ) );
		$itop_datas = $this->createMock ( 'Zorille\itop\datas' );
		$curl = $this->createMock ( 'Zorille\framework\curl' );
		$curl->expects ( $this->any () )
			->method ( 'setUserPasswd', 'setHttpHAuth' )
			->will ( $this->returnSelf () );
		$this->object = new wsclient_rest ( false, "itop_wsclient_rest" );
		$this->object->setListeOptions ( $this->getListeOption () )
			->setGestionConnexionUrl ( $gestion_connexion_url )
			->setObjetItopdatas ( $itop_datas )
			->setObjetCurl ( $curl );
	}

	/**
	 * Tears down the fixture, for example, closes a network connection. This method is called after a test is executed.
	 */
	protected function tearDown() {
		ob_end_clean ();
	}

	/**
	 * @covers Zorille\itop\wsclient_rest::prepare_connexion
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
		$this->object->getObjetItopdatas ()
			->method ( 'valide_presence_data' )
			->will ( $this->returnValue ( false ) );
		$this->expectException ( Exception::class );
		$this->expectExceptionMessage ( '(itop_wsclient_rest) Aucune definition de itop pour NOM1' );
		$this->object->prepare_connexion ( "NOM1" );
	}

	/**
	 * @covers Zorille\itop\wsclient_rest::prepare_connexion
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
		$this->object->getObjetItopdatas ()
			->method ( 'valide_presence_data' )
			->will ( $this->returnValue ( array () ) );
		$this->expectException ( Exception::class );
		$this->expectExceptionMessage ( '(itop_wsclient_rest) Il faut un username dans la liste des parametres itop' );
		$this->object->prepare_connexion ( "NOM1" );
	}

	/**
	 * @covers Zorille\itop\wsclient_rest::prepare_connexion
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
		$this->object->getObjetItopdatas ()
			->method ( 'valide_presence_data' )
			->will ( $this->returnValue ( array (
				"username" => "user"
		) ) );
		$this->expectException ( Exception::class );
		$this->expectExceptionMessage ( '(itop_wsclient_rest) Il faut un password dans la liste des parametres itop' );
		$this->object->prepare_connexion ( "NOM1" );
	}

	/**
	 * @covers Zorille\itop\wsclient_rest::prepare_connexion
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
		$this->object->getObjetItopdatas ()
			->method ( 'valide_presence_data' )
			->will ( $this->returnValue ( array (
				"username" => "user",
				"password" => "pwd"
		) ) );
		$this->expectException ( Exception::class );
		$this->expectExceptionMessage ( '(itop_wsclient_rest) Il faut une url dans la liste des parametres itop' );
		$this->object->prepare_connexion ( "NOM1" );
	}

	/**
	 * @covers Zorille\itop\wsclient_rest::prepare_connexion
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
		$this->object->getObjetItopdatas ()
			->method ( 'valide_presence_data' )
			->will ( $this->returnValue ( array (
				"username" => "user",
				"password" => "pwd",
				"url" => "localhost"
		) ) );
		$this->assertSame ( $this->object, $this->object->prepare_connexion ( "NOM1" ) );
	}

	/**
	 * @covers Zorille\itop\wsclient_rest::prepare_requete_json
	 */
	public function testprepare_requete_json_exception2() {
		$retour_json = '{"code": 1,"message":"ERROR TEST"}';
		$this->object->getObjetCurl ()
			->method ( 'send_curl' )
			->will ( $this->returnValue ( $retour_json ) );
		$this->object->setAuth ( array (
				'auth_user' => "USER",
				'auth_pwd' => "PASS"
		) );
		$this->expectException ( Exception::class );
		$this->expectExceptionMessage ( '(itop_wsclient_rest) ERROR TEST' );
		$this->object->prepare_requete_json ( array (
				'operation' => "core/get"
		) );
	}

	/**
	 * @covers Zorille\itop\wsclient_rest::prepare_requete_json
	 */
	public function testprepare_requete_json_exception3() {
		$this->object->getObjetCurl ()
			->method ( 'send_curl' )
			->will ( $this->returnValue ( NULL ) );
		$this->object->setAuth ( array (
				'auth_user' => "USER",
				'auth_pwd' => "PASS"
		) );
		$this->expectException ( Exception::class );
		$this->expectExceptionMessage ( '(itop_wsclient_rest) Pas de retour du Webservice' );
		$this->object->prepare_requete_json ( array (
				'operation' => "core/get"
		) );
	}

	/**
	 * @covers Zorille\itop\wsclient_rest::prepare_requete_json
	 */
	public function testprepare_requete_json_dry_run() {
		$this->object->getListeOptions ()
			->method ( 'verifie_option_existe' )
			->will ( $this->returnValue ( true ) );
		$this->object->setAuth ( array (
				'auth_user' => "USER",
				'auth_pwd' => "PASS"
		) );
		$this->assertSame ( '', $this->object->prepare_requete_json ( array (
				'operation' => "core/create"
		) ) );
	}

	/**
	 * @covers Zorille\itop\wsclient_rest::prepare_requete_json
	 */
	public function testprepare_requete_json_valide2() {
		$retour_json = '{"code":0,"message":"T2"}';
		$this->object->getObjetCurl ()
			->method ( 'send_curl' )
			->will ( $this->returnValue ( $retour_json ) );
		$this->object->setAuth ( array (
				'auth_user' => "USER",
				'auth_pwd' => "PASS"
		) );
		$this->assertSame ( array (
				'code' => 0,
				'message' => 'T2'
		), $this->object->prepare_requete_json ( array (
				'operation' => "core/get"
		) ) );
	}
}
