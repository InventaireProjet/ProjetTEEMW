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
	public $NPA;
	public $Localite;
	public $Pays;
	
	public function __construct($id, $prenom, $nom, $userName, $motDePasse, $telephone, $email, $adresse, $npa, $localite, $pays) {
		$this->IDAnnonceur = $id;
		$this->Prenom = $prenom;
		$this->Nom = $nom;
		$this->UserName = $userName;
		$this->MotDePasse = $motDePasse;
		$this->Telephone = $telephone;
		$this->Email = $email;
		$this->Adresse = $adresse;
		$this->NPA = $npa;
		$this->Localite = $localite;
		$this->Pays = $pays;
	}
}
?>