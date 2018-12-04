<?php
namespace Zorille\framework;
use \Exception as Exception;
/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2014-08-25 at 17:29:51.
 */
if (! defined ( '__DOCUMENT_ROOT__' )) {
	require_once $_SERVER ["PWD"] . '/prepare.php';
}
class ssh_zTest extends MockedListeOptions {
	/**
	 *
	 * @var ssh_z
	 */
	protected $object;

	/**
	 * Sets up the fixture, for example, opens a network connection. This method is called before a test is executed.
	 */
	protected function setUp() {
		ob_start ();
		$this->object = new ssh_z ( false, "TESTS ssh_z" );
		$this->object ->setListeOptions ( $this ->getListeOption () );
		
		$ssh2_commandes = $this ->createMock('Zorille\framework\ssh2_commandes' );
		$this->object ->setObjetSsh2Commandes ( $ssh2_commandes );
	}

	/**
	 * Tears down the fixture, for example, closes a network connection. This method is called after a test is executed.
	 */
	protected function tearDown() {
		ob_end_clean ();
	}

	/**
	 * @covers Zorille\framework\ssh_z::retrouve_ssh_z_param
	 */
	public function testretrouve_ssh_z_param_CLI() {
		$this->object ->getListeOptions () 
			->expects ( $this ->any () ) 
			->method ( 'renvoi_variables_standard' ) 
			->will ( $this ->onconsecutiveCalls ( "USER", "PASS", "pubkey", "prikey", "passphrase", "ssh-dsa", "ssh_cmd" ) );
		$this ->assertSame ( $this->object, $this->object ->retrouve_ssh_z_param () );
	}

	/**
	 * @covers Zorille\framework\ssh_z::retrouve_ssh_z_param
	 */
	public function testretrouve_ssh_z_param_XML() {
		$flux_datas = $this ->createMock('Zorille\framework\flux_datas' );
		$flux_datas ->expects ( $this ->any () ) 
			->method ( 'retrouve_flux_param' ) 
			->will ( $this ->returnSelf () );
		$this->object ->setObjetFluxDatas ( $flux_datas );
		
		$this->object ->getListeOptions () 
			->expects ( $this ->any () ) 
			->method ( 'renvoi_variables_standard' ) 
			->will ( $this ->returnValue ( "NOUSERNAMEZ" ) );
		$this ->assertSame ( $this->object, $this->object ->retrouve_ssh_z_param () );
	}

	/**
	 * @covers Zorille\framework\ssh_z::prepare_ssh_z
	 */
	public function testprepare_ssh_z_false() {
		$this->object ->setCliDatas ( true );
		$this ->assertFalse ( $this->object ->prepare_ssh_z () );
	}

	/**
	 * @covers Zorille\framework\ssh_z::prepare_ssh_z
	 */
	public function testprepare_ssh_z_Exception() {
		$this->object ->setMachineDistante ( "localhost" );
		$flux_datas = $this ->createMock('Zorille\framework\flux_datas' );
		$flux_datas ->expects ( $this ->any () ) 
			->method ( 'valide_presence_flux_data' ) 
			->will ( $this ->returnValue ( false ) );
		$this->object ->setObjetFluxDatas ( $flux_datas );
		$this ->expectException(Exception::class);
        $this->expectExceptionMessage( '(TESTS ssh_z) localhost est introuvable' );
		$this->object ->prepare_ssh_z ();
	}

	/**
	 * @covers Zorille\framework\ssh_z::prepare_ssh_z
	 */
	public function testprepare_ssh_z_key_dsa() {
		$this->object ->setMachineDistante ( "localhost" );
		$flux_datas = $this ->createMock('Zorille\framework\flux_datas' );
		$flux_datas ->expects ( $this ->any () ) 
			->method ( 'valide_presence_flux_data' ) 
			->will ( $this ->returnValue ( array ( 
				"host" => "HOSTNAME", 
				"username" => "USER", 
				"password" => "PASS", 
				"pubkey" => "PUBKEY", 
				"privkey" => "PRIVKEY", 
				"passphrase" => "", 
				"type_ssh_key" => "", 
				"commande_ssh" => "CMSSSH" ) ) );
		$this->object ->setObjetFluxDatas ( $flux_datas );
		
		$this ->assertSame ( $this->object, $this->object ->prepare_ssh_z () );
	}

	/**
	 * @covers Zorille\framework\ssh_z::prepare_ssh_z
	 */
	public function testprepare_ssh_z_key_rsa() {
		$this->object ->setMachineDistante ( "localhost" );
		$flux_datas = $this ->createMock('Zorille\framework\flux_datas' );
		$flux_datas ->expects ( $this ->any () ) 
			->method ( 'valide_presence_flux_data' ) 
			->will ( $this ->returnValue ( array ( 
				"username" => "USER", 
				"password" => "PASS", 
				"pubkey" => "PUBKEY", 
				"privkey" => "PRIVKEY", 
				"passphrase" => "", 
				"type_ssh_key" => "rsa", 
				"commande_ssh" => "CMSSSH" ) ) );
		$this->object ->setObjetFluxDatas ( $flux_datas );
		
		$this ->assertSame ( $this->object, $this->object ->prepare_ssh_z () );
	}

	/**
	 * @covers Zorille\framework\ssh_z::autentification
	 */
	public function testautentification_false_noconnect() {
		$this ->assertFalse ( $this->object ->autentification () );
	}

	/**
	 * @covers Zorille\framework\ssh_z::autentification
	 */
	public function testautentification_true_alreadyconnect() {
		$connection_ssh2 = true;
		$this->object ->setSshConnexion ( $connection_ssh2 ) 
			->setAutentification ( true );
		$this ->assertTrue ( $this->object ->autentification () );
	}

	/**
	 * @covers Zorille\framework\ssh_z::autentification
	 */
	public function testautentification_Exception() {
		$connection_ssh2 = true;
		$this->object ->setSshConnexion ( $connection_ssh2 ) 
			->setMachineDistante ( "MACHINE" ) 
			->setAutentification ( false ) 
			->setNbRetry ( 0 );
		$this ->expectException(Exception::class);
        $this->expectExceptionMessage( '(TESTS ssh_z) Erreur durant l\'autentification vers MACHINE' );
		$this->object ->autentification ();
	}

	/**
	 * @covers Zorille\framework\ssh_z::autentification
	 */
	public function testautentification_by_user_password() {
		$connection_ssh2 = true;
		$this->object ->getObjetSsh2Commandes () 
			->expects ( $this ->any () ) 
			->method ( 'ssh2_auth_password' ) 
			->will ( $this ->returnValue ( true ) );
		$this->object ->setSshConnexion ( $connection_ssh2 ) 
			->setMachineDistante ( "MACHINE" ) 
			->setAutentification ( false );
		
		$this ->assertTrue ( $this->object ->autentification () );
		$this ->assertTrue ( $this->object ->getAutentification () );
	}

	/**
	 * @covers Zorille\framework\ssh_z::autentification
	 */
	public function testautentification_by_pubkey() {
		$connection_ssh2 = true;
		$this->object ->getObjetSsh2Commandes () 
			->expects ( $this ->any () ) 
			->method ( 'ssh2_auth_pubkey_file' ) 
			->will ( $this ->returnValue ( true ) );
		$this->object ->setSshConnexion ( $connection_ssh2 ) 
			->setMachineDistante ( "MACHINE" ) 
			->setAutentification ( false ) 
			->setPubkey ( "PUBKEY" );
		
		$this ->assertTrue ( $this->object ->autentification () );
		$this ->assertTrue ( $this->object ->getAutentification () );
	}

	/**
	 * @covers Zorille\framework\ssh_z::ssh_connect
	 */
	public function testSsh_connect_Exception() {
		$flux_datas = $this ->createMock('Zorille\framework\flux_datas' );
		$flux_datas ->expects ( $this ->any () ) 
			->method ( 'valide_presence_flux_data' ) 
			->will ( $this ->returnValue ( array ( 
				"username" => "USER", 
				"password" => "PASS", 
				"pubkey" => "PUBKEY", 
				"privkey" => "PRIVKEY", 
				"passphrase" => "", 
				"type_ssh_key" => "", 
				"commande_ssh" => "CMSSSH" ) ) );
		$this->object ->setObjetFluxDatas ( $flux_datas );
		$this->object ->getObjetSsh2Commandes () 
			->expects ( $this ->any () ) 
			->method ( 'ssh2_connect' ) 
			->will ( $this ->returnValue ( false ) );
		$connection_ssh2 = true;
		$this->object ->setSshConnexion ( $connection_ssh2 ) 
			->setMachineDistante ( "MACHINE" ) 
			->setAutentification ( true ) 
			->setNbRetry ( 1 );
		
		$this ->expectException(Exception::class);
        $this->expectExceptionMessage( '(TESTS ssh_z) Erreur durant la connexion vers MACHINE Host : MACHINE' );
		$this->object ->ssh_connect ();
	}

	/**
	 * @covers Zorille\framework\ssh_z::ssh_connect
	 */
	public function testSsh_connect() {
		$flux_datas = $this ->createMock('Zorille\framework\flux_datas' );
		$flux_datas ->expects ( $this ->any () ) 
			->method ( 'valide_presence_flux_data' ) 
			->will ( $this ->returnValue ( array ( 
				"username" => "USER", 
				"password" => "PASS", 
				"pubkey" => "PUBKEY", 
				"privkey" => "PRIVKEY", 
				"passphrase" => "", 
				"type_ssh_key" => "", 
				"commande_ssh" => "CMSSSH" ) ) );
		$this->object ->setObjetFluxDatas ( $flux_datas );
		$this->object ->getObjetSsh2Commandes () 
			->expects ( $this ->any () ) 
			->method ( 'ssh2_connect' ) 
			->will ( $this ->returnValue ( true ) );
		$this->object ->getObjetSsh2Commandes () 
			->expects ( $this ->any () ) 
			->method ( 'ssh2_auth_password' ) 
			->will ( $this ->returnValue ( true ) );
		$connection_ssh2 = false;
		$this->object ->setMachineDistante ( "MACHINE" ) 
			->setNbRetry ( 1 );
		
		$this ->assertTrue ( $this->object ->ssh_connect () );
		$this ->assertTrue ( $this->object ->getAutentification () );
	}

	/**
	 * @covers Zorille\framework\ssh_z::valide_stderr
	 */
	public function testvalide_stderr_Exception() {
		$CODE_RETOUR = array ( 
				"output" => "", 
				"err" => "Error : xxxx" );
		$this ->expectException(Exception::class);
        $this->expectExceptionMessage( '(TESTS ssh_z) Erreur dans la commande ssh : #echo' );
		$this->object ->valide_stderr ( $CODE_RETOUR, "#echo" );
	}

	/**
	 * @covers Zorille\framework\ssh_z::valide_stderr
	 */
	public function testvalide_stderr_erreur_without_exception() {
		$CODE_RETOUR = array ( 
				"output" => "stdio", 
				"err" => "Error : xxxx" );
		
		$this ->assertSame ( $this->object, $this->object ->valide_stderr ( $CODE_RETOUR, "#echo", false, true ) );
		$this ->assertEquals ( array ( 
				'output' => false, 
				'err' => 'Error : xxxx' ), $CODE_RETOUR );
	}

	/**
	 * @covers Zorille\framework\ssh_z::valide_stderr
	 */
	public function testvalide_stderr_valid_ssh_fingerprint() {
		$CODE_RETOUR = array ( 
				"output" => "stdio", 
				"err" => "Warning: Permanently added xxxxx (DSA) to the list of known hosts.\n" );
		
		$this ->assertSame ( $this->object, $this->object ->valide_stderr ( $CODE_RETOUR, "#echo" ) );
		$this ->assertEquals ( array ( 
				'output' => 'stdio', 
				'err' => false ), $CODE_RETOUR );
	}

	/**
	 * @covers Zorille\framework\ssh_z::valide_stderr
	 */
	public function testvalide_stderr_without_erreur() {
		$CODE_RETOUR = array ( 
				"output" => "stdio", 
				"err" => "" );
		
		$this ->assertSame ( $this->object, $this->object ->valide_stderr ( $CODE_RETOUR, "#echo" ) );
		$this ->assertEquals ( array ( 
				'output' => 'stdio', 
				'err' => false ), $CODE_RETOUR );
	}

	/**
	 * @covers Zorille\framework\ssh_z::ssh_commande
	 */
	public function testssh_commande_ok() {
		$stream_context = array ();
		$stream_context ['stdio'] = fopen ( "php://memory", "rw+" );
		$stream_context ['stdout'] = fopen ( "php://memory", "r+" );
		$stream_context ['stderr'] = fopen ( "php://memory", "r+" );
		
		fputs ( $stream_context ['stdio'], "stdio" );
		fputs ( $stream_context ['stdout'], "stdout" );
		fputs ( $stream_context ['stderr'], "" );
		rewind ( $stream_context ['stdio'] );
		rewind ( $stream_context ['stdout'] );
		rewind ( $stream_context ['stderr'] );
		$this->object ->getObjetSsh2Commandes () 
			->expects ( $this ->any () ) 
			->method ( 'ssh2_exec' ) 
			->will ( $this ->returnValue ( $stream_context ) );
		
		$this ->assertEquals ( array ( 
				'output' => 'stdio', 
				'err' => false ), $this->object ->ssh_commande ( "#echo" ) );
	}

	/**
	 * @covers Zorille\framework\ssh_z::ssh_shell_commande
	 */
	public function testssh_shell_commande_ok() {
		$stream_context = array ();
		$stream_context ['stdio'] = fopen ( "php://memory", "rw+" );
		$stream_context ['stdout'] = fopen ( "php://memory", "r+" );
		$stream_context ['stderr'] = fopen ( "php://memory", "r+" );
		
		fputs ( $stream_context ['stdio'], "stdio" );
		fputs ( $stream_context ['stdout'], "stdout" );
		fputs ( $stream_context ['stderr'], "" );
		rewind ( $stream_context ['stdio'] );
		rewind ( $stream_context ['stdout'] );
		rewind ( $stream_context ['stderr'] );
		$this->object ->getObjetSsh2Commandes () 
			->expects ( $this ->any () ) 
			->method ( 'ssh2_shell' ) 
			->will ( $this ->returnValue ( $stream_context ) );
		
		$this ->assertEquals ( array ( 
				'output' => 'stdio', 
				'err' => false ), $this->object ->ssh_shell_commande ( "#echo", true, "xterm" ) );
	}

	/**
	 * @covers Zorille\framework\ssh_z::verifie_presence_fichier
	 */
	public function testverifie_presence_fichier_erreur() {
		$stream_context = array ();
		$stream_context ['stdio'] = fopen ( "php://memory", "rw+" );
		$stream_context ['stdout'] = fopen ( "php://memory", "r+" );
		$stream_context ['stderr'] = fopen ( "php://memory", "r+" );
		
		fputs ( $stream_context ['stdio'], "" );
		fputs ( $stream_context ['stdout'], "stdout" );
		fputs ( $stream_context ['stderr'], "Not Found" );
		rewind ( $stream_context ['stdio'] );
		rewind ( $stream_context ['stdout'] );
		rewind ( $stream_context ['stderr'] );
		$this->object ->getObjetSsh2Commandes () 
			->expects ( $this ->any () ) 
			->method ( 'ssh2_exec' ) 
			->will ( $this ->returnValue ( $stream_context ) );
		
		$this ->assertFalse ( $this->object ->verifie_presence_fichier ( "DOSSIER", "FICHIER" ) );
	}

	/**
	 * @covers Zorille\framework\ssh_z::verifie_presence_fichier
	 */
	public function testverifie_presence_fichier_ok() {
		$stream_context = array ();
		$stream_context ['stdio'] = fopen ( "php://memory", "rw+" );
		$stream_context ['stdout'] = fopen ( "php://memory", "r+" );
		$stream_context ['stderr'] = fopen ( "php://memory", "r+" );
		
		fputs ( $stream_context ['stdio'], "DOSSIER/FICHIER" );
		fputs ( $stream_context ['stdout'], "stdout" );
		fputs ( $stream_context ['stderr'], "" );
		rewind ( $stream_context ['stdio'] );
		rewind ( $stream_context ['stdout'] );
		rewind ( $stream_context ['stderr'] );
		$this->object ->getObjetSsh2Commandes () 
			->expects ( $this ->any () ) 
			->method ( 'ssh2_exec' ) 
			->will ( $this ->returnValue ( $stream_context ) );
		
		$this ->assertTrue ( $this->object ->verifie_presence_fichier ( "DOSSIER", "FICHIER" ) );
	}

	/**
	 * @covers Zorille\framework\ssh_z::creer_dossier
	 */
	public function testcreer_dossier_erreur() {
		$stream_context = array ();
		$stream_context ['stdio'] = fopen ( "php://memory", "rw+" );
		$stream_context ['stdout'] = fopen ( "php://memory", "r+" );
		$stream_context ['stderr'] = fopen ( "php://memory", "r+" );
		
		fputs ( $stream_context ['stdio'], "" );
		fputs ( $stream_context ['stdout'], "stdout" );
		fputs ( $stream_context ['stderr'], "Not Found" );
		rewind ( $stream_context ['stdio'] );
		rewind ( $stream_context ['stdout'] );
		rewind ( $stream_context ['stderr'] );
		$this->object ->getObjetSsh2Commandes () 
			->expects ( $this ->any () ) 
			->method ( 'ssh2_exec' ) 
			->will ( $this ->returnValue ( $stream_context ) );
		
		$this ->assertFalse ( $this->object ->creer_dossier ( "DOSSIER", "/bin/mkdir" ) );
	}

	/**
	 * @covers Zorille\framework\ssh_z::creer_dossier
	 */
	public function testcreer_dossier_ok() {
		$stream_context = array ();
		$stream_context ['stdio'] = fopen ( "php://memory", "rw+" );
		$stream_context ['stdout'] = fopen ( "php://memory", "r+" );
		$stream_context ['stderr'] = fopen ( "php://memory", "r+" );
		
		fputs ( $stream_context ['stdio'], "DOSSIER/FICHIER" );
		fputs ( $stream_context ['stdout'], "stdout" );
		fputs ( $stream_context ['stderr'], "" );
		rewind ( $stream_context ['stdio'] );
		rewind ( $stream_context ['stdout'] );
		rewind ( $stream_context ['stderr'] );
		$this->object ->getObjetSsh2Commandes () 
			->expects ( $this ->any () ) 
			->method ( 'ssh2_exec' ) 
			->will ( $this ->returnValue ( $stream_context ) );
		
		$this ->assertTrue ( $this->object ->creer_dossier ( "DOSSIER", "/bin/mkdir" ) );
	}

	/**
	 * @covers Zorille\framework\ssh_z::ssh_close
	 */
	public function testssh_close() {
		$this ->assertSame ( $this->object, $this->object ->ssh_close () );
		$this ->assertFalse ( $this->object ->getSshConnexion () );
		$this ->assertFalse ( $this->object ->getAutentification () );
	}
}
