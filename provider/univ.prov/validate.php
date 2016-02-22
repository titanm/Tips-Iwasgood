<?php
	function validate($name, $field, $value) {
		global $errors, $table;
		$myErr = array();
		$validations = is_array($field['valid']) ? $field['valid'] : array($field['valid']);
		foreach ($validations as $v) {
			$v = explode('|', $v);
			switch ($v[0]) {
				case 'required': if (trim($value)=='') $myErr[]=isset($v[1])?$v[1]:'This field is required.'; break;
				case 'unique': if (trim($value)=='') break;
					$row = mysql_one_row('SELECT * FROM '.$table.' WHERE `'.$name.'`="'.addslashes($value).'";');
					if ($row) $myErr[]=isset($v[1])?$v[1]:'This field must be unique.';
					break;
				case 'email': if (trim($value)=='') break;
					if (!preg_match('_.*@.*\..*_', $value)) $myErr[]=isset($v[1])?$v[1]:'The format of this field is incorrect.';
					break;
				case 'equalto': if (trim($_POST[$v[1]])=='') break;
					if ($value!=$_POST[$v[1]]) $myErr[]=isset($v[2])?$v[2]:'This have to be equal to the other field.';
					break;
			}
		}
		if (count($myErr)>0) {
			$errors[$name] = implode(' ', $myErr);
			return false;
		}
		return true;
	}
?>