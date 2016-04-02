<?php
class User {
	public $id;
	public $firstname;
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