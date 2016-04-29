
<?php 
require_once 'inc/connect.php'; 
include_once 'inc/header.php';
require_once 'inc/functions.php'; 

$allArticles = selectSeveralArticles();

?>

	<h2 class="page-title">Choissisez un article à modifier</h2>

		<form method="get">
			<select name="id">
				<?php 
				foreach ($allArticles as $key => $value) {
					echo '<option value="' . $value['id'] . '">' . $value['title'] . '</option>';
				} ?>
			</select>
			<input type="submit" value="On va modifier!">
		</form>
	
<?php 

if(!empty($_GET)) {
	header('Location: view_article.php?id=' . $_GET['id']);
}

?>


<?php include_once 'inc/sidebar.php'; ?>
<?php include_once 'inc/footer.php'; ?>