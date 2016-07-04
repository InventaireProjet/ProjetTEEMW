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
	
	//MEssages d'erreur
	if (empty ($note)){
		$rank = 1;
		$msg = "Entrer une note";
	}
	if (empty ($commentaire)){
		$rank = 2;
		$msg = "Entrer un commentaire";
	}
}
