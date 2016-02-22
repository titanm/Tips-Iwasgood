<div id="connections">
 <h1>My friends and family members</h1>
<?php
	$res = mysql_query('SELECT u.* FROM users u JOIN
		connections c WHERE (
			(u.id=user2_id AND user1_id="'.addslashes($loggedin['id']).'") OR
			(u.id=user1_id AND user2_id="'.addslashes($loggedin['id']).'"));') or die(mysql_error());
	if (mysql_num_rows($res)==0) {
		echo '<p>No connections yet. You may invite somes.</p>';
	} else {
		echo '<ul>';
		while ($row=mysql_fetch_array($res)) {
			if ($row['full_name']=='') $row['full_name']=$row['name'];
			echo '<li>'.$row['full_name'].' <a href="/connections?cancel='.$row['id'].'">cancel</a></li>';
		}
		echo '</ul>';
	}
	mysql_free_result($res);

	$res = mysql_query('SELECT u.*,i.id invitation_id FROM users u JOIN invitations i ON i.user_id=u.id
		WHERE i.email="'.addslashes($loggedin['email']).'";') or die(mysql_error());
	if (mysql_num_rows($res)>0) {
		echo '<p>You were invited by:</p>';
		echo '<ul>';
		while ($row=mysql_fetch_array($res)) {
			if ($row['full_name']=='') $row['full_name']=$row['name'];
			echo '<li>'.$row['full_name'].' ('.$row['email'].')';
			echo ' <a href="/connections?accept='.$row['invitation_id'].'">accept</a>';
			echo ' <a href="/connections?decline='.$row['invitation_id'].'">decline</a></li>';
		}
		echo '</ul>';
	}
	mysql_free_result($res);

	$res = mysql_query('SELECT * FROM invitations WHERE user_id="'.addslashes($loggedin['id']).'";') or die(mysql_error());
	if (mysql_num_rows($res)>0) {
		echo '<p>You already invited:</p>';
		echo '<ul>';
		while ($row=mysql_fetch_array($res)) {
			echo '<li>'.$row['email'].' <a href="/connections?uninvite='.$row['id'].'">cancel</a></li>';
		}
		echo '</ul>';
	}
	mysql_free_result($res);
?>
<form name="invite" method="post">
 <input type="text" name="email" placeholder="e-mail address"> <input type="submit" value="Invite">
</form>
</div>