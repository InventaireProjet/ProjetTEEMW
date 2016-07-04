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

	<h3>Ajouter un commentaire:</h3>

<table class="table">
					<tr>
						<td>Note:</td>
						<td><input type="int" name="Note"
							value="<?php
							echo $form_data [0];
							?>"> 
    <?php if($rank==1) echo $msg;?></td>
					</tr>
					<tr>
						<td>Commentaire:</td>
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

<?php
// Récupération du devis qui a été accepté
$devisT = getDevisValide ( $idAnnonce );
if ($devisT != null) {
	$table_str = '<table class="table">';
	$i = 1;
	$table_str .= '<tr>' . '<td>' . '</td><th >' . "Date de validité" . '</th><th>' . "Prix" . '</th>';
	$table_str .= '</tr>';
	foreach ( $devisT as $devis ) {
		$table_str .= '<tr>';
		// Lien à chaque ligne du tableau vers le devis correspondant via le paramètre id
		$table_str .= '<td>' . ($i ++) . '</td><td>' . $devis ['DateExpiration'] . '</td><td><a href="DetailsDevis.php?devis=' . $devis ['IDDevis'] . '&i=' . ($i - 1) . '"> ' . $devis ['Prix'] . '</td>';
		$table_str .= '</tr>';
	}
	$table_str .= '</table>';
	echo $table_str;
} else {
	echo 'Aucun devis soumis';
}
?>


	<br>
	<br> <a href="../Vue/AccueilAnnonceur.php">Accueil anonceur</a>

</div>
<?php
include_once 'footer.inc';
?>
