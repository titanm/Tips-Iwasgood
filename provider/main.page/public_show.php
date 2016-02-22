<?php
	if (count($urlParts)>0) { echo '404 Not found'; return; }
?>
<h1>Welcome!</h1>
<p>We're glad to see you.</p>
<?php
	$res = mysql_query('SELECT wl.*,u.name,u.full_name,u.email FROM wishlists wl
		JOIN users u ON u.id=wl.owner_id
		JOIN connections c WHERE (
			(owner_id=user2_id AND user1_id="'.addslashes($loggedin['id']).'") OR
			(owner_id=user1_id AND user2_id="'.addslashes($loggedin['id']).'"))
		ORDER BY wl.id DESC LIMIT 5;');
	if (mysql_num_rows($res)>0) {
		echo '<p>Here are the latest wishlists from friends and family members.</p>';
		echo '<ul>';
		while ($row=mysql_fetch_array($res)) {
			if (isset($row['full_name'])) { if ($row['full_name']=='') $row['full_name']=$row['name']; }
			echo '<li><a href="/shared-wishlists/'.$row['id'].'">'.
				"$row[full_name]'s wishes for ".$row['for'].'</a></li>';
		}
		echo '</ul>';
	}
	mysql_free_result($res);
	
	$row = mysql_one_row('SELECT COUNT(*) cnt FROM invitations WHERE email="'.addslashes($loggedin['email']).'";');
	if ($row['cnt']==1) {
		echo "<p>There's an invitation for you. Check it out <a href='/connections'>here</a>.</p>";
	} else if ($row['cnt']==1) {
		echo "<p>There are some invitations for you. Check them out <a href='/connections'>here</a>.</p>";
	}
?>