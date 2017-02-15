<?php
	require_once('echoQuoted.php');

	if (count($photos) == 0) {
		echo '<em>Aucune photo dans cet album ...</em>';
	} else {
		foreach ($photos as $photo) {
?>
	<div class="col-sm-3 box">
		<div class="row">
			<div class="box-content center-div col-sm-12 confirmation-slide slide-open" 
			data-slide=<?php quote($photo->id); ?> 
			id=<?php quote('photo-'.$photo->id); ?>>
				<img src=<?php quote($photo->url); ?> alt="Photo"/>
			</div>

			<div class="box-content col-sm-12 slide-close" id=<?php quote('confirmation-'.$photo->id); ?>>
				<div class="row">
					<div class="col-sm-12 text-center">
						<h1><em>Êtes-vous sûr ?</em></h1>
					</div>

					<div class="col-sm-12">
						<div class="row">
							<form action="participate" method="post">
								<input type="hidden" name="photo" value=<?php quote($photo->url); ?>>
							
								<button type="submit" class="btn btn-success col-sm-6 col-sm-offset-3" href=>
									<span class="glyphicon glyphicon-ok"></span> Oui
								</button>
							</form>
						</div>
					</div>

					<div class="col-sm-12 m-t-10">
						<div class="row">
							<button class="btn btn-danger col-sm-6 col-sm-offset-3 confirmation-slide" data-slide=<?php quote($photo->id); ?>>
								<span class="glyphicon glyphicon-remove"></span> Non
							</button>
						</div>
					</div>
				</div>
		</div>
		</div>
	</div>

<?php }} ?>