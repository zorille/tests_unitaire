<?php

namespace Zorille\framework;

/**
 * @ignore
 */
if (defined ( 'E_DEPRECATED' )) {
	error_reporting ( E_ALL & ~ E_DEPRECATED );
} else {
	error_reporting ( E_ALL );
}
$rep_document = "/TOOLS";
define ( "__DOCUMENT_ROOT__", $rep_document . "/php_framework" );
define ( "__DOCUMENT_DEPOT__", $rep_document . "/php_depot" );
define ( "__REP_DOCUMENT__", $rep_document );
$argc = 1;
$argv = array (
		__REP_DOCUMENT__
);
/**
 * Permet d'inclure toutes les librairies communes necessaires
 */
require_once __DOCUMENT_ROOT__ . "/config.php";
$fichier_log->setIsErrorStdout ( true );
require_once __REP_DOCUMENT__ . '/Tests_unitaire/MockedListeOptions.php';

?>
