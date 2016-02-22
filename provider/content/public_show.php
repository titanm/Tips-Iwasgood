<?php
	if (file_exists('provider/content/'.$pageData['providerData'].'.html')) {
		echo file_get_contents('provider/content/'.$pageData['providerData'].'.html');
	} else {
		echo '404 Not found - '.$pageData['providerData'];
	}
?>