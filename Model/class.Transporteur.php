<?php
class Transporteur {
	public $IDTransporteur;
	public $NomSociete;
	public $Telephone;
	public $Email;
	public $UserName;
	public $MotDePasse;
	public $Adresse;
	public function __construct($id, $nomSociete, $telephone, $email, $userName, $motDePasse, $adresse) {
		$this->IDTransporteur = $id;
		$this->NomSociete = $nomSociete;
		$this->Telephone = $telephone;
		$this->Email = $email;
		$this->UserName = $userName;
		$this->MotDePasse = $motDePasse;
		$this->Adresse = $adresse;
	}
}
?>