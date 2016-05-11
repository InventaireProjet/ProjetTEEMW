<?php
include_once 'header.inc';

$msg = isset ( $_SESSION ['msg'] ) ? '<span class="error">*' . $_SESSION ['msg'] . '</span>' : '';
if ($msg)
	echo $msg;
?>
<div class="container">

	<h4>Accueil Transporteur</h4>


</div>
<?php
include_once 'footer.inc';
?>
