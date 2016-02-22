<?php require_once('show_error.php'); ?>
<form name="<?= $formName; ?>" id="<?= $formName; ?>" method="post" enctype="multipart/form-data">
<?php
	foreach ($form as $name=>$field) {
		$value = isset($_SESSION['previousValues'][$name]) ? $_SESSION['previousValues'][$name] : (isset($field['default'])?$field['default']:(isset($defaults[$name])?$defaults[$name]:''));
		echo '<div id="field_'.$formName.'_'.$name.'">';
		showError($name);
		if ($field['type']=='justadd') continue;
		echo '<label>'.$field['label'];
		if (!isset($field['extraAttr'])) $field['extraAttr'] = '';
		switch ($field['type']) {
			case 'justadd': break;
			case 'justshow': echo '<div>'.$value.'</div>'; break;
			case 'image':
				if (isset($field['show'])) {
					echo '<div>'.$field['show'].'</div><input name="'.$name.'" type="file" '.$field['extraAttr'].' class="hidden" />';
				} else {
					echo '<input name="'.$name.'" type="file" '.$field['extraAttr'].'/>';
				}
				break;
			case 'textarea':
				echo '<textarea name="'.$name.'" '.$field['extraAttr'].'>'.$value.'</textarea>';
				break;
			case 'select':
				echo '<select name="'.$name.'" '.$field['extraAttr'].'>';
				foreach ($field['options'] as $k=>$v) {
					echo '<option value="'.$k.'"'.($v==$value?' selected':'').'>'.$v.'</option>';
				}
				echo '</select>';
				break;
			case 'password':
				echo '<input name="'.$name.'" type="'.$field['type'].'" '.$field['extraAttr'].'/>';
				break;
			default:
				echo '<input name="'.$name.'" type="'.$field['type'].'" value="'.$value.'" '.$field['extraAttr'].'/>';
				break;
		}
		echo '</label>';
		echo '</div>';
	}
?>
<input type="submit" value="<?= isset($formSubmit)?$formSubmit:'Submit'; ?>" />
</form>