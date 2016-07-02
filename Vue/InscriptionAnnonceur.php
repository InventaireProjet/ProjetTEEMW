<?php
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
		'' 
);

?>
<div class="container">
	<div class="aligncentre">
		<h4>
			<form method="post" action="../Controller/login.php"> 
 
  <table class="table">
					<tr>
						<td>Prénom:</td>
						<td><input type="text" name="Prenom"
							value="<?php
							echo $form_data [0];
							?>"> 
    <?php if($rank==1) echo $msg;?></td>
					</tr>
					<tr>
						<td>Nom:</td>
						<td><input type="text" name="Nom"
							value="<?php
							echo $form_data [1];
							?>"> 
    <?php if($rank==2) echo $msg;?></td>
					</tr>
					<tr>
						<td>Nom d'utilisateur:</td>
						<td><input type="text" name="NomUtilisateur"
							value="<?php
							echo $form_data [2];
							?>"> 
   <?php if($rank==3) echo $msg;?></td>
					</tr>
					<tr>
						<td>Mot de passe:</td>
						<td><input type="text" name="Mdp"
							value="<?php
							echo $form_data [3];
							?>"> 
	<?php if($rank==4) echo $msg;?></td>
					</tr>
					<tr>
						<td>Téléphone:</td>
						<td><input type="text" name="Telephone"
							value="<?php
							echo $form_data [4];
							?>"> 
	<?php if($rank==5) echo $msg;?></td>
					</tr>
					<tr>
						<td>Email:</td>
						<td><input type="text" name="Email"
							value="<?php
							echo $form_data [5];
							?>"> 
	<?php if($rank==6) echo $msg;?></td>
					</tr>
					<tr>
						<td>Adresse:</td>
						<td><input type="text" name="Adresse"
							value="<?php
							echo $form_data [6];
							?>"> 
	<?php if($rank==7) echo $msg;?></td>
					</tr>

					<tr>
						<td colspan="2" align="left"><button class="btn btn-default"
								type="submit" name="action" value="enregistrerAnnonceur">Inscription</td>
					</tr>
				</table>
			</form>
			<br /> <a href="index.php">Accueil</a>
		</h4>
	</div>
</div>
<?php
include_once 'footer.inc';  