<?php
require_once '../Model/class.MySqlManager.php';


// Vérification de l'entrée de la date
function verificationDate($date) {
	
	// Vérification du format de la date
	if (testdate ( $date ) == true) {
		list ( $jour, $mois, $annee ) = explode ( '/', $date );
		
		// Vérification de la validité de l'entrée
		if (checkdate ( $mois, $jour, $annee ) == true) {
			
			// Conversion des données entrées en un nombre
			$dateNombre = mktime ( 0, 0, 0, $mois, $jour, $annee );
			
			// Vérification que la date entrée est postérieure à aujourd'hui
			if ($dateNombre > time ()) {
				
				return true;
			}
		}
	}
}
function comparaisonDates($date1, $heure1, $minutes1, $date2, $heure2, $minutes2) {
	
	//Vérification du format des dates
	if (testDate ( $date1 ) == false || testDate ( $date2 ) == false) {
		return;
	}
	
	//Séparation des nombres de la date grâce au "/"
	list ( $jour1, $mois1, $annee1 ) = explode ( '/', $date1 );
	list ( $jour2, $mois2, $annee2 ) = explode ( '/', $date2 );
	
	//Champs null convertis en 0
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
	
	
	// Conversion des données entrées en nombres
	$date1Nombre = mktime ( $heure1, $minutes1, 0, $mois1, $jour1, $annee1 );
	$date2Nombre = mktime ( $heure2, $minutes2, 0, $mois2, $jour2, $annee2 );
	
	// Vérification que la date2 est postérieure à la date1
	if ($date1Nombre <= $date2Nombre) {
		
		return true;
	}
}

// Vérification du format de la date
function testDate($value) {
	return preg_match ( '^\d{1,2}/\d{1,2}/\d{4}$^', $value );
}

// Récupération du résultat de la requête dans la BDD qui renvoie un array des types de transport
function afficherTypeTransport() {
	$mysql = new MySqlManager ();
	$result = $mysql->afficherTypeTransport ();
	
	return $result;
}

// Convertisseur de dates en format timestamp
function dateSQL($date, $heure, $minutes) {
	
	//Séparation des nombres de la date grâce au "/"
	list ( $jour, $mois, $annee ) = explode ( '/', $date );
	
	//Champs null convertis en 0
	if ($heure==null) {
		$heure=0;
	}
	if ($minutes==null) {
		$minutes=0;
	}
	
	//Date compatible avec format SQL
	$dateNombre = mktime ( $heure, $minutes, 0, $mois, $jour, $annee );
	$dateSQL = date ( "Y-m-d H:i:s", $dateNombre );
	return $dateSQL;
}

//Liste triée des pays concernés par le service
function listePays() {
	$array = Array('Suisse', 'France', 'Italie', 'Allemagne', 'Autriche', 'Liechtenstein', 'Belgique', 'Pays-Bas', 'Espagne', 'Portugal', 'Luxembourg');
	sort($array);
	return  $array;
}
