<?php
	$owner = mysql_one_row($qry='SELECT * FROM users WHERE id="'.addslashes($wishlist['owner_id']).'";') or die('Orphaned wishlist');
	$ownerName = $owner['full_name']!='' ? $owner['full_name'] : $owner['name'];
?>
<div id="wishlist">
 <h1><?= $owner['id']==$loggedin['id'] ? 'My' : "$ownerName's"; ?>
	wishlist for <?= $wishlist['for']; ?></h1>
<?php
	if ($owner['id']==$loggedin['id']) echo '<p><a href="/my-wishlists?removelist='.$wishlist['id'].'">remove whole list</a></p>';
	$res = mysql_query('SELECT * FROM wishes WHERE wishlist_id="'.addslashes($wishlist['id']).'" ORDER BY name;') or die(mysql_error());
	if (mysql_num_rows($res)==0) {
		if ($loggedin['id']==$owner['id']) {
			echo "<p>No wishes yet.</p>";
		} else {
			echo "<p>No wishes yet. Maybe he/she is thinking about it. :)</p>";
		}
	} else {
		while ($row=mysql_fetch_array($res)) {
			if (file_exists('userfiles/wish'.$row['id'].'.jpg')) {
				$img = '<img src="/userfiles/wish'.$row['id'].'.jpg">';
			} else {
				$img = '?';
			}
			echo '<div class="wish">';
			echo '<div class="wish-pic">'.$img.'</div>';
			echo '<div class="wish-name">'.$row['name'].'</div>';
			echo '<div class="wish-description">'.$row['description'].'</div>';
			if ($owner['id']==$loggedin['id']) echo '<div class="wish-description"><a href="/my-wishlists/'.$wishlist['id'].'?remove='.$row['id'].'">remove</a></div>';
			echo '</div>';
		}
	}
	mysql_free_result($res);
	
	if ($loggedin['id']==$owner['id']) {
		if (!isset($_SESSION['errors']) || count($_SESSION['errors'])==0) {
			$noError = true;
			echo '<div id="add-wish" class="circular">+</div>';
			echo '<div id="add-wish-form" style="display: none;">';
		}
		require_once('form.php');
		require_once('provider/univ.prov/show_form.php');
		if (!isset($noError)) {
			echo '</div>';
		}
	} else {
		echo '<h2>Discussing</h2>';
		$res = mysql_query('SELECT c.*,u.name,u.full_name FROM comments c JOIN users u ON c.owner_id=u.id
			WHERE wishlist_id="'.addslashes($wishlist['id']).'";') or die(mysql_error());
		while ($row=mysql_fetch_array($res)) {
			if (file_exists('userfiles/user'.$row['owner_id'].'.jpg')) {
				$img = '<img src="/userfiles/user'.$row['owner_id'].'.jpg" width="45">';
			} else {
				$img = '?';
			}
			if ($row['full_name']=='') $row['full_name'] = $row['name'];
			echo '<div class="comment">';
			echo '<div class="comment-pic">'.$img.'</div>';
			echo '<div class="comment-name">'.$row['full_name'].'</div>';
			echo '<div class="comment-when">'.$row['when'].'</div>';
			echo '<div class="comment-content">'.$row['content'].'</div>';
			echo '</div>';
		}
		mysql_free_result($res);
		echo '<form name="dicuss" method="post">';
		echo ' <textarea name="comment"></textarea>';
		echo ' <input type="submit" value="Post comment">';
		echo '</form>';
	}
?>
</div>