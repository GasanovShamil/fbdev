<div class="container">

	<?php $this->load->view('templates/contest-infos', array('contest' => $contest)); ?>

	<div class="panel panel-info">
		<div class="panel-heading toggle-slide" data-slide="#albums">
			<h3 class="panel-title">Mes albums</h3>
		</div>
		<div class="panel-body" id="albums">
			<div id="box-group" class="row">

				<?php
					foreach ($albums as $album) { 
						$this->load->view('templates/participate-box-image', array('album' => $album));
					}
				?>

			</div>
		</div>
	</div>

	<div class="panel panel-info">
		<div class="panel-heading toggle-slide" data-slide="#albums">
			<h3 class="panel-title">Mes Photos</h3>
		</div>
		<div class="panel-body" id="albums">
			<div id="box-group" class="row">

				<?php
					foreach ($albums as $album) { 
						$this->load->view('templates/participate-box-image', array('album' => $album));
					}
				?>

			</div>
		</div>
	</div>
</div>