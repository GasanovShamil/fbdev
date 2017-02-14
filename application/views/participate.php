<?php $this->load->view('templates/contest-infos', array('contest' => $contest)); ?>

<div class="panel panel-info">
	<div class="panel-heading toggle-slide" data-slide="#albums">
		<div class="row">
			<div class="col-sm-11">
				<h3 class="panel-title">Mes albums</h3>
			</div>

			<div class="col-sm-1">
				<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
				<span class="glyphicon glyphicon-minus" aria-hidden="true"></span>
			</div>
		</div>
	</div>
	<div class="panel-body" id="albums">
		<div class="box-group" class="row">

			<?php
				foreach ($albums as $album) { 
					$this->load->view('templates/participate-box-album', array('album' => $album));
				}
			?>

		</div>
	</div>
</div>

<div class="panel panel-info">
	<div class="panel-heading toggle-slide" data-slide="#photos">
		<div class="row">
			<div class="col-sm-11">
				<h3 class="panel-title">Mes Photos</h3>
			</div>

			<div class="col-sm-1">
				<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
				<span class="glyphicon glyphicon-minus" aria-hidden="true"></span>
			</div>
		</div>
	</div>
	<div class="panel-body" id="photos">
		<div class="box-group" class="row">
			<em>Choisissez un album !</em>
		</div>
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