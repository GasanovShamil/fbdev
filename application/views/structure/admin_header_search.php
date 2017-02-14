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
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/scripts/admin_nav.js"></script>
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
				<!-- DROPDOWN SEARCH STARTS HERE  -->
				<ul id="signInDropdown" class="nav navbar-nav">
                    <li class="dropdown">
                        <button type="button" id="dropdownMenu1" data-toggle="dropdown" class="btn btn-info navbar-btn dropdown-toggle"><i class="glyphicon glyphicon-search"></i> Search <span class="caret"></span></button>
                        <ul class="dropdown-menu">
                          <li style="width: 250px;">
                                <form class="navbar-form form" role="form" method="POST" action="/backend/listContests">
                                    <div class="form-group">
                                      <div class="input-group">
                                            <label for="before">Before</label>
                                            <input id="before" class="form-control" type="date" name="before">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <label for="after">After</label>
                                            <input id="after" class="form-control" type="date" name="after">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary form-control">Search</button>
                                    </div>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
                <!-- DROPDOWN SEARCH ENDS HERE  -->
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