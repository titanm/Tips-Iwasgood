<?php
	function showError($id) {
		if (!isset($_SESSION['errors'])) return;
		if (isset($_SESSION['errors'][$id])) {
			echo '<div class="error">'.$_SESSION['errors'][$id].'</div>';
			unset($_SESSION['errors'][$id]);
		}
	}
?>