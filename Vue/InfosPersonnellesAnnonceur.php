<?php
require_once '../Model/class.Annonceur.php';
require_once '../Controller/donneesPersonnelles.php';
require_once '../Controller/affichageTransporteur.php';
include_once 'header.inc';

$msg = isset ( $_SESSION ['msg'] ) ? '<span class="error">*' . $_SESSION ['msg'] . '</span>' : '';
if ($msg)
	echo $msg;
	// Récupération de l'annonceur connecté
$user = $_SESSION ['annonceur'];
?>

<div class="container">

	<p>Vos informations personnelles</p>


	<form method="post" action="../Controller/donneesPersonnelles.php">
		<table class="table">
			<input type="hidden" name="IDAnnonceur"
				value="<?php echo  $user->IDAnnonceur ?>">
			<tr>
				<td>Prénom :</td>

				<td><input type="text" name="Prenom"
					value="<?php echo $user-> Prenom ?>"></td>
			</tr>
			<tr>
				<td>Nom :</td>
				<td><input type="text" name="Nom" value="<?php echo $user-> Nom?>">
				</td>
			</tr>
			<tr>
				<td>Nom d'utilisateur :</td>
				<td><input type="text" name="NomUtilisateur"
					value="<?php echo $user-> UserName?>"</td>
			</tr>

			<tr>
				<td>Téléphone :</td>
				<td><input type="text" name="Telephone"
					value="<?php
					echo $user->Telephone?>"></td>
			</tr>
			<tr>
				<td>Email :</td>
				<td><input type="text" name="Email"
					value="<?php
					echo $user->Email?>"></td>
			</tr>
			<tr>
				<td>Adresse :</td>
				<td><input type="text" name="Adresse"
					value="<?php
					echo $user->Adresse?>"></td>
			</tr>
			<tr>
				<td>NPA :</td>
				<td><input type="text" name="NPA" value="<?php echo $user->NPA ?>">
				</td>
			</tr>
			<tr>
				<td>Localité :</td>
				<td><input type="text" name="Localite"
					value="<?php
					echo $user->Localite?>"></td>
			</tr>
			<tr>
				<td>Pays :</td>
				<td><input type="text" name="Pays"
					value="<?php
					echo $user->Pays?>"></td>
			</tr>

			<tr>
				<td>Mot de passe :</td>
				<td><input type="text" name="MotDePasse">
				</td>
			</tr>

<tr class="error"> <td></td><td>Confirmer les modifications en entrant votre ancien ou
					un nouveau mot de passe</td></tr>
			<td></td><td colspan="2" align="left"><button class="btn btn-default"
					type="submit" name="action" value="modifierAnnonceur">Modifier</td>
		</table>

	</form>


	<td> <h4><a href="../Vue/AccueilAnnonceur.php">Accueil anonceur</a></h4></td>

</div>
<?php
include_once 'footer.inc';
?>
