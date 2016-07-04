<?php
include_once '../Vue/header.inc';

$mysql = new MySqlManager ();

// Fonction appelée selon la valeur d'action
if (isset ( $_POST ['action'] )) {
	
	if ($_POST ['action'] == 'Valider ce devis') {
		validerDevis ( $mysql );
	}
	
	
}
function validerDevis($mysql) {
	$idDevis = $_POST ['idDevis'];
	$noDevis = $_POST ['noDevis'];
	$idAnnonce= $_POST['idAnnonce'];
	$resultat = $mysql->validerDevis ( $idDevis, $idAnnonce );
	
	if ($resultat) {
		header ( "location:/ProjetTEEMW/Vue/ConfirmationDevis.php?devis=$idDevis&i=$noDevis" );
	} else {
		$_SESSION ['msg'] = 'Echec de validation du devis';
		header ( "location:/ProjetTEEMW/Vue/DetailsDevis.php?devis=$idDevis&i=$noDevis" );
	}
	exit ();
}

function getTransporteur($IDDevis) {
	$mysql = new MySqlManager ();
	$result = $mysql->getTransporteur ( $IDDevis );
	
	return $result;
}

