<?php
namespace Zorille\framework;
use \Exception as Exception;
use \SoapClient as SoapClient;
/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2015-05-18 at 10:57:18.
 */
if (! defined('__DOCUMENT_ROOT__')) {
    require_once $_SERVER["PWD"] . '/prepare.php';
}

class stars_soap_IncidentManagementTest extends MockedListeOptions
{

    /**
     *
     * @var stars_soap_IncidentManagement
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        ob_start();
        $soap = $this->createMock('Zorille\framework\soap');
        
        $this->object = new stars_soap_IncidentManagement(false, "TESTS stars_soap_IncidentManagement");
        $this->object->setSoapConnection($soap)->setListeOptions($this->getListeOption());
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
     * @covers Zorille\framework\stars_soap_IncidentManagement::connect
     */
    public function testConnect()
    {
        $this->object->getSoapConnection()
            ->expects($this->any())
            ->method('setCacheWsdl')
            ->will($this->returnSelf());
        $this->object->getSoapConnection()
            ->expects($this->any())
            ->method('retrouve_variables_tableau')
            ->will($this->returnSelf());
        $this->object->getSoapConnection()
            ->expects($this->any())
            ->method('connect')
            ->will($this->returnValue(true));
        
        $this->assertFalse($this->object->connect("Stars_TEST"));
    }

    /**
     * _prepareSoapRequest
     */
    private function _prepareSoapRequest($call_return)
    {
        $SoapClient = $this->createMock('SoapClient');
        
        $SoapClient->expects($this->any())
            ->method('__call')
            ->will($call_return);
        $soap = $this->createMock('Zorille\framework\soap');
        $soap->expects($this->any())
            ->method('getSoapClient')
            ->will($this->returnValue($SoapClient));
        $soap->expects($this->any())
            ->method('setCacheWsdl')
            ->will($this->returnSelf());
        $soap->expects($this->any())
            ->method('retrouve_variables_tableau')
            ->will($this->returnSelf());
        $soap->expects($this->any())
            ->method('connect')
            ->will($this->returnSelf());
        $this->object->setSoapConnection($soap);
    }

    /**
     * @covers Zorille\framework\stars_soap_IncidentManagement::applique_requete_soap
     */
    public function testApplique_requete_soap_False()
    {
        $this->object->getListeOptions()
            ->method('getOption')
            ->will($this->returnValue(true));
        
        $this->assertFalse($this->object->applique_requete_soap("TEST", array()));
    }

    /**
     * @covers Zorille\framework\stars_soap_IncidentManagement::applique_requete_soap
     */
    public function testApplique_requete_soap_applique_requete_soap()
    {
        $this->object->getListeOptions()
            ->method('getOption')
            ->will($this->returnValue(false));
        
        $this->_prepareSoapRequest($this->returnValue(array(
            "applique_requete_soap"
        )));
        $this->assertEquals(array(
            "applique_requete_soap"
        ), $this->object->applique_requete_soap("TEST", array()));
    }

    /**
     * @covers Zorille\framework\stars_soap_IncidentManagement::applique_requete_soap
     */
    public function testApplique_requete_soap_Exception()
    {
        $this->object->getListeOptions()
            ->method('getOption')
            ->will($this->returnValue(false));
        
        $this->_prepareSoapRequest($this->throwException(new Exception('EXCEP1')));
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('(TESTS stars_soap_IncidentManagement) EXCEP1');
        $this->object->applique_requete_soap("TEST", array());
    }

    /**
     * @covers Zorille\framework\stars_soap_IncidentManagement::CreateIncident
     */
    public function testCreateIncident_Exception()
    {
        $this->object->getListeOptions()
            ->method('getOption')
            ->will($this->returnValue(false));
        $SoapClient = $this->createMock('SoapClient');
        
        $SoapClient->expects($this->any())
            ->method('__call')
            ->will($this->throwException(new Exception('EXCEP1')));
        $this->object->getSoapConnection()
            ->expects($this->any())
            ->method('getSoapClient')
            ->will($this->returnValue($SoapClient));
        
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('(TESTS stars_soap_IncidentManagement) EXCEP1');
        $this->object->CreateIncident("INCIDENT");
    }

    /**
     * @covers Zorille\framework\stars_soap_IncidentManagement::CreateIncident
     */
    public function testCreateIncident_True()
    {
        $this->object->getListeOptions()
            ->method('getOption')
            ->will($this->returnValue(false));
        $SoapClient = $this->createMock('SoapClient');
        
        $SoapClient->expects($this->any())
            ->method('__call')
            ->will($this->returnValue(array(
            "DATA1",
            "DATA2"
        )));
        $this->object->getSoapConnection()
            ->expects($this->any())
            ->method('getSoapClient')
            ->will($this->returnValue($SoapClient));
        
        $this->assertEquals(array(
            "DATA1",
            "DATA2"
        ), $this->object->CreateIncident("INCIDENT"));
    }

    /**
     * @covers Zorille\framework\stars_soap_IncidentManagement::RetrieveIncidentList
     */
    public function testRetrieveIncidentList_Exception()
    {
        $this->object->getListeOptions()
            ->method('getOption')
            ->will($this->returnValue(false));
        $SoapClient = $this->createMock('SoapClient');
        
        $SoapClient->expects($this->any())
            ->method('__call')
            ->will($this->throwException(new Exception('EXCEP1')));
        $this->object->getSoapConnection()
            ->expects($this->any())
            ->method('getSoapClient')
            ->will($this->returnValue($SoapClient));
        
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('(TESTS stars_soap_IncidentManagement) EXCEP1');
        $this->object->RetrieveIncidentList("INCIDENT");
    }

    /**
     * @covers Zorille\framework\stars_soap_IncidentManagement::RetrieveIncidentList
     */
    public function testRetrieveIncidentList_True()
    {
        $this->object->getListeOptions()
            ->method('getOption')
            ->will($this->returnValue(false));
        $SoapClient = $this->createMock('SoapClient');
        
        $SoapClient->expects($this->any())
            ->method('__call')
            ->will($this->returnValue(array(
            "DATA1",
            "DATA2"
        )));
        $this->object->getSoapConnection()
            ->expects($this->any())
            ->method('getSoapClient')
            ->will($this->returnValue($SoapClient));
        
        $this->assertEquals(array(
            "DATA1",
            "DATA2"
        ), $this->object->RetrieveIncidentList("INCIDENT"));
    }
}
