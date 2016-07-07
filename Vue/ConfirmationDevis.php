<?php
require_once '../Controller/afficherAnnonce.php';
require_once '../Controller/confirmerDevis.php';
include_once 'header.inc';

$msg = isset ( $_SESSION ['msg'] ) ? '<span class="error">*' . $_SESSION ['msg'] . '</span>' : '';
 if($msg) echo $msg;?>
 
 <div class="container">
 <?php
	// Récupération du devis concerné
	$idDevis = $_GET ['devis'];
	$devis = getUnDevis ( $idDevis );
	$idAnnonce = $devis['IDAnnonce'];
	?>

	<h3>Confirmation de validation du devis</h3>
	
	<h4>Vous avec accepté le devis suivant :</h4>
	
	<table>
		<tr>
			<td>Date d'expiration de l'offre :</td>
			<td><?php echo $devis['DateExpiration']?></td>
		</tr>
		<tr>
			<td>Prix :</td>
			<td><?php echo $devis ['Prix']?></td>
		</tr>
		<tr>
			<td>Description de l'offre :</td>
			<td><?php echo $devis ['Description']?></td>
		</tr>
	</table>
	<br>
	<h4>Voici les coordonnées du transporteur pour la prise de contact et le paiement :</h4>
	
<?php
	// Récupération du transporteur concerné et de son lieu d'établissement
	$transporteur = getTransporteur ( $idDevis );
	?>
	<table>
		<tr>
			<td>Nom de l'entreprise :</td>
			<td><?php echo $transporteur['NomSociete']?></td>
		</tr>
		<tr>
			<td>Téléphone :</td>
			<td><?php echo $transporteur ['Telephone']?></td>
		</tr>
		<tr>
			<td>Email :</td>
			<td><?php echo $transporteur ['Email']?></td>
		</tr>
		<tr>
			<td>Adresse :</td>
			<td><?php echo $transporteur ['Adresse']?></td>
		</tr>
		<tr>
			<td></td>
			<td><?php echo $transporteur['NPA'] .' ' .$transporteur ['Localite']?></td>
		</tr>
		<tr>
			<td></td>
			<td><?php echo $transporteur['Pays'] ?></td>
		</tr>
		<tr>
			<td>IBAN :</td>
			<td><?php echo $transporteur ['IBAN']?></td>
		</tr>
		
	</table>
<br>
<form method="post" action="../Vue/AccueilAnnonceur.php">
		<input type="submit" name="action" value="OK">
	</form> 

</div>
<?php
include_once 'footer.inc';
?>