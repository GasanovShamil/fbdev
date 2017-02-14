<!DOCTYPE html>
<html>
	<head>
		<title></title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/style/site.css" />

		<!-- Vote -->
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/style/vote.css" />
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/vote.js"></script>
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
						<li><a href="/participate/index">Participer</a></li>
						<li><a href="/vote/index">Voter</a></li>
						
						<?php if ($_SESSION['facebook-is-admin']) { ?>
							<li><a href="/backend/index">Administration</a></li>
						<?php } ?>
					</ul>
				</div>
			</div>
		</nav>