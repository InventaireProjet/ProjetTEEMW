<?php



//V�rification de l'entr�e de la date
function verificationDate($date) {

	//V�rification du format de la date
	if (testdate ( $date ) == true) {
		list ( $jour, $mois, $annee ) = explode ( '/', $date );

		//V�rification de la validit� de l'entr�e
		if (checkdate ( $mois, $jour, $annee ) == true) {
				
			//Conversion des donn�es entr�es en un chiffre
			$dateChiffre = mktime ( 0, 0, 0, $mois, $jour, $annee );

			//V�rification que la date entr�e est post�rieur � aujourd'hui
			if ($dateChiffre > time()) {

				return true;
			}
		}
	}
}


//V�rification du format de la date
function testDate($value) {
	return preg_match ( '^\d{1,2}/\d{1,2}/\d{4}$^', $value );
}