<?php
require_once '../Model/class.MySqlManager.php';
include_once '../Vue/header.inc';

$mysql = new MySqlManager ();

// Fonction à appeler selon la valeur d'action
if (isset ( $_POST ['action'] )) {
	if ($_POST ['action'] == 'enregistrerAnnonceur') {
		enregistrerAnnonceur ( $mysql );
	}
	if (isset ( $_POST ['action'] )) {
		if ($_POST ['action'] == 'enregistrerTransporteur') {
			enregistrerTransporteur ( $mysql );
		}
	}
	
	if ($_POST ['action'] == 'connecterAnnonceur') {
		identifierAnnonceur ( $mysql );
	}
	if ($_POST ['action'] == 'connecterTransporteur') {
		identifierTransporteur ( $mysql );
	}
}
if (isset ( $_GET ['action'] )) {
	if ($_GET ['action'] == 'logout') {
		logout ();
	}
}

// Vérification du login annonceur
function identifierAnnonceur($mysql) {
	$NomUtilisateur = $_POST ['NomUtilisateur'];
	$Mdp = $_POST ['MotDePasse'];
	$result = $mysql->VerifierLoginAnnonceur ( $NomUtilisateur, $Mdp );
	
	// Si échec, message d'erreur
	if (! $result) {
		$_SESSION ['form_data'] = array (
				$NomUtilisateur,
				$Mdp 
		);
		$_SESSION ['msgA'] = 'Nom d\'utilisateur ou mot de passe incorrect';
		header ( "location:../Vue/index.php" );
		exit ();
	}
	$_SESSION ['msg'] = 'Bienvenue ' . $result->Prenom . ' ' . $result->Nom;
	$_SESSION ['annonceur'] = $result;
	header ( "location:../Vue/AccueilAnnonceur.php" );
	exit ();
}

// Vérification du login transporteur
function identifierTransporteur($mysql) {
	$NomUtilisateur = $_POST ['NomUtilisateur'];
	$Mdp = $_POST ['MotDePasse'];
	$result = $mysql->VerifierLoginTransporteur ( $NomUtilisateur, $Mdp );
	
	// Si échec, message d'erreur
	if (! $result) {
		$_SESSION ['form_data'] = array (
				$NomUtilisateur,
				$Mdp 
		);
		$_SESSION ['msgT'] = 'Nom d\'utilisateur ou mot de passe incorrect';
		header ( "location:../Vue/index.php" );
		exit ();
	}
	$_SESSION ['msg'] = 'Bienvenue ' . $result->NomSociete;
	$_SESSION ['transporteur'] = $result;
	header ( "location:../Vue/AccueilTransporteur.php" );
	exit ();
}

// Fonction de logout éliminant toutes les valeurs de session stockées
function logout() {
	session_destroy ();
	header ( "location:../Vue/index.php" );
	exit ();
}
function enregistrerAnnonceur($mysql) {
	$Prenom = $_POST ['Prenom'];
	$Nom = $_POST ['Nom'];
	$NomUtilisateur = $_POST ['NomUtilisateur'];
	$Mdp = $_POST ['Mdp'];
	$Telephone = $_POST ['Telephone'];
	$Email = $_POST ['Email'];
	$Adresse = $_POST ['Adresse'];
	
	// Messages d'erreur
	if (empty ( $Adresse )) {
		$rank = 7;
		$msg = "Inscrivez une adresse";
	}
	if (empty ( $Email )) {
		$rank = 6;
		$msg = "Inscrivez un email";
	}
	if (empty ( $Telephone )) {
		$rank = 5;
		$msg = "Inscrivez un numéro de téléphone";
	}
	if (empty ( $Mdp )) {
		$rank = 4;
		$msg = "Inscrivez un mot de passe";
	}
	
	if (empty ( $NomUtilisateur )) {
		$rank = 3;
		$msg = "Inscrivez un nom d'utilisateur";
	}
	
	if (empty ( $Nom )) {
		$rank = 2;
		$msg = "Inscrivez un nom";
	}
	
	if (empty ( $Prenom )) {
		$rank = 1;
		$msg = "Inscrivez un prénom";
	}
	// Si erreur, affichage du message d'erreur. Les données entrées sont conservées dans la variable session
	if (isset ( $rank )) {
		$_SESSION ['rank'] = $rank;
		$_SESSION ['msg'] = $msg;
		$_SESSION ['form_data'] = array (
				$Prenom,
				$Nom,
				$NomUtilisateur,
				$Mdp,
				$Telephone,
				$Email,
				$Adresse 
		);
		header ( "location:../Vue/InscriptionAnnonceur.php" );
		exit ();
	}
	
	$result = $mysql->enregistrerAnnonceur ( $Prenom, $Nom, $NomUtilisateur, $Mdp, $Telephone, $Email, $Adresse );
	
	// Erreur en cas de doublon
	if ($result == 'doublon') {
		$_SESSION ['rank'] = 3;
		$_SESSION ['msg'] = 'Le nom d\'utilisateur existe déjà';
		$_SESSION ['form_data'] = array (
				$Prenom,
				$Nom,
				$NomUtilisateur,
				$Mdp,
				$Telephone,
				$Email,
				$Adresse 
		);
		header ( "location:../Vue/InscriptionAnnonceur.php" );
		exit ();
	} else {
		
		$_SESSION ['msg'] = 'Inscription effectuée';
		
		$result = $mysql->VerifierLoginAnnonceur ( $NomUtilisateur, $Mdp );
		$_SESSION ['annonceur'] = $result;
	}
	
	header ( "location:../Vue/AccueilAnnonceur.php" );
	exit ();
}
function enregistrerTransporteur($mysql) {
	$nomSociete = $_POST ['NomSociete'];
	$telephone = $_POST ['Telephone'];
	$email = $_POST ['Email'];
	$username = $_POST ['Utilisateur'];
	$motDePasse = $_POST ['MotDePasse'];
	$adresse = $_POST ['Adresse'];
	$npa = $_POST ['NPA'];
	$localite = $_POST ['Localite'];
	$pays = $_POST ['Pays'];
	$IBAN = $_POST ['IBAN'];
	$typesTransport = array ();
	// Gestion d'un problème d'undefined
	if (empty ( $_POST ['typesTransport'] )) {
		$typesTransport = null;
	} else {
		$typesTransport = $_POST ['typesTransport'];
	}
	
	// Messages d'erreur
	if (empty ( $typesTransport )) {
		$rank = 11;
		$msg = "Choisissez au moins un type de transport";
	} else {
		$typesTransport = $_POST ['typesTransport'];
	}
	
	if (empty ( $IBAN )) {
		$rank = 10;
		$msg = "Inscrivez un IBAN";
	}
	if (empty ( $pays )) {
		$rank = 9;
		$msg = "Entrer un payse";
	}
	
	if (empty ( $localite )) {
		$rank = 8;
		$msg = "Entrer une localité";
	}
	
	if (empty ( $npa )) {
		$rank = 7;
		$msg = "Entrer un NPA";
	}
	if (empty ( $adresse )) {
		$rank = 6;
		$msg = "Indiquez une adresse";
	}
	if (empty ( $motDePasse )) {
		$rank = 5;
		$msg = "Indiquez un mot de passe";
	}
	if (empty ( $username )) {
		$rank = 4;
		$msg = "Indiquez un nom d'utilisateur";
	}
	
	if (empty ( $email )) {
		$rank = 3;
		$msg = "Indiquez un email";
	}
	
	if (empty ( $telephone )) {
		$rank = 2;
		$msg = "Indiquez un numéro de téléphone";
	}
	
	if (empty ( $nomSociete )) {
		$rank = 1;
		$msg = "Indiquez un nom de société";
	}
	
	// Si erreur, affichage du message d'erreur. Les données entrées sont conservées dans la variable session
	if (isset ( $rank )) {
		$_SESSION ['rank'] = $rank;
		$_SESSION ['msg'] = $msg;
		$_SESSION ['form_data'] = array (
				$nomSociete,
				$telephone,
				$email,
				$username,
				$motDePasse,
				$adresse,
				$npa,
				$localite,
				$pays,
				$IBAN,
				$typesTransport 
		);
		header ( "location:../Vue/InscriptionTransporteur.php" );
		exit ();
	}
	
	$result = $mysql->enregistrerTransporteur ( $nomSociete, $telephone, $email, $username, $motDePasse, $adresse,$npa, $localite, $pays, $IBAN );
	
	// Erreur en cas de doublon
	if ($result == 'doublon') {
		$_SESSION ['rank'] = 4;
		$_SESSION ['msg'] = 'Le nom d\'utilisateur existe déjà';
		$_SESSION ['form_data'] = array (
				$nomSociete,
				$telephone,
				$email,
				$username,
				$motDePasse,
				$adresse,
				$npa,
				$localite,
				$pays,
				$IBAN,
				$typesTransport 
		);
		header ( "location:../Vue/InscriptionTransporteur.php" );
		exit ();
	} else {
		
		$_SESSION ['msg'] = 'Inscription effectuée';
		
		$result = $mysql->VerifierLoginTransporteur ( $username, $motDePasse );
		enregistrerTypesTransportTransporteur ( $mysql, $typesTransport, $result->IDTransporteur );
		
		$_SESSION ['transporteur'] = $result;
		
		header ( "location:../Vue/AccueilTransporteur.php" );
		exit ();
	}
}
function enregistrerTypesTransportTransporteur($mysql, $typesTransport, $idTransporteur) {
	foreach ( $typesTransport as $typeTransport ) {
		$result = $mysql->enregistrerTypesTransportTransporteur ( $typeTransport, $idTransporteur );
	}
}
