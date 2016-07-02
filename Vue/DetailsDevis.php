<?php
require_once '../Controller/afficherAnnonce.php';
include_once 'header.inc';
?>
<div class="container">


	<?php
	// Récupération du devis à afficher
	$idDevis = $_GET ['devis'];
	$devis = getUnDevis ( $idDevis );
	$idAnnonce =$_GET ['id'];
	?>
	
	<h3>Detail Devis <?php echo $idDevis?></h3>

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
<br><br> <a href="../Vue/DetailsAnnonceAnnonceur.php?id= <?php echo $idAnnonce?>">Retour à l'annonce</a>
</div>
<?php
include_once 'footer.inc';
?>