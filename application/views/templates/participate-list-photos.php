<?php
	require_once('echoQuoted.php');

	if (count($photos) == 0) {
		echo '<em>Aucune photo dans cet album ...</em>';
	} else {
		foreach ($photos as $photo) {
?>
	<div class="col-sm-3 box">
		<div class="row">
			<div class="box-content center-div col-sm-12" 
			data-toggle="modal" 
			data-target="#confirmation-modal" 
			data-participate=<?php quote($photo->getParticipateUrl()); ?>>
				<img src=<?php quote($photo->url); ?> alt="photo"/>
			</div>
		</div>
	</div>

<?php }} ?>