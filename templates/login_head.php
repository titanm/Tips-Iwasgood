<?php
	switch ($pageData['provider']) {
		case 'user.login': echo '<style type="text/css">body { background-image: url(images/bg_login.jpg); }</style>'; break;
		case 'user.register': echo '<style type="text/css">body { background-image: url(images/bg_register.jpg); }</style>'; break;
	}
?>