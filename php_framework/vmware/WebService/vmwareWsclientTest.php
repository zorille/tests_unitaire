<?php
/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2015-04-29 at 09:07:56.
 */
if (! defined('__DOCUMENT_ROOT__')) {
    require_once $_SERVER["PWD"] . '/prepare.php';
}

class vmwareWsclientTest extends MockedListeOptions
{

    /**
     *
     * @var vmwareWsclient
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        ob_start();
        
        $vmwareDatas = $this->createMock("vmwareDatas");
        $soap = $this->createMock("soap");
        $vmwareServiceInstance = $this->createMock("vmwareServiceInstance");
        
        $this->object = new vmwareWsclient(false, "TESTS vmwareWsclient");
        $this->object->setListeOptions($this->getListeOption())
            ->setObjetVMWareDatas($vmwareDatas)
            ->setObjetSoap($soap)
            ->setObjectServiceInstance($vmwareServiceInstance);
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
     * @covers vmwareWsclient::prepare_connexion
     */
    public function testPrepare_connexion_exception1()
    {
        $this->object->getObjetVMWareDatas()
            ->method('valide_presence_vmware_data')
            ->will($this->returnValue(false));
        $this->object->getObjetVMWareDatas()
            ->expects($this->any())
            ->method('recupere_donnees_vmware_serveur')
            ->will($this->returnValue(array()));
        $this->object->getObjetSoap()
            ->expects($this->any())
            ->method('setCacheWsdl')
            ->will($this->returnSelf());
        $this->object->getObjetSoap()
            ->expects($this->any())
            ->method('retrouve_variables_tableau')
            ->will($this->returnSelf());
        $this->object->getObjetSoap()
            ->expects($this->any())
            ->method('connect')
            ->will($this->returnSelf());
        $this->object->getObjectServiceInstance()
            ->expects($this->any())
            ->method('creer_entete_sessionManager_this')
            ->will($this->returnValue(new stdClass()));
        
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('(TESTS vmwareWsclient) Aucune definition de vmware pour NOM1');
        $this->object->prepare_connexion("NOM1");
    }

    /**
     * @covers vmwareWsclient::prepare_connexion
     */
    public function testPrepare_connexion_exception2()
    {
        $this->object->getObjetVMWareDatas()
            ->method('valide_presence_vmware_data')
            ->will($this->returnValue(array()));
        $this->object->getObjetVMWareDatas()
            ->expects($this->any())
            ->method('recupere_donnees_vmware_serveur')
            ->will($this->returnValue(array()));
        $this->object->getObjetSoap()
            ->expects($this->any())
            ->method('setCacheWsdl')
            ->will($this->returnSelf());
        $this->object->getObjetSoap()
            ->expects($this->any())
            ->method('retrouve_variables_tableau')
            ->will($this->returnSelf());
        $this->object->getObjetSoap()
            ->expects($this->any())
            ->method('connect')
            ->will($this->returnSelf());
        $this->object->getObjectServiceInstance()
            ->expects($this->any())
            ->method('creer_entete_sessionManager_this')
            ->will($this->returnValue(new stdClass()));
        
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('(TESTS vmwareWsclient) Il faut un username dans la liste des parametres vmware');
        $this->object->prepare_connexion("NOM1");
    }

    /**
     * @covers vmwareWsclient::prepare_connexion
     */
    public function testPrepare_connexion_exception3()
    {
        $this->object->getObjetVMWareDatas()
            ->method('valide_presence_vmware_data')
            ->will($this->returnValue(array(
            "username" => "user"
        )));
        $this->object->getObjetVMWareDatas()
            ->expects($this->any())
            ->method('recupere_donnees_vmware_serveur')
            ->will($this->returnValue(array()));
        $this->object->getObjetSoap()
            ->expects($this->any())
            ->method('setCacheWsdl')
            ->will($this->returnSelf());
        $this->object->getObjetSoap()
            ->expects($this->any())
            ->method('retrouve_variables_tableau')
            ->will($this->returnSelf());
        $this->object->getObjetSoap()
            ->expects($this->any())
            ->method('connect')
            ->will($this->returnSelf());
        $this->object->getObjectServiceInstance()
            ->expects($this->any())
            ->method('creer_entete_sessionManager_this')
            ->will($this->returnValue(new stdClass()));
        
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('(TESTS vmwareWsclient) Il faut un password dans la liste des parametres vmware');
        $this->object->prepare_connexion("NOM1");
    }

    /**
     * @covers vmwareWsclient::prepare_connexion
     */
    public function testPrepare_connexion_exception4()
    {
        $this->object->getObjetVMWareDatas()
            ->method('valide_presence_vmware_data')
            ->will($this->returnValue(array(
            "username" => "user",
            "password" => "pwd"
        )));
        $this->object->getObjetVMWareDatas()
            ->expects($this->any())
            ->method('recupere_donnees_vmware_serveur')
            ->will($this->returnValue(array()));
        $this->object->getObjetSoap()
            ->expects($this->any())
            ->method('setCacheWsdl')
            ->will($this->returnSelf());
        $this->object->getObjetSoap()
            ->expects($this->any())
            ->method('retrouve_variables_tableau')
            ->will($this->returnSelf());
        $this->object->getObjetSoap()
            ->expects($this->any())
            ->method('connect')
            ->will($this->returnSelf());
        $this->object->getObjectServiceInstance()
            ->expects($this->any())
            ->method('creer_entete_sessionManager_this')
            ->will($this->returnValue(new stdClass()));
        
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('(TESTS vmwareWsclient) Il faut une url dans la liste des parametres vmware');
        $this->object->prepare_connexion("NOM1");
    }

    /**
     * @covers vmwareWsclient::prepare_connexion
     */
    public function testPrepare_connexion_valide()
    {
        $this->object->getObjetVMWareDatas()
            ->method('valide_presence_vmware_data')
            ->will($this->returnValue(array(
            "username" => "user",
            "password" => "pwd",
            "url" => "URL1"
        )));
        $this->object->getObjetVMWareDatas()
            ->expects($this->any())
            ->method('recupere_donnees_vmware_serveur')
            ->will($this->returnValue(array()));
        $this->object->getObjetSoap()
            ->expects($this->any())
            ->method('setCacheWsdl')
            ->will($this->returnSelf());
        $this->object->getObjetSoap()
            ->expects($this->any())
            ->method('retrouve_variables_tableau')
            ->will($this->returnSelf());
        $this->object->getObjetSoap()
            ->expects($this->any())
            ->method('connect')
            ->will($this->returnSelf());
        $this->object->getObjectServiceInstance()
            ->expects($this->any())
            ->method('creer_entete_sessionManager_this')
            ->will($this->returnValue(new stdClass()));
        
        $this->assertSame($this->object, $this->object->prepare_connexion("NOM1"));
    }

    /**
     * _prepareSoapRequest
     */
    private function _prepareSoapRequest($call_return)
    {
        $SoapClient = $this->createMock('SoapClient');
        $SoapClient->expects($this->any())
            ->method('__soapCall')
            ->will($call_return);
        $soap = $this->createMock("soap");
        $soap->expects($this->any())
            ->method('getSoapClient')
            ->will($this->returnValue($SoapClient));
        $this->object->setObjetSoap($soap);
    }
    

    /**
     * @covers vmwareWsclient::applique_requete_soap
     */
    public function testApplique_requete_soap_false()
    {
        $this->object->getListeOptions()
        ->method('getOption')
        ->will($this->returnValue(true));
        
        $this->assertFalse($this->object->applique_requete_soap("TEST", array()));
    }
    
    /**
     * @covers vmwareWsclient::applique_requete_soap
     */
    public function testApplique_requete_soap_response1()
    {
        $this->object->getListeOptions()
        ->method('getOption')
        ->will($this->returnValue(false));
        
        $this->_prepareSoapRequest($this->returnValue(array()));
        $this->assertEquals(array(), $this->object->applique_requete_soap("TEST", array()));
    }
    
    /**
     * @covers vmwareWsclient::applique_requete_soap
     */
    public function testApplique_requete_soap_response2()
    {
        $this->object->getListeOptions()
        ->method('getOption')
        ->will($this->returnValue(false));
        
        $stdclass = new stdClass();
        $stdclass->returnval = array(
            "stdClass"
        );
        $this->_prepareSoapRequest($this->returnValue($stdclass));
        $this->assertEquals(array(
            0 => 'stdClass'
        ), $this->object->applique_requete_soap("TEST", array()));
    }
    
    /**
     * @covers vmwareWsclient::applique_requete_soap
     */
    public function testApplique_requete_soap_response3()
    {
        $this->object->getListeOptions()
        ->method('getOption')
        ->will($this->returnValue(false));
        
        $exception=new Exception('EXCEP1');
        $this->_prepareSoapRequest($this->throwException($exception));
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('(TESTS vmwareWsclient) EXCEP1');
        $this->object->applique_requete_soap("TEST", array());
    }

    /**
     * @covers vmwareWsclient::login
     */
    public function testLogin()
    {
        $this->object->getListeOptions()
            ->expects($this->any())
            ->method('getOption')
            ->will($this->returnValue(false));
        $this->object->getObjectServiceInstance()
            ->expects($this->any())
            ->method('creer_entete_sessionManager_this')
            ->will($this->returnValue(new stdClass()));
        $this->_prepareSoapRequest($this->returnValue(array()));
        $this->assertEquals(array(), $this->object->login("USER1", "PASS1"));
    }

    /**
     * @covers vmwareWsclient::logout
     */
    public function testLogout()
    {
        $this->object->getListeOptions()
            ->expects($this->any())
            ->method('getOption')
            ->will($this->returnValue(false));
        $this->object->getObjectServiceInstance()
            ->expects($this->any())
            ->method('creer_entete_sessionManager_this')
            ->will($this->returnValue(new stdClass()));
        $this->_prepareSoapRequest($this->returnValue(array()));
        $this->assertEquals(array(), $this->object->logout());
    }

    private function _retourSoapTest()
    {
        $obj = new stdClass();
        $obj->_ = "vm-191";
        $obj->type = "VirtualMachine";
        
        $runtimeState = new stdClass();
        $runtimeState->vmDirectPathGen2Active = "";
        $runtimeState->vmDirectPathGen2InactiveReasonOther = "vmNptIncompatibleNetwork";
        
        $device = new stdClass();
        $device->runtimeState = $runtimeState;
        $device->key = 4000;
        
        $host = new stdClass();
        $host->_ = "host-129";
        $host->type = "HostSystem";
        
        $feature1 = new stdClass();
        $feature1->key = "cpuid.SSE3";
        $feature1->featureName = "cpuid.SSE3";
        $feature1->value = "Bool:Min:1";
        
        $feature2 = new stdClass();
        $feature2->key = "cpuid.PCLMULQDQ";
        $feature2->featureName = "cpuid.PCLMULQDQ";
        $feature2->value = "Bool:Min:1";
        
        $val = new stdClass();
        $val->device = $device;
        $val->host = $host;
        $val->connectionState = "connected";
        $val->powerState = "poweredOn";
        $val->featureRequirement = array(
            $feature1,
            $feature2
        );
        
        $propSet1 = new stdClass();
        $propSet1->name = "runtime";
        $propSet1->val = $val;
        
        $propSet2 = new stdClass();
        $propSet2->name = "name";
        $propSet2->val = "Cluster1";
        
        $objects = new stdClass();
        $objects->obj = $obj;
        $objects->propSet = array(
            $propSet1,
            $propSet2
        );
        
        $retour = new stdClass();
        $retour->objects = $objects;
        
        return $retour;
    }

    /**
     * covers vmwareWsclient::convertit_donnees
     */
    public function testconvertit_donnees_array()
    {
        $this->assertEquals(array(
            'objects' => Array(
                'obj' => array(
                    '_' => 'vm-191',
                    'type' => 'VirtualMachine'
                ),
                'propSet' => array(
                    "name" => "Cluster1",
                    "runtime" => array(
                        'device' => Array(
                            'runtimeState' => Array(
                                'vmDirectPathGen2Active' => '',
                                'vmDirectPathGen2InactiveReasonOther' => 'vmNptIncompatibleNetwork'
                            ),
                            'key' => '4000'
                        ),
                        'host' => Array(
                            '_' => 'host-129',
                            'type' => 'HostSystem'
                        ),
                        'connectionState' => 'connected',
                        'powerState' => 'poweredOn',
                        'featureRequirement' => Array(
                            Array(
                                'key' => 'cpuid.SSE3',
                                'featureName' => 'cpuid.SSE3',
                                'value' => 'Bool:Min:1'
                            ),
                            Array(
                                'key' => 'cpuid.PCLMULQDQ',
                                'featureName' => 'cpuid.PCLMULQDQ',
                                'value' => 'Bool:Min:1'
                            )
                        )
                    )
                )
            )
        ), $this->object->convertit_donnees($this->_retourSoapTest(), "array"));
    }

    /**
     * @covers vmwareWsclient::convertit_donnees
     */
    public function testconvertit_donnees_xml()
    {
        $this->assertInstanceOf('xml', $this->object->convertit_donnees($this->_retourSoapTest(), "xml"));
    }
}