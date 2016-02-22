<?php
	error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED); ini_set('display_errors',true);
	require('config.inc.php');
	require('init.inc.php');
	require('provider/user.login/common.php');
	
	$pathInfo = isset($_SERVER['ORIG_PATH_INFO'])?$_SERVER['ORIG_PATH_INFO']:(isset($_SERVER['PATH_INFO'])?$_SERVER['PATH_INFO']:'');
	$urlParts = explode("/", $pathInfo);		
	$pageId = 0;
	$urlData = array();
	while (count($urlParts)>0 && ($urlParts[0]=='' || $urlParts[0]=='index.php')) array_shift($urlParts);
	$oldUrlParts = $urlParts;
	$pageTitles = array("Ivebeengood");
	do {
		if (count($urlParts)==0) continue;
		while (count($urlParts)>0 && ($urlParts[0]=='' || $urlParts[0]=='index.php')) array_shift($urlParts);
		if (count($urlParts)==0) continue;
		$row = mysql_one_row ("SELECT * FROM pages WHERE url='".addslashes($urlParts[0])."' AND parent_id=$pageId;");
		if ($row) {
			$urlData[] = $row;
			$pageId = $row['id'];
			$pageData = $row;
			$pageTitles[] = $row['title'];
			array_shift ($urlParts);
		}
	} while (count($urlParts)>0 && $row!==false);
	if (!isset($pageData)) {
		$pageData = mysql_one_row("SELECT * FROM pages WHERE id=1;");
	}
	if (!$pageData) {
		die('Sorry, we encountered an error. We\'ll try to solve it ASAP');
	}
	$template = $loggedin ? 'main' : 'login';
	if (file_exists("provider/$pageData[provider]/public_prepare.php")) require("provider/$pageData[provider]/public_prepare.php");
	ob_start();
	if (file_exists("provider/$pageData[provider]/public_show.php")) require("provider/$pageData[provider]/public_show.php");
	else echo "ERROR: Can't find content provider - $pageData[provider]";
	$contents = ob_get_contents();
	ob_end_clean();
?>
<!DOCTYPE html>
<html>
<head>
<title>Ivebeengood</title>
<link rel="stylesheet" href="/css/default.css" />
<link rel="stylesheet" href="/css/<?= $template; ?>_template.css" />
<?php if (file_exists('templates/'.$template.'_head.php')) require('templates/'.$template.'_head.php'); ?>
<script type="text/javascript" src="/js/jquery-1.12.0.js"></script>
<script type="text/javascript" src="/js/default.js"></script>
</head>
<body>
<?php
	if (isset($_SESSION['flashMsg'])) {
		$class = 'flash-neutral';
		if (isset($_SESSION['flashType'])) {
			$class = 'flash-'.$_SESSION['flashType'];
			unset($_SESSION['flashType']);
		}
		echo '<div class="flashmsg '.$class.'">'.$_SESSION['flashMsg'].'</div>';
		unset($_SESSION['flashMsg']);
	}
?>
<div id="body">
<?php require('templates/'.$template.'_template.php'); ?>
</div>
</body>
</html>