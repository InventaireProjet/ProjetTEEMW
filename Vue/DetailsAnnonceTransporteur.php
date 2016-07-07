<?php
require_once '../Controller/afficherAnnonce.php';
require_once '../Controller/affichageTransporteur.php';
include_once 'header.inc';

$msg = isset ( $_SESSION ['msg'] ) ? '<span class="error">*' . $_SESSION ['msg'] . '</span>' : '';
if ($msg)
	echo $msg;
?>
<div class="container">

 <h4><a href="../Vue/AccueilTransporteur.php">Accueil transporteur</a></h4>  <br>

	<p>Détails de l'annonce</p>
	<?php
	// Récupération de l'annonce à afficher et du transporteur
	$idAnnonce = $_GET ['id'];
	$annonce = getAnnonceMarchandiseLieu ( $idAnnonce );
	$user = $_SESSION ['transporteur'];
	?>
	
	<table class="table">
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
	


<?php
// Récupération du devis qui concerne l'annonce
$devis = getDevisTransporteurAnnonce ( $user->IDTransporteur, $idAnnonce );

?>
<h3>Devis soumis</h3>
	<table class="table">
		
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


<?php
$typeAffichage = $_GET ['a'];

// Affichage des coordonnées client si le devis a été accepté (paramètre 'a' du GET = 1)
if ($typeAffichage == 1) {
	
	$annonceur = getAnnonceurDevis ( $devis ['IDDevis'] );
	
	$lieu = getLieu ( $annonceur ['IDLieu'] );
	
	// Affichage de la table
	echo $table_str = '<br>
	<h3>Coordonnées du client</h3> <table>
<tr>
<td>Prénom :</td>
<td>' . $annonceur ['Prenom'] . '</td>
	</tr>
	<tr>
		<td>Nom :</td>
		<td>' . $annonceur ['Nom'] . '</td>
	</tr>
	<tr>
		<td>Adresse :</td>
		<td>' . $annonceur ['Adresse'] . ' </td>
	</tr>
	<tr>
		<td></td>
		<td>' . $lieu ['NPA'] . ' ' . $lieu ['Localite'] . '</td>
	</tr>
	<tr>
		<td></td>
		<td>' . $lieu ['Pays'] . '</td>
	</tr>

	<tr>
		<td>Téléphone :</td>
		<td>' . $annonceur ['Telephone'] . '</td>
	</tr>
	<tr>
		<td>Email :</td>
		<td>' . $annonceur ['Email'] . '</td>
	</tr>
	
	</table>';
	
	// Bouton d'archivage
	echo $boutonArchiver = '<br><form method="post" action="../Controller/affichageTransporteur.php/">
		<input type="hidden" name="idAnnonce" value="' . $idAnnonce . '">
		<input type="hidden" name="typeAffichage" value="' . $typeAffichage . '">
		<input type="submit" name="action" value="Archiver">
	</form> ';
}

?>



</div>
<?php
include_once 'footer.inc';
?>

