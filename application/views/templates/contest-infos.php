<?php 
require_once(dirname(__FILE__).'/../../viewModels/Contest.php'); 
require_once('echoQuoted.php');
?>

<div class="panel panel-info">
	<div class="panel-heading toggle-slide" data-slide=<?php quote('#contest-'.$contest->id); ?>>
		<div class="row">
			<div class="col-sm-11">
				<h3 class="panel-title"><?php echo $contest->name; ?></h3>
			</div>

			<div class="col-sm-1">
				<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
				<span class="glyphicon glyphicon-minus" aria-hidden="true"></span>
			</div>
		</div>
	</div>
	<div class="panel-body" id=<?php quote('contest-'.$contest->id); ?>>
		<div id="box-group" class="row">
			<h3>Prix : <?php echo $contest->prize; ?></h3>
			<h3><?php echo $contest->getDateRange(); ?></h3>
		</div>
	</div>
</div>