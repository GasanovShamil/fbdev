<!DOCTYPE html>
<html>
<head>
	<title></title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/style.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>js/bootstrap.js"></script>
</head>
<body>
<!--     <?php if ($showNav) { ?>
 -->    <?php if ($showNav) :?>
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
    				<li><a href="#">Participer</a></li>
    				<li><a href="#">Voter</a></li>
    				<?php
    					if ($isAdmin) {
    						echo '<li><a href="#">Administration</a></li>';
    					}
    				?>
    			</ul>
    		</div>

		</div>
	</nav>
<!--     <?php } ?>
 -->    <?php endif;?>
	
	<div class="container">