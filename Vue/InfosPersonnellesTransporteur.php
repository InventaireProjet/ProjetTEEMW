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

// Récupération des informations personnelles
$infos = getInfoPersoTransporteur ( $user->IDTransporteur );

?>


<table class="table">
		<tr>
			<td>Nom de la société :</td>
			<td><?php  echo $infos['NomSociete']?></td>
		</tr>
		<tr>
			<td>Téléphone :</td>
			<td><?php echo $infos['Telephone']?></td>
		</tr>
		<tr>
			<td>Email :</td>
			<td><?php echo $infos['Email']?></td>
		</tr>
		<tr>
			<td>Type de transport :</td>
			<td><?php  echo $infos['Nom']?></td>
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
		<tr>
			<td>IBAN :</td>
			<td><?php echo $infos['IBAN']?></td>
		</tr>
		<tr>
			<td>Nom d'utilisateur :</td>
			<td><?php echo $infos['Username']?></td>
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

