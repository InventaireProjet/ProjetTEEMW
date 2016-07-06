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
	$Prenom = $_POST ['Prenom'];
	$Nom = $_POST ['Nom'];	
	$NomUtilisateur = $_POST ['NomUtilisateur'];
	//$Mdp = $_POST ['Mdp'];
	$Telephone = $_POST ['Telephone'];
	$Email = $_POST ['Email'];
	$Adresse = $_POST ['Adresse'];
	$npa = $_POST ['NPA'];
	$localite = $_POST ['Localite'];
	$pays = $_POST ['Pays'];
	
	$result = $mysql->modifierAnnonceur ($IDAnnonceur, $Prenom, $Nom, $NomUtilisateur, $Telephone, $Email, $Adresse, $npa, $localite, $pays );
	
	
	header ( "location:../Vue/AccueilAnnonceur.php" );
	exit ();
}

?>