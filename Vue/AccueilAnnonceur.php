<?php
require_once '../Model/class.Annonceur.php';
require_once '../Controller/';
include_once 'header.inc';

$msg = isset ( $_SESSION ['msg'] ) ? '<span class="error">*' . $_SESSION ['msg'] . '</span>' : '';

?>
<?php if($msg) echo $msg;?>
<div class="container">
	<h4>Accueil Annonceur</h4>
	
	<?php echo aff ?>
	
	
	
	
	
	
	
	
	
	
	
	
	
		
<br /> <a href="NouvelleAnnonceTypeTransport.php">Insérer une annonce</a>
<br /> 
<a href="../Controller/login.php?action=logout">Logout 
(<?php 
$user = $_SESSION ['annonceur'];
echo $user->Prenom .' '. $user->Nom;?>)</a> 
<?php
	echo '</div> </h4>';
include_once 'footer.inc';
?>