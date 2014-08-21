<?php

srand();
//SiteConfig::load(0);
Session::init();

/*$config = SiteConfig::get(0);
if (!isset($_ENV["baseurl"])) $_ENV["baseurl"] = $config["baseurl"];
if (!isset($_ENV["baseurlpath"])) $_ENV["baseurlpath"] = $config["baseurlpath"];*/

//Bugvermeidung
$_REQUEST = array_merge($_GET, $_POST);

$_ENV["language"] = "de_DE";


i18n::init(isset($_GET["_lang"]) ? $_GET["_lang"] : (isset($_ENV["language"]) ? $_ENV["language"] : "de_DE"));


function get_path($file) {
	return str_replace("//", "/", $_ENV["baseurlpath"].$file);
}

function get_skinpath($file) {
	return str_replace("//", "/", $_ENV["baseurlpath"]."/skins/hdf_light/".$file);
}

function html($txt) {
	return htmlentities($txt, 3, "UTF-8");
}

function htmlhref($txt) {
	$txt = str_replace(array(" ","ä","ö","ü","ß","Ä","Ö","Ü"),array("_","ae","oe","ue","ss","Ae","Oe","Ue"),$txt);
	$txt = preg_replace("@[^a-zA-Z0-9\_\-]@iU","",$txt);
	return $txt;
}

/*function _e($txt) {
	return html($txt);
}

function _h($html) {
	return $html;
}*/
