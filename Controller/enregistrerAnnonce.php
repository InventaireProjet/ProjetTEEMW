<?php
require_once '../Model/class.MySqlManager.php';
include_once '../Vue/header.inc';

$mysql = new MySqlManager ();

if (isset ( $_POST ['action'] )) {
	if ($_POST ['action'] == 'Entrer les données sur le transport') {
		enregistrerTypeTransport ( $mysql );
	}
	
	if ($_POST ['action'] == 'Valider l\'annonce') {
		enregistrerAnnonce ( $mysql );
	}
}
function enregistrerTypeTransport($mysql) {
	$nom = $_POST ['Nom'];
	$datedep = $_POST ['DateDepart'];
	$datearr = $_POST ['DateArrivee'];
	$adressedep = $_POST ['AdresseDepart'];
	$adressearr = $_POST ['AdresseArrivee'];
	
	if (empty ( $adressearr )) {
		$rank = 5;
		$msg = "Entrer une adresse d'arrivée";
	}
	if (empty ( $adressedep )) {
		$rank = 4;
		$msg = "Entrer une adresse de départ";
	}
	if (empty ( $datearr )) {
		$rank = 3;
		$msg = "Entrer une date d'arrivée";
	}
	
	if (empty ( $datedep )) {
		$rank = 2;
		$msg = "Entrer une date de départ";
	}
	
	if (empty ( $nom )) {
		$rank = 1;
		$msg = "Entrer un nom";
	}
	
	if (isset ( $rank )) {
		$_SESSION ['rank'] = $rank;
		$_SESSION ['msg'] = $msg;
		$_SESSION ['formNouvTransport_data'] = array (
				$nom,
				$datedep,
				$datearr,
				$adressedep,
				$adressearr 
		);
		header ( "location:../Vue/NouvelleAnnonceTypeTransport.php" );
		exit ();
	}
	
	$_SESSION ['formNouvTransport_data'] = array (
			$nom,
			$datedep,
			$datearr,
			$adressedep,
			$adressearr 
	);
	header ( "location:../Vue/NouvelleAnnonceTypeMarchandise.php" );
	exit ();
}
function enregistrerAnnonce($mysql) {
	$desc = $_POST ['Description'];
	$qte = $_POST ['Quantite'];
	$vol = $_POST ['Volume'];
	$poids = $_POST ['Poids'];
	
	if (empty ( $poids )) {
		$rank = 4;
		$msg = "Entrer un poids";
	}
	if (empty ( $vol )) {
		$rank = 3;
		$msg = "Entrer un volume";
	}
	if (empty ( $qte )) {
		$rank = 2;
		$msg = "Entrer une quantité";
	}
	if (empty ( $desc )) {
		$rank = 1;
		$msg = "Entrer une description ";
	}
	
	if (isset ( $rank )) {
		$_SESSION ['rank'] = $rank;
		$_SESSION ['msg'] = $msg;
		$_SESSION ['formNouvMarchandise_data'] = array (
				$desc,
				$qte,
				$vol,
				$poids 
		);
		header ( "location:../Vue/NouvelleAnnonceTypeMarchandise.php" );
		exit ();
	}
	
	$_SESSION ['formNouvMarchandise_data'] = array (
			$desc,
			$qte,
			$vol,
			$poids 
	);
	
	$form_data = isset ( $_SESSION ['formNouvTransport_data'] ) ? $_SESSION ['formNouvTransport_data'] : array (
			'',
			'',
			'',
			'',
			'' 
	);
	
	$nom = $form_data [0];
	$datedep = $form_data [1];
	$datearr= $form_data [2];
	$adressedep= $form_data [3];
	$adressearr= $form_data [4];
	
	$mysql->enregistrerAnnonce ( $nom, $datedep, $datearr, $adressedep, $adressearr, $desc, $qte, $vol, $poids );
	$_SESSION ['msg'] = 'Nouvelle annonce enregistrée';
	header ( "location:../Vue/AccueilAnnonceur.php" );
	exit ();
}

