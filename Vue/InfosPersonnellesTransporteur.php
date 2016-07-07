<?php
require_once '../Model/class.Transporteur.php';
require_once '../Controller/donneesPersonnelles.php';
include_once 'header.inc';
?>
<div class="container">

	<p>Vos informations personnelles</p>
<?php
// Récupération du transporteur connecté
$user = $_SESSION ['transporteur'];

// Récupération des types de transport
$typeTransport = getTypeTransportTransporteur($user->IDTransporteur );

?>


<table class="table">
		<tr>
			<td>Nom de la société :</td>
			<td><?php  echo $user->NomSociete?></td>
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
			<td>Type de transport :</td>
			<td><?php  echo $typeTransport['Nom']?></td>
		</tr>
		<tr>
			<td>Adresse :</td>
			<td><?php echo $user->Adresse?></td>
		</tr>
		<tr>
			<td>NPA :</td>
			<td><?php echo $user->NPA?></td>
		</tr>
		<tr>
			<td>Localité :</td>
			<td><?php echo $user->Localite?></td>
		</tr>
		<tr>
			<td>Pays :</td>
			<td><?php echo $user->Pays?></td>
		</tr>
		<tr>
			<td>IBAN :</td>
			<td><?php echo $user->IBAN?></td>
		</tr>
		<tr>
			<td>Nom d'utilisateur :</td>
			<td><?php echo $user->UserName?></td>
		</tr>
		<tr>
			<td>Mot de passe :</td>
			<td>******</td>
		</tr>




	</table>

	<br> <a href="../Vue/AccueilTransporteur.php">Accueil transporteur</a>
</div>
<?php
include_once 'footer.inc';
?>

