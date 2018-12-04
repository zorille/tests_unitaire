<?php
namespace Zorille\framework;
use PHPUnit\Framework\TestCase as TestCase;

/**
 * @ignore
 */
abstract class MockedListeOptions extends TestCase {
	public $liste_options;

	public function __construct() {
	    parent::__construct();
		$this->creer_liste_option ();
	}

	public function creer_liste_option() {
		$this->liste_options = $this->createMock ('Zorille\framework\options');
	}

	/**
	 * Mise en place des methodes de la liste option
	 *
	 * @param array|string $verifieListeCallback
	 * @param array|string $renvoieListeCallback
	 * @param array|string $setListeCallback
	 */
	public function createListe($verifieListeCallback = 'none', $renvoieListeCallback = 'none', $setListeCallback = 'none') {
		$this->liste_options->expects ( $this->any () )
			->method ( 'verifie_option_existe' )
			->will ( $this->returnCallback ( array (
				"MockedListeOptions",
				$verifieListeCallback 
		) ) );
		$this->liste_options->expects ( $this->any () )
			->method ( 'getOption' )
			->will ( $this->returnCallback ( array (
				"MockedListeOptions",
				$renvoieListeCallback 
		) ) );
		$this->liste_options->expects ( $this->any () )
			->method ( 'setOption' )
			->will ( $this->returnCallback ( array (
				"MockedListeOptions",
				$setListeCallback 
		) ) );
	}

	/**
	 * Mise en place des methodes de la liste option
	 *
	 */
	public function createListeFalse() {
		$this->liste_options->expects ( $this->any () )
			->method ( 'verifie_option_existe' )
			->will ( $this->returnValue ( false ) );
		$this->liste_options->expects ( $this->any () )
			->method ( 'getOption' )
			->will ( $this->returnValue ( false ) );
		$this->liste_options->expects ( $this->any () )
			->method ( 'setOption' )
			->will ( $this->returnValue ( false ) );
	}

	/**
	 * Mise en place des methodes de la liste option
	 *
	 */
	public function createListeTrue() {
		$this->liste_options->expects ( $this->any () )
			->method ( 'verifie_option_existe' )
			->will ( $this->returnValue ( true ) );
		$this->liste_options->expects ( $this->any () )
			->method ( 'getOption' )
			->will ( $this->returnValue ( true ) );
		$this->liste_options->expects ( $this->any () )
			->method ( 'setOption' )
			->will ( $this->returnValue ( true ) );
	}

	/********** Accesseur ************/
	public function &getListeOption() {
		return $this->liste_options;
	}

	/********** Accesseur ************/
	
	/******************************* variablestandardTest *********************************************/
	/**
	 * fonction pour le callback
	 * @param array $args
	 */
	static function renvoi_standard(&$args) {
		switch ($args [0]) {
			case "numero_rotate" :
				return "3";
			case "hour" :
				return "18";
			case "min" :
				return "25";
			case "sec" :
				return "48";
			case "noeud" :
				return "noeud1";
			case "service" :
				return "service1";
			case "serial" :
				return "123456";
			default :
				return false;
		}
	}

	/**
	 * fonction pour le callback variablestandard
	 */
	static function liste_option_variablestandard() {
		$args = func_get_args ();
		
		$retour = MockedListeOptions::renvoi_standard ( $args );
		if ($retour === false) {
			switch ($args [0]) {
				case "genday" :
					return "20100801";
				case "repservice" :
					return "repservice";
				default :
					return false;
			}
		}
		
		return $retour;
	}

	/**
	 * fonction pour le callback variablestandard
	 */
	static function liste_option_variablestandard_false() {
		$args = func_get_args ();
		
		$retour = MockedListeOptions::renvoi_standard ( $args );
		if ($retour === false) {
			switch ($args [0]) {
				default :
					return false;
			}
		}
		
		return $retour;
	}
/******************************* variablestandardTest *********************************************/
}
