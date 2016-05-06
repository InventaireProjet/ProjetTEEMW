<?php
require_once '../Model/class.MySqlManager.php';


//V�rification de l'entr�e de la date
function verificationDate($date) {

	//V�rification du format de la date
	if (testdate ( $date ) == true) {
		list ( $jour, $mois, $annee ) = explode ( '/', $date );

		//V�rification de la validit� de l'entr�e
		if (checkdate ( $mois, $jour, $annee ) == true) {
				
			//Conversion des donn�es entr�es en un nombre
			$dateNombre = mktime ( 0, 0, 0, $mois, $jour, $annee );

			//V�rification que la date entr�e est post�rieure � aujourd'hui
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
	
	//Conversion des donn�es entr�es en nombres
	$date1Nombre = mktime ( 0, 0, 0, $mois1, $jour1, $annee1 );
	$date2Nombre = mktime ( 0, 0, 0, $mois2, $jour2, $annee2 );
	
	//V�rification que la date2  est post�rieure � la date1
	if ($date1Nombre <= $date2Nombre) {
	
		return true;
	}
	
}

//V�rification du format de la date
function testDate($value) {
	return preg_match ( '^\d{1,2}/\d{1,2}/\d{4}$^', $value );
}

//R�cup�ration du r�sultat de la requ�te dans la BDD qui renvoie un array des types de transport
function afficherTypeTransport() {
	$mysql = new MySqlManager ();
	$result = $mysql->afficherTypeTransport();
	
	return $result;
}
