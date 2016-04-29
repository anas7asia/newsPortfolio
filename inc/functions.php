<?php

require_once 'connect.php';

function showSeveralArticles($art) {
	echo '<article>';
	echo '<h1>' . $art['title'] . '</h1>';
	echo '<div class="article-divider"></div>';
	echo '<p class="art-date">Publié le ' . $art['date_add'] . '</p>';
	echo '<img class="article-img" src="' . $art['image_link'] . '">';
	echo '<p class="art-content">' . substr($art['content'], 0, 250) . '...</p><a class="read-more" href="read_article.php?id=' . $art['id'] . '">Lire la suite</a>';
	echo '</article>';
}

function showSearchResult($art, $key) {
	echo '<article>';
	echo '<h1>' . str_ireplace($key, '<span style="padding:5px;background-color:#E08283;color:#fff;">' . $key . '</span>', $art['title']) . '</h1>';
	echo '<div class="article-divider"></div>';
	echo '<p class="art-date">Publié le ' . $art['date_add'] . '</p>';
	echo '<img class="article-img" src="' . $art['image_link'] . '">';
	echo '<p>' . str_ireplace($key, '<span style="padding:0 5px;background-color:#E08283;color:#fff;">' . $key . '</span>', $art['content']) . '</p>';
	echo '</article>';
}

function showOneArticle($art) {
	echo '<article>';
	echo '<h1>' . $art['title'] . '</h1>';
	echo '<div class="article-divider"></div>';
	echo '<p class="art-date">Publié le ' . $art['date_add'] . '</p>';
	echo '<img class="article-img" src="' . $art['image_link'] . '">';
	echo '<p class="art-content">' . $art['content'] . '</p>';
	echo '<a href="read_all.php?pageno=1">Revenir</a>';
	echo '</article>';
}

function verifyId($id) {
	if(isset($id) && !empty($id)){
		$thisId = $id; 
		if(!is_numeric($thisId)){
			$thisId = 1;
		}
		return $thisId;
	}
}

function selectArticle($id) {
	global $bdd;

	$res = $bdd->prepare('SELECT * FROM portfolio_articles WHERE id = :thisArticleId');
	$res->bindValue(':thisArticleId', $id, PDO::PARAM_INT);
	$res->execute();
	return $res->fetch(PDO::FETCH_ASSOC);
}

function selectSeveralArticles() {
	global $bdd;
	$res = $bdd->prepare('SELECT * FROM portfolio_articles ORDER BY date_add DESC');
	$res->execute();
	return $res->fetchAll(PDO::FETCH_ASSOC);
}

function getSidebarUser() {

	$constantId = 1;
	global $bdd;

	$res = $bdd->prepare('SELECT * FROM sidebar_user WHERE id = :thisArticleId');
	$res->bindValue(':thisArticleId', $constantId, PDO::PARAM_INT);
	$res->execute();
	return $res->fetch(PDO::FETCH_ASSOC);
}



?>

