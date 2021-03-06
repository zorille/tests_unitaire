<?php
namespace Zorille\framework;
/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2015-05-28 at 14:44:03.
 */
if (! defined('__DOCUMENT_ROOT__')) {
    require_once $_SERVER["PWD"] . '/prepare.php';
}

class xymon_clientTest extends MockedListeOptions
{

    /**
     *
     * @var xymon_client
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        ob_start();
        $this->object = new xymon_client(false, "TESTS xymon_client");
        
        $this->object->setListeOptions($this->getListeOption())
            ->setUpdate("non");
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
     * @covers Zorille\framework\xymon_client::retrouve_xymon_client_param
     */
    public function testRetrouve_xymon_client_param_defaut()
    {
        $this->object->getListeOptions()
            ->expects($this->any())
            ->method('renvoi_variables_standard')
            ->will($this->returnValue(false));
        $this->assertSame($this->object, $this->object->retrouve_xymon_client_param("TITRE"));
    }

    /**
     * @covers Zorille\framework\xymon_client::retrouve_xymon_client_param
     */
    public function testRetrouve_xymon_client_param_valeur()
    {
        $this->object->getListeOptions()
            ->expects($this->any())
            ->method('renvoi_variables_standard')
            ->will($this->onconsecutiveCalls("40", "BB", "Linux", "TITRE", "TITRE"));
        $this->assertSame($this->object, $this->object->retrouve_xymon_client_param(""));
    }

    /**
     * @covers Zorille\framework\xymon_client::renvoi_couleur
     */
    public function testrenvoi_couleur_defaut()
    {
        $this->assertEquals("green", $this->object->renvoi_couleur());
    }

    /**
     * @covers Zorille\framework\xymon_client::renvoi_couleur
     */
    public function testrenvoi_couleur_yellow()
    {
        $this->object->yellow();
        $this->assertEquals("yellow", $this->object->renvoi_couleur());
    }

    /**
     * @covers Zorille\framework\xymon_client::renvoi_couleur
     */
    public function testrenvoi_couleur_red()
    {
        $this->object->red();
        $this->assertEquals("red", $this->object->renvoi_couleur());
    }

    /**
     * @covers Zorille\framework\xymon_client::ecrit
     */
    public function testEcrit()
    {
        $this->assertSame($this->object, $this->object->ecrit("TEXTE", "green"));
        $this->assertSame($this->object, $this->object->ecrit("TEXTE", "yellow"));
        $this->assertSame($this->object, $this->object->ecrit("TEXTE", "red"));
    }

    /**
     * @covers Zorille\framework\xymon_client::green
     */
    public function testGreen()
    {
        $this->assertSame($this->object, $this->object->green());
        $this->assertEquals("green", $this->object->renvoi_couleur());
    }

    /**
     * @covers Zorille\framework\xymon_client::yellow
     */
    public function testYellow()
    {
        $this->assertSame($this->object, $this->object->yellow());
        $this->assertEquals("yellow", $this->object->renvoi_couleur());
    }

    /**
     * @covers Zorille\framework\xymon_client::red
     */
    public function testRed()
    {
        $this->assertSame($this->object, $this->object->red());
        $this->assertEquals("red", $this->object->renvoi_couleur());
    }

    /**
     * @covers Zorille\framework\xymon_client::applique_commande
     */
    public function testapplique_commande_update_non()
    {
        $this->assertEquals(array(
            0,
            'Le update est a NON.'
        ), $this->object->applique_commande("echo test"));
    }

    /**
     * @covers Zorille\framework\xymon_client::applique_commande
     */
    public function testapplique_commande_update_oui()
    {
        $this->object->setUpdate("oui");
        $this->assertEquals(array(
            0,
            'test'
        ), $this->object->applique_commande("echo test"));
    }

    /**
     * @covers Zorille\framework\xymon_client::retrouve_status
     */
    public function testretrouve_status_standard()
    {
        $this->object->setStatus(30);
        $this->assertEquals("status", $this->object->retrouve_status());
    }

    /**
     * @covers Zorille\framework\xymon_client::retrouve_status
     */
    public function testretrouve_status_custom()
    {
        $this->object->setStatus(127);
        $this->assertEquals("status+127", $this->object->retrouve_status());
    }

    /**
     * @covers Zorille\framework\xymon_client::send_via_ssh
     */
    public function testsend_via_ssh()
    {
        $ssh_z = $this->createMock('Zorille\framework\ssh_z');
        $ssh_z->expects($this->any())
            ->method('ssh_connect')
            ->will($this->returnSelf());
        $this->object->setObjetSSH($ssh_z);
        
        $this->assertSame($this->object, $this->object->send_via_ssh("echo TEST"));
    }

    /**
     * @covers Zorille\framework\xymon_client::send_via_ssh
     */
    public function testsend_via_ssh_withUpdate()
    {
        $ssh_z = $this->createMock('Zorille\framework\ssh_z');
        $ssh_z->expects($this->any())
            ->method('ssh_connect')
            ->will($this->returnSelf());
        $this->object->setObjetSSH($ssh_z)->setUpdate("oui");
        
        $this->assertSame($this->object, $this->object->send_via_ssh("echo TEST"));
    }

    /**
     * @covers Zorille\framework\xymon_client::send_linux
     */
    public function testsend_linux_withSSH()
    {
        $ssh_z = $this->createMock('Zorille\framework\ssh_z');
        $ssh_z->expects($this->any())
            ->method('ssh_connect')
            ->will($this->returnSelf());
        $this->object->setObjetSSH($ssh_z)->setActiveSSH(true);
        
        $this->assertSame($this->object, $this->object->send_linux("DATA"));
    }

    /**
     * @covers Zorille\framework\xymon_client::send_linux
     */
    public function testsend_linux_local()
    {
        $this->assertSame($this->object, $this->object->send_linux("DATA"));
    }

    /**
     * @covers Zorille\framework\xymon_client::send_win
     */
    public function testsend_win_local()
    {
        $this->assertSame($this->object, $this->object->send_win("DATA"));
    }

    /**
     * @covers Zorille\framework\xymon_client::send
     */
    public function testSend_win_whithData()
    {
        $this->object->setTypeOS("win")->setDatas("DATAS");
        $this->assertTrue($this->object->send("to@to.com", "from@from.com"));
    }

    /**
     * @covers Zorille\framework\xymon_client::send
     */
    public function testSend_linux_dataToLong()
    {
        $datas = "";
        for ($i = 0; $i < 10000; $i ++) {
            $datas .= $i;
        }
        $this->object->setTypeOS("linux")->setDatas($datas);
        $this->assertTrue($this->object->send("to@to.com", "from@from.com"));
    }
}
