<?php
require_once '../Controller/afficherAnnonce.php';
require_once '../Controller/affichageTransporteur.php';
include_once 'header.inc';

$msg = isset ( $_SESSION ['msg'] ) ? '<span class="error">*' . $_SESSION ['msg'] . '</span>' : '';
if ($msg)
	echo $msg;
?>
<div class="container">


	<h3>Détails de l'annonce</h3>
	<?php
	// Récupération de l'annonce à afficher et du transporteur
	$idAnnonce = $_GET ['id'];
	$annonce = getAnnonceMarchandiseLieu ( $idAnnonce );
	$user = $_SESSION ['transporteur'];
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
	


<?php
// Récupération du devis qui concerne l'annonce, de l'annonceur et du lieu
$devis = getDevisTransporteurAnnonce ( $user->IDTransporteur, $idAnnonce );
$annonceur = getAnnonceurDevis ( $devis ['IDDevis'] );

$lieu = getLieu ( $annonceur ['IDLieu'] );
?>
<h4>Devis soumis</h4>
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
	<h4>Coordonnées du client</h4> <table>
<tr>
<td>Prénom :</td>
<td><?php echo $annonceur ['Prenom'] ?></td>
	</tr>
	<tr>
		<td>Nom :</td>
		<td> <?php echo $annonceur ['Nom']?> </td>
	</tr>
	<tr>
		<td>Adresse :</td>
		<td> <?php echo $annonceur ['Adresse']  ?></td>
	</tr>
	<tr>
		<td></td>
		<td> <?php echo $lieu ['NPA']  .' ' . $lieu ['Localite'] ?></td>
	</tr>
	<tr>
		<td></td>
		<td><?php echo $lieu ['Pays'] ?></td>
	</tr>

	<tr>
		<td>Téléphone :</td>
		<td><?php echo $annonceur ['Telephone']?></td>
	</tr>
	<tr>
		<td>Email :</td>
		<td><?php echo $annonceur ['Email'] ?></td>
	</tr>
	
	</table>


<br>

<h4>Evaluation de votre transport par le client</h4>
	<table>
	<tr>
	<td>Note :</td>
	<td>PLACEHOLDER A REMPLACER PAR LA METHODE POUR OBTENIR LA NOTE</td>
						</tr>
						<tr>
							<td>Commentaire :</td>
							<td>PLACEHOLDER A REMPLACER PAR LA METHODE POUR OBTENIR LE COMMENTAIRE</td>
						</tr>
	</table>

 <br> <a href="../Vue/HistoriqueTransporteur.php">Retour à l'historique</a>

</div>
<?php
include_once 'footer.inc';
?>