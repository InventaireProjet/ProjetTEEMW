<?php
require_once '../Model/class.Annonceur.php';
require_once '../Controller/donneesPersonnelles.php';
include_once 'header.inc';

?>

<div class="container">

	<p>Vos informations personnelles</p>
<?php
// Récupération de l'annonceur connecté
$user = $_SESSION ['annonceur'];

//Récupération des informations personnelles
$infos = getInfoPersoAnnonceur ( $user->IDAnnonceur );

?>

<table class="table">
		<tr>
			<td>Prénom :</td>
			<td><?php echo $infos['Prenom']?></td>
	</tr>
	<tr>
		<td>Nom :</td>
		<td><?php echo $infos['Nom']?></td>
	</tr>
	<tr>
		<td>Nom d'utilisateur :</td>
		<td><?php echo $infos['UserName']?></td>
	</tr>
	<tr>
		<td>Mot de passe :</td>
		<td>******</td>
	</tr>
	<tr>
		<td>Téléphone :</td>
		<td><?php  echo $infos['Telephone']?></td>
	</tr>
	<tr>
		<td>Email :</td>
		<td><?php  echo $infos['Email']?></td>
	</tr>
	<tr>
		<td>Adresse :</td>
		<td><?php echo $infos['Adresse']?></td>
	</tr>
	<tr>
		<td>NPA :</td>
		<td><?php echo $infos['NPA']?></td>
	</tr>
	<tr>
		<td>Localité :</td>
		<td><?php echo $infos['Localite']?></td>
	</tr>
	<tr>
		<td>Pays :</td>
		<td><?php echo $infos['Pays']?></td>
	</tr>

	</table>


	<br /> <a href="../Vue/AccueilAnnonceur.php">Accueil anonceur</a>
</div>
<?php
include_once 'footer.inc';
?>
