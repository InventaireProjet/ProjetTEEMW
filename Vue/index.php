<?php
require_once '../Model/class.Annonceur.php';
include_once 'header.inc';

$msg = isset ( $_SESSION ['msg'] ) ? '<span class="error">*' . $_SESSION ['msg'] . '</span>' : '';

?>
<div class="container">
	<h4>
		<form method="post" action="../Controller/login.php"> 
<?php if($msg) echo $msg;?>
  <table>
				<tr>
					<td>Nom d'utilisateur:</td>
					<td><input type="text" name="usr"></td>
				</tr>
				<tr>
					<td>Mot de passe:</td>
					<td><input type="password" name="pwd"></td>
				</tr>
				<tr>
					<td colspan="2" align="right"><input type="submit" name="action"
						value="Login"></td>
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
	echo '</div> </h4>';
include_once 'footer.inc';
?>