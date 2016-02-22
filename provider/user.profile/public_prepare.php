<?php
	if (isset($_SESSION['success'])) {
		$_SESSION['flashMsg'] = 'You updated your profile successfully';
		$_SESSION['flashType'] = 'good';
		unset($_SESSION['success']);
		header('Location: /'); die();
	}
	if ($_POST) {
		require('form.php');
		$id = $loggedin['id'];
		require('provider/univ.prov/edit.php');
	}
?>