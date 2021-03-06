<?php
namespace Zorille\framework;
/**
 * @ignore
 */
if (! defined ( '__DOCUMENT_ROOT__' )) {
	require_once $_SERVER ["PWD"] . '/prepare.php';
}

/**
 * Test class for dates.
 * Generated by PHPUnit on 2010-08-02 at 17:11:21.
 */
class fonctions_standards_datesTest extends MockedListeOptions {
	/**
	 * @var fonctions_standards_dates
	 */
	protected $object;
	
	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 */
	protected function setUp() {
		ob_start ();
		$this->object = new fonctions_standards_dates ( );
		$this->creer_liste_option();
	}
	
	/**
	 * Tears down the fixture, for example, closes a network connection.
	 * This method is called after a test is executed.
	 */
	protected function tearDown() {
		ob_end_clean ();
	}
	
	/**
	 * @covers Zorille\framework\fonctions_standards_dates::creer_liste_dates
	 */
	public function testCreer_liste_dates() {
		$this->getListeOption()->expects($this->at(0))->method('verifie_option_existe')->with("date")->will($this->returnValue(true));
		$this->getListeOption()->expects($this->at(1))->method('getOption')->with("date")->will($this->returnValue("20101202"));
		$this->assertInstanceOf('Zorille\framework\dates', $this->object->creer_liste_dates($this->getListeOption()));
		
		$this->getListeOption()->expects($this->at(0))->method('verifie_option_existe')->with("date")->will($this->returnValue(true));
		$this->getListeOption()->expects($this->at(1))->method('getOption')->with("date")->will($this->returnValue("20101202"));
		$this->getListeOption()->expects($this->at(2))->method('verifie_option_existe')->with("ajouter_week_extreme")->will($this->returnValue(true));
		$this->assertInstanceOf('Zorille\framework\dates', $this->object->creer_liste_dates($this->getListeOption()));
		
		$this->getListeOption()->expects($this->at(0))->method('verifie_option_existe')->with("date")->will($this->returnValue(true));
		$this->getListeOption()->expects($this->at(1))->method('getOption')->with("date")->will($this->returnValue("20101202"));
		$this->getListeOption()->expects($this->at(2))->method('verifie_option_existe')->with("ajouter_week_extreme")->will($this->returnValue(false));
		$this->getListeOption()->expects($this->at(3))->method('verifie_option_existe')->with("ajouter_month_extreme")->will($this->returnValue(true));
		$this->getListeOption()->expects($this->at(4))->method('setOption')->with("date")->will($this->returnValue(true));
		$this->getListeOption()->expects($this->at(5))->method('verifie_option_existe')->with("ajouter_dates_feries")->will($this->returnValue(true));
		$this->assertInstanceOf('Zorille\framework\dates', $this->object->creer_liste_dates($this->getListeOption()));
		
		$this->getListeOption()->expects($this->at(0))->method('verifie_option_existe')->with("date")->will($this->returnValue(false));
		$this->getListeOption()->expects($this->at(1))->method('verifie_option_existe')->with("date_debut")->will($this->returnValue(false));
		$this->getListeOption()->expects($this->at(2))->method('verifie_option_existe')->with("date_fin")->will($this->returnValue(false));
		$this->getListeOption()->expects($this->at(3))->method('verifie_option_existe')->with("ajouter_week_extreme")->will($this->returnValue(true));
		$this->getListeOption()->expects($this->at(4))->method('verifie_option_existe')->with("ajouter_month_extreme")->will($this->returnValue(true));
		$this->assertInstanceOf('Zorille\framework\dates', $this->object->creer_liste_dates($this->getListeOption()));
		
		$this->getListeOption()->expects($this->at(0))->method('verifie_option_existe')->with("date")->will($this->returnValue(false));
		$this->getListeOption()->expects($this->at(1))->method('verifie_option_existe')->with("date_debut")->will($this->returnValue(true));
		$this->getListeOption()->expects($this->at(2))->method('getOption')->with("date_debut")->will($this->returnValue("20101202"));
		$this->getListeOption()->expects($this->at(3))->method('verifie_option_existe')->with("date_fin")->will($this->returnValue(true));
		$this->getListeOption()->expects($this->at(4))->method('getOption')->with("date_fin")->will($this->returnValue("20101205"));
		$this->assertInstanceOf('Zorille\framework\dates', $this->object->creer_liste_dates($this->getListeOption()));
	}
}
?>