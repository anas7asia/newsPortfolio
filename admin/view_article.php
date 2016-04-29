<?php 
require_once 'inc/functions.php'; 
include_once 'inc/header.php';
require_once '../inc/connect.php'; 
?>

<?php

	
$thisId = verifyId($_GET['id']);
$post = array();
$errors = array();

// first of all we see an article we gonna work on.
// after pressing on some button 
// we check superglobal variable $_POST in order to know what to do: delete or edit,
// we can delete an article only once, but modify as many times as we want, 
// because it redirects us to the very same page where we are by header()
// that drops all the values of $_POST   

if(!empty($_POST)) {
	// delete if delete button was pressed on
	if(isset($_POST['delete']) && $_POST['delete'] == 'delete') {
		
		deleteArticle($thisId);
		echo '<div class="message message-success">L\'article était bien supprimé</div>';
	}

	// show the article in the form if edit button was pressed on
	elseif(isset($_POST['edit']) && $_POST['edit'] == 'edit') {
		$oneArticle = selectArticle($thisId); // to fill the form in order to modify
?>

<h2 class="page-title">Corriger cet article</h2>

<form method="post">
	<table>
		<tr>
			<td class="form-label"><label for="title">Titre</label></td>
			<td><input type="text" name="title" id="title" value="<?php echo $oneArticle['title']?>" placeholder="Titre"></td>
		</tr>

		<tr>
			<td class="form-label"><label for="link">Lien vers image</label></td>
			<td><input type="text" name="link" id="link" value="<?php echo $oneArticle['image_link']?>"  placeholder="Lien"></td>
		</tr>

		<tr>
			<td class="form-label label-textarea"><label for="content">Text</label></td>
			<td><textarea rows="10" name="content" id="content" placeholder="Contenu"><?php echo $oneArticle['content'] ?></textarea></td>
		</tr>
		
		<tr>
			<td><input type="hidden" name="editDone" value="ok"></td>
			<td><input type="submit" value="Modifier"></td>
		</tr>
	</table>
</form>


<?php
	
	}

	elseif (isset($_POST['editDone']) && $_POST['editDone'] == 'ok') {
		$post = cleanInput($_POST);
		$errors = checkErrors($post);

		if(count($errors) > 0){
			showErrors($errors);
		}
		else {
			editArticle($thisId, $post);
			header('Location: view_article.php?id=' . $thisId);
		}
	}

}
	else {
		$oneArticle = selectArticle($thisId);
		showOneArticle($oneArticle);
?>


<div class="hidden-form-container">
	<form method="post" id="edit-art">
		<input type="hidden" name="edit" value="edit">
		<input type="submit" id="submit-edit" value="Modifier"></input>
	</form>

	<form method="post"id="delete-art">
		<input type="hidden" name="delete" value="delete">
		<input type="submit" id="submit-delete" value="Supprimer"></input>
	</form>
</div>


<?php	
	
} //end of show one article

include_once 'inc/sidebar.php';
include_once 'inc/footer.php'; 
?>
