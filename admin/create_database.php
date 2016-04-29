
<?php 
require_once 'inc\connect.php';
include_once 'inc\header.php'; 
?>

	<h2 class="page-title">Créer une nouvelle base de données</h2>

		<form method="post">
			<table>
				<tr>
					<td class="form-label"><label for="name">Database name</label></td>
					<td><input type="text" name="name" id="name" placeholder="Titre"></td>
				</tr>

				<tr>
					<td></td>
					<td><input type="submit"></td>
				</tr>
			</table>
		</form>
	
<?php 

require_once 'inc/functions.php'; 

$post = array();
$errors = array();
$existingTables = array();
$newDBName = "";

if(!empty($_POST)) {
	$post = cleanInput($_POST);
	$newDBName = $post['name'];

	if(!empty($newDBName)) {
		
		$res = $bdd->prepare('SHOW TABLES FROM portfolio');
		$res->execute();

		$tables = $res->fetchAll(PDO::FETCH_ASSOC);

		foreach ($tables as $key => $value) {
			foreach ($value as $k => $val) {
				$existingTables[] = $val;
			}
		}

		if(in_array($newDBName, $existingTables)) {
			echo '<div class="message message-error">Ce tableau existe déjà!</div>';
		}
		else {
			createDatabase($newDBName);
		}
	}
	else {
		echo '<div class="message message-error">Entrez un propre nom!</div>';
	}
	
}



?>


<?php 
include_once 'inc\sidebar.php'; 
include_once '..\inc\footer.php'; 
?>	