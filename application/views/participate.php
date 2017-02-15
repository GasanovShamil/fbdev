<?php if (isset($alert)) { ?>		
	<div class="alert alert-warning">
		<strong>Attention : </strong><?php echo $alert; ?>
	</div>
<?php } else { 
	$this->load->view('templates/contest-infos', array('contest' => $contest));
?>

<div class="panel panel-info">
	<div class="panel-heading toggle-slide" data-slide="#upload">
		<div class="row">
			<div class="col-sm-11">
				<h3 class="panel-title">Depuis mon ordinateur</h3>
			</div>

			<div class="col-sm-1">
				<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
				<span class="glyphicon glyphicon-minus" aria-hidden="true"></span>
			</div>
		</div>
	</div>
	<div class="panel-body" id="upload">
		<div class="box-group" class="row">
			<form action="upload" method="post" enctype="multipart/form-data">
				Importer une photo sur facebook <input type="file" name="path" /><br />
				Description <input type="text" name="description" /><br />
			
				<button type="submit" class="btn btn-success col-sm-6 col-sm-offset-3">
					<span class="glyphicon glyphicon-ok"></span> Ajouter à mes photos
				</button>
			</form>
		</div>
	</div>
</div>

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
</div

<?php } ?>