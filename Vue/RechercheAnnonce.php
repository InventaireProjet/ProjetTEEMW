<?php
include_once 'header.inc';

$msg = isset ( $_SESSION ['msg'] ) ? '<span class="error">*' . $_SESSION ['msg'] . '</span>' : '';
if ($msg)
	echo $msg;
?>
<div class="container">

	<h4>Annonces correspondant à votre profil</h4>

	


<br><a href="AccueilTransporteur.php">Revenir à l'accueil</a>
</div> 	
</div>
<?php
include_once 'footer.inc';
?>