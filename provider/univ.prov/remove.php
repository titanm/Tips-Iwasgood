<?php
	mysql_query('DELETE FROM '.$table.' WHERE id="'.addslashes($id).'";') or die(mysql_error());
	header('Location: '.(isset($_SERVER['HTTP_REFERER'])?$_SERVER['HTTP_REFERER']:'/')); die();
?>