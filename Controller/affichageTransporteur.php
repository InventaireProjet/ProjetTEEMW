<?php
require_once '../Model/class.MySqlManager.php';
include_once '../Vue/header.inc';

$mysql = new MySqlManager ();
// Fonction appelée selon la valeur d'action
if (isset ( $_POST ['action'] )) {
	
	
	if ($_POST ['action'] == 'Archiver') {
		archiverAnnonce ( $mysql );
	}
}



function archiverAnnonce($mysql) {
	$idAnnonce = $_POST ['idAnnonce'];
	$typeAffichage = $_POST ['typeAffichage'];
	$resultat = $mysql->archiverAnnonce ( $idAnnonce );
	
	if ($resultat) {
		$_SESSION ['msg'] = 'Archivage effectué';
		header ( "location:/ProjetTEEMW/Vue/AccueilTransporteur.php" );
	} else {
		$_SESSION ['msg'] = 'Echec de la validation du devis';
		header ( "location:/ProjetTEEMW/Vue/DetailsAnnonceTransporteur.php?id=$idAnnonce&a=$typeAffichage" );
	}
	exit ();
}
function getTransportsAEffectuer($IDTransporteur) {
	$mysql = new MySqlManager ();
	$result = $mysql->getTransportsAEffectuer ( $IDTransporteur );
	
	return $result;
}
function getAnnoncesPossibles($IDTransporteur) {
	$mysql = new MySqlManager ();
	$result = $mysql->getAnnoncesPossibles ( $IDTransporteur );
	
	return $result;
}
function getDevisTransporteurAnnonce($IDTransporteur, $IDAnnonce) {
	$mysql = new MySqlManager ();
	$result = $mysql->getDevisTransporteurAnnonce ( $IDTransporteur, $IDAnnonce );
	
	return $result;
}
function getAnnonceurDevis($IDDevis) {
	$mysql = new MySqlManager ();
	$result = $mysql->getAnnonceurDevis ( $IDDevis );
	
	return $result;
}
function getLieu($IDLieu) {
	$mysql = new MySqlManager ();
	$result = $mysql->getLieu ( $IDLieu );
	
	return $result;
}

function getSelectionAnnonces( $idTransporteur ) {
	$mysql = new MySqlManager ();
	$result = $mysql->getSelectionAnnonces ( $idTransporteur );

	return $result;
}

function getTransportsEffectue ( $IDTransporteur )
{
	$mysql = new MySqlManager ();
	$result = $mysql->getTransportsEffectue ( $IDTransporteur );
	
	return $result;
	}

?>