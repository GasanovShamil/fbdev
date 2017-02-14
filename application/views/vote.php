<div class="container">
	<?php $this->load->view('templates/contest-infos', array('contest' => $contest)); ?>

	<div id="box-group" class="row">

		<?php
			foreach ($photos as $photo) { 
				$this->load->view('templates/contest-box-image', array('photo' => $photo));
			}
		?>

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