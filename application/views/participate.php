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

<div id="confirmation-modal" tabindex="-1" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
    	<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">×</span>
			</button>
			<h4 class="modal-title">Êtes-vous sûr ?</h4>
		</div>
		<div class="model-body">
			<a id="participate" class="btn btn-sm btn-success" href="">
				<span class="glyphicon glyphicon-ok"></span> Oui
			</a>

			<button type="button" data-dismiss="modal" class="btn btn-sm btn-default">
				<span class="glyphicon glyphicon-remove"></span> Non
			</button>
		</div>
    </div>
  </div>
</div>