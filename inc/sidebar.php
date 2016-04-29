

</main>
</div> <!-- end of div.main -->

<?php
require_once 'functions.php'; 
$user = getSidebarUser();
?>

<aside>
	<section class="profile">
		<div>
			<img src="\php\08_practise_minisite\img\profile-pic.jpg" width="100%" height="auto" alt="My vintage portrait">

			<div class="profile-info">
				<span class="profile-name"><?php echo $user['firstname'] . ' ' . $user['lastname'];?> </span> <br>
				Tél: <?php echo $user['phone'];?> <br>
				Email: <?php echo $user['email'];?>
			</div>	
		</div>
	</section>

	<nav>
		<ul class="main-nav">
			<li><a href="\php\08_practise_minisite\index.php">Accueil</a></li>
			<li><a href="\php\08_practise_minisite\read_all.php?pageno=1">Les news</a></li>
			<li><a href="\php\08_practise_minisite\contact.php">Contact</a></li>
			<li><a href="\php\08_practise_minisite\search.php">Recherche</a></li>
		</ul>
	</nav>
	
</aside>

