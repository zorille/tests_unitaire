<?php
if (! defined ( '__DOCUMENT_ROOT__' )) {
	require_once $_SERVER ["PWD"] . '/prepare.php';
}

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2015-03-25 at 11:40:25.
 */
class zabbix_actionTest extends MockedListeOptions {
	/**
     * @var zabbix_action
     */
	protected $object;

	/**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
	protected function setUp() {
		ob_start ();
		$zabbix_wsclient = $this ->createMock ( "zabbix_wsclient" );
		
		$this->object = new zabbix_action ( false, "zabbix_action" );
		$this->object ->setObjetZabbixWsclient ( $zabbix_wsclient );
	}

	/**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
	protected function tearDown() {
		ob_end_clean ();
	}

	/**
     * @covers zabbix_action::retrouve_zabbix_param
     */
	public function testRetrouve_zabbix_param_Exception() {
		$this ->getListeOption () 
			->expects ( $this ->any () ) 
			->method ( 'verifie_variable_standard' ) 
			->will ( $this ->returnValue ( false ) );
		$this->object ->setListeOptions ( $this ->getListeOption () );
		
		$this ->expectException(Exception::class);
        $this->expectExceptionMessage( '(zabbix_action) Il manque le parametre : zabbix_action_name' );
		$this->object ->retrouve_zabbix_param ();
	}

	/**
	 * @covers zabbix_action::retrouve_zabbix_param
	 */
	public function testRetrouve_zabbix_param() {
		$condition_ref = $this ->createMock ( "zabbix_action_condition" );
		$condition_ref ->expects ( $this ->any () ) 
			->method ( 'retrouve_zabbix_param' ) 
			->will ( $this ->returnValue ( true ) );
		$this->object ->setObjetActionConditionRef ( $condition_ref );
		$operation_ref = $this ->createMock ( "zabbix_action_operation" );
		$operation_ref ->expects ( $this ->any () ) 
			->method ( 'retrouve_zabbix_param' ) 
			->will ( $this ->returnValue ( true ) );
		$this->object ->setObjetActionOperationRef ( $operation_ref );
		
		$this ->getListeOption () 
			->expects ( $this ->any () ) 
			->method ( 'verifie_variable_standard' ) 
			->will ( $this ->returnValue ( true ) );
		$this ->getListeOption () 
			->expects ( $this ->any () ) 
			->method ( 'renvoi_variables_standard' ) 
			->will ( $this ->returnValue ( "send message" ) );
		$this->object ->setListeOptions ( $this ->getListeOption () );
		
		$this ->assertSame ( $this->object, $this->object ->retrouve_zabbix_param () );
		$this ->assertEquals ( "send message", $this->object ->getName () );
	}

	/**
     * @covers zabbix_action::creer_definition_action_ws
     */
	public function testCreer_definition_action_ws() {
		$condition_ref = $this ->createMock ( "zabbix_action_condition" );
		$condition_ref ->expects ( $this ->any () ) 
			->method ( 'creer_definition_action_condition_ws' ) 
			->will ( $this ->returnValue ( array ( 
				"conditiontype" => 0, 
				"operator" => 0, 
				"value" => "Cond de test" ) ) );
		
		$conditions = array ( 
				$condition_ref, 
				$condition_ref );
		$this->object ->setConditions ( $conditions );
		$operation_ref = $this ->createMock ( "zabbix_action_operation" );
		$operation_ref ->expects ( $this ->any () ) 
			->method ( 'creer_definition_action_operation_ws' ) 
			->will ( $this ->returnValue ( array ( 
				"operationtype" => 0, 
				"operator" => 0, 
				"value" => "OP de test" ) ) );
		
		$operations = array ( 
				$operation_ref, 
				$operation_ref );
		$this->object ->setOperations ( $operations );
		
		$this->object ->setName ( "NOM1" ) 
			->setEscPeriod ( 3600 ) 
			->setEvalType ( 0 ) 
			->setEventSource ( 1 ) 
			->setDefLongdata ( "def_longdata" ) 
			->setDefShortdata ( "def_shortdata" ) 
			->setRLongData ( "r_longdata" ) 
			->setRShortData ( "r_shortdata" ) 
			->setRecoveryMsg ( 1 ) 
			->setStatus ( 0 ) 
			->setActionId ( 101 );
		$retour = array ( 
				"esc_period" => 3600, 
				"evaltype" => 0, 
				"eventsource" => 1, 
				"name" => "NOM1", 
				"def_longdata" => "def_longdata", 
				"def_shortdata" => "def_shortdata", 
				"r_longdata" => "r_longdata", 
				"r_shortdata" => "r_shortdata", 
				"recovery_msg" => 1, 
				"status" => 0, 
				"conditions" => array ( 
						array ( 
								"conditiontype" => 0, 
								"operator" => 0, 
								"value" => "Cond de test" ), 
						array ( 
								"conditiontype" => 0, 
								"operator" => 0, 
								"value" => "Cond de test" ) ), 
				"operations" => array ( 
						array ( 
								"operationtype" => 0, 
								"operator" => 0, 
								"value" => "OP de test" ), 
						array ( 
								"operationtype" => 0, 
								"operator" => 0, 
								"value" => "OP de test" ) ), 
				"actionid" => 101 );
		$this ->assertEquals ( $retour, $this->object ->creer_definition_action_ws () );
	}

	/**
     * @covers zabbix_action::creer_definition_action_conditions_ws
     */
	public function testCreer_definition_action_conditions_ws() {
		$condition_ref = $this ->createMock ( "zabbix_action_condition" );
		$condition_ref ->expects ( $this ->any () ) 
			->method ( 'creer_definition_action_condition_ws' ) 
			->will ( $this ->returnValue ( array ( 
				"conditiontype" => 0, 
				"operator" => 0, 
				"value" => "valeur de test" ) ) );
		
		$conditions = array ( 
				$condition_ref, 
				$condition_ref );
		$this->object ->setConditions ( $conditions );
		
		$this ->assertEquals ( 
				array ( 
							"conditions" => array ( 
									array ( 
											"conditiontype" => 0, 
											"operator" => 0, 
											"value" => "valeur de test" ), 
									array ( 
											"conditiontype" => 0, 
											"operator" => 0, 
											"value" => "valeur de test" ) ) ), 
					$this->object ->creer_definition_action_conditions_ws () );
	}

	/**
     * @covers zabbix_action::creer_definition_action_operations_ws
     */
	public function testCreer_definition_action_operations_ws() {
		$operation_ref = $this ->createMock ( "zabbix_action_operation" );
		$operation_ref ->expects ( $this ->any () ) 
			->method ( 'creer_definition_action_operation_ws' ) 
			->will ( $this ->returnValue ( array ( 
				"operationtype" => 0, 
				"operator" => 0, 
				"value" => "valeur de test" ) ) );
		
		$operations = array ( 
				$operation_ref, 
				$operation_ref );
		$this->object ->setOperations ( $operations );
		
		$this ->assertEquals ( 
				array ( 
							"operations" => array ( 
									array ( 
											"operationtype" => 0, 
											"operator" => 0, 
											"value" => "valeur de test" ), 
									array ( 
											"operationtype" => 0, 
											"operator" => 0, 
											"value" => "valeur de test" ) ) ), 
					$this->object ->creer_definition_action_operations_ws () );
	}

	/**
	 * @covers zabbix_action::creer_action
	 */
	public function testCreer_action() {
		$this->object ->setName ( "NAME1" );
		$this->object ->getObjetZabbixWsclient () 
			->expects ( $this ->any () ) 
			->method ( 'actionCreate' ) 
			->will ( $this ->returnValue ( array ( 
				"actionids" => array ( 
						10 ) ) ) );
		
		$this ->assertEquals ( array ( 
				"actionids" => array ( 
						10 ) ), $this->object ->creer_action () );
	}

	/**
	 * @covers zabbix_action::creer_definition_action_delete_ws
	 */
	public function testCreer_definition_action_delete_ws() {
		$this ->assertEquals ( array (), $this->object ->creer_definition_action_delete_ws () );
		$this->object ->setActionId ( 10 );
		$this ->assertEquals ( array ( 
				10 ), $this->object ->creer_definition_action_delete_ws () );
	}

	/**
	 * @covers zabbix_action::supprime_action
	 */
	public function testSupprime_action() {
		$this->object ->getObjetZabbixWsclient () 
			->expects ( $this ->any () ) 
			->method ( 'actionDelete' ) 
			->will ( $this ->returnValue ( array ( 
				"actionids" => array ( 
						10 ) ) ) );
		
		$this ->assertEquals ( array ( 
				"actionids" => array ( 
						10 ) ), $this->object ->supprime_action () );
	}

	/**
	 * @covers zabbix_action::creer_definition_actionByName_get_ws
	 */
	public function testCreer_definition_actionByName_get_ws() {
		$this->object ->setName ( "NOM1" );
		
		$this ->assertEquals ( array ( 
				"output" => "actionid", 
				"filter" => array ( 
						"name" => "NOM1" ) ), $this->object ->creer_definition_actionByName_get_ws () );
	}

	/**
	 * @covers zabbix_action::recherche_actionid_by_Name
	 */
	public function testRecherche_actionid_by_Name() {
		$this->object ->getObjetZabbixWsclient () 
			->expects ( $this ->any () ) 
			->method ( 'actionGet' ) 
			->will ( $this ->returnValue ( array ( 
				array ( 
						"actionid" => "7" ) ) ) );
		
		$this ->assertSame ( $this->object, $this->object ->recherche_actionid_by_Name () );
		$this ->assertEquals ( "7", $this->object ->getActionId () );
	}

	/**
     * @covers zabbix_action::retrouve_EventSource
     */
	public function testRetrouve_EventSource() {
		//trigger/discovered host/discovered service/auto-registered host/item/lld rule
		$this ->assertEquals ( 0, $this->object ->retrouve_EventSource ( "" ) );
		$this ->assertEquals ( 0, $this->object ->retrouve_EventSource ( "trigger" ) );
		$this ->assertEquals ( 1, $this->object ->retrouve_EventSource ( "discovered host" ) );
		$this ->assertEquals ( 2, $this->object ->retrouve_EventSource ( "discovered service" ) );
		$this ->assertEquals ( 3, $this->object ->retrouve_EventSource ( "auto-registered host" ) );
		$this ->assertEquals ( 4, $this->object ->retrouve_EventSource ( "item" ) );
		$this ->assertEquals ( 5, $this->object ->retrouve_EventSource ( "lld rule" ) );
		$this ->assertEquals ( 10, $this->object ->retrouve_EventSource ( 10 ) );
	}

	/**
     * @covers zabbix_action::retrouve_EvalType
     */
	public function testRetrouve_EvalType() {
		$this ->assertEquals ( 0, $this->object ->retrouve_EvalType ( "" ) );
		$this ->assertEquals ( 0, $this->object ->retrouve_EvalType ( "and/or" ) );
		$this ->assertEquals ( 1, $this->object ->retrouve_EvalType ( "and" ) );
		$this ->assertEquals ( 2, $this->object ->retrouve_EvalType ( "or" ) );
		$this ->assertEquals ( 10, $this->object ->retrouve_EvalType ( 10 ) );
	}

	/**
	 * @covers zabbix_action::retrouve_Status
	 */
	public function testRetrouve_Status() {
		$this ->assertEquals ( 0, $this->object ->retrouve_Status ( "" ) );
		$this ->assertEquals ( 0, $this->object ->retrouve_Status ( "enabled" ) );
		$this ->assertEquals ( 1, $this->object ->retrouve_Status ( "disabled" ) );
		$this ->assertEquals ( 10, $this->object ->retrouve_Status ( 10 ) );
	}

	/**
	 * @covers zabbix_action::retrouve_RecoveryMsg
	 */
	public function testRetrouve_RecoveryMsg() {
		$this ->assertEquals ( 0, $this->object ->retrouve_RecoveryMsg ( "" ) );
		$this ->assertEquals ( 0, $this->object ->retrouve_RecoveryMsg ( "disabled" ) );
		$this ->assertEquals ( 1, $this->object ->retrouve_RecoveryMsg ( "enabled" ) );
		$this ->assertEquals ( 10, $this->object ->retrouve_RecoveryMsg ( 10 ) );
	}
}
