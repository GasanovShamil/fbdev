<!DOCTYPE html>
<html>
	<head>
		<title></title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/style/site.css" />
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/scripts/site.js"></script>

		<?php foreach ($links as $link) { echo $link; } ?>
	</head>

	<body>
		<!-- Navbar -->
		<nav class="navbar navbar-inverse">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="#">PARDON MAMAN</a>
				</div>
				<div id="navbar" class="collapse navbar-collapse">
					<ul class="nav navbar-nav">
						<li><?php echo anchor('/participate/index', 'Participer', 'title="Participer au concours"'); ?></li>
						<li><?php echo anchor('/vote/index', 'Voter', 'title="Voter pour les photos"'); ?></li>
					</ul>
					<ul class="nav navbar-nav navbar-right">	
						<?php 
							if ($_SESSION['facebook-is-admin']) { 
								echo '<li>'.anchor('/backend/index', 'Administration', 'title="Administrer l\'application" class="glyphicon glyphicon-log-in"').'</li>';
							}
						?>
					</ul>
				</div>
			</div>
		</nav>

		<div class="container">