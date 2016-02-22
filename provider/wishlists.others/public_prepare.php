<?php
	if (!$loggedin) { header('Location: /login'); die(); }
	if (count($urlParts)>1) { echo '404 Not found'; return; }
	if (count($urlParts)==1) { 
		$wishlist = mysql_one_row('SELECT wl.* FROM wishlists wl JOIN
			connections c WHERE (
				(owner_id=user2_id AND user1_id="'.addslashes($loggedin['id']).'") OR
				(owner_id=user1_id AND user2_id="'.addslashes($loggedin['id']).'"))
			AND id="'.addslashes($urlParts[0]).'";');
		if (!$wishlist) { echo '404 Not found'; return; }
		if (file_exists('provider/wishlist/public_prepare.php'))
			require_once('provider/wishlist/public_prepare.php');
	}
?>