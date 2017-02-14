<?php 	require_once(dirname(__FILE__).'/../viewModels/Contest.php'); ?>

<div class="container">
	<h1><span class="glyphicon glyphicon-warning-sign"></span> Attention !</h1>
	<h3>Il n\'y a aucun concours actif pour le moment ¯\_༼ ಥ ‿ ಥ ༽_/¯</h3>
	<h3>Le prochain concours est prévu pour :</h3>
	<ul>
		<li>Concours : <?php echo $contest->url; ?></li>
		<li>Prix : <?php echo $contest->url; ?></li>
		<li>Début : <?php echo $contest->url; ?></li>
		<li>Fin : <?php echo $contest->url; ?></li>
	</ul>
</div>