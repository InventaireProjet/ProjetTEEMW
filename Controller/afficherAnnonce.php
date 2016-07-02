<?php
require_once '../Model/class.MySqlManager.php';
include_once '../Vue/header.inc';

$mysql = new MySqlManager ();

function getAnnonces($IDAnnonceur) {
	$mysql = new MySqlManager ();
	$result = $mysql->getAnnonces ($IDAnnonceur);
	
	return $result;
}

function nombreDevisParAnnonce($IDAnnonce) {
	$mysql = new MySqlManager ();
	$result = $mysql->nombreDevisParAnnonce ($IDAnnonce);
	
	return $result;
	
}

