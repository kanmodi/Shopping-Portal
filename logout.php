<?php
	session_start();
	// $_SESSION = array();
	session_destroy();
	echo "<a href=\"index.php\"> Login/Register </a>";
?>