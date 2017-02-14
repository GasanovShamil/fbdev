<?php
	require_once(dirname(__FILE__).'/../viewModels/Contest.php');
	require_once(dirname(__FILE__).'/../viewModels/Photo.php'); 
?>

<div class="container">
	<h1><?php echo $contest->name; ?></h1>
	<h3><?php echo $contest->getDateRange(); ?></h3>
	<h3>Prix : <?php echo $contest->prize; ?></h3>

	<div id="box-group" class="row">

		<?php foreach ($photos as $photo) { ?>
			<div class="col-sm-3 box">
				<div class="row">
					<div class="box-header col-sm-12">
						<?php echo $photo->author; ?>
					</div>

					<div class="box-content center-div col-sm-12" data-toggle="modal" data-target="#photo-modal" data-url=<?php echo $photo->url; ?> data-name=<?php echo $photo->author; ?>>
						<img src=<?php echo $photo->url; ?> alt="Photo"/>
					</div>

					<div class="box-footer col-sm-12">
						<div class="row">
							<div class="col-sm-8 buttons">
								<?php
									$voteClass = 'btn-vote btn btn-primary';
									$unvoteClass = 'btn-unvote btn btn-success';

									if ($photo->hasVoted) $voteClass .= ' hidden';
									else $unvoteClass .= ' hidden';
								?>

								<button class=<?php echo $voteClass; ?> data-photo=<?php echo $photo->id; ?> data-vote=<?php echo $url.$photo->getVoteUrl(); ?>>
									Je vote !
								</button>

								<button class=<?php echo $unvoteClass; ?> data-photo=<?php echo $photo->id; ?> data-unvote=<?php echo $url.$photo->getUnvoteUrl(); ?>>
									<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
								</button>
							</div>

							<div class="col-sm-4 center-div nb-votes">
								<span class="photo-vote" data-photo=<?php echo $photo->id; ?>>
									<?php echo $photo->nbVotes; ?>
								</span>
							</div>
						</div>
					</div>
				</div>
			<?php } ?>

	</div>
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