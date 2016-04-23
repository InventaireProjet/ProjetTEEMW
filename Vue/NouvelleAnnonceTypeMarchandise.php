<?php
require_once '../Model/class.TypeTransport.php';
include_once 'header.inc';
$rank = isset ( $_SESSION ['rank'] ) ? $_SESSION ['rank'] : 0;
$msg = isset ( $_SESSION ['msg'] ) ? '<span class="error">*' . $_SESSION ['msg'] . '</span>' : '';
$form_data = isset ( $_SESSION ['formNouvMarchandise_data'] ) ? $_SESSION ['formNouvMarchandise_data'] : array (
		'',
		'',
		'',
		'' ,
		'' 
);

?>
<form method="post" action="../Controller/enregistrerAnnonce.php">

	<table>
	
	<tr>
			<td>Type de transport :</td>
			<td><input type="text" name="Type" value="<?php
			echo $form_data [0];
			?>"> 
    <?php if($rank==1) echo $msg;?></td>
		</tr>
		<tr>
			<td>Description de la marchandise :</td>
			<td><input type="text" name="Description" value="<?php
			echo $form_data [1];
			?>"> 
    <?php if($rank==2) echo $msg;?></td>
		</tr>
		<tr>
			<td>Quantité :</td>
			<td><input type="number" min=0 name="Quantite" value="<?php
			echo $form_data [2];
			?>"> 
    <?php if($rank==3) echo $msg;?></td>
		</tr>
		<tr>
			<td>Volume (litres) :</td>
			<td><input type="number" min=0 name="Volume" value="<?php
			echo $form_data [3];
			?>"> 
    <?php if($rank==4) echo $msg;?></td>
		</tr>
		<tr>
			<td>Poids (grammes) :</td>
			<td><input type="number" min=0 name="Poids"
				value="<?php
				echo $form_data [4];
				?>"> 
    <?php if($rank==5) echo $msg;?></td>
		</tr>


		<tr>
			<td colspan="2" align="right"><input type="submit" name="action"
				value="Valider l'annonce"></td>
		</tr>
	</table>
</form>
<br />
<a href="AccueilAnnonceur.php">Accueil anonceurs</a>
<a href="NouvelleAnnonceTypeTransport.php">Revenir à la première partie
	de l'annonce</a>

<?php
include_once 'footer.inc';  