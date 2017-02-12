<?php require_once(dirname(__FILE__).'/../popo/Photo.php'); ?>

<div class="container">
	<?php
		echo '<h1>Concours du '.$start.' au '.$end.'</h1>';
		echo '<div class="row">';

		foreach ($photos as $photo) {
			echo '<div class="col-sm-6 box">';
				echo '<div class="row">';
					echo '<div class="box-header col-sm-12" data-name="'.$photo->createdBy.'">';
						echo $photo->createdBy;
					echo '</div>';

					echo '<div class="box-content col-sm-12" data-url="'.$photo->facebookUrl.'">';
						echo '<img src="'.$photo->facebookUrl.'" alt="photo"/>';
					echo '</div>';

					echo '<div class="box-footer col-sm-12">';
						echo '<div class="btn-group" role="group" aria-label="...">';
							echo '<button class="btn btn-default">Je vote</button>';
							echo '<button class="btn btn-default">'.$photo->nbVote.'</button>';
						echo '</div>';
					echo '</div>';
				echo '</div>';
			echo '</div>';
		}

		echo '</div>';
	?>
</div>

<!-- Modal -->
<div id="photoModalContainer" class="div-modal-container">
	<div tabindex="-1" id="photo-modal" class="modal fade" role="dialog">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span class="icon icon-remove" aria-hidden="true"></span>
					</button>
					<h4 id="modal_title" class="modal-title"></h4>
				</div>

				<div class="modal-body">
					<img src="" alt="photo"/>
				</div>
			</div>
		</div>
	</div>
</div>