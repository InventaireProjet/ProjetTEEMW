<?php
require_once '../Model/class.MySqlManager.php';
require_once 'fonctionsGenerales.php';
include_once '../Vue/header.inc';

$mysql = new MySqlManager ();

// Fonction appelée selon la valeur d'action
if (isset ( $_POST ['action'] )) {
	if ($_POST ['action'] == 'enregistrerCommentaire') {
		enregistrerCommentaire ( $mysql );
	}
}

function enregistrerCommentaire($mysql) {
	$note = $_POST ['Note'];
	$commentaire = $_POST ['Commentaire'];
	$idTransporteur = $_POST ['idTransporteur'];
	
	//MEssages d'erreur
	if (empty ($note)){
		$rank = 1;
		$msg = "Entrer une note";
	}
	if (empty ($commentaire)){
		$rank = 2;
		$msg = "Entrer un commentaire";
	}
	// Si erreur, affichage du message d'erreur. Les données entrées sont conservées dans la variable session
	if (isset ( $rank )) {
		$_SESSION ['rank'] = $rank;
		$_SESSION ['msg'] = $msg;
		$_SESSION ['form_data'] = array (
				$note,
				$commentaire
		);
		header ( "location:../Vue/DetailsAnnonceAnnonceurHistorique.php" );
		exit ();
	}
	$annonceur = $_SESSION ['annonceur'];
	$idAnnonceur = $annonceur->IDAnnonceur;
	
	$result = $mysql->enregistrerCommentaire ( $note, $commentaire, $idTransporteur, $idAnnonceur );
	header ( "location:../Vue/AccueilAnnonceur.php");
}
