<?php
require_once '../Model/class.MySqlManager.php';
require_once 'fonctionsGenerales.php';
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
	$npadep = $_POST ['NPADepart'];
	$localdep = $_POST ['LocaliteDepart'];
	$paysdep = $_POST ['PaysDepart'];
	$adressearr = $_POST ['AdresseArrivee'];
	$npaarr = $_POST ['NPAArrivee'];
	$localarr = $_POST ['LocaliteArrivee'];
	$paysarr = $_POST ['PaysArrivee'];
	$heuredep = $_POST ['HeureDepart'];
	$minutesdep = $_POST ['MinutesDepart'];
	$heurearr = $_POST ['HeureArrivee'];
	$minutesarr = $_POST ['MinutesArrivee'];
	
	if (empty ( $paysarr )) {
		$rank = 11;
		$msg = "Entrer un pays d'arrivée";
	}
	
	if (empty ( $localarr )) {
		$rank = 10;
		$msg = "Entrer une localité d'arrivée";
	}
	
	if (empty ( $npaarr )) {
		$rank = 9;
		$msg = "Entrer un NPA d'arrivée";
	}
	
	if (empty ( $adressearr )) {
		$rank = 8;
		$msg = "Entrer une adresse d'arrivée";
	}
	
	if (comparaisonDates ( $datedep, $heuredep, $minutesdep, $datearr, $heurearr, $minutesarr ) == false) {
		
		$rank = 7;
		$msg = "Entrer une date d'arrivée postérieure à la date de départ";
	}
	
	if (verificationDate ( $datearr ) == false) {
		
		$rank = 7;
		$msg = "Entrer une date d'arrivée valide";
	}
	
	if (empty ( $paysdep )) {
		$rank = 6;
		$msg = "Entrer un pays de départ";
	}
	
	if (empty ( $localdep )) {
		$rank = 5;
		$msg = "Entrer une localité de départ";
	}
	
	if (empty ( $npadep )) {
		$rank = 4;
		$msg = "Entrer un NPA de départ";
	}
	
	if (empty ( $adressedep )) {
		$rank = 3;
		$msg = "Entrer une adresse de départ";
	}
	
	if (verificationDate ( $datedep ) == false) {
		
		$rank = 2;
		$msg = "Entrer une date de départ valide";
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
				$adressedep,
				$npadep,
				$localdep,
				$paysdep,
				$datearr,
				$adressearr,
				$npaarr,
				$localarr,
				$paysarr,
				$heuredep,
				$minutesdep ,
				$heurearr ,
				$minutesarr
		);
		header ( "location:../Vue/NouvelleAnnonceTypeTransport.php" );
		exit ();
	}
	
	$_SESSION ['formNouvTransport_data'] = array (
			$nom,
			$datedep,
			$adressedep,
			$npadep,
			$localdep,
			$paysdep,
			$datearr,
			$adressearr,
			$npaarr,
			$localarr,
			$paysarr ,
			$heuredep,
			$minutesdep ,
			$heurearr ,
			$minutesarr
	);
	header ( "location:../Vue/NouvelleAnnonceTypeMarchandise.php" );
	exit ();
}
function enregistrerAnnonce($mysql) {
	$type = $_POST ['Type'];
	$desc = $_POST ['Description'];
	$qte = $_POST ['Quantite'];
	$vol = $_POST ['Volume'];
	$poids = $_POST ['Poids'];
	
	if (empty ( $poids )) {
		$rank = 5;
		$msg = "Entrer un poids";
	}
	if (empty ( $vol )) {
		$rank = 4;
		$msg = "Entrer un volume";
	}
	if (empty ( $qte )) {
		$rank = 3;
		$msg = "Entrer une quantité";
	}
	if (empty ( $desc )) {
		$rank = 2;
		$msg = "Entrer une description ";
	}
	
	if (empty ( $type )) {
		$rank = 1;
		$msg = "Entrer un type de transport";
	}
	
	if (isset ( $rank )) {
		$_SESSION ['rank'] = $rank;
		$_SESSION ['msg'] = $msg;
		$_SESSION ['formNouvMarchandise_data'] = array (
				$type,
				$desc,
				$qte,
				$vol,
				$poids 
		);
		header ( "location:../Vue/NouvelleAnnonceTypeMarchandise.php" );
		exit ();
	}
	
	$_SESSION ['formNouvMarchandise_data'] = array (
			$type,
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
			'',
			'',
			'',
			'',
			'',
			'',
			'' 
	);
	
	// Récupération des données provenant du premier formulaire
	$nom = $form_data [0];
	$datedep = $form_data [1];
	$adressedep = $form_data [2];
	$npadep = $form_data [3];
	$localdep = $form_data [4];
	$paysdep = $form_data [5];
	$datearr = $form_data [6];
	$adressearr = $form_data [7];
	$npaarr = $form_data [8];
	$localarr = $form_data [9];
	$paysarr = $form_data [10];
	$heuredep= $form_data [11];
	$minutesdep = $form_data [12];
	$heurearr = $form_data [13];
	$minutesarr= $form_data [14];
	
	// Récupération de l'ID de l'annonceur par la variable de session
	$annonceur = $_SESSION ['user'];
	$idAnnonceur = $annonceur->IDAnnonceur;
	
	//Conversion des dates en format TimeStamp
	$dateSQLdep= dateSQL($datedep, $heuredep, $minutesdep);
	$dateSQLarr= dateSQL($datearr, $heurearr, $minutesarr);
	
	
	$resultat = $mysql->enregistrerAnnonce ( $nom, $dateSQLdep, $adressedep, $npadep, $localdep, $paysdep, $dateSQLarr, $adressearr, $npaarr, $localarr, $paysarr, $type, $desc, $qte, $vol, $poids, $idAnnonceur );
	
	if ($resultat == true) {
		$_SESSION ['msg'] = 'Nouvelle annonce enregistrée';
		header ( "location:../Vue/AccueilAnnonceur.php" );
	} 

	else {
		$_SESSION ['msg'] = 'Echec de l\'enregistrement de l\'annonce';
		
		header ( "location:../Vue/NouvelleAnnonceTypeMarchandise.php" );
	}
	exit ();
}





