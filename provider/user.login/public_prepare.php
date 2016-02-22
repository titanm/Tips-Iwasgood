<?php
    if (isset($_POST['login'])) {
		$loggedin = mysql_one_row('SElECT * FROM users WHERE name="'.$_POST['login']['name'].'" AND password="'.makePassHash($_POST['login']['password']).'" AND active;');
		if ($loggedin) {
			if ($loggedin['email_confirmed']!=1) {
				$_SESSION['flashMsg'] = 'Please confirm your e-mail address';
				$_SESSION['flashType'] = 'bad';
				$loggedin = false;
			} else {
				$_SESSION['loggedin'] = $loggedin['id'];
				$_SESSION['flashMsg'] = 'You logged in sucessfully';
				$_SESSION['flashType'] = 'good';
				header('Location: /'); die();
			}
		} else {
			$_SESSION['flashMsg'] = 'Wrong username or password';
			$_SESSION['flashType'] = 'bad';
		}
		header('Location: '.(isset($_SERVER['HTTP_REFERER'])?$_SERVER['HTTP_REFERER']:'/')); die();
    }
?>