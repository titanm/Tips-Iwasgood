<?php
	if (isset($wishlist)) {
		require('provider/wishlist/public_show.php');
	} else {
		$wishlists = mysql_query('SELECT wl.*,u.name,u.full_name,u.email FROM wishlists wl
			JOIN users u ON u.id=wl.owner_id
			JOIN connections c WHERE (
				(owner_id=user2_id AND user1_id="'.addslashes($loggedin['id']).'") OR
				(owner_id=user1_id AND user2_id="'.addslashes($loggedin['id']).'"));');
		$whose = 'Wishlists shared with me';
		require('provider/wishlists/public_show.php');
	}
?>