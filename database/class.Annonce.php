<?php
class Annonce {
	public $idAnnonce;
	public $nom;
	public $lastname;
	public $username;
	public $password;
	public function __construct($id, $firstname, $lastname, $username, $password) {
		$this->id = $id;
		$this->firstname = $firstname;
		$this->lastname = $lastname;
		$this->username = $username;
		$this->password = $password;
	}
}
?>