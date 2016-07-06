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

// Récupération des informations personnelles
$infos = getInfoPersoAnnonceur ( $user->IDAnnonceur );

?>

<form method="post" action="../Controller/donneesPersonnelles.php">
		<table class="table">
			<tr>
				<td>ID :</td>
				<td><input type="text" name="IDAnnonceur"
					value="<?php echo $infos['IDAnnonceur']?>"></td>
			</tr>
			<tr>
				<td>Prénom :</td>

				<td><input type="text" name="Prenom"
					value="<?php echo $infos['Prenom']?>"></td>
			</tr>
			<tr>
				<td>Nom :</td>
				<td><input type="text" name="Nom" value="<?php echo $infos['Nom']?>"></td>
			</tr>
			<tr>
				<td>Nom d'utilisateur :</td>
				<td><input type="text" name="NomUtilisateur"
					value="<?php echo $infos['UserName']?>"</td>
			</tr>
			<tr>
				<td>Mot de passe :</td>
				<td><input type="text" name="Mdp"
					value="<?php
					echo $infos ['MotDePasse']?>"</td>
			</tr>
			<tr>
				<td>Téléphone :</td>
				<td><input type="text" name="Telephone"
					value="<?php
					echo $infos ['Telephone']?>"></td>
			</tr>
			<tr>
				<td>Email :</td>
				<td><input type="text" name="Email"
					value="<?php
					echo $infos ['Email']?>"></td>
			</tr>
			<tr>
				<td>Adresse :</td>
				<td><input type="text" name="Adresse"
					value="<?php
					echo $infos ['Adresse']?>"></td>
			</tr>
			<tr>
				<td>NPA :</td>
				<td><input type="text" name="NPA" value="<?php echo $infos['NPA']?>"></td>
			</tr>
			<tr>
				<td>Localité :</td>
				<td><input type="text" name="Localite"
					value="<?php
					echo $infos ['Localite']?>"></td>
			</tr>
			<tr>
				<td>Pays :</td>
				<td><input type="text" name="Pays"
					value="<?php
					echo $infos ['Pays']?>"></td>
			</tr>
			<td colspan="2" align="left"><button class="btn btn-default"
					type="submit" name="action" value="modifierAnnonceur">Modifier</td>
		</table>

	</form>


	<td><a href="../Vue/AccueilAnnonceur.php">Accueil anonceur</a></td>

</div>
<?php
include_once 'footer.inc';
?>
