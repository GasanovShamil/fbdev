<?php include "structure/header.php"; ?>

<section>
	<?php
		$helper = $fb->getRedirectLoginHelper();
		$permissions = ['email', 'user_likes', 'user_photos', 'user_birthday'];
		
		$url = $helper->getLoginUrl(base_url().'callback', $permissions);

		if (checkAccessToken()) {

			if (checkPermissions()) {
				echo '<a href="logout" class="btn btn-primary">Se déconnecter</a>';
			} else {
				echo '<a href="'.$_SESSION['rerequest-url'].'" class="btn btn-primary">Ajouter les permissions manquantes</a>';
			}

		} else {
			echo '<a href="'.$url.'" class="btn btn-primary">En savoir plus</a>';
		}
	?>
</section>

<?php include "structure/footer.php"; ?>