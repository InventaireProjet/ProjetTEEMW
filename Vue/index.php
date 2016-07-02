<?php
require_once '../Model/class.Annonceur.php';
require_once '../Model/class.Transporteur.php';
require_once '../Controller/login.php';
include_once 'header.inc';

$msg = isset ( $_SESSION ['msg'] ) ? '<span class="error">*' . $_SESSION ['msg'] . '</span>' : '';
$msgA = isset ( $_SESSION ['msgA'] ) ? '<span class="error">*' . $_SESSION ['msgA'] . '</span>' : '';
$msgT = isset ( $_SESSION ['msgT'] ) ? '<span class="error">*' . $_SESSION ['msgT'] . '</span>' : '';

//Si une session est en cours, elle est fermée
if (isset ( $_SESSION ['transporteur'] ) || isset ( $_SESSION ['annonceur'] )) {
	logout ();
}
?>


<div class="container">
<?php if($msg) echo $msg;?>
	<div class="row">
		<div class="col-md-6">
			<img class="img-circle"
				src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw=="
				alt="Generic placeholder image" width="100" height="100">

			<h4>Transporteur</h4>
			<div>

				<form method="post" action="../Controller/login.php"> 
				<?php if($msgT) echo $msgT;?>
  
  			<table class="table" align="center">


						<tr>
							<td>Nom d'utilisateur:</td>
							<td><input type="text" name="NomUtilisateur"></td>
						</tr>
						<tr>
							<td>Mot de passe:</td>
							<td><input type="password" name="MotDePasse"></td>
						</tr>

						<tr>
							<td colspan="2" align="right"><button class="btn btn-default"
									type="submit" name="action" value="connecterTransporteur">Se
									connecter en tant que transporteur</td>
						</tr>

					</table>

				</form>
				<br /> <a href="InscriptionTransporteur.php">S'inscrire en tant que
					transporteur</a>
 <?php
	
	if (isset ( $_SESSION ['transporteur'] )) {
		$user = $_SESSION ['transporteur'];
		?> 
&nbsp;&nbsp;&nbsp;<a href="../Controller/login.php?action=logout">Logout 
(<?php echo $user->NomSociete;?>)</a> 

<?php
	}
	?>

			</div>

		</div>
		<div class="col-md-6">
			<img class="img-circle"
				src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw=="
				alt="Generic placeholder image" width="100" height="100">

			<h4>Annonceur</h4>
			<div>
				<form method="post" action="../Controller/login.php"> 
				<?php if($msgA) echo $msgA;?>
  
  <table class="table" align="center">

						<tr>
							<td>Nom d'utilisateur:</td>
							<td><input type="text" name="NomUtilisateur"></td>
						</tr>

						<tr>
							<td>Mot de passe:</td>
							<td><input type="password" name="MotDePasse"></td>
						</tr>

						<tr>
							<td colspan="2" align="right"><button class="btn btn-default"
									type="submit" name="action" value="connecterAnnonceur">Se
									connecter en tant qu'annonceur</td>
						</tr>



					</table>

				</form>
				<br /> <a href="InscriptionAnnonceur.php">S'inscrire en tant
					qu'annonceur</a>


 <?php
	
	if (isset ( $_SESSION ['annonceur'] )) {
		$user = $_SESSION ['annonceur'];
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
unset ( $_SESSION ['msgA'] );
unset ( $_SESSION ['msgT'] );
include_once 'footer.inc';
?>