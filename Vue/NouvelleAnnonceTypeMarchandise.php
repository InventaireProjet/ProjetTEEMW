<?php
require_once '../Model/class.TypeTransport.php';
require_once '../Controller/fonctionsGenerales.php';
include_once 'header.inc';
$rank = isset ( $_SESSION ['rank'] ) ? $_SESSION ['rank'] : 0;
$msg = isset ( $_SESSION ['msg'] ) ? '<span class="error">*' . $_SESSION ['msg'] . '</span>' : '';
$form_data = isset ( $_SESSION ['formNouvMarchandise_data'] ) ? $_SESSION ['formNouvMarchandise_data'] : array (
		'',
		'',
		'',
		'',
		'' 
);

// En cas d'erreur d'enregistrement, affichage en sommet de page
if ($_SESSION ['msg'] = null && strcmp ( $_SESSION ['msg'], 'Echec de l\'enregistrement de l\'annonce' ) == 0) {
	echo $msg;
}
?>
<div class="container">

	<h4>


		<form method="post" action="../Controller/enregistrerAnnonce.php">

			<table class="table">

				<tr>
					<td>Type de transport :</td>
					<td><select name="Type">; 
<?php
// Récupération des types de transport
$typesTransport = afficherTypeTransport ();
echo '<option value="">Choisissez un type de transport</option>';
// Entrée des options de la dropdownlist
foreach ( $typesTransport as $valeur ) {
	
	// Si un choix a déjà été effectué durant la session, il est sélectionné par défaut
	if (strcmp ( $form_data [0], $valeur ['IDTypeTransport'] ) == 0) {
		
		echo '<option value="' . $valeur ['IDTypeTransport'] . '" selected>' . $valeur ['Nom'] . '</option>';
	} else {
		echo '<option value="' . $valeur ['IDTypeTransport'] . '">' . $valeur ['Nom'] . '</option>';
	}
}
?>
</td>
					</select>
					<td> <?php if($rank==1) echo $msg;?></td>
				</tr>
				<tr>
					<td>Description de la marchandise :</td>
					<td><input type="text" name="Description"
						value="<?php
						echo $form_data [1];
						?>"> 
    <?php if($rank==2) echo $msg;?></td>
				</tr>
				<tr>
					<td>Quantité :</td>
					<td><input type="number" min=0 name="Quantite"
						value="<?php
						echo $form_data [2];
						?>"> 
    <?php if($rank==3) echo $msg;?></td>
				</tr>
				<tr>
					<td>Volume (litres) :</td>
					<td><input type="number" min=0 name="Volume"
						value="<?php
						echo $form_data [3];
						?>"> 
    <?php if($rank==4) echo $msg;?></td>
				</tr>
				<tr>
					<td>Poids (kg) :</td>
					<td><input type="number" min=0 name="Poids"
						value="<?php
						echo $form_data [4];
						?>"> 
    <?php if($rank==5) echo $msg;?></td>
				</tr>


				<tr>
					<td colspan="2" align="left"><input type="submit" name="action"
						value="Valider l'annonce"></td>
				</tr>
			</table>
		</form>

		<a href="NouvelleAnnonceTypeTransport.php">Revenir à la première
			partie de l'annonce</a> <br /> <a href="AccueilAnnonceur.php">Accueil
			anonceur</a>

	</h4>


</div>

<?php
include_once 'footer.inc';  