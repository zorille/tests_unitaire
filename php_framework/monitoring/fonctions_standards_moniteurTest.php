<?php
namespace Zorille\framework;
/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2014-08-26 at 11:19:36.
 */
if (! defined ( '__DOCUMENT_ROOT__' )) {
	require_once $_SERVER ["PWD"] . '/prepare.php';
}
class fonctions_standards_moniteurTest extends MockedListeOptions {
	/**
     * @var fonctions_standards_moniteur
     */
	protected $object;
	protected $fichier = "";

	public static function tearDownAfterClass() {
		system ( "rm -f /tmp/fonctions_standards_moniteur_test*", $retour );
	}

	/**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
	protected function setUp() {
		$datas = "[Info] TEST\n\r[Warning] WARNING\n\r[Error] ERROR\n\r[Info]Liste destinataire : toto@toto.com,tutu@tutu.com\n\r[Exit]0";
		$this->fichier = "/tmp/fonctions_standards_moniteur_test" . getmypid () . ".txt";
		system ( "echo '" . $datas . "' > " . $this->fichier, $retour );
		ob_start ();
		$this->object = new fonctions_standards_moniteur ( "TESTS contraintesHoraire", false );
		
		$moniteur = $this->createMock('Zorille\framework\moniteur' );
		$this->object->setMoniteur ( $moniteur );
	}

	/**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
	protected function tearDown() {
		ob_end_clean ();
	}

	/**
	 * @covers Zorille\framework\fonctions_standards_moniteur::parse_ligne_log
	 */
	public function testparse_ligne_log_Info() {
		$this->object->getMoniteur ()
			->expects ( $this->any () )
			->method ( 'ecrit' )
			->will ( $this->returnSelf () );
		
		$this->assertFalse ( $this->object->parse_ligne_log ( "[Info] DATAS", "OK", "ERROR", false ) );
	}

	/**
	 * @covers Zorille\framework\fonctions_standards_moniteur::parse_ligne_log
	 */
	public function testparse_ligne_log_Warning() {
		$this->object->getMoniteur ()
			->expects ( $this->any () )
			->method ( 'ecrit' )
			->will ( $this->returnSelf () );
		
		$this->assertFalse ( $this->object->parse_ligne_log ( "[Warning] DATAS", "OK", "ERROR", true ) );
	}

	/**
	 * @covers Zorille\framework\fonctions_standards_moniteur::parse_ligne_log
	 */
	public function testparse_ligne_log_Error() {
		$this->object->getMoniteur ()
			->expects ( $this->any () )
			->method ( 'ecrit' )
			->will ( $this->returnSelf () );
		
		$this->assertFalse ( $this->object->parse_ligne_log ( "[Error] DATAS", "OK", "ERROR", false ) );
	}

	/**
	 * @covers Zorille\framework\fonctions_standards_moniteur::parse_ligne_log
	 */
	public function testparse_ligne_log_Exit0() {
		$this->object->getMoniteur ()
			->expects ( $this->any () )
			->method ( 'ecrit' )
			->will ( $this->returnSelf () );
		
		$this->assertTrue ( $this->object->parse_ligne_log ( "[Exit]0", "OK", "ERROR", false ) );
	}

	/**
	 * @covers Zorille\framework\fonctions_standards_moniteur::parse_ligne_log
	 */
	public function testparse_ligne_log_Exit1() {
		$this->object->getMoniteur ()
			->expects ( $this->any () )
			->method ( 'ecrit' )
			->will ( $this->returnSelf () );
		
		$this->assertTrue ( $this->object->parse_ligne_log ( "[Exit]1", "OK", "ERROR", false ) );
	}

	/**
     * @covers Zorille\framework\fonctions_standards_moniteur::parse_fichier_log
     */
	public function testParse_fichier_log_false() {
		$this->assertFalse ( $this->object->parse_fichier_log ( "fichierNOTEXISTING", "OK", "FALSE", true ) );
	}

	/**
	 * @covers Zorille\framework\fonctions_standards_moniteur::parse_fichier_log
	 */
	public function testParse_fichier_log_true() {
		$this->object->getMoniteur ()
			->expects ( $this->any () )
			->method ( 'ecrit' )
			->will ( $this->returnSelf () );
		
		$this->assertTrue ( $this->object->parse_fichier_log ( $this->fichier, "OK", "FALSE", true ) );
	}

	/**
     * @covers Zorille\framework\fonctions_standards_moniteur::parse_fichier_log_with_mail
     */
	public function testParse_fichier_log_with_mail_false() {
		$this->assertFalse ( $this->object->parse_fichier_log_with_mail ( "fichierNOTEXISTING", "tutu.com", "OK", "FALSE", true ) );
	}

	/**
	 * @covers Zorille\framework\fonctions_standards_moniteur::parse_fichier_log_with_mail
	 */
	public function testParse_fichier_log_with_mail_withoutMail() {
		$this->object->getMoniteur ()
			->expects ( $this->any () )
			->method ( 'ecrit' )
			->will ( $this->returnSelf () );
		$datas = "[Info] TEST\n\r[Warning] WARNING\n\r[Error] ERROR\n\r[Info]Liaire : toto@toto.com,tutu@tutu.com\n\r[Exit]0";
		$fichier = "/tmp/fonctions_standards_moniteur_test" . getmypid () . "_bis.txt";
		system ( "echo '" . $datas . "' > " . $fichier, $retour );
		
		$this->assertTrue ( $this->object->parse_fichier_log_with_mail ( $fichier, "toto.com", "OK", "FALSE", true ) );
	}
	
	/**
	 * @covers Zorille\framework\fonctions_standards_moniteur::parse_fichier_log_with_mail
	 */
	public function testParse_fichier_log_with_mail_with_false_mail() {
		$this->object->getMoniteur ()
		->expects ( $this->any () )
		->method ( 'ecrit' )
		->will ( $this->returnSelf () );
	
		$this->assertTrue ( $this->object->parse_fichier_log_with_mail ( $this->fichier, "mail.dg", "OK", "FALSE", true ) );
	}
	
	/**
	 * @covers Zorille\framework\fonctions_standards_moniteur::parse_fichier_log_with_mail
	 */
	public function testParse_fichier_log_with_mail_true() {
		$this->object->getMoniteur ()
		->expects ( $this->any () )
		->method ( 'ecrit' )
		->will ( $this->returnSelf () );
	
		$this->assertTrue ( $this->object->parse_fichier_log_with_mail ( $this->fichier, "tutu.com", "OK", "FALSE", true ) );
	}

	/**
     * @covers Zorille\framework\fonctions_standards_moniteur::check_processus
     */
	public function testCheck_processus_no_process() {
		$this->assertEquals ( Array (
				'1' 
		), $this->object->check_processus ( "no_process", "linux" ) );
	}
	
	/**
	 * @covers Zorille\framework\fonctions_standards_moniteur::check_processus
	 */
	public function testCheck_processus_php() {
		$result=$this->object->check_processus ( "php", "linux" );
		$this->assertEquals ( 0, $result[0] );
		$this->assertContains ( "php", $result[1] );
	}
	
	/**
	 * ******************* MongoDB **************************
	 * NOT TESTED
	 */
}
