<?php
	$table = 'users';
	$formName = 'profile';
	$defaults = $loggedin;
	unset($defaults['password']);
	$form = array(
		'name' => array('label'=>'Username', 'type'=>'justshow', 'ignore'=>1),
		'email' => array('label'=>'E-mail', 'type'=>'justshow', 'ignore'=>1),
		'password' => array('label'=>'Password', 'type'=>'password', 'valid'=>array()),
		'password_repeat' => array('label'=>'Password again', 'type'=>'password', 'valid'=>array('equalto|password|The passwords don\'t match'), 'ignore'=>1),
		'full_name' => array('label'=>'Full name', 'type'=>'text'),
		'picture' => array('label'=>'Picture', 'type'=>'image', 'resizeTo'=>'90x90', 'dest'=>'userfiles/user'.$loggedin['id'].'.jpg',
			'show'=>file_exists('userfiles/user'.$loggedin['id'].'.jpg')?'<img src="/userfiles/user'.$loggedin['id'].'.jpg" />':'No picture yet (click here)'),
	);
?>