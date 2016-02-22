<?php
	if (isset($_SESSION['success'])) {
		$user = mysql_one_row('SELECT * FROM users WHERE id="'.addslashes($_SESSION['success']).'";') or die('wow, that\'s some pretty nasty bug.');
		$body = file_get_contents('provider/user.register/mail.txt');
		$body = str_replace('%confirm_link%',
			'http://'.$_SERVER['HTTP_HOST'].'/confirm-email/'.$user['name'].'/'.$user['uniqid'],
			$body);
		mail($user['email'], 'Successful registration.', $body);
		unset($_SESSION['success']);
		$_SESSION['flashMsg'] = 'Successful registration. Please check your e-mail box';
		$_SESSION['flashType'] = 'good';
		header('Location: /'); die();
	}
    if ($_POST) {
		$table = 'users';
		$form = array(
			'name' => array('type'=>'text', 'valid'=>array('required','unique')),
			'email' => array('type'=>'text', 'valid'=>array('required','unique','email')),
			'password' => array('type'=>'password', 'valid'=>array('required')),
			'password_repeat' => array('type'=>'password', 'valid'=>array('required','equalto|password|The passwords don\'t match'), 'ignore'=>1),
			'agree-tac' => array('valid'=>array('required'), 'ignore'=>1),
			'uniqid' => array('type'=>'justadd', 'default'=>makePassHash(uniqid('',true))),
		);
		require('provider/univ.prov/create.php');
    }
?>