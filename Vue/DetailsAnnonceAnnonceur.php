<?php
require_once '../Model/class.Annonceur.php';
require_once '../Controller/afficherAnnonce.php';
require_once '../Controller/confirmerDevis.php';
include_once 'header.inc';
?>
<div class="container">

	<h4>
		<a href="../Vue/AccueilAnnonceur.php">Accueil anonceur</a>
	</h4>

	<p>Détails de l'annonce</p>
	<?php
	// Récupération de l'annonce à afficher
	$idAnnonce = $_GET ['id'];
	$annonce = getAnnonceMarchandiseLieu ( $idAnnonce );
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
	// Si vient depuis DetailsDevis affiche la première variante
	
	if ($annonce ['EnCours']) {
		// Récupération des devis qui concernent l'annonce affichée dans un tableau
		$devisT = getDevis ( $idAnnonce );
		
		$table_str = '	<h4>Devis soumis</h4> <table class="table">';
		
		if ($devisT != null) {
			
			$i = 1;
			$table_str .= '<tr>' . '<td>' . '</td><th >' . "Date de validité" . '</th><th>' . "Prix" . '</th>';
			$table_str .= '</tr>';
			foreach ( $devisT as $devis ) {
				$table_str .= '<tr>';
				// Lien à chaque ligne du tableau vers le devis correspondant via le paramètre id
				$table_str .= '<td><a href="DetailsDevis.php?devis=' . $devis ['IDDevis'] . '&i=' . ($i - 1) . '">' . ($i ++) . '</td><td><a href="DetailsDevis.php?devis=' . $devis ['IDDevis'] . '&i=' . ($i - 1) . '">' . $devis ['DateExpiration'] . '</td><td><a href="DetailsDevis.php?devis=' . $devis ['IDDevis'] . '&i=' . ($i - 1) . '"> ' . $devis ['Prix'] . '</td>';
				$table_str .= '</tr>';
			}
			$table_str .= '</table>';
			echo $table_str;
		} else {
			echo $table_str;
			echo 'Aucun devis soumis';
		}
	} else {
		// Récupération du devis choisi qui concerne l'annonce affichée dans un tableau
		$devis = getDevisValide ( $idAnnonce );
		
		$table_str = '	<h4>Devis choisi</h4> <table class="table">
				<tr><td > Date de validité </td><td>' . $devis ['DateExpiration'] . ' </td></tr>
					<tr><td>Prix</td><td>' . $devis ['Prix'] . '</td></tr>
					<tr><td>Description</td><td>' . $devis ['Description'] . '</td></tr>
					</table>';
		echo $table_str;
		
		// Affichage des coordonnées du transporteur choisi
		$transporteur = getTransporteur ( $devis ['IDDevis'] );
		$table_str2 = '<br>
	<h4>Coordonnées du transporteur</h4> <table class="table">
	<tr>
	<td>Nom de l\'entreprise :</td>
	<td>' . $transporteur ['NomSociete'] . '</td>
		</tr>
		<tr>
			<td>Adresse :</td>
			<td>' . $transporteur ['Adresse'] . '</td>
		</tr>
		<tr>
			<td></td>
			<td>' . $transporteur ['NPA'] . ' ' . $transporteur ['Localite'] . '</td>
		</tr>
		<tr>
			<td></td>
			<td>' . $transporteur ['Pays'] . '</td>
		</tr>
	
		<tr>
			<td>Téléphone :</td>
			<td>' . $transporteur ['Telephone'] . '</td>
		</tr>
		<tr>
			<td>Email :</td>
			<td>' . $transporteur ['Email'] . '</td>
		</tr>
		
		</table>
	
	
	<br>';
		echo $table_str2;
	}
	
	?>

	

</div>

<?php
include_once 'footer.inc';


