<?php $this->load->view('templates/contest-infos', array('contest' => $contest)); ?>

<div class="box-group" class="row">

	<?php
		foreach ($photos as $photo) { 
			$this->load->view('templates/contest-box-image', array('photo' => $photo));
		}
	?>

</div>

<!-- Modal -->
<div id="photo-modal" tabindex="-1" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
				<h4 class="modal-title"></h4>
			</div>

			<div class="modal-body center-div">
				<img src="" alt="photo"/>
			</div>
		</div>
	</div>
</div>