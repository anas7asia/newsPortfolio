
<?php 
require_once 'inc/connect.php';
include_once 'inc/header.php'; 
require_once 'inc/functions.php'; 
?>

	<h2 class="page-title">Modifier l'user</h2>

		<form method="post">
			<table>

				<tr>
					<td class="form-label"><label for="lastname">Nom</label></td>
					<td><input type="text" name="lastname" id="lastname" placeholder="Nom"></td>
				</tr>

				<tr>
					<td class="form-label"><label for="firstname">Prénom</label></td>
					<td><input type="text" name="firstname" id="firstname" placeholder="Prenom"></td>
				</tr>

				<tr>
					<td class="form-label"><label for="email">Email</label></td>
					<td><input type="email" name="email" id="email" placeholder="Email"></td>
				</tr>

				<tr>
					<td class="form-label"><label for="phone">Phone</label></td>
					<td><input type="tel" name="phone" id="phone" placeholder="Numero"></td>
				</tr>

				<tr>
					<td></td>
					<td><input type="submit" value="Ajouter"></td>
				</tr>
			</table>
		</form>
	
<?php 

	$post = array();
	$errors = array();

	if(!empty($_POST)) {

		$post = cleanInput($_POST);
		$errors = checkErrorsForUser($post);

		if(count($errors) > 0){
			showErrors($errors);
		}
		else {
			editSidebarUser($post);
		}

	}

?>

<?php 
include_once 'inc/sidebar.php'; 
include_once 'inc/footer.php'; 
?>	