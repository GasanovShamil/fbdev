<?php
	require_once(dirname(__FILE__).'/../popo/Photo.php');
?>

<section>
<?php
	echo '<h1>Concours du '.$start.' au '.$end.'</h1>';
	echo '<div class="row">';
		
	foreach ($photos as $photo) {
		echo '<div class="col-md-12">';
		echo 'Auteur : '.$photo->createdBy;
		echo 'Vote : '.$photo->getVoteUrl();
		echo '<img class="contest-picture" src="'.$photo->facebookUrl.'" alt="photo"/>';
		echo '</div>';
		echo '------------------------------------------------';
	}
		
	echo '</div>';
?>
</section>