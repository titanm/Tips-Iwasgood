<?php
    if (isset($_SESSION['loggedin'])) {
		$loggedin = mysql_one_row('SELECT * FROM users WHERE id="'.$_SESSION['loggedin'].'" AND active AND email_confirmed;');
		if (!$loggedin) session_destroy();
    } else {
		$loggedin = false;
    }

    function makePassHash($pass) {
		global $config;
		return md5(md5($pass).$config['secret']);
    }
?>