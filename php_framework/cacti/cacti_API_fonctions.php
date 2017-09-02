<?php
//Necessite les APIs Cacti lib/api_automation_tools.php
function getHosts() {
	return array (
			"123456" => array (
					"description" => "Host1" 
			) 
	);
}
//Necessite les APIs Cacti lib/api_automation_tools.php
function getAddresses() {
	return array (
			"Addresse1" => "123456" 
	);
}

function getHostTemplates() {
	return array (
			"123456" => array (
					"template" => "Temp1" 
			) 
	);
}

function api_device_save($id, $tid, $d, $i, $c, $v, $u, $p, $po, $t, $di, $av, $pm, $pp, $pt, $pr, $no, $ap, $spp, $pro, $sco, $mo, $dt) {
	return 1234567890;
}

function import_xml_data($xml_data, $With_template_rras, $getWith_user_rras) {
	return true;
}

global $db_fetch_assoc;
function db_fetch_assoc($str) {
	if (strpos ( $str, 'graph_templates_graph' ) !== false) {
		return $GLOBALS ['db_fetch_assoc'];
	}
	return array (
			array (
					"id" => 1,
					"graph_tree_id" => 10,
					"name" => "d1" 
			),
			array (
					"id" => 2,
					"graph_tree_id" => 20,
					"name" => "d2" 
			) 
	);
}

function tree_tier($array) {
	return $array;
}

function api_device_remove($id) {
	return $id;
}

global $global_error_message;

function is_error_message() {
	return $GLOBALS ['global_error_message'];
}

global $db_fetch_cell;

function db_fetch_cell($str) {
	return $GLOBALS ['db_fetch_cell'];
}

function sql_save ( $treeOpts, $texte ){
	return 10;
}
function sort_tree ( $SORT_TYPE_TREE, $treeId, $treeOpts){
	return true;
}

function api_tree_item_save ( $id, $getTreeId, $getNodeType, $getParentNode, $getName, $getGraphId, $getRraId, $getHostId, $getHostGroupStyle, $getSortMethod, $bool ){
	return 15;
}

define ( "AVAIL_NONE", 0 );
define ( "AVAIL_SNMP_AND_PING", 1 );
define ( "AVAIL_SNMP", 2 );
define ( "AVAIL_PING", 3 );
define ( "AVAIL_SNMP_OR_PING", 4 );
define ( "AVAIL_SNMP_GET_SYSDESC", 5 );
define ( "AVAIL_SNMP_GET_NEXT", 6 );
define ( "PING_ICMP", 1 );
define ( "PING_UDP", 2 );
define ( "PING_TCP", 3 );
define ( "SORT_TYPE_TREE", 1 );

?>