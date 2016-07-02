<?php
require_once '../Model/class.Annonceur.php';
require_once '../Controller/afficherAnnonce.php';
include_once 'header.inc';

$msg = isset ( $_SESSION ['msg'] ) ? '<span class="error">*' . $_SESSION ['msg'] . '</span>' : '';

?>
<?php if($msg) echo $msg;?>
<div class="container">
	<h3>Accueil Annonceur</h3>
	
	<br><br>
	<h4>Annonces en cours</h4>
	
	<?php
	//Récupération de l'annonceur connecté
	$user = $_SESSION ['annonceur'];
	
	//Récupération des annonces en cours qui concernent l'annonceur affichées dans un tableau
	$annonces = getAnnonces ( $user->IDAnnonceur );
	if ($annonces!=null) {
	$table_str = '<table class="table">';
	$i = 1;
	$table_str .= '<tr>' . '<td>' . '</td><th >' . "Intitulé de l'annonce" . '</th><th>' . "Devis" . '</th>';
	$table_str .= '</tr>';
	foreach ( $annonces as $annonce ) {
		$table_str .= '<tr>';
		//Lien à chaque ligne du tableau vers l'annonce correspondante via le paramètre id
		$table_str .= '<td>' . ($i ++) . '</td><td><a href="DetailsAnnonceAnnonceur.php?id=' .$annonce['IDAnnonce'] 
		. '"> ' . $annonce ['Nom'] . '</td><td>' . nombreDevisParAnnonce($annonce['IDAnnonce']) . '</td>';
		$table_str .= '</tr>';
	}
	$table_str .= '</table>';
	echo $table_str;}
	else {
		echo 'Aucune annonce postée <br>';
	}
	
	?>
	
	
	
	
	<br> <a href="NouvelleAnnonceTypeTransport.php">Insérer une annonce</a>	
 <br><a href="HistoriqueAnnonceur.php">Consulter l'historique</a>
<br><a href="InfosPersonnellesAnnonceur.php">Mes données personnelles</a>
	
<?php
echo '</div> </h4>';
include_once 'footer.inc';
?>