<?php
require_once '../Model/class.Transporteur.php';
require_once '../Controller/affichageTransporteur.php';
include_once 'header.inc';

// Récupération de l'annonceur connecté
$user = $_SESSION ['transporteur'];
$idTransporteur = $user->IDTransporteur;
$msg = isset ( $_SESSION ['msg'] ) ? '<span class="error">*' . $_SESSION ['msg'] . '</span>' : '';
if ($msg)
	echo $msg;
?>
<div class="container">

	<p>Accueil Transporteur</p>
	<br>
	<form method="post" action="../Vue/RechercheAnnonce.php">
		<input type="submit" name="action" value="Rechercher une annonce">
	</form>
	<br>
	<h3>Transports à effectuer</h3>
	<?php
	
	// Récupération des transports à effectuer qui concernent le transporteur affichés dans un tableau
	$annonces = getTransportsAEffectuer ( $idTransporteur );
	if ($annonces != null) {
		$table_str = '<table class="table">';
		$i = 1;
		$table_str .= '<tr>' . '<td>' . '</td><th >' . "Intitulé de l'annonce" . '</th>';
		$table_str .= '</tr>';
		foreach ( $annonces as $annonce ) {
			$table_str .= '<tr>';
			// Lien à chaque ligne du tableau vers l'annonce correspondante via le paramètre id
			$table_str .= '<td>' . ($i ++) . '</td><td><a href="DetailsAnnonceTransporteur.php?id=' . $annonce ['IDAnnonce'] . '&a=1"> ' . $annonce ['Nom'] . '</td>';
			$table_str .= '</tr>';
		}
		$table_str .= '</table>';
		echo $table_str;
	} else {
		echo 'Aucun transport à effectuer <br>';
	}
	
	?>
<br>
	<h3>Devis en attente</h3>
	<?php
	
	// Récupération des transports à effectuer qui concernent le transporteur affichés dans un tableau
	$annonces = getAnnoncesPossibles ( $idTransporteur );
	if ($annonces != null) {
		$table_str = '<table class="table">';
		$i = 1;
		$table_str .= '<tr>' . '<td>' . '</td><th >' . "Intitulé de l'annonce" . '</th>';
		$table_str .= '</tr>';
		foreach ( $annonces as $annonce ) {
			$table_str .= '<tr>';
			// Lien à chaque ligne du tableau vers l'annonce correspondante via le paramètre id
			$table_str .= '<td>' . ($i ++) . '</td><td><a href="DetailsAnnonceTransporteur.php?id=' . $annonce ['IDAnnonce'] . '&a=0"> ' . $annonce ['Nom'] . '</td>';
			$table_str .= '</tr>';
		}
		$table_str .= '</table>';
		echo $table_str;
	} else {
		echo 'Aucun devis en attente <br>';
	}
	
	?>


<h4>

		<br> <a href="HistoriqueTransporteur.php">Consulter l'historique</a> <br>
		<a href="InfosPersonnellesTransporteur.php">Données de l'entreprise</a>
	</h4>
</div>
</div>
<?php
include_once 'footer.inc';
?>
