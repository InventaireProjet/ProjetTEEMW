<?php
class Lieu {
	public $ID;
	public $NPA;
	public $Localite;
	public $Pays;
	public function __construct($id, $npa, $localite, $pays) {
		$this->ID = $id;
		$this->NPA = $npa;
		$this->Localite = $localite;
		$this->Pays = $pays;
	}
}
?>