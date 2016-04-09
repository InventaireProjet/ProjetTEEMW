<?php
class TypeTransport {
	public $ID;
	public $Nom;
	public function __construct($id, $nom) {
		$this->ID = $id;
		$this->Nom = $nom;
	}
}
?>