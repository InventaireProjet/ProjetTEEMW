<?php
require_once 'database/class.MySqlManager.php';
include_once 'header.inc';

$mysql = new MySqlManager ();

if (isset ( $_POST ['action'] )) {
	if ($_POST ['action'] == 'Entrer les données sur la marchandise') {
		enregistrerAnnonce ( $mysql );
	}
}

function enregistrerAnnonce($mysql) {
	$fname = $_POST ['firstname'];
	$lname = $_POST ['lastname'];
	$uname = $_POST ['username'];
	$pwd = $_POST ['password'];

	if (empty ( $pwd )) {
		$rank = 4;
		$msg = "Set a password";
	}

	if (empty ( $uname )) {
		$rank = 3;
		$msg = "Set a username";
	}

	if (empty ( $lname )) {
		$rank = 2;
		$msg = "Set a last name";
	}

	if (empty ( $fname )) {
		$rank = 1;
		$msg = "Set a first name";
	}
	if (isset ( $rank )) {
		$_SESSION ['rank'] = $rank;
		$_SESSION ['msg'] = $msg;
		$_SESSION ['form_data'] = array (
				$fname,
				$lname,
				$uname,
				$pwd
		);
		header ( "location:register.php" );
		exit ();
	}

	$result = $mysql->saveUser ( $fname, $lname, $uname, $pwd );
	if ($result == 'doublon') {
		$_SESSION ['rank'] = 3;
		$_SESSION ['msg'] = 'Username already exists';
		$_SESSION ['form_data'] = array (
				$fname,
				$lname,
				$uname,
				$pwd
		);
	} else {
		$_SESSION ['rank'] = 'top';
		$_SESSION ['msg'] = 'Registration succeeded';
	}

	header ( "location:register.php" );
	exit ();
}


}