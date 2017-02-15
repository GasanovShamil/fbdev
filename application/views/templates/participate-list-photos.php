<?php
	require_once('echoQuoted.php');

	if (count($photos) == 0) {
		echo '<em>Aucune photo dans cet album ...</em>';
	} else {
		foreach ($photos as $photo) {
?>
	<div class="col-sm-3 box">
		<div class="row">
			<div class="box-content center-div col-sm-12 box-slide" 
			data-slide=<?php quote('#confirmation-'.$photo->id); ?> 
			id=<?php quote('photo-'.$photo->id); ?>>
				<img src=<?php quote($photo->url); ?> alt="Photo"/>
			</div>

			<div class="box-content col-sm-12" id=<?php quote('confirmation-'.$photo->id); ?>>
				<div class="row">
					<div class="col-sm-12 text-center">
						<h1><em>Êtes-vous sûr ?</em></h1>
					</div>
					<br />
					<div class="col-sm-12 text-center">
						<a class="btn btn-sm btn-success" href=<?php quote($photo->getParticipateUrl()); ?>>
							<span class="glyphicon glyphicon-ok"></span> Oui
						</a>
					</div>
					<br />
					<div class="col-sm-12 text-center">
						<button class="btn btn-sm btn-danger confirmation-slide" data-slide=<?php quote($photo->id); ?>>
							<span class="glyphicon glyphicon-remove"></span> Non
						</button>
					</div>
				</div>
		</div>
		</div>
	</div>

<?php }} ?>