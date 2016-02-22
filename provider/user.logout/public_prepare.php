<?php
	session_destroy();
	session_start();
	$_SESSION['flashMsg'] = 'Good bye.';
	$_SESSION['flashType'] = 'good';
	header('Location: /login'); die();
?>