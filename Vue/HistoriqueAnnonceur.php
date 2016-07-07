<?php
require_once '../Model/class.Annonceur.php';
require_once '../Controller/afficherAnnonce.php';
include_once 'header.inc';
?>

<div class="container">

	<h4><a href="../Vue/AccueilAnnonceur.php">Accueil Annonceur</a></h4><br>


	<p>Historique Annonceur : Listes des annonces terminées</p>

	<?php
	
	// Récupération de l'annonceur connecté
	$user = $_SESSION ['annonceur'];
	
	// Récupération des annonces terminé à afficher
	$annonces = getAnnonceRealise ( $user->IDAnnonceur );
	
	if ($annonces != null) {
		$table_str = '<table class="table">';
		$i = 1;
		$table_str .= '<tr>' . '<td>' . '</td><th >' . "Intitulé de l'annonce" . '</th>';
		$table_str .= '</tr>';
		foreach ( $annonces as $annonce ) {
			$table_str .= '<tr>';
			// Lien à chaque ligne du tableau vers l'annonce correspondante via le paramètre id
			$table_str .= '<td>' . ($i ++) . '</td><td><a href="DetailsAnnonceAnnonceurHistorique.php?id=' . $annonce ['IDAnnonce'] . '"> ' . $annonce ['Nom'] . '</td>';
			$table_str .= '</tr>';
		}
		$table_str .= '</table>';
		echo $table_str;
	} else {
		echo 'Aucune annonce terminée <br>';
	}
	
	?>

	<br> <br />
</div>
<?php
include_once 'footer.inc';
?>