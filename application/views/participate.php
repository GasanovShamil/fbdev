<div class="container">

	<?php $this->load->view('templates/contest-infos', array('contest' => $contest)); ?>

	<div id="box-group" class="row">

		<?php
			foreach ($albums as $album) { 
				$this->load->view('templates/participate-box-image', array('album' => $album));
			}
		?>

	</div>
</div>