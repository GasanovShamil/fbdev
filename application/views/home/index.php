<?php include "structure/header.php"; ?>

<section>
	<div class="row">
		<div class="jumbotron">
			<h1> PARDON MAMAN</h1>
		  	<p> Tatoo & Piercing</p>
		  	<div id="informations" class="bg-primary lineback">
			  	<div class="" id="telephone">
					<img src="<?php echo base_url(); ?>images/phone-call.png" alt="numéro pardon maman"/>
					<span class="space"><strong>09 52 95 67 55</strong></span>
				</div>
				<div class="lineback" id="location">
					<img src="<?php echo base_url(); ?>images/placeholder.png" alt="localisation pardon maman"/>
					<span class="space"><strong>2, Boulevard du Général Gallieni, 94360 Bry sur Marne</strong></span>
				</div>
			</div>
		</div>
	

	<?php
		$helper = $fb->getRedirectLoginHelper();
		$permissions = ['email', 'user_likes', 'user_photos'];
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
		</div>
	</div>
</section>

<?php include "structure/footer.php"; ?>