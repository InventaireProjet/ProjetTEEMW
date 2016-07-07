<?php
require_once '../Model/class.Annonce.php';
require_once '../Controller/fonctionsGenerales.php';
include_once '../Vue/header.inc';
$rank = isset ( $_SESSION ['rank'] ) ? $_SESSION ['rank'] : 0;
$msg = isset ( $_SESSION ['msg'] ) ? '<span class="error">*' . $_SESSION ['msg'] . '</span>' : '';
$form_data = isset ( $_SESSION ['formNouvTransport_data'] ) ? $_SESSION ['formNouvTransport_data'] : array (
		'',
		'',
		'',
		'',
		'',
		'',
		'',
		'',
		'',
		'',
		'',
		'',
		'',
		'',
		'' 
);
?>

<div class="container">

	<h4>
		<form method="post" action="../Controller/enregistrerAnnonce.php">

			<table class="table">
				<tr>
					<td>Nom:</td>
					<td><input type="text" name="Nom"
						value="<?php
						echo $form_data [0];
						?>"> 
    <?php if($rank==1) echo $msg;?></td>
				</tr>
				<tr>
					<td>Date de départ (format jj/mm/aaaa) :</td>
					<td><input type="datetime" name="DateDepart"
						value="<?php
						echo $form_data [1];
						?>"> <?php if($rank==2) echo $msg;?></td>
				</tr>
				<tr>
					<td>Heure de départ :</td>
					<td><input type="number" min="0" max="23" name="HeureDepart"
						value="<?php
						echo $form_data [11];
						?>"> h <input type="number" min=0 max=59 name="MinutesDepart"
						value="<?php
						echo $form_data [12];
						?>"></td>

				</tr>
				<tr>
					<td>Adresse de départ :</td>
					<td><input type="text" name="AdresseDepart"
						value="<?php
						echo $form_data [2];
						?>"> 
    <?php if($rank==3) echo $msg;?></td>
				</tr>
				<tr>
					<td>NPA de départ :</td>
					<td><input type="text" name="NPADepart"
						value="<?php
						echo $form_data [3];
						?>"> 
    <?php if($rank==4) echo $msg;?></td>
				</tr>
				<tr>
					<td>Localité de départ :</td>
					<td><input type="text" name="LocaliteDepart"
						value="<?php
						echo $form_data [4];
						?>"> 
    <?php if($rank==5) echo $msg;?></td>
				</tr>
				<tr>
					<td>Pays de départ :</td>
					<td><select name="PaysDepart">
			<?php
			// Récupération des pays
			$pays = listePays ();
			echo '<option value="">Choisissez un pays</option>';
			// Entrée des options de la dropdownlist
			foreach ( $pays as $valeur ) {
				
				// Si un choix a déjà été effectué durant la session, il est sélectionné par défaut
				if (strcmp ( $form_data [5], $valeur ) == 0) {
					
					echo '<option value="' . $valeur . '" selected>' . $valeur . '</option>';
				} else {
					echo '<option value="' . $valeur . '">' . $valeur . '</option>';
				}
			}
			?>
		</select>
		<?php if($rank==6) echo $msg;?></td>
				</tr>
				<tr>
					<td>Date d'arrivée (format jj/mm/aaaa) :</td>
					<td><input type="datetime" name="DateArrivee"
						value="<?php
						echo $form_data [6];
						?>"> 
    <?php if($rank==7) echo $msg;?></td>
				</tr>
				<tr>
					<td>Heure d'arrivée :</td>
					<td><input type="number" min="0" max="23" name="HeureArrivee"
						value="<?php
						echo $form_data [13];
						?>"> h <input type="number" min=0 max=59 name="MinutesArrivee"
						value="<?php
						echo $form_data [14];
						?>"></td>

				</tr>
				<tr>
					<td>Adresse d'arrivée :</td>
					<td><input type="text" name="AdresseArrivee"
						value="<?php
						echo $form_data [7];
						?>"> 
    <?php if($rank==8) echo $msg;?></td>
				</tr>
				<tr>
					<td>NPA d'arrivée :</td>
					<td><input type="text" name="NPAArrivee"
						value="<?php
						echo $form_data [8];
						?>"> 
    <?php if($rank==9) echo $msg;?></td>
				</tr>
				<tr>
					<td>Localité d'arrivée :</td>
					<td><input type="text" name="LocaliteArrivee"
						value="<?php
						echo $form_data [9];
						?>"> 
    <?php if($rank==10) echo $msg;?></td>
				</tr>
				<tr>
					<td>Pays d'arrivée :</td>
					<td><select name="PaysArrivee">
	<?php
	// Récupération des pays
	$pays = listePays ();
	echo '<option value="">Choisissez un pays</option>';
	// Entrée des options de la dropdownlist
	foreach ( $pays as $valeur ) {
		
		// Si un choix a déjà été effectué durant la session, il est sélectionné par défaut
		if (strcmp ( $form_data [10], $valeur ) == 0) {
			
			echo '<option value="' . $valeur . '" selected>' . $valeur . '</option>';
		} else {
			echo '<option value="' . $valeur . '">' . $valeur . '</option>';
		}
	}
	?>
				</select>
    <?php if($rank==11) echo $msg;?></td>
				</tr>
				<tr>
					<td colspan="2" align="left"><input type="submit" name="action"
						value="Entrer les données sur le transport"></td>
				</tr>
			</table>
		</form>
		<br /> <a href="../Vue/AccueilAnnonceur.php">Accueil anonceur</a>


	</h4>


</div>

<?php
include_once '../Vue/footer.inc';  