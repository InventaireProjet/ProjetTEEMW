<?php
require_once '../Model/class.Transporteur.php';
require_once '../Controller/affichageTransporteur.php';
include_once 'header.inc';
?>
<div class="container">

	<p>Historique Transporteur : Listes des transports effectués</p>

	<?php
	//$user = $_SESSION ['transporteur'];
	
	$user = 2;
	// Récupération des transports effectué
	
	//$annonces = getTransportsEffectue ( $user->IDTransporteur );
	$annonces = getTransportsEffectue ( $user);
	if ($annonces != null) {
		$table_str = '<table class="table">';
		$i = 1;
		$table_str .= '<tr>' . '<td>' . '</td><th >' . "Intitulé de l'annonce" . '</th>';
		$table_str .= '</tr>';
		foreach ( $annonces as $annonce ) {
			$table_str .= '<tr>';
			// Lien à chaque ligne du tableau vers l'annonce correspondante via le paramètre id
			$table_str .= '<td>' . ($i ++) . '</td><td><a href="DetailsDevis.php?devis=' . $annonce ['IDDevis'] . '&a=1"> ' . $annonce ['Nom'] . '</td>';
			$table_str .= '</tr>';
		}
		$table_str .= '</table>';
		echo $table_str;
	} else {
		echo 'Aucun transport terminé <br>';
	}
	
	?>
		
	
	
	 <a href="../Vue/AccueilTransporteur.php">Accueil transporteur</a>
</div>
<?php
include_once 'footer.inc';
?>
