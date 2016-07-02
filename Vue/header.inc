<?php

// Start the session
session_start ();

?>
<!DOCTYPE unspecified PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<html>
<head>
<title>TEEMW</title>

<!-- ajouter référence feuille de style -->
<link rel="stylesheet" href="../CSS/styles.css" type="text/css">

<!--  Utilisation de Bootstrap pour la partie HTML -->
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet"
	href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
	integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7"
	crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet"
	href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css"
	integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r"
	crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script
	src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"
	integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS"
	crossorigin="anonymous"></script>


</head>

<body>

	<div class="header">
		<h1 id="title">Teemw</h1>
		<p>Votre transporteur de marchandises</p>
		
<!-- 		Affichage du logout si un client est connecté -->
<?php
if (isset ( $_SESSION ['transporteur'] ) || isset ( $_SESSION ['annonceur'] )) {
	
	if (isset ( $_SESSION ['transporteur'] )) {
		$user = $_SESSION ['transporteur'];
		echo '<a href="../Controller/login.php?action=logout">Logout (' . $user->NomSociete . ')</a>';
	} else {
		$user = $_SESSION ['annonceur'];
		echo '<a href="../Controller/login.php?action=logout">Logout (' . $user->Prenom . ' ' . $user->Nom . ')</a>';
	}
}
?>
	</div>