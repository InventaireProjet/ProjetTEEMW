<?php
require_once '../Model/class.MySqlManager.php';


//Vérification de l'entrée de la date
function verificationDate($date) {

	//Vérification du format de la date
	if (testdate ( $date ) == true) {
		list ( $jour, $mois, $annee ) = explode ( '/', $date );

		//Vérification de la validité de l'entrée
		if (checkdate ( $mois, $jour, $annee ) == true) {
				
			//Conversion des données entrées en un nombre
			$dateNombre = mktime ( 0, 0, 0, $mois, $jour, $annee );

			//Vérification que la date entrée est postérieure à aujourd'hui
			if ($dateNombre > time()) {

				return true;
			}
		}
	}
}

function comparaisonDates($date1, $date2) {
	
	if($date1==null || $date2==null){
		return ;
	}
	
	
	list ( $jour1, $mois1, $annee1 ) = explode ( '/', $date1 );
	list ( $jour2, $mois2, $annee2 ) = explode ( '/', $date2 );
	
	//Conversion des données entrées en nombres
	$date1Nombre = mktime ( 0, 0, 0, $mois1, $jour1, $annee1 );
	$date2Nombre = mktime ( 0, 0, 0, $mois2, $jour2, $annee2 );
	
	//Vérification que la date2  est postérieure à la date1
	if ($date1Nombre <= $date2Nombre) {
	
		return true;
	}
	
}

//Vérification du format de la date
function testDate($value) {
	return preg_match ( '^\d{1,2}/\d{1,2}/\d{4}$^', $value );
}

//Récupération du résultat de la requête dans la BDD qui renvoie un array des types de transport
function afficherTypeTransport() {
	$mysql = new MySqlManager ();
	$result = $mysql->afficherTypeTransport();
	
	return $result;
}
