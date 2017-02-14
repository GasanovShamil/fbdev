<?php
	function quote($message) {
		echo '"'.$message.'"';
	}

	function limit($message, $limit = 20) {
		if (strlen($message) > $limit) {
			echo substr($message, 0, $limit - 3).'...';
		} else {
			echo $message;
		}
	}
?>