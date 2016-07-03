<?php
require_once '../Model/class.MySqlManager.php';
include_once '../Vue/header.inc';


function getTransportsAEffectuer($IDTransporteur){
	$mysql = new MySqlManager ();
	$result = $mysql->getTransportsAEffectuer ( $IDTransporteur );

	return $result;
}

function getAnnoncesPossibles($IDTransporteur){
	$mysql = new MySqlManager ();
	$result = $mysql->getAnnoncesPossibles ( $IDTransporteur );

	return $result;
}

?>