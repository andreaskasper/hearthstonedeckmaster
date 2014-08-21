<?php

class MyUser {

	private static $_usercache = null;

	public static function isloggedin() {
		return isset($_SESSION["myuser"]["id"]);
	}
	
	public static function id() {
		if (!isset($_SESSION["myuser"]["id"])) return null;
		return $_SESSION["myuser"]["id"];
	}
	
	public static function username() {
		if (!isset($_SESSION["myuser"]["id"])) return null;
		return $_SESSION["myuser"]["username"];
	}
	
	public static function loginload($id) {
		session_regenerate_id(true);
		$db = new SQL(0);
		$row = $db->cmdrow(0, 'SELECT T1.* FROM user_list as T1 WHERE T1.id="{0}" LIMIT 0,1', array($id));

		$_SESSION["myuser"]["id"] = $row["id"];
		if (isset($row["username"])) $_SESSION["myuser"]["username"] = $row["username"];
		else $_SESSION["myuser"]["username"] = "JN!Soldier#".$row["id"];
		$_SESSION["myuser"]["email"] = $row["email"];
		$rows = $db->cmdrows(0, 'SELECT * FROM user_rights WHERE `user` = {0}', array($row["id"]));
		foreach ($rows as $a) $_SESSION["myuser"]["rights"][$a["right"]] = true;
		$w = array();
		$w["user"] = MyUser::id();
		$w["dt_lastlogin"] = time();
		$db->CreateUpdate(0, 'user_details', $w);
		//print_r($_SESSION); exit(1);
	}
	
	public static function hasRight($must = "", $oneof = array()) {
		if (!isset($_SESSION["myuser"]["rights"])) return false;
		if (!is_array($must)) $must = array((string)$must);
		if (!is_array($oneof)) $oneof = array((string)$oneof);
		foreach ($must as $a) if (!isset($_SESSION["myuser"]["rights"][$a]) OR $_SESSION["myuser"]["rights"][$a] != true) return false;
		if ($oneof == array()) return true;
		foreach ($oneof as $a) if (isset($_SESSION["myuser"]["rights"][$a]) && $_SESSION["myuser"]["rights"][$a] == true) return true;
		return false;
	}
	
	public static function hasAdminRight() {
		if (MyUser::id() == 1) return true;
		return self::hasRight("admin");
	}
	
	public static function changePassword($pwd) {
		$db = new SQL(0);
		$w = array();
		$w["username"] = "User[".(self::id())."]";
		$w["pwd"] = md5($pwd);
		$w["provider"] = "local";
		$w["user"] = MyUser::id();
		$db->CreateUpdate(0, "user_login", $w);
		return true;
	}
	
	/*** URL-Links ***/
	
	public static function getProfileURL($subsite = null) {
		return UserProfile::ProfilePermaLink($_SESSION["myuser"]["id"], $_SESSION["myuser"]["username"], $subsite);
	}


	private static function _load() {
		if (!self::isloggedin()) return false;
		$db = new SQL(0);
		self::$_usercache = $db->cmdrow(0, 'SELECT * FROM user_list WHERE id={0} LIMIT 0,1', array(self::id()));
	}



}