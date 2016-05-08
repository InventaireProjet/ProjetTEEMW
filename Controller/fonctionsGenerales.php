<?php
require_once '../Model/class.MySqlManager.php';
function controleLogin() {
	if ($_SESSION ['user'] == null) {
		header ( "location:../Vue/" );
	}
}

// V�rification de l'entr�e de la date
function verificationDate($date) {
	
	// V�rification du format de la date
	if (testdate ( $date ) == true) {
		list ( $jour, $mois, $annee ) = explode ( '/', $date );
		
		// V�rification de la validit� de l'entr�e
		if (checkdate ( $mois, $jour, $annee ) == true) {
			
			// Conversion des donn�es entr�es en un nombre
			$dateNombre = mktime ( 0, 0, 0, $mois, $jour, $annee );
			
			// V�rification que la date entr�e est post�rieure � aujourd'hui
			if ($dateNombre > time ()) {
				
				return true;
			}
		}
	}
}
function comparaisonDates($date1, $heure1, $minutes1, $date2, $heure2, $minutes2) {
	if (testDate ( $date1 ) == false || testDate ( $date2 ) == false) {
		return;
	}
	
	list ( $jour1, $mois1, $annee1 ) = explode ( '/', $date1 );
	list ( $jour2, $mois2, $annee2 ) = explode ( '/', $date2 );
	
	if ($heure1==null) {
		$heure1=0;
	}
	if ($minutes1==null) {
		$minutes1=0;
	}
	if ($heure2==null) {
		$heure2=0;
	}
	if ($minutes2==null) {
		$minutes2=0;
	}
	
	
	// Conversion des donn�es entr�es en nombres
	$date1Nombre = mktime ( $heure1, $minutes1, 0, $mois1, $jour1, $annee1 );
	$date2Nombre = mktime ( $heure2, $minutes2, 0, $mois2, $jour2, $annee2 );
	
	// V�rification que la date2 est post�rieure � la date1
	if ($date1Nombre <= $date2Nombre) {
		
		return true;
	}
}

// V�rification du format de la date
function testDate($value) {
	return preg_match ( '^\d{1,2}/\d{1,2}/\d{4}$^', $value );
}

// R�cup�ration du r�sultat de la requ�te dans la BDD qui renvoie un array des types de transport
function afficherTypeTransport() {
	$mysql = new MySqlManager ();
	$result = $mysql->afficherTypeTransport ();
	
	return $result;
}

// Convertisseur de dates en format timestamp
function dateSQL($date, $heure, $minutes) {
	list ( $jour, $mois, $annee ) = explode ( '/', $date );
	if ($heure==null) {
		$heure=0;
	}
	if ($minutes==null) {
		$minutes=0;
	}
	$dateNombre = mktime ( $heure, $minutes, 0, $mois, $jour, $annee );
	$dateSQL = date ( "Y-m-d H:i:s", $dateNombre );
	return $dateSQL;
}

//Liste tri�e des pays concern�s par le service
function listePays() {
	$array = Array('Suisse', 'France', 'Italie', 'Allemagne', 'Autriche', 'Liechtenstein', 'Belgique', 'Pays-Bas', 'Espagne', 'Portugal', 'Luxembourg');
	sort($array);
	return  $array;
}
