<?php
require_once '../Controller/fonctionsGenerales.php';
include_once 'header.inc';

$rank = isset ( $_SESSION ['rank'] ) ? $_SESSION ['rank'] : 0;
$msg = isset ( $_SESSION ['msg'] ) ? '<span class="error">*' . $_SESSION ['msg'] . '</span>' : '';
$form_data = isset ( $_SESSION ['form_data'] ) ? $_SESSION ['form_data'] : array (
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
//Si une session est en cours, elle est fermée
if (isset ( $_SESSION ['transporteur'] ) || isset ( $_SESSION ['annonceur'] )) {
	logout ();
}
?>
<div class="container">
	<div class="aligncentre">
		<h4><a href="index.php">Accueil</a> </h4><br>
	
		<h4>
			<form method="post" action="../Controller/login.php"> 
  <?php if($rank=='top') echo $msg;?>
  <table class="table">
					<tr>
						<td>Nom de la société :</td>
						<td><input type="text" name="NomSociete"
							value="<?php
							echo $form_data [0];
							?>"> 
    <?php if($rank==1) echo $msg;?></td>
					</tr>
					<tr>
						<td>Numéro de téléphone :</td>
						<td><input type="text" name="Telephone"
							value="<?php
							echo $form_data [1];
							?>"> 
    <?php if($rank==2) echo $msg;?></td>
					</tr>
					<tr>
						<td>Adresse email :</td>
						<td><input type="text" name="Email"
							value="<?php
							echo $form_data [2];
							?>"> 
    <?php if($rank==3) echo $msg;?></td>
					</tr>
					<tr>
						<td>Nom d'utilisateur :</td>
						<td><input type="text" name="Utilisateur"
							value="<?php
							echo $form_data [3];
							?>"> 
	<?php if($rank==4) echo $msg;?></td>
					</tr>
					<tr>
						<td>Mot de passe :</td>
						<td><input type="password" name="MotDePasse"
							value="<?php
							echo $form_data [4];
							?>"> 
	<?php if($rank==5) echo $msg;?></td>
					</tr>
					<tr>
						<td>Adresse :</td>
						<td><input type="text" name="Adresse"
							value="<?php
							echo $form_data [5];
							?>"> 
	    <?php if($rank==6) echo $msg;?></td>
					</tr>
					
					<tr>
					<td>NPA :</td>
					<td><input type="text" name="NPA"
						value="<?php
						echo $form_data [6];
						?>"> 
    <?php if($rank==7) echo $msg;?></td>
				</tr>
				<tr>
					<td>Localité :</td>
					<td><input type="text" name="Localite"
						value="<?php
						echo $form_data [7];
						?>"> 
    <?php if($rank==8) echo $msg;?></td>
				</tr>
				<tr>
					<td>Pays :</td>
					<td><select name="Pays">
			<?php
			// Récupération des pays
			$pays = listePays ();
			echo '<option value="">Choisissez un pays</option>';
			// Entrée des options de la dropdownlist
			foreach ( $pays as $valeur ) {
				
				// Si un choix a déjà été effectué durant la session, il est sélectionné par défaut
				if (strcmp ( $form_data [8], $valeur ) == 0) {
					
					echo '<option value="' . $valeur . '" selected>' . $valeur . '</option>';
				} else {
					echo '<option value="' . $valeur . '">' . $valeur . '</option>';
				}
			}
			?>
		</select>
		<?php if($rank==9) echo $msg;?></td>
				</tr>
					<tr>
						<td>IBAN :</td>
						<td><input type="text" name="IBAN"
							value="<?php
							echo $form_data [9];
							?>"> 
    <?php if($rank==10) echo $msg;?></td>
					</tr>

					<tr>
					<?php $typesTransport=afficherTypeTransport()?>
						<td>Types de transport proposés :</td>
						<td>
						<?php foreach ($typesTransport as $typeTransport) {
						$affichageTransport= '<input type="checkbox" name="typesTransport[]"
							value="' . $typeTransport['IDTypeTransport'] .'"> ' . $typeTransport['Nom'] .'<br>';
						echo $affichageTransport;
						}
						if($rank==11) echo $msg;?>						
					</td></tr>


					<tr>
						<td colspan="2" align="left"><button class="btn btn-default"
								type="submit" name="action" value="enregistrerTransporteur">Inscription</td>
					</tr>
				</table>
			</form>
		
		</h4>

	</div>
</div>
<?php
include_once 'footer.inc';  