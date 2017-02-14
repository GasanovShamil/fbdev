<?php
	require_once('echoQuoted.php');

	foreach ($photos as $photo) {
?>
	<div class="col-sm-3 box">
		<div class="row">
			<div class="box-header col-sm-12">
				<?php limit($photo->label); ?>
			</div>

			<div class="box-content center-div col-sm-12" data-toggle="modal" data-target="#photo-modal" data-label=<?php quote($photo->label); ?> data-participate=<?php quote($photo->getParticipateUrl()); ?>>
				<img src=<?php quote($photo->url); ?> alt="photo"/>
			</div>
		</div>
	</div>

<?php } ?>