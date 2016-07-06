<?php
require_once '../Model/class.MySqlManager.php';
include_once '../Vue/header.inc';


function getAnnonces($IDAnnonceur) {
	$mysql = new MySqlManager ();
	$result = $mysql->getAnnonces ( $IDAnnonceur );
	
	return $result;
}
function nombreDevisParAnnonce($IDAnnonce) {
	$mysql = new MySqlManager ();
	$result = $mysql->nombreDevisParAnnonce ( $IDAnnonce );
	
	return $result;
}
function getAnnonce($IDAnnonce) {
	$mysql = new MySqlManager ();
	$result = $mysql->getAnnonce ( $IDAnnonce );
	
	return $result;
}


function getAnnonceMarchandiseLieu($IDAnnonce) {
	$mysql = new MySqlManager ();
	$result = $mysql->getAnnonceMarchandiseLieu ( $IDAnnonce );

	return $result;
}

function getDevis($IDAnnonce) {
	$mysql = new MySqlManager ();
	$result = $mysql->getDevis ( $IDAnnonce );
	
	return $result;
}

function getUnDevis($IDDevis) {
	$mysql = new MySqlManager ();
	$result = $mysql->getUnDevis ( $IDDevis );

	return $result;
}

function getDevisValide($IDAnnonce){
	$mysql = new MySqlManager();
	$result = $mysql->getDevisValide($IDAnnonce);
	return $result;
}

function getTypeTransportFromMarchandise($IDMarchandise)  {
	$mysql = new MySqlManager ();
	$result = $mysql->getTypeTransportFromMarchandise ( $IDMarchandise );
	
	return $result;
}

function getAnnonceRealise($IDAnnonceur) {
	$mysql = new MySqlManager ();
	$result = $mysql->getAnnonceRealise ( $IDAnnonceur );

	return $result;
}

?>