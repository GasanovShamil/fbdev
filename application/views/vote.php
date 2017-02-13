<?php
	require_once(dirname(__FILE__).'/../viewModels/Contest.php');
	require_once(dirname(__FILE__).'/../viewModels/Photo.php'); 
?>

<div class="container">
	<?php
		echo '<h1>'.$contest->name.'</h1>';
		echo '<h3>Du '.$contest->startDate.' au '.$contest->endDate.'</h1>';

		echo '<div id="box-group" class="row">';

		foreach ($photos as $photo) {
			echo '<div class="col-sm-3 box">';
				echo '<div class="row">';
					echo '<div class="box-header col-sm-12">';
						echo $photo->author;
					echo '</div>';

					echo '<div class="box-content center-div col-sm-12" ';
					echo 'data-toggle="modal" ';
					echo 'data-target="#photo-modal" ';
					echo 'data-url="'.$photo->url.'" ';
					echo 'data-name="'.$photo->author.'">';
						echo '<img src="'.$photo->url.'" alt="photo"/>';
					echo '</div>';

					echo '<div class="box-footer col-sm-12">';
						echo '<div class="row">';
							echo '<div class="col-sm-8 buttons">';
								if ($photo->hasVoted) {
									echo '<button class="btn-unvote btn btn-success" data-photo="'.$photo->id.'" data-unvote="'.$url.$photo->getUnvoteUrl().'"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></button>';
								} else {
									echo '<button class="btn-vote btn btn-primary" data-photo="'.$photo->id.'" data-vote="'.$url.$photo->getVoteUrl().'">Je vote !</button>';
								}
							echo '</div>';

							echo '<div class="col-sm-4 center-div nb-votes" data-photo="'.$photo->id.'">'.$photo->nbVotes.'</div>';
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