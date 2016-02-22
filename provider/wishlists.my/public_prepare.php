<?php
	if (!$loggedin) { header('Location: /login'); die(); }
	if (count($urlParts)>1) { echo '404 Not found'; return; }
	if (count($urlParts)==1) { 
		$wishlist = mysql_one_row('SELECT * FROM wishlists WHERE owner_id="'.addslashes($loggedin['id']).'" AND id="'.addslashes($urlParts[0]).'";');
		if (!$wishlist) { echo '404 Not found'; return; }
		if (file_exists('provider/wishlist/public_prepare.php'))
			require_once('provider/wishlist/public_prepare.php');
	}
	if (isset($_GET['removelist'])) {
		mysql_query('DELETE FROM wishlists WHERE id="'.addslashes($_GET['removelist']).'" AND owner_id="'.$loggedin['id'].'";') or die(mysql_error());
		header('Location: /my-wishlists'); die();
	}
?>