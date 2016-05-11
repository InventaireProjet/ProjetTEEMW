<?php
require_once '../Controller/fonctionsGenerales.php';
include_once 'header.inc';
controleLogin();
$msg = isset ( $_SESSION ['msg'] ) ? '<span class="error">*' . $_SESSION ['msg'] . '</span>' : '';
if($msg) echo $msg;?>


	<div class="container">

		<h4>Accueil Annonceur</h4>


	</div>
<?php
include_once '../Vue/footer.inc';  