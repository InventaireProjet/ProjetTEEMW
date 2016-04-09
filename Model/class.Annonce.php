<?php
class Annonce {
	public $ID;
	public $Nom;
	public $DateDepart;
	public $DateArrivee;
	public $AdresseDepart;
	public $AdresseArrivee;
	public $EnCours;
	public $TransportRealise;
	public function __construct($id, $nom, $dateDepart, $dateArrivee, $adresseDepart, $adresseArrivee) {
		$this->ID = $id;
		$this->Nom = $nom;
		$this->DateDepart = $dateDepart;
		$this->DateArrivee = $dateArrivee;
		$this->AdresseDepart = $adresseDepart;
		$this->AdresseArrivee = $adresseArrivee;
		$this->EnCours = true;
		$this->TransportRealise = false;
	}
}
?>