<?php
require_once '../Controller/afficherAnnonce.php';
include_once 'header.inc';

$msg = isset ( $_SESSION ['msg'] ) ? '<span class="error">*' . $_SESSION ['msg'] . '</span>' : '';
 if($msg) echo $msg;?>
<div class="container">


	<?php
	// Récupération du devis à afficher
	$idDevis = $_GET ['devis'];
	$devis = getUnDevis ( $idDevis );
	$numeroDevis = $_GET ['i'];
	$idAnnonce = $devis['IDAnnonce'];
	?>
	
	<h3>Détails Devis <?php echo $numeroDevis ?></h3>

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
	<form method="post" action="../Controller/validerDevis.php/">
		<input type="hidden" name="idDevis" value="<?php echo  $idDevis?>">
		<input type="hidden" name="noDevis" value="<?php echo  $numeroDevis?>">
		<input type="submit" name="action" value="Valider ce devis">
	</form> 
	<a href="../Vue/DetailsAnnonceAnnonceur.php?id=<?php echo $idAnnonce?>">Retour
		à l'annonce</a>

</div>
<?php
include_once 'footer.inc';
?>