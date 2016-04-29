<?php

require_once '../inc/functions.php'; 

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