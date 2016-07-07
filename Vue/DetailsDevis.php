<?php
require_once '../Controller/afficherAnnonce.php';
include_once 'header.inc';

$msg = isset ( $_SESSION ['msg'] ) ? '<span class="error">*' . $_SESSION ['msg'] . '</span>' : '';
 if($msg) echo $msg;?>
<div class="container">

<h4><a href="../Vue/DetailsAnnonceAnnonceur.php?id=<?php echo $idAnnonce?>">Retour
		à l'annonce</a> </h4>

	<?php
	// Récupération du devis à afficher
	$idDevis = $_GET ['devis'];
	$devis = getUnDevis ( $idDevis );
	$numeroDevis = $_GET ['i'];
	$idAnnonce = $devis['IDAnnonce'];
	?>
	
	<p>Détails Devis <?php echo $numeroDevis ?></p>

	<table class="table">
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
	<form method="post" action="../Controller/confirmerDevis.php/">
		<input type="hidden" name="idDevis" value="<?php echo  $idDevis?>">
		<input type="hidden" name="noDevis" value="<?php echo  $numeroDevis?>">
		<input type="hidden" name="idAnnonce" value="<?php echo  $idAnnonce?>">
		<input type="submit" name="action" value="Valider ce devis">
	</form> 
	

</div>
<?php
include_once 'footer.inc';
?>