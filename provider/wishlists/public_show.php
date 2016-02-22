<div id="wishlist">
 <h1><?= $pageData['title']; ?></h1>
<?php
	$res = $wishlists;
	if (mysql_num_rows($res)==0) {
		if ($pageData['provider']=='wishlists.my') {
			echo "<p>No wishlists yet. Why don't you <a href='/new-wishlist'>create one</a>?</p>";
		} else {
			echo "<p>No wishlists yet. Why don't you <a href='/connections'>invite somes to share</a>?</p>";
		}
	} else {
		echo '<ul class="wishlist">';
		while ($row=mysql_fetch_array($res)) {
			if (isset($row['full_name'])) { if ($row['full_name']=='') $row['full_name']=$row['name']; }
			echo '<li><a href="/'.$pageData['url'].'/'.$row['id'].'">'.
				($row['owner_id']==$loggedin['id'] ? 'For ' : "$row[full_name]'s wishes for ").
				$row['for'].'</a></li>';
		}
		echo '</ul>';
	}
	mysql_free_result($res);
?>
</div>