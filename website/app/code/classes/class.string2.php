<?php

class string2 {

	public static function vall($value) {
		if (strpos($value, ",") !== FALSE) {
			$value = str_replace(".", "", $value);
			$value = str_replace(",", ".", $value);
		}
		if ($value + 0 != $value) return "";
		return $value + 0;
	}
	
	public static function Abkuerzung($txt, $chars = 160) {
		if (strlen($txt) <= $chars) return $txt;
		$pos = strrpos(substr($txt,0,$chars+1)," ");
		return substr($txt,0,$pos)."…";
	}

}