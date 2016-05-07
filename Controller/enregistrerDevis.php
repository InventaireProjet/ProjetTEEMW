<?php
require_once '../Model/class.MySqlManager.php';
require_once 'fonctionsGenerales.php';
include_once '../Vue/header.inc';

$mysql = new MySqlManager ();

if (isset ( $_POST ['action'] )) {
	if ($_POST ['action'] == 'Entrer les données pour un devis') {
		enregistrerNewDevis ( $mysql );
	}
}
function enregistrerNewDevis($mysql) {
	$prix = $_POST ['Prix'];
	$dateExpiration = $_POST ['DateExpiration'];
	$description = $_POST ['Description'];
	
	if (empty ( $description )) {
		$rank = 3;
		$msg = "Entrer une description de l'offre proposé dans ce devis";
	}
	
	if (verificationDate ( $dateExpiration ) == false) {
		$rank = 2;
		$msg = "Entrer une date d'expiration valide";
	}
	
	if (empty ( $dateExpiration )) {
		$rank = 2;
		$msg = "Entrer une date d'expiration";
	}
	
	if (empty ( $prix )) {
		$rank = 1;
		$msg = "Entrer un prix";
	}
	
	if (isset ( $rank )) {
		$_SESSION ['rank'] = $rank;
		$_SESSION ['msg'] = $msg;
		$_SESSION ['formNouvDevis_data'] = array (
				$prix,
				$dateExpiration,
				$description 
		)
		;
		header ( "location:../Vue/ValidationDevis.php" );
		exit ();
	}
	
	$_SESSION ['formNouvDevis_data'] = array (
			$prix,
			$dateExpiration,
			$description 
			
	)
	;

// 	$transporteur = $_SESSION ['user'];
// 	$idTransporteur = $transporteur->IDTransporteur;

	// pour test, fait avec annonceur
	$annonceur = $_SESSION ['user'];
	$idAnnonceur = $annonceur->IDAnnonceur;
	echo "je suis dans enregistrerDevis";
	echo $annonceur;
	echo $idAnnonceur;
	
	$mysql->enregistrerNewDevis( $nom, $datedep, $adressedep, $annonceur );
	$_SESSION ['msg'] = 'Nouveau devis enregistré';
	header ( "location:../Vue/AccueilTransporteur.php" );
	exit ();
}





