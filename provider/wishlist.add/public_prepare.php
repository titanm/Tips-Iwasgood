<?php
	if (isset($_SESSION['success'])) {
		$_SESSION['flashMsg'] = 'You created a new wishlist.';
		$_SESSION['flashType'] = 'good';
		$id = $_SESSION['success'];
		unset($_SESSION['success']);
		header('Location: /my-wishlists/'.$id); die();
	}
	if ($_POST) {
		require('form.php');
		require('provider/univ.prov/create.php');
	}
?>