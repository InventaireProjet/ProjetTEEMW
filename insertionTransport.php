<?php
require_once 'database/class.Marchandise.php';
include_once 'header.inc';


?>
<form method="post" action="enregistrerAnnonce.php"> 

  <table>
		<tr>
			<td>Description de la marchandise :</td>
			<td><input type="text" name="Description"
				> 
 </td>
		</tr>
		<tr>
			<td>Quantité :</td>
			<td><input type="number" min=0 name="Quantite"
				</td>
		</tr>
		<tr>
			<td>Volume (litres) :</td>
			<td><input type="number" min=0 name="Volume"
				</td>
		</tr>
		<tr>
			<td>Poids (grammes) :</td>
			<td><input type="number" min=0 name="Poids"
				</td>
		</tr>
		
		
		<tr>
			<td colspan="2" align="right"><input type="submit" name="action"
				value="Valider l'annonce"></td>
		</tr>
	</table>
</form>
<br />
<a href="">Accueil anonceurs</a> 
<a  href="insertionAnnonce.php">Revenir à la première partie de l'annonce</a>

<?php
include_once 'footer.inc';  