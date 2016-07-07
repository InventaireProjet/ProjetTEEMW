<?php
require_once '../Model/class.MySqlManager.php';
require_once 'fonctionsGenerales.php';
require_once 'affichageTransporteur.php';
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
	$annonceur = $_SESSION ['annonceur'];
	$idAnnonceur = $annonceur->IDAnnonceur;
	$idAnnonce = $_POST ['idAnnonce'];
	$commentairePrecedent = getCommentaire ( $idAnnonce );
	
	// MEssages d'erreur
	if (empty ( $commentaire )) {
		$rank = 2;
		$msg = "Entrer un commentaire";
	}
	if (empty ( $note )) {
		$rank = 1;
		$msg = "Entrer une note";
	}
	
	// Si erreur, affichage du message d'erreur. Les données entrées sont conservées dans la variable session
	if (isset ( $rank )) {
		$_SESSION ['rank'] = $rank;
		$_SESSION ['msg'] = $msg;
		$_SESSION ['form_data'] = array (
				$note,
				$commentaire 
		);
		header ( "location:../Vue/DetailsAnnonceAnnonceurHistorique.php?id=$idAnnonce" );
		exit ();
	}
	
	if ($commentairePrecedent == null) {
		$_SESSION ['msg']= "Commentaire enregistré";
		$result = $mysql->enregistrerCommentaire ( $note, $commentaire, $idTransporteur, $idAnnonceur, $idAnnonce );
	} else {
		$_SESSION ['msg']= "Commentaire mis à jour";
		$result = $mysql->mettreajourCommentaire ( $note, $commentaire, $idTransporteur, $idAnnonceur, $idAnnonce );
	}
	header ( "location:../Vue/DetailsAnnonceAnnonceurHistorique.php?id=$idAnnonce" );
}
