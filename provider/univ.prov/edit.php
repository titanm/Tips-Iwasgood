<?php
	require_once('validate.php');

	$errors = array();
	$set = array();
	$procImg = array();
	foreach ($form as $name=>$field) {
		if ($field['type']=='justadd') {
			$_POST[$name] = $field['default'];
		}
		if ($field['type']=='image') {
			if (is_uploaded_file($_FILES[$name]['tmp_name'])) {
				move_uploaded_file($_FILES[$name]['tmp_name'], 'userfiles/uploaded/'.$_FILES[$name]['name']);
				$procImg[] = $name;
				$_POST[$name] = $_FILES[$name]['name'];
			}
		}
		validate($name, $field, $_POST[$name]);
		$value = $_POST[$name];
		if ($field['type']=='password' && $value!='') {
			$value = makePassHash($value);
		}
		if (isset($field['ignore'])) continue;
		if ($field['type']!='password' || $value!='') {
			$set[$name] = '`'.$name.'`="'.addslashes($value).'"';
		}
	}
	if (!$errors) {
		mysql_query('UPDATE '.$table.' SET '.implode(',',$set).' WHERE id="'.addslashes($id).'";') or die(mysql_error());
		foreach ($procImg as $n) {
			require_once('proc_img.php');
			$dest = strtr($form[$n]['dest'], array('#'=>$id));
			$resizeTo = explode('x', $form[$n]['resizeTo']);
			proc_img('userfiles/uploaded/'.$_FILES[$name]['name'], $dest, $resizeTo[0], $resizeTo[1]);
		}
		if (isset($_SESSION['previousValues'])) unset($_SESSION['previousValues']);
		$_SESSION['success'] = $id;
	} else {
		$_SESSION['errors'] = $errors;
		$_SESSION['previousValues'] = $_POST;
	}
	header('Location: '.(isset($_SERVER['HTTP_REFERER'])?$_SERVER['HTTP_REFERER']:'/')); die();
?>