<?php
require_once 'database/class.Annonce.php';
include_once 'header.inc';


?>
<form method="post" action="enregistrerAnnonce.php"> 

  <table>
		<tr>
			<td>Nom:</td>
			<td><input type="text" name="Nom"
				> 
 </td>
		</tr>
		<tr>
			<td>Date de Départ:</td>
			<td><input type="datetime" name="DateDepart"
				</td>
		</tr>
		<tr>
			<td>Date d'arrivée :</td>
			<td><input type="datetime" name="DateArrivee"
				</td>
		</tr>
		<tr>
			<td>Adresse de départ :</td>
			<td><input type="text" name="AdresseDepart"
				</td>
		</tr>
		<tr>
			<td>Adresse d'arrivée :</td>
			<td><input type="text" name="AdresseArrivee"
				</td>
		</tr>
		
		<tr>
			<td colspan="2" align="right"><input type="submit" name="action"
				value="Entrer les données sur la marchandise"></td>
		</tr>
	</table>
</form>
<br />
<a href="">Accueil anonceurs</a>

<?php
include_once 'footer.inc';  