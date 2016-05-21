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
		''
		);

?>
<div class="container">

	<h4>
		<form method="post" action="../Controller/login.php"> 
  <?php if($rank=='top') echo $msg;?>
  <table>
				<tr>
					<td>Nom de la société:</td>
					<td><input type="text" name="NomSociete"
						value="<?php
						echo $form_data [0];
						?>"> 
    <?php if($rank==1) echo $msg;?></td>
				</tr>
				<tr>
					<td>Numéro de téléphone:</td>
					<td><input type="text" name="Telephone"
						value="<?php
						echo $form_data [1];
						?>"> 
    <?php if($rank==2) echo $msg;?></td>
				</tr>
				<tr>
					<td>Adresse email:</td>
					<td><input type="text" name="Email"
						value="<?php
						echo $form_data [2];
						?>"> 
    <?php if($rank==3) echo $msg;?></td>
				</tr>
				<tr>
					<td>Nom d'utilisateur:</td>
					<td><input type="text" name="Utilisateur"
						value="<?php
						echo $form_data [3];
						?>"> 
	<?php if($rank==4) echo $msg;?></td>
				</tr>
				<tr>
					<td>Mot de passe:</td>
					<td><input type="password" name="MotDePasse"
						value="<?php
						echo $form_data [4];
						?>"> 
	<?php if($rank==5) echo $msg;?></td>
				</tr>
				<tr>
					<td>Adresse:</td>
					<td><input type="text" name="Adresse"
						value="<?php
						echo $form_data [5];
						?>"> 
	    <?php if($rank==8) echo $msg;?></td>
				</tr>
				<tr>
					<td colspan="2" align="right"><button type="submit" name="action"
						value="enregistrerTransporteur">Inscription</td>
				</tr>
			</table>
		</form>
		<br /> <a href="index.php">Login</a>
	</h4>
</div>
<?php
include_once 'footer.inc';  