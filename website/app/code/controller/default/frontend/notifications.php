<?php

if (isset($_GET["goto"])) {
	$db = new SQL(0);
	$row = $db->cmdrow(0, 'SELECT * FROM user_notifications WHERE user_id = {0} AND msgkey = "{1}" LIMIT 0,1', array(MyUser::id(), $_GET["goto"]));
	$db->cmd(0, 'DELETE FROM user_notifications WHERE user_id = {0} AND msgkey = "{1}" LIMIT 1', true, array(MyUser::id(), $_GET["goto"]));
	header($_SERVER["SERVER_PROTOCOL"]." 307 Notification geladen..."); 
	header('Location: '.$row["href"]);
	unset($_SESSION["myuser"]["last_notification_load"]);
	exit(1);
}

