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