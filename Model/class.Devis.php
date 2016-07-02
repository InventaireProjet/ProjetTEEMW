<?php
class Devis {
	public $ID;
	public $Prix;
	public $DateExpiration;
	public $Description;
	public $EnCours;
	public function __construct($id, $prix, $dateExpiration, $description, $enCours) {
		$this->IDDevis = $id;
		$this->Prix = $prix;
		$this->DateExpiration = $dateExpiration;
		$this->Description = $description;
		$this->EnCours = true;
	}
}
?>
