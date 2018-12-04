<?php
namespace Zorille\framework;
use \Exception as Exception;
/**
 * @ignore
 */
if (! defined('__DOCUMENT_ROOT__')) {
    require_once $_SERVER["PWD"] . '/prepare.php';
}

/**
 * Test class for fonctions_standards_flux.
 * Generated by PHPUnit on 2010-08-25 at 16:34:23.
 */
class fonctions_standards_fluxTest extends MockedListeOptions
{

    /**
     *
     * @var fonctions_standards_flux
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        ob_start();
        $this->getListeOption()
            ->expects($this->any())
            ->method('verifie_option_existe')
            ->will($this->returnValue(true));
        $this->getListeOption()
            ->expects($this->any())
            ->method('getOption')
            ->will($this->returnValue('10'));
        
        $this->object = new fonctions_standards_flux("TEST FLUX", false);
        $this->object->setListeOptions($this->getListeOption());
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
        ob_end_clean();
    }

    /**
     * Implement testCreer_connexion_ssh().
     */
    public function testCreer_connexion_ssh_Exception()
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('(Zorille\framework\ssh_z) Erreur durant la connexion vers localhost Host : ');
        $this->object->creer_connexion_ssh("localhost", 0);
    }

    /**
     * Implement testCreer_connexion_ssh().
     */
    public function testCreer_connexion_ssh()
    {
        $ssh_z = $this->createMock('Zorille\framework\ssh_z');
        $this->object->setConnexion($ssh_z);
        // Tout est OK
        $this->object->getListeOptions()
            ->expects($this->any())
            ->method('renvoi_variables_standard')
            ->will($this->onConsecutiveCalls("localhost", "", "", "", ""));
        $this->assertNotEquals(false, $this->object->creer_connexion_ssh("localhost", 0));
    }

    /**
     * Implement testVerifie_variables_ftp().
     */
    public function testVerifie_variables_ftp()
    {
        // using='non'
        $this->object->getListeOptions()
            ->expects($this->at(0))
            ->method('verifie_parametre_standard')
            ->will($this->returnValue(false));
        $this->assertFalse($this->object->verifie_variables_ftp($this->getListeOption()));
        
        // Tout est OK
        $this->object->getListeOptions()
            ->expects($this->at(0))
            ->method('verifie_parametre_standard')
            ->will($this->returnValue(true));
        $this->object->getListeOptions()
            ->expects($this->any())
            ->method('prepare_variable_standard')
            ->will($this->returnValue(true));
        $this->assertTrue($this->object->verifie_variables_ftp($this->getListeOption()));
    }

    /**
     * Implement testCreer_connexion_ftp().
     */
    public function testCreer_connexion_ftp_false()
    {
        // using='non'
        $this->object->getListeOptions()
            ->expects($this->at(0))
            ->method('verifie_parametre_standard')
            ->will($this->returnValue(false));
        $this->assertFalse($this->object->creer_connexion_ftp($this->getListeOption()));
    }

    /**
     * Implement testCreer_connexion_ftp().
     */
    public function testCreer_connexion_ftp_exception()
    {
        // Tout est OK, mais le serveur n'existe pas
        $this->object->getListeOptions()
            ->expects($this->at(0))
            ->method('verifie_parametre_standard')
            ->will($this->returnValue(true));
        $this->object->getListeOptions()
            ->expects($this->any())
            ->method('prepare_variable_standard')
            ->will($this->returnValue(true));
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('(Zorille\framework\ftp) Erreur durant la creation de la connexion');
        $this->object->creer_connexion_ftp($this->getListeOption(), 'compte', true, false, 0);
    }

    /**
     * Implement testVerifie_variables_socket().
     */
    public function testVerifie_variables_socket()
    {
        // using='non'
        $this->object->getListeOptions()
            ->expects($this->at(0))
            ->method('verifie_parametre_standard')
            ->will($this->returnValue(false));
        $this->assertFalse($this->object->verifie_variables_socket($this->getListeOption()));
        
        // Tout est OK
        $this->object->getListeOptions()
            ->expects($this->at(0))
            ->method('verifie_parametre_standard')
            ->will($this->returnValue(true));
        $this->object->getListeOptions()
            ->expects($this->any())
            ->method('prepare_variable_standard')
            ->will($this->returnValue(true));
        $this->assertTrue($this->object->verifie_variables_socket($this->getListeOption()));
    }

    /**
     * Implement testCreer_connexion_socket_tcp().
     */
    public function testCreer_connexion_socket_tcp()
    {
        // using='non'
        $this->object->getListeOptions()
            ->expects($this->at(0))
            ->method('verifie_parametre_standard')
            ->will($this->returnValue(false));
        $this->assertFalse($this->object->creer_connexion_socket_tcp($this->getListeOption()));
        
        // Tout est OK
        $this->object->getListeOptions()
            ->expects($this->at(0))
            ->method('verifie_parametre_standard')
            ->will($this->returnValue(true));
        $this->object->getListeOptions()
            ->expects($this->any())
            ->method('prepare_variable_standard')
            ->will($this->returnValue(true));
        $this->assertNotEquals(false, $this->object->creer_connexion_socket_tcp($this->getListeOption()));
    }

    /**
     * Implement testAffiche_resume_debug().
     */
    public function testAffiche_resume_debug()
    {
        $this->assertTrue($this->object->affiche_resume_debug(1, 2, 3, 4, 5, 6));
    }

    /**
     * Implement testRetrouve_privkey().
     */
    public function testRetrouve_privkey_flase()
    {
        $this->object->getListeOptions()
            ->expects($this->any())
            ->method('verifie_variable_standard')
            ->will($this->returnValue(false));
        $this->assertEquals("", $this->object->retrouve_privkey());
    }

    /**
     * Implement testRetrouve_privkey().
     */
    public function testRetrouve_privkey()
    {
        $this->object->getListeOptions()
            ->expects($this->any())
            ->method('verifie_variable_standard')
            ->will($this->returnValue(true));
        $this->object->getListeOptions()
            ->expects($this->any())
            ->method('renvoi_variables_standard')
            ->will($this->returnValue("10"));
        $this->assertEquals(" -e \"ssh -i 10\"", $this->object->retrouve_privkey());
        $this->assertEquals(" -i 10", $this->object->retrouve_privkey(true));
        $this->assertEquals(" -oIdentityFile=10", $this->object->retrouve_privkey(false, true));
    }
}
?>
