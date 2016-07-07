<?php
require_once '../Model/class.MySqlManager.php';
include_once '../Vue/header.inc';

$mysql = new MySqlManager ();

if (isset ( $_POST ['action'] )) {
	if ($_POST ['action'] == 'modifierAnnonceur') {
		modifierAnnonceur ( $mysql );
	}
	
	if (isset ( $_POST ['action'] )) {
		if ($_POST ['action'] == 'modifierTransporteur') {
			modifierTransporteur ( $mysql );
		}
	}
}
function getTypeTransportTransporteur($IDTransporteur) {
	$mysql = new MySqlManager ();
	$result = $mysql->getTypeTransportTransporteur ( $IDTransporteur );
	
	return $result;
}


function modifierAnnonceur($mysql) {
	$IDAnnonceur = $_POST ['IDAnnonceur'];
	$prenom = $_POST ['Prenom'];
	$nom = $_POST ['Nom'];
	$nomUtilisateur = $_POST ['NomUtilisateur'];
	$mdp = $_POST ['MotDePasse'];
	$telephone = $_POST ['Telephone'];
	$email = $_POST ['Email'];
	$adresse = $_POST ['Adresse'];
	$npa = $_POST ['NPA'];
	$localite = $_POST ['Localite'];
	$pays = $_POST ['Pays'];
	$annonceur = $_SESSION ['annonceur'];
	
	// Messages d'erreur
	if (empty ( $pays ) || empty ( $localite ) || empty ( $npa ) || empty ( $adresse ) || empty ( $email ) || empty ( $telephone ) || empty ( $mdp ) || empty ( $nomUtilisateur ) || empty ( $nom ) || empty ( $prenom )) {
		
		$msg = "Vous ne pouvez pas laisser un champ vide";
	}
	
	// Si erreur, affichage du message d'erreur.
	if (isset ( $msg )) {
		$_SESSION ['msg'] = $msg;
		
		header ( "location:../Vue/InfosPersonnellesAnnonceur.php" );
		exit ();
	}
	
	$result = $mysql->modifierAnnonceur ( $IDAnnonceur, $prenom, $nom, $nomUtilisateur, $telephone, $email, $adresse, $npa, $localite, $pays );
	
	if ($result) {
		
		// Erreur en cas de doublon
		if ($result == 'doublon' && $nomUtilisateur != $annonceur->UserName) {
			$_SESSION ['msg'] = 'Ce nom d\'utilisateur existe déjà';
			
			header ( "location:../Vue/InfosPersonnellesAnnonceur.php" );
			exit ();
		} else {
			
			$_SESSION ['msg'] = 'Modification effectuée';
			
			$result = $mysql->VerifierLoginAnnonceur ( $nomUtilisateur, $mdp );
			$_SESSION ['annonceur'] = $result;
			
			header ( "location:../Vue/InfosPersonnellesAnnonceur.php" );
		}
	} else {
		$_SESSION ['msg'] = 'Echec de la modification';
		header ( "location:../Vue/InfosPersonnellesAnnonceur.php" );
	}
	
	exit ();
}
function modifierTransporteur($mysql) {
	$IDTransporteur = $_POST ['IDTrans'];
	$nomSociete = $_POST ['NomSociete'];
	$telephone = $_POST ['Telephone'];
	$email = $_POST ['Email'];
	$username = $_POST ['UserName'];
	$motDePasse = $_POST ['MotDePasse'];
	$adresse = $_POST ['Adresse'];
	$npa = $_POST ['NPA'];
	$localite = $_POST ['Localite'];
	$pays = $_POST ['Pays'];
	$IBAN = $_POST ['IBAN'];
	$typeTransport = $_POST ['typesTransport'];
	$transporteur = $_SESSION ['transporteur'];
	
	
	// Messages d'erreur
	if (empty ( $typeTransport ) || empty ( $IBAN ) || empty ( $pays ) || empty ( $localite ) || empty ( $npa ) || empty ( $adresse ) || empty ( $motDePasse ) | empty ( $username ) || empty ( $email ) || empty ( $telephone ) || empty ( $nomSociete )) {
	
		$msg = "Vous ne pouvez pas laisser un champ vide";
	}
	
	// Si erreur, affichage du message d'erreur.
	if (isset ( $msg )) {
		$_SESSION ['msg'] = $msg;
	
		header ( "location:../Vue/InfosPersonnellesTransporteur.php" );
		exit ();
	}
	
	$result = $mysql->modifierTransporteur ($IDTransporteur, $nomSociete, $telephone, $email, $username, $motDePasse, $adresse,$npa, $localite, $pays, $IBAN, $typeTransport);
	
	if ($result) {
	
		// Erreur en cas de doublon
		if ($result == 'doublon' && $username != $transporteur->UserName) {
			$_SESSION ['msg'] = 'Ce nom d\'utilisateur existe déjà';
				
			header ( "location:../Vue/InfosPersonnellesTransporteur.php" );
			exit ();
		} else {
				
			$_SESSION ['msg'] = 'Modification effectuée';
				
			$result = $mysql->VerifierLoginTransporteur ( $username, $motDePasse );
			$_SESSION ['transporteur'] = $result;
				
			header ( "location:../Vue/InfosPersonnellesTransporteur.php" );
		}
	} else {
		$_SESSION ['msg'] = 'Echec de la modification';
		header ( "location:../Vue/InfosPersonnellesTransporteur.php" );
	}
	
	exit ();
}

?>