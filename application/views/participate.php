<?php if (isset($alert)) { ?>		
	<div class="alert alert-warning">
		<strong>Attention : </strong><?php echo $alert; ?>
	</div>
<?php } else { 
	$this->load->view('templates/contest-infos', array('contest' => $contest));
?>

<!-- <div class="panel panel-info">
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
			<form method="post" action="/participate/add_photos" enctype="multipart/form-data">

				<label for="upload_photo">Sélectionner une photo facebook </label>
				<div>
					<a href="/participate/album" class="button display-block">Choisir</a>
				</div>

				<label for="import_fb">Importer une photo sur facebook </label>
				<input type="file" name="photo_file">

				<label for="description_photo">Description : </label>
				<div class="col-md-12">
					<textarea class="form-control" id="textarea" name="photo_description" rows="11">Ma participation au concours <?php echo date('d-m-Y H:i:s'); ?></textarea>
				</div>

				<div class="col-md-12" >
					<input type="submit" value="Ajouter à mes photos" class="button" name="submit">
				</div>

				</form>
		</div>
	</div>
</div> -->

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