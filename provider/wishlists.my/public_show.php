<?php
	if (isset($wishlist)) {
		require('provider/wishlist/public_show.php');
	} else {
		$wishlists = mysql_query('SELECT * FROM wishlists WHERE owner_id="'.$loggedin['id'].'";') or die(mysql_error());
		$whose = 'My wishlists';
		require('provider/wishlists/public_show.php');
	}
?>