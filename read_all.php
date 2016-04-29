<?php include_once 'inc/header.php'; ?>


<?php 
require_once 'inc/connect.php';
require_once 'inc/functions.php'; 


$articlesInMyBase = $bdd->query('SELECT COUNT(*) FROM portfolio_articles')->fetchColumn();
$articlesToShow = 5;
$offset = 0;
$total_pages = ceil($articlesInMyBase / $articlesToShow);

if(!empty($_GET)) {
	if($_GET['pageno']) {
		$page_value = $_GET['pageno'];
		if($page_value > 1)
		{	
			$offset = ($page_value - 1) * $articlesToShow;
		}
	}
}
else {
	$page_value = 1;
}


//get 5 articles from the base
$res = $bdd->prepare('SELECT * FROM portfolio_articles ORDER BY date_add DESC LIMIT :offset, :articlesToShow');
$res->bindValue(':offset', $offset, PDO::PARAM_INT);
$res->bindValue(':articlesToShow', $articlesToShow, PDO::PARAM_INT);

if($res->execute()) {
	$result = $res->fetchAll(PDO::FETCH_ASSOC);
}
else {
	echo '<div class="errorContent">Une erreur est survenue. Veuillez réessayer plus tard.</div>';
}

// show 5 articles
foreach ($result as $key => $article) {
	showSeveralArticles($article);
}

//  previous button
echo '<div class="paginator">';
if($_GET['pageno'] > 1) {
   echo '<a href="read_all.php?pageno='.($_GET['pageno'] - 1). '"> Previous </a>';
}

for($i = 1 ; $i <= $total_pages ; $i++) {
   echo '<a href="read_all.php?pageno='.$i.'">'. $i .'</a>';
}

if($total_pages != 1 && $_GET['pageno'] != $total_pages) {
   echo '<a href="read_all.php?pageno='.($_GET['pageno'] + 1). '"> Next </a>';
} 

echo '<div>';
?>


<?php include_once 'inc/sidebar.php'; ?>
<?php include_once 'inc/footer.php'; ?>

		