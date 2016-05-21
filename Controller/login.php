<?php
require_once '../Model/class.MySqlManager.php';
include_once '../Vue/header.inc';

$mysql = new MySqlManager ();

if (isset ( $_POST ['action'] )) {
	if ($_POST ['action'] == 'enregistrerAnnonceur') {
		enregistrerAnnonceur ( $mysql );
	}
if (isset ( $_POST ['action'] )) {
	if ($_POST ['action'] == 'enregistrerTransporteur') {
		enregistrerTransporteur ( $mysql);
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
function identifierAnnonceur($mysql) {
	$NomUtilisateur = $_POST ['NomUtilisateur'];
	$Mdp = $_POST ['MotDePasse'];
	$result = $mysql->VerifierLoginAnnonceur ( $NomUtilisateur, $Mdp );
	if (! $result) {
		$_SESSION ['form_data'] = array (
				$NomUtilisateur,
				$Mdp 
		);
		$_SESSION ['msg'] = 'Nom d utilisateur ou mot de passe incorrect';
		header ( "location:../Vue/Index.php" );
		exit ();
	}
	$_SESSION ['msg'] = 'Bienvenue ' . $result->Prenom . ' ' . $result->Nom;
	$_SESSION ['annonceur'] = $result;
	header ( "location:../Vue/NouvelleAnnonceTypeTransport.php" );
	exit ();
}
function identifierTransporteur($mysql) {
	$NomUtilisateur = $_POST ['NomUtilisateur'];
	$Mdp = $_POST ['MotDePasse'];
	$result = $mysql->VerifierLoginTransporteur ( $NomUtilisateur, $Mdp );
	if (! $result) {
		$_SESSION ['form_data'] = array (
				$NomUtilisateur,
				$Mdp
		);
		$_SESSION ['msg'] = 'Nom d utilisateur ou mot de passe incorrect';
		header ( "location:../Vue/Index.php" );
		exit ();
	}
	$_SESSION ['msg'] = 'Bienvenue ' . $result->NomSociete;
	$_SESSION ['transporteur'] = $result;
	header ( "location:../Vue/ValidationDevis.php" );
	exit ();
}
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
	$IBAN = $_POST ['IBAN'];
	
	if (empty ( $IBAN )) {
		$rank = 7;
		$msg = "Inscrivez un IBAN";
	}
	if (empty ( $Adresse )) {
		$rank = 6;
		$msg = "Inscrivez une adresse";
	}
	if (empty ( $Email )) {
		$rank = 5;
		$msg = "Inscrivez un email";
	}
	if (empty ( $Telephone )) {
		$rank = 4;
		$msg = "Inscrivez un numéro de téléphone";
	}
	if (empty ( $Mdp )) {
		$rank = 3;
		$msg = "Inscrivez un mot de passe";
	}
	
	if (empty ( $NomUtilisateur )) {
		$rank = 2;
		$msg = "Inscrivez un nom d'utilisateur";
	}
	
	if (empty ( $Nom )) {
		$rank = 1;
		$msg = "Inscrivez un nom";
	}
	
	if (empty ( $Prenom )) {
		$rank = 0;
		$msg = "Inscrivez un prénom";
	}
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
				$Adresse,
				$IBAN
		);
		header ( "location:../Vue/InscriptionAnnonceur.php" );
		exit ();
	}
	
	$result = $mysql->enregistrerAnnonceur ( $Prenom, $Nom, $NomUtilisateur, $Mdp, $Telephone, $Email, $Adresse, $IBAN );
	if ($result == 'doublon') {
		$_SESSION ['rank'] = 3;
		$_SESSION ['msg'] = 'Le nom d utilisateur existe déjà';
		$_SESSION ['form_data'] = array (
				$Prenom,
				$Nom,
				$NomUtilisateur,
				$Mdp,
				$Telephone,
				$Email,
				$Adresse,
				$IBAN
		);
	} else {
		$_SESSION ['rank'] = 'top';
		$_SESSION ['msg'] = 'Inscription effectuée';

		$result = $mysql->VerifierLoginAnnonceur ( $NomUtilisateur, $Mdp );
		$_SESSION ['annonceur'] =$result;
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
	
	if (empty ( $adresse )) {
		$rank = 5;
		$msg = "Indiquez une adresse";
	}
	if (empty ( $motDePasse )) {
		$rank = 4;
		$msg = "Indiquez un mot de passe";
	}
	if (empty ( $username )) {
		$rank = 3;
		$msg = "Indiquez un nom d'utilisateur";
	}

	if (empty ( $email )) {
		$rank = 2;
		$msg = "Indiquez un email";
	}

	if (empty ( $telephone )) {
		$rank = 1;
		$msg = "Indiquez un numéro de téléphone";
	}

	if (empty ( $nomSociete )) {
		$rank = 0;
		$msg = "Indiquez un nom de société";
	}
	if (isset ( $rank )) {
		$_SESSION ['rank'] = $rank;
		$_SESSION ['msg'] = $msg;
		$_SESSION ['form_data'] = array (
				$nomSociete,
				$telephone,
				$email,
				$username,
				$motDePasse,
				$adresse
				
		);
		header ( "location:../Vue/InscriptionTransporteur.php" );
		exit ();
	}

	$result = $mysql->enregistrerTransporteur ( $nomSociete, $telephone, $email, $username, $motDePasse, $adresse);
	if ($result == 'doublon') {
		$_SESSION ['rank'] = 3;
		$_SESSION ['msg'] = 'Le nom d utilisateur existe déjà';
		$_SESSION ['form_data'] = array (
				$nomSociete,
				$telephone,
				$email,
				$username,
				$motDePasse,
				$adresse
				
		);
	} else {
		$_SESSION ['rank'] = 'top';
		$_SESSION ['msg'] = 'Inscription effectuée';

		$result = $mysql->VerifierLoginTransporteur ( $username, $motDePasse );
		$_SESSION ['transporteur'] =$result;
	}

	header ( "location:../Vue/AccueilTransporteur.php" );
	exit ();
}

include_once '../Vue/footer.inc';
