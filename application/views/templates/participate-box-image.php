<?php
	require_once('echoQuoted.php');
	require_once(dirname(__FILE__).'/../../viewModels/Album.php');
?>

<div class="col-sm-3 box">
	<div class="row">
		<div class="box-header col-sm-12">
			<?php echo $album->name; ?>
		</div>

		<div class="box-content center-div col-sm-12" data-album=<?php quote($album->id); ?>>
			<img src=<?php quote($album->cover); ?> alt="Album"/>
		</div>
	</div>
</div>