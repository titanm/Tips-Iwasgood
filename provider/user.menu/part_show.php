<?php
	if (file_exists('userfiles/user'.$loggedin['id'].'.jpg')) {
		$img = '<img src="/userfiles/user'.$loggedin['id'].'.jpg">';
	} else {
		$img = '?';
	}
?>
<div id="user-menu">
 <div id="user-pic" class="circular"><?= $img; ?></div>
 <div id="user-fullname"><?= $loggedin['full_name']!='' ? $loggedin['full_name'] : $loggedin['name']; ?></div>
 <ul>
  <li id="um-new-wishlist"><a href="/new-wishlist">New wishlist</a></li>
  <li id="um-my-wishlists"><a href="/my-wishlists">My wishlists</a></li>
  <li id="um-shared-wishlists"><a href="/shared-wishlists">Wishlists shared with me</a></li>
  <li id="um-shared-wishlists"><a href="/connections">My friends and family members</a></li>
  <li id="um-profile"><a href="/profile">My profile</a></li>
  <li id="um-logout"><a href="/logout">Log out</a></li>
 </ul>
</div>