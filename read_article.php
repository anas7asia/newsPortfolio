<?php 
include_once 'inc/header.php';
require_once 'inc/functions.php'; 
?>


<?php 

$thisId = verifyId($_GET['id']);

$oneArticle = selectArticle($thisId);

showOneArticle($oneArticle);

?>

<?php include_once 'inc/sidebar.php'; ?>
<?php include_once 'inc/footer.php'; ?>

		