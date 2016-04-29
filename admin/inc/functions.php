<?php

require_once 'connect.php';

function showSeveralArticles($art) {
	echo '<article>';
	echo '<h1>' . $art['title'] . '</h1>';
	echo '<div class="article-divider"></div>';
	echo '<p class="art-date">Publié le ' . $art['date_add'] . '</p>';
	echo '<img class="article-img" src="' . $art['image_link'] . '">';
	echo '<p class="art-content">' . substr($art['content'], 0, 250) . '...</p><a href="read_article.php?id=' . $art['id'] . '">Lire la suite</a>';
	echo '</article>';
}

function showOneArticle($art) {
	echo '<article>';
	echo '<h1>' . $art['title'] . '</h1>';
	echo '<div class="article-divider"></div>';
	echo '<p class="art-date">Publié le ' . $art['date_add'] . '</p>';
	echo '<img class="article-img" src="' . $art['image_link'] . '">';
	echo '<p class="art-content">' . $art['content'] . '</p>';
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

function cleanInput($arrToOperate) {
	$newArr = [];

	foreach ($arrToOperate as $key => $value) {
		$newArr[$key] = trim(strip_tags($value));
	}

	return $newArr;
}

function checkErrors($arr){

	$errArr = [];

	if(strlen($arr['title']) < 0 || strlen($arr['title']) > 250){
		$errArr[] = 'Le titre de la news doit comporter entre 10 et 250 caractères';
	}

	if(!filter_var($arr['link'], FILTER_VALIDATE_URL)){
		$errArr[] = 'Le lien de l\'image n\'est pas une URL valide';
	}

	if(empty($arr['content'])){
		$errArr[] = 'Le contenu de la news doit être rempli, sinon personne ne pourra la lire :-)';
	}
	return $errArr;
}

function showErrors($err) {
	echo '<div class="error-list">';
	echo '<ol>';
	foreach ($err as $value) {
		echo '<li>'	. $value . '</li>';
	}
	echo '</ol>';
	echo '</div>';
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

function insertArticle($arrInsertFrom) {

	global $bdd;

	$res = $bdd->prepare('INSERT INTO portfolio_articles (title, image_link, content, date_add) VALUES(:titleArticle, :linkArticle, :contentArticle, NOW())');

	$res->bindValue(':titleArticle', $arrInsertFrom['title']);
	$res->bindValue(':linkArticle', $arrInsertFrom['link'], PDO::PARAM_STR);
	$res->bindValue(':contentArticle', $arrInsertFrom['content'], PDO::PARAM_STR);

	if($res->execute()){
		header('Location: view_article.php?id=' . $bdd->lastInsertId());
	}
	else {
		die(print_r($res->errorInfo()));
	}
}

function editArticle($id, $valuesArr) {

	global $bdd;
	$res = $bdd->prepare('UPDATE portfolio_articles SET title = :newTitle, image_link = :newLink, content = :newContent, date_add = NOW() WHERE id = :thisId');
	$res->bindValue(':newTitle', $valuesArr['title'], PDO::PARAM_STR);
	$res->bindValue(':newLink', $valuesArr['link'], PDO::PARAM_STR);
	$res->bindValue(':newContent', $valuesArr['content'], PDO::PARAM_STR);
	$res->bindValue(':thisId', $id, PDO::PARAM_INT);
	$res->execute();
}

function deleteArticle($id) {
	global $bdd;
	$req = $bdd->prepare('DELETE FROM portfolio_articles WHERE id = :idOfMyArticle');
	$req->bindValue(':idOfMyArticle', $id, PDO::PARAM_INT);
	$req->execute();
}


function checkErrorsForUser($arr) {

	$errArr = [];

	if(strlen($arr['firstname']) < 3 || strlen($arr['firstname']) > 50){
		$errArr[] = 'Le nom doit comporter entre 3 et 50 caractères';
	}

	if(strlen($arr['lastname']) < 3 || strlen($arr['lastname']) > 50){
		$errArr[] = 'Le prénom doit comporter entre 3 et 50 caractères';
	}

	if(!filter_var($arr['email'], FILTER_VALIDATE_EMAIL)){
		$errArr[] = 'Email n\'est pas valide';
	}

	if(!is_numeric($arr['phone'])){
		intval($arr['phone']);
		if(empty($arr['phone']) && !filter_var($arr['phone'], FILTER_VALIDATE_INT)) {
			$errArr[] = 'Le numéro ne semble pas etre valide';
		}	
	}
	return $errArr;
}

function getSidebarUser() {

	$constantId = 1;
	global $bdd;

	$res = $bdd->prepare('SELECT * FROM sidebar_user WHERE id = :thisArticleId');
	$res->bindValue(':thisArticleId', $constantId, PDO::PARAM_INT);
	$res->execute();
	return $res->fetch(PDO::FETCH_ASSOC);
}


function editSidebarUser($valuesArr) {
	
	global $bdd;

	$constantId = 1;

	$res = $bdd->prepare('UPDATE sidebar_user SET firstname = :newFirstname, lastname = :newLastname, email = :newEmail, phone = :newPhone, date_edit = NOW() WHERE id = :thisId');
	$res->bindValue(':newFirstname', $valuesArr['firstname'], PDO::PARAM_STR);
	$res->bindValue(':newLastname', $valuesArr['lastname'], PDO::PARAM_STR);
	$res->bindValue(':newEmail', $valuesArr['email'], PDO::PARAM_STR);
	$res->bindValue(':newPhone', $valuesArr['phone'], PDO::PARAM_INT);
	$res->bindValue(':thisId', $constantId, PDO::PARAM_INT);
	if($res->execute()){
		return true;
	} else {
		$res->errorInfo();
	}

}

function createDatabase($name) {
	global $bdd;

    try {

	    // sql to create table
	    $sql = "CREATE TABLE $name (
	    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
	    firstname VARCHAR(30) NOT NULL,
	    lastname VARCHAR(30) NOT NULL,
	    email VARCHAR(50),
	    reg_date TIMESTAMP
	    )";

	    // use exec() because no results are returned
	    $bdd->exec($sql);
	    echo '<div class="message message-success">Table "<span style="text-decoration:underline">' . $name .'</span>" created successfully</div>';
	}
	catch(PDOException $e) {

	    echo $sql . "<br>" . $e->getMessage();

	    }

}

?>

