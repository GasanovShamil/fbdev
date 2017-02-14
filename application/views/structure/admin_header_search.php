<!DOCTYPE html>
<html>
	<head>
		<title></title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/style/admin.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/style/site.css" />
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/scripts/site.js"></script>
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
	                <li class="dropdown">
				        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Concours<span class="caret"></span></a>
				        <ul class="dropdown-menu">
					        <li>
		                		<?php echo anchor('/backend/listContests', 'Gerer les concours', 'title="Gerer les concours"'); ?>
		                	</li>
		                	<li>
		                		<?php echo anchor('/backend/createContest', 'Créer concours', 'title="Créer concours"'); ?>
		                	</li>
				        </ul>
				    </li>
				</ul>
				<form class="navbar-form navbar-left">
				    <div class="form-group">
				    <input type="date" class="form-control" placeholder="before">
				    </div>
				    <div class="form-group">
				    	<input type="date" class="form-control" placeholder="after">
				    </div>
				    <button type="submit" class="btn btn-default">Submit</button>
			    </form>
				<ul class="nav navbar-nav navbar-right">
					<li>
						<?php echo anchor('/home/index', 'Site', 'title="Retour sur le site" class="glyphicon glyphicon-log-out"'); ?>
					</li>	
				</ul>
			</div>
		</nav>
		<?php
			if (isset($alert)) {
				echo '<div class="alert alert-warning">';
					echo '<strong>Attention : </strong>'.$alert;
				echo '</div>';
			}
		?>

		<div class="container">