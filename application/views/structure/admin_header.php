<!DOCTYPE html>
<html>
	<head>
		<title></title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>js/bootstrap.js"></script>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/bootstrap.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/style/site.css" />

		<!-- Vote -->
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/style/vote.css" />
		<script type="text/javascript" src="<?php echo base_url(); ?>js/vote.js"></script>
	</head>

	<body>
		<nav class="navbar navbar-inverse">
			<div class="container-fluid">
				<div class="navbar-header">
					<a class="navbar-brand" href="#">ADMIN</a>
				</div>
				<ul class="nav navbar-nav">
					<li>
	                	<?php echo anchor('/backend/index', 'Accueil', 'title="Accueil"'); ?>
	                </li>
	                <li>
	                	<?php echo anchor('/backend/createContest', 'Creer concours', 'title="Creer concours"'); ?>
	                </li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="#"><span class="glyphicon glyphicon-log-out"></span> Exit</a></li>
				</ul>
			</div>
		</nav>