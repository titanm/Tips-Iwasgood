<?php
    require_once('config.inc.php');
    mysql_connect($config['dbhost'], $config['dbuser'], $config['dbpass']) or die(mysql_error());
    mysql_select_db($config['dbname']) or die(mysql_error());
	session_start();

    function mysql_one_row($qry) {
		$res = mysql_query($qry) or die(mysql_error());
		$row = mysql_fetch_array($res);
		mysql_free_result($res);
		return $row;
    }
?>