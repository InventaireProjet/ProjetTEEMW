<?php
require_once '../Model/class.Annonceur.php';
require_once '../Model/class.Transporteur.php';
include_once 'header.inc';

$msg = isset ( $_SESSION ['msg'] ) ? '<span class="error">*' . $_SESSION ['msg'] . '</span>' : '';

?>


<div class="container">
	<div class="row">
		<div class="col-md-6">
			<img class="img-circle"
				src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw=="
				alt="Generic placeholder image" width="100" height="100">

			<h4>Transporteur</h4>
			<div>
			
		<form method="post" action="../Controller/login.php"> 
				<?php if($msg) echo $msg;?>
  
  <table align="center">
				<tr>
					<td>Nom d'utilisateur:</td>
					<td><input type="text" name="NomUtilisateur"></td>
				</tr>
				
				<tr>
					<td>Mot de passe:</td>
					<td><input type="password" name="MotDePasse"></td>
				</tr>
				<tr></tr>
				<tr>
					<td colspan="2" align="right"><button type="submit" name="action"
						value="connecterTransporteur">connexion</td>
				</tr>
			</table>

		</form>
		<br /> <a href="InscriptionTransporteur.php">Register</a>


			</div>

		</div>
		<div class="col-md-6">
			<img class="img-circle"
				src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw=="
				alt="Generic placeholder image" width="100" height="100">

			<h4>Annonceur</h4>
			<div>
				<form method="post" action="../Controller/login.php"> 
				<?php if($msg) echo $msg;?>
  
  <table align="center">
				<tr>
					<td>Nom d'utilisateur:</td>
					<td><input type="text" name="NomUtilisateur"></td>
				</tr>
				<tr>
					<td>Mot de passe:</td>
					<td><input type="password" name="MotDePasse"></td>
				</tr>
				<tr>
					<td colspan="2" align="right"><input type="submit" name="action"
						value="connecterAnnonceur"></td>
				</tr>
			</table>

		</form>
		<br /> <a href="InscriptionAnnonceur.php">Register</a>


 <?php
	
	if (isset ( $_SESSION ['user'] )) {
		$user = $_SESSION ['user'];
		?> 
&nbsp;&nbsp;&nbsp;<a href="../Controller/login.php?action=logout">Logout 
(<?php echo $user->Prenom .' '. $user->Nom;?>)</a> 

<?php	
}
?>

			</div>
		</div>



	</div>

</div>


<?php
include_once 'footer.inc';
?>