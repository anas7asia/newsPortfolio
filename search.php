<?php 
include_once 'inc/header.php'; 

$keyword = "";

require_once 'inc/connect.php';
require_once 'inc/functions.php'; 

if(!empty($_GET)) {
	$keyword = trim(strip_tags($_GET['keyword']));
	$res = $bdd->prepare('SELECT * FROM portfolio_articles WHERE title LIKE :keyword OR content LIKE :keyword ORDER BY date_add DESC');
	$res->bindValue(':keyword', '%'.$keyword.'%');
	$res->execute();

	$result = $res->fetchAll(PDO::FETCH_ASSOC);

	
}
?>

<form id="search-form" method="get">
<label for="keyword"><strong>Qu'est-ce qu'on cherche?</strong></label>
<input type="text" id="keyword" name="keyword" value="<?php echo $keyword; ?>">
<input type="submit" value="Chercher">
</form>


<?php 
if(!empty($_GET)) {
	if(!empty($result)) {

		foreach ($result as $key => $value) {
			showSearchResult($value, $keyword);
		}
	} else {
		echo '<p class="noresult-search">Désolé, votre demande de <span class="keyword">' . $keyword . '</span> est introuvable</p>';
	}
}	
	else {
		$articles = selectSeveralArticles();

		foreach ($articles as $key => $article) {
			showSeveralArticles($article);
		}
		
	}



?>

<?php include_once 'inc/sidebar.php'; ?>
<?php include_once 'inc/footer.php'; ?>
