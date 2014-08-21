<?php


class Notifications {

	public static function add($type = 0, $txt = "", $href="",$key = null, $user = -1, $icon = "user") {
		$db = new SQL(0);
		if ($user == -1) $user = MyUser::id();
		if ($key == null) $key = md5(time()+rand(0,99999999));
		$w = array();
		$w["user_id"] = $user;
		$w["msgkey"] = $key;
		$w["type"] = $type;
		$w["txt"] = $txt;
		$w["href"] = $href;
		$w["icon"] = $icon;
		$w["dt_created"] = time();
		$db->Create(0, "user_notifications", $w);
		unset($_SESSION["myuser"]["last_notification_load"]);
	}







}