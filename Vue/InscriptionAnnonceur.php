<?php
include_once 'header.inc';

$rank = isset ( $_SESSION ['rank'] ) ? $_SESSION ['rank'] : 0;
$msg = isset ( $_SESSION ['msg'] ) ? '<span class="error">*' . $_SESSION ['msg'] . '</span>' : '';
$form_data = isset ( $_SESSION ['form_data'] ) ? $_SESSION ['form_data'] : array (
		'',
		'',
		'',
		'',
		'',
		'',
		'',
		''
);

?>
<div class="container">

	<h4>
		<form method="post" action="../Controller/login.php"> 
  <?php if($rank=='top') echo $msg;?>
  <table>
				<tr>
					<td>First name:</td>
					<td><input type="text" name="firstname"
						value="<?php
						echo $form_data [0];
						?>"> 
    <?php if($rank==1) echo $msg;?></td>
				</tr>
				<tr>
					<td>Last name:</td>
					<td><input type="text" name="lastname"
						value="<?php
						echo $form_data [1];
						?>"> 
    <?php if($rank==2) echo $msg;?></td>
				</tr>
				<tr>
					<td>User name:</td>
					<td><input type="text" name="username"
						value="<?php
						echo $form_data [2];
						?>"> 
    <?php if($rank==3) echo $msg;?></td>
				</tr>
				<tr>
					<td>Password:</td>
					<td><input type="password" name="password"
						value="<?php
						echo $form_data [3];
						?>"> 
	<?php if($rank==4) echo $msg;?></td>
				</tr>
				<tr>
					<td>Phone:</td>
					<td><input type="text" name="phone"
						value="<?php
						echo $form_data [4];
						?>"> 
	<?php if($rank==5) echo $msg;?></td>
				</tr>
				<tr>
					<td>Email:</td>
					<td><input type="text" name="Email"
						value="<?php
						echo $form_data [5];
						?>"> 
	<?php if($rank==6) echo $msg;?></td>
				</tr>
				<tr>
					<td>Adress:</td>
					<td><input type="text" name="adress"
						value="<?php
						echo $form_data [6];
						?>"> 
	<?php if($rank==7) echo $msg;?></td>
				</tr>
				<tr>
					<td>IBAN:</td>
					<td><input type="text" name="IBAN"
						value="<?php
						echo $form_data [7];
						?>"> 
    <?php if($rank==8) echo $msg;?></td>
				</tr>
				<tr>
					<td colspan="2" align="right"><input type="submit" name="action"
						value="enregistrerAnnonceur"></td>
				</tr>
			</table>
		</form>
		<br /> <a href="index.php">Login</a>
	</h4>
</div>
<?php
include_once 'footer.inc';  