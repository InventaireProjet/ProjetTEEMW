<?php
require_once '../Controller/afficherAnnonce.php';
require_once '../Controller/affichageTransporteur.php';
include_once '../Vue/header.inc';
// Récupération de l'annonceur connecté
$user = $_SESSION ['transporteur'];
$idTransporteur = $user->IDTransporteur;

?>
<div class="container">

	<h4>Annonces correspondant à votre profil</h4>

	<?php
	// Récupération de l'annonceur connecté
	$user = $_SESSION ['transporteur'];
	$idTransporteur = $user->IDTransporteur;
	$annonces = getSelectionAnnonces ( $idTransporteur );
	
	
	if ($annonces != null) {
		$table_str = '<table class="table">';
		$i = 1;
		$table_str .= '<tr>' . '<td>' . '</td><th >' . "Date départ" . '</th>
			<th >' . "Lieu départ" . '</th>
			<th >' . "Date arrivée" . '</th>
			<th >' . "Lieu arrivée" . '</th>
			<th >' . "Intitulé de l'annonce" . '</th>
			<th >' . "Type transport" . '</th>';
		$table_str .= '</tr>';
		foreach ( $annonces as $annonce ) {
			$lieuDepart = getLieu($annonce['IDLieuDepart']);
			$lieuArrivee = getLieu($annonce['IDLieuArrivee']);
			$table_str .= '<tr>';
			// Lien à chaque ligne du tableau vers l'annonce correspondante via le paramètre id
			$table_str .= '<td>' . ($i ++) . '</td><td>' . $annonce ['DateDepart']
					. '</td><td>' . $lieuDepart ['Localite']
					. '</td><td>'. $annonce ['DateArrivee']
					. '</td><td>' . $lieuArrivee ['Localite']
					. '</td><th><a href="DetailsAnnonceTransporteur2.php?id=' . $annonce ['IDAnnonce']  . '"> ' 
					. $annonce ['NomAnnonce'] .  '</u></th><td>' . $annonce ['TypeTransport'] . '</td>';
			$table_str .= '</tr>';
		}
		$table_str .= '</table>';
		echo $table_str;
	} else {
		echo 'Aucune annonce ne correspond aux types de transport que vous proposez <br>';
	}
	?>
<br> <a href="../Vue/AccueilTransporteur.php">Accueil transporteur</a>
</div>
</div>
<?php
include_once 'footer.inc';
?>