<?php
namespace Zorille\framework;
/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2014-08-26 at 11:16:24.
 */
if (! defined ( '__DOCUMENT_ROOT__' )) {
	require_once $_SERVER ["PWD"] . '/prepare.php';
}
class messageTest extends MockedListeOptions {
	/**
     * @var message
     */
	protected $object;
	protected $fichier;

	public static function tearDownAfterClass() {
		system ( "rm -f /tmp/message_test_*.txt", $retour );
	}

	/**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
	protected function setUp() {
		ob_start ();
		$this->fichier = "/tmp/message_test_" . getmypid () . ".txt";
		
		$this->object = new message ( false, "TESTS message" );
		//evite d'envoyer un mail
		$this->object->setNoMail ( true );
	}

	/**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
	protected function tearDown() {
		ob_end_clean ();
	}

	public function local_Crlf() {
		return chr ( 13 ) . chr ( 10 );
	}

	/**
	 * @covers Zorille\framework\message::prepare_message_param
	 */
	public function test_prepare_message_param() {
		$this->assertSame ( $this->object, $this->object->prepare_message_param () );
		$this->assertEquals ( $this->local_Crlf (), $this->object->getCrlf () );
		$sepmixed = $this->object->getOneSeparateur ( "mixed" );
		$sepalternative = $this->object->getOneSeparateur ( "alternative" );
		$this->assertEquals ( array (
				"text" => "Content-Type: text/plain; charset=\"_charset_\"",
				"html" => "Content-Type: text/html; charset=\"_charset_\"",
				"mixed" => "Content-Type: multipart/mixed; boundary=\"" . $sepmixed . "\"",
				"alternative" => "Content-Type: multipart/alternative; boundary=\"" . $sepalternative . "\"" 
		), $this->object->getMailContent () );
		$this->assertEquals ( array (
				"mixed" => "--" . $sepmixed . "--" . $this->local_Crlf (),
				"alternative" => "--" . $sepalternative . "--" . $this->local_Crlf () 
		), $this->object->getMailFooter () );
		$this->assertEquals ( "MIME-Version: 1.0" . $this->local_Crlf () . "X-Mailer: PHP/" . phpversion () . $this->local_Crlf () . "[CONTENT_TYPE]" . $this->local_Crlf () . "[CONTENT_ENCODE]", $this->object->getMailEntete () );
		$this->assertEquals ( "ISO-8859-1", $this->object->getCharset () );
		$this->assertEquals ( array (
				"text" => "Content-Transfer-Encoding: quoted-printable" . $this->local_Crlf (),
				"html" => "Content-Transfer-Encoding: 7bit" . $this->local_Crlf () 
		), $this->object->getMailEncode () );
		$this->assertEquals ( "-f ", $this->object->getMailAdditionnal () );
	}

	/**
     * @covers Zorille\framework\message::setHeaders
     */
	public function testHeaders() {
		$this->assertSame ( $this->object, $this->object->setHeaders ( "test@test.com", "moi@moi.fr" ) );
		$this->assertEquals ( "MIME-Version: 1.0" . $this->local_Crlf () . "X-Mailer: PHP/" . phpversion () . $this->local_Crlf () . "[CONTENT_TYPE]" . $this->local_Crlf () . "[CONTENT_ENCODE]From: moi@moi.fr" . $this->local_Crlf () . "Reply-To: moi@moi.fr" . $this->local_Crlf (), $this->object->getMailEntete () );
	}

	/**
	 * @covers Zorille\framework\message::setHeaders
	 */
	public function testHeaders_Array() {
		$this->assertSame ( $this->object, $this->object->setHeaders ( array (
				"test@test.com",
				"test1@test.com" 
		), "moi@moi.fr", array (
				"cc@cc.com" 
		), array (
				"bcc@bcc.fr",
				"bcc1@bcc.fr" 
		) ) );
		
		$this->assertEquals ( "MIME-Version: 1.0" . $this->local_Crlf () . "X-Mailer: PHP/" . phpversion () . $this->local_Crlf () . "[CONTENT_TYPE]" . $this->local_Crlf () . "[CONTENT_ENCODE]From: moi@moi.fr" . $this->local_Crlf () . "Cc: cc@cc.com" . $this->local_Crlf () . "Bcc: bcc@bcc.fr, bcc1@bcc.fr" . $this->local_Crlf () . "Reply-To: moi@moi.fr" . $this->local_Crlf (), $this->object->getMailEntete () );
	}

	/**
     * @covers Zorille\framework\message::ecrit
     */
	public function testEcrit() {
		$this->assertFalse ( $this->object->getMailCorpTextFlag () );
		$this->assertSame ( $this->object, $this->object->ecrit ( "text1" ) );
		$this->assertEquals ( "text1", $this->object->getMailCorpText () );
		$this->assertTrue ( $this->object->getMailCorpTextFlag () );
		$this->assertSame ( $this->object, $this->object->ecrit ( "text2\n" ) );
		$this->assertEquals ( "text1text2\n", $this->object->getMailCorpText () );
	}

	/**
     * @covers Zorille\framework\message::ecrit_html
     */
	public function testEcrit_html() {
		$this->assertFalse ( $this->object->getMailCorpHtmlFlag () );
		$this->assertSame ( $this->object, $this->object->ecrit_html ( "<div>text1</div>" ) );
		$this->assertEquals ( "<div>text1</div>", $this->object->getMailCorpHtml () );
		$this->assertTrue ( $this->object->getMailCorpHtmlFlag () );
		$this->assertSame ( $this->object, $this->object->ecrit_html ( "<div>text2</div>" ) );
		$this->assertEquals ( "<div>text1</div><div>text2</div>", $this->object->getMailCorpHtml () );
	}

	/**
     * @covers Zorille\framework\message::attache_fichier
     */
	public function testAttache_fichier() {
		$datas = "donnees dans fichier
				suite des donnees
				valeurs quelconques
				avec des accents : éà(-";
		system ( "echo '" . $datas . "' > " . $this->fichier, $retour );
		
		$this->assertFalse ( $this->object->getFichierAttacheFlag () );
		$this->assertTrue ( $this->object->attache_fichier ( $this->fichier ) );
		$this->assertEquals ( $this->local_Crlf () . "--" . $this->object->getOneSeparateur ( "mixed" ) . $this->local_Crlf () . 'Content-Type: application/octet-stream; name="' . basename ( $this->fichier ) . '"' . $this->local_Crlf () . 'Content-Disposition: attachment; filename="' . basename ( $this->fichier ) . '"' . $this->local_Crlf () . 'Content-Transfer-Encoding: base64' . $this->local_Crlf () . $this->local_Crlf () . 'ZG9ubmVlcyBkYW5zIGZpY2hpZXIKCQkJCXN1aXRlIGRlcyBkb25uZWVzCgkJCQl2YWxldXJzIHF1' . $this->local_Crlf () . 'ZWxjb25xdWVzCgkJCQlhdmVjIGRlcyBhY2NlbnRzIDogw6nDoCgtCg==' . $this->local_Crlf () . $this->local_Crlf (), $this->object->getFichierAttache () );
		$this->assertTrue ( $this->object->getFichierAttacheFlag () );
	}

	/**
	 * @covers Zorille\framework\message::attache_fichier
	 */
	public function testAttache_fichier_False() {
		$this->assertFalse ( $this->object->attache_fichier ( "/tmp/no_fichier" ) );
	}

	/**
     * @covers Zorille\framework\message::ajoute_mail_header_content_type
     */
	public function testAjoute_mail_header_content_type_File() {
		$this->object->setMailCorpTextFlag ( false )
			->setMailCorpHtmlFlag ( false )
			->setFichierAttacheFlag ( true );
		$this->assertSame ( $this->object, $this->object->ajoute_mail_header_content_type () );
	}

	/**
	 * @covers Zorille\framework\message::ajoute_mail_header_content_type
	 */
	public function testAjoute_mail_header_content_type_Text() {
		$this->object->setMailCorpTextFlag ( true )
			->setMailCorpHtmlFlag ( false )
			->setFichierAttacheFlag ( false );
		$this->assertSame ( $this->object, $this->object->ajoute_mail_header_content_type () );
	}

	/**
	 * @covers Zorille\framework\message::ajoute_mail_header_content_type
	 */
	public function testAjoute_mail_header_content_type_Html() {
		$this->object->setMailCorpTextFlag ( false )
			->setMailCorpHtmlFlag ( true )
			->setFichierAttacheFlag ( false );
		$this->assertSame ( $this->object, $this->object->ajoute_mail_header_content_type () );
	}

	/**
	 * @covers Zorille\framework\message::ajoute_mail_header_content_type
	 */
	public function testAjoute_mail_header_content_type_TextHtml() {
		$this->object->setMailCorpTextFlag ( true )
			->setMailCorpHtmlFlag ( true )
			->setFichierAttacheFlag ( false );
		$this->assertSame ( $this->object, $this->object->ajoute_mail_header_content_type () );
	}

	/**
     * @covers Zorille\framework\message::ajoute_mail_header_encoding
     */
	public function testAjoute_mail_header_encoding_File() {
		$this->object->setMailCorpTextFlag ( false )
			->setMailCorpHtmlFlag ( false )
			->setFichierAttacheFlag ( true );
		$this->assertSame ( $this->object, $this->object->ajoute_mail_header_encoding () );
	}

	/**
	 * @covers Zorille\framework\message::ajoute_mail_header_encoding
	 */
	public function testAjoute_mail_header_encoding_Text() {
		$this->object->setMailCorpTextFlag ( true )
			->setMailCorpHtmlFlag ( false )
			->setFichierAttacheFlag ( false );
		$this->assertSame ( $this->object, $this->object->ajoute_mail_header_encoding () );
	}

	/**
	 * @covers Zorille\framework\message::ajoute_mail_header_encoding
	 */
	public function testAjoute_mail_header_encoding_Html() {
		$this->object->setMailCorpTextFlag ( false )
			->setMailCorpHtmlFlag ( true )
			->setFichierAttacheFlag ( false );
		$this->assertSame ( $this->object, $this->object->ajoute_mail_header_encoding () );
	}

	/**
	 * @covers Zorille\framework\message::ajoute_mail_header_encoding
	 */
	public function testAjoute_mail_header_encoding_TextHtml() {
		$this->object->setMailCorpTextFlag ( true )
			->setMailCorpHtmlFlag ( true )
			->setFichierAttacheFlag ( false );
		$this->assertSame ( $this->object, $this->object->ajoute_mail_header_encoding () );
	}

	/**
     * @covers Zorille\framework\message::ajoute_corp_text
     */
	public function testAjoute_corp_text() {
		$this->object->setMailCorpText ( "text3" );
		$this->assertEquals ( 'Content-Type: text/plain; charset="ISO-8859-1"' . $this->local_Crlf () . 'Content-Transfer-Encoding: quoted-printable' . $this->local_Crlf () . $this->local_Crlf () . 'text3', $this->object->ajoute_corp_text ( true ) );
	}

	/**
     * @covers Zorille\framework\message::ajoute_corp_html
     */
	public function testAjoute_corp_html() {
		$this->object->setMailCorpHtml ( "text4" );
		$this->assertEquals ( 'Content-Type: text/html; charset="ISO-8859-1"' . $this->local_Crlf () . 'Content-Transfer-Encoding: 7bit' . $this->local_Crlf () . $this->local_Crlf () . $this->local_Crlf () . 'text4', $this->object->ajoute_corp_html ( true ) );
	}

	/**
     * @covers Zorille\framework\message::prepare_corp_textuel
     */
	public function testPrepare_corp_textuel() {
		$retour = $this->local_Crlf ();
		$retour .= '--' . $this->object->getOneSeparateur ( "alternative" ) . $this->local_Crlf ();
		$retour .= 'Content-Type: text/plain; charset="ISO-8859-1"' . $this->local_Crlf () . 'Content-Transfer-Encoding: quoted-printable' . $this->local_Crlf () . $this->local_Crlf ();
		$retour .= $this->local_Crlf () . '--' . $this->object->getOneSeparateur ( "alternative" ) . $this->local_Crlf ();
		$retour .= 'Content-Type: text/html; charset="ISO-8859-1"' . $this->local_Crlf () . 'Content-Transfer-Encoding: 7bit' . $this->local_Crlf () . $this->local_Crlf () . $this->local_Crlf ();
		$retour .= $this->local_Crlf () . '--' . $this->object->getOneSeparateur ( "alternative" ) . "--" . $this->local_Crlf ();
		$retour .= $this->local_Crlf ();
		$this->object->setMailCorpTextFlag ( true )
			->setMailCorpHtmlFlag ( true )
			->setFichierAttacheFlag ( true );
		$this->assertEquals ( $retour, $this->object->prepare_corp_textuel () );
	}

	/**
	 * @covers Zorille\framework\message::prepare_corp_textuel
	 */
	public function testPrepare_corp_textuel_TextFile() {
		$retour = "";
		$retour .= 'Content-Type: text/plain; charset="ISO-8859-1"' . $this->local_Crlf () . 'Content-Transfer-Encoding: quoted-printable' . $this->local_Crlf () . $this->local_Crlf ();
		$this->object->setMailCorpTextFlag ( true )
			->setMailCorpHtmlFlag ( false )
			->setFichierAttacheFlag ( true );
		$this->assertEquals ( $retour, $this->object->prepare_corp_textuel () );
	}

	/**
	 * @covers Zorille\framework\message::prepare_corp_textuel
	 */
	public function testPrepare_corp_textuel_Text() {
		$this->object->setMailCorpTextFlag ( true )
			->setMailCorpHtmlFlag ( false )
			->setFichierAttacheFlag ( false );
		$this->assertEquals ( '', $this->object->prepare_corp_textuel () );
	}

	/**
	 * @covers Zorille\framework\message::prepare_corp_textuel
	 */
	public function testPrepare_corp_textuel_HtmlFile() {
		$retour = "";
		$retour .= 'Content-Type: text/html; charset="ISO-8859-1"' . $this->local_Crlf () . 'Content-Transfer-Encoding: 7bit' . $this->local_Crlf () . $this->local_Crlf () . $this->local_Crlf ();
		$this->object->setMailCorpTextFlag ( false )
			->setMailCorpHtmlFlag ( true )
			->setFichierAttacheFlag ( true );
		$this->assertEquals ( $retour, $this->object->prepare_corp_textuel () );
	}

	/**
	 * @covers Zorille\framework\message::prepare_corp_textuel
	 */
	public function testPrepare_corp_textuel_Html() {
		$retour = $this->local_Crlf ();
		$this->object->setMailCorpTextFlag ( false )
			->setMailCorpHtmlFlag ( true )
			->setFichierAttacheFlag ( false );
		$this->assertEquals ( $retour, $this->object->prepare_corp_textuel () );
	}

	/**
     * @covers Zorille\framework\message::prepare_sujet
     */
	public function testPrepare_sujet_Encoded() {
		$this->object->setSujet ( "testSujet" );
		$this->assertEquals ( '=?ISO-8859-1?B?dGVzdFN1amV0?=', $this->object->prepare_sujet () );
	}

	/**
	 * @covers Zorille\framework\message::prepare_sujet
	 */
	public function testPrepare_sujet() {
		$this->object->setSujet ( "testSujet2" );
		$this->object->setMailSujetEncode ( false );
		$this->assertEquals ( 'testSujet2', $this->object->prepare_sujet () );
	}

	/**
     * @covers Zorille\framework\message::prepare_envoi
     */
	public function testPrepare_envoi() {
		$retour = $this->local_Crlf ();
		$retour .= '--' . $this->object->getOneSeparateur ( "mixed" ) . $this->local_Crlf ();
		$retour .= $this->object->getOneMailContent ( "alternative" ) . $this->local_Crlf () . $this->local_Crlf ();
		$retour .= '--' . $this->object->getOneSeparateur ( "alternative" ) . $this->local_Crlf ();
		$retour .= 'Content-Type: text/plain; charset="ISO-8859-1"' . $this->local_Crlf () . 'Content-Transfer-Encoding: quoted-printable' . $this->local_Crlf () . $this->local_Crlf ();
		$retour .= $this->local_Crlf () . '--' . $this->object->getOneSeparateur ( "alternative" ) . $this->local_Crlf ();
		$retour .= 'Content-Type: text/html; charset="ISO-8859-1"' . $this->local_Crlf () . 'Content-Transfer-Encoding: 7bit' . $this->local_Crlf () . $this->local_Crlf () . $this->local_Crlf ();
		$retour .= $this->local_Crlf () . '--' . $this->object->getOneSeparateur ( "alternative" ) . "--" . $this->local_Crlf ();
		$retour .= $this->local_Crlf () . $this->local_Crlf () . '--' . $this->object->getOneSeparateur ( "mixed" ) . "--" . $this->local_Crlf ();
		$retour .= $this->local_Crlf ();
		$this->object->setMailCorpTextFlag ( true )
			->setMailCorpHtmlFlag ( true )
			->setFichierAttacheFlag ( true );
		$this->assertEquals ( $retour, $this->object->prepare_envoi () );
	}

	/**
     * @covers Zorille\framework\message::envoi
     */
	public function testEnvoi() {
		$this->assertTrue ( $this->object->envoi () );
	}
}
