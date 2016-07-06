<?php
require_once '../Model/class.Annonceur.php';
require_once '../Controller/afficherAnnonce.php';
include_once 'header.inc';

$rank = isset ( $_SESSION ['rank'] ) ? $_SESSION ['rank'] : 0;
$msg = isset ( $_SESSION ['msg'] ) ? '<span class="error">*' . $_SESSION ['msg'] . '</span>' : '';
$form_data = isset ( $_SESSION ['form_data'] ) ? $_SESSION ['form_data'] : array (
		'',
		''
);
?>
<div class="container">

	<h3>Ajouter un commentaire :</h3>

<table class="table">
					<tr>
						<td>Note :</td>
						<td><input type="int" name="Note"
							value="<?php
							echo $form_data [0];
							?>"> 
    <?php if($rank==1) echo $msg;?></td>
					</tr>
					<tr>
						<td>Commentaire :</td>
						<td><input type="text" name="Commentaire"
							value="<?php
							echo $form_data [1];
							?>"> 
	<?php if($rank==2) echo $msg;?></td>
					</tr>
					<tr>
						<td colspan="2" align="left"><button class="btn btn-default"
								type="submit" name="action" value="enregistrerCommentaire">Enregistrez votre commentaire</td>
					</tr>
	</table>
	</form>

	
	<h3>Détails de l'annonce</h3>
	<?php
	// Récupération de l'annonce à afficher
	$idAnnonce = $_GET ['id'];
	$annonce = getAnnonceMarchandiseLieu ( $idAnnonce );

	// Récupération du devis qui a été accepté
	$devis = getDevisValide ( $idAnnonce );
	?>
	
	<table>
		<tr>
			<td>Nom de l'annonce :</td>
			<td><?php echo $annonce['Nom']?></td>
		</tr>
		<tr>
			<td>Date de départ :</td>
			<td><?php echo $annonce ['DateDepart']?></td>
		</tr>
		<tr>
			<td>Adresse de départ :</td>
			<td><?php echo $annonce ['AdresseDepart']?></td>
		</tr>
		<tr>
			<td></td>
			<td><?php echo $annonce['NPADepart'] .' ' .$annonce ['LieuDepart']?></td>
		</tr>
		<tr>
			<td></td>
			<td><?php echo $annonce['PaysDepart'] ?></td>
		</tr>
		<tr>
			<td>Date d'arrivée :</td>
			<td><?php echo $annonce ['DateArrivee']?></td>
		</tr>
		<tr>
			<td>Adresse d'arrivée :</td>
			<td><?php echo $annonce ['AdresseArrivee']?></td>
		</tr>
		<tr>
			<td></td>
			<td><?php echo $annonce['NPAArrivee'] .' ' .$annonce ['LieuArrivee']?></td>
		</tr>
		<tr>
			<td></td>
			<td><?php echo $annonce['PaysArrivee'] ?></td>
		</tr>
		<tr>
			<td>Description :</td>
			<td><?php echo $annonce['Description']?></td>
		</tr>
		<tr>
			<td>Volume :</td>
			<td><?php echo $annonce ['Volume']?></td>
		</tr>
		<tr>
			<td>Poids :</td>
			<td><?php echo $annonce ['Poids']?></td>
		</tr>
		<tr>
			<td>Quantité :</td>
			<td><?php echo $annonce['Quantite']?></td>
		</tr>
		  <tr>
			<td>Type de transport :</td>
			<td><?php
			$typeTransport = getTypeTransportFromMarchandise ( $annonce ['IDMarchandise'] );
			echo $typeTransport ['Nom']?></td>
		</tr>
	</table>
	<br>
	<h4>Devis accepté</h4>

	<table
		
		<tr>
			<td>Date d'expiration :</td>
			<td><?php echo $devis ['DateExpiration']?></td>
		</tr>
		<tr>
			<td>Prix :</td>
			<td><?php echo $devis ['Prix']?></td>
		</tr>
		<tr>
			<td>Description :</td>
			<td><?php echo $devis['Description']?></td>
		</tr>

	</table>


	<br>
	<br> <a href="../Vue/AccueilAnnonceur.php">Accueil anonceur</a>

</div>
<?php
include_once 'footer.inc';
?>

