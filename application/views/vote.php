<?php require_once(dirname(__FILE__).'/../popo/Photo.php'); ?>

<div class="container">
	<?php
		echo '<h1>Concours du '.$start.' au '.$end.'</h1>';
		echo '<div id="box-group" class="row">';

		foreach ($photos as $photo) {
			echo '<div class="col-sm-3 box">';
				echo '<div class="row">';
					echo '<div class="box-header col-sm-12">';
						echo $photo->createdBy;
					echo '</div>';

					echo '<div class="box-content center-div col-sm-12" ';
					echo 'data-toggle="modal" ';
					echo 'data-target="#photo-modal" ';
					echo 'data-url="'.$photo->facebookUrl.'" ';
					echo 'data-name="'.$photo->createdBy.'">';
						echo '<img src="'.$photo->facebookUrl.'" alt="photo"/>';
					echo '</div>';

					echo '<div class="box-footer col-sm-12">';
						echo '<div class="row">';
							echo '<div class="col-sm-8">';
								echo '<button id="btn-vote" class="btn btn-default">Je vote !</button>';
							echo '</div>';

							echo '<div class="col-sm-4 center-div">';
								echo '<span>'.$photo->nbVote.'</span>';
							echo '</div>';
						echo '</div>';
					echo '</div>';
				echo '</div>';
			echo '</div>';
		}

		echo '</div>';
	?>
</div>

<!-- Modal -->
<div id="photo-modal-container" class="div-modal-container">
	<div tabindex="-1" id="photo-modal" class="modal fade" role="dialog">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span class="icon icon-remove" aria-hidden="true"></span>
					</button>
					<h4 class="modal-title"></h4>
				</div>

				<div class="modal-body center-div">
					<img src="" alt="photo"/>
				</div>
			</div>
		</div>
	</div>
</div>