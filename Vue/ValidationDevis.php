<?php
require_once '../Model/class.Transporteur.php';
require_once '../Model/class.Devis.php';
include_once '../Vue/header.inc';

$rank = isset ( $_SESSION ['rank'] ) ? $_SESSION ['rank'] : 0;
$msg = isset ( $_SESSION ['msg'] ) ? '<span class="error">*' . $_SESSION ['msg'] . '</span>' : '';
$form_data = isset ( $_SESSION ['formNouvDevis_data'] ) ? $_SESSION ['formNouvDevis_data'] : array (
		'',
		'',
		'' 
);
$idAnnonce = $_POST ['idAnnonce'];
?>


<div class="container">

	<h4>

		<form method="post" action="../Controller/enregistrerDevis.php">

			<table>
				<tr>
					<td>Prix:</td>
					<td><input type="text" name="Prix"
						value="<?php
						echo $form_data [0];
						?>"> 
    <?php if($rank==1) echo $msg;?></td>
				</tr>
				<tr>
					<td>Date d'expiration (format jj/mm/aaaa) :</td>
					<td><input type="datetime" name="DateExpiration"
						value="<?php
						echo $form_data [1];
						?>"> 
    <?php if($rank==2) echo $msg;?></td>
				</tr>

				<tr>
					<td>Description :</td>
					<td><input type="text" name="Description"
						value="<?php
						echo $form_data [2];
						?>"> 
    <?php if($rank==3) echo $msg;?></td>
				</tr>
				<tr>
					<td colspan="2" align="left">
					<input type="hidden" name="idAnnonce" value="<?php echo $idAnnonce ?>">
					<input type="submit" name="action"
						value="Soumettre le devis"></td>
				</tr>
			</table>
		</form>
		<br /> <a href="../Vue/AccueilTransporteur.php">Accueil transporteur</a>

	</h4>


</div>
<?php
include_once '../Vue/footer.inc';  