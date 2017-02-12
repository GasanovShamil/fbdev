<!DOCTYPE html>
<html>
	<head>
		<title></title>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/bootstrap.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/style/site.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/style/vote.css" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>js/bootstrap.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>js/fb.js"></script>
	</head>

	<body>
		<?php if (!isset($hideNav)) { ?>
			<!-- Navbar -->
			<nav class="navbar navbar-inverse navbar-fixed-top">
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
							
							<?php if ($isAdmin) { ?>
								<li><a href="#">Administration</a></li>
							<?php } ?>
						</ul>
					</div>
				</div>
			</nav>
		<?php } ?>