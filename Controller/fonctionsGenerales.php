<?php



//Vérification de l'entrée de la date
function verificationDate($date) {

	//Vérification du format de la date
	if (testdate ( $date ) == true) {
		list ( $jour, $mois, $annee ) = explode ( '/', $date );

		//Vérification de la validité de l'entrée
		if (checkdate ( $mois, $jour, $annee ) == true) {
				
			//Conversion des données entrées en un chiffre
			$dateChiffre = mktime ( 0, 0, 0, $mois, $jour, $annee );

			//Vérification que la date entrée est postérieur à aujourd'hui
			if ($dateChiffre > time()) {

				return true;
			}
		}
	}
}


//Vérification du format de la date
function testDate($value) {
	return preg_match ( '^\d{1,2}/\d{1,2}/\d{4}$^', $value );
}