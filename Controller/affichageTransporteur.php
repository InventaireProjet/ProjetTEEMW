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
		header ( "location:../../Vue/AccueilTransporteur.php" );
	} else {
		$_SESSION ['msg'] = 'Echec de la validation du devis';
		header ( "location:../../Vue/DetailsAnnonceTransporteur.php?id=$idAnnonce&a=$typeAffichage" );
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
function getCommentaire  ($IDAnnonce){
	$mysql = new MySqlManager();
	$result = $mysql->GetCommentaire ( $IDAnnonce);
	
	return $result;
}

//Transmet les annonces correspondant aux types de transport après avoir ignoré 
//les annonces pour lesquelles l'annonceur a déjà soumissionné
function getSelectionAnnonces($IDTransporteur) {
	$mysql = new MySqlManager ();
	$annonces = $mysql->getSelectionAnnonces ( $IDTransporteur );
	$annoncesAvecDevis = getAnnoncesPossibles ( $IDTransporteur );
	$annonceAAfficher=array();
	foreach ( $annonces as $annonce ) {
		if (testAnnoncesIdentiques($annonce['IDAnnonce'], $annoncesAvecDevis)==false) {
			
			$annonceAAfficher[] = $annonce;
		}
		
	}
	
	return $annonceAAfficher;
}

//Si l'annonce est présente dans le tableau, retourne true
function testAnnoncesIdentiques($IDAnnonce, $tableauAnnonces) {
	
	foreach ( $tableauAnnonces as $annonce ) {
		if ($annonce['IDAnnonce']==$IDAnnonce){
				return true;
		}
	}
	return false;
}

function getTransportsEffectue($IDTransporteur) {
	$mysql = new MySqlManager ();
	$result = $mysql->getTransportsEffectue ( $IDTransporteur );
	
	return $result;
}

?>