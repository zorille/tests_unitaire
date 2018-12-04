<?php
namespace Zorille\framework;
use \Exception as Exception;
use \SoapClient as SoapClient;
/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2014-08-26 at 11:06:09.
 */
if (! defined('__DOCUMENT_ROOT__')) {
    require_once $_SERVER["PWD"] . '/prepare.php';
}

class sitescope_soap_reportMonitorDataTest extends MockedListeOptions
{

    /**
     *
     * @var sitescope_soap_reportMonitorData
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
        
        $this->object = new sitescope_soap_reportMonitorData(false, "sitescope_soap_reportMonitorData");
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
     * @covers Zorille\framework\sitescope_soap_reportMonitorData::connect
     */
    public function testConnect_False()
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
        
        $this->assertFalse($this->object->connect("SIS_TEST"));
    }

    /**
     * @covers Zorille\framework\sitescope_soap_reportMonitorData::reportData
     */
    public function testreportData_Exception()
    {
        $this->object->getListeOptions()
            ->method('getOption')
            ->will($this->returnValue(false));
        $SoapClient = $this->createMock('SoapClient');
        
        $SoapClient->expects($this->any())
            ->method('__call')
            ->with('reportData')
            ->will($this->throwException(new Exception('EXCEP1')));
        $this->object->getSoapConnection()
            ->expects($this->any())
            ->method('getSoapClient')
            ->will($this->returnValue($SoapClient));
        
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('(sitescope_soap_reportMonitorData) EXCEP1');
        $this->object->reportData("ID", array());
    }

    /**
     * @covers Zorille\framework\sitescope_soap_reportMonitorData::reportData
     */
    public function testreportData_datas()
    {
        $this->object->getListeOptions()
            ->method('getOption')
            ->will($this->returnValue(false));
        $SoapClient = $this->createMock('SoapClient');
        
        $SoapClient->expects($this->any())
            ->method('__call')
            ->with('reportData')
            ->will($this->returnValue("datas"));
        $this->object->getSoapConnection()
            ->expects($this->any())
            ->method('getSoapClient')
            ->will($this->returnValue($SoapClient));
        
        $this->assertEquals("datas", $this->object->reportData("ID", array()));
    }

    /**
     * @covers Zorille\framework\sitescope_soap_reportMonitorData::reportEvent
     */
    public function testreportEvent()
    {
        $this->object->getListeOptions()
            ->method('getOption')
            ->will($this->returnValue(false));
        $SoapClient = $this->createMock('SoapClient');
        
        $SoapClient->expects($this->any())
            ->method('__call')
            ->will($this->returnValue(array(
            "DATA1"
        )));
        $this->object->getSoapConnection()
            ->expects($this->any())
            ->method('getSoapClient')
            ->will($this->returnValue($SoapClient));
        
        $this->assertEquals(array(
            "DATA1"
        ), $this->object->reportEvent(array()));
    }

    /**
     * @covers Zorille\framework\sitescope_soap_reportMonitorData::reportEventsArray
     */
    public function testreportEventsArray()
    {
        $this->object->getListeOptions()
            ->method('getOption')
            ->will($this->returnValue(false));
        $SoapClient = $this->createMock('SoapClient');
        
        $SoapClient->expects($this->any())
            ->method('__call')
            ->will($this->returnValue(array(
            "DATA1"
        )));
        $this->object->getSoapConnection()
            ->expects($this->any())
            ->method('getSoapClient')
            ->will($this->returnValue($SoapClient));
        
        $this->assertEquals(array(
            "DATA1"
        ), $this->object->reportEventsArray(array()));
    }

    /**
     * @covers Zorille\framework\sitescope_soap_reportMonitorData::reportMetricObject
     */
    public function testreportMetricObject()
    {
        $this->object->getListeOptions()
            ->method('getOption')
            ->will($this->returnValue(false));
        $SoapClient = $this->createMock('SoapClient');
        
        $SoapClient->expects($this->any())
            ->method('__call')
            ->will($this->returnValue(array(
            "DATA1"
        )));
        $this->object->getSoapConnection()
            ->expects($this->any())
            ->method('getSoapClient')
            ->will($this->returnValue($SoapClient));
        
        $this->assertEquals(array(
            "DATA1"
        ), $this->object->reportMetricObject(array()));
    }

    /**
     * @covers Zorille\framework\sitescope_soap_reportMonitorData::reportMetricsArray
     */
    public function testreportMetricsArray()
    {
        $this->object->getListeOptions()
            ->method('getOption')
            ->will($this->returnValue(false));
        $SoapClient = $this->createMock('SoapClient');
        
        $SoapClient->expects($this->any())
            ->method('__call')
            ->will($this->returnValue(array(
            "DATA1"
        )));
        $this->object->getSoapConnection()
            ->expects($this->any())
            ->method('getSoapClient')
            ->will($this->returnValue($SoapClient));
        
        $this->assertEquals(array(
            "DATA1"
        ), $this->object->reportMetricsArray(array()));
    }
}
