<?php
require_once '../Model/class.Annonce.php';
include_once '../Vue/header.inc';

$rank = isset ( $_SESSION ['rank'] ) ? $_SESSION ['rank'] : 0;
$msg = isset ( $_SESSION ['msg'] ) ? '<span class="error">*' . $_SESSION ['msg'] . '</span>' : '';
$form_data = isset ( $_SESSION ['formNouvTransport_data'] ) ? $_SESSION ['formNouvTransport_data'] : array (
		'',
		'',
		'',
		'',
		'' 
);
?>
<form method="post" action="../Controller/enregistrerAnnonce.php">

	<table>
		<tr>
			<td>Nom:</td>
			<td><input type="text" name="Nom" value="<?php
			echo $form_data [0];
			?>"> 
    <?php if($rank==1) echo $msg;?></td>
		</tr>
		<tr>
			<td>Date de Départ:</td>
			<td><input type="datetime" name="DateDepart" value="<?php
			echo $form_data [1];
			?>"> 
    <?php if($rank==2) echo $msg;?></td>
		</tr>
		<tr>
			<td>Date d'arrivée :</td>
			<td><input type="datetime" name="DateArrivee"
				value="<?php
				echo $form_data [2];
				?>"> 
    <?php if($rank==3) echo $msg;?></td>
		</tr>
		<tr>
			<td>Adresse de départ :</td>
			<td><input type="text" name="AdresseDepart"
				value="<?php
				echo $form_data [3];
				?>"> 
    <?php if($rank==4) echo $msg;?></td>
		</tr>
		<tr>
			<td>Adresse d'arrivée :</td>
			<td><input type="text" name="AdresseArrivee"
				value="<?php
				echo $form_data [4];
				?>"> 
    <?php if($rank==5) echo $msg;?></td>
		</tr>
		<tr>
			<td colspan="2" align="right"><input type="submit" name="action"
				value="Entrer les données sur le transport"></td>
		</tr>
	</table>
</form>
<br />
<a href="../Vue/AccueilAnnonceur.php">Accueil anonceurs</a>

<?php
include_once '../Vue/footer.inc';  