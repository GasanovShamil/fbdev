<?php
	session_start();

	require_once(dirname(__FILE__).'/../vendor/autoload.php');
	require_once(dirname(__FILE__).'/../../libraries/facebook.php');

	$fb = getFacebook();
?>

<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/bootstrap.css" />
</head>
<body>