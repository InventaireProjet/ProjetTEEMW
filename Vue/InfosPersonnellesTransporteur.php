<?php
require_once '../Model/class.Transporteur.php';
include_once 'header.inc';
?>
<div class="container">

	<p>Vos informations personnelles</p>
<?php
// Récupération de l'annonceur connecté
$user = $_SESSION ['transporteur'];

?>


<table class="table">
		<tr>
			<td>Nom de la société :</td>
			<td><?php echo $user->NomSociete?></td>
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
			<td>IBAN :</td>
			<td><?php echo $user->IBAN?></td>
		</tr>
		<tr>
			<td>Adresse :</td>
			<td><?php echo $user->Adresse?></td>
		</tr>

	</table>

	<br> <a href="../Vue/AccueilTransporteur.php">Accueil transporteur</a>
</div>
<?php
include_once 'footer.inc';
?>

