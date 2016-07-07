<?php
require_once '../Model/class.Transporteur.php';
require_once '../Controller/donneesPersonnelles.php';
include_once 'header.inc';

$msg = isset ( $_SESSION ['msg'] ) ? '<span class="error">*' . $_SESSION ['msg'] . '</span>' : '';
if ($msg)
	echo $msg;
	
// Récupération du transporteur connecté
$user = $_SESSION ['transporteur'];


// Récupération des types de transport
$typeTransport = getTypeTransportTransporteur ( $user->IDTransporteur );

?>

<div class="container">

	<p>Vos informations personnelles</p>
	
	<form method="post" action="../Controller/donneesPersonnelles.php">

		<table class="table">
		<input type="hidden" name="IDTrans"
				value="<?php echo  $user->IDTransporteur ?>">
			<tr>
				<td>Nom de la société :</td>
				<td><input type="text" name="NomSociete"
					value="<?php  echo $user->NomSociete?>"></td>
			</tr>
			<tr>
				<td>Téléphone :</td>
				<td><input type="text" name="Telephone"
					value="<?php echo $user->Telephone?>"></td>
			</tr>
			<tr>
				<td>Email :</td>
				<td><input type="text" name="Email" value="<?php echo $user->Email?>"></td>
			</tr>
			<tr>
				<td>Type de transport :</td>
				<td><input type="text" name="typesTransport"
					value="<?php  echo $typeTransport['Nom']?>"></td>
			</tr>
			<tr>
				<td>Adresse :</td>
				<td><input type="text" name="Adresse"
					value="<?php echo $user->Adresse?>"></td>
			</tr>
			<tr>
				<td>NPA :</td>
				<td><input type="text" name="NPA" value="<?php echo $user->NPA?>"></td>
			</tr>
			<tr>
				<td>Localité :</td>
				<td><input type="text" name="Localite"
					value="<?php echo $user->Localite?>"></td>
			</tr>
			<tr>
				<td>Pays :</td>
				<td><input type="text" name="Pays" value="<?php echo $user->Pays?>"></td>
			</tr>
			<tr>
				<td>IBAN :</td>
				<td><input type="text" name="IBAN" value="<?php echo $user->IBAN?>"></td>
			</tr>
			<tr>
				<td>Nom d'utilisateur :</td>
				<td><input type="text" name="UserName"
					value="<?php echo $user->UserName?>"></td>
			</tr>
			<tr>
				<td>Mot de passe :</td>
				<td><input type="text" name="MotDePasse"></td>
			</tr>


			<tr class="error">
				<td></td>
				<td>Confirmer les modifications en entrant votre ancien ou un
					nouveau mot de passe</td>
			</tr>
			<td></td>
			<td colspan="2" align="left"><button class="btn btn-default"
					type="submit" name="action" value="modifierTransporteur">Modifier</td>


		</table>
	</form>
	<br> <a href="../Vue/AccueilTransporteur.php">Accueil transporteur</a>

</div>
<?php
include_once 'footer.inc';
?>

