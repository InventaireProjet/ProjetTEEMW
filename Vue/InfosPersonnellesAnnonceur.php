<?php
require_once '../Model/class.Annonceur.php';
include_once 'header.inc';

?>

<div class="container">

	<p>Vos informations personnelles</p>
<?php
// Récupération de l'annonceur connecté
$user = $_SESSION ['annonceur'];

?>

<table class="table">
		<tr>
			<td>Prénom :</td>
			<td><?php echo $user->Prenom?></td>
	</tr>
	<tr>
		<td>Nom :</td>
		<td><?php echo $user->Nom?></td>
	</tr>
	<tr>
		<td>Nom d'utilisateur :</td>
		<td><?php echo $user->UserName?></td>
	</tr>
	<tr>
		<td>Mot de passe :</td>
		<td>******</td>
	</tr>
	<tr>
		<td>Téléphone :</td>
		<td><?php echo $user->Telephone?></td>
	</tr>
	<tr>
		<td>Email :</td>
		<td><?php echo $user->Email?></td>
	</tr>
	<tr>
		<td>Adresse :</td>
		<td><?php echo $user->Adresse?></td>
	</tr>

	</table>


	<br /> <a href="../Vue/AccueilAnnonceur.php">Accueil anonceur</a>
</div>
<?php
include_once 'footer.inc';
?>
