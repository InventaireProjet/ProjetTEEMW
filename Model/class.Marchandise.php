<?php
class Marchandise {
	public $ID;
	public $Description;
	public $Quantite;
	public $Volume;
	public $Poids;
	public function __construct($id, $description, $quantite, $volume, $poids) {
		$this->ID = $id;
		$this->Description= $description;
		$this->Quantite = $quantite;
		$this->Volume = $volume;
		$this->Poids = $poids;
	}
}
?>