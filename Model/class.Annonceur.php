<?php
class Annonceur {
	public $IDAnnonceur;
	public $Prenom;
	public $Nom;
	public $UserName;
	public $MotDePasse;
	public $Telephone;
	public $Email;
	public $Adresse;
	public function __construct($id, $prenom, $nom, $userName, $motDePasse, $telephone, $email, $adresse) {
		$this->IDAnnonceur = $id;
		$this->Prenom = $prenom;
		$this->Nom = $nom;
		$this->UserName = $userName;
		$this->MotDePasse = $motDePasse;
		$this->Telephone = $telephone;
		$this->Email = $email;
		$this->Adresse = $adresse;
	}
}
?>