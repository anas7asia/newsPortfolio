

<?php 
include_once 'inc/header.php';
require_once 'inc/connect.php';
require_once 'inc/functions.php'; 

$res = $bdd->prepare('SELECT * FROM portfolio_articles ORDER BY date_add DESC LIMIT :start, :maxi');

$start = 1;
$msgPerPage = 3;
$res->bindParam(':start', $start, PDO::PARAM_INT);
$res->bindParam(':maxi', $msgPerPage, PDO::PARAM_INT);
$res->execute();
$articles = $res->fetchAll(PDO::FETCH_ASSOC);

foreach ($articles as $key => $article) {
	showSeveralArticles($article);
}

include_once 'inc/sidebar.php';
include_once 'inc/footer.php'; 

?>

		