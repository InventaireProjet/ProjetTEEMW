<?php
require_once '../Model/class.MySqlManager.php';
include_once '../Vue/header.inc';


function getInfoPersoAnnonceur($IDAnnonceur) {
	$mysql = new MySqlManager ();
	$result = $mysql->getInfoPersoAnnonceur ( $IDAnnonceur );

	return $result;
}

function getInfoPersoTransporteur($IDTransporteur) {
	$mysql = new MySqlManager ();
	$result = $mysql->getInfoPersoTransporteur($IDTransporteur);

	return $result;
}

?>