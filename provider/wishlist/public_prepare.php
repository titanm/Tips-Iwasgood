<?php
	if (isset($_GET['remove'])) {
		mysql_query('DELETE FROM wishes WHERE id="'.addslashes($_GET['remove']).'" AND wishlist_id="'.$wishlist['id'].'";') or die(mysql_error());
		header('Location: '.(isset($_SERVER['HTTP_REFERER'])?$_SERVER['HTTP_REFERER']:('/my-wishlists/'.$wishlist['id']))); die();
	}
	if (isset($_SESSION['success'])) {
		$_SESSION['flashMsg'] = 'You added a new wish.';
		$_SESSION['flashType'] = 'good';
		$id = $_SESSION['success'];
		unset($_SESSION['success']);
		header('Location: '.(isset($_SERVER['HTTP_REFERER'])?$_SERVER['HTTP_REFERER']:('/my-wishlists/'.$wishlist['id']))); die();
	}
	if ($_POST) {
		if (isset($_POST['comment']) && $loggedin['id']!=$wishlist['owner_id']) {
			if (trim($_POST['comment'])!='') {
				mysql_query('INSERT INTO comments SET
					wishlist_id="'.$wishlist['id'].'", 
					owner_id="'.$loggedin['id'].'", 
					`when`=NOW(), 
					content="'.addslashes($_POST['comment']).'";') or die(mysql_error());
				$_SESSION['flashMsg'] = 'You posted a new comment.';
				$_SESSION['flashType'] = 'good';
				header('Location: '.(isset($_SERVER['HTTP_REFERER'])?$_SERVER['HTTP_REFERER']:('/my-wishlists/'.$wishlist['id']))); die();
			}
		} else {
			if ($loggedin['id']!=$wishlist['owner_id']) return;
			require('form.php');
			require('provider/univ.prov/create.php');
		}
	}
?>