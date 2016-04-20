<?php
require_once '../Model/class.Annonceur.php';
include_once 'header.inc';

$msg = isset ( $_SESSION ['msg'] ) ? '<span class="error">*' . $_SESSION ['msg'] . '</span>' : '';

?>
<form method="post" action="../Controller/login.php"> 
<?php if($msg) echo $msg;?>
  <table>
		<tr>
			<td>User:</td>
			<td><input type="text" name="usr"></td>
		</tr>
		<tr>
			<td>Password:</td>
			<td><input type="password" name="pwd"></td>
		</tr>
		<tr>
			<td colspan="2" align="right"><input type="submit" name="action"
				value="Login"></td>
		</tr>
	</table> 
 
</form>
<br />
<a href="register.php">Register</a>
 <?php
		
if (isset ( $_SESSION ['user'] )) {
			$user = $_SESSION ['user'];
			?> 
&nbsp;&nbsp;&nbsp;<a href="../Controller/login.php?action=logout">Logout 
(<?php echo $user->firstname .' '. $user->lastname;?>)</a> 
<?php }



include_once 'footer.inc';
?>