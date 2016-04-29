
<?php 
require_once 'inc/connect.php'; 
include_once 'inc/header.php'; 
require_once 'inc/functions.php'; 
?>

	<h2 class="page-title">Ajouter un nouvel article</h2>

		<form method="post">
			<table>
				<tr>
					<td class="form-label"><label for="title">Titre</label></td>
					<td><input type="text" name="title" id="title" placeholder="Titre"></td>
				</tr>

				<tr>
					<td class="form-label"><label for="link">Lien vers image</label></td>
					<td><input type="text" name="link" id="link" placeholder="Lien"></td>
				</tr>

				<tr>
					<td class="form-label label-textarea"><label for="content">Text</label></td>
					<td><textarea rows="10" name="content" id="content" placeholder="Contenu"></textarea></td>
				</tr>

				<tr>
					<td></td>
					<td><input type="submit"></td>
				</tr>
			</table>
		</form>
	
<?php 

$post = array();
$errors = array();

if(!empty($_POST)) {

	$post = cleanInput($_POST);
	$errors = checkErrors($post);

	if(count($errors) > 0){
		showErrors($errors);
	}
	else {
		insertArticle($post);
	}
}

?>


<?php include_once 'inc/sidebar.php'; ?>
<?php include_once 'inc/footer.php'; ?>	
