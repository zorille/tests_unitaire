<?php
/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2014-08-26 at 11:16:24.
 */
if (! defined ( '__DOCUMENT_ROOT__' )) {
	require_once $_SERVER ["PWD"] . '/prepare.php';
}
class fonctions_standards_mailTest extends MockedListeOptions {
	/**
     * @var fonctions_standards_mail
     */
	protected $object;

	/**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
	protected function setUp() {
		ob_start ();
		$this->object = new fonctions_standards_mail ( false, "TESTS fonctions_standards_mail" );
	}

	/**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
	protected function tearDown() {
		ob_end_clean ();
	}

	/**
     * @covers fonctions_standards_mail::creer_liste_mail
     */
	public function testCreer_liste_mail() {
		$this->getListeOption ()
			->expects ( $this->any () )
			->method ( 'verifie_option_existe' )
			->will ( $this->returnValue ( true ) );
		$this->assertInstanceOf ( "message", $this->object->creer_liste_mail ( $this->getListeOption () ) );
	}

	/**
	 * @covers fonctions_standards_mail::encode_sujet
	 */
	public function testencode_sujet_True() {
		$this->getListeOption ()
			->expects ( $this->any () )
			->method ( 'renvoi_variables_standard' )
			->will ( $this->returnValue ( 'oui' ) );
		$this->assertTrue ( $this->object->encode_sujet ( $this->getListeOption () ) );
	}

	/**
	 * @covers fonctions_standards_mail::encode_sujet
	 */
	public function testencode_sujet_False() {
		$this->getListeOption ()
			->expects ( $this->any () )
			->method ( 'renvoi_variables_standard' )
			->will ( $this->returnValue ( 'non' ) );
		$this->assertFalse ( $this->object->encode_sujet ( $this->getListeOption () ) );
	}

	/**
	 * @covers fonctions_standards_mail::sujet
	 */
	public function testsujet() {
		$message = $this->createMock ( "message" );
		$message->expects ( $this->any () )
			->method ( 'setSujet' )
			->will ( $this->returnself () );
		$this->getListeOption ()
			->expects ( $this->any () )
			->method ( 'renvoi_variables_standard' )
			->will ( $this->returnValue ( "SUJET" ) );
		$this->assertTrue ( $this->object->sujet ( $this->getListeOption (), $message, "no_sujet" ) );
	}

	/**
	 * @covers fonctions_standards_mail::corp
	 */
	public function testcorp_defaut() {
		$message = $this->createMock ( "message" );
		$message->expects ( $this->any () )
			->method ( 'setSujet' )
			->will ( $this->returnself () );
		$this->assertTrue ( $this->object->corp ( $this->getListeOption (), $message, array () ) );
	}
	
	/**
	 * @covers fonctions_standards_mail::corp
	 */
	public function testcorp_text() {
		$message = $this->createMock ( "message" );
		$message->expects ( $this->any () )
		->method ( 'setSujet' )
		->will ( $this->returnself () );
		$this->assertTrue ( $this->object->corp ( $this->getListeOption (), $message, array ("text"=>"TEXTE") ) );
	}
	
	/**
	 * @covers fonctions_standards_mail::corp
	 */
	public function testcorp_html() {
		$message = $this->createMock ( "message" );
		$this->assertTrue ( $this->object->corp ( $this->getListeOption (), $message, array ("html"=>"<div>TEXTE</div>") ) );
	}

	/**
	 * @covers fonctions_standards_mail::fichier
	 */
	public function testfichier() {
		$message = $this->createMock ( "message" );
		$this->assertTrue ( $this->object->fichier ( $this->getListeOption (), $message, array (
				"FICHIER1"
		) ) );
	}
	
	/**
     * @covers fonctions_standards_mail::envoieMail_standard
     */
	public function testEnvoieMail_standard_True() {
		$this->getListeOption ()
			->expects ( $this->any () )
			->method ( 'verifie_option_existe' )
			->will ( $this->returnValue ( true ) );
		$this->assertTrue ( $this->object->envoieMail_standard ( $this->getListeOption (), "SUJET", array (
				"text" => "DONNEES A ENVOYER",
				"html" => "<div>DONNEES A ENVOYER HTML</div>" 
		), array (
				"FICHIER1" 
		) ) );
	}

	/**
	 * @covers fonctions_standards_mail::envoieMail_standard
	 */
	public function testEnvoieMail_standard_False() {
		$this->getListeOption ()
			->expects ( $this->any () )
			->method ( 'verifie_option_existe' )
			->will ( $this->returnValue ( false ) );
		$this->getListeOption ()
			->expects ( $this->any () )
			->method ( 'getOption' )
			->will ( $this->returnValue ( "oui" ) );
		$this->assertFalse ( $this->object->envoieMail_standard ( $this->getListeOption (), "SUJET", array (
				"text" => "DONNEES A ENVOYER" 
		) ) );
	}
}