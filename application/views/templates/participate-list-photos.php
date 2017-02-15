<?php
	require_once('echoQuoted.php');

	if (count($photos) == 0) {
		echo '<em>Aucune photo dans cet album ...</em>';
	} else {
		foreach ($photos as $photo) {
?>
	<div class="col-sm-3 box">
		<div class="row">
			<div class="box-content center-div col-sm-12 confirmation-slide" data-slide=<?php quote('#confirmation-'.$photo->id); ?>>
				<img src=<?php quote($photo->url); ?> alt="Photo"/>
			</div>

			<div class="box-content col-sm-12" id=<?php quote('confirmation-'.$photo->id); ?>>
				<div class="row">
					<div class="col-sm-12 text-center">
						<em>Êtes-vous sûr ?</em>
					</div>

					<div class="col-sm-2 col-sm-offset-1">
						<a class="btn btn-sm btn-success" href=<?php quote($photo->getParticipateUrl()); ?>>
							<span class="glyphicon glyphicon-ok"></span> Oui
						</a>
					</div>

					<div class="col-sm-2">
						<button class="btn btn-sm btn-danger confirmation-slide" data-slide=<?php quote('#confirmation-'.$photo->id); ?>>
							<span class="glyphicon glyphicon-remove"></span> Non
						</button>
					</div>
				</div>
		</div>
		</div>
	</div>

<?php }} ?>