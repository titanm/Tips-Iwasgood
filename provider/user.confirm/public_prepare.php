<?php
	if (count($urlParts)!=2) { echo '404 Not found'; return; }
	$row = mysql_one_row($qry='SELECT * FROM users WHERE name="'.$urlParts[0].'" AND uniqid="'.$urlParts[1].'";');
	if (!$row) { echo '404 Not found'.$qry; return; }
	if ($row['email_confirmed']==1) {
		$_SESSION['flashMsg'] = 'You confirmed your email address already.';
	} else {
		$_SESSION['flashMsg'] = 'Thank you for confirming your email.';
		$_SESSION['flashType'] = 'good';
		mysql_query('UPDATE users SET email_confirmed=1 WHERE id="'.$row['id'].'";') or die(mysql_error());
	}
	header('Location: /login'); die();
?>