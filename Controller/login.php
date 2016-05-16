<?php
require_once '../Model/class.MySqlManager.php';
include_once '../Vue/header.inc';

$mysql = new MySqlManager ();

if (isset ( $_POST ['action'] )) {
	if ($_POST ['action'] == 'enregistrerAnnonceur') {
		enregistrerAnnonceur ( $mysql );
	}
	
	if ($_POST ['action'] == 'connecterAnnonceur') {
		identifierAnnonceur ( $mysql );
	}
}
if (isset ( $_GET ['action'] )) {
	if ($_GET ['action'] == 'logout') {
		logout ();
	}
}
function identifierAnnonceur($mysql) {
	$uname = $_POST ['usr'];
	$pwd = $_POST ['pwd'];
	$result = $mysql->checkLogin ( $uname, $pwd );
	if (! $result) {
		$_SESSION ['form_data'] = array (
				$uname,
				$pwd 
		);
		$_SESSION ['msg'] = 'Username or password incorrect';
		header ( "location:../Vue/index.php" );
		exit ();
	}
	$_SESSION ['msg'] = 'Welcome ' . $result->Prenom . ' ' . $result->Nom;
	$_SESSION ['user'] = $result;
	header ( "location:../Vue/NouvelleAnnonceTypeTransport.php" );
	exit ();
}
function logout() {
	session_destroy ();
	header ( "location:../Vue/index.php" );
	exit ();
}
function enregistrerAnnonceur($mysql) {
	$fname = $_POST ['firstname'];
	$lname = $_POST ['lastname'];
	$uname = $_POST ['username'];
	$pwd = $_POST ['password'];
	$phone = $_POST ['phone'];
	$email = $_POST ['Email'];
	$adress = $_POST ['adress'];
	$IBAN = $_POST ['IBAN'];
	
	if (empty ( $IBAN )) {
		$rank = 7;
		$msg = "Set an IBAN";
	}
	if (empty ( $adress )) {
		$rank = 6;
		$msg = "Set an adress";
	}
	if (empty ( $email )) {
		$rank = 5;
		$msg = "Set an email";
	}
	if (empty ( $phone )) {
		$rank = 4;
		$msg = "Set a phone number";
	}
	if (empty ( $pwd )) {
		$rank = 3;
		$msg = "Set a password";
	}
	
	if (empty ( $uname )) {
		$rank = 2;
		$msg = "Set a username";
	}
	
	if (empty ( $lname )) {
		$rank = 1;
		$msg = "Set a last name";
	}
	
	if (empty ( $fname )) {
		$rank = 0;
		$msg = "Set a first name";
	}
	if (isset ( $rank )) {
		$_SESSION ['rank'] = $rank;
		$_SESSION ['msg'] = $msg;
		$_SESSION ['form_data'] = array (
				$fname,
				$lname,
				$uname,
				$pwd,
				$phone,
				$email,
				$adress,
				$IBAN
		);
		header ( "location:../Vue/InscriptionAnnonceur.php" );
		exit ();
	}
	
	$result = $mysql->saveAnnonceur ( $fname, $lname, $uname, $pwd, $phone, $email, $adress, $IBAN );
	if ($result == 'doublon') {
		$_SESSION ['rank'] = 3;
		$_SESSION ['msg'] = 'Username already exists';
		$_SESSION ['form_data'] = array (
				$fname,
				$lname,
				$uname,
				$pwd,
				$phone,
				$email,
				$adress,
				$IBAN
		);
	} else {
		$_SESSION ['rank'] = 'top';
		$_SESSION ['msg'] = 'Registration succeeded';
	}
	
	header ( "location:../Vue/AccueilAnnonceur.php" );
	exit ();
}

include_once '../Vue/footer.inc';
