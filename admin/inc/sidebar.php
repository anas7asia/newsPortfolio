

</main>
</div> <!-- end of div.main -->

<?php
require_once 'functions.php'; 
$user = getSidebarUser();
?>

<aside>
	<section class="profile">
		<div>
			<i class="fa fa-rebel fa-5x" aria-hidden="true"></i>
			<p>ADMIN MODE</p>

			<div class="profile-info">
				<span class="profile-name"><?php echo $user['firstname'] . ' ' . $user['lastname'];?> </span> <br>
				Tél: <?php echo $user['phone'];?> <br>
				Email: <?php echo $user['email'];?>
			</div>	
		</div>
	</section>

	<nav>
		<ul class="main-nav">
			<li><a href="add_article.php">Add article</a></li>
			<li><a href="edit_user.php">Edit user</a></li>
			<li><a href="create_database.php">Créer la bdd</a></li>
			<li><a href="edit_article.php">Edit article</a></li>
			<li><a href="..\search.php">Recherche</a></li>
		</ul>
	</nav>
	
</aside>

