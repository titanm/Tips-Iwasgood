<?php
	require_once('provider/univ.prov/validate.php');
	
	if (isset($_GET['cancel'])) {
		mysql_query('DELETE FROM connections WHERE
			(user1_id="'.$loggedin['id'].'" AND user2_id="'.addslashes($_GET['cancel']).'") OR
			(user2_id="'.$loggedin['id'].'" AND user1_id="'.addslashes($_GET['cancel']).'");');
		header('Location: '.(isset($_SERVER['HTTP_REFERER'])?$_SERVER['HTTP_REFERER']:'/connections')); die();
	}
	if (isset($_GET['accept'])) {
		$row = mysql_one_row('SELECT * FROM invitations WHERE id="'.addslashes($_GET['accept']).'"
			AND email="'.addslashes($loggedin['email']).'";');
		if ($row) {
			mysql_query('INSERT INTO connections SET user1_id="'.$loggedin['id'].'", user2_id="'.$row['user_id'].'";') or die(mysql_error());
			mysql_query('DELETE FROM invitations WHERE id="'.addslashes($_GET['accept']).'";');
		}
		header('Location: '.(isset($_SERVER['HTTP_REFERER'])?$_SERVER['HTTP_REFERER']:'/connections')); die();
	}
	if (isset($_GET['decline'])) {
		mysql_query('DELETE FROM invitations WHERE id="'.addslashes($_GET['decline']).'"
			AND email="'.addslashes($loggedin['email']).'";') or die(mysql_error());
		header('Location: '.(isset($_SERVER['HTTP_REFERER'])?$_SERVER['HTTP_REFERER']:'/connections')); die();
	}
	if (isset($_GET['uninvite'])) {
		mysql_query('DELETE FROM invitations WHERE id="'.addslashes($_GET['uninvite']).'"
			AND user_id="'.addslashes($loggedin['id']).'";') or die(mysql_error());
		header('Location: '.(isset($_SERVER['HTTP_REFERER'])?$_SERVER['HTTP_REFERER']:'/connections')); die();
	}
	
	if ($_POST) {
		$errors = array();
		$field = array('valid'=>array('required', 'email'));
		validate('email', $field, $_POST['email']);
		if (count($errors)>0) {
			$_SESSION['flashMsg'] = $errors['email'];
			$_SESSION['flashType'] = 'bad';
		} else {
			$data = array('user_id'=>''.$loggedin['id'],'email'=>$_POST['email']);
			$set = array();
			foreach ($data as $k=>$v) $set[$k] = '`'.$k.'`="'.addslashes($v).'"';
			$row = mysql_one_row('SELECT * FROM invitations WHERE '.implode(' AND ',$set).';');
			if ($row) {
				$_SESSION['flashMsg'] = 'You already invited '.$_POST['email'].' successfully';
			} else {
				$_SESSION['flashMsg'] = 'You invited '.$_POST['email'].' successfully';
				$_SESSION['flashType'] = 'good';
				mysql_query('INSERT INTO invitations SET '.implode(',',$set).';') or die(mysql_error());
				$body = file_get_contents('provider/connections/mail.txt');
				$body = strtr($body, array(
					'%inviter%' => $loggedin['full_name']=='' ? $loggedin['name'] : $loggedin['full_name'],
					));
				mail($_POST['email'], 'Invitation to Ivebeengood.', $body);
			}
		}
		header('Location: '.(isset($_SERVER['HTTP_REFERER'])?$_SERVER['HTTP_REFERER']:'/connections')); die();
	}
?>