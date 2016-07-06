<?php
require_once '../Model/class.MySqlManager.php';
include_once '../Vue/header.inc';

$mysql = new MySqlManager ();

if (isset ( $_POST ['action'] )) {
	if ($_POST ['action'] == 'modifierAnnonceur') {
		modifierAnnonceur ( $mysql );
	}
}
function getInfoPersoAnnonceur($IDAnnonceur) {
	$mysql = new MySqlManager ();
	$result = $mysql->getInfoPersoAnnonceur ( $IDAnnonceur );
	
	return $result;
}
function getInfoPersoTransporteur($IDTransporteur) {
	$mysql = new MySqlManager ();
	$result = $mysql->getInfoPersoTransporteur ( $IDTransporteur );
	
	return $result;
}
function modifierAnnonceur($mysql) {
	$IDAnnonceur = $_POST ['IDAnnonceur'];
	$prenom = $_POST ['Prenom'];
	$nom = $_POST ['Nom'];
	$nomUtilisateur = $_POST ['NomUtilisateur'];
	// $mdp = $_POST ['Mdp'];
	$telephone = $_POST ['Telephone'];
	$email = $_POST ['Email'];
	$adresse = $_POST ['Adresse'];
	$npa = $_POST ['NPA'];
	$localite = $_POST ['Localite'];
	$pays = $_POST ['Pays'];
	
	$result = $mysql->modifierAnnonceur ( $IDAnnonceur, $prenom, $nom, $nomUtilisateur, $telephone, $email, $adresse, $npa, $localite, $pays );
	
	if ($result) {
		
		$_SESSION ['msg'] = 'Modification effectuée';
		
		$annonceur= $_SESSION ['annonceur'];
		$annonceur->Nom = $nom;
		$annonceur->Prenom = $prenom;
		
		header ( "location:../Vue/InfosPersonnellesAnnonceur.php" );
	} else {
		$_SESSION ['msg'] = 'Echec de la modification';
		header ( "location:../Vue/InfosPersonnellesAnnonceur.php" );
	}
	
	exit ();
}

?>