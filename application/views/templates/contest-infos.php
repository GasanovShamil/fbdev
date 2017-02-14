<?php require_once(dirname(__FILE__).'/../../viewModels/Contest.php'); ?>

<h1><?php echo $contest->name; ?></h1>
<h3>Prix : <?php echo $contest->prize; ?></h3>
<h3><?php echo $contest->getDateRange(); ?></h3>